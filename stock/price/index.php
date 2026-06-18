<?php

session_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login_time'])) {
    header('Location: /stock/');
    exit;
}

$db_host = 'localhost';
$db_user = 'moisait_olga';
$db_pass = 'olgaglr';
$db_name = 'moisait_weintek';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    die('Ошибка подключения к БД: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8');

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $articul = trim($_POST['articul'] ? $_POST['articul'] : '');
        $price_usd = $_POST['price_usd'] !== '' ? floatval($_POST['price_usd']) : null;
        $price_rub = $_POST['price_rub'] !== '' ? floatval($_POST['price_rub']) : null;
        $description = trim($_POST['description'] ? $_POST['description'] : '');
        
        if (empty($articul)) {
            $_SESSION['flash'] = array('message' => 'Артикул обязателен', 'type' => 'error');
        } else {
            $stmt = $mysqli->prepare("INSERT INTO products_price (articul, price_usd, price_rub, description) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE price_usd = VALUES(price_usd), price_rub = VALUES(price_rub), description = VALUES(description)");
            $stmt->bind_param('sdds', $articul, $price_usd, $price_rub, $description);
            
            if ($stmt->execute()) {
                $_SESSION['flash'] = array('message' => 'Товар "' . htmlspecialchars($articul) . '" сохранён', 'type' => 'ok');
            } else {
                $_SESSION['flash'] = array('message' => 'Ошибка: ' . $stmt->error, 'type' => 'error');
            }
            $stmt->close();
        }
        header('Location: /stock/price');
        exit;
    }
    
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $id = intval($_POST['id'] ? $_POST['id'] : 0);
        $articul = trim($_POST['articul'] ? $_POST['articul'] : '');
        $price_usd = $_POST['price_usd'] !== '' ? floatval($_POST['price_usd']) : null;
        $price_rub = $_POST['price_rub'] !== '' ? floatval($_POST['price_rub']) : null;
        $description = trim($_POST['description'] ? $_POST['description'] : '');
        
        if ($id <= 0 || empty($articul)) {
            $_SESSION['flash'] = array('message' => 'Артикул обязателен', 'type' => 'error');
        } else {
            $stmt = $mysqli->prepare("UPDATE products_price SET articul = ?, price_usd = ?, price_rub = ?, description = ? WHERE id = ?");
            $stmt->bind_param('sddsi', $articul, $price_usd, $price_rub, $description, $id);
            
            if ($stmt->execute()) {
                $_SESSION['flash'] = array('message' => 'Товар "' . htmlspecialchars($articul) . '" обновлён', 'type' => 'ok');
            } else {
                $_SESSION['flash'] = array('message' => 'Ошибка: ' . $stmt->error, 'type' => 'error');
            }
            $stmt->close();
        }
        header('Location: /stock/price');
        exit;
    }
    
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = intval($_POST['id'] ? $_POST['id'] : 0);
        
        if ($id > 0) {
            $stmt = $mysqli->prepare("DELETE FROM products_price WHERE id = ?");
            $stmt->bind_param('i', $id);
            
            if ($stmt->execute()) {
                $_SESSION['flash'] = array('message' => 'Товар удалён', 'type' => 'ok');
            } else {
                $_SESSION['flash'] = array('message' => 'Ошибка: ' . $stmt->error, 'type' => 'error');
            }
            $stmt->close();
        }
        header('Location: /stock/price');
        exit;
    }
}

if (isset($_SESSION['flash'])) {
    $message = $_SESSION['flash']['message'];
    $message_type = $_SESSION['flash']['type'];
    unset($_SESSION['flash']);
}

$result = $mysqli->query("SELECT id, articul, price_usd, price_rub, description FROM products_price ORDER BY articul");
$prices = array();
while ($row = $result->fetch_assoc()) {
    $prices[] = $row;
}
$mysqli->close();

$usd_rate = 0;
$rate_file = dirname(dirname(__DIR__)) . '/usdrate.txt';
if (file_exists($rate_file)) {
    $usd_rate = floatval(file_get_contents($rate_file));
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

require_once __DIR__ . '/template.php';