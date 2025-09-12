<?php
$config = [
    'image_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'webm'],
    'output_file' => 'generated_images.txt',
    'min_size' => 1024,
    'max_size' => 10 * 1024 * 1024,
];

$patterns = [
    'name_patterns' => [
        '/thumb/', '/thumbnail/', '/cache/', '/temp/', '/tmp/', 
        '/resized/', '/scaled/', '/minified/', '/optimized/',
        '/generated/', '/preview/', '/watermark/', '/copy/',
        '/_\d+x\d+/',
        '/-\d+x\d+/',
        '/_w\d+/', '/_h\d+/',
        '/\d{8,}/',
        '/^temp_/', '/^tmp_/', '/^cache_/',
        '/\.min\./', '/\.optimized\./',
    ],
    
    'path_patterns' => [
        '/\/thumb\//', '/\/thumbs\//', '/\/cache\//', '/\/temp\//', '/\/tmp\//',
        '/\/resized\//', '/\/generated\//', '/\/preview\//', '/\/watermark\//',
        '/\/uploads\//', '/\/upload\//', '/\/user_files\//', '/\/user_upload\//',
        '/\/image_cache\//', '/\/image_temp\//',
    ],
    
    'exceptions' => [
        '/logo/', '/icon/', '/favicon/', '/background/', 
        '/header/', '/footer/', '/sprite/', '/pattern/',
        '/assets/', '/img/', '/images/', '/media/',
    ]
];

function is_generated_image($filepath, $patterns) {
    $filename = basename($filepath);
    $path = dirname($filepath);
    
    foreach ($patterns['exceptions'] as $exception) {
        if (preg_match($exception, $filepath)) {
            return false;
        }
    }
    
    foreach ($patterns['name_patterns'] as $pattern) {
        if (preg_match($pattern, $filename)) {
            return true;
        }
    }
    
    foreach ($patterns['path_patterns'] as $pattern) {
        if (preg_match($pattern, $filepath)) {
            return true;
        }
    }
    
    $size = filesize($filepath);
    if ($size < $config['min_size'] || $size > $config['max_size']) {
        return true;
    }
    
    $filetime = filemtime($filepath);
    $age_days = (time() - $filetime) / (60 * 60 * 24);
    if ($age_days < 7) {
        if (preg_match('/\d{8,}/', $filename) || preg_match('/_\\d+x\\d+/', $filename)) {
            return true;
        }
    }
    
    return false;
}

echo "Поиск JPG/JPEG изображений...\n";

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator('.', RecursiveDirectoryIterator::SKIP_DOTS)
);

$generated_images = [];
$total_count = 0;

foreach ($files as $file) {
    if ($file->isFile()) {
        $ext = strtolower(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
        if (in_array($ext, $config['image_extensions'])) {
            $total_count++;
            $filepath = $file->getPathname();
            
            if (is_generated_image($filepath, $patterns)) {
                $generated_images[] = $filepath;
                echo "G: $filepath\n";
            } else {
                echo "K: $filepath\n";
            }
        }
    }
}

file_put_contents($config['output_file'], implode("\n", $generated_images));

echo "\n=== РЕЗУЛЬТАТЫ ===\n";
echo "Всего JPG/JPEG: $total_count\n";
echo "Генерируемых/временных: " . count($generated_images) . "\n";
echo "Постоянных: " . ($total_count - count($generated_images)) . "\n";
echo "Список генерируемых сохранен в: " . $config['output_file'] . "\n";

$gitignore_lines = [];
foreach ($generated_images as $image) {
    $gitignore_lines[] = $image;
}

file_put_contents('image_gitignore.txt', implode("\n", $gitignore_lines));
echo "Правила для .gitignore сохранены в: image_gitignore.txt\n";