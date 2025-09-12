<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");

$rows = CoreApplication::get_rows_from_table("`catalog_sections`");
global $TITLE;
$TITLE= "��������� ������ - ������ ���������, ��������� ����������, ������������ ���������� full IP65, ������������ ����������, ������������ ��������, VPN-�������, ����������� (PLC), ������ �����-������, ����� �������";
CoreApplication::add_breadcrumbs_chain("������� ������������", "/catalog/");
?>
    <div class="component_catalog">
<?
CoreApplication::include_component(array("component"=> "breadcrumbs"));
?>
<?php
if (count($rows) > 0) {

    ?>
        <div class="component_wrapper">
            <div class="row">

                <div class="col-md-12"><h1 style="margin:0 auto 30px; text-align: center">��������� ������</h1></div>
                <?php
                foreach ($rows as $row) {
                    ?>
                    <div class="col-md-3">
                        <a href="/catalog/<?= $row["code"] ?>/" class="section_link">
                            <div class="preview_image"
                                 style="background-image: url('<?= $row["preview_picture"] ?>')"></div>
                            <div class="title"><?= $row["name"] ?></div>
                        </a>
                    </div>
                    <?
                }
                ?>
            </div>


        </div>
    <div class="row">
        <div class="col-md-12">



            <p>
                �������� �������������� ���� �������� � 2007 ���� � �������� ����� �� ������� ���������� ����������� ������������ ��� ������������� ������������. �� ���������� ������������������� ������� ��� ������������ � ����� �������� � ���������� �������� � ����� �����, ���, ������������� ������ � �����������, ����������. &nbsp;</p>
            <p>
                �� ������������ � ���������� �������� �������� � ���������� ��������� �������� �������� �� ������� ������� ��������������. �������� ��������������&nbsp; �������� ����������� �������������� �� ���������� ������ ��������� <strong>Weintek</strong> � <strong>Samkoon</strong> (������������ ������), <strong>IFC</strong> (��������� ����������, ������������ ����������, ������������ ��������), <strong>Aplex</strong> (��������� ����������), <strong>eWON</strong> (vpn-�������). ����� �� ����� ����� ������������ ����� 100 ������������ ���������.</p>

            <div style="width: 1035px;height:140px;margin-top:50px;    margin-bottom: 35px;">

                <a href="/panelnie-computery/ifc/" title="��������� ���������� IFC">
                    <img src="/images/ifc/IFC-622i3/IFC-622i3_1.png" alt="��������� ���������� IFC" style="float:left; width:140px;margin-right:14px;"></a>

                <a href="/samkoon/" title="������ ��������� Samkoon">
                    <img src="/images/samkoon/SK-102AS/SK-102AS_1.png" alt="������ ��������� Samkoon" style="float:left; width:130px;margin-right:15px;"></a>

                <a href="/panelnie-computery/aplex/" title="��������� ���������� Aplex">
                    <img src="/images/aplex/Aplex-APC1.png" alt="��������� ���������� Aplex" style="float:left;     width: 118px;    margin-right: 35px;"></a>
                <a href="/ewon/" title="Vpn-������� eWON">
                    <img src="/images/ewon/Extention/Flexy-with-modules.png" alt="Vpn-������� eWON" style="float: left;
width: 100px;
margin-right: 26px;
margin-top: 23px;"></a>
                <a href="/box-pc/" title="������������ ���������� IFC">
                    <img src="/images/box-pc/IFC-BOX2800/IFC-BOX2800_5.png" alt="������������ ���������� IFC" style="float:left; width:175px;"></a>


                <a href="/weintek/" title="������ ��������� Weintek">
                    <img src="/images/Weintek-eMT-series.png" alt="������ ��������� Weintek" style="float: left;
width: 232px;

margin-top: 3px;float: right;"></a>
            </div>

            <p>
                �� ������������ ������ �������� �� ������������� �� ����� ������� � �����-���������� � ������. �������� �������� �������������� �������� ������� � ������� ������������� ���������� �� ��������� � ����� ������ ��� �� ������ ������.</p>
            <p>
                ��� �������� ����� �������� � �����-���������� ��������� ���������� ����� ��������� <strong>Weintek</strong><strong>, </strong><strong>Samkoon</strong><strong>, </strong><strong>IFC</strong><strong>, </strong><strong>Aplex</strong><strong>, </strong><strong>eWON</strong> � ������, ������� ������������� ������� ����� 1000 ������ ��������� ����� � ������ ��������������.&nbsp; ����� ���� ����������� ��������� ����������� ����������� �������� � ��������� ������� ��������� � �������, ����� ����������� ����� ������ ��� � �������. � 90% ������� ��� ��������� � ��� �� ����� �� ������.</p>
            <p>
                �������� �������������� �������� ������������ ���� ��������� �� ���������� ������������ ���������.&nbsp; ����� ����, �� ��������� ����������� ���������, ��� ����� ��������, ��� � ���, ��� �������� ��������� �� � ���. �� ������ ������ ���������� � ��� �� ������� �� ���������, ��������� ���� ��� �������� ����� ����� �������� �����:</p>

        </div>
    </div>
    </div>

    <?php

}

