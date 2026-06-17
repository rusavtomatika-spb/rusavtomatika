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
$config = require __DIR__ . '/config.php';

$log_file = __DIR__ . '/edi_converter.log';
$output = '';
$show_result = false;

if (isset($_POST['clear_log'])) {
    if (file_exists($log_file)) {
        unlink($log_file);
    }
}

if (isset($_POST['run'])) {
    ob_start();
    
    echo "=== Запуск ETM Converter ===\n";
    echo "Время: " . date('Y-m-d H:i:s') . "\n";
    echo "Сервер: " . $_SERVER['SERVER_NAME'] . "\n";
    echo "Директория скрипта: " . __DIR__ . "\n";
    echo "API URL: " . $config['api_url'] . "\n\n";
    
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
            echo "\nOK Обработка завершена успешно\n";
        } else {
            echo "\nERROR Обработка завершена с ошибками\n";
        }
    } catch (Exception $e) {
        echo "\nERROR: " . $e->getMessage() . "\n";
    }
    
    echo "\n\n=== Последние записи лога ===\n";
    if (file_exists($log_file)) {
        $lines = file($log_file);
        $lines = array_slice($lines, -50);
        echo implode('', $lines);
    }
    
    $output = ob_get_clean();
    $show_result = true;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ETM Converter</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Consolas', 'Monaco', 'Courier New', monospace; 
            background: #1a1a1a; 
            color: #e0e0e0; 
            padding: 20px;
            min-height: 100vh;
        }
        .container { max-width: 1100px; margin: 0 auto; }
        h1 { 
            color: #00bcd4; 
            font-size: 20px; 
            margin-bottom: 20px;
            font-weight: normal;
        }
        .btn-row { 
            display: flex; 
            gap: 10px; 
            margin-bottom: 20px; 
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            color: #1a1a1a;
            border: none;
            font-size: 16px;
            font-family: inherit;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-run { background: #00bcd4; }
        .btn-run:hover { background: #00acc1; }
        .btn-refresh { background: #4caf50; }
        .btn-refresh:hover { background: #43a047; }
        .btn-clear { background: #ef5350; }
        .btn-clear:hover { background: #e53935; }
        .output {
            background: #0d0d0d;
            border: 1px solid #333;
            padding: 20px;
            white-space: pre-wrap;
            word-break: break-all;
            font-size: 13px;
            line-height: 1.5;
            max-height: 70vh;
            overflow-y: auto;
            color: #b0b0b0;
        }
        .status {
            margin-bottom: 15px;
            padding: 10px 15px;
            font-weight: bold;
        }
        .status.ok { background: #1b5e20; color: #a5d6a7; }
        .status.error { background: #b71c1c; color: #ffcdd2; }
        .info {
            color: #888;
            font-size: 12px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ETM Converter</h1>
        
        <div class="btn-row">
            <form method="post">
                <button type="submit" name="run" class="btn btn-run">
                    ▶ Запустить обработку
                </button>
            </form>
            <form method="post" onsubmit="return confirm('Очистить лог?');">
                <button type="submit" name="clear_log" class="btn btn-clear">
                    🗑 Очистить лог
                </button>
            </form>
            <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-refresh">↻ Обновить</a>
        </div>
        
        <?php if ($show_result): ?>
            <?php if (strpos($output, 'ERROR') !== false || strpos($output, 'ОШИБКА') !== false): ?>
                <div class="status error">Обнаружены ошибки при обработке</div>
            <?php else: ?>
                <div class="status ok">Обработка завершена</div>
            <?php endif; ?>
            <div class="output"><?= htmlspecialchars($output) ?></div>
        <?php else: ?>
            <div class="info">Нажмите кнопку для запуска обработки EDI сообщений</div>
            
            <?php
            if (file_exists($log_file)) {
                $lines = file($log_file);
                $lines = array_slice($lines, -25);
                echo '<div class="output">' . htmlspecialchars(implode('', $lines)) . '</div>';
            }
            ?>
        <?php endif; ?>
    </div>
</body>
</html>