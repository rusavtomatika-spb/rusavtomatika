if (document.querySelector('#app_vue_updater') !== null) {
    var app = new Vue({
            el: '#app_vue_updater',
            data: {
                self_ajax_url: '/updater/ajax_updater.php',
                source_ajax_url: 'https://www.rusavto.moisait.net/updater_source/ajax_updater_source.php?indexindex',
                destination_ajax_url: '/updater/ajax/ajax_updater_destination.php',
                loading_status: false,
                panel_loading: false,
                panel_settings: false,
                start_updating_all: 0,
                current_step_files: 0,
                current_step_database: 0,
                self_list_of_files: {},
                ajax_reply: {},
                ajax_reply_message: "",
                mess_strings: {
                    "dest_list_of_files_is_created": "Создан список своих файлов",
                    "dest_list_of_files_is_saved_on_source": "Список своих файлов отправлен на ИСТОЧНИК",
                    "source_list_of_files_is_created_on_source": "Создан список файлов на ИСТОЧНИКЕ",
                    "difference_list_of_files_is_created_on_source": "Составлен список РАЗНЫХ файлов",
                    "zip_file_is_created_on_source": "Создан zip-архив РАЗНЫХ файлов",
                    "zip_file_is_downloaded": "Zip-архив скачан",
                    "zip_file_is_extracted": "Zip-архив распакован!!!",
                    "sql_backup_is_created": "Создан sql-файл базы данных на источнике",
                    "sql_backup_is_downloaded": "Sql-файл скачан",
                    "database_is_updated": "База данных обновлена",
                },
                database_host: "",
                database_name: "",
                database_user: "",
                database_password: "",
                updater_password1: "",
                updater_password2: "",
                updater_password_new: "",
                updater_password: "",
                disable_edit_settings_button: false,
                disable_settings_editing: true,
                disable_save_settings_button: true,
                disable_cancel_settings_button: true,
                progress_bar_max_value: 70,
                progress_bar_value: 0,

            },
            watch: {
                start_updating_all(val) {
                    if (val == 2) {
                        this.send(this.source_ajax_url, "update_database_create_sql_dump", {});
                        this.start_updating_all = 0;
                    }
                },
                ajax_reply(val) {
                    //console.log(val['reply']);
                    if (typeof val['reply'] != 'undefined') {
                        switch (val['reply']) {
                            case 'dest_list_of_files_is_created':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message = this.mess_strings[val['reply']] + '<br>';
                                this.send(this.source_ajax_url, "take_dest_list_of_files", val.files); // посылаем на source список файлов
                                break;
                            case 'dest_list_of_files_is_saved_on_source':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + '<br>';
                                this.send(this.source_ajax_url, "create_source_list_of_files", {}); // командуем сорсу создать свой список файлов
                                break;
                            case 'source_list_of_files_is_created_on_source':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + '<br>';
                                this.send(this.source_ajax_url, "create_difference_list_of_files", {}); // командуем сорсу найти различия в файлах
                                break;
                            case 'difference_list_of_files_is_created_on_source':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + ' ';
                                this.ajax_reply_message += val['data'].toString() + '<br>';
                                if (Number(val['counter']) > 0) {
                                    this.send(this.source_ajax_url, "create_zip_list_of_files", {});
                                } // командуем сорсу создать архив отличающихся файлов
                                else {
                                    this.ajax_reply_message += '<b>Файлы на обоих серверах совпадают!</b><hr>';
                                    if (this.start_updating_all == 1) {
                                        this.start_updating_all = 2;
                                        this.progress_bar_value += 30;
                                    } else {
                                        this.progress_bar_value += 40;
                                        this.enable_buttons_submit();
                                    }
                                }
                                break;
                            case 'zip_file_is_created_on_source':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + ' ';
                                this.ajax_reply_message += val['data']['link'].toString() + '<br>';
                                //this.ajax_reply_message += val['buffer'].toString()+'<br>';
                                this.send(this.destination_ajax_url, "download_zip_from_source", {"link": val['data']['link'].toString()}); // командуем сорсу создать архив отличающихся файлов
                                break;
                            case 'zip_file_is_downloaded':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + ' ';
                                this.ajax_reply_message += val['buffer'].toString() + '<br>';
                                this.send(this.destination_ajax_url, "extract_zip_list_of_files"); // командуем распаковать архив отличающихся файлов
                                break;
                            case 'zip_file_is_extracted':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + '<br>';
                                this.ajax_reply_message += val['buffer'].toString() + '<br>';
                                if (this.start_updating_all == 1) {
                                    this.start_updating_all = 2;
                                } else {
                                    this.progress_bar_value = 80;
                                    this.enable_buttons_submit();
                                }
                                break;
                            case 'sql_backup_is_created':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + '<br>';
                                this.ajax_reply_message += val['data']['link'].toString() + '<br>';
                                this.enable_buttons_submit();
                                this.send(this.destination_ajax_url, "download_sql_backup", {"link": val['data']['link'].toString()}); //
                                break;
                            case 'sql_backup_is_downloaded':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + '<br>';
                                this.ajax_reply_message += val['buffer'].toString() + '<br>';
                                this.send(this.destination_ajax_url, "update_database", {}); //
                                break;
                            case 'database_is_updated':
                                this.progress_bar_value += 10;
                                this.ajax_reply_message += this.mess_strings[val['reply']] + '<br><hr><br>';
                                this.ajax_reply_message += val['buffer'].toString() + '<br>';
                                break;
                            case 'take_settings':
                                console.log(val);
                                this.updater_password1 = "";
                                this.updater_password2 = "";
                                this.database_host = val['settings']['database_server']['database_host'];
                                this.database_name = val['settings']['database_server']['database_name'];
                                this.database_user = val['settings']['database_server']['database_user'];
                                this.database_password = val['settings']['database_server']['database_password'];
                                this.updater_password = val['settings']['updater_password'];
                                break;
                            default:
                                this.alert("В источнике произошла ошибка! " + val['reply']);
                                break;
                        }
                    }
                }
            },
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
                button_settings_clicked() {
                    this.panel_settings = !this.panel_settings;
                    if (this.panel_settings) this.send(this.destination_ajax_url, "read_settings", {});
                },
                button_settings_clicked() {
                    this.panel_settings = !this.panel_settings;
                    if (this.panel_settings) this.send(this.destination_ajax_url, "read_settings", {});
                },
                button_edit_settings_clicked() {
                    this.disable_edit_settings_button = true;
                    this.disable_settings_editing = false;
                    this.disable_save_settings_button = false;
                    this.disable_cancel_settings_button = false;

                },
                button_save_settings_clicked() {
                    this.disable_edit_settings_button = false;
                    this.disable_settings_editing = true;
                    this.disable_save_settings_button = true;
                    this.disable_cancel_settings_button = true;

                    if (this.updater_password1 != "" && this.updater_password1 == this.updater_password2) {
                        this.updater_password_new = this.updater_password1;
                    } else this.updater_password_new = "";

                    if (this.panel_settings) this.send(this.destination_ajax_url,
                        "save_settings",
                        {
                            "settings": {
                                "database_server":
                                    {
                                        "database_host": this.database_host,
                                        "database_name": this.database_name,
                                        "database_user": this.database_user,
                                        "database_password": this.database_password,
                                    },
                                "updater_password_new": this.updater_password_new,
                            }
                        }
                    );
                }
                ,
                button_cancel_settings_clicked() {
                    this.disable_edit_settings_button = false;
                    this.disable_settings_editing = true;
                    this.disable_save_settings_button = true;
                    this.disable_cancel_settings_button = true;
                    if (this.panel_settings) this.send(this.destination_ajax_url, "read_settings", {});
                }
                ,
                enable_buttons_submit() {
                    let submit_buttons = document.querySelectorAll('.button_submit');
                    if (submit_buttons !== null) {
                        submit_buttons.forEach((button) => {
                            button.disabled = false;
                        });
                    }
                }
                ,
                disable_buttons_submit() {
                    let submit_buttons = document.querySelectorAll('.button_submit');
                    if (submit_buttons !== null) {
                        submit_buttons.forEach((button) => {
                            button.disabled = true;
                        });
                    }
                }
                ,
                button_update_all_clicked() {
                    this.progress_bar_value = 0;
                    this.progress_bar_max_value = 100;
                    this.start_updating_all = 1;
                    this.disable_buttons_submit();
                    this.ajax_reply_message = "";
                    this.send(this.destination_ajax_url, "create_self_list_of_files", {});
                }
                ,
                button_update_files_clicked() {
                    this.progress_bar_value = 0;
                    this.progress_bar_max_value = 80;
                    this.start_updating_all = 0;
                    this.disable_buttons_submit();
                    this.ajax_reply_message = "";
                    this.send(this.destination_ajax_url, "create_self_list_of_files", {});
                }
                ,
                button_update_hta_clicked() {
                    this.progress_bar_value = 0;
                    this.progress_bar_max_value = 80;
                    this.start_updating_all = 0;
                    this.disable_buttons_submit();
                    this.ajax_reply_message = "";
                    this.send(this.destination_ajax_url, "create_self_list_of_files_hta", {});
                }
                ,
                button_update_down_clicked() {
                    this.progress_bar_value = 0;
                    this.progress_bar_max_value = 80;
                    this.start_updating_all = 0;
                    this.disable_buttons_submit();
                    this.ajax_reply_message = "";
                    this.send(this.destination_ajax_url, "create_self_list_of_files_down", {});
                }
                ,
                button_update_database_clicked() {
                    this.progress_bar_value = 0;
                    this.progress_bar_max_value = 30;
                    this.start_updating_all = 0;
                    this.disable_buttons_submit();
                    this.ajax_reply_message = "";
                    this.send(this.source_ajax_url, "update_database_create_sql_dump", {});
                }
                ,
                get_list_of_local_files() {
                    this.send("list_of_local_files");
                }
                ,
                send(url, action, data) {
                    this.panel_loading = true;
                    axios({
                        method: 'POST',
                        url: url,
                        data: {
                            action: action,
                            data: data,
                        },
                        headers: {
                            "Content-type": "application/x-www-form-urlencoded"
                        }
                    }).then((response) => {
                        this.panel_loading = false;
                        //console.log(response.data);
                        this.ajax_reply = response.data;
                    }).catch(function (error) {
                        this.panel_loading = false;
                        this.alert("Сетевая ошибка! Network's error!");
                        console.log("Вот сучка!", error);
                    });
                    ;
                }
                ,
                init() {
                    let current_context = this;
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
                }
                ,
                setCookie(name, value, options = {}) {

                    // Пример использования:
                    //setCookie('user', 'John', {secure: true, 'max-age': 3600});
                    options = {
                        path: '/',
                        samesite: 'lax',
                        // при необходимости добавьте другие значения по умолчанию
                        //...options
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
                    console.log(updatedCookie);

                    document.cookie = updatedCookie;
                }
                ,
                deleteCookie(name) {
                    setCookie(name, "", {
                        'max-age': -1
                    })
                }
                ,
///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////
///////////////////////////////////////////////End Cookie///////////////////////////////////////////////////////

            },
            computed: {}
        })
    ;

}
