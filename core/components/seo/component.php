<?php
global $H1, $TITLE, $DESCRIPTION, $KEYWORDS, $UPPER_SEO_TEXT, $LOWER_SEO_TEXT;
global $H1_original;
global $TITLE_original;
global $SEO_URL;

$url = $_SERVER['REQUEST_URI'];

$row = CoreApplication::get_rows_from_table('seo', '', "url = '$url'", '', '1');
if (isset($row[0])) {
    $seo_data = $row[0];
    if ($seo_data["active"] == "1") {
        if ($seo_data["TITLE"] != "") {
            $TITLE = $TITLE_original= $seo_data["TITLE"];
        }
        if ($seo_data["H1"] != "") {
            $H1 = $H1_original = $seo_data["H1"];
        }
        if ($seo_data["DESCRIPTION"] != "") {
            $DESCRIPTION = $seo_data["DESCRIPTION"];
        }
        if ($seo_data["KEYWORDS"] != "") {
            $KEYWORDS = $seo_data["KEYWORDS"];
        }
        if ($seo_data["UPPER_SEO_TEXT"] != "") {
            $UPPER_SEO_TEXT = $seo_data["UPPER_SEO_TEXT"];
        }
        if ($seo_data["LOWER_SEO_TEXT"] != "") {
            $LOWER_SEO_TEXT = $seo_data["LOWER_SEO_TEXT"];
        }
        $SEO_URL = $_SERVER['REQUEST_URI'];
    }
}else $SEO_URL = "";

/*
 *
 array(1) {
  [0]=>
  array(8) {
    ["id"]=>
    string(1) "1"
    ["url"]=>
    string(1) "/"
    ["TITLE"]=>
    string(132) "Weintek, панели оператора, панельные компьютеры, промышленные компьютеры, box pc, встраиваемые компьютеры, Samkoon, IFC, Aplex, eWON"
    ["H1"]=>
    string(39) "Поставка оборудования для автоматизации"
    ["DESCRIPTION"]=>
    string(141) "Weintek, Samkoon, Aplex, IFC, eWON панели оператора, операторские панели, промышленные панельные компьютеры, поставки со склада, техподдержка"
    ["KEYWORDS"]=>
    string(481) "операторская панель, панель оператора, промышленные компьютеры, промышленные панельные компьютеры, промышленные компьютеры цена, промышленные компьютеры заказ, безвентиляторные промышленные компьютеры, встраиваемые компьютеры, автоматизация оборудования, разработка ПО, операторские панели, панели оператора, сенсорные панели, HMI, Weintek, EasyView, интерфейс, пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО, ewon, IFC, Samkoon, Aplex"
    ["UPPER_SEO_TEXT"]=>
    string(0) ""
    ["LOWER_SEO_TEST"]=>
    string(0) ""
  }
}
 * */
