
<form id="form_add_product" method="post" class="popupform">     
    <input type="hidden" name='action' value="save_product">    
    <div class="form_title">Добавление нового продукта</div>   
    <table>
        <tr class="tr_row_type">
            <td>Тип добавления новой записи (Продукт/Разделитель)</td>
            <td style="width: 50%">
                <select size="1" name="row_type">
                    <option value="product">Продукт</option>
                    <option value="separator">Разделитель</option>                    
                </select>
            </td> 
        </tr>
        <tr class="tr_name">
            <td>Наименование: </td>
            <td style="width: 50%">
                <input placeholder="Наименование" type="text" name="name" value="<?= $product['name'] ?>" autocomplete="off" />
            </td> 
        </tr>
        <tr class="tr_brand">
            <td>Бренд: </td>
            <td style="width: 50%">
                <input title="Введите новый бренд или выберите существующий" placeholder="Введите новый бренд или выберите существующий" type="text" name="brand_new" value="" autocomplete="off" />
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
            <td>Наименование для 1С:  </td>
            <td><input placeholder="Русское наименование" type="text" name="name_1c" value="<?= $product['name_1c'] ?>" autocomplete="off" /></td>   
        </tr>
        <tr class="tr_reference_price_currency">
            <td>Валюта:</td> 
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
            <td>Описание:</td> 
            <td>
                <textarea name="description" placeholder="Описание"></textarea>             
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" value="Сохранить" />
                <span id="form_ajax_result"></span>
            </td>            
        </tr>
    </table>    
</form>


