<?php
global $APPLICATION;
$condition = '';
if (isset($_GET["section"]) and $_GET["section"] != ''){
    $section = strip_tags(trim($_GET["section"]));
    if($section != ''){
        $condition = " and `section_sys_name` = '$section' ";
    }

}
$arResult["news_list"] = CoreApplication::get_rows_from_table('videos','*'," `show`='1' {$condition} ",'position DESC');
