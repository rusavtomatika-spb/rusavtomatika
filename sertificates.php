<?php

include $_SERVER["DOCUMENT_ROOT"]."/config.php";

if(EX != "_"){

    header($_SERVER['SERVER_PROTOCOL'] . " 301 Moved Permanently");

    header('Location: https://' . $_SERVER['HTTP_HOST'] ."/sertificates/");

    exit();

}



session_start();

define("bullshit", 1);

include("sc/dbcon.php");

include("sc/lib_new.php");

database_connect();



$extra_openGraph = array(

    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/sertificates.png",

    "openGraph_title" => "Сертификаты дистрибьютора",

    "openGraph_siteName" => "Русавтоматика"

);



temp0("weintek");

top_buttons();

basket();

temp1_no_menu();

//left_menu();

temp2();

//basket();

//---------------content ---------------------

?>

    <article>

        <div class="blockofcols_container block_sertificates" style="margin-bottom: 40px;">

            <div class="blockofcols_row">

                <div class="col-12">

                    <div class="col-12">

                        <h1 style="margin: 30px 0px 10px 0px; font-size: 25px;">Сертификаты дистрибьютора</h1>

                    </div>

                    <div class="col-12">

                        <p style="margin-bottom:20px;">Компания &laquo;Русавтоматика&raquo;&nbsp; является официальным

                            дистрибьютором на территории России продукции <strong>Weintek</strong> и

                            <strong>Samkoon</strong> (операторские панели), <strong>IFC</strong> (панельные компьютеры,

                            встраиваемые компьютеры, промышленные мониторы), <strong>Aplex</strong> (панельные

                            компьютеры), <strong>Haiwell</strong>, <strong>Yottacontroll</strong>, <strong>eWON</strong>

                            (vpn-роутеры). Всего на нашем сайте представлено более 100 наименований продукции.</p>

                    </div>



                    <div class="col-3">

                        <a class="block_sertificates__link"

                           href="https://www.rusavtomatika.com/upload_files/weintek/distributor_certificate_rusavtomatika.png"

                           rel="lightbox[1]">

                            <div class="block_sertificates__item" title="Нажмите для увеличения"

                                 style="background-image: url('/images/weintek/distributor_certificate_fam_electric-small.jpg')">

                            </div>

                            <div class="block_sertificates__item_title">Weintek</div>

                        </a>



                    </div>

                    <div class="col-3">

                        <a class="block_sertificates__link" href="/images/sertificat-IFC.jpg" rel="lightbox[1]">

                            <div class="block_sertificates__item" title="Нажмите для увеличения"

                                 style="background-image: url('/images/sertificat-IFC-small.jpg')">

                            </div>

                            <div class="block_sertificates__item_title">IFC</div>

                        </a>

                    </div>

                    <div class="col-3">

                        <a class="block_sertificates__link" href="/images/aplex_dist_cert.jpg?ver=1" rel="lightbox[1]">

                            <div class="block_sertificates__item" title="Нажмите для увеличения"

                                 style="background-image: url('/images/aplex_dist_cert_sm.jpg')">

                            </div>

                            <div class="block_sertificates__item_title">Aplex</div>

                        </a>

                    </div>

                    <div class="col-3">

                        <a class="block_sertificates__link"

                           href="/images/certificates/Certificate_Ewon_LLC_Rusavtomatika.jpg" rel="lightbox[1]">

                            <div class="block_sertificates__item" title="Нажмите для увеличения"

                                 style="background-image: url('/images/certificates/Certificate_Ewon_LLC_Rusavtomatika_preview.jpg')">

                            </div>

                            <div class="block_sertificates__item_title">Ewon</div>

                        </a>

                    </div>

                    <div class="col-3">

                        <a class="block_sertificates__link" href="/images/controllers/yottacontrol/ce/A5.png"

                           rel="lightbox[1]">

                            <div class="block_sertificates__item" title="Нажмите для увеличения"

                                 style="background-image: url('/images/controllers/yottacontrol/ce/A5.png')">

                            </div>

                            <div class="block_sertificates__item_title">Yottacontrol</div>

                        </a>

                    </div>

                    <div class="col-3">

                        <a class="block_sertificates__link" href="/images/samkoon_cert.png" rel="lightbox[1]">

                            <div class="block_sertificates__item" title="Нажмите для увеличения"

                                 style="background-image: url('/images/samkoon_cert_sm.png')">

                            </div>

                            <div class="block_sertificates__item_title">Samkoon</div>

                        </a>

                    </div>

                    <div class="col-3">

                        <a class="block_sertificates__link" href="/images/haiwell/Haiwell-Certificate.jpg"

                           rel="lightbox[1]">

                            <div class="block_sertificates__item" title="Нажмите для увеличения"

                                 style="background-image: url('/images/haiwell/Haiwell-Certificate-s.jpg')">

                            </div>

                            <div class="block_sertificates__item_title">Haiwell</div>

                        </a>

                    </div>



                </div>

            </div>

        </div>

    </article>



    <div class="blockofcols_container block_sertificates" style="margin-bottom: 40px;">

        <div class="blockofcols_row">

            <div class="col-12">

                <div class="col-12">





                    <div id="callbackline"

                         style="    background-color: #6A6D6F;margin-bottom: 50px;    margin-top: 20px;    width: 100%;    display: inline-block;    color: #FFFFFF;    padding: 10px 0px;">

                        <br>

                        <table border="0" align="center" cellspacing="0" cellpadding="5"

                               style="    width: 46%;    margin: auto;">

                            <tbody>

                            <tr>

                                <td><font size="2" face="verdana,geneva"> Обратный звонок - мы перезваниваем <br/>на Ваш

                                        мобильный номер

                                        через 10 секунд:</font></td>

                                <td valign="top"></td>

                                <td valign="top" style="    text-align: center;">

                                    <div class=zakazbut onclick='show_backup_call(4, 0)' style="color: #333;padding: 0px 10px;    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9) );

                         background: -moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );

                         filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9');

                         background-color: #f9f9f9;    width: 182px;

                         line-height: 32px;

                         -moz-border-radius: 3px;

                         -webkit-border-radius: 3px;

                         border-radius: 3px;

                         border: 1px solid #dcdcdc;    float: right;    line-height: 35px;">Получить обратный звонок

                                    </div>

                                </td>

                                <td></td>

                            </tr>

                            </tbody>

                        </table>



                        <br>

                    </div>



                    <div style="margin:auto;    margin-bottom: 20px;">



                        <div class="content" style="width:100%;margin:0px;    font-size: 18px;">



                            <table>

                                <tr>

                                    <td width=50% valign=top>

                                        <h2>Свяжитесь с нами:</h2><br>



                                        <div class=cfdiv>

                                            <table style="width: 100%;

                               margin: auto;">



                                                <tr>

                                                    <td colspan="2"><h3>Санкт-Петербург</h3></td>

                                                </tr>

                                                <tr>

                                                    <td class=phone style="width:49%">+7 (812) 648-03-47</td>

                                                    <td></td>

                                                </tr>

                                                <tr>

                                                    <td class=mob>+7 911 002-13-42</td>

                                                    <td class=mob> +7 904 630-67-67</td>

                                                </tr>



                                                <tr>

                                                    <td><h3>Москва</h3></td>

                                                    <td></td>

                                                </tr>

                                                <tr>

                                                    <td class=phone>+7 (499) 638-37-91</td>

                                                    <td></td>

                                                </tr>





                                                <tr>

                                                    <td colspan="2"><h3>Skype (чат)</h3></td>

                                                </tr>



                                                <tr>

                                                    <td class=sk><a href='skype:artemfam?chat' class='wei_link'

                                                                    title='Отправить нам сообщение в Скайпе на аккаунт artemfam77'>

                                                            artemfam</a></td>

                                                    <td class=sk><a href='skype:hmi-sales-spb?chat' class='wei_link'

                                                                    title='Отправить нам сообщение в  Скайпе на аккаунт hmi-sales-spb'>

                                                            hmi-sales-spb</a></td>

                                                </tr>

                                                <tr>

                                                    <td class=sk><a href='skype:weintek.net?chat' class='wei_link'

                                                                    title='Отправить нам сообщение в Скайпе на аккаунт weintek.net'>

                                                            weintek.net</a>

                                                    <td>&nbsp;</td>

                                                </tr>



                                                <tr>

                                                    <td colspan="2"><h3>E-mail</h3></td>

                                                </tr>

                                                <tr>

                                                    <td class=email><span id=emailsh> </span></td>

                                                    <td>&nbsp;</td>

                                                </tr>





                                            </table>

                                            <br><br>





                                        </div>





                                    </td>

                                    <td width=30>&nbsp</td>

                                    <td valign=top>

                                        <h2>Отправьте нам сообщение:</h2><br>



                                        <div class=cfdiv style="padding: 20px 40px;">

                                            <div class=gfts>Для обращений по техподдержке пожалуйста, перейдите в <a

                                                        href='/support.php'>этот раздел >></a></div>

                                            <br><br>

                                            Имя<br> <input type=text id=cfname style="outline:none;"><br><br>

                                            Телефон<br> <input type=text id=cfphone style="outline:none;"><br><br>

                                            Email<br> <input type=text id=cfemail style="outline:none;"><br><br>



                                            Сообщение <br><textarea id=cfmess

                                                                    style="resize: none; outline: none;    height: 100px;"> </textarea><br><br>

                                            <div id=cfmessres><br><br></div>

                                            <br>



                                            <center><span class=zakazbut onclick='sendcf()'> Отправить </span>

                                                <center>

                                                    <br><br>

                                        </div>

                                        <br><br>

                                    </td>

                                </tr>

                            </table>





                        </div>



                    </div>

                </div>



            </div>

        </div>

    </div>





    <style>



        #callbackline:before {

            content: '';

            height: 56px;

            width: 92px;

            display: inline-block;

            position: absolute;

            border-left: 0px solid white;

            border-top: 22px solid white;

            border-bottom: 16px solid transparent;

            border-right: 22px solid transparent;

            margin-top: -10px;

        }



        #callbackline:after {

            content: '';

            height: 57px;

            width: 94px;

            display: inline-block;

            position: absolute;

            border-right: 0px solid white;

            border-bottom: 22px solid white;

            border-top: 16px solid transparent;

            border-left: 22px solid transparent;

            margin-left: 1034px;

            margin-top: -84px

        }



        .content p {

            text-align: justify;

            margin: 10px 0px 30px 0px;

        }



        .date {

            float: left;

            line-height: 27px;

        }



        .content h2 {

            font-size: 20px;

        }



        span.n {

            display: none;

        }



        .content ul {

            text-align: left !important;

            margin-left: 40px;

        }

    </style>



    <style>



        a.wei_link {

            color: #7E0378;

            text-decoration: none

        }



        a.wei_link:hover {

            color: #f977f7;

            text-decoration: none

        }



        .wein_txt {

            padding: 10;

            font-family: Verdana, 'Lucida Grande';

            font-size: 12px;

            width: 750px;

            text-align: justify;



        }



        .cfdiv {

            font-family: Verdana, 'Lucida Grande';

            font-size: 12px;

            text-align: left;

            border: 1px solid #cccccc;

            /*width: 450px;*/

            padding: 20px;

            background: #fdfdfd;

            height: 500px;

        }



        .cfdiv td {

            line-height: 40px;



        }



        .cfdiv td[colspan="2"] {

            padding-top: 10px;



        }



        .cfdiv input {

            width: 90%;

            line-height: 24px;

            padding: 3px 5%;

        }



        .cfdiv textarea {

            width: 90%;

            padding: 10px 5%;

        }



        .gfts {

            font-family: Verdana, 'Lucida Grande';



            text-align: left;

        / / border: 1 px solid #cccccc;

            padding: 2px;

            white-space: pre;

        }



        .mob {

            background-image: url('images/mob2.jpg');

            background-repeat: no-repeat;

            height: 30px;

            width: 30px;

            border-width: 0px;

            background-position: 0% 50%;

            padding-left: 8%;

        }



        .phone {

            background-image: url('images/stac_phone.gif');

            background-repeat: no-repeat;

            height: 30px;

            width: 30px;

            border-width: 0px;

            background-position: 0% 50%;

            padding-left: 8%;

        }



        .email {

            background-image: url('images/email3.jpg');

            background-repeat: no-repeat;

            height: 30px;

            width: 30px;

            border-width: 0px;

            background-position: 0% 50%;

            padding-left: 8%;

        }



        .sk {

            background-image: url('https://www.rusavtomatika.com/images/skype-logo1.jpg');

            background-repeat: no-repeat;

            height: 30px;

            width: 30px;

            border-width: 0px;

            background-position: 0% 50%;

            padding-left: 8%;

        }



    </style>





<? temp3(); ?>