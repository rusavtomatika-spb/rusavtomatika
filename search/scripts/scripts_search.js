/*$(document).ready(function () {
    all_functions();
});
////////////////////
function all_functions() {

    $("#form_search input.search_input").on({
        keydown: function (e) {
            if (e.which === 32)
                return false;
        },
        change: function () {
            this.value = this.value.replace(/\s/g, "");
        }
    });
    
    $(".search_panel_in_header .search_input").on({
        keydown: function (e) {
            if (e.which === 32)
                return false;
        },
        change: function () {
            this.value = this.value.replace(/\s/g, "");
        }
    });
    
$( ".search_panel_in_header .search_button" ).on( "click", function() {
  search_text = $('.search_panel_in_header .search_input').val();
  if(search_text.length > 0){  window.location.href = encodeURI("/search/?search="+search_text);}
});    
    $(document).on('input', '.search_panel_in_header .search_input', function () {
        word = $(this).val();
        if (word.length > 1) {
            setTimeout(my_post(word), 2000);

            function my_post(word)
            {
                $.post(
                        "/search/ajax/ajax_hints.php",
                        {
                            word: word,
                        },
                        onAjaxSuccess
                        );

            }
            String.prototype.replaceAll = function (search, replacement) {
                search = escapeRegExp(search);
                var target = this;
                return target.replace(new RegExp(search, 'g'), replacement);
            };
            function escapeRegExp(str) {
                return str.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
            }
            function onAjaxSuccess(data)
            {
                data = data.replaceAll(word.toUpperCase(), '<span class="highlight">' + word.toUpperCase() + '</span>')
                $('.search_hints').html(data);
                $('.search_hints').show();
                
                $('.search_panel_in_header .word_hint').click(function () {
                    console.log($(this).html());
                    $('.search_panel_in_header .search_input').val($(this).html().replace(/(<([^>]+)>)/ig, ""));
                    $('.search_panel_in_header .search_button').click();
                });
            }
        } else {
            $('.search_panel_in_header .search_hints').html("");
            $('.search_panel_in_header .search_hints').hide();
        }
    });
    

    $(document).on('input', '#form_search input.search_input[type="text"]', function () {
        word = $(this).val();
        if (word.length > 1) {
            setTimeout(my_post(word), 2000);

            function my_post(word)
            {
                $.post(
                        "/search/ajax/ajax_hints.php",
                        {
                            word: word,
                        },
                        onAjaxSuccess
                        );

            }
            String.prototype.replaceAll = function (search, replacement) {
                search = escapeRegExp(search);
                var target = this;
                return target.replace(new RegExp(search, 'g'), replacement);
            };
            function escapeRegExp(str) {
                return str.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
            }
            function onAjaxSuccess(data)
            {
                data = data.replaceAll(word.toUpperCase(), '<span class="highlight">' + word.toUpperCase() + '</span>')
                $('#hints').html(data);
                $('#hints .word_hint').click(function () {
                    console.log($(this).html());
                    $('#form_search input.search_input').val($(this).html().replace(/(<([^>]+)>)/ig, ""));
                    $('#form_search input[type=submit]').click();
                });
            }
        } else {
            $('#hints').html("");
        }
    });

}


*/

