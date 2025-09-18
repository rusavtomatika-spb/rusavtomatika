<?php
declare(strict_types=1);

// Скрипт рекурсивно обходит проект и формирует файл images.txt
// со списком изображений (svg, png, jpg, jpeg, gif, webp) и статистикой по форматам.

$rootDir = __DIR__;
$outFile = $rootDir . DIRECTORY_SEPARATOR . 'images.txt';

$allowedExtensions = ['svg', 'png', 'jpg', 'jpeg', 'gif', 'webp'];
$extensionCounters = array_fill_keys($allowedExtensions, 0);
$allFiles = [];

$directoryIterator = new RecursiveDirectoryIterator(
	$rootDir,
	FilesystemIterator::SKIP_DOTS
);
$iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST);

foreach ($iterator as $fileInfo) {
	if (!$fileInfo->isFile()) {
		continue;
	}

	$extension = strtolower($fileInfo->getExtension());
	if (!in_array($extension, $allowedExtensions, true)) {
		continue;
	}

	$fullPath = $fileInfo->getPathname();
	$relativePath = str_replace(['\\', $rootDir . DIRECTORY_SEPARATOR], ['/', ''], $fullPath);

	$allFiles[] = $relativePath;
	$extensionCounters[$extension]++;
}

sort($allFiles, SORT_NATURAL | SORT_FLAG_CASE);

$totalCount = array_sum($extensionCounters);

$lines = [];
$lines[] = "Сгенерировано: " . date('Y-m-d H:i:s');
$lines[] = "Корень проекта: " . $rootDir;
$lines[] = "";
$lines[] = "Статистика по расширениям:";
foreach ($allowedExtensions as $ext) {
	$lines[] = sprintf("  .%s: %d", $ext, $extensionCounters[$ext]);
}
$lines[] = sprintf("Итого: %d", $totalCount);
$lines[] = "";
$lines[] = "Список файлов:";
$lines[] = "";

foreach ($allFiles as $path) {
	$lines[] = $path;
}

$content = implode(PHP_EOL, $lines) . PHP_EOL;

if (file_put_contents($outFile, $content) === false) {
	fwrite(STDERR, "Не удалось записать файл: {$outFile}" . PHP_EOL);
	exit(1);
}

echo "Готово. Найдено {$totalCount} файлов. Результат: {$outFile}" . PHP_EOL;
