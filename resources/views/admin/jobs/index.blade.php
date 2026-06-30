@extends('layouts.admin')

@section('title', 'Job ID Management')
@section('page-title', 'Job ID Management')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Jobs</span>
@endsection

@section('content')
<style>
.jm-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.jm-title { font-size:1.1rem; font-weight:700; color:#1f2937; margin:0; }
.jm-subtitle { font-size:.75rem; color:#6b7280; margin:.1rem 0 0; }

.jm-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:.625rem; margin-bottom:1rem; }
.jm-stat { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; display:flex; align-items:center; gap:.75rem; }
.jm-stat-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.jm-stat-val { font-size:1.25rem; font-weight:700; color:#1f2937; line-height:1; }
.jm-stat-lbl { font-size:.7rem; color:#6b7280; margin-top:.1rem; }

.jm-filters { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; margin-bottom:1rem; display:flex; gap:.625rem; flex-wrap:wrap; align-items:flex-end; }
.jm-filter-group { display:flex; flex-direction:column; gap:.25rem; flex:1; min-width:150px; }
.jm-filter-group label { font-size:.72rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.jm-input { padding:.45rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.jm-input:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.1); }

.jm-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.jm-btn-primary { background:#f97316; color:#fff; } .jm-btn-primary:hover { background:#ea580c; }
.jm-btn-success { background:#10b981; color:#fff; } .jm-btn-success:hover { background:#059669; }
.jm-btn-ghost  { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .jm-btn-ghost:hover { background:#e5e7eb; }
.jm-icon-btn { width:28px; height:28px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.jm-icon-view { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .jm-icon-view:hover { background:#e5e7eb; color:#374151; }
.jm-icon-edit { background:#fff7ed; border-color:#fed7aa; color:#ea580c; } .jm-icon-edit:hover { background:#ffedd5; }
.jm-icon-del  { background:#fef2f2; border-color:#fecaca; color:#dc2626; } .jm-icon-del:hover  { background:#fee2e2; }

.jm-table-wrap { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.jm-table { width:100%; border-collapse:collapse; }
.jm-table thead tr { background:#f8fafc; }
.jm-table th { padding:.6rem 1rem; font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
.jm-table td { padding:.65rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.jm-table tbody tr:last-child td { border-bottom:none; }
.jm-table tbody tr:hover td { background:#f9fafb; }

.jm-jobnum { display:inline-flex; padding:.18rem .55rem; border-radius:5px; font-size:.72rem; font-weight:700; font-family:monospace; background:#1f2937; color:#fff; letter-spacing:.03em; }
.jm-job-name { font-weight:600; color:#1f2937; font-size:.83rem; }
.jm-job-desc { font-size:.72rem; color:#6b7280; margin-top:.1rem; }
.jm-client-code { display:inline-flex; padding:.15rem .45rem; border-radius:5px; font-size:.7rem; font-weight:700; font-family:monospace; background:#fff7ed; color:#c2410c; border:1px solid #fed7aa; }
.jm-person-name { font-weight:500; color:#1f2937; font-size:.82rem; }
.jm-person-sub { font-size:.7rem; color:#6b7280; margin-top:.1rem; }

.jm-status { display:inline-flex; padding:.18rem .55rem; border-radius:20px; font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.04em; }
.jm-status-pending     { background:#fef3c7; color:#92400e; }
.jm-status-in_progress { background:#dbeafe; color:#1e40af; }
.jm-status-completed   { background:#d1fae5; color:#065f46; }
.jm-status-cancelled   { background:#fee2e2; color:#991b1b; }

.jm-overdue { font-size:.68rem; color:#ef4444; font-weight:600; margin-top:.15rem; }
.no-val { font-size:.75rem; color:#9ca3af; font-style:italic; }
.jm-actions { display:flex; gap:.3rem; justify-content:flex-end; }
.jm-pagination { border-top:1px solid #e5e7eb; }
.jm-empty { padding:3rem 1rem; text-align:center; }
.jm-empty-icon { width:48px; height:48px; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.jm-empty p { color:#6b7280; font-size:.85rem; margin:.25rem 0; }
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
<div class="jm-header">
    <div>
        <p class="jm-title">All Jobs</p>
        <p class="jm-subtitle">Manage job IDs and their assignments</p>
    </div>
    @can('create jobs')
    <a href="{{ route('admin.jobs.create') }}" class="jm-btn jm-btn-success">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Create New Job
    </a>
    @endcan
</div>

{{-- Stats --}}
<div class="jm-stats">
    <div class="jm-stat">
        <div class="jm-stat-icon" style="background:#fff7ed;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
        </div>
        <div><div class="jm-stat-val">{{ $total }}</div><div class="jm-stat-lbl">Total Jobs</div></div>
    </div>
    <div class="jm-stat">
        <div class="jm-stat-icon" style="background:#fefce8;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ca8a04" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div><div class="jm-stat-val">{{ $pending }}</div><div class="jm-stat-lbl">Pending</div></div>
    </div>
    <div class="jm-stat">
        <div class="jm-stat-icon" style="background:#eff6ff;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        </div>
        <div><div class="jm-stat-val">{{ $inProgress }}</div><div class="jm-stat-lbl">In Progress</div></div>
    </div>
    <div class="jm-stat">
        <div class="jm-stat-icon" style="background:#f0fdf4;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div><div class="jm-stat-val">{{ $completed }}</div><div class="jm-stat-lbl">Completed</div></div>
    </div>
    <div class="jm-stat">
        <div class="jm-stat-icon" style="background:#fef2f2;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
        <div><div class="jm-stat-val">{{ $cancelled }}</div><div class="jm-stat-lbl">Cancelled</div></div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.jobs.index') }}">
<div class="jm-filters">
    <div class="jm-filter-group" style="flex:2;min-width:200px;">
        <label>Search</label>
        <div style="position:relative;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input class="jm-input" name="search" value="{{ request('search') }}" placeholder="Job number, name, client…" style="padding-left:2rem;">
        </div>
    </div>
    <div class="jm-filter-group">
        <label>Status</label>
        <select class="jm-input" name="status">
            <option value="">All statuses</option>
            <option value="pending"     {{ request('status') === 'pending'     ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed"   {{ request('status') === 'completed'   ? 'selected' : '' }}>Completed</option>
            <option value="cancelled"   {{ request('status') === 'cancelled'   ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
    <div class="jm-filter-group">
        <label>Client</label>
        <select class="jm-input" name="client_id">
            <option value="">All clients</option>
            @foreach($clients as $c)
                <option value="{{ $c->id }}" {{ request('client_id') == $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->short_code }})</option>
            @endforeach
        </select>
    </div>
    <div class="jm-filter-group">
        <label>Officer</label>
        <select class="jm-input" name="officer_id">
            <option value="">All officers</option>
            @foreach($officers as $o)
                <option value="{{ $o->id }}" {{ request('officer_id') == $o->id ? 'selected' : '' }}>{{ $o->name }}</option>
            @endforeach
        </select>
    </div>
    <div style="display:flex;gap:.35rem;padding-bottom:.05rem;">
        <button type="submit" class="jm-btn jm-btn-primary">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Filter
        </button>
        @if(request('search') || request('status') || request('client_id') || request('officer_id'))
        <a href="{{ route('admin.jobs.index') }}" class="jm-btn jm-btn-ghost">Clear</a>
        @endif
    </div>
</div>
</form>

{{-- Table --}}
<div class="jm-table-wrap">
    @if($jobs->count() > 0)
    <table class="jm-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Job No.</th>
                <th>Job Name</th>
                <th>Client</th>
                <th>Officer / Reporter</th>
                <th>Status</th>
                <th>Dates</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td style="color:#9ca3af;font-size:.75rem;">{{ $jobs->firstItem() + $loop->index }}</td>
                <td><span class="jm-jobnum">{{ $job->job_number }}</span></td>
                <td>
                    <div class="jm-job-name">{{ $job->job_name }}</div>
                    @if($job->description)
                        <div class="jm-job-desc">{{ Str::limit($job->description, 45) }}</div>
                    @endif
                </td>
                <td>
                    <div style="display:flex;align-items:center;gap:.4rem;flex-wrap:wrap;">
                        <span class="jm-client-code">{{ $job->client->short_code ?? '—' }}</span>
                        <span style="font-size:.82rem;color:#374151;">{{ $job->client->name ?? '—' }}</span>
                    </div>
                </td>
                <td>
                    @if($job->officer)
                        <div class="jm-person-name">{{ $job->officer->name }}</div>
                        @if($job->reporter)
                            <div class="jm-person-sub">{{ $job->reporter->name }}</div>
                        @endif
                    @else
                        <span class="no-val">Not assigned</span>
                    @endif
                </td>
                <td>
                    <span class="jm-status jm-status-{{ $job->status }}">{{ ucfirst(str_replace('_', ' ', $job->status)) }}</span>
                    @if($job->is_overdue)
                        <div class="jm-overdue">Overdue</div>
                    @endif
                </td>
                <td style="white-space:nowrap;color:#6b7280;font-size:.78rem;">
                    <div>{{ $job->start_date ? $job->start_date->format('d M Y') : '—' }}</div>
                    <div>{{ $job->end_date   ? $job->end_date->format('d M Y')   : '—' }}</div>
                </td>
                <td>
                    <div class="jm-actions">
                        @can('view jobs')
                        <a href="{{ route('admin.jobs.show', $job) }}" class="jm-icon-btn jm-icon-view" title="View">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        @endcan
                        @can('edit jobs')
                        <a href="{{ route('admin.jobs.edit', $job) }}" class="jm-icon-btn jm-icon-edit" title="Edit">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        @endcan
                        @can('delete jobs')
                        <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}" style="display:inline;" onsubmit="return confirm('Delete job {{ addslashes($job->job_number) }}? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="jm-icon-btn jm-icon-del" title="Delete">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                            </button>
                        </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="jm-pagination">
        {{ $jobs->links() }}
    </div>
    @else
    <div class="jm-empty">
        <div class="jm-empty-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
        </div>
        @if(request('search') || request('status') || request('client_id') || request('officer_id'))
            <p style="font-weight:600;color:#374151;">No jobs match your filters</p>
            <p>Try adjusting your search or <a href="{{ route('admin.jobs.index') }}" style="color:#f97316;">clear filters</a>.</p>
        @else
            <p style="font-weight:600;color:#374151;">No jobs yet</p>
            @can('create jobs')
            <p><a href="{{ route('admin.jobs.create') }}" style="color:#f97316;">Create the first job</a></p>
            @endcan
        @endif
    </div>
    @endif
</div>
@endsection
