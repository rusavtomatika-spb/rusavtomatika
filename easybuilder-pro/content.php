<div class="page_easybuilder"> <br>
  <div class="page_width_universal">
    <h1>Easybuilder Pro V6 - программное обеспечение для создания пользовательских проектов в операторских
      панелях Weintek
      (скачать EBPro, Изибилдер на русском)</h1>
  </div>
  <div class="page_width_universal">
    <div class="sub-menu"
             style="width: 100%;box-sizing:border-box;margin: 20px auto;padding: 10px 5px;background: #dff3df;">
      <ul id="table_of_contents" style="text-align: center;">
        <li><a href="#ebpro">Дистрибутивы и руководства <span>Easybuilder Pro</span></a></li>
        <li><a href="#eb8000">Дистрибутивы и руководства <span>EasyBuilder 8000</span></a></li>
      </ul>
    </div>
    <div class="has-background-light p-4 my-4"> <span class="page_easybuilder_title3">EasyBuilder Pro</span> &nbsp;&nbsp;&nbsp;
      серии <a href="/catalog/operator_panels/?&series=MT8000iE">MT8000iE</a>, <a href="/catalog/operator_panels/?&series=eMT3000">eMT3000</a>, <a href="/catalog/operator_panels/?&series=MT8000XE">MT8000XE</a>, <a href="/catalog/operator_panels/?&series=cMT">cMT</a>, <a href="/weintek/mTV-100/">mTV</a> </div>
    <div class="columns is-multiline">
      <div class="column is-9-desktop is-12-tablet">
        <h3 id="ebpro">Дистрибутивы Easybuilder Pro</h3>
        <br>
        <div class="folded-table-wrapper">
          <table class="table is-bordered is-striped is-fullwidth">
            <th>Дата</th>
              <th>Файл</th>
              <th>Размер</th>
              <th style="text-align: left">Список изменений (Release notes)</th>
              <?
              ///////////////////////////// это из csv
              foreach ( $arrArchive_ebpro_setup as $item ) {
          $ver0 = preg_match( '/\d{8}/', $item[0], $matches );
          $ver0 = $matches[ 0 ];
          $ver0 = str_split( $ver0 );
          $ver = $ver0[ 0 ] . '.' . $ver0[ 1 ] . $ver0[ 2 ] . '.' . $ver0[ 3 ] . $ver0[ 4 ] . '.' . $ver0[ 5 ] . $ver0[ 6 ] . $ver0[ 7 ];
                ?>
            <tr>
              <td><? if (isset($item[4]) and $item[4] != '') echo $item[4]; ?></td>
              <td><a target="_blank" title="Скачать файл" href="<?= $item[2] ?>">
                Версия <?= $ver ?>
                </a></td>
              <td><?= $item[1] ?>
                МБ</td>
              <td style="text-align: left"><?
              if ( $item[ 3 ] != "" ) {
                ?>
                <a target="_blank" title="Скачать Release notes к EasyBuilder Pro" href="https://www.rusavtomatika.com/upload_files/soft/EBPro/release_notes/<?= $item[3] ?>">
                Release notes
                </a>
                <?
                }
                ?></td>
            </tr>
            <?
            }
              ?>
          </table>
          <div class="button-open-table"></div>
          <script>
                        (function () {
                            $(".button-open-table").click(function () {
                                $(this).parent(".folded-table-wrapper").toggleClass('opened');
                            });
                        })();
                    </script> 
        </div>
      </div>
      <div class="column is-3-desktop is-12-tablet">
        <div class="block_padding">
          <h3>Руководства по Easybuilder Pro</h3>
          <p><a class="download_linkext_online" href="/weintek-easybuilderpro-user-manual-en/">On-line
            руководство пользователя<br>
            Weintek EasyBuilder Pro (Eng) </a></p>
          <p><a class="download_linkext_online" href="/weintek-easybuilder-instrukciya-na-russkom/">On-line
            руководство пользователя <b>на русском языке</b><br>
            EasyBuilder Pro (Rus) </a></p>
          <p><a class="download_pdf" href='/manuals/EBPro/EasyBuilderPro_UserManual_eng.pdf'>Руководство для
            EasyBuilder Pro <? echo file_get_contents('https://www.rusavtomatika.com/upload_files/soft/EBPro/Installer/version.txt'); ?> (Eng)</a></p>
          <p> <a class="link_video_page" href='/video/'>Видео канал на русском о программировании панелей
            Weintek в EasyBuilder Pro</a> </p>
        </div>
      </div>
      <div class="column is-full">
        <div class="block_padding">
          <h3>Что такое EasyBuilder Pro?</h3>
          <p> У операторских панелей Weintek есть огромное преимущество перед конкурентами - это <b>среда
            разработки EasyBuilder Pro</b>. </p>
          <p>Программный комплекс состоит из мощного визуального редактора проектов и набора утилит,
            решающих различные задачи.</p>
          <h4>Назначение:</h4>
          <p> При разработке проекта пользователь организует взаимодействие панели оператора с
            периферийными устройствами, например с ПЛК, температурными контроллерами, сканерами
            штрихкодов,
            серво-инверторами и многими другуми (более 300 видов). При этом могут
            использоваться различные протоколы связи: Ethernet/IP, Modbus TCP, MQTT. </p>
          <h4>Визуализация процессов:</h4>
          <p>Для визуализации процессов на экране EasyBuilder Pro имеет большое количество встроенных
            библиотек с изображениями множества элементов автоматизируемой системы.</p>
          <h4>Совместимость с предыдущими версиями:</h4>
          <p>EasyBuilder Pro обладает 100% обратной совместимостью, то есть — проекты, созданные в
            предыдущей версии EasyBuilder 8000, могут быть легко сконвертированы в EasyBuilder Pro, при
            замене устаревших операторских панелей на новые.</p>
          <h4>Особенности использования:</h4>
          <ul class="ul_style1">
            <li>Использование ПО EasyBuilder Pro <b>полностью бесплатно</b>, вы можете скачивать EBPro
              (Изибилдер, ) и пользоваться
              им без каких-либо ограничений. </li>
            <li>Easybuilder Pro полностью русифицирован. Выбор английского или русского языка происходит
              при установке программы. </li>
            <li>Драйвера USB для подключения панелей к ПК устанавливаются автоматически при
              установке EasyBuilder Pro. </li>
            <li><b>В состав пакета EasyBuilder Pro входят утилиты:</b> Administrator Tools, cMT Viewer,
              EasyAccess, EasyConverter, EasyDiagnoser, EasyPrinter, EasySimulator, EasySystemSetting,
              EasyWatch, RecipeEditor, Utility Manager. </li>
          </ul>
        </div>
      </div>
      <div class="column is-12"> </div>
      <div class="column is-12">
        <div class="p-4 has-background-light"> <span class="page_easybuilder_title3">EasyBuilder 8000 для панелей серий MT6000i и MT8000i</span> </div>
      </div>
      <div class="col-12">
        <div class="block_padding">
          <h3 id="eb8000">Дистрибутивы и руководства по Easybuilder 8000</h3>
          <br>
          <table class="table is-bordered is-full is-striped">
            <tbody>
              <tr>
                <th>Наименование</th>
                <th>Файл</th>
                <th>Дата</th>
                <th>Размер</th>
              </tr>
              <tr>
                <td>Дистрибутив EasyBuilder 8000 4.66.02.016 (рус)
                  для серий MT6000i, MT8000i, кроме MT8104XH, MT8150X, MT8121X </td>
                <td style="text-align: left"><a class="download_zip"
                                   title="Скачать Дистрибутив EasyBuilder 8000 4.66.02.016 (рус)" target="_blank"
                                   href="https://www.rusavtomatika.com/upload_files/soft/EB8000/EB8000_setup.zip"> EB8000_setup.zip</a></td>
                <td>21-12-2016</td>
                <td>122&nbsp;МБ</td>
              </tr>
              <tr>
                <td>Дистрибутив EasyBuilder 8000 4.65.12 (рус) для моделей MT8104XH, MT8150X, MT8121X </td>
                <td style="text-align: left"><a class="download_zip"
                                   title="Скачать Дистрибутив EasyBuilder 8000 4.66.02.016 (рус)" target="_blank"
                                   href="https://www.rusavtomatika.com/upload_files/soft/EB8000/EB8000V46512.zip"> EB8000V46512.zip</a></td>
                <td>03-04-2015</td>
                <td>101&nbsp;МБ</td>
              </tr>
              <tr>
                <td>Руководство по EasyBuilder 8000 V4.66.02 (eng) </td>
                <td style="text-align: left"><a class="download_pdf"
                                   href="https://www.rusavtomatika.com/upload_files/manuals/UserManualEB8000.pdf">UserManualEB8000.pdf</a></td>
                <td>08-02-2016</td>
                <td>18&nbsp;МБ</td>
              </tr>
            </tbody>
          </table>
          <p> EasyBuilder 8000 4.66.02.016 (рус) применяется для создания пользовательских проектов для
            операторских панелей Weintek серий: MT6000i иMT8000i, кроме панелей: <a href='/weintek/MT8104XH/'>MT8104XH</a>, <a href='/weintek/MT8150X/'>MT8150X</a>, <a href='/weintek/MT8121X/'>MT8121X</a>, для которых последний совместимый дистрибутив —
            4.65.12. </p>
          <p>Использование ПО EasyBuilder 8000 полностью бесплатно, вы можете скачивать ПО и пользоваться
            им без каких-либо ограничений.</p>
          <p>Драйвера USB для подключения панелей к ПК устанавливаются автоматически при установке
            EasyBuilder 8000.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
