<?php

session_start();

echo "!!!!!!!!!!";

define("bullshit", 1);

include "../sc/dbcon.php";

include("../sc/lib_new.php");



//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));



global $mysqli_db;

mysqli_query($mysqli_db, "SET NAMES 'cp1251'");



$soft1 = $soft2 = $soft3 = $soft4 = $soft5 = $soft6 = $soft7 = $soft8 = $soft9 = $link_advanced_search = $inter1 = $cpu_speed = $cpu_type = $ram = $flash = $rtc = $current = $os1 = $vibr = $shok = $hum = "";





//echo "sss=".$_SERVER['SCRIPT_FILENAME'];

//echo "sss=".$_SERVER['DOCUMENT_ROOT'];

//---------------content ---------------------



$prices_out = '

<script>

function dich(num,link)

 {

if (link != "0") {

   $("#dd").html("<a id=\"biglightbox\" href=\'"+link+"\' rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img src=\'"+num+"\'\"></span></a>");

} else {

 $("#dd").html("<img src=\'"+num+"\'\">");



};





 }

 /*

 $(function() {

    $( "#tabs" ).tabs({

      event: "mouseover"

    });

  });

*/

$(function() {

    $( "#tabs" ).tabs();

  });





$(document).ready(function(){

 $(\'.toclick\').click(function() {

  $(\'.lightbox\').prop(\'rel\', \'lightbox[1]\');

   $(this).children(\'.lightbox\').prop(\'rel\', \'box[1]\');

	});

	});



  </script> ';





$vta = (explode('?', $_SERVER['REQUEST_URI']));





$var_to_array = str_replace(".php/", "", $vta[0]);

$var_to_array = str_replace(".php", "", $var_to_array);

$var_to_array = str_replace("//", "/", $var_to_array);



$var_array = explode("/", $var_to_array);

$levels = count($var_array);

$end_page = $levels - 1;

//$num="MT8070iH";

//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));

$num = str_replace(".php", "", $var_array[$end_page]);





$sql = "SELECT * FROM products_all WHERE `model` = '$num' OR `s_name` = '$num'  ";

$res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

$r = mysqli_fetch_object($res);

if ($r == null) {

    header("HTTP/1.1 404 Not Found");

    header("Location: https://" . $_SERVER['HTTP_HOST'] . "/404.php");

} else {

    header("HTTP/1.1 301 Moved Permanently");

    if($r->discontinued != '1'){

        header("Location: /" . strtolower($r->brand) . '/' . $r->model . '/');

    }else{

        header("Location: /catalog/industrial_monitors/");

    }



    exit();

}



//echo basename($_SERVER['PHP_SELF']);

/*

  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;��� ����� 4 ���.</div>";

  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;���� �� �������: ���, ���, ����</div>";

 */



if ($r->type == 'hmi') {

    $type = '������ ���������';

    $title = $r->model . ', ' . $r->diagonal . '&quot; ������ ��������� ' . $r->brand . ' �� ������ �� �������� ����';

};

if ($r->type == 'panel_pc') {

    $type = '��������� ���������';

    $title = '��������� ��������� ' . $r->diagonal . '&quot; ' . $r->model . ', ��������, ����, �����';

};

if ($r->type == 'open_hmi') {

    $type = 'OPEN HMI';

    $title = 'Open HMI ' . $r->model . ' ' . $r->brand . ' �� ������ �� �������� ����';

};

if ($r->type == 'machine-tv-interface') {

    $type = '��������� MACHINE-TV';

    $title = '��������� Machine-TV ' . $r->model . ' ' . $r->brand . ' �� ������ �� �������� ����';

};

if ($r->type == 'cloud_hmi') {

    $type = '�������� ���������';

    $title = '�������� ��������� ' . $r->model . ' ' . $r->brand . ' �� ������ �� �������� ����';

    $keywords = '��������, ���������, ' . $r->model . ', ������������, Weintek, ���������, ���������, ���������';

    $description = '�������� ��������� ' . $r->model . ' Weintek - ������������ ���������� ���������� ���������';

};

if ($r->type == 'monitor') {

    $type = '������������ �������';

    $title = '������������ ������� ' . $r->diagonal . '&quot; ( ������������, ��������� ) ' . $r->model;

    $keywords = '������������, �������, ' . $r->model . ', ' . $r->brand . ', ��������� ' . $r->diagonal . '&quot;, ������������, ���������';

    $description = '������������ ������� ' . $r->model . '� ���������� ' . $r->diagonal . '&quot;, ������������, ��������� - ����������� ��������� ���� � ��������';

};



$nav = '<br /><nav><a href="/">�������</a>&nbsp;/&nbsp;<a href="/monitors/">������������ ��������</a>&nbsp;/&nbsp;������������ ������� ' . (($r->brand != 'IFC') ? $r->brand : '') . ' ' . $r->model . '</nav>';



$onst = show_stock($r, 1);

$onst2 = show_stock($r, 3);





/*if (!preg_match('/Cincoze/i', $r->brand)) {

    $min_table = miniatures($r->model, 5, 10, 350); // mins_in_row, mins_max, table_width

} else {

    $min_table = min_ps($num, 5, 10, 350);

};*/

//$im1=get_big_pic($r->model);

$ipath = 'images/' . strtolower($r->brand) . '/' . $num . '/' . $num . '_1.png';





/*if (empty($min_table)) {

    $min_table = '<table width="350" bfcolor=red><tr>' . $all_images . '</tr></table>';

};*/

if (!empty($ipath)) {

    $im1 = $ipath;

};





if ($GLOBALS["net"] == 0) {

    if (file_exists($GLOBALS["path_to_real_files"] . '/images/' . strtolower($r->brand) . '/' . $num . '/lg/' . $num . '_1.png')) {

        $bim1 = '/images/' . strtolower($r->brand) . '/' . $num . '/lg/' . $num . '_1.png';

    } else {

        $bim1 = '';

    };

} else {

    $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($r->brand) . '/' . $num . '/lg/' . $num . '_1.png');

    if (isset($re[0]) && $re[0] > 0) {

        $bim1 = '/images/' . strtolower($r->brand) . '/' . $num . '/lg/' . $num . '_1.png';

    } else {

        $bim1 = '';

    };

};



if (!empty($bim1)) {

    $kartinka = "

<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\">

<img src='/$im1' alt=''></span></a>";

} else {

    $kartinka = "

<img src='/$im1' alt=''>";

};





$alt = get_kw("alt");



$b = '/' . $r->brand . '/i';

if (preg_match($b, $r->model)) {

    $brand = '';

} else {

    $brand = $r->brand;

};



if (($r->retail_price != '0') and ($r->retail_price != '')) {

    $action_price = action_price($r->model);

    if (!empty($action_price)) {



        $priceb = "<td width=60 ><span class='prpr old'>$r->retail_price</span><span class='prpr action' title='������� ��� ��������� � ���' style='  margin-top: -18px;  margin-left: -25px;'>$action_price</span></td><td class=val_name title='������� ��� ��������� � ���'> USD </td>";

    } else {



        $priceb = "<td width=60 class=prpr title='������� ��� ��������� � ���' >$r->retail_price</td><td class=val_name title='������� ��� ��������� � ���'> USD </td>";

    };

} else {

    $priceb = "<td width=60 colspan='2' style='display: initial;

padding: 0px 20px;

border: none;

background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >��&nbsp;�������</td>";

};

$modifi = show_pc_variants($r->model);



$parant_model = [

    "model" => $r->model,

    "spec_modif" => $r->spec_modif,

    "onst" => $onst2,

    "brand" => $r->brand,

    "retail_price" => $r->retail_price,



];





$modifi = print_modifis_in_detail_template($r->model, $parant_model);

ob_start(); ?>



    <center>

<?= $nav ?><br>

    <table width=100% height=400px>

    <tr>

        <td colspan=2 height=50px>

            <table>

                <tr>

                    <td width=840 align=left bfcolor=#cccccc>

                        <h1 class=big_pan_name><?= $type ?> <?= $r->diagonal ?>&quot;

                            <strong><?= $brand ?> <?= $r->model ?></strong></h1>

                    </td>



                    <? if (empty($modifi)): ?>

                        <td width="120">

                            <div class="pan_price_big" title='��������� ����'> ���� � ���</div>

                        </td>

                        <?= $priceb ?>

                    <? endif; ?>

                </tr>

            </table>

            <div class=hc1>&nbsp;</div>

            <br>

        </td>

    </tr>

    <tr>

    <td class="pictures" valign=top align=center valign=center width=50% bfcolor=#eeeeee>

        <?= print_pictures_in_detail_template($r->brand, $r->type, $r->model, $r->pics_number) ?>

        <?

        if ($r->youtube_video != '') {

            $youtube_video = '<div class="block_view_video">';

            $youtube_video .= $r->youtube_video;

            $youtube_video .= '</div>';

            echo $youtube_video;

        }

        ?>

    </td>





    <td valign=top>



<? $prices_out .= ob_get_clean();

//----------------------------------right part content -----------------------

$prices_out .= "

<script>

$(document).ready(function(){

 $('.mytab2 tr:even').addClass('gray');



	});

</script>	";





ob_start(); ?>

    <div id=cont_rp>



<? if (empty($modifi)): ?>

    <table>



        <tr>

            <td colspan=3> &nbsp;</td>

        </tr>

        <tr>

            <td width=5>&nbsp;</td>

            <td width=80 class=h2_text>�������:</td>

            <td><?= $onst ?></td>

            <td></td>

        </tr>



    </table><br>



    <table>

        <tr>

            <td>

                <div class=but_wr>

                    <div class='zakazbut addToCart' idm='<?= $r->model ?>'><span>� �������</span></div>

                </div>

            </td>

            <td>

                <div class=but_wr>

                    <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_compare(this)'><span>� ���������</span>

                    </div>

                </div>

            </td>

            <td>

                <div class=but_wr>

                    <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_backup_call(2, "<?= $r->model ?>")'>

                        <span>����� � 1 ����</span></div>

                </div>

            </td>

            <td>

                <div class=but_wr>

                    <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_backup_call(1, "<?= $r->model ?>")'>

                        <span>�������� ������</span></div>

                </div>

            </td>

        </tr>

        <tr>

            <td colspan=4><br>

                <div class=hc1></div>

            </td>

        </tr>

    </table>

<? endif; ?>



<? $prices_out .= ob_get_clean();





$im = "<img src='../images/tick.png' width=15 style='vertical-align: middle;'>";

$he = "height=40 class=hl_text";

$vc = "valign=center";

if (($r->case_material != "�������") and ($r->type != 'monitor'))

    $cm = "<tr><td>$im </td><td $he>����� ����������� ������</td></tr>";

else

    $cm = "";



$proj_load = "";

if ($r->usb_client != "")

    $proj_load .= "� �� �� USB";

if ($r->ethernet != "") {

    if ($proj_load != "")

        $proj_load .= ", ";

    $proj_load .= "� �� �� Ethernet";

}



if ($r->usb_host != "")

    $proj_load .= ", � ������";

if ($r->sdcard != "")

    $proj_load .= ", � SD �����";



if (!empty($proj_load)) {

    $proj_load1 .= "<tr><td>$im </td><td $he>�������� �������:$proj_load</td></tr>";

} else {

    $proj_load1 = '';

}

;



if ($r->os != "")

    $proj_load1 = "";



if (!empty($r->software)) {

    $os1 = "<tr><td valign=center>$im </td><td valign=middle $he>��: $r->software (����������)</td></tr> ";

}

;

if ($r->os != "")

    $os1 = "<tr><td valign=center>$im </td><td valign=middle $he>������ � ������������ �������� $r->os .NET $r->dotnet</td></tr> ";



/*

$inter = $r->serial;



if ($r->ethernet != "") {

    if (!empty($inter)) {

        $inter .= ", Ethernet";

    } else {

        $inter .= "Ethernet";

    };

};

if ($r->usb_host != "")

    $inter .= ", USB host";

if ($r->sdcard != "")

    $inter .= ", SD �����";

if ($r->can_bus != "")

    $inter .= ", CAN";

if ($r->linear_out != "")

    $inter .= ", �������� ����� �����";

if (!empty($inter)) {

    $inter1 = '<tr><td>' . $im . '</td><td ' . $he . '>' . $inter . '</td></tr>';

} else {

    $inter1 = '';

};

*/



$remote = "";

if ($r->ethernet != "" && $r->os == "")

    $remote = "<tr><td>$im </td><td $he>��������� ������ �� VNC, FTP, EasyAccess </td></tr>";

if ($r->ethernet != "" && $r->os != "")

    $remote = "<tr><td>$im </td><td $he>��������� ������ �� VNC, FTP </td></tr>";



$fastgr = "";

if ($r->series == "iE")

    $fastgr = "<tr><td>$im </td><td $he>������� ������ � �������� <br>( �� 10 ��� �������, ��� � ������ ������ )</td></tr>";

$isoports = "";

if ($r->series == "iE")

    $isoports = "<tr><td>$im </td><td $he>������ �������������� �������� ���� ������</td></tr>";



$speed = "";

if ($r->series == "MT8000XE")

    $speed = "<tr><td>$im </td><td $he>��������� 1���, ����� ��������</td></tr>";

if (!empty($r->touch)) {

    $touch = "<tr><td>$im </td><td $he>��������� �����: $r->touch</td></tr>";

}

;





if (!empty($r->touch)) {

    $touch = "<tr><td>$im </td><td $he>$r->touch</td></tr>";

}

;

if (($r->type == 'monitor') and ($r->diagonal >= 6)) {

    $glas = "<tr><td>$im </td><td $he>������ ��������� ���������� � ������� �����������</td></tr>";

}

;





if ($r->brand == 'Weintek') {

    $quality = '���������� �������� � ����������';

} else {

    $quality = '����������� ����������� ���� � ��������';

}

;



$outputs = array();

$outputs__video__all = array();

$outputs__audio__all = array();

$outputs_all = array();



if (!empty($r->vga_port))

    $outputs_all["VIDEO"][] = $r->vga_port;

if (!empty($r->dvi_port))

    $outputs_all["VIDEO"][] = $r->dvi_port;

if (!empty($r->displayport))

    $outputs_all["VIDEO"][] = $r->displayport;

if (!empty($r->hdmi))

    $outputs_all["VIDEO"][] = $r->hdmi;

if (!empty($r->linear_out))

    $outputs_all["AUDIO"][] = $r->linear_out;



foreach ($outputs_all as $key => $value) {

    if ($key == 'VIDEO') {

        $outputs__video__all = $value;

    }

    if ($key == 'AUDIO') {

        $outputs__audio__all = $value;

    }

    $outputs_all = $value;

}

$outputs__video__all__string = implode(' + ', $outputs__video__all);

$outputs__audio__all__string = implode(' + ', $outputs__audio__all);

$outputs__all__string = implode(' + ', $outputs_all);





if (preg_match('/ifc/i', $r->brand)) {

    if ($r->diagonal >= 10) {

        $glas2 = "<tr><td>$im </td><td $he>" . $outputs__all__string . "</td></tr>";

    } elseif ($r->diagonal >= 8) {

        $glas2 = "<tr><td>$im </td><td $he>VGA + Audio �����</td></tr>";

    } else {

        $glas2 = "<tr><td>$im </td><td $he>VGA ����</td></tr>";

    };



    $poverplag = '<tr><td>' . $im . '</td><td ' . $he . '>����� ������� ������ � USB</td></tr>

<tr><td>' . $im . '</td><td ' . $he . '>H��������� ������� �������� 12-24 VDC, � ��������� ���� ���� ������� </td></tr>

<tr><td>' . $im . '</td><td ' . $he . '>��������������� �� ������ ( IP65 )</td></tr>

';

} else if (preg_match('/cincoze/i', $r->brand)) {

    $inter1 = '';

    $glas2 = "<tr><td>$im </td><td $he>1 x USB, 1 x COM, 1 x VGA, 1 x DVI-D, 1 x Audio</td></tr>";



    $poverplag = '<tr><td>' . $im . '</td><td ' . $he . '>����������� / ��������� ������ </td></tr>

<tr><td>' . $im . '</td><td ' . $he . '>����� ������� ������ � USB</td></tr>

<tr><td>' . $im . '</td><td ' . $he . '>H��������� ������� �������� 12 VDC (���� ������� - �����)</td></tr>

<tr><td>' . $im . '</td><td ' . $he . '>��������������� �� ������ ( IP65 )</td></tr>

';

}

;

$prices_out .= "<br>

<table width=100%>

$speed

$os1

<tr><td width=30>$im </td><td $he>$quality</td></tr>

$cm

$inter1

$remote

$proj_load1

$fastgr

$isoports



$glas

$touch

$glas2



$poverplag



</table>

</div>

";





// --------------------- end right part content -----------------------



$prices_out .= "</td></tr></table>"; // end big table

//----------------------------------------end pics ----------------------------





$bg1 = "style='background: #fefefe';";

$bg2 = "style='background: #f5f5f5';";

$table_start = "<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";



$us_tr_l = '<tr><td class=par_name1 >';

$us_tr_l1 = '</td><td class=par_val1 >';





if (!empty($modifi)) {

    $prices_out .= '<br><span class=big_pan_name><b>��������� �����������:</b></span> <br><br>' . $modifi;

}

//----------------------------tab1 -----------------------------------------





if ($r->ethernet != "" && $r->software != "") {

    $dop = "<tr><td class=par_name1 >��������� ������ � ������</td><td class=par_val1 >FTP(������, �������, ������ �������), VNC (��������� ������),<br>

   EasyAccess (��������� ������, �������� ������� )</td></tr>

   <tr><td class=par_name1 >Ftp ������ � ������ ������</td><td class=par_val1 >" . ($r->ftp_access_hmi_mem ? "����" : "-") . "</td></tr>

   <tr><td class=par_name1 >Ftp ������ � SD ����� � ������</td><td class=par_val1 >" . ($r->ftp_access_sd_usb ? "����" : "-") . "</td></tr>

   ";

} else

    $dop = "";



$arch = "������ ������";

if ($r->usb_host != "")

    $arch .= ", ������";

if ($r->sdcard != "")

    $arch .= ", SD �����";





$mount = "";

if (($r->wall_mount == "����") or ($r->wall_mount == "yes")) {

    $mount .= "� �����";

} else {

    $mount .= $r->wall_mount;

}

;



if ($r->vesa75 != "") {

    if ($mount != '') {

        $mount .= ", VESA 75x75";

    } else {

        $mount .= "VESA 75x75";

    };

}

;

if ($r->vesa100 != "") {

    if ($mount != '') {

        $mount .= ", VESA 100x100";

    } else {

        $mount .= "VESA 100x100";

    };

}

;





$usb_drv = "<tr><td class=par_name1 >�������� USB (��� �������� ������� � �� � ������ )</td><td class=par_val1 >��������������� ��� ��������� $r->software</td></tr>";

if ($r->usb_client == "")

    $usb_drv = "";





if (empty($r->backlight)) {

    if ($r->type == 'monitor') {

        $backlight = '<tr><td class=par_name1 >��� ���������</td><td class=par_val1 >LED</td></tr>';

    };

    if (!empty($r->backlight_life)) {

        $backlight .= '<tr><td class=par_name1 >����� ��������� �� �����</td><td class=par_val1 >' . $r->backlight_life . ' �</td></tr>';

    };

} else {



    $backlight = '<tr><td class=par_name1 >��� ���������</td><td class=par_val1 >' . $r->backlight . '</td></tr>

 <tr><td class=par_name1 >����� ����� ���������</td><td class=par_val1 >' . $r->backlight_life . ' �</td></tr>';

}

;



if (($r->type == 'monitor') and ($r->brand == 'IFC')) {

    $toucho = '����������� � USB ������������';

} else {

    $toucho = $r->touch;

}

;

$display_char = " <tr><td class=par_name1>�������</td><td class=par_val1  >$r->brightness ��/�2</td></tr>

 $backlight

 <tr><td class=par_name1>�������������</td><td class=par_val1 >$r->contrast</td></tr>

 <tr><td class=par_name1>���������</td><td class=par_val1 >$r->colors ������</td></tr>



 <tr><td class=par_name1>��� �������</td><td class=par_val1 >$r->touch</td></tr>";





$without = '';

if ($r->brand == 'Cincoze') {

    $without = !preg_match('/-W/i', $r->model) ? '(4:3)' : '(16:9)';

}

;

if (!empty($r->pixel_pitch)) {

    $pixel_pitch = $us_tr_l . '������ �������</td>' . $us_tr_l1 . $r->pixel_pitch . '</td></tr>';

} else {

    $pixel_pitch = '';

}

;

if (!empty($r->response_time)) {

    $response_time = $us_tr_l . '����� ������</td>' . $us_tr_l1 . $r->response_time . ' ��</td></tr>';

} else {

    $response_time = '';

}

;

if (!empty($r->view_angle)) {

    $view_angle = $us_tr_l . '���� ������</td>' . $us_tr_l1 . $r->view_angle . '</td></tr>';

} else {

    $view_angle = '';

}

;



$sp_data1 = '

 <div style="width:90%;">

 <span class=hpar>�������</span><br>' .

    $table_start .

    '<tr><td class=par_name1>���������</td><td class=par_val1 >' . $r->diagonal . '&quot; ' . $without . '</td></tr>

 <tr><td class=par_name1>����������</td><td class=par_val1 >' . $r->resolution . '</td></tr>' .

    $display_char . $pixel_pitch . $response_time . $view_angle . '

 </table><br><br>';





if (!empty($r->cpu_type)) {

    $cpu_type = "<tr><td class=par_name1 >���������</td><td class=par_val1 >$r->cpu_type</td></tr>";

}

;

if (!empty($r->cpu_speed)) {

    $cpu_speed = "<tr><td class=par_name1 >�������</td><td class=par_val1 >$r->cpu_speed ���</td></tr>";

}

;

if (!empty($r->ram)) {

    $ram = "<tr><td class=par_name1 >���</td><td class=par_val1 >$r->ram ��</td></tr>";

}

;

if (!empty($r->flash)) {

    $flash = "<tr><td class=par_name1 >Flash ( ���������� )</td><td class=par_val1 >$r->flash ��</td></tr>";

}

;

if (!empty($r->rtc)) {

    $rtc = "<tr><td class=par_name1 >RTC ( ���� ��������� ������� )</td><td class=par_val1 >" . ($r->rtc ? $r->rtc : '-') . "</td></tr>";

}

;



$params = $cpu_type . $cpu_speed . $ram . $flash . $rtc;

if (!empty($params)) {

    $sp_data1 .= '<span class=hpar>���������</span><br>' .

        $table_start . $params . '</table><br><br>';

}

;

/*

  $sp_data1 .="<span class=hpar>����������</span><br>

  $table_start

  <tr><td class=par_name1 >���������������� ����������</td><td class=par_val1 >$r->serial_full</td></tr>

  $modbus

  $mpi

  <tr><td class=par_name1 >USB Host</td><td class=par_val1 >".($r->usb_host?$r->usb_host:'-')."</td></tr>

  <tr><td class=par_name1 >USB Client</td><td class=par_val1 >".($r->usb_client?$r->usb_client:'-')."</td></tr>

  <tr><td class=par_name1 >���� SD �����</td><td class=par_val1 >".($r->sdcard?$r->sdcard:'-')."</td></tr>

  <tr><td class=par_name1 >Ethernet</td><td class=par_val1 >".($r->ethernet?$r->ethernet:'-')."</td></tr>

  <tr><td class=par_name1 >�������� ����������</td><td class=par_val1 >".($r->linear_out?$r->linear_out:'-')."</td></tr>

  <tr><td class=par_name1 >���������</td><td class=par_val1 >".($r->video_input?$r->video_input:'-')."</td></tr>

  <tr><td class=par_name1 >CAN</td><td class=par_val1 >".($r->can_bus?$r->can_bus:'-')."</td></tr>

  </table><br><br>";

 */



if ($r->type == 'monitor') {



    $interfaces = $us_tr_l . '����� ������� ������</td>' . $us_tr_l1 . 'USB</td></tr>';

    if ($r->brand == 'IFC') {

        if ($r->diagonal >= 10) {



            $interfaces = $us_tr_l . '�����-�����</td>' . $us_tr_l1 . $outputs__video__all__string . '</td></tr>' .

                $us_tr_l . '�����-����</td>' . $us_tr_l1 . '3,5 Jack</td></tr>' .

                $interfaces;

        } elseif ($r->diagonal >= 8) {

            $interfaces = $us_tr_l . '�����-����</td>' . $us_tr_l1 . 'VGA</td></tr>' .

                $us_tr_l . '�����-����</td>' . $us_tr_l1 . '3,5 Jack</td></tr>' .

                $interfaces;

        } else {

            $interfaces = $us_tr_l . '�����-����</td>' . $us_tr_l1 . 'VGA</td></tr>' .

                $interfaces;

        };

    } else {



        $interfaces = $us_tr_l . '�����-�����</td>' . $us_tr_l1 . 'VGA + DVI-D</td></tr>' .

            $us_tr_l . 'USB</td>' . $us_tr_l1 . $r->usb_host . '</td></tr>';



        if (!empty($r->rgb)) {

            $rgb = $us_tr_l . 'RGB �����������</td>' . $us_tr_l1 . $r->rgb . '</td></tr>';

        } else {

            $rgb = '';

        };

        if (!empty($r->dc_input)) {

            $dc_input = $us_tr_l . 'DC ����</td>' . $us_tr_l1 . $r->dc_input . '</td></tr>';

        } else {

            $dc_input = '';

        };

        if (!empty($r->av_input)) {

            $av_input = $us_tr_l . 'AV ����</td>' . $us_tr_l1 . $r->av_input . '</td></tr>';

        } else {

            $av_input = '';

        };

//if (!empty($r->dvi_d)) {$dvi_d = $us_tr_l.'DVI-D ������</td>'.$us_tr_l1.$r->dvi_d.'</td></tr>';} else {$dvi_d='';};

        if (!empty($r->ts_rs232)) {

            $ts_rs232 = $us_tr_l . 'RS232 ���������� ������</td>' . $us_tr_l1 . $r->ts_rs232 . '</td></tr>';

        } else {

            $ts_rs232 = '';

        };

        if (!empty($r->ts_usb)) {

            $ts_usb = $us_tr_l . 'USB ���������� ������</td>' . $us_tr_l1 . $r->ts_usb . '</td></tr>';

        } else {

            $ts_usb = '';

        };

        if (!empty($r->s_video)) {

            $s_video = $us_tr_l . 'S-Video ������</td>' . $us_tr_l1 . $r->s_video . '</td></tr>';

        } else {

            $s_video = '';

        };

        if (!empty($r->ethernet_full)) {

            $ethernet_full = $us_tr_l . 'Ethernet</td>' . $us_tr_l1 . $r->ethernet_full . '</td></tr>';

        } else {

            $ethernet_full = '';

        };

        if (!empty($r->serial_full)) {

            $serial_full = $us_tr_l . '���������������� ���������</td>' . $us_tr_l1 . $r->serial_full . '</td></tr>';

        } else {

            $serial_full = '';

        };

        if (!empty($r->usb_host)) {

            $usb_host = $us_tr_l . 'USB ����</td>' . $us_tr_l1 . $r->usb_host . '</td></tr>';

        } else {

            $usb_host = '';

        };

        if (!empty($r->usb_client)) {

            $usb_client = $us_tr_l . 'USB ������</td>' . $us_tr_l1 . $r->usb_client . '</td></tr>';

        } else {

            $usb_client = '';

        };

//if (!empty($r->serial)) {$serial = $us_tr_l.'���������������� ����</td>'.$us_tr_l1.$r->serial.' '.$r->serial_full.'</td></tr>';} else {$serial='';};

//if (!empty($r->parallel_port)) {$parallel_port = $us_tr_l.'������������ ����</td>'.$us_tr_l1.$r->parallel_port.'</td></tr>';} else {$parallel_port='';};

        if (!empty($r->pci_slot)) {

            $pci_slot = $us_tr_l . '���� ���������� PCI</td>' . $us_tr_l1 . $r->pci_slot . '</td></tr>';

        } else {

            $pci_slot = '';

        };

        if (!empty($ps2)) {

            $ps2 = $us_tr_l . 'PS/2</td>' . $us_tr_l1 . $ps2 . '</td></tr>';

        } else {

            $ps2 = '';

        };

//if (!empty($r->mic_in)) {$mic_in = $us_tr_l.'����������� ����</td>'.$us_tr_l1.$r->mic_in.'</td></tr>';} else {$mic_in='';};

        if (!empty($r->linear_out)) {

            $linear_out = $us_tr_l . '�������� �����</td>' . $us_tr_l1 . $r->linear_out . '</td></tr>';

        } else {

            $linear_out = '';

        };

        if (!empty($r->speakers)) {

            $speakers = $us_tr_l . '��������</td>' . $us_tr_l1 . $r->speakers . '</td></tr>';

        } else {

            $speakers = '';

        };

//if (!empty($r->vga_port)) {$vga_port = $us_tr_l.'VGA ����</td>'.$us_tr_l1.$r->vga_port.' ������</td></tr>';} else {$vga_port='';};

        if (!empty($r->audio)) {

            $audio = $us_tr_l . '�����</td>' . $us_tr_l1 . $r->audio . ' </td></tr>';

        } else {

            $audio = '';

        };

        if (!empty($r->audio)) {

            $audio .= $us_tr_l . '����� ����</td>' . $us_tr_l1 . $r->mic_in . ' </td></tr>';

        } else {

            $audio = '';

        };



//if (!empty($r->voltage)) {$voltage = $us_tr_l.'DC Power ����</td>'.$us_tr_l1.'�������� �'.$r->voltage .' ('.$r->voltage_min .'-'.$r->voltage_max  .' V)</td></tr>';} else {$voltage='';};

        $interfaces .= $ethernet_full . $serial_full . $usb_host . $usb_client . $serial . $parallel_port . $pci_slot . $ps2 . $mic_in . $linear_out .

            $speakers . $vga_port . $audio . $voltage . $rgb . $dc_input . $av_input . $dvi_d . $ts_rs232 . $ts_usb . $s_video;

    };

} else {



}

;

if (!empty($r->case_material)) {

    $case_material = $us_tr_l . '�������� �������</td>' . $us_tr_l1 . $r->case_material . '</td></tr>';

} else {

    $case_material = '';

}

;

if (!empty($r->front_ip)) {

    $front_ip = $us_tr_l . '������� ������ ������� ������ </td>' . $us_tr_l1 . $r->front_ip . '</td></tr>';

} else {

    $front_ip = '';

}

;

if (empty($r->cpu_fan)) {

    $fan = '';

    //$fan = $us_tr_l . '����������</td>' . $us_tr_l1 . '����������������</td></tr>';

} else {

    $fan = $us_tr_l . '����������</td>' . $us_tr_l1 . $r->cpu_fan . '</td></tr>';

}

;

if (!empty($mount)) {

    $mount = $us_tr_l . '���������</td>' . $us_tr_l1 . $mount . '</td></tr>';

} else {

    $mount = '';

}

;

if (!empty($r->cutout)) {

    $cutout = $us_tr_l . '���������� ���������</td>' . $us_tr_l1 . $r->cutout . ' ��</td></tr>';

} else {

    $cutout = '';

}

;

if (!empty($r->dimentions)) {

    $dimentions = $us_tr_l . '��������</td>' . $us_tr_l1 . $r->dimentions . ' ��</td></tr>';

} else {

    $dimentions = '';

}

;

if (!empty($r->power_connector)) {

    $power_connector = $us_tr_l . '������ �������</td>' . $us_tr_l1 . $r->power_connector . '</td></tr>';

} else {

    $power_connector = '';

}

;

if ($r->brand == 'Cincoze') {

    if (!empty($r->netto)) {

        $netto = $us_tr_l . '��� (�����) </td>' . $us_tr_l1 . $r->netto . ' ��</td></tr>';

    } else {

        $netto = '';

    };

} else {

    if (!empty($r->netto) && !empty($r->weight)) {

        $netto = $us_tr_l . '��� (����� / ������)</td>' . $us_tr_l1 . $r->netto . ' / ' . $r->weight . ' ��</td></tr>';

    } elseif (!empty($r->netto) && empty($r->weight)) {

        $netto = $us_tr_l . '��� (�����)</td>' . $us_tr_l1 . $r->netto . '</td></tr>';

    } else {

        $netto = '';

    };

}

;

if (!empty($r->set)) {

    $set = $us_tr_l . '�������� ��������: ' . $us_tr_l1 . $r->set . '</td></tr>';

} else {

    $set = '';

}

;

$Design = $case_material . $front_ip . $fan . $mount . $cutout . $dimentions . $power_connector . $netto . $set;



$sp_data1 .= '<span class=hpar>����������</span><br>' .

    $table_start . $interfaces

    . '</table><br><br>';





/*

  $sp_data1 .="<span class=hpar>�����������</span><br>

  $table_start

  <tr><td class=par_name1 >�������� �������</td><td class=par_val1 >$r->case_material</td></tr>

  <tr><td class=par_name1 >������� ������ �� ������</td><td class=par_val1 >IP65</td></tr>

  <tr><td class=par_name1 >������ ����������</td><td class=par_val1 >".($r->cpu_fan?"����������":"����������������")."</td></tr>

  <tr><td class=par_name1 >�������� ���������</td><td class=par_val1 >$mount</td></tr>

  <tr><td class=par_name1 >�������� ��������</td><td class=par_val1 >$r->set</td></tr>

  <tr><td class=par_name1 >������ �������</td><td class=par_val1 >$r->power_connector</td></tr>

  <tr><td class=par_name1 >��������</td><td class=par_val1 >$r->dimentions ��</td></tr>

  <tr><td class=par_name1 >����� ��� �������</td><td class=par_val1 >$r->cutout ��</td></tr>

  <tr><td class=par_name1 >���</td><td class=par_val1 >$r->netto ��</td></tr>

  <tr><td class=par_name1 >������� �����������</td><td class=par_val1 >$r->temp_min&deg - $r->temp_max&deg</td></tr>

  </table><br><br>";

 */

$sp_data1 .= '<span class=hpar>�����������</span><br>' . $table_start . $Design . '</table><br><br>';





if (($r->os != "") or ($r->type != 'monitor')) {

    $sp_data1 .= "<span class=hpar>�O</span><br>";

    $sp_data1 .= $table_start;





    if ($r->os != "")

        $sp_data1 .= "

 <tr><td class=par_name1>������������� ������������ �������</td><td class=par_val1 >$r->os</td></tr>

 <tr><td class=par_name1>.NET framework</td><td class=par_val1 >$r->dotnet</td></tr>

 <tr><td class=par_name1>��</td><td class=par_val1 >� ������� �� ������������ ������� ��. � EasyBuilder8000 � EasyBuilderPro ������

 ����������� ������ ��� ���� ������. ��� ���������� �������� ���������� ������������ ����� ����� ��� �������� �������� ��� $r->os, �������� Visual Studio</td></tr>



 ";

    elseif ($r->type != 'monitor')

        $sp_data1 .= "

 <tr><td class=par_name1>�� ��� ���������� ��������</td><td class=par_val1 >$r->software</td></tr>

 <tr><td class=par_name1>������������ ���������� ������� � �������</td><td class=par_val1 >1999</td></tr>

 $usb_drv

 <tr><td class=par_name1>�������� ��� ������ � �������������</td><td class=par_val1 >��� ����������� � ������</td></tr>

 <tr><td class=par_name1>����������� ���������� ������� ������</td><td class=par_val1 >$arch</td></tr>

 <tr><td class=par_name1>������� �������� ������� � ������</td><td class=par_val1 >$proj_load</td></tr>

 <tr><td class=par_name1>������������ ������ �������</td><td class=par_val1 >$r->project_size_mb ��</td></tr>

 <tr><td class=par_name1>����� ������ ��� ���������� ������� � ������</td><td class=par_val1 >$r->history_data_size_mb ��</td></tr>



 <tr><td class=par_name1>����������� �������� ���������������� ����������</td><td class=par_val1 >����</td></tr>

  $dop

 <tr><td class=par_name1>������������ �������</td><td class=par_val1 >��������, ��� � ���� � ������, �� � �� �������� ���������� �������� ������. ���������� ��������� �������

���������������� ����������� �����. ����������� �����

  ������������ ������ ���� �������������, ������� ������������� $r->software </td></tr>

    ";

    $sp_data1 .= "</table><br><br>";

}

;

if (!empty($r->temp_operating)) {

    $tempo = $us_tr_l . '������� �����������</td>' . $us_tr_l1 . $r->temp_operating . '</td></tr>';

}

;

if (!empty($r->vibration)) {

    $vibr = $us_tr_l . '��������</td>' . $us_tr_l1 . $r->vibration . '</td></tr>';

}

;

if (!empty($r->shock)) {

    $shok = $us_tr_l . '������� ��������</td>' . $us_tr_l1 . $r->shock . '</td></tr>';

}

;



if (((!empty($r->voltage_min)) and ($r->voltage_min != 0)) and ((!empty($r->voltage_max)) and ($r->voltage_max != 0))) {

    $vminmax = '(' . $r->voltage_min . '~' . $r->voltage_max . ') ';

}

;



$powero = $us_tr_l . '���������� �������</td>' . $us_tr_l1 . $r->voltage . ' </td></tr>';

$powero .= $us_tr_l . '������������ ��������</td>' . $us_tr_l1 . $r->power . ' ��</td></tr>';

if (!empty($r->temp_storage)) {

    $tempsto = $us_tr_l . '����������� ��������</td>' . $us_tr_l1 . $r->temp_storage . '</td></tr>';

}

;

if (!empty($r->humidity)) {

    $hum = $us_tr_l . '��������� ��� ��������</td>' . $us_tr_l1 . $r->humidity . '</td></tr>';

}

;

if (!empty($r->current)) {

    $current = $us_tr_l . '������������ ���</td>' . $us_tr_l1 . $r->current . '�</td></tr>';

}

;

$expluatation = $tempo . $vibr . $shok . $tempsto . $hum . $current;



if (!empty($expluatation)) {

    $sp_data1 .= '<span class=hpar>������������ � ��������</span><br>' .

        $table_start . $powero . $expluatation .

        '</table><br><br>';

}

;

// $sp_data1.=  "</table></div><br><br>";



$sp_data1 .= "<span class=hpar>�������� � ������������</span><br>

 $table_start

 <tr><td class=par_name1>������������</td><td class=par_val1>$r->certification</td></tr></table><br><br>";



$sp_data1 .= '</div>';





//---------------------end tab1 -------------------------

//-------------spec ---------------------------

$imagepath = 'images/' . strtolower($r->brand) . '/dim';



$dimensions = '';

$queryd = "SELECT * FROM `dimensions` WHERE `sys_name`='{$r->model}' LIMIT 1;";



$queryd = mysqli_query($mysqli_db, $queryd) or die("������ �������0213" . $queryd);

$jd = mysqli_num_rows($queryd);

if ($jd > 0) {

    $rowd = mysqli_fetch_assoc($queryd);

    if (!empty($rowd[stext])) {

        $dimensions = '<style>.dimensions1  td {

    border: 1px solid rgb(182, 182, 182);

    padding: 10px;

}



.dimensions1 table {border-collapse:collapse;}</style><div class="dimensions1" style="padding: 25px 0px 25px 0px;">' . $rowd[stext] . '</div>';

    };

}

;



if (empty($dimensions)) {

    if ($_SERVER['HTTP_HOST'] == "www.rusavtomatika.com") {

        $path = $_SERVER['DOCUMENT_ROOT'] . '/upload_files/' . $imagepath . '/' . $num . '.png';

        if (file_exists($path))

            $dimensions = '<center><a data-fancybox="dim" href="/' . $imagepath . '/' . $num . '.png"><img style="width:100%;" src="/' . $imagepath . '/' . $num . '.png"></a></center>';

    } else {

        $path = 'http://www.rusavtomatika.com/upload_files/' . $imagepath . '/' . $num . '.png';

        $re = cu($path);

        if (isset($re[0]) && $re[0] > 0) {

            $dimensions = '<center><a data-fancybox="dim" href="/' . $imagepath . '/' . $num . '.png"><img style="width:100%;" src="/' . $imagepath . '/' . $num . '.png"></a></center>';

        };

    };

}

;





$query2 = "SELECT * FROM `com` WHERE `model`='{$r->model}';";

$h2_scheme = 'COM-����� ���������� ' . $r->model;

$query2 = mysqli_query($mysqli_db, $query2) or die("������ �������0212" . $query);

$j2 = mysqli_num_rows($query2);

$scheme = '';

if ($j2 > 0) {

    for ($i2 = 0; $i2 < $j2; $i2++) {

        $row2 = mysqli_fetch_assoc($query2);

        $sname = str_replace("\r\n", "<br />", $row2[name]);

        $scheme .= '<div class="com" style="display: inline-block;"><div class="com_about">�������� �������:<br />' . $sname . '<br /><br />���:<br />' . $row2["type"] . '<img class="" src="/images/' . $row2["image"] . '" /><br /></div>';

        $scheme .= '<div class="scheme">';

        $com = str_replace("\"", "", $row2[com]);

        $com = str_replace("(", " (", $com);

        $com = explode(",", $com);

        $coms = count($com);

        $contacts = str_replace("\"", "", $row2[contacts]);

        $contacts = explode(";", $contacts);

        $scheme .= '<table><tr><td>Pin #</td>';

        for ($d = 0; $d < $coms; $d++) {

            $scheme .= '<td>' . $com[$d] . '</td>';

        };

        $scheme .= '</tr>';

        $cc = 1;

        for ($c = 0; $c < 9; $c++) {

            $scheme .= '<tr><td>' . $cc . '</td>';

            $contact = explode(",", $contacts[$c]);

            for ($d = 0; $d < $coms; $d++) {



                $scheme .= '<td>' . $contact[$d] . '</td>';

            };

            $scheme .= '</tr>';

            $cc++;

        };

        $scheme .= '</table></div></div><br /><br />';

    };

} else {

    $scheme = '� ' . $r->model . ' com-����� �����������.';

}

;



if ($r->type == 'monitor') {

    $sxemy = '';

} else {

    $sxemy = "<li class='urlup' data='scheme'><a href='#tabs-3'>�����</a></li>";

}

;

$vyvod = '<br><br>

<div style="width:100%; min-height: 500px; overflow: auto; ">

<div id="tabs">

  <ul>

     <li class="urlup" data="functions"><a href="#tabs-1">��������������</a></li>

     <li class="urlup" data="dimensions"><a href="#tabs-2">��������</a></li>

    ' . $sxemy . '

    <li class="urlup" data="software"><a href="#tabs-4">�������</a></li>

  </ul>

  <div id="tabs-1">

  <h2>����������� �������������� �������� ' . $r->model . '</h2>

    ' . $sp_data1 . '

  </div>

  <div id="tabs-2"><h2>�������� �������� ' . $r->model . '</h2>

  ' . $dimensions . '

  </div>';

if ($r->type != 'monitor') {

    $vyvod .= '<div id="tabs-3">

  <div class=connectors>

  <h2>COM-����� ������ ��������� ' . $r->model . '</h2><br />' . $scheme . '

  </div></div>

  ';

}

;

// echo  $vyvod.show_com_connector($r->model).'</div>';



$prices_out .= $vyvod;



$uuu = "";

if (!empty($_GET["tab"])) {

    if ($_GET["tab"] == 'accessories') {

        $uuu = '$(\'a[href="#tabs-5"]\').click();';

    } else if ($_GET["tab"] == 'functions') {

        $uuu = '$(\'a[href="#tabs-1"]\').click();';

    } else if ($_GET["tab"] == 'software') {

        $uuu = '$(\'a[href="#tabs-4"]\').click();';

    } else if ($_GET["tab"] == 'dimensions') {

        $uuu = '$(\'a[href="#tabs-2"]\').click();';

    } else if ($_GET["tab"] == 'scheme') {

        $uuu = '$(\'a[href="#tabs-3"]\').click();';

    };

}

;



$prices_out .= "

<script>

	$(document).ready(function(){

var urlbase = '$CANONICAL';

	$uuu

 $('.urlup').click(function() {

	 var dat = $(this).attr('data');

var nnew = 'https://'+location.hostname+urlbase+'?tab='+dat;



  if(nnew != window.location){

            window.history.pushState(null, null, nnew);

        }



	});



	});



function doclick(e) {



$('a[href=#'+e+']').click();



}

</script>";



//---------------------download section -------------------------------- ------------------------------

$usb = "";





if ($r->type == 'monitor') {

    $types = '������������ ������������ �������';

} elseif ($r->type == 'cloud_hmi') {

    $types = '���������';

} else {

    $types = '������ ���������';

}

;

if ($r->type == 'monitor') {

    $types1 = '������������� ������������� ��������';

} elseif ($r->type == 'cloud_hmi') {

    $types1 = '����������';

} else {

    $types1 = '������ ���������';

}

;

//$file = '/home/weblec/public_html/test_weinteknet/drivers';



if ($GLOBALS["net"] == 0) {

    if (file_exists($root_php . 'install/' . $num . '.pdf')) {

        $fs = (sprintf("%u", filesize($root_php . 'install/' . $r->install_doc . '.pdf')) + 0) / 1000;

        $tu = date("d-m-Y", filemtime($root_php . 'install/' . $r->install_doc . '.pdf'));

        $s6 = 1;

    } elseif (($r->install_doc != '') and (file_exists($root_php . 'install/' . $r->install_doc))) {

        $fs = (sprintf("%u", filesize($root_php . 'install/' . $r->install_doc)) + 0) / 1000;

        $tu = date("d-m-Y", filemtime($root_php . 'install/' . $r->install_doc));

        $s6 = 1;

    } else {

        $s6 = 0;

    };

} else {



    $re = cu($root_php . '/install/' . $num . '.pdf');

    $re1 = cu($root_php . '/install/' . $r->install_doc);

    if (isset($re[0]) && $re[0] > 0) {

        $s6 = 1;

//$t =  date("d-m-Y", $re[1]);

        $tu = date("d-m-Y", $re[1]);

        $fs = (sprintf("%u", $re[0]) + 0) / 1000;

    } elseif (isset($re[0]) && $re1[0] > 0) {

        $s6 = 1;

//$t =  date("d-m-Y", $re[1]);

        $tu = date("d-m-Y", $re[1]);

        $fs = (sprintf("%u", $re[0]) + 0) / 1000;

    } else {

        $s6 = 0;

    };

}

;





if ($s6 > 0) {

    if ($fs > 1000) {

        $s = round($fs / 1000, 2) . '&nbsp;��';

    } else {

        $s = round($fs, 0) . '&nbsp;��';

    };

    $soft6 = "

 <tr><td><div class=down_item> ����������� �� ��������� " . $types1 . " $r->model </div></td>

   <td><div class=dt_item>" . get_file_date('/install/' . $r->install_doc . '.pdf') . "<br>(eng)</div></td>

   <td><div class=down_item><a href='/install/" . $num . ".pdf' > <img src=/images/manual.jpg></a></div></td></tr>

 ";

} elseif (($r->install_doc != '') and (file_exists($root_php . 'install/' . $r->install_doc))) {

    $soft6 = "

 <tr><td><div class=down_item> ����������� �� ��������� " . $types1 . " $r->model </div></td>

   <td><div class=dt_item>" . $tu . "<br>" . $s . "<br>(eng)</div></td>

   <td><div class=down_item><a href='/install/" . $r->install_doc . "' > <img src=/images/manual.jpg></a></div></td></tr>

 ";

} else {

    $soft6 = '';

}

;

$add = '';



if ($GLOBALS["net"] == 0) {

    if (file_exists($root_php . 'manuals/' . $num . '.pdf')) {

        $s7 = 1;

        $fs = (sprintf("%u", filesize($root_php . 'manuals/' . $num . '.pdf')) + 0) / 1000;

        $tu = date("d-m-Y", filemtime($root_php . 'manuals/' . $num . '.pdf'));

    } else {

        $s7 = 0;

    };

} else {

    $re = cu($root_php . '/manuals/' . $num . '.pdf');

    if (empty($re[0])) {

        $re = cu($root_php . '/manuals/_' . $num . '.pdf');

        if (isset($re[0]) && $re[0] > 0) {

            $add = '_';

        };

    };

    if (isset($re[0]) && $re[0] > 0) {

        $s7 = 1;

//$t =  date("d-m-Y", $re[1]);

        $tu = date("d-m-Y", $re[1]);

        $fs = (sprintf("%u", $re[0]) + 0) / 1000;

    } else {

        $s7 = 0;

    };

}

;





if ($s7 > 0) {



    if ($fs > 1000) {

        $s = round($fs / 1000, 2) . '&nbsp;��';

    } else {

        $s = round($fs, 0) . '&nbsp;��';

    };

    $soft7 = "

 <tr><td><div class=down_item> ������� (datasheet) " . $types1 . " $r->model </div></td>

   <td><div class=dt_item>" . $tu . "<br>" . $s . "</div></td>

   <td><div class=down_item><a href='/manuals/" . $add . $num . ".pdf' > <img src=/images/manual.jpg></a></div></td></tr>

 ";

} else {

    $soft7 = '';

}

;





$prices_out .= "

  <div id='tabs-4'>

  <div class=connectors>

  <h2>����� ��� ������ � ��������� $r->model</h2>

  </div>



   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>

   <tr><td><div class=down_h>  ������������ </div></td><td width=100><div class=down_h>  ����, ������</div></td><td><div class=down_h> ������</div></td></tr>



   $soft6

   $soft7



   </table>

   <br /> <br />

  </div>

</div>

</div>

";





$prices_out .= "<br><br>";

//-----------------end content

//$template_file = 'head.html';

$template_file = 'head_canonical.html';

$imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";

ob_start(); ?>





    <meta property='og:title' content='<?= $title ?>'/>

    <meta property="og:image"

          content="<? echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png' ?>"/>

    <meta property='og:site_name' content='�������������'/>

    <link rel='image_src'

          href="<? echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png' ?>">



<? $expansionParam = ob_get_clean();



//$head = head($template_file, $title, $description, $keywords);

$head = setHeaderExpansionParam($template_file, $title, $description, $keywords, $expansionParam);





$head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);



echo $head;

?>

    <div id="mes_backgr"></div>

    <div id="body_cont">

<? include $_SERVER["DOCUMENT_ROOT"] . "/include_utf_8/header_menu.php"; ?>

    <table width="100%" bgcolor="white">

        <tr height="93">

            <td width="300px">

                <a href="/"><img src="/images/logo2017.png"/></a>

            </td>

            <td></td>

        </tr>

    </table>

<?

top_menu();

//usd_rate();

search();

compare();

backup_call();



top_buttons();

basket();

temp1_no_menu();

show_price_val();

add_to_basket();

popup_messages();

temp2();





echo '<div class="block_content">';

echo "<article>";

echo $prices_out;

echo "</article>";

echo "</div>";





temp3();

?>