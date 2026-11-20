if ($('#vue_app_component_favorites').length > 0) {
  var app = new Vue({
    el: '#vue_app_component_favorites',
    data: {
      init_in_process: true,
      favorites: [],
      compare: [],
      cart: [],
      viewed: []
    },
    watch: {
      favorites: function (newVal) {
        if (newVal.length > 0) {
          $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html(newVal.length);
          this.save_param_to_cookie('box2_favorites', newVal.join(','));
        } else {
          $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html('');
          this.save_param_to_cookie('box2_favorites', '');
        }
        localStorage.setItem('favorites', Date.now());
      },
      compare: function (newVal) {
        if (newVal.length > 0) {
          $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html(newVal.length);
          this.save_param_to_cookie('box2_compare', newVal.join(','));
        } else {
          $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html('');
          this.save_param_to_cookie('box2_compare', '');
        }
        localStorage.setItem('compare', Date.now());
      },
      cart: function (newVal) {
        if (newVal.length > 0) {
          $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html(newVal.length);
          this.save_param_to_cookie('box2_cart', newVal.join(','));
        } else {
          $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html('');
          this.save_param_to_cookie('box2_cart', '');
        }
        localStorage.setItem('cart', Date.now());
      },
      viewed: function (newVal) {
        if (newVal.length > 0) {
          $('.catalog_toolbar .catalog_toolbar__item.viewed .catalog_toolbar__item_number').html(newVal.length);
        } else {
          $('.catalog_toolbar .catalog_toolbar__item.viewed .catalog_toolbar__item_number').html('');
        }
      }
    },
    mounted: function () {
      this.$nextTick(function () {
        this.init();
      });
    },
    methods: {
      init() {
        const context = this;

        window.addEventListener('storage', function (event) {
          if (event.key == 'favorites') {
            setTimeout(function () {
              let favorites = context.getCookie('box2_favorites');
              if (favorites !== undefined) {
                favorites = favorites.replace(/^[\, ]|[\, ]$/g, '');
                if (favorites != "") {
                  context.favorites = favorites.split(",");
                } else {
                  context.favorites = [];
                }
                location.reload();
              }
            }, 1);
          }
          if (event.key == 'compare') {
            setTimeout(function () {
              let compare = context.getCookie('box2_compare');
              if (compare !== undefined) {
                compare = compare.replace(/^[\, ]|[\, ]$/g, '');
                if (compare != "") {
                  context.compare = compare.split(",");
                } else {
                  context.compare = [];
                }
              }
            }, 1);
          }
        });

        let favorites = this.getCookie('box2_favorites');
        if (favorites !== undefined) {
          favorites = favorites.replace(/^[\, ]|[\, ]$/g, '');
          if (favorites != "") this.favorites = favorites.split(",");
        }

        let compare = this.getCookie('box2_compare');
        if (compare !== undefined) {
          compare = compare.replace(/^[\, ]|[\, ]$/g, '');
          if (compare != "") this.compare = compare.split(",");
        }

        let cart = this.getCookie('box2_cart');
        if (cart !== undefined) {
          cart = cart.replace(/^[\, ]|[\, ]$/g, '');
          if (cart != "") this.cart = cart.split(",");
        }

        let viewed = this.getCookie('box2_viewed');
        if (viewed !== undefined) {
          viewed = viewed.replace(/^[\, ]|[\, ]$/g, '');
          if (viewed != "") this.viewed = viewed.split(",");
        }

        this.bindButtons();

        $('.catalog_favorites__button_clearall').on('click', function () {
          context.favorites = [];
          context.save_param_to_cookie('box2_favorites', '');
          $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html('');
          $('#vue_app_component_favorites .series_products').html('<hr>Нет товаров...<hr>');
          $(this).css('display', 'none');
          localStorage.setItem('favorites', Date.now());
          location.href = '/catalog/favorites/';
        });

        if ($('#vue_app_component_favorites .product__item-wrapper').length === 0) {
          $('.catalog_favorites__button_clearall').css('display', 'none');
        }

        this.init_in_process = false;
      },

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
        this.favorites = this.favorites.filter(function (m) {
          return m !== model;
        });

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
          this.do_flying_row($('.compare[data-model="' + model + '"]'), $('.catalog_toolbar__item.compare'));
        } else {
          this.compare.splice(idx, 1);
          btn.classList.remove('active');
        }
      },

      do_flying_row(source_element, destination_element = null) {
        if (source_element === undefined || source_element.length === 0) return;

        let destination_element_offset_left = window.innerWidth - 200;
        let destination_element_offset_top = 200;

        if (destination_element != null && destination_element.length > 0) {
          destination_element_offset_left = $(destination_element).offset()['left'];
          destination_element_offset_top = $(destination_element).offset()['top'] - window.innerHeight / 10;
        }

        const w = source_element.width();
        source_element.clone().addClass('flying_row')
          .css({
            'width': w,
            'position': 'absolute',
            'z-index': '9999',
            top: source_element.offset().top,
            left: source_element.offset().left
          })
          .appendTo("body")
          .animate({
            opacity: 0.05,
            left: destination_element_offset_left,
            top: destination_element_offset_top,
            width: 20
          }, 1000, function () {
            $(this).remove();
          });
      },

      save_param_to_cookie(param, value) {
        let date = new Date;
        date.setDate(date.getDate() + 365);
        date = date.toUTCString();
        this.setCookie(param, value, {'expires': date});
      },

      getCookie(name) {
        let matches = document.cookie.match(new RegExp(
          "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
      },

      setCookie(name, value, options = {}) {
        let date = new Date;
        date.setDate(date.getDate() + 365);
        date = date.toUTCString();
        options = {
          path: '/',
          'expires': date,
          domain: '.' + window.location.host,
        };

        if (options.expires instanceof Date) {
          options.expires = options.expires.toUTCString();
        }

        let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

        for (let optionKey in options) {
          updatedCookie += "; " + optionKey;
          let optionValue = options[optionKey];
          if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
          }
        }

        updatedCookie += ';SameSite=Strict;Secure';
        document.cookie = updatedCookie;
      },

      deleteCookie(name) {
        this.setCookie(name, "", {'max-age': -1});
      },

      getUrlVar() {
        var urlVar = window.location.search;
        var arrayVar = [];
        var valueAndKey = [];
        var resultArray = [];
        arrayVar = (urlVar.substr(1)).split('&');

        for (let i = 0; i < arrayVar.length; i++) {
          if (arrayVar[i] == "") continue;
          valueAndKey = arrayVar[i].split('=');
          resultArray[valueAndKey[0]] = valueAndKey[1];
        }

        return resultArray;
      }
    }
  });
}