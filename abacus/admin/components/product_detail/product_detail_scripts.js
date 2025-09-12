const {createApp} = Vue
createApp({
    data() {
        return {
            url: '/abacus/admin/ajax/abacus_admin_ajax.php',
            ajax_command: '',
            ajax_data: {},
            product_fields: [],
            field_descriptions: [],
            title: '',
            message: '',
            action_aftermath: '',
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
            $(window).scroll(function () {
                if ($(this).scrollTop() >= 40) {
                    $('.sticky').addClass('stickytop');
                } else {
                    $('.sticky').removeClass('stickytop');
                }
            });

            const App = document.getElementById('app');
            this.ajax_command = 'product.get'
            this.ajax_data = {
                id: App.getAttribute('data-product-id'),
            }
            this.send();
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
                if (this.ajax_command == 'product.get') {
                    this.product_fields = response.data.result.product_fields;
                    this.field_descriptions = response.data.result.field_descriptions;
                    this.title += this.product_fields['model'] + ' (id: ' + this.product_fields['index'] + ')';
                }
                if (this.ajax_command == 'product.save') {
                    if(response.data.result){
                        this.message = 'Сохранено!';
                        if(this.action_aftermath == 'close'){
                            setTimeout(()=>{
                                window.location.href = "/abacus/admin/products/";
                            },1000);
                        }
                        setTimeout(()=>{
                            this.message = '';
                        },5000);
                    }
                }


            });
        },

        save(action_aftermath) {
            this.action_aftermath = action_aftermath;
            this.ajax_command = "product.save";
            this.ajax_data = this.product_fields;
            this.send();
        },
        redirect(url){
            window.location.href = url;
        },
        hide(){
            console.log('hide');
        },
        sort(mode) {
            console.log(mode);

        },


    },
}).mount('#app');