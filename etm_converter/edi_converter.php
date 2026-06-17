<?php

class ETMConverter {
    
    private $base_path;
    private $incoming_path;
    private $archive_path;
    private $output_path;
    
    private $encoding = 'Windows-1251';
    private $delimiter = ';';
    
    private $log_file;
    
    private $stock_data = null;
    private $price_data = null;
    
    private $api_url = 'https://public.ark-sol.ru/upp_kf/hs/OtherStructures/ExtStructure/RA_Ostatkii';
    private $api_login = 'HTTPSite';
    private $api_password = 'Ms8dVyxgdRcts7rBt7s';
    
    private $price_file = null;
    
    /**
     * Конструктор
     */
    public function __construct($config = array()) {
        if (isset($config['base_path'])) {
            $this->base_path = $config['base_path'];
        } else {
            $this->base_path = dirname(__DIR__);
        }
        
        $this->incoming_path = $this->base_path . '/etm/from_etm';
        $this->archive_path = $this->base_path . '/etm/from_etm/recd';
        $this->output_path = $this->base_path . '/etm/to_etm';
        $this->log_file = __DIR__ . '/edi_converter.log';
        
        $this->price_file = __DIR__ . '/docs/price.csv';
        
        if (!empty($config['incoming_path'])) $this->incoming_path = $config['incoming_path'];
        if (!empty($config['archive_path'])) $this->archive_path = $config['archive_path'];
        if (!empty($config['output_path'])) $this->output_path = $config['output_path'];
        if (!empty($config['log_file'])) $this->log_file = $config['log_file'];
        if (!empty($config['price_file'])) $this->price_file = $config['price_file'];
        
        if (!empty($config['api_url'])) $this->api_url = $config['api_url'];
        if (!empty($config['api_login'])) $this->api_login = $config['api_login'];
        if (!empty($config['api_password'])) $this->api_password = $config['api_password'];
        
        $this->ensureDirectories();
        date_default_timezone_set('Europe/Moscow');
    }
    
    /**
     * Загрузка цен из CSV
     */
    private function loadPriceData() {
        if ($this->price_data !== null) {
            return $this->price_data;
        }
        
        if (!file_exists($this->price_file)) {
            $this->log("ПРЕДУПРЕЖДЕНИЕ: Файл цен не найден: {$this->price_file}");
            $this->price_data = array();
            return $this->price_data;
        }
        
        $this->log("Загрузка цен из CSV: {$this->price_file}");
        
        $content = file_get_contents($this->price_file);
        if (empty($content)) {
            $this->log("ОШИБКА: Файл цен пуст");
            $this->price_data = array();
            return $this->price_data;
        }
        
        $detected = mb_detect_encoding($content, array('Windows-1251', 'UTF-8', 'CP1251'), true);
        if ($detected === 'Windows-1251' || $detected === 'CP1251') {
            $content = mb_convert_encoding($content, 'UTF-8', 'Windows-1251');
        }
        
        $lines = explode("\n", $content);
        
        $prices = array();
        $usd_rate = $this->getUsdRate();
        $header_found = false;
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            if (substr($line, 0, 1) === '"' && substr($line, -1) === '"') {
                $line = substr($line, 1, -1);
                $line = str_replace('""', '"', $line);
            }
            
            if (strpos($line, "\t") !== false) {
                $delim = "\t";
            } elseif (strpos($line, ";") !== false && substr_count($line, ';') >= 2) {
                $delim = ";";
            } else {
                $delim = ",";
            }
            
            $row = str_getcsv($line, $delim);
            
            if (!$header_found) {
                if (isset($row[0]) && mb_strtolower(trim($row[0])) === 'артикул') {
                    $header_found = true;
                }
                continue;
            }
            
            $article = isset($row[0]) ? trim($row[0]) : '';
            $price_usd = isset($row[1]) ? trim($row[1]) : '';
            $price_rub = isset($row[2]) ? trim($row[2]) : '';
            
            if (empty($article)) continue;
            
            $article_key = mb_strtolower($article, 'UTF-8');
            
            $final_price_rub = 0;
            
            $price_usd = trim($price_usd, '"\' ');
            $price_rub = trim($price_rub, '"\' ');
            
            if (!empty($price_rub) && is_numeric(str_replace(',', '.', $price_rub))) {
                $final_price_rub = floatval(str_replace(',', '.', $price_rub));
            } elseif (!empty($price_usd) && is_numeric(str_replace(',', '.', $price_usd)) && $usd_rate > 0) {
                $final_price_rub = round(floatval(str_replace(',', '.', $price_usd)) * $usd_rate, 2);
            } elseif (!empty($price_usd) && is_numeric(str_replace(',', '.', $price_usd))) {
                $this->log("ПРЕДУПРЕЖДЕНИЕ: Курс USD не загружен, цена {$article} не конвертирована");
                $final_price_rub = 0;
            }
            
            $prices[$article_key] = array(
                'article' => $article,
                'price_rub' => $final_price_rub,
                'price_usd' => !empty($price_usd) ? floatval(str_replace(',', '.', $price_usd)) : 0
            );
        }
        
        $this->log("Загружено цен из CSV: " . count($prices));
        $this->price_data = $prices;
        
        return $this->price_data;
    }
    
    /**
     * Получить цену товара из CSV
     */
    private function getPriceFromFile($article) {
        $prices = $this->loadPriceData();
        
        if (empty($prices)) return null;
        
        $article_lower = mb_strtolower(trim($article), 'UTF-8');
        
        if (isset($prices[$article_lower])) {
            return $prices[$article_lower]['price_rub'];
        }
        
        return null;
    }
    
    /**
     * Получить курс USD из файла
     */
    private function getUsdRate() {
        $rate_file = $this->base_path . '/usdrate.txt';
        if (file_exists($rate_file)) {
            $rate = floatval(file_get_contents($rate_file));
            if ($rate > 0) return $rate;
        }
        $rate_file = __DIR__ . '/docs/usdrate.txt';
        if (file_exists($rate_file)) {
            $rate = floatval(file_get_contents($rate_file));
            if ($rate > 0) return $rate;
        }
        return 0;
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
            $this->log("ОШИБКА: Не удалось загрузить данные из API");
            $this->stock_data = array();
            return $this->stock_data;
        }
        
        $data = json_decode($json, true);
        
        if (!is_array($data)) {
            $this->log("ОШИБКА: Некорректный JSON от API");
            $this->stock_data = array();
            return $this->stock_data;
        }
        
        $this->log("Получено записей: " . count($data));
        
        $stock = array();
        $skipped = 0;
        
        foreach ($data as $item) {
            $article_raw = isset($item['Артикул']) ? trim($item['Артикул']) : '';
            
            if (empty($article_raw)) {
                $skipped++;
                continue;
            }
            
            $article_key = mb_strtolower($article_raw, 'UTF-8');
            $quantity = floatval(isset($item['Остаток']) ? $item['Остаток'] : 0);
            $gtd = isset($item['НомерГТД']) ? trim($item['НомерГТД']) : '';
            $name = isset($item['НаименованиеПолное']) ? trim($item['НаименованиеПолное']) : '';
            $nomenclature = isset($item['Номенклатура']) ? trim($item['Номенклатура']) : '';
            
            if (isset($stock[$article_key])) {
                $stock[$article_key]['quantity'] += $quantity;
                if (!empty($gtd)) {
                    $stock[$article_key]['gtd'] = $gtd;
                }
            } else {
                $stock[$article_key] = array(
                    'article_original' => $article_raw,
                    'article_key' => $article_key,
                    'name' => !empty($name) ? $name : $nomenclature,
                    'quantity' => $quantity,
                    'gtd' => $gtd
                );
            }
        }
        
        if ($skipped > 0) {
            $this->log("Пропущено позиций без артикула: {$skipped}");
        }
        
        $this->log("Уникальных товаров: " . count($stock));
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
            return false;
        }
        
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
        $dirs = array(
            $this->incoming_path,
            $this->archive_path,
            $this->output_path,
            $this->output_path . '/recd',
            __DIR__ . '/docs'
        );
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) { mkdir($dir, 0755, true); }
        }
    }
    
    /**
     * Основной метод обработки
     */
    public function process() {
        $this->log("=== Старт ===");
        
        $this->loadStockData();
        $this->loadPriceData();
        
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
            default: 
                $this->log("ОШИБКА: неизвестный формат {$file_name}");
                return false;
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
    
    private function processOrder($content, $file_name) {
        $this->log("ORDER: {$file_name}");
        $parsed = $this->parseOrderContent($content);
        return $this->buildOrdersp($parsed, $file_name);
    }
    
    private function processOrderSpecProject($content, $file_name) {
        $this->log("ORDER+PROJECT: {$file_name}");
        
        $lines = explode("\n", $content);
        $order_lines = array();
        $found_order = false;
        
        foreach ($lines as $line) {
            $line_clean = rtrim(trim($line), ';');
            if (!$found_order && preg_match('/^(ЭТМ,)/u', $line_clean)) {
                $found_order = true;
            }
            if ($found_order) {
                $order_lines[] = $line;
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
                
                $price_rub = $this->getPriceFromFile($article);
                $stock_item = $this->getStockItem($article);
                
                if ($price_rub === null && $stock_item === null) {
                    $status = 'Error:не найден артикул';
                    $this->log("  Error:не найден артикул: {$article}");
                } elseif ($price_rub === null) {
                    $status = 'Error:нет цены';
                    $this->log("  Error:нет цены: {$article}");
                } elseif ($stock_item === null) {
                    $status = 'Error:не найден в API';
                    $this->log("  Error:не найден в API: {$article}");
                } else {
                    $status = 'Принят';
                    if (empty($name) && !empty($stock_item['name'])) {
                        $name = $stock_item['name'];
                    }
                }
                
                $row = array(
                    $order_number, '', $name, $article, $quantity,
                    $warehouse, $basis, $status, $price_rub,
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
                
                if ($stock_item === null) {
                    $stock_status = 'Error:не найден артикул';
                    $this->log("  Error:не найден артикул: {$article}");
                } else {
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
        $this->log("INVOIC XML: {$file_name}");
        
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
        $this->log("{$type} (транзит): {$file_name}");
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
        if (rename($file_path, $archive_file)) return true;
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
        
        if (php_sapi_name() === 'cli' || (isset($_SERVER['SCRIPT_FILENAME']) && basename($_SERVER['SCRIPT_FILENAME']) === 'run.php')) {
            echo $log_message;
        }
        
        file_put_contents($this->log_file, $log_message, FILE_APPEND);
    }

    public function getStockData() {
        return $this->loadStockData();
    }
}