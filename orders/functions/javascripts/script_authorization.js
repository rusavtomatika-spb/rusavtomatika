function checkAuth() {
    if ($.cookie('login') == null) {
        $.post(
                "/orders/functions/ajax_authorization.php",
                {
                    action: "start_login",
                },
                onAjaxSuccess_do_login
                );
    } else {
        checkUser($.cookie('login'));
    }

    function checkUser(login_md5) {
        $.ajax({
            data: {'action': 'check_user', 'login_md5': login_md5},
            type: "post",
            url: "/orders/functions/ajax_authorization.php",
            success: function (data) {
                var res = JSON.parse(data);
                $('#login_panel').html(res.buffer);
                log_out_event();
                $("#login_panel").change();
            }
        });
    }

}

function log_out_event() {
    $('.user_logout').unbind('click');
    $('.user_logout').click(function () {
        $.removeCookie('login', {path: '/'});
        location.reload();
    });
}

function try_again_event() {
    $('.user_try_again').unbind('click');
    $('.user_try_again').click(function () {
        $.removeCookie('login', {path: '/'});
        checkAuth();
    });
}

function onAjaxSuccess_do_login(data) {
    var res = JSON.parse(data);
    if (res.status == 1) {
        $('#login_panel').html(res.buffer);
        log_out_event();

        $('#form_do_login').submit(function (e) {
            e.preventDefault();
            var m_data = $(this).serialize();
            $.ajax({
                type: 'post',
                url: '/orders/functions/ajax_authorization.php',
                data: m_data,
                success: function (data) {
                    var res = JSON.parse(data);
                    if (res.status == 1) {
                        $('#login_panel').html(res.buffer);
                        log_out_event();
                        var data_user_code = $('.current_user').attr('data-user-code');
                        if (data_user_code != "") {
                            $.cookie('login', data_user_code, {expires: 365, path: '/'});
                            $("#login_panel").change();
                        }

                    } else if (res.status == 3) {
                        $('#login_panel').html(res.buffer);
                        try_again_event();
                    } else {
                        $('#login_panel').html('<span class="message_red">Что-то пошло не так!</span>');
                    }
                }
            });
        });



    } else {
        $('#login_panel').html('Auth failed');
    }
}