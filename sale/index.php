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
    
    $query = "SELECT * FROM `products_all` WHERE `seo_url` = '$escaped_url' AND `action_price` IS NOT NULL AND `action_price` != '' AND `action_price` > 0 LIMIT 1";
    $result = mysqli_query($mysqli_db, $query);
    $product = mysqli_fetch_assoc($result);
    
    if (!$product) {
        $query = "SELECT * FROM `products_all` WHERE `model` = '$escaped_url' AND `action_price` IS NOT NULL AND `action_price` != '' AND `action_price` > 0 LIMIT 1";
        $result = mysqli_query($mysqli_db, $query);
        $product = mysqli_fetch_assoc($result);
    }
    
    if ($product) {
        $arResult['product'] = $product;
        
        global $TITLE, $DESCRIPTION, $CANONICAL, $H1;
        $TITLE = $product['name'] . " | Акционный товар | Купить со скидкой | Русавтоматика";
        $DESCRIPTION = "Акционный товар " . $product['name'] . " по цене " . $product['action_price'] . " руб.";
        $CANONICAL = "https://www.rusavtomatika.com/sale/" . $product['seo_url'] . "/";
        $H1 = $product['name'];
        
        include $_SERVER['DOCUMENT_ROOT'] . "/abacus/components/newslist_detail/templates/sale/template.php";
    } else {
        http_response_code(404);
        echo "<h1>404 - Товар не найден</h1>";
        echo "<p>Акционный товар по ссылке не найден.</p>";
        echo "<a href='/sale/'>Вернуться к списку акций</a>";
    }
} else {
    $arguments = array();
    $arguments["route_string"] = "";
    $arguments["template"] = "sale";
    $arguments["component"] = "newslist";
    CoreApplication::include_component($arguments);
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
?>