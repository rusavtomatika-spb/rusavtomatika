checkk = false;
pag = 0;

function monitor() {


    if (($("#type0.active").size() == 0) && ($("#type1.active").size() == 0) && ($("#type3.active").size() == 0)) {

        if (($("#type2.active").size() == 0)) {

            $("#di").css("opacity", "1");
            $('#number').empty();
            $('input[name="resolution"]').parent('label').css("opacity", "1");
            $($("#other")).css("opacity", "0.5");
//$($(".temp")).remove();
            $('#ebp').parent('label').css("opacity", "1");
            $('#eb8').parent('label').css("opacity", "1");
            $('#skw').parent('label').css("opacity", "1");
            $('input[name="core"]').parent('label').css("opacity", "1");
        } else {
            $($("#other")).css("opacity", "1");
            $("#di").css("opacity", "0.5");
            $("#di").prop("title", "Встраиваемые компьютеры не имеют дисплея");
            $('input[name="resolution"]').parent('label').css("opacity", "0.5");
            $('input#resolution12').parent('label').css("opacity", "1");
            $('#ebp').parent('label').css("opacity", "0.5");
            $('#eb8').parent('label').css("opacity", "0.5");
            $('#skw').parent('label').css("opacity", "0.5");
            $('input[name="core"]').parent('label').css("opacity", "0.5");
            $('input[value="2800"]').parent('label').css("opacity", "1");
            $('input[value="2600"]').parent('label').css("opacity", "1");
        }
        ;
    } else {
        $("#di").css("opacity", "1");
        $("#di").prop("title", "");
        $($("#other")).css("opacity", "1");
        $('input[name="resolution"]').parent('label').css("opacity", "1");
        $('#ebp').parent('label').css("opacity", "1");
        $('#eb8').parent('label').css("opacity", "1");
        $('#skw').parent('label').css("opacity", "1");
        $('input[name="core"]').parent('label').css("opacity", "1");
    }
    ;


}

var block = 0;


function sl3() {

    var min_width = $('#min-width').val();
    var max_width = $('#max-width').val();

    $("#slider-range2").slider({
        range: true,
        min: 80,
        max: 545,
        values: [min_width, max_width],
        slide: function (event, ui) {
            $("#width").html(ui.values[0] + " мм" + " - " + ui.values[1] + " мм");
            $("#min-width").val(ui.values[0]);
            $("#max-width").val(ui.values[1]);
            if (block != 1) {
                block = 1;
                setTimeout(function () {

//monitor();
                    advance(0, 'width');
                }, 800);
            } else {
                readv = 'width';
            }
            ;
        }
    });
    $("#width").html($("#slider-range2").slider("values", 0) + " мм" +
        " - " + $("#slider-range2").slider("values", 1) + " мм");

}


function sl4() {
    var min_height = $('#min-height').val();
    var max_height = $('#max-height').val();
    $("#slider-range3").slider({
        range: true,
        min: 89,
        max: 377,
        values: [min_height, max_height],
        slide: function (event, ui) {
            $("#height").html(ui.values[0] + " мм" + " - " + ui.values[1] + " мм");
            $("#min-height").val(ui.values[0]);
            $("#max-height").val(ui.values[1]);
            if (block != 1) {
                block = 1;
                setTimeout(function () {

//monitor();
                    advance(0, 'height');
                }, 800);
            } else {
                readv = 'height';
            }
            ;
        }
    });
    $("#height").html($("#slider-range3").slider("values", 0) + " мм" +
        " - " + $("#slider-range3").slider("values", 1) + " мм");

}


function sl5() {

    var min_thickness = $('#min-thickness').val();
    var max_thickness = $('#max-thickness').val();
    $("#slider-range4").slider({
        range: true,
        min: 27,
        max: 138,
        values: [min_thickness, max_thickness],
        slide: function (event, ui) {
            $("#thickness").html(ui.values[0] + " мм" + " - " + ui.values[1] + " мм");
            $("#min-thickness").val(ui.values[0]);
            $("#max-thickness").val(ui.values[1]);
            if (block != 1) {
                block = 1;
                setTimeout(function () {

//monitor();
                    advance(0, 'thickness');
                }, 800);
            } else {
                readv = 'thickness';
            }
            ;
        }
    });
    $("#thickness").html($("#slider-range4").slider("values", 0) + " мм" +
        " - " + $("#slider-range4").slider("values", 1) + " мм");

}


function implode(glue, pieces) {  // Join array elements with a string
    return ((pieces instanceof Array) ? pieces.join(glue) : pieces);
}


function advance(full, position) {
    block = 1;
    readv = '';
    var hei = $('#filter').innerHeight();
// alert(hei);
    $('#lock').height(hei);
    $('body').css('cursor', 'progress');
    $('input').css('cursor', 'progress');
    $('label').css('cursor', 'progress');
    $('.galochka').css('cursor', 'progress');
    $('.caption').css('cursor', 'progress');
    $('.page').css('cursor', 'progress');

    var min_price = $('#min-price').val();
    var max_price = $('#max-price').val();

    var min_diagonal = $('#min-diagonal').val();
    var max_diagonal = $('#max-diagonal').val();


    var res = $('input[name="resolution"]').size();
    var res_ch = $('input[name="resolution"]:checked').size();
    var re = '';
    var rei = 0;
    if ((0 < res_ch) && (res_ch < res)) {
//var resolution = [];
        for (i = 0; i < res; i++) {
            checkk = $('input[name="resolution"]').eq(i).prop("checked");
            if (checkk == true) {
                resolution[i] = $('input[name="resolution"]').eq(i).val();
                if (rei == 0) {
                    re = re + "" + resolution[i] + "";
                } else {
                    re = re + "," + resolution[i] + "";
                }
                ;
                rei++;
            }
            ;
        }
        ;

        if (rei == 0) {
            re = '';
        }
        ;
    } else {
        var re = '';
    }
    ;


    var bra = $('input[name="brand"]').size();
    var bra_ch = $('input[name="brand"]:checked').size();
    var br = '';
    rei = 0;
    if ((0 < bra_ch) && (bra_ch < bra)) {
//var brand = [];
        for (i = 0; i < bra; i++) {
            checkk = $('input[name="brand"]').eq(i).prop("checked");
            if (checkk == true) {
                brand[i] = $('input[name="brand"]').eq(i).val();
                if (rei == 0) {
                    br = br + "'" + brand[i] + "'";
                } else {
                    br = br + ",'" + brand[i] + "'";
                }
                ;
                rei++;
            }
            ;
        }
        ;

        if (rei == 0) {
            br = '';
        }
        ;
    } else {
        var br = '';
    }
    ;


    var usb = $('#usb:checked').size();
    var usb_number = $('#usb-number').val();
    var com = $('#com:checked').size();
    var com_number = $('#com-number').val();
    var com_485 = $('#com-485').val();
    var ethernet = $('#ethernet:checked').size();
    var ethernet_number = $('#ethernet-number').val();
    var sd = $('#sd:checked').size();
    var audio = $('#audio:checked').size();
    var speakers = $('#speakers:checked').size();
    var linear_out = $('#linear_out:checked').size();
    var hdmi_audio = $('#hdmi_audio:checked').size();
    var mic_in = $('#mic_in:checked').size();
    var pc2 = $('#pc2:checked').size();
    var vga = $('#vga:checked').size();
    var dvi = $('#dvi:checked').size();

    var usbcam = $('#usbcam:checked').size();
    var ntsc = $('#ntsc:checked').size();

    var ebp = $('#ebp:checked').size();
    var eb8 = $('#eb8:checked').size();
    var skw = $('#skw:checked').size();
    var w7 = $('#w7:checked').size();
    var w8 = $('#w8:checked').size();
    var wxp = $('#wxp:checked').size();
    var wce = $('#wce:checked').size();
    if (wce + wxp + w7 + w8 + eb8 + ebp + skw == 7) {
        wce = '';
        wxp = '';
        w7 = '';
        w8 = '';
        eb8 = '';
        ebp = '';
        skw = '';
    }
    ;

    var hdd = $('#hdd:checked').size();
//var hdd_size = $('#hdd-size').val();
//var ssd = $('#ssd:checked').size();
//var ssd_size = $('#ssd-size').val();
    var ddr3 = $('#ddr3:checked').size();
    var ddr3_size = $('#ddr3-size').val();

    rei = 0;
    res = $('input[name="core"]').size();
    res_ch = $('input[name="core"]:checked').size();
    if (0 < res_ch < res) {

        var cores = [];
        for (i = 0; i < res; i++) {
            checkk = $('input[name="core"]').eq(i).prop("checked");
            if (checkk == true) {
                cores[rei] = $('input[name="core"]').eq(i).val();
                rei++;
            }
        }
        ;
        var core = implode(",", cores);
    } else {
        var core = '';
    }
    ;

    var min_width = $('#min-width').val();
    var max_width = $('#max-width').val();
    var min_height = $('#min-height').val();
    var max_height = $('#max-height').val();
    var min_thickness = $('#min-thickness').val();
    var max_thickness = $('#max-thickness').val();


    var b = '';
    var bases = 0;
    res = $('input.base').size();

    for (i = 0; i < res; i++) {
        if ($('input.base').eq(i).prop("checked") == true) {
            bases++;
            b = b + i;
        }
        ;
    }


    reset_diagonals = b.search(/[2456]/);
    if (reset_diagonals > 0) {
        min_diagonal = '';
        max_diagonal = '';
    }


    var au = 'wk';

    var cool = $('#cool:checked').size();
    var temp_min_minus_10 = $('#temp_min_minus_10:checked').size();
    var temp_min_minus_20 = $('#temp_min_minus_20:checked').size();
    var temp_min_minus_40 = $('#temp_min_minus_40:checked').size();
    var vesa75 = $('#vesa75:checked').size();
    var vesa100 = $('#vesa100:checked').size();
    var panel_mount = $('#panel_mount:checked').size();
    var din = $('#din:checked').size();
    var case1 = $('#case1:checked').size();
    var case2 = $('#case2:checked').size();
    var ip65 = $('#ip65:checked').size();

//var spb = $('#spb:checked').size();
//var kiv = $('#kiv:checked').size();
//var msk = $('#msk:checked').size();

    var slock = $('#slock:checked').size();

    var diagonals = $('#diagonals:checked').size();

    var resistive = $('#resistive:checked').size();
    var capacitive = $('#capacitive:checked').size();
    var pci = $('#pci:checked').size();
    var mpci = $('#mpci:checked').size();
    var sim = $('#sim:checked').size();

//alert("types="+b+"&min_price="+min_price+"&max_price="+max_price+"&min_diagonal="+min_diagonal+"&max_diagonal="+max_diagonal+"&resolution="+re+"&usb="+usb+"&usb_number="+usb_number+"&com="+com+"&com_number="+com_number+"&ethernet="+ethernet+"&ethernet_number="+ethernet_number+"&sd="+sd+"&audio="+audio+"&mic="+mic+"&pc2="+pc2+"&vga="+vga+"&dvi="+dvi+"&ebp="+ebp+"&eb8="+eb8+"&w7="+w7+"&wxp="+wxp+"&wce="+wce+"&hdd="+hdd+"&hdd_size="+hdd_size+"&ssd="+ssd+"&ssd_size="+ssd_size+"&ddr3="+ddr3+"&ddr3_size="+ddr3_size+"&flash="+flash+"&flash_size="+flash_size+"&cores="+core+"&min_width="+min_width+"&max_width="+max_width+"&min_height="+min_height+"&max_height="+max_height+"&min_thickness="+min_thickness+"&max_thickness="+max_thickness+"&full="+full+"&ua="+au+"&cool="+cool+"&vesa75="+vesa75+"&vesa100="+vesa100+"&din="+din+"&case1="+case1+"&case2="+case2+"&ip65="+ip65);

    var all = "types=" + b + "&min_price=" + min_price + "&max_price=" + max_price
        + "&min_diagonal=" + min_diagonal + "&max_diagonal=" + max_diagonal
        + "&resolution=" + re + "&usb=" + usb + "&brand=" + br + "&usb_number="
        + usb_number + "&com=" + com + "&com_number=" + com_number + "&com_485="
        + com_485 + "&ethernet=" + ethernet + "&ethernet_number=" + ethernet_number
        + "&sd=" + sd + "&audio=" + audio + "&speakers=" + speakers
        + "&linear_out=" + linear_out
        + "&hdmi_audio=" + hdmi_audio
        + "&mic_in=" + mic_in + "&pc2=" + pc2 + "&vga=" + vga + "&dvi="
        + dvi + "&ntsc=" + ntsc + "&usbcam=" + usbcam + "&ebp=" + ebp + "&eb8=" + eb8 + "&skw=" + skw + "&w7=" + w7 + "&w8=" + w8 + "&wxp=" + wxp + "&wce=" + wce + "&hdd=" + hdd + "&ddr3=" + ddr3 + "&ddr3_size=" + ddr3_size + "&cores=" + core + "&min_width=" + min_width + "&max_width=" + max_width + "&min_height=" + min_height + "&max_height=" + max_height + "&min_thickness=" + min_thickness + "&max_thickness=" + max_thickness + "&full=" + full + "&au=" + au + "&temp_min_minus_10=" + temp_min_minus_10 + "&temp_min_minus_20=" + temp_min_minus_20 + "&temp_min_minus_40=" + temp_min_minus_40 + "&cool=" + cool + "&vesa75=" + vesa75 + "&vesa100=" + vesa100 + "&panel_mount=" + panel_mount + "&din=" + din + "&case1=" + case1 + "&case2=" + case2 + "&ip65=" + ip65 + "&page=" + pag + "&capacitive=" + capacitive + "&resistive=" + resistive + "&pci=" + pci + "&mpci=" + mpci + "&sim=" + sim + "&slock=" + slock + "&diagonals=" + diagonals;

    var encoded = $.toJSON(all);
    var formData = encoded;
    cookieExp = new Date();                       // создаем объект Date
    cookieExp.setMonth(cookieExp.getMonth() + 12);   // устанавливаем текущий месяц и к нему добавляем еще один год

    document.cookie = 'podbor=' + formData + '; expires=' + cookieExp.toGMTString() + '; path=/;';
//alert(bases);


    $.ajax({
        type: "POST",
        url: "/ajax/advanced.php",
        data: all,
//	data: 'hello=Hello',
        // Выводим то что вернул PHP
        success: function (html) {
            //предварительно очищаем нужный элемент страницы
            if (full == 0) {
                if (readv == '') {
//$('#number').empty();
//$('#number').html(html);
                    if (html != '0') {
                        $showw = ' Показать ';
                        $slash = '<div>&nbsp;/&nbsp;</div>';
                        $cl = ' <div id="clear-button"> Очистить </div>';
                    } else {
                        $showw = '';
                        $slash = '';
                        $cl = ' <div id="clear-button" style="text-align: center;width: 100%;"> Очистить </div>';
                    }
                    ;

                    if ((position == '') || (position == -1)) {
                        $('.temp').stop(true);
                        $('.temp').remove();
                        $('#type').before('<div class="temp"><div>Выбрано моделей:</div><div id="number">' + html + '</div><br /><div id="full" onclick="advance(1,\'\')">' + $showw + '</div>' + $slash + '' + $cl + '</div>');
                    } else {
                        $('.temp').stop(true);
                        $('.temp').remove();

                        var lab = $('#' + position).parents('label').size();
                        var bo = $('#' + position).parents('.block-row').size();
                        if (lab > 0) {
                            $('#' + position).parents('label').before('<div class="temp"><div>Выбрано моделей:</div><div id="number">' + html + '</div> <div id="full" >' + $showw + '</div>' + $slash + '' + $cl + '</div>');
                        } else if (bo > 0) {
                            $('#' + position).parents('.block-row > div').before('<div class="temp"><div>Выбрано моделей:</div><div id="number">' + html + '</div><br /><div id="full" >' + $showw + '</div>' + $slash + '' + $cl + '</div>');
                        } else {
                            $('#' + position).before('<div class="temp"><div>Выбрано моделей:</div><div id="number">' + html + '</div><br /><div id="full" >' + $showw + '</div>' + $slash + '' + $cl + '</div>');
                        }
                        ;

                    }
                    ;
//$('.temp').show();
//setTimeout( function() {$('.temp').hide();}, 20000);

//$('.temp').fadeOut(clock);
                    $('.temp').animate({'opacity': '0'}, {duration: clock});
                    $('body').css('cursor', '');
                    $('input').css('cursor', '');
                    $('label').css('cursor', '');
                    $('.galochka').css('cursor', '');
                    $('.caption').css('cursor', '');
                    $('.page').css('cursor', '');
                    block = 0;
                    $('#lock').height('0');
                } else {
                    advance('0', readv);

                }
                ;
            } else {
                $('.temp').stop(true);
                $('.temp').remove();
                $('#param-result').empty();

                setTimeout(function () {
                    $('#param-result').html(html);


                    if ($("#new_h1_reset").length > 0) {

                        $("#h1_placeholder").replaceWith('<div id="h1_placeholder"><h1>Weintek, IFC, Aplex, Samkoon — расширенный поиск, подбор по параметрам</h1></div>');
                    } else {
                        if ($('#new_h1').length > 0) {
                            $('#h1_placeholder').replaceWith('<div id="h1_placeholder"><div class="advanced-search__title-h1">Подбор устройств по параметрам</div><div class="advanced-search__h1-wrapper"><div class="advanced-search__title-h2">Выбраны параметры:</div><h1>'
                                + $('#new_h1').html() + '</h1></div></div>');
                        }

                        //$('title').replaceWith('<title>Подбор устройств по параметрам ' + $('#new_h1').html() + '</title>');
                    }


                    /*                    if ($("#new_h1").length > 0) {

                     if ($(".advanced-search__h1-wrapper").length > 0) {
                     $(".advanced-search__title-h1").remove();
                     $(".advanced-search__h1-wrapper").replaceWith('<div class="advanced-search__h1-wrapper"><div class="advanced-search__title-h1">Подбор устройств по параметрам</div></div>');
                     $(".advanced-search__h1-wrapper").append('<h1>' + $('#new_h1').html() + '</h1>');
                     } else {
                     $('h1').html($('#new_h1').html());
                     }
                     } else {
                     if ($("#new_h1_reset").length > 0) {
                     $("#h1_placeholder").replaceWith('<h1>Weintek, IFC, Aplex, Samkoon — расширенный поиск, подбор по параметрам</h1>');


                     }*/


                    /*if ($("#new_title").length > 0) {
                     $('title').replaceWith($('#new_title').html());
                     }*/
                    bind_recalc_valute();
                    $('body').css('cursor', '');
                    $('input').css('cursor', '');
                    $('label').css('cursor', '');
                    $('.galochka').css('cursor', '');
                    $('.caption').css('cursor', '');
                    $('.page').css('cursor', '');
                    block = 0;
                    $('#lock').height('0');
//  old = window.location.href;

                    if ($('#bottom_href a').size() == 1) {
                        nnew = $('#bottom_href a').attr('href');
                    } else {
                        nnew = document.location.protocol + '//' + document.location.host + document.location.pathname;
                    }
                    //nnew = document.location.protocol + '//' + document.location.host + document.location.pathname;
                    // alert (nnew);
                    if (nnew != window.location) {
                        changeTitles(all);
//                        window.history.pushState(null, null, nnew);
                        history.pushState(null, null, nnew);
                    }
                }, 200);
                $('body,html').animate({
                    scrollTop: 93
                }, 300);

            }
            ;
//и выводим ответ php скрипта


        },
        error:
            function (html) {
                //предварительно очищаем нужный элемент страницы
                $('#er-message').show();
                $('#er-message').html(html);
                setTimeout(function () {
                    $('#er-message').html('');
                    $('#er-message').hide();
                }, 12000);
//и выводим ответ php скрипта
                $('body').css('cursor', 'auto');
                $('input').css('cursor', 'auto');
                $('label').css('cursor', 'auto');
                block = 0;
                $('#lock').height('0');
            }
    });


}

function changeTitles(url_params) {

    var params = new URLSearchParams(url_params);
    var new_title = "";
    var new_h1 = "";
    interfaces = "";
    os = "";
    hdd = diagonals = ddr3 = "";
    cores = size = cool = temp_min_minus_10 = temp_min_minus_20 = temp_min_minus_40 = vesa = material = "";

    for (var pair of params.entries()) {
        switch (pair[0]) {
            case 'brand':
                brands = pair[1];
                brands = brands.replace(/'/g, '');
                brands = brands.replace(/,/g, ', ');
                //brands = brands.split(",");

                break;
            case 'types':
                types = pair[1];
                types = types.split("");
                var string_types = "";
                for (var type of types) {
                    switch (type) {
                        case '0':
                            string_types += "панель оператора, ";
                            break;
                        case '1':
                            string_types += "панельный компьютер, ";
                            break;
                        case '2':
                            string_types += "встраиваемый компьютер, ";
                            break;
                        case '3':
                            string_types += "промышленный монитор, ";
                            break;
                        case '4':
                            string_types += "облачный интефейс, ";
                            break;
                        case '5':
                            string_types += "шлюз данных, ";
                            break;
                        case '6':
                            string_types += "интефейс MACHINE-TV, ";
                            break;
                    }
                }
                string_types = string_types.substring(0, string_types.length - 2);

                break;
            case 'max_diagonal':
                max_diagonal = Number(pair[1]);
                break;
            case 'min_diagonal':
                min_diagonal = Number(pair[1]);
                break;
            case 'min_price':
                min_price = Number(pair[1]);
                break;
            case 'max_price':
                max_price = Number(pair[1]);
                break;
            case 'diagonals':
                if (Number(pair[1]) > 0)
                    diagonals = Number(pair[1]);
                break;
            case 'slock':
                slock = Number(pair[1]);
                break;
            case 'resistive':
                resistive = Number(pair[1]);
                break;
            case 'capacitive':
                capacitive = Number(pair[1]);
                break;
            case 'resolution':
                string_resolution = pair[1].replace(/,/g, ', ');
                break;

            case 'usb':
            case 'com':
            case 'ethernet':
            case 'vga':
            case 'dvi':
            case 'mic_in':
            case 'ntsc':
            case 'usbcam':
            case 'sd':
            case 'sim':
            case 'audio':
            case 'speakers':
            case 'linear_out':
            case 'hdmi_audio':
            case 'pc2':
            case 'mpci':
            case 'pci':
            case 'com_number':
            case 'com_485':
            case 'ethernet_number':
                if (pair[1] > 0)
                    interfaces = "Интерфейсы";
                break;
            case 'ebp':
            case 'eb8':
            case 'skw':
            case 'w8':
            case 'w7':
            case 'wxp':
            case 'wce':
                if (pair[1] > 0) {
                    os = "ПО / ОС";
                }
                break;
            case 'hdd':

                if (pair[1] > 0) {
                    hdd = "HDD / SSD";
                }

                break;
            case 'ddr3_size':
            case 'ddr3':
                if (pair[1] > 0) {
                    ddr3 = "Память (DDR3)";
                }
                break;
            case 'cores':
                if (pair[1]) {
                    cores = "Процессор: "+pair[1];
                }

                break;
            case 'min_width':
                if (pair[1] > 80) {
                    size = "Габариты";
                }
                break;
            case 'min_height':
                if (pair[1] > 89) {
                    size = "Габариты";
                }
                break;
            case 'min_thickness':
                if (pair[1] > 27) {
                    size = "Габариты";
                }
                break;
            case 'max_width':
                if (pair[1] > 0 && pair[1] < 545) {
                    size = "Габариты";
                }
                break;
            case 'max_height':
                if (pair[1] > 0 && pair[1] < 377) {
                    size = "Габариты";
                }
                break;
            case 'max_thickness':
                if (pair[1] > 0 && pair[1] < 138) {
                    size = "Габариты";
                }
                break;
            case 'cool':
                if (pair[1] > 0) {
                    cool = "Безвентиляторное охлаждение";
                }
                break;
            case 'temp_min_minus_10':
                if (pair[1] > 0) {
                    temp_min_minus_10 = "-10&deg;C";
                }
                break;
            case 'temp_min_minus_20':
                if (pair[1] > 0) {
                    temp_min_minus_20 = "-20&deg;C";
                }
                break;
            case 'temp_min_minus_40':
                console.log("pair",pair);

                if (pair[1] > 0) {
                    temp_min_minus_40 = "-40&deg;C";
                }
                break;

            case 'vesa75':
            case 'vesa100':
            case 'panel_mount':
            case 'din':
                if (pair[1] > 0) {
                    vesa = "Крепление";
                }
                break;
            case 'case1':
            case 'case2':
                if (pair[1] > 0) {
                    material = "Материал корпуса";
                }
                break;


            default:
                break;
        }
    }

    if (brands) {
        if (new_title != "") {
            new_title += ", ";
            new_title += brands;
        } else {
            new_title += brands;
        }
    }
    if (string_types) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += string_types;
        } else {
            new_title += string_types;
        }
    }
    if (min_diagonal) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "от " + min_diagonal + "&Prime;";
        } else {
            new_title += "от " + min_diagonal + "&Prime;";
        }
    }

    if (max_diagonal) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "до " + max_diagonal + "&Prime;";
        } else {
            new_title += "до " + max_diagonal + "&Prime;";
        }
    }
    if (min_price) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "от " + min_price + "$";
        } else {
            new_title += min_price;
        }
    }
    if (max_price) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "до " + max_price + "$";
        } else {
            new_title += max_price;
        }
    }
    if (diagonals) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "Без дисплея";
        } else {
            new_title += "Без дисплея";
        }
    }
    if (slock) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "Наличие на складе";
        } else {
            new_title += "Наличие на складе";
        }
    }
    if (resistive) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "Резистивный";
        } else {
            new_title += "Резистивный";
        }
    }
    if (capacitive) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "Емкостной (мультитач)";
        } else {
            new_title += "Емкостной (мультитач)";
        }
    }
    if (string_resolution) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += "Разрешение: " + string_resolution;
        } else {
            new_title += "Разрешение: " + string_resolution;
        }
    }
    if (interfaces) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += interfaces;
        } else {
            new_title += interfaces;
        }
    }
    if (os) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += os;
        } else {
            new_title += os;
        }
    }
    if (hdd) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += hdd;
        } else {
            new_title += hdd;
        }
    }
    if (ddr3) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += ddr3;
        } else {
            new_title += ddr3;
        }
    }

    if (cores) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += cores;
        } else {
            new_title += cores;
        }

    }

    if (size) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += size;
        } else {
            new_title += size;
        }
    }
    if (cool) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += cool;
        } else {
            new_title += cool;
        }
    }
    if (temp_min_minus_10) {
        if (new_title) {
            new_title += ", ";
            new_title += temp_min_minus_10;
        } else {
            new_title += temp_min_minus_10;
        }
    }
    if (temp_min_minus_20) {
        if (new_title) {
            new_title += ", ";
            new_title += temp_min_minus_20;
        } else {
            new_title += temp_min_minus_20;
        }
    }
    if (temp_min_minus_40) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += temp_min_minus_40;
        } else {
            new_title += temp_min_minus_40;
        }
    }

    if (vesa) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += vesa;
        } else {
            new_title += vesa;
        }
    }
    if (material) {
        if (new_title !== "") {
            new_title += ", ";
            new_title += material;
        } else {
            new_title += material;
        }
    }

    if (new_title) {
        new_title = new_title.charAt(0).toUpperCase() + new_title.slice(1);
        $("title").html(new_title + ' - подбор по параметрам');
        //$("h1").html(new_title);
        $('#h1_placeholder').replaceWith('<div id="h1_placeholder"><div class="advanced-search__title-h1">Подбор устройств по параметрам</div><div class="advanced-search__h1-wrapper"><div class="advanced-search__title-h2">Выбраны параметры:</div><h1>'
            + new_title + '</h1></div></div>');

    } else {
        $("title").html('Weintek, IFC, Aplex, Samkoon — расширенный поиск, подбор по параметрам');
        $("h1").html('Weintek, IFC, Aplex, Samkoon — расширенный поиск, подбор по параметрам');
    }

}

var readv = '';
var clock = 8000;
var opasit = 1;
price_in_usd = 1;


$(document).ready(function () {
    block = 1;

    sl3();
    sl4();
    sl5();
    block = 0;

    $('.temp').remove();
    $('div.roll.to').hide();
    $('.caption.roll').siblings('div.roll.to').show();

    $('#filter').on('mouseover', '.temp', function () {
//opasit = $('.temp').css('opasity');
        if ($(this).css('opacity') > 0) {
            $('.temp').stop(true, true);
            $('.temp').css({'opacity': '1', 'display': 'inherit'});
        } else {
            $(this).remove();
        }
        ;
//$('.temp').fadeIn('100');
    });

    $('#filter').on('mouseout', '.temp', function () {
//opasit = $('.temp').css('opasity');
        $('.temp').stop();
//$('.temp').css('opasity', opasit);
        $('.temp').animate({'opacity': '0'}, {duration: clock});
    });

    $('#filter input[type="checkbox"]').change(function (eventObject) {


        setTimeout(function () {
            var t = $(eventObject.target).prop('id');
            /*if ($.inArray(t, ["itype4", "itype5", "itype6"]) >= 0) {
             if ($(eventObject.target).prop('checked')) {
             $('#min-diagonal').val('');
             $('#max-diagonal').val('');
             diagonals = $('#diagonals');
             $(diagonals).prop('checked', true);
             label = $(diagonals).parent('label');
             $(label).addClass("active");
             $(label).children('.galochka').html('<span class="gal">&#10004;</span>');
             }
             }*/
            if ($.inArray(t, ["itype0", "itype1", "itype2", "itype3"]) >= 0) {
                if ($(eventObject.target).prop('checked')) {
                    diagonals = $('#diagonals');
                    $(diagonals).prop('checked', false);
                    label = $(diagonals).parent('label');
                    $(label).removeClass("active");
                    $(label).children('.galochka').html('');
                }
            }
//alert(t);


//monitor();
//if ($(eventObject.target).hasClass('number-box') == false) {

//alert($(eventObject.target).parents('label').html());

            if ($(eventObject.target).parent('label').hasClass("active")) {
//alert('active to remove');

                $(eventObject.target).parent('label').removeClass("active");
                $(eventObject.target).siblings('.galochka').empty();
                $(eventObject.target).parents('.row-with-box').find('input[type="number"]').val('');
                $(eventObject.target).parents('.row-with-box').find('.galochka').empty();
            } else {

                $(eventObject.target).parent('label').addClass("active");
//alert('active to add');

                $(eventObject.target).siblings('.galochka').html('<span class="gal">&#10004;</span>');
                if ($(eventObject.target).attr('id') == 'diagonals') {
                    $('#min-diagonal').val('');
                    $('#max-diagonal').val('');
                }
                ;

                var znach = $(eventObject.target).parents('.row-with-box').find('input[type="number"]').eq('0').val();
//alert($(eventObject.target).parents('.row-with-box').find('input[type="number"]').size()+' >'+znach+'< ');
                if ((znach == '0') || (znach = '') || (znach = ' ')) {
                    $(eventObject.target).parents('.row-with-box').find('input[type="number"]').eq('0').val('1');
                }
                ;
            }
            ;


//};
            if (block != 1) {
                advance(0, t);
            } else {
                readv = t;
            }
            ;
        }, 100);
    });


    $('#filter input[type="number"]').change(function () {


//var	uu = e.which;
        var t = $(this).prop('id');

        /*if (t == 'min-diagonal') {
         var newerQuery = $.query.SET('min-diagonal', $(this).val());
         changeUrlParams(newerQuery);
         }*/

        /* newerQuery = $.query.SET(t, $(this).val());
         changeUrlParams(newerQuery);*/


//alert ($(this).val());
//	 alert(uu);
        //if (((uu > 47) && (uu <58)) || ((uu > 95) && (uu <106)) || (uu == 8) || (uu == 13)) {

        if ($(this).val() > 0) {
            // alert($(this).parents('.row-with-box').html());

            $(this).parents('.row-with-box').find('input[type="checkbox"]').prop({"checked": true});
            $(this).parents('.row-with-box').find('.galochka').html('<span class="gal">&#10004;</span>');
            $(this).parents('.row-with-box').find('.galochka').parent('label').addClass('active');
//  alert ($(this).parents('.row-with-box').find('input.number-box').index(this));
            if ($(this).parents('.row-with-box').find('input.number-box').index(this) == 1) {
                var v = $(this).val();
                if ((t != 'min-diagonal') && (t != 'max-diagonal')) {
                    $(this).parents('.row-with-box').find('input.number-box').eq(0).val(v);
                }
                ;
            }
            ;
            if (($(this).attr('id') == 'max-diagonal') || ($(this).attr('id') == 'min-diagonal')) {

                $('#diagonals').prop({"checked": false});
                $('#diagonals').siblings('.galochka').html('');
                $('#diagonals').parents('label').removeClass('active');
            }
            ;
        } else {

            $(this).val('');
            if ($(this).parents('.row-with-box').find('input.number-box').index(this) == 0) {

                $(this).parents('.row-with-box').find('.galochka').html('');
                $(this).parents('.row-with-box').find('.galochka').parent('label').removeClass('active');
            }
            ;

        }
        ;

        setTimeout(function () {


            if (block != 1) {
                advance(0, t);
            } else {
                readv = t;
            }
            ;
        }, 100);
        // };
    });

    $('#filter input[type="number"]').on('keyup', function (e) {


        uu = e.which;
        var t = $(this).prop('id');
        if (((uu > 47) && (uu < 58)) || ((uu > 95) && (uu < 106)) || (uu == 8) || (uu == 13)) {
            setTimeout(function () {


                if (block != 1) {
                    advance(0, t);
                } else {
                    readv = t;
                }
                ;
            }, 100);
        }
        ;
    });


    $('.caption').click(function () {
        if ($(this).hasClass('roll')) {
            $(this).siblings('div.roll.to').hide(200);
            $(this).removeClass('roll');
        } else {
            $(this).siblings('div.roll.to').show(200);
            $(this).addClass('roll');
        }
        ;

    });

    $('#filter').on('click', '#full', function () {

        pag = 1;
        advance(1, '');


    });

    $('#filter').on('click', '#show-button', function () {
// monitor();
        advance(1, '');
        $('body,html').animate({
            scrollTop: 93
        }, 300);

    });

    $('#filter').on('click', '#clear-button', function () {

        $('#filter input[type="checkbox"]').each(function (indx, element) {
            $(element).prop({'checked': false})
        });

        $('#filter .galochka').html('');
        $('#filter label').removeClass('active');
        $('input[type="number"]').val('');
        $('#min-price').val('');
        $('#max-price').val('');
        $('#min-diagonal').val('');
        $('#max-diagonal').val('');
        $('#temp_min_minus_10').val('');
        $('#temp_min_minus_20').val('');
        $('#temp_min_minus_40').val('');
        $('input[name="core"]').val('');

        $('#min-width').val('80');
        $('#max-width').val('545');
        $('#min-height').val('89');
        $('#max-height').val('377');
        $('#min-thickness').val('27');
        $('#max-thickness').val('138');

        $('div:not(#type) > div.roll.to').hide();
        $('div:not(#type) > .caption').removeClass('roll');

//$(".radio").addClass("active");

        pag = 1;

//$('#filter > .block-row input[type="checkbox"]').each(function(indx, element) {$(element).prop({'checked':true})});
//$('#filter > .block-row .galochka').html('<span class="gal">&#10004;</span>');
//$('#filter > .block-row label').addClass('active');
        sl3();
        sl4();
        sl5();

        advance(1, '');
        $('.temp').remove();
        $('body,html').animate({
            scrollTop: 150
        }, 300);
        cookieExp = new Date();
        cookieExp.setMonth(cookieExp.getMonth() - 1);

        document.cookie = 'podbor=; expires=' + cookieExp.toGMTString() + '; path=/;';

    });
    price_in_usd = 1;
});

function page(pa) {
    pag = pa;
    advance(1, '');

}

function show_compare1(o, model) {
//alert("compare");
    var x = $(o).offset().left;
    var y = $(o).offset().top;
    $("#compare").css('left', x - 100);
    $("#compare").css('top', y - 200);
    var coit = model;   // model passed
    $("#compare_message").html("");

    var mo = jQuery.inArray(coit, compare);
    if (mo > -1) {
        $("#compare_message").html("такая модель уже есть в списке");
        $(o).hide();
        $(o).next('div.to-r').show();
    } else {
        if (compare.length < compare_list_max) {
            compare.push(coit);
            write_cookie_compare();
            postponed_mod = "";
            $("#compare_message").html(coit + " успешно добавлена в Ваш список сравнения");
            $(o).hide();
            $(o).next('div.to-r').show();
        } else {
            postponed_mod = coit;
            $("#compare_message").html("В списке может быть максимум " + compare_list_max + " продукта. Чтобы добавить " + coit + " удалите любой продукт из списка");
        }
        //alert(postponed_mod);
    }
    $("#compare_body").html(print_compare1(coit));
    $("#compare").show();
}

function print_compare1(coit) {
    var i = 0;
    var out = "<table>";
    var uri = "?";
    for (i = 0; i < compare.length; i++) {
        out += "<tr height=20><td width=180 align=left>" + compare[i] + "</td><td><span class='iks' style='cursor:pointer;' onclick='del_from_c(" + i + ",\"" + compare[i] + "\",\"" + coit + "\")' title='Удалить'> X </span></td></tr>";
        uri += "m" + i + "=" + compare[i] + "&";
    }
    out += "</table><br><br>";
//<br><br>
    //alert(out);
    return out;
}

function del_from_c(index, model, coit) {
//alert("dd");

    var uua = $('#' + model + 'a');
    var uud = $('#' + model + 'd');

    compare.splice(index, 1);
    $("#compare_message").html("");
    if (postponed_mod != "") {
        compare.push(postponed_mod);
        $("#compare_message").html(postponed_mod + " успешно добавлена в Ваш список сравнения");
        $(uua).show();
        $(uud).hide();
        $('#' + coit + 'd').show();
        $('#' + coit + 'a').hide();
        postponed_mod = "";
    }
    write_cookie_compare();
    var co = print_compare();
//co+="<br><br><span class=zakazbut onclick=''>Сравнить</span> <span class=zakazbut onclick='hide_compare()'> Отмена</span>";
//alert(co);
    $("#compare_body").html(co);
}

function del_from(model) {

    var uua = $('#' + model + 'a');
    var uud = $('#' + model + 'd');

    var mo = jQuery.inArray(model, compare);
    compare.splice(mo, 1);

    write_cookie_compare();

    $(uua).show();

    $(uud).hide();

}

$(document).ready(function () {
    function parse() {
        var params = window.location.search.substring(1).split("&");
        var res = {};
        for (var index = 0; index < params.length; index++) {
            var val_z = params[index].split("=");
            res[val_z[0]] = val_z[1];
        }
        return res;
    }

    var params = parse();
    var push_show_button = false;
    if (typeof params['min-diagonal'] != 'undefined') {
        $('#min-diagonal').val(params['min-diagonal']);
        push_show_button = true;
    }
    if (typeof params['min-diagonal'] != 'undefined') {
        $('#max-diagonal').val(params['max-diagonal']);
        push_show_button = true;
    }
    if (typeof params['type0'] != 'undefined') {
        if ($('#type0').is('.active')) {
            ;
        } else {
            $('#type0').click();
        }
        push_show_button = true;
    }
    if (typeof params['type1'] != 'undefined') {
        if ($('#type1').is('.active')) {
            ;
        } else {
            $('#type1').click();
        }
        push_show_button = true;
    }
    if (typeof params['type2'] != 'undefined') {
        if ($('#type2').is('.active')) {
            ;
        } else {
            $('#type2').click();
        }
        push_show_button = true;
    }
    if (typeof params['type3'] != 'undefined') {
        if ($('#type3').is('.active')) {
            ;
        } else {
            $('#type3').click();
        }
        push_show_button = true;
    }


    if (push_show_button && false) {

        setTimeout(function () {
            //$('#full').click();
            advance(1, '');
        }, 100);

    }

});

function changeUrlParams(newlink) {
    var elm = document.getElementsByTagName('title')[0];
    link = document.location.protocol + '//' + document.location.host + document.location.pathname + newlink.toString();
    history.pushState(null, null, link);
    updateTitle(elm);
}


function followLink(event, link) {
    var nameLink = link.innerHTML;
    uploadContent(link.href);
    history.pushState({title: nameLink, href: link.href}, null, link.href);
    updateTitle(nameLink);
    event.preventDefault();
}

function updateTitle(title) {
    var elm = document.getElementsByTagName('title')[0];
    elm.innerHTML = title;
}

function uploadContent(link) {
    //тут реализуем загрузку части страницы с помощью AJAX
}

/*window.addEventListener("popstate", function (e) {
 uploadContent(e.state.href);
 updateTitle(e.state.title);
 }, false);*/