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
            <img style="display: block;margin: 10px auto 20px;" src="/images/haiwell/banner.jpg" alt="��������������� ���������� ����������� ��� PLC Haiwell"/>
        </div>
        <? /* ?><div class="col-3">
          <h2>����� �����</h2>
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
                <h2>����� ������������</h2>
                <div class="block_specifications">
                    <h3>���</h3>
                    <div class="block_specifications_link" data-rel="8_8_relay" >8DI, 8DO (����)</div>
                    <div class="block_specifications_link" data-rel="8_8_transistor-npn">8DI, 8DO (���������� NPN)</div>
                    <div class="block_specifications_link" data-rel="8_8_transistor-pnp">8DI, 8DO (���������� PNP)</div>
                    <div class="block_specifications_link" data-rel="12_12_relay">12DI, 12DO (����)</div>
                    <div class="block_specifications_link" data-rel="12_12_transistor-npn">12DI, 12DO (���������� NPN)</div>
                    <div class="block_specifications_link" data-rel="12_12_transistor-pnp">12DI, 12DO (���������� PNP)</div>
                    <div class="block_specifications_link" data-rel="16_16_relay">16DI, 16DO (����)</div>
                    <div class="block_specifications_link" data-rel="16_16_transistor-npn">16DI, 16DO (���������� NPN)</div>
                    <div class="block_specifications_link" data-rel="16_16_transistor-pnp">16DI, 16DO (���������� PNP)</div>
                    <div class="block_specifications_link" data-rel="20_20_relay">20DI, 20DO (����)</div>
                    <div class="block_specifications_link" data-rel="20_20_transistor-npn">20DI, 20DO (���������� NPN)</div>
                    <div class="block_specifications_link" data-rel="20_20_transistor-pnp">20DI, 20DO (���������� PNP)</div>
                    <div class="block_specifications_link" data-rel="36_24_relay">36DI, 24DO (����)</div>
                    <div class="block_specifications_link" data-rel="36_24_transistor-npn">36DI, 24DO (���������� NPN)</div>
                    <div class="block_specifications_link" data-rel="36_24_transistor-pnp">36DI, 24DO (���������� PNP)</div>
                    <h3>������ ����������</h3>
                    <div class="block_specifications_link"
                         data-rel="_b4_b--datchika-ds18b20--1wire-datchik-temperaturyi--ds1990-elektronnyiy-klyuch-ibutton-sht1x--datchik-temperaturyi-i-vlajnosti-">4 ����� ������� ����������� DS18B20, DS1990 ��� ������� SHT1x, SHT7x ����������� � ���������</div>
                    <div class="block_specifications_link" data-rel="_b32_b-vhoda-datchikov-temperaturyi-ds18b20-ds1990">32 ����� �������� ����������� DS18B20, DS1990</div>
                    <div class="block_specifications_link" data-rel="4_termosoprotivleniya">4 ������������������</div>
                    <div class="block_specifications_link" data-rel="4_termoparyi">4 ���������</div>
                    <div class="block_specifications_link" data-rel="8_termosoprotivleniy">8 ������������������</div>
                    <div class="block_specifications_link" data-rel="8_termopar">8 ��������</div>

                    <div class="block_specifications_link" data-rel="8_">8AI</div>
                    <div class="block_specifications_link" data-rel="_8">8AO</div>
                    <div class="block_specifications_link" data-rel="4_4">4AI, 4AO</div>

                    <div class="block_specifications_link" data-rel="12_">24DI</div>
                    <div class="block_specifications_link" data-rel="12_12">12DI, 12DO</div>
                    <div class="block_specifications_link" data-rel="40_">40DI</div>
                    <div class="block_specifications_link" data-rel="_36_relay">36DO (����)</div>
                    <div class="block_specifications_link" data-rel="_36_transistor-npn">36DO (���������� NPN)</div>
                    <div class="block_specifications_link" data-rel="_36_transistor-pnp">36DO (���������� PNP)</div>
                    <div class="block_specifications_link" data-rel="20_20_relay">20DI, 20DO (����)</div>
                    <div class="block_specifications_link" data-rel="20_20_transistor-npn">20DI, 20DO (���������� NPN)</div>
                    <div class="block_specifications_link" data-rel="20_20_transistor-pnp">20DI, 20DO (���������� PNP)</div>
                    <div class="block_specifications_link" data-rel="32_32_relay">32DI, 32DO (����)</div>
                    <div class="block_specifications_link" data-rel="32_32_transistor-npn">32DI, 32DO (���������� NPN)</div>
                    <div class="block_specifications_link" data-rel="32_32_transistor-pnp">32DI, 32DO (���������� PNP)</div>
                </div>
            </div>
        </div>
        <div class="col-9 column_block_equipment">
            <div class="block_haiwell_download">
                <a class="download_pdf" target="_blank"
                   href="http://rusavtomatika.com/upload_files/catalogs/haiwell/haiwell-plc-catalogue.pdf">
                    ������� ������� ��������� Haiwell [pdf, 8.6MB]
                </a>
                <a class="online_link" target="_blank"
                   href="/plc/haiwell-plc-programming-software/">
                    On-line ����������� �� ���������� HaiwellHappy ��� ���������������� ��� (Eng)
                </a>
                <a class="download_chm" target="_blank"
                   href="http://rusavtomatika.com/upload_files/catalogs/haiwell/HaiwellHappy_en.rar">
                    ����������� �� ���������� HaiwellHappy ��� ���������������� ��� (Eng) [chm, 4.92MB]
                </a>
            </div>
            <h2 style="margin-bottom: 55px;">������������</h2>
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
                    <h1>��� (PLC) Haiwell</h1>
                    <p> ����������� (���) Haiwell - ��� �������������, ���������������������� ��� ( PLC ), ������� �������� �������� ��� ������������� � ������� ������������ � ����� �������� ��������������, ���:
                        �����������, �����������, �������, �����������, ��������������������, � ���������� � �����������������, � ���������, ��������, �������������� ������������, ���������������������, � ��������� ��������������� � �.�.
                    </p>
                    <ul class="ul_style1">
                        <li> ������������ ����������� (���) Haiwell ��������������� � ������� �����������
                            <a target="_blank" href="http://www.rusavtomatika.com/upload_files/soft/haiwell/haiwellhappy-setup.rar">�� HaiwellHappy</a>, ������� ��������� � ������������ �� ���������� IEC 61131-3.</li>
                        <li><a target="_blank" href="http://www.rusavtomatika.com/upload_files/soft/haiwell/haiwellhappy-setup.rar">HaiwellHappy</a> ������������ ���������������� ������ �� 3� ������ ���������������� - LD(LAdder diagram), FBD (Function Block Diagram) � IL ( Instruction List).</li>
                    </ul>
                    <strong>���������� ������������� ��� Haiwell � �� HaiwellHappy ��������:</strong>
                    <ul class="ul_style1">
                        <li> ������ ��� ������� ������������ 1xEthernet, 1xRS485, 1xRS232, ���������������� � ������� ��� �������������� ����� Ethernet, ��� ������� ���������� ���������� �������������� ��������� Modbus TCP, Modbus RTU HaiwellBus, ����� ������ �������������� ����� ������� ����� ������� ������������.</li>
                        <li>����������� ������� ��� ���������� ��������� ����������� ����� ��� ���������� - ���, ��, � ������������ ���� ���������, Fuzzy Logic, �������� ��������, ��� ���� ������������ ����� �������� 64 ����������� ����������.</li>
                        <li>� ��������� � ������������ ����������� ������������������ : PT100, PT1000, Cu50, Cu100, �������� S, K, T, E, J, B, N, R, � ���������� �������� 4-20 ��, 0-20 ��, 1-5 �, 0-5 �, 0-10 �, -10~ 10 �, ��� ������ ��������� ���������� ������������ Haiwell � �������� �������������� ���������� � ����� ������� ��������������.</li>
                        <li>���������������� (200 ��� )����� � ������ ��������� �������������� ������� ������� �����, ���������� �� 16 ���������, ��������� �� 16 ������������� � ������� ������� ���������� �������, ������� Motion Control - 2� ��������� �������� ������������, �������� ������������, ���������� ����������������, ������������� ����������������, ����������� �����, ��������� ������������ ��� Haiwell ��� ����������������, ������ ������������� ��������, ���, ��������, � �����������, �����������, ����������������� ������������, � ���������������, � ���������, 3� ���������, � �.�.</li>
                        <li>��� Haiwell ������������ 8 ������� ����������, ������� ����� ��������� �� ����� ��� ���� ������� �� ���������� �����, ��� ���������� ����� ������������ ������������� �������, ����� ������� 52 ����������.<br/>
                            ���������� ����� � ������ ������������ ���������� �������������� ������.
                        </li>
                        <li>��� ������ ��������� ������ ( ������ �������, ������ �����, ������ ��������� ���, ) ������ �� �������� �������.</li>
                        <li>����������� �������� ������������ ����� �� �������, ���� ���� ����� ���������� ������� ��� ���������� ������� � ���, ��� ���� ������ �� ����� ����������� �������.</li>
                        <li>����������� ������ ��������� ��� ��������� ��������� �������� ������ ��� ����������� ��� ����������� ����������� �����������.</li>
                        <li>������� ������� ����������� ���������� ���, ����� ���������� ����� ������������ � �����������������, ������������, ��������, ���������� ����, � ��������� �������, � ���������� ����.</li>
                        <li>���� ���� �������� PLC, ��������� ��������� PLC, ������� ����������������� ���������� �������, ��� ����� ����� ��� ���������� �� ���������������� � ���������� ����� ���.
                            <br>�������:&nbsp;<a class="download_chm" target="_blank"
                                                 href="http://rusavtomatika.com/upload_files/catalogs/haiwell/HaiwellHappy_en.rar">����������� �� ���������� HaiwellHappy ��� ���������������� ��� (Eng) [chm, 4.92MB]</a>
                        </li>
                        <li>����������� � ������� �������, ��������������� ����� ��� ����������, � ��� ����� � �� ������� �����.</li>
                    </ul>
                    <? /* ?>

                      <br>
                      <h2>��� (PLC) Haiwell</h2>
                      <p>Haiwell PLC-��� ������������� ���������������������� ��������������� ���������� ����������,
                      ������� ������ ������������ ��� ������������ ���������, �����������, �����������, �������, �����������, ����������������,
                      �������������, �������������, ��������������� ����������, � ����� ��� ������������ ������������ ����������, ������,
                      ������ �����������������, ��������� ���������� �������� � �� ������ ������ �������� �������� � ���������� �������������.</p>
                      <p>�����������, ����� ��� ���� ����������� ������������ ���������� (�������� ����, �������� �����, ���������� ����,
                      ���������� �����, ���������������� �������, ���������������� ������ �������� ���������, ��������������, ������ ����� � �. �.),
                      ��� � ����� ���� ��������� � ������� ��������� ������� ����������. </p>
                      <p>�������� Haiwell ����� ������ ����� �� ���� ���������������� �������������, ����������� �������� � ������������ ������������.</p>
                      <p>��� �������� ����� ���� ��������� � ������������ � ������������ ��������� ��� �������������� ������������ ��������� �������� ��������������.</p>
                      <ul class="ul_style1">
                      <li><b>�������� ��������:</b> � ������������ �� ���������� IEC-61131 �������������� ��������� ����������</li>
                      <li>
                      <b>����������� ���������:</b> ������ ���������� ��������� ������������ �����������. ����� � �������� � �������������
                      </li>
                      <li>
                      <b>������������� ����������:</b> ��������� �������� ��������� Haiwell. ����� ������������ Haiwell ������ ��� ���������� ���������������� ��� Haiwell
                      </li>
                      <li>
                      <b>��������� ����:</b> ��������� ����� Ethernet � ���� RS232/RS485 ������ ���������� ������������; ��������� ���� ���� N:N
                      </li>
                      <li>
                      <b>������� �����:</b> ��������� Modbus TCP, Haiwellbus TCP, Modbus RTU/ASCII, ����������������� ��������� Haiwellbus � ���������� ���������
                      </li>
                      <li>
                      <b>�������� ��������:</b> ��������� �������� ������������, ���� ������������ (ARC), ������������ ����� ��������,
                      ����������� �����, ��������������� ������������� �������� �����
                      </li>
                      <li>
                      <b>�������������� ����-�����:</b> ������ ���������� � ������ Ethernet � ������ RS458, ����� ���� ������������ ��������
                      </li>
                      </ul><? */ ?>
                </div>
                <? /* ?>                <div class="col-6"><br>
                  <h2>��� (PLC) Haiwell</h2>
                  <p>Haiwell PLC is a versatile high-performance programmable logic controller, which is widely used in plastics, packaging, textiles, food, medical, pharmaceutical, environmental, municipal, printing, building materials, elevators, central air conditioning, numerical control machine tools and other fields of systems and control equipment. </p>
                  <p>In addition to its own various peripheral interfaces (digital input, digital output, analog input, analog output, high-speed counter, high-speed pulse output channels, power supply, communication ports, etc.), it is also expandable with all types of expansion modules for felixable configuration. </p>
                  <p>Haiwell company owns the 100% independent intellectual property rights over both its hardware and software products. </p>
                  <p>All products can be customized according to customer�s requirements to meet the different needs of various industries.</p>
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
