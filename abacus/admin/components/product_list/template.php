<div id="app" class="product_list">
    <popup-confirm  ref="popupconfirm" @action_confirmed="action_confirmed"></popup-confirm>
    <div class="table-container">
        <table class="table is-striped is-narrow is-fullwidth  is-hoverable">
            <tr class="is-selected">
                <th><div class="button_sort" @click="sort_products('id')">id</div></th>
                <th><div class="button_sort" @click="sort_products('brand')">brand</div></th>
                <th><div class="button_sort" @click="sort_products('series')">series</div></th>
                <th><div class="button_sort" @click="sort_products('type')">type</div></th>
                <th><div class="button_sort" @click="sort_products('model')">model</div></th>
                <th><div class="button_sort" @click="sort_products('price')">price</div></th>
                <td>
                    <div class="buttons are-small is-justify-content-flex-end">

                    </div>
                </td>
            </tr>
            <tr v-for="product in products">
                <td>{{product.id}}</td>
                <td>{{product.brand}}</td>
                <td>{{product.series}}</td>
                <td>{{product.type}}</td>
                <td><a :href="'/abacus/admin/products/' + product.id + '/'">{{product.model}}</a></td>
                <td :class="{price_hide : (product.price_hide=='1')  }">{{product.price}}</td>
                <td>
                    <div class="buttons are-small is-justify-content-flex-end">
                        <a class="button is-primary is-outlined" :href="'/abacus/admin/products/' + product.id + '/'">edit</a>
                        <button @click="copy_product(product.id,product.model)" class="button is-warning is-outlined">copy</button>
                        <button @click="delete_product(product.id,product.model)" class="button is-danger is-outlined">del</button>
                    </div>
                </td>
            </tr>
        </table>

    </div>


</div>
<script type="module" src="/abacus/admin/components/product_list/products_scripts.js?<?= Date("dmYhis") ?>"></script>

<style>
    .product_list .price_hide {
        text-decoration: line-through;
    }
    .product_list .button_sort{
        cursor: pointer;
    }
    .product_list .button_sort:hover{
        opacity: 0.8;
        transition: 0.2s;
    }
    .product_list table td {
        vertical-align: middle;
    }
    .product_list .buttons {
        width: 170px;
    }
    .product_list th button.button.is-small {
        font-weight: bold;
        font-size: 1rem;
    }
    .product_list td:nth-child(1) {
        text-align: center;
    }





</style>


