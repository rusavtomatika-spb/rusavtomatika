<?php
header('Content-type: text/html; charset=UTF-8');

define('MAIN_FILE_EXECUTED', true);
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
require_once 'model.php';
switch ($_POST['action']) {
    case "get_form_panel":
        $out["status"] = 1;
        createForm($_POST['data']);
        break;
    case "":
        $out["status"] = 1;
        echo "null(((";
        break;

    default:
        break;
}

$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
//$out["buffer"] = ob_get_contents();
ob_end_clean();
echo json_encode($out);

function createForm($data) {
    if (isset($data["hiddenFields"]["table"]) and isset($data["hiddenFields"]["id"])){
        $row = \model\get_row_by_id($data["hiddenFields"]["table"], $data["hiddenFields"]["id"]);
        $arFields = array();
         foreach ($data["fields"] as $field) {
             $arFields[$field["field"]] = array("name_rus" => $field["name_rus"] ,"type" => ["type"] );
         }
                echo "<pre>";
                var_dump($arFields);
                echo "</pre>";
        
        foreach ($data["fields"] as $field) {
            if (isset($row[$field["field"]]) and $row[$field["field"]] != ''){
//                echo "<br>";
//                var_dump($row[$field["field"]]);
                $field[$field["field"]]['value'] = $row[$field["field"]];
            }            
        }

        
    }
    
    ?>
    <form method="post" class="popupform"> 
        <? foreach ($data["hiddenFields"] as $key => $value) {
            ?><input type="hidden" name="<?= $key ?>" value="<?= $value ?>" ><?             
        }
        ?> 
        <?/*?><div class="form_title"><?= $data["titleForm"] ?></div><?*/?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="popupform_table">
                            <?
                            $count = 0;
                            foreach ($data["fields"] as $field) {
                                echo "<br>".$count++."<br>";
                                if (isset($field['field'])) {
                                    if (isset($field['name_rus']) and mb_detect_encoding($field['name_rus'] == "UTF-8")) {
echo "!!!".$field['name_rus']."!!!";
                                        $field['name_rus'] = iconv("UTF-8", "cp1251", $field['name_rus']);
                                        //$field['name_rus'] = iconv("UTF-8//IGNORE", "cp1251//IGNORE", $field['name_rus']);
                                        //$field['name_rus'] = mb_convert_encoding($field['name_rus'], "UTF-8", "WINDOWS-1251");
                                    }
                                    ?><tr><?
                                        switch ($field['type']) {
                                            case 'text':
                                                ?>
                                                <td>
                                                    <div class="name_rus"><?= $field['name_rus'] ?> </div>
                                                </td>
                                                <td>
                                                    <input name="<?= $field['field'] ?>" type="text" placeholder="..." 
                                                           value="<? if (isset($field['value'])) echo $field['value'] ?>"/>
                                                </td><?
                            break;
                        case 'textarea':
                                                ?>
                                                <td colspan="2">
                                                    <div class="name_rus"><?= $field['name_rus'] ?></div>                               

                                                    <textarea name="<?= $field['field'] ?>">
                                                        <? if (isset($field['value'])) echo $field['value'] ?>
                                                    </textarea>
                                                </td><?
                                                        break;

                                                    default:
                                                        break;
                                                }
                                                ?></tr><?
                                    }
                                }
                                ?>  
                    </table>
                </div> 
            </div> 
        </div>  
    </form>
    <?
}
