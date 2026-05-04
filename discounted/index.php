<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

global $mysqli_db, $db, $arResult;

if (!function_exists('database_connect')) {
    include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
    database_connect();
    mysqli_set_charset($mysqli_db, "utf8");
}

$route_string = isset($_REQUEST["q"]) ? trim($_REQUEST["q"], '/') : "";
$route_string = preg_replace('/[^a-zA-Z0-9\-_]/', '', $route_string);

if (!empty($route_string)) {
    $escaped_url = mysqli_real_escape_string($mysqli_db, $route_string);
    
    $query = "SELECT * FROM `discounted` WHERE `seo_url` = '$escaped_url' AND `show` = 1 LIMIT 1";
    $result = mysqli_query($mysqli_db, $query);
    $product = mysqli_fetch_assoc($result);
    
    if (!$product) {
        $query = "SELECT * FROM `discounted` WHERE `model` = '$escaped_url' AND `show` = 1 LIMIT 1";
        $result = mysqli_query($mysqli_db, $query);
        $product = mysqli_fetch_assoc($result);
    }
    
    if ($product) {
        $product['arr_pics'] = array();
        if (!empty($product['preview_picture'])) {
            $product['arr_pics'][] = basename($product['preview_picture']);
        }
        
        $img_dir = dirname($product['preview_picture']);
        $product['imgRemoteDir'] = $img_dir . '/';
        
        $arResult['product'] = $product;
        $arResult['section'] = array(
            'name' => 'Уцененные товары',
            'code' => 'discounted'
        );
        
        global $TITLE, $DESCRIPTION, $CANONICAL, $H1;
        $TITLE = $product['name'] . " | Уцененный товар | Купить со скидкой | Русавтоматика";
        $DESCRIPTION = "Уцененный товар " . $product['name'] . " по цене " . $product['price'] . " руб.";
        $CANONICAL = "https://www.rusavtomatika.com/discounted/" . $product['seo_url'] . "/";
        $H1 = $product['name'];
        
        CoreApplication::include_component(array(
            "component" => "newslist_detail",
            "template" => "discounted"
        ));
    } else {
        http_response_code(404);
        echo "<h1>404 - Товар не найден</h1>";
        echo "<p>Товар по ссылке '{$route_string}' не найден.</p>";
        echo "<a href='/discounted/'>Вернуться к списку</a>";
    }
} else {
    $arguments = array();
    $arguments["route_string"] = "";
    $arguments["template"] = "discounted";
    $arguments["component"] = "newslist";
    CoreApplication::include_component($arguments);
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
?>