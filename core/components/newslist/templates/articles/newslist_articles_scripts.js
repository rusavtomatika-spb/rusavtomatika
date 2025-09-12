var app = new Vue({
    el: '#vue_app_articles',
    data: {
        url: {
            newslist_articles: '/core/components/newslist/templates/articles/ajax_newslist_articles.php?',
            crud: '/core/components/newslist/templates/articles/ajax_crud.php?',
            save_cash: '/core/components/newslist/templates/articles/ajax_send_cache.php?',
        },
        arr_filtered_items: [],
        arr_pager_items: [],
        arr_brands: [],
        arr_categories: [],
        crud_arr_extra_params: {},
        loading_status: true,
        current_original_edit_item: {},
        current_edit_item: {
            id: '',
            brand: '',
            date: '',
            name: '',
            sys_name: '',
            stext: '',
            btext: '',
            show: '',
            por: '',
            title_cat: '',
            description: '',
            keywords: '',
            img: '',
            alt: '',

        },
        all_brands: [],
        edit_panel_show: false,
        file: '',
        file2: '',
        showing_popup_message: false,
        showing_delete_confirm_message: false,
        showing_confirm_message_delete_file: false,
        deleting_image_file: null,
        deleting_element_index: null,
        text_delete_confirm: '',
        text_popup_message: '',
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

        get_admin_panel(div_admin_panel) {
            const urlParams = new URLSearchParams(window.location.search);
            const page = urlParams.get('page');
            axios({
                method: 'POST',
                url: this.url.get_admin_panel,
                data: {
                    page: page,
                },
                headers: {
                    "Content-type": "application/x-www-form-urlencoded"
                }
            }).then((response) => {

                div_admin_panel.innerHTML = response.data;
            })
        },
        switch_edit_mode__button_clicked(button) {
            if (this.getCookie("edit_mode") == '1') {
                this.setCookie("edit_mode", 0);
                $(button.target).removeClass('active');

            } else {
                this.setCookie("edit_mode", 1);
                $(button.target).addClass('active');

            }
            window.location.reload();
        },
        add_element_button__clicked() {
        },
        edit_element_button__clicked(item) {
            const context = this;
            this.edit_panel_show = true;
            document.body.style.overflow = "hidden";
            this.current_edit_item = item;
            this.current_original_edit_item = {...item};
            //console.log(tinymce);
            setTimeout(() => {
                    //console.log(tinymce);
                    tinymce.init({
                        selector: '#mytextarea',
                        convert_urls : false,
                        paste_data_images: true,
                        textcolor_cols: "5",
                        language : "ru",
                        height: "1000",
                        width: "100%",
                        theme: 'silver',
                        plugins: ['code', 'image', 'anchor','fullscreen', 'table', 'link', 'paste', 'colorpicker'],
                        toolbar: 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | table | link | paste pastetext | image | fullscreen | code',
                        content_css: "/css/wisywig.css",
                        image_class_list: [
                            {title: 'Нет', value: ''},
                            {title: 'Выровнять по центру', value: 'image-align-center'},
                            {title: 'Выровнять влево', value: 'image-align-left'},
                            {title: 'Выровнять вправо', value: 'image-align-right'}
                        ],
                        textcolor_map: [
                            "000000", "Black",
                            "993300", "Burnt orange",
                            "333300", "Dark olive",
                            "003300", "Dark green",
                            "003366", "Dark azure",
                            "000080", "Navy Blue",
                            "333399", "Indigo",
                            "333333", "Very dark gray",
                            "800000", "Maroon",
                            "FF6600", "Orange",
                            "808000", "Olive",
                            "008000", "Green",
                            "008080", "Teal",
                            "0000FF", "Blue",
                            "666699", "Grayish blue",
                            "808080", "Gray",
                            "FF0000", "Red",
                            "FF9900", "Amber",
                            "99CC00", "Yellow green",
                            "339966", "Sea green",
                            "33CCCC", "Turquoise",
                            "3366FF", "Royal blue",
                            "800080", "Purple",
                            "999999", "Medium gray",
                            "FF00FF", "Magenta",
                            "FFCC00", "Gold",
                            "FFFF00", "Yellow",
                            "00FF00", "Lime",
                            "00FFFF", "Aqua",
                            "00CCFF", "Sky blue",
                            "993366", "Red violet",
                            "FFFFFF", "White",
                            "FF99CC", "Pink",
                            "FFCC99", "Peach",
                            "FFFF99", "Light yellow",
                            "CCFFCC", "Pale green",
                            "CCFFFF", "Pale cyan",
                            "99CCFF", "Light sky blue",
                            "CC99FF", "Plum"
                        ],

                        setup:(ed)=> {
                            ed.on('change', function(e) {
                                //console.log('the event object ', e);
                                //console.log('the editor object ', ed);
                                //console.log('the content ', ed.getContent());
                                //console.log(context);
                                //textarea = document.querySelector('#mytextarea');
                                context.current_edit_item.btext = ed.getContent();
                            });
                        }
                    });}, 1000);


        },
        copy_element_button__clicked(item) {
            this.current_edit_item = item;
            this.crud("copy");
            //
        },
        edit_close_element_button__clicked() {
            this.edit_panel_show = false;
            document.body.style.overflow = "";
            tinymce.remove();
        },
        edit_restore_element_button__clicked(item) {
            //item = {};
            Object.assign(item, this.current_original_edit_item);
        },
        activate_element_button_clicked(item) {
            item.show = 1;
            this.current_edit_item = item;
            this.crud('update');
        },
        deactivate_element_button_clicked(item) {
            item.show = 0;
            this.current_edit_item = item;
            this.crud('update');
        },

        edit_save_element_button__clicked() {
            this.crud("update");
        },
        edit_save_and_close_element_button__clicked() {
            this.crud("update");
            this.edit_panel_show = false;
            document.body.style.overflow = "";
            tinymce.remove();
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
            this.file2 = this.$refs.file2.files[0];
        },
        submitFile(id, mode) {
            let formData = new FormData();
            //formData.append('action', 'upload_file');

            if (mode == 'preview') {
                formData.append('file', this.file);
            }
            if (mode == 'details') {

                let arr_file_name = this.file2.name.toLowerCase().split('.');
                let fileExt = arr_file_name.pop();
                let fileName = arr_file_name.pop();
                fileName = this.cyr2lat(fileName.toLowerCase());
                formData.append('new_file_name', fileName + '.' + fileExt);
                formData.append('file', this.file2);
            }
            formData.append('action', 'upload_file');
            formData.append('id', this.current_edit_item.id);
            axios.post(
                this.url.crud,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then((response) => {
                if (mode == 'preview') {
                    this.current_edit_item.img = response.data.result.uploaded_file;
                }
                if (mode == 'details') {
                    this.current_edit_item.images.push(response.data.result.uploaded_file);
                }
                this.files = '';
            }).catch(function (response) {
                console.log(response);
            });
        },
        crud($action) {
            axios({
                method: 'POST',
                url: this.url.crud,
                data: {
                    action: $action,
                    item: this.current_edit_item,
                    crud_arr_extra_params: this.crud_arr_extra_params,
                },
                headers: {
                    "Content-type": "application/x-www-form-urlencoded"
                }
            }).then((response) => {
                console.log(response);
                if (response.data.result.success !== undefined && response.data.result.success == '1') {
                    if ($action == "delete") {
                        this.arr_filtered_items.splice(this.deleting_element_index, 1);
                    }
                    if ($action == "copy") {
                        this.current_edit_item.id = response.data.result.last_inserted_id;
                        this.arr_filtered_items.unshift(Object.assign({}, this.current_edit_item));
                        document.location.reload();
                    }
                    if ($action == "delete_image_file") {
                        //console.log(this.current_edit_item);
                        this.current_edit_item.images = this.current_edit_item.images.filter((item)=> {
                            return item !== this.crud_arr_extra_params.file
                        });
                    }
                    this.show_popup_message('Готово!', 1000);
                } else {
                    this.show_popup_message('Что-то пошло не так!', 4000);
                    console.log(response);
                }
            });

        },
        send(mode = '') {
            let str_categories = '';
            let str_brands = '';
            this.loading_status = true;
            const urlParams = new URLSearchParams(window.location.search);
            const page = urlParams.get('page');
            axios({
                method: 'POST',
                url: this.url.newslist_articles,
                data: {
                    brands: this.arr_brands,
                    categories: this.arr_categories,
                    page: page,
                },
                headers: {
                    "Content-type": "application/x-www-form-urlencoded"
                }
            }).then((response) => {
                this.loading_status = false;
                this.arr_filtered_items = response.data.products;
                this.all_brands = response.data.all_brands;
                this.arr_brands = response.data.brands;
                this.arr_pager_items = response.data.pager_items;
                //this.arr_categories = response.data.categories;
                if (mode == 'send_cash') {
                    setTimeout(() => {
                        this.send_cash();
                    }, 1000);
                }
                const rendering_content_dest = document.querySelector('#rendering_content_dest');
                if (rendering_content_dest !== null) {
                    rendering_content_dest.innerHTML = '';
                }
            });

        },
        send_cash() {
            const html_content = document.querySelector('#rendering_content_source');
            if (html_content !== null) {
                axios({
                    method: 'POST',
                    url: this.url.save_cash,
                    data: {
                        html: html_content.innerHTML,
                        page: window.location,
                    },
                    headers: {
                        "Content-type": "application/x-www-form-urlencoded"
                    }
                }).then((response) => {

                });
            }
        },

        generate_code() {
            this.current_edit_item.sys_name = this.cyr2lat(this.current_edit_item.name.toLowerCase());
        },
        show_popup_delete_confirm_message(item) {
            this.current_edit_item = item;
            this.text_delete_confirm = 'Удалить статью <div>ID ' + item.id + ': &laquo;' + item.name + '&raquo;</div> ???';
            this.showing_delete_confirm_message = true;
            //setTimeout(()=>{this.showing_popup_message = false},time);

        },
        show_popup_delete_confirm_file(item) {
            this.text_delete_confirm = 'Удалить файл? <div>&laquo; ' + item + ' &raquo;</div>';
            this.deleting_image_file = item;
            this.showing_confirm_message_delete_file = true;
        },
        delete_image_file(){
            //this.alert(this.deleting_image_file);
            if(this.deleting_image_file !== null && this.deleting_image_file != ""){
                this.crud_arr_extra_params = {'file': this.deleting_image_file}
                this.crud('delete_image_file');
                this.showing_confirm_message_delete_file = false;
            }
        },
        delete_element(index) {
            this.crud('delete');
            this.showing_delete_confirm_message = false;
        },
        show_popup_message(text, time) {
            this.text_popup_message = text;
            this.showing_popup_message = true;
            setTimeout(() => {
                this.showing_popup_message = false
            }, time);

        },
        show_backup_call(text) {
            window.show_backup_call(2, text);
        },

        select_brand(selected_brand) {
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
            else selected_brand.active = true;
            this.send();
        },
        select_category(selected_category) {
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
            else selected_category.active = true;
            this.send();
        },
        clear_filter_arr_brands() {
            this.arr_brands.forEach(function (item, i, arr) {
                item["active"] = false;
            });
        },
        clear_filter_arr_categories() {
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
            this.send('send_cash');
        },

        cyr2lat(str) {

            let cyr2latChars = new Array(['а', 'a'], ['б', 'b'], ['в', 'v'], ['г', 'g'],
                ['д', 'd'], ['е', 'e'], ['ё', 'yo'], ['ж', 'zh'], ['з', 'z'],
                ['и', 'i'], ['й', 'y'], ['к', 'k'], ['л', 'l'],
                ['м', 'm'], ['н', 'n'], ['о', 'o'], ['п', 'p'], ['р', 'r'],
                ['с', 's'], ['т', 't'], ['у', 'u'], ['ф', 'f'],
                ['х', 'h'], ['ц', 'c'], ['ч', 'ch'], ['ш', 'sh'], ['щ', 'shch'],
                ['ъ', ''], ['ы', 'y'], ['ь', ''], ['э', 'e'], ['ю', 'yu'], ['я', 'ya'],
                ['А', 'A'], ['Б', 'B'], ['В', 'V'], ['Г', 'G'],
                ['Д', 'D'], ['Е', 'E'], ['Ё', 'YO'], ['Ж', 'ZH'], ['З', 'Z'],
                ['И', 'I'], ['Й', 'Y'], ['К', 'K'], ['Л', 'L'],
                ['М', 'M'], ['Н', 'N'], ['О', 'O'], ['П', 'P'], ['Р', 'R'],
                ['С', 'S'], ['Т', 'T'], ['У', 'U'], ['Ф', 'F'],
                ['Х', 'H'], ['Ц', 'C'], ['Ч', 'CH'], ['Ш', 'SH'], ['Щ', 'SHCH'],
                ['Ъ', ''], ['Ы', 'Y'],
                ['Ь', ''],
                ['Э', 'E'],
                ['Ю', 'YU'],
                ['Я', 'YA'],
                ['a', 'a'], ['b', 'b'], ['c', 'c'], ['d', 'd'], ['e', 'e'],
                ['f', 'f'], ['g', 'g'], ['h', 'h'], ['i', 'i'], ['j', 'j'],
                ['k', 'k'], ['l', 'l'], ['m', 'm'], ['n', 'n'], ['o', 'o'],
                ['p', 'p'], ['q', 'q'], ['r', 'r'], ['s', 's'], ['t', 't'],
                ['u', 'u'], ['v', 'v'], ['w', 'w'], ['x', 'x'], ['y', 'y'],
                ['z', 'z'],
                ['A', 'A'], ['B', 'B'], ['C', 'C'], ['D', 'D'], ['E', 'E'],
                ['F', 'F'], ['G', 'G'], ['H', 'H'], ['I', 'I'], ['J', 'J'], ['K', 'K'],
                ['L', 'L'], ['M', 'M'], ['N', 'N'], ['O', 'O'], ['P', 'P'],
                ['Q', 'Q'], ['R', 'R'], ['S', 'S'], ['T', 'T'], ['U', 'U'], ['V', 'V'],
                ['W', 'W'], ['X', 'X'], ['Y', 'Y'], ['Z', 'Z'],
                [' ', '-'], ['0', '0'], ['1', '1'], ['2', '2'], ['3', '3'],
                ['4', '4'], ['5', '5'], ['6', '6'], ['7', '7'], ['8', '8'], ['9', '9'],
                ['-', '-'],['_', '_']);

            let newStr = new String();

            for (let i = 0; i < str.length; i++) {
                ch = str.charAt(i);
                var newCh = '';
                for (var j = 0; j < cyr2latChars.length; j++) {
                    if (ch == cyr2latChars[j][0]) {
                        newCh = cyr2latChars[j][1];
                    }
                }
                // Если найдено совпадение, то добавляется соответствие, если нет - пустая строка
                newStr += newCh;
            }

            // Удаляем повторяющие знаки - Именно на них заменяются пробелы.
            // Так же удаляем символы перевода строки.
            return newStr.replace(/[-]{2,}/gim, '-').replace(/\n/gim, '');
        },
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