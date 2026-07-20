<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view jobs')->only(['index', 'show']);
        $this->middleware('permission:create jobs')->only(['create', 'store']);
        $this->middleware('permission:edit jobs')->only(['edit', 'update']);
        $this->middleware('permission:delete jobs')->only(['destroy']);
    }

    public function ajaxSearch(Request $request)
    {
        $q     = trim($request->get('q', ''));
        $limit = min((int) $request->get('limit', 15), 50);
        $user  = auth()->user();

        $query = Job::with(['client', 'reporter']);

        if ($user && method_exists($user, 'hasRole') && $user->hasRole('officer')) {
            $query->where('officer_id', $user->id);
        }

        if ($q !== '') {
            $query->where(function ($q2) use ($q) {
                $q2->where('job_number', 'like', "%{$q}%")
                   ->orWhere('job_name',   'like', "%{$q}%")
                   ->orWhereHas('client',  fn($c) => $c->where('name', 'like', "%{$q}%"));
            });
        }

        $results = $query->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(fn($j) => [
                'id'            => $j->id,
                'job_number'    => $j->job_number,
                'job_name'      => $j->job_name,
                'start_date'    => $j->start_date?->format('Y-m-d'),
                'end_date'      => $j->end_date?->format('Y-m-d'),
                'client'        => optional($j->client)->name,
                'status'        => $j->status,
                'reporter_id'   => optional($j->reporter)->id,
                'reporter_name' => optional($j->reporter)->name,
            ]);

        return response()->json(['data' => $results]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Job::with(['client', 'officer', 'reporter']);

        // Search: job number, job name, client name/short_code
        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('job_number', 'like', "%{$term}%")
                    ->orWhere('job_name', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%")
                    ->orWhereHas('client', function ($q2) use ($term) {
                        $q2->where('name', 'like', "%{$term}%")
                            ->orWhere('short_code', 'like', "%{$term}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by officer
        if ($request->filled('officer_id')) {
            $query->where('officer_id', $request->officer_id);
        }

        // Filter by reporter
        if ($request->filled('reporter_id')) {
            $query->where('reporter_id', $request->reporter_id);
        }

        // Filter by client
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $jobs = $query->orderByDesc('id')->paginate(15)->withQueryString();

        $officers = User::role('officer')->orderBy('name')->get();
        $reporters = User::role('reporter')->orderBy('name')->get();
        $clients = Client::where('status', 'active')->orderBy('name')->get();

        $total      = Job::count();
        $pending    = Job::where('status', 'pending')->count();
        $inProgress = Job::where('status', 'in_progress')->count();
        $completed  = Job::where('status', 'completed')->count();
        $cancelled  = Job::where('status', 'cancelled')->count();

        return view('admin.jobs.index', compact('jobs', 'officers', 'reporters', 'clients', 'total', 'pending', 'inProgress', 'completed', 'cancelled'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::where('status', 'active')->orderBy('name')->get();
        $officers = User::role('officer')->orderBy('name')->get();
        $reporters = User::role('reporter')->orderBy('name')->get();
        return view('admin.jobs.create', compact('clients', 'officers', 'reporters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'officer_id' => 'nullable|exists:users,id',
            'reporter_id' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Generate job number automatically
            $jobNumber = Job::generateJobNumber($request->client_id);
            
            $jobData = $request->all();
            $jobData['job_number'] = $jobNumber;
            
            Job::create($jobData);

            return redirect()->route('admin.jobs.index')
                ->with('success', 'Job created successfully with job number: ' . $jobNumber);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to create job: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load(['client', 'officer', 'reporter']);
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $clients = Client::where('status', 'active')->orderBy('name')->get();
        $officers = User::role('officer')->orderBy('name')->get();
        $reporters = User::role('reporter')->orderBy('name')->get();
        return view('admin.jobs.edit', compact('job', 'clients', 'officers', 'reporters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $validator = Validator::make($request->all(), [
            'job_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'officer_id' => 'nullable|exists:users,id',
            'reporter_id' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If client changed, generate new job number
        if ($request->client_id != $job->client_id) {
            try {
                $jobNumber = Job::generateJobNumber($request->client_id);
                $request->merge(['job_number' => $jobNumber]);
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors(['error' => 'Failed to generate new job number: ' . $e->getMessage()])
                    ->withInput();
            }
        }

        $job->update($request->all());

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Update job settings
     */
    public function updateSettings(Request $request, Job $job)
    {
        $validator = Validator::make($request->all(), [
            'default_coordinator_fee' => 'nullable|numeric|min:0',
            'default_hold_for_8_weeks' => 'nullable|numeric|min:0',
            'default_food_allowance' => 'nullable|numeric|min:0',
            'default_accommodation_allowance' => 'nullable|numeric|min:0',
            'default_expenses' => 'nullable|numeric|min:0',
            'default_location' => 'nullable|string|max:255',
            'location_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $job->update([
                'default_coordinator_fee' => $request->default_coordinator_fee,
                'default_hold_for_8_weeks' => $request->default_hold_for_8_weeks,
                'default_food_allowance' => $request->default_food_allowance,
                'default_accommodation_allowance' => $request->default_accommodation_allowance,
                'default_expenses' => $request->default_expenses,
                'default_location' => $request->default_location,
                'location_notes' => $request->location_notes,
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Job settings updated successfully.',
                    'job' => $job->fresh()
                ]);
            }

            return redirect()->back()
                ->with('success', 'Job settings updated successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update job settings: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withErrors(['error' => 'Failed to update job settings: ' . $e->getMessage()]);
        }
    }

    /**
     * Update allowance rules for a job
     */
    public function updateAllowanceRules(Request $request, Job $job)
    {
        $validator = Validator::make($request->all(), [
            'allowance' => 'nullable|array',
            'allowance.*.allowance_name' => 'required_with:allowance|string|max:255',
            'allowance.*.price' => 'required_with:allowance|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $job->update([
                'allowance' => $request->allowance ?? []
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Allowance rules updated successfully.',
                'job' => $job->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update allowance rules: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $jobNumber = $job->job_number;
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job ' . $jobNumber . ' deleted successfully.');
    }
}