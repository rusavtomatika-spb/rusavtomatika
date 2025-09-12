<?
//450 - не Ajax-запрос
//451 - пользователь не авторизован
//301 - нет соединени¤ с базой данных
//606 - лишние символы в присланных данных
//444 - нет права на редактирование

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    if (isset($_COOKIE['llp'])) {
        $hach = $_COOKIE['llp'];

        define("bullshit", 1);
        $db_file = $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";

        if (file_exists($db_file)) {
            global $mysqli_db;
            include($db_file);
            database_connect();
            mysqli_query($mysqli_db, "SET NAMES 'cp1251'");

//ѕровер¤ем куку в сесси¤х
            $sql = "SELECT * FROM `wm_sessions` WHERE  `sid`='{$hach}' LIMIT 1";
            $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
            $COUNT = mysqli_num_rows($res);

//?сли кука есть в сесси¤х
            if ($COUNT == 1) {

                if (preg_match("/weblec/i", $_SERVER['DOCUMENT_ROOT'])) {
                    $file = '/home/weblec/public_html/rusavtomatika.com/usdrate.txt';
                } else {
                    $file = $_SERVER['DOCUMENT_ROOT'] . '/usdrate.txt';
                };
                if (file_exists($file)) {
                    $u = file_get_contents($file);


                };

                $r = mysqli_fetch_assoc($res);
                $user_login = $r['k'];

                $sql = "SELECT * FROM `wm_auth_users` WHERE  `user_login`='{$user_login}' AND `user_status`='1' LIMIT 1";
                $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
                $COUNT = mysqli_num_rows($res);

                $OUT = '
<div style="height: 195px;text-align:center;width:100%;margin:0px;background-color:rgb(245, 245, 245);">
<img src="/images/action0.png" style="float:left;width: 243px;margin: 20px 10px;">
<img src="/images/sale.png" style="float:right;width: 243px;  margin: 0px 10px 0px 20px;"><h1 style="
    font-size: 47px;
    padding-top: 37px;
    line-height: 56px;
    font-family: Times New Roman;
    font-weight: normal;

">Уцененные товары</h1>

</div>
<style>
#sale-content {
	    font-family: Verdana, \'Lucida Grande\';
		padding-top: 0px important;
}
.sale {
	width: 90%;
	margin: auto;
	margin-top: 60px;
	margin-bottom: 60px;	
    background-color: white;
    font-size: 0.9em;	
}
.sale input, .sale textarea {
	display:none;
}
.sale td {
    padding: 10px 15px;
    border: 1px dashed silver;
}
.sale tr:first-child td  {
	font-weight: bold;
}

.sale tr:not(:first-child) td:not(.rotate):last-child  {
text-align: right;
    padding-right: 40px;	
}	
.rotate {
	    text-align: center;
		cursor: pointer;
}
.rotate div{
	    font-size: 37px;
    color: #e60e13;	
    padding-right: 15px;

}
.rotate div.start{
    transform: rotate(120deg);
    margin-top: 4px;
    margin-bottom: -13px;		
}
.finish, .cancel, .delete {
	display:none;
}
.delete {
    position: absolute;
    right: -4px;
}
#add {
    text-align: center;
    color: #3e9b28;
    border: 2px solid #3e9b28;
    width: 35px;
    height: 22px;
    margin: auto;
    border-radius: 4px;	
	cursor: pointer;
}
</style>
';

                if ($COUNT == 1) {

                    if (empty($_POST)) {

//Непосредственно вывод записей по остаткам

                        $query = "SELECT * FROM `sale` WHERE `show`='1' ORDER BY `name` ASC ;";
                        $query_result = mysqli_query($mysqli_db, $query) or die("file: " . __FILE__ . " line: " . __LINE__ . " error: " . mysqli_error($mysqli_db));
                        $j = mysqli_num_rows($query_result);
                        if ($j > 0) {

                            $OUT .= '<table class="sale"><tr>
<td style="    border-right: none;">&nbsp;</td>
<td style="    border-left: none;">Позиция</td>
<td>Описание</td>
<td>Цена</td>
<td>Кол-во на складе</td>
<td><div  id="add">&#10133;</div></td>
</tr>';

                            for ($i = 1; $i <= $j; $i++) {
                                $row = mysqli_fetch_assoc($query_result);

                                if ($u > 0) {
                                    $price1 = number_format($u * $row[price], 0, '.', ' ');
                                    $price1 = '' . $price1 . ' руб.';
                                } else {
                                    $price1 = '';
                                };

                                $OUT .= '<tr id="row-' . $row[id] . '">
<td>' . $i . '</td>
<td><div>' . $row[name] . '</div><input type="text"  name="name" value="' . $row[name] . '" disabled></td>
<td><div>' . $row[description] . '</div><textarea disabled>' . $row[description] . '</textarea></td>
<td><div>' . $price1 . '</div><input type="text"  name="price" value="' . $row[price] . '" disabled></td>
<td><div>' . $row[count] . '</div><input type="text"  name="count" value="' . $row[count] . '" disabled></td>
<td class="rotate" data-id="' . $row[id] . '" sys_name="' . $row[sys_name] . '"><div class="delete">&#10060;</div><div class="start">&#9999;</div><div class="finish">&#9989;</div><div class="cancel">&#10558;</div></td>
</tr>';


                            };
                            $OUT .= '</table>';

                        };

                    } else {

//id:id, name:name, description:description, price:price, count:count, sys_name:sys_name 
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $count = $_POST['count'];
                        $sys_name = $_POST['sys_name'];
                        $type = $_POST['type'];

                        if ((is_numeric($_POST['id'])) AND (is_numeric($_POST['price'])) AND (is_numeric($_POST['count'])) AND (strip_tags($_POST['sys_name']) == $_POST['sys_name']) AND (strip_tags($_POST['description']) == $_POST['description']) AND (strip_tags($_POST['name']) == $_POST['name'])) {

                            $name = iconv('UTF-8', 'windows-1251', $_POST['name']);
                            $description = iconv('UTF-8', 'windows-1251', $_POST['description']);

                            if ($type == 'edit') {
                                //if (preg_match_all('/http:\/\/\S/',$_POST['description'],$marches)) {	}
                                if (($_POST['id'] != '0') AND ($_POST['sys_name'] != 'new')) {
                                    $query = "UPDATE `sale` SET `name`='{$name}',`count`='{$_POST['count']}',`price`='{$_POST['price']}',`description`='{$description}' WHERE `id`='{$_POST['id']}' AND `sys_name`='{$_POST['sys_name']}'";
                                    $query_result = mysqli_query($mysqli_db, $query) or die("file: " . __FILE__ . " line: " . __LINE__ . " error: " . mysqli_error($mysqli_db));
                                    echo 'ok';
                                    exit();
                                } else if (($_POST['id'] == '0') AND ($_POST['sys_name'] == 'new')) {


                                    $query = "INSERT INTO `sale`(`id`, `name`, `sys_name`, `count`, `price`, `description`) VALUES ('','{$name}','','{$_POST['count']}','{$_POST['price']}','{$description}')";
                                    $query_result = mysqli_query($mysqli_db, $query) or die("file: " . __FILE__ . " line: " . __LINE__ . " error: " . mysqli_error($mysqli_db));
                                    $query = "SELECT * FROM `sale` WHERE `name`='{$name}'  AND  `count`='{$_POST['count']}' AND `price`='{$_POST['price']}' AND `description`='{$description}' ORDER BY `id` DESC LIMIT 1";
                                    $query_result = mysqli_query($mysqli_db, $query) or die("file: " . __FILE__ . " line: " . __LINE__ . " error: " . mysqli_error($mysqli_db));
                                    $j = mysqli_num_rows($query_result);
                                    if ($j > 0) {
                                        $row = mysqli_fetch_assoc($query_result);
                                        $id = $row[id];
                                        $query = "UPDATE `sale` SET `sys_name`='sale-{$id}' WHERE `id`='{$id}'";
                                        $query_result = mysqli_query($mysqli_db, $query) or die("file: " . __FILE__ . " line: " . __LINE__ . " error: " . mysqli_error($mysqli_db));

                                    }
                                    echo 'added-' . $id;
                                    exit();
                                } else {

                                    echo iconv('windows-1251', 'UTF-8', 'Запрос на распознан, возможна ошибка ');
                                };
                            } else if ($type == 'delete') {
                                $query = "UPDATE `sale` SET `show`='0' WHERE `id`='{$_POST['id']}' AND `sys_name`='{$_POST['sys_name']}'";
                                $query_result = mysqli_query($mysqli_db, $query) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));

                                echo 'ok';
                                exit();
                            };

                        } else {

                            echo iconv('windows-1251', 'UTF-8', 'проверьте введенные данные');
                            if (is_numeric($_POST['id'])) {
                                echo $_POST['id'] . ' is numeric';
                            };

                            if (is_numeric($_POST['price'])) {
                                echo $_POST['id'] . ' id is numeric';
                            };
                            if (is_numeric($_POST['count'])) {
                                echo $_POST['count'] . ' couint is numeric';
                            };
                            if (strip_tags($_POST['sys_name']) == $_POST['sys_name']) {
                                echo $_POST['sys_name'] . ' is ok';
                            };
                            if (strip_tags($_POST['description']) == $_POST['description']) {
                                echo iconv('windows-1251', 'UTF-8', $_POST['description']) . ' is ok';
                            };
                            if (strip_tags($_POST['name']) == $_POST['name']) {
                                echo iconv('windows-1251', 'UTF-8', $_POST['name']) . ' is ok';
                            };

                        };

                    };

                } else {

                    $OUT .= '<div style="padding: 40px;text-align: center;color: red;">Дождитесь активации Вашей учетной записи</div>';

                };

                $OUT .= <<<EOD

</div>


EOD;

                echo iconv('windows-1251', 'UTF-8', $OUT);

            } else {
//пользователь не авторизован	
                echo '451';

            };
        } else {
//нет соединени¤ с базой данных
            echo '301';
            exit();
        };
    } else {
//пользователь не авторизован	
        echo '451';

    };
} else {
//не ajax	
    echo '450';

};
