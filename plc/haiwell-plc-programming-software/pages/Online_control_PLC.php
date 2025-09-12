<h1 id="Online_control_PLC">Online control PLC</h1>
<hr>
<p>The section introduce use programming software online control the PLC.</p>
<h3 id="PLC_station_number_setting_up">PLC station number setting up</h3>
<p>Via hardware 4 bit DIP switch setting up PLC station number( also name station address. communication address). legal station number is 1~254(0 is broadcast address).4 bit DIP may be express decimal number 1~15( binary number from 0001 ~ 1111), method of modify the station number via DIP switch as follow:</p>
<p><img src="<?= $path_to_images ?>images/SetPLCAddress.gif" /></p>
<p>Up picture is the 4 bit DIP switch use to set the station number of the PLC, above is ON, below is OFF, in the picture black part express the switch position, the bit set side to ON express the bit is 1, set side to OFF express the bit is 0, first bit in up picture is ON, other bits are OFF. The first bit of the DIP switch express the 0 bit of binary(b0), the fourth bit of the DIP switch express third bit of binary(b3), thus, such as the DIP switch in up picture express 0001, also decimal data is 1, express the PLC station is 1(default is 1 when leave factory); If set the 1. 2 bits to ON side, moreover others witch set to OFF side, then be 0011, also decimal data is 3, express PLC station number is 3.</p>
<p>If 4xbit DIP switch express the hardware address not enough to use, may be via menu[PLC/Set PLC parameter] setting up PLC soft address. As follows:</p>
<p><img src="<?= $path_to_images ?>images/Station%20number.jpg" /></p>
<p>Tick "Use PLC soft address", input PLC address value, click "Confirm". After use PLC soft address the hardware 4 bit DIP switch will be invalid.</p>
<h3 id="Online_with_PLC">Online with PLC</h3>
<p>Only after online to PLC succeed, then may be control the PLC connected in the network, such as upload download program. online monitor etc..</p>
<p>1. Click menu[PLC/PLC online] or click tools bar <img src="<?= $path_to_images ?>images/online_anniu.gif"  window.</p>
<p><img src="<?= $path_to_images ?>images/online.jpg" /></p>
<p>2. Set the relate parameter, general condition use default parameter not need set modify.</p>
<ul>
    <li>
        <p>PC port: select the serial port for computer communicate to PLC. Useable COM serial port number in the listing different according to the computer, system will automatic search all useable COM serial port of the computer to user for select by user.</p>
    </li>
    <li>
        <p>Baud rate: select communication baud rate, system default is 19200.</p>
    </li>
    <li>
        <p>Data format: select communication data format, system default is "N, 8, 2 RTU".</p>
    </li>
    <li>
        <p>Start address. end address: if communicate to single PLC, use "Stand-alone search" option ; if communicate to many PLCs, then "Start address" input the minimum station number of the PLC, "End address" input the maximum station number of the PLC.</p>
    </li>
    <li>
        <p>Append to listing. cover listing: select the already online PLCs use append or cover to the listing.</p>
    </li>
    <li>
        <p>Overtime : set the overtime of build communicate between computer and PLC. RS232 or RS485 etc. wired mode online default 200ms, wireless mode online (ex. via GPRS) must according to the wireless communicate delay condition then set a biggish value, general suggest around 5000ms.</p>
    </li>
    <li>
        <p>Stand-alone search: if communicate to single PLC, use "Stand-alone search" option ; if communicate to many PLCs, then must cancel "Stand-alone search" option moreover set "Start address" and "End address".</p>
    </li>
</ul>
<p>3. Online operation</p>
<ul>
    <li>
        <p>Online: direct click "Online" button, searched PLC (online succeed) will be display in the listing.</p>
    </li>
    <li>
        <p>Search: if forget about the baud rate etc. communication parameters, may be click "Find" button to search, search function will try all baud rate. all data format to communicate with the PLC, so need spend longer time for waitting for search the PLC, searched PLC (online succeed) will be display in the listing.</p>
    </li>
</ul>
<p>4. Click "Exit", close "PLC online" window.</p>
<p>5. If online unsuccessful, chances are below cause, look over to exclusion the problem, if can not exclusion please connect the technical support of <a target="_blank" href="http://en.haiwell.com/">Haiwell company</a>.</p>
<p>A. Selected PC serial port not correct.</p>
<p>B. Selected communication parameter and the communication parameter of the PLC are different.</p>
<p>C. PLC power off.</p>
<p>D. Communication cable connected wrong or not connected well.</p>
<p>E. Use "USB convert to RS232 serial port data line" not correct installed the driver.</p>
<h3 id="Online_PLC_window">Online PLC window</h3>
<p>At "PLC online" windows if have searched PLC (online succeed), after exit "PLC online" window will automatic open "Online PLC window", as follows.</p>
<p><img src="<?= $path_to_images ?>images/Online_list.jpg" /></p>
<p>1. On the left side of the upper is PLC listing, here display the already connected PLCs. May be double click any PLC in the listing to select be current PLC, all online operation of the PLC as: upload download parameter. firmware upgrade etc. only for current PLC, don't influence others PLC.</p>
<p>2. On the left side of the bottom is monitor zone, online monitoring use for display current PLC detail status, as: PLC running status. program big or small. version. whether password. series port parameter. master and extend modules type version etc. information.</p>
<h3 id="Download_program">Download program</h3>
<p>Download current program project (hardware configuration. program. comment) to target PLC. Before download system automatic compile the current program project, if the program compiled error, then list all error, after user modify the program until have not any error then can be downloaded. Alarm information only prompt the user pay attention to them, if no error only alarm information, then may be downloaded.</p>
<p>1. Click menu[PLC/PLC program download] or click tools bar <img src="<?= $path_to_images ?>images/download_anniu.gif"  window.</p>
<p><img src="<?= $path_to_images ?>images/download.jpg" /></p>
<p>2. Can choose to download content: Hardware configuration, Program, Comments, Initial register table.</p>
<p>3. Forbid upload: if tick the option, downloaded program can not be uploaded. This way protect the intellectual property of the user program.</p>
<p>4. With eliminate function download: if tick the option, during download automatic initialize the PLC, include clear program. power of latched area etc., then download the program.</p>
<p>5. Without stop download: if tick the option, during download program the PLC will not stop executing, thus online modify program.<strong>Please careful use the function, did not debugged program maybe produce cannot foresee result</strong>.</p>
<p>6. Hardware match: listing detail list the match status between "Program project configuration" and "Target PLC configuration", hardware configuration information must the same. If hardware configuration not the same, program downloaded to target PLC will produce error code 140, thus "SV3=140 hardware configuration not matched". User need according to the listing prompt modify the different hardware configuration to the same, then again download the program to guarantee PLC proper functioning.</p>
<p>7. Modify hardware configuration information: if there is "CPU module" different, please via menu [File/Program project attribute] modify CPU module type; if there is "Extend module number or type" different, please via menu [Check/PLC hardware configuration] open "PLC hardware configuration" window and then add subtract or modify the module.</p>
<p>8. Click "Download" button download the program to PLC.</p>
<h3 id="Upload_program">Upload program</h3>
<p>Upload the target PLC program to the computer. If the program selected "Forbid upload" during downloaded, then the program can not be uploaded.</p>
<p>1. Click menu [PLC/PLC program upload ] or click tools bar <img src="<?= $path_to_images ?>images/load_anniu.gif"  window.</p>
<p><img src="<?= $path_to_images ?>images/load.jpg" /></p>
<p>2. Click "Upload" button, upload the target PLC program to computer.</p>
<h3 id="Generate_PLC_executable_file">Generate PLC executable file</h3>
<p>The programmable software generate PLC executable file from the PLC project, and the file can be released and downloaded to the PLC lonely, but it cannot be edited.</p>
<p>1. Clicking menu[File/Generate PLC executable file], open the window that is called "Generate PLC executable file".</p>
<p><img src="<?= $path_to_images ?>images/Generating%20PLC%20exe.jpg" /></p>
<p>2. "PLC password". "PLC comfirm password": if PLC is setuped password, it should be input password to download the PLC executable file to the PLC.</p>
<p>3. Clicking "generate" button, that will generate the executable file.</p>
<h3 id="Download_PLC_executable_file">Download PLC executable file</h3>
<p>Downloading the executable file to PLC, whose program whill not be uploaded..</p>
<p>1. Clicking menu[PLC/Download PLC executable file]or clicking<img src="<?= $path_to_images ?>images/Down%20PLC%20exe_anniu.gif".</p>
<p><img src="<?= $path_to_images ?>images/Open%20PLC%20exe.jpg" /></p>
<p>2. Chosing PLC executable file, opening the window called"Download PLC executable file".</p>
<p><img src="<?= $path_to_images ?>images/Download%20PLC%20exe.jpg" /></p>
<p>3. Clicking "Download" button, so that downloaded PLC executable file to PLC.if the hardware is not compatible with target or the password is not correct, the file will be not downloaded.</p>
<h3 id="PLC_firmware_upgrade">PLC firmware upgrade</h3>
<p>Update the firmware program of the PLC CPU MPU or extend module, make CPU MPU oe extend module support the new function.</p>
<p>1. Click menu [PLC/PLC firmware upgrade ], open "PLC firmware upgrade " window</p>
<p><img src="<?= $path_to_images ?>images/update.jpg" /></p>
<p>2. Click "Open" button, select the upgrade file according to the upgraded module.</p>
<p><img src="<?= $path_to_images ?>images/update_open.jpg" /></p>
<p>3. At "PLC firmware upgrade " window, up table listed firmware upgrade file version. module type etc. information, bottom listed target PLC name. CPU module and extend module etc. hardware configuration information, at "Select upgrade module" box select upgraded module number, module number 0 express CPU module, extend module from 1 begin according to from left to right sequence arrange.</p>
<p>4. Click "Upgrade" button, upgrade the firmware program of PLC CPU MPU or extend module.</p>
<p>Note: if interrupt during upgrading because power off or other reasons, must rerun firmware upgrade until upgrade successful.</p>
<h3 id="Start_or_stop_PLC">Start or stop PLC</h3>
<p>Via programming software control PLC start or stop, make it RUN/STOP status, realize remote control PLC start or stop.</p>
<p>1. Click menu [PLC/Start PLC running] start PLC running.</p>
<p>2. Click menu [PLC/Stop PLC running] stop PLC running.</p>
<p>[Note]</p>
<p>1. At PLC CPU MPU set a start stop switch, when switch at "STOP" position, PLC be stop status; when switch at "RUN" position, PLC be run status.</p>
<p>2. The relation between start stop switch and programming software "Start or stop PLC running" function: according to start stop switch prior, when PLC power off again power on, if start stop switch at STOP position, then now PLC will be stop status; if start stop switch at RUN position, then now PLC will automatic change to run status. only PLC at power on status, programming software maybe proceed "Start PLC running" or "Stop PLC running" control, no matter start stop switch at any position.</p>
<p>3. If start stop switch at STOP position, after download program or module firmware upgrade complete, PLC will be STOP status; if start stop switch at RUN position, after download program or module firmware upgrade complete, PLC will be RUN status.</p>
<p>4. User control "Start PLC running" or "Stop PLC running" via the programming software, must guarantee locate safety, because of avoid harm for person and machine.</p>
<h3 id="Clear_PLC_program">Clear PLC program</h3>
<p>Initialize target PLC, clear include program. hardware configuration. power off latched zone etc..</p>
<p>1. Click menu [PLC/Clear PLC program]</p>
<p><img src="<?= $path_to_images ?>images/PLC_cls.jpg" /></p>
<p>2. Affirm whether or not clear PLC program, if select "Yes", will initialize the PLC. If select "No", no any operation to the PLC.</p>
<p>3. If PLC set password protect, will prompt user input the password, only the password correct, maybe clear the target PLC program. Also prompt user whether or not clear the PLC password after clear the PLC program, if want clear the PLC password, select yes. Then PLC password will be retained.</p>
<p><img src="<?= $path_to_images ?>images/PLC_password_cls.jpg" /></p>
<h3 id="Program_compare">Program compare</h3>
<p>Compare between the current program project and the target PLC. distinguish list "Program content" and "Hardware configuration" whether or not the same.</p>
<p><img src="<?= $path_to_images ?>images/plc_cmp.jpg" /></p>
<h3 id="PLC_Diagnosis">PLC Diagnosis</h3>
<p>To comprehensive diagnosis PLC of online, PLC listed all of the information system, convenient for the user can quickly find the problem in exceptional cases.</p>
<p><img src="<?= $path_to_images ?>images/plc%20diagnosis.jpg" /></p>
<h3 id="Set_PLC_password">Set PLC password</h3>
<p>Set target PLC password, use for protect the PLC program and hardware configuration etc. information. After set the password, include program upload. program download. program clear etc. must after input correct password then be executed.</p>
<p>1. Click menu [PLC/Set PLC password ], open "Set PLC password " window.</p>
<p><img src="<?= $path_to_images ?>images/password.jpg" />.</p>
<p>2. At password and confirm password field, input the same password, click "Confirm" complete set the password.</p>
<p>3. If PLC already set password, user want modify or cancel the password, click menu [PLC/Set PLC password ], open " password checking" window, input "Original password ", after password checked correct will open "Set PLC password " window, again set new password, password is empty express no password be set (thus clear password ).</p>
<p><img src="<?= $path_to_images ?>images/password_chk.jpg" /></p>
<h3 id="Set_PLC_clock">Set PLC clock</h3>
<p>Set target PLC real time clock.</p>
<p>1. Click menu [PLC/Set PLC clock ], open "Set PLC clock " window.</p>
<p><img src="<?= $path_to_images ?>images/clock.jpg" /></p>
<p>2. Click "Confirm" button maybe set the computer current data and time to the PLC real time clock.</p>
<p>3. If want to regulation computer current clock, click ? clock ? button, maybe modify the computer data and time.</p>
<p><img src="<?= $path_to_images ?>images/clock_pc.jpg" /></p>
<h3 id="Set_PLC_communication_parameter">Set PLC communication parameter</h3>
<p>Set target PLC each communication parameter.</p>
<p>1. Click menu [PLC/Set PLC communication parameter], open "Set PLC communication parameter" window.</p>
<p><img src="<?= $path_to_images ?>images/plc_com_par.jpg" /></p>
<p>2. PLC port: select the PLC communication port be set. CPU MPU built-in 2 communication ports(RS232 is COM1, RS485 is COM2). Extend communication port according to reality sequence distinguish are COM3. COM4. COM5.</p>
<p>3. Baud rate: select communication baud rate.</p>
<p>4. Data format: select communication data format.</p>
<p>5. Overtime time: set communication overtime time.</p>
<p>6. Click " Confirm" button, maybe set PLC communication port communication parameter.</p>
<p>Note: all the communication port default parameter is 19200 N, 8, 2 RTU, suggest use the default parameter.</p>
<h3 id="Set_PLC_parameter">Set PLC parameter</h3>
<p>Set target PLC name. program scan overtime time and PLC soft address.</p>
<p>1. Click menu [PLC/Set PLC parameter], open "Set PLC parameter" window.</p>
<p><img src="<?= $path_to_images ?>images/Station%20number.jpg" /></p>
<p>2. Set PLC name maybe convenience distinguish many PLCs on the network, PLC name support maximum 6 chinese characters or 12 english characters. numeral.</p>
<p>3. PLC scan overtime time: thus watch dog time, unit is milliscond (ms). When PLC program running reality scan time greater than the value, will generate error code 141, thus "SV3=141 scan overtime, watch dog action". PLC stop running.</p>
<p>4. Tick "Use PLC soft address", input PLC address value, click " Confirm". After use PLC soft address the hardware 4 DIP switch will be invalid.</p>