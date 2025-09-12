<?
$lines = $lines2 = "";

$type_to_change = array(
    'hmi' => '������ ���������', 'cloud_hmi' => '�������� ���������', 'machine-tv-interface' => '��������� � HDMI',
    'open_hmi' => '������ ���������', 'panel_pc' => '��������� ���������', 'box-pc' => '������������ ���������',
    'monitor' => '�������',
    'monitors' => '�������',
    'module' => '������',
    'coupler' => '������',
    'vpn-router' => 'vpn-������',
    'Gateway' => '���� ������',
    'cloud_hmi' => '�������� ���������',
    'machine-tv-interface' => '�������� MACHINE-TV',
    'controllers' => '����������',
    'panel_pc_wce' => '��������� ���������� Windows CE'
);

if (!empty($_COOKIE["cookie_compare"])) {
    $cookies = explode('|', $_COOKIE["cookie_compare"]);
} else {
    $cookies = array();
};

function params($rowA) {
    $lines = $lines2 = "";
    $params = array();
    if ((!empty($rowA["touch_type"])) AND ( $rowA["touch_type"] != '0')) {
        if (preg_match('/resistive/i', $rowA["touch_type"])) {
            $params[] = '����������� ������';
        };

        if (preg_match('/capacitive/i', $rowA["touch_type"])) {
            $params[] = '��������� ������ (���������)';
        };
    };



    if ((!empty($rowA["resolution"])) AND ( $rowA["resolution"] != '0')) {

        $params[] = '����������: ' . $rowA["resolution"];
    };
    /*
      if ((!empty($rowA[touch])) AND ($rowA[touch] != '0')) {$params[] = $rowA[touch];};
     */
    if ((!empty($rowA["colors"])) AND ( $rowA["colors"] != '0')) {
        $params[] = '���������: ' . $rowA["colors"];
    };

    if ((!empty($rowA["backlight"])) AND ( $rowA["backlight"] != '0')) {
        $params[] = '���������: ' . $rowA["backlight"];
    };


    if ((!empty($rowA["cpu_type"])) AND ( $rowA["cpu_type"] != '0')) {
        if ((!empty($rowA["cpu_speed"])) AND ( $rowA["cpu_speed"] != '0')) {
            $params[] = '���������: ' . $rowA["cpu_type"] . ' ' . $rowA["cpu_speed"] . ' ���';
        } else {
            $params[] = '���������: ' . $rowA["cpu_type"];
        };
    };
    if ((!empty($rowA["hdd_type"])) AND ( $rowA["hdd_type"] != '0')) {
        $par = '������� ����: ' . $rowA["hdd_type"];
        if ((!empty($rowA["hdd_size_gb"])) AND ( $rowA["hdd_size_gb"] != '0')) {

            $par .= ' ' . $rowA["hdd_size_gb"] . '��';
        };
        $params[] = $par;
    };
//if ((!empty($rowA[chipset])) AND ($rowA[chipset] != '0')) {$params[] = '������: '.$rowA[chipset];};

    if ((!empty($rowA["ram_type"])) AND ( $rowA["ram_type"] != '0')) {
        $par = $rowA["ram_type"];

        if ((!empty($rowA["ram"])) AND ( $rowA["ram"] != '0')) {
            $par .= ' ' . ceil($rowA["ram"] / 1000) . ' ��';
        };


        if ((!empty($rowA["ram_max"])) AND ( $rowA["ram_max"] != '0')) {
            $par .= ' (max � ' . ceil($rowA["ram_max"] / 1000) . ' ��)';
        };
        $params[] = '����������� ������: ' . $par;
    };


    if ((!empty($rowA["flash"])) AND ( $rowA["flash"] != '0')) {
        $params[] = 'Flash-������: ' . $rowA["flash"] . ' ��';
    };
    if ((!empty($rowA["serial_full"])) AND ( $rowA["serial_full"] != '0')) {
        $params[] = 'COM-�����: ' . $rowA["serial_full"];
    };
    if ((!empty($rowA["usb_host"])) AND ( $rowA["usb_host"] != '0')) {
        $params[] = $rowA["usb_host"];
    };
    if ((!empty($rowA["ethernet"])) AND ( $rowA["ethernet"] != '0')) {
        if ($rowA["ethernet"] != '����') {
            $params[] = 'Ethernet: ' . $rowA["ethernet"];
        } else {
            $params[] = 'Ethernet';
        };
    };
    $par = '';
    if ((!empty($rowA["vga_port"])) AND ( $rowA["vga_port"] != '0')) {
        $par .= $rowA["vga_port"];
    };
    if ((!empty($rowA["dvi_port"])) AND ( $rowA["dvi_port"] != '0')) {
        $par .= $rowA["dvi_port"];
    };

    if ((!empty($rowA["video_input"])) AND ( $rowA["video_input"] != '0')) {
        $params[] .= '�����-�����: ' . $rowA["video_input"];
    };

    if ((!empty($rowA["usb_cam"])) AND ( $rowA["usb_cam"] != '0')) {
        $params[] = '����������� USB-������';
    };

    if (!empty($par)) {
        $params[] = '�����-������: ' . $par;
    };
    if ((!empty($rowA["sdcard"])) AND ( $rowA["sdcard"] != '0')) {
        if ($rowA["sdcard"] == '����') {
            $params[] = 'SD-����';
        } else {
            $params[] = '���� ���� ������: ' . $rowA["sdcard"];
        };
    };

    if ((!empty($rowA["sim"])) AND ( $rowA["sim"] != '0')) {
        if ($rowA["sim"] == 'outside') {
            $params[] = '3G: c��� sim-����� � ������� ������� �������';
        } elseif ($rowA["sim"] == 'inside') {
            $params[] = '3G: c��� sim-����� ������ �������';
        } else {
            $params[] = '3G: ' . $rowA["sim"];
        };
    };
    $par = '';
    if ((!empty($rowA["pci"])) AND ( $rowA["pci"] != '0')) {
        $par .= $rowA["pci"];
    };

    if ((!empty($rowA["mpci"])) AND ( $rowA["mpci"] != '0')) {
        $par .= $rowA["mpci"];
    };

    if (!empty($par)) {
        $params[] = '����: ' . $par;
    };

//if ((!empty($rowA[audio])) AND ($rowA[audio] != '0')) {$params[] = '�����: '.$rowA[audio];};
    if ((!empty($rowA["os"])) AND ( $rowA["os"] != '0')) {


        $params[] = '�������� ��������� ��: ' . $rowA["os"];
    };


    if ((!empty($rowA["software"])) AND ( $rowA["software"] != '0')) {
        if ($rowA["brand"] == 'Weintek') {
            $params[] = '���������� �� �� Weintek: ' . $rowA["software"];
        } else if ($rowA["brand"] == 'Samkoon') {
            $params[] = '���������� �� �� Samkoon: ' . $rowA["software"];
        } else {
            $params[] = $rowA["software"];
        };
    };
//if ((!empty($rowA[dimentions])) AND ($rowA[dimentions] != '0')) {$params[] = '��������: '.$rowA[dimentions];};
    if ((!empty($rowA["cutout"])) AND ( preg_match('/[0-9]/', $rowA["cutout"]))) {
        $params[] = '���������� ���������: ' . $rowA["cutout"];
    };

    /*
      $par0 = array();
      if ((!empty($rowA[vesa75])) AND ($rowA[vesa75] != '0')) {$par0[] = 'vesa75';};
      if ((!empty($rowA[vesa100])) AND ($rowA[vesa100] != '0')) {$par0[] = 'vesa100';};
      if ((!empty($rowA[wall])) AND ($rowA[wall] != '����')) {$par0[] = $rowA[wall];};
      if (!empty($par0)) {
      $params[] = '���������: '.implode(', ',$par0);
      };
     */
    return '<li class="param">' . implode("</li><li class='param'>", $params) . '</li>';
}

for ($iA = 0; $iA < $jA; $iA++) {
    $rowA = mysqli_fetch_assoc($query_resultA);
    $source = $rowA["model"];
    if ((preg_match('/ARCHMI/i', $source)) AND ( !preg_match('/P$/i', $source))) {
        $source = $source . 'P';
    };

    if ($GLOBALS["net"] == 0) {
        if (file_exists($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["brand"]) . '/' . $source . '/' . $source . '_1.png')) {
            $ipath = '/images/' . strtolower($rowA["brand"]) . '/' . $source . '/' . $source . '_1.png';
        } elseif (file_exists($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["type"]) . '/' . $source . '/' . $source . '_1.png')) {
            $ipath = '/images/' . strtolower($rowA["type"]) . '/' . $source . '/' . $source . '_1.png';
        }elseif(file_exists($GLOBALS["path_to_real_files"]
            . '/images/' . strtolower($rowA["brand"]) .'/'.$rowA["type"]. '/'
            . $rowA["model"] . '/md/' . $rowA["model"] . '_1.png'))
        {$ipath = '/images/' . strtolower($rowA["brand"]) .'/'.$rowA["type"]. '/'
            . $rowA["model"] . '/md/' . $rowA["model"] . '_1.png';}
    } else {
        $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["brand"]) . '/' . $source . '/' . $source . '_1.png');
        if (isset($re[0]) && $re[0] > 0) {
            $ipath = '/images/' . strtolower($rowA["brand"]) . '/' . $source . '/' . $source . '_1.png';
        } else {
            $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["type"]) . '/' . $source . '/' . $source . '_1.png');
            if (isset($re[0]) && $re[0] > 0) {
                $ipath = '/images/' . strtolower($rowA["type"]) . '/' . $source . '/' . $source . '_1.png';
            }
            else{$ipath = $GLOBALS["path_to_real_files"] .'/images/' . strtolower($rowA["brand"]) .'/'.$rowA["type"]. '/'
                . $rowA["model"] . '/md/' . $rowA["model"] . '_1.png';}
            ;
        };
    };

    $img_path_model = str_replace('/', '_', $rowA["model"]);
    $ipath = '/images/' . mb_strtolower($rowA["brand"]) . '/' . mb_strtolower($rowA["type"]) . '/' . $img_path_model . '/130/' . $img_path_model . '_1.webp';


    if ($rowA['brand'] == 'APLEX' and $rowA['type'] == 'monitors' and $rowA['series'] == 'ADP') {
        $link = '/monitors/aplex/ADP/'.$rowA['model'].'/';
    }elseif ($rowA['brand'] == 'APLEX' and $rowA['type'] == 'box-pc' and $rowA['series'] == 'ACS') {
        $link = '/vstraivaemye-kompyutery/aplex/ACS/'.$rowA['model'].'/';
    }elseif ($rowA['brand'] == 'APLEX') {
        $parent = 'panelnie-computery/aplex/';
        $link = '/panelnie-computery/aplex/'.$rowA['model'].'.php';
    } elseif ($rowA['brand'] == 'IFC') {
        if ($rowA['type'] == 'panel_pc') {
            $parent = 'panelnie-computery/ifc/';
            $link = '/panelnie-computery/ifc/'.$rowA['model'].'.php';
        } elseif ($rowA['type'] == 'monitor') {
            $parent = 'monitors/';
            $link = '/monitors/'.$rowA['model'].'.php';
        } elseif ($rowA['type'] == 'box-pc') {
            $parent = 'box-pc/';
            $link = '/promyshlennye-kompyutery-box-pc/'.$rowA['model'].'.php';
        };
    }elseif($rowA['type'] == 'coupler' and $rowA['brand'] == 'Weintek'){
        $parent = 'plc/weintek/';
        $link = '/plc/weintek/'.$rowA['model'].'.php';
    }elseif($rowA['type'] == 'module' and $rowA['series'] == 'wifi'){
        $parent = 'accessories/wifi/';
        $link = '/accessories/wifi/'.$rowA['model'].'/';
    }elseif($rowA['type'] == 'module' and $rowA['series'] == 'iR'){
        $parent = 'plc/weintek/';
        $link = '/plc/weintek/'.$rowA['model'].'.php';
    }elseif($rowA['type'] == 'accessories' and $rowA['series'] == 'license'){
        $link = '/accessories/license/'.$rowA['model'].'/';
    }
    else {
        $parent = strtolower($rowA['brand']);
        if ($parent != '') {
            $parent = $parent . '/';
            $link = '/'.$parent.$rowA['model'].'.php';
        };
    };

    $row1 = $rowA;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/inc/new.php")) {
        include($_SERVER['DOCUMENT_ROOT'] . "/inc/new.php");
    } else {
        $class = 'no';
    };
    $sstock = array();
    if (($rowA["onstock_spb"] > '0')) {
        $sstock[] = "<span title='�����-���������' style='cursor:default;'>���</span>";
    };
    if (($rowA["onstock_msk"] > '0')) {
        $sstock[] = "<span title='������' style='cursor:default;'>���</span>";
    };

    /*
      if (($rowA[onstock_kiv] > '0')) {$sstock[] = "<span title='����' style='cursor:default;'>����</span>";};
     */
    if (!empty($sstock)) {
        $stts = '<span style="color: rgb(0, 202, 0);">&#10004; �� ������</span>';
    } else {
        $stts = '��� �����';
    };

    if (in_array($rowA["model"], $cookies)) {
        $compare1 = '<div  class="t-r" id="' . $rowA["model"] . 'a" style="display:none;"  onclick="show_compare1(this,\'' . $rowA["model"] . '\')"><p><span class="galochka"></span><span style="float:left;">� ���������</span></p></div>
<div class="to-r" id="' . $rowA["model"] . 'd" onclick="del_from(\'' . $rowA["model"] . '\')" ><p><span style="color: rgb(58, 121, 208);"><span class="galochka"><span class="gal">&#10004;</span></span> � ���������</span><br /><span class="del_from" title="������� �� ���������">&#10008; �������</span></p></div>
';
    } else {
        $compare1 = '<div  class="t-r"  id="' . $rowA["model"] . 'a" onclick="show_compare1(this,\'' . $rowA["model"] . '\')"><p><span class="galochka"></span><span style="float:left;">� ���������</span></p></div>
<div class="to-r" style="display:none;" id="' . $rowA["model"] . 'd" onclick="del_from(\'' . $rowA["model"] . '\')" ><p><span style="color: rgb(58, 121, 208);"><span class="galochka"><span class="gal">&#10004;</span></span> � ���������</span><br /><span class="del_from" title="������� �� ���������">&#10008; �������</span></p></div>
';
    };
    $im = '<div class="item-image"><a data-type="'.$rowA["type"].'" data-series="'.$rowA["series"].'" href="' . $link . '"><img src="' . $ipath . '" loading="lazy"></a></div>';

    if ($rowA["diagonal"] == '0') {
        $lines2 .= '<div class="line"><div class="top-line"><div class="left-line"><a data-product-type="'.$rowA["type"].'" data-series="'.$rowA["series"].'" href="' . $link . '"><img src="' . $ipath . '" loading="lazy"></a><span><a class="h2_type" href="' . $link . '">' .
                $type_to_change[$rowA["type"]] . '</a></span></div><div class="center-line"><h2 class="' . $class . '" ><a href="' . $link . '"><div style="float:right;" class="brand">' . $rowA["brand"] . '</div><div style="float:left;">' . $rowA["model"] .
                ' <span style="font-weight:normal;font-size: 14px;">(��� �������)</span></div></a></h2><div class="stext">
	<ul>' . params($rowA) . '</ul></div></div><div class="right-line"><div class="stocks">' . $stts .
                '</div>';
        if ($rowA["retail_price"] > 0 && $rowA["retail_price_hide"] != 1) {
            ob_start();?>
            <div class="line-price"><p>

            <?if($rowA["currency"] == "RUR"):?>
                    <span style="font-size: 15px;font-weight: bold;font-family: Tahoma, Geneva, Verdana, sans-serif;"><?=$rowA["retail_price"]?></span> ���
                <?else:?>
                    <span class="prpr" title="������� ��� ��������� � �����">
                        <?=$rowA["retail_price"]?>
                    </span><span class="val_name" title="������� ��� ��������� � �����"> USD </span>
                <?endif;?>

            <? $lines2 .= ob_get_clean();
           
        }
        $lines2 .= '</div></div><div class="bottom-line"><div>' . $compare1 . '</div></div>
<br /></div>';
    } else {
        $lines .= '<div class="line"><div class="top-line"><div class="left-line"><a data-product-type="'.$rowA["type"].'" data-series="'.$rowA["series"].'" href="' . $link . '"><img src="' .
                $ipath .
                '" loading="lazy"></a><span><a class="h2_type" href="' . $link . '">' .
                $type_to_change[$rowA["type"]] .
                '</a></span></div><div class="center-line"><h2 class="' .
                $class . '" ><a href="' . $link . '"><div style="float:right;" class="brand">' .
                $rowA["brand"] .
                '</div><div style="float:left;">' .
                $rowA["model"] . ' ' .
                $rowA["diagonal"] .
                '&#8243;</div></a></h2><div class="stext"><ul>' .
                params($rowA) . '</ul></div></div><div class="right-line"><div class="stocks">' . $stts .
                '</div>';
        if ($rowA["retail_price"] > 0 && $rowA["retail_price_hide"] != 1) {
            ob_start();?>

            <div class="line-price"><p>
                <?if($rowA["currency"] == "RUR"):?>
                    <span style="font-size: 15px;font-weight: bold;font-family: Tahoma, Geneva, Verdana, sans-serif;"><?=$rowA["retail_price"]?></span> ���
                <?else:?>
                    <span class="prpr" title="������� ��� ��������� � �����">
                        <?=$rowA["retail_price"]?>
                    </span><span class="val_name" title="������� ��� ��������� � �����"> USD </span>
                <?endif;?>
            
        
            </p></div>

            <? $lines .= ob_get_clean();
           
        }
        $lines .= '</div></div><div class="bottom-line"><div>' .
                $compare1 . '</div></div><br /></div>';
    };
};

$lines = $lines . $lines2;
?>