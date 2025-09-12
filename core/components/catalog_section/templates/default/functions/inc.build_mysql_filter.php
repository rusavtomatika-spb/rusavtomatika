<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// preparing filters
$filter_exists = false;
$arBrands = array();
$arInterfaces = array();
$arProcessors = array();
$arResolutions= array();
$only_series = "";
/*if (isset($_GET["series"]) and $_GET["series"] != '') {
    $only_series = $_GET["series"];
}*/
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

if (isset($_GET["series"]) and $_GET["series"] != '') {
    $series = ($_GET["series"]);
    $filter_exists = true;
} else $series = "";


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
            $cond = $catalog_interfaces[$interface]["match_condition"];
            $filter_chunk .= $cond;
            if ($interface == end($arInterfaces)) {
                $filter_chunk .= ") ";
            } else {
                $filter_chunk .= " and ";
            }
        }
        //var_dump_pre($filter_chunk_tmp);
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
        $filter_chunk .= " `series` = '".$series."') ";
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


} else $mysql_product_filter = "";



// end preparing filters
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
