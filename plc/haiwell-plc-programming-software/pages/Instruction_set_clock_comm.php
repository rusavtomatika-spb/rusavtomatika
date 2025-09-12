<h2 id="Clock_instruction">Clock instruction</h2>
<hr>
<p>System clock instruction list as follows</p>
<table>
    <thead>
        <tr>
            <td rowspan="2"> Instruction name</td>
            <td rowspan="2"> 8 bit model</td>
            <td rowspan="2"> 32 bit model</td>
            <td rowspan="2"> Instruction function</td>
            <td colspan="3"> Support language</td>
        </tr>
        <tr>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> <a href="#TCMP_Real_time_clock_comparison">TCMP</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> Real time clock comparison</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#TACCU_Time_accumulative_total">TACCU</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Time accumulative total</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#SCLK_Setup_system_clock">SCLK</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Setup system clock</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#TIME_Time_switch">TIME</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Time switch</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#DATE_Date_switch">DATE</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Date switch</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#INVT_Count_down">INVT</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Count down</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="TCMP_Real_time_clock_comparison">TCMP(Real time clock comparison)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/tcmp.gif" /></p>
            </td>
            <td>
                <p> TCMP En, Clock, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/tcmp.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Clock</td>
            <td>
                <p> Clock compare start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy 6 continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Status output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy 3 continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. TCMP use for compare system real time clock and clock setup clock ,if system real time clock &gt;clock output&gt;state, if system real time clock =clock output=state, if system real time clock output</p>
<p> 2. Clock occupy 6 registers, respectively is year(0~9999). month(1~12). data(1~31). time(0~23). minute(0~59). second(0~59). if year set in 0~99 range , system default is 2000~2099 year.</p>
<p> 3. If clock is invalid time, instruction not execute.</p>
<p> [Instruction example] </p>
<p> <img src="<?= $path_to_images ?>images/gpc-tcmp.gif" /></p>
<p> [Program description]</p>
<p> 1. TCMP instruction get electricity from busbar and always execute.</p>
<p> 2. If V1000=2012. V1001=12. V1002=25. V1003=8. V1004=0. V1005=0, express setting time is 2012-12-25 8:0:0.</p>
<p> 3. System clock exit in SV12~SV18, when system real time clock &gt;Clock then M10=ON, when system real time clock =clock then M11=ON, when system real time clock </p>
<h3 id="TACCU_Time_accumulative_total">TACCU(Time accumulative total)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/taccu.gif" /></p>
            </td>
            <td>
                <p> TACCU En, Rst, CT</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/taccu.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Rst</td>
            <td>
                <p> Reset</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> CT</td>
            <td>
                <p> Accumulative time </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy 6 continuous component</p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. TACCU instruction according to second unit accumulative En=ON time, output total accumulative second(CT. CT+1) and accumulative data (CT+2). hour(CT+3). minute(CT+4). second(CT+5) relative to the accumulative second.</p>
<p> 2. Accumulative time CT must use power-off preserve area register, default power-off preserve registers are V1000~V2047.</p>
<p> 3. After accumulative second(CT. CT+1) reach maximum value 2147483647 automatic reset to 0.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-taccu.gif" /></p>
<p> [Program description]</p>
<p> 1. Network 1 get electricity from busbar , that is accumulative PLC running time .</p>
<p> 2. Network 2 If X0 is equipmentx running feedback signal ,X0=ON, TACCU execute timing ,X0=OFF then not timing.</p>
<h3 id="SCLK_Setup_system_clock">SCLK(Setup system clock)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/sclk.gif" /></p>
            </td>
            <td>
                <p> SCLK En, Clock</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/sclk.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Clock</td>
            <td>
                <p> Clock data start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy 6 continuous component</p>
            </td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. SCLK instruction modify the PLC real time clock by the set clock data .</p>
<p> 2. Clock occupy 6 register, respectively is year(0~9999). month(1~12). data(1~31). hour(0~23). minute(0~59). second(0~59). if year set in0~99 range , system default is 2000~2099 year.</p>
<p> 3. If clock is invalid time, instruction not execute.</p>
<p> 4. SCLK instruction executed by edge.</p>
<p> 5. Also can modify by program software menu[PLC/ set PLC clock], must not program. refer to "<a href="/plc/haiwell-plc-programming-software/Online_control_PLC/#PLC clock">set PLC clock</a>"</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-sclk.gif" /></p>
<p> [Program description]</p>
<p> 1. If V1000=2012. V1001=12. V1002=25. V1003=8. V1004=0. V1005=0, express setting time is 2012-12-25 8:0:0.</p>
<p> 2. When M0=ON,PLC system clock setup is 2012-12-25 8:0:0.</p>
<h3 id="TIME_Time_switch">TIME(Time switch)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/time.gif" /></p>
            </td>
            <td>
                <p> TIME En, OnTime, OffTime, Act, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/time.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> OnTime</td>
            <td>
                <p> ON actuation time</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> OffTime</td>
            <td>
                <p> OFF actuation time </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Act</td>
            <td>
                <p> Control model</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td> Status output</td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. TIME instruction use week as control cycle, get by set ON. OFF actuation time control output. </p>
<p> 2. Act is control model, it bits b0~b6 respectively are express monday~sunday control model, when it relevant bit is1 then express the data ON. OFF actuation time is valide, is 0 then express the data not actuation.</p>
<p> 3. If ON actuation time &lt;OFF actuation time , express in current data ON and OFF. if ON actuation time &gt;OFF actuation time , express cross-day ON and OFF.</p>
<p> 4. Ontime. Offtime if is register input, then high byte is hour(0~23) low byte is minute(0~59);if is constant input, input format is :hh:mm(as 8 clock 5 minute,input 08:05).</p>
<p> 5. If Ontime is invalid time then ON actuation invalid. If Offtime is invalid time then OFF actuation invalid.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-time.gif" /></p>
<p> [Program description]</p>
<p> Act=127(01111111) express monday ~sunday valid, when M0=ON,TIME instruction execute, every day 8:30~16:30 among Y0=ON, others timeY0=OFF.</p>
<h3 id="DATE_Date_switch">DATE(Date switch)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/date.gif" /></p>
            </td>
            <td>
                <p> DATE En, OnDate, OffDate, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/date.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> OnDate</td>
            <td>
                <p> ON actuation data </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> OffDate</td>
            <td>
                <p> OFF actuation data </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Status output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. DATE instruction use year as control cycle, get by ON. OFF actuation time control output. </p>
<p> 2. If ON actuation data &lt;OFF actuation data , express in current year ON and OFF. if ON actuation data &gt;OFF actuation data , express in cross-year ON and OFF.</p>
<p> 3. OnDate. OffDate if is register input, then high byte is month(1~12) low byte is data(1~31); if is constant input, input format is :mm-dd(as august 5,Input 08-05).</p>
<p> 4. If OnDate is invalid data then ON actuation invalid. If OffDate is invalid data then OFF actuation invalid .</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-date.gif" /></p>
<p> [Program description]</p>
<p> When M0=ON ,DATE instruction executing, from current year august 1to next year january 31Y0=ON, others time Y0=OFF.</p>
<h3 id="INVT_Count_down">INVT(Count down)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/invt.gif" /></p>
            </td>
            <td>
                <p> INVT En, Clock, Out, Rtv</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/invt.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Clock</td>
            <td>
                <p> Count down start time component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy 6 continuous component</p>
            </td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Count down to output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Rtv</td>
            <td>
                <p> Remaining time </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy 4 continuous component</p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. INVT instruction according to set count down time clock calculate from current value to set time still remaining data(Rtv). hour(Rtv+1). minute(Rtv+2). second(Rtv+3),when reach the timing time output Out.</p>
<p> 2. Clock occupy 6 registers ,respectively year(0~9999). month(1~12). data(1~31). time(0~23). minute(0~59). second(0~59). if year set in 0~99 range , system default as 2000~2099 year.</p>
<p> 3. if Clock is invalid time, instruction not execute.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-invt.gif" /></p>
<p> [Program description]</p>
<p> 1. If V1000=2013. V1001=12. V1002=25. V1003=8. V1004=0. V1005=0, express set count down time is 2013-12-25 8:0:0.</p>
<p> 2. When M0=ON,INVT instruction start count down, automatic calculate from current value to 2013-12-25 8:0:0 remaining data. hour. minute. second, after timing time reach output Y0=ON.</p>
<h3 id="Communication_instruction">Communication instruction</h3>
<hr>
<p>Communication instruction list as follows</p>
<table>
    <thead>
        <tr>
            <td rowspan="2"> Instruction name</td>
            <td rowspan="2"> 8 bit model</td>
            <td rowspan="2"> 32 bit model</td>
            <td rowspan="2"> Instruction function</td>
            <td colspan="3"> Support language</td>
        </tr>
        <tr>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> <a href="#SUM_SUM_LB_SUM_verify">SUM</a></td>
            <td>
                <p> SUM.LB</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> SUM verify</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#BCC_BCC_LB_BCC_verify">BCC</a></td>
            <td>
                <p> BCC.LB</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> BCC verify</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#CRC_CRC_LB_CRC_verify">CRC</a></td>
            <td>
                <p> CRC.LB</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> CRC verify</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#LRC_LRC_LB_LRC_verify">LRC</a></td>
            <td>
                <p> LRC.LB</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> LRC verify</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#COMM_COMM_LB_Serial_communications">COMM</a></td>
            <td>
                <p> COMM.LB</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Serial communications</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#MODR_Modbus_read">MODR</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Modbus read</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#MODW_Modbus_write">MODW</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Modbus write</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#HWRD_Haiwellbus_read">HWRD</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Haiwellbus read</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#HWWR_Haiwellbus_write">HWWR</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Haiwellbus write</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#RCV_Receive_communication_data">RCV</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Receive communication data</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#XMT_XMT_LB_Sent_communication_data">XMT</a></td>
            <td> XMT.LB</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Sent communication data</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#FROM_Extend_module_CR_register_read">FROM</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Extend module CR register read</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#TO_Extend_module_CR_register_write">TO</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Extend module CR register write</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#TCPMDR_Modbus_TCP_read">TCPMDR</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Modbus TCP read</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#TCPMDW_Modbus_TCP_write">TCPMDW</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p>Modbus TCP write</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#TCPHWR_Haiwellbus_TCP_read">TCPHWR</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Haiwellbus TCP read</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
        <tr>
            <td> <a href="#TCPHWW_Haiwellbus_TCP_write">TCPHWW</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Haiwellbus TCP write</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td>
                <p> v</p>
            </td>
        </tr>
    </tbody>
</table>
<p> Note:Haiwell PLC support standard Modbus protocol. Haiwellbus protocol. freedom communication protocol, PLC use as slave no need any communication program, upper computer (configuration software. touch panel. text display etc. HMI) can direct use Modbus protocol access Haiwell PLC. refer to "
    <a href="/plc/haiwell-plc-programming-software/Appendix/#Communication_address_code_table">communication address code table </a>"</p>
<p> <strong>Haiwell PLC communication main features : </strong></p>
<p> 1. Haiwellbus protocol is a efficient . high speed communication protocol, support disperse . blended data transfer, communication efficient very well.</p>
<p> 2. Haiwell PLC support maximum 5 communication port, the same function of all communication port , all can use for program . upload download program. monitor . networking.</p>
<p> 3. 5 communication port fully independent , concurrent working , support different different baud rate . different protocol format . different manufacturer equipment connected in same network.</p>
<p> 4. Need not worry about communication port collision problem, need not control communication instruction execute time sequence ,all communication instruction can concurrent get electricity execute.</p>
<p> 5. Via communication instruction Out item can intuitive judgment communicate succeed or not , can use it for alarm the communicate fail between slave.</p>
<p> 6. Haiwell PLC communication is zero spare on network physics level , if slave equipment not support so high speed communication, can assigned SV141 to insert a interval among the communication instruction.</p>
<h3 id="SUM_SUM_LB_SUM_verify">SUM. SUM.LB(SUM verify)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 8 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/sum.gif" /> <img src="<?= $path_to_images ?>images/sum.lb.gif" /></p>
            </td>
            <td>
                <p> SUM En, Sou, N, Out</p>
                <p> SUM.LB En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/sum.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> SUM: occupy (N+1)\2 continuous component,SUM.LB: occupy N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Verify number of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> SUM verify code output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> Sum verify code computing method: use for get accumulation sum start from Sou N number of bytes , get low byte, exceed 256 part overflow.SUM.LB is Low byte model, only calculate sum verify code of low byte, high byte notuse .</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-sum.gif" /></p>
<p> [Program description]</p>
<p> When M0=ON, calculate SUM verify code, as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou</strong><strong> component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>SUM Output</strong></p>
            </td>
            <td>
                <p> <strong>SUM.LB Output</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 0x8181</p>
            </td>
            <td rowspan="5">
                <p> V0=0xB3</p>
            </td>
            <td rowspan="5">
                <p> V2=0x30</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 0x0152</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002</p>
            </td>
            <td>
                <p> 0x0000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 0x0153</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 0x0D0A</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="BCC_BCC_LB_BCC_verify">BCC. BCC.LB(BCC verify)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 8 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/bcc.gif" /> <img src="<?= $path_to_images ?>images/bcc.lb.gif" /></p>
            </td>
            <td>
                <p> BCC En, Sou, N, Out</p>
                <p> BCC.LB En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/bcc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> BCC: occupy (N+1)\2 continuous component,BCC.LB: occupy N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> verify sumber of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> BCC code output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> BCC verify code computing method: use for XOR operation start from Sou N Number of bytes .BCC.LB is Low byte model, only calculate low byte BCC verify code, high byte not use.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bcc.gif" /></p>
<p> [Program description]</p>
<p> When M0=ON, calculate BCC verify code, as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou</strong><strong> component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>BCC Output</strong></p>
            </td>
            <td>
                <p> <strong>BCC.LB Output</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 0x8181</p>
            </td>
            <td rowspan="5">
                <p> V0=0xB</p>
            </td>
            <td rowspan="5">
                <p> V2=0x8A</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 0x0152</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002</p>
            </td>
            <td>
                <p> 0x0000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 0x0153</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 0x0D0A</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="CRC_CRC_LB_CRC_verify">CRC. CRC.LB(CRC verify)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 8 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/crc.gif" /> <img src="<?= $path_to_images ?>images/crc.lb.gif" /></p>
            </td>
            <td>
                <p> CRC En, Sou, N, Out</p>
                <p> CRC.LB En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/crc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> CRC: occupy (N+1)\2 continuous component,CRC.LB: occupy N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Verify number of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> CRC code output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> CRC calculate CRC verify code start from Sou N number of bytes .CRC.LB is Low byte model, only calculate low byte CRC verify code, high byte not use.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-crc.gif" /></p>
<p> [Program description]</p>
<p> When M0=ON, calculate CRC verify code, as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou</strong><strong> component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>CRC Output</strong></p>
            </td>
            <td>
                <p> <strong>CRC.LB Output</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 0x8181</p>
            </td>
            <td rowspan="5">
                <p> V0=0x98AC</p>
            </td>
            <td rowspan="5">
                <p> V2=0xB4</p>
                <p> V3=0x51</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 0x0152</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002</p>
            </td>
            <td>
                <p> 0x0000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 0x0153</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 0x0D0A</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="LRC_LRC_LB_LRC_verify">LRC. LRC.LB(LRC verify)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 8 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/lrc.gif" /> <img src="<?= $path_to_images ?>images/lrc.lb.gif" /></p>
            </td>
            <td>
                <p> LRC En, Sou, N, Out</p>
                <p> LRC.LB En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/lrc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> LRC: occupy (N+1)\2 continuous component,LRC.LB: occupy N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Verify number of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> LRC code output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> LRC verify code computing method: use for get accumulation sum start from Sou N number of bytes and then O 2's complement code. LRC.LB is low byte model, only calculate low byte LRC verify code, high byte not use.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-lrc.gif" /></p>
<p> [Program description]</p>
<p> When M0=ON, calculate LRC verify code,as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou</strong><strong> component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>LRC Output</strong></p>
            </td>
            <td>
                <p> <strong>LRC.LB Output</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 0x8181</p>
            </td>
            <td rowspan="5">
                <p> V0=0xFE4D</p>
            </td>
            <td rowspan="5">
                <p> V2=0xD0</p>
                <p> V3=0xFE</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 0x0152</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002</p>
            </td>
            <td>
                <p> 0x0000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 0x0153</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 0x0D0A</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="COMM_COMM_LB_Serial_communications">COMM. COMM.LB(Serial communications)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 8 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/comm.gif" /> <img src="<?= $path_to_images ?>images/comm.lb.gif" /></p>
            </td>
            <td>
                <p> COMM En, Txd, Tn, Rn, Ptotocol, Port, Out, Err, Rxd</p>
                <p> COMM.LB En, Txd, Tn, Rn, Ptotocol, Port, Out, Err, Rxd</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/comm.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Txd</td>
            <td>
                <p> Send data start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Tn</td>
            <td>
                <p> Send data number of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 0~512</td>
        </tr>
        <tr>
            <td> Rn</td>
            <td>
                <p> Receive data number of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> 0~512</td>
        </tr>
        <tr>
            <td> Protocol</td>
            <td>
                <p> Communication protocol </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Port</td>
            <td>
                <p> Communication port </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete output </p>
            </td>
            <td> ?</td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Err</td>
            <td>
                <p> Error indication </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Rxd</td>
            <td>
                <p> Receive data start component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. When PLC communicate in freedom protocol between external equipment,use COMM instruction send and receive data .At the moment PLC is master, external equipment is slave.</p>
<p> 2. When Tn=0 ,COMM instruction only receive data without send data .When Rn=0 ,COMM instruction only send data without receive data .When Tn=Rn=0 ,COMM instruction not execute.</p>
<p> 3. COMM instruction executing, in accordance with protocol defined communication format ( baud rate . data bit . stop bit . verification mode) use for Txd start Tn number of bytes data send to Port assigned serial port ,after send complete , if Rn&gt;0 then automatic go to receive state, receive complete Out=ON, received data put on Rxd; if Rn=0 then not receive data Out=ON, system execute next communication instruction. if communication instruction not complete then Err=ON. </p>
<p> 4. COMM instruction have two modes send data: high low byte send mode (COMM) and only send low byte mode (COMM.LB)</p>
<p> 5. COMM instruction can use with XMT. MODR. MODW. HWRD. HWWR instruction at the same time .but can not use the same communication port with RCV instruction .</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-comm.gif" /></p>
<p> [Program description]</p>
<p> 1. According to AI-708M itinerant detector communication protocol ,read 3 channel measure value from AI-708M itinerant detector communication instruction put on initial register value table " read AI-708M itinerant detector command" :</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong> component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value </strong></p>
            </td>
            <td>
                <p> <strong>Declare </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 0x8383</p>
            </td>
            <td rowspan="4">
                <p> First channel read command</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td> 0x0152</td>
        </tr>
        <tr>
            <td>
                <p> V1002</p>
            </td>
            <td>
                <p> 0x0000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 0x0155</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 0x8484</p>
            </td>
            <td rowspan="4">
                <p> Second channel read command</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td> 0x0152</td>
        </tr>
        <tr>
            <td>
                <p> V1006</p>
            </td>
            <td>
                <p> 0x0000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1007</p>
            </td>
            <td>
                <p> 0x0156</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1008</p>
            </td>
            <td>
                <p> 0x8585</p>
            </td>
            <td rowspan="4">
                <p> Third channel read command</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1009</p>
            </td>
            <td> 0x0152</td>
        </tr>
        <tr>
            <td>
                <p> V1010</p>
            </td>
            <td>
                <p> 0x0000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1011</p>
            </td>
            <td>
                <p> 0x0157</p>
            </td>
        </tr>
    </tbody>
</table>
<p> 2. 3 COMM instruction get electricity from busbar and always execute, PLC automatic in sequence send communication command to AI-708M itinerant detector moreover use for returned measure value output to instruction Rxd.</p>
<p> 3. Do not warry about communication port conflict , do not control communication instruction executed time sequence , system automatic executed completely .</p>
<h3 id="MODR_Modbus_read">MODR(Modbus read)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/modr.gif" /></p>
            </td>
            <td>
                <p> MODR En, Slave, Code, Read, N, Ptotocol, Port, Out, Rxd</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/modr.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Slave</td>
            <td>
                <p> Slave equipment address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Code</td>
            <td>
                <p> Function code </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Read</td>
            <td>
                <p> Read data start address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of data </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> 1~127</td>
        </tr>
        <tr>
            <td> Protocol</td>
            <td>
                <p> Communication protocol </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Port</td>
            <td>
                <p> Communication port </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Rxd</td>
            <td>
                <p> Receive data start component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> Occupy N continuous component</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. MODR instruction use for communication with all the third party equipment are support Modbus protocol.</p>
<p> 2. When PLC communication with external equipment by the serial port ,use MODR instruction read data from external equipment . This moment PLC as master ,external equipment as slave. </p>
<p> 3. MODR instruction do not write any verify code, it automatic verified the returned data ,verify correct Out=ON, read data put on Rxd.</p>
<p> 4. MODR instruction can use with COMM . XMT. MODW. HWRD. HWWR instruction at the same time .but can not use the same communication port with RCV instruction.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-modr.gif" /></p>
<p> [Program description]</p>
<p> 1. MODR instruction read station 1 external module (If module is S04AI) 4 channel measured value (CR Parameter no.16~19), read data store to V0~V3.</p>
<p> 2. Different model module the CR number not the same, detail information refer to <a href="/plc/haiwell-plc-programming-software/Hardware_manual/">Hardware manual</a>" <a href="/plc/haiwell-plc-programming-software/Hardware_manual/#Extend_module_parameter">extend module Parameter</a>" section.</p>
<h3 id="MODW_Modbus_write">MODW(Modbus write)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/modw.gif" /></p>
            </td>
            <td>
                <p> MODW En, Slave, Code, Write, Val, N, Ptotocol, Port, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/modw.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Slave</td>
            <td>
                <p> Slave equipment address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Code</td>
            <td>
                <p> Function code </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Write</td>
            <td>
                <p> Write target start address</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Val</td>
            <td>
                <p> Be rote data start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> Occupy N continuous component</td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of data </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~127</td>
        </tr>
        <tr>
            <td> Protocol</td>
            <td>
                <p> Communication protocol </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Port</td>
            <td>
                <p> Communication port </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. MODW instruction use for communication with all the third party equipment are support Modbus protocol.</p>
<p> 2. When PLC communication with external equipment by the serial port ,use MODW instruction write data to external equipment . This moment PLC as master ,external equipment as slave Modbus . </p>
<p> 3. MODW instruction do not write any verify code, it automatic verified the returned data ,verify correct Out=ON express write succeed.</p>
<p> 4. MODW instruction can use with COMM . XMT. MODR. HWRD. HWWR instruction at the same time .but can not use the same communication port with RCV instruction.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-modw.gif" /></p>
<p> [Program description]</p>
<p> 1. According to inovance inverter communication protocol ( please refer to inovance inverter manual part of communication), preset frequency Modbus address is 4096,MODW instruction write V80 value to inverter real time.</p>
<p> 2. Running frequency Modbus address is 4097,MODR instruction read the current frequency of the inverter store to V82 .</p>
<h3 id="HWRD_Haiwellbus_read">HWRD(Haiwellbus read)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/hwrd.gif" /></p>
            </td>
            <td>
                <p> HWRD En, Slave, Table, Port, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/hwrd_hwwr.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Slave</td>
            <td>
                <p> Slave equipment address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Table</td>
            <td>
                <p> Haiwellbus read communication table </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Port</td>
            <td>
                <p> Communication port </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. HWRD instruction according to defined "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Haiwellbus_read_communication_table">Haiwellbus read communication table</a>" automatic swap the data with slave . </p>
<p> 2. Haiwellbus protocol support disperse . blended data transfer, communication efficient very well.</p>
<p> 3. HWRD instruction can use with COMM . XMT. MODR. MODW. HWWR instruction at the same time .but can not use the same communication port with RCV instruction .</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-hwrd_hwwr.gif" /></p>
<p> [Program description]</p>
<p> 1. Define Haiwellbus read communication table " read 2# PLC data "as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong>Read data from slave</strong></p>
            </td>
            <td>
                <p> <strong>Write date to slave</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> X0</p>
            </td>
            <td>
                <p> M10</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> X3</td>
            <td> M11</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> V11</p>
            </td>
            <td>
                <p> V80</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> V12</p>
            </td>
            <td>
                <p> V81</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td>
                <p> AI0</p>
            </td>
            <td>
                <p> V20</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td>
                <p> AI1</p>
            </td>
            <td>
                <p> V21</p>
            </td>
        </tr>
    </tbody>
</table>
<p> 2. Define Haiwellbus write communication table " write 2# PLC data "as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Read data from slave</strong></p>
            </td>
            <td>
                <p> <strong> Write date to slave</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> X0</p>
            </td>
            <td>
                <p> M100</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> X1</td>
            <td> M101</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> V0</p>
            </td>
            <td>
                <p> V100</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> V50</p>
            </td>
            <td>
                <p> V102</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td>
                <p> Y4</p>
            </td>
            <td>
                <p> M0</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td>
                <p> Y5</p>
            </td>
            <td>
                <p> Y0</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td>
                <p> V60</p>
            </td>
            <td>
                <p> V200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td>
                <p> V61</p>
            </td>
            <td>
                <p> V201</p>
            </td>
        </tr>
    </tbody>
</table>
<p> 3. HWRD. HWWR instruction get electricity from busbar and always execute, according above define Haiwellbus read (write)
    communication table ,automatic swap data with 2#PLC .</p>
<h3 id="HWWR_Haiwellbus_write">HWWR(Haiwellbus write)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/hwwr.gif" /></p>
            </td>
            <td>
                <p> HWWR En, Slave, Table, Port, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/hwrd_hwwr.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Slave</td>
            <td>
                <p> Slave equipment address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Table</td>
            <td>
                <p> Haiwellbus write communication table </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Port</td>
            <td>
                <p> Communication port </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. HWWR instruction according to define "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Haiwellbus_write_communication_table">Haiwellbus write communication table</a>"
    automatic swap data with slave. </p>
<p> 2. Haiwellbus protocol support disperse . blended data transfer, communication efficient very well.</p>
<p> 3. HWWR instruction can use with COMM . XMT. MODR. MODW. HWRD instruction at the same time .but can not use the same communication port with RCV instruction .</p>
<p> [Instruction example]</p>
<p> Refer to <a href="#HWRD_Haiwellbus_read">HWRD</a> instruction example.</p>
<h3 id="RCV_Receive_communication_data">RCV(Receive communication data)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/rcv.gif" /></p>
            </td>
            <td>
                <p> RCV En, Schr, Echr, Rn, Ptotocol, Port, Out, Rxd</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/rcv_xmt.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Schr</td>
            <td>
                <p> start character</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Echr</td>
            <td>
                <p> ending character</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Rn</td>
            <td>
                <p> Receive data Number of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> 0~512</td>
        </tr>
        <tr>
            <td> Protocol</td>
            <td>
                <p> Communication protocol </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Port</td>
            <td>
                <p> Communication port </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Rxd</td>
            <td>
                <p> Receive data start component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. At upper computer is communication master ,PLC is communication slave , moreover upper computer must use freedom communication protocol need use RCV instruction.</p>
<p> 2. RCV instruction passive receiving data sent from upper computer , if need response to upper computer then use XMT instruction sent the response data. </p>
<p> 3. Schr is start character define, if Schr=0 express no start character, if Schr high byte=0 low byte&lt;&gt;0 express only one start character (e.x.Schr=0x003A,start character is 0x3A), if Schr high byte&lt;&gt;0 express2start character (e.x. Schr=0x833A,start character is 0x3A. 0x83). </p>
<p> 4. Echr is ending character define, if Echr=0 express no ending character, if Echr high byte=0 low byte&lt;&gt;0 express only one ending character (e.x. Echr=0x000D, ending character is 0x0D), if Echr high byte&lt;&gt;0 express2 ending character (e.x. Echr=0x0A0D, ending character is 0x0D. 0x0A). </p>
<p> 5. If define start character or ending character ,RCV according to start character. ending character process match , only match correct express communication succeed , receive data output to Rxd;When Schr and Echr all is 0,that is start character and ending character all not define, then RCV instruction use for according to communication port communicate overtime to judge the start end of the communication frame .When receive the first byte of a new frame or communicate overtime RCV instruction will automatic reset Out and Rxd.</p>
<p> 6. Rn is receive data number of bytes, e.x. :RCV instruction want receive 22 bytes send from upper computer , then assign Rn=22.Note: if the length of the command send from upper computer not fixed, then use for receive number of bytes define to 0, express disregard receive number of bytes.</p>
<p> 7. One communication port only use one RCV instruction, moreover use with COMM. MODR. MODW. HWRD. HWWR instructionuse at the same communication port .</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-rcv_xmt.gif" /></p>
<p> [Program description]</p>
<p> 1. Network 1 start one RCV passive receiving instruction, start character match 0x3A, ending character match 0x0D 0x0A, receive 4 number of bytes, communication format 19200,n,8,2, communication port 2,receive data put on V0V1,receive data correct then each communicate M0=ON.</p>
<p> 2. When M0=ON receive data correct, compare second byte (V0 high byte), if equal to 1 then execute XMT instruction return V1000V1001 , if equal to 2 then execute XMT instruction return V100~V102, if equal to 3 then execute XMT instruction return V200~V203.</p>
<h3 id="XMT_XMT_LB_Sent_communication_data">XMT. XMT.LB(Sent communication data)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 8 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/xmt.gif" /> <img src="<?= $path_to_images ?>images/xmt.lb.gif" /></p>
            </td>
            <td>
                <p> XMT En, Txd, Tn, Ptotocol, Port, Out</p>
                <p> XMT.LB En, Txd, Tn, Ptotocol, Port, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/rcv_xmt.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Txd</td>
            <td>
                <p> Send data start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Tn</td>
            <td>
                <p> Send data Number of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 0~512</td>
        </tr>
        <tr>
            <td> Protocol</td>
            <td>
                <p> Communication protocol </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Port</td>
            <td>
                <p> Communication port </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. At upper computer is communication master ,PLC is communication slave , moreover upper computer must use freedom communication protocol need use XMT instruction.</p>
<p> 2. XMT instruction general use for cooperate RCV instruction , RCV instruction receive data send from upper computer , if need response to upper computer then use XMT instruction send response data. </p>
<p> 3. XMT instruction have two send modes :high low byte send mode (XMT) and only send low byte mode (XMT.LB).</p>
<p> 4. XMT instruction can repeat ,XMT instruction different from COMM instruction ,it only can send data can not receive data .</p>
<p> [Instruction example]</p>
<p> Refer to <a href="#RCV_Receive_communication_data">RCV</a> instruction example.</p>
<h3 id="FROM_Extend_module_CR_register_read">FROM(Extend module CR register read)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/from.gif" /></p>
            </td>
            <td>
                <p> FROM En, Slot, CR, N, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/from_to.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Slot</td>
            <td>
                <p> Module position number </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Cr</td>
            <td>
                <p> CR register be read </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of CR be read </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~120</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Return start component </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> Occupy N continuous component</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. FROM use for read extend module parameter get by parallel bus in program .</p>
<p> 2. PLC automatic allocation extend module IO channel corresponding component address on parallel bus,
    moreover real time refresh IO of extend module , so general not use FROM instruction.detail refer to "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#PLC_hardware_configuare">PLC hardware configure </a>" section. </p>
<p> 3. Different model extend module CR register not the same ,detail refer to
    <a href="/plc/haiwell-plc-programming-software/Hardware_manual/">hardware manual </a> "
    <a href="/plc/haiwell-plc-programming-software/Hardware_manual/#Extend_module_parameter">extend module parameter</a>" section.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-from_to.gif" /></p>
<p> [Program description]</p>
<p> 1. When M0=ON, read first extend module (if module model is S04AI) 4 Input channel measure value .</p>
<p> 2. When M1=ON, modify the zero point corrected value to 30 (If V1000=30)of first channel of the extend module .</p>
<h3 id="TO_Extend_module_CR_register_write">TO(Extend module CR register write)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/to.gif" /></p>
            </td>
            <td>
                <p> TO En, Slot, CR, Val, N</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/from_to.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Slot</td>
            <td>
                <p> Module position number </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Cr</td>
            <td>
                <p> CR register be wrote</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Val</td>
            <td>
                <p> Data start component be wrote</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Occupy N continuous component</td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of CR be wrote </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~120</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. TO use for write extend module parameter get by parallel bus in program. May "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#PLC_hardware_configuare">PLC hardware configure</a>"
    window configure module parameter, when PLC program be downloaded automatic download ,So general need not use TO instruction. </p>
<p> 2. Different model extend module CR register not the same ,detail refer to
    <a href="/plc/haiwell-plc-programming-software/Hardware_manual/"> hardware manual </a>"
    <a href="/plc/haiwell-plc-programming-software/Hardware_manual/#Extend_module_parameter">extend module parameter</a>" section.</p>
<p> [Instruction example]</p>
<p> Refer to <a href="#FROM_Extend_module_CR_register_read">FROM</a> instruction example.</p>
<h3 id="TCPMDR_Modbus_TCP_read">TCPMDR(Modbus TCP read)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/tcpmdr.gif" /></p>
            </td>
            <td>
                <p> TCPMDR En, IP, Code, Read, N, Out, Rxd</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/TCPMDR.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> IP</td>
            <td>
                <p> Slave equipment IP address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Code</td>
            <td>
                <p> Function code </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Read</td>
            <td>
                <p> Read data start address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of data </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> 1~127</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Rxd</td>
            <td>
                <p> Receive data start component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> Occupy N continuous component</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> TCPMDR instruction is used for reading the data of the device supporting Modbus TCP protocol.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc_tcpmdr.gif" /></p>
<p> [Program description]</p>
<p> 1. TCPMDR instruction will read the four channels' measurement value (CR parameters No. 16 to 19) of the remote module of the IP address 192.168.1.111 (assume that the module type is S04AI-e), and then the reading data will be stored in V0 ~ V3.</p>
<p> 2. Different model module the CR number not the same, detail information refer to
    <a href="/plc/haiwell-plc-programming-software/Hardware_manual/#Hardware_manual">Hardware manual</a>"
    <a href="/plc/haiwell-plc-programming-software/Hardware_manual/#Extend_module_parameter">extend module Parameter</a>" section.</p>
<h3 id="TCPMDW_Modbus_TCP_write">TCPMDW(Modbus TCP write)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/tcpmdw.gif" /></p>
            </td>
            <td>
                <p> TCPMDW En, IP, Code, Write, Val, N, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/TCPMDW.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> IP</td>
            <td>
                <p> Slave equipment IP address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Code</td>
            <td>
                <p> Function code </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Write</td>
            <td>
                <p> Write target start address</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Val</td>
            <td>
                <p> Be rote data start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> Occupy N continuous component</td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of data </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~127</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> TCPMDW instruction writes the data to the device supporting the Modbus TCP protocol.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc_tcpmdw.gif" /></p>
<p> [Program description]</p>
<p> 1. TCPMDW instruction writes the data V0 ~ V3 to the four output channels (CR parameters No. 16 to 19) of the remote module of the IP address 192.168.1.111(assume that the module type is S04AO-e).</p>
<p> 2. Different model module the CR number not the same, detail information refer to
    <a href="/plc/haiwell-plc-programming-software/Hardware_manual/#Hardware_manual">Hardware manual</a>"
    <a href="/plc/haiwell-plc-programming-software/Hardware_manual/#Extend_module_parameter">extend module Parameter</a>" section.</p>
<h3 id="TCPHWR_Haiwellbus_TCP_read">TCPHWR(Haiwellbus TCP read)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/tcphwr.gif" /></p>
            </td>
            <td>
                <p> TCPHWR En, IP, Table, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/TCPHWR_TCPHWW.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> IP</td>
            <td>
                <p> Slave equipment IP address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Table</td>
            <td>
                <p> Haiwellbus read communication table </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. TCPHWR instruction automatically exchanged the data with the slave device according to the definition of "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Haiwellbus_read_communication_table">Haiwellbus read communication table</a>" using Haiwellbus TCP protocol.</p>
<p> 2. Haiwellbus TCP protocol support disperse . blended data transfer, communication efficient very well.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc_tcphwr-tcphww.gif" /></p>
<p> [Program description]</p>
<p> 1. Define Haiwellbus read communication table " read 2# PLC data "as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong>Read data from slave</strong></p>
            </td>
            <td>
                <p> <strong>Write date to slave</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> X0</p>
            </td>
            <td>
                <p> M10</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> X3</td>
            <td> M11</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> V11</p>
            </td>
            <td>
                <p> V80</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> V12</p>
            </td>
            <td>
                <p> V81</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td>
                <p> AI0</p>
            </td>
            <td>
                <p> V20</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td>
                <p> AI1</p>
            </td>
            <td>
                <p> V21</p>
            </td>
        </tr>
    </tbody>
</table>
<p> 2. Define Haiwellbus write communication table " write 2# PLC data "as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Read data from slave</strong></p>
            </td>
            <td>
                <p> <strong> Write date to slave</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> X0</p>
            </td>
            <td>
                <p> M100</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> X1</td>
            <td> M101</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> V0</p>
            </td>
            <td>
                <p> V100</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> V50</p>
            </td>
            <td>
                <p> V102</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td>
                <p> Y4</p>
            </td>
            <td>
                <p> M0</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td>
                <p> Y5</p>
            </td>
            <td>
                <p> Y0</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td>
                <p> V60</p>
            </td>
            <td>
                <p> V200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td>
                <p> V61</p>
            </td>
            <td>
                <p> V201</p>
            </td>
        </tr>
    </tbody>
</table>
<p> 3. TCPHWR, TCPHWW instructions will execute after getting charged from the busbars, according to the definition of "Haiwellbus read (writte) communication table", and will automaticaly exchange the data with the 2# PLC of IP address 192.168.1.111.</p>
<h3 id="TCPHWW_Haiwellbus_TCP_write">TCPHWW(Haiwellbus TCP write)</h3>
<p> Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td> Language</td>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
            <td> Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/tcphww.gif" /></p>
            </td>
            <td>
                <p> TCPHWW En, IP, Table, Out</p>
            </td>
            <td>
                <p> <a href=" <?= $path_to_images ?>program/TCPHWR_TCPHWW.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download" /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td> Parameter</td>
            <td> Parameter define</td>
            <td> Input</td>
            <td> Output</td>
            <td> Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> IP</td>
            <td>
                <p> Slave equipment IP address </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Table</td>
            <td>
                <p> Haiwellbus write communication table </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Communication complete Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. TCPHWW instruction automatically exchanged the data with the slave device according to the definition of "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Haiwellbus_write_communication_table">Haiwellbus write communication table </a>" using Haiwellbus TCP protocol.</p>
<p> 2. Haiwellbus TCP protocol support disperse . blended data transfer, communication efficient very well.</p>
<p> [Instruction example]</p>
<p> Refer to <a href="#TCPHWR_Haiwellbus_TCP_read">TCPHWR</a> instruction example.</p>