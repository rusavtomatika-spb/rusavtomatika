$(function(){
    $(window).scroll(function() {
        if($(this).scrollTop() >= 10) {
            $('.sticky_header_wrapper').addClass('stickytop');
        }
        else{
            $('.sticky_header_wrapper').removeClass('stickytop');
        }
    });
});

