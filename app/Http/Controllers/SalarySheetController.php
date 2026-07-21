<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalarySheet;
use App\Models\EmployersSalarySheetItem;
use App\Models\Promoter;
use App\Models\Coordinator;
use App\Models\Job;
use App\Models\Allowance;
use App\Models\User;
use App\Models\PromoterPosition;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\SalarySheetCompleteNotification;
use App\Mail\SalarySheetApprovedNotification;
use App\Mail\SalarySheetDeclinedNotification;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SalarySheetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['approveViaEmail']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user  = auth()->user();
        $isReporter = $user && method_exists($user, 'hasRole') && $user->hasRole('reporter');

        // Base scope restricted by role
        $baseScope = function ($q) use ($user) {
            if ($user && method_exists($user, 'hasRole')) {
                if ($user->hasRole('officer')) {
                    $q->whereHas('job', fn($j) => $j->where('officer_id', $user->id));
                } elseif ($user->hasRole('reporter')) {
                    $q->whereHas('job', fn($j) => $j->where('reporter_id', $user->id));
                }
            }
        };

        // Stats (full counts, not paginated)
        $statsQuery = SalarySheet::query();
        $baseScope($statsQuery);
        $stats = [
            'total'    => (clone $statsQuery)->count(),
            'draft'    => (clone $statsQuery)->where('status', 'draft')->count(),
            'complete' => (clone $statsQuery)->where('status', 'complete')->count(),
            'approve'  => (clone $statsQuery)->where('status', 'approve')->count(),
            'paid'     => (clone $statsQuery)->where('status', 'paid')->count(),
            'reject'   => (clone $statsQuery)->where('status', 'reject')->count(),
        ];

        // Filtered query
        $query = SalarySheet::with(['job.client', 'creator'])
            ->withCount('items')
            ->tap($baseScope);

        // Search: sheet_no, job number, client name
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('sheet_no', 'like', "%{$search}%")
                  ->orWhereHas('job', fn($j) => $j->where('job_number', 'like', "%{$search}%")
                      ->orWhere('job_name', 'like', "%{$search}%"))
                  ->orWhereHas('job.client', fn($j) => $j->where('name', 'like', "%{$search}%"));
            });
        }

        if ($status = request('status')) {
            $query->where('status', $status);
        }

        if ($from = request('date_from')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = request('date_to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $sortBy    = in_array(request('sort_by'), ['created_at', 'sheet_no', 'status']) ? request('sort_by') : 'created_at';
        $sortOrder = request('sort_order', 'desc') === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sortBy, $sortOrder);

        $allSheets = $query->get();

        // Group by job, then order the job groups themselves by their most recently
        // created salary sheet — so a job with a brand-new sheet floats to the top,
        // regardless of how old the job itself is.
        $grouped = $allSheets->groupBy('job_id')
            ->sortByDesc(fn ($sheets) => $sheets->max('created_at'));

        return view('admin.salary-sheets.index', compact('grouped', 'stats', 'isReporter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $promoters = Promoter::with('position')->get();
        $coordinators = Coordinator::all();

        $user = auth()->user();
        $jobQuery = Job::with(['client', 'salarySheets']);
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $jobQuery->where('officer_id', $user->id);
        }
        $jobs = $jobQuery->orderBy('created_at', 'desc')->get();
        $allowances = Allowance::all();
        $reporters = User::role('reporter')->orderBy('name')->get();

        return view('admin.salary-sheets.create', compact('promoters', 'coordinators', 'jobs', 'allowances', 'reporters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug: Log the incoming request data
        Log::info('Salary Sheet Store Request:', $request->all());

        try {
            $job = Job::findOrFail($request->job_id);

            // Prevent creating salary sheets for completed jobs
            if ($job->status === 'completed') {
                return redirect()->back()
                    ->withErrors(['error' => 'Cannot create salary sheets for completed jobs.'])
                    ->withInput();
            }

            // Access control: officers can only create salary sheets for their assigned jobs
            $user = auth()->user();
            if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
                if ((int) $job->officer_id !== (int) $user->id) {
                    abort(403);
                }
            }

            Log::info('Processing rows:', $request->rows ?? []);

            // Create the main salary sheet
            $sheetNumber = SalarySheet::generateSheetNumber();

            $salarySheet = SalarySheet::create([
                'sheet_no'   => $sheetNumber,
                'job_id'     => $request->job_id,
                'status'     => $request->status,
                'location'   => $request->location,
                'start_date' => $request->start_date ?: null,
                'end_date'   => $request->end_date   ?: null,
                'notes'      => $request->notes,
                'created_by' => auth()->id(),
            ]);

            Log::info('Created salary sheet:', $salarySheet->toArray());



            // Process each promoter row
            $createdItems = [];
            foreach ($request->rows as $rowData) {
                if (empty($rowData['promoter_id'])) {
                    continue; // Skip empty rows
                }

                Log::info('Processing row data:', $rowData);
                Log::info('Row attendance data:', ['attendance' => $rowData['attendance'] ?? 'No attendance data']);
                Log::info('Row attendance_total:', ['attendance_total' => $rowData['attendance_total'] ?? 'No attendance_total']);
                Log::info('Row attendance_amount:', ['attendance_amount' => $rowData['attendance_amount'] ?? 'No attendance_amount']);

                // Get promoter to find position
                $promoter = Promoter::find($rowData['promoter_id']);
                if (!$promoter) {
                    Log::warning('Promoter not found:', ['promoter_id' => $rowData['promoter_id']]);
                    continue;
                }

                // Get position_id from form (dropdown) or handle custom position
                $positionId = $rowData['position_id'] ?? null;
                if ($positionId === 'custom' || empty($positionId)) {
                    $customName = trim($rowData['custom_position_name'] ?? '');
                    if ($customName) {
                        $position = PromoterPosition::firstOrCreate(
                            ['position_name' => $customName],
                            ['status' => 'active']
                        );
                        $positionId = $position->id;
                    } else {
                        $positionId = $promoter->position_id;
                    }
                }
                if (!$positionId) {
                    Log::warning('No position assigned:', ['promoter_id' => $rowData['promoter_id']]);
                    continue;
                }

                // Structure attendance data properly
                $attendanceData = [];
                if (isset($rowData['attendance']) && is_array($rowData['attendance'])) {
                    foreach ($rowData['attendance'] as $date => $value) {
                        $attendanceData[$date] = (int) $value;
                    }
                }

                // Create structured attendance data
                $structuredAttendanceData = [
                    'attendance' => $attendanceData,
                    'total' => (int) ($rowData['attendance_total'] ?? 0),
                    'amount' => (float) ($rowData['attendance_amount'] ?? 0)
                ];

                // Create payment data
                $paymentData = [
                    'amount' => (float) ($rowData['amount'] ?? 0),
                    'food_allowance' => (float) ($rowData['food_allowance'] ?? 0),
                    'expenses' => (float) ($rowData['expenses'] ?? 0),
                    'accommodation_allowance' => (float) ($rowData['accommodation_allowance'] ?? 0),
                    'hold_for_weeks' => (float) ($rowData['hold_for_8_weeks'] ?? 0),
                    'net_amount' => 0 // Will be calculated below
                ];

                // Calculate net amount (excluding coordination fee)
                $totalEarnings = $paymentData['amount'] + $paymentData['food_allowance'] +
                                $paymentData['accommodation_allowance'];
                $totalDeductions = $paymentData['expenses'] + $paymentData['hold_for_weeks'];
                $paymentData['net_amount'] = $totalEarnings - $totalDeductions;

                // Create coordinator details
                $coordinatorDetails = null;
                if (!empty($rowData['coordinator_id'])) {
                    $coordinator = Coordinator::find($rowData['coordinator_id']);
                    $coordinatorDetails = [
                        'coordinator_id' => $coordinator->coordinator_id ?? $rowData['coordinator_id'],
                        'current_coordinator' => $coordinator->coordinator_name ?? 'Unknown',
                        'amount' => (float) ($rowData['coordination_fee'] ?? 0)
                    ];
                }

                // Create the salary sheet item
                $itemNumber = EmployersSalarySheetItem::generateItemNumber();

                $item = EmployersSalarySheetItem::create([
                    'no' => $itemNumber,
                    'location' => $rowData['location'] ?? $request->location,
                    'position_id' => $positionId,
                    'promoter_id' => $promoter->id,
                    'attendance_data' => $structuredAttendanceData,
                    'payment_data' => $paymentData,
                    'coordinator_details' => $coordinatorDetails,
                    'job_id' => $request->job_id,
                    'sheet_no' => $salarySheet->sheet_no,
                ]);

                $createdItems[] = $item->no;

                Log::info('Created salary sheet item:', $item->toArray());
                Log::info('Structured attendance data:', $structuredAttendanceData);
                Log::info('Payment data:', $paymentData);
                Log::info('Coordinator details:', $coordinatorDetails ?? []);
            }

            if (empty($createdItems)) {
                Log::warning('No salary sheet items were created');
                return redirect()->back()
                    ->withErrors(['error' => 'No valid salary sheet items were created. Please ensure at least one promoter is selected.'])
                    ->withInput();
            }

            Log::info('Successfully created salary sheet with items:', $createdItems);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Salary sheet created successfully for job ' . $job->job_number . ': ' . $salarySheet->sheet_no,
                    'redirect' => route('admin.salary-sheets.index')
                ]);
            }

            return redirect()->route('admin.salary-sheets.index')
                ->with('success', 'Salary sheet created successfully for job ' . $job->job_number . ': ' . $salarySheet->sheet_no);
        } catch (\Exception $e) {
            Log::error('Error creating salary sheet:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create salary sheet: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withErrors(['error' => 'Failed to create salary sheet: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalarySheet $salarySheet)
    {
        // Access control: officers can only view salary sheets for their assigned jobs
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $salarySheet->loadMissing('job');
            if (!$salarySheet->job || (int) $salarySheet->job->officer_id !== (int) $user->id) {
                abort(403);
            }
        }

        $salarySheet->load(['job.client', 'job.officer', 'job.reporter', 'items.position', 'items.promoter', 'creator']);

        return view('admin.salary-sheets.show', compact('salarySheet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalarySheet $salarySheet)
    {
        // Prevent editing salary sheets with complete, approve, or paid status
        if (in_array($salarySheet->status, ['complete', 'approve', 'paid'])) {
            return redirect()->route('admin.salary-sheets.index')
                ->with('error', 'Cannot edit salary sheets with complete, approve, or paid status.');
        }

        // Access control: officers can only edit salary sheets for their assigned jobs
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $salarySheet->loadMissing('job');
            if (!$salarySheet->job || (int) $salarySheet->job->officer_id !== (int) $user->id) {
                abort(403);
            }
        }

        $promoters = Promoter::with('position')->get();
        $coordinators = Coordinator::all();

        // If officer, only allow selecting jobs assigned to that officer
        // Also exclude jobs with paid/complete salary sheets, except for the current salary sheet's job
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $jobs = Job::with('client')
                ->where('officer_id', $user->id)
                ->where('status', '!=', 'completed')
                ->where(function ($query) use ($salarySheet) {
                    $query->whereDoesntHave('salarySheets', function ($q) {
                        $q->whereIn('status', ['paid', 'complete', 'approve']);
                    })
                    ->orWhere('id', $salarySheet->job_id);
                })
                ->get();
        } else {
            $jobs = Job::with('client')
                ->where('status', '!=', 'completed')
                ->where(function ($query) use ($salarySheet) {
                    $query->whereDoesntHave('salarySheets', function ($q) {
                        $q->whereIn('status', ['paid', 'complete', 'approve']);
                    })
                    ->orWhere('id', $salarySheet->job_id);
                })
                ->get();
        }

        $salarySheet->load(['job.reporter', 'items.position', 'items.promoter']);
        $reporters = User::role('reporter')->orderBy('name')->get();

        // Build jobSalarySheets for edit: one row per item, in the shape loadSalarySheetAsRow expects
        $jobSalarySheets = $salarySheet->items->map(function ($item) {
            $coordinatorId = null;
            if (!empty($item->coordinator_details['coordinator_id'])) {
                $coord = Coordinator::where('coordinator_id', $item->coordinator_details['coordinator_id'])->first();
                if ($coord) {
                    $coordinatorId = $coord->id;
                }
            }
            return [
                'promoter_id' => $item->promoter_id,
                'position_id' => $item->position_id,
                'position_name' => $item->position?->position_name,
                'current_coordinator_id' => $coordinatorId,
                'location' => $item->location ?? '',
                'attendance_data' => $item->attendance_data ?? [],
                'attendance_total' => $item->attendance_data['total'] ?? 0,
                'attendance_amount' => $item->attendance_data['amount'] ?? 0,
                'basic_salary' => $item->payment_data['amount'] ?? 0,
                'expenses' => $item->payment_data['expenses'] ?? 0,
                'hold_for_8_weeks' => $item->payment_data['hold_for_weeks'] ?? 0,
                'net_salary' => $item->payment_data['net_amount'] ?? 0,
                'coordination_fee' => $item->coordinator_details['amount'] ?? 0,
                'position' => $item->position ? [
                    'id' => $item->position->id,
                    'position_name' => $item->position->position_name,
                ] : null,
                'allowances_data' => $item->allowances_data ?? [],
                'payment_data' => $item->payment_data ?? [],
                'coordinator_details' => $item->coordinator_details ?? [],
            ];
        })->values()->all();

        $allowances = Allowance::all();

        // Use the same create view for edit so UI and behavior match
        return view('admin.salary-sheets.create', compact('salarySheet', 'promoters', 'coordinators', 'jobs', 'jobSalarySheets', 'allowances', 'reporters') + ['editSalarySheet' => $salarySheet]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalarySheet $salarySheet)
    {
        // Prevent updating salary sheets with complete, approve, or paid status
        if (in_array($salarySheet->status, ['complete', 'approve', 'paid'])) {
            return redirect()->route('admin.salary-sheets.index')
                ->with('error', 'Cannot update salary sheets with complete, approve, or paid status.');
        }

        // Access control: officers can only update salary sheets for their assigned jobs
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $salarySheet->loadMissing('job');
            if (!$salarySheet->job || (int) $salarySheet->job->officer_id !== (int) $user->id) {
                abort(403);
            }
        }

        $validator = Validator::make($request->all(), [
            'job_id' => 'required|exists:custom_jobs,id',
            'status' => 'required|in:draft,complete,reject,paid,approve',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'reporter_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // If officer, ensure the selected job belongs to the officer
            if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
                $job = Job::findOrFail($request->job_id);
                if ((int) $job->officer_id !== (int) $user->id) {
                    abort(403);
                }
            }

            // Prevent updating salary sheets for completed jobs
            $job = Job::findOrFail($request->job_id);
            if ($job->status === 'completed') {
                return redirect()->back()
                    ->withErrors(['error' => 'Cannot update salary sheets for completed jobs.'])
                    ->withInput();
            }

            $salarySheet->update([
                'job_id'     => $request->job_id,
                'status'     => $request->status,
                'location'   => $request->location,
                'start_date' => $request->start_date ?: null,
                'end_date'   => $request->end_date   ?: null,
                'notes'      => $request->notes,
            ]);

            // Send email to the job's reporter when status is complete
            $reporterMailWarning = null;
            if ($request->status === 'complete') {
                $reporterMailWarning = $this->sendCompleteNotificationToReporters($salarySheet, $request->reporter_id);
            }

            // Process rows when present (same structure as create/enforce)
            $rows = $request->rows ?? [];
            if (!empty($rows)) {
                EmployersSalarySheetItem::where('sheet_no', $salarySheet->sheet_no)->delete();
                $jobId = (int) $request->job_id;
                foreach ($rows as $rowIndex => $rowData) {
                    if (empty($rowData['promoter_id'])) {
                        continue;
                    }
                    $promoter = Promoter::find($rowData['promoter_id']);
                    if (!$promoter) {
                        continue;
                    }
                    $positionId = $rowData['position_id'] ?? null;
                    if ($positionId === 'custom' || empty($positionId)) {
                        $customName = trim($rowData['custom_position_name'] ?? '');
                        if ($customName) {
                            $pos = PromoterPosition::firstOrCreate(
                                ['position_name' => $customName],
                                ['status' => 'active']
                            );
                            $positionId = $pos->id;
                        } else {
                            $positionId = $promoter->position_id;
                        }
                    }
                    if (!$positionId) {
                        continue;
                    }
                    $attendanceData = [];
                    if (isset($rowData['attendance']) && is_array($rowData['attendance'])) {
                        foreach ($rowData['attendance'] as $date => $value) {
                            $attendanceData[$date] = $value === null ? 0 : (int) $value;
                        }
                    }
                    $structuredAttendanceData = [
                        'attendance' => $attendanceData,
                        'total' => (int) ($rowData['attendance_total'] ?? 0),
                        'amount' => (float) ($rowData['attendance_amount'] ?? 0),
                        'promoter_id' => $rowData['promoter_id'],
                        'promoter_name' => $rowData['promoter_name'] ?? 'Unknown',
                        'position' => $rowData['position'] ?? 'Unknown'
                    ];
                    $paymentData = [
                        'amount' => (float) ($rowData['amount'] ?? 0),
                        'food_allowance' => (float) ($rowData['food_allowance'] ?? 0),
                        'expenses' => (float) ($rowData['expenses'] ?? 0),
                        'accommodation_allowance' => (float) ($rowData['accommodation_allowance'] ?? 0),
                        'hold_for_weeks' => (float) ($rowData['hold_for_8_weeks'] ?? 0),
                        'net_amount' => (float) ($rowData['net_amount'] ?? 0)
                    ];
                    $coordinatorDetails = null;
                    if (!empty($rowData['coordinator_id'])) {
                        $coord = Coordinator::find($rowData['coordinator_id']);
                        $coordinatorDetails = [
                            'coordinator_id' => $coord->coordinator_id ?? $rowData['coordinator_id'],
                            'current_coordinator' => $coord->coordinator_name ?? $rowData['current_coordinator'] ?? 'Unknown',
                            'amount' => (float) ($rowData['coordination_fee'] ?? 0)
                        ];
                    }
                    EmployersSalarySheetItem::create([
                        'no' => EmployersSalarySheetItem::generateItemNumber(),
                        'location' => $rowData['location'] ?? $request->location,
                        'position_id' => $positionId,
                        'promoter_id' => $promoter->id,
                        'attendance_data' => $structuredAttendanceData,
                        'payment_data' => $paymentData,
                        'coordinator_details' => $coordinatorDetails,
                        'job_id' => $jobId,
                        'sheet_no' => $salarySheet->sheet_no,
                        'allowances_data' => $rowData['allowances'] ?? null,
                    ]);
                }
            }

            $redirect = redirect()->route('admin.salary-sheets.index')
                ->with('success', 'Salary sheet updated successfully.');

            if ($reporterMailWarning) {
                $redirect->with('warning', $reporterMailWarning);
            }

            return $redirect;
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update salary sheet: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalarySheet $salarySheet)
    {
        // Access control: officers can only delete salary sheets for their assigned jobs
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $salarySheet->loadMissing('job');
            if (!$salarySheet->job || (int) $salarySheet->job->officer_id !== (int) $user->id) {
                abort(403);
            }
        }

        try {
        $salarySheet->delete();

        return redirect()->route('admin.salary-sheets.index')
                ->with('success', 'Salary sheet deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete salary sheet: ' . $e->getMessage()]);
        }
    }

    /**
     * Duplicate a salary sheet with a new sheet number.
     */
    public function duplicate(Request $request, SalarySheet $salarySheet)
    {
        $request->validate([
            'sheet_no' => 'required|string|max:50|unique:salary_sheet,sheet_no',
        ]);

        try {
            \DB::beginTransaction();

            $newSheet = SalarySheet::create([
                'sheet_no'   => $request->sheet_no,
                'job_id'     => $salarySheet->job_id,
                'status'     => 'draft',
                'location'   => $salarySheet->location,
                'notes'      => $salarySheet->notes,
                'created_by' => auth()->id(),
            ]);

            foreach ($salarySheet->items as $item) {
                EmployersSalarySheetItem::create([
                    'no'                  => EmployersSalarySheetItem::generateItemNumber(),
                    'sheet_no'            => $newSheet->sheet_no,
                    'job_id'              => $item->job_id,
                    'promoter_id'         => $item->promoter_id,
                    'position_id'         => $item->position_id,
                    'location'            => $item->location,
                    'attendance_data'     => $item->attendance_data,
                    'payment_data'        => $item->payment_data,
                    'coordinator_details' => $item->coordinator_details,
                    'allowances_data'     => $item->allowances_data,
                ]);
            }

            \DB::commit();

            return response()->json([
                'success'  => true,
                'message'  => 'Salary sheet duplicated successfully.',
                'sheet_id' => $newSheet->id,
                'sheet_no' => $newSheet->sheet_no,
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get salary sheets by job ID (AJAX endpoint)
     */
    public function getByJob($jobId)
    {
        try {
            // Access control: officers can only fetch salary sheets for their assigned jobs
            $user = auth()->user();
            if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
                $job = Job::findOrFail($jobId);
                if ((int) $job->officer_id !== (int) $user->id) {
                    abort(403);
                }
            }

            $salarySheets = SalarySheet::with([
                    'job',
                    'items:id,sheet_no,attendance_data',  // only needed for custom-date extraction
                ])
                ->withCount('items')
                ->where('job_id', $jobId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'salarySheets' => $salarySheets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch salary sheets: ' . $e->getMessage()
            ], 500);
        }
    }

    public function enforce(Request $request)
    {
        // Debug: Log the incoming request data
        Log::info('Salary Sheet Enforce Request:', $request->all());

        try {
            $job = Job::findOrFail($request->job_id);

            // Prevent enforcing salary sheets for completed jobs
            if ($job->status === 'completed') {
                return redirect()->back()
                    ->withErrors(['error' => 'Cannot enforce salary sheets for completed jobs.'])
                    ->withInput();
            }

            // Access control: officers can only create/update salary sheets for their assigned jobs
            $user = auth()->user();
            if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
                if ((int) $job->officer_id !== (int) $user->id) {
                    abort(403);
                }
            }

            Log::info('Processing rows:', $request->rows ?? []);

            // SALARY_SHEET TABLE LOGIC: Always INSERT a new sheet.
            // Multiple salary sheets per job are supported.
            $maxRetries = 3;
            $retryCount = 0;
            $salarySheet = null;

            while ($retryCount < $maxRetries && !$salarySheet) {
                try {
                    $sheetNumber = SalarySheet::generateSheetNumber();

                    $salarySheet = SalarySheet::create([
                        'sheet_no' => $sheetNumber,
                        'job_id'   => $request->job_id,
                        'status'   => $request->status,
                        'location' => $request->location,
                        'notes'    => $request->notes,
                        'created_by' => auth()->id(),
                    ]);

                    Log::info('Created new salary sheet for job_id:', [
                        'job_id'   => $request->job_id,
                        'sheet_no' => $sheetNumber,
                    ]);
                    break;

                } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
                    $retryCount++;
                    Log::warning("Duplicate sheet number, retry {$retryCount}/{$maxRetries}: {$sheetNumber}");
                    if ($retryCount >= $maxRetries) {
                        throw new \Exception("Failed to generate unique sheet number after {$maxRetries} attempts");
                    }
                    usleep(100000);
                }
            }

            // EMPLOYERS_SALARY_SHEET_ITEM TABLE LOGIC: Always remove all items with same sheet_no, then insert everything fresh
            // This ensures clean data without duplicates or orphaned records

            $deletedItemsCount = EmployersSalarySheetItem::where('sheet_no', $salarySheet->sheet_no)->delete();
            Log::info('Removed existing salary sheet items:', [
                'sheet_no' => $salarySheet->sheet_no,
                'deleted_count' => $deletedItemsCount
            ]);

            // Process each promoter row
            $createdItems = [];

            // Debug: Check if salarySheet is properly set
            if (!$salarySheet || !$salarySheet->sheet_no) {
                Log::error('SalarySheet is null or sheet_no is empty:', [
                    'salarySheet' => $salarySheet ? $salarySheet->toArray() : 'null',
                ]);
                throw new \Exception('SalarySheet is not properly initialized');
            }

            Log::info('Processing salary sheet items for sheet_no:', ['sheet_no' => $salarySheet->sheet_no]);

            foreach ($request->rows as $rowIndex => $rowData) {
                if (empty($rowData['promoter_id'])) {
                    continue; // Skip empty rows
                }

                Log::info('Processing row data:', $rowData);

                // Get promoter to find position
                $promoter = Promoter::find($rowData['promoter_id']);
                if (!$promoter) {
                    Log::warning('Promoter not found:', ['promoter_id' => $rowData['promoter_id']]);
                    continue;
                }

                // Get position_id from form (dropdown) or handle custom position
                $positionId = $rowData['position_id'] ?? null;
                if ($positionId === 'custom' || empty($positionId)) {
                    $customName = trim($rowData['custom_position_name'] ?? '');
                    if ($customName) {
                        $position = PromoterPosition::firstOrCreate(
                            ['position_name' => $customName],
                            ['status' => 'active']
                        );
                        $positionId = $position->id;
                    } else {
                        $positionId = $promoter->position_id;
                    }
                }
                if (!$positionId) {
                    Log::warning('No position assigned:', ['promoter_id' => $rowData['promoter_id']]);
                    continue;
                }

                // Structure attendance data properly - handle null values
                $attendanceData = [];
                if (isset($rowData['attendance']) && is_array($rowData['attendance'])) {
                    foreach ($rowData['attendance'] as $date => $value) {
                        // Convert null to 0, and ensure it's an integer
                        $attendanceData[$date] = $value === null ? 0 : (int) $value;
                    }
                }

                // Create structured attendance data with promoter information
                $structuredAttendanceData = [
                    'attendance' => $attendanceData,
                    'total' => (int) ($rowData['attendance_total'] ?? 0),
                    'amount' => (float) ($rowData['attendance_amount'] ?? 0),
                    'promoter_id' => $rowData['promoter_id'],
                    'promoter_name' => $rowData['promoter_name'] ?? 'Unknown',
                    'position' => $rowData['position'] ?? 'Unknown'
                ];

                // Create payment data
                $paymentData = [
                    'amount' => (float) ($rowData['amount'] ?? 0),
                    'food_allowance' => (float) ($rowData['food_allowance'] ?? 0),
                    'expenses' => (float) ($rowData['expenses'] ?? 0),
                    'accommodation_allowance' => (float) ($rowData['accommodation_allowance'] ?? 0),
                    'hold_for_weeks' => (float) ($rowData['hold_for_8_weeks'] ?? 0),
                    'net_amount' => (float) ($rowData['net_amount'] ?? 0)
                ];

                // Create coordinator details
                $coordinatorDetails = null;
                if (!empty($rowData['coordinator_id'])) {
                    $coordinator = Coordinator::find($rowData['coordinator_id']);
                    $coordinatorDetails = [
                        'coordinator_id' => $coordinator->coordinator_id ?? $rowData['coordinator_id'],
                        'current_coordinator' => $coordinator->coordinator_name ?? $rowData['current_coordinator'] ?? 'Unknown',
                        'amount' => (float) ($rowData['coordination_fee'] ?? 0)
                    ];
                }

                // Create the salary sheet item
                $itemNumber = EmployersSalarySheetItem::generateItemNumber();

                $item = EmployersSalarySheetItem::create([
                    'no' => $itemNumber,
                    'location' => $rowData['location'] ?? $request->location,
                    'position_id' => $positionId,
                    'promoter_id' => $promoter->id,
                    'attendance_data' => $structuredAttendanceData,
                    'payment_data' => $paymentData,
                    'coordinator_details' => $coordinatorDetails,
                    'job_id' => $request->job_id,
                    'sheet_no' => $salarySheet->sheet_no,
                    'allowances_data' => $rowData['allowances'] ?? null,
                ]);

                $createdItems[] = $item->no;

                Log::info('Created salary sheet item:', $item->toArray());
            }

            if (empty($createdItems)) {
                Log::warning('No salary sheet items were created');
                return redirect()->back()
                    ->withErrors(['error' => 'No valid salary sheet items were created. Please ensure at least one promoter is selected.'])
                    ->withInput();
            }

            Log::info('Successfully processed salary sheet with items:', $createdItems);

            $action = 'created';

            // Send email notification to the job's reporter if status is 'complete'
            $reporterMailWarning = null;
            if ($request->status === 'complete') {
                $reporterMailWarning = $this->sendCompleteNotificationToReporters($salarySheet, $request->reporter_id);
            }

            $redirect = redirect()->route('admin.salary-sheets.index')
                ->with('success', 'Salary sheet ' . $action . ' successfully for job ' . $job->job_number . ': ' . $salarySheet->sheet_no);

            if ($reporterMailWarning) {
                $redirect->with('warning', $reporterMailWarning);
            }

            return $redirect;
        } catch (\Exception $e) {
            Log::error('Error processing salary sheet:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $action = 'create';
            return redirect()->back()
                ->withErrors(['error' => 'Failed to ' . $action . ' salary sheet: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Print salary sheet
     */
    public function print(SalarySheet $salarySheet)
    {
        // Access control: officers can only print salary sheets for their assigned jobs
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $salarySheet->loadMissing('job');
            if (!$salarySheet->job || (int) $salarySheet->job->officer_id !== (int) $user->id) {
                abort(403);
            }
        }

        $salarySheet->load(['job.client', 'job.officer', 'job.reporter', 'items.position']);

        return view('admin.salary-sheets.print', compact('salarySheet'));
    }

    /**
     * Generate JSON data for salary sheet (API endpoint)
     */
    public function generateJsonData($salarySheetId)
    {
        try {
            $salarySheet = SalarySheet::with(['job', 'items.position'])
                ->findOrFail($salarySheetId);

            Log::info('Generating JSON data for salary sheet:', $salarySheet->toArray());

            // Base data structure
            $jsonData = [
                '_token' => csrf_token(),
                'salary_sheet_id' => $salarySheet->id,
                'sheet_number' => $salarySheet->sheet_no,
                'job_id' => (string) $salarySheet->job_id,
                'status' => $salarySheet->status,
                'location' => $salarySheet->location,
                'start_date' => $salarySheet->start_date?->format('Y-m-d'),
                'end_date'   => $salarySheet->end_date?->format('Y-m-d'),
                'rows' => [],
                'notes' => $salarySheet->notes
            ];

            // Process each item
            foreach ($salarySheet->items as $index => $item) {
                $rowIndex = $index + 1; // Start from 1, not 0

                // Extract attendance data
                $attendanceData = [];
                if (isset($item->attendance_data['attendance']) && is_array($item->attendance_data['attendance'])) {
                    foreach ($item->attendance_data['attendance'] as $date => $value) {
                        // Convert 0 to null for consistency with your format
                        $attendanceData[$date] = $value == 0 ? null : (string) $value;
                    }
                }

                // Extract payment data
                $paymentData = $item->payment_data ?? [];

                // Extract coordinator data and find the correct coordinator ID
                $coordinatorData = $item->coordinator_details ?? [];
                $coordinatorDatabaseId = null;

                if (!empty($coordinatorData['coordinator_id'])) {
                    // Find coordinator by their custom ID to get the database ID
                    $coordinator = Coordinator::where('coordinator_id', $coordinatorData['coordinator_id'])->first();
                    if ($coordinator) {
                        $coordinatorDatabaseId = $coordinator->id;
                    }
                }

                // Extract allowances data
                $allowancesData = $item->allowances_data ?? [];

                // Build row data
                $rowData = [
                    'location' => $item->location,
                    'promoter_id' => (string) ($item->attendance_data['promoter_id'] ?? ''),
                    'promoter_name' => $item->attendance_data['promoter_name'] ?? '',
                    'position_id' => (string) ($item->position_id ?? ''),
                    'position' => $item->attendance_data['position'] ?? ($item->position->position_name ?? ''),
                    'attendance' => $attendanceData,
                    'attendance_total' => (string) ($item->attendance_data['total'] ?? 0),
                    'attendance_amount' => (float)$item->attendance_data['amount'] ?? 0,
                    'amount' => (float) $paymentData['amount'] ?? 0,
                    'food_allowance' => $paymentData['food_allowance'] ?? 0,
                    'expenses' => $paymentData['expenses'] ?? 0,
                    'accommodation_allowance' => $paymentData['accommodation_allowance'] ?? 0,
                    'hold_for_8_weeks' => $paymentData['hold_for_weeks'] ?? 0,
                    'net_amount' => (float) $paymentData['net_amount'] ?? 0,
                    'coordinator_id' => $coordinatorDatabaseId,
                    'current_coordinator' => $coordinatorData['current_coordinator'] ?? null,
                    'coordination_fee' => $coordinatorData['amount'] ?? null,
                    'allowances' => $allowancesData
                ];

                // Convert null values to null (not empty strings)
                foreach ($rowData as $key => $value) {
                    if ($value === '' || $value === '0.00') {
                        $rowData[$key] = null;
                    }
                }

                $jsonData['rows'][(string) $rowIndex] = $rowData;
            }

            Log::info('Generated JSON data:', $jsonData);

            return response()->json($jsonData);

        } catch (\Exception $e) {
            Log::error('Error generating JSON data:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to generate JSON data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Approve a salary sheet (change status from complete to approve)
     * Only accessible by reporter role
     */
    public function approve(Request $request, SalarySheet $salarySheet)
    {
        try {
            $user = auth()->user();

            // Check if user has reporter role
            if (!$user || !method_exists($user, 'hasRole') || !$user->hasRole('reporter')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only reporters can approve salary sheets.'
                ], 403);
            }

            // Check if salary sheet status is 'complete'
            if ($salarySheet->status !== 'complete') {
                return response()->json([
                    'success' => false,
                    'message' => 'Only salary sheets with "complete" status can be approved.'
                ], 400);
            }

            // Update status to 'approve'
            $salarySheet->update([
                'status' => 'approve'
            ]);

            Log::info('Salary sheet approved:', [
                'sheet_no' => $salarySheet->sheet_no,
                'approved_by' => $user->id,
                'approved_at' => now()
            ]);

            // Send email notification to officer
            $this->sendApprovalNotificationToOfficer($salarySheet, $user);

            return response()->json([
                'success' => true,
                'message' => 'Salary sheet ' . $salarySheet->sheet_no . ' has been approved successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error approving salary sheet:', [
                'sheet_id' => $salarySheet->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to approve salary sheet: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Approve a salary sheet via a signed URL from email.
     * No login required — the signed URL is the authentication.
     */
    public function approveViaEmail(Request $request, SalarySheet $salarySheet)
    {
        $salarySheet->load(['job.client', 'job.officer', 'job.reporter']);

        if ($salarySheet->status !== 'complete') {
            return view('emails.approval-result', [
                'success'     => false,
                'salarySheet' => $salarySheet,
                'message'     => 'This salary sheet has already been processed.',
                'subMessage'  => 'Current status: ' . ucfirst($salarySheet->status),
            ]);
        }

        $salarySheet->update(['status' => 'approve']);

        Log::info('Salary sheet approved via email link:', [
            'sheet_no'    => $salarySheet->sheet_no,
            'approved_at' => now(),
        ]);

        $this->sendApprovalNotificationToOfficer($salarySheet);

        return view('emails.approval-result', [
            'success'     => true,
            'salarySheet' => $salarySheet,
            'message'     => 'Salary sheet approved successfully!',
            'subMessage'  => 'Sheet ' . $salarySheet->sheet_no . ' is now marked as Approved.',
        ]);
    }

    /**
     * Decline a salary sheet via a signed URL from email.
     * No login required — the signed URL is the authentication.
     * GET shows a reason form; POST (submitted back to the same signed URL) processes the decline
     * and notifies the job's officer and all admins with the reason.
     */
    public function declineViaEmail(Request $request, SalarySheet $salarySheet)
    {
        $salarySheet->load(['job.client', 'job.officer', 'job.reporter']);

        if ($salarySheet->status !== 'complete') {
            return view('emails.decline-result', [
                'success'     => false,
                'salarySheet' => $salarySheet,
                'message'     => 'This salary sheet has already been processed.',
                'subMessage'  => 'Current status: ' . ucfirst($salarySheet->status),
            ]);
        }

        if ($request->isMethod('get')) {
            return view('emails.decline-form', [
                'salarySheet' => $salarySheet,
                'actionUrl'   => $request->fullUrl(),
            ]);
        }

        $validated = $request->validate([
            'reason' => 'required|string|max:2000',
        ]);

        $salarySheet->update([
            'status'         => 'reject',
            'decline_reason' => $validated['reason'],
        ]);

        Log::info('Salary sheet declined via email link:', [
            'sheet_no'   => $salarySheet->sheet_no,
            'reason'     => $validated['reason'],
            'declined_at' => now(),
        ]);

        $this->sendDeclineNotificationToOfficerAndAdmin($salarySheet, $validated['reason']);

        return view('emails.decline-result', [
            'success'     => true,
            'salarySheet' => $salarySheet,
            'message'     => 'Salary sheet declined.',
            'subMessage'  => 'Sheet ' . $salarySheet->sheet_no . ' has been marked as Rejected. The officer and admin have been notified with your reason.',
        ]);
    }

    /**
     * Send email notification when salary sheet status is complete.
     *
     * Resolution order for the recipient:
     *  1. $selectedReporterId, if given (from the "Save Salary Sheet" modal's reporter dropdown).
     *     If the job has no reporter assigned yet, this selection is also saved as the
     *     job's assigned reporter.
     *  2. The job's already-assigned reporter otherwise.
     *
     * @return string|null A user-facing warning message if the mail could NOT be sent, null on success.
     */
    private function sendCompleteNotificationToReporters(SalarySheet $salarySheet, $selectedReporterId = null): ?string
    {
        try {
            $mailDriver = config('mail.default');

            if ($mailDriver === 'log') {
                Log::warning('Mail driver is set to "log" - emails will be logged but not actually sent. Change MAIL_MAILER to "smtp" in .env to send real emails.');
            }

            Log::info('=== SALARY SHEET COMPLETE EMAIL NOTIFICATION START ===');

            $salarySheet->load(['job.client', 'job.officer', 'job.reporter', 'creator']);
            $job = $salarySheet->job;

            if (!$job) {
                Log::warning('No job found for salary sheet complete notification', [
                    'sheet_no' => $salarySheet->sheet_no,
                    'job_id' => $salarySheet->job_id,
                ]);
                return 'Cannot send reporter approval mail because the salary sheet has no associated job.';
            }

            $reporter = null;

            if (!empty($selectedReporterId)) {
                $reporter = User::find($selectedReporterId);

                // If the job doesn't have a reporter yet, assign the selected one.
                if ($reporter && !$job->reporter_id) {
                    $job->reporter_id = $reporter->id;
                    $job->save();
                }
            }

            // Fall back to the job's assigned reporter when none was explicitly selected.
            if (!$reporter) {
                $reporter = $job->reporter;
            }

            if (!$reporter) {
                Log::warning('No reporter assigned to job for salary sheet complete notification', [
                    'sheet_no' => $salarySheet->sheet_no,
                    'job_id' => $salarySheet->job_id,
                ]);
                return 'Cannot send reporter approval mail because the job reporter is not assigned.';
            }

            if (!$reporter->email) {
                Log::warning('Reporter has no email - cannot send complete notification', [
                    'sheet_no' => $salarySheet->sheet_no,
                    'reporter_id' => $reporter->id,
                ]);
                return "Cannot send reporter approval mail because reporter \"{$reporter->name}\" has no email address on file.";
            }

            Log::info('Sending salary sheet complete notification to job reporter', [
                'sheet_no' => $salarySheet->sheet_no,
                'job_number' => $job->job_number,
                'reporter_email' => $reporter->email,
            ]);

            Mail::to($reporter->email)->queue(new SalarySheetCompleteNotification($salarySheet));

            Log::info('Salary sheet complete notification queued for reporter', [
                'sheet_no' => $salarySheet->sheet_no,
                'reporter_email' => $reporter->email,
            ]);
            Log::info('=== SALARY SHEET COMPLETE EMAIL NOTIFICATION END ===');

            return null;
        } catch (\Exception $e) {
            Log::error('Failed to send salary sheet complete notification', [
                'sheet_no' => $salarySheet->sheet_no ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return 'Cannot send reporter approval mail due to an unexpected error: ' . $e->getMessage();
        }
    }

    /**
     * Send email notification when salary sheet is approved.
     * Sends to: job's assigned officer AND all admin users.
     */
    private function sendApprovalNotificationToOfficer(SalarySheet $salarySheet, $approvedBy = null)
    {
        try {
            $mailDriver = config('mail.default');

            if ($mailDriver === 'log') {
                Log::warning('Mail driver is set to "log" - emails will be logged but not actually sent. Change MAIL_MAILER to "smtp" in .env to send real emails.');
            }

            Log::info('=== SALARY SHEET APPROVAL EMAIL NOTIFICATION START ===');

            $salarySheet->load(['job.officer', 'job.reporter']);

            $recipientEmails = [];

            // 1. All admin users
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                if ($admin->email) {
                    $recipientEmails[$admin->email] = true;
                }
            }

            // 2. Job's assigned officer (if any)
            if ($salarySheet->job && $salarySheet->job->officer) {
                $officer = $salarySheet->job->officer;
                if ($officer->email) {
                    $recipientEmails[$officer->email] = true;
                }
            }

            $toAddresses = array_keys($recipientEmails);

            if (empty($toAddresses)) {
                Log::warning('No recipients for salary sheet approval notification', [
                    'sheet_no' => $salarySheet->sheet_no,
                    'job_id' => $salarySheet->job_id,
                ]);
                return;
            }

            Log::info('Sending salary sheet approval notification to officer and admins', [
                'sheet_no' => $salarySheet->sheet_no,
                'job_number' => $salarySheet->job?->job_number,
                'recipients' => $toAddresses,
            ]);

            Mail::to($toAddresses)->queue(new SalarySheetApprovedNotification($salarySheet, $approvedBy));

            Log::info('Salary sheet approval notification queued', [
                'sheet_no' => $salarySheet->sheet_no,
                'recipient_count' => count($toAddresses),
            ]);
            Log::info('=== SALARY SHEET APPROVAL EMAIL NOTIFICATION END ===');
        } catch (\Exception $e) {
            Log::error('Failed to send salary sheet approval notification', [
                'sheet_no' => $salarySheet->sheet_no ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Send email notification when a salary sheet is declined by the reporter.
     * Sends to: job's assigned officer AND all admin users.
     */
    private function sendDeclineNotificationToOfficerAndAdmin(SalarySheet $salarySheet, string $reason)
    {
        try {
            $mailDriver = config('mail.default');

            if ($mailDriver === 'log') {
                Log::warning('Mail driver is set to "log" - emails will be logged but not actually sent. Change MAIL_MAILER to "smtp" in .env to send real emails.');
            }

            Log::info('=== SALARY SHEET DECLINE EMAIL NOTIFICATION START ===');

            $salarySheet->load(['job.officer', 'job.reporter']);

            $recipientEmails = [];

            // 1. All admin users
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                if ($admin->email) {
                    $recipientEmails[$admin->email] = true;
                }
            }

            // 2. Job's assigned officer (if any)
            if ($salarySheet->job && $salarySheet->job->officer) {
                $officer = $salarySheet->job->officer;
                if ($officer->email) {
                    $recipientEmails[$officer->email] = true;
                }
            }

            $toAddresses = array_keys($recipientEmails);

            if (empty($toAddresses)) {
                Log::warning('No recipients for salary sheet decline notification', [
                    'sheet_no' => $salarySheet->sheet_no,
                    'job_id' => $salarySheet->job_id,
                ]);
                return;
            }

            Log::info('Sending salary sheet decline notification to officer and admins', [
                'sheet_no' => $salarySheet->sheet_no,
                'job_number' => $salarySheet->job?->job_number,
                'recipients' => $toAddresses,
            ]);

            Mail::to($toAddresses)->queue(new SalarySheetDeclinedNotification($salarySheet, $reason));

            Log::info('Salary sheet decline notification queued', [
                'sheet_no' => $salarySheet->sheet_no,
                'recipient_count' => count($toAddresses),
            ]);
            Log::info('=== SALARY SHEET DECLINE EMAIL NOTIFICATION END ===');
        } catch (\Exception $e) {
            Log::error('Failed to send salary sheet decline notification', [
                'sheet_no' => $salarySheet->sheet_no ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Export salary sheet to Excel
     */
    public function export(SalarySheet $salarySheet)
    {
        // Access control: officers can only export salary sheets for their assigned jobs
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $salarySheet->loadMissing('job');
            if (!$salarySheet->job || (int) $salarySheet->job->officer_id !== (int) $user->id) {
                abort(403);
            }
        }

        $salarySheet->load(['job.client', 'items.position']);

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Salary Management System')
            ->setTitle('Salary Sheet - ' . $salarySheet->sheet_no)
            ->setSubject('Salary Sheet Export')
            ->setDescription('Exported salary sheet data');

        // Header Information
        $row = 1;
        $sheet->setCellValue('A' . $row, 'SALARY SHEET');
        $sheet->getStyle('A' . $row)->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A1:D1');

        $row++;
        $sheet->setCellValue('A' . $row, 'Sheet Number:');
        $sheet->setCellValue('B' . $row, $salarySheet->sheet_no);
        $sheet->getStyle('A' . $row . ':B' . $row)->getFont()->setBold(true);

        $row++;
        $sheet->setCellValue('A' . $row, 'Status:');
        $sheet->setCellValue('B' . $row, ucfirst($salarySheet->status));

        $row++;
        $sheet->setCellValue('A' . $row, 'Date:');
        $sheet->setCellValue('B' . $row, $salarySheet->created_at->format('Y-m-d'));

        if ($salarySheet->job) {
            $row++;
            $sheet->setCellValue('A' . $row, 'Job Number:');
            $sheet->setCellValue('B' . $row, $salarySheet->job->job_number ?? 'N/A');

            if ($salarySheet->job->client) {
                $row++;
                $sheet->setCellValue('A' . $row, 'Client:');
                $sheet->setCellValue('B' . $row, $salarySheet->job->client->name ?? 'N/A');
            }
        }

        if ($salarySheet->location) {
            $row++;
            $sheet->setCellValue('A' . $row, 'Location:');
            $sheet->setCellValue('B' . $row, $salarySheet->location);
        }

        // Load promoters data for bank details
        $promoterIds = [];
        if ($salarySheet->items->count() > 0) {
            foreach ($salarySheet->items as $item) {
                if (isset($item->attendance_data['promoter_id']) && !empty($item->attendance_data['promoter_id'])) {
                    $promoterIds[] = $item->attendance_data['promoter_id'];
                }
            }
        }
        $promoterIds = array_unique($promoterIds);
        $promoters = !empty($promoterIds) ? Promoter::whereIn('id', $promoterIds)->get()->keyBy('id') : collect();

        // Collect all attendance dates
        $allAttendanceDates = [];
        $dynamicAllowances = [];

        if ($salarySheet->items->count() > 0) {
            foreach ($salarySheet->items as $item) {
                if (isset($item->attendance_data['attendance']) && is_array($item->attendance_data['attendance'])) {
                    $dates = array_keys($item->attendance_data['attendance']);
                    $allAttendanceDates = array_merge($allAttendanceDates, $dates);
                }
            }
            $allAttendanceDates = array_unique($allAttendanceDates);
            sort($allAttendanceDates);

            // Extract dynamic allowances from job
            if ($salarySheet->job && isset($salarySheet->job->allowance) && is_array($salarySheet->job->allowance)) {
                $dynamicAllowances = $salarySheet->job->allowance;
            }
        }

        // Table Headers
        $row += 2;
        $startRow = $row;
        $col = 'A';

        // Header row 1
        $headers = ['Item #', 'Location', 'Position', 'Promoter', 'Bank Name', 'Bank Branch', 'Bank Account Number'];

        // Add attendance date columns
        foreach ($allAttendanceDates as $date) {
            $headers[] = \Carbon\Carbon::parse($date)->format('M d');
        }

        $headers[] = 'Total Days';
        $headers[] = 'Attendance Amount';
        $headers[] = 'Base Amount';

        // Add dynamic allowance columns
        foreach ($dynamicAllowances as $allowance) {
            $headers[] = $allowance['allowance_name'] ?? 'Allowance';
        }

        $headers[] = 'Expenses';
        $headers[] = 'Hold for Weeks';
        $headers[] = 'Net Amount';
        $headers[] = 'Coordinator';
        $headers[] = 'Coordination Fee';

        // Write headers
        $colIndex = 1;
        foreach ($headers as $header) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
            $sheet->setCellValue($colLetter . $row, $header);
            $sheet->getStyle($colLetter . $row)->getFont()->setBold(true);
            $sheet->getStyle($colLetter . $row)->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setRGB('4472C4');
            $sheet->getStyle($colLetter . $row)->getFont()->getColor()->setRGB('FFFFFF');
            $sheet->getStyle($colLetter . $row)->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);
            $sheet->getStyle($colLetter . $row)->getBorders()->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);
            $colIndex++;
        }

        // Calculate total columns (Item, Location, Position, Promoter, Bank Name, Bank Branch, Bank Account + Attendance dates + Total Days, Att Amount, Base Amount + Allowances + Expenses, Hold, Net, Coordinator, Coord Fee)
        $totalColumns = 7 + count($allAttendanceDates) + 3 + count($dynamicAllowances) + 4;
        $lastColLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($totalColumns);

        // Data rows
        $row++;
        $itemNumber = 1;
        foreach ($salarySheet->items as $item) {
            $colIndex = 1;

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $item->no);

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $item->location ?? 'N/A');

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $item->position->position_name ?? 'N/A');

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $item->attendance_data['promoter_name'] ?? 'N/A');

            // Bank details - get from promoter data
            $promoterId = isset($item->attendance_data['promoter_id']) ? $item->attendance_data['promoter_id'] : null;
            $promoter = $promoterId && isset($promoters[$promoterId]) ? $promoters[$promoterId] : null;

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $promoter ? ($promoter->bank_name ?? 'N/A') : 'N/A');

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $promoter ? ($promoter->bank_branch_name ?? 'N/A') : 'N/A');

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $promoter ? ($promoter->bank_account_number ?? 'N/A') : 'N/A');

            // Attendance dates
            foreach ($allAttendanceDates as $date) {
                $attendanceValue = isset($item->attendance_data['attendance'][$date]) ? $item->attendance_data['attendance'][$date] : 0;
                $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
                $sheet->setCellValue($colLetter . $row, $attendanceValue > 0 ? 'P' : 'A');
            }

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $item->attendance_data['total'] ?? 0);

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, number_format($item->attendance_data['amount'] ?? 0, 2));

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, number_format($item->payment_data['amount'] ?? 0, 2));

            // Dynamic allowances
            foreach ($dynamicAllowances as $allowance) {
                $allowanceName = $allowance['allowance_name'] ?? '';
                $allowanceValue = 0;
                if (isset($item->allowances_data) && is_array($item->allowances_data) && isset($item->allowances_data[$allowanceName])) {
                    $allowanceValue = $item->allowances_data[$allowanceName];
                }
                $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
                $sheet->setCellValue($colLetter . $row, number_format($allowanceValue, 2));
            }

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, number_format($item->payment_data['expenses'] ?? 0, 2));

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, number_format($item->payment_data['hold_for_weeks'] ?? 0, 2));

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, number_format($item->payment_data['net_amount'] ?? 0, 2));

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, $item->coordinator_details['current_coordinator'] ?? 'N/A');

            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++);
            $sheet->setCellValue($colLetter . $row, number_format($item->coordinator_details['amount'] ?? 0, 2));

            // Apply borders to data row
            for ($c = 1; $c <= $totalColumns; $c++) {
                $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($c);
                $sheet->getStyle($colLetter . $row)->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            }

            $row++;
            $itemNumber++;
        }

        // Auto-size columns
        for ($c = 1; $c <= $totalColumns; $c++) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($c);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        // Set column widths for better readability (override auto-size for key columns)
        $sheet->getColumnDimension('A')->setWidth(10); // Item #
        $sheet->getColumnDimension('B')->setWidth(15); // Location
        $sheet->getColumnDimension('C')->setWidth(20); // Position
        $sheet->getColumnDimension('D')->setWidth(25); // Promoter
        $sheet->getColumnDimension('E')->setWidth(20); // Bank Name
        $sheet->getColumnDimension('F')->setWidth(20); // Bank Branch
        $sheet->getColumnDimension('G')->setWidth(20); // Bank Account Number

        // Notes section
        if ($salarySheet->notes) {
            $row += 2;
            $sheet->setCellValue('A' . $row, 'Notes:');
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $row++;
            $sheet->setCellValue('A' . $row, $salarySheet->notes);
            $sheet->mergeCells('A' . $row . ':D' . $row);
            $sheet->getStyle('A' . $row)->getAlignment()->setWrapText(true);
        }

        // Create writer and download
        $filename = 'salary_sheet_' . $salarySheet->sheet_no . '_' . date('Y-m-d') . '.xlsx';

        return new StreamedResponse(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
}
