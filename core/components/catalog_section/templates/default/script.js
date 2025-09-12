var app = new Vue({
        el: '#vue_component_catalog_section',
        data: {
            init_in_process: true,
            mytest: 0,
            current_section: "",
            filterSelectedBrands: [],
            filterSelectedInterfaces: [],
            filterSelectedWebView: false,
            filterSelectedScreenless: false,
            filterSelectedPlcWebBrowser: false,
            filterSelectedCodesys: false,
            filterSelectedSdcard: false,
            filterSelectedVesa: false,
            filterSelectedCmtviewer: false,
            filterSelectedCameraIP: false,
            filterSelectedCameraUSB: false,
            filterSelectedOss: [],
            filterSelectedResolutions: [],
            filterSelectedProcessors: [],
            filterSelectedSeries: "",
            filterSelectedTypes: "",
            filterSelectSeries: [],
            filterSelectTypes: [],
            filterSelectedDiagonals: [],
            section_list__set_diagonal_span_show: false,
            section_list__set_availability_show: false,
            filterSelectedRangeDiagonal_min: 0,
            filterSelectedRangeDiagonal_max: 0,
            filterSelectedRangeDiagonal_min_start: 0,
            filterSelectedRangeDiagonal_max_start: 0,
            filterSelectedRangeCOM_min: null,
            filterSelectedRangeCOM_max: null,
            filterSelectedRangeCOM_min_start: 0,
            filterSelectedRangeCOM_max_start: 0,

            filterSelectedRangeEthernets_min: null,
            filterSelectedRangeEthernets_max: null,
            filterSelectedRangeEthernets_min_start: 0,
            filterSelectedRangeEthernets_max_start: 0,


            filterSelectedRangePrice_min: null,
            filterSelectedRangePrice_max: null,
            filterSelectedRangePrice_min_start: 0,
            filterSelectedRangePrice_max_start: 0,
            filterSelectedAvailablity: "0",
            filterSelectedSensorType: "",
            filterSelectedСase_material: "",
            filter_string: "",
            filter_selected_brands_string: "",
            url: {
                get_data: '/core/components/catalog_section/templates/default/ajax_catalog_section.php',
            },
            loading_status: false,
            result: "",
            html_filtered_products: "",
            current_filter_options: "",
            urlGetVars: [],
            view_mode: 'list',
            product_sort: 'recommended',
            favorites: [],
            compare: [],
            cart: [],
            viewed: [],
            extra_h1: "",
            extra_h1_arr: [],

        },
        watch: {
            extra_h1: function (newVal) {
                let new_h1 = $('meta[name=original_h1]').attr('content');
                let new_title = $('meta[name=original_title]').attr('content');
                if (newVal.length > 0) {
                    newVal = newVal.replace(/,/g, ', ');
                    new_h1 += ' (' + newVal + ')';
                    new_title += ' (' + newVal + ')';
                }
                $('h1').html(new_h1);
                $('title').html(new_title);
            },
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

            filterSelectedInterfaces: function (newVal) {
            },

            filterSelectedRangeDiagonal_min: function (newVal) {
                if (this.filterSelectedRangeDiagonal_min < this.filterSelectedRangeDiagonal_min_start) {
                    this.filterSelectedRangeDiagonal_min = this.filterSelectedRangeDiagonal_min_start;
                }
                $("#diagonal-slider").slider("option", "values", [this.filterSelectedRangeDiagonal_min, this.filterSelectedRangeDiagonal_max]);

                //if(!this.init_in_process) this.filterChanged();
            },

            filterSelectedRangeDiagonal_max: function () {
                if (this.filterSelectedRangeDiagonal_max > this.filterSelectedRangeDiagonal_max_start) {
                    this.filterSelectedRangeDiagonal_max = this.filterSelectedRangeDiagonal_max_start;
                }
                $("#diagonal-slider").slider("option", "values", [this.filterSelectedRangeDiagonal_min, this.filterSelectedRangeDiagonal_max]);
                //if(!this.init_in_process) this.filterChanged();
            },

            filterSelectedRangePrice_min: function (newVal) {
                if (this.filterSelectedRangePrice_min < this.filterSelectedRangePrice_min_start) {
                    this.filterSelectedRangePrice_min = this.filterSelectedRangePrice_min_start;
                }
                $("#price-slider").slider("option", "values", [this.filterSelectedRangePrice_min, this.filterSelectedRangePrice_max]);
                //if(!this.init_in_process) this.filterChanged();
            },
            filterSelectedRangePrice_max: function () {
                if (this.filterSelectedRangePrice_max > this.filterSelectedRangePrice_max_start) {
                    this.filterSelectedRangePrice_max = this.filterSelectedRangePrice_max_start;
                }
                $("#price-slider").slider("option", "values", [this.filterSelectedRangePrice_min, this.filterSelectedRangePrice_max]);
                //if(!this.init_in_process) this.filterChanged();
            },

            filterSelectedRangeCOM_min: function (newVal) {
                if (this.filterSelectedRangeCOM_min < this.filterSelectedRangeCOM_min_start) {
                    this.filterSelectedRangeCOM_min = this.filterSelectedRangeCOM_min_start;
                }

                if (this.filterSelectedRangeCOM_min > this.filterSelectedRangeCOM_max) {
                    const tmp = this.filterSelectedRangeCOM_max;
                    this.filterSelectedRangeCOM_max = this.filterSelectedRangeCOM_min;
                    this.filterSelectedRangeCOM_min = tmp;
                }

                $("#COM-slider").slider("option", "values", [this.filterSelectedRangeCOM_min, this.filterSelectedRangeCOM_max]);
                //if(!this.init_in_process)  this.filterChanged();
            },
            filterSelectedRangeCOM_max: function () {
                if (this.filterSelectedRangeCOM_max > this.filterSelectedRangeCOM_max_start) {
                    this.filterSelectedRangeCOM_max = this.filterSelectedRangeCOM_max_start;
                }

                if (this.filterSelectedRangeCOM_max < this.filterSelectedRangeCOM_min) {
                    const tmp = this.filterSelectedRangeCOM_max;
                    this.filterSelectedRangeCOM_max = this.filterSelectedRangeCOM_min;
                    this.filterSelectedRangeCOM_min = tmp;
                }

                $("#COM-slider").slider("option", "values", [this.filterSelectedRangeCOM_min, this.filterSelectedRangeCOM_max]);
                //if(!this.init_in_process) this.filterChanged();
            },

            filterSelectedRangeEthernets_min: function (newVal) {
                if (this.filterSelectedRangeEthernets_min < this.filterSelectedRangeEthernets_min_start) {
                    this.filterSelectedRangeEthernets_min = this.filterSelectedRangeEthernets_min_start;
                }
                $("#Ethernets-slider").slider("option", "values", [this.filterSelectedRangeEthernets_min, this.filterSelectedRangeEthernets_max]);
                //if(!this.init_in_process) this.filterChanged();
            },
            filterSelectedRangeEthernets_max: function () {
                if (this.filterSelectedRangeEthernets_max > this.filterSelectedRangeEthernets_max_start) {
                    this.filterSelectedRangeEthernets_max = this.filterSelectedRangeEthernets_max_start;
                }
                $("#Ethernets-slider").slider("option", "values", [this.filterSelectedRangeEthernets_min, this.filterSelectedRangeEthernets_max]);
                //if(!this.init_in_process) this.filterChanged();
            }


        },
        computed: {},
        created: function () {

        },
        mounted: function () {
            this.$nextTick(function () {
                this.init();
            });
        },
        methods: {
            clear_filter_item(filter_name, item) {

                switch (filter_name) {
                    case 'filterSelectedBrands':
                        this.filterSelectedBrands.splice(this.filterSelectedBrands.indexOf(item), 1);
                        this.filterChanged();
                        break;
                    case 'filterSelectedInterfaces':
                        this.filterSelectedInterfaces.splice(this.filterSelectedInterfaces.indexOf(item), 1);
                        this.filterChanged();
                        break;
                    case 'filterSelectedCodesys':
                        this.filterSelectedCodesys = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedSdcard':
                        this.filterSelectedSdcard = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedVesa':
                        this.filterSelectedVesa = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedCmtviewer':
                        this.filterSelectedCmtviewer = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedWebView':
                        this.filterSelectedWebView = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedScreenless':
                        this.filterSelectedScreenless = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedPlcWebBrowser':
                        this.filterSelectedPlcWebBrowser = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedCameraIP':
                        this.filterSelectedCameraIP = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedCameraUSB':
                        this.filterSelectedCameraUSB = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedOss':
                        this.filterSelectedOss.splice(this.filterSelectedOss.indexOf(item), 1);
                        this.filterChanged();
                        break;
                    case 'filterSelectedResolutions':
                        this.filterSelectedResolutions.splice(this.filterSelectedResolutions.indexOf(item), 1);
                        this.filterChanged();
                        break;

                    case 'filterSelectedProcessors':
                        this.filterSelectedProcessors.splice(this.filterSelectedProcessors.indexOf(item), 1);
                        this.filterChanged();
                        break;
                    case 'filterSelectedSeries':
                        this.filterSelectedSeries = '';
                        this.filterChanged();
                        break;
                    case 'filterSelectedAvailablity':
                        this.filterSelectedAvailablity = "0";
                        this.filterChanged();
                        break;
                    case 'filterSelectedSensorType':
                        this.filterSelectedSensorType = "";
                        this.filterChanged();
                        break;
                    case 'filterSelectedСase_material':
                        this.filterSelectedСase_material = "";
                        this.filterChanged();
                        break;
                    case 'filterSelectedRangePrice_min':
                        this.filterSelectedRangePrice_min = this.filterSelectedRangePrice_min_start;
                        this.filterChanged();
                        break;
                    case 'filterSelectedRangePrice_max':
                        this.filterSelectedRangePrice_max = this.filterSelectedRangePrice_max_start;
                        this.filterChanged();
                        break;

                    case 'filterSelectedRangeDiagonal_min':
                        this.filterSelectedRangeDiagonal_min = this.filterSelectedRangeDiagonal_min_start;
                        this.filterChanged();
                        break;
                    case 'filterSelectedRangeDiagonal_max':
                        this.filterSelectedRangeDiagonal_max = this.filterSelectedRangeDiagonal_max_start;
                        this.filterChanged();
                        break;

                    case 'filterSelectedRangeEthernets_min':
                        this.filterSelectedRangeEthernets_min = this.filterSelectedRangeEthernets_min_start;
                        this.filterChanged();
                        break;
                    case 'filterSelectedRangeEthernets_max':
                        this.filterSelectedRangeEthernets_max = this.filterSelectedRangeEthernets_max_start;
                        this.filterChanged();
                        break;


                    default:
                    case 'all':
                        this.filterSelectedBrands = [];
                        this.filterSelectedInterfaces = [];

                        this.filterSelectedCodesys = false;
                        this.filterSelectedSdcard = false;
                        this.filterSelectedVesa = false;
                        this.filterSelectedCmtviewer = false;
                        this.filterSelectedWebView = false;
                        this.filterSelectedScreenless = false;
                        this.filterSelectedPlcWebBrowser = false;
                        this.filterSelectedCameraIP = false;
                        this.filterSelectedCameraUSB = false;
                        this.filterSelectedOss = [];
                        this.filterSelectedResolutions = [];
                        this.filterSelectedProcessors = [];
                        this.filterSelectedSeries = "";
                        this.filterSelectedTypes = "";
                        this.filterSelectedAvailablity = "0";
                        this.filterSelectedSensorType = "";
                        this.filterSelectedСase_material = "";

                        this.filterSelectedRangeDiagonal_min = this.filterSelectedRangeDiagonal_min_start;
                        this.filterSelectedRangeDiagonal_max = this.filterSelectedRangeDiagonal_max_start;
                        this.filterSelectedRangePrice_min = this.filterSelectedRangePrice_min_start;
                        this.filterSelectedRangePrice_max = this.filterSelectedRangePrice_max_start;
                        this.filterSelectedRangeEthernets_min = this.filterSelectedRangeEthernets_min_start;
                        this.filterSelectedRangeEthernets_max = this.filterSelectedRangeEthernets_max_start;

                        this.filterChanged();

                        break;
                }
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
                            let favorites = this.getCookie('box2_favorites');
                            if (favorites !== undefined) {
                                favorites = favorites.replace(/^[\, ]|[\, ]$/g, '');
                                if (favorites != "") this.favorites = favorites.split(",");
                            }
                            if (this.favorites.indexOf(model) === -1) {
                                $(button).addClass('active');
                                this.favorites.push(model);
                                const source_element = $('.tr_product_' + model);
                                const destination_element = $(".catalog_toolbar__item." + box);
                                this.do_flying_row(source_element, destination_element);
                            } else {
                                this.favorites.splice(this.favorites.indexOf(model), 1);
                                $(button).removeClass('active');
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
                                $(button).addClass('active');
                                this.compare.push(model);
                                const source_element = $('.tr_product_' + model);
                                const destination_element = $(".catalog_toolbar__item." + box);
                                this.do_flying_row(source_element, destination_element);
                            } else {
                                this.compare.splice(this.compare.indexOf(model), 1);
                                $(button).removeClass('active');
                                this.do_flying_row($(button));
                            }
                            localStorage.setItem('compare', Date.now());
                            break;
                        case 'cart':
                            let cart = this.getCookie('box2_cart');
                            if (cart !== undefined) {
                                cart = cart.replace(/^[\, ]|[\, ]$/g, '');
                                if (cart != "") this.cart = cart.split(",");
                            }
                            if (this.cart.indexOf(model) == -1) {
                                $(button).addClass('active');
                                this.cart.push(model);
                                const source_element = $('.tr_product_' + model);
                                const destination_element = $(".catalog_toolbar__item." + box);
                                this.do_flying_row(source_element, destination_element);
                            } else {
                                this.cart.splice(this.cart.indexOf(model), 1);
                                $(button).removeClass('active');
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


            clicked_button_select_series(chosen_series) {
                this.filterSelectedSeries = chosen_series;
                let filter_field_block_filter_series = document.querySelector('.filter_field_block.filter_series');
                if (filter_field_block_filter_series != null && !filter_field_block_filter_series.classList.contains('unfolded')) {
                    this.sort_series();
                }
                this.filterChanged();
            },

            clicked_button_select_Types(chosen_Types) {
                this.filterSelectedTypes = chosen_Types;
                /*
                                let filter_field_block_filter_Types = document.querySelector('.filter_field_block.filter_types');
                                if (filter_field_block_filter_Types != null && !filter_field_block_filter_Types.classList.contains('unfolded')) {
                                    this.sort_Types();
                                }
                */
                this.filterChanged();
            },


            clicked_button_clear_filter_field_block(filter) {
                switch (filter) {
                    case 'filterSelectedRangeEthernets':
                        this.filterSelectedRangeEthernets_min = this.filterSelectedRangeEthernets_min_start;
                        this.filterSelectedRangeEthernets_max = this.filterSelectedRangeEthernets_max_start;
                        this.filterChanged();
                        break;
                    case 'filterSelectedRangeCOMs':
                        this.filterSelectedRangeCOM_min = this.filterSelectedRangeCOM_min_start;
                        this.filterSelectedRangeCOM_max = this.filterSelectedRangeCOM_max_start;
                        this.filterChanged();
                        break;
                    case 'filterSelectedBrands':
                        this.filterSelectedBrands = [];
                        this.filterChanged();
                        break;
                    case 'filterSelectedInterfaces':
                        this.filterSelectedInterfaces = [];
                        this.filterChanged();
                        break;
                    case 'filterSelectedCodesys':
                        this.filterSelectedCodesys = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedSdcard':
                        this.filterSelectedSdcard = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedVesa':
                        this.filterSelectedVesa = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedCmtviewer':
                        this.filterSelectedCmtviewer = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedWebView':
                        this.filterSelectedWebView = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedScreenless':
                        this.filterSelectedScreenless = false;
                        this.filterChanged();
                        break;

                    case 'filterSelectedPlcWebBrowser':
                        this.filterSelectedPlcWebBrowser = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedCameraIP':
                        this.filterSelectedCameraIP = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedCameraUSB':
                        this.filterSelectedCameraUSB = false;
                        this.filterChanged();
                        break;
                    case 'filterSelectedOss':
                        this.filterSelectedOss = [];
                        this.filterChanged();
                        break;
                    case 'filterSelectedResolutions':
                        this.filterSelectedResolutions = [];
                        this.filterChanged();
                        break;
                    case 'filterSelectedProcessors':
                        this.filterSelectedProcessors = [];
                        this.filterChanged();
                        break;
                    case 'filterSelectedDiagonals':
                        this.filterSelectedDiagonals = [];
                        this.filterChanged();
                        break;
                    case 'filterSelectedRangeDiagonals':
                        this.filterSelectedRangeDiagonal_min = this.filterSelectedRangeDiagonal_min_start;
                        this.filterSelectedRangeDiagonal_max = this.filterSelectedRangeDiagonal_max_start;
                        this.filterChanged();
                        break;
                    case 'filterSelectedRangePrices':
                        this.filterSelectedRangePrice_min = this.filterSelectedRangePrice_min_start;
                        this.filterSelectedRangePrice_max = this.filterSelectedRangePrice_max_start;
                        this.filterChanged();
                        break;
                    case 'filterSelectedAvailablity':
                        this.filterSelectedAvailablity = "0";
                        this.filterChanged();
                        break;
                    case 'filterSelectedSensorType':
                        this.filterSelectedSensorType = "";
                        this.filterChanged();
                        break;
                    case 'filterSelectedСase_material':
                        this.filterSelectedСase_material = "";
                        this.filterChanged();
                        break;
                    case 'filterSelectedSeries':
                        this.filterSelectedSeries = "";
                        this.filterSelectSeries.sort((a, b) => {
                            if (a.position < b.position) {
                                return -1;
                            } else return 1;
                        });
                    case 'filterSelectedTypes':
                        this.filterSelectedTypes = "";
                        /*
                                                this.filterSelectedTypes.sort((a, b) => {
                                                    if (a.position < b.position) {
                                                        return -1;
                                                    } else return 1;
                                                });
                        */

                        this.filterChanged();

                        break;


                }
                this.filterChanged();

            },

            change_availablity() {
                if (this.filterSelectedAvailablity == "1") {
                    this.filterSelectedAvailablity = "0";
                } else this.filterSelectedAvailablity = "1";
                this.filterChanged();
            },
            change_Сase_material() {
                if (this.filterSelectedСase_material == "1") {
                    this.filterSelectedСase_material = "0";
                } else this.filterSelectedСase_material = "1";
                this.filterChanged();
            },
            set_diagonal_span(d1, d2, event) {
                this.filterSelectedRangeDiagonal_min = d1;
                this.filterSelectedRangeDiagonal_max = d2;
                //$('.section_list__set_diagonal_span__button').removeClass('active');
                //$(event.originalTarget).addClass('active');
                this.filterChanged();
            },
            change_view_mode(mode) {
                this.view_mode = mode;
                let date = new Date;
                date.setDate(date.getDate() + 365);
                date = date.toUTCString();
                this.setCookie('section_catalog_view_mode', mode, {'expires': date});
                this.filterChanged();
            },

            save_param_to_cookie(param, value) {
                let date = new Date;
                date.setDate(date.getDate() + 365);
                date = date.toUTCString();
                this.setCookie(param, value, {'expires': date});
            },
            fetch_array_param_from_cookie(param) {
                const value = this.getCookie(param);
                if (value != null) {
                    return value.split(",");
                } else return null;
            },

            change_view_sort() {
                let date = new Date;
                date.setDate(date.getDate() + 365);
                date = date.toUTCString();
                this.setCookie('section_catalog_view_sort', this.product_sort, {'expires': date});
                this.filterChanged();
            },
            filterChanged(event) {

                const current_context = this;

                if (event != undefined) {
                    //// dealing with  checkbox_interface for COM
                    // unchecking other checkboxes
                    let str = event.target.id;
                    let checked_val = event.target.value;
                    if (str.indexOf('checkbox_interface_') >= 0) {
                        if (checked_val.lastIndexOf('com') == 1) {
                            $('[id^="checkbox_interface_"]').each(function () {
                                let val_str = $(this).val();
                                if (val_str.lastIndexOf('com') == 1) {
                                    if (checked_val != val_str) {
                                        $(this).prop('checked', false);
                                        let find_pos = current_context.filterSelectedInterfaces.indexOf(val_str);
                                        if (find_pos >= 0) {
                                            current_context.filterSelectedInterfaces.splice(find_pos, 1);
                                        }
                                    }
                                }
                            });
                        }
                    }
                    //// end  dealing with  checkbox_interface for COM
                }

                this.filter_string = '';

                if (this.filterSelectedRangeDiagonal_min > 0) {
                    this.filter_string += '&range_diagonal_min=' + this.filterSelectedRangeDiagonal_min;
                }
                if (this.filterSelectedRangeDiagonal_max > 0 && this.filterSelectedRangeDiagonal_max > this.filterSelectedRangeDiagonal_min && this.filterSelectedRangeDiagonal_max < this.filterSelectedRangeDiagonal_max_start) {
                    this.filter_string += '&range_diagonal_max=' + this.filterSelectedRangeDiagonal_max;
                }
                if (this.filterSelectedRangePrice_min > 0) {
                    this.filter_string += '&range_price_min=' + this.filterSelectedRangePrice_min;
                }
                if (this.filterSelectedRangePrice_max > 0 && this.filterSelectedRangePrice_max > this.filterSelectedRangePrice_min && this.filterSelectedRangePrice_max < this.filterSelectedRangePrice_max_start) {
                    this.filter_string += '&range_price_max=' + this.filterSelectedRangePrice_max;
                }

                if (
                    this.filterSelectedRangeCOM_min >= this.filterSelectedRangeCOM_min_start &&
                    !(this.filterSelectedRangeCOM_min == this.filterSelectedRangeCOM_min_start && this.filterSelectedRangeCOM_max == this.filterSelectedRangeCOM_max_start)
                ) {
                    this.filter_string += '&com_range_min=' + this.filterSelectedRangeCOM_min;
                }
                if (this.filterSelectedRangeCOM_max >= 0 &&
                    this.filterSelectedRangeCOM_max >= this.filterSelectedRangeCOM_min &&
                    this.filterSelectedRangeCOM_max < this.filterSelectedRangeCOM_max_start &&
                    !(this.filterSelectedRangeCOM_min == this.filterSelectedRangeCOM_min_start && this.filterSelectedRangeCOM_max == this.filterSelectedRangeCOM_max_start)
                ) {
                    this.filter_string += '&com_range_max=' + this.filterSelectedRangeCOM_max;
                }

                if (this.filterSelectedRangeEthernets_min >= this.filterSelectedRangeEthernets_min_start && !(this.filterSelectedRangeEthernets_min == this.filterSelectedRangeEthernets_min_start && this.filterSelectedRangeEthernets_max == this.filterSelectedRangeEthernets_max_start)) {
                    this.filter_string += '&ethernets_range_min=' + this.filterSelectedRangeEthernets_min;
                }
                if (this.filterSelectedRangeEthernets_max >= 0 &&
                    this.filterSelectedRangeEthernets_max >= this.filterSelectedRangeEthernets_min &&
                    this.filterSelectedRangeEthernets_max <= this.filterSelectedRangeEthernets_max_start &&
                    !(this.filterSelectedRangeEthernets_min == this.filterSelectedRangeEthernets_min_start && this.filterSelectedRangeEthernets_max == this.filterSelectedRangeEthernets_max_start)
                ) {
                    this.filter_string += '&ethernets_range_max=' + this.filterSelectedRangeEthernets_max;
                }


                if (this.filterSelectedSeries != "") {
                    this.filter_string += '&series=' + this.filterSelectedSeries;
                }
                if (this.filterSelectedTypes != "") {
                    this.filter_string += '&types=' + this.filterSelectedTypes;
                }

                if (this.filterSelectedBrands.length > 0) {
                    let sorted_list = this.filterSelectedBrands;
                    sorted_list = sorted_list.filter(function (el) {
                        return (el != null && el != "" || el === 0);
                    });

                    if (sorted_list.length > 0) {
                        sorted_list.sort();
                        this.filter_string += '&brand=';
                        sorted_list.forEach(function (item, i) {
                            current_context.filter_string = current_context.filter_string + item + ',';
                        });
                        this.filter_string = this.filter_string.replace(/,\s*$/, "");
                    }
                }
                if (this.filterSelectedResolutions.length > 0) {
                    let sorted_list = this.filterSelectedResolutions;
                    sorted_list.sort();
                    this.filter_string += '&resolutions=';
                    sorted_list.forEach(function (item, i) {
                        current_context.filter_string = current_context.filter_string + item + ',';
                    });
                    this.filter_string = this.filter_string.replace(/,\s*$/, "");
                }
                if (this.filterSelectedProcessors.length > 0) {
                    let sorted_list = this.filterSelectedProcessors;
                    sorted_list.sort();
                    this.filter_string += '&processors=';
                    sorted_list.forEach(function (item, i) {
                        current_context.filter_string = current_context.filter_string + item + ',';
                    });
                    this.filter_string = this.filter_string.replace(/,\s*$/, "");
                }


                if (this.filterSelectedInterfaces.length > 0) {
                    let sorted_list = this.filterSelectedInterfaces;
                    sorted_list.sort();
                    this.filter_string += '&interfaces=';
                    sorted_list.forEach(function (item, i) {
                        current_context.filter_string = current_context.filter_string + item + ',';
                    });
                    this.filter_string = this.filter_string.replace(/,\s*$/, "");
                }
                if (this.filterSelectedCodesys) {
                    this.filter_string += '&codesys=yes';
                }
                if (this.filterSelectedSdcard) {
                    this.filter_string += '&sdcard=yes';
                }
                if (this.filterSelectedVesa) {
                    this.filter_string += '&vesa=yes';
                }
                if (this.filterSelectedCmtviewer) {
                    this.filter_string += '&cmtviewer=yes';
                }
                if (this.filterSelectedWebView) {
                    this.filter_string += '&webview=yes';
                }
                if (this.filterSelectedScreenless) {
                    this.filter_string += '&screenless=yes';
                }
                if (this.filterSelectedPlcWebBrowser) {
                    this.filter_string += '&plc_web_browser=yes';
                }
                if (this.filterSelectedCameraIP) {
                    this.filter_string += '&camera_ip=yes';
                }
                if (this.filterSelectedCameraUSB) {
                    this.filter_string += '&camera_usb=yes';
                }
                if (this.filterSelectedOss.length > 0) {
                    let sorted_list = this.filterSelectedOss;
                    sorted_list.sort();
                    this.filter_string += '&os=';
                    sorted_list.forEach(function (item, i) {
                        current_context.filter_string = current_context.filter_string + item + ',';
                    });
                    this.filter_string = this.filter_string.replace(/,\s*$/, "");
                }

                if (this.filterSelectedAvailablity != "0") {
                    this.filter_string += '&availablity=' + this.filterSelectedAvailablity;
                }
                if (this.filterSelectedSensorType != "") {
                    this.filter_string += '&sensor_type=' + this.filterSelectedSensorType;
                }
                if (this.filterSelectedСase_material != "") {
                    this.filter_string += '&case_material=' + this.filterSelectedСase_material;
                }

                if (this.filterSelectedDiagonals.length > 0) {
                    let sorted_list = this.filterSelectedDiagonals;
                    sorted_list.sort(function (a, b) {
                        return a - b;
                    });
                    this.filter_string += '&diagonals=';
                    sorted_list.forEach(function (item, i) {
                        current_context.filter_string += item + ',';
                    });
                    this.filter_string = this.filter_string.replace(/,\s*$/, "");
                }

                if (this.product_sort != "" && this.product_sort != "recommended") {
                    this.filter_string += '&sort=' + this.product_sort;
                }

                //
                const current_base_url = window.location.origin + window.location.pathname;

                if (this.filter_string == '') {
                    window.history.pushState(null, null, current_base_url);
                } else window.history.pushState(null, null, current_base_url + "?" + this.filter_string);
                this.extra_h1_arr = this.filter_string.split('&');
                this.extra_h1_arr = this.extra_h1_arr.filter(function (el) {
                    return (el != null && el != "" || el === 0);
                });
                this.extra_h1 = '';
                if (this.extra_h1_arr.length > 0 && (window.location.pathname + window.location.search) != $('meta[name=component_seo]').attr('content')) {
                    let vue_context = this;
                    let separator = '';
                    this.extra_h1_arr.forEach(function (item, i, arr) {
                        let item_splitted = [];
                        if (item != '') {
                            item_splitted = item.split('=');
                        }
                        if (vue_context.extra_h1_arr.length > i + 1) {
                            separator = ', ';
                        } else {
                            separator = '';
                        }
                        let h1_chunk = '';
                        switch (item_splitted[0]) {
                            case 'brand':
                                h1_chunk = "," + item_splitted[1];
                                break;
                            case 'sdcard':
                                h1_chunk = ',SD-карта';
                                break;
                            case "range_price_min":
                                h1_chunk = ",цена от " + item_splitted[1] + "$";
                                break;
                            case "range_price_max":
                                h1_chunk = ",цена до " + item_splitted[1] + "$";
                                break;
                            case "range_diagonal_min":
                                h1_chunk = ",диагональ от " + item_splitted[1] + "&Prime;";
                                break;
                            case "range_diagonal_max":
                                h1_chunk = ",диагональ до " + item_splitted[1] + "&Prime;";
                                break;
                            case "ethernets_range_min":
                                h1_chunk = ",количество Ethernet от " + item_splitted[1] + "";
                                break;
                            case "ethernets_range_max":
                                h1_chunk = ",количество Ethernet до " + item_splitted[1] + "";
                                break;
                            case "interfaces":
                                h1_chunk = ",интерфейсы: " + item_splitted[1] + "";
                                break;
                            case "screenless":
                                h1_chunk = ",безэкранные";
                                break;
                            case "availablity":
                                if (item_splitted[1] == '1') h1_chunk = ",в наличии";
                                else if (item_splitted[1] == '2') h1_chunk = ",под заказ";
                                else h1_chunk = "";
                                break;
                            case "webview":
                                h1_chunk = ",WebView";
                                break;
                            case "plc_web_browser":
                                h1_chunk = ",PLC Web-browser";
                                break;
                            case "camera_ip":
                                h1_chunk = ",IP-camera";
                                break;
                            case "camera_usb":
                                h1_chunk = ",USB-camera";
                                break;
                            case "cmtviewer":
                                h1_chunk = ",CMT Viewer";
                                break;
                            case "vesa":
                                h1_chunk = ",крепление Vesa";
                                break;
                            case "codesys":
                                h1_chunk = ",Codesys";
                                break;
                            case "sensor_type":
                                if (item_splitted[1] == 'resistive') item_splitted[1] = 'резистивный';
                                if (item_splitted[1] == 'capacitive') item_splitted[1] = 'емкостный';
                                h1_chunk = "," + item_splitted[1] + " тип сенсора";
                                break;
                            case "resolutions":
                                h1_chunk = ",разрешение: " + item_splitted[1] + "";
                                break;
                            case "processors":
                                h1_chunk = ",процессор: " + item_splitted[1] + "";
                                break;
                            case "series":
                                h1_chunk = ",серия: " + item_splitted[1] + "";
                                break;
                            case "types":
                                h1_chunk = ",тип: " + item_splitted[1] + "";
                                break;
                            case "sort":
                                h1_chunk = "";
                                break;
                            case "case_material":
                                switch (item_splitted[1]) {
                                    case 'aluminium':
                                        tmp = "Алюминий";
                                        break;
                                    case 'plastic':
                                        tmp = "Пластик";
                                        break;
                                    case 'plastic+aluminium':
                                        tmp = "Пластик+Алюминий";
                                        break;
                                    default:
                                        tmp = item_splitted[1];
                                        break;
                                }
                                h1_chunk = ",материал корпуса: " + tmp;
                                break;
                            default:
                                h1_chunk = "," + item_splitted[1];
                                break;
                        }

                        vue_context.extra_h1 += h1_chunk;
                    });
                } else {
                    this.extra_h1 = '';
                }
                this.extra_h1 = this.extra_h1.replace(/^,|,$/gm, '');


                this.send_ajax_query();
            },
            send_ajax_query() {

                this.loading_status = true;

                axios({
                    method: 'POST',
                    url: this.url.get_data + '?' + this.filter_string + '&section=' + this.current_section,
                    data: {
                        view_mode: this.view_mode,
                        sort: this.product_sort,
                    },
                    headers: {
                        "Content-type": "application/x-www-form-urlencoded"
                    }
                }).then((response) => {
                    this.loading_status = false;
                    const parsed_data = JSON.stringify(response.data);
                    this.html_filtered_products = response.data;
                    this.init_after_ajax();
                })

            },
            init_after_ajax() {

                let el = this.$el;
                setTimeout(() => {
                    if ($('meta[name=component_seo_h1]').length > 0) {
                        let new_h1 = $('meta[name=component_seo_h1]').attr('content');

                        if (new_h1 != "") {
                            $('h1').html(new_h1);
                        }
                    }

                    if ($('meta[name=component_seo_title]').length > 0) {
                        let new_title = $('meta[name=component_seo_title]').attr('content');
                        if (new_title != "") {
                            $('title').html(new_title);
                        }
                    }
                    if ($('meta[name=component_seo_DESCRIPTION]').length > 0) {
                        let DESCRIPTION = $('meta[name=component_seo_DESCRIPTION]').attr('content');
                        if (DESCRIPTION != "") {
                            $('meta[name=description]').attr('content', DESCRIPTION);
                        }
                    }
                    if ($('meta[name=component_seo_KEYWORDS]').length > 0) {
                        let KEYWORDS = $('meta[name=component_seo_KEYWORDS]').attr('content');
                        if (KEYWORDS != "") {
                            $('meta[name=keywords]').attr('content', KEYWORDS);
                        }
                    }

                    let component_seo_UPPER_SEO_TEXT = $('#component_seo_UPPER_SEO_TEXT').html();
                    if (component_seo_UPPER_SEO_TEXT) {

                        $('.UPPER_SEO_TEXT').html(component_seo_UPPER_SEO_TEXT);
                        $('#component_seo_UPPER_SEO_TEXT').hide();
                    } else {
                        $('.UPPER_SEO_TEXT').html("");
                    }

                    let seo_LOWER_SEO_TEXT = $('#component_seo_LOWER_SEO_TEXT').html();
                    if (seo_LOWER_SEO_TEXT) {
                        //let new_LOWER_SEO_TEXT = $('meta[name=component_seo_LOWER_SEO_TEXT]').attr('content');
                        $('.section_description').html(seo_LOWER_SEO_TEXT);
                        $('#component_seo_LOWER_SEO_TEXT').hide();
                    } else {
                        $('.section_description').html("");
                    }


                    const div_ajax_message = el.querySelector('#ajax_message');
                    if (div_ajax_message !== null && div_ajax_message.innerText != '') console.log('Ajax response message:     ', div_ajax_message.innerText);
                    const all = Array.from(el.querySelectorAll('.series_products__button'));
                    all.forEach(u => {
                        const action = u.getAttribute('@click');
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
                    $("html, body").animate({scrollTop: 0}, 100);
                }, 1);
            },
            handle_h1(str_item) {

            },
            sort_series(state = 'folded') {
                $(".filter_series .filter_field_block__content").css('opacity', '0.1');
                let chosen_series = this.filterSelectedSeries;
                if (state == 'folded') {
                    let tmp_arr1 = [];
                    let tmp_arr2 = [];
                    this.filterSelectSeries.forEach(function (item, i, arr) {
                        if (item.name == chosen_series) {
                            tmp_arr1.push(item);
                        } else {
                            tmp_arr2.push(item);
                        }
                    });
                    tmp_arr2.sort((a, b) => {
                        if (a.position < b.position) {
                            return -1;
                        } else if (a.position == b.position) {
                            return 0;
                        } else return 1;
                    });
                    this.filterSelectSeries = tmp_arr1.concat(tmp_arr2);
                } else {
                    this.filterSelectSeries.sort((a, b) => {
                        if (a.position < b.position) {
                            return -1;
                        } else if (a.position == b.position) {
                            return 0;
                        } else return 1;
                    });
                }
                setTimeout(function () {
                    $(".filter_series .filter_field_block__content").css('opacity', '1');
                }, 500);

            }
            ,
            sort_Types(state = 'folded') {
                $(".filter_types .filter_field_block__content").css('opacity', '0.1');
                let chosen_types = this.filterSelectedTypes;
                if (state == 'folded') {
                    let tmp_arr1 = [];
                    let tmp_arr2 = [];
                    this.filterSelectTypes.forEach(function (item, i, arr) {
                        if (item.name == chosen_types) {
                            tmp_arr1.push(item);
                        } else {
                            tmp_arr2.push(item);
                        }
                    });
                    tmp_arr2.sort((a, b) => {
                        if (a.position < b.position) {
                            return -1;
                        } else if (a.position == b.position) {
                            return 0;
                        } else return 1;
                    });
                    this.filterSelectTypes = tmp_arr1.concat(tmp_arr2);
                } else {
                    this.filterSelectTypes.sort((a, b) => {
                        if (a.position < b.position) {
                            return -1;
                        } else if (a.position == b.position) {
                            return 0;
                        } else return 1;
                    });
                }
                setTimeout(function () {
                    $(".filter_types .filter_field_block__content").css('opacity', '1');
                }, 500);

            }
            ,

            init() {
                //this.init_in_process = true;

                let vue_context = this;
                let context = this;
                $ = window.$;
                $(document).ready(
                    function () {
                        window.addEventListener('storage', function (event) {
                            switch (event.key) {
                                case 'compare':
                                    setTimeout(function () {
                                        let compare = context.getCookie('box2_compare');
                                        if (compare !== undefined) {
                                            compare = compare.replace(/^[\, ]|[\, ]$/g, '');
                                            if (compare != "") {
                                                context.compare = compare.split(",");
                                                $('.series_products__button.compare').each(function () {
                                                    let model = $(this).attr('data-model');
                                                    if (context.compare.indexOf(model) === -1) {
                                                        $(this).removeClass('active');
                                                    } else {
                                                        $(this).addClass('active');
                                                    }
                                                });

                                            } else {
                                                context.compare = [];
                                                $('.series_products__button.compare').removeClass('active');
                                            }
                                        }
                                    }, 1000);
                                    break;
                                case'favorites':
                                    setTimeout(function () {
                                        let favorites = context.getCookie('box2_favorites');
                                        if (favorites !== undefined) {
                                            favorites = favorites.replace(/^[\, ]|[\, ]$/g, '');
                                            if (favorites != "") {
                                                context.favorites = favorites.split(",");
                                                $('.series_products__button.favorites').each(function () {
                                                    let model = $(this).attr('data-model');
                                                    if (context.favorites.indexOf(model) === -1) {
                                                        $(this).removeClass('active');
                                                    } else {
                                                        $(this).addClass('active');
                                                    }
                                                });

                                            } else {
                                                context.favorites = [];
                                                $('.series_products__button.favorites').removeClass('active');
                                            }
                                        }
                                    }, 1000);
                                    break;
                                case'cart':
                                    setTimeout(function () {
                                        let cart = context.getCookie('box2_cart');
                                        if (cart !== undefined) {
                                            cart = cart.replace(/^[\, ]|[\, ]$/g, '');
                                            if (cart != "") {
                                                context.cart = cart.split(",");
                                                $('.series_products__button.cart').each(function () {
                                                    let model = $(this).attr('data-model');
                                                    if (context.cart.indexOf(model) === -1) {
                                                        $(this).removeClass('active');
                                                    } else {
                                                        $(this).addClass('active');
                                                    }
                                                });

                                            } else {
                                                context.cart = [];
                                                $('.series_products__button.cart').removeClass('active');
                                            }
                                        }
                                    }, 1000);
                                    break;
                            }
                        });

                        $(".button_open_filter, .button_close_mobile_filter").bind("click", function () {
                            $('.button_open_filter').toggleClass('is-active');
                            $('.column_filter').toggleClass('is-hidden-touch');
                            $('#float_filter_block').toggleClass('open_for_touch');
                        });

                        $('.filter_field_block').each(
                            function () {
                                const current_height = $(this).height();
                                if (current_height > 300) {
                                    $("<div class='button_unfold'><div class='button_unfold_wrap_inn'>Посмотреть все</div></div>").appendTo($(this));
                                    $(this).addClass("folded");
                                }
                            }
                        );
                        $(".filter_field_block .button_unfold .button_unfold_wrap_inn").bind("click", function () {
                            const field_block = $(this).parents('.filter_field_block');
                            if ($(field_block).hasClass("folded")) {
                                $(field_block).removeClass("folded");
                                $(field_block).addClass("unfolded");
                                $(this).html("Свернуть");
                                vue_context.sort_series('unfolded');
                            } else {
                                $(field_block).addClass("folded");
                                $(field_block).removeClass("unfolded");
                                $(this).html("Посмотреть все");
                                vue_context.sort_series('folded');
                            }

                        });
                    }
                );


                this.urlGetVars = this.getUrlVar();

                if (this.urlGetVars['series'] != null) {
                    this.filterSelectedSeries = this.urlGetVars['series'];
                }
                if (this.urlGetVars['types'] != null) {
                    this.filterSelectedTypes = this.urlGetVars['types'];
                }
                if (this.urlGetVars['availablity'] != null) {
                    this.filterSelectedAvailablity = this.urlGetVars['availablity'];
                }
                if (this.urlGetVars['sensor_type'] != null) {
                    this.filterSelectedSensorType = this.urlGetVars['sensor_type'];
                }
                if (this.urlGetVars['case_material'] != null) {
                    this.filterSelectedСase_material = this.urlGetVars['case_material'];
                }

                if (this.urlGetVars['brand'] != null && this.urlGetVars['brand'] != '') {
                    let arrayBrands = this.urlGetVars['brand'].split(',');
                    if (arrayBrands.length > 0) {
                        this.filterSelectedBrands = arrayBrands.slice(0);
                    }
                }
                if (this.urlGetVars['interfaces'] != null) {
                    let arrayInterfaces = this.urlGetVars['interfaces'].split(',');
                    if (arrayInterfaces.length > 0) {

                        this.filterSelectedInterfaces = arrayInterfaces.slice(0);
                    }
                }
                if (this.urlGetVars['codesys'] != null) {
                    if (this.urlGetVars['codesys'] = 'yes') {
                        this.filterSelectedCodesys = true;
                    }
                }
                if (this.urlGetVars['sdcard'] != null) {
                    if (this.urlGetVars['sdcard'] = 'yes') {
                        this.filterSelectedSdcard = true;
                    }
                }
                if (this.urlGetVars['plc_web_browser'] != null) {
                    if (this.urlGetVars['plc_web_browser'] = 'yes') {
                        this.filterSelectedPlcWebBrowser = true;
                    }
                }
                if (this.urlGetVars['webview'] != null) {
                    if (this.urlGetVars['webview'] = 'yes') {
                        this.filterSelectedWebView = true;
                    }
                }
                if (this.urlGetVars['screenless'] != null) {
                    if (this.urlGetVars['screenless'] = 'yes') {
                        this.filterSelectedScreenless = true;
                    }
                }
                if (this.urlGetVars['vesa'] != null) {
                    if (this.urlGetVars['vesa'] = 'yes') {
                        this.filterSelectedVesa = true;
                    }
                }
                if (this.urlGetVars['cmtviewer'] != null) {
                    if (this.urlGetVars['cmtviewer'] = 'yes') {
                        this.filterSelectedCmtviewer = true;
                    }
                }
                if (this.urlGetVars['camera_ip'] != null) {
                    if (this.urlGetVars['camera_ip'] = 'yes') {
                        this.filterSelectedCameraIP = true;
                    }
                }
                if (this.urlGetVars['camera_usb'] != null) {
                    if (this.urlGetVars['camera_usb'] = 'yes') {
                        this.filterSelectedCameraUSB = true;
                    }
                }
                if (this.urlGetVars['os'] != null) {
                    let arrayInterfaces = this.urlGetVars['os'].split(',');
                    if (arrayInterfaces.length > 0) {
                        this.filterSelectedOss = arrayInterfaces.slice(0);
                    }
                }
                if (this.urlGetVars['processors'] != null) {
                    let url_str_processors = this.urlGetVars['processors'];
                    let str_processors = url_str_processors.replace(/%20/g, " ");
                    let arrayProcessors = str_processors.split(',');
                    if (arrayProcessors.length > 0) {
                        this.filterSelectedProcessors = arrayProcessors.slice(0);
                    }
                }

                if (this.urlGetVars['resolutions'] != null) {
                    let arrayResolutions = this.urlGetVars['resolutions'].split(',');
                    if (arrayResolutions.length > 0) {
                        this.filterSelectedResolutions = arrayResolutions.slice(0);
                    }
                }


                this.current_section = document.querySelector(".vue-data .current_section").getAttribute("data-value");
                this.filterSelectedRangeDiagonal_min_start = parseFloat(document.querySelector(".vue-data .filter_diagonal_min").getAttribute("data-value"));
                this.filterSelectedRangeDiagonal_max_start = parseFloat(document.querySelector(".vue-data .filter_diagonal_max").getAttribute("data-value"));
                this.filterSelectedRangePrice_min_start = parseInt(document.querySelector(".vue-data .filter_price_min").getAttribute("data-value"));
                this.filterSelectedRangePrice_max_start = parseInt(document.querySelector(".vue-data .filter_price_max").getAttribute("data-value"));
                this.filterSelectedRangePrice_min = this.filterSelectedRangePrice_min_start;
                this.filterSelectedRangePrice_max = this.filterSelectedRangePrice_max_start;

                this.filterSelectedRangeCOM_min_start = parseInt(document.querySelector(".vue-data .filter_com_min").getAttribute("data-value"));
                this.filterSelectedRangeCOM_max_start = parseInt(document.querySelector(".vue-data .filter_com_max").getAttribute("data-value"));
                this.filterSelectedRangeCOM_min = this.filterSelectedRangeCOM_min_start;
                this.filterSelectedRangeCOM_max = this.filterSelectedRangeCOM_max_start;

                this.filterSelectedRangeEthernets_min_start = parseInt(document.querySelector(".vue-data .filter_ethernets_min").getAttribute("data-value"));
                this.filterSelectedRangeEthernets_max_start = parseInt(document.querySelector(".vue-data .filter_ethernets_max").getAttribute("data-value"));
                this.filterSelectedRangeEthernets_min = this.filterSelectedRangeEthernets_min_start;
                this.filterSelectedRangeEthernets_max = this.filterSelectedRangeEthernets_max_start;


                /*
                                if (this.urlGetVars['ethernets_range_min'] != null) {
                                    this.filterSelectedRangeEthernets_max = this.urlGetVars['ethernets_range_min'];
                                }
                                if (this.urlGetVars['ethernets_range_max'] != null) {
                                    this.filterSelectedRangeEthernets_max = this.urlGetVars['ethernets_range_max'];
                                }
                */


                const series = document.querySelectorAll('.filter_series .server-rendered a');
                let counter = 0;
                series.forEach(function (e) {
                        const name = e.getAttribute("data-name");
                        const name_russian = e.getAttribute("data-name_russian");
                        const position = e.getAttribute("data-position");
                        vue_context.filterSelectSeries.push({
                            'name': name,
                            'name_russian': name_russian,
                            'position': counter++
                        });
                    }
                );
                let tmp = document.querySelector('.filter_series .server-rendered');
                if (tmp != null) tmp.remove();


                const types = document.querySelectorAll('.filter_types .server-rendered a');
                counter = 0;
                types.forEach(function (e) {
                        const name = e.getAttribute("data-name");
                        const name_russian = e.getAttribute("data-name_russian");
                        const position = e.getAttribute("data-position");
                        vue_context.filterSelectTypes.push({
                            'name': name,
                            'name_russian': name_russian,
                            'position': counter++
                        });
                    }
                );
                tmp = document.querySelector('.filter_types .server-rendered');
                if (tmp != null) tmp.remove();


                const cookie_view_mode = this.getCookie('section_catalog_view_mode');
                if (cookie_view_mode != undefined) {
                    this.view_mode = cookie_view_mode;
                }
                const cookie_view_sort = this.getCookie('section_catalog_view_sort');
                if (cookie_view_sort != undefined) {
                    this.product_sort = cookie_view_sort;
                }

                vue_context.filterSelectedRangeDiagonal_min_start = vue_context.filterSelectedRangeDiagonal_min = parseFloat($("#diagonal-slider").attr("data-min"));
                vue_context.filterSelectedRangeDiagonal_max_start = vue_context.filterSelectedRangeDiagonal_max = parseFloat($("#diagonal-slider").attr("data-max"));

                if (this.urlGetVars['range_diagonal_min'] != null) {
                    this.filterSelectedRangeDiagonal_min = parseFloat(this.urlGetVars['range_diagonal_min']);
                }
                if (this.urlGetVars['range_diagonal_max'] != null) {
                    this.filterSelectedRangeDiagonal_max = parseFloat(this.urlGetVars['range_diagonal_max']);
                }
                if (this.urlGetVars['range_price_min'] != null) {
                    this.filterSelectedRangePrice_min = parseFloat(this.urlGetVars['range_price_min']);
                }
                if (this.urlGetVars['range_price_max'] != null) {
                    this.filterSelectedRangePrice_max = parseFloat(this.urlGetVars['range_price_max']);
                }
                if (this.urlGetVars['ethernets_range_min'] != null) {
                    this.filterSelectedRangeEthernets_min = parseFloat(this.urlGetVars['ethernets_range_min']);
                }
                if (this.urlGetVars['ethernets_range_max'] != null) {
                    this.filterSelectedRangeEthernets_max = parseFloat(this.urlGetVars['ethernets_range_max']);
                }


                $("#diagonal-slider").slider({
                    range: true,
                    min: vue_context.filterSelectedRangeDiagonal_min_start,
                    max: vue_context.filterSelectedRangeDiagonal_max_start,
                    values: [vue_context.filterSelectedRangeDiagonal_min, vue_context.filterSelectedRangeDiagonal_max],
                    step: 0.1,
                    slide: function (event, ui) {
                        vue_context.filterSelectedRangeDiagonal_min = ui.values[0];
                        vue_context.filterSelectedRangeDiagonal_max = ui.values[1];
                    },
                    stop: function (event, ui) {
                        vue_context.filterChanged();
                    }
                });

                $("#price-slider").slider({
                    range: true,
                    min: vue_context.filterSelectedRangePrice_min_start,
                    max: vue_context.filterSelectedRangePrice_max_start,
                    values: [vue_context.filterSelectedRangePrice_min, vue_context.filterSelectedRangePrice_max],
                    step: 1,
                    slide: function (event, ui) {
                        vue_context.filterSelectedRangePrice_min = ui.values[0];
                        vue_context.filterSelectedRangePrice_max = ui.values[1];
                    },
                    stop: function (event, ui) {
                        vue_context.filterChanged();
                    }
                });

                $("#COM-slider").slider({
                    range: true,
                    min: vue_context.filterSelectedRangeCOM_min_start,
                    max: vue_context.filterSelectedRangeCOM_max_start,
                    values: [vue_context.filterSelectedRangeCOM_min, vue_context.filterSelectedRangeCOM_max],
                    step: 1,
                    slide: function (event, ui) {
                        vue_context.filterSelectedRangeCOM_min = ui.values[0];
                        vue_context.filterSelectedRangeCOM_max = ui.values[1];
                    },
                    stop: function (event, ui) {
                        vue_context.filterChanged();
                    }
                });

                $("#Ethernets-slider").slider({
                    range: true,
                    min: vue_context.filterSelectedRangeEthernets_min_start,
                    max: vue_context.filterSelectedRangeEthernets_max_start,
                    values: [vue_context.filterSelectedRangeEthernets_min, vue_context.filterSelectedRangeEthernets_max],
                    step: 1,
                    slide: function (event, ui) {
                        vue_context.filterSelectedRangeEthernets_min = ui.values[0];
                        vue_context.filterSelectedRangeEthernets_max = ui.values[1];
                    },
                    stop: function (event, ui) {
                        vue_context.filterChanged();
                    }
                });


                if ($('div').is('.filter_code_diagonal')) {
                    this.section_list__set_diagonal_span_show = true;
                }
                if ($('div').is('.filter_code_availability')) {
                    this.section_list__set_availability_show = true;
                }
                this.init_in_process = false;

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
                    if (compare != "") this.compare = compare.split(",");
                }

                let viewed = this.getCookie('box2_viewed');
                if (viewed !== undefined) {
                    viewed = viewed.replace(/^[\, ]|[\, ]$/g, '');
                    if (viewed != "") this.viewed = viewed.split(",");
                }

                this.filterChanged();
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
        },

    })
;