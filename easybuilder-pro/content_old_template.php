<div class="page_easybuilder">
    <br>
    <div class="page_width_universal">
        <h1>Easybuilder Pro V6 - ����������� ����������� ��� �������� ���������������� �������� � ������������
            ������� Weintek
            (������� EBPro, ��������� �� �������)</h1>
    </div>
    <div class="page_width_universal">
        <div class="sub-menu"
             style="width: 100%;box-sizing:border-box;margin: 20px auto;padding: 10px 5px;background: #dff3df;">
            <ul id="table_of_contents" style="text-align: center;">
                <li><a href="#ebpro">������������ � ����������� <span>Easybuilder Pro</span></a></li>
                <li><a href="#eb8000">������������ � ����������� <span>EasyBuilder 8000</span></a></li>
            </ul>
        </div>
        <div class="blockofcols_container">
            <div class="blockofcols_row">
                <div class="col-12 background-gray">
                    <div class="block_padding">
                        <span class="page_easybuilder_title3">EasyBuilder Pro</span> &nbsp;&nbsp;&nbsp;
                        ����� <?= $serii ?>
                    </div>
                </div>
                <div class="col-8" style="margin-right: -15px;">
                    <div class="block_padding">
                        <h3 id="ebpro">������������ Easybuilder Pro</h3>
                        <br>
                        <?
                        if (is_array($arrArchive_ebpro_setup)) {
                        ?>
                        <div class="folded-table-wrapper">
                            <table class="table-style3" style="margin-right: -15px;">
                                <th>����</th>
                                <th>����</th>
                                <th>������</th>
                                <th style="text-align: left">������ ��������� (Release notes)</th>
                                <?
                                foreach ($arrArchive_ebpro_setup as $item) {
                                    ?>
                                    <tr>
                                        <td><? if (isset($item[4]) and $item[4] != '') echo $item[4]; ?></td>
                                        <td><a target="_blank" title="������� ����"
                                               href="<?= $item[2] ?>"><?= $item[0] ?></a></td>
                                        <td><?= $item[1] ?> ��</td>
                                        <td style="text-align: left">
                                            <?
                                            if ($item[3] != "") {
                                                ?><a target="_blank" title="������� ����"
                                                     href="http://www.rusavtomatika.com/upload_files/soft/EBPro/release_notes/<?= $item[3] ?>">Release notes</a><?
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?
                                }
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
                </div>
                <div class="col-4">
                    <div class="block_padding">
                        <h3>����������� �� Easybuilder Pro</h3><br>
                        <p><a class="download_linkext_online" href="/weintek-easybuilderpro-user-manual-en/">On-line
                                ����������� ������������<br>Weintek EasyBuilder Pro (Eng) </a></p>
                        <p><a class="download_linkext_online" href="/weintek-easybuilder-instrukciya-na-russkom/">On-line
                                ����������� ������������ <b>�� ������� �����</b><br>EasyBuilder Pro (Rus) </a></p>
                        <p><a class="download_pdf" href='<?= $GLOBALS["EBPro_manual_link"] ?>'>����������� ���
                                EasyBuilder Pro 6.03.02 (Eng)</a></p>
                        <p><a class="download_pdf" href='/upload_files/manuals/EBPro_Manual_All_In_One_5.07.01.pdf'>�����������
                                ��� ������ 5.07.01 (Eng) <span class="small_gray_text">[26-07-2017 23.08 ��]</span></a>
                        </p>
                        <p>
                            <a class="link_video_page" href='/video/'>����� ����� �� ������� � ���������������� �������
                                Weintek � EasyBuilder Pro</a>
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="block_padding">
                        <h3>��� ����� EasyBuilder Pro?</h3>
                        <p>
                            � ������������ ������� Weintek ���� �������� ������������ ����� ������������ - ��� <b>�����
                                ���������� EasyBuilder Pro</b>.
                        </p>
                        <p>����������� �������� ������� �� ������� ����������� ��������� �������� � ������ ������,
                            �������� ��������� ������.</p>
                        <h4>����������:</h4>
                        <p>
                            ��� ���������� ������� ������������ ���������� �������������� ������ ��������� �
                            ������������� ������������, �������� � ���, �������������� �������������, ���������
                            ����������,
                            �����-����������� � ������� ������� (����� 300 �����). ��� ���� �����
                            �������������� ��������� ��������� �����: Ethernet/IP, Modbus TCP, MQTT.
                        </p>
                        <h4>������������ ���������:</h4>
                        <p>��� ������������ ��������� �� ������ EasyBuilder Pro ����� ������� ���������� ����������
                            ��������� � ������������� ��������� ��������� ���������������� �������.</p>
                        <h4>������������� � ����������� ��������:</h4>
                        <p>EasyBuilder Pro �������� 100% �������� ��������������, �� ���� � �������, ��������� �
                            ���������� ������ EasyBuilder 8000, ����� ���� ����� ��������������� � EasyBuilder Pro, ���
                            ������ ���������� ������������ ������� �� �����.</p>
                        <h4>����������� �������������:</h4>
                        <ul class="ul_style1">
                            <li>������������� �� EasyBuilder Pro <b>��������� ���������</b>, �� ������ ��������� EBPro
                                (���������, ) � ������������
                                �� ��� �����-���� �����������.
                            </li>
                            <li>Easybuilder Pro ��������� �������������. ����� ����������� ��� �������� ����� ����������
                                ��� ��������� ���������.
                            </li>
                            <li>�������� USB ��� ����������� ������� � �� ��������������� ������������� ���
                                ��������� EasyBuilder Pro.
                            </li>
                            <li><b>� ������ ������ EasyBuilder Pro ������ �������:</b> Administrator Tools, cMT Viewer,
                                EasyAccess, EasyConverter, EasyDiagnoser, EasyPrinter, EasySimulator, EasySystemSetting,
                                EasyWatch, RecipeEditor, Utility Manager.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12"></div>
            </div>
            <div class="blockofcols_row"><br>
                <div class="col-12 background-gray">
                    <div class="block_padding">
                        <span class="page_easybuilder_title3">EasyBuilder 8000</span> &nbsp;&nbsp;&nbsp; ����� <a
                            href="/weintek/series_MT6000i.php">MT6000i</a>, <a
                            href="/weintek/series_MT8000i.php">MT8000i</a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="block_padding">
                        <h3 id="eb8000">������������ � ����������� �� Easybuilder 8000</h3><br>
                        <table class="table-style4" style="margin-right: -15px;margin-bottom: 10px;">
                            <tbody>
                            <tr>
                                <th>������������</th>
                                <th>����</th>
                                <th>����</th>
                                <th>������</th>
                            </tr>
                            <tr>
                                <td>����������� EasyBuilder 8000 4.66.02.016 (���)
                                    ��� ����� MT6000i, MT8000i, ����� MT8104XH, MT8150X, MT8121X
                                </td>
                                <td style="text-align: left">
                                    <a class="download_zip"
                                       title="������� ����������� EasyBuilder 8000 4.66.02.016 (���)" target="_blank"
                                       href="http://www.rusavtomatika.com/soft/EB8000/EB8000_setup.zip">
                                        EB8000_setup.zip</a>
                                </td>
                                <td>21-12-2016</td>
                                <td>122&nbsp;��</td>
                            </tr>
                            <tr>
                                <td>����������� EasyBuilder 8000 4.65.12 (���) ��� ������� MT8104XH, MT8150X, MT8121X
                                </td>
                                <td style="text-align: left">
                                    <a class="download_zip"
                                       title="������� ����������� EasyBuilder 8000 4.66.02.016 (���)" target="_blank"
                                       href="http://www.rusavtomatika.com/soft/EB8000/EB8000V46512.zip">
                                        EB8000V46512.zip</a>
                                </td>
                                <td>03-04-2015</td>
                                <td>101&nbsp;��</td>
                            </tr>
                            <tr>
                                <td>����������� �� EasyBuilder 8000 V4.66.02 (eng)
                                </td>
                                <td style="text-align: left">
                                    <a class="download_pdf"
                                       href="/manuals/UserManualEB8000.pdf">UserManualEB8000.pdf</a>
                                </td>
                                <td>08-02-2016</td>
                                <td>18&nbsp;��</td>
                            </tr>
                            </tbody>
                        </table>
                        <p>
                            EasyBuilder 8000 4.66.02.016 (���) ����������� ��� �������� ���������������� �������� ���
                            ������������ ������� Weintek ��������� �����:
                            <a href='/weintek/series_MT6000i.php'>MT6000i</a>, <a href='/weintek/series_MT8000i.php'>MT8000i</a>,
                            ����� �������
                            <a href='/weintek/MT8104XH.php'>MT8104XH</a>,
                            <a href='/weintek/MT8150X.php'>MT8150X</a>,
                            <a href='/weintek/MT8121X.php'>MT8121X</a>, ��� ������� ��������� ����������� ����������� �
                            4.65.12.
                        </p>
                        <p>������������� �� EasyBuilder 8000 ��������� ���������, �� ������ ��������� �� � ������������
                            �� ��� �����-���� �����������.</p>
                        <p>�������� USB ��� ����������� ������� � �� ��������������� ������������� ��� ���������
                            EasyBuilder 8000.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>