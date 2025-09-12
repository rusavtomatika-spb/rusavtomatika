<?php
define('MAIN_FILE_EXECUTED', true);
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
require_once 'model.php';
if ($_POST['action'] == 'loadProducts') {
    if (isset($_POST['arrFilter_period_month']) and $_POST['arrFilter_period_month'] >0){
        $num_columns = count($_POST['arrFilter_period_month']) + 4;
    }else{$num_columns = 16;}  
    
    $filter_activeness = "";
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

    $arrColumns = [
        'id' => 'ID',
        'brand' => 'Бренд',
        'active' => 'Активность',
        'name' => 'Наименование',
        'name_1c' => 'Наименование 1С',
        'reference_price' => 'Справочная цена',
        'min_price' => 'Минимальная цена',
        'reference_price_currency' => 'Валюта',
        'moq' => 'MOQ',
        'description' => 'Описание',
        'actions' => 'Действия',
        'comments' => 'Комментарии',
    ];
    $arResult['arrColumns'] = $arrColumns;
    $arResult['all_brands'] = model\get_all_brands();


    $i = 1;

    while ($row = mysqli_fetch_array($result)) {
        $arResult['products'][] = $row;
    }
    include_once $_SERVER['DOCUMENT_ROOT'].'/orders/template/component_templates/table_all_products.php';

}
