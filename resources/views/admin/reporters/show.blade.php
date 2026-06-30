@extends('layouts.admin')

@section('title', 'Reporter Details')
@section('page-title', 'Reporter Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.reporters.index') }}" class="breadcrumb-item">Reporters</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">{{ $reporter->name }}</span>
@endsection

@section('content')
<style>
.rpv-layout { display:grid; grid-template-columns:260px 1fr; gap:1rem; align-items:start; }
.rpv-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; margin-bottom:1rem; }
.rpv-card:last-child { margin-bottom:0; }
.rpv-card-header { padding:.65rem 1rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.82rem; font-weight:700; color:#374151; display:flex; align-items:center; gap:.4rem; }
.rpv-card-body { padding:1rem; }
.rpv-card-footer { padding:.75rem 1rem; border-top:1px solid #e5e7eb; background:#f8fafc; display:flex; flex-direction:column; gap:.4rem; }

.rpv-avatar { width:60px; height:60px; border-radius:50%; background:linear-gradient(135deg,#f59e0b,#d97706); color:#fff; font-size:1.3rem; font-weight:700; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.rpv-name { font-size:1rem; font-weight:700; color:#1f2937; text-align:center; margin-bottom:.15rem; }
.rpv-email { font-size:.75rem; color:#6b7280; text-align:center; margin-bottom:.75rem; }

.rpv-meta-row { display:flex; justify-content:space-between; align-items:center; padding:.4rem 0; border-bottom:1px solid #f3f4f6; font-size:.78rem; }
.rpv-meta-row:last-child { border-bottom:none; }
.rpv-meta-label { color:#6b7280; }
.rpv-meta-value { font-weight:600; color:#1f2937; text-align:right; max-width:55%; }

.rpv-btn { padding:.4rem .9rem; border:none; border-radius:6px; font-size:.78rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.35rem; transition:all .15s; text-decoration:none; width:100%; }
.rpv-btn-primary { background:#3b82f6; color:#fff; } .rpv-btn-primary:hover { background:#2563eb; }
.rpv-btn-ghost  { background:#fff; color:#374151; border:1px solid #d1d5db; } .rpv-btn-ghost:hover { background:#f3f4f6; }
.rpv-btn-danger { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; } .rpv-btn-danger:hover { background:#fee2e2; }

.rpv-detail-row { display:flex; gap:.5rem; padding:.55rem 0; border-bottom:1px solid #f3f4f6; align-items:flex-start; }
.rpv-detail-row:last-child { border-bottom:none; }
.rpv-detail-label { font-size:.72rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.03em; min-width:110px; padding-top:.1rem; }
.rpv-detail-value { font-size:.82rem; color:#1f2937; font-weight:500; flex:1; }

.xid-badge { display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .55rem; border-radius:5px; font-size:.75rem; font-weight:600; font-family:monospace; background:#fef3c7; color:#92400e; border:1px solid #fde68a; }
.role-badge { display:inline-flex; padding:.15rem .5rem; border-radius:20px; font-size:.7rem; font-weight:600; background:#dbeafe; color:#1e40af; margin:.1rem .1rem 0 0; text-transform:capitalize; }
.perm-badge { display:inline-flex; padding:.12rem .45rem; border-radius:20px; font-size:.68rem; font-weight:500; background:#f0fdf4; color:#166534; margin:.1rem .1rem 0 0; }
.no-val { font-size:.78rem; color:#9ca3af; font-style:italic; }

@media(max-width:768px){ .rpv-layout { grid-template-columns:1fr; } }
</style>

<div class="rpv-layout">

    {{-- Left: Profile card --}}
    <div>
        <div class="rpv-card">
            <div class="rpv-card-body" style="text-align:center;padding:1.25rem 1rem .75rem;">
                <div class="rpv-avatar">{{ strtoupper(substr($reporter->name,0,1)) }}{{ strtoupper(substr(explode(' ',$reporter->name)[1] ?? '',0,1)) }}</div>
                <div class="rpv-name">{{ $reporter->name }}</div>
                <div class="rpv-email">{{ $reporter->email }}</div>
                @if($reporter->xelenic_id)
                    <span class="xid-badge">
                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                        {{ $reporter->xelenic_id }}
                    </span>
                @endif
            </div>
            <div style="padding:.25rem 1rem .75rem;">
                <div class="rpv-meta-row">
                    <span class="rpv-meta-label">Joined</span>
                    <span class="rpv-meta-value">{{ $reporter->created_at->format('d M Y') }}</span>
                </div>
                <div class="rpv-meta-row">
                    <span class="rpv-meta-label">Updated</span>
                    <span class="rpv-meta-value">{{ $reporter->updated_at->format('d M Y') }}</span>
                </div>
                <div class="rpv-meta-row">
                    <span class="rpv-meta-label">Roles</span>
                    <span class="rpv-meta-value">{{ $reporter->roles->count() }}</span>
                </div>
            </div>
            <div class="rpv-card-footer">
                <a href="{{ route('admin.reporters.edit', $reporter) }}" class="rpv-btn rpv-btn-primary">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Reporter
                </a>
                <a href="{{ route('admin.reporters.index') }}" class="rpv-btn rpv-btn-ghost">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    Back to Reporters
                </a>
                @if($reporter->id !== Auth::id())
                <form method="POST" action="{{ route('admin.reporters.destroy', $reporter) }}" onsubmit="return confirm('Delete {{ addslashes($reporter->name) }}? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="rpv-btn rpv-btn-danger">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                        Delete Reporter
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Right: Details --}}
    <div>
        <div class="rpv-card">
            <div class="rpv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Account Details
            </div>
            <div class="rpv-card-body">
                <div class="rpv-detail-row">
                    <span class="rpv-detail-label">Full Name</span>
                    <span class="rpv-detail-value">{{ $reporter->name }}</span>
                </div>
                <div class="rpv-detail-row">
                    <span class="rpv-detail-label">Email</span>
                    <span class="rpv-detail-value">{{ $reporter->email }}</span>
                </div>
                <div class="rpv-detail-row">
                    <span class="rpv-detail-label">Xelenic ID</span>
                    <span class="rpv-detail-value">
                        @if($reporter->xelenic_id)
                            <span class="xid-badge">{{ $reporter->xelenic_id }}</span>
                        @else
                            <span class="no-val">Not set</span>
                        @endif
                    </span>
                </div>
                <div class="rpv-detail-row">
                    <span class="rpv-detail-label">Created</span>
                    <span class="rpv-detail-value">{{ $reporter->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="rpv-detail-row">
                    <span class="rpv-detail-label">Last Updated</span>
                    <span class="rpv-detail-value">{{ $reporter->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="rpv-card">
            <div class="rpv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
                Assigned Roles
            </div>
            <div class="rpv-card-body">
                @if($reporter->roles->count() > 0)
                    @foreach($reporter->roles as $role)
                        <span class="role-badge">{{ $role->name }}</span>
                    @endforeach
                @else
                    <span class="no-val">No roles assigned</span>
                @endif
            </div>
        </div>

        @if($reporter->permissions->count() > 0)
        <div class="rpv-card">
            <div class="rpv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                Direct Permissions
            </div>
            <div class="rpv-card-body">
                @foreach($reporter->permissions as $permission)
                    <span class="perm-badge">{{ $permission->name }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

</div>
@endsection
