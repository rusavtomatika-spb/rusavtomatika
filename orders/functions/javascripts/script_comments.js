$(document).on('click', '.table_all_orders__button_open_comments', function () {
    let button = this;
    order_comments.order_comments(button);
});

var comments = {
    addEvent_ButtonDeleteMessage: () => {
        $('.comment_button_delete').click(function (event) {
            event.preventDefault();
            if (confirm("Удалить сообщение?")) {
                var message_id = $(this).attr('data-comment-id');
                var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
                var product_id = $('.panel_product_comments').attr('data-product-id');
                if (message_id > 0 && current_user_login_md5 != '' && product_id > 0) {
                    $.ajax({
                        data: {
                            'action': 'delete_message',
                            'product_id': product_id,
                            'message_id': message_id,
                            'current_user_login_md5': current_user_login_md5},
                        type: "post",
                        url: "/orders/functions/ajax_product_comments.php",
                        success:
                                function (data) {
                                    var res = JSON.parse(data);
                                    if (res.status == 1) {
                                        refreshCommentsMessages();
                                    }
                                }
                    }
                    );
                }
            }

        });
    },
    addEvent_ButtonEditMessage: () => {
        $('.comment_button_edit').click(function (event) {
            var message_id = $(this).attr('data-comment-id');
            var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
            var product_id = $('.panel_product_comments').attr('data-product-id');

            if (message_id > 0 && current_user_login_md5 != '' && product_id > 0) {
                var comment_div = $(this).parent().parent();
                var comment_text_div = $(this).parent().parent().children('.comment_text');
                console.log($(comment_text_div).html());
                $(comment_div).append('<div id = "edit_message_' + message_id + '"><textarea rows="3" cols="70" name="edit_message"></textarea></div>');
                $("#edit_message_" + message_id + " textarea").val($(comment_text_div).html());
                $('.comment[data-comment-id="' + message_id + '"] .comment_buttons,.comment[data-comment-id="' + message_id + '"] .comment_button_save,.comment[data-comment-id="' + message_id + '"] .comment_button_cancel').show();
                $('.comment[data-comment-id="' + message_id + '"] .comment_buttons').css('display', 'inline-block');
                $('.comment[data-comment-id="' + message_id + '"] .comment_buttons').css('bottom', '-12px');
                $('.comment[data-comment-id="' + message_id + '"] .comment_buttons').css('opacity', '1');
                $('.comment[data-comment-id="' + message_id + '"] .comment_button_edit,.comment[data-comment-id="' + message_id + '"] .comment_button_delete').hide();
                $('.comment[data-comment-id="' + message_id + '"] .comment_button_cancel').click(function () {
                    $('#edit_message_' + message_id).remove();
                    $('.comment[data-comment-id="' + message_id + '"] *').attr('style', '');
                });
            }
        });
    },
    addEvent_ButtonSaveMessage: () => {
        $('.comment_button_save').click(function (event) {
            event.preventDefault();
            var comment_id = $(this).attr('data-comment-id');            
            var comment_edit_textarea = $('#edit_message_' + comment_id + ' textarea');            
            var text = $(comment_edit_textarea).val(); 
            var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
            var product_id = $('.panel_product_comments').attr('data-product-id'); 
            if (product_id > 0 && current_user_login_md5 != '' && comment_id > 0 && text != '') {
                $.ajax({
                    data: {
                        'action': 'update_message', 
                        'product_id': product_id, 
                        'current_user_login_md5': current_user_login_md5,
                        'comment_id' : comment_id,
                        'text' : text,  
                    },
                    type: "post",
                    url: "/orders/functions/ajax_product_comments.php",
                    success:
                            function(data){
                                var res = JSON.parse(data);
                                if (res.status){
                                    $('div[data-comment-id="'+comment_id+'"] .comment_text').html(text); 
                                    $('#edit_message_' + comment_id).remove();
                                    $('.comment[data-comment-id="' + comment_id + '"] *').attr('style', '');
                                }
                            }
                }
                );
            }
            
            
        });

    }
};
var order_comments = {
    refreshLastComment: (order_id,last_comment_short,last_comment_long) => {
        let el = $('[data-order-id="'+order_id+'"].last-comment');
        $(el).attr('title',last_comment_long);
        $(el).html(last_comment_short);
    },
    addEvent_ButtonDeleteMessage: () => {
        $('.comment_button_delete').click(function (event) {
            event.preventDefault();
            if (confirm("Удалить сообщение?")) {
                var message_id = $(this).attr('data-comment-id');
                var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
                var order_id = $('.panel_product_comments').attr('data-order-id');
                console.log("order_id ",order_id);

                if (message_id > 0 && current_user_login_md5 != '' && order_id > 0) {
                    $.ajax({
                            data: {
                                'action': 'delete_message',
                                'order_id': order_id,
                                'message_id': message_id,
                                'current_user_login_md5': current_user_login_md5},
                            type: "post",
                            url: "/orders/functions/ajax_order_comments.php",
                            success:
                                function (data) {
                                    var res = JSON.parse(data);
                                    if (res.status == 1) {
                                        refreshOrderCommentsMessages();
                                    }
                                }
                        }
                    );
                }
            }

        });
    },
    addEvent_ButtonEditMessage: () => {
        $('.comment_button_edit').click(function (event) {
            var message_id = $(this).attr('data-comment-id');
            var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
            var order_id = $('.panel_product_comments').attr('data-order-id');

            if (message_id > 0 && current_user_login_md5 != '' && order_id > 0) {
                var comment_div = $(this).parent().parent();
                var comment_text_div = $(this).parent().parent().children('.comment_text');
                $(comment_div).append('<div id = "edit_message_' + message_id + '"><textarea rows="3" cols="70" name="edit_message"></textarea></div>');
                $("#edit_message_" + message_id + " textarea").val($(comment_text_div).html());
                $('.comment[data-comment-id="' + message_id + '"] .comment_buttons,.comment[data-comment-id="' + message_id + '"] .comment_button_save,.comment[data-comment-id="' + message_id + '"] .comment_button_cancel').show();
                $('.comment[data-comment-id="' + message_id + '"] .comment_buttons').css('display', 'inline-block');
                $('.comment[data-comment-id="' + message_id + '"] .comment_buttons').css('bottom', '-12px');
                $('.comment[data-comment-id="' + message_id + '"] .comment_buttons').css('opacity', '1');
                $('.comment[data-comment-id="' + message_id + '"] .comment_button_edit,.comment[data-comment-id="' + message_id + '"] .comment_button_delete').hide();
                $('.comment[data-comment-id="' + message_id + '"] .comment_button_cancel').click(function () {
                    $('#edit_message_' + message_id).remove();
                    $('.comment[data-comment-id="' + message_id + '"] *').attr('style', '');
                });
            }
        });
    },
    addEvent_ButtonSaveMessage: () => {
        $('.comment_button_save').click(function (event) {
            event.preventDefault();
            var comment_id = $(this).attr('data-comment-id');
            var comment_edit_textarea = $('#edit_message_' + comment_id + ' textarea');
            var text = $(comment_edit_textarea).val();
            var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
            var order_id = $('.panel_product_comments').attr('data-order-id');
            if (current_user_login_md5 != '' && order_id > 0 && text != '') {
                $.ajax({
                        data: {
                            'action': 'update_message',
                            'order_id': order_id,
                            'current_user_login_md5': current_user_login_md5,
                            'comment_id' : comment_id,
                            'text' : text,
                        },
                        type: "post",
                        url: "/orders/functions/ajax_order_comments.php",
                        success:
                            function(data){
                                var res = JSON.parse(data);
                                if (res.status){
                                    $('div[data-comment-id="'+comment_id+'"] .comment_text').html(text);
                                    $('#edit_message_' + comment_id).remove();
                                    $('.comment[data-comment-id="' + comment_id + '"] *').attr('style', '');
                                }
                            }
                    }
                );
            }


        });

    },
    order_comments: function order_comments(button) {
    var order_id = $(button).attr('data-order-id');
    var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
    if (order_id > 0) {
        $.ajax({
                data: {'action': 'get_comments', 'order_id': order_id, 'current_user_login_md5': current_user_login_md5},
                type: "post",
                url: "/orders/functions/ajax_order_comments.php",
                success:
                onAjaxSuccess_order_comments
            }
        );
    }
}
};


function product_comments(event) {
    if((typeof(event)== 'object')){event.preventDefault();}
    var product_id = $(this).parent().parent(".edit_row").attr('data-id');
    var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
    if (product_id > 0) {
        $.ajax({
                data: {'action': 'get_comments', 'product_id': product_id, 'current_user_login_md5': current_user_login_md5},
                type: "post",
                url: "/orders/functions/ajax_product_comments.php",
                success:
                onAjaxSuccess_product_comments
            }
        );
    }
}

function onAjaxSuccess_order_comments(data) {
    var res = JSON.parse(data);

    if (res.status == 1) {
        $('#ajax_result_popup_panel2').html(res.buffer);
        $('#ajax_result_popup_panel2').append('<span class="ajax_result_popup_panel_fancybox_close_button">xxx</span>');
        order_comments.addEvent_ButtonEditMessage();
        order_comments.addEvent_ButtonDeleteMessage();
        order_comments.addEvent_ButtonSaveMessage();

//        $('#ajax_result_popup_panel .ajax_result_popup_panel_fancybox_close_button').click(
//                function (event) {
//                    event.preventDefault();
//                    $.fancybox.close();
//                }
//        );

    }

    setTimeout(function () {
        panel_product_comments_height = $('#ajax_result_popup_panel2 .panel_product_comments').height();
        window_height = $(window).height() - 100;

        if (panel_product_comments_height > window_height) {
            $('#ajax_result_popup_panel2 .panel_product_comments').height(window_height);
        }
        //$("body").scrollTop($("#panel_product_comments_footer").offset().bottom );
        $(".panel_product_comments").scrollTop($(".panel_product_comments_inner").height());
    }, 100);

    $("#order_form_send_message").on('submit', function (e) {
        e.preventDefault();
        let m_data = $(this).serialize();
        let form = $(this);
        $.ajax({
            type: 'post',
            url: '/orders/functions/ajax_order_comments.php',
            data: m_data,
            success: (result_data)=>{
                refreshOrderCommentsMessages();
                let data = JSON.parse(result_data);
                order_comments.refreshLastComment(data.order_id, data.last_comment_short, data.$last_comment_long);
            },
        });
    });
    $("#form_send_message").on('submit', function (e) {
        e.preventDefault();
        var m_data = $(this).serialize();
        $.ajax({
            type: 'post',
            url: '/orders/functions/ajax_product_comments.php',
            data: m_data,
            success: ajax_Result_Send_message,
        });
    });


    $("#ajax_result_popup_panel2").fancybox({modal: true, scrolling: 'auto', autoScale: true}).trigger('click');
    /*$('.fancybox-container').click(
     function (event) {
     //event.preventDefault();
     $.fancybox.close();
     }
     );*/

    $(".form_send_message_submit_button").click(function () {
        $("#form_send_message").submit();
    });
    $(".order_form_send_message_submit_button").click(function () {
        $(this).attr('disabled','disabled');
        $("#order_form_send_message").submit();
    });


    //$.fancybox.open($('#ajax_result_popup_panel2').html());

    /*
     var data = {};
     data.user_id = "user_iduser_iduser_id";
     data.system_id = "system_idsystem_idsystem_id";
     $.fancybox.open({
     type: "iframe",
     src: "/orders/functions/iframe_product_comments.php",
     ajax: {
     settings: {
     dataType: "html",
     type: "POST",
     data: {
     action: "get_comments",
     product_id: "1"
     }
     }
     }
     }); */
    /*
     $.fancybox.open({
     //src: '#ajax_result_popup_panel2',
     src: '/orders/functions/iframe_product_comments.php',
     type: 'iframe',
     data: "1111",
     modal: true,
     opts: {
     modal: true,
     onComplete: function () {
     console.info('done!');
     }
     }
     });*/
}
function onAjaxSuccess_product_comments(data) {
    var res = JSON.parse(data);
    if (res.status == 1) {
        $('#ajax_result_popup_panel2').html(res.buffer);
        $('#ajax_result_popup_panel2').append('<span class="ajax_result_popup_panel_fancybox_close_button">xxx</span>');
        comments.addEvent_ButtonEditMessage();
        comments.addEvent_ButtonDeleteMessage();
        comments.addEvent_ButtonSaveMessage();        

//        $('#ajax_result_popup_panel2 .ajax_result_popup_panel_fancybox_close_button').click(
//                function (event) {
//                    event.preventDefault();
//                    $.fancybox.close();
//                }
//        );

    }

    setTimeout(function () {
        panel_product_comments_height = $('#ajax_result_popup_panel2 .panel_product_comments').height();
        window_height = $(window).height() - 100;

        if (panel_product_comments_height > window_height) {
            $('#ajax_result_popup_panel2 .panel_product_comments').height(window_height);
        }
        //$("body").scrollTop($("#panel_product_comments_footer").offset().top);
        $(".panel_product_comments").scrollTop($(".panel_product_comments_inner").height());
    }, 100);

    $("#form_send_message").on('submit', function (e) {
        e.preventDefault();
        var m_data = $(this).serialize();
        $.ajax({
            type: 'post',
            url: '/orders/functions/ajax_product_comments.php',
            data: m_data,
            success: ajax_Result_Send_message,
        });
    });


    $("#ajax_result_popup_panel2").fancybox({modal: true, scrolling: 'auto', autoScale: true}).trigger('click');
    /*$('.fancybox-container').click(
     function (event) {                    
     //event.preventDefault();
     $.fancybox.close();
     }
     );*/

    $(".form_send_message_submit_button").click(function () {
        $("#form_send_message").submit();

    });
    //$.fancybox.open($('#ajax_result_popup_panel2').html());

    /*    
     var data = {};
     data.user_id = "user_iduser_iduser_id";
     data.system_id = "system_idsystem_idsystem_id";       
     $.fancybox.open({
     type: "iframe",
     src: "/orders/functions/iframe_product_comments.php",
     ajax: {
     settings: {
     dataType: "html",
     type: "POST",
     data: {
     action: "get_comments",
     product_id: "1"
     }
     }
     }
     }); */
    /*   
     $.fancybox.open({
     //src: '#ajax_result_popup_panel2',
     src: '/orders/functions/iframe_product_comments.php',
     type: 'iframe',
     data: "1111",
     modal: true,
     opts: {
     modal: true,
     onComplete: function () {
     console.info('done!');
     }
     }
     });*/
}


function ajax_Result_Send_message(data) {
    console.log("ajax_Result_Send_message");
    refreshCommentsMessages();
}


function refreshOrderCommentsMessages() {
    var order_id = $('.panel_product_comments').attr('data-order-id');
    var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
    if (order_id > 0) {
        $.ajax({
                data: {'action': 'get_comments', 'order_id': order_id, 'current_user_login_md5': current_user_login_md5},
                type: "post",
                url: "/orders/functions/ajax_order_comments.php",
                success:
                    function (data) {
                        var res = JSON.parse(data);
                        if (res.status == 1) {
                            var messages = res.buffer.split('<!--messages-->')[1];
                            $('.panel_order_comments_messages').html(messages);
                            order_comments.addEvent_ButtonEditMessage();
                            order_comments.addEvent_ButtonDeleteMessage();
                            order_comments.addEvent_ButtonSaveMessage();
                            $('#order_form_send_message textarea[name="message"]').val('');
                            $('.order_form_send_message_submit_button').prop('disabled',false);
                            setTimeout(function () {
                                $(".panel_product_comments").scrollTop($(".panel_product_comments_inner").height());
                            }, 100);

                        }

                    }
            }
        );
    }
}
function refreshCommentsMessages() {
    var product_id = $('.panel_product_comments').attr('data-product-id');
    var current_user_login_md5 = $('#login_panel .current_user').attr('data-user-code');
    if (product_id > 0) {
        $.ajax({
            data: {'action': 'get_comments', 'product_id': product_id, 'current_user_login_md5': current_user_login_md5},
            type: "post",
            url: "/orders/functions/ajax_product_comments.php",
            success:
                    function (data) {
                        var res = JSON.parse(data);
                        if (res.status == 1) {
                            var messages = res.buffer.split('<!--messages-->')[1];
                            $('.panel_product_comments_messages').html(messages);
                            comments.addEvent_ButtonEditMessage();
                            comments.addEvent_ButtonDeleteMessage();
                            comments.addEvent_ButtonSaveMessage();
                            $('#form_send_message textarea[name="message"]').val('');

                            setTimeout(function () {
                                //$("body").scrollTop($("#panel_product_comments_footer").offset().top)
                                $(".panel_product_comments").scrollTop($(".panel_product_comments_inner").height());
                            }, 100);

                        }

                    }
        }
        );
    }
}

