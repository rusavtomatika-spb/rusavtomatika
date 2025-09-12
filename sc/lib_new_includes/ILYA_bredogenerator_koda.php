<?/*?><pre>
    <? var_dump($_SERVER["HTTP_HOST"])?>
</pre>*/



define('FTP_SERVER', '51.254.18.36');
define('FTP_USER_NAME', 'ilval@weblector.ru');
define('FTP_USERPASS', 'ilval2398');


function connectToFTP(){
    global $ftpConnectionID;
    $ftpConnectionID = ftp_connect(FTP_SERVER);
 
    $login_result = ftp_login($ftpConnectionID, FTP_USER_NAME, FTP_USERPASS);
    if ((!$ftpConnectionID) || (!$login_result)) {
        throw new Exception('FTP connection has failed!');
        echo "FTP connection has failed!";
        echo "Attempted to connect to $ftp_server for user: $ftp_user_name";
        exit;
    }else{
        return true;
    }
 }
 function disconnectFTP(){ 
    global $ftpConnectionID;
    ftp_close($ftpConnectionID);
    $ftpConnectionID = "";

 }



function get_new_path_picture($imgRemoteDir, $file_name_with_path = false ) {

    global $ftpConnectionID;
    if (!$ftpConnectionID) {
        $result = connectToFTP();
    }

    //sm
    //$files = ftp_nlist($ftpConnectionID,$imgRemoteDir."sm/");
    //var_dump_pre(debug_backtrace());
    $file_counter = 0;
    foreach ($files as $file) {
        $pos_png = strpos($file, ".png");

        if ($pos_png === false) {
            continue;
        } else {
            if (!$file_name_with_path) $file = substr(strrchr($file, "/"), 1);
            $new_path_picture[] = $file;
        }
    }

    if ($ftpConnectionID)  disconnectFTP();

    return $new_path_picture;
}

function get_path_md_picture($brand,$type,$model)
{
    $model = str_replace('/', '_', $model);
    return('/images/' . mb_strtolower($brand) . '/' . mb_strtolower($type) . '/' . $model . '/md/' . $model . '_1.png') ;
}
function get_path_130_picture($brand,$type,$model)
{
    $model = str_replace('/', '_', $model);
    return('/images/' . mb_strtolower($brand) . '/' . mb_strtolower($type) . '/' . $model . '/130/' . $model . '_1.webp') ;
}
function get_path_190_picture($brand,$type,$model)
{
    $model = str_replace('/', '_', $model);
    return('/images/' . mb_strtolower($brand) . '/' . mb_strtolower($type) . '/' . $model . '/190/' . $model . '_1.webp') ;
}
