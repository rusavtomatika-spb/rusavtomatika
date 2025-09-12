<?php

if (!defined('PROLOG_INCLUDED')) exit;

require_once MAIN_TEMPLATE_PATH . 'footer.php';

global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL, $EXTENTIONPARAM;
global $H1_original;
global $TITLE_original;

$buffer = ob_get_contents();
ob_end_clean();  //очищаем буфер
//и продолжаем код после "setTitle('титл','ключи,ключ,ключики','титл с ключами')"
echo "<title>" . $TITLE . "</title>\n";
echo "        <meta name='description' content='" . $DESCRIPTION . "'>\n";
echo "        <meta name='keywords' content='" . $KEYWORDS . "'>\n";

if(isset($TITLE_original) and $TITLE_original != ''){
    echo "<meta name='original_title' content='" . $TITLE_original . "'>\n";
}
if(isset($H1_original) and $H1_original != ''){
    echo "<meta name='original_h1' content='" . $H1_original . "'>\n";
}

if ($EXTENTIONPARAM != ""){
    echo "\n";
    echo $EXTENTIONPARAM;
    echo "\n";
}
if ($CANONICAL != "") echo "<link rel='canonical' href='" . $CANONICAL . "' />\n";


global $extra_openGraph;

if (isset($extra_openGraph) and is_array($extra_openGraph)) {
    echo "\n";
    foreach ($extra_openGraph as $paramName => $paramValue) {
        switch ($paramName) {
            case "openGraph_image":
                echo "\n<meta property='og:image' content='" . $paramValue . "'/>";
                echo "\n<link rel='image_src' href='" . $paramValue . "'>";
                break;
            case "openGraph_title":
                echo "\n<meta property='og:title' content='" . $paramValue . "'/>";
                break;
            case "openGraph_description":
                echo "\n<meta property='og:description' content='" . $paramValue . "'/>";
                break;
            case "openGraph_siteName":
                echo "\n<meta property='og:site_name' content='" . $paramValue . "'/>";
                break;
        }
    }
    echo "\n";
}


echo $buffer;  //выводим все, что было до "setTitle('титл','ключи,ключ,ключики','титл с ключами')"

//setTitle($TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL, $EXTENTIONPARAM);

