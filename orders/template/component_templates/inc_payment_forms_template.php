<?
// $arrPaymentForms;
?>
<table class="table">
    <tr>
        <th>
            <div class="h2">��������� �����</div>
        </th>
    </tr>
</table>
<table class="table table-payment_form">
    <thead>
    <tr>
        <th class="column-paymentform-id">ID</th>
        <th class="column-paymentform-bank_account">���� �������</th>
        <th class="column-paymentform-vendor_addr">����� �������</th>
        <th class="column-paymentform-sum">�����</th>
        <th class="column-paymentform-currency">������</th>
        <th class="column-paymentform-comment">�������</th>
        <th class="column-paymentform-actions">
            <span style="vertical-align: super;margin-right: 10px;">��������</span>
            <span title="�������� ��������� �����"
                  class="btn table_all_orders__button_add_payment_form"
                  data-order-id="<?= $order_id ?>"><i class="material-icons">playlist_add</i></span>
        </th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($arrPaymentForms as $payment_form) { include 'inc_one_payment_form_template.php';} ?>
    </tbody>
</table>
