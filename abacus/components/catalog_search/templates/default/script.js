var app = new Vue({
    el: '#vue_app_component_catalog_search',
    data: {
        favorites: [],
        cart: [],
        compare: [],
        viewed: [],
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
    mounted: function () {
        this.$nextTick(function () {
            this.init();
        });
    },


    methods: {
        init() {
            let favorites = this.getCookie('box2_favorites');
            if (favorites !== undefined) {
                favorites = favorites.replace(/^[\, ]|[\, ]$/g, '');
                if (favorites != "") this.favorites = favorites.split(",");
            }
            let cart = this.getCookie('box2_cart');
            if (cart !== undefined) {
                cart = cart.replace(/^[\, ]|[\, ]$/g, '');
                if (cart != "") this.cart = cart.split(",");

            }

                let compare = this.getCookie('box2_compare');
                if (compare !== undefined) {
                    compare = compare.replace(/^[\, ]|[\, ]$/g, '');
                    if (compare != ""){
                        this.compare = compare.split(",");

                    }
                }


            let viewed = this.getCookie('box2_viewed');
            if (viewed !== undefined) {
                viewed = viewed.replace(/^[\, ]|[\, ]$/g, '');
                if (viewed != "") this.viewed = viewed.split(",");
            }

            const all = Array.from(document.querySelectorAll('.series_products__button'));

            all.forEach(u => {
                const action = u.getAttribute('data-box');
                if (action) {
                    u.onclick = this[action];
                    const model = u.getAttribute('data-model');
                    const box = u.getAttribute('data-box');

                    switch (box) {
                        case 'favorites':
                            if (this.favorites.indexOf(model) != -1) {
                                u.classList.add("active");
                            }
                            break;
                        case 'cart':
                            if (this.cart.indexOf(model) != -1) {
                                u.classList.add("active");
                                $(u).html("В заказе");
                            }
                            break;
                        case 'compare':
                            if (this.compare.indexOf(model) != -1) {
                                u.classList.add("active");
                            }
                            break;
                    }
                }
            });
        },
        open_form_require_price(e) {
            $('.component_form_require_price .text_model').html(e.target.getAttribute('data-rel-model'));
            $('.component_form_require_price').addClass('active');
            setTimeout(function () {
                $('.component_form_require_price').css('opacity', '1');
            }, 1);
        },

        add_too_box(e) {
            let button = e.target;

            if (button.attributes['data-model'].value != '') {
                const model = button.attributes['data-model'].value;
                const box = button.attributes['data-box'].value;
                switch (box) {
                    case 'favorites':
                        if (this.favorites.indexOf(model) === -1) {
                            $(button).addClass('active');
                            this.favorites.push(model);
                            const source_element = $('.favorites[data-model="' + model + '"]');
                            const destination_element = $(".catalog_toolbar__item." + box);
                            this.do_flying_row(source_element, destination_element);
                        } else {
                            this.favorites.splice(this.favorites.indexOf(model), 1);
                            $(button).removeClass('active');
                            const source_element = $('.favorites[data-model="' + model + '"]');
                            const destination_element = $(".catalog_toolbar__item." + box);
                            this.do_flying_row(destination_element, source_element);
                        }
                        break;
                    case 'compare':
                        if (this.compare.indexOf(model) === -1) {
                            $(button).addClass('active');
                            this.compare.push(model);
                            const source_element = $('.compare[data-model="' + model + '"]');
                            const destination_element = $(".catalog_toolbar__item." + box);
                            this.do_flying_row(source_element, destination_element);
                        } else {
                            this.compare.splice(this.compare.indexOf(model), 1);
                            $(button).removeClass('active');
                            const source_element = $('.compare[data-model="' + model + '"]');
                            const destination_element = $(".catalog_toolbar__item." + box);
                            this.do_flying_row(destination_element, source_element);
                        }
                        break;




                    case 'cart':
                        if (this.cart.indexOf(model) == -1) {
                            $(button).addClass('active').html("В заказе");
                            this.cart.push(model);
                            const source_element = $('button.series_products__button[data-model="' + model + '"]');
                            const destination_element = $(".catalog_toolbar__item.cart");
                            this.do_flying_row(source_element, destination_element);
                        } else {
                            this.cart.splice(this.cart.indexOf(model), 1);
                            $(button).removeClass('active').html("В заказ");
                            const source_element = $('.series_products__button[data-model="' + model + '"]');
                            const destination_element = $(".catalog_toolbar__item." + box);
                            this.do_flying_row(destination_element, source_element);
                        }
                        break;
                    default:
                        return false;
                }

            }
        },
        save_param_to_cookie(param, value) {
            let date = new Date;
            date.setDate(date.getDate() + 365);
            date = date.toUTCString();
            this.setCookie(param, value, {'expires': date});
        },
        do_flying_row(source_element, destination_element = null) {
            if (source_element === undefined) return;

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
                }, 1000, function () {
                    $(this).remove();

                });
            setTimeout(function () {
                $('.catalog_toolbar__item.favorite').css({"background": "rgba(38,117,60,0.97)"});

                setTimeout(function () {
                    $('.catalog_toolbar__item.favorite').css({"background": "none"});
                }, 800);
            }, 800);

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

            document.cookie = updatedCookie;
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

        getUrlVar() {
            var urlVar = window.location.search; // получаем параметры из урла
            var arrayVar = []; // массив для хранения переменных
            var valueAndKey = []; // массив для временного хранения значения и имени переменной
            var resultArray = []; // массив для хранения переменных
            arrayVar = (urlVar.substr(1)).split('&'); // разбираем урл на параметры

            //if (arrayVar[0] == "") return false; // если нет переменных в урле
            for (let i = 0; i < arrayVar.length; i++) { // перебираем все переменные из урла
                if (arrayVar[i] == "") continue;
                valueAndKey = arrayVar[i].split('='); // пишем в массив имя переменной и ее значение
                resultArray[valueAndKey[0]] = valueAndKey[1]; // пишем в итоговый массив имя переменной и ее значение
            }

            return resultArray; // возвращаем результат
        },


    }
});