<?
function top_menu($new = 0)
{
    ?>

    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_contacts.php"; ?>
    <?
    $top_menu = "<div class=menu_top_cont>"
        . ((0) ? "<div class=menu_top>
<div class='top-menu-block'><a href='/about.php'>О КОМПАНИИ&nbsp;</a>
<ul>
<a href='/news.php'><li>Новости</li></a>
<a href='/articles/'><li>Статьи</li></a>
</ul>
</div>|
<a href='/advanced_search.php' title='Подбор оборудования по параметрам'> ПОДБОР </a> |
<a href='/comparison.php'> СРАВНЕНИЕ </a>|
<a href='//www.rusavtomatika.com/forum/'> ФОРУМ </a> |
<a href='/support.php'> ТЕХ.ПОДДЕРЖКА </a> |
<a href='/download.php'>СКАЧАТЬ</a> |
<a href='/contacts.php'> КОНТАКТЫ </a>
</div>
" : " ") .
        "<!--<a href='/antikrizisnoe-predlozhenie.php' style='color: rgb(228, 14, 19);'><div id='rof' style='display:none;position: absolute;width: 300px;margin-left: 283px;font-size: 15px;margin-top: 19px;overflow: hidden;color: rgb(228, 14, 19);
  font-family: \"MS Sans Serif\";  font-weight: bold;'><div class='flying' style='position:relative;right:0px;float:left;white-space: nowrap;'>Акция !  Weintek по сниженным ценам</div></div></a>-->";

    $top_menu .= "
<script>
function run(ud) {
$('.flying').eq(ud).css('right','-300px');
  $('.flying').eq(ud).animate({
    right: '300px'
  }, {
    duration: 15000,
    specialEasing: {
      right: 'linear'
    }
  });

setTimeout(function() {

run(ud);
}, 22500);
}
$(document).ready(function(){
$('#rof').show();
var ud = 0;
$('.flying').clone().css({'right':'-300px','margin-top':'-18px'}).appendTo('#rof');
setTimeout(function() {

  $('.flying').eq(ud).animate({
    right: '300px'
  }, {
    duration: 7500,
    specialEasing: {
      right: 'linear'
    }
  });

setTimeout(function() {

run('0');
}, 15020);
}, 600);

setTimeout(function() {
run('1');
}, 4350);

});

</script>";

    $top_menu .= "</div>
";

    echo $top_menu;
}