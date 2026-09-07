<?php
class CountryDetector {
    
    private static $apiKeys = array(
        'key1' => array(
            'token' => 'b237155b14c4b6f777d91207ebc3775cb712ad6d',
            'secret' => '4c29a5159a84560df52caabb12f641479e3c4759',
        ),
        'key2' => array(
            'token' => '2fe032454318a8fa0c013d2927d70ccc28154d1b',
            'secret' => '04ed0e671bc66d9d6cd17d739f359836cee91069',
        ),
        'key3' => array(
            'token' => '79b8c6f8fcaf1ebae2eccb655c5f5e5efdde5547',
            'secret' => '464ab2b27a65b7072d62019b35f196e9e51f3205',
        ),
    );
    
    private static $logFile = '/logs/country_detector.log';
    private static $forcedKeyFile = '/logs/forced_key.txt';
    private static $minRemaining = 1000;
    
    public static function getCountry($ipAddress = null) {
        if ($ipAddress === null) {
            $ipAddress = self::getUserIp();
        }
        
        if (self::isLocalIp($ipAddress)) {
            return 'RU';
        }
        
        $forcedKey = self::getForcedKey();
        if ($forcedKey !== false && isset(self::$apiKeys[$forcedKey])) {
            $token = self::$apiKeys[$forcedKey]['token'];
            $result = self::requestDaData($ipAddress, $token);
            
            if ($result['success']) {
                self::log("FORCED KEY '{$forcedKey}' OK: {$result['country']}");
                return $result['country'];
            }
        }
        
        $apiKey = self::getAvailableKey();
        
        if ($apiKey === false) {
            self::log("ВСЕ КЛЮЧИ ИСЧЕРПАНЫ! IP: {$ipAddress}");
            return false;
        }
        
        $result = self::requestDaData($ipAddress, $apiKey);
        
        if ($result['success']) {
            return $result['country'];
        }
        
        if ($result['error_type'] == 'ip_not_found') {
            return 'UNKNOWN';
        }
        
        return false;
    }
    
    private static function getAvailableKey() {
        foreach (self::$apiKeys as $keyName => $keyData) {
            $stats = self::getDailyStats($keyData['token'], $keyData['secret']);
            
            if ($stats === false) {
                self::log("KEY '{$keyName}': статистика недоступна");
                continue;
            }
            
            $remaining = isset($stats['remaining']['suggestions']) ? intval($stats['remaining']['suggestions']) : 0;
            $used = isset($stats['services']['suggestions']) ? intval($stats['services']['suggestions']) : 0;
            
            self::log("KEY '{$keyName}': used={$used}, remaining={$remaining}");
            
            if ($remaining > self::$minRemaining) {
                self::log("KEY '{$keyName}': ВЫБРАН (remaining={$remaining})");
                return $keyData['token'];
            }
        }
        
        return false;
    }
    
    private static function getDailyStats($token, $secret) {
        $url = 'https://dadata.ru/api/v2/stat/daily';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Token ' . $token,
            'X-Secret: ' . $secret
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        if ($curlError) {
            self::log("Curl error: {$curlError}");
            return false;
        }
        
        if ($httpCode == 200) {
            $result = json_decode($response, true);
            if ($result !== null) {
                return $result;
            }
        }
        
        self::log("Stats HTTP {$httpCode}: {$response}");
        return false;
    }

    public static function getKeyStats($keyName) {
        if (!isset(self::$apiKeys[$keyName])) {
            return false;
        }
        
        $token = self::$apiKeys[$keyName]['token'];
        $secret = self::$apiKeys[$keyName]['secret'];
        
        return self::getDailyStats($token, $secret);
    }
    
    private static function requestDaData($ipAddress, $apiKey) {
        $url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/detectAddressByIp?ip=" . urlencode($ipAddress);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Authorization: Token ' . $apiKey
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        if ($curlError) {
            return array('success' => false, 'error_type' => 'curl_error', 'message' => $curlError);
        }
        
        if ($httpCode == 200) {
            $result = json_decode($response, true);
            
            if (isset($result['location']['data']['country_iso_code'])) {
                return array('success' => true, 'country' => $result['location']['data']['country_iso_code']);
            }
            
            if (isset($result['location']) && $result['location'] === null) {
                return array('success' => false, 'error_type' => 'ip_not_found', 'message' => 'IP not found');
            }
        }
        
        return array('success' => false, 'error_type' => 'http_error', 'message' => "HTTP Code: {$httpCode}");
    }
    
    private static function getUserIp() {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip = trim($ips[0]);
        } elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }
        
        return $ip;
    }
    
    private static function isLocalIp($ip) {
        return (
            $ip == '127.0.0.1' ||
            $ip == '::1' ||
            strpos($ip, '127.0.') === 0 ||
            strpos($ip, '10.') === 0 ||
            strpos($ip, '192.168.') === 0
        );
    }
    
    private static function getForcedKey() {
        $forcedKeyFile = $_SERVER['DOCUMENT_ROOT'] . self::$forcedKeyFile;
        
        if (file_exists($forcedKeyFile)) {
            $key = trim(file_get_contents($forcedKeyFile));
            if ($key != '' && isset(self::$apiKeys[$key])) {
                return $key;
            }
        }
        
        return false;
    }
    
    public static function setForcedKey($keyName) {
        if (!isset(self::$apiKeys[$keyName])) {
            return false;
        }
        
        $forcedKeyFile = $_SERVER['DOCUMENT_ROOT'] . self::$forcedKeyFile;
        $logDir = dirname($forcedKeyFile);
        
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        file_put_contents($forcedKeyFile, $keyName);
        self::log("FORCED KEY SET: '{$keyName}'");
        return true;
    }
    
    public static function clearForcedKey() {
        $forcedKeyFile = $_SERVER['DOCUMENT_ROOT'] . self::$forcedKeyFile;
        
        if (file_exists($forcedKeyFile)) {
            unlink($forcedKeyFile);
        }
        
        self::log("FORCED KEY CLEARED");
        return true;
    }
    
    private static function log($message) {
        $logFile = $_SERVER['DOCUMENT_ROOT'] . self::$logFile;
        $logDir = dirname($logFile);
        
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        $logMessage = date('Y-m-d H:i:s') . " | " . $message . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
    
    public static function getAllStats() {
        $results = array();
        
        foreach (self::$apiKeys as $keyName => $keyData) {
            $stats = self::getDailyStats($keyData['token'], $keyData['secret']);
            $results[$keyName] = $stats;
        }
        
        return $results;
    }
    
    public static function checkKey($keyName, $ipAddress = '77.88.8.8') {
        if (!isset(self::$apiKeys[$keyName])) {
            return array('success' => false, 'message' => 'Ключ не найден');
        }
        
        $token = self::$apiKeys[$keyName]['token'];
        $secret = self::$apiKeys[$keyName]['secret'];
        
        $stats = self::getDailyStats($token, $secret);
        $countryResult = self::requestDaData($ipAddress, $token);
        
        return array(
            'stats' => $stats,
            'country_result' => $countryResult,
        );
    }
}

function getCountryByIp($ipAddress = null) {
    return CountryDetector::getCountry($ipAddress);
}
?>