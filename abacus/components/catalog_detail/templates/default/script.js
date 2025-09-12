var app = new Vue({
  el: '#vue_component_catalog_detail',
  data: {
    favorites: [],
    compare: [],
    cart: [],
    current_section: 1,
  },
  mounted: function () {
    this.$nextTick(function () {
      this.init();
    });
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
    },
    compare: function (newVal) {
      if (newVal.length > 0) {
        $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html(newVal.length);
        this.save_param_to_cookie('box2_compare', newVal.join(','));
      } else {
        $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html('');
        this.save_param_to_cookie('box2_compare', '');
      }
    },
    viewed: function (newVal) {
      if (newVal.length > 0) {
        $('.catalog_toolbar .catalog_toolbar__item.viewed .catalog_toolbar__item_number').html(newVal.length);
        //this.save_param_to_cookie('box2_viewed', newVal.join(','));
      } else {
        $('.catalog_toolbar .catalog_toolbar__item.viewed .catalog_toolbar__item_number').html('');
        //this.save_param_to_cookie('box2_viewed', '');
      }
    },
    cart: function (newVal) {

      if (newVal.length > 0) {
        $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html(newVal.length);
        this.save_param_to_cookie('box2_cart', newVal.join(','));
      } else {
        $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html('');
        this.save_param_to_cookie('box2_cart', '');
      }
    },

  },
  methods: {
    init() {

      const context = this;


      window.addEventListener('storage', function (event) {

        switch (event.key) {
          case 'compare':
            setTimeout(function () {
              let compare = context.getCookie('box2_compare');
              if (compare !== undefined) {
                compare = compare.replace(/^[\, ]|[\, ]$/g, '');

                if (compare != "") {
                  context.compare = compare.split(",");
                  let model = $('#vue_component_catalog_detail').attr('data-model');
                  if (context.compare.indexOf(model) >= 0) {
                    $('.button.add_to_compare').addClass('is-active');
                  } else {
                    $('.button.add_to_compare').removeClass('is-active');
                  }
                } else {
                  context.compare = [];
                  $('.button.add_to_compare').removeClass('is-active');

                }
              }
            }, 1000);
            break;
          case 'favorites':
            setTimeout(function () {
              let favorites = context.getCookie('box2_favorites');
              if (favorites !== undefined) {
                favorites = favorites.replace(/^[\, ]|[\, ]$/g, '');
                if (favorites != "") {
                  context.favorites = favorites.split(",");
                  let model = $('#vue_component_catalog_detail').attr('data-model');
                  if (context.favorites.indexOf(model) >= 0) {
                    $('.button.add_to_favorites').addClass('is-active');
                  } else {
                    $('.button.add_to_favorites').removeClass('is-active');
                  }
                } else {
                  context.favorites = [];
                  $('.button.add_to_favorites').removeClass('is-active');
                }
              }
            }, 1000);
            break;
        }
      });


      const model = $('#vue_component_catalog_detail').attr('data-model');
      /***********************************************************************************************************/
      let favorites = this.getCookie('box2_favorites');
      if (favorites !== undefined) {
        favorites = favorites.replace(/^[\, ]|[\, ]$/g, '');
        if (favorites != "") this.favorites = favorites.split(",");
      }
      if (this.favorites.indexOf(model) >= 0) {
        $('.button.add_to_favorites').addClass('is-active');
      }
      /***********************************************************************************************************/
      let compare = this.getCookie('box2_compare');
      if (compare !== undefined) {
        compare = compare.replace(/^[\, ]|[\, ]$/g, '');
        if (compare != "") this.compare = compare.split(",");
      }
      if (this.compare.indexOf(model) >= 0) {
        $('.button.add_to_compare').addClass('is-active');
      }
      /***********************************************************************************************************/
      let cart = this.getCookie('box2_cart');
      if (cart !== undefined) {
        cart = cart.replace(/^[\, ]|[\, ]$/g, '');
        if (cart != "") this.cart = cart.split(",");
      }

      if (this.cart.indexOf(model) >= 0) {
        $('.button.add_to_cart').addClass('is-active');
        $('.button.add_to_cart .btn_icon_order_text').html('в заказе');
      }
    },
    add_too_box(e) {
      let button = e.target;
      if (!$(button).hasClass('button')) {
        button = $(button).parent();
      }
      if ($(button).attr('data-model') != '') {
        const model = $(button).attr('data-model');
        const box = $(button).attr('data-box');
        switch (box) {
          case 'favorites':
            let favorites = this.getCookie('box2_favorites');
            if (favorites !== undefined) {
              favorites = favorites.replace(/^[\, ]|[\, ]$/g, '');
              if (favorites != "") this.favorites = favorites.split(",");
            }
            if (this.favorites.indexOf(model) === -1) {
              $(button).addClass('is-active');
              this.favorites.push(model);
              const source_element = $(button);
              const destination_element = $(".catalog_toolbar__item." + box);
              this.do_flying_row(source_element, destination_element);
            } else {
              this.favorites.splice(this.favorites.indexOf(model), 1);
              $(button).removeClass('is-active');
              this.do_flying_row($(button));
            }
            localStorage.setItem('favorites', Date.now());
            break;
          case 'compare':
            let compare = this.getCookie('box2_compare');
            if (compare !== undefined) {
              compare = compare.replace(/^[\, ]|[\, ]$/g, '');
              if (compare != "") this.compare = compare.split(",");
            }
            if (this.compare.indexOf(model) === -1) {
              $(button).addClass('is-active');
              this.compare.push(model);
              const source_element = $(button);
              const destination_element = $(".catalog_toolbar__item." + box);
              this.do_flying_row(source_element, destination_element);
            } else {
              this.compare.splice(this.compare.indexOf(model), 1);
              $(button).removeClass('is-active');
              this.do_flying_row($(button));
            }
            localStorage.setItem('compare', Date.now());
            break;
          case 'cart':
            if (this.cart.indexOf(model) == -1) {
              $('.button.add_to_cart').addClass('is-active');
              $('.button.add_to_cart .btn_icon_order_text').html('в заказе');
              this.cart.push(model);
              const source_element = $(button);
              const destination_element = $(".catalog_toolbar__item." + box);
              this.do_flying_row(source_element, destination_element);
            } else {
              this.cart.splice(this.cart.indexOf(model), 1);

              $('.button.add_to_cart').removeClass('is-active');
              $('.button.add_to_cart .btn_icon_order_text').html('в заказ');
              this.do_flying_row($(button));
            }
            localStorage.setItem('cart', Date.now());
            break;
          default:
            return false;
        }

      }
    },
    do_flying_row(source_element, destination_element = null) {
      if (source_element === undefined) return;

      let destination_element_offset_left = window.innerWidth - 200;
      let destination_element_offset_top = 2000;

      if (destination_element != null) {
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
      setTimeout(function () {
        $('.catalog_toolbar__item.favorite').css({
          "background": "rgba(38,117,60,0.97)"
        });

        setTimeout(function () {
          $('.catalog_toolbar__item.favorite').css({
            "background": "none"
          });
        }, 800);
      }, 800);

    },

    change_section(num) {
      this.current_section = num;
      let menu_top = $('#replace_detail_text_with_file').offset().top - 100;
      $('body, html').animate({
        scrollTop: menu_top
      }, 800);
    },
    next_section() {
      this.current_section++;
      let menu_top = $('#replace_detail_text_with_file').offset().top - 100;
      $('body, html').animate({
        scrollTop: menu_top
      }, 800);
    },


    save_param_to_cookie(param, value) {
      let date = new Date;
      date.setDate(date.getDate() + 365);
      date = date.toUTCString();
      this.setCookie(param, value, {
        'expires': date
      });
    },
    ///////////////////////////////////////////////////Cookie///////////////////////////////////////////////////////
    ///////////////////////////////////////////////////Cookie///////////////////////////////////////////////////////
    ///////////////////////////////////////////////////Cookie///////////////////////////////////////////////////////
    ///////////////////////////////////////////////////Cookie///////////////////////////////////////////////////////
    getCookie(name) {
      let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    },
    setCookie(name, value, options = {}) {

      // Пример использования:
      //setCookie('user', 'John', {secure: true, 'max-age': 3600});
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

      //console.log("detail_cookie: " + updatedCookie);
      document.cookie = updatedCookie;
      //console.log("detail_cookie: " + updatedCookie);
    },
    deleteCookie(name) {
      setCookie(name, "", {
        'max-age': -1
      })
    },
    ///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
    ///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
    ///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
    ///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////


  },
});


/*******************************************************************************************************************/

$(function () {
  $(".component_catalog_detail__images-mini").bind("click", function () {
    data_rel = $(this).attr("data-rel");
    $(".component_catalog_detail__images-mini").removeClass("active");
    $(this).addClass("active");
    $(".component_catalog_detail__image-main_link").hide();
    $("#" + data_rel).show();
  });
  $(".component_catalog_detail__images-mini__inner .component_catalog_detail__images-mini:first").click();
});


let sections = $('.component_catalog_detail section'),
  nav = $('.sticky_block nav'),
  nav_height = $('.sticky_block').outerHeight();

$(window).on('scroll', function () {
  let window_scroll_top = $(this).scrollTop();
  let nav_offset_top = $('#start').offset().top + 20;

  if (window_scroll_top > nav_offset_top) {
    if (!$('.sticky_block').hasClass('fixed')) {
      $('.sticky_block').addClass('fixed');
      $('.sticky_block_wrap_inn').addClass('container-xxl');
      setTimeout(function () {
        $('.sticky_block').animate({
          top: 30
        }, 600);
      }, 100);
    }
  } else {
    if ($('.sticky_block').hasClass('fixed') && !$('.sticky_block').hasClass('in_animation')) {
      $('.sticky_block').addClass('in_animation');
      $('.sticky_block').animate({
        top: '-150px'
      }, 600, function () {
        $('.sticky_block').removeClass('fixed');
        $('.sticky_block').removeClass('in_animation');
        $('.sticky_block_wrap_inn').removeClass('container-xxl');
      });
    }
  }
  $('nav li').removeClass('is-active');
  let cur_pos = $(this).scrollTop();

  sections.each(function () {
    let top = $(this).offset().top - nav_height - 100,
      bottom = top + $(this).outerHeight() + 30;
    if (cur_pos >= top && cur_pos <= bottom) {
      nav.find('a').removeClass('active');
      sections.removeClass('active');
      $(this).addClass('active');
      nav.find('a[href="#' + $(this).attr('id') + '"]').parent().addClass('is-active');
    }
  });
  if (!$('.component_catalog_detail__nav ul li').hasClass('is-active')) {
    $('.component_catalog_detail__nav ul li:first-child').addClass('is-active');
  }

});

nav.find('a').on('click', function () {

  if (document.body.scrollTop < 100) {
    element_shift = 200;
  } else {
    element_shift = 60;
  }
  let $el = $(this),
    id = $el.attr('href'),
    top = $(id).offset().top - nav_height - element_shift;
  if (id == '#start') top = 0;
  $('html, body').animate({
    scrollTop: top
  }, 600);
  $('.component_catalog_detail__nav').removeClass('opened');
  return false;
});

$(function () {
  $(".button_open_this_menu").bind("click", function () {
    $('.component_catalog_detail__nav').addClass('opened');
  });
});


/****************************************************************************************************************/


$(document).ready(function () {

  add_product_to_box_viewed();

  const current_tab = getUrlParameter('tab');
  if (current_tab != '') {
    switch (current_tab) {
      case 'accessories':
        $('a[href="#tabs-5"]').click();
        break;
      case 'functions':
        $('a[href="#tabs-1"]').click();
        break;
      case 'software':
        $('a[href="#tabs-4"]').click();
        break;
      case 'dimensions':
        $('a[href="#tabs-2"]').click();
        break;
      case 'scheme':
        $('a[href="#tabs-3"]').click();
        break;
    }
  }


  $('.urlup').click(function () {
    const dat = $(this).attr('data');
    var nnew = 'https://' + location.hostname + window.location.pathname + '?tab=' + dat;
    if (nnew != window.location) {
      window.history.pushState(null, null, nnew);
    }
  });

  function add_product_to_box_viewed() {
    let current_model = '';
    current_model = $('#vue_component_catalog_detail').attr("data-model");
    //current_model = transformString(current_model);
    if (current_model != undefined && current_model != '') {
      let box_viewed = '';
      let arr_box_viewed = [];
      box_viewed = getCookie('box2_viewed');
      if (box_viewed !== undefined) {
        if (box_viewed[0] == ',') {
          box_viewed = box_viewed.substring(1);
        }
        arr_box_viewed = box_viewed.split(",");
        if (arr_box_viewed.length > 0) {
          const position = arr_box_viewed.indexOf(current_model);
          if (position === -1) {
            arr_box_viewed.push(current_model);
            save_param_to_cookie('box2_viewed', arr_box_viewed.join(','));
          } else {
            arr_box_viewed.splice(position, 1);
            arr_box_viewed.push(current_model);
            save_param_to_cookie('box2_viewed', arr_box_viewed.join(','));
          }
        }
      } else {
        save_param_to_cookie('box2_viewed', current_model);
      }
    }

  }


  function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }

  function save_param_to_cookie(param, value) {
    let date = new Date;
    date.setDate(date.getDate() + 365);
    date = date.toUTCString();
    setCookie(param, value, {
      'expires': date
    });
  }

  function setCookie(name, value, options = {}) {

    // Пример использования:
    //setCookie('user', 'John', {secure: true, 'max-age': 3600});
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
  }

});

function copyToClipboard(textToCopy) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(textToCopy).select();
  document.execCommand("copy");
  $temp.remove();
}

var getUrlParameter = function (sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
};
