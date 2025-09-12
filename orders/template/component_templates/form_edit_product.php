<form method="post" class="ajax_form_edit_product popupform in_orders_table">
    <input type="hidden" name='product_id' value="<?= $product['id'] ?>">
    <input type="hidden" name='action' value="update_values">
    <input type="hidden" name='fields[]' value="name">
    <input type="hidden" name='fields[]' value="name_rus">
    <input type="hidden" name='fields[]' value="name_1c">
    <input type="hidden" name='fields[]' value="artikul_1c">
    <input type="hidden" name='fields[]' value="presence_1c">
    <input type="hidden" name='fields[]' value="min_price">
    <input type="hidden" name='fields[]' value="price_10_49">
    <input type="hidden" name='fields[]' value="reference_price">
    <input type="hidden" name='fields[]' value="reference_price_currency">
    <input type="hidden" name='fields[]' value="brand">
    <input type="hidden" name='fields[]' value="active">
    <input type="hidden" name='fields[]' value="description">
    <input type="hidden" name='fields[]' value="description_rus">
    <input type="hidden" name='fields[]' value="moq">
    <input type="hidden" name='active' value="<?= $product['active'] ?>">

    <div class="form_title">�������������� �������� <?= $product['name'] ?>
        </div>
    <table>
        <tr class="tr_divider">
            <td colspan="2" style="text-align: center;">
                <input type="submit" value="���������" />
                <input type="button" class="cancel" value="������" />
            </td>
        </tr>
        <tr class="tr_brand">
            <td>�����:</td>
            <td>
                <select data-product_id="<?= $product['id'] ?>" size="1" name="brand"><?
                    foreach ($arrBrands as $value) {
                        ?>
                        <option <? if ($product['brand'] == $value) echo 'selected="selected"'; ?>><?= $value ?></option>
                        <?
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr class="tr_divider">
            <td colspan="2">������������</td>
        </tr>
        <tr class="tr_name"><td>������� (���.):<div>(������������, ������)</div></td>
            <td style="width: 70%">
                <input data-product_id="<?= $product['id'] ?>" placeholder="������� (���)" type="text" name="name" value="<?= $product['name'] ?>" autocomplete="off" />
            </td>
        </tr>
        <tr class="tr_name"><td>������� (���.):</td>
            <td>
                <input data-product_id="<?= $product['id'] ?>" placeholder="������� (���)" type="text" name="name_rus" value="<?= $product['name_rus'] ?>" autocomplete="off" />
            </td>
        </tr>
        <tr class="tr_name_1c">
            <td>������������ ��� 1�:</td>
            <td><input data-product_id="<?= $product['id'] ?>" placeholder="������������ ��� 1�" type="text" name="name_1c" value="<?= $product['name_1c'] ?>" autocomplete="off" /></td>
        </tr>
        <tr class="tr_artikul_1�">
            <td>������� ��� 1�:</td>
            <td><input data-product_id="<?= $product['id'] ?>" placeholder="������� ��� 1�" type="text" name="artikul_1c" value="<?= $product['artikul_1c'] ?>" autocomplete="off" /></td>
        </tr>
        <tr class="tr_presence_1�">
            <td>������� � 1�:</td>
            <td>
                <select data-product_id="<?= $product['id'] ?>" size="1" name="presence_1c">
                    <option></option>
                    <option <? if ($product['presence_1c'] == "���") echo 'selected="selected"'; ?>>���</option>
                    <option <? if ($product['presence_1c'] == "����") echo 'selected="selected"'; ?>>����</option>
                </select>
            </td>
        </tr>

        <tr class="tr_divider">
            <td colspan="2">����</td>
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
        <tr class="tr_reference_price">
            <td>���������� ����: </td>
            <td><input data-product_id="<?= $product['id'] ?>" placeholder="���������� ����" type="text" name="reference_price" value="<?= $product['reference_price'] ?>" autocomplete="off" /></td>
        </tr>
        <tr class="tr_min_price">
            <td>����������� ����: </td>
            <td><input data-product_id="<?= $product['id'] ?>" placeholder="����������� ����" type="text" name="min_price" value="<?= $product['min_price'] ?>" autocomplete="off" /></td>
        </tr>
        <tr class="tr_price_10_49">
            <td>���� 10~49:</td>
            <td><input data-product_id="<?= $product['id'] ?>" placeholder="���� 10~49" type="text" name="price_10_49" value="<?= $product['price_10_49'] ?>" autocomplete="off" /></td>
        </tr>
        <tr class="tr_divider">
            <td colspan="2">��������</td>
        </tr>

        <tr class="tr_description">
            <td>�������� (����):</td>
            <td>
                <textarea name="description" placeholder="��������"><?=$product['description']?></textarea>
            </td>
        </tr>
        <tr class="tr_description">
            <td>�������� (���):</td>
            <td>
                <textarea name="description_rus" placeholder="�������� (���)"><?=$product['description_rus']?></textarea>
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
        <tr class="tr_divider">
            <td colspan="2" style="text-align: center;">
                <input type="submit" value="���������" />
                <input type="button" class="cancel" value="������" />
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">
                <span id="form_edit_name_ajax_result"></span>
            </td>
        </tr>
    </table>    
</form>




