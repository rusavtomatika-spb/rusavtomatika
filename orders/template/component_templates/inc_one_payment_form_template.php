<?if(isset($payment_form)):?>
<tr id="tr_payment_form_id_<?= $payment_form['id'] ?>">
    <td class="column-paymentform-id"><?= $payment_form['id'] ?></td>
    <td class="column-paymentform-bank_account">
        <div style="position: relative;">
                    <span class="choose_row_value">
                <?= $payment_form['bank_account']['alias'] ?>
                [<?= $payment_form['bank_account']['co_name'] ?>]
                    </span>

            <span
                    class="choose_row_button user-select_none"
                    data-popup-title="Выбрать"
                    data-fields="id, alias, co_name, bank_name "
                    data-table="ord_bank_accounts"
                    data-parent-table="ord_payment_forms"
                    data-parent-row-id="<?= $payment_form['id'] ?>"
                    data-parent-field-name="bank_account_id"
                    data-field-name="id"
                    data-object-function="paymentforms"
                    data-function-name="ord_bank_accounts_chosen"
                    data-order-id="<?= $payment_form['order_id'] ?>"

            >...</span>
        </div>
    </td>
    <td class="column-paymentform-vendor_addr">
        <div style="position: relative;">

                <span class="choose_row_value">
                <?= $payment_form['vendor_addr']['alias'] . " [" . $payment_form['vendor_addr']['full_name'] . "]" ?>
            </span>
            <span
                    class="choose_row_button user-select_none xxx"
                    data-popup-title="Выбрать"
                    data-fields="id, alias, full_name, address "
                    data-table="ord_vendor_addr"
                    data-parent-table="ord_payment_forms"
                    data-parent-row-id="<?= $payment_form['id'] ?>"
                    data-parent-field-name="vendor_addr_id"
                    data-field-name="id"
                    data-object-function="paymentforms"
                    data-function-name="ord_vendor_addr_chosen"
                    data-order-id="<?= $payment_form['order_id'] ?>"

            >...</span>
        </div>
    </td>
    <td class="column-paymentform-sum">
        <div class="editable-cell"
             data-table="ord_payment_forms"
             data-field-type="input"
             data-row-id="<?= $payment_form['id'] ?>"
             data-field-name="sum"
        ><?= $payment_form['sum'] ?></div>
    </td>
    <td class="column-paymentform-currency">
        <div class="editable-cell"
             data-table="ord_payment_forms"
             data-field-type="select"
             data-row-id="<?= $payment_form['id'] ?>"
             data-field-name="currency"
             data-all-options="USD,RUR,EUR"><?= $payment_form['currency'] ?>
        </div>
    </td>
    <td class="column-paymentform-comment">
        <div title="<?= $payment_form['comment'] ?>"
             class="editable-cell description"
             data-table="ord_payment_forms"
             data-field-type="textarea"
             data-row-id="<?= $payment_form['id'] ?>"
             data-field-name="comment"><?= $payment_form['comment'] ?></div>
    </td>
    <td class="column-paymentform-actions">
                <span title="Удалить платежную форму" class="btn2 table_all_orders__button_delete_paymentform"
                      data-table="ord_payment_forms"
                      data-order-id="<?= $payment_form['order_id'] ?>"
                      data-row-id="<?= $payment_form['id'] ?>">

                        </span>

        <span title="Скачать платежную форму как XLSX-файл"
              data-template-path="payment_forms"
              data-payment-form-id="<?= $payment_form['id'] ?>"
              class="btn button__download_payment_form_xlsx"></span>

    </td>
</tr>
<?endif;