@extends('layouts.admin')

@section('title', 'Add Reporter')
@section('page-title', 'Add New Reporter')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.reporters.index') }}" class="breadcrumb-item">Reporters</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Create</span>
@endsection

@section('content')
@include('admin.users._form-styles')

<form method="POST" action="{{ route('admin.reporters.store') }}">
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
                    <input class="uf-input @error('name') uf-input-error @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="John Doe">
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

            <div class="uf-divider"><span>Optional Details</span></div>

            <div class="uf-group">
                <label class="uf-label" for="xelenic_id">Xelenic ID</label>
                <input class="uf-input @error('xelenic_id') uf-input-error @enderror" type="text" id="xelenic_id" name="xelenic_id" value="{{ old('xelenic_id') }}" placeholder="e.g. XEL-001">
                @error('xelenic_id')<p class="uf-error">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="uf-card-footer">
            <button type="submit" class="uf-btn uf-btn-success">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                Create Reporter
            </button>
            <a href="{{ route('admin.reporters.index') }}" class="uf-btn uf-btn-ghost">Cancel</a>
        </div>
    </div>

    {{-- Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">
        <div class="uf-card">
            <div class="uf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                About Reporters
            </div>
            <div class="uf-card-body">
                <p style="font-size:.78rem;color:#6b7280;line-height:1.6;margin:0;">
                    Reporters are users who can submit and view reports. The <strong>reporter</strong> role will be automatically assigned when the account is created.
                </p>
                <div style="margin-top:.75rem;padding:.5rem .75rem;background:#fffbeb;border-radius:6px;border:1px solid #fde68a;">
                    <p style="font-size:.72rem;color:#92400e;margin:0;font-weight:600;">
                        The Xelenic ID is used for integration with the Xelenic platform. Leave blank if not applicable.
                    </p>
                </div>
            </div>
        </div>

        <div class="uf-card">
            <div class="uf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Auto-assigned Role
            </div>
            <div class="uf-card-body">
                <div style="display:flex;align-items:center;gap:.5rem;padding:.4rem .65rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:6px;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
                    <span style="font-size:.78rem;font-weight:600;color:#1e40af;">reporter</span>
                </div>
            </div>
        </div>
    </div>

</div>
</form>
@endsection
