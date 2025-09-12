<h1 id="PLC_Register_and_Data">PLC Register and Data</h1>
<hr>
<h3 id="Overview">Overview</h3>
<div>
    <p> Haiwell PLC have configurated many component in the system (also call: variable. address), as: X. Y. M. AI. AQ. V etc. Components have Bit register and Word register, bit register occupy one bit express boolean variables, word register occupy one word (16 bits, 2 bytes) express data variables, they can be used again and again in program. In PLC use the soft component to operated in the program for arithmetic and control function. </p>
</div>

<h3 id="Data">Data</h3>
<div>
    <p><strong>1. Data type</strong></p>
    <table>
        <thead>
            <tr>
                <td>
                    <p> Data type</p>
                </td>
                <td>
                    <p> Explain</p>
                </td>
                <td>
                    <p> Data length</p>
                </td>
                <td>
                    <p> Range</p>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p> BOOL</p>
                </td>
                <td>
                    <p> bit</p>
                </td>
                <td>
                    <p> 1 bit component</p>
                </td>
                <td>
                    <p> 1(ON). 0(OFF)</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> INT</p>
                </td>
                <td>
                    <p> integer with sign</p>
                </td>
                <td>
                    <p> 16 bits, 1 register component</p>
                </td>
                <td>
                    <p> ?32768~32767</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> DINT</p>
                </td>
                <td>
                    <p> long integer with sign</p>
                </td>
                <td>
                    <p> 32 bits, 2 register components</p>
                </td>
                <td>
                    <p> ?2147483648~2147483647</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> REAL</p>
                </td>
                <td>
                    <p> floating point</p>
                </td>
                <td>
                    <p> 32bits, 2 register components</p>
                </td>
                <td>
                    <p> ?3. 402823e+38~3. 402823e+38</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> CHAR</p>
                </td>
                <td>
                    <p> character string</p>
                </td>
                <td>
                    <p> 1 character occupy one byte</p>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
        </tbody>
    </table>
    <p><strong>2. Component matching data type </strong></p>
    <table>
        <tbody>
            <tr>
                <td>
                    <p> Data type</p>
                </td>
                <td colspan="17">
                    <p> Component type</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> BOOL</p>
                </td>
                <td>
                    <p> </p>
                </td>
                <td>
                    <p> X</p>
                </td>
                <td>
                    <p> Y</p>
                </td>
                <td>
                    <p> T</p>
                </td>
                <td>
                    <p> C</p>
                </td>
                <td>
                    <p> M</p>
                </td>
                <td>
                    <p> SM</p>
                </td>
                <td>
                    <p> LM</p>
                </td>
                <td>
                    <p> S</p>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p> </p>
                </td>
                <td></td>
                <td>
                    <p> </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> INT</p>
                </td>
                <td>
                    <p> constant</p>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p> AI</p>
                </td>
                <td>
                    <p> AQ</p>
                </td>
                <td>
                    <p> TV</p>
                </td>
                <td>
                    <p> CV</p>
                </td>
                <td>
                    <p> V</p>
                </td>
                <td>
                    <p> LV</p>
                </td>
                <td>
                    <p> SV</p>
                </td>
                <td>
                    <p> P</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> DINT</p>
                </td>
                <td>
                    <p> constant</p>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p> TV</p>
                </td>
                <td>
                    <p> CV</p>
                </td>
                <td>
                    <p> V</p>
                </td>
                <td>
                    <p> LV</p>
                </td>
                <td>
                    <p> SV</p>
                </td>
                <td>
                    <p> </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> REAL</p>
                </td>
                <td>
                    <p> constant</p>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p> V</p>
                </td>
                <td>
                    <p> LV</p>
                </td>
                <td></td>
                <td>
                    <p> </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> CHAR</p>
                </td>
                <td>
                    <p> constant</p>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p> V</p>
                </td>
                <td>
                    <p> LV</p>
                </td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <p><strong>3. Constant</strong></p>
    <table>
        <thead>
            <tr>
                <td>
                    <p> Constant type</p>
                </td>
                <td>
                    <p> Example</p>
                </td>
                <td>
                    <p> Valid range</p>
                </td>
                <td>
                    <p> Declare</p>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p> 16 bits integer with sign</p>
                </td>
                <td>
                    <p> 1234. -7890</p>
                </td>
                <td>
                    <p> -32768~32767</p>
                </td>
                <td>
                    <p> </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> 32 bits integer with sign</p>
                </td>
                <td>
                    <p> 12345678. -9876543</p>
                </td>
                <td>
                    <p> -2147483648~2147483647</p>
                </td>
                <td>
                    <p> </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> 16 bits constant in hexadecimal</p>
                </td>
                <td>
                    <p> 0x2EF8. 0x9A12</p>
                </td>
                <td>
                    <p> 0x0~0xFFFF</p>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p> 32 bits constant in hexadecimal</p>
                </td>
                <td>
                    <p> 0xA76DCFE9</p>
                </td>
                <td>
                    <p> 0x0~0xFFFFFFFF</p>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p> floating point constant in single precision</p>
                </td>
                <td>
                    <p> 3. 1415926. -0. 02341</p>
                </td>
                <td>
                    <p> -3. 402823e+38~3. 402823e+38</p>
                </td>
                <td>
                    <p> accord with IEEE-754</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <p><strong>4. Storage and use for 32 bits data</strong></p>
    <p> 1. The storage pattern in the register of 32 bits data : the data type of DINT. REAL are 32 bits length, but one register occupy 16 bits length, so need 2 continuous address registers for store 32 bits data. When store 32 bits data, according to fist low word. after high word, e. . g. : 32 bits long integer data 0xA76DCFE9 store in V0V1 registers, then 0xCFE9 stored in V0, 0xA76D stored in V1. </p>
    <p> 2. Register component can stored integer. long integer, if the operands in instructions is register, then the component is 16 bits integer. 32 bits long integer or floating point, is according the data type of the operand in the instruction. e. g. : "MOV -23,  V10", the MOV is 16 bits integer move instruction, the register V10 is a 16 bits integer;"D. MOV 7891223,  V10", the D. MOV is 32 bits integer move instruction, the register V10 is a 32 bits long integer (occupy V10V11);"FMOV -9. 223,  V10", the FMOV is floating point move instruction, the register V10 is a floating point (occupy V10V11). </p>
    <p> 3. The operand of floating point instruction is floating point, the operand of other instruction is integer(16 bits integer, 32 bits long integer), data type converted with convert instruction. </p>
</div>

<h3 id="Component_overview">Component overview</h3>
<p><strong> 1. Haiwell PLC bit component</strong></p>
<table>
    <thead>
        <tr>
            <td>
                <p> Component</p>
            </td>
            <td>
                <p> Name</p>
            </td>
            <td>
                <p> Range</p>
            </td>
            <td>
                <p> Read/Write attribute</p>
            </td>
            <td>
                <p> Declare</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> X</p>
            </td>
            <td>
                <p> External input relay </p>
            </td>
            <td>
                <p> X0~X1023</p>
            </td>
            <td>
                <p> read</p>
            </td>
            <td>
                <p> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y</p>
            </td>
            <td>
                <p> External output relay </p>
            </td>
            <td>
                <p> Y0~Y1023</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M</p>
            </td>
            <td>
                <p> Auxiliary relay</p>
            </td>
            <td>
                <p> M0~M12287</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> default power-off preserve: M1536~M2047, 512 point</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> T</p>
            </td>
            <td>
                <p> Timer</p>
            </td>
            <td>
                <p> T0~T1023</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> time base of T0~T251. T256~T1023 can be set 10ms. 100ms. 1s </p>
                <p> default power-off preserve: T96~T127, 32 point</p>
                <p> time base of T252~T255 is 1ms </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> C</p>
            </td>
            <td>
                <p> Counter</p>
            </td>
            <td>
                <p> C0~C255</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> default power-off preserve: C64~C127, 64 point </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> SM</p>
            </td>
            <td>
                <p> System status bit </p>
            </td>
            <td>
                <p> SM0~SM215 </p>
            </td>
            <td>
                <p> all be read/some be wrote</p>
            </td>
            <td>
                <p> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> S</p>
            </td>
            <td>
                <p> Step relay</p>
            </td>
            <td>
                <p> S0~S2047</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> default power-off preserve: S156~S255, 100 point</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> LM</p>
            </td>
            <td>
                <p> Local relay </p>
            </td>
            <td>
                <p> LM0~LM31 </p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> function in local area (program block. sub program. interrupt program) </p>
            </td>
        </tr>
    </tbody>
</table>
<p> <strong>2. Haiwell PLC register component</strong></p>
<table>
    <thead>
        <tr>
            <td>
                <p> Component</p>
            </td>
            <td>
                <p> Name</p>
            </td>
            <td>
                <p> Rang</p>
            </td>
            <td>
                <p> Read/Write attribute</p>
            </td>
            <td>
                <p> Declare</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> AI </p>
            </td>
            <td>
                <p> Analog input register</p>
            </td>
            <td>
                <p> AI0~AI255</p>
            </td>
            <td>
                <p> read</p>
            </td>
            <td>
                <p> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> AQ </p>
            </td>
            <td>
                <p> Analog output register</p>
            </td>
            <td>
                <p> AQ0~AQ255</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V </p>
            </td>
            <td>
                <p> Internal data register</p>
            </td>
            <td>
                <p> V0~V14847</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> default power-off preserve: V1000~V2047, 1048 point</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> TV </p>
            </td>
            <td>
                <p> Current value of timer </p>
            </td>
            <td>
                <p> TV0~TV1023</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> time base of T0~T251. T256~T1023 can be set 10ms. 100ms. 1s</p>
                <p> default power-off preserve: TV96~TV127, 32 point</p>
                <p> time base of T252~T255 is1ms </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> CV </p>
            </td>
            <td>
                <p> Current value of counter </p>
            </td>
            <td>
                <p> CV0~CV255</p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> the CV register is a 16 bits register, in CV48~CV79 register are 32 bits register, default power-off preserve: CV64~CV127, 64 point </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> SV </p>
            </td>
            <td>
                <p> System register </p>
            </td>
            <td>
                <p> SV0~SV154 </p>
            </td>
            <td>
                <p> all be read/some be wrote</p>
            </td>
            <td>
                <p> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> LV </p>
            </td>
            <td>
                <p> Local register </p>
            </td>
            <td>
                <p> LV0~LV31 </p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> function in local area (program block. sub program. interrupt program) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> P </p>
            </td>
            <td>
                <p> Indexed addressing point </p>
            </td>
            <td>
                <p> P0~P29 </p>
            </td>
            <td>
                <p> read/write</p>
            </td>
            <td>
                <p> special register use in indexed addressing </p>
            </td>
        </tr>
    </tbody>
</table>
<p>Note: power-off preserve range of T(TV). C(CV). M. S. V in the table are default configure of the system, the range can be changed by user. </p>

<p><strong> </strong></p>
<h3 id="External_input_relay_X">External input relay [X]</h3>

<p> External input relay X: Corresponds to external input points(e. g. : Switch. Button etc. ),  attain the external input point state (ON or OFF) access to PLC. </p>
<p> Sign by X, e. g. : X0. X1. ... X8. X10. X11. .... Identifiered from X0, In
    "<a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#X_digital_input_parameter">PLC hardware configure</a>" to configure. Automatic assign the address by the system. </p>


<h3 id="External_output_relay_Y">External output relay [Y]</h3>

<p> External output relay Y: Corresponds to external output points, use for drive the external output points Y ON-OFF (ON or OFF). One Y relay can be reuse of output in the program, but recommendation use only once,  in order to improve the reliability and readability of the program. </p>
<p> Sign by Y, e. g. : Y0. Y1. ... Y8. Y10. Y11. .... Identifiered from Y0, In
    "<a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#X_digital_input_parameter">PLC hardware configure</a>" to configure. Automatic assign the address by the system. </p>
<h3 id="Timer_T">Timer [T]</h3>
<p> Timer T: each timer compose output relay T and current value TV. </p>
<p> Target = time base * set value. Time base of T0~T251. T256~T1023 can be set 10ms. 100ms. 1s, time base of T252~T255 is 1ms. </p>
<p> In one program, each timer can be used only once, But the output relay T and current value TV of the same No. can be used unlimited. </p>
<p> Timer can be devided power-off preserve and no power-off preserve: the output relay T and current value TV of the no power-off preserve timer will be reset when PLC STOP. The output relay T and current value TV of the power-off preserve timer will be retain when PLC STOP. </p>
<h3 id="Counter_C">Counter[C]</h3>
<p> Counter C: each counter compose output relay C and current value CV. </p>
<p> In one program, each counter can be used only once, But the output relay C and current value CV of the same No. can be used unlimited. </p>
<p> Counter can be devided 16 bits counter and 32 bits counter,  among CV48~CV79 are 32 bits counter, rest are 16 bits counter. </p>
<p> Counter can be devided three type in accordance with the count mode: increase count CTU. decrease count CTD. increase/decrease count CTUD. </p>
<p> Counter can be devided power-off preserve and no power-off preserve : the output relay C and current value CV of the no power-off preserve counter will be reset when PLC STOP. The output relay C and current value CV of the power-off preserve counter will be retain when PLC STOP. </p>

<h3 id="Auxiliary_relay_M">Auxiliary relay[M]</h3>

<p> Auxiliary relay M: Used for internal logic operation, we can use the combination of auxiliary relays in control logic, but can not drive the load direct. </p>
<p> M can be devided power-off preserve and no power-off preserve : the state of no power-off preserve M will be reset when PLC STOP. The state of power-off preserve M will be retain when PLC STOP. </p>

<h3 id="Step_relay_S">Step relay[S]</h3>
<p> Step relay S: Used for step control instruction, each step relay stand for one step, can be used the same as auxiliary relay if there is not step instruction in the program. </p>
<p> S can be devided power-off preserve and no power-off preserve : the state of no power-off preserve S will be reset when PLC STOP. The state of power-off preserve S will be retain when PLC STOP. </p>

<h3 id="System_status_bit_SM">System status bit [SM]</h3>

<p> System status bit SM is a group of special internal relay of the system, can be used unlimited in the program,  each SM has a special function. </p>

<p> See detail "<a href="/plc/haiwell-plc-programming-software/Appendix/#SM_System_status_bit">SM System status bit</a>"</p>

<h3 id="Local_relay_LM">Local relay [LM]</h3>

<p> Local relay LM: they are special internal relay which function in local area (program block. sub program. interrupt program), different with the internal relay M. </p>
<p> The function range of M: in the all program in the project, all of the scan cycle. </p>
<p> The function range of LM: in local area (program block. sub program. interrupt program), state (ON/OFF) only keep one scan cycle, state will be reset when the next scan cycle started, state reset to OFF, general use for temporary variable or the parameter of the program block be called. </p>

<h3 id="Analog_input_register_AI">Analog input register [AI]</h3>

<p> Analog input register AI: each analog input channel corresponding one analog input register AI, analog input channel connect to external device, used for measure the continuous change of the external singal, e. g. temperature. pressure. quantity of flow etc. . </p>
<p> When the signal of external analog input channel be changed, can be reflect to the analog input register AI immediately. </p>
<p> The signal type. quantities. up and down rang of quantities of each analog input channel can be configured in
    "<a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#AI_analog_input_parameter">PLC hardware configure</a>". Automatic assign the address by the system. </p>

<h3 id="Analog_output_register_AQ">Analog output register [AQ]</h3>

<p> Analog output register AQ: each analog output channel corresponding one analog output register AQ, analog output channel connect to external device. </p>
<p> When the value of analog output register AQ be changed,  corresponding the signal of the analog output channel be changed immediately. </p>
<p> The signal type. quantities. up and down rang of quantities of each analog output channel can be configured in
    "<a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#AI_analog_input_parameter">PLC hardware configure</a>". Automatic assign the address by the system. </p>

<h3 id="Current_value_of_timer_TV">Current value of timer [TV]</h3>

<p> Current value of timer TV: indicate the keep time of the timer. </p>
<p> See detail "<a href="#Timer_T">Timer T</a>" </p>

<h3 id="Current_value_of_counter_CV">Current value of counter [CV]</h3>

<p> Current value of counter CV: indicate the current count of the counter. </p>
<p> See detail "<a href="#Counter_C">Counter C</a>"</p>

<h3 id="Internal_data_register_V">Internal data register [V]</h3>

<p> Internal data register V: for store data, 16 bits register(b0~b15), integer can express the range -32768~+32767, 2 continuous 16 bits register is 32 bits register, long integer can express the range -2147483648~+2147483647, float point can express the range -3. 402823e+38~3. 402823e+38. </p>
<p> V can be devided power-off preserve and no power-off preserve : the value of no power-off preserve V will be reset to 0 when PLC STOP. The value of power-off preserve V will be retain when PLC STOP. </p>
<h3 id="System_register_SV">System register [SV]</h3>

<p> System special register SV is a group of special internal register of the system, can be used unlimited in the program,  each SV has a special function. </p>
<p> See detail "<a href="/plc/haiwell-plc-programming-software/Appendix/#SV_system_register">SV system register</a>"</p>
<h3 id="Local_register_LV">Local register [LV]</h3>
<p> Local reggister LV: they are special internal register which special function in local area (program block. sub program. interrupt program), not the same as internal register V. </p>
<p> The function range of V: in the all program in the project, all of the scan cycle. </p>
<p> The function range of LV: in local area (program block. sub program. interrupt program), value only keep one scan cycle, value will be reset to 0 when the next scan cycle started, general use for temporary variable or the parameter of the program block be called. </p>
<h3 id="Indexed_addressing_point_P">Indexed addressing point [P]</h3>
<p> Indexed addressing point P: special register use in indexed addressing. </p>
<p> How to input the register indexed and representation in the program: base address of the register+indexed addressing point P. e. g. : V100P6 presentation the base address is V100, use the value of P6 as excursion value for indexed addressing, as if the value of P6 is 10, indicate access the register is V110. </p>
<p> Reality access register =base address of the register + excursion of indexed address point. </p>
<p> Note: </p>
<p> 1. When indexed addressing use the P, If base address of the register + excursion of indexed address point (reality access register )exceed the uplimit, it will be error of the indexed addressing instruction, the instruction cannot be execute. </p>
<p> 2. LM,  LV,  S,  P component type does not support indexing</p>
<p> 3. Part of the instruction does not support indexing: RESH. HHSC. HCWR. SPD. PWM. PLSY. PLSR. ZRN. SETZ. PPMR. CIMR. SPLS. SYNP. COMM. MODR. MODW. HWRD. HWWR. RCV. XMT. SORT. ENO</p>
