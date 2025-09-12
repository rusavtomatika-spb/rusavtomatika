var universal_forms =
        {
            ajax_url : '/orders/functions/ajax_universal_forms.php',
            CreateForm : function CreateForm(elementForResultID,arrFormArgs) {
                $.ajax({
                    data: {'action': 'get_form_panel', 'data' : arrFormArgs},
                    //data: data,
                    type: "post",
                    url: this.ajax_url,
                    success: function (data) {
                        try {
                            var result = JSON.parse(data);
                            $(elementForResultID).html(result.buffer);
                        } catch (error) {
                            console.log(error);
                        }
                    },
                    error: function (error) {
                        console.log(error); 
                    }
                });

            }

        };

/*

var titleForm = "titleForm";
var hiddenFields =
        {
            'table': 'ord_products',
            'id': '1',
        };
var fields =
        [
            {'name_rus': 'Наименование', 'field': 'name', 'type': 'text'},
            {'name_rus': 'Описание', 'field': 'description', 'type': 'textarea'},
        ];
var arrArgs = {
    'titleForm': titleForm,
    'hiddenFields': hiddenFields,
    'fields': fields
}
universal_forms.CreateForm("#universal_forms_result", arrArgs);

*/
