@extends('layouts.admin')

@section('title', 'Role Details')
@section('page-title', 'Role Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.roles.index') }}" class="breadcrumb-item">Roles</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active" style="text-transform:capitalize;">{{ $role->name }}</span>
@endsection

@section('content')
<style>
.rs-layout { display:grid; grid-template-columns:260px 1fr; gap:1rem; align-items:start; }
.rs-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.rs-card-header { padding:.65rem 1rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.82rem; font-weight:700; color:#374151; display:flex; align-items:center; gap:.4rem; }
.rs-card-body { padding:1rem; }
.rs-card-footer { padding:.75rem 1rem; border-top:1px solid #e5e7eb; background:#f8fafc; display:flex; flex-direction:column; gap:.4rem; }

.rs-role-avatar { width:56px; height:56px; border-radius:12px; background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; font-size:1.25rem; font-weight:700; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; text-transform:uppercase; }
.rs-role-name { font-size:1rem; font-weight:700; color:#1f2937; text-align:center; text-transform:capitalize; margin-bottom:.25rem; }
.rs-meta-row { display:flex; justify-content:space-between; align-items:center; padding:.4rem 0; border-bottom:1px solid #f3f4f6; font-size:.78rem; }
.rs-meta-row:last-child { border-bottom:none; }
.rs-meta-label { color:#6b7280; }
.rs-meta-value { font-weight:600; color:#1f2937; }

.rs-btn { padding:.4rem .9rem; border:none; border-radius:6px; font-size:.78rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.35rem; transition:all .15s; text-decoration:none; width:100%; }
.rs-btn-primary { background:#3b82f6; color:#fff; } .rs-btn-primary:hover { background:#2563eb; }
.rs-btn-ghost  { background:#fff; color:#374151; border:1px solid #d1d5db; } .rs-btn-ghost:hover { background:#f3f4f6; }
.rs-btn-danger { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; } .rs-btn-danger:hover { background:#fee2e2; }

.rs-perm-group { margin-bottom:.75rem; }
.rs-perm-group:last-child { margin-bottom:0; }
.rs-perm-group-title { font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; margin-bottom:.35rem; display:flex; align-items:center; gap:.4rem; }
.rs-perm-group-title::after { content:''; flex:1; height:1px; background:#f3f4f6; }
.rs-perm-grid { display:flex; flex-wrap:wrap; gap:.25rem; }
.rs-perm-badge { display:inline-flex; align-items:center; gap:.3rem; padding:.2rem .55rem; border-radius:20px; font-size:.7rem; font-weight:500; background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; }
.rs-perm-badge svg { flex-shrink:0; }
.rs-no-perm { color:#9ca3af; font-size:.82rem; font-style:italic; padding:.5rem 0; }

@media(max-width:768px){ .rs-layout { grid-template-columns:1fr; } }
</style>

@php
    $grouped = $role->permissions->sortBy('name')->groupBy(function($p) {
        $parts = explode(' ', $p->name, 2);
        return ucwords($parts[1] ?? $p->name);
    })->sortKeys();
@endphp

<div class="rs-layout">

    {{-- Left: Role info --}}
    <div>
        <div class="rs-card">
            <div class="rs-card-body" style="text-align:center;padding:1.25rem 1rem .75rem;">
                <div class="rs-role-avatar">{{ strtoupper(substr($role->name,0,2)) }}</div>
                <div class="rs-role-name">{{ $role->name }}</div>
                <div style="font-size:.72rem;color:#9ca3af;">System Role</div>
            </div>
            <div style="padding:.25rem 1rem .75rem;">
                <div class="rs-meta-row">
                    <span class="rs-meta-label">Created</span>
                    <span class="rs-meta-value">{{ $role->created_at->format('d M Y') }}</span>
                </div>
                <div class="rs-meta-row">
                    <span class="rs-meta-label">Updated</span>
                    <span class="rs-meta-value">{{ $role->updated_at->format('d M Y') }}</span>
                </div>
                <div class="rs-meta-row">
                    <span class="rs-meta-label">Users</span>
                    <span class="rs-meta-value">{{ $role->users()->count() }}</span>
                </div>
                <div class="rs-meta-row">
                    <span class="rs-meta-label">Permissions</span>
                    <span class="rs-meta-value">{{ $role->permissions->count() }}</span>
                </div>
            </div>
            <div class="rs-card-footer">
                <a href="{{ route('admin.roles.edit', $role) }}" class="rs-btn rs-btn-primary">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Role
                </a>
                <a href="{{ route('admin.roles.index') }}" class="rs-btn rs-btn-ghost">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    Back to Roles
                </a>
                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" onsubmit="return confirm('Delete role \'{{ addslashes($role->name) }}\'? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="rs-btn rs-btn-danger">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                        Delete Role
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Right: Permissions --}}
    <div class="rs-card">
        <div class="rs-card-header">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            Permissions
            <span style="margin-left:.5rem;padding:.1rem .45rem;background:#eff6ff;color:#1e40af;border-radius:20px;font-size:.68rem;font-weight:600;">{{ $role->permissions->count() }}</span>
        </div>
        <div class="rs-card-body">
            @if($role->permissions->count() > 0)
                @foreach($grouped as $groupName => $perms)
                <div class="rs-perm-group">
                    <div class="rs-perm-group-title">{{ $groupName }}</div>
                    <div class="rs-perm-grid">
                        @foreach($perms as $perm)
                        <span class="rs-perm-badge">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
                            {{ explode(' ', $perm->name)[0] }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @else
                <p class="rs-no-perm">No permissions assigned to this role.</p>
            @endif
        </div>
    </div>

</div>
@endsection
