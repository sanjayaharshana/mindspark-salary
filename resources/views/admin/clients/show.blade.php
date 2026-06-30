@extends('layouts.admin')

@section('title', 'Brand Details')
@section('page-title', 'Brand Details')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.clients.index') }}" class="breadcrumb-item">Brands</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">{{ $client->name }}</span>
@endsection

@section('content')
<style>
.bv-layout { display:grid; grid-template-columns:240px 1fr; gap:1rem; align-items:start; }
.bv-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; margin-bottom:1rem; }
.bv-card:last-child { margin-bottom:0; }
.bv-card-header { padding:.65rem 1rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.82rem; font-weight:700; color:#374151; display:flex; align-items:center; gap:.4rem; }
.bv-card-body { padding:1rem; }
.bv-card-footer { padding:.75rem 1rem; border-top:1px solid #e5e7eb; background:#f8fafc; display:flex; flex-direction:column; gap:.4rem; }

.bv-avatar { width:64px; height:64px; border-radius:12px; background:linear-gradient(135deg,#0d9488,#0891b2); color:#fff; font-size:1.1rem; font-weight:700; display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; letter-spacing:.1em; }
.bv-name { font-size:1rem; font-weight:700; color:#1f2937; text-align:center; margin-bottom:.25rem; }

.bv-meta-row { display:flex; justify-content:space-between; align-items:center; padding:.4rem 0; border-bottom:1px solid #f3f4f6; font-size:.78rem; }
.bv-meta-row:last-child { border-bottom:none; }
.bv-meta-label { color:#6b7280; }
.bv-meta-value { font-weight:600; color:#1f2937; }

.bv-btn { padding:.4rem .9rem; border:none; border-radius:6px; font-size:.78rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.35rem; transition:all .15s; text-decoration:none; width:100%; }
.bv-btn-primary { background:#0d9488; color:#fff; } .bv-btn-primary:hover { background:#0f766e; }
.bv-btn-ghost  { background:#fff; color:#374151; border:1px solid #d1d5db; } .bv-btn-ghost:hover { background:#f3f4f6; }
.bv-btn-danger { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; } .bv-btn-danger:hover { background:#fee2e2; }

.bv-detail-row { display:flex; gap:.5rem; padding:.5rem 0; border-bottom:1px solid #f3f4f6; align-items:flex-start; }
.bv-detail-row:last-child { border-bottom:none; }
.bv-detail-label { font-size:.72rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.03em; min-width:120px; padding-top:.1rem; flex-shrink:0; }
.bv-detail-value { font-size:.82rem; color:#1f2937; font-weight:500; flex:1; }

.sc-badge { display:inline-flex; padding:.18rem .55rem; border-radius:5px; font-size:.78rem; font-weight:700; font-family:monospace; background:#ccfbf1; color:#065f46; border:1px solid #99f6e4; letter-spacing:.08em; }
.status-pill { display:inline-flex; align-items:center; gap:.25rem; padding:.18rem .55rem; border-radius:20px; font-size:.68rem; font-weight:600; text-transform:uppercase; letter-spacing:.04em; }
.status-active   { background:#d1fae5; color:#065f46; }
.status-inactive { background:#fef3c7; color:#92400e; }
.status-suspended{ background:#fee2e2; color:#991b1b; }
.no-val { font-size:.78rem; color:#9ca3af; font-style:italic; }

@media(max-width:768px){ .bv-layout { grid-template-columns:1fr; } }
</style>

<div class="bv-layout">

    {{-- Left sidebar --}}
    <div>
        <div class="bv-card">
            <div class="bv-card-body" style="text-align:center;padding:1.25rem 1rem .75rem;">
                <div class="bv-avatar">{{ $client->short_code }}</div>
                <div class="bv-name">{{ $client->name }}</div>
                <div style="margin:.35rem 0;"><span class="status-pill status-{{ $client->status }}">{{ ucfirst($client->status) }}</span></div>
                @if($client->contact_person)
                    <div style="font-size:.75rem;color:#6b7280;margin-top:.25rem;">{{ $client->contact_person }}</div>
                @endif
            </div>
            <div style="padding:.25rem 1rem .75rem;">
                <div class="bv-meta-row">
                    <span class="bv-meta-label">Short Code</span>
                    <span class="sc-badge">{{ $client->short_code }}</span>
                </div>
                <div class="bv-meta-row">
                    <span class="bv-meta-label">Created</span>
                    <span class="bv-meta-value">{{ $client->created_at->format('d M Y') }}</span>
                </div>
                <div class="bv-meta-row">
                    <span class="bv-meta-label">Updated</span>
                    <span class="bv-meta-value">{{ $client->updated_at->format('d M Y') }}</span>
                </div>
            </div>
            <div class="bv-card-footer">
                @can('edit clients')
                <a href="{{ route('admin.clients.edit', $client) }}" class="bv-btn bv-btn-primary">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Brand
                </a>
                @endcan
                <a href="{{ route('admin.clients.index') }}" class="bv-btn bv-btn-ghost">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    Back to Brands
                </a>
                @can('delete clients')
                <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Delete brand \'{{ addslashes($client->name) }}\'? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bv-btn bv-btn-danger">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                        Delete Brand
                    </button>
                </form>
                @endcan
            </div>
        </div>
    </div>

    {{-- Right details --}}
    <div>
        <div class="bv-card">
            <div class="bv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                Contact Information
            </div>
            <div class="bv-card-body">
                <div class="bv-detail-row">
                    <span class="bv-detail-label">Email</span>
                    <span class="bv-detail-value">{{ $client->email }}</span>
                </div>
                <div class="bv-detail-row">
                    <span class="bv-detail-label">Phone</span>
                    <span class="bv-detail-value">{{ $client->phone ?: '<span class="no-val">Not set</span>' }}</span>
                </div>
                <div class="bv-detail-row">
                    <span class="bv-detail-label">Contact Person</span>
                    <span class="bv-detail-value">{{ $client->contact_person ?: '<span class="no-val">Not set</span>' }}</span>
                </div>
            </div>
        </div>

        @if($client->company_name || $client->company_address)
        <div class="bv-card">
            <div class="bv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
                Company Information
            </div>
            <div class="bv-card-body">
                @if($client->company_name)
                <div class="bv-detail-row">
                    <span class="bv-detail-label">Company Name</span>
                    <span class="bv-detail-value">{{ $client->company_name }}</span>
                </div>
                @endif
                @if($client->company_address)
                <div class="bv-detail-row">
                    <span class="bv-detail-label">Address</span>
                    <span class="bv-detail-value" style="white-space:pre-line;">{{ $client->company_address }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif

        @if($client->bank_name || $client->bank_account_number || $client->bank_routing_number)
        <div class="bv-card">
            <div class="bv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                Bank Details
            </div>
            <div class="bv-card-body">
                @if($client->bank_name)
                <div class="bv-detail-row">
                    <span class="bv-detail-label">Bank Name</span>
                    <span class="bv-detail-value">{{ $client->bank_name }}</span>
                </div>
                @endif
                @if($client->bank_account_number)
                <div class="bv-detail-row">
                    <span class="bv-detail-label">Account No.</span>
                    <span class="bv-detail-value" style="font-family:monospace;">****{{ substr($client->bank_account_number, -4) }}</span>
                </div>
                @endif
                @if($client->bank_routing_number)
                <div class="bv-detail-row">
                    <span class="bv-detail-label">Routing No.</span>
                    <span class="bv-detail-value" style="font-family:monospace;">{{ $client->bank_routing_number }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif

        @if($client->notes)
        <div class="bv-card">
            <div class="bv-card-header">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Notes
            </div>
            <div class="bv-card-body">
                <p style="font-size:.82rem;color:#4b5563;line-height:1.6;margin:0;white-space:pre-line;">{{ $client->notes }}</p>
            </div>
        </div>
        @endif
    </div>

</div>
@endsection
