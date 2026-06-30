@extends('layouts.admin')

@section('title', 'Officer Management')
@section('page-title', 'Officer Management')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Officers</span>
@endsection

@section('content')
<style>
.of-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.of-title { font-size:1.1rem; font-weight:700; color:#1f2937; margin:0; }
.of-subtitle { font-size:.75rem; color:#6b7280; margin:.1rem 0 0; }

.of-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:.625rem; margin-bottom:1rem; }
.of-stat { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; display:flex; align-items:center; gap:.75rem; }
.of-stat-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.of-stat-val { font-size:1.25rem; font-weight:700; color:#1f2937; line-height:1; }
.of-stat-lbl { font-size:.7rem; color:#6b7280; margin-top:.1rem; }

.of-filters { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; margin-bottom:1rem; display:flex; gap:.625rem; flex-wrap:wrap; align-items:flex-end; }
.of-filter-group { display:flex; flex-direction:column; gap:.25rem; flex:1; min-width:200px; }
.of-filter-group label { font-size:.72rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.of-input { padding:.45rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.of-input:focus { border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,.1); }

.of-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.of-btn-primary { background:#6366f1; color:#fff; } .of-btn-primary:hover { background:#4f46e5; }
.of-btn-success { background:#10b981; color:#fff; } .of-btn-success:hover { background:#059669; }
.of-btn-ghost  { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .of-btn-ghost:hover { background:#e5e7eb; }
.of-btn-danger { background:#ef4444; color:#fff; } .of-btn-danger:hover { background:#dc2626; }
.of-btn-sm { padding:.3rem .65rem; font-size:.75rem; }
.of-icon-btn { width:28px; height:28px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.of-icon-view { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .of-icon-view:hover { background:#e5e7eb; color:#374151; }
.of-icon-edit { background:#eef2ff; border-color:#c7d2fe; color:#4f46e5; } .of-icon-edit:hover { background:#e0e7ff; }
.of-icon-del  { background:#fef2f2; border-color:#fecaca; color:#dc2626; } .of-icon-del:hover  { background:#fee2e2; }

.of-table-wrap { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.of-table { width:100%; border-collapse:collapse; }
.of-table thead tr { background:#f8fafc; }
.of-table th { padding:.6rem 1rem; font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
.of-table td { padding:.65rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.of-table tbody tr:last-child td { border-bottom:none; }
.of-table tbody tr:hover td { background:#f9fafb; }

.of-avatar { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#4f46e5); color:#fff; font-size:.72rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.of-user-cell { display:flex; align-items:center; gap:.6rem; }
.of-user-name { font-weight:600; color:#1f2937; font-size:.83rem; }
.of-user-email { font-size:.72rem; color:#6b7280; }

.xid-badge { display:inline-flex; align-items:center; gap:.25rem; padding:.15rem .5rem; border-radius:5px; font-size:.68rem; font-weight:600; font-family:monospace; background:#ede9fe; color:#5b21b6; border:1px solid #ddd6fe; }
.role-badge { display:inline-flex; padding:.12rem .45rem; border-radius:20px; font-size:.68rem; font-weight:600; background:#dbeafe; color:#1e40af; margin:.1rem .1rem 0 0; text-transform:capitalize; }
.no-val { font-size:.75rem; color:#9ca3af; font-style:italic; }

.of-actions { display:flex; gap:.3rem; flex-wrap:wrap; }
.of-pagination { border-top:1px solid #e5e7eb; }
.of-empty { padding:3rem 1rem; text-align:center; }
.of-empty-icon { width:48px; height:48px; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.of-empty p { color:#6b7280; font-size:.85rem; margin:.25rem 0; }
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
<div class="of-header">
    <div>
        <p class="of-title">All Officers</p>
        <p class="of-subtitle">Manage officer accounts and their access</p>
    </div>
    <a href="{{ route('admin.officers.create') }}" class="of-btn of-btn-success">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add New Officer
    </a>
</div>

{{-- Stats --}}
<div class="of-stats">
    <div class="of-stat">
        <div class="of-stat-icon" style="background:#eef2ff;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div><div class="of-stat-val">{{ $total }}</div><div class="of-stat-lbl">Total Officers</div></div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.officers.index') }}">
<div class="of-filters">
    <div class="of-filter-group">
        <label>Search</label>
        <div style="position:relative;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input class="of-input" name="search" value="{{ request('search') }}" placeholder="Search by name, email or Xelenic ID…" style="padding-left:2rem;">
        </div>
    </div>
    <div style="display:flex;gap:.35rem;padding-bottom:.05rem;">
        <button type="submit" class="of-btn of-btn-primary">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Filter
        </button>
        @if(request('search'))
        <a href="{{ route('admin.officers.index') }}" class="of-btn of-btn-ghost">Clear</a>
        @endif
    </div>
</div>
</form>

{{-- Table --}}
<div class="of-table-wrap">
    @if($officers->count() > 0)
    <table class="of-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Officer</th>
                <th>Xelenic ID</th>
                <th>Roles</th>
                <th>Joined</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($officers as $officer)
            <tr>
                <td style="color:#9ca3af;font-size:.75rem;">{{ $officers->firstItem() + $loop->index }}</td>
                <td>
                    <div class="of-user-cell">
                        <div class="of-avatar">{{ strtoupper(substr($officer->name,0,1)) }}{{ strtoupper(substr(explode(' ',$officer->name)[1] ?? '',0,1)) }}</div>
                        <div>
                            <div class="of-user-name">{{ $officer->name }}</div>
                            <div class="of-user-email">{{ $officer->email }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @if($officer->xelenic_id)
                        <span class="xid-badge">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                            {{ $officer->xelenic_id }}
                        </span>
                    @else
                        <span class="no-val">Not set</span>
                    @endif
                </td>
                <td>
                    @foreach($officer->roles as $role)
                        <span class="role-badge">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td style="white-space:nowrap;color:#6b7280;">{{ $officer->created_at->format('d M Y') }}</td>
                <td>
                    <div class="of-actions" style="justify-content:flex-end;">
                        <a href="{{ route('admin.officers.show', $officer) }}" class="of-icon-btn of-icon-view" title="View">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('admin.officers.edit', $officer) }}" class="of-icon-btn of-icon-edit" title="Edit">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        @if($officer->id !== Auth::id())
                        <form method="POST" action="{{ route('admin.officers.destroy', $officer) }}" style="display:inline;" onsubmit="return confirm('Delete {{ addslashes($officer->name) }}? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="of-icon-btn of-icon-del" title="Delete">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="of-pagination">
        {{ $officers->links() }}
    </div>
    @else
    <div class="of-empty">
        <div class="of-empty-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        @if(request('search'))
            <p style="font-weight:600;color:#374151;">No officers match your search</p>
            <p>Try adjusting your search or <a href="{{ route('admin.officers.index') }}" style="color:#6366f1;">clear filters</a>.</p>
        @else
            <p style="font-weight:600;color:#374151;">No officers yet</p>
            <p><a href="{{ route('admin.officers.create') }}" style="color:#6366f1;">Add the first officer</a></p>
        @endif
    </div>
    @endif
</div>
@endsection
