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
            <li><a href="/admin/products_all/">Список элементов</a></li>
            <li class="separator"></li>
            <!--<li><a href="/admin/products_all/add_element.php">+ элемент</a></li>>
            <li><a href="/admin/">Главная</a></li>
            <li class="separator"></li-->
            <li><a target="_blank" href="/">На сайт</a></li>
            <li class="separator"></li>
            <li><a href="/admin/products_all/mini.php">Мини-список</a></li>
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
        <select class="choosing_template_theme" name="template_theme">
            <option value="0" <?if($selected_theme_option == 0) echo 'selected'?>>Тема КРУПНАЯ</option>
            <option value="1" <?if($selected_theme_option == 1) echo 'selected'?>>Тема МЕЛКАЯ</option>
        </select>
        <div class="menu-points-wrapper">
            Поля:
            <div>
                <button id="button_hide_fields" class="<?if($selected_show_all_fields == 0) echo 'active'?>">Скрыть</button>
                <button id="button_show_fields" class="<?if($selected_show_all_fields == 1) echo 'active'?>">Показать</button>
            </div>
            <a href="/admin/add_element.php" class="add__element-link">Добавить элемент</a>
        </div>
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

<style>
.admin-menu-wrapper {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: flex-start;
    gap: 10px;
}
.menu-points-wrapper {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: flex-start;
    width: 100%;
}
.menu-points-wrapper div {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    width: 100%;
    gap: 10px;
}
.add__element-link {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #34AB5E;
    font-size: 15px;
    color: #fff;
    padding: 10px 15px;
    margin-top: 10px;
    border-radius: 5px;
    text-decoration: none;
}
.menu_wrapper {
    margin-bottom: 50px;
}
</style>