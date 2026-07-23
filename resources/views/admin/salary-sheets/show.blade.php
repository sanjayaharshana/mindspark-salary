@extends('layouts.admin')

@section('title', 'Salary Sheet Details')
@section('page-title', 'Salary Sheet Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.salary-sheets.index') }}" class="breadcrumb-item">Salary Sheets</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Details</span>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size:1rem;">Salary Sheet Information</h3>
            <div style="display: flex; gap: 0.4rem;">
                <a href="{{ route('admin.salary-sheets.print', $salarySheet) }}" target="_blank" class="btn btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>
                    Print
                </a>
                <a href="{{ route('admin.salary-sheets.export', $salarySheet) }}" class="btn btn-success">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Export to Excel
                </a>
                @can('edit salary sheets')
                    @if($salarySheet->job && $salarySheet->job->status !== 'completed' && !in_array($salarySheet->status, ['complete', 'approve', 'paid']))
                        <a href="{{ route('admin.salary-sheets.edit', $salarySheet) }}" class="btn btn-warning">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Edit Salary Sheet
                        </a>
                    @else
                        <span class="btn btn-warning" style="opacity: 0.5; cursor: not-allowed;" title="Cannot edit salary sheets with complete/paid status or for completed jobs">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Edit Salary Sheet (Not Available)
                        </span>
                    @endif
                @endcan
                <a href="{{ route('admin.salary-sheets.index') }}" class="btn btn-secondary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                        <path d="M19 12H5M12 19l-7-7 7-7"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>
    <div class="card-body" style="padding: 1rem;">
        <!-- Header Section -->
        @php
            $statusDisplay = $salarySheet->status_display;
            $statusClass = $salarySheet->status;

            // For reporter role, show "Pending Approval" for "complete" status
            if (auth()->check() && auth()->user()->hasRole('reporter') && $salarySheet->status === 'complete') {
                $statusDisplay = 'Pending Approval';
                $statusClass = 'pending-approval';
            }

            $statusGradients = [
                'draft'            => ['#f59e0b', '#d97706'],
                'complete'         => ['#059669', '#047857'],
                'approve'          => ['#7c3aed', '#6d28d9'],
                'paid'             => ['#2563eb', '#1d4ed8'],
                'reject'           => ['#dc2626', '#b91c1c'],
                'pending-approval' => ['#f59e0b', '#d97706'],
            ];
            [$gradFrom, $gradTo] = $statusGradients[$statusClass] ?? ['#059669', '#047857'];
        @endphp
        <div style="display: flex; align-items: center; margin-bottom: 1rem; padding: 0.75rem 1rem; background: linear-gradient(135deg, {{ $gradFrom }} 0%, {{ $gradTo }} 100%); border-radius: 0.5rem; color: white;">
            <div style="width: 42px; height: 42px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 0.85rem; flex-shrink:0;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
            </div>
            <div>
                <h2 style="margin: 0; font-size: 1.1rem;">{{ $salarySheet->sheet_no }}</h2>
                <p style="margin: 0.3rem 0 0 0; font-size: 0.8rem; opacity: 0.9;">
                    <span class="status-badge status-{{ $statusClass }}" style="background: rgba(255,255,255,0.25); color: white;">
                        {{ $statusDisplay }}
                    </span>
                    @if($salarySheet->job)
                        <span style="margin-left:0.6rem; font-size:0.72rem; opacity:0.85;">{{ $salarySheet->job->job_number }}</span>
                    @endif
                </p>
                <p style="margin: 0.2rem 0 0 0; font-size: 0.72rem; opacity: 0.8;">
                    {{ $salarySheet->month_name }} {{ $salarySheet->year }}
                    @if($salarySheet->start_date || $salarySheet->end_date)
                        &middot;
                        {{ $salarySheet->start_date?->format('M d, Y') ?? '—' }}
                        to
                        {{ $salarySheet->end_date?->format('M d, Y') ?? '—' }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="sd-tabs">
            <button class="sd-tab active" onclick="sdTab(event,'sd-overview')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Overview
            </button>
            <button class="sd-tab" onclick="sdTab(event,'sd-items')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Items
                @if($salarySheet->items && $salarySheet->items->count() > 0)
                    <span class="sd-tab-count">{{ $salarySheet->items->count() }}</span>
                @endif
            </button>
        </div>

        <!-- Overview Tab -->
        <div id="sd-overview" class="sd-tab-content active">

        <!-- Main Content Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">

            <!-- Left Column: Basic Information -->
            <div>
                <!-- Job Information -->
                @if($salarySheet->job)
                <div class="info-card">
                    <h4 class="card-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                        Job Information
                    </h4>

                    <div class="info-grid">
                        <div class="info-item">
                            <label>Job Number</label>
                            <div>{{ $salarySheet->job->job_number ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <label>Job Name</label>
                            <div>{{ $salarySheet->job->job_name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <label>Client</label>
                            <div>{{ $salarySheet->job->client->name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <label>Location</label>
                            <div>{{ $salarySheet->location ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <label>Period</label>
                            <div>
                                @if($salarySheet->start_date || $salarySheet->end_date)
                                    {{ $salarySheet->start_date?->format('Y-m-d') ?? '—' }} &rarr; {{ $salarySheet->end_date?->format('Y-m-d') ?? '—' }}
                                @else
                                    <span class="no-val">Not set</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <label>Officer</label>
                            <div>
                                {{ $salarySheet->job->officer->name ?? 'Not assigned' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <label>Reporter</label>
                            <div>
                                @if($salarySheet->job->reporter)
                                    {{ $salarySheet->job->reporter->name }}
                                @else
                                    <span class="no-val" title="No reporter assigned to this job — approval mail cannot be sent until one is assigned.">Not assigned</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Summary Information -->
                <div class="info-card">
                    <h4 class="card-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Summary Information
                    </h4>

                    <div class="info-grid">
                        <div class="info-item">
                            <label>Total Items</label>
                            <div>{{ $salarySheet->items->count() }}</div>
                        </div>
                        <div class="info-item">
                            <label>Total Amount</label>
                            <div class="amount">Rs. {{ number_format($salarySheet->total_amount, 2) }}</div>
                        </div>
                        <div class="info-item">
                            <label>Total Attendance Amount</label>
                            <div class="amount">Rs. {{ number_format($salarySheet->total_attendance_amount, 2) }}</div>
                        </div>
                        <div class="info-item">
                            <label>Positions</label>
                            <div>{{ $salarySheet->positions->count() }}</div>
                        </div>
                        @if($salarySheet->creator)
                        <div class="info-item">
                            <label>Created By</label>
                            <div>{{ $salarySheet->creator->name ?? $salarySheet->creator->email ?? 'N/A' }}</div>
                        </div>
                        @endif
                        <div class="info-item">
                            <label>Created At</label>
                            <div>{{ $salarySheet->created_at->format('Y-m-d H:i:s') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Financial Summary -->
            <div>
                <!-- Financial Summary -->
                <div class="info-card totals-card">
                    <h4 class="card-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                        Financial Summary
                    </h4>

                    <div class="totals-grid">
                        <div class="total-item">
                            <label>Total Net Amount</label>
                            <div class="amount net-salary">Rs. {{ number_format($salarySheet->total_amount, 2) }}</div>
                        </div>
                        <div class="total-item">
                            <label>Total Attendance Amount</label>
                            <div class="amount total-earnings">Rs. {{ number_format($salarySheet->total_attendance_amount, 2) }}</div>
                        </div>
                        <div class="total-item">
                            <label>Total Allowances</label>
                            <div class="amount">Rs. {{ number_format($salarySheet->total_allowances, 2) }}</div>
                        </div>
                        <div class="total-item">
                            <label>Total Coordination Fee</label>
                            <div class="amount">Rs. {{ number_format($salarySheet->total_coordination_fee, 2) }}</div>
                        </div>
                        <div class="total-item total-item-grand">
                            <label>Grand Total</label>
                            <div class="amount net-salary">Rs. {{ number_format($salarySheet->grand_total, 2) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Decline Reason -->
                @if($salarySheet->status === 'reject' && $salarySheet->decline_reason)
                <div class="info-card" style="background:#fef2f2; border-color:#fecaca;">
                    <h4 class="card-title" style="color:#991b1b;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        Decline Reason
                    </h4>
                    <div class="notes-content" style="color:#991b1b;">{{ $salarySheet->decline_reason }}</div>
                </div>
                @endif

                <!-- Notes Section -->
                @if($salarySheet->notes)
                <div class="info-card">
                    <h4 class="card-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14,2 14,8 20,8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10,9 9,9 8,9"></polyline>
                        </svg>
                        Notes
                    </h4>
                    <div class="notes-content">{{ $salarySheet->notes }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Timestamps -->
        <div class="timestamps-section">
            <div class="timestamp-item">
                <label>Created</label>
                <div>{{ $salarySheet->created_at->format('F d, Y \a\t g:i A') }}</div>
            </div>
            <div class="timestamp-item">
                <label>Last Updated</label>
                <div>{{ $salarySheet->updated_at->format('F d, Y \a\t g:i A') }}</div>
            </div>
        </div>
        </div>
        <!-- /Overview Tab -->

        <!-- Items Tab -->
        <div id="sd-items" class="sd-tab-content">
        @if($salarySheet->items && $salarySheet->items->count() > 0)
        <div class="items-section">
            @foreach($salarySheet->items as $index => $item)
            <div class="item-card">
                <div class="item-header">
                    <h4>
                        Item #{{ $item->no }}
                        @if($item->promoter)
                            <span class="promoter-badge">{{ $item->promoter->promoter_name ?? 'N/A' }}</span>
                        @endif
                        @if($item->position)
                            <span class="position-badge">{{ $item->position->position_name }}</span>
                        @endif
                        @if($item->location)
                            <span class="location-badge">{{ $item->location }}</span>
                        @endif
                    </h4>
                </div>

                <div class="item-content">
                    <!-- Promoter and Position Information -->
                    <div class="promoter-info-section" style="margin-bottom: 0.75rem; padding: 0.6rem; background: #f8fafc; border-radius: 0.4rem; border: 1px solid #e5e7eb;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem;">
                            <div class="info-item">
                                <label>Promoter Name</label>
                                <div style="font-weight: 600; color: #374151; font-size: 0.8rem;">
                                    {{ $item->promoter->promoter_name ?? ($item->attendance_data['promoter_name'] ?? 'N/A') }}
                                </div>
                            </div>
                            <div class="info-item">
                                <label>Position</label>
                                <div style="font-weight: 600; color: #374151; font-size: 0.8rem;">
                                    {{ $item->position->position_name ?? ($item->attendance_data['position'] ?? 'N/A') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 1rem;">

                        <!-- Attendance Data -->
                        <div class="item-section">
                            <h5>Attendance Data</h5>
                            @if($item->daily_attendance && count($item->daily_attendance) > 0)
                            <div class="attendance-dates">
                                <div class="dates-grid">
                                    @foreach($item->daily_attendance as $date => $value)
                                    <div class="date-item {{ $value > 0 ? 'present' : 'absent' }}">
                                        <div class="date">{{ \Carbon\Carbon::parse($date)->format('M d') }}</div>
                                        <div class="value">{{ $value > 0 ? 'Present' : 'Absent' }}</div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="attendance-summary">
                                <div class="summary-item">
                                    <label>Total Days</label>
                                    <div class="value">{{ $item->attendance_total }}</div>
                                </div>
                                <div class="summary-item">
                                    <label>Attendance Amount</label>
                                    <div class="value amount">Rs. {{ number_format($item->attendance_amount, 2) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Data -->
                        <div class="item-section">
                            <h5>Payment Data</h5>
                            <div class="payment-grid">
                                <div class="payment-item">
                                    <label>Base Amount</label>
                                    <div class="amount">Rs. {{ number_format($item->base_amount, 2) }}</div>
                                </div>
                                <div class="payment-item">
                                    <label>Food Allowance</label>
                                    <div class="amount">Rs. {{ number_format($item->food_allowance, 2) }}</div>
                                </div>
                                <div class="payment-item">
                                    <label>Accommodation Allowance</label>
                                    <div class="amount">Rs. {{ number_format($item->accommodation_allowance, 2) }}</div>
                                </div>
                                <div class="payment-item">
                                    <label>Expenses</label>
                                    <div class="amount deduction">Rs. {{ number_format($item->expenses, 2) }}</div>
                                </div>
                                <div class="payment-item">
                                    <label>Hold for Weeks</label>
                                    <div class="amount deduction">Rs. {{ number_format($item->hold_for_weeks, 2) }}</div>
                                </div>
                                <div class="payment-item total-item">
                                    <label>Net Amount</label>
                                    <div class="amount net-amount">Rs. {{ number_format($item->net_amount, 2) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Allowances -->
                        <div class="item-section">
                            <h5>Allowances</h5>
                            @if($item->allowances_data && count($item->allowances_data) > 0)
                            <div class="payment-grid">
                                @foreach($item->allowances_data as $allowanceName => $allowanceValue)
                                <div class="payment-item">
                                    <label>{{ $allowanceName }}</label>
                                    <div class="amount">Rs. {{ number_format($allowanceValue, 2) }}</div>
                                </div>
                                @endforeach
                                <div class="payment-item total-item">
                                    <label>Total Allowances</label>
                                    <div class="amount net-amount">Rs. {{ number_format($item->total_allowances, 2) }}</div>
                                </div>
                            </div>
                            @else
                            <div class="no-coordinator">No allowances</div>
                            @endif
                        </div>

                        <!-- Coordinator Details -->
                        <div class="item-section">
                            <h5>Coordinator Details</h5>
                            @if($item->coordinator_details)
                            <div class="coordinator-grid">
                                <div class="coordinator-item">
                                    <label>Coordinator ID</label>
                                    <div>{{ $item->coordinator_id }}</div>
                                </div>
                                <div class="coordinator-item">
                                    <label>Coordinator Name</label>
                                    <div>{{ $item->coordinator_name }}</div>
                                </div>
                                <div class="coordinator-item">
                                    <label>Coordination Fee</label>
                                    <div class="amount">Rs. {{ number_format($item->coordinator_amount, 2) }}</div>
                                </div>
                            </div>
                            @else
                            <div class="no-coordinator">No coordinator assigned</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-coordinator">No items on this salary sheet.</div>
        @endif
        </div>
        <!-- /Items Tab -->
    </div>
</div>

<style>
.sd-tabs { display:flex; border-bottom:2px solid #e5e7eb; margin-bottom:1rem; gap:.15rem; }
.sd-tab { padding:.5rem .9rem; border:none; background:none; cursor:pointer; font-size:.8rem; font-weight:600; color:#6b7280; border-bottom:2px solid transparent; margin-bottom:-2px; display:flex; align-items:center; gap:.35rem; transition:all .15s; border-radius:6px 6px 0 0; }
.sd-tab:hover { color:#374151; background:#f9fafb; }
.sd-tab.active { color:#059669; border-bottom-color:#059669; background:#fff; }
.sd-tab-count { background:#059669; color:#fff; border-radius:20px; padding:.05rem .4rem; font-size:.62rem; font-weight:700; }
.sd-tab-content { display:none; }
.sd-tab-content.active { display:block; }
</style>

<style>
.status-badge {
    padding: 0.15rem 0.55rem;
    border-radius: 9999px;
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-draft {
    background-color: #fef3c7;
    color: #92400e;
}

.status-complete {
    background-color: #d1fae5;
    color: #065f46;
}

.status-approve {
    background-color: #ede9fe;
    color: #5b21b6;
}

.status-reject {
    background-color: #fee2e2;
    color: #991b1b;
}

.status-pending-approval {
    background-color: #fed7aa;
    color: #9a3412;
}

.status-paid {
    background-color: #dbeafe;
    color: #1e40af;
}

.no-val {
    font-size: 0.75rem;
    color: #9ca3af;
    font-style: italic;
}

.info-card {
    background: #f8fafc;
    padding: 0.85rem;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
    border: 1px solid #e5e7eb;
}

.card-title {
    display: flex;
    align-items: center;
    margin-bottom: 0.6rem;
    color: #374151;
    font-size: 0.85rem;
    font-weight: 600;
}

.info-grid {
    display: grid;
    gap: 0.6rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.15rem;
}

.info-item label {
    font-size: 0.65rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.info-item div {
    color: #374151;
    font-weight: 500;
    font-size: 0.82rem;
}

.amount {
    font-weight: 600;
    color: #059669;
}

.deduction {
    color: #dc2626;
}

.totals-card {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border: 2px solid #0ea5e9;
}

.totals-grid {
    display: grid;
    gap: 0.6rem;
}

.total-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0.6rem;
    background: white;
    border-radius: 0.4rem;
    border: 1px solid #e5e7eb;
}

.total-item-grand {
    background: #fef2f2;
    border: 2px solid #dc2626;
    grid-column: 1 / -1;
}

.total-item-grand label {
    font-weight: 700;
    color: #991b1b;
}

.total-item label {
    font-size: 0.72rem;
    color: #6b7280;
    font-weight: 600;
}

.total-earnings {
    font-size: 0.9rem;
    color: #2563eb;
}

.net-salary {
    font-size: 1rem;
    color: #dc2626;
    font-weight: bold;
}

.items-section {
    margin: 1rem 0;
}

.section-title {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    color: #374151;
    font-size: 0.95rem;
    font-weight: 600;
}

.item-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    margin-bottom: 0.6rem;
    overflow: hidden;
}

.item-header {
    background: #f8fafc;
    padding: 0.5rem 0.75rem;
    border-bottom: 1px solid #e5e7eb;
}

.item-header h4 {
    margin: 0;
    color: #374151;
    font-size: 0.85rem;
}

.position-badge {
    background: #dbeafe;
    color: #1e40af;
    padding: 0.15rem 0.4rem;
    border-radius: 0.3rem;
    font-size: 0.65rem;
    font-weight: 500;
    margin-left: 0.4rem;
}

.location-badge {
    background: #dcfce7;
    color: #166534;
    padding: 0.15rem 0.4rem;
    border-radius: 0.3rem;
    font-size: 0.65rem;
    font-weight: 500;
    margin-left: 0.4rem;
}

.promoter-badge {
    background: #fef3c7;
    color: #92400e;
    padding: 0.15rem 0.4rem;
    border-radius: 0.3rem;
    font-size: 0.65rem;
    font-weight: 500;
    margin-left: 0.4rem;
}

.item-content {
    padding: 0.85rem;
}

.item-section h5 {
    margin: 0 0 0.5rem 0;
    color: #374151;
    font-size: 0.78rem;
    font-weight: 600;
}

.dates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(72px, 1fr));
    gap: 0.35rem;
    margin-bottom: 0.6rem;
}

.date-item {
    text-align: center;
    padding: 0.35rem;
    border-radius: 0.3rem;
    border: 1px solid #e5e7eb;
    font-size: 0.65rem;
}

.date-item.present {
    background: #d1fae5;
    border-color: #10b981;
}

.date-item.absent {
    background: #fee2e2;
    border-color: #ef4444;
}

.date {
    font-weight: 600;
    color: #6b7280;
    margin-bottom: 0.1rem;
}

.value {
    font-size: 0.65rem;
    font-weight: 500;
}

.attendance-summary {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
    padding-top: 0.5rem;
    border-top: 1px solid #e5e7eb;
}

.summary-item {
    text-align: center;
}

.summary-item label {
    display: block;
    font-size: 0.58rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.1rem;
}

.payment-grid {
    display: grid;
    gap: 0.5rem;
}

.payment-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.4rem 0.5rem;
    background: #f8fafc;
    border-radius: 0.3rem;
    border: 1px solid #e5e7eb;
    font-size: 0.78rem;
}

.payment-item label {
    font-size: 0.7rem;
    color: #6b7280;
}

.payment-item.total-item {
    background: #f0f9ff;
    border-color: #0ea5e9;
    font-weight: 600;
}

.net-amount {
    font-size: 0.88rem;
    color: #dc2626;
    font-weight: bold;
}

.coordinator-grid {
    display: grid;
    gap: 0.5rem;
}

.coordinator-item {
    display: flex;
    flex-direction: column;
    gap: 0.1rem;
    padding: 0.4rem 0.5rem;
    background: #f8fafc;
    border-radius: 0.3rem;
    border: 1px solid #e5e7eb;
}

.coordinator-item label {
    font-size: 0.58rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.coordinator-item div {
    color: #374151;
    font-weight: 500;
    font-size: 0.78rem;
}

.no-coordinator {
    text-align: center;
    color: #6b7280;
    font-style: italic;
    padding: 0.6rem;
    background: #f8fafc;
    border-radius: 0.3rem;
    border: 1px solid #e5e7eb;
    font-size: 0.78rem;
}

.notes-content {
    color: #374151;
    line-height: 1.5;
    white-space: pre-wrap;
    font-size: 0.82rem;
}

.timestamps-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0.6rem;
    margin-top: 1rem;
    padding-top: 0.75rem;
    border-top: 1px solid #e5e7eb;
}

.timestamp-item {
    display: flex;
    flex-direction: column;
    gap: 0.15rem;
}

.timestamp-item label {
    font-size: 0.65rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.timestamp-item div {
    color: #374151;
    font-weight: 500;
    font-size: 0.78rem;
}

.btn-primary,
.btn-success,
.btn-warning,
.btn-secondary {
    font-size: 0.78rem;
    padding: 0.4rem 0.8rem;
    border: none;
    border-radius: 0.35rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    font-weight: 500;
    transition: all 0.2s;
}

.btn-warning {
    background-color: #f59e0b;
    color: white;
}

.btn-warning:hover {
    background-color: #d97706;
    transform: translateY(-1px);
}

.btn-secondary {
    background-color: #6b7280;
    color: white;
}

.btn-secondary:hover {
    background-color: #4b5563;
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }

    .dates-grid {
        grid-template-columns: repeat(auto-fill, minmax(64px, 1fr));
    }

    .attendance-summary {
        grid-template-columns: 1fr;
    }

    .item-content > div {
        grid-template-columns: 1fr !important;
    }
}
</style>

<script>
function sdTab(e, id) {
    document.querySelectorAll('.sd-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.sd-tab-content').forEach(c => c.classList.remove('active'));
    e.currentTarget.classList.add('active');
    document.getElementById(id).classList.add('active');
}
</script>
@endsection
