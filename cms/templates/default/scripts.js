$(function () {
    $("#tabs").tabs();
});



$(function () {
    if ($(".block_floating").length > 0) {
        
        var topPos = $('.block_floating').offset().top - 20;
        var block_floating_height = $('.block_floating').height();
        $(window).scroll(function () {
            var top = $(document).scrollTop();
            var bottomBorderPos = $('#footer').offset().top - block_floating_height - 26;
            $('.column_block_specifications').css("height", $('.column_block_equipment').height());

            if (top > topPos && top < bottomBorderPos)
            {
                $('.block_floating').css('width', $('.block_floating').width());
                $('.column_block_specifications').css('min-height', $('.block_floating').height());
                $('.block_floating').removeClass('block_floating_fixed2');
                $('.block_floating').addClass('block_floating_fixed');
            } else
            if (top > topPos && top > bottomBorderPos)
            {
                $('.block_floating').css('width', $('.block_floating').width());
                $('.column_block_specifications').css('min-height', $('.block_floating').height());
                $('.block_floating').removeClass('block_floating_fixed');
                $('.block_floating').addClass('block_floating_fixed2');
                
            } else {
                $('.column_block_specifications').css('min-height', $('.block_floating').height());
                $('.block_floating').removeClass('block_floating_fixed');
                $('.block_floating').removeClass('block_floating_fixed2');
            }
        });
    }
});
$(function () {

    if ($(".block_specifications_link").length > 0) {
        $('.block_specifications_link').each(function () {
            data_rel = $(this).attr('data-rel');
            if (!$('.catalog_section_default_item').is('.' + data_rel)) {
                $(this).hide();
            }
        });
    }
    if ($(".block_section_roll").length > 0) {

        $('.block_menu_haiwell_content__haiwell_section_title').click(function () {
            href_url = $(this).attr('href');
            ar_section = href_url.split('#');
            section = ar_section[1];
            if ($(".block_section_roll." + section).length > 0) {
                $(".block_section_roll." + section).prev(".block_section_roll_link").click();
            }
        });



        $('.block_section_roll').each(function () {
            $(this).hide(0);
            $(this).removeClass("active");
        });
        $('.block_section_roll_link').click(function () {
            if ($(this).is('.active') && !$('.block_specifications_link').is('.active'))
            {
                $(this).removeClass('active');
                $(this).next('.block_section_roll').removeClass('active').hide(100);
                $('.block_section_roll').removeClass("active");
                $('.catalog_section_default_item').removeClass("active");
                $('.block_specifications_link').removeClass("active");
                history.pushState('', document.title, window.location.pathname);
            } else {
                $(this).addClass('active');
                $('.block_section_roll').removeClass("active");
                $('.block_section_roll_link').not(this).removeClass("active");
                $(this).next('.block_section_roll').addClass('active').show(100);
                $('.catalog_section_default_item').removeClass("active");
                $('.block_specifications_link').removeClass("active");
                $(this).next('.block_section_roll').find('.catalog_section_default_item').addClass("active");
                window.location.hash = $(this).attr("data-rel");
            }

            if ($(this).next('.block_section_roll').is(".active")) {
                $(this).addClass('active');
                $(this).next('.block_section_roll .catalog_section_default_item').addClass('active').show(100);
            }
            currentScrollTop = $(window).scrollTop();
//            elementScrollTop = $('.block_catalog_catalog_section_default').offset().top - 50;
            elementScrollTop = $(this).offset().top - 70;
            windowHeight = screen.height;
            //console.log(windowHeight + " ::: " + currentScrollTop + " :: " + elementScrollTop);
            if (currentScrollTop > elementScrollTop || elementScrollTop > windowHeight) {
                $('html, body').delay(150).animate({scrollTop: elementScrollTop}, 300);
            }

        });
    }

    if ($(".block_specifications_link").length > 0) {
        $('.block_specifications_link').click(function () {
            history.pushState('', document.title, window.location.pathname);
            data_rel = $(this).attr('data-rel');
            $(this).toggleClass("active");
            if ($(this).is(".active")) {
                $('.block_specifications_link').not(this).removeClass("active");
                $('.block_section_roll_link').removeClass("active");

                $('.catalog_section_default_item.' + data_rel).addClass("active");
                parent = $('.catalog_section_default_item.' + data_rel).parent();
                $(parent).addClass("active").show(100);
                $(parent).parent().find(".block_section_roll_link").addClass("active");
                $('.catalog_section_default_item:not(.' + data_rel + ')').removeClass("active");

                /*                currentScrollTop = $(window).scrollTop();
                 elementScrollTop = $('.block_catalog_catalog_section_default').offset().top - 50;
                 if (currentScrollTop > elementScrollTop) {
                 $('html, body').delay(150).animate({scrollTop: elementScrollTop}, 300);
                 //console.log();
                 }
                 */
                currentScrollTop = $(window).scrollTop();
                elementScrollTop = $('.catalog_section_default_item.' + data_rel).offset().top - 70;
                windowHeight = screen.height;
                if (currentScrollTop > elementScrollTop || elementScrollTop > windowHeight) {
                    $('html, body').delay(150).animate({scrollTop: elementScrollTop}, 300);
                }

            } else {
                $('.catalog_section_default_item.' + data_rel).removeClass("active");
                $('.block_section_roll_link').removeClass("active");
            }
        });
        if (document.location.hash != '') {
            section = document.location.hash;
            section = section.replace("#", "");
            if ($(".block_section_roll." + section).length > 0) {
                $(".block_section_roll." + section).prev(".block_section_roll_link").click();
            }

        }




    }
    /*
     $(".ui-tabs-anchor").bind("click", function (event) {
     event.stopPropagation();
     //window.location.hash = 'tab-files';
     window.location.hash = $(this).attr("href");
     event.preventDefault();
     event.stopPropagation();
     });
     */

});