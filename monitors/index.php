<?



/*ini_set('error_reporting', E_ALL);

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);  */

$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php/", "", $vta[0]);

$var_to_array = str_replace("/index.php", "", $var_to_array);

$CANONICAL = $var_to_array;

$var_to_array = str_replace(".php/", "", $var_to_array);

$var_to_array = str_replace(".php", "", $var_to_array);

$var_to_array = str_replace("//", "/", $var_to_array);

$var_array = explode("/", $var_to_array);

$levels = count($var_array);

$end_page = $levels - 1;



if (($end_page >= 2)) {

   include ("products_newo.php");

}else{



    $extra_openGraph = Array(

        "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/monitors.png",

        "openGraph_title" => "������������ ��������",

        "openGraph_siteName" => "�������������"

    );

global $current_component;

global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;

$DESCRIPTION = '������������ LED �������� IFC � Cincoze � ���������� 5,7&Prime;-22&Prime; � ����������� ������� 12 V, ��������, ��������, ����������������, ������ ������, IP65 �������� ������, ����� VGA, DVI, Audio, USB-����� � ��������� ����';

$KEYWORDS = '�������, IFC, Cincoze, LED, 5,7&Prime;, 22&Prime; ���������, VGA, DVI, USB, ������, �����������, ����������, ���������, ������������, ������������, 8&Prime;, 10.4&Prime; , 15&Prime;, 17&Prime;, 19&Prime;, 22&Prime;';

$TITLE = '������������ �������� ( ������������, ��������� )';

$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";

include $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

require_once '../sc/lib_new.php';

?>



<style>



    .block_content h2{

        font-size: 23px;

    }

    .catalog_box-pc-aplex__table_features td {

        border: 1px solid #dedede;

}

    </style>

        <article>

<h1>������������ �������� ( ������������ ��������, ��������� ��������)</h1>



<div class="color_text_block">

<p>

� ������� <strong>������������</strong> �������� �� <strong>��������</strong> ��������� ������� ���������� � ���������� ���� ������������. �� ���� ��������, ������������� <strong>������������ ���������</strong> ���������� ������ ������������ ���������. ����� <strong>��������</strong> �������� �������� � ������� ������������� ��������� � ��� ���������� ���������, � ����� ��� ���������� ���������, ���� ������ ��������� IP65/IP66. 

� ������� ������� <strong>������������ ��������</strong> ������ ����������: �� 5.6� �� 21.5�. ����������� ��������� �� <strong>�������</strong> � ������� ����������� ����� ���: VGA, HDMI, DisplayPort, DVI



</p>

</div>

<?

$component->show(array(

    "component_name" => "news.list",

    "component_template" => "main_page_type",

    "template_arguments" => array(

        "title" => "IFC",

        "text" => "�������� IFC ( ����� ) ��� ���������������� ������������� ������������ <strong>������������ ���������</strong>, ���������� ����� 10 ���. �������� IFC ��������� �����������,

            � �������� ��������� ���������� ����������. <strong>�������� IFC</strong> � ������� �� ���������� �����.<br /><br />

            �������������� ����� �����������/��������� ��������� �������, ����- � �������������� �������� ������ � ���������� �������, ������ ��������� ����������, ������� ����������� � ������� ������ ������������ ��������� ������ <strong>�������� IFC</strong> ��������� ����������� � ���������� ���������������� ���������� � ����� �����.<br /><br />

            <strong>���������� ����� ����������</strong> ( 12&Prime; � 21.5&Prime; ) ��������� ��������� ����������� ������ ��� ������� ������ ������.",

        "anchor" => "cheapmonitorsifc"

    )),array(

        "table" => "products_all",

        "brand" => "IFC",

        "order" => "diagonal",

        "custom_sql_query" => "and (`type` = 'monitor' or `type` = 'monitors')"

    )

);

$component->show(array(

        "component_name" => "news.list",

        "component_template" => "main_page_type",

        "template_arguments" => array(

                "title" => "APLEX",

                "title_link" => "/monitors/aplex/"

        )),array(

                "table" => "products_all",

                "brand" => "APLEX",

                "type" => "monitors",

                "order" => "diagonal"

        )

);



$component->show(array(

    "component_name" => "news.list",

    "component_template" => "main_page_type",

    "template_arguments" => array(

            "title" => "������������ �������� Cincoze",

            "title_link" => "/cincoze/#monitors"

    )),array(

            "table" => "products_all",

            "brand" => "Cincoze",

            "type" => "monitor",

            "order" => "diagonal",

            "custom_sql_query" => "and diagonal > 0"

    )

);

?>

        </article>



<?

 

include $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";



}

?>



