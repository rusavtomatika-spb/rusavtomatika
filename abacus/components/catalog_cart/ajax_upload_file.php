<?php

//if(isset($_COOKIE["usercmp"])) $cook=$_COOKIE["usercmp"];
//else die("i don't think so");
//include ("lib.php");
//database_connect();



if (isset($_POST["id"]))
    $id = $_POST["id"];
else
    $id = 1;
$filetype = $_POST["filetype"];

function rnd_string() {

    $arr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z',
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

//$arr = array('1','2','3','4','5','6','7','8','9','0');

    $string = "";
    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, count($arr) - 1);
        $string .= $arr[$index];
    }

    return $string;
}

$uploaddir = $_SERVER["DOCUMENT_ROOT"] .'/uploads/cart/';

if (!is_dir($uploaddir)) {
    var_dump(mkdir($uploaddir, 0777, true));
}

$file = basename($_FILES['myFile']['name']);
//$file = iconv("UTF-8", "WINDOWS-1251",$file);


$arr = explode(".", $file);
$rn = rnd_string();
$arr[0] = $rn;
$file = $uploaddir.$arr[0].".".$arr[1];   // make new random file name with real extension




if (move_uploaded_file($_FILES['myFile']['tmp_name'],  $file)) {
    echo "https://" . $_SERVER['HTTP_HOST'] . "$file";

    //$sql="SELECT * FROM `samkoon_clients` WHERE `compid`= '$cook' ";    // find user ID
    // $res=mysql_query($sql) or die(mysql_error());
    //$r=mysql_fetch_object($res) or die("no user");
    // echo "client id $r->id";
    // $user=$r->id;
    // $sql="SELECT * FROM `samkoon_orders` WHERE `compid`='$user' ORDER BY `id` DESC LIMIT 1";    // find the last order from this user
    // $res=mysql_query($sql) or die(mysql_error());
    // if($r=mysql_fetch_object($res) )
    // echo "id= $r->id";
    //  $sql="UPDATE `samkoon_orders` SET `rekv_file`='$file' WHERE `id`='$r->id' ";
    //   $res=mysql_query($sql) or die(mysql_error());                   // update order with rekv
} else {
    echo "error $file";
}
?>