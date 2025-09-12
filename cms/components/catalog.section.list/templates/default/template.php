<?
if (!defined('cms'))
    exit;

global $APPLICATION;
?>

<div class="blockofcols_container">
    <div class="blockofcols_row">
        <div class="col-12">
            <?
            if ($arguments["titles"]["catalog_sections_list_H1"]) {
                ?>
                <h1><?= $arguments["titles"]["catalog_sections_list_H1"] ?></h1>
            <? } ?>
        </div>
        <div class="col-12">
            <img style="display: block;margin: 10px auto 20px;" src="/images/haiwell/banner.jpg" alt="Программируемые логические контроллеры ПЛК PLC Haiwell"/>
        </div>
        <? /* ?><div class="col-3">
          <h2>Выбор серии</h2>
          <div class="block_catalog_catalog_section_list_default">
          <?
          //var_dump($arguments);
          foreach ($arResult["sections"] as $row) {
          ?>
          <div class="block_catalog_catalog_section_list_default__item">
          <a class="link_show_section" href="/plc/haiwell/<?= $row["code"] ?>/"><?= $row["name"] ?></a>
          </div>
          <?
          }
          ?>
          </div>
          </div>
          <? */ ?>

        <div class="col-3 column_block_specifications">
            <div class="block_floating">
                <h2>Выбор спецификации</h2>
                <div class="block_specifications">
                    <h3>ПЛК</h3>
                    <div class="block_specifications_link" data-rel="8_8_relay" >8DI, 8DO (реле)</div>
                    <div class="block_specifications_link" data-rel="8_8_transistor-npn">8DI, 8DO (транзистор NPN)</div>
                    <div class="block_specifications_link" data-rel="8_8_transistor-pnp">8DI, 8DO (транзистор PNP)</div>
                    <div class="block_specifications_link" data-rel="12_12_relay">12DI, 12DO (реле)</div>
                    <div class="block_specifications_link" data-rel="12_12_transistor-npn">12DI, 12DO (транзистор NPN)</div>
                    <div class="block_specifications_link" data-rel="12_12_transistor-pnp">12DI, 12DO (транзистор PNP)</div>
                    <div class="block_specifications_link" data-rel="16_16_relay">16DI, 16DO (реле)</div>
                    <div class="block_specifications_link" data-rel="16_16_transistor-npn">16DI, 16DO (транзистор NPN)</div>
                    <div class="block_specifications_link" data-rel="16_16_transistor-pnp">16DI, 16DO (транзистор PNP)</div>
                    <div class="block_specifications_link" data-rel="20_20_relay">20DI, 20DO (реле)</div>
                    <div class="block_specifications_link" data-rel="20_20_transistor-npn">20DI, 20DO (транзистор NPN)</div>
                    <div class="block_specifications_link" data-rel="20_20_transistor-pnp">20DI, 20DO (транзистор PNP)</div>
                    <div class="block_specifications_link" data-rel="36_24_relay">36DI, 24DO (реле)</div>
                    <div class="block_specifications_link" data-rel="36_24_transistor-npn">36DI, 24DO (транзистор NPN)</div>
                    <div class="block_specifications_link" data-rel="36_24_transistor-pnp">36DI, 24DO (транзистор PNP)</div>
                    <h3>Модули расширения</h3>
                    <div class="block_specifications_link"
                         data-rel="_b4_b--datchika-ds18b20--1wire-datchik-temperaturyi--ds1990-elektronnyiy-klyuch-ibutton-sht1x--datchik-temperaturyi-i-vlajnosti-">4 входа датчика температуры DS18B20, DS1990 или датчики SHT1x, SHT7x температуры и влажности</div>
                    <div class="block_specifications_link" data-rel="_b32_b-vhoda-datchikov-temperaturyi-ds18b20-ds1990">32 входа датчиков температуры DS18B20, DS1990</div>
                    <div class="block_specifications_link" data-rel="4_termosoprotivleniya">4 термосопротивления</div>
                    <div class="block_specifications_link" data-rel="4_termoparyi">4 термопары</div>
                    <div class="block_specifications_link" data-rel="8_termosoprotivleniy">8 термосопротивлений</div>
                    <div class="block_specifications_link" data-rel="8_termopar">8 термопар</div>

                    <div class="block_specifications_link" data-rel="8_">8AI</div>
                    <div class="block_specifications_link" data-rel="_8">8AO</div>
                    <div class="block_specifications_link" data-rel="4_4">4AI, 4AO</div>

                    <div class="block_specifications_link" data-rel="12_">24DI</div>
                    <div class="block_specifications_link" data-rel="12_12">12DI, 12DO</div>
                    <div class="block_specifications_link" data-rel="40_">40DI</div>
                    <div class="block_specifications_link" data-rel="_36_relay">36DO (реле)</div>
                    <div class="block_specifications_link" data-rel="_36_transistor-npn">36DO (транзистор NPN)</div>
                    <div class="block_specifications_link" data-rel="_36_transistor-pnp">36DO (транзистор PNP)</div>
                    <div class="block_specifications_link" data-rel="20_20_relay">20DI, 20DO (реле)</div>
                    <div class="block_specifications_link" data-rel="20_20_transistor-npn">20DI, 20DO (транзистор NPN)</div>
                    <div class="block_specifications_link" data-rel="20_20_transistor-pnp">20DI, 20DO (транзистор PNP)</div>
                    <div class="block_specifications_link" data-rel="32_32_relay">32DI, 32DO (реле)</div>
                    <div class="block_specifications_link" data-rel="32_32_transistor-npn">32DI, 32DO (транзистор NPN)</div>
                    <div class="block_specifications_link" data-rel="32_32_transistor-pnp">32DI, 32DO (транзистор PNP)</div>
                </div>
            </div>
        </div>
        <div class="col-9 column_block_equipment">
            <div class="block_haiwell_download">
                <a class="download_pdf" target="_blank"
                   href="http://rusavtomatika.com/upload_files/catalogs/haiwell/haiwell-plc-catalogue.pdf">
                    Скачать каталог продукции Haiwell [pdf, 8.6MB]
                </a>
                <a class="online_link" target="_blank"
                   href="/plc/haiwell-plc-programming-software/">
                    On-line руководство по приложению HaiwellHappy для программирования ПЛК (Eng)
                </a>
                <a class="download_chm" target="_blank"
                   href="http://rusavtomatika.com/upload_files/catalogs/haiwell/HaiwellHappy_en.rar">
                    Руководство по приложению HaiwellHappy для программирования ПЛК (Eng) [chm, 4.92MB]
                </a>
            </div>
            <h2 style="margin-bottom: 55px;">Оборудование</h2>
            <div class="block_catalog_catalog_section_default">
                <?
                foreach ($arResult["sections"] as $row) {
                    ?><div class="section">

                        <?
                        $filter = Array("section_code" => $row["code"]); //
                        $arguments2 = Array("filter" => $filter, "SEF" => $arguments["SEF"], "section_code" => $row["code"], "section_name" => $row["name"], "path_to_images" => $arguments["path_to_images"]);
                        $APPLICATION->IncludeComponent("catalog.section", "default", $arguments2);
                        ?></div><?
                }
                ?>
            </div>
            <div class="blockofcols_row">
                <div class="col-12">
                    <br>
                    <h1>ПЛК (PLC) Haiwell</h1>
                    <p> Контроллеры (ПЛК) Haiwell - это универсальные, высокопроизводительные ПЛК ( PLC ), которые идеально подходят для использования в составе оборудования в таких отраслях промышленности, как:
                        упаковочная, текстильная, пищевая, медицинская, деревообрабатывающая, в вентиляции и кондиционировании, в котельных, бойлерах, нагревательном оборудовании, металлообрабатывающей, в солнечных электростанциях и т.д.
                    </p>
                    <ul class="ul_style1">
                        <li> Промышленные контроллеры (ПЛК) Haiwell программируются с помощью бесплатного
                            <a target="_blank" href="http://www.rusavtomatika.com/upload_files/soft/haiwell/haiwellhappy-setup.rar">ПО HaiwellHappy</a>, которое выполнено в соответствии со стандартом IEC 61131-3.</li>
                        <li><a target="_blank" href="http://www.rusavtomatika.com/upload_files/soft/haiwell/haiwellhappy-setup.rar">HaiwellHappy</a> поддерживает программирование блоков на 3х языках программирования - LD(LAdder diagram), FBD (Function Block Diagram) и IL ( Instruction List).</li>
                    </ul>
                    <strong>Важнейшими особенностями ПКЛ Haiwell и ПО HaiwellHappy являются:</strong>
                    <ul class="ul_style1">
                        <li> Каждый ПЛК оснащен интерфейсами 1xEthernet, 1xRS485, 1xRS232, программирование и отладка ПЛК осуществляется через Ethernet, для каждого интерфейса независимо поддерживаются протоколы Modbus TCP, Modbus RTU HaiwellBus, очень просто организовывать обмен данными между разными интерфейсами.</li>
                        <li>Продвинутые функции ПИД регулятора позволяют реализовать любой тип регулятора - ПИД, ПИ, с возможностью авто настройки, Fuzzy Logic, контроль клапанов, при этом одновременно могут работать 64 независимых регулятора.</li>
                        <li>В сочетании с возможностью подключения термосопротивлений : PT100, PT1000, Cu50, Cu100, термопар S, K, T, E, J, B, N, R, и аналоговых сигналов 4-20 мА, 0-20 мА, 1-5 В, 0-5 В, 0-10 В, -10~ 10 В, это делает возможным применение контроллеров Haiwell в качестве универсального регулятора в любой отрасли промышленности.</li>
                        <li>Высокоскоростные (200 кГц )входы и выходы позволяют организовывать быстрые счетные входы, подключать до 16 энкодеров, управлять до 16 сервомоторами с помощью быстрых импульсных выходов, функции Motion Control - 2х канальная линейная интерполяция, круговая интерполяция, абсолютное позиционирование, относительное позиционирование, компенсация люфта, позволяют использовать ПЛК Haiwell для позиционирования, точной синхронизации движения, итд, например, в текстильном, упаковочном, флексографическом оборудовании, в этикетировщиках, в плоттерах, 3Д принтерах, и т.д.</li>
                        <li>ПЛК Haiwell поддерживает 8 каналов прерываний, которые кожно привязать на фронт или спад сигнала на дискретном входе, все дискретные входы поддерживают настраиваемые фильтры, всего имеется 52 прерывания.<br/>
                            Аналоговые входы и выходы поддерживают инженерные преобразования данных.
                        </li>
                        <li>Три уровня парольной защиты ( защита проекта, защита блока, защита регистров ПЛК, ) защита от загрузки проекта.</li>
                        <li>Возможность создания исполняемого файла из проекта, этот файл можно отправлять клиенту для обновления проекта в ПЛК, при этом клиент не видит содержимого проекта.</li>
                        <li>Продвинутый полный симулятор ПЛК позволяет полностью отладить проект для контроллера без физического подключения контроллера.</li>
                        <li>Удобные функции мониторинга переменных ПЛК, любая переменная может отображаться в шестнадцатеричном, восьмеричном, двоичном, десятичном виде, с плавающей запятой, в символьном виде.</li>
                        <li>Есть окно ресурсов PLC, системных регистров PLC, отлично структурированная справочная система, где можно найти всю информацию по программированию и аппаратной части ПЛК.
                            <br>Скачать:&nbsp;<a class="download_chm" target="_blank"
                                                 href="http://rusavtomatika.com/upload_files/catalogs/haiwell/HaiwellHappy_en.rar">Руководство по приложению HaiwellHappy для программирования ПЛК (Eng) [chm, 4.92MB]</a>
                        </li>
                        <li>Комментарии к каждому проекту, функциональному блоку или компоненту, в том числе и на русском языке.</li>
                    </ul>
                    <? /* ?>

                      <br>
                      <h2>ПЛК (PLC) Haiwell</h2>
                      <p>Haiwell PLC-это универсальный высокопроизводительный программируемый логический контроллер,
                      который широко используется при производстве пластмасс, упаковочной, текстильной, пищевой, медицинской, фармацевтической,
                      экологической, муниципальной, полиграфической продукциии, а также при производстве строительных материалов, лифтов,
                      систем кондиционирования, цифрового управления станками и во многих других системах контроля и управления оборудованием.</p>
                      <p>Контроллеры, имеют как свои собственные периферийные интерфейсы (цифровой вход, цифровой выход, аналоговый вход,
                      аналоговый выход, высокоскоростной счетчик, высокоскоростные каналы выходных импульсов, электропитания, портов связи и т. д.),
                      так и могут быть расширены с помощью различных модулей расширения. </p>
                      <p>Компания Haiwell имеет полные права на свою интеллектуальную собственность, программные продукты и производимое оборудование.</p>
                      <p>Все продукты могут быть настроены в соответствии с требованиями заказчика для удовлетворения потребностей различных отраслей промышленности.</p>
                      <ul class="ul_style1">
                      <li><b>Гарантия качества:</b> в соответствии со стандартом IEC-61131 международного стандарта разработки</li>
                      <li>
                      <b>Радикальная инновация:</b> первый встроенный симулятор программного обеспечения. Прост в освоении и использовании
                      </li>
                      <li>
                      <b>Дистанционное управление:</b> Поддержка облачной платформы Haiwell. Можно использовать Haiwell облако для удаленного программирования ПЛК Haiwell
                      </li>
                      <li>
                      <b>Локальные сети:</b> поддержка порта Ethernet и пяти RS232/RS485 портов работающих одновременно; поддержка типа сети N:N
                      </li>
                      <li>
                      <b>Функции связи:</b> поддержка Modbus TCP, Haiwellbus TCP, Modbus RTU/ASCII, высокоскоростного протокола Haiwellbus и свободного протокола
                      </li>
                      <li>
                      <b>Контроль движения:</b> поддержка линейной интерполяции, дуги интерполяции (ARC), оригинальной точки возврата,
                      компенсации люфта, переопределение электрической исходной точки
                      </li>
                      <li>
                      <b>Распределенный ввод-вывод:</b> модули расширения с портом Ethernet и портом RS458, может быть установленны удаленно
                      </li>
                      </ul><? */ ?>
                </div>
                <? /* ?>                <div class="col-6"><br>
                  <h2>ПЛК (PLC) Haiwell</h2>
                  <p>Haiwell PLC is a versatile high-performance programmable logic controller, which is widely used in plastics, packaging, textiles, food, medical, pharmaceutical, environmental, municipal, printing, building materials, elevators, central air conditioning, numerical control machine tools and other fields of systems and control equipment. </p>
                  <p>In addition to its own various peripheral interfaces (digital input, digital output, analog input, analog output, high-speed counter, high-speed pulse output channels, power supply, communication ports, etc.), it is also expandable with all types of expansion modules for felixable configuration. </p>
                  <p>Haiwell company owns the 100% independent intellectual property rights over both its hardware and software products. </p>
                  <p>All products can be customized according to customer’s requirements to meet the different needs of various industries.</p>
                  <ul class="ul_style1">
                  <li>Quality Guarantee: In accordance with IEC-61131 international standard develop
                  </li>
                  <li>Radical innovation: : First one built-in 100% simulator programming software, easy to study and easy to use
                  </li>
                  <li>Remote control: Support Haiwell cloud platform, can use Haiwell cloud to do remote programming for Haiwell PLC
                  </li>
                  <li>Ethernet +: Support Ethernet port and 5 other RS232/RS485 communication ports working simultaniously, support N:N
                  network type
                  </li>
                  <li>Communication Function: Support Modbus TCP, Haiwellbus TCP, Modbus RTU/ASCII, Haiwellbus high speed protocol,
                  freedom protocol
                  </li>
                  <li>Motion Control: Support linear interpolation, ARC interpolation, original point return, backlash compensation, electric
                  original point redefine
                  </li>
                  <li>Distributed IO: Expansion modules with Ethernet port and RS458 port, can be remote IO unit by distributed installation
                  </li>
                  </ul>
                  </div>
                  <? */ ?>
            </div>

        </div>
        <div class="col-12">


        </div>

    </div>
</div>
