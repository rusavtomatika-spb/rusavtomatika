<?php

namespace model;
function get_product($product_id)
{
    global $db;
    $query = "SELECT * FROM ord_products WHERE id='$product_id' ";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return mysqli_fetch_array($result);
}

function get_product_by_name($product_name)
{
    global $db;
    $query = "SELECT * FROM `ord_products` WHERE `name`='$product_name'; ";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $arResult = mysqli_fetch_array($result);
    array_walk_recursive($arResult, function (&$value, $key) {
        $value = iconv("CP1251", "UTF-8", $value);
    });
    return $arResult;
}


function get_order($order_id)
{
    global $db;
    $row = false;
    if (isset($order_id) and $order_id > 0) {
        $query = "SELECT *,"
            . "DATE_FORMAT(date_created, '%d-%m-%Y %H:%i:%s') as time, "
            . "DATE_FORMAT(date_modified, '%d-%m-%Y %H:%i:%s') as time_modified "
            . "FROM `ord_orders` WHERE id = '$order_id'";
        $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
        $row = mysqli_fetch_array($result);
//        foreach ($row as $key=>$val){
//            $row[$key] = mb_convert_encoding($val, 'UTF-8', 'windows-1251');
//        }
        $order_items = get_order_items($row['id']);
        if (isset($order_items['products'])) $row['items'] = $order_items['products'];
        if (isset($order_items['sum'])) $row['sum'] = $order_items['sum'];
        if (isset($order_items['quantity'])) $row['quantity'] = $order_items['quantity'];
    }
    return $row;
}

function get_orders($params = array())
{
    global $db;
    if (isset($params) and count($params) > 0) {
        $month = intval($params['month']);
        $brand = trim(strip_tags($params['brand']));
        $query = "SELECT *,"
            . "DATE_FORMAT(date_created, '%d-%m-%Y %H:%i:%s') as time, "
            . "DATE_FORMAT(date_modified, '%d-%m-%Y %H:%i:%s') as time_modified "
            . "FROM `ord_orders` WHERE month = '$month' and brand = '$brand' ORDER BY `id` DESC";
    } else {
        $query = "SELECT *,"
            . "DATE_FORMAT(date_created, '%d-%m-%Y %H:%i:%s') as time, "
            . "DATE_FORMAT(date_modified, '%d-%m-%Y %H:%i:%s') as time_modified "
            . "FROM `ord_orders` ORDER BY `id` DESC";
    }


    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        $order_items = get_order_items($row['id']);
        $row['items'] = $order_items['products'];
        $row['payment_forms'] = get_order_payment_forms($row['id']);
        $row['sum'] = $order_items['sum'];
        $row['quantity'] = $order_items['quantity'];
        $row['last_comment'] = get_last_comment_text($row['id'], 'ord_orders');
        $out[] = $row;
    }
    $out['all_brands'] = get_all_brands();
    return $out;

}

function get_last_comment_text($ext_id, $ext_table)
{
    global $db;
    $row = NULL;
    $query = "SELECT "
        . " text "
        . "FROM ord_comments "
        . "WHERE "
        . "ext_id='$ext_id' "
        . "and ext_table='$ext_table' "
        . "order by `date_creating` DESC LIMIT 1";

    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    return $row["text"];
}

function get_logist_orders_html($order_id)
{
    $arrLogistOrders = get_rows_by_condition('ord_logistic_orders'," `order_id` = '$order_id' order by id desc ");
    // aad info about senders
    foreach ($arrLogistOrders as $key => $logistOrder){
        if($logistOrder['sender_id']>0){
            $arrLogistOrders[$key]['sender'] = get_row_by_id('ord_vendor_addr',$logistOrder['sender_id']);
        }
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/orders/template/component_templates/inc_logist_orders_template.php';
}

function get_order_payment_forms_html($order_id)
{
    $arrPaymentForms = get_order_payment_forms($order_id);
    include $_SERVER['DOCUMENT_ROOT'] . '/orders/template/component_templates/inc_payment_forms_template.php';
}
function get_one_logist_order_html($logist_order_id)
{
    $logistOrder = get_row_by_id('ord_logistic_orders',$logist_order_id);
    include $_SERVER['DOCUMENT_ROOT'] . '/orders/template/component_templates/inc_one_logist_order_template.php';
}
function get_one_order_payment_form_html($payment_form_id)
{
    $payment_form = get_order_payment_form_by_id($payment_form_id);
    include $_SERVER['DOCUMENT_ROOT'] . '/orders/template/component_templates/inc_one_payment_form_template.php';
}
function get_order_payment_form_by_id($payment_form_id)
{
    global $db;
    $query = "SELECT * FROM `ord_payment_forms` WHERE `id` = '$payment_form_id' limit 1";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
        if ($row['bank_account_id'] > 0) {
            $row['bank_account'] = get_row_by_id('ord_bank_accounts', $row['bank_account_id']);
        }
        if ($row['vendor_addr_id'] > 0) {
            $row['vendor_addr'] = get_row_by_id('ord_vendor_addr', $row['vendor_addr_id']);
        }
    return $row;
}
function get_order_payment_forms($order_id)
{
    global $db;
    $out = array();
    $query = "SELECT * FROM `ord_payment_forms` WHERE `order_id` = '$order_id' order by id desc";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        if ($row['bank_account_id'] > 0) {
            $row['bank_account'] = get_row_by_id('ord_bank_accounts', $row['bank_account_id']);
        }
        if ($row['vendor_addr_id'] > 0) {
            $row['vendor_addr'] = get_row_by_id('ord_vendor_addr', $row['vendor_addr_id']);
        }
        $out[] = $row;
    }
    mysqli_free_result($result);
    return $out;
}


function get_order_items($order_id)
{
    global $db;
    $out = array();
    $query = "SELECT * FROM `ord_order_items` WHERE `order_id` = '$order_id'";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $row_counter = 0;
    $quantity_counter = 0;
    $sum_counter = 0;
    while ($row = mysqli_fetch_array($result)) {
        $row_counter++;
        $product = get_product($row['product_id']);
        foreach ($product as $key=>$val){
            $encoding = mb_detect_encoding($val);
            if ($encoding != 'UTF-8'){
                    $product[$key] = mb_convert_encoding($val, 'UTF-8', 'windows-1251');
            }
        }
        $row['product'] = $product;
        $out['products'][] = $row;
        $sum_counter += $row['quantity'] * $row['price'];
        $quantity_counter += $row['quantity'];
    }
    if ($row_counter > 0) {
        $out['sum'] = $sum_counter;
        $out['quantity'] = $quantity_counter;
    }

    return $out;
}

function get_reference_price_currencies()
{
    global $db;
    $query = "SHOW COLUMNS FROM `ord_products` WHERE Field = 'reference_price_currency'";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $value = mysqli_fetch_array($result);
    preg_match("/^enum\(\'(.*)\'\)$/", $value['Type'], $matches);
    $enum = explode("','", $matches[1]);
    return $enum;
}

function get_all_brands()
{
    global $db;
    $query = "select `brand` FROM `ord_products` group by `brand`";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        $out[] = $row['brand'];
    }
    return $out;
}

function get_all_html_invoices_by_order_id($order_id)
{
    if ($order_id > 0) {
        $invoices = \model\get_rows_by_condition('ord_invoices', " order_id='$order_id' ");
        if (count($invoices) > 0) {
            foreach ($invoices as $invoice) {
                ?>
                <tr>
                    <td class="column-invoice">
                        <?= $invoice['id'] ?> (<?= $invoice['date'] ?>)
                    </td>
                    <td class="column-invoice-name">
                        <div class="editable-cell"
                             data-table="ord_invoices"
                             data-field-type="input"
                             data-row-id="<?= $invoice['id'] ?>"
                             data-field-name="name"><?= $invoice['name'] ?>
                        </div>
                    </td>
                    <td class="column-invoice-status">
                        <div class="editable-cell"
                             data-table="ord_invoices"
                             data-field-type="input"
                             data-row-id="<?= $invoice['id'] ?>"
                             data-field-name="status"><?= $invoice['status'] ?>
                        </div>
                    </td>
                    <td class="column-invoice-file"><a href="<?= $invoice['file'] ?>"
                                                       target="_blank"><?= $invoice['file'] ?></a></td>
                    <td class="column-invoice-comment">
                        <div class="editable-cell"
                             data-table="ord_invoices"
                             data-field-type="textarea"
                             data-row-id="<?= $invoice['id'] ?>"
                             data-field-name="comment"><?= $invoice['comment'] ?>
                        </div>
                    </td>
                    <td class="column-invoice-actions">
                        <span title="Удалить инвойс"
                              class="btn table_all_orders__button_delete_invoice"
                              data-table="ord_invoices"
                              data-order-id="<?= $order_id ?>"
                              data-row-id="<?= $invoice['id'] ?>">
                            <i class="material-icons">delete_forever</i>
                        </span>
                    </td>
                </tr>
                <?
            }
        } else {
            ?>
            <tr>
                <td colspan="5">
                    Инвойсов пока нет
                </td>
            </tr>
            <?
        }
    }
}

function get_rows_by_condition($table, $condition, $fields = '*')
{
    // 7 Сами отправят до UAB Unigela
    global $db;
    $out = array();
    $query = "SELECT $fields FROM `$table` WHERE $condition ";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            foreach ($row as $key => $field){
                if (mb_detect_encoding($field) != 'UTF-8'){
                    //echo $row['id']."!!!";
                    $field = iconv("windows-1251", "UTF-8//IGNORE", $field);
                    $row[$key] = $field;
                    //echo $key."!!!".$field;
                }
            }

            $out[] = $row;
        }
    return $out;
}


function add_new_order()
{
    $arrParameters['table'] = 'ord_orders';
    $arrParameters['fields']['date_created'] = date('Y-m-d H:i:s');
    $arrParameters['fields']['date_modified'] = '';
    $arrParameters['fields']['month'] = date('m');
    $arrParameters['fields']['year'] = date('Y');
    $arrParameters['fields']['brand'] = '';
    $arrParameters['fields']['description'] = '';
    $arrParameters['fields']['status'] = '';
    return add_row($arrParameters);
}

function add_row($arrParameters)
{
    //$arrParameters['table']
    //$arrParameters['fields']['field_name']

    global $db;
    $constructor_fields = '';
    $constructor_values = '';
    foreach ($arrParameters['fields'] as $key => $value) {
        if (mb_detect_encoding($value) == 'UTF-8') {
            $value = iconv("utf-8", "windows-1251", $value);
        };
        $constructor_fields .= $key . ",";
        if ($value == 'NOW()')
        {
            $constructor_values .= " " . $value . " ,";
        }
        else
            {
                $constructor_values .= "'" . $value . "',";
            }
    }

    $constructor_fields = trim($constructor_fields, ',');
    $constructor_values = trim($constructor_values, ',');
    $query = "INSERT INTO {$arrParameters['table']}($constructor_fields) VALUES($constructor_values);";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return mysqli_insert_id($db);
}


function delete_row($table_name, $id)
{
    global $db;
    echo $query = "DELETE FROM `$table_name` WHERE `id`='$id'; ";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $affected_rows = mysqli_affected_rows($db);
    mysqli_free_result($result);
    return $affected_rows;
}

function delete_rows_by_condition($table_name, $condition)
{
    global $db;
    $query = "DELETE FROM `$table_name` $condition";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $affected_rows = mysqli_affected_rows($db);
    return $affected_rows;

}

function delete_separator($id)
{
    global $db;
    $query = "DELETE FROM `ord_products` WHERE id='$id' LIMIT 1";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return $result;
}

function check_comments_existance($product_id)
{
    global $db;
    $query = "SELECT Count(id) as result FROM `ord_comments` WHERE ext_id = '$product_id' and ext_table='ord_products';";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    //var_dump($row['result']);
    return $row['result'];
}


function get_row_by_id($table, $id)
{
    global $db;
    $query = "SELECT * FROM `$table` WHERE id = '$id';";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $row = mysqli_fetch_array($result);
    //var_dump($row);
    return $row;
}

function save_cell($table_name, $id, $field_name, $value)
{
    if (mb_detect_encoding($value) == 'UTF-8') {
        $value = iconv("utf-8", "windows-1251", $value);
    };

    global $db;
    $query = "UPDATE $table_name SET $field_name='$value' WHERE id = '$id';";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    $affected_rows = mysqli_affected_rows($db);
    return $affected_rows;
}


