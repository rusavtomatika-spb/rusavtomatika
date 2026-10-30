<?
$db_work = new DBWORK();
$brands = $db_work->get_brands();
$db_work = new DBWORK();
$series = $db_work->get_series();
$db_work = new DBWORK();
$types = $db_work->get_types();
//echo "<pre>";
//echo print_r($types);
//echo "</pre>";

?><div class="menu_wrapper">
        <div class="menu_wrapper_col1">
          <input class="filterInput input" type="text" placeholder="Фильтр по тексту..." id="search">
<div>
<select name="brands" id="brands">
  <option value="">--Фильтр по бренду--</option>
<?
	foreach ($brands as $key => $brand) {
		echo '<option value="'.$brand['code'].'">'.$brand['code'].'</option>';
	}
	?>
</select>
<select name="types" id="types">
  <option value="">--Фильтр по типу--</option>
<?
	$tipy = array();
	foreach ($types as $key => $type) {
	array_push($tipy, $type['code']);
	}
	$tipy = array_unique($tipy);
	//$tipy = sort($tipy);
	foreach ($tipy as $key => $type) {
		echo '<option value="'.$type.'">'.$type.'</option>';
	}
	?>
</select>
	<?
	//print_r($tipy);
	?>
<select name="series" id="series">
  <option value="">--Фильтр по серии--</option>
<?
	foreach ($series as $key => $serie) {
		echo '<option value="'.$serie['name'].'">'.$serie['name'].'</option>';
	}
	?>
</select>
</div>
        </div>
    <div class="menu_wrapper_col2">
        <ul class="menu">
            <li><a href="/admin">Главная</a></li>
            <li class="separator"></li>
            <li><a href="/admin">Полный список элементов</a></li>
            <li class="separator"></li>
            <li><a target="_blank" href="/">На сайт</a></li>
            <li>Обновить sitemap.xml: <a target="_blank" href="https://www.rusavtomatika.com/sitemap/generate_sitemap_xml.php">На проде</a> | <a target="_blank" href="https://www.rusavto.moisait.net/sitemap/generate_sitemap_xml.php">На MC</a></li>
        </ul>
    </div>
    <?
    if (isset($_COOKIE["template_theme"])) {
        $selected_theme_option = $_COOKIE["template_theme"];
    } else $selected_theme_option = "";
    if (isset($_COOKIE["show_all_fields"])) {
        $selected_show_all_fields = $_COOKIE["show_all_fields"];
    } else $selected_show_all_fields = "";
    ?>
    <div class="admin-menu-wrapper">
        <select class="choosing_template_theme" name="template_theme" style="width: 100%;">
            <option value="0" <?if($selected_theme_option == 0) echo 'selected'?>>Тема КРУПНАЯ</option>
            <option value="1" <?if($selected_theme_option == 1) echo 'selected'?>>Тема МЕЛКАЯ</option>
        </select>
        <a href="/admin/add_element.php" class="add__element-link" style="width: 100%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="#fff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                <g id="SVGRepo_iconCarrier"> <path d="M4 12H20M12 4V20" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>
            </svg>
            Добавить элемент
        </a>
        <a href="" class="sync__button">
            <svg fill="#fff" height="20px" width="20px" version="1.1" id="XMLID_123_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve" stroke="#fff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                <g id="SVGRepo_iconCarrier"> <g id="sync"> <path d="M7.3,23.7L2.6,19l4.7-4.7l1.4,1.4L6.4,18H16c3.3,0,6-2.7,6-6V9h2v3c0,4.4-3.6,8-8,8H6.4l2.3,2.3L7.3,23.7z M2,15H0v-3 c0-4.4,3.6-8,8-8h9.6l-2.3-2.3l1.4-1.4L21.4,5l-4.7,4.7l-1.4-1.4L17.6,6H8c-3.3,0-6,2.7-6,6V15z"/> </g> </g>
            </svg>
            Синх. Кол-во
        </a>
        <script>
            $(document).ready(function () {
                console.log($.cookie("template_theme"));
                if ($.cookie("template_theme") != undefined) {

                }
            });
            $('select.choosing_template_theme').on('change', function () {
                console.log(this.value);
                $.cookie("template_theme", this.value);
                location.reload();
            });
            $('#button_hide_fields').on('click', function () {
                $(this).css('opacity', '0.1');
                $.cookie("show_all_fields", '0');
                const url = new URL(document.location);
                const searchParams = url.searchParams;
                searchParams.delete("action");
                window.history.pushState({}, '', url.toString());
                //console.log(url);
                location.reload();
            });
            $('#button_show_fields').on('click', function () {
                $(this).css('opacity', '0.1');
                $.cookie("show_all_fields", '1');
                const url = new URL(document.location);
                const searchParams = url.searchParams;
                searchParams.delete("action"); // удалить параметр "test"
                window.history.pushState({}, '', url.toString());
                //console.log(url);
                location.reload();
            });
        </script>
    </div>
</div>