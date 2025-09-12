<?php

global $usd_currency;
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt")) {
    $usd_currency = floatval(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt"));
} else $usd_currency = 0;


require_once __DIR__ . '/inc_template_detail_functions.php';
//require_once __DIR__ . "/inc_functions_linked_products.php";


$arResult = array(
    "model" => $arguments["component_route_params"]["detail"],
);
global $select_by_s_name;

if (strpos($arResult["model"], "faraday") === false) {
    $select_by_s_name = false;
    $arResult_product = CoreApplication::get_rows_from_table("`products_all`", "*", "model = '{$arResult["model"]}'", "", 1);
} else {
    $select_by_s_name = true;
    $arResult_product = CoreApplication::get_rows_from_table("`products_all`", "*", "s_name = '{$arResult["model"]}'", "", 1);
}


if (count($arResult_product) == 0) {
    header("HTTP/1.0 404 Not Found");
    define('ERROR_404', true);

} else {
    define('ERROR_404', false);


    if (isset($arResult_product[0])) {
        $arResult['product'] = $arResult_product[0];
    }

    if ($arResult['product']["section"] != '') {
        $arResult_section = CoreApplication::get_rows_from_table("catalog_sections", "", "code = '" . $arResult['product']["section"] . "'");
    } else {
        $arResult_section = CoreApplication::get_rows_from_table("catalog_sections", "", "FIND_IN_SET('" . $arResult['product']["type"] . "', product_types)>0");
    }


    if (isset($arResult_section[0])) {
        $arResult['section'] = $arResult_section[0];
    }

    $arr_product_types = CoreApplication::get_rows_from_table("`catalog_types`", "*", "code = '{$arResult['product']["type"]}' and series = '{$arResult['product']["series"]}'", "");

    if (count($arr_product_types) > 0) {
        $product_type = $arr_product_types[0];
    } else {
        $arr_product_types = CoreApplication::get_rows_from_table("`catalog_types`", "*", "code = '{$arResult['product']["type"]}'", "");
        $product_type = $arr_product_types[0];
    }


    $template_h1 = $product_type["template_h1"];
    $template_title = $product_type["template_title"];
    $product_type_genitive_case = $product_type["genitive_case"];

    global $TITLE;
    global $DESCRIPTION;
    global $DESCRIPTION_micro;
    global $KEYWORDS;
    global $CANONICAL;
    global $H1;


    if ($arResult['product']["description"] == '') {
        $DESCRIPTION = $product_type["short_name"] . " " . $arResult['product']["model"] . " " . $arResult['product']["brand"] . " " . $arResult['product']["preview_text"] . ", " . $arResult['product']["preview_text_extra"] . ", склад в Санкт-Петербурге, бесплатная доставка по всей России.";
        $DESCRIPTION_micro = $product_type["short_name"] . " " . $arResult['product']["model"] . " " . $arResult['product']["brand"] . " " . $arResult['product']["preview_text"] . ", " . $arResult['product']["preview_text_extra"];

    } else {
        $DESCRIPTION = $arResult['product']["description"];
        $DESCRIPTION_micro = $product_type["short_name"] . " " . $arResult['product']["model"] . " " . $arResult['product']["brand"] . " " . $arResult['product']["preview_text"] . ", " . $arResult['product']["preview_text_extra"];
    }

    $DESCRIPTION = str_replace('#model_fullname#', $arResult['product']["model_fullname"], $DESCRIPTION);
    $DESCRIPTION_micro = str_replace('#model_fullname#', $arResult['product']["model_fullname"], $DESCRIPTION_micro);



    $KEYWORDS = $product_type["short_name"] . ", " . $arResult['product']["model"] . ", " . $arResult['product']["brand"];

    $CANONICAL = "https://www.rusavtomatika.com/" . mb_strtolower($arResult['product']['brand']) . "/" . $arResult['product']['model'] . "/";


    if (isset($arResult['product']["title"]) and $arResult['product']["title"] != '') {
        $TITLE = $arResult['product']["title"];
    } else {
        $template_title = str_replace('#model_fullname#', $arResult['product']["model_fullname"], $template_title);
        $template_title = str_replace('#model#', $arResult['product']["model"], $template_title);
        $template_title = str_replace('#brand#', $arResult['product']["brand"], $template_title);
        if ($arResult['product']["diagonal"] != '') {
            $template_title = str_replace('#diagonal#', str_replace(".0", "", $arResult['product']["diagonal"]) . "&Prime;", $template_title);
        }
        $TITLE = $template_title;
    }

    if ($TITLE == '#model_fullname#') {
        $TITLE = $arResult['product']["model_fullname"];
    }
    if ($product_type_genitive_case == '#model_fullname#') {
        $product_type_genitive_case = "";
    }


    $template_h1 = str_replace('#model#', $arResult['product']["model"], $template_h1);
    if ($arResult['product']["brand"] == 'IFC') {
        $template_h1 = str_replace('#brand#', '', $template_h1);
    } else {
        $template_h1 = str_replace('#brand#', $arResult['product']["brand"], $template_h1);
    }
    if ($arResult['product']["diagonal"] != '') {


        $template_h1 = str_replace('#diagonal#', str_replace(".0", "", $arResult['product']["diagonal"]) . "&Prime;", $template_h1);
    }

    if ($arResult['product']["model_fullname"] != '') {
        $template_h1 = str_replace('#model_fullname#', $arResult['product']["model_fullname"], $template_h1);
    }

    if (isset($arResult['product']["camera_ip"]) and $arResult['product']["camera_ip"] == 1) {
        $arResult['product']["camera_ip"] = "Есть";
    }
    if (isset($arResult['product']["linear_out"]) and $arResult['product']["linear_out"] == 1) {
        $arResult['product']["linear_out"] = "Есть";
    }
    if (isset($arResult['product']["mic_in"]) and $arResult['product']["mic_in"] == 1) {
        $arResult['product']["mic_in"] = "Есть";
    }


    if (isset($arResult['product']["camera_usb"]) and $arResult['product']["camera_usb"] == 1) {
        $arResult['product']["camera_usb"] = "Есть";
    }

    if (isset($arResult['product']["codesys"]) and $arResult['product']["codesys"] == 'optional') {
        $arResult['product']["codesys"] = "Опционально";
    }
    if (isset($arResult['product']["codesys"]) and $arResult['product']["codesys"] == 'N') {
        $arResult['product']["codesys"] = "Нет";
    }
    if (isset($arResult['product']["codesys"]) and $arResult['product']["codesys"] == 'build_in') {
        $arResult['product']["codesys"] = "Встроен";
    }


    if (isset($arResult['product']["plc_web_browser"]) and $arResult['product']["plc_web_browser"] == 1) {
        $arResult['product']["plc_web_browser"] = "Есть";
    }
    if (isset($arResult['product']["webview"]) and $arResult['product']["webview"] == 1) {
        $arResult['product']["webview"] = "Есть";
    }


    if ($arResult['product']["retail_price"] > 0 and $arResult['product']['retail_price_hide'] == "0") {
        $arResult['product']['price_usd_currency'] = "$";
        $arResult['product']['price_rub_currency'] = "&#8381;";
        if ($arResult['product']["currency"] == "RUR" and $usd_currency > 0) {
            $arResult['product']['price_rub_value'] = $arResult['product']["retail_price"];
            $arResult['product']["price_usd_value"] = intval($arResult['product']["retail_price"] / $usd_currency);
        } else {

            $arResult['product']["price_usd_value"] = $arResult['product']["retail_price"];

            if ($usd_currency > 0) {
                $arResult['product']['price_rub_value'] = intval($arResult['product']["retail_price"] * $usd_currency);
            } else $arResult['product']['price_rub_value'] = 0;
        }
    } else {
        $arResult['product']["price_usd_value"] = 0;
    }


    $H1 = $template_h1;
    if (isset($arResult['product']["h1"]) and $arResult['product']["h1"] != '') {
        $H1 = $arResult['product']["h1"];
    }


    /** IMAGES ************************************************************************************************************/

    if ($select_by_s_name) {
        $model = str_replace("/", "_", $arResult['product']["model"]);
        $model = str_replace(" ", "_", $model);
        $arResult['imgRemoteDir'] = "/images/" . mb_strtolower($arResult['product']['brand']) . "/" . mb_strtolower($arResult['product']['type']) . "/" . $model . "/";
    } else {
        $arResult['imgRemoteDir'] = "/images/" . mb_strtolower($arResult['product']['brand']) . "/" . mb_strtolower($arResult['product']['type']) . "/" . $arResult['product']['model'] . "/";
    }


    if ($arResult['product']["pics_number"] > 0) {
        for ($x = 1; $x <= ($arResult['product']["pics_number"]); $x++) {
            if ($select_by_s_name) {
                $arResult['product']["arr_pics"][] = $model . "_" . $x . ".webp";
            } else {
                $arResult['product']["arr_pics"][] = $arResult['product']['model'] . "_" . $x . ".webp";
            }
        }
    }


    global $extra_openGraph;

    $extra_openGraph = array(
        "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/". mb_strtolower($arResult['product']['brand']) . "/" . mb_strtolower($arResult['product']['type']) . "/" . $arResult['product']['model'] . "/580/". $arResult['product']["arr_pics"][0],
        "openGraph_title" => $H1,
        "openGraph_description" => $DESCRIPTION_micro,
        "openGraph_siteName" => "Русавтоматика - поставка оборудования для автоматизации",
    );


    /** FILES *************************************************************************************************************/

    $files_product = $files_product2 = $files_common = $files_series = array();
    $arguments["where"] = "product_name='{$arResult['product']["model"]}'";
    $arguments["order"] = "position desc";
    $files_product = get_list_of_files($arguments);

    $arguments["where"] = "product_name like '%{$arResult['product']["model"]},%'";
    $arguments["order"] = "position desc";
    $files_product2 = get_list_of_files($arguments);

    $arguments["where"] = "brand='" . $arResult['product']['brand'] . "'";

    $files_common = get_list_of_files($arguments);

    $arguments["where"] = "series like '%" . $arResult['product']['series'] . "%'";
    $files_series = get_list_of_files($arguments);


    $arr_brochure = array();
    if ($arResult['product']['brand'] == 'Faraday' and $arResult['product']['brochure'] != '') {
        $arr_brochure[] = [
            "name" => "Брошюра на блок питания " . $arResult['product']['model'],
            "position" => "10",
            "type" => "pdf",
            "path" => "/manuals/" . $arResult['product']['brochure'],
        ];
    } elseif ($arResult['product']['brochure'] != '') {
        $arr_brochure[] = [
            "name" => "Брошюра на " . $arResult['product']['model'],
            "position" => "10",
            "type" => "pdf",
            "path" => "/manuals/" . $arResult['product']['brochure'],
        ];

    }
    $arResult['product']['files'] = array_merge($arr_brochure, $files_product, $files_product2, $files_series, $files_common);
    $arResult['product']['files'] = array_map("unserialize", array_unique(array_map("serialize", $arResult['product']['files'])));

    require_once __DIR__ . "/inc_prepare_link_advanced_search.php";
}



