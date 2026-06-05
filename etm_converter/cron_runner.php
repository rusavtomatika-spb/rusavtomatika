<?php

$allowed_servers = array(
    'www.rusavto.moisait.net',
    'rusavto.moisait.net',
    'moisait.net'
);

if (!in_array($_SERVER['SERVER_NAME'], $allowed_servers)) {
    die('Access denied: ' . $_SERVER['SERVER_NAME']);
}

define('SCRIPT_DIR', __DIR__);
require_once SCRIPT_DIR . '/edi_converter.php';

$converter = new ETMConverter(array(
    'base_path' => '/home/moisait/public_html/rusavto'
));

try {
    echo "=== Запуск ETM Converter ===\n";
    echo "Время: " . date('Y-m-d H:i:s') . "\n\n";
    
    $result = $converter->process();
    
    if ($result) {
        echo "Обработка завершена успешно\n";
    } else {
        echo "Обработка завершена с ошибками\n";
    }
} catch (Exception $e) {
    echo "КРИТИЧЕСКАЯ ОШИБКА: " . $e->getMessage() . "\n";
    error_log("ETM Converter Error: " . $e->getMessage());
}

echo "\n=== Завершение ===\n";
?>