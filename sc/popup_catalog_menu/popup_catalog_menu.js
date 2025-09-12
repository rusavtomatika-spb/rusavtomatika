if (document.getElementById('vue_app_menu')) {
    var app = new Vue({
        el: '#vue_app_menu',
        data: {
            url: {
                get_filtered_menu: '/sc/popup_catalog_menu/popup_catalog_menu_ajax.php?',
            },
            activeClass: 'active',
            hideClass: false,
            menu_is_visible: false,
            arr_menu_get_filtered_items: [],
            str_menu_get_filtered_items: [],
            str_menu_get_title: "",
            str_menu_get_title2: "",
            current_filter_type: '',
            menu_result_panel_category_active: false,
            menu_result_panel_brand_active: false,
            current_menu_category_index: -1,
            current_menu_brand_item_index: -1,
            current_menu_result_panel_category__title: '',
            current_menu_result_panel_category__link: '',
            current_menu_result_panel_brand__title: '',
            current_menu_result_panel_brand__link: '',
            rolldown_to_brand_buttons: [],
            rolldown_to_category_buttons: [],
            arr_menu_get_filtered_items: [],
            html_menu_get_filtered_items_by_brand: '',
            html_menu_get_filtered_items_category: '',
            loading_status: true,
            dropdown_main_menu_opacity: 0,

            menu_category: [
                {
                    "name": "Панели оператора",
                    "link": "/paneli-operatora/",
                    "menu_category_item_code": "operator_panels",
                    "type": "hmi,machine-tv-interface",
                    "brands": ["Weintek", "Samkoon",],
                    "active": false
                },
                {
                    "name": "Шлюзы данных",
                    "link": "/gateways/",
                    "menu_category_item_code": "gateways",
                    "type": "Gateway",
                    "brands": ["Weintek",],
                    "active": false
                },
                {
                    "name": "Панельные компьютеры",
                    "link": "/panelnie-computery/",
                    "menu_category_item_code": "panel_computers",
                    "type": "panel_pc",
                    "brands": ["IFC", "Aplex", "Weintek"],
                    "active": false
                },
                {
                    "name": "Промышленные компьютеры full IP65",
                    "link": "/panelnie-computery/aplex/#ViTAM-8XX",
                    "menu_category_item_code": "industrial_computers_full_ip65",
                    "type": "panel_pc_full_ip65",
                    "brands": ["Aplex"],
                    "active": false
                },

                {
                    "name": "Встраиваемые компьютеры",
                    "link": "/vstraivaemye-kompyutery/",
                    "menu_category_item_code": "embedded_computers",
                    "type": "box-pc",
                    "brands": ["IFC", "Aplex",],
                    "active": false
                },
                {
                    "name": "Панельные компьютеры Windows CE",
                    "link": "/panelnie-computery/aplex/#armpac-series",
                    "menu_category_item_code": "panel_computers_wce",
                    "type": "panel_pc_wce",
                    "brands": ["Aplex"],
                    "active": false
                },
                {
                    "name": "Промышленные мониторы",
                    "link": "/monitors/",
                    "menu_category_item_code": "industrial_monitors",
                    "type": "monitors",
                    "brands": ["IFC", "Aplex",],
                    "active": false
                },
                {
                    "name": "VPN-роутеры",
                    "link": "/ewon/",
                    "menu_category_item_code": "vpn_routers",
                    "type": "vpn-router",
                    "brands": ["eWON"],
                    "active": false
                },
                {
                    "name": "Контроллеры (PLC)",
                    "menu_category_item_code": "programmable_logic_controllers",
                    "type": "controllers",
                    "brands": ["Weintek"],
                    "active": false
                },
                {
                    "name": "Модули ввода-вывода",
                    "link": "",
                    "menu_category_item_code": "modules_io",
                    "type": "module",
                    "brands": ["Weintek"],
                    "active": false
                },
                {
                    "name": "Блоки питания",
                    "link": "/bloki-pitaniya/faraday/",
                    "menu_category_item_code": "power_supplies",
                    "type": "bloki-pitaniya",
                    "brands": ["Faraday"],
                    "active": false
                },
                {
                    "name": "Аксессуары",
                    "link": "/accessories/",
                    "menu_category_item_code": "accessories",
                    "type": "direct_link",
                    "brands": [""],
                    "active": false
                },
                {
                    "name": "Уцененные товары",
                    "link": "/discounted/",
                    "menu_category_item_code": "discounted_items",
                    "type": "direct_link",
                    "brands": [""],
                    "active": false
                },
            ],
            menu_brands: [
                {
                    "name": "Weintek",
                    "link": "/weintek/",
                    "categories": ["hmi,machine-tv-interface", "hmi", "panel_pc",],
                    "menu_category_item_codes": ["operator_panels", "panel_computers", "programmable_logic_controllers", "modules_io"],
                    "active": false
                },
                {
                    "name": "Samkoon",
                    "link": "/samkoon/",
                    "categories": ["hmi,machine-tv-interface", "hmi"],
                    "menu_category_item_codes": ["operator_panels"],
                    "active": false
                },
                {
                    "name": "IFC",
                    "link": "/panelnie-computery/ifc/",
                    "categories": ["monitors", "panel_pc", "box-pc",],
                    "menu_category_item_codes": ["industrial_monitors", "embedded_computers", "panel_computers"],
                    "active": false
                },
                {
                    "name": "Aplex",
                    "link": "/panelnie-computery/aplex/",
                    "categories": ["panel_pc_wce", "panel_pc_ip65", "panel_pc", "box-pc", "monitors"],
                    "menu_category_item_codes": ["industrial_monitors", "panel_computers_wce", "embedded_computers", "panel_computers", "industrial_computers_full_ip65", ""],
                    "active": false
                },
/*                {
                    "name": "Cincoze",
                    "link": "/cincoze/",
                    "categories": ["panel_pc", "box-pc", "monitors"],
                    "menu_category_item_codes": ["industrial_monitors", "embedded_computers", "panel_computers",],
                    "active": false
                },*/
                {
                    "name": "eWON",
                    "link": "/ewon/",
                    "categories": ["vpn-router"],
                    "menu_category_item_codes": ["vpn_routers",],
                    "active": false
                },
/*
                {
                    "name": "Haiwell",
                    "link": "/plc/haiwell/",
                    "categories": ["controllers", "modules_io"],
                    "menu_category_item_codes": ["programmable_logic_controllers", "modules_io"],
                    "active": false
                },
*/
/*
                {
                    "name": "Yottacontrol",
                    "link": "/plc/yottacontrol/",
                    "categories": ["controllers"],
                    "menu_category_item_codes": ["programmable_logic_controllers", "modules_io"],
                    "active": false
                },
*/
/*                {
                    "name": "IECON",
                    "link": "/modules/",
                    "categories": ["module"],
                    "menu_category_item_codes": ["modules_io"],
                    "active": false
                },
 */
                {
                    "name": "Faraday",
                    "link": "/bloki-pitaniya/faraday/",
                    "categories": ["bloki-pitaniya"],
                    "menu_category_item_codes": ["power_supplies"],
                    "active": false
                },
            ],
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
            close_menu(event) {
                if (event.target.className == "button_close_menu" || event.target.className == "vue_app_menu_background_panel menu_is_visible") {
                    this.menu_is_visible = false;
                    tag_body_classList = document.getElementsByTagName('body')[0].classList;
                    if (tag_body_classList.contains("popup_menu_opened")) {
                        tag_body_classList.remove("popup_menu_opened");
                    }
                }
            },
            open_menu() {
                this.menu_is_visible = true;
                tag_body_classList = document.getElementsByTagName('body')[0].classList;
                if (!tag_body_classList.contains("popup_menu_opened")) {
                    tag_body_classList.add("popup_menu_opened");
                }
            },
            scroll_to_brand(id) {
                let el = document.getElementById(id);
                if (el !== null) el.scrollIntoView({behavior: "smooth"});
            },
            scroll_to_category(id) {
                let el = document.getElementById(id);
                if (el !== null) el.scrollIntoView({behavior: "smooth"});
            },
            scroll_to_category(id) {
                let el = document.getElementById(id);
                if (el !== null) el.scrollIntoView({behavior: "smooth"});
            },
            scroll_menu_white_panel_to_start() {
                let myDiv = document.querySelectorAll('.menu_white_panel');
                for (let i = 0; i < myDiv.length; i++) {
                    if (myDiv[i] !== null) myDiv[i].scrollTop = 0;
                }
            },

            send() {
                let str_categories = '';
                let str_brands = '';
                if (Array.isArray(this.arr_menu_get_filtered_items["menu_category_item_codes"])) {
                    str_categories = "&menu_category_item_codes=" + this.str_menu_get_filtered_items["menu_category_item_codes"];
                }
                if (Array.isArray(this.arr_menu_get_filtered_items["brands"])) {
                    str_brands = "&brands=" + this.str_menu_get_filtered_items["brands"];
                }
                this.loading_status = true;
                axios({
                    method: 'POST',
                    url: this.url.get_filtered_menu,
                    data: {
                        brands: this.arr_menu_get_filtered_items["brands"],
                        menu_category_item_codes: this.arr_menu_get_filtered_items["menu_category_item_codes"],
                        current_filter_type: this.current_filter_type,
                    },
                    headers: {
                        "Content-type": "application/x-www-form-urlencoded"
                    }
                }).then((response) => {
                    this.loading_status = false;
                    if (this.current_filter_type == 'category') {
                        this.html_menu_get_filtered_items_category = response.data;
                        this.html_menu_get_filtered_items_by_brand = "";
                    } else {
                        this.html_menu_get_filtered_items_by_brand = response.data;
                        this.html_menu_get_filtered_items_category = "";
                    }

                }).catch(error => {
                    console.log(error)
                });

            }
            ,
            menu_clear_category_activeness() {
                this.menu_category.forEach(function (cat_item, cat_i, cat_arr) {
                    Vue.set(cat_item, "active", false);
                });
            },
            menu_clear_brand_activeness() {

                this.menu_brands.forEach(function (cat_item, cat_i, cat_arr) {
                    Vue.set(cat_item, "active", false);
                });
            },
            ///////////////////////////////////////////////////////////////////////////////////////////////
            menu_category_select(index) {
                if (this.menu_category[index].type == "direct_link") {
                    window.location.href = this.menu_category[index].link;
                    return;
                }
                this.current_filter_type = "category";
                let current_context = this;
                this.menu_clear_category_activeness();
                this.menu_clear_brand_activeness();
                Vue.set(this.menu_category[index], "active", true);
                this.str_menu_get_title = this.menu_category[index]["name"];
                this.current_menu_result_panel_category__title = this.menu_category[index]["name"];
                this.current_menu_result_panel_category__link = this.menu_category[index]["link"];
                this.rolldown_to_brand_buttons = [];

                this.menu_category[index].brands.forEach(function (item, i, arr) {
                    current_context.menu_brands.forEach(function (brand_item, cat_i, cat_arr) {

                        if (brand_item.name == item) {
                            current_context.setCookie('popup_menu_current_filter_type', current_context.current_filter_type, {
                                secure: true,
                                'max-age': 3600
                            });
                            current_context.setCookie('popup_menu_category', current_context.menu_category[index]["menu_category_item_code"], {
                                secure: true,
                                'max-age': 3600
                            });
                            Vue.set(brand_item, "active", true);
                            current_context.str_menu_get_title2 += brand_item["name"] + ", ";
                            current_context.rolldown_to_brand_buttons.push({'name': brand_item["name"],});
                        }
                    });
                });
                this.menu_get_filtered_items();
                this.scroll_menu_white_panel_to_start();

            },
            ///////////////////////////////////////////////////////////////////////////////////////////////
            menu_brand_select(index) {
                this.current_filter_type = "brand";
                let current_context = this;
                this.menu_clear_category_activeness();
                this.menu_clear_brand_activeness();
                Vue.set(this.menu_brands[index], "active", true);
                this.str_menu_get_title = this.menu_brands[index]["name"];
                this.current_menu_result_panel_brand__title = this.menu_brands[index]["name"];
                this.current_menu_result_panel_brand__link = this.menu_brands[index]["link"];

                this.rolldown_to_category_buttons = [];
                this.str_menu_get_title2 = "";
                this.menu_brands[index].menu_category_item_codes.forEach(function (item, i, arr) {

                    current_context.menu_category.forEach(function (cat_item, cat_i, cat_arr) {
                        if (cat_item.menu_category_item_code == item) {
                            current_context.setCookie('popup_menu_current_filter_type', current_context.current_filter_type, {
                                secure: true,
                                'max-age': 3600
                            });
                            current_context.setCookie('popup_menu_brand', current_context.str_menu_get_title, {
                                secure: true,
                                'max-age': 3600
                            });
                            Vue.set(cat_item, "active", true);
                            current_context.str_menu_get_title2 += cat_item["name"] + ", ";
                            current_context.rolldown_to_category_buttons.push({
                                'name': cat_item["name"],
                                'code': cat_item["menu_category_item_code"],
                            });

                        }
                    });
                });
                this.menu_get_filtered_items();
                this.scroll_menu_white_panel_to_start();
            },
            menu_get_filtered_items() {
                this.arr_menu_get_filtered_items = [];
                let categories = "";
                let brands = "";
                this.menu_category.forEach(function (cat_item, cat_i, cat_arr) {
                    if (cat_item["active"] == true) {
                        categories += cat_item["menu_category_item_code"] + ",";
                    }
                });
                this.menu_brands.forEach(function (brand_item, brand_i, brand_arr) {
                    if (brand_item["active"] == true) {
                        brands += brand_item["name"] + ",";
                    }
                });
                this.arr_menu_get_filtered_items["menu_category_item_codes"] = categories;
                this.arr_menu_get_filtered_items["brands"] = brands;
                this.send();
            },
            init_menu() {
                let current_context = this;
                let popup_menu_current_filter_type = this.getCookie("popup_menu_current_filter_type");
                if (popup_menu_current_filter_type != "") {
                    switch (popup_menu_current_filter_type) {
                        case 'category':
                            const category = this.getCookie("popup_menu_category");
                            this.menu_category.forEach(function (cat_item, cat_i, cat_arr) {
                                if (cat_item['menu_category_item_code'] == category) {
                                    current_context.menu_category_select(cat_i);
                                }
                            });
                            break;
                        case 'brand':
                            const brand = this.getCookie("popup_menu_brand");
                            this.menu_brands.forEach(function (brand_item, brand_i, brand_arr) {
                                if (brand_item['name'] == brand) {
                                    current_context.menu_brand_select(brand_i);
                                }
                            });
                            break;
                        default:
                            this.menu_category_select(0);
                            break;
                    }
                } else this.menu_category_select(0);
                this.dropdown_main_menu_opacity = 1;
            }
            ,
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
                options = {
                    path: '/',
                    samesite: 'lax',
                    // при необходимости добавьте другие значения по умолчанию
                    //...options
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

        },
        computed: {}
    });
}else {
    console.log('There is no menu (#vue_app_menu) !');
}