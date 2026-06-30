<style>
.bf-layout { display:grid; grid-template-columns:1fr 280px; gap:1rem; align-items:start; }
.bf-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; margin-bottom:1rem; }
.bf-card:last-child { margin-bottom:0; }
.bf-card-header { padding:.65rem 1rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.82rem; font-weight:700; color:#374151; display:flex; align-items:center; gap:.4rem; }
.bf-card-body { padding:1rem; }
.bf-card-footer { padding:.75rem 1rem; border-top:1px solid #e5e7eb; background:#f8fafc; display:flex; gap:.5rem; }

.bf-row { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-bottom:.75rem; }
.bf-row-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:.75rem; margin-bottom:.75rem; }
.bf-group { display:flex; flex-direction:column; gap:.3rem; margin-bottom:.75rem; }
.bf-group:last-child { margin-bottom:0; }
.bf-label { font-size:.75rem; font-weight:600; color:#374151; }
.bf-req { color:#ef4444; }
.bf-input { padding:.5rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; transition:border-color .15s,box-shadow .15s; width:100%; box-sizing:border-box; }
.bf-input:focus { border-color:#0d9488; box-shadow:0 0 0 3px rgba(13,148,136,.1); }
.bf-input-error { border-color:#ef4444 !important; }
.bf-textarea { resize:vertical; min-height:80px; }
.bf-error { font-size:.72rem; color:#dc2626; margin:0; }
.bf-hint  { font-size:.7rem; color:#9ca3af; margin:0; }

.bf-divider { margin:.25rem 0 .75rem; padding:.5rem 0; border-top:1px solid #f3f4f6; font-size:.72rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; }

.bf-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; }
.bf-btn-primary { background:#0d9488; color:#fff; } .bf-btn-primary:hover { background:#0f766e; }
.bf-btn-success { background:#10b981; color:#fff; } .bf-btn-success:hover { background:#059669; }
.bf-btn-ghost  { background:#fff; color:#374151; border:1px solid #d1d5db; } .bf-btn-ghost:hover { background:#f3f4f6; }

@media(max-width:768px){ .bf-layout,.bf-row,.bf-row-3 { grid-template-columns:1fr; } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sc = document.getElementById('short_code');
    if (sc) {
        sc.addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase().replace(/[^A-Z]/g, '').substring(0, 3);
        });
    }
});
</script>
