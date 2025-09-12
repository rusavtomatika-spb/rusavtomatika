<?
ini_set( 'max_execution_time', '1000' ); // в секундах
$plc_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/PLC_Connect_Guide.txt';
$ra_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/ra-docs.txt';
$all_downloaded_docs_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/all_downloaded_docs.txt';
$wt_result = $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/docs_wt_result.txt";
$ra_items = json_decode( file_get_contents( $ra_filename ), true ); // JSON с нашими документами
$plc_items = json_decode( file_get_contents( $plc_filename ), true ); // JSON с "Руководства по подключению ПЛК". Большинства из них уже нет в массиве weintek.com
$wt_items = json_decode( file_get_contents( $wt_result ), true ); // JSON с доками weintek.com
$tmp_bufer = $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/tmp_bufer/";
file_put_contents( $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/error_log", "" );
//$documents = array_values( json_decode( file_get_contents( $docs_result ), true ) );
$items = array_merge( $wt_items, $ra_items, $plc_items ); // Объединяем эти 3 массива
$documents = array_values( $items );
echo count( $documents ) . "<hr>";

function saveFiles( $docs, $destination ) {
    global $documents;
    global $tmp_bufer;
    $idoc = 0;
    $ifs = 0;
    //$docs_result = $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/docs_wt_result.txt";
    //                            echo "<pre>";
    //                            var_dump( $documents );
    //                            echo "</pre>";
    foreach ( $docs as $key => $doc ) {
        $idoc++;
        $title = $doc[ 'title' ];
        $mod_data = $doc[ 'mod_data' ];
        $filename = $doc[ 'fname' ];
        if ( strpos( " ", $filename ) !== false ) {
            $filename = str_replace( " ", "_", $doc[ 'fname' ] );
            $docs[ $ifs ][ 'fname' ] = $filename;
        }
        $brand = $doc[ 'brand' ];
        $src_path = $doc[ 'put' ];
        $category = $doc[ 'category' ];
        $section = $doc[ 'section' ];
        $label = $doc[ 'label' ];
        $cur_path = $tmp_bufer;
        $url_cat_dest = $_SERVER[ 'DOCUMENT_ROOT' ] . $src_path;
        $dest_path2file = $tmp_bufer . $src_path . '/' . $filename;
        $src_url = $doc[ 'url' ];
        if ( strpos( " ", $src_url ) !== false ) {
            $src_url = str_replace( " ", "%20", $src_url );
            if ( UR_exists( $src_url ) === false ) {
                echo $ifc.") ".$src_url." удалён как [404].<br>";
                unset( $documents[ $ifs ] );
                continue;
            }
            $docs[ $ifs ][ 'url' ] = $src_url;
        }
        if ( is_dir( $url_cat_dest ) === false ) {
            $arr_folders = explode( "/", $src_path );
            make_path( $arr_folders, $tmp_bufer );
            file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
        $ifc++;
        } else {
            file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
        $ifc++;
        }
    }
}

function make_path( $arr_path, $cur_path ) {
    $array = $arr_path;
    for ( $i = 0; $i < count( $array ); $i++ ) {
        if ( is_dir( @$cur_path . $array[ $i ] ) === false ) {
            mkdir( $tmp_bufer . @$cur_path . $array[ $i ], 0755, true );
        }
        @$cur_path .= $array[ $i ] . "/";
    }
}

function rscan( $dir ) {
    global $ifs;
    $all = array_diff( scandir( $dir ), [ ".", ".." ] );
    $eol = PHP_EOL;
    if ( $all ) {
        foreach ( $all as $ff ) {
            if ( is_file( $dir . $ff ) ) {
                echo "{$ff}<br>";
                $ifs++;
            }
            if ( is_dir( $dir . $ff ) ) {
                echo "<b>[{$ff}]</b><br>";
                rscan( "$dir$ff/" );
            }
        }
    }
}

function UR_exists( $url ) {
    $headers = get_headers( $url );
    return stripos( $headers[ 0 ], "200 OK" ) ? true : false;
}

function deleteFolder($folderPath) {
global $tmp_bufer;
    if (is_dir($folderPath)) {
        $files = scandir($folderPath);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                if (is_dir($folderPath.'/'.$file)) {
                    deleteFolder($folderPath.'/'.$file);
                } else {
                    unlink($folderPath.'/'.$file);
                }
            }
        }
        if ($folderPath != $tmp_bufer) {
        rmdir($folderPath);
        }
    }
}


//echo $tmp_bufer;
file_put_contents( $all_downloaded_docs_filename, json_encode( $documents ) );
if (count( $documents )>2) {deleteFolder($tmp_bufer);} else { echo "Входящий массив пуст"; exit();} // проверяем входящий массив
saveFiles( $documents, $tmp_bufer );
echo "Листинг каталога " . $tmp_bufer . ":<br>";
//echo getcwd();
rscan( "/home/moisait/public_html/rusavto/documents__/tmp_bufer/" );
echo $ifs;
?>