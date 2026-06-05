<?php

class ETMConverter {
    
    private $base_path;
    private $incoming_path;
    private $archive_path;
    private $output_path;
    
    private $encoding = 'Windows-1251';
    private $delimiter = ';';
    
    private $mysqli = null;
    
    private $log_file;
    
    /**
     * Конструктор
     */
    public function __construct($config = array()) {
        if (isset($config['base_path'])) {
            $this->base_path = $config['base_path'];
        } else {
            $this->base_path = dirname(__DIR__);
        }
        
        $this->incoming_path = $this->base_path . '/to_etm';
        $this->archive_path = $this->base_path . '/to_etm/recd';
        $this->output_path = $this->base_path . '/from_etm';
        $this->log_file = __DIR__ . '/edi_converter.log';
        
        if (!empty($config['incoming_path'])) $this->incoming_path = $config['incoming_path'];
        if (!empty($config['archive_path'])) $this->archive_path = $config['archive_path'];
        if (!empty($config['output_path'])) $this->output_path = $config['output_path'];
        if (!empty($config['log_file'])) $this->log_file = $config['log_file'];
        
        if (!empty($config['db_host'])) {
            $this->connectDatabase($config);
        }
        
        $this->ensureDirectories();
        date_default_timezone_set('Europe/Moscow');
    }
    
    /**
     * Подключение к базе данных
     */
    private function connectDatabase($config) {
        $host = $config['db_host'];
        $user = $config['db_user'];
        $pass = $config['db_pass'];
        $name = $config['db_name'];
        
        $this->mysqli = new mysqli($host, $user, $pass, $name);
        
        if ($this->mysqli->connect_error) {
            $this->log("ОШИБКА подключения к БД: " . $this->mysqli->connect_error);
            $this->mysqli = null;
        } else {
            $this->mysqli->set_charset('utf8');
            $this->log("Подключение к БД установлено: {$name}");
        }
    }
    
    /**
     * Получить данные товара из products_all
     */
    private function getProductData($article) {
        if (!$this->mysqli) return null;
        
        $article = $this->mysqli->real_escape_string($article);
        
        $query = "SELECT 
            model,
            model_fullname,
            brand,
            retail_price,
            action_price,
            currency,
            onstock_spb,
            preview_text,
            short_name,
            dimentions,
            weight
          FROM products_all 
          WHERE model = '{$article}' 
          LIMIT 1";
        
        $result = $this->mysqli->query($query);
        
        if ($result && $row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }
    
    /**
     * Получить цену в рублях
     */
    private function getPriceRub($product) {
        if (!$product) return '';
        
        $usd_currency = $this->getUsdRate();
        
        if ($product['currency'] === 'RUR') {
            return $product['retail_price'];
        } elseif ($usd_currency > 0) {
            return round($product['retail_price'] * $usd_currency);
        }
        
        return $product['retail_price'];
    }
    
    /**
     * Получить курс USD из файла
     */
    private function getUsdRate() {
        $rate_file = $this->base_path . '/usdrate.txt';
        if (file_exists($rate_file)) {
            return floatval(file_get_contents($rate_file));
        }
        // Запасной путь
        $rate_file = $_SERVER['DOCUMENT_ROOT'] . '/usdrate.txt';
        if (file_exists($rate_file)) {
            return floatval(file_get_contents($rate_file));
        }
        return 0;
    }
    
    // ============== ОСТАЛЬНЫЕ МЕТОДЫ (без изменений) ==============
    
    private function ensureDirectories() {
        $dirs = array($this->incoming_path, $this->archive_path, $this->output_path, $this->output_path . '/recd');
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
                $this->log("Создана директория: {$dir}");
            }
        }
    }
    
    /**
     * Основной метод обработки
     */
    public function process() {
        $this->log("=== Начало обработки EDI сообщений ===");
        $this->log("Base path: {$this->base_path}");
        
        if (!is_dir($this->incoming_path)) {
            $this->log("ОШИБКА: Директория {$this->incoming_path} не найдена");
            return false;
        }
        
        $files = scandir($this->incoming_path);
        if (!$files) { $this->log("Нет файлов для обработки"); return true; }
        
        $processed = 0;
        foreach ($files as $file) {
            if ($file == '.' || $file == '..' || $file == 'recd') continue;
            $full_path = $this->incoming_path . '/' . $file;
            if (is_dir($full_path)) continue;
            
            $this->log("Обработка файла: {$file}");
            if ($this->processFile($full_path, $file)) {
                $this->archiveFile($full_path, $file);
                $processed++;
            }
        }
        
        $this->log("Обработано файлов: {$processed}");
        $this->log("=== Завершение ===");
        return true;
    }
    
    /**
     * Обработка файла в зависимости от типа сообщения
     */
    private function processFile($file_path, $file_name) {
        $content = file_get_contents($file_path);
        if (empty($content)) return false;
        
        $detected = mb_detect_encoding($content, array('Windows-1251', 'UTF-8', 'CP1251'), true);
        if ($detected === 'Windows-1251' || $detected === 'CP1251') {
            $content = mb_convert_encoding($content, 'UTF-8', 'Windows-1251');
        }
        
        $message_type = $this->detectMessageType($content);
        $this->log("Тип сообщения: {$message_type}");
        
        switch ($message_type) {
            case 'ORDER':    return $this->processOrder($content, $file_name);
            case 'ORDERSP':  return $this->processTransit($content, $file_name, 'ORDERSP');
            case 'INVOIC':   return $this->processTransit($content, $file_name, 'INVOIC');
            case 'INVRPT':   return $this->processTransit($content, $file_name, 'INVRPT');
            case 'PRODAT':   return $this->processTransit($content, $file_name, 'PRODAT');
            case 'PROJECT':  return $this->processTransit($content, $file_name, 'PROJECT');
            case 'PROJSTA':  return $this->processTransit($content, $file_name, 'PROJSTA');
            case 'PROJQUO':  return $this->processTransit($content, $file_name, 'PROJQUO');
            default: $this->log("Неизвестный тип: {$file_name}"); return false;
        }
    }
    
    /**
     * Определение типа EDI сообщения
     */
    private function detectMessageType($content) {
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            if (strpos($line, 'MSGTYPE:ORDERSP') !== false) return 'ORDERSP';
            if (strpos($line, 'MSGTYPE:PROJSTA') !== false) return 'PROJSTA';
            if (strpos($line, 'MSGTYPE:PROJQUO') !== false) return 'PROJQUO';
            if (strpos($line, 'Артикул;Наименование;Количество;Цена') !== false) return 'INVOIC';
            if (strpos($line, 'Продавец:') !== false) return 'INVOIC';
            if (strpos($line, 'Режим:ОписаниеТоваров') !== false) return 'PRODAT';
            if (strpos($line, 'Код проекта') !== false && strpos($line, 'Название проекта') !== false) return 'PROJECT';
            if (preg_match('/^(ЭТМ,|Дата:|Номер:|Примечание:)/u', $line)) return 'ORDER';
            if (strpos($line, 'Название;Производитель;Артикул') !== false || strpos($line, 'NameRgd;CodeMnf;Article') !== false) return 'INVRPT';
        }
        return 'UNKNOWN';
    }
    
    /**
     * Обработка заявки ORDER
     */
    private function processOrder($content, $file_name) {
        $this->log("Обработка заявки ORDER: {$file_name}");
        
        $lines = explode("\n", $content);
        $csv_rows = array();
        $in_header = true;
        $header = array();
        $items = array();
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            if ($in_header) {
                if (strpos($line, ':') !== false) {
                    list($key, $value) = explode(':', $line, 2);
                    $header[trim($key)] = trim($value);
                } elseif (preg_match('/^(ЭТМ,)/u', $line)) {
                    $header['warehouse'] = $line;
                } else {
                    $in_header = false;
                    $items[] = $this->parseOrderItem($line);
                }
            } else {
                $items[] = $this->parseOrderItem($line);
            }
        }
        
        $first_item = isset($items[0]) ? $items[0] : array();
        $doc_type = isset($first_item['doc_type']) ? $first_item['doc_type'] : 'заказ';
        
        $order_number = isset($header['Номер']) ? $header['Номер'] : '';
        $warehouse = isset($header['warehouse']) ? $header['warehouse'] : '';
        
        // ============ СПЕЦУСЛОВИЯ ============
        if ($doc_type === 'спецусловия') {
            $csv_rows[] = "Номер заявки;Дата поставки;Название;Артикул;Количество товара;Идентификатор покупателя;Идентификатор документа;Тип подтверждения;Цена;Период действия;Размер предоплаты;Отсрочка дней;Цена Клиента;MSGTYPE:ORDERSP";
            
            foreach ($items as $item) {
                $name = isset($item['name']) ? $item['name'] : '';
                $article = isset($item['article']) ? $item['article'] : '';
                $quantity = isset($item['quantity']) ? $item['quantity'] : '';
                $basis = isset($item['basis']) ? $item['basis'] : '';
                
                $product = $this->getProductData($article);
                $price_rub = $this->getPriceRub($product);
                
                if ($product && !empty($product['model_fullname'])) {
                    $name = $product['model_fullname'];
                }
                
                $row = array(
                    $order_number,
                    '',                // Дата поставки
                    $name,
                    $article,
                    $quantity,
                    $warehouse,
                    $basis,
                    'Принят',          // Для спецусловий
                    $price_rub,        // Цена из БД
                    '',                // Период действия
                    '',                // Предоплата
                    '',                // Отсрочка
                    $price_rub         // Цена клиента = цена
                );
                $csv_rows[] = implode($this->delimiter, $row);
            }
        }
        // ============ ЗАКАЗ / ЗАПРОС ============
        else {
            $csv_rows[] = "Номер заявки;Дата поставки;Название;Артикул;Количество товара;Идентификатор покупателя;Тип подтверждения;MSGTYPE:ORDERSP";
            
            foreach ($items as $item) {
                $name = isset($item['name']) ? $item['name'] : '';
                $article = isset($item['article']) ? $item['article'] : '';
                $quantity = isset($item['quantity']) ? $item['quantity'] : '';
                
                $product = $this->getProductData($article);
                
                if ($product && !empty($product['model_fullname'])) {
                    $name = $product['model_fullname'];
                }
                
                $stock_status = 'Получено';
                if ($product) {
                    if ($product['onstock_spb'] >= $quantity) {
                        $stock_status = 'Принято без изменений';
                    } elseif ($product['onstock_spb'] > 0) {
                        $stock_status = 'Изменение';
                    }
                }
                
                $row = array(
                    $order_number,
                    '',              // Дата поставки (заполняется вручную)
                    $name,
                    $article,
                    $quantity,
                    $warehouse,
                    $stock_status    // Автоопределение по наличию
                );
                $csv_rows[] = implode($this->delimiter, $row);
            }
        }
        
        return $this->saveCsvFile($csv_rows, 'ORDERSP', $file_name);
    }
    
    /**
     * Обработка INVOIC, INVRPT, PRODAT, PROJECT, PROJSTA, PROJQUO (транзит)
     */
    private function processTransit($content, $file_name, $type) {
        $this->log("Обработка {$type} (транзит): {$file_name}");
        $lines = explode("\n", $content);
        $csv_rows = array();
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        return $this->saveCsvFile($csv_rows, $type, $file_name);
    }
    
    
    /**
     * Парсинг строки позиции заказа
     */
    private function parseOrderItem($line) {
        $fields = explode($this->delimiter, $line);
        return array(
            'name' => isset($fields[0]) ? $fields[0] : '',
            'article' => isset($fields[1]) ? $fields[1] : '',
            'unit' => isset($fields[2]) ? $fields[2] : '',
            'quantity' => isset($fields[3]) ? $fields[3] : '',
            'doc_type' => isset($fields[4]) ? $fields[4] : '',
            'project_code' => isset($fields[5]) ? $fields[5] : '',
            'package_capacity' => isset($fields[6]) ? $fields[6] : '',
            'basis' => isset($fields[7]) ? $fields[7] : ''
        );
    }
    
    /**
     * Архивирование обработанного входящего файла
     */
    private function archiveFile($file_path, $file_name) {
        $archive_file = $this->archive_path . '/' . date('Ymd_His_') . '_' . $file_name;
        if (rename($file_path, $archive_file)) {
            $this->log("Файл {$file_name} перемещен в архив");
            return true;
        }
        if (copy($file_path, $archive_file)) { unlink($file_path); return true; }
        return false;
    }
    
    /**
     * Сохранение CSV-файла в from_etm для ЭТМ
     */
    private function saveCsvFile($rows, $type, $original_name) {
        $safe_name = preg_replace('/[^a-zA-Z0-9._-]/', '_', $original_name);
        $output_file = $this->output_path . '/' . date('Ymd_His_') . "_{$type}_" . $safe_name;
        if (strtolower(pathinfo($output_file, PATHINFO_EXTENSION)) !== 'csv') $output_file .= '.csv';
        
        $content = implode("\n", $rows);
        $content = mb_convert_encoding($content, $this->encoding, 'UTF-8');
        
        if (file_put_contents($output_file, $content)) {
            $this->log("Файл сохранен в from_etm: " . basename($output_file));
            return true;
        }
        return false;
    }
    
    /**
     * Логирование
     */
    private function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        $log_message = "[{$timestamp}] {$message}\n";
        echo $log_message;
        file_put_contents($this->log_file, $log_message, FILE_APPEND);
    }
    
    public function __destruct() {
        if ($this->mysqli) $this->mysqli->close();
    }
}