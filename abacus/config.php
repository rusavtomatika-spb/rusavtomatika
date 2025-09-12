<?php
//include_once $_SERVER["DOCUMENT_ROOT"] . "/config.php";

if (!defined('PROLOG_INCLUDED')) exit;
define('CORE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/abacus/");


$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
$url = explode('/', $url);

if (isset($url[1])) {
    $url_first_section = $url[1];
} else $url_first_section = '';

if(!defined('EX')) define('EX', '');
if (EX == '_') {
    switch ($url_first_section) {
        case 'catalog':
        case 'weintek' . EX:
        case 'samkoon' . EX:
        case 'ifc' . EX:
        case 'aplex' . EX:
        case 'ewon' . EX:
        case 'faraday' . EX:
        case 'yottacontrol' . EX:
        case 'test':
        case 'library':
        case 'index2.php':
        case 'contacts':
        case 'about':
        case 'payment-shipping':
        case 'news' . EX:
        case 'articles' . EX:
        case 'support':
        case 'download':
        case 'weintek_projects' . EX:
        case 'weintek_libraries' . EX:
        case 'weintek_drivers' . EX:
        case 'weintek_drivers_brands' . EX:
        case 'documents' . EX:
        case 'new-products' . EX:
        case 'video' . EX:
        case 'sertificates':
        case 'accessories' . EX:
        case 'rusavtomatika' . EX:
        case 'faraday' . EX:
        case 'discounted' . EX:
        case 'mqtt' . EX:
        case 'sitemap':
            define('MAIN_TEMPLATE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/abacus/templates/rusavtomatika_bulma/");
            global $CURRENT_TEMPLATE;
            $CURRENT_TEMPLATE = "rusavtomatika_bulma";
            break;
        default:
            define('MAIN_TEMPLATE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/abacus/templates/rusavtomatika_adaptive/");
            break;
    }
} else {
    define('MAIN_TEMPLATE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/abacus/templates/rusavtomatika_bulma/");
    global $CURRENT_TEMPLATE;
    $CURRENT_TEMPLATE = "rusavtomatika_bulma";
}

