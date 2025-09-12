$(function () {
    height = $(window).height();
    $('object#pdf_object embed').css("height", height - height / 10);

    $(window).resize(function () {
        height = $(window).height();
        $('object#pdf_object embed').css("height", height - height / 10);
    });

});
$(function () {
    if ($(".block_floating").length > 0) {
        window_height = $(window).height();
        block_floating_height = $('div.block_floating').height();
        if (block_floating_height > window_height) {
            $('div.block_floating').height(window_height - window_height / 10);
            $('div.block_floating').css('overflow-y', 'scroll');
        }

        $(window).scroll(function () {
            var topPos = $('.block_floating').offset().top - 20;
            var block_floating_height = $('.block_floating').height();
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
    $(".weintek-easybuilderpro-user-manual-en__menu .anchor .tree-plus").bind("click", function () {
        $(this).toggleClass('opened');
        $(this).parent().toggleClass('opened');
        $(this).parent().next('ul').toggle(50);
        return false;
    });
    $('.weintek-easybuilderpro-user-manual-en__menu a.chapter').each(function (i, elem) {
        what_search = window.location.pathname;
        where_search = $(elem).attr("href");
        if (where_search == what_search) {
            $(elem).addClass('active');
            $('.weintek-easybuilderpro-user-manual-en__menu ul').hide(50);
            $(elem).parent().children('ul').show(50);
            set_parents = $(elem).parents('ul');
            $(set_parents).show(50);
            $(set_parents).prev('.chapter').addClass('active');
        }
    });
    if (location.hash) {
        hash = location.hash;
        hash = hash.replace(/^#/, '');
        console.log(hash);
        current_item = $(".weintek-easybuilderpro-user-manual-en__menu .anchor[data-rel='" + hash + "']");
        ul_parent = $(current_item).parent().parent().parent().children('.anchor.parent');
        $(ul_parent).addClass('opened');
        $(ul_parent).children('.tree-plus').addClass('opened');
        $(ul_parent).next('ul').show(50);
        console.log(ul_parent);
        $(current_item).click();
        $(current_item).addClass('active');
    }
    $('.weintek-easybuilderpro-user-manual-en__menu .anchor').click(function () {
        $(".weintek-easybuilderpro-user-manual-en__menu .anchor").not(this).removeClass('active');
        parent_ul = $(this).parent().parent();
        $(parent_ul).show();
        $(this).addClass('active');
        hash = $(this).attr('data-rel');
        if (hash && ($('h1').is('#' + hash) || $('h3').is('#' + hash) || $('h2').is('#' + hash))) {
            var scrollTop = $("#" + hash).offset().top - 10;
            var body = $("html, body");
            body.stop().animate({scrollTop: scrollTop}, 500, 'swing', function () {});
            location.hash = hash;
        }
    });
});
