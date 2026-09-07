<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/services/CountryDetector.php';

echo "<h1>Проверка API ключей DaData</h1>";

$results = CountryDetector::checkKeys('77.88.8.8');

echo "<h2>Результаты проверки ключей:</h2>";
echo "<pre>";
foreach ($results as $keyName => $result) {
  echo "Ключ: {$keyName}\n";
  if ($result['success']) {
    echo "  ✅ Работает! Страна: {$result['country']}\n";
  } else {
    echo "  ❌ Ошибка: {$result['error_type']} - {$result['message']}\n";
  }
  echo "\n";
}
echo "</pre>";

echo "<h2>Определение страны для текущего пользователя:</h2>";
$userCountry = CountryDetector::getCountry();
echo "IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "Страна: " . ($userCountry ? $userCountry : 'не определена') . "<br>";
?>