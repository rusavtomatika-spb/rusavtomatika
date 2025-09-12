<?
//include "../dbcon.php";


function add_to_basket()
{
if(defined('basket_shit')) return;
define('basket_shit', 1);

echo "
<div id=amount_q>
<table><tr><td>
 <span id=modn>11</span> </td><td>
Кол-во: </td><td>
<table cellpadding=0 cellspacing=0 border=0>
<tr><td class= am_td><input type=text id=items_amount></td><td>

<table cellpadding=0 cellspacing=0>
<tr><td class=am_td width=20 align=center><img src=/images/but_plus.png width=12 onclick='am_inc();'></tr></tr>
<tr><td class=am_td width=20 align=center><img src=/images/but_minus.png width=12 onclick='am_dec();'></tr></tr>
</table>
</td></tr></table>
</td></tr></table>
<center>
<span class=orangebut onclick='add_item();'>OK</span>
</center>
</div>
<br><br>
";

} 
 
function popup_messages()
{
if(defined('popup_shit')) return;
define('popup_shit', 1);
echo "
<div id=mes_container>
<div id=mes_header onclick='hide_popup();'>
Сообщение
</div>
<div id=mes_body>

body
</div>
</div>
<div id=mes_backgr> </div>
";
//---------------------- popmes 1 --
echo "
<div id=popmes1 style='display:none;'>

Для обсуждения скидки <br>
сообщите нам свой телефонный номер<br>
<input id='phone' type=text >
<br><br>
<table width=100%>
<td width=50% align=center>
<span class=orangebut onclick='get_discount_form()'>Отправить</span>
</td><td align=center>
<span class=orangebut onclick='hide_popup()'>Закрыть</span>
</td></table>

<div id=form_out> </div>

</div>
";

}	
	
	
	
function basket()
{

if(defined('basket_shit1')) return;
define('basket_shit1', 1);

echo "
<div id=slided> 
<br>
<div id=basket_container>
<div id=basket>
<center><span class=bask_head style='font-size: 15px;'>Корзина</span></center><br>
<div id=resba> </div>
<br><center>
<span class=bask_head style='font-size: 15px; cursor: pointer;' onclick='window.location=\"/oformit_zakaz.php\"' >Оформить</span> 
&nbsp &nbsp 
<span class=bask_head style='font-size: 15px; cursor: pointer;' onclick='clean_basket();' >Очистить</span> </center>
</div></div></div>

<div id=basket_small onclick='ts()'>basket </div>
";




}

function show_series_open_hmi()
{
echo "<br><br>";

echo "<div class=series_name>Серия OpenHMI </div>";

echo "<br><center><div class=series_descr>Серия 8000 появилясь в 2000 году и сразу же стала очень популярна во всем мире. Отличительной
особенностью серии 6000 был впервые примененый широкоугольный дисплей. Теперь уже большинство производителей панелей оператора 
предлагают широкоугольные дисплеи.  </div></center><br>";

echo "<table width=100%>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT607i");
echo "</td><td align=center valign=top>";
show_panel1("MT612XH");   // end row 
echo "</td></tr>    
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT610i");
echo "</td><td align=center valign=top>";
show_panel1("MT615XH");  // end row 
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT610XH");
echo "</td><td align=center valign=top>";
echo "</td></tr></table>";
}


function show_series_ie()
{
echo "<br><br>";

echo "<div class=series_name>Серия  iE </div>";

echo "<br><center><div class=series_descr>Серия 8000 появилясь в 2000 году и сразу же стала очень популярна во всем мире. Отличительной
особенностью серии 6000 был впервые примененый широкоугольный дисплей. Теперь уже большинство производителей панелей оператора 
предлагают широкоугольные дисплеи.   </div></center><br>";

echo "<table width=100%>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT8070iE");
echo "</td><td align=center valign=top>";
show_panel1("MT8100iE");   // end row 
echo "</td></tr></table>";

}



function show_series_emt()
{
echo "<br><br>";

echo "<div class=series_name>Серия  eMT3000 </div>";

echo "<br><center><div class=series_descr>Серия 8000 появилясь в 2000 году и сразу же стала очень популярна во всем мире. Отличительной
особенностью серии 6000 был впервые примененый широкоугольный дисплей. Теперь уже большинство производителей панелей оператора 
предлагают широкоугольные дисплеи.  </div></center><br>";

echo "<table width=100%>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("eMT3070A");
echo "</td><td align=center valign=top>";
show_panel1("eMT3105P");   // end row 
echo "</td></tr>    
<tr height=300><td width=50% align=center valign=top>";
show_panel1("eMT3120A");
echo "</td><td align=center valign=top>";
show_panel1("eMT3150A");  // end row 
echo "</td></tr></table>";


}


function show_series_8000()
{
echo "<br><br>";

echo "<div class=series_name>Серия 8000 </div>";

echo "<br><center><div class=series_descr>Серия 8000 появилясь в 2000 году и сразу же стала очень популярна во всем мире. Отличительной
особенностью серии 6000 был впервые примененый широкоугольный дисплей. Теперь уже большинство производителей панелей оператора 
предлагают широкоугольные дисплеи.  </div></center><br>";

echo "<table width=100%>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT8050i");
echo "</td><td align=center valign=top>";
show_panel1("MT8100i");   // end row 
echo "</td></tr>    
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT8070iH");
echo "</td><td align=center valign=top>";
show_panel1("MT8104iH");  // end row 
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT8104XH");
echo "</td><td align=center valign=top>";
show_panel1("MT8150X");  // end row 
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT8121X");
echo "</td> <td> </td>
</tr></table>";

}


function show_series_6000()
{
echo "<br><br>";

echo "<div class=series_name>Серия 6000i </div>";

echo "<br><center><div class=series_descr>Серия 6000i появилясь в 2000 году и сразу же стала очень популярна во всем мире ,благодаря отличному
соотношению цена/качество, а также удобству загрузки проекта с ПК по USB кабелю. Отличительной
особенностью серии 6000i был впервые в мире примененый на панелях оператора широкоугольный дисплей. В настоящее время, усвоив успешный опыт Weintek,
большинство производителей операторских панелей также 
предлагают широкоугольные дисплеи.  </div></center><br>";

echo "<table width=100%>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT6050i");
echo "</td><td align=center valign=top>";
show_panel1("MT6100i");
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
show_panel1("MT6070iH");
echo "</td> <td> </td>
</tr></table>";


}



//-------------------------------- show panel pc ifc ---------------------------
function show_ifc($num)
{
$im="/images";
$altstr="операторские панели, сенсорные панели, HMI, Weintek, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder";


database_connect();


$sql="SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());

$r=mysql_fetch_object($res);


$inter=$r->serial;
if($r->ethernet) $inter.=", Ethernet";
if($r->sdcard) $inter.=", SD карта";
if($r->usb_host) $inter.=", USB host";


 echo "
 <table width=300>
 <tr><td class=pan_name11 colspan=2 >$r->diagonal\" &nbsp;Панельный компьютер  $r->model <div class=hc11> &nbsp;</div> </td><td></td></tr>
 <tr height=5><td colspan=3> </td></tr>
 <tr>
 <td width=180 class=price11 align=left> <a href=/weintek/".$r->model.".php><img src=$im/pc/$r->pic_small width=130 border=0 alt='$r->model, $altstr'></a>";

 //

 if($r->onstock==0) $onst=" <img src=$im/red_sq.gif >&nbsp;&nbsp;&nbsp;под заказ 4 нед.";
 else $onst= "<img src=$im/green_sq.gif >&nbsp;&nbsp;&nbsp;есть на складе";


 echo" </td><td class=pan_price valign=top align=left>

 <table><width=100%>
 <tr><td width=40>Цена</td><td width=40> <div class=prpr title='Нажмите для пересчета в РУБ'><font color=black>$r->retail_price</font></div></td><td><div class=val_name title='Нажмите для пересчета в РУБ'> USD</div></td></tr>
 <tr><td colspan=3> &nbsp;</td></tr>
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>
 <div class='zakazbut' idm='$r->model'><span>Получить скидку</span></div>

 </td>
 </tr></table>";

 echo "<div class=bor><table width=300 cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=70 >Диагональ</td><td class=par_val11 width=70 >$r->diagonal\"</td>
 <td class=par_name11 width=70>Разрешение</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >Цветность</td><td class=par_val11>$r->colors</td>
 <td class=par_name11>ПО</td><td class=par_val11>$r->software</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3>$inter</td></tr>


 </table></div>";

}

//------------------------------------------------- function show panel ------------------------------------------
function show_panel1($num)
{
$im="/images";
$altstr="операторские панели, сенсорные панели, HMI, Weintek, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder";


database_connect();


$sql="SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());

$r=mysql_fetch_object($res);


$inter=$r->serial;
if($r->ethernet) $inter.=", Ethernet";
if($r->sdcard) $inter.=", SD карта";
if($r->usb_host) $inter.=", USB host";


 echo "
 <table width=300>
 <tr><td class=pan_name11 colspan=2 >$r->diagonal\" &nbsp;Панель оператора $r->model <div class=hc11> &nbsp;</div> </td><td></td></tr>
 <tr height=5><td colspan=3> </td></tr>
 <tr>
 <td width=180 class=price11 align=left> <a href=/weintek/".$r->model.".php><img src=$im/panel/$r->pic_small width=130 border=0 alt='$r->model, $altstr'></a>";

 //

 if($r->onstock==0) $onst=" <img src=$im/red_sq.gif >&nbsp;&nbsp;&nbsp;под заказ 4 нед.";
 else $onst= "<img src=$im/green_sq.gif >&nbsp;&nbsp;&nbsp;есть на складе";


 echo" </td><td class=pan_price valign=top align=left>

 <table><width=100%>
 <tr><td width=40>Цена</td><td width=40> <div class=prpr title='Нажмите для пересчета в РУБ'><font color=black>$r->retail_price</font></div></td><td><div class=val_name title='Нажмите для пересчета в РУБ'> USD</div></td></tr>
 <tr height=30><td colspan=3 align=center ><span  onclick='show_popup(\"popmes1\");' style='cursor:pointer;'> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
 <tr><td colspan=3>  &nbsp</td></tr>

 
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>
 <div class='zakazbut' idm='$r->model'><span>В корзину</span></div>

 </td>
 </tr></table>";

 echo "<div class=bor><table width=300 cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=70 >Диагональ</td><td class=par_val11 width=70 >$r->diagonal\"</td>
 <td class=par_name11 width=70>Разрешение</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >Цветность</td><td class=par_val11>$r->colors</td>
 <td class=par_name11>ПО</td><td class=par_val11>$r->software</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3>$inter</td></tr>


 </table></div>";

}


function temp0($name)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/ra.css" />
    
	<link rel="stylesheet" type="text/css" href="/css/menu2.css" />
	<link rel="stylesheet" type="text/css" href="/css/menu4.css" />
	<link rel="stylesheet" type="text/css" href="/css/tabs.css" />
	<link rel="stylesheet" type="text/css" href="/css/button.css" />
	<link rel="stylesheet" type="text/css" href="/css/tango/skin.css" />
	

    <meta http-equiv=Content-Type content=text/html; charset=windows-1251>
    <title>dialog demo</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="/js/ra_scripts.js"></script>
	<script type="text/javascript" src="/js/s.js"></script>
	<script type="text/javascript" src="/js/jquery.maskedinput.js"></script>

	
	
	
	
	<script src="/js/search.js"></script>
	
	
	
</head>
<body>

<noscript>
  This page needs JavaScript activated to work.<br>
  Пожалуйста, включите Javascript чтобы просмотреть эту страницу
     
  <style>div { display:none; }</style>
</noscript>

<style>
html, body, p, div, table, td, th, img, h1, h2, h3, h4, h5, h6, input, textarea, ul, ul li, dl, dt, dd, form {
margin: 0;
padding: 0;
}
body{
background: #ebebeb;
}

.hdr {
	-moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	-webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	box-shadow:inset 0px 1px 0px 0px #fce2c1;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffc477), color-stop(1, #fb9e25) );
	background:-moz-linear-gradient( center top, #ffc477 5%, #fb9e25 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffc477', endColorstr='#fb9e25');
	background-color:#ffc477;
	-moz-border-radius:1px;
	-webkit-border-radius:1px;
	border-radius:1px;
	border:1px solid #eeb44f;
	display:inline-block;
	color:#2b2b2b;
	font-family:arial;
	font-size:13px;
	font-weight:bold;
	padding:7px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ebebeb;
	width: 100%;
	/*height: 30px;*/
	text-align: center;
}
/*
.hdr:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477) );
	background:-moz-linear-gradient( center top, #fb9e25 5%, #ffc477 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477');
	background-color:#fb9e25;
	*/
}
.hdr:active {
	position:relative;
	top:1px;
}

.mainbg{
background: #ffffff;
height: 500px;
width: 1000px;
align: center;
}

 .shadow {
    background: white; /* Цвет фона */
   // -moz-box-shadow: 1px 1px10px rgba(0,0,0,0.5); /* Для Firefox */
   // -webkit-box-shadow: 1px 1px 10px rgba(0,0,0,0.5); /* Для Safari и Chrome */
  //  box-shadow: 1px 1px 10px rgba(0,0,0,0.5); /* Параметры тени */
	box-shadow:9px 10px 11px #525252;
   // padding: 10px;
//	width: 100px;
   }
   
 .hl_text{
 font-family:arial;
	font-size:17px;
	font-weight:bold;
}

 
</style>

<center>


<div id=hdiv class=shadow style="width: 1150px; background: white;  text-align: left">


<table width=100% bgcolor=white><tr><td width=300px>
<img src=../images/logo.jpg style="padding-left: 10px;" >
</td><td> </td></tr></table>
<?

}
/* --- cssmenu 5
<div id='cssmenu'>
<ul>
   <li class='active'><a href='index.html'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Products</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Product 1</span></a>
            <ul>
               <li><a href='#'><span>Sub Item</span></a></li>
               <li class='last'><a href='#'><span>Sub Item</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Product 2</span></a>
            <ul>
               <li><a href='#'><span>Sub Item</span></a></li>
               <li class='last'><a href='#'><span>Sub Item</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>About</span></a></li>
   <li class='last'><a href='#'><span>Contact</span></a></li>
</ul>
</div>


*/



//style="padding-left: 10px;"
function top_buttons()
{
?>
<style>
.sel{
background: #ffffcc;
cursor:default;
font: 11px/15px Arial,sans-serif;
font-family: Arial, sans-serif;
font-size: 12px;
font-style: normal;
font-variant: normal;
font-weight: normal;
border: 1px dotted #e17310;
padding:2px;
}
</style>

<div id='cssmenut' >
<ul>
 <li><a href='#'><span> &nbsp </span></a></li>
 <li><a href='/'><span>ГЛАВНАЯ</span></a></li>
 <li><a href='/weintek'><span>ПРОДУКЦИЯ</span></a></li>
 <li><a href='index.html'><span>ДРАЙВЕРЫ</span></a>
   
 <li><a href='index.html'><span>СКАЧАТЬ</span></a></li>
 </ul>
 <table width=600 height=100%><tr><td width=400> </td><td valign=middle>
 <input type='text' id=tete> 
 <div id=sho style="position: absolute; z-index: 30; width: 200px;" > </div></td>
 <td valign=middle ><img src='../images/lupa_sm.png' width=20></td>
 
</tr></table>
</div>


<?
}

function temp1()
{
echo "
<table width=100% cellpadding=0 cellspacing=0><tr><td valign=top width=250px>";// <!-- MAIN TABLE     td left menu -->

}

function temp1_no_menu()
{
echo "
<table width=100% cellpadding=0 cellspacing=0><tr><td valign=top width=0px>";// <!-- MAIN TABLE     td left menu -->

}

function left_menu()
{
?>
<br>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='index.html'><span>КАТАЛОГ</span></a></li>
   <li class='has-sub'><a href='#'><span>ПАНЕЛИ WEINTEK</span></a>
      <ul>
         <li class='has-sub'><a href='/weintek/series6000i.php'><span>Серия MT6000i</span></a>
            <ul>
			   <li><a href='#'><span>MT6050i</span></a></li>
               <li><a href='#'><span>MT6070iH</span></a></li>
			   <li class='last'><a href='#'><span>MT6100i</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='/weintek/series8000i.php'><span>Серия MT8000i</span></a>
            <ul>
               <li><a href='#'><span>MT8050i</span></a></li>
               <li><a href='#'><span>MT8070iH</span></a></li>
               <li class='last'><a href='#'><span>MT8100i</span></a></li>
               
            </ul>
         </li>
		  <li class='has-sub'><a href='#'><span>Серия eMT3000</span></a>
            <ul>
               <li><a href='#'><span>eMT3070A</span></a></li>
               <li><a href='#'><span>eMT3105P</span></a></li>
               <li><a href='#'><span>eMT3120A</span></a></li>
               <li><a href='#'><span>eMT3150A</span></a></li>                            
            </ul>
         </li>
		 
		 <li class='has-sub'><a href='#'><span>Серия iE</span></a>
            <ul>
               <li><a href='#'><span>MT8070iE</span></a></li>
               <li><a href='#'><span>MT8100iE</span></a></li>
                                        
            </ul>
         </li>
		 
		  <li class='has-sub'><a href='#'><span>Серия OPEN HMI</span></a>
            <ul>
               <li><a href='#'><span>MT607i</span></a></li>
               <li><a href='#'><span>MT610i</span></a></li>
               <li><a href='#'><span>MT610XH</span></a></li>
               <li><a href='#'><span>MT612XH</span></a></li>
               <li><a href='#'><span>MT615XH</span></a></li>
                                        
            </ul>
         </li>
		 
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>КОМПЬЮТЕРЫ IFC</span></a></li>
     <ul>
	 
	 </ul>
	 <li class='has-sub'><a href='#'><span>КОМПЬЮТЕРЫ APLEX</span></a></li>
     <ul>
	 
	 </ul> 
	 
   <li class='has-sub'><a href='#'><span>ПАНЕЛИ SAMKOON</span></a></li>
   <li class='has-sub'><a href='#'><span>КОНТРОЛЛЕРЫ</span></a></li>
   
   
</ul>
</div>



<?
}

function temp2()
{
?>
</td> 
<td valign=top> <!-- MAIN TABLE     td right content -->
<?
}

function temp3()
{
?>
</td></tr></table><!-- end main table -->

</div> <!-- end main div -->

<div style="background: #898989; height: 100px; width: 1150px;" class=shadow>
<br>
&copy www.rusavtomatika.com 2008-2013
 </div>


</body>

</html>


<?
}

//--------------------------------------- mail functions -------------------------------------------

function mime_header_encode($str, $data_charset, $send_charset) {
  if($data_charset != $send_charset) {
    $str = iconv($data_charset, $send_charset, $str);
  }
  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}


function send_message  (
                        $email, // email получателя

                        $subj, // тема письма
                        $text // текст письма

                        )


 {
     $name_from="RA no-reply"; // имя отправителя
     $email_from="no-reply@rusavtomatika.com"; // email отправителя
     $name_to=""; // имя получателя
     $data_charset="UTF-8"; // кодировка переданных данных
     $send_charset="UTF-8"; // кодировка письма
     $html = TRUE; // письмо в виде html или обычного текста
     $reply_to = FALSE;

  if($email=="admin") $email="plesk@mail.ru";


  $to = mime_header_encode($name_to, $data_charset, $send_charset)
                 . ' <' . $email . '>';
  $subject = mime_header_encode($subject, $data_charset, $send_charset);
  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
                     .' <' . $email_from . '>';
  if($data_charset != $send_charset) {
    $body = iconv($data_charset, $send_charset, $body);
  }
  $headers = "From: $from\r\n";
  $type = ($html) ? 'html' : 'plain';
  $headers .= "Content-type: text/$type; charset=$send_charset\r\n";
  $headers .= "Mime-Version: 1.0\r\n";
  if ($reply_to) {
      $headers .= "Reply-To: $reply_to";
  }



  return mail($to, $subj, $text, $headers);
}



function XMail( $from, $to, $subj, $text, $filename)
{
$subj=iconv("UTF-8", "CP1251", $subj);
$text=iconv("UTF-8", "CP1251", $text);
$f         = fopen($filename,"rb");
$un        = strtoupper(uniqid(time()));
$head      = "From: $from\n";
$head     .= "To: $to\n";
$head     .= "Subject: $subj\n";
$head     .= "X-Mailer: PHPMail Tool\n";
$head     .= "Reply-To: $from\n";
$head     .= "Mime-Version: 1.0\n";
$head     .= "Content-Type:multipart/mixed;";
$head     .= "boundary=\"----------".$un."\"\n\n";
$zag       = "------------".$un."\nContent-Type:text/html;\n";
$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
$zag      .= "------------".$un."\n";
$zag      .= "Content-Type: application/octet-stream;";
$zag      .= "name=\"".basename($filename)."\"\n";
$zag      .= "Content-Transfer-Encoding:base64\n";
$zag      .= "Content-Disposition:attachment;";
$zag      .= "filename=\"".basename($filename)."\"\n\n";
$zag      .= chunk_split(base64_encode(fread($f,filesize($filename))))."\n";


if (!mail("$to", "$subj", $zag, $head))
 return 0;
else
 return 1;
}



?>