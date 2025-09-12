<?
$arrMonths = ['','Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
?>  
    

<form id="form_edit_orders" method="post" class="popupform"> 
    <input type="hidden" name="action" value="edit_orders" > 
    <input type="hidden" name="product_id" value="<?= $arrResult['product_id'] ?>" > 
    <input type="hidden" name="month" value="<?= $arrResult['month'] ?>" > 
    <input type="hidden" name="brand" value="<?= $arrResult['brand'] ?>" > 
    <input type="hidden" name="intent_id" value="<?= $arrResult['intent_id'] ?>" > 
    <div class="form_title">Работа с заявками</div>
<div class="container"><div class="row"><div class="col-md-12">
       
    <div class="buttons">
        <span class="button green_button button_add_new_order">Добавить товар в новую заявку</span>
        <span class="button green_button button_add_product_to_order">Добавить товар в существующую заявку</span>
    </div> 
    <h2>Товар входит в заявки</h2> 
    <? if (count($orders) > 0) { ?>
        <table class="table">
            <tr>
                    <th>Номер</th>
                    <th>Дата</th>
                    <th>Отредактировано</th>
                    <th>Месяц</th>
                    <th>Год</th>
                    <th>Бренд</th>
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