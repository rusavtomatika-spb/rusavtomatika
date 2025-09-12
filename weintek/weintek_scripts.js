var getUrlParameter = function getUrlParameter(sParam) {
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

$(function () {
    $("#tabs").tabs();
});


$(document).ready(function () {
    var current_tab = getUrlParameter('tab');
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


    var urlbase = '$CANONICAL';
    //$uuu
    $('.urlup').click(function () {
        var dat = $(this).attr('data');
        var nnew = 'https://' + location.hostname + window.location.pathname + '?tab=' + dat;

        if (nnew != window.location) {
            window.history.pushState(null, null, nnew);
        }

    });

});

function doclick(e) {

    $('a[href=#' + e + ']').click();

}
