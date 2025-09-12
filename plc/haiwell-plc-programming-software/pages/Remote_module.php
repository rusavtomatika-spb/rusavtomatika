<h1 id="Remote_module">Remote module</h1>
<hr>
<p>The section introduce the usage of Haiwell PLC extend module use for remote IO module </p>
<h3 id="Overview">Overview</h3>
<p>Haiwell PLC extend module built-in a RS485 communication port, support parallel bus ( use extend bus connect to parallel interface of PLC MPU ) also support serial bus( use RS485 communication port and communication port of PLC MPU networking, master use communication instruction control remote module ),when use serial bus to expand (as remote IO module), expand don't limited by the system points, may be distributed installation. This very important for a large number of disperse digital or analog signal(temperature. humidity. differential pressure. blowing rate. flow. fan rotate speed. valve open degree etc. ) need be sampled and monitored in the system, easy realize distributed installation moreover no expand point limited, vastly improve control system configuration flexible and in the future expand capacity, reduce wire and work load of all kinds of signal, meanwhile reduce disturb because analog signal wire too long, save project invest cost. </p>
<p>Click menu [Tools/Remote module] or click tool bar <img src="<?= $path_to_images ?>images/Remote_anniu.gif"  /> button, open " remote module " manage window. All control the remote module via the window complete. </p>
<p><img src="<?= $path_to_images ?>images/Remote_main.jpg"  /></p>
<h3 id="Module_station_number_setting_up">Module station number setting up</h3>
<p>Via hardware 4 bit DIP switch setting up remote module station number( also name station address. communication address). legal station number is 1~254(0 is broadcast address). 4 bit DIP may be express decimal number 1~15( binary number from 0001 ~ 1111), method of modify the station number via DIP switch as follow:</p>
<p><img src="<?= $path_to_images ?>images/SetPLCAddress.gif"  /></p>
<p>Up picture is the 4 bit DIP switch use to set the station number of the module, above is ON, below is OFF, in the picture black part express the switch position, the bit set side to ON express the bit is 1, set side to OFF express the bit is 0, first bit in up picture is ON, other bits are OFF. The first bit of the DIP switch express the 0 bit of binary(b0), the fourth bit of the DIP switch express third bit of binary(b3),thus,such as the DIP switch in up picture express 0001,also decimal data is 1, express the module station is 1( default is 1 when leave factory); If set the 1. 2 bits to ON side, moreover others witch set to OFF side,then be 0011, also decimal data is 3, express module station number is 3. </p>
<p>If 4xbit DIP switch express the hardware address not enough to use or there is no DIP switch of the module, may be use programming software set the station number. after online with the module may be modify the module station number in " Communication parameter " column "Address", then click " Parameter download", change the module station number. </p>
<p><img src="<?= $path_to_images ?>images/Remotemodule.jpg"  /></p>
<p>Note :If there is external DIP switch of the module, the address set by switch will be granted (4 bit DIP switch may be set the address range is 1~15);16 and above address or there is no DIP switch of the module then the address be set by programming software will be granted. </p>
<h3 id="Online_with_module">Online with module</h3>
<p>Connect to one or more module on the network. Because the module is RS485 communication, so must use RS232/485 converter convert the computer RS232 communication port to RS485 then online the module. After only online with the module succeed,then may be control the module on the network,such as up down load. parameter. online monitor etc. . </p>
<p>1. Click " remote module " window <img src="<?= $path_to_images ?>images/Remote_online_anniu.gif"  /> button, open " Online " window. </p>
<p><img src="<?= $path_to_images ?>images/Remote_online.jpg"  /></p>
<p>2. Set the related parameters, general condition use the default parameter need not modify it. </p>
<ul>
    <li>
        <p>PC port number: select the computer serial port communicate with the module. Useable COM serial port number in the listing different according to the computer, system will automatic search all useable COM serial port of the computer to user for select by user. </p>
    </li>
    <li>
        <p>Baud rate: select communication baud rate, system default is 19200. </p>
    </li>
    <li>
        <p>Data format: select communication data format, system default is "N,8,2 RTU". </p>
    </li>
    <li>
        <p>Start address. end address: if communicate to single module, use "Stand-alone search" option ; if communicate to many modules, then "Start address" input the minimum station number of the module, "End address" input the maximum station number of the module. </p>
    </li>
    <li>
        <p>Append to listing. cover listing: select the already online modules use append or cover to the listing. </p>
    </li>
    <li>
        <p>Stand-alone search: if communicate to single module, use "Stand-alone search" option ; if communicate to many modules, then must cancel "Stand-alone search" option moreover set "Start address" and "End address". </p>
    </li>
</ul>
<p>3. Online operation</p>
<ul>
    <li>
        <p>Online: direct click "Online" button, searched module (online succeed) will be display in the listing. </p>
    </li>
    <li>
        <p>Search: if forget about the baud rate etc. communication parameters, may be click "Find" button to search, search function will try all baud rate. all data format to communicate with the module, so need spend longer time for waitting for search the module, searched module (online succeed) will be display in the listing. </p>
    </li>
</ul>
<p>4. Click "Exit", close "Online" window. </p>
<p>5. If online unsuccessful,chances are below cause, look over to exclusion the problem, if can not exclusion please connect the technical support of
    <a target="_blank" href="http://en.haiwell.com/">Haiwell company</a> </p>
<p>A. Selected PC serial port not correct </p>
<p>B. Selected communication parameter and the communication parameter of the module are different </p>
<p>C. Module power off </p>
<p>D. Communication cable connected wrong or not connected well </p>
<p>E. Use "USB convert to RS232 serial port data line" not correct installed the driver</p>
<h3 id="Parameter_modify">Parameter modify</h3>
<p>1. After online succeed,parameters of the module will be upload automatic, as follow:</p>
<p><img src="<?= $path_to_images ?>images/Remote_par.jpg"  /></p>
<p>A. On the left side of the upper is module listing, here display the already connected modules. May be double click any module in the listing to select be current module, all online operation of the module as: upload download parameter. firmware upgrade etc. only fro current module, don't influence others module. </p>
<p>B. On the left side of the bottom is monitor zone, online monitoring use for display current module real time data. </p>
<p>2. Righ side parameter of module different according to different module type, major include signal type. use quantities. quantities upper lower limit. sampling number of times. zero revise. filtering time etc. . Refer to hardware manual
    "<a href="/plc/haiwell-plc-programming-software/Hardware_manual/#Extend_module_parameter">Extend module parameter</a>". </p>
<p>3. User can modify the parameter arbitrarily, then via " parameter download " button download to module. </p>
<p><strong> Note :signal type selected must the same as signal type of external sensor. </strong></p>
<h3 id="Parameter_upload">Parameter upload</h3>
<p>Click <img src="<?= $path_to_images ?>images/load_par_anniu.gif"  /> button will upload and display the parameter of current module at " remote module " window. </p>
<h3 id="Parameter_download">Parameter download</h3>
<p>Click <img src="<?= $path_to_images ?>images/download_par_anniu.gif"  /> button will download the modified parameter to the object module. </p>
<p><strong>Note :any parameter be modified, only take effect after via "Parameter download" download to object module. There is not execute "Parameter download" operation, parameters of object module will be no change. </strong></p>
<h3 id="Firmware_upgrade">Firmware upgrade</h3>
<p>Upgrade the firmware of the module, make the module support new function. </p>
<p>1. Click <img src="<?= $path_to_images ?>images/Remote_update_anniu.gif"  /> button,, open " firmware upgrade" window </p>
<p><img src="<?= $path_to_images ?>images/Remote_update.jpg"  /></p>
<p>2. Click " open " button, select the upgrade file according to the module. </p>
<p><img src="<?= $path_to_images ?>images/update_open.jpg"  /></p>
<p>3. Click "Upgrade" button,upgrade the firmware of the module. </p>
<p>Note :If interrupt during upgrading because power of or other reasons,must rerun firmware upgrade until upgrade successful. </p>
<h3 id="Online_monitor">Online monitor</h3>
<p>1. Click <img src="<?= $path_to_images ?>images/Remote_run_anniu.gif"  /> button enter into monitor status. Real time monitor input channel data of current module, also may force change the output data of the opu module. </p>
<p><img src="<?= $path_to_images ?>images/Remote_force.jpg"  /></p>
<p>2. Click <img src="<?= $path_to_images ?>images/Remote_stop_anniu.gif"  /> button exit monitor status. </p>