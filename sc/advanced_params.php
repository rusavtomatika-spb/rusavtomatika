<?

//    data: "types="+b+"&min_price="+min-price+"&max_price="+max-price+"&min_diagonal="+min-diagonal+"&max_diagonal="+max-diagonal+"&resolution="+re+"&usb="+usb+"&usb_number="+usb-number+"&com="+com+"&com_number="+com-number+"&ethernet="+ethernet+"&ethernet_number="+ethernet-number+"&sd="+sd+"&audio="+audio+"&mic="+mic+"&pc2="+pc2+"&vga="+vga+"&dvi="+dvi+"&ebp="+ebp+"&eb8="+eb8+"&w7="+w7+"&wxp="+wxp+"&wce="+wce+"&hdd="+hdd+"&hdd_size="+hdd-size+"&ssd="+ssd+"&ssd_size="+ssd-size+"&ddr3="+ddr3+"&ddr3_size="+ddr3-size+"&flash="+flash+"&flash_size="+flash-size+"&cores="+core+"&min_width="+min-width+"&max_width="+max-width+"&min_height="+min-height+"&max_height="+max-height+"&min_thickness="+min-thickness+"&max_thickness="+max-thickness+"&full="+full+"&ua="+au+"&cool="+cool+"&vase75="+vesa75+"&vesa100="+vesa100+"&din="+din+"&case1="+case1+"&case2="+case2+"&ip65="+ip65,


if (isset($new_arr) and is_array($new_arr)) {
    if (isset($new_arr['page'])) {
        $page = strip_tags($new_arr['page']);
    }
    if (isset($new_arr['cores'])) {
        $cores = strip_tags($new_arr['cores']);
    } else {
        $cores = "";
    }
    if (isset($new_arr['resolution'])) {
        $resolution = strip_tags($new_arr['resolution']);
    } else {
        $resolution = "";
    }
    if (isset($new_arr['brand'])) {
        $brand = strip_tags($new_arr['brand']);
    } else {
        $brand = "";
    }
    if (isset($new_arr['types'])) {
        $types = strip_tags($new_arr['types']);
    } else {
        $types = "";
    }
    if (isset($new_arr['type_first'])) {
        $type_first = strip_tags($new_arr['type_first']);
    } else {
        $type_first = "";
    }
    if (isset($new_arr['full'])) {
        $full = strip_tags($new_arr['full']);
    } else {
        $full = "";
    }
    if (isset($new_arr['diagonals'])) {
        $diagonals = strip_tags($new_arr['diagonals']);
    } else {
        $diagonals = "";
    }
    if (isset($new_arr['diagonal'])) {
        $diagonal = strip_tags($new_arr['diagonal']);
    } else {
        $diagonal = "";
    }
    if (isset($new_arr['usb_number'])) {
        $usb_number = strip_tags($new_arr['usb_number']);
    } else {
        $usb_number = "";
    }
    if (isset($new_arr['com_number'])) {
        $com_number = strip_tags($new_arr['com_number']);
    } else {
        $com_number = "";
    }
    if (isset($new_arr['com_485'])) {
        $com_485 = strip_tags($new_arr['com_485']);
    } else {
        $com_485 = "";
    }
    if (isset($new_arr['ethernet_number'])) {
        $ethernet_number = strip_tags($new_arr['ethernet_number']);
    } else {
        $ethernet_number = "";
    }
    if (isset($new_arr['ddr3_size'])) {
        $ddr3_size = strip_tags($new_arr['ddr3_size']);
    } else {
        $ddr3_size = "";
    }
    if (isset($new_arr['min_price'])) {
        $min_price = strip_tags($new_arr['min_price']);
    } else {
        $min_price = "";
    }
    if (isset($new_arr['max_price'])) {
        $max_price = strip_tags($new_arr['max_price']);
    } else {
        $max_price = "";
    }
//    if (isset($new_arr['']  )){   }else{   = "";}


//форма с главной


//Количество


//$hdd_size = strip_tags($new_arr['hdd_size']);
//$ssd_size = strip_tags($new_arr['ssd_size']);

//$flash_size = strip_tags($new_arr['flash_size']);
// "Слайдеры"


    if (isset($new_arr['min_width']) and $new_arr['min_width'] != '') {
        $min_width = strip_tags($new_arr['min_width']) + 0;
    };
    if (isset($new_arr['max_width']) and $new_arr['max_width'] != '') {
        $max_width = strip_tags($new_arr['max_width']) + 0;
    };
    if (isset($new_arr['min_height']) and $new_arr['min_height'] != '') {
        $min_height = strip_tags($new_arr['min_height']) + 0;
    };
    if (isset($new_arr['max_height']) and $new_arr['max_height'] != '') {
        $max_height = strip_tags($new_arr['max_height']) + 0;
    };
    if (isset($new_arr['min_thickness']) and $new_arr['min_thickness'] != '') {
        $min_thickness = strip_tags($new_arr['min_thickness']) + 0;
    };
    if (isset($new_arr['max_thickness']) and $new_arr['max_thickness'] != '') {
        $max_thickness = strip_tags($new_arr['max_thickness']) + 0;
    };
    if (isset($new_arr['min_diagonal'])) {
        $min_diagonal = strip_tags($new_arr['min_diagonal']);
    } else {
        $min_diagonal = "";
    }
    if (isset($new_arr['max_diagonal'])) {
        $max_diagonal = strip_tags($new_arr['max_diagonal']);
    } else {
        $max_diagonal = "";
    }


// 0/1 - нет/да

    if (isset($new_arr['usb'])) {
        $usb = strip_tags($new_arr['usb']);
    } else {
        $usb = "";
    }
    if (isset($new_arr['com'])) {
        $com = strip_tags($new_arr['com']);
    } else {
        $com = "";
    }
    if (isset($new_arr['ethernet'])) {
        $ethernet = strip_tags($new_arr['ethernet']);
    } else {
        $ethernet = "";
    }
    if (isset($new_arr['sd'])) {
        $sd = strip_tags($new_arr['sd']);
    } else {
        $sd = "";
    }
    if (isset($new_arr['sim'])) {
        $sim = strip_tags($new_arr['sim']);
    } else {
        $sim = "";
    }
    if (isset($new_arr['audio'])) {
        $audio = strip_tags($new_arr['audio']);
    } else {
        $audio = "";
    }
    if (isset($new_arr['hdmi_audio'])) {
        $hdmi_audio = strip_tags($new_arr['hdmi_audio']);
    } else {
        $hdmi_audio = "";
    }
    if (isset($new_arr['speakers'])) {
        $speakers = strip_tags($new_arr['speakers']);
    } else {
        $speakers = "";
    }


    if (isset($new_arr['linear_out'])) $linear_out = strip_tags($new_arr['linear_out']); else $linear_out = '';
    if (isset($new_arr['mic_in'])) $mic_in = strip_tags($new_arr['mic_in']); else $mic_in = '';
    if (isset($new_arr['pc2'])) $pc2 = strip_tags($new_arr['pc2']); else $pc2 = '';
    if (isset($new_arr['vga'])) $vga = strip_tags($new_arr['vga']); else $vga = '';
    if (isset($new_arr['dvi'])) $dvi = strip_tags($new_arr['dvi']); else $dvi = '';
    if (isset($new_arr['ntsc'])) $ntsc = strip_tags($new_arr['ntsc']); else $ntsc = '';
    if (isset($new_arr['usbcam'])) $usbcam = strip_tags($new_arr['usbcam']); else $usbcam = '';
    if (isset($new_arr['ebp'])) $ebp = strip_tags($new_arr['ebp']); else $ebp = '';
    if (isset($new_arr['eb8'])) $eb8 = strip_tags($new_arr['eb8']); else $eb8 = '';
    if (isset($new_arr['skw'])) $skw = strip_tags($new_arr['skw']); else $skw = '';
    if (isset($new_arr['w7'])) $w7 = strip_tags($new_arr['w7']); else $w7 = '';
    if (isset($new_arr['w8'])) $w8 = strip_tags($new_arr['w8']); else $w8 = '';
    if (isset($new_arr['wxp'])) $wxp = strip_tags($new_arr['wxp']); else $wxp = '';
    if (isset($new_arr['wce'])) $wce = strip_tags($new_arr['wce']); else $wce = '';
    if (isset($new_arr['hdd'])) $hdd = strip_tags($new_arr['hdd']); else $hdd = '';
//$ssd = strip_tags($new_arr['ssd']);
    if (isset($new_arr['ddr3'])) $ddr3 = strip_tags($new_arr['ddr3']); else $ddr3 = '';
//$flash = strip_tags($new_arr['flash']);
    if (isset($new_arr['cool'])) $cool = strip_tags($new_arr['cool']); else $cool = '';
    if (isset($new_arr['temp_min_minus_10'])) $temp_min_minus_10 = strip_tags($new_arr['temp_min_minus_10']); else $temp_min_minus_10 = '';
    if (isset($new_arr['temp_min_minus_20'])) $temp_min_minus_20 = strip_tags($new_arr['temp_min_minus_20']); else $temp_min_minus_20 = '';
    if (isset($new_arr['temp_min_minus_40'])) $temp_min_minus_40 = strip_tags($new_arr['temp_min_minus_40']); else $temp_min_minus_40 = '';
    if (isset($new_arr['vesa75'])) $vesa75 = strip_tags($new_arr['vesa75']); else $vesa75 = '';
    if (isset($new_arr['vesa100'])) $vesa100 = strip_tags($new_arr['vesa100']); else $vesa100 = '';
    if (isset($new_arr['panel_mount'])) $panel_mount = strip_tags($new_arr['panel_mount']); else $panel_mount = '';
    if (isset($new_arr['din'])) $din = strip_tags($new_arr['din']); else $din = '';
    if (isset($new_arr['case1'])) $case1 = strip_tags($new_arr['case1']); else $case1 = '';
    if (isset($new_arr['case2'])) $case2 = strip_tags($new_arr['case2']); else $case2 = '';
//$ip65 = strip_tags($new_arr['ip65']);
//$spb = strip_tags($new_arr['spb']);
//$msk = strip_tags($new_arr['msk']);
//$kiv = strip_tags($new_arr['kiv']);

    if (isset($new_arr['slock'])) $slock = strip_tags($new_arr['slock']); else $slock = '';
    if (isset($new_arr['resistive'])) $resistive = strip_tags($new_arr['resistive']); else $resistive = '';
    if (isset($new_arr['capacitive'])) $capacitive = strip_tags($new_arr['capacitive']); else $capacitive = '';
    if (isset($new_arr['pci'])) $pci = strip_tags($new_arr['pci']); else $pci = '';
    if (isset($new_arr['mpci'])) $mpci = strip_tags($new_arr['mpci']); else $mpci = '';
}
$where = array();
$ty = array();
$to_h = array();

if ((!empty($page)) and (is_numeric($page)) and ($page != '0') and ($page != '1')) {
    $to_h[] = 'page=' . $page;
};

if ((is_numeric($min_diagonal)) and ($min_diagonal != '0') and ($min_diagonal != '-1')) {
//if (!preg_match('/2/',$types)) {

    $min_di = $min_diagonal - 1;
    $where[] = "`diagonal` > '" . $min_di . "'";
    $to_h[] = 'min_diagonal=' . $min_diagonal;
//};
};
if ((is_numeric($max_diagonal)) and ($max_diagonal != '22') and ($max_diagonal != '-1')) {
//if (!preg_match('/2/',$types)) {
    $max_di = $max_diagonal + 1;
    $where[] = "`diagonal` <= '" . $max_di . "'";
    $to_h[] = 'max_diagonal=' . $max_diagonal;
//};
};
//var_dump($where);


if (($diagonals == '1') and (empty($max_diagonal)) and (empty($min_diagonal))) {
    $where[] = "`diagonal` < '1'";
    $to_h[] = 'diagonals=' . $diagonals;
};
if (!empty($diagonal)) {
    $to_h[] = 'diagonal=' . $diagonal;
};


if ($resolution != '') {
//if (!preg_match('/2/',$types)) {

    $resol = array();
    $resolut = explode(',', stripslashes($resolution));
    while (list($key, $val) = each($resolut)) {

        $resol[] = "`resolution` LIKE '%" . $val . "%'";
    }
    if (!empty($resol)) {
        $where[] = "((" . implode(") OR (", $resol) . "))";
    };


//$resolution = stripslashes($resolution);
//$where[] = "`resolution` IN (".$resolution.")";
    $to_h[] = 'resolution=' . $resolution;
//};
};
if ($brand != '') {

    $brands = explode(',', $brand);
    for ($i = 0; $i < count($brands); $i++) {
        $brand = $brands[$i];
        $vowels = array("`", '"', "(", ")", "{", "}", "'");
        $brand = str_replace($vowels, "", $brand);
        $brands[$i] = "'" . $brand . "'";
    }
    $brand = implode(',', $brands);
//$brand = addslashes($brand);
    $where[] = "`brand` IN (" . $brand . ")";
    $to_h[] = 'brand=' . $brand;
};
// Добавить пагинацию

if (!preg_match('/0123456/', $types)) {
    if (preg_match('/0/', $types)) {
        $ty[] = 'hmi';
        // $ty[] = 'cloud_hmi';
        // $ty[] = 'machine-tv-interface';
        // $ty[] = 'open_hmi';
    };
    if (preg_match('/1/', $types)) {
        $ty[] = 'panel_pc';
    };
    if (preg_match('/2/', $types)) {
        $ty[] = 'box-pc';
    };
    if (preg_match('/3/', $types)) {
        $ty[] = 'monitor';
    };
    if (preg_match('/4/', $types)) {
        $ty[] = 'cloud_hmi';
    };
    if (preg_match('/5/', $types)) {
        $ty[] = 'Gateway';
    };
    if (preg_match('/6/', $types)) {
        $ty[] = 'machine-tv-interface';
    };


    if (!empty($ty)) {
        $where[] = "`type` IN ('" . implode("', '", $ty) . "')";
        $to_h[] = 'types=' . $types;
    };
};
if (empty($full)) {
    $full = 0;
};

if ((is_numeric($min_price)) and ($min_price != '0') and ($min_price != '-1')) {
    $where[] = "`retail_price` > '" . $min_price . "'";
    $to_h[] = 'min_price=' . $min_price;
};
if ((is_numeric($max_price)) and ($max_price != '2500') and ($max_price != '-1')) {
    $where[] = "`retail_price` < '" . $max_price . "'";
    $to_h[] = 'max_price=' . $max_price;
};

if (($usb == '1')) {
    $where[] = "`usb_host` <> ''";
    $to_h[] = 'usb=' . $usb;
};
if ((is_numeric($usb_number)) and ($usb_number != '0') and ($usb_number != '1') and ($usb_number != '-1')) {
    $usb_numbe = $usb_number - 1;
    $where[] = "`usb_hosts` > '" . $usb_numbe . "'";
    $to_h[] = 'usb_number=' . $usb_number;
};


if ((is_numeric($com_number)) and ($com_number != '0') and ($com_number != '1') and ($com_number != '-1')) {
    $com_numbe = $com_number - 1;
    $where[] = "`serials` > '" . $com_numbe . "'";
    $to_h[] = 'com_number=' . $com_number;
} else
    if (($com == '1')) {
        $where[] = "`serials` > '0'";
        $to_h[] = 'com=' . $com;
    };

if ((is_numeric($com_485)) and ($com_485 != '0') and ($com_485 != '1') and ($com_485 != '-1')) {
    $com_48 = $com_485 - 1;
    $where[] = "`serials_485` > '" . $com_48 . "'";
    $to_h[] = 'com_485=' . $com_485;
};


if ((is_numeric($ethernet_number)) and ($ethernet_number != '0') and ($ethernet_number != '1')) {
    $ethernet_numbe = $ethernet_number - 1;
    $where[] = "`ethernets` > '" . $ethernet_numbe . "'";
    $to_h[] = 'ethernet_number=' . $ethernet_number;
} elseif ($ethernet == '1') {
    $where[] = "`ethernet` <> ''";
    $to_h[] = 'ethernet=' . $ethernet;
};


if (($sd == '1')) {
    $where[] = "`sdcard` <> ''";
    $to_h[] = 'sd=' . $sd;
};
if (($sim == '1')) {
    $where[] = "`sim` <> ''";
    $to_h[] = 'sim=' . $sim;
};
if (($audio == '1')) {
    $where[] = "`audio` <> ''";
    $to_h[] = 'audio=' . $audio;
};
if (($hdmi_audio == '1')) {
    $where[] = "`hdmi_audio` <> ''";
    $to_h[] = 'hdmi_audio=' . $hdmi_audio;
};
if (($speakers == '1')) {
    $where[] = "`speakers` <> ''";
    $to_h[] = 'speakers=' . $speakers;
};

if (($linear_out == '1')) {
    $where[] = "`linear_out` <> ''";
    $to_h[] = 'linear_out=' . $linear_out;
};

if (($mic_in == '1')) {
    $where[] = "`mic_in` <> ''";
    $to_h[] = 'mic_in=' . $mic_in;
};
if (($pc2 == '1')) {
    $where[] = "`ps2_klava` <> ''";
    $to_h[] = 'pc2=' . $pc2;
};
if (($vga == '1')) {
    $where[] = "`vga_port` <> ''";
    $to_h[] = 'vga=' . $vga;
};
if (($dvi == '1')) {
    $where[] = "`dvi_port` <> ''";
    $to_h[] = 'dvi=' . $dvi;
};
if (($ntsc == '1')) {
    $where[] = "`video_input` LIKE '%NTSC%'";
    $to_h[] = 'ntsc=' . $ntsc;
};
if (($usbcam == '1')) {
    $where[] = "`usb_cam` <> ''";
    $to_h[] = 'usbcam=' . $usbcam;
};

$os = array();
if (($ebp == '1') and ($eb8 == '1') and ($skw == '1')) {
    $os[] = "`software` <> ''";
    $to_h[] = 'ebp=' . $ebp;
    $to_h[] = 'eb8=' . $eb8;
    $to_h[] = 'skw=' . $skw;
} else {
    if ($ebp == '1') {
        $os[] = "`software` LIKE '%Builder%Pro%'";
        $to_h[] = 'ebp=' . $ebp;
    };
    if ($eb8 == '1') {
        $os[] = "`software` LIKE '%Builder%8000%'";
        $to_h[] = 'eb8=' . $eb8;
    };
    if ($skw == '1') {
        $os[] = "`software` LIKE '%Workshop%'";
        $to_h[] = 'skw=' . $skw;
    };
};
if (($w8 == '1') and ($w7 == '1') and ($wxp == '1') and ($wce == '1')) {
    $os[] = "`os` <> ''";
    $to_h[] = 'w8=' . $w8;
    $to_h[] = 'w7=' . $w7;
    $to_h[] = 'wxp=' . $wxp;
    $to_h[] = 'wce=' . $wce;
} elseif (($w8 == '1') or ($w7 == '1') or ($wxp == '1') or ($wce == '1')) {

    if ($w8 == '1') {
        $os[] = "(`os` LIKE '%Win%8%')";
        $to_h[] = 'w8=' . $w8;
    };
    if ($w7 == '1') {
        $os[] = "(`os` LIKE '%Win%7%')";
        $to_h[] = 'w7=' . $w7;
    };
    if ($wxp == '1') {
        $os[] = "(`os` LIKE '%Win%XP%')";
        $to_h[] = 'wxp=' . $wxp;
    };
    if ($wce == '1') {
        $os[] = "(`os` LIKE '%Win%CE%')";
        $to_h[] = 'wce=' . $wce;
    };
};
$sc = count($os);
if ($sc > 1) {
    $where[] = "((" . implode(" OR ", $os) . "))";
} elseif ($sc == 1) {
    $where[] = $os[0];
};
/*
  if (($hdd == '1') AND ($ssd != '1')) {$where[] = "`hdd_type`='HDD'";} elseif (($hdd != '1') AND ($ssd == '1')) {$where[] = "`hdd_type`='SSD'";} elseif
  (($hdd == '1') AND ($ssd == '1')) {$where[] = "`hdd_type`<>''";};

  if (($hdd == '1') AND ($ssd != '1')) {
  if ((is_numeric($hdd_size)) AND ($hdd_size != '0') AND ($hdd_size != '1')) {$hdd_siz = $hdd_size-1; $where[] = "`hdd_size_gb` > '".$hdd_siz."'";};
  } elseif (($hdd != '1') AND ($ssd == '1')) {
  if ((is_numeric($ssd_size)) AND ($ssd_size != '0') AND ($ssd_size != '1')) {$ssd_siz = $ssd_size-1; $where[] = "`hdd_size_gb` > '".$ssd_siz."'";};
  } elseif (($hdd == '1') AND ($ssd == '1')) {
  $co = 0;$co1 = 0;
  if ((is_numeric($hdd_size)) AND ($hdd_size != '0') AND ($hdd_size != '1')) {$co = $co+$hdd_size;};
  if ((is_numeric($ssd_size)) AND ($ssd_size != '0') AND ($ssd_size != '1')) {$co1 = $co1+$ssd_size;};
  if (($co1 > $co) AND ($co > 1)) {
  $where[] = "`hdd_size_gb` > '".$co."'";
  } elseif (($co > $co1) AND ($co1 > 1)) {
  $where[] = "`hdd_size_gb` > '".$co1."'";
  };
  };
 */


if ($hdd == '1') {
    $where[] = "`hdd_type`<>''";
    $to_h[] = 'hdd=' . $hdd;
};

if ($capacitive != $resistive) {
    if ($capacitive == '1') {
        $where[] = "`touch_type` LIKE '%capacitive%'";
        $to_h[] = 'capacitive=' . $capacitive;
    };
    if ($resistive == '1') {
        $where[] = "`touch_type` LIKE '%resistive%'";
        $to_h[] = 'resistive=' . $resistive;
    };
} elseif (($capacitive == '1') and ($resistive == '1')) {
    $where[] = "`touch_type`<>''";
    $to_h[] = 'resistive=' . $resistive;
    $to_h[] = 'capacitive=' . $capacitive;
};

if ($pci != $mpci) {
    if ($pci == '1') {

        $where[] = "`pci_slot` LIKE '%1 x PCIe%'";
        $to_h[] = 'pci=' . $pci;
    };
    if ($mpci == '1') {
        $where[] = "`pci_slot` LIKE '%mini-PCIe%'";
        $to_h[] = 'mpci=' . $mpci;
    };
} elseif (($pci == '1') and ($mpci == '1')) {
    $where[] = "`pci_slot`<>''";
    $to_h[] = 'mpci=' . $mpci;
    $to_h[] = 'pci=' . $pci;
};


if (($ddr3 == '1') and (($ddr3_size == '0') or ($ddr3_size == '') or ($ddr3_size == '1') or ($ddr3_size == '-1'))) {
    $where[] = "`ram`>'999'";
    $to_h[] = 'ddr3=' . $ddr3;
} else
    if ((!empty($ddr3_size)) and ($ddr3_size != '0') and ($ddr3_size != '') and ($ddr3_size != '1') and ($ddr3_size != '-1')) {
        $ddr3_siz = $ddr3_size * 1000 - 1;
        $where[] = "(`ram` > '" . $ddr3_siz . "' OR `ram_max` > '" . $ddr3_siz . "')";
        $to_h[] = 'ddr3_size=' . $ddr3_size;
    };

if ($cores != '') {
    $to_h[] = 'cores=' . $cores;
    $cor = array();
    $speed = array();
    $core = explode(',', $cores);
    while (list($key, $val) = each($core)) {
        if (preg_match('|^[\d]+$|', $val)) {
            $cor[] = "`cpu_speed`='" . $val . "'";
        } else {
            if ($val != '') {
                if ($val == 'A8-600') {
                    $cor[] = "`cpu_type` LIKE '%A8%' AND `cpu_speed`='600'";
                    //  $speed[] = '600';
                } elseif ($val == 'A8') {
                    $cor[] = "`cpu_type` LIKE '%A8%' AND `cpu_speed`='1000'";
                    //  $speed[] = '1000';
                } else {
                    $cor[] = "`cpu_type` LIKE '%" . $val . "%'";
                };
            };
        };
    }
    /*
      if (!empty($speed)) {
      $where[] = "`cpu_speed` IN ('".implode("', '",$speed)."')";
      };
     */
    if (!empty($cor)) {
        $where[] = "((" . implode(") OR (", $cor) . "))";
    };
};

if ((is_int($min_width)) and ($min_width > 80)) {
    $where[] = "`width` > '" . $min_width . "'";
    $to_h[] = 'min_width=' . $min_width;
};
if ((is_int($max_width)) and ($max_width > 0) and ($max_width < 545)) {
    $where[] = "`width` < '" . $max_width . "'";
    $to_h[] = 'max_width=' . $max_width;
};
if ((is_int($min_height)) and ($min_height > 89)) {
    $where[] = "`height` > '" . $min_height . "'";
    $to_h[] = 'min_height=' . $min_height;
};
if ((is_int($max_height)) and ($max_height > 0) and ($max_height < 377)) {
    $where[] = "`height` < '" . $max_height . "'";
    $to_h[] = 'max_height=' . $max_height;
};
if ((is_int($min_thickness)) and ($min_thickness > 27)) {
    $where[] = "`thickness` > '" . $min_thickness . "'";
    $to_h[] = 'min_thickness=' . $min_thickness;
};
if ((is_int($max_thickness)) and ($max_thickness > 0) and ($max_thickness < 138)) {
    $where[] = "`thickness` < '" . $max_thickness . "'";
    $to_h[] = 'max_thickness=' . $max_thickness;
};


//if (($cool == '1')) {$where[] = "(`cpu_fan`='нет' OR `cpu_fan` LIKE '%без%')";};
if (($cool == '1')) {
    $where[] = "(`cpu_fan` NOT LIKE '%есть%')";
    $to_h[] = 'cool=' . $cool;
};
//
$temp_min = array();
if (($temp_min_minus_10 == '1')) {
    $temp_min[] = "(`temp_min_minus_10` = 1) ";
    $to_h[] = 'temp_min_minus_10=' . $temp_min_minus_10;
};
if (($temp_min_minus_20 == '1')) {
    $temp_min[] = "(`temp_min_minus_20` = 1) ";
    $to_h[] = 'temp_min_minus_20=' . $temp_min_minus_20;
};
if (($temp_min_minus_40 == '1')) {
    $temp_min[] = "(`temp_min_minus_40` = 1) ";
    $to_h[] = 'temp_min_minus_40=' . $temp_min_minus_40;
};
if (!empty($temp_min)) {
    $where[] = "((" . implode(") OR (", $temp_min) . "))";
    $to_h[] = 'temp_min=' . $temp_min;
};
//
$mount = array();
if (($vesa75 == '1')) {
    $mount[] = "`vesa75` <> ''";
    $to_h[] = 'vesa75=' . $vesa75;
};
if (($vesa100 == '1')) {
    $mount[] = "`vesa100` <> ''";
    $to_h[] = 'vesa100=' . $vesa100;
};
if (($panel_mount == '1')) {
    $mount[] = "`panel_mount` LIKE '%в щит%'";
    $to_h[] = 'panel_mount=1';
};
if (($din == '1')) {
    $mount[] = "`wall_mount` LIKE '%DIN%'";
    $to_h[] = 'vesa100=' . $vesa100;
};

if (!empty($mount)) {
    $where[] = "((" . implode(") OR (", $mount) . "))";
    $to_h[] = 'mount=' . $mount;
};


/*
  if (($ip65 == '1')) {$where[] = "`front_ip` <> ''";

  };

  if (($spb == '1')) {$stock[] = "`onstock_spb` > '0'";};
  if (($msk == '1')) {$stock[] = "`onstock_msk` > '0'";};
  if (($kiv == '1')) {$stock[] = "`onstock_kiv` > '0'";};
 */
if (!empty($slock)) {
//$where[] = "((".implode(") OR (",$stock)."))";
    $where[] = "((`onstock_spb` > '0') OR (`onstock_msk` > '0'))";
    $to_h[] = 'slock=' . $slock;
};

if (($case1 != '1') or ($case2 != '1')) {
    if (($case1 == '1')) {
        $where[] = "`case_material` LIKE '%Алю%'";
        $to_h[] = 'case1=' . $case1;
    };
    if (($case2 == '1')) {
        $where[] = "`case_material`='Пластик'";
        $to_h[] = 'case2=' . $case2;
    };
};

$whe = implode(' AND ', $where);
$href = implode('&', $to_h);
if (!empty($href)) {
    $site = str_replace("www.", "", $_SERVER['SERVER_NAME']);
    $link = 'http://www.' . $site . '/advanced_search.php?' . $href;
    $ssylka = '<div id="bottom_href">Ссылка на эту страницу: <a href="' . $link . '">' . $link . '</a></div>';
};
if (!empty($whe)) {
    $whe = 'AND ' . $whe;
};
?>