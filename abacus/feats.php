<?php
// Заголовки
header('Content-type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Дата в прошлом
header('Pragma: no-cache'); // HTTP/1.0

define('ENCODING', 'UTF-8');
define('PROLOG_INCLUDED', true);
if (!defined('bullshit')) {
    define('bullshit', 1);
}

ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Подключение к базе данных
require_once($_SERVER["DOCUMENT_ROOT"] . '/abacus/init.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/abacus/config.php');

include_once($_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php");
database_connect();
global $mysqli_db, $mysql_db;

if ($mysqli_db) {
    mysqli_query($mysqli_db, "SET NAMES utf8");
} else {
    mysql_query("SET NAMES utf8", $mysql_db);
}

// Выбор всех товаров из таблицы products_all
$sql = "SELECT * FROM products_all ORDER BY `index` ASC";

// Выполняем запрос и проверяем результат
$result = mysqli_query($mysqli_db, $sql);

if (!$result) {
    echo "Ошибка выполнения запроса: " . mysqli_error($mysqli_db); // Сообщение об ошибке
    exit(); // Прерывание выполнения скрипта
}

// Обработка каждой строки
while ($row = mysqli_fetch_assoc($result)) {
    // Основные переменные
    $index = $row['index'];
    $mqtt = $row['mqtt'];
    $easy_access = $row['easy_access'];
    $opc_ua = $row['opc_ua'];
    $codesys = $row['codesys'];
    $dashboard = $row['dashboard'];
    $matrix = $row['matrix'];
    $wifi_support = $row['wifi_support'];
    $oldTextFeatures = $row['text_features']; // Сохраняем предыдущие преимущества

    // Новый список преимуществ
    $featuresList = '';

    // MQTT поддержка
    if ($mqtt == 1) {
        $featuresList .= '<li><a href="/articles/mqtt/" target="_new">MQTT</a>: есть</li>';
    }

    // Поддержка EasyAccess
    if ($easy_access == 'optional') {
        $featuresList .= '<li><a href="/accessories/easyaccess/" target="_new">EasyAccess 2.0</a>: опционально</li>';
    } elseif ($easy_access == 'build_in') {
        $featuresList .= '<li><a href="/accessories/easyaccess/" target="_new">EasyAccess 2.0</a>: с лицензией</li>';
    }

    // Описание поддержки OPC UA
    if ($opc_ua > 0) {
        switch ($opc_ua) {
            case 1:
                $featuresList .= '<li><a href="/news/hmi-opcua/" target="_new">OPC UA</a>: клиент</li>';
                break;
            case 2:
                $featuresList .= '<li><a href="/news/hmi-opcua/" target="_new">OPC UA</a>: клиент/сервер</li>';
                break;
            case 3:
                $featuresList .= '<li><a href="/news/hmi-opcua/" target="_new">OPC UA</a>: клиент-есть/сервер-опционально</li>';
                break;
        }
    }

    // Информация о поддержке Codesys
    if ($codesys !== 'N' && $codesys !== '') { // Проверяем, что поле не равно 'N' и не пустое
        if ($codesys === 'build_in') {
            $featuresList .= '<li><a href="/articles/codesys-ot-weintek-bystryy-start/" target="_new">Codesys</a>: c лицензией</li>';
        } else { // Любые другие значения означают опциональную поддержку
            $featuresList .= '<li><a href="/articles/codesys-ot-weintek-bystryy-start/" target="_new">Codesys</a>: опционально</li>';
        }
    }

    // Поддержка Dashboard
    if ($dashboard == 1) {
        $featuresList .= '<li><a href="/articles/vse-o-weincloud-dashboard/" target="_new">Dashboard</a>: есть</li>';
    }

    // Информация о матрице дисплея
    if ($matrix != '') {
        $featuresList .= '<li>Матрица: ' . htmlspecialchars($matrix) . '</li>';
    }

    // Есть ли встроенная поддержка Wi-Fi
    if ($wifi_support == 1) {
        $featuresList .= '<li>Wi-Fi: есть</li>';
    } elseif ($wifi_support == 2) {
        $featuresList .= '<li>Wi-Fi: опционально</li>';
    }

    // Объединим старый и новый список преимуществ
    if (!empty($oldTextFeatures)) {

        $newTextFeatures = $oldTextFeatures . '<ul style="margin-top: 0">' . $featuresList . '</ul>'; // Сохраняем старый список и добавляем новый
    } else {
        $newTextFeatures = '<ul>' . $featuresList . '</ul>';
    }

    // Подготовленный запрос на обновление
    $updateSql = "UPDATE products_all SET text_features = '" .
                 mysqli_real_escape_string($mysqli_db, $newTextFeatures) . "' WHERE `index`=" . intval($index);

    // Выполнение обновления
    if (!mysqli_query($mysqli_db, $updateSql)) {
        echo "Ошибка обновления: (" . mysqli_errno($mysqli_db) . ") " . mysqli_error($mysqli_db);
    }
}

// Отключение от базы данных
mysqli_close($mysqli_db);
?>