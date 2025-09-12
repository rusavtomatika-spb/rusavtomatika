<?php
global $TITLE;
global $H1;
global $DESCRIPTION;
global $H1_original;
global $TITLE_original;
$H1_original = $H1;
$TITLE_original = $TITLE;
$url = $_SERVER['REQUEST_URI'];
$parts = parse_url($url);
if(isset($parts['query'])){
    parse_str($parts['query'], $query);
    $H1_adding = '';
    if (count($query) > 0) {
        foreach ($query as $query_key => $query_item) {
            switch ($query_key) {
                case "range_price_min":
                    $H1_adding .= ",цена от ".$query_item . "$";
                    break;
                case "range_price_max":
                    $H1_adding .= ",цена до ".$query_item . "$";
                    break;
                case "range_diagonal_min":
                    $H1_adding .= ",диагональ от $query_item&Prime;";
                    break;
                case "range_diagonal_max":
                    $H1_adding .= ",диагональ до $query_item&Prime;";
                    break;
                case "ethernets_range_min":
                    $H1_adding .= ",количество Ethernet от $query_item";
                    break;
                case "ethernets_range_max":
                    $H1_adding .= ",количество Ethernet до $query_item";
                    break;
                case "interfaces":
                    $H1_adding .= ",интерфейсы: $query_item";
                    break;

                case "screenless":
                    $H1_adding .= ",безэкранные";
                    break;
                case "availablity":
                    $H1_adding .= ",в наличии";
                    break;
                case "webview":
                    $H1_adding .= ",WebView";
                    break;
                case "plc_web_browser":
                    $H1_adding .= ",PLC Web-browser";
                    break;
                case "camera_ip":
                    $H1_adding .= ",IP-camera ";
                    break;
                case "camera_usb":
                    $H1_adding .= ",USB-Camera";
                    break;
                case "cmtviewer":
                    $H1_adding .= ",CMT Viewer";
                    break;
                case "vesa":
                    $H1_adding .= ",крепление Vesa";
                    break;
                case "codesys":
                    $H1_adding .= ",Codesys";
                    break;
                case "sensor_type":
                    if($query_item == 'resistive') $query_item = 'резистивный';
                    if($query_item == 'capacitive') $query_item = 'емкостный';
                    $H1_adding .= ",$query_item тип сенсора";
                    break;
                case "sdcard":
                    $H1_adding .= ",SD-карта";
                    break;
                case "resolutions":
                    $H1_adding .= ",разрешение: $query_item";
                    break;
                case "processors":
                    $H1_adding .= ",процессор: $query_item";
                    break;
                case "series":
                    $H1_adding .= ",серия: $query_item";
                    break;
                case "sort":
                    break;
                default:
                    //$H1_adding .= ",$query_item";
                    break;
            }
        }
    }
    $H1_adding = trim($H1_adding,", ");
    $H1_adding = str_replace(",", ", ",$H1_adding);
    if($H1_adding != ""){
        $H1_adding = " (".$H1_adding.")";
        $H1 .= $H1_adding;
        $TITLE .= $H1_adding;
    }
}

