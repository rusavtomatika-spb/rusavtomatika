<?
CoreApplication::add_style( "/core/components/big_slider/templates/big_slide_banner/style.css");
//CoreApplication::add_style( "/core/components/big_slider/templates/big_slide_banner/cycle.css");
//CoreApplication::add_style( "/core/components/big_slider/templates/big_slide_banner/animate.min.css");
//CoreApplication::add_style( "/core/components/big_slider/templates/big_slide_banner/animation_slider.css");
//CoreApplication::add_script( "/core/components/big_slider/templates/big_slide_banner/jquery.cycle2.js");
//CoreApplication::add_script( "/core/components/big_slider/templates/big_slide_banner/jquery.cycle2.carousel.js");
//CoreApplication::add_script( "/core/components/big_slider/templates/big_slide_banner/jquery.cycle2.tile.js");
//CoreApplication::add_script( "/core/components/big_slider/templates/big_slide_banner/jquery.cycle2.swipe.min.js");
//CoreApplication::add_script( "/core/components/big_slider/templates/big_slide_banner/ios6fix.js");
?>
    <script src="/js/jssor.slider-28.1.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.jssor_1_slider_init = function() {

            var jssor_1_SlideoTransitions = [
              [{b:3400,d:1000,x:55,e:{x:24}}],
              [{b:3800,d:1000,x:57,e:{x:24}}],
              [{b:4200,d:1000,x:57,e:{x:24}}],
              [{b:5400,d:1000,x:60,e:{x:24}}],
              [{b:5000,d:1000,x:269,e:{x:24}}],
              [{b:4600,d:1000,x:478,e:{x:24}}],
              [{b:0,d:1000,y:17,e:{y:30}},{b:10000,d:400,y:0,e:{y:25}},{b:10400,d:400,y:17,e:{y:25}}],
              [{b:400,d:1000,y:30,e:{y:30}},{b:10800,d:400,y:13,e:{y:25}},{b:11200,d:400,y:30,e:{y:25}}],
              [{b:800,d:1000,y:29,e:{y:30}},{b:11600,d:400,y:12,e:{y:25}},{b:12000,d:400,y:29,e:{y:25}}],
              [{b:1200,d:1000,y:29,e:{y:30}},{b:12400,d:400,y:12,e:{y:25}},{b:12800,d:400,y:29,e:{y:25}}],
              [{b:1600,d:1000,y:29,e:{y:30}},{b:13200,d:400,y:12,e:{y:25}},{b:13600,d:400,y:29,e:{y:25}}],
              [{b:2000,d:1000,y:19,e:{y:30}},{b:14000,d:400,y:2,e:{y:25}},{b:14400,d:400,y:19,e:{y:25}}],
              [{b:2400,d:1000,y:21,e:{y:30}},{b:14800,d:400,y:4,e:{y:25}},{b:15200,d:400,y:21,e:{y:25}}],
              [{b:3000,d:1000,x:55,e:{x:24}}]
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $Idle: 3000000,
              $AutoPlaySteps: 3,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions,
                $Controls: [{r:6200,e:18080},{r:7000,e:18080},{r:7800,e:18080},{r:8600,e:18080},{r:9400,e:18080},{r:10200,e:18080},{r:11000,e:18080}]
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 1340;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&subset=latin-ext,cyrillic-ext,vietnamese,latin,cyrillic" rel="stylesheet" type="text/css" />
    <style>
    </style>
    <div id="jssor_1" style="position:relative; margin:0 auto;top:0px;margin-top: 30px;left:0px;width:1340px;height:360px;overflow:hidden;visibility:hidden;background-color:#1c3329;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-position:50% 50%;background-repeat:no-repeat;background-image:url('/img/ios-x.svg');background-color:rgba(255, 255, 255, 0.7);background-size:30px 30px;"></div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1340px;height:360px;overflow:hidden;">
            <div style="background-image:linear-gradient(135deg,#1c3329 0%,#00703f 100%);" data-p="850">
                <div data-to="50% 50%" data-t="0" style="left:-537px;top:84px;width:510px;height:40px;position:absolute;color:#FFFFFF;font-family:Montserrat,sans-serif;font-size:26px;font-weight:700;line-height:1.2;text-align:left;">на ПЛК и МОДУЛИ ввода/вывода</div>
                <div data-to="50% 50%" data-t="1" style="left:-473px;top:146px;width:430px;height:60px;position:absolute;color:#ffffff;font-family:Montserrat,sans-serif;font-size:22px;line-height:1.2;text-align:left;">Мы зафиксировали цены в рублях на модульную серию Weintek</div>
                <div data-to="50% 50%" data-t="2" style="left:-472px;top:206px;width:430px;height:38px;position:absolute;color:#ffffff;font-family:Montserrat,sans-serif;font-size:22px;line-height:1.2;text-align:left;">Скидка до 50% от цен прошлого года</div><a data-to="50% 50%" href="/articles/modulnyy-vvodvyvod-kaplery-serii-ir-i-plk-weintek/" data-t="3" style="left:-244px;top:277px;width:176px;height:40px;display:block;position:absolute;color:#000000;border:1px solid #ffffff;background-clip:padding-box;font-family:Montserrat,sans-serif;font-size:14px;font-weight:600;text-align:center;padding:10px 0px 0px 0px;box-sizing:border-box;background-color:#ffde05;">ОБЗОР МОДУЛЕЙ</a><a data-to="50% 50%" href="/catalog/modules_io/" data-t="4" style="left:-251px;top:277px;width:176px;height:40px;display:block;position:absolute;color:#000000;border:1px solid #19ff7c;background-clip:padding-box;font-family:Montserrat,sans-serif;font-size:14px;font-weight:600;text-align:center;padding:10px 0px 0px 0px;box-sizing:border-box;background-color:#10cd61;">ВЫБРАТЬ МОДУЛИ</a><a data-to="50% 50%" href="/weintek/cMT-CTRL01/" data-t="5" style="left:-142px;top:277px;width:79px;height:40px;display:block;position:absolute;color:#000000;border:1px solid #19ff7c;background-clip:padding-box;font-family:Montserrat,sans-serif;font-size:14px;font-weight:600;text-align:center;padding:10px 0px 0px 0px;box-sizing:border-box;background-color:#10cd61;">ПЛК</a>
                <img data-to="50% 50%" data-t="6" data-c="0" style="left:599px;top:-354px;width:271px;height:323px;position:absolute;max-width:271px;" src="/img/1.png" />
                <img data-to="50% 50%" data-t="7" data-c="1" style="left:767px;top:-335px;width:172px;height:298px;position:absolute;max-width:172px;" src="/img/2.png" />
                <img data-to="50% 50%" data-t="8" data-c="2" style="left:834px;top:-344px;width:174px;height:302px;position:absolute;max-width:174px;" src="/img/3.png" />
                <img data-to="50% 50%" data-t="9" data-c="3" style="left:901px;top:-346px;width:176px;height:306px;position:absolute;max-width:176px;" src="/img/4.png" />
                <img data-to="50% 50%" data-t="10" data-c="4" style="left:968px;top:-348px;width:178px;height:309px;position:absolute;max-width:178px;" src="/img/5.png" />
                <img data-to="50% 50%" data-t="11" data-c="5" style="left:1030px;top:-369px;width:184px;height:333px;position:absolute;max-width:184px;" src="/img/7.png" />
                <img data-to="50% 50%" data-t="12" data-c="6" style="left:1110px;top:-365px;width:189px;height:330px;position:absolute;max-width:189px;" src="/img/9.png" />
                <div data-to="50% 50%" data-t="13" style="left:-542px;top:28px;width:509px;height:73px;position:absolute;color:#FFE100;font-family:Montserrat,sans-serif;font-size:40px;font-weight:900;line-height:1.2;text-align:left;">СПЕЦПРЕДЛОЖЕНИЕ</div>
            </div>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();
    </script>
<div id="main_page__block_big_slider"></div>