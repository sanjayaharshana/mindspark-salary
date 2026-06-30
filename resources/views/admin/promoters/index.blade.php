@extends('layouts.admin')

@section('title', 'Promoter Management')
@section('page-title', 'Promoter Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Promoters</span>
@endsection

@section('content')
<style>
.pm-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.pm-title { font-size:1.1rem; font-weight:700; color:#1f2937; margin:0; }
.pm-subtitle { font-size:.75rem; color:#6b7280; margin:.1rem 0 0; }

.pm-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:.625rem; margin-bottom:1rem; }
.pm-stat { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; display:flex; align-items:center; gap:.75rem; }
.pm-stat-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.pm-stat-val { font-size:1.25rem; font-weight:700; color:#1f2937; line-height:1; }
.pm-stat-lbl { font-size:.7rem; color:#6b7280; margin-top:.1rem; }

.pm-filters { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; margin-bottom:1rem; }
.pm-filter-row { display:flex; gap:.625rem; flex-wrap:wrap; align-items:flex-end; }
.pm-filter-group { display:flex; flex-direction:column; gap:.25rem; flex:1; min-width:150px; }
.pm-filter-group label { font-size:.72rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.pm-input { padding:.45rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.pm-input:focus { border-color:#f43f5e; box-shadow:0 0 0 3px rgba(244,63,94,.1); }

.pm-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.pm-btn-primary { background:#f43f5e; color:#fff; } .pm-btn-primary:hover { background:#e11d48; }
.pm-btn-success { background:#10b981; color:#fff; } .pm-btn-success:hover { background:#059669; }
.pm-btn-info    { background:#3b82f6; color:#fff; } .pm-btn-info:hover    { background:#2563eb; }
.pm-btn-ghost   { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .pm-btn-ghost:hover { background:#e5e7eb; }
.pm-icon-btn { width:28px; height:28px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.pm-icon-view { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .pm-icon-view:hover { background:#e5e7eb; color:#374151; }
.pm-icon-edit { background:#fff1f2; border-color:#fecdd3; color:#e11d48; } .pm-icon-edit:hover { background:#ffe4e6; }
.pm-icon-del  { background:#fef2f2; border-color:#fecaca; color:#dc2626; } .pm-icon-del:hover  { background:#fee2e2; }

.pm-table-wrap { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.pm-table { width:100%; border-collapse:collapse; }
.pm-table thead tr { background:#f8fafc; }
.pm-table th { padding:.6rem 1rem; font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
.pm-table td { padding:.65rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.pm-table tbody tr:last-child td { border-bottom:none; }
.pm-table tbody tr:hover td { background:#f9fafb; }

.pm-avatar { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#f43f5e,#e11d48); color:#fff; font-size:.72rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.pm-user-cell { display:flex; align-items:center; gap:.6rem; }
.pm-user-name { font-weight:600; color:#1f2937; font-size:.83rem; }

.pm-pid { display:inline-flex; padding:.18rem .55rem; border-radius:5px; font-size:.7rem; font-weight:700; font-family:monospace; background:#1f2937; color:#fff; }
.pos-badge { display:inline-flex; padding:.15rem .45rem; border-radius:5px; font-size:.7rem; font-weight:600; background:#fdf2f8; color:#a21caf; border:1px solid #f5d0fe; }
.pm-status { display:inline-flex; padding:.18rem .55rem; border-radius:20px; font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.04em; }
.pm-status-active    { background:#d1fae5; color:#065f46; }
.pm-status-inactive  { background:#fef3c7; color:#92400e; }
.pm-status-suspended { background:#fee2e2; color:#991b1b; }

.pm-bank-name { font-weight:500; font-size:.82rem; }
.pm-bank-sub { font-size:.7rem; color:#6b7280; }
.pm-bank-acc { font-size:.72rem; color:#6b7280; font-family:monospace; }
.no-val { font-size:.75rem; color:#9ca3af; font-style:italic; }
.pm-actions { display:flex; gap:.3rem; justify-content:flex-end; }
.pm-pagination { border-top:1px solid #e5e7eb; }
.pm-empty { padding:3rem 1rem; text-align:center; }
.pm-empty-icon { width:48px; height:48px; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.pm-empty p { color:#6b7280; font-size:.85rem; margin:.25rem 0; }

/* CSV Import Modal */
.pm-modal { position:fixed; z-index:1050; inset:0; background:rgba(0,0,0,.55); backdrop-filter:blur(2px); display:flex; align-items:center; justify-content:center; padding:1rem; }
.pm-modal-box { background:#fff; border-radius:10px; width:100%; max-width:560px; max-height:90vh; box-shadow:0 25px 50px -12px rgba(0,0,0,.25); display:flex; flex-direction:column; overflow:hidden; }
.pm-modal-head { padding:1rem 1.25rem; border-bottom:1px solid #e5e7eb; display:flex; justify-content:space-between; align-items:center; }
.pm-modal-title { font-size:.95rem; font-weight:700; color:#1f2937; margin:0; }
.pm-modal-close { width:28px; height:28px; border-radius:6px; border:none; background:#f3f4f6; color:#6b7280; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:1rem; }
.pm-modal-close:hover { background:#e5e7eb; color:#374151; }
.pm-modal-body { padding:1rem 1.25rem; overflow-y:auto; flex:1; }
.pm-modal-foot { padding:.75rem 1.25rem; border-top:1px solid #e5e7eb; background:#fafafa; display:flex; justify-content:flex-end; gap:.5rem; }
.pm-info-box { background:#eff6ff; border:1px solid #bfdbfe; border-radius:6px; padding:.75rem 1rem; font-size:.78rem; color:#1e40af; margin-bottom:.75rem; }
.pm-info-box ul { margin:.4rem 0 0 1.1rem; padding:0; }
.pm-info-box li { margin-bottom:.2rem; }
.pm-warn-box { background:#fffbeb; border:1px solid #fde68a; border-radius:6px; padding:.75rem 1rem; font-size:.78rem; color:#92400e; }
.pm-warn-box ul { margin:.4rem 0 0 1.1rem; padding:0; }
.pm-warn-box li { margin-bottom:.2rem; }
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
<div class="pm-header">
    <div>
        <p class="pm-title">All Promoters</p>
        <p class="pm-subtitle">Manage promoter profiles and their assignments</p>
    </div>
    <div style="display:flex;gap:.4rem;flex-wrap:wrap;">
        @can('create promoters')
        <button type="button" class="pm-btn pm-btn-info" onclick="openCsvModal()">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            Import CSV
        </button>
        <a href="{{ route('admin.promoters.create') }}" class="pm-btn pm-btn-success">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New Promoter
        </a>
        @endcan
    </div>
</div>

{{-- Stats --}}
<div class="pm-stats">
    <div class="pm-stat">
        <div class="pm-stat-icon" style="background:#fff1f2;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f43f5e" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div><div class="pm-stat-val">{{ $total }}</div><div class="pm-stat-lbl">Total Promoters</div></div>
    </div>
    <div class="pm-stat">
        <div class="pm-stat-icon" style="background:#f0fdf4;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div><div class="pm-stat-val">{{ $active }}</div><div class="pm-stat-lbl">Active</div></div>
    </div>
    <div class="pm-stat">
        <div class="pm-stat-icon" style="background:#fefce8;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ca8a04" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div><div class="pm-stat-val">{{ $inactive }}</div><div class="pm-stat-lbl">Inactive</div></div>
    </div>
    <div class="pm-stat">
        <div class="pm-stat-icon" style="background:#fef2f2;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
        <div><div class="pm-stat-val">{{ $suspended }}</div><div class="pm-stat-lbl">Suspended</div></div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.promoters.index') }}" id="pmFilterForm">
<div class="pm-filters">
    <div class="pm-filter-row">
        <div class="pm-filter-group" style="flex:2;min-width:200px;">
            <label>Search</label>
            <div style="position:relative;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input class="pm-input" id="pm-search" name="search" value="{{ request('search') }}" placeholder="Name, ID, phone, ID card…" style="padding-left:2rem;">
            </div>
        </div>
        <div class="pm-filter-group">
            <label>Position</label>
            <select class="pm-input" name="position">
                <option value="">All positions</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ request('position') == $pos->id ? 'selected' : '' }}>{{ $pos->position_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="pm-filter-group">
            <label>Status</label>
            <select class="pm-input" name="status">
                <option value="">All statuses</option>
                <option value="active"    {{ request('status') === 'active'    ? 'selected' : '' }}>Active</option>
                <option value="inactive"  {{ request('status') === 'inactive'  ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
        </div>
        <div class="pm-filter-group">
            <label>Sort By</label>
            <select class="pm-input" name="sort_by">
                <option value="created_at"    {{ request('sort_by', 'created_at') == 'created_at'    ? 'selected' : '' }}>Created Date</option>
                <option value="promoter_name" {{ request('sort_by') == 'promoter_name' ? 'selected' : '' }}>Name</option>
                <option value="promoter_id"   {{ request('sort_by') == 'promoter_id'   ? 'selected' : '' }}>Promoter ID</option>
                <option value="status"        {{ request('sort_by') == 'status'        ? 'selected' : '' }}>Status</option>
            </select>
        </div>
        <div class="pm-filter-group" style="min-width:90px;max-width:110px;">
            <label>Order</label>
            <select class="pm-input" name="sort_order">
                <option value="desc" {{ request('sort_order', 'desc') == 'desc' ? 'selected' : '' }}>Desc</option>
                <option value="asc"  {{ request('sort_order') == 'asc'  ? 'selected' : '' }}>Asc</option>
            </select>
        </div>
        <div style="display:flex;gap:.35rem;padding-bottom:.05rem;">
            <button type="submit" class="pm-btn pm-btn-primary">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Filter
            </button>
            @if(request()->hasAny(['search','position','status','date_from','date_to','sort_by','sort_order']))
            <a href="{{ route('admin.promoters.index') }}" class="pm-btn pm-btn-ghost">Clear</a>
            @endif
        </div>
    </div>
    {{-- Date row --}}
    @if(request('date_from') || request('date_to'))
    <div class="pm-filter-row" style="margin-top:.5rem;">
        <div class="pm-filter-group" style="max-width:200px;">
            <label>From Date</label>
            <input class="pm-input" type="date" name="date_from" value="{{ request('date_from') }}">
        </div>
        <div class="pm-filter-group" style="max-width:200px;">
            <label>To Date</label>
            <input class="pm-input" type="date" name="date_to" value="{{ request('date_to') }}">
        </div>
    </div>
    @else
    <div style="margin-top:.4rem;">
        <button type="button" onclick="toggleDateFilters(this)" class="pm-btn pm-btn-ghost" style="font-size:.75rem;padding:.3rem .65rem;">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Date Range
        </button>
        <div id="pm-date-row" style="display:none;margin-top:.5rem;" class="pm-filter-row">
            <div class="pm-filter-group" style="max-width:200px;">
                <label>From Date</label>
                <input class="pm-input" type="date" name="date_from" value="{{ request('date_from') }}">
            </div>
            <div class="pm-filter-group" style="max-width:200px;">
                <label>To Date</label>
                <input class="pm-input" type="date" name="date_to" value="{{ request('date_to') }}">
            </div>
        </div>
    </div>
    @endif
</div>
</form>

{{-- Table --}}
<div class="pm-table-wrap">
    @if($promoters->count() > 0)
    <table class="pm-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Promoter</th>
                <th>Position</th>
                <th>ID Card</th>
                <th>Phone</th>
                <th>Bank</th>
                <th>Status</th>
                <th>Joined</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promoters as $promoter)
            <tr>
                <td style="color:#9ca3af;font-size:.75rem;">{{ $promoters->firstItem() + $loop->index }}</td>
                <td>
                    <div class="pm-user-cell">
                        <div class="pm-avatar">{{ strtoupper(substr($promoter->promoter_name,0,1)) }}{{ strtoupper(substr(explode(' ',$promoter->promoter_name)[1] ?? '',0,1)) }}</div>
                        <div>
                            <div class="pm-user-name">{{ $promoter->promoter_name }}</div>
                            <span class="pm-pid">{{ $promoter->promoter_id }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    @if($promoter->position)
                        <span class="pos-badge">{{ $promoter->position->position_name }}</span>
                    @else
                        <span class="no-val">No position</span>
                    @endif
                </td>
                <td style="font-family:monospace;font-size:.78rem;color:#374151;">{{ $promoter->identity_card_no }}</td>
                <td style="font-size:.82rem;white-space:nowrap;">{{ $promoter->phone_no }}</td>
                <td>
                    <div class="pm-bank-name">{{ $promoter->bank_name }}</div>
                    <div class="pm-bank-sub">{{ $promoter->bank_branch_name }}</div>
                    <div class="pm-bank-acc">****{{ substr($promoter->bank_account_number, -4) }}</div>
                </td>
                <td><span class="pm-status pm-status-{{ $promoter->status }}">{{ ucfirst($promoter->status) }}</span></td>
                <td style="white-space:nowrap;color:#6b7280;font-size:.78rem;">{{ $promoter->created_at->format('d M Y') }}</td>
                <td>
                    <div class="pm-actions">
                        @can('view promoters')
                        <a href="{{ route('admin.promoters.show', $promoter) }}" class="pm-icon-btn pm-icon-view" title="View">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        @endcan
                        @can('edit promoters')
                        <a href="{{ route('admin.promoters.edit', $promoter) }}" class="pm-icon-btn pm-icon-edit" title="Edit">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        @endcan
                        @can('delete promoters')
                        <form method="POST" action="{{ route('admin.promoters.destroy', $promoter) }}" style="display:inline;" onsubmit="return confirm('Delete {{ addslashes($promoter->promoter_name) }}? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="pm-icon-btn pm-icon-del" title="Delete">
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
    <div class="pm-pagination">
        {{ $promoters->links() }}
    </div>
    @else
    <div class="pm-empty">
        <div class="pm-empty-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        @if(request()->hasAny(['search','position','status','date_from','date_to']))
            <p style="font-weight:600;color:#374151;">No promoters match your filters</p>
            <p>Try adjusting your search or <a href="{{ route('admin.promoters.index') }}" style="color:#f43f5e;">clear filters</a>.</p>
        @else
            <p style="font-weight:600;color:#374151;">No promoters yet</p>
            @can('create promoters')
            <p><a href="{{ route('admin.promoters.create') }}" style="color:#f43f5e;">Add the first promoter</a></p>
            @endcan
        @endif
    </div>
    @endif
</div>

{{-- CSV Import Modal --}}
<div id="pm-csv-modal" class="pm-modal" style="display:none;">
    <div class="pm-modal-box">
        <div class="pm-modal-head">
            <p class="pm-modal-title">Import Promoters from CSV</p>
            <button class="pm-modal-close" onclick="closeCsvModal()">&times;</button>
        </div>
        <form id="pm-csv-form" action="{{ route('admin.promoters.import-csv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="pm-modal-body">
                <div style="margin-bottom:.75rem;">
                    <label class="pm-filter-group" style="gap:.3rem;">
                        <span style="font-size:.75rem;font-weight:600;color:#374151;">Select CSV File</span>
                        <input type="file" class="pm-input" name="csv_file" accept=".csv" required>
                    </label>
                </div>
                <div class="pm-info-box">
                    <strong>Required CSV columns:</strong>
                    <ul>
                        <li><strong>promoter_name</strong> — Full name</li>
                        <li><strong>position_name</strong> — Must match an existing position</li>
                        <li><strong>identity_card_no</strong> — ID card number</li>
                        <li><strong>phone_no</strong> — Phone number</li>
                        <li><strong>bank_name</strong>, <strong>bank_branch_name</strong>, <strong>bank_account_number</strong></li>
                        <li><strong>status</strong> — active / inactive / suspended</li>
                    </ul>
                    <div style="margin-top:.5rem;">
                        <a href="{{ asset('sample-promoters.csv') }}" class="pm-btn pm-btn-ghost" style="font-size:.75rem;padding:.3rem .65rem;" download>
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Download Sample CSV
                        </a>
                    </div>
                </div>
                <div class="pm-warn-box">
                    <strong>Important:</strong>
                    <ul>
                        <li>Promoter IDs are auto-generated</li>
                        <li>Duplicate phone or ID card numbers are skipped</li>
                        <li>Status must be exactly: active, inactive, or suspended</li>
                    </ul>
                </div>
                <div id="pm-import-status" style="display:none;margin-top:.75rem;padding:.6rem .85rem;border-radius:6px;font-size:.8rem;"></div>
            </div>
            <div class="pm-modal-foot">
                <button type="button" class="pm-btn pm-btn-ghost" onclick="closeCsvModal()">Cancel</button>
                <button type="submit" class="pm-btn pm-btn-primary" id="pm-import-btn">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    Import CSV
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCsvModal() {
    document.getElementById('pm-csv-modal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeCsvModal() {
    document.getElementById('pm-csv-modal').style.display = 'none';
    document.body.style.overflow = '';
    document.getElementById('pm-csv-form').reset();
    document.getElementById('pm-import-status').style.display = 'none';
}
function toggleDateFilters(btn) {
    const row = document.getElementById('pm-date-row');
    if (row) {
        const vis = row.style.display !== 'none';
        row.style.display = vis ? 'none' : 'flex';
        btn.style.background = vis ? '' : '#e5e7eb';
    }
}
document.addEventListener('DOMContentLoaded', function () {
    // Close modal on backdrop click
    document.getElementById('pm-csv-modal').addEventListener('click', function (e) {
        if (e.target === this) closeCsvModal();
    });

    // CSV form AJAX submit
    const form = document.getElementById('pm-csv-form');
    const btn  = document.getElementById('pm-import-btn');
    const status = document.getElementById('pm-import-status');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        btn.disabled = true;
        btn.textContent = 'Importing…';
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(r => r.json())
        .then(d => {
            status.style.display = 'block';
            if (d.success) {
                status.style.cssText = 'display:block;background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:.6rem .85rem;border-radius:6px;font-size:.8rem;margin-top:.75rem;';
                status.textContent = d.message;
                setTimeout(() => location.reload(), 1800);
            } else {
                status.style.cssText = 'display:block;background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:.6rem .85rem;border-radius:6px;font-size:.8rem;margin-top:.75rem;';
                status.textContent = d.message || 'Import failed.';
            }
        })
        .catch(() => {
            status.style.cssText = 'display:block;background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:.6rem .85rem;border-radius:6px;font-size:.8rem;margin-top:.75rem;';
            status.textContent = 'An error occurred. Please try again.';
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> Import CSV';
        });
    });

    // Auto-submit selects
    ['position','status','sort_by','sort_order'].forEach(n => {
        const el = document.querySelector('[name="' + n + '"]');
        if (el) el.addEventListener('change', () => document.getElementById('pmFilterForm').submit());
    });

    // Debounced search
    let t;
    const s = document.getElementById('pm-search');
    if (s) s.addEventListener('input', () => { clearTimeout(t); t = setTimeout(() => document.getElementById('pmFilterForm').submit(), 500); });
});
</script>
@endsection
