<?php
class CountryDetector {
    const SERVER_VAR_NAME = 'COUNTRY_CODE';
    const MODE_AUTO = 'auto';

    private static $serverVarBlacklist = array('XX', 'T1', 'A1', 'A2', 'O1', '--');

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

    private static $logFile       = '/logs/country_detector.log';
    private static $modeFile      = '/logs/source_mode.txt';
    private static $minRemaining  = 1000;

    private static $trace = array();

    public static function getCountry($ipAddress = null) {
        self::$trace = array();

        if ($ipAddress === null) {
            $ipAddress = self::getUserIp();
        }
        self::trace('ip', $ipAddress);

        if (self::isLocalIp($ipAddress)) {
            self::trace('local', 'локальный IP → RU');
            self::log("Local IP: {$ipAddress} -> RU");
            return 'RU';
        }

        $mode = self::getSourceMode();
        self::trace('mode', $mode === self::MODE_AUTO
            ? 'auto (переменная → DaData)'
            : 'ключ ' . $mode);

        if ($mode !== self::MODE_AUTO && isset(self::$apiKeys[$mode])) {
            $result = self::resolveInKeyMode($ipAddress, $mode);
            self::trace('result', var_export($result, true));
            return $result;
        }

        $result = self::resolveInAutoMode($ipAddress);
        self::trace('result', var_export($result, true));
        return $result;
    }

    private static function resolveInAutoMode($ipAddress) {
        $serverCountry = self::getCountryFromServerVariable();
        if ($serverCountry !== false) {
            self::trace('env', "валидна: {$serverCountry}");
            self::log("AUTO: env={$serverCountry} (IP: {$ipAddress})");
            return $serverCountry;
        }
        self::trace('env', 'пустая/невалидна → DaData');

        $keyNames = array_keys(self::$apiKeys);
        $pickedKey = null;

        foreach ($keyNames as $keyName) {
            $remain = self::getKeyRemaining($keyName);

            if ($remain === false) {
                self::trace('key:' . $keyName, 'статистика недоступна');
                continue;
            }

            if ($remain <= self::$minRemaining) {
                self::trace('key:' . $keyName, "remaining={$remain} ≤ " . self::$minRemaining . ' → пропуск');
                continue;
            }

            $pickedKey = $keyName;
            self::trace('key:' . $keyName, "remaining={$remain} → ВЫБРАН");
            break;
        }

        if ($pickedKey === null) {
            self::log("AUTO: все ключи исчерпаны (IP: {$ipAddress})");
            self::trace('fallback', 'все ключи исчерпаны → false');
            return false;
        }

        return self::requestWithKey($ipAddress, $pickedKey, 'AUTO');
    }

    private static function resolveInKeyMode($ipAddress, $preferredKey) {
        $remain = self::getKeyRemaining($preferredKey);
        self::trace('key:' . $preferredKey, $remain === false
            ? 'статистика недоступна'
            : "remaining={$remain}");

        if ($remain !== false && $remain > self::$minRemaining) {
            self::trace('key:' . $preferredKey, 'используется как основной');
            return self::requestWithKey($ipAddress, $preferredKey, 'KEY-MODE');
        }

        self::trace('fallback', "{$preferredKey} ниже порога → ищу рабочий");
        $keyNames = array_keys(self::$apiKeys);
        $pickedKey = null;

        foreach ($keyNames as $keyName) {
            if ($keyName === $preferredKey) {
                continue;
            }

            $remain2 = self::getKeyRemaining($keyName);
            if ($remain2 === false) {
                self::trace('key:' . $keyName, 'статистика недоступна');
                continue;
            }
            if ($remain2 <= self::$minRemaining) {
                self::trace('key:' . $keyName, "remaining={$remain2} ≤ " . self::$minRemaining . ' → пропуск');
                continue;
            }

            $pickedKey = $keyName;
            self::trace('key:' . $keyName, "remaining={$remain2} → фолбэк-ключ");
            break;
        }

        if ($pickedKey !== null) {
            return self::requestWithKey($ipAddress, $pickedKey, 'KEY-MODE-FALLBACK');
        }

        self::trace('fallback', 'рабочих ключей нет → переменная');
        $serverCountry = self::getCountryFromServerVariable();
        if ($serverCountry !== false) {
            self::trace('env', "валидна: {$serverCountry}");
            return $serverCountry;
        }

        self::trace('fallback', 'переменная пустая/невалидна → false');
        self::log("KEY-MODE: нет ни ключей, ни переменной (IP: {$ipAddress})");
        return false;
    }

    private static function requestWithKey($ipAddress, $keyName, $context) {
        $token  = self::$apiKeys[$keyName]['token'];
        $result = self::requestDaData($ipAddress, $token);

        if ($result['success']) {
            self::trace('request', "{$keyName} OK: {$result['country']}");
            self::log("{$context} '{$keyName}' OK: {$result['country']}");
            return $result['country'];
        }

        if (isset($result['error_type']) && $result['error_type'] === 'ip_not_found') {
            self::trace('request', "{$keyName}: IP не найден → UNKNOWN");
            return 'UNKNOWN';
        }

        self::trace('request', "{$keyName} FAIL: " . (isset($result['message']) ? $result['message'] : 'unknown'));
        self::log("{$context} '{$keyName}' FAIL: " . (isset($result['message']) ? $result['message'] : 'unknown'));

        if ($context === 'KEY-MODE') {
            $serverCountry = self::getCountryFromServerVariable();
            if ($serverCountry !== false) {
                self::trace('fallback', "ошибка ключа → переменная: {$serverCountry}");
                return $serverCountry;
            }
        }

        return false;
    }

    private static function getKeyRemaining($keyName) {
        if (!isset(self::$apiKeys[$keyName])) {
            return false;
        }

        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['stats_cache'][$keyName])) {
            $stat = $_SESSION['stats_cache'][$keyName];
            if (is_array($stat) && isset($stat['remaining']['suggestions'])) {
                return intval($stat['remaining']['suggestions']);
            }
        }

        $stat = self::getDailyStats(
            self::$apiKeys[$keyName]['token'],
            self::$apiKeys[$keyName]['secret']
        );

        if ($stat === false) {
            return false;
        }
        return isset($stat['remaining']['suggestions'])
            ? intval($stat['remaining']['suggestions'])
            : false;
    }

    private static function getCountryFromServerVariable() {
        if (empty($_SERVER[self::SERVER_VAR_NAME])) {
            return false;
        }

        $raw  = $_SERVER[self::SERVER_VAR_NAME];
        $code = strtoupper(trim($raw));

        if (!preg_match('/^[A-Z]{2}$/', $code)) {
            self::log("Некорректная переменная GeoIp: [" . $raw . "]");
            return false;
        }
        if (in_array($code, self::$serverVarBlacklist, true)) {
            self::log("Некорректная переменная GeoIp: {$code}");
            return false;
        }
        return $code;
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

        $response  = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
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
        return self::getDailyStats(
            self::$apiKeys[$keyName]['token'],
            self::$apiKeys[$keyName]['secret']
        );
    }

    public static function getAllStats() {
        $results = array();
        foreach (self::$apiKeys as $keyName => $keyData) {
            $results[$keyName] = self::getDailyStats($keyData['token'], $keyData['secret']);
        }
        return $results;
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

        $response  = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
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

    public static function getSourceMode() {
        $file = $_SERVER['DOCUMENT_ROOT'] . self::$modeFile;
        if (!file_exists($file)) {
            return self::MODE_AUTO;
        }
        $mode = trim((string)file_get_contents($file));
        if ($mode === '' || $mode === self::MODE_AUTO) {
            return self::MODE_AUTO;
        }
        if (isset(self::$apiKeys[$mode])) {
            return $mode;
        }
        self::log("Неизвестный режим [{$mode}], использую auto");
        return self::MODE_AUTO;
    }

    public static function setSourceMode($mode) {
        $mode = trim((string)$mode);
        if ($mode !== self::MODE_AUTO && !isset(self::$apiKeys[$mode])) {
            return false;
        }

        $file   = $_SERVER['DOCUMENT_ROOT'] . self::$modeFile;
        $logDir = dirname($file);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        file_put_contents($file, $mode);
        self::log("SOURCE MODE SET: '{$mode}'");
        return true;
    }

    public static function clearSourceMode() {
        $file = $_SERVER['DOCUMENT_ROOT'] . self::$modeFile;
        if (file_exists($file)) {
            unlink($file);
        }
        self::log("SOURCE MODE CLEARED");
        return true;
    }

    private static function getUserIp() {
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

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

    public static function getCurrentIpForDebug() {
        return self::getUserIp();
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

    private static function log($message) {
        $logFile = $_SERVER['DOCUMENT_ROOT'] . self::$logFile;
        $logDir  = dirname($logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        file_put_contents(
            $logFile,
            date('Y-m-d H:i:s') . " | " . $message . "\n",
            FILE_APPEND
        );
    }

    private static function trace($step, $text) {
        self::$trace[] = array('step' => $step, 'text' => $text);
    }

    public static function getLastTrace() {
        return self::$trace;
    }

    public static function getServerVariableDebug() {
        $varName = self::SERVER_VAR_NAME;

        if (empty($_SERVER[$varName])) {
            return array(
                'var_name'   => $varName,
                'raw'        => null,
                'code'       => null,
                'detected'   => false,
                'status'     => 'empty',
                'statusText' => 'переменная пустая или не задана',
            );
        }

        $raw  = $_SERVER[$varName];
        $code = strtoupper(trim($raw));

        if (!preg_match('/^[A-Z]{2}$/', $code)) {
            return array(
                'var_name'   => $varName,
                'raw'        => $raw,
                'code'       => $code,
                'detected'   => false,
                'status'     => 'invalid',
                'statusText' => 'невалидный формат (ожидается 2 латинские буквы)',
            );
        }

        if (in_array($code, self::$serverVarBlacklist, true)) {
            return array(
                'var_name'   => $varName,
                'raw'        => $raw,
                'code'       => $code,
                'detected'   => false,
                'status'     => 'blacklisted',
                'statusText' => 'в чёрном списке (' . implode(', ', self::$serverVarBlacklist) . ')',
            );
        }

        return array(
            'var_name'   => $varName,
            'raw'        => $raw,
            'code'       => $code,
            'detected'   => $code,
            'status'     => 'ok',
            'statusText' => 'валидна',
        );
    }

    public static function getKeysOverview($stats = null) {
        if ($stats === null) {
            $stats = self::getAllStats();
        }

        $overview = array();
        foreach (self::$apiKeys as $keyName => $_) {
            $stat      = isset($stats[$keyName]) ? $stats[$keyName] : null;
            $remaining = ($stat && isset($stat['remaining']['suggestions']))
                ? intval($stat['remaining']['suggestions']) : null;
            $used      = ($stat && isset($stat['services']['suggestions']))
                ? intval($stat['services']['suggestions']) : null;

            if ($remaining === null) {
                $state = 'unknown';
                $text  = '❓ нет данных';
                $cls   = 'warning';
            } elseif ($remaining > self::$minRemaining) {
                $state = 'ok';
                $text  = '✅ доступен';
                $cls   = 'success';
            } elseif ($remaining > 0) {
                $state = 'low';
                $text  = '⚠️ ниже порога (' . self::$minRemaining . ')';
                $cls   = 'warning';
            } else {
                $state = 'dead';
                $text  = '❌ исчерпан';
                $cls   = 'error';
            }

            $overview[$keyName] = array(
                'name'      => $keyName,
                'used'      => $used,
                'remaining' => $remaining,
                'state'     => $state,
                'statusText'=> $text,
                'class'     => $cls,
            );
        }
        return $overview;
    }

    public static function getMinRemaining() {
        return self::$minRemaining;
    }
}

function getCountryByIp($ipAddress = null) {
    return CountryDetector::getCountry($ipAddress);
}