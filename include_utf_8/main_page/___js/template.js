 function set_catalog_block_sizes(){
	var height = $(window).height();
	var offset = $('.btn-menu').offset();
	var top_offset = Number(offset.top.toFixed()) + 40;
	return [top_offset, height-top_offset - 50]
 }
 $(window).on('load resize', function() {
	var params = set_catalog_block_sizes();		
	$('.hidden-menu').css('top', params[0]+'px');
	$('.cataloge-left-side').css('height', params[1]+'px');
	$('.cataloge-right-side').css('height', params[1]+'px');
	
});
$('.btn-menu').click(function(){
	if ($('#hmt').is(':checked')){
		$('.hidden-menu').fadeOut();
	} else {		
		var params = set_catalog_block_sizes();		
		$('.hidden-menu').css('top', params[0]+'px');
		$('.cataloge-left-side').css('height', params[1]+'px');
		$('.cataloge-right-side').css('height', params[1]+'px');
		$('.hidden-menu').fadeIn();
	}
});
$('.btn-top-menu').click(function(){
	if ($('#top-hmt').is(':checked')){
		$('.top-menu-box').removeClass('box');
		$('.top-menu-tray').fadeOut();
		
	} else {		
		$('.top-menu-tray').fadeIn();
		$('.top-menu-box').addClass('box');
	}
});
$('.cataloge-switch').click(function(){
	var block_show=$(this).attr('data-show');
	var block_hide=$(this).attr('data-hide');
	$('.'+block_hide).fadeOut(); 
	$('.'+block_show).fadeIn();
	$('.cataloge-switch').removeClass('cataloge-switch-active');
	$(this).addClass('cataloge-switch-active');
});
/*
lightGallery(document.getElementById('lightgallery'), {
	
});
*/


