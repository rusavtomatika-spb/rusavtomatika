<?php

session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include("../sc/lib_new.php");
$lts_file = $_SERVER['DOCUMENT_ROOT'] . '/sc/alts.php';

//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));

database_connect();
mysql_query("SET NAMES 'cp1251'");

$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);
//echo $_SERVER['QUERY_STRING'];
$CANONICAL = $var_to_array;

//echo "sss=".$_SERVER['SCRIPT_FILENAME'];
//echo "sss=".$_SERVER['DOCUMENT_ROOT'];
//---------------content ---------------------

$prices_out = '
<script>
function dich(num,link)
 {
if (link != "0") {
   $("#dd").html("<a id=\"biglightbox\" href=\'"+link+"\' rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" /><img src=\'"+num+"\'\"></span></a>");
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

$var_array = explode("/", $_SERVER['SCRIPT_NAME']);
$levels = count($var_array);
$end_page = $levels - 1;

//$num="MT8070iH";
//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$num = str_replace(".php", "", $var_array[$end_page]);

$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_object($res);

//echo basename($_SERVER['PHP_SELF']);
/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;��� ����� 4 ���.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;���� �� �������: ���, ���, ����</div>";
 */


if ($r->type == 'hmi') {
    $type = '������ ���������';
    $title = $r->model . ', ' . $r->diagonal . '&#8243; ������ ��������� ' . $r->brand . ' �� ������ �� �������� ����';
};

if ($r->type == 'panel_pc') {
    $type = '��������� ���������';
    $title = '��������� ��������� ' . $r->diagonal . '&#8243; ' . $r->model . ', ��������, ����, �����';
};
if ($r->type == 'open_hmi') {
    $type = '��������� ��������� OPEN HMI';
    $title = '��������� ��������� Open HMI ' . $r->model . ' ' . $r->brand . ' �� ������ �� �������� ����';
};
if ($r->type == 'machine-tv-interface') {
    $type = '��������� MACHINE-TV';
    $title = '��������� Machine-TV ' . $r->model . ' ' . $r->brand . ' �� ������ �� �������� ����';
    $podbor_text = "��������� ���������� Weintek ��� �������";
};
if ($r->type == 'controllers') {
    $type = '���, PLC, ��������������� ���������� ����������';
    $title = "{$r->model} {$r->brand} $type";
};
if ($r->type == 'Gateway') {
    $type = '���� ������';
    $title = "$type {$r->model} {$r->brand}";
};
$description = $r->model . ', Weintek, ������ ���������, ������������ ������, ����� � �����-����������, ����� � ������, ����� � �����, ������ ���� ';
if ($r->type == 'cloud_hmi') {
    $type = '�������� ���������';
    $title = $r->model . ', �������� ��������� Weintek';
    $keywords = '�������� ���������, ' . $r->model . ', Weintek, EasyAccess 2.0';
    $description = $r->model . ' �������� ��������� �� Weintek �� ������ �� �������� ����';
};
if ($r->type == 'monitor_cloud_hmi') {
    $type = '����� ��������� ����������';
    $title = $r->model . ', ����� ��������� ���������� Weintek';
    $keywords = '����� ��������� ����������, ' . $r->model . ', Weintek, EasyAccess 2.0';
    $description = $r->model . ' ����� ��������� ���������� �� Weintek �� ������ �� �������� ����';
};
if ($r->type == 'Gateway') {
    $type = '���� ������';
    $title = $r->model . '&nbsp;���� ������ Weintek';
    $keywords = '����, ������, ' . $r->model . ', weintek';
    $description = '���� ������ ' . $r->model . ' ����������� ��������� ���� � ��������';
}
if ($r->type == 'monitor') {
    $type = '������������ �������';
    $title = $r->model . '&nbsp;������������ ������� ' . $r->diagonal . '&#8243; Weintek';
    $keywords = '������������, �������, ' . $r->model . ', IFC, ��������� ' . $r->diagonal . '&#8243;, ������������, ���������';
    $description = '������������ ������� ' . $r->model . '� ���������� ' . $r->diagonal . '&#8243;, ������������, ��������� - ����������� ��������� ���� � ��������';
};
$nav = '<br /><nav><a href="/">�������</a>&nbsp;/&nbsp;<a href="/weintek/">������ ��������� � ��������� ���������� Weintek</a>&nbsp;/&nbsp;' . $title . '</nav>';

if (($r->type == 'panel_pc') OR ($r->type == 'open_hmi')) {
    $types = '��������� ���������';
    $types1 = '���������� ����������';
    $typ = '���������';
    $typ1 = '����������';
    $typ2 = '�����������';
    $typ3 = '���� �����������';
} elseif ($r->type == 'controllers') {
    $types = '����������';
    $types1 = '�����������';
    $typ = '����������';
    $typ1 = '�����������';
    $typ2 = '������������';
    $typ3 = '���� ������������';
} else if (preg_match('/cmt-svr/i', $r->model)) {
    $types = '�������� ���������';
    $types1 = '��������� ����������';
    $typ = '������';
    $typ1 = '�������';
    $typ2 = '��������';
    $typ3 = '���� ��������';
} else {
    $types = '������ ���������';
    $types1 = '������ ���������';
    $typ = '������';
    $typ1 = '������';
    $typ2 = '�������';
    $typ3 = '���� �������';
};
$onst = show_stock($r, 1);

/*if ($r->diagonal == '7') {
    $add_model = ',HF-07';
} elseif ($r->diagonal == '9') {
    $add_model = ',HF-09';
} else {
    $add_model = '';
};*/

$min_table = miniatures($r->model . $add_model, 6, 10, 350, $r->view3d); // mins_in_row, mins_max, table_width
//$im1=get_big_pic($r->model);
//echo $r->model;


$query_images = "SELECT * FROM `gallery` WHERE `model`='{$r->model}' ORDER BY `id`;";
//var_dump($r);
$query_images_result = mysql_query($query_images) or die("������ �������022" . $query_images);
$iimg = mysql_num_rows($query_images_result);
$all_images = '<td><a href=\"#\" class=\"button_view360\"></a></td>';
//echo $iimg;
$im1 = 'images/weintek/' . $r->model . '/' . $r->model . '_1.png';
$bim1 = 'images/weintek/' . $r->model . '/lg/' . $r->model . '_1.png';


if ($iimg > 0) {

//$all_image .= '<table width="350" bfcolor="red"><tbody><tr>';
    for ($ij = 1; $ij <= $iimg; $ij++) {

        $img_row = mysql_fetch_assoc($query_images_result);
//var_dump($img_row);
//echo $_SERVER['DOCUMENT_ROOT'];
        if (empty($img_row[s_img_path])) {

            $img_row[s_img_path] = $r->model . '_1.png';
        };
        if ($r->type == 'cloud_hmi') {

            $path = 'images/weintek/' . $r->model . '/';

            if (file_exists($root_php . $path)) {

                $im1 = $path . $img_row[s_img_path];
            };

        } elseif ($r->type == 'hmi' or $r->type == 'monitor') {
            $path = 'images/weintek/' . $r->model . '/';

            if (file_exists($root_php . $path)) {
                $im1 = $path . $img_row[s_img_path];


            };

        };

        $image__big = $path . $img_row[b_img_path];
        $image__small = $path . $img_row[s_img_path];
        $image__normal = $path . $img_row[img_path];

        if ($ij == 1) {

            $ipath = $path . $img_row[img_path];
            $i_b_path = $img_row[img_path];
//echo $ipath.'path';
        };
        //  if ($img_row[alt] !='') {$img_alt=$img_row[alt];} else {$img_alt= $type.' '.$r->model.' ����������� �'.$ij;};

        /*     $all_images .= '<td onclick="dich(&quot;/' . $path . $img_row[img_path] . '&quot;,&quot;/' . $path . $img_row[img_path] . '&quot;);">


     <img src="/' . $path . $img_row[img_path] . '" width="60" alt="' . $alt . '"></td>';*/
    };
//$all_image .'</tr></tbody></table>';
} else {
    $ipath = '';
};

if (empty($min_table)) {
    $min_table = "<table width='350'><tr>" . $all_images . "</tr></table>";
};

if (!empty($ipath)) {
    $im1 = $ipath;
};

$alt = get_kw("alt");

if (empty($alt)) {
    $alt = $title;
}


if (file_exists($lts_file)) {

    include($lts_file);
};

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
    if (file_exists($GLOBALS["path_to_real_files"] . '/images/weintek/' . $r->model . '/lg/' . $r->model . '_1.png')) {
        $bim1 = '/images/weintek/' . $r->model . '/lg/' . $r->model . '_1.png';
    } else {
        $bim1 = '';
    };
} else {
    $re = cu($GLOBALS["path_to_real_files"] . '/images/weintek/' . $r->model . '/lg/' . $r->model . '_1.png');
    if ($re[0] > 0) {
        $bim1 = '/images/weintek/' . $r->model . '/lg/' . $r->model . '_1.png';
    } else {
        $bim1 = '';
    };
};

/** ����������� ������ �������� ��� �������� ��� */
if (!empty($bim1)) {
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='/$im1' alt='$alt'></span></a>";
} else {
    $kartinka = "
<img src='/$im1' alt='$alt'>";
};


if (($r->retail_price != '0') AND ($r->retail_price != '')) {
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
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/sc/analog.php')) {
    include($_SERVER['DOCUMENT_ROOT'] . '/sc/analog.php');
};

if ($r->model == 'cMT-SVR-100' or $r->model == 'cMT-HDMI' or $r->model == 'cMT-FHD' or $r->model == 'cMT-SVR-200') {
    $h1 = "$r->model, �������� ��������� Weintek";
    //$podbor_text = "��������� ��� ���������� Weintek ��� �������";
} elseif ($r->type == 'Gateway') {
    $h1 = "$type <strong>$brand $r->model</strong> ";
    //$podbor_text = "��������� ��� ���������� Weintek ��� �������";
} elseif ($r->type == 'controllers') {
    $h1 = "<strong>$brand $r->model</strong> ���, PLC, ��������������� ���������� ���������� ";
    //$podbor_text = "��������� ��� ���������� Weintek ��� �������";
} elseif ($r->type == 'machine-tv-interface') {
    $h1 = "$type <strong>$brand $r->model</strong> ";
} else {
    $h1 = "$type $r->diagonal&#8243; <strong>$brand $r->model</strong> ";
};
if ($r->type == 'Gateway') {
    $h1 = "$type <strong>$brand $r->model</strong> ";
    //$podbor_text = "��������� ��� ���������� Weintek ��� �������";
}


if (!empty($r->codesys)) {
    $technological["CODESYS"] = $r->codesys;
}
if (!empty($r->mqtt)) {
    $technological["MQTT"] = $r->mqtt;
}
if (!empty($r->opc_ua)) {
    $technological["OPC UA"] = $r->opc_ua;
}
if ($r->matrix == 'IPS') {
    $technological["IPS"] = $r->matrix;
}

foreach ($technological as $value => $key) {
    if (!empty($key)) {
        $technologicalResult[] = $value;
    }
}
$technologicalResult = implode(", ", $technologicalResult);
if (!empty($technologicalResult)) {
    $h1 .= '(' . $technologicalResult . ')';
    $title .= ' (' . $technologicalResult . ')';
}


if ($r->view360 != '') {
    $view360 = '<div class="block_view_video">';
    $view360 .= $r->view360;
    $view360 .= '</div>';
}

$search_diagonal = intval($r->diagonal) - 1;

if ($search_diagonal == 4)
    $search_diagonal = 3;

if ($search_diagonal == 10)
    $search_diagonal = 9;
/* if ($search_diagonal == 11)
  $search_diagonal = 10; */

$search_diagonal2 = intval($r->diagonal) + 1;;
/* if ($search_diagonal2 == 10)
  $search_diagonal2 = $search_diagonal2 + 1;
 */
$nominal_diagonal = $r->diagonal;
switch ($r->type) {
    case "hmi":
        $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?' .
            'diagonal=' . $nominal_diagonal .
            '&min_diagonal=' . $search_diagonal .
            '&max_diagonal=' . $search_diagonal2 .
            '&types=0"><span class="link_advanced_search_icon"></span>��������� ������� ������ � ���������� ' . $nominal_diagonal . '&Prime;</a>';
        break;
    case "open_hmi":
        $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?' .
            'diagonal=' . $nominal_diagonal .
            'min_diagonal=' .
            $search_diagonal .
            '&max_diagonal=' .
            $search_diagonal2 .
            '&types=0"><span class="link_advanced_search_icon"></span>��������� ������� ������ � ���������� ' . $nominal_diagonal . '&Prime;</a>';
        break;
    case "panel_pc":
        $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?'
            . 'diagonal=' . $nominal_diagonal .
            '&min_diagonal=' .
            $search_diagonal .
            '&max_diagonal=' .
            $search_diagonal2 .
            '&types=1"><span class="link_advanced_search_icon"></span>��������� ��������� ���������� � ���������� ' . $nominal_diagonal . '&Prime;</a>';
        break;
    case "cloud_hmi":
    case "Gateway":
    case "machine-tv-interface":
        $podbor_text = "��������� ��� ���������� Weintek ��� �������";
        $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?diagonals=1&brand=Weintek&types=456"><span class="link_advanced_search_icon"></span>' . $podbor_text . '</a>';
        break;

    default:
        $podbor_text = "";
        $link_advanced_search = '';
        break;
}


ob_start(); ?>

    <center>
<?= $nav ?>
    <br>
    <table width="1000px" height="400px">
    <tr>
        <td colspan="2" height="50px">
            <table>
                <tr>
                    <td width="840" align="left">
                        <h1 class="big_pan_name<?= $class ?>"><?= $h1 ?></h1>
                    </td>
                    <td width="120">
                        <div class="pan_price_big" title='��������� ����'> ���� � ���</div>
                    </td>
                    <?= $priceb ?>
                </tr>
            </table>
            <div class="hc1">&nbsp;</div>
            <?= $analog ?>
            <br>
        </td>
    </tr>
    <tr>

    <td valign="top" align="center" valign="center" width="450px">
        <?
        $imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";
        $new_path_picture = get_new_path_picture($imgRemoteDir);


        if (!empty($new_path_picture)) {
            ?>

            <div class="detail_image__wrapper">
                <?
                $counter = 0;
                foreach ($new_path_picture as $image_url):?>
                    <a class="detail_image__image-main_link" id="detail_image__image-main_link_<?= $counter++ ?>"
                       style="display: none;" data-fancybox="gallery"
                       href="<? echo $imgRemoteDir . "/lg/" . $image_url ?>">
                        <div class="detail_image__image-main"
                             style="background-image:url(<? echo $imgRemoteDir . "/md/" . $image_url ?>);"></div>
                    </a>
                <? endforeach; ?>

                <div class="detail_image__images-mini__wrapper">
                    <div class="detail_image__images-mini__inner">

                        <?
                        $counter = 0;
                        foreach ($new_path_picture as $image_url):?>
                            <div data-rel="detail_image__image-main_link_<?= $counter++ ?>"
                                 class="detail_image__images-mini"
                                 style="background-image:url(<? echo $imgRemoteDir . "/sm/" . $image_url ?>);"></div>
                        <? endforeach; ?>

                    </div>
                </div>


            </div>
            <? /*?> <img src="<?=$imgRemoteDir . "/sm/" . $new_path_picture["sm"][0]?>" alt="asd"><?*/
            ?>


            <?
        } else {

            ?>
            <div id="dd" style='height:300px;'>
                <?= $kartinka ?>
            </div>

            <style>#dd {
                    text-align: center;
                }

                #dd img {
                    max-height: 300px;
                    max-width: 400px;
                }

                h2 {
                    font-size: 14px;
                    color: gray;
                    margin: 17px 10px 12px 10px;
                }

                .com_about {
                    width: 200px;
                    float: left;
                }

                .scheme {
                    width: 700px;
                    float: right;
                    padding-left: 20px;
                }

                .com_about img {
                    width: 200px;
                }

                .com {
                    color: gray;
                }

                .scheme table tr td {
                    border: 1px solid gray;
                    padding: 3px 15px;
                    font-size: 11px;
                }

                .gray {
                    background-color: rgb(245, 245, 245);
                }

                #analog {
                    text-align: right;
                    font-family: Verdana, 'Lucida Grande';
                    font-size: 11px;
                    color: gray;
                    position: absolute;
                    width: 300px;
                    margin-left: 700px;
                }

                #analog a {
                    color: black;
                }
            </style>

            <br>
            <center>
                <?= $min_table ?>
                <?= $view360 ?>
            </center>

        <? } ?>
    </td>


    <td valign=top>
    <script>
        $(document).ready(function () {
            $('.mytab2 tr:even').addClass('gray');

        });
    </script>

<? $prices_out .= ob_get_clean();


if (preg_match('/�����/i', $onst)) {
    if ($r->model == 'MT6103iP') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/weintek/MT8102iP.php'>MT8102iP</a></div>";
    };
    if ($r->model == 'eMT3070A') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/weintek/eMT3070B.php'>eMT3070B</a></div>";
    };
    if ($r->model == 'MT8070iH') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. &nbsp; �������: <a href='/weintek/MT8071iP.php'>MT8071iP</a> <a href='/weintek/MT8071iE.php'>MT8071iE</a></div>";
    };
    if ($r->model == 'eMT607A') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/panelnie-computery/aplex/ARMPAC-507.php'>ARMPAC-507</a></div>";
    };
    if ($r->model == 'eMT610P') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/panelnie-computery/aplex/ARMPAC-510.php'>ARMPAC-510</a></div>";
    };
    if ($r->model == 'eMT612A') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/panelnie-computery/aplex/ARMPAC-512.php'>ARMPAC-512</a></div>";
    };
    if ($r->model == 'eMT615A') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/panelnie-computery/aplex/ARCHMI-815.php'>ARMPAC-512</a></div>";
    };
    if ($r->model == 'MT6051iP') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/weintek/MT8051iP.php'>MT8051iP</a></div>";
    };
    if ($r->model == 'MT6071iP') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/weintek/MT8071iP.php'>MT8071iP</a></div>";
    };
    if ($r->model == 'MT6070iE') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/weintek/MT8070iE.php'>MT8070iE</a></div>";
    };
    if ($r->model == 'MT6071iE') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. ������: <a href='/weintek/MT8071iE.php'>MT8071iE</a></div>";
    };
    if ($r->model == 'MT6070iH') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. �������: <a href='/weintek/MT8071iP.php'>MT8071iP</a> � <a href='/weintek/MT8071iE.php'>MT8071iE</a></div>";
    };
    if ($r->model == 'MT8070iH') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������</span>. �������: <a href='/weintek/MT8071iP.php'>MT8071iP</a> � <a href='/weintek/MT8071iE.php'>MT8071iE</a></div>";
    };
    if ($r->discontinued == '1') {
        $onst = "<div class='onstock'><img src='/images/red_sq.gif'> <span style='color:red;'>����� � ������������.</span> " . $r->analogs . "</div>";
    };
}
;

$prices_out .= "
<div id=cont_rp>

<table width=100%>

 <tr><td colspan=3> &nbsp;</td></tr>
 <tr><td width=5>&nbsp;</td><td width=80 class=h2_text>�������: </td><td > $onst</td>
 <td>  </td>  </tr>

 </table><br>";
ob_start();

if ($link_advanced_search):
    ?>
    <table width=100%>
        <? if ($r->discontinued != '1') { ?>
            <tr>
                <? if ($r->retail_price > 0): ?>
                    <td>
                        <div class=but_wr>
                            <div class='zakazbut' idm='<?= $r->model ?>' onclick='v_korzinu(this)'>
                                <span>� �������</span></div>
                        </div>
                    </td>
                <? else: ?>
                    <td>
                        <div class=but_wr>
                            <div class='zakazbut disabled'><span>� �������</span></div>
                        </div>
                    </td>
                <? endif; ?>
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
        <? } ?>
        <tr>
            <td>
                <div class=but_wr>
                    <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_compare(this)'><span>� ���������</span>
                    </div>
                </div>
            </td>
            <td colspan=2>
                <div class=but_wr>
                    <div class='link_advanced_search_wrapper'><?= $link_advanced_search ?></div>
                </div>
            </td>

        </tr>
        <tr>
            <td colspan=4><br>
                <div class=hc1></div>
            </td>
        </tr>
    </table>
<?
else:
    ?>
    <table width=100%>
        <tr>
            <td>
                <div class=but_wr>
                    <div class='zakazbut' idm='<?= $r->model ?>' onclick='v_korzinu(this)'><span>� �������</span></div>
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
            <td>
                <div class=but_wr>
                    <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_compare(this)'><span>� ���������</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan=4><br>
                <div class=hc1></div>
            </td>
        </tr>
    </table>
<?
endif;

$prices_out .= ob_get_contents();
ob_end_clean();

$im = "<img src='/images/tick.png' width=15 style='vertical-align: middle;'>";
$he = "height=40 class=hl_text";
$vc = "valign=center";
if (($r->case_material != "�������") AND ($r->type != 'monitor'))
    $cm = "<tr><td>$im </td><td $he>����� ����������� ������</td></tr>";
else
    $cm = "";

$proj_load = "";
if ($r->usb_client != "" and $r->usb_client != "���")
    $proj_load .= "� �� �� USB";
if ($r->ethernet != "" and $r->ethernet != "���") {
    if ($proj_load != "")
        $proj_load .= ", ";
    $proj_load .= "� �� �� Ethernet";
}

if ($r->usb_host != "" and $r->usb_host != "���")
    $proj_load .= ", � ������";
if ($r->sdcard != "" and $r->sdcard != "���")
    $proj_load .= ", � SD �����";
/*
if (!empty($proj_load)) {
    $proj_load1 .= "<tr><td>$im </td><td $he>�������� �������: $proj_load</td></tr>";
} else {
    $proj_load1 = '';
};*/

if ($r->os != "")
    $proj_load1 = "";

/*
if (!empty($r->software)) {
$os1 = "<tr><td valign=center>$im </td><td valign=middle $he>��: $r->software (����������)</td></tr> ";
};*/

if ($r->dotnet != '') {
    $donten = '.NET ' . $r->dotnet;
} else {
    $donten = '';
}
;
if (($r->type == 'panel_pc') OR ($r->type == 'open_hmi')) {
    $ww = '���������';
} else {
    $ww = '������';
}
;
if ($r->os != "")
    $os1 = "<tr><td valign=center>$im </td><td valign=middle $he>" . $ww . " � ������������ �������� $r->os $donten</td></tr> ";

if ($r->modbus_support != '') {
    if ($r->modbus_support == '����') {
        $os1 .= "<tr><td valign=center>$im </td><td valign=middle $he>��������� <!-- nosearch -->MODBUS<!-- /nosearch --> TCP/IP Gateway </td></tr>";
    } else {
        $os1 .= "<tr><td valign=center>$im </td><td valign=middle $he>��������� <!-- nosearch -->MODBUS<!-- /nosearch --> " . $r->modbus_support . "</td></tr>";
    }
}
if ($r->opc_ua != '') {
    $os1 .= "<tr><td valign=center>$im </td><td valign=middle $he>{$r->opc_ua}</td></tr>";
}
if ($r->model == 'cMT-G01' or $r->model == 'cMT-G02') {
    $os1 .= "<tr><td valign=center>$im </td><td valign=middle $he>���������� ����������� ������� </td></tr>";
}

$inter = $r->serial;

if ($r->ethernet != "") {
    if (!empty($inter)) {

        if ($r->ethernets > 1) {
            $inter .= ", " . $r->ethernets . "-����� Ethernet";
        } else {
            $inter .= ", Ethernet";
        };
    } else {
        $inter .= "Ethernet";
    };
}
;
if ($r->usb_host != "" and $r->usb_host != "���")
    $inter .= ", USB host";
if ($r->sdcard != "" and $r->sdcard != "���")
    $inter .= ", SD �����";
if ($r->can_bus != "" and $r->can_bus != "���")
    $inter .= ", CAN";
if (!empty($r->wifi)) {
    $inter .= ", Wi-Fi";
}
;
if ($r->linear_out != "")
    $inter .= ", �������� ����� �����";
if (!empty($inter)) {
    $inter1 = '<tr><td>' . $im . '</td><td ' . $he . '>' . $inter . '</td></tr>';
} else {
    $inter1 = '';
}
;

$remote = "";
if (!preg_match('/iP$/', $r->model) and ($r->type != "Gateway")) {
if ($r->ethernet != "" && $r->os == ""){
    ob_start(); ?>
    <tr>
        <td><?= $im ?></td>
        <td <?= $he ?>>��������� ������ �� <?
            if ($r->vnc_server_new == "����"):?>VNC, <? endif; ?>FTP, EasyAccess
        </td>
    </tr>
    <?
    $remote = ob_get_clean();
}
    if ($r->type == "controllers"){
        ob_start(); ?>
        <tr>
            <td><?= $im ?></td>
            <td <?= $he ?>>��������� ������ �� EasyAccess
            </td>
        </tr>
        <?
        $remote = ob_get_clean();
    }

    if ($r->ethernet != "" && $r->os != "")
        $remote = "<tr><td>$im </td><td $he>��������� ������ �� VNC, FTP </td></tr>";
} elseif ($r->type == "Gateway") {
    $remote = "<tr><td>$im </td><td $he>��������� ������ �� EasyAccess</td></tr>";
}
;

if ($r->matrix == "IPS") {
    $matrix_features = '<tr><td>' . $im . '</td><td $he>�������: ' . $r->matrix . '</td></tr>';
}

if ($r->easy_access == "optional") {
    $easy_access = "<tr><td>$im </td><td $he>�������� EasyAccess 2.0 ���������� ��������. ��������� � ����� ����������.</td></tr>";
} elseif ($r->easy_access == "build_in") {
    $easy_access = "<tr><td>$im </td><td $he>�������� EasyAccess 2.0 ������ � ���������.</td></tr>";

}


$fastgr = "";
if ($r->series == "iE")
    $fastgr = "<tr><td>$im </td><td $he>������� ������ � �������� <br>( �� 10 ��� �������, ��� � ������ ������ )</td></tr>";
$isoports = "";
if ($r->series == "iE")
    $isoports = "<tr><td>$im </td><td $he>������ �������������� �������� ���� ������</td></tr>";

$speed = "";
if ($r->series == "MT8000XE")
    $speed = "<tr><td>$im </td><td $he>��������� 1���, ����� ��������</td></tr>";
/*
if (!empty($r->touch)) {
$touch = "<tr><td>$im </td><td $he>��������� �����: $r->touch</td></tr>";
};
*/

if ((!empty($r->touch)) AND ($r->type == 'monitor')) {
    $touch = "<tr><td>$im </td><td $he>��������� ����� c ���������� ������� </td></tr>";
}
;
if (($r->type == 'monitor') AND ($r->diagonal >= 6)) {
    $glas = "<tr><td>$im </td><td $he>������ ��������� ���������� � ������� �����������</td></tr>";
}

if (($r->series == 'MT8000XE') OR ($r->series == 'cMT')) {
    $mqtt = '<tr><td>' . $im . '</td><td ' . $he . '><a href="/mqtt/">��������� MQTT</a></td></tr>';
}

if (($r->brand == 'Weintek') && ($r->diagonal == 9.7)) {
    $mqtt = '<tr><td>' . $im . '</td><td ' . $he . '><a class="ramkaoncart" href="#ui-id-5">����� ��� ������</a></td></tr>';
}

if (($r->brand == 'Weintek') && ($r->diagonal == 7)) {
    $mqtt = '<tr><td>' . $im . '</td><td ' . $he . '><a class="ramkaoncart" href="#ui-id-5">����� ��� ������</a></td></tr>';
}
if (($r->brand == 'Weintek') && ($r->diagonal == 12.1)) {
    $mqtt = '<tr><td>' . $im . '</td><td ' . $he . '><a class="ramkaoncart" href="#ui-id-5">����� ��� ������</a></td></tr>';
}


if ($r->brand == 'Weintek') {
    $quality = '���������� �������� � ����������';
} else {
    $quality = '����������� ����������� ���� � ��������';
}


if (in_array($r->type, array("hmi")) and !(in_array($r->model, array("cMT3151", "cMT3090")))) {
    $advantage_audio_alert_module = '<tr><td width="30" style="vertical-align: top;"><img src="/images/tick.png" width="15"></td><td class="hl_text">'
        . '����������� ��������������� ����� � ������� ������������� <a href="/weintek/DAO1EM.php">������ ����� ���������� DAO1EM</a>'
        . '</td></tr>';
}

if ($r->type == 'monitor') {
    if ($r->diagonal >= 10) {
        $glas2 = "<tr><td>$im </td><td $he>VGA + DVI + Audio �����</td></tr>";
    } elseif ($r->diagonal >= 8) {
        $glas2 = "<tr><td>$im </td><td $he>VGA + Audio �����</td></tr>";
    } else {
        $glas2 = "<tr><td>$im </td><td $he>VGA ����</td></tr>";
    };

    $poverplag = '<tr><td>' . $im . '</td><td ' . $he . '>����� ������� ������ � USB</td></tr>
<tr><td>' . $im . '</td><td ' . $he . '>H��������� ������� �������� 12 VDC, � ��������� ���� ���� ������� 220VAC - 12 VDC</td></tr>
<tr><td>' . $im . '</td><td ' . $he . '>��������������� �� ������ ( IP65 )</td></tr>

';
}
;

if (($r->thickness < 35)) {
    $thickness = '<tr><td>' . $im . '</td><td ' . $he . '>������ ������ � ' . $r->thickness . ' �� </td></tr>';
}

if (($r->model == "cMT-HDMI")) {
    $HDMI_port = '<tr><td>' . $im . '</td><td ' . $he . '>����� HDMI ����� ������������ � ������� ������ �������</td></tr>';
} else {
    $HDMI_port = "";
}
;

if (!empty($r->text_detail)) {
    ob_start();
    ?>
    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_text_detail">
        <div class="blockofcols_container">
            <div class="blockofcols_row">
                <?= $r->text_detail ?>
            </div>
        </div>

        <? if (!empty($easy_access)): ?>
            <table class='advantages' width=100%>
                <?= $easy_access ?>
                <?= $matrix_features ?>
            </table>
        <? endif; ?>
    </div>
    <?
    $ob_result = ob_get_contents();
    ob_end_clean();
    $prices_out .= $ob_result;
} else {

    ob_start(); ?>
    <br>

    <?
    if($r->text_features){
        echo $r->text_features;
    }else{
        ?>
        <table class='advantages' width=100%>
            <?= $HDMI_port ?>
            <?= $speed ?>
            <?//=$os1?>
            <tr>
                <td width=30><?= $im ?></td>
                <td <?= $he ?>> <?= $quality ?></td>
            </tr>
            <?
            if ($r->matrix == 'IPS'): ?>
                <tr>
                    <td width=30><?= $im ?></td>
                    <td <?= $he ?>>��� ������� <?= $r->matrix ?>, ������� ���� ������</td>
                </tr>
            <? endif; ?>

            <?= $cm ?>
            <?= $inter1 ?>
            <?= $remote ?>
            <?= $easy_access ?>
            <?//=$proj_load1?>
            <?= $fastgr ?>
            <?= $isoports ?>
            <?= $glas ?>
            <?= $touch ?>
            <?= $glas2 ?>
            <?= $poverplag ?>
            <?= $mqtt ?>
            <?= $thickness ?>
            <?= $advantage_audio_alert_module ?>


        </table>
        <?
    }
    ?>

    </div>

    <?

    $prices_out .= ob_get_clean();

}


// --------------------- end right part content -----------------------

$prices_out .= "</td></tr></table>"; // end big table
//----------------------------------------end pics ----------------------------


$bg1 = "style='background: #fefefe';";
$bg2 = "style='background: #f5f5f5';";
$table_start = "<table width=100% class='mytab2 tab1' cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";

$us_tr_l = '<tr><td class=par_name1 >';
$us_tr_l1 = '</td><td class=par_val1 >';
//----------------------------tab1 -----------------------------------------


if (($r->ethernet != "" && $r->software != "") AND (!preg_match('/iP$/', $r->model)) AND ($r->type != "Gateway")) {
    $dop = "<tr><td class=par_name1 >��������� ������ � ������</td><td class=par_val1 >FTP(������, �������, ������ �������), VNC (��������� ������),<br>
   EasyAccess (��������� ������, �������� ������� )</td></tr>
   <tr><td class=par_name1 >Ftp ������ � ������ ������</td><td class=par_val1 >" . ($r->ftp_access_hmi_mem ? "����" : "-") . "</td></tr>
   <tr><td class=par_name1 >Ftp ������ � SD ����� � ������</td><td class=par_val1 >" . ($r->ftp_access_sd_usb ? "����" : "-") . "</td></tr>
   ";
} elseif ($r->type == "Gateway") {
    $dop = "<tr><td class=par_name1 >��������� ������ � ������</td><td class=par_val1 >EasyAccess (��������� ������, �������� �������)</td></tr>
   ";
} else
    $dop = "";

$arch = "������ ������";
if ($r->usb_host != "" and $r->usb_host != "���")
    $arch .= ", ������";
if ($r->sdcard != "" and $r->sdcard != "���")
    $arch .= ", SD �����";


$mount = "";
if (($r->wall_mount == "����") OR ($r->wall_mount == "yes")) {
    $mount .= "� ���";
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

if ($r->diagonal == 0) {
    $display_char = '';
    $without = '( ��� ������� )';
} else {

    if (!empty($r->matrix)) {
        $matrix = '<tr><td class=par_name1 >�������</td><td class=par_val1 >' . $r->matrix . '</td></tr>';
    }
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
    };

    if ($r->type == 'monitor') {
        if ($r->touch != '') {
            $toucho = $r->touch;
        } else {
            $toucho = '����������� � USB ������������';
        }

    } else {
        $toucho = $r->touch;
    };
    $display_char = " <tr><td class=par_name1>�������</td><td class=par_val1  >$r->brightness ��/�2</td></tr>
 $backlight
 <tr><td class=par_name1>�������������</td><td class=par_val1 >$r->contrast</td></tr>
 <tr><td class=par_name1>���������</td><td class=par_val1 >$r->colors ������</td></tr>

 <tr><td class=par_name1>��� �������</td><td class=par_val1 >$toucho</td></tr>";
    $without = '';
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


if (preg_match('/3600/', $r->resolution)) {

    $r->resolution = '��������������� ��� �������� �������, ����������� ' . $r->resolution;
}

ob_start(); ?>
<? if ($r->diagonal > 0): ?>
    <div style="width:90%;">
        <span class=hpar>�������</span><br>

        <?= $table_start ?>
        <tr>
            <td class=par_name1>���������</td>
            <td class=par_val1><?= $r->diagonal ?>&#8243; <?= $without ?></td>
        </tr>
        <tr>
            <td class=par_name1>����������</td>
            <td class=par_val1><?= $r->resolution ?></td>
        </tr>

        <? if (!empty($r->matrix)): ?>
            <tr>
                <td class=par_name1>��� �������</td>
                <td class=par_val1><?= $r->matrix ?></td>
            </tr>
        <? endif; ?>
        <?= $display_char ?>
        <?= $pixel_pitch ?>
        <?= $response_time ?>
        <?= $view_angle ?>
    </table>
    <div class="separator"></div>

<? else: ?>
    <div style="width:90%;"><?= $table_start ?></table>
<? endif; ?>

<? $sp_data1 = ob_get_clean();


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
        $table_start . $params . '</table><div class="separator"></div>';
}
;
/*
  $sp_data1 .="<span class=hpar>����������</span><br>
  $table_start
  <tr><td class=par_name1 >���������������� ����������</td><td class=par_val1 >$r->serial_full</td></tr>
  $modbus
  $mpi
  <tr><td class=par_name1 >USB Host</td><td class=par_val1 >".($r->usb_host?$r->usb_host:'-')."</td></tr> //����
  <tr><td class=par_name1 >USB Client</td><td class=par_val1 >".($r->usb_client?$r->usb_client:'-')."</td></tr> //����
  <tr><td class=par_name1 >���� SD �����</td><td class=par_val1 >".($r->sdcard?$r->sdcard:'-')."</td></tr> //����
  <tr><td class=par_name1 >Ethernet</td><td class=par_val1 >".($r->ethernet?$r->ethernet:'-')."</td></tr> //����
  <tr><td class=par_name1 >�������� ����������</td><td class=par_val1 >".($r->linear_out?$r->linear_out:'-')."</td></tr> //����
  <tr><td class=par_name1 >���������</td><td class=par_val1 >".($r->video_input?$r->video_input:'-')."</td></tr> //����
  <tr><td class=par_name1 >CAN</td><td class=par_val1 >".($r->can_bus?$r->can_bus:'-')."</td></tr> //����
  </table><br><br>";
 */


if ($r->opc_ua != '') {
    $opc_ua = $us_tr_l . '��������� OPC UA' . $us_tr_l1 . $r->opc_ua . '</td></tr>';
}
if ($r->mqtt != '') {
    $mqtt2 = $us_tr_l . '��������� MQTT' . $us_tr_l1 . $r->mqtt . '</td></tr>';
} elseif ($r->brand == 'Weintek' and ($r->series == 'MT8000iE' or $r->series == 'eMT3000'
        or $r->series == 'cMT' or $r->series == 'mTV' or $r->series == 'MT8000XE' or $r->series == 'MT8000XE')) {
    $mqtt2 = $us_tr_l . '��������� MQTT' . $us_tr_l1 . '����</td></tr>';
}

if (!empty($r->voltage)) {
    $voltage = $us_tr_l . '���������� �������</td>' . $us_tr_l1 . '' . $r->voltage . '</td></tr>';
} else {
    $voltage = '';
}
;


if ($r->type == 'monitor' and $r->series == 'cMT') {
    ob_start(); ?>
    <? if (!empty($r->ts_usb)): ?>
        <tr>
            <td class="par_name1">USB ����� ������� ������</td>
            <td class="par_val1"><?= $r->ts_usb ?></td>
        </tr>
    <? endif; ?>
    <? if (!empty($r->video_input)): ?>
        <tr>
            <td class="par_name1">�����-�����</td>
            <td class="par_val1"><?= $r->video_input ?></td>
        </tr>
    <? endif; ?>
    <? if (!empty($r->linear_out)): ?>
        <tr>
            <td class="par_name1">�����-�����</td>
            <td class="par_val1"><?= $r->linear_out ?></td>
        </tr>
    <? endif; ?>
    <? if (!empty($r->usb_host)): ?>
        <tr>
            <td class="par_name1">USB host</td>
            <td class="par_val1"><?= $r->usb_host ?></td>
        </tr>
    <? endif; ?>
    <? if (!empty($r->usb_client)): ?>
        <tr>
            <td class="par_name1">USB client</td>
            <td class="par_val1"><?= $r->usb_client ?></td>
        </tr>
    <? endif; ?>


    <?
    $ob_result = ob_get_contents();
    ob_end_clean();
    $interfaces = $ob_result;

} elseif ($r->type == 'monitor') {

    $interfaces = $us_tr_l . '����� ������� ������</td>' . $us_tr_l1 . 'USB</td></tr>';
    if ($r->diagonal >= 10) {
        $interfaces = $us_tr_l . '�����-�����</td>' . $us_tr_l1 . 'VGA + DVI</td></tr>' .
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
} elseif ($r->type == 'monitor_cloud_hmi') {
    if (!empty($r->voltage)) {

        if (($r->voltage_min) > 0 and ($r->voltage_max) > 0) {
            $voltage_extra = ' (' . $r->voltage_min . '-' . $r->voltage_max . ' V)';
        } else {
            $voltage_extra = '';
        }
        $voltage = $us_tr_l . '���������� �������</td>' . $us_tr_l1 . '' . $r->voltage . $voltage_extra . '</td></tr>';
    } else {
        $voltage = '';
    };
    if (!empty($r->ethernet_full)) {
        $ethernet_full = $us_tr_l . 'Ethernet</td>' . $us_tr_l1 . $r->ethernet_full . '</td></tr>';
    } elseif
    ((!empty($r->ethernet)) AND ($r->ethernets != 0)) {
        $ethernet_full = $us_tr_l . 'Ethernet</td>' . $us_tr_l1 . $r->ethernet . '</td></tr>';
    } else {
        $ethernet_full = '';
    };
    if (!empty($r->audio)) {
        if ($r->audio == "���") {
            $audio = $us_tr_l . '����� ����</td>' . $us_tr_l1 . '���</td></tr>';
        } else
            $audio = $us_tr_l . '����� ����</td>' . $us_tr_l1 . $r->audio . ' ������</td></tr>';
    } else {
        $audio = '';
    };
    if (!empty($r->sdcard)) {
        $sdcard = $us_tr_l . '���� ���� ������</td>' . $us_tr_l1 . $r->sdcard . '</td></tr>';
    } else {
        $sdcard = '';
    };

    $interfaces = $ethernet_full . $wifi . $serial_full . $usb_host . $usb_client . $serial . $parallel_port . $can_bus . $video_input . $usb_cam . $vga_port . $hdmi . $pci_slot . $ps2 . $sdcard . $mic_in . $linear_out .
        $speakers . $audio . $rgb . $dc_input . $av_input . $dvi_d . $ts_rs232 . $ts_usb . $s_video;
} else {

    $modbus = "RTU, ASCII, Master, Slave";
    if ($r->ethernet != "")
        $modbus .= ", TCP/IP";

    $modbus = $us_tr_l . '��������� <!-- nosearch -->Modbus<!-- /nosearch -->' . $us_tr_l1 . $modbus . '</td></tr>';
    if ($r->os != "")
        $modbus = "";

    $mpi = $us_tr_l . '��������� MPI' . $us_tr_l1 . '187,5 K</td></tr>';

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
    if (!empty($r->dvi_d)) {
        $dvi_d = $us_tr_l . 'DVI-D ������</td>' . $us_tr_l1 . $r->dvi_d . '</td></tr>';
    } else {
        $dvi_d = '';
    };
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
    } elseif
    ((!empty($r->ethernet)) AND ($r->ethernets != 0)) {
        $ethernet_full = $us_tr_l . 'Ethernet</td>' . $us_tr_l1 . $r->ethernet . '</td></tr>';
    } else {
        $ethernet_full = '';
    };
    if (!empty($r->wifi)) {
        $wifi = $us_tr_l . 'Wi-Fi</td>' . $us_tr_l1 . $r->wifi . '</td></tr>';
    } else {
        $wifi = '';
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
    if (empty($r->serial_full)) {
        if (!empty($r->serial)) {
            $serial = $us_tr_l . '���������������� ����</td>' . $us_tr_l1 . $r->serial . ' ' . $r->serial_full . '</td></tr>';
        } else {
            $serial = '';
        };
    };
    if (!empty($r->parallel_port)) {
        $parallel_port = $us_tr_l . '������������ ����</td>' . $us_tr_l1 . $r->parallel_port . '</td></tr>';
    } else {
        $parallel_port = '';
    };
    if (!empty($r->can_bus)) {
        $can_bus = $us_tr_l . 'CAN BUS</td>' . $us_tr_l1 . $r->can_bus . '</td></tr>';
    } else {
        $can_bus = '';
    };
    if (!empty($r->video_input)) {
        $video_input = $us_tr_l . '���������</td>' . $us_tr_l1 . $r->video_input . '</td></tr>';
    } else {
        $video_input = '';
    };
    if (!empty($r->usb_cam)) {
        $usb_cam = $us_tr_l . '����������� USB-������</td>' . $us_tr_l1 . $r->usb_cam . '</td></tr>';
    } else {
        $usb_cam = '';
    };
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

    if (!empty($r->sdcard)) {
        $sdcard = $us_tr_l . '���� ���� ������</td>' . $us_tr_l1 . $r->sdcard . '</td></tr>';
    } else {
        $sdcard = '';
    };
    if (!empty($r->mic_in)) {
        $mic_in = $us_tr_l . '����������� ����</td>' . $us_tr_l1 . $r->mic_in . '</td></tr>';
    } else {
        $mic_in = '';
    };
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
    if (!empty($r->vga_port)) {
        $vga_port = $us_tr_l . 'VGA ����</td>' . $us_tr_l1 . $r->vga_port . ' ������</td></tr>';
    } else {
        $vga_port = '';
    };
    if (!empty($r->hdmi)) {
        $hdmi = $us_tr_l . 'HDMI ����</td>' . $us_tr_l1 . $r->hdmi . '</td></tr>';
    } else {
        $hdmi = '';
    };
    if (!empty($r->audio)) {
        if ($r->audio == "���") {
            $audio = $us_tr_l . '����� ����</td>' . $us_tr_l1 . '���</td></tr>';
        } else
            $audio = $us_tr_l . '����� ����</td>' . $us_tr_l1 . $r->audio . ' ������</td></tr>';
    } else {
        $audio = '';
    };

    if (!empty($r->voltage)) {

        if (($r->voltage_min) > 0 and ($r->voltage_max) > 0) {
            $voltage_extra = ' (' . $r->voltage_min . '-' . $r->voltage_max . ' V)';
        } else {
            $voltage_extra = '';
        }
        $voltage = $us_tr_l . '���������� �������</td>' . $us_tr_l1 . '' . $r->voltage . $voltage_extra . '</td></tr>';
    } else {
        $voltage = '';
    };
    if (!empty($r->power_isolation)) {
        $power_isolation = $us_tr_l . '�������� �� �������</td>' . $us_tr_l1 . $r->power_isolation . ' </td></tr>';
    } else {
        $power_isolation = '';
    };
    if (!empty($r->voltage_resistance)) {
        $voltage_resistance = $us_tr_l . '��������� ��������� �������</td>' . $us_tr_l1 . $r->voltage_resistance . ' </td></tr>';
    } else {
        $voltage_resistance = '';
    };
    if (!empty($r->isolation_resistance)) {
        $isolation_resistance = $us_tr_l . 'C������������ ��������</td>' . $us_tr_l1 . $r->isolation_resistance . ' </td></tr>';
    } else {
        $isolation_resistance = '';
    };
    if (!empty($r->mysql_support) and $r->mysql_support == 'Y') {
        $mysql_support = $us_tr_l . '����������� � ������� ��� ������</td>' . $us_tr_l1 . "MySQL" . '</td></tr>';
    } else {
        $mysql_support = '';
    };


    $interfaces = $ethernet_full . $wifi . $serial_full . $usb_host . $usb_client .
        $serial . $parallel_port . $can_bus . $video_input . $usb_cam . $vga_port .
        $hdmi . $pci_slot . $ps2 . $sdcard . $mic_in . $linear_out .
        $speakers . $audio . $rgb . $dc_input . $av_input . $dvi_d . $ts_rs232 .
        $ts_usb . $s_video;
    if ($r->brand == 'Weintek') {
        $interfaces .= $opc_ua . $mqtt2 . $modbus . $mpi . $mysql_support;
    };
}
;
if (!empty($r->pcb_coating)) {
    $pcb_coating = $us_tr_l . '�������� �������� �������� �����</td>' . $us_tr_l1 . $r->pcb_coating . '</td></tr>';
} else {
    $pcb_coating = '';
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
    $fan = $us_tr_l . '����������</td>' . $us_tr_l1 . '����������������</td></tr>';
} else {
    $fan = $us_tr_l . '����������</td>' . $us_tr_l1 . '����������</td></tr>';
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
if (!empty($r->netto) AND !empty($r->weight)) {
    $netto = $us_tr_l . '��� (����� / ������)</td>' . $us_tr_l1 . $r->netto . ' / ' . $r->weight . ' ��</td></tr>';
} else
    if (!empty($r->netto)) {
        $netto = $us_tr_l . '��� (�����)</td>' . $us_tr_l1 . $r->netto . ' ��</td></tr>';
    } else
        if (!empty($r->weight)) {
            $netto = $us_tr_l . '���</td>' . $us_tr_l1 . $r->weight . ' ��</td></tr>';
        } else {
            $netto = '';
        }
;
if (!empty($r->set)) {
    $set = $us_tr_l . '�������� ��������: ' . $us_tr_l1 . $r->set . '</td></tr>';
} else {
    $set = '';
}
;
$Design = $case_material . $front_ip . $pcb_coating . $fan . $mount . $cutout . $dimentions . $power_connector . $netto . $set;

$sp_data1 .= '<span class=hpar>����������</span><br>' .
    $table_start . $interfaces
    . '</table><div class="separator"></div>';


/*
  $sp_data1 .="<span class=hpar>�����������</span><br>
  $table_start
  <tr><td class=par_name1 >�������� �������</td><td class=par_val1 >$r->case_material</td></tr> //����
  <tr><td class=par_name1 >������� ������ �� ������</td><td class=par_val1 >IP65</td></tr>
  <tr><td class=par_name1 >������ ����������</td><td class=par_val1 >".($r->cpu_fan?"����������":"����������������")."</td></tr> //����
  <tr><td class=par_name1 >�������� ���������</td><td class=par_val1 >$mount</td></tr> //����
  <tr><td class=par_name1 >�������� ��������</td><td class=par_val1 >$r->set</td></tr> //����
  <tr><td class=par_name1 >������ �������</td><td class=par_val1 >$r->power_connector</td></tr> //����
  <tr><td class=par_name1 >��������</td><td class=par_val1 >$r->dimentions ��</td></tr> //����
  <tr><td class=par_name1 >����� ��� �������</td><td class=par_val1 >$r->cutout ��</td></tr> //����
  <tr><td class=par_name1 >���</td><td class=par_val1 >$r->netto ��</td></tr> //����
  <tr><td class=par_name1 >������� �����������</td><td class=par_val1 >$r->temp_min&deg - $r->temp_max&deg</td></tr>
  </table><br><br>";
 */
$sp_data1 .= '<span class=hpar>�����������</span><br>' . $table_start . $Design . '</table><div class="separator"></div>';


if ((($r->os != "") or ($r->type != 'monitor')) and $r->type != 'monitor_cloud_hmi') {
    $sp_data1 .= "<span class=hpar>�O</span><br>";
    $sp_data1 .= $table_start;

    if ($r->dotnet != '') {
        $donad = "<tr><td class=par_name1>.NET framework</td><td class=par_val1 >$r->dotnet</td></tr>";
    };

    if ($r->os != "")
        $sp_data1 .= "
 <tr><td class=par_name1>������������� ������������ �������</td><td class=par_val1 >$r->os</td></tr>
 $donad
 <tr><td class=par_name1>��</td><td class=par_val1 >� $typ3 �� ������������ �� ��� ���������� ��������. �&nbsp;EasyBuilder8000 � EasyBuilderPro ������
 ����������� ������ ��� ����� $typ1. ��� ���������� �������� ���������� ������������ ����� ����� ��� �������� �������� ��� $r->os, �������� Visual Studio.</td></tr>

 ";
    elseif ($r->type != 'monitor' and $r->type != 'controllers' and $r->model != 'cMT-iV5') {
        $sp_data1 .= "
 <tr><td class=par_name1>�� ��� ���������� ��������</td><td class=par_val1 >$r->software</td></tr>";
        if ($r->type != 'Gateway') {
            $sp_data1 .= "<tr><td class=par_name1>������������ ���������� ������� � �������</td><td class=par_val1 >1999</td></tr>";
        }

        ob_start(); ?>
        <?= $usb_drv ?>
        <tr>
            <td class=par_name1>�������� ��� ������ � �������������</td>
            <td class=par_val1>��� ����������� � ������</td>
        </tr>
        <tr>
            <td class=par_name1>����������� ���������� ������� ������</td>
            <td class=par_val1><?= $arch ?></td>
        </tr>
        <?
        if ($r->codesys != 0): ?>
            <tr>
                <td class=par_name1>��������� CODESYS</td>
                <td class=par_val1>����</td>
            </tr>
        <? endif; ?>
        <tr>
            <td class=par_name1>������� �������� ������� � ������</td>
            <td class=par_val1><?= $proj_load ?></td>
        </tr>
        <tr>
            <td class=par_name1>������������ ������ �������</td>
            <td class=par_val1><?= $r->project_size_mb ?> ��</td>
        </tr>


        <? $sp_data1 .= ob_get_clean();


        if ($r->history_data_size_mb > 0) {
            $sp_data1 .= "<tr><td class=par_name1>����� ������ ��� ���������� ������� � ������</td><td class=par_val1 >$r->history_data_size_mb ��</td></tr>";
        }
        if ($r->history_data_size_str != "") {
            $sp_data1 .= "<tr><td class=par_name1>����� ��� ���������� ������� � ������</td><td class=par_val1 >$r->history_data_size_str</td></tr>";
        }
        $sp_data1 .= "<tr><td class=par_name1>����������� �������� ���������������� ����������</td><td class=par_val1 >����</td></tr>
  $dop
 <tr><td class=par_name1>������������ �������</td><td class=par_val1 >��������, ��� � ���� � ������, �� � �� �������� ���������� �������� ������. ���������� ��������� �������
���������������� ����������� �����. ����������� �����
  ������������ ������ ���� �������������, ������� ������������� $r->software </td></tr>
    ";
    }

    $sp_data1 .= "</table><div class='separator'></div>";
}
;
if (!empty($r->temp_operating)) {
    $tempo = $us_tr_l . '������� �����������</td>' . $us_tr_l1 . $r->temp_operating . '</td></tr>';
} else
    if (!empty($r->temp_min) OR !empty($r->temp_max)) {
        $tempo = $us_tr_l . '������� �����������</td>' . $us_tr_l1 . $r->temp_min . ' ~ ' . $r->temp_max . ' &#8451;</td></tr>';
    }
;
if (!empty($r->vibration)) {
    $vibr = $us_tr_l . '�����������������</td>' . $us_tr_l1 . $r->vibration . '</td></tr>';
}
;
if (!empty($r->shock)) {
    $shok = $us_tr_l . '������� ��������</td>' . $us_tr_l1 . $r->shock . '</td></tr>';
}
;

//if ($r->type == 'monitor') {$powero = $us_tr_l.'���������� �������</td>'.$us_tr_l1.$r->voltage.' VDC</td></tr>';};
if (!empty($r->temp_storage)) {
    $tempsto = $us_tr_l . '����������� ��������</td>' . $us_tr_l1 . $r->temp_storage . '</td></tr>';
}
;
if (!empty($r->humidity)) {
    $hum = $us_tr_l . '��������� ��� �������� � ������������</td>' . $us_tr_l1 . $r->humidity . '</td></tr>';
}
;
if (!empty($r->current)) {
    $current = $us_tr_l . '������������ ���</td>' . $us_tr_l1 . $r->current . '�</td></tr>';
}
;
if (!empty($r->certification)) {
    $certification = $us_tr_l . '�����������</td>' . $us_tr_l1 . $r->certification . '</td></tr>';
}
;

$expluatation = $tempo . $tempsto . $current . $voltage . $power_isolation . $voltage_resistance . $isolation_resistance . $vibr . $shok . $hum . $certification;

if (!empty($expluatation)) {
    $sp_data1 .= '<span class=hpar>������������ � ��������</span><br>' .
        $table_start . $expluatation .
        '</table><div class="separator"></div>';
}
;
// $sp_data1.=  "</table></div><br><br>";

$sp_data1 .= '</div>';


//---------------------end tab1 -------------------------
//-------------spec ---------------------------

$imagepath = 'images/weintek/dim';
$dimensions = '';
$queryd = "SELECT * FROM `dimensions` WHERE `sys_name`='{$r->model}' LIMIT 1;";

$queryd = mysql_query($queryd) or die("������ ������� � ����� product_newo.php !!!" . $queryd. " Error: ". mysql_error());
$jd = mysql_num_rows($queryd);
if ($jd > 0) {
    $rowd = mysql_fetch_assoc($queryd);
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

    if ($GLOBALS["net"] == 0) {
        if (file_exists($GLOBALS["path_to_real_files"] . '/' . $imagepath . '/' . $r->model . '.png'))
            $dimensions = '<center><img src="/' . $imagepath . '/' . $r->model . '.png"></center>';
    } else {
        $re = cu($GLOBALS["path_to_real_files"] . '/' . $imagepath . '/' . $r->model . '.png');
        if ($re[1] > 0) {
            $dimensions = '<center><img src="/' . $imagepath . '/' . $r->model . '.png" style="max-width:900px;"></center>';
        } else {
            $dimensions = "";
        };
    };
}
;


$query2 = "SELECT * FROM `com` WHERE `model`='{$r->model}';";
$h2_scheme = 'COM-����� ���������� ' . $r->model;
$query2 = mysql_query($query2) or die("������ �������0212" . $query);
$j2 = mysql_num_rows($query2);
$scheme = '';
// $row2_time = mysql_fetch_assoc($query2);
// $sname_time = str_replace("\r\n", "<br />", $row2_time[name]);
if ($j2 > 0) {
    for ($i2 = 0; $i2 < $j2; $i2++) {
        $row2 = mysql_fetch_assoc($query2);
        $sname = str_replace("\r\n", "<br />", $row2[name]);
        if (!empty($row2['data_table_html'])) {
            $scheme .= '<div class="com" style="display: inline-block;"><div class="com_about">�������� �������:<br />' . $sname . '<br /><br />���:<br />' . $row2[type] . '<img class="" src="/images/' . $row2[image] . '" /><br /></div>';
            $scheme .= '<div class="scheme">';
            $scheme .= $row2['data_table_html'];
            $scheme .= '</div></div><div class="separator"></div>';
        } else {


            $scheme .= '<div class="com" style="display: inline-block;"><div class="com_about">�������� �������:<br />' . $sname . '<br /><br />���:<br />' . $row2[type] . '<img class="" src="/images/' . $row2[image] . '" /><br /></div>';
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

            $scheme .= '</table></div></div><div class="separator"></div>';
        }
    };
} else {
    $scheme = '� ' . $r->model . ' com-����� �����������.';
}
;


$komplect = '';
if ($r->diagonal == '7' or ($r->diagonal >= 9 and $r->diagonal < 10) or ($r->diagonal >= 12 and $r->diagonal < 13)) {
    $komplect = '<li class="urlup" data="accessories"><a href="#tabs-5">����������</a></li>';
} 
;
if ($r->type == 'monitor') {
    $sxemy = '';
} else {
    $sxemy = "<li class='urlup' data='scheme'><a href='#tabs-3'>�����</a></li>";
}
;

$vyvod = '
<div style="width:1100px; min-height: 500px; overflow: auto; ">

<div id="tabs">
<a style="float:right;margin-top:10px;margin-bottom:-10px;" class="compare_table_link" href="/weintek-stavnenie-seriy.php"><span class="compare_table_icon"></span><span>������� ��������� ����� �� �����������</span></a>
  <ul>
    <li class="urlup" data="functions"><a href="#tabs-1">��������������</a></li>
    <li class="urlup" data="dimensions"><a href="#tabs-2">��������</a></li>
    ' . $sxemy . ' 
    <li class="urlup" data="software"><a href="#tabs-4">�������</a></li>
	' . $komplect . '
  </ul>
  <div id="tabs-1">

  <h2>����������� �������������� ' . $typ1 . ' ' . $r->model . '</h2>
    ' . $sp_data1 . '

  </div>
  <div id="tabs-2"><h2>�������� ' . $typ1 . ' ' . $r->model . '</h2>
  ' . $dimensions . '
  </div>';
if ($r->type != 'monitor') {
    $vyvod .= '<div id="tabs-3">
  <div class=connectors>
  <h2>COM-����� ' . $typ1 . ' ' . $r->model . '</h2><br />' . $scheme . '
  </div></div>
  ';
}
;
// echo  $vyvod.show_com_connector($r->model).'</div>';

ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_linked_products.php";
$prices_out .= ob_get_clean();
$prices_out .= $vyvod;


if (!empty($_GET[tab])) {
    if ($_GET[tab] == 'accessories') {
        $uuu = '$(\'a[href="#tabs-5"]\').click();';
    } else if ($_GET[tab] == 'functions') {
        $uuu = '$(\'a[href="#tabs-1"]\').click();';
    } else if ($_GET[tab] == 'software') {
        $uuu = '$(\'a[href="#tabs-4"]\').click();';
    } else if ($_GET[tab] == 'dimensions') {
        $uuu = '$(\'a[href="#tabs-2"]\').click();';
    } else if ($_GET[tab] == 'scheme') {
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
if ($r->series == "MT6000i" || $r->series == "MT8000i" || $r->series = "eMT3000")
    $usb = "<br>USB �������� ��� ����������� ������ $r->model � �� ���������������
  ������������� ��� ��������� $r->software";
else
    $usb = "";

if ($r->software == "EasyBuilder8000") {
    $serii = "����� MT6000i, ����� MT8000i";
    if ($GLOBALS["net"] == 0) {

        if (file_exists($GLOBALS["EB8000_version"])) {
            $ver = file_get_contents($GLOBALS["EB8000_version"]);
        };
        $so = $GLOBALS["EB8000_link"];
        $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
        $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        $ma = $GLOBALS["EB8000_manual_link"];
        $tma = date("d-m-Y", filemtime($path_to_real_files . $ma));
        $fsma = (sprintf("%u", filesize($path_to_real_files . $ma)) + 0) / 1000;
    } else {

        $ver = cu_content($GLOBALS["EB8000_version"]);
        $so = $GLOBALS["EB8000_link"];
        $re1 = cu($path_to_real_files . $so);
        $tso = date("d-m-Y", $re1[1]);
        $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        $ma = $GLOBALS["EB8000_manual_link"];
        $re2 = cu($path_to_real_files . $ma);
        $tma = date("d-m-Y", $re2[1]);
        $fsma = (sprintf("%u", $re2[0]) + 0) / 1000;
    };
    if ($r->model == 'MT8104XH' || $r->model == 'MT8150X' || $r->model == 'MT8121X') {
        $ver = '4.65.12';
        $so = '/soft/EB8000/EB8000V46512.zip';
    };
} else if (preg_match('/EasyBuilderPro/', $r->software)) {
    $r->software = 'EasyBuilderPro';
    $serii = "����� MT8000iE, ����� eMT3000, C���� cMT";
    if ($GLOBALS["net"] == 0) {

        if (file_exists($GLOBALS["EBPro_version"])) {
            $ver = file_get_contents($GLOBALS["EBPro_version"]);
        };
        $so = $GLOBALS["EBPro_link"];
        $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
        $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        $ma = $GLOBALS["EBPro_manual_link"];
        $tma = date("d-m-Y", filemtime($path_to_real_files . $ma));
        $fsma = (sprintf("%u", filesize($path_to_real_files . $ma)) + 0) / 1000;
    } else {
        //  $re = cu($GLOBALS["EBPro_version"]);

        $ver = cu_content($GLOBALS["EBPro_version"]);
        $so = $GLOBALS["EBPro_link"];
        $re1 = cu($path_to_real_files . $so);
        $tso = date("d-m-Y", $re1[1]);
        $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        $ma = $GLOBALS["EBPro_manual_link"];
        $re2 = cu($path_to_real_files . $ma);
        $tma = date("d-m-Y", $re2[1]);
        $fsma = (sprintf("%u", $re2[0]) + 0) / 1000;
    };
}

if ($r->software != "") {

    if ($GLOBALS["net"] == 0) {
        $PLC_date = date("d-m-Y", filemtime($path_to_real_files . $PLC_connect_guide));
        $PLC_size = (sprintf("%u", filesize($path_to_real_files . $PLC_connect_guide)) + 0) / 1000;
    } else {
        $re1 = cu($path_to_real_files . $PLC_connect_guide);

        if ($re1[0] > 0) {
            $PLC_date = date("d-m-Y", $re1[1]);
            $PLC_size = (sprintf("%u", $re1[0]) + 0) / 1000;
        };
    };

    if ($fsma > 1000) {
        $sma = round($fsma / 1000, 2) . '&nbsp;��';
    } else {
        $sma = round($fsma, 0) . '&nbsp;��';
    };
    if ($fsso > 1000) {
        $sso = round($fsso / 1000, 2) . '&nbsp;��';
    } else {
        $sso = round($fsso, 0) . '&nbsp;��';
    };
    if ($PLC_size > 1000) {
        $splc = round($PLC_size / 1000, 2) . '&nbsp;��';
    } else {
        $splc = round($PLC_size, 0) . '&nbsp;��';
    };

//if ($splc>1) {$splc .='&nbsp;��';} else {$splc = $splc*1000;$splc.='&nbsp;��';};
    if ($r->type != 'panel_pc') {
        $soft1 = " <tr><td><div class=down_item>  ����������� ����������� $r->software $ver</div>
   <div class=down_item_descr> ����������� ����������� $r->software ����������� ��� �������� ���������������� �������� ��� ������������ ������� Weintek ���� �����.
   <br>
   ������������� �� $r->software ��������� ���������, �� ������ ��������� �� � ������������ �� ��� �����-���� �����������.
   $usb
   </div></td>
   <td><div class=dt_item>" . $tso . "<br>(���)<br />" . $sso . "</div>
   </td><td><div class=down_item><a href='$so'><img src=/images/soft.jpg></a><div> </td> </tr>";

        $soft2 = "<tr><td><div class=down_item>  ����������� � �� $r->software  </div></td>
   <td><div class=dt_item>" . $tma . "<br>(eng)<br />" . $sma . "</div></td>
   <td><div class=down_item><a href='$ma'><img src=/images/manual.jpg></a></div></td></tr> ";


        $update_date_file_path = "http://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/update_date.txt";
        $update_date = strip_tags(file_get_contents($update_date_file_path));
        $soft2_2 = "<tr><td><div class=down_item>������ ����������� ������������ EasyBuilder Pro V6.00.01 �� ���������� �����</div></td>
   <td><div class=dt_item>$update_date</div></td>
   <td><div class=down_item><a href='/weintek-easybuilderpro-user-manual-en/'><img src='/images/link-external-big.png'></a></div></td></tr>";

        $soft3 = "<tr><td><div class=down_item> ����������� �� ����������� ������������ (PLC) �  ������ ��������� $r->model </div>
   <div class=down_item_descr> � ����������� ������� ����������� � �����, ��� 100 PLC ��������� ��������������,
   ���� ����� �������� ������� ��� ����������� ������ ��������� $r->model � ���� PLC, ������� ��������, � ������� ���� ������
   �������� ������ PLC. <br> ��� �������� ��� ���� PLC, ���������� � ������ �����������, ��� ����������� � ������������ ������ $r->model. <br>
   ��� ����������� ������  ��������� $r->model � ����������� PLC ������������ ������������� ������������ � �������������� �������� ������� �����������.</div>
   </td>

   <td><div class=dt_item>" . $PLC_date . "<br>(eng)<br />" . $splc . "</div></td>
   <td><div class=down_item><a href='$PLC_connect_guide'><img src=/images/manual.jpg></a></div></td></tr>";
    } else {
        $soft1 = "";
        $soft2 = "";
        $soft3 = "";
    };
} else {
    $soft1 = "";
    $soft2 = "";
    $soft3 = "";
}

//������

if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . 'manuals/' . $r->model . '.pdf')) {
        $ine = 1;
        $fs = (sprintf("%u", filesize($root_php . 'manuals/' . $r->model . '.pdf')) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . 'manuals/' . $r->model . '.pdf'));
    } elseif (file_exists($root_php . 'weintek/manuals/' . $r->model . '.pdf')) {
        $ine = 2;
        $fs = (sprintf("%u", filesize($root_php . 'weintek/manuals/' . $r->model . '.pdf')) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . 'weintek/manuals/' . $r->model . '.pdf'));
    } else {
        $ine = 0;
    };
} else {
    $re = cu($root_php . '/manuals/' . $r->model . '.pdf');
    $re1 = cu($root_php . '/weintek/manuals/' . $r->model . '.pdf');
    if ($re[1] > 0) {
        $ine = 1;
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } elseif ($re1[1] > 0) {
        $ine = 2;
        $t = date("d-m-Y", $re1[1]);
        $fs = (sprintf("%u", $re1[0]) + 0) / 1000;
    } else {
        $ine = 0;
    };
}
;

if (($ine == 0) AND ($r->brochure != '')) {

    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . 'manuals/' . $r->brochure)) {
            $ine = 1;
            $fs = (sprintf("%u", filesize($root_php . 'manuals/' . $r->brochure)) + 0) / 1000;
            $t = date("d-m-Y", filemtime($root_php . 'manuals/' . $r->brochure));
            $brochure = $r->brochure;
        } else {
            $ine = 0;
        };
    } else {
        $re = cu($root_php . '/manuals/' . $r->brochure);
        $re1 = cu($root_php . '/weintek/manuals/' . $r->brochure);
        if ($re[0] > 0) {
            $ine = 1;
            $t = date("d-m-Y", $re[1]);
            $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            $brochure = $r->brochure;
        } else {
            $ine = 0;
        };
    };
} else {

    $brochure = $r->model . '.pdf';
}
;

if ($fs > 1000) {
    $s = round($fs / 1000, 2) . '&nbsp;��';
} else {
    $s = round($fs, 0) . '&nbsp;��';
}
;

if ($ine == 1) {
    $soft5 = "
 <tr><td><div class=down_item> ������� �� $types $r->model </div></td>
   <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
   <td><div class=down_item><a target='_blank' href='/manuals/$brochure'><img src=/images/manual.jpg></a></div></td></tr>
 ";
} elseif ($ine == 2) {

    $soft5 = "
 <tr><td><div class=down_item> ������� �� $types $r->model </div></td>
   <td><div class=dt_item>" . $t . "<br />(eng)<br />" . $s . "</div></td>
   <td><div class=down_item><a target='_blank' href='/weintek/manuals/$brochure'><img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft5 = '';
}
;


if ($r->user_manual) {
    $soft5 .= "<tr><td><div class=down_item> ����������� ������������ $r->model </div></td><td><div class=dt_item>";
    $soft5 .= get_file_date("/manuals/$r->user_manual");
    $soft5 .= "</div></td>
   <td><div class=down_item><a target='_blank' href='/manuals/$r->user_manual'><img src=/images/manual.jpg></a></div></td></tr>";
}
//CODESYS

if ($r->codesys != 0) {
    $viewerPath = 'manuals/weintek/cMT_CODESYS_Datasheet_ENG.pdf';

    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . $viewerPath)) {
            $fs = (sprintf("%u", filesize($root_php . $viewerPath)) + 0) / 1000;
            $t = date("d-m-Y", filemtime($root_php . $viewerPath));
        };
    } else {
        $re = cu($root_php . '/' . $viewerPath);
        if ($re[0] > 0) {
            $t = date("d-m-Y", $re[1]);
            $fs = (sprintf("%u", $re[0]) + 0) / 1000;
        };
    };
    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };

    $soft__codesys = "
 <tr><td><div class=down_item>����������� ������������ cMT + CODESYS</div></td>
 <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
 <td><div class=down_item><a href='/$viewerPath' download><img src='/images/manual.jpg'></a></div></td></tr>
 ";
}
;
//Remote I/O

if ($r->codesys != 0) {
    $viewerPath = 'manuals/weintek/cMT_Codesys_Install_UserManual.pdf';

    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . $viewerPath)) {
            $fs = (sprintf("%u", filesize($root_php . $viewerPath)) + 0) / 1000;
            $t = date("d-m-Y", filemtime($root_php . $viewerPath));
        };
    } else {
        $re = cu($root_php . '/' . $viewerPath);
        if ($re[0] > 0) {
            $t = date("d-m-Y", $re[1]);
            $fs = (sprintf("%u", $re[0]) + 0) / 1000;
        };
    };
    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };

    $soft__remoteio = "
 <tr><td><div class=down_item>��������� ���������� �� ��������� ������ ��������� cMT + CODESYS � Remote I/O</div></td>
 <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
 <td><div class=down_item><a href='/$viewerPath' download><img src='/images/manual.jpg'></a></div></td></tr>
 ";
}
;
//cMTViewer

if (preg_match('/cmt/i', $r->model)) {
    $viewerPath = 'soft/cMTViewer/cMTViewer.zip';

    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . $viewerPath)) {
            $fs = (sprintf("%u", filesize($root_php . $viewerPath)) + 0) / 1000;
            $t = date("d-m-Y", filemtime($root_php . $viewerPath));
        };
    } else {
        $re = cu($root_php . '/' . $viewerPath);
        if ($re[0] > 0) {
            $t = date("d-m-Y", $re[1]);
            $fs = (sprintf("%u", $re[0]) + 0) / 1000;
        };
    };
    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    if ($r->type != 'controllers') {
        $soft9 = "
 <tr><td><div class=down_item>��������� cMT Viewer ��� ���������� ���������� $r->model � PC</div></td>
 <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
 <td><div class=down_item><a href='/$viewerPath' download><img src=/images/soft.jpg></a></div></td></tr>
 ";
    }
}
;

//����������� ������������  cMT-SVR
if (preg_match('/cmt-svr/i', $r->model)) {
    $viewerPath = 'manuals/cMT-SVR-UserManual.pdf';

    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . $viewerPath)) {
            $fs = (sprintf("%u", filesize($root_php . $viewerPath)) + 0) / 1000;
            $t = date("d-m-Y", filemtime($root_php . $viewerPath));
        };
    } else {
        $re = cu($root_php . '/' . $viewerPath);
        if ($re[0] > 0) {
            $t = date("d-m-Y", $re[1]);
            $fs = (sprintf("%u", $re[0]) + 0) / 1000;
        };
    };

    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };

    $soft10 = "
	 <tr><td><div class=down_item>����������� ������������ $types1 $r->model</div></td>
	 <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
	 <td><div class=down_item><a href='/$viewerPath'><img src=/images/manual.jpg></a></div></td></tr>
	 ";
}
;


///

if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . 'install/' . $r->model . '.pdf')) {
        $ne = 1;
        $fs = (sprintf("%u", filesize($root_php . 'install/' . $r->model . '.pdf')) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . 'install/' . $r->model . '.pdf'));
    } elseif (($r->install_doc != '') AND (file_exists($root_php . 'install/' . $r->install_doc))) {
        $ne = 2;
        $fs = (sprintf("%u", filesize($root_php . 'install/' . $r->install_doc)) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . 'install/' . $r->install_doc));
    } elseif (($r->install_doc != '') AND (file_exists($root_php . 'weintek/installs/' . $r->install_doc))) {
        $fs = (sprintf("%u", filesize($root_php . 'weintek/installs/' . $r->install_doc)) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . 'weintek/installs/' . $r->install_doc));
        $ne = 3;
    } else {
        $ne = 0;
    };
} else {
    $re = cu($root_php . '/install/' . $r->model . '.pdf');
    $re1 = cu($root_php . '/install/' . $r->install_doc);
    $re2 = cu($root_php . '/installs/' . $r->install_doc);
    if ($re[0] > 0) {
        $ne = 1;
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } elseif (($r->install_doc != '') AND ($re1[0] > 0)) {
        $ne = 2;
        $t = date("d-m-Y", $re1[1]);
        $fs = (sprintf("%u", $re1[0]) + 0) / 1000;
    } elseif (($r->install_doc != '') AND ($re2[0] > 0)) {
        $ne = 3;
        $t = date("d-m-Y", $re2[1]);
        $fs = (sprintf("%u", $re2[0]) + 0) / 1000;
    } else {
        $ne = 0;
    };
}
;


if ($fs > 1000) {
    $s = round($fs / 1000, 2) . '&nbsp;��';
} else {
    $s = round($fs, 0) . '&nbsp;��';
}
;


if ($ne == 1) {

    $soft6 = "
 <tr><td><div class=down_item> ����������� �� ��������� " . $typ1 . " $r->model </div></td>
   <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
   <td><div class=down_item><a href='/install/" . $r->model . ".pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} elseif ($ne == 2) {
    $soft6 = "
 <tr><td><div class=down_item> ����������� �� ��������� " . $typ1 . " $r->model </div></td>
   <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
   <td><div class=down_item><a href='/install/" . $r->install_doc . "' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} elseif ($ne == 3) {
    $fs = (sprintf("%u", filesize($root_php . 'weintek/installs/' . $r->install_doc)) + 0) / 1000;
//$s =  ceil($fs/1000);
    $s = round($fs / 1000, 2);
    $soft6 = "
 <tr><td><div class=down_item> ����������� �� ��������� " . $typ1 . " $r->model </div></td>
   <td><div class=dt_item>" . $t . "<br>(eng)" . $s . "<br />$s<br />(eng)</div></td>
   <td><div class=down_item><a href='/weintek/installs/" . $r->install_doc . "' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft6 = '';
}
;

//�������
$t = '';
$fs = 0;
$soft11 = '';
$sql = "SELECT * FROM `drawing` WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());
//echo $sql;
$count = mysql_num_rows($res);
//echo $count;
for ($i = 0; $i < $count; $i++) {
    $r1 = mysql_fetch_object($res);
    $viewerPath = 'drawing/' . $r1->file_name;

    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . $viewerPath)) {
            $fs = (sprintf("%u", filesize($root_php . $viewerPath)) + 0) / 1000;
            $t = date("d-m-Y", filemtime($root_php . $viewerPath));
        };
    } else {
        $re = cu($root_php . '/' . $viewerPath);
        if ($re[0] > 0) {
            $t = date("d-m-Y", $re[1]);
            $fs = (sprintf("%u", $re[0]) + 0) / 1000;
        };
    };

    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    if ($fs > 0) {

        $file_firmat = explode('.', $r1->file_name);
if(strtolower($file_firmat[count($file_firmat) - 1]) == "sldprt"){
    $soft11 .= "
    <tr><td><div class=down_item>3D ������ $types1 $r->model � ������� " . strtolower($file_firmat[count($file_firmat) - 1]) . " </div></td>
    <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
    <td><div class=down_item><a href='/$viewerPath' download><img src=/images/soft.jpg></a></div></td></tr>
    ";
}else{
    $soft11 .= "
    <tr><td><div class=down_item>������ $types1 $r->model � ������� " . strtolower($file_firmat[count($file_firmat) - 1]) . " </div></td>
    <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
    <td><div class=down_item><a href='/$viewerPath' download><img src=/images/soft.jpg></a></div></td></tr>
    ";
}
        
    }
}
;


$komplects = '';

if ($r->diagonal == '7') {

//$min_table=miniatures('HF-07', 5, 10, 350);

    ob_start(); ?>
    <div class="blockofcols_container">
    <div class="col-12">
        <div class="block_item" style="    margin-left: 15PX;">
            <div class="block_item_title">����� ��� ������� ��������� Weintek 7" HF-07</div>


            <div class="blockofcols_row" style="margin-bottom:25px;">
                <div class="col-9">
                    <div class="block_item_text">
                        <ul class="plc_weintek_ul_style1">
                            <li>��������: 227�217�36 ��</li>
                            <li>��������: ���������� ������ / ����������� �����</li>
                        </ul>
                    </div>
                </div>
                <div class="col-3">
                    <div class="block_item_info">
                                    <span class="link_advanced_search block_item_info-btn" idm="HF-07"
                                          onclick="show_backup_call(6, &quot;HF-07&quot;)">������
                                        ����</span>
                    </div>
                </div>
            </div>


            <div class="block_item_photo">
                <div class="blockofcols_row">
                    <div class="col-9">
                        <a data-fancybox="gallery" href="/images/fam/HF-07/lg/HF-07_4.png">
                            <div class="block_item-img"
                                 style="background-image:url('/images/fam/HF-07/HF-07_4.png'); height: 322px;"></div>
                        </a>
                    </div>
                    <div class="col-3">
                        <div class="blockofcols_row">
                            <div class="col-12">
                                <a data-fancybox="gallery" href="/images/fam/HF-07/lg/HF-07_2.png">
                                    <div class="block_item-img"
                                         style="background-image:url('/images/fam/HF-07/HF-07_2.png')"></div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a data-fancybox="gallery" href="/images/fam/HF-07/lg/HF-07_3.png">
                                    <div class="block_item-img"
                                         style="background-image:url('/images/fam/HF-07/HF-07_3.png')"></div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="block_item_dim-title">�����
                <div class="block_item_dim-pdf">
                    <a href="/manuals/HF-07.pdf" style="display:inline-block;">������� ������ (pdf)</a>
                </div>
            </div>
            <div>
                <div class="blockofcols_row">
                    <div class="col-12">
                        <a data-fancybox="dim" href="/images/fam/dim/HF-07.jpg">
                            <div class="block_item-img" style="background-image:url('/images/fam/dim/HF-07.jpg')"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <? $accessories = ob_get_clean();
if ($r->type == 'monitor_cloud_hmi') {
    $komplects = '<!-- nosearch --><div id="tabs-5">
    <div class=connectors>
    <h2>������������� ������ ��������� ����������' . $r->model . '</h2><br />' . $accessories . '<br /><br /><br />
    </div></div><!-- /nosearch -->';
} else {
    $komplects = '<!-- nosearch --><div id="tabs-5">
    <div class=connectors>
    <h2>������������� ' . $types1 . ' ' . $r->model . '</h2><br />' . $accessories . '<br /><br /><br />
    </div></div><!-- /nosearch -->';
}
}



if ($r->diagonal >= 9 and $r->diagonal < 10) {
    ob_start();
    ?>
    <div class="blockofcols_container">
        <div class="col-12">
            <div class="block_item" style="    margin-right: 15PX;">
                <div class="block_item_title">�����
                    ��� <? if ($r->type == 'monitor_cloud_hmi'): ?>������ ��������� ���������� <? else: ?>������� ��������� <? endif; ?>
                    Weintek 9.7" HF-09
                </div>
                <div class="blockofcols_row" style="margin-bottom:25px;">
                    <div class="col-9">
                        <div class="block_item_text">
                            <ul class="plc_weintek_ul_style1">
                                <li>��������: 283�226�36 ��</li>
                                <li>��������: ���������� ������</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="block_item_info">
                                    <span class="link_advanced_search block_item_info-btn" idm="HF-09"
                                          onclick="show_backup_call(6, &quot;HF-09&quot;)">������
                                        ����</span>
                        </div>
                    </div>
                </div>


                <div class="block_item_photo">
                    <div class="blockofcols_row">
                        <div class="col-4">
                            <a data-fancybox="gallery2" href="/images/fam/HF-09/HF-09_1_lg.jpg">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-09/HF-09_1_md.jpg')"></div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a data-fancybox="gallery2" href="/images/fam/HF-09/HF-09_4_lg.jpg">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-09/HF-09_4new.jpg')"></div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a data-fancybox="gallery2" href="/images/fam/HF-09/HF-09_5_lg.jpg">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-09/HF-09_5_new.jpg')"></div>
                            </a>
                        </div>
                    </div>
                    <div class="blockofcols_row">
                        <div class="col-6">
                            <a data-fancybox="gallery2" href="/images/fam/HF-09/HF-09_2_lg.jpg">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-09/HF-09_2_md.jpg')"></div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a data-fancybox="gallery2" href="/images/fam/HF-09/HF-09_3_lg.jpg">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-09/HF-09_3_md.jpg')"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="block_item_dim-title">�����</div>

                <div>
                    <div class="blockofcols_row">
                        <div class="col-12">
                            <a data-fancybox="dim" href="/images/fam/HF-09/HF-09_6_lg.jpg">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-09/HF-09_6_lg.jpg')"></div>
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

   
        <?
    $accessories = ob_get_contents();
    ob_end_clean();


    $komplects = '<!-- nosearch --><div id="tabs-5">
  <div class=connectors>
  <h2>������������� ' . $types1 . ' ' . $r->model . '</h2><br />' . $accessories . '<br /><br /><br />
  </div></div><!-- /nosearch -->';
}



if ($r->diagonal >= 12 and $r->diagonal < 13 ) {
    ob_start();
    ?>
    <div class="blockofcols_container">
        <div class="col-12">
            <div class="block_item" style="    margin-right: 15PX;">
                <div class="block_item_title">�����
                    ��� <? if ($r->type == 'monitor_cloud_hmi'): ?>������ ��������� ���������� <? else: ?>������� ��������� <? endif; ?>
                    Weintek 12" HF-12
                </div>
                <div class="blockofcols_row" style="margin-bottom:25px;">
                    <div class="col-9">
                        <div class="block_item_text">
                            <ul class="plc_weintek_ul_style1">
                                <li>��������: 336�289�60 ��</li>
                                <li>��������: ���������� ������</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="block_item_info">
                                    <span class="link_advanced_search block_item_info-btn" idm="HF-12"
                                          onclick="show_backup_call(6, &quot;HF-12&quot;)">������
                                        ����</span>
                        </div>
                    </div>
                </div>


                <div class="block_item_photo">
                    <div class="blockofcols_row">
                    <div class="col-4">
                            <a data-fancybox="gallery2" href="/images/fam/HF-09/HF-09_4_lg.jpg">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-09/HF-09_4new.jpg')"></div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a data-fancybox="gallery2" href="/images/fam/HF-12/HF-12_1.png">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-12/HF-12_1.png')"></div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a data-fancybox="gallery2" href="/images/fam/HF-12/HF-12_2.png">
                                <div class="block_item-img"
                                     style="background-image:url('/images/fam/HF-12/HF-12_2.png')"></div>
                            </a>
                        </div>
                       
                    </div>
                  
                </div>
                

            </div>
        </div>
    </div>

    <? 
   
    $accessories = ob_get_contents();
    ob_end_clean();


    $komplects = '<!-- nosearch --><div id="tabs-5">
  <div class=connectors>
  <h2>������������� ' . $types1 . ' ' . $r->model . '</h2><br />' . $accessories . '<br /><br /><br />
  </div></div><!-- /nosearch -->';
}




ob_start();

?>
    <div id='tabs-4'>
        <div class=connectors>
            <h2>����� ��� ������ � <?= $typ2 ?> <?= $r->model ?></h2>
        </div>
        <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
            <tr>
                <td>
                    <div class=down_h> ������������</div>
                </td>
                <td width=100>
                    <div class=down_h> ����, ������</div>
                </td>
                <td>
                    <div class=down_h> ������</div>
                </td>
            </tr>
            <?= $soft5 ?>
            <?= $soft6 ?>
            <?= $soft10 ?>

            <?= $soft1 ?>
            <?= $soft2 ?>
            <?= $soft2_2 ?>

            <?= $soft3 ?>
            <?= $soft__codesys ?>
            <?= $soft__remoteio ?>
            <?= $soft9 ?>
            <?= $soft11 ?>
        </table>
        <br/> <br/>
    </div>
<? if (($r->diagonal >= 9 and $r->diagonal < 10) || ($r->diagonal == 7) || ($r->diagonal >= 12 and $r->diagonal < 13)): ?>
    <?= $komplects;?>
<? endif; ?>

    </div><br/><br/>
    </div>


<? $prices_out .= ob_get_clean();


$prices_out .= "<br><br>";
//-----------------end content
//$template_file = 'head.html';
$template_file = 'head_canonical.html';

$head = head($template_file, $title, $description, $keywords);


//$head = head($template_file,$TITLE,$DESCRIPTION,$KEYWORDS);
$head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);

echo $head;
?>
    <div id="mes_backgr"></div>
    <div id="body_cont">
<? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
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
//temp1();
//left_menu();
/*
  echo "<br><br><div class=filter_case> <div class=filter>
  <center>������ ���������</center><br>
  ����� 6000i<br>
  ��������� 7\"<br>
  c SD ������
  c Ethernet
  � VNC ��������
  c ������. ��������<br>";
 */
add_to_basket();
popup_messages();
temp2();
?>
    <style>
        .separator {
            height: 10px;
        }
    </style>
<?
echo "<article>";
echo $prices_out;
echo "</article>";


temp3();
?>