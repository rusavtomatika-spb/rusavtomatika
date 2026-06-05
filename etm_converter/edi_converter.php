<?php

class ETMConverter {
    
    private $base_path;
    private $incoming_path;
    private $archive_path;
    private $output_path;
    
    private $encoding = 'Windows-1251';
    private $delimiter = ';';
    
    private $warehouses = [
        'ЭТМ,СПб' => '4660011510200',
        'ЭТМ,Москва' => '4660011510149',
        'ЭТМ,Урал' => '4660011510125',
        'ЭТМ,Самара' => '4660011510132',
        'ЭТМ,Юг' => '4660011510156',
        'ЭТМ,Сибирь' => '4660011510163',
        'ЭТМ,Казань' => '4660011510170',
        'ЭТМ,МЯ' => '4660011510194',
        'ЭТМ,ЦРС' => '4660011511184',
        'ЭТМ,Шушары' => '4660011510200',
        'ЭТМ,Челябинск' => '4660011510538',
        'ЭТМ,Н.Новгород' => '4660011511139',
        'ЭТМ,Воронеж' => '4660011510354',
        'ЭТМ,Воронеж2' => '4660011510446',
        'ЭТМ,Краснодар' => '4660011510545',
        'ЭТМ,Владивосток' => '4660011512136',
        'ЭТМ,Хабаровск' => '4660011512037'
    ];
    
    private $log_file;
    
    /**
     * Конструктор
     */
    public function __construct($config = []) {
        $this->base_path = $config['base_path'] ?? dirname(__DIR__);
        
        $this->incoming_path = $this->base_path . '/to_etm';
        
        $this->archive_path = $this->base_path . '/to_etm/recd';
        
        $this->output_path = __DIR__ . '/converted';
        
        $this->log_file = __DIR__ . '/edi_converter.log';
        
        if (!empty($config['incoming_path'])) {
            $this->incoming_path = $config['incoming_path'];
        }
        if (!empty($config['archive_path'])) {
            $this->archive_path = $config['archive_path'];
        }
        if (!empty($config['output_path'])) {
            $this->output_path = $config['output_path'];
        }
        if (!empty($config['log_file'])) {
            $this->log_file = $config['log_file'];
        }
        
        $this->ensureDirectories();
        
        date_default_timezone_set('Europe/Moscow');
    }
    
    /**
     * Создание необходимых директорий
     */
    private function ensureDirectories() {
        $dirs = [
            $this->incoming_path,
            $this->archive_path,
            $this->output_path
        ];
        
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
        
        if (!is_dir($this->incoming_path)) {
            $this->log("ОШИБКА: Директория {$this->incoming_path} не найдена");
            return false;
        }
        
        $files = scandir($this->incoming_path);
        
        if (!$files) {
            $this->log("Ошибка чтения директории {$this->incoming_path}");
            return false;
        }
        
        $processed = 0;
        
        foreach ($files as $file) {
            if ($file == '.' || $file == '..' || $file == 'recd') {
                continue;
            }
            
            $full_path = $this->incoming_path . '/' . $file;
            
            if (is_dir($full_path)) {
                continue;
            }
            
            $this->log("Обработка файла: {$file}");
            
            $result = $this->processFile($full_path, $file);
            
            if ($result) {
                $this->archiveFile($full_path, $file);
                $processed++;
            } else {
                $this->log("Ошибка обработки файла: {$file}");
            }
        }
        
        $this->log("Обработано файлов: {$processed}");
        $this->log("=== Завершение обработки EDI сообщений ===");
        
        return true;
    }
    
    /**
     * Обработка файла в зависимости от типа сообщения
     */
    private function processFile($file_path, $file_name) {
        $content = file_get_contents($file_path);
        
        if (empty($content)) {
            $this->log("Файл пустой: {$file_name}");
            return false;
        }
        
        $content = mb_convert_encoding($content, 'UTF-8', $this->encoding);
        
        $message_type = $this->detectMessageType($content);
        $this->log("Тип сообщения: {$message_type}");
        
        switch ($message_type) {
            case 'ORDER':
                return $this->processOrder($content, $file_name);
            case 'ORDERSP':
                return $this->processOrderResponse($content, $file_name);
            case 'INVOIC':
                return $this->processInvoic($content, $file_name);
            case 'INVRPT':
                return $this->processInventory($content, $file_name);
            case 'PRODAT':
                return $this->processProductData($content, $file_name);
            case 'PROJECT':
                return $this->processProject($content, $file_name);
            case 'PROJSTA':
                return $this->processProjectStatus($content, $file_name);
            case 'PROJQUO':
                return $this->processProjectQuotation($content, $file_name);
            default:
                $this->log("Неизвестный тип сообщения: {$file_name}");
                return false;
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
            
            if (strpos($line, 'MSGTYPE:ORDERSP') !== false) {
                return 'ORDERSP';
            }
            if (strpos($line, 'MSGTYPE:PROJSTA') !== false) {
                return 'PROJSTA';
            }
            if (strpos($line, 'MSGTYPE:PROJQUO') !== false) {
                return 'PROJQUO';
            }
            
            if (strpos($line, 'Артикул;Наименование;Количество;Цена') !== false) {
                return 'INVOIC';
            }
            
            if (strpos($line, 'Продавец:') !== false) {
                return 'INVOIC';
            }
            
            if (strpos($line, 'Режим:ОписаниеТоваров') !== false) {
                return 'PRODAT';
            }
            
            if (strpos($line, 'Код проекта') !== false && 
                strpos($line, 'Название проекта') !== false) {
                return 'PROJECT';
            }
            
            if (preg_match('/^(ЭТМ,|Дата:|Номер:|Примечание:)/', $line)) {
                return 'ORDER';
            }
            
            if (strpos($line, 'Название;Производитель;Артикул') !== false ||
                strpos($line, 'NameRgd;CodeMnf;Article') !== false) {
                return 'INVRPT';
            }
        }
        
        return 'UNKNOWN';
    }
    
    /**
     * Обработка заявки ORDER
     */
    private function processOrder($content, $file_name) {
        $this->log("Обработка заявки ORDER: {$file_name}");
        
        $lines = explode("\n", $content);
        $order = [
            'type' => 'ORDER',
            'file_name' => $file_name,
            'processed_at' => date('Y-m-d H:i:s'),
            'header' => [],
            'items' => []
        ];
        
        $in_header = true;
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            if ($in_header) {
                if (strpos($line, ':') !== false) {
                    list($key, $value) = explode(':', $line, 2);
                    $order['header'][trim($key)] = trim($value);
                } elseif (preg_match('/^(ЭТМ,)/', $line)) {
                    $order['header']['warehouse'] = $line;
                    if (isset($this->warehouses[$line])) {
                        $order['header']['warehouse_gln'] = $this->warehouses[$line];
                    }
                } else {
                    $in_header = false;
                    $order['items'][] = $this->parseOrderItem($line);
                }
            } else {
                $order['items'][] = $this->parseOrderItem($line);
            }
        }
        
        $errors = $this->validateOrder($order);
        if (!empty($errors)) {
            $this->log("Ошибки валидации ORDER:");
            foreach ($errors as $error) {
                $this->log("  - {$error}");
            }
            $order['validation_errors'] = $errors;
        }
        
        return $this->saveConvertedFile($order, 'ORDER', $file_name);
    }
    
    /**
     * Парсинг строки позиции заказа
     */
    private function parseOrderItem($line) {
        $fields = explode($this->delimiter, $line);
        
        return [
            'name' => $fields[0] ?? '',
            'article' => $fields[1] ?? '',
            'unit' => $fields[2] ?? '',
            'quantity' => $fields[3] ?? '',
            'doc_type' => $fields[4] ?? '',
            'project_code' => $fields[5] ?? '',
            'package_capacity' => $fields[6] ?? '',
            'basis' => $fields[7] ?? ''
        ];
    }
    
    /**
     * Валидация заявки ORDER
     */
    private function validateOrder($order) {
        $errors = [];
        
        if (empty($order['header']['warehouse'])) {
            $errors[] = "Отсутствует идентификатор склада";
        } elseif (!array_key_exists($order['header']['warehouse'], $this->warehouses)) {
            $errors[] = "Неизвестный идентификатор склада: {$order['header']['warehouse']}";
        }
        
        if (empty($order['header']['Дата'])) {
            $errors[] = "Отсутствует дата заявки";
        }
        
        if (empty($order['header']['Номер'])) {
            $errors[] = "Отсутствует номер документа";
        }
        
        if (empty($order['items'])) {
            $errors[] = "Отсутствуют позиции заказа";
        }
        
        foreach ($order['items'] as $index => $item) {
            $item_num = $index + 1;
            
            if (empty($item['name'])) {
                $errors[] = "Позиция {$item_num}: отсутствует наименование";
            }
            
            if (empty($item['article'])) {
                $errors[] = "Позиция {$item_num}: отсутствует артикул";
            }
            
            if (empty($item['quantity'])) {
                $errors[] = "Позиция {$item_num}: отсутствует количество";
            }
        }
        
        return $errors;
    }
    
    /**
     * Обработка подтверждения заказа ORDERSP
     */
    private function processOrderResponse($content, $file_name) {
        $this->log("Обработка ORDERSP: {$file_name}");
        
        $lines = explode("\n", $content);
        $responses = [];
        $headers = [];
        
        if (!empty($lines[0])) {
            $headers = explode($this->delimiter, trim($lines[0]));
        }
        
        for ($i = 1; $i < count($lines); $i++) {
            $line = trim($lines[$i]);
            if (empty($line)) continue;
            if (strpos($line, 'MSGTYPE:') !== false) continue;
            
            $fields = explode($this->delimiter, $line);
            $response = [];
            
            foreach ($headers as $index => $header) {
                $response[$header] = $fields[$index] ?? '';
            }
            
            $responses[] = $response;
        }
        
        $this->log("Обработано ответов: " . count($responses));
        
        return $this->saveConvertedFile([
            'type' => 'ORDERSP',
            'file_name' => $file_name,
            'processed_at' => date('Y-m-d H:i:s'),
            'count' => count($responses),
            'responses' => $responses
        ], 'ORDERSP', $file_name);
    }
    
    /**
     * Обработка уведомления об отгрузке INVOIC
     */
    private function processInvoic($content, $file_name) {
        $this->log("Обработка INVOIC: {$file_name}");
        
        $lines = explode("\n", $content);
        $invoic = [
            'type' => 'INVOIC',
            'file_name' => $file_name,
            'processed_at' => date('Y-m-d H:i:s'),
            'header' => [],
            'items' => []
        ];
        
        $in_header = true;
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            if ($in_header) {
                if (strpos($line, 'Продавец:') !== false) {
                    list(, $value) = explode(':', $line, 2);
                    $invoic['header']['seller'] = trim($value);
                } elseif (strpos($line, 'Грузополучатель:') !== false) {
                    list(, $value) = explode(':', $line, 2);
                    $invoic['header']['recipient'] = trim($value);
                } elseif (strpos($line, 'Номер:') !== false) {
                    list(, $value) = explode(':', $line, 2);
                    $invoic['header']['number'] = trim($value);
                } elseif (strpos($line, 'Дата:') !== false) {
                    list(, $value) = explode(':', $line, 2);
                    $invoic['header']['date'] = trim($value);
                } elseif (strpos($line, 'Артикул;Наименование;Количество;Цена') !== false) {
                    $in_header = false;
                } else {
                    $fields = explode($this->delimiter, $line);
                    if (count($fields) >= 4) {
                        $in_header = false;
                        $invoic['items'][] = $this->parseInvoicItem($fields);
                    }
                }
            } else {
                $fields = explode($this->delimiter, $line);
                if (count($fields) >= 4) {
                    $invoic['items'][] = $this->parseInvoicItem($fields);
                }
            }
        }
        
        return $this->saveConvertedFile($invoic, 'INVOIC', $file_name);
    }
    
    /**
     * Парсинг строки INVOIC
     */
    private function parseInvoicItem($fields) {
        return [
            'article' => $fields[0] ?? '',
            'name' => $fields[1] ?? '',
            'quantity' => $fields[2] ?? '',
            'price' => $fields[3] ?? '',
            'gtd' => $fields[4] ?? '',
            'order' => $fields[5] ?? '',
            'internal_number' => $fields[6] ?? ''
        ];
    }
    
    /**
     * Обработка номенклатуры INVRPT
     */
    private function processInventory($content, $file_name) {
        $this->log("Обработка INVRPT: {$file_name}");
        
        $lines = explode("\n", $content);
        $inventory = [];
        $headers = [];
        
        if (!empty($lines[0])) {
            $headers = explode($this->delimiter, trim($lines[0]));
        }
        
        for ($i = 1; $i < count($lines); $i++) {
            $line = trim($lines[$i]);
            if (empty($line)) continue;
            
            $fields = explode($this->delimiter, $line);
            $item = [];
            
            foreach ($headers as $index => $header) {
                $item[$header] = $fields[$index] ?? '';
            }
            
            $inventory[] = $item;
        }
        
        return $this->saveConvertedFile([
            'type' => 'INVRPT',
            'file_name' => $file_name,
            'processed_at' => date('Y-m-d H:i:s'),
            'count' => count($inventory),
            'items' => $inventory
        ], 'INVRPT', $file_name);
    }
    
    /**
     * Обработка данных о продукции PRODAT
     */
    private function processProductData($content, $file_name) {
        $this->log("Обработка PRODAT: {$file_name}");
        
        $lines = explode("\n", $content);
        $products = [];
        $headers = [];
        
        if (!empty($lines[0])) {
            $headers = explode($this->delimiter, trim($lines[0]));
        }
        
        $start_line = 2;
        
        for ($i = $start_line; $i < count($lines); $i++) {
            $line = trim($lines[$i]);
            if (empty($line)) continue;
            if (strpos($line, 'Режим:') === 0) continue;
            
            $fields = explode($this->delimiter, $line);
            $product = [];
            
            foreach ($headers as $index => $header) {
                $product[$header] = $fields[$index] ?? '';
            }
            
            $products[] = $product;
        }
        
        $this->log("Обработано товаров PRODAT: " . count($products));
        
        return $this->saveConvertedFile([
            'type' => 'PRODAT',
            'file_name' => $file_name,
            'processed_at' => date('Y-m-d H:i:s'),
            'count' => count($products),
            'products' => $products
        ], 'PRODAT', $file_name);
    }
    
    /**
     * Обработка данных о проектах PROJECT
     */
    private function processProject($content, $file_name) {
        $this->log("Обработка PROJECT: {$file_name}");
        
        $lines = explode("\n", $content);
        $projects = [];
        $headers = [];
        
        if (!empty($lines[0])) {
            $headers = explode($this->delimiter, trim($lines[0]));
        }
        
        for ($i = 1; $i < count($lines); $i++) {
            $line = trim($lines[$i]);
            if (empty($line)) continue;
            
            $fields = explode($this->delimiter, $line);
            $project = [];
            
            foreach ($headers as $index => $header) {
                $project[$header] = $fields[$index] ?? '';
            }
            
            $projects[] = $project;
        }
        
        return $this->saveConvertedFile([
            'type' => 'PROJECT',
            'file_name' => $file_name,
            'processed_at' => date('Y-m-d H:i:s'),
            'count' => count($projects),
            'projects' => $projects
        ], 'PROJECT', $file_name);
    }
    
    /**
     * Обработка статусов проектов PROJSTA
     */
    private function processProjectStatus($content, $file_name) {
        $this->log("Обработка PROJSTA: {$file_name}");
        
        $lines = explode("\n", $content);
        $statuses = [];
        $headers = [];
        
        if (!empty($lines[0])) {
            $headers = explode($this->delimiter, trim($lines[0]));
        }
        
        for ($i = 1; $i < count($lines); $i++) {
            $line = trim($lines[$i]);
            if (empty($line)) continue;
            if (strpos($line, 'MSGTYPE:') !== false) continue;
            
            $fields = explode($this->delimiter, $line);
            $status = [];
            
            foreach ($headers as $index => $header) {
                $status[$header] = $fields[$index] ?? '';
            }
            
            $statuses[] = $status;
        }
        
        return $this->saveConvertedFile([
            'type' => 'PROJSTA',
            'file_name' => $file_name,
            'processed_at' => date('Y-m-d H:i:s'),
            'count' => count($statuses),
            'statuses' => $statuses
        ], 'PROJSTA', $file_name);
    }
    
    /**
     * Обработка спеццен по проектам PROJQUO
     */
    private function processProjectQuotation($content, $file_name) {
        $this->log("Обработка PROJQUO: {$file_name}");
        
        $lines = explode("\n", $content);
        $quotations = [];
        $headers = [];
        
        if (!empty($lines[0])) {
            $headers = explode($this->delimiter, trim($lines[0]));
        }
        
        for ($i = 1; $i < count($lines); $i++) {
            $line = trim($lines[$i]);
            if (empty($line)) continue;
            if (strpos($line, 'MSGTYPE:') !== false) continue;
            
            $fields = explode($this->delimiter, $line);
            $quotation = [];
            
            foreach ($headers as $index => $header) {
                $quotation[$header] = $fields[$index] ?? '';
            }
            
            $quotations[] = $quotation;
        }
        
        return $this->saveConvertedFile([
            'type' => 'PROJQUO',
            'file_name' => $file_name,
            'processed_at' => date('Y-m-d H:i:s'),
            'count' => count($quotations),
            'quotations' => $quotations
        ], 'PROJQUO', $file_name);
    }
    
    /**
     * Архивирование обработанного файла
     */
    private function archiveFile($file_path, $file_name) {
        $archive_file = $this->archive_path . '/' . date('Ymd_His_') . '_' . $file_name;
        
        if (rename($file_path, $archive_file)) {
            $this->log("Файл {$file_name} перемещен в архив: " . basename($archive_file));
            return true;
        } else {
            if (copy($file_path, $archive_file)) {
                unlink($file_path);
                $this->log("Файл {$file_name} скопирован в архив");
                return true;
            }
            $this->log("Ошибка архивирования файла {$file_name}");
            return false;
        }
    }
    
    /**
     * Сохранение конвертированного файла
     */
    private function saveConvertedFile($data, $type, $original_name) {
        $output_file = $this->output_path . '/' . date('Ymd_His_') . "_{$type}_" . $original_name . '.json';
        
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        
        if (file_put_contents($output_file, $json_data)) {
            $this->log("Конвертированный файл сохранен: " . basename($output_file));
            return true;
        }
        
        $this->log("Ошибка сохранения файла: {$output_file}");
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
}