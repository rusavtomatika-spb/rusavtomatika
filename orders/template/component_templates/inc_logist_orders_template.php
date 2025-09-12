<?
// $arrLogistOrders;
?>
<table class="table">
    <tr>
        <th>
            <div class="h2">������ ��������</div>
        </th>
    </tr>
</table>
<table class="table table-logistorder">
    <thead>
    <tr>
        <th class="column-logistorder-id">ID</th>
        <th class="column-logistorder">����</th>
        <th class="column-logistorder">�����������</th>
        <th class="column-logistorder">���� ��������</th>
        <th class="column-logistorder">�������� �����</th>
        <th class="column-logistorder">��� ������</th>
        <th class="column-logistorder">�������</th>
        <th class="column-logistorder">������</th>
        <th class="column-logistorder">�����</th>
        <th class="column-logistorder">������</th>
        <th class="column-logistorder">���� ������</th>
        <th class="column-logistorder-actions">
            <span style="vertical-align: super;margin-right: 10px;">��������</span>
            <span title="�������� ������ ��������"
                  class="btn table_all_orders__button_add_logist_order"
                  data-order-id="<?= $order_id ?>"><i class="material-icons">playlist_add</i></span>
        </th>
    </tr>
    </thead>
    <tbody>
    <?
    if (isset($arrLogistOrders) and is_array($arrLogistOrders)) {


        foreach ($arrLogistOrders as $logistOrder) {
            include 'inc_one_logist_order_template.php';
        }
    }
    ?>
    </tbody>
</table>
