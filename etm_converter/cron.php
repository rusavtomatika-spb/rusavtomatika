<?php
set_time_limit(0);

$log_file = __DIR__ . '/edi_converter.log';

function cronLog($message, $log_file) {
    $timestamp = date('d-m-Y H:i:s');
    $log_message = "[{$timestamp}] {$message}\n";
    file_put_contents($log_file, $log_message, FILE_APPEND);
}

require_once __DIR__ . '/edi_converter.php';
$config = require __DIR__ . '/config.php';

cronLog("=== CRON Старт ===", $log_file);

$converter = new ETMConverter(array(
    'base_path' => '/home/moisait/public_html/rusavto',
    'api_url' => $config['api_url'],
    'api_login' => $config['api_login'],
    'api_password' => $config['api_password'],
    'db_host' => 'localhost',
    'db_user' => 'moisait_olga',
    'db_pass' => 'olgaglr',
    'db_name' => 'moisait_ra'
));

try {
    $result = $converter->process();
    
    if ($result) {
        cronLog("OK Обработка завершена успешно", $log_file);
    } else {
        cronLog("ERROR Обработка завершена с ошибками", $log_file);
    }
} catch (Exception $e) {
    cronLog("EXCEPTION: " . $e->getMessage(), $log_file);
}

cronLog("=== CRON Финиш ===", $log_file);