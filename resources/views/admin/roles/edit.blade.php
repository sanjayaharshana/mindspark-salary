@extends('layouts.admin')

@section('title', 'Edit Role')
@section('page-title', 'Edit Role')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.roles.index') }}" class="breadcrumb-item">Roles</a>
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.roles.show', $role) }}" class="breadcrumb-item" style="text-transform:capitalize;">{{ $role->name }}</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Edit</span>
@endsection

@section('content')
@include('admin.roles._form-styles')

@php
    $grouped = $permissions->sortBy('name')->groupBy(function($p) {
        $parts = explode(' ', $p->name, 2);
        return ucwords($parts[1] ?? $p->name);
    })->sortKeys();
@endphp

<form method="POST" action="{{ route('admin.roles.update', $role) }}">
@csrf @method('PUT')
<div class="rf-layout">

    {{-- Left: Role name --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">
        <div class="rf-card">
            <div class="rf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
                Role Details
            </div>
            <div class="rf-card-body">
                <div class="rf-group">
                    <label class="rf-label" for="name">Role Name <span class="rf-req">*</span></label>
                    <input class="rf-input @error('name') rf-input-error @enderror" type="text" id="name" name="name" value="{{ old('name', $role->name) }}" required placeholder="e.g. Sales Manager">
                    @error('name')<p class="rf-error">{{ $message }}</p>@enderror
                </div>
                <p style="font-size:.72rem;color:#9ca3af;margin:.25rem 0 0;">Role names are case-sensitive. Use lowercase for consistency.</p>
            </div>
            <div class="rf-card-footer">
                <button type="submit" class="rf-btn rf-btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                    Save Changes
                </button>
                <a href="{{ route('admin.roles.index') }}" class="rf-btn rf-btn-ghost">Cancel</a>
            </div>
        </div>

        <div class="rf-card">
            <div class="rf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Role Info
            </div>
            <div class="rf-card-body" style="display:flex;flex-direction:column;gap:.5rem;">
                <div style="display:flex;justify-content:space-between;font-size:.78rem;">
                    <span style="color:#6b7280;">Created</span>
                    <span style="font-weight:600;color:#374151;">{{ $role->created_at->format('d M Y') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.78rem;">
                    <span style="color:#6b7280;">Last Updated</span>
                    <span style="font-weight:600;color:#374151;">{{ $role->updated_at->format('d M Y') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.78rem;">
                    <span style="color:#6b7280;">Assigned Users</span>
                    <span style="font-weight:600;color:#374151;">{{ $role->users()->count() }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.78rem;">
                    <span style="color:#6b7280;">Permissions</span>
                    <span style="font-weight:600;color:#374151;">{{ $role->permissions->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right: Permissions --}}
    <div class="rf-card">
        <div class="rf-card-header">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            Assign Permissions
            <span style="margin-left:auto;font-size:.68rem;font-weight:400;color:#9ca3af;">{{ $role->permissions->count() }} of {{ $permissions->count() }} selected</span>
        </div>
        <div class="rf-card-body">
            @error('permissions')<p class="rf-error" style="margin-bottom:.5rem;">{{ $message }}</p>@enderror
            <div class="rf-perm-scroll">
                @foreach($grouped as $groupName => $perms)
                @php
                    $groupId = Str::slug($groupName);
                    $groupChecked = $perms->filter(fn($p) => in_array($p->name, old('permissions', $rolePermissions)))->count();
                    $groupTotal = $perms->count();
                @endphp
                <div class="rf-perm-group perm-group-{{ $groupId }}">
                    <div class="rf-perm-group-header">
                        <span class="rf-perm-group-title">{{ $groupName }}</span>
                        <button type="button" class="rf-toggle-all toggle-btn-{{ $groupId }}" onclick="toggleGroup('{{ $groupId }}')">
                            {{ $groupChecked === $groupTotal ? 'Deselect All' : 'Select All' }}
                        </button>
                    </div>
                    <div class="rf-perm-items">
                        @foreach($perms as $permission)
                        @php $isChecked = in_array($permission->name, old('permissions', $rolePermissions)); @endphp
                        <div class="rf-perm-item {{ $isChecked ? 'rf-checked' : '' }}" data-group="{{ $groupId }}" onclick="permToggle(this)">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $isChecked ? 'checked' : '' }}>
                            <span class="rf-perm-name">{{ explode(' ', $permission->name)[0] }}</span>
                            <svg class="rf-perm-check" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
</form>
@endsection
