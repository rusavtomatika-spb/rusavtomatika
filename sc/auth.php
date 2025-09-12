<?
//include "lib_new.php";

function get_script_name($script)  //script names for humans
{
$urls= array("unlock_hmi.php", "set_stock_info.php", "unlock_hmi_users.php", "unlock_hmi_user_reg.php", "view_stock_info_fam.php", "reservations.php",
"unlock_hmi_log.php", "edit_order_on_way.php", "set_order_on_way.php", "user_reg.php", "stoplist.php", "stoplist_add.php");
$names=array("Активация",               "Уст. склад",      "Пользователи",        "Регистрация пользователей КОНТАР", "Склад", "Резервирования",
"Лог активаций", "", "Заказ", "Регистрация пользователей", "Стоплист", "Стоплист+");
if(array_search($script, $urls)===false) return $script;

$ind=array_search($script, $urls);
return $names[$ind]; 


}


function show_login_form()
{
?>
<script>
$(document).keyup(function(e) {
 if (e.keyCode == 13) {
 //alert("sdsds"); 
 if($("#user_login").is(':focus') ||  $("#user_pass").is(':focus')) 
  checklogin();
 }
 });
 
 $(window).load( function() { 
 $("#user_login").focus();
 });
</script>
<?
$out="
<br><br><center>
<div id=login_phone>
Вы не авторизованы. Для авторизации введите <br>
Ваш мобильный номер (только цифры,  например 79315555555 )<br><br>
<input type=text id=user_login>
</div>
<div id=login_pass>
Ожидайте СМС с паролем, введите пароль:<br><br>
<input type=text id=user_pass>
</div>
<br><br>
<div id=login_out> </div>
<br><br>
<div class=zakazbut onclick='checklogin()'> Отправить </div>
<br><br></center>";
return $out;
}

function show_allowed_pages($ur) 
{
$out="";
$a=explode(",", $ur);
for($i=0;$i<sizeof($a); $i++)
 {
  if(strpos($a[$i],"/")!==false && strpos($a[$i],"tool")===false) // out only pages ( no right ) and no scripts( tool in name )
  {  
   $b=explode("/",$a[$i]);
   $link="<a href=$a[$i] class=shl>".get_script_name( $b[sizeof($b)-1] )."</a>";
   $out.=" &nbsp &nbsp ".$link;
  }
 }
 
 if(strpos($ur, "admin_rights")!==false)
 {
 $ss="<a class=shl href=/service";
 $out.=" $ss/set_order_on_way.php >Заказ</a> $ss/unlock_hmi.php> Разлочить панель</a> $ss/unlock_hmi_log.php>Лог разлочки</a>
  $ss/unlock_hmi_users.php>Юзеры разлочки</a> $ss/unlock_hmi_user_reg.php> зарегать юзера разлочки</a> 
  $ss/user_reg.php>Регистрация дистрибов</a> $ss/stoplist.php>Стоплист</a> $ss/stoplist_add.php>Стоплист+</a>
 "; 
 
 
 }

return $out;
}

function check_ura($action, $ur)
{
if(strpos($ur, "admin_rights")!==false) return true;  //admin
if(strpos($ur, $action )=== false) return false;
return true;
}

function get_user_rights()
{
$user_id=mysql_real_escape_string(htmlspecialchars(trim($_SESSION["user_id"])));
$sql="SELECT * FROM `sklad_users` WHERE `id`= '$user_id'";
if(!$res=mysql_query($sql)) return false;
if(!$r=mysql_fetch_object($res)) return false;
if(mysql_num_rows($res)!=1) return false;
return $r->rights;
}


function check_rights_view_page($r)
{
$f=$_SERVER['PHP_SELF'];
if(strpos($r->rights, "admin_rights")!==false) return true;  //admin
if(strpos($r->rights, $f)!==false ) {$_SESSION["surname"]=$r->surname;return true;}

return false;
}

function check_user_rights()
{
$user_id=mysql_real_escape_string(htmlspecialchars(trim($_SESSION["user_id"])));
$sql="SELECT * FROM `sklad_users` WHERE `id`= '$user_id'";
if(!$res=mysql_query($sql)) return false;
if(!$r=mysql_fetch_object($res)) return false;
if(mysql_num_rows($res)!=1) return false;
$f=$_SERVER['PHP_SELF'];
if(strpos($r->rights, "admin_rights")!==false) return true;  //admin
if(strpos($r->rights, $f)!==false ) {$_SESSION["surname"]=$r->surname;return true;}
else {
$_SESSION["mes"]="no rights for user $r->login";
} return false;

}

function user_login()
{
if(!login_from_session())
 {
  if(!login_from_cookie()) 
    {
	 return false;  // no login from cookie and from session
	} 
 }
 
$user_id=mysql_real_escape_string(htmlspecialchars(trim($_SESSION["user_id"])));

$sql="SELECT * FROM `sklad_users` WHERE `id`= '$user_id'";
$res=mysql_query($sql) or die("not user found");
if(!$r=mysql_fetch_object($res)) die("not user found");
if(mysql_num_rows($res)!=1) die("wrong raws number");
 
return $r;
 
}

function say_hello($r)
{
$ap=show_allowed_pages($r->rights);
$slo="";
return "<div id=user_hello>Добро пожаловать, $r->name $ap <span onclick='logout()' style='cursor: pointer; float: right'>Выход ($slo)</span> </div>";
}

function user_say_hello1()
{
$slo="";
if(login_from_session()) {$err.="login OK from session"; $slo="s";}
else 
{
$err.="session login NOT OK".$_SESSION["mess"];
if(login_from_cookie()) {$slo="c"; $err.="cookie login OK session login err=$err"; }
else  { echo show_login_form(); temp3(); die();}//header("Location: /service/login.php");
}
$user_id=mysql_real_escape_string(htmlspecialchars(trim($_SESSION["user_id"])));

$sql="SELECT * FROM `sklad_users` WHERE `id`= '$user_id'";
$res=mysql_query($sql) or die("not user found");
if(!$r=mysql_fetch_object($res)) die("not user found");
if(mysql_num_rows($res)!=1) die("wrong raws number");

$ap=show_allowed_pages($r->rights);
return "<div id=user_hello>Добро пожаловать, $r->name $ap <span onclick='logout()' style='cursor: pointer; float: right'>Выход ($slo)</span> </div>";

}


function login_from_session()
{
if(!isset($_SESSION["comp_id"], $_SESSION["user_id"], $_SESSION["login_string"]))
{
$_SESSION["mess"]="not all session variables"; return false;
}
//if(!isset($_COOKIE["usercpm"])) { $_SESSION["mess"]="no cookie"; return false; }

$comp_id=mysql_real_escape_string(htmlspecialchars(trim($_SESSION["comp_id"])));
$user_id=mysql_real_escape_string(htmlspecialchars(trim($_SESSION["user_id"])));
$login_string=mysql_real_escape_string(htmlspecialchars(trim($_SESSION["login_string"])));
$ip= mysql_real_escape_string(htmlspecialchars(trim($_SERVER['REMOTE_ADDR'])));
$dt=strftime('%Y-%m-%d %T', time());
$browser_info=mysql_real_escape_string(htmlspecialchars(trim($_SERVER['HTTP_USER_AGENT'])));

//echo "try to login via session user_id=$user_id comp_id=$comp_id<br>";

$sql="SELECT * FROM `sklad_comp` WHERE  `id`= '$comp_id' AND `user_id` = '$user_id' ";
if(!$res=mysql_query($sql)) {$_SESSION["mess"] =mysql_error(); return false;}
 if(mysql_num_rows($res)!=1) {$_SESSION["mess"] ="wrong num rows"; return false;} //  check if comp exists
if(!$r=mysql_fetch_object($res)) {$_SESSION["mess"]="comp not found"; return false;}  // need to get browser info
$comp_id=$r->id;
$browser_info=$r->browser_info;  
//echo "browser_info=$browser_info<br>";

$sql="SELECT * FROM `sklad_users` WHERE  `id`= '$user_id' AND `del_by_user`=0 ";
if(!$res=mysql_query($sql)) {$_SESSION["mess"] =mysql_error(); return false;}
if(mysql_num_rows($res)!=1) {$_SESSION["mess"] ="wrong num rows"; return false;} 
if(!$r=mysql_fetch_object($res)) {$_SESSION["mess"]="user not found"; return false;}  
if($r->blocked !=0 || $r->blocked_by_user!= 0 ) {$_SESSION["mess"]="user blocked"; return false;}  
$login=$r->login;


$db_login_string=hash('sha512', $r->pass.$browser_info);
if($db_login_string==$login_string)
{
 //----------------- login OK from session -------------
 //--------------------- put to logins --login OK from session------------------------
$sql="INSERT INTO  `logins` (login,     comp_id,       ip,     time,  browser_info,        login_status, login_from)
                     VALUES ('$login',  '$comp_id',   '$ip',  '$dt',  '$browser_info',          'ok',  'session')";
if(!$res=mysql_query($sql)) {$_SESSION["mess"] =mysql_error(); return false;}

return true;
}
}

function login_from_cookie()
{
if(!isset($_COOKIE["usercmp"])) {$_SESSION["mess"]="no cookie"; return false;}
   
     //echo "try login via cookie ".$_COOKIE["usercmp"];
	 
	 $ip= mysql_real_escape_string(htmlspecialchars(trim($_SERVER['REMOTE_ADDR'])));
     $dt=strftime('%Y-%m-%d %T', time());
     $browser_info=mysql_real_escape_string(htmlspecialchars(trim($_SERVER['HTTP_USER_AGENT'])));
	 $cook=mysql_real_escape_string(htmlspecialchars(trim($_COOKIE["usercmp"])));
	 
	 
	 //----------------try to find comp
	 $sql="SELECT * FROM `sklad_comp` WHERE  `cook`= '$cook' AND `browser_info`='$browser_info' ";
	 if(!$res=mysql_query($sql)) {$_SESSION["mess"] =mysql_error(); return false;}
     if(mysql_num_rows($res)!=1) {$_SESSION["mess"] ="wrong num rows"; return false;}
	 if(!$r=mysql_fetch_object($res))  // need to get user id from comp 
	 {
	   //--------------------- put to logins --login FAIL from cookie------------------------
     $sql="INSERT INTO  `logins` (login,     comp_id,       ip,     time,  browser_info,        login_status, login_from)
                     VALUES ('',  '',    '$ip',  '$dt',  '$browser_info',          'fail',  'cookie')";
     if(!$res=mysql_query($sql)) {$_SESSION["mess"] =mysql_error(); return false;}
	  $_SESSION["mess"]="comp not found"; 
	  return false;
	 } 
	 $comp_id=$r->id; 
	 $user_id=$r->user_id;
	 
	 //--------------------try to find user by user_id get from comp
	 $sql="SELECT * FROM `sklad_users` WHERE  `id`= '$user_id' AND `del_by_user`=0";
     if(!$res=mysql_query($sql)) {$_SESSION["mess"] =mysql_error(); return false;}
     if(mysql_num_rows($res)!=1) {$_SESSION["mess"] ="wrong num rows"; return false;}
	 if(!$r=mysql_fetch_object($res)) {$_SESSION["mess"]="comp not found"; return false;} // need to get user id from comp 
	 if($r->blocked!=0 || $r->blocked_by_user!=0)  {$_SESSION["mess"]="user blocked"; return false;} 
	 
	 $_SESSION['comp_id'] = $comp_id; 
     $_SESSION['user_id'] = $user_id; 
     $_SESSION['login_string']=hash('sha512', $r->pass.$browser_info);
	 
	  //--------------------- put to logins --login OK from cookie------------------------
     $sql="INSERT INTO  `logins` (login,     comp_id,       ip,     time,  browser_info,        login_status, login_from)
                     VALUES ('$r->login',  '$comp_id',    '$ip',  '$dt',  '$browser_info',          'ok',  'cookie')";
     if(!$res=mysql_query($sql)) {$_SESSION["mess"] =mysql_error(); return false;}
	 
	 setcookie("usercmp", $cook, time()+60*60*24*30, '/' ); // update cookie
	 return true;
  
}


function sec_session_start() {
        $session_name = 'sec_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 
 
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(); // regenerated the session, delete the old one.  
}



function customer()
{
?>
  <script>
  $(window).load( function() { 
  
  var now = new Date(); 
  var tm=now.getTime();
  $.ajax({
       url: "/service/checklogin.php",
       type: "POST",
       dataType : "html",   //"json",
        data: {  time: tm  },
       success:function(msg){
     //  alert(msg);
     //  $("#login_out").html(msg);
      // $("#conn_info").html("");
                            },

       });  
  
  }); 
  </script>
  <?
  
  $fv=strftime('%Y-%m-%d %T', time());
  $ip= $_SERVER['REMOTE_ADDR'];

 if(isset($_COOKIE["usercmp"]))   // setcookie("usercmp", $rnd, time()+60*60*24*30, '/' ); //echo "cookie=".$_COOKIE["usercmp"];
  {
   $cook = mysql_real_escape_string( $_COOKIE["usercmp"]);
   $sql="SELECT * FROM `sklad_comp` WHERE `cook` = '$cook' ";
   $res=mysql_query($sql) or die(mysql_error());
   if(!$r=mysql_fetch_object($res)) header("location: /service/login.php");
   


   if($r->reg_ip=="" || $r->reg_ip != $ip) //the same cookie but IP is different , set new cookie
   {
     header("location: /service/login.php");
   }

   if($r->allowed!=1) return "err: Your PC is not approved yet. Your code =  $r->code";

   $cook =mysql_real_escape_string(	$_COOKIE["usercmp"]);
    $server_time=time();
    $client_time=round($_POST["time"]/1000);
    $dif=$server_time-$client_time; 
	
   
   setcookie("usercmp", $cook, time()+60*60*24*30, '/' ); //update cookie
   $sql="UPDATE `sklad_comp` SET `last_visit`='$fv', `last_ip`='$ip' WHERE `cook`='$cook' ";
   $res=mysql_query($sql) or die(mysql_error());

   $sql="SELECT * FROM `sklad_users` WHERE `id`='$r->user_id' ";    // get user info
   $res=mysql_query($sql) or die(mysql_error());
   if(!$r=mysql_fetch_object($res)) return "err: No user found";


   $name="$r->name $r->surname";

   return "ok: $name";


  }
  else  // if no cookie
  {
   header("location: /service/login.php");
 
  //echo "new cookie=".$rnd;
  }
  
  
}

/*
 $rnd=random_str(20);
  $cde=random_num(4);

  setcookie("usercmp", $rnd, time()+60*60*24*30, '/' );


  if(!isset($_GET["var"]))      // if no cookie and no var
  {
  $sql="INSERT INTO  `sklad_comp` (cook, reg_ip, reg_date, code) VALUES ('$rnd', '$ip', '$fv', '$cde') "  ;
  $res=mysql_query($sql) or die(mysql_error());
  return "err: New PC registration. Your code = $cde";      // new user reg
  }
  else     // if no cookie and var is set
  {
   $var=	mysql_real_escape_string(  $_GET["var"]);                               // try to find var in comps table
   $sql= "SELECT * FROM `sklad_comp` WHERE `get_var` = '$var' ";
   $res=mysql_query($sql) or die(mysql_error());
   if(!$r=mysql_fetch_object($res)) return "err: Wrong registration variable";     // var not found

   $sql="SELECT * FROM `sklad_users` WHERE `id`='$r->user_id' ";              // try to find user for found comp
   $res=mysql_query($sql) or die(mysql_error());
   if(!$rr=mysql_fetch_object($res)) return "err: No user found";
   $name="$rr->name $rr->surname";                                       // get user name

   $sql= "UPDATE `sklad_comp` SET `cook` ='$rnd', `reg_ip`='$ip', `reg_date`='$fv', `allowed`='1', `get_var`=''  WHERE `id`='$r->id' ";   // put into table comp info
   $res=mysql_query($sql) or die(mysql_error());


   return "ok: $name";
  }


*/


?>