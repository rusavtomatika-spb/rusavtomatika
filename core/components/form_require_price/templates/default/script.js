$(document).ready(


    function () {



        $('.button_demand_price').on('click',function () {

            $('.component_form_require_price .text_model').html($(this).attr('data-rel-model'));
            $('.component_form_require_price').addClass('active');
            setTimeout(function () {
                $('.component_form_require_price').css('opacity', '1');
            }, 1);
        });



        $('.component_form_require_price .close_button').click(
            function () {
                let component = $(this).parents('.component_form_require_price');
                $(component).css('opacity','0');
                setTimeout(function () {
                    $(component).removeClass('active');
                },1000);
            }
        );

        $(".input_phone").mask("7 999 999 99 99");


    }
);


