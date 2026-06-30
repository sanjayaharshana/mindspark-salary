@extends('layouts.admin')

@section('title', 'Role Management')
@section('page-title', 'Role Management')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Roles</span>
@endsection

@section('content')
<style>
.rm-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.rm-title { font-size:1.1rem; font-weight:700; color:#1f2937; margin:0; }
.rm-subtitle { font-size:.75rem; color:#6b7280; margin:.1rem 0 0; }

.rm-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:.625rem; margin-bottom:1rem; }
.rm-stat { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; display:flex; align-items:center; gap:.75rem; }
.rm-stat-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.rm-stat-val { font-size:1.25rem; font-weight:700; color:#1f2937; line-height:1; }
.rm-stat-lbl { font-size:.7rem; color:#6b7280; margin-top:.1rem; }

.rm-filters { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; margin-bottom:1rem; display:flex; gap:.625rem; flex-wrap:wrap; align-items:flex-end; }
.rm-filter-group { display:flex; flex-direction:column; gap:.25rem; flex:1; min-width:200px; }
.rm-filter-group label { font-size:.72rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.rm-input { padding:.45rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.rm-input:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.1); }

.rm-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.rm-btn-primary { background:#3b82f6; color:#fff; } .rm-btn-primary:hover { background:#2563eb; }
.rm-btn-success { background:#10b981; color:#fff; } .rm-btn-success:hover { background:#059669; }
.rm-btn-ghost  { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .rm-btn-ghost:hover { background:#e5e7eb; }
.rm-btn-danger { background:#ef4444; color:#fff; } .rm-btn-danger:hover { background:#dc2626; }
.rm-btn-sm { padding:.3rem .65rem; font-size:.75rem; }
.rm-icon-btn { width:28px; height:28px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.rm-icon-view { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .rm-icon-view:hover { background:#e5e7eb; color:#374151; }
.rm-icon-edit { background:#eff6ff; border-color:#bfdbfe; color:#2563eb; } .rm-icon-edit:hover { background:#dbeafe; }
.rm-icon-del  { background:#fef2f2; border-color:#fecaca; color:#dc2626; } .rm-icon-del:hover  { background:#fee2e2; }

.rm-table-wrap { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.rm-table { width:100%; border-collapse:collapse; }
.rm-table thead tr { background:#f8fafc; }
.rm-table th { padding:.6rem 1rem; font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
.rm-table td { padding:.65rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.rm-table tbody tr:last-child td { border-bottom:none; }
.rm-table tbody tr:hover td { background:#f9fafb; }

.rm-role-icon { width:32px; height:32px; border-radius:8px; background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; font-size:.72rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.rm-role-cell { display:flex; align-items:center; gap:.6rem; }
.rm-role-name { font-weight:600; color:#1f2937; font-size:.83rem; text-transform:capitalize; }

.perm-badge { display:inline-flex; align-items:center; padding:.12rem .45rem; border-radius:20px; font-size:.65rem; font-weight:600; background:#f0fdf4; color:#166534; margin:.1rem .1rem 0 0; }
.perm-more { font-size:.7rem; color:#9ca3af; font-style:italic; }
.no-perm { font-size:.75rem; color:#9ca3af; font-style:italic; }

.rm-count-badge { display:inline-flex; align-items:center; gap:.3rem; padding:.2rem .55rem; border-radius:20px; font-size:.72rem; font-weight:600; background:#eff6ff; color:#1e40af; }
.rm-actions { display:flex; gap:.3rem; flex-wrap:wrap; }
.rm-pagination { border-top:1px solid #e5e7eb; }
.rm-empty { padding:3rem 1rem; text-align:center; }
.rm-empty-icon { width:48px; height:48px; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.rm-empty p { color:#6b7280; font-size:.85rem; margin:.25rem 0; }
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
<div class="rm-header">
    <div>
        <p class="rm-title">All Roles</p>
        <p class="rm-subtitle">Manage roles and their permission assignments</p>
    </div>
    <a href="{{ route('admin.roles.create') }}" class="rm-btn rm-btn-success">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add New Role
    </a>
</div>

{{-- Stats --}}
<div class="rm-stats">
    <div class="rm-stat">
        <div class="rm-stat-icon" style="background:#f5f3ff;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
        </div>
        <div><div class="rm-stat-val">{{ $total }}</div><div class="rm-stat-lbl">Total Roles</div></div>
    </div>
    <div class="rm-stat">
        <div class="rm-stat-icon" style="background:#f0fdf4;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <div><div class="rm-stat-val">{{ $totalPermissions }}</div><div class="rm-stat-lbl">Total Permissions</div></div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.roles.index') }}">
<div class="rm-filters">
    <div class="rm-filter-group">
        <label>Search Roles</label>
        <div style="position:relative;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input class="rm-input" name="search" value="{{ request('search') }}" placeholder="Search by role name…" style="padding-left:2rem;">
        </div>
    </div>
    <div style="display:flex;gap:.35rem;padding-bottom:.05rem;">
        <button type="submit" class="rm-btn rm-btn-primary">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Filter
        </button>
        @if(request('search'))
        <a href="{{ route('admin.roles.index') }}" class="rm-btn rm-btn-ghost">Clear</a>
        @endif
    </div>
</div>
</form>

{{-- Table --}}
<div class="rm-table-wrap">
    @if($roles->count() > 0)
    <table class="rm-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Users</th>
                <th>Created</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td style="color:#9ca3af;font-size:.75rem;">{{ $roles->firstItem() + $loop->index }}</td>
                <td>
                    <div class="rm-role-cell">
                        <div class="rm-role-icon">{{ strtoupper(substr($role->name,0,2)) }}</div>
                        <div class="rm-role-name">{{ $role->name }}</div>
                    </div>
                </td>
                <td>
                    @if($role->permissions->count() > 0)
                        @foreach($role->permissions->take(3) as $perm)
                            <span class="perm-badge">{{ $perm->name }}</span>
                        @endforeach
                        @if($role->permissions->count() > 3)
                            <span class="perm-more">+{{ $role->permissions->count() - 3 }} more</span>
                        @endif
                    @else
                        <span class="no-perm">No permissions</span>
                    @endif
                </td>
                <td>
                    <span class="rm-count-badge">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        {{ $role->users_count }}
                    </span>
                </td>
                <td style="white-space:nowrap;color:#6b7280;">{{ $role->created_at->format('d M Y') }}</td>
                <td>
                    <div class="rm-actions" style="justify-content:flex-end;">
                        <a href="{{ route('admin.roles.show', $role) }}" class="rm-icon-btn rm-icon-view" title="View">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="rm-icon-btn rm-icon-edit" title="Edit">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" style="display:inline;" onsubmit="return confirm('Delete role \'{{ addslashes($role->name) }}\'? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="rm-icon-btn rm-icon-del" title="Delete">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="rm-pagination">
        {{ $roles->links() }}
    </div>
    @else
    <div class="rm-empty">
        <div class="rm-empty-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
        </div>
        @if(request('search'))
            <p style="font-weight:600;color:#374151;">No roles match your search</p>
            <p>Try adjusting your search or <a href="{{ route('admin.roles.index') }}" style="color:#3b82f6;">clear filters</a>.</p>
        @else
            <p style="font-weight:600;color:#374151;">No roles yet</p>
            <p><a href="{{ route('admin.roles.create') }}" style="color:#3b82f6;">Add the first role</a></p>
        @endif
    </div>
    @endif
</div>
@endsection
