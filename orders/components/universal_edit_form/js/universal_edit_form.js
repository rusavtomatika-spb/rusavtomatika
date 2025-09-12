var universal_edit_form =
    {
        init: function (id,data) {
            //alert('Ваша версия jQuery ' + jQuery.fn.jquery);
            let form = $('#universal_edit_form_id_' + id);
            if (form) {
                this.getAjaxJSON('/orders/components/universal_edit_form/component_universal_edit_form.php',data).then(
                    function (result) {
                        console.log(result);
                        $('#universal_edit_form_id_' + id).html(result.form);
                    }
                );
            } 
        },
        getAjaxJSON: function (url, data) {
                return new Promise(function (succeed, fail) {
                    $.ajax({
                        //data: {'name': value},
                        data: data,
                        type: "post",
                        url: url,
                        success: function (data) {
                            try {
                                succeed(JSON.parse(data));
                            } catch (error) {
                                console.log('data: ', data);
                                fail(error);
                            }
                        },
                        error: function (error) {
                            fail(error);
                        }
                    });
                });

        },
    };
