<?php
function add_to_basket() {
    if (defined('basket_shit'))
        return;
    define('basket_shit', 1);

    echo "
<div id=amount_q>
<table><tr><td width=60%>
 <span id=modn></span>&nbsp;</td><td width=50>
<div style='width:60px;'>Кол-во:</div> </td><td>
<table cellpadding=0 cellspacing=0 border=0>
<tr><td class= am_td><input type=text id=items_amount /></td><td>

<table cellpadding=0 cellspacing=0>
<tr><td class=am_td width=20 align=center><img class='img_but_plus' src=/images/but_plus.png width=12 onclick='am_inc();'></td></tr>
<tr><td class=am_td width=20 align=center><img class='img_but_minus' src=/images/but_minus.png width=12 onclick='am_dec();'></td></tr>
</table>
</td></tr></table>
</td></tr></table>
<center>
<br>
<span class=zakazbut onclick='add_item();'>OK</span> &nbsp
<span class=zakazbut onclick='cancel_add_item();'>Отмена</span>

</center>
</div>

";
}
function basket() {

    if (defined('basket_shit1'))
        return;
    define('basket_shit1', 1);
    ?>
    <div id="slided">
        <div id="basket_container">
            <div id="basket">
                <center><span class="bask_head" style="font-size: 15px;">Корзина</span></center><br>
                <div id="resba"> </div>
                <br><center>
                    <span class="bask_head btn" style="font-size: 15px; cursor: pointer;" onclick="window.location = '/oformit_zakaz.php'" >Оформить</span>
                    &nbsp &nbsp
                    <span class='bask_head btn' style='font-size: 15px; cursor: pointer;' onclick='clean_basket();' >Очистить</span> </center>
            </div>
        </div>
    </div>

    <div id="basket_small" onclick='ts()'>
        <div id="bask_sm_text"></div>
        <div class="basket_small_icon"></div>
    </div>

    <?
    //echo "";
}

