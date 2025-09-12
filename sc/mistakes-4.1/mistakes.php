<? header("Content-Type: text/html; charset=windows-1251"); ?>
<!-- ������ �������� ��������� �� ������ http://mistakes.ru/script/mistakes_dev -->
<!-- ������ 4.1 �� 27.04.2015-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
        <TITLE>��������� ������</TITLE>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>

        <style type="text/css">
            html {
                background: #f9f9f9;
                margin: 0;
                padding: 0;
            }
            body {
                background: #f9f9f9;
                margin: 0;
                padding: 25px 30px;
                font-size:14px;
                font-family:Helvetica, Sans-serif, Arial;
                line-height:2em;
            }
            form {margin: 0;}
            .text {
                font-weight: bold;
                font-size:12px;
                color:#777;
            }
            .title {
                font-weight: bold;
                font-size:16px;
                color:#333;
                text-align: center;


            }

            .copyright {
                font-size:11px;
                color:#777;
            }
            .mclose a{
                font:bold 16px Verdana;
                color:#7f7f7f;
                position:absolute;
                right:12px;
                top:9px;
                display:block;
                text-decoration:none;
                width: 100%;
                box-sizing: border-box;
            }
            .mclose a:hover{
                color: #000;
            }
            .m{
                border: 1px solid silver;
                padding: 3px;
                width: 100%;
                box-sizing: border-box;
                border-radius:1px;
                font-size: 13px;
                background-color: #fff;
                overflow:auto;
            }
            .m strong{
                color:red;
            }
            .error_message{line-height:normal;height: 100px;width: 100%;overflow:auto;}
            textarea.m[name="comment"]{height: 100px;}
            #mistakes_form_submit, #mistakes_form_close{
                color:#fff;
                background: #44bb6e;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                font-size: 14px;
                margin: 10px;
            }
            #mistakes_form_submit:hover, #mistakes_form_close:hover{
                background: #34ab5e;

            }
            .obligatory{color:red;}
            select {border-color:silver;}
            .link_error_list{color:#900; float: right;background: #fee url(/bugs/images/bug.gif) 96% center/auto 75% no-repeat;
                             padding:0px 31px 0px 7px;font-size:13px;display: inline-block;transition: 0.2s;}
            .link_error_list:hover{background-color: rgba(68,187,110,0.5)}



        </style>

        <script language="JavaScript">
            var p = top;
            function readtxt()
            {
                if (p != null)
                    document.forms.mistake.url.value = p.loc
                if (p != null)
                    document.forms.mistake.mis.value = p.mis
            }
            function hide()
            {
                var win = p.document.getElementById('mistake');
                win.parentNode.removeChild(win);
            }
        </script>

        <?php
        if ($_POST['submit']) {
            # ��������� ��������� - �������� "yousite.ru" �� ��� ������ �����:
            $title = '��������� �� ������ ';
            $ip = getenv('REMOTE_ADDR');
            $url = (trim($_POST['url']));
            $mis = (trim($_POST['mis']));
            $mis = stripslashes($mis);
            $mis = htmlspecialchars($mis, ENT_QUOTES, 'cp1251');

            $comment = trim($_POST['comment']);
            $comment = stripslashes($comment);
            $comment = htmlspecialchars($comment, ENT_QUOTES, 'cp1251');
            $author = trim($_POST['author']);
            $author = stripslashes($author);
            $author = htmlspecialchars($author, ENT_QUOTES, 'cp1251');

            $emergency = trim($_POST['emergency']);
            $emergency = stripslashes($emergency);
            $emergency = htmlspecialchars($emergency, ENT_QUOTES, 'cp1251');

            $date_deadline = trim($_POST['date_deadline']);
            $date_deadline = stripslashes($date_deadline);
            $date_deadline = htmlspecialchars($date_deadline, ENT_QUOTES, 'cp1251');




//            $comment = mb_convert_encoding($_POST['comment'], "cp1251", "UTF-8");
            //$comment = substr(htmlspecialchars(trim($_POST['comment'])), 0, 100000);


            $mess = '
                <html>
                <head>
                <title>������ �� �����</title>
                </head>
                <body>
                <strong>�����: </strong><span>' . $author . '</span> &nbsp;
                <strong>������� ����: </strong><span>' . $date_deadline . '</span> &nbsp;
                <strong>���������: </strong><span>' . $emergency . '</span><br>
<strong>����� ��������:</strong> <a href="' . $url . '">' . $url . '</a>
                <br/>
                <strong>������:</strong><div> ' . $mis . '</div>
                <br/>
                <strong>�����������:</strong><div>' . $comment . '</div>
                <br/>
                <strong>IP:</strong> ' . $ip . '
                </body>
                </html>
                ';
# Email �����, �� ������� ������ ��������� ���������:
            $to = 'valovenko@ya.ru';
# Email �����, �� ���� ������ ���������:
            $mymail = 'no-reply@rusavto.moisait.net';
# ������ "yousite.ru" �������� ��� ������ �����:
            $from = "From: =?windows-1251?B?" . base64_encode("Error! - rusavto.moisait.net") . "?= < $mymail >\n";
            $from .= "X-Sender: < $mymail >\n";
            $from .= "Content-Type: text/html; charset=windows-1251\n";

            mail($to, $title, $mess, $from);
            echo '<div class="mclose"><a href="javascript:void(0)" onclick="hide()" '
            . 'title="�������">&times;</a></div><br><br><br><center style="font-size:17px;">�������!<br>���� ��������� ����������.'
            . '<br><br><a target="_blank" href="/bugs/">������� ������ ����� � ����� ����</a><br><br>'
            . '<a target="_blank" href="/bugs/_right.php">������� ������ ����� � ����� ����, ���� �������� �������</a><br><input onclick="hide()" type="button" value="������� ����" id="close" '
            . 'name="close"><br><br><br><center>';

            database_connect();
            $query = "INSERT INTO `moisait_ra`.`bug_tracker` "
                    . "(`id`, "
                    . "`date_created`, "
                    . "`date_updated`, "
                    . "`date_deadline`, "
                    . "`urgency`, "
                    . "`url`, "
                    . "`error`, "
                    . "`comment`, "
                    . "`ready`, "
                    . "`approved`, "
                    . "`author`) " . "VALUES "
                    . "(NULL, "
                    . "'" . date("Y-m-d H.i.s") . "', "
                    . "'000-00-00 00:00:00', "
                    . "'$date_deadline', "
                    . "'$emergency', "
                    . "'$url', "
                    . "'$mis', "
                    . "'$comment', "
                    . "'0', "
                    . "'0', "
                    . "'$author');";
            $result = mysql_query($query) or die("Invalid query: " . $query . "<br>" . mysql_error());
            if ($result) {
                echo "������ ��������� � ���� ������!";
            }


            exit();
        }
        ?>

    </head>
    <body onload=readtxt()>
        <div class="mclose"><a href="javascript:void(0)" onclick="hide()" title="�������">&times;</a></div>
        <div class="title">
            ��������� �� ������
            <a target="_blank" class="link_error_list" href="//www.rusavto.moisait.net/bugs/">������ ������</a>
        </div>
        <form name="mistake" action="" method=post>
            <div style="margin: 10px 0;">
                <span class="text">
                    �����<span class="obligatory">*</span> :
                </span>
                <?
                $names[] = " --- ";
                $names[] = "�����";
                $names[] = "�����";
                $names[] = "���� �";
                $names[] = "���� �";
                $names[] = "���������";
                $names[] = "���";
                $names[] = "����";
                $names[] = "�������";
                ?>
                <select name="author" style="width: 100px;">
                    <? foreach ($names as $value) {
                        ?><option value="<?= $value ?>"><?= $value ?></option>
                    <? }
                    ?>
                </select>
                &nbsp;
                <span class="text">
                    ������� ����<span class="obligatory">*</span> :
                </span>
                <input class="m datepicker" style="width: 80px;" type="text" name="date_deadline" size="35">
                &nbsp;<span class="text">
                    ���������:
                </span>
                <?
                $emergency[] = "��������";
                $emergency[] = "������";
                $emergency[] = "����� ���� ����";
                ?>
                <select style="width: 135px;" name="emergency">
                    <? foreach ($emergency as $value) {
                        ?><option value="<?= $value ?>"><?= $value ?></option>
                    <? }
                    ?>
                </select>
            </div>
            <span class="text">
                ����� �������� :
            </span>
            <br />
            <input class="m" type="text" name="url" size="35" >
            <span class="text">
                ������ :
            </span><br />

            <div id="error_message_textarea" class="error_message m" style="">
                <script language="JavaScript">
                    document.write(p.mis);
    //                document.getElementById("error_message_textarea").value = p.mis;
                </script>
            </div>


            <input type="hidden" class="m" rows="5" name="mis" />
            <span class="text">
                ����������� :
            </span>
            <br />
            <textarea class="m" rows="5" name="comment" cols="30"> </textarea>


            <div style="margin-top: 7px;text-align:center;"><input id="mistakes_form_submit" type="submit" value="���������" name="submit">
                <input onclick="hide()" type="button" value="������" id="mistakes_form_close" name="close">
            </div>
        </form>
    <link rel="stylesheet" type="text/css" href="/bugs/cssworld.ru-xcal.css" />
    <script type="text/javascript" charset="utf-8" src="/bugs/calendar2.js"></script>
    <script type="text/javascript">
                    $('form[name="mistake"]').submit(function () {
                        if ($('select[name="author"]').val() === " --- " || $('input[name="date_deadline"]').val() === "")
                        {
                            alert("��������� ������������ ����");
                            return false;
                        }
                    });
    </script>

</body></html>
<?

function database_connect() {

    $host = "localhost"; // ��� �����
    $port = "3306";      // ����� �����, 3306 - �� ���������
    if (preg_match("/moisait/i", $_SERVER['DOCUMENT_ROOT'])) {
        $user = "root";      // ��� ������������
        $pass = '123456';  // ������
        $dbnm = "rusavtomatika_db";      // ��� ��
    }

    $h = empty($port) ? $host : $host . ":" . $port;
    $db = mysql_connect($h, $user, $pass); // ����������� � �������� ��
    if (!$db) { // ���� ����������� �� �������
        print("Datebase connection failed.");
        // ����� ������ � ��������� ���������� �������
        exit();
    }
// ����� �������� ���� ������ ��� ������
    if (!mysql_select_db($dbnm)) { // ���� ��� ����� ��
        print("Datebase select failed.");
        // ����� ������ � ��������� ���������� �������
        exit();
    }
}
?>