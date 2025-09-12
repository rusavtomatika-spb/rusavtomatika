
$(function () {

$('form[name=formUploadImage] input[type=file]')
            .bind('input propertychange', function () {
                button = $(this).parent().children("input[type=submit]");
                if ($(this).val())
                {
                    $(button).removeAttr('disabled');
                } else {
                    $(button).attr('disabled', 'disabled');
                }
});
$('form[name=formUploadImage2] input[type=file]')
            .bind('input propertychange', function () {
                button = $(this).parent().children("input[type=submit]");
                if ($(this).val())
                {
                    $(button).removeAttr('disabled');
                } else {
                    $(button).attr('disabled', 'disabled');
                }
});




    $(window).scroll(function () {
        if ($(this).scrollTop() >= 140) {
            $('.sticky').addClass('stickytop');
        } else {
            $('.sticky').removeClass('stickytop');
        }
    });

    $(".check_delete").click(function () {

        id = $(this).parent().parent().find("td.id").html();
        name = $(this).parent().parent().find("td.name").html();
        code = $(this).parent().parent().find("td.code").html();
        //confirm("!!!");
        if (confirm('Вы уверены, что хотите удалить?\n"id' + id + ' ' + name + ' - ' + code + '"'))
        {
            return true;
        } else
            return false;
    });

    $(".translit_code").click(function () {
        name = $("input[name='name']").val();
        name = name.toLowerCase();
        name = cyr2lat(name);
        $(this).parent().parent().find("input[name='code']").val(name);
        return false;
    });
    $("input[name='name']").change(function () {
        $(".translit_code").click();
    });



    if ($("label").length > 0) {
        $('label').each(function () {
            checked = $(this).prev("input[type='checkbox']:checkbox:checked");
            if ($(checked).length > 0) {
                $(this).addClass("active");
            }
        });
    }
    $("input[type='checkbox']").change(function () {
        var checked = $(this).is(':checked');
        if (checked) {
            $(this).addClass("active");
            $(this).next("label").addClass("active");
        } else {
            $(this).removeClass("active");
            $(this).next("label").removeClass("active");
        }
    });


/**/
$("form[name=formUploadImage]").submit(function (e) {
        var form = $(this);
        $(this).children('input[type=submit]').attr('disabled', 'disabled');
        var uploadfile = $(this).children("input[type=file]").prop('files')[0];
        var product_id = $(this).children("input[name=product_id]").val();
        var fd = new FormData;
        fd.append('img', uploadfile);
        fd.append('product_id', product_id);
        $("#product_id_" + product_id).html('<img class="loading" src="/admin/products_all/loading.gif" />');
        $.ajax({
            type: "POST",
            url: "/admin/products_all/ajax_products_all.php",
            contentType: false,
            processData: false,             
            data: fd,
            //dataType: 'json',
            success: function (jsonData)
            {
                console.log(jsonData);
                console.log(jsonData["product_id"]);
                result = JSON.parse(jsonData);
                /*arData = data.split("<!--json-->");
                if (arData.length > 1) {
                    jsonData = arData[1];
                    
                } else {
                    result = arData[0];
                }*/
                $("#product_id_" + result["product_id"]).html(result["images"]);
                $("form[name=formUploadImage] input[type=file]").val("");
                
                
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
/**/

/**/
$("form[name=formUploadImage2]").submit(function (e) {
        var form = $(this);
        $(this).children('input[type=submit]').attr('disabled', 'disabled');
        var uploadfile = $(this).children("input[type=file]").prop('files')[0];
        var product_id = $(this).children("input[name=product_id]").val();
        var fd = new FormData;
        fd.append('img', uploadfile);
        fd.append('product_id', product_id);
        $("#product_id_" + product_id).html('<img class="loading" src="/admin/controllers/loading.gif" />');
        $.ajax({
            type: "POST",
            url: "/admin/controllers/ajax_controllers.php",
            contentType: false,
            processData: false,             
            data: fd,
            //dataType: 'json',
            success: function (jsonData)
            {
                console.log(jsonData);
                console.log(jsonData["product_id"]);
                result = JSON.parse(jsonData);
                /*arData = data.split("<!--json-->");
                if (arData.length > 1) {
                    jsonData = arData[1];
                    
                } else {
                    result = arData[0];
                }*/
                $("#product_id_" + result["product_id"]).html(result["images"]);
                $("form[name=formUploadImage2] input[type=file]").val("");
                
                
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
/**/

});

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