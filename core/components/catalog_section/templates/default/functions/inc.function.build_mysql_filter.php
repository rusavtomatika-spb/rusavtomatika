<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// preparing filters
$filter_exists = false;
$arBrands = array();
$only_series = "";
if (isset($_GET["series"]) and $_GET["series"] != '') {
    $only_series = $_GET["series"];
}
if (isset($_GET["brand"]) and $_GET["brand"] != '') {
    $arBrands = explode(",", $_GET["brand"]);
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

if (isset($_GET["availablity"]) and $_GET["availablity"] != '') {
    $availablity = intval($_GET["availablity"]);
    $filter_exists = true;
} else $availablity = "";


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

    if ($availablity == 1) {
        if ($filter_chunk == '') {
            $filter_chunk = ' (';
        } else $filter_chunk = ' and (';
        $filter_chunk .= " `onstock_spb` > '0' or `onstock_msk` > '0') ";
        $mysql_product_filter .= $filter_chunk;
    }

} else $mysql_product_filter = "";



// end preparing filters
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
