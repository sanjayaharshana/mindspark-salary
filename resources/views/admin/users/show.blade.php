@extends('layouts.admin')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.users.index') }}" class="breadcrumb-item">Users</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">{{ $user->name }}</span>
@endsection

@section('content')
<style>
.up-grid { display:grid; grid-template-columns:260px 1fr; gap:1rem; align-items:start; }
.up-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.up-profile { padding:1.5rem 1rem; text-align:center; border-bottom:1px solid #f3f4f6; }
.up-avatar-lg { width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; font-size:1.4rem; font-weight:700; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.up-name { font-size:1rem; font-weight:700; color:#1f2937; }
.up-email { font-size:.78rem; color:#6b7280; margin-top:.2rem; word-break:break-all; }
.up-meta { padding:.75rem 1rem; }
.up-meta-row { display:flex; justify-content:space-between; padding:.45rem 0; border-bottom:1px solid #f3f4f6; font-size:.78rem; }
.up-meta-row:last-child { border-bottom:none; }
.up-meta-key { color:#6b7280; font-weight:500; }
.up-meta-val { color:#1f2937; font-weight:600; text-align:right; }
.up-section { padding:.75rem 1rem; }
.up-section-title { font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.6rem; }
.role-badge { display:inline-flex; align-items:center; padding:.2rem .6rem; border-radius:20px; font-size:.72rem; font-weight:600; background:#dbeafe; color:#1e40af; margin:.15rem .15rem 0 0; text-transform:capitalize; }
.perm-badge { display:inline-flex; align-items:center; padding:.15rem .45rem; border-radius:4px; font-size:.67rem; font-weight:500; background:#f0fdf4; color:#166534; margin:.1rem .1rem 0 0; }
.up-actions { padding:.75rem 1rem; border-top:1px solid #f3f4f6; display:flex; gap:.5rem; }
.um-btn { padding:.4rem .9rem; border:none; border-radius:6px; font-size:.78rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; }
.um-btn-primary { background:#3b82f6; color:#fff; } .um-btn-primary:hover { background:#2563eb; }
.um-btn-ghost  { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .um-btn-ghost:hover { background:#e5e7eb; }
</style>

<div class="up-grid">
    {{-- Left: Profile card --}}
    <div class="up-card">
        <div class="up-profile">
            <div class="up-avatar-lg">{{ strtoupper(substr($user->name,0,1)) }}{{ strtoupper(substr(explode(' ',$user->name)[1] ?? '',0,1)) }}</div>
            <div class="up-name">{{ $user->name }}</div>
            <div class="up-email">{{ $user->email }}</div>
        </div>
        <div class="up-meta">
            <div class="up-meta-row">
                <span class="up-meta-key">User ID</span>
                <span class="up-meta-val">#{{ $user->id }}</span>
            </div>
            <div class="up-meta-row">
                <span class="up-meta-key">Joined</span>
                <span class="up-meta-val">{{ $user->created_at->format('d M Y') }}</span>
            </div>
            <div class="up-meta-row">
                <span class="up-meta-key">Updated</span>
                <span class="up-meta-val">{{ $user->updated_at->format('d M Y') }}</span>
            </div>
            <div class="up-meta-row">
                <span class="up-meta-key">Roles</span>
                <span class="up-meta-val">{{ $user->roles->count() }}</span>
            </div>
        </div>
        <div class="up-actions">
            <a href="{{ route('admin.users.edit', $user) }}" class="um-btn um-btn-primary" style="flex:1;justify-content:center;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="um-btn um-btn-ghost" style="flex:1;justify-content:center;">Back</a>
        </div>
    </div>

    {{-- Right: Details --}}
    <div style="display:flex;flex-direction:column;gap:.75rem;">
        <div class="up-card">
            <div class="up-section">
                <div class="up-section-title">Assigned Roles</div>
                @if($user->roles->count())
                    @foreach($user->roles as $role)
                        <span class="role-badge">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:3px;"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
                            {{ $role->name }}
                        </span>
                    @endforeach
                @else
                    <p style="color:#9ca3af;font-size:.8rem;font-style:italic;margin:0;">No roles assigned</p>
                @endif
            </div>
        </div>

        <div class="up-card">
            <div class="up-section">
                <div class="up-section-title">Direct Permissions</div>
                @if($user->permissions->count())
                    @foreach($user->permissions as $perm)
                        <span class="perm-badge">{{ $perm->name }}</span>
                    @endforeach
                @else
                    <p style="color:#9ca3af;font-size:.8rem;font-style:italic;margin:0;">No direct permissions — permissions come from roles</p>
                @endif
            </div>
        </div>

        @if($user->roles->count())
        <div class="up-card">
            <div class="up-section">
                <div class="up-section-title">All Effective Permissions (via roles)</div>
                @php $allPerms = $user->getAllPermissions()->sortBy('name'); @endphp
                @if($allPerms->count())
                    @foreach($allPerms as $perm)
                        <span class="perm-badge">{{ $perm->name }}</span>
                    @endforeach
                @else
                    <p style="color:#9ca3af;font-size:.8rem;font-style:italic;margin:0;">None</p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
