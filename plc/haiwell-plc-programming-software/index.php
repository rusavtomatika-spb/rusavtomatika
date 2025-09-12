<?
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_catalog_404.php";
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;

$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/haiwell-plc-programming-software.png",
    "openGraph_title" => "Руководство по ПЛК Haiwell",
    "openGraph_siteName" => "Русавтоматика"
);


$DESCRIPTION = 'Официальный представитель Haiwell PLC, программируемые логические контроллеры управления (ПЛК) со склада по отличной цене. Модули. Расширяемость до 10000 точек. Большой выбор, в наличии на складе, доставка по России.';
$KEYWORDS = 'контроллеры ПЛК, программируемые контроллеры, программируемые логические программируемые модули, управление PLC, PLC, Haiwell, официальный представитель';
$TITLE = 'Промышленные контроллеры (ПЛК, PLC) Haiwell купить в Санкт-Петербурге и Москве | доставка по всей России';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";
$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/plc/haiwell/";
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
if (isset($_GET["q"]))
    $current_url = substr(strip_tags(trim($_GET["q"])), 0, -1);
else {
    $current_url = "";
}
if ($current_url == "")
    $current_url = "Welcome";
$TITLE_second_part = 'Haiwell PLC programming software | купить ПЛК в Санкт-Петербурге и Москве | доставка по всей России';

switch ($current_url) {
    case "Welcome":
        $TITLE = "Welcome" . " | " . $TITLE_second_part;
        break;
    case "Product_Introduction":
        $TITLE = "Product Introduction" . " | " . $TITLE_second_part;
        break;
    case "QuickStart":
        $TITLE = "Quick Start" . " | " . $TITLE_second_part;
        break;
    case "PLC_Register_and_Data":
        $TITLE = "PLC Register and Data" . " | " . $TITLE_second_part;
        break;
    case "PLC_instruction_set":
        $TITLE = "PLC instruction set | " . $TITLE_second_part;
        break;
    case "Programming_operation_manual":
        $TITLE = "Programming operation manual" . " | " . $TITLE_second_part;
        break;
    case "Simulate_and_online_debugging":
        $TITLE = "Simulate and online debugging" . " | " . $TITLE_second_part;
        break;
    case "Online_control_PLC":
        $TITLE = "Online control PLC" . " | " . $TITLE_second_part;
        break;
    case "Networking_communicate_function":
        $TITLE = "Networking communicate function | " . $TITLE_second_part;
        break;
    case "Hardware_manual":
        $TITLE = "Hardware manual | " . $TITLE_second_part;
        break;
    case "Remote_module":
        $TITLE = "Remote module | " . $TITLE_second_part;
        break;
    case "Appendix":
        $TITLE = "Appendix | " . $TITLE_second_part;
        break;

    default:
        break;
}
?>

<div class="blockofcols_container block_haiwell_plc_programming_software" style="padding-left: 0;padding-right: 0; ">
    <div class="blockofcols_row">
        <div class="col-2 column_block_specifications" style="padding-top: 11px;padding-right: 0;">
            <div class="block_floating">
                <ul class="block_haiwell_plc_programming_software__menu">
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/">Welcome</a>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/Product_Introduction/">Product Introduction</a>
                        <ul>
                            <li><div class="anchor" data-rel="PLC_features">PLC features</div></li>
                            <li><div class="anchor" data-rel="Programming_software_features">Programming software features</div></li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/QuickStart/">Quick Start</a>
                        <ul>
                            <li><div class="anchor" data-rel="General_step_of_programming">General step of programming</div></li>
                            <li><div class="anchor" data-rel="First_step_Start_programming_software">First step: Programming software</div></li>
                            <li><div class="anchor" data-rel="Second_step_New_project">Second step: New project</div></li>
                            <li><div class="anchor" data-rel="Third_step_Write_control_program">Third step: Write control program</div></li>
                            <li><div class="anchor" data-rel="Fourth_step_PLC_hardware_configure">Fourth step: PLC hardware configure</div></li>
                            <li><div class="anchor" data-rel="Fifth_step_Off_line_simulate_debug">Fifth step: Off line simulate debug</div></li>
                            <li><div class="anchor" data-rel="Sixth_step_Online_with_PLC">Sixth step: Online with PLC</div></li>
                            <li><div class="anchor" data-rel="Seventh_step_Download_program">Seventh step: Download program</div></li>
                            <li><div class="anchor" data-rel="Eighth_step_Start_PLC">Eighth step: Start PLC</div></li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/PLC_Register_and_Data/">PLC Register and Data</a>
                        <ul>
                            <li><div class="anchor" data-rel="Overview">Overview</div></li>
                            <li><div class="anchor" data-rel="Data">Data</div></li>
                            <li><div class="anchor" data-rel="Component_overview">Component overview</div></li>
                            <li><div class="anchor" data-rel="External_input_relay_X">External input relay [X]</div></li>
                            <li><div class="anchor" data-rel="External_output_relay_Y">External output relay [Y]</div></li>
                            <li><div class="anchor" data-rel="Timer_T">Timer [T]</div></li>
                            <li><div class="anchor" data-rel="Counter_C">Counter[C]</div></li>
                            <li><div class="anchor" data-rel="Auxiliary_relay_M">Auxiliary relay[M]</div></li>
                            <li><div class="anchor" data-rel="Step_relay_S">Step relay[S]</div></li>
                            <li><div class="anchor" data-rel="System_status_bit_SM">System status bit [SM]</div></li>
                            <li><div class="anchor" data-rel="Local_relay_LM">Local relay [LM]</div></li>
                            <li><div class="anchor" data-rel="Analog_input_register_AI">Analog input register [AI]</div></li>
                            <li><div class="anchor" data-rel="Analog_output_register_AQ">Analog output register [AQ]</div></li>
                            <li><div class="anchor" data-rel="Current_value_of_timer_TV">Current value of timer [TV]</div></li>
                            <li><div class="anchor" data-rel="Current_value_of_counter_CV">Current value of counter [CV]</div></li>
                            <li><div class="anchor" data-rel="Internal_data_register_V">Internal data register [V]</div></li>
                            <li><div class="anchor" data-rel="System_register_SV">System register [SV]</div></li>
                            <li><div class="anchor" data-rel="Local_register_LV">Local register [LV]</div></li>
                            <li><div class="anchor" data-rel="Indexed_addressing_point_P">Indexed addressing point [P]</div></li>

                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/PLC_instruction_set/">PLC instruction set</a>
                        <ul>
                            <li><div class="anchor" data-rel="General_declare_of_the_instruction">General declare of the instruction</div></li>
                            <li><div class="anchor" data-rel="Compare_switch">Compare switch</div></li>
                            <li>
                                <div class="anchor parent" data-rel="Step_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Step instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="STL_Step_start">STL (Step start)</div></li>
                                    <li><div class="anchor" data-rel="SFROM_Step_combine">SFROM (Step combine)</div></li>
                                    <li><div class="anchor" data-rel="STO_Step_jump">STO (Step jump)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Bit_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Bit instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="AND_Logic_AND">AND(Logic AND)</div></li>
                                    <li><div class="anchor" data-rel="OR_Logic_OR">OR(Logic OR)</div></li>
                                    <li><div class="anchor" data-rel="XOR_Logic_XOR">XOR(Logic XOR)</div></li>
                                    <li><div class="anchor" data-rel="OUT_Coil_output">OUT(Coil output)</div></li>
                                    <li><div class="anchor" data-rel="SET_Setting">SET(Setting)</div></li>
                                    <li><div class="anchor" data-rel="RST_Reset">RST(Reset)</div></li>
                                    <li><div class="anchor" data-rel="ALT_ON_OFF_alternately_output">ALT(ON/OFF alternately output)</div></li>
                                    <li><div class="anchor" data-rel="ZRST_Batch_reset">ZRST(Batch reset)</div></li>
                                    <li><div class="anchor" data-rel="ENO_Get_ENO_output">ENO(Get ENO output)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Timer"><span class="tree-plus"></span><span class="anchor-anchor">Timer</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="TON_Delay_ON">TON(Delay ON) </div></li>
                                    <li><div class="anchor" data-rel="TOF_Delay_OFF">TOF(Delay OFF)</div></li>
                                    <li><div class="anchor" data-rel="TP_Pulse_timer">TP(Pulse timer)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Counter"><span class="tree-plus"></span><span class="anchor-anchor">Counter</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="CTU_D_CTU_Increase_counter">CTU. D.CTU(Increase counter)</div></li>
                                    <li><div class="anchor" data-rel="CTD_D_CTD_Decrease_counter">CTD. D.CTD(Decrease counter)</div></li>
                                    <li><div class="anchor" data-rel="CTUD_D_CTUD_Increase_and_Decrease_counter">CTUD. D.CTUD(Increase  and Decrease counter)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="High_speed_control_instruction"><span class="tree-plus"></span><span class="anchor-anchor">High speed control instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="SHC_Single_high_counter">SHC (Single high counter)</div></li>
                                    <li><div class="anchor" data-rel="HHSC_High_speed_counter">HHSC (High speed counter )</div></li>
                                    <li><div class="anchor" data-rel="HCWR_Write_high_speed_counter">HCWR (Write high speed counter)</div></li>
                                    <li><div class="anchor" data-rel="SPD_Speed_detection">SPD (Speed detection )</div></li>
                                    <li><div class="anchor" data-rel="PWM_Pulse_width_modulation">PWM (Pulse width modulation)</div></li>
                                    <li><div class="anchor" data-rel="PLSY_D_PLSY_Pulse_output">PLSY. D.PLSY (Pulse output)</div></li>
                                    <li><div class="anchor" data-rel="PLSR_D_PLSR_Accelerate_and_decelerate_pulse_output">PLSR. D.PLSR( Accelerate and decelerate pulse output)</div></li>
                                    <li><div class="anchor" data-rel="ZRN_Origin_point_return">ZRN (Origin point return)</div></li>
                                    <li><div class="anchor" data-rel="SETZ_Set_electric_origin_point">SETZ (Set electric origin point)</div></li>
                                    <li><div class="anchor" data-rel="PPMR_Linear_interpolation">PPMR (Linear interpolation)</div></li>
                                    <li><div class="anchor" data-rel="CIMR_Circular_interpolation">CIMR (Circular interpolation )</div></li>
                                    <li><div class="anchor" data-rel="SPLS_Single_pulse_output">SPLS (Single pulse output)</div></li>
                                    <li><div class="anchor" data-rel="MPTO_Multi_segment_pulse_output">MPTO (Multi-segment pulse output)</div></li>
                                    <li><div class="anchor" data-rel="SYNP_Synchronization_pulse_output">SYNP (Synchronization pulse output)</div></li>
                                    <li><div class="anchor" data-rel="PSTOP_Stop_pulse_output">PSTOP (Stop pulse output)</div></li>
                                    <li><div class="anchor" data-rel="DVIT_Interrupt_positioning_pulse_output">DVIT (Interrupt positioning pulse output)</div></li>
                                    <li><div class="anchor" data-rel="ECAM_Electronic_CAM"> ECAM (Electronic CAM)</div></li>
                                    <li><div class="anchor" data-rel="JOGP_Jog_pulse_output">JOGP (Jog pulse output)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Compare_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Compare instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="CMP_D_CMP_Compare">CMP. D.CMP(Compare)</div></li>
                                    <li><div class="anchor" data-rel="ZCP_D_ZCP_Regional_comparison">ZCP. D.ZCP(Regional comparison)</div></li>
                                    <li><div class="anchor" data-rel="MATC_D_MATC_Numerical_match">MATC. D.MATC(Numerical match)</div></li>
                                    <li><div class="anchor" data-rel="ABSC_D_ABSC_Absolute_cam_comparison">ABSC. D.ABSC(Absolute cam comparison)</div></li>
                                    <li><div class="anchor" data-rel="BON_ON_bit_determine">BON(ON bit determine)</div></li>
                                    <li><div class="anchor" data-rel="BONC_D_BONC_ON_bit_numbers">BONC. D.BONC(ON bit numbers)</div></li>
                                    <li><div class="anchor" data-rel="MAX_D_MAX_Maximum">MAX. D.MAX(Maximum)</div></li>
                                    <li><div class="anchor" data-rel="MIN_D_MIN_Minimum">MIN. D.MIN(Minimum)</div></li>
                                    <li><div class="anchor" data-rel="SEL_D_SEL_Selection_of_conditions">SEL. D.SEL(Selection of conditions)</div></li>
                                    <li><div class="anchor" data-rel="MUX_D_MUX_Multi_choice">MUX. D.MUX(Multi-choice)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Shift_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Shift instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="LBST_Low_byte_evaluation">LBST(Low byte evaluation)</div></li>
                                    <li><div class="anchor" data-rel="HBST_High_byte_evaluation">HBST(High byte evaluation)</div></li>
                                    <li><div class="anchor" data-rel="MOV_D_MOV_Move">MOV. D.MOV(Move)</div></li>
                                    <li><div class="anchor" data-rel="BMOV_Block_move">BMOV(Block move)</div></li>
                                    <li><div class="anchor" data-rel="FILL_Fill">FILL(Fill)</div></li>
                                    <li><div class="anchor" data-rel="XCH_Byte_swap_D_XCH_Register_swap">XCH(Byte swap). D.XCH(Register swap)</div></li>
                                    <li><div class="anchor" data-rel="BXCH_Block_swap">BXCH(Block swap)</div></li>
                                    <li><div class="anchor" data-rel="SHL_Bit_left_shift">SHL(Bit left shift)</div></li>
                                    <li><div class="anchor" data-rel="SHR_Bit_right_shift">SHR(Bit right shift)</div></li>
                                    <li><div class="anchor" data-rel="WSHL_Word_left_shift">WSHL(Word left shift)</div></li>
                                    <li><div class="anchor" data-rel="WSHR_Word_right_shift">WSHR(Word right shift)</div></li>
                                    <li><div class="anchor" data-rel="ROL_Bit_rotate_left_shift">ROL(Bit rotate left shift)</div></li>
                                    <li><div class="anchor" data-rel="ROR_Bit_rotate_right_shift">ROR(Bit rotate right shift)</div></li>
                                    <li><div class="anchor" data-rel="WROL_Word_rotate_left_shift">WROL(Word rotate left shift)</div></li>
                                    <li><div class="anchor" data-rel="WROR_Word_rotate_right_shift">WROR(Word rotate right shift)</div></li>
                                    <li><div class="anchor" data-rel="BSHL_Byte_left_shift">BSHL(Byte left shift)</div></li>
                                    <li><div class="anchor" data-rel="BSHR_Byte_right_shift">BSHR(Byte right shift)</div></li>
                                    <li><div class="anchor" data-rel="ATBL_Append_to_array">ATBL(Append to array)</div></li>
                                    <li><div class="anchor" data-rel="FIFO_First_in_first_out">FIFO(First in first out)</div></li>
                                    <li><div class="anchor" data-rel="LIFO_Last_in_first_out">LIFO(Last in first out)</div></li>
                                    <li><div class="anchor" data-rel="SORT_Data_sort">SORT(Data sort)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Data_conversion_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Data conversion instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="ENCO_Encoder">ENCO(Encoder)</div></li>
                                    <li><div class="anchor" data-rel="DECO_Decoder">DECO(Decoder)</div></li>
                                    <li><div class="anchor" data-rel="BTOW_Bit_convert_to_word">BTOW(Bit convert to word)</div></li>
                                    <li><div class="anchor" data-rel="WTOB__Word_convert_to_bit">WTOB (Word convert to bit)</div></li>
                                    <li><div class="anchor" data-rel="HEX_HEX_LB_ASCII_convert_to_hexadecimal">HEX. HEX.LB(ASCII convert to hexadecimal)</div></li>
                                    <li><div class="anchor" data-rel="ASCI_ASCI_LB_Hexadecimal_convert_to_ASCII">ASCI. ASCI.LB(Hexadecimal convert to ASCII)</div></li>
                                    <li><div class="anchor" data-rel="BUNB_Discrete_bit_combination_to_continuous_bit">BUNB(Discrete bit combination to continuous bit)</div></li>
                                    <li><div class="anchor" data-rel="BUNW_Discrete_bit_combination_to_continuous_word">BUNW(Discrete bit combination to continuous word)</div></li>
                                    <li><div class="anchor" data-rel="WUNW_Discrete_word_combination_to_continuous_word">WUNW(Discrete word combination to continuous word)</div></li>
                                    <li><div class="anchor" data-rel="BDIB_Continuous_bit_disperse_to_discrete_bit">BDIB(Continuous bit disperse to discrete bit)</div></li>
                                    <li><div class="anchor" data-rel="WDIB_Continuous_word_disperse_to_discrete_bit">WDIB(Continuous word disperse to discrete bit)</div></li>
                                    <li><div class="anchor" data-rel="WDIW_Continuous_word_disperse_to_discrete_word">WDIW(Continuous word disperse to discrete word)</div></li>
                                    <li><div class="anchor" data-rel="BCD_D_BCD_BIN_convert_to_BCD">BCD. D.BCD(BIN convert to BCD)</div></li>
                                    <li><div class="anchor" data-rel="BIN_D_BIN_BCD_convert_to_BIN">BIN. D.BIN(BCD convert to BIN)</div></li>
                                    <li><div class="anchor" data-rel="ITOL_Integer_convert_to_long_integer">ITOL(Integer convert to long integer)</div></li>
                                    <li><div class="anchor" data-rel="GRAY_BIN_convert_to_GRAY_code">GRAY(BIN convert to GRAY code)</div></li>
                                    <li><div class="anchor" data-rel="GBIN_GRAY_code_convert_to_BIN">GBIN(GRAY code convert to BIN)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Character_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Character instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="GHLB_Obtain_high_low_byte">GHLB(Obtain high low byte)</div></li>
                                    <li><div class="anchor" data-rel="GETB_Capture_byte_string">GETB(Capture byte string)</div></li>
                                    <li><div class="anchor" data-rel="BCMP_BCMP_LB_Byte_string_comparison">BCMP. BCMP.LB(Byte string comparison)</div></li>
                                    <li><div class="anchor" data-rel="ITOC_D_ITOC_Integer_convert_to_character">ITOC. D.ITOC(Integer convert to character)</div></li>
                                    <li><div class="anchor" data-rel="CTOI_Character_convert_to_integer">CTOI(Character convert to integer)</div></li>
                                    <li><div class="anchor" data-rel="FTOC_Floating_point_convert_to_character">FTOC(Floating point convert to character)</div></li>
                                    <li><div class="anchor" data-rel="CTOF_Character_convert_to_floating_point">CTOF(Character convert to floating point)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Arithmetical_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Arithmetical instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="WNOT_D_WNOT_Negation">WNOT. D.WNOT(Negation)</div></li>
                                    <li><div class="anchor" data-rel="WAND_D_WAND_AND_operation">WAND. D.WAND(AND operation)</div></li>
                                    <li><div class="anchor" data-rel="WOR_D_WOR_OR_operation">WOR. D.WOR(OR operation)</div></li>
                                    <li><div class="anchor" data-rel="WXOR_D_WXOR_XOR_operation">WXOR. D.WXOR(XOR operation)</div></li>
                                    <li><div class="anchor" data-rel="ADD_D_ADD_Addition">ADD. D.ADD(Addition)</div></li>
                                    <li><div class="anchor" data-rel="SUB_D_SUB_Subtraction">SUB. D.SUB(Subtraction)</div></li>
                                    <li><div class="anchor" data-rel="INC_D_INC_Increase_1">INC. D.INC(Increase 1)</div></li>
                                    <li><div class="anchor" data-rel="DEC_D_DEC_Decrease_1">DEC. D.DEC(Decrease 1)</div></li>
                                    <li><div class="anchor" data-rel="MUL_D_MUL_Multiplication">MUL. D.MUL(Multiplication)</div></li>
                                    <li><div class="anchor" data-rel="DIV_D_DIV_Division">DIV. D.DIV(Division)</div></li>
                                    <li><div class="anchor" data-rel="ACCU_D_ACCU_Accumulation">ACCU. D.ACCU(Accumulation)</div></li>
                                    <li><div class="anchor" data-rel="AVG_D_AVG_Average">AVG. D.AVG(Average)</div></li>
                                    <li><div class="anchor" data-rel="ABS_D_ABS_Absolute_value">ABS. D.ABS(Absolute value)</div></li>
                                    <li><div class="anchor" data-rel="NEG_D_NEG_Two_s_complement">NEG. D.NEG(Two's complement)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Floating_point_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Floating point instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="FCMP_Floating_point_comparison">FCMP(Floating point comparison)</div></li>
                                    <li><div class="anchor" data-rel="FZCP_Floating_point_regional_comparison">FZCP(Floating point regional comparison)</div></li>
                                    <li><div class="anchor" data-rel="FMOV_Floating_point_move">FMOV(Floating point move)</div></li>
                                    <li><div class="anchor" data-rel="FADD_Floating_point_addition">FADD(Floating point addition)</div></li>
                                    <li><div class="anchor" data-rel="FSUB_Floating_point_subtraction">FSUB(Floating point subtraction)</div></li>
                                    <li><div class="anchor" data-rel="FMUL_Floating_point_multiplication">FMUL(Floating point multiplication)</div></li>
                                    <li><div class="anchor" data-rel="FDIV_Floating_point_division">FDIV(Floating point division)</div></li>
                                    <li><div class="anchor" data-rel="FACCU_Accumulation">FACCU(Accumulation)</div></li>
                                    <li><div class="anchor" data-rel="FAVG_Average">FAVG(Average)</div></li>
                                    <li><div class="anchor" data-rel="FMAX_Floating_point_maximum">FMAX(Floating point maximum)</div></li>
                                    <li><div class="anchor" data-rel="FMIN_Floating_point_minimum">FMIN(Floating point minimum)</div></li>
                                    <li><div class="anchor" data-rel="FTOI_Floating_point_convert_to_integer">FTOI(Floating point convert to integer)</div></li>
                                    <li><div class="anchor" data-rel="ITOF_D_ITOF_Integer_convert_to_floating_point">ITOF. D.ITOF(Integer convert to floating point)</div></li>
                                    <li><div class="anchor" data-rel="FABS_Floating_point_absolute">FABS(Floating point absolute)</div></li>
                                    <li><div class="anchor" data-rel="FSQR_Floating_point_square_root">FSQR(Floating point square root)</div></li>
                                    <li><div class="anchor" data-rel="FSIN_Sine">FSIN(Sine)</div></li>
                                    <li><div class="anchor" data-rel="FCOS_Cosine">FCOS(Cosine)</div></li>
                                    <li><div class="anchor" data-rel="FTAN_Tangent">FTAN(Tangent)</div></li>
                                    <li><div class="anchor" data-rel="FASIN_Arcsine">FASIN(Arcsine)</div></li>
                                    <li><div class="anchor" data-rel="FACOS_Arc_cosine">FACOS(Arc cosine)</div></li>
                                    <li><div class="anchor" data-rel="FATAN_Arctangent">FATAN(Arctangent)</div></li>
                                    <li><div class="anchor" data-rel="FLN_Natural_logarithm">FLN(Natural logarithm)</div></li>
                                    <li><div class="anchor" data-rel="FLOG_The_base_10_logarithm_of_a_number">FLOG(The base-10 logarithm of a number)</div></li>
                                    <li><div class="anchor" data-rel="FEXP_Nature_exponential">FEXP(Nature exponential)</div></li>
                                    <li><div class="anchor" data-rel="FRAD_Angle_convert_to_radian">FRAD(Angle convert to radian)</div></li>
                                    <li><div class="anchor" data-rel="FDEG_Radian_convert_to_angle">FDEG(Radian convert to angle)</div></li>
                                    <li><div class="anchor" data-rel="FXY_Exponent">FXY(Exponent)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Clock_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Clock instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="TCMP_Real_time_clock_comparison">TCMP(Real time clock comparison)</div></li>
                                    <li><div class="anchor" data-rel="TACCU_Time_accumulative_total">TACCU(Time accumulative total)</div></li>
                                    <li><div class="anchor" data-rel="SCLK_Setup_system_clock">SCLK(Setup system clock)</div></li>
                                    <li><div class="anchor" data-rel="TIME_Time_switch">TIME(Time switch)</div></li>
                                    <li><div class="anchor" data-rel="DATE_Date_switch">DATE(Date switch)</div></li>
                                    <li><div class="anchor" data-rel="INVT_Count_down">INVT(Count down)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Communication_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Communication instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="SUM_SUM_LB_SUM_verify">SUM. SUM.LB(SUM verify)</div></li>
                                    <li><div class="anchor" data-rel="BCC_BCC_LB_BCC_verify">BCC. BCC.LB(BCC verify)</div></li>
                                    <li><div class="anchor" data-rel="CRC_CRC_LB_CRC_verify">CRC. CRC.LB(CRC verify)</div></li>
                                    <li><div class="anchor" data-rel="LRC_LRC_LB_LRC_verify">LRC. LRC.LB(LRC verify)</div></li>
                                    <li><div class="anchor" data-rel="COMM_COMM_LB_Serial_communications">COMM. COMM.LB(Serial communications)</div></li>
                                    <li><div class="anchor" data-rel="MODR_Modbus_read">MODR(Modbus read)</div></li>
                                    <li><div class="anchor" data-rel="MODW_Modbus_write">MODW(Modbus write)</div></li>
                                    <li><div class="anchor" data-rel="HWRD_Haiwellbus_read">HWRD(Haiwellbus read)</div></li>
                                    <li><div class="anchor" data-rel="HWWR_Haiwellbus_write">HWWR(Haiwellbus write)</div></li>
                                    <li><div class="anchor" data-rel="RCV_Receive_communication_data">RCV(Receive communication data)</div></li>
                                    <li><div class="anchor" data-rel="XMT_XMT_LB_Sent_communication_data">XMT. XMT.LB(Sent communication data)</div></li>
                                    <li><div class="anchor" data-rel="FROM_Extend_module_CR_register_read">FROM(Extend module CR register read)</div></li>
                                    <li><div class="anchor" data-rel="TO_Extend_module_CR_register_write">TO(Extend module CR register write)</div></li>
                                    <li><div class="anchor" data-rel="TCPMDR_Modbus_TCP_read">TCPMDR(Modbus TCP read)</div></li>
                                    <li><div class="anchor" data-rel="TCPMDW_Modbus_TCP_write">TCPMDW(Modbus TCP write)</div></li>
                                    <li><div class="anchor" data-rel="TCPHWR_Haiwellbus_TCP_read">TCPHWR(Haiwellbus TCP read)</div></li>
                                    <li><div class="anchor" data-rel="TCPHWW_Haiwellbus_TCP_write">TCPHWW(Haiwellbus TCP write)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Interrupt_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Interrupt instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="ATCH_Interrupt_binding">ATCH(Interrupt binding)</div></li>
                                    <li><div class="anchor" data-rel="DTCH_Interrupt_release">DTCH(Interrupt  release)</div></li>
                                    <li><div class="anchor" data-rel="ENI_Enable_interrupt">ENI(Enable interrupt)</div></li>
                                    <li><div class="anchor" data-rel="DISI_Disable_interrupt">DISI(Disable interrupt)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Program_control_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Program control instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="MC_Master_control">MC(Master control)</div></li>
                                    <li><div class="anchor" data-rel="MCR_Master_control_clear">MCR(Master control clear)</div></li>
                                    <li><div class="anchor" data-rel="FOR_Loop_command">FOR(Loop command)</div></li>
                                    <li><div class="anchor" data-rel="NEXT_Loop_end">NEXT(Loop end)</div></li>
                                    <li><div class="anchor" data-rel="WAIT_Delay_wait">WAIT(Delay wait)</div></li>
                                    <li><div class="anchor" data-rel="CALL_Call_subroutine">CALL(Call subroutine)</div></li>
                                    <li><div class="anchor" data-rel="EXIT_Condition_exit">EXIT(Condition exit)</div></li>
                                    <li><div class="anchor" data-rel="REWD_Scanning_time_reset">REWD(Scanning time reset)</div></li>
                                    <li><div class="anchor" data-rel="JMPC_Condition_jump">JMPC(Condition jump)</div></li>
                                    <li><div class="anchor" data-rel="LBL_Jump_label">LBL(Jump label)</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Special_Function_instruction"><span class="tree-plus"></span><span class="anchor-anchor">Special Function  instruction</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="GPWM_General_pulse_width_modulation">GPWM(General pulse width modulation)</div></li>
                                    <li><div class="anchor" data-rel="FTC_Fuzzy_temperature_control">FTC(Fuzzy temperature control)</div></li>
                                    <li><div class="anchor" data-rel="PID_PID_control">PID(PID control)</div></li>
                                    <li><div class="anchor" data-rel="HAL_D_HAL_Upper_limit_alarm">HAL. D.HAL(Upper limit alarm)</div></li>
                                    <li><div class="anchor" data-rel="LAL_D_LAL_Lower_limit_alarm">LAL. D.LAL(Lower limit alarm)</div></li>
                                    <li><div class="anchor" data-rel="LIM_D_LIM_Range_limitation">LIM. D.LIM(Range limitation)</div></li>
                                    <li><div class="anchor" data-rel="SC_D_SC_Linear_conversion">SC. D.SC(Linear conversion)</div></li>
                                    <li><div class="anchor" data-rel="VC_Valve_control">VC(Valve control)</div></li>
                                    <li><div class="anchor" data-rel="TTC_Temperature_curve_control">TTC(Temperature curve control)</div></li>
                                    <li><div class="anchor" data-rel="APID_Self_tuning_PID_control">APID(Self-tuning PID control)</div></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/Programming_operation_manual/">Programming operation manual</a>
                        <ul>
                            <li><div class="anchor parent" data-rel="Programming_environment"><span class="tree-plus"></span><span class="anchor-anchor">Programming environment</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="Overview">Overview</div></li>
                                    <li><div class="anchor" data-rel="Menu">Menu</div></li>
                                    <li><div class="anchor" data-rel="Tools_bar">Tools bar</div></li>
                                    <li><div class="anchor" data-rel="Right_click_menu">Right click menu</div></li>
                                    <li><div class="anchor" data-rel="Shortcut_key">Shortcut key</div></li>
                                    <li><div class="anchor" data-rel="Status_bar">Status bar</div></li>
                                    <li><div class="anchor" data-rel="Working_area">Working area</div></li>
                                    <li><div class="anchor" data-rel="Project_manager">Project manager</div></li>
                                    <li><div class="anchor" data-rel="PLC_resource">PLC resource</div></li>
                                    <li><div class="anchor" data-rel="Component_comment_table">Component comment table</div></li>
                                    <li><div class="anchor" data-rel="Instruction_declare_window">Instruction declare window</div></li>
                                    <li><div class="anchor" data-rel="Instruction_attribute_window">Instruction attribute window</div></li>
                                    <li><div class="anchor" data-rel="Item_define_window">Item define window</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Program_structure"><span class="tree-plus"></span><span class="anchor-anchor">Program structure</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="Main_program">Main program </div></li>
                                    <li><div class="anchor" data-rel="Sub_program">Sub program</div></li>
                                    <li><div class="anchor" data-rel="Interrupt_program">Interrupt program</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Program_project_build"><span class="tree-plus"></span><span class="anchor-anchor">Program project build</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="New_program_project">New program project</div></li>
                                    <li><div class="anchor" data-rel="New_program_block">New program block</div></li>
                                    <li><div class="anchor" data-rel="New_sub_program">New sub program</div></li>
                                    <li><div class="anchor" data-rel="Open_program_block">Open program block</div></li>
                                    <li><div class="anchor" data-rel="Delete_program_block">Delete program block</div></li>
                                    <li><div class="anchor" data-rel="Program_block_execution_sequence_adjust">Program block execution sequence adjust</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Instruction_use_table"><span class="tree-plus"></span><span class="anchor-anchor">Instruction use table</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="Haiwellbus_read_read_communication_table">Haiwellbus read read communication table</div></li>
                                    <li><div class="anchor" data-rel="Haiwellbus_write_communication_table">Haiwellbus write communication table</div></li>
                                    <li><div class="anchor" data-rel="Disperse_bit_component_table">Disperse bit component table</div></li>
                                    <li><div class="anchor" data-rel="Disperse_register_component_table">Disperse register component table</div></li>
                                    <li><div class="anchor" data-rel="Initial_register_value_table">Initial register value table</div></li>
                                    <li><div class="anchor" data-rel="New_table">New table</div></li>
                                    <li><div class="anchor" data-rel="Open_table">Open table</div></li>
                                    <li><div class="anchor" data-rel="Delete_table">Delete table</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="PLC_hardware_configuare"><span class="tree-plus"></span><span class="anchor-anchor">PLC hardware configuare</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="PLC_MPU_model">PLC MPU model</div></li>
                                    <li><div class="anchor" data-rel="Extend_block_edit">Extend block edit</div></li>
                                    <li><div class="anchor" data-rel="Assign_external_I_O_component">Assign external I/O component</div></li>
                                    <li><div class="anchor" data-rel="X_digital_input_parameter">X digital input parameter</div></li>
                                    <li><div class="anchor" data-rel="Y_digital_output_parameter">Y digital output parameter</div></li>
                                    <li><div class="anchor" data-rel="AI_analog_input_parameter">AI analog input parameter</div></li>
                                    <li><div class="anchor" data-rel="AQ_analog_output_parameter">AQ analog output parameter</div></li>
                                    <li><div class="anchor" data-rel="HSC_high_speed_counter_parameter">HSC high speed counter parameter</div></li>
                                    <li><div class="anchor" data-rel="PLS_high_speed_output_parameter">PLS high speed output parameter</div></li>
                                </ul>

                            </li>
                            <li><div class="anchor parent" data-rel="LD_ladder_diagram_programming"><span class="tree-plus"></span><span class="anchor-anchor">LD ladder diagram programming</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="LD_work_area">LD work area</div></li>
                                    <li><div class="anchor" data-rel="Switch_edit">Switch edit</div></li>
                                    <li><div class="anchor" data-rel="Switch_status_change">Switch status change</div></li>
                                    <li><div class="anchor" data-rel="LD_instruction_edit">LD instruction edit</div></li>
                                    <li><div class="anchor" data-rel="Change_status_of_the_instruction_input_item">Change status of the instruction input item</div></li>
                                    <li><div class="anchor" data-rel="Branch_edit">Branch edit</div></li>
                                    <li><div class="anchor" data-rel="Network_edit">Network edit</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="FBD_function_block_programming"><span class="tree-plus"></span><span class="anchor-anchor">FBD function block programming</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="FBD_work_area">FBD work area</div></li>
                                    <li><div class="anchor" data-rel="FBD_instruction_edit">FBD instruction edit</div></li>
                                    <li><div class="anchor" data-rel="FBD_connect_between_instructions">FBD connect between instructions</div></li>
                                    <li><div class="anchor" data-rel="Change_FB_executed_sequence">Change FB executed sequence</div></li>
                                    <li><div class="anchor" data-rel="Change_instruction_input_status">Change instruction input status</div></li>
                                    <li><div class="anchor" data-rel="Page_edit">Page edit</div></li>
                                    <li><div class="anchor" data-rel="FBD_comment">FBD comment</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="IL_instruction_list_programming"><span class="tree-plus"></span><span class="anchor-anchor">IL instruction list programming</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="IL_work_area">IL work area</div></li>
                                    <li><div class="anchor" data-rel="IL_instruction_edit">IL instruction edit</div></li>
                                    <li><div class="anchor" data-rel="Change_the_instruction_input_status">Change the instruction input status</div></li>
                                    <li><div class="anchor" data-rel="IL_comment">IL comment</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Others"><span class="tree-plus"></span><span class="anchor-anchor">Others</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="Find_and_replace">Find and replace</div></li>
                                    <li><div class="anchor" data-rel="Compile_program">Compile program </div></li>
                                    <li><div class="anchor" data-rel="Program_and_table_import">Program and table import</div></li>
                                    <li><div class="anchor" data-rel="Program_and_table_export">Program and table export</div></li>
                                    <li><div class="anchor" data-rel="Print_and_preview">Print and preview</div></li>
                                    <li><div class="anchor" data-rel="Component_used_table">Component used table</div></li>
                                    <li><div class="anchor" data-rel="Component_comment">Component comment</div></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/Simulate_and_online_debugging/">Simulate and online debugging</a>
                        <ul>
                            <li><div class="anchor" data-rel="Overview">Overview</div></li>
                            <li><div class="anchor parent" data-rel="Simulation_environment"><span class="tree-plus"></span><span class="anchor-anchor">Simulation environment</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="Simulate_tools_bar">Simulate tools bar</div></li>
                                    <li><div class="anchor" data-rel="Right_click_menu">Right-click menu</div></li>
                                    <li><div class="anchor" data-rel="Hardware_simulate_window">Hardware simulate window</div></li>
                                    <li><div class="anchor" data-rel="AI_AQ_simulate_window">AI/AQ simulate window</div></li>
                                    <li><div class="anchor" data-rel="Data_lock_window">Data lock window</div></li>
                                    <li><div class="anchor" data-rel="Real_time_curve_window">Real time curve window</div></li>
                                    <li><div class="anchor" data-rel="Message_window">Message window</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Simulate_operation"><span class="tree-plus"></span><span class="anchor-anchor">Simulate operation</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="General_steps_of_simulation">General steps of simulation</div></li>
                                    <li><div class="anchor" data-rel="Start_simulator">Start simulator</div></li>
                                    <li><div class="anchor" data-rel="Component_monitor">Component monitor</div></li>
                                    <li><div class="anchor" data-rel="Component_status_table">Component status table</div></li>
                                    <li><div class="anchor" data-rel="Force">Force</div></li>
                                    <li><div class="anchor" data-rel="Lock_data">Lock data</div></li>
                                    <li><div class="anchor" data-rel="Real_time_curve">Real time curve</div></li>
                                    <li><div class="anchor" data-rel="Power_off_simulate">Power off simulate</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor parent" data-rel="Communication_simulator"><span class="tree-plus"></span><span class="anchor-anchor">Communication simulator</span></div>
                                <ul>
                                    <li><div class="anchor" data-rel="Start_communication_simulator">Start communication simulator</div></li>
                                    <li><div class="anchor" data-rel="Manual_input_slave_response_information">Manual input slave response information</div></li>
                                    <li><div class="anchor" data-rel="Use_reality_serial_port_communicate_with_slave">Use reality serial port communicate with slave</div></li>
                                </ul>
                            </li>
                            <li><div class="anchor" data-rel="High_speed_counter_simulate">High speed counter simulate</div></li>
                            <li><div class="anchor" data-rel="Pulse_output_simulate">Pulse output simulate</div></li>
                            <li><div class="anchor" data-rel="Interpolation_simulate">Interpolation simulate</div></li>
                            <li><div class="anchor" data-rel="Difference_between_online_debugging_and_offline_simulate">Difference between online debugging and offline simulate</div></li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/Online_control_PLC/">Online control PLC</a>
                        <ul>
                            <li><div class="anchor" data-rel="PLC_station_number_setting_up">PLC station number setting up</div></li>
                            <li><div class="anchor" data-rel="Online_with_PLC">Online with PLC</div></li>
                            <li><div class="anchor" data-rel="Online_PLC_window">Online PLC window</div></li>
                            <li><div class="anchor" data-rel="Download_program">Download program</div></li>
                            <li><div class="anchor" data-rel="Upload_program">Upload program</div></li>
                            <li><div class="anchor" data-rel="Generate_PLC_executable_file">Generate PLC executable file</div></li>
                            <li><div class="anchor" data-rel="Download_PLC_executable_file">Download PLC executable file</div></li>
                            <li><div class="anchor" data-rel="PLC_firmware_upgrade">PLC firmware upgrade</div></li>
                            <li><div class="anchor" data-rel="Start_or_stop_PLC">Start or stop PLC</div></li>
                            <li><div class="anchor" data-rel="Clear_PLC_program">Clear PLC program</div></li>
                            <li><div class="anchor" data-rel="Program_compare">Program compare</div></li>
                            <li><div class="anchor" data-rel="PLC_Diagnosis">PLC Diagnosis</div></li>
                            <li><div class="anchor" data-rel="Set_PLC_password">Set PLC password</div></li>
                            <li><div class="anchor" data-rel="Set_PLC_clock">Set PLC clock</div></li>
                            <li><div class="anchor" data-rel="Set_PLC_communication_parameter">Set PLC communication parameter</div></li>
                            <li><div class="anchor" data-rel="Set_PLC_parameter">Set PLC parameter</div></li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/Networking_communicate_function/">Networking communicate function</a>
                        <ul>
                            <li><div class="anchor" data-rel="Feature">Feature</div></li>
                            <li><div class="anchor" data-rel="Networking_schematic_diagram">Networking schematic diagram</div></li>
                            <li><div class="anchor" data-rel="Modbus_communication">Modbus communication</div></li>
                            <li><div class="anchor" data-rel="Haiwellbus_communication">Haiwellbus communication</div></li>
                            <li><div class="anchor" data-rel="Freedom_communication">Freedom communication</div></li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/Hardware_manual/">Hardware manual</a>
                        <ul>
                            <li><div class="anchor" data-rel="Model_table">Model table</div></li>
                            <li><div class="anchor" data-rel="PLC_specification">PLC specification</div></li>
                            <li><div class="anchor" data-rel="Other_specification">Other specification</div></li>
                            <li><div class="anchor" data-rel="Extend_module_parameter">Extend module parameter</div></li>
                            <li><div class="anchor" data-rel="Indicator_declare">Indicator declare</div></li>
                            <li><div class="anchor" data-rel="I_O_wiring_diagram">I/O wiring diagram</div></li>
                            <li><div class="anchor" data-rel="PLC_installation_and_precautions">PLC installation and precautions</div></li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/Remote_module/">Remote module</a>
                        <ul>
                            <li><div class="anchor" data-rel="Overview">Overview</div></li>
                            <li><div class="anchor" data-rel="Module_station_number_setting_up">Module station number setting up</div></li>
                            <li><div class="anchor" data-rel="Online_with_module">Online with module</div></li>
                            <li><div class="anchor" data-rel="Parameter_modify">Parameter modify</div></li>
                            <li><div class="anchor" data-rel="Parameter_upload">Parameter upload</div></li>
                            <li><div class="anchor" data-rel="Parameter_download">Parameter download</div></li>
                            <li><div class="anchor" data-rel="Firmware_upgrade">Firmware upgrade</div></li>
                            <li><div class="anchor" data-rel="Online_monitor">Online monitor</div></li>
                        </ul>
                    </li>
                    <li>
                        <a class="chapter" href="/plc/haiwell-plc-programming-software/Appendix/">Appendix</a>
                        <ul>
                            <li><div class="anchor" data-rel="SM_system_status_bit">SM system status bit</div></li>
                            <li><div class="anchor" data-rel="SV_system_register">SV system register </div></li>
                            <li><div class="anchor" data-rel="Syetem_interruption_table">Syetem interruption table</div></li>
                            <li><div class="anchor" data-rel="Communication_address_code_table">Communication address code table</div></li>
                            <li><div class="anchor" data-rel="Error_code_table">Error code table</div></li>
                            <li><div class="anchor" data-rel="Programming_cable_wiring_diagram">Programming cable wiring diagram</div></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-10 column_block_equipment">
            <div class="block_haiwell_plc_programming_software__page">
                            <article> 

                <?
                $path_to_images = "/plc/haiwell-plc-programming-software/";
                $path_to_page = $_SERVER['DOCUMENT_ROOT'] . "/plc/haiwell-plc-programming-software/pages/" . $current_url . ".php";
                if (file_exists($path_to_page)) {
                    include $path_to_page;
                } else {
                    header('HTTP/1.1 404 Not Found');
                    global $TITLE;
                    $TITLE = "Страница не найдена, ошибка 404";
                    echo "<h1>Извините, страница не найдена.</h1> Ошибка 404.";
                }
                ?>
                                            </article> 

            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        if ($(".block_floating").length > 0) {
            $(window).scroll(function () {
                var topPos = $('.block_floating').offset().top - 20;
                var block_floating_height = $('.block_floating').height();
                var top = $(document).scrollTop();
                var bottomBorderPos = $('#footer').offset().top - block_floating_height - 26;
                $('.column_block_specifications').css("height", $('.column_block_equipment').height());

                if (top > topPos && top < bottomBorderPos)
                {
                    $('.block_floating').css('width', $('.block_floating').width());
                    $('.column_block_specifications').css('min-height', $('.block_floating').height());
                    $('.block_floating').removeClass('block_floating_fixed2');
                    $('.block_floating').addClass('block_floating_fixed');
                } else
                if (top > topPos && top > bottomBorderPos)
                {
                    $('.block_floating').css('width', $('.block_floating').width());
                    $('.column_block_specifications').css('min-height', $('.block_floating').height());
                    $('.block_floating').removeClass('block_floating_fixed');
                    $('.block_floating').addClass('block_floating_fixed2');
                } else {
                    $('.column_block_specifications').css('min-height', $('.block_floating').height());
                    $('.block_floating').removeClass('block_floating_fixed');
                    $('.block_floating').removeClass('block_floating_fixed2');
                }
            });
        }
        $(".block_haiwell_plc_programming_software__menu .anchor .tree-plus").bind("click", function () {
            $(this).toggleClass('opened');
            $(this).parent().toggleClass('opened');
            $(this).parent().next('ul').toggle(50);
            return false;
        });
        $('.block_haiwell_plc_programming_software__menu a.chapter').each(function (i, elem) {
            what_search = "<?= $_SERVER["REQUEST_URI"] ?>";
            where_search = $(elem).attr("href");
            if (where_search == what_search) {
                $(elem).addClass('active');
                $('.block_haiwell_plc_programming_software__menu ul').hide(50);
                $(elem).parent().children('ul').show(50);
                set_parents = $(elem).parents('ul');
                $(set_parents).show(50);
                $(set_parents).prev('.chapter').addClass('active');
            }
        });
        if (location.hash) {
            hash = location.hash;
            hash = hash.replace(/^#/, '');
            console.log(hash);
            current_item = $(".block_haiwell_plc_programming_software__menu .anchor[data-rel='" + hash + "']");
            ul_parent = $(current_item).parent().parent().parent().children('.anchor.parent');
            $(ul_parent).addClass('opened');
            $(ul_parent).children('.tree-plus').addClass('opened');
            $(ul_parent).next('ul').show(50);
            console.log(ul_parent);
            $(current_item).click();
            $(current_item).addClass('active');
        }
        $('.block_haiwell_plc_programming_software__menu .anchor').click(function () {
            $(".block_haiwell_plc_programming_software__menu .anchor").not(this).removeClass('active');
            parent_ul = $(this).parent().parent();
            $(parent_ul).show();
            $(this).addClass('active');
            hash = $(this).attr('data-rel');
            if (hash && ($('h1').is('#' + hash) || $('h3').is('#' + hash) || $('h2').is('#' + hash))) {
                var scrollTop = $("#" + hash).offset().top - 10;
                var body = $("html, body");
                body.stop().animate({scrollTop: scrollTop}, 500, 'swing', function () {});
                location.hash = hash;
            }
        });
    });
</script>

<?
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/epilog.php";
?>








