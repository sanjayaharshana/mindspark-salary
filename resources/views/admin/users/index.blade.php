@extends('layouts.admin')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Users</span>
@endsection

@section('content')
<style>
.um-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.um-title { font-size:1.1rem; font-weight:700; color:#1f2937; margin:0; }
.um-subtitle { font-size:.75rem; color:#6b7280; margin:.1rem 0 0; }

.um-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(130px,1fr)); gap:.625rem; margin-bottom:1rem; }
.um-stat { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; display:flex; align-items:center; gap:.75rem; }
.um-stat-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.um-stat-val { font-size:1.25rem; font-weight:700; color:#1f2937; line-height:1; }
.um-stat-lbl { font-size:.7rem; color:#6b7280; margin-top:.1rem; }

.um-filters { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; margin-bottom:1rem; display:flex; gap:.625rem; flex-wrap:wrap; align-items:flex-end; }
.um-filter-group { display:flex; flex-direction:column; gap:.25rem; flex:1; min-width:160px; }
.um-filter-group label { font-size:.72rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.um-input { padding:.45rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.um-input:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.1); }
.um-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.um-btn-primary { background:#3b82f6; color:#fff; } .um-btn-primary:hover { background:#2563eb; }
.um-btn-success { background:#10b981; color:#fff; } .um-btn-success:hover { background:#059669; }
.um-btn-ghost  { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .um-btn-ghost:hover { background:#e5e7eb; }
.um-btn-danger { background:#ef4444; color:#fff; } .um-btn-danger:hover { background:#dc2626; }
.um-btn-sm { padding:.3rem .65rem; font-size:.75rem; }
.um-icon-btn { width:28px; height:28px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.um-icon-view { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .um-icon-view:hover { background:#e5e7eb; color:#374151; }
.um-icon-edit { background:#eff6ff; border-color:#bfdbfe; color:#2563eb; } .um-icon-edit:hover { background:#dbeafe; }
.um-icon-del  { background:#fef2f2; border-color:#fecaca; color:#dc2626; } .um-icon-del:hover  { background:#fee2e2; }

.um-table-wrap { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.um-table { width:100%; border-collapse:collapse; }
.um-table thead tr { background:#f8fafc; }
.um-table th { padding:.6rem 1rem; font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
.um-table td { padding:.65rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.um-table tbody tr:last-child td { border-bottom:none; }
.um-table tbody tr:hover td { background:#f9fafb; }

.um-avatar { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; font-size:.72rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.um-user-cell { display:flex; align-items:center; gap:.6rem; }
.um-user-name { font-weight:600; color:#1f2937; font-size:.83rem; }
.um-user-email { font-size:.72rem; color:#6b7280; }

.role-badge { display:inline-flex; align-items:center; padding:.15rem .5rem; border-radius:20px; font-size:.68rem; font-weight:600; background:#dbeafe; color:#1e40af; margin:.1rem .1rem 0 0; text-transform:capitalize; }
.no-role { font-size:.75rem; color:#9ca3af; font-style:italic; }

.um-actions { display:flex; gap:.3rem; flex-wrap:wrap; }
.um-pagination { border-top:1px solid #e5e7eb; }
.um-empty { padding:3rem 1rem; text-align:center; }
.um-empty-icon { width:48px; height:48px; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.um-empty p { color:#6b7280; font-size:.85rem; margin:.25rem 0; }
</style>

{{-- Flash messages --}}
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
<div class="um-header">
    <div>
        <p class="um-title">All Users</p>
        <p class="um-subtitle">Manage system users and their role assignments</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="um-btn um-btn-success">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add New User
    </a>
</div>

{{-- Stats --}}
<div class="um-stats">
    <div class="um-stat">
        <div class="um-stat-icon" style="background:#eff6ff;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div><div class="um-stat-val">{{ $total }}</div><div class="um-stat-lbl">Total Users</div></div>
    </div>
    @foreach($roles->take(4) as $role)
    <div class="um-stat">
        <div class="um-stat-icon" style="background:#f0fdf4;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
        </div>
        <div>
            <div class="um-stat-val">{{ $role->users()->count() }}</div>
            <div class="um-stat-lbl" style="text-transform:capitalize;">{{ $role->name }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.users.index') }}">
<div class="um-filters">
    <div class="um-filter-group" style="flex:2;">
        <label>Search</label>
        <div style="position:relative;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input class="um-input" name="search" value="{{ request('search') }}" placeholder="Search by name or email…" style="padding-left:2rem;">
        </div>
    </div>
    <div class="um-filter-group">
        <label>Role</label>
        <select class="um-input" name="role">
            <option value="">All Roles</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ request('role') === $role->name ? 'selected' : '' }} style="text-transform:capitalize;">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>
    <div style="display:flex;gap:.35rem;padding-bottom:.05rem;">
        <button type="submit" class="um-btn um-btn-primary">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Filter
        </button>
        @if(request('search') || request('role'))
        <a href="{{ route('admin.users.index') }}" class="um-btn um-btn-ghost">Clear</a>
        @endif
    </div>
</div>
</form>

{{-- Table --}}
<div class="um-table-wrap">
    @if($users->count() > 0)
    <table class="um-table">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Roles</th>
                <th>Joined</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $i => $user)
            <tr>
                <td style="color:#9ca3af;font-size:.75rem;">{{ $users->firstItem() + $loop->index }}</td>
                <td>
                    <div class="um-user-cell">
                        <div class="um-avatar">{{ strtoupper(substr($user->name,0,1)) }}{{ strtoupper(substr(explode(' ',$user->name)[1] ?? '',0,1)) }}</div>
                        <div>
                            <div class="um-user-name">{{ $user->name }}</div>
                            <div class="um-user-email">{{ $user->email }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @if($user->roles->count())
                        @foreach($user->roles as $role)
                            <span class="role-badge">{{ $role->name }}</span>
                        @endforeach
                    @else
                        <span class="no-role">No role</span>
                    @endif
                </td>
                <td style="white-space:nowrap;color:#6b7280;">{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <div class="um-actions" style="justify-content:flex-end;">
                        <a href="{{ route('admin.users.show', $user) }}" class="um-icon-btn um-icon-view" title="View">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="um-icon-btn um-icon-edit" title="Edit">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        @if($user->id !== Auth::id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Delete {{ addslashes($user->name) }}? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="um-icon-btn um-icon-del" title="Delete">
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
    <div class="um-pagination">
        {{ $users->links() }}
    </div>
    @else
    <div class="um-empty">
        <div class="um-empty-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        @if(request('search') || request('role'))
            <p style="font-weight:600;color:#374151;">No users match your filters</p>
            <p>Try adjusting your search or <a href="{{ route('admin.users.index') }}" style="color:#3b82f6;">clear filters</a>.</p>
        @else
            <p style="font-weight:600;color:#374151;">No users yet</p>
            <p><a href="{{ route('admin.users.create') }}" style="color:#3b82f6;">Add the first user</a></p>
        @endif
    </div>
    @endif
</div>
@endsection
