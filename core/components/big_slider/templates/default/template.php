<?
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/cycle.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/jquery.cycle2.js");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/jquery.cycle2.carousel.js");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/jquery.cycle2.tile.js");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/jquery.cycle2.swipe.min.js");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/ios6fix.js");

$arItems = [
    0 => [
        'url' => '#',
        'image' => '/include/main_page/images/main-slider/1.webp',
        'name' => 'Панель оператора Weintek MT8092XE',
        'description' => 'Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, eWON, Yottacontrol.',
    ],
    1 => [
        'url' => '#',
        'image' => '/include/main_page/images/main-slider/2.webp',
        'name' => 'Панель оператора Weintek cMT1106X',
        'description' => 'Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, eWON, Yottacontrol.',
    ],
    2 => [
        'url' => '#',
        'image' => '/include/main_page/images/main-slider/3.webp',
        'name' => 'Панель оператора Weintek cMT2108X2',
        'description' => 'Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, eWON, Yottacontrol.',
    ],
    3 => [
        'url' => '#',
        'image' => '/include/main_page/images/main-slider/4.webp',
        'name' => 'Панельный компьютер Aplex AEx-821P',
        'description' => 'Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, eWON, Yottacontrol.',
    ],
    4 => [
        'url' => '#',
        'image' => '/include/main_page/images/main-slider/5.webp',
        'name' => 'Панельные компьютеры для пищевых производств Aplex APC',
        'description' => 'Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, eWON, Yottacontrol.',
    ],
    5 => [
        'url' => '#',
        'image' => '/include/main_page/images/main-slider/6.webp',
        'name' => 'Панельные компьютеры Aplex ViTAM-9XXA для эксплуатации в экстремальных условиях',
        'description' => 'Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, eWON, Yottacontrol.',
    ],
];


?>
<div style="max-height: 490px;overflow: hidden">
    <div class="cycle-slideshow gallery"
         data-cycle-fx="tileBlind"
         data-cycle-tile-vertical=false
         data-cycle-timeout=7000
         data-cycle-slides="> a"
         data-cycle-pager="#pager"
         data-cycle-swipe="true"
         data-cycle-swipe-fx="flipHorz"
         data-cycle-log="false"
    >
        <?
        foreach ($arItems as $item){
            include "template_item.php";
        }
        ?>

        <div class="center cycle-pager cycle_pager_in_box" id="pager"></div>
        <div id="progress"></div>
    </div>

</div>
<script>
    var progress = $('#progress'),
        slideshow = $( '.cycle-slideshow' );

    slideshow.on( 'cycle-initialized cycle-before', function( e, opts ) {
        progress.stop(true).css( 'width', 0 );
    });

    slideshow.on( 'cycle-initialized cycle-after', function( e, opts ) {
        if ( ! slideshow.is('.cycle-paused') )
            progress.animate({ width: '100%' }, opts.timeout, 'linear' );
    });

    slideshow.on( 'cycle-paused', function( e, opts ) {
        progress.stop();
    });

    slideshow.on( 'cycle-resumed', function( e, opts, timeoutRemaining ) {
        progress.animate({ width: '100%' }, timeoutRemaining, 'linear' );
    });
</script>
