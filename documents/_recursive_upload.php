<?
// этот скрипт успешно рекурсивно копирует из своей папки на сервере всё содержимое на FTP сервер
error_reporting( E_ERROR | E_PARSE );
$ftp_server = '51.254.18.36';
$ftp_user_name = 'upload_olga@weblector.ru';
$ftp_user_pass = 'olgaglr';
$dst_dir = '/documents_ra/';
$src_dir = 'tmp_bufer';
$conn_id = ftp_connect( $ftp_server );
global $conn_id;
$login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
ftp_pasv( $conn_id, true );
ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 6600 );
//ftp_chdir( $conn_id, $root_docs_directory );
//echo ftp_pwd($conn_id)."<br>";
function ftp_putAll( $conn_id, $src_dir, $dst_dir ) {
  $d = dir( $src_dir );
  while ( $file = $d->read() ) { // do this for each file in the directory 
    if ( $file != "." && $file != ".." ) { // to prevent an infinite loop 
      if ( is_dir( $src_dir . "/" . $file ) ) { // do the following if it is a directory 
        if ( !@ftp_chdir( $conn_id, $dst_dir . "/" . $file ) ) {
          ftp_mkdir( $conn_id, $dst_dir . "/" . $file ); // create directories that do not yet exist 
        }
        ftp_putAll( $conn_id, $src_dir . "/" . $file, $dst_dir . "/" . $file ); // recursive part 
      } else {
        $upload = ftp_put( $conn_id, $dst_dir . "/" . $file, $src_dir . "/" . $file, FTP_BINARY ); // put the files 
      }
    }
  }
  $d->close();
}
ftp_putAll( $conn_id, $src_dir, $dst_dir );
?>