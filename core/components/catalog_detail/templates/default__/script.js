$(document).ready(function () {

    add_product_to_box_viewed();

    const current_tab = getUrlParameter('tab');
    if (current_tab != '') {
        switch (current_tab) {
            case 'accessories':
                $('a[href="#tabs-5"]').click();
                break;
            case 'functions':
                $('a[href="#tabs-1"]').click();
                break;
            case 'software':
                $('a[href="#tabs-4"]').click();
                break;
            case 'dimensions':
                $('a[href="#tabs-2"]').click();
                break;
            case 'scheme':
                $('a[href="#tabs-3"]').click();
                break;
        }
    }


    $('.urlup').click(function () {
        const dat = $(this).attr('data');
        var nnew = 'https://' + location.hostname + window.location.pathname + '?tab=' + dat;
        if (nnew != window.location) {
            window.history.pushState(null, null, nnew);
        }
    });




    function add_product_to_box_viewed() {
        let current_model = '';
        current_model = $('#vue_component_catalog_detail').attr("data-model");

        if(current_model != undefined && current_model != ''){
            let box_viewed = '';
            let arr_box_viewed = [];
            box_viewed = getCookie('box_viewed');
            if (box_viewed !== undefined) {
                if (box_viewed[0] == ',') {
                    box_viewed = box_viewed.substring(1);
                }
                arr_box_viewed = box_viewed.split(",");
                if (arr_box_viewed.length > 0) {
                    if (arr_box_viewed.indexOf(current_model) === -1) {
                        arr_box_viewed.push(current_model);
                        save_param_to_cookie('box_viewed', arr_box_viewed.join(','));

                    }
                }
            }else{
                save_param_to_cookie('box_viewed', current_model);
            }
        }

    }



    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function save_param_to_cookie(param, value) {
        let date = new Date;
        date.setDate(date.getDate() + 365);
        date = date.toUTCString();
        setCookie(param, value, {'expires': date});
    }

    function setCookie(name, value, options = {}) {

        // Пример использования:
        //setCookie('user', 'John', {secure: true, 'max-age': 3600});
        options = {
            path: '/',
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
    }



});

var getUrlParameter = function (sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};