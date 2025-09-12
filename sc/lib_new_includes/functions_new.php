<?php
global $arrProductTypes;
$arrProductTypes = [
    "hmi" => "������ ���������",
    "Gateway" => "���� ������",
    "doors-hmi" => "������ ���������",
    "cloud_hmi" => "�������� ���������",
    "panel_pc" => "��������� ���������",
    "open_hmi" => "�������� ���������",
    "machine-tv-interface" => "��������� MACHINE-TV",
    "monitor" => "������������ �������", 
    "monitors" => "������������ �������", 
    "monitor_cmt" => "����� ��������� ����������", 
    "module_io" => "������ �����-������",  
    "coupler" => "���������������� ������",
    "box-pc" => "������������ ���������",
    "monitor_cloud_hmi" => "����� ��������� ����������",
    "controllers" => "����������",

    ];


function getUrlProduct($brend, $type){
    $result = "";
switch ($brend){
    case "Weintek":
        if($type == "hmi"){
            $result = "/weintek/";
        }
        if($type == "panel_pc"){
            $result = "/weintek/";
        }
        if($type == "Gateway"){
            $result = "/weintek/";
        }


    break;
    case "APLEX":
        if($type == "box-pc"){
            $result = "/vstraivaemye-kompyutery/aplex/ACS/";
        }
        if($type == "panel_pc"){
            $result = "/panelnie-computery/ifc/";
        }
        break;
    case "IFC":
        if($type == "panel_pc"){
            $result = "/panelnie-computery/ifc/";
        }
        break;
    case "Cincoze":
        if($type == "panel_pc"){
            $result = "/cincoze/";
        }
        break;
    default:
        $result = "";
        break;
}

    return $result;
}


function get_monitors_by_series($series) {
    global $mysqli_db;

    mysqli_query($mysqli_db,"SET NAMES 'cp1251'");
    $query = "SELECT * FROM `products_all` where `series`='" . $series . "'  ORDER BY `view_order` ASC ";
    $result = mysqli_query($mysqli_db, $query) or die("<br>Invalid query: $query  <br>" . mysqli_error($mysqli_db));
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        for ($row = 0; $row < $rows; $row++) {
            $current_row = mysqli_fetch_assoc($result);
            $arElements[] = $current_row;
        }
    } else {
        $arElements = '';
    };
    if (is_array($arElements) && isset($arguments["SEF"])) {
        foreach ($arElements as $key => $element) {
            $arElements[$key]["images"] = get_gallery_images_for_products_all($element["model"]);

            $making_page_url = $arguments["SEF"]["element"];
            $making_page_url = str_replace("#section_code#", $element["series"], $making_page_url);
            $making_page_url = str_replace("#element_code#", $element["model"], $making_page_url);
            $arElements[$key]["page_url"] = $making_page_url;
        }
    }
    return $arElements;
}

function get_gallery_images_for_products_all($model) {
    global $mysqli_db;
    database_connect();

    if (!isset($model) or $model == "")
        return false;
    $query = "SELECT * FROM `gallery` WHERE `model` = '" . $model . "' ORDER BY `position`;";
    $result = mysqli_query($mysqli_db, $query) or die("<br>get_gallery_images_for_products_all: ������ � �������: $query <br><br>" . mysqli_error($mysqli_db));
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        for ($row = 0; $row < $rows; $row++) {
            $current_row = mysqli_fetch_assoc($result);
            $out[] = $current_row;
        }
    }
    return $out;
}

function get_products_files($model) {
    global $mysqli_db;

    database_connect();
    $query = "SELECT * FROM `products_files` WHERE `product_name` = '" . $model . "' ORDER BY `position`";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        for ($row = 0; $row < $rows; $row++) {
            $current_row = mysqli_fetch_assoc($result);
            $out[] = $current_row;
        }
    } else {
        $out = array();
    };
    return $out;
}

