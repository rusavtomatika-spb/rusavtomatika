var popuppanel = {
    panel: '#ajax_result_popup_panel',
    open: (content, popup_panel_id='') => {
        if(typeof popup_panel_id !== 'undefined' && popup_panel_id != ''){
            popuppanel.panel = popup_panel_id;
        }
        $(popuppanel.panel).html(content);
        $(popuppanel.panel).fancybox({modal: true, scrolling: 'auto', autoScale: true}).trigger('click');
        $(popuppanel.panel).append('<span class="ajax_result_popup_panel_fancybox_close_button">xxx</span>');
        /*$(".ajax_result_popup_panel_close_button, input[type='button'].cancel").click(
                function (event) {
                    
                }
        );*/
    }
};

$(document).on(
        'click',
        '.ajax_result_popup_panel_fancybox_close_button',
        function () {
            event.preventDefault();
            $.fancybox.close();
        });


