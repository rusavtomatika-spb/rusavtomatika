<?php
if (!empty($arResult)):
    ?>
    <div id="app" data-product-id="<?= $arResult["product_id"] ?>">
        <div class="sticky_wrapper">
            <div class="sticky has-background-light p-1">
                <div class="product_edit__buttons is-flex is-justify-content-space-evenly is-align-items-center">
                    <button class="is-small button mx-2" @click="sort('groups')">По группам</button>
                    <button class="is-small button mx-2" @click="sort('alpha')">По алфавиту</button>
                    <button class="is-small button mx-2" @click="sort('id')">По ID</button>
                    <button class="is-small button mx-2" @click="hide">Скрыть лишнее</button>
                    <div class="product_edit__title mr-2">{{title}}</div>
                    <button class="is-small button mx-2" @click="save('stay')">Сохранить</button>
                    <button class="is-small button mx-2" @click="save('close')">Сохранить и закрыть</button>
                    <button class="is-small button mx-2" @click="redirect('/abacus/admin/products/')">Закр.без сохр.</button>
                </div>
                <div class="box_message">{{message}}</div>
            </div>
        </div>
        <div class="table-container">

            <form id="form_edit_product">
                <table class="table is-striped is-narrow is-fullwidth  is-hoverable">
                    <tr class="is-selected">
                        <th>#</th>
                        <th>Поле</th>
                        <th>Русск.имя</th>
                        <th>Значение</th>
                    </tr>
                    <tr v-for="(field, key, index) in product_fields">
                        <td>{{index}}</td>
                        <td>{{key}}</td>
                        <td>{{field_descriptions[key]['rus_name']}}</td>
                        <td v-if="field_descriptions[key]['field_type'] != 'text'">
                            <input
                                    :name="key"
                                    class="input" type="text"
                                    v-model="product_fields[key]">
                        </td>
                        <td v-else>
                            <textarea class="textarea" cols="30" rows="3" v-model="product_fields[key]"></textarea>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="box_message">{{message}}</div>
        <div class="product_edit__buttons is-flex is-justify-content-flex-end is-align-items-center">
            <div class="product_edit__title mr-2">{{title}}</div>
            <button class="button mx-2" @click="save('stay')">Сохранить</button>
            <button class="button mx-2" @click="save('close')">Сохранить и закрыть</button>
            <button class="button mx-2" @click="redirect('/abacus/admin/products/')">Закр.без сохр.</button>
        </div>
        <br>

    </div>
    <style>
        .product_edit__title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        table tr th:first-child {
            width: 1%;
        }

        table tr th:nth-child(2) {
            width: 9%;
        }

        table tr th:nth-child(3) {
            width: 10%;
        }

        table tr th:nth-child(4) {
            width: 80%;
        }

        input[type=text] {
            width: 100%;
        }
    </style>
    <script src="/abacus/admin/components/product_detail/product_detail_scripts.js?<?= Date("dmYhis") ?>"></script>
<?php
endif;



