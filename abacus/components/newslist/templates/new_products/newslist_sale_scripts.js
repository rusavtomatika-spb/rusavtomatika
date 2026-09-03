var app = new Vue({
    el: '#vue_app_sale',
    data: {
        url: {
            get_filtered_menu: '/abacus/components/newslist/templates/sale/ajax_newslist_sale.php',
        },
        arr_filtered_items: [],
        arr_brands: [],
        loading_status: true,
        selectedBrandValue: '',
    },
    mounted: function() {
        this.init();
    },
    methods: {
        send() {
            this.loading_status = true;
            
            var formData = new FormData();
            formData.append('brands', this.selectedBrandValue);
            
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

        add(e) {
            alert('aaa')
            window.add_too_box(e)
        },
        
        init() {
            this.selectedBrandValue = 'Все';
            this.send();
        }
    }
});