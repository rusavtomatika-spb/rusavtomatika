<?php
declare(strict_types=1);

// Сравнивает images.txt (локальный проект) и images2.txt (версия с сайта)
// Формирует списки добавления/удаления и генерирует PowerShell-скрипт
// для поэтапного применения изменений в git (батчами < 8000 файлов на коммит).

$rootDir = __DIR__;
$fileA = $rootDir . DIRECTORY_SEPARATOR . 'images.txt';
$fileB = $rootDir . DIRECTORY_SEPARATOR . 'images2.txt';

if (!is_file($fileA)) {
	fwrite(STDERR, "Не найден файл: {$fileA}" . PHP_EOL);
	exit(1);
}
if (!is_file($fileB)) {
	fwrite(STDERR, "Не найден файл: {$fileB}" . PHP_EOL);
	exit(1);
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

function readImageList(string $path): array {
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
		if (preg_match('~^[A-Za-z]:/~', $line) === 1) {
			$parts = explode('/', $line, 10);
			array_shift($parts);
			$line = implode('/', $parts);
		}
		$items[] = ltrim($line, '/');
	}
	return $items;
}

try {
	$listA = readImageList($fileA);
	$listB = readImageList($fileB);
} catch (Throwable $e) {
	fwrite(STDERR, $e->getMessage() . PHP_EOL);
	exit(1);
}

$setA = array_fill_keys($listA, true);
$setB = array_fill_keys($listB, true);

$toAdd = [];
$toRemove = [];

foreach ($setB as $path => $_) {
	if (!isset($setA[$path])) {
		$toAdd[] = $path;
	}
}
foreach ($setA as $path => $_) {
	if (!isset($setB[$path])) {
		$toRemove[] = $path;
	}
}

sort($toAdd, SORT_NATURAL | SORT_FLAG_CASE);
sort($toRemove, SORT_NATURAL | SORT_FLAG_CASE);

$addFile = $rootDir . DIRECTORY_SEPARATOR . 'images_to_add.txt';
$removeFile = $rootDir . DIRECTORY_SEPARATOR . 'images_to_remove.txt';
$missingLocalFile = $rootDir . DIRECTORY_SEPARATOR . 'images_missing_locally.txt';

file_put_contents($addFile, implode(PHP_EOL, $toAdd) . (count($toAdd) ? PHP_EOL : ''));
file_put_contents($removeFile, implode(PHP_EOL, $toRemove) . (count($toRemove) ? PHP_EOL : ''));

$missing = [];
$existingToAdd = [];
foreach ($toAdd as $path) {
	$fsPath = $rootDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
	if (is_file($fsPath)) {
		$existingToAdd[] = $path;
	} else {
		$missing[] = $path;
	}
}
file_put_contents($missingLocalFile, implode(PHP_EOL, $missing) . (count($missing) ? PHP_EOL : ''));

$ps1 = [];
$ps1[] = '# Автогенерированный скрипт. Запускайте из корня репозитория PowerShell: powershell -ExecutionPolicy Bypass -File .\\git_sync_images.ps1';
$ps1[] = '$ErrorActionPreference = "Stop"';
$ps1[] = '';
$ps1[] = '$repoRoot = Split-Path -Parent $MyInvocation.MyCommand.Path';
$ps1[] = 'Set-Location $repoRoot';
$ps1[] = '';
$ps1[] = '$batchSize = 8000';
$ps1[] = '';
$ps1[] = '# Файлы для добавления (которые реально существуют локально)';
$ps1[] = '$toAdd = @()';
foreach ($existingToAdd as $p) {
	$ps1[] = '$toAdd += ' . json_encode($p, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ';';
}
$ps1[] = '';
$ps1[] = '# Файлы для удаления из гита (untrack, оставить в рабочей копии)';
$ps1[] = '$toRemove = @()';
foreach ($toRemove as $p) {
	$ps1[] = '$toRemove += ' . json_encode($p, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ';';
}
$ps1[] = '';
$ps1[] = 'function Commit-InBatches($items, $op) {';
$ps1[] = '	if ($items.Count -eq 0) { return }';
$ps1[] = '	$idx = 0';
$ps1[] = '	while ($idx -lt $items.Count) {';
$ps1[] = '		$chunk = $items[$idx..([Math]::Min($idx + $batchSize - 1, $items.Count - 1))]';
$ps1[] = '		foreach ($f in $chunk) {';
$ps1[] = '			if ($op -eq "add") {';
$ps1[] = '				git add -f -- "$f"';
$ps1[] = '			} elseif ($op -eq "rmcached") {';
$ps1[] = '				# Снимем из индекса, если файл отслеживается';
$ps1[] = '				# Используем git rm --cached, чтобы не удалять файл из рабочей директории';
$ps1[] = '				git rm --cached --ignore-unmatch -- "$f"';
$ps1[] = '			}';
$ps1[] = '		}';
$ps1[] = '		if ($op -eq "add") {';
$ps1[] = '			git commit -m ("add images batch [" + ($idx+1) + ".." + ([Math]::Min($idx + $batchSize, $items.Count)) + "]") | Out-Null';
$ps1[] = '		} elseif ($op -eq "rmcached") {';
$ps1[] = '			git commit -m ("untrack extra images batch [" + ($idx+1) + ".." + ([Math]::Min($idx + $batchSize, $items.Count)) + "]") | Out-Null';
$ps1[] = '		}';
$ps1[] = '		$idx += $batchSize';
$ps1[] = '	}';
$ps1[] = '}';
$ps1[] = '';
$ps1[] = 'Write-Host "Добавление новых изображений (" $toAdd.Count ") батчами по $batchSize" -ForegroundColor Cyan';
$ps1[] = 'Commit-InBatches $toAdd "add"';
$ps1[] = '';
$ps1[] = 'Write-Host "Снятие из индекса лишних изображений (" $toRemove.Count ") батчами по $batchSize" -ForegroundColor Cyan';
$ps1[] = 'Commit-InBatches $toRemove "rmcached"';
$ps1[] = '';
$ps1[] = 'Write-Host "Готово. Проверьте коммиты и выполните git push." -ForegroundColor Green';

$ps1Path = $rootDir . DIRECTORY_SEPARATOR . 'git_sync_images.ps1';
file_put_contents($ps1Path, implode(PHP_EOL, $ps1) . PHP_EOL);

$summary = [];
$summary[] = 'Источник A (images.txt): ' . count($listA);
$summary[] = 'Источник B (images2.txt): ' . count($listB);
$summary[] = 'К добавлению: ' . count($toAdd) . ' (существуют локально: ' . count($existingToAdd) . ', отсутствуют локально: ' . count($missing) . ')';
$summary[] = 'К снятию из индекса: ' . count($toRemove);
$summary[] = 'Файлы:';
$summary[] = ' - ' . $addFile;
$summary[] = ' - ' . $removeFile;
$summary[] = ' - ' . $missingLocalFile;
$summary[] = 'Скрипт:';
$summary[] = ' - ' . $ps1Path;

echo implode(PHP_EOL, $summary) . PHP_EOL;
