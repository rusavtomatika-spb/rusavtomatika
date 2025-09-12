<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/sc/lib_new_includes/inc_dbconnect.php';
    //require_once $_SERVER['DOCUMENT_ROOT'].'/orders/functions/model.php';

    switch ($_POST['action']) {
        case 'get_form':
//            $product = \model\get_product($_POST['id']);
//            $arrCurrencies = \model\get_reference_price_currencies();
//            $arrBrands = \model\get_all_brands();
            include __DIR__."/templates/template_universal_edit_form.php";
            $status = 1;
            break;
        default:
            break;
    }
    //include __DIR__."/templates/template_universal_edit_form.php";
    $out["form"] = iconv("windows-1251", "utf-8", ob_get_contents());
    $out["status"] = 1;
    ob_end_clean();
    echo json_encode($out);
    exit;
}
/**********************************************************************************************************************/
/**********************************************************************************************************************/
/**********************************************************************************************************************/


$form = new ComponentUniversalEditForm(1);
class ComponentUniversalEditForm
{
    private $instance_id;

    function __construct($id = 0)
    {
        if ($id > 0) $this->instance_id = $id;
        else $this->instance_id = rand();
        ?>
        <div id="universal_edit_form_id_<?= $this->instance_id ?>" class="universal_edit_form">!!!</div><?
        ?>
        <script src="/js/jquery-1.10.2.js"></script>
        <script src="/js/jquery-ui.js"></script>
        <script>
            <?
            include __DIR__ . "/js/universal_edit_form.js";
            ?>
            const data = {
                "action": "get_form",
                "table_name": "ord_products",
            };
            universal_edit_form.init(<?=$this->instance_id?>, data);
        </script><?

    }
}