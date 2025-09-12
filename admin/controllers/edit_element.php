<?php
define('admin', true);
define('CONTROLLERS', true);
if (0) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
$core_admin_path = $_SERVER['DOCUMENT_ROOT'] . '/admin/';
include_once $core_admin_path . 'template/header.php';
include_once $core_admin_path . 'controllers/menu.php';
$row = array();
$db_work = new DBWORK();
if (isset($_GET["index"]) and $_GET["index"] > 0) {
    $element_id = intval($_GET["index"]);
    if (isset($_GET["action"]) and $_GET["action"] == "edit_element") {

        $result = $db_work->edit_catalog_element($element_id, $_POST);
        if (isset($result) and $result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
            if (isset($_POST["submit_and_close"])) {
                header('Refresh:0; /admin/controllers/?success=' . $result["success"] . '&element_id=' . $result["element_id"] . '&section_code=' . $_POST["section_code"] . '&message=' . urlencode($result["message"]));
            }
        }
    }
} else {
    echo "��� �� �� ���";
    exit();
}
?>

<div class="notes-area">
    <div>
        <?
        $current_element = $db_work->get_catalog_element_by_id($element_id);
        //$list_catalog_element_fields_text = $db_work->get_list_catalog_element_fields_text(Array("index" => $element_id));
        //var_dump($list_catalog_element_fields_text);
        ?>
    </div>
    <pre style="text-align: left">
        <?
        $table_fields = $db_work->getlist_table_fields();

        function cmp($a, $b) {
            return strcmp($a[0], $b[0]);
        }

        usort($table_fields, "cmp");
        //var_dump($table_fields);
        if (is_array($table_fields) and count($table_fields) > 0) {
            $x = 0;
            foreach ($table_fields as $value) {


                switch ($value[0]) {
                    case "isolation_resistance":
                        $rus_name = "C������������ ��������";
                        break;
                    case "voltage_resistance":
                        $rus_name = "��������� ��������� �������";
                        break;
                    case "vibration":
                        $rus_name = "�����������������";
                        break;
                    case "humidity":
                        $rus_name = "������������� ���������";
                        break;
                    case "power_isolation":
                        $rus_name = "�������� �� �������";
                        break;
                    case "graphics":
                        $rus_name = "�������(����������� �����)";
                        break;
                    case "ftp_access_sd_usb":
                        $rus_name = "Ftp ������ � SD ����� � ������";
                        break;
                    case "ftp_access_hmi_mem":
                        $rus_name = "Ftp ������ � ������ ������";
                        break;
                    case "ethernet_full":
                        $rus_name = "Ethernet (ethernet_full) ��������� ������ ���";
                        break;
                    case "sdcard":
                        $rus_name = "���� ���� ������";
                        break;
                    case "chipset":
                        $rus_name = "������";
                        break;
                    case "certification":
                        $rus_name = "�����������";
                        break;
                    case "can_bus":
                        $rus_name = "CAN BUS (����/���/CANopen ��������)";
                        break;
                    case "brutto":
                        $rus_name = "���&nbsp;������";
                        break;
                    case "audio":
                        $rus_name = "��������&nbsp;�����";
                        break;
                    case "av_input":
                        $rus_name = "�����/�����&nbsp;����";
                        break;
                    case "backlight":
                        $rus_name = "���&nbsp;���������";
                        break;
                    case "backlight_life":
                        $rus_name = "�����&nbsp;�����&nbsp;���������";
                        break;
                    case "brightness":
                        $rus_name = "�������";
                        break;
                    case "case_material":
                        $rus_name = "��������&nbsp;������� (Canning Material)";
                        break;
                    case "colors":
                        $rus_name = "���������";
                        break;
                    case "contrast":
                        $rus_name = "�������������";
                        break;
                    case "cpu_speed":
                        $rus_name = "�������";
                        break;
                    case "cpu_type":
                        $rus_name = "���������";
                        break;
                    case "current":
                        $rus_name = "������������ ���";
                        break;
                    case "cutout":
                        $rus_name = "���������� ��������� (����� ��� �������, Hole Size)";
                        break;
                    case "diagonal":
                        $rus_name = "���������";
                        break;
                    case "dimentions":
                        $rus_name = "��������(Overall Dimension)";
                        break;
                    case "ethernets":
                        $rus_name = "���������� ������ ethernet";
                        break;
                    case "flash":
                        $rus_name = "Flash(����������) � ��";
                        break;
                    case "front_ip":
                        $rus_name = "������� ������ �� ������ (Level of Protection)";
                        break;
                    case "history_data_size_mb":
                        $rus_name = "����� ������ ��� ���������� ������� � ������";
                        break;
                    case "netto":
                        $rus_name = "���";
                        break;
                    case "power_connector":
                        $rus_name = "������ �������";
                        break;
                    case "project_size_mb":
                        $rus_name = "������������ ������ �������";
                        break;
                    case "ram":
                        $rus_name = "���";
                        break;
                    case "resolution":
                        $rus_name = "����������";
                        break;
                    case "retail_price":
                        $rus_name = "����";
                        break;
                    case "rtc":
                        $rus_name = "���� ��������� �������";
                        break;
                    case "serial":
                        $rus_name = "(COM)";
                        break;
                    case "serial_full":
                        $rus_name = "���������������� ����������";
                        break;
                    case "set":
                        $rus_name = "�������� ��������";
                        break;
                    case "software":
                        $rus_name = "�� ��� ���������� ��������";
                        break;
                    case "temp":
                        $rus_name = "������� �����������";
                        break;
                    case "temp_max":
                        $rus_name = "���.����. ��";
                        break;
                    case "temp_min":
                        $rus_name = "���.����. ��";
                        break;
                    case "touch":
                        $rus_name = "��� �������";
                        break;
                    case "ts_usb":
                        $rus_name = "��������� �������";
                        break;                    
                    case "usb_host":
                        $rus_name = "USB Host";
                        break;
                    case "voltage_max":
                        $rus_name = "���������� ������� ��";
                        break;
                    case "voltage_min":
                        $rus_name = "���������� ������� ��";
                        break;
                    case "thickness":
                        $rus_name = "�������(�������)";
                        break;
                    case "onstock":
                        $rus_name = "�������";
                        break;

                    default:
                        $rus_name = "";
                        break;
                }


                $x++;
                $row = '<tr><td style="width:21%">' . $x . ': <span>' . $value[0] . '[' . $value[1] . ']' . '</span> [' . $rus_name . ']</td><td><input type="text" name="field_' . $value[0] . '" value="' . $current_element[$value[0]] . '"></td></tr>';
                $pos = strpos($value[1], "varchar");
                $pos2 = strpos($value[1], "text");
                if ($pos !== false or $pos2 !== false) {
                    $length = preg_replace("/[^0-9]/", '', $value[1]);
                    if ($length > 200 or $value[1] == "text")
                        $row = '<tr><td style="width:21%">' . $x . ': <span>' . $value[0] . '[' . $value[1] . ']' . '</span> [' . $rus_name . ']</td><td><textarea rows="5" name="field_' . $value[0] . '">' . htmlentities($current_element[$value[0]]) . '</textarea></td></tr>';
                }
                $rows[] = $row;
            }
        }
        ?>
    </pre>
</div>
<h1>�������������� �������� <?= $current_element['model'] ?> [<?= $element_id ?>]</h1>
<form action="/admin/controllers/edit_element.php?index=<?= $current_element["index"] ?>&action=edit_element" method="post">
    <table>
        <tr>
            <td colspan="2" class="td_buttons">
                <div class="sticky">
                    <input type="reset" value="�������� ���� � ��������">
                    <input type="submit" value="���������">
                    <input name="submit_and_close" type="submit" value="��������� � �������">
                    <input type="button" onclick="history.back();" value="��������� �����"/>
                </div>
            </td>
        </tr>
        <?
        $table_fields = $db_work->getlist_table_fields();
        //var_dump($table_fields);
        if (is_array($table_fields) and count($table_fields) > 0) {
            foreach ($rows as $row) {
                echo $row;
            }
        }
        ?>
        <tr>
            <td colspan="2" class="td_buttons">
                <input type="reset" value="�������� ���� � ��������">
                <input type="submit" value="���������">
                <input name="submit_and_close" type="submit" value="��������� � �������">
                <input type="button" onclick="history.back();" value="��������� �����"/>
            </td>
        </tr>

    </table>
</form>

<div></div>



<? include $core_admin_path . 'template/footer.php'; ?>