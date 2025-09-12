$(document).ready(
    function () {

        window.addEventListener('storage', function(event) {
            if(event.key == 'cart'){
                setTimeout(function () {
                    location.reload();
                },1);
            }
        });



        let arr_cart_quantities = [];
        let box_cart_quantities = getCookie("box_cart_quantities");
        // let box_cart_quantities = undefined;
        if (box_cart_quantities !== undefined) {mess
            let arr_cookie_cart_quantities = JSON.parse(box_cart_quantities);
            arr_cookie_cart_quantities.forEach((item, i, arr) => {
                arr_cart_quantities[item["model"]] = item["qty"];
            });

        }
        load_cookie_contacts();


        count_cart_sum();

        $('.quantity_button_minus').on("click", function () {
            const obj = $(this).parent().children('.quantity_value');
            let value = $(obj).val();
            if (value > 1) {
                value--;
                $(obj).val(value);
                count_cart_sum();
            }
        });
        $('.quantity_button_plus').on("click", function () {
            const obj = $(this).parent().children('.quantity_value');
            let value = $(obj).val();
            if (value > 0) {
                value++;
                $(obj).val(value);
                count_cart_sum();
            }
        });

        $('.quantity_value').change(function () {

            let value = parseInt($(this).val());
            console.log('ty_value', value);
            if (value <= 0 ) {
                value = 1;
                $(this).val(value);
                count_cart_sum();
            }
        });

        $("#formphone").on('input', function () {
            check_inputs();
        });
        $("#formemail").on('input', function () {
            check_inputs();
        });

        function check_inputs() {
            let name = $('#formname').val();
            let phone = $('#formphone').val();
            let mail = $('#formemail').val();
            let success = 0;
            if (phone != '' && ValidPhone()) {
                success++;
            }
            if (mail != '' && ValidMail()) {
                success++;
            }
            if (success == 2) {
                $('.block_order__block_button .zakazbut').addClass('active');
                save_cookie_contacts();
            } else {
                $('.block_order__block_button .zakazbut').removeClass('active');
            }
        }

        function ValidMail() {
            var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
            let myMail = $('#formemail').val();
            var valid = re.test(myMail);
            console.log(valid);
            if (valid) {
                $('#formemail').css('border', '1px solid white');
                $('#formemail_label').css('color', 'black');
            } else {
                $('#formemail').css('border', '1px solid red');
                $('#formemail_label').css('color', 'red');
            }

            //document.getElementById('message').innerHTML = output;
            return valid;
        }

        function ValidPhone() {
//            var re = /^\d[\d\(\)\ -]{4,14}\d$/;
            var re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
            let myPhone = $('#formphone').val();
            var valid = re.test(myPhone);

            if (valid) {
                $('#formphone').css('border', '1px solid white');
                $('#formphone_label').css('color', 'black');
            } else {
                $('#formphone').css('border', '1px solid red');
                $('#formphone_label').css('color', 'red');
            }
            return valid;
        }




        $('.block_order__block_button .zakazbut').bind("click", function () {

            if (!$(this).hasClass('active')) return;
            save_cookie_contacts();

            $("#order_send_mess").html("");
            var ph = $("#formphone").val();
            var em = $("#formemail").val();
            var out = "";
/*
            if (ph == "" || em == "")
                out = "Пожалуйста, заполните телефон и email";
            if (ph.length < 11)
                out = "Пожалуйста, заполните правильно телефон ( убедитесь, что ввели код города )";
            if (!isEmail(em))
                out = "Пожалуйста, введите правильный email";
            if (bask.length == 0)
                out = "Пожалуйста, добавьте в корзину хотя бы один продукт";
            if (out != "") {
                $("#order_send_mess").html("<font color=red>" + out + "</font");
                return;
            }
*/
            $("#fileform").ajaxForm({
                beforeSubmit: function () {
                    // $('#results').html('Submitting...');
                    // alert("bfsu");
                    $("#checkfile").html("Загрузка файла...");
                },
                success: function (data) {
                    //   var $out = $('#res_file');
                    //   $out.html('Your results:');
                    //  $out.append('<div><pre>'+ data +'</pre></div>');

                    //  alert(data);

                    // $("#checkfile").html('Файл успешно загружен');
                    //  alert(  $("#out_file_res").html());
                    //  $("#out_file_res").empty();

                    //file_name=data;
                    send_order(data);
                    $("#checkfile").html("Файл загружен");
                    // alert("data="+data);
                    /*
                     $("#out_file_res").html("<table <tr><td width=90 class=dost_text height=30 title='Для выставления счета на понадобятся реквизиты Вашей компании'>  \
                     Реквизиты  </td><td class=dost_text width=200> Файл реквизитов загружен </td><td class=dost_text>\
                     <span  onclick='get_data(1,1,\"new_rekv_file\",1);' style='cursor:pointer' title='Нажмите, если  реквизиты изменились'> Загрузить новый файл &nbsp;&nbsp; <img src='/images/ques.gif' width=13 class=imgcenter> </span>  \
                     </td>\
                     </tr></table>");
                     */


                },

//                error: function (data) {
//
//                    // alert("Ошибка загрузки" );
//                    $("#checkfile").html('Ошибка загрузки файла');
//                }


            });


            //if(!bask[0]) alert("fuck");


            if ($("#formfile").val() == "")
                send_order("");
            else
                $("#fileform").submit();

// alert("file_name="+file_name);


        });

        function count_cart_sum() {
            let total_quantity = 0;
            let total_usd = 0;
            let total_rub = 0;
            let total_noprice = 0;
            let price = 0;
            $('.usd_price_value').each(function () {
                price = parseInt($(this).html());
                if (price > 0) {
                    const model = $(this).attr("data-model");
                    if (model !== undefined) {
                        const multiplier = $(".quantity_value[data-model=" + model + "]").val();
                        if (multiplier > 1) {
                            total_usd += price * multiplier;
                            total_quantity += parseInt(multiplier);
                        } else {
                            total_usd += price;
                            total_quantity++;
                        }
                        //arr_cart_quantities.push({'model': model, 'qty': multiplier});
                        arr_cart_quantities[model] = multiplier;
                    }
                }
            });
            let arr_cookie_cart_quantities = [];
            for (let key in arr_cart_quantities) {
                arr_cookie_cart_quantities.push({"model": key, "qty": arr_cart_quantities[key]});
            }

            let date = new Date;
            date.setDate(date.getDate() + 365);
            date = date.toUTCString();


            setCookie('box_cart_quantities', JSON.stringify(arr_cookie_cart_quantities), {'expires': date});

            $('.rub_price_value').each(function () {
                price = parseInt($(this).html());
                if (price > 0) {
                    const model = $(this).attr("data-model");
                    if (model !== undefined) {
                        const multiplier = $(".quantity_value[data-model=" + model + "]").val();
                        if (multiplier > 1) {
                            total_rub += price * multiplier;
                        } else {
                            total_rub += price;
                        }
                    }
                }
            });

            $('.quantity_value.no_price').each(function () {
                total_noprice += parseInt($(this).val());
            });
            $('.total_rub_value').html(total_rub);
            $('.total_usd_value').html(total_usd);
            $('.total_quantity_value').html(total_quantity + total_noprice);
            if (total_noprice > 0) {
                $('.total_noprice_value').html("Товаров с ценой по запросу: <span class='value'>" + total_noprice + "</span> шт.");
            }
        }


        function send_order(file_name) {
            var dost = "";
            if ($("#dost3").prop("checked"))
                dost = 'Самовывоз СПБ';//alert("3");
            if ($("#dost7").prop("checked"))
                dost = 'Курьерской службой «СДЭК» по РФ (1-10 дней)';//alert("4");

            var nm = $("#formname").val();
            var comp = $("#formcompany").val();
            var ph = $("#formphone").val();
            var eml = $("#formemail").val();
            var inn = $("#forminn").val();
            var dop = $("#formdop").val();
            var kpp = $("#kpp").val();
            var ogrn = $("#ogrn").val();
            var address = $("#address").val();

            //var bsk = basket_to_string();
            var cart_list = cart_to_string();


            $.ajax({
                url: "/abacus/components/catalog_cart/ajax_mess2.php",
                type: "POST",
                dataType: "html", //"json",
                data: {
                    dostavka: dost,
                    name: nm,
                    company: comp,
                    phone: ph,
                    email: eml,
                    inn: inn,
                    dop: dop,
                    kpp: kpp,
                    ogrn: ogrn,
                    address: address,
                    basket: cart_list,
                    file: file_name
                },
                success: function (msg) {
                    console.log(msg);
                    // alert(msg);
                    //$("#form_out").html(msg);
                    // $("#conn_info").html("");

                    if (msg == 'true') {
                        $('.component_catalog_cart__panel_of_products').html('');
                        $('.block_order').html('');
						window.scrollTo({ top: 0, behavior: 'smooth' });

                        //$('.block_order__block_button').html('');


                    }
                    $("#order_send_mess").html("<div class='order_send_mess'><font color=green>Спасибо, Ваш заказ успешно отправлен. Мы свяжемся с Вами в ближайшее время.</font></div>");
                    deleteCookie("box2_cart");
                },

            });


            save_cookie_contacts();

        }


        function cart_to_string() {
            let out = '<tr><td></td><td><b>Модель</b></td><td><b>Цена</b></td><td><b>Количество</b></td></tr>';
            let counter = 0;
            //$('table.series_products tr').each(function () {
            $('div.series_products div.tr').each(function () {
                counter++;
                let model = $(this).find('.model').html();
                let price = $(this).find('.price_block').html();
                let quantity = $(this).find('.quantity_value').val();
                out += '<tr>' + '<td>' + counter + '</td>' + '<td>' + model + '</td>' + '<td>' + price + '</td>' + '<td>' + quantity + ' шт.</td>' + '</tr>';
            });
            let total_noprice_value = $('.panel_itogo .total_noprice_value .value').html();
            let text_total_noprice_value = '';
            if (total_noprice_value !== undefined) {
                text_total_noprice_value = "<div>(В том числе <div>без цены:</div> " + total_noprice_value + " шт.)</div>";
            }
            let total_quantity_value = $('.panel_itogo .total_quantity_value').html();
            let total_usd_value = $('.panel_itogo .total_usd_value').html();
            let total_rub_value = $('.panel_itogo .total_rub_value').html();
            out += '<tr><td></td>' + '<td style="text-align: right">' + '<b>Сумма:</b></td><td style="text-align: left"><div><b>' + total_usd_value + ' $</b></div><div><b>' + total_rub_value + ' руб.</b></div></td><td><b>' + 'Всего: ' + total_quantity_value + ' шт.</b>' + text_total_noprice_value + '</td></tr>';
            return "<table cellspacing='0' border='1' cellpadding='15' width='100%' style='width:100%;text-align: left;background: #dff3df' >" + out + "</table><br><hr><br>";
        }

        function save_cookie_contacts() {
//            $.cookie('cookie_contacts', $("#formname").val() + "#" + $("#formcompany").val() + "#" + $("#formphone").val() + "#" + $("#formemail").val(), {expires: 365});
      Cookies.set('cookie_contacts', $("#formname").val() + "#" + $("#formcompany").val() + "#" + $("#forminn").val() + "#" + $("#kpp").val() + "#" + $("#ogrn").val() + "#" + $("#address").val() + "#" + $("#formphone").val() + "#" + $("#formemail").val() + "#" + $("#formdop").val(), {
        expires: 365
      });
        }

    function load_cookie_contacts() {
      let ss = Cookies.get('cookie_contacts');
      if (ss !== undefined) {
        var cont = ss.split("#");
        $("#formname").val(cont[0]);
        $("#formcompany").val(cont[1]);
        $("#formphone").val(cont[2]);
        $("#formemail").val(cont[3]);
        $("#forminn").val(cont[4]);
        $("#formdop").val(cont[5]);
      }
      check_inputs();
    }


        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        function setCookie(name, value, options = {}) {

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
            updatedCookie +=  ';SameSite=Strict;Secure';
            document.cookie = updatedCookie;
        }

        function deleteCookie(name) {
            setCookie(name, "", {
                'max-age': -1
            })
        }


    }
);



function join(arr) {
  var separator = arguments.length > 1 ? arguments[1] : ", ";
  return arr.filter(function(n){return n}).join(separator);
}

function typeDescription(type) {
  var TYPES = {
    'INDIVIDUAL': 'Индивидуальный предприниматель',
    'LEGAL': 'Организация'
  }
  return TYPES[type];
}

function showSuggestion(suggestion) {
  console.log(suggestion);
  var data = suggestion.data;
  if (!data)
    return;

  $("#type").text(
  typeDescription(data.type) + " (" + data.type + ")"
  );

  if (data.name)
    //$("#company").val(join([data.opf && data.opf.short || "", data.name.short || data.name.full], " "));

    $("#forminn").val(data.inn);
    $("#kpp").val(data.kpp);

    $("#ogrn").val(data.ogrn);

  if (data.address)
    $("#address").val(data.address.value);
  }

  $("#formcompany").suggestions({
  token: "2fe032454318a8fa0c013d2927d70ccc28154d1b",
  type: "PARTY",
  count: 5,
  onSelect: showSuggestion
  });