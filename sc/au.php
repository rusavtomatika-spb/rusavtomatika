<?

//AJAX отправляет данные в UTF-8!!!
// Сделать блокировку и бан при подборе пароля!!!

// Коды для отправки
/*
104 - пользователь на найден
759_$password_hashed - пользователь найден? $password_hashed - кука, которую нужно установить / обновить
301 - нет соединения с базой данных
609 - удаляем куку
303 - нет логина или пароля
606 - лишние символы в каком-то из полей
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

// Если пользователь уже зарегистрирован и у него стоит кука llp (авторизация)
if (isset($_COOKIE['llp'])) {
$hach = $_COOKIE['llp'];

// Очищаем старые сесии
$sql="DELETE FROM `wm_sessions` WHERE `created`<NOW()-INTERVAL 2592000 SECOND";
$res=mysql_query($sql) or die(mysql_error());

//Проверяем куку в сессиях
$sql="SELECT * FROM `wm_sessions` WHERE  `sid`='{$hach}' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());
$COUNT = mysql_numrows($res);

//Если кука есть в сессиях
if ($COUNT == 1) {

$r=mysql_fetch_assoc($res);
$user_login = $r['k'];
$created = strtotime($r['created']);
//$now = date('Y-m-d H:i:s');
$now = strtotime("now");
$diff = $now - $created;

//Обновляем куку (будет ли работать в iframe или ajax ?! если нет, поставить куку JS на стороне браузера)
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
// Находим имя пользователя в таблице пользователей
$sql="SELECT * FROM `wm_auth_users` WHERE  `user_login`='{$user_login}' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());

$countuser = mysql_numrows($res);

if ($countuser == 1) {
$r=mysql_fetch_assoc($res);
$display_name = $r['display_name'];
$unsubscription = $r['unsubscription'];
} else {
	// Обработка потенциально возможной ошибки, когда пользователь на найден в таблице.

};
};
};
}
// если page== exit, т.е. пользователь отлогинивается
else {
if (isset($_COOKIE['llp'])) {

$new_hash = $_COOKIE['llp'];

$sql="DELETE FROM `wm_sessions` WHERE `sid`='{$new_hash}'";
$res=mysql_query($sql) or die(mysql_error());

};
// Удаляем куку
if ($aj != 1) {
setcookie("llp","",time()-1,"","",0);
header('Location: '.$canonical);
exit();
} else {

echo '609';

};
};

// Если пользователь пытается авторизоваться
if ((isset($_POST['AUTH_USER'])) AND (isset($_POST['AUTH_PW']))) {



//$pas = md5($_POST['AUTH_PW']);




$sql="SELECT * FROM `wm_auth_users` WHERE  `user_login`='{$_POST['AUTH_USER']}' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());
$COUNT = mysql_numrows($res);
//$r=mysql_fetch_assoc($res);



// Если пользователь найден
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
// Значит не найден
};



if ($AU == 777) {

$dt=date('Y-m-d H:i:s');


//ЕСЛИ НОВЫЙ ПАРОЛЬ - ДОДЕЛАТЬ  вариант восстановления пароля
if ($passupp == 1) {

$sql="UPDATE `wm_auth_users` SET `user_pass`='{$password_hashed}' WHERE `user_login`='{$_POST['AUTH_USER']}' LIMIT 1 ";
$res=mysql_query($sql) or die(mysql_error());

};

$new_hash = generateHash();

$sql="INSERT INTO `wm_sessions` (`sid`, `name`, `k`, `v`, `created`) VALUES ('{$new_hash}','llp','{$_POST['AUTH_USER']}','','{$dt}')";
$res=mysql_query($sql) or die(mysql_error());


// Перезагрузку страницы нужно организовать на стороне браузера



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
//Если пользователь не нейден	
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
// Лишние / подозрительные символы в запросах	
if ($aj != 1) {
$answer = '606';
} else {
echo '606';
};

};
?>