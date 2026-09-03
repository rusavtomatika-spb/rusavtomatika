	document.addEventListener("DOMContentLoaded", function() { // событие загрузки страницы

    // выбираем на странице все элементы типа textarea и input
    document.querySelector('.kolvo').forEach(function(e) {
        // если данные значения уже записаны в sessionStorage, то вставляем их в поля формы
        // путём этого мы как раз берём данные из памяти браузера, если страница была случайно перезагружена
        if(e.value === '') e.value = window.sessionStorage.getItem(e.name, e.value);
        // на событие ввода данных (включая вставку с помощью мыши) вешаем обработчик
        e.addEventListener('.kolvo', function() {
            // и записываем в sessionStorage данные, в качестве имени используя атрибут name поля элемента ввода
            window.sessionStorage.setItem(e.name, e.value);
        })
    })

}); 

$(document).ready(
  function () {

    window.addEventListener('storage', function (event) {
      if (event.key == 'cart') {
        setTimeout(function () {
          location.reload();
        }, 1);
      }
    });
  function numberWithSpaces(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  }


    let arr_cart_quantities = [];
    let box_cart_quantities = getCookie("box3_cart_quantities");
    // let box_cart_quantities = undefined;
    if (box_cart_quantities !== undefined) {
      let arr_cookie_cart_quantities = JSON.parse(box_cart_quantities);
      arr_cookie_cart_quantities.forEach((item, i, arr) => {
        arr_cart_quantities[item["model"]] = item["qty"];
		  //alert(item["model"]);
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

//    $('.quantity_value').change(function () {
//
//      let value = parseInt($(this).val());
//      console.log('ty_value', value);
//      if (value <= 0) {
//        value = 1;
//        $(this).val(value);
//        count_cart_sum();
//      }
//    });

    $('.quantity_value').change(function () {

      let value = parseInt($(this).val());
      console.log('ty_value', value);
      if (value > 0) {
        $(this).val(value);
        count_cart_sum();
      } else {
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
    $("#formcompany").on('input', function () {
      check_inputs();
    });
    $("#urlico").on('input', function () {
		status = 'urlico';
      check_inputs();
    });
    $("#fizlico").on('input', function () {
 		status = 'fizlico';
      check_inputs();
    });
    $("status").on('input', function () {
      check_inputs();
    });

    const box = document.getElementById('urlicobox');
    const org_name = document.getElementById('formcompany');

    function handleRadioClick() {
      if (document.getElementById('urlico').checked) {
        box.style.display = 'block';
        formcompany.setAttribute('required', '')
        document.getElementById("org_leg").innerHTML = 'Название <span style="color:red;">*</span>';
        document.getElementById("name_leg").innerHTML = 'Контактное лицо:';		
        document.getElementById("adr").style.display = 'inline-flex';		
      } else {
        box.style.display = 'none';
        formcompany.removeAttribute('required', '')
        document.getElementById("org_leg").innerText = 'Название';
        document.getElementById("formcompany").value = '';
        document.getElementById("formaddress").value = '';
        document.getElementById("forminn").value = '';
        document.getElementById("formkpp").value = '';
        document.getElementById("formogrn").value = '';
        document.getElementById("name_leg").innerHTML = 'Ваше имя:';		
        document.getElementById("adr").style.display = 'none';		
     }
		//alert(status);
    }

    const radioButtons = document.querySelectorAll('input[name="status"]');
    radioButtons.forEach(radio => {
      radio.addEventListener('click', handleRadioClick);
    });

    function check_inputs() {
      let name = $('#formname').val();
      let phone = $('#formphone').val();
      let mail = $('#formemail').val();
      let company = $('#formcompany').val();
      let status = document.querySelector('input[name="status"]:checked').value;
//		alert(status);
      let success = 0;
      if (phone != '' && ValidPhone()) {
        success++;
      }
      if (mail != '' && ValidMail()) {
        success++;
      }
      if (status == 'urlico' && company != '' && ValidOrg()) {
        success++;
        document.getElementById("adr").style.display = 'inline-flex';		
      }
      if (status == 'fizlico' && company == '') {
        document.getElementById("name_leg").innerHTML = 'Ваше имя:';		
        document.getElementById("adr").style.display = 'none';		
        success++;
      }
      if (success == 3) {
          $('.block_order__block_button .zakazbut').addClass('active');
          save_cookie_contacts();
        } else {
          $('.block_order__block_button .zakazbut').removeClass('active');
        }
		//alert(status);
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
      var re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10}$/;
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

    function ValidOrg() {
      //            var re = /^\d[\d\(\)\ -]{4,14}\d$/;
      var re = /^(.+)$/;
      let myOrg = $('#formcompany').val();
      var valid = re.test(myOrg);

      if (valid) {
        $('#formcompany').css('border', '1px solid white');
        $('#org_leg').css('color', 'black');
      } else {
        $('#formcompany').css('border', '1px solid red');
        $('#org_leg').css('color', 'red');
      }
      return valid;
      save_cookie_contacts();
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
      //            $("#fileform").ajaxForm({
      //                beforeSubmit: function () {
      //                    // $('#results').html('Submitting...');
      //                    // alert("bfsu");
      //                    $("#checkfile").html("Загрузка файла...");
      //                },
      //                success: function (data) {
      //                    //   var $out = $('#res_file');
      //                    //   $out.html('Your results:');
      //                    //  $out.append('<div><pre>'+ data +'</pre></div>');
      //
      //                    //  alert(data);
      //
      //                    // $("#checkfile").html('Файл успешно загружен');
      //                    //  alert(  $("#out_file_res").html());
      //                    //  $("#out_file_res").empty();
      //
      //                    //file_name=data;
      //                    send_order(data);
      //                    $("#checkfile").html("Файл загружен");
      //                    // alert("data="+data);
      //                    /*
      //                     $("#out_file_res").html("<table <tr><td width=90 class=dost_text height=30 title='Для выставления счета на понадобятся реквизиты Вашей компании'>  \
      //                     Реквизиты  </td><td class=dost_text width=200> Файл реквизитов загружен </td><td class=dost_text>\
      //                     <span  onclick='get_data(1,1,\"new_rekv_file\",1);' style='cursor:pointer' title='Нажмите, если  реквизиты изменились'> Загрузить новый файл &nbsp;&nbsp; <img src='/images/ques.gif' width=13 class=imgcenter> </span>  \
      //                     </td>\
      //                     </tr></table>");
      //                     */
      //
      //
      //                },
      //
      ////                error: function (data) {
      ////
      ////                    // alert("Ошибка загрузки" );
      ////                    $("#checkfile").html('Ошибка загрузки файла');
      ////                }
      //
      //
      //            });


      //if(!bask[0]) alert("fuck");


      //            if ($("#formfile").val() == "")
      send_order("");
      //            else
      //                $("#fileform").submit();

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
		let podzakaz = $('.podzakaz').length;

	let arr_cookie_cart_quantities = [];
      for (let key in arr_cart_quantities) {
        arr_cookie_cart_quantities.push({
          "model": key,
          "qty": arr_cart_quantities[key]
        });
      }
		
	  let date = new Date;
      date.setDate(date.getDate() + 1);
      date = date.toUTCString();

	  //deleteCookie("box3_cart_quantities");
      setCookie('box3_cart_quantities', JSON.stringify(arr_cookie_cart_quantities), {
        'expires': date
      });
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
      $('.total_rub_value').html(numberWithSpaces(total_rub));
      $('.total_usd_value').html(numberWithSpaces(total_usd));
      const lastDigit2Str = String(total_quantity + total_noprice).slice(-1);
      const lastDigit2Num = Number(lastDigit2Str);
      let word = ' товаров';
      if (lastDigit2Num == 1 && (((total_quantity + total_noprice) <= 2) || (total_quantity + total_noprice) >= 21)) word = ' товар';
      if (lastDigit2Num >= 2 && lastDigit2Num <=4 && (((total_quantity + total_noprice) < 10 ) || (total_quantity + total_noprice) >= 22)) word = ' товара';
      $('.total_quantity_value').html(total_quantity + total_noprice);
      $('.total_quantity_word').html(word);
      if (total_noprice > 0) {
        $('.total_noprice_value').html(total_noprice);
      }
	let cenadivs = document.getElementsByClassName('cena');
	let spasibodiv = document.getElementsByClassName('spasibodiv');
	let nali4iediv = document.getElementsByClassName('nali4iediv');
      if (total_usd < 1) {
		cenadivs[0].style.display = "none";
      }
	let bezcen1 = document.getElementsByClassName('bezcen1');
	let bezcen2 = document.getElementsByClassName('bezcen2');
	let ocene = document.getElementsByName('ocene');
      if (total_noprice > 0 & total_usd > 0 ) {
		bezcen1[0].style.display = "contents";
		bezcen2[0].style.display = "contents";
		ocene[0].style.display = "contents";
      } else if (total_noprice == 0 & total_usd > 0 ) {
		bezcen1[0].style.display = "none";
		ocene[0].style.display = "none";
      } else if (total_noprice > 0 & total_usd == 0 ) {
		bezcen1[0].style.display = "contents";
		bezcen2[0].style.display = "none";
		ocene[0].style.display = "contents";
      }
      if (podzakaz < 1) {
		spasibodiv[0].style.display = "block";
		nali4iediv[0].style.display = "none";
      } else {
		spasibodiv[0].style.display = "none";
		nali4iediv[0].style.display = "block";
      }

    }


    function send_order(file_name) {
      var dost = "";
      if ($("#dost3").prop("checked"))
        dost = 'Самовывоз СПБ'; //alert("3");
      if ($("#dost7").prop("checked"))
        dost = 'Курьерской службой «СДЭК» по РФ (1-10 дней)'; //alert("4");

      var nm = $("#formname").val();
      var comp = $("#formcompany").val();
      var ph = $("#formphone").val();
      var eml = $("#formemail").val();
      var inn = $("#forminn").val();
      var dop = $("#formdop").val();
      var kpp = $("#kpp").val();
      var ogrn = $("#ogrn").val();
      var address = $("#address").val();
      var status = GetStatus();

      //var bsk = basket_to_string();
      var models_list = models_to_string();
      var cart_list = cart_to_string();


      $.ajax({
        url: "/abacus/components/catalog_cart/ajax_mess1.php",
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
          type: 'Корзина',
          refer: 'rusavomatika',
          basket: cart_list,
          models: models_list,
          status: status
        },
        success: function (msg) {
          console.log(msg);
          // alert(msg);
          //$("#form_out").html(msg);
          // $("#conn_info").html("");

          if (msg == 'true') {
            $('.component_catalog_cart__panel_of_products').html('');
            $('.block_order').html('');
            window.scrollTo({
              top: 0,
              behavior: 'smooth'
            });

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
      let total_noprice_value = $('.panel_itogo2 .total_noprice_value .value').html();
      let text_total_noprice_value = '';
      if (total_noprice_value !== undefined) {
        text_total_noprice_value = "<div>(В том числе <div>без цены:</div> " + total_noprice_value + " шт.)</div>";
      }
      let total_quantity_value = $('.panel_itogo2 .total_quantity_value').html();
      let total_usd_value = $('.panel_itogo2 .total_usd_value').html();
      let total_rub_value = $('.panel_itogo2 .total_rub_value').html();
      out += '<tr><td></td>' + '<td style="text-align: right">' + '<b>Сумма:</b></td><td style="text-align: left"><div><b>' + total_usd_value + ' $</b></div><div><b>' + total_rub_value + ' руб.</b></div></td><td><b>' + 'Всего: ' + total_quantity_value + ' шт.</b>' + text_total_noprice_value + '</td></tr>';
      return "<table cellspacing='0' border='1' cellpadding='15' width='100%' style='width:100%;text-align: left;background: #dff3df' >" + out + "</table><br><hr><br>";
    }
function cleanString(str) {
    // Очищаем строку от HTML-тегов
    str = str.replace(/<\/?[^>]+(>|$)/g, '');
    
    // Замена различных представлений " " на обычный пробел
    str = str.replace(/&(nbsp|#160|\u00A0| );?/gi, ' ');

    // Удаляем знаки вопроса
    str = str.replace(/\?+/g, '');

    // Удаляем лишние пробелы вначале и в конце строки
    return str.trim();
}
    function models_to_string() {
      let out = '';
      //$('table.series_products tr').each(function () {
      $('div.series_products div.tr').each(function () {
        let model = $(this).find('.model').html();
		model = cleanString(model);
        out += model + ',';
      });
      return out;
    }

    function save_cookie_contacts() {
      //            $.cookie('cookie_contact', $("#formname").val() + "#" + $("#formcompany").val() + "#" + $("#formphone").val() + "#" + $("#formemail").val(), {expires: 365});
      //      Cookies.set('cookie_contact', $("#formname").val() + "#" + $("#formcompany").val() + "#" + $("#forminn").val() + "#" + $("#kpp").val() + "#" + $("#ogrn").val() + "#" + $("#address").val() + "#" + $("#formphone").val() + "#" + $("#formemail").val() + "#" + $("#formdop").val(), {
		if (GetStatus() == 'urlico') {
      Cookies.set('cookie_contact', $("#formname").val() + "#" + $("#formphone").val() + "#" + $("#formemail").val() + "#" + $("#formdop").val() + "#" + GetStatus() + "#" + $("#formcompany").val() + "#" + $("#forminn").val() + "#" + $("#kpp").val() + "#" + $("#ogrn").val() + "#" + $("#address").val(), {expires: 365});
		} else {
      Cookies.set('cookie_contact', $("#formname").val() + "#" + $("#formphone").val() + "#" + $("#formemail").val() + "#" + $("#formdop").val() + "#" + GetStatus() + "####" + "#" + $("#address").val(), {expires: 365});
			
		}
    }

    function load_cookie_contacts() {
      let ss = Cookies.get('cookie_contact');
		SetStatus( getCookie('cookie_contact') );
      if (ss !== undefined) {
        var cont = ss.split("#");
        $("#formname").val(cont[0]);
        $("#formphone").val(cont[1]);
        $("#formemail").val(cont[2]);
        $("#formdop").val(cont[3]);
        $("#formcompany").val(cont[5]);
        $("#forminn").val(cont[6]);
        $("#kpp").val(cont[7]);
        $("#ogrn").val(cont[8]);
        $("#address").val(cont[9]);
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
      updatedCookie += ';SameSite=Strict;Secure';
      document.cookie = updatedCookie;
    }

    function deleteCookie(name) {
      setCookie(name, "", {
        'max-age': -1
      })
    }


  });

const numberPatterns = [
  '+7 (NNN) NNN-NN-NN',  // Россия и Казахстан
];

document.querySelectorAll( 'input[type=tel]' ).forEach( function( input ) {
    const formatterObject = new Freedom.PhoneFormatter( numberPatterns );
    formatterObject.attachToInput( input );
} );

function join(arr) {
  var separator = arguments.length > 1 ? arguments[1] : ", ";
  return arr.filter(function (n) {
    return n
  }).join(separator);
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

function GetStatus() {
  var genderRadio = document.getElementsByName('status');
  var genderValue;
  for(var i = 0; i < genderRadio.length; i++){
      if(genderRadio[i].checked){
          genderValue = genderRadio[i].value;
      }
  }
  return genderValue;

 }
function SetStatus(genderValue) {
  var genderRadio = document.getElementsByName('status');
  for(var i = 0; i < genderRadio.length; i++){
      if(genderRadio[i].value == genderValue){
          genderRadio[i].checked = true;
      }
  }
}