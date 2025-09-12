<?php

/*
if (preg_match("/.(PNG|GIF|JPEG|JPG)$/i", $_SERVER['REQUEST_URI'])) {

//include "wm/watermark.php";

//echo $_SERVER['REQUEST_URI'];


$var_array = explode("/",$_SERVER['REQUEST_URI']);
$levels = count($var_array);
$end_page = $levels - 1;

$file = '/home/weblec/public_html/ifc-ipc.cn/img/panels/'.$var_array[$end_page];

if 	(file_exists('/home/weblec/public_html/test_ra/monitors/img/'.$var_array[$end_page])) {

$original = '/home/weblec/public_html/test_ra/monitors/img/'.$var_array[$end_page];

} elseif (file_exists('/home/weblec/public_html/ifc-ipc.cn/img/panels/'.$var_array[$end_page]))  {


if  (file_exists('/home/weblec/public_html/ifc-ipc.cn/img/panels/'.$var_array[$end_page])) {
$original = '/home/weblec/public_html/ifc-ipc.cn/img/panels/'.$var_array[$end_page];

};

};



//$original = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'];

//print $original;
if (!empty($original)) {
function waterMark($original)
{

	$original = urldecode($original);
	$info_o = @getImageSize($original);
	if (!$info_o)
		return false;
		
//	$info_w = @getImageSize('watermark.png');
//	if (!$info_w)
//		return false;

	header("Content-Type: ".$info_o['mime']);

//	$original = @imageCreateFromString(file_get_contents($original));
		$original = @file_get_contents($original);
//	$watermark = @imagecreatefrompng('watermark.png');
//	$out = imageCreateTrueColor($info_o[0],$info_o[1]);
$out = $original;
//	imageCopyMerge($out, $original, 0, 0, 0, 0, $info_o[0], $info_o[1], 100);
	// Водяной знак накладываем только на изображения больше 150 пикселей по вертикали и по горизонтали
	

	switch ($info_o[2])
	{
	case 1:
		imageGIF($out);
		break;
	case 2:
		imageJPEG($out);
		break;
	case 3:
		imagePNG($out);
		break;
	default:
		return false;
	}

	imageDestroy($out); 
	imageDestroy($original); 
//	imageDestroy($watermark); 

	return true; 
} 

waterMark($original);

};

exit;
};

*/



include ("../weintek/products_newo.php");
?>