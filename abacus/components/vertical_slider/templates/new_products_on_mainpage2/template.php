<?
if (!defined('cms'))
    exit;
?>
<link rel="stylesheet" type="text/css" href="/cms/components/vertical_slider/templates/new_products_on_mainpage2/style.css" >
<div class="feat1" style="padding: 0px;border-top: none;">
    <div class="feat2" style="padding: 30px 10px 0px 0px;">
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;">Новинки продукции</span>
        <span style="font-size: 18px;line-height: 20px;font-weight: bold;margin: 0 5px;"> / </span>
        <a style="vertical-align:bottom;color:#34ab5e;font-size: 15px;text-decoration: underline;line-height: 20px;font-weight: bold;" href="/new-products/">Все новинки</a>
    </div>
</div>
<div class="wrap_jcarousel" style="margin-left:-15px;">
    <div class="jcarousel_new_products">
        <ul>
            <?
            /*
            $count = 0;
            $arResult["news_list_reversed"] = [];
            foreach ($arResult["news_list"] as $value) {
                $arResult["news_list_reversed_temp"][] = $value;
                $count++;
            
                if($count == 3){
                    echo "@@!!";
                    var_dump($arResult["news_list_reversed_temp"]);
                    $arResult["news_list_reversed_temp"] = array_reverse($arResult["news_list_reversed_temp"]);
                    echo "@@";
                    var_dump($arResult["news_list_reversed_temp"]);
                    $arResult["news_list_reversed"] = array_merge($arResult["news_list_reversed"], $arResult["news_list_reversed_temp"]);
                    $arResult["news_list_reversed_temp"] = null;
                $count = 0;
                }
                
             
                
            }
            var_dump($arResult["news_list"]);
            echo 'asdasdasd';
            var_dump($arResult["news_list_reversed"]);
             */  
            foreach ($arResult["news_list"] as $key => $value) {

                $url = str_replace("#element_code#", $value["code"], $arguments["SEF"]["element"]);
                //var_dump($arguments["SEF"]);
                ?>
                <li>
                    <div class="vertical_slider_new_productsonmainpage__item">
                        <div class="vertical_slider_new_productsonmainpage__item_wrapinn">
            <a href="<?if($value["url_page_detail"]):?><?=$value["url_page_detail"]?><?else:?><?= $url ?><?endif;?>" class="vertical_slider_new_productsonmainpage__item__item_link">
                                <div class="vertical_slider_new_productsonmainpage__item__item_picture_preview_wrap">                  
                                    <img src="<?= $value["picture_preview"]; ?>" alt="<?=$value["name"]?>" loading="lazy" >
                                </div>

                                <div class="vertical_slider_new_productsonmainpage__item__item_name_wrap">
                                    <div class="vertical_slider_new_productsonmainpage__item__item_name">
                                        <?
                                        if ($value["date"] != "0000-00-00"):
                                            $time = strtotime($value["date"]);
                                            $myFormatForView = date("d.m.Y", $time);
                                            ?><span class="vertical_slider_new_productsonmainpage__item_date"><?= $myFormatForView ?></span><?
                                        endif;
                                        if (strlen($value["name"]) > 105) {
                                            echo substr(strip_tags($value["name"]), 0, 102) . "...";
                                        } else {
                                            echo strip_tags($value["name"]);
                                        }
                                        ?>
                                    </div>

                                    <div class="vertical_slider_new_productsonmainpage__item__item_text_preview xxx">
                                        <?
                                        if (strlen($value["text_preview"]) > 263) {
                                            echo substr(strip_tags($value["text_preview"]), 0, 260) . "...";
                                        } else {
                                            echo strip_tags($value["text_preview"]);
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
                <div class="vertical_slider_new_productsonmainpage__item">
                    <div class="vertical_slider_new_productsonmainpage__item_wrapinn">
                        <a href="/new-products/" class="vertical_slider_new_productsonmainpage__item__item_link">
                            <div class="vertical_slider_new_productsonmainpage__item__item_name_wrap">
                                <div class="vertical_slider_new_productsonmainpage__item__item_name" style="padding: 55px 0;text-align: center;font-size: 15px;">
                                    Перейти в раздел всех новинок
                                </div>
                            </div>
                            <div class="vertical_slider_new_productsonmainpage__item__item_text_preview_wrap">
                                <div class="vertical_slider_new_productsonmainpage__item__item_text_preview">
                                </div>
                            </div>
                            <span class="fog-white"></span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <a class="jcarousel-prev" href="#">Prev</a>
    <a class="jcarousel-next" href="#">Next</a>
</div>


<script type="text/javascript">


    $(function () {
        // Инициализация слайдера


        jQuery('.jcarousel_new_products').jcarousel({
            scroll: 4,
            size: 16,
            wrap: 'null',
            vertical: true,
            buttonNextHTML: '<div>></div>',
            buttonPrevHTML: '<div><</div>',
            buttonNextEvent: 'click',
            buttonPrevEvent: 'click',

            animation: {
                duration: 500,
                easing: 'linear',
                complete: function () {}
            }

        });
        $('.jcarousel-prev').jcarouselControl({
            target: '-=3'
        });

        $('.jcarousel-next').jcarouselControl({
            target: '+=3'
        });




    });

</script>
