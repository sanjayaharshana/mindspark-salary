<style>
.pf-layout { display:grid; grid-template-columns:1fr 260px; gap:1rem; align-items:start; }
@media(max-width:900px){ .pf-layout { grid-template-columns:1fr; } }

.pf-card { background:#fff; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; }
.pf-card-head { padding:.65rem 1rem; border-bottom:1px solid #f3f4f6; }
.pf-card-title { font-size:.72rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; margin:0; }
.pf-card-body { padding:1rem; }
.pf-card-foot { padding:.75rem 1rem; border-top:1px solid #f3f4f6; background:#fafafa; display:flex; justify-content:flex-end; gap:.5rem; }

.pf-row { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:.75rem; }
.pf-group { display:flex; flex-direction:column; gap:.3rem; margin-bottom:.65rem; }
.pf-group:last-child { margin-bottom:0; }
.pf-label { font-size:.75rem; font-weight:600; color:#374151; }
.pf-req { color:#ef4444; }
.pf-input { padding:.48rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.83rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.pf-input:focus { border-color:#f43f5e; box-shadow:0 0 0 3px rgba(244,63,94,.1); }
.pf-invalid { border-color:#ef4444 !important; }
.pf-error { font-size:.75rem; color:#ef4444; margin-top:.1rem; }

.pf-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.pf-btn-primary { background:#f43f5e; color:#fff; border:1px solid #f43f5e; } .pf-btn-primary:hover { background:#e11d48; border-color:#e11d48; }
.pf-btn-ghost   { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .pf-btn-ghost:hover { background:#e5e7eb; }
</style>
