(function () {
  document.addEventListener('click', function (e) {
    var toggleBtn = e.target.closest('[data-search-instance] .search_type_toggle');
    if (toggleBtn) {
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();

      var dropdown = toggleBtn.closest('.search_type_dropdown');
      if (dropdown) {
        var isOpen = dropdown.classList.contains('is-open');
        document.querySelectorAll('[data-search-instance] .search_type_dropdown.is-open').forEach(function (el) {
          el.classList.remove('is-open');
        });
        if (!isOpen) {
          dropdown.classList.add('is-open');
        }
      }
      return;
    }

    var opt = e.target.closest('[data-search-instance] .search_type_option');
    if (opt) {
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();

      var root = opt.closest('[data-search-instance]');
      var dropdown = opt.closest('.search_type_dropdown');
      var type = opt.getAttribute('data-type');

      if (root && type) {
        var typeInput = root.querySelector('.search_type_input');
        var currentLbl = root.querySelector('.search_type_current');

        if (typeInput) typeInput.value = type;
        if (currentLbl) currentLbl.textContent = opt.textContent.trim();

        root.querySelectorAll('.search_type_option').forEach(function (o) {
          o.classList.remove('active');
        });
        opt.classList.add('active');
      }

      if (dropdown) {
        dropdown.classList.remove('is-open');
      }
      return;
    }

    if (!e.target.closest('[data-search-instance] .search_type_dropdown')) {
      document.querySelectorAll('[data-search-instance] .search_type_dropdown.is-open').forEach(function (el) {
        el.classList.remove('is-open');
      });
    }
  }, true);

  document.addEventListener('submit', function (e) {
    var form = e.target.closest('[data-search-instance] .catalog_toolbar__form_search');
    if (!form) return;

    e.preventDefault();
    e.stopImmediatePropagation();

    var q = form.querySelector('input[name="search"]');
    var typeInput = form.querySelector('.search_type_input');
    var text = q ? q.value : '';
    var type = typeInput ? typeInput.value : 'all';

    if (!text || text.trim() === '') {
      if (q) q.focus();
      return;
    }

    text = text.replace(/[^a-zа-я\d\s\(\) -ёЁ]+/gi, '');
    var params = [];

    if (/(wi-?fi|wifi)/i.test(text)) {
      params.push('interfaces=wifi');
      text = text.replace(/wifi/ig, 'wi-fi');
    }
    if (/(vesa)/i.test(text)) {
      params.push('vesa=yes');
    }

    var url = form.getAttribute('action') + '?search=' + encodeURIComponent(text.trim());
    if (type && type !== 'all') {
      url += '&type=' + encodeURIComponent(type);
    }
    if (params.length > 0) {
      url += '&' + params.join('&');
    }

    window.location.href = url;
  }, true);
})();