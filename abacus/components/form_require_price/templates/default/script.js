$(document).ready(
	

  function () {

    $('.button_demand_price').on('click', function () {
      $('.component_form_require_price .text_model').html($(this).attr('data-rel-model'));
      $('.component_form_require_price').addClass('active');
      setTimeout(function () {
        $('.component_form_require_price').css('opacity', '1');
      }, 1);
    });


    $('.component_form_require_price .close_button').click(
      function () {
        let component = $(this).parents('.component_form_require_price');
        $(component).css('opacity', '0');
        setTimeout(function () {
          $(component).removeClass('active');
        }, 1000);
      }
    );

    //        $(".input_phone").mask("+7 (999) 999-99-99");
	  
	      $("#formphone").on('input', function () {
      check_inputs();
    });


    const numberPatterns = [
      '+7 (NNN) NNN-NN-NN', // Россия и Казахстан
    ];

    document.querySelectorAll('input[type=tel]').forEach(function (input) {
      const formatterObject = new Freedom.PhoneFormatter(numberPatterns);
      formatterObject.attachToInput(input);
    });

    function ValidPhone() {
      //            var re = /^\d[\d\(\)\ -]{4,14}\d$/;
      var re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10}$/;
      let myPhone = $('#formphone').val();
      var valid = re.test(myPhone);

      if (valid) {
        $('#formphone').css('border', '1px solid white');
//document.getElementById("bsub").disabled = false; 
      } else {
        $('#formphone').css('border', '1px solid red');
//document.getElementById("bsub").disabled = true; 
      }
      return valid;
    }

    function check_inputs() {
      let phone = $('#formphone').val();
      let success = 0;
      if (phone != '' && ValidPhone()) {
        success++;
      }
      if (success == 1) {
document.getElementById("bsub").disabled = false; 
      } else {
document.getElementById("bsub").disabled = true; 
      }
      //alert(status);
    }

  }
);
