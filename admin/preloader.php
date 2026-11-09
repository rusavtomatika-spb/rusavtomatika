<?php
?>
<div id="uni-preloader" aria-hidden="true">
  <div class="uni-preloader__spinner">
    <div class="uni-preloader__ring"></div>
    <div class="uni-preloader__label">Загрузка…</div>
  </div>
</div>
<style>
  #uni-preloader {
    position: fixed;
    inset: 0;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.92);
    opacity: 1;
    visibility: visible;
    transition: opacity .25s ease, visibility .25s ease;
  }
  #uni-preloader.uni-preloader--hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
  }
  .uni-preloader__spinner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
  }
  .uni-preloader__ring {
    width: 48px;
    height: 48px;
    border: 4px solid #e6e6e6;
    border-top-color: #34AB5E;
    border-radius: 50%;
    animation: uni-preloader-spin .8s linear infinite;
  }
  .uni-preloader__label {
    font: 500 14px/1.2 Arial, sans-serif;
    color: #333;
  }
  @keyframes uni-preloader-spin {
    to { transform: rotate(360deg); }
  }
</style>
<script>
(function () {
  var preloader = document.getElementById('uni-preloader');
  if (!preloader) return;

  function show() {
    preloader.classList.remove('uni-preloader--hidden');
  }
  function hide() {
    preloader.classList.add('uni-preloader--hidden');
  }

  if (document.readyState === 'complete') {
    hide();
  } else {
    window.addEventListener('load', hide);
  }

  document.addEventListener('submit', function (e) {
    if (e.defaultPrevented) return;
    show();
  }, true);

  document.addEventListener('click', function (e) {
    var link = e.target.closest ? e.target.closest('a') : null;
    if (!link) return;
    if (!link.href) return;
    if (link.target === '_blank') return;
    if (link.hasAttribute('download')) return;
    if (link.getAttribute('href') === '#') return;
    if (link.getAttribute('href') && link.getAttribute('href').indexOf('javascript:') === 0) return;
    try {
      var u = new URL(link.href, location.href);
      if (u.origin !== location.origin) return;
    } catch (err) { return; }
    show();
  }, true);

  (function () {
    var origOpen = XMLHttpRequest.prototype.open;
    var origSend = XMLHttpRequest.prototype.send;
    var activeXhr = 0;

    XMLHttpRequest.prototype.open = function () {
      this.__uniPreloaderShow = true;
      return origOpen.apply(this, arguments);
    };
    XMLHttpRequest.prototype.send = function () {
      if (this.__uniPreloaderShow) {
        activeXhr++;
        show();
        var self = this;
        var done = function () {
          activeXhr = Math.max(0, activeXhr - 1);
          if (activeXhr === 0) hide();
        };
        this.addEventListener('loadend', done);
      }
      return origSend.apply(this, arguments);
    };
  })();

  if (window.fetch) {
    var origFetch = window.fetch;
    var activeFetch = 0;
    window.fetch = function () {
      activeFetch++;
      show();
      var p = origFetch.apply(this, arguments);
      var done = function () {
        activeFetch = Math.max(0, activeFetch - 1);
        if (activeFetch === 0) hide();
      };
      p.then(done, done);
      return p;
    };
  }
})();
</script>