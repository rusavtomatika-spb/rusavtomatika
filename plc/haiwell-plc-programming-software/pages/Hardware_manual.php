<h1 id="Hardware_manual">Hardware manual</h1>
<hr>
<p>Here are resume of Haiwell PLC hardware, include type. specification. parameter. install guide. wire drawing. etc.</p>
<h3 id="Model_table">Model table</h3>
<p>?. Haiwell PLC main MPU, list as follows:<p>
<p><strong>1. C series economy PLC MPU (-e: Built-in Ethernet port)</strong></p>
<table>
    <tbody>
        <tr>
            <td colspan="2">
                <p>Type with ethernet</p>
            </td>
            <td colspan="2">
                <p>Type</p>
            </td>
            <td colspan="4"> Specification</td>
            <td rowspan="2">
                <p>Dimension</p>
            </td>
        </tr>
        <tr>
            <td>
                <p><strong> 24VDC power supply </strong></p>
            </td>
            <td>
                <p>220VAC power supply</p>
            </td>
            <td>
                <p><strong> 24VD</strong>C power supply</p>
            </td>
            <td>
                <p>220VA<strong>C</strong> power supply</p>
            </td>
            <td>
                <p>DI<p>
            </td>
            <td>
                <p>DO<p>
            </td>
            <td>Communication port</td>
            <td>
                <p><strong> Extend module </strong></p>
            </td>
        </tr>
        <tr>
            <td>C10S0R-e</td>
            <td>C10S2R-e</td>
            <td>C10S0R</td>
            <td>C10S2R</td>
            <td>
                <p>6</p>
            </td>
            <td>
                <p>4 relay</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion </td>
            <td rowspan="6">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20S16S2T.JPG"/></p>
                <p>93x95x82mm<p>
            </td>
        </tr>
        <tr>
            <td>C10S0T-e</td>
            <td>C10S2T-e</td>
            <td>C10S0T</td>
            <td>C10S2T</td>
            <td>
                <p>6</p>
            </td>
            <td>
                <p>4 NPN transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C10S0P-e</td>
            <td>C10S2P-e</td>
            <td>C10S0P</td>
            <td>C10S2P</td>
            <td>
                <p>6</p>
            </td>
            <td>
                <p>4 PNP transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C16S0R-e</td>
            <td>C16S2R-e</td>
            <td>C16S0R</td>
            <td>C16S2R</td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>8 relay</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion </td>
        </tr>
        <tr>
            <td>C16S0T-e</td>
            <td>C16S2T-e</td>
            <td>C16S0T</td>
            <td>C16S2T</td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>8 NPN transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C16S0P-e</td>
            <td>C16S2P-e</td>
            <td>C16S0P</td>
            <td>C16S2P</td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>8 PNP transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C24S0R-e</td>
            <td>C24S2R-e</td>
            <td>C24S0R</td>
            <td>C24S2R</td>
            <td>
                <p>16</p>
            </td>
            <td>
                <p>8 relay</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion </td>
            <td rowspan="6">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20S32S0T.JPG"/></p>
                131x95x82mm
            </td>
        </tr>
        <tr>
            <td>C24S0T-e</td>
            <td>C24S2T-e</td>
            <td>C24S0T</td>
            <td>C24S2T</td>
            <td>
                <p>16</p>
            </td>
            <td>
                <p>8 NPN transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C24S0P-e</td>
            <td>C24S2P-e</td>
            <td>C24S0P</td>
            <td>C24S2P</td>
            <td>
                <p>16</p>
            </td>
            <td>
                <p>8 PNP transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C32S0R-e</td>
            <td>C32S2R-e</td>
            <td>C32S0R</td>
            <td>C32S2R</td>
            <td>
                <p>16</p>
            </td>
            <td>
                <p>16 relay</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion </td>
        </tr>
        <tr>
            <td>C32S0T-e</td>
            <td>C32S2T-e</td>
            <td>C32S0T</td>
            <td>C32S2T</td>
            <td>
                <p>16</p>
            </td>
            <td>
                <p>16 NPN transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C32S0P-e</td>
            <td>C32S2P-e</td>
            <td>C32S0P</td>
            <td>C32S2P</td>
            <td>
                <p>16</p>
            </td>
            <td>
                <p>16 PNP transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C48S0R-e</td>
            <td>C48S2R-e</td>
            <td>C48S0R</td>
            <td>C48S2R</td>
            <td>
                <p>28</p>
            </td>
            <td>
                <p>20 relay</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion </td>
            <td rowspan="6"> <img src="<?= $path_to_images ?>images/Haiwell%20H64XDT.JPG"/>
                <p>177x95x82mm</p>
            </td>
        </tr>
        <tr>
            <td>C48S0T-e</td>
            <td>C48S2T-e</td>
            <td>C48S0T</td>
            <td>C48S2T</td>
            <td>
                <p>28</p>
            </td>
            <td>
                <p>20 NPN transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C48S0P-e</td>
            <td>C48S2P-e</td>
            <td>C48S0P</td>
            <td>C48S2P</td>
            <td>
                <p>28</p>
            </td>
            <td>
                <p>20 PNP transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C60S0R-e</td>
            <td>C60S2R-e</td>
            <td>C60S0R</td>
            <td>C60S2R</td>
            <td>
                <p>36</p>
            </td>
            <td>
                <p>24 relay</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion </td>
        </tr>
        <tr>
            <td>C60S0T-e</td>
            <td>C60S2T-e</td>
            <td>C60S0T</td>
            <td>C60S2T</td>
            <td>
                <p>36</p>
            </td>
            <td>
                <p>24 NPN transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
        <tr>
            <td>C60S0P-e</td>
            <td>C60S2P-e</td>
            <td>C60S0P</td>
            <td>C60S2P</td>
            <td>
                <p>36</p>
            </td>
            <td>
                <p>24 PNP transistor</p>
            </td>
            <td>
                <p>RS232 + RS485</p>
            </td>
            <td>No, Through 485 serial expansion</td>
        </tr>
    </tbody>
</table>
<p><strong>2. T series standard PLC MPU (-e: Built-in Ethernet port)</strong></p>
<div class="qty-table">
    <table>
        <tbody>
            <tr>
                <td colspan="2">
                    <p>Type with ethernet</p>
                </td>
                <td colspan="2">
                    <p>Type</p>
                </td>
                <td colspan="8"> Specification</td>
                <td rowspan="2">
                    <p>Dimension</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong> 24VDC power supply </strong></p>
                </td>
                <td>
                    <p>220VAC power supply</p>
                </td>
                <td>
                    <p><strong> 24VD</strong>C power supply</p>
                </td>
                <td>
                    <p>220VA<strong>C</strong> power supply</p>
                </td>
                <td>
                    <p>DI<p>
                </td>
                <td>
                    <p>DO<p>
                </td>
                <td>
                    <p><strong>AI </strong></p>
                </td>
                <td>AO</td>
                <td>High speed pulse input</td>
                <td>High speed pulse output</td>
                <td>Communication port</td>
                <td>
                    <p><strong> Extend module </strong></p>
                </td>
            </tr>
            <tr>
                <td>T16S0R-e</td>
                <td>T16S2R-e</td>
                <td>T16S0R</td>
                <td>T16S2R</td>
                <td>
                    <p>8</p>
                </td>
                <td>
                    <p>8 relay</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td></td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="3">
                    <p><img src="<?= $path_to_images ?>images/Haiwell%20S16S2T.JPG"/></p>
                    <p>93x95x82mm<p>
                </td>
            </tr>
            <tr>
                <td>T16S0T-e</td>
                <td>T16S2T-e</td>
                <td>T16S0T</td>
                <td>T16S2T</td>
                <td>
                    <p>8</p>
                </td>
                <td>
                    <p>8 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T16S0P-e</td>
                <td>T16S2P-e</td>
                <td>T16S0P</td>
                <td>T16S2P</td>
                <td>
                    <p>8</p>
                </td>
                <td>
                    <p>8 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T24S0R-e</td>
                <td>T24S2R-e</td>
                <td>T24S0R</td>
                <td>T24S2R</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>8 relay</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td></td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="6">
                    <p><img src="<?= $path_to_images ?>images/Haiwell%20S32S0T.JPG"/></p>
                    131x95x82mm
                </td>
            </tr>
            <tr>
                <td>T24S0T-e</td>
                <td>T24S2T-e</td>
                <td>T24S0T</td>
                <td>T24S2T</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>8 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T24S0P-e</td>
                <td>T24S2P-e</td>
                <td>T24S0P</td>
                <td>T24S2P</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>8 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T32S0R-e</td>
                <td>T32S2R-e</td>
                <td>T32S0R</td>
                <td>T32S2R</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>16 relay</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td></td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T32S0T-e</td>
                <td>T32S2T-e</td>
                <td>T32S0T</td>
                <td>T32S2T</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>16 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T32S0P-e</td>
                <td>T32S2P-e</td>
                <td>T32S0P</td>
                <td>T32S2P</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>16 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T48S0R-e</td>
                <td>T48S2R-e</td>
                <td>T48S0R</td>
                <td>T48S2R</td>
                <td>
                    <p>28</p>
                </td>
                <td>
                    <p>20 relay</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td></td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="6"> <img src="<?= $path_to_images ?>images/Haiwell%20H64XDT.JPG"/>
                    <p>177x95x82mm</p>
                </td>
            </tr>
            <tr>
                <td>T48S0T-e</td>
                <td>T48S2T-e</td>
                <td>T48S0T</td>
                <td>T48S2T</td>
                <td>
                    <p>28</p>
                </td>
                <td>
                    <p>20 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T48S0P-e</td>
                <td>T48S2P-e</td>
                <td>T48S0P</td>
                <td>T48S2P</td>
                <td>
                    <p>28</p>
                </td>
                <td>
                    <p>20 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T60S0R-e</td>
                <td>T60S2R-e</td>
                <td>T60S0R</td>
                <td>T60S2R</td>
                <td>
                    <p>36</p>
                </td>
                <td>
                    <p>24 relay</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td></td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T60S0T-e</td>
                <td>T60S2T-e</td>
                <td>T60S0T</td>
                <td>T60S2T</td>
                <td>
                    <p>36</p>
                </td>
                <td>
                    <p>24 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>T60S0P-e</td>
                <td>T60S2P-e</td>
                <td>T60S0P</td>
                <td>T60S2P</td>
                <td>
                    <p>36</p>
                </td>
                <td>
                    <p>24 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>2 Channel A/B phase (4 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
        </tbody>
    </table>
</div>
<p><strong>3. H series high-performance PLC MPU (-e: Built-in Ethernet port)</strong></p>
<div class="qty-table">
    <table>
        <tbody>
            <tr>
                <td colspan="2">
                    <p>Type with ethernet</p>
                </td>
                <td colspan="2">
                    <p>Type</p>
                </td>
                <td colspan="8"> Specification</td>
                <td rowspan="2">
                    <p>Dimension</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong> 24VDC power supply </strong></p>
                </td>
                <td>
                    <p>220VAC power supply</p>
                </td>
                <td>
                    <p><strong> 24VD</strong>C power supply</p>
                </td>
                <td>
                    <p>220VA<strong>C power supply </strong></p>
                </td>
                <td>
                    <p>DI<p>
                </td>
                <td>
                    <p>DO<p>
                </td>
                <td>
                    <p><strong>AI </strong></p>
                </td>
                <td>AO</td>
                <td>High speed pulse input</td>
                <td>
                    <p>High speed pulse output<p>
                </td>
                <td>Communication</td>
                <td>
                    <p><strong> Extend module </strong></p>
                </td>
            </tr>
            <tr>
                <td>H16S0R-e</td>
                <td>H16S2R-e</td>
                <td>H16S0R</td>
                <td>H16S2R</td>
                <td>
                    <p>8</p>
                </td>
                <td>
                    <p>8 relay</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td></td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="6">
                    <p><img src="<?= $path_to_images ?>images/Haiwell%20S16S2T.JPG"/></p>
                    <p>93x95x82mm<p>
                </td>
            </tr>
            <tr>
                <td>H16S0T-e</td>
                <td>H16S2T-e</td>
                <td>H16S0T</td>
                <td>H16S2T</td>
                <td>
                    <p>8</p>
                </td>
                <td>
                    <p>8 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H16S0P-e</td>
                <td>H16S2P-e</td>
                <td>H16S0P</td>
                <td>H16S2P</td>
                <td>
                    <p>8</p>
                </td>
                <td>
                    <p>8 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H24S0R-e</td>
                <td>H24S2R-e</td>
                <td>H24S0R</td>
                <td>H24S2R</td>
                <td>
                    <p>12</p>
                </td>
                <td>
                    <p>12 relay</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td></td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H24S0T-e</td>
                <td>H24S2T-e</td>
                <td>H24S0T</td>
                <td>H24S2T</td>
                <td>
                    <p>12</p>
                </td>
                <td>
                    <p>12 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H24S0P-e</td>
                <td>H24S2P-e</td>
                <td>H24S0P</td>
                <td>H24S2P</td>
                <td>
                    <p>12</p>
                </td>
                <td>
                    <p>12 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H32S0R-e</td>
                <td>H32S2R-e</td>
                <td>H32S0R</td>
                <td>H32S2R</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>16 relay</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>?</td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="6">
                    <p><img src="<?= $path_to_images ?>images/Haiwell%20S32S0T.JPG"/></p>
                    <p>131x95x82mm<p>
                </td>
            </tr>
            <tr>
                <td>H32S0T-e</td>
                <td>H32S2T-e</td>
                <td>H32S0T</td>
                <td>H32S2T</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>16 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H32S0P-e</td>
                <td>H32S2P-e</td>
                <td>H32S0P</td>
                <td>H32S2P</td>
                <td>
                    <p>16</p>
                </td>
                <td>
                    <p>16 PNP transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H40S0R-e</td>
                <td>H40S2R-e</td>
                <td>H40S0R</td>
                <td>H40S2R</td>
                <td>
                    <p>20</p>
                </td>
                <td>
                    <p>20 relay</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>?</td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H40S0T-e</td>
                <td>H40S2T-e</td>
                <td>H40S0T</td>
                <td>H40S2T</td>
                <td>
                    <p>20</p>
                </td>
                <td>
                    <p>20 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H40S0P-e</td>
                <td>H40S2P-e</td>
                <td>H40S0P</td>
                <td>H40S2P</td>
                <td>
                    <p>20</p>
                </td>
                <td>
                    <p>20 PNP transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H60S0R-e</td>
                <td>H60S2R-e</td>
                <td>H60S0R</td>
                <td>H60S2R</td>
                <td>
                    <p>36</p>
                </td>
                <td>
                    <p>24 relay</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>?</td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="3"> <img src="<?= $path_to_images ?>images/Haiwell%20H64XDT.JPG"/>
                    <p>177x95x82mm</p>
                </td>
            </tr>
            <tr>
                <td>H60S0T-e</td>
                <td>H60S2T-e</td>
                <td>H60S0T</td>
                <td>H604S2T</td>
                <td>
                    <p>36</p>
                </td>
                <td>
                    <p>24 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>H60S0P-e</td>
                <td>H60S2P-e</td>
                <td>H60S0P</td>
                <td>H604S2P</td>
                <td>
                    <p>36</p>
                </td>
                <td>
                    <p>24 PNP transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
        </tbody>
    </table>
</div>
<p><strong>4. N series motion control PLC MPU (-e: Built-in Ethernet port) </strong> Support linear interpolation, ARC interpolation, Synchronism pulse output .Support absolute address, relative address.Support backlash compensation.Support electric original point redefine etc.</p>
<div class="qty-table">
    <table>
        <tbody>
            <tr>
                <td colspan="2">
                    <p>Type with ethernet</p>
                </td>
                <td colspan="2">
                    <p>Type</p>
                </td>
                <td colspan="8"> Specification</td>
                <td rowspan="2">
                    <p>Dimension</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong> 24VDC power supply </strong></p>
                </td>
                <td>
                    <p>220VAC power supply</p>
                </td>
                <td>
                    <p><strong> 24VD</strong>C power supply</p>
                </td>
                <td>
                    <p>220VA<strong>C power supply </strong></p>
                </td>
                <td>
                    <p>DI<p>
                </td>
                <td>
                    <p>DO<p>
                </td>
                <td>
                    <p><strong>AI </strong></p>
                </td>
                <td>AO</td>
                <td>High speed pulse input</td>
                <td>
                    <p>High speed pulse output<p>
                </td>
                <td>Communication</td>
                <td>
                    <p><strong> Extend module </strong></p>
                </td>
            </tr>
            <tr>
                <td>N16S0T-e</td>
                <td>N16S2T-e</td>
                <td>N16S0T</td>
                <td>N16S2T</td>
                <td>
                    <p>8</p>
                </td>
                <td>
                    <p>8 NPN transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="4">
                    <p><img src="<?= $path_to_images ?>images/Haiwell%20S16S2T.JPG"/></p>
                    <p>93x95x82mm<p>
                </td>
            </tr>
            <tr>
                <td>N16S0P-e</td>
                <td>N16S2P-e</td>
                <td>N16S0P</td>
                <td>N16S2P</td>
                <td>
                    <p>8</p>
                </td>
                <td>
                    <p>8 PNP transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>4 Channel A/B phase (8 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>N24S0T-e</td>
                <td>N24S2T-e</td>
                <td>N24S0T</td>
                <td>N24S2T</td>
                <td>
                    <p>12</p>
                </td>
                <td>
                    <p>12 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>6 Channel A/B phase (12 Point) 200K</p>
                </td>
                <td>
                    <p>6 Channel A/B phase (12 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>N24S0P-e</td>
                <td>N24S2P-e</td>
                <td>N24S0P</td>
                <td>N24S2P</td>
                <td>
                    <p>12</p>
                </td>
                <td>
                    <p>12 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>6 Channel A/B phase (12 Point) 200K</p>
                </td>
                <td>
                    <p>6 Channel A/B phase (12 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>N40S0T-e</td>
                <td>N40S2T-e</td>
                <td>N40S0T</td>
                <td>N40S2T</td>
                <td>
                    <p>20</p>
                </td>
                <td>
                    <p>20 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>8 Channel A/B phase (16 Point) 200K</p>
                </td>
                <td>
                    <p>8 Channel A/B phase (16 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="2">
                    <p><img src="<?= $path_to_images ?>images/Haiwell%20S32S0T.JPG"/></p>
                    <p>131x95x82mm<p>
                </td>
            </tr>
            <tr>
                <td>N40S0P-e</td>
                <td>N40S2P-e</td>
                <td>N40S0P</td>
                <td>N40S2P</td>
                <td>
                    <p>20</p>
                </td>
                <td>
                    <p>20 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>8 Channel A/B phase (16 Point) 200K</p>
                </td>
                <td>
                    <p>8 Channel A/B phase (16 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
            <tr>
                <td>N60S0T-e</td>
                <td>N60S2T-e</td>
                <td>N60S0T</td>
                <td>N60S2T</td>
                <td>
                    <p>36</p>
                </td>
                <td>
                    <p>24 NPN transistor</p>
                </td>
                <td>?</td>
                <td>?</td>
                <td>
                    <p>8 Channel A/B phase (16 Point) 200K</p>
                </td>
                <td>
                    <p>8 Channel A/B phase (16 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
                <td rowspan="2"> <img src="<?= $path_to_images ?>images/Haiwell%20H64XDT.JPG"/>
                    <p>177x95x82mm</p>
                </td>
            </tr>
            <tr>
                <td>N60S0P-e</td>
                <td>N60S2P-e</td>
                <td>N60S0P</td>
                <td>N60S2P</td>
                <td>
                    <p>36</p>
                </td>
                <td>
                    <p>24 PNP transistor</p>
                </td>
                <td></td>
                <td></td>
                <td>
                    <p>8 Channel A/B phase (16 Point) 200K</p>
                </td>
                <td>
                    <p>8 Channel A/B phase (16 Point) 200K</p>
                </td>
                <td>
                    <p>RS232 + RS485, maximum 5 ports</p>
                </td>
                <td>7 modules </td>
            </tr>
        </tbody>
    </table>
</div>
<p>?. Haiwell PLC provide many extend modules, extend module built-in RS485 Communication port, support remote IO function, list as follows:<p>
<p><strong>1. Digital I/O extend module (-e: Built-in Ethernet port)</strong></p>
<table>
    <tbody>
        <tr>
            <td colspan="2">
                <p>Type with ethernet</p>
            </td>
            <td colspan="2">
                <p>Type<p>
            </td>
            <td colspan="3">
                <p>Specification<p>
            </td>
            <td rowspan="2">
                <p>Dimension</p>
            </td>
        </tr>
        <tr>
            <td>
                <p><strong> 24VDC power supply </strong></p>
            </td>
            <td>
                <p>220VAC power supply</p>
            </td>
            <td>
                <p><strong> 24VDC power supply </strong></p>
            </td>
            <td>
                <p>220VAC power supply</p>
            </td>
            <td>
                <p>DI</p>
            </td>
            <td>
                <p>DO</p>
            </td>
            <td>
                <p>Communication</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H08DI<p>
            </td>
            <td>?</td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td rowspan="7">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20H02RS.JPG"/></p>
                <p>30x95x82mm<p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H08DOR<p>
            </td>
            <td>?</td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>8 relay</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H08DOT<p>
            </td>
            <td></td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>8 NPN transistor</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>?</td>
            <td></td>
            <td>
                <p>H08DOP<p>
            </td>
            <td></td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>8 PNP transistor</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H08XDR<p>
            </td>
            <td>?</td>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>4 relay</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H08XDT<p>
            </td>
            <td></td>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>4 NPN transistor</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>?</td>
            <td></td>
            <td>
                <p>H08XDP<p>
            </td>
            <td></td>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>4 PNP transistor</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H16DI</p>
            </td>
            <td>?</td>
            <td>
                <p>16</p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
            <td rowspan="7">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20H16XDT.JPG"/></p>
                <p>70x95x82mm<p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H16DOR<p>
            </td>
            <td>?</td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>16 relay</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H16DOT<p>
            </td>
            <td>?</td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>16 NPN transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H16DOP<p>
            </td>
            <td>?</td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>16 PNP transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H16XDR<p>
            </td>
            <td>?</td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>8 relay</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>H16XDT</td>
            <td>?</td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>8 NPN transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>H16XDP</td>
            <td>?</td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>8 PNP transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H24DI-e</p>
            </td>
            <td>
                <p>H24DI2-e</p>
            </td>
            <td>
                <p>H24DI</p>
            </td>
            <td>
                <p>H24DI2</p>
            </td>
            <td>
                <p>24</p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
            <td rowspan="4">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20S16S2T.JPG"/></p>
                93x95x82mm
            </td>
        </tr>
        <tr>
            <td>
                <p>H24XDR-e<p>
            </td>
            <td>
                <p>H24XDR2-e</p>
            </td>
            <td>
                <p>H24XDR<p>
            </td>
            <td>
                <p>H24XDR2<p>
            </td>
            <td>
                <p>12</p>
            </td>
            <td>
                <p>12 relay</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>H24XDT-e</td>
            <td>H24XDT2-e</td>
            <td>H24XDT</td>
            <td>H24XDT2</td>
            <td>
                <p>12</p>
            </td>
            <td>
                <p>12 NPN transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>H24XDP-e</td>
            <td>H24XDP2-e</td>
            <td>H24XDP</td>
            <td>H24XDP2</td>
            <td>
                <p>12</p>
            </td>
            <td>
                <p>12 PNP transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H40DI-e</p>
            </td>
            <td>
                <p>H40DI2-e</p>
            </td>
            <td>
                <p>H40DI</p>
            </td>
            <td>
                <p>H40DI2</p>
            </td>
            <td>
                <p>40</p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
            <td rowspan="7">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20S32S0T.JPG"/></p>
                131x95x82mm
            </td>
        </tr>
        <tr>
            <td>
                <p>H36DOR-e<p>
            </td>
            <td>
                <p>H36DOR2-e</p>
            </td>
            <td>
                <p>H36DOR<p>
            </td>
            <td>
                <p>H36DOR2<p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>36 relay</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H36DOT-e</p>
            </td>
            <td>
                <p>H36DOT2-e</p>
            </td>
            <td>
                <p>H36DOT<p>
            </td>
            <td>
                <p>H36DOT2<p>
            </td>
            <td>?</td>
            <td>
                <p>36 NPN transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H36DOP-e</p>
            </td>
            <td>
                <p>H36DOP2-e</p>
            </td>
            <td>
                <p>H36DOP<p>
            </td>
            <td>
                <p>H36DOP2<p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>36 PNP transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H40XDR-e</p>
            </td>
            <td>
                <p>H40XDR2-e</p>
            </td>
            <td>
                <p>H40XDR<p>
            </td>
            <td>
                <p>H40XDR2<p>
            </td>
            <td>
                <p>20</p>
            </td>
            <td>
                <p>20 relay</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>H40XDT-e</td>
            <td>H40XDT2-e</td>
            <td>H40XDT</td>
            <td>H40XDT2</td>
            <td>
                <p>20</p>
            </td>
            <td>
                <p>20 NPN transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>H40XDP-e</td>
            <td>H40XDP2-e</td>
            <td>H40XDP</td>
            <td>H40XDP2</td>
            <td>
                <p>20</p>
            </td>
            <td>
                <p>20 PNP transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H64XDR-e</p>
            </td>
            <td>
                <p>H64XDR2-e</p>
            </td>
            <td>
                <p>H64XDR<p>
            </td>
            <td>
                <p>H64XDR2<p>
            </td>
            <td>
                <p>32</p>
            </td>
            <td>
                <p>32 relay</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
            <td rowspan="3"> <img src="<?= $path_to_images ?>images/Haiwell%20H64XDT.JPG"/>
                <p>177x95x82mm</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H64XDT-e</p>
            </td>
            <td>
                <p>H64XDT2-e<p>
            </td>
            <td>
                <p>H64XDT</p>
            </td>
            <td>
                <p>H64XDT2<p>
            </td>
            <td>
                <p>32</p>
            </td>
            <td>
                <p>32 NPN transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H64XDP-e</p>
            </td>
            <td>
                <p>H64XDP2-e<p>
            </td>
            <td>
                <p>H64XDP</p>
            </td>
            <td>
                <p>H64XDP2<p>
            </td>
            <td>
                <p>32</p>
            </td>
            <td>
                <p>32 PNP transistor</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
    </tbody>
</table>
<p>Note:Extend module built-in communication function:as well as support parallel bus, also support serial bus, extended by serial bus(be remote function), don't limited by extend point of the system, can install distruted.</p>
<p><strong>2. Analog I/O extend module (-e: Built-in Ethernet port)</strong></p>
<table>
    <tbody>
        <tr>
            <td colspan="2">
                <p>Type with ethernet</p>
            </td>
            <td colspan="2">
                <p>Type<p>
            </td>
            <td colspan="4">
                <p>Specification<p>
            </td>
            <td rowspan="2">
                <p>Dimension</p>
            </td>
        </tr>
        <tr>
            <td>
                <p><strong> 24VDC power supply </strong></p>
            </td>
            <td>
                <p>220VAC power supply</p>
            </td>
            <td>
                <p><strong> 24VDC power supply </strong></p>
            </td>
            <td>
                <p>220VAC power supply</p>
            </td>
            <td>
                <p>AI</p>
            </td>
            <td>
                <p>AO</p>
            </td>
            <td>
                <p>Conversion number accuracy</p>
            </td>
            <td>
                <p>Communication</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H04DT</p>
            </td>
            <td>?</td>
            <td>
                <p>4 Channel DS18B20, RW1820 temperature sensor, DS1990 sensor or SHT1x, SHT7x temperature and humidity sensor</p>
            </td>
            <td>?</td>
            <td>
                <p>9~12 bits</p>
            </td>
            <td>?</td>
            <td rowspan="2">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20H02RS.JPG"/></p>
                <p>30x95x82mm<p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H32DT</p>
            </td>
            <td>?</td>
            <td>
                <p>32 Channel <br/>
                    DS18B20, RW1820 temperature sensor, DS1990 sensor
                </p>
            </td>
            <td></td>
            <td>
                <p>9~12 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>S04AI<p>
            </td>
            <td>
                <p>S04AI2<p>
            </td>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>12 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
            <td rowspan="6">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20H16XDT.JPG"/></p>
                <p>70x95x82mm<p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>S04AO<p>
            </td>
            <td>
                <p>S04AO2<p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>12 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>S04XA<p>
            </td>
            <td>
                <p>S04XA2<p>
            </td>
            <td>
                <p>2</p>
            </td>
            <td>
                <p>2</p>
            </td>
            <td>
                <p>12 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H04TC<p>
            </td>
            <td>
                <p>H04TC2<p>
            </td>
            <td>
                <p>4 thermocouple<p>
            </td>
            <td>?</td>
            <td>
                <p>16 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H04RC</p>
            </td>
            <td>
                <p>H04RC2</p>
            </td>
            <td>
                <p>4 thermal resistance</p>
            </td>
            <td>?</td>
            <td>
                <p>16 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>?</td>
            <td>?</td>
            <td>
                <p>H08TC<p>
            </td>
            <td>
                <p>H08TC2<p>
            </td>
            <td>
                <p>8 thermocouple<p>
            </td>
            <td></td>
            <td>
                <p>16 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>S08AI-e</p>
            </td>
            <td>
                <p>S08AI2-e</p>
            </td>
            <td>
                <p>S08AI</p>
            </td>
            <td>
                <p>S08AI2</p>
            </td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>12 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
            <td rowspan="5">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20S16S2T.JPG"/></p>
                <p>93x95x82mm<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>S08AO-e<p>
            </td>
            <td>
                <p>S08AO2-e<p>
            </td>
            <td>
                <p>S08AO<p>
            </td>
            <td>
                <p>S08AO2<p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>12 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>S08XA-e<p>
            </td>
            <td>
                <p>S08XA2-e<p>
            </td>
            <td>
                <p>S08XA<p>
            </td>
            <td>
                <p>S08XA2<p>
            </td>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>12 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H08RC-e</p>
            </td>
            <td>
                <p>H08RC2-e</p>
            </td>
            <td>
                <p>H08RC</p>
            </td>
            <td>
                <p>H08RC2</p>
            </td>
            <td>
                <p>8 thermal resistance</p>
            </td>
            <td></td>
            <td>
                <p>16 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>H02PW-e</p>
            </td>
            <td>?</td>
            <td>
                <p>H02PW</p>
            </td>
            <td>?</td>
            <td colspan="2">
                <p>2 Channels programmed control dc constant voltage/constant current output, with current and voltage measurement</p>
            </td>
            <td>
                <p>12 bits</p>
            </td>
            <td>
                <p>RS485, support remote function</p>
            </td>
        </tr>
    </tbody>
</table>
<p>Note:1). Extend module built-in communication function:as well as support parallel bus, also support serial bus, extended by serial bus(be remote function), don't limited by extend point of the system, can install distruted..</p>
<p>2). Analog AI. AO support 6 type signals:[4, 20]mA. [0, 20]mA. [1, 5]V. [0, 5]V. [0, 10]V. [-10, 10]V</p>
<p>3). Thermocouple module support:S. K. T. E. J. B. N. R. Wre3/25. Wre5/26. [0, 20]mV. [0, 50]mV. [0, 100]mV</p>
<p>4). Thermal resistance module support:Pt100. Pt1000. Cu50. Cu100</p>
<p><strong>3. Communication extend module</strong></p>
<table>
    <tbody>
        <tr>
            <td>
                <p>Type<p>
            </td>
            <td>
                <p>Specification<p>
            </td>
            <td>
                <p>Dimension</p>
            </td>
        </tr>
        <tr>
            <td>S01RS</td>
            <td>
                <p>With isolation, 1 RS232/RS485 communication port, Modbus RTU/ASCII protocol. freedom communication protocol. Haiwellbus high speed communication protocol, Baud rate 1200~115200bps<p>
            </td>
            <td rowspan="2">
                <p><img src="<?= $path_to_images ?>images/Haiwell%20H02RS.JPG"/></p>
                <p>30x95x82mm<p>
            </td>
        </tr>
        <tr>
            <td>H01ZB</td>
            <td>ZigBee wireless communication</td>
        </tr>
        <tr>
            <td>PC2ZB</td>
            <td>
                <p>PC to Zigbee module</p>
            </td>
            <td rowspan="2">
                <p><img src="<?= $path_to_images ?>images/PC2ZB.jpg"/></p>
                <p>48x70x24mm<p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="PLC_specification">PLC specification</h3>
<table>
    <thead>
        <tr>
            <td colspan="2">
                <p><strong> Item</strong></p>
            </td>
            <td>
                <p><strong> Specification</strong></p>
            </td>
            <td>
                <p><strong>Declare</strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">
                <p>Program control model</p>
            </td>
            <td>
                <p>Cycle scan model</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Input/output (I/O) control model</p>
            </td>
            <td>
                <p>Refresh once each cycle scan, support immediately refresh instruction (MPU and extend module)<p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Execution speed of instruction</p>
            </td>
            <td>
                <p>0.05us/basic instruction</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Program language</p>
            </td>
            <td>
                <p>LD(ladder) + FBD(function block) + IL( instruction list)</p>
            </td>
            <td>
                <p>Accord with IEC 61131-3</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Program capacity</p>
            </td>
            <td>
                <p>48K</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Storage way</p>
            </td>
            <td>
                <p>Flash ROM permanent storage, dispense with backup battery</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>X</p>
            </td>
            <td>
                <p>External input<p>
            </td>
            <td>
                <p>X0~X1023 1024 point</p>
            </td>
            <td>
                <p>Support edge catch and signal filtering set</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Y</p>
            </td>
            <td>
                <p>External output<p>
            </td>
            <td>
                <p>Y0~Y1023 1024 point</p>
            </td>
            <td>
                <p>Power-off preserve output can be configured</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>M</p>
            </td>
            <td>
                <p>Auxiliary relay</p>
            </td>
            <td>
                <p>M0~ M12287 12288 point</p>
                <p>(default power-off preserve)M1536~M2047 512 point</p>
            </td>
            <td>
                <p>Power-off preserve area can be set freedom</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>T</p>
            </td>
            <td>
                <p>Timer(output coil)</p>
            </td>
            <td>
                <p>T0~T1023 1024 point</p>
                <p>(default power-off preserve)T96~T127 32 point</p>
            </td>
            <td>
                <p>Power-off preserve area can be set freedom, time base:10ms. 100ms. 1s be set freedom, T252~T255 1ms<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Counter(output coil)</p>
            </td>
            <td>
                <p>C0~C255 256 point</p>
                <p>(default power-off preserve)C64~C127 64 point</p>
            </td>
            <td>
                <p>Power-off preserve area can be set freedom</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>S</p>
            </td>
            <td>
                <p>Step state bits</p>
            </td>
            <td>S0~S2047 2048 point
                <p>(default power-off preserve)S156~S255 100 point</p>
            </td>
            <td>
                <p>Power-off preserve area can be set Freedom</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>SM</p>
            </td>
            <td>
                <p>System state bits</p>
            </td>
            <td>
                <p>SM0~SM215 216 point</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>LM</p>
            </td>
            <td>
                <p>Local relay</p>
            </td>
            <td>
                <p>LM0~LM31 32 point</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>AI</p>
            </td>
            <td>
                <p>Analog input register</p>
            </td>
            <td>
                <p>AI0~AI255 256 point</p>
            </td>
            <td>
                <p>Support quantities convert. sample times and zero point correct</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>AQ</p>
            </td>
            <td>
                <p>Analog output register</p>
            </td>
            <td>
                <p>AQ0~AQ255 256 point</p>
            </td>
            <td>
                <p>Support quantities convert, power-off preserve output can be configured</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>V</p>
            </td>
            <td>
                <p>Internal data register</p>
            </td>
            <td>
                <p>V0~V14847 14848 point</p>
                <p>(default power-off preserve)V1000~V2047 1048 point</p>
            </td>
            <td>
                <p>power-off preserve area can be set freedom</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>TV</p>
            </td>
            <td>
                <p>Timer(Current value register)</p>
            </td>
            <td>
                <p>TV0~TV1023 1024 point</p>
                <p>(default power-off preserve)TV96~TV127 32 point</p>
            </td>
            <td>
                <p>Power-off preserve area can be set freedom, time base:10ms. 100ms. 1s can be set freedom, T252~T255 1ms</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>CV</p>
            </td>
            <td>
                <p>Counter(Current value register)</p>
            </td>
            <td>
                <p>CV0~CV255 256 point</p>
                <p>(default power-off preserve)CV64~CV127 64 point</p>
            </td>
            <td>
                <p>Power-off preserve area can be set freedom, CV48~CV79 are 32 bits, Other are 16 bits</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>SV</p>
            </td>
            <td>
                <p>System register</p>
            </td>
            <td>SV0~SV900 901 point</td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>LV</p>
            </td>
            <td>
                <p>Local register</p>
            </td>
            <td>
                <p>LV0~LV31 32 point</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>P</p>
            </td>
            <td>
                <p>Indexed addressing point<p>
            </td>
            <td>
                <p>P0~P29 30 point, use for indirect addressing</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>I</p>
            </td>
            <td>
                <p>Interrupt</p>
            </td>
            <td>
                <p>I1-I52 52 point</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>LBL</p>
            </td>
            <td>
                <p>Lable</p>
            </td>
            <td>
                <p>255point, use for program skip</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p>Constant</p>
            </td>
            <td>
                <p>10 Decimal<p>
            </td>
            <td>
                <p>-32768~+32767(16 bits), -2147483648~+2147483647(32 bits)</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>16 Hexadecimal<p>
            </td>
            <td>
                <p>0000~FFFF(16 bits), 00000000~FFFFFFFF(32 bits )</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Communication port</p>
            </td>
            <td>
                <p>MPU built-in 2 communication port(RS232/RS485), maximum 5 communication port (RS232/RS485) be extended</p>
            </td>
            <td>
                <p>can be program or networking(master/slave)</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Communication protocol</p>
            </td>
            <td>
                <p>Modbus RTU/ASCII protocol. freedom communication protocol. Haiwellbus speed communication protocol, Baud rate 1200~115200bps</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>PLC network capacity</p>
            </td>
            <td>
                <p>PLC communication address can be set external set, maximum 254, support 1:N. N:1. N:N network</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Real time clock(RTC)</p>
            </td>
            <td>
                <p>Display:year/month/day/hour/minute/second/week</p>
            </td>
            <td>
                <p>(H/N series built-in battery)</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Hardware extended capacity</p>
            </td>
            <td>
                <p>7 module can be extended</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>High speed counter</p>
            </td>
            <td>
                <p>8 Channel 200K</p>
            </td>
            <td>
                <p>Have teaching function, 7 counting model:1 - pulse/direction 1 times, 2 - pulse/direction 2 times, 3 - positive/reversal pulse 1 times, 4 - positive/reversal pulse 2 times, 5 - A/B phase pulse 1 times, 6 - A/B phase pulse 2 times, 7 - A/B phase pulse 4 times</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>High speed pulse output</p>
            </td>
            <td>
                <p>8 Channel 200K</p>
            </td>
            <td>
                <p>5 output models:1 - single pulse output, 2 - pulse/direction output, 3 - positive/reversal pulse output, 4 - A/B phase pulse output, 5 - Synchronism pulse output</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Float point arithmetic instruction</p>
            </td>
            <td>
                <p>support within 32 bits float point arithmetic, integer/float point convert arithmetic</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>password protect</p>
            </td>
            <td>
                <p>Support three level password protect function(program file passord. program block password. PLC hardword password) and upload prohibited function</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="Other_specification">Other specification</h3>
<p><strong>1. Power specification</strong></p>
<table>
    <thead>
        <tr>
            <td colspan="2">
                <p><strong> Item</strong></p>
            </td>
            <td>
                <p><strong>AC supply</strong></p>
            </td>
            <td>
                <p><strong>DC supply</strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">
                <p>Input power supply</p>
            </td>
            <td>
                <p>100~240VAC<p>
            </td>
            <td>
                <p>24VDC -15%~+20%</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Power supply frequency</p>
            </td>
            <td>
                <p>50~60Hz</p>
            </td>
            <td>
                <p>---</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Instant surge</p>
            </td>
            <td>
                <p>MAX 20A 1.5ms @220VAC</p>
            </td>
            <td>
                <p>MAX 20A 1.5ms @24VDC</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Power output</p>
            </td>
            <td>
                <p>MAX 25VA</p>
            </td>
            <td>
                <p>---</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Permit Power supply lost<p>
            </td>
            <td>
                <p>20ms within @220VAC</p>
            </td>
            <td>
                <p>10ms within</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Fuse capacity</p>
            </td>
            <td>
                <p>2A, 250V<p>
            </td>
            <td>
                <p>2A, 250V</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Action (working) specification</p>
            </td>
            <td>
                <p>When input power's volatge rise to 95~100VAC, PLC will be run, when input power volatge drop down to 70VAC, PLC will be stoped.</p>
            </td>
            <td>
                <p>---</p>
            </td>
        </tr>
        <tr>
            <td rowspan="3">
                <p>Output power supply</p>
            </td>
            <td>
                <p>5VDC for CPU</p>
            </td>
            <td>
                <p>5V, -2%~+2%, 1.2A(maximum)</p>
            </td>
            <td>
                <p>5V, -2%~+2%, 1.2A(maximum)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>24VDC power supply for output and extend modules</p>
            </td>
            <td>
                <p>24V, -15%~+15%, 500 mA(maximum)</p>
            </td>
            <td>
                <p>24V, -15%~+15%, 500mA(maximum)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>24VDC power supply for input and external device</p>
            </td>
            <td>
                <p>24V, -15%~+15%, 200mA(maximum)</p>
            </td>
            <td>
                <p>Direct use the 24VDC input power supply</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Isolation model</p>
            </td>
            <td>
                <p>Transformer/photoelectricity isolation, 1500VAC/1 minute</p>
            </td>
            <td>
                <p>No electrical isolation</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Protect the power supply</p>
            </td>
            <td>
                <p>24VDC output over the limit of the current<p>
            </td>
            <td>
                <p>DC power input polar against. over volatge</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong>2. Product environment specification</strong></p>
<table>
    <thead>
        <tr>
            <td>
                <p><strong>Item</strong></p>
            </td>
            <td>
                <p><strong> Environment specification</strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Temperature/Humidity</p>
            </td>
            <td>
                <p>Working temperature: 0 ~ + 55 ? storage temperature: - 25 ~ + 70 ? and humidity: 5 ~ 95% RH, no condensation</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Anti vibration</p>
            </td>
            <td>
                <p>10~57Hz range 0.075mm, 57Hz~150Hz acceleration 1G, X. Y. Z three axis 10 times each direction</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Anti shock</p>
            </td>
            <td>
                <p>15G, contiune 11ms, X. Y. Z three axis 6 times each direction</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Anti jamming<p>
            </td>
            <td>
                <p>AC EFT: ?2500V, surge: ?2500V, DC EFT: ?500V, surge: ?000V</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Over volatge capability</p>
            </td>
            <td>
                <p>Between AC terminal and PE terminal 1500VAC, 1min, Between DC terminal and PE terminal 500VAC, 1min</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Insulation impedance</p>
            </td>
            <td>
                <p>Between AC terminal and PE terminal@500VDC, &gt;=5M?(Between all input/output terminal and PE terminal@500VDC)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Earth</p>
            </td>
            <td>
                <p>The third grounding(Can not connect to the strong power system? earth)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Operation environment</p>
            </td>
            <td>
                <p>Operated where no dust, moisture, corrosion, electrical shock and physical shock, etc.</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong>3. Digital input (DI)specification</strong></p>
<table>
    <thead>
        <tr>
            <td>
                <p><strong>Item</strong></p>
            </td>
            <td>
                <p><strong> Digital input DI</strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Input signal<p>
            </td>
            <td>
                <p>Non-voltage contact or NPN/PNP contact</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Action driving</p>
            </td>
            <td>
                <p>ON: 3.5 mA above OFF: below 1.5 mA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Input impedance</p>
            </td>
            <td>
                <p>About 4.3K?</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Input maximum current</p>
            </td>
            <td>
                <p>10mA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Response time</p>
            </td>
            <td>
                <p>Default 6.4ms, Configurable 0.8~51.2ms</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Isolation mode</p>
            </td>
            <td>
                <p>Each Channel optical isolation</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Input indication</p>
            </td>
            <td>
                <p>LED light means ON, dark means OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Power supply</p>
            </td>
            <td>
                <p>PLC internal power supply:DC power(sink or source)5.3mA@24VDC</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong>4. Digital output (DO)specification</strong></p>
<table>
    <thead>
        <tr>
            <td colspan="2">
                <p><strong>Item</strong></p>
            </td>
            <td>
                <p><strong>Relay output-R</strong></p>
            </td>
            <td>
                <p><strong> NPN or PNP transistor output -T/P </strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="3">
                <p>maximum load</p>
            </td>
            <td>
                <p>Resistance load</p>
            </td>
            <td>
                <p>2A/1 point, 8A/4 point per COM</p>
            </td>
            <td>
                <p>0.5A/1 point, 2A/4 point per COM</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Inductive load</p>
            </td>
            <td>
                <p>50VA</p>
            </td>
            <td>
                <p>5W/24VDC</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Light load</p>
            </td>
            <td>
                <p>100W</p>
            </td>
            <td>
                <p>12W/24VDC</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Min. load</p>
            </td>
            <td>
                <p>10mA</p>
            </td>
            <td>
                <p>2mA</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Voltage specification</p>
            </td>
            <td>
                <p>Below 250VAC, 30VDC</p>
            </td>
            <td>
                <p>30VDC</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Drive capability</p>
            </td>
            <td>
                <p>Maximum 5A/250VAC</p>
            </td>
            <td>
                <p>MAX 1A 10S</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Response time</p>
            </td>
            <td>
                <p>Off-on 10ms, On-off 5ms</p>
            </td>
            <td>
                <p>Off-On 10us, On-Off 120us</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Leakage current when route opened<p>
            </td>
            <td>
                <p>---</p>
            </td>
            <td>
                <p>Below 0.1mA</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Isolation mode</p>
            </td>
            <td>
                <p>Mechanical isolation</p>
            </td>
            <td>
                <p>Each Channel optical isolation</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Output indication</p>
            </td>
            <td colspan="2">
                <p>LED light means ON, dark means OFF</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Power supply</p>
            </td>
            <td colspan="2">
                <p>PLC internal power supply 24VDC</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong>5. Analog input (AI)specification</strong></p>
<table>
    <thead>
        <tr>
            <td>
                <p><strong>Item</strong></p>
            </td>
            <td colspan="4">
                <p><strong> Voltage input</strong></p>
            </td>
            <td colspan="2">
                <p><strong> Current input</strong></p>
            </td>
            <td>
                <p><strong> RTD input</strong></p>
            </td>
            <td>
                <p><strong> Thermocouple Input</strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Input range</p>
            </td>
            <td>
                <p>-10V~+10V</p>
            </td>
            <td>
                <p>0V~+10V</p>
            </td>
            <td>
                <p>0V~+5V</p>
            </td>
            <td>
                <p>1V~+5V</p>
            </td>
            <td>
                <p>0~20mA</p>
            </td>
            <td>
                <p>4~20mA</p>
            </td>
            <td>
                <p>Pt100. Pt1000. Cu50. Cu100</p>
            </td>
            <td>
                <p>S. K. T. E. J. B. N. R. Wre3/25. Wre5/26. [0-20]mV. [0-50]mV. [0-100]mV</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Resolution</p>
            </td>
            <td>
                <p>5mV</p>
            </td>
            <td>
                <p>2.5mV</p>
            </td>
            <td>
                <p>1.25mV</p>
            </td>
            <td>
                <p>1.25mV</p>
            </td>
            <td>
                <p>5uA</p>
            </td>
            <td>
                <p>5uA</p>
            </td>
            <td>
                <p>0.1?</p>
            </td>
            <td>
                <p>0.1?</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Input impedance</p>
            </td>
            <td colspan="4">
                <p>6M?</p>
            </td>
            <td colspan="2">
                <p>250?</p>
            </td>
            <td>
                <p>6M?</p>
            </td>
            <td>
                <p>6M?</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Maximum input range</p>
            </td>
            <td colspan="4">
                <p>?3V</p>
            </td>
            <td colspan="2">
                <p>?0mA</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>?V</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Input indication</p>
            </td>
            <td colspan="8">
                <p>LED light means normal, dark means break OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Response time</p>
            </td>
            <td colspan="6">
                <p>5ms/4 Channel<p>
            </td>
            <td colspan="2">
                <p>560ms/4 Channel, 880ms/8 Channel<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Digital input range</p>
            </td>
            <td colspan="6">
                <p>12 bits, Code range:0~32000(H series module 16 bits A/D convert)</p>
            </td>
            <td colspan="2">
                <p>16 bits, Code range:0~32000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Precision</p>
            </td>
            <td colspan="6">
                <p>0.2% F.S</p>
            </td>
            <td colspan="2">
                <p>0.1% F.S</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Power supply</p>
            </td>
            <td colspan="8">
                <p>MPU use internal power supply, extend module use external power supply 24VDC ?0% 5VA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Isolation mode</p>
            </td>
            <td colspan="8">
                <p>Opto-electric isolation, Non-isolation between Channel, between analog and digital is opto-electricisolation</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Power consumption</p>
            </td>
            <td colspan="6">
                <p>24VDC ?0%, 100mA(maximum)</p>
            </td>
            <td colspan="2">
                <p>24VDC ?0%, 50mA(maximum)</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong>6. Analog output(AO)specification</strong></p>
<table>
    <thead>
        <tr>
            <td>
                <p><strong>Item</strong></p>
            </td>
            <td colspan="4">
                <p><strong> Voltage output</strong></p>
            </td>
            <td colspan="2">
                <p><strong> Current output</strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Outputrange</p>
            </td>
            <td>
                <p>-10V~+10V</p>
            </td>
            <td>
                <p>0V~ +10V</p>
            </td>
            <td>
                <p>0V~+5V</p>
            </td>
            <td>
                <p>1V~+5V</p>
            </td>
            <td>
                <p>0~20mA</p>
            </td>
            <td>
                <p>4~20mA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Resolution</p>
            </td>
            <td>
                <p>5mV</p>
            </td>
            <td>
                <p>2.5mV</p>
            </td>
            <td>
                <p>1.25mV</p>
            </td>
            <td>
                <p>1.25mV</p>
            </td>
            <td>
                <p>5uA</p>
            </td>
            <td>
                <p>5uA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Output load impedance</p>
            </td>
            <td colspan="2">
                <p>1K?@10V</p>
            </td>
            <td colspan="2">
                <p>?500?@ 5V</p>
            </td>
            <td colspan="2">
                <p>?500?</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Output indication</p>
            </td>
            <td colspan="6">
                <p>LED light means normal<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Drive capabilit</p>
            </td>
            <td colspan="6">
                <p>10mA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Response time</p>
            </td>
            <td colspan="6">
                <p>3ms</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Digital output range</p>
            </td>
            <td colspan="6">
                <p>12 bits, Code range:0~32000(H series module 16 bits D/A convert)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Precision</p>
            </td>
            <td colspan="6">
                <p>0.2% F.S</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Power supply</p>
            </td>
            <td colspan="6">
                <p>MPU use internal power supply, extend module use external power supply 24VDC ?0% 5VA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Isolation mode</p>
            </td>
            <td colspan="6">
                <p>Opto-electric isolation, Non-isolation between Channel, between analog and digital is opto-electricisolation</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Power consumption</p>
            </td>
            <td colspan="6">
                <p>24VDC ?0%, 100mA(maximum)</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="Extend_module_parameter">Extend module parameter</h3>
<p><strong> 1?The parameter table of 4-channel analog extend module (Note:CR code is corresponding to the Modbus register address), the yellow parts are read-only, the other parts are readable and writable.</strong></p>
<table>
    <tbody>
        <tr>
            <td rowspan="2">
                <p><strong>CR Code</strong></p>
            </td>
            <td colspan="5">
                <p><strong>Function description</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><strong>S04AI</strong></p>
            </td>
            <td>
                <p><strong>S04AO</strong></p>
            </td>
            <td>
                <p><strong>S04XA</strong></p>
            </td>
            <td>
                <p><strong>H04RC</strong></p>
            </td>
            <td>
                <p><strong>H04TC</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>00H</p>
            </td>
            <td colspan="5">
                <p>The low byte is the module code, and the high byte is the module version number.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>01H</p>
            </td>
            <td colspan="5">
                <p>Communication address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>02H</p>
            </td>
            <td colspan="5">
                <p>Communication protocol: The low 4-bit of the low byte:0 - N, 8, 2 For RTU, 1 - E, 8, 1 For RTU, 2 - O, 8, 1 For RTU, 3 - N, 7, 2 For ASCII, 4 - E, 7, 1 For ASCII, 5 - O, 7, 1 For ASCII, 6 - N, 8, 1 For RTU<p>
                <p>The high 4-bit of the low byte: 0 ?2400, 1 ?4800, 2 ?9600, 3 ?19200, 4 ?38400, 5 ?57600, 6 - 115200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>03H~06H</p>
            </td>
            <td colspan="5">
                <p>Extend module name</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>07H~08H</p>
            </td>
            <td colspan="5">
                <p>Default IP address: 192.168.1.111</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>09~0AH</p>
            </td>
            <td colspan="5">
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0BH</p>
            </td>
            <td colspan="5">
                <p>High byte subnet mask (b3~b0, 1 indicates 255, 0 indicates 0, for example subnet mask 255.255.255.0, b3~b0=1110), low byte reserved</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0CH~0EH</p>
            </td>
            <td colspan="5">
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0FH</p>
            </td>
            <td colspan="5">
                <p>Error code: 0-Normal, 1-Illegal firmware identity, 2-Incomplete firmware, 3-System data access exception, 4-No external power supply</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10H</p>
            </td>
            <td>
                <p>Theinputvalue of channel1</p>
            </td>
            <td>
                <p>Theoutputvalue of channel1</p>
            </td>
            <td>
                <p>Theinputvalue of channel1</p>
            </td>
            <td>
                <p>Theinputvalue of channel1</p>
            </td>
            <td>
                <p>Theinputvalue of channel1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>11H</p>
            </td>
            <td>
                <p>Theinputvalue of channel2</p>
            </td>
            <td>
                <p>Theoutputvalue of channel2</p>
            </td>
            <td>
                <p>Theinputvalue of channel2</p>
            </td>
            <td>
                <p>Theinputvalue of channel2</p>
            </td>
            <td>
                <p>Theinputvalue of channel2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>12H</p>
            </td>
            <td>
                <p>Theinputvalue of channel3</p>
            </td>
            <td>
                <p>Theoutputvalue of channel3</p>
            </td>
            <td>
                <p>The signal type of input channel 1, note 2</p>
            </td>
            <td>
                <p>Theinputvalue of channel3</p>
            </td>
            <td>
                <p>Theinputvalue of channel3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>13H</p>
            </td>
            <td>
                <p>Theinputvalue of channel4</p>
            </td>
            <td>
                <p>Theoutputvalue of channel4</p>
            </td>
            <td>
                <p>The signal type of input channel 2, note 2</p>
            </td>
            <td>
                <p>Theinputvalue of channel4</p>
            </td>
            <td>
                <p>Theinputvalue of channel4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>14H</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 2</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>15H</p>
            </td>
            <td>
                <p>The signal type of channel 2, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 2, note 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of input channel 1</p>
            </td>
            <td>
                <p>The signal type of channel 2, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 2, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>16H</p>
            </td>
            <td>
                <p>The signal type of channel 3, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 3, note 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of input channel 2</p>
            </td>
            <td>
                <p>The signal type of channel 3, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 3, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>17H</p>
            </td>
            <td>
                <p>The signal type of channel 4, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 4, note 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of input channel 1</p>
            </td>
            <td>
                <p>The signal type of channel 4, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 4, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>18H</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>The upper limit in engineering value of input channel 2</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>19H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The samplingfrequency of input channel 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1AH</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The samplingfrequency of input channel 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1BH</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>zero point correction value of input channel 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1CH</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>zero point correction value of input channel 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1DH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>Channel 1~2 input disconnection alarm, note 5<p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1EH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The output value of output channel<p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1FH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The output value of channel 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>20H</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The signal type of output channel 1, note 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>21H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 1, note 1</p>
            </td>
            <td>
                <p>Power-off output mark, note 8</p>
            </td>
            <td>
                <p>The signal type of output channel 2, note 2</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 1, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 1, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>22H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 2, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 1<p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6<p>
            </td>
            <td>
                <p>The samplingfrequency of channel 2, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 2, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>23H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 2, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 2<p>
            </td>
            <td>
                <p>The lower limit in engineering value of output channel 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 3, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 3, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>24H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 2, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 3</p>
            </td>
            <td>
                <p>The lower limit in engineering value of output channel 2</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 4, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 4, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>25H</p>
            </td>
            <td>
                <p>The zero point correction value of channel 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 4</p>
            </td>
            <td>
                <p>The upper limit in engineering value of output channel 1</p>
            </td>
            <td>
                <p>The zero point correction value of channel 1</p>
            </td>
            <td>
                <p>The zero point correction value of channel 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>26H</p>
            </td>
            <td>
                <p>The zero point correction value of channel 1</p>
            </td>
            <td>
                <p>Channel indicator status, note 7<p>
            </td>
            <td>
                <p>The upper limit in engineering value of output channel 2</p>
            </td>
            <td>
                <p>The zero point correction value of channel 2</p>
            </td>
            <td>
                <p>The zero point correction value of channel 2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>27H</p>
            </td>
            <td>
                <p>The zero point correction value of channel 3</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p>The power-off output mark, note 8</p>
            </td>
            <td>
                <p>The zero point correction value of channel 3</p>
            </td>
            <td>
                <p>The zero point correction value of channel 3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>28H</p>
            </td>
            <td>
                <p>The zero point correction value of channel 4</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>The power-off output value of output channel 1<p>
            </td>
            <td>
                <p>The zero point correction value of channel 4</p>
            </td>
            <td>
                <p>The zero point correction value of channel 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>29H</p>
            </td>
            <td>
                <p>Channel 1~4 input disconnection alarm, note 5<p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>The power-off output value of output channel 2</p>
            </td>
            <td>
                <p>Channel 1~4 input disconnection alarm, note 5</p>
            </td>
            <td>
                <p>Channel 1~4 input disconnection alarm, note 5</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2AH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>The output channel indicator, note 7</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2BH~2FH</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
    </tbody>
</table>
<p>Note: 1?samplingfrequency:0 - 2 times?1 - 4 times?2 - 8 times?3 - 16 times?4 - 32 times?5 - 64 times?6 - 128 times?7 - 256 times</p>
<p>2?Signal type:0 - [4, 20]mA?1 - [0, 20]mA ?2 - [1, 5]V?3 - [0, 5]V?4 - [0, 10]V?5 - [-10, 10]V</p>
<p>3?The signal type of thermal resistance:0 - Pt100?1 - Pt1000?2 - Cu50?3 - Cu100</p>
<p>4?The signal type of thermocouple:0 - S?1 - K?2 - T?3 - E?4 - J?5 - B?6 - N?7 - R?8 ?Wre3/25?9- Wre5/26?10 - [0, 20]mV?11 - [0, 50]mV?12 - [0, 100]mV</p>
<p>5?Disconnection alarm:Each bit indicates 1 channel, 0-normal, 1-disconnection</p>
<p>6?Use the engineering value mark:Each bit indicates 1 channel, 0-No, 1-Yes</p>
<p>7?Channel indicator status:Each bit indicates 1 channel, 0-off, 1-on</p>
<p>8?Power-off output mark:Each bit indicates 1 channel, 0-No, 1-Yes</p>
<p><strong>2?The parameter table of 8-channel analog extend module (Note:CR code is corresponding to the Modbus register address), the yellow parts are read-only, the other parts are readable and writable.</strong></p>
<table>
    <tbody>
        <tr>
            <td rowspan="2">
                <p><strong>CR code</strong></p>
            </td>
            <td colspan="5">
                <p><strong>Function description</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><strong>S08AI</strong></p>
            </td>
            <td>
                <p><strong>S08AO</strong></p>
            </td>
            <td>
                <p><strong>S08XA</strong></p>
            </td>
            <td>
                <p><strong>H08RC</strong></p>
            </td>
            <td>
                <p><strong>H08TC</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>00H</p>
            </td>
            <td colspan="5">
                <p>The low byte is the module code, and the high byte is the module version number.<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>01H</p>
            </td>
            <td colspan="5">
                <p>Communication address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>02H</p>
            </td>
            <td colspan="5">
                <p>Communication protocol: The low 4-bit of the low bytes:0 - N, 8, 2 For RTU, 1 - E, 8, 1 For RTU, 2 - O, 8, 1 For RTU, 3 - N, 7, 2 For ASCII, 4 - E, 7, 1 For ASCII, 5 - O, 7, 1 For ASCII, 6 - N, 8, 1 For RTU<p>
                <p>The high 4-bit of the low bytes: 0 ?2400, 1 ?4800, 2 ?9600, 3 ?19200, 4 ?38400, 5 ?57600, 6 - 115200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>03H~06H</p>
            </td>
            <td colspan="5">
                <p>Extend module name</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>07H~08H</p>
            </td>
            <td colspan="5">
                <p>Default IP address: 192.168.1.111</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>09~0AH</p>
            </td>
            <td colspan="5">
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0BH</p>
            </td>
            <td colspan="5">
                <p>High byte subnet mask(b3~b0, 1 indicates 255, 0 indicates 0, for example, subnet mask 255.255.255.0, b3~b0=1110), low byte Reserved</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0CH~0EH</p>
            </td>
            <td colspan="5">
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0FH</p>
            </td>
            <td colspan="5">
                <p>Error code: 0-Normal, 1-Illegally firmware identity, 2-Incomplete firmware, 3-System data access exception, 4-No external power supply<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10H</p>
            </td>
            <td>
                <p>Theinputvalue of channel1</p>
            </td>
            <td>
                <p>Theoutputvalue of channel1</p>
            </td>
            <td>
                <p>Theinputvalue of channel1</p>
            </td>
            <td>
                <p>Theinputvalue of channel1</p>
            </td>
            <td>
                <p>Theinputvalue of channel1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>11H</p>
            </td>
            <td>
                <p>Theinputvalue of channel2</p>
            </td>
            <td>
                <p>Theoutputvalue of channel2</p>
            </td>
            <td>
                <p>Theinputvalue of channel2</p>
            </td>
            <td>
                <p>Theinputvalue of channel2</p>
            </td>
            <td>
                <p>Theinputvalue of channel2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>12H</p>
            </td>
            <td>
                <p>Theinputvalue of channel3</p>
            </td>
            <td>
                <p>Theoutputvalue of channel3</p>
            </td>
            <td>
                <p>Theinputvalue of channel3</p>
            </td>
            <td>
                <p>Theinputvalue of channel3</p>
            </td>
            <td>
                <p>Theinputvalue of channel3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>13H</p>
            </td>
            <td>
                <p>Theinputvalue of channel4</p>
            </td>
            <td>
                <p>Theoutputvalue of channel4</p>
            </td>
            <td>
                <p>Theinputvalue of channel4</p>
            </td>
            <td>
                <p>Theinputvalue of channel4</p>
            </td>
            <td>
                <p>Theinputvalue of channel4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>14H</p>
            </td>
            <td>
                <p>Theinputvalue of channel5</p>
            </td>
            <td>
                <p>Theoutputvalue of channel5</p>
            </td>
            <td>
                <p>The signal type of intput channel 1, note 2</p>
            </td>
            <td>
                <p>Theinputvalue of channel5</p>
            </td>
            <td>
                <p>Theinputvalue of channel5</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>15H</p>
            </td>
            <td>
                <p>Theinputvalue of channel6</p>
            </td>
            <td>
                <p>Theoutputvalue of channel6</p>
            </td>
            <td>
                <p>The signal type of intput channel 2, note 2</p>
            </td>
            <td>
                <p>Theinputvalue of channel6</p>
            </td>
            <td>
                <p>Theinputvalue of channel6</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>16H</p>
            </td>
            <td>
                <p>Theinputvalue of channel7</p>
            </td>
            <td>
                <p>Theoutputvalue of channel7</p>
            </td>
            <td>
                <p>The signal type of intput channel 3, note 2</p>
            </td>
            <td>
                <p>Theinputvalue of channel7</p>
            </td>
            <td>
                <p>Theinputvalue of channel7</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>17H</p>
            </td>
            <td>
                <p>Theinputvalue of channel8</p>
            </td>
            <td>
                <p>Theoutputvalue of channel8</p>
            </td>
            <td>
                <p>The signal type of intput channel 4, note 2</p>
            </td>
            <td>
                <p>Theinputvalue of channel8</p>
            </td>
            <td>
                <p>Theinputvalue of channel8</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>18H</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 2</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>19H</p>
            </td>
            <td>
                <p>The signal type of channel 2, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 2, note 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of input channel 1</p>
                <p></p>
            </td>
            <td>
                <p>The signal type of channel 2, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 2, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1AH</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 1, note 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of input channel 2</p>
                <p></p>
            </td>
            <td>
                <p>The signal type of channel 3, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 3, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1BH</p>
            </td>
            <td>
                <p>The signal type of channel 4, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 4, note 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of input channel 3</p>
                <p></p>
            </td>
            <td>
                <p>The signal type of channel 4, note 3</p>
                <p></p>
            </td>
            <td>
                <p>The signal type of channel 4, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1CH</p>
            </td>
            <td>
                <p>The signal type of channel 5, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 5, note 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of input channel 4</p>
            </td>
            <td>
                <p>The signal type of channel 5, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 5, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1DH</p>
            </td>
            <td>
                <p>The signal type of channel 6, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 6, note 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of input channel 1</p>
            </td>
            <td>
                <p>The signal type of channel 6, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 6, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1EH</p>
            </td>
            <td>
                <p>The signal type of channel 7, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 7, note 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of input channel 2</p>
            </td>
            <td>
                <p>The signal type of channel 7, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 7, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1FH</p>
            </td>
            <td>
                <p>The signal type of channel 8, note 2</p>
            </td>
            <td>
                <p>The signal type of channel 8, note 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of input channel 3</p>
            </td>
            <td>
                <p>The signal type of channel 8, note 3</p>
            </td>
            <td>
                <p>The signal type of channel 8, note 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>20H</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>The upper limit in engineering value of input channel 4</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>21H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The samplingfrequency of input channel 1, note 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>22H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The samplingfrequency of input channel 2, note 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>23H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The samplingfrequency of input channel 3, note 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>24H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The samplingfrequency of input channel 4, note 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>25H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 5</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 5</p>
            </td>
            <td>
                <p>The zero point correction value of input channel 1</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 5</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 5</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>26H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 6</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 6</p>
            </td>
            <td>
                <p>The zero point correction value of input channel 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 6</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 6</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>27H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 7</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 7</p>
            </td>
            <td>
                <p>The zero point correction value of input channel 3</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 7</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 7</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>28H</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 8</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 7</p>
            </td>
            <td>
                <p>The zero point correction value of input channel 4</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 8</p>
            </td>
            <td>
                <p>The lower limit in engineering value of channel 8</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>29H</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>Channel 1~4 input disconnection alarm, note 5<p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2AH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The output value of output channel 1<p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2BH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The output value of output channel 2</p>
                <p></p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 3</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2CH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The output value of output channel 3</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 4</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2DH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 5</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 5</p>
            </td>
            <td>
                <p>The output value of output channel 4</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 5</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 5</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2EH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 6</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The signal type of output channel 1, note 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 6</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 6</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2FH</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 7</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 7</p>
            </td>
            <td>
                <p></p>
                <p>The signal type of output channel 2, note 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 7</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 7</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>30H</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 8</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 1</p>
            </td>
            <td>
                <p>The signal type of output channel 3, note 2</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 8</p>
            </td>
            <td>
                <p>The upper limit in engineering value of channel 8</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>31H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 1, note 1</p>
            </td>
            <td>
                <p>Power-off output mark, note 8</p>
            </td>
            <td>
                <p>The signal type of output channel 4, note 2</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 1, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 1, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>32H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 2, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 1<p>
            </td>
            <td>
                <p>Use the engineering value mark, note 6</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 2, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 2, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>33H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 3, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 2</p>
            </td>
            <td>
                <p>The lower limit in engineering value of output channel 1<p>
                <p></p>
            </td>
            <td>
                <p>The samplingfrequency of channel 3, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 3, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>34H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 4, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 3</p>
            </td>
            <td>
                <p>The lower limit in engineering value of output channel 2</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 4, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 4, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>35H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 5, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 4</p>
            </td>
            <td>
                <p>The lower limit in engineering value of output channel 3</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 5, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 5, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>36H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 6, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 5</p>
            </td>
            <td>
                <p>The lower limit in engineering value of output channel 4</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 6, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 6, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>37H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 7, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 6</p>
            </td>
            <td>
                <p>The upper limit in engineering value of output channel 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 7, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 7, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>38H</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 8, note 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 7</p>
            </td>
            <td>
                <p>The upper limit in engineering value of output channel 2</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 8, note 1</p>
            </td>
            <td>
                <p>The samplingfrequency of channel 8, note 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>39H</p>
            </td>
            <td>
                <p>The zero point correction value of channel 1</p>
            </td>
            <td>
                <p>The power-off output value of channel 8<p>
            </td>
            <td>
                <p>The upper limit in engineering value of output channel 3</p>
            </td>
            <td>
                <p>The zero point correction value of channel 1</p>
            </td>
            <td>
                <p>The zero point correction value of channel 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3AH</p>
            </td>
            <td>
                <p>The zero point correction value of channel 2</p>
            </td>
            <td>
                <p>Channel indicator status, note 7<p>
            </td>
            <td>
                <p>The upper limit in engineering value of output channel 4</p>
            </td>
            <td>
                <p>The zero point correction value of channel 2</p>
            </td>
            <td>
                <p>The zero point correction value of channel 2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3BH</p>
            </td>
            <td>
                <p>The zero point correction value of channel 3</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p>The power-off output mark, note 8</p>
            </td>
            <td>
                <p>The zero point correction value of channel 3</p>
            </td>
            <td>
                <p>The zero point correction value of channel 3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3CH</p>
            </td>
            <td>
                <p>The zero point correction value of channel 4</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>The power-off output value of output channel 1<p>
            </td>
            <td>
                <p>The zero point correction value of channel 4</p>
            </td>
            <td>
                <p>The zero point correction value of channel 4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3DH</p>
            </td>
            <td>
                <p>The zero point correction value of channel 5</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>The power-off output value of output channel 2</p>
            </td>
            <td>
                <p>The zero point correction value of channel 5</p>
            </td>
            <td>
                <p>The zero point correction value of channel 5</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3EH</p>
            </td>
            <td>
                <p>The zero point correction value of channel 6</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>The power-off output value of output channel 3</p>
            </td>
            <td>
                <p>The zero point correction value of channel 6</p>
            </td>
            <td>
                <p>The zero point correction value of channel 6</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3FH</p>
            </td>
            <td>
                <p>The zero point correction value of channel 7</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>The power-off output value of output channel 4</p>
            </td>
            <td>
                <p>The zero point correction value of channel 7</p>
            </td>
            <td>
                <p>The zero point correction value of channel 7</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>40H</p>
            </td>
            <td>
                <p>The zero point correction value of channel 8</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Output channel indicator, note 7</p>
            </td>
            <td>
                <p>The zero point correction value of channel 8</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>41H</p>
            </td>
            <td>
                <p>Channel 1~8 input disconnection alarm, note 5</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p>Channel 1~8 input disconnection, note 5<p>
            </td>
            <td>
                <p>Channel 1~8 input disconnection alarm, note 5</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>42H~4FH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
    </tbody>
</table>
<p>Note: 1?samplingfrequency:0 - 2 times?1 - 4 times?2 - 8 times?3 - 16 times?4 - 32 times?5 - 64 times?6 - 128 times?7 - 256 times</p>
<p>2?Signal type:0 - [4, 20]mA?1 - [0, 20]mA ?2 - [1, 5]V?3 - [0, 5]V?4 - [0, 10]V?5 - [-10, 10]V</p>
<p>3?The signal type of thermal resistance:0 - Pt100?1 - Pt1000?2 - Cu50?3 - Cu100</p>
<p>4?The signal type of thermocouple:0 - S?1 - K?2 - T?3 - E?4 - J?5 - B?6 - N?7 - R?8 ?Wre3/25?9- Wre5/26?10 - [0, 20]mV?11 - [0, 50]mV?12 - [0, 100]mV</p>
<p>5?Disconnection alarm:Each bit indicates 1 channel, 0-normal, 1-disconnection</p>
<p>6?Use the engineering value mark:Each bit indicates 1 channel, 0-No, 1-Yes</p>
<p>7?Channel indicator status:Each bit indicates 1 channel, 0-off, 1-on</p>
<p>8?Power-off output mark:Each bit indicates 1 channel, 0-No, 1-Yes</p>
<p><strong>3?The parameter table of digital extend module (Note: CR code is corresponding to the Modbus register address, the yellow parts are read-only, the other parts are readable and writable.</strong></p>
<table>
    <tbody>
        <tr>
            <td rowspan="2">
                <p><strong>CR code</strong></p>
            </td>
            <td>
                <p><strong>Function description </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><strong> H16DI?H16DOR?H16DOT?H16XDR?H16XDT?H24DI?H24XDR?H24XDT ?H40DI?H36DOR?H36DOT?H40XDR?H40XDT?H64XDR?H64XDT</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>00H</p>
            </td>
            <td>
                <p>The low byte is the module code, and the high byte is the module version number.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>01H</p>
            </td>
            <td>
                <p>Communication address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>02H</p>
            </td>
            <td>
                <p>Communication protocols:The low 4-bit of the low bytes: 0 - N, 8, 2 For RTU, 1 - E, 8, 1 For RTU, 2 - O, 8, 1 For RTU, 3 - N, 7, 2 For ASCII, 4 - E, 7, 1 For ASCII, 5 - O, 7, 1 For ASCII, 6 - N, 8, 1 For RTU<p>
                <p>The high 4-bit of the low bytes: 0 ?2400, 1 ?4800, 2 ?9600, 3 ?19200, 4 ?38400, 5 ?57600, 6 - 115200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>03H~06H</p>
            </td>
            <td>
                <p>Extend module name</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>07H~08H</p>
            </td>
            <td>
                <p>Default IP address: 192.168.1.111<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>09~0AH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0BH</p>
            </td>
            <td>
                <p>High byte subnet mask (b3~b0, 1 indicates 255, 0 indicates 0, for example, subnet mask 255.255.255.0, b3~b0=1110), low byte reserved<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0CH~0EH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0FH</p>
            </td>
            <td>
                <p>Error code : 0-normal, 1-illegal firmware identity, 2-incomplete firmware, 3-system data access exception, 4-No external power supply<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10H~4FH</p>
            </td>
            <td>
                <p>DI channel 1~64 input value</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>50H~8FH</p>
            </td>
            <td>
                <p>DO channel 1~64 output value</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>90H</p>
            </td>
            <td>
                <p>Filtering time of DI ms, 0 - 0.8?1 - 1.6?2 - 3.2?3 - 6.4?4 - 12.8?5 - 25.6?6 - 51.2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>91H~9FH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong> 4? The parameter table of extend module H02PW (Note: CR code is corresponding to the Modbus register address, the yellow parts are read-only, the other parts are readable and writable.</strong></p>
<table>
    <tbody>
        <tr>
            <td>
                <p><strong>CR code</strong></p>
            </td>
            <td>
                <p><strong>Function description</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>00H</p>
            </td>
            <td>
                <p>The low byte is the module code, and the high byte is the module version number.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>01H</p>
            </td>
            <td>
                <p>Communication address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>02H</p>
            </td>
            <td>
                <p>Communitcation protocols:The low 4-bit of the low bytes: 0 - N, 8, 2 For RTU, 1 - E, 8, 1 For RTU, 2 - O, 8, 1 For RTU, 3 - N, 7, 2 For ASCII, 4 - E, 7, 1 For ASCII, 5 - O, 7, 1 For ASCII, 6 - N, 8, 1 For RTU<p>
                <p>The high 4-bit of the low bytes: 0 ?2400, 1 ?4800, 2 ?9600, 3 ?19200, 4 ?38400, 5 ?57600, 6 - 115200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>03H~06H</p>
            </td>
            <td>
                <p>Extend module name</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>07H~08H</p>
            </td>
            <td>
                <p>Default IP address: 192.168.1.111</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>09~0AH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0BH</p>
            </td>
            <td>
                <p>High byte subnet mask (b3~b0, 1 indicates 255, 0 indicates 0, for example, subnet mask 255.255.255.0, b3~b0=1110), low byte reserved<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0CH~0EH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0FH</p>
            </td>
            <td>
                <p>Error code: 0-normal, 1-illegal firmware identity, 2-incomplete firmware, 3-system data access exception, 4-No external power supply<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10H</p>
            </td>
            <td>
                <p>Voltage measured value of channel 1, unit: 0.01V</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>11H</p>
            </td>
            <td>
                <p>Electric current measured value of channel 1, unit: mA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>12H</p>
            </td>
            <td>
                <p>Voltage measured value of channel 2, unit: 0.01V</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>13H</p>
            </td>
            <td>
                <p>Electric current measured value of channel 2, unit: mA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>14H</p>
            </td>
            <td>
                <p>Voltage output value of channel 1, unit: 0.01V</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>15H</p>
            </td>
            <td>
                <p>Electric current output value of channel 1, unit: mA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>16H</p>
            </td>
            <td>
                <p>Voltage output value of channel 2, unit: 0.01V</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>17H</p>
            </td>
            <td>
                <p>Electric current output value of channel 2, unit: mA</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>18H</p>
            </td>
            <td>
                <p>PWM output cycle of channel 1, unit: ms</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>19H</p>
            </td>
            <td>
                <p>PWM output cycle of channel 2, unit: ms</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1AH</p>
            </td>
            <td>
                <p>PWM output duty cycle of channel 1, range: 0~1000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1BH</p>
            </td>
            <td>
                <p>PWM output duty cycle of channel 2, range: 0~1000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1CH~3FH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong> 5?The parameter table of digital temperature extend module (Note: CR code is corresponding to the Modbus register address, the yellow parts are read-only, the other parts are readable and writable.</strong></p>
<table>
    <tbody>
        <tr>
            <td>
                <p><strong>CR code</strong></p>
            </td>
            <td>
                <p><strong>H04DT function description</strong></p>
            </td>
            <td>
                <p><strong>CR code</strong></p>
            </td>
            <td>
                <p><strong>H32DT function description</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>00H</p>
            </td>
            <td colspan="3">
                <p>The low byte is the module code, and the high byte is the module version number.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>01H</p>
            </td>
            <td colspan="3">
                <p>Communication address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>02H</p>
            </td>
            <td colspan="3">
                <p>Communication protocols:The low 4-bit of the low bytes: 0 - N, 8, 2 For RTU, 1 - E, 8, 1 For RTU, 2 - O, 8, 1 For RTU, 3 - N, 7, 2 For ASCII, 4 - E, 7, 1 For ASCII, 5 - O, 7, 1 For ASCII, 6 - N, 8, 1 For RTU<p>
                <p>The high 4-bit of the low bytes: 0 ?2400, 1 ?4800, 2 ?9600, 3 ?19200, 4 ?38400, 5 ?57600, 6 - 115200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>03H~06H</p>
            </td>
            <td colspan="3">
                <p>Extend module name</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>07H~08H</p>
            </td>
            <td colspan="3">
                <p>Default IP address: 192.168.1.111</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>09~0AH</p>
            </td>
            <td colspan="3">
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0BH</p>
            </td>
            <td colspan="3">
                <p>High byte subnet mask (b3~b0, 1 indicates 255, 0 indicates 0, for example, subnet mask 255.255.255.0, b3~b0=1110), low byte reserved<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0CH~0EH</p>
            </td>
            <td colspan="3">
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>0FH</p>
            </td>
            <td colspan="3">
                <p>Error code : 0-normal, 1-illegal firmware identity, 2-incomplete firmware, 3-system data access exception, 4-No external power supply<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10H~13H</p>
            </td>
            <td>
                <p>Temperature input value of channel 1~4<p>
            </td>
            <td>
                <p>10H~1FH</p>
            </td>
            <td>
                <p>Temperature value in 1~16 path of channel 1<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>14H~17H</p>
            </td>
            <td>
                <p>Humidity input value of channel 1~4<p>
            </td>
            <td>
                <p>20H~2FH</p>
            </td>
            <td>
                <p>Temperature value in 1~16 path of channel 2<p>
            </td>
        </tr>
        <tr>
            <td>
                <p>18H~1BH</p>
            </td>
            <td>
                <p>Signal type of channel 1~4 ( 0 ?S18B20, RW1820, DS1990, 1-SHT1x, SHT7x )</p>
            </td>
            <td>
                <p>30H</p>
            </td>
            <td>
                <p>A/D data bits of channel 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1CH</p>
            </td>
            <td>
                <p>The using identification of engineering value<p>
            </td>
            <td>
                <p>31H</p>
            </td>
            <td>
                <p>A/D data bits of channel 2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1DH~20H</p>
            </td>
            <td>
                <p>The data lower-limit of channel 1~4<p>
            </td>
            <td>
                <p>32H</p>
            </td>
            <td>
                <p>Temperature disconnection alarm in 1~16 path of channel 1, each bit indicates 1 channel, 0- normal, 1- disconnection.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>21H~24H</p>
            </td>
            <td>
                <p>The data upper-limit of channel 1~4<p>
            </td>
            <td>
                <p>33H</p>
            </td>
            <td>
                <p>Temperature disconnection alarm in 1~16 path of channel 2, each bit indicates 1 channel, 0- normal, 1- disconnection.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>25H~28H</p>
            </td>
            <td>
                <p>A/D data bit of channel 1~4</p>
            </td>
            <td>
                <p>34H</p>
            </td>
            <td>
                <p>Configuration number of channel 1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>29H~2CH</p>
            </td>
            <td>
                <p>zero point correction of channel 1~4<p>
            </td>
            <td>
                <p>35H</p>
            </td>
            <td>
                <p>Configuration number of channel 2.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2DH</p>
            </td>
            <td>
                <p>Sensor disconnection alarm of channel 1~4, each bit indicates 1 channel, 0- normal, 1- disconnection<p>
            </td>
            <td>
                <p>36~75H</p>
            </td>
            <td>
                <p>The serial numbers in 1~16 path of channel 1, each serial number uses 4 registers.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2EH~2FH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p>76~B5H</p>
            </td>
            <td>
                <p>The serial numbers of 1~16 path of channel 2, each serial number uses 4 registers.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>30H~3FH</p>
            </td>
            <td>
                <p>The serial number of channel 1~4, each serial number uses 4 registers.</p>
            </td>
            <td>
                <p>B6~C5H</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>40H~4FH</p>
            </td>
            <td>
                <p>Reserve</p>
            </td>
            <td>
                <p>C6H</p>
            </td>
            <td>
                <p>Channel 1 clears the power-off counts in the configuration</p>
            </td>
        </tr>
        <tr>
            <td>
                <p></p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>C7H</p>
            </td>
            <td>
                <p>Channel 2 clears the power-off counts in the configuration</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="Indicator_declare">Indicator declare</h3>
<p><strong>?. CPU indicator declare</strong></p>
<p>1. POW:power indicator .green, constant light - power normal;Not light - Power abnormal.</p>
<p>2. RUN:Running indicator .green, constant light - PLC is running;Not light - PLC is stopping.</p>
<p>3. COM:communication indicator .green, flicker - communicating, flicker frequency signify the speed of the communication;Not loght - No communication.</p>
<p>4. ERR:Erroe indicator .double(red. yellow), as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p>Consult manage</p>
            </td>
            <td>
                <p>Signify information type</p>
            </td>
            <td>
                <p>ERR the state of the indicator</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Normal</p>
            </td>
            <td>
                <p>Without error</p>
            </td>
            <td>
                <p>Not light</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Normal, just prompt take attention to the locked data</p>
            </td>
            <td>
                <p>PLC have the component which locked</p>
            </td>
            <td>
                <p>Yellow flicker:On 0.2 seconds and Off 0.8 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Modificate the PLC hardward configure</p>
            </td>
            <td>
                <p>Problem in the soft seting, permit user keep on operate the user program</p>
            </td>
            <td>
                <p>Yellow flicker:On 0.2 seconds and Off 0.8 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Check module parallel bus (check the RTC battery; check extension module power supply)<br/>
                    ?
                </p>
            </td>
            <td>
                <p>Communication abnormal between modul, auto dislodge the abnormal module, permit user keep on operate the user program</p>
            </td>
            <td>
                <p>Yellow flicker:On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Upgrade the fireware or modify the user program</p>
            </td>
            <td>
                <p>Fireware abnormal or user program abnormal, can not operate the user program</p>
            </td>
            <td>
                <p>Red slowly flicker:indicator light 0.5s not light 0.5s</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Maintain</p>
            </td>
            <td>
                <p>Hardware error, user program con not running</p>
            </td>
            <td>
                <p>yellow constant light</p>
            </td>
        </tr>
    </tbody>
</table>
<p>Note:the specific error code please check the system register SV3, error code corresponding the content see detail the " system error code table".</p>
<p><strong>?. Extend module ndicator declare</strong></p>
<p>1. POW:power indicator .green, constant light -Power normal;Not light - Power error.</p>
<p>2. LINK:many state indicator .three colors(Red. Yellow. Green), as follow:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p>Consult manage</p>
            </td>
            <td>
                <p>Module bus state</p>
            </td>
            <td>
                <p>LINK the state of the indicator</p>
            </td>
        </tr>
        <tr>
            <td rowspan="3">
                <p>Normal</p>
            </td>
            <td>
                <p>Module no communication</p>
            </td>
            <td>
                <p>Not light</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>MPU identification the module but have not communication</p>
            </td>
            <td>
                <p>Green constant light</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Serial or parallel communicating</p>
            </td>
            <td>
                <p>Green flicker:indicator light 30ms not light 30ms</p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p>parallel power supply not enough, must connect to external power supply</p>
            </td>
            <td>
                <p>Without serial or parallel communicate</p>
            </td>
            <td>
                <p>Yellow flicker:indicator light 0.5s not light0.5s</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>With serial or parallel communicate</p>
            </td>
            <td>
                <p>Yellow dark and shake alternately:indicator not light 0.5s shark 0.5s</p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p>Upgrade the fireware fail, reupgrade the fireware of the module</p>
            </td>
            <td>
                <p>Without serial or parallel communicate</p>
            </td>
            <td>
                <p>Red flicker:indicator light 0.5s not light 0.5s</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>With serial or parallel communicate</p>
            </td>
            <td>
                <p>Red dark and shake alternately:indicator not dark 0.5s shark 0.5s</p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p>Maintain</p>
            </td>
            <td>
                <p>Without serial or parallel communicate</p>
            </td>
            <td>
                <p>Red constant light</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>With serial or parallel communicate</p>
            </td>
            <td>
                <p>Red shark quickly:indicator light 30ms not light 30ms</p>
            </td>
        </tr>
    </tbody>
</table>
<p></p>
<p>Note:the specific error code please check the module parameter register CR15, error code corresponding the content see detail the " CR parameter table".</p>
<p><strong>?. I/O indicator declare</strong></p>
<table>
    <tbody>
        <tr>
            <td>
                <p>I/O indicator type</p>
            </td>
            <td>
                <p>Indicate information</p>
            </td>
            <td>
                <p>the state of the indicator</p>
            </td>
        </tr>
        <tr>
            <td rowspan="3">
                <p>DI</p>
            </td>
            <td>
                <p>Without signal Input<p>
            </td>
            <td>
                <p>Not light</p>
            </td>
        </tr>
        <tr>
            <td>With signalInput </td>
            <td>Constant light</td>
        </tr>
        <tr>
            <td>Pulse signal input </td>
            <td>Flicker(high frequency often bright)</td>
        </tr>
        <tr>
            <td rowspan="3">
                <p>DO</p>
            </td>
            <td>
                <p>Without signal output</p>
            </td>
            <td>
                <p>Not light</p>
            </td>
        </tr>
        <tr>
            <td>With signal output</td>
            <td>Constant light</td>
        </tr>
        <tr>
            <td>Pulse signal output</td>
            <td>Flicker(high frequency often bright)</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p>AI</p>
            </td>
            <td>
                <p>Without signal Input<p>
            </td>
            <td>
                <p>Not light</p>
            </td>
        </tr>
        <tr>
            <td>With signal Input </td>
            <td>Constant light</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p>AQ</p>
            </td>
            <td>
                <p>Without signal output (Channel abnomal)</p>
            </td>
            <td>
                <p>Not light</p>
            </td>
        </tr>
        <tr>
            <td>With signal output</td>
            <td>Constant light</td>
        </tr>
    </tbody>
</table>
<h3 id="I_O_wiring_diagram">I/O wiring diagram</h3>
<p><strong>1. Digital Input (DI) wiring diagram</strong></p>
<p><img src="<?= $path_to_images ?>images/DI_NPN.gif"/></p>
<p><img src="<?= $path_to_images ?>images/DI_PNP.gif"/><p>
<p><strong>2. Digital output (DO)wiring diagram</strong></p>
<p><img src="<?= $path_to_images ?>images/DO_R.gif"/><p>
<p><strong>3. Analog input (AI)wiring diagram</strong></p>
<p><img src="<?= $path_to_images ?>images/AI_2V.gif"/><img src="<?= $path_to_images ?>images/AI_2I.gif"/><p>
<p><img src="<?= $path_to_images ?>images/AI_3V.gif"/> <img src="<?= $path_to_images ?>images/AI_3I.gif"/></p>
<p><img src="<?= $path_to_images ?>images/AI_4V.gif"/><img src="<?= $path_to_images ?>images/AI_4I.gif"/><p>
<p><strong>4. Analog output (AQ)wiring diagram</strong></p>
<p><img src="<?= $path_to_images ?>images/AQ_V.gif"/> <img src="<?= $path_to_images ?>images/AQ_I.gif"/><p>
<p><strong>5. Thermocouple Inputwiring diagram</strong></p>
<p><img src="<?= $path_to_images ?>images/TC_JXT.gif"/></p>
<p><strong>6. RTD Inputwiring diagram</strong></p>
<p><img src="<?= $path_to_images ?>images/RC_JXT.gif"/></p>
<p><strong>7. DS18B20, RW1820, DS1990 single or multiple sensor wiring diagram</strong></p>
<p><img src="<?= $path_to_images ?>images/DS18B20-s.gif"/> <img src="<?= $path_to_images ?>images/DS18B20-m.gif"/></p>
<p><strong>8. SHT1X or SHT7X sensor wiring diagram</strong></p>
<p><img src="<?= $path_to_images ?>images/SHT1X%20SHT7X.gif"/></p>
<h3 id="PLC_installation_and_precautions">PLC installation and precautions</h3>
<p>[PLC installation]</p>
<p>PLC be installed, must be in closed switching box, installed any mode, PLC must can heat dissipation well, prevent temperature build-up, the plc be sure not to installed near the bottom side. up side and in vertical direction, and keep space all around the PLC (as follows).</p>
<p><img src="<?= $path_to_images ?>images/Hardwa1.gif"/></p>
<p>1. Rail mount :the rail specification :standard 35mm rail.</p>
<p>2. Screw mount :each MPU or extend module have two screw fix hole, the diameter of the hole is 4.5mm, the position and distance please refer to the external dimension diagram.</p>
<p>3. Connect the extend module :extend module connect to the MPU by BUS, each extend module default comes with a extend cable when ex-factory for connect to the last module .Connection method : open tthe right expansion interface of the last module(MPU or extend module), insert the extend cable to the expansion interface, reset the renovate after fast the extend cable, the right expansion interface of the module for the next extend module.in this way connect all extend module.</p>
<p>[ power supply and earth]</p>
<p>PLC power supply divide into AC and DC, pay attention to as follows when use:</p>
<p>1. AC supply Input voltage is 100~240VAC 50/60Hz, two line of the power supply (power line and zero line) please connect to the L. N terminal blocks, please connect the power line (L) to the L terminal, connect the zero line to the N terminal.</p>
<p>2. DC supply Input voltage is 24VDC -15%~+20%, the positive and negative of the power supply connect +24V. 0V terminals.</p>
<p>3. if connect the AC110V or AC220V to +24V terminal or Input point terminals, the PLC will be damaged, please pay special attention to it.</p>
<p>4. Please connect the PLC to earth correctly, the diameter of the line must be above 1.6mm.</p>
<p>[Matters need attention]</p>
<p>1. Please don't mount the PLC within dust . lamblack . electric conduction dust and corrosivity or combustible gas .Please don't mount the PLC within the environment high temperature . moisture condensation .</p>
<p>2. The machine is a OPEN TYPE enclosure, so it must be used within the environment dustproof . moistureproof . anti-corrosionbe . safe against electric shock and impact of external forces .Must have safeguard procedures ( as: opened by special tools or key) prevent not maintenance personnel operated or unexpected shock the machine, cause dangerous and damage.</p>
<p>3. When holemaking the screw hole and wiring, don't drop-in the scrap iron or wire head to the machine, potential trigger fire hazard . fault or malfunction.</p>
<p>4. There is a seal cover the aspirail of the PLC when ex-factory, use for prevent dust or foreign bodies invaded, before wiring, don't wipe off, after wiring, before proceed power on the PLC, please evulsion the seal cover, in order to heat dissipation very well. Otherwise potential trigger fire hazard. fault or malfunction.</p>
<p>5. Please secure mount the connecting line and all kinds of the extend modules, bad contact potential malfunction.</p>
<p>6. Keep 50mm space all around the PLC, and far away the high voltage line and large electric power to the greatest extend.</p>