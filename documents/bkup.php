<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Создание резервной копии сайта на moisait</title>
</head>

<body>
<h1>Создание резервной копии сайта</h1>
<form id="frm" method="post"  action="?action" >
  <input type="submit" value="СОЗДАТЬ БЭКАП файлов и БД" id="submit" />
</form>
	
	<br><hr><br>Поэтапно:<br>
<form id="frm" method="post"  action="?files" >
<p>укажите имя папки от корня: <br>
rusavto<br>
 или weintek, например</p>	<br>
	<input type="text" id="folder" name="folder" required><br><br>
  <input type="submit" value="Бэкап файлов" id="submit" />
</form>
<br>
<br>
<form id="frm" method="post"  action="?db" >
<p>укажите имя БД: <br>
moisait_ra<br>moisait_weintek1<br>
</p>	<br>
	<input type="text" id="db" name="db" required><br><br>
  <input type="submit" value="Бэкап БД" id="submit" />
</form>
<br>
<br>

<?php
  file_put_contents( $docs_folder . "error_log", "" );
  ini_set( 'max_execution_time', 4600 );
  ini_set( 'memory_limit', '1024M' );
ini_set( "error_reporting", E_ALL);
//ini_set( "error_reporting", E_ALL | E_WARNING | E_NOTICE );
ini_set( "display_errors", 1 );
ini_set( "display_startup_errors", 1 );

  function addMessageLine( $m ) {
    global $BackupPath,$SitePath;

    $log = $BackupPath . "backupLog.txt";
    $message = $m . " ... " . date( "Y-m-d H:i:s" ) . "<br>\r\n";
    //echo $message;
    file_put_contents( $log, $message . PHP_EOL, FILE_APPEND | LOCK_EX );
  }

  function db_backup( $DBUSER, $DBPASSWD, $DATABASE, $DBFilename ) {
    $cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE | gzip --best > $DBFilename";
    shell_exec( $cmd );
  }

  function Zip( $source, $destination ) {
    global $exclude,$SitePath;
    if ( !extension_loaded( 'zip' ) || !file_exists( $source ) ) {
      addMessageLine( "zip extension надо бы" );
      return false;
    }

    $zip = new ZipArchive();
    if ( !$zip->open( $destination, ZipArchive::CREATE | ZipArchive::OVERWRITE ) ) {
      addMessageLine( "Не могу создать файл: $destination" );
      return false;
    }
    $source = str_replace( '\\', '/', realpath( $source ) );

    if ( is_dir( $source ) === true ) {
      $files = new RecursiveIteratorIterator(
        new RecursiveCallbackFilterIterator(
          new RecursiveDirectoryIterator(
            $source,
            RecursiveDirectoryIterator::SKIP_DOTS
          ),
          function ( $files, $key, $iterator )use( $exclude ) {

            return !( in_array( $files->getPath() . "/" . $files->getFilename(), $exclude ) );
          }
        ),
        RecursiveIteratorIterator::SELF_FIRST
      );


      foreach ( $files as $name => $file ) {
        if ( !$file->isDir() ) {
          addMessageLine( "zipping: $file " );
          $filePath = $file->getRealPath();
          $relativePath = substr( $filePath, strlen( $SitePath ) + 1 );

          $zip->addFile( $filePath, $relativePath );
        }
      }


    } else if ( is_file( $source ) === true ) {
      $zip->addFromString( basename( $source ), file_get_contents( $source ) );
    }
    return $zip->close();
  }
  (isset($_POST['folder'])) ? $SitePath = '/home/moisait/public_html/'.$_POST['folder'].'/' : exit();
  $BackupPath = "/home/moisait/public_html/backups/".$_POST['folder']."/";
  $site_arc_fn = 'site_'.$_POST['folder'].'_' . date( "H-i" ) . '.zip';

  $DBUSER = "root";
  $DBPASSWD = "123456";
  $DATABASE = "rusavtomatika_db";

  $exclude = [
    '/home/username/public_html/xyz',
  ];

  if ( !is_dir( $BackupPath ) ) {
    mkdir( $BackupPath, 0777, true );
  }

  $day = date( "Y-m-d" );
  if ( !is_dir( $BackupPath . "$day/" ) ) {
    mkdir( $BackupPath . "$day/", 0777, true );
  }
  $BackupPath .= "$day/";
if ( isset( $_GET[ 'files' ] ) ) {
  isset($_POST['folder']) ? $SitePath = '/home/moisait/public_html/'.$_POST['folder'].'/' : exit();
  //$SitePath = $_SERVER[ 'DOCUMENT_ROOT' ] . '/';
	echo 'Что бэкапим: '.$SitePath.'<br>';
	echo 'Куда бэкапим: '.$BackupPath . $site_arc_fn.'<br>';
	//exit();

  addMessageLine( 'Начинаем бэкап сайта' );

  $log = $BackupPath . "backupLog.txt";
  if ( file_exists( $log ) ) {
    unlink( $log );
  }

  Zip( $SitePath, $BackupPath . $site_arc_fn );
  addMessageLine( 'бэкап сайта завершен' );
}

//========================================================================================================
//========================================================================================================
//========================================================================================================
//========================================================================================================
if (( isset( $_GET[ 'db' ] ) ) || ( isset( $_GET[ 'action' ] ) )) {

	$dbname = $_POST["folder"];
  $db_arc_fn = 'db_'.$dbname.'_' . date( "H-i" ) . '.sql';
  $DBFile = $BackupPath . $db_arc_fn;
  addMessageLine( 'Начинаем бэкап БД' );
	echo $dbname.'<br>';
	echo $db_arc_fn.'<br>';
	echo $DBFile.'<br>';
  echo 'Начинаем бэкап БД<br>';
  //db_backup( $DBUSER, $DBPASSWD, $DATABASE, $DBFile );
    include_once(dirname(__FILE__) . '/Mysqldump.php');
    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname='.$dbname, 'rusavtomatika_db', '123456');
    $dump->start($DBFile);
  addMessageLine( 'бэкап БД завершён' );
  echo 'бэкап БД завершён<br>';

}
?>
</body>
</html>