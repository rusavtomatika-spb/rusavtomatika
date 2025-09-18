<?php
declare(strict_types=1);

// Удаляет локальные изображения, которые присутствуют в images.txt (локальный список)
// но отсутствуют в images2.txt (актуальный список с сайта).
// Безопасности:
// - удаляются только файлы с расширениями: svg, png, jpg, jpeg, gif, webp
// - удаление только внутри корня проекта
// - по умолчанию DRY-RUN (ничего не удаляет), для реального удаления передайте аргумент --apply

$rootDir = __DIR__;
$fileLocal = $rootDir . DIRECTORY_SEPARATOR . 'images.txt';
$fileWeb = $rootDir . DIRECTORY_SEPARATOR . 'images2.txt';
$allowedExtensions = ['svg', 'png', 'jpg', 'jpeg', 'gif', 'webp'];
$apply = in_array('--apply', $argv ?? [], true);

function normalizeSeparators(string $path): string {
	return str_replace('\\', '/', $path);
}

function stripPrefixInsensitive(string $path, string $prefix): string {
	$pathN = normalizeSeparators($path);
	$prefixN = rtrim(normalizeSeparators($prefix), '/');
	if ($prefixN !== '' && strncasecmp($pathN, $prefixN . '/', strlen($prefixN) + 1) === 0) {
		return substr($pathN, strlen($prefixN) + 1);
	}
	return $pathN;
}

function readImageListStrict(string $path): array {
	$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	if ($lines === false) {
		throw new RuntimeException("Не удалось прочитать файл: {$path}");
	}
	$declaredRoot = '';
	$startIdx = 0;
	foreach ($lines as $i => $line) {
		if ($declaredRoot === '' && mb_stripos($line, 'Корень проекта:') !== false) {
			$declaredRoot = trim((string)preg_replace('~^.*?:~u', '', $line));
			$declaredRoot = trim($declaredRoot);
		}
		if (mb_stripos($line, 'Список файлов:') !== false) {
			$startIdx = $i + 1;
			break;
		}
	}
	$items = [];
	for ($i = $startIdx; $i < count($lines); $i++) {
		$line = trim($lines[$i]);
		if ($line === '' || str_starts_with($line, '#')) {
			continue;
		}
		$line = normalizeSeparators($line);
		if ($declaredRoot !== '') {
			$line = stripPrefixInsensitive($line, $declaredRoot);
		}
		$items[] = ltrim($line, '/');
	}
	return $items;
}

if (!is_file($fileLocal)) {
	fwrite(STDERR, "Не найден файл: {$fileLocal}" . PHP_EOL);
	exit(1);
}
if (!is_file($fileWeb)) {
	fwrite(STDERR, "Не найден файл: {$fileWeb}" . PHP_EOL);
	exit(1);
}

try {
	$localList = readImageListStrict($fileLocal);
	$webList = readImageListStrict($fileWeb);
} catch (Throwable $e) {
	fwrite(STDERR, $e->getMessage() . PHP_EOL);
	exit(1);
}

$webSet = array_fill_keys($webList, true);
$toDelete = [];
foreach ($localList as $relPath) {
	if (!isset($webSet[$relPath])) {
		$toDelete[] = $relPath;
	}
}

sort($toDelete, SORT_NATURAL | SORT_FLAG_CASE);

$logFile = $rootDir . DIRECTORY_SEPARATOR . 'images_to_delete.txt';
file_put_contents($logFile, implode(PHP_EOL, $toDelete) . (count($toDelete) ? PHP_EOL : ''));

$deleted = 0;
$skipped = 0;
$errors = 0;

$realRoot = realpath($rootDir) ?: $rootDir;
foreach ($toDelete as $relPath) {
	$relPathNormalized = normalizeSeparators($relPath);
	$ext = strtolower(pathinfo($relPathNormalized, PATHINFO_EXTENSION));
	if (!in_array($ext, $allowedExtensions, true)) {
		$skipped++;
		continue;
	}
	$fsPath = $rootDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relPathNormalized);
	$realFile = realpath($fsPath);
	if ($realFile === false || strncasecmp(normalizeSeparators($realFile), normalizeSeparators($realRoot), strlen($realRoot)) !== 0) {
		$skipped++;
		continue;
	}
	if (!is_file($realFile)) {
		$skipped++;
		continue;
	}
	if ($apply) {
		if (@unlink($realFile)) {
			$deleted++;
		} else {
			$errors++;
		}
	}
}

echo "Найдено к удалению: " . count($toDelete) . PHP_EOL;
echo "Пропущено (не подходит под правила/нет файла): {$skipped}" . PHP_EOL;
echo $apply ? "Удалено: {$deleted}\nОшибок: {$errors}" . PHP_EOL : "DRY-RUN. Ничего не удалялось. Для удаления запустите: php .\\prune_images.php --apply" . PHP_EOL;
