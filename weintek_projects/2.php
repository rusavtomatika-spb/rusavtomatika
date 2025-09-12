<?
$qqq = json_decode( file_get_contents($_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects__/demo.txt'),true);
$projects = json_decode( file_get_contents($_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects__/projects.txt'),true);
//echo array_search('DEM22003_HMI_Modbus_iR-ETN40R_Demo.zip', array_column($demos, 'fname')); exit();
$i = 0;
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
  $img_bufer = $demos_folder . 'tmp_bufer/images/';
mkdir($img_bufer);
	if (is_dir($img_bufer)) {echo "есть";} else {echo "нет";}

// Выводим содержимое массива projects
//print_r($projects);
file_put_contents($_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects__/sirotki.txt',json_encode($www,JSON_UNESCAPED_UNICODE));
?>