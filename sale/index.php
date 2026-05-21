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

if (strpos($route_string, 'discounted') === 0) {
    $redirect_url = '/sale/';
    if (strlen($route_string) > 10) {
        $remaining = substr($route_string, 10);
        if (!empty($remaining) && $remaining[0] === '/') {
            $remaining = substr($remaining, 1);
        }
        if (!empty($remaining)) {
            $escaped_remaining = mysqli_real_escape_string($mysqli_db, $remaining);
            $query = "SELECT * FROM `discounted` WHERE `seo_url` = '$escaped_remaining' AND `show` = '1' LIMIT 1";
            $result = mysqli_query($mysqli_db, $query);
            $discounted_product = mysqli_fetch_assoc($result);
            
            if ($discounted_product) {
                $redirect_url = '/sale/?discounted=' . $discounted_product['seo_url'];
            } else {
                $query = "SELECT * FROM `products_all` WHERE `seo_url` = '$escaped_remaining' AND `discounted` = '1' LIMIT 1";
                $result = mysqli_query($mysqli_db, $query);
                $product = mysqli_fetch_assoc($result);
                if ($product) {
                    $redirect_url = '/sale/?discounted=' . $product['seo_url'];
                }
            }
        }
    }
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $redirect_url);
    exit;
}

if (empty($route_string) && isset($_GET['discounted']) && !empty($_GET['discounted'])) {
    $discounted_seo = preg_replace('/[^a-zA-Z0-9\-_]/', '', $_GET['discounted']);
    $escaped_discounted = mysqli_real_escape_string($mysqli_db, $discounted_seo);
    
    $query = "SELECT * FROM `discounted` WHERE `seo_url` = '$escaped_discounted' AND `show` = '1' LIMIT 1";
    $result = mysqli_query($mysqli_db, $query);
    $discounted_product = mysqli_fetch_assoc($result);
    
    if ($discounted_product) {
        $arResult['product'] = $discounted_product;
        $arResult['is_discounted'] = true;
        
        global $TITLE, $DESCRIPTION, $CANONICAL, $H1;
        $TITLE = $discounted_product['name'] . " | Уцененный товар | Купить со скидкой | Русавтоматика";
        $DESCRIPTION = "Уцененный товар " . $discounted_product['name'] . " по цене " . $discounted_product['price'] . " руб. Описание уценки: " . $discounted_product['description'];
        $CANONICAL = "https://www.rusavtomatika.com/sale/?discounted=" . $discounted_product['seo_url'];
        $H1 = $discounted_product['name'];
        
        include $_SERVER['DOCUMENT_ROOT'] . "/abacus/components/newslist_detail/templates/discounted/template.php";
    } else {
        $query = "SELECT * FROM `products_all` WHERE `seo_url` = '$escaped_discounted' AND `discounted` = '1' LIMIT 1";
        $result = mysqli_query($mysqli_db, $query);
        $product = mysqli_fetch_assoc($result);
        
        if ($product) {
            $arResult['product'] = $product;
            $arResult['is_discounted'] = true;
            
            global $TITLE, $DESCRIPTION, $CANONICAL, $H1;
            $TITLE = $product['name'] . " | Уцененный товар | Купить со скидкой | Русавтоматика";
            $DESCRIPTION = "Уцененный товар " . $product['name'] . " по цене " . $product['retail_price'] . " руб.";
            $CANONICAL = "https://www.rusavtomatika.com/sale/?discounted=" . $product['seo_url'];
            $H1 = $product['name'];
            
            include $_SERVER['DOCUMENT_ROOT'] . "/abacus/components/newslist_detail/templates/sale/template.php";
        } else {
            http_response_code(404);
            echo "<h1>404 - Товар не найден</h1>";
            echo "<p>Уцененный товар по ссылке не найден.</p>";
            echo "<a href='/sale/'>Вернуться к списку товаров</a>";
        }
    }
    exit;
}

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
        $arResult['is_discounted'] = false;
        
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