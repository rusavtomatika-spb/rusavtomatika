<h1 id="PLC_instruction_set">PLC instruction set</h1>
<hr>
<p>Haiwell PLC have a set of abundance high-efficiency instruction system, depend on absorb instructions of others PLC,
    support up to 200 application instructions, among there are many powerful innovate easy instructions .as commucation
    instructions (<a href="#COMM_COMM_LB_Serial_communications">COMM</a>.
    <a href="#MODR_Modbus_read">MODR</a>.
    <a href="#MODW_Modbus_write">MODW</a>.
    <a href="#HWRD_Haiwellbus_read">HWRD</a>.
    <a href="#HWWR_Haiwellbus_write">HWWR</a>).
    character conversion instructions (<a href="#ITOC_D_ITOC_Integer_convert_to_character">ITOC</a>.
    <a href="#CTOI_Character_convert_to_integer">CTOI</a>.
    <a href="#FTOC_Floating_point_convert_to_character">FTOC</a>.
    <a href="#CTOF_Character_convert_to_floating_point">CTOF</a>).
    data combination disperse instructions (<a href="#BUNB_Discrete_bit_combination_to_continuous_bit">BUNB</a>.
    <a href="#BUNW_Discrete_bit_combination_to_continuous_word">BUNW</a>.
    <a href="#WUNW_Discrete_word_combination_to_continuous_word">WUNW</a>.
    <a href="#BDIB_Continuous_bit_disperse_to_discrete_bit">BDIB</a>.
    <a href="#WDIB_Continuous_word_disperse_to_discrete_bit">WDIB</a>.
    <a href="#WDIW_Continuous_word_disperse_to_discrete_word">WDIW</a>).
    bound alarm instructions(<a href="#HAL_D_HAL_Upper_limit_alarm">HAL</a>.
    <a href="#LAL_D_LAL_Lower_limit_alarm">LAL</a>).
    valve control instructions(<a href="#VC_Valve_control">VC</a>).
    temperature curve(<a href="#TTC_Temperature_curve_control">TTC</a>) etc.</p>
<p>Instruction set table as follows:</p>
<table>
    <thead>
        <tr>
            <td rowspan="2"> Instruction type</td>
            <td rowspan="2"> Instruction name</td>
            <td rowspan="2"> 8 bit model</td>
            <td rowspan="2"> 32 bit model</td>
            <td rowspan="2"> Instruction function</td>
            <td colspan="3"> Support language</td>
        </tr>
        <tr>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="12"> <a href="#Compare_switch">Compare switch</a></td>
            <td>=</td>
            <td>
                <p>LB.= HB.=</p>
            </td>
            <td>
                <p>D.=</p>
            </td>
            <td>Equal to compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&lt;&gt;</td>
            <td>
                <p>LB.&lt;&gt; HB.&lt;&gt;</p>
            </td>
            <td>
                <p>D.&lt;&gt;</p>
            </td>
            <td>Unequal to compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&gt;</td>
            <td>
                <p>LB.&gt; HB.&gt;</p>
            </td>
            <td>
                <p>D.&gt;</p>
            </td>
            <td>Greater than compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&gt;=</td>
            <td>
                <p>LB.&gt;= HB.&gt;=</p>
            </td>
            <td>
                <p>D.&gt;=</p>
            </td>
            <td>Great than or equal to compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&lt;</td>
            <td>
                <p>LB.&lt; HB.&lt;</p>
            </td>
            <td>
                <p>D.&lt;</p>
            </td>
            <td>Less than compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&lt;=</td>
            <td>
                <p>LB.&lt;= HB.&lt;=</p>
            </td>
            <td>
                <p>D.&lt;=</p>
            </td>
            <td>Less than or equal to compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.=</td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>Floating-point number equal to compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&lt;&gt;</td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>Floating-point number unequal to compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&gt;</td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>Floating-point number greater than compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&gt;=</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Floating-point number greater than or equal to compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&lt;</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Floating-point number less than compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&lt;=</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Floating-point number less than or equal to compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td rowspan="3"> <a href="#Step_instruction"> Step instruction</a></td>
            <td><a href="#STL_Step_start"> STL</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Step start</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td><a href="#SFROM_Step_combine">SFROM</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Step combine</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td><a href="#STO_Step_jump">STO</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Step jump</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td rowspan="9"> <a href="#Bit_instruction">Bit instruction</a></td>
            <td><a href="#AND_Logic_AND">AND</a></td>
            <td>
                <p> </p>
            </td>
            <td></td>
            <td>
                <p>Logic AND</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#OR_Logic_OR">OR</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Logic OR</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#XOR_Logic_XOR">XOR</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Logic XOR</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#OUT_Coil_output">OUT</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Coil output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SET_Setting">SET</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Setting </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#RST_Reset">RST</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Reset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ALT_ON_OFF_alternately_output">ALT</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>ON/OFF alternately output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ZRST_Batch_reset">ZRST</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Batch reset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ENO_Get_ENO_output">ENO</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Get ENO output</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="3"> <a href="#Timer">Timer</a></td>
            <td><a href="#TON_Delay_ON">TON</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Delay ON</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TOF_Delay_OFF">TOF</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Delay OFF</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TP_Pulse_timer">TP</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Pulse timer</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="3"> <a href="#Counter"> Counter</a></td>
            <td><a href="#CTU_D_CTU_Increase_counter">CTU</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.CTU</p>
            </td>
            <td>
                <p>Increase counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CTD_D_CTD_Decrease_counter">CTD</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.CTD</p>
            </td>
            <td>
                <p>Decrease counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CTUD_D_CTUD_Increase_and_Decrease_counter">CTUD</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.CTUD</p>
            </td>
            <td>
                <p>Increase and Decrease counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="19"> <a href="#High_speed_control_instruction">High speed control instruction</a></td>
            <td><a href="#SHC_Single_high_counter"> SHC</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Single high speed counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#RESH_IO_refresh">RESH</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>IO refresh</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#HHSC_High_speed_counter">HHSC</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>High speed counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#HCWR_Write_high_speed_counter">HCWR</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Write high speed counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SPD_Speed_detection">SPD</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Speed detection</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#PWM_Pulse_width_modulation">PWM</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Pulse width modulation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#PLSY_D_PLSY_Pulse_output">PLSY</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.PLSY</p>
            </td>
            <td>
                <p>Pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#PLSR_D_PLSR_Accelerate_and_decelerate_pulse_output">PLSR</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.PLSR</p>
            </td>
            <td>
                <p>Accelerate and decelerate pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ZRN_Origin_point_return"> ZRN</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Origin point return</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SETZ_Set_electric_origin_point"> SETZ</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Set electric origin point</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#PPMR_Linear_interpolation"> PPMR</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Linear interpolation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CIMR_Circular_interpolation"> CIMR</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Circular interpolation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SPLS_Single_pulse_output"> SPLS</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Single pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MPTO_Multi_segment_pulse_output">MPTO</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Multi-segment pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SYNP_Synchronization_pulse_output"> SYNP</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Synchronization pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#PSTOP_Stop_pulse_output"> PSTOP</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Stop pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#DVIT_Interrupt_positioning_pulse_output"> DVIT</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Synchronization pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ECAM_Electronic_CAM"> ECAM</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Stop pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#JOGP_Jog_pulse_output">JOGP</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Jog pulse output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="10"> <a href="#Compare_instruction">Compare instruction</a></td>
            <td><a href="#CMP_D_CMP_Compare">CMP</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.CMP</p>
            </td>
            <td>
                <p>Compare instruction</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ZCP_D_ZCP_Regional_comparison">ZCP</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.ZCP</p>
            </td>
            <td>
                <p>Regional comparison</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MATC_D_MATC_Numerical_match">MATC</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.MATC</p>
            </td>
            <td>
                <p>Numerical match</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ABSC_D_ABSC_Absolute_cam_comparison">ABSC</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.ABSC</p>
            </td>
            <td>
                <p>Absolute cam comparison</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BON_ON_bit_determine">BON</a></td>
            <td> </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>ON bit determine</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BONC_D_BONC_ON_bit_numbers">BONC</a></td>
            <td> </td>
            <td>D.BONC</td>
            <td>
                <p>ON bit numbers</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MAX_D_MAX_Maximum">MAX</a></td>
            <td> </td>
            <td>
                <p>D.MAX</p>
            </td>
            <td>
                <p>Maximum</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MIN_D_MIN_Minimum">MIN</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.MIN</p>
            </td>
            <td>
                <p>Minimum</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SEL_D_SEL_Selection_of_conditions">SEL</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.SEL</p>
            </td>
            <td>
                <p>Selection of conditions</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MUX_D_MUX_Multi_choice">MUX</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.MUX</p>
            </td>
            <td>
                <p>Multi-choice</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="21"> <a href="#Shift_instruction">Shift instruction</a></td>
            <td><a href="#LBST_Low_byte_evaluation">LBST</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>Low byte evaluation</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#HBST_High_byte_evaluation">HBST</a></td>
            <td> </td>
            <td> </td>
            <td>High byte evaluation</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MOV_D_MOV_Move">MOV</a></td>
            <td> </td>
            <td>
                <p>D.MOV</p>
            </td>
            <td>
                <p>Move</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BMOV_Block_move">BMOV</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Block move</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FILL_Fill">FILL</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Fill</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#XCH_Byte_swap_D_XCH_Register_swap">XCH</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Byte swap</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BXCH_Block_swap">BXCH</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Block swap</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SHL_Bit_left_shift">SHL</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Bit left shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SHR_Bit_right_shift">SHR</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Bit right shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WSHL_Word_left_shift">WSHL</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Word left shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WSHR_Word_right_shift">WSHR</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Word right shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ROL_Bit_rotate_left_shift">ROL</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Bit rotate left shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ROR_Bit_rotate_right_shift">ROR</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Bit rotate right shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WROL_Word_rotate_left_shift">WROL</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Word rotate left shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WROR_Word_rotate_right_shift">WROR</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Word rotate right shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BSHL_Byte_left_shift">BSHL</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Byte left shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BSHR_Byte_right_shift">BSHR</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Byte right shift</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ATBL_Append_to_array">ATBL</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Append to array</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FIFO_First_in_first_out">FIFO</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>First in first out</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#LIFO_Last_in_first_out">LIFO</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Last in first out</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SORT_Data_sort">SORT</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Data sort</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="17"> <a href="#Data_conversion_instruction">Data conversion instruction</a></td>
            <td><a href="#ENCO_Encoder">ENCO</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Encoder</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#DECO_Decoder">DECO</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Decoder</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BTOW_Bit_convert_to_word">BTOW</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Bit convert to word</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WTOB_Word_convert_to_bit">WTOB</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Word convert to bit</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#HEX_HEX_LB_ASCII_convert_to_hexadecimal">HEX</a></td>
            <td>
                <p>HEX.LB</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>ASCII convert to hexadecimal</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ASCI_ASCI_LB_Hexadecimal_convert_to_ASCII">ASCI</a></td>
            <td>
                <p>ASCI.LB</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Hexadecimal convert to ASCII</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BUNB_Discrete_bit_combination_to_continuous_bit">BUNB</a></td>
            <td> </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Discrete bit combination to continuous bit</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BUNW_Discrete_bit_combination_to_continuous_word">BUNW</a></td>
            <td> </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Discrete bit combination to continuous word</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WUNW_Discrete_word_combination_to_continuous_word">WUNW</a></td>
            <td> </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Discrete word combination to continuous word</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BDIB_Continuous_bit_disperse_to_discrete_bit">BDIB</a></td>
            <td> </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Continuous bit disperse to discrete bit</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WDIB_Continuous_word_disperse_to_discrete_bit">WDIB</a></td>
            <td> </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Continuous word disperse to discrete bit</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WDIW_Continuous_word_disperse_to_discrete_word">WDIW</a></td>
            <td> </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Continuous word disperse to discrete word</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BCD_D_BCD_BIN_convert_to_BCD">BCD</a></td>
            <td> </td>
            <td>
                <p>D.BCD</p>
            </td>
            <td>
                <p>BIN convert to BCD</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BIN_D_BIN_BCD_convert_to_BIN">BIN</a></td>
            <td> </td>
            <td>
                <p>D.BIN</p>
            </td>
            <td>
                <p>BCD convert to BIN</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ITOL_Integer_convert_to_long_integer">ITOL</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Integer convert to long integer</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#GRAY_BIN_convert_to_GRAY_code">GRAY</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>BIN convert to GRAY code</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#GBIN_GRAY_code_convert_to_BIN">GBIN</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>GRAY code convert to BIN</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="7"> <a href="#Character_instruction">Character instruction</a></td>
            <td><a href="#GHLB_Obtain_high_low_byte">GHLB</a></td>
            <td> </td>
            <td> </td>
            <td>Obtain high low byte</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#GETB_Capture_byte_string">GETB</a></td>
            <td> </td>
            <td> </td>
            <td>Capture byte string</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BCMP_BCMP_LB_Byte_string_comparison">BCMP</a></td>
            <td>BCMP.LB</td>
            <td> </td>
            <td>Byte string comparison</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ITOC_D_ITOC_Integer_convert_to_character"> ITOC</a></td>
            <td> </td>
            <td>
                <p>D.ITOC</p>
            </td>
            <td>Integer convert to character</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CTOI_Character_convert_to_integer"> CTOI</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Character convert to integer</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FTOC_Floating_point_convert_to_character"> FTOC</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Floating point convert to character</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CTOF_Character_convert_to_floating_point"> CTOF</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Character convert to floating point</td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="14"> <a href="#Arithmetical_instruction">Arithmetical instruction</a></td>
            <td><a href="#WNOT_D_WNOT_Negation">WNOT</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.WNOT</p>
            </td>
            <td>
                <p>Negation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WAND_D_WAND_AND_operation">WAND</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.WAND</p>
            </td>
            <td>
                <p>AND operation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WOR_D_WOR_OR_operation">WOR</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.WOR</p>
            </td>
            <td>
                <p>OR operation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WXOR_D_WXOR_XOR_operation">WXOR</a></td>
            <td> </td>
            <td>
                <p>D.WXOR</p>
            </td>
            <td>
                <p>XOR operation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ADD_D_ADD_Addition">ADD</a></td>
            <td> </td>
            <td>
                <p>D.ADD</p>
            </td>
            <td>
                <p>Addition</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SUB_D_SUB_Subtraction">SUB</a></td>
            <td> </td>
            <td>
                <p>D.SUB</p>
            </td>
            <td>
                <p>Subtraction</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#INC_D_INC_Increase_1">INC</a></td>
            <td> </td>
            <td>
                <p>D.INC</p>
            </td>
            <td>
                <p>Increase 1</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#DEC_D_DEC_Decrease_1">DEC</a></td>
            <td> </td>
            <td>
                <p>D.DEC</p>
            </td>
            <td>
                <p>Decrease 1</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MUL_D_MUL_Multiplication">MUL</a></td>
            <td> </td>
            <td>
                <p>D.MUL</p>
            </td>
            <td>
                <p>Multiplication</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#DIV_D_DIV_Division">DIV</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.DIV</p>
            </td>
            <td>
                <p>Division</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ACCU_D_ACCU_Accumulation">ACCU</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.ACCU</p>
            </td>
            <td>
                <p>Accumulation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#AVG_D_AVG_Average">AVG</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.AVG</p>
            </td>
            <td>
                <p>Average</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ABS_D_ABS_Absolute_value">ABS</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.ABS</p>
            </td>
            <td>
                <p>Absolute value</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#NEG_D_NEG_Two_s_complement">NEG</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.NEG</p>
            </td>
            <td>
                <div>
                    <div>
                        <div>
                            <div>
                                <div>
                                    <div>
                                        <div>
                                            <p>Two's complement</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="27"> <a href="#Floating_point_instruction">Floating point instruction</a></td>
            <td><a href="#FCMP_Floating_point_comparison">FCMP</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point comparison</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FZCP_Floating_point_regional_comparison">FZCP</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point regional comparison</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FMOV_Floating_point_move"> FMOV</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point move instruction</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FADD_Floating_point_addition">FADD</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point addition</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FSUB_Floating_point_subtraction">FSUB</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point subtraction</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FMUL_Floating_point_multiplication">FMUL</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point multiplication</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FDIV_Floating_point_division">FDIV</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point division</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FACCU_Accumulation">FACCU</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Floating point accumulation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FAVG_Average">FAVG</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Floating point average</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FMAX_Floating_point_maximum">FMAX</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Floating point maximum</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FMIN_Floating_point_minimum">FMIN</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Floating point minimum</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FTOI_Floating_point_convert_to_integer">FTOI</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point convert to integer</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ITOF_D_ITOF_Integer_convert_to_floating_point">ITOF</a></td>
            <td> </td>
            <td>
                <p>D.ITOF</p>
            </td>
            <td>
                <p>Integer convert to floating point</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FABS_Floating_point_absolute">FABS</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point absolute</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FSQR_Floating_point_square_root">FSQR</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Floating point square root</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FSIN_Sine">FSIN</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Sine</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FCOS_Cosine">FCOS</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Cosine</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FTAN_Tangent">FTAN</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Tangent</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FASIN_Arcsine">FASIN</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Arcsine</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FACOS_Arc_cosine">FACOS</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Arc cosine</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FATAN_Arctangent">FATAN</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Arctangent</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FLN_Natural_logarithm">FLN</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Natural logarithm</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FLOG_The_base_10_logarithm_of_a_number">FLOG</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>The base-10 logarithm of a number</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FEXP_Nature_exponential">FEXP</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Nature exponential</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FRAD_Angle_convert_to_radian">FRAD</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Angle convert to radian</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FDEG_Radian_convert_to_angle">FDEG</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Radian convert to angle</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FXY_Exponent">FXY</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Exponent </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="6"> <a href="#Clock_instruction">Clock instruction</a></td>
            <td><a href="#TCMP_Real_time_clock_comparison">TCMP</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>Real time clock comparison</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TACCU_Time_accumulative_total">TACCU</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Time accumulative total</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SCLK_Setup_system_clock">SCLK</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Setup system clock</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TIME_Time_switch">TIME</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Time switch</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#DATE_Date_switch">DATE</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Date switch</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#INVT_Count_down">INVT</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Count down</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="17"> <a href="#Communication_instruction">Communication instruction</a></td>
            <td><a href="#SUM_SUM_LB_SUM_verify">SUM</a></td>
            <td>
                <p>SUM.LB</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>SUM verify</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#BCC_BCC_LB_BCC_verify">BCC</a></td>
            <td>
                <p>BCC.LB</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>BCC verify</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CRC_CRC_LB_CRC_verify">CRC</a></td>
            <td>
                <p>CRC.LB</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>CRC verify</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#LRC_LRC_LB_LRC_verify">LRC</a></td>
            <td>
                <p>LRC.LB</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>LRC verify</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#COMM_COMM_LB_Serial_communications">COMM</a></td>
            <td>
                <p>COMM.LB</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Serial communications</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MODR_Modbus_read">MODR</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Modbus read</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MODW_Modbus_write">MODW</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Modbus write</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#HWRD_Haiwellbus_read">HWRD</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Haiwellbus read</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#HWWR_Haiwellbus_write">HWWR</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Haiwellbus write</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#RCV_Receive_communication_data">RCV</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Receive communication data</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#XMT_XMT_LB_Sent_communication_data">XMT</a></td>
            <td>XMT.LB</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Sent communication data</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FROM_Extend_module_CR_register_read">FROM</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Extend module CR register read</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TO_Extend_module_CR_register_write">TO</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Extend module CR register write</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TCPMDR_Modbus_TCP_read">TCPMDR</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Modbus TCP read</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TCPMDW_Modbus_TCP_write">TCPMDW</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Modbus TCP write</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TCPHWR_Haiwellbus_TCP_read">TCPHWR</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Haiwellbus TCP read</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TCPHWW_Haiwellbus_TCP_write">TCPHWW</a></td>
            <td> </td>
            <td> </td>
            <td>
                <p>Haiwellbus TCP write</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="4"> <a href="#Interrupt_instruction">Interrupt instruction</a></td>
            <td><a href="#ATCH_Interrupt_binding">ATCH</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Interrupt binding</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#DTCH_Interrupt_release">DTCH</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Interrupt release</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ENI_Enable_interrupt">ENI</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Enable interrupt</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#DISI_Disable_interrupt">DISI</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Disable interrupt</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="10"> <a href="#Program_control_instruction">Program control instruction</a></td>
            <td><a href="#MC_Master_control"> MC</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Master control</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#MCR_Master_control_clear"> MCR</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Master control clear</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FOR_Loop_command"> FOR</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Loop command</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#NEXT_Loop_end"> NEXT</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Loop end</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#WAIT_Delay_wait"> WAIT</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Delay wait</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CALL_Call_subroutine"> CALL</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Call subroutine</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#EXIT_Condition_exit"> EXIT</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Condition exit</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#REWD_Scanning_time_reset"> REWD</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Scanning time reset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#JMPC_Condition_jump"> JMPC</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Condition jump</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#LBL_Jump_label"> LBL</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Jump label</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td rowspan="10"> <a href="#Special_Function_instruction">Special function instruction</a></td>
            <td><a href="#GPWM_General_pulse_width_modulation">GPWM</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>General pulse width modulation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#FTC_Fuzzy_temperature_control">FTC</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Fuzzy temperature control</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#PID_PID_control">PID</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>PID control</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#HAL_D_HAL_Upper_limit_alarm">HAL</a></td>
            <td> </td>
            <td>
                <p>D.HAL</p>
            </td>
            <td>
                <p>Upper limit alarm</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#LAL_D_LAL_Lower_limit_alarm">LAL</a></td>
            <td> </td>
            <td>
                <p>D.LAL</p>
            </td>
            <td>
                <p>Lower limit alarm</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#LIM_D_LIM_Range_limitation">LIM</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.LIM</p>
            </td>
            <td>
                <p>Range limitation</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SC_D_SC_Linear_conversion">SC</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.SC</p>
            </td>
            <td>
                <p>Linear conversion</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#VC_Valve_control">VC</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Valve control</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TTC_Temperature_curve_control">TTC</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Temperature curve control</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#APID_Self_tuning_PID_control"> APID</a></td>
            <td> </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Self-tuning PID</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
    </tbody>
</table>

<h3 id="General_declare_of_the_instruction">General declare of the instruction</h3>
<hr>
<p>1. En enable input :En is the enable input item of the instruction, Only En have electricity (ON), the instruction executed, otherwise not executed.</p>
<p>2. Eno Enable output: Eno is the Enable output item of the instruction, indicate the instruction is executing. When En have electricity (ON) and instruction executed properly then Eno output have electricity (ON), when En have not electricity (OFF) or instruction executed error (e.g:parameter not property of the instruction ) then Eno output have not electricity (OFF). The application instruction in LD. FBD language, the great mass of the instruction have Eno Enable output item, All IL instructions have not Eno output item,it will be instead of the ENO instruction in IL language. </p>
<p>3. In LD language the AND. OR. XOR instructions, will be instead of logic link.</p>
<p>4. 32 bit instruction at 16 bit instruction name "D.", indicate use 2 continuous register.Such as ADD,16 bit addition is ADD,32 bit addition is D.ADD.</p>
<p>5. 8 bit instruction at 16 bit instruction behind the name plus ".LB", indicate only use the low byte of the register .Such as COMM,16 bit instruction is COMM,8 bit instruction is COMM.LB. </p>
<p>6. When the parameter items of many instruction which autoOccupy several continuous register, pay special attention to them when programming, avoid reusing the register to program execution incorrect.</p>
<p>Note: except CV48~CV79 are 32 bit register (total 32 entries),Haiwell PLC other registers (AI. AQ. V. SV. LV. TV. CV. P) all are 16 bit register, one 16 bit register have 2 byte compose, one 32 bit register have 2 continuous 16 bit registers compose.</p>

<h3 id="Compare_switch">Compare switch</h3>
<hr>
<p>Compare switch used in LD program language dedicated, divide into:16 bit compare instruction. 32 bit compare instruction. floating point compare instruction. low byte compare instruction. high byte compare instruction. </p>
<p>Compare mode have:equal to (=). unequal to (&lt;&gt;). greater than(&gt;). greater than or equal to (?). less than (&lt;). less than and equal to(?) six type. </p>
<p>Program example:<a href="<?= $path_to_images ?>program/switch.gpc"><img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a>,instruction list as follows: </p>
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
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>=</td>
            <td>
                <p>LB.= HB.=</p>
            </td>
            <td>
                <p>D.=</p>
            </td>
            <td>Equal to compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&lt;&gt;</td>
            <td>
                <p>LB.&lt;&gt; HB.&lt;&gt;</p>
            </td>
            <td>
                <p>D.&lt;&gt;</p>
            </td>
            <td>Unequal to compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&gt;</td>
            <td>
                <p>LB.&gt; HB.&gt;</p>
            </td>
            <td>
                <p>D.&gt;</p>
            </td>
            <td>Greater than compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&gt;=</td>
            <td>
                <p>LB.&gt;= HB.&gt;=</p>
            </td>
            <td>
                <p>D.&gt;=</p>
            </td>
            <td>Great than or equal to compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&lt;</td>
            <td>
                <p>LB.&lt; HB.&lt;</p>
            </td>
            <td>
                <p>D.&lt;</p>
            </td>
            <td>Less than compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>&lt;=</td>
            <td>
                <p>LB.&lt;= HB.&lt;=</p>
            </td>
            <td>
                <p>D.&lt;=</p>
            </td>
            <td>Less than or equal to compare switch, have 16 bit/32 bit /low byte/high byte model</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.=</td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>Floating-point number equal to compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&lt;&gt;</td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>Floating-point number unequal to compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&gt;</td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>Floating-point number greater than compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&gt;=</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Floating-point number greater than or equal to compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&lt;</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Floating-point number less than compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>F.&lt;=</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Floating-point number less than or equal to compare switch</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
    </tbody>
</table>

<h3 id="Step_instruction">Step instruction</h3>
<hr>
<p>Step instruction list as follows</p>
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
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="#STL_Step_start">STL</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Step start</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td><a href="#SFROM_Step_combine">SFROM</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Step combine</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td><a href="#STO_Step_jump">STO</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>Step jump</td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[step instruction declare]</p>
<p>1. Subroutine. interrupt routine not support step instruction,FBD,IL language not support step instruction.</p>
<p>2. In the step not support jump . loop instruction.</p>
<p>3. If a step is ON, the program within the step be executed, then not executed.</p>
<p>4. Support step branch . step combine process.</p>
<p>5. Jump between the step, the last step state and OUT instruction outputs . timer coil T and current value TV . counter coil C and current value CV within the step will be clear .SET instruction will be not reset.</p>
<p>6. When the step roll-out, Y output want keep ON be use SET instruction drive the output, want clear the output to OFF, use RST instruction.</p>
<p>7. Step number Sn cannot repeat, without step instruction in the program the S relay can be used as general internal relay.</p>
<p>8. If want terminate the step, use RST Sx to reset the step, batch reset use the ZRST instruction.</p>
<p>9. Any S component can be used the start step, start step use STO or SET start, step jump use STO instruction.</p>
<p>10. The program can activate 10 different step process at the same time .</p>
<h3 id="STL_Step_start">STL (Step start)</h3><hr>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/stl.gif"    /></p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/stl.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>STL instruction represent a step start, if the step have electricity, the program within the step be executed, then not executed.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-STL.gif"    /></p>
<p>[Program description]:</p>
<p>1. When M2=ON then start step S3,by now S3=ON</p>
<p>2. When S3=ON, moreover jump condition X0=ON, then go to step S20,by now S20=ON. S3=OFF</p>
<p>3. When S20=ON then Y0=ON, when jump condition X1=ON, then go to step S30,by now S30=ON. S20=OFF. Y0=OFF</p>
<p>, when jump condition X4=ON, then go to step S31,by now S31=ON. S20=OFF. Y0=OFF</p>
<p>, when jump condition X7=ON, then go to step S32,by now S32=ON. S20=OFF. Y0=OFF</p>
<p>(step selectivity branch) </p>
<p>4. When S30=ON then Y1=ON, when jump condition X2=ON, then go to step S40,by now S40=ON. S30=OFF. Y1=OFF</p>
<p>5. When S40=ON then Y2=ON, when jump condition X3=ON, then go to step S50,by now S50=ON. S40=OFF. Y2=OFF</p>
<p>6. When S31=ON then Y3=ON, when jump condition X5=ON, then go to step S41,by now S41=ON. S31=OFF. Y3=OFF</p>
<p>7. When S41=ON then Y4=ON, when jump condition X6=ON, then go to step S50,by now S50=ON. S41=OFF. Y4=OFF</p>
<p>8. When S32=ON then Y5=ON, when jump condition X10=ON, then go to step S42,by now S42=ON. S32=OFF. Y5=OFF</p>
<p>9. When S42=ON then Y6=ON, when jump condition X11=ON, then go to step S50,by now S50=ON. S42=OFF. Y6=OFF</p>
<p>10. When S50=ON then Y7=ON, when jump condition X12=ON, then go to step S3,by now S3=ON. S50=OFF. Y7=OFF, circulate repeatedly.</p>

<h3 id="SFROM_Step_combine">SFROM (Step combine)</h3><hr>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/sfrom.gif"    /></p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/sfrom_zrst.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>SFROM use for combine after step parallel branch.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-SFROM.gif"    /></p>
<p>[Program description ]:</p>
<p>1. When program start the first scanning cycle SM2=ON, start step S3,by now S3=ON</p>
<p>2. When S3=ON, moreover jump condition X0=ON, then go to step S20,by now S20=ON. S3=OFF</p>
<p>3. When S20=ON then Y0=ON, when jump condition X1=ON, then go to step S30 S31 (step parallel branch)at the same time,by now S30=ON. S31=ON. S20=OFF. Y0=OFF</p>
<p>4. When S30=ON then Y1=ON, when jump condition X2=ON, then go to step S40,by now S40=ON. S30=OFF. Y1=OFF</p>
<p>5. When S40=ON then Y2=ON</p>
<p>6. When S31=ON then Y3=ON, when jump condition X3=ON, then go to step S41,by now S41=ON. S31=OFF. Y3=OFF</p>
<p>7. When S41=ON then Y4=ON</p>
<p>8. When S40=ON moreover S41=ON (step parallel branch combine), moreover jump condition X5=ON?, then go to step S60,by now S60=ON. S40=OFF. Y2=OFF. S41=OFF. Y4=OFF</p>
<p>9. When S60=ON then Y7=ON, when jump condition X6=ON, then go to step S3,by now S3=ON. S60=OFF. Y7=OFF, circulate repeatedly.</p>
<p>10. If M2=ON, then batch reset 100 steps start from s0, that is S0~S99.</p>

<h3 id="STO_Step_jump">STO (Step jump)</h3>
<hr>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/sto.gif"    /></p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/sto.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>STO use for start next step process, or bring the program process go to the specified step number.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-STO.gif"    /></p>
<p>[Program description]:</p>
<p>1. When M2=ON, start step S3,by now S3=ON</p>
<p>2. When S3=ON, moreover jump condition X0=ON, then go to step S20,by now S20=ON. S3=OFF</p>
<p>3. When S20=ON then Y0=ON,at the same time start timer T0, when T0 time is up, then go to step S30,by now S30=ON. S20=OFF. Y0=OFF. T0=OFF</p>
<p>4. When S30=ON then Y1=ON, when jump condition X1=ON, then go to step S60,by now S60=ON. S30=OFF. Y1=OFF</p>
<p>5. When S60=ON then Y7=ON, when jump condition X2=ON, then go to step S3,by now S3=ON. S60=OFF. Y7=OFF, circulate repeatedly.</p>
<p>, when exit condition X3=ON, then reset step S60,by now S60=OFF. Y7=OFF, terminate the step.</p>

<h3 id="Bit_instruction">Bit instruction</h3>
<hr>
<p>Bit instruction list as follows</p>
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
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="#AND_Logic_AND">AND</a></td>
            <td>
                <p> </p>
            </td>
            <td></td>
            <td>
                <p>Logic AND</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#OR_Logic_OR">OR</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Logic OR</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#XOR_Logic_XOR">XOR</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Logic XOR</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#OUT_Coil_output">OUT</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Coil output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#SET_Setting">SET</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Setting </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#RST_Reset">RST</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Reset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ALT_ON_OFF_alternately_output">ALT</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>ON/OFF alternately output</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ZRST_Batch_reset">ZRST</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Batch reset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#ENO_Get_ENO_output">ENO</a></td>
            <td>
                <p> </p>
            </td>
            <td> </td>
            <td>
                <p>Get ENO output</p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p></p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="AND_Logic_AND">AND(Logic AND)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td><img src="<?= $path_to_images ?>images/and.gif"    /></td>
            <td>
                <p>AND In1, In2 [, ?/span&gt;, In15], Out</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/and_or_xor.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>In1 </p>
            </td>
            <td>
                <p>Operand 1 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>In2 </p>
            </td>
            <td>
                <p>Operand 2 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>?o:p&gt; </p>
            </td>
            <td>
                <p>?/span&gt; </p>
            </td>
            <td>
                <p>?o:p&gt; </p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>In15 </p>
            </td>
            <td>
                <p>Operand 15 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>Out </p>
            </td>
            <td>
                <p>Status output </p>
            </td>
            <td> </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>AND instruction logic AND a group bit component of Input and then output, only In1~In15 Input states all are ON the Out=ON, otherwise Out=OFF,support 2~15 variable Input.</p>
<h3 id="OR_Logic_OR">OR(Logic OR)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td><img src="<?= $path_to_images ?>images/or.gif"    /></td>
            <td>
                <p>OR In1, In2 [, ?/span&gt;, In15], Out</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/and_or_xor.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>In1 </p>
            </td>
            <td>
                <p>Operand 1 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>In2 </p>
            </td>
            <td>
                <p>Operand 2 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>?o:p&gt; </p>
            </td>
            <td>
                <p>?/span&gt; </p>
            </td>
            <td>
                <p>?o:p&gt; </p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>In15 </p>
            </td>
            <td>
                <p>Operand 15 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>Out </p>
            </td>
            <td>
                <p>Status output </p>
            </td>
            <td> </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>OR instruction logic OR a group bit component of Input and then output, if only one of In1~In15 Input states is ON the Out=ON, otherwise Out=OFF,support 2~15 variable Input.</p>
<h3 id="XOR_Logic_XOR">XOR(Logic XOR)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td><img src="<?= $path_to_images ?>images/xor.gif"    /></td>
            <td>
                <p>XOR In1, In2 [, ?/span&gt;, In15], Out</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/and_or_xor.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>In1 </p>
            </td>
            <td>
                <p>Operand 1 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>In2 </p>
            </td>
            <td>
                <p>Operand 2 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>?o:p&gt; </p>
            </td>
            <td>
                <p>?/span&gt; </p>
            </td>
            <td>
                <p>?o:p&gt; </p>
            </td>
            <td>
                <p></p>
            </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>In15 </p>
            </td>
            <td>
                <p>Operand 15 </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>
                <p>Out </p>
            </td>
            <td>
                <p>Status output </p>
            </td>
            <td> </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>XOR instruction logic XOR a group bit component of Input and then output, when the ON odd number of In1~In15 Input states the Out=ON, otherwise Out=OFF,support 2~15 variable Input.</p>
<h3 id="OUT_Coil_output">OUT(Coil output)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/out-ld.gif"    /></p>
            </td>
            <td><img src="<?= $path_to_images ?>images/out-fbd.gif"    /></td>
            <td>
                <p>OUT In, Out</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/out_set_rst_alt.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>In</td>
            <td>
                <p>Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>
                <p>Output </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>OUT instruction assign Input state to Output,In=ON then Out=ON,In=OFF then Out=OFF.</p>
<h3 id="SET_Setting">SET(Setting)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/set-ld.gif"    /></p>
            </td>
            <td><img src="<?= $path_to_images ?>images/set-fbd.gif"    /></td>
            <td>
                <p>SET In, Out</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/out_set_rst_alt.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>In</td>
            <td>
                <p>Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>
                <p>Output </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>SET instruction according Input state to set output,In=ON then Out=ON,In=OFF then Out keep the original state.SET instruction general used edge Input executed.</p>
<h3 id="RST_Reset">RST(Reset)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/rst-ld.gif"    /></p>
            </td>
            <td><img src="<?= $path_to_images ?>images/rst-fbd.gif"    /></td>
            <td>
                <p>RST In, Out</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/out_set_rst_alt.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>In</td>
            <td>
                <p>Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>
                <p>Output </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>1. RST instruction according Input state to reset Output, In=ON then Out=OFF,In=OFF then Out keep the original state.RST instruction general used edge Input executed.</p>
<p>2. If Out is timer Tx,at the same time reset the timer coil T and current value TV, if Output is counter Cx,at the same time reset the counter coil C and current value CV.</p>
<p>3. If Out is step relay S,except reset the step state, if the step is executing then reset the output of the OUT instruction . timer coil T and current value TV . counter coil C and current value CV within the step .</p>
<h3 id="ALT_ON_OFF_alternately_output">ALT(ON/OFF alternately output)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/alt-ld.gif"    /></p>
            </td>
            <td><img src="<?= $path_to_images ?>images/alt-fbd.gif"    /></td>
            <td>
                <p>ALT In, Out</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/out_set_rst_alt.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>In</td>
            <td>
                <p>Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>
                <p>Output </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>ALT instruction negation the input state to output state, In=ON then Out negation it self,In=OFF then Out keep the original state.ALT instruction general used edge Input executed.</p>
<h3 id="ZRST_Batch_reset">ZRST(Batch reset)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/zrst.gif"    /></p>
            </td>
            <td>
                <p>ZRST En, N, Des</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/sfrom_zrst.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>En</td>
            <td>
                <p>Enable Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>N</td>
            <td>
                <p>Component numbers to be reset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td>
                <p>1~256</p>
            </td>
        </tr>
        <tr>
            <td>Eno</td>
            <td>
                <p>Enable output </p>
            </td>
            <td> </td>
            <td>v</td>
            <td> </td>
        </tr>
        <tr>
            <td>Des</td>
            <td>
                <p>Start address of component to be reset </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>1. ZRST instruction batch reset N component start from Des.ZRST instruction general used edge Input executed.</p>
<p>2. If Des is timer Tx, will reset timer coil T and current value TV,Iif Output is counter Cx, will reset counter coil C and current value CV.</p>
<p>3. if Des is step state S,except reset the step state, if the step is executing then reset the output of the OUT instruction . timer coil T and current value TV . counter coil C and current value CV within the step.</p>
<h3 id="ENO_Get_ENO_output">ENO(Get ENO output)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td>
                <p>Without</p>
            </td>
            <td>
                <p>EnO Out</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/eno.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Out</td>
            <td>
                <p>Output </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>1. IL Language All instruction without Eno Enable outpu item in IL Language, for programmed by IL Language and FBD Language . LD Language the same function, in IL language special add ENO instruction, it's function equal to the Eno Enable output items of the application instruction in FBD. LD Language. </p>
<p>2. ENO instruction only one Output item,the state of Output items only relate to the first item near the ENO instruction in BD or LD language have Eno Output instruction.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-eno.gif"    /></p>
<p>[Program description]</p>
<p>1. MAX instruction is a FBD or LD language instructionwhich have Eno Output item, moreover nearest ENO instruction(because OUT instruction have not Eno Output item), so in program, the output item state M0 of ENO instruction relate to MAX instruction executive condition.</p>
<p>2. When X0=ON (X2 normal close),M100=ON</p>
<p>3. M100=ON, MAX instruction execute, V10 equal to V1000. V1001. V1002 the 3 registers maximum,Eno Output=ON of the MAX instruction</p>
<p>4. X2=OFF,Y0=OFF</p>
<p>5. ENO instruction get Eno Output of previous instruction,because MAX instruction Eno Output=ON,so the M0 state is ON</p>
<p>6. M0=ON,ADD instruction??,AQ0=V10+200</p>


<h3 id="Timer">Timer</h3>
<hr>
<p>Timer list as follows </p>
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
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="#TON_Delay_ON">TON</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Delay ON</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TOF_Delay_OFF">TOF</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Delay OFF</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#TP_Pulse_timer">TP</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>Pulse timer</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
    </tbody>
</table>
<p>Note:T252~T255 time base fixed to 1ms.Others timer time base can be set arbitrarily to 10ms. 100ms. 1s.</p>
<h3 id="TON_Delay_ON">TON(Delay ON)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/ton.gif"    /></p>
            </td>
            <td>
                <p>TON.ns In, Pt, Tx</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/ton.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ns</td>
            <td>
                <p>Base time value</p>
            </td>
            <td></td>
            <td></td>
            <td>
                <p>T252~T255 time base are 1ms.Others can be set arbitrarily to 10ms. 100ms. 1s</p>
            </td>
        </tr>
        <tr>
            <td>In</td>
            <td>
                <p>Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Pt</td>
            <td>
                <p>Set time </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>Timer coil Tx</td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
        <tr>
            <td>TV</td>
            <td>
                <p>Current time</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<div>
    <p>[Instruction function and effect declare] </p>
    <p>1. TON is delay ON instruction, when In=ON, start timer timing,TV is the current value of the timer, when TV equal to the set time (time time to),Out(timer output coil Tx)=ON,and stop timing.When In turn into OFF,Out(timer output coil Tx)=OFF, moreover TV value reset to zero.In the timing process(time non-arrival),In turn into OFF, then stop timing,Out(timer output coil Tx)=OFF, moreover TV value reset to zero. </p>
    <p>2. Timing time= time base(ns)? setting time(Pt).E.g,:time base is 1s,setting time Pt=10, then delay on time is 1s ? 10 = 10s.</p>
    <p>[Instruction example] </p>
    <p><img src="<?= $path_to_images ?>images/gpc-ton.gif"    /></p>
    <p>[Program sketch map]</p>
    <p><img src="<?= $path_to_images ?>images/ton-xu.gif"    /></p>
    <p>[Program description]</p>
    <p>Timing time= time base(1s)? setting time (Pt=10)=10s.When X0=ON, timer T0 start timing, when TV0=10,T0=ON(Y0=ON) moreover stop timing .If X0=OFF,then T0=OFF(Y0=OFF),TV=0.</p>
</div>
<h3 id="TOF_Delay_OFF">TOF(Delay OFF)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/tof.gif"    /></p>
            </td>
            <td>
                <p>TOF.ns In, Pt, Tx</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/tof.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ns</td>
            <td>
                <p>Time base </p>
            </td>
            <td></td>
            <td></td>
            <td>
                <p>T252~T255 time base is 1ms.Others can be set arbitrarily to 10ms. 100ms. 1s </p>
            </td>
        </tr>
        <tr>
            <td>In</td>
            <td>
                <p>Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Pt</td>
            <td>
                <p>Setting time </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>Timer coil Tx</td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
        <tr>
            <td>TV</td>
            <td>
                <p>Current time </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>1. TOF is delay OFF instruction, when In=ON,Out(Timer coil Tx)=ON, When In state from ON go to OFF, start timer timing,TV is the timer current value, when TV equal to setting time (time time to),Out(Timer coil Tx)=OFF, and stop timing,TV=0.In the timing process(time non-arrival),the state of In go to ON, then Out (Timer coil Tx)=ON, timer stop timing,TV=0. </p>
<p>2. Timing time=time base(ns)? setting time(Pt).e.g.:time base is 10ms,Setting time Pt=1000, then delay OFF time is 10ms ? 1000 = 10s.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-tof.gif"    /></p>
<p>[Program sketch map]</p>
<p><img src="<?= $path_to_images ?>images/tof-xu.gif"    /></p>
<p>[Program description]</p>
<p>Timing time=time base (10ms)? setting time(Pt=1000)=10s.When X0=ON,T0=ON(Y0=ON), when X0=OFF, Timer T0 start timing, when TV0=1000,T0=OFF(Y0=OFF) moreover stop timing TV=0.if time non-arrival X0=ON, then T0=ON(Y0=ON), stop timing TV=0.</p>
<h3 id="TP_Pulse_timer">TP(Pulse timer)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>Instruction format</p>
            </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/tp.gif"    /></p>
            </td>
            <td>
                <p>TP.ns In, Pt, Tx</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/tp.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ns</td>
            <td>
                <p>Time base </p>
            </td>
            <td></td>
            <td></td>
            <td>
                <p>T252~T255 time base is 1ms.Others can be set arbitrarily to 10ms. 100ms. 1s </p>
            </td>
        </tr>
        <tr>
            <td>In</td>
            <td>
                <p>Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Pt</td>
            <td>
                <p>Setting time </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>Timer coil Tx</td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
        <tr>
            <td>TV</td>
            <td>
                <p>Current time </p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>1. TP is pulse timer, when In=ON,Out(Timer coil Tx)=ON, start timer timing,TV is timer current value, when TV equal to setting time (time arrival),Out(Timer coil Tx)=OFF,stop timing moreover TV value reset to zero.In the timing process(time non-arrival),regardless of the state of In changed, timer keep timing,Out(Timer coil Tx) keep ON. </p>
<p>2. Timing time= time base(ns)? setting time(Pt).e.g.:time base is 100ms,setting timePt=100, then the delay ON time is 100ms ? 100 = 10s.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-tp.gif"    /></p>
<p>[Program sketch map]</p>
<p><img src="<?= $path_to_images ?>images/tp-xu.gif"    /></p>
<p>[Program description]</p>
<p>Timing time= time base(100ms)? setting time(Pt=100)=10s.When X0=ON,T0=ON(Y0=ON),timer T0 start timing, when TV0=100,T0=OFF(Y0=OFF) moreover stop timing TV0=0.In the timing process,regardless of the state of X0 changed,timer keep timing,T0 keep ON until timing terminate.</p>

<h3 id="Counter">Counter</h3>
<hr>
<p>Counter list as follows </p>
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
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="#CTU_D_CTU_Increase_counter">CTU</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.CTU</p>
            </td>
            <td>
                <p>Increase counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CTD_D_CTD_Decrease_counter">CTD</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.CTD</p>
            </td>
            <td>
                <p>Decrease counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
        <tr>
            <td><a href="#CTUD_D_CTUD_Increase_and_Decrease_counter">CTUD</a></td>
            <td>
                <p> </p>
            </td>
            <td>
                <p>D.CTUD</p>
            </td>
            <td>
                <p>Increase and Decrease counter</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td>
                <p>v</p>
            </td>
        </tr>
    </tbody>
</table>
<p>Note:C48~C79 are 32 bit counter, others are 16 bit counter.</p>
<h3 id="CTU_D_CTU_Increase_counter">CTU. D.CTU(Increase counter)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>16. 32 bit </p>
                <p>Instruction format</p>
            </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/ctu.gif"    /> <img src="<?= $path_to_images ?>images/d.ctu.gif"    /></p>
            </td>
            <td>
                <p>CTU Cu, PV, Cx</p>
                <p>D.CTU Cu, PV, Cx</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/ctu.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Cu</td>
            <td>
                <p>Increase count input</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>PV</td>
            <td>
                <p>Counter preset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>Counter coil Cx</td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td>Among C48~C79 are 32 bit counter, total 32 point</td>
        </tr>
        <tr>
            <td>CV</td>
            <td>
                <p>Counter current value</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>CTU is 16 bit increase counter instruction (D.CTU is 32 bit), when increase count input Cu from OFF go to ON, counter add 1, when CV great than or equal to PV, Out (counter coil Cx)=ON. Counting reached,if the counting pulse input again, counting will be continue, CV value will be added 1 continue, until reach maximum value(16 bit counter maximum value is 32767,32 bit counter maximum value is 2147483647),counting will not be continue after reach maximum value.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-ctu.gif"    /></p>
<p>[Program description]</p>
<p>When X0 from OFF go to ON once,CV0 add 1, when CV0 ? 10 counting reach,C0=ON(Y0=ON).</p>
<h3 id="CTD_D_CTD_Decrease_counter">CTD. D.CTD(Decrease counter)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>16. 32 bit</p>
                <p>Instruction format</p>
            </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/ctd.gif"    /> <img src="<?= $path_to_images ?>images/d.ctd.gif"    /></p>
            </td>
            <td>
                <p>CTD Cd, PV, Cx</p>
                <p>D.CTD Cd, PV, Cx</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/ctd.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Cd</td>
            <td>
                <p>Decrease count input</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>PV</td>
            <td>
                <p>Counter preset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>Counter coil Cx</td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td>Among C48~C79 are 32 bit counter, total 32 point</td>
        </tr>
        <tr>
            <td>CV</td>
            <td>
                <p>Counter current value</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>1. CTD is 16 bit increase counter instruction (D.CTU is 32 bit), When decrease count input Cu from OFF go to ON, counter subtract 1, when CV=0 then counting reached, Out (counter coil Cx)=ON.Counting reached, if the counting pulse input again, counting will not be continue.</p>
<p>2. When CTD instruction loaded or reset, CV = PV, that is CTD decrease from preset to 0.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-ctd.gif"    /></p>
<p>[Program description]</p>
<p>When program running CV=10, when X0 from OFF go to ON once,CV0 decrease 1, when CV0 = 0 counting reach,C0=ON(Y0=ON).</p>
<h3 id="CTUD_D_CTUD_Increase_and_Decrease_counter">CTUD. D.CTUD(Increase  and Decrease counter)</h3>
<p>Instruction format and parameter specification </p>
<table>
    <thead>
        <tr>
            <td>Language</td>
            <td>LD</td>
            <td>FBD</td>
            <td>IL</td>
            <td>Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>16. 32 bit</p>
                <p>Instruction format</p>
            </td>
            <td colspan="2">
                <p><img src="<?= $path_to_images ?>images/ctud.gif"    /> <img src="<?= $path_to_images ?>images/d.ctud.gif"    /></p>
            </td>
            <td>
                <p>CTUD Cu, Cd, PV, Cx</p>
                <p>D.CTUD Cu, Cd, PV, Cx</p>
            </td>
            <td>
                <p><a href="<?= $path_to_images ?>program/ctud.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> </p>
<table>
    <thead>
        <tr>
            <td>Parameter</td>
            <td>Parameter define</td>
            <td>Input</td>
            <td>Output</td>
            <td>Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Cu</td>
            <td>
                <p>Increase count Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td></td>
            <td> </td>
        </tr>
        <tr>
            <td>Cd</td>
            <td>
                <p>Decrease input Input </p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>PV</td>
            <td>
                <p>Counter preset</p>
            </td>
            <td>
                <p>v</p>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Out</td>
            <td>Counter coil Cx</td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td>Among C48~C79 are 32 bit counter, total 32 point</td>
        </tr>
        <tr>
            <td>CV</td>
            <td>
                <p>Counter current value</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>v</td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>[Instruction function and effect declare] </p>
<p>1. CTUD is 16 bit increase and decrease counter instruction (D.CTUD is 32 bit), when increase count input Cu from OFF go to ON,counter add 1, when decrease count Input Cd from OFF go to ON,counter subtract 1, when CV great than or equal to PV, Out (counter coil Cx)=ON, When CV less than PV, Out (counter coil Cx)=OFF.</p>
<p>2. 16 bit counter maximum CV value is 32767,minimum CV value is -32768,32 bit counter maximum CV value is 2147483647,minimum CV value is -2147483648.</p>
<p>[Instruction example] </p>
<p><img src="<?= $path_to_images ?>images/gpc-ctud.gif"    /></p>
<p>[Program description]</p>
<p>When X0 from OFF go to ON once,CV0 add 1, when X1 from OFF go to ON once,CV0 subtract 1, when CV0 ? 10,C0=ON(Y0=ON), When CV0 &lt;10,C0=OFF(Y0=OFF).</p>


<? include $_SERVER['DOCUMENT_ROOT'] . "/plc/haiwell-plc-programming-software/pages/Instruction_set_highspeed.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/plc/haiwell-plc-programming-software/pages/Instruction_set_cmp_mov.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/plc/haiwell-plc-programming-software/pages/Instruction_set_datachange_chr_file.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/plc/haiwell-plc-programming-software/pages/Instruction_set_math_flot.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/plc/haiwell-plc-programming-software/pages/Instruction_set_clock_comm.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/plc/haiwell-plc-programming-software/pages/Instruction_set_int_program_teshu.php"; ?>



