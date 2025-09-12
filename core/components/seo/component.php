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
    string(132) "Weintek, ������ ���������, ��������� ����������, ������������ ����������, box pc, ������������ ����������, Samkoon, IFC, Aplex, eWON"
    ["H1"]=>
    string(39) "�������� ������������ ��� �������������"
    ["DESCRIPTION"]=>
    string(141) "Weintek, Samkoon, Aplex, IFC, eWON ������ ���������, ������������ ������, ������������ ��������� ����������, �������� �� ������, ������������"
    ["KEYWORDS"]=>
    string(481) "������������ ������, ������ ���������, ������������ ����������, ������������ ��������� ����������, ������������ ���������� ����, ������������ ���������� �����, ���������������� ������������ ����������, ������������ ����������, ������������� ������������, ���������� ��, ������������ ������, ������ ���������, ��������� ������, HMI, Weintek, EasyView, ���������, ���������������� ���������, ����������� ���������, �������, ��������� �������, ���������� ��, ewon, IFC, Samkoon, Aplex"
    ["UPPER_SEO_TEXT"]=>
    string(0) ""
    ["LOWER_SEO_TEST"]=>
    string(0) ""
  }
}
 * */
