@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.users.index') }}" class="breadcrumb-item">Users</a>
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.users.show', $user) }}" class="breadcrumb-item">{{ $user->name }}</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Edit</span>
@endsection

@section('content')
@include('admin.users._form-styles')

<form method="POST" action="{{ route('admin.users.update', $user) }}">
@csrf @method('PUT')
<div class="uf-layout">
    {{-- Main form --}}
    <div class="uf-card">
        <div class="uf-card-header">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Account Information
        </div>
        <div class="uf-card-body">
            <div class="uf-row">
                <div class="uf-group">
                    <label class="uf-label" for="name">Full Name <span class="uf-req">*</span></label>
                    <input class="uf-input @error('name') uf-input-error @enderror" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="John Doe">
                    @error('name')<p class="uf-error">{{ $message }}</p>@enderror
                </div>
                <div class="uf-group">
                    <label class="uf-label" for="email">Email Address <span class="uf-req">*</span></label>
                    <input class="uf-input @error('email') uf-input-error @enderror" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')<p class="uf-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="uf-divider">
                <span>Change Password</span>
                <p style="font-size:.72rem;color:#9ca3af;font-weight:400;margin-top:.1rem;">Leave both fields blank to keep the current password</p>
            </div>

            <div class="uf-row">
                <div class="uf-group">
                    <label class="uf-label" for="password">New Password</label>
                    <input class="uf-input @error('password') uf-input-error @enderror" type="password" id="password" name="password" placeholder="Min. 8 characters">
                    @error('password')<p class="uf-error">{{ $message }}</p>@enderror
                </div>
                <div class="uf-group">
                    <label class="uf-label" for="password_confirmation">Confirm New Password</label>
                    <input class="uf-input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat new password">
                </div>
            </div>
        </div>
    </div>

    {{-- Roles sidebar --}}
    <div class="uf-card">
        <div class="uf-card-header">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
            Assign Roles
        </div>
        <div class="uf-card-body">
            <div class="uf-roles">
                @foreach($roles as $role)
                @php $checked = in_array($role->name, old('roles', $userRoles)); @endphp
                <label class="uf-role-item {{ $checked ? 'uf-role-checked' : '' }}">
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                           {{ $checked ? 'checked' : '' }}
                           onchange="this.closest('.uf-role-item').classList.toggle('uf-role-checked', this.checked)">
                    <div class="uf-role-info">
                        <span class="uf-role-name">{{ ucfirst($role->name) }}</span>
                    </div>
                    <svg class="uf-role-check" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
                </label>
                @endforeach
            </div>
            @error('roles')<p class="uf-error">{{ $message }}</p>@enderror
        </div>
        <div class="uf-card-footer">
            <button type="submit" class="uf-btn uf-btn-primary">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                Save Changes
            </button>
            <a href="{{ route('admin.users.index') }}" class="uf-btn uf-btn-ghost">Cancel</a>
        </div>
    </div>
</div>
</form>
@endsection
