@extends('layouts.admin')

@section('title', isset($editSalarySheet) ? 'Edit Salary Sheet' : 'Create Salary Sheet')
@section('page-title', isset($editSalarySheet) ? 'Edit Salary Sheet' : 'Create Salary Sheet')

@section('breadcrumbs')
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('admin.salary-sheets.index') }}" class="breadcrumb-item">Salary Sheets</a>
    <span class="breadcrumb-separator">›</span>
    <span class="breadcrumb-item active">{{ isset($editSalarySheet) ? 'Edit' : 'Create' }}</span>
@endsection

@section('content')
<style>
/* ============================================================
   Salary Sheet — Compact Design System (sc-*)
   Primary: Indigo #4f46e5
   ============================================================ */

/* ── Info Strip ─────────────────────────────────────────────────────────── */
.sc-info-strip {
    display: grid;
    grid-template-columns: 160px 1fr 150px 210px;
    gap: .65rem;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px 10px 0 0;
    padding: .65rem .9rem;
    align-items: end;
}
@media(max-width:900px){ .sc-info-strip { grid-template-columns: 1fr 1fr; } }
.sc-info-item { display: flex; flex-direction: column; gap: .18rem; }
.sc-info-label {
    font-size: .68rem; font-weight: 700; color: #6b7280;
    text-transform: uppercase; letter-spacing: .05em;
}
.sc-info-input {
    padding: .38rem .6rem;
    border: 1px solid #d1d5db; border-radius: 6px;
    font-size: .82rem; color: #1f2937; background: #fff;
    outline: none; width: 100%;
    transition: border-color .15s, box-shadow .15s;
}
.sc-info-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.1); }
.sc-info-input[readonly] {
    background: #f9fafb; color: #374151;
    font-weight: 700; font-family: monospace; font-size: .8rem;
}

/* ── Compact Toolbar ─────────────────────────────────────────────────────── */
.sc-toolbar {
    display: flex; align-items: center; gap: .35rem; flex-wrap: wrap;
    background: #f8fafc; border: 1px solid #e5e7eb; border-top: none;
    border-radius: 0 0 10px 10px; padding: .45rem .75rem; margin-bottom: .6rem;
}
.sc-divider { width: 1px; height: 18px; background: #d1d5db; margin: 0 .1rem; flex-shrink: 0; }
.sc-spacer  { flex: 1; }

.sc-btn {
    display: inline-flex; align-items: center; gap: .28rem;
    padding: .28rem .65rem; border: 1px solid transparent;
    border-radius: 5px; font-size: .77rem; font-weight: 600;
    cursor: pointer; transition: all .12s; white-space: nowrap;
    text-decoration: none; line-height: 1.4;
}
.sc-btn:disabled { opacity: .45; cursor: not-allowed; pointer-events: none; }
.sc-btn svg { flex-shrink: 0; }

.sc-btn-green  { background: #d1fae5; color: #065f46; border-color: #6ee7b7; }
.sc-btn-green:hover  { background: #a7f3d0; border-color: #34d399; }
.sc-btn-indigo { background: #e0e7ff; color: #3730a3; border-color: #c7d2fe; }
.sc-btn-indigo:hover { background: #c7d2fe; border-color: #a5b4fc; }
.sc-btn-amber  { background: #fef3c7; color: #92400e; border-color: #fde68a; }
.sc-btn-amber:hover  { background: #fde68a; border-color: #fcd34d; }
.sc-btn-sky    { background: #e0f2fe; color: #075985; border-color: #bae6fd; }
.sc-btn-sky:hover    { background: #bae6fd; border-color: #7dd3fc; }
.sc-btn-gray   { background: #f3f4f6; color: #374151; border-color: #e5e7eb; }
.sc-btn-gray:hover   { background: #e5e7eb; border-color: #d1d5db; }
.sc-btn-solid  { background: #4f46e5; color: #fff; border-color: #4f46e5; }
.sc-btn-solid:hover  { background: #4338ca; border-color: #4338ca; }

/* ── Message Boxes ───────────────────────────────────────────────────────── */
.sc-msg-empty {
    text-align: center; padding: 2rem 1.5rem;
    background: #f8fafc; border: 2px dashed #cbd5e1;
    border-radius: 10px; margin: .4rem 0;
}
.sc-msg-empty h3 { color: #475569; font-size: .92rem; margin: 0 0 .2rem; }
.sc-msg-empty p  { color: #64748b; font-size: .8rem;  margin: 0; }

.sc-msg-warn {
    display: flex; align-items: center; gap: .65rem;
    padding: .6rem .9rem; background: #fffbeb;
    border: 1px solid #fcd34d; border-radius: 8px;
    margin: .4rem 0; font-size: .8rem; color: #92400e; font-weight: 500;
}

/* ── Scroll Nav ──────────────────────────────────────────────────────────── */
.sc-scroll-nav {
    display: flex; justify-content: space-between; align-items: center;
    padding: .3rem .7rem; background: #f1f5f9;
    border-bottom: 1px solid #e2e8f0; border-radius: 8px 8px 0 0;
}
.sc-scroll-btns { display: flex; gap: .3rem; }
.sc-scroll-btn {
    background: #4f46e5; color: #fff; border: none;
    padding: .28rem; border-radius: 4px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    width: 26px; height: 26px; transition: background .12s;
}
.sc-scroll-btn:hover { background: #4338ca; }
.sc-scroll-btn:disabled { background: #9ca3af; cursor: not-allowed; }
.sc-scroll-info { display: flex; align-items: center; gap: .4rem; font-size: .7rem; color: #64748b; }
.sc-scroll-progress { width: 120px; height: 3px; background: #e2e8f0; border-radius: 2px; overflow: hidden; }
.sc-scroll-progress-fill { height: 100%; background: #4f46e5; transition: width .2s; width: 0; }

/* ── Table Wrapper ───────────────────────────────────────────────────────── */
.table-scroll-container {
    overflow-x: auto; overflow-y: auto;
    border-radius: 0 0 8px 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    background: #fff; margin-top: 0;
    max-height: 66vh;
    scroll-behavior: smooth;
    touch-action: pan-x;
    -webkit-overflow-scrolling: touch;
}
.table-scroll-container::-webkit-scrollbar { height: 5px; width: 5px; }
.table-scroll-container::-webkit-scrollbar-track { background: #f1f5f9; }
.table-scroll-container::-webkit-scrollbar-thumb { background: #c7d2fe; border-radius: 3px; }
.table-scroll-container::-webkit-scrollbar-thumb:hover { background: #a5b4fc; }
.table-scroll-container::-webkit-scrollbar-corner { background: #f1f5f9; }
.table-scroll-container:not(.dragging) { cursor: grab; }
.table-scroll-container.dragging { cursor: grabbing !important; user-select: none; }
.table-scroll-container.dragging * { pointer-events: none; }
.table-scroll-container input,
.table-scroll-container select,
.table-scroll-container textarea,
.table-scroll-container button { pointer-events: auto !important; cursor: default !important; }
.table-scroll-container.dragging input,
.table-scroll-container.dragging select,
.table-scroll-container.dragging textarea,
.table-scroll-container.dragging button { pointer-events: auto !important; cursor: default !important; }

/* ── Salary Sheet Table ──────────────────────────────────────────────────── */
.salary-sheet-table {
    width: 100%; border-collapse: collapse;
    font-size: .78rem; background: #fff;
    border: 1px solid #e5e7eb;
}
.salary-sheet-table thead { position: sticky; top: 0; z-index: 10; }
.salary-sheet-table th {
    background: #312e81; color: #fff;
    padding: .55rem .7rem; text-align: center;
    font-weight: 600; font-size: .72rem;
    border: 1px solid #3730a3;
    position: sticky; top: 0;
    box-shadow: 0 2px 4px rgba(0,0,0,.12);
}
.salary-sheet-table .sub-header th {
    background: #4f46e5; padding: .38rem .55rem;
    font-size: .65rem; position: sticky; top: 33px; z-index: 9;
    box-shadow: 0 2px 4px rgba(0,0,0,.08);
}
.salary-sheet-table .sub-header th div { color: #fff; font-weight: 500; }
.salary-sheet-table td {
    padding: .4rem .5rem; border: 1px solid #e5e7eb;
    vertical-align: middle; background: #fff;
}
.salary-sheet-table tbody tr:nth-child(even) td { background: #f8fafc; }
.salary-sheet-table tbody tr:nth-child(even) td.calculated-cell { background: #ede9fe; }
.salary-sheet-table tbody tr:hover td { background: #eef2ff !important; }

/* ── Table Inputs ────────────────────────────────────────────────────────── */
.table-input {
    width: 100%; padding: .38rem .45rem;
    border: 1px solid #d1d5db; border-radius: 4px;
    font-size: .78rem; background: #fff; text-align: center;
    outline: none; transition: border-color .1s;
}
.table-input:focus { border-color: #6366f1; box-shadow: 0 0 0 2px rgba(99,102,241,.1); }
.table-input-small {
    width: 100%; padding: .26rem .35rem;
    border: 1px solid #d1d5db; border-radius: 4px;
    font-size: .72rem; background: #fff; text-align: center;
    outline: none; transition: border-color .1s;
}
.table-input-small:focus { border-color: #6366f1; box-shadow: 0 0 0 2px rgba(99,102,241,.08); }
.table-input-readonly { background: #f9fafb !important; font-weight: 600; color: #374151; }
.calculated-cell { background: #ede9fe !important; }
.table-input-small[placeholder="0/1"] {
    text-align: center; font-weight: 700;
    background: #fef9c3; border-color: #fcd34d; color: #78350f;
}
.table-input-small[name*="[attendance_amount]"] {
    text-align: right; font-weight: 600; font-family: monospace;
}
.table-input-small[name*="[amount]"][readonly] {
    text-align: right; font-weight: 600; font-family: monospace;
    background: #ede9fe; border-color: #a5b4fc;
}

/* ── Attendance Legend ───────────────────────────────────────────────────── */
.sc-legend {
    display: flex; align-items: center; gap: .9rem; flex-wrap: wrap;
    background: #eff6ff; border: 1px solid #bfdbfe;
    border-radius: 7px; padding: .38rem .7rem;
    margin: .3rem 0; font-size: .77rem; color: #1e40af;
}
.sc-legend-item { display: flex; align-items: center; gap: .3rem; }
.sc-legend-box {
    width: 17px; height: 17px; border-radius: 3px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: .7rem;
}

/* ── Summary Cards ───────────────────────────────────────────────────────── */
.sc-summary {
    display: grid; grid-template-columns: repeat(3,1fr);
    gap: .6rem; margin-top: .6rem;
}
@media(max-width:768px){ .sc-summary { grid-template-columns: 1fr; } }
.sc-summary-card {
    background: #fff; border: 1px solid #e5e7eb;
    border-radius: 8px; padding: .55rem .9rem;
    display: flex; justify-content: space-between; align-items: center;
}
.sc-summary-label { font-size: .73rem; font-weight: 600; color: #6b7280; }
.sc-summary-val   { font-size: .98rem; font-weight: 700; }
.sc-summary-blue  { border-left: 3px solid #3b82f6; }
.sc-summary-blue  .sc-summary-val { color: #2563eb; }
.sc-summary-red   { border-left: 3px solid #ef4444; }
.sc-summary-red   .sc-summary-val { color: #dc2626; }
.sc-summary-green { border-left: 3px solid #10b981; }
.sc-summary-green .sc-summary-val { color: #059669; }

/* ── Notes ───────────────────────────────────────────────────────────────── */
.sc-notes { margin-top: .6rem; }
.sc-notes-label {
    font-size: .68rem; font-weight: 700; color: #6b7280;
    text-transform: uppercase; letter-spacing: .05em;
    display: block; margin-bottom: .28rem;
}
.sc-notes-input {
    width: 100%; padding: .5rem .65rem;
    border: 1px solid #d1d5db; border-radius: 7px;
    font-size: .82rem; resize: vertical; outline: none;
    transition: border-color .15s; box-sizing: border-box;
}
.sc-notes-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.1); }

/* ── Modals ──────────────────────────────────────────────────────────────── */
.modal {
    position: fixed; z-index: 1000; left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,.5); backdrop-filter: blur(3px);
}
.modal-content {
    background: #fff; margin: 5% auto; padding: 0;
    border-radius: 10px; width: 80%; max-width: 800px;
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
    animation: modalSlideIn .22s ease-out;
}
@keyframes modalSlideIn {
    from { opacity: 0; transform: translateY(-24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.modal-header {
    padding: .9rem 1.1rem; border-bottom: 1px solid #e5e7eb;
    display: flex; justify-content: space-between; align-items: center;
    background: #f8fafc; border-radius: 10px 10px 0 0;
}
.modal-header h3 { margin: 0; color: #1f2937; font-size: .95rem; font-weight: 700; }
.close { color: #9ca3af; font-size: 1.4rem; font-weight: 700; cursor: pointer; line-height: 1; }
.close:hover { color: #374151; }
.modal-body {
    padding: 1.1rem; max-height: 70vh; overflow-y: auto;
}
.modal-footer {
    padding: .65rem 1.1rem; border-top: 1px solid #e5e7eb;
    display: flex; justify-content: flex-end; gap: .45rem;
    background: #f8fafc; border-radius: 0 0 10px 10px;
}

/* ── Generic Form Controls (used in modals) ──────────────────────────────── */
.form-control {
    width: 100%; padding: .42rem .58rem;
    border: 1px solid #d1d5db; border-radius: 6px;
    font-size: .82rem; background: #fff; outline: none;
}
.form-control:focus { border-color: #6366f1; box-shadow: 0 0 0 2px rgba(99,102,241,.1); }
.form-label  { font-weight: 600; color: #374151; margin-bottom: .3rem; display: block; font-size: .82rem; }
.form-text   { font-size: .7rem; color: #6b7280; margin-top: .18rem; }

/* ── Buttons ─────────────────────────────────────────────────────────────── */
.btn {
    display: inline-flex; align-items: center; gap: .32rem;
    padding: .42rem .85rem; border: 1px solid transparent;
    border-radius: 6px; font-size: .8rem; font-weight: 600;
    cursor: pointer; transition: all .13s; text-decoration: none;
}
.btn:disabled { opacity: .5; cursor: not-allowed; }
.btn-sm   { padding: .28rem .58rem; font-size: .73rem; }
.btn-primary   { background: #4f46e5; color: #fff; border-color: #4f46e5; }
.btn-primary:hover   { background: #4338ca; border-color: #4338ca; }
.btn-success   { background: #10b981; color: #fff; }
.btn-success:hover   { background: #059669; }
.btn-secondary { background: #6b7280; color: #fff; }
.btn-secondary:hover { background: #4b5563; }
.btn-danger    { background: #ef4444; color: #fff; }
.btn-danger:hover    { background: #dc2626; }
.btn-outline   { background: #fff; color: #6b7280; border: 1px solid #d1d5db; }
.btn-outline:hover   { background: #f9fafb; }

.btn-duplicate {
    background: #4f46e5; color: #fff;
    padding: .2rem .42rem; border: none; border-radius: 4px;
    cursor: pointer; display: inline-flex; align-items: center;
    justify-content: center; transition: background .12s;
}
.btn-duplicate:hover { background: #4338ca; }

/* ── Modal rule rows ──────────────────────────────────────────────────────── */
.salary-rule-row {
    display: grid; grid-template-columns: 2fr 2fr 1fr 1fr auto;
    gap: .7rem; align-items: center; padding: .7rem;
    margin-bottom: .6rem; background: #f8fafc;
    border: 1px solid #e5e7eb; border-radius: 7px;
}
.salary-rule-row select, .salary-rule-row input {
    padding: .4rem .55rem; border: 1px solid #d1d5db;
    border-radius: 5px; font-size: .8rem;
}
.existing-rule-row {
    display: grid; grid-template-columns: 2fr 1fr 1fr auto;
    gap: .7rem; align-items: center; padding: .7rem;
    margin-bottom: .6rem; background: #eff6ff;
    border: 1px solid #bfdbfe; border-radius: 7px;
}
.existing-rule-row .rule-info {
    padding: .4rem .55rem; background: #f8fafc;
    border: 1px solid #d1d5db; border-radius: 5px;
    font-size: .8rem; color: #374151;
}
.remove-rule-btn, .delete-rule-btn {
    background: #ef4444; color: #fff; border: none;
    border-radius: 5px; padding: .4rem;
    cursor: pointer; width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
}
.remove-rule-btn:hover, .delete-rule-btn:hover { background: #dc2626; }
.allowance-rule-row {
    display: flex; align-items: center; gap: .45rem;
    padding: .45rem .6rem; border: 1px solid #e5e7eb;
    border-radius: 6px; margin-bottom: .45rem; background: #fafafa;
}

/* ── Tab navigation (used in Job Settings modal) ─────────────────────────── */
.tab-navigation { display: flex; border-bottom: 2px solid #e5e7eb; margin-bottom: 1.1rem; }
.tab-btn {
    background: none; border: none; padding: .55rem 1.1rem;
    cursor: pointer; border-bottom: 3px solid transparent;
    color: #6b7280; font-weight: 600; font-size: .8rem;
    display: flex; align-items: center; gap: .35rem; transition: all .13s;
    margin-bottom: -2px;
}
.tab-btn:hover { color: #374151; background: #f9fafb; }
.tab-btn.active { color: #4f46e5; border-bottom-color: #4f46e5; background: #eef2ff; }
.tab-content { display: none; } .tab-content.active { display: block; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
.tab-content.active { animation: fadeIn .2s ease-out; }

/* ── Tooltip ──────────────────────────────────────────────────────────────── */
.promoter-tooltip { position: relative; cursor: help; }
.tooltip-container {
    position: absolute; bottom: calc(100% + 10px); left: 50%;
    transform: translateX(-50%); background: #1f2937; color: #fff;
    padding: 9px 13px; border-radius: 7px; font-size: .77rem;
    line-height: 1.4; opacity: 0; visibility: hidden;
    transition: all .2s; z-index: 1000;
    box-shadow: 0 4px 12px rgba(0,0,0,.2);
    min-width: 250px; max-width: 360px; white-space: normal;
}
.tooltip-container::after {
    content: ''; position: absolute; top: 100%; left: 50%;
    transform: translateX(-50%); border: 5px solid transparent;
    border-top-color: #1f2937;
}
.tooltip-container.show { opacity: 1; visibility: visible; }
.tooltip-header { font-weight: 700; font-size: .82rem; border-bottom: 1px solid #374151; padding-bottom: 4px; margin-bottom: 4px; }
.tooltip-row { display: flex; justify-content: space-between; gap: 8px; margin-bottom: 2px; }
.tooltip-label { color: #9ca3af; font-size: .72rem; min-width: 55px; }
.tooltip-value { color: #fff; font-size: .72rem; text-align: right; flex: 1; }
.tooltip-status { display: inline-block; padding: 1px 6px; border-radius: 10px; font-size: .68rem; font-weight: 600; }
.tooltip-status.active { background: #10b981; }
.tooltip-status.inactive { background: #6b7280; }
.tooltip-status.suspended { background: #f59e0b; }
@media(max-width:768px){
    .tooltip-container { left: 0; transform: none; }
    .tooltip-container::after { left: 16px; transform: none; }
}

/* ── Modal Preloader ──────────────────────────────────────────────────────── */
.modal-preloader {
    position: absolute; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(255,255,255,.95); display: flex;
    align-items: center; justify-content: center;
    z-index: 1000; border-radius: 10px;
}
.preloader-content { text-align: center; padding: 1.5rem; }
.preloader-spinner {
    width: 30px; height: 30px; border: 3px solid #e5e7eb;
    border-top-color: #4f46e5; border-radius: 50%;
    animation: spin 1s linear infinite; margin: 0 auto .6rem;
}
.preloader-text { color: #6b7280; font-size: .8rem; margin: 0; }

@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
@keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .5; } }

/* ── Full-Screen Mode ─────────────────────────────────────────────────────── */
body.sc-fullscreen .sidebar              { display: none !important; }
body.sc-fullscreen .main-content        { margin-left: 0 !important; }
body.sc-fullscreen .header              { display: none !important; }
body.sc-fullscreen .breadcrumb-container{ display: none !important; }
body.sc-fullscreen .content             { padding: 0 !important; }

/* ── Fullscreen: pin header bar to top ── */
body.sc-fullscreen #sc-header-bar {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 300;
    box-shadow: 0 2px 12px rgba(0,0,0,.14);
}

/* ── Fullscreen info strip: equal-width grid ── */
body.sc-fullscreen .sc-info-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: .55rem;
    padding: .35rem 1rem .32rem;
    border-radius: 0;
    border-left: none; border-right: none; border-top: none;
    border-bottom: 1px solid #e5e7eb;
    background: #fff;
}
body.sc-fullscreen .sc-info-label {
    font-size: .59rem;
    letter-spacing: .05em;
}
/* All inputs same height and font */
body.sc-fullscreen .sc-info-input {
    height: 29px;
    padding: 0 .5rem;
    font-size: .78rem;
    box-sizing: border-box;
}
body.sc-fullscreen .sc-info-input[readonly] {
    font-size: .74rem;
    letter-spacing: .02em;
}
/* no native selects in header — rule removed */

/* ── Fullscreen toolbar: tight & flush ── */
body.sc-fullscreen #sc-toolbar {
    border-radius: 0;
    border-left: none; border-right: none;
    padding: .22rem .9rem;
    margin-bottom: 0;
    background: #f8fafc;
}
body.sc-fullscreen #sc-toolbar .sc-btn {
    padding: .2rem .55rem;
    font-size: .72rem;
}
body.sc-fullscreen #sc-toolbar .sc-divider { height: 14px; }

/* ── Push body below fixed header ── */
body.sc-fullscreen #sc-form-body {
    padding-top: 90px;
    padding-left: .75rem;
    padding-right: .75rem;
    padding-bottom: 68px; /* space for fixed summary bar */
}
body.sc-fullscreen .sc-summary {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 290;
    display: flex; gap: 0; margin-top: 0;
    background: #fff; border-top: 1px solid #e5e7eb;
    box-shadow: 0 -2px 12px rgba(0,0,0,.08);
}
body.sc-fullscreen .sc-summary-card {
    flex: 1; border-radius: 0; border: none; border-right: 1px solid #e5e7eb;
    padding: .38rem 1.2rem;
}
body.sc-fullscreen .sc-summary-card:last-child { border-right: none; }
body.sc-fullscreen .sc-summary-label { font-size: .68rem; }
body.sc-fullscreen .sc-summary-val   { font-size: .88rem; }

/* ── Hide the floating exit button — toolbar button handles it ── */
#sc-exit-fullscreen { display: none !important; }

/* ── Status Custom Dropdown ── */
.sc-status-wrapper { position: relative; }
.sc-status-btn {
    display: flex; align-items: center; justify-content: space-between; gap: .25rem;
    cursor: pointer; text-align: left; padding: 0 .6rem;
    width: 100%; box-sizing: border-box; height: 34px;
    border: 1px solid #d1d5db; border-radius: 6px;
    background: #fff; font-size: .82rem; color: #1f2937; outline: none;
    transition: border-color .15s, box-shadow .15s;
}
.sc-status-btn:hover, .sc-status-btn:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.1); }
.sc-status-dropdown {
    position: absolute; top: 100%; left: 0; right: 0; z-index: 9100;
    background: #fff; border: 1px solid #d1d5db; border-top: none;
    border-radius: 0 0 8px 8px; box-shadow: 0 8px 24px rgba(0,0,0,.12);
    overflow: hidden; display: none;
}
.sc-status-option {
    padding: .42rem .75rem; cursor: pointer; font-size: .8rem;
    color: #1e293b; transition: background .1s;
}
.sc-status-option:hover, .sc-status-option.sc-status-active { background: #eff6ff; color: #4f46e5; }
body.sc-fullscreen .sc-status-btn { height: 29px; font-size: .78rem; padding: 0 .5rem; }

/* ── Job AJAX Search ── */
.sc-job-wrapper { position: relative; }
.sc-job-suggestions {
    position: absolute; top: 100%; left: 0; right: 0; z-index: 9000;
    background: #fff; border: 1px solid #d1d5db; border-top: none;
    border-radius: 0 0 8px 8px; box-shadow: 0 8px 24px rgba(0,0,0,.12);
    max-height: 280px; overflow-y: auto; display: none;
}
.sc-job-item {
    padding: .5rem .75rem; cursor: pointer;
    border-bottom: 1px solid #f3f4f6; transition: background .1s;
}
.sc-job-item:last-child { border-bottom: none; }
.sc-job-item:hover, .sc-job-item.sc-job-active { background: #eff6ff; }
.sc-job-item-num  { font-size: .8rem; font-weight: 700; color: #1e293b; font-family: monospace; }
.sc-job-item-name { font-size: .74rem; color: #475569; margin-top: .05rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.sc-job-item-meta { font-size: .68rem; color: #94a3b8; margin-top: .05rem; }
.sc-job-item-empty { padding: .6rem .75rem; font-size: .8rem; color: #94a3b8; text-align: center; }

/* ── Existing Sheets Picker ── */
#sc-sheets-picker { background:#fff; border:1px solid #e2e8f0; border-radius:12px; overflow:hidden; margin-bottom:.75rem; box-shadow:0 1px 6px rgba(0,0,0,.06); }
.sc-picker-header { display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:.9rem 1.1rem; background:linear-gradient(135deg,#f8faff 0%,#eef3ff 100%); border-bottom:1px solid #dde5f7; flex-wrap:wrap; }
.sc-picker-header-left { display:flex; align-items:center; gap:.65rem; }
.sc-picker-header-icon { width:34px; height:34px; border-radius:8px; background:#4f46e5; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.sc-picker-title { font-size:.88rem; font-weight:700; color:#1e293b; margin:0 0 .12rem; }
.sc-picker-sub { font-size:.72rem; color:#64748b; margin:0; }
.sc-picker-list { padding:.65rem .75rem; display:flex; flex-direction:column; gap:.5rem; }
.sc-picker-card {
    display:flex; align-items:center; gap:.85rem;
    background:#fff; border:1px solid #e5e7eb; border-radius:9px;
    padding:.65rem .9rem; border-left-width:4px;
    transition:box-shadow .15s, border-color .15s;
    box-shadow:0 1px 3px rgba(0,0,0,.04);
}
.sc-picker-card:hover { box-shadow:0 3px 10px rgba(0,0,0,.1); border-color:#c7d2fe; }
.sc-picker-icon { width:32px; height:32px; border-radius:7px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.sc-picker-meta { flex:1; min-width:0; }
.sc-picker-sheet-no { font-family:monospace; font-size:.84rem; font-weight:700; color:#1e293b; letter-spacing:.02em; }
.sc-picker-info { font-size:.71rem; color:#94a3b8; margin-top:.18rem; display:flex; align-items:center; gap:.4rem; flex-wrap:wrap; }
.sc-picker-info-sep { opacity:.4; }
.sc-picker-badge { display:inline-flex; align-items:center; padding:.1rem .45rem; border-radius:20px; font-size:.64rem; font-weight:700; text-transform:capitalize; letter-spacing:.03em; }
.sc-picker-actions { display:flex; gap:.3rem; flex-shrink:0; }
.sc-picker-action-btn { display:inline-flex; align-items:center; gap:.28rem; padding:.3rem .6rem; border-radius:6px; font-size:.74rem; font-weight:600; cursor:pointer; border:1px solid transparent; text-decoration:none; transition:all .15s; white-space:nowrap; }
.sc-picker-btn-view { background:#f8fafc; border-color:#e2e8f0; color:#475569; }
.sc-picker-btn-view:hover { background:#e2e8f0; color:#1e293b; }
.sc-picker-btn-load { background:#4f46e5; border-color:#4f46e5; color:#fff; }
.sc-picker-btn-load:hover { background:#4338ca; }
.sc-picker-btn-dup { background:#f0fdf4; border-color:#bbf7d0; color:#15803d; }
.sc-picker-btn-dup:hover { background:#dcfce7; }

/* Duplicate modal */
#sc-dup-modal { display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,.45); backdrop-filter:blur(3px); align-items:center; justify-content:center; }
#sc-dup-modal.open { display:flex; }
.sc-dup-box { background:#fff; border-radius:12px; width:100%; max-width:420px; box-shadow:0 20px 50px rgba(0,0,0,.2); overflow:hidden; }
.sc-dup-head { display:flex; align-items:center; justify-content:space-between; padding:.9rem 1.1rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; }
.sc-dup-head h3 { margin:0; font-size:.95rem; font-weight:700; color:#1f2937; display:flex; align-items:center; gap:.5rem; }
.sc-dup-close { width:26px; height:26px; border:none; background:#e5e7eb; border-radius:6px; cursor:pointer; font-size:1rem; color:#6b7280; display:flex; align-items:center; justify-content:center; }
.sc-dup-close:hover { background:#d1d5db; }
.sc-dup-body { padding:1.1rem; }
.sc-dup-label { font-size:.75rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.04em; margin-bottom:.35rem; display:block; }
.sc-dup-input { width:100%; padding:.5rem .75rem; border:1px solid #d1d5db; border-radius:7px; font-size:.9rem; font-family:monospace; color:#1f2937; outline:none; box-sizing:border-box; transition:border-color .15s,box-shadow .15s; }
.sc-dup-input:focus { border-color:#4f46e5; box-shadow:0 0 0 3px rgba(79,70,229,.1); }
.sc-dup-hint { font-size:.72rem; color:#9ca3af; margin-top:.35rem; }
.sc-dup-foot { display:flex; justify-content:flex-end; gap:.5rem; padding:.8rem 1.1rem; border-top:1px solid #f3f4f6; background:#fafafa; }
.sc-dup-btn { padding:.42rem .9rem; border-radius:6px; font-size:.82rem; font-weight:600; cursor:pointer; border:1px solid transparent; transition:all .15s; }
.sc-dup-btn-cancel { background:#f3f4f6; border-color:#e5e7eb; color:#374151; }
.sc-dup-btn-cancel:hover { background:#e5e7eb; }
.sc-dup-btn-confirm { background:#4f46e5; color:#fff; }
.sc-dup-btn-confirm:hover { background:#4338ca; }
.sc-dup-btn-confirm:disabled { background:#a5b4fc; cursor:not-allowed; }
</style>

@if(isset($editSalarySheet))
<form action="{{ route('admin.salary-sheets.update', $editSalarySheet) }}" method="POST" id="salarySheetForm">
    @csrf
    @method('PUT')
@else
<form action="{{ url('admin/salary-sheet-enforce') }}" method="post" id="salarySheetForm">
    {{ csrf_field() }}
@endif

{{-- ── Fixed header bar (info strip + toolbar) ── --}}
<div id="sc-header-bar">
<div class="sc-info-strip">
    <div class="sc-info-item">
        <span class="sc-info-label">Sheet No.</span>
        <input type="text" class="sc-info-input" id="sheet_number" name="sheet_number" readonly
               placeholder="Auto-generated"
               value="{{ isset($editSalarySheet) ? ($editSalarySheet->sheet_no ?? '') : '' }}">
    </div>
    <div class="sc-info-item sc-job-wrapper">
        <span class="sc-info-label">Job <span style="color:#ef4444;">*</span></span>
        {{-- Hidden: holds the actual job_id for form submission and JS reads --}}
        <input type="hidden" id="job_id" name="job_id"
               value="{{ isset($editSalarySheet) ? $editSalarySheet->job_id : '' }}"
               data-start-date="{{ isset($editSalarySheet) && $editSalarySheet->job ? $editSalarySheet->job->start_date : '' }}"
               data-end-date="{{ isset($editSalarySheet) && $editSalarySheet->job ? $editSalarySheet->job->end_date : '' }}"
               data-reporter-id="{{ isset($editSalarySheet) && $editSalarySheet->job && $editSalarySheet->job->reporter ? $editSalarySheet->job->reporter->id : '' }}"
               data-reporter-name="{{ isset($editSalarySheet) && $editSalarySheet->job && $editSalarySheet->job->reporter ? $editSalarySheet->job->reporter->name : '' }}">
        {{-- Visible: AJAX search text field --}}
        <input type="text" class="sc-info-input" id="job_search_input"
               autocomplete="off"
               placeholder="Search job number or name…"
               value="{{ isset($editSalarySheet) && $editSalarySheet->job ? $editSalarySheet->job->job_number . ' — ' . $editSalarySheet->job->job_name : '' }}"
               oninput="handleJobSearchInput(this)"
               onfocus="handleJobSearchFocus(this)"
               onkeydown="handleJobSearchKeydown(event)">
        <div id="job-suggestions" class="sc-job-suggestions"></div>
    </div>
    <div class="sc-info-item sc-status-wrapper">
        <span class="sc-info-label">Status</span>
        <input type="hidden" name="status" id="status_hidden"
               value="{{ isset($editSalarySheet) ? $editSalarySheet->status : 'draft' }}">
        <button type="button" class="sc-status-btn" id="status_btn"
                onclick="toggleStatusDropdown(event)"
                onkeydown="if(event.key==='Escape')closeStatusDropdown()">
            <span id="status_label">
                @php
                    $statusLabels = ['draft'=>'Draft','complete'=>'Complete','reject'=>'Reject','approve'=>'Approve','paid'=>'Paid'];
                    $currentStatus = isset($editSalarySheet) ? $editSalarySheet->status : 'draft';
                    echo $statusLabels[$currentStatus] ?? 'Draft';
                @endphp
            </span>
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0;opacity:.6"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div id="status-dropdown" class="sc-status-dropdown">
            <div class="sc-status-option {{ $currentStatus==='draft'    ? 'sc-status-active':'' }}" data-value="draft"    onclick="selectStatusOption('draft','Draft')">Draft</div>
            <div class="sc-status-option {{ $currentStatus==='complete' ? 'sc-status-active':'' }}" data-value="complete" onclick="selectStatusOption('complete','Complete')">Complete</div>
            <div class="sc-status-option {{ $currentStatus==='reject'   ? 'sc-status-active':'' }}" data-value="reject"   onclick="selectStatusOption('reject','Reject')">Reject</div>
            <div class="sc-status-option {{ $currentStatus==='approve'  ? 'sc-status-active':'' }}" data-value="approve"  onclick="selectStatusOption('approve','Approve')">Approve</div>
            <div class="sc-status-option {{ $currentStatus==='paid'     ? 'sc-status-active':'' }}" data-value="paid"     onclick="selectStatusOption('paid','Paid')">Paid</div>
        </div>
    </div>
    <div class="sc-info-item">
        <span class="sc-info-label">Location</span>
        <input type="text" class="sc-info-input" name="location" placeholder="Enter location"
               value="{{ isset($editSalarySheet) ? ($editSalarySheet->location ?? '') : '' }}">
    </div>
    <div class="sc-info-item">
        <span class="sc-info-label">Start Date</span>
        <input type="date" class="sc-info-input" id="sheet_start_date" name="start_date"
               value="{{ isset($editSalarySheet) ? ($editSalarySheet->start_date?->format('Y-m-d') ?? '') : '' }}"
               onchange="scApplyPeriodDates()">
    </div>
    <div class="sc-info-item">
        <span class="sc-info-label">End Date</span>
        <input type="date" class="sc-info-input" id="sheet_end_date" name="end_date"
               value="{{ isset($editSalarySheet) ? ($editSalarySheet->end_date?->format('Y-m-d') ?? '') : '' }}"
               onchange="scApplyPeriodDates()">
    </div>
</div>

{{-- ── Compact Action Toolbar ── --}}
<div class="sc-toolbar" id="sc-toolbar">
    {{-- Row management --}}
    <button type="button" id="addPromoterBtn" class="sc-btn sc-btn-green" onclick="addPromoterRow()" disabled>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Row
    </button>
    <button type="button" id="bulkAddRowsBtn" class="sc-btn sc-btn-green" onclick="openBulkAddModal()" disabled>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="4" rx="1"/><rect x="3" y="10" width="7" height="4" rx="1"/><rect x="3" y="17" width="7" height="4" rx="1"/><line x1="14" y1="5" x2="22" y2="5"/><line x1="14" y1="12" x2="22" y2="12"/><line x1="14" y1="19" x2="22" y2="19"/></svg>
        Bulk Add
    </button>

    <div class="sc-divider"></div>

    {{-- Configuration --}}
    <button type="button" id="salaryRuleBtn" class="sc-btn sc-btn-indigo" onclick="openSalaryRuleModal()" disabled>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="9" x2="15" y2="15"/><line x1="15" y1="9" x2="9" y2="15"/></svg>
        Salary Rules
    </button>
    <button type="button" id="allowanceRuleBtn" class="sc-btn sc-btn-amber" onclick="openAllowanceRuleModal()" disabled>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        Allowances
    </button>
    <button type="button" id="addCustomDateBtn" class="sc-btn sc-btn-sky" onclick="openAddCustomDateModal()" disabled>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="12" y1="14" x2="12" y2="18"/><line x1="10" y1="16" x2="14" y2="16"/></svg>
        + Date
    </button>
    <button type="button" class="sc-btn sc-btn-gray" onclick="openJobSettingsModal()">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v6m0 6v6m11-7h-6m-6 0H1"/></svg>
        Settings
    </button>

    <div class="sc-divider"></div>

    {{-- Utilities --}}
    <button type="button" class="sc-btn sc-btn-gray" onclick="pullExistingData()" id="pullDataBtn">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M3 21v-5h5"/></svg>
        Pull Data
    </button>
    <button type="button" class="sc-btn sc-btn-gray" onclick="scToggleFullscreen()" id="sc-fs-btn" title="Full Screen (F11)">
        <svg id="sc-fs-icon-enter" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
        <svg id="sc-fs-icon-exit"  width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;"><path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"/></svg>
        <span id="sc-fs-label">Full Screen</span>
    </button>

    <div class="sc-spacer"></div>

    {{-- Save / Update actions --}}
    @if(isset($editSalarySheet))
        <button type="button" class="sc-btn sc-btn-solid" onclick="saveSalarySheet()">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Update Sheet
        </button>
        <a href="{{ route('admin.salary-sheets.index') }}" class="sc-btn sc-btn-gray" style="text-decoration:none;">Cancel</a>
    @else
        <button type="button" class="sc-btn sc-btn-solid" onclick="saveSalarySheet()">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Save Sheet
        </button>
    @endif
</div>

{{-- close #sc-header-bar --}}
</div>
{{-- ── Form Body (scrolls under fixed header in fullscreen) ── --}}
<div id="sc-form-body">

{{-- ── No Job Selected Message ── --}}
<div id="noJobMessage" class="sc-msg-empty"{{ isset($editSalarySheet) ? ' style="display:none;"' : '' }}>
    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" style="margin:0 auto .6rem;display:block;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
    <h3>Select a Job to Begin</h3>
    <p>Choose a job from the dropdown above to start creating the salary sheet.</p>
</div>

{{-- ── Existing Sheets Picker ── --}}
<div id="sc-sheets-picker" style="display:none;">
    <div class="sc-picker-header">
        <div class="sc-picker-header-left">
            <div class="sc-picker-header-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </div>
            <div>
                <div class="sc-picker-title">Existing Salary Sheets</div>
                <p class="sc-picker-sub">This job already has salary sheets. Load one to continue editing, or create a new sheet.</p>
            </div>
        </div>
        <button type="button" class="sc-btn sc-btn-primary" onclick="scStartFresh()" style="white-space:nowrap;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Create New Sheet
        </button>
    </div>
    <div class="sc-picker-list" id="sc-picker-list"></div>
</div>

{{-- ── No End Date Warning ── --}}
<div id="noEndDateMessage" class="sc-msg-warn" style="display:none;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    This job has no end date. You may add custom attendance dates using the <strong>+ Date</strong> button.
</div>

{{-- ── Salary Sheet Table ── --}}
<div id="salaryTableContainer" style="{{ isset($editSalarySheet) ? 'display:block;' : 'display:none;' }}">
    {{-- Scroll Navigation --}}
    <div class="sc-scroll-nav">
        <div class="sc-scroll-btns">
            <button type="button" class="sc-scroll-btn" id="scrollToStartBtn" title="Jump to Start">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="11,17 6,12 11,7"/><polyline points="18,17 13,12 18,7"/></svg>
            </button>
            <button type="button" class="sc-scroll-btn" id="scrollLeftBtn" title="Scroll Left">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15,18 9,12 15,6"/></svg>
            </button>
            <button type="button" class="sc-scroll-btn" id="scrollRightBtn" title="Scroll Right">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9,18 15,12 9,6"/></svg>
            </button>
            <button type="button" class="sc-scroll-btn" id="scrollToEndBtn" title="Jump to End">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="13,17 18,12 13,7"/><polyline points="6,17 11,12 6,7"/></svg>
            </button>
        </div>
        <div class="sc-scroll-info">
            <span id="scrollPosition">0%</span>
            <div class="sc-scroll-progress"><div class="sc-scroll-progress-fill" id="scrollProgressBar"></div></div>
            <span id="scrollInfo">Drag or use buttons</span>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-scroll-container" id="tableScrollContainer">
        <table class="salary-sheet-table" id="salaryTable">
            <thead>
            <tr>
                <th style="width:48px;">#</th>
                <th style="width:130px;">Location</th>
                <th style="width:380px;">Promoter Details</th>
                <th style="width:340px;">Bank Details</th>
                <th style="width:700px;">Attendance</th>
                <th style="width:600px;">Payments</th>
                <th style="width:400px;">Coordinator</th>
                <th style="width:340px;">Coordinator Bank Details</th>
                <th style="width:64px;">Act.</th>
            </tr>
            <tr class="sub-header">
                <th></th>
                <th></th>
                <th>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;width:700px;">
                        <div style="text-align:center;font-size:.65rem;">Promoter ID</div>
                        <div style="text-align:center;font-size:.65rem;">Name</div>
                        <div style="text-align:center;font-size:.65rem;">Position</div>
                    </div>
                </th>
                <th>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;width:533px;">
                        <div style="text-align:center;font-size:.65rem;">Bank Name</div>
                        <div style="text-align:center;font-size:.65rem;">Branch</div>
                        <div style="text-align:center;font-size:.65rem;">Account No.</div>
                    </div>
                </th>
                <th id="attendanceColumn" style="display:none;">
                    <div id="attendanceHeaders" style="display:grid;grid-template-columns:repeat(6,1fr) 1fr 1.5fr;gap:.75rem;width:839px;">
                        <div style="text-align:center;font-size:.65rem;">Select Job First</div>
                        <div style="text-align:center;font-size:.65rem;">Select Job First</div>
                        <div style="text-align:center;font-size:.65rem;">Select Job First</div>
                        <div style="text-align:center;font-size:.65rem;">Select Job First</div>
                        <div style="text-align:center;font-size:.65rem;">Select Job First</div>
                        <div style="text-align:center;font-size:.65rem;">Select Job First</div>
                        <div style="text-align:center;font-size:.65rem;">Total</div>
                        <div style="text-align:center;font-size:.65rem;">Amount</div>
                    </div>
                </th>
                <th id="paymentColumn">
                    <div id="paymentHeaders" style="display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;width:533px;">
                        <div style="text-align:center;font-size:.65rem;">Amount</div>
                        <div style="text-align:center;font-size:.65rem;">Expenses</div>
                        <div style="text-align:center;font-size:.65rem;">Hold 8 wks</div>
                        <div style="text-align:center;font-size:.65rem;">Net Amount</div>
                    </div>
                </th>
                <th>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;width:500px;">
                        <div style="text-align:center;font-size:.65rem;">Coordinator ID</div>
                        <div style="text-align:center;font-size:.65rem;">Name</div>
                        <div style="text-align:center;font-size:.65rem;">Fee</div>
                    </div>
                </th>
                <th>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;width:533px;">
                        <div style="text-align:center;font-size:.65rem;">Bank Name</div>
                        <div style="text-align:center;font-size:.65rem;">Branch</div>
                        <div style="text-align:center;font-size:.65rem;">Account No.</div>
                    </div>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody id="promoterRows">
            </tbody>
        </table>
    </div>
</div>

{{-- ── Attendance Legend ── --}}
<div id="attendanceLegend" class="sc-legend" style="display:none;">
    <div class="sc-legend-item">
        <div class="sc-legend-box" style="background:#d1fae5;border:1px solid #059669;color:#059669;">1</div>
        <span>Present</span>
    </div>
    <div class="sc-legend-item">
        <div class="sc-legend-box" style="background:#fef3c7;border:1px solid #f59e0b;color:#d97706;">0</div>
        <span>Absent</span>
    </div>
    <span style="color:#94a3b8;font-size:.8rem;">·</span>
    <span>Only 0 or 1 in attendance cells</span>
    <span style="color:#94a3b8;font-size:.8rem;">·</span>
    <span style="color:#059669;font-weight:600;">Attendance Amount = Position Salary × Present Days</span>
</div>

{{-- ── Salary Summary ── --}}
<div class="sc-summary">
    <div class="sc-summary-card sc-summary-blue">
        <span class="sc-summary-label">Total Earnings</span>
        <span class="sc-summary-val" id="total-earnings">Rs. 0.00</span>
    </div>
    <div class="sc-summary-card sc-summary-red">
        <span class="sc-summary-label">Total Deductions</span>
        <span class="sc-summary-val" id="total-deductions">Rs. 0.00</span>
    </div>
    <div class="sc-summary-card sc-summary-green">
        <span class="sc-summary-label">Net Salary</span>
        <span class="sc-summary-val" id="net-salary">Rs. 0.00</span>
    </div>
</div>

{{-- ── Notes ── --}}
<div class="sc-notes">
    <label class="sc-notes-label">Notes</label>
    <textarea class="sc-notes-input" name="notes" rows="2" placeholder="Additional notes or comments...">{{ isset($editSalarySheet) ? ($editSalarySheet->notes ?? '') : '' }}</textarea>
</div>

</div>{{-- close #sc-form-body --}}
</form>

{{-- ── Duplicate Sheet Modal ── --}}
<div id="sc-dup-modal">
    <div class="sc-dup-box">
        <div class="sc-dup-head">
            <h3>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                Duplicate Salary Sheet
            </h3>
            <button class="sc-dup-close" onclick="closeDuplicateModal()">×</button>
        </div>
        <div class="sc-dup-body">
            <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:7px;padding:.6rem .85rem;font-size:.78rem;color:#166534;margin-bottom:.85rem;display:flex;align-items:center;gap:.5rem;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                Duplicating: <strong id="sc-dup-source-no" style="font-family:monospace;"></strong>
            </div>
            <label class="sc-dup-label">New Sheet Number <span style="color:#ef4444;">*</span></label>
            <input type="text" id="sc-dup-sheet-no" class="sc-dup-input"
                   placeholder="e.g. SAL/2026/06/005"
                   oninput="scDupClearError()">
            <div id="sc-dup-error" style="display:none;font-size:.72rem;color:#dc2626;margin-top:.35rem;"></div>
            <p class="sc-dup-hint">All promoter rows and data will be copied. Status will be set to <strong>Draft</strong>.</p>
        </div>
        <div class="sc-dup-foot">
            <button type="button" class="sc-dup-btn sc-dup-btn-cancel" onclick="closeDuplicateModal()">Cancel</button>
            <button type="button" class="sc-dup-btn sc-dup-btn-confirm" id="sc-dup-confirm-btn" onclick="confirmDuplicate()">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:middle;margin-right:.3rem;"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                Duplicate Sheet
            </button>
        </div>
    </div>
</div>

<script>
function scToggleFullscreen() {
    const isFS = document.body.classList.toggle('sc-fullscreen');
    document.getElementById('sc-fs-icon-enter').style.display = isFS ? 'none' : '';
    document.getElementById('sc-fs-icon-exit').style.display  = isFS ? ''     : 'none';
    document.getElementById('sc-fs-label').textContent        = isFS ? 'Exit Full Screen' : 'Full Screen';
    try { sessionStorage.setItem('sc_fullscreen', isFS ? '1' : '0'); } catch(e) {}
}
function scApplyFullscreenState() {
    try {
        if (sessionStorage.getItem('sc_fullscreen') === '1') {
            document.body.classList.add('sc-fullscreen');
            document.getElementById('sc-fs-icon-enter').style.display = 'none';
            document.getElementById('sc-fs-icon-exit').style.display  = '';
            document.getElementById('sc-fs-label').textContent        = 'Exit Full Screen';
        }
    } catch(e) {}
}
scApplyFullscreenState();

// Build attendance columns from the sheet's own Start Date / End Date fields
function scApplyPeriodDates() {
    const s = document.getElementById('sheet_start_date')?.value;
    const e = document.getElementById('sheet_end_date')?.value;
    if (!s || !e || e < s) return;
    const dates = generateDateRange(s, e);
    if (!dates.length) return;
    currentAttendanceDates = dates;
    updateAttendanceHeaders(dates);
    updateExistingRows(dates);
    const legend = document.getElementById('attendanceLegend');
    if (legend) legend.style.display = 'block';
}

// Allow Esc to exit fullscreen
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.body.classList.contains('sc-fullscreen')) {
        scToggleFullscreen();
    }
});

/* ── Duplicate Sheet ── */
let _scDupSheetId = null;

function openDuplicateModal(sheetId, sheetNo) {
    _scDupSheetId = sheetId;
    document.getElementById('sc-dup-source-no').textContent = sheetNo;
    document.getElementById('sc-dup-sheet-no').value = '';
    scDupClearError();
    document.getElementById('sc-dup-modal').classList.add('open');
    setTimeout(() => document.getElementById('sc-dup-sheet-no').focus(), 80);
}
function closeDuplicateModal() {
    document.getElementById('sc-dup-modal').classList.remove('open');
    _scDupSheetId = null;
}
function scDupClearError() {
    const err = document.getElementById('sc-dup-error');
    if (err) err.style.display = 'none';
}
function confirmDuplicate() {
    const sheetNo = document.getElementById('sc-dup-sheet-no').value.trim();
    const errEl   = document.getElementById('sc-dup-error');
    const btn     = document.getElementById('sc-dup-confirm-btn');
    if (!sheetNo) {
        errEl.textContent = 'Please enter a sheet number.';
        errEl.style.display = 'block';
        return;
    }
    if (!_scDupSheetId) return;
    btn.disabled = true;
    btn.textContent = 'Duplicating…';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    fetch(`/admin/salary-sheets/${_scDupSheetId}/duplicate`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
        body: JSON.stringify({ sheet_no: sheetNo })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            closeDuplicateModal();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Duplicated!',
                    text: `Sheet ${data.sheet_no} created successfully.`,
                    confirmButtonText: 'Open Sheet',
                    showCancelButton: true,
                    cancelButtonText: 'Stay Here',
                }).then(result => {
                    if (result.isConfirmed) window.location.href = `/admin/salary-sheets/${data.sheet_id}/edit`;
                });
            } else {
                alert(`Sheet ${data.sheet_no} duplicated successfully.`);
            }
        } else {
            errEl.textContent = data.message || 'Duplicate failed.';
            errEl.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:middle;margin-right:.3rem;"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>Duplicate Sheet';
        }
    })
    .catch(() => {
        errEl.textContent = 'Server error. Please try again.';
        errEl.style.display = 'block';
        btn.disabled = false;
        btn.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:middle;margin-right:.3rem;"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>Duplicate Sheet';
    });
}
// Close duplicate modal on backdrop click
document.addEventListener('click', function(e) {
    const modal = document.getElementById('sc-dup-modal');
    if (e.target === modal) closeDuplicateModal();
});

// ── Existing Sheets Picker ──
let _scPickerDates = [];

function scShowPicker(sheets, dates) {
    _scPickerDates = dates || [];
    const picker   = document.getElementById('sc-sheets-picker');
    const list     = document.getElementById('sc-picker-list');
    const tableEl  = document.getElementById('salaryTableContainer');
    const noJobMsg = document.getElementById('noJobMessage');
    if (!picker || !list) return;

    const statusStyles = {
        draft:    { bg:'#fef3c7', color:'#92400e', border:'#f59e0b', icon:'#fef3c7' },
        pending:  { bg:'#fef3c7', color:'#92400e', border:'#f59e0b', icon:'#fef3c7' },
        complete: { bg:'#d1fae5', color:'#065f46', border:'#10b981', icon:'#d1fae5' },
        approve:  { bg:'#ede9fe', color:'#5b21b6', border:'#8b5cf6', icon:'#ede9fe' },
        paid:     { bg:'#dbeafe', color:'#1e40af', border:'#3b82f6', icon:'#dbeafe' },
        reject:   { bg:'#fee2e2', color:'#991b1b', border:'#ef4444', icon:'#fee2e2' },
    };

    list.innerHTML = sheets.map((sheet, i) => {
        const ss   = statusStyles[sheet.status] || { bg:'#f3f4f6', color:'#374151', border:'#d1d5db', icon:'#f3f4f6' };
        const date = sheet.created_at ? new Date(sheet.created_at).toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'}) : '—';
        const rows = sheet.items_count != null ? sheet.items_count : (sheet.items ? sheet.items.length : 0);
        const idx  = i + 1;
        return `
        <div class="sc-picker-card" style="border-left-color:${ss.border};">
            <div class="sc-picker-icon" style="background:${ss.icon};">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="${ss.color}" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="sc-picker-meta">
                <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;">
                    <span class="sc-picker-sheet-no">${sheet.sheet_no}</span>
                    <span class="sc-picker-badge" style="background:${ss.bg};color:${ss.color};">${sheet.status}</span>
                </div>
                <div class="sc-picker-info">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    ${date}
                    <span class="sc-picker-info-sep">·</span>
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    ${rows} promoter${rows !== 1 ? 's' : ''}
                </div>
            </div>
            <div class="sc-picker-actions">
                <a href="/admin/salary-sheets/${sheet.id}" target="_blank" class="sc-picker-action-btn sc-picker-btn-view" title="View sheet">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    View
                </a>
                <button type="button" class="sc-picker-action-btn sc-picker-btn-dup" onclick="openDuplicateModal(${sheet.id}, '${sheet.sheet_no}')" title="Duplicate this sheet">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    Duplicate
                </button>
                <button type="button" class="sc-picker-action-btn sc-picker-btn-load" onclick="scLoadSheet(${sheet.id})" title="Load this sheet to edit">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="7 16 12 21 17 16"/><line x1="12" y1="21" x2="12" y2="3"/></svg>
                    Load
                </button>
            </div>
        </div>`;
    }).join('');

    if (noJobMsg) noJobMsg.style.display = 'none';
    if (tableEl)  tableEl.style.display  = 'none';
    picker.style.display = 'block';
}

function scHidePicker() {
    const picker = document.getElementById('sc-sheets-picker');
    if (picker) picker.style.display = 'none';
}

function scStartFresh() {
    scHidePicker();
    const tableEl = document.getElementById('salaryTableContainer');
    const legend  = document.getElementById('attendanceLegend');
    const sheetInput = document.getElementById('sheet_number');
    if (sheetInput) sheetInput.value = '';
    selectStatusOption('draft', 'Draft');
    updateAttendanceHeaders(_scPickerDates);
    updateExistingRows(_scPickerDates);
    currentAttendanceDates = _scPickerDates;
    clearAllRows();
    addPromoterRow();
    calculateGrandTotal();
    if (tableEl) tableEl.style.display = 'block';
    if (legend)  legend.style.display  = _scPickerDates.length > 0 ? 'block' : 'none';
    initializeAfterDatesUpdate();
}

function scLoadSheet(sheetId) {
    scHidePicker();
    const tableEl = document.getElementById('salaryTableContainer');
    const legend  = document.getElementById('attendanceLegend');
    fetch(`/admin/salary-sheets/${sheetId}/json`)
        .then(r => r.json())
        .then(jsonData => {
            if (jsonData.sheet_number) document.getElementById('sheet_number').value = jsonData.sheet_number;
            if (jsonData.status) {
                const labels = {draft:'Draft',complete:'Complete',reject:'Reject',approve:'Approve',paid:'Paid'};
                selectStatusOption(jsonData.status, labels[jsonData.status] || jsonData.status);
            }

            // Build attendance date set from: sheet date range + saved attendance keys + _scPickerDates
            const loadedDates = new Set(_scPickerDates);
            if (jsonData.start_date && jsonData.end_date && jsonData.end_date >= jsonData.start_date) {
                generateDateRange(jsonData.start_date, jsonData.end_date).forEach(d => loadedDates.add(d));
            }
            if (jsonData.rows) {
                Object.values(jsonData.rows).forEach(function(row) {
                    if (row.attendance && typeof row.attendance === 'object') {
                        Object.keys(row.attendance).forEach(function(d) {
                            if (/^\d{4}-\d{2}-\d{2}$/.test(d)) loadedDates.add(d);
                        });
                    }
                });
            }
            currentAttendanceDates = Array.from(loadedDates).sort();
            updateAttendanceHeaders(currentAttendanceDates);
            updateExistingRows(currentAttendanceDates);

            // Auto-fill start/end date inputs when blank
            const startInput = document.getElementById('sheet_start_date');
            const endInput   = document.getElementById('sheet_end_date');
            if (jsonData.start_date && startInput && !startInput.value) startInput.value = jsonData.start_date;
            if (jsonData.end_date   && endInput   && !endInput.value)   endInput.value   = jsonData.end_date;
            if (!jsonData.start_date && currentAttendanceDates.length > 0) {
                if (startInput && !startInput.value) startInput.value = currentAttendanceDates[0];
                if (endInput   && !endInput.value)   endInput.value   = currentAttendanceDates[currentAttendanceDates.length - 1];
            }

            if (jsonData.rows && Object.keys(jsonData.rows).length > 0) {
                clearAllRows();
                let idx = 0;
                for (const [, rowData] of Object.entries(jsonData.rows)) {
                    if (rowData.promoter_id) { addPromoterRowFromJson(rowData, idx); idx++; }
                }
                setTimeout(() => {
                    document.querySelectorAll('#promoterRows tr').forEach((row, i) => {
                        const n = i + 1;
                        // Only overwrite attendance_total from date checkboxes when date columns exist.
                        // When there are no date columns the total was manually entered and already
                        // loaded from the JSON — overwriting it with 0 would lose the saved value.
                        if (currentAttendanceDates && currentAttendanceDates.length > 0) {
                            const tot = Array.from(row.querySelectorAll('input[name*="[attendance]["]'))
                                .reduce((s, inp) => s + (parseFloat(inp.value) || 0), 0);
                            const ti = row.querySelector(`input[name="rows[${n}][attendance_total]"]`);
                            if (ti) ti.value = tot;
                        }
                        calculateRowNet(n);
                    });
                    calculateGrandTotal();
                }, 300);
            } else {
                clearAllRows(); addPromoterRow(); calculateGrandTotal();
            }
            if (tableEl) tableEl.style.display = 'block';
            if (legend)  legend.style.display  = _scPickerDates.length > 0 ? 'block' : 'none';
            initializeAfterDatesUpdate();
            isUpdatingAttendanceDates = false;
        })
        .catch(() => {
            clearAllRows(); addPromoterRow(); calculateGrandTotal();
            if (tableEl) tableEl.style.display = 'block';
            initializeAfterDatesUpdate();
            isUpdatingAttendanceDates = false;
        });
}

// ── Job AJAX Search ──────────────────────────────────────────────────────────
let _jobSearchTimer  = null;
let _jobActiveIndex  = -1;

function handleJobSearchInput(el) {
    clearTimeout(_jobSearchTimer);
    if (!el.value.trim()) {
        // user cleared the field — clear hidden value and session
        const hidden = document.getElementById('job_id');
        if (hidden) {
            hidden.value = '';
            hidden.setAttribute('data-start-date','');
            hidden.setAttribute('data-end-date','');
            hidden.setAttribute('data-reporter-id','');
            hidden.setAttribute('data-reporter-name','');
        }
        try { ['sc_job_id','sc_job_number','sc_job_name','sc_job_start','sc_job_end','sc_job_reporter_id','sc_job_reporter_name'].forEach(k => sessionStorage.removeItem(k)); } catch(e) {}
        if (typeof updateReporterFieldVisibility === 'function') updateReporterFieldVisibility();
    }
    _jobSearchTimer = setTimeout(() => searchJobs(el.value.trim()), 220);
}

function handleJobSearchFocus(el) {
    searchJobs(el.value.trim());
}

function handleJobSearchKeydown(e) {
    const box   = document.getElementById('job-suggestions');
    const items = box ? box.querySelectorAll('.sc-job-item') : [];
    if (!items.length) return;
    if (e.key === 'ArrowDown') {
        e.preventDefault();
        _jobActiveIndex = Math.min(_jobActiveIndex + 1, items.length - 1);
        items.forEach((i, n) => i.classList.toggle('sc-job-active', n === _jobActiveIndex));
    } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        _jobActiveIndex = Math.max(_jobActiveIndex - 1, 0);
        items.forEach((i, n) => i.classList.toggle('sc-job-active', n === _jobActiveIndex));
    } else if (e.key === 'Enter') {
        e.preventDefault();
        if (_jobActiveIndex >= 0 && items[_jobActiveIndex]) items[_jobActiveIndex].click();
    } else if (e.key === 'Escape') {
        closeJobSuggestions();
    }
}

function searchJobs(q) {
    const box = document.getElementById('job-suggestions');
    if (!box) return;
    const params = new URLSearchParams({ q, limit: 20 });
    fetch(`/admin/jobs/ajax/search?${params}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        const items = data.data || [];
        _jobActiveIndex = -1;
        if (!items.length) {
            box.innerHTML = '<div class="sc-job-item-empty">No jobs found</div>';
            box.style.display = 'block';
            return;
        }
        box.innerHTML = items.map(j => `
            <div class="sc-job-item"
                 data-id="${j.id}"
                 data-number="${j.job_number}"
                 data-name="${(j.job_name||'').replace(/"/g,'&quot;')}"
                 data-start="${j.start_date || ''}"
                 data-end="${j.end_date || ''}"
                 data-reporter-id="${j.reporter_id || ''}"
                 data-reporter-name="${(j.reporter_name||'').replace(/"/g,'&quot;')}"
                 onmousedown="selectJob(this)">
                <div class="sc-job-item-num">${j.job_number}</div>
                <div class="sc-job-item-name">${j.job_name || ''}</div>
                <div class="sc-job-item-meta">${j.client || ''}${j.client && j.start_date ? ' · ' : ''}${j.start_date || ''} → ${j.end_date || 'No end date'}</div>
            </div>
        `).join('');
        box.style.display = 'block';
    })
    .catch(() => { box.style.display = 'none'; });
}

function selectJob(el) {
    const hidden  = document.getElementById('job_id');
    const textEl  = document.getElementById('job_search_input');
    hidden.value  = el.dataset.id;
    hidden.setAttribute('data-start-date', el.dataset.start || '');
    hidden.setAttribute('data-end-date',   el.dataset.end   || '');
    hidden.setAttribute('data-reporter-id',   el.dataset.reporterId   || '');
    hidden.setAttribute('data-reporter-name', el.dataset.reporterName || '');
    textEl.value  = el.dataset.number + ' — ' + el.dataset.name;
    try {
        sessionStorage.setItem('sc_job_id',     el.dataset.id);
        sessionStorage.setItem('sc_job_number', el.dataset.number);
        sessionStorage.setItem('sc_job_name',   el.dataset.name);
        sessionStorage.setItem('sc_job_start',  el.dataset.start || '');
        sessionStorage.setItem('sc_job_end',    el.dataset.end   || '');
        sessionStorage.setItem('sc_job_reporter_id',   el.dataset.reporterId   || '');
        sessionStorage.setItem('sc_job_reporter_name', el.dataset.reporterName || '');
    } catch(e) {}
    closeJobSuggestions();
    updateAttendanceDates();
    if (typeof updateReporterFieldVisibility === 'function') updateReporterFieldVisibility();
}

function scRestoreJob() {
    const hidden = document.getElementById('job_id');
    const textEl = document.getElementById('job_search_input');
    if (!hidden || hidden.value) return false; // edit mode already has a value
    try {
        const id = sessionStorage.getItem('sc_job_id');
        if (!id) return false;
        hidden.value = id;
        hidden.setAttribute('data-start-date', sessionStorage.getItem('sc_job_start') || '');
        hidden.setAttribute('data-end-date',   sessionStorage.getItem('sc_job_end')   || '');
        hidden.setAttribute('data-reporter-id',   sessionStorage.getItem('sc_job_reporter_id')   || '');
        hidden.setAttribute('data-reporter-name', sessionStorage.getItem('sc_job_reporter_name') || '');
        const num  = sessionStorage.getItem('sc_job_number') || '';
        const name = sessionStorage.getItem('sc_job_name')   || '';
        if (textEl) textEl.value = (num && name) ? num + ' — ' + name : num || name;
        return true; // fields restored — caller should trigger updateAttendanceDates()
    } catch(e) { return false; }
}
// scRestoreJob() is called from DOMContentLoaded below to avoid TDZ on let variables

function closeJobSuggestions() {
    const box = document.getElementById('job-suggestions');
    if (box) box.style.display = 'none';
    _jobActiveIndex = -1;
}

/* ── Status custom dropdown ── */
function toggleStatusDropdown(e) {
    e.stopPropagation();
    const dd = document.getElementById('status-dropdown');
    if (!dd) return;
    dd.style.display = dd.style.display === 'block' ? 'none' : 'block';
}
function selectStatusOption(value, label) {
    const hidden = document.getElementById('status_hidden');
    const lbl    = document.getElementById('status_label');
    const dd     = document.getElementById('status-dropdown');
    if (hidden) hidden.value = value;
    if (lbl)    lbl.textContent = label;
    if (dd)     dd.style.display = 'none';
    document.querySelectorAll('.sc-status-option').forEach(function(o) {
        o.classList.toggle('sc-status-active', o.dataset.value === value);
    });
}
function closeStatusDropdown() {
    const dd = document.getElementById('status-dropdown');
    if (dd) dd.style.display = 'none';
}

// Close both dropdowns when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.sc-job-wrapper'))    closeJobSuggestions();
    if (!e.target.closest('.sc-status-wrapper')) closeStatusDropdown();
});
</script>

<!-- Position Wise Salary Rule Modal -->
<div id="salaryRuleModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Position Wise Salary Rules</h3>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <button type="button" id="refreshModalBtn" class="btn btn-sm btn-outline" title="Refresh Rules">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23,4 23,10 17,10"></polyline>
                        <polyline points="1,20 1,14 7,14"></polyline>
                        <path d="M20.49,9A9,9,0,0,0,5.64,5.64L1,10m22,4L18.36,18.36A9,9,0,0,1,3.51,15"></path>
                    </svg>
                </button>
                <span class="close" id="modalCloseBtn">&times;</span>
            </div>
        </div>
        <div class="modal-body">
            <!-- Preloader Section -->
            <div id="modalPreloader" class="modal-preloader" style="display: none;">
                <div class="preloader-content">
                    <div class="preloader-spinner"></div>
                    <p class="preloader-text">Loading salary rules...</p>
                </div>
            </div>

            <!-- Main Content -->
            <div id="modalMainContent">
                <div style="margin-bottom: 1rem;">
                    <button type="button" id="addNewRuleBtn" class="btn btn-success">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add New Rule
                    </button>
                </div>

            <!-- Existing Rules Section -->
            <div id="existingRulesSection" style="margin-bottom: 2rem;">
                <h4 style="color: #374151; margin-bottom: 1rem; font-size: 1rem;">Existing Rules for Selected Job</h4>
                <div id="existingRulesContainer">
                    <!-- Existing rules will be loaded here -->
                </div>
            </div>

            <!-- New Rules Section -->
            <div id="newRulesSection">
                <h4 style="color: #374151; margin-bottom: 1rem; font-size: 1rem;">New Rules to Add</h4>
                <div id="salaryRulesContainer">
                    <!-- New salary rule rows will be added here dynamically -->
                </div>
            </div>

            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                <button type="button" id="saveRulesBtn" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17,21 17,13 7,13 7,21"></polyline>
                        <polyline points="7,3 7,8 15,8"></polyline>
                    </svg>
                    Save New Rules
                </button>
                <button type="button" id="cancelModalBtn" class="btn btn-secondary" style="margin-left: 0.5rem;">Cancel</button>
            </div>
            </div> <!-- End of modalMainContent -->
        </div>
    </div>
</div>

<!-- Allowance Rule Modal -->
<div id="allowanceRuleModal" class="modal" style="display: none;">
    <div class="modal-content" style="max-width: 800px; width: 90%;">
        <div class="modal-header">
            <h3>Allowance Rules</h3>
            <span class="close" id="allowanceRuleCloseBtn">&times;</span>
        </div>
        <div class="modal-body" style="padding: 1rem;">
            <div style="margin-bottom: 0.75rem;">
                <button type="button" id="addAllowanceRowBtn" class="btn btn-success" style="padding: 0.375rem 0.75rem; font-size: 0.8125rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Add Row
                </button>
            </div>

            <div id="allowanceRulesContainer">
                <!-- Dynamic allowance rows will be added here -->
            </div>

            <div style="margin-top: 1rem; display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button type="button" class="btn btn-secondary" onclick="closeAllowanceRuleModal()" style="padding: 0.375rem 0.75rem; font-size: 0.8125rem;">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveAllowanceRules()" style="padding: 0.375rem 0.75rem; font-size: 0.8125rem;">Save Allowance Rules</button>
            </div>
        </div>
    </div>
</div>

<!-- Job Settings Modal -->
<div id="jobSettingsModal" class="modal" style="display: none;">
    <div class="modal-content" style="max-width: 800px; width: 90%;">
        <div class="modal-header">
            <h3>Job Settings</h3>
            <span class="close" id="jobSettingsCloseBtn">&times;</span>
        </div>
        <div class="modal-body">
            <!-- Tab Navigation -->
            <div class="tab-navigation" style="display: flex; border-bottom: 2px solid #e5e7eb; margin-bottom: 1.5rem;">
                <button type="button" class="tab-btn active" onclick="switchTab('general')" id="generalTab">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M12 1v6m0 6v6m11-7h-6m-6 0H1"></path>
                    </svg>
                    General Settings
                </button>
                <button type="button" class="tab-btn" onclick="switchTab('allowances')" id="allowancesTab">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    Allowances
                </button>
                <button type="button" class="tab-btn" onclick="switchTab('location')" id="locationTab">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Location
                </button>
            </div>

            <!-- General Settings Tab -->
            <div id="generalTabContent" class="tab-content active">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <label class="form-label">Default Coordinator Fee (Rs.)</label>
                        <input type="number" step="0.01" class="form-control" id="defaultCoordinatorFee" placeholder="0.00">
                        <small class="form-text text-muted">Default fee for coordinators in this job</small>
                    </div>
                    <div>
                        <label class="form-label">Default Hold for 8 Weeks (Rs.)</label>
                        <input type="number" step="0.01" class="form-control" id="defaultHoldFor8Weeks" placeholder="0.00">
                        <small class="form-text text-muted">Default amount to hold for 8 weeks</small>
                    </div>
                </div>
                <div style="margin-top: 1.5rem;">
                    <label class="form-label">Job Description</label>
                    <textarea class="form-control" id="jobDescription" rows="4" placeholder="Enter detailed job description..."></textarea>
                    <small class="form-text text-muted">Detailed description of the job requirements and scope</small>
                </div>
            </div>

            <!-- Allowances Tab -->
            <div id="allowancesTabContent" class="tab-content">
                <div style="margin-top: 1.5rem;">
                    <label class="form-label">Default Expenses (Rs.)</label>
                    <input type="number" step="0.01" class="form-control" id="defaultExpenses" placeholder="0.00">
                    <small class="form-text text-muted">Default miscellaneous expenses allowance</small>
                </div>
            </div>

            <!-- Location Tab -->
            <div id="locationTabContent" class="tab-content">
                <div>
                    <label class="form-label">Default Location</label>
                    <input type="text" class="form-control" id="defaultLocation" placeholder="Enter default location...">
                    <small class="form-text text-muted">Default location for this job</small>
                </div>
                <div style="margin-top: 1.5rem;">
                    <label class="form-label">Additional Location Notes</label>
                    <textarea class="form-control" id="locationNotes" rows="3" placeholder="Additional location details or instructions..."></textarea>
                    <small class="form-text text-muted">Additional notes about location requirements</small>
                </div>
            </div>

            <!-- Modal Footer -->
            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <button type="button" id="applyToAllRowsBtn" class="btn btn-success">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                            <path d="M9 12l2 2 4-4"></path>
                            <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3"></path>
                            <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3"></path>
                        </svg>
                        Apply to All Rows
                    </button>
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    <button type="button" id="saveJobSettingsBtn" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17,21 17,13 7,13 7,21"></polyline>
                            <polyline points="7,3 7,8 15,8"></polyline>
                        </svg>
                        Save Settings
                    </button>
                    <button type="button" id="cancelJobSettingsBtn" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Add Rows Modal -->
<div id="bulkAddRowsModal" style="display:none; position:fixed; z-index:1050; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);">
    <div style="background:#fff; margin:10% auto; width:90%; max-width:400px; border-radius:0.5rem; box-shadow:0 20px 25px -5px rgba(0,0,0,0.15); animation:modalSlideIn 0.25s ease-out; overflow:hidden;">
        <!-- Header -->
        <div style="padding:1.25rem 1.5rem; border-bottom:1px solid #e5e7eb; background:#f8fafc; display:flex; justify-content:space-between; align-items:center;">
            <h3 style="margin:0; font-size:1.1rem; font-weight:600; color:#1f2937;">Bulk Add Promoter Rows</h3>
            <span onclick="closeBulkAddModal()" style="font-size:1.5rem; line-height:1; color:#6b7280; cursor:pointer; padding:0 0.25rem;" title="Close">&times;</span>
        </div>
        <!-- Body -->
        <div style="padding:1.5rem;">
            <label for="bulkRowCount" style="display:block; font-weight:600; margin-bottom:0.5rem; color:#374151; font-size:0.9rem;">Number of rows to add</label>
            <input type="number" id="bulkRowCount" min="1" max="100" value="5"
                style="width:100%; padding:0.625rem 0.75rem; border:1px solid #d1d5db; border-radius:0.375rem; font-size:1rem; color:#1f2937; background:#fff; outline:none; box-sizing:border-box;"
                placeholder="Enter count..."
                onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.15)';"
                onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
            <p style="margin:0.4rem 0 0; font-size:0.78rem; color:#6b7280;">Enter a number between 1 and 100.</p>
            <div id="bulkAddError" style="display:none; margin-top:0.5rem; color:#dc2626; font-size:0.82rem; font-weight:500;"></div>
        </div>
        <!-- Footer -->
        <div style="padding:1rem 1.5rem; border-top:1px solid #e5e7eb; background:#f8fafc; display:flex; justify-content:flex-end; gap:0.5rem;">
            <button type="button" onclick="closeBulkAddModal()"
                style="padding:0.5rem 1.25rem; border:1px solid #d1d5db; border-radius:0.375rem; background:#fff; color:#374151; font-size:0.875rem; font-weight:500; cursor:pointer; transition:background 0.15s;">
                Cancel
            </button>
            <button type="button" onclick="confirmBulkAdd()"
                style="padding:0.5rem 1.25rem; border:none; border-radius:0.375rem; background:#10b981; color:#fff; font-size:0.875rem; font-weight:600; cursor:pointer; transition:background 0.15s;">
                Add Rows
            </button>
        </div>
    </div>
</div>

<!-- Add Custom Date Modal -->
<div id="addCustomDateModal" class="modal" style="display: none;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h3>Add Custom Attendance Date</h3>
            <span class="close" id="closeAddCustomDateModal">&times;</span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="customDateInput">Select Date:</label>
                <input type="date" id="customDateInput" class="form-control" required>
            </div>
            <div id="customDateError" style="color: #dc3545; margin-top: 0.5rem; display: none;"></div>
        </div>
        <div class="modal-footer">
            <button type="button" id="addCustomDateBtnModal" class="btn btn-primary">Add Date</button>
            <button type="button" id="cancelAddCustomDateBtn" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</div>

<!-- JSON Import Modal -->
<div id="jsonImportModal" class="modal" style="display: none;">
    <div class="modal-content" style="max-width: 800px;">
        <div class="modal-header">
            <h3>Import JSON Data</h3>
            <span class="close" onclick="closeJsonImportModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div style="margin-bottom: 1rem;">
                <label for="jsonDataTextarea" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">
                    Paste JSON Data:
                </label>
                <textarea id="jsonDataTextarea" rows="15" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-family: monospace; font-size: 12px;" placeholder="Paste your JSON data here..."></textarea>
            </div>
            <div style="margin-bottom: 1rem;">
                <button type="button" class="btn btn-primary" onclick="importJsonData()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14,2 14,8 20,8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10,9 9,9 8,9"></polyline>
                    </svg>
                    Import Data
                </button>
                <button type="button" class="btn btn-secondary" onclick="closeJsonImportModal()" style="margin-left: 0.5rem;">
                    Cancel
                </button>
            </div>
            <div id="jsonImportStatus" style="padding: 0.75rem; border-radius: 4px; display: none;"></div>
        </div>
    </div>
</div>

<script>
const promoters = @json($promoters);
const coordinators = @json($coordinators);
const jobs = @json($jobs);
const allowances = @json($allowances ?? []);
const isEditMode = @json(isset($editSalarySheet));
const jobSalarySheetsData = @json($jobSalarySheets ?? []);
let rowCounter = 1;
let allowanceRuleCounter = 0;

// Function to update payment column headers based on job allowance rules
function updatePaymentHeaders(jobAllowances = []) {
    const paymentHeaders = document.getElementById('paymentHeaders');
    const paymentColumn = document.getElementById('paymentColumn');

    if (!paymentHeaders || !paymentColumn) return;

    // Base columns: Amount, Expenses, Hold For 8 weeks, Net Amount
    const baseColumns = 4;
    const allowanceColumns = jobAllowances.length;
    const totalColumns = baseColumns + allowanceColumns;

    // Update grid template columns
    const columnWidth = 533 + (allowanceColumns * 100); // Add 100px per allowance column
    paymentHeaders.style.gridTemplateColumns = `repeat(${totalColumns}, 1fr)`;
    paymentHeaders.style.width = `${columnWidth}px`;

    // Create header HTML
    let headerHTML = `
        <div style="text-align: center; font-size: 0.7rem;">Amount</div>
        <div style="text-align: center; font-size: 0.7rem;">Expenses</div>
        <div style="text-align: center; font-size: 0.7rem;">Hold For 8 weeks</div>
    `;

    // Add allowance headers
    jobAllowances.forEach(allowance => {
        headerHTML += `<div style="text-align: center; font-size: 0.7rem;">${allowance.allowance_name}</div>`;
    });

    // Add Net Amount header
    headerHTML += `<div style="text-align: center; font-size: 0.7rem;">Net Amount</div>`;

    paymentHeaders.innerHTML = headerHTML;

    console.log('Updated payment headers with allowances:', jobAllowances);
}

// Function to generate payment row HTML with allowance columns
function generatePaymentRowHTML(rowNumber, jobAllowances = [], defaultValues = {}) {
    const baseColumns = 4;
    const allowanceColumns = jobAllowances.length;
    const totalColumns = baseColumns + allowanceColumns;
    const columnWidth = 533 + (allowanceColumns * 100);

    let rowHTML = `
        <div style="display: grid; grid-template-columns: repeat(${totalColumns}, 1fr); gap: 0.75rem; width: ${columnWidth}px;">
            <input type="number" step="0.01" class="table-input-small" name="rows[${rowNumber}][amount]" title="Amount (Editable - can be different from Attendance Amount)" value="${defaultValues.amount || 0}" oninput="markAsCustom(this, 'amount'); calculateRowNet(${rowNumber})" ${defaultValues.amount ? 'data-custom-amount="true" data-loaded-from-db="true"' : ''}>
            <input type="number" step="0.01" class="table-input-small" name="rows[${rowNumber}][expenses]" title="Expenses (Editable)" onchange="markAsCustom(this, 'expenses'); calculateRowNet(${rowNumber})" placeholder="0.00" value="${defaultValues.expenses || 0}" ${defaultValues.expenses ? 'data-custom-expenses="true" data-loaded-from-db="true"' : ''}>
            <input type="number" step="0.01" class="table-input-small" name="rows[${rowNumber}][hold_for_8_weeks]" onchange="calculateRowNet(${rowNumber})" placeholder="0.00" value="${defaultValues.hold_for_8_weeks || 0}">
    `;

    // Add allowance input fields
    jobAllowances.forEach((allowance, index) => {
        const defaultValue = defaultValues[allowance.allowance_name] || allowance.price || 0;
        const multiplyByAttendance = allowance.multiply_by_attendance === true || allowance.multiply_by_attendance === 1 || allowance.multiply_by_attendance === '1';
        const hasDefaultValue = defaultValues[allowance.allowance_name] !== undefined && defaultValues[allowance.allowance_name] !== null;
        rowHTML += `
            <input type="number" step="0.01" class="table-input-small" name="rows[${rowNumber}][allowances][${allowance.allowance_name}]"
                   value="${defaultValue}" placeholder="0.00"
                   onchange="markAllowanceAsCustom(this, '${allowance.allowance_name}'); calculateRowNet(${rowNumber})"
                   data-allowance-name="${allowance.allowance_name}"
                   data-multiply-by-attendance="${multiplyByAttendance ? 'true' : 'false'}"
                   data-allowance-price="${allowance.price || 0}"
                   ${hasDefaultValue ? 'data-loaded-from-db="true"' : ''}
                   title="${allowance.allowance_name}${multiplyByAttendance ? ' (Auto: Attendance × Price)' : ''}">
        `;
    });

    // Add Net Amount field
    rowHTML += `
            <input type="number" step="0.01" class="table-input-small" name="rows[${rowNumber}][net_amount]" title="Net Amount (Auto-calculated, but editable)" value="${defaultValues.net_amount || 0}" oninput="calculateGrandTotal()">
        </div>
    `;

    return rowHTML;
}

// Function to get current job's allowance rules
function getCurrentJobAllowances() {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) return [];

    const selectedJob = jobs.find(job => job.id == selectedJobId);
    if (!selectedJob || !selectedJob.allowance) return [];

    return selectedJob.allowance || [];
}

// Function to update all existing payment rows with new allowance columns
function updateAllPaymentRows(jobAllowances = []) {
    const rows = document.querySelectorAll('#promoterRows tr');

    rows.forEach((row, index) => {
        const rowNumber = index + 1;
        const paymentCell = document.getElementById(`paymentCell-${rowNumber}`);

        if (paymentCell) {
            // Get current values from existing inputs
            const currentValues = {
                amount: paymentCell.querySelector('input[name*="[amount]"]')?.value || 0,
                expenses: paymentCell.querySelector('input[name*="[expenses]"]')?.value || 0,
                hold_for_8_weeks: paymentCell.querySelector('input[name*="[hold_for_8_weeks]"]')?.value || 0,
                net_amount: paymentCell.querySelector('input[name*="[net_amount]"]')?.value || 0
            };

            // Get current allowance values
            const allowanceInputs = paymentCell.querySelectorAll('input[name*="[allowances]"]');
            allowanceInputs.forEach(input => {
                const allowanceName = input.name.match(/\[allowances\]\[([^\]]+)\]/)?.[1];
                if (allowanceName) {
                    currentValues[allowanceName] = input.value || 0;
                }
            });

            // Generate new payment row HTML with allowance columns
            paymentCell.innerHTML = generatePaymentRowHTML(rowNumber, jobAllowances, currentValues);
        }
    });

    console.log('Updated all payment rows with allowance columns');
}

// Allowance Rule Modal Functions
function openAllowanceRuleModal() {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) {
        Swal.fire({
            icon: 'warning',
            title: 'Job Selection Required',
            text: 'Please select a job first before adding allowance rules.',
            confirmButtonText: 'OK'
        });
        return;
    }

    document.getElementById('allowanceRuleModal').style.display = 'block';
    document.body.style.overflow = 'hidden';

    // Load existing allowance rules for the selected job
    loadExistingAllowanceRules();
}

function closeAllowanceRuleModal() {
    document.getElementById('allowanceRuleModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    clearAllowanceRules();
}

function addAllowanceRow() {
    allowanceRuleCounter++;
    const container = document.getElementById('allowanceRulesContainer');

    console.log('Adding allowance row. Allowances available:', allowances);
    console.log('Allowances map result:', allowances.map(allowance =>
        `<option value="${allowance.name}">${allowance.name}</option>`
    ).join(''));

    const row = document.createElement('div');
    row.className = 'allowance-rule-row';
    row.id = `allowanceRuleRow-${allowanceRuleCounter}`;
    row.style.cssText = `
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        margin-bottom: 0.5rem;
        background: #f9fafb;
    `;

    row.innerHTML = `
        <div style="flex: 1;">
            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.75rem; font-weight: 600; color: #374151;">Allowance Type</label>
            <select class="form-control" id="allowanceType-${allowanceRuleCounter}" name="allowance_rules[${allowanceRuleCounter}][allowance_type]" onchange="handleAllowanceTypeChange(${allowanceRuleCounter})" required style="padding: 0.375rem; font-size: 0.8125rem;">
                <option value="select">Select from List</option>
                <option value="manual">Manual Type</option>
            </select>
        </div>
        <div style="flex: 1;" id="allowanceSelectContainer-${allowanceRuleCounter}">
            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.75rem; font-weight: 600; color: #374151;">Allowance Name</label>
            <select class="form-control" id="allowanceSelect-${allowanceRuleCounter}" name="allowance_rules[${allowanceRuleCounter}][allowance_name]" required style="padding: 0.375rem; font-size: 0.8125rem;">
                <option value="">Select Allowance</option>
                ${allowances.map(allowance =>
                    `<option value="${allowance.name}">${allowance.name}</option>`
                ).join('')}
            </select>
        </div>
        <div style="flex: 1; display: none;" id="allowanceManualContainer-${allowanceRuleCounter}">
            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.75rem; font-weight: 600; color: #374151;">Manual Allowance Name</label>
            <input type="text" class="form-control" id="allowanceManual-${allowanceRuleCounter}" name="allowance_rules[${allowanceRuleCounter}][allowance_name_manual]" placeholder="Enter allowance name" style="padding: 0.375rem; font-size: 0.8125rem;">
        </div>
        <div style="flex: 1;">
            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.75rem; font-weight: 600; color: #374151;">Price (Rs.)</label>
            <input type="number" step="0.01" class="form-control" name="allowance_rules[${allowanceRuleCounter}][price]" placeholder="0.00" required style="padding: 0.375rem; font-size: 0.8125rem;">
        </div>
        <div style="flex: 0 0 180px;">
            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.75rem; font-weight: 600; color: #374151;">Calculation Type</label>
            <div style="display: flex; align-items: center; gap: 0.375rem; padding: 0.375rem; background: #f9fafb; border-radius: 0.25rem; border: 1px solid #e5e7eb;">
                <input type="checkbox" id="attendanceMultiplier-${allowanceRuleCounter}" name="allowance_rules[${allowanceRuleCounter}][multiply_by_attendance]" value="1" style="width: 16px; height: 16px; cursor: pointer;">
                <label for="attendanceMultiplier-${allowanceRuleCounter}" style="margin: 0; font-size: 0.75rem; color: #374151; cursor: pointer;">
                    Attendance Count × Price
                </label>
            </div>
            <small style="color: #6b7280; font-size: 0.6875rem; margin-top: 0.125rem; display: block;">
                If checked, allowance = attendance days × price
            </small>
        </div>
        <div style="flex: 0 0 auto;">
            <button type="button" class="btn btn-danger" onclick="removeAllowanceRow(${allowanceRuleCounter})" style="margin-top: 1.25rem; padding: 0.375rem 0.5rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3,6 5,6 21,6"></polyline>
                    <path d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6M8,6V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </button>
        </div>
    `;

    container.appendChild(row);
}

function handleAllowanceTypeChange(rowId) {
    const typeSelect = document.getElementById(`allowanceType-${rowId}`);
    const selectContainer = document.getElementById(`allowanceSelectContainer-${rowId}`);
    const manualContainer = document.getElementById(`allowanceManualContainer-${rowId}`);
    const selectField = document.getElementById(`allowanceSelect-${rowId}`);
    const manualField = document.getElementById(`allowanceManual-${rowId}`);

    if (typeSelect.value === 'manual') {
        // Show manual input, hide dropdown
        selectContainer.style.display = 'none';
        manualContainer.style.display = 'block';
        selectField.removeAttribute('required');
        manualField.setAttribute('required', 'required');
        manualField.value = '';
    } else {
        // Show dropdown, hide manual input
        selectContainer.style.display = 'block';
        manualContainer.style.display = 'none';
        manualField.removeAttribute('required');
        selectField.setAttribute('required', 'required');
        manualField.value = '';
    }
}

function removeAllowanceRow(rowId) {
    const row = document.getElementById(`allowanceRuleRow-${rowId}`);
    if (row) {
        row.remove();
    }
}

function clearAllowanceRules() {
    const container = document.getElementById('allowanceRulesContainer');
    container.innerHTML = '';
    allowanceRuleCounter = 0;
}

function loadExistingAllowanceRules() {
    const selectedJobId = document.getElementById('job_id').value;
    const selectedJob = jobs.find(job => job.id == selectedJobId);

    clearAllowanceRules();

    if (selectedJob && selectedJob.allowance && Array.isArray(selectedJob.allowance)) {
        selectedJob.allowance.forEach(allowanceRule => {
            addAllowanceRow();
            const lastRow = document.querySelector('.allowance-rule-row:last-child');
            if (lastRow) {
                const allowanceName = allowanceRule.allowance_name || '';
                const priceInput = lastRow.querySelector('input[name*="[price]"]');
                const typeSelect = lastRow.querySelector('select[name*="[allowance_type]"]');

                // Extract row ID from the row element
                const rowIdMatch = lastRow.id.match(/allowanceRuleRow-(\d+)/);
                const rowId = rowIdMatch ? parseInt(rowIdMatch[1]) : null;

                if (!rowId) {
                    console.error('Could not extract row ID from allowance rule row');
                    return;
                }

                // Check if the allowance name exists in the allowances list
                const allowanceExists = allowances.some(allowance => allowance.name === allowanceName);

                if (allowanceExists) {
                    // Use dropdown
                    if (typeSelect) typeSelect.value = 'select';
                    handleAllowanceTypeChange(rowId);
                    const allowanceSelect = lastRow.querySelector('select[name*="[allowance_name]"]');
                    if (allowanceSelect) allowanceSelect.value = allowanceName;
                } else if (allowanceName) {
                    // Use manual input for non-empty allowance names
                    if (typeSelect) typeSelect.value = 'manual';
                    handleAllowanceTypeChange(rowId);
                    const allowanceManual = lastRow.querySelector('input[name*="[allowance_name_manual]"]');
                    if (allowanceManual) allowanceManual.value = allowanceName;
                }

                if (priceInput) priceInput.value = allowanceRule.price || '';

                // Handle attendance multiplier checkbox
                const attendanceMultiplier = lastRow.querySelector('input[type="checkbox"][name*="[multiply_by_attendance]"]');
                if (attendanceMultiplier) {
                    attendanceMultiplier.checked = allowanceRule.multiply_by_attendance === true || allowanceRule.multiply_by_attendance === 1 || allowanceRule.multiply_by_attendance === '1';
                }
            }
        });
    }
}

function saveAllowanceRules() {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) {
        Swal.fire({
            icon: 'warning',
            title: 'Job Selection Required',
            text: 'Please select a job first.',
            confirmButtonText: 'OK'
        });
        return;
    }

    const allowanceRules = [];
    const rows = document.querySelectorAll('.allowance-rule-row');

    rows.forEach(row => {
        const allowanceType = row.querySelector('select[name*="[allowance_type]"]')?.value;
        let allowanceName = '';

        // Get allowance name based on type
        if (allowanceType === 'manual') {
            allowanceName = row.querySelector('input[name*="[allowance_name_manual]"]')?.value?.trim();
        } else {
            allowanceName = row.querySelector('select[name*="[allowance_name]"]')?.value?.trim();
        }

        const price = row.querySelector('input[name*="[price]"]')?.value;
        const multiplyByAttendance = row.querySelector('input[type="checkbox"][name*="[multiply_by_attendance]"]')?.checked || false;

        if (allowanceName && price) {
            allowanceRules.push({
                allowance_name: allowanceName,
                price: parseFloat(price),
                multiply_by_attendance: multiplyByAttendance
            });
        }
    });

    // Show loading state
    const saveBtn = document.querySelector('#allowanceRuleModal .btn-primary');
    const originalText = saveBtn.innerHTML;
    saveBtn.disabled = true;
    saveBtn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
            <path d="M21 12a9 9 0 11-6.219-8.56"></path>
        </svg>
        Saving...
    `;

    // Send data to server
    fetch(`/admin/jobs/${selectedJobId}/update-allowance-rules`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ allowance: allowanceRules })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Allowance rules saved successfully!',
                confirmButtonText: 'OK'
            });
            closeAllowanceRuleModal();

            // Update the jobs array with the new data
            const jobIndex = jobs.findIndex(job => job.id == selectedJobId);
            if (jobIndex !== -1) {
                jobs[jobIndex].allowance = allowanceRules;
            }

            // Update payment headers with new allowance rules
            const jobAllowances = getCurrentJobAllowances();
            updatePaymentHeaders(jobAllowances);

            // Update all existing payment rows
            updateAllPaymentRows(jobAllowances);

            console.log('Allowance rules saved and UI updated successfully');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: ' + data.message,
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to save allowance rules. Please try again.',
            confirmButtonText: 'OK'
        });
    })
    .finally(() => {
        // Restore button state
        saveBtn.disabled = false;
        saveBtn.innerHTML = originalText;
    });
}

function addPromoterRow() {
    const jobSelect = document.getElementById('job_id');
    if (!jobSelect.value) {
        Swal.fire({
            icon: 'warning',
            title: 'Job Selection Required',
            text: 'Please select a job first before adding promoter rows.',
            confirmButtonText: 'OK'
        });
        return;
    }

    const tbody = document.getElementById('promoterRows');
    const row = document.createElement('tr');

    // Calculate the next row number based on existing rows
    const existingRows = tbody.querySelectorAll('tr');
    const nextRowNumber = existingRows.length + 1;

    // Generate attendance inputs based on current dates
    let attendanceInputs = '';
    const numDates = currentAttendanceDates ? currentAttendanceDates.length : 0;
    console.log('addPromoterRow - currentAttendanceDates:', currentAttendanceDates);
    console.log('addPromoterRow - currentAttendanceDates.length:', numDates);

    if (currentAttendanceDates && currentAttendanceDates.length > 0) {
        attendanceInputs = currentAttendanceDates.map(date =>
            `<input type="number" class="table-input-small" name="rows[${nextRowNumber}][attendance][${date}]" min="0" max="1" step="1" onchange="calculateRowTotal(${nextRowNumber})" placeholder="0/1">`
        ).join('');
    }
    // If no dates, don't add any attendance inputs (empty columns)

    const attendanceWidth = numDates * 80 + 160; // Base width for Total and Amount columns

    row.innerHTML = `
        <td style="text-align: center; font-weight: bold;">${nextRowNumber}</td>
        <td>
            <input type="text" class="table-input" name="rows[${nextRowNumber}][location]" placeholder="Location">
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; position: relative;">
                <div style="position: relative;">
                    <input type="text" class="table-input-small" name="rows[${nextRowNumber}][promoter_search]" placeholder="Search promoter by name/ID" oninput="handlePromoterSearchInput(${nextRowNumber}, this)" onfocus="showAllPromoters(${nextRowNumber}, this)" onblur="hidePromoterSuggestions(${nextRowNumber})">
                    <div id="promoterSuggestions-${nextRowNumber}" class="promoter-suggestions" style="display:none"></div>
                    <select class="table-input-small" name="rows[${nextRowNumber}][promoter_id]" onchange="updatePromoterDetails(${nextRowNumber}, this)" style="display:none">
                        <option value="">Select</option>
                    </select>
                </div>
                <input type="text" class="table-input-small table-input-readonly promoter-tooltip" name="rows[${nextRowNumber}][promoter_name]" readonly data-tooltip="">
                <div style="position: relative;">
                    <select class="table-input-small" name="rows[${nextRowNumber}][position_id]" id="positionSelect-${nextRowNumber}" onchange="updatePositionFromDropdown(${nextRowNumber}, this)">
                        <option value="">Select Position</option>
                    </select>
                    <input type="text" class="table-input-small" id="customPositionInput-${nextRowNumber}" name="rows[${nextRowNumber}][custom_position_name]" placeholder="Type custom position..." style="display:none;" oninput="updateCustomPosition(${nextRowNumber}, this)">
                </div>
                <input type="hidden" name="rows[${nextRowNumber}][position]" id="positionName-${nextRowNumber}">
            </div>
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${nextRowNumber}][bank_name]" readonly placeholder="Bank Name">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${nextRowNumber}][bank_branch]" readonly placeholder="Bank Branch">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${nextRowNumber}][bank_account_number]" readonly placeholder="Bank Number">
            </div>
        </td>
        <td id="attendanceCell-${nextRowNumber}" style="display: table-cell; width: ${attendanceWidth}px;">
            <div style="display: grid; grid-template-columns: repeat(${numDates}, 1fr) 1fr 1.5fr; gap: 0.75rem; width: ${attendanceWidth}px;">
                ${attendanceInputs}
                <input type="number" class="table-input-small" name="rows[${nextRowNumber}][attendance_total]" min="0" step="0.1" placeholder="0" oninput="onAttendanceTotalManualChange(${nextRowNumber}, this)">
                <input type="number" step="0.01" class="table-input-small" name="rows[${nextRowNumber}][attendance_amount]" title="Attendance Amount (Auto-calculated, but editable)" oninput="calculateNetAmount(${nextRowNumber})">
            </div>
        </td>
        <td id="paymentCell-${nextRowNumber}">
            ${generatePaymentRowHTML(nextRowNumber, getCurrentJobAllowances())}
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; position: relative;">
                <div style="position: relative;">
                    <input type="text" class="table-input-small" name="rows[${nextRowNumber}][coordinator_search]" placeholder="Search coordinator by name/ID" oninput="handleCoordinatorSearchInput(${nextRowNumber}, this)" onfocus="showAllCoordinators(${nextRowNumber}, this)" onblur="hideCoordinatorSuggestions(${nextRowNumber})">
                    <div id="coordinatorSuggestions-${nextRowNumber}" class="coordinator-suggestions" style="display:none"></div>
                    <select class="table-input-small" name="rows[${nextRowNumber}][coordinator_id]" onchange="updateCoordinatorDisplay(${nextRowNumber}, this)" style="display:none">
                        <option value="">Select</option>
                    </select>
                </div>
                <input type="text" class="table-input-small table-input-readonly" name="rows[${nextRowNumber}][current_coordinator]" readonly>
                <input type="number" step="0.01" class="table-input-small" name="rows[${nextRowNumber}][coordination_fee]" title="Coordination Fee (Auto-calculated, but editable)" oninput="markAsCustom(this, 'coordination_fee'); calculateRowNet(${nextRowNumber})" placeholder="0.00">
            </div>
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankName-${nextRowNumber}" name="rows[${nextRowNumber}][coordinator_bank_name]" readonly placeholder="Bank Name">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankBranch-${nextRowNumber}" name="rows[${nextRowNumber}][coordinator_bank_branch]" readonly placeholder="Bank Branch">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankAccount-${nextRowNumber}" name="rows[${nextRowNumber}][coordinator_bank_account]" readonly placeholder="Account No.">
            </div>
        </td>
        <td>
            <div style="display: flex; gap: 0.25rem; justify-content: center;">
                <button type="button" class="btn-duplicate" onclick="duplicateRow(${nextRowNumber})" title="Duplicate this promoter">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                </button>
                <button type="button" class="btn-danger" onclick="removeRow(${nextRowNumber})" title="Remove this row">×</button>
            </div>
        </td>
    `;

    tbody.appendChild(row);

    // Update the global rowCounter to match the actual number of rows
    rowCounter = nextRowNumber;

    // Update promoter dropdowns (duplicates now allowed)
    updatePromoterDropdowns();

    // Trigger initial calculations for the new row
    setTimeout(() => {
        console.log(`Triggering calculations for new row ${nextRowNumber}`);
        calculateRowTotal(nextRowNumber);
        // Don't call calculateAttendanceAmount here - it will be called when promoter is selected
        calculateRowNet(nextRowNumber);
        calculateGrandTotal();

        // Populate position dropdown for the new row
        populatePositionDropdown(nextRowNumber);
    }, 100);

    console.log(`Added promoter row ${nextRowNumber} successfully`);
}

function updatePromoterTooltip(inputElement, promoter) {
    const positionName = promoter.position ? promoter.position.position_name : 'No Position';
    const statusClass = promoter.status || 'inactive';
    const statusText = (promoter.status || 'inactive').charAt(0).toUpperCase() + (promoter.status || 'inactive').slice(1);

    const tooltipContent = `
        <div class="tooltip-content">
            <div class="tooltip-header">${promoter.promoter_name}</div>
            <div class="tooltip-row">
                <span class="tooltip-label">ID:</span>
                <span class="tooltip-value">${promoter.promoter_id}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Position:</span>
                <span class="tooltip-value">${positionName}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Phone:</span>
                <span class="tooltip-value">${promoter.phone_no || 'N/A'}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">ID Card:</span>
                <span class="tooltip-value">${promoter.identity_card_no || 'N/A'}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Bank:</span>
                <span class="tooltip-value">${promoter.bank_name || 'N/A'}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Account:</span>
                <span class="tooltip-value">${promoter.bank_account_number ? '****' + promoter.bank_account_number.slice(-4) : 'N/A'}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Status:</span>
                <span class="tooltip-value">
                    <span class="tooltip-status ${statusClass}">${statusText}</span>
                </span>
            </div>
        </div>
    `;

    inputElement.setAttribute('data-tooltip', tooltipContent);
}

function updatePromoterTooltipFromOption(inputElement, optionElement) {
    const statusClass = optionElement.dataset.status || 'inactive';
    const statusText = (optionElement.dataset.status || 'inactive').charAt(0).toUpperCase() + (optionElement.dataset.status || 'inactive').slice(1);

    const tooltipContent = `
        <div class="tooltip-content">
            <div class="tooltip-header">${optionElement.dataset.name}</div>
            <div class="tooltip-row">
                <span class="tooltip-label">ID:</span>
                <span class="tooltip-value">${optionElement.textContent}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Position:</span>
                <span class="tooltip-value">${optionElement.dataset.position}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Phone:</span>
                <span class="tooltip-value">${optionElement.dataset.phone || 'N/A'}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">ID Card:</span>
                <span class="tooltip-value">${optionElement.dataset.idCard || 'N/A'}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Bank:</span>
                <span class="tooltip-value">${optionElement.dataset.bank || 'N/A'}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Account:</span>
                <span class="tooltip-value">${optionElement.dataset.account ? '****' + optionElement.dataset.account.slice(-4) : 'N/A'}</span>
            </div>
            <div class="tooltip-row">
                <span class="tooltip-label">Status:</span>
                <span class="tooltip-value">
                    <span class="tooltip-status ${statusClass}">${statusText}</span>
                </span>
            </div>
        </div>
    `;

    inputElement.setAttribute('data-tooltip', tooltipContent);
}

// Promoter Management Functions
function getSelectedPromoterIds() {
    const selectedIds = [];
    const promoterSelects = document.querySelectorAll('select[name*="[promoter_id]"]');

    promoterSelects.forEach(select => {
        if (select.value && select.value !== '') {
            selectedIds.push(select.value);
        }
    });

    return selectedIds;
}

function updatePromoterDropdowns() {
    // Duplicate promoters are now allowed, so we show all options
    const promoterSelects = document.querySelectorAll('select[name*="[promoter_id]"]');

    promoterSelects.forEach(select => {
        const options = select.querySelectorAll('option');
        options.forEach(option => {
            // Show all options - duplicates are allowed
            option.style.display = 'block';
        });
    });
}

// Debounced inline AJAX search for promoters per row
let promoterSearchDebounceTimers = {};
let promoterSuggestionsPortalEl = null;
let promoterSuggestionsActiveAnchor = null;
let promoterSuggestionsActiveRowNum = null;

function getPromoterPortal() {
    if (!promoterSuggestionsPortalEl) {
        promoterSuggestionsPortalEl = document.createElement('div');
        promoterSuggestionsPortalEl.id = 'promoterSuggestionsPortal';
        promoterSuggestionsPortalEl.style.position = 'absolute';
        promoterSuggestionsPortalEl.style.zIndex = '100000';
        promoterSuggestionsPortalEl.style.background = '#fff';
        promoterSuggestionsPortalEl.style.border = '1px solid #ddd';
        promoterSuggestionsPortalEl.style.maxHeight = '260px';
        promoterSuggestionsPortalEl.style.overflowY = 'auto';
        promoterSuggestionsPortalEl.style.boxShadow = '0 8px 14px rgba(0,0,0,0.12)';
        promoterSuggestionsPortalEl.style.display = 'none';
        document.body.appendChild(promoterSuggestionsPortalEl);
    }
    return promoterSuggestionsPortalEl;
}

function positionPromoterPortal(anchorEl) {
    const rect = anchorEl.getBoundingClientRect();
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const portal = getPromoterPortal();
    portal.style.minWidth = rect.width + 'px';
    portal.style.left = (rect.left + scrollLeft) + 'px';
    portal.style.top = (rect.bottom + scrollTop) + 'px';
}

function showAllPromoters(rowNum, inputEl) {
    const box = document.getElementById('promoterSuggestions-' + rowNum);
    const q = inputEl.value.trim();
    const row = inputEl.closest('tr');
    const hiddenSelect = row ? row.querySelector(`select[name*='[promoter_id]']`) : null;

    // If already selected (prefilled), do not auto-open on focus
    if (hiddenSelect && hiddenSelect.value) {
        if (box) { box.style.display = 'none'; }
        const portal = getPromoterPortal();
        portal.style.display = 'none';
        return;
    }

    if (q.length >= 2) {
        // If there's already a search term, use search
        handlePromoterSearchInput(rowNum, inputEl);
        return;
    }

    // Show all promoters when focused
    searchPromoters(rowNum, '', 20, inputEl);
}

function hidePromoterSuggestions(rowNum) {
    // Small delay to allow click on suggestion
    setTimeout(() => {
        const box = document.getElementById('promoterSuggestions-' + rowNum);
        if (box) { box.style.display = 'none'; }
        const portal = getPromoterPortal();
        portal.style.display = 'none';
        promoterSuggestionsActiveAnchor = null;
        promoterSuggestionsActiveRowNum = null;
    }, 150);
}

// Hide any open suggestions when clicking outside
document.addEventListener('click', (e) => {
    const isSuggestion = e.target.closest('.promoter-suggestions');
    const isSearchInput = e.target.closest('input[name*="[promoter_search]"]');
    if (!isSuggestion && !isSearchInput) {
        document.querySelectorAll('.promoter-suggestions').forEach(el => {
            el.style.display = 'none';
        });
        const portal = getPromoterPortal();
        portal.style.display = 'none';
        promoterSuggestionsActiveAnchor = null;
        promoterSuggestionsActiveRowNum = null;
    }
});

function searchPromoters(rowNum, q, limit = 10, inputEl = null) {
    const box = document.getElementById('promoterSuggestions-' + rowNum);

    if (promoterSearchDebounceTimers[rowNum]) {
        clearTimeout(promoterSearchDebounceTimers[rowNum]);
    }

    promoterSearchDebounceTimers[rowNum] = setTimeout(async () => {
        try {
            // Duplicates are now allowed - don't exclude already selected promoters
            const params = new URLSearchParams({ q, limit: limit.toString() });
            const url = `${window.location.origin}${window.location.pathname.includes('/admin/') ? '' : ''}/admin/promoters/ajax/search?` + params.toString();

            const res = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();
            const items = (data && data.data) ? data.data : [];

            if (!items.length) {
                const portal = getPromoterPortal();
                portal.innerHTML = '<div style="padding: 6px 8px; color: #666;">No results</div>';
                if (inputEl) { positionPromoterPortal(inputEl); }
                portal.style.display = 'block';
                promoterSuggestionsActiveAnchor = inputEl;
                promoterSuggestionsActiveRowNum = rowNum;
                return;
            }

            const html = items.map(p => `
                <div class="promoter-suggestion-item" data-id="${p.id}" data-name="${p.promoter_name}" data-position="${p.position || ''}" data-position-id="${p.position_id || ''}" data-promoter-id="${p.promoter_id}" data-phone="${p.phone_no || ''}" data-id-card="${p.identity_card_no || ''}" data-bank="${p.bank_name || ''}" data-branch="${p.bank_branch_name || ''}" data-account="${p.bank_account_number || ''}" data-status="${p.status || ''}"
                    style="padding: 6px 8px; cursor: pointer; border-bottom: 1px solid #f0f0f0;">
                    <div style="font-weight: 600;">${p.promoter_name} <span style="color:#999; font-weight:400;">(${p.promoter_id})</span></div>
                    <div style="font-size: 12px; color: #666;">${p.position || 'No Position'} · ${p.phone_no || ''}</div>
                </div>
            `).join('');

            const portal = getPromoterPortal();
            portal.innerHTML = html;
            // Attach item handlers (use mousedown to select before input blur)
            portal.querySelectorAll('.promoter-suggestion-item').forEach(item => {
                item.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    selectPromoterSuggestion(rowNum, item);
                });
                item.addEventListener('click', () => selectPromoterSuggestion(rowNum, item));
            });
            if (inputEl) { positionPromoterPortal(inputEl); }
            portal.style.display = 'block';
            promoterSuggestionsActiveAnchor = inputEl;
            promoterSuggestionsActiveRowNum = rowNum;
        } catch (e) {
            const portal = getPromoterPortal();
            portal.innerHTML = '<div style="padding: 6px 8px; color: #c00;">Search failed</div>';
            if (inputEl) { positionPromoterPortal(inputEl); }
            portal.style.display = 'block';
        }
    }, q.length >= 2 ? 250 : 0); // No delay for showing all promoters
}

function handlePromoterSearchInput(rowNum, inputEl) {
    const q = inputEl.value.trim();
    searchPromoters(rowNum, q, 10, inputEl);
}
// BEGIN: Coordinator search functions for create view
let coordinatorSearchDebounceTimers = {};
let coordinatorSuggestionsPortalEl = null;
let coordinatorSuggestionsActiveAnchor = null;
let coordinatorSuggestionsActiveRowNum = null;

function getCoordinatorPortal() {
    if (!coordinatorSuggestionsPortalEl) {
        coordinatorSuggestionsPortalEl = document.createElement('div');
        coordinatorSuggestionsPortalEl.id = 'coordinatorSuggestionsPortal';
        coordinatorSuggestionsPortalEl.style.position = 'absolute';
        coordinatorSuggestionsPortalEl.style.zIndex = '100000';
        coordinatorSuggestionsPortalEl.style.background = '#fff';
        coordinatorSuggestionsPortalEl.style.border = '1px solid #ddd';
        coordinatorSuggestionsPortalEl.style.maxHeight = '260px';
        coordinatorSuggestionsPortalEl.style.overflowY = 'auto';
        coordinatorSuggestionsPortalEl.style.boxShadow = '0 8px 14px rgba(0,0,0,0.12)';
        coordinatorSuggestionsPortalEl.style.display = 'none';
        document.body.appendChild(coordinatorSuggestionsPortalEl);
    }
    return coordinatorSuggestionsPortalEl;
}

function positionCoordinatorPortal(anchorEl) {
    const rect = anchorEl.getBoundingClientRect();
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const portal = getCoordinatorPortal();
    portal.style.minWidth = rect.width + 'px';
    portal.style.left = (rect.left + scrollLeft) + 'px';
    portal.style.top = (rect.bottom + scrollTop) + 'px';
}

function showAllCoordinators(rowNum, inputEl) {
    const q = inputEl.value.trim();
    const row = inputEl.closest('tr');
    const hiddenSelect = row ? row.querySelector(`select[name*='[coordinator_id]']`) : null;
    if (hiddenSelect && hiddenSelect.value) {
        const portal = getCoordinatorPortal();
        portal.style.display = 'none';
        return;
    }
    if (q.length >= 2) {
        handleCoordinatorSearchInput(rowNum, inputEl);
        return;
    }
    searchCoordinators(rowNum, '', 20, inputEl);
}

function hideCoordinatorSuggestions(rowNum) {
    setTimeout(() => {
        const portal = getCoordinatorPortal();
        portal.style.display = 'none';
        coordinatorSuggestionsActiveAnchor = null;
        coordinatorSuggestionsActiveRowNum = null;
    }, 150);
}

function searchCoordinators(rowNum, q, limit = 10, inputEl = null) {
    if (coordinatorSearchDebounceTimers[rowNum]) {
        clearTimeout(coordinatorSearchDebounceTimers[rowNum]);
    }
    coordinatorSearchDebounceTimers[rowNum] = setTimeout(async () => {
        try {
            const params = new URLSearchParams({ q, limit: limit.toString() });
            const url = `${window.location.origin}${window.location.pathname.includes('/admin/') ? '' : ''}/admin/coordinators/ajax/search?` + params.toString();
            const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const data = await res.json();
            const items = (data && data.data) ? data.data : [];
            const portal = getCoordinatorPortal();
            if (!items.length) {
                portal.innerHTML = '<div style="padding: 6px 8px; color: #666;">No results</div>';
                if (inputEl) { positionCoordinatorPortal(inputEl); }
                portal.style.display = 'block';
                coordinatorSuggestionsActiveAnchor = inputEl;
                coordinatorSuggestionsActiveRowNum = rowNum;
                return;
            }
            portal.innerHTML = items.map(c => `
                <div class="coordinator-suggestion-item" data-id="${c.id}" data-name="${c.coordinator_name}" data-coordinator-id="${c.coordinator_id}" data-phone="${c.phone_no || ''}" data-nic="${c.nic_no || ''}" data-bank="${c.bank_name || ''}" data-account="${c.account_number || ''}" data-status="${c.status || ''}"
                    style="padding: 6px 8px; cursor: pointer; border-bottom: 1px solid #f0f0f0;">
                    <div style="font-weight: 600;">${c.coordinator_id} - ${c.coordinator_name}</div>
                    <div style="font-size: 12px; color: #666;">${c.phone_no || ''}</div>
                </div>
            `).join('');
            portal.querySelectorAll('.coordinator-suggestion-item').forEach(item => {
                item.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    selectCoordinatorSuggestion(rowNum, item);
                });
                item.addEventListener('click', () => selectCoordinatorSuggestion(rowNum, item));
            });
            if (inputEl) { positionCoordinatorPortal(inputEl); }
            portal.style.display = 'block';
            coordinatorSuggestionsActiveAnchor = inputEl;
            coordinatorSuggestionsActiveRowNum = rowNum;
        } catch (e) {
            const portal = getCoordinatorPortal();
            portal.innerHTML = '<div style="padding: 6px 8px; color: #c00;">Search failed</div>';
            if (inputEl) { positionCoordinatorPortal(inputEl); }
            portal.style.display = 'block';
        }
    }, q.length >= 2 ? 250 : 0);
}

function handleCoordinatorSearchInput(rowNum, inputEl) {
    const q = inputEl.value.trim();
    searchCoordinators(rowNum, q, 10, inputEl);
}

function selectCoordinatorSuggestion(rowNum, el) {
    const anchor = coordinatorSuggestionsActiveAnchor;
    const row = anchor ? anchor.closest('tr') : null;
    if (!row) return;
    const hiddenSelect = row.querySelector(`select[name*='[coordinator_id]']`);
    const nameInput = row.querySelector(`input[name*='[coordinator_name]'], input[name*='[current_coordinator]']`);
    const searchInput = row.querySelector(`input[name*='[coordinator_search]']`);

    const option = document.createElement('option');
    option.value = el.dataset.id;
    option.selected = true;
    option.dataset.name = el.dataset.name || '';
    option.textContent = el.dataset.coordinatorId || '';

    hiddenSelect.innerHTML = '';
    hiddenSelect.appendChild(option);

    updateCoordinatorDisplay(rowNum, hiddenSelect);

    if (nameInput) nameInput.value = el.dataset.name || '';
    if (searchInput) searchInput.value = `${el.dataset.coordinatorId} - ${el.dataset.name}`;

    const portal = getCoordinatorPortal();
    portal.style.display = 'none';
    coordinatorSuggestionsActiveAnchor = null;
    coordinatorSuggestionsActiveRowNum = null;

    // Recalculate dependent amounts
    if (typeof calculateGrandTotal === 'function') {
        calculateGrandTotal();
    }
}
// END: Coordinator search functions for create view

// Expose to global scope for inline handlers
if (typeof window !== 'undefined') {
    window.handlePromoterSearchInput = handlePromoterSearchInput;
    window.showAllPromoters = showAllPromoters;
    window.hidePromoterSuggestions = hidePromoterSuggestions;
    window.handleCoordinatorSearchInput = handleCoordinatorSearchInput;
    window.showAllCoordinators = showAllCoordinators;
    window.hideCoordinatorSuggestions = hideCoordinatorSuggestions;
}

function selectPromoterSuggestion(rowNum, el) {
    const anchor = promoterSuggestionsActiveAnchor;
    const row = anchor ? anchor.closest('tr') : null;
    if (!row) return;
    const hiddenSelect = row.querySelector(`select[name*='[promoter_id]']`);
    const nameInput = row.querySelector(`input[name*='[promoter_name]']`);
    const positionInput = row.querySelector(`input[name*='[position]']`);
    const searchBox = row.querySelector(`#promoterSuggestions-${rowNum}`) || document.getElementById('promoterSuggestions-' + rowNum);
    const searchInput = row.querySelector(`input[name*='[promoter_search]']`);

    // Duplicate promoters are now allowed - removed duplicate detection

    const option = document.createElement('option');
    option.value = el.dataset.id;
    option.selected = true;
    option.dataset.name = el.dataset.name || '';
    option.dataset.position = el.dataset.position || '';
    option.dataset.phone = el.dataset.phone || '';
    option.dataset.idCard = el.dataset.idCard || '';
    option.dataset.bank = el.dataset.bank || '';
    option.dataset.branch = el.dataset.branch || '';
    option.dataset.account = el.dataset.account || '';
    option.dataset.status = el.dataset.status || '';
    option.dataset.positionId = el.dataset.positionId || '';
    option.textContent = el.dataset.promoterId || '';

    hiddenSelect.innerHTML = '';
    hiddenSelect.appendChild(option);

    updatePromoterDetails(rowNum, hiddenSelect);

    if (nameInput) nameInput.value = el.dataset.name || '';
    if (positionInput) positionInput.value = el.dataset.position || '';
    if (searchInput) searchInput.value = `${el.dataset.promoterId} - ${el.dataset.name}`;

    searchBox.style.display = 'none';
    searchBox.innerHTML = '';
    const portal = getPromoterPortal();
    portal.style.display = 'none';
    promoterSuggestionsActiveAnchor = null;
    promoterSuggestionsActiveRowNum = null;

    // Recalculate dependent amounts
    calculateRowTotal(rowNum);
    // calculateAttendanceAmount is now called within calculateRowTotal
    calculateGrandTotal();

    // Update other dropdowns (duplicates now allowed)
    updatePromoterDropdowns();
}
// Expose to global scope for inline handlers
if (typeof window !== 'undefined') {
    window.selectPromoterSuggestion = selectPromoterSuggestion;
}

function validatePromoterSelection(selectElement) {
    // Duplicate promoters are now allowed - validation always passes
    return true;
}

async function updatePromoterDetails(rowNum, selectElement) {
    // Validate promoter selection first
    if (!validatePromoterSelection(selectElement)) {
        return; // Stop processing if validation fails
    }

    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const row = selectElement.closest('tr');

    if (selectedOption && selectedOption.dataset.name) {
        const promoterNameInput = row.querySelector('input[name="rows[' + rowNum + '][promoter_name]"]');
        const positionSelect = document.getElementById(`positionSelect-${rowNum}`);
        const positionNameInput = document.getElementById(`positionName-${rowNum}`);
        const bankNameInput = row.querySelector('input[name="rows[' + rowNum + '][bank_name]"]');
        const bankBranchInput = row.querySelector('input[name="rows[' + rowNum + '][bank_branch]"]');
        const bankAccountInput = row.querySelector('input[name="rows[' + rowNum + '][bank_account_number]"]');

        promoterNameInput.value = selectedOption.dataset.name;

        // Populate position dropdown from salary rules
        populatePositionDropdown(rowNum);

        // Try to select the promoter's position if available
        const promoterPositionId = selectedOption.dataset.positionId;
        if (positionSelect && promoterPositionId) {
            positionSelect.value = promoterPositionId;
            updatePositionFromDropdown(rowNum, positionSelect);
        } else if (selectedOption.dataset.position) {
            // Fallback: set position name if position ID not available
            if (positionNameInput) {
                positionNameInput.value = selectedOption.dataset.position;
            }
        }

        // Populate bank details
        if (bankNameInput) bankNameInput.value = selectedOption.dataset.bank || '';
        if (bankBranchInput) bankBranchInput.value = selectedOption.dataset.branch || '';
        if (bankAccountInput) bankAccountInput.value = selectedOption.dataset.account || '';

        // Update tooltip with promoter details from option data attributes
        updatePromoterTooltipFromOption(promoterNameInput, selectedOption);

        // Recalculate attendance amount when promoter changes
        const totalInput = row.querySelector(`input[name="rows[${rowNum}][attendance_total]"]`);
        const presentDays = totalInput ? parseFloat(totalInput.value) || 0 : 0;
        await calculateAttendanceAmount(rowNum, presentDays);

        // Apply job settings to this row when promoter changes
        applyJobSettingsToRow(rowNum);

        // Update all promoter dropdowns to hide selected promoters
        updatePromoterDropdowns();
    } else {
        const promoterNameInput = row.querySelector('input[name="rows[' + rowNum + '][promoter_name]"]');
        const positionSelect = document.getElementById(`positionSelect-${rowNum}`);
        const positionNameInput = document.getElementById(`positionName-${rowNum}`);
        const bankNameInput = row.querySelector('input[name="rows[' + rowNum + '][bank_name]"]');
        const bankBranchInput = row.querySelector('input[name="rows[' + rowNum + '][bank_branch]"]');
        const bankAccountInput = row.querySelector('input[name="rows[' + rowNum + '][bank_account_number]"]');

        promoterNameInput.value = '';
        if (positionSelect) positionSelect.value = '';
        if (positionNameInput) positionNameInput.value = '';

        // Clear bank details
        if (bankNameInput) bankNameInput.value = '';
        if (bankBranchInput) bankBranchInput.value = '';
        if (bankAccountInput) bankAccountInput.value = '';

        // Clear tooltip
        promoterNameInput.setAttribute('data-tooltip', '');

        // Clear attendance amount when no promoter selected
        const attendanceAmountInput = row.querySelector(`input[name="rows[${rowNum}][attendance_amount]"]`);
        if (attendanceAmountInput) {
            attendanceAmountInput.value = '0.00';
        }

        // Update all promoter dropdowns when selection is cleared
        updatePromoterDropdowns();
    }
}

function updateCoordinatorDisplay(rowNum, selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const row = selectElement.closest('tr');

    const bankNameInput = document.getElementById(`coordinatorBankName-${rowNum}`);
    const bankBranchInput = document.getElementById(`coordinatorBankBranch-${rowNum}`);
    const bankAccountInput = document.getElementById(`coordinatorBankAccount-${rowNum}`);

    if (selectedOption && selectedOption.dataset.name) {
        row.querySelector('input[name="rows[' + rowNum + '][current_coordinator]"]').value = selectedOption.dataset.name;

        // Auto-fill the coordinator's bank details
        const selectedCoordinator = coordinators.find(c => c.id == selectElement.value);
        if (bankNameInput) bankNameInput.value = selectedCoordinator ? (selectedCoordinator.bank_name || '') : '';
        if (bankBranchInput) bankBranchInput.value = selectedCoordinator ? (selectedCoordinator.bank_branch_name || '') : '';
        if (bankAccountInput) bankAccountInput.value = selectedCoordinator ? (selectedCoordinator.account_number || '') : '';

        // Calculate coordinator fee based on present days
        calculateCoordinatorFee(rowNum);

        // Apply job settings to this row when coordinator changes
        applyJobSettingsToRow(rowNum);

        // Trigger net calculation since coordinator fee changed
        calculateRowNet(rowNum);
    } else {
        row.querySelector('input[name="rows[' + rowNum + '][current_coordinator]"]').value = '';

        // Clear coordinator bank details when no coordinator selected
        if (bankNameInput) bankNameInput.value = '';
        if (bankBranchInput) bankBranchInput.value = '';
        if (bankAccountInput) bankAccountInput.value = '';

        // Clear coordinator fee when no coordinator selected
        const coordinationFeeInput = row.querySelector(`input[name="rows[${rowNum}][coordination_fee]"]`);
        if (coordinationFeeInput) {
            coordinationFeeInput.value = '0.00';
        }

        // Apply job settings to this row when coordinator changes
        applyJobSettingsToRow(rowNum);

        // Trigger net calculation
        calculateRowNet(rowNum);
    }
}

// Global variable to store current attendance dates
let currentAttendanceDates = [];

// Global variable to track if data has been auto-pulled for current job
let hasAutoPulledData = false;
let lastSelectedJobId = null;

function validateAttendanceInput(input) {
    const value = parseFloat(input.value);

    // Check if value is valid (only 0 or 1)
    if (isNaN(value) || (value !== 0 && value !== 1)) {
        // Reset to 0 if invalid value
        input.value = '0';

        // Show a more user-friendly message
        const tooltip = document.createElement('div');
        tooltip.style.cssText = `
            position: absolute;
            background: #dc2626;
            color: white;
            padding: 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            z-index: 1000;
            pointer-events: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        `;
        tooltip.textContent = 'Only 0 (absent) or 1 (present) allowed';

        // Position tooltip near input
        const rect = input.getBoundingClientRect();
        tooltip.style.left = rect.left + 'px';
        tooltip.style.top = (rect.bottom + 5) + 'px';

        document.body.appendChild(tooltip);

        // Remove tooltip after 3 seconds
        setTimeout(() => {
            if (tooltip.parentNode) {
                tooltip.parentNode.removeChild(tooltip);
            }
        }, 3000);

        // Add visual feedback
        input.style.backgroundColor = '#fecaca';
        input.style.borderColor = '#dc2626';

        setTimeout(() => {
            input.style.backgroundColor = '';
            input.style.borderColor = '';
        }, 1000);

    } else {
        // Ensure it's an integer (0 or 1)
        input.value = Math.floor(value);

        // Add visual feedback for valid input
        input.style.backgroundColor = '#d1fae5';
        input.style.borderColor = '#059669';

        setTimeout(() => {
            input.style.backgroundColor = '';
            input.style.borderColor = '';
        }, 500);
    }
}

// Flag to prevent infinite loops
let isUpdatingAttendanceDates = false;

function updateAttendanceDates() {
    if (isUpdatingAttendanceDates) return;
    isUpdatingAttendanceDates = true;

    const jobHidden            = document.getElementById('job_id');
    const noJobMessage         = document.getElementById('noJobMessage');
    const noEndDateMessage     = document.getElementById('noEndDateMessage');
    const salaryTableContainer = document.getElementById('salaryTableContainer');
    const addPromoterBtn       = document.getElementById('addPromoterBtn');
    const salaryRuleBtn        = document.getElementById('salaryRuleBtn');
    const allowanceRuleBtn     = document.getElementById('allowanceRuleBtn');
    const attendanceLegend     = document.getElementById('attendanceLegend');

    if (!jobHidden || !jobHidden.value) {
        // No job selected
        currentAttendanceDates = [];
        updateAttendanceHeaders([]);
        updateExistingRows([]);
        clearAllRows();
        addPromoterRow();
        if (noJobMessage)         noJobMessage.style.display         = 'block';
        if (salaryTableContainer) salaryTableContainer.style.display = 'none';
        if (attendanceLegend)     attendanceLegend.style.display     = 'none';
        scHidePicker();

        // Disable buttons
        addPromoterBtn.disabled = true;
        const bulkAddRowsBtn = document.getElementById('bulkAddRowsBtn');
        if (bulkAddRowsBtn) bulkAddRowsBtn.disabled = true;
        salaryRuleBtn.disabled = true;
        allowanceRuleBtn.disabled = true;
        const addCustomDateBtn = document.getElementById('addCustomDateBtn');
        if (addCustomDateBtn) {
            addCustomDateBtn.disabled = true;
        }

        // Disable Pull Data button when no job is selected
        const pullDataBtn = document.getElementById('pullDataBtn');
        if (pullDataBtn) {
            pullDataBtn.disabled = true;
        }

        // Reset auto-pull flag when no job is selected
        hasAutoPulledData = false;
        lastSelectedJobId = null;
        isUpdatingAttendanceDates = false;
        return;
    }

    // ── Job is selected ──────────────────────────────────────────────────────
    // Attendance columns come from the sheet's own Start Date / End Date,
    // NOT from the job's dates.
    const jobId      = jobHidden.value;
    const sheetStart = document.getElementById('sheet_start_date')?.value || '';
    const sheetEnd   = document.getElementById('sheet_end_date')?.value   || '';

    if (noJobMessage)     noJobMessage.style.display     = 'none';
    if (noEndDateMessage) noEndDateMessage.style.display = 'none';

    // Build date range from sheet dates (empty set if not set yet)
    const baseDates = (sheetStart && sheetEnd && sheetEnd >= sheetStart)
        ? new Set(generateDateRange(sheetStart, sheetEnd))
        : new Set();

    // Always fetch existing salary sheets for the picker
    fetch(`/admin/salary-sheets/by-job/${jobId}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(r => r.json())
    .then(data => {
        const finalDates = Array.from(baseDates).sort();

        updateAttendanceHeaders(finalDates);
        updateExistingRows(finalDates);
        currentAttendanceDates = finalDates;

        if (data.success && data.salarySheets && data.salarySheets.length > 0) {
            scShowPicker(data.salarySheets, finalDates);
        } else {
            clearAllRows();
            addPromoterRow();
            const sheetNumberInput = document.getElementById('sheet_number');
            if (sheetNumberInput) sheetNumberInput.value = '';
            selectStatusOption('draft', 'Draft');
            calculateGrandTotal();
            if (salaryTableContainer) salaryTableContainer.style.display = 'block';
            if (attendanceLegend) attendanceLegend.style.display = finalDates.length > 0 ? 'block' : 'none';
            if (addPromoterBtn) addPromoterBtn.disabled = false;
            const bulkBtn = document.getElementById('bulkAddRowsBtn'); if (bulkBtn) bulkBtn.disabled = false;
            if (salaryRuleBtn) salaryRuleBtn.disabled = false;
            if (allowanceRuleBtn) allowanceRuleBtn.disabled = false;
            const addCustomDateBtn = document.getElementById('addCustomDateBtn');
            if (addCustomDateBtn) addCustomDateBtn.disabled = false;
            initializeAfterDatesUpdate();
        }
        isUpdatingAttendanceDates = false;
    })
    .catch(error => {
        console.error('Error fetching salary sheets:', error);
        const finalDates = Array.from(baseDates).sort();
        updateAttendanceHeaders(finalDates);
        updateExistingRows(finalDates);
        currentAttendanceDates = finalDates;
        if (salaryTableContainer) salaryTableContainer.style.display = 'block';
        if (attendanceLegend) attendanceLegend.style.display = finalDates.length > 0 ? 'block' : 'none';
        if (addPromoterBtn) addPromoterBtn.disabled = false;
        const bulkBtn = document.getElementById('bulkAddRowsBtn'); if (bulkBtn) bulkBtn.disabled = false;
        if (salaryRuleBtn) salaryRuleBtn.disabled = false;
        if (allowanceRuleBtn) allowanceRuleBtn.disabled = false;
        clearAllRows();
        addPromoterRow();
        calculateGrandTotal();
        initializeAfterDatesUpdate();
        isUpdatingAttendanceDates = false;
    });
}

// Helper function to initialize after dates are updated
function initializeAfterDatesUpdate() {
    const jobHidden2 = document.getElementById('job_id');
    const noJobMessage = document.getElementById('noJobMessage');
    const noEndDateMessage = document.getElementById('noEndDateMessage');
    const salaryTableContainer = document.getElementById('salaryTableContainer');
    const addPromoterBtn = document.getElementById('addPromoterBtn');
    const salaryRuleBtn = document.getElementById('salaryRuleBtn');
    const allowanceRuleBtn = document.getElementById('allowanceRuleBtn');
    const attendanceLegend = document.getElementById('attendanceLegend');

    if (jobHidden2 && jobHidden2.value) {
        // Check if end date exists
        const endDate = jobHidden2.getAttribute('data-end-date');
        const hasEndDate = endDate && endDate !== 'null' && endDate !== '';

        // Load position salary rules for the selected job
        loadPositionSalaryRules().then(() => {
            // Populate position dropdowns for all existing rows
            const rows = document.querySelectorAll('#promoterRows tr');
            rows.forEach((row, idx) => {
                const rowNum = idx + 1;
                populatePositionDropdown(rowNum);
            });
        });

        // Update payment headers with job allowance rules
        const jobAllowances = getCurrentJobAllowances();
        updatePaymentHeaders(jobAllowances);

        // Apply job settings to all existing rows when job is selected
        const rows = document.querySelectorAll('#promoterRows tr');
        rows.forEach((row, index) => {
            const rowNum = index + 1;
            applyJobSettingsToRow(rowNum);
        });

        // Enable Pull Data button when job is selected
        const pullDataBtn = document.getElementById('pullDataBtn');
        if (pullDataBtn) {
            pullDataBtn.disabled = false;
        }

        // Show table and hide messages
        if (noJobMessage) noJobMessage.style.display = 'none';
        if (salaryTableContainer) salaryTableContainer.style.display = 'block';

        // Show/hide attendance legend based on whether there are dates
        if (attendanceLegend) {
            attendanceLegend.style.display = (currentAttendanceDates && currentAttendanceDates.length > 0) ? 'block' : 'none';
        }

        if (noEndDateMessage) noEndDateMessage.style.display = 'none';

        // Enable buttons
        if (addPromoterBtn) addPromoterBtn.disabled = false;
                const bulkBtn = document.getElementById('bulkAddRowsBtn'); if (bulkBtn) bulkBtn.disabled = false;
        if (salaryRuleBtn) salaryRuleBtn.disabled = false;
        if (allowanceRuleBtn) allowanceRuleBtn.disabled = false;
        const addCustomDateBtn = document.getElementById('addCustomDateBtn');
        if (addCustomDateBtn) addCustomDateBtn.disabled = false;

        // Initialize horizontal scroll functionality
        setTimeout(() => {
            initializeHorizontalScroll();
        }, 100);

        // Note: Auto-pull is disabled here because updateAttendanceDates() already fetches
        // salary sheets to get custom dates. The auto-pull will happen separately if needed.
        // This prevents double-fetching and infinite loops.
    }
}

function generateDateRange(startDate, endDate) {
    const dates = [];
    const start = new Date(startDate);
    const end = new Date(endDate);

    for (let d = new Date(start); d <= end; d.setDate(d.getDate() + 1)) {
        dates.push(d.toISOString().split('T')[0]);
    }

    return dates;
}

function updateAttendanceHeaders(dates) {
    const headersContainer = document.getElementById('attendanceHeaders');
    const attendanceColumn = document.getElementById('attendanceColumn');

    // Always show attendance column (either with dates or fallback)
    attendanceColumn.style.display = 'table-cell';

    // Calculate dynamic width based on number of dates
    const baseWidth = 160; // Base width for Total and Amount columns (increased for wider amount field)
    const dateWidth = 80; // Width per date column
    const numDates = dates.length; // Don't use fallback - show empty if no dates
    const totalWidth = (numDates * dateWidth) + baseWidth;

    // Update attendance column width
    attendanceColumn.style.width = `${totalWidth}px`;

    const totalColumns = numDates + 2; // dates + Total + Amount

    // Update grid template columns
    headersContainer.style.gridTemplateColumns = `repeat(${numDates}, 1fr) 1fr 1.5fr`;
    headersContainer.style.width = `${totalWidth}px`;

    // Clear existing headers
    headersContainer.innerHTML = '';

    // Add date headers (only if dates exist)
    if (dates.length > 0) {
        dates.forEach(date => {
            const dateDiv = document.createElement('div');
            dateDiv.style.textAlign = 'center';
            dateDiv.style.fontSize = '0.7rem';
            dateDiv.textContent = date;
            headersContainer.appendChild(dateDiv);
        });
    }
    // If no dates, don't add any date headers (empty columns)

    // Add Total and Amount headers
    const totalDiv = document.createElement('div');
    totalDiv.style.textAlign = 'center';
    totalDiv.style.fontSize = '0.7rem';
    totalDiv.textContent = 'Total';
    headersContainer.appendChild(totalDiv);

    const amountDiv = document.createElement('div');
    amountDiv.style.textAlign = 'center';
    amountDiv.style.fontSize = '0.7rem';
    amountDiv.textContent = 'Amount';
    headersContainer.appendChild(amountDiv);
}

function updateExistingRows(dates) {
    const rows = document.querySelectorAll('#promoterRows tr');
    rows.forEach(row => {
        const attendanceCell = row.querySelector('td:nth-child(5)');
        if (attendanceCell) {
            // Always show attendance cell (either with dates or fallback)
            attendanceCell.style.display = 'table-cell';

            // Calculate dynamic width based on number of dates
            const baseWidth = 160; // Base width for Total and Amount columns (increased for wider amount field)
            const dateWidth = 80; // Width per date column
            const numDates = dates.length; // Don't use fallback - show empty if no dates
            const totalWidth = (numDates * dateWidth) + baseWidth;

            // Update attendance cell width
            attendanceCell.style.width = `${totalWidth}px`;

            const gridContainer = attendanceCell.querySelector('div');
            if (gridContainer) {
                const totalColumns = numDates + 2;
                gridContainer.style.gridTemplateColumns = `repeat(${numDates}, 1fr) 1fr 1.5fr`;
                gridContainer.style.width = `${totalWidth}px`;

                // Clear existing inputs
                gridContainer.innerHTML = '';

                // Add date inputs (only if dates exist)
                if (dates.length > 0) {
                    // Use real dates
                    dates.forEach(date => {
                        const input = document.createElement('input');
                        input.type = 'number';
                        input.className = 'table-input-small';
                        input.name = `rows[${getRowNumberFromElement(row)}][attendance][${date}]`;
                        input.min = '0';
                        input.max = '1';
                        input.step = '1';
                        input.placeholder = '0/1';
                        input.onchange = () => {
                            calculateRowTotal(getRowNumberFromElement(row));
                        };
                        gridContainer.appendChild(input);
                    });
                }
                // If no dates, don't add any date inputs (empty columns)

                // Add Total input
                const totalInput = document.createElement('input');
                totalInput.type = 'number';
                totalInput.className = 'table-input-small';
                totalInput.min = '0';
                totalInput.step = '0.1';
                totalInput.placeholder = '0';
                const _rn = getRowNumberFromElement(row);
                totalInput.name = `rows[${_rn}][attendance_total]`;
                totalInput.oninput = function() { onAttendanceTotalManualChange(_rn, this); };
                gridContainer.appendChild(totalInput);

                // Add Amount input
                const amountInput = document.createElement('input');
                amountInput.type = 'number';
                amountInput.step = '0.01';
                amountInput.className = 'table-input-small';
                amountInput.name = `rows[${getRowNumberFromElement(row)}][attendance_amount]`;
                amountInput.title = 'Attendance Amount (Auto-calculated, but editable)';
                const rowNum = getRowNumberFromElement(row);
                amountInput.setAttribute('oninput', `calculateNetAmount(${rowNum})`);
                gridContainer.appendChild(amountInput);
            }
        }
    });
}

function getRowNumber(row) {
    const firstInput = row.querySelector('input[name*="[promoter_id]"]');
    if (firstInput) {
        const nameMatch = firstInput.name.match(/rows\[(\d+)\]/);
        return nameMatch ? nameMatch[1] : 1;
    }
    return 1;
}

// Global variable to store position salary rules
let positionSalaryRules = {};
// Store all salary rules with position details
let allSalaryRules = [];

// Function to load position salary rules for the selected job
async function loadPositionSalaryRules() {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) {
        positionSalaryRules = {};
        allSalaryRules = [];
        return;
    }

    try {
        const response = await fetch('{{ route("admin.position-wise-salary-rules.get-rules") }}');
        const data = await response.json();

        // Filter rules for the selected job (job-specific or general rules)
        const relevantRules = data.filter(rule =>
            rule.job_id == selectedJobId || rule.job_id === null
        );

        // Store all rules with position details
        allSalaryRules = relevantRules;

        // Store rules in a lookup object for salary calculation
        positionSalaryRules = {};
        relevantRules.forEach(rule => {
            positionSalaryRules[rule.position_id] = parseFloat(rule.amount);
        });

        console.log('Loaded position salary rules:', positionSalaryRules);
        console.log('All salary rules with positions:', allSalaryRules);
    } catch (error) {
        console.error('Error loading position salary rules:', error);
        positionSalaryRules = {};
        allSalaryRules = [];
    }
}

// Function to populate position dropdown from salary rules
function populatePositionDropdown(rowNum) {
    const positionSelect = document.getElementById(`positionSelect-${rowNum}`);
    const positionNameInput = document.getElementById(`positionName-${rowNum}`);

    if (!positionSelect) return;

    // Clear existing options except the first one
    positionSelect.innerHTML = '<option value="">Select Position</option>';

    // Get unique positions from salary rules
    const uniquePositions = [];
    const positionMap = new Map();

    allSalaryRules.forEach(rule => {
        if (rule.position && rule.position.id && !positionMap.has(rule.position.id)) {
            positionMap.set(rule.position.id, rule.position);
            uniquePositions.push(rule.position);
        }
    });

    // Add positions to dropdown
    uniquePositions.forEach(position => {
        const option = document.createElement('option');
        option.value = position.id;
        option.textContent = position.position_name;
        option.dataset.positionName = position.position_name;
        positionSelect.appendChild(option);
    });

    // Add custom position option
    const customOption = document.createElement('option');
    customOption.value = 'custom';
    customOption.textContent = '+ Custom Position...';
    customOption.dataset.positionName = '';
    positionSelect.appendChild(customOption);

    // If promoter has a position, try to select it
    const row = positionSelect.closest('tr');
    const promoterSelect = row.querySelector('select[name*="[promoter_id]"]');
    if (promoterSelect && promoterSelect.value) {
        const selectedOption = promoterSelect.options[promoterSelect.selectedIndex];
        const promoterPositionId = selectedOption.dataset.positionId;
        if (promoterPositionId) {
            positionSelect.value = promoterPositionId;
            updatePositionFromDropdown(rowNum, positionSelect);
        }
    }
}

// Function to update position name when dropdown changes
function updatePositionFromDropdown(rowNum, selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const positionNameInput = document.getElementById(`positionName-${rowNum}`);
    const customInput = document.getElementById(`customPositionInput-${rowNum}`);

    // Handle custom position selection
    if (selectedOption && selectedOption.value === 'custom') {
        if (customInput) {
            customInput.style.display = 'block';
            selectElement.style.display = 'none';
            customInput.focus();
            if (positionNameInput) positionNameInput.value = customInput.value || '';
        }
        return;
    }

    // Show select, hide custom input
    if (customInput) customInput.style.display = 'none';
    selectElement.style.display = 'block';

    if (selectedOption && selectedOption.value) {
        const positionName = selectedOption.dataset.positionName || selectedOption.textContent;
        if (positionNameInput) {
            positionNameInput.value = positionName;
        }

        // Get position ID and recalculate attendance amount when position changes
        const positionId = selectedOption.value;
        const row = selectElement.closest('tr');
        const totalInput = row.querySelector(`input[name="rows[${rowNum}][attendance_total]"]`);
        const presentDays = totalInput ? parseFloat(totalInput.value) || 0 : 0;

        // Get position salary from salary rules
        const positionSalary = getPositionSalary(positionId);

        // Attendance amount = salary × days; effective amount uses base salary when no days yet
        const attendanceAmount = positionSalary * presentDays;
        const effectiveAmount = (presentDays > 0) ? attendanceAmount : positionSalary;

        // Update attendance amount field
        const attendanceAmountInput = row.querySelector(`input[name="rows[${rowNum}][attendance_amount]"]`);
        if (attendanceAmountInput) {
            attendanceAmountInput.value = attendanceAmount.toFixed(2);
            attendanceAmountInput.dataset.lastCalculatedAmount = attendanceAmount.toFixed(2);
        }

        // Update payment amount field with effective amount (base salary when no days yet)
        const paymentAmountInput = row.querySelector(`input[name="rows[${rowNum}][amount]"]`);
        if (paymentAmountInput) {
            const currentAmount = parseFloat(paymentAmountInput.value) || 0;
            const hasCustomAmount = paymentAmountInput.dataset.customAmount === 'true';
            const loadedFromDb = paymentAmountInput.dataset.loadedFromDb === 'true';
            const manuallyEdited = paymentAmountInput.dataset.manuallyEdited === 'true';

            if (!hasCustomAmount && !loadedFromDb && !manuallyEdited || currentAmount === 0) {
                paymentAmountInput.value = effectiveAmount.toFixed(2);
                paymentAmountInput.dataset.lastSyncedAmount = effectiveAmount.toFixed(2);
            }
        }

        // Recalculate coordinator fee and net amount
        calculateCoordinatorFee(rowNum);
        calculateRowNet(rowNum);
    } else {
        if (positionNameInput) {
            positionNameInput.value = '';
        }

        // Clear attendance amount if no position selected
        const row = selectElement.closest('tr');
        const attendanceAmountInput = row.querySelector(`input[name="rows[${rowNum}][attendance_amount]"]`);
        if (attendanceAmountInput) {
            attendanceAmountInput.value = '0.00';
        }

        const paymentAmountInput = row.querySelector(`input[name="rows[${rowNum}][amount]"]`);
        if (paymentAmountInput && !paymentAmountInput.dataset.customAmount) {
            paymentAmountInput.value = '0.00';
        }

        calculateRowNet(rowNum);
    }
}

// Called when user types in the custom position text input
function updateCustomPosition(rowNum, inputEl) {
    const positionNameInput = document.getElementById(`positionName-${rowNum}`);
    if (positionNameInput) positionNameInput.value = inputEl.value.trim();

    // Clear the hidden position_id so the controller knows this is custom
    const positionSelect = document.getElementById(`positionSelect-${rowNum}`);
    if (positionSelect) positionSelect.value = 'custom';

    // Allow user to go back to dropdown by pressing Escape
    inputEl.onkeydown = function(e) {
        if (e.key === 'Escape') {
            inputEl.value = '';
            if (positionNameInput) positionNameInput.value = '';
            inputEl.style.display = 'none';
            if (positionSelect) {
                positionSelect.style.display = 'block';
                positionSelect.value = '';
            }
        }
    };
}

// Function to get salary amount for a position
function getPositionSalary(positionId) {
    return positionSalaryRules[positionId] || 0;
}

function calculateRowTotal(rowNum) {
    let total = 0;

    // Method 1: Use currentAttendanceDates if available
    if (currentAttendanceDates && currentAttendanceDates.length > 0) {
    currentAttendanceDates.forEach(date => {
        const input = document.querySelector(`input[name="rows[${rowNum}][attendance][${date}]"]`);
        if (input && input.value) {
            total += parseFloat(input.value) || 0;
        }
    });
    }

    // Method 2: Fallback - find all attendance inputs in the row
    if (total === 0) {
        const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][promoter_id]"])`);
        if (row) {
            const attendanceInputs = row.querySelectorAll('input[name*="[attendance]"]');
            attendanceInputs.forEach(input => {
                const name = input.name;
                // Only count actual attendance inputs, not the total/amount inputs
                if (name.includes('[attendance][') && !name.includes('[attendance_total]') && !name.includes('[attendance_amount]')) {
                    total += parseFloat(input.value) || 0;
                }
            });
        }
    }

    const totalInput = document.querySelector(`input[name="rows[${rowNum}][attendance_total]"]`);
    if (totalInput) {
        totalInput.value = total.toFixed(1);
    }

    // When attendance is updated, clear custom amount flags so amount gets recalculated
    const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][amount]"])`);
    if (row) {
        const paymentAmountInput = row.querySelector(`input[name="rows[${rowNum}][amount]"]`);
        if (paymentAmountInput) {
            // Clear custom amount flags and synced amount to allow recalculation
            paymentAmountInput.removeAttribute('data-custom-amount');
            paymentAmountInput.removeAttribute('data-manually-edited');
            paymentAmountInput.removeAttribute('data-loaded-from-db');
            paymentAmountInput.removeAttribute('data-last-synced-amount');
            // Set flag to indicate attendance was just updated - this will force amount recalculation
            paymentAmountInput.setAttribute('data-attendance-updated', 'true');
        }

        // Also clear coordination fee custom flags when attendance is updated
        const coordinationFeeInput = row.querySelector(`input[name="rows[${rowNum}][coordination_fee]"]`);
        if (coordinationFeeInput) {
            // Clear custom coordination fee flags to allow recalculation
            coordinationFeeInput.removeAttribute('data-custom-coordination-fee');
            coordinationFeeInput.removeAttribute('data-manually-edited');
            coordinationFeeInput.removeAttribute('data-loaded-from-db');
            coordinationFeeInput.removeAttribute('data-last-calculated-fee');
            // Set flag to indicate attendance was just updated - this will force coordination fee recalculation
            coordinationFeeInput.setAttribute('data-attendance-updated', 'true');
        }

        // Clear custom allowance flags for allowances with multiply_by_attendance enabled
        const allowanceInputs = row.querySelectorAll(`input[name^="rows[${rowNum}][allowances]"]`);
        allowanceInputs.forEach(input => {
            const multiplyByAttendance = input.dataset.multiplyByAttendance === 'true';
            if (multiplyByAttendance) {
                // Clear custom allowance flags to allow recalculation
                input.removeAttribute('data-custom-allowance');
                input.removeAttribute('data-manually-edited');
                input.removeAttribute('data-loaded-from-db');
                input.setAttribute('data-attendance-updated', 'true');
            }
        });
    }

    // Calculate attendance amount based on position salary
    calculateAttendanceAmount(rowNum, total).then(() => {
        // Calculate allowances based on attendance (if multiply_by_attendance is enabled)
        calculateAllowances(rowNum, total);
        // Apply job settings to this row when attendance changes
        applyJobSettingsToRow(rowNum);
        calculateRowNet(rowNum);
    });
}

function onAttendanceTotalManualChange(rowNum, input) {
    const total = parseFloat(input.value) || 0;

    // Clear flags that block recalculation — same as calculateRowTotal does for date checkboxes.
    // When the user explicitly types a total they expect payment columns to update.
    const _row = document.querySelector(`tr:has(input[name="rows[${rowNum}][amount]"])`);
    if (_row) {
        const _amt = _row.querySelector(`input[name="rows[${rowNum}][amount]"]`);
        if (_amt) {
            _amt.removeAttribute('data-custom-amount');
            _amt.removeAttribute('data-manually-edited');
            _amt.removeAttribute('data-loaded-from-db');
            _amt.setAttribute('data-attendance-updated', 'true');
        }
        const _fee = _row.querySelector(`input[name="rows[${rowNum}][coordination_fee]"]`);
        if (_fee) {
            _fee.removeAttribute('data-custom-coordination-fee');
            _fee.removeAttribute('data-manually-edited');
            _fee.removeAttribute('data-loaded-from-db');
            _fee.setAttribute('data-attendance-updated', 'true');
        }
        _row.querySelectorAll(`input[name^="rows[${rowNum}][allowances]"]`).forEach(function(inp) {
            inp.removeAttribute('data-custom-allowance');
            inp.removeAttribute('data-manually-edited');
            inp.removeAttribute('data-loaded-from-db');
            inp.setAttribute('data-attendance-updated', 'true');
        });
    }

    calculateAttendanceAmount(rowNum, total).then(() => {
        calculateAllowances(rowNum, total);
        applyJobSettingsToRow(rowNum);
        calculateRowNet(rowNum);
    });
}

// Function to calculate attendance amount based on position salary and present days
// Coordinator Fee Calculation
function calculateCoordinatorFee(rowNum) {
    const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][amount]"])`);
    if (!row) return;

    // Get present days
    const attendanceTotalInput = row.querySelector(`input[name="rows[${rowNum}][attendance_total]"]`);
    const presentDays = parseFloat(attendanceTotalInput?.value) || 0;

    // Get default coordinator fee from selected job data
    const selectedJobId = document.getElementById('job_id').value;
    const selectedJob = jobs.find(job => job.id == selectedJobId);
    const defaultCoordinatorFee = selectedJob ? parseFloat(selectedJob.default_coordinator_fee) || 0 : 0;

    // Calculate coordinator fee: default_coordinator_fee * present_days
    const calculatedCoordinatorFee = defaultCoordinatorFee * presentDays;

    // Update the coordination fee field ONLY if it's not manually edited
    const coordinationFeeInput = row.querySelector(`input[name="rows[${rowNum}][coordination_fee]"]`);
    if (coordinationFeeInput) {
        const currentFee = parseFloat(coordinationFeeInput.value) || 0;
        const previousCalculatedFee = parseFloat(coordinationFeeInput.dataset.lastCalculatedFee || 0);
        const hasCustomFee = coordinationFeeInput.dataset.customCoordinationFee === 'true';
        const loadedFromDb = coordinationFeeInput.dataset.loadedFromDb === 'true';
        const manuallyEdited = coordinationFeeInput.dataset.manuallyEdited === 'true';
        const attendanceUpdated = coordinationFeeInput.dataset.attendanceUpdated === 'true';

        // Force update if attendance was just updated (custom fee should be cleared)
        // OR update if:
        // 1. Fee is empty/zero, OR
        // 2. Fee matches the previously calculated fee (meaning it was auto-calculated, not manually edited)
        // AND it doesn't have the custom-fee flag, wasn't loaded from DB, and wasn't manually edited
        if (attendanceUpdated || ((currentFee === 0 || currentFee === previousCalculatedFee) && !hasCustomFee && !loadedFromDb && !manuallyEdited)) {
            coordinationFeeInput.value = calculatedCoordinatorFee.toFixed(2);
            coordinationFeeInput.dataset.lastCalculatedFee = calculatedCoordinatorFee.toFixed(2);
            // Clear the attendance updated flag after updating
            if (attendanceUpdated) {
                coordinationFeeInput.removeAttribute('data-attendance-updated');
            }

            console.log(`Coordinator Fee Calculation for Row ${rowNum}:`, {
                presentDays: presentDays,
                defaultCoordinatorFee: defaultCoordinatorFee,
                calculatedCoordinatorFee: calculatedCoordinatorFee
            });
        }

        // Trigger row net calculation since coordinator fee might have changed
        calculateRowNet(rowNum);
    }
}

async function calculateAttendanceAmount(rowNum, presentDays) {
    const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][amount]"])`);
    if (!row) return;

    // Get the selected promoter's position ID
    const promoterSelect = row.querySelector(`select[name="rows[${rowNum}][promoter_id]"]`);
    if (!promoterSelect || !promoterSelect.value) {
        // Clear attendance amount if no promoter selected
        const attendanceAmountInput = row.querySelector(`input[name="rows[${rowNum}][attendance_amount]"]`);
        if (attendanceAmountInput) {
            attendanceAmountInput.value = '0.00';
        }

        // Also clear payment amount field
        const paymentAmountInput = row.querySelector(`input[name="rows[${rowNum}][amount]"]`);
        if (paymentAmountInput) {
            paymentAmountInput.value = '0.00';
        }

        // Clear coordinator fee when no promoter selected
        const coordinationFeeInput = row.querySelector(`input[name="rows[${rowNum}][coordination_fee]"]`);
        if (coordinationFeeInput) {
            coordinationFeeInput.value = '0.00';
        }

        calculateRowNet(rowNum);
        return;
    }

    // Get promoter data to find position ID
    const selectedOption = promoterSelect.options[promoterSelect.selectedIndex];
    const promoterId = selectedOption.value;

    // Find promoter in the promoters array to get position ID
    const promoter = promoters.find(p => p.id == promoterId);

    // Check if a position is selected from the row's dropdown (user may have assigned one manually)
    const positionSelect = row.querySelector(`select[name="rows[${rowNum}][position_id]"]`);
    const dropdownPositionId = positionSelect?.value && positionSelect.value !== 'custom' ? positionSelect.value : null;

    if (!promoter || (!promoter.position_id && !dropdownPositionId)) {
        const attendanceAmountInput = row.querySelector(`input[name="rows[${rowNum}][attendance_amount]"]`);
        if (attendanceAmountInput) {
            attendanceAmountInput.value = '0.00';
        }

        const paymentAmountInput = row.querySelector(`input[name="rows[${rowNum}][amount]"]`);
        if (paymentAmountInput) {
            paymentAmountInput.value = '0.00';
        }

        const coordinationFeeInput = row.querySelector(`input[name="rows[${rowNum}][coordination_fee]"]`);
        if (coordinationFeeInput) {
            coordinationFeeInput.value = '0.00';
        }

        calculateRowNet(rowNum);
        return;
    }

    // Ensure salary rules are loaded before calculating
    const selectedJobId = document.getElementById('job_id').value;
    if (selectedJobId && Object.keys(positionSalaryRules).length === 0) {
        console.log('Salary rules not loaded yet, loading now...');
        await loadPositionSalaryRules();
    }

    // Position from dropdown takes priority over promoter's default position
    let positionId = dropdownPositionId || (promoter ? promoter.position_id : null);

    // Get position salary from loaded rules
    const positionSalary = getPositionSalary(positionId);

    // Calculate attendance amount: position salary × present days
    const attendanceAmount = positionSalary * presentDays;

    // When no attendance days are recorded yet, use the base salary as the payment amount
    // so the user can see the salary from rules immediately after assigning a position.
    const effectiveAmount = (presentDays > 0) ? attendanceAmount : positionSalary;

    // Update the attendance amount field (always update this as it's calculated)
    const attendanceAmountInput = row.querySelector(`input[name="rows[${rowNum}][attendance_amount]"]`);
    if (attendanceAmountInput) {
        // Only update if it's empty or matches previous calculated value (preserve custom edits)
        const currentAttendanceAmount = parseFloat(attendanceAmountInput.value) || 0;
        const previousCalculatedAmount = parseFloat(attendanceAmountInput.dataset.lastCalculatedAmount || 0);

        // Only update if empty or matches previous calculation (not manually edited)
        if (currentAttendanceAmount === 0 || currentAttendanceAmount === previousCalculatedAmount) {
            attendanceAmountInput.value = attendanceAmount.toFixed(2);
            attendanceAmountInput.dataset.lastCalculatedAmount = attendanceAmount.toFixed(2);
        }
    }

    // Update the payment amount field ONLY if it's empty or was auto-synced (preserve custom edits)
    const paymentAmountInput = row.querySelector(`input[name="rows[${rowNum}][amount]"]`);
    if (paymentAmountInput) {
        const currentAmount = parseFloat(paymentAmountInput.value) || 0;
        const previousSyncedAmount = parseFloat(paymentAmountInput.dataset.lastSyncedAmount || 0);
        const hasCustomAmount = paymentAmountInput.dataset.customAmount === 'true';
        const loadedFromDb = paymentAmountInput.dataset.loadedFromDb === 'true';
        const manuallyEdited = paymentAmountInput.dataset.manuallyEdited === 'true';
        const attendanceUpdated = paymentAmountInput.dataset.attendanceUpdated === 'true';

        if (attendanceUpdated || ((currentAmount === 0 || currentAmount === previousSyncedAmount) && !hasCustomAmount && !loadedFromDb && !manuallyEdited)) {
            paymentAmountInput.value = effectiveAmount.toFixed(2);
            paymentAmountInput.dataset.lastSyncedAmount = effectiveAmount.toFixed(2);
            if (attendanceUpdated) {
                paymentAmountInput.removeAttribute('data-attendance-updated');
            }
        }

        // Calculate coordinator fee based on present days
        calculateCoordinatorFee(rowNum);

        // Trigger net calculation since amount might have changed
        calculateRowNet(rowNum);
    }
}

// Function to calculate allowances based on attendance when multiply_by_attendance is enabled
function calculateAllowances(rowNum, presentDays) {
    const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][amount]"])`);
    if (!row) return;

    // Get all allowance inputs in this row
    const allowanceInputs = row.querySelectorAll(`input[name^="rows[${rowNum}][allowances]"]`);

    allowanceInputs.forEach(input => {
        const multiplyByAttendance = input.dataset.multiplyByAttendance === 'true';
        const allowancePrice = parseFloat(input.dataset.allowancePrice || 0);
        const hasCustomValue = input.dataset.customAllowance === 'true';
        const loadedFromDb = input.dataset.loadedFromDb === 'true';
        const manuallyEdited = input.dataset.manuallyEdited === 'true';
        const attendanceUpdated = input.dataset.attendanceUpdated === 'true';

        // Only auto-calculate if multiply_by_attendance is enabled
        if (multiplyByAttendance) {
            const currentValue = parseFloat(input.value) || 0;
            const previousCalculatedValue = parseFloat(input.dataset.lastCalculatedValue || 0);
            const calculatedValue = presentDays * allowancePrice;

            // Force update if attendance was just updated (custom value should be cleared)
            // OR update if:
            // 1. Field hasn't been manually edited, AND
            // 2. Field is empty/zero OR matches previous calculated value (was auto-calculated)
            if (attendanceUpdated || (!hasCustomValue && !loadedFromDb && !manuallyEdited &&
                (currentValue === 0 || currentValue === previousCalculatedValue))) {
                input.value = calculatedValue.toFixed(2);
                input.dataset.lastCalculatedValue = calculatedValue.toFixed(2);
                // Clear the attendance updated flag after updating
                if (attendanceUpdated) {
                    input.removeAttribute('data-attendance-updated');
                }
            }
        }
    });
}

function calculateRowNet(rowNum) {
    const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][amount]"])`);
    const amount = parseFloat(row.querySelector(`input[name="rows[${rowNum}][amount]"]`).value) || 0;
    const expenses = parseFloat(row.querySelector(`input[name="rows[${rowNum}][expenses]"]`).value) || 0;
    const holdFor8Weeks = parseFloat(row.querySelector(`input[name="rows[${rowNum}][hold_for_8_weeks]"]`).value) || 0;
    const coordinationFee = parseFloat(row.querySelector(`input[name="rows[${rowNum}][coordination_fee]"]`).value) || 0;

    // Calculate total allowances
    let totalAllowances = 0;
    const allowanceInputs = row.querySelectorAll(`input[name^="rows[${rowNum}][allowances]"]`);
    allowanceInputs.forEach(input => {
        totalAllowances += parseFloat(input.value) || 0;
    });

    // Calculate net amount: Earnings + Expenses + Allowances - Deductions (excluding coordination fee)
    const totalEarnings = amount + expenses + totalAllowances;
    const totalDeductions = holdFor8Weeks;
    const netAmount = totalEarnings - totalDeductions;

    console.log(`Row ${rowNum} Net Calculation:`, {
        amount: amount,
        expenses: expenses,
        totalAllowances: totalAllowances,
        totalEarnings: totalEarnings,
        holdFor8Weeks: holdFor8Weeks,
        totalDeductions: totalDeductions,
        netAmount: netAmount,
        coordinationFee: coordinationFee // Note: coordination fee is tracked separately, not included in net calculation
    });

    row.querySelector(`input[name="rows[${rowNum}][net_amount]"]`).value = netAmount.toFixed(2);

    calculateGrandTotal();
}

// Helper function to sync attendance amount to payment amount field when manually edited
// Only syncs if amount field is empty or matches the previous attendance amount (to avoid overwriting custom values)
function updateAmountFromAttendance(rowNum) {
    const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][attendance_amount]"])`);
    if (!row) return;

    const attendanceAmountInput = row.querySelector(`input[name="rows[${rowNum}][attendance_amount]"]`);
    const amountInput = row.querySelector(`input[name="rows[${rowNum}][amount]"]`);

    if (attendanceAmountInput && amountInput) {
        // Only sync if amount field is empty or was previously synced (to preserve custom edits)
        // Check if amount is empty or matches the previous attendance amount
        const currentAmount = parseFloat(amountInput.value) || 0;
        const previousAttendanceAmount = parseFloat(amountInput.dataset.lastSyncedAmount || 0);
        const newAttendanceAmount = parseFloat(attendanceAmountInput.value) || 0;

        // Only sync if:
        // 1. Amount is empty/zero, OR
        // 2. Amount matches the previously synced attendance amount (meaning it was auto-synced, not manually edited)
        if (currentAmount === 0 || currentAmount === previousAttendanceAmount) {
            amountInput.value = newAttendanceAmount;
            amountInput.dataset.lastSyncedAmount = newAttendanceAmount;
        }
        // Otherwise, preserve the custom amount value
    }
}

// Alias for calculateRowNet to match the oninput handler
function calculateNetAmount(rowNum) {
    calculateRowNet(rowNum);
}

// Mark field as custom when user manually edits it
function markAsCustom(inputElement, fieldType) {
    if (fieldType === 'amount') {
        inputElement.dataset.customAmount = 'true';
        inputElement.dataset.manuallyEdited = 'true';
    } else if (fieldType === 'expenses') {
        inputElement.dataset.customExpenses = 'true';
        inputElement.dataset.manuallyEdited = 'true';
    } else if (fieldType === 'coordination_fee') {
        inputElement.dataset.customCoordinationFee = 'true';
        inputElement.dataset.manuallyEdited = 'true';
    }
}

// Mark allowance field as custom when user manually edits it
function markAllowanceAsCustom(inputElement, allowanceName) {
    inputElement.dataset.customAllowance = 'true';
    inputElement.dataset.manuallyEdited = 'true';
}

function calculateGrandTotal() {
    const rows = document.querySelectorAll('#promoterRows tr');
    let totalEarnings = 0;
    let totalDeductions = 0;

    console.log('=== GRAND TOTAL CALCULATION DEBUG ===');
    console.log('Found rows:', rows.length);

            rows.forEach((row, index) => {
                // Try multiple selector approaches to find inputs
                const amountInput = row.querySelector('input[name*="[amount]"]') || row.querySelector('input[name$="[amount]"]');
                const coordinationFeeInput = row.querySelector('input[name*="[coordination_fee]"]') || row.querySelector('input[name$="[coordination_fee]"]');
                const expensesInput = row.querySelector('input[name*="[expenses]"]') || row.querySelector('input[name$="[expenses]"]');
                const holdFor8WeeksInput = row.querySelector('input[name*="[hold_for_8_weeks]"]') || row.querySelector('input[name$="[hold_for_8_weeks]"]');

                const amount = parseFloat(amountInput?.value) || 0;
                const coordinationFee = parseFloat(coordinationFeeInput?.value) || 0;
                const expenses = parseFloat(expensesInput?.value) || 0;
                const holdFor8Weeks = parseFloat(holdFor8WeeksInput?.value) || 0;

                // Calculate total allowances for this row
                let totalAllowances = 0;
                const allowanceInputs = row.querySelectorAll('input[name*="[allowances]"]');
                allowanceInputs.forEach(input => {
                    totalAllowances += parseFloat(input.value) || 0;
                });

                const rowEarnings = amount + expenses + totalAllowances + coordinationFee;
                const rowDeductions = holdFor8Weeks;

                totalEarnings += rowEarnings;
                totalDeductions += rowDeductions;

                console.log(`Row ${index + 1} Details:`, {
                    amountInput: amountInput?.name || 'NOT FOUND',
                    amount: amount,
                    coordinationFeeInput: coordinationFeeInput?.name || 'NOT FOUND',
                    coordinationFee: coordinationFee,
                    expensesInput: expensesInput?.name || 'NOT FOUND',
                    expenses: expenses,
                    totalAllowances: totalAllowances,
                    holdFor8WeeksInput: holdFor8WeeksInput?.name || 'NOT FOUND',
                    holdFor8Weeks: holdFor8Weeks,
                    rowEarnings: rowEarnings,
                    rowDeductions: rowDeductions
                });
            });

    const netSalary = totalEarnings - totalDeductions;

    console.log('=== FINAL GRAND TOTAL ===', {
        totalEarnings: totalEarnings,
        totalDeductions: totalDeductions,
        netSalary: netSalary
    });

    document.getElementById('total-earnings').textContent = `Rs. ${totalEarnings.toFixed(2)}`;
    document.getElementById('total-deductions').textContent = `Rs. ${totalDeductions.toFixed(2)}`;
    document.getElementById('net-salary').textContent = `Rs. ${netSalary.toFixed(2)}`;
}

function generateSheetNumber() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const sheetNumber = `SAL/${year}/${month}/001`;
    document.getElementById('sheet_number').value = sheetNumber;
}

// Function to duplicate a promoter row
function duplicateRow(rowNum) {
    const jobSelect = document.getElementById('job_id');
    if (!jobSelect.value) {
        Swal.fire({
            icon: 'warning',
            title: 'Job Selection Required',
            text: 'Please select a job first before duplicating rows.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Find the source row
    const sourceRow = document.querySelector(`tr:has(input[name="rows[${rowNum}][promoter_id]"])`);
    if (!sourceRow) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Could not find the row to duplicate.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Get all data from the source row
    const sourcePromoterId = sourceRow.querySelector(`select[name="rows[${rowNum}][promoter_id]"]`)?.value || '';
    const sourcePromoterSearch = sourceRow.querySelector(`input[name="rows[${rowNum}][promoter_search]"]`)?.value || '';
    const sourcePromoterName = sourceRow.querySelector(`input[name="rows[${rowNum}][promoter_name]"]`)?.value || '';
    const sourcePositionId = sourceRow.querySelector(`select[name="rows[${rowNum}][position_id]"]`)?.value || '';
    const sourcePositionName = sourceRow.querySelector(`input[name="rows[${rowNum}][position]"]`)?.value || '';
    const sourceLocation = sourceRow.querySelector(`input[name="rows[${rowNum}][location]"]`)?.value || '';
    const sourceBankName = sourceRow.querySelector(`input[name="rows[${rowNum}][bank_name]"]`)?.value || '';
    const sourceBankBranch = sourceRow.querySelector(`input[name="rows[${rowNum}][bank_branch]"]`)?.value || '';
    const sourceBankAccount = sourceRow.querySelector(`input[name="rows[${rowNum}][bank_account_number]"]`)?.value || '';
    const sourceCoordinatorId = sourceRow.querySelector(`select[name="rows[${rowNum}][coordinator_id]"]`)?.value || '';
    const sourceCoordinatorSearch = sourceRow.querySelector(`input[name="rows[${rowNum}][coordinator_search]"]`)?.value || '';
    const sourceCoordinatorName = sourceRow.querySelector(`input[name="rows[${rowNum}][current_coordinator]"]`)?.value || '';
    const sourceCoordinationFee = sourceRow.querySelector(`input[name="rows[${rowNum}][coordination_fee]"]`)?.value || '';
    const sourceCoordinatorBankName = sourceRow.querySelector(`input[name="rows[${rowNum}][coordinator_bank_name]"]`)?.value || '';
    const sourceCoordinatorBankBranch = sourceRow.querySelector(`input[name="rows[${rowNum}][coordinator_bank_branch]"]`)?.value || '';
    const sourceCoordinatorBankAccount = sourceRow.querySelector(`input[name="rows[${rowNum}][coordinator_bank_account]"]`)?.value || '';
    const sourceAttendanceAmount = sourceRow.querySelector(`input[name="rows[${rowNum}][attendance_amount]"]`)?.value || '';
    const sourceAttendanceTotal = sourceRow.querySelector(`input[name="rows[${rowNum}][attendance_total]"]`)?.value || '';

    // Get attendance values for all dates
    const attendanceInputs = sourceRow.querySelectorAll(`input[name^="rows[${rowNum}][attendance]"]`);
    const attendanceData = {};
    attendanceInputs.forEach(input => {
        const name = input.name;
        const dateMatch = name.match(/\[attendance\]\[(.+?)\]/);
        if (dateMatch) {
            attendanceData[dateMatch[1]] = input.value || '0';
        }
    });

    // Get allowance values
    const allowanceData = {};
    const allowanceInputs = sourceRow.querySelectorAll(`input[name^="rows[${rowNum}][allowances]"]`);
    allowanceInputs.forEach(input => {
        const name = input.name;
        const allowanceMatch = name.match(/\[allowances\]\[(.+?)\]/);
        if (allowanceMatch) {
            allowanceData[allowanceMatch[1]] = input.value || '0';
        }
    });

    // Get payment values
    const sourceAmount = sourceRow.querySelector(`input[name="rows[${rowNum}][amount]"]`)?.value || '';
    const sourceExpenses = sourceRow.querySelector(`input[name="rows[${rowNum}][expenses]"]`)?.value || '';
    const sourceHoldFor8Weeks = sourceRow.querySelector(`input[name="rows[${rowNum}][hold_for_8_weeks]"]`)?.value || '';
    const sourceNetAmount = sourceRow.querySelector(`input[name="rows[${rowNum}][net_amount]"]`)?.value || '';

    // Add a new row
    const tbody = document.getElementById('promoterRows');
    const existingRows = tbody.querySelectorAll('tr');
    const nextRowNumber = existingRows.length + 1;

    // Generate attendance inputs based on current dates
    let attendanceInputsHTML = '';
    const numDates = currentAttendanceDates ? currentAttendanceDates.length : 0;
    if (currentAttendanceDates && currentAttendanceDates.length > 0) {
        attendanceInputsHTML = currentAttendanceDates.map(date =>
            `<input type="number" class="table-input-small" name="rows[${nextRowNumber}][attendance][${date}]" min="0" max="1" step="1" value="${attendanceData[date] || '0'}" onchange="calculateRowTotal(${nextRowNumber})" placeholder="0/1">`
        ).join('');
    }

    const attendanceWidth = numDates * 80 + 160;

    // Create the new row with duplicated data
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td style="text-align: center; font-weight: bold;">${nextRowNumber}</td>
        <td>
            <input type="text" class="table-input" name="rows[${nextRowNumber}][location]" value="${sourceLocation}" placeholder="Location">
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; position: relative;">
                <div style="position: relative;">
                    <input type="text" class="table-input-small" name="rows[${nextRowNumber}][promoter_search]" value="${sourcePromoterSearch}" placeholder="Search promoter by name/ID" oninput="handlePromoterSearchInput(${nextRowNumber}, this)" onfocus="showAllPromoters(${nextRowNumber}, this)" onblur="hidePromoterSuggestions(${nextRowNumber})">
                    <div id="promoterSuggestions-${nextRowNumber}" class="promoter-suggestions" style="display:none"></div>
                    <select class="table-input-small" name="rows[${nextRowNumber}][promoter_id]" onchange="updatePromoterDetails(${nextRowNumber}, this)" style="display:none">
                        <option value="">Select</option>
                        ${sourcePromoterId ? `<option value="${sourcePromoterId}" selected>${sourcePromoterSearch.split(' - ')[0] || ''}</option>` : ''}
                    </select>
                </div>
                <input type="text" class="table-input-small table-input-readonly promoter-tooltip" name="rows[${nextRowNumber}][promoter_name]" readonly value="${sourcePromoterName}" data-tooltip="">
                <select class="table-input-small" name="rows[${nextRowNumber}][position_id]" id="positionSelect-${nextRowNumber}" onchange="updatePositionFromDropdown(${nextRowNumber}, this)">
                    <option value="">Select Position</option>
                </select>
                <input type="hidden" name="rows[${nextRowNumber}][position]" id="positionName-${nextRowNumber}" value="${sourcePositionName}">
            </div>
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${nextRowNumber}][bank_name]" readonly placeholder="Bank Name" value="${sourceBankName}">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${nextRowNumber}][bank_branch]" readonly placeholder="Bank Branch" value="${sourceBankBranch}">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${nextRowNumber}][bank_account_number]" readonly placeholder="Bank Number" value="${sourceBankAccount}">
            </div>
        </td>
        <td id="attendanceCell-${nextRowNumber}" style="display: table-cell; width: ${attendanceWidth}px;">
            <div style="display: grid; grid-template-columns: repeat(${numDates}, 1fr) 1fr 1.5fr; gap: 0.75rem; width: ${attendanceWidth}px;">
                ${attendanceInputsHTML}
                <input type="number" class="table-input-small" name="rows[${nextRowNumber}][attendance_total]" min="0" step="0.1" placeholder="0" value="${sourceAttendanceTotal}" oninput="onAttendanceTotalManualChange(${nextRowNumber}, this)">
                <input type="number" step="0.01" class="table-input-small" name="rows[${nextRowNumber}][attendance_amount]" value="${sourceAttendanceAmount}" title="Attendance Amount (Auto-calculated, but editable)" oninput="calculateNetAmount(${nextRowNumber})">
            </div>
        </td>
        <td id="paymentCell-${nextRowNumber}">
            ${generatePaymentRowHTML(nextRowNumber, getCurrentJobAllowances(), {
                amount: sourceAmount,
                expenses: sourceExpenses,
                hold_for_8_weeks: sourceHoldFor8Weeks,
                net_amount: sourceNetAmount,
                ...allowanceData
            })}
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; position: relative;">
                <div style="position: relative;">
                    <input type="text" class="table-input-small" name="rows[${nextRowNumber}][coordinator_search]" value="${sourceCoordinatorSearch}" placeholder="Search coordinator by name/ID" oninput="handleCoordinatorSearchInput(${nextRowNumber}, this)" onfocus="showAllCoordinators(${nextRowNumber}, this)" onblur="hideCoordinatorSuggestions(${nextRowNumber})">
                    <div id="coordinatorSuggestions-${nextRowNumber}" class="coordinator-suggestions" style="display:none"></div>
                    <select class="table-input-small" name="rows[${nextRowNumber}][coordinator_id]" onchange="updateCoordinatorDisplay(${nextRowNumber}, this)" style="display:none">
                        <option value="">Select</option>
                        ${sourceCoordinatorId ? `<option value="${sourceCoordinatorId}" selected>${sourceCoordinatorSearch.split(' - ')[0] || ''}</option>` : ''}
                    </select>
                </div>
                <input type="text" class="table-input-small table-input-readonly" name="rows[${nextRowNumber}][current_coordinator]" readonly value="${sourceCoordinatorName}">
                <input type="number" step="0.01" class="table-input-small" name="rows[${nextRowNumber}][coordination_fee]" value="${sourceCoordinationFee}" title="Coordination Fee (Auto-calculated, but editable)" oninput="markAsCustom(this, 'coordination_fee'); calculateRowNet(${nextRowNumber})" placeholder="0.00">
            </div>
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankName-${nextRowNumber}" name="rows[${nextRowNumber}][coordinator_bank_name]" readonly placeholder="Bank Name" value="${sourceCoordinatorBankName}">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankBranch-${nextRowNumber}" name="rows[${nextRowNumber}][coordinator_bank_branch]" readonly placeholder="Bank Branch" value="${sourceCoordinatorBankBranch}">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankAccount-${nextRowNumber}" name="rows[${nextRowNumber}][coordinator_bank_account]" readonly placeholder="Account No." value="${sourceCoordinatorBankAccount}">
            </div>
        </td>
        <td>
            <div style="display: flex; gap: 0.25rem; justify-content: center;">
                <button type="button" class="btn-duplicate" onclick="duplicateRow(${nextRowNumber})" title="Duplicate this promoter">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                </button>
                <button type="button" class="btn-danger" onclick="removeRow(${nextRowNumber})" title="Remove this row">×</button>
            </div>
        </td>
    `;

    tbody.appendChild(newRow);

    // Update row counter
    rowCounter = nextRowNumber;

    // Populate position dropdown and set the position
    setTimeout(() => {
        populatePositionDropdown(nextRowNumber);
        if (sourcePositionId) {
            setTimeout(() => {
                const positionSelect = document.getElementById(`positionSelect-${nextRowNumber}`);
                if (positionSelect) {
                    positionSelect.value = sourcePositionId;
                    updatePositionFromDropdown(nextRowNumber, positionSelect);
                }
            }, 150);
        }

        // Update promoter tooltip if promoter is selected
        if (sourcePromoterId) {
            const promoterSelect = newRow.querySelector(`select[name="rows[${nextRowNumber}][promoter_id]"]`);
            if (promoterSelect && promoterSelect.value) {
                updatePromoterDetails(nextRowNumber, promoterSelect);
            }
        }

        // Update coordinator display if coordinator is selected
        if (sourceCoordinatorId) {
            const coordinatorSelect = newRow.querySelector(`select[name="rows[${nextRowNumber}][coordinator_id]"]`);
            if (coordinatorSelect && coordinatorSelect.value) {
                updateCoordinatorDisplay(nextRowNumber, coordinatorSelect);
            }
        }

        // Recalculate totals
        calculateRowTotal(nextRowNumber);
        calculateRowNet(nextRowNumber);
        calculateGrandTotal();
    }, 200);

    // Scroll to the new row
    newRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
    
    // Highlight the new row briefly
    const originalBg = newRow.style.backgroundColor;
    newRow.style.transition = 'background-color 0.6s ease';
    newRow.style.backgroundColor = '#dbeafe';
    setTimeout(() => {
        newRow.style.backgroundColor = originalBg || '';
    }, 1200);

    Swal.fire({
        icon: 'success',
        title: 'Row Duplicated',
        text: 'Promoter row has been duplicated. You can now change the position if needed.',
        timer: 2000,
        showConfirmButton: false
    });
}

function removeRow(rowNum) {
    Swal.fire({
        title: 'Delete Promoter Row',
        text: 'Are you sure you want to delete this promoter row?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][amount]"])`);
            if (row) {
                row.remove();
                calculateGrandTotal();

                // Update promoter dropdowns after removing a row
                updatePromoterDropdowns();

                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Promoter row has been deleted successfully.',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        }
    });
}

// Load existing salary sheet rows from passed data (used when editing)
function loadExistingSalarySheetsFromData(sheets) {
    clearAllRows();
    if (sheets && sheets.length > 0) {
        sheets.forEach(function(sheet, index) {
            loadSalarySheetAsRow(sheet, index);
        });
    }
    calculateGrandTotal();
}

// Function to load existing salary sheet data for a job
function loadExistingSalarySheets(jobId) {
    if (!jobId) {
        clearAllRows();
        return;
    }

    // Show loading state
    const tbody = document.getElementById('promoterRows');
    tbody.innerHTML = '<tr><td colspan="9" style="text-align: center; padding: 2rem; color: #6b7280;"><div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 11-6.219-8.56"></path></svg>Loading salary sheets...</div></td></tr>';

    // Fetch existing salary sheets for this job
    fetch(`/admin/salary-sheets/by-job/${jobId}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.salarySheets && data.salarySheets.length > 0) {
            // Extract all unique dates from attendance_data in all salary sheets
            const allDates = new Set();

            // Add dates from job date range (if available)
            const jobHiddenEl = document.getElementById('job_id');
            if (jobHiddenEl && jobHiddenEl.value) {
                const startDate = jobHiddenEl.getAttribute('data-start-date');
                const endDate = jobHiddenEl.getAttribute('data-end-date');
                if (startDate && endDate) {
                    const jobDates = generateDateRange(startDate, endDate);
                    jobDates.forEach(date => allDates.add(date));
                }
            }

            // Extract dates from all salary sheet items' attendance_data
            data.salarySheets.forEach(sheet => {
                if (sheet.items && Array.isArray(sheet.items)) {
                    sheet.items.forEach(item => {
                        if (item.attendance_data && item.attendance_data.attendance) {
                            Object.keys(item.attendance_data.attendance).forEach(date => {
                                allDates.add(date);
                            });
                        }
                    });
                }
                // Also check if sheet has direct attendance_data (for backward compatibility)
                if (sheet.attendance_data && typeof sheet.attendance_data === 'object') {
                    if (sheet.attendance_data.attendance) {
                        Object.keys(sheet.attendance_data.attendance).forEach(date => {
                            allDates.add(date);
                        });
                    } else {
                        // Direct date keys
                        Object.keys(sheet.attendance_data).forEach(date => {
                            if (date.match(/^\d{4}-\d{2}-\d{2}$/)) {
                                allDates.add(date);
                            }
                        });
                    }
                }
            });

            // Convert Set to sorted array
            const allDatesArray = Array.from(allDates).sort();

            // Update currentAttendanceDates with all dates (including custom ones)
            if (allDatesArray.length > 0) {
                currentAttendanceDates = allDatesArray;
                updateAttendanceHeaders(currentAttendanceDates);
            }

            // Clear existing rows
            clearAllRows();

            // Load each salary sheet item as a row
            let rowIndex = 0;
            data.salarySheets.forEach(sheet => {
                if (sheet.items && Array.isArray(sheet.items) && sheet.items.length > 0) {
                    // If sheet has items, load each item as a row
                    sheet.items.forEach(item => {
                        // Transform item data to match expected structure
                        const rowData = {
                            promoter_id: item.attendance_data?.promoter_id || item.promoter_id,
                            position_id: item.position_id || null, // Include saved position_id
                            position_name: item.position?.position_name || item.attendance_data?.position || null,
                            current_coordinator_id: item.coordinator_details ?
                                (() => {
                                    // Find coordinator by coordinator_id
                                    const coord = coordinators.find(c => c.coordinator_id === item.coordinator_details.coordinator_id);
                                    return coord ? coord.id : null;
                                })() : null,
                            location: item.location || sheet.location,
                            attendance_data: item.attendance_data?.attendance || {},
                            attendance_total: item.attendance_data?.total || 0,
                            attendance_amount: item.attendance_data?.amount || 0,
                            basic_salary: item.payment_data?.amount || 0,
                            expenses: item.payment_data?.expenses || 0,
                            hold_for_8_weeks: item.payment_data?.hold_for_weeks || 0,
                            net_salary: item.payment_data?.net_amount || 0,
                            coordination_fee: item.coordinator_details?.amount || 0
                        };
                        loadSalarySheetAsRow(rowData, rowIndex);
                        rowIndex++;
                    });
                } else {
                    // Fallback: load sheet directly as a row (for backward compatibility)
                    loadSalarySheetAsRow(sheet, rowIndex);
                    rowIndex++;
                }
            });

            // Recalculate allowances for rows with multiply_by_attendance enabled
            setTimeout(() => {
                const rows = document.querySelectorAll('#promoterRows tr');
                rows.forEach((row, idx) => {
                    const rowNum = idx + 1;
                    const attendanceTotalInput = row.querySelector(`input[name="rows[${rowNum}][attendance_total]"]`);
                    if (attendanceTotalInput) {
                        const presentDays = parseFloat(attendanceTotalInput.value) || 0;
                        calculateAllowances(rowNum, presentDays);
                    }
                });
            }, 100);

            // Update grand total
            calculateGrandTotal();

            Swal.fire({
                icon: 'success',
                title: 'Data Loaded',
                text: `Loaded ${data.salarySheets.length} salary sheet(s) for this job.`,
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            // No existing data, just clear rows
            clearAllRows();
            addPromoterRow(); // Add one empty row
        }
    })
    .catch(error => {
        console.error('Error loading salary sheets:', error);
        clearAllRows();
        addPromoterRow(); // Add one empty row
    });
}

// Function to load a single salary sheet as a table row
function loadSalarySheetAsRow(sheet, index) {
    const tbody = document.getElementById('promoterRows');
    const row = document.createElement('tr');

    // Get promoter data
    const promoterId = sheet.promoter_id || sheet.attendance_data?.promoter_id;
    const promoter = promoters.find(p => p.id == promoterId);
    const promoterName = promoter ? promoter.promoter_name : (sheet.attendance_data?.promoter_name || 'Unknown');

    // Get position from saved data (item.position_id) or fallback to promoter's position
    const savedPositionId = sheet.position_id || (promoter && promoter.position_id ? promoter.position_id : null);
    const positionName = sheet.position_name || sheet.attendance_data?.position || (promoter && promoter.position ? promoter.position.position_name : 'No Position');

    const bankName = promoter ? (promoter.bank_name || '') : '';
    const bankBranch = promoter ? (promoter.bank_branch_name || '') : '';
    const bankAccount = promoter ? (promoter.bank_account_number || '') : '';

    // Get coordinator data
    const coordinator = coordinators.find(c => c.id == sheet.current_coordinator_id);
    const coordinatorName = coordinator ? coordinator.coordinator_name : '';

    // Build attendance inputs based on current attendance dates
    let attendanceInputs = '';
    const numDates = currentAttendanceDates ? currentAttendanceDates.length : 0;

    if (currentAttendanceDates && currentAttendanceDates.length > 0) {
        currentAttendanceDates.forEach(date => {
            // Check if attendance_data is an object with 'attendance' property or direct date keys
            let attendanceValue = 0;
            if (sheet.attendance_data) {
                if (sheet.attendance_data.attendance && typeof sheet.attendance_data.attendance === 'object') {
                    // Structure: { attendance: { date: value } }
                    attendanceValue = sheet.attendance_data.attendance[date] || 0;
                } else if (sheet.attendance_data[date] !== undefined) {
                    // Structure: { date: value } - direct date keys
                    attendanceValue = sheet.attendance_data[date] || 0;
                }
            }
            attendanceInputs += `<input type="number" class="table-input-small" name="rows[${index}][attendance][${date}]" value="${attendanceValue}" min="0" max="1" step="0.01" onchange="calculateRowTotal(${index})">`;
        });
    }
    // If no dates, don't add any attendance inputs (empty columns)

    const attendanceWidth = numDates * 80 + 160; // Base width for Total and Amount columns

    row.innerHTML = `
        <td style="text-align: center; font-weight: 600; background-color: #f8fafc;">${index + 1}</td>
        <td>
            <input type="text" class="table-input" name="rows[${index}][location]" value="${sheet.location || ''}" placeholder="Location">
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; position: relative;">
                <div style="position: relative;">
                    <input type="text" class="table-input-small" name="rows[${index}][promoter_search]" placeholder="Search promoter by name/ID" value="${promoter ? promoter.promoter_id + ' - ' + promoter.promoter_name : (promoterName !== 'Unknown' ? promoterName : '')}" oninput="handlePromoterSearchInput(${index}, this)" onfocus="showAllPromoters(${index}, this)" onblur="hidePromoterSuggestions(${index})">
                    <div id="promoterSuggestions-${index}" class="promoter-suggestions" style="display:none"></div>
                    <select class="table-input-small" name="rows[${index}][promoter_id]" onchange="updatePromoterDetails(${index}, this)" style="display:none">
                        <option value="">Select</option>
                        ${promoter ? `<option value="${promoter.id}" selected
                                data-name="${promoter.promoter_name}"
                                data-position="${positionName}"
                                data-phone="${promoter.phone_no || ''}"
                                data-id-card="${promoter.identity_card_no || ''}"
                                data-bank="${promoter.bank_name || ''}"
                                data-branch="${promoter.bank_branch_name || ''}"
                                data-account="${promoter.bank_account_number || ''}"
                                data-status="${promoter.status || 'inactive'}"
                                data-position-id="${savedPositionId || promoter.position_id || ''}">${promoter.promoter_id}</option>` : ''}
                    </select>
                </div>
                <input type="text" class="table-input-small table-input-readonly promoter-tooltip" name="rows[${index}][promoter_name]" readonly value="${promoterName}" data-tooltip="">
                <select class="table-input-small" name="rows[${index}][position_id]" id="positionSelect-${index}" onchange="updatePositionFromDropdown(${index}, this)">
                    <option value="">Select Position</option>
                </select>
                <input type="hidden" name="rows[${index}][position]" id="positionName-${index}" value="${positionName}">
            </div>
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${index}][bank_name]" readonly placeholder="Bank Name" value="${bankName}">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${index}][bank_branch]" readonly placeholder="Bank Branch" value="${bankBranch}">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${index}][bank_account_number]" readonly placeholder="Bank Number" value="${bankAccount}">
            </div>
        </td>
        <td id="attendanceCell-${index}" style="display: table-cell; width: ${attendanceWidth}px;">
            <div style="display: grid; grid-template-columns: repeat(${numDates}, 1fr) 1fr 1.5fr; gap: 0.75rem; width: ${attendanceWidth}px;">
                ${attendanceInputs}
                <input type="number" class="table-input-small" name="rows[${index}][attendance_total]" min="0" step="0.1" placeholder="0" value="${sheet.attendance_total || 0}" oninput="onAttendanceTotalManualChange(${index}, this)">
                <input type="number" step="0.01" class="table-input-small" name="rows[${index}][attendance_amount]" value="${sheet.attendance_amount || 0}" title="Attendance Amount (Auto-calculated, but editable)" oninput="calculateNetAmount(${index})">
            </div>
        </td>
        <td id="paymentCell-${index}">
            ${generatePaymentRowHTML(index, getCurrentJobAllowances(), {
                amount: sheet.basic_salary || 0,
                expenses: sheet.expenses || 0,
                hold_for_8_weeks: sheet.hold_for_8_weeks || 0,
                net_amount: sheet.net_salary || 0
            })}
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; position: relative;">
                <div style="position: relative;">
                    <input type="text" class="table-input-small" name="rows[${index}][coordinator_search]" placeholder="Search coordinator by name/ID" value="${coordinator ? coordinator.coordinator_id + ' - ' + coordinator.coordinator_name : ''}" oninput="handleCoordinatorSearchInput(${index}, this)" onfocus="showAllCoordinators(${index}, this)" onblur="hideCoordinatorSuggestions(${index})">
                    <div id="coordinatorSuggestions-${index}" class="coordinator-suggestions" style="display:none"></div>
                    <select class="table-input-small" name="rows[${index}][coordinator_id]" onchange="updateCoordinatorDisplay(${index}, this)" style="display:none">
                        <option value="">Select</option>
                        ${coordinator ? `<option value="${coordinator.id}" selected data-name="${coordinator.coordinator_name}">${coordinator.coordinator_id}</option>` : ''}
                    </select>
                </div>
                <input type="text" class="table-input-small table-input-readonly" name="rows[${index}][coordinator_name]" readonly value="${coordinatorName}">
                <input type="number" step="0.01" class="table-input-small" name="rows[${index}][coordination_fee]" title="Coordination Fee (Auto-calculated, but editable)" oninput="markAsCustom(this, 'coordination_fee'); calculateRowNet(${index})" value="${sheet.coordination_fee || 0}" ${sheet.coordination_fee ? 'data-custom-coordination-fee="true" data-loaded-from-db="true"' : ''}>
            </div>
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankName-${index}" name="rows[${index}][coordinator_bank_name]" readonly placeholder="Bank Name" value="${coordinator ? (coordinator.bank_name || '') : ''}">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankBranch-${index}" name="rows[${index}][coordinator_bank_branch]" readonly placeholder="Bank Branch" value="${coordinator ? (coordinator.bank_branch_name || '') : ''}">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankAccount-${index}" name="rows[${index}][coordinator_bank_account]" readonly placeholder="Account No." value="${coordinator ? (coordinator.account_number || '') : ''}">
            </div>
        </td>
        <td>
            <div style="display: flex; gap: 0.25rem; justify-content: center;">
                <button type="button" class="btn-duplicate" onclick="duplicateRow(${index})" title="Duplicate this promoter">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                </button>
                <button type="button" class="btn-danger" onclick="removeRow(${index})" title="Remove this row">×</button>
            </div>
        </td>
    `;

    tbody.appendChild(row);

    // Populate position dropdown after row is created
    setTimeout(() => {
        populatePositionDropdown(index);
        // Try to set position from saved data or promoter
        const positionSelect = document.getElementById(`positionSelect-${index}`);
        if (positionSelect && savedPositionId) {
            // Wait a bit for dropdown to be populated
            setTimeout(() => {
                positionSelect.value = savedPositionId;
                updatePositionFromDropdown(index, positionSelect);
            }, 150);
        }
    }, 200);

    // Update tooltip for promoter name
    if (promoter) {
        const promoterNameInput = row.querySelector('input[name="rows[' + index + '][promoter_name]"]');
        updatePromoterTooltipFromOption(promoterNameInput, row.querySelector('select[name="rows[' + index + '][promoter_id]"] option:checked'));
    }
}

// Function to clear all rows
function clearAllRows() {
    const tbody = document.getElementById('promoterRows');
    tbody.innerHTML = '';
    rowCounter = 1;

    // Reset auto-pull flag when clearing rows
    hasAutoPulledData = false;
}


function saveSalarySheet() {
    console.log('=== SAVE SALARY SHEET FUNCTION CALLED ===');
    console.log('Save function called'); // Debug log

    // Open the modal instead of directly submitting
    openSalarySheetSaveModal();
}

// Add first row automatically, or load existing rows when editing
document.addEventListener('DOMContentLoaded', function() {
    if (isEditMode && jobSalarySheetsData && jobSalarySheetsData.length > 0) {
        const jobHidden = document.getElementById('job_id');
        const noJobMessage = document.getElementById('noJobMessage');
        const salaryTableContainer = document.getElementById('salaryTableContainer');
        const addPromoterBtn = document.getElementById('addPromoterBtn');
        const salaryRuleBtn = document.getElementById('salaryRuleBtn');
        const allowanceRuleBtn = document.getElementById('allowanceRuleBtn');
        const attendanceLegend = document.getElementById('attendanceLegend');
        if (jobHidden && jobHidden.value) {
            // Build attendance date set: sheet date range + any dates saved in attendance_data
            const allDates = new Set();
            const sheetStart = document.getElementById('sheet_start_date')?.value;
            const sheetEnd   = document.getElementById('sheet_end_date')?.value;
            if (sheetStart && sheetEnd && sheetEnd >= sheetStart) {
                generateDateRange(sheetStart, sheetEnd).forEach(d => allDates.add(d));
            }
            // Also pull dates from the saved attendance records (handles custom dates and sheets without date range)
            jobSalarySheetsData.forEach(function(sheet) {
                const atd = sheet.attendance_data;
                if (atd && typeof atd === 'object') {
                    const src = (atd.attendance && typeof atd.attendance === 'object') ? atd.attendance : atd;
                    Object.keys(src).forEach(function(d) {
                        if (/^\d{4}-\d{2}-\d{2}$/.test(d)) allDates.add(d);
                    });
                }
            });
            if (allDates.size > 0) {
                currentAttendanceDates = Array.from(allDates).sort();
                updateAttendanceHeaders(currentAttendanceDates);
                // Auto-fill start/end date inputs if they are blank (DB value was null)
                const startInput = document.getElementById('sheet_start_date');
                const endInput   = document.getElementById('sheet_end_date');
                if (startInput && !startInput.value) startInput.value = currentAttendanceDates[0];
                if (endInput   && !endInput.value)   endInput.value   = currentAttendanceDates[currentAttendanceDates.length - 1];
            }
            loadPositionSalaryRules().then(() => {
                loadExistingSalarySheetsFromData(jobSalarySheetsData);
                const rows = document.querySelectorAll('#promoterRows tr');
                rows.forEach((row, idx) => { if (typeof populatePositionDropdown === 'function') populatePositionDropdown(idx + 1); });
                if (typeof updatePaymentHeaders === 'function') updatePaymentHeaders(getCurrentJobAllowances());
                calculateGrandTotal();
            });
        }
        if (noJobMessage) noJobMessage.style.display = 'none';
        if (salaryTableContainer) salaryTableContainer.style.display = 'block';
        if (attendanceLegend) attendanceLegend.style.display = (currentAttendanceDates && currentAttendanceDates.length) ? 'block' : 'none';
        if (addPromoterBtn) addPromoterBtn.disabled = false;
                const bulkBtn = document.getElementById('bulkAddRowsBtn'); if (bulkBtn) bulkBtn.disabled = false;
        if (salaryRuleBtn) salaryRuleBtn.disabled = false;
        if (allowanceRuleBtn) allowanceRuleBtn.disabled = false;
        setTimeout(function() { if (typeof initializeHorizontalScroll === 'function') initializeHorizontalScroll(); }, 100);
    } else {
        // Try to restore a previously selected job from sessionStorage (e.g. after page refresh).
        // scRestoreJob() is deferred to here so that all `let` variables are initialized (no TDZ).
        const restoredFromSession = scRestoreJob();
        if (restoredFromSession) {
            // Job was restored — trigger updateAttendanceDates to show picker / table
            updateAttendanceDates();
        } else {
            // Fresh create page — set up a blank row and generate a sheet number
            addPromoterRow();
            generateSheetNumber();
        }
    }

    // Add event listeners for allowance modal
    const addAllowanceRowBtn = document.getElementById('addAllowanceRowBtn');
    const allowanceRuleCloseBtn = document.getElementById('allowanceRuleCloseBtn');
    if (addAllowanceRowBtn) addAllowanceRowBtn.addEventListener('click', addAllowanceRow);
    if (allowanceRuleCloseBtn) allowanceRuleCloseBtn.addEventListener('click', closeAllowanceRuleModal);

    // Handle modal background click to close
    document.addEventListener('click', function(e) {
        if (e.target.id === 'allowanceRuleModal') {
            closeAllowanceRuleModal();
        }
    });
});

// Reposition portal on scroll/resize if visible
window.addEventListener('scroll', () => {
    if (promoterSuggestionsPortalEl && promoterSuggestionsPortalEl.style.display === 'block' && promoterSuggestionsActiveAnchor) {
        positionPromoterPortal(promoterSuggestionsActiveAnchor);
    }
}, true);

window.addEventListener('resize', () => {
    if (promoterSuggestionsPortalEl && promoterSuggestionsPortalEl.style.display === 'block' && promoterSuggestionsActiveAnchor) {
        positionPromoterPortal(promoterSuggestionsActiveAnchor);
    }
});

// JSON Import Functions
function openJsonImportModal() {
    document.getElementById('jsonImportModal').style.display = 'block';
    document.getElementById('jsonDataTextarea').focus();
}

function closeJsonImportModal() {
    document.getElementById('jsonImportModal').style.display = 'none';
    document.getElementById('jsonDataTextarea').value = '';
    document.getElementById('jsonImportStatus').style.display = 'none';
}

function importJsonData() {
    const jsonText = document.getElementById('jsonDataTextarea').value.trim();

    if (!jsonText) {
        showJsonStatus('Please paste JSON data first.', 'error');
        return;
    }

    try {
        const jsonData = JSON.parse(jsonText);
        console.log('Parsed JSON data:', jsonData);

        // Validate required fields
        if (!jsonData.job_id || !jsonData.status) {
            showJsonStatus('JSON must contain job_id and status fields.', 'error');
            return;
        }

        // Update form fields
        updateFormFields(jsonData);

        // Update table rows
        updateTableRows(jsonData);

        showJsonStatus('JSON data imported successfully!', 'success');

        // Close modal after a short delay
        setTimeout(() => {
            closeJsonImportModal();
        }, 1500);

    } catch (error) {
        console.error('JSON parsing error:', error);
        showJsonStatus('Invalid JSON format. Please check your data.', 'error');
    }
}

function showJsonStatus(message, type) {
    const statusDiv = document.getElementById('jsonImportStatus');
    statusDiv.style.display = 'block';
    statusDiv.textContent = message;
    statusDiv.style.backgroundColor = type === 'success' ? '#d4edda' : '#f8d7da';
    statusDiv.style.color = type === 'success' ? '#155724' : '#721c24';
    statusDiv.style.border = `1px solid ${type === 'success' ? '#c3e6cb' : '#f5c6cb'}`;
}

function updateFormFields(jsonData) {
    console.log('Updating form fields with:', jsonData);

    // Update main form fields
    if (jsonData.sheet_number) {
        document.getElementById('sheet_number').value = jsonData.sheet_number;
    }

    if (jsonData.job_id) {
        const jobSelect = document.getElementById('job_id');
        const currentJobId = jobSelect.value;
        // Only update if job_id is different to prevent infinite loop
        if (currentJobId !== jsonData.job_id.toString()) {
            jobSelect.value = jsonData.job_id;
            // Trigger job change to update attendance dates
            updateAttendanceDates();
        }
    }

    if (jsonData.status) {
        const _sLabels = {draft:'Draft',complete:'Complete',reject:'Reject',approve:'Approve',paid:'Paid'};
        selectStatusOption(jsonData.status, _sLabels[jsonData.status] || jsonData.status);
    }

    if (jsonData.location) {
        const locationInput = document.querySelector('input[name="location"]');
        if (locationInput) {
            locationInput.value = jsonData.location;
        }
    }

    if (jsonData.notes) {
        const notesTextarea = document.querySelector('textarea[name="notes"]');
        if (notesTextarea) {
            notesTextarea.value = jsonData.notes;
        }
    }

    // Add hidden input for salary sheet ID if it exists (for updates)
    if (jsonData.salary_sheet_id) {
        let existingInput = document.getElementById('salary_sheet_id');
        if (existingInput) {
            existingInput.value = jsonData.salary_sheet_id;
        } else {
            let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
            hiddenInput.id = 'salary_sheet_id';
            hiddenInput.name = 'salary_sheet_id';
            hiddenInput.value = jsonData.salary_sheet_id;
            document.querySelector('form').appendChild(hiddenInput);
        }
    }
}

function updateTableRows(jsonData) {
    console.log('Updating table rows with:', jsonData.rows);

    if (!jsonData.rows || typeof jsonData.rows !== 'object') {
        console.log('No rows data found in JSON');
        return;
    }

    // Clear existing rows
    clearAllRows();

    // Add rows based on JSON data
    let rowIndex = 0;
    for (const [rowKey, rowData] of Object.entries(jsonData.rows)) {
        console.log(`Processing row ${rowKey}:`, rowData);

        if (rowData.promoter_id) {
            addPromoterRowFromJson(rowData, rowIndex);
            rowIndex++;
        }
    }

    // Update grand total after all rows are processed and calculations are done
    setTimeout(() => {
        console.log('Updating grand total after all rows processed...');
        // Recalculate allowances for rows with multiply_by_attendance enabled
        const rows = document.querySelectorAll('#promoterRows tr');
        rows.forEach((row, idx) => {
            const rowNum = idx + 1;
            const attendanceTotalInput = row.querySelector(`input[name="rows[${rowNum}][attendance_total]"]`);
            if (attendanceTotalInput) {
                const presentDays = parseFloat(attendanceTotalInput.value) || 0;
                calculateAllowances(rowNum, presentDays);
            }
        });
        calculateGrandTotal();
        updatePromoterDropdowns(); // Update dropdowns after all rows are added
        console.log('Grand total updated after pulling data');
    }, 200);
}

function addPromoterRowFromJson(rowData, index) {
    console.log(`Adding promoter row ${index} with data:`, rowData);

    const tbody = document.getElementById('promoterRows');
    const row = document.createElement('tr');

    // Generate attendance inputs based on currentAttendanceDates (to match headers)
    let attendanceInputs = '';
    const numDates = currentAttendanceDates ? currentAttendanceDates.length : 0;

    if (currentAttendanceDates && currentAttendanceDates.length > 0) {
        attendanceInputs = currentAttendanceDates.map(date => {
            const attendanceValue = rowData.attendance && rowData.attendance[date] !== undefined ? rowData.attendance[date] : 0;
            return `<input type="number" class="table-input-small" name="rows[${index + 1}][attendance][${date}]" min="0" max="1" step="1" onchange="calculateRowTotal(${index + 1})" placeholder="0/1" value="${attendanceValue}">`;
        }).join('');
    }
    // If no dates, don't add any attendance inputs (empty columns)

    const attendanceWidth = numDates * 80 + 160; // Base width for Total and Amount columns

    const jsonCoordinator = rowData.coordinator_id ? coordinators.find(c => c.id == rowData.coordinator_id) : null;

    row.innerHTML = `
        <td style="text-align: center; font-weight: bold;">${index + 1}</td>
        <td>
            <input type="text" class="table-input" name="rows[${index + 1}][location]" placeholder="Location" value="${rowData.location || ''}">
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; position: relative;">
                <div style="position: relative;">
                    <input type="text" class="table-input-small" name="rows[${index + 1}][promoter_search]" placeholder="Search promoter by name/ID" value="${rowData.promoter_id && rowData.promoter_name ? rowData.promoter_id + ' - ' + rowData.promoter_name : ''}" oninput="handlePromoterSearchInput(${index + 1}, this)" onfocus="showAllPromoters(${index + 1}, this)" onblur="hidePromoterSuggestions(${index + 1})">
                    <div id="promoterSuggestions-${index + 1}" class="promoter-suggestions" style="display:none"></div>
                    <select class="table-input-small" name="rows[${index + 1}][promoter_id]" onchange="updatePromoterDetails(${index + 1}, this)" style="display:none">
                        <option value="">Select</option>
                        ${rowData.promoter_id ? promoters.map(promoter => {
                            const positionName = promoter.position ? promoter.position.position_name : 'No Position';
                            const selected = promoter.id == rowData.promoter_id ? 'selected' : '';
                            return `<option value="${promoter.id}"
                                    data-name="${promoter.promoter_name}"
                                    data-position="${positionName}"
                                    data-phone="${promoter.phone_no || ''}"
                                    data-id-card="${promoter.identity_card_no || ''}"
                                    data-bank="${promoter.bank_name || ''}"
                                    data-branch="${promoter.bank_branch_name || ''}"
                                    data-account="${promoter.bank_account_number || ''}"
                                    data-status="${promoter.status || 'inactive'}"
                                    data-position-id="${promoter.position_id || ''}"
                                    ${selected}>${promoter.promoter_id}</option>`;
                        }).join('') : ''}
                    </select>
                </div>
                <input type="text" class="table-input-small table-input-readonly promoter-tooltip" name="rows[${index + 1}][promoter_name]" readonly data-tooltip="" value="${rowData.promoter_name || ''}">
                <select class="table-input-small" name="rows[${index + 1}][position_id]" id="positionSelect-${index + 1}" onchange="updatePositionFromDropdown(${index + 1}, this)">
                    <option value="">Select Position</option>
                </select>
                <input type="hidden" name="rows[${index + 1}][position]" id="positionName-${index + 1}" value="${rowData.position || ''}">
            </div>
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${index + 1}][bank_name]" readonly placeholder="Bank Name" value="${rowData.bank_name || ''}">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${index + 1}][bank_branch]" readonly placeholder="Bank Branch" value="${rowData.bank_branch || ''}">
                <input type="text" class="table-input-small table-input-readonly" name="rows[${index + 1}][bank_account_number]" readonly placeholder="Bank Number" value="${rowData.bank_account_number || ''}">
            </div>
        </td>
        <td id="attendanceCell-${index + 1}" style="display: table-cell; width: ${attendanceWidth}px;">
            <div style="display: grid; grid-template-columns: repeat(${numDates}, 1fr) 1fr 1.5fr; gap: 0.75rem; width: ${attendanceWidth}px;">
                ${attendanceInputs}
                <input type="number" class="table-input-small" name="rows[${index + 1}][attendance_total]" min="0" step="0.1" placeholder="0" value="${rowData.attendance_total || 0}" oninput="onAttendanceTotalManualChange(${index + 1}, this)">
                <input type="number" step="0.01" class="table-input-small" name="rows[${index + 1}][attendance_amount]" title="Attendance Amount (Auto-calculated, but editable)" value="${rowData.attendance_amount || 0}" oninput="calculateNetAmount(${index + 1})">
            </div>
        </td>
        <td id="paymentCell-${index + 1}">
            ${generatePaymentRowHTML(index + 1, getCurrentJobAllowances(), {
                amount: rowData.amount || 0,
                expenses: rowData.expenses || 0,
                hold_for_8_weeks: rowData.hold_for_8_weeks || 0,
                net_amount: rowData.net_amount || 0,
                ...(rowData.allowances || {})
            })}
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; position: relative;">
                <div style="position: relative;">
                    <input type="text" class="table-input-small" name="rows[${index + 1}][coordinator_search]" placeholder="Search coordinator by name/ID" value="${rowData.coordinator_id && rowData.current_coordinator ? rowData.coordinator_id + ' - ' + rowData.current_coordinator : ''}" oninput="handleCoordinatorSearchInput(${index + 1}, this)" onfocus="showAllCoordinators(${index + 1}, this)" onblur="hideCoordinatorSuggestions(${index + 1})">
                    <div id="coordinatorSuggestions-${index + 1}" class="coordinator-suggestions" style="display:none"></div>
                    <select class="table-input-small" name="rows[${index + 1}][coordinator_id]" onchange="updateCoordinatorDisplay(${index + 1}, this)" style="display:none">
                        <option value="">Select</option>
                        ${rowData.coordinator_id ? coordinators.map(coordinator => {
                            const selected = (coordinator.id == rowData.coordinator_id || coordinator.id == parseInt(rowData.coordinator_id)) ? 'selected' : '';
                            return `<option value="${coordinator.id}" data-name="${coordinator.coordinator_name}" ${selected}>${coordinator.coordinator_id}</option>`;
                        }).join('') : ''}
                    </select>
                </div>
                <input type="text" class="table-input-small table-input-readonly" name="rows[${index + 1}][current_coordinator]" readonly value="${rowData.current_coordinator || ''}">
                <input type="number" step="0.01" class="table-input-small" name="rows[${index + 1}][coordination_fee]" title="Coordination Fee (Auto-calculated, but editable)" oninput="markAsCustom(this, 'coordination_fee'); calculateRowNet(${index + 1})" value="${rowData.coordination_fee || 0}" ${rowData.coordination_fee ? 'data-custom-coordination-fee="true" data-loaded-from-db="true"' : ''}>
            </div>
        </td>
        <td>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankName-${index + 1}" name="rows[${index + 1}][coordinator_bank_name]" readonly placeholder="Bank Name" value="${jsonCoordinator ? (jsonCoordinator.bank_name || '') : ''}">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankBranch-${index + 1}" name="rows[${index + 1}][coordinator_bank_branch]" readonly placeholder="Bank Branch" value="${jsonCoordinator ? (jsonCoordinator.bank_branch_name || '') : ''}">
                <input type="text" class="table-input-small table-input-readonly" id="coordinatorBankAccount-${index + 1}" name="rows[${index + 1}][coordinator_bank_account]" readonly placeholder="Account No." value="${jsonCoordinator ? (jsonCoordinator.account_number || '') : ''}">
            </div>
        </td>
        <td>
            <div style="display: flex; gap: 0.25rem; justify-content: center;">
                <button type="button" class="btn-duplicate" onclick="duplicateRow(${index + 1})" title="Duplicate this promoter">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                </button>
                <button type="button" class="btn-danger" onclick="removeRow(${index + 1})" title="Remove this row">×</button>
            </div>
        </td>
    `;

    tbody.appendChild(row);

    // Update promoter details after adding the row
    setTimeout(() => {
        const promoterSelect = row.querySelector(`select[name="rows[${index + 1}][promoter_id]"]`);
        if (promoterSelect && promoterSelect.value) {
            updatePromoterDetails(index + 1, promoterSelect);
        }

        // Populate position dropdown after row is created
        setTimeout(() => {
            populatePositionDropdown(index + 1);
            // Try to set position from rowData or promoter
            const positionSelect = document.getElementById(`positionSelect-${index + 1}`);
            if (positionSelect) {
                let positionId = null;
                // First priority: use saved position_id from rowData
                if (rowData.position_id) {
                    positionId = rowData.position_id;
                } else if (rowData.promoter_id) {
                    // Fallback to promoter's position_id
                    const promoter = promoters.find(p => p.id == rowData.promoter_id);
                    if (promoter && promoter.position_id) {
                        positionId = promoter.position_id;
                    }
                }
                if (positionId) {
                    // Wait a bit for dropdown to be populated
                    setTimeout(() => {
                        positionSelect.value = positionId;
                        updatePositionFromDropdown(index + 1, positionSelect);
                    }, 100);
                } else if (rowData.position) {
                    // If we have position name but not ID, try to find it
                    const positionNameInput = document.getElementById(`positionName-${index + 1}`);
                    if (positionNameInput) {
                        positionNameInput.value = rowData.position;
                    }
                }
            }
        }, 200);

        const coordinatorSelect = row.querySelector(`select[name="rows[${index + 1}][coordinator_id]"]`);
        if (coordinatorSelect && coordinatorSelect.value) {
            updateCoordinatorDisplay(index + 1, coordinatorSelect);
        }

        // Recalculate attendance total from date checkboxes ONLY when date columns exist.
        // When there are no date columns the total is manually entered and was already
        // set from the loaded JSON — overwriting it with 0 would erase the saved value.
        if (currentAttendanceDates && currentAttendanceDates.length > 0) {
            let total = 0;
            const attendanceInputs = row.querySelectorAll('input[name*="[attendance]["]');
            attendanceInputs.forEach(input => {
                const name = input.name;
                if (name.includes('[attendance][') && !name.includes('[attendance_total]') && !name.includes('[attendance_amount]')) {
                    total += parseFloat(input.value) || 0;
                }
            });
            const totalInput = row.querySelector(`input[name="rows[${index + 1}][attendance_total]"]`);
            if (totalInput) totalInput.value = total.toFixed(1);
        }

        // Mark amount and expenses as custom when loading from database (to prevent overwriting)
        const amountInput = row.querySelector(`input[name="rows[${index + 1}][amount]"]`);
        const expensesInput = row.querySelector(`input[name="rows[${index + 1}][expenses]"]`);
        if (amountInput && parseFloat(amountInput.value) > 0) {
            amountInput.dataset.customAmount = 'true';
            amountInput.dataset.loadedFromDb = 'true';
        }
        if (expensesInput && parseFloat(expensesInput.value) > 0) {
            expensesInput.dataset.customExpenses = 'true';
            expensesInput.dataset.loadedFromDb = 'true';
        }

        // DON'T recalculate amounts when loading - the amounts are already loaded from saved data
        // The attendance_amount and amount fields already have the correct values from rowData

        // Just trigger net amount calculation to update the display
        calculateRowNet(index + 1);
    }, 100);

    // Update promoter dropdowns (duplicates now allowed)
    updatePromoterDropdowns();

    console.log(`Row ${index + 1} added successfully`);
}

// Pull Data Functions
function pullExistingData(isAutoPull = false) {
    const jobSelect = document.getElementById('job_id');
    const selectedJobId = jobSelect.value;

    if (!selectedJobId) {
        showPullDataStatus('Please select a job first.', 'error');
        return;
    }

    console.log('Pulling existing data for job:', selectedJobId, isAutoPull ? '(auto-pull)' : '(manual)');

    // Reset auto-pull flag for manual pulls
    if (!isAutoPull) {
        hasAutoPulledData = false;
    }

    // Show loading state
    const pullDataBtn = document.getElementById('pullDataBtn');
    const originalText = pullDataBtn.innerHTML;
    pullDataBtn.disabled = true;
    pullDataBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;"><path d="M21 12a9 9 0 11-6.219-8.56"></path></svg>Pulling...';

    // First, get the most recent salary sheet for this job
    fetch(`/admin/salary-sheets/by-job/${selectedJobId}`)
        .then(response => response.json())
    .then(data => {
            console.log('Salary sheets for job:', data);

            if (data.success && data.salarySheets && data.salarySheets.length > 0) {
                // Get the most recent salary sheet (first in the array)
                const mostRecentSheet = data.salarySheets[0];
                console.log('Most recent salary sheet:', mostRecentSheet);

                // Now fetch the JSON data for this salary sheet
                return fetch(`/admin/salary-sheets/${mostRecentSheet.id}/json`);
        } else {
                throw new Error('No salary sheets found for this job');
            }
        })
        .then(response => response.json())
        .then(jsonData => {
            console.log('Fetched JSON data:', jsonData);

            // Update form fields
            updateFormFields(jsonData);

            // Update table rows
            updateTableRows(jsonData);

            // Trigger all calculations after data is loaded
            setTimeout(() => {
                console.log('Recalculating totals after pull data (preserving custom amounts)...');

                // When pulling existing data, DON'T recalculate attendance amounts
                // The custom amounts are already loaded from the saved data
                // Just calculate attendance totals (count) and net amounts
                const rows = document.querySelectorAll('#promoterRows tr');
                rows.forEach((row, index) => {
                    const rowNum = index + 1;
                    console.log(`Updating calculations for row ${rowNum} (preserving custom amounts)`);

                    // Only calculate attendance total (count of present days)
                    // Don't call calculateRowTotal as it recalculates attendance_amount
                    let total = 0;
                    const attendanceInputs = row.querySelectorAll('input[name*="[attendance]["]');
                    attendanceInputs.forEach(input => {
                        total += parseFloat(input.value) || 0;
                    });
                    const totalInput = row.querySelector(`input[name="rows[${rowNum}][attendance_total]"]`);
                    if (totalInput) {
                        totalInput.value = total;
                    }

                    // Calculate net amount based on the loaded custom amounts
                    calculateRowNet(rowNum);
                });

                // Update grand total
                calculateGrandTotal();

                console.log('Calculations completed (custom amounts preserved)');
            }, 300);

            showPullDataStatus(isAutoPull ? 'Previous data loaded automatically!' : 'Data pulled successfully!', 'success');

        })
    .catch(error => {
            console.error('Error pulling data:', error);
            showPullDataStatus(isAutoPull ? 'No previous data found for this job.' : 'No existing data found for this job.', 'error');
    })
    .finally(() => {
        // Reset button state
            pullDataBtn.disabled = false;
            pullDataBtn.innerHTML = originalText;
        });
}

function showPullDataStatus(message, type) {
    // Create or update status div
    let statusDiv = document.getElementById('pullDataStatus');
    if (!statusDiv) {
        statusDiv = document.createElement('div');
        statusDiv.id = 'pullDataStatus';
        statusDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; padding: 1rem; border-radius: 4px; z-index: 9999; max-width: 300px;';
        document.body.appendChild(statusDiv);
    }

    statusDiv.style.display = 'block';
    statusDiv.textContent = message;
    statusDiv.style.backgroundColor = type === 'success' ? '#d4edda' : '#f8d7da';
    statusDiv.style.color = type === 'success' ? '#155724' : '#721c24';
    statusDiv.style.border = `1px solid ${type === 'success' ? '#c3e6cb' : '#f5c6cb'}`;

    // Auto-hide after 3 seconds
    setTimeout(() => {
        statusDiv.style.display = 'none';
    }, 3000);
}

// Position Wise Salary Rule Modal Functions
let salaryRuleCounter = 0;
let selectedPositions = new Set();

function showModalPreloader() {
    document.getElementById('modalPreloader').style.display = 'flex';
    document.getElementById('modalMainContent').style.display = 'none';
}

function hideModalPreloader() {
    document.getElementById('modalPreloader').style.display = 'none';
    document.getElementById('modalMainContent').style.display = 'block';
}

function updatePreloaderText(text) {
    const preloaderText = document.querySelector('.preloader-text');
    if (preloaderText) {
        preloaderText.textContent = text;
    }
}

function reloadModalContent() {
    // Clear existing content
    clearSalaryRules();

    // Show preloader
    updatePreloaderText('Reloading salary rules...');
    showModalPreloader();

    // Reload existing rules
    loadExistingRules();
}

// ── Bulk Add Rows ──────────────────────────────────────────────────────────────
function openBulkAddModal() {
    document.getElementById('bulkRowCount').value = 5;
    document.getElementById('bulkAddError').style.display = 'none';
    document.getElementById('bulkAddRowsModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
    setTimeout(() => document.getElementById('bulkRowCount').select(), 50);
}

function closeBulkAddModal() {
    document.getElementById('bulkAddRowsModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function confirmBulkAdd() {
    const input = document.getElementById('bulkRowCount');
    const count = parseInt(input.value, 10);
    const errorEl = document.getElementById('bulkAddError');

    if (!count || count < 1 || count > 100) {
        errorEl.textContent = 'Please enter a number between 1 and 100.';
        errorEl.style.display = 'block';
        input.focus();
        return;
    }

    errorEl.style.display = 'none';
    closeBulkAddModal();

    for (let i = 0; i < count; i++) {
        addPromoterRow();
    }
}

// Close bulk add modal when clicking the backdrop
document.addEventListener('click', function(e) {
    if (e.target.id === 'bulkAddRowsModal') closeBulkAddModal();
});

// ─────────────────────────────────────────────────────────────────────────────
function openSalaryRuleModal() {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) {
        Swal.fire({
            icon: 'warning',
            title: 'Job Selection Required',
            text: 'Please select a job first before adding salary rules.',
            confirmButtonText: 'OK'
        });
        return;
    }

    document.getElementById('salaryRuleModal').style.display = 'block';
    document.body.style.overflow = 'hidden';

    // Show preloader
    showModalPreloader();

    // Load existing rules
    loadExistingRules();
}

function closeSalaryRuleModal() {
    document.getElementById('salaryRuleModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    clearSalaryRules();
    hideModalPreloader();
}

function getAvailablePositions() {
    // Get all unique positions from promoters
    const allPositions = promoters
        .filter(p => p.position)
        .map(p => p.position)
        .filter((position, index, self) =>
            index === self.findIndex(p => p.id === position.id)
        );

    // Get positions used in existing rules
    const existingRulePositions = new Set();
    const existingRuleElements = document.querySelectorAll('.existing-rule-row');
    existingRuleElements.forEach(element => {
        const positionElement = element.querySelector('.rule-info strong');
        if (positionElement) {
            const positionName = positionElement.textContent;
            const position = allPositions.find(p => p.position_name === positionName);
            if (position) {
                existingRulePositions.add(position.id);
            }
        }
    });

    // Get positions used in new rules
    const newRulePositions = new Set();
    const newRuleElements = document.querySelectorAll('.salary-rule-row');
    newRuleElements.forEach(element => {
        const select = element.querySelector('select[name*="[position_id]"]');
        if (select && select.value) {
            newRulePositions.add(parseInt(select.value));
        }
    });

    // Combine both sets
    const usedPositions = new Set([...existingRulePositions, ...newRulePositions]);

    // Filter out positions that are already used
    return allPositions.filter(position => !usedPositions.has(position.id));
}

function updateAddButtonState() {
    const addBtn = document.getElementById('addNewRuleBtn');
    const availablePositions = getAvailablePositions();

    // Get total positions count
    const totalPositions = promoters
        .filter(p => p.position)
        .map(p => p.position)
        .filter((position, index, self) =>
            index === self.findIndex(p => p.id === position.id)
        ).length;

    // Get used positions count
    const usedPositionsCount = totalPositions - availablePositions.length;

    if (availablePositions.length === 0) {
        addBtn.disabled = true;
        addBtn.title = `All ${totalPositions} positions have been used (${usedPositionsCount} existing + new rules)`;
    } else {
        addBtn.disabled = false;
        addBtn.title = `Add new rule (${availablePositions.length} of ${totalPositions} positions available)`;
    }
}

function addSalaryRuleRow() {
    // Check if there are available positions
    const availablePositions = getAvailablePositions();

    if (availablePositions.length === 0) {
        const totalPositions = promoters
            .filter(p => p.position)
            .map(p => p.position)
            .filter((position, index, self) =>
                index === self.findIndex(p => p.id === position.id)
            ).length;

        Swal.fire({
            icon: 'info',
            title: 'All Positions Added',
            text: `All ${totalPositions} positions have already been added as rules for this job.`,
            confirmButtonText: 'OK'
        });
        return;
    }

    salaryRuleCounter++;
    const container = document.getElementById('salaryRulesContainer');

    const row = document.createElement('div');
    row.className = 'salary-rule-row';
    row.id = `salaryRuleRow-${salaryRuleCounter}`;

    // Get the selected job ID from the top form
    const selectedJobId = document.getElementById('job_id').value;
    const selectedJob = jobs.find(job => job.id == selectedJobId);

    const positionOptions = availablePositions.map(position =>
        `<option value="${position.id}">${position.position_name}</option>`
    ).join('');

    row.innerHTML = `
        <select name="rules[${salaryRuleCounter}][position_id]" data-row-id="${salaryRuleCounter}" required>
            <option value="">Select Position</option>
            ${positionOptions}
        </select>
        <input type="hidden" name="rules[${salaryRuleCounter}][job_id]" value="${selectedJobId}">
        <div style="padding: 0.75rem; background: #f3f4f6; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem; color: #374151;">
            ${selectedJob ? selectedJob.job_number + ' - ' + selectedJob.job_name : 'No Job Selected'}
        </div>
        <input type="number" step="0.01" name="rules[${salaryRuleCounter}][amount]" placeholder="Amount" min="0" required>
        <input type="text" name="rules[${salaryRuleCounter}][description]" placeholder="Description (optional)">
        <button type="button" class="remove-rule-btn" data-row-id="${salaryRuleCounter}">×</button>
    `;

    container.appendChild(row);
    updateSelectedPositions();
    updateAddButtonState();
}

function removeSalaryRuleRow(rowId) {
    const row = document.getElementById(`salaryRuleRow-${rowId}`);
    if (row) {
        row.remove();
        updateSelectedPositions();
        updateAddButtonState();
    }
}

function updateSelectedPositions() {
    selectedPositions.clear();
    const rows = document.querySelectorAll('.salary-rule-row');
    rows.forEach(row => {
        const select = row.querySelector('select[name*="[position_id]"]');
        if (select && select.value) {
            selectedPositions.add(parseInt(select.value));
        }
    });

    // Update all position selects to show/hide options
    rows.forEach(row => {
        const select = row.querySelector('select[name*="[position_id]"]');
        if (select) {
            const currentValue = select.value;
            const availablePositions = promoters
                .filter(p => p.position && !selectedPositions.has(p.position.id))
                .map(p => p.position)
                .filter((position, index, self) =>
                    index === self.findIndex(p => p.id === position.id)
                );

            // Add current selection back if it exists
            if (currentValue) {
                const currentPosition = promoters.find(p => p.position && p.position.id == currentValue)?.position;
                if (currentPosition && !availablePositions.find(p => p.id == currentValue)) {
                    availablePositions.push(currentPosition);
                }
            }

            const positionOptions = availablePositions.map(position =>
                `<option value="${position.id}" ${position.id == currentValue ? 'selected' : ''}>${position.position_name}</option>`
            ).join('');

            select.innerHTML = `<option value="">Select Position</option>${positionOptions}`;
            if (currentValue) {
                select.value = currentValue;
            }
        }
    });

    updateAddButtonState();
}

function clearSalaryRules() {
    document.getElementById('salaryRulesContainer').innerHTML = '';
    document.getElementById('existingRulesContainer').innerHTML = '';
    salaryRuleCounter = 0;
    selectedPositions.clear();
    updateAddButtonState();
}

function deleteExistingRule(ruleId) {
    Swal.fire({
        title: 'Delete Salary Rule',
        text: 'Are you sure you want to delete this salary rule?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Continue with deletion
            console.log('Deleting rule with ID:', ruleId);

            // Send delete request via AJAX using Laravel's method spoofing
            const formData = new FormData();
            formData.append('_method', 'DELETE');
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            fetch(`/admin/position-wise-salary-rules/${ruleId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                console.log('Delete response status:', response.status);
                console.log('Delete response headers:', response.headers);
                if (response.ok) {
                    // Try to parse as JSON, fallback to success if not JSON
                    return response.text().then(text => {
                        console.log('Delete response text:', text);
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            console.log('Failed to parse JSON, treating as success');
                            return { success: true };
                        }
                    });
                } else {
                    return response.text().then(text => {
                        console.log('Error response text:', text);
                        throw new Error(`Delete request failed with status: ${response.status} - ${text}`);
                    });
                }
            })
            .then(data => {
                console.log('Delete response data:', data);
                if (data.success !== false) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Salary rule deleted successfully.',
                        confirmButtonText: 'OK'
                    });
                    // Reload modal content to get fresh data
                    reloadModalContent();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete salary rule: ' + (data.message || 'Unknown error'),
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Delete error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to delete salary rule: ' + error.message,
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}

function loadExistingRules() {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) {
        document.getElementById('existingRulesContainer').innerHTML = '<p style="color: #6b7280; text-align: center; padding: 2rem;">Please select a job first</p>';
        hideModalPreloader();
        return;
    }

    // Load existing salary rules via AJAX
    fetch('{{ route("admin.position-wise-salary-rules.get-rules") }}')
        .then(response => response.json())
        .then(data => {
            // Filter rules for the selected job or general rules (no job_id)
            const relevantRules = data.filter(rule =>
                rule.job_id == selectedJobId || rule.job_id === null
            );

            const container = document.getElementById('existingRulesContainer');

            if (relevantRules.length === 0) {
                container.innerHTML = '<p style="color: #6b7280; text-align: center; padding: 2rem;">No existing rules found for this job</p>';
                updateAddButtonState();
                hideModalPreloader();
                return;
            }

            container.innerHTML = '';

            relevantRules.forEach(rule => {
                const ruleRow = document.createElement('div');
                ruleRow.className = 'existing-rule-row';
                ruleRow.id = `existingRule-${rule.id}`;

                ruleRow.innerHTML = `
                    <div class="rule-info">
                        <strong>${rule.position.position_name}</strong>
                    </div>
                    <div class="rule-info">
                        Rs. ${parseFloat(rule.amount).toFixed(2)}
                    </div>
                    <div class="rule-info">
                        ${rule.description || 'No description'}
                    </div>
                    <button type="button" class="delete-rule-btn" data-rule-id="${rule.id}" title="Delete Rule">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3,6 5,6 21,6"></polyline>
                            <path d="M19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
                        </svg>
                    </button>
                `;

                container.appendChild(ruleRow);
            });

            updateAddButtonState();

            // Hide preloader after data is loaded
            hideModalPreloader();
        })
        .catch(error => {
            console.error('Error loading existing rules:', error);
            document.getElementById('existingRulesContainer').innerHTML = '<p style="color: #dc2626; text-align: center; padding: 2rem;">Error loading rules</p>';
            updateAddButtonState();

            // Hide preloader even on error
            hideModalPreloader();
        });
}

// Event delegation for all modal buttons
document.addEventListener('click', function(e) {
    // Handle delete buttons
    if (e.target.closest('.delete-rule-btn')) {
        const button = e.target.closest('.delete-rule-btn');
        const ruleId = button.getAttribute('data-rule-id');
        if (ruleId) {
            deleteExistingRule(ruleId);
        }
    }

    // Handle modal close button
    if (e.target.id === 'modalCloseBtn' || e.target.closest('#modalCloseBtn')) {
        closeSalaryRuleModal();
    }

    // Handle refresh button
    if (e.target.id === 'refreshModalBtn' || e.target.closest('#refreshModalBtn')) {
        reloadModalContent();
    }

    // Handle add new rule button
    if (e.target.id === 'addNewRuleBtn' || e.target.closest('#addNewRuleBtn')) {
        addSalaryRuleRow();
    }

    // Handle save rules button
    if (e.target.id === 'saveRulesBtn' || e.target.closest('#saveRulesBtn')) {
        saveSalaryRules();
    }

    // Handle cancel button
    if (e.target.id === 'cancelModalBtn' || e.target.closest('#cancelModalBtn')) {
        closeSalaryRuleModal();
    }

    // Handle modal background click to close
    if (e.target.id === 'salaryRuleModal') {
        closeSalaryRuleModal();
    }

    // Handle remove rule buttons
    if (e.target.closest('.remove-rule-btn')) {
        const button = e.target.closest('.remove-rule-btn');
        const rowId = button.getAttribute('data-row-id');
        if (rowId) {
            removeSalaryRuleRow(rowId);
        }
    }
});

// Handle position select changes
document.addEventListener('change', function(e) {
    if (e.target.matches('select[name*="[position_id]"]')) {
        updateSelectedPositions();
    }
});

// Handle keyboard events
document.addEventListener('keydown', function(e) {
    // Close modal on ESC key
    if (e.key === 'Escape') {
        const modal = document.getElementById('salaryRuleModal');
        if (modal && modal.style.display === 'block') {
            closeSalaryRuleModal();
        }
        const bulkModal = document.getElementById('bulkAddRowsModal');
        if (bulkModal && bulkModal.style.display === 'block') {
            closeBulkAddModal();
        }
    }
    // Confirm bulk add with Enter when modal is open
    if (e.key === 'Enter') {
        const bulkModal = document.getElementById('bulkAddRowsModal');
        if (bulkModal && bulkModal.style.display === 'block') {
            e.preventDefault();
            confirmBulkAdd();
        }
    }
});

function saveSalaryRules() {
    const rows = document.querySelectorAll('.salary-rule-row');
    const rules = [];

    rows.forEach(row => {
        const positionId = row.querySelector('select[name*="[position_id]"]').value;
        const jobId = row.querySelector('input[name*="[job_id]"]').value;
        const amount = row.querySelector('input[name*="[amount]"]').value;
        const description = row.querySelector('input[name*="[description]"]').value;

        if (positionId && amount) {
            rules.push({
                position_id: positionId,
                job_id: jobId || null,
                amount: parseFloat(amount),
                description: description
            });
        }
    });

    if (rules.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'No Salary Rules',
            text: 'Please add at least one salary rule.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Show preloader for saving
    updatePreloaderText('Saving salary rules...');
    showModalPreloader();

    // Send data via AJAX
    fetch('{{ route("admin.position-wise-salary-rules.store-multiple") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ rules: rules })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                confirmButtonText: 'OK'
            });
            // Reload modal content then refresh position dropdowns in all rows
            reloadModalContent();
            loadPositionSalaryRules().then(() => {
                document.querySelectorAll('select[id^="positionSelect-"]').forEach(sel => {
                    const rowNum = parseInt(sel.id.replace('positionSelect-', ''));
                    const previousValue = sel.value;
                    populatePositionDropdown(rowNum);
                    // Restore the previously selected position if it still exists in the new list
                    if (previousValue && sel.querySelector(`option[value="${previousValue}"]`)) {
                        sel.value = previousValue;
                    }
                });
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: ' + data.message,
                confirmButtonText: 'OK'
            });
            hideModalPreloader();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to save salary rules. Please try again.',
            confirmButtonText: 'OK'
        });
        hideModalPreloader();
    });
}

// Job Settings Modal Functions
function openJobSettingsModal() {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) {
        Swal.fire({
            icon: 'warning',
            title: 'Job Selection Required',
            text: 'Please select a job first before opening job settings.',
            confirmButtonText: 'OK'
        });
        return;
    }

    document.getElementById('jobSettingsModal').style.display = 'block';
    document.body.style.overflow = 'hidden';

    // Load current job settings
    loadJobSettings(selectedJobId);
}

function closeJobSettingsModal() {
    document.getElementById('jobSettingsModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function switchTab(tabName) {
    // Remove active class from all tabs and content
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

    // Add active class to selected tab and content
    document.getElementById(tabName + 'Tab').classList.add('active');
    document.getElementById(tabName + 'TabContent').classList.add('active');
}

function loadJobSettings(jobId) {
    // Find the selected job from the jobs array
    const selectedJob = jobs.find(job => job.id == jobId);
    if (selectedJob) {
        // Load job data into form fields
        document.getElementById('defaultCoordinatorFee').value = selectedJob.default_coordinator_fee || '';
        document.getElementById('defaultHoldFor8Weeks').value = selectedJob.default_hold_for_8_weeks || '';
        document.getElementById('jobDescription').value = selectedJob.description || '';
        document.getElementById('defaultExpenses').value = selectedJob.default_expenses || '';
        document.getElementById('defaultLocation').value = selectedJob.default_location || '';
        document.getElementById('locationNotes').value = selectedJob.location_notes || '';

        // Apply job settings to all existing rows
        const rows = document.querySelectorAll('tr:has(input[name*="[amount]"])');
        rows.forEach((row, index) => {
            const rowNum = index + 1;
            applyJobSettingsToRow(rowNum);
        });
    }
}

function saveJobSettings() {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) {
        Swal.fire({
            icon: 'warning',
            title: 'Job Selection Required',
            text: 'Please select a job first.',
            confirmButtonText: 'OK'
        });
        return;
    }

    const saveBtn = document.getElementById('saveJobSettingsBtn');
    const originalText = saveBtn.innerHTML;

    // Show loading state
    saveBtn.disabled = true;
    saveBtn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; animation: spin 1s linear infinite;">
            <path d="M21 12a9 9 0 11-6.219-8.56"></path>
        </svg>
        Saving...
    `;

    const settings = {
        default_coordinator_fee: document.getElementById('defaultCoordinatorFee').value,
        default_hold_for_8_weeks: document.getElementById('defaultHoldFor8Weeks').value,
        description: document.getElementById('jobDescription').value,
        default_expenses: document.getElementById('defaultExpenses').value,
        default_location: document.getElementById('defaultLocation').value,
        location_notes: document.getElementById('locationNotes').value
    };

    // Send data to server
    fetch(`/admin/jobs/${selectedJobId}/update-settings`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify(settings)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Job settings saved successfully!',
                confirmButtonText: 'OK'
            });
            closeJobSettingsModal();

            // Update the jobs array with the new data
            const jobIndex = jobs.findIndex(job => job.id == selectedJobId);
            if (jobIndex !== -1) {
                jobs[jobIndex] = { ...jobs[jobIndex], ...data.job };
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: ' + data.message,
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to save job settings. Please try again.',
            confirmButtonText: 'OK'
        });
    })
    .finally(() => {
        // Restore button state
        saveBtn.disabled = false;
        saveBtn.innerHTML = originalText;
    });
}

// Function to apply job settings to a specific row
function applyJobSettingsToRow(rowNum) {
    const selectedJobId = document.getElementById('job_id').value;
    if (!selectedJobId) return;

    const selectedJob = jobs.find(job => job.id == selectedJobId);
    if (!selectedJob) return;

    const row = document.querySelector(`tr:has(input[name="rows[${rowNum}][amount]"])`);
    if (!row) return;

    // Apply hold for 8 weeks
    if (selectedJob.default_hold_for_8_weeks) {
        const holdInput = row.querySelector(`input[name="rows[${rowNum}][hold_for_8_weeks]"]`);
        if (holdInput) holdInput.value = selectedJob.default_hold_for_8_weeks;
    }

    // Apply expenses
    if (selectedJob.default_expenses) {
        const expensesInput = row.querySelector(`input[name="rows[${rowNum}][expenses]"]`);
        if (expensesInput) expensesInput.value = selectedJob.default_expenses;
    }

    // Apply location
    if (selectedJob.default_location) {
        const locationInput = row.querySelector(`input[name="rows[${rowNum}][location]"]`);
        if (locationInput) locationInput.value = selectedJob.default_location;
    }

    // Calculate coordinator fee based on present days and job settings
    calculateCoordinatorFee(rowNum);

    // Recalculate net amount for this row
    calculateRowNet(rowNum);
}

function applySettingsToAllRows() {
    const coordinatorFee = document.getElementById('defaultCoordinatorFee').value;
    const holdFor8Weeks = document.getElementById('defaultHoldFor8Weeks').value;
    const expenses = document.getElementById('defaultExpenses').value;
    const location = document.getElementById('defaultLocation').value;

    // Apply to all existing rows
    const rows = document.querySelectorAll('#promoterRows tr');
    rows.forEach(row => {
        const rowNum = getRowNumberFromElement(row);

        // Calculate coordinator fee based on present days instead of just setting default
        calculateCoordinatorFee(rowNum);

        if (holdFor8Weeks) {
            const holdInput = row.querySelector(`input[name="rows[${rowNum}][hold_for_8_weeks]"]`);
            if (holdInput) holdInput.value = holdFor8Weeks;
        }


        if (expenses) {
            const expensesInput = row.querySelector(`input[name="rows[${rowNum}][expenses]"]`);
            if (expensesInput) expensesInput.value = expenses;
        }

        if (location) {
            const locationInput = row.querySelector(`input[name="rows[${rowNum}][location]"]`);
            if (locationInput) locationInput.value = location;
        }

        // Recalculate net amount for this row
        calculateRowNet(rowNum);
    });

    // Recalculate grand total
    calculateGrandTotal();

    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Settings applied to all rows successfully!',
        confirmButtonText: 'OK'
    });
}

function getRowNumberFromElement(element) {
    const firstInput = element.querySelector('input[name*="[promoter_id]"]');
    if (firstInput) {
        const nameMatch = firstInput.name.match(/rows\[(\d+)\]/);
        return nameMatch ? nameMatch[1] : 1;
    }
    return 1;
}

// Event delegation for Job Settings Modal
document.addEventListener('click', function(e) {
    // Handle job settings modal buttons
    if (e.target.id === 'jobSettingsCloseBtn' || e.target.closest('#jobSettingsCloseBtn')) {
        closeJobSettingsModal();
    }

    if (e.target.id === 'saveJobSettingsBtn' || e.target.closest('#saveJobSettingsBtn')) {
        saveJobSettings();
    }

    if (e.target.id === 'cancelJobSettingsBtn' || e.target.closest('#cancelJobSettingsBtn')) {
        closeJobSettingsModal();
    }

    if (e.target.id === 'applyToAllRowsBtn' || e.target.closest('#applyToAllRowsBtn')) {
        applySettingsToAllRows();
    }

    // Handle modal background click to close
    if (e.target.id === 'jobSettingsModal') {
        closeJobSettingsModal();
    }
});

        // Handle keyboard events for Job Settings Modal and Scroll
        document.addEventListener('keydown', function(e) {
            // Close modal on ESC key
            if (e.key === 'Escape') {
                const modal = document.getElementById('jobSettingsModal');
                if (modal && modal.style.display === 'block') {
                    closeJobSettingsModal();
                }
            }

            // Horizontal scroll keyboard shortcuts
            if (scrollContainer && !e.ctrlKey && !e.altKey && !e.metaKey) {
                switch(e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        scrollContainer.scrollBy({ left: -100, behavior: 'smooth' });
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        scrollContainer.scrollBy({ left: 100, behavior: 'smooth' });
                        break;
                    case 'Home':
                        if (e.ctrlKey) {
                            e.preventDefault();
                            scrollContainer.scrollTo({ left: 0, behavior: 'smooth' });
                        }
                        break;
                    case 'End':
                        if (e.ctrlKey) {
                            e.preventDefault();
                            scrollContainer.scrollTo({ left: scrollContainer.scrollWidth, behavior: 'smooth' });
                        }
                        break;
                }
            }
        });

        // Horizontal Scroll Functionality
        let isDragging = false;
        let startX = 0;
        let scrollLeft = 0;
        let scrollContainer = null;

        function initializeHorizontalScroll() {
            scrollContainer = document.getElementById('tableScrollContainer');
            if (!scrollContainer) return;

            // Scroll button event listeners
            document.getElementById('scrollLeftBtn').addEventListener('click', () => {
                scrollContainer.scrollBy({ left: -200, behavior: 'smooth' });
            });

            document.getElementById('scrollRightBtn').addEventListener('click', () => {
                scrollContainer.scrollBy({ left: 200, behavior: 'smooth' });
            });

            document.getElementById('scrollToStartBtn').addEventListener('click', () => {
                scrollContainer.scrollTo({ left: 0, behavior: 'smooth' });
            });

            document.getElementById('scrollToEndBtn').addEventListener('click', () => {
                scrollContainer.scrollTo({ left: scrollContainer.scrollWidth, behavior: 'smooth' });
            });

            // Mouse drag functionality
            scrollContainer.addEventListener('mousedown', (e) => {
                // Don't start dragging if clicking on form controls or interactive elements
                if (e.target.tagName === 'INPUT' ||
                    e.target.tagName === 'SELECT' ||
                    e.target.tagName === 'TEXTAREA' ||
                    e.target.tagName === 'BUTTON' ||
                    e.target.tagName === 'A' ||
                    e.target.closest('input, select, textarea, button, a, .dropdown, .select2-container') ||
                    e.target.classList.contains('select2-container') ||
                    e.target.closest('.select2-container')) {
                    return;
                }

                isDragging = true;
                scrollContainer.classList.add('dragging');
                startX = e.pageX - scrollContainer.offsetLeft;
                scrollLeft = scrollContainer.scrollLeft;
                e.preventDefault();
            });

            document.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                e.preventDefault();
                const x = e.pageX - scrollContainer.offsetLeft;
                const walk = (x - startX) * 2; // Scroll speed multiplier
                scrollContainer.scrollLeft = scrollLeft - walk;
            });

            document.addEventListener('mouseup', () => {
                isDragging = false;
                scrollContainer.classList.remove('dragging');
            });

            // Touch/swipe functionality
            let touchStartX = 0;
            let touchScrollLeft = 0;

            scrollContainer.addEventListener('touchstart', (e) => {
                // Don't start touch scrolling if touching form controls or interactive elements
                if (e.target.tagName === 'INPUT' ||
                    e.target.tagName === 'SELECT' ||
                    e.target.tagName === 'TEXTAREA' ||
                    e.target.tagName === 'BUTTON' ||
                    e.target.tagName === 'A' ||
                    e.target.closest('input, select, textarea, button, a, .dropdown, .select2-container') ||
                    e.target.classList.contains('select2-container') ||
                    e.target.closest('.select2-container')) {
                    return;
                }

                touchStartX = e.touches[0].pageX;
                touchScrollLeft = scrollContainer.scrollLeft;
            });

            scrollContainer.addEventListener('touchmove', (e) => {
                if (!touchStartX) return;
                const touchX = e.touches[0].pageX;
                const diff = touchStartX - touchX;
                scrollContainer.scrollLeft = touchScrollLeft + diff;
            });

            scrollContainer.addEventListener('touchend', () => {
                touchStartX = 0;
            });

            // Scroll progress indicator
            scrollContainer.addEventListener('scroll', updateScrollProgress);

            // Initial progress update
            updateScrollProgress();
        }

        function updateScrollProgress() {
            if (!scrollContainer) return;

            const scrollLeft = scrollContainer.scrollLeft;
            const scrollWidth = scrollContainer.scrollWidth;
            const clientWidth = scrollContainer.clientWidth;
            const maxScroll = scrollWidth - clientWidth;

            if (maxScroll <= 0) {
                document.getElementById('scrollPosition').textContent = '0%';
                document.getElementById('scrollProgressBar').style.width = '0%';
                document.getElementById('scrollInfo').textContent = 'No scroll needed';

                // Disable scroll buttons
                document.getElementById('scrollLeftBtn').disabled = true;
                document.getElementById('scrollRightBtn').disabled = true;
                document.getElementById('scrollToStartBtn').disabled = true;
                document.getElementById('scrollToEndBtn').disabled = true;
                return;
            }

            const scrollPercentage = Math.round((scrollLeft / maxScroll) * 100);
            document.getElementById('scrollPosition').textContent = scrollPercentage + '%';
            document.getElementById('scrollProgressBar').style.width = scrollPercentage + '%';
            document.getElementById('scrollInfo').textContent = `${scrollLeft}/${maxScroll}px`;

            // Enable/disable scroll buttons based on position
            document.getElementById('scrollLeftBtn').disabled = scrollLeft <= 0;
            document.getElementById('scrollRightBtn').disabled = scrollLeft >= maxScroll;
            document.getElementById('scrollToStartBtn').disabled = scrollLeft <= 0;
            document.getElementById('scrollToEndBtn').disabled = scrollLeft >= maxScroll;
        }

        // Initialize horizontal scroll when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeHorizontalScroll();

            // Job field uses custom AJAX search — no Select2 needed
        });

        // Debug function to manually check expenses calculation
        function debugExpensesCalculation() {
            console.log('=== MANUAL EXPENSES DEBUG ===');

            const rows = document.querySelectorAll('#promoterRows tr');
            console.log('Total rows found:', rows.length);

            rows.forEach((row, index) => {
                console.log(`\n--- Row ${index + 1} ---`);

                // Check all possible expense selectors
                const selectors = [
                    'input[name*="[expenses]"]',
                    'input[name$="[expenses]"]',
                    'input[name="rows[' + (index + 1) + '][expenses]"]',
                    'input[name="rows[' + index + '][expenses]"]'
                ];

                selectors.forEach(selector => {
                    const input = row.querySelector(selector);
                    if (input) {
                        console.log(`Found with selector "${selector}":`, {
                            name: input.name,
                            value: input.value,
                            parsed: parseFloat(input.value) || 0
                        });
                    }
                });

                // Also check all inputs in the row
                const allInputs = row.querySelectorAll('input');
                console.log('All inputs in row:', Array.from(allInputs).map(input => ({
                    name: input.name,
                    value: input.value
                })));
            });
        }

        // Add this function to window for easy access
        window.debugExpensesCalculation = debugExpensesCalculation;
</script>

<!-- Salary Sheet Save Modal -->
<div id="salarySheetSaveModal" class="modal" style="display: none;">
    <div class="modal-content" style="max-width: 600px; width: 90%;">
        <div class="modal-header">
            <h3>{{ isset($editSalarySheet) ? 'Update Salary Sheet' : 'Save Salary Sheet' }}</h3>
            <span class="close" id="salarySheetSaveCloseBtn">&times;</span>
        </div>
        <div class="modal-body">
            <div style="margin-bottom: 1.5rem;">
                <p style="color: #6b7280; margin-bottom: 1rem;">Please select the appropriate status for this salary sheet before saving.</p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <!-- Job Status -->
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Job Status</label>
                        <select id="jobStatusSelect" class="form-control" style="width: 100%;">
                            <option value="">Select Job Status</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="on_hold">On Hold</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Salary Sheet Status -->
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Salary Sheet Status</label>
                        <select id="salarySheetStatusSelect" class="form-control" style="width: 100%;" onchange="updateStatusDescription(); updateReporterFieldVisibility();">
                            <option value="">Select Status</option>
                            <option value="draft">Draft</option>
                            <option value="complete" {{ !isset($editSalarySheet) ? 'selected' : '' }}>Complete</option>
                            <option value="reject">Reject</option>
                            <option value="approve">Approve</option>
                            <option value="paid">Paid</option>
                        </select>
                        <p style="margin-top:0.4rem;font-size:0.78rem;color:#10b981;">
                            &#9432; Saving as <strong>Complete</strong> will email the reporter for approval.
                        </p>
                    </div>
                </div>

                <!-- Reporter (shown only when Salary Sheet Status = Complete) -->
                <div id="reporterFieldWrapper" style="display:none; margin-top: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Send Approval Mail To Reporter</label>
                    <select id="reporterSelect" class="form-control" style="width: 100%;" onchange="updateReporterFieldVisibility()">
                        <option value="">-- Use job's assigned reporter --</option>
                        @foreach($reporters ?? [] as $reporterOption)
                        <option value="{{ $reporterOption->id }}">{{ $reporterOption->name }}</option>
                        @endforeach
                    </select>
                    <p id="reporterFieldHint" style="margin-top:0.4rem;font-size:0.78rem;color:#6b7280;"></p>
                </div>

                <!-- Status Description -->
                <div id="statusDescription" style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 0.5rem; border-left: 4px solid #3b82f6;">
                    <h4 style="margin: 0 0 0.5rem 0; color: #374151; font-size: 0.9rem; font-weight: 600;">Status Information</h4>
                    <p id="statusDescriptionText" style="margin: 0; color: #6b7280; font-size: 0.85rem; line-height: 1.4;">
                        Please select a salary sheet status to view detailed information about the status change process.
                    </p>
                </div>

                <!-- Additional Notes -->
                <div style="margin-top: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Additional Notes (Optional)</label>
                    <textarea id="saveNotes" class="form-control" rows="3" placeholder="Add any additional notes about this salary sheet..." style="width: 100%; resize: vertical;"></textarea>
                </div>
            </div>

            <div style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
                <button type="button" class="btn btn-secondary" onclick="closeSalarySheetSaveModal()">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="confirmSaveSalarySheet()">{{ isset($editSalarySheet) ? 'Update Salary Sheet' : 'Save Salary Sheet' }}</button>
            </div>
        </div>
    </div>
</div>

<script>
// Salary Sheet Save Modal Functions
function openSalarySheetSaveModal() {
    document.getElementById('salarySheetSaveModal').style.display = 'block';
    document.body.style.overflow = 'hidden';

    // Reset form
    document.getElementById('jobStatusSelect').value = '';
    document.getElementById('salarySheetStatusSelect').value = '';
    document.getElementById('saveNotes').value = '';
    document.getElementById('reporterSelect').value = '';
    updateStatusDescription();
    updateReporterFieldVisibility();
}

function closeSalarySheetSaveModal() {
    document.getElementById('salarySheetSaveModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Show/hide the reporter dropdown depending on the chosen Salary Sheet Status,
// and hint whether the job already has a reporter assigned.
function updateReporterFieldVisibility() {
    const statusSelect = document.getElementById('salarySheetStatusSelect');
    const wrapper = document.getElementById('reporterFieldWrapper');
    const hint = document.getElementById('reporterFieldHint');
    if (!statusSelect || !wrapper) return;

    if (statusSelect.value !== 'complete') {
        wrapper.style.display = 'none';
        return;
    }

    wrapper.style.display = 'block';

    const jobHidden = document.getElementById('job_id');
    const jobReporterId = jobHidden ? (jobHidden.dataset.reporterId || '') : '';
    const jobReporterName = jobHidden ? (jobHidden.dataset.reporterName || '') : '';

    if (jobReporterId) {
        hint.style.color = '#6b7280';
        hint.textContent = `Job's assigned reporter: ${jobReporterName}. Leave unselected to email them, or pick someone else to send to instead.`;
    } else {
        hint.style.color = '#b45309';
        hint.textContent = "This job has no reporter assigned yet. Select one to send the approval email — it will also be saved as the job's reporter.";
    }
}

function updateStatusDescription() {
    const statusSelect = document.getElementById('salarySheetStatusSelect');
    const descriptionText = document.getElementById('statusDescriptionText');
    const statusDescription = document.getElementById('statusDescription');

    const status = statusSelect.value;

    switch(status) {
        case 'complete':
            descriptionText.innerHTML = `
                <strong>Complete Status:</strong><br>
                • The salary sheet will be moved to reporters and officers<br>
                • No further edits can be made to this salary sheet<br>
                • This status indicates final approval and processing<br>
                • Use this status when all calculations are verified and ready for payment
            `;
            statusDescription.style.borderLeftColor = '#10b981';
            break;

        case 'draft':
            descriptionText.innerHTML = `
                <strong>Draft Status:</strong><br>
                • You can continue to edit and make changes<br>
                • This status allows for ongoing modifications<br>
                • Perfect for work-in-progress salary sheets<br>
                • Can be changed to Complete or Reject status later
            `;
            statusDescription.style.borderLeftColor = '#f59e0b';
            break;

        case 'reject':
            descriptionText.innerHTML = `
                <strong>Reject Status:</strong><br>
                • You can edit and resubmit the salary sheet<br>
                • This status indicates issues that need to be addressed<br>
                • Allows for corrections and modifications<br>
                • Can be changed to Draft or Complete after corrections
            `;
            statusDescription.style.borderLeftColor = '#ef4444';
            break;

        case 'approve':
            descriptionText.innerHTML = `
                <strong>Approve Status:</strong><br>
                • The salary sheet has been approved by the reporter<br>
                • This status indicates approval for payment processing<br>
                • Can be changed to Paid status after payments are processed<br>
                • Use this status when the salary sheet is ready for payment
            `;
            statusDescription.style.borderLeftColor = '#10b981';
            break;

        case 'paid':
            descriptionText.innerHTML = `
                <strong>Paid Status:</strong><br>
                • The salary sheet has been processed and payments have been made<br>
                • No further edits can be made to this salary sheet<br>
                • This status indicates final payment completion<br>
                • Use this status when all payments have been successfully processed
            `;
            statusDescription.style.borderLeftColor = '#10b981';
            break;

        default:
            descriptionText.innerHTML = 'Please select a salary sheet status to view detailed information about the status change process.';
            statusDescription.style.borderLeftColor = '#3b82f6';
    }
}

function confirmSaveSalarySheet() {
    const jobStatus = document.getElementById('jobStatusSelect').value;
    const salarySheetStatus = document.getElementById('salarySheetStatusSelect').value;
    const notes = document.getElementById('saveNotes').value;
    const reporterId = document.getElementById('reporterSelect').value;

    // Validation
    if (!jobStatus) {
        Swal.fire({
            icon: 'warning',
            title: 'Job Status Required',
            text: 'Please select a job status before saving.',
            confirmButtonText: 'OK'
        });
        return;
    }

    if (!salarySheetStatus) {
        Swal.fire({
            icon: 'warning',
            title: 'Salary Sheet Status Required',
            text: 'Please select a salary sheet status before saving.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // If completing the sheet with no reporter selected and the job has none assigned either,
    // the approval mail has nowhere to go — warn before saving instead of failing silently.
    if (salarySheetStatus === 'complete' && !reporterId) {
        const jobHidden = document.getElementById('job_id');
        const jobReporterId = jobHidden ? (jobHidden.dataset.reporterId || '') : '';

        if (!jobReporterId) {
            Swal.fire({
                icon: 'warning',
                title: 'Reporter Not Assigned',
                html: 'Cannot send reporter approval mail because the job reporter is not assigned.<br><br>Select a reporter to notify, or save anyway without sending the approval email.',
                showCancelButton: true,
                confirmButtonText: 'Select Reporter',
                cancelButtonText: 'Save Without Sending Mail',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reporterSelect').focus();
                } else {
                    proceedSaveSalarySheet(jobStatus, salarySheetStatus, notes, reporterId);
                }
            });
            return;
        }
    }

    proceedSaveSalarySheet(jobStatus, salarySheetStatus, notes, reporterId);
}

function proceedSaveSalarySheet(jobStatus, salarySheetStatus, notes, reporterId) {
    // Add hidden inputs to the form
    const form = document.getElementById('salarySheetForm');

    // Update the hidden status input and the visible button label
    const _sLabels2 = {draft:'Draft',complete:'Complete',reject:'Reject',approve:'Approve',paid:'Paid'};
    selectStatusOption(salarySheetStatus, _sLabels2[salarySheetStatus] || salarySheetStatus);

    // Remove existing hidden inputs if they exist
    const existingJobStatus = form.querySelector('input[name="job_status"]');
    const existingNotes = form.querySelector('input[name="notes"]');
    const existingReporter = form.querySelector('input[name="reporter_id"]');

    if (existingJobStatus) existingJobStatus.remove();
    if (existingNotes) existingNotes.remove();
    if (existingReporter) existingReporter.remove();

    // Add new hidden inputs
    const jobStatusInput = document.createElement('input');
    jobStatusInput.type = 'hidden';
    jobStatusInput.name = 'job_status';
    jobStatusInput.value = jobStatus;
    form.appendChild(jobStatusInput);

    const notesInput = document.createElement('input');
    notesInput.type = 'hidden';
    notesInput.name = 'notes';  // Changed from 'save_notes' to 'notes' to match controller
    notesInput.value = notes;
    form.appendChild(notesInput);

    if (salarySheetStatus === 'complete' && reporterId) {
        const reporterInput = document.createElement('input');
        reporterInput.type = 'hidden';
        reporterInput.name = 'reporter_id';
        reporterInput.value = reporterId;
        form.appendChild(reporterInput);
    }

    // Close modal
    closeSalarySheetSaveModal();

    // Show confirmation
    Swal.fire({
        icon: 'info',
        title: isEditMode ? 'Updating Salary Sheet' : 'Saving Salary Sheet',
        text: `${isEditMode ? 'Updating' : 'Saving'} with Job Status: ${jobStatus} and Salary Sheet Status: ${salarySheetStatus}`,
        showConfirmButton: false,
        timer: 1500
    });

    // Debug: Log all form data before submission
    console.log('=== FORM SUBMISSION DEBUG ===');
    const formData = new FormData(form);
    const debugData = {};
    for (let [key, value] of formData.entries()) {
        if (key.includes('attendance_amount') || key.includes('net_amount') || key.includes('[amount]')) {
            console.log(`${key}: ${value}`);
            debugData[key] = value;
        }
    }
    console.log('Custom amounts being submitted:', debugData);
    console.log('=== END FORM SUBMISSION DEBUG ===');

    // Submit the form
    setTimeout(() => {
        form.submit();
    }, 1500);
}

// Event listeners for the modal
document.addEventListener('DOMContentLoaded', function() {
    // Close modal when clicking the close button
    document.getElementById('salarySheetSaveCloseBtn').addEventListener('click', closeSalarySheetSaveModal);

    // Close modal when clicking outside
    document.getElementById('salarySheetSaveModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSalarySheetSaveModal();
        }
    });

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('salarySheetSaveModal');
            if (modal && modal.style.display === 'block') {
                closeSalarySheetSaveModal();
            }
            const customDateModal = document.getElementById('addCustomDateModal');
            if (customDateModal && customDateModal.style.display === 'block') {
                closeAddCustomDateModal();
            }
        }
    });
});

// Add Custom Date Modal Functions
function openAddCustomDateModal() {
    const modal = document.getElementById('addCustomDateModal');
    const jobHiddenInput = document.getElementById('job_id');

    if (!jobHiddenInput || !jobHiddenInput.value) {
        Swal.fire({
            icon: 'warning',
            title: 'No Job Selected',
            text: 'Please select a job first before adding custom dates.',
        });
        return;
    }

    if (modal) {
        modal.style.display = 'block';
        document.getElementById('customDateInput').value = '';
        document.getElementById('customDateError').style.display = 'none';
        document.getElementById('customDateError').textContent = '';
    }
}


function closeAddCustomDateModal() {
    const modal = document.getElementById('addCustomDateModal');
    if (modal) {
        modal.style.display = 'none';
        document.getElementById('customDateInput').value = '';
        document.getElementById('customDateError').style.display = 'none';
        document.getElementById('customDateError').textContent = '';
    }
}

function addCustomDateToAttendance() {
    const dateInput = document.getElementById('customDateInput');
    const errorDiv = document.getElementById('customDateError');
    const selectedDate = dateInput.value;

    if (!selectedDate) {
        errorDiv.textContent = 'Please select a date.';
        errorDiv.style.display = 'block';
        return;
    }

    if (currentAttendanceDates.includes(selectedDate)) {
        errorDiv.textContent = 'This date is already in the attendance table.';
        errorDiv.style.display = 'block';
        return;
    }

    currentAttendanceDates.push(selectedDate);
    currentAttendanceDates.sort();
    updateAttendanceHeaders(currentAttendanceDates);
    addDateColumnToAllRows(selectedDate);
    closeAddCustomDateModal();

    Swal.fire({
        icon: 'success',
        title: 'Date Added',
        text: `Date ${selectedDate} has been added to the attendance table.`,
        timer: 1500,
        showConfirmButton: false
    });
}

function addDateColumnToAllRows(newDate) {
    const rows = document.querySelectorAll('#promoterRows tr');
    const dateIndex = currentAttendanceDates.indexOf(newDate);

    rows.forEach(row => {
        const attendanceCell = row.querySelector('td:nth-child(5)');
        if (attendanceCell) {
            const gridContainer = attendanceCell.querySelector('div');
            if (gridContainer) {
                const rowNum = getRowNumberFromElement(row);

                // Get existing inputs
                const existingInputs = Array.from(gridContainer.querySelectorAll('input[name*="[attendance]"]'));
                const totalInput = gridContainer.querySelector('input[name*="[attendance_total]"]');
                const amountInput = gridContainer.querySelector('input[name*="[attendance_amount]"]');

                // Clear container
                gridContainer.innerHTML = '';

                // Recreate all inputs in correct order
                currentAttendanceDates.forEach(date => {
                    const input = document.createElement('input');
                    input.type = 'number';
                    input.className = 'table-input-small';
                    input.name = `rows[${rowNum}][attendance][${date}]`;
                    input.min = '0';
                    input.max = '1';
                    input.step = '1';
                    input.placeholder = '0/1';
                    input.onchange = () => {
                        calculateRowTotal(rowNum);
                    };

                    // Preserve existing value if it exists
                    const existingInput = existingInputs.find(inp => {
                        const match = inp.name.match(/\[attendance\]\[([^\]]+)\]/);
                        return match && match[1] === date;
                    });
                    if (existingInput) {
                        input.value = existingInput.value;
                    }

                    gridContainer.appendChild(input);
                });

                // Re-add Total input (editable)
                const newTotalInput = document.createElement('input');
                newTotalInput.type = 'number';
                newTotalInput.className = 'table-input-small';
                newTotalInput.min = '0';
                newTotalInput.step = '0.1';
                newTotalInput.placeholder = '0';
                newTotalInput.name = totalInput ? totalInput.name : `rows[${rowNum}][attendance_total]`;
                newTotalInput.value = totalInput ? (totalInput.value || '') : '';
                newTotalInput.oninput = function() { onAttendanceTotalManualChange(rowNum, this); };
                gridContainer.appendChild(newTotalInput);

                // Re-add Amount input
                if (amountInput) {
                    const newAmountInput = document.createElement('input');
                    newAmountInput.type = 'number';
                    newAmountInput.step = '0.01';
                    newAmountInput.className = 'table-input-small';
                    newAmountInput.name = amountInput.name;
                    newAmountInput.title = 'Attendance Amount (Auto-calculated, but editable)';
                    newAmountInput.value = amountInput.value || '';
                    newAmountInput.setAttribute('oninput', `calculateNetAmount(${rowNum})`);

                    // Preserve custom amount attributes
                    if (amountInput.hasAttribute('data-custom-amount')) {
                        newAmountInput.setAttribute('data-custom-amount', amountInput.getAttribute('data-custom-amount'));
                    }
                    if (amountInput.hasAttribute('data-manually-edited')) {
                        newAmountInput.setAttribute('data-manually-edited', amountInput.getAttribute('data-manually-edited'));
                    }
                    if (amountInput.hasAttribute('data-loaded-from-db')) {
                        newAmountInput.setAttribute('data-loaded-from-db', amountInput.getAttribute('data-loaded-from-db'));
                    }
                    if (amountInput.hasAttribute('data-last-synced-amount')) {
                        newAmountInput.setAttribute('data-last-synced-amount', amountInput.getAttribute('data-last-synced-amount'));
                    }

                    gridContainer.appendChild(newAmountInput);
                } else {
                    const amountInputNew = document.createElement('input');
                    amountInputNew.type = 'number';
                    amountInputNew.step = '0.01';
                    amountInputNew.className = 'table-input-small';
                    amountInputNew.name = `rows[${rowNum}][attendance_amount]`;
                    amountInputNew.title = 'Attendance Amount (Auto-calculated, but editable)';
                    amountInputNew.setAttribute('oninput', `calculateNetAmount(${rowNum})`);
                    gridContainer.appendChild(amountInputNew);
                }

                // Update grid template and width
                const baseWidth = 160;
                const dateWidth = 80;
                const numDates = currentAttendanceDates.length || 6;
                const totalWidth = (numDates * dateWidth) + baseWidth;

                gridContainer.style.gridTemplateColumns = `repeat(${numDates}, 1fr) 1fr 1.5fr`;
                gridContainer.style.width = `${totalWidth}px`;
                attendanceCell.style.width = `${totalWidth}px`;

                // Recalculate row total
                calculateRowTotal(rowNum);
            }
        }
    });
}

// Event listeners for Add Custom Date Modal
document.addEventListener('DOMContentLoaded', function() {
    const addCustomDateModal = document.getElementById('addCustomDateModal');
    const closeAddCustomDateModalBtn = document.getElementById('closeAddCustomDateModal');
    const cancelAddCustomDateBtn = document.getElementById('cancelAddCustomDateBtn');
    const addCustomDateBtnModal = document.getElementById('addCustomDateBtnModal');

    if (closeAddCustomDateModalBtn) {
        closeAddCustomDateModalBtn.addEventListener('click', closeAddCustomDateModal);
    }

    if (cancelAddCustomDateBtn) {
        cancelAddCustomDateBtn.addEventListener('click', closeAddCustomDateModal);
    }

    if (addCustomDateBtnModal) {
        addCustomDateBtnModal.addEventListener('click', addCustomDateToAttendance);
    }

    if (addCustomDateModal) {
        addCustomDateModal.addEventListener('click', function(e) {
            if (e.target === addCustomDateModal) {
                closeAddCustomDateModal();
            }
        });
    }

    // Allow Enter key to submit
    const customDateInput = document.getElementById('customDateInput');
    if (customDateInput) {
        customDateInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addCustomDateToAttendance();
            }
        });
    }
});
</script>
@endsection
