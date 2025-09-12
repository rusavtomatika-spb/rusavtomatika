<h1>Заливка папки tmp_bufer на FTP с картинками</h1>
<?php
$tmp_bufer = $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/tmp_bufer/";
$ftp_folder = '/documents_ra/';
$ftp_server = '51.254.18.36';
$ftp_user_name = 'upload_olga@weblector.ru';
$ftp_user_pass = 'olgaglr';
file_put_contents( $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/error_log", "" );
//    $d = scandir( $tmp_bufer );
//                                echo "<pre>";
//                                var_dump( $d );
//                                echo "</pre>"; exit();
$conn_id = ftp_connect( $ftp_server );
$login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
ftp_pasv( $conn_id, true );
ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 6600 );

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

clean( $conn_id, $ftp_folder );
//echo ftp_pwd($conn_id);
ftp_putAll($conn_id, $tmp_bufer, $ftp_folder);
echo "Файлы скопированы на FTP с картинками";
?>