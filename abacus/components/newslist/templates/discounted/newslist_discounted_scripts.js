var app = new Vue({
    el: '#vue_app_discounted',
    data: {
        url: {
            get_filtered_menu: '/abacus/components/newslist/templates/discounted/ajax_newslist_discounted.php',
        },
        arr_filtered_items: [],
        arr_brands: [],
        arr_categories: [],
        loading_status: true,
        selectedBrandValue: '',
        selectedCategoryValue: '',
    },
    mounted: function() {
        this.init();
    },
    methods: {
        send() {
            this.loading_status = true;
            
            var formData = new FormData();
            formData.append('brands', this.selectedBrandValue);
            formData.append('categories', this.selectedCategoryValue);
            
            axios.post(this.url.get_filtered_menu, formData)
            .then((response) => {
                this.loading_status = false;
                
                this.arr_filtered_items = response.data.products || [];
                
                if (response.data.brands) {
                    this.arr_brands = response.data.brands.map(brand => {
                        brand.active = (brand.name === this.selectedBrandValue);
                        return brand;
                    });
                }
                
                if (response.data.categories) {
                    this.arr_categories = response.data.categories.map(category => {
                        category.active = (category.name === this.selectedCategoryValue);
                        return category;
                    });
                }
                
                const prerendered = document.querySelector("#prerendered_content");
                if (prerendered) {
                    prerendered.innerHTML = '';
                }
            })
            .catch((error) => {
                console.error('Filter error:', error);
                this.loading_status = false;
            });
        },
        
        show_backup_call(text) {
            window.show_backup_call(2, text);
        },
        
        select_brand(selected_brand) {
            this.selectedBrandValue = selected_brand.name;
            this.arr_brands.forEach((brand) => {
                brand.active = (brand.name === this.selectedBrandValue);
            });
            this.send();
        },
        
        select_category(selected_category) {
            this.selectedCategoryValue = selected_category.name;
            this.arr_categories.forEach((category) => {
                category.active = (category.name === this.selectedCategoryValue);
            });
            this.send();
        },
        
        init() {
            this.selectedBrandValue = 'Все';
            this.selectedCategoryValue = 'Все';
            this.send();
        }
    }
});