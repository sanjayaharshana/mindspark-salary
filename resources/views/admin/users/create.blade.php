@extends('layouts.admin')

@section('title', 'Create User')
@section('page-title', 'Create User')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.users.index') }}" class="breadcrumb-item">Users</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Create</span>
@endsection

@section('content')
@include('admin.users._form-styles')

<form method="POST" action="{{ route('admin.users.store') }}">
@csrf
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
                    <input class="uf-input @error('name') uf-input-error @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="John Doe" autofocus>
                    @error('name')<p class="uf-error">{{ $message }}</p>@enderror
                </div>
                <div class="uf-group">
                    <label class="uf-label" for="email">Email Address <span class="uf-req">*</span></label>
                    <input class="uf-input @error('email') uf-input-error @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com">
                    @error('email')<p class="uf-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="uf-row">
                <div class="uf-group">
                    <label class="uf-label" for="password">Password <span class="uf-req">*</span></label>
                    <input class="uf-input @error('password') uf-input-error @enderror" type="password" id="password" name="password" required placeholder="Min. 8 characters">
                    @error('password')<p class="uf-error">{{ $message }}</p>@enderror
                </div>
                <div class="uf-group">
                    <label class="uf-label" for="password_confirmation">Confirm Password <span class="uf-req">*</span></label>
                    <input class="uf-input" type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repeat password">
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
                <label class="uf-role-item {{ in_array($role->name, old('roles', [])) ? 'uf-role-checked' : '' }}">
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                           {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}
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
            <button type="submit" class="uf-btn uf-btn-success">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
                Create User
            </button>
            <a href="{{ route('admin.users.index') }}" class="uf-btn uf-btn-ghost">Cancel</a>
        </div>
    </div>
</div>
</form>
@endsection
