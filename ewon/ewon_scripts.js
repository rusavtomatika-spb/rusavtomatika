function v_korzinu1(o)
{
//alert(o.innerHTML);
//alert($(o).attr('idm'));
    chosen_item = $(o).attr('idm');
    var x = $(o).position().left - 150;
//var x=900;
    var y = $(o).position().top;
    ask_kol(x, y);

}
function dich(num)
{
    $("#dd").html("<a href='" + num + "' rel='lightbox[1]'><img class='open_big' src='" + num + "'/></a>");
}

$(function () {
    $("#tabs").tabs();
});

$(document).ready(function () {
    $('.toclick').click(function () {
        $('.lightbox').prop('rel', 'lightbox[1]');
        $(this).children('.lightbox').prop('rel', 'box[1]');
    });
});

$(document).ready(function () {
    $('.mytab2 > tbody > tr:even').addClass('gray');

});
