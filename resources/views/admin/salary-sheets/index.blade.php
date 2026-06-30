@extends('layouts.admin')

@section('title', __('salary_sheets.salary_sheets'))
@section('page-title', __('salary_sheets.salary_sheets'))

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">{{ __('salary_sheets.salary_sheets') }}</span>
@endsection

@section('content')
<style>
/* ── Salary Sheet Index (si-*) ── */
.si-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.si-title { font-size:1.1rem; font-weight:700; color:#1f2937; margin:0; }
.si-subtitle { font-size:.75rem; color:#6b7280; margin:.1rem 0 0; }

.si-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(130px,1fr)); gap:.625rem; margin-bottom:1rem; }
.si-stat { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.7rem 1rem; display:flex; align-items:center; gap:.7rem; }
.si-stat-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.si-stat-val { font-size:1.25rem; font-weight:700; color:#1f2937; line-height:1; }
.si-stat-lbl { font-size:.68rem; color:#6b7280; margin-top:.1rem; }

.si-filters { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; margin-bottom:1rem; }
.si-filter-row { display:flex; gap:.625rem; flex-wrap:wrap; align-items:flex-end; }
.si-filter-group { display:flex; flex-direction:column; gap:.25rem; flex:1; min-width:150px; }
.si-filter-group label { font-size:.72rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.si-input { padding:.45rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.si-input:focus { border-color:#4f46e5; box-shadow:0 0 0 3px rgba(79,70,229,.1); }

.si-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.si-btn-primary { background:#4f46e5; color:#fff; } .si-btn-primary:hover { background:#4338ca; }
.si-btn-success { background:#10b981; color:#fff; } .si-btn-success:hover { background:#059669; }
.si-btn-ghost   { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .si-btn-ghost:hover { background:#e5e7eb; }

/* Status badges */
.si-badge { display:inline-flex; align-items:center; padding:.18rem .55rem; border-radius:20px; font-size:.68rem; font-weight:700; text-transform:capitalize; letter-spacing:.03em; }
.si-badge-draft    { background:#fef3c7; color:#92400e; }
.si-badge-complete { background:#d1fae5; color:#065f46; }
.si-badge-approve  { background:#ede9fe; color:#5b21b6; }
.si-badge-paid     { background:#dbeafe; color:#1e40af; }
.si-badge-reject   { background:#fee2e2; color:#991b1b; }
.si-badge-pending  { background:#fef3c7; color:#92400e; }

/* Action icon buttons */
.si-actions { display:flex; gap:.3rem; justify-content:flex-end; }
.si-icon-btn { width:28px; height:28px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.si-icon-view    { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .si-icon-view:hover    { background:#e5e7eb; color:#374151; }
.si-icon-approve { background:#f0fdf4; border-color:#bbf7d0; color:#15803d; } .si-icon-approve:hover { background:#dcfce7; }
.si-icon-export  { background:#f0fdf4; border-color:#bbf7d0; color:#059669; } .si-icon-export:hover  { background:#dcfce7; }
.si-icon-print   { background:#eff6ff; border-color:#bfdbfe; color:#2563eb; } .si-icon-print:hover   { background:#dbeafe; }
.si-icon-del     { background:#fef2f2; border-color:#fecaca; color:#dc2626; } .si-icon-del:hover     { background:#fee2e2; }
.si-icon-del-off { background:#f9fafb; border-color:#e5e7eb; color:#d1d5db; cursor:not-allowed; }

.si-sheet-no { display:inline-flex; padding:.2rem .55rem; border-radius:5px; font-size:.72rem; font-weight:700; font-family:monospace; background:#312e81; color:#fff; letter-spacing:.03em; }
.si-count    { display:inline-flex; align-items:center; justify-content:center; min-width:26px; height:20px; padding:0 .4rem; border-radius:10px; font-size:.72rem; font-weight:700; }
.si-creator-name  { font-weight:500; font-size:.82rem; }
.si-creator-email { font-size:.7rem; color:#6b7280; }
.no-val { font-size:.75rem; color:#9ca3af; font-style:italic; }

/* ── Job Group ── */
.si-group { background:#fff; border:1px solid #e5e7eb; border-left:4px solid #d1d5db; border-radius:10px; margin-bottom:.75rem; overflow:hidden; }
.si-group-header {
    display:flex; align-items:center; justify-content:space-between; gap:1rem;
    padding:.7rem 1rem; background:#f9fafb; cursor:pointer; user-select:none;
    border-bottom:1px solid #f3f4f6; flex-wrap:wrap;
}
.si-group-header:hover { background:#f3f4f6; }
.si-group-left  { display:flex; align-items:center; gap:.65rem; flex-wrap:wrap; min-width:0; }
.si-group-right { display:flex; align-items:center; gap:.5rem; flex-shrink:0; }
.si-job-badge { display:inline-flex; padding:.22rem .6rem; border-radius:6px; font-size:.72rem; font-weight:700; font-family:monospace; background:#6b7280; color:#fff; letter-spacing:.04em; white-space:nowrap; }
.si-group-name { font-size:.88rem; font-weight:700; color:#1f2937; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:320px; }
.si-group-client { font-size:.74rem; color:#9ca3af; white-space:nowrap; }
.si-group-status-dots { display:flex; gap:.28rem; align-items:center; }
.si-group-dot { width:8px; height:8px; border-radius:50%; }
.si-dot-draft    { background:#f59e0b; }
.si-dot-complete { background:#10b981; }
.si-dot-approve  { background:#8b5cf6; }
.si-dot-paid     { background:#3b82f6; }
.si-dot-reject   { background:#ef4444; }
.si-group-count { font-size:.72rem; font-weight:600; color:#6b7280; background:#f3f4f6; padding:.18rem .5rem; border-radius:20px; white-space:nowrap; }
.si-group-chevron { color:#d1d5db; transition:transform .2s; flex-shrink:0; }
.si-group.collapsed .si-group-chevron { transform:rotate(-90deg); }
.si-group.collapsed .si-group-body    { display:none; }

/* Inner sheet table */
.si-inner-table { width:100%; border-collapse:collapse; }
.si-inner-table th { padding:.5rem 1rem; font-size:.68rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; background:#fafafa; }
.si-inner-table td { padding:.58rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.si-inner-table tbody tr:last-child td { border-bottom:none; }
.si-inner-table tbody tr:hover td { background:#fafafa; }

/* Empty state */
.si-empty { padding:3rem 1rem; text-align:center; background:#fff; border:1px solid #e5e7eb; border-radius:10px; }
.si-empty-icon { width:52px; height:52px; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.si-empty p { color:#6b7280; font-size:.85rem; margin:.25rem 0; }

/* Approval modal */
.si-modal { display:none; position:fixed; z-index:1050; inset:0; background:rgba(0,0,0,.5); backdrop-filter:blur(2px); }
.si-modal-box { background:#fff; border-radius:10px; max-width:480px; width:90%; margin:8vh auto; box-shadow:0 20px 40px rgba(0,0,0,.2); }
.si-modal-head { padding:1rem 1.25rem; border-bottom:1px solid #e5e7eb; display:flex; justify-content:space-between; align-items:center; }
.si-modal-head h3 { margin:0; font-size:.95rem; font-weight:700; color:#1f2937; }
.si-modal-close { width:28px; height:28px; border-radius:6px; border:none; background:#f3f4f6; color:#6b7280; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:1.1rem; line-height:1; }
.si-modal-close:hover { background:#e5e7eb; color:#374151; }
.si-modal-body { padding:1.25rem; }
.si-modal-foot { padding:.75rem 1.25rem; border-top:1px solid #e5e7eb; background:#f9fafb; display:flex; justify-content:flex-end; gap:.5rem; border-radius:0 0 10px 10px; }
</style>

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:.6rem 1rem;border-radius:8px;font-size:.82rem;margin-bottom:.75rem;display:flex;align-items:center;gap:.5rem;">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div style="background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:.6rem 1rem;border-radius:8px;font-size:.82rem;margin-bottom:.75rem;">{{ session('error') }}</div>
@endif

{{-- Header --}}
<div class="si-header">
    <div>
        <p class="si-title">{{ __('salary_sheets.salary_sheets') }}</p>
        <p class="si-subtitle">{{ $grouped->count() }} job{{ $grouped->count() !== 1 ? 's' : '' }} · {{ $stats['total'] }} sheet{{ $stats['total'] !== 1 ? 's' : '' }} total</p>
    </div>
    <div style="display:flex;gap:.5rem;align-items:center;">
        <button type="button" class="si-btn si-btn-ghost" onclick="toggleAllGroups(true)"  style="font-size:.75rem;padding:.35rem .7rem;">Expand All</button>
        <button type="button" class="si-btn si-btn-ghost" onclick="toggleAllGroups(false)" style="font-size:.75rem;padding:.35rem .7rem;">Collapse All</button>
        @can('create salary sheets')
        <a href="{{ route('admin.salary-sheets.create') }}" class="si-btn si-btn-success">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            {{ __('salary_sheets.create_salary_sheet') }}
        </a>
        @endcan
    </div>
</div>

{{-- Stats --}}
<div class="si-stats">
    <div class="si-stat">
        <div class="si-stat-icon" style="background:#ede9fe;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <div><div class="si-stat-val">{{ $stats['total'] }}</div><div class="si-stat-lbl">Total Sheets</div></div>
    </div>
    <div class="si-stat">
        <div class="si-stat-icon" style="background:#fefce8;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div><div class="si-stat-val">{{ $stats['draft'] }}</div><div class="si-stat-lbl">Draft</div></div>
    </div>
    <div class="si-stat">
        <div class="si-stat-icon" style="background:#f0fdf4;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div><div class="si-stat-val">{{ $stats['complete'] }}</div><div class="si-stat-lbl">Complete</div></div>
    </div>
    <div class="si-stat">
        <div class="si-stat-icon" style="background:#faf5ff;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div><div class="si-stat-val">{{ $stats['approve'] }}</div><div class="si-stat-lbl">Approved</div></div>
    </div>
    <div class="si-stat">
        <div class="si-stat-icon" style="background:#eff6ff;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
        </div>
        <div><div class="si-stat-val">{{ $stats['paid'] }}</div><div class="si-stat-lbl">Paid</div></div>
    </div>
    <div class="si-stat">
        <div class="si-stat-icon" style="background:#fef2f2;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
        <div><div class="si-stat-val">{{ $stats['reject'] }}</div><div class="si-stat-lbl">Rejected</div></div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.salary-sheets.index') }}" id="siFilterForm">
<div class="si-filters">
    <div class="si-filter-row">
        <div class="si-filter-group" style="flex:2;min-width:200px;">
            <label>Search</label>
            <div style="position:relative;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);pointer-events:none;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input class="si-input" id="si-search" name="search" value="{{ request('search') }}" placeholder="Sheet no, job no, client name…" style="padding-left:2rem;">
            </div>
        </div>
        <div class="si-filter-group">
            <label>Status</label>
            <select class="si-input" name="status">
                <option value="">All statuses</option>
                <option value="draft"    {{ request('status') === 'draft'    ? 'selected' : '' }}>Draft</option>
                <option value="complete" {{ request('status') === 'complete' ? 'selected' : '' }}>Complete</option>
                <option value="approve"  {{ request('status') === 'approve'  ? 'selected' : '' }}>Approved</option>
                <option value="paid"     {{ request('status') === 'paid'     ? 'selected' : '' }}>Paid</option>
                <option value="reject"   {{ request('status') === 'reject'   ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <div class="si-filter-group">
            <label>Sort Sheets By</label>
            <select class="si-input" name="sort_by">
                <option value="created_at" {{ request('sort_by','created_at') === 'created_at' ? 'selected' : '' }}>Created Date</option>
                <option value="sheet_no"   {{ request('sort_by') === 'sheet_no'   ? 'selected' : '' }}>Sheet No</option>
                <option value="status"     {{ request('sort_by') === 'status'     ? 'selected' : '' }}>Status</option>
            </select>
        </div>
        <div class="si-filter-group" style="min-width:90px;max-width:110px;">
            <label>Order</label>
            <select class="si-input" name="sort_order">
                <option value="desc" {{ request('sort_order','desc') === 'desc' ? 'selected' : '' }}>Desc</option>
                <option value="asc"  {{ request('sort_order') === 'asc'  ? 'selected' : '' }}>Asc</option>
            </select>
        </div>
        <div style="display:flex;gap:.35rem;padding-bottom:.05rem;">
            <button type="submit" class="si-btn si-btn-primary">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Filter
            </button>
            @if(request()->hasAny(['search','status','date_from','date_to','sort_by','sort_order']))
            <a href="{{ route('admin.salary-sheets.index') }}" class="si-btn si-btn-ghost">Clear</a>
            @endif
        </div>
    </div>
    {{-- Date range toggle --}}
    @if(request('date_from') || request('date_to'))
    <div class="si-filter-row" style="margin-top:.5rem;">
        <div class="si-filter-group" style="max-width:200px;">
            <label>From Date</label>
            <input class="si-input" type="date" name="date_from" value="{{ request('date_from') }}">
        </div>
        <div class="si-filter-group" style="max-width:200px;">
            <label>To Date</label>
            <input class="si-input" type="date" name="date_to" value="{{ request('date_to') }}">
        </div>
    </div>
    @else
    <div style="margin-top:.4rem;">
        <button type="button" onclick="siToggleDates(this)" class="si-btn si-btn-ghost" style="font-size:.75rem;padding:.3rem .65rem;">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Date Range
        </button>
        <div id="si-date-row" style="display:none;margin-top:.5rem;" class="si-filter-row">
            <div class="si-filter-group" style="max-width:200px;">
                <label>From Date</label>
                <input class="si-input" type="date" name="date_from" value="{{ request('date_from') }}">
            </div>
            <div class="si-filter-group" style="max-width:200px;">
                <label>To Date</label>
                <input class="si-input" type="date" name="date_to" value="{{ request('date_to') }}">
            </div>
        </div>
    </div>
    @endif
</div>
</form>

{{-- Grouped Results --}}
@if($grouped->count() > 0)
    @foreach($grouped as $jobId => $sheets)
    @php
        $job    = $sheets->first()->job;
        $counts = $sheets->countBy('status');
        $dotMap = ['draft'=>'si-dot-draft','complete'=>'si-dot-complete','approve'=>'si-dot-approve','paid'=>'si-dot-paid','reject'=>'si-dot-reject'];
    @endphp
    <div class="si-group" id="group-{{ $jobId }}">

        {{-- Group Header --}}
        <div class="si-group-header" onclick="toggleGroup('group-{{ $jobId }}')">
            <div class="si-group-left">
                @if($job)
                    <span class="si-job-badge">{{ $job->job_number ?? 'N/A' }}</span>
                    <span class="si-group-name">{{ $job->job_name ?? '—' }}</span>
                    @if($job->client)
                        <span class="si-group-client">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:.2rem;opacity:.5;"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                            {{ $job->client->name ?? '' }}
                        </span>
                    @endif
                @else
                    <span class="si-group-name" style="color:#9ca3af;">No Job Linked</span>
                @endif
            </div>
            <div class="si-group-right">
                <div class="si-group-status-dots">
                    @foreach($counts as $s => $n)
                        <span title="{{ ucfirst($s) }}: {{ $n }}" class="si-group-dot {{ $dotMap[$s] ?? 'si-dot-draft' }}"></span>
                    @endforeach
                </div>
                <span class="si-group-count">{{ $sheets->count() }} sheet{{ $sheets->count() !== 1 ? 's' : '' }}</span>
                <svg class="si-group-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
        </div>

        {{-- Group Body --}}
        <div class="si-group-body">
            <table class="si-inner-table">
                <thead>
                    <tr>
                        <th>Sheet No.</th>
                        <th>Period</th>
                        <th style="text-align:center;">Rows</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Date</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sheets as $sheet)
                    @php
                        $isComplete   = $sheet->status === 'complete';
                        $badgeClass   = match($sheet->status) {
                            'draft'    => 'si-badge-draft',
                            'complete' => 'si-badge-complete',
                            'approve'  => 'si-badge-approve',
                            'paid'     => 'si-badge-paid',
                            'reject'   => 'si-badge-reject',
                            default    => 'si-badge-draft',
                        };
                        $statusLabel     = $isReporter && $isComplete ? 'Pending Approval' : ucfirst($sheet->status);
                        $badgeClassFinal = $isReporter && $isComplete ? 'si-badge-pending' : $badgeClass;
                    @endphp
                    <tr>
                        <td><span class="si-sheet-no">{{ $sheet->sheet_no }}</span></td>
                        <td style="white-space:nowrap;color:#6b7280;font-size:.78rem;">{{ $sheet->created_at->format('M Y') }}</td>
                        <td style="text-align:center;">
                            <span class="si-count" style="background:#ede9fe;color:#4f46e5;">{{ $sheet->items_count }}</span>
                        </td>
                        <td><span class="si-badge {{ $badgeClassFinal }}">{{ $statusLabel }}</span></td>
                        <td>
                            @if($sheet->creator)
                                <div class="si-creator-name">{{ $sheet->creator->name ?? 'N/A' }}</div>
                                <div class="si-creator-email">{{ $sheet->creator->email ?? '' }}</div>
                            @else
                                <span class="no-val">N/A</span>
                            @endif
                        </td>
                        <td style="white-space:nowrap;color:#6b7280;font-size:.78rem;">{{ $sheet->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="si-actions">
                                @can('view salary sheets')
                                <a href="{{ route('admin.salary-sheets.show', $sheet) }}" class="si-icon-btn si-icon-view" title="View">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                @endcan

                                @if($isReporter && $isComplete)
                                <button type="button" class="si-icon-btn si-icon-approve" onclick="openApprovalModal({{ $sheet->id }}, '{{ $sheet->sheet_no }}')" title="Approve">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                </button>
                                @endif

                                @can('view salary sheets')
                                <a href="{{ route('admin.salary-sheets.export', $sheet) }}" class="si-icon-btn si-icon-export" title="Export Excel">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                </a>
                                <a href="{{ route('admin.salary-sheets.print', $sheet) }}" target="_blank" class="si-icon-btn si-icon-print" title="Print">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6,9 6,2 18,2 18,9"/><path d="M6,18H4a2,2 0 0,1 -2,-2V11a2,2 0 0,1 2,-2H20a2,2 0 0,1 2,2v5a2,2 0 0,1 -2,2H18"/><polyline points="6,14 18,14 18,22 6,22 6,14"/></svg>
                                </a>
                                @endcan

                                @can('delete salary sheets')
                                @if($sheet->job && $sheet->job->status !== 'completed')
                                <form action="{{ route('admin.salary-sheets.destroy', $sheet) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete sheet {{ $sheet->sheet_no }}? This cannot be undone.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="si-icon-btn si-icon-del" title="Delete">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                    </button>
                                </form>
                                @else
                                <span class="si-icon-btn si-icon-del-off" title="Cannot delete">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/></svg>
                                </span>
                                @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
@else
<div class="si-empty">
    <div class="si-empty-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    </div>
    @if(request()->hasAny(['search','status','date_from','date_to']))
        <p style="font-weight:600;color:#374151;">No sheets match your filters</p>
        <p>Try adjusting your search or <a href="{{ route('admin.salary-sheets.index') }}" style="color:#4f46e5;">clear filters</a>.</p>
    @else
        <p style="font-weight:600;color:#374151;">No salary sheets yet</p>
        @can('create salary sheets')
        <p><a href="{{ route('admin.salary-sheets.create') }}" style="color:#4f46e5;">Create the first salary sheet</a></p>
        @endcan
    @endif
</div>
@endif

{{-- Approval Modal --}}
<div id="approvalModal" class="si-modal">
    <div class="si-modal-box">
        <div class="si-modal-head">
            <h3>Approve Salary Sheet</h3>
            <button class="si-modal-close" onclick="closeApprovalModal()">&times;</button>
        </div>
        <div class="si-modal-body">
            <p style="margin-bottom:1rem;font-size:.87rem;color:#374151;">Are you sure you want to approve this salary sheet?</p>
            <div style="background:#f8fafc;border:1px solid #e5e7eb;padding:.75rem 1rem;border-radius:6px;margin-bottom:1rem;font-size:.85rem;">
                <strong>Sheet Number:</strong> <span id="approvalSheetNo" style="font-family:monospace;font-weight:700;color:#312e81;"></span>
            </div>
            <p style="color:#6b7280;font-size:.8rem;margin:0;">This changes the status from <strong>Complete</strong> to <strong>Approved</strong> and cannot be undone.</p>
        </div>
        <div class="si-modal-foot">
            <button type="button" class="si-btn si-btn-ghost" onclick="closeApprovalModal()">Cancel</button>
            <button type="button" class="si-btn si-btn-success" id="approvalConfirmBtn" onclick="confirmApproval()">Confirm Approval</button>
        </div>
    </div>
</div>

<script>
let approvalSheetId = null;

function toggleGroup(id) {
    const el = typeof id === 'string' ? document.getElementById(id) : id.closest('.si-group');
    if (el) el.classList.toggle('collapsed');
}
function toggleAllGroups(expand) {
    document.querySelectorAll('.si-group').forEach(g => {
        expand ? g.classList.remove('collapsed') : g.classList.add('collapsed');
    });
}

function openApprovalModal(sheetId, sheetNo) {
    approvalSheetId = sheetId;
    document.getElementById('approvalSheetNo').textContent = sheetNo;
    document.getElementById('approvalModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}
function closeApprovalModal() {
    document.getElementById('approvalModal').style.display = 'none';
    document.body.style.overflow = '';
    approvalSheetId = null;
}
function confirmApproval() {
    if (!approvalSheetId) return;
    const btn = document.getElementById('approvalConfirmBtn');
    btn.disabled = true; btn.textContent = 'Approving…';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const url  = `{{ route('admin.salary-sheets.approve', ':id') }}`.replace(':id', approvalSheetId);
    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
        body: JSON.stringify({ _token: csrf })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { closeApprovalModal(); location.reload(); }
        else throw new Error(data.message || 'Failed to approve');
    })
    .catch(err => {
        alert('Error: ' + (err.message || 'Failed to approve salary sheet'));
        btn.disabled = false; btn.textContent = 'Confirm Approval';
    });
}

function siToggleDates(btn) {
    const row = document.getElementById('si-date-row');
    if (row) {
        const vis = row.style.display !== 'none';
        row.style.display = vis ? 'none' : 'flex';
        btn.style.background = vis ? '' : '#e5e7eb';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('approvalModal').addEventListener('click', function (e) {
        if (e.target === this) closeApprovalModal();
    });
    ['status','sort_by','sort_order'].forEach(n => {
        const el = document.querySelector('[name="' + n + '"]');
        if (el) el.addEventListener('change', () => document.getElementById('siFilterForm').submit());
    });
    let searchTimer;
    const searchEl = document.getElementById('si-search');
    if (searchEl) {
        searchEl.addEventListener('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => document.getElementById('siFilterForm').submit(), 500);
        });
    }
});
</script>
@endsection
