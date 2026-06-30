@extends('layouts.admin')

@section('title', 'Brands')
@section('page-title', 'Brand Management')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">Brands</span>
@endsection

@section('content')
<style>
.bm-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:.5rem; }
.bm-title { font-size:1.1rem; font-weight:700; color:#1f2937; margin:0; }
.bm-subtitle { font-size:.75rem; color:#6b7280; margin:.1rem 0 0; }

.bm-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:.625rem; margin-bottom:1rem; }
.bm-stat { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; display:flex; align-items:center; gap:.75rem; }
.bm-stat-icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.bm-stat-val { font-size:1.25rem; font-weight:700; color:#1f2937; line-height:1; }
.bm-stat-lbl { font-size:.7rem; color:#6b7280; margin-top:.1rem; }

.bm-filters { background:#fff; border:1px solid #e5e7eb; border-radius:8px; padding:.75rem 1rem; margin-bottom:1rem; display:flex; gap:.625rem; flex-wrap:wrap; align-items:flex-end; }
.bm-filter-group { display:flex; flex-direction:column; gap:.25rem; flex:1; min-width:160px; }
.bm-filter-group label { font-size:.72rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; }
.bm-input { padding:.45rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; box-sizing:border-box; }
.bm-input:focus { border-color:#0d9488; box-shadow:0 0 0 3px rgba(13,148,136,.1); }

.bm-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.bm-btn-primary { background:#0d9488; color:#fff; } .bm-btn-primary:hover { background:#0f766e; }
.bm-btn-success { background:#10b981; color:#fff; } .bm-btn-success:hover { background:#059669; }
.bm-btn-ghost  { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .bm-btn-ghost:hover { background:#e5e7eb; }
.bm-btn-danger { background:#ef4444; color:#fff; } .bm-btn-danger:hover { background:#dc2626; }
.bm-btn-sm { padding:.3rem .65rem; font-size:.75rem; }
.bm-icon-btn { width:28px; height:28px; padding:0; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .12s; text-decoration:none; flex-shrink:0; border:1px solid transparent; }
.bm-icon-view { background:#f3f4f6; border-color:#e5e7eb; color:#6b7280; } .bm-icon-view:hover { background:#e5e7eb; color:#374151; }
.bm-icon-edit { background:#f0fdfa; border-color:#99f6e4; color:#0f766e; } .bm-icon-edit:hover { background:#ccfbf1; }
.bm-icon-del  { background:#fef2f2; border-color:#fecaca; color:#dc2626; } .bm-icon-del:hover  { background:#fee2e2; }

.bm-table-wrap { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.bm-table { width:100%; border-collapse:collapse; }
.bm-table thead tr { background:#f8fafc; }
.bm-table th { padding:.6rem 1rem; font-size:.7rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
.bm-table td { padding:.65rem 1rem; font-size:.82rem; color:#374151; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.bm-table tbody tr:last-child td { border-bottom:none; }
.bm-table tbody tr:hover td { background:#f9fafb; }

.bm-avatar { width:34px; height:34px; border-radius:8px; background:linear-gradient(135deg,#0d9488,#0891b2); color:#fff; font-size:.7rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; letter-spacing:.05em; }
.bm-brand-cell { display:flex; align-items:center; gap:.6rem; }
.bm-brand-name { font-weight:600; color:#1f2937; font-size:.83rem; }
.bm-brand-contact { font-size:.72rem; color:#6b7280; }

.sc-badge { display:inline-flex; align-items:center; padding:.15rem .5rem; border-radius:5px; font-size:.72rem; font-weight:700; font-family:monospace; background:#ccfbf1; color:#065f46; border:1px solid #99f6e4; letter-spacing:.08em; }

.status-pill { display:inline-flex; align-items:center; gap:.25rem; padding:.18rem .55rem; border-radius:20px; font-size:.68rem; font-weight:600; text-transform:uppercase; letter-spacing:.04em; }
.status-active   { background:#d1fae5; color:#065f46; }
.status-inactive { background:#fef3c7; color:#92400e; }
.status-suspended{ background:#fee2e2; color:#991b1b; }

.bm-actions { display:flex; gap:.3rem; flex-wrap:wrap; }
.bm-pagination { border-top:1px solid #e5e7eb; }
.bm-empty { padding:3rem 1rem; text-align:center; }
.bm-empty-icon { width:48px; height:48px; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; }
.bm-empty p { color:#6b7280; font-size:.85rem; margin:.25rem 0; }
</style>

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:.6rem 1rem;border-radius:8px;font-size:.82rem;margin-bottom:.75rem;display:flex;align-items:center;gap:.5rem;">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div style="background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:.6rem 1rem;border-radius:8px;font-size:.82rem;margin-bottom:.75rem;">{{ session('error') }}</div>
@endif

{{-- Header --}}
<div class="bm-header">
    <div>
        <p class="bm-title">All Brands</p>
        <p class="bm-subtitle">Manage brand clients and their information</p>
    </div>
    @can('create clients')
    <a href="{{ route('admin.clients.create') }}" class="bm-btn bm-btn-success">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add New Brand
    </a>
    @endcan
</div>

{{-- Stats --}}
<div class="bm-stats">
    <div class="bm-stat">
        <div class="bm-stat-icon" style="background:#f0fdfa;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
        </div>
        <div><div class="bm-stat-val">{{ $total }}</div><div class="bm-stat-lbl">Total Brands</div></div>
    </div>
    <div class="bm-stat">
        <div class="bm-stat-icon" style="background:#f0fdf4;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div><div class="bm-stat-val">{{ $active }}</div><div class="bm-stat-lbl">Active</div></div>
    </div>
    <div class="bm-stat">
        <div class="bm-stat-icon" style="background:#fefce8;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ca8a04" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div><div class="bm-stat-val">{{ $inactive }}</div><div class="bm-stat-lbl">Inactive / Suspended</div></div>
    </div>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('admin.clients.index') }}">
<div class="bm-filters">
    <div class="bm-filter-group" style="flex:2;">
        <label>Search</label>
        <div style="position:relative;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input class="bm-input" name="search" value="{{ request('search') }}" placeholder="Search by name, code, email or company…" style="padding-left:2rem;">
        </div>
    </div>
    <div class="bm-filter-group" style="max-width:160px;">
        <label>Status</label>
        <select class="bm-input" name="status">
            <option value="">All Statuses</option>
            <option value="active"    {{ request('status') === 'active'    ? 'selected' : '' }}>Active</option>
            <option value="inactive"  {{ request('status') === 'inactive'  ? 'selected' : '' }}>Inactive</option>
            <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
    </div>
    <div style="display:flex;gap:.35rem;padding-bottom:.05rem;">
        <button type="submit" class="bm-btn bm-btn-primary">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Filter
        </button>
        @if(request('search') || request('status'))
        <a href="{{ route('admin.clients.index') }}" class="bm-btn bm-btn-ghost">Clear</a>
        @endif
    </div>
</div>
</form>

{{-- Table --}}
<div class="bm-table-wrap">
    @if($clients->count() > 0)
    <table class="bm-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Code</th>
                <th>Email</th>
                <th>Company</th>
                <th>Status</th>
                <th>Created</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td style="color:#9ca3af;font-size:.75rem;">{{ $clients->firstItem() + $loop->index }}</td>
                <td>
                    <div class="bm-brand-cell">
                        <div class="bm-avatar">{{ $client->short_code }}</div>
                        <div>
                            <div class="bm-brand-name">{{ $client->name }}</div>
                            @if($client->contact_person)
                                <div class="bm-brand-contact">{{ $client->contact_person }}</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td><span class="sc-badge">{{ $client->short_code }}</span></td>
                <td style="color:#6b7280;">{{ $client->email }}</td>
                <td style="color:#6b7280;">{{ $client->company_name ?: '—' }}</td>
                <td><span class="status-pill status-{{ $client->status }}">{{ ucfirst($client->status) }}</span></td>
                <td style="white-space:nowrap;color:#6b7280;">{{ $client->created_at->format('d M Y') }}</td>
                <td>
                    <div class="bm-actions" style="justify-content:flex-end;">
                        @can('view clients')
                        <a href="{{ route('admin.clients.show', $client) }}" class="bm-icon-btn bm-icon-view" title="View">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        @endcan
                        @can('edit clients')
                        <a href="{{ route('admin.clients.edit', $client) }}" class="bm-icon-btn bm-icon-edit" title="Edit">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        @endcan
                        @can('delete clients')
                        <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" style="display:inline;" onsubmit="return confirm('Delete brand \'{{ addslashes($client->name) }}\'? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bm-icon-btn bm-icon-del" title="Delete">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                            </button>
                        </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="bm-pagination">
        {{ $clients->links() }}
    </div>
    @else
    <div class="bm-empty">
        <div class="bm-empty-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
        </div>
        @if(request('search') || request('status'))
            <p style="font-weight:600;color:#374151;">No brands match your filters</p>
            <p>Try adjusting your search or <a href="{{ route('admin.clients.index') }}" style="color:#0d9488;">clear filters</a>.</p>
        @else
            <p style="font-weight:600;color:#374151;">No brands yet</p>
            @can('create clients')
            <p><a href="{{ route('admin.clients.create') }}" style="color:#0d9488;">Add the first brand</a></p>
            @endcan
        @endif
    </div>
    @endif
</div>
@endsection
