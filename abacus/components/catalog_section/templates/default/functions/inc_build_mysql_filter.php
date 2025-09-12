<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// preparing filters
global $mysql_product_filter;
$filter_exists = false;
$arBrands = array();
$arOss = array();
$arInterfaces = array();
$arProcessors = array();
$arethernets_fix = array();
$arResolutions = array();
$only_series = "";
$codesys_only = "";
$plc_web_browser_only = "";
$webview_only = "";
$poe_only = "";
$screenless_only = "";
$cmtviewer_only = "";
$sdcard_only = "";
$vesa_only = "";
$camera_ip_only = "";
$camera_usb_only = "";
$HddSATA_only = "";
$HddmSATA_only = "";
$HddM2_only = "";
$HddPCIE_only = "";
$material_plast_only = "";
$material_alum_only = "";
$material_plastalum_only = "";


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
if (isset($_GET["HddSATA"]) and $_GET["HddSATA"] == 'yes') {
    $HddSATA_only = "1";
    $filter_exists = true;
}
if (isset($_GET["HddmSATA"]) and $_GET["HddmSATA"] == 'yes') {
    $HddmSATA_only = "1";
    $filter_exists = true;
}
if (isset($_GET["HddM2"]) and $_GET["HddM2"] == 'yes') {
    $HddM2_only = "1";
    $filter_exists = true;
}
if (isset($_GET["HddPCIE"]) and $_GET["HddPCIE"] == 'yes') {
    $HddPCIE_only = "1";
    $filter_exists = true;
}
if (isset($_GET["plast"]) and $_GET["plast"] == 'yes') {
    $material_plast_only = "1";
    $filter_exists = true;
}
if (isset($_GET["alum"]) and $_GET["alum"] == 'yes') {
    $material_alum_only = "1";
    $filter_exists = true;
}
if (isset($_GET["plastalum"]) and $_GET["plastalum"] == 'yes') {
    $material_plastalum_only = "1";
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
if (isset($_GET["poe"]) and $_GET["poe"] == 'yes') {
    $poe_only = "1";
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
if (isset($_GET["ethernets_fix"]) and $_GET["ethernets_fix"] != '') {
    $arethernets_fix = explode(",", $_GET["ethernets_fix"]);
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

if (isset($_GET["rammax_range_min"]) and $_GET["rammax_range_min"] != '') {
    $rammax_range_min = $_GET["rammax_range_min"];
    $filter_exists = true;
} else $rammax_range_min = "";

if (isset($_GET["rammax_range_max"]) and $_GET["rammax_range_max"] != '') {
    $rammax_range_max = $_GET["rammax_range_max"];
    $filter_exists = true;
} else $rammax_range_max = "";

if (isset($_GET["USB_range_min"]) and $_GET["USB_range_min"] != '') {
    $USB_range_min = $_GET["USB_range_min"];
    $filter_exists = true;
} else $USB_range_min = "";

if (isset($_GET["USB_range_max"]) and $_GET["USB_range_max"] != '') {
    $USB_range_max = $_GET["USB_range_max"];
    $filter_exists = true;
} else $USB_range_max = "";

if (isset($_GET["availablity"]) and $_GET["availablity"] != '') {
    $availablity = intval($_GET["availablity"]);
    $filter_exists = true;
} else $availablity = "0";

if (isset($_GET["management"]) and $_GET["management"] != '') {
    $management = intval($_GET["management"]);
    $filter_exists = true;
} else $management = "0";

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
        case "plasticmetal":
            $case_material = "Пластик+Металл";
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
			if ($processor == 'Intel Core i5') {
            $filter_chunk .= " `cpu_code` like '%Ultra 5%' OR ";
			}
			if ($processor == 'Intel Core i7') {
            $filter_chunk .= " `cpu_code` like '%Ultra 7%' OR ";
			}
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
    if (count($arethernets_fix) > 0) {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        foreach ($arethernets_fix as $port) {
            $filter_chunk .= " `ethernets` = $port ";
            if ($port == end($arethernets_fix)) {
                $filter_chunk .= ") ";
            } else {
                $filter_chunk .= " or ";
            }
        }
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


        if ($com_range_max != '') {
            if ($filter_chunk == '') {
                $filter_chunk = ' (';
            } else $filter_chunk = ' and (';
            $filter_chunk .= " `serials` <= '$com_range_max') ";
            $mysql_product_filter .= $filter_chunk;
        }
        if ($com_range_min != '') {
            if ($filter_chunk == '') {
                $filter_chunk = ' (';
            } else $filter_chunk = ' and (';
            $filter_chunk .= " `serials` >= '$com_range_min') ";
            $mysql_product_filter .= $filter_chunk;
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

    if ($rammax_range_max != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `ram_max` <= '$rammax_range_max') ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($rammax_range_min != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `ram_max` >= '$rammax_range_min') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($USB_range_max != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `usb_hosts` <= '$USB_range_max') ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($USB_range_min != '') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `usb_hosts` >= '$USB_range_min') ";
        $mysql_product_filter .= $filter_chunk;
    }


    if ($series != "") {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('" . $series . "',`series`)) ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($types != "") {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('" . $types . "',`type`)) ";
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
    if ($poe_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `poe` = 1) ";
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
        $filter_chunk .= " (FIND_IN_SET('cMT',`series`) or FIND_IN_SET('cMT-X',`series`)) and `no_cmtviewer` != 1) ";
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

    if ($HddSATA_only == '1' and $HddmSATA_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('SATA',storage_device_extra_info)>0 and FIND_IN_SET('mSATA',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddSATA_only == '1' and $HddM2_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('SATA',storage_device_extra_info)>0 and FIND_IN_SET('M.2',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddSATA_only == '1' and $HddPCIE_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('SATA',storage_device_extra_info)>0 and FIND_IN_SET('PCIE',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddmSATA_only == '1' and $HddPCIE_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('mSATA',storage_device_extra_info)>0 and FIND_IN_SET('PCIE',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddmSATA_only == '1' and $HddM2_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('mSATA',storage_device_extra_info)>0 and FIND_IN_SET('M.2',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddM2_only == '1' and $HddPCIE_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('PCIE',storage_device_extra_info)>0 and FIND_IN_SET('M.2',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddmSATA_only == '1' and $HddSATA_only == '1' and $HddM2_only == '1' and $HddPCIE_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('SATA',storage_device_extra_info)>0 and FIND_IN_SET('mSATA',storage_device_extra_info)>0 and FIND_IN_SET('PCIE',storage_device_extra_info)>0 and FIND_IN_SET('M.2',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddmSATA_only == '1' and $HddM2_only == '1' and $HddPCIE_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('mSATA',storage_device_extra_info)>0 and FIND_IN_SET('PCIE',storage_device_extra_info)>0 and FIND_IN_SET('M.2',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddSATA_only == '1' and $HddM2_only == '1' and $HddPCIE_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('SATA',storage_device_extra_info)>0 and FIND_IN_SET('PCIE',storage_device_extra_info)>0 and FIND_IN_SET('M.2',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddmSATA_only == '1' and $HddSATA_only == '1' and $HddPCIE_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('SATA',storage_device_extra_info)>0 and FIND_IN_SET('mSATA',storage_device_extra_info)>0 and FIND_IN_SET('PCIE',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddmSATA_only == '1' and $HddSATA_only == '1' and $HddM2_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('SATA',storage_device_extra_info)>0 and FIND_IN_SET('mSATA',storage_device_extra_info)>0 and FIND_IN_SET('M.2',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddSATA_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('SATA',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddmSATA_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('mSATA',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddM2_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('M.2',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($HddPCIE_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " FIND_IN_SET('PCIE',storage_device_extra_info)>0) ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($material_plast_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `case_material` = 'Пластик') ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($material_plastalum_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `case_material` = 'Пластик,Металл') ";
        $mysql_product_filter .= $filter_chunk;
    } elseif ($material_alum_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `case_material` = 'Алюминий') ";
        $mysql_product_filter .= $filter_chunk;
    }

    if ($sdcard_only == '1') {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `sdcard` != '' and `sdcard` != 'Нет') ";
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

    if ($management == 1) {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `management_level` = '1') ";
        $mysql_product_filter .= $filter_chunk;
    }
    if ($management == 2) {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `management_level` > '1') ";
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

        if ($case_material == "Пластик+Металл") {
            $filter_chunk .= " `case_material` = 'Пластик,Металл') ";
        } else {
            $filter_chunk .= " `case_material` = '$case_material') ";
        }
        $mysql_product_filter .= $filter_chunk;
    }

} else $mysql_product_filter = "";



// end preparing filters
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
