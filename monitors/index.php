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
        "openGraph_title" => "Промышленные мониторы",
        "openGraph_siteName" => "Русавтоматика"
    );
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_catalog_404.php";
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
$DESCRIPTION = 'Промышленные LED мониторы IFC и Cincoze с диагональю 5,7&Prime;-22&Prime; с напряжением питания 12 V, качество, простота, функциональность, тонкий корпус, IP65 передней панели, входы VGA, DVI, Audio, USB-выход и умеренные цены';
$KEYWORDS = 'монитор, IFC, Cincoze, LED, 5,7&Prime;, 22&Prime; диагональ, VGA, DVI, USB, сенсор, резистивный, подстветка, наработка, операторский, промышленный, 8&Prime;, 10.4&Prime; , 15&Prime;, 17&Prime;, 19&Prime;, 22&Prime;';
$TITLE = 'Промышленные мониторы ( встраиваемые, сенсорные )';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
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
<h1>Промышленные мониторы ( встраиваемые мониторы, сенсорные мониторы)</h1>

<div class="color_text_block">
<p>
В сложных <strong>промышленных</strong> условиях от <strong>монитора</strong> требуется высокая надежность и длительный срок эксплуатации. По этим причинам, производители <strong>промышленных мониторов</strong> используют только качественные материалы. Такие <strong>мониторы</strong> способны работать в широком температурном диапазоне и при постоянных вибрациях, а также при повышенной влажности, имея защиту стандарта IP65/IP66. 
В наличии имеются <strong>промышленные мониторы</strong> разных диагоналей: от 5.6” до 21.5”. Изображение выводится на <strong>монитор</strong> с помощью интерфейсов таких как: VGA, HDMI, DisplayPort, DVI

</p>
</div>
<?
$component->show(array(
    "component_name" => "news.list",
    "component_template" => "main_page_type",
    "template_arguments" => array(
        "title" => "IFC",
        "text" => "Компания IFC ( Китай ) это профессиональный производитель встраиваемых <strong>промышленных мониторов</strong>, работающий более 10 лет. Компания IFC динамично развивается,
            и качество продукции непрерывно повышается. <strong>Мониторы IFC</strong> — новинка на Российском рынке.<br /><br />
            Чувствительный яркий резистивный/ёмкостный сенсорный дисплей, водо- и пылезащищенная передняя панель с закаленным стеклом, тонкое модульное исполнение, прочная конструкция и широкий спектр возможностей крепления делают <strong>мониторы IFC</strong> надежными помощниками в управлении технологическими процессами в любом месте.<br /><br />
            <strong>Широчайший выбор диагоналей</strong> ( 12&Prime; — 21.5&Prime; ) позволяет подобрать оптимальный размер для решения каждой задачи.",
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
            "title" => "Промышленные мониторы Cincoze",
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
 
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/epilog.php";

}
?>

