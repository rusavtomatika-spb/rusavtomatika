<?
$qqq = json_decode( file_get_contents($_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects__/demo.txt'),true);
$projects = json_decode( file_get_contents($_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects__/projects.txt'),true);
//echo array_search('DEM22003_HMI_Modbus_iR-ETN40R_Demo.zip', array_column($demos, 'fname')); exit();
$i = 0;
foreach($qqq as $k=>$v) {
    $query = $qqq[$k][ fname ];
    $ind = array_search($query, array_column($projects, 'fname'));
    if ($ind !== false) {
//    echo $ind."<br>";
    $rtext = $projects[$ind][ stext ];
//    echo "[".$i."]".$k.") ".$query."<br>".$rtext."<hr>";
    $qqq[$k][ stext ] = $rtext;
    unset($query);
        $i++;
} else {    $qqq[$k][ stext ] = '';
 }
}
//foreach($projects as $k=>$v) {
//    $query = $projects[$k][ fname ];
//    $ind = array_search($query, array_column($demos, 'fname'));
//    if ($ind !== false) {
////    echo $ind."<br>";
//    $rtext = $demos[$ind][ stext ];
////    echo "[".$i."]".$k.") ".$query."<br>".$rtext."<hr>";
//    $projects[$k][ stext ] = $rtext;
//    unset($query);
//        $i++;
//} else {    $projects[$k][ stext ] = '';
// }
//}
//foreach($projects as $k=>$v) {
//    $title = $projects[$k][ title ];
//    $title = str_replace('_',' ',$title);
////    echo $ind."<br>";
//    //$rtext = $projects[$ind][ stext ];
////    echo "[".$i."]".$k.") ".$query."<br>".$rtext."<hr>";
//    $projects[$k][ title ] = $title;
//    $stext = $projects[$k][ stext ];
//    $stext = str_replace(array("\r\n", "\r", "\n", "\t"), '',$stext);
//    $projects[$k][ stext ] = $stext;
//        $i++;
//} 
//foreach($projects as $k=>$v) {
//    $put = $projects[$k][ url ];
//            $info = pathinfo( $put );
//            $put = $info[ 'dirname' ];
//            $fname = $info[ 'basename' ];
//            $img_name = explode( '.', $fname );
//            $img_name = $img_name[ 0 ] . ".png";
//    $img_url = $put.$img_name;
//    echo $img_url."<br>";
//    
//        $i++;
//} 

//echo $i;

// Выводим содержимое массива projects
//print_r($projects);
file_put_contents($_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects__/sirotki.txt',json_encode($qqq,JSON_UNESCAPED_UNICODE));
?>