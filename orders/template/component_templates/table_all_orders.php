<div class="form_title">Заявки</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <div style="padding: 20px;float: right;">Фильтр: <span style="font-weight:bold;">[Бренд]</span> <span
                            style="font-weight:bold;">[Диапазон дат]</span></div>
                <div style="padding: 15px 20px;float: right;">
                    <span class="green_button button_add_new_order">Добавить новую заявку</span>
                </div>
                <div style="padding: 15px 20px;float: right;">
                    <span style="display: none;" class="green_button button_back_to_orders"><<== К списку заявок</span>
                </div>
            </div>

            <?
            if (count($orders) > 0) { ?>
                <table class="table table-orders">
                    <tr>
                        <th class="column-1">Номер</th>
                        <th>Бренд</th>
                        <th class="column-date">Дата отгрузки</span></th>
                        <th class="column-date">Дата оплаты</span></th>
                        <th class="column-date">Дата&nbsp;ож.пост</span></th>
                        <th class="column-description">Примечание</th>
                        <th class="column-status">Статус</th>
                        <th class="column-quantity-sum">Товаров</th>
                        <th class="column-price-sum">Сумма</th>
                        <th class="column-comments">Комментарии</th>
                        <th class="column-actions">Действия</th>
                    </tr>
                    <tr class="separator">
                        <td colspan="11"></td>
                    </tr>
                    <? foreach ($orders as $key => $order) {
                        if ($order["id"] > 0) {
                            if(isset($order['items'][0]["product"]['reference_price_currency'])){
                                $data_order_currency = " data-order-currency='{$order['items'][0]['product']['reference_price_currency']}' ";
                            }else{$data_order_currency = " data-order-currency='' ";}
                            ?>
                            <tr id="tr_order_id_<?=$order["id"]?>" class="tr_order" <?=$data_order_currency?>>
                                <td class="column-1"><?= $order['id'] ?></td>
                                <td class="column-brand">
                                    <div class="editable-cell"
                                         data-table="ord_orders"
                                         data-field-type="select"
                                         data-row-id="<?= $order['id'] ?>"
                                         data-field-name="brand"
                                         data-all-options="<?
                                         echo implode(",", $orders['all_brands']); ?>"><?= $order['brand'] ?></div>
                                </td>
                                <td class="column-date">
                                    <div
                                            class="editable-cell calc-number_of_week"
                                            data-table="ord_orders"
                                            data-field-type="date-picker"
                                            data-row-id="<?= $order['id'] ?>"
                                            data-field-name="date_shipment"><?
                                        if ($order['date_shipment'] != '0000-00-00') echo $order['date_shipment']; ?></div>
                                    <span class="number_of_week"></span>
                                </td>
                                <td class="column-date">
                                    <div
                                            class="editable-cell calc-number_of_week"
                                            data-table="ord_orders"
                                            data-field-type="date-picker"
                                            data-row-id="<?= $order['id'] ?>"
                                            data-field-name="date_payment"><?
                                        if ($order['date_payment'] != '0000-00-00') echo $order['date_shipment']; ?></div>
                                    <span class="number_of_week"></span>
                                </td>
                                <td class="column-date">
                                    <div
                                            class="editable-cell calc-number_of_week"
                                            data-table="ord_orders"
                                            data-field-type="date-picker"
                                            data-row-id="<?= $order['id'] ?>"
                                            data-field-name="date_expected_delivery"><?
                                        if ($order['date_expected_delivery'] != '0000-00-00') echo $order['date_shipment']; ?></div>
                                    <span class="number_of_week"></span>
                                </td>
                                <td class="column-description">
                                    <div title="<?= $order['description'] ?>"
                                         class="editable-cell description"
                                         data-table="ord_orders"
                                         data-field-type="textarea"
                                         data-row-id="<?= $order['id'] ?>"
                                         data-field-name="description"><?= $order['description'] ?></div>
                                </td>
                                <td class="column-status">
                                    <div class="editable-cell"
                                         data-table="ord_orders"
                                         data-field-type="input"
                                         data-row-id="<?= $order['id'] ?>"
                                         data-field-name="status"><?= $order['status'] ?></div>
                                </td>
                                <td class="column-quantity-sum">
                                    <div class="order-quantity-sum"><?= $order['quantity'] ?></div>
                                </td>
                                <td class="column-price-sum">
                                    <div class="order-price-sum"><?= $order['sum'] ?></div>
                                </td>
                                <td class="column-comments">
                                    <div class="last-comment-wrapper">
                                        <?
                                        if (isset($order['last_comment'])) {
                                            $last_comment_short = (strlen($order['last_comment']) > 60) ? substr($order['last_comment'], 0, 57) . "..." : $order['last_comment'];
                                            $last_comment_long = (strlen($order['last_comment']) > 300) ? substr($order['last_comment'], 0, 297) . "..." : $order['last_comment'];
                                        } else {
                                            $last_comment_short = $last_comment_long = '';
                                        }
                                        ?>


                                        <span data-order-id="<?= $order['id'] ?>" title="<?= $last_comment_long ?>"
                                              class="last-comment">
                                        <?= $last_comment_short ?>
                                        </span>
                                        <span class="btn2 chat table_all_orders__button_open_comments"
                                              data-order-id="<?= $order['id'] ?>"></span>
                                    </div>
                                </td>
                                <td class="column-actions">
                                    <span title="Показать содержимое заявки"
                                          class="btn2 show_products_button"
                                          data-show-products="order_records_id_<?= $order['id'] ?>"></span>


                                    <span title="Удалить заявку"
                                          class="btn2 table_all_orders__button_delete_order"
                                          data-order-id="<?= $order['id'] ?>">
                                    </span>
                                    <span title="Скачать заявку как XLSX-файл"
                                          data-order-id="<?= $order['id'] ?>"
                                          data-brand="<?= $order['brand'] ?>"
                                          class="btn button__table_orders_download_xlsx">

                                    </span>

                                </td>
                            </tr>
                            <tr class="tr_spoiler">
                                <td colspan="11">
                                    <div class="spoiler" id="order_records_id_<?= $order['id'] ?>">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <span id="articul_price_panel_<?=$order['id'] ?>">
                                                        <span style="vertical-align: super">Артикул прайс</span>
                                                        <span title="Скачать Артикул прайс" data-template-path="artikul_prices"
                                                              data-order-id="<?=$order['id'] ?>"
                                                              class="btn button__download button__download_artikul_price_xlsx"></span>
                                                    </span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <span id="customhouse_specification_panel_<?=$order['id'] ?>">
                                                        <span style="vertical-align: super">Описание для таможни</span>
                                                        <span title="Скачать описание для таможни" data-template-path="customhouse_specification"
                                                              data-order-id="<?=$order['id'] ?>"
                                                              class="btn button__download button__download_customhouse_specification_xlsx"></span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="table">
                                            <tr>
                                                <th>
                                                    <div class="h2">Товары</div>
                                                </th>
                                            </tr>
                                        </table>

                                        <?
                                        if (count($order['items']) > 0) {
                                            ?>
                                            <table class="table table-products">
                                                <tr>
                                                    <th class="column-product-name">Артикул</th>
                                                    <th class="column-product-description">Описание</th>
                                                    <th class="column-product-quantity">Количество</th>
                                                    <th class="column-product-price">Цена</th>
                                                    <th class="column-product-sum">Сумма</th>
                                                    <th class="column-product-russian-fields">Русские поля</th>
                                                    <th class="column-product-actions">
                                                        <span style="vertical-align: super;margin-right: 10px;">Действия</span>
                                                        <span title="Добавить продукт в заявку"
                                                              class="btn table_all_orders__button_add_product"
                                                              data-brand="<?= $order['brand'] ?>"
                                                              data-order-records-id="order_records_id_<?= $order['id'] ?>"
                                                              data-show-products="order_records_id_<?= $order['id'] ?>"
                                                        ><i class="material-icons">playlist_add</i></span>
                                                    </th>
                                                </tr>
                                                <?
                                                foreach ($order['items'] as $item) {
                                                    if ($item["product"]["name"]) {
                                                        $tr_id = $order['id'] . "_" . $item["product"]["id"];
                                                        $color_art = (strlen($item["product"]['name_rus'])) ? 'text_color_green' : 'text_color_red';
                                                        $color_desc = (strlen($item["product"]['description_rus'])) ? 'text_color_green' : 'text_color_red';
                                                        $color_1c = (strlen($item["product"]['name_1c'])) ? 'text_color_green' : 'text_color_red';
                                                        ?>
                                                        <tr id="tr_<?= $tr_id ?>">
                                                            <td class="column-product-name"><?= $item["product"]["name"] ?></td>
                                                            <td class="column-product-description"
                                                                title="<?= $item["product"]["description"] ?>"><?
                                                                if (strlen($item["product"]["description"]) > 200) {
                                                                    $description = substr($item["product"]["description"], 0, 197) . "...";
                                                                } else {
                                                                    $description = $item["product"]["description"];
                                                                }
                                                                echo $description;
                                                                ?></td>
                                                            <td class="column-product-quantity">
                                                                <div
                                                                        data-field-name="quantity"
                                                                        data-row-id="<?= $item["id"] ?>"
                                                                        data-field-type="input"
                                                                        data-table="ord_order_items"
                                                                        class="editable-cell text_align_center"><?= $item["quantity"] ?></div>
                                                            </td>
                                                            <td class="column-product-price">
                                                                <div data-field-name="price"
                                                                     data-row-id="<?= $item["id"] ?>"
                                                                     data-field-type="input"
                                                                     data-table="ord_order_items"
                                                                     class="editable-cell text_align_center"><?= $item["price"] ?></div>
                                                            </td>
                                                            <td class="column-product-sum">
                                                                <div class="price-sum"><?= $item["quantity"] * $item["price"] ?></div>
                                                            </td>
                                                            <td class="column-product-russian-fields">
                                                                <div class="fields-filled">
                                                                    <span class="<?= $color_art; ?>">[арт]</span>
                                                                    <span class="<?= $color_desc; ?>">[опис]</span>
                                                                    <span class="<?= $color_1c; ?>">[1с]</span>
                                                                </div>
                                                            </td>
                                                            <td class="column-product-actions">
                                                            <span data-product-id="<?= $item["product"]["id"] ?>"
                                                                  title="Редактировать"
                                                                  class="btn  button__table_orders_edit_product">
                                                                <i class="material-icons">edit</i>
                                                            </span>
                                                                <span data-product-id="<?= $item["product"]["id"] ?>"
                                                                      data-order-id="<?= $order['id'] ?>"
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
                                                <tr id="tr_no_products__order_records_id_<?= $order['id'] ?>">
                                                    <th colspan="7">
                                                        <div>Нет товаров</div>
                                                        <span title="Добавить продукт в заявку"
                                                              class="btn table_all_orders__button_add_product"
                                                              data-brand="<?= $order['brand'] ?>"
                                                              data-order-records-id="order_records_id_<?= $order['id'] ?>"
                                                              data-show-products="order_records_id_<?= $order['id'] ?>"
                                                        ><i class="material-icons">playlist_add</i></span>

                                                    </th>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <?
                                        }
                                        ?>

                                        <table class="table">
                                            <tr>
                                                <th>
                                                    <div class="h2">Инвойсы</div>
                                                    <div class="upload_invoice_panel">
                                                        <span><b>Прикрепление нового инвойса (xls, xslx): </b> </span>
                                                        &nbsp;
                                                        <input type="file" name="upload_invoice_input"/>
                                                        <span
                                                                style="display: none;"
                                                                data-order-id="<?= $order['id'] ?>"
                                                                data-path="/<?= $order['brand'] ?>/<?= $order['year'] ?>/<?= $order['month'] ?>/<?= $order['id'] ?>/"
                                                                class=" green_button upload_invoice_button">Отправить
                                            </span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </table>

                                        <table class="table table-invoices">
                                            <thead>
                                            <tr>
                                                <th class="column-invoice">Инвойс</th>
                                                <th class="column-invoice-name">Наименование</th>
                                                <th class="column-invoice-status">Статус</th>
                                                <th class="column-invoice-file">Файл</th>
                                                <th class="column-invoice-comment">Комментарий</th>
                                                <th class="column-invoice-actions">
                                                    <span style="vertical-align: super;margin-right: 10px;">Действия</span>
                                                    <span title="Загрузить инвойс"
                                                          class="btn table_all_orders__button_upload_invoice"
                                                          data-order-id="<?= $order['id'] ?>">
                                                        <i class="material-icons">playlist_add</i>
                                                    </span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?
                                            echo \model\get_all_html_invoices_by_order_id($order['id']);

                                            ?>
                                            </tbody>
                                        </table>
                                        <div id="payment_forms_panel_<?=$order['id'] ?>">
                                            <?
                                            \model\get_order_payment_forms_html($order['id']);
                                            ?>
                                        </div>
                                        <div id="logist_order_panel_<?=$order['id'] ?>">
                                            <?
                                             \model\get_logist_orders_html($order['id']);
                                            ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="separator">
                                <td colspan="11"></td>
                            </tr>
                        <? }
                    } ?>
                </table>
                <div class="orders_panel_choose_product_wrapper">
                    <div class="form_title">Выбор продукта</div>
                    <div class="orders_panel_choose_product_close_btn"></div>
                    <div class="orders_panel_choose_product_search__wrapper"><input data-brand=""
                                                                                    class="orders_panel_choose_product_search"
                                                                                    type="text" value=""
                                                                                    autocomplete="off"
                                                                                    placeholder="..."/><span
                                class="orders_panel_choose_product_search__clear_text">X</span>
                    </div>
                    <div class="orders_panel_choose_product"></div>

                </div>
            <? }
            ?>

        </div>
    </div>
</div>    


