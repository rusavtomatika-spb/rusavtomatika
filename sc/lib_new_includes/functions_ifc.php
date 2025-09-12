<?php
function ifc_modif_decode($r) {

    $touch = $ef = $yo = $cpu = $text = $ram = $ports = $vo = $spe = $hdd = $gb = $dido = '';

    $a = explode("-", $r->model);
    if (isset($a[1])) $mod = $a[1];
    else $mod = '';



    if ($r->parent == 'IFC-BOX4000') {
        $cpu = $r->cpu_type . ' ';
    } else {
        $cpu = '';
    };
    if ($r->speakers != "")
        $spe = "динамики ";
    else
        $spe = "";
    if (($r->voltage_min != '') AND ( $r->voltage_max != '0')) {
        if ($r->voltage_min == $r->voltage_max)
            $vo = "$r->voltage_min" . "&nbsp;В ";
        else
            $vo = "$r->voltage_min-$r->voltage_max" . "&nbsp;В ";
    } else {
        $vo = '';
    };
    if (($r->hdd_size_gb != '') AND ( $r->hdd_size_gb != '0')) {
        $gb = '' . $r->hdd_size_gb . ' Гб ';
    } else {
        $gb = '';
    };
    if (($r->hdd_type != '') AND ( $r->hdd_type != '0')) {
        $hdd = '' . $r->hdd_type . ' ';
    } else {
        $hdd = '';
    };
    if ($r->model == 'COSY141') {
        $ports = 'SUBD9 ';
    } elseif ($r->model == 'COSY141 MPI') {
        $ports = 'MPI/PROFIBUS ';
    } else {
        $ports = '';
    };
    if ($r->model == 'EC61330') {
        $ports = '4xLAN/WAN, USB, ';
    } elseif ($r->model == 'EC6133C') {
        $ports = '4xLAN/WAN, USB, Wi-Fi, ';
    } elseif ($r->model == 'EC6133D') {
        $ports = '4xLAN/WAN, USB, 3G, ';
    };
    if ($r->parent == 'FLEXY') {
        $text = $r->spec_modif . '<br />';
        if ($r->model != 'FLEXY 201') {
            $vo = '';
        };
    } else {
        $text = '';
    };
    if (($r->ram != '') AND ( $r->ram != '0')) {
        $ram = "RAM " . ($r->ram / 1000) . " Гб ";
    } else {
        $ram = '';
    };
    $yo = '';
    if ($r->brand == 'Yottacontrol') {
        $yotta = array();
        if (preg_match('/D/i', $r->model)) {
            $yotta[] = 'Дисплей 1.5&#8243;';
        };
        if (preg_match('/M/i', $r->model)) {
            $yotta[] = 'Micro-SD';
        };
        if (preg_match('/89/i', $r->model)) {
            $yotta[] = '4DI/4AI/4DO';
        };
        if (preg_match('/88/i', $r->model)) {
            $yotta[] = '8DI/4DO';
        };
        if (preg_match('/T/i', $r->model)) {
            $yotta[] = 'Транзисторный выход';
        } else {
            $yotta[] = 'Релейный выход';
        };
        if (!empty($r->usb_host)) {
            $yotta[] = $r->usb_host;
        };
        if (!empty($r->serial_full)) {
            $yotta[] = $r->serial_full;
        };
        $yo = implode(', ', $yotta) . ', ';
    };

    if ($r->parent == 'eFive') {
        $efive = array();
        if ($r->model == 'eFive 25') {
            $efi = '50 одновременных подключений,<br />';
        } else if ($r->model == 'eFive 100') {
            $efi = '200 одновременных подключений,<br />';
        };
        if (!empty($r->ethernet)) {
            $efive[] = $r->ethernet;
        };
        if (!empty($r->serial_full)) {
            $efive[] = $r->serial_full;
        };
        if (!empty($r->usb_host)) {
            $efive[] = $r->usb_host;
        };
        $ef = $efi . implode(', ', $efive) . '';
        $hdd = '';
    };

    if ($r->brand == 'Cincoze') {

        if (preg_match('/C\//i', $r->model)) {
            $touch = 'Емкостной сенсор, ';
        } elseif (preg_match('/R\//i', $r->model)) {
            $touch = 'Резистивный сенсор, ';
        };
//$dido = '4xDI/4xDO';
    };

    $out = $touch . $ef . $yo . $cpu . $text . $ram . $ports . $vo . $spe . $hdd . $gb . $dido;

    if (preg_match('/ACC/i', $r->model)) {
        $out .= ', встроенная батарея';
    }

    if ((empty($out)) AND ( !empty($r->spec_modif))) {
        $out = $r->spec_modif;
    };

    return $out;
}
function show_ifc_wide($num) {
    $out = "<table><tr><tr>";
    $out .= show_ifc($num);

    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysql_query($sql) or die(mysql_error());

    $r = mysql_fetch_object($res);

    $out .= "</td><td>";

    $out .= show_pc_variants($num);

    $out .= "</td></tr></table>";

    return $out;
}

function show_ifc($num) {
    global $arrProductTypes;

    $im = "/images";
    $altstr = "операторские панели, сенсорные панели, HMI, IFC, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО";

    global $root_php;
    //database_connect();
    global $mysqli_db;


    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysqli_query( $mysqli_db,$sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_fetch_object($res);

    $imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/190/" .  $r->model . "_1.webp";
    $inter = $r->serials . "xCOM";
    if ($r->ethernet)
        $inter .= ", $r->ethernets" . "xEthernet";
    if ($r->sdcard)
        $inter .= ", SD карта";
    if ($r->usb_host)
        $inter .= ", $r->usb_hosts" . "xUSB ";
    if ($r->pci_slot == 'есть')
        $inter .= ", PCI";
    else if ($r->pci_slot) {
        $inter .= ", " . $r->pci_slot;
    };


    $fo = "ifc";

    if (preg_match('/Aplex/i', $r->brand))
        $fo = "aplex";
    if ($r->series == "RF")
        $fo = "ifc";
    if ($r->series == "i3")
        $fo = "ifc";
    if ($r->series == "ITM")
        $fo = "ifc";
    if ($r->type == "box-pc")
        $fo = "promyshlennye-kompyutery-box-pc";
//echo strpos($r->model, "ARCH");
//echo "$fo $r->model";

    $imm = "$im/$fo/$r->model/$r->model" . "_1.png";

/*    if ($GLOBALS["net"] == 0) {
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
    };*/

    if (empty($imm) OR ( ($r->brand == "Aplex") AND ( !empty($r->pic_big)))) {
        $imm = get_big_pic($r->model);
    };
    if (empty($imm)) {


        $query_images = "SELECT * FROM `gallery` WHERE `model`='{$r->model}' ORDER BY `id` LIMIT 1;";

        $query_images_result = mysqli_query($mysqli_db,$query_images) or die("ошибка запроса022" . $query_images);
        $iimg = mysqli_num_rows($query_images_result);

        $all_images = '';

        if ($iimg > 0) {

//$all_image .= '<table width="350" bfcolor="red"><tbody><tr>';
            for ($ij = 1; $ij <= $iimg; $ij++) {
                $img_row = mysqli_fetch_assoc($mysqli_db,$query_images_result);


//echo $_SERVER['DOCUMENT_ROOT'];
//echo $r->type;
                if (($r->type == 'monitor')) {
                    $path = 'monitors/img/';
                    if ($GLOBALS["net"] == 0) {
                        if (file_exists($root_php . $path . $img_row[s_img_path])) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    } else {
                        $re = cu($root_php . $path . $img_row[s_img_path]);
                        if ($re[0] > 0) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    };
                } elseif (($r->type == 'panel_pc')) {
                    $path = 'panelnie-computery/ifc/img/panels/';
                    if ($GLOBALS["net"] == 0) {
                        if (file_exists($root_php . $path . $img_row[s_img_path])) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    } else {
                        $re = cu($root_php . $path . $img_row[s_img_path]);
                        if ($re[0] > 0) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    };
                } elseif ($r->type == 'hmi') {
                    $path = 'weintek/img/';
                    if ($GLOBALS["net"] == 0) {
                        if (file_exists($root_php . $path . $img_row[s_img_path])) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    } else {
                        $re = cu($root_php . $path . $img_row[s_img_path]);
                        if ($re[0] > 0) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    };
                } elseif ($r->type == 'box-pc') {
                    $path = 'images/box-pc/' . $r->model . '/';
                    if ($GLOBALS["net"] == 0) {
                        if (file_exists($root_php . $path . $img_row[s_img_path])) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    } else {
                        $re = cu($root_php . $path . $img_row[s_img_path]);
                        if ($re[0] > 0) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    };
                };

                if ($ij == 1) {

                    $ipath = $path . $img_row[img_path];
                    $i_b_path = $img_row[img_path];
//echo $ipath.'path';
                };
                if ($img_row[alt] != '') {
                    $img_alt = $img_row[alt];
                } else {
                    $img_alt = $type . ' ' . $r->model . ' Изображение №' . $ij;
                };



                $all_images .= '<td onclick="dich(&quot;' . $path . $img_row[img_path] . '&quot;,&quot;/' . $path . $img_row[img_path] . '&quot;);">
<img src="' . $path . $img_row[img_path] . '" width="50" alt="' . $img_alt . '"></td>';
            };
//$all_image .'</tr></tbody></table>';
        } else {
            $ipath = '';
        };

        if (empty($min_table)) {
            $min_table = $all_images;
        };
        $imm = $ipath;
    };

    if (isset($arrProductTypes[$r->type])) {$alt = $arrProductTypes[$r->type] . " " . $r->model;}
    else {$alt = $r->model;}

//$imm="/images/panel/$r->model/$r->model"."_2.png";
//pan_name11
//<tr height=5><td colspan=3> </td></tr>
    $pathpc = $r->type;
    if (($r->type != 'box-pc') AND ( $r->type != 'monitor')) {
        $typepc = 'Панельный компьютер';
        if ($r->series == 'APC') {
            $typepc = 'Компьютер из нержавеющей стали';
        };
        $pathpc = 'panelnie-computery/' . $fo;
    } else {
        if ($r->type == 'box-pc') {
            $typepc = 'Встраиваемый компьютер';
            $pathpc = 'promyshlennye-kompyutery-box-pc';
        } elseif ($r->type == 'monitor') {
            $typepc = 'Промышленный монитор';
        };
//$pathpc = $fo;

        if (!empty($r->pic_big)) {
            if ($r->type == 'monitor') {
                $t = 'monitors';
            } else {
                $t = $r->type;
            };
            if ($GLOBALS["net"] == 0) {
                if (file_exists($root_php . $t . '/img/' . $r->pic_big)) {
                    $imm = '/' . $t . '/img/' . $r->pic_big;
                } else {
                    $imm = '';
                };
            } else {
                $re = cu($root_php . $t . '/img/' . $r->pic_big);
                if ($re[0] > 0) {
                    $imm = '/' . $t . '/img/' . $r->pic_big;
                } else {
                    $imm = '';
                };
            };
        };


        if ($pathpc == 'monitor') {
            $pathpc = 'monitors';
        };
    };
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/sc/new.php")) {
        include($_SERVER['DOCUMENT_ROOT'] . "/sc/new.php");
    } else {
        $class = '';
    };

    if ($r->type == 'box-pc') {
        $di = '';
    } else {
        $di = "$r->diagonal\"";
    };

    /*  $imgRemoteDir="/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) ."/" . $r->model . "/";
  $new_path_picture = get_new_path_picture($imgRemoteDir);
    if(!empty($new_path_picture)){

  $imm = $imgRemoteDir . 'md/' . $r->model . "_1.png";
}*/

    $out = "
 <div class=pan_sm_cont>
 <table width=100%>
 <tr><td class=pan_price colspan=2 >
 <a href=/$pathpc/$r->model.php style=\"text-decoration: none;\"><h2 class=\"pan_price $class\" style=\"cursor:pointer;\">$di &nbsp;$typepc $r->model</h2></a>
 <div class=hc11> &nbsp;</div> </td><td></td></tr>

 <tr>
 <td width=50% class=price11 style='text-align:center' height=180 valign=middle> <a class='product_preview_picture__link' href='/$pathpc/$r->model.php'>
 <img class='product_preview_picture' src='$imgRemoteDir'  alt='$alt' loading='lazy'></a>";

    $onst = show_stock($r, 1);

//<tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
    //<tr><td colspan=3>  &nbsp</td></tr>

    $bw = "90px";
    $tdw = "120px";
    // right column
    //if($r->series=="ARCHMI")
    //{
    $buts = "<tr height=50>";
    if ($r->retail_price >0){
        $buts .= "<td width=$tdw align=right> <div class='addToCart btnStyleTypeWeintek' style='width:$bw;' idm='$r->model'><span>В корзину</span></div> </td>";
    }else{
        $buts .= "<td width=$tdw align=right> <div class='disabled btnStyleTypeWeintek' style='width:$bw;'><span>В корзину</span></div> </td>";
    }
    $buts .= "<td width=$tdw align=right> <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
 </tr><tr>";
    //}
    //else $buts="<tr>";

    $action_price = action_price($r->model);

    if (!empty($action_price)) {

        $price = "<span class='prpr old'>$r->retail_price</span><div class='prpr action' style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$action_price</div>";
        $valuta = "<div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div>";
    } elseif($r->retail_price_hide != '1') {
        $price = "<div class=prpr style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</div>";
        $valuta = "<div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div>";
    };
    if ($r->retail_price == '0' or $r->retail_price_hide == '1') {
        $price = "<div style='margin-top:8px;display: initial;
padding: 0px;float: right;
border: none;font-size:14px;color:#34ab5e;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >по&nbsp;запросу</div>";
        $valuta = "";
    };

    $out .= " </td><td  class=pan_price valign=top align=left>



 <table width=100%>
 <tr><td width=140>&nbsp </td><td width=40><div class='pan_price'>Цена</div></td><td width=50> $price</td>
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



    //$disp = "$r->diagonal, $r->resolution"; //, $r->sensor

    if ($r->type == 'monitor') {

        if ($r->diagonal >= 10) {
            $interfaces = 'VGA + DVI + AUDIO';
        } elseif ($r->diagonal >= 8) {
            $interfaces = 'VGA + AUDIO';
        } else {
            $interfaces = 'VGA';
        };



        $CPU = "<tr><td class=par_name11 colspan=2>Входы</td>
 <td class=par_name11 colspan=2><span class=par_val11>" . $interfaces . "</span></td>
 </tr>";
        $interf = " <tr bgcolor=#f1f1f1><td class=par_name11 colspan=2>Выход сенсора</td><td class=par_val11 colspan=2>USB</td></tr>";
    } else {

      if($r->ram != '0'){
        $CPU = "<tr><td class=par_name11 colspan=2>CPU&nbsp;&nbsp;&nbsp;$r->cpu_type</td><td class=par_name11 colspan=2>
 RAM&nbsp;&nbsp;&nbsp;" . ($r->ram / 1000) . " Гб</span></td></tr>";
      }else{
        $CPU = "<tr><td class=par_name11 colspan=2>CPU&nbsp;&nbsp;&nbsp;$r->cpu_type</td><td class=par_name11 colspan=2>
 RAM&nbsp;&nbsp;&nbsp; до " . ($r->ram_max /1000) . " Гб</span></td></tr>";
      }

        $interf = " <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3> &nbsp; $inter</td></tr>";
    };

    if ($r->type == 'box-pc') {

        if ((!empty($r->wifi))) {

            if (!preg_match('/wi.*fi/i', $r->wifi)) {
                $w = 'Wi-Fi: ';
            };
            $diagonal = "
	<td class=par_name11 width=70>Разрешение</td><td class=par_val11 width=90>$r->resolution</td>
<td class=par_name11 colspan=2>$w$r->wifi</td>"
            ;
        } else {
            $diagonal = "<td class=par_name11 width=70 >Разрешение</td><td class=par_val11 width=90 >$r->resolution</td><td class=par_name11 width=90>&nbsp;</td><td class=par_val11>&nbsp;</td>";
        };
    } else {
        $diagonal = "<td class=par_name11 width=70 >Диагональ</td><td class=par_val11 width=90 >&nbsp;&nbsp;&nbsp;$r->diagonal\"</td><td class=par_name11 width=90>Разрешение</td><td class=par_val11>$r->resolution</td>";
    };



 ob_start();
?>
<div class=bor>
    <? if(!empty($r->text_preview)):
    echo $r->text_preview;
    else:?>
        <table width=100% cellpadding=0 cellspacing=0 border=0>
            <tr bgcolor=#f1f1f1><?=$diagonal?></tr>

        <?=$CPU?>
        <?=$interf?>

        </table></div>
        <?endif;?>
    </div>
 <?$out .= ob_get_clean();
    return $out;
}
