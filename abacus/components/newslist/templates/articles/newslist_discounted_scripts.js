var app = new Vue({
    el: '#vue_app_discounted',
    data: {
        url: {
            get_filtered_menu: '/abacus/components/newslist/templates/discounted/ajax_newslist_discounted.php?',
        },
        arr_filtered_items: [],
        arr_brands: [],
        arr_categories: [],
        loading_status: true,
    },
    watch: {},
    created: function () {
    },
    mounted: function () {
        this.$nextTick(function () {
            this.init();
        });
    }
    ,
    methods: {
        alert(message) {
            alert(message);
        },

        send() {
            let str_categories = '';
            let str_brands = '';
            this.loading_status = true;
            axios({
                method: 'POST',
                url: this.url.get_filtered_menu,
                data: {
                    brands: this.arr_brands,
                    categories: this.arr_categories,
                },
                headers: {
                    "Content-type": "application/x-www-form-urlencoded"
                }
            }).then((response) => {
                this.loading_status = false;
                this.arr_filtered_items = response.data.products;
                console.log(response.data.brands);
                this.arr_brands = response.data.brands;
                this.arr_categories = response.data.categories;
            })

        },
        show_backup_call(text) {
            window.show_backup_call(2, text);
        },

        select_brand(selected_brand){
            this.clear_filter_arr_brands();
/*
            if(selected_brand.name == "Все"){
                this.clear_filter_arr_brands();
            }else{
                this.arr_brands[0].active = false;
            }
*/
            if (selected_brand.active)
            selected_brand.active = false;
            else selected_brand.active  = true;
            this.send();
        },
        select_category(selected_category){
            this.clear_filter_arr_categories();
/*
            if(selected_category.name == "Все"){
                this.clear_filter_arr_categories();
            }else{
                this.arr_categories[0].active = false;
            }
*/
            if (selected_category.active)
                selected_category.active = false;
            else selected_category.active  = true;
            this.send();
        },
        clear_filter_arr_brands(){
            this.arr_brands.forEach(function (item, i, arr) {
                item["active"] = false;
            });
        },
        clear_filter_arr_categories(){
            this.arr_categories.forEach(function (item, i, arr) {
                item["active"] = false;
            });
        },
        ///////////////////////////////////////////////////////////////////////////////////////////////
        get_filtered_items() {
            this.arr_menu_get_filtered_items = [];
            let categories = "";
            let brands = "";
            this.menu_category.forEach(function (cat_item, cat_i, cat_arr) {
                if (cat_item["active"] == true) {
                    categories += cat_item["menu_category_item_code"] + ",";
                }
            });
            this.menu_brands.forEach(function (brand_item, brand_i, brand_arr) {
                if (brand_item["active"] == true) {
                    brands += brand_item["name"] + ",";
                }
            });
            this.arr_menu_get_filtered_items["menu_category_item_codes"] = categories;
            this.arr_menu_get_filtered_items["brands"] = brands;
            this.send();
        },
        init() {
            this.send();
        }
        ,
        ///////////////////////////////////////////////////Cookie///////////////////////////////////////////////////////
        ///////////////////////////////////////////////////Cookie///////////////////////////////////////////////////////
        ///////////////////////////////////////////////////Cookie///////////////////////////////////////////////////////
        ///////////////////////////////////////////////////Cookie///////////////////////////////////////////////////////
        getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        },
        setCookie(name, value, options = {}) {

            // Пример использования:
            //setCookie('user', 'John', {secure: true, 'max-age': 3600});
            let date = new Date;
            date.setDate(date.getDate() + 365);
            date = date.toUTCString();
            options = {
                path: '/',
                'expires': date,
                domain: '.' + window.location.host,
            };

            if (options.expires instanceof Date) {
                options.expires = options.expires.toUTCString();
            }

            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }

            document.cookie = updatedCookie;
        },
        deleteCookie(name) {
            setCookie(name, "", {
                'max-age': -1
            })
        },
        ///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
        ///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
        ///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
        ///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////

    },
    computed: {}
});