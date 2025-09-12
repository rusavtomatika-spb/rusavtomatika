<?php
// Загрузка HTML-страницы
$html = file_get_contents('https://www.weintek.com/globalw/Download/Download.aspx');

// Парсинг HTML-страницы
$dom = new DOMDocument();
@$dom->loadHTML($html);

// Получение всех ссылок
$links = $dom->getElementsByTagName('a');

// Массив для хранения ссылок
$uploadLinks = [];

foreach ($links as $link) {
    // Проверка наличия текста 'upload' в href
    if (strpos($link->getAttribute('href'), 'FCK_Upload') !== false) {
		$lhref = $link->getAttribute('href');
		$lfile = explode('/',$lhref);
		$lfnameext = array_pop($lfile);
		$lfname = explode('.',$lfnameext);
		$lfname = $lfname[0];
		$model = array();
        $model['title'] = $lfname." 3D Model";
        $model['label'] = $lfname." 3D Model";
        $model['category'] = "3D Model";
        $model['url'] = "https://www.weintek.com/globalw/FCK_Upload/Dimensions/".$lfnameext;
        $uploadLinks[] = $model;
//		array_push($uploadLinks,$lfname,$lhref);
    }
}
//        "title": "cMT-G01 3D Model",
//        "brand": "",
//        "lang": "ENG",
//        "mod_data": 1552447600,
//        "url": "https:\/\/dl.weintek.com\/public\/cMT\/Drawing\/cMT-G01.rar",
//        "put": "cMT\/Drawing",
//        "fname": "cMT-G01.rar",
//        "category": "3D Model",
//        "section": "cmt",
//        "ftype": "rar",
//        "label": "N\/AcMT-G01 3D Model3D Model3D ModelcMT Series",
//        "sort": "400",
//        "description": ""
echo "<pre>";
//var_dump($uploadLinks);
print_r($uploadLinks);
echo "</pre>";
  $tags_json = file_get_contents( 'availableTags.txt' );
  $alltags = json_decode( $tags_json, true );
$ar3d_ = array_merge($alltags,$uploadLinks);
 file_put_contents( '3d_.txt', json_encode($ar3d_) );

// Сохранение результатов в JSON-файл
//file_put_contents('results.json', json_encode($uploadLinks));
?>