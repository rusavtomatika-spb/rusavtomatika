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
    
    private $stock_data = null;
    
    private $api_url = 'https://public.ark-sol.ru/upp_kf/hs/OtherStructures/ExtStructure/RA_Ostatkii';
    private $api_login = 'HTTPSite';
    private $api_password = 'Ms8dVyxgdRcts7rBt7s';
    
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
        
        if (!empty($config['api_url'])) $this->api_url = $config['api_url'];
        if (!empty($config['api_login'])) $this->api_login = $config['api_login'];
        if (!empty($config['api_password'])) $this->api_password = $config['api_password'];
        
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
     * Загрузка данных из API 1С
     */
    private function loadStockData() {
        if ($this->stock_data !== null) {
            return $this->stock_data;
        }
        
        $this->log("Загрузка данных из API 1С: {$this->api_url}");
        
        $json = $this->fetchFromApi();
        
        if ($json === false) {
            $this->log("ОШИБКА: Не удалось загрузить данные из API 1С");
            $this->stock_data = array();
            return $this->stock_data;
        }
        
        $this->log("ДИАГНОСТИКА: Первые 500 байт ответа API:");
        $this->log(substr($json, 0, 500));
        
        $data = json_decode($json, true);
        
        if (!is_array($data)) {
            $this->log("ОШИБКА: Некорректный JSON от API 1С");
            $this->log("ОШИБКА json_decode: " . json_last_error_msg());
            $this->stock_data = array();
            return $this->stock_data;
        }
        
        $this->log("Получено записей из API: " . count($data));
        
        if (count($data) > 0) {
            $this->log("ДИАГНОСТИКА: Ключи первого элемента: " . implode(', ', array_keys($data[0])));
            $this->log("ДИАГНОСТИКА: Первый элемент: " . json_encode($data[0], JSON_UNESCAPED_UNICODE));
        }
        
        $stock = array();
        
        foreach ($data as $index => $item) {
            $article_raw = '';
            if (isset($item['Артикул'])) {
                $article_raw = trim($item['Артикул']);
            } elseif (isset($item['артикул'])) {
                $article_raw = trim($item['артикул']);
            } elseif (isset($item['Articul'])) {
                $article_raw = trim($item['Articul']);
            } elseif (isset($item['articul'])) {
                $article_raw = trim($item['articul']);
            }
            
            if ($index < 5) {
                $this->log("ДИАГНОСТИКА запись #{$index}: ключи=" . implode(',', array_keys($item)) . " | article_raw='{$article_raw}'");
            }
            
            if (empty($article_raw)) {
                $nomenclature = isset($item['Номенклатура']) ? $item['Номенклатура'] : (isset($item['Nomenklatura']) ? $item['Nomenklatura'] : 'неизвестно');
                $this->log("ПРОПУЩЕНО (пустой Артикул): {$nomenclature}");
                continue;
            }
            
            $article_key = mb_strtolower($article_raw, 'UTF-8');
            
            $quantity = floatval(isset($item['Остаток']) ? $item['Остаток'] : (isset($item['остаток']) ? $item['остаток'] : 0));
            $price = floatval(isset($item['Цена']) ? $item['Цена'] : (isset($item['цена']) ? $item['цена'] : 0));
            $gtd = '';
            if (isset($item['НомерГТД'])) $gtd = trim($item['НомерГТД']);
            elseif (isset($item['номерГТД'])) $gtd = trim($item['номерГТД']);
            
            $name = '';
            if (isset($item['НаименованиеПолное'])) $name = trim($item['НаименованиеПолное']);
            elseif (isset($item['наименованиеПолное'])) $name = trim($item['наименованиеПолное']);
            
            $nomenclature = '';
            if (isset($item['Номенклатура'])) $nomenclature = trim($item['Номенклатура']);
            elseif (isset($item['номенклатура'])) $nomenclature = trim($item['номенклатура']);
            
            if (isset($stock[$article_key])) {
                $stock[$article_key]['quantity'] += $quantity;
                if (!empty($gtd)) {
                    $stock[$article_key]['gtd'] = $gtd;
                }
                if ($price > 0) {
                    $stock[$article_key]['price'] = $price;
                }
                $this->log("Суммирование: {$article_raw} +{$quantity}, всего: {$stock[$article_key]['quantity']}");
            } else {
                $stock[$article_key] = array(
                    'article_original' => $article_raw,
                    'article_key' => $article_key,
                    'name' => !empty($name) ? $name : $nomenclature,
                    'nomenclature' => $nomenclature,
                    'quantity' => $quantity,
                    'gtd' => $gtd,
                    'price' => $price
                );
            }
        }
        
        $this->log("Уникальных товаров после группировки: " . count($stock));
        $this->stock_data = $stock;
        
        return $this->stock_data;
    }
    
    /**
     * HTTP-запрос к API 1С
     */
    private function fetchFromApi() {
        $ch = curl_init();
        
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->api_login . ':' . $this->api_password,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json; charset=utf-8'
            )
        ));
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($error) {
            $this->log("ОШИБКА curl: {$error}");
            return false;
        }
        
        if ($http_code !== 200) {
            $this->log("ОШИБКА HTTP: код {$http_code}");
            $this->log("Ответ: " . substr($response, 0, 500));
            return false;
        }
        
        $this->log("API ответил успешно, код 200, длина ответа: " . strlen($response) . " байт");
        
        return $response;
    }
    
    /**
     * Получить данные товара из кэша API по артикулу
     */
    private function getStockItem($article) {
        $stock = $this->loadStockData();
        
        if (empty($stock)) return null;
        
        $article_lower = mb_strtolower(trim($article), 'UTF-8');
        
        if (isset($stock[$article_lower])) {
            $this->log("Товар найден в API: {$article} (остаток: {$stock[$article_lower]['quantity']}, цена: {$stock[$article_lower]['price']})");
            return $stock[$article_lower];
        }
        
        $this->log("Товар НЕ найден в API: {$article} (искали: '{$article_lower}')");
        return null;
    }
    
    /**
     * Директории
     */
    private function ensureDirectories() {
        $dirs = array($this->incoming_path, $this->archive_path, $this->output_path, $this->output_path . '/recd');
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) { mkdir($dir, 0755, true); $this->log("Создана директория: {$dir}"); }
        }
    }
    
    /**
     * Основной метод обработки
     */
    public function process() {
        $this->log("=== Начало обработки EDI сообщений ===");
        $this->log("Base path: {$this->base_path}");
        
        $this->loadStockData();
        
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
     * Определение типа файла
     */
    private function processFile($file_path, $file_name) {
        $content = file_get_contents($file_path);
        if (empty($content)) return false;
        
        if (strpos($content, '<?xml') !== false || strpos($content, '<КоммерческаяИнформация>') !== false) {
            $this->log("Обнаружен XML-файл");
            return $this->processInvoicXml($content, $file_name);
        }
        
        $detected = mb_detect_encoding($content, array('Windows-1251', 'UTF-8', 'CP1251'), true);
        if ($detected === 'Windows-1251' || $detected === 'CP1251') {
            $content = mb_convert_encoding($content, 'UTF-8', 'Windows-1251');
        }
        
        $message_type = $this->detectMessageType($content);
        $this->log("Тип сообщения: {$message_type}");
        
        switch ($message_type) {
            case 'ORDER_SPEC_PROJECT': return $this->processOrderSpecProject($content, $file_name);
            case 'ORDER':              return $this->processOrder($content, $file_name);
            case 'ORDERSP':            return $this->processTransit($content, $file_name, 'ORDERSP');
            case 'INVOIC':             return $this->processTransit($content, $file_name, 'INVOIC');
            case 'INVRPT':             return $this->processTransit($content, $file_name, 'INVRPT');
            case 'PRODAT':             return $this->processTransit($content, $file_name, 'PRODAT');
            case 'PROJECT':            return $this->processTransit($content, $file_name, 'PROJECT');
            case 'PROJSTA':            return $this->processTransit($content, $file_name, 'PROJSTA');
            case 'PROJQUO':            return $this->processTransit($content, $file_name, 'PROJQUO');
            default: $this->log("Неизвестный тип: {$file_name}"); return false;
        }
    }
    
    /**
     * Определение типа EDI сообщения
     */
    private function detectMessageType($content) {
        $lines = explode("\n", $content);
        $hasProjectHeader = false;
        $hasOrderHeader = false;
        
        foreach ($lines as $line) {
            $line = rtrim(trim($line), ';');
            
            if (empty($line)) continue;

            if (strpos($line, 'MSGTYPE:ORDERSP') !== false) return 'ORDERSP';
            if (strpos($line, 'MSGTYPE:PROJSTA') !== false) return 'PROJSTA';
            if (strpos($line, 'MSGTYPE:PROJQUO') !== false) return 'PROJQUO';
            
            if (strpos($line, 'Артикул;Наименование;Количество;Цена') !== false) return 'INVOIC';
            if (strpos($line, 'Продавец:') !== false) return 'INVOIC';
            
            if (strpos($line, 'Режим:ОписаниеТоваров') !== false) return 'PRODAT';
            
            if (strpos($line, 'Код проекта') !== false && strpos($line, 'Название проекта') !== false) {
                $hasProjectHeader = true;
            }
            
            if (preg_match('/^(ЭТМ,|Дата:|Номер:|Примечание:)/u', $line)) {
                $hasOrderHeader = true;
            }
            
            if (strpos($line, 'Название;Производитель;Артикул') !== false || strpos($line, 'NameRgd;CodeMnf;Article') !== false) {
                return 'INVRPT';
            }
        }
        
        if ($hasProjectHeader && $hasOrderHeader) return 'ORDER_SPEC_PROJECT';
        if ($hasOrderHeader) return 'ORDER';
        if ($hasProjectHeader) return 'PROJECT';
        
        return 'UNKNOWN';
    }
    
    /**
     * Обработка заявки ORDER
     */
    private function processOrder($content, $file_name) {
        $this->log("Обработка заявки ORDER: {$file_name}");
        
        $parsed = $this->parseOrderContent($content);
        return $this->buildOrdersp($parsed, $file_name);
    }
    
    /**
     * Обработка заявки ORDER спецусловия + проект
     */
    private function processOrderSpecProject($content, $file_name) {
        $this->log("Обработка ORDER (спецусловия + проект): {$file_name}");
        
        $lines = explode("\n", $content);
        
        $project_lines = array();
        $order_lines = array();
        $found_order = false;
        
        foreach ($lines as $line) {
            $line_clean = rtrim(trim($line), ';');
            
            if (!$found_order && preg_match('/^(ЭТМ,)/u', $line_clean)) {
                $found_order = true;
            }
            
            if ($found_order) {
                $order_lines[] = $line;
            } else {
                $project_lines[] = $line;
            }
        }
        
        $order_content = implode("\n", $order_lines);
        $parsed = $this->parseOrderContent($order_content);
        
        $parsed['has_project'] = true;
        
        return $this->buildOrdersp($parsed, $file_name);
    }
    
    /**
     * Парсинг содержимого ORDER
     */
    private function parseOrderContent($content) {
        $lines = explode("\n", $content);
        $header = array();
        $items = array();
        $in_header = true;
        
        foreach ($lines as $line) {
            $line = rtrim(trim($line), ';');
            if (empty($line)) continue;
            
            if ($in_header) {
                if (strpos($line, ':') !== false) {
                    list($key, $value) = explode(':', $line, 2);
                    $header[trim($key)] = trim($value);
                } elseif (preg_match('/^(ЭТМ,)/u', $line)) {
                    $header['warehouse'] = rtrim($line, ',');
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
        
        return array(
            'header' => $header,
            'items' => $items,
            'doc_type' => $doc_type
        );
    }
    
    /**
     * Построение ORDERSP ответа
     */
    private function buildOrdersp($parsed, $file_name) {
        $header = $parsed['header'];
        $items = $parsed['items'];
        $doc_type = $parsed['doc_type'];
        
        $order_number = isset($header['Номер']) ? $header['Номер'] : '';
        $warehouse_raw = isset($header['warehouse']) ? $header['warehouse'] : '';
        $warehouse = rtrim(trim($warehouse_raw), ';');
        
        $valid_warehouses = array(
            'ЭТМ,СПб', 'ЭТМ,Москва', 'ЭТМ,Урал', 'ЭТМ,Самара', 'ЭТМ,Юг',
            'ЭТМ,Сибирь', 'ЭТМ,Казань', 'ЭТМ,МЯ', 'ЭТМ,ЦРС', 'ЭТМ,Шушары',
            'ЭТМ,Челябинск', 'ЭТМ,Н.Новгород', 'ЭТМ,Воронеж', 'ЭТМ,Воронеж2',
            'ЭТМ,Краснодар', 'ЭТМ,Владивосток', 'ЭТМ,Хабаровск'
        );
        
        if (!empty($warehouse) && !in_array($warehouse, $valid_warehouses)) {
            $this->log("ПРЕДУПРЕЖДЕНИЕ: Склад '{$warehouse}' не найден в справочнике");
        }
        
        $order_number = str_replace(';', ',', $order_number);
        
        $csv_rows = array();
        
        if ($doc_type === 'спецусловия') {
            $csv_rows[] = "Номер заявки;Дата поставки;Название;Артикул;Количество товара;Идентификатор покупателя;Идентификатор документа;Тип подтверждения;Цена;Период действия;Размер предоплаты;Отсрочка дней;Цена Клиента;MSGTYPE:ORDERSP";
            
            foreach ($items as $item) {
                $name = isset($item['name']) ? $item['name'] : '';
                $article = isset($item['article']) ? $item['article'] : '';
                $quantity = isset($item['quantity']) ? $item['quantity'] : '';
                $basis = isset($item['basis']) ? $item['basis'] : '';
                
                $name = str_replace(';', ',', $name);
                $article = str_replace(';', '', $article);
                $quantity = str_replace(';', '', $quantity);
                $basis = str_replace(';', '', $basis);
                
                $stock_item = $this->getStockItem($article);
                
                if ($stock_item) {
                    $price_rub = $stock_item['price'];
                    if (empty($name) && !empty($stock_item['name'])) {
                        $name = $stock_item['name'];
                    }
                } else {
                    $this->log("Товар {$article} отсутствует в API 1С — цена не определена");
                    $price_rub = '';
                }
                
                $row = array(
                    $order_number, '', $name, $article, $quantity,
                    $warehouse, $basis, 'Принят', $price_rub,
                    '', '', '', $price_rub
                );
                $csv_rows[] = implode($this->delimiter, $row);
            }
        }
        else {
            $csv_rows[] = "Номер заявки;Дата поставки;Название;Артикул;Количество товара;Идентификатор покупателя;Тип подтверждения;MSGTYPE:ORDERSP";
            
            foreach ($items as $item) {
                $name = isset($item['name']) ? $item['name'] : '';
                $article = isset($item['article']) ? $item['article'] : '';
                $quantity = isset($item['quantity']) ? $item['quantity'] : '';
                
                $name = str_replace(';', ',', $name);
                $article = str_replace(';', '', $article);
                $quantity = str_replace(';', '', $quantity);
                
                $stock_item = $this->getStockItem($article);
                
                if ($stock_item) {
                    if (empty($name) && !empty($stock_item['name'])) {
                        $name = $stock_item['name'];
                    }
                    
                    $requested_qty = floatval($quantity);
                    $available_qty = $stock_item['quantity'];
                    
                    if ($available_qty >= $requested_qty) {
                        $stock_status = 'Принято без изменений';
                    } elseif ($available_qty > 0) {
                        $stock_status = 'Изменение';
                    } else {
                        $stock_status = 'Получено';
                    }
                    
                    $this->log("Товар {$article}: запрошено={$requested_qty}, остаток={$available_qty}, статус={$stock_status}");
                } else {
                    $this->log("Товар {$article} отсутствует в API 1С — статус: Не принят");
                    $stock_status = 'Не принят';
                }
                
                $row = array($order_number, '', $name, $article, $quantity, $warehouse, $stock_status);
                $csv_rows[] = implode($this->delimiter, $row);
            }
        }
        
        return $this->saveCsvFile($csv_rows, 'ORDERSP', $file_name);
    }
    
    /**
     * Парсинг строки позиции заказа
     */
    private function parseOrderItem($line) {
        $line = rtrim($line, ';');
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
     * Обработка XML INVOIC
     */
    private function processInvoicXml($content, $file_name) {
        $this->log("Обработка INVOIC XML: {$file_name}");
        
        $xml = simplexml_load_string($content);
        if (!$xml) {
            $this->log("ОШИБКА парсинга XML");
            return false;
        }
        
        $csv_rows = array();
        
        $doc = $xml->Документ;
        $number = (string)$doc->Номер;
        $date = (string)$doc->Дата;
        $recipient = (string)$doc->Грузополучатель;
        
        $seller = '';
        foreach ($doc->Контрагенты->Контрагент as $kontr) {
            if ((string)$kontr->Роль === 'Продавец') {
                $seller = (string)$kontr->Наименование;
            }
        }
        
        $csv_rows[] = "Артикул;Наименование;Количество;Цена за ед.;Номер;Дата;Грузополучатель;Продавец";
        
        foreach ($doc->Товары->Товар as $tovar) {
            $row = array(
                (string)$tovar->Артикул,
                (string)$tovar->Наименование,
                (string)$tovar->Количество,
                (string)$tovar->ЦенаЗаЕдиницу,
                $number,
                date('d.m.Y', strtotime($date)),
                $recipient,
                $seller
            );
            $csv_rows[] = implode($this->delimiter, $row);
        }
        
        return $this->saveCsvFile($csv_rows, 'INVOIC', $file_name);
    }
    
    /**
     * Транзит
     */
    private function processTransit($content, $file_name, $type) {
        $this->log("Обработка {$type} (транзит): {$file_name}");
        $lines = explode("\n", $content);
        $csv_rows = array();
        foreach ($lines as $line) {
            $line = rtrim(trim($line), ';');
            if (empty($line)) continue;
            $csv_rows[] = $line;
        }
        return $this->saveCsvFile($csv_rows, $type, $file_name);
    }
    
    /**
     * Сохранение в архив для ЭТМ
     */
    private function archiveFile($file_path, $file_name) {
        $archive_file = $this->archive_path . '/' . date('d-m-Y__H-i-s_') . '_' . $file_name;
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
        $safe_name = preg_replace('/\.(csv|xml|txt)$/i', '', $safe_name);
        $output_file = $this->output_path . '/' . date('d-m-Y__H-i-s_') . "_{$type}_" . $safe_name . '.csv';
        
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
        $timestamp = date('d-m-Y H:i:s');
        $log_message = "[{$timestamp}] {$message}\n";
        echo $log_message;
        file_put_contents($this->log_file, $log_message, FILE_APPEND);
    }
    
    public function __destruct() {
        if ($this->mysqli) $this->mysqli->close();
    }
}