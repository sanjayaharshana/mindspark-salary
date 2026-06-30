@extends('layouts.admin')

@section('title', 'Promoter Details')
@section('page-title', 'Promoter Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.promoters.index') }}" class="breadcrumb-item">Promoters</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Details</span>
@endsection

@section('content')
<style>
/* ---- Shared ---- */
.ps-layout { display:grid; grid-template-columns:260px 1fr; gap:1rem; align-items:start; }
@media(max-width:800px){ .ps-layout { grid-template-columns:1fr; } }
.ps-sidebar { display:flex; flex-direction:column; gap:.75rem; }
.ps-card { background:#fff; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; }
.ps-card-head { padding:.65rem 1rem; border-bottom:1px solid #f3f4f6; }
.ps-card-title { font-size:.72rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; margin:0; }
.ps-card-body { padding:1rem; }

/* ---- Sidebar identity ---- */
.ps-avatar { width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,#f43f5e,#e11d48); color:#fff; font-size:1.3rem; font-weight:700; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.ps-name { font-size:1rem; font-weight:700; color:#1f2937; text-align:center; margin-bottom:.3rem; }
.ps-pid { display:inline-flex; padding:.18rem .55rem; border-radius:5px; font-size:.75rem; font-weight:700; font-family:monospace; background:#1f2937; color:#fff; }
.ps-status { display:inline-flex; padding:.2rem .6rem; border-radius:20px; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.04em; }
.ps-status-active    { background:#d1fae5; color:#065f46; }
.ps-status-inactive  { background:#fef3c7; color:#92400e; }
.ps-status-suspended { background:#fee2e2; color:#991b1b; }
.ps-meta { display:flex; flex-direction:column; gap:.5rem; margin-top:.75rem; }
.ps-meta-row { display:flex; gap:.5rem; align-items:flex-start; }
.ps-meta-icon { width:16px; height:16px; flex-shrink:0; margin-top:.05rem; }
.ps-meta-lbl { font-size:.7rem; color:#9ca3af; }
.ps-meta-val { font-size:.8rem; color:#374151; font-weight:500; }
.pos-badge { display:inline-flex; padding:.15rem .45rem; border-radius:5px; font-size:.7rem; font-weight:600; background:#fdf2f8; color:#a21caf; border:1px solid #f5d0fe; margin-top:.15rem; }

/* ---- Actions ---- */
.ps-act-btn { padding:.45rem .9rem; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:.4rem; transition:all .15s; text-decoration:none; width:100%; margin-bottom:.4rem; }
.ps-act-btn:last-child { margin-bottom:0; }
.ps-act-edit { background:#fff1f2; color:#e11d48; border:1px solid #fecdd3; } .ps-act-edit:hover { background:#ffe4e6; }
.ps-act-del  { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; } .ps-act-del:hover  { background:#fee2e2; }
.ps-act-back { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .ps-act-back:hover { background:#e5e7eb; }

/* ---- Tabs ---- */
.ps-tabs { display:flex; border-bottom:2px solid #e5e7eb; margin-bottom:1rem; gap:.15rem; }
.ps-tab { padding:.55rem 1rem; border:none; background:none; cursor:pointer; font-size:.82rem; font-weight:600; color:#6b7280; border-bottom:2px solid transparent; margin-bottom:-2px; display:flex; align-items:center; gap:.35rem; transition:all .15s; border-radius:6px 6px 0 0; }
.ps-tab:hover { color:#374151; background:#f9fafb; }
.ps-tab.active { color:#f43f5e; border-bottom-color:#f43f5e; background:#fff; }
.ps-tab-content { display:none; }
.ps-tab-content.active { display:block; }

/* ---- Detail fields ---- */
.ps-field { display:flex; flex-direction:column; gap:.2rem; padding:.65rem 0; border-bottom:1px solid #f3f4f6; }
.ps-field:last-child { border-bottom:none; }
.ps-field-lbl { font-size:.68rem; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:.05em; }
.ps-field-val { font-size:.84rem; color:#374151; }
.ps-field-val strong { color:#1f2937; }
.no-val { font-size:.8rem; color:#9ca3af; font-style:italic; }

/* ---- Earnings stats ---- */
.ps-earn-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:.75rem; margin-bottom:1rem; }
.ps-earn-card { border-radius:10px; padding:1rem 1.25rem; color:#fff; }
.ps-earn-val { font-size:1.5rem; font-weight:700; line-height:1; margin-bottom:.25rem; }
.ps-earn-lbl { font-size:.75rem; opacity:.9; }
.ps-breakdown { display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:.5rem; }
.ps-bk-item { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.65rem .85rem; text-align:center; }
.ps-bk-lbl { font-size:.7rem; color:#6b7280; margin-bottom:.2rem; }
.ps-bk-val { font-size:.95rem; font-weight:700; }

/* ---- Salary history table ---- */
.ps-sheet-num { display:inline-flex; padding:.15rem .5rem; border-radius:5px; font-size:.7rem; font-weight:700; font-family:monospace; background:#1f2937; color:#fff; }
.ps-sheet-status { display:inline-flex; padding:.15rem .45rem; border-radius:20px; font-size:.68rem; font-weight:700; text-transform:uppercase; }
.ps-sheet-draft    { background:#fef3c7; color:#92400e; }
.ps-sheet-approved { background:#d1fae5; color:#065f46; }
.ps-sheet-paid     { background:#dbeafe; color:#1e40af; }
.ps-sh-icon-btn { width:26px; height:26px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.ps-sh-view { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .ps-sh-view:hover { background:#e5e7eb; }
.ps-sh-print { background:#eff6ff; border-color:#bfdbfe; color:#2563eb; } .ps-sh-print:hover { background:#dbeafe; }
.ps-sh-slip  { background:#f0fdf4; border-color:#bbf7d0; color:#059669; } .ps-sh-slip:hover  { background:#dcfce7; }
.ps-sh-table { width:100%; border-collapse:collapse; }
.ps-sh-table th { padding:.6rem 1rem; font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; background:#f8fafc; }
.ps-sh-table td { padding:.65rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.ps-sh-table tbody tr:last-child td { border-bottom:none; }
.ps-sh-table tbody tr:hover td { background:#f9fafb; }
</style>

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:.6rem 1rem;border-radius:8px;font-size:.82rem;margin-bottom:.75rem;display:flex;align-items:center;gap:.5rem;">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="ps-layout">
    {{-- Sidebar --}}
    <div class="ps-sidebar">
        {{-- Identity --}}
        <div class="ps-card">
            <div class="ps-card-body" style="text-align:center;">
                <div class="ps-avatar">
                    {{ strtoupper(substr($promoter->promoter_name,0,1)) }}{{ strtoupper(substr(explode(' ',$promoter->promoter_name)[1] ?? '',0,1)) }}
                </div>
                <div class="ps-name">{{ $promoter->promoter_name }}</div>
                <div style="display:flex;justify-content:center;gap:.4rem;flex-wrap:wrap;margin-bottom:.5rem;">
                    <span class="ps-pid">{{ $promoter->promoter_id }}</span>
                    <span class="ps-status ps-status-{{ $promoter->status }}">{{ ucfirst($promoter->status) }}</span>
                </div>
                @if($promoter->position)
                    <span class="pos-badge">{{ $promoter->position->position_name }}</span>
                @endif
                <div class="ps-meta">
                    <div class="ps-meta-row">
                        <svg class="ps-meta-icon" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.11 12 19.79 19.79 0 0 1 1 4.11 2 2 0 0 1 2.7 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <div>
                            <div class="ps-meta-lbl">Phone</div>
                            <div class="ps-meta-val">{{ $promoter->phone_no }}</div>
                        </div>
                    </div>
                    <div class="ps-meta-row">
                        <svg class="ps-meta-icon" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <div>
                            <div class="ps-meta-lbl">Joined</div>
                            <div class="ps-meta-val">{{ $promoter->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="ps-meta-row">
                        <svg class="ps-meta-icon" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <div>
                            <div class="ps-meta-lbl">Updated</div>
                            <div class="ps-meta-val">{{ $promoter->updated_at->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="ps-meta-row">
                        <svg class="ps-meta-icon" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        <div>
                            <div class="ps-meta-lbl">Salary Sheets</div>
                            <div class="ps-meta-val">{{ $earningsSummary['total_salary_sheets'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="ps-card">
            <div class="ps-card-head"><p class="ps-card-title">Actions</p></div>
            <div class="ps-card-body">
                @can('edit promoters')
                <a href="{{ route('admin.promoters.edit', $promoter) }}" class="ps-act-btn ps-act-edit">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Promoter
                </a>
                @endcan
                @can('delete promoters')
                <form method="POST" action="{{ route('admin.promoters.destroy', $promoter) }}" onsubmit="return confirm('Delete {{ addslashes($promoter->promoter_name) }}? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="ps-act-btn ps-act-del">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                        Delete Promoter
                    </button>
                </form>
                @endcan
                <a href="{{ route('admin.promoters.index') }}" class="ps-act-btn ps-act-back">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    {{-- Main --}}
    <div>
        {{-- Tabs --}}
        <div class="ps-tabs">
            <button class="ps-tab active" onclick="psTab(event,'ps-details')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Details
            </button>
            <button class="ps-tab" onclick="psTab(event,'ps-earnings')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                Earnings
            </button>
            <button class="ps-tab" onclick="psTab(event,'ps-history')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                Salary History
                @if($earningsSummary['total_salary_sheets'] > 0)
                    <span style="background:#f43f5e;color:#fff;border-radius:20px;padding:.05rem .4rem;font-size:.65rem;font-weight:700;">{{ $earningsSummary['total_salary_sheets'] }}</span>
                @endif
            </button>
        </div>

        {{-- Details Tab --}}
        <div id="ps-details" class="ps-tab-content active">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:.75rem;">
                {{-- Personal Info --}}
                <div class="ps-card">
                    <div class="ps-card-head"><p class="ps-card-title">Personal Information</p></div>
                    <div class="ps-card-body">
                        <div class="ps-field">
                            <span class="ps-field-lbl">Promoter ID</span>
                            <div class="ps-field-val"><span class="ps-pid">{{ $promoter->promoter_id }}</span></div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Full Name</span>
                            <div class="ps-field-val"><strong>{{ $promoter->promoter_name }}</strong></div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Position</span>
                            <div class="ps-field-val">
                                @if($promoter->position)
                                    <span class="pos-badge">{{ $promoter->position->position_name }}</span>
                                @else
                                    <span class="no-val">No position assigned</span>
                                @endif
                            </div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Identity Card No.</span>
                            <div class="ps-field-val" style="font-family:monospace;">{{ $promoter->identity_card_no }}</div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Phone Number</span>
                            <div class="ps-field-val">{{ $promoter->phone_no }}</div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Status</span>
                            <div class="ps-field-val">
                                <span class="ps-status ps-status-{{ $promoter->status }}">{{ ucfirst($promoter->status) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bank Details --}}
                <div class="ps-card">
                    <div class="ps-card-head"><p class="ps-card-title">Bank Details</p></div>
                    <div class="ps-card-body">
                        <div class="ps-field">
                            <span class="ps-field-lbl">Bank Name</span>
                            <div class="ps-field-val"><strong>{{ $promoter->bank_name }}</strong></div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Branch</span>
                            <div class="ps-field-val">{{ $promoter->bank_branch_name }}</div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Account Number</span>
                            <div class="ps-field-val" style="font-family:monospace;">
                                <span title="{{ $promoter->bank_account_number }}">****{{ substr($promoter->bank_account_number,-4) }}</span>
                                <span style="font-size:.7rem;color:#9ca3af;margin-left:.4rem;">(hover to reveal)</span>
                            </div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Created</span>
                            <div class="ps-field-val">{{ $promoter->created_at->format('d F Y, g:i A') }}</div>
                        </div>
                        <div class="ps-field">
                            <span class="ps-field-lbl">Last Updated</span>
                            <div class="ps-field-val">{{ $promoter->updated_at->format('d F Y, g:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Earnings Tab --}}
        <div id="ps-earnings" class="ps-tab-content">
            <div class="ps-earn-grid">
                <div class="ps-earn-card" style="background:linear-gradient(135deg,#10b981,#059669);">
                    <div class="ps-earn-val">Rs. {{ number_format($earningsSummary['total_net_amount'],2) }}</div>
                    <div class="ps-earn-lbl">Total Net Earnings</div>
                </div>
                <div class="ps-earn-card" style="background:linear-gradient(135deg,#3b82f6,#2563eb);">
                    <div class="ps-earn-val">Rs. {{ number_format($earningsSummary['total_attendance_amount'],2) }}</div>
                    <div class="ps-earn-lbl">Attendance Amount</div>
                </div>
                <div class="ps-earn-card" style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                    <div class="ps-earn-val">{{ $earningsSummary['total_salary_sheets'] }}</div>
                    <div class="ps-earn-lbl">Salary Sheets</div>
                </div>
                <div class="ps-earn-card" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed);">
                    <div class="ps-earn-val">{{ $earningsSummary['total_attendance_days'] }}</div>
                    <div class="ps-earn-lbl">Attendance Days</div>
                </div>
            </div>

            {{-- Breakdown --}}
            <div class="ps-card" style="margin-bottom:.75rem;">
                <div class="ps-card-head"><p class="ps-card-title">Earnings Breakdown</p></div>
                <div class="ps-card-body">
                    <div class="ps-breakdown">
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Basic Amount</div>
                            <div class="ps-bk-val" style="color:#059669;">Rs. {{ number_format($earningsSummary['total_basic_amount'],2) }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Food Allowance</div>
                            <div class="ps-bk-val" style="color:#059669;">Rs. {{ number_format($earningsSummary['total_food_allowance'],2) }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Accommodation</div>
                            <div class="ps-bk-val" style="color:#059669;">Rs. {{ number_format($earningsSummary['total_accommodation_allowance'],2) }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Hold Amount</div>
                            <div class="ps-bk-val" style="color:#f59e0b;">Rs. {{ number_format($earningsSummary['total_hold_amount'],2) }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Expenses</div>
                            <div class="ps-bk-val" style="color:#dc2626;">Rs. {{ number_format($earningsSummary['total_expenses'],2) }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Coordination Fee</div>
                            <div class="ps-bk-val" style="color:#dc2626;">Rs. {{ number_format($earningsSummary['total_coordination_fee'],2) }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Avg. per Day</div>
                            <div class="ps-bk-val" style="color:#3b82f6;">Rs. {{ number_format($earningsSummary['average_earnings_per_day'],2) }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Avg. per Sheet</div>
                            <div class="ps-bk-val" style="color:#3b82f6;">Rs. {{ number_format($earningsSummary['average_earnings_per_sheet'],2) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sheet status summary --}}
            <div class="ps-card">
                <div class="ps-card-head"><p class="ps-card-title">Sheet Status Summary</p></div>
                <div class="ps-card-body">
                    <div class="ps-breakdown">
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Paid</div>
                            <div class="ps-bk-val" style="color:#059669;">{{ $earningsSummary['total_salary_sheets_paid'] }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Approved</div>
                            <div class="ps-bk-val" style="color:#3b82f6;">{{ $earningsSummary['total_salary_sheets_approved'] }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Draft</div>
                            <div class="ps-bk-val" style="color:#f59e0b;">{{ $earningsSummary['total_salary_sheets_draft'] }}</div>
                        </div>
                        <div class="ps-bk-item">
                            <div class="ps-bk-lbl">Unique Jobs</div>
                            <div class="ps-bk-val" style="color:#8b5cf6;">{{ $earningsSummary['unique_jobs'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Salary History Tab --}}
        <div id="ps-history" class="ps-tab-content">
            <div class="ps-card">
                @if($salarySheetItems->count() > 0)
                <div style="overflow-x:auto;">
                    <table class="ps-sh-table">
                        <thead>
                            <tr>
                                <th>Sheet No.</th>
                                <th>Job</th>
                                <th>Client</th>
                                <th>Position</th>
                                <th>Days</th>
                                <th>Attendance</th>
                                <th>Net Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salarySheetItems as $item)
                            <tr>
                                <td><span class="ps-sheet-num">{{ $item->salarySheet->sheet_no }}</span></td>
                                <td>
                                    <div style="font-weight:500;font-size:.82rem;">{{ $item->salarySheet->job->job_number ?? 'N/A' }}</div>
                                    <div style="font-size:.7rem;color:#6b7280;">{{ $item->salarySheet->job->job_name ?? '' }}</div>
                                </td>
                                <td style="font-size:.82rem;color:#374151;">{{ $item->salarySheet->job->client->name ?? 'N/A' }}</td>
                                <td>
                                    @if($item->position)
                                        <span class="pos-badge">{{ $item->position->position_name }}</span>
                                    @else
                                        <span style="font-size:.75rem;color:#9ca3af;">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="background:#fef3c7;color:#92400e;padding:.15rem .45rem;border-radius:5px;font-size:.75rem;font-weight:700;">
                                        {{ $item->attendance_data['total'] ?? 0 }}d
                                    </span>
                                </td>
                                <td style="font-weight:600;color:#059669;font-size:.82rem;">Rs. {{ number_format($item->attendance_data['amount'] ?? 0,2) }}</td>
                                <td style="font-weight:700;color:#10b981;font-size:.85rem;">Rs. {{ number_format($item->payment_data['net_amount'] ?? 0,2) }}</td>
                                <td>
                                    <span class="ps-sheet-status ps-sheet-{{ $item->salarySheet->status }}">
                                        {{ ucfirst($item->salarySheet->status) }}
                                    </span>
                                </td>
                                <td style="white-space:nowrap;color:#6b7280;font-size:.78rem;">{{ $item->salarySheet->created_at->format('d M Y') }}</td>
                                <td>
                                    <div style="display:flex;gap:.3rem;justify-content:flex-end;">
                                        @can('view salary sheets')
                                        <a href="{{ route('admin.salary-sheets.show', $item->salarySheet) }}" class="ps-sh-icon-btn ps-sh-view" title="View Sheet">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        <a href="{{ route('admin.salary-sheets.print', $item->salarySheet) }}" target="_blank" class="ps-sh-icon-btn ps-sh-print" title="Print Sheet">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><polyline points="6 14 18 14 18 22 6 22 6 14"/></svg>
                                        </a>
                                        <a href="{{ route('admin.promoters.salary-slip.print', ['promoter'=>$promoter->id,'itemId'=>$item->id]) }}" target="_blank" class="ps-sh-icon-btn ps-sh-slip" title="Print Slip">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                        </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div style="padding:3rem 1rem;text-align:center;">
                    <div style="width:48px;height:48px;background:#f3f4f6;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <p style="font-weight:600;color:#374151;font-size:.85rem;margin:.25rem 0;">No salary sheets yet</p>
                    <p style="color:#6b7280;font-size:.82rem;margin:.25rem 0;">This promoter hasn't appeared in any salary sheets.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function psTab(e, id) {
    document.querySelectorAll('.ps-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.ps-tab-content').forEach(c => c.classList.remove('active'));
    e.currentTarget.classList.add('active');
    document.getElementById(id).classList.add('active');
}
</script>
@endsection
