(function () {
    let arr_favorites = [];
    let arr_cart = [];
    let arr_compare = [];
    let arr_viewed = [];


    window.addEventListener('storage', function (event) {
        switch (event.key) {
            case 'compare':
                setTimeout(function () {
                    let compare = getCookie('box2_compare');
                    if (compare !== undefined && compare.length > 0) {
                        if (compare[0] == ',') {
                            compare = compare.substring(1);
                        }
                        arr_compare = compare.split(",");
                        if (arr_compare.length > 0) {
                            $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html(arr_compare.length);
                        } else $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html('');
                    } else {
                        $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html('');
                    }
                }, 1000);
                break;
            case 'favorites':
                setTimeout(function () {
                    let favorites = getCookie('box2_favorites');
                    if (favorites !== undefined && favorites.length > 0) {
                        if (favorites[0] == ',') {
                            favorites = favorites.substring(1);
                        }
                        arr_favorites = favorites.split(",");
                        if (arr_favorites.length > 0) {
                            $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html(arr_favorites.length);
                        } else $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html('');
                    } else {
                        $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html('');
                    }
                }, 1000);
                break;
            case 'cart':
                setTimeout(function () {
                    let cart = getCookie('box2_cart');
                    if (cart !== undefined && cart.length > 0) {
                        if (cart[0] == ',') {
                            cart = cart.substring(1);
                        }
                        arr_cart = cart.split(",");
                        if (arr_cart.length > 0) {
                            $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html(arr_cart.length);
                            let button_cart_model = $('.add_to_cart.is-active').attr('data-model');
                            if (button_cart_model) {
                                if (arr_cart.indexOf(button_cart_model) == -1) {
                                    $('.add_to_cart.is-active').removeClass('is-active');
                                    $('.add_to_cart .btn_icon_order_text').html('в заказ');
                                }
                            }
                        } else {
                            $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html('');
                            $('.add_to_cart.is-active').removeClass('is-active');
                            $('.add_to_cart .btn_icon_order_text').html('в заказ');
                        }
                    } else {
                        $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html('');
                        $('.add_to_cart.is-active').removeClass('is-active');
                        $('.add_to_cart .btn_icon_order_text').html('в заказ');
                    }

                }, 1000);
                break;

        }
    });


    if (!document.getElementById('vue_component_catalog_section')) {

        /* init catalog_toolbar  init catalog_toolbar  init catalog_toolbar  init catalog_toolbar  init catalog_toolbar */
        let favorites = getCookie('box2_favorites');
        if (favorites !== undefined && favorites.length > 0) {
            if (favorites[0] == ',') {
                favorites = favorites.substring(1);
            }
            arr_favorites = favorites.split(",");
            if (arr_favorites.length > 0) {
                $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html(arr_favorites.length);
            } else $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html('');
        }
        let cart = getCookie('box2_cart');
        if (cart !== undefined && cart != '') {
            cart = cart.replace(/^[\, ]|[\, ]$/g, '');
            arr_cart = cart.split(",");

            if (arr_cart.length > 0) {
                $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html(arr_cart.length);
            } else $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html('');
        }
        let compare = getCookie('box2_compare');
        if (compare !== undefined && compare.length > 0) {
            if (compare[0] == ',') {
                compare = compare.substring(1);
            }
            arr_compare = compare.split(",");
            if (arr_compare.length > 0) {
                $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html(arr_compare.length);
            } else $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html('');
        }

        let viewed = getCookie('box2_viewed');
        if (viewed !== undefined && viewed.length > 0) {
            if (viewed[0] == ',') {
                viewed = viewed.substring(1);
            }
            if (viewed.length > 0) {
                arr_viewed = viewed.split(",");
                if (arr_viewed.length > 0) {
                    $('.catalog_toolbar .catalog_toolbar__item.viewed .catalog_toolbar__item_number').html(arr_viewed.length);
                } else $('.catalog_toolbar .catalog_toolbar__item.viewed .catalog_toolbar__item_number').html('');
            }
        }
    }
    /* end  init catalog_toolbar */
///////////////////////////////////////////////////////////////////////////////////////////////////
    /* init sending to toolbar buttons  */


    /* end init sending to toolbar buttons  */
///////////////////////////////////////////////////////////////////////////////////////////////////
    if ($("div").is(".catalog_favorites,.catalog_cart,.catalog_viewed")) {

        $('.component_catalog_section__panel_of_products .buttons_panel button').each(function (i, elem) {
            handle_button(elem);
        });
        $('.catalog_cart .buttons_panel button').each(function (i, elem) {
            handle_button(elem);
        });

        $('.component_catalog_section__panel_of_products .buttons_panel button').bind('click', add_too_box);


        $('.catalog_cart .buttons_panel button').bind('click', add_too_box);


    }

    function handle_button(elem) {
        const model = $(elem).attr('data-model');
        const box = $(elem).attr('data-box');

        let arr_box;
        switch (box) {
            case 'favorites':
                arr_box = arr_favorites;
                break;
            case 'compare':
                arr_box = arr_compare;
                break;
            case 'cart':
                arr_box = arr_cart;
                break;
            default:
                return false;
                break;
        }
        if (arr_box !== undefined && arr_box.indexOf(model) !== -1) {
            $(elem).addClass('active');
        }
    }

    function add_too_box(e) {
        let button = e.target;
        if (button.attributes['data-model'].value != '') {

            const model = button.attributes['data-model'].value;
            const box = button.attributes['data-box'].value;
            switch (box) {
                case 'favorites':
                    let favorites = getCookie('box2_favorites');
                    if (favorites !== undefined && favorites.length > 0) {
                        if (favorites[0] == ',') {
                            favorites = favorites.substring(1);
                        }
                        arr_favorites = favorites.split(",");
                        if (arr_favorites.length > 0) {
                            $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html(arr_favorites.length);
                        } else $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html('');
                    }

                    if (arr_favorites.indexOf(model) === -1) {
                        $(button).addClass('active');
                        arr_favorites.push(model);
                        const source_element = $('.tr_product_' + model);
                        const destination_element = $(".catalog_toolbar__item." + box);
                        do_flying_row(source_element, destination_element);

                    } else {
                        arr_favorites.splice(arr_favorites.indexOf(model), 1);
                        $(button).removeClass('active');
                        do_flying_row($(button));

                        if ($('.catalog_favorites').length > 0) {
                            setTimeout(function () {
                                $('.tr_product_' + model).remove();
                            }, 1000);
                        }
                    }
                    save_param_to_cookie('box2_favorites', arr_favorites.join(','));
                    if (arr_favorites.length > 0) {
                        $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html(arr_favorites.length);
                    } else $('.catalog_toolbar .catalog_toolbar__item.favorites .catalog_toolbar__item_number').html('');
                    localStorage.setItem('favorites', Date.now());
                    break;
                case 'compare':
                    let compare = getCookie('box2_compare');
                    if (compare !== undefined && compare.length > 0) {
                        if (compare[0] == ',') {
                            compare = compare.substring(1);
                        }
                        arr_compare = compare.split(",");
                        if (arr_compare.length > 0) {
                            $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html(arr_compare.length);
                        } else $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html('');
                    }

                    if (arr_compare.indexOf(model) === -1) {
                        $(button).addClass('active');
                        arr_compare.push(model);
                        const source_element = $('.tr_product_' + model);
                        const destination_element = $(".catalog_toolbar__item." + box);
                        do_flying_row(source_element, destination_element);
                    } else {
                        arr_compare.splice(arr_compare.indexOf(model), 1);
                        $(button).removeClass('active');
                        do_flying_row($(button));
                    }
                    save_param_to_cookie('box2_compare', arr_compare.join(','));
                    if (arr_compare.length > 0) {
                        $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html(arr_compare.length);
                    } else $('.catalog_toolbar .catalog_toolbar__item.compare .catalog_toolbar__item_number').html('');
                    localStorage.setItem('compare', Date.now());
                    break;
                case 'cart':
                    if (arr_cart.indexOf(model) == -1) {
                        $(button).addClass('active');
                        arr_cart.push(model);
                        const source_element = $('.tr_product_' + model);
                        const destination_element = $(".catalog_toolbar__item." + box);
                        do_flying_row(source_element, destination_element);
                    } else {
                        arr_cart.splice(arr_cart.indexOf(model), 1);
                        $(button).removeClass('active');
                        do_flying_row($(button));
                    }
                    save_param_to_cookie('box2_cart', arr_cart.join(','));
                    if (arr_cart.length > 0) {
                        $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html(arr_cart.length);
                    } else $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html('');
                    localStorage.setItem('cart', Date.now());
                    break;
                case 'delete_from_cart':
                    confirm_action("Удаление товара", "Вы точно хотите удалить товар &laquo;" + model + "&raquo; из корзины?",
                        " Удалить&nbsp;&nbsp;", "Оставить", model,
                        delete_product_from_cart_page);
                    /* arr_cart.splice(arr_cart.indexOf(model), 1);
                     $(button).removeClass('active');
                     do_flying_row($(button));
                     save_param_to_cookie('box2_cart', arr_cart.join(','));
                     if (arr_cart.length > 0) {
                         $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html(arr_cart.length);
                     } else $('.catalog_toolbar .catalog_toolbar__item.cart .catalog_toolbar__item_number').html('');*/

                    break;
                case 'delete_from_viewed':
                    arr_viewed.splice(arr_viewed.indexOf(model), 1);
                    save_param_to_cookie('box2_viewed', arr_viewed.join(','));
                    $('.series_products tr.tr_product_' + model).remove();
                    localStorage.setItem('viewed', Date.now());
                    break;
                default:
                    return false;
            }

        }
    }

    function delete_product_from_cart_page(obj) {
        const model = $(obj.target).attr('data-model');
        arr_cart.splice(arr_cart.indexOf(model), 1);
        save_param_to_cookie('box2_cart', arr_cart.join(','));
        $('.series_products tr.tr_product_' + model).remove();
        if (arr_cart.length) {
            $('.catalog_toolbar__item.cart .catalog_toolbar__item_number').html(arr_cart.length);
        } else {
            $('.catalog_toolbar__item.cart .catalog_toolbar__item_number').html('');
            $('.component_catalog_cart__panel_of_products').html('');
            $('.block_order').html('');
        }

        console.log(arr_cart.length);
        $('.catalog_toolbar__dialog_wrapper').css("display", "none");
        localStorage.setItem('cart', Date.now());
        location.reload();
    }

    function confirm_action(title, question, button_confirm, button_cancel, model, callback_function) {
        $('.catalog_toolbar__dialog .title').html(title);
        $('.catalog_toolbar__dialog .question').html(question);
        $('.catalog_toolbar__dialog .button_confirm').html(button_confirm);
        $('.catalog_toolbar__dialog .button_confirm').attr('data-model', model);
        $('.catalog_toolbar__dialog .button_cancel').html(button_cancel);
        $('.catalog_toolbar__dialog .button_confirm').off('click');
        $('.catalog_toolbar__dialog .button_confirm').on('click', callback_function);
        $('.catalog_toolbar__dialog .button_cancel').on('click', function () {
            $('.catalog_toolbar__dialog_wrapper').css("display", "none");
        });
        $('.catalog_toolbar__dialog_wrapper').css("display", "flex");

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
        setCookie(param, value, {'expires': date});
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

        document.cookie = updatedCookie;
    }

    function do_flying_row(source_element, destination_element = null) {
        if (source_element === undefined || destination_element === undefined) return;

        let destination_element_offset_left = window.innerWidth - 200;
        let destination_element_offset_top = 200;

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
            }, 800, function () {
                $(this).remove();

            });
        setTimeout(function () {
            $('.catalog_toolbar__item.favorite').css({"background": "rgba(38,117,60,0.97)"});

            setTimeout(function () {
                $('.catalog_toolbar__item.favorite').css({"background": "none"});
            }, 800);
        }, 800);
    }


})();





