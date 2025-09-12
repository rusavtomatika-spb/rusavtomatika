<?php
$arResult["items"] = CoreApplication::get_rows_from_table("`videos`", "date,name,code,	text_preview,picture_preview", "`show` = '1'", "date DESC", 10);
$count = count($arResult["items"]);
if ($count > 0):
    ?>
    <div class="glide" id="glide_video">
        <div class="glide__track" data-glide-el="track" style="padding-bottom: 2.5rem !important;">
            <ul class="glide__slides">
                <?

                for ($x = 0; $x < $count; $x++) {
                    if (isset($arResult["items"][$x])) {
                        $item = $arResult["items"][$x];
                        $item["url_page_detail"] = "/video".EX."/".$item["code"]."/";
                        $d = new DateTime($item["date"]);
                        $item["date"] = $d->format('d.m.Y');

                        $item["stext"] = $item["text_preview"];
                        $item["img"] = $item["picture_preview"];
                        $item["sys_name"] = $item["code"];
                        $text = strip_tags($item["stext"]);
                        $text = substr($text, 0, 150);
                        $text = rtrim($text, "!,.-");
                        $text = substr($text, 0, strrpos($text, ' '));
                        $text = $text."… ";
                        include __DIR__."/template_common_item1.php";
                    }
                }
                $item["name"] = "Смотреть все видео";
                $item["url_page_detail"] = "/video/";
                include __DIR__."/template_common_item_link_to_all.php";

                ?>
            </ul>
        </div>
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"></button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"></button>
        </div>
    </div>
<?php
endif;
?>