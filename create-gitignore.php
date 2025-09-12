<?php
$junk_files = file('junk-files.txt', FILE_IGNORE_NEW_LINES);
$gitignore = [];

foreach ($junk_files as $file) {
    $file = preg_replace('/\s+\[SIZE:.*\]$/', '', $file);
    $file = str_replace(['./', '.\\'], '/', $file);
    $file = str_replace('\\', '/', $file);
    $gitignore[] = $file;
}

$gitignore_content = implode("\n", array_unique($gitignore));
file_put_contents('.gitignore', $gitignore_content);
echo ".gitignore создан с правильными путями (без ./)\n";