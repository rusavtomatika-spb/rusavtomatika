<div class="container">
    <div class="row">
        <div class="col-md-12">
            <? if (count($arResult) > 0) {
                $quantityOfColumns = count($arResult['arrColumns']);
                ?>
                <div class='stickytop'>
                    <div class='table-responsive'>
                        <table class='table table1 sortable-table table-products'>
                            <tr>
                                <th class="column-0"></th>
                                <?
                                foreach ($arResult['arrColumns'] as $key => $col) {
                                    ?>
                                    <th class="column-<?= $key ?>"><?= $col ?></th><?
                                }
                                ?>
                            </tr>
                            <tr class="separator">
                                <td colspan="<?= $quantityOfColumns; ?>"></td>
                            </tr>
                            <? foreach ($arResult['products'] as $product) {
                                if ($product["id"] > 0) {
                                    ?>
                                    <tr>
                                        <td class="column-0"><span class="handle sortable-icon"></span></td>
                                        <td class="column-1"><?= $product['id'] ?></td>
                                        <td class="column-brand">
                                            <div class="editable-cell"
                                                 data-table="ord_products"
                                                 data-field-type="select"
                                                 data-row-id="<?= $product['id'] ?>"
                                                 data-field-name="brand"
                                                 data-all-options="<?
                                                 echo implode(",", $arResult['all_brands']); ?>"><?= $product['brand'] ?></div>
                                        </td>
                                        <td class="column-active">
                                            <div
                                                    class="editable-cell calc-number_of_week"
                                                    data-table="ord_products"
                                                    data-field-type="input"
                                                    data-row-id="<?= $product['active'] ?>"
                                                    data-field-name="active"><?= $product['active'] ?></div>
                                            <span class="number_of_week"></span>
                                        </td>
                                        <td class="column-name">
                                            <div class="editable-cell"
                                                 data-table="ord_products"
                                                 data-field-type="input"
                                                 data-row-id="<?= $product['id'] ?>"
                                                 data-field-name="name"><?= $product['name'] ?></div>
                                        </td>
                                        <td class="column-name_1c">
                                            <div class="editable-cell"
                                                 data-table="ord_products"
                                                 data-field-type="input"
                                                 data-row-id="<?= $product['id'] ?>"
                                                 data-field-name="name_1c"><?= $product['name_1c'] ?></div>
                                        </td>
                                        <td class="column-name_1c">
                                            <div class="editable-cell"
                                                 data-table="ord_products"
                                                 data-field-type="input"
                                                 data-row-id="<?= $product['id'] ?>"
                                                 data-field-name="reference_price"><?= $product['reference_price'] ?></div>
                                        </td>
                                        <td class="column-min_price">
                                            <div class="editable-cell"
                                                 data-table="ord_products"
                                                 data-field-type="input"
                                                 data-row-id="<?= $product['id'] ?>"
                                                 data-field-name="min_price"><?= $product['min_price'] ?></div>
                                        </td>
                                        <td class="column-brand">
                                            <div class="editable-cell"
                                                 data-table="ord_products"
                                                 data-field-type="select"
                                                 data-row-id="<?= $product['id'] ?>"
                                                 data-field-name="reference_price_currency"
                                                 data-all-options="<?
                                                 echo implode(",", $arResult['all_currencies']); ?>"><?= $product['reference_price_currency'] ?></div>
                                        </td>


                                        <td class="column-description">
                                            <div title="<?= $product['description'] ?>"
                                                 class="editable-cell description"
                                                 data-table="ord_products"
                                                 data-field-type="textarea"
                                                 data-row-id="<?= $product['id'] ?>"
                                                 data-field-name="description"><?= $product['description'] ?></div>
                                        </td>
                                        <td class="column-status">
                                            <div class="editable-cell"
                                                 data-table="ord_products"
                                                 data-field-type="input"
                                                 data-row-id="<?= $product['id'] ?>"
                                                 data-field-name="status"><?= $product['status'] ?></div>
                                        </td>
                                        <td class="column-quantity-sum">
                                            <div class="order-quantity-sum"><?= $product['quantity'] ?></div>
                                        </td>
                                        <td class="column-price-sum">
                                            <div class="order-price-sum"><?= $product['sum'] ?></div>
                                        </td>
                                        <td class="column-actions">
                                    <span title="Показать содержимое заявки"
                                          class="btn2 show_products_button"
                                          data-show-products="order_records_id_<?= $product['id'] ?>"></span>


                                            <span title="Добавить продукт в заявку"
                                                  class="btn table_all_orders__button_add_product"
                                                  data-brand="<?= $product['brand'] ?>"
                                                  data-order-records-id="order_records_id_<?= $product['id'] ?>"
                                                  data-show-products="order_records_id_<?= $product['id'] ?>"
                                            ><i class="material-icons">playlist_add</i></span>
                                            <span title="Удалить заявку"
                                                  class="btn table_all_orders__button_delete_order"
                                                  data-order-id="<?= $product['id'] ?>"><i class="material-icons">delete_forever</i>
                                    </span>
                                            <span title="Скачать заявку как XLSX-файл"
                                                  data-order-id="<?= $product['id'] ?>"
                                                  data-brand="<?= $product['brand'] ?>"
                                                  class="btn button__table_orders_download_xlsx">

                                    </span>

                                        </td>
                                        <td class="column-comments">
                                            <div class="last-comment-wrapper">
                                                <?
                                                if (isset($product['last_comment'])) {
                                                    $last_comment_short = (strlen($product['last_comment']) > 60) ? substr($product['last_comment'], 0, 57) . "..." : $product['last_comment'];
                                                    $last_comment_long = (strlen($product['last_comment']) > 300) ? substr($product['last_comment'], 0, 297) . "..." : $product['last_comment'];
                                                } else {
                                                    $last_comment_short = $last_comment_long = '';
                                                }
                                                ?>


                                                <span data-order-id="<?= $product['id'] ?>"
                                                      title="<?= $last_comment_long ?>" class="last-comment">
                                        <?= $last_comment_short ?>
                                        </span>
                                                <span class="btn table_all_orders__button_open_comments"
                                                      data-order-id="<?= $product['id'] ?>"><i
                                                            class="material-icons">chat</i></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="11">
                                            <div class="spoiler" id="order_records_id_<?= $product['id'] ?>">
                                                <?
                                                if (count($product['items']) > 0) {
                                                    ?>
                                                    <table class="table table-products">
                                                        <tr>
                                                            <th>Наименование</th>
                                                            <th>Наименование 1С</th>
                                                            <th>Описание</th>
                                                            <th>Количество</th>
                                                            <th>Цена</th>
                                                            <th>Сумма</th>
                                                            <th>Действия</th>

                                                        </tr>
                                                        <?
                                                        foreach ($product['items'] as $item) {

                                                            if ($item["product"]["name"]) {
                                                                $tr_id = $product['id'] . "_" . $item["product"]["id"];
                                                                ?>
                                                                <tr id="tr_<?= $tr_id ?>">
                                                                    <td><?= $item["product"]["name"] ?></td>
                                                                    <td><?= $item["product"]["name_1c"] ?></td>
                                                                    <td title="<?= $item["product"]["description"] ?>"><?
                                                                        if (strlen($item["product"]["description"]) > 20) {
                                                                            $description = substr($item["product"]["description"], 0, 17) . "...";
                                                                        } else {
                                                                            $description = $item["product"]["description"];
                                                                        }
                                                                        echo $description;
                                                                        ?></td>
                                                                    <td>
                                                                        <div
                                                                                data-field-name="quantity"
                                                                                data-row-id="<?= $item["id"] ?>"
                                                                                data-field-type="input"
                                                                                data-table="ord_order_items"
                                                                                class="editable-cell text_align_center"><?= $item["quantity"] ?></div>
                                                                    </td>
                                                                    <td>
                                                                        <div data-field-name="price"
                                                                             data-row-id="<?= $item["id"] ?>"
                                                                             data-field-type="input"
                                                                             data-table="ord_order_items"
                                                                             class="editable-cell text_align_center"><?= $item["price"] ?></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="price-sum"><?= $item["quantity"] * $item["price"] ?></div>
                                                                    </td>
                                                                    <td>
                                                            <span data-product-id="<?= $item["product"]["id"] ?>"
                                                                  title="Редактировать"
                                                                  class="btn  button__table_orders_edit_product">
                                                                <i class="material-icons">edit</i>

                                                            </span>
                                                                        <span data-product-id="<?= $item["product"]["id"] ?>"
                                                                              data-order-id="<?= $product['id'] ?>"
                                                                              title="Убрать"
                                                                              class="btn  button__table_orders_remove_product">
                                                                <i class="material-icons">indeterminate_check_box</i>

                                                            </span>
                                                                    </td>
                                                                </tr>
                                                                <?
                                                            }
                                                        }
                                                        ?>
                                                    </table>
                                                    <?
                                                } else {
                                                    ?>
                                                    <table class="table table-products">
                                                        <tbody>
                                                        <tr id="tr_no_products__order_records_id_<?= $product['id'] ?>">
                                                            <th colspan="7">
                                                                <div>Нет товаров</div>
                                                            </th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <?
                                                }
                                                ?>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="separator">
                                        <td colspan="11"></td>
                                    </tr>
                                <? }
                            } ?>
                        </table>
                    </div>
                </div>
                <?
            }
            ?>
        </div>
    </div>
</div>
<div id="ajax_result_popup_panel"></div>
<div id="ajax_result_popup_panel2"></div>
