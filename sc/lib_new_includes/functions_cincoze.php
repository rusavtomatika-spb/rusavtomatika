<?php

function show_cincoze_variants($model) {

//$sql="SELECT * FROM `products_all` WHERE  `modification`=1 AND `model` LIKE '$model%' ";
    $sql = "SELECT * FROM `products_all` WHERE  `modification`=1 AND `parent`='$model' AND `show_in_cat`='1' ";
    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) == 0)
        return "";
    $out = "<table class=mytab2>
<tr class=hed><td >Модель</td><td width=270>Спецификация</td><td width=160>Наличие</td><td width=80>Цена с НДС</td><td width=280>Действия</td></tr>";

    while ($r = mysql_fetch_object($res)) {
        if ((preg_match("/eWON/i", $r->brand)) OR ( $r->brand == '2N')) {
            $ue = 'EUR';
        } else {
            $ue = 'USD';
        };

        if (($r->retail_price != '0') AND ( $r->retail_price != '')) {
            $priceb = "<td><span class=prpr title='Нажмите для пересчета в РУБ' style='font-size:11px;'>$r->retail_price</span><span class=val_name title='Нажмите для пересчета в РУБ' style='font-size:11px;'> $ue </span></td>";
        } else {
            $priceb = "
<td>по&nbsp;запросу</td>
";
        };


        $spec = $r->spec_modif;
        $out .= "<tr><td width=170 class=modif_name>$r->model</td><td>$spec</td><td>" . show_stock($r, 3) . "</td>
" . $priceb . "

<td style='    padding: 9px 6px 0px 14px;'><span class=zakazbut2 idm='$r->model' onclick='v_korzinu(this)'>В корзину</span>
 &nbsp <span class=zakazbut2 idm='$r->model' onclick='show_compare(this)'>В сравнение</span>
 &nbsp <span class=zakazbut2 idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'>Получить скидку</span>
 </td>
</tr>";
    }
    $out .= "</table>";
    return $out;
}

function show_cincoze($num) {
    $im = "/images";
    $altstr = "операторские панели, сенсорные панели, HMI, Cincoze, интерфейс, пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО";

    global $root_php;
    database_connect();


    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysql_query($sql) or die(mysql_error());

    $r = mysql_fetch_object($res);


    $inter = $r->serials . "xCOM";
    if ($r->ethernet)
        $inter .= ", $r->ethernets" . "xEthernet";
    if ((!empty($r->sdcard)) AND ( !preg_match('/нет/i', $r->sdcard))) {
        $inter .= ", SD карта";
    } elseif ($r->type == 'panel_pc') {
        $inter .= ", CFast";
    };
    if ($r->usb_host)
        $inter .= ", $r->usb_hosts" . "xUSB ";
    if ($r->pci_slot == 'есть')
        $inter .= ", PCI";
    else if ($r->pci_slot) {
        $inter .= ", " . $r->pci_slot;
    };
    if (preg_match('/E$/i', $r->model))
        $inter .= ", 1x PCI или 1x PCIex4";

    $fo = "сincoze";

    if (preg_match('/Cincoze/i', $r->brand))
        $fo = "cincoze";

    $imm = "$im/$fo/$r->s_name/$r->s_name" . "_1.png";
    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . $imm)) {
            $imm = $imm;
        } else {
            $imm = '';
        };
    } else {

        $re = cu($root_php . $imm);
        if ($re[0] > 0) {
            $imm = $imm;
        } else {
            $imm = '';
        };
    };


    if (empty($imm) OR ( ($r->brand = "Cincoze") AND ( !empty($r->pic_big)))) {
        $imm = get_big_pic($r->s_name);
    };
    if (empty($imm)) {

        $ipath = '';
    };

    $alt = $r->model;

    $pathpc = $r->type;
    if (($r->type == 'panel_pc')) {
        $typepc = 'Панельный компьютер в металлическом корпусе';
//$typepc = 'Компьютер из нержавеющей стали';
        $pathpc = '' . $fo;
    } else if (($r->type == 'box-pc')) {
        $typepc = 'Встраиваемый компьютер в металлическом корпусе';
//$typepc = 'Компьютер из нержавеющей стали';
        $pathpc = '' . $fo;
    } else {
        $r->type == 'monitor';
        $typepc = 'Промышленный монитор';
//$pathpc = 'monitors';
        $pathpc = '' . $fo;
    };
//$pathpc = $fo;



    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/sc/new.php")) {
        include($_SERVER['DOCUMENT_ROOT'] . "/sc/new.php");
    } else {
        $class = '';
    };
    if ($r->diagonal != 0) {
        $di = "$r->diagonal\" &nbsp; ";
    } else {
        $di = "";
    };
    $out = "
 <div class=pan_sm_cont>
 <table width=100%>
 <tr><td class=pan_price colspan=2 >
 <a href=/$pathpc/$r->s_name.php style=\"text-decoration: none;\"><h2 class=\"pan_price $class\" style=\"cursor:pointer;\">$di" . "$typepc <span style='white-space: nowrap;'>$r->model</span></h2></a>
 <div class=hc11> &nbsp;</div> </td><td></td></tr>

 <tr>
 <td width=160 class=price11 align=left height=180 valign=middle> <a  href=/$pathpc/$r->s_name.php>
 <div class='cincoze_preview_picture'><img src='$imm' width=160 border=0 alt='$alt'></div></a>";

    $onst = show_stock($r, 2);


    $bw = "90px";
    $tdw = "120px";

    $buts = "<tr height=50><td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
 </tr><tr>";


    $action_price = action_price($r->model);

    if (!empty($action_price)) {

        $price = "<span class='prpr old'>$r->retail_price</span><div class='prpr action' style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$action_price</div>";
        $valuta = "<div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div>";
    } else {
        $price = "<div class=prpr style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</div>";
        $valuta = "<div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div>";
    };
    if ($r->retail_price == '0') {
        $price = "<div style='margin-top:8px;display: initial;
padding: 0px;float: right;
border: none;font-size:12px;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >по&nbsp;запросу</div>";
        $valuta = "";
    };

    $out .= " </td><td  class=pan_price valign=top align=left>

  <table width=100%>
 <tr><td width=140>&nbsp </td><td width=40><div class=pan_price>Цена</div></td><td width=50> $price</td>
 <td>$valuta</td></tr>

 <tr><td colspan=3 height=20> &nbsp </td></tr>
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>

 <table>
     $buts
     <td width=$tdw align=rigth>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </td>
  </tr></table>
 </td>
 </tr></table>";



    //$disp = "$r->diagonal, $r->resolution, $r->touch";

    if ($r->type == 'monitor') {



        $CPU = "<tr><td class=par_name11 colspan=2>Входы</td>
 <td class=par_name11 colspan=2><span class=par_val11>1x USB, 1x COM, 1x VGA, 1x DVI-D, 1x Audio</span></td>
 </tr>";
        $interf = " <tr bgcolor=#f1f1f1><td class=par_name11 colspan=2>Выход сенсора</td><td class=par_val11 colspan=2>USB</td></tr>";
    } else {

        if ($r->type == 'box_pc') {
            $inter = (($r->model == "DA-1000") ? "2 гигабитных LAN, 1xDVI-I, 2xCOM, 1xUSB 3.0, 3xUSB 2.0, 1 универсальный I/O разъем>" : "")
                    . (($r->model == "DC-1100") ? "2 гигабитных LAN, 1xDVI, 1xDisplayPort, 4xCOM, 1xUSB 3.0, 3xUSB 2.0, 4xDI, 4xDO, 1xSATA, 1xCFast" : "")
                    . (($r->model == "DS-1000") ? "2 гигабитных LAN, 1xDVI, 2xDisplayPort, 6xCOM, 4xUSB 3.0, 4xUSB 2.0, 4xDI, 4xDO, 2xSATA, 2xmSATA, 1xCFast" : "")
                    . (($r->model == "DS-1002") ? "2 гигабитных LAN, 1xDVI, 2xDisplayPort, 6xCOM, 4xUSB 3.0, 4xUSB 2.0, 1 универсальных I/O разъема, 2xSATA, 2xmSATA, 1xCFast" : "");
        };

        $CPU = "<tr><td colspan=3 class=par_name11 style='  width: 60%;' >CPU&nbsp;&nbsp;&nbsp;$r->cpu_type</td><td colspan=1 class=par_name11 >
 RAM&nbsp;&nbsp;&nbsp;" . ($r->ram / 1000) . " Гб</span></td></tr>";
        $interf = " <tr bgcolor=#f1f1f1><td class=par_name11 colspan=1 style='padding-right: 10px;    width: 20%;' >Интерфейсы </td><td colspan=3 class=par_val11 >$inter</td></tr>";
    };

    $diagonal = "<td class=par_name11 width= >Диагональ </td><td class=par_val11 width= >$r->diagonal\" </td><td class=par_name11 width=>Разрешение </td><td class=par_val11>$r->resolution </td>";

    $out .= "<div class=bor><table width=100% cellpadding=0 cellspacing=0 border=0>";

    if ($r->diagonal != 0) {
        $out .= "<tr bgcolor=#f1f1f1>$diagonal</tr>";
    };
    $out .= "
 $CPU

 $interf

 </table></div>
 </div>";

    return $out;
}

