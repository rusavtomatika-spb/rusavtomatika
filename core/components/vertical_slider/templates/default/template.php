<?
if (!defined('cms'))
    exit;
?>



<div class="vertical_slider_default">
    <div id="carouselhAuto2">
        <?
        foreach ($arResult["news_list"] as $key => $value) {

            $url = str_replace("#element_code#", $value["code"], $arguments["SEF"]);
            ?>
            <div class="vertical_slider_default__item">
                <div class="vertical_slider_default__item_wrapinn">
                    <a href="<?= $url ?>" class="vertical_slider_default__item__item_link">
                        <div class="vertical_slider_default__item__item_name_wrap"><div class="vertical_slider_default__item__item_name">
                                <?
                                if (strlen($value["name"]) > 65) {
                                    echo substr(strip_tags($value["name"]), 0, 62) . "...";
                                } else {
                                    echo strip_tags($value["name"]);
                                }
                                ?>
                            </div></div>
                        <div class="vertical_slider_default__item__item_picture_preview_wrap">
                            <div class="vertical_slider_default__item__item_picture_preview" style="background-image: url('<?= $value["picture_preview"]; ?>')"></div>
                        </div>
                    </a>
                </div>
            </div>
            <?
        }
        ?>
    </div>
</div>
<style>
    .vertical_slider_default{background: #fff;padding: 0 0px;position: relative;}
    .vertical_slider_default a{text-decoration: none;}
    .vertical_slider_default__item{padding:5px;}
    .vertical_slider_default__item_wrapinn{padding:0px 10px 10px 10px ;box-shadow: 0 0 3px rgba(0,0,0,0.3);transition: 0.1s}
    .vertical_slider_default__item_wrapinn:hover{box-shadow: 0 0 5px rgba(0,0,0,0.4);
                                                 padding:1px 11px 11px 11px ;
                                                 margin: -1px;
    }


    .vertical_slider_default__item__item_picture_preview_wrap{display: table;width: 100%;}
    .vertical_slider_default__item__item_name{
        padding: 0px 0px 2px;
        color: #333;
        font-size: 13px;font-weight: bold;line-height: 1.1;
        text-decoration: none;
        height: 40px;overflow: hidden;display: table-cell;vertical-align: middle;width: 100%;text-align: left;}
    .vertical_slider_default__item__item_picture_preview{
        background: center top/auto 100% no-repeat;
        width: 100%;
        height: 150px;

    }
</style>

<style>
    /*¬ериткальна€ карусель CSS*/
    .jscarousal-vertical{                       /* ширина и высота коробки дл€ слайдов */
        width: 300px;
        height: 677px;
        margin: 0;
        padding: 0;
        position: relative;
        overflow: hidden;
    }
    .jscarousal-contents-vertical{              /* ширина и высота области где слайды */
        overflow: hidden;
        width: 300px;
        height: 615px;}
    .jscarousal-vertical-back, .jscarousal-vertical-forward{
        position: absolute;
        width: 40px;
        left: 50%;
        margin-left: -20px;
        height: 30px;
        background-color: #34ab5e;
        color: White;
        position: relative;
        cursor: pointer;
        z-index:10;}
    .jscarousal-vertical-back{
        border-radius: 4px;
        background-image: url(/cms/components/vertical_slider/templates/default/img/arr-up.png);
        background-repeat: no-repeat;
        background-position: center;
        top:0px;}
    .jscarousal-vertical-forward{
        border-radius: 4px;
        background-image: url(/cms/components/vertical_slider/templates/default/img/arr-down.png);
        background-repeat: no-repeat;
        background-position: center;}
    .jscarousal-contents-vertical > div{
        position: absolute;
        top: 20px;
        width: 100%;
        height: 670px;
        overflow: hidden;}
    .jscarousal-contents-vertical > div > div span{
        display: block;
        width: 70%;
        text-align: center;}
    /*¬ериткальна€ карусель CSS*/

    /*ќбщие*/
    .hidden{	display: none;    }
    .visible{	display: block;}
    .thumbnail-active{
        filter: alpha(opacity=100);
        opacity: 1.0;
        cursor: pointer;}
    .thumbnail-inactive{
        filter: alpha(opacity=90);
        opacity: 0.9;
        cursor: pointer;}
    .thumbnail-text {
        color: #E0E0E0;
        font-weight: bold;
        text-align: left;
        display: block;
        padding: 2px 2px 2px 0px;
        line-height: 16px;
        font-size: 12px;
    }
    .thumbnail-text a{
        color: #E0E0E0; text-decoration: none;    font-size: 12px;}
    .thumbnail-text a:hover{
        color: #fff;}
</style>


<script src="/cms/components/vertical_slider/templates/default/jsCarousel-2.0.0.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
//¬ертикальна€
        $('#carouselhAuto2').jsCarousel({
            onthumbnailclick: function (src) { /* alert(src);*/
            }, //функци€ при нажатии на картинку
            autoscroll: true, //вкл/выкл автопрокрутку
            itemstodisplay: 3, //сколько слайдов отображать
            scrollspeed: 500, //врем€ эффекта прокрутки
            delay: 10000, //врем€ прокрутки слайдов
            orientation: 'v', //горизонтальна€ h или вертикальна€ v карусель
            circular: true
        });
    });
</script>