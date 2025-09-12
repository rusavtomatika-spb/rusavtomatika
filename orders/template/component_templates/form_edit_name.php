<form id="form_edit_name" method="post" class="ajax_form_edit popupform"> 
    <input type="hidden" name='product_id' value="<?= $product['id'] ?>">
    <input type="hidden" name='action' value="update_values">
    <input type="hidden" name='fields[]' value="name">
    <input type="hidden" name='fields[]' value="name_1c">
    <input type="hidden" name='fields[]' value="reference_price_currency">
    <input type="hidden" name='fields[]' value="brand">
    <input type="hidden" name='fields[]' value="active">
    <input type="hidden" name='fields[]' value="description">
    <input type="hidden" name='active' value="<?= $product['active'] ?>">

    <div class="form_title">�������������� �������� <?= $product['name'] ?></div>   
    <table>
        
        <tr class="tr_name"><td>������������: </td>
            <td style="width: 50%">
                <input data-product_id="name_<?= $product['id'] ?>" placeholder="name" type="text" name="name" value="<?= $product['name'] ?>" autocomplete="off" />

            </td>
            <td><span data-product_id="name_<?= $product['id'] ?>" title="������������ ��������" data-origin-value="<?= $product['name'] ?>" class="clear_inputs">X</span></td>          

        </tr>
        <tr class="tr_name_1c"><td>������������ ��� 1�:  </td>
            <td><input data-product_id="name_1c_<?= $product['id'] ?>" placeholder="������� ������������" type="text" name="name_1c" value="<?= $product['name_1c'] ?>" autocomplete="off" /></td>   
            <td><span data-product_id="name_1c_<?= $product['id'] ?>" title="������������ ��������" data-origin-value="<?= $product['name_1c'] ?>" class="clear_inputs">X</span></td>
        </tr>
        <tr class="tr_brand">
            <td>�����:</td> 
            <td>
                <select data-product_id="brand_<?= $product['id'] ?>" size="1" name="brand"><?
                    foreach ($arrBrands as $value) {
                        ?>
                        <option <? if ($product['brand'] == $value) echo 'selected="selected"'; ?>><?= $value ?></option>
                        <?
                    }
                    ?>
                </select>                
            </td>   

        </tr>
        <tr class="tr_reference_price_currency">
            <td>������:</td> 
            <td>
                <select data-product_id="reference_price_currency_<?= $product['id'] ?>" size="1" name="reference_price_currency"><?
                    foreach ($arrCurrencies as $value) {
                        ?>
                        <option <? if ($product['reference_price_currency'] == $value) echo 'selected="selected"'; ?>><?= $value ?></option>
                        <?
                    }
                    ?>
                </select>                
            </td>   

        </tr>
        <tr class="tr_description">
            <td>��������:</td> 
            <td>
                <textarea name="description" placeholder="��������"><?=$product['description']?></textarea>             
            </td>
        </tr>        
        <tr class="tr_active">
            <td>����������:</td> 
            <td>
                <span class="activeness <? 
                if ($product['active'] == '1') {echo 'active';}                
                ?> "></span>
            </td>  
        </tr>
        
        <tr>
            <td colspan="3">
                <div>
                <input type="submit" value="���������" />
                <input type="button" class="cancel" value="������" />
                </div>
                <span id="form_edit_name_ajax_result"></span>
            </td>  

        </tr>
    </table>    
</form>




