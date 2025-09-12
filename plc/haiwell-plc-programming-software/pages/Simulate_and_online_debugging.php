<h1 id="Simulate_and_online_debugging">Simulate and online debugging</h1>
<hr>
<p>This section introduce the how to use the program software built-in simulator and the method of online debug the program.</p>
<h3 id="Overview">Overview</h3>
<p>Program software built-in simulator ( offline simulate), entirety realize the PLC program simulate running. When you are programming of after completed the program, can use the simulator simulate running the PLC program in entirely break away from PLC, in order to check up program executed whether or not correct, vastly reduce the debug time at local, reduce the debug difficulty, improve the debug efficiency.</p>
<p>Program software supply abundant debug tools, expedience online debug program, can search the whole PLC which connected the PLC, display all online PLC running status. fault status. RUN/STOP switch position. hardware configure. communication port parameter etc. detail information, can select any PLC process online monitor, look up all PLC component value or status.</p>
<h3 id="Simulation_environment">Simulation environment</h3>
<p>At simulating or online monitoring, the bottom of main windows will appear a "PLC hardware simulator windows". all divide into four page windows : message windows. curve real time monitoring. locked data table. PLC hardware simulator windows, at the same time appear simulate tools bar at top left corner, cooperate right-hand button menu, make the simulate still more close to real environment.</p>
<p><img src="<?= $path_to_images ?>images/simulation_win.jpg" /></p>

<h3 id="Simulate_tools_bar">Simulate tools bar</h3>
<p>Simulate tools bar use for control the power off. power on. start. stop. pause and continues operate of the simulator.</p>
<p><img src="<?= $path_to_images ?>images/simulation_tool.gif" /></p>
<h3 id="Right_click_menu">Right-click menu</h3>
<p>At simulating or monitoring status, click right-hand button can callout right-click menu. Right-click menu support still further comprehensive simulate operation and others debug tools.</p>
<p><img src="<?= $path_to_images ?>images/simulation_menu.jpg" /></p>
<p>1. Stop simulator: finish current simulating status, return edit status.</p>
<p>2. Force ON: force the bit component status to ON of the mouse position.</p>
<p>3. Force OFF: force the bit component status to OFF of the mouse position.</p>
<p>4. Force: open " force " window, force component status or value.</p>
<p>5. Lock data: open " Lock " window, lock component status or value.</p>
<p>6. Unlock data: release the component locked data of the mouse position.</p>
<p>7. Unlock all the data: release all the component locked data.</p>
<p>8. Component status table : open " component status table ", can arbitrarily monitor all components status or value of PLC.</p>
<p>9. Power off/power on: simulate PLC power off/power on.</p>
<p>10. Start: control the simulator start running.</p>
<p>11. Stop:control the simulator stop running.</p>
<p>12. Pause:control the simulator pause running.</p>
<p>13. Continue:control the simulator continue running.</p>
<p>14. Decimal: according to decimal display data value.</p>
<p>15. Hexadecimal :according to hexadecimal display data value.</p>
<p>16. Find: open " find " window, find component or instruction in the program.</p>

<h3 id="Hardware_simulate_window">Hardware simulate window</h3>

<p>" Hardware simulate window " list the hardware configure of current program project, display the name of MPU and module and all X(DI)or Y(DO) channel status and AI. AQ channel value.</p>
<p><img src="<?= $path_to_images ?>images/simulation_cpu.jpg" /></p>
<p>1. Click X or Y channel may be force the channel status.</p>
<p><img src="<?= $path_to_images ?>images/force_x.gif"  /> <img src="<?= $path_to_images ?>images/force_on.gif"  />
    <img src="<?= $path_to_images ?>images/forse_off.gif"  /></p>
<p>2. Click AI or AQ channel may be open "AI/AO simulate window" to modify the channel value.</p>

<h3 id="AI_AQ_simulate_window">AI/AQ simulate window</h3>

<p>Click " hardware simulate window " AI or AQ channel may be open " AI/AO simulate window ", window display the channel's signal type. signal value. signal value corresponding quantities or code value etc., can modify the channel value( can modify AI and AQ in simulate status, only AQ can be modified in online monitor status).</p>
<p><img src="<?= $path_to_images ?>images/simulation_ai.gif" /></p>

<h3 id="Data_lock_window">Data lock window</h3>

<p>" data lock window " list all locked component and them status or value.</p>
<p><img src="<?= $path_to_images ?>images/simulation_lock.jpg" /></p>

<h3 id="Real_time_curve_window">Real time curve window</h3>

<p>" Real time curve window " according real time curve to monitor the change trend of register component value, expedience user process dynamic watch and debug some important parameter.</p>
<p><img src="<?= $path_to_images ?>images/simulation_trend.jpg" /></p>

<h3 id="Message_window">Message window</h3>

<p>" Message " display the system message during simulating or debugging process, as interrupt message. system error message. communication error message etc., user can check the message at the window to be informed of current program running status.</p>
<p><img src="<?= $path_to_images ?>images/simulation_messge.jpg" /></p>
<h3 id="Simulate_operation">Simulate operation</h3>
<h3 id="General_steps_of_simulation">General steps of simulation</h3>
<p>1. Start simulator, enter into simulate status.</p>
<p>2. In accordance with force the component, modify the component status or value, make program as far as possible executed in simulate the real local actual condition. In simulating process, can use " component status table ". " real time curve monitor " or "PLC hardware simulate " etc. numerous simulate debug tools for monitor the result of the program simulate running, to checking the result whether or not correct of the program executing.</p>
<p>3. If the program have communication instruction, then may be start " communication simulator " simulate the return data from slave device.</p>
<p>4. If the program have interpolation etc. motion control instructions, then may be start " interpolation simulator " according to diagram the result of simulate interpolation output.</p>
<p>5. Simulate PLC power OFF/power ON, check the program still can normal work after the power off.</p>
<p>6. Stop simulator, return to edit status. If the result of the program not correct, then simulate executing after modify the program.</p>

<h3 id="Start_simulator">Start simulator</h3>

<p>Click menu [debug/ start simulator] or click tools bar <img src="<?= $path_to_images ?>/images/simulation_anniu.gif"  /> button to start simulator, System auto compile the current project, if there are error or alarm after the program compiled, if there are error or alarm after the program compiled, will popup the windows as follows.</p>
<p><img src="<?= $path_to_images ?>images/simulation_compile.jpg"  /></p>
<p>1. List all error and alarm information in the listing frame, double click the error or alarm information, program will be accurate fixed position the location which generated the error or alarm, expedience user modify the program.</p>
<p>2. If there is error during compiling the program, simulator can not be started, until user modify the program have not any error and then the simulator can be started.</p>
<p>3. If there is no error or only alarm during compiling the program, simulator can be started. If there is alarm information, suggest you modify the program until there is no any alarm information and then start simulator.</p>
<p>4. After simulator started, programer software enter into offline simulate status. At simulate status, can not modified the program, only after stop simulator and return to edit status, just can be modified the program</p>
<h3 id="Component_monitor">Component monitor</h3>
<p>At simulate or online monitor status, may be through the program edit area. component status table. hardware configure windows etc. monitor the component status and value, and the instruction execute situation. Below is the program edit area which is at simulate or online monitor.</p>
<p><img src="<?= $path_to_images ?>images/simulation_program.jpg" /></p>
<p>1. When the instruction frame is red, express the instruction is executing correct ; when is blue, express the instruction did not executed or executed error( the instruction parameter error, as DIV instruction divisor is 0).</p>
<p>2. Register will display it current value, may be via menu [ check\decimal. hexadecimal] change the register display model.</p>
<p>3. Floating point number or character format component will automatic display according to the defined of the instruction item. As up drawing :CTOF instruction, Sou input is character, so character display V3='+ 199.8kg', Out item output is floating point number, so floating point display V100=199.8.</p>
<p>4. Constant open switch and the compare switch have red diamonds, express the switch is connected, otherwise not connected. Note: the status of constant close and constant open is opposite ; rising edge and descend edge because is edge, only generate edge connect once, rest time not connected.</p>
<p>5. The red frame of the component, express the status of component is ON, otherwise is OFF.</p>
<p>6. If component with <img src="<?= $path_to_images ?>images/lock_icon.gif" />, express the component data locked.</p>
<p>7. Double clock the component can be forced the component status or value.</p>
<h3 id="Component_status_table">Component status table</h3>

<p>" component status table " can monitor current status or value of the all component of the PLC, maximum may build 10 status tables, allow display the register value according to different data formation. Only usable in simulate or online monitor.</p>
<p>1. Click menu [ debug/component status table ] or click tool bar <img src="<?= $path_to_images ?>images/output_anniu.gif" /> button, open " component status table "</p>
<p><img src="<?= $path_to_images ?>images/output.jpg" /></p>
<p>2. Click " component " bar nether blank space, At input frame input the component or component range, e.g. :as up drawing input V0-8. V100. V1000-1005. M0.</p>
<p>3. For register component display is "16 bit register value " and "32 bit register value ".Note:"32 bit register value" column display border upon 2 continuous registers value, as up drawing first line V0 component "32 bit register value" is V1V0 value.</p>
<p>4. If component with <img src="<?= $path_to_images ?>images/lock_icon.gif" />, express the component data locked.</p>
<p>5. Double clock the component can be forced the component status or value.</p>
<p>6. Right-hand button click may be popup the right-hand menu, via right-hand menu may be forced. locked. release locked. add or delete status table. to lead all kinds of data table component operation, may be change the display format of the register( include decimal base. floating point. character) etc..</p>
<p><img src="<?= $path_to_images ?>images/output_menu.jpg" /></p>
<h3 id="Force">Force</h3>

<p>Force change component status or value.</p>
<p>1. Bit component be forced: at " type " select bit component type, at " component " input component number, select ON or OFF status, if X component is external high speed pulse input point then can select input pulse frequency value, click " force " button.</p>
<p><img src="<?= $path_to_images ?>images/force_bit.jpg" /></p>
<p>2. Register component be forced: at " type " select register component type, at " component " input component number, input the value be forced, may be input 16 bit integer. 32 bit integer. floating point number or character, "HEX" selected express input hexadecimal integer, click " force " button.</p>
<p><img src="<?= $path_to_images ?>images/force_reg.jpg" /></p>
<p>3. Character input as follows. each register store two character, when select " low byte mode ", each register only store one character.</p>
<p><img src="<?= $path_to_images ?>images/force_chr.jpg" /></p>
<h3 id="Lock_data">Lock data</h3>
<p>Status or value of the component be locked, make component value not change, until release locked.</p>
<p>1. Bit component be locked: at " type " select bit component type, at " component " input component number, select ON or OFF status, click " force " button.</p>
<p><img src="<?= $path_to_images ?>images/lock_bit.jpg" /></p>
<p>2. Register component be locked: at " type " select register component type, at " component " input component number, input the value be locked, may be input 16 bit integer. 32 bit integer. floating point number or character, "HEX" selected express input hexadecimal integer, click " force " button.</p>
<p><img src="<?= $path_to_images ?>images/lock_reg.jpg" /></p>
<p>3. Character input as follows. each register store two character, when select " low byte mode ", each register only store one character.</p>
<p><img src="<?= $path_to_images ?>images/lock_chr.jpg" /></p>
<p>Difference between force and lock:</p>
<p>1. Force only assign to component, program arithmetic output. external device communication input etc. will change the component status or value.</p>
<p>2. Lock fixed the status or value of the component, whether program arithmetic output. external device communication input etc. will not refresh it, until release locked.</p>
<p>3. At on line monitor, can not force external input component status or value (such as digital input X and analog input AI). May be locked the status or value of external input component.</p>
<p>[Note]</p>
<p>1. Please use the lock data function carefully, lock data might be produce unforeseeable effect.</p>
<p>2. If locked data in PLC, will generate error code 142, be "SV3=142 have locked data ", to remind user pay attention to it.</p>
<p>3. If really need use lock data function, expedience handle location problem, please release the locked data after the location problem handled finish.</p>
<h3 id="Real_time_curve">Real time curve</h3>
<p>At simulate or PLC on line monitor status, real time change of the register component ( such as V. AI. AQ etc. ) value may be use real time curve mode visualize expression it, expedience user proceed dynamic observe and debug to some important parameters.</p>
<p><img src="/E:/Help%20files/haiwell%20plc%20Help/???????/images/simulation_trend.jpg"  /></p>
<p>1. At " component " input the register component to be monitored.</p>
<p>2. At " upper limit value " and " lower limit value " input the register upper limit value and lower limit value.</p>
<p>3. Tick the leftmost select box, express draw real time curve of the component.</p>
<p>4. Register component default 16 bit integer, if 32 bit integer must be tick "32 bits" select box, if floating point number must be tick " floating point number " select box.</p>
<p>5. " Pause " option pause the curve drawing. during pause, may be use left mouse button click the point of the curve to read the point value.</p>
<h3 id="Power_off_simulate">Power off simulate</h3>
<p>All control system or device all might be power off, strong control program should consider the device power off factor fully, make sure the program still can proper functioning after power off then power on.</p>
<p>1. Click simulator tool bar <img src="<?= $path_to_images ?>images/poweroff.gif" /> button, simulate PLC power off, the program stop executing.</p>
<p>2. Click simulator tool bar <img src="<?= $path_to_images ?>images/poweron.gif" /> button, simulate PLC again power on, the program again start executing.</p>
<p>3. Via simulate power off/power on procedure, may be test program whether or not proper functioning after power off then power on, may be check parameter whether or not lost etc. problem.</p>
<h3 id="Communication_simulator">Communication simulator</h3>
<p>" Communication simulator " is a simulation tool be exclusively used in debug the communication instruction. It may manual operation simulate input response information from slave, also my be use the computer reality serial port communicate with salve, reality simulate PLC execute communication instruction process and handle the data return from slave.</p>
<h3 id="Start_communication_simulator">Start communication simulator</h3>
<p>At simulation status, click menu [debug/communication simulator] or click tools bar<img src="<?= $path_to_images ?>images/simulation_comm_anniu.gif"  /> button to start " communication simulator ", default " manual input response information from slave" mode.</p>
<p><img src="<?= $path_to_images ?>images/Commun6.gif"  /></p>
<p>1. Upper left message frame display the executing communication instruction. the instruction sent command frame data. slave response data etc., message frame scroll display all communication instruction executed and generate the send and receive data. press " clear " button clear all message, tick " Pause " stop refresh communication instruction executed and generate the send and receive data.</p>
<p>2. Left lower frame use for manual input return response information from slave.</p>
<p>3. Right list all communication instruction using the same communication port, add <img src="<?= $path_to_images ?>images/select.gif"  /> identification at the executing communication instruction, double click instruction may fixed position the instruction location at the program.</p>
<p>4. Each communication port used by communication instruction will generate a alone page, page title display the communication port number and number of instructions which using the communication port.</p>
<h3 id="Manual_input_slave_response_information">Manual input slave response information</h3>
<p>1. When upper left message frame display " wait response", at left lower input frame input response data frame from slave ( data content please according to the communication protocol specification of the slave ), press " enter", response data will be automatic wrote to communication instruction output register.</p>
<p>2. "Hex". "ASCII" use for select Hexadecimal or ASCII code mode input and display data.</p>
<p>3. "CRC". "LRC". "BCC" and "SUM" button use for calculate the check code of the input data.</p>
<p>4. "Cr" input enter symbol, "Lf" input line break.</p>
<h3 id="Use_reality_serial_port_communicate_with_slave">Use reality serial port communicate with slave</h3>
<p>1. Tick " use reality serial port communicate with slave " enter use computer reality serial port reality communicate with slave mode, communication instruction send command frame to slave via computer serial port, also receive response data from slave, response data automatic wrote to communication instruction output register. Reality send and receive data all will be scroll displayed in the message box.</p>
<p>2. "PC port " listbox list the total serial port of the computer, out of select the reality serial port connect to the slave.</p>
<h3 id="High_speed_counter_simulate">High speed counter simulate</h3>
<p>1. High speed counter support:pulse/direction. positive/negative pulse. A/B phase pulse input model, support 1. 2. 4 frequency multiplication counting model.</p>
<p><img src="<?= $path_to_images ?>images/par_hsc.gif" /></p>
<p>[High speed counter mode and pulse oscillogram ]</p>
<table>
    <thead>
        <tr>
            <td colspan="2">
                <p>Counting mode</p>
            </td>
            <td colspan="2">
                <p>Pulse oscillogram</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Mode</p>
            </td>
            <td>
                <p>Frequency multiplication</p>
            </td>
            <td>
                <p>Increase count</p>
            </td>
            <td>
                <p>Decrease count</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> 0 --??/?? </td>
            <td> 1 </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/hhsc-mod0.gif" /></p>
            </td>
        </tr>
        <tr>
            <td> 1 --??/?? </td>
            <td> 2 </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/hhsc-mod1.gif" /></p>
            </td>
        </tr>
        <tr>
            <td> 2 --??/?? </td>
            <td> 1 </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/hhsc-mod2.gif" /></p>
            </td>
        </tr>
        <tr>
            <td> 3 --??/?? </td>
            <td> 2 </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/hhsc-mod3.gif" /></p>
            </td>
        </tr>
        <tr>
            <td> 4 -- A?/B? </td>
            <td> 1 </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/hhsc-mod4.gif" /></p>
            </td>
        </tr>
        <tr>
            <td> 5 -- A?/B? </td>
            <td> 2 </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/hhsc-mod5.gif" /></p>
            </td>
        </tr>
        <tr>
            <td> 6 -- A?/B? </td>
            <td> 4 </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/hhsc-mod6.gif" /></p>
            </td>
        </tr>
    </tbody>
</table>
<p>2. High speed counter channel express by HSCx, each channel use 2 high speed pulse input point.Can force input frequency of the high speed pulse input point.</p>
<p><img src="<?= $path_to_images ?>images/force_x.gif"  /></p>
<p>3. Method of simulate pulse input, use HSC0 channel for example.</p>
<p>A. Pulse/direction (X0 is pulse singal, X1 is direction singal): force X0 pulse frequency to 20Hz, X1=OFF, now is increase counting</p>
<p>force X0 pulse frequency to 20Hz, X1=ON, now is decrease counting</p>
<p>B. positive/negative pulse(X0 is positive pulse, X1 is negative pulse): force X0 pulse frequency to 20Hz, X1=OFF, now is increase counting</p>
<p>force X0=OFF, X1pulse frequency to 20Hz, now is decrease counting</p>
<p>C. A/B phase pulse(X0 is A phase pulse, X1 is B phase pulse): first force X0 pulse frequency to 20Hz, then force X1pulse frequency to 20Hz, now is increase counting (A phase pulse before)</p>
<p>first force X1pulse frequency to 20Hz, then force X0 pulse frequency to 20Hz, now is decrease counting (B phase pulse before)</p>
<p>4. During high speed counter simulate execute process will generate corresponding system interrupt, as follows.</p>
<p>program example:<a href="<?= $path_to_images ?>program/hhsc_hcwr.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="??"  /></a></p>
<p><img src="<?= $path_to_images ?>images/hhsc_sim.gif"  /></p>
<p><img src="<?= $path_to_images ?>images/simulation_messge.jpg"  /></p>
<h3 id="Pulse_output_simulate">Pulse output simulate</h3>
<p>1. High speed pulse output support :single pulse. pulse/direction. positive/negative pulse. A/B phase pulse. synchronization pulse output, total 5 output mode, high speed pulse output channel express via PLSx, each channel use 2 high speed pulse output point.</p>
<p><img src="<?= $path_to_images ?>images/par_pls.gif"  /></p>
<p>2. Method of simulate pulse output, use PLS1 channel for example.</p>
<p>A. Single pulse output(Y2 is pulse signal): Y2 blink during pulse output ; no pulse output Y2=OFF.</p>
<p>B. Pulse/direction output (Y2 is pulse signal, Y3 is direction signal): Y2 blink during positive pulse output, Y3=OFF.</p>
<p>Y2 blink during negative pulse output, Y3=ON.</p>
<p>no pulse output Y2=OFF, Y3=OFF.</p>
<p>C. Positive/negative pulse output (Y2 is positive pulse signal, Y3 is negative pulse):Y2 blink during positive pulse output, Y3=OFF.</p>
<p>Y2=OFF during negative pulse output, Y3 blink.</p>
<p>no pulse output Y2=OFF, Y3=OFF.</p>
<p>D. A/B phase pulse output(Y2 is A phase pulse, Y3 is B phase pulse):Y2. Y3 blink during pulse output ;no pulse output Y2=OFF. Y3=OFF.</p>
<p>E. Synchronization pulse output (Y2 is pulse, Y3 is synchronization pulse): Y2. Y3 blink during pulse output ;no pulse output Y2=OFF. Y3=OFF.</p>
<p>3. During high speed pulse output instruction simulate execute process will generate corresponding system interrupt, as follows.</p>
<p>program example:<a href="<?= $path_to_images ?>program/plsr.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="??"  /></a></p>
<p><img src="<?= $path_to_images ?>images/plsr_sim.gif"  /></p>
<p><img src="<?= $path_to_images ?>images/pls_sim.jpg"  /></p>
<h3 id="Interpolation_simulate">Interpolation simulate</h3>
<p>1. There is interpolation instruction in the program, under simulate status, may be start " interpolation simulator" to observe interpolation instruction generate motion trail.</p>
<p>2. Click menu [debug/interpolation simulator] or click tool bar <img src="<?= $path_to_images ?>images/plssim_anniu.gif"  /> button, start " interpolation simulator".</p>
<p><img src="<?= $path_to_images ?>images/plssim_win.gif"  /></p>
<p>3. " interpolation simulator" tool bar.</p>
<p>A. Click<img src="<?= $path_to_images ?>images/draw_anniu.gif"  />, interpolation instruction executed generate motion trail will be draw. Click <img src="<?= $path_to_images ?>images/nodraw.gif" /> stop draw. Note: interpolation instruction executed is controlled by program, if no instruction executed there is no motion trail be generated.</p>
<p>B. Click<img src="<?= $path_to_images ?>images/zuobiao_anniu.gif"  />, may be select different plane coordinates.select consistent coordinate with actual motion platform, more convenience of user observe motion trail.</p>
<p>C. Click<img src="<?= $path_to_images ?>images/color_anniu.gif"  />, may be select the line color of each coordinate axis.</p>
<p>D. Tick<img src="<?= $path_to_images ?>images/showpoint_anniu.gif" /> be display motion tracing point coordinate, no tick then hide point coordinate.</p>
<p>E. Click<img src="<?= $path_to_images ?>images/zreopoint_anniu.gif" />, may be pull the origin of coordinates to middle of the drawing zone.</p>
<p>F. Click<img src="<?= $path_to_images ?>images/cls_anniu.gif"  />, may be clear the motion trail.</p>
<p>4. Interpolation instruction executed generate motion trail will be draw on plane coordinates, different motion plane will be display paging.</p>
<p>5. At middle part list motion plane each axis corresponding pulse output channel parameter, display the channel current position. mechanical origin position. output mode etc., may be set axial length. unit pulse count.</p>
<p>6. Bottom is message box, display executing interpolation instruction and trail describe.</p>
<p>Circular interpolation program example:<a href="<?= $path_to_images ?>program/cimr.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="??"  /></a></p>
<p><img src="<?= $path_to_images ?>images/cimr_sim.gif" /></p>
<h3 id="Difference_between_online_debugging_and_offline_simulate">Difference between online debugging and offline simulate</h3>
<p>1. Off line simulate : no need reality PLC, program running in simulator, modify the component status or data value and program execution result output only happen in simulator.</p>
<p>2. On line debug: programming software must on line with PLC, program download to PLC to execute, modify the component status or data value and program execution result output happen in PLC, real time response external input singal (DI or AI), output signal (DO or AO) produce real control effect to the external device.</p>