<?php
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");

global $mysqli_db;
if (!$mysqli_db) { database_connect(); $mysqli_db = $GLOBALS['mysqli_db']; }

$sql_slider = "
    SELECT p.`model`, p.`s_name`, p.`diagonal`, p.`brand`, p.`type`,
           p.`retail_price`, p.`retail_price_hide`, p.`currency`,
           p.`model_fullname`, p.`show_on_stock`, p.`series`,
           COALESCE(s.`onstock_spb`, 0) AS `onstock_spb`
    FROM `products_all` p
    LEFT JOIN `product_stock` s ON s.`product_index` = p.`index`
    WHERE p.`brand` != 'Faraday'
      AND COALESCE(s.`onstock_spb`, 0) > 0
      AND p.`discontinued` != '1'
      AND p.`parent` = ''
      AND p.`recommended` > 0
      AND p.`status` != '0'
    ORDER BY RAND()
    LIMIT 28
";
$arResult["items"] = array();
$res_slider = mysqli_query($mysqli_db, $sql_slider);
if ($res_slider) {
    while ($row_slider = mysqli_fetch_assoc($res_slider)) {
        $arResult["items"][] = $row_slider;
    }
}

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
            <ul class="glide__slides" style="padding: 20px 0;">
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
                        } else {
                            $model = str_replace("/","_",$item["model"]);
                            $model = str_replace(" ","_",$model);
                        }

                        if($item["brand"] == "Faraday") {
                            $model_name = str_replace("Faraday ","",$item["model"]);
                        } elseif ($item["brand"] == "IFC") {
                            $model_name = str_replace("IFC-","",$item["model"]);
                        } else {
                            $model_name = $item["model"];
                        }

                        if (isset($item["link_detail2"]) and $item["link_detail2"] != "") {
                            $item["link_detail_page"] = $item["link_detail2"];
                        } else {
                            $item["link_detail_page"] = $arr_brands[$item["brand"]]["brand_page_link"] . $model . "/";
                        }

                        $item["stext"] = "";
                        $item["category_name"] = (trim($short_name));

                        if ($item["diagonal"] > 0 and $item["type"] != 'cloud_hmi') {
                            $item["category_name"] = $item["diagonal"] . "&Prime; " . $item["category_name"];
                        }

                        $brand_code = strtolower($item["brand"]);
                        $model = str_replace("/","_",$item["model"]);
                        $model = str_replace(" ","_",$model);
                        $type = strtolower($item["type"]);
                        $item["img"] = "/images/{$brand_code}/{$type}/{$model}/130/{$model}_1.webp";
                        $text = "";

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