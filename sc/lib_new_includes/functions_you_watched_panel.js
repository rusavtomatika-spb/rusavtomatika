$(function () {
    $('.ListOfWatchedProducts_title').click(
        function () {
            $(this).parent().toggleClass('closed');
            if ($(this).parent().is('.closed')) {
                $.cookie('listOfWatchedProducts_panel', 'closed', {SameSite: 'Strict',Secure: true});
            } else {
                $.cookie('listOfWatchedProducts_panel', null, {SameSite: 'Strict',Secure: true});
            }
        }
    );
    $('.ListOfWatchedProducts_clear_button').click(
        function () {
            var date = new Date();
            date.setTime(date.getTime() + 31622400);
            $.cookie('listOfWatchedProducts', null, { expires: -1, path: '/', SameSite: 'Strict',Secure: true});
            $.cookie('listOfWatchedProducts_panel', 'closed',{ expires: -1, path: '/', SameSite: 'Strict',Secure: true });
            $('.ListOfWatchedProducts').remove();
        }
    );
        $('.button_delete_from_list').click(
            function () {
                product = $(this).attr('data-rel');
                position = $(this).attr('data-position');
                listOfWatchedProducts = $.cookie('listOfWatchedProducts');
                arrProducts = listOfWatchedProducts.split(",");
                //alert(arrProducts.indexOf( product ));
                item = $(this).parent();
                if ($(item).hasClass("to_delete")) {
                    $(item).removeClass("to_delete");
                    arrProducts[position] = product;
                    newCookie = arrProducts.join(',');
                    var date = new Date();
                    date.setTime(date.getTime() + 31622400);
                    $.cookie('listOfWatchedProducts', newCookie, {expires: date, path: '/'});
                } else {
                    $(item).addClass("to_delete");
                    key = arrProducts.indexOf(product);
                    if (key >= 0) {
                        arrProducts[key] = '';
                        newCookie = arrProducts.join(',');
                        var date = new Date();
                        date.setTime(date.getTime() + 31622400);
                        $.cookie('listOfWatchedProducts', newCookie, {expires: date, path: '/'});
                    }

                }
            }
        );
        if ($.cookie('listOfWatchedProducts_panel') === 'closed') {
            $('.ListOfWatchedProducts').addClass('closed');
        } else {
            $('.ListOfWatchedProducts').removeClass('closed');
        }
    }
);

