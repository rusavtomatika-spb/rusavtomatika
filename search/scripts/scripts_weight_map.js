$(document).ready(function () {
    all_functions();
});
////////////////////
function all_functions() {
    add_event_on_edit_row();
}

function add_event_on_edit_row() {
    $('.weight_map_list_table tr.edit_row td:not(.read_only)').dblclick(event_field);
}





$('#add_new_row').click(function () {
    table = $('table.weight_map_list_table');
    newRow = table[0].insertRow(-1);
    $(newRow).attr('id', 'new');
    $(newRow).addClass('edit_row');
    newCell = newRow.insertCell(0);
    $(newCell).addClass('read_only');
    let newText = document.createTextNode('new');
    newCell.appendChild(newText);
    
    newCell = newRow.insertCell(1);
    $(newCell).attr('data-rel-field_name','url');
    newText = document.createTextNode('url');
    newCell.appendChild(newText);
    
    newCell = newRow.insertCell(2);
    newText = document.createTextNode('weight');
    $(newCell).attr('data-rel-field_name','weight');
    newCell.appendChild(newText);
    
    newCell = newRow.insertCell(3);
    newText = document.createTextNode('position');
    $(newCell).attr('data-rel-field_name','position');
    newCell.appendChild(newText);
    $(newRow).children('td:not(.read_only)').dblclick(event_field);
    
    
});



function event_field() {

        if ($(this).hasClass('in_editing')) {
        } else {
            current_row_id = $(this).parent().attr('id');
            current_row_tr_class = $(this).attr('class');
            data_rel_field_name = $(this).attr('data-rel-field_name');
            current_row_tr_value = $(this).html();
            $(this).addClass('in_editing');
            $(this).html(
                    '<input id="input_' + current_row_id + '"'
                    + ' type="text" value="' + current_row_tr_value + '"'
                    + 'data-rel-row_id="' + current_row_id + '"'
                    + 'data-rel-field_name="' + data_rel_field_name + '"'
                    + ' />');
            input = $(this).children('#input_' + current_row_id);
            $(input).attr('data-rel-oldvalue', current_row_tr_value);
            $(input).focus();
            $(input)[0].setSelectionRange(0, 1000);
            /////////////////////////////////////////////////////

            $(document).keypress(function (e) {
                if (e.which == 13) {
                    $(".weight_map_list_table input:focus").focusout();

                }
            });

            $('#input_' + current_row_id).focusout(function () {
                value = $(this).val();
                old_value = $(this).attr('data-rel-oldvalue');
                field_name = $(this).attr('data-rel-field_name');
                id = $(this).attr('data-rel-row_id');
                td = $(this).parent();
                $(td).removeClass('url in_editing');
                $(td).html(value);
                if (value !== old_value) {
                    $.post(
                            "/search/ajax/ajax_weight_map.php",
                            {
                                action: "edit_field",
                                id: id,
                                field_name: field_name,
                                value: value,
                                old_value: old_value,
                            },
                            onAjaxSuccess
                            );
                }

            });
            /////////////////////////////////////////////////////


        }
        function onAjaxSuccess(data)
        {
            var res = JSON.parse(data);
            if (res.status == 1) {
                if(res.new_id > 0){
                    $('.weight_map_list_table tr#new').attr('id', res.new_id);
                    $('.weight_map_list_table tr#'+res.new_id +' td:first-child').html(res.new_id);
                   
                }
            } else
            {
                $('.weight_map_list_table tr#' + res.id + ' td[data-rel-field_name="' + res.field_name + '"]').html(res.old_value);
                if (res.is_error)
                    alert(res.buffer);
            }
        }

        
}

$('.weight_map_list_table .button_delete').click(function () {
    id = $(this).attr('data-rel-id');
    result = confirm("Удалить строку id " + id + " ?");    
    if (result) {
        
        $.post(
                "/search/ajax/ajax_weight_map.php",
                {
                    action: "delete_row",
                    id: id,
                },
                onAjaxSuccess
                );
        function onAjaxSuccess(data)
        {
            var res = JSON.parse(data);
            if (res.status == 1) {
                if(res.id > 0){
                    $('.weight_map_list_table tr#'+res.id).remove();
                }
            } else
            {
            }
        }
    }
});




