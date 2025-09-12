<?php
$arResult["news"] = CoreApplication::get_rows_from_table("`news`", "date,name,sys_name,stext,img", "`show` = '1'", "date DESC", 5);
$arResult["articles"] = CoreApplication::get_rows_from_table("`articles`", "date,name,sys_name,stext,img", "`show` = '1'", "date DESC", 5);


for ($x = 0; $x < count($arResult["news"]); $x++) {
    $arResult["news"][$x]["table"] = "news";
}
for ($x = 0; $x < count($arResult["articles"]); $x++) {
    $arResult["articles"][$x]["table"] = "articles";
}
$arResult["items"] = array_merge($arResult["news"], $arResult["articles"]);
function cmp_items($a, $b)
{
    if ($a['date'] == $b['date']) {
        return 0;
    }
    return (strtotime($a['date']) > strtotime($b['date'])) ? -1 : 1;
}
usort($arResult["items"], "cmp_items");

$count = count($arResult["items"]);
if ($count > 0):
    ?>
    <div class="glide" id="glide_news">
        <div class="glide__track" data-glide-el="track" style="padding-bottom: 2.5rem !important;">
            <ul class="glide__slides">
                <?
                for ($x = 0; $x < $count; $x++) {
                    if (isset($arResult["items"][$x])) {
                        $item = $arResult["items"][$x];
                        $d = new DateTime($item["date"]);
                        $item["date"] = $d->format('d.m.Y');
                        $text = strip_tags($item["stext"]);
                        $text = substr($text, 0, 150);
                        $text = rtrim($text, "!,.-");
                        $text = substr($text, 0, strrpos($text, ' '));
                        $text = $text . "… ";
                        $item["url_page_detail"] = "/" .$item["table"]. EX . "/" . $item["sys_name"] . "/";
                        include $_SERVER["DOCUMENT_ROOT"] . "/abacus/components/news_slider/templates/template_common_item/template_common_item1.php";
                    }
                }
                $item["url_page_detail"] = "/news/";
                $item["name"] = "Смотреть все новости";
                include $_SERVER["DOCUMENT_ROOT"] . "/abacus/components/news_slider/templates/template_common_item/template_common_item1_link_to_all.php";
                $item["url_page_detail"] = "/articles/";
                $item["name"] = "Смотреть все статьи";
                include $_SERVER["DOCUMENT_ROOT"] . "/abacus/components/news_slider/templates/template_common_item/template_common_item1_link_to_all.php";
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