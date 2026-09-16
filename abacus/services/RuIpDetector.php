<?php
class RuIpDetector
{
    private static $rangesFile = '/local/php_interface/include/ru_ip_ranges.txt';

    private static $logFile = '/logs/ru_ip_detector.log';

    private static $rangesV4 = null;
    private static $rangesV6 = null;

    private static $trustProxyHeaders = true;

    /**
     * Основной метод: является ли IP российским?
     * Если $ipAddress === null — берём IP посетителя.
     *
     * @param string|null $ipAddress
     * @return bool
     */
    public static function isRussianIp($ipAddress = null)
    {
        if ($ipAddress === null) {
            $ipAddress = self::getUserIp();
        }

        $ipAddress = trim($ipAddress);
        if ($ipAddress === '') {
            self::log('Пустой IP');
            return false;
        }

        if (self::isLocalIp($ipAddress)) {
            return true;
        }

        $bin = @inet_pton($ipAddress);
        if ($bin === false) {
            self::log("Некорректный IP: {$ipAddress}");
            return false;
        }

        self::loadRanges();

        if (strlen($bin) === 4) {
            return self::matchV4($bin);
        }

        if (strlen($bin) === 16) {
            return self::matchV6($bin);
        }

        return false;
    }

    /**
     * Совместимость с CountryDetector::getCountry().
     * Возвращает 'RU', 'UNKNOWN' или false.
     *
     * @param string|null $ipAddress
     * @return string|false
     */
    public static function getCountry($ipAddress = null)
    {
        if ($ipAddress === null) {
            $ipAddress = self::getUserIp();
        }

        if (self::isLocalIp($ipAddress)) {
            return 'RU';
        }

        $bin = @inet_pton($ipAddress);
        if ($bin === false) {
            return 'UNKNOWN';
        }

        return self::isRussianIp($ipAddress) ? 'RU' : 'UNKNOWN';
    }

    public static function isRu($ipAddress = null)
    {
        return self::isRussianIp($ipAddress);
    }

    private static function loadRanges()
    {
        if (self::$rangesV4 !== null && self::$rangesV6 !== null) {
            return;
        }

        self::$rangesV4 = array();
        self::$rangesV6 = array();

        $file = $_SERVER['DOCUMENT_ROOT'] . self::$rangesFile;

        if (!is_file($file) || !is_readable($file)) {
            self::log("Файл диапазонов не найден: {$file}");
            return;
        }

        $handle = @fopen($file, 'r');
        if (!$handle) {
            self::log("Не удалось открыть файл диапазонов: {$file}");
            return;
        }

        $lineNo = 0;
        while (($line = fgets($handle)) !== false) {
            $lineNo++;
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }

            $cidr = self::normalizeCidr($line);
            if ($cidr === null) {
                self::log("Некорректная строка #{$lineNo}: {$line}");
                continue;
            }

            list($network, $mask) = $cidr;

            if (strpos($network, ':') !== false) {
                self::$rangesV6[] = array($network, $mask);
            } else {
                self::$rangesV4[] = array($network, $mask);
            }
        }
        fclose($handle);

        self::log(sprintf(
            'Загружено диапазонов: IPv4=%d, IPv6=%d',
            count(self::$rangesV4),
            count(self::$rangesV6)
        ));
    }

    private static function normalizeCidr($line)
    {
        $parts = explode('/', $line, 2);
        $ip = trim($parts[0]);
        $mask = isset($parts[1]) ? (int)$parts[1] : null;

        $bin = @inet_pton($ip);
        if ($bin === false) {
            return null;
        }

        $maxMask = strlen($bin) * 8;
        if ($mask === null) {
            $mask = $maxMask;
        }
        if ($mask < 0 || $mask > $maxMask) {
            return null;
        }

        $bin = self::applyMask($bin, $mask);

        return array($bin, $mask);
    }

    private static function matchV4($bin)
    {
        foreach (self::$rangesV4 as $range) {
            list($network, $mask) = $range;
            if (self::ipInRange($bin, $network, $mask)) {
                return true;
            }
        }
        return false;
    }

    private static function matchV6($bin)
    {
        foreach (self::$rangesV6 as $range) {
            list($network, $mask) = $range;
            if (self::ipInRange($bin, $network, $mask)) {
                return true;
            }
        }
        return false;
    }

    private static function ipInRange($binIp, $binNetwork, $maskBits)
    {
        if (strlen($binIp) !== strlen($binNetwork)) {
            return false;
        }

        $fullBytes = intdiv($maskBits, 8);
        $restBits  = $maskBits % 8;

        if ($fullBytes > 0) {
            if (substr($binIp, 0, $fullBytes) !== substr($binNetwork, 0, $fullBytes)) {
                return false;
            }
        }

        if ($restBits === 0) {
            return true;
        }

        $mask = 0xFF << (8 - $restBits) & 0xFF;
        $a = ord($binIp[$fullBytes])      & $mask;
        $b = ord($binNetwork[$fullBytes]) & $mask;

        return $a === $b;
    }

    private static function applyMask($bin, $maskBits)
    {
        $len = strlen($bin);
        $fullBytes = intdiv($maskBits, 8);
        $restBits  = $maskBits % 8;

        for ($i = $fullBytes + ($restBits ? 1 : 0); $i < $len; $i++) {
            $bin[$i] = "\x00";
        }

        if ($restBits) {
            $mask = 0xFF << (8 - $restBits) & 0xFF;
            $bin[$fullBytes] = chr(ord($bin[$fullBytes]) & $mask);
        }

        return $bin;
    }

    public static function getUserIp()
    {
        if (self::$trustProxyHeaders) {
            if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
                return trim($_SERVER['HTTP_CF_CONNECTING_IP']);
            }
            if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
                return trim($_SERVER['HTTP_X_REAL_IP']);
            }
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($ips[0]);
            }
        }

        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    }

    private static function isLocalIp($ip)
    {
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return true;
        }
        if (strpos($ip, '127.') === 0) return true;
        if (strpos($ip, '10.') === 0) return true;
        if (strpos($ip, '192.168.') === 0) return true;
        if (preg_match('#^172\.(1[6-9]|2[0-9]|3[01])\.#', $ip)) return true;
        if (stripos($ip, 'fc') === 0 || stripos($ip, 'fd') === 0) return true; // ULA IPv6

        return false;
    }

    public static function reload()
    {
        self::$rangesV4 = null;
        self::$rangesV6 = null;
        self::loadRanges();
    }

    public static function setRangesFile($path)
    {
        self::$rangesFile = $path;
        self::reload();
    }

    public static function setTrustProxyHeaders($trust)
    {
        self::$trustProxyHeaders = (bool)$trust;
    }

    private static function log($message)
    {
        $logFile = $_SERVER['DOCUMENT_ROOT'] . self::$logFile;
        $logDir  = dirname($logFile);

        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }

        @file_put_contents(
            $logFile,
            date('Y-m-d H:i:s') . " | " . $message . "\n",
            FILE_APPEND
        );
    }
}

function isRussianIp($ipAddress = null)
{
    return RuIpDetector::isRussianIp($ipAddress);
}