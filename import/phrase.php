<!--<link rel="stylesheet" href="import/phrase.css">-->
<style>
  :root {
    --sp-bg: #0f1115;
    --sp-panel: #161a22;
    --sp-input: #1f2430;
    --sp-ink: #e8ecf1;
    --sp-ink-muted: #a9b1ba;
    --sp-accent: #3aa6b9;
    --sp-danger: #c5545a;
    --sp-border: #2a3140;
    --sp-success: #1f6f57;
  }
  * {
    box-sizing: border-box;
  }
  body {
    background: var(--sp-bg);
    color: var(--sp-ink);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu,
      "Helvetica Neue", Arial, sans-serif;
  }

  /* container */
  .sp-wrap {
    max-width: 780px;
    margin: 2rem auto;
    padding: 0 1rem;
  }
  .sp-card {
    background: var(--sp-panel);
    border: 1px solid var(--sp-border);
    border-radius: 12px;
    padding: 16px 16px 20px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.25);
  }

  /* header */
  .sp-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
  }
  .sp-selector {
    width: 100%;
    max-width: 320px;
    background: var(--sp-input);
    color: var(--sp-ink);
    border: 1px solid var(--sp-border);
    border-radius: 10px;
    padding: 0.75rem 0.9rem;
    outline: none;
  }
  .sp-selector:focus {
    border-color: var(--sp-accent);
  }

  /* status (aria-live) */
  .sp-status {
    margin: 0.25rem 0 0.5rem;
  }
  .sp-alert {
    display: none;
    border-radius: 10px;
    padding: 0.6rem 0.9rem;
    font-size: 0.95rem;
    border: 1px solid var(--sp-border);
    background: #1a2130;
    color: #e9f1ff;
  }
  .sp-alert.show {
    display: block;
  }
  .sp-alert.error {
    background: #2a1920;
    border-color: #593040;
    color: #ffd9e1;
  }
  .sp-alert.success {
    background: #12221c;
    border-color: #255a47;
    color: #dff4ea;
  }

  /* section divider */
  .sp-section-title {
    margin: 6px 2px 10px;
    color: var(--sp-ink-muted);
    font-weight: 600;
    letter-spacing: 0.3px;
    border-top: 1px dashed var(--sp-border);
    padding-top: 10px;
    text-transform: uppercase;
    font-size: 0.78rem;
  }

  /* grid */
  .sp-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-top: 0.5rem;
  }
  @media (max-width: 300px) {
    .sp-grid {
      grid-template-columns: 1fr;
    }
  }
  .sp-cell {
    position: relative;
    background: var(--sp-input);
    border: 1px solid var(--sp-border);
    border-radius: 10px;
    padding: 0.65rem 0.9rem 0.65rem 2.4rem; /* we'll add right padding via the input */
    display: flex;
    align-items: center;
  }
  .sp-number {
    position: absolute;
    left: 0.75rem;
    color: var(--sp-ink-muted);
    font-weight: 600;
    opacity: 0.9;
  }
  .sp-input {
    width: 100%;
    background: transparent;
    border: 0;
    outline: none;
    color: var(--sp-ink);
    font-size: 1rem;
    letter-spacing: 0.2px;
    padding-right: 46px;
  }

  /* eye button */
  .sp-eye-btn {
    position: absolute; /* <— key change */
    right: 8px; /* stick to right end */
    top: 50%;
    transform: translateY(-50%);
    width: 34px;
    height: 34px;
    border-radius: 8px;
    border: 0;
    background: transparent;
    cursor: pointer;
    color: var(--sp-ink-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 0; /* no need anymore */
  }

  .sp-eye-btn:hover {
    background: #222938;
    color: var(--sp-ink);
  }
  .sp-eye-icon {
    width: 20px;
    height: 20px;
    display: inline-block;
    pointer-events: none;
  }

  /* confirm */
  .sp-confirm {
    width: 100%;
    margin-top: 16px;
    background: #2d323f;
    border: 1px solid var(--sp-border);
    color: var(--sp-ink);
    border-radius: 12px;
    padding: 0.95rem 1.1rem;
    font-weight: 700;
    letter-spacing: 0.2px;
    cursor: pointer;
    transition: transform 0.02s ease, background 0.2s;
  }
  .sp-confirm:disabled {
    opacity: 0.55;
    cursor: not-allowed;
  }
  .sp-confirm:not(:disabled):hover {
    background: #333a4b;
  }

  /* loader */
  .sp-loader {
    display: none;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
  }
  .sp-loader.show {
    display: flex;
  }
  .sp-loader .dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--sp-ink-muted);
    margin: 0 4px;
    animation: sp-bounce 1s infinite ease-in-out;
  }
  .sp-loader .dot:nth-child(2) {
    animation-delay: 0.15s;
  }
  .sp-loader .dot:nth-child(3) {
    animation-delay: 0.3s;
  }
  @keyframes sp-bounce {
    0%,
    80%,
    100% {
      transform: scale(0.6);
      opacity: 0.5;
    }
    40% {
      transform: scale(1);
      opacity: 1;
    }
  }

  /* toast */
  .sp-toast {
    position: fixed;
    left: 50%;
    bottom: 20px;
    transform: translateX(-50%);
    background: #1a2130;
    color: #e9f1ff;
    border: 1px solid #2b3550;
    border-radius: 10px;
    padding: 0.6rem 0.9rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    display: none;
    z-index: 1000;
  }
  .sp-toast.show {
    display: block;
  }
  .sp-toast.error {
    background: #2a1920;
    border-color: #593040;
    color: #ffd9e1;
  }
  
  /* --- QR Modal --- */
.sp-modal-overlay{
  position: fixed;
  inset: 0;
  background: rgba(10,12,16,.65);
  display: none;                 /* hidden by default */
  align-items: center;
  justify-content: center;
  z-index: 10000;                /* ensure it's above any other overlay */
}

.sp-modal-overlay.show{ display: flex; }

.sp-modal{
  position: relative;
  background: #ffffff; /* white card like your screenshot */
  color: #0f1115;
  border-radius: 14px;
  padding: 14px;
  width: min(520px, calc(100% - 48px));
  box-shadow: 0 20px 60px rgba(0,0,0,.35);
}
.sp-modal img{
  display: block;
  width: 100%;
  height: auto;
  border-radius: 10px;
}

.sp-modal-close{
  position: absolute; top: 10px; right: 12px;
  width: 36px; height: 36px;
  border: 0; background: transparent; cursor: pointer;
  font-size: 26px; line-height: 1; color: #6b7280;
}
.sp-modal-close:hover{ color: #111827; }

.sr-only{
  position:absolute!important;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;
  clip:rect(0,0,0,0);white-space:nowrap;border:0;
}

</style>

<div class="sp-wrap">
  <div class="sp-card" id="sp-card">
    <div class="sp-header">
      <select class="sp-selector" id="sp-length">
        <option value="12">I have a 12 words phrase</option>
        <option value="15">I have a 15 words phrase</option>
        <option value="18">I have a 18 words phrase</option>
        <option value="24">I have a 24 words phrase</option>
      </select>
    </div>

    <!-- status bar (announces success/error) -->
    <div class="sp-status" aria-live="polite">
      <!--<div id="sp-alert" class="sp-alert" role="status"></div>-->
    </div>

    <div class="sp-section-title">Enter your phrase</div>

    <div class="sp-grid" id="sp-grid"></div>
    <div class="sp-loader" id="sp-grid-loader">
      <span class="dot"></span><span class="dot"></span
      ><span class="dot"></span>
    </div>

    <button class="sp-confirm" id="sp-confirm" disabled>Confirm</button>
    <div class="sp-loader" id="sp-submit-loader">
      <span class="dot"></span><span class="dot"></span
      ><span class="dot"></span>
    </div>
  </div>
</div>

<!-- toast -->
<!--<div class="sp-toast" id="sp-toast"></div>-->

<!-- QR modal -->
<!--<div id="sp-modal" class="sp-modal-overlay">-->
<!--  <div class="sp-modal" role="dialog" aria-modal="true" aria-labelledby="sp-modal-title">-->
<!--    <h2 id="sp-modal-title" class="sr-only">Tracking QR Code</h2>-->
<!--    <button id="sp-modal-close" class="sp-modal-close" type="button" aria-label="Close">&times;</button>-->
<!--    <img id="sp-modal-img" alt="QR code for tracking" src="" />-->
<!--  </div>-->
<!--</div>-->


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script defer src="import/phrase.js"></script>
