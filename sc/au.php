<?

//AJAX ���������� ������ � UTF-8!!!
// ������� ���������� � ��� ��� ������� ������!!!

// ���� ��� ��������
/*
104 - ������������ �� ������
759_$password_hashed - ������������ ������? $password_hashed - ����, ������� ����� ���������� / ��������
301 - ��� ���������� � ����� ������
609 - ������� ����
303 - ��� ������ ��� ������
606 - ������ ������� � �����-�� �� �����
*/

$post_user = strip_tags($_POST['AUTH_USER']);
$post_pw = strip_tags($_POST['AUTH_PW']);
$post_email = strip_tags($_POST['EMAIL']);
$db_file = $_SERVER['DOCUMENT_ROOT']."/sc/dbcon.php";
$ip_file = $_SERVER['DOCUMENT_ROOT']."/sc/class-ip.php";

function generateHash($length = 20){
  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}

if ($aj == 1) {
if (file_exists($db_file)) { 
	
	include_once($db_file);
	database_connect();
	mysql_query("SET NAMES 'cp1251'");

} else {

echo '301';
exit();
};
};

if (file_exists($ip_file)) { 
	
	include_once($ip_file);	
	$access = new Access();
};

if (($post_user == $_POST['AUTH_USER']) AND ($post_pw == $_POST['AUTH_PW']) AND ($post_email == $_POST['EMAIL'])) {





if (($_POST[page] != 'exit') AND ($_GET[page] != 'exit') ) {

// ���� ������������ ��� ��������������� � � ���� ����� ���� llp (�����������)
if (isset($_COOKIE['llp'])) {
$hach = $_COOKIE['llp'];

// ������� ������ �����
$sql="DELETE FROM `wm_sessions` WHERE `created`<NOW()-INTERVAL 2592000 SECOND";
$res=mysql_query($sql) or die(mysql_error());

//��������� ���� � �������
$sql="SELECT * FROM `wm_sessions` WHERE  `sid`='{$hach}' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());
$COUNT = mysql_numrows($res);

//���� ���� ���� � �������
if ($COUNT == 1) {

$r=mysql_fetch_assoc($res);
$user_login = $r['k'];
$created = strtotime($r['created']);
//$now = date('Y-m-d H:i:s');
$now = strtotime("now");
$diff = $now - $created;

//��������� ���� (����� �� �������� � iframe ��� ajax ?! ���� ���, ��������� ���� JS �� ������� ��������)
if ($diff <= 2592000) {

$dt=date('Y-m-d H:i:s');
$sql="UPDATE `wm_sessions` SET `created`='{$dt}' WHERE `sid`='{$hach}'";
$res=mysql_query($sql) or die(mysql_error());

if ($aj != 1) {
setcookie("llp",$hach,time()+60*60*24*30,"","", 0);
} else {
echo '759_'.$hach;
};
};
// ������� ��� ������������ � ������� �������������
$sql="SELECT * FROM `wm_auth_users` WHERE  `user_login`='{$user_login}' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());

$countuser = mysql_numrows($res);

if ($countuser == 1) {
$r=mysql_fetch_assoc($res);
$display_name = $r['display_name'];
$unsubscription = $r['unsubscription'];
} else {
	// ��������� ������������ ��������� ������, ����� ������������ �� ������ � �������.

};
};
};
}
// ���� page== exit, �.�. ������������ ��������������
else {
if (isset($_COOKIE['llp'])) {

$new_hash = $_COOKIE['llp'];

$sql="DELETE FROM `wm_sessions` WHERE `sid`='{$new_hash}'";
$res=mysql_query($sql) or die(mysql_error());

};
// ������� ����
if ($aj != 1) {
setcookie("llp","",time()-1,"","",0);
header('Location: '.$canonical);
exit();
} else {

echo '609';

};
};

// ���� ������������ �������� ��������������
if ((isset($_POST['AUTH_USER'])) AND (isset($_POST['AUTH_PW']))) {



//$pas = md5($_POST['AUTH_PW']);




$sql="SELECT * FROM `wm_auth_users` WHERE  `user_login`='{$_POST['AUTH_USER']}' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());
$COUNT = mysql_numrows($res);
//$r=mysql_fetch_assoc($res);



// ���� ������������ ������
if (($COUNT == 1)) {

if ( empty( $wp_hasher ) ) {
$passinc = $_SERVER['DOCUMENT_ROOT'].'/sc/class-phpass.php';
if (file_exists($passinc)) {

include($passinc);
	};
};

$r=mysql_fetch_assoc($res);

$wp_hasher = new PasswordHash(8, TRUE);

$password_hashed = $r['user_pass'];
$plain_password = $_POST['AUTH_PW'];

if($wp_hasher->CheckPassword($plain_password, $password_hashed)) {
	$AU = 777;
} else {
// ������ �� ������
};



if ($AU == 777) {

$dt=date('Y-m-d H:i:s');


//���� ����� ������ - ��������  ������� �������������� ������
if ($passupp == 1) {

$sql="UPDATE `wm_auth_users` SET `user_pass`='{$password_hashed}' WHERE `user_login`='{$_POST['AUTH_USER']}' LIMIT 1 ";
$res=mysql_query($sql) or die(mysql_error());

};

$new_hash = generateHash();

$sql="INSERT INTO `wm_sessions` (`sid`, `name`, `k`, `v`, `created`) VALUES ('{$new_hash}','llp','{$_POST['AUTH_USER']}','','{$dt}')";
$res=mysql_query($sql) or die(mysql_error());


// ������������ �������� ����� ������������ �� ������� ��������



if ($aj != 1) {
setcookie("llp",$new_hash,time()+60*60*24*30,"","",0);
header('Location: '.$canonical);
//header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
exit();
} else {
echo '759_'.$new_hash;
};
} 
else {
if ($access) {
$access->accessCheck($post_user);
};
if ($aj != 1) {

$answer = '104';
} else {

	echo '104';
};

};
} else {

$dt=date('Y-m-d H:i:s');


if ($access) {
$access->accessCheck($post_user);
};

if (($AU == 777)) {



$sql="INSERT INTO `wm_sessions` (`sid`, `name`, `k`, `v`, `created`) VALUES ('{$new_hash}','llp','{$_POST['AUTH_USER']}','','{$dt}')";
$res=mysql_query($sql) or die(mysql_error());

if ($aj != 1) {
setcookie("llp",$new_hash,time()+60*60*24*30,"","",0);
$answer = '759_'.$new_hash;
} else {

echo '759_'.$new_hash;

};

} else {
//���� ������������ �� ������	
if ($access) {
$access->accessCheck($post_user);
};
if ($aj != 1) {

$answer = '404';
} else {

	echo '404';
};

};


};
} else {

	if ($aj != 1) {

$answer = '303';
} else {
	echo '303';
};
};



} else {
// ������ / �������������� ������� � ��������	
if ($aj != 1) {
$answer = '606';
} else {
echo '606';
};

};
?>