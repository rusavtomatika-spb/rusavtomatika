$(function () {
    $('.button_open_panel_contacts').on('click',function () {
        if($('.button_open_panel_contacts').hasClass('is-active')){
            $('.button_open_panel_contacts').removeClass('is-active');
            $('.pop_panel_contacts').removeClass('is-active');
            $('.pop_panel_contacts').fadeOut(300);
        }else {
            $('.button_open_panel_contacts').addClass('is-active');
            $('.pop_panel_contacts').addClass('is-active');
            $('.pop_panel_contacts').fadeIn(300);
        }
    });
});

$(function () {

function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
});


$(function () {
    if($("#tabs").length>0){
        $("#tabs").tabs();
    }
});
$(function () {
    if ($(".block_floating").length > 0) {
        var topPos = $('.block_floating').offset().top - 20;
        var block_floating_height = $('.block_floating').height();
        $(window).scroll(function () {
            var top = $(document).scrollTop();
            var bottomBorderPos = $('#footer').offset().top - block_floating_height - 26;
            $('.column_block_specifications').css("height", $('.column_block_equipment').height());

            if (top > topPos && top < bottomBorderPos) {
                $('.block_floating').css('width', $('.block_floating').width());
                $('.column_block_specifications').css('min-height', $('.block_floating').height());
                $('.block_floating').removeClass('block_floating_fixed2');
                $('.block_floating').addClass('block_floating_fixed');
            } else if (top > topPos && top > bottomBorderPos) {
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
            if ($(this).is('.active') && !$('.block_specifications_link').is('.active')) {
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

$(window).on('scroll', function () {
    let window_scroll_top = $(this).scrollTop();
    let start_y = $('.header_top').offset().top + $('.header_top').outerHeight()+20;
    if (window_scroll_top > start_y) {
        if (!$('.catalog_toolbar').hasClass('fixed')) {
            $('.catalog_toolbar').addClass('fixed');
        }
    } else {
        if ($('.catalog_toolbar').hasClass('fixed')) {
            $('.catalog_toolbar').removeClass('fixed');
        }
    }
});




/**********************************************************************************************************************/
$(document).ready(function () {
    $("#emailsh").html("<a href=mailto:sales@rusavtomatika.com class=wei_link title='Отправьте нам сообщение по электронной почте'>sales@rusavtomatika.com</a>");
    var scrolltotop = {
        setting: {startline: 350, scrollto: 0, scrollduration: 800, fadeduration: [500, 100]},
        controlHTML: "<span id='topcontrol__arrow'>&#8593;</span></b></div>",
        anchorkeyword: "#top",
        state: {isvisible: false, shouldvisible: false},
        scrollup: function () {
            if (!this.cssfixedsupport) {
                this.control.css({opacity: 0}) //hide control immediately after clicking it
            }
            var dest = isNaN(this.setting.scrollto) ? this.setting.scrollto : parseInt(this.setting.scrollto);
            if (typeof dest == "string" && jQuery("#" + dest).length == 1)
                dest = jQuery("#" + dest).offset().top;
            else
                dest = 0;
            this.body.animate({scrollTop: dest}, this.setting.scrollduration);
        },
        keepfixed: function () {
            var window = jQuery(window);
            var controlx = window.scrollLeft() + window.width() - this.control.width();
            var controly = window.scrollTop() + window.height() - this.control.height();
            this.control.css({left: controlx + "px", top: controly + "px"})
        },
        togglecontrol: function () {
            var scrolltop = jQuery(window).scrollTop();
            if (!this.cssfixedsupport)
                this.keepfixed();
            this.state.shouldvisible = (scrolltop >= this.setting.startline) ? true : false;
            if (this.state.shouldvisible && !this.state.isvisible) {
                this.control.stop().animate({opacity: 0.9}, this.setting.fadeduration[0]).css("visibility", "visible").css("z-index","1000");
                this.state.isvisible = true;
            } else if (this.state.shouldvisible == false && this.state.isvisible) {
                this.control.stop().animate({opacity: 0}, this.setting.fadeduration[1], function () {
                    $(this).css("visibility", "hidden").css("z-index","-1");
                });
                this.state.isvisible = false;
            }
        },
        init: function () {
            jQuery(document).ready(function ($) {
                var mainobj = scrolltotop;
                var iebrws = document.all;
                mainobj.cssfixedsupport = !iebrws || iebrws && document.compatMode == "CSS1Compat" && window.XMLHttpRequest;
                mainobj.body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $("html") : $("body")) : $("html,body");
                if ($(document).width() - (($(document).width() * (2 / 100)) * 2) > 960) {
                    mainobj.control = $("<div id=\"topcontrol\">" + mainobj.controlHTML + "</div>");
                } else {
                    mainobj.control = $("<div id=\"topcontrol\">" + mainobj.controlHTML + "</div>");
                    //mainobj.control = $(mainobj.controlHTML);
                }
                mainobj.control
                    .css({position: mainobj.cssfixedsupport ? "fixed" : "absolute", bottom: '2%', left: '2%', opacity: 0, "z-index": "-1", cursor: "pointer"})
                    .attr({title: "Наверх"})
                    .click(function () {
                        mainobj.scrollup();
                        return false
                    })
                    .appendTo("body");
                if (document.all && !window.XMLHttpRequest && mainobj.control.text() != "")
                    mainobj.control.css({width: mainobj.control.width()});
                mainobj.togglecontrol();
                $("a[href=\"" + mainobj.anchorkeyword + "\"]").click(function () {
                    mainobj.scrollup();
                    return false;
                });
                $(window).bind("scroll resize", function (e) {
                    mainobj.togglecontrol();
                });
            });
        }
    };
    scrolltotop.init()
});
////////////////////////////////////////////////////////////////
function show_backup_call(o, model)
{
    console.log('!!!111');
    console.log(o, model);
    $("#backup_call .backup_call_block_phoneNumber").show();
    $("#backup_call .btn_send").show();
    backup_call_position();
    $("#backup_call_message").html("");
//var x=$(o).position().left;
//var y=$(o).position().top;
//$("#backup_call").css('left', x-100);
//$("#backup_call").css('top', y-200);

    if (o == 1)
        $("#backup_call_h").html("Для обсуждения Вашей скидки на <b>" + model + "</b> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России, 7 )<br> \
Мы перезвоним Вам в течение 10 минут<br>Или напишите в чат в правом нижнем углу экрана.<br>");

    if (o == 2)
        $("#backup_call_h").html("Для быстрого заказа <b>" + model + "</b> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России, 7)<br>   \
Мы перезвоним Вам в течение 10 минут<br>Или напишите в чат в правом нижнем углу экрана.<br>");

    if (o == 3)
        $("#backup_call_h").html("Для уточнения данных по Вашему заказу пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России, 7)<br>   \
Мы перезвоним Вам в течение 10 минут<br>Или напишите в чат в правом нижнем углу экрана.<br>");

    if (o == 4)
        $("#backup_call_h").html("Пожалуйста, введите Ваш мобильный номер, начиная с кода страны <br>( например, для России, 7)<br>   \
Мы перезвоним Вам в течение 10 минут<br>Или напишите в чат в правом нижнем углу экрана.<br>");

    if (o == 5)
        $("#backup_call_h").html("<strong>Для уточнения условий <span style='color:red;'>акционного предложения</span></strong> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России — 7)<br>   \
<strong>Мы перезвоним Вам в течение 10 минут<strong><br />Или напишите в чат в правом нижнем углу экрана.<br />");

    if (o == 6)
        $("#backup_call_h").html("<strong>Для уточнения цены <b>" + model + "</b></strong> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России — 7)<br>   \
<strong>Мы перезвоним Вам в течение 10 минут<strong><br />Или напишите в чат в правом нижнем углу экрана.<br />");
    if (o == 7)
        $("#backup_call_h").html("<strong>Для уточнения наличия и цены  <b>" + model + "</b></strong> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России — 7)<br>   \
<strong>Мы перезвоним Вам в течение 10 минут<strong><br />Или напишите в чат в правом нижнем углу экрана.<br />");
    if (o == 8)
        $("#backup_call_h").html("<strong>Для уточнения наличия <b>" + model + "</b></strong> пожалуйста, введите Ваш мобильный номер, начиная с кода страны ( например, для России — 7)<br>   \
<strong>Мы перезвоним Вам в течение 10 минут<strong><br />Или напишите в чат в правом нижнем углу экрана.<br />");

    $("#backup_call").show();
    $("#mes_backgr").css('opacity', '0.7');
    $("#mes_backgr").fadeIn("fast");

}

function backup_call_position()
{
    var h = $(window).height();
    var w = $(window).width();
    var d = $(document).height();
    //var scrtop=$(window).scrollTop();

    var top = Math.round((h - $("#backup_call").height()) / 2);

    var left = Math.round((w - $("#backup_call").width()) / 2);

    $("#mes_backgr").css('width', w);
    $("#mes_backgr").css('height', d);
    $("#backup_call").css('top', top - 50);
    $("#backup_call").css('left', left);

}
function backup_call_go()
{

    $("#backup_call_message").html("");
    var phone = $('input[name="phone"]').val(),
        intRegex = /[0-9-()+]+$/;
    if ((phone.length < 11) || (!intRegex.test(phone)))
    {
        //alert('Please enter a valid phone number.');
        $("#backup_call_message").html("неправильный номер");
        return false;
    }
    $.ajax({
        url: "https://www.rusavtomatika.com/service/callback.php",
        type: "POST",
        dataType: "html", //"json",
        data: {ph: phone},
        success: function (msg) {
            //  alert(msg);
            if (msg == "OK") {
                $("#backup_call_message").html("Ожидайте звонка...");
                $("#backup_call .backup_call_block_phoneNumber").hide();
                $("#backup_call .btn_send").hide();
            } else
                $("#backup_call_message").html("Ошибка, попробуйте еще раз...<br>" + msg);
        },

    });


}
function backup_call_hide()
{
    $("#mes_backgr").fadeOut("fast");
    $("#backup_call").hide();

}
function sendsf()
{
//alert("dsd");
    $("#spfmessres").html("<br><br>");
    var name = $("#spfname").val();
    var surname = $("#spfsurname").val();
    var company = $("#spfcompany").val();
    var position = $("#spfposition").val();
    var prod = $("#spfprod").val();
    var phone = $("#spfphone").val();
    var email = $("#spfemail").val();
    var mess = $("#spfmess").val();


    $.ajax({
        url: "https://www.rusavtomatika.com/service/forms_tool.php",
        type: "POST",
        dataType: "html", //"json",
        data: {name: name, surname: surname, company: company, position: position, prod: prod, phone: phone, email: email,
            mess: mess, ft: 'sf'},
        success: function (msg) {
            alert(msg);
            $("#spfmessres").html(msg);

            //show_result_mess(msg);
            //location.reload();
            // $("#unl_mess").html(msg);
            // $("#conn_info").html("");
        },

    });

}

