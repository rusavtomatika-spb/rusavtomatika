var cur_ind = 0;
var list_length = 0;
var mouseoutside = 0;
var search_bgcolor = "#efefef";
var search_bgcolor_sel = "#cccccc";
var mouse_in_basket = 0;
var mouse_in_basket_sm = 0;

var search_textcolor = "black";



$(document).ready(function () {


    $("#tete").focusout(function () {

        if ($("#tete").val() == "")
            $("#tete").val("поиск по каталогу...");
    });

    $("#tete").keyup(function (e) {
//alert(e.keyCode);
        if (e.keyCode != 40 && e.keyCode != 38)
            sch();
    });

    $("body").mouseup(function () {
        if (mouseoutside == 1) {
            $("#sho").html("");
            $("#sho").hide();
        }
        if (mouse_in_basket == 0 && mouse_in_basket_sm == 0) {
            $("#slided").slideUp("fast");
            basket_opened = 0;
        }

    });

    $("#slided").hover(
            function () {
                mouse_in_basket = 1;
            },
            function () {
//if(mouse_in_basket_sm==1) return;
                mouse_in_basket = 0;
                $("#slided").slideUp("fast");
                basket_opened = 0;

            });

    $("#basket_small").hover(
            function () {
                mouse_in_basket_sm = 1;
            },
            function () {
                mouse_in_basket_sm = 0;

            });


}); //---end document ready



function se_click()
{
//alert( $("#tete").val());
    if ($("#tete").val() == "поиск по каталогу...")
        $("#tete").val("");

}


function sch()  // search and make list
{
    var ww = $("#tete").val();
    var out = "";
//if( $("#tete").val()=="") $("#tete").val("поиск...");
    var i = 0;
    if (ww != "")
    {
        $.each(smodels, function () {

            var str = this.toLowerCase();


            if (str.indexOf(ww.toLowerCase()) >= 0)
            {
                out += "<div class=sel id=sel" + i + ">" + this + "</div>";
                i++;
            }

        });

        list_length = i;
        if (out != "")
        {
            $("#sho").html(out);
            $("#sho").show();
        } else
            $("#sho").hide();
    } else {
        $("#sho").html("");
        list_length = 0;
        cur_ind = 0;
        $("#sho").hide();
    }

//----bind hover ------
    $(".sel").hover(
            function () {
                $(".sel").css('background-color', search_bgcolor);
                $(this).css('background-color', search_bgcolor_sel);
                var mod = $(this).html();
                $("#tete").val(mod);  // model name into search field

                mouseoutside = 0;
            },
            function () {
                mouseoutside = 1;
            }
    );




    $(".sel").click(function (event) {

        var el = event.target.id;
        // el2=el.substr(3);

        if ($("#tete").val() == "")
            $("#tete").val("поиск...");

        var mod = $("#" + el).html();
        $("#tete").val(mod);
        $("#sho").html("");
        $("#sho").hide();

        // window.location="http://www.rusavtomatika.com?hhh="+mod;
        gotosearch();
        //alert(mod);
    });

}//--------------end func sch -----




$(document).keyup(function (e) {
    if (e.keyCode == 40) {

        if (cur_ind <= list_length + 1 && list_length > 0)
        {

            cur_ind++;

            if (cur_ind < list_length + 1)
            {
                $(".sel").css('background-color', search_bgcolor);
                $("#sel" + (cur_ind - 1)).css('background-color', search_bgcolor_sel);
                var mod = $("#sel" + (cur_ind - 1)).html();
                $("#tete").val(mod);  // model name into search field

            }
            $("#sst").html("id" + cur_ind);


        }

    } else if (e.keyCode == 38) {

        if (cur_ind > 1)
        {

            cur_ind--;

            $(".sel").css('background-color', search_bgcolor);
            $("#sel" + (cur_ind - 1)).css('background-color', search_bgcolor_sel);
            var mod = $("#sel" + (cur_ind - 1)).html();
            $("#tete").val(mod);  // model name into search field

            $("#sst").html("id" + cur_ind);

        }

    }

    if (e.keyCode == 13)
    {

        if ($("#tete").is(':focus')) {
            gotosearch();
            return;
        } else
            return;

        var sea = $("#tete").val();
        if (sea == "")
            return;
        $("#sho").html("");
        $("#sho").hide();
        cur_ind = 0;
        list_length = 0;
        window.location = "/weintek/" + sea + ".php";


    }
    ;


});


function gotosearch()
{
    var sea = $("#tete").val();
    if (sea == "")
        return;
    var res = "";
    var path = "";
    var realmod = "";
    var no_php = 0;

    $.each(smodels, function () {

// var str=this.toLowerCase();
        var str = this;
        if (str == sea)
            res = str;
    });


    //str.indexOf(ww.toLowerCase() )
    if (res.indexOf("MT") >= 0) {
        path = "/weintek/";
    } else if (res.indexOf("Haiwell") >= 0) {
        path = "/plc/haiwell";
        realmod = res.replace("Haiwell", "");
        realmod = realmod.replace("<b>", "");
        realmod = realmod.replace("</b>", "");
        arRealmod = realmod.split('/');
        section = arRealmod[1];
        element = cyr2lat(arRealmod[2]);
        realmod = "/" + section + "/" + element.toLowerCase() + "/";
        no_php = 1;
    } else if (res.indexOf("mTV") >= 0) {
        path = "/weintek/";
    } else if (res.indexOf("SK") >= 0) {
        path = "/samkoon/";
    } else if (res.indexOf("EA-") >= 0) {
        path = "/samkoon/";
    } else if (res.indexOf("AK-") >= 0) {
        path = "/samkoon/";
    } else if (res.indexOf("OP-835") >= 0) {
        path = "/samkoon/";
    } else if (res.indexOf("IFC") >= 0) {
        if (res.indexOf("RF") >= 0) {
            path = "/panelnie-computery/ifc/";
        } else if (res.indexOf("i3") >= 0) {
            path = "/panelnie-computery/ifc/";
        } else if (res.indexOf("BOX") >= 0) {
            path = "/promyshlennye-kompyutery-box-pc/";
        } else if (res.indexOf("IFC-M") >= 0) {
            path = "/monitors/";
        }
    } else if (res.indexOf("COSY") >= 0) {
        path = "/ewon/";
    } else if (res.indexOf("FLEXY") >= 0) {
        path = "/ewon/";
    } else if (res.indexOf("COSY") >= 0) {
        path = "/ewon/";
    } else if (res.indexOf("eFive") >= 0) {
        path = "/ewon/";
    } else if (res.indexOf("ARCH") >= 0) {
        path = "/panelnie-computery/aplex/";
    } else if (res.indexOf("APC-") >= 0) {
        path = "/panelnie-computery/aplex/";
    } else if (res.indexOf("CV-1") >= 0) {
        path = "/cincoze/";
    } else if (res.indexOf("DA") >= 0) {
        path = "/cincoze/";
        realmod = "DA-1000";
    } else if (res.indexOf("DC") >= 0) {
        path = "/cincoze/";
        realmod = "DC-1100";
    } else if (res.indexOf("DS") >= 0) {
        path = "/cincoze/";
        if (res.indexOf("1002") >= 0) {
            realmod = "DS-1002";
        }
        if (res.indexOf("MEC") >= 0) {
            realmod = "DS-1002";
        }
    } else if (res.indexOf("A-") >= 0) {
        path = "/plc/yottacontrol/";
    } else if (res.indexOf("ARMPAC-") >= 0) {
        path = "/panelnie-computery/aplex/";
    } else if (res.indexOf("EBM-A") >= 0) {
        path = "/modules/";
    } else if (res.indexOf("iR-") >= 0) {
        path = "/plc/weintek/";
    } else if (res.indexOf("Indoor") >= 0) {
        path = "/";
        realmod = "HMI-android.php";
    } else if (res.indexOf("Faraday") >= 0) {
        path = "/bloki-pitaniya/faraday/";
        if (res.indexOf("12W/12-24V/DIN") >= 0) {
            realmod = "faraday-12W-din.php";
        } else if (res.indexOf("18W/12-24V/78AL") >= 0) {
            realmod = "faraday-18W.php";
        } else if (res.indexOf("36W/12-24V/95AL") >= 0) {
            realmod = "faraday-36W";
        } else if (res.indexOf("36W/12-24V/DIN") >= 0) {
            realmod = "faraday-36W-din.php";
        } else if (res.indexOf("50W/12-24V/120AL") >= 0) {
            realmod = "faraday-50W.php";
        } else if (res.indexOf("50W/12-24V/DIN") >= 0) {
            realmod = "faraday-50W-din.php";
        } else if (res.indexOf("75W/12-24V/140AL") >= 0) {
            realmod = "faraday-75W.php";
        } else if (res.indexOf("75W/12-24V/DIN") >= 0) {
            realmod = "faraday-75W-din.php";
        } else if (res.indexOf("150W/24V") >= 0) {
            realmod = "faraday-150W";
        } else if (res.indexOf("UPS 75W Simple") >= 0) {
            realmod = "faraday-ups-75w-simple";
        } else if (res.indexOf("UPS 30W Simple 13.8V") >= 0) {
            realmod = "faraday-ups-30w-simple";
        } else if (res.indexOf("UPS 30W Simple 24V") >= 0) {
            realmod = "faraday-ups-30w-simple-24v";
        }  
        
    }

    // alert(path);
    if (res == "")
        return;
    $("#sho").html("");
    $("#sho").hide();
    cur_ind = 0;
    list_length = 0;
    if (!no_php) {
        if (realmod == "")
            window.location = path + res + ".php";
        else
            window.location = path + realmod + ".php";
    } else {
        window.location = path + realmod;
    }
}


function ddd() {

    $("#sel" + (cur_ind - 1)).css('background-color', ' #ffffcc;');
    alert("grey");
}


function cyr2lat(str)
{
    var cyr2latChars = new Array(['а', 'a'], ['б', 'b'], ['в', 'v'], ['г', 'g'],
            ['д', 'd'], ['е', 'e'], ['ё', 'yo'], ['ж', 'zh'], ['з', 'z'],
            ['и', 'i'], ['й', 'y'], ['к', 'k'], ['л', 'l'],
            ['м', 'm'], ['н', 'n'], ['о', 'o'], ['п', 'p'], ['р', 'r'],
            ['с', 's'], ['т', 't'], ['у', 'u'], ['ф', 'f'],
            ['х', 'h'], ['ц', 'c'], ['ч', 'ch'], ['ш', 'sh'], ['щ', 'shch'],
            ['ъ', ''], ['ы', 'y'], ['ь', ''], ['э', 'e'], ['ю', 'yu'], ['я', 'ya'],
            ['А', 'A'], ['Б', 'B'], ['В', 'V'], ['Г', 'G'],
            ['Д', 'D'], ['Е', 'E'], ['Ё', 'YO'], ['Ж', 'ZH'], ['З', 'Z'],
            ['И', 'I'], ['Й', 'Y'], ['К', 'K'], ['Л', 'L'],
            ['М', 'M'], ['Н', 'N'], ['О', 'O'], ['П', 'P'], ['Р', 'R'],
            ['С', 'S'], ['Т', 'T'], ['У', 'U'], ['Ф', 'F'],
            ['Х', 'H'], ['Ц', 'C'], ['Ч', 'CH'], ['Ш', 'SH'], ['Щ', 'SHCH'],
            ['Ъ', ''], ['Ы', 'Y'],
            ['Ь', ''],
            ['Э', 'E'],
            ['Ю', 'YU'],
            ['Я', 'YA'],
            ['a', 'a'], ['b', 'b'], ['c', 'c'], ['d', 'd'], ['e', 'e'],
            ['f', 'f'], ['g', 'g'], ['h', 'h'], ['i', 'i'], ['j', 'j'],
            ['k', 'k'], ['l', 'l'], ['m', 'm'], ['n', 'n'], ['o', 'o'],
            ['p', 'p'], ['q', 'q'], ['r', 'r'], ['s', 's'], ['t', 't'],
            ['u', 'u'], ['v', 'v'], ['w', 'w'], ['x', 'x'], ['y', 'y'],
            ['z', 'z'],
            ['A', 'A'], ['B', 'B'], ['C', 'C'], ['D', 'D'], ['E', 'E'],
            ['F', 'F'], ['G', 'G'], ['H', 'H'], ['I', 'I'], ['J', 'J'], ['K', 'K'],
            ['L', 'L'], ['M', 'M'], ['N', 'N'], ['O', 'O'], ['P', 'P'],
            ['Q', 'Q'], ['R', 'R'], ['S', 'S'], ['T', 'T'], ['U', 'U'], ['V', 'V'],
            ['W', 'W'], ['X', 'X'], ['Y', 'Y'], ['Z', 'Z'],
            [' ', '-'], ['0', '0'], ['1', '1'], ['2', '2'], ['3', '3'],
            ['4', '4'], ['5', '5'], ['6', '6'], ['7', '7'], ['8', '8'], ['9', '9'],
            ['-', '-']);

    var newStr = new String();

    for (var i = 0; i < str.length; i++) {

        ch = str.charAt(i);
        var newCh = '';
        for (var j = 0; j < cyr2latChars.length; j++) {
            if (ch == cyr2latChars[j][0]) {
                newCh = cyr2latChars[j][1];
            }
        }
        // Если найдено совпадение, то добавляется соответствие, если нет - пустая строка
        newStr += newCh;
    }
    // Удаляем повторяющие знаки - Именно на них заменяются пробелы.
    // Так же удаляем символы перевода строки.
    return newStr.replace(/[-]{2,}/gim, '-').replace(/\n/gim, '');
}