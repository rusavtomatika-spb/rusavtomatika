<?php
$docs_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/docs_result_tmp.txt';
$local_path = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/';
$ftp_folder = '/documents_ra/';
$ftp_server = '51.254.18.36';
$ftp_port = 21;
$ftp_user_name = 'upload_olga@weblector.ru';
$ftp_user_pass = 'olgaglr';

/////////////////////////////////////
/**
 * Функция: операция FTP (копирование, перемещение, удаление файлов / создание каталога)
 */
class class_ftp {
  public $off; // возвращаем статус операции (успех / неудача)
  public $conn_id; // FTP-соединение
  /**
   * Метод: FTP-соединение
   * @FTP_HOST - хост FTP
   * @FTP_PORT - порт
   * @FTP_USER - имя пользователя
   * @FTP_PASS - пароль
   */
  function __construct( $FTP_HOST, $FTP_PORT, $FTP_USER, $FTP_PASS ) {
    $this->conn_id = @ftp_connect( $FTP_HOST, $FTP_PORT )OR die( 'Ошибка подключения к FTP-серверу' );
    @ftp_login( $this->conn_id, $FTP_USER, $FTP_PASS )OR die( "Ошибка входа на FTP-сервер" );
    @ftp_pasv( $this->conn_id, 1 ); // Включить пассивное моделирование
  }
  /**
   * Метод: загрузка файлов
   * @path - локальный путь
   * @newpath - путь загрузки
   * @type - создать новый каталог, если целевой каталог не существует
   */
  function up_file( $path, $newpath, $type = true ) {
    if ( $type )$this->dir_mkdirs( $newpath );
    $this->off = ftp_put( $this->conn_id, $newpath, $path, FTP_BINARY );
    if ( !$this->off )echo "Ошибка загрузки файла, проверьте правильность разрешений и пути!";
  }
  /**
   * Метод: загрузка внешнего файла из массива на сервер и последующее копирование их на FTP
   * @path - локальный путь
   * @newpath - путь загрузки
   * @type - создать новый каталог, если целевой каталог не существует
   */
  function ext2ftp( $ext_file_url, $ftp_path, $type = true ) {
$local_path = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/';
$ftp_folder = '/documents_ra/';
    $info = pathinfo( $ext_file_url );
    $dest_path = $info[ 'dirname' ];
    $dest_path = preg_replace( '/^(https?:\/\/dl.weintek.com\/public\/|http?:\/\/dl.weintek.com\/public\/|ftps?:\/\/dl.weintek.com\/public\/)/', '', $dest_path );
    $dest_path = $ftp_folder . $dest_path. "/";
    $fname = $info[ 'basename' ];
    $src_file = ( $info[ 'dirname' ] ) . "/" . $fname;
    $local_fname = $local_path . $fname;
    echo "каталоги: " . $dest_path;
    echo "<br>Исходник: " . $src_file;
    echo "<br>tmp файл: " . $local_fname; 
    copy( $ext_file_url, $local_fname );
    if ( $type )$this->dir_mkdirs( $dest_path );
    $this->off = ftp_put( $this->conn_id, $dest_path, $local_fname, FTP_BINARY );
    exit();
//    $this->del_file( $local_fname );
//    if ( !$this->off )echo "Ошибка загрузки файла, проверьте правильность разрешений и пути!";
  }
  /**
   * Метод: переместить файлы внутри FTP
   * @path - оригинальный путь
   * @newpath - новый путь
   * @type - создать новый каталог, если целевой каталог не существует
   */
  function move_file( $path, $newpath, $type = true ) {
    if ( $type )$this->dir_mkdirs( $newpath );
    $this->off = @ftp_rename( $this->conn_id, $path, $newpath );
    if ( !$this->off )echo "Ошибка перемещения файла, проверьте правильность разрешений и исходного пути!";
  }
  /**
   * Метод: копировать файлы с FTP себе
   * Примечание: так как FTP не имеет команды копирования, обходной путь этого метода: после загрузки, загрузить по новому пути
   * @path - оригинальный путь
   * @newpath - новый путь
   * @type - создать новый каталог, если целевой каталог не существует
   */
  function copy_file( $path, $newpath, $type = true ) {
    $downpath = "c:/tmp.dat";
    $this->off = @ftp_get( $this->conn_id, $downpath, $path, FTP_BINARY ); // скачать
    if ( !$this->off )echo "Ошибка копирования файла, проверьте разрешения и правильный путь указан правильно!";
    $this->up_file( $downpath, $newpath, $type );
  }
  /**
   * Метод: удалить файлы
   * @path - путь
   */
  function del_file( $path ) {
    $this->off = @ftp_delete( $this->conn_id, $path );
    if ( !$this->off )echo "Ошибка удаления файла, проверьте правильность разрешений и пути!";
  }
  /**
   * Метод: Создать каталог
   * @path - путь
   */
  function dir_mkdirs( $path ) {
    $path_arr = explode( '/', $path ); // Получить массив каталогов
    $file_name = array_pop( $path_arr ); // имя всплывающего файла
    $path_div = count( $path_arr ); // Взять количество слоев
    foreach ( $path_arr as $val ) // Создать каталог
    {
      if ( @ftp_chdir( $this->conn_id, $val ) == FALSE ) {
        $tmp = @ftp_mkdir( $this->conn_id, $val );
        if ( $tmp == FALSE ) {
          echo "Ошибка создания каталога, проверьте правильность разрешений и пути!";
          exit;
        }
        @ftp_chdir( $this->conn_id, $val );
      }
    }
    for ( $i = 1; $i = $path_div; $i++ ) // возврат к корню
    {
      @ftp_cdup( $this->conn_id );
    }
  }
  /**
   * Метод: закрыть FTP соединение
   */
  function close() {
    @ftp_close( $this->conn_id );
  }
} // class class_ftp end
/************************************** Тест********** *************************
 $ftp = new class_ftp ($ftp_server, 21, 'user', 'pwd'); // Открыть FTP-соединение
 //$ftp->up_file('aa.txt','a/b/c/cc.txt '); // загрузить файл
 //$ftp->move_file('a/b/c/cc.txt','a/cc.txt '); // Переместить файл
 //$ftp->copy_file('a/cc.txt','a/b/dd.txt '); // копировать файл
 //$ftp->del_file('a/b/dd.txt '); // удалить файл
 $ftp-> close (); // Закрыть FTP-соединение
******************************************************************************/
/////////////////////////////////////////////////////
$docs = file_get_contents( $docs_result );
$docs = json_decode( $docs, true );
$url = $docs[ 0 ][ 'url' ];
//echo "<br>";
$path = $docs[ 0 ][ 'put' ];
//echo "<br>";
$fname = $docs[ 0 ][ 'fname' ];
$local_fname = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/' . $fname;
//echo "<br>";
//$ftp_conn = FTPUploader::connect($ftp_server,$ftp_user_name,$ftp_user_pass);
//echo $ftp_conn;
//echo "<br>";
//$qqq = $test->connect('51.254.18.36','upload_olga@weblector.ru','olgaglr');
//    if ( !$qqq ) {
//      $error_msg = 'Could not connect to server';
//    }
//$path = $ftp_folder.$docs[0][ 'put' ];
//$path = $ftp_folder.'222';
//echo $path;
//echo "<br>Url: ";
//echo $url;
//echo "<br>Remote_path: ";
//echo $ftp_folder . $path . "/" . $fname;
//echo "<br>local_fname: ";
//$check_put = $test->ftp_is_dir($qqq,$path);
//    if ( !$check_put ) {
//echo "нет такого <br>";
//    } else {
//echo "есть! <br>";
//	}
//copy( $url, $local_fname );
//echo $local_fname;
//exit();
$remote_path = $ftp_folder . $path . "/" . $fname;
$ftp = new class_ftp( $ftp_server, $ftp_port, $ftp_user_name, $ftp_user_pass ); // Открыть FTP-соединение
$ftp->ext2ftp( $url, $ftp_folder, true ); // загрузить файл
$ftp->close(); // Закрыть FTP-соединение
?>