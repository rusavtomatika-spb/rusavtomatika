<style>
    .button_callback_call_wrapper {
        display: flex;
        gap: 1rem;
        max-width: 380px;
    }

    .button_callback_call_wrapper > input {
        width: 40%;
        min-width: 120px;
        text-align: center;
    }
    .button_callback_call_wrapper > div {
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
<div class="button_callback_call_wrapper">
    <input class="callback_call_phone input" type="text" placeholder="79998887766">
    <div class="button is-success">Получить звонок</div>
</div>
<script>

    $('.button_callback_call_wrapper .callback_call_phone').on('change keyup input click', function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
        if(this.value[0] == '8'){
            this.value = this.value.replace(/^8/, "7");
            console.log(this.value);
        }
    });
    $('.button_callback_call_wrapper .callback_call_phone').keydown(function(e) {
        if(e.keyCode === 13) {
            $('.button_callback_call_wrapper .button').not('.disabled').click();
        }
    });

    $('.button_callback_call_wrapper .button').not('.disabled').on('click', function () {
        let input_phone = $('.button_callback_call_wrapper .callback_call_phone');
        let phone = $(input_phone).val();
        if (phone.length < 11) {
            $(input_phone).addClass('nonValid').removeClass('valid');
            validated = false;
            console.log($(input_phone));
        } else {
            if (phone.match(/[^0-9+-/(/)]/g)) {
                $($(input_phone)).addClass('nonValid').removeClass('valid');
                validated = false;
                console.log($(input_phone));
            } else {
                $($(input_phone)).addClass('valid').removeClass('nonValid');
                $('.button_callback_call_wrapper .button').html('Ждите звонка...');
                $('.button_callback_call_wrapper .button').addClass('disabled');
                $('.button_callback_call_wrapper .button').attr('disabled', 'disabled');
                $(input_phone).addClass('disabled');
                $(input_phone).attr('disabled', 'disabled');
                console.log(jivo_api);
                jivo_api.startCall('+' + phone);
            }
        }
    });
</script>

