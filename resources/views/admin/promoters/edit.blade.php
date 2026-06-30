@extends('layouts.admin')

@section('title', 'Edit Promoter')
@section('page-title', 'Edit Promoter')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.promoters.index') }}" class="breadcrumb-item">Promoters</a>
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.promoters.show', $promoter) }}" class="breadcrumb-item">{{ $promoter->promoter_name }}</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Edit</span>
@endsection

@section('content')
@include('admin.promoters._form-styles')

<form action="{{ route('admin.promoters.update', $promoter) }}" method="POST">
@csrf
@method('PUT')

<div class="pf-layout">
    {{-- Main column --}}
    <div style="display:flex;flex-direction:column;gap:.75rem;">

        {{-- Personal Info card --}}
        <div class="pf-card">
            <div class="pf-card-head"><p class="pf-card-title">Personal Information</p></div>
            <div class="pf-card-body">
                <div class="pf-row">
                    <div class="pf-group">
                        <label class="pf-label">Promoter Name <span class="pf-req">*</span></label>
                        <input class="pf-input @error('promoter_name') pf-invalid @enderror" type="text" name="promoter_name" value="{{ old('promoter_name', $promoter->promoter_name) }}" placeholder="Full name" required>
                        @error('promoter_name')<div class="pf-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="pf-group">
                        <label class="pf-label">Position</label>
                        <select class="pf-input @error('position_id') pf-invalid @enderror" name="position_id">
                            <option value="">Select position (optional)</option>
                            @foreach($positions as $pos)
                                <option value="{{ $pos->id }}" {{ old('position_id', $promoter->position_id) == $pos->id ? 'selected' : '' }}>{{ $pos->position_name }}</option>
                            @endforeach
                        </select>
                        @error('position_id')<div class="pf-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="pf-row">
                    <div class="pf-group">
                        <label class="pf-label">Identity Card No. <span class="pf-req">*</span></label>
                        <input class="pf-input @error('identity_card_no') pf-invalid @enderror" type="text" name="identity_card_no" value="{{ old('identity_card_no', $promoter->identity_card_no) }}" placeholder="NIC number" required>
                        @error('identity_card_no')<div class="pf-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="pf-group">
                        <label class="pf-label">Phone No. <span class="pf-req">*</span></label>
                        <input class="pf-input @error('phone_no') pf-invalid @enderror" type="text" name="phone_no" value="{{ old('phone_no', $promoter->phone_no) }}" placeholder="Mobile number" required>
                        @error('phone_no')<div class="pf-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Bank Details card --}}
        <div class="pf-card">
            <div class="pf-card-head"><p class="pf-card-title">Bank Details</p></div>
            <div class="pf-card-body">
                <div class="pf-row">
                    <div class="pf-group">
                        <label class="pf-label">Bank Name <span class="pf-req">*</span></label>
                        <input class="pf-input @error('bank_name') pf-invalid @enderror" type="text" name="bank_name" value="{{ old('bank_name', $promoter->bank_name) }}" placeholder="e.g. Bank of Ceylon" required>
                        @error('bank_name')<div class="pf-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="pf-group">
                        <label class="pf-label">Bank Branch Name <span class="pf-req">*</span></label>
                        <input class="pf-input @error('bank_branch_name') pf-invalid @enderror" type="text" name="bank_branch_name" value="{{ old('bank_branch_name', $promoter->bank_branch_name) }}" placeholder="Branch name" required>
                        @error('bank_branch_name')<div class="pf-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="pf-group">
                    <label class="pf-label">Bank Account Number <span class="pf-req">*</span></label>
                    <input class="pf-input @error('bank_account_number') pf-invalid @enderror" type="text" name="bank_account_number" value="{{ old('bank_account_number', $promoter->bank_account_number) }}" placeholder="Account number" required>
                    @error('bank_account_number')<div class="pf-error">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="pf-card-foot">
                <a href="{{ route('admin.promoters.show', $promoter) }}" class="pf-btn pf-btn-ghost">Cancel</a>
                <button type="submit" class="pf-btn pf-btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Update Promoter
                </button>
            </div>
        </div>
    </div>

    {{-- Sidebar column --}}
    <div style="display:flex;flex-direction:column;gap:.75rem;">

        {{-- Status card --}}
        <div class="pf-card">
            <div class="pf-card-head"><p class="pf-card-title">Status <span class="pf-req">*</span></p></div>
            <div class="pf-card-body">
                <div class="pf-group" style="margin-bottom:0;">
                    <select class="pf-input @error('status') pf-invalid @enderror" name="status" required>
                        <option value="">Select status</option>
                        <option value="active"    {{ old('status', $promoter->status) == 'active'    ? 'selected' : '' }}>Active</option>
                        <option value="inactive"  {{ old('status', $promoter->status) == 'inactive'  ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ old('status', $promoter->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                    @error('status')<div class="pf-error">{{ $message }}</div>@enderror
                </div>
                <div style="display:flex;flex-direction:column;gap:.4rem;margin-top:.75rem;">
                    <div style="display:flex;align-items:center;gap:.4rem;">
                        <span style="display:inline-flex;padding:.12rem .45rem;border-radius:20px;font-size:.65rem;font-weight:700;background:#d1fae5;color:#065f46;">Active</span>
                        <span style="font-size:.75rem;color:#6b7280;">Promoter is working</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.4rem;">
                        <span style="display:inline-flex;padding:.12rem .45rem;border-radius:20px;font-size:.65rem;font-weight:700;background:#fef3c7;color:#92400e;">Inactive</span>
                        <span style="font-size:.75rem;color:#6b7280;">Temporarily not working</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.4rem;">
                        <span style="display:inline-flex;padding:.12rem .45rem;border-radius:20px;font-size:.65rem;font-weight:700;background:#fee2e2;color:#991b1b;">Suspended</span>
                        <span style="font-size:.75rem;color:#6b7280;">Account suspended</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Current ID card --}}
        <div class="pf-card">
            <div class="pf-card-head"><p class="pf-card-title">Promoter ID</p></div>
            <div class="pf-card-body" style="text-align:center;">
                <div style="font-family:monospace;font-size:1rem;font-weight:700;color:#1f2937;background:#f3f4f6;padding:.5rem .75rem;border-radius:6px;display:inline-block;margin-bottom:.4rem;">
                    {{ $promoter->promoter_id }}
                </div>
                <div style="font-size:.72rem;color:#6b7280;">The promoter ID is permanent and cannot be changed.</div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
