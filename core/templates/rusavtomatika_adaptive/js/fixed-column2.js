$(document).ready(function ()
{
    if ($("div").is("#float_block")) {
        var offset = 0;
        var offset_bottom = 0;
        var height_content_left = $('.component_catalog_section').outerHeight();
        var height_float_block = $('#float_block').outerHeight();
        if (height_content_left > height_float_block)
        {
            offset = 10;
            offset_bottom = 170;
            var topPos = $('#float_block').offset().top - offset;

            if($('#float_block').outerHeight() > window.innerHeight - 270){
                $('#float_block .filter_panel').css({'height': window.innerHeight - 270, 'overflow-y': 'scroll'});
            }
            $(window).scroll(function () {

                var top = $(document).scrollTop(),
                        pip = $('.component_catalog_section__bottom_of_list').offset().top;
                height = $('#float_block').outerHeight();

                left_col_height = $('.float_block_wrapper').outerHeight(); 
                main_content_height = $('.component_catalog_section').outerHeight()-100;

                if (top > topPos && top < pip - height && left_col_height < main_content_height) {
                    $('#float_block').addClass('fixed_block2');//.removeAttr("style");
                    $('#float_block').css({'position': 'fixed', 'bottom': 'auto'});
                    if($('#float_block .filter_panel').outerHeight() > (window.innerHeight - 280)) {
                        $('#float_block .filter_panel').css({'height': window.innerHeight - 50, 'overflow-y': 'scroll'});
                    }
               }
                else if ((top > pip - height) && (left_col_height-100 < height)) {
                    $('#float_block').removeClass('fixed_block2').css({'position': 'absolute', 'bottom': '109px'});
                    if($('#float_block .filter_panel').outerHeight() > window.innerHeight - 260){
                        $('#float_block .filter_panel').css({'height': window.innerHeight - 260, 'overflow-y': 'scroll'});
                    }
                }
                else {
                    $('#float_block').removeClass('fixed_block2');
                    if($('#float_block .filter_panel').outerHeight() > window.innerHeight - 270){
                        $('#float_block .filter_panel').css({'height': window.innerHeight - 270, 'overflow-y': 'scroll'});
                    }
                }
            });
        }
    }
});

