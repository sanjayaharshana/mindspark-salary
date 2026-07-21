@extends('layouts.admin')

@section('title', 'Database Backups')
@section('page-title', 'Database Backups')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Database Backups</span>
@endsection

@section('content')
<style>
.bk-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.bk-subtitle { color:#6b7280; font-size:.82rem; margin-top:.25rem; }
.bk-run-btn { padding:.5rem 1rem; border:none; border-radius:6px; font-size:.82rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.4rem; background:#4f46e5; color:#fff; transition:all .15s; }
.bk-run-btn:hover { background:#4338ca; }
.bk-run-btn:disabled { background:#a5b4fc; cursor:not-allowed; }

.bk-groups { display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:1rem; }
.bk-group { background:#fff; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; }
.bk-group-head { display:flex; align-items:center; justify-content:space-between; padding:.75rem 1rem; background:#f9fafb; border-bottom:1px solid #e5e7eb; }
.bk-group-title { display:flex; align-items:center; gap:.5rem; font-size:.85rem; font-weight:700; color:#1f2937; }
.bk-group-count { background:#eef2ff; color:#4338ca; border-radius:20px; padding:.1rem .55rem; font-size:.68rem; font-weight:700; }
.bk-list { max-height:420px; overflow-y:auto; }
.bk-item { display:flex; align-items:center; justify-content:space-between; gap:.6rem; padding:.65rem 1rem; border-bottom:1px solid #f3f4f6; }
.bk-item:last-child { border-bottom:none; }
.bk-item-meta { min-width:0; }
.bk-item-name { font-family:monospace; font-size:.72rem; color:#374151; word-break:break-all; }
.bk-item-sub { font-size:.7rem; color:#9ca3af; margin-top:.15rem; display:flex; gap:.5rem; flex-wrap:wrap; }
.bk-dl-btn { flex-shrink:0; display:inline-flex; align-items:center; gap:.3rem; padding:.35rem .65rem; border-radius:6px; font-size:.72rem; font-weight:600; text-decoration:none; background:#f0fdf4; color:#15803d; border:1px solid #bbf7d0; transition:all .15s; }
.bk-dl-btn:hover { background:#dcfce7; }
.bk-empty { padding:1.5rem 1rem; text-align:center; color:#9ca3af; font-size:.8rem; font-style:italic; }

.bk-info { background:#eff6ff; border:1px solid #bfdbfe; color:#1e40af; padding:.7rem 1rem; border-radius:8px; font-size:.78rem; margin-bottom:1rem; line-height:1.5; }
.bk-info code { background:rgba(255,255,255,.6); padding:.1rem .35rem; border-radius:4px; font-size:.75rem; }
</style>

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:.6rem 1rem;border-radius:8px;font-size:.82rem;margin-bottom:.75rem;">{{ session('success') }}</div>
@endif
@if(session('error'))
<div style="background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:.6rem 1rem;border-radius:8px;font-size:.82rem;margin-bottom:.75rem;">{{ session('error') }}</div>
@endif

<div class="bk-header">
    <div>
        <h3 style="margin:0;font-size:1rem;">Database Backups</h3>
        <p class="bk-subtitle">Daily dumps are filed automatically; the same run is also kept as a weekly copy on Sundays and a monthly copy on the 1st.</p>
    </div>
    @can('run backups')
    <form method="POST" action="{{ route('admin.backups.run') }}" onsubmit="return confirm('Run a backup now? This dumps the full database and may take a moment.');">
        @csrf
        <button type="submit" class="bk-run-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Run Backup Now
        </button>
    </form>
    @endcan
</div>

<div class="bk-info">
    Automatic backups require the Laravel scheduler to be running on the server (a cron entry calling <code>php artisan schedule:run</code> every minute). Retention: last 2 daily, 8 weekly, 12 monthly backups are kept — older ones are pruned automatically as soon as a new backup is created.
</div>

<div class="bk-groups">
    @foreach(['daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly'] as $type => $label)
    <div class="bk-group">
        <div class="bk-group-head">
            <div class="bk-group-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                {{ $label }} Backups
            </div>
            <span class="bk-group-count">{{ count($backups[$type]) }}</span>
        </div>
        <div class="bk-list">
            @forelse($backups[$type] as $file)
            <div class="bk-item">
                <div class="bk-item-meta">
                    <div class="bk-item-name">{{ $file['filename'] }}</div>
                    <div class="bk-item-sub">
                        <span>{{ $file['created_at']->format('M d, Y H:i') }}</span>
                        <span>&middot;</span>
                        <span>{{ $file['size'] }}</span>
                    </div>
                </div>
                @can('download backups')
                <a href="{{ route('admin.backups.download', ['type' => $type, 'filename' => $file['filename']]) }}" class="bk-dl-btn">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Download
                </a>
                @endcan
            </div>
            @empty
            <div class="bk-empty">No {{ strtolower($label) }} backups yet.</div>
            @endforelse
        </div>
    </div>
    @endforeach
</div>
@endsection
