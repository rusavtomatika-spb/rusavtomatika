<?php
header('Content-Type: text/html; charset=utf-8');
ob_start();
global $ftpConnectionID;
/*
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
define('admin', true);

define('LG_WIDTH', '1330');
define('LG_HEIGHT', '1000');
define('MD_WIDTH', '590');
define('MD_HEIGHT', '443');
define('SM_WIDTH', '50');
define('SM_HEIGHT', '38');

define('PX130_WIDTH', '130');
define('PX130_HEIGHT', '100');

define('PX67_WIDTH', '67');
define('PX67_HEIGHT', '50');


require_once 'config_ftp.php';
require_once '../config/admin_dbcon.php';
require_once 'classes/databases_products_all.php';
require_once 'classes/functions.php';
$ajax_import_data = json_decode(file_get_contents('php://input'), true);

if (isset($_FILES["img"])
        and isset($_POST["product_id"])
        and $_POST["product_id"] > 0
        and in_array($_FILES["img"]["type"], ["image/jpeg", "image/png",])) {

    $dbWork = new DBWORK();
    $arProduct = $dbWork->get_catalog_element_by_id($_POST["product_id"]);
    $model_secured = str_replace("/","_",$arProduct["model"]);
    $model_secured = str_replace(" ","_",$model_secured);
    $model_secured = str_replace("®","_",$model_secured);

    $imgPathDir = $_SERVER["DOCUMENT_ROOT"] . "/images/" . strtolower($arProduct["brand"]) . "/".strtolower($arProduct["type"])."/{$model_secured}/";
    $imgPathDirRemoteFTP = "/images/" . strtolower($arProduct["brand"]) . "/".strtolower($arProduct["type"])."/{$model_secured}/";

    $new_number_of_file = get_new_number_of_file($imgPathDirRemoteFTP);

    $imgPathDirLG = $imgPathDir . "/lg/";
    $imgPathDirMD = $imgPathDir . "/md/";
    $imgPathDirSM = $imgPathDir . "/sm/";
    $imgFileName = "{$model_secured}_$new_number_of_file.png";
    $imgPathFile = $imgPathDir . $imgFileName;
    $paths["imgPathDirRemoteFTP"] = $imgPathDirRemoteFTP;
    $paths["imgPathDir"] = $imgPathDir;
    $paths["imgFileName"] = $imgFileName;
    $paths["imgPathFile"] = $imgPathFile;
    $paths["imgPathDirLG"] = $imgPathDir . "lg/";
    $paths["imgPathDirMD"] = $imgPathDir . "md/";
    $paths["imgPathDirSM"] = $imgPathDir . "sm/";

    $loaded_file_tmp_name = $_FILES["img"]["tmp_name"];
    if (!is_dir($imgPathDir)) {
        var_dump(mkdir($imgPathDir, 0777, true));
    }
    if (!is_dir($paths["imgPathDirLG"])) {
        var_dump(mkdir($paths["imgPathDirLG"], 0777, true));
    }
    if (!is_dir($paths["imgPathDirMD"])) {
        var_dump(mkdir($paths["imgPathDirMD"], 0777, true));
    }
    if (!is_dir($paths["imgPathDirSM"])) {
        var_dump(mkdir($paths["imgPathDirSM"], 0777, true));
    }
    $result = move_uploaded_file($loaded_file_tmp_name, $imgPathFile);
//$file['tmp_name']
    if ($result) {
        create_set_of_images($paths);
        connectToFTP();
        $out["images"] = getRemoteFTPImagesHtml($arProduct);
        disconnectFTP();
        //$dbWork->incrementing_pics_number($_POST["product_id"]);

    }
    $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
ob_end_clean();
$out["product_id"] = $_POST["product_id"];
echo json_encode($out);

}elseif
  (
  isset($ajax_import_data["re_create_product_pics"])
  and $ajax_import_data["re_create_product_pics"] === true
  and isset($ajax_import_data["product_id"])
  and $ajax_import_data["product_id"] > 0
  )
{
  $dbWork = new DBWORK();
  $arProduct = $dbWork->get_catalog_element_by_id($ajax_import_data["product_id"]);
  $model_secured = str_replace("/","_",$arProduct["model"]);
  $model_secured = str_replace(" ","_",$model_secured);
  $model_secured = str_replace("®","_",$model_secured);

  $imgPathDir = $_SERVER["DOCUMENT_ROOT"] . "/images/" . strtolower($arProduct["brand"]) . "/".strtolower($arProduct["type"])."/{$model_secured}/";
  $imgPathDirRemoteFTP = "/images/" . strtolower($arProduct["brand"]) . "/".strtolower($arProduct["type"])."/{$model_secured}/";


  $new_number_of_file = get_list_of_file($imgPathDirRemoteFTP);
  if($new_number_of_file === NULL){exit;}


  $paths["size"] = array(
    "67" => array(
        "w" => 67,
        "h" => 50
    ),
    "130" => array(
        "w" => 130,
        "h" => 100
    ),
    "150" => array(
        "w" => 150,
        "h" => 120
    ),
    "190" => array(
        "w" => 190,
        "h" => 143
    ),
    "580" => array(
        "w" => 580,
        "h" => 437
    ),
    "1330" => array(
        "w" => 1330,
        "h" => 1000
    )
);


foreach ($new_number_of_file as $value) {

  $pieces = explode("/", $value);
  $imgFileName = $pieces[6];

        $paths["imgPathDirRemoteFTP"] = $imgPathDirRemoteFTP;
        $paths["imgPathDir"] = $imgPathDir;
        $paths["imgFileName"] = $imgFileName;
        $paths["imgFileNameCore"] = $model_secured;
        convert_png_to_webp($paths);


}



}


// FUNCTIONS ///////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
function get_new_number_of_file($imgRemoteDir) {
    global $ftpConnectionID;
    if (!$ftpConnectionID) connectToFTP();
    $files = ftp_nlist($ftpConnectionID,$imgRemoteDir."lg/");
    echo "<br>";
    echo($imgRemoteDir."lg/");
    echo "<br>";
    //$files = scandir($imgPathDir);
    $file_counter = 0;
    foreach ($files as $file) {
        $pos_png = strpos($file, ".png");
        $pos_jpg = strpos($file, ".jpg");

        if ($pos_png === false and $pos_jpg === false) {
            continue;
        } else {
            $file_counter++;
        }
    }
    if ($ftpConnectionID)  disconnectFTP();
    return ++$file_counter;
}
function get_list_of_file($imgRemoteDir) {
    global $ftpConnectionID;
    if (!$ftpConnectionID) connectToFTP();
    $files = ftp_nlist($ftpConnectionID,$imgRemoteDir."lg/");

    $file_counter = 0;
    foreach ($files as $file) {
        $pos_png = strpos($file, ".png");
        $pos_jpg = strpos($file, ".jpg");

        if ($pos_png === false and $pos_jpg === false) {
            continue;
        } else {
          $out[] = $file;
        }
    }
    if ($ftpConnectionID)  disconnectFTP();
    return $out;
}
function convert_png_to_webp($paths) {

    foreach ($paths["size"] as $key => $value) {

        $local_path = $paths["imgPathDir"] . $key . "/";
        if (!is_dir($local_path)) {
            var_dump(mkdir($local_path, 0777, true));
        }

        ## donor
        $remote_image = "https://www.rusavtomatika.com/upload_files" . $paths["imgPathDirRemoteFTP"] . "lg/";

        $downloadFiles[] = ["remote_path" => $remote_image .  $paths["imgFileName"], "local_path" => $paths["imgPathDir"], "file_name" => $paths["imgFileName"]];
        ftp_download_files($downloadFiles);

        $hash_file = hash_file('md5', $paths["imgPathDir"] . $paths["imgFileName"]);
        $hash_file_link = $paths["imgPathDir"] . $paths["imgFileName"] . ".txt";
        $hash_file_link_size = $local_path . $paths["imgFileName"] . ".big.txt";

        if(file_exists($hash_file_link)){

            if($hash_file == file_get_contents($hash_file_link)){

                if(file_exists($hash_file_link_size)){
                    if($hash_file == file_get_contents($hash_file_link_size)){

                        return;
                    }else{
                        echo "new size: " . $key . ", ";
                        file_put_contents($hash_file_link_size, $hash_file);
                    }
                }else{
                    echo "new size: " . $key . ", ";
                    file_put_contents($hash_file_link_size, $hash_file);
                }
            }else{
                echo "new pic: " . $paths["imgFileName"] . ", ";
                file_put_contents($hash_file_link, $hash_file);
            }
        }else{
            echo "new pic: " . $paths["imgFileName"] . ", ";
            file_put_contents($hash_file_link, $hash_file);
            var_dump($hash_file_link);
        }

        resize_and_save($paths["imgPathDir"], $paths["imgFileName"], $local_path, $value["w"], $value["h"]);




        // Image
        $name = $paths["imgFileName"];
        $newName = str_replace(".png", ".webp", $paths["imgFileName"]);

            // Create and save
            $img = imagecreatefrompng($local_path . $name);
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
            imagewebp($img, $local_path. $newName, 100);
            imagedestroy($img);

        $files[] = ["destination_dir" => $paths["imgPathDirRemoteFTP"] . $key ."/", "destination_file_name" => $newName, "source" => $local_path . $newName];
    }

    ftp_upload_files($files);





}

function create_set_of_images($paths) {
    resize_and_save($paths["imgPathDir"], $paths["imgFileName"], $paths["imgPathDirLG"], LG_WIDTH, LG_HEIGHT);
    resize_and_save($paths["imgPathDir"], $paths["imgFileName"], $paths["imgPathDirMD"], MD_WIDTH, MD_HEIGHT);
    resize_and_save($paths["imgPathDir"], $paths["imgFileName"], $paths["imgPathDirSM"], SM_WIDTH, SM_HEIGHT);
    $files[] = ["destination_dir" => $paths["imgPathDirRemoteFTP"] . "lg/", "destination_file_name" => $paths["imgFileName"], "source" => $paths["imgPathDirLG"] . $paths["imgFileName"]];
    $files[] = ["destination_dir" => $paths["imgPathDirRemoteFTP"] . "md/", "destination_file_name" => $paths["imgFileName"], "source" => $paths["imgPathDirMD"] . $paths["imgFileName"]];
    $files[] = ["destination_dir" => $paths["imgPathDirRemoteFTP"] . "sm/", "destination_file_name" => $paths["imgFileName"], "source" => $paths["imgPathDirSM"] . $paths["imgFileName"]];
    ftp_upload_files($files);

}

function resize_and_save($source_path, $source_file_name, $destination_path, $width, $height) {
    img_resize($source_path . $source_file_name, $destination_path . $source_file_name, $width, $height, 0xFFFFFF, 90);
}

/* * *********************************************************************************
  Функция img_resize(): генерация thumbnails
  Параметры:
  $src             - имя исходного файла
  $dest            - имя генерируемого файла
  $width, $height  - ширина и высота генерируемого изображения, в пикселях
  Необязательные параметры:
  $rgb             - цвет фона, по умолчанию - белый
  $quality         - качество генерируемого JPEG, по умолчанию - максимальное (100)
 * ********************************************************************************* */

function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {

    if (!file_exists($src)){
        return false;
    }


    $size = getimagesize($src);

    if ($size === false)
        return false;

    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    $icfunc = 'imagecreatefrom' . $format;

    if (!function_exists($icfunc))
        return false;

    $x_ratio = $width / $size[0];
    $y_ratio = $height / $size[1];

    if ($height == 0) {
        $y_ratio = $x_ratio;
        $height = $y_ratio * $size[1];
    } elseif ($width == 0) {
        $x_ratio = $y_ratio;
        $width = $x_ratio * $size[0];
    }

    $ratio = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);

    $new_width = $use_x_ratio ? $width : floor($size[0] * $ratio);
    $new_height = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left = $use_x_ratio ? 0 : floor(($width - $new_width) / 2);
    $new_top = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

// если не нужно увеличивать маленькую картинку до указанного размера
    if ($size[0] < $new_width && $size[1] < $new_height) {
        $width = $new_width = $size[0];
        $height = $new_height = $size[1];
        $new_left = $new_top = 0;
    }

    $isrc = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);
    imagealphablending( $idest, true );
    imagesavealpha($idest, true);






    $rgb = imagecolorallocatealpha($idest, 255, 255, 255, 0);
    imagefill($idest, 0, 0, $rgb);




    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);

    $i = strrpos($dest, '.');
    if (!$i)
        return '';
    $l = strlen($dest) - $i;
    $ext = substr($dest, $i + 1, $l);

    switch ($ext) {
        case 'jpeg':
        case 'jpg':
            imagejpeg($idest, $dest, $quality);
            break;
        case 'gif':
            imagegif($idest, $dest);
            break;
        case 'png':
            imagepng($idest, $dest);
            break;
    }

    imagedestroy($isrc);
    imagedestroy($idest);

    return true;
}
function ftp_download_files($files) {
    if (!is_array($files)){
        echo "no files";
        return false;
    }


        foreach($files as $file){
            $ch = curl_init($file["remote_path"]);


            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
            $out = curl_exec($ch);

            $image_sv = $file["local_path"] . $file["file_name"];

            if (!is_dir($file["local_path"] )) {
                var_dump(mkdir($file["local_path"] , 0777, true));
            }

            $img_sc = file_put_contents($image_sv, $out);

            curl_close($ch);

        }
}

function ftp_upload_files($files) {
    if (!is_array($files))
        return false;
    $conn_id = ftp_connect(FTP_SERVER);
    $login_result = ftp_login($conn_id, FTP_USER_NAME, FTP_USERPASS);
    ftp_set_option( $conn_id, FTP_USEPASVADDRESS, false );
	echo ftp_pasv( $conn_id, true ) ? 'ftp_pasv - TRUE<br>':'ftp_pasv - Не могу включить пассивный режим<br>';
    if ((!$conn_id) || (!$login_result)) {
        echo "FTP connection has failed!";
        echo "Attempted to connect to $ftp_server for user: $ftp_user_name";
        exit;
    } else {
        $list = ftp_nlist($conn_id, ".");
        foreach ($files as $file) {

          //  ftp_mkdir($conn_id, "/images/weintek/hmi/MT8053iE/");
			if (ftp_nlist($conn_id, $file["destination_dir"]) == false) {
            ftp_mkdir($conn_id, $file["destination_dir"]);
			}
            $chunks = explode("/", $file["destination_dir"]);
            $current_path = "";
            foreach ($chunks as $chunk) {
                $current_path .= $chunk . "/";
                try {
                    ftp_mkdir($conn_id, $current_path);
                } catch (Exception $exc) {
                        console.log($exc);
                }

            }
            $upload = ftp_put($conn_id, $file["destination_dir"] . $file["destination_file_name"], $file["source"], FTP_BINARY);
            if (!$upload) {
                echo "<span style='color:red;'>" . $file["destination_dir"] . $file["destination_file_name"] . "</span><br>";
            } else {
                echo "<span style='color:green;'>".$file["destination_dir"]. $file["destination_file_name"]."</span><br>";
            }
        }
        ftp_close($conn_id);
    }
}
