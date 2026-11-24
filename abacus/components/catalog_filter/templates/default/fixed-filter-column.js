$(document).ready(function () {
  setTimeout(function () {
    if ($("div").is("#float_filter_block")) {
      if ($(window).width() < 1024) return;

      $(window).scroll(function () {
        const height_content = $('.component_catalog_section').outerHeight();
        const height_float_block = $('#float_filter_block').outerHeight();
        const height_column_content = $('.component_catalog_section__panel_of_products_wrapper').outerHeight();

        console.log(height_float_block, height_column_content);
        const offset = 10;

        if (height_column_content > height_float_block)                
        {
          if ($(window).width() < 1024) return;
          let height_window = $(window).height();
          let top_vue_component_catalog_section = $('#vue_component_catalog_section').offset().top;
          let top_main = $('main').offset().top;

          let top = $(document).scrollTop();
          let bottom_content_block = $('.component_catalog_section__bottom_of_list').offset().top;
          let height_content_block = $('.component_catalog_section').outerHeight();
          let height_float_filter_block = $('#float_filter_block').outerHeight();
          let top_float_filter_block = $('#float_filter_block').offset().top;
          let bottom_float_filter_block = top_float_filter_block + height_float_filter_block;
          let dynamic_bottom_content = bottom_content_block - top + height_window;
          if (
            top > top_vue_component_catalog_section
            && top < bottom_content_block
            && height_window + top < bottom_content_block
          ) {
            $('#float_filter_block').addClass('fixed');
            $('#float_filter_block').removeClass('fixed_to_bottom');

            if (height_float_filter_block > height_window - 85) {
              $('.component_catalog_section__filter .filter_panel').css({
                'height': height_window - 85,
                'overflow-y': 'scroll',
                '-ms-overflow-style': 'none',
                'scrollbar-width': 'none'
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
    $('#checkbox_brand_Weintek').change(function () {
    if ($('#checkbox_brand_Weintek').is(':checked')) {
        $(".filser_weintek,.filter_series").removeClass("is-hidden");
    } else {
        $(".filser_weintek").addClass("is-hidden");
    }
getCheckedBoxes();
	});
    $('#checkbox_brand_Samkoon').change(function () {
    if ($('#checkbox_brand_Samkoon').is(':checked')) {
        $(".filser_samkoon,.filter_series").removeClass("is-hidden");
    } else {
        $(".filser_samkoon").addClass("is-hidden");
    }
getCheckedBoxes();
	});
    $('#checkbox_brand_IFC').change(function () {
    if ($('#checkbox_brand_IFC').is(':checked')) {
        $(".filser_ifc,.filter_series").removeClass("is-hidden");
    } else {
        $(".filser_ifc").addClass("is-hidden");
    }
getCheckedBoxes();
	});
    $('#checkbox_brand_Aplex').change(function () {
    if ($('#checkbox_brand_Aplex').is(':checked')) {
        $(".filser_aplex,.filter_series").removeClass("is-hidden");
    } else {
        $(".filser_aplex").addClass("is-hidden");
    }
getCheckedBoxes();
	});
getCheckedBoxes();
  }, 1000);
});
function getCheckedBoxes() {
   var brand_checks = $(".checkbox_brand:checked").length;
    if (brand_checks == 1) {
        $(".filter_series").removeClass("is-hidden");
    } else {
        $(".filter_series").addClass("is-hidden");
      }
}
function validateDecimal(inputElement) {
  if (!/^\d*\.?\d*$/.test(inputElement.value)) {
    inputElement.value = inputElement.value.replace(/[^0-9.]+/g, '.');
  }
}