<?php
// abacus/services/CountryDetector.php

class CountryDetector {
    
  private static $apiKeys = array(
    'key1' => 'b237155b14c4b6f777d91207ebc3775cb712ad6d',
    'key2' => '2fe032454318a8fa0c013d2927d70ccc28154d1b',
    'key3' => '79b8c6f8fcaf1ebae2eccb655c5f5e5efdde5547',
  );
  
  private static $logFile = '/logs/country_detector.log';
  
  private static $currentKeyIndex = 0;
  
  /**
   * Получить страну по IP адресу
   * 
   * @param string $ipAddress IP адрес
   * @return string|false Код страны (RU, US, KZ...) или false если не удалось определить
   */
  public static function getCountry($ipAddress = null) {
    if ($ipAddress === null) {
      $ipAddress = self::getUserIp();
    }
    
    $totalKeys = count(self::$apiKeys);
    
    for ($attempt = 0; $attempt < $totalKeys; $attempt++) {
      $keyIndex = (self::$currentKeyIndex + $attempt) % $totalKeys;
      $keyName = array_keys(self::$apiKeys)[$keyIndex];
      $apiKey = self::$apiKeys[$keyName];
      
      $result = self::requestDaData($ipAddress, $apiKey);
      
      if ($result['success']) {
        self::$currentKeyIndex = $keyIndex;
        return $result['country'];
      }
      
      if ($result['error_type'] == 'limit_exceeded') {
        self::log("Лимит исчерпан для ключа '{$keyName}'. Переключаемся на следующий.");
        continue;
      } elseif ($result['error_type'] == 'feature_disabled') {
        self::log("Функция SUGGESTIONS отключена для ключа '{$keyName}'.");
        continue;
      } elseif ($result['error_type'] == 'ip_not_found') {
        self::$currentKeyIndex = $keyIndex;
        return 'UNKNOWN';
      } else {
        self::log("Ошибка для ключа '{$keyName}': " . $result['message']);
        continue;
      }
    }
    
    self::log("ВСЕ КЛЮЧИ ИСЧЕРПАНЫ! Невозможно определить страну для IP: {$ipAddress}");
    return false;
  }
  
  /**
   * Запрос к DaData API
   * 
   * @param string $ipAddress
   * @param string $apiKey
   * @return array
   */
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
      return array(
        'success' => false,
        'error_type' => 'curl_error',
        'message' => $curlError
      );
    }
    
    if ($httpCode == 200) {
      $result = json_decode($response, true);
      
      if (isset($result['location']['data']['country_iso_code'])) {
        return array(
          'success' => true,
          'country' => $result['location']['data']['country_iso_code']
        );
      }
      
      if (isset($result['location']) && $result['location'] === null) {
        return array(
          'success' => false,
          'error_type' => 'ip_not_found',
          'message' => 'IP not found'
        );
      }
    }
    
    if ($httpCode == 403) {
      $result = json_decode($response, true);
      $reason = isset($result['reason']) ? $result['reason'] : 'Unknown';
      $message = isset($result['message']) ? $result['message'] : 'Forbidden';
      
      if (stripos($message, 'disabled') !== false) {
        return array(
          'success' => false,
          'error_type' => 'feature_disabled',
          'message' => $message
        );
      }
      
      return array(
        'success' => false,
        'error_type' => 'forbidden',
        'message' => $message
      );
    }
    
    if ($httpCode == 429) {
      return array(
        'success' => false,
        'error_type' => 'limit_exceeded',
        'message' => 'Rate limit exceeded'
      );
    }
    
    return array(
      'success' => false,
      'error_type' => 'http_error',
      'message' => "HTTP Code: {$httpCode}, Response: {$response}"
    );
  }
  
  /**
   * Получить IP пользователя
   * 
   * @return string
   */
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
  
  /**
   * Запись в лог
   * 
   * @param string $message
   */
  private static function log($message) {
    $logFile = $_SERVER['DOCUMENT_ROOT'] . self::$logFile;
    $logDir = dirname($logFile);
    
    if (!is_dir($logDir)) {
      mkdir($logDir, 0755, true);
    }
    
    $logMessage = date('Y-m-d H:i:s') . " | " . $message . "\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
  }
  
  /**
   * Проверить доступность ключей (для отладки)
   * 
   * @return array
   */
  public static function checkKeys($ipAddress = '77.88.8.8') {
    $results = array();
    
    foreach (self::$apiKeys as $keyName => $apiKey) {
      $result = self::requestDaData($ipAddress, $apiKey);
      $results[$keyName] = $result;
    }
    
    return $results;
  }
}

function getCountryByIp($ipAddress = null) {
  return CountryDetector::getCountry($ipAddress);
}
?>