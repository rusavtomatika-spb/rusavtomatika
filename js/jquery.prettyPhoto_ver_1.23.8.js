/* ------------------------------------------------------------------------
 Class: prettyPhoto
 Use: Lightbox clone for jQuery
 Author: Stephane Caron (http://www.no-margin-for-errors.com)
 ------------------------------------------------------------------------- */

$.fn.disableSelection = function() {
    return this.each(function() {
        $(this).attr('unselectable', 'on')
            .css({'-moz-user-select':'none',
                '-o-user-select':'none',
                '-khtml-user-select':'none',
                '-webkit-user-select':'none',
                '-ms-user-select':'none',
                'user-select':'none'})
            .each(function() {
                $(this).attr('unselectable','on')
                    .on('selectstart vmousedown',function(){ return false; });
            });
    });
};

(function($) {

    window.is_full = $.support.touch ? true : false;
    window.no_gal = false;
    window.cgalleryHeight = 80;
    window.cfilterHeight = 37;
    window.no_filters = false;
    window.cdetailsHeight = cgalleryHeight + cfilterHeight;
    window.firstinit = false;
    window.arrowWidth = 240;

    $.prettyPhoto = {};

    $.fn.prettyPhoto = function(pp_settings) {
        pp_settings = $.extend({
            animation_speed: 50,
            opacity: 0.7,
            fullscreen: false,
            default_width: 500,
            default_height: 344,
            counter_separator_label: '/',
            theme: 'pp_default',
            horizontal_padding: 0, /* The padding on each side of the picture */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: false, /* Automatically start videos: True/False */
            changepicturecallback: $.noop, /* Called everytime an item is shown/changed */
            callback: $.noop, /* Called when prettyPhoto is closed */
            initcallback : $.noop,/* Called once than prettyPhoto initialized */

            markup: '<div class="pp_pic_holder"> \
                        <table width="100%" height="100%"><tr><td style="vertical-align:top">\
						<div class="ib" style="position:relative; height:100%;"><div class="ppt">&nbsp;</div> \
			            <div class="pp_content_container"> \
                            <div class="pp_content"> \
                                <a title="Используйте Esc для закрытия галереи" class="pp_close" style="display: none;" href="#">Close</a> \
                                <div class="pp_loaderIcon" class="ib" style="display: none;">\
                                    <img src="/img/zoom-view-image-loading.gif" width="32" height="32" style="display: block;" border="0" alt="" />\
                                </div> \
                                <div class="pp_fade"> \
                                    <div class="pp_hoverContainer"> \
                                        <a class="pp_next" href="#">next</a> \
                                        <a class="pp_previous" href="#">previous</a> \
                                    </div> \
                                    <div id="pp_full_res"></div> \
                                    <div class="pp_details"> \
                                        <div id="tdetails"><table cellpadding="0" cellspacing="0"><tr>\
                                            <td width="100%"><p class="pp_description"></p></td>\
                                            <td><div class="div-fullscreen-off"><a href="#" style="display:none;" id="pp_fullscreen_off" class="ib" target="_blank"><em>Оконный режим</em></a></div></td>\
                                            <td><div class="div-fullscreen-on"><a style="display:none;" href="#" id="pp_fullscreen_on"  class="ib" target="_blank"><em>На весь экран</em></a></div></td>\
                                            <td><div class="div-save"><a id="pp_save" href="#" target="_blank"><u>Загрузить</u></a></div></td>\
                                        </tr></table></div>\
                                    </div> \
                                </div> \
                            </div> \
						</div> \
						</div></td></tr><tr><td height="1">\
                            <div style="width:100%; z-index:100000000; text-align: center" id="cdetails">\
                                <div id="cgallery"></div>\
                                <div style="position:relative" class="ib">\
                                    <div id="mode" class="ib"></div>\
                                    <div id="cadd" style="display:none; position: absolute;">\
                                        <a href="#" target="_blank" class="cadd-link">\
                                            <span class="cadd-border">Добавить фото/видео</span> &rarr;\
                                        </a>\
                                    </div>\
                                </div>\
                            </div> \
                        </td></tr></table>\
					</div> \
					<div id="pp_overlay" class="pp_overlay">\
					    <div id="overlay_loader" class="ib" style="position: fixed; top:50%; left: 50%;">\
                            <img src="/img/zoom-view-image-loading.gif" width="32" height="32" style="display: block;" border="0" alt="" />\
                        </div> \
					</div>',

            gallery_markup: '<div class="pp_gallery"> \
								<a href="#" class="pp_arrow_previous">Previous</a> \
								<div> \
									<ul> \
										{gallery} \
									</ul> \
								</div> \
								<a href="#" class="pp_arrow_next">Next</a> \
							</div>',

            custom_markup: '\
                <div class="div-fullimage" style="position:relative; z-index:500000; border-top-left-radius:10px; border:1px solid #fff; overflow:hidden;">\
                    <a id="cadd2" target="_blank" style="display:block; text-decoration: none; width:100%; height:500px; background:#fff url(../img/ic-add-photo2.png) no-repeat center 130px; margin: 0 auto; border-radius: 15px; padding: 0 50px; text-align:center; font: normal 12px arial; color:#777">\
                        <div style="padding: 300px 0; margin:0 auto; width: 60%; text-align:center; font: normal 12px arial; color:#777">\
                            <span style="font: normal 28px arial; color:#666; text-decoration:none; border-bottom: 1px solid #aaa; display:inline-block; margin: 0 0 10px;">Добавить фото/видео</span><br clear="all">\
                            Если у вас есть интересные фотографии или видеоролики, связанные с конкретным товаром — обязательно поделитесь ими с другими пользователями сайта\
                        </div>\
                    </a>\
                </div>',

            image_markup: '<div class="div-fullimage" style="position:relative; z-index:2000; border-top-left-radius:10px; border:1px solid #fff; overflow:hidden;"><img id="fullResImage" src="{path}" /></div>',
            flash_markup: '<div class="div-fullimage" style="position:relative; z-index:500000; border-top-left-radius:10px; border:1px solid #fff;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object></div>',
            d3_markup: '<div class="div-fullimage" style="position:relative; z-index:500000; border-top-left-radius:10px; border:1px solid #fff; text-align: center;"><iframe id="id_3d_container" width="{width}" height="{height}" allowfullscreen="true" frameBorder="0" src="//reviewthree.com/embed/{ID3D}"></iframe></div></div>',
            //d3_markup: '<div class="div-fullimage" style="position:relative; z-index:500000; border-top-left-radius:10px; border:1px solid #fff;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" id="mtdPlayer" width="{width}" height="{height}"><param name="quality" value="high"/><param name="wmode" value="direct" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="flashVars" value="language=ru&showInfoPanel=false" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="direct" autoStart="true" name="mtdPlayer" flashVars="language=ru&showInfoPanel=false" quality="high"></embed></object></div>',
            iframe_markup: '<div class="div-fullimage" style="position:relative; z-index:500000; border-top-left-radius:10px; border:1px solid #fff;"><iframe class="youtube-player" type="text/html" src="{path}" width="{width}" height="{height}" allowfullscreen frameborder="no"></iframe></div>'
        }, pp_settings);


        var matchedObjects = this, pp_dimensions, pp_open,// Global variables accessible only by prettyPhoto
            pp_contentHeight, pp_contentWidth, pp_containerHeight, pp_containerWidth,// prettyPhoto container specific
            windowHeight = $(window).height(), windowWidth = $(window).width();

        scroll_pos = _get_scroll();

        if ( !$.support.touch ) $(window).unbind('resize.prettyphoto').bind('resize.prettyphoto',function(){ _center_overlay(); _resize_overlay(); });

        $(document).unbind('keydown.prettyphoto').bind('keydown.prettyphoto',function(e) {
            if (typeof $pp_pic_holder != 'undefined' && $pp_pic_holder.is(':visible')) {
                switch( e.keyCode ){
                    case 37:
                        $.prettyPhoto.changePage('previous');
                        e.preventDefault();
                        break;
                    case 39:
                        $.prettyPhoto.changePage('next');
                        e.preventDefault();
                        break;
                    case 27:
                        $.prettyPhoto.close();
                        e.preventDefault();
                        break;
                }
            }
        });

        $.prettyPhoto.initialize = function() {

            settings = pp_settings;

            // Find out if the picture is part of a set
            theRel = $(this).attr('rel');
            galleryRegExp = /\[(?:.*)\]/;
            isSet = (galleryRegExp.exec(theRel)) ? true : false;

            // Put the SRCs, TITLEs, ALTs into an array.
            pp_images = (isSet) ? $.map(matchedObjects, function(n, i){ if($(n).attr('rel').indexOf(theRel) != -1) return $(n).attr('href'); }) : $.makeArray($(this).attr('href'));
            pp_titles = (isSet) ? $.map(matchedObjects, function(n, i){ if($(n).attr('rel').indexOf(theRel) != -1) return ($(n).find('img').attr('alt')) ? $(n).find('img').attr('alt') : ""; }) : $.makeArray($(this).find('img').attr('alt'));
            pp_descriptions = (isSet) ? $.map(matchedObjects, function(n, i){ if($(n).attr('rel').indexOf(theRel) != -1) return ($(n).attr('title')) ? $(n).attr('title') : ""; }) : $.makeArray($(this).attr('title'));

            set_position = $.inArray($(this).attr('href'), pp_images); // define where in the array the clicked item is positionned
            rel_index = (isSet) ? set_position : $("a[rel^='"+theRel+"']").index($(this));

            _build_overlay(this); //build the overlay {this} being the caller

            $.prettyPhoto.open();

            return false;
        }

        $.prettyPhoto.toggle_fullscreen = function() {

            pp_settings.fullscreen = !pp_settings.fullscreen;
            this.set_fullscreen_btns();

            //---
            var pp_details = $('#cdetails');
            if ( pp_settings.fullscreen ) {
                var opacity = 0.9;
                pp_details.hide();
                resizeStep = 100;
                window.cdetailsHeight = 0;
            } else {
                var opacity = pp_settings.opacity;
                pp_details.show();
                resizeStep = 220;
                window.cdetailsHeight = cgalleryHeight + cfilterHeight;
            }

            $pp_overlay.css('opacity', opacity);

            //---
            if ( pp_images[0] ) this.changePage( set_position );

        }

        $.prettyPhoto.set_fullscreen_btns = function() {
            var settings = pp_settings;
            var fscr_on = $('#pp_fullscreen_on');
            var fscr_off = $('#pp_fullscreen_off');
            if ( settings.fullscreen ) { fscr_off.show(); fscr_on.hide(); } else { fscr_off.hide(); fscr_on.show(); }
        }

        $.prettyPhoto.open = function (event) {
            minWidth = 500;
            minHeight = 300;
            resizeStep = 220;
            titleHeight = 28;
            ehoffset = 24;

            if (no_gal) {
                cdetailsHeight = 0;
                firstinit = true;
            }

            no_gal = false;
            pp_settings.fullscreen = false;

            if (typeof settings === 'undefined') { // Means it's an API call, need to manually get the settings and set the variables
                var data_loadcolor = $(arguments[1]).data('loadcolor');

                settings = pp_settings;
                pp_images = [];

                if (arguments[1] && data_loadcolor) {
                    pp_images.push($(arguments[1]).find('img').attr('src'))
                }

                if (event instanceof Event) {
                    event.preventDefault();

                    var $target = $(event.target);

                    pp_images = [$target.attr('href')];
                    pp_titles = [$target.attr('title')];
                    pp_descriptions = [''];
                    set_position = 0;

                    if ($.prettyPhoto.type === 'img') {
                        // Обновить галерею после загрузки основной картинки
                        $(document).one('show.prettyPhoto.image', function () {
                            // Достать всех соседей с атрибутом "href" и построить с них галерею
                            $target.parent().find('[href]').each(function (i) {
                                var $this = $(this);

                                if ($this.is($target)) {
                                    set_position = i;
                                }

                                pp_images[i] = $this.attr('href');
                                pp_titles[i] = $this.attr('title');
                                pp_descriptions[i] = '';
                            });

                            if (imgPreloader && !imgPreloader.complete) {
                                $(imgPreloader).on('load', function () {
                                    $.prettyPhoto.reloadGallery(undefined, 'IMG');
                                });
                            } else {
                                $.prettyPhoto.reloadGallery(undefined, 'IMG');
                            }
                        });
                    }
                } else {
                    pp_images.push(arguments[0]);
                    pp_titles = arguments[1] ? $.makeArray(arguments[1]) : $.makeArray('');
                    pp_descriptions = arguments[2] ? $.makeArray(arguments[2]) : $.makeArray('');
                    set_position = 0;
                }

                isSet = ((pp_images.length > 1 && !data_loadcolor) || pp_images.length > 2);

                _build_overlay(event.target);
            }

            if (settings.hideflash) {
                $('object,embed,iframe[src*=youtube],iframe[src*=vimeo]').css('visibility', 'hidden'); // Hide the flash
            }

            // Fade the content in
            if ($ppt.is(':hidden')) {
                $ppt.css('opacity', 0).show();
            }

            $pp_overlay.show().fadeTo(settings.animation_speed, settings.opacity);

            // Fade the holder
            $pp_pic_holder
                .fadeIn(function () {
                    if (is_full && (_getFileType(pp_images[set_position]) == 'image')) {
                        $.prettyPhoto.toggle_fullscreen()
                    } else {
                        $.prettyPhoto.injectContent();
                    }
                })
                .css('overflow', 'visible')
                .find(':not(input,select,textarea)')
                .disableSelection();

            $('.pp_next').hover(function () {
                $(this).addClass('pp_next_hover');
            }, function () {
                $(this).removeClass('pp_next_hover');
            });

            $('.pp_previous').hover(function () {
                $(this).addClass('pp_previous_hover');
            }, function () {
                $(this).removeClass('pp_previous_hover');
            });

            $('#pp_fullscreen_on, #pp_fullscreen_off')
                .on('click tap', function (e) {
                    e.preventDefault();
                    $.prettyPhoto.toggle_fullscreen();
                    return false;
                })
                .find('em')
                .on('click tap', function (e) {
                    e.preventDefault();
                    $.prettyPhoto.toggle_fullscreen();
                    return false;
                });

            return false;
        };

        $.prettyPhoto.open_pg = function (event) {
            window.no_filters = false;
            window.cdetailsHeight = cgalleryHeight + cfilterHeight;

            $('.notes-ek').hide();
            $.prettyPhoto.open(event, arguments[3]);
            $(document).triggerHandler('open.prettyPhoto');

            return false;
        };

        $.prettyPhoto.reloadGallery = function(num, mode) {

            set_position = (typeof num != 'undefined') ? num : set_position;
            isSet = (pp_images.length > 1);

            if( isSet ) {

                $pp_pic_holder.find('.pp_hoverContainer').show();
                currentGalleryPage = set_position;

                toInject = '';

                var t_pp_images = (mode == 'VIDEO') ? pp_video_sub : pp_images;
                $.each(t_pp_images, function(i, elem) {
                    if (mode == 'IMG') elem = elem.replace(/\/big\//i, '/120/');
                    if(!elem.match(/\b(jpe?g|png|gif)\b/gi)) {
                        classname = 'default';
                        img_src = '';
                    }else{
                        classname = '';
                        img_src = elem;
                    }

                    toInject += "<li class='"+classname+"' style='position:relative;'><a href='#'><table cellpadding='0' height='100%' width='100%' cellspacing='0'><tr><td valign='middle' height='100%' width='100%'><img style='vertical-align: middle;' src='" + img_src + "' width='50' alt='' /></td></tr></table><div class='pp-counter currentTextHolder'>"+(parseInt(i)+1)+"</div></a></li>";
                });
                toInject = settings.gallery_markup.replace(/{gallery}/g,toInject+'<br clear="all">');

                $('.pp_gallery').remove();

                $(toInject).appendTo('#cgallery');

                $pp_gallery = $('.pp_pic_holder .pp_gallery'), $pp_gallery_li = $pp_gallery.find('li');

                $pp_gallery
                    .find('.pp_arrow_next').on('click tap', function() {
                        $.prettyPhoto.changeGalleryPage('next');
                        return false;
                    })
                    .end()
                    .find('.pp_arrow_previous').on('click tap', function() {
                        $.prettyPhoto.changeGalleryPage('previous');
                        return false;
                    });

                $pp_pic_holder.find('.pp_gallery:not(.disabled)').show();

                itemWidth = 58+12; //thumb width + right margin.
                $pp_gallery_li.each(function(i){
                    $(this)
                        .find('a')
                        .on('click tap', function(){
                            $.prettyPhoto.changePage(i);
                            return false;
                        });
                });

                $('#cgallery').height(cgalleryHeight);
            };

            _insert_gallery();

            $.prettyPhoto.set_title_desc();

            _center_overlay();

        }

        /**
         * Change page in the prettyPhoto modal box
         * @param direction {String} Direction of the paging, previous or next.
         */
        $.prettyPhoto.changePage = function(direction) {

            $('.pp_loaderIcon').show();

            if (direction == 'previous') {
                set_position--;
                if (set_position < 0) set_position = $(pp_images).size()-1;
            } else if (direction == 'next') {
                set_position++;
                if(set_position > $(pp_images).size()-1) set_position = 0;
            } else {
                set_position=direction;
            }
            rel_index = set_position;

            $.prettyPhoto.injectContent();
        }

        function _hideContent( callback ){
            $pp_pic_holder
                .find('#pp_full_res object,#pp_full_res embed').css('visibility','hidden')
                .end()
                .find('.pp_fade').fadeOut(settings.animation_speed,function(){
                    callback();
                });
        }

        $.prettyPhoto.set_title_desc  = function() {
            var title = pp_titles[set_position] || '&nbsp;',
                description = pp_descriptions[set_position],
                $pic_desc = $pp_pic_holder.find('.pp_description');

            $ppt.html(unescape(title));
            ( description ) ? $pic_desc.show().html(unescape(description)) : $pic_desc.hide();
        }

        $.prettyPhoto.injectContent = function() {

            // Get the dimensions
            movie_width = ( parseFloat(getParam('width',pp_images[set_position])) ) ? getParam('width',pp_images[set_position]) : settings.default_width.toString();
            movie_height = ( parseFloat(getParam('height',pp_images[set_position])) ) ? getParam('height',pp_images[set_position]) : settings.default_height.toString();

            imgPreloader = "";
            $('#pp_save,#pp_fullscreen_off,#pp_fullscreen_on').hide();

            ratio = 0;

            // Inject the proper content
            switch(_getFileType(pp_images[set_position])){
                case 'image':
                case '':

                    imgPreloader = new Image();
                    nextImage = new Image();
                    prevImage = new Image();

                    if (isSet && set_position < $(pp_images).size() -1) nextImage.src = pp_images[set_position + 1];
                    if (isSet && pp_images[set_position - 1]) prevImage.src = pp_images[set_position - 1];

                    imgPreloader.onload = function() {
                        _hideContent( function() {
                            $('#overlay_loader').hide();
                            $('a.pp_close').show();
                            $pp_pic_holder.find('#pp_full_res').html(settings.image_markup.replace(/{path}/g, pp_images[set_position]));
                            pp_dimensions = _fitToViewport(imgPreloader.width, imgPreloader.height);
                            $.prettyPhoto.set_title_desc();
                            _showContent();
                        });
                    };
                    imgPreloader.onerror = function() {
                        alert('Image cannot be loaded. Make sure the path is correct and image exist.');
                        $.prettyPhoto.close();
                    };

                    if ($.trim(pp_images[set_position])) {
                        imgPreloader.src = pp_images[set_position];
                    }
                    else {
                        if (imgPreloader) {
                            // скрываем слой контента до полной загрузки галерееи
                            $pp_pic_holder.children().css('visibility','hidden');
                        }
                        loadgallery();
                    }

                    if (!$.support.touch) $('#pp_save').attr('href', pp_images[set_position].replace(/400/i, 'big')).show();
                    $.prettyPhoto.set_fullscreen_btns();
                    $(document).triggerHandler('show.prettyPhoto.image');
                    break;

                case 'youtube':
                    pp_dimensions = _fitToViewport(movie_width, movie_height);
                    movie = pp_images[set_position];
                    movie = 'https://www.youtube.com/embed/' + movie.replace(/.*\//, '').replace(/\?.*/, '');

                    (getParam('rel',pp_images[set_position])) ? movie+="?rel="+getParam('rel',pp_images[set_position]) : movie+="?rel=1";
                    if (settings.autoplay) movie += "&autoplay=1";
                    toInject = settings.iframe_markup.replace(/{width}/g,pp_dimensions['width']).replace(/{height}/g,pp_dimensions['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);
                    $('a.pp_close').show();
                    $('#overlay_loader').hide();
                    $.prettyPhoto.set_title_desc();
                    $(document).triggerHandler('show.prettyPhoto.youtube');
                    break;

                case '3D':
                    pp_dimensions = _fitToViewport(movie_width,movie_height);
                    filename = pp_images[set_position].replace(/_3d_/,'');
                    toInject =  settings.d3_markup.replace(/{width}/g,pp_dimensions['width']).replace(/{height}/g,pp_dimensions['height']).replace(/{ID3D}/g,filename);
                    $('a.pp_close').show();
                    $('#overlay_loader').hide();
                    $.prettyPhoto.set_title_desc();
                    $(document).triggerHandler('show.prettyPhoto.3D');
                    break;

                case 'iframe':
                    pp_dimensions = _fitToViewport(movie_width,movie_height); // Fit item to viewport
                    frame_url = pp_images[set_position];
                    frame_url = frame_url.substr(0,frame_url.indexOf('iframe')-1);
                    toInject = settings.iframe_markup.replace(/{width}/g,pp_dimensions['width']).replace(/{height}/g,pp_dimensions['height']).replace(/{path}/g,frame_url);

                    $('a.pp_close').show();
                    $('#overlay_loader').hide();
                    $.prettyPhoto.set_title_desc();
                    break;

                case 'vimeo':
                    pp_dimensions = _fitToViewport(movie_width, movie_height);
                    movie = pp_images[set_position];
                    if (settings.autoplay) movie += "&autoplay=1;";
                    vimeo_width = pp_dimensions['width'] + '/embed/?moog_width='+ pp_dimensions['width'];
                    toInject = settings.iframe_markup.replace(/{width}/g,vimeo_width).replace(/{height}/g,pp_dimensions['height']).replace(/{path}/g,movie);
                    $('a.pp_close').show();
                    $('#overlay_loader').hide();
                    $.prettyPhoto.set_title_desc();
                    break;

                case 'custom':
                    pp_dimensions = _fitToViewport(movie_width,movie_height); // Fit item to viewport
                    toInject = settings.custom_markup;
                    break;
            }

            if(!imgPreloader){
                $pp_pic_holder.find('#pp_full_res').html(toInject);
                _showContent();
            }

        }

        /**
         * Change gallery page in the prettyPhoto modal box
         * @param direction {String} Direction of the paging, previous or next.
         */
        $.prettyPhoto.changeGalleryPage = function(direction){

            if(direction=='next'){
                currentGalleryPage ++;
                if(currentGalleryPage > totalPage) currentGalleryPage = 0;
            }else if(direction=='previous'){
                currentGalleryPage --;
                if(currentGalleryPage < 0) currentGalleryPage = totalPage;
            }else{
                currentGalleryPage = direction;
            }

            slide_speed = (direction == 'next' || direction == 'previous') ? settings.animation_speed : 0;
            slide_to = currentGalleryPage * (itemsPerPage * itemWidth);

            var pp_dim_w = pp_dimensions && pp_dimensions['contentWidth'] || 0;
            var body_w = $('body').width();
            $pp_pic_holder.find('.pp_hoverContainer')
                .width(Math.max(pp_dim_w + arrowWidth, body_w))
                .css('margin-left', -1*Math.max(arrowWidth/2, (body_w - pp_dim_w)/2));

            $pp_gallery.find('ul').animate({left:-slide_to},slide_speed);

            if (currentGalleryPage == totalPage) {
                //листать вперед нельзя
                $pp_gallery.find('.pp_arrow_next').css('visibility','hidden').end().find('.pp_arrow_previous').css('visibility','visible');

            }
            else if (currentGalleryPage == 0) {
                //листать назад нельзя
                $pp_gallery.find('.pp_arrow_next').css('visibility', 'visible').end().find('.pp_arrow_previous').css('visibility', 'hidden');
            }
            else {
                $pp_gallery.find('.pp_arrow_next,.pp_arrow_previous').css('visibility','visible');
            }

        }

        /**
         * Closes prettyPhoto.
         */
        $.prettyPhoto.close = function(){
            if($pp_overlay.is(":animated")) return;
            $pp_pic_holder.stop().find('object,embed').css({'visibility':'hidden', 'overflow':'visible'});

            $('div.pp_pic_holder,div.ppt,.pp_fade').fadeOut(settings.animation_speed,function(){ $(this).remove(); });

            $pp_overlay.fadeOut(settings.animation_speed, function(){
                if($.browser.msie && $.browser.version == 6) $('select').css('visibility','visible');
                if(settings.hideflash) $('object,embed,iframe[src*=youtube],iframe[src*=vimeo]').css('visibility','visible'); // Show the flash
                $(this).remove();
                $(window).unbind('scroll.prettyphoto');
                settings.callback();
                pp_open = false;
                delete settings;
                firstinit = false;
                $('.notes-ek').show();
            });
            $.prettyPhoto.type = undefined;
        }

        /**
         * Set the proper sizes on the containers and animate the content in.
         */
        function _showContent(){

            $('.pp_loaderIcon').hide();

            //calculate the opened top position of the pic holder
            projectedTop = scroll_pos['scrollTop'];
            if(projectedTop < 0) projectedTop = 0;

            $ppt.fadeTo(settings.animation_speed,1);

            $pp_pic_holder.find('.pp_content')
                .animate({
                    height:pp_dimensions['contentHeight'],
                    width:pp_dimensions['contentWidth']
                },settings.animation_speed).css({'overflow':'hidden'});

            $pp_pic_holder
                .css({
                    'top': parseFloat(projectedTop) || 0,
                    'padding-top' : parseInt(windowHeight/2) - parseInt(pp_containerHeight/2),
                    'height' : $(window).height()
                })
                .animate({
                    'left': (windowWidth/2) - (pp_dimensions['containerWidth']/2),
                    'width': pp_dimensions['containerWidth']
                },
                settings.animation_speed,
                function(){
                    $pp_pic_holder
                        .find('#fullResImage').height(pp_dimensions['height']).width(pp_dimensions['width']).css({'display':'block', 'margin':'0 auto'})
                        .end()
                        .find('.pp_hoverContainer')
                        .height(pp_dimensions['height'] + 56)
//                        .width(pp_dimensions['contentWidth'] + arrowWidth)
//                        .css('margin-left', -1*arrowWidth/2);
                        .css('margin-left', -1*Math.max(arrowWidth/2, ($('.pp_hoverContainer').width() - pp_dimensions['contentWidth'])/2));

                    $('#pp_full_res').height('auto');
                    $pp_pic_holder.find('.pp_fade').fadeIn(settings.animation_speed); // Fade the new content

                    if(isSet) { $pp_pic_holder.find('.pp_hoverContainer').show(); } else { $pp_pic_holder.find('.pp_hoverContainer').hide(); }
                    settings.changepicturecallback();
                    if (!firstinit) {
                        settings.initcallback();
                    }
                    if (imgPreloader) {
                        // показываем слой контента после полной загрузки галерееи
                        $pp_pic_holder.children().css('visibility','visible');
                        if (id_good) {
                            $('#cadd').fadeIn();
                        }
                    }

                    pp_open = true;
                }).css({'overflow': 'visible'});

            _insert_gallery();
        }

        /**
         * Resize the item dimensions if it's bigger than the viewport
         * @param width {integer} Width of the item to be opened
         * @param height {integer} Height of the item to be opened
         * @return An array containin the "fitted" dimensions
         */
        function _fitToViewport(width, height) {

            var resized = false;

            if (ratio == 0) ratio = width/height;

            //width, height = размеры изображения
            _getDimensions(width,height);

            //сначала допускаем что не нужен ресайз
            imageWidth = width, imageHeight = height;

            //ширина окна с вычетом боковых стрелок
            temp_ww = windowWidth - arrowWidth;

            if( ((pp_containerWidth > temp_ww) || (pp_containerHeight > windowHeight))) {
                resized = true;
                var fitting = false;

                while (!fitting){
                    if((pp_containerWidth > temp_ww)) {
                        imageWidth = (temp_ww - resizeStep);
                        imageHeight = imageWidth / ratio;
                    } else if ((pp_containerHeight > windowHeight)) {
                        imageHeight = (windowHeight - resizeStep);
                        imageWidth = ratio * imageHeight;
                    } else {
                        fitting = true;
                    }
                    pp_containerHeight = imageHeight, pp_containerWidth = imageWidth;
                }

                _getDimensions(imageWidth,imageHeight);

                if((pp_containerWidth > temp_ww) || (pp_containerHeight > windowHeight)){
                    _fitToViewport(pp_containerWidth, pp_containerHeight)
                }

                if (imageHeight < minHeight && width < temp_ww) {

                    imageHeight = Math.min(height, minHeight);
                    imageWidth = imageHeight*ratio;

                    containerHeight = Math.max(imageHeight, minHeight);
                    contentHeight = Math.max(imageHeight, minHeight);

                    containerWidth = Math.max(imageWidth, minWidth);
                    contentWidth = Math.max(imageWidth, minWidth);
                }
            }

            //чтобы не было exception
            if (typeof containerWidth == 'undefined') {containerWidth = 0;}
            if (typeof contentWidth == 'undefined') {contentWidth = 0;}

            return {
                width:Math.floor(imageWidth),
                height:Math.floor(imageHeight),
                containerHeight:Math.floor(pp_containerHeight),
                containerWidth:Math.max(containerWidth, Math.floor(pp_containerWidth) + (settings.horizontal_padding * 2), minWidth) + 2*ehoffset,
                contentHeight:Math.max(Math.floor(pp_contentHeight), minHeight),
                contentWidth:Math.max(contentWidth, Math.floor(pp_contentWidth), minWidth) + 2*ehoffset
            }
        }

        /**
         * Get the containers dimensions according to the item size
         * @param width {integer} Width of the item to be opened
         * @param height {integer} Height of the item to be opened
         */
        function _getDimensions(width,height){

            width = parseFloat(width);
            height = parseFloat(height);

            // Get the details height, to do so, I need to clone it since it's invisible
            $pp_tdetails = $pp_pic_holder.find('#tdetails');
            tdetailsHeight = (parseFloat($pp_tdetails.css('margin-top')) + parseFloat($pp_tdetails.css('margin-bottom'))) || 0;

            $pp_tdetails = $pp_tdetails.clone().addClass(settings.theme).width(width).appendTo($('body')).css({
                'position':'absolute',
                'top':-10000
            });
            tdetailsHeight += $pp_tdetails.height();
            if(false) tdetailsHeight+=8;
            $pp_tdetails.remove();

            // Get the container size, to resize the holder to the right dimensions
            pp_contentWidth = width;
            pp_contentHeight = height;
            pp_containerWidth = width;

            if ( firstinit && !pp_settings.fullscreen ) {
                cdetailsHeight = (isSet) ? cgalleryHeight : 0;
                cdetailsHeight += (no_filters) ? 0 : cfilterHeight;
            }

            var dh = Math.min(titleHeight + cdetailsHeight + tdetailsHeight + 30, resizeStep);
            pp_containerHeight = pp_contentHeight + dh;

        }

        function _getFileType( src ) {

            if ( !src ) return '';

            if (src.match(/youtube\.com/i) || src.match(/youtu\.be/i)) return 'youtube';
            if (src.match(/vimeo\.com/i)) return 'vimeo';
            if (src.match(/\b.mov\b/i)) return 'quicktime';
            if (src.match(/(_3d_|\/3dh\/)/i)) return '3D';
            if (src.match(/\biframe=true\b/i)) return 'iframe';
            if (src.match(/\bajax=true\b/i)) return 'ajax';
            if (src.match(/\bcustom=true\b/i)) return 'custom';
            if (src.substr(0,1) == '#')  return 'inline';

            return 'image';
        }

        function _center_overlay() {

            if(typeof $pp_pic_holder != 'undefined') {
                scroll_pos = _get_scroll();
                contentHeight = $pp_pic_holder.height(),
                contentwidth = $pp_pic_holder.width();

                projectedTop = scroll_pos['scrollTop'];
                if(projectedTop < 0) projectedTop = 0;

                windowHeight = $(window).height(), windowWidth = $(window).width();
                if(contentHeight > windowHeight)
                    return;

                $pp_pic_holder.css({
                    'top': parseFloat(projectedTop) || 0,
                    'padding-top' : parseInt(windowHeight/2) - parseInt(pp_containerHeight/2),
                    'left': (windowWidth/2) + scroll_pos['scrollLeft'] - (contentwidth/2),
                    'overflow' : 'visible'
                });
            };
        }

        function _get_scroll() {
            var $win = $(window);
            if (false)
                return { scrollTop : $('html').scrollTop(), scrollLeft : $('html').scrollLeft() };
            return { scrollTop : $win.scrollTop(), scrollLeft : $win.scrollLeft() };
        }

        function _resize_overlay() {
            if ( typeof $pp_pic_holder != 'undefined' )
                $pp_pic_holder
                .css({
                    'top': parseFloat(projectedTop) || 0,
                    'padding-top' : parseInt(windowHeight/2) - parseInt(pp_containerHeight/2),
                    'height' : $(window).height()
                });

            windowHeight = $(window).height(), windowWidth = $(window).width();
            if(typeof $pp_overlay != "undefined") $pp_overlay.height($(document).height()).width(windowWidth);
        }

        function _insert_gallery(){

            if(isSet && (!(true))) {

                itemWidth = 58+12; //thumb width + right margin.
                navWidth = 120; // Define the arrow width depending on the theme

                //itemsPerPage = Math.floor((pp_dimensions['containerWidth'] - 100)/ itemWidth);
                itemsPerPage = Math.floor(($(window).width() - 100)/ itemWidth);
                itemsPerPage = (itemsPerPage < pp_images.length) ? itemsPerPage : pp_images.length;
                totalPage = Math.ceil(pp_images.length / itemsPerPage) - 1;

                // Hide the nav in the case there's no need for links
                if (totalPage == 0) {
                    navWidth = 0; // No nav means no width!
                    $pp_gallery.find('.pp_arrow_next,.pp_arrow_previous').hide();
                } else {
                    itemsPerPage = Math.floor(($(window).width() - 100 - navWidth) / itemWidth);
                    itemsPerPage = (itemsPerPage < pp_images.length) ? itemsPerPage : pp_images.length;
                    totalPage = Math.ceil(pp_images.length / itemsPerPage) - 1;
                    $pp_gallery.find('.pp_arrow_next,.pp_arrow_previous').show();
                }

                galleryWidth = itemsPerPage * itemWidth;
                fullGalleryWidth = pp_images.length * itemWidth + 10;

                // Set the proper width to the gallery items
                $pp_gallery
                    .width(galleryWidth + navWidth + 10)
                    .css('margin-left',-((galleryWidth/2) + (navWidth/2)))
                    .find('div:first').width(galleryWidth+5)
                    .css({'height' : 80})
                    .find('ul').width(fullGalleryWidth)
                    .find('li.selected').removeClass('selected');

                $.each($pp_gallery.find('li .pp-counter'), function(i, item) {
                    $(item).text($(item).text());
                });

                goToPage = (Math.floor(set_position/itemsPerPage) < totalPage) ? Math.floor(set_position/itemsPerPage) : totalPage;

                $.prettyPhoto.changeGalleryPage(goToPage);

                $pp_gallery_li.filter(':eq('+set_position+')').addClass('selected').find('.pp-counter').text((set_position+1));

            } else {
                $('#cgallery').css('height', 0).html('');
                $pp_pic_holder.find('.pp_content').unbind('mouseenter mouseleave');
            }

        }

        function _build_overlay(caller){

            $('body').append(settings.markup);//inject the markup

            $pp_pic_holder = $('.pp_pic_holder'), $ppt = $('.ppt'), $pp_overlay = $('#pp_overlay'); // Set my global selectors

            //inject the inline gallery
            if( isSet ) {

                currentGalleryPage = 0;
                toInject = "";
                for (var i=0, l=pp_images.length; i < l; i++) {
                    if(!pp_images[i].match(/\b(jpe?g|png|gif)\b/gi)){
                        classname = 'default';
                        img_src = '';
                    }else{
                        classname = '';
                        img_src = pp_images[i];
                    }
                    toInject += "<li class='"+classname+"'><a href='#'><img src='" + img_src + "' width='69' alt='' /></a></li>";
                }

                toInject = settings.gallery_markup.replace(/{gallery}/g,toInject);

                $(toInject).appendTo('#cgallery');

                $pp_gallery = $('.pp_pic_holder .pp_gallery'), $pp_gallery_li = $pp_gallery.find('li');

                $pp_gallery
                    .find('.pp_arrow_next').on('click tap', function() {
                        $.prettyPhoto.changeGalleryPage('next');
                        return false;
                    })
                    .end()
                    .find('.pp_arrow_previous').on('click tap', function() {
                        $.prettyPhoto.changeGalleryPage('previous');
                        return false;
                    });

                $pp_pic_holder.find('.pp_gallery:not(.disabled)').fadeIn();

                itemWidth = 58+12;//thumb width + right margin
                $pp_gallery_li.each(function(i){
                    $(this)
                        .find('a')
                        .on('click tap', function(){
                            $.prettyPhoto.changePage(i);
                            return false;
                        });
                });
            }

            $pp_pic_holder.attr('class','pp_pic_holder ' + settings.theme);// Set the proper theme

            $pp_overlay
                .css({
                    'opacity':0,
                    'height':$(document).height(),
                    'width':$(window).width()
                })
                .on('click tap',function(){
                    $.prettyPhoto.close();
                });

            $('a.pp_close').on('click tap',function(){ $.prettyPhoto.close(); return false; });
            $('.pp_previous, .pp_next').show();

            $pp_pic_holder
                .on('swipeleft', function(){ $.prettyPhoto.changePage('next'); return false; })
                .on('swiperight', function(){ $.prettyPhoto.changePage('previous'); return false; })
                .find('.pp_previous').on('click tap',function(){ $.prettyPhoto.changePage('previous'); return false; })
                .end()
                .find('.pp_next').on('click tap',function(){ $.prettyPhoto.changePage('next'); return false; });

            _center_overlay();
        }

        return this.off('click.prettyphoto').on('click.prettyphoto',$.prettyPhoto.initialize); // Return the jQuery object for chaining. The unbind method is used to avoid click conflict when the plugin is called more than once
    };

    function getParam(name,url){
        name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
        var regexS = "[\\?&]"+name+"=([^&#]*)";
        var regex = new RegExp( regexS );
        var results = regex.exec( url );
        return ( results == null ) ? "" : results[1];
    }

})(jQuery);

var id_good = 0;

function empty_images_arrays() {
    pp_images = []; pp_titles = []; pp_descriptions = [];
};

function loadgallery(mode, callback) {

    if (!mode) {
        mode = ($.prettyPhoto.type) ? $.prettyPhoto.type.toUpperCase() : mode;
    }

    //автоматически определяем mode по первой картинке
    if (typeof mode == 'undefined') {
        if (pp_images[0] && /videos/.test(pp_images[0])) {
            mode = 'VIDEO';
        }
        else if (pp_images[0] && (/(_3d_|\/3dh\/)/.test(pp_images[0]))) {
            mode = '3D';
        }
        else mode = 'IMG';
    }

    var gallery_ord_str = '';
    if (typeof gallery_ord != 'undefined') gallery_ord_str += gallery_ord+'&';

    if ( id_good ) {
        $.getJSON(_mtools_path_ + '/mui_get_img_gallery.php?idg_='+id_good+'&f_type_='+mode+'&'+gallery_ord_str+'callback=?', function( data ) {

            no_filters = !!data.no_filters;

            if (mode == '3D') {
                var path_3d = data['path_3d'];
                pp_images = [''+path_3d];
				path_3d = path_3d.replace(/_3d_/,'');

				(callback || $.noop)();

                if (firstinit) {
                    //обновляем список изображений в галерее
                    $.prettyPhoto.reloadGallery(0, mode);
                    $.prettyPhoto.changePage(0);
                }
                firstinit = true;

                if (typeof data.no_filters == 'undefined') {
                    $('#mode').html(((data.NumPhoto > 0) ? '<span id="g_load_img" data-act="IMG" class="'+(mode=='IMG'?'selected ib':'ib')+'"><em>'+_i('Фотографии')+'</em></span> ' : '') +((data.NumVideo > 0) ? '&nbsp; <span id="g_load_video" data-act="VIDEO" class="'+((mode=='VIDEO')?'selected ib':'ib')+'"><em>'+_i('Видеообзоры')+'</em></span>' : '') + ( (path_3d) ? (' &nbsp; <span id="g_load_3d" data-act="3D" class="'+(mode=='3D'?'selected ib':'ib')+'"><em>'+_i('3D обзор')+'</em></span>') : '' ));
                    $('#g_load_img, #g_load_video, #g_load_3d').on('click tap', function(){ empty_images_arrays(); loadgallery($(this).data('act')); })
                }
                else {
                    $('#mode').css('height', 0).html('');
                }
                return;
            }

            //готовим список с учетом первой картинки
            pp_image = pp_images[0];
            if (pp_images[1]) {
                pp_current = pp_images[0];
                pp_image = pp_images[1];
            } else {
                pp_current = null;
            }
            //todo хак для video
            if (pp_image)
                pp_image = pp_image.replace(/&/g, '&amp;');

            empty_images_arrays();

            if ( data.pp_images ) {
                var pos = -1;
                if (pp_current){
                    for(prop in data.pp_images){
                        if (data.pp_images.hasOwnProperty(prop)) {
                            if (pp_current == data.pp_images[prop]){
                                pos = prop;
                                break
                            }
                        }
                    }
                    if(pos < 0 && pp_image != pp_current) {
                        pp_images.push(pp_current);
                    }
                    pos = 0;
                }
                $.each(data.pp_images, function(key, value) {
                    pp_images.push(value);
                    pp_titles.push(data.pp_titles[key]);
                    pp_descriptions.push(data.pp_descriptions[key]);
                });
                if (mode == "IMG" && typeof pp_image != 'undefined' && pp_image.length && $.inArray(pp_image, pp_images) < 0) {
                    pp_images.unshift(pp_image);
                }
//                var custom_markup='custom=true';

//                pp_images.push(custom_markup);
//                pp_titles.push('');
//                pp_descriptions.push('');

                if (pp_images.length >= 1) {
                    if (pos < 0) {
                        pos = $.inArray(pp_image, pp_images);
                        if (pos < 0) pos = 0;
                    }

                    //для видео необходимо в галерею загружать sub
                    pp_video_sub = data.pp_video_sub;
//                    if (pp_video_sub) pp_video_sub['1000000'] = custom_markup;

                    //обновляем список изображений в галерее
                    $.prettyPhoto.reloadGallery(pos, mode);

                    //добавляем данные об обзорах
                    //todo нужно убрать этот хак а подключить стрелки как-то
                    if (!pp_image && pp_images[0]) $.prettyPhoto.changePage(pos);
                    //при переключении на режим фоток
                    if (mode != 'VIDEO' && firstinit) $.prettyPhoto.changePage(pos);

                    var path_3d = data['path_3d'];
                    if (typeof data.no_filters == 'undefined') {
                        $('#mode').html(((data.NumPhoto > 0) ? '<span id="g_load_img" data-act="IMG" class="'+(mode=='IMG'?'selected ib':'ib')+'"><em>'+_i('Фотографии')+'</em></span> ' : '') +((data.NumVideo > 0) ? '&nbsp; <span id="g_load_video" data-act="VIDEO" class="'+((mode=='VIDEO')?'selected ib':'ib')+'"><em>'+_i('Видеообзоры')+'</em></span>' : '') + ( (path_3d) ? (' &nbsp; <span id="g_load_3d" data-act="3D" class="'+(mode=='3D'?'selected ib':'ib')+'"><em>'+_i('3D обзор')+'</em></span>') : '' ));
                        $('#g_load_img, #g_load_video, #g_load_3d').on('click tap', function(){ empty_images_arrays(); loadgallery($(this).data('act')); })

                    }
                    else {
                        $('#mode').css('height', 0).html('');
                    }
                }

            }

//            if (mode == 'ADD') {
//                $.prettyPhoto.changePage(pp_images.length-1);
//            }

            firstinit = true;

            if (mode == "IMG" && data.NumPhoto && parseInt(data.NumPhoto) == 0 && $.trim(pp_image)=='') {
                //#n-879
                pp_images = ["/jpg/"+id_good+".jpg"];
                //обновляем список изображений в галерее
                return $.prettyPhoto.changePage(0);

            }

            var win_width = $(window).width();

            if (id_good) {
                var view = (/ek\.ua|e-katalog/i.test(_domain_)) ? 'photo' : 'medias';
                var $cadd = $('#cadd');
                var href = _lang_url_ + '/' + _item_scr_ + '?idg_=' + id_good + '&view_=' + view + '&idr_=new';

                $cadd
                    .css({
                        'width': win_width - 40,
                        'left': '-' + (win_width / 2 - $('#mode').width() / 2 - 20) + 'px'
                    })
                    .find('a')
                    .attr('href', href);

                if (mode !== "IMG") {
                    // если не катринка, то показем область здесь
                    $pp_pic_holder.children().css('visibility', 'visible');
                    $cadd.fadeIn();
                }

                $('#cadd, #cadd a, #cadd span').on('tap', function () {
                    location.href = href;
                });
            }
        });
    }

    (callback || $.noop)();
}

$(function() {
    $("a[rel^='prettyPhoto']").prettyPhoto({
        initcallback: function() {loadgallery();},
        default_width: 500*1.5,
        default_height: 344*1.5
    });
});