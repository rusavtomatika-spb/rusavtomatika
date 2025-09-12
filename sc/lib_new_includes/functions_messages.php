<?php

function popup_messages() {
    if (defined('popup_shit'))
        return;
    define('popup_shit', 1);
    echo "
<div id='mes_container'>
<div id=mes_header onclick='hide_popup();'>
Сообщение
</div>
<div id=mes_body>

body
</div>
</div>
<div id=mes_backgr> </div>
";
//---------------------- popmes 1 --
    echo "
<div id=popmes1 style='display:none;'>

Для обсуждения скидки <br>
сообщите нам свой телефонный номер<br>
<input id='phone' type='text' />
<br><br>
<table width='100%'>
<tr>
<td width='50%' align='center'>
<span class='orangebut' onclick='get_discount_form()'>Отправить</span>
</td><td align='center'>
<span class=orangebut onclick='hide_popup()'>Закрыть</span>
</td></tr></table>

<div id=form_out> </div>

</div>
";
}

function backup_call() {
    echo "<div id=backup_call >
    <div id=backup_call_h> </div>

    <div id='backup_call_body'> </div>
    <center class='backup_call_block_phoneNumber'>
        +<input type='text' class='phoneNumber' name='phone' />
    </center>
        <div id='backup_call_message'> </div>
        <br><br>
        <center>
            <span class='zakazbut btn_send' onclick='backup_call_go()'>Звонок</span>  &nbsp &nbsp<span class='zakazbut btn_close' onclick='backup_call_hide()'>Закрыть</span>
        </center>
</div>


";
}

function send_message(
$email, // email получателя
        $subj, // тема письма
        $text // текст письма
) {
    $subj = iconv("CP1251", "UTF-8", $subj);
    $subj = '=?utf-8?B?' . base64_encode($subj) . '?=';
//    $name_from = "no-reply@rusavtomatika.com"; // имя отправителя
//    $email_from = "no-reply@rusavtomatika.com"; // email отправителя
    $name_from = "RA"; // имя отправителя
    $email_from = "no-reply@rusavtomatika.com"; // email отправителя
    $name_to = ""; // имя получателя
    $data_charset = "UTF-8"; // кодировка переданных данных
    $send_charset = "UTF-8"; // кодировка письма
    $html = TRUE; // письмо в виде html или обычного текста
    $reply_to = FALSE;

    if ($email == "admin")
        $email = "plesk@mail.ru";


    $to = mime_header_encode($name_to, $data_charset, $send_charset)
            . ' <' . $email . '>';
    $subject = mime_header_encode($subj, $data_charset, $send_charset);
    $from = mime_header_encode($name_from, $data_charset, $send_charset)
            . ' <' . $email_from . '>';
    if ($data_charset != $send_charset) {
        $body = iconv($data_charset, $send_charset, $body);
    }
    $headers = "From: $from\r\n";
    $type = ($html) ? 'html' : 'plain';
    $headers .= "Content-type: text/$type; charset=$send_charset\r\n";
    $headers .= "Mime-Version: 1.0\r\n";
    if ($reply_to) {
        $headers .= "Reply-To: $reply_to";
    }



    return mail($to, $subj, $text, $headers);
//    return mail($to, $subject, $text, $headers);
}


function mime_header_encode($str, $data_charset, $send_charset) {
    if ($data_charset != $send_charset) {
        $str = iconv($data_charset, $send_charset, $str);
    }
    return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}

function XMail($from, $to, $subj, $text, $filename) {

    $subj = iconv("CP1251", "UTF-8", $subj);
    $subj = '=?utf-8?B?' . base64_encode($subj) . '?=';

    /* $from = iconv("CP1251", "UTF-8", $from);
      $from = '=?utf-8?B?' . base64_encode($from) . '?='; */

    $text = iconv("utf-8", "CP1251", $text);
    $f = fopen($filename, "rb");
    $un = strtoupper(uniqid(time()));
    $head = "From: $from\n";
    $head .= "To: $to\n";
    $head .= "Subject: $subj\n";
    $head .= "X-Mailer: PHPMail Tool\n";
    $head .= "Reply-To: $from\n";
    $head .= "Mime-Version: 1.0\n";
    $head .= "Content-Type:multipart/mixed;";
    $head .= "boundary=\"----------" . $un . "\"\n\n";
    $zag = "------------" . $un . "\nContent-Type:text/html;\n";
    $zag .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
    $zag .= "------------" . $un . "\n";
    $zag .= "Content-Type: application/octet-stream;";
    $zag .= "name=\"" . basename($filename) . "\"\n";
    $zag .= "Content-Transfer-Encoding:base64\n";
    $zag .= "Content-Disposition:attachment;";
    $zag .= "filename=\"" . basename($filename) . "\"\n\n";
    $zag .= chunk_split(base64_encode(fread($f, filesize($filename)))) . "\n";


    if (!mail("$to", "$subj", $zag, $head))
        return 0;
    else
        return 1;
}
