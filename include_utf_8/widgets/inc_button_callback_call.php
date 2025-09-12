<style>
    .button_callback_call_wrapper {
        display: flex;
        gap: 1rem;
        max-width: 380px;
    }

    .button_callback_call_wrapper .button {
        width: 40%;
        min-width: 120px;
        text-align: center;
    }
    .button_callback_call_wrapper .callback_call_phone {
        width: 60%;
        text-align: center;
    }

    .button_callback_call_wrapper .callback_call_phone.nonValid {
        background-color: #ffc5c5;
        border-color: #ff0000;
    }

    .button_callback_call_wrapper .callback_call_phone.valid {
        background-color: #d4ffc5;
        border-color: #00ad61;
    }

    .button_callback_call_wrapper .button.disabled,
    .button_callback_call_wrapper input.callback_call_phone.disabled {
        background-color: #d0d0d0;
        border-color: #bbb;
        color: #333333;
        opacity: 0.5;
    }
</style>
<form id="feedback-form" action="">
<div class="button_callback_call_wrapper">
    <!--input class="callback_call_phone input" type="text" placeholder="79998887766">
    <div class="button is-success">Получить звонок</div-->
  <input type="hidden" name="type" value="Заказ звонка">
  <input type="hidden" name="refer" value="rusavtomatika">
  <input class="callback_call_phone input" type="tel" name="phone" required placeholder="+79998887766"> <input class="button is-success" type="submit" name="submit" value="Получить звонок">
</div>
</form>
<script>
$(document).ready(function () {
    $("#feedback-form").submit(function () {
        // Получение ID формы
        var formID = $(this).attr('id');
        // Добавление решётки к имени ID
        var formNm = $('#' + formID);
        $.ajax({
            type: "POST",
            url: '/contacts/send.php',
            data: formNm.serialize(),
            beforeSend: function () {
                // Вывод текста в процессе отправки
                $(formNm).html('<p style="text-align:center">Отправка...</p>');
            },
            success: function (data) {
                // Вывод текста результата отправки
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