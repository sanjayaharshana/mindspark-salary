@extends('layouts.admin')

@section('title', 'Edit Job')
@section('page-title', 'Edit Job')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.jobs.index') }}" class="breadcrumb-item">Jobs</a>
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.jobs.show', $job) }}" class="breadcrumb-item">{{ $job->job_number }}</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Edit</span>
@endsection

@section('content')
@include('admin.jobs._form-styles')

<form action="{{ route('admin.jobs.update', $job) }}" method="POST">
@csrf
@method('PUT')

<div class="jf-layout">
    {{-- Main column --}}
    <div style="display:flex;flex-direction:column;gap:.75rem;">

        {{-- Job Info card --}}
        <div class="jf-card">
            <div class="jf-card-head"><p class="jf-card-title">Job Information</p></div>
            <div class="jf-card-body">
                <div class="jf-row">
                    <div class="jf-group">
                        <label class="jf-label">Job Name <span class="jf-req">*</span></label>
                        <input class="jf-input @error('job_name') jf-invalid @enderror" type="text" name="job_name" value="{{ old('job_name', $job->job_name) }}" placeholder="Enter job name" required>
                        @error('job_name')<div class="jf-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="jf-group">
                        <label class="jf-label">Client <span class="jf-req">*</span></label>
                        <select class="jf-input @error('client_id') jf-invalid @enderror" name="client_id" id="client_id" required>
                            <option value="">Select a client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" data-code="{{ $client->short_code }}" {{ old('client_id', $job->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }} ({{ $client->short_code }})
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')<div class="jf-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="jf-group">
                    <label class="jf-label">Description</label>
                    <textarea class="jf-input jf-textarea @error('description') jf-invalid @enderror" name="description" rows="4" placeholder="Describe the job details…">{{ old('description', $job->description) }}</textarea>
                    @error('description')<div class="jf-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Assignment card --}}
        <div class="jf-card">
            <div class="jf-card-head"><p class="jf-card-title">Assignment</p></div>
            <div class="jf-card-body">
                <div class="jf-row">
                    <div class="jf-group">
                        <label class="jf-label">Officer</label>
                        <select class="jf-input @error('officer_id') jf-invalid @enderror" name="officer_id">
                            <option value="">Select officer (optional)</option>
                            @foreach($officers as $officer)
                                <option value="{{ $officer->id }}" {{ old('officer_id', $job->officer_id) == $officer->id ? 'selected' : '' }}>
                                    {{ $officer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('officer_id')<div class="jf-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="jf-group">
                        <label class="jf-label">Reporter</label>
                        <select class="jf-input @error('reporter_id') jf-invalid @enderror" name="reporter_id">
                            <option value="">Select reporter (optional)</option>
                            @foreach($reporters as $reporter)
                                <option value="{{ $reporter->id }}" {{ old('reporter_id', $job->reporter_id) == $reporter->id ? 'selected' : '' }}>
                                    {{ $reporter->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('reporter_id')<div class="jf-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Timeline card with save --}}
        <div class="jf-card">
            <div class="jf-card-head"><p class="jf-card-title">Timeline &amp; Status</p></div>
            <div class="jf-card-body">
                <div class="jf-row">
                    <div class="jf-group">
                        <label class="jf-label">Status <span class="jf-req">*</span></label>
                        <select class="jf-input @error('status') jf-invalid @enderror" name="status" required>
                            <option value="">Select status</option>
                            <option value="pending"     {{ old('status', $job->status) == 'pending'     ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status', $job->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed"   {{ old('status', $job->status) == 'completed'   ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled"   {{ old('status', $job->status) == 'cancelled'   ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')<div class="jf-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="jf-group">
                        <label class="jf-label">Start Date</label>
                        <input class="jf-input @error('start_date') jf-invalid @enderror" type="date" name="start_date" value="{{ old('start_date', $job->start_date?->format('Y-m-d')) }}">
                        @error('start_date')<div class="jf-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="jf-group">
                        <label class="jf-label">End Date</label>
                        <input class="jf-input @error('end_date') jf-invalid @enderror" type="date" name="end_date" value="{{ old('end_date', $job->end_date?->format('Y-m-d')) }}">
                        @error('end_date')<div class="jf-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="jf-card-foot">
                <a href="{{ route('admin.jobs.show', $job) }}" class="jf-btn jf-btn-ghost">Cancel</a>
                <button type="submit" class="jf-btn jf-btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Update Job
                </button>
            </div>
        </div>
    </div>

    {{-- Sidebar column --}}
    <div style="display:flex;flex-direction:column;gap:.75rem;">

        {{-- Current job number card --}}
        <div class="jf-card">
            <div class="jf-card-head"><p class="jf-card-title">Current Job Number</p></div>
            <div class="jf-card-body" style="text-align:center;">
                <div style="font-family:monospace;font-size:1.1rem;font-weight:700;color:#1f2937;background:#f3f4f6;padding:.5rem .75rem;border-radius:6px;display:inline-block;margin-bottom:.4rem;">
                    {{ $job->job_number }}
                </div>
                <div style="font-size:.72rem;color:#6b7280;">Changing the client will generate a new job number.</div>
            </div>
        </div>

        {{-- Status legend card --}}
        <div class="jf-card">
            <div class="jf-card-head"><p class="jf-card-title">Status Guide</p></div>
            <div class="jf-card-body">
                <div style="display:flex;flex-direction:column;gap:.5rem;">
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <span style="display:inline-flex;padding:.15rem .5rem;border-radius:20px;font-size:.68rem;font-weight:700;background:#fef3c7;color:#92400e;">Pending</span>
                        <span style="font-size:.78rem;color:#6b7280;">Job is queued, not started</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <span style="display:inline-flex;padding:.15rem .5rem;border-radius:20px;font-size:.68rem;font-weight:700;background:#dbeafe;color:#1e40af;">In Progress</span>
                        <span style="font-size:.78rem;color:#6b7280;">Job is actively running</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <span style="display:inline-flex;padding:.15rem .5rem;border-radius:20px;font-size:.68rem;font-weight:700;background:#d1fae5;color:#065f46;">Completed</span>
                        <span style="font-size:.78rem;color:#6b7280;">Job finished successfully</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <span style="display:inline-flex;padding:.15rem .5rem;border-radius:20px;font-size:.68rem;font-weight:700;background:#fee2e2;color:#991b1b;">Cancelled</span>
                        <span style="font-size:.78rem;color:#6b7280;">Job was abandoned</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
