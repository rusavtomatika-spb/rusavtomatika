<?php

$db_host = 'localhost';
$db_user = 'moisait_olga';
$db_pass = 'olgaglr';
$db_name = 'moisait_weintek';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    die('Ошибка подключения к БД: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8');

$result = $mysqli->query("SELECT articul, price_usd, price_rub, description FROM products_price ORDER BY articul");
$prices = array();
while ($row = $result->fetch_assoc()) {
    $prices[] = $row;
}
$mysqli->close();

$usd_rate = 0;
$rate_file = dirname(__DIR__) . '/usdrate.txt';
if (file_exists($rate_file)) {
    $usd_rate = floatval(file_get_contents($rate_file));
}
if ($usd_rate <= 0) {
    $rate_file = __DIR__ . '/../etm_converter/docs/usdrate.txt';
    if (file_exists($rate_file)) {
        $usd_rate = floatval(file_get_contents($rate_file));
    }
}

function formatPrice($price, $usd_rate, $is_usd = false) {
    if (!$price) return '—';
    if ($is_usd && $usd_rate > 0) {
        return '$' . number_format($price, 2, '.', ' ') . ' / ₽' . number_format(round($price * $usd_rate, 2), 2, '.', ' ');
    }
    if ($is_usd) {
        return '$' . number_format($price, 2, '.', ' ');
    }
    return '₽' . number_format($price, 2, '.', ' ');
}

require_once __DIR__ . '/template_price.php';