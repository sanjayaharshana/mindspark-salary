@extends('layouts.admin')

@section('title', 'Job Details')
@section('page-title', 'Job Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.jobs.index') }}" class="breadcrumb-item">Jobs</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Details</span>
@endsection

@section('content')
<style>
.js-layout { display:grid; grid-template-columns:260px 1fr; gap:1rem; align-items:start; }
@media(max-width:768px){ .js-layout { grid-template-columns:1fr; } }

.js-sidebar { display:flex; flex-direction:column; gap:.75rem; }
.js-card { background:#fff; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; }
.js-card-head { padding:.65rem 1rem; border-bottom:1px solid #f3f4f6; }
.js-card-title { font-size:.72rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; margin:0; }
.js-card-body { padding:1rem; }

.js-avatar { width:64px; height:64px; border-radius:10px; background:#1f2937; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.js-avatar-text { color:#fff; font-size:.65rem; font-weight:700; font-family:monospace; text-align:center; line-height:1.2; padding:.25rem; }
.js-job-name { font-size:1rem; font-weight:700; color:#1f2937; margin:.5rem 0 .25rem; }

.js-status { display:inline-flex; padding:.2rem .6rem; border-radius:20px; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.04em; }
.js-status-pending     { background:#fef3c7; color:#92400e; }
.js-status-in_progress { background:#dbeafe; color:#1e40af; }
.js-status-completed   { background:#d1fae5; color:#065f46; }
.js-status-cancelled   { background:#fee2e2; color:#991b1b; }
.js-overdue { display:inline-flex; padding:.2rem .55rem; border-radius:20px; font-size:.68rem; font-weight:600; background:#fef2f2; color:#dc2626; margin-left:.3rem; }

.js-meta { display:flex; flex-direction:column; gap:.5rem; margin-top:.75rem; }
.js-meta-row { display:flex; gap:.5rem; align-items:flex-start; }
.js-meta-icon { width:16px; height:16px; flex-shrink:0; margin-top:.05rem; }
.js-meta-lbl { font-size:.7rem; color:#9ca3af; }
.js-meta-val { font-size:.8rem; color:#374151; font-weight:500; }

.js-client-code { display:inline-flex; padding:.15rem .45rem; border-radius:5px; font-size:.7rem; font-weight:700; font-family:monospace; background:#fff7ed; color:#c2410c; border:1px solid #fed7aa; }
.js-jobnum { display:inline-flex; padding:.18rem .55rem; border-radius:5px; font-size:.8rem; font-weight:700; font-family:monospace; background:#1f2937; color:#fff; }

.js-act-row { display:flex; flex-direction:column; gap:.4rem; }
.js-act-btn { padding:.45rem .9rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:.4rem; transition:all .15s; text-decoration:none; width:100%; }
.js-act-edit { background:#fff7ed; color:#ea580c; border:1px solid #fed7aa; } .js-act-edit:hover { background:#ffedd5; }
.js-act-del  { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; } .js-act-del:hover  { background:#fee2e2; }
.js-act-back { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .js-act-back:hover { background:#e5e7eb; }

.js-field { display:flex; flex-direction:column; gap:.2rem; padding:.65rem 0; border-bottom:1px solid #f3f4f6; }
.js-field:last-child { border-bottom:none; }
.js-field-lbl { font-size:.68rem; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:.05em; }
.js-field-val { font-size:.84rem; color:#374151; }
.js-field-val strong { color:#1f2937; }
.no-val { font-size:.8rem; color:#9ca3af; font-style:italic; }
</style>

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:.6rem 1rem;border-radius:8px;font-size:.82rem;margin-bottom:.75rem;display:flex;align-items:center;gap:.5rem;">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="js-layout">
    {{-- Sidebar --}}
    <div class="js-sidebar">
        {{-- Identity card --}}
        <div class="js-card">
            <div class="js-card-body" style="text-align:center;">
                <div class="js-avatar" style="margin:0 auto .75rem;">
                    <div class="js-avatar-text">{{ $job->job_number }}</div>
                </div>
                <div class="js-job-name">{{ $job->job_name }}</div>
                <div>
                    <span class="js-status js-status-{{ $job->status }}">{{ ucfirst(str_replace('_', ' ', $job->status)) }}</span>
                    @if($job->is_overdue)
                        <span class="js-overdue">Overdue</span>
                    @endif
                </div>

                <div class="js-meta">
                    <div class="js-meta-row">
                        <svg class="js-meta-icon" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        <div>
                            <div class="js-meta-lbl">Client</div>
                            <div style="display:flex;align-items:center;gap:.3rem;flex-wrap:wrap;margin-top:.1rem;">
                                <span class="js-client-code">{{ $job->client->short_code ?? '—' }}</span>
                                <span class="js-meta-val">{{ $job->client->name ?? '—' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="js-meta-row">
                        <svg class="js-meta-icon" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <div>
                            <div class="js-meta-lbl">Created</div>
                            <div class="js-meta-val">{{ $job->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="js-meta-row">
                        <svg class="js-meta-icon" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <div>
                            <div class="js-meta-lbl">Last Updated</div>
                            <div class="js-meta-val">{{ $job->updated_at->format('d M Y, g:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions card --}}
        <div class="js-card">
            <div class="js-card-head"><p class="js-card-title">Actions</p></div>
            <div class="js-card-body">
                <div class="js-act-row">
                    @can('edit jobs')
                    <a href="{{ route('admin.jobs.edit', $job) }}" class="js-act-btn js-act-edit">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Job
                    </a>
                    @endcan
                    @can('delete jobs')
                    <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}" onsubmit="return confirm('Delete job {{ addslashes($job->job_number) }}? This cannot be undone.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="js-act-btn js-act-del">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                            Delete Job
                        </button>
                    </form>
                    @endcan
                    <a href="{{ route('admin.jobs.index') }}" class="js-act-btn js-act-back">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main content --}}
    <div style="display:flex;flex-direction:column;gap:.75rem;">

        {{-- Job Details card --}}
        <div class="js-card">
            <div class="js-card-head"><p class="js-card-title">Job Details</p></div>
            <div class="js-card-body">
                <div class="js-field">
                    <span class="js-field-lbl">Job Number</span>
                    <div class="js-field-val"><span class="js-jobnum">{{ $job->job_number }}</span></div>
                </div>
                <div class="js-field">
                    <span class="js-field-lbl">Job Name</span>
                    <div class="js-field-val"><strong>{{ $job->job_name }}</strong></div>
                </div>
                <div class="js-field">
                    <span class="js-field-lbl">Client</span>
                    <div class="js-field-val" style="display:flex;align-items:center;gap:.4rem;">
                        <span class="js-client-code">{{ $job->client->short_code ?? '—' }}</span>
                        <span>{{ $job->client->name ?? '—' }}</span>
                    </div>
                </div>
                @if($job->description)
                <div class="js-field">
                    <span class="js-field-lbl">Description</span>
                    <div class="js-field-val" style="line-height:1.6;white-space:pre-wrap;">{{ $job->description }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Assignment card --}}
        <div class="js-card">
            <div class="js-card-head"><p class="js-card-title">Assignment</p></div>
            <div class="js-card-body">
                <div class="js-field">
                    <span class="js-field-lbl">Officer</span>
                    <div class="js-field-val">
                        @if($job->officer)
                            <strong>{{ $job->officer->name }}</strong>
                            <span style="color:#6b7280;font-size:.78rem;margin-left:.4rem;">{{ $job->officer->email }}</span>
                        @else
                            <span class="no-val">Not assigned</span>
                        @endif
                    </div>
                </div>
                <div class="js-field">
                    <span class="js-field-lbl">Reporter</span>
                    <div class="js-field-val">
                        @if($job->reporter)
                            <strong>{{ $job->reporter->name }}</strong>
                            <span style="color:#6b7280;font-size:.78rem;margin-left:.4rem;">{{ $job->reporter->email }}</span>
                        @else
                            <span class="no-val">Not assigned</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Timeline card --}}
        <div class="js-card">
            <div class="js-card-head"><p class="js-card-title">Timeline</p></div>
            <div class="js-card-body">
                <div class="js-field">
                    <span class="js-field-lbl">Start Date</span>
                    <div class="js-field-val">{{ $job->start_date ? $job->start_date->format('d F Y') : '—' }}</div>
                </div>
                <div class="js-field">
                    <span class="js-field-lbl">End Date</span>
                    <div class="js-field-val">
                        {{ $job->end_date ? $job->end_date->format('d F Y') : '—' }}
                        @if($job->is_overdue)
                            <span class="js-overdue" style="margin-left:.3rem;">Overdue</span>
                        @endif
                    </div>
                </div>
                @if($job->duration)
                <div class="js-field">
                    <span class="js-field-lbl">Duration</span>
                    <div class="js-field-val">{{ $job->duration }} days</div>
                </div>
                @endif
                <div class="js-field">
                    <span class="js-field-lbl">Status</span>
                    <div class="js-field-val">
                        <span class="js-status js-status-{{ $job->status }}">{{ ucfirst(str_replace('_', ' ', $job->status)) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
