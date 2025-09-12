$(document).ready(function () {
    $('.folded_block__button_unfold').click(function () {
        $(this).parent().removeClass('folded');
        $(this).parent().addClass('unfolded');
    });
    $('.folded_block__button_fold').click(function () {
        $(this).parent().addClass('folded');
        $(this).parent().removeClass('unfolded');
    });
});