<?php
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css?" . rand());
//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
?>
<div class="blockofcols_container">
    <div class="tabs__guide  vertical">
        <div class="tabs__guide__content  active">
            <h2>Для чего нужен CODESYS?</h2>
            <p>
                Автоматизированные системы на промышленных объектах используют различные датчики, которые собирают
                информацию,
                например о температуре, давлении, движении. Данные с датчиков собирают устройства ввода/вывода и
                далее передают их в ПЛК (Программируемый Логический Контроллер) где контроллер решает, что с этими
                данными делать.
            </p>
            <p>CODESYS это интегрированная среда разработки (IDE) приложений для программируемых контроллеров. CoDeSys
                поддерживает все 5 языков программирования стандарта МЭК 61131-3 (LD, FBD, IL, ST, SFC) и включает
                дополнительный язык CFC (расширение FBD со свободным порядком выполнения блоков).</p>

            <p>В панели оператора Weintek серий cMT и cMTx (модели указаны ниже) интегрирован функционал ПЛК. Вы можете использовать
                панель оператора в роли ПЛК.</p>

            <p style="text-align: center"><a class="img__easyaccess"
                                             href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys1.png"
                                             data-fancybox="gallery0"><img style="max-width: 800px;"
                                                                           src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys1.png"></a>
            </p>

            <h2>Как это работает?</h2>
            <p>Панели оператора имеют встроенный контроллер, программируемый в соответствии со
                стандартом IEC 61131-3 средой разработки CODESYS v3.5.</p>
            <p>В панелях установлен двухъядерный процессор, каждое ядро работает независимо друг от друга и без
                взаимного влияния.
                Первое ядро отвечает за коммуникацию, визуализацию данных и интерфейс оператора, который вы
                разрабатываете в
                программе EasyBuilder Pro. Второе ядро управляет логикой контроллера, которую вы разрабатываете уже в
                программе CODESYS.</p>

            <p style="text-align: center"><a class="img__easyaccess"
                                             href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys3.png"
                                             data-fancybox="gallery0"><img style="max-width: 800px;"
                                                                           src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys3.png"></a>
            </p>

        </div>
        <div class="tabs__guide__content">
            <h2>Активация Codesys Runtime</h2>

            <p>На панели оператора войдите в системные настройки. Кнопка входа находится в левом верхнем углу</p>
            <p style="text-align: center"><a class="img__easyaccess"
                                             href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys4.png"
                                             data-fancybox="gallery1"><img
                            src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys4.png"></a></p>
            <p>1. Введите пароль для системных настроек. Пароль по умолчанию: 111111<br>
                2. Перейдите во вкладку Codesys <br>
                3. Введите код с задней стороны карточки активации Codesys
            </p>

            <div class="blockofcols_row">
                <div class="col-6">
                    <p style="text-align: center"><a class="img__easyaccess"
                                                     href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys5.png"
                                                     data-fancybox="gallery1"><img
                                    src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys5.png"></a></p>
                </div>
                <div class="col-6">
                    <p style="text-align: center"><a class="img__easyaccess"
                                                     href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys6.png"
                                                     data-fancybox="gallery1"><img
                                    src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys6.png"></a></p>
                </div>
            </div>

            <p>После активации у вас появляется полноценный ПЛК, к которому вы можете подключить новые модули
                ввода-вывода от компании Weintek, данные коммуникационные устройства поддерживают шины CAN bus или
                Modbus TCP, а также любые другие устройства поддерживающие эти два протокола.</p>

        </div>

    </div>


    <section>

        <p>Ссылки, которые упоминаются в видео:</p>
        <ul class="spisok">
            <li>Спецификация CODESYS <a href="/documents/weintek/cMT/eng/Datasheet/cMT_CODESYS_Datasheet_ENG_20250310.pdf">ссылка</a></li>
            <li>Брошюра CODESYS <a href="/documents/weintek/cMT/eng/Brochure/Codesys_Brochure_ENG_20250915.pdf">ссылка</a></li>
            <li>Актуальная версия среды разработки CODESYS <a href="/soft/codesys/CODESYS_64_3.5.15.50.zip">64 bit</a>, <a href="/soft/codesys/CODESYS_3.5.15.50.zip">32 bit</a></li>
            <li><a
                        href="/documents/weintek/Document/UM0/EasyRemoteIO-UserManual-eng.pdf">Руководство пользователя CODESYS</a></li>
            <li><a
                        href="https://www.rusavtomatika.com/download/#EasyRemote">Раздел для скачивания актуальных файлов</a></li>
            <li><a
                        href="/soft/iR/EasyRemoteIO/EasyRemoteIO-1.5.11.0.zip">Приложение EasyRemoteIO для настройки IP-адреса каплера Weintek </a></li>

        </ul>

    </section>
<?include "inc_codesys_suitable_models.php"?>