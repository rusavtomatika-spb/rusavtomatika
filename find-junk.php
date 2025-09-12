<?php
$junk_patterns = [
  '/\.tmp$/i', '/\.temp$/i', '/~$/i', '/\.bak$/i', '/\.backup$/i',
  '/\.old$/i', '/\.swp$/i', '/\.swo$/i',
  
  '/Thumbs\.db$/i', '/\.DS_Store$/i', '/desktop.ini/i', '/.htaccess/i',
  
  '/\.log$/i', '/error_log$/i', '/access_log$/i',
  '/\/cache\//i', '/\/temp\//i', '/\/tmp\//i',
  '/\/logs\//i',
  
  '/\.zip$/i', '/\.rar$/i', '/\.7z$/i', '/\.tar\.gz$/i',
  '/backup/i', '_backup',
  
  '/\.idea\//i', '/\.vscode\//i', '/\.project$/i',
  '/\.settings\//i',
  
  '/\.exe$/i', '/\.dll$/i', '/\.so$/i', '/\.pdf$/i',
  '/\.psd$/i', '/\.ai$/i',
  
  '/\.mp3$/i', '/\.mp4$/i', '/\.avi$/i', '/\.mov$/i',
  '/\.jpg$/i', '/\.jpeg$/i', '/\.png$/i', '/\.gif$/i',
];

function find_junk_files($dir, $patterns) {
  $junk_files = [];
  $files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
  );
  
  foreach ($files as $file) {
    if ($file->isFile()) {
      $path = $file->getPathname();
      foreach ($patterns as $pattern) {
        if (preg_match($pattern, $path)) {
            $junk_files[] = $path;
            break;
        }
      }
      
      if ($file->getSize() > 10 * 1024 * 1024) {
        $junk_files[] = $path . " [SIZE: " . round($file->getSize() / 1024 / 1024, 2) . "MB]";
      }
    }
  }
  
  return $junk_files;
}

echo "Поиск мусорных файлов...\n";
$junk_files = find_junk_files('.', $junk_patterns);

file_put_contents('junk-files.txt', implode("\n", $junk_files));
echo "Найдено " . count($junk_files) . " потенциально мусорных файлов\n";
echo "Список сохранен в junk-files.txt\n";