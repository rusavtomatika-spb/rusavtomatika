var counter;
$(document).ready(function () {
    all_functions();

});

$(document).ajaxComplete(function () {
    $('*').unbind();
    all_functions();
});
////////////////////
function all_functions() {
    
    $.each($('.block_spoiler'), function (index, current_block) {
        $(current_block).find('.block_spoiler_show_hide').click(function () {
            $(this).parent().toggleClass('opened');
        });
    });

////////////////////////////
    $("#form_add_page").submit(function (e) {
        var form = $(this);
        $('#form_add_page_result').html("sending request...");
        $('#form_add_page_result_buffer').html("");
        $.ajax({
            type: "POST",
            url: "/search/ajax/ajax_form_add_page.php",
            data: form.serialize(), // serializes the form's elements.
            success: function (data)
            {
                console.log(data);
                var res = JSON.parse(data);
                if (res.status == 1) {
                    $('#form_add_page_result').html(res.result);                    
                    $('#form_add_page_result_buffer').html("***"+res.buffer+"***");
                }else{
                    $('#form_add_page_result').html(res.result);                    
                    $('#form_add_page_result_buffer').html("***"+res.buffer+"***");
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
////////////////////////////
////////////////////////////
    $("#form_add_pages_from_xml").submit(function (e) {
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "/search/ajax/ajax_add_pages_from_xml.php",
            data: form.serialize(), // serializes the form's elements.
            success: function (data)
            {
                var res = JSON.parse(data);

                if (res.status == 1) {
                    $('#form_add_page_result_buffer').html("");
                    $('.status_panel .status').html("");
                    $('#rest_rows').html(res.rest_rows);
                    $('#result_of_form_add_pages_from_xml').html(res.buffer);
                    
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
////////////////////////////

    $('#button_start').click(function () {
        clearInterval(counter);
        $("#work_timer_life").html('0');
        counter = setInterval(incrementSeconds, 1000);
        $('#panel_adding_pages_from_xml_processing').removeClass('finished');
        $('#panel_adding_pages_from_xml_processing').addClass('processing');
        $('#button_start').attr("disabled", "disabled");
        if (!$('#work_timer').hasClass('started')) {
            $('#work_timer').attr("data-rel", Date.now());
            $('#work_timer').addClass('started');
        }

        //$('#panel_adding_pages_from_xml_processing .status').html("Запрос отправлен");
        $.post(
                "/search/ajax/ajax_pages_from_xml_do_process.php",
                {
                    action: "add_page",
                },
                onAjaxSuccess
                );

        function onAjaxSuccess(data)
        {
            var res = JSON.parse(data);

            if (res.status == 1) {
                $('#rest_rows').html(res.rest_rows);
                $('#button_start').removeAttr("disabled");
                $('#panel_adding_pages_from_xml_processing .status').html("Запрос выполнен " + res.time + '<br>' + res.url + ' ' + '<br>' + res.buffer);
                if ($('#button_stop').attr("disabled")) {
                    $('#button_stop').removeAttr("disabled");
                } else {
                    if (res.rest_rows > 0) {
                        setTimeout(function () {
                            $('#button_start').click();
                        }, 100);
                    } else {
                        $('#panel_adding_pages_from_xml_processing').removeClass('processing')
                        $('#panel_adding_pages_from_xml_processing').addClass('finished');
                    }

                }
                start = Number($('#work_timer').attr("data-rel"));
                $('#work_timer').html((Date.now() - start) / 1000 + "s.");


            }

        }
    });

    $('#button_stop').click(function () {
        $('#button_start').removeAttr("disabled");
        $('#button_stop').attr("disabled", "disabled");
        $('#work_timer').removeClass('started');
        $('#panel_adding_pages_from_xml_processing').removeClass('processing')
        $('#panel_adding_pages_from_xml_processing').removeClass('finished');

    });

    $('#clear_text_search_index_sitemap_filter_text').click(function () {
        $('input[name=search_index_sitemap_filter_text]').val("");
    });

    $('#button_start_confirm').click(function () {
        $(this).attr("disabled", "disabled");
        $('#button_start_truncating').removeAttr("disabled");
        $('#button_start_truncating').show();
    });


////////////////////////////////////////////////////////////////////////////////
    $('#button_start_truncating').click(function () {
        $(this).attr("disabled", "disabled");
        $.post(
                "/search/ajax/ajax_truncate_tables.php",
                {
                    action: "truncate_tables",
                },
                onAjaxSuccess
                );

        function onAjaxSuccess(data)
        {
            var res = JSON.parse(data);

            if (res.status == 1) {
                $('#panel_truncate_tables .truncate_tables_status').html("Очистка таблиц выполнена" + '<br>' + res.buffer);
                $('#button_start_truncating').hide();
                $('#button_start_confirm').removeAttr("disabled");
            } else
            {
                $('#panel_truncate_tables .truncate_tables_status').html("Что-то пошло не так!" + '<br>' + res.buffer);
            }
        }
    });

////////////////////////////////////////////////////////////////////////////////

}

function incrementSeconds() {
    seconds = parseInt($("#work_timer_life").html());;
    seconds += 1;
    $("#work_timer_life").html(seconds)
}



