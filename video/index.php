<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

global $current_component, $extra_openGraph;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;

$DESCRIPTION = 'Информационное и обучающее видео — продукция и технологии Weintek, IFC, Samkoon, eWON от официального дистрибьютора ООО ФАМ-Электрик';
$KEYWORDS    = 'видео, Weintek, IFC, Samkoon, eWON, операторские панели, новинки, автоматизация производства';
$TITLE       = 'Видео Weintek Easybuilder Pro EBPro, IFC, Samkoon, eWON';

$root_folder_url = trim(explode('?', $_SERVER['REQUEST_URI'])[0], "/");
$root_folder_url = explode('/', $root_folder_url)[0];

$arguments = array(
    "component"       => "newslist",
    "template"        => "video",
    "table"           => "videos",
    "route_string"    => isset($_REQUEST["q"]) ? $_REQUEST["q"] : "",
    "root_folder_url" => $root_folder_url,
);

CoreApplication::include_component($arguments);

if ($current_component != "element") {
    $extra_openGraph = array(
        "openGraph_image"    => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/video.png",
        "openGraph_title"    => "Видеоканал rusavtomatika.com",
        "openGraph_siteName" => "Русавтоматика",
    );
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";