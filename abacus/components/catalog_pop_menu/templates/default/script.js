(function () {
	if ($("#vue_catalog_pop_menu").length > 0) {
    function lockBodyScroll() {
      var scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
      if (scrollbarWidth > 0) {
        $('body').css('padding-right', scrollbarWidth + 'px');
      }
      $('html').addClass('overflow-body-hidden');
    }

    function unlockBodyScroll() {
      $('html').removeClass('overflow-body-hidden');
      $('body').css('padding-right', '');
    }

    $('.catalog_toolbar .open_pop_catalog').bind('click', function () {
      var $menu = $('#vue_catalog_pop_menu');
      $menu.removeAttr('style');
      if ($menu.hasClass('active')) {
        $menu.removeClass('active');
        $('.popup_background').removeClass('active');
        setTimeout(unlockBodyScroll, 400);
      } else {
        lockBodyScroll();
        $menu.addClass('active');
        $('.popup_background').addClass('active');
      }
    });

    $('.popup_background, .button_close_catalog_popmenu').bind('click', function () {
      $('#vue_catalog_pop_menu').removeAttr('style').removeClass('active');
      $('.popup_background').removeClass('active');
      setTimeout(unlockBodyScroll, 400);
    });

    var app = new Vue({
      el: '#vue_catalog_pop_menu',
      data: {
        url: {
          get_data: '/abacus/components/catalog_pop_menu/templates/default/catalog_pop_menu_ajax.php',
        },
        loading_status: false,
        pressed_button: null,
        arrBrands: [],
        arrSections: [],
        arrProducts: [],
        current_action: '',
        current_brand: '',
        current_section_code: '',
        html_result: '',
        section_list__set_diagonal_span_show: false,
        section_list__set_processor_span_show: false,

      },
      watch: {},
      created: function () {},
      methods: {
        alert(message) {
          alert(message);
        },

        close_catalog_popmenu: function () {
          $('#vue_catalog_pop_menu').removeAttr('style');
          $('#vue_catalog_pop_menu').removeClass('active');
          $('.popup_background').removeClass('active');
          $('html').removeClass('overflow-body-hidden');
        },

        pull_data_from_server: function () {
          this.send();

        },
        handle_option_list: function () {
          this.current_action = this.action = "show_options";
          this.setCookie("catalog_popmenu_action", "show_options");
          this.html_result = "";
          this.send();
        },

        pop_menu_filter_options: function (event) {
          const data_filter = $(event.target).attr('data-filter');
          $('#vue_catalog_pop_menu .cataloge_list-title.button_show_items').removeClass('active-item');
          $(event.target).addClass('active-item');

          console.log(event);
          switch (data_filter) {
            case 'all':
              $('#vue_catalog_pop_menu li.series-list-item-subitem').show();
              break;
            default:
              $('#vue_catalog_pop_menu li.series-list-item-subitem.filter_' + data_filter).show();
              $('#vue_catalog_pop_menu li.series-list-item-subitem:not(.filter_' + data_filter + ')').hide();
              break;
          }
        },

        pop_menu_switch_category: function (event) {
          $('.cataloge-left-side-switch li').removeClass('active');
          $(event.target).addClass('active');
          const data_show = $(event.target).attr('data-show');
          $('.' + data_show).show();

          switch (data_show) {
            case "cataloge-list":
              $('.brand-list').hide();
              $('.option-list').hide();
              break;
            case "brand-list":
              $('.cataloge-list').hide();
              $('.option-list').hide();
              break;
            case "option-list":
              $('.brand-list').hide();
              $('.cataloge-list').hide();
              this.handle_option_list();
              break;
          }
        },
        send() {
          if (this.loading_status == true) {
            return;
          }
          this.loading_status = true;
          $(this.pressed_button).css({
            opacity: '0.4',
            color: '#999'
          });
          axios({
            method: 'POST',
            url: this.url.get_data,
            data: {
              action: this.action,
              brand: this.brand,
              category: this.section_code,
              category_id: this.section_id,
              link: this.link,
            },
            headers: {
              "Content-type": "application/x-www-form-urlencoded"
            }
          }).then((response) => {
            this.html_result = response.data;
          }).catch(error => {
            console.log(error)
          }).finally(() => {
            $('#vue_catalog_pop_menu .button_show_items').css({
              opacity: '',
              color: ''
            });
            setTimeout((pressed_button) => {
              this.loading_status = false;
            }, 1);
          });
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
          setCookie(name, "", {
            'max-age': -1
          })
        },
      },
      computed: {}
    });
  }
})();