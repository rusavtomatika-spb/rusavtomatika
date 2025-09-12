<?php
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/script.js" );
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/lib.js" );
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );

?>
<div class="component_form_require_price" style="display: none">
  <div class="component_form_require_price__form_wrapper">
    <div class="close_button">X</div>
    <div class="title">Запрос цены
      <?php
      $model = explode( '/', $_SERVER[ 'REQUEST_URI' ] );
      end( $model );
      $model = prev( $model );
      ?>
    </div>
    <div class="text">
      <p><span class="text_target">Для уточнения цены</span> <b>&laquo;</b><b class="text_model"></b><b>&raquo;</b>, пожалуйста, введите Ваш мобильный номер. Мы перезвоним Вам в течение 10 минут.</p>
      <p>Или напишите в чат в правом нижнем углу экрана.</p>
    </div>
    <form action="" id="require_price" method="post">
      <div class="form_elements"> <span>
        <input class="input_phone" type="tel" name="tel" id="formphone" style="border:1px solid red;">
        </span>
        <input type="hidden" name="model" id="formmodel" class="formmodel" value="<?= $model; ?>">
  <input type="hidden" name="refer" value="rusavtomatika">
        <input type="hidden" name="type" value="Запрос цены">
        <input class="button is-success" type="submit" name="submit" value="Позвоните мне" disabled="disabled" id="bsub">
      </div>
    </form>
  </div>
</div>
<script>

$(document).ready(function () {
    $("#require_price").submit(function () {
        // Получение ID формы
        var formID = $(this).attr('id');
        // Добавление решётки к имени ID
        var formNm = $('#' + formID);
        $.ajax({
            type: "POST",
//            url: '/sc/send.php',
            url: 'https://zu19.tw1.ru/work/bdtest.php',  
            data: formNm.serialize(),
            beforeSend: function () {
                // Вывод текста в процессе отправки
                $(formNm).html('<p style="text-align:center">Отправка...</p>');
            },
            success: function (data) {
//                // Вывод текста результата отправки
//				$.ajax({  
//                url: 'https://zu19.tw1.ru/work/bdtest.php',  
//                type: 'POST',  
//                data: formNm.serialize(), 
//                success: function(data){  
//            }  
                $(formNm).html('<p style="text-align:center;font-size:16px;font-weight:600;color:#00AD61;">'+data+'</p>');
            },
            error: function (jqXHR, text, error) {
                // Вывод текста ошибки отправки
                $(formNm).html('<p style="text-align:center;font-size:12px;color:red;">'+error+'</p>');
            }
        });
        return false;
    });
});

</script> 
