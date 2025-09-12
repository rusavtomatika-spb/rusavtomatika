<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>
	<?
ini_set( 'max_execution_time', 2500 );
file_put_contents( $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents/ra/error_log", "" );
$rootPath = realpath( $_SERVER[ 'DOCUMENT_ROOT' ] );
$arc_name = "20231128.zip";
	?>
Архивируем каталог: <? echo $rootPath; ?><br>
Получаем: <a href="/documents/ra/.<? echo $arc_name; ?>."></a><br>

<form id="frm" method="post"  action="?action" >
  <input type="submit" value="НАЧАТЬ ОБНОВЛЕНИЕ" id="submit" />
</form>
<?php
if ( isset( $_GET[ 'action' ] ) ) {
// Initialize archive object
$zip = new ZipArchive();
$zip->open( $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/ra/'.$arc_name, ZipArchive::CREATE | ZipArchive::OVERWRITE );

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator( $rootPath ),
  RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ( $files as $name => $file ) {
  // Skip directories (they would be added automatically)
  if ( !$file->isDir() ) {
    // Get real and relative path for current file
    $filePath = $file->getRealPath();
    $relativePath = substr( $filePath, strlen( $rootPath ) + 1 );

    // Add current file to archive
    $zip->addFile( $filePath, $relativePath );
  }
}

// Zip archive will be created only after closing object
$zip->close();
echo "done";
}
?>
</body>
</html>