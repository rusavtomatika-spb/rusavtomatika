<h1>Очистка папки на FTP с картинками</h1>
<?php
$tmp_bufer = $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/tmp_bufer/";
$ftp_folder = '/documents_ra';
$ftp_server = '51.254.18.36';
$ftp_user_name = 'upload_olga@weblector.ru';
$ftp_user_pass = 'olgaglr';
file_put_contents( $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/error_log", "" );
$conn_id = ftp_connect( $ftp_server );
$login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
ftp_pasv( $conn_id, true );
ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 6600 );
function clean( $conn, $file ) {
  if ( ftp_size( $conn, $file ) == -1 ) {
    $result = ftp_nlist( $conn, $file );
    $i = 0;
	  foreach ( $result as $item ) {
		if ((strpos($item,'/.') === false )) {
			//echo $item."<br>";
		} else {
			unset($result[$i]); }
			$i++;
	  }
    foreach ( $result as $childFile ) {
      clean( $conn, $childFile );
    }
    if ($file != '/documents_ra/') ftp_rmdir( $conn, $file );
  } else {
    ftp_delete( $conn, $file );
  }
}

clean( $conn_id, '/documents_ra/' );
?>
