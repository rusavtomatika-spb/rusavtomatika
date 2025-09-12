
function initPage() {
    
    orders.initFilterPanel();
    orders.add_event__table_all_orders__button_add_product();
    orders.add_event__show_products_button();
    orders.add_event__editable_cell();
    application_order.init();

    add_event_on__button_add_new_order();

    orders.initButtons();
    checkAuth();
    $("#login_panel").change(function () {
        if ($('#login_panel .current_user').attr('data-user-code') !== undefined
                && $('#login_panel .current_user').attr('data-user-code') == $.cookie('login'))
        {
            loadProducts();
        }
    });

    if ($(".block_filter_by_product_value").val() != ''){
        $(".input_filter_by_product").val($(".block_filter_by_product_value").val()); 
    }
    

    
}
initPage();

$(function () {
    $(window).scroll(function () {
        if ($('table.table2').is('.table2')) {
            if ($(this).scrollTop() >= ($('table.table2').offset().top - 30)) {

                $('.stickytop').addClass('fixed');
                $('table.table2').css('margin-top', '22px');
                $('table.table1').width($('table.table2').width());
            } else {
                $('table.table2').css('margin-top', '');
                $('.stickytop').removeClass('fixed');
            }
        }
    });
});

/*
(function () {
    var url = "/orders/functions/test.php";
    var arrParams = {'data1': 'value1', 'data2': 'value2', };
    getAjaxJSON(url, arrParams)
            .then(
                    function (result) {
                        console.log(result);
                    },
                    function (error) {
                        console.log("error ", error);
                    }
            );
})();*/


