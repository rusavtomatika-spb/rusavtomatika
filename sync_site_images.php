<?php
declare(strict_types=1);

// Синхронизирует изображения из images2.txt с сайтом https://www.rusavtomatika.com
// Правила:
// - Поддерживает строки вида @https://..., https://..., /site/path, а также абсолютные пути под корнем из заголовка
// - Всегда сохраняет по относительному пути, равному пути на сайте (без домена)
// - Удаляет ошибочные префиксы-директории вроде www.rusavtomatika.com/ или rusavtomatika.com/
// - Создаёт каталоги, делает ретраи, пропускает существующие файлы, если --skip-existing
// - DRY-RUN по умолчанию; для применения добавьте --apply

$projectRoot = __DIR__;
$images2Path = $projectRoot . DIRECTORY_SEPARATOR . 'images2.txt';
if (!is_file($images2Path)) { fwrite(STDERR, "Не найден файл: {$images2Path}" . PHP_EOL); exit(1); }

// Параметры
$apply = false;
$baseUrl = 'https://www.rusavtomatika.com';
$maxRetries = 3;
$timeoutSec = 25;
$skipExisting = false;
$stripRootOverride = '';

foreach ($argv as $arg) {
	if ($arg === '--apply') { $apply = true; }
	if ($arg === '--skip-existing') { $skipExisting = true; }
	if (str_starts_with($arg, '--base-url=')) { $baseUrl = rtrim(substr($arg, 11), '/'); }
	if (str_starts_with($arg, '--retries=')) { $maxRetries = max(0, (int)substr($arg, 10)); }
	if (str_starts_with($arg, '--timeout=')) { $timeoutSec = max(1, (int)substr($arg, 10)); }
	if (str_starts_with($arg, '--strip-root=')) { $stripRootOverride = rtrim(substr($arg, 13), '/'); }
}

function norm(string $s): string { return str_replace('\\', '/', $s); }
function isUrl(string $s): bool { return preg_match('~^@?https?://~i', $s) === 1; }
function isDrivePath(string $s): bool { return preg_match('~^[A-Za-z]:/~', $s) === 1; }

function readListAndDeclaredRoot(string $file): array {
	$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	if ($lines === false) { throw new RuntimeException('read fail'); }
	$declaredRoot = '';
	$start = 0;
	foreach ($lines as $i => $line) {
		if ($declaredRoot === '' && mb_stripos($line, 'Корень проекта:') !== false) {
			$declaredRoot = trim((string)preg_replace('~^.*?:~u', '', $line));
			$declaredRoot = trim($declaredRoot);
		}
		if (mb_stripos($line, 'Список файлов:') !== false) { $start = $i + 1; break; }
	}
	$out = [];
	for ($i = $start; $i < count($lines); $i++) { $line = trim($lines[$i]); if ($line === '' || str_starts_with($line, '#')) continue; $out[] = $line; }
	return [$declaredRoot, $out];
}

function toRelativeFromUrl(string $url): ?string {
	$url = ltrim($url, '@');
	$p = parse_url($url); if (!$p || empty($p['path'])) return null; return ltrim($p['path'], '/');
}
function toRelativeFromSitePath(string $path): ?string {
	$path = norm($path); if (!str_starts_with($path, '/')) return null; return ltrim($path, '/');
}
function stripLeadingHostDir(string $rel, string $baseUrl): string {
	$rel = ltrim(norm($rel), '/');
	$host = parse_url($baseUrl, PHP_URL_HOST) ?: '';
	$noWww = preg_replace('/^www\./i', '', $host);
	$cands = array_values(array_unique(array_filter([$host, $noWww, $noWww ? ('www.' . $noWww) : null])));
	foreach ($cands as $h) { if ($h && strncasecmp($rel, $h . '/', strlen($h) + 1) === 0) { return substr($rel, strlen($h) + 1); } }
	return $rel;
}
function stripPrefixInsensitive(string $path, string $prefix): string {
	$pathN = norm($path); $prefixN = rtrim(norm($prefix), '/');
	if ($prefixN !== '' && strncasecmp($pathN, $prefixN . '/', strlen($prefixN) + 1) === 0) {
		return substr($pathN, strlen($prefixN) + 1);
	}
	return $pathN;
}

function httpFetch(string $url, int $timeoutSec, int $maxRetries): ?string {
	$ctx = stream_context_create([
		'http' => [ 'method' => 'GET', 'header' => "User-Agent: Mozilla/5.0\r\nAccept: */*\r\n", 'timeout' => $timeoutSec, 'ignore_errors' => true ],
		'https'=> [ 'method' => 'GET', 'header' => "User-Agent: Mozilla/5.0\r\nAccept: */*\r\n", 'timeout' => $timeoutSec, 'ignore_errors' => true ],
	]);
	for ($i = 0; $i <= $maxRetries; $i++) { $data = @file_get_contents($url, false, $ctx); if ($data !== false && $data !== '') return $data; usleep(200000); }
	return null;
}

[$declaredRoot, $list] = readListAndDeclaredRoot($images2Path);
$declaredRootN = norm($declaredRoot);
$stripRootN = $stripRootOverride !== '' ? norm($stripRootOverride) : $declaredRootN;

$total = 0; $downloaded = 0; $skipped = 0; $errors = 0; $notFound = 0; $already = 0;
$logDownloaded = []; $logSkipped = []; $logErrors = []; $logNotFound = []; $logAlready = [];

foreach ($list as $entry) {
	$total++;
	$entryN = norm($entry);
	$rel = null; $url = null;

	if (isUrl($entryN)) {
		$url = ltrim($entryN, '@');
		$rel = toRelativeFromUrl($url);
	} elseif (str_starts_with($entryN, '/')) {
		$rel = toRelativeFromSitePath($entryN);
		$url = rtrim($baseUrl, '/') . '/' . $rel;
	} elseif (isDrivePath($entryN) && $stripRootN !== '') {
		$rel = ltrim(stripPrefixInsensitive($entryN, $stripRootN), '/');
		if ($rel !== '') { $url = rtrim($baseUrl, '/') . '/' . $rel; }
	}

	if (!$rel) { $skipped++; $logSkipped[] = $entry; continue; }
	$rel = stripLeadingHostDir($rel, $baseUrl);

	$dst = $projectRoot . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel);
	$dstDir = dirname($dst);
	if ($skipExisting && is_file($dst)) { $already++; $logAlready[] = $rel; continue; }
	if ($apply) {
		if (!is_dir($dstDir)) { if (!@mkdir($dstDir, 0777, true) && !is_dir($dstDir)) { $errors++; $logErrors[] = "mkdir: {$dstDir}"; continue; } }
		if (!$url) { $skipped++; $logSkipped[] = $entry; continue; }
		$data = httpFetch($url, $timeoutSec, $maxRetries);
		if ($data === null) { $notFound++; $logNotFound[] = $url; continue; }
		if (@file_put_contents($dst, $data) !== false) { $downloaded++; $logDownloaded[] = $rel; }
		else { $errors++; $logErrors[] = $dst; }
	} else {
		$logSkipped[] = $entry . ' -> ' . $rel;
	}
}

file_put_contents($projectRoot . DIRECTORY_SEPARATOR . 'sync_downloaded.txt', implode(PHP_EOL, $logDownloaded) . (count($logDownloaded) ? PHP_EOL : ''));
file_put_contents($projectRoot . DIRECTORY_SEPARATOR . 'sync_skipped.txt', implode(PHP_EOL, $logSkipped) . (count($logSkipped) ? PHP_EOL : ''));
file_put_contents($projectRoot . DIRECTORY_SEPARATOR . 'sync_errors.txt', implode(PHP_EOL, $logErrors) . (count($logErrors) ? PHP_EOL : ''));
file_put_contents($projectRoot . DIRECTORY_SEPARATOR . 'sync_not_found.txt', implode(PHP_EOL, $logNotFound) . (count($logNotFound) ? PHP_EOL : ''));
file_put_contents($projectRoot . DIRECTORY_SEPARATOR . 'sync_already.txt', implode(PHP_EOL, $logAlready) . (count($logAlready) ? PHP_EOL : ''));

echo "Всего: {$total}" . PHP_EOL;
echo "Скачано: {$downloaded}\nУже были (пропущены): {$already}\nНе найдено/HTTP: {$notFound}\nОшибок: {$errors}\nПропущено: {$skipped}" . PHP_EOL;
