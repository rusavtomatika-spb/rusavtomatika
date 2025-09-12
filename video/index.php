<?
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
$element_code = '';
//include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_news_404.php";
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
$DESCRIPTION = 'Информационное и обучающее видео — продукция и технологии Weintek, IFC, Samkoon, eWON от официального дистрибьютора ООО ФАМ-Электрик';
$KEYWORDS = 'видео, Weintek, IFC, Samkoon, eWON, операторские панели, новинки, автоматизация производства';
$TITLE = 'Видео Weintek Easybuilder Pro EBPro, IFC, Samkoon, eWON';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";
//$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/video/";

if($current_component != "element"){
    $extra_openGraph = Array(
        "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/video.png",
        "openGraph_title" => "Видеоканал rusavtomatika.com",
        "openGraph_siteName" => "Русавтоматика"
    );

}

global $arguments;
$arguments = array();
$arguments["route_string"] = (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "";

$arguments["template"] = "video";
$arguments["table"] = "videos";

$root_folder_url = trim(explode('?', $_SERVER['REQUEST_URI'])[0], "/");
$root_folder_url = explode('/',$root_folder_url)[0];
$arguments["root_folder_url"] = $root_folder_url;
$arguments["component"] = "newslist";

CoreApplication::include_component($arguments);
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

?>

