<?

function get_link_to_controllers($model)
{
    global $mysqli_db;
    $sql = "SELECT * FROM `controllers` WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);

    return "/plc/" . strtolower($r->brand) . "/$model.php";
}

function show_banner_controller($model)
{
    global $mysqli_db;

    $sql = "SELECT * FROM `controllers` WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);
    $im = img($model, '1');
    $bt = "<img src=/images/th_up.png>";
    $trh = "height=26";

    $ml = get_link_to_controllers($model);
// <span style='width: 200px; display: inline-block;'></span>
//<span valign=center>Цена: $r->retail_price USD</span>  <span class=button_podr style='float:right;' onclick='window.location=\"$ml\"'> Подробнее </span>

    if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
        or ($r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
        $onst = "";
    else
        $onst = ", есть на складе";

    $pluses = array();
    if ($r->spec_modif != '') {
        $pluses[] = $r->spec_modif;
    };

    $pluses[] = 'Оптимальное соотношение цены и качества';

    if ($r->DI_isol == '1') {
        $diisol = ' изолированные';
    };
    if ($r->DI > 0) {
        if (($r->pnp == 1) AND ($r->pnp == 1)) {
            $pnpn = ' (подключение PNP и NPN устройств) ';
        } elseif ($r->pnp == 1) {
            $pnpn = ' (подключение PNP устройств) ';
        } elseif ($r->npn == 1) {
            $pnpn = ' (подключение NPN устройств) ';
        };
        $pluses[] = 'Дискретные входы: ' . $r->DI . 'DI' . $pnpn . '' . $diisol;
    } else if ($r->DI_full != '') {

        $pluses[] = 'Дискретные входы: ' . $r->DI_full . ' (подключение PNP и NPN устройств)' . $diisol;
    };

    if ($r->DO_isol == '1') {
        $doisol = ', изолированные';
    }

    if ($r->DO > '0') {
        $pluses[] = 'Дискретные выходы: ' . $r->DO . 'DO' . $doisol;
    } elseif ($r->DO_full != '') {
        $pluses[] = 'Дискретные выходы: ' . $r->DO_full . '' . $doisol;
    };


    if ($r->AI_full != '') {

        $pluses[] = 'Аналоговые входы: ' . $r->AI_full;
    } else
        if ($r->AI > 0) {
            $pluses[] = 'Аналоговые входы: ' . $r->AI . 'AI';
        };

    if ($r->AO_full != '') {

        $pluses[] = 'Аналоговые выходы: ' . $r->AO_full;
    } else
        if ($r->AO > 0) {
            $pluses[] = 'Аналоговые выходы: ' . $r->AO . 'AI';
        };


    if (($r->brand == 'Yottacontrol') AND ($r->type == 'module')) {
        $pluses[] = 'Совсместимы со всеми контроллерами ' . $r->brand . '<br />и устройствами Modbus';
    };

    if (($r->brand == 'Yottacontrol') AND ($r->model == 'A-3016')) {

        $pluses[] = 'Радиус действия до 100 метров от контроллера';
    };

    $yotta = array();
    if (!empty($r->serial_full)) {
        $yotta[] = $r->serial_full . ' ( Modbus )';
    };
    if (!empty($r->usb_host)) {
        $yotta[] = $r->usb_host;
    };
    if (!empty($yotta)) {
        $pluses[] = implode(', ', $yotta);
    };

    if (!empty($r->power_adapter)) {
        $pluses[] = $r->power_adapter;
    };

    if (!empty($pluses)) {
        $plus_table = "<tr $trh><td>$bt</td><td><div class=ban_list>" . implode("</div></td></tr><tr $trh><td>$bt</td><td><div class=ban_list>", $pluses) . "</div></td></tr>";
    };
//<tr $trh><td>$bt</td><td><div class=ban_list> Полная поддержка протокола Modbus</div></td></tr>


    if ($model == 'A-1060') {
        $add_style = '  margin-top: 20px;';
    } else {
        $add_style = '';
    };

    if ($r->type == 'controller') {
        $type = 'ПЛК';
    } else if ($r->type == 'module') {
        $type = 'Универсальный модуль ввода-вывода<br />';
    };

    $out = "
<div class='banner'>
<table><tr>
<td width=400><a href='$ml'><img src='$im' style='  max-height: 280px;  margin-left: 50px;$add_style'></a></td><td width=720 valign=top>
<div class=banner_cont>
<div class=h1_ban>$type <strong> $r->brand $r->model </strong></div>
<div class=h2_ban>
<table>
" . $plus_table . "
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price USD$onst  </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>
</table>
</div>
</div>
</td></tr>
</table>
</div>
";

    return $out;
}

function stock_controllers($model)
{
    global $mysqli_db;
    $sql = "SELECT * FROM `controllers` WHERE `model` = '$model' AND `modification`='1' LIMIT 1 ";
    $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_fetch_object($res);
    if (((($r->onstock_spb == '0') && ($r->onstock_msk == '0') && ($r->onstock_kiv == '0'))) OR (empty($r))) {


        $line = 'под заказ';
        return '<span class="stocks">' . $line . '</span>';
    } else {

        return '<span class="stocks" style="color: rgb(0, 202, 0);">&#10004; на складе</span>';
    };
}

function show_controllers_yotta_a61_1()
{


    $h = h();
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-61x/A-61x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-61x/lg/A-61x_1.png';
    $im1 = img('A-61x', 1);
    $bim1 = imgbig('A-61x', 1);

    $alt = 'PLC Yottacontrol серия A-61';

    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt' style='  margin-top: 33px;'></span></a>";


    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';

    $out = "<br><br>

$a1<$h id='plc-a-61' class=series_name>Программируемые контроллеры Yottacontrol серия A-61</$h>$a2


<table style='  width: 1050px;  margin: auto;'>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>
<center>
  $min_table</center>
</td><td>
" . '<table width="100%" style="  margin-top: 20px;">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Бесплатное ПО <a href="/soft/Yottacontrol/YottaEdit.rar" download>YottaEditor ( скачать )</a> для создания проектов (&nbsp;языки FBD и LAD&nbsp;)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Более 100 функций YottaEditor, среди них: PID регулятор, управление шаговыми двигателями, математические и логические функции. <a href="/manuals/YottaEditor.chm.zip" download>Скачать полное описание</a></td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Загрузка проекта в PLC по RS-485</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Порты: 1xRS-485</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Напряжение питания 10-30 VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Подключение шагового двигателя напрямую к контроллеру ( без драйвера ) до 1,75A</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Расширение с помощью модулей серии <a href="#modules">A-10</a> и <a href="#modules-a-21">A-21</a></td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Часы реального времени ( RTC )</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">ШИМ до 100 кГц, подключение энкодеров до 250 кГц</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">В комплекте DIN рейка</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Совместимы с сенсорными панелями Weintek, Samkoon, а также любыми PLC, SCADA, поддерживающими Modbus</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text"><a href="/images/controllers/yottacontrol/ce/A6.png" rel="lightbox[11]">Сертификат CE</a></td></tr>
' .
        "</tbody></table>
</td></tr></table>" .
        '<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">Модель</span> <span style="  width: 669px;">Характеристики</span></a><span style="width:90px;">Цена с НДС</span><span style="margin-left: 7px;">Наличие</span></div></div>
<div style="width: 1050px;  margin: auto;   display: table;">

<div class="" style="">
<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные входы</span></h3>
</div>
</div>
' . children_menu('A-6188x') . '
</div>

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные и аналоговые входы</span></h3>
</div>
</div>
' . children_menu('A-6189x') . '
</div>

<div class="co">
<div  class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные входы&nbsp;и&nbsp;питание от&nbsp;сети&nbsp;220V</span></h3>
</div>
</div>
' . children_menu('A-6188x-A') . '
</div>

</div>
</div>' .
        $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function show_controllers_yotta_a51_1()
{

    $alt = 'PLC Yottacontrol серия A-51';

    $h = h();
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-5188x/A-5188x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-5188x/lg/A-5188x_1.png';
    $im1 = img('A-51x', 1);
    $bim1 = imgbig('A-51x', 1);
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt' style='  margin-top: 35px;'></span></a>";


    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';

    $out = "<br><br>

$a1<$h id='plc-a-51' class=series_name>Программируемые контроллеры Yottacontrol серия A-51</$h>$a2


<table style='  width: 1050px;  margin: auto;'>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>
<center>
  $min_table</center>
</td><td>
" . '<table width="100%" style="  margin-top: 20px;">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Бесплатное ПО <a href="/soft/Yottacontrol/YottaEdit.rar" download>YottaEditor ( скачать )</a> для создания проектов (&nbsp;языки FBD и LAD&nbsp;)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">104 FBD-функций, 97 LD-функции в YottaEditor, среди них: PID регулятор, управление шаговыми двигателями, математические и логические функции. <a href="/manuals/YottaEditor.chm.zip" download>Скачать полное описание</a></td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Загрузка проекта в PLC по USB, либо через любой COM порт</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Порты: 2xRS-485, 1xRS-232 ( Modbus ), miniUSB ( только загрузка проекта )</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Напряжение питания 10-30 VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Подключение шагового двигателя напрямую к контроллеру ( без драйвера ) до 1,75A</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Расширение с помощью модулей серии <a href="#modules">A-10</a></td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Часы реального времени ( RTC )</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">ШИМ до 100 кГц, подключение энкодеров до 250 кГц</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">В комплекте DIN рейка</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Совместимы с сенсорными панелями Weintek, Samkoon, а также любыми PLC, SCADA, поддерживающими Modbus</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text"><a href="/images/controllers/yottacontrol/ce/A5.png" rel="lightbox[12]">Сертификат CE</a></td></tr>
</tbody></table>' .
        "
</td></tr></table>" .
        '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">Модель</span> <span style="  width: 669px;">Характеристики</span></a><span style="width:90px;">Цена с НДС</span><span style="margin-left: 7px;">Наличие</span></div></div>
<div style="width: 1050px;  margin: auto;   display: table;">
<div class="" style="  ">

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные входы и выходы</span></h3>
</div>
</div>
' . children_menu('A-5188x') . '
</div>

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные и аналоговые входы, дискретные выходы</span></h3>
</div>
</div>
' . children_menu('A-5189x') . '
</div>

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные и аналоговые входы и выходы</span></h3>
</div>
</div>
' . children_menu('A-5190x') . '
</div>

</div></div>
' .
        $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function show_controllers_yotta_a2_1()
{

    $alt = 'PLC Yottacontrol серия A-21';

    $h = h();
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-218x/A-218x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-218x/lg/A-218x_1.png';
    $im1 = img('A-2060x', 1);
    $bim1 = imgbig('A-2060x', 1);
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt' style='width: 300px;  margin-top: 40px;  margin-left: 50px;'></span></a>";


    $a1 = '<div class="head_block" >';
    $a2 = '</div>';
    $tick = '<img src="/images/tick.png" width="15"> ';

    $out = "<br><br>

$a1<$h id='modules-a-2' class=series_name>Модули-расширения Yottacontrol серия A-2</$h>$a2


<table style='  width: 1050px;  margin: auto;'>
<tr ><td valign=top align=center valign=center width=500px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>
<center>
  $min_table</center>
</td><td>
" . '<table width="100%">

<tbody>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Модуль расширения для PLC Yottacontrol серии <a href="#plc-a-61">A-61</a></td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Светодиодная индикация входов-выходов</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Дискретные выходы: 4 реле / 4 транзистор</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">В комплекте DIN-рейка</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Напряжение питания 10~30 VDC / 220 VAC</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Бесплатное программное обеспечение для диагностики (YottaUtility)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text"><a href="/images/controllers/yottacontrol/ce/A2.png" rel="lightbox[13]">Сертификат CE</a></td></tr>
' .
        "</tbody></table>
</td></tr></table>" .
        '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">Модель</span> <span style="  width: 669px;">Характеристики</span></a><span style="width:90px;">Цена с НДС</span><span style="margin-left: 7px;">Наличие</span></div></div>
<div style="width: 1050px;  margin: auto;   display: table; ">
<div class="" style="  ">

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные входы</span></h3>
</div>
</div>
' . children_menu('A-2060x') . '
</div>

</div></div>
' .
        $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function show_controllers_yotta_a10x_1()
{

    $alt = 'Yottacontrol универсальные модули ввода-вывода серии A-10';

    $h = h();
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-101x/A-101x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-101x/lg/A-101x_1.png';
    $im1 = img('A-10', 1);
    $bim1 = imgbig('A-10', 1);
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt' style='  margin-top: 17px;'></span></a>";


    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';
    $out = "<br><br>

$a1<$h id='modules-a-10' class=series_name>Универсальные модули ввода-вывода Yottacontrol серий A-10, A-30</$h>$a2


<table style='  width: 1050px;  margin: auto;  height: 325px;'>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>
<center>
  $min_table</center>
</td><td>
" . '<table width="100%">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Универсальные модуль вввода-вывода с Modbus</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Совместимы со всеми PLC Yottacontrol</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Совместимы с любыми PLC, HMI, SCADA, поддерживающими Modbus</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Напряжение питания 10-30 VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Светодиодная индикация входов-выходов</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">В комплекте DIN рейка</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Бесплатное программное обеспечение для диагностики (YottaUtility)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text"><a href="/images/controllers/yottacontrol/ce/A1.png" rel="lightbox[10]">Сертификат CE</a></td></tr>


</tbody></table>' .
        "
</td></tr></table>" .
        '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">Модель</span> <span style="  width: 669px;">Характеристики</span></a><span style="width:90px;">Цена с НДС</span><span style="margin-left: 7px;">Наличие</span></div></div>
<div style="width: 1050px;  margin: auto;   display: table;">
<div class="" style="  ">

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные входы и выходы</span></h3>
</div>
</div>
' . children_menu('A-10x') . '
' . children_menu('A-3016') . '
</div>

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Аналоговые входы и выходы </span></h3>
</div>
</div>
' . children_menu('A-101x') . '
</div>


</div></div>
' .
        $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function show_controllers_yotta_a12x_1()
{

    $alt = 'Yottacontrol универсальные модули ввода-вывода с Wi-Fi серии A-12';

    $h = h();
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-101x/A-101x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-101x/lg/A-101x_1.png';
    $im1 = img('A-1212', 1);
    $bim1 = imgbig('A-1212', 1);
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt' style='  margin-top: 17px;'></span></a>";


    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';
    $out = "<br><br>

$a1<$h id='modules-a-12' class=series_name>Универсальные модули ввода-вывода с Wi-Fi Yottacontrol серия A-12</$h>$a2


<table style='  width: 1050px;  margin: auto;  height: 325px;'>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>
<center>
  $min_table</center>
</td><td>
" . '<table width="100%">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Универсальные модуль вввода-вывода с Modbus</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Wi-Fi подключение к точке доступа, IoT, дистанционное управление с пульта</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Совместимы со всеми PLC Yottacontrol</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Совместимы с любыми PLC, HMI, SCADA, поддерживающими Modbus</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Напряжение питания 10-30 VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">В комплекте DIN рейка</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Бесплатное программное обеспечение для диагностики (YottaUtility)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text"><a href="/images/controllers/yottacontrol/ce/A1.png" rel="lightbox[10]">Сертификат CE</a></td></tr>


</tbody></table>' .
        "
</td></tr></table>" .
        '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">Модель</span> <span style="  width: 669px;">Характеристики</span></a><span style="width:90px;">Цена с НДС</span><span style="margin-left: 7px;">Наличие</span></div></div>
<div style="width: 1050px;  margin: auto;   display: table;">
<div class="" style="  ">

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Аналоговые входы и выходы</span></h3>
</div>
</div>
' . children_menu('A-12x') . '
</div>

<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price" style="width: 490px;"><span style="  color: rgb(121, 89, 89);">Пульты управления Wi-Fi с обратной связью</span></h3>
</div>
</div>
' . children_menu('A-3288') . '
' . children_menu('A-3289') . '


</div></div>


</div></div>
' .
        $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function show_controllers_yotta_a18x_1()
{

    $alt = 'Yottacontrol универсальные модули ввода-вывода с Ethernet серии A-18';

    $h = h();
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-101x/A-101x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-101x/lg/A-101x_1.png';
    $im1 = img('A-1851', 1);
    $bim1 = imgbig('A-1851', 1);
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt' style='  margin-top: 17px;'></span></a>";


    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';
    $out = "<br><br>

$a1<$h id='modules-a-12' class=series_name>Универсальные модули ввода-вывода с Ethernet Yottacontrol серия A-18</$h>$a2


<table style='  width: 1050px;  margin: auto;  height: 325px;'>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>
<center>
  $min_table</center>
</td><td>
" . '<table width="100%">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Универсальные модуль вввода-вывода с Modbus</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Ethernet и USB интерфейсы</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Совместимы со всеми PLC Yottacontrol</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Совместимы с любыми PLC, HMI, SCADA, поддерживающими Modbus</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Напряжение питания 10-30 VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">В комплекте DIN рейка</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Бесплатное программное обеспечение для диагностики (YottaUtility)</td></tr>
<!--tr><td width="30">' . $tick . '</td><td class="hl_text"><a href="/images/controllers/yottacontrol/ce/A1.png" rel="lightbox[10]">Сертификат CE</a></td></tr-->


</tbody></table>' .
        "
</td></tr></table>" .
        '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">Модель</span> <span style="  width: 669px;">Характеристики</span></a><span style="width:90px;">Цена с НДС</span><span style="margin-left: 7px;">Наличие</span></div></div>
<div style="width: 1050px;  margin: auto;   display: table;">
<div class="" style="  ">

<div class="co">
<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные входы</span></h3>
</div>
</div>
' . children_menu('A-18x') . '
</div>





</div></div>


</div></div>
' .
        $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function show_controllers_yotta_a52_1()
{

    $alt = 'PLC Yottacontrol серия A-52';


    $h = h();
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-52x/A-52x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-52x/lg/A-52x_1.png';
    $im1 = img('A-52x', 1);
    $bim1 = imgbig('A-52x', 1);
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt' style='  margin-top: 25px;'></span></a>";


    $a1 = '<div class="head_block" >';
    $a2 = '</div>';
    $tick = '<img src="/images/tick.png" width="15"> ';


    $out = "<br><br>

$a1<$h id='plc-a-52' class=series_name>Программируемые Wi-Fi контроллеры Yottacontrol серия A-52</$h>$a2


<table style='  width: 1050px;  margin: auto;  margin-top: 20px;'>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>
<center>
  $min_table</center>
</td><td>
" . '<table width="100%">

<tbody>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Все контроллеры с ЖК-дисплеем и Wi-Fi.</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Бесплатное приложение для iOS / Android — APP «WStation-Pro» для прямого мониторинга и управления контроллером</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Бесплатное ПО <a href="/soft/Yottacontrol/YottaEdit.rar" download>YottaEditor ( скачать )</a> для создания проектов (&nbsp;языки FBD и LAD&nbsp;)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">108 FBD-функций, 103 LD-функции в YottaEditor. <a href="/manuals/YottaEditor.chm.zip" download>Скачать полное описание</a></td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Подключение к Wi-Fi точке доступа, IoT, управление с пульта <a href="/plc/yottacontrol/A-3288.php">A-3288</a> c обратной связью</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Дискретные входы: 2 / 4 / 8DI, низкий уровень &lt; 2VDC, высокий уровень &gt; 4VDC (подключение PNP и NPN устройств)</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Дискретные выходы: 4</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">Аналоговые входы: - / 4AI(0~10VDC) / 4 AI 0~20mA/0~10V/термодатчик(PT-100,J,K...)</td></tr>
<tr><td width="30">' . $tick . '</td><td  class="hl_text">RS-485x1 ( Modbus ), USBx1, Wi-Fix1</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Расширение с помощью модулей серии <a href="#modules">A-10</a></td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Напряжение питания 10-30 VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">Часы реального времени ( RTC )</td></tr>


</tbody></table>' .
        "</td></tr></table>" .
        '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">Модель</span> <span style="  width: 669px;">Характеристики</span></a><span style="width:90px;">Цена с НДС</span><span style="margin-left: 7px;">Наличие</span></div></div>
<div style="width: 1050px;  margin: auto;   display: table;  margin-top: 20px;">
<div class="" style="  ">


<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Дискретные и аналоговые входы и выходы</span></h3>
</div>
</div>
' . children_menu('A-52x') . '

<div class="congroup">
<div class="conparams" style="  display: inline-block;">
<h3 class="pan_price" style="width: 490px;"><span style="  color: rgb(121, 89, 89);">Пульты управления Wi-Fi с обратной связью</span></h3>
</div>
</div>
' . children_menu('A-3288') . '
' . children_menu('A-3289') . '


</div></div>
' .
        $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function children_stock($num)
{
    global $mysqli_db;

    $sql = "SELECT `index` FROM `controllers` WHERE `parent` = '$num'";
    $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_num_rows($res);
    if ($r > 1) {

        $sql = "SELECT `index` FROM `controllers` WHERE `parent` = '$num' AND (`onstock`>'0' OR `onstock_spb`>'0' OR `onstock_msk`>'0' OR `onstock_kiv`>'0')";
    } else {
        $sql = "SELECT `index` FROM `controllers` WHERE `model` = '$num' AND (`onstock`>'0' OR `onstock_spb`>'0' OR `onstock_msk`>'0' OR `onstock_kiv`>'0')";
    };
    $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_num_rows($res);

    if ($r == 1) {
        $our = '(1&nbsp;модель в&nbsp;наличии)';
    } else if ($r > 1 && $r < 5) {
        $our = '(' . $r . '&nbsp;модели в&nbsp;наличии)';
    } else if ($r > 4 && $r < 21) {
        $our = '(' . $r . '&nbsp;моделей в&nbsp;наличии)';
    } else if ($r > 20) {
        $our = '(в&nbsp;наличии)';
    } else {
        $our = '';
    };

    if (!empty($our)) {
        $our = '<span class="green">' . $our . '</span>';
    };

    return $our;
}

function children($num)
{
    global $mysqli_db;
    $sql = "SELECT `index` FROM `controllers` WHERE `parent` = '$num' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_num_rows($res);


    return $r;
}

function children_menu($num)
{
    global $mysqli_db;
    $sql = "SELECT * FROM `controllers` WHERE `parent` = '$num' ORDER BY `model` ASC ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_num_rows($res);

    if ($r == 0) {
        $sql = "SELECT * FROM `controllers` WHERE `model` = '$num' ORDER BY `model` ASC  ";
        $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

        $r = mysqli_num_rows($res);
    };

    if ($r > 0) {
        $o .= '<ul class="submenu_controllers">';
        for ($i = 0; $i < $r; $i++) {
            $row = mysqli_fetch_array($res);
            $add = array();
            $outs = array();
            if ($num == 'A-3016') {
                $hk = ' (радиоуправление)';
            } else {
                $hk = '';
            };
            if ($row['DI'] > 0) {
                $add[] = $row['DI'] . 'DI' . $hk;
            };
            if ($row['AI_full'] != '') {
                $add[] = $row['AI_full'];
            } else
                if ($row['AI'] > 0) {
                    $add[] = $row['AI'] . 'AI (0~10VDC)';
                };
            if ($row['DO'] > 0) {
                if ((preg_match('/T/i', $row[model])) OR ($row[transistor] == '1')) {
                    if ($row[pnp] == '1')
                        $a = ' PNP';
                    elseif ($row[npn] == '1')
                        $a = ' NPN';
                    else
                        $a = '';
                    $add[] = $row['DO'] . 'DO' . ' (транзистор' . $a . ')';
                } else {
                    if ($row[relay_power] == '1')
                        $a = 'силовое ';
                    else
                        $a = '';
                    if ($row[model] == 'A-1255') {
                        $add[] = $row['DO'] . 'DO' . ' (привод мотора)';
                    }
                    if ($row[relay] == '1' OR ($row[relay_power] == '1') OR $row[relay_signal] == '1') {
                        $add[] = $row['DO'] . 'DO' . ' (' . $a . 'реле)';
                    };
                };
            };

            if ($row['AO'] > 0) {
                $add[] = $row['AO'] . 'AO';
            };
            if (preg_match('/M/i', $row[model])) {
                $add[] = 'micro-SD (архив)';
            } else
                if (preg_match('/[0-9]{4}D/i', $row[model])) {
                    $add[] = 'LCD-экран';
                } else if (!preg_match('/A-32|A-12/i', $row[model])) {
                    $add[] = 'LED-индикаторы';
                };

            if ($row['serial_full'] != '') {
                $add[] = $row['serial_full'];
            };
            if ($row['usb_hosts'] > 0) {
                $add[] = 'USB2.0x' . $row['usb_hosts'] . '(прог)';
            };

            if (preg_match('/A-52/i', $row[model])) {
                $add[] = 'Wi-Fi';
            };
            if (preg_match('/A-12/i', $row[model])) {
                $add[] = 'Wi-Fi';
            };

            if (preg_match('/-A$/i', $row[model])) {
                $add[] = 'питание 220 VAC power';
            };

            if ($row[onstock] > '0' OR $row[onstock_spb] > '0' OR $row[onstock_msk] > '0' OR $row[onstock_kiv] > '0') {
                $stock = '<span class="green"><img src="/images/tick.png" width="14"></span>';
            } else {
                $stock = '<span class="green" style="width:14px;"></span>';
            };

            if (preg_match('/A-3288/i', $row[model])) {
                $add[] = 'Wi-Fi с обратной связью';
                $add[] = 'дисплей ' . $row[display];
                $add[] = $row[func_keys] . ' функциональных кнопок';
            };
            if (preg_match('/A-3289/i', $row[model])) {
                $add[] = 'Wi-Fi с обратной связью';
                $add[] = $row[func_keys] . ' функциональных кнопок';
            };

            if (($row[retail_price] != '0') AND ($row[retail_price] != '')) {
                $priceb = "<div class=val_name style='float:right;  font-size: 13px;' title='Нажмите для пересчета в РУБ'>USD </div><div class=prpr style='  font-size: 13px;float: right;margin-right: 5px;' title='Нажмите для пересчета в РУБ'>$row[retail_price]</div>";

                $basket = '<div idm="' . $row[model] . '" class="zakazbut3 yes addToCart" title="В корзину"><img src="/images/into-cart.png"></div>';
            } else {
                $priceb = "
<div style='' class='zakazbut init' idm='$row[model]' onclick='show_backup_call(6, \"$row[model]\")' >по&nbsp;запросу</div>";
                $basket = '';
            };

            $o .= '<li><div class="submenu_controller">' . $basket . '<a href="/plc/yottacontrol/' . $row[model] . '.php"><span class="name">' . $row[model] . '</span> <span style="  width: 660px;">' . implode(', ', $add) . '</span></a><span style="width:90px;">' . $priceb . '</span><span style="margin-left: 35px;">' . $stock . '</span>
</div>
</li>';
        }
        $o .= '</ul>';
    };
    return $o;
}

function show_controller($num)
{
    global $mysqli_db;

    $im = "/images";
    $altstr = "операторские панели, сенсорные панели, HMI, Weintek, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder";


//database_connect();
//mysqli_query("SET NAMES 'cp1251'");

    $sql = "SELECT * FROM `controllers` WHERE `model` = '$num' AND `parent`='' LIMIT 1";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_fetch_object($res);


    $inter = $r->serial;
//if ($r->DI_isol == '1') {$diisol = ' (изолированные)';};
//if ($r->DO_isol == '1') {$doisol = ' (изолированные)';};
//if ($r->DI_full !='') {$di = $r->DI_full.$diisol;} else
    if ($r->DI > 0) {
//if (($r->pnp == 1) AND ($r->pnp == 1)) {$pnpn = ' ( подключение PNP и NPN устройств ) ';} elseif ($r->pnp == 1) {$pnpn = ' ( подключение PNP устройств ) ';} elseif ($r->npn == 1) {$pnpn = ' ( подключение NPN устройств ) ';};
        $in[] = $r->DI . 'DI' . $pnpn . '' . $diisol;
    };

//if ($r->DO_isol == '1') {$doisol = ', изолированные';}
//if ($r->DO_full != '') {$do =   $r->DO_full.$doisol;} else
    if ($r->DO > '0') {

        $in[] = $r->DO . 'DO' . $doisol;
    };


//if ($r->AI_full !='') {$ai = $r->AI_full;} else
    if ($r->AI > 0) {

        $in[] = $r->AI . 'AI';
    };

//if ($r->AO_full !='') {$ao = $r->AO_full;} else
    if ($r->AO > 0) {
        $in[] = $r->AO . 'AO';
    };


    if ($r->serial_full)
        $in[] = $r->serial_full;
    if ($r->ethernet)
        $in[] = "Ethernet";
    if ($r->sdcard)
        $in[] = $r->sdcard;
    if ($r->usb_host)
        $in[] = "USB-host";
    if ($r->can_bus)
        $in[] = "CAN";

    if (!empty($in) AND (is_array($in))) {
        $inter .= implode(', ', $in);
    };

//if (preg_match('/-T/i',$r->model)) {$t_r = 'транзисторный';} else {$t_r = 'релейный';};
//$im/panel/$r->pic_small
    $fo = "controllers";


    if ($r->software == "") {
        $poos = "ОС";
        $poos1 = $r->os;
    } else {
        $poos = "ПО";
        $poos1 = $r->software;
    }

    if ($r->type == "controller") {
        $type = array('Контроллер', 'Контроллеры');
        $types = array('контроллер', 'контроллера', 'контроллеров');
    };
    if ($r->type == "module") {
        $type = array('Модуль', 'Модули');
        $types = array('модуль', 'модуля', 'модулей');
    };
    if ($r->type == "transmitter") {
        $type = array('Пульт управления', 'Пульты управления');
        $types = array('пульт управления', 'пульта управления', 'пультов управления');
    };


//$imm="$im/panel/$r->pic_small";
//$imm=get_small_pic($r->model);


    $im1 = 'images/controllers/' . strtolower($r->brand) . '/' . $r->model . '/' . $r->model . '_1.png';
    $default_im1 = 'images/controllers/' . strtolower($r->brand) . '/default/' . $r->series . '.png';
    $alt = $r->brand . ' ' . $r->model;

    $b = '/' . $r->brand . '/i';
    if (preg_match($b, $r->model)) {
        $brand = '';
    } else {
        $brand = $r->brand;
    };
    if (file_exists("../sc/new.php")) {
        include("../sc/new.php");
    } else {
        $class = '';
    };


    if ($GLOBALS["net"] == 0) {

        if (!file_exists($GLOBALS["path_to_real_files"] . '/' . $im1)) {
            if (!file_exists($GLOBALS["path_to_real_files"] . '/' . $default_im1)) {
                $im1 = '';
            } else {
                $im1 = $default_im1;
            };
        };
    } else {
        $re = cu($GLOBALS["path_to_real_files"] . '/' . $im1);
        if ($re[0] <= 0) {
            $re = cu($GLOBALS["path_to_real_files"] . '/' . $default_im1);
            if ($re[0] <= 0) {
                $im1 = '';
            } else {
                $im1 = $default_im1;
            };
        };
    };

    $imm = $im1;

    $alt = $r->brand . ' ' . $r->model;
//$imm="/images/panel/$r->model/$r->model"."_2.png";
//pan_name11
//<tr height=5><td colspan=3> </td></tr>
    if (file_exists("../sc/new.php")) {
        include("../sc/new.php");
    } else {
        $class = '';
    };


//-------CHILDREN------------

    $kolvo = children($r->model);

    if ($kolvo > 1) {
        $ty = $type[1];
        if (($kolvo > 4) AND ($kolvo < 21)) {
            $d_name = $types[2];
        } else {
            $koltostring = $kolvo + '';
            $last = substr($koltostring, -1);
            $kol = $last + 0;
            if ($kol == 1) {
                $d_name = $types[0];
            } elseif (($kol > 1) AND ($kol < 5)) {
                $d_name = $types[1];
            } else {
                $d_name = $types[2];
            };
        };
        $chil = '<span style="  color: rgb(121, 89, 89);">(' . $kolvo . ' ' . $d_name . ')</span>';
    } else {
        $chil = '';
        $ty = $type[0];
    };

    if (($r->diagonal == '') or ($r->diagonal == 0)) {
        $di = '';
    } else {
        $di = $r->diagonal . '&Prime;';
    };
    $out = "
 <div class='pan_sm_cont'>
 <table width='100%'>
 <tr><td class=pan_price colspan=2 ><a href=/$fo/$r->model.php style='text-decoration: none;'><h3 class='pan_price $class' style='cursor:pointer;'>$di &nbsp;$ty $r->model $chil</h3></a>
 <div class=hc11> &nbsp;</div> </td><td></td></tr>

 <tr>
 <td width=180 class=price11 align=left height=180 valign=middle> <a href=/$fo/$r->model.php>
 <img src='/$imm' width=130 border=0 alt='$alt'></a>";

    $onst = show_stock($r, 2);

//<tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
    //<tr><td colspan=3>  &nbsp</td></tr>

    $bw = "90px";
    $tdw = "120px";
    // right column


    if (($r->retail_price != '0') AND ($r->retail_price != '')) {
        $priceb = "<div class=val_name style=''  title='Нажмите для пересчета в РУБ'>USD </div><div class=prpr style='' title='Нажмите для пересчета в РУБ'>$r->retail_price</div>";
    } else {
        $priceb = "
<div style='margin-top:8px;display: initial;
padding: 0px;float: right;
border: none;font-size:12px;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >по&nbsp;запросу</div>";
    };

    $out .= " </td><td  class=pan_price valign=top align=left>

 <table width=100%>
 <tr><td colspan=3>$priceb<div class='pan_price price_name3' style=''>Цена&nbsp;&nbsp;</div></td></tr>


 <tr><td colspan=3 height=20> &nbsp </td></tr>
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>

 <table>
 <tr height=50><td width=$tdw align=right>  <div class='zakazbut2 addToCart' style='width:$bw;' idm='$r->model'><span>В корзину</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
 </tr height=50><tr>
     <td width=$tdw align=rigth>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </td>
  </tr></table>

 </td>
 </tr></table>";

    if ($kolvo > 1) {
        $common = "title='Общие интерфейсы для этой группы'";
    } else {
        $common = '';
    };

    $out .= "<div class=bor><table width=100% cellpadding=0 cellspacing=0 border=0>

  <tr bgcolor=#f1f1f1 class=par_name11 style='height: 34px;'><td colspan=4>$r->spec_modif<br />$r->IO</td></tr>

 <tr><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3><span $common>$inter</span></td></tr>
  <tr bgcolor=#f1f1f1><td class=par_name11>$poos</td><td class=par_val11 colspan=3>$poos1</td></tr>
 <tr><td class=par_name11>Питание</td><td class=par_val11 colspan=3>$r->voltage</td></tr>

 </table></div>
 </div>";

    return $out;
}

function mini_controllers($model, $mins_in_row, $mins_max, $table_width)
{
    global $mysqli_db;
    $sql = "SELECT * FROM `controllers` WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);

    if ($r !== false && $r->model != "") {  // if there is model in the database
        if ($r->parent != "")
            $sql = "SELECT * FROM `controllers` WHERE `model` = '$r->parent' ";
        $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
        $r = mysqli_fetch_object($res);


        $imgroot = "/images/controllers/" . strtolower($r->brand) . "/$r->model";
        $imgroot1 = "/images/controllers/" . strtolower($r->brand) . "/" . $r->series;

        $imfo = $GLOBALS["path_to_real_files"] . $imgroot . "/sm";
        $imfo1 = $GLOBALS["path_to_real_files"] . $imgroot1 . "/sm";

        $miniatures_in_raw = $mins_in_row;
        $modd = $r->model;
    } else {  // if no model in the database
        $imgroot = "/images/controllers/yottacontrol/$model";

        $imfo = $GLOBALS["path_to_real_files"] . $imgroot . "/sm";

        $miniatures_in_raw = $mins_in_row;
        $modd = $model;
    }
//echo 'NEN'.$imfo;


    if ($GLOBALS["net"] == 0) {
        if (file_exists($imfo)) {
            $yes = 1;
        } else
            if (file_exists($imfo1)) {
                $yes = 1;
                $imfo = $imfo1;
                $imgroot = $imgroot1;
                $modd = $r->series;
            } else {
                $yes = 0;
            };
    } else {
        $re = ftp_rus_connect($imgroot . "/sm");
//var_dump ($re);
        $re1 = ftp_rus_connect($imgroot1 . "/sm");
//var_dump ($re1);
        if (!empty($re)) {
            $yes = 1;
        } else if (!empty($re1)) {
            $yes = 1;
            $imfo = $imfo1;
            $imgroot = $imgroot1;
            $modd = $r->series;
        } else {
            $yes = 0;
        };
    };


    if ($yes == 1) {
        if ($GLOBALS["net"] == 0) {

            $files = scandir($imfo . '/sm');
        } else {
            $imfo = $imgroot . "/sm";
            $files = ftp_rus_connect($imfo);
        };

        $miniatures = sizeof($files) - 2;


        $min_table = "<table class=\"minitable\" width=$table_width bfcolor=red><tr>";
        $mc = 0;

        if ($miniatures > $mins_max)
            $miniatures = $mins_max;

        $alt = $r->brand . ' ' . $model;
        $lgfo = $GLOBALS["path_to_real_files"] . $imgroot . "/lg";

        if ($GLOBALS["net"] == 0) {

            $lgfiles = scandir($lgfo);
        } else {
            $lgfo = $imgroot . "/lg";
            $lgfiles = ftp_rus_connect($lgfo);
        };

        for ($i = 0; $i < $miniatures; $i++) {
            $j = $i + 1;


            $fne = $modd . '_' . $j . '.png';
            if ((in_array($fne, $lgfiles))) {
                if ($i > 0) {
                    $lbox = "<a class=\"lightbox\" href=\"$imgroot/lg/$modd" . "_$j.png\" rel=\"lightbox[1]\"></a>";
                    $lclass = "class=\"toclick\"";
                    $llink = '"' . $imgroot . '/lg/' . $modd . '_' . $j . '.png"';
                } else {
                    $lbox = "<a class=\"lightbox\" href=\"$imgroot/lg/$modd" . "_$j.png\" rel=\"box[1]\"></a>";
                    $lclass = "class=\"toclick\"";
                    $llink = '"' . $imgroot . '/lg/' . $modd . '_' . $j . '.png"';
                };
            } else {
                $lbox = '';
                $lclass = '';
                $llink = '"0"';
            };

            $min_table .= "<td $lclass  onclick='dich(\"$imgroot/$modd" . "_$j.png\",$llink);'><img src=$imgroot/sm/$modd" . "_$j.png width=50 alt='$alt'>$lbox</td>
  ";
            $mc++;
            if ($mc == $miniatures_in_raw) {
                $mc = 0;
                $min_table .= "</tr><tr>";
            }
        }
        while ($mc < $miniatures_in_raw) {
            $mc++;
            $min_table .= "<td></td>";
        }

        $min_table .= "</tr></table>";
        //$im1="/images/panel/$r->model/$r->model"."_1.png";

        if ($miniatures == 1)
            $min_table = "";
    } else {
        $min_table = "";
//$im1="/images/panel/$r->pic_big";
    }

    return $min_table;
}

function img_mini($num, $co, $mins_in_row, $mins_max, $table_width)
{
    global $mysqli_db;
    $miniatures_in_raw = $mins_in_row;
    if ((!empty($co)) && (is_numeric($co))) {
        $limit = 'LIMIT ' . $co;
    } else {
        $limit = '';
    };
    $sql = "SELECT * FROM `gallery_controllers` WHERE `model` = '$num' ORDER BY `por`,`id` $limit";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_num_rows($res);

    if ($r > 0) {
        $o = array();
        $osm = array();
        $olg = array();
        $alts = array();
        $alt = $num;
        for ($i = 0; $i < $r; $i++) {

            $row = mysqli_fetch_array($res);


            if (!empty($row['img_path'])) {

                $imfo = '/images/controllers' . $row['path'] . '/' . $row['img_path'] . '.png';
                $imfobig = '/images/controllers' . $row['path'] . '/lg/' . $row['img_path'] . '.png';

                if ($GLOBALS["net"] == 0) {
                    if (!file_exists($GLOBALS["path_to_real_files"] . $imfo)) {
                        $imfo = '';
                    }
                } else {
                    $re = cu($GLOBALS["path_to_real_files"] . $imfo);
                    if ($re[0] <= 0) {
                        $imfo = '';
                    };
                };
                if ($imfo != '') {
                    $o[] = $imfo;
                    $alts[] = $row[alt];
                    $osm[] = '/images/controllers' . $row['path'] . '/sm/' . $row['img_path'] . '.png';
                };
                if ($GLOBALS["net"] == 0) {
                    if (!file_exists($GLOBALS["path_to_real_files"] . $imfobig)) {
                        $imfobig = '';
                    } else {
                        $olg[] = $imfobig;
                    };
                } else {
                    $re = cu($GLOBALS["path_to_real_files"] . $imfobig);
                    if ($re[0] <= 0) {
                        $imfobig = '';
                    } else {
                        $olg[] = $imfobig;
                    };
                };
                if ($imfo != '') {

                };
            } else {

                $imfo = '/images/controllers' . $row['path'];

                if ($GLOBALS["net"] == 0) {

                    $files = scandir($GLOBALS["path_to_real_files"] . $imfo . '/sm');
                } else {
                    $files = ftp_rus_connect($imfo . '/sm');
                };

                $miniatures = sizeof($files);

                for ($ii = 2; $ii < $miniatures; $ii++) {
                    $imfo = '/images/controllers' . $row['path'] . '/' . $files[$ii];
                    $imfobig = '/images/controllers' . $row['path'] . '/lg/' . $files[$ii];

//if ($GLOBALS["net"] == 0) {if (!file_exists($GLOBALS["path_to_real_files"].$imfo)){$imfo = '';} } else {$re = cu($GLOBALS["path_to_real_files"].$imfo);if ($re[0] <= 0) {$imfo = '';};};

                    if ($imfo != '') {
                        $o[] = $imfo;
                        $alts[] = $row[alt];
                        $osm[] = '/images/controllers' . $row['path'] . '/sm/' . $files[$ii];
                    };
                    if ($GLOBALS["net"] == 0) {
                        if (!file_exists($GLOBALS["path_to_real_files"] . $imfobig)) {
                            $imfobig = '';
                            $olg[] = '';
                        } else {
                            $olg[] = $imfobig;
                        };
                    } else {
                        $re = cu($GLOBALS["path_to_real_files"] . $imfobig);
                        if ($re[0] <= 0) {
                            $imfobig = '';
                            $olg[] = '';
                        } else {
                            $olg[] = $imfobig;
                        };
                    };
                    if ($imfo != '') {

                    };
                }

//var_dump($files);
            }
//echo $i; echo $r;
        }
        $miniatures = sizeof($files) - 2;
        if ($miniatures > $mins_max)
            $miniatures = $mins_max;
        $min_table = "<table class=\"minitable\" width=$table_width bfcolor=red><tr>";
        $mc = 0;

        $jj = count($o);

        for ($i = 0; $i < $jj; $i++) {


            if ($olg[$i] != '') {
                if ($i > 0) {
                    $lbox = "<a class=\"lightbox\" href=\"$olg[$i]\" rel=\"lightbox[1]\"></a>";
                    $lclass = "class=\"toclick\"";
                    $llink = $olg[$i];
                } else {
                    $lbox = "<a class=\"lightbox\" href=\"$olg[$i]\" rel=\"box[1]\"></a>";
                    $lclass = "class=\"toclick\"";
                    $llink = $olg[$i];
                };
            } else {
                $lbox = '';
                $lclass = '';
                $llink = '"0"';
            };

            $min_table .= "<td $lclass  onclick='dich(\"$o[$i]\",\"$llink\");'><img src=\"$osm[$i]\" width=50 alt='$alts[$i]'>$lbox</td>
  ";
            $mc++;
            if ($mc == $miniatures_in_raw) {
                $mc = 0;
                $min_table .= "</tr><tr>";
            }
        }
        while ($mc < $miniatures_in_raw) {
            $mc++;
            $min_table .= "<td></td>";
        }

        $min_table .= "</tr></table>";
    };
    if ($co == 1) {
        return $o[0];
    } else {
        return $min_table;
    };
}

function img($num, $co)
{
    global $mysqli_db;
    if (is_numeric($co)) {
        $limit = 'LIMIT ' . $co;
    } else {
        $limit = '';
    };
    $sql = "SELECT * FROM `gallery_controllers` WHERE `model` = '$num' ORDER BY `por`  $limit";

    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_num_rows($res);

    if ($r > 0) {
        $o = array();
        for ($i = 0; $i < $r; $i++) {
            $row = mysqli_fetch_array($res);

            if (!empty($row['img_path'])) {
                $imfo = '/images/controllers' . $row['path'] . '/' . $row['img_path'] . '.png';

                if ($GLOBALS["net"] == 0) {

                    if (!file_exists($GLOBALS["path_to_real_files"] . $imfo)) {
                        $imfo = '';
                    }
                } else {
                    $re = cu($GLOBALS["path_to_real_files"] . $imfo);
                    if ($re[0] <= 0) {
                        $imfo = '';
                    };
                };
                if ($imfo != '') {
                    $o[] = $imfo;
                };
            } else {
                $imfo = '/images/controllers' . $row['path'];

                if ($GLOBALS["net"] == 0) {

                    $files = scandir($GLOBALS["path_to_real_files"] . $imfo . '/sm');
                } else {
                    $files = ftp_rus_connect($imfo . '/sm');
                };

                $miniatures = sizeof($files);

                for ($i = 2; $i <= $miniatures; $i++) {
                    if (isset($files[$i])) {
                        $imfo = '/images/controllers' . $row['path'] . '/' . $files[$i];
                        if ($GLOBALS["net"] == 0) {

                            if (!file_exists($GLOBALS["path_to_real_files"] . $imfo)) {
                                $imfo = '';
                            }
                        } else {
                            $re = cu($GLOBALS["path_to_real_files"] . $imfo);
                            if ($re[0] <= 0) {
                                $imfo = '';
                            };
                        };
                        if ($imfo != '') {
                            $o[] = $imfo;
                        };
                    }
                }

//var_dump($files);
            }
        }
    };
    if ($co == 1) {
        return $o[0];
    } else {
        return $o;
    };
}

function imgbig($num, $co)
{
    global $mysqli_db;
    if (is_numeric($co)) {
        $limit = 'LIMIT ' . $co;
    } else {
        $limit = '';
    };
    $sql = "SELECT * FROM `gallery_controllers` WHERE `model` = '$num' ORDER BY `por` $limit";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_num_rows($res);

    if ($r > 0) {
        $o = array();
        for ($i = 0; $i < $r; $i++) {
            $row = mysqli_fetch_array($res);
            if (!empty($row['img_path'])) {
                $imfo = '/images/controllers' . $row['path'] . '/lg/' . $row['img_path'] . '.png';

                if ($GLOBALS["net"] == 0) {

                    if (!file_exists($GLOBALS["path_to_real_files"] . $imfo)) {
                        $imfo = '';
                    }
                } else {
                    $re = cu($GLOBALS["path_to_real_files"] . $imfo);
                    if ($re[0] <= 0) {
                        $imfo = '';
                    };
                };
                if ($imfo != '') {
                    $o[] = $imfo;
                };
            } else {
                $imfo = '/images/controllers' . $row['path'];
                if ($GLOBALS["net"] == 0) {

                    $files = scandir($GLOBALS["path_to_real_files"] . $imfo . '/sm');
                } else {
                    $files = ftp_rus_connect($imfo . '/sm');
                };

                $miniatures = sizeof($files);

                for ($i = 2; $i <= $miniatures; $i++) {
                    $imfo = '/images/controllers' . $row['path'] . '/lg/' . $files[$i];
                    if ($GLOBALS["net"] == 0) {

                        if (!file_exists($GLOBALS["path_to_real_files"] . $imfo)) {
                            $imfo = '';
                        }
                    } else {
                        $re = cu($GLOBALS["path_to_real_files"] . $imfo);
                        if ($re[0] <= 0) {
                            $imfo = '';
                        };
                    };
                    if ($imfo != '') {
                        $o[] = $imfo;
                    };
                }

//var_dump($files);
            }
        }
    };
    if ($co == 1) {
        return $o[0];
    } else {
        return $o;
    };
}

function softwares($software, $model, $head)
{
    $soft = "";
//echo $software;

    global $path_to_real_files;


    if (preg_match('/Edit/i', $software)) {
        $r->soft = 'YottaEditor';
        $ver = '';
        $ver_f = '/soft/Yottacontrol/YottaEdit.txt';
        $so = '/soft/Yottacontrol/YottaEdit.rar';


        if ($GLOBALS["net"] == 0) {

            if (file_exists($path_to_real_files . $ver_f)) {
                $ver = file_get_contents($path_to_real_files . $ver_f);
            };
            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        } else {

            $ver = cu_content($path_to_real_files . $ver_f);
            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        };


        if ($fsso > 1000) {
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
        } else {
            $sso = round($fsso, 0) . '&nbsp;Кб';
        };


        $soft .= "
 <tr><td><div class=down_item style='  font-weight: normal;'> <strong>$r->soft $ver</strong> предназначен для работы сo всеми контроллерами Yottacontrol.<br /><br />
Поддерживаемые ОС: Windows 98 / ME / 2000 / XP / Vista / 7 / 8. </div></td>
   <td><div class=dt_item>" . $tso . "<br>(eng)<br />" . $sso . "</div></td>
   <td><div class=down_item><a href='" . $so . "'><img src=/images/zip.png></a></div></td></tr>
 ";

//-----------	 Руководство пользователя YottaEditor ---------------

        $r->soft = 'Руководство пользователя YottaEditor';
        $ver = '';

        $so = '/manuals/YottaEditor.chm.zip';


        if ($GLOBALS["net"] == 0) {


            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        } else {


            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        };


        if ($fsso > 1000) {
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
        } else {
            $sso = round($fsso, 0) . '&nbsp;Кб';
        };


        $soft .= "
 <tr><td><div class=down_item style='  font-weight: normal;'> <strong>$r->soft</strong></div></td>
   <td><div class=dt_item>" . $tso . "<br>(eng)<br />" . $sso . "</div></td>
   <td><div class=down_item><a href='" . $so . "'><img src=/images/manual.jpg></a></div></td></tr>
 ";


//-----------	 Руководство пользователя YottaEditor в PDF ---------------

        $r->soft = 'Руководство пользователя Yotta Edit в PDF';
        $ver = '';

        $so = '/manuals/YottaEdit.pdf';


        if ($GLOBALS["net"] == 0) {


            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        } else {


            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        };


        if ($fsso > 1000) {
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
        } else {
            $sso = round($fsso, 0) . '&nbsp;Кб';
        };


        $soft .= "
 <tr><td><div class=down_item style='  font-weight: normal;'> <strong>$r->soft</strong></div></td>
   <td><div class=dt_item>" . $tso . "<br>(eng)<br />" . $sso . "</div></td>
   <td><div class=down_item><a href='" . $so . "'><img src=/images/manual.jpg></a></div></td></tr>
 ";
    };

//-------------------- YottaUtility ---------------------------

    if (preg_match('/Utility/i', $software)) {

        $r->soft = 'YottaUtility';
        $ver = '';
        $ver_f = '/soft/Yottacontrol/YottaUtility.txt';
        $so = '/soft/Yottacontrol/YottaUtility.rar';


        if ($GLOBALS["net"] == 0) {

            if (file_exists($path_to_real_files . $ver_f)) {
                $ver = file_get_contents($path_to_real_files . $ver_f);
            };
            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        } else {

            $ver = cu_content($path_to_real_files . $ver_f);
            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        };


        if ($fsso > 1000) {
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
        } else {
            $sso = round($fsso, 0) . '&nbsp;Кб';
        };


        $soft .= "
 <tr><td><div class=down_item style='  font-weight: normal;'> <strong>$r->soft $ver</strong> предназначен для работы сo всем оборудованием Yottacontrol.<br /><br />
Поддерживаемые ОС: Windows 98 / ME / 2000 / XP / Vista / 7 / 8. </div></td>
   <td><div class=dt_item>" . $tso . "<br>(eng)<br />" . $sso . "</div></td>
   <td><div class=down_item><a href='" . $so . "'><img src=/images/zip.png></a></div></td></tr>
 ";
    };


//-------------------- Yotta Drivers USB A-5x ---------------------------

    if (preg_match('/A-5/', $model)) {


        $r->soft = 'USB-драйвера';
        $ver = '';
        $ver_f = '/soft/Yottacontrol/A5x_USB_driver.txt';
        $so = '/soft/Yottacontrol/A5x_USB_driver.rar';


        if ($GLOBALS["net"] == 0) {

            if (file_exists($path_to_real_files . $ver_f)) {
                $ver = file_get_contents($path_to_real_files . $ver_f);
            };
            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        } else {

            $ver = cu_content($path_to_real_files . $ver_f);
            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        };


        if ($fsso > 1000) {
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
        } else {
            $sso = round($fsso, 0) . '&nbsp;Кб';
        };


        $soft .= "
 <tr><td><div class=down_item style='  font-weight: normal;'> <strong>$r->soft $ver</strong> для Yottacontrol $model.<br /><br />
Поддерживаемые ОС: Windows 98 / ME / 2000 / XP / Vista / 7 / 8. </div></td>
   <td><div class=dt_item>" . $tso . "<br>(eng)<br />" . $sso . "</div></td>
   <td><div class=down_item><a href='" . $so . "'><img src=/images/zip.png></a></div></td></tr>
 ";
    };


    if ((!empty($soft)) AND ($head == '1')) {
        $soft = '<table cellpadding="0" cellspacing="0" border="1" bordercolor="#cccccc" width="900">
<tr><td><div class="down_h">  Наименование </div></td><td width="100"><div class="down_h">  Дата, размер</div></td><td><div class="down_h"> Ссылка</div></td></tr>' . $soft . '</table>';
    };

    return $soft;
}

function add_style()
{
    return '<style>  .bor td {  padding: 2px 5px;} a h2.series_name {text-decoration:none;cursor:pointer;} td a {text-decoration:none;}  .productsblock .pan_sm_cont {  width: 485px;} .productsblock tr td:nth-child(2n) .pan_sm_cont { float: right;}
.pan_price .val_name {font-size:12px;float: right;margin-right: 5px;margin-top: 7px;} .pan_price .prpr {font-size:12px;float: right;margin-right: 5px;margin-top: 7px;}
.productsblock .pan_price.price_name3 {float: right;  margin-top: 7px;}
.head_block {background: rgb(205, 186, 186);
  border: none;
  min-height: 20px;
  display: block;
  width: 1040px;
  margin: 0px auto 20px auto;
  padding: 1px 0px;}
 .head_block > h2 {
 color: white;
  text-transform: uppercase;
  text-align: center;
  margin: 5px 0px 5px 0px;}
  .conparams > * {padding: 10px;}
  .congroup a {  float: left;}
 .countc {   color: #666666;}
  .countc > span {  padding-left: 10px;}
  .submenu_controllers {
  list-style:none;
  display: -moz-groupbox;
  margin-left: 5px;
  }
  .links {margin-top:30px;}
    .green {  color: rgb(71, 191, 52);  float: initial !important;}
  .submenu_controller {
  padding: 6px 10px 6px 20px;
  outline: 1px solid lightgray;
  background: rgb(250, 246, 246);
  transition: background-color .15s ease-out;
  width: 1010px;
  display: table-cell;

  min-height:16px;
  }
  .submenu_controller span.name {  width: 125px;
  padding-left: 10px;}
  ul.submenu_controller:hover {background: rgb(228, 221, 221);}
  .congroup .countc  .submenu_controller span.name {width:105px;}
  .zakazbut.init {display: initial;text-shadow:none;box-shadow: none;padding: 0px;float: right;border: none;background: none;}

  .hl_text {
  font-size: 13px;
  padding-bottom: 10px;
}

</style>';
}

?>