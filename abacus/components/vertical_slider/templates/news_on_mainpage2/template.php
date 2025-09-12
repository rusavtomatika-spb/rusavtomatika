<?
if (!defined('cms'))
    exit;
?>
<link rel="stylesheet" type="text/css" href="/cms/components/vertical_slider/templates/news_on_mainpage2/style.css">
<div class="feat1" style="float:right;padding: 0px;border-top: none;">
    <div class="feat2" style="padding: 30px 10px 0px 15px;">
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;">Статьи</span>
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;margin: 0 5px;"> / </span>
        <a style="vertical-align:bottom;color:#34ab5e;font-size: 15px;text-decoration: underline;line-height: 20px;font-weight: bold;"
           href="/articles/">Все статьи</a>
    </div>
</div>
<div class="feat1" style="padding: 0px;border-top: none;">
    <div class="feat2" style="padding: 30px 10px 0px 15px;">
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;">Новости</span>
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;margin: 0 5px;"> / </span>
        <a style="vertical-align:bottom;color:#34ab5e;font-size: 15px;text-decoration: underline;line-height: 20px;font-weight: bold;"
           href="/news.php">Все новости</a>
    </div>
</div>
<div class="wrap_jcarousel">
    <div class="jcarousel_news">
        <ul>
            <?
            foreach ($arResult["news_list"] as $key => $value) {

                if (isset($arguments["SEF2"]["element"])) {
                    $url = str_replace("#element_code#", $value["sys_name"], $arguments["SEF2"]["element"]);
                    $url = str_replace("#table#", $value["table"], $url);
                } else {
                    $url = str_replace("#element_code#", $value["sys_name"], $arguments["SEF"]["element"]);
                }

                //var_dump($arguments["SEF"]);
                ?>
                <li>
                    <div class="vertical_slider_newsonmainpage__item">
                        <div class="vertical_slider_newsonmainpage__item_wrapinn">
                            <a href="<?= $url ?>" class="vertical_slider_newsonmainpage__item__item_link">
                                <div class="vertical_slider_newsonmainpage__item__item_picture_preview_wrap">
                                    

                                    <img src="<?= $value["img"]; ?>" alt="<?=$value["name"]?>" loading="lazy">
                                </div>

                                <div class="vertical_slider_newsonmainpage__item__item_name_wrap">
                                    <div class="vertical_slider_newsonmainpage__item__item_name">
                                        <?
                                        $time = strtotime($value["date"]);
                                        $myFormatForView = date("d.m.Y", $time);
                                        ?>
                                        <span class="vertical_slider_newsonmainpage__item_date"><?= $myFormatForView ?></span><?
                                        if (strlen($value["name"]) > 105) {
                                            echo substr(strip_tags($value["name"]), 0, 102) . "...";
                                        } else {
                                            echo strip_tags($value["name"]);
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="vertical_slider_newsonmainpage__item__item_text_preview_wrap">
                                    <div class="vertical_slider_newsonmainpage__item__item_text_preview">
                                        <?
                                        if (strlen($value["stext"]) > 233) {
                                            echo substr(strip_tags($value["stext"]), 0, 230) . "...";
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
                </li>
                <?
            }
            ?>
            <li>
                <div class="vertical_slider_newsonmainpage__item">
                    <div class="vertical_slider_newsonmainpage__item_wrapinn">
                        <a href="/news.php" class="vertical_slider_newsonmainpage__item__item_link">
                            <div class="vertical_slider_newsonmainpage__item__item_name_wrap">
                                <div class="vertical_slider_newsonmainpage__item__item_name"
                                     style="padding: 55px 0;text-align: center;font-size: 15px;">
                                    Перейти в раздел всех новостей
                                </div>
                            </div>
                            <div class="vertical_slider_newsonmainpage__item__item_text_preview_wrap">
                                <div class="vertical_slider_newsonmainpage__item__item_text_preview">
                                </div>
                            </div>
                            <span class="fog-white"></span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <a class="news_jcarousel-prev" href="#">Prev</a>
    <a class="news_jcarousel-next" href="#">Next</a>
</div>


<script type="text/javascript">


    $(function () {
        // Инициализация слайдера


        jQuery('.jcarousel_news').jcarousel({
            scroll: 3,
            size: 15,
            wrap: 'null',
            vertical: true,
            buttonNextHTML: '<div>></div>',
            buttonPrevHTML: '<div><</div>',
            buttonNextEvent: 'click',
            buttonPrevEvent: 'click',

            animation: {
                duration: 500,
                easing: 'linear',
                complete: function () {
                }
            }

        });
        $('.news_jcarousel-prev').jcarouselControl({
            target: '-=3'
        });

        $('.news_jcarousel-next').jcarouselControl({
            target: '+=3'
        });


    });

</script>
