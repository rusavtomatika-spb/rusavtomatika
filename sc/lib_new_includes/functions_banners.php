<?php

function show_banner_ad1() {
    $im = "/images/exhib.png";
    $out = "
<div class=banner>
<table><tr>
<td width=400><img src=$im></td><td width=720 valign=top>
<div class=banner_cont>
<div class=h1_ban> �������� ��� ������� 2014 </div>
<h2 class=h2_ban>
<br>
�� ��������� ������e � �������� \"��� ������� 2014\", ������� <br> ������� � <font color=red>11�� �� 14� ����� </font> � ������ � �����������
��������� \"����������\".<br><br>

���������� ���� �������� ��� ����� <b>�8E601</b>, �������� 8, ��� 2.<br><br>


�� ������ ����� ������������ ���������: ������ ��������� Weintek � Samkoon, ��������� ����������  IFC � Aplex.




</h2>
</div>
</td></tr>
</table>
</div>
";

    return $out;
}

function show_banner_ad() {
    $im = "/images/cloud_hmi.png";
    $out = "
<div class=banner>
<table><tr>
<td width=400><img src=$im></td><td width=720 valign=top>
<div class=banner_cont>
<div class=h1_ban>������� �� ��������� Weintek </div>
<h2 class=h2_ban>
<br>
��� \"�������������\", ����������� ������������ Weintek Labs. � ������, �������� �������, �����������
��������� Weintek. <br><br> �� �������� ����� ��������� ��� ���������� ��� \"�������������\", ��� � ������������� �������� Weintek Labs. <br><br>
� ���� �������� ����� ������������ ������� Weintek - ����� ����� Cloud HMI.<br><br>
������� ���������  <font color=red>13 ����� 2014</font> � ������, � ����������� ��������� \"����������\".<br><br>
<span class=button_podr onclick='window.location=\"/conf\"'> ��������� </span>



</h2>
</div>
</td></tr>
</table>
</div>
";

    return $out;
}

function show_banner_product($model) {
    global $mysqli_db;
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);
    //$im = get_big_pic($model); 
    $im = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/580/" . $r->model . "_1.webp";

    $bt = "<img src=/images/th_up.png>";
    if ($model == 'IFC-BOX4000') {
        $trh = "height=38";
    } elseif (($model == 'ARCHMI-710P') OR ( $model == 'ARCHMI-707P') OR ( preg_match('/Flexy/i', $model)) OR ( preg_match('/COSY141/i', $model))) {
        $trh = "height=38";
    } else {
        $trh = "height=30";
    };

    $ml = get_link_to_model($model);
// <span style='width: 200px; display: inline-block;'></span>
//<span valign=center>����: $r->retail_price USD</span>  <span class=button_podr style='float:right;' onclick='window.location=\"$ml\"'> ��������� </span>
    if (($r->brand == "IFC") AND ( ($r->series == 'i3') OR ( $r->series == 'RF'))) {

        if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
                or ( $r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
            $onst = "";
        else
            $onst = ", ���� �� ������";
        $out = "
<div class=banner>
<table><tr>
<td width=650 style='text-align:center;'><a href='$ml'><img style='margin-left:30px;margin-top:15px;max-height: 250px' loading='lazy' src='$im'></a></td><td width=720 valign=top>
<div class=banner_cont>
<div class=h1_ban>$r->diagonal\" ��������� ��������� <strong> $r->model </strong> </div>
<h2 class=h2_ban>

<table>
<tr $trh><td>$bt</td><td><div class=ban_list> ������������ ��������� ��������� � ��������� ��������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� $r->cpu_type " . ($r->cpu_speed / 1000) . " ��� </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� ����� � �������������, ��� � ������� ���� ��� �����������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������������� �� ������ (IP65)</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> �����: $r->serial, 2�Gb LAN, $r->usb_host, VGA, LPT</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> ����: $r->retail_price USD$onst  </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> ��������� </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end IFC brand

    if (($r->brand == "IFC") AND ( $r->series == 'BOX-PC')) {

        if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
                or ( $r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
            $onst = "";
        else
            $onst = ", ���� �� ������";
        if ((!empty($r->cpu_speed)) AND ( $r->cpu_speed != '0')) {
            $speed = $r->cpu_speed / 1000;
            $speed = ' ' . $seed . ' ���';
        } else {
            $speed = '';
        };
        if ((!empty($r->ram)) AND ( $r->ram != '0')) {
            $ram = $r->ram / 1000;
            $ram = $ram . ' �� ' . $r->ram_type . ' ';
        } else {
            $ram = '';
        };
        if ($r->model != 'IFC-BOX4000') {
            $fan = ' ���������������� ';

            $reson = '';
        } else {
            $fan = ' ';

            $reson = '. ����. ���������� ' . $r->resolution;
        };
        $out = "
<div class=banner>
<table><tr>
<td width=650 style='text-align:center;'><a href=$ml><img style='margin-left:30px;;margin-top:15px;max-height: 250px' src='$im' loading='lazy'></a></td><td width=720 valign=top>
<div class=banner_cont>
<div class=h1_ban>������������ ��������� <strong> $r->model </strong> </div>
<h2 class=h2_ban>

<table>
<tr $trh><td>$bt</td><td><div class=ban_list> ������" . $fan . "������������ ���������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� $r->cpu_type" . $speed . $reson . " </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� ����� � �������������, " . $ram . "��� � ������� ���� " . $r->hdd_size_gb . " " . $r->hdd_type . " ��� �����������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> �������� ���������: " . $r->os . "</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> �����: $r->serial, 2�Gb LAN, $r->usb_host, VGA, LPT</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> ����: $r->retail_price USD$onst  </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> ��������� </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    }

    if ($r->brand == "Weintek") {
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if (isset($r->sd_card) and $r->sd_card != "")
            $inter .= ", SD �����";
        if (isset($r->can_bus) and $r->can_bus != "" and $r->can_bus != "���")
            $inter .= ", CAN";
        if (isset($r->linear_out) and $r->linear_out != "")
            $inter .= ", �������� ����������";

        if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
                or ( $r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
            $onst = "";
        else
            $onst = ", ���� �� ������";

        if (( $r->retail_price == '0') or ( $r->retail_price == '')) {
            $bprice = ' �� �������';
        } else {
            $bprice = ' ' . $r->retail_price . ' USD';
        };
        $reson = '';
        if (($r->model == 'MT8090XE') OR ( $r->model == 'MT8092XE')) {
            $reson = ', ���������� ' . $r->resolution;
        };


        ob_start();?>
<div class="banner">
    <table>
        <tr>
            <td width="650" style='text-align:center;'>
                <a href="<?=$ml?>">
                    <img  style='margin-left:30px;;margin-top:15px;max-height: 250px' src='<?=$im?>' loading="lazy">
                </a>
            </td>
            <td width=720 valign=top>
                <div class=banner_cont>
                    <div class=h1_ban><?=$r->diagonal?>" ������ ��������� Weintek <strong> <?=$r->model?> </strong></div>
                    <h2 class=h2_ban>
                        <table>
                            <tr <?=$trh?>>
                                <td><?=$bt?></td>
                                <td><div class=ban_list> ������������ ������ � ��������� �������� <?=$reson?></div></td>
                            </tr>
                            <?if($r->matrix === "IPS"):?>
                            <tr <?=$trh?>>
                                <td><?=$bt?></td>
                                <td><div class=ban_list> ��� ������� IPS, ������� ���� ������</div></td>
                            </tr>
                            <?endif;?>
                            <tr <?=$trh?>>
                                <td><?=$bt?></td>
                                <td><div class=ban_list> ���������� �������� � ����������</div></td>
                            </tr>
                            <tr <?=$trh?>>
                                <td><?=$bt?></td>
                                <td><div class=ban_list> �����: <?=$inter?> </div></td>
                            </tr>
                            <tr <?=$trh?>>
                                <td><?=$bt?></td>
                                <td><div class=ban_list> ��������������� �� ������ (IP65)</div></td>
                            </tr>
                            <tr <?=$trh?>>
                                <td><?=$bt?></td>
                                <td>
                                    <div class=ban_list>
                                        <table>
                                            <tr>
                                                <td width=400> ����: <?=$bprice?><?=$onst?> </td>
                                                <td>
                                                    <span class=button_podr onclick='window.location="<?=$ml?>"'> ��������� </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </h2>
                </div>
            </td>
        </tr>
    </table>
</div>


        <?$out = ob_get_clean();

    } // end Weintek brand


    if ($r->brand == "APLEX") {
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if (isset($r->sd_card) and $r->sd_card != "")
            $inter .= ", SD �����";
        if ($r->can_bus != "" and $r->can_bus != "���")
            $inter .= ", CAN";
        if ($r->linear_out != "")
            $inter .= ", �������� ����������";

        if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
                or ( $r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
            $onst = "";
        else
            $onst = ", ���� �� ������";

        $im = "/images/aplex/$r->type/$r->model/580/$r->model" . "_2.webp";

        $reson = '';
        if ($r->model == 'ARCHMI-710P') {
            $im = "/images/aplex/$r->type/$r->model/580/$r->model" . "_1.webp";
            $reson = '. ���������� ' . $r->resolution;
        };
        $out = "
<div class=banner>
<table><tr>
<td width=650  style='text-align:center;'><a href=$ml><img style='margin-left:30px;margin-top:15px;max-height: 250px' src='$im' loading='lazy'></a></td><td width=720 valign=top>
<div class=banner_cont>
<div class=h1_ban>$r->diagonal\" ��������� ��������� Aplex  <strong> $r->model </strong> </div>
<h2 class=h2_ban>

<table>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� Atom N2600 ( 2 ���� ) 1,6 ���$reson</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ����� ����������� ������, ���������������� ����������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� ��������� ������� \"���������\", IP65 �� ������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> �����: $inter </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> �������� ��������� Windows 7, Windows XP, Windows CE6.0 </div></td></tr>";
        if ($r->retail_price > 0) {
            $out .= "<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> ����!: $r->retail_price USD$onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> ��������� </span> </td></tr>";
        } else {
            $out .= "<tr $trh><td> </td><td><div class=ban_list><table><tr><td width=400> $onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> ��������� </span> </td></tr>";
        }
        $out .= "</table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end Aplex brand


    if ($r->brand == "Samkoon") {
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if (isset($r->sd_card) && $r->sd_card != "")
            $inter .= ", SD �����";
        if ($r->can_bus != "" and $r->can_bus != "���")
            $inter .= ", CAN";


        if ($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
            $onst = "";
        else
            $onst = ", ���� �� ������";

//$im="/images/aplex/$r->model/$r->model"."_2.png";

        $out = "
<div class=banner>
<table><tr>
<td width=650 style='text-align:center;'><a href=$ml><img style='margin-left:30px;;margin-top:15px;max-height: 250px' src='$im' loading='lazy'></a></td><td width=720 valign=top>
<div class=banner_cont>
<div class=h1_ban>$r->diagonal\" ������ ��������� Samkoon  <strong> $r->model </strong> </div>
<h2 class=h2_ban>

<table>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� ��������� ������ ��������� </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ���������� �� SK Workshop</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> �����: $inter </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������������� �� ������ (IP65)</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> ����: $r->retail_price USD$onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> ��������� </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end Aplex brand

    if ($r->model == "mTV-100") {
        $im = "/images/weintek/machine-tv-interface/mTV-100/580/mTV-100_1.webp";
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if ($r->sdcard != "")
            $inter .= ", SD �����";
        if ($r->can_bus != "" and $r->can_bus != "���")
            $inter .= ", CAN";
        if ($r->linear_out != "")
            $inter .= ", �������� ����������";

        if ($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
            $onst = "";
        else
            $onst = ", ���� �� ������";

        $out = "
<div class=banner>
<table><tr>
<td width=650 style='text-align:center;'><a href=$ml><img style='margin-left:30px;;margin-top:15px;max-height: 250px' src='$im' loading='lazy'></a></td><td width=720 valign=top>
<div class=banner_cont>
<div class=h1_ban> Machine-TV ��������� Weintek <strong> $r->model </strong> </div>
<h2 class=h2_ban>

<table>
<tr $trh><td>$bt</td><td><div class=ban_list> ���������� ����������, ����� ������ � PLC �� ������� �����</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ����� HDMI ����������� 1280�720</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> �����: Ethernet, SD �����, USB, 3 COM �����</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ����� �������� ����-��������, ����������� �����������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� �� DIN �����</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> ����: $r->retail_price USD $onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> ��������� </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end mTV-100



    if ($r->brand == "eWON") {
        if (!preg_match("/COSY/i", $r->model)) {
            $tit = '������ ������������ ��������� VPN-������';
            $im = "/images/ewon/Extention/Flexy-with-modules.png";
            $ml = "/ewon/FLEXY.php";
            ob_start();?>
<tr <?=$trh?>><td><?=$bt?></td><td><div class=ban_list> ���������� / ������� ������������ �������� ����� �������� </div></td></tr>
<tr <?=$trh?>><td><?=$bt?></td><td><div class=ban_list> ������� ������: 4 x Ethernet � 4 ����� ��� ����-����������</div></td></tr>
<tr <?=$trh?>><td><?=$bt?></td><td><div class=ban_list> �����-����������: 2 x COM, Ethernet WAN, 3G + HSUPA � Wi-Fi</div></td></tr>
<tr <?=$trh?>><td><?=$bt?></td><td><div class=ban_list> ���������� ���������� � ���������� �������� ������ Talk2M</div></td></tr>
<tr <?=$trh?>><td><?=$bt?></td><td><div class=ban_list> �������� ��������� � ���������</div></td></tr>
            <? $pluses = ob_get_clean();
            
        } else {

            if ($r->model == 'COSY141') {
                $im = "/images/ewon/vpn-router/COSY141/580/COSY141_1.webp";
                $ml = "/ewon/COSY141.php";
                $ports = ' ���� RS232/RS485 ��� MPI/PROFIBUS �� �����';
            } else {
                $im = "/images/ewon/vpn-router/COSY131/1330/COSY131_7.webp";
                $ml = "/ewon/COSY131.php";
                $ports = ' USB, � ����� Wi-Fi/3G �� �����';
            };
            $tit = '������������ VPN-������';

            $pluses = "
<tr $trh><td>$bt</td><td><div class=ban_list> ��������� ����������� �������� �������� ������������� � ��������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> 4 x Ethernet ��� ����������� ������������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list>$ports</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> ���������� �������� ������ Talk2M �� �������������</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> �������� ��������� � ���������</div></td></tr>
";
        };
        if ($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
            $onst = "";
        else
            $onst = ", ���� �� ������";



ob_start();?>
<div class=banner>
    <table>
        <tr>
            <td width=650 style='text-align: center;'>
                <a href='<?=$ml?>' ><img  src="<?=$im?>" style='height:230px;margin-left:30px;margin-top:15px;margin-top:10px;max-height: 250px;' loading='lazy'></a>
            </td>
            <td width=720 valign=top>
                <div class=banner_cont>
                    <div class=h1_ban> <?=$tit?> <strong> <?=$r->model?> </strong> </div>
                    <h2 class=h2_ban>
                        <table>
                        <?=$pluses?>
                            <tr <?=$trh?>>
                                <td><?=$bt?></td>
                                <td>
                                    <div class=ban_list>
                                        <table>
                                            <tr>
                                            
                                                <?if($r->retail_price > 0):?>
                                                    <td width=400> ����: <?=$r->retail_price?> EUR<?=$onst?> </td>

                                                <?else:?>
                                                    <td width=400> ����: �� �������</td>
                                                <?endif;?>
                                                <td><span class=button_podr onclick='window.location="<?=$ml?>"'> ��������� </span> </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </h2>
                </div>
            </td>
        </tr>
    </table>
</div>

<?$out = ob_get_clean();

    };
    return $out;
}

function show_banner_product2($model) {
    global $DBWORK;
    if ($model == "Haiwell") {
        $probability["n-series-motion-control-plc"]["percent"] = 100;
        $probability["h-series-high-performance-plc"]["percent"] = 0;
        $probability["t-series-standard-plc"]["percent"] = 0;
        $probability["c-series-economic-plc"]["percent"] = 0;
        $probability["analog-plc-expansion"]["percent"] = 0;
        $probability["digital-plc-expansion"]["percent"] = 0;
        $probability["temperature-plc-expansion"]["percent"] = 0;
        $probability["communication-plc-expansion"]["percent"] = 0;
        $probability["programmable-power-module"]["percent"] = 0;
        $counter = 0;
        foreach ($probability as $key => $probability_item) {
            $counter += $probability_item["percent"];
        }
        $probability_x = 100 / $counter;
        $counter = 0;
        foreach ($probability as $key => $probability_item) {

            $percent = $probability[$key]["percent"] * $probability_x;
            $probability[$key]["from"] = $counter;
            $counter += $percent;
            $probability[$key]["to"] = $counter;
        }
        $rand = rand(0, 100) . "<br>";
        foreach ($probability as $key => $probability_item) {

            if ($rand >= $probability[$key]["from"] and $rand < $probability[$key]["to"]) {
                $section = $key;
                break;
            }
        }
        $element = $DBWORK->get_catalog_element_by_section_code_and_rand($section);
        if (is_array($element)) {
            ob_start();
            ?>
            <div class="banner">
                <table><tbody><tr>
                            <td width="360">
                                <? $detail_link = "/plc/haiwell/" . $element["section_code"] . "/" . $element["code"] . "/"; ?>
                                <a href="<?= $detail_link ?>">
                                    <?
                                    if ($element["picture_detail"] == "")
                                        $element["picture_detail"] = "/images/haiwell/models/" . $element["name"] . ".jpg";
                                    ?>
                                    <img src="<?= $element["picture_detail"] ?>" style="  max-height: 280px;  margin-left: 90px;" loading='lazy'></a></td>
                            <td width="720" valign="top">
                                <div class="banner_cont">
                                    <div class="h1_ban">
                                        <?
                                        switch ($element["section_code"]) {
                                            case "h-series-high-performance-plc":
                                            case "c-series-economic-plc":
                                            case "t-series-standard-plc":
                                            case "n-series-motion-control-plc":
                                                $name_extra = "��������������� ���������� ���������� Haiwell ";
                                                break;
                                            case "analog-plc-expansion":
                                                $name_extra = "���������� ������ ���������� ���  Haiwell ";
                                                break;
                                            case "temperature-plc-expansion":
                                                $name_extra = "������������� ������ ���������� ���  Haiwell ";
                                                break;
                                            case "digital-plc-expansion":
                                                $name_extra = "���������� ������ ���������� ���  Haiwell ";
                                                break;
                                            case "communication-plc-expansion":
                                                $name_extra = "���������������� ������ ���������� ���  Haiwell ";
                                                break;
                                            case "programmable-power-module":
                                                $name_extra = "��������������� ������ ���������� ���  Haiwell ";
                                                break;
                                            default:
                                                break;
                                        }
                                        echo $name_extra . $element["name"];
                                        ?></div>
                                    <?
                                    $properties = $DBWORK->get_list_catalog_element_fields_by_id(array("id" => $element["id"]));
                                    foreach ($properties as $key => $value) {

                                        $arr[$value["code"]]["id"] = $value["id"];

                                        if (isset($value["name_rus"]) and $value["name_rus"] != "") {
                                            $arr[$value["code"]]["name"] = $value["name_rus"];
                                        } else {
                                            $arr[$value["code"]]["name"] = $value["name"];
                                        }
                                        $arr[$value["code"]]["type"] = $value["type"];

                                        if (isset($value["value"]["value_rus"]) and $value["value"]["value_rus"] != "") {
                                            $arr[$value["code"]]["value"] = $value["value"]["value_rus"];
                                        } elseif (isset($value["value"]["value"])) {
                                            $arr[$value["code"]]["value"] = $value["value"]["value"];
                                        } else
                                            $arr[$value["code"]]["value"] = "";
                                    }
                                    $properties = $arr;
                                    ?>
                                    <div class="h2_ban">
                                        <?
                                        if (isset($properties["io-points"]["value"]) and $properties["io-points"]["value"] != "") {
                                            ?>
                                            <div class="catalog_element_default_property catalog_element_default_io-points">
                                                <span class="field_title tick"><?= $properties["io-points"]["name"] ?>: <?= $properties["io-points"]["value"] ?></span>
                                            </div>
                                            <?
                                        }
                                        if (isset($properties["program-capacity"]["value"]) and $properties["program-capacity"]["value"] != "") {
                                            ?>
                                            <div class="catalog_element_default_property catalog_element_default_io-points">
                                                <span class="field_title tick"><?= $properties["program-capacity"]["name"] ?>:
                                                    <?= $properties["program-capacity"]["value"] ?></span>
                                            </div>
                                            <?
                                        }
                                        if (isset($properties["execution-speed"]["value"]) and $properties["execution-speed"]["value"] != "") {
                                            ?>
                                            <div class="catalog_element_default_property catalog_element_default_io-points">
                                                <span class="field_title tick"><?= $properties["execution-speed"]["name"] ?>:
                                                    <?= $properties["execution-speed"]["value"] ?></span>
                                            </div>
                                            <?
                                        }
                                        if (isset($properties["com-port"]["value"]) and $properties["com-port"]["value"] != "") {
                                            ?>
                                            <div class="catalog_element_default_property catalog_element_default_io-points">
                                                <span class="field_title tick"><?= $properties["com-port"]["name"] ?>:
                                                    <?= $properties["com-port"]["value"] ?></span>
                                            </div>
                                            <?
                                        }
                                        if (isset($properties["protocol"]["value"]) and $properties["protocol"]["value"] != "") {
                                            ?>
                                            <div class="catalog_element_default_property catalog_element_default_io-points">
                                                <span class="field_title tick"><?= $properties["protocol"]["name"] ?>:
                                                    <?= $properties["protocol"]["value"] ?></span>
                                            </div>
                                            <?
                                        }
                                        ?>
                                        <div style="float: right;"><span style="margin-left: -36px;" class="button_podr" onclick="window.location = '<?= $detail_link ?>'"> ��������� </span>
                                        </div>
                                        
                                    </div>
                                </div>
                            </td></tr>
                    </tbody></table>
            </div>
            <?
            $out = ob_get_contents();
            ob_end_clean();
            return $out;
        }
    }
}

