<?
if (!defined('cms'))
    exit;
?>



<div class="vertical_slider_default">
    <div id="carouselhAuto2">
        <?
        foreach ($arResult["news_list"] as $key => $value) {

            $url = str_replace("#element_code#", $value["code"], $arguments["SEF"]["element"]);
            //var_dump($arguments["SEF"]);
            ?>
            <div class="vertical_slider_default__item">
                <div class="vertical_slider_default__item_wrapinn">
                    <a href="<?if($value["url_page_detail"]):?><?=$value["url_page_detail"]?><?else:?><?= $url ?><?endif;?>" class="vertical_slider_default__item__item_link">
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
                        <div class="vertical_slider_default__item__item_text_preview_wrap"><div class="vertical_slider_default__item__item_text_preview">
                                <?
                                if (strlen($value["text_preview"]) > 145) {
                                    echo substr(strip_tags($value["text_preview"]), 0, 142) . "...";
                                } else {
                                    echo strip_tags($value["text_preview"]);
                                }
                                ?>
                            </div></div>



                    </a>
                </div>
            </div>
            <?
        }
        ?>
    </div>
</div>
<style>
    .vertical_slider_default{background: #fff;padding: 0 10px;position: relative;margin-top: 18px;}
    .vertical_slider_default a{text-decoration: none;}
    .vertical_slider_default__item{padding:5px;}
    .vertical_slider_default__item_wrapinn{padding:0px 20px 10px 20px ;box-shadow: 0 0 3px rgba(0,0,0,0.3);transition: 0.1s}
    .vertical_slider_default__item_wrapinn:hover{box-shadow: 0 0 5px rgba(0,0,0,0.4);
                                                 padding:1px 21px 11px 21px ;
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
        height: 160px;
    }
    .vertical_slider_default__item__item_text_preview_wrap{padding: 10px 0 5px;}
    .vertical_slider_default__item__item_text_preview{color: #333;line-height: 1.1;font-size: 13px;}
</style>

<style>
    /*Вериткальная карусель CSS*/
    .jscarousal-vertical{                       /* ширина и высота коробки для слайдов */
        width: 330px;
        height: 950px;
        margin: 0;
        padding: 0;
        position: relative;
        overflow: hidden;
    }
    .jscarousal-contents-vertical{              /* ширина и высота области где слайды */
        overflow: hidden;
        width: 330px;
        height: 888px;}
    .jscarousal-vertical-back, .jscarousal-vertical-forward{
        position: absolute;
        width: 40px;
        left: 50%;
        margin-left: -20px;
        height: 30px;
        background-color: #000;
        color: White;
        position: relative;
        cursor: pointer;
        z-index:100;
        opacity:0.3;
        transition: 0.2s;}
    .vertical_slider_default:hover .jscarousal-vertical-back, .vertical_slider_default:hover .jscarousal-vertical-forward{
        opacity:0.7;
        background-color: #34ab5e;
    }
    .jscarousal-vertical-back:hover, .jscarousal-vertical-forward:hover{
        opacity:1 !important;
        background-color: #34ab5e;
    }

    .jscarousal-vertical-back{
        background-image: url(/cms/components/vertical_slider/templates/default/img/arr-up.png);
        background-repeat: no-repeat;
        background-position: center;
        top:0px;}
    .jscarousal-vertical-forward{
        background-image: url(/cms/components/vertical_slider/templates/default/img/arr-down.png);
        background-repeat: no-repeat;
        background-position: center;}
    .jscarousal-contents-vertical > div{
        position: absolute;
        top: 35px;
        width: 100%;
        height: 900px;
        overflow: hidden;}
    .jscarousal-contents-vertical > div > div span{
        display: block;
        width: 70%;
        text-align: center;}
    /*Вериткальная карусель CSS*/

    /*Общие*/
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
//Вертикальная
        $('#carouselhAuto2').jsCarousel({
            onthumbnailclick: function (src) { /* alert(src);*/
            }, //функция при нажатии на картинку
            autoscroll: true, //вкл/выкл автопрокрутку
            itemstodisplay: 3, //сколько слайдов отображать
            scrollspeed: 500, //время эффекта прокрутки
            delay: 10000, //время прокрутки слайдов
            orientation: 'v', //горизонтальная h или вертикальная v карусель
            circular: true
        });
    });
</script>