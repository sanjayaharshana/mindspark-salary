<style>
.rf-layout { display:grid; grid-template-columns:280px 1fr; gap:1rem; align-items:start; }
.rf-card { background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; }
.rf-card-header { padding:.65rem 1rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.82rem; font-weight:700; color:#374151; display:flex; align-items:center; gap:.4rem; }
.rf-card-body { padding:1rem; }
.rf-card-footer { padding:.75rem 1rem; border-top:1px solid #e5e7eb; background:#f8fafc; display:flex; gap:.5rem; }

.rf-group { display:flex; flex-direction:column; gap:.3rem; margin-bottom:.75rem; }
.rf-label { font-size:.75rem; font-weight:600; color:#374151; }
.rf-req { color:#ef4444; }
.rf-input { padding:.5rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-size:.82rem; color:#1f2937; background:#fff; outline:none; transition:border-color .15s,box-shadow .15s; width:100%; box-sizing:border-box; }
.rf-input:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.1); }
.rf-input-error { border-color:#ef4444 !important; }
.rf-error { font-size:.72rem; color:#dc2626; margin:0; }

.rf-perm-scroll { max-height:500px; overflow-y:auto; display:flex; flex-direction:column; gap:.5rem; }
.rf-perm-group { border:1px solid #e5e7eb; border-radius:6px; overflow:hidden; flex-shrink:0; }
.rf-perm-group-header { display:flex; align-items:center; justify-content:space-between; padding:.45rem .75rem; background:#f8fafc; border-bottom:1px solid #e5e7eb; }
.rf-perm-group-title { font-size:.72rem; font-weight:700; color:#374151; text-transform:uppercase; letter-spacing:.05em; }
.rf-toggle-all { font-size:.68rem; font-weight:600; color:#3b82f6; cursor:pointer; background:none; border:none; padding:0; }
.rf-toggle-all:hover { color:#2563eb; text-decoration:underline; }
.rf-perm-items { display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:.3rem; padding:.5rem .75rem; }
.rf-perm-item { display:flex; align-items:center; gap:.5rem; padding:.35rem .5rem; border:1px solid #e5e7eb; border-radius:5px; cursor:pointer; transition:all .12s; }
.rf-perm-item:hover { border-color:#93c5fd; background:#f0f9ff; }
.rf-perm-item.rf-checked { border-color:#3b82f6; background:#eff6ff; }
.rf-perm-item input[type=checkbox] { display:none; }
.rf-perm-name { font-size:.72rem; color:#374151; flex:1; }
.rf-perm-check { color:#d1d5db; flex-shrink:0; transition:color .12s; }
.rf-perm-item.rf-checked .rf-perm-check { color:#3b82f6; }

.rf-btn { padding:.45rem 1rem; border:none; border-radius:6px; font-size:.8rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.35rem; transition:all .15s; text-decoration:none; }
.rf-btn-primary { background:#3b82f6; color:#fff; } .rf-btn-primary:hover { background:#2563eb; }
.rf-btn-success { background:#10b981; color:#fff; } .rf-btn-success:hover { background:#059669; }
.rf-btn-ghost  { background:#fff; color:#374151; border:1px solid #d1d5db; } .rf-btn-ghost:hover { background:#f3f4f6; }

@media(max-width:768px){ .rf-layout { grid-template-columns:1fr; } .rf-perm-items { grid-template-columns:1fr 1fr; } }
</style>

<script>
function toggleGroup(groupId) {
    const items = document.querySelectorAll(`.perm-group-${groupId} .rf-perm-item`);
    const allChecked = Array.from(items).every(el => el.classList.contains('rf-checked'));
    items.forEach(el => {
        const cb = el.querySelector('input[type="checkbox"]');
        if (cb) {
            cb.checked = !allChecked;
            el.classList.toggle('rf-checked', !allChecked);
        }
    });
    const btn = document.querySelector(`.toggle-btn-${groupId}`);
    if (btn) btn.textContent = allChecked ? 'Select All' : 'Deselect All';
}

function updateGroupBtn(groupId) {
    const items = document.querySelectorAll(`.perm-group-${groupId} .rf-perm-item`);
    const allChecked = Array.from(items).every(el => el.classList.contains('rf-checked'));
    const btn = document.querySelector(`.toggle-btn-${groupId}`);
    if (btn) btn.textContent = allChecked ? 'Deselect All' : 'Select All';
}

function permToggle(el) {
    const cb = el.querySelector('input[type="checkbox"]');
    if (!cb) return;
    cb.checked = !cb.checked;
    el.classList.toggle('rf-checked', cb.checked);
    const groupId = el.dataset.group;
    if (groupId) updateGroupBtn(groupId);
}
</script>
