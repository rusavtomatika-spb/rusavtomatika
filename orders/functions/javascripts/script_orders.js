var application_order = {
    init: function(){
        logistic_order.init();
    }
}

var artikul_price = {
    init: function(){
        $(document).on('click', '.button__download_artikul_price_xlsx', function () {
            //
            let order_id = $(this).attr('data-order-id');
            let data_template_path = $(this).attr('data-template-path');
            let template_name = $(this).attr('data-template-name');
            if (order_id > 0 && typeof template_name == "undefined") {
                var url = "/orders/functions/ajax_get_templates_for_excel.php";
                var arrParams = {'data_template_path': data_template_path,};
                getAjaxJSON(url, arrParams)
                    .then(
                        function (result) {
                            if (result.status == 1) {
                                if (Object.keys(result.files).length > 0) {
                                    let html = "<h2>Выберите в каком шаблоне открыть:</h2><ul>";
                                    for (file in result.files) {
                                        html += '<li><a onclick="javascript:document.location.href=\'/orders/excel/download_artikul_price_xlsx.php?order_id='
                                            + order_id + '&template='
                                            + data_template_path + '/'
                                            + (result.files[file]) + '\'" target="_blank" href="/orders/excel/download_artikul_price_xlsx.php?order_id='
                                            + order_id + '&template='
                                            + data_template_path + '/'
                                            + (result.files[file]) + '">'
                                            + result.files[file] + '</a></li>';
                                    }
                                    html += "</ul>";
                                    popuppanel.open(html, '#ajax_result_popup_panel2');
                                    return;
                                } else if (Object.keys(result.files).length === 0) {
                                    return;
                                }
                            }
                        },
                        function (error) {
                            console.log("ajax_get_templates_for_excel error ", error);
                        }
                    );
                //
            } else if (order_id > 0) {
                alert(template_name);
                //openInNewTab("/orders/excel/download_order_xlsx.php?order_id=" + order_id + '&template=' + template_name);
            }
            //
        });

    }
}
var logistic_order = {
    init: function(){
        $(document).on('click', '.table_all_orders__button_add_logist_order', function () {
            const order_id = $(this).attr('data-order-id');
            const sum = $('#tr_order_id_' + order_id + ' .order-price-sum').html();
            const currency = $('#tr_order_id_' + order_id).attr('data-order-currency');
            if (order_id !== undefined && order_id > 0) {
                const now = new Date();
                model.addRow(
                    'ord_logistic_orders',
                    {
                        'order_id': order_id,
                        'sum': sum,
                        'currency': currency,
                        'date': 'NOW()',
                    },
                    'logist_order_added');
            }
        });
        $(document).on('click', '.table_all_orders__button_delete_logist_order', function () {
            if (confirm("Удалить заявку логистам?")) {
                const row_id = $(this).attr('data-row-id');
                const order_id = $(this).attr('data-order-id');
                if (row_id !== undefined && row_id > 0) {
                    model.deleteRow('ord_logistic_orders', row_id, 'logistic_order_deleted');
                }
            }
        });
        $(document).on('logistic_order_deleted', function (data) {
            if (data['id'] > 0) {
                $('#tr_logist_order_id_' + data['id']).remove();
            }
        });
        $(document).on('logist_order_added', function (data) {
            if (data['insert_id'] > 0) {
                model.get_logist_order_by_id_html(data['insert_id']);
            }
        });
        $(document).on('click', '.button__download_logist_order_xlsx', function () {            //
            let logist_order_id = $(this).attr('data-logist-order-id');
            let data_template_path = $(this).attr('data-template-path');
            let template_name = $(this).attr('data-template-name');
            if (logist_order_id > 0 && typeof template_name == "undefined") {
                var url = "/orders/functions/ajax_get_templates_for_excel.php";
                var arrParams = {'data_template_path': data_template_path,};
                getAjaxJSON(url, arrParams)
                    .then(
                        function (result) {
                            if (result.status == 1) {
                                if (Object.keys(result.files).length > 0) {
                                    let html = "<h2>Выберите в каком шаблоне открыть:</h2><ul>";
                                    for (file in result.files) {
                                        html += '<li><a onclick="javascript:document.location.href=\'/orders/excel/download_logist_order_xlsx.php?logist_order_id='
                                            + logist_order_id + '&template='
                                            + data_template_path + '/'
                                            + (result.files[file]) + '\'" target="_blank" href="/orders/excel/download_logist_order_xlsx.php?logist_order_id='
                                            + logist_order_id + '&template='
                                            + data_template_path + '/'
                                            + (result.files[file]) + '">'
                                            + result.files[file] + '</a></li>';
                                    }
                                    html += "</ul>";
                                    popuppanel.open(html, '#ajax_result_popup_panel2');
                                    return;
                                } else if (Object.keys(result.files).length === 0) {
                                    return;
                                }
                            }
                        },
                        function (error) {
                            console.log("ajax_get_templates_for_excel error ", error);
                        }
                    );
                //
            } else if (payment_form_id > 0) {
                alert(template_name);
                //openInNewTab("/orders/excel/download_order_xlsx.php?order_id=" + order_id + '&template=' + template_name);
            }
            //
        });


    },
    ord_logistic_order_chosen: function () {
        const params = arguments[0];
        model.save_cell(params['parent_table'], params['parent_row_id'], params['parent_field_name'], params['row_id']);
        var url = "/orders/functions/ajax_handle_database.php";
        var arrParams = {
            'action': 'get_logist_orders_html',
            'order_id': params['order_id'],
        };
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        $('#logist_order_panel_' + params['order_id']).html(result.buffer);
                    }
                },
                function (error) {
                    console.log("ord_logistic_order_chosen error ", error);
                }
            );
    },
}
var paymentforms = {
        load_paymentforms: function (order_id) {
            const url = "/orders/functions/ajax_handle_database.php";
            const arrParams = {
                'action': 'get_order_payment_forms_html',
                'order_id': order_id,
                'rand': Math.random(),
            };
            getAjaxJSON(url, arrParams)
                .then(
                    function (result) {
                        if (result.status == 1) {
                            const panel = '#payment_forms_panel_' + order_id;
                            $(panel).html(result.buffer);
                        }
                    },
                    function (error) {
                        console.log("ord_bank_accounts_chosen error ", error);
                    }
                );
        },
        add_event_on__button__download_payment_form_xlsx: function () {
            $(document).on('click', '.button__download_payment_form_xlsx', function () {
                //
                let payment_form_id = $(this).attr('data-payment-form-id');
                let data_template_path = $(this).attr('data-template-path');
                let template_name = $(this).attr('data-template-name');
                if (payment_form_id > 0 && typeof template_name == "undefined") {
                    var url = "/orders/functions/ajax_get_templates_for_excel.php";
                    var arrParams = {'data_template_path': data_template_path,};
                    getAjaxJSON(url, arrParams)
                        .then(
                            function (result) {
                                if (result.status == 1) {
                                    if (Object.keys(result.files).length > 0) {
                                        let html = "<h2>Выберите в каком шаблоне открыть:</h2><ul>";
                                        for (file in result.files) {
                                            html += '<li><a onclick="javascript:document.location.href=\'/orders/excel/download_payment_form_xlsx.php?payment_form_id='
                                                + payment_form_id + '&template='
                                                + data_template_path + '/'
                                                + (result.files[file]) + '\'" target="_blank" href="/orders/excel/download_payment_form_xlsx.php?order_id='
                                                + payment_form_id + '&template='
                                                + data_template_path + '/'
                                                + (result.files[file]) + '">'
                                                + result.files[file] + '</a></li>';
                                        }
                                        html += "</ul>";
                                        popuppanel.open(html, '#ajax_result_popup_panel2');
                                        return;
                                    } else if (Object.keys(result.files).length === 0) {
                                        return;
                                    }
                                }
                            },
                            function (error) {
                                console.log("ajax_get_templates_for_excel error ", error);
                            }
                        );
                    //
                } else if (payment_form_id > 0) {
                    alert(template_name);
                    //openInNewTab("/orders/excel/download_order_xlsx.php?order_id=" + order_id + '&template=' + template_name);
                }
                //
            });
        },
        add_event_on__table_all_orders__button_add_paymentform: function () {
            $(document).on('click', '.table_all_orders__button_add_payment_form', function () {
                const order_id = $(this).attr('data-order-id');
                const sum = $('#tr_order_id_' + order_id + ' .order-price-sum').html();
                const currency = $('#tr_order_id_' + order_id).attr('data-order-currency');
                console.log('#tr_order_id_order_id_' + order_id + ' .order-price-sum', sum);
                if (order_id !== undefined && order_id > 0) {
                    model.addRow('ord_payment_forms', {
                        'order_id': order_id,
                        'sum': sum,
                        'currency': currency
                    }, 'paymentform_added');
                }
            });
            $(document).on('paymentform_deleted', function (data) {
                if (data['id'] > 0) {
                    $('#tr_payment_form_id_' + data['id']).remove();
                    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
                    console.log('deleted --- ' + '#tr_payment_form_id_' + data['id']);
                }
            });
        },
        add_event_on__table_all_orders__button_delete_paymentform: function () {
            $(document).on('click', '.table_all_orders__button_delete_paymentform', function () {
                if (confirm("Удалить платежную форму?")) {
                    const row_id = $(this).attr('data-row-id');
                    const order_id = $(this).attr('data-order-id');
                    if (row_id !== undefined && row_id > 0) {
                        model.deleteRow('ord_payment_forms', row_id, 'paymentform_deleted');
                        //paymentforms.load_paymentforms(order_id);
                    }
                }
            });

            $(document).on('paymentform_added', function (data) {
                console.log("data", data);
                if (data['insert_id'] > 0) {
                    model.get_payment_form_by_id_html(data['insert_id'])
                    //paymentforms.load_paymentforms(data['insert_id']);
                }
            });




    },
ord_bank_accounts_chosen: function () {
    const params = arguments[0];
    model.save_cell(params['parent_table'], params['parent_row_id'], params['parent_field_name'], params['row_id']);
    var url = "/orders/functions/ajax_handle_database.php";
    var arrParams = {
        'action': 'get_order_payment_forms_html',
        'order_id': params['order_id'],
    };
    getAjaxJSON(url, arrParams)
        .then(
            function (result) {
                if (result.status == 1) {
                    $('#payment_forms_panel_' + params['order_id']).html(result.buffer);
                }
            },
            function (error) {
                console.log("ord_bank_accounts_chosen error ", error);
            }
        );

},
ord_vendor_addr_chosen: function () {
    const params = arguments[0];
    model.save_cell(params['parent_table'], params['parent_row_id'], params['parent_field_name'], params['row_id']);
    var url = "/orders/functions/ajax_handle_database.php";
    var arrParams = {
        'action': 'get_order_payment_forms_html',
        'order_id': params['order_id'],
    };
    getAjaxJSON(url, arrParams)
        .then(
            function (result) {
                if (result.status == 1) {
                    $('#payment_forms_panel_' + params['order_id']).html(result.buffer);
                }
            },
            function (error) {
                console.log("ord_bank_accounts_chosen error ", error);
            }
        );
}
};
var model = {
    init_events: function () {
        $(document).on(
            'click',
            '.choose_row_item',
            function () {
                const table = $(this).attr('data-table');
                const row_id = $(this).attr('data-row-id');
                const function_name = $(this).attr('data-function-name');
                const object_function = $(this).attr('data-object-function');
                const parent_table = $(this).attr('data-parent-table');
                const parent_row_id = $(this).attr('data-parent-row-id');
                const parent_field_name = $(this).attr('data-parent-field-name');
                const order_id = $(this).attr('data-order-id');
                if (typeof (window[object_function][function_name]) == 'function') {
                    const params = {
                        'table': table,
                        'row_id': row_id,
                        'parent_table': parent_table,
                        'parent_row_id': parent_row_id,
                        'parent_field_name': parent_field_name,
                        'order_id': order_id,
                    }
                    window[object_function][function_name](params);
                    $(this).closest('.popup_panel').find('.popup_panel_close_btn').click();
                }
            });
    },
    get_rows: function ($arrArgs) {
        var url = "/orders/functions/ajax_handle_database.php";
        var arrParams = {
            'action': 'get_rows',
            'table': $arrArgs['table'],
            'limit': $arrArgs['limit'],
            'fields': $arrArgs['fields']
        };
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        if (typeof ($arrArgs['function']) == 'function') {
                            // $arrArgs['function'].apply(result.rows);
                            $arrArgs['function'](result.rows);
                        }
                    }
                },
                function (error) {
                    console.log("get_rows error ", error);
                }
            );

    },
    chooseRow: function (btn) {
        if ($('.popup_panel').length > 0) {
            const table = $(btn).attr('data-table');
            const popup_title = $(btn).attr('data-popup-title');
            const data_function_name = $(btn).attr('data-function-name');
            const fields = $(btn).attr('data-fields');
            const parent_table = $(btn).attr('data-parent-table');
            const parent_row_id = $(btn).attr('data-parent-row-id');
            const parent_field_name = $(btn).attr('data-parent-field-name');
            const order_id = $(btn).attr('data-order-id');
            const data_object_function = $(btn).attr('data-object-function');


            model.get_rows(
                {
                    'table': table,
                    'limit': '1000',
                    'fields': fields,
                    'function': function () {
                        let rows = arguments[0];
                        console.log("fields ", fields);
                        let html = '';
                        let arrFields = fields.replace(/\s/g, '');
                        arrFields = arrFields.split(",");
                        rows.forEach(
                            function (item, i, arr) {
                                html +=
                                    "<div data-parent-table='" + parent_table
                                    + "' data-parent-row-id='" + parent_row_id
                                    + "' data-parent-field-name='" + parent_field_name
                                    + "' data-object-function='" + data_object_function
                                    + "' data-function-name='" + data_function_name
                                    + "' data-table='" + table
                                    + "' data-row-id='" + item['id']
                                    + "' data-order-id='" + order_id
                                    + "' class='choose_row_item linked_item'>";
                                arrFields.forEach(function (entry) {
                                    html += " [" + item[entry] + "] ";
                                });
                                html += "</div><hr>";
                            }
                        );
                        $('.popup_panel_wrap_in').html(html);
                        $('.popup_panel_title').html(popup_title);
                        $('.popup_panel').show(200);
                    }
                }
            );
        }
    },

    deleteFile: function (file) {
        var url = "/orders/functions/ajax_handle_database.php";
        var arrParams = {'action': 'delete_file', 'file': file,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        console.log("delete_file -> Deleted ");
                    }
                },
                function (error) {
                    console.log("delete_file error ", error);
                }
            );
    },
    deleteRowsByCondition: function deleteRowsByCondition(table_name, condition) {
        var url = "/orders/functions/ajax_handle_database.php";
        var arrParams = {'action': 'delete_rows_by_condition', 'table_name': table_name, 'condition': condition,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        console.log("deleteRowsByCondition -> Deleted ");
                    }
                },
                function (error) {
                    console.log("deleteRowsByCondition error ", error);
                }
            );
    },
    addRow: function addRow(table_name, arrData, trigger_event = '') {
        var url = "/orders/functions/ajax_handle_database.php";
        var arrParams = {'action': 'add_row', 'table_name': table_name, 'arrData': arrData,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        console.log("addRow -  insert_id: " + result.insert_id);
                        $("body").trigger("rowAdded", {'insert_id': result.insert_id});
                        if (trigger_event != '') $(document).trigger({
                            type: trigger_event,
                            'insert_id': result.insert_id
                        });
                    }
                },
                function (error) {
                    console.log("error ", error);
                }
            );
    },

    deleteRow: function deleteRow(table_name, id, trigger_event = '') {
        var url = "/orders/functions/ajax_handle_database.php";
        var arrParams = {'action': 'delete_row', 'table_name': table_name, 'id': id,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        console.log("Deleted ");
                        if (trigger_event != '') {
                            $(document).trigger({type: trigger_event, id: id});
                        }

                    }
                },
                function (error) {
                    console.log("error ", error);
                }
            );
    },

    get_payment_form_by_id_html: function (payment_id) {

        var product;
        var url = "/orders/functions/ajax_handle_database.php";
        var arrParams = {'action': 'get_one_order_payment_form_html', 'payment_id': payment_id,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        $('.table-payment_form tbody').prepend(
                            result.buffer
                        );
                    }
                },
                function (error) {
                    console.log("error ", error);
                }
            );
        return product;
    },
    get_logist_order_by_id_html: function (logist_order_id) {
        var product;
        var url = "/orders/functions/ajax_handle_database.php";
        var arrParams = {'action': 'get_one_logist_order_html', 'logist_order_id': logist_order_id,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        $('.table-logistorder tbody').prepend(
                            result.buffer
                        );
                    }
                },
                function (error) {
                    console.log("error ", error);
                }
            );
        return product;
    },

    get_product_by_name: function get_product_by_name(product_name) {

        var product;
        var url = "/orders/functions/ajax_handle_products.php";
        var arrParams = {'action': 'get_product_by_name', 'name': product_name,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        product = result.product;
                        $(document).trigger("on_get_product_by_name_fill_tr", product);
                    }
                },
                function (error) {
                    console.log("error ", error);
                }
            );
        return product;
    },
    save_cell: function save_cell(table_name, id, field_name, value) {
        if (table_name === undefined || id === undefined) return false;
        var url = "/orders/functions/ajax_handle_orders.php";
        var arrParams = {
            'action': 'save_cell',
            'table_name': table_name,
            'id': id,
            'field_name': field_name,
            'value': value,
        };
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        console.log('saved', result);
                    }
                },
                function (error) {
                    console.log("error ", error);
                }
            );

    },
};
var invoices = {
    init: function () {
        invoices.add_event_on__table_all_orders__button_upload_invoice();
        invoices.add_event_on__table_all_orders__button_delete_invoice();

    },
    loadTable: function (order_id) {
        if (order_id > 0) {
            var url = "/orders/functions/ajax_handle_orders.php";
            var arrParams = {'action': 'get_all_invoices', 'order_id': order_id,};
            getAjaxJSON(url, arrParams)
                .then(
                    function (result) {
                        if (result.status == 1) {
                            $('.table-invoices tbody').html(result.buffer);
                            $('.table-invoices a').on('click', function (event) {
                                event.stopPropagation();
                                return true;
                            });
                        }
                    },
                    function (error) {
                        console.log("error ", error);
                    }
                );
        }
    },


    add_event_on__table_all_orders__button_delete_invoice: function () {
        $(document).on('click', '.table_all_orders__button_delete_invoice', function () {
            if (confirm("Удалить инвойс?")) {
                const file = $(this).closest('tr').find('.column-invoice-file a').attr('href');
                const data_row_id = $(this).attr('data-row-id');
                const data_order_id = $(this).attr('data-order-id');
                if (data_row_id !== undefined && data_row_id > 0) {
                    model.deleteRow('ord_invoices', data_row_id);
                    if (file !== undefined && file.length > 0) {
                        model.deleteFile(file);
                    }
                    invoices.loadTable(data_order_id);
                }
            }
        });
    },

    add_event_on__table_all_orders__button_upload_invoice: function () {
        $(document).on('change', 'input[name="upload_invoice_input"]', function () {
            const $file = $(this).val();
            if ($file !== undefined && ($file.indexOf('.xls') >= 0 || $file.indexOf('.xlsx') || $file.indexOf('.pdf') >= 0)) {
                $('.upload_invoice_panel .error').remove();
                $('.upload_invoice_button').show(200);
            } else {
                $('.upload_invoice_panel').append(`<span class="error">Выберите файл формата pdf, xls или xlsx!</span>`);
                $('.upload_invoice_button').hide(200);
            }

        });


        $(document).on('click', '.table_all_orders__button_upload_invoice', function () {
            $('.upload_invoice_panel').toggle(200);
            $('.upload_invoice_panel input[type="file"]').on('click',
                function (event) {
                    event.stopPropagation();
                    return true;
                }
            );
        });
        $(document).on('click', '.upload_invoice_button', function () {
            const url = "/orders/functions/ajax_handle_orders.php";
            const input_file = $(this).closest('.upload_invoice_panel').find('input[type="file"]');
            const file_data = $(input_file).prop('files')[0];
            const path = $(this).attr('data-path');
            const order_id = $(this).attr('data-order-id');
            //console.log(file_data);

            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('action', 'upload_file');
            form_data.append('path', path);
            form_data.append('order_id', order_id);
            //alert(form_data);
            $.ajax({
                url: url,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (php_script_response) {
                    $('.upload_invoice_panel input[name="upload_invoice_input"]').val('');
                    $('.upload_invoice_panel').hide(200);
                    $('.upload_invoice_button').hide();
                    invoices.loadTable(order_id);
                }
            });
        });


    }

};
var orders = {
    show_order_products: (element) => {
        $('.table-invoices a').unbind();
        $('.table-invoices a').on('click', function (event) {
            event.stopPropagation();
        });
        let id = $(element).attr('data-show-products');
        let current_order_tr = $(element).closest('tr');
        let current_spoiler_tr = $('#' + id).closest('tr');
        if ($(current_spoiler_tr).hasClass('visible')) {
            if (!$(element).hasClass('table_all_orders__button_add_product')) {
                $('#' + id).hide(200);
                $('.button_back_to_orders').hide(200);
                setTimeout(function () {
                    $('.table-orders .tr_order').not(current_order_tr).removeClass('invisible').addClass('visible');
                    $('.table-orders .tr_spoiler').removeClass('visible').addClass('invisible');
                    $('.table-orders tr.separator').show();
                }, 100);
            }
        } else {
            $('.table-orders .tr_order').not(current_order_tr).removeClass('visible').addClass('invisible');
            $('.table-orders .tr_spoiler').not(current_spoiler_tr).removeClass('visible').addClass('invisible');
            $('.table-orders tr.separator').hide();
            $(current_order_tr).removeClass('invisible').addClass('visible');
            $(current_spoiler_tr).removeClass('invisible').addClass('visible');
            $('.button_back_to_orders').show(200);
            $('#' + id).show(200);
        }
    },

    recountOrder: function initButtons() {

    },
    initButtons: function initButtons() {
        invoices.init();
        model.init_events();
        paymentforms.add_event_on__table_all_orders__button_delete_paymentform();
        paymentforms.add_event_on__table_all_orders__button_add_paymentform();
        paymentforms.add_event_on__button__download_payment_form_xlsx();
        artikul_price.init();
        $(document).on('click', '.choose_row_button', function () {
            model.chooseRow(this);
        });
        $(document).on('click', '.popup_panel_close_btn', function () {
            $(this).closest('.popup_panel').hide(200);
        });


        $(document).on('DOMSubtreeModified', '.table-orders [data-field-name="brand"].editable-cell.saved', function () {
            let brand = $(this).html();
            let order_id = $(this).attr('data-row-id');
            $('[data-id="order_records_id_' + order_id + '"].orders_choose_product').attr('data-brand', brand);
            $('[data-order-id="' + order_id + '"].button__table_orders_download_xlsx').attr('data-brand', brand);
            $('[data-order-records-id="order_records_id_' + order_id + '"].table_all_orders__button_add_product').attr('data-brand', brand);
        });
        $(document).on('click', '.button__table_orders_download_xlsx', function () {
            let order_id = $(this).attr('data-order-id');
            let template_name = $(this).attr('data-template-name');
            let brand = $(this).attr('data-brand');
            if (order_id > 0 && typeof template_name == "undefined") {
                var url = "/orders/functions/ajax_get_templates_for_excel.php";
                var arrParams = {'brand': brand,};
                getAjaxJSON(url, arrParams)
                    .then(
                        function (result) {
                            if (result.status == 1) {
                                if (Object.keys(result.files).length > 0) {
                                    let html = "<h2>Выберите в каком шаблоне открыть:</h2><ul>";
                                    for (file in result.files) {
                                        html += '<li><a onclick="javascript:document.location.href=\'/orders/excel/download_order_xlsx.php?order_id=' + order_id + '&template=' + brand + '/' + (result.files[file]) + '\'" target="_blank" href="/orders/excel/download_order_xlsx.php?order_id=' + order_id + '&template=' + brand + '/' + (result.files[file]) + '">'
                                            + result.files[file] + '</a></li>';
                                    }
                                    html += "</ul>";
                                    popuppanel.open(html, '#ajax_result_popup_panel2');
                                    return;
                                } else if (Object.keys(result.files).length === 0) {
                                    return;
                                }
                            }
                        },
                        function (error) {
                            console.log("ajax_get_templates_for_excel error ", error);
                        }
                    );
                //
            } else if (order_id > 0) {
                alert(template_name);
                openInNewTab("/orders/excel/download_order_xlsx.php?order_id=" + order_id + '&template=' + template_name + '&xxx=1');
            }
        });

        $(document).on('click', '.popupform span.activeness', function () {
            $(this).toggleClass('active');
            if ($(this).is('.active')) {
                $('form input[name="active"]').val('1');
            } else {
                $('form input[name="active"]').val('0');
            }
        });

        $(document).on('rowAdded', 'body', function (event, param) {
            $('[data-row-id="new"].editable-cell').attr('data-row-id', param.insert_id);
        });

        $(document).on('DOMSubtreeModified',
            "div[data-field-name=\"quantity\"].editable-cell,div[data-field-name=\"price\"].editable-cell",
            function () {
                if ($(this).hasClass('saved')) {
                    let quantity = $(this).closest('tr').find('[data-field-name="quantity"].editable-cell').html();
                    let price = $(this).closest('tr').find('[data-field-name="price"].editable-cell').html();
                    let td_price = $(this).closest('tr').find('.price-sum');
                    $(td_price).html(quantity * price);
                    let spoiler = $(this).closest('.spoiler');
                    let price_sums = $(spoiler).find('.price-sum');
                    let price_quantities = $(spoiler).find('[data-field-name="quantity"].editable-cell');
                    let counter_price = 0;
                    let counter_quantity = 0;
                    price_sums.each(function (index, element) {
                        counter_price += parseInt($(element).html());
                    });
                    price_quantities.each(function (index, element) {
                        counter_quantity += parseInt($(element).html());
                    });
                    let order_price_sum = $(spoiler).parent().parent().prev().find('.order-price-sum');
                    let order_quantity_sum = $(spoiler).parent().parent().prev().find('.order-quantity-sum');

                    $(order_price_sum).html(counter_price);
                    $(order_quantity_sum).html(counter_quantity);
                }
            });
        $(document).on('click', '.button__table_orders_remove_product', function (event, data) {
            let product_id = $(this).attr('data-product-id');
            let order_id = $(this).attr('data-order-id');
            let doDelete = confirm("Вы уверены, что хотите удалить этот продукт из заявки?");
            if (doDelete) {
                model.deleteRowsByCondition(
                    'ord_order_items',
                    "WHERE `product_id`='" + product_id + "' and `order_id`='" + order_id + "'");
                $(this).closest('tr').remove();
                orders.recountOrder(order_id);
            }
        });
        $(document).on('on_get_product_by_name_fill_tr', function (event, data) {
            console.log(data);
//            var tr = $('.table.table-orders .orders_choose_product.active').closest('tr');                                         
//                                        $(tr).children('td:first').html(data);            


        })


//////////////
        $(document).on('click', '.button__table_orders_edit_product', function () {
            var product_id = $(this).attr('data-product-id');
            var parent_tr = $(this).parent().parent("tr");
            $(parent_tr).after("<tr id='tr_edit_product_id_" + product_id + "'><td colspan='7'><div class='form_edit_panel'></div></td></tr>");
            $.post(
                "/orders/functions/ajax_edit_product.php",
                {
                    action: "get_values",
                    id: product_id,
                    field_name: "name",
                },
                function (data) {
                    const result = JSON.parse(data);
                    $("#tr_edit_product_id_" + product_id + " td div.form_edit_panel").html(result.buffer);
                }
            );
        });
        $(document).on('click', '.ajax_form_edit_product input[type="button"].cancel', function () {
            var form_edit_panel = $('.form_edit_panel').closest('.form_edit_panel');
            var tr = $(form_edit_panel).closest('tr');
            $(tr).remove();
        });
        $(document).on('click', '.ajax_form_edit_product input[type="submit"]', function (event) {
            event.preventDefault();
            $('form.ajax_form_edit_product').submit();
        });
        $(document).on('submit', 'form.ajax_form_edit_product', function (event) {
            event.preventDefault();
            let form = $(this);
            let tr_id_str = $(this).closest('div.spoiler').attr('id');
            //let tr_id = tr_id_str.replace(/[^-0-9]/gim,'')
            let m_data = $(this).serialize();

            var url = "/orders/functions/ajax_handle_products.php";
            var arrParams = m_data;
//            var arrParams = {'action': 'update_product', 'params': m_data, };

            getAjaxJSON(url, arrParams)
                .then(
                    function (result) {
                        if (result.status == 1) {
                            console.log("update product -> success ");
                            let submit_button = $(form).find('input[type="submit"]');
                            $(submit_button).prop('disabled', 'disabled');
                            $(submit_button).val('Сохранено!');
                            setTimeout(function () {
                                $(form).find('input[type="button"].cancel').click();
                                refresh_all_orders(tr_id_str);
                            }, 1000);
                        }
                    },
                    function (error) {
                        console.log("update product error ", error);
                    }
                );


        });


///////////
        $(document).on('click', '.show_products_button',
            function () {
                orders.show_order_products(this);
            });
        $(document).on('click', '.button_back_to_orders',
            function () {
                $('.tr_order.visible .show_products_button').click();
            });

//////////
        $(document).on('click', '.table_all_orders__button_add_product',
            function () {
                orders.show_order_products(this);
                let id = $(this).attr('data-show-products');
                let brand = $(this).attr('data-brand');
                //console.log("id" + id +" ",$('#' + id + ' .orders_choose_product').length);
                const orders_choose_product_button = '#' + id + ' .orders_choose_product';
                if ($(orders_choose_product_button).length) {
                    $(orders_choose_product_button).attr('data-brand', brand);
                    $(orders_choose_product_button).click();
                    return;
                }
                $('.table-orders .spoiler:not(#' + id + ')').hide(200);
                $('#' + id).show(200);

                let order_records_id = $(this).attr('data-order-records-id');
                $('#' + order_records_id + ' table.table-products')
                    .append(
                        '<tr id="new_product_order_'
                        + order_records_id
                        + '"><td class="column-product-name">' +
                        '<input data-id="' + order_records_id + '" class="green_button orders_choose_product" type="button" value=" выбрать продукт...">' +
                        '</td>'
                        + '<td class="column-product-description"></td>'
                        + '<td class="column-product-quantity"></td>'
                        + '<td class="column-product-price"></td>'
                        + '<td class="column-product-sum"></td>'
                        + '<td class="column-product-russian-fields"></td>'
                        + '<td class="column-product-actions">'
                        + ''
                        + '<span data-product-id="" data-order-id="' + order_records_id + '"  title="Убрать" class="button__table_orders_remove_product"> </span>'
                        + '</td>'
                        + '</tr>');

                $('#new_product_order_' + order_records_id + ' .orders_choose_product').attr('data-brand', brand);
                $('#new_product_order_' + order_records_id + ' .orders_choose_product').click();

                //console.log()
                //alert(order_records_id);

            });
        $(document).on('click', '.table.table-orders .orders_choose_product',
            function () {
                $('.table.table-orders .orders_choose_product').removeClass('active');
                let brand = $(this).attr('data-brand');
                $(this).addClass('active');
                $('.orders_panel_choose_product_wrapper').show(200);
                $('.orders_panel_choose_product_search').focus();
                $('.orders_panel_choose_product_search').attr('data-brand', brand);
                $('.orders_panel_choose_product_search').keyup();


            });
        $(document).on('click', '.orders_panel_choose_product_close_btn',
            function () {
                $('.orders_panel_choose_product_wrapper').hide(200);
            });
        $(document).on('keyup', '.orders_panel_choose_product_search',
            function () {
                handle__input_search_product(this);
            });
        $(document).on('click', '.orders_panel_choose_product_search__clear_text',
            function () {
                $('.orders_panel_choose_product_search').val('');
                $('.orders_panel_choose_product_search').trigger('keyup');
            });


//////////
        $(document).on('click', '.table_all_orders__button_delete_order',
            function () {
                var order_id = $(this).attr('data-order-id');
                let doDelete = confirm("Вы уверены, что хотите удалить заявку №" + order_id + " ?");
                if (doDelete) {
                    //model.deleteRowsByCondition("ord_order_items", "WHERE `order_id`='" + order_id + "'");
                    model.deleteRow("ord_orders", order_id);
                    refresh_all_orders();
                }
            });

    },
    initFilterPanel: function initFilterPanel() {
        orders.initFilterPanelPeriod();
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
    initFilterPanelPeriod: function initFilterPanelPeriod() {
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
    add_event__table_all_orders__button_add_product: function () {

    },
    add_event__show_products_button: function () {

    },
    add_event__editable_cell: function () {
        $(document).on(
            'dblclick',
            '.editable-cell',
            function (event) {
                if (!$(this).is('.in-editing')) {
                    $(this).addClass('in-editing');
                    $(this).removeClass('saved');
                    const type = $(this).attr('data-field-type');
                    const currentHtml = $(this).html();
                    switch (type) {
                        case 'date-picker':
                            $(this).html('<input class="datepicker" type="text" value="' + $.trim(currentHtml) + '">');
                            $(this).children('input').focus();
                            $(this).children('input').select();
                            break;
                        case 'input':
                            $(this).html('<input type="text" value="' + $.trim(currentHtml) + ' ">');
                            $(this).children('input').focus();
                            $(this).children('input').select();
                            break;
                        case 'textarea':
                            $(this).html('<textarea>' + $.trim(currentHtml) + '</textarea>');
                            $(this).children('textarea').focus();
                            $(this).children('textarea').select();
                            break;
                        case 'select':
                            const options_str = $(this).attr('data-all-options');
                            const options_arr = options_str.split(',');
                            let select = $("<select>");
                            options_arr.forEach(function (entry) {
                                if (currentHtml == entry) {
                                    select.append("<option selected='selected'>" + entry + "</option>");
                                } else {
                                    select.append("<option>" + entry + "</option>");

                                }
                            });
                            $(this).html(select);
                            //$(this).children('textarea').focus();
                            break;
                        default:
                            break;
                    }
                }

            });
        $(document).on(
            'focusout change',
            '.editable-cell.in-editing textarea,.editable-cell.in-editing input,.editable-cell.in-editing select',
            function (event) {
                const element = this;
                setTimeout(function () {
                    if ($(element).is('.datepicker')) {
                        if ($('#xcalend').css('display') === 'table') return;
                    }
                    const cell = $(element).parent();
                    $(cell).removeClass('in-editing');
                    $(cell).addClass('in-saving');
                    const currentHtml = $(element).val();
                    $(cell).html(currentHtml);
                    orders.save_cell(cell);
                    $(cell).removeClass('in-saving');
                    $(cell).addClass('saved');
                    $(cell).trigger('DOMSubtreeModified');

                }, 100);
            });

    },
    save_cell: function (cell) {
        model.save_cell($(cell).attr('data-table'), $(cell).attr('data-row-id'), $(cell).attr('data-field-name'), $(cell).html())
    },
    set_button_function: function (str_button, func) {
        $(document).on(
            'click',
            str_button,
            func);
    },

};
function loadProducts() {
    var arrFilter_brand = [];
    var arrFilter_period_year = [];
    var arrFilter_period_month = [];
    var arrFilter_activeness = [];
    var filter_product_name = $('.block_filter_by_product_value').val();

    $('span[data-parameter="filter_brand[]"].active').each(function (index) {
        arrFilter_brand.push($(this).attr('data-value'));
    });
    $('span[data-parameter="filter_period_year[]"].active').each(function (index) {
        arrFilter_period_year.push($(this).attr('data-value'));
    });
    $('span[data-parameter="filter_period_month[]"].active').each(function (index) {
        arrFilter_period_month.push($(this).attr('data-value'));
    });
    $('span[data-parameter="filter_activeness[]"].active').each(function (index) {
        arrFilter_activeness.push($(this).attr('data-value'));
    });

    $.post("/orders/functions/ajax_products_maintable.php",
        {
            action: "loadProducts",
            arrFilter_brand: arrFilter_brand,
            arrFilter_period_year: arrFilter_period_year,
            arrFilter_period_month: arrFilter_period_month,
            arrFilter_activeness: arrFilter_activeness,
            filter_product_name: filter_product_name,
        },
        function (data) {
            $('#page').html(data);
            add_event_on__edit_row();
            add_event_on__button_open_panel_of_orders();


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
function add_event_on__all_orders_button() {

    $('.all_orders_button').click(function (e) {
        e.preventDefault();
        var url = "/orders/functions/ajax_handle_orders.php";
        var arrParams = {'action': 'get_all_orders',};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    if (result.status == 1) {
                        popuppanel.open(result.buffer, '#ajax_result_popup_panel');


                        //add_event_on__button__table_orders_edit_product();
                    }
                },
                function (error) {
                    console.log("error ", error);
                }
            );

    });
}
function refresh_all_orders(open_order = '') {
    var url = "/orders/functions/ajax_handle_orders.php";
    var arrParams = {'action': 'get_all_orders',};
    getAjaxJSON(url, arrParams)
        .then(
            function (result) {
                if (result.status == 1) {
                    popuppanel.open(result.buffer,'#ajax_result_popup_panel');
                    if (open_order !== '') {
                        $('[data-show-products="' + open_order + '"].show_products_button').click();
                        //console.log("open_order ",open_order);
                    }
                }
            },
            function (error) {
                console.log("error ", error);
            }
        );
}


//function add_event_on__button__table_orders_edit_product() {
//    
//}
function add_event_on__edit_row() {
    $('.table-products tr.edit_row td span.value').dblclick(event_field);
    $('.table-products tr.edit_row td .product_comments').click(product_comments);
    $('.table-products tr.edit_row.separator .remove_item').click(function () {
        delete_separator($(this).parent().parent().attr('data-id'));
    });

}

function delete_separator(separator_id) {
    if (confirm("Удалить разделитель?")) {
        if (separator_id > 0) {
            $.ajax({
                    data: {
                        'action': 'delete_separator',
                        'separator_id': separator_id,
                    },
                    type: "post",
                    url: "/orders/functions/ajax_handle_products.php",
                    success:
                        function (data) {
                            var res = JSON.parse(data);
                            if (res.status) {
                                $('tr[data-id="' + separator_id + '"]').remove();
                            }
                        }
                }
            );
        }
    }
}

function add_event_on__button_back_to_orders() {
    $(document).on('click', '.button_back_to_orders', function (e) {
        e.preventDefault();
        $('.show_products_button').click();
    });
}

function add_event_on__button_add_new_order() {
    $(document).on('click', '.button_add_new_order', function (e) {
        e.preventDefault();
        var url = "/orders/functions/ajax_handle_orders.php";
        var arrParams = {'action': 'add_new_order',};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    console.log(result);
                    let table_orders = $("#ajax_result_popup_panel table.table-orders tr.separator:first");
                    if (table_orders.length) {
                        let today = new Date();
                        let arrParameters = {
                            'table': 'ord_orders',
                            'fields': {
                                'date_created': today,
                                'date_modified': '',
                                'month': today.getMonth(),
                                'year': today.getMonth(),
                                'brand': '',
                                'description': '',
                                'status': '',
                            }
                        };
                        //console.log(arrParameters)
                        //model.addRow('ord_orders', arrParameters);
                        refresh_all_orders();
                    }

                },
                function (error) {
                    console.log("error ", error);
                }
            );
    });
}

function add_event_on__input_filter_by_product() {
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

        if ($('#result_input_filter_by_product').html() != '') {
            $('#result_input_filter_by_product').addClass('active');
        }
    });
}

function handle__input_search_product(my_input) {
    let text = $(my_input).val();
    let brand = $(my_input).attr('data-brand');
    //var tr_id = $(tr).attr('id');
    console.log("handle__input_search_product");
    if (text.length > 0 || brand.length > 0) {
        //console.log(text);
        var url = "/orders/functions/ajax_get_products_by_text.php";
        var arrParams = {'action': 'get_products', 'text': text, 'brand': brand,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    //console.log($(my_input).parent());
                    $('.orders_panel_choose_product').html(result.buffer);
                    $('.orders_panel_choose_product .filter_by_product__item').click(
                        function () {
                            $(my_input).val($(this).html());
                            let product_name = $('.orders_panel_choose_product_search').val();
                            let url = "/orders/functions/ajax_handle_products.php";
                            let arrParams = {'action': 'get_product_by_name', 'name': product_name,};
                            getAjaxJSON(url, arrParams)
                                .then(
                                    function (result) {
                                        if (result.status == 1) {
                                            let product = result.product;
                                            let order_id = $('.table.table-orders .orders_choose_product.active').attr('data-id');
                                            let tr_id = "new_product_order_" + order_id;
                                            let tr = $("#" + tr_id);

                                            $(tr).children('td.column-product-name').html(product.name);
                                            $(tr).children('td.column-product-description').html(product.description);
                                            $(tr).children('td.column-product-quantity').html('<div data-row-id="new" data-table="ord_order_items" data-field-type="input" data-field-name="quantity" class="editable-cell text_align_center">1</div>');
                                            $(tr).children('td.column-product-price').html("<div data-row-id=\"new\" data-table=\"ord_order_items\" data-field-type=\"input\" data-field-name=\"price\"  class='editable-cell text_align_center'>" + product.reference_price + "</div>");
                                            $(tr).children('td.column-product-sum').html("<div class=\"price-sum\">" + product.reference_price + "</div>");
                                            let rus_fields = '';
                                            // продолжать тут !!!
                                            if (product.name_rus !== undefined && product.name_rus.length > 0) {
                                                rus_fields += '<span class="text_color_green">[арт]</span>';
                                            } else {
                                                rus_fields += '<span class="text_color_red">[арт]</span>';
                                            }
                                            if (product.description_rus !== undefined && product.description_rus.length > 0) {
                                                rus_fields += '<span class="text_color_green">[опис]</span>';
                                            } else {
                                                rus_fields += '<span class="text_color_red">[опис]</span>';
                                            }
                                            if (product.name_1c !== undefined && product.name_1c.length > 0) {
                                                rus_fields += '<span class="text_color_green">[1с]</span>';
                                            } else {
                                                rus_fields += '<span class="text_color_red">[1с]</span>';
                                            }
                                            console.log("rus_fields", rus_fields);

                                            /*
                                                                                            <span class="text_color_red">[опис]</span>
                                                                                            <span class="text_color_green">[1с]</span>*/

                                            $(tr).children('td.column-product-russian-fields').html("<div class=\"fields-filled\"> " + rus_fields + " </div>");

//                                          $('#'+tr_id+' td.actions span.button__table_orders_edit_product').attr('data-product-id', product.id);
//                                          $('#'+tr_id+' td.actions span.button__table_orders_edit_product').attr('data-order-id', order_id);

                                            var insert_html =
                                                '<span data-product-id="'
                                                + product.id
                                                + '" data-order-id='
                                                + order_id
                                                + ' title="Редактировать" class="btn button__table_orders_edit_product"><i class="material-icons">edit</i>'
                                                + '</span>'
                                                + ' <span data-product-id="' + product.id + '" data-order-id="' + order_id + '" title="Убрать" '
                                                + ' class="btn xxx button__table_orders_remove_product">'
                                                + '<i class="material-icons">indeterminate_check_box</i>'
                                                + '</span>';
                                            $('#' + tr_id + ' td.column-product-actions').prepend(insert_html);
                                            $('#' + tr_id + ' td.column-product-actions span.button__table_orders_remove_product').attr('data-product-id', product.id);
                                            $('#' + tr_id + ' td.column-product-actions span.button__table_orders_remove_product').attr('data-order-id', order_id.replace(/[^-0-9]/gim, ''));


                                            $(tr).removeAttr('id');
                                            $('#tr_no_products__' + order_id).html(`
<th>Артикул</th>
<th>Описание</th>
<th>Количество</th>
<th>Цена</th>
<th>Сумма</th>
<th>Русские поля</th>
<th>
Действия
<span title="Добавить продукт в заявку"
class="btn table_all_orders__button_add_product"
data-brand="` + product.brand + `"
data-order-records-id="` + order_id + `"
data-show-products="` + order_id + `"
><i class="material-icons">playlist_add</i></span>
</th>
`);

                                            //console.log('#tr_no_products__'+order_id);
                                            let arrParams = {
                                                'order_id': order_id.replace(/[^-0-9]/gim, ''),
                                                'product_id': product.id,
                                                'price': product.reference_price,
                                                'quantity': 1,
                                            }
                                            model.addRow('ord_order_items', arrParams);

                                            //$(document).trigger("on_get_product_by_name_fill_tr", product);
                                        }
                                    },
                                    function (error) {
                                        console.log("error ", error);
                                    }
                                );


                            $('.orders_panel_choose_product_close_btn').click();
                        });
                    /*                    $('.orders_panel_choose_product_search').on('searchchange',
                                            function () {
                                                //model.get_product_by_name(product_name);
                    //                                        var tr = $('.table.table-orders .orders_choose_product.active').closest('tr');
                    //
                    //                                        $(tr).children('td:first').html(product_name);
                    //                                        console.log(model.get_product_by_name(product_name));
                                                //console.log(model);
                                            }
                                        );*/
                },
                function (error) {
                    console.log("error ", error);
                }
            );


    } else {
        $('#result_input_filter_by_product').html('');
        $('#result_input_filter_by_product').removeClass('active');
    }
}


function handle__input_filter_by_product(my_input) {
    var text = $(my_input).val();
    if (text.length > 1) {
        console.log(text);
        var url = "/orders/functions/ajax_get_products_by_text.php";
        var arrParams = {'action': 'get_products', 'text': text,};
        getAjaxJSON(url, arrParams)
            .then(
                function (result) {
                    $('#result_input_filter_by_product').html(result.buffer);
                    $('.filter_by_product__item').click(
                        function () {
                            $('.block_filter_by_product input.input_filter_by_product')
                                .val($(this).html()).trigger('change');

                        });
                    if ($('#result_input_filter_by_product').html() != '') {
                        $('#result_input_filter_by_product').addClass('active');
                    }

                    $('input.input_filter_by_product').on('change',
                        function () {
                            $('.block_filter_by_product_value').val($('input.input_filter_by_product').val());
                            loadProducts();
//                                        var name = $('.block_filter_by_product_value').val();                                         
//                                        if (name != '') {
                            loadProducts();
//                                            $('tr[data-name="' + name + '"]').addClass('visible');
//                                            $('.table-products tr.edit_row.active:not(.visible)').hide(200); 
//                                            console.log("!!!"+name+" 339");
//                                        }else{   
                            $('.block_filter_by_product_value').val($('input.input_filter_by_product').val());
                            loadProducts();
//                                            $('.table-products tr.edit_row.active').removeClass('visible');
//                                            $('.table-products tr.edit_row.active').show(200);  
//                                        }
                        }
                    );
                },
                function (error) {
                    console.log("error ", error);
                }
            );


    } else {
        $('#result_input_filter_by_product').html('');
        $('#result_input_filter_by_product').removeClass('active');
    }
}

function add_event_on__add_product_button() {
    $('.add_product_button').click(function (e) {
        e.preventDefault();
        $.post(
            "/orders/functions/ajax_handle_products.php",
            {
                action: "add_product"
            },
            function (data) {
                res = JSON.parse(data);
                if (res.status == 1) {
                    popuppanel.open(res.buffer);
                    $('select[name="row_type"]').on('change', function () {
                        if (this.value == 'separator') {
                            $('.tr_name_1c').hide();
                            $('.tr_reference_price_currency').hide();
                            $('.tr_description').hide();
                        } else {
                            $('.tr_name_1c').show();
                            $('.tr_reference_price_currency').show();
                        }
                    });
                    $("#form_add_product input[type='submit']").click(function (event) {
                        event.preventDefault();
                        $("#form_add_product").submit();
                    });
                    $("#form_add_product").submit(function (e) {
                            e.preventDefault();
                            var m_data = $(this).serialize();
                            $.ajax({
                                type: 'post',
                                url: '/orders/functions/ajax_handle_products.php',
                                data: m_data,
                                success: function (data) {
                                    var res = JSON.parse(data);
                                    if (res.status == true) {
                                        $('#form_ajax_result').html('<span class="message_green">Сохранено!</span>');
                                        setTimeout(function () {
                                            $('.ajax_result_popup_panel_fancybox_close_button').click();
                                        }, 500);
                                        setTimeout(function () {
                                            location.reload();
                                        }, 1000);

                                    } else {
                                        $('#form_ajax_result').html('<span class="message_red">Что-то пошло не так!</span>');
                                    }
                                }
                            });
                        }
                    );
                }
            }
        );
    });
}

////////////////////////////////////////////////////////////////////////////////
function add_event_on__button_open_panel_of_orders() {
    $('.open_panel_of_orders').unbind();
    $('.open_panel_of_orders').click(function (e) {
        e.preventDefault();
        var product_id = $(this).parent().parent().attr('data-id');
        var month = $(this).attr('data-month');
        var brand = $(this).attr('data-brand');
        var intent_id = $(this).attr('data-intent-id');

        $.post(
            "/orders/functions/ajax_handle_orders.php",
            {
                action: "get_order_panel",
                product_id: product_id,
                intent_id: intent_id,
                month: month,
                brand: brand,
                year: '2019',
            },
            function (data) {
                res = JSON.parse(data);
                if (res.status) {
                    popuppanel.open(res.buffer);


                }

            }
        );
    });
}

////////////////////////////////////////////////////////////////////////////////


function event_field() {
    if ($(this).hasClass('in_editing')) {
        console.log(this);
    } else {
        edit_type = $(this).attr('data-edit-type');
        switch (edit_type) {
            case 'edit_intent':
                edit_intent(this);
                break;
            case 'direct':
                direct_edit_field(this);
                break;
            case 'indirect':
                indirect_edit_field(this);
                break;
        }
    }
}

function edit_intent(field) {
    var current_row_id = $(field).parent().parent().attr('data-id');
    var intent_id = $(field).attr('data-intent-id');
    var month = $(field).attr('data-month');
    var current_value = $(field).html();
    $(field).addClass('in_editing');
    $(field).html(
        '<input id="input_' + current_row_id + '"'
        + ' type="text" value="' + current_value + '"'
        + 'data-row_id="' + current_row_id + '"'
        + 'data-month="' + month + '"'
        + 'data-intent-id="' + intent_id + '"'
        + ' class="input_in_direct_editing" />');
    input = $(field).children('#input_' + current_row_id);
    $(input).attr('data-oldvalue', current_value);
    $(input).focus();
    $(input)[0].setSelectionRange(0, 1000);
    /////////////////////////////////////////////////////
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $(".table-products input:focus").focusout();
        }
    });
    /////////////////////////////////////////////////////
    $('#input_' + current_row_id).focusout(function () {
        var value = $(this).val();
        var old_value = $(this).attr('data-oldvalue');
        var intent_id = $(this).attr('data-intent-id');
        var month = $(this).attr('data-month');
        var product_id = $(this).attr('data-row_id');
        var td = $(this).parent().parent();
        $(td).children('span.value').removeClass('in_editing');
        $(td).children('span.value').html(value);
        if ($(td).children('.open_panel_of_orders').length == 0) {
            $(td).append('<span data-brand="Weintek" data-month="' + month + '" class="open_panel_of_orders">...</span>');
            add_event_on__button_open_panel_of_orders();
        }
        if (value !== old_value) {
            $.post(
                "/orders/functions/ajax_edit_intent.php",
                {
                    action: "edit_intent",
                    product_id: product_id,
                    intent_id: intent_id,
                    month: month,
                    product_intent_quantity: value,
                },
                function (data) {
                    var res = JSON.parse(data);
                    if (res.status) {

                    } else {
                        $('.table-products tr[data-id="' + res.id + '"] td span[data-field-month="' + month + '"]').html(old_value);

                        if (res.is_error)
                            alert(res.buffer);
                    }
                }
            );
        }

    });


}


function direct_edit_field(field) {
    current_row_id = $(field).parent().parent().attr('data-id');
    current_row_tr_class = $(field).attr('class');
    data_rel_field_name = $(field).attr('data-field-name');
    current_row_tr_value = $(field).html();
    $(field).addClass('in_editing');
    $(field).html(
        '<input id="input_' + current_row_id + '"'
        + ' type="text" value="' + current_row_tr_value + '"'
        + 'data-row_id="' + current_row_id + '"'
        + 'data-field_name="' + data_rel_field_name + '"'
        + ' class="input_in_direct_editing" />');
    input = $(field).children('#input_' + current_row_id);
    $(input).attr('data-oldvalue', current_row_tr_value);
    $(input).focus();
    $(input)[0].setSelectionRange(0, 1000);
    /////////////////////////////////////////////////////
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $(".table-products input:focus").focusout();
        }
    });
    /////////////////////////////////////////////////////
    $('#input_' + current_row_id).focusout(function () {
        value = $(this).val();
        old_value = $(this).attr('data-oldvalue');
        field_name = $(this).attr('data-field_name');
        id = $(this).attr('data-row_id');
        td = $(this).parent().parent();
        $(td).children().removeClass('in_editing');
        $(td).children('span.value').html(value);
        if (value !== old_value) {
            $.post(
                "/orders/functions/ajax_handle_products.php",
                {
                    action: "edit_field",
                    id: id,
                    field_name: field_name,
                    value: value,
                    old_value: old_value,
                },
                function (data) {
                    var res = JSON.parse(data);

                    if (res.status) {

                        if (res.new_id > 0) {
                            $('.table-products tr#new').attr('id', res.new_id);
                            $('.table-products tr#' + res.new_id + ' td:first-child').html(res.new_id);

                        }
                    } else {
                        $('.table-products tr[data-id="' + res.id + '"] td span[data-field_name="' + res.field_name + '"]').html(res.old_value);
                        if (res.is_error)
                            alert(res.buffer);
                    }
                }
            );
        }

    });


}

function indirect_edit_field(field) {
    current_row_id = $(field).parent().parent().attr('data-id');
    current_row_tr_class = $(field).attr('class');
    data_rel_field_name = $(field).attr('data-field-name');
    //data_rel_field_month = $(field).attr('data-field-month');

    if (current_row_id > 0 && data_rel_field_name == 'name') {
        $.post(
            "/orders/functions/ajax_edit_field.php",
            {
                action: "get_values",
                id: current_row_id,
                field_name: data_rel_field_name,
            },
            onAjaxSuccess_get_values
        );
    }

    function onAjaxSuccess_edit_intent(data) {
        var res = JSON.parse(data);
        if (res.status == 1) {
            popuppanel.open(res.buffer);
            $(".clear_inputs").bind("click", function () {
                $("input[name='product_intent_quantity']").val($(this).attr('data-origin-value'));
            });
            $("#form_edit_intent input[type='submit']").click(
                function (e) {
                    e.preventDefault();
                    $("#form_edit_intent").submit();
                });
            $('#form_edit_intent').submit(function (e) {
                e.preventDefault();
                var m_data = $(this).serialize();
                $.ajax({
                    type: 'post',
                    url: '/orders/functions/ajax_edit_intent.php',
                    data: m_data,
                    success: function (data) {
                        var res = JSON.parse(data);
                        if (res.status == true) {
                            $('#form_edit_name_ajax_result').html('<span class="message_green">Сохранено!</span>');
                            $('tr[data-id="' +
                                current_row_id + '"] td[data-field-name="intent"][data-field-month="' +
                                data_rel_field_month +
                                '"] span.value').html($('input[name="product_intent_quantity"]').val());
                            setTimeout(function () {
                                $('.ajax_result_popup_panel_fancybox_close_button').click();
                            }, 500);
                        } else {
                            $('#form_edit_name_ajax_result').html('<span class="message_red">Что-то пошло не так!</span>');
                        }
                    }
                });
            });


        }
    }

    function onAjaxSuccess_get_values(data) {
        var res = JSON.parse(data);
        if (res.status == 1) {
            popuppanel.open(res.buffer);
            //$('#ajax_result_popup_panel').html(res.buffer);
            $('select[name="row_type"]').on('change', function () {
                if (this.value == 'separator') {
                    $('.tr_name_1c').hide();
                    $('.tr_reference_price_currency').hide();
                    $('.tr_row_type').hide();

                } else {
                    $('.tr_name_1c').show();
                    $('.tr_reference_price_currency').show();

                }
            });
            $(".clear_inputs").bind("click", function () {
                var data_product_id = $(this).attr('data-product_id');
                $("input[data-product_id='" + data_product_id + "']").val($(this).attr('data-origin-value'));
            });


            $("#form_edit_name input[type='submit']").click(
                function (e) {
                    e.preventDefault();
                    $("#form_edit_name").submit();
                });


            $('#form_edit_name').submit(function (e) {
                e.preventDefault();
                var m_data = $(this).serialize();
                //console.log(m_data);
                $.ajax({
                    type: 'post',
                    url: '/orders/functions/ajax_edit_field.php',
                    data: m_data,
                    success: function (data) {
                        var res = JSON.parse(data);
                        if (res.status == true) {
                            $('#form_edit_name_ajax_result').html('<span class="message_green">Сохранено!</span>');
                            $('tr[data-id="' + current_row_id + '"] td[data-field-name="' + data_rel_field_name + '"] span.value').html($('input[name="name"]').val());
                            setTimeout(function () {
                                $('.ajax_result_popup_panel_fancybox_close_button').click();
                            }, 500);
                        } else {
                            $('#form_edit_name_ajax_result').html('<span class="message_red">Что-то пошло не так!</span>');
                        }
                    }
                });
            });


            /* $("#ajax_result_popup_panel").fancybox({modal: true, scrolling: 'auto', autoScale: true}).trigger('click');
             $('#ajax_result_popup_panel').append('<span class="ajax_result_popup_panel_close_button">xxx</span>');
             $('.ajax_result_popup_panel_close_button').click(
             function (event) {
             event.preventDefault();
             $.fancybox.close();
             }
             );*/
            /**************/

            /*
             $.fancybox.open({
             src: '#ajax_result_popup_panel',
             type: 'inline',
             opts: {
             onComplete: function () {
             console.info('done!');
             }
             }
             });*/


        }

    }
}









