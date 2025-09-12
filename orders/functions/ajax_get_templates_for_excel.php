<?php
define('MAIN_FILE_EXECUTED', true);
ob_start();

$brand = strip_tags($_POST['brand']);
$ready_path = strip_tags($_POST['data_template_path']);
if ($ready_path !=''){
    echo $path = $_SERVER["DOCUMENT_ROOT"]."/orders/xls_templates/".$ready_path."/";
}else{
    $path = $_SERVER["DOCUMENT_ROOT"]."/orders/xls_templates/".$brand."/";
}

$scandir_result = myscandir($path);
$files = array();
foreach ($scandir_result as $file){
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if (strpos($file,"__config") === false and ($ext == 'xls' or $ext == 'xlsx')){
        $files[] = $file;
    }
}
if (count($files) > 0) {
    $out["status"] = 1;
    $out["files"] = $files;
} else {
    $out["status"] = 0;
}

$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
ob_end_clean();
echo json_encode($out);

function myscandir($dir, $sort=0)
{
    $list = scandir($dir, $sort);
    // если директории не существует
    if (!$list) return false;
    // удаляем . и .. (я думаю редко кто использует)
    if ($sort == 0) unset($list[0],$list[1]);
    else unset($list[count($list)-1], $list[count($list)-1]);
    return $list;
}


