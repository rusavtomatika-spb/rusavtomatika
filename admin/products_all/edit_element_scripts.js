$(document).ready(
  function () {
    $('.button_delete_red_small_round').click(function () {
      let data_pic_url = $(this).attr('data-pic_url');
      if (!confirm('Хотите удалить изображение?  ' + data_pic_url)) {
        return;
      }
      let data_brand = $(this).attr('data-brand');
      let data_type = $(this).attr('data-type');
      let data_model = $(this).attr('data-model');
      let edit_element__image_item = $(this).parent('.edit_element__image_item');


      delete_picture({
        pic_url: data_pic_url,
        model: data_model,
        brand: data_brand,
        type: data_type,
        edit_element__image_item: edit_element__image_item,
      });


    });

    function delete_picture(model, ) {
      var fd = new FormData;
      fd.append('model', model.model);
      fd.append('brand', model.brand);
      fd.append('type', model.type);
      fd.append('pic_url', model.pic_url);

      $.ajax({
        type: "POST",
        url: "/admin/products_all/ajax_delete_image.php",
        contentType: false,
        processData: false,
        data: fd,
        //dataType: 'json',
        success: function (jsonData) {
          result = JSON.parse(jsonData);
          if (result.status == 1) {
            $(model.edit_element__image_item).remove();
            setTimeout(function () {
              location.reload();
            }, 100);
          } else console.log(jsonData);
        }
      });
    }
  }
);
