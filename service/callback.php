<?

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
if(!isset($_POST["ph"])) die("no phone");

define("bullshit",1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");

$phone=stripslashes( $_POST["ph"]);
$phone_out="";

$ip = $_SERVER['REMOTE_ADDR'];
$subj="RA Callback $phone  IP=$ip";

//$mail1="agk@fam-electric.ru";
//$mail2="kiv@fam-electric.ru";
$mail3="sales@rusavtomatika.com";
$mail4="lox75v@mail.ru";
//send_message('plesk@mail.ru', $subj, "");
//send_message($mail1, $subj, "");
//send_message($mail2, $subj, "");
send_message($mail3, $subj, "");
send_message($mail4, $subj, "");

for($i=0; $i<strlen($phone); $i++)
{
if(ctype_digit($phone[$i]) )
 $phone_out.=$phone[$i];
else die("íåïğàâèëüíûé íîìåğ, ïîæàëóéñòà, ââåäèòå òîëüêî öèôğû");
}

if(strlen($phone_out)<11)  die("íåïğàâèëüíûé íîìåğ, äîëæíî áûòü íå ìåíåå 11 öèôğ");
if(date("H")>18 || date("H") < 9) die("Ïîæàëóéñòà, ïîçâîíèòå â ğàáî÷åå âğåìÿ ñ 9:00 äî 18:00 ïî Ìîñêâå â áóäíèå äíè");
if(date("w")==6 || date("w")==0)  die("Ïîæàëóéñòà, ïîçâîíèòå â ğàáî÷åå âğåìÿ ñ 9:00 äî 18:00 ïî Ìîñêâå â áóäíèå äíè");



//echo file_get_contents("https://vpbx.sipout.net/c2c?key=2b187446f1f6e0606f4b24212e6b58d8-1361879494&ac=3000604&ph=$phone_out");
echo file_get_contents("https://vpbx.sipout.net/c2c?key=4415e0fff5b65794b068d435901b23ab-1375221561&ac=3000604&ph=$phone_out");


}
else echo "I don't think so";
?>