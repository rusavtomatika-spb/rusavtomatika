if ($('#vue_app_component_favorites').length > 0) {
  const app = new Vue({
    el: '#vue_app_component_favorites',
    data: {
      favorites: [],
      compare: []
    },
    watch: {
      favorites: function (newVal) {
        if (newVal.length > 0) {
          $('.catalog_toolbar__item.favorites .number').html(newVal.length);
          this.save_param_to_cookie('box2_favorites', newVal.join(','));
        } else {
          $('.catalog_toolbar__item.favorites .number').html('');
          this.save_param_to_cookie('box2_favorites', '');
        }
        localStorage.setItem('favorites', Date.now());
      },
      compare: function (newVal) {
        if (newVal.length > 0) {
          $('.catalog_toolbar__item.compare .number').html(newVal.length);
          this.save_param_to_cookie('box2_compare', newVal.join(','));
        } else {
          $('.catalog_toolbar__item.compare .number').html('');
          this.save_param_to_cookie('box2_compare', '');
        }
        localStorage.setItem('compare', Date.now());
      }
    },
    mounted: function () {
      const fav = this.getCookie('box2_favorites');
      if (fav) this.favorites = fav.split(',').filter(Boolean);

      const cmp = this.getCookie('box2_compare');
      if (cmp) this.compare = cmp.split(',').filter(Boolean);

      this.bindButtons();

      const self = this;
      $('.catalog_favorites__button_clearall').on('click', function () {
        self.favorites = [];
        self.save_param_to_cookie('box2_favorites', '', { 'max-age': -1 });
        $('#vue_app_component_favorites .view-mode-list, #vue_app_component_favorites .series_products')
          .html('<hr>Нет товаров...<hr>');
        $(this).css('display', 'none');
        $('.catalog_toolbar__item.favorites .number').html('');
        localStorage.setItem('favorites', Date.now());
        location.href = '/catalog/favorites/';
      });
    },
    methods: {
      bindButtons() {
        const self = this;

        document.querySelectorAll('#vue_app_component_favorites .cart').forEach(function (btn) {
          btn.onclick = function (e) {
            e.preventDefault();
            const model = btn.getAttribute('data-model');
            self.removeFromFavorites(model, btn);
          };
        });

        document.querySelectorAll('#vue_app_component_favorites .compare').forEach(function (btn) {
          const model = btn.getAttribute('data-model');
          if (self.compare.indexOf(model) !== -1) {
            btn.classList.add('active');
          }
          btn.onclick = function (e) {
            e.preventDefault();
            self.toggleCompare(model, btn);
          };
        });
      },
      removeFromFavorites(model, btn) {
        this.favorites = this.favorites.filter(function (m) { return m !== model; });

        const $item = $(btn).closest('.product__item-wrapper');
        $item.remove();

        if ($('#vue_app_component_favorites .product__item-wrapper').length === 0) {
          $('#vue_app_component_favorites .series_products').html('<hr>Нет товаров...<hr>');
          $('.catalog_favorites__button_clearall').hide();
        }
      },
      toggleCompare(model, btn) {
        const idx = this.compare.indexOf(model);

        if (idx === -1) {
          this.compare.push(model);
          btn.classList.add('active');
        } else {
          this.compare.splice(idx, 1);
          btn.classList.remove('active');
        }
      },
      getCookie(name) {
        const m = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()[\]\\\/+^])/g, '\\$1') + '=([^;]*)'));
        return m ? decodeURIComponent(m[1]) : undefined;
      },
      save_param_to_cookie(name, value, options) {
        if (options && options['max-age'] === -1) {
          document.cookie = encodeURIComponent(name) + '=; path=/; max-age=-1; domain=.' + window.location.host;
          return;
        }
        let date = new Date();
        date.setDate(date.getDate() + 365);
        document.cookie = encodeURIComponent(name) + '=' + encodeURIComponent(value) + '; path=/; expires=' + date.toUTCString() + '; domain=.' + window.location.host;
      }
    }
  });
}