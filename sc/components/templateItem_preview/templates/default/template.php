<?
if (!MAIN_FILE_EXECUTED) die();

global $arrProductTypes;
$im = "/images";
$inter = $item["serial"];
if ($item["ethernets"] > 1) {
    $eth = '2x';
} else {
    $eth = '';
};
if ($item["ethernet"])
    if (empty($inter)) {
        $inter .= $eth . "Ethernet";
    } else {
        $inter .= ", " . $eth . "Ethernet";
    };
if ($item["sdcard"] and $item["sdcard"] != "Нет")
    if (empty($inter)) {
        $inter .= "SD карта";
    } else {
        $inter .= ", SD карта";
    };
if ($item["usb_host"] and $item["usb_host"] != "Нет")
    if (empty($inter)) {
        $inter .= "USB host";
    } else {
        $inter .= ", USB host";
    };
if ($item["can_bus"] and $item["can_bus"] != "Нет")
    if (empty($inter)) {
        $inter .= "CAN";
    } else {
        $inter .= ", CAN";
    };
if ($item["wifi"])
    if (empty($inter)) {
        $inter .= "Wi-Fi";
    } else {
        $inter .= ", Wi-Fi";
    };
//$im/panel/$r->pic_small

if ($item["brand"] == "APLEX" and $item["type"] == "box-pc"){
        $fo =  '/vstraivaemye-kompyutery/aplex/ACS/' . $item["model"] . '/';
}
if ($item["brand"] == "APLEX" and $item["type"] == "panel_pc"){
    $fo =  '/panelnie-computery/aplex/' . $item["model"] . '.php';
}
if ($item["brand"] == "IFC" and $item["type"] == "panel_pc"){
    $fo =  '/panelnie-computery/ifc/' . $item["model"] . '.php';
}
if ($item["brand"] == "Weintek" and $item["type"] == "panel_pc"){
    $fo =  "/weintek/" . $item["model"] . ".php";
}
if ($item["brand"] == "Cincoze" and $item["type"] == "panel_pc"){
    $fo =  "/cincoze/" . $item["s_name"] . ".php";
}



if ($item["brand"] == "APLEX" and $item["type"] == "monitors"){
    $fo =  "/monitors/" . strtolower($item["brand"])  . "/" . $item["series"] . "/" . $item["model"] . '/';
}
if ($item["brand"] == "IFC" and $item["type"] == "monitor"){
    $fo =  "/monitors/" . $item["model"] . ".php";
}
if ($item["brand"] == "Cincoze" and $item["type"] == "monitor"){
    $fo =  "/cincoze/" . $item["s_name"] . ".php";
}






if ($item["brand"] == "IFC" and $item["type"] == "box-pc"){
        $fo =  "/promyshlennye-kompyutery-box-pc/" . $item["model"] . ".php";
}
if ($item["brand"] == "Cincoze" and $item["type"] == "box-pc"){
        $fo =  "/cincoze/" . $item["model"] . ".php";
}
if ($item["brand"] == "Weintek" and $item["type"] == "hmi"){
    $fo =  "/weintek/" . $item["model"] . ".php";
}
if ($item["brand"] == "Weintek" and $item["type"] == "Gateway"){
    $fo =  "/weintek/" . $item["model"] . ".php";
}
if ($item["brand"] == "Weintek" and $item["type"] == "cloud_hmi"){
    $fo =  "/weintek/" . $item["model"] . ".php";
}
if ($item["brand"] == "Weintek" and $item["type"] == "monitor"){
    $fo =  "/weintek/" . $item["model"] . ".php";
}
if ($item["brand"] == "Weintek" and $item["type"] == "monitor_cloud_hmi"){
    $fo =  "/weintek/" . $item["model"] . ".php";
}
if ($item["brand"] == "Weintek" and $item["type"] == "controllers"){
    $fo =  "/weintek/" . $item["model"] . ".php";
}

if ($item["brand"] == "Samkoon" and $item["type"] == "hmi"){
    $fo =  "/samkoon/" . $item["model"] . ".php";
}
if ($item["brand"] == "2N" and $item["type"] == "doors-hmi"){
    $fo =  "/HMI-android.php";
}


   if($item["diagonal"] > 0 and $item["diagonal_hide"] !== "1"){
    $type = $arrProductTypes[$item["type"]] . ' ' . $item["diagonal"] . '"' ;
   }else{
    $type = $arrProductTypes[$item["type"]];
   }


$alt = $item["model"] . ", " . get_kw("alt");
if ($item["brand"] == "Weintek") {
    /*if (file_exists($lts_file)) {

        include($lts_file);
    };*/
};

/* switch ($item["brand"] ) {

    case 'APLEX':
    $imm = '/images/aplex/vstraivaemye-kompyutery/'. $item["series"] . '/'. $item["model"] . '/' . tools\CProducts::get_imgSrc_small($item);
        break;

        case '2N':
      $imm = '/images/skud/'. $item["s_name"] . '/' . tools\CProducts::get_imgSrc_small($item);
            break;

    default:
    $imm = tools\CProducts::get_imgSrc_small($item);
        break;
} */

$imm = tools\CProducts::get_imgSrc_small($item);

/* echo $imm . "<br>!!";
echo tools\CProducts::get_imgSrc_small($item) . "<br>!!";
echo get_small_pic($item["model"]); */


if (file_exists("../sc/new.php")) {
    include("../sc/new.php");
} else {
    $class = '';
};
if (($item["diagonal"] == '') or ($item["diagonal"] == 0) or $item["diagonal_hide"] == "1") {
    $di = '';
} else {
    $di = $item["diagonal"] . '&Prime;';
};

ob_start();?>

<div class="pan_sm_cont">
<table width="100%">
<tr>
    <td class="pan_price" colspan="2">
        <a href='<?=$fo?>' style='text-decoration: none;'>
            <h3 class='pan_price <?=$class?>' style='cursor:pointer;'><?=$type?> <?=$item["model"]?> </h3>
        </a>
        <div class="hc11"> &nbsp;</div>
    </td>
    <td></td>
</tr>

<tr>
    <td width='50%' class="price11" align="left" height="180" valign="middle">


        <a  class='pan_sm_cont_a_img' style="display: block" href='<?=$fo?>'>
<?

//$imgRemoteDir="/images/" . mb_strtolower($item["brand"]) . "/" . mb_strtolower($item["type"]) ."/" . $item["model"] . "/";
//$new_path_picture = get_new_path_picture($imgRemoteDir);

$new_path_picture = get_path_190_picture($item["brand"],mb_strtolower($item["type"]),$item["model"]);
?>
            <img src="<?=$new_path_picture?>" alt="<?=$item["model"]?>" loading="lazy">
            </a>

            <?/*
            <div class='img_bg-img' style='background-image:url("<?=$new_path_picture?>")'></div>
            */?>
<? $out = ob_get_clean();


$onst = tools\CProducts::show_stock($item, 2);
$bw = "90px";
$tdw = "120px";

if (($item["retail_price"] != '0') AND ( $item["retail_price"] != '') AND $item["retail_price_hide"] == '0') {

    $action_price = action_price($item["model"]);

    if (!empty($action_price)) {

        $priceb = "<td width=50> <span class='prpr old'>" . $item["retail_price"] . "</span><div class='prpr action' style='font-size:12px;' title='Нажмите для пересчета в РУБ'>" . $action_price . "</div></td>
<td><div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div></td>";
    } else {
        $priceb = "<td width=50> <div class=prpr style='font-size:12px;' title='Нажмите для пересчета в РУБ'>" . $item["retail_price"] . "</div></td>
<td><div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div></td>";
    };
} else {
    $priceb = "
<td width=50 colspan='2' style='display: initial;
padding: 0px;
border: none;font-size:12px;
background: none;' class='zakazbut' idm='" . $item["model"] . "' onclick='show_backup_call(6, \"" . $item["model"] . "\")' ><div style='margin-top:4px;text-decoration:underline;color:#009b1e;'>по&nbsp;запросу</div></td>
";
};


$out .= " </td><td  style='padding-top: 7px;' class=pan_price valign=top align=left>";
if ($item["discontinued"] == '1') {
    $out .= '<table width=100%>
<tr><td width=140>&nbsp </td><td width=40><div class=pan_price></div></td></tr>
<tr><td colspan=3 height=20> &nbsp </td></tr>
<tr><td colspan=3><div class="onstock2 pan_price"> <img src="/images/red_sq.gif">&nbsp;&nbsp;&nbsp;снято с производства </div></td></tr>
</table>';
} else {
    $out .= "<table width=100% style='margin-top: 6px;'>
<tr><td colspan=3> $onst </td><td width=40><div class=pan_price>Цена</div></td>$priceb</tr>
</table>";
}
if ($item["discontinued"] == '1') {
    $out .= "<br><table>
<tr height=50><td width=$tdw align=right></td>
 <td width=$tdw style='text-align: right;'>  <div class='zakazbut2' style='width:$bw;' idm='" . $item["model"] . "' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
</tr><tr>
 <td width=$tdw style='text-align: right;'>   </td>
 <td width=$tdw style='text-align: right;'>   </td>
</tr></table>
</td>
</tr></table>";
} else {
    $out .= "<table  style='float: right;'><tr height=50>";
    if (($item["retail_price"] != '0') AND ( $item["retail_price"] != '') AND $item["retail_price_hide"] == '0') {
        $out .= "<td width=$tdw style='text-align: right;'>  <div class='addToCart btnStyleTypeWeintek' style='width:$bw;' idm='" . $item["model"] . "'><span>В корзину</span></div> </td>";
    }else{
        $out .= "<td width=$tdw style='text-align: right;'>  <div class=' disabled btnStyleTypeWeintek' style='width:$bw;cursor:initial;-ms-user-select: none;-moz-user-select: none;-khtml-user-select: none;-webkit-user-select: none;'><span>В корзину</span></div> </td>";
    }
    $out .= "<td width=$tdw style='text-align: right;'>  <div class='zakazbut2' style='width:$bw;' idm='" . $item["model"] . "' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
</tr><tr>
 <td width=$tdw style='text-align: right;'>  <div class='zakazbut2' style='width:$bw;' idm='" . $item["model"] . "' onclick='show_backup_call(2, \"" . $item["model"] . "\")'><span>Заказ в 1 клик</span></div> </td>
 <td width=$tdw style='text-align: right;'>  <div class='zakazbut2' style='width:$bw;' idm='" . $item["model"] . "' onclick='show_backup_call(1, \"" . $item["model"] . "\")'><span>Получить скидку</span></div> </td>
</tr></table>
</td>
</tr></table>";
}

if ($item["colors"] == "")
    $item["colors"] = "-";
if (!empty($item["text_preview"])) {
    ob_start();
    ?>

    <?= $item["text_preview"]; ?>

    <?
    $ob_result = ob_get_contents();
    ob_end_clean();
    $out .= $ob_result;
} else {

  ob_start();?>
  <div class=bor><table width=100% cellpadding=0 cellspacing=0 border=0>

<tr bgcolor=#f1f1f1><td class=par_name11 width=90 >Диагональ</td><td class=par_val11 width=70 >

<?
    if ($item["diagonal"] > 0 and $item["diagonal_hide"] !== "1") {
        $diagonal = $item["diagonal"] . "\"";
    } else {
        $diagonal = " - ";
    }
?>



<?=$diagonal?></td>
<td class="par_name11" width="90">Разрешение</td><td class="par_val11"><?=$item["resolution"]?></td></tr>
<tr><td class="par_name11">Процессор</td><td colspan="3" class="par_val11"><?=$item["cpu_type"]?></td></tr>



<tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3><?=$inter?></td></tr>


</table></div>
</div>

    <? $out .= ob_get_clean();

}

echo $out;
