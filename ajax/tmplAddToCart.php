<?
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
    header('Content-Type: text/html; charset=windows-1251');
    ?>
<div id="tmplAddToCart">


        <table><tr><td width=60%>
                    <span class="productName"></span>&nbsp;</td><td width=50>
                    <div style='width:60px;'>Кол-во:</div> </td><td>
                    <table cellpadding=0 cellspacing=0 border=0>
                        <tr><td class="am_td"><input type="text" class="items_amount"/></td><td>

                                <table cellpadding=0 cellspacing=0>
                                    <tr><td class=am_td width=20 align=center><img class='img_but_plus' src=/images/but_plus.png width=12 onclick="totalCounter('inc');"></td></tr>
                                    <tr><td class=am_td width=20 align=center><img class='img_but_minus' src=/images/but_minus.png width=12 onclick="totalCounter('dec');"></td></tr>
                                </table>
                            </td></tr></table>
                </td></tr></table>
        <center>
            <br>
            <span class=zakazbut onclick='addProductToCart();'>OK</span> &nbsp
            <span class=zakazbut onclick='cancelAddProductToCart();'>Отмена</span>

        </center>


</div>

<?php
};