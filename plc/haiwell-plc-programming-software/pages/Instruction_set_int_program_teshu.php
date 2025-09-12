<h3 id="Interrupt_instruction">Interrupt instruction</h3>
<hr>
<p> Interrupt instruction list as follows   </p>
<table>
    <thead>
        <tr>
            <td rowspan="2"> Instruction name</td>
            <td rowspan="2"> 8 bit model</td>
            <td rowspan="2"> 32 bit model</td>
            <td rowspan="2">  Instruction function</td>
            <td colspan="3">  Support language</td>
        </tr>
        <tr>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>  <a href="#ATCH_Interrupt_binding">ATCH</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Interrupt binding</p>
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
            <td>  <a href="#DTCH_Interrupt_release">DTCH</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Interrupt  release</p>
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
            <td>  <a href="#ENI_Enable_interrupt">ENI</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Enable interrupt</p>
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
            <td>  <a href="#DISI_Disable_interrupt">DISI</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Disable interrupt</p>
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
<p>  1. Haiwell PLC support up to 52 system interrupt source, include pulse output. edge catch .
    high speed counter and timer interrupt. refer to "
    <a href="/plc/haiwell-plc-programming-software/Appendix/#System_interruption_table">system interrupt table </a>".
</p>
<p> 2. Interrupt program only use ATCH instruction binding corresponding interrupt,
    moreover system generate the interrupt executed once ,others any time not execute. refer to "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Interrupt_program">interrupt program</a>".</p>
<p> 3. Interrupt program must try to do short and small ,only necessary instruction in interrupt program execute.</p>
<h3 id="ATCH_Interrupt_binding">ATCH(Interrupt binding)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/atch.gif"    /></p>
            </td>
            <td>
                <p> ATCH  En, Int, IntP</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/atch.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
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
            <td> Int</td>
            <td>
                <p>  Interrupt number  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> IntP</td>
            <td>
                <p>  Interrupt program name</p>
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
                <p>   Enable output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     ATCH instruction use for  binding IntP   interrupt program and Int   interrupt number , when system generate Int interrupt, automatic execute binding IntP   interrupt program, instruction general executed by edge.</p>
<p>  [Instruction example]</p>
<p>     1. At "<a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#PLC_hardware_configuare">PLC hardware configure</a>" window  configure "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#X_digital_input_parameter">DI digital Input Parameter</a>" open X1 rising edge catch function .</p>
<p>  <img src="<?= $path_to_images ?>images/par_di.gif"    /></p>
<p>     2. Write interrupt program "X1 rising edge catch", only one instruction,V0 increase 1,as follows.</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-atch2.gif"    /></p>
<p>     3. Write main program "ATCH" as follows:</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-atch3.gif"    /></p>
<p> [Program description]</p>
<p>     1. M0=ON, use for  Interrupt program binding "X1 rising edge catch " and Interrupt number I18(X1 rising edge interrupt), thus when X1 from OFF go to ON ,system generate I18 interrupt moreover call interrupt program "X1 rising edge catch".</p>
<p>     2. M1=ON, release interrupt number I18 bind,  by now  even if system generate  I18 interrupt also not execute interrupt program.</p>
<p>     3. M2=ON, enable system interrupt, thus when X1 from OFF go to ON, system generate   I18 interrupt.</p>
<p>     4. M3=ON, disable system interrupt, thus system not generate any interrupt.</p>
<h3 id="DTCH_Interrupt_release">DTCH(Interrupt  release)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/dtch.gif"    /></p>
            </td>
            <td>
                <p> DTCH  En, Int</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/atch.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Int</td>
            <td>
                <p>  Interrupt number  </p>
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
                <p>   Enable output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     DTCH instruction release Int Interrupt number bind interrupt program, instruction general executed by edge.</p>
<p>  [Instruction example]</p>
<p>      Refer to <a href="#ATCH_Interrupt_binding">ATCH</a>  instruction example.</p>
<h3 id="ENI_Enable_interrupt">ENI(Enable interrupt)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td>
                <p>  <img src="<?= $path_to_images ?>images/eni-ld.gif"    /></p>
            </td>
            <td>  <img src="<?= $path_to_images ?>images/eni-fbd.gif"    /></td>
            <td>
                <p>  ENI  En</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/atch.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable </p>
            </td>
            <td> v</td>
            <td> ?</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     ENI instruction open system interrupt function , system default open interrupt, instruction general executed by edge.</p>
<p>  [Instruction example]</p>
<p>      Refer to <a href="#ATCH_Interrupt_binding">ATCH</a>  instruction example.</p>
<h3 id="DISI_Disable_interrupt">DISI(Disable interrupt)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td>
                <p>  <img src="<?= $path_to_images ?>images/disi-ld.gif"    /></p>
            </td>
            <td>  <img src="<?= $path_to_images ?>images/disi-fbd.gif"    /></td>
            <td>
                <p> DISI  En</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/atch.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable   </p>
            </td>
            <td> v</td>
            <td> ?</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     DISI instruction shielding system interrupt function , after instruction executed no more generate system interrupt, instruction general executed by edge.</p>
<p>  [Instruction example]</p>
<p>      Refer to <a href="#ATCH_Interrupt_binding">ATCH</a> instruction example.</p>
<h3 id="Program_control_instruction">Program control instruction</h3>
<hr>
<p>  Program control  instruction list as follows   </p>
<table>
    <thead>
        <tr>
            <td rowspan="2"> Instruction name</td>
            <td rowspan="2"> 8 bit model</td>
            <td rowspan="2"> 32 bit model</td>
            <td rowspan="2">  Instruction function</td>
            <td colspan="3">  Support language</td>
        </tr>
        <tr>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> <a href="#MC_Master_control"> MC</a></td>
            <td> ?</td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p> Master control</p>
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
            <td> <a href="#MCR_Master_control_clear"> MCR</a></td>
            <td> ?</td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p> Master control clear</p>
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
            <td> <a href="#FOR_Loop_command"> FOR</a></td>
            <td> ?</td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>Loop command</p>
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
            <td> <a href="#NEXT_Loop_end"> NEXT</a></td>
            <td> ?</td>
            <td>
                <p>?</p>
            </td>
            <td>
                <p>Loop end</p>
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
            <td> <a href="#WAIT_Delay_wait">  WAIT</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Delay wait</p>
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
            <td> <a href="#CALL_Call_subroutine">  CALL</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Call subroutine</p>
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
            <td> <a href="#EXIT_Condition_exit">  EXIT</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Condition exit</p>
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
            <td> <a href="#REWD_Scanning_time_reset">  REWD</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Scanning time reset</p>
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
            <td> <a href="#JMPC_Condition_jump">  JMPC</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Condition jump</p>
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
            <td> <a href="#LBL_Jump_label">  LBL</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Jump label</p>
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
<h3 id="MC_Master_control">MC(Master control)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/mc.gif"    /></p>
            </td>
            <td>
                <p> MC  En,  N</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/mc_mcr.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
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
                <p>   Label  </p>
            </td>
            <td> v</td>
            <td> ?</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. MC is master control start instruction, N is Master control number, when En=ON, the instructions inner master control N ( between MC N and MCR N instruction ) as usual executed . </p>
<p>     2. When En=OFF ,the instructions inner master control N ( between MC and MCR instruction) skiped,  moreover reset  OUT instruction output. timer coil T and current value TV. counter coil Cand current value CV at the same time .</p>
<p>     3. MC-MCR instruction support nested structure , maximum may be up to 8 level.</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-mc_mcr.gif"    /></p>
<p> [Program description]</p>
<p>     1. Network 1 define master control 1 start , network 3 define master control 1 finish .</p>
<p>     2. When M0=ON, master control 1 program (Network 2) normal execution, when M1=ON,Y0=ON, timer T0 start timing , counter C0 increase 1,CV0=1,C0=ON. Master control 1 external Network 4 timer T1 start timing .</p>
<p>     3. When M0=OFF, then  master control 1 program (Network 2) instruction skip, moreover reset  Y0=OFF. T0=OFF. TV0=0. C0=OFF. CV0=0.Master control 1 external Network 4 timer T1 keep on timing.</p>
<h3 id="MCR_Master_control_clear">MCR(Master control clear)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td>
                <p>  <img src="<?= $path_to_images ?>images/mcr-ld.gif"    /></p>
            </td>
            <td>  <img src="<?= $path_to_images ?>images/mcr-fbd.gif"    /></td>
            <td>
                <p> MCR   N</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/mc_mcr.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> N</td>
            <td>
                <p> Label  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     MCR is master control finish instruction ,N is master control number, only pair use with <a href="#MC_Master_control">MC</a> instruction .</p>
<h3 id="FOR_Loop_command">FOR(Loop command)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/for.gif"    /></p>
            </td>
            <td>
                <p> FOR  En, Index, Init, Final</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/for_next.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Index</td>
            <td>
                <p>  Loop index  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Init</td>
            <td>
                <p> Start value  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Final</td>
            <td>
                <p>   Stop value  </p>
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
                <p>   Enable output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. FOR instruction and NEXT instruction must be used in pairs , among FOR sign the start of the circulate, NEXT sign the finish of the circulate .The statement between FOR and NEXT named loop body .</p>
<p>      2. FOR/NEXT instruction repeatedly execute the statement in the loop body until reach cycle count, among, count value of the cycle count store to parameter index, moreover Init assigned Index start value,Final assigned Index stop value .</p>
<p>      3. A integral loop body include in a loop body , also name loop nesting .FOR/NEXT support nesting, nested depth maximum are 8 level.</p>
<p>     4. In loop body ,user can modify stop value Final, thus modify the stop condition of the loop .</p>
<p>      5. If  many cycle count , then the program execute time possible exceed system watchdog timer value ,thus possible triggering system watchdog action cause safeguard stop,by now must add <a href="#REWD_Scanning_time_reset">REWD</a> instruction in the loop body to reset watchdog.</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-for_next.gif"    /></p>
<p> [Program description]</p>
<p>     1. M0=ON, each scan cycleV10 increase 1,Network 2 start one loop, loop index V0, cycle count 30(0~29),Network 3 loop body instruction,V2 each increase 1(after executed a loop then add 30), thus V2 must be V10 30 times.</p>
<p>     2. REWD instruction reset watchdog ,NEXT is loop end define.</p>
<h3 id="NEXT_Loop_end">NEXT(Loop end)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td>
                <p>  <img src="<?= $path_to_images ?>images/next-ld.gif"    /></p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/next-fbd.gif"    /></p>
            </td>
            <td>
                <p> NEXT</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/for_next.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>      Define the end of the loop ,only    be used in pairs with <a href="#FOR_Loop_command">FOR</a> instruction .</p>
<h3 id="WAIT_Delay_wait">WAIT(Delay wait)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/wait.gif"    /></p>
            </td>
            <td>
                <p> WAIT  En,  Tms</p>
            </td>
            <td>
                <p> ?</p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Tms</td>
            <td>
                <p> Delay time  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit    0.1ms</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p>   Enable output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. WAIT instruction make PLC program execute pause, pause time setup by parameter Tms .</p>
<p>     2. WAIT instruction extend the scan cycle, may be trigger the watchdog actuation , must try to do not use.</p>
<h3 id="CALL_Call_subroutine">CALL(Call subroutine)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/call.gif"    /></p>
            </td>
            <td>
                <p> CALL  En, SubP(0-8 input parameter names)(0-3 output parameter names)</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/call1.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
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
            <td> SubP</td>
            <td>
                <p> Subroutine name</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Par1~8</td>
            <td>
                <p>  Input parameter(Can be no parameters)  </p>
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
                <p> Enable output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out1~3</td>
            <td>
                <p>   Output    parameter (Can be no parameters)</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. CALL instruction use for call subroutine. Call subroutine can with parameter or without parameter, use programming software new subroutine window or subroutine attribute window, may be modify and edit the parameter of the subroutine ;When SubP parameter item input the subroutine name, programming software use for according to the defined parameter of the subroutine the program give the input . output parameter item and parameter name to call the subroutine , instruction input output parameter item enable input data type and the data type of the subroutine defined parameter must be no difference  </p>
<p>     2. Use CALL call subroutine, if the subroutine called not defined parameter, then without parameter call,CALL instruction Input parameter item and output parameter item omit .to with parameter call subroutine ,parameter therefore  transfer and assign in sequence one to one mode. </p>
<p>     3. Use CALL instruction reach call subroutine program named main program , subroutine may be called repeat, support nest call subroutine ,maximum  nesting 8 level. </p>
<p>     4. Subroutine parameter declare: </p>
<p>             A. One subroutine maximum may be define 8 input(IN) or input output (IN_OUT) parameter and 3 output(OUT) parameter; </p>
<p>              B. Each parameter all have the parameter type(IN-input parameter,OUT-output parameter,IN_OUT?nput output parameter) and data type, when use CALL instruction call the subroutine , instruction input output parameter item allow input data type no difference of the data type of the subroutine defined parameter . </p>
<p>      5. subroutineParameter?Parameter typeas follows table ??: </p>
<table>
    <tbody>
        <tr>
            <td> Parameter type </td>
            <td> ?? </td>
        </tr>
        <tr>
            <td> IN </td>
            <td>
                <p>  Input parameter, by CALL instruction use for parameter data incoming subroutine  </p>
            </td>
        </tr>
        <tr>
            <td> IN_OUT </td>
            <td>
                <p>  Input output parameter ,first CALL instruction use for parameter data incoming subroutine ,subroutine execut use for again incoming result to CALL instruction parameter  </p>
            </td>
        </tr>
        <tr>
            <td> OUT </td>
            <td>
                <p>  Output parameter ,subroutine after executed again incoming result  to CALL instruction parameter  </p>
            </td>
        </tr>
    </tbody>
</table>
<p>      6. subroutine data type as follows: </p>
<table>
    <tbody>
        <tr>
            <td> Data type </td>
            <td> ?? </td>
        </tr>
        <tr>
            <td> BOOL </td>
            <td>
                <p>  Also known as bool  type ,ON or OFF</p>
            </td>
        </tr>
        <tr>
            <td> WORD </td>
            <td>
                <p>  16 bit  word, may be data range is -32768~32767</p>
            </td>
        </tr>
        <tr>
            <td> DWORD </td>
            <td>
                <p> Double word,32 bit ,may be data range is   -2147483648~2147483647,occupy  2  continuous component  </p>
            </td>
        </tr>
        <tr>
            <td> INT </td>
            <td>
                <p> Integer,16 bit ,may be data range is -32768~32767  </p>
            </td>
        </tr>
        <tr>
            <td> DINT </td>
            <td>
                <p> Double integer,32 bit ,may be data range is -2147483648~2147483647,occupy  2  continuous component  </p>
            </td>
        </tr>
        <tr>
            <td> REAL </td>
            <td>
                <p>  Single precision floating point ,32 bit ,occupy  2  continuous component    </p>
            </td>
        </tr>
    </tbody>
</table>
<p>     7. Call subroutine PLC program executing sequence schematic diagram follows: </p>
<div>
    <div>
        <p>  <img src="<?= $path_to_images ?>images/sub%20program%20call.gif"    /> </p>
    </div>
</div>
<p>  [Instruction example]</p>
<p>     1. Program one subroutine "measuring range transfer ", the subroutine achieve <a href="#SC_D_SC_Linear_conversion">SC</a> instruction same function ,as follows.</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-call1.gif"    /></p>
<p>     2. Program main program "CALL"as follows:</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-call2.gif"    /></p>
<p> [Program description]</p>
<p>     1. Subroutine with 4 input parameter and 1output parameter, calculate Out = (In - InDw) * (OutUp- OutDw) / (InUp- InDw) + OutDw.</p>
<p>     2. Main program when M0=ON,2 CALL instruction call the same   subroutine "measuring range transfer", because different the parameter transfered , achieve different  range transfer function ,as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong> Parameter</strong>  </p>
            </td>
            <td>
                <p> <strong>Parameter value</strong></p>
            </td>
            <td>
                <p> <strong>Call subroutine result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> InUp</p>
            </td>
            <td> 1500</td>
            <td rowspan="4">
                <p> When V0=0, then V100 =0</p>
                <p> When V0=100, then V100 =333</p>
                <p> When V0=1200, then V100 =4000</p>
                <p> When V0=1250, then V100 =4166</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> InDw</p>
            </td>
            <td> 0</td>
        </tr>
        <tr>
            <td>
                <p> OutUp</p>
            </td>
            <td> 5000</td>
        </tr>
        <tr>
            <td>
                <p> OutDw</p>
            </td>
            <td> 0</td>
        </tr>
        <tr>
            <td>
                <p> InUp</p>
            </td>
            <td> 32000</td>
            <td rowspan="4">
                <p> When V2=0, then V102 =4000</p>
                <p> When V2=1600, then V102 =4800</p>
                <p> When V2=16000, then V102 =12000</p>
                <p> When V2=28000, then V102 =18000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> InDw</p>
            </td>
            <td> 0</td>
        </tr>
        <tr>
            <td>
                <p> OutUp</p>
            </td>
            <td> 20000</td>
        </tr>
        <tr>
            <td>
                <p> OutDw</p>
            </td>
            <td> 4000</td>
        </tr>
    </tbody>
</table>
<h3 id="EXIT_Condition_exit">EXIT(Condition exit)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td>
                <p>  <img src="<?= $path_to_images ?>images/exit-ld.gif"    /></p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/exit-fbd.gif"    /></p>
            </td>
            <td>
                <p> EXIT  En</p>
            </td>
            <td>
                <p> ?</p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>   Enable   </p>
            </td>
            <td> v</td>
            <td> ?</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     EXIT is condition exit instruction, only use which need early exit from subroutine or interruption , normal exit subroutine or interruption without add the instruction.</p>
<h3 id="REWD_Scanning_time_reset">REWD(Scanning time reset)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td>
                <p>  <img src="<?= $path_to_images ?>images/rewd-ld.gif"    /></p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/rewd-fbd.gif"    /></p>
            </td>
            <td>
                <p> REWD  En</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/for_next.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>   Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. REWD instruction use for reset watchdog.</p>
<p>     2. When program need loop execution at some condition , thus possible triggering system watchdog actuation cause protect stop ,by now  must add REWD instruction within the loop body to reset watchdog.</p>
<p>     3. REWD instruction make watchdog out of action, must try to do not use.</p>
<h3 id="JMPC_Condition_jump">JMPC(Condition jump)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/jmpc.gif"    /></p>
            </td>
            <td>
                <p> JMPC  En,  N</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/jmpc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
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
                <p>   Jump label  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. JMPC is with condition jump instruction, when En=ON, program use for jump to label N appoint position next instruction continue execution, if En=OFF then do not jump ,use original instruction sequence execution. </p>
<p>     2. N Jump label must use LBL instruction define, if label not exist, then the instruction not execute.   </p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-jmpc.gif"    /></p>
<p> [Program description]</p>
<p>     1. Network 1 INC instruction from busbar get electricity , each scan cycle use for V0 increase 1.</p>
<p>     2. When M0=OFF,JMPC instruction not execute,Network 3 INC instructionfrom busbar get electricity  ,each scan cycle use for  V2 increase 1.</p>
<p>     3. When M0=ON, JMPC instruction execution , jump to label1 back continue execution,by now V2 not increase 1.</p>
<h3 id="LBL_Jump_label">LBL(Jump label)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td>
                <p>  <img src="<?= $path_to_images ?>images/lbl-ld.gif"    /></p>
            </td>
            <td>
                <p><img src="<?= $path_to_images ?>images/lbl-fbd.gif"    /></p>
            </td>
            <td>
                <p> LBL   N</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/jmpc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> N</td>
            <td>
                <p>   Jump label  </p>
            </td>
            <td> v</td>
            <td> </td>
            <td> </td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     LBL instruction use for  define jump label, to <a href="#JMPC_Condition_jump">JMPC</a> instruction use .</p>
<h3 id="Special_Function_instruction">Special Function instruction</h3>
<hr>
<p>  Special function  instruction list as follows   </p>
<table>
    <thead>
        <tr>
            <td rowspan="2"> Instruction name</td>
            <td rowspan="2"> 8 bit model</td>
            <td rowspan="2"> 32 bit model</td>
            <td rowspan="2">  Instruction function</td>
            <td colspan="3">  Support language</td>
        </tr>
        <tr>
            <td> LD</td>
            <td> FBD</td>
            <td> IL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>  <a href="#GPWM_General_pulse_width_modulation">GPWM</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p>  General pulse width modulation</p>
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
            <td>  <a href="#FTC_Fuzzy_temperature_control">FTC</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Fuzzy temperature control</p>
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
            <td>  <a href="#PID_PID_control">PID</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> PID control</p>
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
            <td>  <a href="#HAL_D_HAL_Upper_limit_alarm">HAL</a></td>
            <td> ?</td>
            <td>
                <p> D.HAL</p>
            </td>
            <td>
                <p> Upper limit alarm</p>
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
            <td>  <a href="#LAL_D_LAL_Lower_limit_alarm">LAL</a></td>
            <td> ?</td>
            <td>
                <p> D.LAL</p>
            </td>
            <td>
                <p> Lower limit alarm</p>
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
            <td>  <a href="#LIM_D_LIM_Range_limitation">LIM</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.LIM</p>
            </td>
            <td>
                <p> Range limitation</p>
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
            <td>  <a href="#SC_D_SC_Linear_conversion">SC</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.SC</p>
            </td>
            <td>
                <p>  Linear conversion</p>
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
            <td>  <a href="#VC_Valve_control">VC</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Valve control</p>
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
            <td>  <a href="#TTC_Temperature_curve_control">TTC</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Temperature curve control</p>
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
            <td>  <a href="#APID_Self_tuning_PID_control">APID</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Self-tuning PID</p>
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
<h3 id="GPWM_General_pulse_width_modulation">GPWM(General pulse width modulation)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/gpwm.gif"    /></p>
            </td>
            <td>
                <p> GPWM  En, PulR, PulT,  Out</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/gpwm.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p> Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> PulR</td>
            <td>
                <p> Pulse duty factor  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>   Unit  0.1%, range 0~1000 </td>
        </tr>
        <tr>
            <td> PulT</td>
            <td>
                <p> Pulse output period</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>  Unit  ms</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Pulse width modulation output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. GPWM instruction use for common transistor output point Yn output pulse which variable pulse period . duty facto.</p>
<p>     2. Maximum pulse period is 32767, when PulT?0 not output pulse.</p>
<p>     3. When PulT&gt;0, if PulR&gt;0 moreover PulR&lt;1000 ,Out output pulse of duty factor is PulR. period is PulT, if PulR=0 then Out output low level, if PulR?1000 then Out output high level singal. </p>
<p>     4. PulR. PulT value cn be modified real time.</p>
<p>  [Instruction example] </p>
<p>  <img src="<?= $path_to_images ?>images/gpc-gpwm.gif"    /></p>
<p> [Program description]</p>
<p>     1. When M0=ON, from Y20 output the pulse which duty factor is 30%. period is 30ms.</p>
<p>     2. When M0=OFF, pulse output stop.</p>
<h3 id="FTC_Fuzzy_temperature_control">FTC(Fuzzy temperature control)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/ftc.gif"    /></p>
            </td>
            <td>
                <p> FTC  En, PV, SV, Out, MV</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/ftc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> PV</td>
            <td>
                <p>  Measure value  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit  0.1?</td>
        </tr>
        <tr>
            <td> SV</td>
            <td>
                <p>  Set value</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit  0.1?</td>
        </tr>
        <tr>
            <td> Act</td>
            <td>
                <p>  Control mode  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 0-reaction,1-direct action, others invalid.</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p>  Pulse width modulation output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> MV</td>
            <td>
                <p>   Control output</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. FTC instruction use for fuzzy temperature control special purpose instruction, the instruction need not set any parameter completely automatic regulate output ,simpleness use . </p>
<p>     2. Act is  control mode,Act=0 is reaction(PV increase ,MV output trend decrease, normal use for heat control),Act=1 is  direct action(PV increase,MV output trend increase,normal use for cool control). </p>
<p>     3. Instruction have 2 output mode, Out pulse width modulation output(frequency 1Hz),MV is control output( range 0~1000).</p>
<p>     4. En is instruction enable item , when En=ON  instruction execute ;When En=OFF  instruction stop execute ,Out=OFF,MV=0.</p>
<p>      5. Many external factor will influence temperature control effective , such as: sensor accuracy . sensor install position . heat function  big or small etc., if FTC temperature control effective unsatisfactory ,may be use <a href="#PID_PID_control">PID</a> or program experience control arithmetic oneself .</p>
<p>      [Note]: When the FTC instruction first run, it will automatically control the output Out=On, MV=1000, this process is used to calculate the fuzzy factor, and should be used when PV is in room temperature,and the calculation process will take less than 1.5 minutes. The calculated fuzzy coefficients will be stored in the instruction, and it wil not be lost when the plc is shut down. If the program is re-downloaded,then the FTC instruction which is again in the first run will automatically calculate the fuzzy factor.</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-ftc.gif"    /></p>
<p> [Program description]</p>
<p>     When M0=ON,FTC instruction execute, according to deviation of AI0 and V1000 use fuzzy control arithmetic to control output .When M0=OFF, then Y3=OFF,V100=0.</p>
<h3 id="PID_PID_control">PID(PID control)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/pid.gif"    /></p>
            </td>
            <td>
                <p> PID  En, Act, PV, SV, P, I, D, T, Span, PVH, PVL, MVH, MVL, MV</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/pid.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
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
                <p>  Control mode  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 0-reaction,1-direct action, others invalid.</td>
        </tr>
        <tr>
            <td> PV</td>
            <td>
                <p>  Measure value  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> SV</td>
            <td>
                <p>  Set value</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> P</td>
            <td>
                <p>  Proportionnality coefficient</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>  Unit  %</td>
        </tr>
        <tr>
            <td> I</td>
            <td>
                <p> Integral time</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit  10ms</td>
        </tr>
        <tr>
            <td> D</td>
            <td>
                <p> Derivative time</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit  10ms</td>
        </tr>
        <tr>
            <td> T</td>
            <td>
                <p>  Sampling period</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit  10ms</td>
        </tr>
        <tr>
            <td> Span</td>
            <td>
                <p> Dead band  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> PVH</td>
            <td>
                <p> PV measuring upper limit</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> PVL</td>
            <td>
                <p> PV measuring lower limit</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> MVH</td>
            <td>
                <p>  MV measuring upper limit</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> MVL</td>
            <td>
                <p>  MV measuring lower limit  </p>
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
                <p> Enable output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> MV</td>
            <td>
                <p>   Control output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. Act is  control mode,Act=0 is reaction(PV increase ,MV output trend decrease, normal use for heat control),Act=1 is  direct action(PV increase,MV output trend increase,normal use for cool control). </p>
<p>     2. En is instruction enable item, when En=ON  instruction execute; When En=OFF instruction stop execute ,MV=0.</p>
<p>      3. Many external factor will influence temperature control effective   ,need time and again adjust P. I. D these 3 parameters to meet the control object, also can program experience control arithmetic oneself .</p>
<p>     4. P. I. D parameters direct influence  reality control effective stand and fail  , below are the three parameters function in PID control :</p>
<ul>
    <li>
        <p> Proportionnality coefficient (P) regulating effect : is a percentage data. is response system deviation in proportion ,system in case of appear deviation, proportional control immediately generate  regulating effect  to reduce deviation. Proportional action big ,may be accelerate regulate, reduce deviation, but oversize proportion , make system stability descend , even cause system unstable.</p>
    </li>
    <li>
        <p>  Integral time (I) regulating effect : make system eliminate steady state error, improve indifference .Because have error , integral control as for as proceed, until have not error, integral control  stop , integral control output a constant .Integral functional strong and weak depend on integral time I,I big ,integral functional  stronger, regulate response slower .Otherwise I small  then integral functional   weaker, regulate response faster, add integral control  make  system stability descend, dynamic response slower .Integral functional common use with others two regulating mode combine, make up PI  regulator or PID regulator .When Integral time set to 0, no integral.</p>
    </li>
    <li>
        <p> Derivative time (D) regulating effect : differential functional reflect system deviation signal rate of change , have foreseeability , can foresee deviation change trend , so can generate ahead of control function, before deviation not yet production , already be differential regulating effect eliminate. thus, may be improve system dynamic response . At  derivative time suitable selected , may be reduce overshoot, reduce regulating time. Differential functional  amplified action the noise interference , that is the overflow differential functional  ,harmful to system anti-interference .Moreover ,differential corresponsive rate of change, when Input unchanged, differential functional output is zero. differential functional can not alone used , must use with others two regulating mode combine, make up PI  regulator or PID regulator .When   derivative time set to 0, no iderivative. </p>
    </li>
</ul>
<p>     5. Incremental PID arithmetic  :</p>
<p>          ?u(n) = Kp *  ?e(n) + Ki * e(n) + Kd (?e(n) -  ?e(n-1) ) )</p>
<p>                 = Kp *  ?e(n) + Ki * e(n) + Kd * (e(n) ?2 * e(n-1) + e(n-2))</p>
<p>             u(n) = u(n-1) +  ?u(n)  reaction</p>
<p>             u(n) = u(n-1) -  ?u(n)  direct action</p>
<p>         Among:u(n):MV Output </p>
<p>                     u(n-1):last output</p>
<p>                     ?u(n): output incremental</p>
<p>                     Kp=P / 100:proportionnality coefficient </p>
<p>                     Ki=Kp * T / I: integral coefficient </p>
<p>                     Kd=D / T: derivative coefficient </p>
<p>                     e(n)=(SV - PV): deviation</p>
<p>                     e(n-1):last deviation</p>
<p>                     e(n-2):last last deviation</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-pid.gif"    /></p>
<p> [Program description]</p>
<p>     1. When M0=ON,PID instruction execute, according to AI0 and V1000  deviation get through PID arithmetic  Control output.When M0=OFF, instruction not execute,AQ0=0.</p>
<p>     2. If need use for PID instruction analog output turn into digital duty factor output, use GPWM instruction ,PulT=5000 express pulse period 5 second, Note PID instruction MV output range setup to 0~1000. </p>
<h3 id="HAL_D_HAL_Upper_limit_alarm">HAL. D.HAL(Upper limit alarm)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/hal.gif"    /> <img src="<?= $path_to_images ?>images/d.hal.gif"    /></p>
            </td>
            <td>
                <p> HAL  En, In, Up, Span, Out</p>
                <p> D.HAL  En, In, Up, Span, Out</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/hal.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> In</td>
            <td>
                <p> Input  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Up</td>
            <td>
                <p>  Upper limit alarm value    </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Span</td>
            <td>
                <p>   Dead band   </p>
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
                <p>   Status  output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     HAL instruction is upper limit alarm instruction. If In&gt;(Up+Span), then Out=ON; If In&lt;(Up-Span), then Out=OFF, when In and Up deviation value  less than equal to dead band  value  span,Out remain unchanged.</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-hal.gif"    /></p>
<p> [Program description]</p>
<p>     When M0=ON start   upper limit alarm function .If AI0 is temperature measure value  ,V1000=3000(300?,V1001=20(2? , when AI0&gt;3020(302? Y3=ON; When AI0&lt;2980(298? Y3=OFF. </p>
<h3 id="LAL_D_LAL_Lower_limit_alarm">LAL. D.LAL(Lower limit alarm)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/lal.gif"    /> <img src="<?= $path_to_images ?>images/d.lal.gif"    /></p>
            </td>
            <td>
                <p> LAL  En, In, Down, Span, Out</p>
                <p> D.LAL  En, In, Down, Span, Out</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/lal.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> In</td>
            <td>
                <p> Input  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Down</td>
            <td>
                <p>  Lower limit alarm value    </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Span</td>
            <td>
                <p>   Dead band   </p>
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
                <p>   Status  output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     LAL instruction is lower limit alarm instruction. If In&lt;(Down-Span), then Out=ON; If In&gt;(Down+Span), then Out=OFF, when In and Down deviation value  less than equal to dead band  value  span,Out remain unchanged.</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-lal.gif"    /></p>
<p> [Program description]</p>
<p>     When M0=ON start lower limit alarm function .If AI0 is temperature measure value   ,V1000=300(30?,V1001=20(2? , when AI0&lt;280(28? Y3=ON; When AI0&gt;320(32? Y3=OFF. </p>
<h3 id="LIM_D_LIM_Range_limitation">LIM. D.LIM(Range limitation)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/lim.gif"    /> <img src="<?= $path_to_images ?>images/d.lim.gif"    /></p>
            </td>
            <td>
                <p> LIM  En, In, Up, Down, Out</p>
                <p> D.LIM  En, In, Up, Down, Out</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/lim.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> In</td>
            <td>
                <p> Input</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Up</td>
            <td>
                <p> Upper limit  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Down</td>
            <td>
                <p>  Lower limit  </p>
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
                <p> Enable output  </p>
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
                <p>   Output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. LIM is range limitation instruction, if In&gt;Up then Out=Up, if Down?In?Up then Out=In, if In&lt;Down then Out=Down. </p>
<p>     2. if Up?Down, then the instruction not execute.</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-lim.gif"    /></p>
<p> [Program description]</p>
<p>     When M0=ON start range limitation. If V1000=800,V1001=20, when V0&lt;20 AQ0=20;When V0&gt;800 AQ0=800, when 20?V0?800 AQ0=V0. </p>
<h3 id="SC_D_SC_Linear_conversion">SC. D.SC(Linear conversion)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/sc.gif"    /> <img src="<?= $path_to_images ?>images/d.sc.gif"    /></p>
            </td>
            <td>
                <p> SC  En, In, InUp, InDown, OutUp, OutDown, Out</p>
                <p> D.SC  En, In, InUp, InDown, OutUp, OutDown, Out</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/sc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> In</td>
            <td>
                <p> Input  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> InUp</td>
            <td>
                <p> Input upper limit </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> InDown</td>
            <td>
                <p>  Input lower limit  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> OutUp</td>
            <td>
                <p>  Output upper limit   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> OutDown</td>
            <td>
                <p>  Output lower limit  </p>
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
                <p> Enable output  </p>
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
                <p>   Transfer output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. SC instruction according to input. output bound In input proceed linear conversion transfer output to out. </p>
<p>     2. Linear conversion formula : out = (In - InDown) * (OutUp-  OutDown) / (InUp- InDown) +  OutDown.</p>
<p>     3. if InUp=InDown, then the instruction not execute.</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-sc.gif"    /></p>
<p> [Program description]</p>
<p>     When M0=ON, SC V0 transfer output to V10,as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong> component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value</strong></p>
            </td>
            <td>
                <p> <strong>Transfer result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>  V1000</p>
            </td>
            <td> 32000</td>
            <td rowspan="4">
                <p> When V0=0, then V10 =1000</p>
                <p> When V0=100, then V10 =1012</p>
                <p> When V0=12000, then V10 =2500</p>
                <p> When V0=28000, then V10 =4500</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>  V1001</p>
            </td>
            <td> 0</td>
        </tr>
        <tr>
            <td>
                <p>  V1002</p>
            </td>
            <td> 5000</td>
        </tr>
        <tr>
            <td>
                <p>  V1003</p>
            </td>
            <td> 0</td>
        </tr>
    </tbody>
</table>
<h3 id="VC_Valve_control">VC(Valve control)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/vc.gif"    /></p>
            </td>
            <td>
                <p> VC  En, OLim, CLim, JOG, PV, SV, Span, Ts, Open, Close</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/vc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> OLim</td>
            <td>
                <p>  Valve open limit   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> CLim</td>
            <td>
                <p>  Valve close limit</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> JOG</td>
            <td>
                <p>  Valve jog</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> PV</td>
            <td>
                <p> Measure value</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> SV</td>
            <td>
                <p>Set value</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Span</td>
            <td>
                <p>Dead band </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Ts</td>
            <td>
                <p> Motor  running time</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit  ?</td>
        </tr>
        <tr>
            <td> Open</td>
            <td>
                <p> Valve open output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Close</td>
            <td>
                <p>   Valve close  output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. VC is specific to valve control special purpose instruction, like one valve controler. </p>
<p>     2. En is instruction enable item , when En=ON  instruction execute, when En=OFF instruction stop working,Open=OFF,Close=OFF. </p>
<p>     3. VC instruction according to valve current opening PV and valve set opening SV compare, if both difference value  greater than dead band span, then action to Valve control output (open or close), each the motor running time longest is Ts(second). </p>
<p>     4. Open valve open control:when (SV - PV)&gt; Span ,Open=ON valve open output; When (SV - PV)? Span ,Open=OFF valve open stop .In control valve process, if valve open limit Olim=ON ,Open=OFF. </p>
<p>     5. Close valve close control:when (PV - SV)&gt; Span ,Close=ON valve close output; When (PV - SV)? Span ,Close=OFF valve close stop .In control valve process, if valve close limit  Clim=ON,Close=OFF. </p>
<p>     6. Valve jog control:when JOG from OFF go to ON, use for according to SV. PV. Span three current value make out open or close the valve( control according to and on-off control the same as), each jogthe motor running time longest is Ts(second). </p>
<p>  7. If Ts&gt;0,valve guard time valid ,In Ts valve not reach the preset position (Set value), on-off action stop , in case valve appear mechanical error and yet damage the motor which running time too long. </p>
<p>     8. If  Ts=0, express time-out output, note the valve lose protect function .</p>
<p>     9. If  Span&lt;0 or Ts&lt;0, then  instruction not execute.</p>
<p>     10. If  valve without limit protection output,Olim. Clim may be use SM1 input, express not use limit protect function .</p>
<p>     11. VC instruction can cooperate PID etc. instruction realize more complex control function .</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-vc.gif"    /></p>
<h3 id="TTC_Temperature_curve_control">TTC(Temperature curve control)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p>  <img src="<?= $path_to_images ?>images/ttc.gif"    /></p>
            </td>
            <td>
                <p> TTC  En, Begin, End, Ts, Act, Out, Val, Ct</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/ttc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Begin</td>
            <td>
                <p> Start point value  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> End</td>
            <td>
                <p> End point value  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Ts</td>
            <td>
                <p> Control time</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>  Ts&gt;0 unit  is second,Ts&lt;0 unit  is minute</td>
        </tr>
        <tr>
            <td> Act</td>
            <td>
                <p> Control  mode</p>
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
            <td> Out</td>
            <td>
                <p> Status  output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Val</td>
            <td>
                <p> Output value  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Ct</td>
            <td>
                <p> Current time  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>  unit  is second,occupy  2  continuous component</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. TTC instruction use for control data value in given time from start point  value  (Begin) to end point  value  (End) changing process, that is ratio control. </p>
<p>  2. Ts is control time,Ts&gt;0 unit  is second,Ts&lt;0 unit  is minute,Ts=0 then invalid instruction not execute, without unit  is second or minute instruction all each second arithmetic utput once.</p>
<p>     3. When Act=0 (restart mode), at  TTC instruction start  ,reset Out=OFF, then from Begin start timing control output Val.</p>
<p>     4. When  Act=1 (memory mode), at TTC instruction start  , reset Out=OFF moreover read current value Val, according the condition to execute of Val in Begin~End interzone.</p>
<p>                 1). Begin&lt;End (ascent stage), if  Val?Begin then from start point  value  (Begin) start timing control output Val; if Val?End then timing out ,Val invariant moreover Out=ON; if  Val at  Begin~End interzone then from Val start timing control output  Val.</p>
<p>                 2). Begin&gt;End (decline stage), if  Val?Begin then from Begin start timing control output  Val; if  Val?End then timing out ,Val invariant moreover Out=ON; if Val at Begin~Endinterzone then from Val start timing control output  Val.</p>
<p>                 3). Begin=End ( maintain stage), if  Val=Begin then from start point  value  (Begin) start timing control output Val; if Val?Begin then timing out ,Val invariant moreover Out=ON.</p>
<p>     5. Instruction in processing, parameters Begin. End. Ts can not be modified ( modified not take effect at real time, need re-execute the instruction).</p>
<p>     6. Use TTC instruction may be generate mulit-segment  curve, may be cooperate  PID etc. others instruction  realize more complex control function .</p>
<p>     7. At  Act=1(memory mode),Val output item should use preserv component .</p>
<p>  [Instruction example]</p>
<p>  <img src="<?= $path_to_images ?>images/gpc-ttc.gif"    /></p>
<p> [Program description]</p>
<p>     If "3 segment curve initial data" as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong> component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value</strong></p>
            </td>
            <td>
                <p> <strong>Output??</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>  V1000</p>
            </td>
            <td> 300</td>
            <td rowspan="9">  <img src="<?= $path_to_images ?>images/ttc-xu.gif"    /></td>
        </tr>
        <tr>
            <td>
                <p>  V1001</p>
            </td>
            <td> 1200</td>
        </tr>
        <tr>
            <td>
                <p>  V1002</p>
            </td>
            <td> -2</td>
        </tr>
        <tr>
            <td>
                <p>  V1003</p>
            </td>
            <td> 1200</td>
        </tr>
        <tr>
            <td>
                <p>  V1004</p>
            </td>
            <td> 1200</td>
        </tr>
        <tr>
            <td>
                <p>  V1005</p>
            </td>
            <td> 30</td>
        </tr>
        <tr>
            <td>
                <p>  V1006</p>
            </td>
            <td> 1200</td>
        </tr>
        <tr>
            <td>
                <p>  V1007</p>
            </td>
            <td> 300</td>
        </tr>
        <tr>
            <td>
                <p>  V1008</p>
            </td>
            <td> 60</td>
        </tr>
    </tbody>
</table>
<p>     1. When M10=ON, start first  segment curve , from 300 to 1200 take 2 minute, complete M27=ON.</p>
<p>     2. When M27=ON, start second segment curve ,from 1200to 1200 take30 second , complete M28=ON.</p>
<p>     3. When M28=ON, start third segment curve ,from 1200 to 300 take 60 second, complete M29=ON.</p>
<p>     4. When M29=ON,reset M10=OFF.</p>
<h3 id="APID_Self_tuning_PID_control">APID(Self-tuning PID control)</h3>
<p> Instruction format and parameter specification   </p>
<table>
    <thead>
        <tr>
            <td>  Language</td>
            <td> LD</td>
            <td>  FBD</td>
            <td>  IL</td>
            <td>  Program example</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/apid.gif"    /></p>
            </td>
            <td>
                <p> APID  En, Act, Start, PV, SV, P, I, D, MV</p>
            </td>
            <td>
                <p>  <a href="<?= $path_to_images ?>program/apid.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
            </td>
        </tr>
    </tbody>
</table>
<p> ?</p>
<table>
    <thead>
        <tr>
            <td>  Parameter</td>
            <td>  Parameter define</td>
            <td>  Input</td>
            <td>  Output</td>
            <td>  Declare</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> En</td>
            <td>
                <p>  Enable   </p>
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
                <p> Control mode </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 0-reaction,1-direct action, others invalid.</td>
        </tr>
        <tr>
            <td> Start</td>
            <td>
                <p>  Start Self-tuning</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> PV</td>
            <td>
                <p>  Measure value  </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> SV</td>
            <td>
                <p>  Set value</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> P</td>
            <td>
                <p>  Proportionnality coefficient</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>  Unit  %</td>
        </tr>
        <tr>
            <td> I</td>
            <td>
                <p> Integral time</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit  10ms</td>
        </tr>
        <tr>
            <td> D</td>
            <td>
                <p> Derivative time</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> Unit  10ms</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> MV</td>
            <td>
                <p>   Control output  </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p>  [Instruction function and effect declare] </p>
<p>     1. Act is  control mode,Act=0 is reaction(PV increase ,MV output trend decrease, normal use for heat control),Act=1 is  direct action(PV increase,MV output trend increase,normal use for cool control). </p>
<p>     2. En is instruction enable item, when En=ON  instruction execute; When En=OFF instruction stop execute ,MV=0.</p>
<p>      3. When Start=ON, it starts the auto-tuning, after the finishing of the self-tuning the instruction will automatically write the calculated P. I. D parameter value to the concerning register corresponding to the terminal. If the parameters obtained by the auto-tuning is not satisfactory, you can reactivate "Start" to carry out the auto-tuning again, or manually input the parameter. There is much external factors affecting the control effect, it's necessary to repeatedly adjust the P. I. D parameters to meet the requirements of the control object,besides, the experienced technican can also adjust the parameters themselves.</p>
<p>     4. P. I. D parameters direct influence  reality control effective stand and fail  , below are the three parameters function in PID control :</p>
<ul>
    <li>
        <p> Proportionnality coefficient (P) regulating effect : is a percentage data. is response system deviation in proportion ,system in case of appear deviation, proportional control immediately generate  regulating effect  to reduce deviation. Proportional action big ,may be accelerate regulate, reduce deviation, but oversize proportion , make system stability descend , even cause system unstable.</p>
    </li>
    <li>
        <p>  Integral time (I) regulating effect : make system eliminate steady state error, improve indifference .Because have error , integral control as for as proceed, until have not error, integral control  stop , integral control output a constant .Integral functional strong and weak depend on integral time I,I big ,integral functional  stronger, regulate response slower .Otherwise I small  then integral functional   weaker, regulate response faster, add integral control  make  system stability descend, dynamic response slower .Integral functional common use with others two regulating mode combine, make up PI  regulator or PID regulator .When Integral time set to 0, no integral.</p>
    </li>
    <li>
        <p> Derivative time (D) regulating effect : differential functional reflect system deviation signal rate of change , have foreseeability , can foresee deviation change trend , so can generate ahead of control function, before deviation not yet production , already be differential regulating effect eliminate. thus, may be improve system dynamic response . At  derivative time suitable selected , may be reduce overshoot, reduce regulating time. Differential functional  amplified action the noise interference , that is the overflow differential functional  ,harmful to system anti-interference .Moreover ,differential corresponsive rate of change, when Input unchanged, differential functional output is zero. differential functional can not alone used , must use with others two regulating mode combine, make up PI  regulator or PID regulator .When   derivative time set to 0, no iderivative. </p>
    </li>
</ul>
<p>     [Note]: Auto-tuning should be performed when PV is in the room temperature and the entire auto-tuning process takes less than 1.5 minutes. The PID coefficient obtained from the auto-tuning will be automatically written to the corresponding P?I?D terminals, so the P?I?D terminals of the instruction should use latched registers.</p>
<p>  [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-apid.gif"    /></p>
<p> [Program description]</p>
<p>     1. When M0=ON,APID instruction execute, according to AI0 and V1000  deviation get through APID arithmetic  Control output.When M0=OFF, instruction not execute,AQ0=0.</p>
<p>     2. If need use for APID instruction analog output turn into digital duty factor output, use GPWM instruction ,PulT=1000 express pulse period 1 second. </p>