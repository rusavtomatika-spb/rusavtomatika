function shuffle(arr){
	let j, temp;
	for(let i = arr.length - 1; i > 0; i--){
		j = Math.floor(Math.random()*(i + 1));
		temp = arr[j];
		arr[j] = arr[i];
		arr[i] = temp;
	}
	return arr;
}
function init_tegs_cloud(cloud_tray_class, cloud_item_class, count_big_tegs, count_small_tegs){
	let tegs = $('.' +cloud_tray_class).children('.' + cloud_item_class);
	let items_count = tegs.length;
	let arr = [];
	let arr_delay = [];
	let arr_animations = ['big_teg', 'small_teg', 'semismall_teg', 'semibig_teg', 'medium_teg'];
	/*let count_big_tegs = 1;
	let count_small_tegs = 5;*/
	let count_crossover_tegs = Math.floor((items_count - count_big_tegs - count_small_tegs) / 3);
	let count_average_tegs = count_crossover_tegs + (items_count - count_big_tegs - count_small_tegs)%3;
	let arr_counts = [count_big_tegs, count_small_tegs, count_crossover_tegs, count_crossover_tegs, count_average_tegs];
	for(let i=0; i<5;i++){
		for(let j=0; j<arr_counts[i]; j++){
			arr.push(arr_animations[i]);
		}
	}
	for(let i=0;i<items_count; i++){
		arr_delay[i] = i;
	}
	arr = shuffle(arr);
	arr_delay = shuffle(arr_delay);
	$('.' + cloud_item_class).each(function(i,elem){
		$(this).addClass(arr[i]);
		if(i%3==0) $(this).css('align-self', 'flex-start');
		else{
			if(i%3==1) $(this).css('align-self', 'flex-end');
			else $(this).css('align-self', 'center');
		}
	});
}
$(document).ready(function() { 
	init_tegs_cloud('product_cloud_list', 'product_cloud_item', 1, 5);
	init_tegs_cloud('sphere_cloud_list', 'sphere_cloud_item', 4, 9);
});