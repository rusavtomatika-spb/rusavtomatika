<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/controllers/config_ftp.php';
global $ftpConnectionID;
function connectToFTP()
{
    global $ftpConnectionID;
    $ftpConnectionID = ftp_connect(FTP_SERVER);

    $login_result = ftp_login($ftpConnectionID, FTP_USER_NAME, FTP_USERPASS);
    if ((!$ftpConnectionID) || (!$login_result)) {
        throw new Exception('FTP connection has failed!');
        echo "FTP connection has failed!";
        echo "Attempted to connect to $ftp_server for user: $ftp_user_name";
        exit;
    } else {
        return true;
    }
}

function disconnectFTP()
{

    global $ftpConnectionID;
    ftp_close($ftpConnectionID);
}

/*
function getRemoteFTPImagesHtml($arProduct){    
    global $ftpConnectionID;
    $model_secured = str_replace("/","_",$arProduct["model"]);
    $model_secured = str_replace(" ","_",$model_secured);
    $model_secured = str_replace("®","_",$model_secured);  
    
$imgRemoteDir = "/images/" . strtolower($arProduct["brand"]) . "/{$arProduct["type"]}/{$model_secured}/sm/"; 
$imgPathURL = "/images/" . strtolower($arProduct["brand"]) . "/{$arProduct["type"]}/{$model_secured}/sm/"; 
$files = ftp_nlist($ftpConnectionID,$imgRemoteDir);    
$out = '';
    foreach ($files as $file) {
        $pos_png = strpos($file, ".png");
        if ($pos_png === false) {
            continue;
        } else {
            $out.="<span><img src='".$imgPathURL.$file."' /></span>";
        }
    }
    return $out;
}*/
function getRemoteFTPImagesHtml($arProduct)
{
    global $ftpConnectionID;
    global $db_work;
    if (!isset($db_work)) {
        $db_work = new DBWORK();
    }
    $model_secured = str_replace("/", "_", $arProduct["model"]);
    $model_secured = str_replace(" ", "_", $model_secured);
    $model_secured = str_replace("®", "_", $model_secured);

    $imgRemoteDir = "/images/" . strtolower($arProduct["brand"])
        . "/" . strtolower($arProduct["type"])
        . "/{$model_secured}/sm/";
    $imgPathURL = "/images/" . strtolower($arProduct["brand"]) . "/" . strtolower($arProduct["type"])
        . "/{$model_secured}/sm/";
    $files = ftp_nlist($ftpConnectionID, $imgRemoteDir);
    $out = '';
    $counter = 0;
    if (is_array($files)) {
        foreach ($files as $file) {
            $pos_png = strpos($file, ".png");
            if ($pos_png === false) {
                continue;
            } else {

                $counter++;
                //$out.="<span><img src='".$imgPathURL.$file."' /></span>";
                $out .= "<span>.</span>";
            }
        }
        if ($counter > 0) {

            $out .= "<span> " . $counter . " </span>";

            $db_work->update_pics_number($arProduct["model"], $counter);
        }
    }

    return $out;
}

function getImagesHtml($arProduct)
{
    $model_secured = str_replace("/", "_", $arProduct["model"]);
    $model_secured = str_replace(" ", "_", $model_secured);
    $model_secured = str_replace("®", "_", $model_secured);


    $imgPathDir = $_SERVER["DOCUMENT_ROOT"] . "/images/" . strtolower($arProduct["brand"]) . "/{$arProduct["type"]}/{$model_secured}/sm/";
    $imgPathURL = "/images/" . strtolower($arProduct["brand"]) . "/{$arProduct["type"]}/{$model_secured}/sm/";
    $files = scandir($imgPathDir);
    $out = '';
    foreach ($files as $file) {
        $pos_png = strpos($file, ".png");
        if ($pos_png === false) {
            continue;
        } else {
            $out .= "<span><img src='" . $imgPathURL . $file . "' /></span>";
        }
    }
    return $out;
}

function getImagesArray($arProduct)
{
    $model_secured = str_replace("/", "_", $arProduct["model"]);
    $model_secured = str_replace(" ", "_", $model_secured);
    $model_secured = str_replace("®", "_", $model_secured);

    $imgPathDir = $_SERVER["DOCUMENT_ROOT"] . "/images/" . strtolower($arProduct["brand"]) . "/{$arProduct["type"]}/{$model_secured}/sm/";
    $imgPathURL = "/images/" . strtolower($arProduct["brand"]) . "/{$arProduct["type"]}/{$model_secured}/sm/";
    $files = scandir($imgPathDir);
    $out = '';
    foreach ($files as $file) {
        $pos_png = strpos($file, ".png");
        if ($pos_png === false) {
            continue;
        } else {
            $out[] = $imgPathURL . $file;
        }
    }
    return $out;
}

