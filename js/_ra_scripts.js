var mousex = 0;
var mousey = 0;
//var bask=['1','2','3'];
var bask = [];
var compare = [];
var chosen_item = "";
//var models=["MT6050i", "MT6070iH", "MT6100i", "MT8050i", "MT8070iH"];
//var prices=[110 ,120 ,130,140,150];
var usd_rate = 30;
var cur_val = 0; // 1 = usd 0=rub
var prices1 = [];
var price_in_usd = 1;
var usdcurs = 30;
var file_name = "";
var basket_opened = 0;
var basket_sum = 0;
var basket_items = 0;
var basket_val = "";
var postponed_mod = "";
var compare_list_max = 4;
var reservir_model = "";
var reservir_stock = "";
var reservir_manager = "";
var resrevir_surname = "";


function cnf_user_reg()
{
    $.ajax({
        url: "/service/cnf_reg_tool.php",
        type: "POST",
        dataType: "html", //"json",
        data: {name: $("#cnf_name").val(), fathername: $("#cnf_fathername").val(), surname: $("#cnf_surname").val(), company: $("#cnf_company").val(),
            city: $("#cnf_city").val(), phone: $("#cnf_phone").val(), email: $("#cnf_email").val()},
        success: function (msg) {
            //  alert(msg);
            //	location.reload();
            $("#cnf_mess").html(msg);
            if (msg[0] == '&')
            { //alert("YO");
                $("#cnf_name").val('');
                $("#cnf_fathername").val('');
                $("#cnf_surname").val('');
                $("#cnf_company").val('');
                $("#cnf_city").val('');
                $("#cnf_phone").val('');
                $("#cnf_email").val('');
            }

            // $("#conn_info").html("");
        },

    });


}


function sendcf()
{
//alert("dsd");
    $("#cfmessres").html("<br><br>");
    var name = $("#cfname").val();
    var phone = $("#cfphone").val();
    var email = $("#cfemail").val();
    var mess = $("#cfmess").val();


    $.ajax({
        url: "/service/forms_tool.php",
        type: "POST",
        dataType: "html", //"json",
        data: {name: name, phone: phone, email: email,
            mess: mess, ft: 'cf'},
        success: function (msg) {
            //alert(msg);
            $("#cfmessres").html(msg);

            //show_result_mess(msg);
            //location.reload();
            // $("#unl_mess").html(msg);
            // $("#conn_info").html("");
        },

    });



}


function sendsf()
{
//alert("dsd");
    $("#spfmessres").html("<br><br>");
    var name = $("#spfname").val();
    var surname = $("#spfsurname").val();
    var company = $("#spfcompany").val();
    var position = $("#spfposition").val();
    var prod = $("#spfprod").val();
    var phone = $("#spfphone").val();
    var email = $("#spfemail").val();
    var mess = $("#spfmess").val();


    $.ajax({
        url: "/service/forms_tool.php",
        type: "POST",
        dataType: "html", //"json",
        data: {name: name, surname: surname, company: company, position: position, prod: prod, phone: phone, email: email,
            mess: mess, ft: 'sf'},
        success: function (msg) {
            //alert(msg);
            $("#spfmessres").html(msg);

            //show_result_mess(msg);
            //location.reload();
            // $("#unl_mess").html(msg);
            // $("#conn_info").html("");
        },

    });

}






//^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$

//var reg=^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$;
//var result=reg.test("8-921-9334120);



function logout()
{
    $.ajax({
        url: "/service/logout.php",
        type: "POST",
        dataType: "html", //"json",
        // data: { value: val, id: it_id, element: item},
        success: function (msg) {
            //alert(msg);
            location.reload();
            //$("#login_out").html(msg);
            // $("#conn_info").html("");
        },

    });


}




function send_podbor()
{
    ser = $("#podbor_form").serialize();

    var dia_min = $("#slider-range").slider('values', 0);
    var dia_max = $("#slider-range").slider('values', 1);
    var pr_min = $("#price-range").slider('values', 0);
    var pr_max = $("#price-range").slider('values', 1);

    ser = "dia_min=" + dia_min + "&dia_max=" + dia_max + "&pr_min=" + pr_min + "&pr_max=" + pr_max + "&" + ser;
    write_cookie_podbor(ser);

//alert("ddd");
    $.ajax({
        url: "/service/podb.php",
        type: "POST",
        dataType: "html", //"json",
        data: ser,
        success: function (msg) {
            //alert(msg);
            $("#podb_res").html(msg);

            bind_recalc_valute();
        },

    });



}



function show_basket_small()
{
    if (basket_sum == "0")
        basket_val = "РУБ";
    $("#bask_sm_text").html(" " + basket_items + " шт<br>" + basket_sum + " " + basket_val);
    /*
     if (basket_sum.indexOf("EUR")>=0) {
     $("#bask_sm_text").html(" "+basket_items+" шт<br>"+basket_sum);
     } else {
     $("#bask_sm_text").html(" "+basket_items+" шт<br>"+basket_sum+" "+basket_val);

     };
     */

}


function ts()
{
//if(basket_opened==0 && ((basket_sum != 0) || (basket_sum !=''))
//if(basket_opened==0 && (basket_sum > 0))
    if (basket_opened == 0)
    {
        $("#slided").slideDown("fast");
        basket_opened = 1;
    } else
    {
//$("#slided").slideUp("fast");
//basket_opened=0;
    }

}

function ts1()
{
    $("#slided").slideUp("slow");

}


function get_discount_form()
{
//alert("hjhj");
//function get_data(val, name, action, model)
//{
//$("#conn_info").html("Iaiiaeaiea...");
    var ph = $("#phone").val();
    if (ph == "")
        $("#form_out").html("Пожалуйста, введите правильный телефонный номер");
    else
        $.ajax({
            url: "/service/mess.php",
            type: "POST",
            dataType: "html", //"json",
            data: {phone: ph},
            success: function (msg) {
                alert(msg);
                $("#form_out").html(msg);
                // $("#conn_info").html("");
            },

        });

}






jQuery(function ($) {

    $.mask.definitions['~'] = '[+-]';
    $('#date').mask('99/99/9999');
    $('#phone').mask('(999) 999-9999');
    $('#phone1').mask('(999) 999-9999');
    $('#phoneext').mask("(999) 999-9999? x99999");
    $("#tin").mask("99-9999999");
    $("#ssn").mask("999-99-9999");
    $("#product").mask("a*-999-a999", {placeholder: " ", completed: function () {
            alert("You typed the following: " + this.val());
        }});
    $("#eyescript").mask("~9.99 ~9.99 999");
});

//--------------------------------------calc prices ---------------
function make_price_table() {



    $(".prpr").each(function (i) {
        prices1[i] = $(this).text();
        //alert( $(this).text() );
    });

// alert(prices[1]);

}

function recalc_valute()
{
    var valuta = $('#valuta').val();
//alert("dsds");
//alert($('input#valuta').val());
    if ($('input#valuta').val() == 'EUR') {
        var curs = eur_rate;
    } else {
        var curs = usdcurs;
    }
    ;
    if (price_in_usd == 1)
    {

        $(".prpr").each(function (i) {
            $(this).html(Math.floor(prices1[i] * curs));
            $(this).prop('title', 'Нажмите для пересчета в ' + valuta);
        });
        $(".val_name").each(function (i) {
            $(this).html(" РУБ ");
            $(this).prop('title', 'Нажмите для пересчета в ' + valuta);
        });

        $("#shpr").html("Отобразить цены в " + valuta);
        price_in_usd = 0;
    } else
    {
        $(".prpr").each(function (i) {
            $(this).html(prices1[i]);
            $(this).prop('title', 'Нажмите для пересчета в РУБ');
        });
        $(".val_name").each(function (i) {
            $(this).html(" " + valuta + " ");
            $(this).prop('title', 'Нажмите для пересчета в РУБ');
        });
        $("#shpr").html("Отобразить цены в РУБ");
        price_in_usd = 1;
    }

}

function isEmail(email) {
    return /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/.test(email);
}

//----------------------------------------------------------------------------------
function sub()
{
    // alert("upl");

    //var file_name="";



    $("#order_send_mess").html("");

    var ph = $("#formphone").val();
    var em = $("#formemail").val();
    var out = "";


    if (ph == "" || em == "")
        out = "Пожалуйста, заполните телефон и email";
    if (ph.length < 11)
        out = "Пожалуйста, заполните правильно телефон ( убедитесь, что ввели код города )";
    if (!isEmail(em))
        out = "Пожалуйста, введите правильный email";
    if (bask.length == 0)
        out = "Пожалуйста, добавьте в корзину хотя бы один продукт";

    if (out != "") {
        $("#order_send_mess").html("<font color=red>" + out + "</font");
        return;
    }


    $(".fileform").ajaxForm({
        beforeSubmit: function () {
            // $('#results').html('Submitting...');
            // alert("bfsu");
            $("#checkfile").html("Загрузка файла...");
        },
        success: function (data) {
            //   var $out = $('#res_file');
            //   $out.html('Your results:');
            //  $out.append('<div><pre>'+ data +'</pre></div>');

            //  alert(data);

            // $("#checkfile").html('Файл успешно загружен');
            //  alert(  $("#out_file_res").html());
            //  $("#out_file_res").empty();

            //file_name=data;
            send_order(data);
            $("#checkfile").html("Файл загружен");


            // alert("data="+data);
            /*
             $("#out_file_res").html("<table <tr><td width=90 class=dost_text height=30 title='Для выставления счета на понадобятся реквизиты Вашей компании'>  \
             Реквизиты  </td><td class=dost_text width=200> Файл реквизитов загружен </td><td class=dost_text>\
             <span  onclick='get_data(1,1,\"new_rekv_file\",1);' style='cursor:pointer' title='Нажмите, если  реквизиты изменились'> Загрузить новый файл &nbsp;&nbsp; <img src='/images/ques.gif' width=13 class=imgcenter> </span>  \
             </td>\
             </tr></table>");
             */


        },

        error: function (data) {

            // alert("Ошибка загрузки" );
            $("#checkfile").html('Ошибка загрузки файла');
        }


    });


    //if(!bask[0]) alert("fuck");



    if ($("#formfile").val() == "")
        send_order("");
    else
        $(".fileform").submit();

// alert("file_name="+file_name);



}

function send_order(file_name)
{
//alert("ddd");
    var dost = "";
    if ($("#dost1").prop("checked"))
        dost = 'avtotrading'; //alert("1");
    if ($("#dost2").prop("checked"))
        dost = 'courier';//alert("2");
    if ($("#dost3").prop("checked"))
        dost = 'samovyvoz_spb';//alert("3");
    if ($("#dost4").prop("checked"))
        dost = 'samovyvoz_msk';//alert("4");
    if ($("#dost5").prop("checked"))
        dost = 'samovyvoz_kiev';//alert("4");
    if ($("#dost6").prop("checked"))
        dost = 'dostavka_ukraina';//alert("4");
    if ($("#dost7").prop("checked"))
        dost = 'delovie_linii';//alert("4");

    var nm = $("#formname").val();
    var comp = $("#formcompany").val();
    var ph = $("#formphone").val();
    var eml = $("#formemail").val();

    var bsk = basket_to_string();


    $.ajax({
        url: "/service/mess1.php",
        type: "POST",
        dataType: "html", //"json",
        data: {dostavka: dost, name: nm, company: comp, phone: ph, email: eml, basket: bsk, file: file_name},
        success: function (msg) {
            // alert(msg);
            //$("#form_out").html(msg);
            // $("#conn_info").html("");
            $("#order_send_mess").html("<font color=green>Спасибо, Ваш заказ успешно отправлен. Мы свяжемся с Вами в ближайшее время</font>")
        },

    });


    write_cookie_contacts();

}




//-------------------- popup messages ------------------

$(window).scroll(function () {

    //popup_position();
});



function popup_position()
{
    var h = $(window).height();
    var w = $(window).width();
    var d = $(document).height();
    //var scrtop=$(window).scrollTop();

    var top = Math.round((h - $("#mes_container").height()) / 2);

    var left = Math.round((w - $("#mes_container").width()) / 2);

    $("#mes_backgr").css('width', w);
    $("#mes_backgr").css('height', d);
    $("#mes_container").css('top', top);
    $("#mes_container").css('left', left);

}





function show_popup(mesid)
{

    popup_position();

    //alert($(window).scrollTop());

    $("#mes_backgr").css('opacity', '0.7');
    $("#mes_backgr").fadeIn("slow");

    var ss = $("#" + mesid).html();
    $("#mes_body").html(ss);

    jQuery(function ($) {

        $.mask.definitions['~'] = '[+-]';
        $('#date').mask('99/99/9999');
        $('#phone').mask('(999) 999-9999');
        $('#phoneext').mask("(999) 999-9999? x99999");
        $("#tin").mask("99-9999999");
        $("#ssn").mask("999-99-9999");
        $("#product").mask("a*-999-a999", {placeholder: " ", completed: function () {
                alert("You typed the following: " + this.val());
            }});
        $("#eyescript").mask("~9.99 ~9.99 999");
    });


    $("#mes_container").fadeIn("slow");

}

function hide_popup()
{

//$("#mes_container").css('visibility', 'hidden');
//$("#mes_backgr").css('visibility', 'hidden');

    $("#mes_container").fadeOut("slow");
    $("#mes_backgr").fadeOut("slow");

}


//---------------------------------------- basket ------------------------
function del_from_basket(index)
{

//alert("sdsds");
//var index = bask.indexOf(val);

    if (index != -1) {
        bask.splice(index, 1);
        write_cookie();
        show_basket();
        show_basket_big();
    }


}



function write_cookie_contacts()
{
    var con = $("#formname").val() + "#" + $("#formcompany").val() + "#" + $("#formphone").val() + "#" + $("#formemail").val();
//alert(con);
    $.cookie('cookie_contacts', con, {expires: 365});
}

function read_cookie_contacts()
{
    var ss = $.cookie('cookie_contacts');
    if (ss) {
        var cont = ss.split("#");
//alert(ss);
        $("#formname").val(cont[0]);
        $("#formcompany").val(cont[1]);
        $("#formphone").val(cont[2]);
        $("#formemail").val(cont[3]);
    }
    ;
}


function write_cookie_podbor(sform)
{
//alert(sform);
    $.cookie('cookie_podbor', sform, {expires: 365});

    //$("#podbor_form select[name=device_type] :contains('Неважно')").prop("selected", "selected");// works !!

}

function urldecode(str) {
    return decodeURIComponent((str + '').replace(/\+/g, '%20'));
}

function read_cookie_podbor()
{
    var ss = urldecode($.cookie('cookie_podbor'));
//alert(ss);
    var podb = ss.split("&");
//alert(podb[0]);
//var arr = [ "one", "two", "three", "four", "five" ];

    jQuery.each(podb, function () {

        var bb = this.split("=");
        if (bb[0] == "dia_min")
            $("#slider-range").slider('values', 0, bb[1]);
        if (bb[0] == "dia_max")
        {
            $("#slider-range").slider('values', 1, bb[1]);
            $("#amount").val($("#slider-range").slider("values", 0) + "\" - " +
                    $("#slider-range").slider("values", 1) + "\"");
        }
        if (bb[0] == "pr_min")
            $("#price-range").slider('values', 0, bb[1]);
        if (bb[0] == "pr_max")
        {
            $("#price-range").slider('values', 1, bb[1]);
            $("#amount1").val($("#price-range").slider("values", 0) + "$ - " +
                    $("#price-range").slider("values", 1) + "$");
        }


        $("#podbor_form select[name=" + bb[0] + "] :contains('" + bb[1] + "')").prop("selected", "selected");// works !!

    });
}
// $("#podbor_form input[name=case_material]").val() );

function call_compare_php(m0, m1, m2, m3)
{
    var d0, d1, d2, d3, mode;

    if (m0 != "")
    {
        d0 = m0;
        d1 = m1;
        d2 = m2;
        d3 = m3;
        mode = 1; // get
    } else
    {
        d0 = compare[0];
        d1 = compare[1];
        d2 = compare[2];
        d3 = compare[3];
        mode = 2; //cookie

    }

    $.ajax({
        url: "/service/compa.php",
        type: "POST",
        dataType: "html", //"json",
        data: {m0: d0, m1: d1, m2: d2, m3: d3, mode: mode},
        success: function (msg) {
            // alert(msg);
            $("#compare_res").html(msg);
            // $("#conn_info").html("");
        },

    });

}

function backup_call_position()
{
    var h = $(window).height();
    var w = $(window).width();
    var d = $(document).height();
    //var scrtop=$(window).scrollTop();

    var top = Math.round((h - $("#backup_call").height()) / 2);

    var left = Math.round((w - $("#backup_call").width()) / 2);

    $("#mes_backgr").css('width', w);
    $("#mes_backgr").css('height', d);
    $("#backup_call").css('top', top - 50);
    $("#backup_call").css('left', left);

}

function backup_call_go()
{

    $("#backup_call_message").html("");
    var phone = $('input[name="phone"]').val(),
            intRegex = /[0-9-()+]+$/;
    if ((phone.length < 11) || (!intRegex.test(phone)))
    {
        //alert('Please enter a valid phone number.');
        $("#backup_call_message").html("неправильный номер");

        return false;
    }
    $.ajax({
        url: "/service/callback.php",
        type: "POST",
        dataType: "html", //"json",
        data: {ph: phone},
        success: function (msg) {
            //  alert(msg);
            if (msg == "OK")
                $("#backup_call_message").html("Ожидайте звонка...");
            else
                $("#backup_call_message").html("Ошибка, попробуйте еще раз...<br>" + msg);
        },

    });


}

function hide_compare()
{
    $("#compare").hide();
}

function backup_call_hide()
{
    $("#mes_backgr").fadeOut("fast");
    $("#backup_call").hide();

}

function show_backup_call(o, model)
{
//alert("sdsd");
    backup_call_position();
    $("#backup_call_message").html("");
//var x=$(o).position().left;
//var y=$(o).position().top;
//$("#backup_call").css('left', x-100);
//$("#backup_call").css('top', y-200);

    if (o == 1)
        $("#backup_call_h").html("Для обсуждения Вашей скидки на <b>" + model + "</b> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России, 7 )<br> \
Мы перезвоним Вам через 10 секунд<br><br>");

    if (o == 2)
        $("#backup_call_h").html("Для быстрого заказа <b>" + model + "</b> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России, 7)<br>   \
Мы перезвоним Вам через 10 секунд<br><br>");

    if (o == 3)
        $("#backup_call_h").html("Для уточнения данных по Вашему заказу пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России, 7)<br>   \
Мы перезвоним Вам через 10 секунд<br><br>");

    if (o == 4)
        $("#backup_call_h").html("Пожалуйста, введите Ваш мобильный номер, начиная с кода страны <br>( например, для России, 7)<br>   \
Мы перезвоним Вам через 10 секунд<br><br>");

    if (o == 5)
        $("#backup_call_h").html("<strong>Для уточнения условий <span style='color:red;'>акционного предложения</span></strong> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России — 7)<br>   \
<strong>Мы перезвоним Вам через 10 секунд<strong><br /><br />");

    if (o == 6)
        $("#backup_call_h").html("<strong>Для уточнения цены <b>" + model + "</b></strong> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России — 7)<br>   \
<strong>Мы перезвоним Вам через 10 секунд<strong><br /><br />");

    $("#backup_call").show();
    $("#mes_backgr").css('opacity', '0.7');
    $("#mes_backgr").fadeIn("fast");

}

function show_compare(o)
{
//alert("compare");
    var x = $(o).position().left;
    var y = $(o).position().top;
    $("#compare").css('left', x - 100);
    $("#compare").css('top', y - 200);
    var coit = $(o).attr('idm');   // model passed
    $("#compare_message").html("");

    var mo = jQuery.inArray(coit, compare);
    if (mo > -1)
        $("#compare_message").html("такая модель уже есть в списке");

    else
    {
        if (compare.length < compare_list_max)
        {
            compare.push(coit);
            write_cookie_compare();
            postponed_mod = "";
            $("#compare_message").html(coit + " успешно добавлена в Ваш список сравнения");

        } else
        {
            postponed_mod = coit;
            $("#compare_message").html("В списке может быть максимум " + compare_list_max + " продукта. Чтобы добавить " + coit + " удалите любой продукт из списка");
        }
        //alert(postponed_mod);
    }
    $("#compare_body").html(print_compare());
    $("#compare").show();
}


function del_from_compare_in_big(model)
{
    var mo = jQuery.inArray(model, compare);
    compare.splice(mo, 1);
    write_cookie_compare();
    reloa();

}

function reloa() {

    read_cookie_compare();
    call_compare_php('', '', '', '');
    hide_compare();
    $('#compare_head #show-to-add').hide();
    var scr = $('#compare_head').position().top;
    $('body').scrollTop(scr);

}


function del_from_compare(index)
{
//alert("dd");
    compare.splice(index, 1);
    $("#compare_message").html("");
    if (postponed_mod != "")
    {
        compare.push(postponed_mod);
        $("#compare_message").html(postponed_mod + " успешно добавлена в Ваш список сравнения");
        postponed_mod = "";
    }
    write_cookie_compare();
    var co = print_compare();
//co+="<br><br><span class=zakazbut onclick=''>Сравнить</span> <span class=zakazbut onclick='hide_compare()'> Отмена</span>";
//alert(co);
    $("#compare_body").html(co);
}

function print_compare()
{
    var i = 0;
    var out = "<table>";
    var uri = "?";
    for (i = 0; i < compare.length; i++)
    {
        out += "<tr height=20><td width=180 align=left>" + compare[i] + "</td><td><span class='iks' style='cursor:pointer;' onclick='del_from_compare(" + i + ")' title='Удалить'> X </span></td></tr>";
        uri += "m" + i + "=" + compare[i] + "&";
    }
    out += "</table><br><br>";
//<br><br>
    //alert(out);
    return out;
}

function go_to_comparison()
{
    var uri = "?";
    for (i = 0; i < compare.length; i++)
    {
        uri += "m" + i + "=" + compare[i] + "&";
    }

    window.location = "/comparison.php" + uri;
}

function read_cookie_compare()
{
    var ss = $.cookie('cookie_compare');
    if (ss)
        compare = ss.split('|');

}

function write_cookie_compare()
{

    $.cookie('cookie_compare', compare.join('|'), {expires: 7});
}

function write_cookie()
{

    $.cookie('the_cookie', bask.join('|'), {expires: 7});
}

function read_cookie()
{
    var ss = $.cookie('the_cookie');
//alert(ss);
    /*
     if(ss==null)
     {
     bask=[];
     write_cookie();
     }
     else
     */
    if (ss)
        bask = ss.split('|');

}
//------------------------- show basket----------------
function show_basket()
{
    var i = 0;
    var out = "";
    var b = [];
    var sum = 0;
    var sume = 0;
    var sumr = 0;
    var bapl = "";
    var pr = "";
    var koeff = 1;
    var it_val = "";
    var itms = 0;
    var itogo = '';

    out += "<table width=100%><tr class=bask_head><td>Модель</td><td>Кол-во</td><td>Цена</td><td> </td></tr>";
    for (i = 0; i < bask.length; i++)
    {
        b = bask[i].split("#");

        bapl = "&nbsp <span class='plusi' onclick='bapl_inc(" + i + ");' style='cursor:pointer;'>+</span>";
        bami = "&nbsp <span  class='minusi' onclick='bapl_dec(" + i + ");' style='cursor:pointer;'>-</span>";

        var pr = get_mod_price(b[0]);



        if (cur_val == 0)
        {
            if (eurproducts.indexOf(b[0]) >= 0) {
                pr = pr * eur_rate;
                koeff = eur_rate;
            } else if (ruproducts.indexOf(b[0]) >= 0) {
                koeff = 1;
            } else {

                pr = pr * usd_rate;
                koeff = usd_rate;
            }
            ;
            it_val = "РУБ";

        } else {
            if (eurproducts.indexOf(b[0]) >= 0) {
                it_val = "EUR";
            } else if (ruproducts.indexOf(b[0]) >= 0) {
                it_val = "РУБ";
            } else {
                it_val = "USD";
            }
            ;
            koeff = 1;
        }
        ;

        out += "<tr class=bask_tab><td>" + b[0] + "</td><td>" + b[1] + bapl + " " + bami + "</td><td>" + Math.floor(b[2] * koeff) + " " + it_val + "</td><td onclick='del_from_basket(" + i + ");' title='Удалить' style='cursor:pointer;'>X</td></tr>";
        if (it_val != 'РУБ') {

            if (eurproducts.indexOf(b[0]) >= 0) {

                sume += parseInt(b[2]) * koeff;

            } else if (ruproducts.indexOf(b[0]) >= 0) {

                sumr += parseInt(b[2]) * koeff;

            } else {
                sum += parseInt(b[2]) * koeff;
            }
            ;
        } else {
            sumr += parseInt(b[2]) * koeff;
        }
        ;
        itms += parseInt(b[1]);
        //alert(bask[i]);
    }

    out += "</table><br>";
    sum = Math.floor(sum);
    sume = Math.floor(sume);
    sumr = Math.floor(sumr);
    // if ((it_val == 'РУБ')) {
//  basket_sum=sumr;} else {
    basket_sum = '';
//  basket_sum = sum+"USD "+sume+"EUR"; basket_val='';
    if (sum > 0) {
        basket_sum = basket_sum + sum + "USD ";
    }
    ;
    if (sume > 0) {
        basket_sum = basket_sum + sume + "EUR ";
    }
    ;
    if (sumr > 0) {
        basket_sum = basket_sum + sumr + "РУБ ";
    }
    ;

    // };
    basket_items = itms;
    /*
     if (sume > 0) {
     if ((sum > 0) && (it_val != 'РУБ')) {
     basket_val='';
     itogo = sum+" USD "+sume+" EUR";
     } else {
     //  basket_val=it_val;
     basket_sum = sume+"EUR";
     itogo = sume+" "+it_val;
     };
     //  basket_val=it_val;
     } else {
     basket_val=it_val;
     itogo = sum+" "+it_val;
     basket_sum = sum;
     };
     */
    basket_val = '';
    var itogo = '';
    if (sum > 0) {
        itogo = itogo + sum + "USD ";
    }
    ;
    if (sume > 0) {
        itogo = itogo + sume + "EUR ";
    }
    ;
    if (sumr > 0) {
        itogo = itogo + sumr + "РУБ ";
    }
    ;

    $("#resba").html(out + "<span class=bask_head style='font-size: 11px' onclick='recalc_valute_basket()' title='Нажмите для пересчета валюты'>Сумма: &nbsp &nbsp " + itogo + "</span>");
    //alert(out);

    show_basket_small();
}
//-----------------------------end show basket  ------------------------------




//------------------------- show basket BIG----------------
function show_basket_big()
{
    var i = 0;
    var out = "";
    var b = [];
    var sum = 0;
    var sume = 0;
    var sumr = 0;
    var bapl = "";
    var edpl = "";
    var pr = "";
    var koeff = 1;
    var it_val = "USD";
    var it_val1 = "USD";
//cur_val = 1;

    out += "<table class=mytable width=80% cellpadding=0 cellspacing=0><tr class=bask_head_big><td>Модель</td><td>Кол-во</td><td>Цена</td> <td>Сумма</td> <td> </td></tr>";
    for (i = 0; i < bask.length; i++)
    {
        b = bask[i].split("#");


        edpl = "<input type=text value=" + b[1] + " class='counti' style='width:30px;' onchange='bapl_ch(" + i + ", this.value );'>";
        bapl = "&nbsp <span class='plusi' onclick='bapl_inc(" + i + ");' style='cursor:pointer;'>+</span>";
        bami = "&nbsp <span class='minusi' onclick='bapl_dec(" + i + ");' style='cursor:pointer;'>-</span>";

        var pr = get_mod_price(b[0]);

        //  if(cur_val==0)    { pr=pr*usd_rate; koeff=usd_rate; it_val="РУБ";} else { koeff=1; it_val="USD"};
        if (cur_val == 0)  //курс в рублях
        {
            if (eurproducts.indexOf(b[0]) >= 0) {
                pr = pr * eur_rate;
                koeff = eur_rate;
            } else if (ruproducts.indexOf(b[0]) >= 0) {
                pr = pr;
                koeff = 1;
            } else {

                pr = pr * usd_rate;
                koeff = usd_rate;
            }
            ;
            it_val = "РУБ";
            it_val1 = "РУБ";

        } else {
            //
            if (eurproducts.indexOf(b[0]) >= 0) {
                it_val1 = "EUR";
            } else if (ruproducts.indexOf(b[0]) >= 0) {
                it_val1 = "РУБ";
            } else {
                it_val1 = "USD";
            }
            ;

            koeff = 1;
        }
        ;


        out += "<tr class=bask_tab_big><td>" + b[0] + "</td><td>" + edpl + " " + bami + " " + bapl + "</td><td>" + Math.floor(pr) + " " + it_val1 + "</td><td>" + Math.floor(b[2] * koeff) + " " + it_val1 + "</td><td onclick='del_from_basket(" + i + ");' title='Удалить' style='cursor:pointer;'>X</td></tr>";
        if (it_val != 'РУБ') {

            if (eurproducts.indexOf(b[0]) >= 0) {

                sume += parseInt(b[2]) * koeff;

            } else if (ruproducts.indexOf(b[0]) >= 0) {

                sumr += parseInt(b[2]) * koeff;

            } else {
                sum += parseInt(b[2]) * koeff;
            }
            ;
        } else {
            sumr += parseInt(b[2]) * koeff;
        }
        ;
        //alert(edpl);
    }
    out += "</table><br>";


    sum = Math.floor(sum);
    sume = Math.floor(sume);
    sumr = Math.floor(sumr);

    // if ((it_val == 'РУБ')) {
//  basket_sum=sumr;} else {
    basket_sum = '';
//  basket_sum = sum+"USD "+sume+"EUR"; basket_val='';
    if (sum > 0) {
        basket_sum = basket_sum + sum + "USD ";
    }
    ;
    if (sume > 0) {
        basket_sum = basket_sum + sume + "EUR ";
    }
    ;
    if (sumr > 0) {
        basket_sum = basket_sum + sumr + "РУБ ";
    }
    ;

    // };
    /*
     if (sume > 0) {
     if ((sum > 0) && (it_val != 'РУБ')) { basket_val='';
     itogo = sum+" USD "+sume+" EUR";

     } else {
     //  basket_val=it_val;
     basket_sum = sume+"EUR";
     itogo = sume+" "+it_val;
     };
     // basket_val=it_val;
     } else {
     basket_val=it_val;
     itogo = sum+" "+it_val;
     basket_sum = sum;
     };
     */
    var itogo = '';
    if (sum > 0) {
        itogo = itogo + sum + "USD ";
    }
    ;
    if (sume > 0) {
        itogo = itogo + sume + "EUR ";
    }
    ;
    if (sumr > 0) {
        itogo = itogo + sumr + "РУБ ";
    }
    ;

    out += "<table><td class=bask_tab_big width=250> <b>Итого: " + itogo + "</b></td><td width=70 align=left> \
  <img src='/images/cube.jpg'  width=30  style='cursor:pointer;' onclick='recalc_valute_basket()' title='Нажмите для пересчета валюты'></td><td class=ord_goods>";


    //$("#resba_big").html(out+"<span class=bask_head_big style='font-size: 15px' >Сумма: &nbsp &nbsp "+sum+"</span>");
    $("#resba_big").html(out);
    //alert(out);

}


//------------------------- put basket to server----------------
function basket_to_string()
{
    var i = 0;
    var out = "";
    var b = [];
    var sum = 0;

    var bapl = "";
    var edpl = "";
    var pr = "";
    var koeff = 1;
    var it_val = "USD";

    out += "<table class=mytable width=80% cellpadding=0 cellspacing=0><tr class=bask_head_big><td>Модель</td><td>Кол-во</td><td>Цена</td> <td>Сумма</td> </tr>";
    for (i = 0; i < bask.length; i++)
    {
        b = bask[i].split("#");


        edpl = "<input type=text value=" + b[1] + " style='width:30px;' class='counti' onchange='bapl_ch(" + i + ", this.value );'>";
        bapl = "&nbsp <span  class='plusi' onclick='bapl_inc(" + i + ");' style='cursor:pointer;'>+</span>";
        bami = "&nbsp <span class='minus	i' onclick='bapl_dec(" + i + ");' style='cursor:pointer;'>-</span>";
        var pr = parseInt(prices[models.indexOf(b[0])]);
        if (cur_val == 0)
        {
            pr = pr * usd_rate;
            koeff = usd_rate;
            it_val = "РУБ";
        } else {
            koeff = 1;
            it_val = "USD"
        }
        ;


        out += "<tr class=bask_tab_big><td>" + b[0] + "</td><td>" + b[1] + "</td><td>" + pr + "</td><td>" + Math.floor(b[2] * koeff) + "</td></tr>";
        sum += parseInt(b[2]);
        //alert(edpl);
    }
    out += "</table><br>";
    sum = Math.floor(sum * koeff);


    out += "<b>Итого: " + sum + " " + it_val + "</b>";


    //$("#resba_big").html(out+"<span class=bask_head_big style='font-size: 15px' >Сумма: &nbsp &nbsp "+sum+"</span>");
    //$("#resba_big").html(out);
    //alert(out);
    return out;

}


function recalc_valute_basket()
{
//alert("vv");
    if (cur_val == 0)
        cur_val = 1;
    else
        cur_val = 0;
    show_basket_big();
    show_basket();


}

function clean_basket()
{
    bask = [];
    write_cookie();
    show_basket();
    show_basket_big();
    ts();  // slide up small basket

}

function get_mod_price(model)
{
    var mo = jQuery.inArray(model, models);
    mo = parseInt(mo);
    var pr = parseInt(prices[mo]);
//alert(mo+" "+pr);
    return pr;
}

function add_to_basket(ite, num) {


//item="sdd";

//alert(num);
//cova+=10;
//var pr=prices[models.indexOf(ite)];
//var mo=models.indexOf(ite);
//var mo=jQuery.inArray( ite, models );
//    mo=parseInt(mo);
//var pr=parseInt( prices[mo] );

    var pr = get_mod_price(ite);
//alert(pr);

//var pr=parseInt( prices[models.indexOf(ite)]);
//alert(pr*num);
    var ad = bask.push(ite + "#" + num + "#" + pr * num);
//alert(ad);
//alert($.toJSON(bask));


//$.cookie('the_cookie','');
    write_cookie();
//$("#resba").html(bask);
    show_basket();
    show_basket_big();



    //cookieList.add("ssa");
    //cookieList.add(2);
    //cookieList.remove(1);
    //var index = cookieList.indexOf(2);
    //var length = cookieList.length();

}
;

function add_item()
{

    var i = $("#items_amount").val();
    var j = parseInt(i);
    add_to_basket(chosen_item, i);
    hide_amount();

}

function cancel_add_item()
{
    hide_amount();
}

function am_inc()
{
    var i = $("#items_amount").val();
    var j = parseInt(i);
    j += 1;
    $("#items_amount").val(j);

}

function bapl_ch(id, val)
{
//alert(val);
    var b = bask[id].split("#");
    var pr = get_mod_price(b[0]);

    var res = b[0] + "#" + val + "#" + val * pr;

    bask[id] = res;
    write_cookie();
    show_basket();
    show_basket_big();

}

function bapl_inc(id)
{

    var b = bask[id].split("#");
    var j = parseInt(b[1]);
    j += 1;
    var pr = get_mod_price(b[0]);


    var res = b[0] + "#" + j + "#" + j * pr;

    bask[id] = res;
    write_cookie();
    show_basket();
    show_basket_big();

}

function bapl_dec(id)
{

    var b = bask[id].split("#");
    var j = parseInt(b[1]);
    if (j > 1)
        j -= 1;
    var pr = get_mod_price(b[0]);


    var res = b[0] + "#" + j + "#" + j * pr;

    bask[id] = res;
    write_cookie();
    show_basket();
    show_basket_big();

}


function am_dec()
{
    var i = $("#items_amount").val();
    var j = parseInt(i);
    if (j > 1)
        j -= 1;
    $("#items_amount").val(j);

}

//--------------------------------------- window load ---------------------------------------
$(window).load(function () {

// var reg =^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$;
    //var reg=/\(?\d{3}\)?([-\/\.])\d{3}\1\d{4}/;
//var result=reg.exec("921-933-4120");

//alert(result);


    jQuery('#mycarousel').jcarousel({
        auto: 4,
        scroll: 1,
        wrap: 'circular'

    });

    $("#tabs ul li").css({'outline': 'none'});

    $(document).mousemove(function (e) {
        mousex = e.pageX;
        mousey = e.pageY;
        //alert("ssss");
    }).mouseover();

    /*
     jQuery(function($){
     // $("#date").mask("99/99/9999");
     $("#phone").mask("(999) 999-9999");
     //  $("#tin").mask("99-9999999");
     //  $("#ssn").mask("999-99-9999");
     });
     */

    usdcurs = $("#curusd").html();
    usd_rate = $("#curusd").html();
    eur_rate = $("#cureur").html();

    bind_recalc_valute();

    // });

    /*
     //------------------------------------------------- zakaz but-------------------------------
     $(".zakazbut").bind("click",function(){

     chosen_item=$(this).attr('idm');
     var x=$(this).position().left;
     var y=$(this).position().top;

     //alert(pp);

     ask_kol(x, y);


     //window.location="/order.php?act=add&mod="+pp;



     });
     */
    read_cookie();
    show_basket();
    show_basket_big();
    read_cookie_compare();


    $("#emailsh").html("<a href=mailto:sales@rusavtomatika.com class=wei_link title='Отправьте нам сообщение по электронной почте'>sales@rusavtomatika.com</a>");
    $("#mailh1").html("<a href=mailto:sales@rusavtomatika.com class=wei_link title='Отправьте нам сообщение по электронной почте'>sales@rusavtomatika.com</a>");
    $("#emailsh1").html("<a href=mailto:support@rusavtomatika.com class=wei_link title='Отправьте нам сообщение по электронной почте'>support@rusavtomatika.com</a>");


}); //---------------------- end window load -------------------

function bind_recalc_valute()
{
    make_price_table();
    price_in_usd = 1;  // after page load all prices loaded into table in USD

    $(".val_name").bind("click", function () {

        recalc_valute();
        //alert("click");

    });

    $(".prpr").bind("click", function () {

        recalc_valute();

    });


}


function v_korzinu(o)
{
    console.log(o);
//alert(o.innerHTML);
//alert($(o).attr('idm'));
    chosen_item = $(o).attr('idm');
    var x = $(o).position().left;
    var y = $(o).position().top;
    ask_kol(x, y);

}

function ask_kol(x, y)
{
//var the=caller.id;
//alert(the.val());
//var x=50;//the.position().left;
//var y=50;//the.position().top;



    $("#amount_q").css('left', x);
    $("#amount_q").css('top', y);
    $("#amount_q").show();
    $("#modn").html(chosen_item);

    $("#items_amount").val(1);

//alert(model);
}

function hide_amount()
{
    $("#amount_q").hide();

}



