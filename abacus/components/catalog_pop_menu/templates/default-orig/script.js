(function () {
    if ($("#vue_catalog_pop_menu").length > 0) {
        $('.catalog_toolbar .open_pop_catalog').bind('click', function () {
            $('#vue_catalog_pop_menu').removeAttr('style');
            $('#vue_catalog_pop_menu').toggleClass('active');
            $('.popup_background').toggleClass('active');
        });
        $('.popup_background, .button_close_catalog_popmenu').bind('click', function () {
            $('#vue_catalog_pop_menu').removeAttr('style');
            $('#vue_catalog_pop_menu').removeClass('active');
            $('.popup_background').removeClass('active');
        });
        //$('.catalog_toolbar .open_pop_catalog').click();
        /*****************************************************************************************************/


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

            },
            watch: {},
            created: function () {
            },
            mounted: function () {
                this.$nextTick(function () {
                    this.init_menu();
                });
            }
            ,
            methods: {
                alert(message) {
                    alert(message);
                },
                init_menu() {
                    //let current_context = this;
                    //console.log(current_context);
                    this.action = this.getCookie("catalog_popmenu_action");
                    if (this.action != undefined && this.action != '') {
                        let current_button_str = '.button_show_items[data-action=' + this.action + ']';
                        this.section_code = this.getCookie("catalog_popmenu_section_code");
                        this.brand = this.getCookie("catalog_popmenu_brand");
                        this.link = this.getCookie("catalog_popmenu_link");
                        if (this.section_code != "") current_button_str += '[data-section-code=' + this.section_code + ']';
                        if (this.brand != "") current_button_str += '[data-brand=' + this.brand + ']';
                        if (this.link != "" && this.link != undefined) current_button_str += "[data-link='" + this.link + "']";
                        if(this.action == "show_options"){
                            current_button_str = ".cataloge-switch[data-show=option-list]";
                        }
                        $(current_button_str).click();
                    } else {
                        $('.button_show_items[data-action="show_section_by_categories"][data-section-code="operator_panels"][data-brand="all"]').click();
                    }
                }
                ,

                close_catalog_popmenu: function () {
                    $('#vue_catalog_pop_menu').removeAttr('style');
                    $('#vue_catalog_pop_menu').removeClass('active');
                    $('.popup_background').removeClass('active');
                },

                handle_button_show_items: function (event) {
                    this.pressed_button = $(event.target);


                    let parent_tab = $(this.pressed_button).closest('ul.cataloge_list');
                    if ($(parent_tab).length > 0 && !$(parent_tab).is(':visible')) {

                        $('.cataloge-switch[data-show="cataloge_list"]').addClass('active');
                        $('.cataloge-switch[data-show="brand-list"]').removeClass('active');
                        $(parent_tab).show();
                        $('ul.brand-list').hide();
                    }
                    parent_tab = $(this.pressed_button).closest('ul.brand-list');
                    if ($(parent_tab).length > 0 && !$(parent_tab).is(':visible')) {
                        $('.cataloge-switch[data-show="cataloge_list"]').removeClass('active');
                        $('.cataloge-switch[data-show="brand-list"]').addClass('active');
                        $(parent_tab).show();
                        $('ul.cataloge_list').hide();
                    }


                    /*
                                        if (!parent_teb.is(':visible')) {
                                            // $element виден
                                        }
                    */


                    $('.button_show_items').removeClass('active-item');
                    $(this.pressed_button).addClass('active-item');
                    this.section_code = $(this.pressed_button).attr('data-section-code');
                    this.section_id = $(this.pressed_button).attr('data-section-id');
                    this.action = $(this.pressed_button).attr('data-action');
                    this.brand = $(this.pressed_button).attr('data-brand');
                    this.link = $(this.pressed_button).attr('data-link');

                    this.setCookie("catalog_popmenu_section_code", this.section_code);
                    this.setCookie("catalog_popmenu_action", this.action);
                    this.setCookie("catalog_popmenu_brand", this.brand);
                    this.setCookie("catalog_popmenu_link", this.link);
                    this.pull_data_from_server();
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
                    $(this.pressed_button).css({opacity: '0.4', color: '#999'});
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
                        $('#vue_catalog_pop_menu .button_show_items').css({opacity: '', color: ''});
                        setTimeout((pressed_button) => {
                            this.loading_status = false;
                        }, 1);
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

            },
            computed: {}
        });


    }
})();














