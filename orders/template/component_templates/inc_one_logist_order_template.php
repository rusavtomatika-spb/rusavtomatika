<? if (isset($logistOrder)):?>
<tr id="tr_logist_order_id_<?= $logistOrder['id'] ?>">
    <td class="column-logist-order-id"><?= $logistOrder['id'] ?></td>
    <td class="column-logist-order-date">
        <div class="editable-cell "
             data-table="ord_logistic_orders"
             data-field-type="date-picker"
             data-row-id="<?= $logistOrder['id'] ?>" data-field-name="date">
            <?=$logistOrder['date']?>
        </div>
    </td>
    <td class="column-logist-order-vendor_addr">
        <div style="position: relative;">
                    <span class="choose_row_value">
                <?= $logistOrder['sender']['alias'] ?>
                [<?= $logistOrder['sender']['full_name'] ?>]
                    </span>

            <span
                    class="choose_row_button user-select_none"
                    data-popup-title="Выбрать"
                    data-fields="id, alias, full_name, address "
                    data-table="ord_vendor_addr"
                    data-parent-table="ord_logistic_orders"
                    data-parent-row-id="<?= $logistOrder['id'] ?>"
                    data-parent-field-name="sender_id"
                    data-field-name="id"
                    data-object-function="logistic_order"
                    data-function-name="ord_logistic_order_chosen"
                    data-order-id="<?= $logistOrder['order_id'] ?>"

            >...</span>
        </div>
    </td>
    <td class="column-logist-order-date">
        <div class="editable-cell "
             data-table="ord_logistic_orders"
             data-field-type="date-picker"
             data-row-id="<?= $logistOrder['id'] ?>" data-field-name="date_load">
            <?=$logistOrder['date_load']?>
        </div>
    </td>
    <td class="column-logist-order-type_of_cargo">
        <div class="editable-cell"
             data-table="ord_logistic_orders"
             data-field-type="input"
             data-row-id="<?= $logistOrder['id'] ?>"
             data-field-name="type_of_cargo"
        ><?= $logistOrder['type_of_cargo'] ?></div>
    </td>
    <td class="column-logist-order-brutto">
        <div class="editable-cell"
             data-table="ord_logistic_orders"
             data-field-type="input"
             data-row-id="<?= $logistOrder['id'] ?>"
             data-field-name="brutto"
        ><?= $logistOrder['brutto'] ?></div>
    </td>
    <td class="column-logist-order-boxes">
        <div class="editable-cell"
             data-table="ord_logistic_orders"
             data-field-type="input"
             data-row-id="<?= $logistOrder['id'] ?>"
             data-field-name="boxes"
        ><?= $logistOrder['boxes'] ?></div>
    </td>
    <td class="column-logist-order-boxes">
        <div class="editable-cell"
             data-table="ord_logistic_orders"
             data-field-type="input"
             data-row-id="<?= $logistOrder['id'] ?>"
             data-field-name="invoice_id"
        ><?= $logistOrder['invoice_id'] ?></div>
    </td>
    <td class="column-logist-order-sum">
        <div class="editable-cell"
             data-table="ord_logistic_orders"
             data-field-type="input"
             data-row-id="<?= $logistOrder['id'] ?>"
             data-field-name="sum"
        ><?= $logistOrder['sum'] ?></div>
    </td>
    <td class="column-logist-order-currency">
        <div class="editable-cell"
             data-table="ord_logistic_orders"
             data-field-type="select"
             data-row-id="<?= $logistOrder['id'] ?>"
             data-field-name="currency"
             data-all-options="USD,RUR,EUR"><?= $logistOrder['currency'] ?>
        </div>
    </td>
    <td class="column-logist-order-date_payment">
        <div class="editable-cell "
             data-table="ord_logistic_orders"
             data-field-type="date-picker"
             data-row-id="<?= $logistOrder['id'] ?>" data-field-name="date_payment">
            <?=$logistOrder['date_payment']?>
        </div>
    </td>
    <td class="column-logist-order-actions">
                <span title="Удалить заявку логистам" class="btn2 table_all_orders__button_delete_logist_order"
                      data-table="ord_logistic_orders"
                      data-order-id="<?= $logistOrder['order_id'] ?>"
                      data-row-id="<?= $logistOrder['id'] ?>"></span>
        <span title="Скачать заявку логистам как XLSX-файл"
              data-template-path="logist_orders"
              data-logist-order-id="<?= $logistOrder['id'] ?>"
              class="btn2 button__download_logist_order_xlsx"></span>

    </td>
</tr>
<? endif;