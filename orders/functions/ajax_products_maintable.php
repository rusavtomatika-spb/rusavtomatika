<?php
define('MAIN_FILE_EXECUTED', true);
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

//SELECT ord_products.*, ord_intents.id as ord_intents_id, ord_intents.date_modified, ord_intents.date_created, ord_intents.product_id, ord_intents.quantity FROM `ord_products`, `ord_intents` 
//ORDER BY `ord_products`.`id` ASC


require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
require_once 'model.php';
//echo $_SERVER['DOCUMENT_ROOT'].'/sc/lib_new_includes/inc_dbconnect.php';
if ($_POST['action'] == 'loadProducts') {
    
    if (isset($_POST['arrFilter_period_month']) and $_POST['arrFilter_period_month'] >0){
        $num_columns = count($_POST['arrFilter_period_month']) + 4;
    }else{$num_columns = 16;}  
    
    $filter_activeness = "";
    //var_dump($_POST["arrFilter_activeness"]);
    if (isset($_POST['arrFilter_activeness'])){        
        foreach ($_POST['arrFilter_activeness'] as $index=>$activeness) {
        if ( $index==0 and $activeness>=0) {$filter_activeness .= " active = '$activeness' ";}
        if ( $index==1 and $activeness>=0) {$filter_activeness .= " or active = '$activeness' ";}            
        }                
    }
    if ($filter_activeness != '') $where = " WHERE ($filter_activeness)";
    else if ($filter_activeness == '') $where = " WHERE (active='1')";
    
    if (isset($_POST['filter_product_name'])){
        $filter_product_name = strip_tags($_POST['filter_product_name']);
        $where .= " and ( `name` like '%".$filter_product_name."%') ";
    }
    
    $query = "SELECT * "
            . " FROM ord_products $where order by position;";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));

    $arrColumns = ['Part no.', 'U/P', 'MOQ'
        , 'Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек', 'Итого'];
    echo "<div class='stickytop'><div class='table-responsive'>
        <table class='table table1 sortable-table table-products'>
        <tr><th class='column-0'></th>";
    $i = 1;
    for ($x = 1; $x < 4; $x++) {
        echo "<th class='column-" . $x . "'>" . $arrColumns[$x - 1] . "</th>";
    }
    for ($x = 3; $x < 15; $x++) {
        if (!isset($_POST['arrFilter_period_month']) or in_array($x - 2, $_POST['arrFilter_period_month'])) {
            echo "<th class='column-" . $x . "'>{$arrColumns[$x]}</th>";
        }
    }
    for ($x = 15; $x < 16; $x++) {
        echo "<th class='column-" . $x . "'>{$arrColumns[$x]}</th>";
    }

    echo "</tr></tbody></table></div></div><div class='table-responsive'><table class='table table2 sortable-table table-products'>"
    . "<tbody><tr><td class='column-0'></td><td class='column-1'></td></tr></tbody><tbody class='sortable'>";
    $i = 1;

    while ($row = mysqli_fetch_array($result)) {        
        $brand = strtolower($row["brand"]);        
        if (!isset($_POST['arrFilter_brand']) or in_array($brand, $_POST['arrFilter_brand']) or $row["brand"] == '') {
            
            if ($row["row_type"] == 'product') {
                if (\model\check_comments_existance($row["id"])){
                    $comments_exist = " comments_exist ";
                }else{$comments_exist = "";}
                
                echo "<tr class='edit_row ";
                if ($row["active"]) {echo " active ";}
                else{echo " inactive ";}
                echo "' data-name='{$row["name"]}' ";
                echo " data-brand='{$row["brand"]}' ";
                echo " data-id='{$row["id"]}'>";
                echo "<td class='column-0'><span class='handle sortable-icon'></span></td>";
                echo "<td   class='column-1'>";
                echo "<span title='";
                if ($row["brand"])
                    echo $row["brand"] . " ";
                if ($row["name_1c"])
                    echo $row["name_1c"] . " ";
                if ($row["reference_price_currency"])
                    echo $row["reference_price"] . $row["reference_price_currency"] . " ";
                echo "' data-field-name='name'  data-edit-type='indirect' class='value'>{$row["name"]}</span><span class='product_comments $comments_exist'>C</span></td>";
                //echo "<td data-field-name='active'  data-edit-type='direct'>{$row["active"]}</td>";
                echo "<td><span class='value' data-field-name='reference_price' data-edit-type='direct'>{$row["reference_price"]}</span></td>";
                echo "<td><span class='value' data-field-name='moq' data-edit-type='direct'>{$row["moq"]}</span></td>";
                $intents = get_intents($row["id"]);
                $total_counter = 0;
                $total_visible_cols_counter = 0;
                for ($x = 3; $x < 15; $x++) {
                    if (isset($intents[$x - 2])) $total_counter += $intents[$x - 2]['quantity'];
                    if (!isset($_POST['arrFilter_period_month']) or in_array(($x - 2), $_POST['arrFilter_period_month'])) {
                        echo "<td>";
                        if (isset($intents[$x - 2]['id'])){$intent_id = " data-intent-id='{$intents[$x - 2]['id']}' ";}
                        else{$intent_id = " data-intent-id='0' ";}
                        echo "<span $intent_id data-month='" . ($x - 2) . "'  data-edit-type='edit_intent' class='value'>";
                        if (isset($intents[$x - 2]['quantity']) and $intents[$x - 2]['quantity'] > 0) {
                            echo $intents[$x - 2]['quantity'];
                            $total_visible_cols_counter += $intents[$x - 2]['quantity'];
                        }
                        echo "</span>";
                        if (isset($intents[$x - 2]['quantity'])) {
                            echo  "<span $intent_id data-brand='{$row["brand"]}'  data-month='" . ($x - 2) . "'  class='open_panel_of_orders'>...</span>";
                            
                        }
                        echo  "</td>";
                    }
                }
                echo "<td data-field-name='orders_Total' data-edit-type='noedit'>";
                if ($total_counter > 0) echo $total_counter;
                if ($total_visible_cols_counter >= 0 
                        and $total_visible_cols_counter != $total_counter) echo " (".$total_visible_cols_counter.")";
                echo "</td>";
                echo "</tr>";
            }else 
                if ($row["row_type"] == 'separator') {
                    echo "<tr data-id='{$row["id"]}'  class='edit_row separator' >";
                    echo "<td class='column-0'><span class='handle sortable-icon'></span></td>";
                    echo "<td colspan='$num_columns'>";
                    echo "<span data-field-name='name' data-edit-type='direct' class='value'>{$row["name"]}</span>";
                    echo "<span class='remove_item'></span>";
                    echo "</td>";                                        
                                                            
                    echo "</tr>";
                    
                }
        }
    }
    echo "</tbody></table></div>";
    ?><div id="ajax_result_popup_panel"></div><div id="ajax_result_popup_panel2"></div><?
}

function get_intents($product_id) {
    global $db;
    $out = array();
    $query = "SELECT * FROM `ord_intents` where product_id='$product_id'";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        $out[$row['month']]['id'] = $row['id'];
        $out[$row['month']]['quantity'] = $row['quantity'];
    }
    return $out;
}

//include '../assets/table_blank.php';

