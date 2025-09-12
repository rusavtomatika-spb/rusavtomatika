<?

// Коды для отправки
/*
104 - пользователь на найден
759_$password_hashed - пользователь найден? $password_hashed - кука, которую нужно установить / обновить
301 - нет соединения с базой данных
609 - удаляем куку
303 - нет логина или пароля
606 - лишние символы в каком-то из полей
222 - Логин уже занят
221 - e-mail уже присутствует в базе
*/

function generateHash($length = 20){
  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}

$post_user = strip_tags($_POST['AUTH_USER']);
$post_pw = strip_tags($_POST['AUTH_PW']);
$post_email = strip_tags($_POST['EMAIL']);

if (($post_user == $_POST['AUTH_USER']) AND ($post_pw == $_POST['AUTH_PW']) AND ($post_email == $_POST['EMAIL'])) {

if ((isset($_POST['AUTH_USER'])) AND (isset($_POST['AUTH_PW'])) AND (isset($_POST['EMAIL']))) {
	
if (file_exists($_SERVER['DOCUMENT_ROOT']."/sc/dbcon.php")) {


include($_SERVER['DOCUMENT_ROOT']."/sc/dbcon.php");

database_connect();

mysql_query("SET NAMES 'cp1251'");



$sql="SELECT * FROM `wm_ip_log` WHERE  `IP`='{$_SERVER['REMOTE_ADDR']}' AND `data`>=DATE_SUB(CURDATE(),Interval 1 DAY) LIMIT 1";
				$res=mysql_query($sql) or die(mysql_error());

				$countuser = mysql_numrows($res);
				
				if ($countuser == 1) {
					$row  = mysql_fetch_assoc($res);
					$accesCount = $row['auth'];
					$accessID = $row['id'];
					if ($accesCount > 4) {
						exit('Попробуйте позже');
					};
					
				} else {$accesCount = 0;}; 

	
$sql="SELECT * FROM `wm_auth_users` WHERE  `user_login`='{$post_user}' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());

$countuser = mysql_numrows($res);


if ($countuser == 0) {
//$r=mysql_fetch_assoc($res);

	
$sql="SELECT * FROM `wm_auth_users` WHERE  `user_email`='{$_POST['EMAIL']}' LIMIT 1";
$res=mysql_query($sql)or die(mysql_error());

$countuser = mysql_numrows($res);	


if ($countuser == 0) {
//$r=mysql_fetch_assoc($res);

// Регистрация пользователя

if ( empty( $wp_hasher ) ) {
	$passinc = $_SERVER['DOCUMENT_ROOT'].'/sc/class-phpass.php';
if (file_exists($passinc)) {

include($passinc);
	};
$wp_hasher = new PasswordHash( 8, true );
	}
$password_hashed = $wp_hasher->HashPassword( $post_pw );
	
$nickname = strtolower($post_user);
$dater = date('Y-m-d H:i:s');	
	
$sql="INSERT INTO `wm_auth_users`(`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES ('','{$post_user}', '{$password_hashed}', '{$nickname}', '{$post_email}', '', '{$dater}', '', '0', '{$post_user}')";

$res=mysql_query($sql)or die(mysql_error());
	
$new_hash = generateHash();	
	
$sql="INSERT INTO `wm_sessions` (`sid`, `name`, `k`, `v`, `created`) VALUES ('{$new_hash}','llp','{$_POST['AUTH_USER']}','','{$dater}')";
$res=mysql_query($sql)or die(mysql_error());

if ($accesCount > 0) 
{
	$accesCount++;
	$sql="UPDATE `wm_ip_log` SET `data`='{$dater}',`login`='{$post_user}',`auth`='{$accesCount}' WHERE `id`='{$accessID}' LIMIT 1";		
	$res=mysql_query($sql) or die(mysql_error());	
} else {
	$accesCount++;
	$sql="INSERT INTO `wm_ip_log`(`id`, `data`, `IP`, `login`,`auth`) VALUES ('','{$dater}','{$_SERVER['REMOTE_ADDR']}','{$post_user}','{$accesCount}')";		
	$res=mysql_query($sql) or die(mysql_error());	
};

if ($aj != 1) {
setcookie("llp",$new_hash,time()+60*60*24*30,"","/",0);
$answer = '759_'.$new_hash;
} else {

echo '759_'.$new_hash;

};

	
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=windows-1251\r\n";
$headers .= "From: Weintek.net<info@weintek.net>\r\n";	

$message = 'Пользователь '.$post_user.' зарегистрирован на сайте';
	
$send_mas[0] = 'sales@rusavtomatika.com';

$titleS = "Регистрация на сайте Weintek.net";

for ($i=0; $i<count($send_mas); $i++)
 {
	 $mail = mail($send_mas[$i],$titleS,$message,$headers);
	 };	


$send_mas[0] = $post_email;

$message = '<strong>Здравствуйте, '.$post_user.'!</strong><br /><br />Вы зарегистрировались на сайте <a href="http://weintek.net">weintek.net</a>.<br /><br />Логин: '.$post_user.'<br />Пароль: '.$post_pw.'<br /><br />
Благодарим за регистрацию!<br /><br />__<br />С уважением,<br />команда <a href="http://weintek.net">Weintek.net</a>';

for ($i=0; $i<count($send_mas); $i++)
 {
	// $mail = mail($send_mas[$i],$titleS,$message,$headers);
	 };	

} else {
 // e-mail уже присутствует в базе
$answer = '221';

if ($aj == 1) { 
	echo '221';	
};	


};	


} else {
//222 - Логин уже занят
$answer = '222';

if ($aj == 1) { 
	echo '222';	
};	


};


} else {
//301 - нет соединения с базой данных	
if ($aj != 1) { 
$answer = '301';
} else {
	echo '301';	
};	
	
};	
} else {
//303 - нет логина или пароля	
if ($aj != 1) { 
$answer = '303';
} else {
	echo '303';	
};
	
};	

} else {
//606 - лишние символы в каком-то из полей	
if ($aj != 1) { 
$answer = '606';
} else {
echo '606';		
};
	
};