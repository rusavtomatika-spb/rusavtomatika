<?php
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
$rows = CoreApplication::get_rows_from_table( "`catalog_sections`", "", "active='1'", "position ASC" );
global $H1, $TITLE, $DESCRIPTION;
$TITLE = "Каталог оборудования";
$DESCRIPTION = "Каталог оборудования - панели оператора, промышленные компьютеры: панельные и встраиваемые, промышленные мониторы, контроллеры (PLC), модули ввода-вывода, блоки питания";
$H1 = "Поставка оборудования для автоматизации";
if ( isset( $H1 )and $H1 != "" ) {
  ?>
<h1 class="title">
  <?=$H1?>
</h1>
<?php
}
?>
  <?php
  if ( count( $rows ) > 0 ) {
    ?>


  <div class="fixed-grid has-5-cols has-2-cols-mobile has-3-cols-tablet has-4-cols-desktop has-5-cols-widescreen has-5-cols-fullhd">
    <div class="grid">
      <?
      foreach ( $rows as $row ) {
        if ( isset( $row[ 'category_link' ] )and $row[ 'category_link' ] != '' ) {
          $link = $row[ 'category_link' ];
        } elseif ( isset( $row[ 'category_link_brand' ] )and $row[ 'category_link_brand' ] != '' ) {
          $link = $row[ 'category_link_brand' ];
        } else {
          $link = "/catalog/{$row['code']}/";
        }
        ?>
      <div class="cell">
        <div class="card" style="height: 100%">
          <div class="card-image" style="border-radius: 0.25rem !important;border-bottom-right-radius: 0 !important;border-bottom-left-radius: 0 !important;"><a href="<?= $link?>" target="_art">
            <figure class="image is-square"><img
        src="<?= $row["preview_picture"]?>"
        alt="<? echo htmlspecialchars($row["name"]);?>"/> </figure></a>
          </div>
          <div class="card-content">
            <div class="media-content">
              <p class="title is-4 is-size-6 mb-2 has-text-centered"><a class="nodecor" href="<?= $link?>" target="_art">
                <?= $row["name"]?>
                </a></p>
            </div>
          </div>
        </div>
      </div>
      <?}?>
    </div>
  </div>

<?php
}
