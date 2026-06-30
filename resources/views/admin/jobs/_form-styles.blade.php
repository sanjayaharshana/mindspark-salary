<style>
.jf-layout { display:grid; grid-template-columns:1fr 280px; gap:1rem; align-items:start; }
@media(max-width:900px){ .jf-layout { grid-template-columns:1fr; } }

.jf-card { background:#fff; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; }
.jf-card-head { padding:.65rem 1rem; border-bottom:1px solid #f3f4f6; }
.jf-card-title { font-size:.72rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; margin:0; }
.jf-card-body { padding:1rem; }
.jf-card-foot { padding:.75rem 1rem; border-top:1px solid #f3f4f6; background:#fafafa; display:flex; justify-content:flex-end; gap:.5rem; }

.jf-row { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:.75rem; }
.jf-group { display:flex; flex-direction:column; gap:.3rem; margin-bottom:.65rem; }
.jf-group:last-child { margin-bottom:0; }
.jf-label { font-size:.75rem; font-weight:600; color:#374151; }
.jf-req { color:#ef4444; }
.jf-input { padding:.48rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.83rem; color:#1f2937; background:#fff; outline:none; width:100%; transition:border-color .15s,box-shadow .15s; }
.jf-input:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.1); }
.jf-invalid { border-color:#ef4444 !important; }
.jf-error { font-size:.75rem; color:#ef4444; margin-top:.1rem; }
.jf-textarea { resize:vertical; min-height:90px; }

.jf-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; white-space:nowrap; }
.jf-btn-primary { background:#f97316; color:#fff; border:1px solid #f97316; } .jf-btn-primary:hover { background:#ea580c; border-color:#ea580c; }
.jf-btn-ghost   { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; } .jf-btn-ghost:hover { background:#e5e7eb; }
</style>
