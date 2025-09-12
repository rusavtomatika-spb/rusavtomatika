window.onload = function () {
    pageProducts.initPage();
};

var pageProducts = {

    initPage: function () {
        checkAuth();
        this.initFilterPanelPeriod();
        this.initButtons();
        if ($(".block_filter_by_product_value").val() != '') {
            $(".input_filter_by_product").val($(".block_filter_by_product_value").val());
        }
    },
    initControlPanel: function () {
        orders.initFilterPanel();
        add_event_on__add_product_button();
        add_event_on__input_filter_by_product();
        add_event_on__all_orders_button();
        $.ajaxSetup({
            beforeSend: function () {
                $(".loader").show(10);
            },
            complete: function () {
                $(".loader").hide(10);
            }
        });
    },
    initButtons: function () {
        $(document).on('change', '#login_panel', function () {
            if ($('#login_panel .current_user').attr('data-user-code') !== undefined
                && $('#login_panel .current_user').attr('data-user-code') == $.cookie('login')) {
                pageProducts.loadTableProducts();
            }
        });
        // add_event_on__input_filter_by_product
            $('.block_filter_by_product').children('.clear_inputs').click(
                function () {
                    $('.input_filter_by_product').val('');
                    $("input.block_filter_by_product_value").val('');
                    $('input.input_filter_by_product').trigger('change');
                    loadProducts();
                });
            $('.input_filter_by_product').on('keyup', function (eventObject) {
                handle__input_filter_by_product(this);
            });
            $('.input_filter_by_product').on('focusout', function (eventObject) {
                setTimeout(function () {
                    $('#result_input_filter_by_product').removeClass('active');
                    $('#result_input_filter_by_product').html('');

                }, 100);
            });
            $('.input_filter_by_product').on('focusin', function (eventObject) {

                if ($('#result_input_filter_by_product').html() != '')
                {
                    $('#result_input_filter_by_product').addClass('active');
                }
            });


        // END add_event_on__input_filter_by_product


    },
    loadTableProducts: function () {
            var arrFilter_brand = [];
            var arrFilter_activeness = [];
            var filter_product_name = $('.block_filter_by_product_value').val();
            $('span[data-parameter="filter_brand[]"].active').each(function (index) {
                arrFilter_brand.push($(this).attr('data-value'));
            });
            $('span[data-parameter="filter_activeness[]"].active').each(function (index) {
                arrFilter_activeness.push($(this).attr('data-value'));
            });
            $.post("/orders/functions/ajax_products_table.php",
                {
                    action: "loadProducts",
                    arrFilter_brand: arrFilter_brand,
                    arrFilter_activeness: arrFilter_activeness,
                    filter_product_name: filter_product_name,
                },
                function (data) {
                    $('#page').html(data);
                    var fixHelper = function (e, ui) {
                        ui.children().each(function () {
                            $(this).width($(this).width());
                        });
                        return ui;
                    };

                    $('.sortable-table tbody.sortable').sortable({
                        items: "tr",
                        cursor: 'move',
                        opacity: 0.6,
                        handle: ".handle",
                        helper: fixHelper,
                        stop: function () {
                            var arPositions = [];
                            var counter = 100;
                            $(".sortable-table tbody.sortable > tr").each(function (index) {
                                arPositions.push($(this).attr('data-id'))
                                //console.log((index+2) + ": " + $(this).attr('data-id'));
                            });
                            $.ajax({
                                data: {'positions': arPositions},
                                type: "post",
                                url: "/orders/functions/ajax_change_positions.php",
                                success: function (data) {
                                    console.log(data);
                                }
                            });
                        }
                    });


                },
            );


        }

    ,
    initFilterPanelPeriod: function () {
        $('.filter_panel_button').click(function () {
            $(this).toggleClass('active');
            btn_parameter = $(this).attr('data-parameter');
            btn_value = $(this).attr('data-value');
            btn_activness = $(this).hasClass('active');
            if (btn_parameter && btn_value) {
                orders.setUrl(btn_parameter, btn_value, btn_activness);
            }
            var data_parameter = $(this).attr('data-parameter');
            if (data_parameter == 'filter_activeness[]' || data_parameter == 'filter_brand[]') {
                location.reload();
            }
        });
        var u = new Url(window.location.href);
        if (Object.keys(u.query).length == 0) {
            orders.fillUrlFromCookie(u);
        }
        var parameter_filter_period_month = u.query['filter_period_month[]'];
        if (parameter_filter_period_month) {
            arr_parameter_filter_period_month_values = parameter_filter_period_month.split(',');
            if (Array.isArray(arr_parameter_filter_period_month_values)) {
                var index;
                for (index = arr_parameter_filter_period_month_values.length - 1; index >= 0; --index) {
                    $("span[data-parameter='filter_period_month[]'][data-value='" + arr_parameter_filter_period_month_values[index] + "']").addClass('active');

                }
            }
        } else {
            //console.log("!!"+$.cookie('filter_period_month[]'));
        }
//
        var parameter_filter_activeness = u.query['filter_activeness[]'];
        if (parameter_filter_activeness) {
            arr_parameter_filter_activeness_values = parameter_filter_activeness.split(',');
            if (Array.isArray(arr_parameter_filter_activeness_values)) {
                var index;
                for (index = arr_parameter_filter_activeness_values.length - 1; index >= 0; --index) {
                    $("span[data-parameter='filter_activeness[]'][data-value='" + arr_parameter_filter_activeness_values[index] + "']").addClass('active');
                }
            }
        }
//
        var parameter_filter_period_year = u.query['filter_period_year[]'];
        if (parameter_filter_period_year) {
            arr_parameter_filter_period_year_values = parameter_filter_period_year.split(',');
            if (Array.isArray(arr_parameter_filter_period_year_values)) {
                var index;
                for (index = arr_parameter_filter_period_year_values.length - 1; index >= 0; --index) {
                    $("span[data-parameter='filter_period_year[]'][data-value='" + arr_parameter_filter_period_year_values[index] + "']").addClass('active');
                }
            }
        }
//
        var parameter_filter_brand = u.query['filter_brand[]'];

        if (parameter_filter_brand) {
            arr_parameter_filter_brand_values = parameter_filter_brand.split(',');
            if (Array.isArray(arr_parameter_filter_brand_values)) {
                var index;
                for (index = arr_parameter_filter_brand_values.length - 1; index >= 0; --index) {
                    $("span[data-parameter='filter_brand[]'][data-value='" + arr_parameter_filter_brand_values[index] + "']").addClass('active');

                }
            }
        }
        $('.refresh_button').bind("click", function () {
            if ($(this).is('.active')) {
                location.reload();
            }
        });

    }
    ,
    setUrl: function setUrl(btn_parameter, btn_value, btn_activness) {
        var u = new Url(window.location.href);
        var parameter_current_value = u.query[btn_parameter];
        if (parameter_current_value) {
            arr_parameter_current_values = parameter_current_value.split(',');
            if (Array.isArray(arr_parameter_current_values)) {
                pos_found_value = arr_parameter_current_values.indexOf(btn_value);
                if (btn_activness) {
                    if (pos_found_value === -1) {
                        arr_parameter_current_values.push(btn_value);
                        parameter_current_value = arr_parameter_current_values.join(',');
                        $.cookie(btn_parameter, parameter_current_value, {expires: 365, path: '/'});
                        u.query[btn_parameter] = parameter_current_value;
                        $('.refresh_button[data-action="do_filter"]').addClass('active');
                        history.pushState(null, null, u);
                    }
                } else {
                    if (pos_found_value !== -1) {
                        arr_parameter_current_values.splice(pos_found_value, 1);
                        parameter_current_value = arr_parameter_current_values.join(',');
                        $.cookie(btn_parameter, parameter_current_value, {expires: 365, path: '/'});
                        u.query[btn_parameter] = parameter_current_value;
                        $('.refresh_button[data-action="do_filter"]').addClass('active');
                        history.pushState(null, null, u);

                    }

                }
            }
        } else {
            if (btn_activness) {
                u.query[btn_parameter] = btn_value;
                $.cookie(btn_parameter, btn_value, {expires: 365, path: '/'});
                history.pushState(null, null, u);
                $('.refresh_button[data-action="do_filter"]').addClass('active');
            }
        }

    },
    fillUrlFromCookie: function fillUrlFromCookie(url) {
        var params = ['filter_brand[]', 'filter_period_year[]', 'filter_period_month[]', 'filter_activeness[]'];
        var num_elements = Object.keys(params).length;
        for (var i = num_elements - 1; i >= 0; i--) {
            if ($.cookie(params[i])) {
                parameter_current_value = $.cookie(params[i]);
                orders.setUrl(params[i], parameter_current_value, true);
                arr_parameter_current_values = parameter_current_value.split(',');
                if (Array.isArray(arr_parameter_current_values)) {
                    var arr_parameter_current_values_num_elements = Object.keys(arr_parameter_current_values).length;
                    for (var i2 = arr_parameter_current_values_num_elements - 1; i2 >= 0; i2--) {
                        $("span[data-parameter='"
                            + params[i]
                            + "'][data-value='"
                            + arr_parameter_current_values[i2]
                            + "']").addClass('active');
                    }
                }
            }
        }
    },

}

