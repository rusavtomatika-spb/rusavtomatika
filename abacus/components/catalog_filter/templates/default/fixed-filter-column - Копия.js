$(document).ready(function () {
  setTimeout(function () {
    if ($("div").is("#float_filter_block")) {
      if ($(window).width() < 1024) return;

      // if (height_content > height_float_block) // ���� ������� �������, ��� ����� ����, �� ����� ����� ���������

      /*
      const offset_bottom = 170;
      let topPos = $('#float_filter_block').offset().top - offset; // ���� ������� �������
      let height_float_filter_block = $('#float_filter_block').outerHeight(); // ������ �������
      */


      /*
      if(height_float_filter_block > window.innerHeight - 270){
      $('#float_filter_block .filter_panel').css({'height': window.innerHeight - 270, 'overflow-y': 'scroll'});
      }
      */
      $(window).scroll(function () {
        const height_content = $('.component_catalog_section').outerHeight();
        const height_float_block = $('#float_filter_block').outerHeight();
        const height_column_content = $('.component_catalog_section__panel_of_products_wrapper').outerHeight();

        console.log(height_float_block, height_column_content);
        const offset = 10;

        if (height_column_content > height_float_block) // ���� ������� �������, ��� ����� ����, �� ����� ����� ���������
        {
          if ($(window).width() < 1024) return;
          let height_window = $(window).height();
          let top_vue_component_catalog_section = $('#vue_component_catalog_section').offset().top;
          let top_main = $('main').offset().top;

          let top = $(document).scrollTop(); // ������� ��������� ����
          let bottom_content_block = $('.component_catalog_section__bottom_of_list').offset().top; // bottom_content_block ��������� ���� ��������
          let height_content_block = $('.component_catalog_section').outerHeight(); // ������ ��������
          let height_float_filter_block = $('#float_filter_block').outerHeight(); // ������ �������
          let top_float_filter_block = $('#float_filter_block').offset().top; // ���� ��������� ����� �������
          let bottom_float_filter_block = top_float_filter_block + height_float_filter_block; // ���� ��������� ���� �������

          let dynamic_bottom_content = bottom_content_block - top + height_window;
          if (
            top > top_vue_component_catalog_section
            && top < bottom_content_block
            && height_window + top < bottom_content_block
          ) {
            $('#float_filter_block').addClass('fixed');
            $('#float_filter_block').removeClass('fixed_to_bottom');
            // ���� ������ ������ ������ ����

            if (height_float_filter_block > height_window - 50) {
              $('.component_catalog_section__filter .filter_panel').addClass('height_limited');
              $('.component_catalog_section__filter .filter_panel').css({
                'height': height_window - 50,
                'overflow-y': 'scroll'
              });
            }
          } else if (
            top > top_vue_component_catalog_section
            && top < bottom_content_block
            && height_window + top >= bottom_content_block
          ) {
            $('#float_filter_block').addClass('fixed_to_bottom');
          } else {

            $('#float_filter_block').removeClass('fixed');
            $('#float_filter_block').removeClass('fixed_to_bottom');
            $('.component_catalog_section__filter .filter_panel').removeAttr('style');

          }
        } else {
          $('#float_filter_block').removeClass('fixed');
          $('#float_filter_block').removeClass('fixed_to_bottom');
          $('.component_catalog_section__filter .filter_panel').removeAttr('style');
        }
      });
    }
  }, 1000);

});
