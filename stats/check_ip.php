<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
if ($server_name == 'www.rusavto.moisait.net' || $server_name == 'rusavto.moisait.net') {
    
class IPChecker {
    private $logFile = 'ip_log.txt';
    private $excludedIPs = array('127.0.0.1', '::1');
    
    public function getUserIP() {
        $ip = $this->detectIP();
        
        if (!$this->validateIP($ip)) {
            return 'Invalid IP detected';
        }
        
        return $ip;
    }
    
    private function detectIP() {
        $headers = array(
            'HTTP_CF_CONNECTING_IP',
            'HTTP_X_REAL_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_CLIENT_IP',
            'REMOTE_ADDR'
        );
        
        foreach ($headers as $header) {
            if (isset($_SERVER[$header])) {
                $ip = $_SERVER[$header];
                
                if (strpos($ip, ',') !== false) {
                    $ipList = explode(',', $ip);
                    $ip = trim($ipList[0]);
                }
                
                if ($this->validateIP($ip) && !$this->isExcluded($ip)) {
                    return $ip;
                }
            }
        }
        
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }
    
    private function validateIP($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }
    
    private function isExcluded($ip) {
        return in_array($ip, $this->excludedIPs);
    }
    
    public function logVisit() {
        $ip = $this->getUserIP();
        $time = date('Y-m-d H:i:s');
        $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';
        $page = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'Unknown';
        $serverName = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'Unknown';
        
        $logEntry = sprintf(
            "[%s] Сервер: %s | IP: %s | Page: %s | Agent: %s\n",
            $time,
            $serverName,
            $ip,
            $page,
            $userAgent
        );
        
        $logDir = dirname($this->logFile);
        if (!is_writable($logDir) && $logDir != '.') {
            $this->logFile = sys_get_temp_dir() . '/ip_log.txt';
        }
        
        @file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
        
        return $ip;
    }
    
    public function getIPInfo($ip) {
        if (!function_exists('curl_init')) {
            return null;
        }
        
        $apiUrl = "http://ip-api.com/json/{$ip}?fields=status,country,region,city,isp,org,query";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200 && $response) {
            return json_decode($response, true);
        }
        
        return null;
    }
}

$checker = new IPChecker();
$userIP = $checker->logVisit();
$ipInfo = $checker->getIPInfo($userIP);
$currentServer = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'Unknown';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>IP Checker для <?php echo htmlspecialchars($currentServer); ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        .info-box { background: #f4f4f4; padding: 20px; border-radius: 5px; }
        .server-info { background: #e8f4f8; padding: 10px; margin-bottom: 20px; border-left: 4px solid #4CAF50; }
        .ip { font-size: 24px; color: #333; font-weight: bold; }
        .details { margin-top: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .alert { background: #fff3cd; border: 1px solid #ffeeba; color: #856404; padding: 12px; border-radius: 4px; }
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="info-box">
        <div class="server-info">
            <strong>Сервер:</strong> <?php echo htmlspecialchars($currentServer); ?>
        </div>
        
        <h2>Информация о вашем подключении</h2>
        <p class="ip">Ваш IP: <strong><?php echo htmlspecialchars($userIP); ?></strong></p>
        
        <?php if ($ipInfo && isset($ipInfo['status']) && $ipInfo['status'] === 'success'): ?>
        <div class="details">
            <h3>Детальная информация:</h3>
            <table>
                <tr><th>Параметр</th><th>Значение</th></tr>
                <tr><td>Страна</td><td><?php echo htmlspecialchars(isset($ipInfo['country']) ? $ipInfo['country'] : 'Unknown'); ?></td></tr>
                <tr><td>Регион</td><td><?php echo htmlspecialchars(isset($ipInfo['regionName']) ? $ipInfo['regionName'] : 'Unknown'); ?></td></tr>
                <tr><td>Город</td><td><?php echo htmlspecialchars(isset($ipInfo['city']) ? $ipInfo['city'] : 'Unknown'); ?></td></tr>
                <tr><td>Провайдер</td><td><?php echo htmlspecialchars(isset($ipInfo['isp']) ? $ipInfo['isp'] : 'Unknown'); ?></td></tr>
                <tr><td>Организация</td><td><?php echo htmlspecialchars(isset($ipInfo['org']) ? $ipInfo['org'] : 'Unknown'); ?></td></tr>
            </table>
        </div>
        <?php elseif ($ipInfo === null): ?>
        <div class="alert">
            <p>Информация о местоположении временно недоступна (curl не установлен или API не отвечает).</p>
        </div>
        <?php endif; ?>
        
        <p><small>Время проверки: <?php echo date('Y-m-d H:i:s'); ?></small></p>
    </div>
</body>
</html>

<?php 
} else {
    header('HTTP/1.0 403 Forbidden');
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Доступ запрещен</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
            .error-box { background: #f8d7da; padding: 20px; border-radius: 5px; border: 1px solid #f5c6cb; color: #721c24; }
        </style>
    </head>
    <body>
        <div class="error-box">
            <h2>Доступ запрещен</h2>
            <p>Этот скрипт доступен только для домена <strong>www.rusavto.moisait.net</strong></p>
            <p>Текущий сервер: <strong><?php echo htmlspecialchars(isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'Unknown'); ?></strong></p>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>