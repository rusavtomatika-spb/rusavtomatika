<?
define("bullshit", 1);
include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
database_connect();
function last_mode($file, $date = '') {
    if ($date != '') {
        $ver = date("c", strtotime($date));
    } else {
        $f = $_SERVER['DOCUMENT_ROOT'] . $file;
        if (!preg_match('/\.php/i', $f)) {
            $f .= 'index.php';
        };
        if (file_exists($f)) {
            $ver = date("c", filemtime($f));
        } else {
            $f = preg_replace('/\/[^\/]\.php/i', '/index.php', $f);
            if (file_exists($f)) {
                $ver = date("c", filemtime($f));
            }
        };
    };
    return $ver;
}
$out = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
' . "
<url>
    <loc>http://{$_SERVER['SERVER_NAME']}/</loc>
    <lastmod>" . date('c') . "</lastmod>
    <priority>1</priority>
</url>
";
$first_lavel = array(
    '/about.php' => '',
    '/contacts.php' => '',
    '/advanced_search.php' => '',
    '/comparison.php' => '',
    '/forum/' => '',
    '/support.php' => '',
    '/download.php' => '',
    '/video.php' => '',
    '/antikrizisnoe-predlozhenie.php' => '',
    '/weintek/' => array('table' => 'products_all', 'name' => 'model', 'conditions' => array("`brand`='Weintek'", "`show_in_cat`='1'", "`parent`=''")),
    '/samkoon/' => array('table' => 'products_all', 'name' => 'model', 'conditions' => array("`brand`='Samkoon'", "`show_in_cat`='1'", "`parent`=''")),
    '/panelnie-computery/ifc/' => array('table' => 'products_all', 'name' => 'model', 'conditions' => array("`brand`='IFC'", "`show_in_cat`='1'", "`type`='panel_pc'", "`parent`=''")),
    '/panelnie-computery/aplex/' => array('table' => 'products_all', 'name' => 'model', 'conditions' => array("`brand`='APLEX'", "`show_in_cat`='1'", "`parent`=''")),
    '/cincoze/' => array('table' => 'products_all', 'name' => 's_name', 'conditions' => array("`brand`='Cincoze'", "`show_in_cat`='1'", "`parent`=''")),
    '/ewon/' => array('table' => 'products_all', 'name' => 'model', 'conditions' => array("`brand`='Cincoze'", "`show_in_cat`='1'", "`parent`=''")),
    '/promyshlennye-kompyutery-box-pc/' => array('table' => 'products_all', 'name' => 'model', 'conditions' => array("`brand`='IFC'", "`show_in_cat`='1'", "`type`='box-pc'", "`parent`=''")),
    '/monitors/' => array('table' => 'products_all', 'name' => 'model', 'conditions' => array("`brand`='IFC'", "`show_in_cat`='1'", "`type`='monitor'", "`parent`=''")),
//Это те, где надо выбирать из таблиц
    '/plc/yottacontrol/' => array('table' => 'controllers', 'name' => 'model', 'conditions' => array("`brand`='Yottacontrol'", "`show_in_cat`='1'", "'parent'<>''")),
    '/bloki-pitaniya/faraday/' => array('table' => 'products_all', 'name' => 's_name', 'conditions' => array("`brand`='Cincoze'", "`show_in_cat`='1'", "`parent`=''")),
    '/news.php' => array('table' => 'news', 'name' => 'sys_name', 'conditions' => array("`show`='1'")),
    '/articles/' => array('table' => 'articles', 'name' => 'sys_name', 'conditions' => array("`show`='1'")),
    '/mqtt/' => '',
    '/mqtt/demo.php' => '',
    '/easyaccess20.php' => '',
    '/weintek-stavnenie-seriy.php' => '',
    '/modules/EBM-A.php' => '',
    '/HMI-android.php' => ''
);
$second_lavel[weintek] = array(
    '/weintek/series_MT8000iE.php' => '',
    '/weintek/series_MT8000XE.php' => '',
    '/weintek/series_MT8000XE.php' => '',
    '/weintek/series_eMT3000.php' => '',
    '/weintek/series_eMT600.php' => '',
    '/weintek/series_MT600.php' => '',
    '/weintek/series_MT6000i.php' => '',
    '/weintek/series_MT8000i.php' => '',
    '/weintek/mTV-100.php' => '',
    '/weintek/CloudHMI.php' => ''
);
$second_lavel[ifc] = array(
    '/panelnie-computery/ifc/RF.php' => '',
    '/panelnie-computery/ifc/i3.php' => ''
);
while (list($key, $val) = each($first_lavel)) {
    $current_lastmod = last_mode($key, '');
    if ($current_lastmod == "")
        $current_lastmod = date("Y-m-d") . "T09:30:42+03:00"; // "2017-07-07T09:58:03+03:00";
    $out .= "
<url>
    <loc>https://{$_SERVER['SERVER_NAME']}{$key}</loc>
    <lastmod>" . $current_lastmod . "</lastmod>
    <priority>0.9</priority>
</url>
";
    if (is_array($val)) {
        $folder = str_replace('.php', '/', $key);
        $table = $val[table];
        $filds = array();
        $filds[] = $val[name];
        $conditions = implode(' AND ', $val[conditions]);
        if ((!empty($conditions)) AND ( !empty($val[name])) AND ( !empty($table))) {
            $conditions = 'WHERE ' . $conditions;
            if ($table == 'news' OR $table == 'articles') {
                $filds[] = 'date';
            }
            $f = "`" . implode("`, `", $filds) . '`';
            $query = "SELECT {$f} FROM `{$table}` {$conditions};";
            $res = mysql_query($query) or die(mysql_error());
            $count = mysql_num_rows($res);
            for ($i = 0; $i < $count; $i++) {
                $r = mysql_fetch_assoc($res);
                $out .= "
			<url>
				<loc>https://{$_SERVER['SERVER_NAME']}{$folder}{$r[$val[name]]}.php</loc>
				<lastmod>" . last_mode($key, $r['date']) . "</lastmod>
				<priority>0.8</priority>
			</url>
			";
            }
        }
    };
}
$out .= <<<EOD
</urlset>
EOD;
@header('Content-Type: application/xml; charset=win-1251');
print($out);
exit();
?>