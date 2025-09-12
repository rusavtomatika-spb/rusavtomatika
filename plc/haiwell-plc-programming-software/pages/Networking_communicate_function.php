<h1 id="Networking_communicate_function">Networking communicate function</h1>
<hr>
<p>This section introduce Haiwell PLC networking communicate function.</p>
<h3 id="Feature">Feature</h3>
<p>1. <strong>Support many communication protocol</strong>: built-in Modbus RTU/ASCII protocol . freedom communication protocol and Haiwell corporation Haiwellbus high speed communication protocol .</p>
<p>2. <strong>Support 5 communication ports</strong>: all type MPU built-in 2 communication ports (RS-232 + RS-485), may be extended to 5 communication ports, each communication port may be mutual independence or simultaneously working, the same function of all communication port, all can use for program . upload download program. monitor . networking, all communication port support master or slave communicate mode .</p>
<p>3. <strong>Networking flexible</strong>: support 1:N. N:1. N:N networking mode, support all kinds of human-machine interface and configuration software, can be networking with the third part device which has communication function ( such as inverter . instrument. bar code scanner etc.).</p>
<p>4. <strong>Highly convenient communication instruction</strong>: make you whether use any communication protocol only need one communication instruction can complete complex communication function, programming simpleness, many communication instruction may be executed at the same time, need not be worried about communication port conflict . send receive control. communication interrupt handle etc. problem, may be mix use all kinds of protocol easy complete you need communication function.</p>
<p>5. <strong>Total communication instruction bring OUT output</strong>: may be express the communication instruction executed succeed and fail, may be explicit pointing communicate fail with the slave, expedience location debug and fault judge.</p>
<p>6. <strong>May be convenience netwoking with the third part communication instruction</strong>:support different baud rate . different protocol format . different manufacturer equipment networking in the the same 485 networking.</p>
<p>7. <strong>Extend module with communication port may be action a remote IO module</strong>: Haiwell PLC extend module built-in a RS485 communication port, already support parallel bus ( use extend bus connect to the parallel interface of the PLC MPU ) also support serial bus ( use communication instruction control remote module via RS485 communication port of MPU ), When expand via serial bus (remote IO module), don't limit by system expand point, may distributed installation .This very important for a large number of disperse digital or analog signal(temperature. humidity. differential pressure. blowing rate. flow. fan rotate speed. valve open degree etc. ) need be sampled and monitored in the system, easy realize distributed installation moreover no expand point limited, vastly improve control system configuration flexible and in the future expand capacity, reduce wire and work load of all kinds of signal, meanwhile reduce disturb because analog signal wire too long, save project invest cost.</p>
<p>8. <strong>Upper computer (HMI . configuration software etc. )use Modbus protocol access </strong>:Haiwell PLC action slave need no any communication program, each component corresponding Modbus communication address code refer to "
    <a href="/plc/haiwell-plc-programming-software/Appendix/#Communication_address_code_table">communication address code table </a>"</p>
<h3 id="Networking_schematic_diagram">Networking schematic diagram</h3>
<p>Haiwell PLC networking conveniency, support 1:N. N:1. N:N networking mode, networking schematic diagram as follows:</p>
<p>?. 1:N networking schematic diagram :</p>
<p><img src="<?= $path_to_images ?>images/link_1-n.gif" /></p>
<p>?. N:1 networking schematic diagram :</p>
<p><img src="<?= $path_to_images ?>images/link_n-1.gif" /></p>
<p>?. N:N many level networking schematic diagram :</p>
<p><img src="<?= $path_to_images ?>images/Link_n-n.gif" /></p>
<h3 id="Modbus_communication">Modbus communication</h3>
<p>Modbus is invent by Modicon( now is a brand under SCHNEIDER electric company ) in 1979 year, is a first industry local bus protocol in the whole word. For better popular and promote Modbus distributed use in base on ethernet, now SCHNEIDER electric company transfer Modbus protocol ownership to IDA (Interface for Distributed Automation, distributed automation interface) organization, and found Modbus-IDA organization, for Modbus develop in the future constitutes a solid basis .In CHINA, Modbus already become state standard GB/T19582-2008.Modbus protocol is a common language apply to electron controller .Via the protocol, among controller . controller via network( such as ethernet ) and among other device may be communicated .It become a common industry standard. because it, different manufacturer device may be connected form a industry network, proceed concentrate control.</p>
<p>Haiwell PLC built-in Modbus RTU/ASCII protocol, when the third part device (as inverter . servo controller. instrument etc.) support Modbus protocol, may be use Modbus protocol communicate with it, use
    <a href="/plc/haiwell-plc-programming-software/PLC_instruction_set/#MODR_Modbus_read">MODR</a> (Modbus read) instruction read data from slave and use
    <a href="/plc/haiwell-plc-programming-software/PLC_instruction_set/#MODW_Modbus_write">MODW</a> (Modbus write) instruction write data to slave .only 2 instructions, need no any checking program, it according to communication mode (RTU or ASCII) automatic verify the return data (CRC or LRC).</p>
<p>[E.X.]</p>
<p>PLC via 485 communication port networking with INOVANCE MD320 series inverter, use communication mode set frequency to inverter and read running frequency from inverter.</p>
<p>[Example program]<a href="<?= $path_to_images ?>program/HuiChuan%20MD320%20converter%20communication.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="??" /></a></p>
<p>1. According to INOVANCE MD320 series inverter communication protocol (please refer to INOVANCE MD320 series inverter manual communication section), preset frequency Modbus address is 4096, MODW instruction real time write V80 value to inverter.</p>
<p>2. Running frequency Modbus address is 4097, MODR instruction read current frequency from inverter and store to V82.</p>
<p>3. MODW. MODR instructions get electricity from busbar and all along executing, if continuous 3 second communication unsuccessful then generate communication fail alarm.</p>
<p><img src="<?= $path_to_images ?>images/Commun1.gif" /></p>
<h3 id="Haiwellbus_communication">Haiwellbus communication</h3>
<p>Haiwellbus is Haiwell company exploitation a efficient high speed communication protocol, have disperse or continuous . blended data (bit component. register component) transmittability, have high speed communication and communication efficiency, once communication maximum complete 30 pen data interactive, there is 2 Haiwellbus protocol communication instructions, are the
    <a href="/plc/haiwell-plc-programming-software/PLC_instruction_set/#HWRD_Haiwellbus_read">HWRD</a> (Haiwellbus read instruction, must define "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Haiwellbus_read_communication_table">Haiwellbus read communication table </a>") and
    <a href="/plc/haiwell-plc-programming-software/PLC_instruction_set/#HWWR_Haiwellbus_write">HWWR</a> (Haiwellbus write instruction, must define "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Haiwellbus_write_communication_table">Haiwellbus write communication table</a>").When single PLC control ability not enough or control equipment distance disperse, often need use many PLC proceed substation control, data interaction between each PLC according to the need .</p>
<p>Haiwell PLC have powerful networking function, data interaction between station may be use Haiwellbus protocol, also may be use standard Modbus protocol, whether use any protocol, slave station need no any program, only need read or write instruction at the master PLC. as follows:</p>
<p><img src="<?= $path_to_images ?>images/link_haiwellbus.gif" /></p>
<p>[E.X.]</p>
<p>2 PLC via 485 communication port networking, use Haiwellbus protocol to exchange data .</p>
<p>[Example program]<a href="<?= $path_to_images ?>program/Haiwellbus%20communication%20.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="??" /></a></p>
<p>1. Only 1#PLC write communication program, 2#PLC need no any communication program.if continuous 3 second communication unsuccessful then generate communication fail alarm.</p>
<p>2. Define Haiwellbus read communication table "read 2#PLC data" as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p><strong>Number</strong></p>
            </td>
            <td>
                <p><strong> Read data component from slave </strong></p>
            </td>
            <td>
                <p><strong>Data component wrote to master</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1</p>
            </td>
            <td>
                <p>X0</p>
            </td>
            <td>
                <p>M10</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2</p>
            </td>
            <td> X3</td>
            <td> M11</td>
        </tr>
        <tr>
            <td>
                <p>3</p>
            </td>
            <td>
                <p>V11</p>
            </td>
            <td>
                <p>V80</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>V12</p>
            </td>
            <td>
                <p>V81</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>5</p>
            </td>
            <td>
                <p>AI0</p>
            </td>
            <td>
                <p>V20</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>6</p>
            </td>
            <td>
                <p>AI1</p>
            </td>
            <td>
                <p>V21</p>
            </td>
        </tr>
    </tbody>
</table>
<p>3. Define Haiwellbus write communication table " write 2#PLC data" as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p><strong>Number</strong></p>
            </td>
            <td>
                <p><strong> Read data component from master </strong></p>
            </td>
            <td>
                <p><strong> Data component wrote to slave</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1</p>
            </td>
            <td>
                <p>X0</p>
            </td>
            <td>
                <p>M100</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2</p>
            </td>
            <td> X1</td>
            <td> M101</td>
        </tr>
        <tr>
            <td>
                <p>3</p>
            </td>
            <td>
                <p>V0</p>
            </td>
            <td>
                <p>V100</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>V50</p>
            </td>
            <td>
                <p>V102</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>5</p>
            </td>
            <td>
                <p>Y4</p>
            </td>
            <td>
                <p>M0</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>6</p>
            </td>
            <td>
                <p>Y5</p>
            </td>
            <td>
                <p>Y0</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>7</p>
            </td>
            <td>
                <p>V60</p>
            </td>
            <td>
                <p>V200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>V61</p>
            </td>
            <td>
                <p>V201</p>
            </td>
        </tr>
    </tbody>
</table>
<p>4. HWRD. HWWR instructions get electricity from busbar and all along executing, according to above defined Haiwellbus read/write communication table, automatic data exchange with 2#PLC.</p>
<p><img src="<?= $path_to_images ?>images/Commun2.gif" /></p>
<h3 id="Freedom_communication">Freedom communication</h3>
<p>Haiwell PLC except support standard Modbus protocol and Haiwellbus protocol, also support flexible freedom protocol communication, whether slave equipment use any protocol, so long as know it protocol text may be communicate with it.</p>
<p>Freedom communication kernel is read slave communication protocol text, according to slave protocol demand send correct content (byte string) to slave, and receive response data from slave then according to the protocol proceed verify. decompose. account for correct result, specific refer to <a href="/plc/haiwell-plc-programming-software/PLC_instruction_set/#COMM_COMM_LB_Serial_communications">COMM</a>. <a href="/plc/haiwell-plc-programming-software/PLC_instruction_set/#RCV_Receive_communication_data">RCV</a>.
    <a href="/plc/haiwell-plc-programming-software/PLC_instruction_set/#XMT_XMT_LB_Sent_communication_data">XMT</a> instruction.</p>
<p>Below 2 reality communication example explain how to use the third part communication protocol realize freedom communication.</p>
<p>[Example ?]</p>
<p>PLC networking communicate with multifunction electric energy meter which accord with DLT-645 standard, read the meter constant ( active power ) and current active power total electric energy data value.</p>
<p>[Example ? program]<a href="<?= $path_to_images ?>program/DLT645%20standard%20multi-function%20meter%20communication.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="??" /></a></p>
<p>1. According to DLT-645 protocol rule, read the meter constant ( active power ) send command frame:68 07 05 06 00 00 00 68 01 02 63 F3 3B 16 total 14 bytes, meter constant ( active power ) identification coding :0xC030 + 0x3333 = 0xF363, command store at " read meter constant ( active power )" table.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p><strong>Number</strong></p>
            </td>
            <td>
                <p><strong> Component default value </strong></p>
            </td>
            <td>
                <p><strong> Declare </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1</p>
            </td>
            <td>
                <p>V1000=0x0068</p>
            </td>
            <td>
                <p>Start symbol</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2</p>
            </td>
            <td> V1001=0x0007</td>
            <td> Address</td>
        </tr>
        <tr>
            <td>
                <p>3</p>
            </td>
            <td>
                <p>V1002=0x0005</p>
            </td>
            <td>
                <p>Address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>V1003=0x0006</p>
            </td>
            <td>
                <p>Address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>5</p>
            </td>
            <td>
                <p>V1004=0x0000</p>
            </td>
            <td>
                <p>Address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>6</p>
            </td>
            <td> V1005=0x0000</td>
            <td> Address</td>
        </tr>
        <tr>
            <td>
                <p>7</p>
            </td>
            <td>
                <p>V1006=0x0000</p>
            </td>
            <td>
                <p>Address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>V1007=0x0068</p>
            </td>
            <td>
                <p>Start symbol</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>9</p>
            </td>
            <td>
                <p>V1008=0x0001</p>
            </td>
            <td>
                <p>Control code</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10</p>
            </td>
            <td>
                <p>V1009=0x0002</p>
            </td>
            <td>
                <p>Data lngth</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>11</p>
            </td>
            <td>
                <p>V1010=0x0063</p>
            </td>
            <td>
                <p>Identification code</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>12</p>
            </td>
            <td>
                <p>V1011=0x00F3</p>
            </td>
            <td>
                <p>Identification code</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>13</p>
            </td>
            <td>
                <p>V1012=0x003B</p>
            </td>
            <td>
                <p>Verify code</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>14</p>
            </td>
            <td>
                <p>V1013=0x0016</p>
            </td>
            <td>
                <p>End symbol</p>
            </td>
        </tr>
    </tbody>
</table>
<p>Program use COMM.LB instruction( low byte mode) send low byte of V1000~V1013 component receive, 17 bytes return data received store to V920~V928. If 17 bytes data which returned are :68 07 05 06 00 00 00 68 81 05 63 F3 97 33 33 BB 16, then meter constant ( active power ) V520=64.</p>
<p><img src="<?= $path_to_images ?>images/Commun3.gif" /></p>
<p>2. According to DLT-645 protocol rule, read current active power total electric energy send command frame:68 07 05 06 00 00 00 68 01 02 43 C3 EB 16 total 14 bytes, current active power total electric energy identification code:0x9010 + 0x3333 = 0xC343, store to " read current active power total meter constant " table.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p><strong>Number</strong></p>
            </td>
            <td>
                <p><strong> Component default value </strong></p>
            </td>
            <td>
                <p><strong> Declare </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1</p>
            </td>
            <td>
                <p>V1020=0x0068</p>
            </td>
            <td>
                <p>Start symbol</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2</p>
            </td>
            <td> V1021=0x0007</td>
            <td> Address</td>
        </tr>
        <tr>
            <td>
                <p>3</p>
            </td>
            <td>
                <p>V1022=0x0005</p>
            </td>
            <td>
                <p>Address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>V1023=0x0006</p>
            </td>
            <td>
                <p>Address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>5</p>
            </td>
            <td>
                <p>V1024=0x0000</p>
            </td>
            <td>
                <p>Address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>6</p>
            </td>
            <td> V1025=0x0000</td>
            <td> Address</td>
        </tr>
        <tr>
            <td>
                <p>7</p>
            </td>
            <td>
                <p>V1026=0x0000</p>
            </td>
            <td>
                <p>Address</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>V1027=0x0068</p>
            </td>
            <td>
                <p>Start symbol</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>9</p>
            </td>
            <td>
                <p>V1028=0x0001</p>
            </td>
            <td>
                <p>Control code</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10</p>
            </td>
            <td>
                <p>V1029=0x0002</p>
            </td>
            <td>
                <p>Data lngth</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>11</p>
            </td>
            <td>
                <p>V1030=0x0043</p>
            </td>
            <td>
                <p>Identification code</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>12</p>
            </td>
            <td>
                <p>V1031=0x00C3</p>
            </td>
            <td>
                <p>Identification code</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>13</p>
            </td>
            <td>
                <p>V1032=0x00EB</p>
            </td>
            <td>
                <p>Verify code</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>14</p>
            </td>
            <td>
                <p>V1033=0x0016</p>
            </td>
            <td>
                <p>End symbol</p>
            </td>
        </tr>
    </tbody>
</table>
<p>Program use COMM.LB instruction (low byte mode )send V1020~V1033 component low byte, 18 bytes return data received store toV940~V948. If 18 bytes data which returned are :68 07 05 06 00 00 00 68 81 06 43 C3 97 C6 33 33 32 16, then current active power V522=9364.</p>
<p><img src="<?= $path_to_images ?>images/Commun4.gif" /></p>
<p>[Example ?]</p>
<p>PLC communicate with METTLER TOLEDO T600 weigh terminal, use it CB920 communication protocol read real time weight value.</p>
<p>[Example ? program ]<a href="<?= $path_to_images ?>program/METTLER%20TOLEDO%20T600%20communication.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="??" /></a></p>
<p>1. According to CB920 communication protocol, read real time weight and it ASCII code command:READ/CR/LF, thus 6 bytes command frame:52 45 41 44 0D 0A, command store to " read real time weight " table.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p><strong>Number</strong></p>
            </td>
            <td>
                <p><strong> Component default value </strong></p>
            </td>
            <td>
                <p><strong>ASCII code </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1</p>
            </td>
            <td>
                <p>V1000=0x0052</p>
            </td>
            <td>
                <p>R</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2</p>
            </td>
            <td> V1001=0x0045</td>
            <td> E</td>
        </tr>
        <tr>
            <td>
                <p>3</p>
            </td>
            <td>
                <p>V1002=0x0041</p>
            </td>
            <td>
                <p>A</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>4</p>
            </td>
            <td>
                <p>V1003=0x0044</p>
            </td>
            <td>
                <p>D</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>5</p>
            </td>
            <td>
                <p>V1004=0x000D</p>
            </td>
            <td>
                <p>/CR</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>6</p>
            </td>
            <td> V1005=0x000A</td>
            <td> /LF</td>
        </tr>
    </tbody>
</table>
<p>Program use COMM.LB instruction (low byte mode) send low byte of V1000~V1006 component, 18 bytes data received store to V0~V8. If 18 bytes data returned as:53 54 2C 4E 54 2C 2B 20 20 31 39 39 2E 38 6B 67 0D 0A( return ASCII code :ST, NT, + 199.8kg/Cr/Lf), then real time weight V0=199.8.</p>
<p><img src="<?= $path_to_images ?>images/Commun5.gif" /></p>
<p>2. communication simulator .</p>
<p><img src="<?= $path_to_images ?>images/Commun6.gif" /></p>