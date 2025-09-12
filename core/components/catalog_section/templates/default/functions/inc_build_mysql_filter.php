<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// preparing filters
global $mysql_product_filter;
$filter_exists = false;
$arBrands = array();
$arOss = array();
$arInterfaces = array();
$arProcessors = array();
$arResolutions = array();
$only_series = "";
$codesys_only = "";
$plc_web_browser_only = "";
$webview_only = "";
$screenless_only = "";
$cmtviewer_only = "";
$sdcard_only = "";
$vesa_only = "";
$camera_ip_only = "";
$camera_usb_only = "";


/*if(is_array($_GET) and count($_GET)>0){
    $arr_all_available_filters_rows = $DB_WORK_CATALOG->get_rows_from_table("catalog_filters");
    foreach ($arr_all_available_filters_rows as $filter_item){
        $arr_all_available_filters[] = $filter_item["filter_code"];
    }
    foreach ($_GET as &$param){
        if(!in_array($param,$arr_all_available_filters)){
            echo $param."<br>";
        }
    }
}*/
//var_dump_pre($arr_all_available_filters);


/*if (isset($_GET["series"]) and $_GET["series"] != '') {
    $only_series = $_GET["series"];
}*/
if (isset($_GET["vesa"]) and $_GET["vesa"] == 'yes') {
    $vesa_only = "1";
    $filter_exists = true;
}
if (isset($_GET["camera_ip"]) and $_GET["camera_ip"] == 'yes') {
    $camera_ip_only = "1";
    $filter_exists = true;
}
if (isset($_GET["camera_usb"]) and $_GET["camera_usb"] == 'yes') {
    $camera_usb_only = "1";
    $filter_exists = true;
}
if (isset($_GET["codesys"]) and $_GET["codesys"] == 'yes') {
    $codesys_only = "1";
    $filter_exists = true;
}

if (isset($_GET["plc_web_browser"]) and $_GET["plc_web_browser"] == 'yes') {
    $plc_web_browser_only = "1";
    $filter_exists = true;
}
if (isset($_GET["webview"]) and $_GET["webview"] == 'yes') {
    $webview_only = "1";
    $filter_exists = true;
}
if (isset($_GET["screenless"]) and $_GET["screenless"] == 'yes') {
    $screenless_only = "1";
    $filter_exists = true;
}

if (isset($_GET["cmtviewer"]) and $_GET["cmtviewer"] == 'yes') {
    $cmtviewer_only = "1";
    $filter_exists = true;
}
if (isset($_GET["sdcard"]) and $_GET["sdcard"] == 'yes') {
    $sdcard_only = "1";
    $filter_exists = true;
}
if (isset($_GET["brand"]) and $_GET["brand"] != '') {
    $arBrands = explode(",", $_GET["brand"]);
    $filter_exists = true;
}

if (isset($_GET["resolutions"]) and $_GET["resolutions"] != '') {
    $arResolutions = explode(",", $_GET["resolutions"]);
    $filter_exists = true;
}
if (isset($_GET["processors"]) and $_GET["processors"] != '') {
    $arProcessors = explode(",", $_GET["processors"]);
    $filter_exists = true;
}

if (isset($_GET["interfaces"]) and $_GET["interfaces"] != '') {
    $arInterfaces = explode(",", $_GET["interfaces"]);
    $filter_exists = true;
}
if (isset($_GET["os"]) and $_GET["os"] != '') {
    $arOss = explode(",", $_GET["os"]);

    $filter_exists = true;
}

$arDiagonals = array();
if (isset($_GET["diagonals"]) and $_GET["diagonals"] != '') {
    $arDiagonals = explode(",", $_GET["diagonals"]);
    $filter_exists = true;
}

if (isset($_GET["range_diagonal_min"]) and $_GET["range_diagonal_min"] != '') {
    $range_diagonal_min = $_GET["range_diagonal_min"];
    $filter_exists = true;
} else $range_diagonal_min = "";

if (isset($_GET["range_diagonal_max"]) and $_GET["range_diagonal_max"] != '') {
    $range_diagonal_max = $_GET["range_diagonal_max"];
    $filter_exists = true;
} else $range_diagonal_max = "";

if (isset($_GET["range_price_min"]) and $_GET["range_price_min"] != '') {
    $range_price_min = $_GET["range_price_min"];
    $filter_exists = true;
} else $range_price_min = "";

if (isset($_GET["range_price_max"]) and $_GET["range_price_max"] != '') {
    $range_price_max = $_GET["range_price_max"];
    $filter_exists = true;
} else $range_price_max = "";


if (isset($_GET["com_range_min"]) and $_GET["com_range_min"] != '') {
    $com_range_min = $_GET["com_range_min"];
    $filter_exists = true;
} else $com_range_min = "";

if (isset($_GET["com_range_max"]) and $_GET["com_range_max"] != '') {
    $com_range_max = $_GET["com_range_max"];
    $filter_exists = true;
} else $com_range_max = "";

if (isset($_GET["ethernets_range_min"]) and $_GET["ethernets_range_min"] != '') {
    $ethernets_range_min = $_GET["ethernets_range_min"];
    $filter_exists = true;
} else $ethernets_range_min = "";

if (isset($_GET["ethernets_range_max"]) and $_GET["ethernets_range_max"] != '') {
    $ethernets_range_max = $_GET["ethernets_range_max"];
    $filter_exists = true;
} else $ethernets_range_max = "";


if (isset($_GET["availablity"]) and $_GET["availablity"] != '') {
    $availablity = intval($_GET["availablity"]);
    $filter_exists = true;
} else $availablity = "";

if (isset($_GET["sensor_type"]) and $_GET["sensor_type"] != '') {
    $sensor_type = strip_tags($_GET["sensor_type"]);
    $filter_exists = true;
} else $sensor_type = "";

if (isset($_GET["case_material"]) and $_GET["case_material"] != '') {
    $case_material = strip_tags($_GET["case_material"]);

    switch ($case_material) {
        case "plastic":
            $case_material = "Пластик";
            $filter_exists = true;
            break;
        case "aluminium":
            $case_material = "Алюминий";
            $filter_exists = true;
            break;
        case "plastic aluminium":
            $case_material = "Пластик+Алюминий";
            $filter_exists = true;
            break;
        default:
            $case_material = "";
            break;
    }

} else $case_material = "";


if (isset($_GET["series"]) and $_GET["series"] != '') {
    $series = ($_GET["series"]);
    $filter_exists = true;
} else $series = "";

if (isset($_GET["types"]) and $_GET["types"] != '') {
    $types = strip_tags($_GET["types"]);
    $filter_exists = true;
} else $types = "";


////
if ($filter_exists) {
    $mysql_product_filter = " and ";
    $filter_chunk = '';

    if (count($arBrands) > 0) {
        $filter_chunk = ' (';
        foreach ($arBrands as $brand) {
            $filter_chunk .= " `brand` = '$brand' ";

            if ($brand == end($arBrands)) {
                $filter_chunk .= ") ";
            } else {
                $filter_chunk .= " or ";
            }
        }
        $mysql_product_filter .= $filter_chunk;
    }

    if (count($arProcessors) > 0) {
        //$catalog_processors = $DB_WORK_CATALOG->get_all_catalog_processors();
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        foreach ($arProcessors as $processor) {
            $filter_chunk .= " `cpu_code` like '%$processor%' ";
            if ($processor == end($arProcessors)) {
                $filter_chunk .= ") ";
            } else {
                $filter_chunk .= " or ";
            }
        }
        //var_dump_pre($filter_chunk_tmp);
        $mysql_product_filter .= $filter_chunk;
    }

    if (count($arInterfaces) > 0) {
        $catalog_interfaces = $DB_WORK_CATALOG->get_all_catalog_interfaces();

        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';

        foreach ($arInterfaces as $interface) {
            if (isset($catalog_interfaces[$interface]["match_condition"])) {
                $cond = $catalog_interfaces[$interface]["match_condition"];
                $filter_chunk .= $cond;
                if ($interface == end($arInterfaces)) {
                    $filter_chunk .= ") ";
                } else {
                    $filter_chunk .= " and ";
                }
            }else{
                if ($interface == end($arInterfaces)) {
                    $filter_chunk .= "1) ";
                } else {
                    $filter_chunk .= " ";
                }
            }
        }
        //var_dump_pre($filter_chunk_tmp);
        $mysql_product_filter .= $filter_chunk;
    }


    if (count($arOss) > 0) {
        $catalog_oss = $DB_WORK_CATALOG->get_all_catalog_oss();
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';

        foreach ($arOss as $oss) {
            if (isset($catalog_oss[$oss]["match_condition"])) {
                $cond = $catalog_oss[$oss]["match_condition"];
                $filter_chunk .= $cond;
                if ($oss == end($arOss)) {
                    $filter_chunk .= ") ";
                } else {
                    $filter_chunk .= " or ";
                }
            } else {
                if ($oss == end($arOss)) {
                    $filter_chunk .= "0) ";
                } else {
                    //$filter_chunk .= " 0 ";
                }
            }
        }

        if ($filter_chunk == " () " or $filter_chunk == " (") $filter_chunk = " 1 ";
        $mysql_product_filter .= $filter_chunk;
    }


    if (count($arResolutions) > 0) {
        // $catalog_resolutions = $DB_WORK_CATALOG->get_all_catalog_resolutions();
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        foreach ($arResolutions as $resolutions) {
            $filter_chunk .= " `resolution` = '$resolutions' ";
            if ($resolutions == end($arResolutions)) {
                $filter_chunk .= ") ";
            } else {
                $filter_chunk .= " or ";
            }
        }
        //var_dump_pre($filter_chunk_tmp);
        $mysql_product_filter .= $filter_chunk;
    }


    if ($range_diagonal_max != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `diagonal` <= '$range_diagonal_max') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($range_diagonal_min != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `diagonal` >= '$range_diagonal_min') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($range_price_max != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `retail_price` <= '$range_price_max' or `retail_price` = '0') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($range_price_min != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `retail_price` >= '$range_price_min' or `retail_price` = '0') ";
        $mysql_product_filter .= $filter_chunk;
    }


    if ($com_range_max != '' and $com_range_min != '' and $com_range_max == $com_range_min) {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `serials` = '$com_range_max') ";
        $mysql_product_filter .= $filter_chunk;
    } else {
        if ($com_range_max != '') {
            if ($filter_chunk == '') {
                $filter_chunk = ' (';
            } else $filter_chunk = ' and (';
            $filter_chunk .= " `com_range_max` <= '$com_range_max') ";
            $mysql_product_filter .= $filter_chunk;
        }
        if ($com_range_min != '') {
            if ($filter_chunk == '') {
                $filter_chunk = ' (';
            } else $filter_chunk = ' and (';
            $filter_chunk .= " `com_range_min` >= '$com_range_min') ";
            $mysql_product_filter .= $filter_chunk;
        }
    }

    if ($ethernets_range_max != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `ethernets` <= '$ethernets_range_max') ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($ethernets_range_min != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `ethernets` >= '$ethernets_range_min') ";
        $mysql_product_filter .= $filter_chunk;
    }


    if ($series != "") {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `series` = '" . $series . "') ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($types != "") {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `type` = '" . $types . "') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($codesys_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `codesys` like '%optional%' or `codesys` like '%build_in%') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($webview_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `webview` = 1) ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($screenless_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `screenless` = 1) ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($plc_web_browser_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `plc_web_browser` = 1) ";
        $mysql_product_filter .= $filter_chunk;
    }


    if ($cmtviewer_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `series` = 'cMT' or `series` = 'cMT-X') ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($vesa_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `vesa75`!= '' or `vesa100`!='') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($camera_ip_only == '1' and $camera_usb_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `camera_ip`= 1 and `camera_usb`=1) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($camera_ip_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `camera_ip` = 1) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($camera_usb_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `camera_usb` = 1) ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($sdcard_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `sdcard` != '') ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($availablity == 1) {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `onstock_spb` > '0' or `onstock_msk` > '0') ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($availablity == 2) {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `onstock_spb` = '0' and `onstock_msk` = '0') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($sensor_type == 'resistive') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `touch_type` like '%resistive%') ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($sensor_type == 'capacitive') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `touch_type` like '%capacitive%') ";
        $mysql_product_filter .= $filter_chunk;
    }


    if ($case_material != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';

        if ($case_material == "Пластик+Алюминий") {
            $filter_chunk .= " `case_material` like '%пластик%') and (`case_material` like '%алюминий%') ";
        } else {
            $filter_chunk .= " `case_material` = '$case_material') ";
        }
        $mysql_product_filter .= $filter_chunk;
    }

} else $mysql_product_filter = "";



// end preparing filters
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
