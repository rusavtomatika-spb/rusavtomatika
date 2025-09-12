
if ($('#vue_app_component_compare').length > 0) {
    var app = new Vue({
        el: '#vue_app_component_compare',
        data: {
            init_in_process: true,
            favorites: [],
            view_mode: 0,
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
                let context = this;
                window.addEventListener('storage', function(event) {
                    if(event.key == 'compare'){
                        setTimeout(function () {
                            let compare = context.getCookie('box2_compare');
                            if (compare !== undefined) {
                                compare = compare.replace(/^[\, ]|[\, ]$/g, '');
                                if (compare != "") {
                                    context.compare = compare.split(",");
                                    context.set_models_to_url();
                                    console.log(context.compare);
                                    location.reload();
                                }
                            }
                        },1);
                    }
                });



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
                this.get_models_from_url();
                if (this.compare.length == 0) {
                    let compare = this.getCookie('box2_compare');
                    if (compare !== undefined) {
                        compare = compare.replace(/^[\, ]|[\, ]$/g, '');
                        if (compare != "") {
                            this.compare = compare.split(",");
                            this.set_models_to_url();
                        }
                    }
                }

                let viewed = this.getCookie('box2_viewed');
                if (viewed !== undefined) {
                    viewed = viewed.replace(/^[\, ]|[\, ]$/g, '');
                    if (viewed != "") this.viewed = viewed.split(",");
                }

                const all = Array.from(document.querySelectorAll('.table_compare__button'));

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
            set_models_to_url() {
                const current_base_url = window.location.origin + window.location.pathname;
                let url1 = new URL(window.location.href);
                let str_models = url1.searchParams.get('models');
                console.log(str_models);
                console.log(this.compare.join(','));

                if (str_models !== undefined && str_models !== '') {
                    let compare_reversed = this.compare.reverse();
                    let compare_reversed_joined = compare_reversed.join(',');
                    url1.searchParams.set('models', compare_reversed_joined);
                    //let compare_reversed = this.compare;
                    //let compare_reversed_joined = this.compare;
                    //url1.searchParams.set('models', compare_reversed_joined);
                    window.history.pushState(null, null, decodeURIComponent(url1.href));
                    $('.copy_link_input').val(url1.href);
                }
            },
            get_models_from_url() {
                let url_params = [];
                let data_models = $('#vue_data').attr('data-models');
                if (data_models !== undefined && data_models != '') {
                    url_params['models'] = data_models;
                    let str_models = decodeURI(url_params['models']);
                    str_models = str_models.replace(/[^a-zA-Z-\d\,\(\)]/g, "");
                    let arr_models = str_models.split(',');
                    arr_models.forEach(function (item, i, arr) {
                        arr[i] = arr[i].replace('%20', '');
                        if (arr[i] == '') {
                            arr.splice(i, 1);
                        }
                    });
                    if (arr_models.length > 0) {
                        this.compare = arr_models;
                        this.set_models_to_url();
                    }
                } 
//				else {
//                    url_params = this.getUrlVar();
//                    if (url_params['models'] !== undefined) {
//					//alert('2:'+url_params['models']);
//                        let str_models = decodeURI(url_params['models']);
//                        str_models = str_models.replace(/[^a-zA-Z-\d\,\(\)]/g, "");
//                        let arr_models = str_models.split(',');
//                        arr_models.forEach(function (item, i, arr) {
//                            arr[i] = arr[i].replace('%20', '');
//                            if (arr[i] == '') {
//                                arr.splice(i, 1);
//                            }
//                        });
//                        if (arr_models.length > 0) {
//                            this.compare = arr_models;
//                        }
//                    }
//                }
            },

            add_too_box(e) {
                let button = e.target;

                if (button.attributes['data-model'].value != '') {
                    const model = button.attributes['data-model'].value;
                    const box = button.attributes['data-box'].value;
                    switch (box) {
                        case 'favorites':
                            localStorage.setItem('favorites',Date.now());
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
                            localStorage.setItem('compare',Date.now());
                            this.compare.splice(this.compare.indexOf(model), 1);
                            $('body.template_rusavtomatika_bulma').addClass('blear');
                            this.set_models_to_url();
                            setTimeout(function () {
                                location.reload();
                            }, 100);

                            break;
                        case 'cart':
                            localStorage.setItem('cart',Date.now());
                            if (this.cart.indexOf(model) == -1) {
                                $(button).addClass('active').html("В заказе");
                                this.cart.push(model);
                                const source_element = $('.table_compare__button_cart[data-model="' + model + '"]');
                                const destination_element = $(".catalog_toolbar__item." + box);
                                this.do_flying_row(source_element, destination_element);
                            } else {
                                this.cart.splice(this.cart.indexOf(model), 1);
                                $(button).removeClass('active').html("В заказ");
                                const source_element = $('.table_compare__button_cart[data-model="' + model + '"]');
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
                    domain: '.'+window.location.host,
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

/*
                console.log(window.location.host);
*/
                //console.log("cookie: " + updatedCookie);
                updatedCookie +=  ';SameSite=Strict;Secure';
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
}
