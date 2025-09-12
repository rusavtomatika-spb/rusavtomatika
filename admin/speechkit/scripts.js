$(function () {

    $("#symbol_counter").html($("#textarea_text_to_speech").val().length);
    do_textarea();



    $('#textarea_text_to_speech').bind('input propertychange', function () {
        do_textarea();
    });

    function do_textarea() {
        const symbol_counter = $("#textarea_text_to_speech").val().length;
        if (symbol_counter > 5000) {
            $("#symbol_counter").css("color", "red");
            $("input[type=submit]").attr("disabled", "disabled");
            console.log("disabled");
        } else if (symbol_counter < 2) {
            $("input[type=submit]").attr("disabled", "disabled");
            console.log("disabled");
        } else {
            $("#symbol_counter").css("color", "");
            $("input[type=submit]").removeAttr('disabled');
            console.log("no disabled");
        }
        $("#symbol_counter").html(symbol_counter);
        console.log(symbol_counter);
    }


    $('.clear_text_button').bind('click', function () {
        $("input[type=submit]").attr("disabled", "");
        $("textarea#textarea_text_to_speech").val("").focus();
    });


    $("form[name=form_text_to_speech]").submit(function (e) {
        var form = $(this);
        $(this).children('input[type=submit]').attr('disabled', 'disabled');
        $('#responce').html('<img style="height: 280px;" class="loading" src="/admin/products_all/loading.gif" />');
        var text = $("textarea#textarea_text_to_speech").val();
        var token = $("textarea#token").val();
        var fd = new FormData;
        fd.append('text', text);
        fd.append('token', token);
        //$("#loading_informer").html('');
        $.ajax({
            type: "POST",
            url: "/admin/speechkit/ajax_speechkit.php",
            contentType: false,
            processData: false,
            data: fd,
            //dataType: 'json',
            success: function (jsonData) {
                console.log(jsonData);
                result = JSON.parse(jsonData);

                /*arData = data.split("<!--json-->");
                if (arData.length > 1) {
                    jsonData = arData[1];
                    
                } else {
                    result = arData[0];
                }*/
                //$("#loading_informer").html("готово");
                $("#responce").html(result['buffer']);
                $('.player_audio').get(0).play();

            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
});

