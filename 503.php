<?php
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 300');//300 seconds
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/config.php";
if (EX != "_") {
    global $CONTENT_ON_WIDE_SCREEN;
    $CONTENT_ON_WIDE_SCREEN = false;
    require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
} else {
    define("bullshit", 1);
    include_once("sc/dbcon.php");
    include_once("sc/lib_new.php");

    if (!isset($connection) || $connection != 1) {
        global $mysqli_db;
        database_connect();
        mysqli_query($mysqli_db, "SET NAMES 'utf8'");
    };
    temp0("weintek");
    top_buttons();
    basket();
    temp1_no_menu();
//left_menu();


    temp2();
//basket();
//---------------content ---------------------
//<div id=ban class=bbb> </div>
//'height-min:600px; overflow:auto;'

    echo "
<div style=\"height: 100%;padding: 40px 0px;text-align:center;

width: 100%;\" >Страница не найдена! Попробуйте начать поиск с <a href=\"/\">Главной страницы</a> или выберите нужный раздел:<br /><br />

<div class='quicks'>

<a href='/weintek/'><div class='quik'>
<img src='/images/weintek/MT8090XE/MT8090XE_1.png' width='130' border='0' alt='9.7&quot; MT8090XE, панели оператора Weintek'><br />
<div class='descript'>Панели оператора</div>
<strong>Weintek</strong>
</div></a>

<a href='/samkoon/'><div class='quik'>
<img src='/images/samkoon/SK-102AS/SK-102AS_1.png' width='130' border='0' alt='Samkoon 10.2&quot; SK-102AS'><br />
<div class='descript'>Панели оператора</div>
<strong>Samkoon</strong>
</div></a>

<a href='/panelnie-computery/ifc/RF.php'><div class='quik'>
<img src='/images/ifc/IFC-619RF/IFC-619RF_1.png' width='130' border='0' alt='19&quot; IFC-619RF IFC '><br />
<div class='descript'>Панельные компьютеры на базе процессора Intel Atom D525</div>
<strong>IFC серия RF</strong>
</div></a>

<a href='/panelnie-computery/ifc/i3.php'><div class='quik'>
<img src='/images/ifc/IFC-622i3/IFC-622i3_1.png' width='130' border='0' alt='22&quot; IFC-622i3 IFC '><br />
<div class='descript'>Панельные компьютеры на базе процессора Intel i3</div>
<strong>IFC серия i3</strong>
</div></a>

<a href='/panelnie-computery/aplex/'><div class='quik'>
<img src='/images/aplex/ARCHMI-715P/ARCHMI-715P_1.png' width='130' border='0' alt='15&quot; ARCHMI-715P, панельный компьютер Aplex, изображение панельного компьютера index, фото панельного компьютера'><br />
<div class='descript'>Панельные компьютеры</div>
<strong>Aplex</strong>
</div></a>


<a href='/box-pc/'><div class='quik'>
<img src='/images/box-pc/IFC-BOX2800/IFC-BOX2800_1.png' width='130' border='0' alt='IFC-BOX2800'><br />
<div class='descript'>Встраиваемые компьютеры</div>
<strong>IFC</strong>
</div></a>


<a href='/monitors/'><div class='quik'>
<img src='/images/ifc/IFC-M150/IFC-M150_1.png' width='130' border='0' alt='IFC-M150 монитор'><br />
<div class='descript'>Промышленные мониторы</div>
<strong>IFC</strong>
</div></a>


<a href='/ewon/'><div class='quik'>
<img src='/images/ewon/COSY131/COSY131_1.png' width='130' border='0' alt='VPN-роутер COSY-131'><br />
<div class='descript'>VPN-роутеры и серверы</div>
<strong>eWON</strong>
</div></a>


<a href='/plc/yottacontrol/'><div class='quik'>
<img src='/images/controllers/yottacontrol/A-51x/A-51x_17.png' width='130' border='0' alt='PLC Yottacontrol серия A-51'><br />
<div class='descript'>PLC, контроллеры</div>
<strong>Yottacontrol</strong>
</div></a>


<a href='/bloki-pitaniya/faraday/'><div class='quik'>
<img src='/images/faraday/faraday-36W/faraday-36W_1.png' width='130' border='0' alt='Блок питания Faraday 36W/12-24V/95AL'><br />
<div class='descript'>Блоки питания 12-24V</div>
<strong>Faraday</strong>
</div></a>


</div>
<br /><br /><br />
<style>
.descript {height:70px;width:100%;}
.quicks a {color:black;}
.quicks {width: 1000px;
  margin: auto;}
.quik {
  float: left;
  width: 182px;
  padding: 10px 4px;
  margin: 5px;
  height: 195px;
  outline: 1px solid rgb(193, 197, 200);
  box-shadow: 0px 0px 5px rgb(188, 192, 195);
  padding-top: 22px;


}

#body_cont{

	height: auto !important;
min-height: 100%;
   }

   /*#footer {



position: fixed;
z-index: 1;
bottom:0px;
left: 20px;
   box-shadow: 9px 10px 11px #525252;

   }*/

</style>
";


    echo "


<br><br>";

    echo "</div>";
}
?>

<?


//-----------------end content
if (EX != "_") {
    ?>

    <div class="column is-12">
        <h1>Извините, сервис недоступен.</h1>
        <h2>Ошибка 503!</h2>
        <p>Проблема носит временный характер.<br>
Необходимо просто дождаться, когда доступ восстановится автоматически.<br>
<strong>Попробуйте начать поиск с <a href="/">Главной страницы</a></strong></p>
    </div>


    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

} else {
    temp3();
}
?>