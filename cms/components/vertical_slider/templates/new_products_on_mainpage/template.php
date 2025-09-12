<?
if (!defined('cms'))
    exit;
?>
<link rel="stylesheet" type="text/css" href="/cms/components/vertical_slider/templates/new_products_on_mainpage/style.css" >

<div class="feat1" style="padding: 0px;border-top: none;">
    <div class="feat2" style="padding: 30px 10px 0px 0px;">
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;">Новинки продукции</span>
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;margin: 0 5px;"> / </span>
        <a style="vertical-align:bottom;color:#34ab5e;font-size: 15px;text-decoration: underline;line-height: 20px;font-weight: bold;" href="/new-products/">Все новинки</a>
    </div>
</div>



<div class="vertical_slider_newproductsonmainpage">
    <div id="new_products_on_mainpage">
        <?
        foreach ($arResult["news_list"] as $key => $value) {
            $url = str_replace("#element_code#", $value["code"], $arguments["SEF"]["element"]);
            //var_dump($arguments["SEF"]);
            ?>
            <div class="vertical_slider_newsonmainpage__item">
                <div class="vertical_slider_newsonmainpage__item_wrapinn">
                    <a href="<?= $url ?>" class="vertical_slider_newsonmainpage__item__item_link">
                        <div class="vertical_slider_newsonmainpage__item__item_picture_preview_wrap">
                            <div class="vertical_slider_newsonmainpage__item__item_picture_preview" style="background-image: url('<?= $value["picture_preview"]; ?>')"></div>
                        </div>

                        <div class="vertical_slider_newsonmainpage__item__item_name_wrap"><div class="vertical_slider_newsonmainpage__item__item_name">
                                <?
                                if (strlen($value["name"]) > 85) {
                                    echo substr(strip_tags($value["name"]), 0, 82) . "...";
                                } else {
                                    echo strip_tags($value["name"]);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="vertical_slider_newsonmainpage__item__item_text_preview_wrap"><div class="vertical_slider_newsonmainpage__item__item_text_preview">
                                <?
                                if (strlen($value["text_preview"]) > 250) {
                                    echo substr(strip_tags($value["text_preview"]), 0, 246) . "...";
                                } else {
                                    echo strip_tags($value["text_preview"]);
                                }
                                ?>
                            </div></div>

                        <span class="fog-white"></span>

                    </a>
                </div>
            </div>
            <?
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
//Вертикальная
        $('#new_products_on_mainpage').jsCarousel({
            onthumbnailclick: function (src) { /* alert(src);*/
            }, //функция при нажатии на картинку
            autoscroll: true, //вкл/выкл автопрокрутку
            itemstodisplay: 3, //сколько слайдов отображать
            scrollspeed: 550, //время эффекта прокрутки
            orientation: 'v', //горизонтальная h или вертикальная v карусель
            circular: false,
        });
        /*setTimeout(function () {
         $('#new_products_on_mainpage .jscarousal-vertical-forward').click();
         }, 1000);*/

    });
</script>