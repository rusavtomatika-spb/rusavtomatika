<?
$arrMonths = ['','���', '���', '���', '���', '���', '���', '���', '���', '���', '���', '���', '���'];

?>  
    

<form id="form_edit_orders" method="post" class="popupform"> 
    <input type="hidden" name="action" value="edit_orders" > 
    <input type="hidden" name="product_id" value="<?= $arrResult['product_id'] ?>" > 
    <input type="hidden" name="month" value="<?= $arrResult['month'] ?>" > 
    <input type="hidden" name="brand" value="<?= $arrResult['brand'] ?>" > 
    <input type="hidden" name="intent_id" value="<?= $arrResult['intent_id'] ?>" > 
    <div class="form_title">������ � �������� </div>
<div class="container"><div class="row"><div class="col-md-12">
            
                    <h3><?= $arrResult['brand'].": ".$arrMonths[$arrResult['month']]." / ".$arrResult['year']?></h3>
                    <hr>
                    <h3>�������� � ����� ��� ������������ ������</h3>                     
            
            <div class="product">
                <table class="table table-orders">
                    <tr>
                        <td>(ID:<?=$arrResult['product']["id"]?>) <?=$arrResult['product']["name"]?></td>                        
                        <td>����������: <input type="text" name="quantity" value="" ></td>
                        <td>���� (<?=$arrResult['product']["reference_price_currency"]?>): <input type="text" name="price" value="<?=$arrResult['product']["reference_price"]?>" ></td>
                        
                        <td><div class="buttons">
        <span class="button green_button button_add_new_order">�������� � ����� ������</span>
        <span class="button green_button button_add_new_order">������� ������ � ��������</span>
        
    </div></td>
                    </tr>
                </table>
            <tr>
            </div>                     
                    <hr>
    <h3>����� <?=$arrResult['product']["name"]?> ������ � ������</h3> 
    <? if (count($orders) > 0) { ?>
        <table class="table table-orders">
            <tr>
                    <th>����� ������</th>
                    <th>����</th>
                </tr>
            <? foreach ($orders as $key => $order) {
                ?>
                <tr>
                    <td><?=$order['id']?></td>
                    <td><?=$order['time']?> <div>(<?=$order['date_modified']?>)</div></td> 
                </tr>
                <tr>
                            <td colspan="2">
                                <table>
                                    <tr>
                                                    <th>������������</th>
                                                    <th>����������</th>
                                                    <th>����</th>
                                                    <th>�����</th>
                                                </tr>                                    
                                <? foreach ($order['items'] as $item) { 
                                    if ($item['product_id']){?>
                                
                                                <tr>
                                                    <td><span class="small-text">(ID:<?=$item["product_id"]?>)</span> <?=$item["product"]["name"]?></td>
                                                    <td><?=$item["quantity"]?></td>
                                                    <td><?=$item["price"]?> <?=$item["product"]["reference_price_currency"]?></td>
                                                    <td><?=$item["price"]*$item["quantity"]?></td>
                                                </tr>
                                               
                                <? }} ?>
                            </table> 
                            </td>
                </tr>
                
            <? } 
            
                                ?>
        </table>
        <?
    }
    ?>

</div></div></div>
</form>