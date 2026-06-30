@extends('layouts.admin')

@section('title', 'Officer Details')
@section('page-title', 'Officer Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.officers.index') }}" class="breadcrumb-item">Officers</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">{{ $officer->name }}</span>
@endsection

@section('content')
<style>
.ofv-layout { display:grid; grid-template-columns:260px 1fr; gap:1rem; align-items:start; }
.ofv-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; margin-bottom:1rem; }
.ofv-card:last-child { margin-bottom:0; }
.ofv-card-header { padding:.65rem 1rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.82rem; font-weight:700; color:#374151; display:flex; align-items:center; gap:.4rem; }
.ofv-card-body { padding:1rem; }
.ofv-card-footer { padding:.75rem 1rem; border-top:1px solid #e5e7eb; background:#f8fafc; display:flex; flex-direction:column; gap:.4rem; }

.ofv-avatar { width:60px; height:60px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#4f46e5); color:#fff; font-size:1.3rem; font-weight:700; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.ofv-name { font-size:1rem; font-weight:700; color:#1f2937; text-align:center; margin-bottom:.15rem; }
.ofv-email { font-size:.75rem; color:#6b7280; text-align:center; margin-bottom:.75rem; }

.ofv-meta-row { display:flex; justify-content:space-between; align-items:center; padding:.4rem 0; border-bottom:1px solid #f3f4f6; font-size:.78rem; }
.ofv-meta-row:last-child { border-bottom:none; }
.ofv-meta-label { color:#6b7280; }
.ofv-meta-value { font-weight:600; color:#1f2937; }

.ofv-btn { padding:.4rem .9rem; border:none; border-radius:6px; font-size:.78rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.35rem; transition:all .15s; text-decoration:none; width:100%; }
.ofv-btn-primary { background:#6366f1; color:#fff; } .ofv-btn-primary:hover { background:#4f46e5; }
.ofv-btn-ghost  { background:#fff; color:#374151; border:1px solid #d1d5db; } .ofv-btn-ghost:hover { background:#f3f4f6; }
.ofv-btn-danger { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; } .ofv-btn-danger:hover { background:#fee2e2; }

.ofv-detail-row { display:flex; gap:.5rem; padding:.55rem 0; border-bottom:1px solid #f3f4f6; align-items:flex-start; }
.ofv-detail-row:last-child { border-bottom:none; }
.ofv-detail-label { font-size:.72rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.03em; min-width:110px; padding-top:.1rem; }
.ofv-detail-value { font-size:.82rem; color:#1f2937; font-weight:500; flex:1; }

.xid-badge { display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .55rem; border-radius:5px; font-size:.75rem; font-weight:600; font-family:monospace; background:#ede9fe; color:#5b21b6; border:1px solid #ddd6fe; }
.role-badge { display:inline-flex; padding:.15rem .5rem; border-radius:20px; font-size:.7rem; font-weight:600; background:#dbeafe; color:#1e40af; margin:.1rem .1rem 0 0; text-transform:capitalize; }
.perm-badge { display:inline-flex; padding:.12rem .45rem; border-radius:20px; font-size:.68rem; font-weight:500; background:#f0fdf4; color:#166534; margin:.1rem .1rem 0 0; }
.no-val { font-size:.78rem; color:#9ca3af; font-style:italic; }

@media(max-width:768px){ .ofv-layout { grid-template-columns:1fr; } }
</style>

<div class="ofv-layout">

    {{-- Left: Profile card --}}
    <div>
        <div class="ofv-card">
            <div class="ofv-card-body" style="text-align:center;padding:1.25rem 1rem .75rem;">
                <div class="ofv-avatar">{{ strtoupper(substr($officer->name,0,1)) }}{{ strtoupper(substr(explode(' ',$officer->name)[1] ?? '',0,1)) }}</div>
                <div class="ofv-name">{{ $officer->name }}</div>
                <div class="ofv-email">{{ $officer->email }}</div>
                @if($officer->xelenic_id)
                    <span class="xid-badge">
                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                        {{ $officer->xelenic_id }}
                    </span>
                @endif
            </div>
            <div style="padding:.25rem 1rem .75rem;">
                <div class="ofv-meta-row">
                    <span class="ofv-meta-label">Joined</span>
                    <span class="ofv-meta-value">{{ $officer->created_at->format('d M Y') }}</span>
                </div>
                <div class="ofv-meta-row">
                    <span class="ofv-meta-label">Updated</span>
                    <span class="ofv-meta-value">{{ $officer->updated_at->format('d M Y') }}</span>
                </div>
                <div class="ofv-meta-row">
                    <span class="ofv-meta-label">Roles</span>
                    <span class="ofv-meta-value">{{ $officer->roles->count() }}</span>
                </div>
            </div>
            <div class="ofv-card-footer">
                <a href="{{ route('admin.officers.edit', $officer) }}" class="ofv-btn ofv-btn-primary">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Officer
                </a>
                <a href="{{ route('admin.officers.index') }}" class="ofv-btn ofv-btn-ghost">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    Back to Officers
                </a>
                @if($officer->id !== Auth::id())
                <form method="POST" action="{{ route('admin.officers.destroy', $officer) }}" onsubmit="return confirm('Delete {{ addslashes($officer->name) }}? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="ofv-btn ofv-btn-danger">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                        Delete Officer
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Right: Details --}}
    <div>
        <div class="ofv-card">
            <div class="ofv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Account Details
            </div>
            <div class="ofv-card-body">
                <div class="ofv-detail-row">
                    <span class="ofv-detail-label">Full Name</span>
                    <span class="ofv-detail-value">{{ $officer->name }}</span>
                </div>
                <div class="ofv-detail-row">
                    <span class="ofv-detail-label">Email</span>
                    <span class="ofv-detail-value">{{ $officer->email }}</span>
                </div>
                <div class="ofv-detail-row">
                    <span class="ofv-detail-label">Xelenic ID</span>
                    <span class="ofv-detail-value">
                        @if($officer->xelenic_id)
                            <span class="xid-badge">{{ $officer->xelenic_id }}</span>
                        @else
                            <span class="no-val">Not set</span>
                        @endif
                    </span>
                </div>
                <div class="ofv-detail-row">
                    <span class="ofv-detail-label">Created</span>
                    <span class="ofv-detail-value">{{ $officer->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="ofv-detail-row">
                    <span class="ofv-detail-label">Last Updated</span>
                    <span class="ofv-detail-value">{{ $officer->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="ofv-card">
            <div class="ofv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
                Assigned Roles
            </div>
            <div class="ofv-card-body">
                @if($officer->roles->count() > 0)
                    @foreach($officer->roles as $role)
                        <span class="role-badge">{{ $role->name }}</span>
                    @endforeach
                @else
                    <span class="no-val">No roles assigned</span>
                @endif
            </div>
        </div>

        @if($officer->permissions->count() > 0)
        <div class="ofv-card">
            <div class="ofv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                Direct Permissions
            </div>
            <div class="ofv-card-body">
                @foreach($officer->permissions as $permission)
                    <span class="perm-badge">{{ $permission->name }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

</div>
@endsection
