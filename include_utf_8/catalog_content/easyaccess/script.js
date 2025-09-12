(function () {
    if ($("#vue_app_easyaccess").length > 0) {
        var app = new Vue({
            el: '#vue_app_easyaccess',
            data: {
                current_section: 1,
            },
            created: function () {
            },
            mounted: function () {
                this.$nextTick(function () {
                    this.init();
                });
            }
            ,
            methods: {
                init() {
                },
                change_section(num) {
                    this.current_section  = num;
                },
            },
        });


    }
})();





















































/*
(function ($) {
    $(function () {
        var widthlist = $('.tabs__guide__caption').width() - 2;
        let tab_hight = $('.tabs__guide__caption').height();
        $('.tabs__guide__content').css("marginLeft", widthlist);
        window.onload = function () {
            asd = $('.tabs__guide.vertical').height();

            var topblocktabs = $('.tabs__guide').offset().top;

            var dsa = $('.tabs__guide__caption').height();
            asd = $('.tabs__guide.vertical').height();
            topdowindownext = asd - dsa;
            slicktabs();


            function slicktabs() {
                $('.tabs__guide__content').css("marginLeft", widthlist);
                topblocktabs = $('.tabs__guide').offset().top;

                var difer = $(window).scrollTop() - topblocktabs + 500;


                if (difer > 0 && difer < topdowindownext) {
                    $('.tabs__guide__caption').css({'position': 'fixed', 'top': '125px'});
                } else if (difer < 0) {
                    $('.tabs__guide__caption').css({'position': 'absolute', 'top': '0px'});
                } else if (difer > topdowindownext) {
                    $('.tabs__guide__caption').css({'position': 'absolute', 'top': 'auto', 'bottom': '0px'});
                }

                console.log($('.tabs__guide__content').height());

                $(window).scroll(function () {

                    var difer = $(window).scrollTop() - topblocktabs + 125;


                    if (difer > 0 && difer < topdowindownext) {
                        $('.tabs__guide__caption').css({'position': 'fixed', 'top': '25px'});
                    } else if (difer < 0) {
                        $('.tabs__guide__caption').css({'position': 'absolute', 'top': '0px'});
                    } else if (difer > topdowindownext) {
                        $('.tabs__guide__caption').css({'position': 'absolute', 'top': 'auto', 'bottom': '0px'});
                    }

                });
            }

            $("ul.tabs__guide__caption").on("click", "li:not(.active)", function () {
                $(this)
                    .addClass("active")
                    .siblings()
                    .removeClass("active")
                    .closest("div.tabs__guide")
                    .find("div.tabs__guide__content")
                    .removeClass("active")
                    .eq($(this).index())
                    .addClass("active");
                if ($("#topper").length !== 0) { // проверим существование элемента чтобы избежать ошибки
                    $('html, body').animate({scrollTop: $("#topper").offset().top}, 300); // анимируем скроолинг к элементу scroll_el
                }
                asd = $('.tabs__guide.vertical').height();
                topdowindownext = asd - dsa;
                slicktabs();
            });
        };
    });

})(jQuery);*/
