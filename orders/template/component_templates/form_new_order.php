<?
$arrMonths = ['','���', '���', '���', '���', '���', '���', '���', '���', '���', '���', '���', '���'];
?>  
    

<form id="form_edit_orders" method="post" class="popupform"> 
    <input type="hidden" name="action" value="edit_orders" > 
    <input type="hidden" name="product_id" value="<?= $arrResult['product_id'] ?>" > 
    <input type="hidden" name="month" value="<?= $arrResult['month'] ?>" > 
    <input type="hidden" name="brand" value="<?= $arrResult['brand'] ?>" > 
    <input type="hidden" name="intent_id" value="<?= $arrResult['intent_id'] ?>" > 
    <div class="form_title">������ � ��������</div>
<div class="container"><div class="row"><div class="col-md-12">
       
    <div class="buttons">
        <span class="button green_button button_add_new_order">�������� ����� � ����� ������</span>
        <span class="button green_button button_add_product_to_order">�������� ����� � ������������ ������</span>
    </div> 
    <h2>����� ������ � ������</h2> 
    <? if (count($orders) > 0) { ?>
        <table class="table">
            <tr>
                    <th>�����</th>
                    <th>����</th>
                    <th>���������������</th>
                    <th>�����</th>
                    <th>���</th>
                    <th>�����</th>
                </tr>
            <? foreach ($orders as $key => $order) { ?>
                <tr>
                    <td><?=$order['id']?></td>
                    <td><?=$order['time']?></td>
                    <td><?=$order['date_modified']?></td>
                    <td><?=$arrMonths[$order['month']]?></td>
                    <td><?=$order['year']?></td>
                    <td><?=$order['brand']?></td>
                </tr>
            <? } ?>
        </table>
        <?
    }
    ?>

</div></div></div>
</form>