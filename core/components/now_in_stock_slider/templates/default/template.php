<?php
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
$arResult["items"] = CoreApplication::get_rows_from_table("`products_all`",
    "model,s_name,diagonal,brand,type,retail_price,retail_price_hide,currency,model_fullname,show_on_stock",
    "`brand` != 'Faraday' and `onstock_spb` > 0 and `discontinued` != '1' and `parent`='' and `recommended`> 0", " rand() ", 28);//`index` DESC

/*?>
<div class="xxxxx" style="display: none">
<?var_dump_pre($arResult["items"]);?>
</div>
<?php
*/
$count = count($arResult["items"]);

$arr_brands_original = CoreApplication::get_rows_from_table("`catalog_brands`", "", "`brand_page_link` != ''", "");
$arr_brands = [];
foreach ($arr_brands_original as $brand) {
    $arr_brands[$brand['name']] = $brand;
}

if ($count > 0):
    ?>
    <div class="glide" id="glide_now_in_stock_slider">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <?

                for ($x = 0; $x < $count; $x++) {
                    global $item;

                    if (isset($arResult["items"][$x]) and $arResult["items"][$x]['model'] != '') {
                        $item = $arResult["items"][$x];
                        if (!isset($arr_brands[$item['brand']])) {
                            continue;
                        }
                        $arr_short_name = CoreApplication::get_rows_from_table("`catalog_types`", "short_name", "`code` = '{$item["type"]}'", "", 1);

                        if (count($arr_short_name) != 0) {
                            $short_name = $arr_short_name[0]['short_name'];
                        } elseif (isset($item['model_fullname']) and $item['model_fullname'] != '') {
                            $short_name = $item['model_fullname'];
                        } else
                            $short_name = '';

                        if($item["brand"] == "Faraday"){
                            $model = str_replace("/","_",$item["s_name"]);
                            $model = str_replace(" ","_",$model);
                        }else{
                            $model = str_replace("/","_",$item["model"]);
                            $model = str_replace(" ","_",$model);
                        }


                        if($item["brand"] == "Faraday") {
                            $model_name = str_replace("Faraday ","",$item["model"]);
                        }elseif($item["brand"] == "IFC") {
                            $model_name = str_replace("IFC-","",$item["model"]);
                        }else{
                            $model_name = $item["model"];
                        }


                        if (isset($item["link_detail2"]) and $item["link_detail2"] != "") {
                            $item["link_detail_page"] = $item["link_detail2"];
                        } else {
                            $item["link_detail_page"] = $arr_brands[$item["brand"]]["brand_page_link"] . $model . "/";
                        }

                        $item["stext"] = "";
                        $item["category_name"] = (trim($short_name));

                        //$item["model"];
                        if ($item["diagonal"] > 0 and $item["type"] != 'cloud_hmi') {
                            $item["category_name"] = $item["diagonal"] . "&Prime; " . $item["category_name"];
                        }
                        $brand_code = strtolower($item["brand"]);

                        $model = str_replace("/","_",$item["model"]);
                        $model = str_replace(" ","_",$model);
                        $type = strtolower($item["type"]);
                        $item["img"] = "/images/{$brand_code}/{$type}/{$model}/130/{$model}_1.webp";
                        $text = "";
                            /*                        $text = strip_tags("vfvfvfvfd");
                                                    $text = substr($text, 0, 150);
                                                    $text = rtrim($text, "!,.-");
                                                    $text = substr($text, 0, strrpos($text, ' '));
                                                    $text = $text . "… ";*/

                        //var_dump_pre($item['type']);
                        include __DIR__ . "/template_common_item1.php";
                    }
                }
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