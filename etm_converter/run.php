<?php

$allowed_servers = array(
    'www.rusavto.moisait.net',
    'rusavto.moisait.net',
    'moisait.net'
);

if (!in_array($_SERVER['SERVER_NAME'], $allowed_servers)) {
    header('HTTP/1.0 403 Forbidden');
    die('Доступ запрещён. Сервер: ' . $_SERVER['SERVER_NAME']);
}

require_once __DIR__ . '/edi_converter.php';

echo "<pre>";
echo "=== Запуск ETM Converter ===\n";
echo "Время: " . date('Y-m-d H:i:s') . "\n";
echo "Сервер: " . $_SERVER['SERVER_NAME'] . "\n";
echo "Директория скрипта: " . __DIR__ . "\n\n";

$converter = new ETMConverter(array(
    'base_path' => '/home/moisait/public_html/rusavto'
));

try {
    $result = $converter->process();
    
    if ($result) {
        echo "\nOK Обработка завершена успешно\n";
    } else {
        echo "\nERROR Обработка завершена с ошибками\n";
    }
} catch (Exception $e) {
    echo "\nERROR: " . $e->getMessage() . "\n";
}

echo "\n\n=== Последние записи лога ===\n";
$log_file = __DIR__ . '/edi_converter.log';
if (file_exists($log_file)) {
    $lines = file($log_file);
    $lines = array_slice($lines, -25);
    echo implode('', $lines);
}

echo "</pre>";
?>