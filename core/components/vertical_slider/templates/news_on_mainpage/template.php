<?
if (!defined('cms'))
    exit;
?>
<link rel="stylesheet" type="text/css" href="/cms/components/vertical_slider/templates/news_on_mainpage/style.css" >


<div class="feat1" style="padding: 0px;border-top: none;">
    <div class="feat2" style="padding: 30px 10px 0px 15px;">

        <span style="font-size: 18px;line-height: 20px;font-weight: bold;">Новости</span>
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;margin: 0 5px;"> / </span>
        <a style="vertical-align:bottom;color:#34ab5e;font-size: 15px;text-decoration: underline;line-height: 20px;font-weight: bold;" href="/news.php">Все новости</a>


    </div>
</div>

<div class="vertical_slider_newsonmainpage">
    <div id="news_on_mainpage">
        <?
        foreach ($arResult["news_list"] as $key => $value) {

            $url = str_replace("#element_code#", $value["sys_name"], $arguments["SEF"]["element"]);
            //var_dump($arguments["SEF"]);
            ?>
            <div class="vertical_slider_newsonmainpage__item">
                <div class="vertical_slider_newsonmainpage__item_wrapinn">
                    <a href="<?= $url ?>" class="vertical_slider_newsonmainpage__item__item_link">
                        <div class="vertical_slider_newsonmainpage__item__item_picture_preview_wrap">
                            <div class="vertical_slider_newsonmainpage__item__item_picture_preview xxx1" style="background-image: url('<?= $value["img"]; ?>')"></div>
                        </div>

                        <div class="vertical_slider_newsonmainpage__item__item_name_wrap">
                            <div class="vertical_slider_newsonmainpage__item__item_name">
                                <?
                                $time = strtotime($value["date"]);
                                $myFormatForView = date("d.m.Y", $time);
                                ?><span class="vertical_slider_newsonmainpage__item_date"><?= $myFormatForView ?></span><?
                                if (strlen($value["name"]) > 95) {
                                    echo substr(strip_tags($value["name"]), 0, 92) . "...";
                                } else {
                                    echo strip_tags($value["name"]);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="vertical_slider_newsonmainpage__item__item_text_preview_wrap">
                            <div class="vertical_slider_newsonmainpage__item__item_text_preview xxx">
                                <?
                                if (strlen($value["stext"]) > 263) {
                                    echo substr(strip_tags($value["stext"]), 0, 260) . "...";
                                } else {
                                    echo strip_tags($value["stext"]);
                                }
                                ?>
                            </div>
                        </div>
                        <span class="fog-white"></span>
                    </a>
                </div>
            </div>
            <?
        }
        ?>
    </div>
</div>



<? /* ?><script src="/cms/components/vertical_slider/templates/default/jsCarousel-2.0.0.js" type="text/javascript"></script><? */ ?>
<script type="text/javascript">
    $(document).ready(function () {
//Вертикальная
        $('#news_on_mainpage').jsCarousel({
            onthumbnailclick: function (src) { /* alert(src);*/
            }, //функция при нажатии на картинку
            autoscroll: false, //вкл/выкл автопрокрутку
            itemstodisplay: 3, //сколько слайдов отображать
            scrollspeed: 500, //время эффекта прокрутки
            delay: 15000, //время прокрутки слайдов
            orientation: 'v', //горизонтальная h или вертикальная v карусель
            circular: true
        });
        setTimeout(function () {
            $('#news_on_mainpage .jscarousal-vertical-forward').click();
        }, 1000);

    });
</script>