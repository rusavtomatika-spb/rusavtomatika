<?php
declare(strict_types=1);

// Безопасная уборка проекта: находит и удаляет мусорные/временные/генерируемые файлы и папки.
// По умолчанию DRY-RUN: ничего не удаляет, только отчёт. Для удаления: --apply
// Можно дополнять списки паттернов ниже.

$rootDir = __DIR__;
$apply = in_array('--apply', $argv ?? [], true);

$dirNamePatterns = [
	'__MACOSX',
	'.DS_Store',
	'.Trash',
	'.idea',
	'.vscode',
	'node_modules',
	'coverage',
	'.nyc_output',
	'.sass-cache',
	'.cache',
	'cache',
	'.pytest_cache',
	'.venv',
	'build',
	'dist',
	'tmp',
	'log',
	'logs',
	'.history',
];

$fileExtPatterns = [
	'*.log', 'error_log', '*.tmp', '*.temp', '*.bak', '*.old', '*.orig',
	'*.swp', '*.swo', '*.DS_Store', 'Thumbs.db', 'desktop.ini',
	'*.map',
];

$pathGlobs = [
	$rootDir . DIRECTORY_SEPARATOR . 'download' . DIRECTORY_SEPARATOR . 'php.mail.log',
	$rootDir . DIRECTORY_SEPARATOR . 'ajax' . DIRECTORY_SEPARATOR . '_php.mail.log',
	$rootDir . DIRECTORY_SEPARATOR . '**' . DIRECTORY_SEPARATOR . 'error_log',
	$rootDir . DIRECTORY_SEPARATOR . '**' . DIRECTORY_SEPARATOR . '*.log',
];

$safeRoots = [
	'repo' => [
		$rootDir . DIRECTORY_SEPARATOR . 'abacus',
		$rootDir . DIRECTORY_SEPARATOR . 'core',
		$rootDir . DIRECTORY_SEPARATOR . 'cms',
		$rootDir . DIRECTORY_SEPARATOR . 'js',
		$rootDir . DIRECTORY_SEPARATOR . 'css',
		$rootDir . DIRECTORY_SEPARATOR . 'images',
		$rootDir . DIRECTORY_SEPARATOR . 'include',
		$rootDir . DIRECTORY_SEPARATOR . 'include_utf_8',
	],
];

function norm(string $p): string { return str_replace('\\', '/', $p); }

function isUnderSafeRoots(string $path, array $safeRoots): bool {
	$pathN = norm($path);
	foreach ($safeRoots['repo'] as $safe) {
		$safeN = norm($safe);
		if (stripos($pathN, rtrim($safeN, '/') . '/') === 0) {
			return true;
		}
	}
	return false;
}

$toDeleteFiles = [];
$toDeleteDirs = [];

$iterator = new RecursiveIteratorIterator(
	new RecursiveDirectoryIterator($rootDir, FilesystemIterator::SKIP_DOTS),
	RecursiveIteratorIterator::CHILD_FIRST
);

foreach ($iterator as $info) {
	$path = $info->getPathname();
	$base = $info->getFilename();
	$pathN = norm($path);

	if (stripos($pathN, norm($rootDir . '/.git/')) === 0) continue;
	if ($path === __FILE__) continue;

	if ($info->isDir()) {
		foreach ($dirNamePatterns as $dn) {
			if (strcasecmp($base, $dn) === 0) {
				if (!isUnderSafeRoots($path, $safeRoots)) {
					$toDeleteDirs[] = $path;
				}
				break;
			}
		}
		continue;
	}

	foreach ($fileExtPatterns as $pat) {
		$regex = '/^' . str_replace(['*', '.'], ['.*', '\.'], $pat) . '$/i';
		if (preg_match($regex, $base)) {
			$toDeleteFiles[] = $path;
			break;
		}
	}
}

foreach ($pathGlobs as $g) {
	if (strpos($g, '**') !== false) {
		[$before, $after] = explode('**', $g, 2);
		$before = rtrim($before, DIRECTORY_SEPARATOR);
		$after = ltrim($after, DIRECTORY_SEPARATOR);
		$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($before, FilesystemIterator::SKIP_DOTS));
		foreach ($rii as $fi) {
			if (!$fi->isFile()) continue;
			$pp = norm($fi->getPathname());
			$mask = str_replace(['*', '.'], ['.*', '\.'], norm($after));
			if (preg_match('/' . $mask . '$/i', $pp)) {
				$toDeleteFiles[] = $fi->getPathname();
			}
		}
	} else {
		if (is_file($g)) $toDeleteFiles[] = $g;
	}
}

$toDeleteFiles = array_values(array_unique($toDeleteFiles));
$toDeleteDirs = array_values(array_unique($toDeleteDirs));

sort($toDeleteFiles, SORT_NATURAL | SORT_FLAG_CASE);
sort($toDeleteDirs, SORT_NATURAL | SORT_FLAG_CASE);

$deletedFiles = 0; $deletedDirs = 0; $errors = 0;
if ($apply) {
	foreach ($toDeleteFiles as $f) {
		if (@unlink($f)) { $deletedFiles++; } else { $errors++; }
	}
	usort($toDeleteDirs, function($a,$b){ return strlen($b) <=> strlen($a); });
	foreach ($toDeleteDirs as $d) {
		@chmod($d, 0777);
		if (@rmdir($d)) { $deletedDirs++; } else {}
	}
}

$report = [];
$report[] = 'DRY-RUN: ' . ($apply ? 'нет' : 'да');
$report[] = 'Файлов на удаление: ' . count($toDeleteFiles);
$report[] = 'Папок на удаление: ' . count($toDeleteDirs);
$report[] = 'Удалено файлов: ' . $deletedFiles;
$report[] = 'Удалено папок: ' . $deletedDirs;
$report[] = 'Ошибок: ' . $errors;

file_put_contents($rootDir . DIRECTORY_SEPARATOR . 'cleanup_report.txt', implode(PHP_EOL, $report) . PHP_EOL);
file_put_contents($rootDir . DIRECTORY_SEPARATOR . 'cleanup_files.txt', implode(PHP_EOL, $toDeleteFiles) . (count($toDeleteFiles) ? PHP_EOL : ''));
file_put_contents($rootDir . DIRECTORY_SEPARATOR . 'cleanup_dirs.txt', implode(PHP_EOL, $toDeleteDirs) . (count($toDeleteDirs) ? PHP_EOL : ''));

echo implode(PHP_EOL, $report) . PHP_EOL;

echo $apply
	? ''
	: "Для удаления выполните: php .\\cleanup_project.php --apply" . PHP_EOL;
