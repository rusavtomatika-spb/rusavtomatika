<? if (!defined('PROLOG_INCLUDED')) exit; ?>

</main>
<!-- /maincontent -->

<script type="text/javascript" src="/js/vue.js"></script>
<script type="text/javascript" src="/js/axios.min.js"></script>
<script type="text/javascript" src="/js/vue-router.js"></script>
<script type="text/javascript" src="/js/vue-meta.min.js"></script>
<script type="text/javascript" src="/sc/popup_catalog_menu/popup_catalog_menu.js"></script>
<script type="text/javascript" src="/js/fancybox.umd.js"></script>
<!-- <script type="text/javascript" src="/documents/documents.js"></script> -->

<?


$RUPRODUCTS = "";
?>
<!--</td>  </tr></table>-->

<? include $_SERVER['DOCUMENT_ROOT'] . "/include/template/footer.php" ?>

</div> <!-- end main div -->

<? if ($_SERVER['HTTP_HOST'] != "www.rusavto.moisait.net" && $_SERVER['HTTP_HOST'] != "www.rusavtomatika.valovenko.tmweb.ru"): ?>
    <script src="//code.jivosite.com/widget.js" data-jv-id="gno75izSm3" async></script>
    <? /*?>
        <!-- BEGIN JIVOSITE CODE {literal} -->
        <script type="text/javascript">
            (function () {
                var widget_id = '9991';
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//code.jivosite.ru/script/widget/' + widget_id;
                var ss = document.getElementsByTagName('script')[0];
                ss.parentNode.insertBefore(s, ss);
            })();</script> <div id='jivo_copyright' style='display: none'>Модуль <a href='http://www.jivosite.ru' target='_blank'>онлайн консультант</a><br> работает на JivoSite</div>
        <!-- {/literal} END JIVOSITE CODE -->
        <?*/ ?>
<? endif; ?>
<?


$SEARCHFILD = '';
$PRICES = '';
$SMALL = '';
$EURPRODUCTS = '';

$query = "SELECT `name`,`price` FROM `ib_catalog_elements`;";
global $mysqli_db;
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса " . $query);
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);

        $SEARCHFILD .= '"' . $row['name'] . '",';
        $PRICES .= '"' . $row['price'] . '",';
    };
};

$query = "SELECT `model`,`model_fullname`,`s_name`,`brand`,`retail_price` FROM `products_all` WHERE `modification`<>'1' ;";
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);
        if ($row['brand'] == "Cincoze") {
            $SEARCHFILD .= '"' . $row['s_name'] . '",';
        } else {
            if ($row['model_fullname'] != '') {
                $SEARCHFILD .= '"' . $row['model_fullname'] . '",';
            } else {
                $SEARCHFILD .= '"' . $row['model'] . '",';
            }
        };
        $PRICES .= '"' . $row['retail_price'] . '",';
    }
};


$query = "SELECT `model`,`retail_price` FROM `controllers`;";
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);
        $SEARCHFILD .= '"' . $row['model'] . '",';
        $PRICES .= '"' . $row['retail_price'] . '",';
    };
};

$query = "SELECT `name`,`section_code` FROM `ib_catalog_elements` WHERE `active`='1';";
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса " . $query);
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);

        $SMALL .= '"Haiwell/' . $row['section_code'] . '/<b>' . $row['name'] . '</b>",';
    };
};

$query = "SELECT `model`,`s_name`,`brand`,`retail_price` FROM `products_all` WHERE  (`modification`<>'1') AND (`show_in_cat`='1');";
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);
        if ($row['brand'] == "Cincoze") {
            $SMALL .= '"' . $row['s_name'] . '",';
        } else {
            $SMALL .= '"' . $row['model'] . '",';
        }
    };
};

$query = "SELECT `model`,`retail_price` FROM `controllers` WHERE `model` NOT LIKE '%x%';";
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);

        $SMALL .= '"' . $row['model'] . '",';
    };
};


$query = "SELECT `model` FROM `products_all` WHERE `brand` IN ('eWON', '2N');";
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);

        $EURPRODUCTS .= '"' . $row['model'] . '",';
    };
};

$query = "SELECT `model`,`model_fullname` FROM `products_all` WHERE `brand`='Faraday' or `currency` = 'RUR';";
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);

        if ($row['model_fullname'] != '') {
            $RUPRODUCTS .= '"' . $row['model_fullname'] . '",';
        } else {
            $RUPRODUCTS .= '"' . $row['model'] . '",';
        }
    };
};

$query = "SELECT `model` FROM `controllers` WHERE `brand`='IECON';";
$query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
$j = mysqli_num_rows($query_result);
if ($j > 0) {
    for ($i = 1; $i <= $j; $i++) {
        $row = mysqli_fetch_assoc($query_result);

        $RUPRODUCTS .= '"' . $row['model'] . '",';
    };
};

$SEARCHFILD = substr($SEARCHFILD, 0, -1);
$PRICES = substr($PRICES, 0, -1);
$SMALL = substr($SMALL, 0, -1);
$EURPRODUCTS = substr($EURPRODUCTS, 0, -1);
$RUPRODUCTS = substr($RUPRODUCTS, 0, -1);
?>
<script type="text/javascript">

    var prices = [<? echo $PRICES; ?>];
    var models = [
        <? echo $SEARCHFILD; ?>
    ];
    var smodels = [
        <? echo $SMALL; ?>
    ];
    var eurproducts = [
        <? echo $EURPRODUCTS ?>
    ];

    var ruproducts = [
        <? echo $RUPRODUCTS ?>
    ];

</script>


<? //include $_SERVER['DOCUMENT_ROOT'] . "/sc/QRCode/lib_QRCode.php"; ?> <? /* с попапом  */ ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/sc/QRCode/lib_QRCode_for_agroprodmash2019.php"; ?>

<? include $_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_statistics.php";
//catchingHTTP_REFERER();
?>
<!-- youWatchedPanel start -->
<?php
youWatchedPanel::printItself();

?>

<!-- youWatchedPanel end -->
<!-- <?= "PHP_MAJOR_VERSION " . PHP_MAJOR_VERSION ?> -->
</div>
<?
/*
if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net') {
    $arguments = array(
        "component" => "catalog_toolbar",
        "template" => "default",
        "template_section_detail" => "default",
    );
    CoreApplication::include_component($arguments);
    CoreApplication::include_component(array("component"=> "form_require_price", "template" => "default",));
}
*/
CoreApplication::print_styles_including();
CoreApplication::print_scripts_including();
?>
<script src="/core/templates/rusavtomatika_adaptive/js/fixed-column2.js" type="text/javascript"></script>
</body>

</html>


<?


?>
