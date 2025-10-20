<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
//echo "PHP_MAJOR_VERSION " . PHP_MAJOR_VERSION;
//ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
//ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('admin', true);
define('PRODUCTS_ALL', true);
global $ftpConnectionID;
global $db_work;
$core_admin_path = $_SERVER['DOCUMENT_ROOT'] . '/admin/';
include $core_admin_path . 'template/header.php';
?><h1>Административная панель - Старый каталог PRODUCTS_ALL</h1><?
include $core_admin_path . 'products_all/menu.php';
include $core_admin_path . 'products_all/classes/functions.php';
file_put_contents( $core_admin_path . "products_all/error_log", "" );
/* * *************************************************************************** */
/* $db_work = new DBWORK();
  $db_work->show_tables(); */
$db_work = new DBWORK();
$result = $db_work->get_list_catalog_elements();

foreach ($result as $row) {
    $arrIndexProdut[] = $row["index"];
}
$comma_separated = implode(",", $arrIndexProdut);


?>
<script type="text/javascript" src="/js/vue.js"></script>
<script type="text/javascript" src="/js/axios.min.js"></script>
<h1>Список ЭЛЕМЕНТОВ</h1>
<div id="re_create_pic">

    <div class="document_container">
        <div class="btn btn_start_programm" v-on:click="start_re_create_pic()">Пересоздать все картинки (см. консоль)
        </div>
    </div>


<?
if (isset($_GET["message"])) {
    if ($_GET["success"]) {
        echo "<div class='success_message'>" . strip_tags(urldecode($_GET["message"])) . "</div>";
    } else
        echo "<div class='error_message'>" . strip_tags(urldecode($_GET["message"])) . "</div>";
}

if (isset($_GET["action"]) and isset($_GET["id"])) {
    if ($_GET["action"] == "delete_element") {
        $db_work = new DBWORK();
        $result = $db_work->delete_catalog_element(intval($_GET["id"]));
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    } elseif ($_GET["action"] == "move_up") {
        $db_work = new DBWORK();
        $result = $db_work->move_up_catalog_element(intval($_GET["id"]), $_GET["section_code"]);
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    } elseif ($_GET["action"] == "move_down") {
        $db_work = new DBWORK();
        $result = $db_work->move_down_catalog_element(intval($_GET["id"]), $_GET["section_code"]);
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    } elseif ($_GET["action"] == "set_position") {
        $db_work = new DBWORK();
        $result = $db_work->set_position_catalog_element(intval($_GET["id"]), intval($_GET["position"]));
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    }
}
if (isset($_GET["action"]) and $_GET["action"] == "recalculate_positions" and isset($_GET["section_code"]) and $_GET["section_code"] != "") {
    $db_work = new DBWORK();
    $result = $db_work->recalculate_positions_catalog_element($_GET["section_code"]);
    if ($result["success"] == true) {
        echo "<div class='success_message'>" . $result["message"] . "</div>";
    } else {
        echo "<div class='error_message'>" . $result["message"] . "</div>";
    }
    //header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
}


$db_work = new DBWORK();
if (isset($_GET["sort_by"])) {
    $result = $db_work->get_list_catalog_elements($_GET["sort_by"]);
} else {
    $result = $db_work->get_list_catalog_elements();
}

if (!empty($result)) {
    echo "<table id='list'>";

    echo "<colgroup>";
    echo "<col style='width:1%'>";
    echo "<col style='width:15%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "</colgroup>";
    echo "<tr>";
    echo "<th class='id td_center'><a class='";
    if (isset($_GET["sort_by"]) and $_GET["sort_by"] == "index") echo "sort_active";
    echo "' href='?sort_by=index'>id</a></th><th>Фото</th><th>Добавить фото</th><th><a class='";
    if (isset($_GET["sort_by"]) and $_GET["sort_by"] == "model") echo "sort_active";
    echo "' href='?sort_by=model'>Модель</a></th>";
    echo "<th>";
    echo "<a class='";
    if (isset($_GET["sort_by"]) and $_GET["sort_by"] == "brand")
        echo "sort_active";
    echo "' href='?sort_by=brand'>Бренд</a>";
    echo "</th>";
    echo "<th>";
    echo "<a class='";
    if (isset($_GET["sort_by"]) and $_GET["sort_by"] == "type")
        echo "sort_active";
    echo "' href='?sort_by=type'>Тип</a>";
    echo "</th>"
        . "<th class='td_center' style='width:5%;'>Цена</th>"
        . "<th class='td_center' style='width:5%;'>Показ цены</th>"

        . "<th class='td_center'>Действия</th>";
    echo "</tr>";
    $counter = 0;
    if (is_array($result)) {
        connectToFTP();
        foreach ($result as $row) {

//            $imagesHtml = getImagesHtml($row);
            $imagesHtml = getRemoteFTPImagesHtml($row);

            $counter++;
            if (isset($row['section_code']) && $row['section_code']) {
                $sub_section = "sub_section";
                $mark = "-> ";
            } else {
                $sub_section = "";
                $mark = "";
            }
            if (isset($_GET["element_id"]) and isset($row["id"]) and $_GET["element_id"] == $row["id"]):
                echo "<tr class='tr_green'>";
            else:
                echo "<tr>";
            endif;
            echo "<td class='id td_center'>";
            echo '<a class="" href="/admin/products_all/edit_element.php?index=' . $row['index'] . '">' . $row['index'] . '</a>';
            echo "</td>";
            echo "<td class='td_right'>";
            echo '<span class="list_of_images" id="product_id_' . $row['index'] . '">' . $imagesHtml . '    </span><span v-on:click="create_webp(' . $row['index'] . ')" class="button_create_webp" id="btn_product_id_' . $row['index'] . '">wbp</span>';
            echo "</td>";
            echo "<td>";
            echo '<form name="formUploadImage" method="post" enctype="multipart/form-data"><input type="hidden" name="product_id" value="' . $row['index'] . '"><input type="file" autocomplete="off" name="picture" multiple><br><input disabled="disabled" autocomplete="off" type="submit" value="Загрузить"></form>';
            echo "</td>";
            echo "<td class='name'>";
            echo '<a class="" href="/admin/products_all/edit_element.php?index=' . $row['index'] . '">' . $row['model'] . '</a>';
            echo "</td>";
            echo "<td class='code'>";
            echo $row['brand'];
            echo "</td>";
            echo "<td class='td_left price'>";
            echo $row['type'];
            echo "</td>";
            echo "<td class='td_left price'>";
            echo $row['retail_price'];
            echo "</td>";
            echo "<td class='td_left price'>";
            echo $row['retail_price_hide'];
            echo "</td>";
            echo "<td class='td_center'>";
            echo '<a class="" href="/admin/products_all/edit_element.php?index=' . $row['index'] . '"><button style="padding:3px 5px;;cursor: pointer;background:#44BB6E;color:white;border:solid 1px #44BB6E;">Редактировать</button></a>&nbsp;&nbsp;&nbsp;';

            if (isset($_GET["section_code"])) {
                echo '<a class="check_delete" href="?action=delete_element&section_code=' . $_GET["section_code"] . '&id=' . $row['index'] . '"><button style="padding:3px 5px;;cursor: pointer;">Удалить</button></a>';
            } else {
                echo '<a class="check_delete" href="?action=delete_element&&id=' . $row['index'] . '"><button style="padding:3px 5px;;cursor: pointer;background:red;color:white;border:solid 1px red;">Удалить</button></a>';
            }
            echo "</td>";

            echo "</tr>";
        }

        disconnectFTP();

    } else {
        echo "<tr>";
        echo "<th colspan='8'> - пусто - </th>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<th colspan='8' class='td_center'> Всего $counter строк </th>";
    echo "</tr>";
    echo "</table>";
}
?>
</div>
<style>
    .btn_start_programm {
        color: white;
        background: #44bb6e;
        padding: 10px 20px;
        font-size: 17px;
        display: inline-block;
        line-height: 17px;
        cursor: pointer;
        margin: 0px 0px 17px 0px;
    }

    .btn_start_programm__small {
        margin-top: 20px;
        color: white;
        background: grey;
        padding: 5px 10px;
        font-size: 15px;
        display: inline-block;
        cursor: pointer;
    }

    .document_container {
        text-align: center;
    }

    .button_create_webp{display: inline-block;
    padding: 3px 5px;
        color: white;
        background: #44bb6e;
        cursor: pointer;
    }

</style>
<script>
    new Vue({
        el: '#re_create_pic',
        data: {
            product_id: [<?=$comma_separated;?>], <?/*=$comma_separated;*/?>
            re_create_product_pics: true
        },
        methods: {
            create_webp: function (product_id) {
                axios.post('/admin/products_all/ajax_products_all.php', { product_id: product_id, re_create_product_pics: true }).then((response) => {
                    console.log(product_id);
                    console.log("p264");
                    $('#btn_product_id_'+product_id).after("<div style='font-size:9px'>*"+response.data.toString()+"*</div>");
                    console.log(response.data);
                        console.log("p267");
                    if (this.product_id.length > 0) {
                        console.log(this.product_id.length);
                        console.log("p270");
                    } else {
                        console.log("finish");
                        return;
                    }
                });
            },
            start_re_create_pic: function () {
                console.log(this.product_id);
                console.log("p279");

                product_id = this.product_id.shift();
                ;
                re_create_product_pics = this.re_create_product_pics;
                password = this.password;
                axios.post('/admin/products_all/ajax_products_all.php', {
                    product_id,
                    re_create_product_pics
                }).then((response) => {

                    console.log(response.data+"p287");

                    if (this.product_id.length > 0) {
                        console.log(this.product_id.length+"p290");
                        this.start_re_create_pic();
                    } else {
                        console.log("finish");
                        return;
                    }

                });

            },
        }
    });
</script>
<?

/* * *************************************************************************** */
include $core_admin_path . 'template/footer.php';
?>
