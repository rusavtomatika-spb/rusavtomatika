<h1>Quick start</h1>
<hr>
<p>This section brief introduce general step of programming   PLC  control program, to help beginner as soon as possible know well PLC programming software programming operation.</p>
<h3 id="General_step_of_programming">General step of programming</h3>
<p>First step: double click the programming software icon at computer desktop, start programming software.</p>
<p>Second step:  new construction a program project, use menu[ file/ new construction program project ], open "new construction program project" window, select  PLC series. PLC MPU and others project attribute.</p>
<p>Third step:  write control program, build one or many program block, use menu   [File/New....../master program block], open "New construction program block" window, input the program block named. select programming language (LD. FBD. IL)and program block type (program block. subprogram. interrupt program).</p>
<p>Fourth step:  if need configuration hardware parameter or extend module, Use menu  [ Look UP/PLC hardware configuration ] open "PLC hardware configuration " window.</p>
<p>Fifth step:  Start simulator, off line simulate running debug program, running correct then next step, otherwise return  to third step modify program.</p>
<p>Sixth step:  Online with PLC.</p>
<p>Seventh step: download program to PLC.</p>
<p>Eighth step: start PLC running.</p>
<p><map name="FPMap0">
        <area coords="4, 3, 351, 56" href="#Start programming software" shape="rect"/>
        <area coords="0, 82, 354, 141" href="#Start programming software" shape="rect"/>
        <area coords="3, 168, 350, 249" href="#Writing control program" shape="rect"/>
        <area coords="3, 276, 351, 336" href="#Hardware configuration" shape="rect"/>
        <area coords="2, 360, 336, 401" href="#Off-line simulation debugging" shape="rect"/>
        <area coords="68, 484, 272, 520" href="#PLC online" shape="rect"/>
        <area coords="60, 543, 292, 580" href="#Download program" shape="rect"/>
        <area coords="62, 603, 289, 640" href="#StartPLC" shape="rect"/>
    </map>
    <img src="<?= $path_to_images ?>images/SpeedView.gif" usemap="#FPMap0" />
</p>

<h3 id="First_step_Start_programming_software">First step: Start programming software</h3>
<p>Double click the programming software icon at computer desktop, start programming software, as follows: </p>
<p><img src="<?= $path_to_images ?>images/software_start.jpg" /></p>
<h3 id="Second_step_New_project">Second step: New project</h3>
<p>Open mode: A. Click menu [File/New project], B. Click tools bar <img src="<?= $path_to_images ?>images/NewItem.gif" /> button, C. use shortcut key Ctrl+N.</p>
<p>"New project" window as follow: </p>
<div>
    <p><img src="<?= $path_to_images ?>images/new-item.jpg" /></p>
</div>
<p>1. At "PLC series" among pull listing select "PLC series".</p>
<p>2. At "CPU type " among pull listing select "CPU also MPU type".</p>
<p>3. Power-off preserve area  may be defined by user, may be set V. M. S. T. C five  type component power-off preserve area  start component and length. System default the Power-off preserve area  listing as follow: </p>
<table>
    <tbody>
        <tr>
            <td>
                <p><strong>Component type </strong></p>
            </td>
            <td>
                <p><strong>Power-off preserve area  </strong></p>
            </td>
            <td>
                <p><strong>Component number</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>V</p>
            </td>
            <td>
                <p>V1000~V2047</p>
            </td>
            <td>
                <p>1048</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>M</p>
            </td>
            <td>
                <p>M1536~M2047</p>
            </td>
            <td>
                <p>512</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>S</p>
            </td>
            <td>
                <p>S156~S255</p>
            </td>
            <td>
                <p>100</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>T</p>
            </td>
            <td>
                <p>T96~T127</p>
            </td>
            <td>
                <p>32</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>C64~C127</p>
            </td>
            <td>
                <p>64</p>
            </td>
        </tr>
    </tbody>
</table>
<p>4. At " project name  " input new project name, the project name will be display in the main frames of the project manager.</p>
<p>5. At "user name". "designer". "version". "company" etc. columns input relate to information.</p>
<p>6. If need password protect the new project, then at "password" and "verify password" input the password.</p>
<p>7. At "note" may be input relate to note information of the project.</p>
<h3 id="Third_step_Write_control_program">Third step: Write control program</h3>
<p>Control program realize the kernel of automatic control, it essence is according to control object ( as machine. automatic equipment. production line etc. ) requirement details use programming software supplied many instructions realize automatic control of the control object.</p>
<p>1. According to the need build one or more program block, choice oneself well-informed program language (LD. FBD. IL), each block may be set alone password, realize local cypher function.</p>
<p>2. At  program block  use programming software supplied many instructions to program, realize all kinds of control logical and   arithmetic.</p>
<p>3. After complete the program, save program file, start simulator running, debug program whether attain the control requirement.</p>
<p>4. Detail operation refer to "<a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#LD_ladder_diagram_programming">programming operation manual </a>"</p>
<p>[Example]</p>
<p>Below explain how to write the control program via the example, the example control requirement:  press X0 button start, delay 2 second output Y0. press X1 button stop.</p>
<p>[Example program]<a href="<?= $path_to_images ?>program/QuickStart.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="??"    /></a></p>
<p><img src="<?= $path_to_images ?>images/QuickS1.gif"    /></p>
<p>[Example program operation]</p>
<p>1. Create a new  " Quick start example" main program block, open mode: A. Click menu  [File/New....../Main program block], B. Click tools bar  <img src="<?= $path_to_images ?>images/NewProgram.gif" />  button "Main program block"." Create new  program block " window as follow.</p>
<p><img src="<?= $path_to_images ?>images/QuickS2.jpg"    /></p>
<p>2. Click tool bar <img src="<?= $path_to_images ?>images/F9-swith.gif" /> button or press F9 shortcut key add a switch, input switch component "X0//start" (behind "//" " start " is the comment of component X0, the same below), press Ctrl+3 shortcut key change normal open to rising edge.</p>
<p>3. Press F10 shortcut key parallel a switch, input switch component "M0//self-lock"</p>
<p>4. Move cursor to the right side of X0 switch, press F9 shortcut key series a switch, input switch component "X1//stop", press Ctrl+2 shortcut key change normal open to normal close.</p>
<p>5. Move cursor right, input "TON" return, add one "TON" instruction, continuous press enter, when input box at "Pt" item input set value 2 of the timer.</p>
<p>6. Press F11 shortcut key  add parallel output  instruction "OUT", input component  "M0".</p>
<p>7. Press  tool bar <img src="<?= $path_to_images ?>images/Add-Network.gif" /> button or press Ctrl+L shortcut key  add a new network.</p>
<p>8. Press F9 shortcut key add a switch, input switch component "T0//delay 2S".</p>
<p>9. Press F11 shortcut key  add output instruction "OUT", input component  "Y0//output".</p>
<p>Come here program wrote complete. press Ctrl+S shortcut key  to save the program file, may be start the simulator executing, debug program whether attain control requirement.</p>

<h3 id="Fourth_step_PLC_hardware_configure">Fourth step: PLC hardware configure</h3>
<p>If you need configure hardware parameter (as configure AI input channel signal type. quantities etc. ) or need add extend module etc. relate to hardware, then do this step, otherwise skip this step.</p>
<p>1. Double click " Project manager " window directory tree "PLC hardware configure " point or use menu  [Check/PLC hardware configure] to open "PLC hardware configure" window.</p>
<p>2. Click open "Project manager"   window directory tree " PLC, select want to add module, use mouse drag the module to right side hardware configure list.</p>
<p>3. Click hardware configure list module, under the list will display the attribute of the module be defined and configured.</p>
<p>4. Define and configure the attribute of each module.</p>
<p>5. Detail operation refer to "<a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#PLC_hardware_configuare">PLC hardware configure </a>".</p>

<h3 id="Fifth_step_Off_line_simulate_debug">Fifth step: Off line simulate debug</h3>

<p>During write the program or after complete the program, may be use simulator under the condition of completely off line PLC simulate running PLC program, use for check program executed whether correct, vastly reduce local debug time, reduce debug difficulty, improve debug  efficiency.</p>
<p>1.  Click menu [Debug/Start simulator]or click tools bar  <img src="<?= $path_to_images ?>images/simulation_anniu.gif" /> button start the simulator, system will automatic compile the current program project.  Detail operation of the   simulator  refer to
    "<a href="/plc/haiwell-plc-programming-software/Simulate_and_online_debugging/">Simulate and on line debug</a>".</p>
<p>2. If compile the program error, simulator can not running, user must modify the program according to the compiler suggestive error information.</p>
<p>3. Compile no error or only alarm, then start simulator.simulator interface as follows: </p>
<p><img src="<?= $path_to_images ?>images/simulation.jpg" /></p>
<p>4. Double click program "X0" switch force X0=ON, then M0=ON self lock, timer T0 start timing, when TV0=2 time time to then T0=ON, Y0=ON.</p>
<p>5. Double click program "X1"switch force X1=ON, X1 normal close switch no electricity, then M0=OFF, T0=OFF, Y0=OFF.</p>
<p>6. Via the simulator running verify, program running result correct.</p>

<h3 id="Sixth_step_Online_with_PLC">Sixth step: Online with PLC</h3>

<p>Connect to one or many PLC in the network. Only after PLC online may be control operation the PLC, such as:  upload or download etc..</p>
<p>1. Click menu [PLC/PLC networking] or click  tool bar <img src="<?= $path_to_images ?>images/online_anniu.gif" /> button, open "PLC online" window.</p>
<p><img src="<?= $path_to_images ?>images/online.jpg" /></p>
<p>2. Click "Online" button (general condition, direct use default parameter ), already online PLC will automatic add to the listing box, now click "exit " close the window.</p>
<p>3. PLC online and parameter setting refer to "Online control PLC" section "<a href="/plc/haiwell-plc-programming-software/Online_control_PLC/#Online_with_PLC">PLC online</a>".</p>

<h3 id="Seventh_step_Download_program">Seventh step: Download program</h3>

<p>Download current program project (hardware configure and program etc. content) to online PLC. Before download system automatic compile the current program project, if error during compile, then list all errors, after user modify the program no any error then can be downloaded.</p>
<p>Click menu [PLC/PLC program download] or click  tool bar <img src="<?= $path_to_images ?>images/download_anniu.gif" /> button, open "PLC program download" window, click "download " button download the program to PLC.</p>
<p><img src="<?= $path_to_images ?>images/download.jpg" /></p>
<p>Note:  detail operation refer to " Online control PLC" section "<a href="/plc/haiwell-plc-programming-software/Online_control_PLC/#Download_program">Download program</a>".</p>

<h3 id="Eighth_step_Start_PLC">Eighth step: Start PLC</h3>

<p>After download complete, if PLC already in running status (RUN indicator go on), may skip the step. Otherwise turn the PLC running switch in to "RUN" position.</p>