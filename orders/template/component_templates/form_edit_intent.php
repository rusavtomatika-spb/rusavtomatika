
<form id="form_edit_intent" method="post" class="ajax_form_edit_order popupform"> 
    <input type="hidden" name="action" value="update_intent" > 
    <input type="hidden" name="product_id" value="<?=$arrResult['product_id']?>" > 
    <input type="hidden" name="month" value="<?=$arrResult['month']?>" > 
    <input type="hidden" name="intent_id" value="<?
    if ($arrResult['intent']['id'] > 0) 
    {echo $arrResult['intent']['id'];}else{echo '0';} 
            ?>" > 
    
    <div class="form_title">Интент</div>   
    <table>
        <tr>
            <td>Количество: </td>
            <td style="width: 90%;">
                <input placeholder="Количество" type="text" name="product_intent_quantity" 
                       value="<?=$arrResult['intent']['quantity']?>" autocomplete="off" />
            </td>
            <td><span data-product_id="product_intent_quantity_<?=$arrResult['intent']['id']?>" title="Восстановить значение" data-origin-value="<?=$arrResult['intent']['quantity']?>" class="clear_inputs">X</span></td>          

        </tr>
        
        <tr>
            <td colspan="2">
                <input type="submit" value="Сохранить" />
                <span id="form_edit_name_ajax_result"></span>
            </td>              
        </tr>
    </table>    
</form>


