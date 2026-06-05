<?php

class ETMConverter {
    
    private $base_path;
    private $incoming_path;
    private $archive_path;
    private $output_path;
    
    private $encoding = 'Windows-1251';
    private $delimiter = ';';
    
    private $warehouses = array(
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
    );
    
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
        $dirs = array(
            $this->incoming_path,
            $this->archive_path,
            $this->output_path,
            $this->output_path . '/recd'
        );
        
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                $result = mkdir($dir, 0755, true);
                if ($result) {
                    $this->log("Создана директория: {$dir}");
                } else {
                    $this->log("ОШИБКА создания директории: {$dir}");
                }
            }
        }
    }
    
    /**
     * Основной метод обработки
     */
    public function process() {
        $this->log("=== Начало обработки EDI сообщений ===");
        $this->log("Base path: {$this->base_path}");
        $this->log("Входящие: {$this->incoming_path}");
        $this->log("Архив: {$this->archive_path}");
        $this->log("Исходящие: {$this->output_path}");
        
        if (!is_dir($this->incoming_path)) {
            $this->log("ОШИБКА: Директория входящих не найдена: {$this->incoming_path}");
            $this->log("Текущая директория скрипта: " . __DIR__);
            return false;
        }
        
        $files = scandir($this->incoming_path);
        
        if (!$files) {
            $this->log("Нет файлов для обработки");
            return true;
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
                } elseif (preg_match('/^(ЭТМ,)/', $line)) {
                    $header['warehouse'] = $line;
                } else {
                    $in_header = false;
                    $items[] = $this->parseOrderItem($line);
                }
            } else {
                $items[] = $this->parseOrderItem($line);
            }
        }
        
        $csv_rows[] = "Номер заявки;Дата поставки;Название;Артикул;Количество товара;Идентификатор покупателя;Тип подтверждения;MSGTYPE:ORDERSP";
        
        $order_number = isset($header['Номер']) ? $header['Номер'] : '';
        $warehouse = isset($header['warehouse']) ? $header['warehouse'] : '';
        
        foreach ($items as $item) {
            $name = isset($item['name']) ? $item['name'] : '';
            $article = isset($item['article']) ? $item['article'] : '';
            $quantity = isset($item['quantity']) ? $item['quantity'] : '';
            
            $row = array(
                $order_number,
                '',
                $name,
                $article,
                $quantity,
                $warehouse,
                'Получено'
            );
            $csv_rows[] = implode($this->delimiter, $row);
        }
        
        return $this->saveCsvFile($csv_rows, 'ORDERSP', $file_name);
    }
    
    /**
     * Обработка подтверждения заказа ORDERSP (транзит)
     */
    private function processOrderResponse($content, $file_name) {
        $this->log("Обработка ORDERSP (транзит): {$file_name}");
        
        $lines = explode("\n", $content);
        $csv_rows = array();
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        
        return $this->saveCsvFile($csv_rows, 'ORDERSP', $file_name);
    }
    
    /**
     * Обработка INVOIC (транзит)
     */
    private function processInvoic($content, $file_name) {
        $this->log("Обработка INVOIC: {$file_name}");
        
        $lines = explode("\n", $content);
        $csv_rows = array();
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        
        return $this->saveCsvFile($csv_rows, 'INVOIC', $file_name);
    }
    
    /**
     * Обработка INVRPT (транзит)
     */
    private function processInventory($content, $file_name) {
        $this->log("Обработка INVRPT: {$file_name}");
        
        $lines = explode("\n", $content);
        $csv_rows = array();
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        
        return $this->saveCsvFile($csv_rows, 'INVRPT', $file_name);
    }
    
    /**
     * Обработка PRODAT (транзит)
     */
    private function processProductData($content, $file_name) {
        $this->log("Обработка PRODAT: {$file_name}");
        
        $lines = explode("\n", $content);
        $csv_rows = array();
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        
        return $this->saveCsvFile($csv_rows, 'PRODAT', $file_name);
    }
    
    /**
     * Обработка PROJECT (транзит)
     */
    private function processProject($content, $file_name) {
        $this->log("Обработка PROJECT: {$file_name}");
        
        $lines = explode("\n", $content);
        $csv_rows = array();
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        
        return $this->saveCsvFile($csv_rows, 'PROJECT', $file_name);
    }
    
    /**
     * Обработка PROJSTA (транзит)
     */
    private function processProjectStatus($content, $file_name) {
        $this->log("Обработка PROJSTA: {$file_name}");
        
        $lines = explode("\n", $content);
        $csv_rows = array();
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        
        return $this->saveCsvFile($csv_rows, 'PROJSTA', $file_name);
    }
    
    /**
     * Обработка PROJQUO (транзит)
     */
    private function processProjectQuotation($content, $file_name) {
        $this->log("Обработка PROJQUO: {$file_name}");
        
        $lines = explode("\n", $content);
        $csv_rows = array();
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        
        return $this->saveCsvFile($csv_rows, 'PROJQUO', $file_name);
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
            $this->log("Файл {$file_name} перемещен в архив: to_etm/recd/" . basename($archive_file));
            return true;
        } else {
            if (copy($file_path, $archive_file)) {
                unlink($file_path);
                $this->log("Файл {$file_name} скопирован в архив");
                return true;
            }
            $this->log("ОШИБКА архивирования файла {$file_name}");
            return false;
        }
    }
    
    /**
     * Сохранение CSV-файла в from_etm для ЭТМ
     */
    private function saveCsvFile($rows, $type, $original_name) {
        $safe_name = preg_replace('/[^a-zA-Z0-9._-]/', '_', $original_name);
        $output_file = $this->output_path . '/' . date('Ymd_His_') . "_{$type}_" . $safe_name;
        
        $ext = strtolower(pathinfo($output_file, PATHINFO_EXTENSION));
        if ($ext !== 'csv') {
            $output_file .= '.csv';
        }
        
        $content = implode("\n", $rows);
        $content = mb_convert_encoding($content, $this->encoding, 'UTF-8');
        
        if (file_put_contents($output_file, $content)) {
            $this->log("Файл для ЭТМ сохранен в from_etm: " . basename($output_file));
            return true;
        }
        
        $this->log("ОШИБКА сохранения файла: {$output_file}");
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