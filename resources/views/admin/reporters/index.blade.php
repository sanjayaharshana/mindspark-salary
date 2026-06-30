@extends('layouts.admin')

@section('title', 'Reporter Management')
@section('page-title', 'Reporter Management')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Reporters</span>
@endsection

@section('content')
<style>
.rp-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.rp-title { font-size:1.1rem; font-weight:700; color:#1f2937; margin:0; }
.rp-subtitle { font-size:.75rem; color:#6b7280; margin:.1rem 0 0; }

.rp-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:.625rem; margin-bottom:1rem; }
.rp-stat { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; display:flex; align-items:center; gap:.75rem; }
.rp-stat-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.rp-stat-val { font-size:1.25rem; font-weight:700; color:#1f2937; line-height:1; }
.rp-stat-lbl { font-size:.7rem; color:#6b7280; margin-top:.1rem; }

.rp-filters { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; margin-bottom:1rem; display:flex; gap:.625rem; flex-wrap:wrap; align-items:flex-end; }
.rp-filter-group { display:flex; flex-direction:column; gap:.25rem; flex:1; min-width:200px; }
.rp-filter-group label { font-size:.72rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.rp-input { padding:.45rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.rp-input:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.1); }

.rp-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.rp-btn-primary { background:#3b82f6; color:#fff; } .rp-btn-primary:hover { background:#2563eb; }
.rp-btn-success { background:#10b981; color:#fff; } .rp-btn-success:hover { background:#059669; }
.rp-btn-ghost  { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .rp-btn-ghost:hover { background:#e5e7eb; }
.rp-btn-danger { background:#ef4444; color:#fff; } .rp-btn-danger:hover { background:#dc2626; }
.rp-btn-sm { padding:.3rem .65rem; font-size:.75rem; }
.rp-icon-btn { width:28px; height:28px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.rp-icon-view { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .rp-icon-view:hover { background:#e5e7eb; color:#374151; }
.rp-icon-edit { background:#eff6ff; border-color:#bfdbfe; color:#2563eb; } .rp-icon-edit:hover { background:#dbeafe; }
.rp-icon-del  { background:#fef2f2; border-color:#fecaca; color:#dc2626; } .rp-icon-del:hover  { background:#fee2e2; }

.rp-table-wrap { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.rp-table { width:100%; border-collapse:collapse; }
.rp-table thead tr { background:#f8fafc; }
.rp-table th { padding:.6rem 1rem; font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
.rp-table td { padding:.65rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.rp-table tbody tr:last-child td { border-bottom:none; }
.rp-table tbody tr:hover td { background:#f9fafb; }

.rp-avatar { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#f59e0b,#d97706); color:#fff; font-size:.72rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.rp-user-cell { display:flex; align-items:center; gap:.6rem; }
.rp-user-name { font-weight:600; color:#1f2937; font-size:.83rem; }
.rp-user-email { font-size:.72rem; color:#6b7280; }

.xid-badge { display:inline-flex; align-items:center; gap:.25rem; padding:.15rem .5rem; border-radius:5px; font-size:.68rem; font-weight:600; font-family:monospace; background:#fef3c7; color:#92400e; border:1px solid #fde68a; }
.role-badge { display:inline-flex; padding:.12rem .45rem; border-radius:20px; font-size:.68rem; font-weight:600; background:#dbeafe; color:#1e40af; margin:.1rem .1rem 0 0; text-transform:capitalize; }
.no-val { font-size:.75rem; color:#9ca3af; font-style:italic; }

.rp-actions { display:flex; gap:.3rem; flex-wrap:wrap; }
.rp-pagination { border-top:1px solid #e5e7eb; }
.rp-empty { padding:3rem 1rem; text-align:center; }
.rp-empty-icon { width:48px; height:48px; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.rp-empty p { color:#6b7280; font-size:.85rem; margin:.25rem 0; }
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
<div class="rp-header">
    <div>
        <p class="rp-title">All Reporters</p>
        <p class="rp-subtitle">Manage reporter accounts and their access</p>
    </div>
    <a href="{{ route('admin.reporters.create') }}" class="rp-btn rp-btn-success">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add New Reporter
    </a>
</div>

{{-- Stats --}}
<div class="rp-stats">
    <div class="rp-stat">
        <div class="rp-stat-icon" style="background:#fffbeb;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div><div class="rp-stat-val">{{ $total }}</div><div class="rp-stat-lbl">Total Reporters</div></div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.reporters.index') }}">
<div class="rp-filters">
    <div class="rp-filter-group">
        <label>Search</label>
        <div style="position:relative;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input class="rp-input" name="search" value="{{ request('search') }}" placeholder="Search by name, email or Xelenic ID…" style="padding-left:2rem;">
        </div>
    </div>
    <div style="display:flex;gap:.35rem;padding-bottom:.05rem;">
        <button type="submit" class="rp-btn rp-btn-primary">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Filter
        </button>
        @if(request('search'))
        <a href="{{ route('admin.reporters.index') }}" class="rp-btn rp-btn-ghost">Clear</a>
        @endif
    </div>
</div>
</form>

{{-- Table --}}
<div class="rp-table-wrap">
    @if($reporters->count() > 0)
    <table class="rp-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Reporter</th>
                <th>Xelenic ID</th>
                <th>Roles</th>
                <th>Joined</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reporters as $reporter)
            <tr>
                <td style="color:#9ca3af;font-size:.75rem;">{{ $reporters->firstItem() + $loop->index }}</td>
                <td>
                    <div class="rp-user-cell">
                        <div class="rp-avatar">{{ strtoupper(substr($reporter->name,0,1)) }}{{ strtoupper(substr(explode(' ',$reporter->name)[1] ?? '',0,1)) }}</div>
                        <div>
                            <div class="rp-user-name">{{ $reporter->name }}</div>
                            <div class="rp-user-email">{{ $reporter->email }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @if($reporter->xelenic_id)
                        <span class="xid-badge">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                            {{ $reporter->xelenic_id }}
                        </span>
                    @else
                        <span class="no-val">Not set</span>
                    @endif
                </td>
                <td>
                    @foreach($reporter->roles as $role)
                        <span class="role-badge">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td style="white-space:nowrap;color:#6b7280;">{{ $reporter->created_at->format('d M Y') }}</td>
                <td>
                    <div class="rp-actions" style="justify-content:flex-end;">
                        <a href="{{ route('admin.reporters.show', $reporter) }}" class="rp-icon-btn rp-icon-view" title="View">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('admin.reporters.edit', $reporter) }}" class="rp-icon-btn rp-icon-edit" title="Edit">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        @if($reporter->id !== Auth::id())
                        <form method="POST" action="{{ route('admin.reporters.destroy', $reporter) }}" style="display:inline;" onsubmit="return confirm('Delete {{ addslashes($reporter->name) }}? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="rp-icon-btn rp-icon-del" title="Delete">
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
    <div class="rp-pagination">
        {{ $reporters->links() }}
    </div>
    @else
    <div class="rp-empty">
        <div class="rp-empty-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        @if(request('search'))
            <p style="font-weight:600;color:#374151;">No reporters match your search</p>
            <p>Try adjusting your search or <a href="{{ route('admin.reporters.index') }}" style="color:#3b82f6;">clear filters</a>.</p>
        @else
            <p style="font-weight:600;color:#374151;">No reporters yet</p>
            <p><a href="{{ route('admin.reporters.create') }}" style="color:#3b82f6;">Add the first reporter</a></p>
        @endif
    </div>
    @endif
</div>
@endsection
