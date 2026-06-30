@extends('layouts.admin')

@section('title', 'Create Brand')
@section('page-title', 'Add New Brand')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.clients.index') }}" class="breadcrumb-item">Brands</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Create</span>
@endsection

@section('content')
@include('admin.clients._form-styles')

<form action="{{ route('admin.clients.store') }}" method="POST">
@csrf
<div class="bf-layout">

    {{-- Main form --}}
    <div>
        {{-- Basic Info --}}
        <div class="bf-card">
            <div class="bf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                Brand Information
            </div>
            <div class="bf-card-body">
                <div class="bf-row">
                    <div class="bf-group">
                        <label class="bf-label" for="name">Brand Name <span class="bf-req">*</span></label>
                        <input class="bf-input @error('name') bf-input-error @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Coca-Cola">
                        @error('name')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="bf-group">
                        <label class="bf-label" for="short_code">Short Code <span class="bf-req">*</span></label>
                        <input class="bf-input @error('short_code') bf-input-error @enderror" type="text" id="short_code" name="short_code" value="{{ old('short_code') }}" required placeholder="ABC" maxlength="3" style="text-transform:uppercase;letter-spacing:.1em;font-weight:700;">
                        <p class="bf-hint">Exactly 3 uppercase letters</p>
                        @error('short_code')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="bf-row">
                    <div class="bf-group">
                        <label class="bf-label" for="email">Email Address <span class="bf-req">*</span></label>
                        <input class="bf-input @error('email') bf-input-error @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="brand@example.com">
                        @error('email')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="bf-group">
                        <label class="bf-label" for="phone">Phone Number</label>
                        <input class="bf-input @error('phone') bf-input-error @enderror" type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+94 71 234 5678">
                        @error('phone')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="bf-row">
                    <div class="bf-group">
                        <label class="bf-label" for="company_name">Company Name</label>
                        <input class="bf-input @error('company_name') bf-input-error @enderror" type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="e.g. Coca-Cola Lanka Ltd.">
                        @error('company_name')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="bf-group">
                        <label class="bf-label" for="contact_person">Contact Person</label>
                        <input class="bf-input @error('contact_person') bf-input-error @enderror" type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" placeholder="Full name">
                        @error('contact_person')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="bf-group">
                    <label class="bf-label" for="company_address">Company Address</label>
                    <textarea class="bf-input bf-textarea @error('company_address') bf-input-error @enderror" id="company_address" name="company_address" placeholder="Street, City, Province…">{{ old('company_address') }}</textarea>
                    @error('company_address')<p class="bf-error">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Bank Details --}}
        <div class="bf-card">
            <div class="bf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                Bank Details
                <span style="font-size:.68rem;font-weight:400;color:#9ca3af;margin-left:.25rem;">(optional)</span>
            </div>
            <div class="bf-card-body">
                <div class="bf-row-3">
                    <div class="bf-group">
                        <label class="bf-label" for="bank_name">Bank Name</label>
                        <input class="bf-input @error('bank_name') bf-input-error @enderror" type="text" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" placeholder="e.g. Commercial Bank">
                        @error('bank_name')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="bf-group">
                        <label class="bf-label" for="bank_account_number">Account Number</label>
                        <input class="bf-input @error('bank_account_number') bf-input-error @enderror" type="text" id="bank_account_number" name="bank_account_number" value="{{ old('bank_account_number') }}" placeholder="Account number">
                        @error('bank_account_number')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="bf-group">
                        <label class="bf-label" for="bank_routing_number">Routing Number</label>
                        <input class="bf-input @error('bank_routing_number') bf-input-error @enderror" type="text" id="bank_routing_number" name="bank_routing_number" value="{{ old('bank_routing_number') }}" placeholder="Routing number">
                        @error('bank_routing_number')<p class="bf-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Notes --}}
        <div class="bf-card">
            <div class="bf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Notes
                <span style="font-size:.68rem;font-weight:400;color:#9ca3af;margin-left:.25rem;">(optional)</span>
            </div>
            <div class="bf-card-body">
                <div class="bf-group">
                    <textarea class="bf-input bf-textarea @error('notes') bf-input-error @enderror" id="notes" name="notes" placeholder="Additional notes about this brand…" style="min-height:100px;">{{ old('notes') }}</textarea>
                    @error('notes')<p class="bf-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="bf-card-footer">
                <button type="submit" class="bf-btn bf-btn-success">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                    Create Brand
                </button>
                <a href="{{ route('admin.clients.index') }}" class="bf-btn bf-btn-ghost">Cancel</a>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div>
        <div class="bf-card">
            <div class="bf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                Status <span class="bf-req">*</span>
            </div>
            <div class="bf-card-body">
                <div class="bf-group">
                    <label class="bf-label" for="status">Brand Status</label>
                    <select class="bf-input @error('status') bf-input-error @enderror" id="status" name="status" required>
                        <option value="">Select status…</option>
                        <option value="active"    {{ old('status') == 'active'    ? 'selected' : '' }}>Active</option>
                        <option value="inactive"  {{ old('status') == 'inactive'  ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                    @error('status')<p class="bf-error">{{ $message }}</p>@enderror
                </div>
                <div style="display:flex;flex-direction:column;gap:.4rem;margin-top:.25rem;">
                    <div style="display:flex;align-items:center;gap:.4rem;font-size:.72rem;"><span style="width:8px;height:8px;border-radius:50%;background:#10b981;flex-shrink:0;"></span><span style="color:#374151;"><strong>Active</strong> — visible and in use</span></div>
                    <div style="display:flex;align-items:center;gap:.4rem;font-size:.72rem;"><span style="width:8px;height:8px;border-radius:50%;background:#f59e0b;flex-shrink:0;"></span><span style="color:#374151;"><strong>Inactive</strong> — temporarily disabled</span></div>
                    <div style="display:flex;align-items:center;gap:.4rem;font-size:.72rem;"><span style="width:8px;height:8px;border-radius:50%;background:#ef4444;flex-shrink:0;"></span><span style="color:#374151;"><strong>Suspended</strong> — blocked from use</span></div>
                </div>
            </div>
        </div>

        <div class="bf-card">
            <div class="bf-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                About Short Codes
            </div>
            <div class="bf-card-body">
                <p style="font-size:.75rem;color:#6b7280;line-height:1.6;margin:0;">
                    Short codes are 3-letter identifiers used on salary sheets to tag promoter rows to this brand (e.g. <strong style="font-family:monospace;color:#065f46;">CCL</strong> for Coca-Cola Lanka).
                </p>
            </div>
        </div>
    </div>

</div>
</form>
@endsection
