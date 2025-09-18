<?php
declare(strict_types=1);

// Восстанавливает изображения из проекта, скачанного парсером, в текущий гит-проект.
// Источник: images2.txt (из парсера). Назначение: текущий каталог (__DIR__).
// По умолчанию пытается определить корень источника из заголовка "Корень проекта:" в images2.txt.
// Можно переопределить корень источника ключом --src-root="D:/projects/test/www.rusavtomatika.com".
// Есть DRY-RUN (по умолчанию). Для реального копирования добавьте --apply.

$targetRoot = __DIR__;
$images2Path = $targetRoot . DIRECTORY_SEPARATOR . 'images2.txt';

if (!is_file($images2Path)) {
	fwrite(STDERR, "Не найден файл: {$images2Path}" . PHP_EOL);
	exit(1);
}

$apply = false;
$srcRootOverride = '';
foreach ($argv as $arg) {
	if ($arg === '--apply') { $apply = true; }
	if (str_starts_with($arg, '--src-root=')) {
		$srcRootOverride = substr($arg, strlen('--src-root='));
	}
}

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

function readImages2AndDetectRoot(string $file): array {
	$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	if ($lines === false) {
		throw new RuntimeException("Не удалось прочитать файл: {$file}");
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
		if ($line === '' || str_starts_with($line, '#')) { continue; }
		$items[] = $line;
	}
	return [$declaredRoot, $items];
}

try {
	[$declaredSrcRoot, $srcAbsoluteList] = readImages2AndDetectRoot($images2Path);
} catch (Throwable $e) {
	fwrite(STDERR, $e->getMessage() . PHP_EOL);
	exit(1);
}

$sourceRoot = $srcRootOverride !== '' ? $srcRootOverride : $declaredSrcRoot;
if ($sourceRoot === '') {
	fwrite(STDERR, "Не удалось определить корень источника из images2.txt. Укажите --src-root=ABS_PATH" . PHP_EOL);
	exit(1);
}

$sourceRootN = normalizeSeparators($sourceRoot);
$targetRootN = normalizeSeparators($targetRoot);

$total = 0;
$copied = 0;
$missing = 0;
$skipped = 0;
$errors = 0;

$missingList = [];
$copiedList = [];
$skippedList = [];
$errorList = [];

foreach ($srcAbsoluteList as $absPath) {
	$total++;
	$absPathN = normalizeSeparators($absPath);
	$rel = stripPrefixInsensitive($absPathN, $sourceRootN);
	$rel = ltrim($rel, '/');
	if ($rel === '' || str_contains($rel, "..")) {
		$skipped++; $skippedList[] = $absPath; continue;
	}
	$src = $sourceRootN . '/' . $rel;
	$dst = $targetRootN . '/' . $rel;
	$srcFs = str_replace('/', DIRECTORY_SEPARATOR, $src);
	$dstFs = str_replace('/', DIRECTORY_SEPARATOR, $dst);
	if (!is_file($srcFs)) {
		$missing++; $missingList[] = $srcFs; continue;
	}
	$dstDir = dirname($dstFs);
	if (!is_dir($dstDir)) {
		if ($apply) {
			if (!@mkdir($dstDir, 0777, true) && !is_dir($dstDir)) {
				$errors++; $errorList[] = "mkdir: {$dstDir}"; continue;
			}
		}
	}
	if ($apply) {
		if (@copy($srcFs, $dstFs)) {
			$mtime = @filemtime($srcFs);
			if ($mtime !== false) { @touch($dstFs, $mtime); }
			$copied++; $copiedList[] = $dstFs;
		} else {
			$errors++; $errorList[] = $dstFs; 
		}
	}
}

file_put_contents($targetRoot . DIRECTORY_SEPARATOR . 'restore_missing_from_images2.txt', implode(PHP_EOL, $missingList) . (count($missingList) ? PHP_EOL : ''));
file_put_contents($targetRoot . DIRECTORY_SEPARATOR . 'restored_files.txt', implode(PHP_EOL, $copiedList) . (count($copiedList) ? PHP_EOL : ''));
file_put_contents($targetRoot . DIRECTORY_SEPARATOR . 'restore_skipped.txt', implode(PHP_EOL, $skippedList) . (count($skippedList) ? PHP_EOL : ''));
file_put_contents($targetRoot . DIRECTORY_SEPARATOR . 'restore_errors.txt', implode(PHP_EOL, $errorList) . (count($errorList) ? PHP_EOL : ''));

echo "Всего записей: {$total}" . PHP_EOL;
echo "Отсутствуют в источнике: {$missing}" . PHP_EOL;
echo "Пропущено (невалидные пути): {$skipped}" . PHP_EOL;
echo $apply 
	? "Скопировано: {$copied}\nОшибок копирования: {$errors}" . PHP_EOL 
	: "DRY-RUN. Ничего не копировалось. Для копирования запустите: php .\\restore_images.php --apply --src-root=ABS_PATH" . PHP_EOL;
