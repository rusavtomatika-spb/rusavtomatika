
<form id="form_add_product" method="post" class="popupform">     
    <input type="hidden" name='action' value="save_product">    
    <div class="form_title">���������� ������ ��������</div>   
    <table>
        <tr class="tr_row_type">
            <td>��� ���������� ����� ������ (�������/�����������)</td>
            <td style="width: 50%">
                <select size="1" name="row_type">
                    <option value="product">�������</option>
                    <option value="separator">�����������</option>                    
                </select>
            </td> 
        </tr>
        <tr class="tr_name">
            <td>������������: </td>
            <td style="width: 50%">
                <input placeholder="������������" type="text" name="name" value="<?= $product['name'] ?>" autocomplete="off" />
            </td> 
        </tr>
        <tr class="tr_brand">
            <td>�����: </td>
            <td style="width: 50%">
                <input title="������� ����� ����� ��� �������� ������������" placeholder="������� ����� ����� ��� �������� ������������" type="text" name="brand_new" value="" autocomplete="off" />
                <select size="1" name="brand">
                    
                    <?
                    foreach ($arrBrands as $value) {
                        ?>
                        <option><?= $value ?></option>
                        <?
                    }
                    ?>
                </select>
            </td> 
        </tr>
        <tr class="tr_name_1c">
            <td>������������ ��� 1�:  </td>
            <td><input placeholder="������� ������������" type="text" name="name_1c" value="<?= $product['name_1c'] ?>" autocomplete="off" /></td>   
        </tr>
        <tr class="tr_reference_price_currency">
            <td>������:</td> 
            <td>
                <select size="1" name="reference_price_currency"><?
                    foreach ($arrCurrencies as $value) {
                        ?>
                        <option><?= $value ?></option>
                        <?
                    }
                    ?>
                </select>                
            </td>   

        </tr>
        <tr class="tr_description">
            <td>��������:</td> 
            <td>
                <textarea name="description" placeholder="��������"></textarea>             
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" value="���������" />
                <span id="form_ajax_result"></span>
            </td>            
        </tr>
    </table>    
</form>


