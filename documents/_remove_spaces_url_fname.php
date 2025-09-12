<h1>Очистка от пробелов</h1>
<?
// Пример использования
$arr = array();
$arr =  json_decode(file_get_contents($_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/docs_wt_result.txt'),true);
$ifs = 0;
foreach ($arr  as $key => $url) {
            $src_url = $arr[ 'url' ];
        if ( strpos( " ", $src_url ) !== false ) {
            $src_url = str_replace( " ", "%20", $src_url );
            if ( UR_exists( $src_url ) === false ) {
                echo $ifc.") ".$src_url." удалён как [404].<br>";
                unset( $arr[ $ifs ] );
                continue;
            }
            $arr[ $ifs ][ 'url' ] = $src_url;
        }
        $filename = $arr[ 'fname' ];
        if ( strpos( " ", $filename ) !== false ) {
            $filename = str_replace( " ", "_", $arr[ 'fname' ] );
            $arr[ $ifs ][ 'fname' ] = $filename;
        }
$ifc++;
}
                           echo "<pre>";
                          var_dump( $arr );
                          echo "</pre>";
   
    
    
    file_put_contents( $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/docs_wt_result.txt", json_encode($arr)  );
?>
