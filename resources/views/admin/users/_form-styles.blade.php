<style>
.uf-layout { display:grid; grid-template-columns:1fr 280px; gap:1rem; align-items:start; }
.uf-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.uf-card-header { padding:.65rem 1rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.82rem; font-weight:700; color:#374151; display:flex; align-items:center; gap:.4rem; }
.uf-card-body { padding:1rem; }
.uf-card-footer { padding:.75rem 1rem; border-top:1px solid #e5e7eb; background:#f8fafc; display:flex; gap:.5rem; }

.uf-row { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-bottom:.75rem; }
.uf-group { display:flex; flex-direction:column; gap:.3rem; }
.uf-label { font-size:.75rem; font-weight:600; color:#374151; }
.uf-req { color:#ef4444; }
.uf-input { padding:.5rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; transition:border-color .15s,box-shadow .15s; width:100%; box-sizing:border-box; }
.uf-input:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.1); }
.uf-input-error { border-color:#ef4444 !important; }
.uf-input-error:focus { box-shadow:0 0 0 3px rgba(239,68,68,.1) !important; }
.uf-error { font-size:.72rem; color:#dc2626; margin:0; }

.uf-divider { margin:.25rem 0 .75rem; padding:.5rem 0; border-top:1px solid #f3f4f6; font-size:.72rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; }

.uf-roles { display:flex; flex-direction:column; gap:.4rem; }
.uf-role-item { display:flex; align-items:center; gap:.6rem; padding:.5rem .65rem; border:1px solid #e5e7eb; border-radius:6px; cursor:pointer; transition:all .15s; }
.uf-role-item:hover { border-color:#93c5fd; background:#f0f9ff; }
.uf-role-item.uf-role-checked { border-color:#3b82f6; background:#eff6ff; }
.uf-role-item input[type=checkbox] { display:none; }
.uf-role-info { flex:1; }
.uf-role-name { font-size:.8rem; font-weight:600; color:#374151; text-transform:capitalize; }
.uf-role-check { color:#d1d5db; transition:color .15s; }
.uf-role-item.uf-role-checked .uf-role-check { color:#3b82f6; }

.uf-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; }
.uf-btn-primary { background:#3b82f6; color:#fff; } .uf-btn-primary:hover { background:#2563eb; }
.uf-btn-success { background:#10b981; color:#fff; } .uf-btn-success:hover { background:#059669; }
.uf-btn-ghost  { background:#fff; color:#374151; border:1px solid #d1d5db; } .uf-btn-ghost:hover { background:#f3f4f6; }

@media(max-width:768px){ .uf-layout,.uf-row { grid-template-columns:1fr; } }
</style>
