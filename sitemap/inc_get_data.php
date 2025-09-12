<?php
global $mysqli_db;
mysqli_query($mysqli_db, "SET NAMES utf8");

$arr_export_catalog_products = [];

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt")) {
    $usd_currency = floatval(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt"));
} else $usd_currency = 0;


$ar_brands = CoreApplication::get_rows_from_table("catalog_brands", "name", "`active`='1'", "position asc");
/*$arr_exclude_brands = [
    'eWON',
];
foreach ($ar_brands as $key => $brand) {
    if (in_array($brand['name'], $arr_exclude_brands)) {
        unset($ar_brands[$key]);
    }
}*/

$ar_sections = CoreApplication::get_rows_from_table("catalog_sections", "id,name,code,category_link,products_selected_by_query", "`active`='1'", "position asc");
$rows_catalog_types = CoreApplication::get_rows_from_table("catalog_types", "short_name,code");
foreach ($rows_catalog_types as $type) {
    $ar_catalog_types[$type["code"]] = $type["short_name"];
}

$arr_exclude_sections = [
    '7', '10', '12', '13', '15'
];
foreach ($ar_sections as $key => $section) {
    //var_dump($section);
    if (in_array($section['id'], $arr_exclude_sections)) {
        unset($ar_sections[$key]);
    }
}

$ar_section_links = [];
foreach ($ar_sections as $ar_section) {

    $extra_condition = '';
    if ($ar_section["products_selected_by_query"] != "") {
        $ar_products = CoreApplication::direct_sql_query($ar_section["products_selected_by_query"]);
        $items = [];
        foreach ($ar_products as $item) {
            $items[] = ["model" => $item["model"], "brand" => $item["brand"], "section" => $item["section"],];
        }
        $ar_series_links[] = [
            'brand' => "",
            'series_name' => "",
            'items' => $items,
        ];
        $items = [];
        $ar_section_links[$ar_section["name"]] = ["link" => $link, "anchor" => $ar_section["name"], "series" => $ar_series_links];
        $ar_series_links = [];

    } else {
        $ar_products = [];
        if ($ar_section["category_link"] != '') {
            $link = $ar_section["category_link"];
            $tmp = explode("?&", $link);
            if (isset($tmp[1])) {
                $tmp2 = explode("=", $tmp[1]);
                if (isset($tmp2[1]) and $tmp2[1] != '') {
                    if ($tmp2[0] == 'os') {
                        $tmp2[0] = 'os_codes';
                        $extra_condition = " and `{$tmp2[0]}` like '%{$tmp2[1]}%' ";
                    } else {
                        $extra_condition = " and `{$tmp2[0]}` = '{$tmp2[1]}' ";
                    }
                } else {
                    $extra_condition = '';
                }
            }

        } else {
            $link = "/catalog/" . $ar_section["code"] . "/";
        }
        // серии
        $ar_series = [];
        foreach ($ar_brands as $brand) {

            $ar_series = CoreApplication::get_rows_from_table("catalog_series", "name,type", " `menu_category_item_code`='{$ar_section["code"]}' and `brand`='{$brand["name"]}' and `active`='1'", "position asc");

            foreach ($ar_series as $series) {
                echo "<br>";
                echo "<br>";
                var_dump($series);
                echo "<br>";
                $items = CoreApplication::get_rows_from_table("products_all", " `index` , model, brand , type,  text_features ,dimentions, diagonal, diagonal_hide,resolution,interfaces,retail_price , currency , onstock_spb, pics_number, retail_price_hide", " `type`='{$series["type"]}' and `series`='{$series["name"]}' and `brand`='{$brand["name"]}' and `parent` = '' and `show_in_cat`!='0' and `discontinued` != '1'" . $extra_condition, " `index` desc");

                foreach ($items as $item) {
                    if ($item["retail_price_hide"] == '1' or $item["retail_price"] == '0' or $item["pics_number"] == '0') {
                        continue;
                    }
                    var_dump(($item["model"]));
                    echo "<br>";
                    $item['categoryId'] = $ar_section['id'];
                    $item['url'] = 'https://www.rusavtomatika.com/' . strtolower($item['brand']) . '/' . $item['model'] . '/';

                    for ($x = 1; $x <= intval($item['pics_number']); $x++) {
                        $item['pictures'][] = 'https://www.rusavtomatika.com/upload_files/images/' . strtolower($item['brand']) . '/' . $item['type'] . '/' . $item['model'] . '/lg/' . $item['model'] . '_' . $x . '.png';
                    }
                    if($item["currency"] == 'RUR'){
                        $item['price'] = $item["retail_price"];
                    }else{
                        $item['price'] = intval($usd_currency * $item["retail_price"]);
                    }
                    $item['text_features'] = str_replace("<ul>"," ",$item['text_features']);
                    $item['text_features'] = str_replace("</ul>"," ",$item['text_features']);
                    $item['text_features'] = str_replace("<li>","<p>",$item['text_features']);
                    $item['text_features'] = str_replace("</li>","</p>",$item['text_features']);

                    $item['text_features'] = preg_replace('/<a([\s\S]+)?>([\s\S]+)?<\/a>/i', '', $item['text_features']);

                    $item['text_features'] = str_replace("<p></p>","",$item['text_features']);



                    $arr_export_catalog_products[] = $item;
                }
                if (count($items) > 0) {
                    $ar_series_links[] = [
                        'brand' => $brand["name"],
                        'series_name' => $series["name"],
                        'items' => $items,
                    ];
                } else {
                    //echo " `type`='{$series["type"]}' and `series`='{$series["name"]}' and `brand`='{$brand["name"]}' and `show_in_cat`!='0' and `discontinued` != '1'".$extra_condition."<br><br>";
                }


            }

        }
        //


        $ar_section_links[$ar_section["name"]] = ["link" => $link, "anchor" => $ar_section["name"], "series" => $ar_series_links];
        $ar_series_links = [];
    }
}

$ar_catalog_links = [
    "link" => "/catalog/",
    "anchor" => "Каталог продукции",
    "items" => $ar_section_links,
];
