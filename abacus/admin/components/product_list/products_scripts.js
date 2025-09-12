import PopupConfirm from '../vue_components/PopupConfirm.js';

import {getCookie, setCookie} from '../../template/js/cookie.js';

const my_app = Vue.createApp({
    data() {
        return {
            url: '/abacus/admin/ajax/abacus_admin_ajax.php',
            ajax_command: '',
            ajax_data: {},
            products: [
                {id: '1', model: 'MT8051iE'},
                {id: '2', model: 'MT8071iP'},
            ],
            current_sort_field: 'id',
            current_sort_field_direction: 'asc',
            confirm: {
                answer: false,
                question: '',
                popup_show: false,
                current_action: '',
            }

        }
    },
    mounted: function () {
        this.$nextTick(function () {
            this.init();
        });
    }
    ,
    methods: {
        init() {
            this.ajax_command = 'products.get.list'
            this.send();

        },
        sort_products(sort_field) {
            //console.log('sort_products',sort_field,this.current_sort_field_direction);
            if (this.current_sort_field == sort_field) {
                if (this.current_sort_field_direction == 'asc') {
                    this.current_sort_field_direction = 'desc';
                } else {
                    this.current_sort_field_direction = 'asc';
                }
            } else {
                this.current_sort_field = sort_field;
                this.current_sort_field_direction = 'asc';
            }
            setCookie('admin_sort_products_by', sort_field);
            setCookie('admin_sort_products_direction', this.current_sort_field_direction);

            let sort_types = {
                id: 'int',
                brand: 'str',
                series: 'str',
                type: 'str',
                model: 'str',
                price: 'int',
            }
            let type = sort_types[sort_field];

            this.products.sort((x, y) => {
                let result = 0;
                let x1, y1;

                if (type == 'int') {
                    x1 = parseInt(x[this.current_sort_field]);
                    y1 = parseInt(y[this.current_sort_field]);
                } else {
                    x1 = x[this.current_sort_field];
                    y1 = y[this.current_sort_field];
                }

                if (x1 < y1) {
                    result = -1;
                } else if (x1 > y1) {
                    result = 1;
                }
                if (this.current_sort_field_direction == 'desc') {
                    if (result == -1) {
                        result = 1;
                    } else if (result == 1) {
                        result = -1
                    }
                }
                return result;
            });


        },
        send() {
            axios({
                method: 'POST',
                url: this.url,
                data: {
                    command: this.ajax_command,
                    data: this.ajax_data,
                },
                headers: {
                    "Content-type": "application/x-www-form-urlencoded"
                }
            }).then((response) => {
                if (this.ajax_command == "products.get.list") {
                    this.products = response.data.result;
                    //
                    let sort_field = getCookie('admin_sort_products_by');
                    let sort_direction = getCookie('admin_sort_products_direction');
                    if (sort_field !== undefined && sort_direction !== undefined) {
                        this.current_sort_field = sort_field;
                        if(sort_direction == 'asc') this.current_sort_field_direction = 'desc';
                        else this.current_sort_field_direction = 'asc';
                        setCookie('admin_sort_products_direction',this.current_sort_field_direction);
                    }else{
                        setCookie('admin_sort_products_by','id');
                        setCookie('admin_sort_products_direction','asc');
                    }
                    this.sort_products(sort_field);
                    //
                }
                if (this.ajax_command == "product.delete" && response.data.result == true) {
                    this.ajax_command = "products.get.list";
                    this.ajax_data = {};
                    this.send();
                }
                if (this.ajax_command == "product.copy" && response.data.result == true) {
                    this.ajax_command = "products.get.list";
                    this.ajax_data = {};
                    this.send();
                }
            });
        },


        copy_product(id, model) {
            this.confirm_action(id, model, "Копировать id:" + id + " " + model + " ???", 'copy');
        },
        delete_product(id, model) {
            this.confirm_action(id, model, "Удалить id:" + id + " " + model + " ???", 'delete');
        },
        confirm_action(id, model, text, action) {
            console.log(action);
            this.$refs.popupconfirm.text = text;
            this.$refs.popupconfirm.id = id;
            this.$refs.popupconfirm.show = true;
            this.$refs.popupconfirm.action = action;
        },
        action_confirmed(data) {

            if (parseInt(data.index) > 0 && data.action == "delete") {
                this.ajax_command = "product.delete";
                this.ajax_data = {index: data.index}
                this.send();
            }
            if (parseInt(data.index) > 0 && data.action == "copy") {
                this.ajax_command = "product.copy";
                this.ajax_data = {index: data.index}
                this.send();
            }
        },

    },
});
my_app.component('PopupConfirm', PopupConfirm);
my_app.mount('#app');