(function () {
  'use strict';

  function initSearchBlock(root) {
    if (!root || root.dataset.searchInit === '1') return;
    root.dataset.searchInit = '1';

    var form       = root.querySelector('.catalog_toolbar__form_search');
    var typeInput  = root.querySelector('.search_type_input');
    var dropdown   = root.querySelector('.search_type_dropdown');
    var toggleBtn  = root.querySelector('.search_type_toggle');
    var currentLbl = root.querySelector('.search_type_current');
    var options    = root.querySelectorAll('.search_type_option');

    if (!form || !typeInput || !dropdown || !toggleBtn) return;

    toggleBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      dropdown.classList.toggle('is-open');
    });

    document.addEventListener('click', function (e) {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('is-open');
      }
    });

    options.forEach(function (opt) {
      opt.addEventListener('click', function (e) {
        e.preventDefault();
        var type = opt.getAttribute('data-type');
        if (!type) return;

        typeInput.value = type;
        if (currentLbl) currentLbl.textContent = opt.textContent.trim();

        options.forEach(function (o) { o.classList.remove('active'); });
        opt.classList.add('active');

        dropdown.classList.remove('is-open');
      });
    });

    form.addEventListener('submit', function (e) {
      var q = form.querySelector('input[name="search"]');
      if (q && q.value.trim() === '') {
        e.preventDefault();
        q.focus();
        return;
      }
      form.dispatchEvent(new CustomEvent('catalog:search:submit', {
        bubbles: true,
        detail: { type: typeInput.value, query: q ? q.value : '' }
      }));
    });
  }

  function initAllSearchBlocks() {
    document.querySelectorAll('[data-search-instance]').forEach(initSearchBlock);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAllSearchBlocks);
  } else {
    initAllSearchBlocks();
  }

  window.CatalogSearchPopup = {
    init: initAllSearchBlocks,
    initOne: initSearchBlock
  };
})();