<h3 id="Compare_instruction">Compare instruction</h3>
<hr>
<p> Compare instruction list as follows </p>
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
            <td> <a href="#CMP_D_CMP_Compare">CMP</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.CMP</p>
            </td>
            <td>
                <p> Compare instruction</p>
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
            <td> <a href="#ZCP_D_ZCP_Regional_comparison">ZCP</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.ZCP</p>
            </td>
            <td>
                <p> Regional comparison</p>
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
            <td> <a href="#MATC_D_MATC_Numerical_match">MATC</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.MATC</p>
            </td>
            <td>
                <p> Numerical value match</p>
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
            <td> <a href="#ABSC_D_ABSC_Absolute_cam_comparison">ABSC</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.ABSC</p>
            </td>
            <td>
                <p> Absolute cam comparison</p>
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
            <td> <a href="#BON_ON_bit_determine">BON</a></td>
            <td> ?</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> ON bit determine</p>
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
            <td> <a href="#BONC_D_BONC_ON_bit_numbers">BONC</a></td>
            <td> ?</td>
            <td> D.BONC</td>
            <td>
                <p> ON bit numbers</p>
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
            <td> <a href="#MAX_D_MAX_Maximum">MAX</a></td>
            <td> ?</td>
            <td>
                <p> D.MAX</p>
            </td>
            <td>
                <p> Maximum</p>
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
            <td> <a href="#MIN_D_MIN_Minimum">MIN</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.MIN</p>
            </td>
            <td>
                <p> Minimum</p>
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
            <td> <a href="#SEL_D_SEL_Selection_of_conditions">SEL</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.SEL</p>
            </td>
            <td>
                <p> Selection of conditions</p>
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
            <td> <a href="#MUX_D_MUX_Multi_choice">MUX</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> D.MUX</p>
            </td>
            <td>
                <p> Multi-choice</p>
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
<h3 id="CMP_D_CMP_Compare">CMP. D.CMP(Compare)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/cmp.gif"    /> <img src="<?= $path_to_images ?>images/d.cmp.gif"    /></p>
            </td>
            <td>
                <p> CMP En, In1, In2, Out</p>
                <p> D.CMP En, In1, In2, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/cmp.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In1</td>
            <td>
                <p> Input1 </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> In2</td>
            <td>
                <p> Input2 </p>
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
            <td> Occupy 3 continuous component</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> CMP is 16 bit integer compare instruction (D.CMP is 32 bit integer compare), at the same time output&gt;. =. &lt; these 3 result.</p>
<p> [Instruction example] </p>
<p> <img src="<?= $path_to_images ?>images/gpc-cmp.gif"    /></p>
<p> [Program description]</p>
<p> 1. 16 bit compare CMP instruction, when AI1&gt;500 then M10=ON, when AI1=500 then M11=ON, when AI1&lt;500 then M12=ON.</p>
<p> 2. 32 bit compare D.CMP instruction, when V10V11&gt;V0V1 then M20=ON, when V10V11=V0V1 then M21=ON, when V10V11&lt;V0V1 then M22=ON.</p>
<h3 id="ZCP_D_ZCP_Regional_comparison">ZCP. D.ZCP(Regional comparison)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/zcp.gif"    /> <img src="<?= $path_to_images ?>images/d.zcp.gif"    /></p>
            </td>
            <td>
                <p> ZCP En, In, Up, Down, Out</p>
                <p> D.ZCP En, In, Up, Down, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/zcp.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Input </p>
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
                <p> Regional upper limit</p>
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
                <p> Regional lower limit</p>
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
            <td> Occupy 3 continuous component</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. ZCP is 16 bit integer regional compare instruction(D.CMP is 32 bit integer regional compare ),at the same time output &gt;. =. &lt; these 3 result.</p>
<p> 2. If regional upper limit Up &lt; regional lower limit Down, then instruction will swap them automatic . </p>
<p> [Instruction example] </p>
<p> <img src="<?= $path_to_images ?>images/gpc-zcp.gif"    /></p>
<p> [Program description]</p>
<p> 1. 16 bit compare ZCP instruction , when AI1&gt;3000 then M10=ON, when AI1?3000 moreover AI1?500 then M11=ON, when AI1&lt;500 then M12=ON.</p>
<p> 2. 32 bit compare D.ZCP instruction, when V0V1&gt;V1000V1001 then M20=ON, when V0V1?V1000V1001 moreover V0V1?V1002V1003 then M21=ON, when V0V1</p>
<h3 id="MATC_D_MATC_Numerical_match">MATC. D.MATC(Numerical match)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/matc.gif"    /> <img src="<?= $path_to_images ?>images/d.matc.gif"    /></p>
            </td>
            <td>
                <p> MATC En, In, Par, N, Out</p>
                <p> D.MATC En, In, Par, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/matc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> In</td>
            <td>
                <p> Input </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> Par</td>
            <td>
                <p> Numerical value match start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> MATC: occupy N continuous component, D.MATC: occupy 2N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number to compare </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> 1~256</p>
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
                <p>?</p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> MATC instruction compare In input and N data start from Par ,if In equal to one of then express match right Out=ON, no then Out=OFF. </p>
<p> [Instruction example] </p>
<p> <img src="<?= $path_to_images ?>images/gpc-matc.gif"    /></p>
<p> [Program description]</p>
<p> 1. MATC instruction get electricity from busbar and always execute .</p>
<p> 2. As long as V0 equal to one of V1000. V1001. V1002. V1003. V1004. V1005 then match right M0=ON, no then M0=OFF.</p>
<h3 id="ABSC_D_ABSC_Absolute_cam_comparison">ABSC. D.ABSC(Absolute cam comparison)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/absc.gif"    /> <img src="<?= $path_to_images ?>images/d.absc.gif"    /></p>
            </td>
            <td>
                <p> ABSC En, In, Par, N, Out</p>
                <p> D.ABSC En, In, Par, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/absc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> In</td>
            <td>
                <p> Input </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> Par</td>
            <td>
                <p> Multi-segment compare start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> ABSC: occupy 2N continuous component ,D.ABSC: occupy 4 continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of compare segments </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> 1-64 </p>
            </td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Start address of compare result </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. ABSC instruction region compare In input N segment data start from Par ,compare results output to start from out N continuous component. </p>
<p> 2. To the segment which lower limit ? upper limit , if lower limit?In? upper limit, then compare result of the segment Output=ON, if Inupper limit, then compare result of the segment Output =OFF.</p>
<p> 3. To the segment which lower limit&gt;upper limit,if upper limit?In? lower limit, then compare result of the segment Output=OFF, if In&gt;lower limit or In compare result of the segment Output=ON.</p>
<p> 4. Parameter Par and N relation declare: </p>
<table>
    <thead>
        <tr>
            <td>
                <p> Number </p>
            </td>
            <td>
                <p> <strong>Number of compare segments N </strong></p>
            </td>
            <td>
                <p> <strong>Par component meaning </strong></p>
            </td>
            <td>
                <p> <strong>Out</strong> <strong>component meaning </strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> 1 </td>
            <td rowspan="2">
                <p> 1 </p>
            </td>
            <td>
                <p> 1 segment lower limit </p>
            </td>
            <td rowspan="2">
                <p> 1 segment compare result output </p>
            </td>
        </tr>
        <tr>
            <td> 2 </td>
            <td>
                <p> 1 segment upper limit </p>
            </td>
        </tr>
        <tr>
            <td> 3 </td>
            <td rowspan="2">
                <p> 2 </p>
            </td>
            <td>
                <p> 2 segment lower limit </p>
            </td>
            <td rowspan="2">
                <p> 2 segment compare result output </p>
            </td>
        </tr>
        <tr>
            <td> 4 </td>
            <td>
                <p> 2 segment upper limit </p>
            </td>
        </tr>
        <tr>
            <td> ? </td>
            <td>
                <p> ?o:p&gt; </p>
            </td>
            <td>
                <p> ?o:p&gt; </p>
            </td>
            <td>
                <p> ?o:p&gt; </p>
            </td>
        </tr>
        <tr>
            <td> 15 </td>
            <td rowspan="2">
                <p> 8 </p>
            </td>
            <td>
                <p> 8 segment lower limit </p>
            </td>
            <td rowspan="2">
                <p> 8 segment compare result output </p>
            </td>
        </tr>
        <tr>
            <td> 16 </td>
            <td>
                <p> 8 segment upper limit </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction example] </p>
<p> <img src="<?= $path_to_images ?>images/gpc-absc.gif"    /></p>
<p> [Program sketch map]</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Par component </strong></p>
            </td>
            <td>
                <p> Value </p>
            </td>
            <td>
                <p> Declare </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 40 </p>
            </td>
            <td>
                <p>1 segment lower limit</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 100 </p>
            </td>
            <td> 1 segment upper limit</td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 120 </p>
            </td>
            <td> 2 segment lower limit</td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 210 </p>
            </td>
            <td> 2 segment upper limit</td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 140 </p>
            </td>
            <td> 3 segment lower limit</td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> 60 </p>
            </td>
            <td> 3 segment upper limit</td>
        </tr>
        <tr>
            <td>
                <p> V1006 </p>
            </td>
            <td>
                <p> 150 </p>
            </td>
            <td> 4 segment lower limit</td>
        </tr>
        <tr>
            <td>
                <p> V1007</p>
            </td>
            <td>
                <p> 390 </p>
            </td>
            <td>
                <p>4segment upper limit</p>
            </td>
        </tr>
    </tbody>
</table>
<p> <img src="<?= $path_to_images ?>images/absc-xu.gif"    /></p>
<p> [Program description]</p>
<p> 1. M0=ON,region compare V0 and start from V1000 4 segment.</p>
<p> 2. When V0 is 40~100,Y0=ON, no then Y0=OFF; when V0 is 120~210 ,Y1=ON, no then Y1=OFF; when V0 is 60~140 ,Y2=OFF, wo then Y2=ON; when V0 is 150~390,Y3=ON, no then Y3=OFF.</p>
<p> 3. When M0=OFF, instruction stop execute ,Y0~Y3 remain unchanged.</p>
<h3 id="BON_ON_bit_determine">BON(ON bit determine)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bon.gif"    /> </p>
            </td>
            <td>
                <p> BON En, In, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bon.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> In</td>
            <td>
                <p> Input </p>
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
                <p> Which bit</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~16</td>
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
<p> BON instruction use to determine the bit of the register whether or not 1,result output to Out.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bon.gif"    /></p>
<p> [Program description]</p>
<p> 1. BON instruction get electricity from busbar and always execute </p>
<p> 2. If V0=8( binary 00000000 00001000, fourth bit is 1), then M0=ON.</p>
<h3 id="BONC_D_BONC_ON_bit_numbers">BONC. D.BONC(ON bit numbers)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/bonc.gif"    /> <img src="<?= $path_to_images ?>images/d.bonc.gif"    /></p>
            </td>
            <td>
                <p> BONC En, In, Out</p>
                <p> D.BONC En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bonc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Input </p>
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
                <p> Output </p>
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
<p> BONC instruction get the number which the bit is 1 of the register, result output to Out.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bonc.gif"    /></p>
<p> [Program description]</p>
<p> 1. BONC instruction get electricity from busbar and always execute</p>
<p> 2. If V0=1234(binary 00000100 11010010, total 5 bits are 1),then V100=5.</p>
<h3 id="MAX_D_MAX_Maximum">MAX. D.MAX(Maximum)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/max.gif"    /> <img src="<?= $path_to_images ?>images/d.max.gif"    /></p>
            </td>
            <td>
                <p> MAX En, Par, N, Out</p>
                <p> D.MAX En, Par, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/max.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> Par</td>
            <td>
                <p> Compare value start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> MAX: occupy N continuous component, D.MAX: occupy 2N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number data for compare</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 2~256</td>
        </tr>
        <tr>
            <td> Eno</td>
            <td>
                <p> Enable output </p>
            </td>
            <td> ?</td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Compare result output </p>
            </td>
            <td> </td>
            <td> v</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> MAX instruction compare N data start from Par ,maximum output to Out. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-max.gif"    /></p>
<p> [Program description]</p>
<p> 1. M0=ON, if V1000=30. V1001=-150. V1002=25. V1003=8. V1004=95. V1005=-20, then V0=95.</p>
<p> 2. M0=ON, if V1100V1101=30000. V1102V1103=-50000. V1104V1105=23000. V1106V1107=600. V1108V1109=1500, then V10V11=30000.</p>
<p> 3. When M0=OFF, instruction stop execute ,Out remain unchanged.</p>
<h3 id="MIN_D_MIN_Minimum">MIN. D.MIN(Minimum)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/min.gif"    /> <img src="<?= $path_to_images ?>images/d.min.gif"    /></p>
            </td>
            <td>
                <p> MIN En, Par, N, Out</p>
                <p> D.MIN En, Par, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/min.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> Par</td>
            <td>
                <p> Compare value start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> MIN: occupy N continuous component, D.MIN: occupy 2N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number data for compare</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 2~256</td>
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
                <p> Compare result output </p>
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
<p> MIN instruction compare N data start from Par ,minimum output to Out. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-min.gif"    /></p>
<p> [Program description]</p>
<p> 1. M0=ON, if V1000=30. V1001=-150. V1002=25. V1003=8. V1004=95. V1005=-20, then V0=-150.</p>
<p> 2. M0=ON, if V1100V1101=30000. V1102V1103=-50000. V1104V1105=23000. V1106V1107=600. V1108V1109=1500, then V10V11=-50000.</p>
<p> 3. When M0=OFF, instruction stop execute ,Out remain unchanged.</p>
<h3 id="SEL_D_SEL_Selection_of_conditions">SEL. D.SEL(Selection of conditions)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/sel.gif"    /> <img src="<?= $path_to_images ?>images/d.sel.gif"    /></p>
            </td>
            <td>
                <p> SEL En, G, In1, In2, Out</p>
                <p> D.SEL En, G, In1, In2, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/sel.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> G</td>
            <td>
                <p> selection condition </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> In1</td>
            <td>
                <p> select data 1 </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> In2</td>
            <td>
                <p> select data 2 </p>
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
                <p> Select result output </p>
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
<p> SEL instruction is either-or instruction, G=OFF then Out=In1,G=ON then Out=In2. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-sel.gif"    /></p>
<p> [Program description]</p>
<p> 1. SEL instruction get electricity from busbar and always execute.</p>
<p> 2. If AI0=230. AI1=512, M0=OFF then V0=230,M0=ON then V0=512.</p>
<h3 id="MUX_D_MUX_Multi_choice">MUX. D.MUX(Multi-choice)</h3>
<p>Instruction format and parameter specification</p>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/mux.gif"    /> <img src="<?= $path_to_images ?>images/d.mux.gif"    /></p>
            </td>
            <td>
                <p> MUX En, K, Par, N, Out</p>
                <p> D.MUX En, K, Par, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/mux.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> K</td>
            <td>
                <p> Select channel </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Par</td>
            <td>
                <p> Select data start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> MUX: occupy N continuous component ,D.MUX: occupy 2N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of data be selected </p>
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
                <p> Select result o utput </p>
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
<p> MUX instruction select one of data according to the value of select channel K(K=0~N-1) from N address continuous register output to Out (multi select one). schematic diagram as follows: </p>
<p> <img src="<?= $path_to_images ?>images/mux-xu.gif"    /> </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-mux.gif"    /></p>
<p> [Program description]</p>
<p> 1. MUX instruction get electricity from busbar and always execute.</p>
<p> 2. If V1000=30. V1001=-150. V1002=25. V1003=8. V1004=95. V1005=-20, when V00=3 express select fourth value output,V10=8.</p>
<h2 id="Shift_instruction">Shift instruction</h2>
<hr>
<p> Shift instruction list as follows </p>
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
            <td> <a href="#LBST_Low_byte_evaluation">LBST</a></td>
            <td>
                <p> ?</p>
            </td>
            <td> ?</td>
            <td> Low byte evaluation</td>
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
            <td> <a href="#HBST_High_byte_evaluation">HBST</a></td>
            <td> ?</td>
            <td> ?</td>
            <td> High byte evaluation</td>
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
            <td> <a href="#MOV_D_MOV_Move">MOV</a></td>
            <td> ?</td>
            <td>
                <p> D.MOV</p>
            </td>
            <td>
                <p> Move</p>
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
            <td> <a href="#BMOV_Block_move">BMOV</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Block move</p>
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
            <td> <a href="#FILL_Fill">FILL</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Fill</p>
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
            <td> <a href="#XCH_Byte_swap_D_XCH_Register_swap">XCH</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Byte swap</p>
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
            <td> <a href="#BXCH_Block_swap">BXCH</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Block swap</p>
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
            <td> <a href="#SHL_Bit_left_shift">SHL</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Bit left shift</p>
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
            <td> <a href="#SHR_Bit_right_shift">SHR</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Bit right shift</p>
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
            <td> <a href="#WSHL_Word_left_shift">WSHL</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Word left shift</p>
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
            <td> <a href="#WSHR_Word_right_shift">WSHR</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Word right shift</p>
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
            <td> <a href="#ROL_Bit_rotate_left_shift">ROL</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Bit rotate left shift</p>
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
            <td> <a href="#ROR_Bit_rotate_right_shift">ROR</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Bit rotate right shift</p>
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
            <td> <a href="#WROL_Word_rotate_left_shift">WROL</a></td>
            <td> ?</td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Word rotate left shift</p>
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
            <td> <a href="#WROR_Word_rotate_right_shift">WROR</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Word rotate right shift</p>
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
            <td> <a href="#BSHL_Byte_left_shift">BSHL</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Byte left shift</p>
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
            <td> <a href="#BSHR_Byte_right_shift">BSHR</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Byte right shift</p>
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
            <td> <a href="#ATBL_Append_to_array">ATBL</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Append to array</p>
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
            <td> <a href="#FIFO_First_in_first_out">FIFO</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> First in first out</p>
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
            <td> <a href="#LIFO_Last_in_first_out">LIFO</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Last in first out</p>
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
            <td> <a href="#SORT_Data_sort">SORT</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Data sort</p>
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
<h3 id="LBST_Low_byte_evaluation">LBST(Low byte evaluation)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/lbst.gif"    /></p>
            </td>
            <td>
                <p> LBST En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/lbst_hbst.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Input </p>
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
                <p> Data output </p>
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
<p> LBST use for specified assignment to the low byte of output register Out , high byte remain unchanged.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-lbst.gif"    /></p>
<p> [Program description]</p>
<p> If initial V1000=0x1E34,then M0=ON V1000=0x1E0C.</p>
<h3 id="HBST_High_byte_evaluation">HBST(High byte evaluation)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/hbst.gif"    /></p>
            </td>
            <td>
                <p> HBST En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/lbst_hbst.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Input </p>
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
                <p> Data output </p>
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
<p> HBST use for specified assignment to the high byte of output register Out , low byte remain unchanged.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-hbst.gif"    /></p>
<p> [Program description]</p>
<p> If initial V1001=0xFF6A,then M1=ON V1001=0x856A</p>
<h3 id="MOV_D_MOV_Move">MOV. D.MOV(Move)</h3>
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
                <p> 16. 32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/mov.gif"    /> <img src="<?= $path_to_images ?>images/d.mov.gif"    /></p>
            </td>
            <td>
                <p> MOV En, In, Out</p>
                <p> D.MOV En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/mov.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Input </p>
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
                <p> DataOutput </p>
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
<p> Move instruction MOV also call assign instruction, use for assign the specified data to output register Out.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-mov.gif"    /></p>
<p> [Program description]</p>
<p> Assign the initial value will the program first scan cycle,V0=80,V10V11=-50.</p>
<h3 id="BMOV_Block_move">BMOV(Block move)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bmov.gif"    /></p>
            </td>
            <td>
                <p> BMOV En, Sou, N, Des</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bmov.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Block move start address component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number to be moved </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> 1~256</p>
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
        <tr>
            <td> Des</td>
            <td>
                <p> Target block move start address component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> BMOV block move instruction move N components start from Sou to N components start Des .As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/bmov-xu.gif"    /> </p>
</div>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bmov.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, Move V1000~V1005 to V0~V5, Move X0~X4 to Y2~Y6.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component </strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Move result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30 </p>
            </td>
            <td>
                <p> V0=30 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150 </p>
            </td>
            <td>
                <p> V1=-150 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 </p>
            </td>
            <td>
                <p> V2=25 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8 </p>
            </td>
            <td>
                <p> V3=8 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 </p>
            </td>
            <td>
                <p> V4=95 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20 </p>
            </td>
            <td>
                <p> V5=-20 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X0 </p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> Y2=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X1</p>
            </td>
            <td>
                <p> OFF </p>
            </td>
            <td>
                <p> Y3=OFF </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X2</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> Y4=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X3</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> Y5=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X4</p>
            </td>
            <td>
                <p> OFF </p>
            </td>
            <td>
                <p> Y6=OFF </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="FILL_Fill">FILL(Fill)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/fill.gif"    /></p>
            </td>
            <td>
                <p> FILL En, In, N, Des</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/fill.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Data to fill </p>
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
                <p> Number of fill data </p>
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
            <td> Des</td>
            <td>
                <p> Move target block start component </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> Fill instruction FILL use for fill the In value into Des start N component.Can use for batch reset . set register component and bit component.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/fill-xu.gif"    /> </p>
</div>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-fill.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, Reset V100~104 5 registers to 0, reset Y0~Y11 to OFF, set M100~M105 to ON.</p>
<h3 id="XCH_Byte_swap_D_XCH_Register_swap">XCH(Byte swap). D.XCH(Register swap)</h3>
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
                <p> 16. 32 bit Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/xch.gif"    /> <img src="<?= $path_to_images ?>images/d.xch.gif"    /></p>
            </td>
            <td>
                <p> XCH En, Sou, N</p>
                <p> D.XCH En, Sou, N</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/xch.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Start register to swap</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of swap registers </p>
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
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. 16 bit instruction XCH is byte swap , use for start from Sou N registers swap the high low byte .As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/xch-xu.gif"    /> </p>
</div>
<p> 2. 32 bit instruction D.XCH is register swap ,use for start from Sou N register component each border upon 2 register swap, if N is odd then the last one register unchanged.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/xch-xu1.gif"    /> </p>
</div>
<p> 3. XCH instruction general executed by edge. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-xch.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, Swap high low byte of V1000. V1001 these 2 registers ,swap V1002. V1003 these 2 registers ,swap V1004. V1005 these 2 registers .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Swap result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30 (0x001E)</p>
            </td>
            <td>
                <p> V1000=7680 (0x1E00)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150 (0xFF6A)</p>
            </td>
            <td>
                <p> V1001=27391(0x6AFF)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 </p>
            </td>
            <td>
                <p> V1002=8 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8 </p>
            </td>
            <td>
                <p> V1003=25</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 </p>
            </td>
            <td>
                <p> V1004=-20 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20 </p>
            </td>
            <td>
                <p> V1005=95</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="BXCH_Block_swap">BXCH(Block swap)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bxch.gif"    /></p>
            </td>
            <td>
                <p> BXCH En, Sou1, Sou2, N</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bxch.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> Sou1</td>
            <td>
                <p> Source 1 start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Sou2</td>
            <td>
                <p> Source 2 start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
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
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. Block swap instruction BXCH use for start from Sou1 N components and start from Sou2 N components.As follows:</p>
<div>
    <p> <img src="<?= $path_to_images ?>images/bxch-xu.gif"    /> </p>
</div>
<p> 2. BXCH instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bxch.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, Swap V1000~V1002 these 3registers and V1003~V1005 these 3 register.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Swap result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30 </p>
            </td>
            <td>
                <p> V1000=8</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150 </p>
            </td>
            <td>
                <p> V1001=95</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 </p>
            </td>
            <td>
                <p> V1002=-20</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8 </p>
            </td>
            <td>
                <p> V1003=30</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 </p>
            </td>
            <td>
                <p> V1004=-150</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20 </p>
            </td>
            <td>
                <p> V1005=25</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="SHL_Bit_left_shift">SHL(Bit left shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/shl.gif"    /></p>
            </td>
            <td>
                <p> SHL En, In, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/shl.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Bit shift start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
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
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. According to Num a group,SHL instruction use start from Sou N components left shift Num bit, shift start from In Num components ,shift out start from Out Num components.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/shl-xu.gif"    /> </p>
</div>
<p> 2. If Sou is register component, then use start from Sou N registers left shift bitwise Num bit.</p>
<p> 3. 1?Num?N, no then instruction not execute.</p>
<p> 4. SHL instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-shl.gif"    /></p>
<p> [Program description]</p>
<p> 1. When M0=ON, M100~M105 left shift 3 bit, shift in X0~X2,shift out put Y0~Y2.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Left shift result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M100</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td>
                <p> M100=OFF </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M101</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
            <td>
                <p> M101=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M102 </p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> M102=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M103</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td>
                <p> M103=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M104</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> M104=OFF </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M105</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
            <td>
                <p> M105=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X0 </p>
            </td>
            <td>
                <p> OFF </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> X1</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> X2</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> Y0</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y0=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y1</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y1=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y2</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y2=OFF </p>
            </td>
        </tr>
    </tbody>
</table>
<p> 2. When M1=ON,V1000~V1005 bitwise left shift 3 bits, shift in X0~X2,shift out to M200~M202.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Left shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 00000000 00011110</p>
            </td>
            <td>
                <p> V1000=00000000 11110110 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 11111111 01101010</p>
            </td>
            <td>
                <p> V1001=11111011 01010000 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 00000000 00011001 </p>
            </td>
            <td>
                <p> V1002=00000000 11001111 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 00000000 00001000</p>
            </td>
            <td>
                <p> V1003=00000000 01000000 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 00000000 01011111 </p>
            </td>
            <td>
                <p> V1004=00000010 11111000 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> 11111111 11101100</p>
            </td>
            <td>
                <p> V1005=11111111 01100000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X0 </p>
            </td>
            <td>
                <p> OFF </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> X1</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> X2</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> M200</p>
            </td>
            <td> ?</td>
            <td>
                <p> M200=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M201</p>
            </td>
            <td> ?</td>
            <td>
                <p> M201=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M202</p>
            </td>
            <td> ?</td>
            <td>
                <p> M202=ON </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="SHR_Bit_right_shift">SHR(Bit right shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/shr.gif"    /></p>
            </td>
            <td>
                <p> SHR En, In, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/shr.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Bit shift start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
            </td>
            <td> ?</td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. According to Num a group ,SHR instruction use start from Sou N components right shift Num bit, shift start from In Num components ,shift out start from Out Num components.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/shr-xu.gif"    /> </p>
</div>
<p> 2. If Sou are register component, then use start from Sou N registers right shift bitwise Num bit .</p>
<p> 3. 1?Num?N, no then instruction not executed.</p>
<p> 4. SHR instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-shr.gif"    /></p>
<p> [Program description]</p>
<p> 1. When M0=ON,M100~M105 right shift 3 bits, shift in X0~X2,shift out to Y0~Y2.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Right shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M100</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td>
                <p> M100=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M101</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
            <td>
                <p> M101=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M102 </p>
            </td>
            <td>
                <p> OFF </p>
            </td>
            <td>
                <p> M102=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M103</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td>
                <p> M103=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M104</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> M104=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M105</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
            <td>
                <p> M105=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X0 </p>
            </td>
            <td>
                <p> OFF </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> X1</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> X2</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> Y0</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y0=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y1</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y1=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y2</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y2=OFF </p>
            </td>
        </tr>
    </tbody>
</table>
<p> 2. When M1=ON,V1000~V1005 right shift 3 bits bitwise, shift in X0~X2,shift out to?M200~M202.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Right shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 00000000 00011110</p>
            </td>
            <td>
                <p> V1000=01000000 00000011</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 11111111 01101010</p>
            </td>
            <td>
                <p> V1001=00111111 11101101</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 00000000 00011001 </p>
            </td>
            <td>
                <p> V1002=00000000 00000011</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 00000000 00001000</p>
            </td>
            <td>
                <p> V1003=11100000 00000001</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 00000000 01011111 </p>
            </td>
            <td>
                <p> V1004=10000000 00001011</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> 11111111 11101100</p>
            </td>
            <td>
                <p> V1005=11011111 11111101</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> X0 </p>
            </td>
            <td>
                <p> OFF </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> X1</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> X2</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> M200</p>
            </td>
            <td> ?</td>
            <td>
                <p> M200=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M201</p>
            </td>
            <td> ?</td>
            <td>
                <p> M201=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M202</p>
            </td>
            <td> ?</td>
            <td>
                <p> M202=ON </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="WSHL_Word_left_shift">WSHL(Word left shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/wshl.gif"    /></p>
            </td>
            <td>
                <p> WSHL En, In, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/wshl.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Word shift start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
            </td>
            <td> ?</td>
            <td> v</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. WSHL instruction use start from Sou N components left shift Num word, shift start from In Num components ,shift out start from Out Num components.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/shl-xu.gif"    /> </p>
</div>
<p> 2. 1?Num?N, no then instruction not execute.</p>
<p> 3. WSHL instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-wshl.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,V1000~V1005 left shift 3 word ,shift in V0~V2,shift out to V100~V102.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Left shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30</p>
            </td>
            <td>
                <p> V1000=100 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150</p>
            </td>
            <td>
                <p> V1001=200 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 </p>
            </td>
            <td>
                <p> V1002=300 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8</p>
            </td>
            <td>
                <p> V1003=30 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 </p>
            </td>
            <td>
                <p> V1004=-150 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20</p>
            </td>
            <td>
                <p> V1005=25</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V0 </p>
            </td>
            <td>
                <p> 100 </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V1</p>
            </td>
            <td>
                <p> 200 </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V2</p>
            </td>
            <td>
                <p> 300</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V100</p>
            </td>
            <td> ?</td>
            <td>
                <p> V100=8 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V101</p>
            </td>
            <td> ?</td>
            <td>
                <p> V101=95 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V102</p>
            </td>
            <td> ?</td>
            <td>
                <p> V102=-20 </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="WSHR_Word_right_shift">WSHR(Word right shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/wshr.gif"    /></p>
            </td>
            <td>
                <p> WSHR En, In, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/wshr.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Word shift start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
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
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. WSHR instruction use start from Sou N components right shift Num word, shift start from In Num components ,shift out start from Out Num components.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/shr-xu.gif"    /> </p>
</div>
<p> 2. 1?Num?N, no then instruction not execute.</p>
<p> 3. WSHR instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-wshr.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,V1000~V1005 right 3 word, shift in V0~V2, shift out to V100~V102.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Right shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30</p>
            </td>
            <td>
                <p> V1000=8</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150</p>
            </td>
            <td>
                <p> V1001=95</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 </p>
            </td>
            <td>
                <p> V1002=-20</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8</p>
            </td>
            <td>
                <p> V1003=100</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 </p>
            </td>
            <td>
                <p> V1004=200</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20</p>
            </td>
            <td>
                <p> V1005=300</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V0 </p>
            </td>
            <td>
                <p> 100 </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V1</p>
            </td>
            <td>
                <p> 200 </p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V2</p>
            </td>
            <td>
                <p> 300</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V100</p>
            </td>
            <td> ?</td>
            <td>
                <p> V100=30</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V101</p>
            </td>
            <td> ?</td>
            <td>
                <p> V101=-150</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V102</p>
            </td>
            <td> ?</td>
            <td>
                <p> V102=25</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="ROL_Bit_rotate_left_shift">ROL(Bit rotate left shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/rol.gif"    /></p>
            </td>
            <td>
                <p> ROL En, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/rol.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
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
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. According to Num a group ,ROL instruction use start from Sou N components left shift Num bit, shift start from Sou Num components ,shift out start from Out Num components.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/rol-xu.gif"    /> </p>
</div>
<p> 2. If Sou are register component, then use start from Sou N registers left shift bitwise .</p>
<p> 3. 1?Num?N, no then instruction not execute .</p>
<p> 4. ROL instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-rol.gif"    /></p>
<p> [Program description]</p>
<p> 1. When M0=ON, M100~M105 rotate left shift 3 bits, shift out to Y0~Y2.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Left shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M100</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td>
                <p> M100=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M101</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
            <td>
                <p> M101=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M102 </p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> M102=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M103</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td>
                <p> M103=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M104</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> M104=OFF </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M105</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
            <td>
                <p> M105=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y0</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y0=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y1</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y1=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y2</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y2=OFF </p>
            </td>
        </tr>
    </tbody>
</table>
<p> 2. When M1=ON, V1000~V1005 rotate left shift 3 bits, shift out to M200~M202.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Left shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 00000000 00011110</p>
            </td>
            <td>
                <p> V1000=00000000 11110111 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 11111111 01101010</p>
            </td>
            <td>
                <p> V1001=11111011 01010000 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 00000000 00011001 </p>
            </td>
            <td>
                <p> V1002=00000000 11001111 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 00000000 00001000</p>
            </td>
            <td>
                <p> V1003=00000000 01000000 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 00000000 01011111 </p>
            </td>
            <td>
                <p> V1004=00000010 11111000 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> 11111111 11101100</p>
            </td>
            <td>
                <p> V1005=11111111 01100000</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M200</p>
            </td>
            <td> ?</td>
            <td>
                <p> M200=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M201</p>
            </td>
            <td> ?</td>
            <td>
                <p> M201=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M202</p>
            </td>
            <td> ?</td>
            <td>
                <p> M202=ON </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="ROR_Bit_rotate_right_shift">ROR(Bit rotate right shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/ror.gif"    /></p>
            </td>
            <td>
                <p> ROR En, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/ror.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
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
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. According to Num a group ,ROR instruction use start from Sou N components right shift Num bit, shift start from Sou Num components ,shift out start from Out Num components.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/ror-xu.gif"    /> </p>
</div>
<p> 2. If Sou are register component, then use start from Sou N registers right shift bitwise .</p>
<p> 3. 1?Num?N, no then instruction not execute.</p>
<p> 4. ROR instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-ror.gif"    /></p>
<p> [Program description]</p>
<p> 1. When M0=ON, M100~M105 rotate right shift 3 bits , shift out to Y0~Y2.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Right shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M100</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td>
                <p> M100=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M101</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
            <td>
                <p> M101=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M102 </p>
            </td>
            <td>
                <p> OFF </p>
            </td>
            <td>
                <p> M102=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M103</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td>
                <p> M103=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M104</p>
            </td>
            <td>
                <p> ON </p>
            </td>
            <td>
                <p> M104=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M105</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
            <td>
                <p> M105=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y0</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y0=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y1</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y1=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y2</p>
            </td>
            <td> ?</td>
            <td>
                <p> Y2=OFF </p>
            </td>
        </tr>
    </tbody>
</table>
<p> 2. When M1=ON, V1000~V1005 rotate right shift 3 bits, shift out to M200~M202.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Right shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 00000000 00011110</p>
            </td>
            <td>
                <p> V1000=01000000 00000011</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 11111111 01101010</p>
            </td>
            <td>
                <p> V1001=00111111 11101101</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 00000000 00011001 </p>
            </td>
            <td>
                <p> V1002=00000000 00000011</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 00000000 00001000</p>
            </td>
            <td>
                <p> V1003=11100000 00000001</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 00000000 01011111 </p>
            </td>
            <td>
                <p> V1004=10000000 00001011</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> 11111111 11101100</p>
            </td>
            <td>
                <p> V1005=11011111 11111101</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M200</p>
            </td>
            <td> ?</td>
            <td>
                <p> M200=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M201</p>
            </td>
            <td> ?</td>
            <td>
                <p> M201=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M202</p>
            </td>
            <td> ?</td>
            <td>
                <p> M202=ON </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="WROL_Word_rotate_left_shift">WROL(Word rotate left shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/wrol.gif"    /></p>
            </td>
            <td>
                <p> WROL En, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/wrol.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
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
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. WROL instruction use start from Sou N components left shift Num word, shift start from Sou Num components ,shift out start from Out Num components.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/rol-xu.gif"    /> </p>
</div>
<p> 2. 1?Num?N, no then instruction not execute .</p>
<p> 3. WROL instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-wrol.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,V1000~V1005 rotate left shift 3 words, shift out to V100~V102.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value </strong></p>
            </td>
            <td>
                <p> <strong>Left shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30</p>
            </td>
            <td>
                <p> V1000=8 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150</p>
            </td>
            <td>
                <p> V1001=95 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 </p>
            </td>
            <td>
                <p> V1002=-20 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8</p>
            </td>
            <td>
                <p> V1003=30 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 </p>
            </td>
            <td>
                <p> V1004=-150 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20</p>
            </td>
            <td>
                <p> V1005=25</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V100</p>
            </td>
            <td> ?</td>
            <td>
                <p> V100=8 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V101</p>
            </td>
            <td> ?</td>
            <td>
                <p> V101=95 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V102</p>
            </td>
            <td> ?</td>
            <td>
                <p> V102=-20 </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="WROR_Word_rotate_right_shift">WROR(Word rotate right shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/wror.gif"    /></p>
            </td>
            <td>
                <p> WROR En, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/wror.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
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
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Num continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. WROR instruction use start from Sou N components right shift Num word, shift start from Sou Num components ,shift out start from Out Num components.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/ror-xu.gif"    /> </p>
</div>
<p> 2. 1?Num?N, no then instruction not execute.</p>
<p> 3. WROR instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-wror.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,V1000~V1005 rotate right shift 3 words, shift out to V100~V102.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Right shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30</p>
            </td>
            <td>
                <p> V1000=8</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150</p>
            </td>
            <td>
                <p> V1001=95</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 </p>
            </td>
            <td>
                <p> V1002=-20</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8</p>
            </td>
            <td>
                <p> V1003=30</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 </p>
            </td>
            <td>
                <p> V1004=-150</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20</p>
            </td>
            <td>
                <p> V1005=25</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V100</p>
            </td>
            <td> ?</td>
            <td>
                <p> V100=30</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V101</p>
            </td>
            <td> ?</td>
            <td>
                <p> V101=-150</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V102</p>
            </td>
            <td> ?</td>
            <td>
                <p> V102=25</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="BSHL_Byte_left_shift">BSHL(Byte left shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bshl.gif"    /></p>
            </td>
            <td>
                <p> BSHL En, In, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bshl.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Shift in byte start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td>
                <p> Occupy (Num-1)\2+1 continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
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
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy (Num-1)\2+1 continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. BSHL instruction use start from Sou N components left shift Num byte, shift in start from In Num bytes, shift out to start from Out Num bytes.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/bshl-xu.gif"    /> </p>
</div>
<p> 2. 1?Num?2*N, no then instruction not execute.</p>
<p> 3. BSHL instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bshl.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,V1000~V1005 left shift 3 bytes, shift in V0 and V1 low byte, shift out to V100 and V101 low byte .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Left shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30(0x001E)</p>
            </td>
            <td>
                <p> V1000=100(0x1234) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150(0xFF6A)</p>
            </td>
            <td>
                <p> V1001=200(0x1E78) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 (0x0019)</p>
            </td>
            <td>
                <p> V1002=300 (0x6A00)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8(0x0008)</p>
            </td>
            <td>
                <p> V1003=30(0x19FF) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 (0x005F)</p>
            </td>
            <td>
                <p> V1004=-150(0x0800) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20(0xFFEC)</p>
            </td>
            <td>
                <p> V1005=25(0x5F00)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V0 </p>
            </td>
            <td>
                <p> 4660 (0x1234)</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V1</p>
            </td>
            <td>
                <p> 22136 (0x5678)</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V100</p>
            </td>
            <td> ?</td>
            <td>
                <p> V100=8(0xEC00) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V101</p>
            </td>
            <td> ?</td>
            <td>
                <p> V101=95(0x00FF) </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="BSHR_Byte_right_shift">BSHR(Byte right shift)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bshr.gif"    /></p>
            </td>
            <td>
                <p> BSHR En, In, Sou, N, Num, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bshr.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Shift in byte start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td>
                <p> Occupy (Num-1)\2+1 continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
        </tr>
        <tr>
            <td> Num</td>
            <td>
                <p> Shift times </p>
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
                <p> Enable output</p>
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
                <p> Shift out component</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy (Num-1)\2+1 continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. BSHR instruction use start from Sou N components right shift Num byte, shift in start from In Num bytes, shift out to start from Out Num bytes.As follows: </p>
<div>
    <p> <img src="<?= $path_to_images ?>images/bshr-xu.gif"    /> </p>
</div>
<p> 2. 1?Num?2*N, no then instruction not execute.</p>
<p> 3. BSHR instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bshr.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,V1000~V1005 right shift 3 bytes, shift in V0 and V1 low byte, shift out to V100 and V101 low byte.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Right shift result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 30(0x001E)</p>
            </td>
            <td>
                <p> V1000=100(0x19FF) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> -150(0xFF6A)</p>
            </td>
            <td>
                <p> V1001=200(0x0800) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002 </p>
            </td>
            <td>
                <p> 25 (0x0019)</p>
            </td>
            <td>
                <p> V1002=300 (0x5F00)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 8(0x0008)</p>
            </td>
            <td>
                <p> V1003=30(0xEC00) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 95 (0x005F)</p>
            </td>
            <td>
                <p> V1004=-150(0x34FF) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1005</p>
            </td>
            <td>
                <p> -20(0xFFEC)</p>
            </td>
            <td>
                <p> V1005=25(0x7812)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V0 </p>
            </td>
            <td>
                <p> 4660 (0x1234)</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V1</p>
            </td>
            <td>
                <p> 22136 (0x5678)</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V100</p>
            </td>
            <td> ?</td>
            <td>
                <p> V100=8(0x001E) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V101</p>
            </td>
            <td> ?</td>
            <td>
                <p> V101=95(0x006A) </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="ATBL_Append_to_array">ATBL(Append to array)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/atbl.gif"    /></p>
            </td>
            <td>
                <p> ATBL En, In, Tbl, N</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/atbl_fifo.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> In</td>
            <td>
                <p> Input data</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Tbl</td>
            <td>
                <p> Array start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy N+1 continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Array length</p>
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
                <p> Enable output</p>
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
<p> 1. Append to array instruction ATBL will append bit state or register value to the array specified by Tbl in sequence.</p>
<p> 2. En is instruction Enable item, general use edge type (rising edge or failling edge) signal.When En state hop ON once , append In value to array specified by Tbl, array element number add 1(Tbl register content value add 1).</p>
<p> 3. Tbl define store data array start component ,N is array length , among the first register (Tbl)of the array be the numbers of the array element ,Tbl+1 to Tbl+N total N registers use for store array data.so, if In is bit component ,the maximum array element can be stored are N*16; If In is regieter ,the maximum array element can be stored are N. When number of array element exceed the maximum value of array elements , data con not append into the array .</p>
<p> 4. Store queue of the array as follows :</p>
<div>
    <p> A. Bit component data: if append to array is bit, store queue of the array as follows:</p>
    <div>
        <table>
            <tbody>
                <tr>
                    <td colspan="2">
                        <p> Array component</p>
                    </td>
                    <td>
                        <p> Array content</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p> Tbl</p>
                    </td>
                    <td>
                        <p> Number of array element</p>
                    </td>
                </tr>
                <tr>
                    <td rowspan="4">
                        <p> Tbl+1</p>
                    </td>
                    <td> b0</td>
                    <td>
                        <p> First array element </p>
                    </td>
                </tr>
                <tr>
                    <td> b1</td>
                    <td>
                        <p> Second array element </p>
                    </td>
                </tr>
                <tr>
                    <td> ......</td>
                    <td>?</td>
                </tr>
                <tr>
                    <td> b15</td>
                    <td>
                        <p> Sixteen array element </p>
                    </td>
                </tr>
                <tr>
                    <td rowspan="3">
                        <p> Tbl+2</p>
                    </td>
                    <td> b0</td>
                    <td>
                        <p> seventeen array element </p>
                    </td>
                </tr>
                <tr>
                    <td> b1</td>
                    <td>
                        <p> eighteen array element </p>
                    </td>
                </tr>
                <tr>
                    <td> ......</td>
                    <td>
                        <p> ......</p>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">
                        <p> ......</p>
                    </td>
                    <td> b0</td>
                    <td>
                        <p> ......</p>
                    </td>
                </tr>
                <tr>
                    <td> ......</td>
                    <td>
                        <p> ......</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div>
    <p> B. Register component data: if appended to array is 16 bit register, store queue of the array as follows:</p>
    <div>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p> Array component</p>
                        </td>
                        <td>
                            <p> Array content</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> Tbl</p>
                        </td>
                        <td>
                            <p> Number of array element</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> Tbl+1</p>
                        </td>
                        <td>
                            <p> First array element </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> Tbl+2</p>
                        </td>
                        <td>
                            <p> Second array element </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> Tbl+3</p>
                        </td>
                        <td>
                            <p> Third array element </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> ......</p>
                        </td>
                        <td>
                            <p> ......</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-atbl.gif"    /></p>
<p> [Program description]</p>
<p> 1. First scan SM2=ON, start T0 timer(30s).</p>
<p> 2. SM5 is clock pulse per second , cycles per second, INC instruction V200 add 1(for simulated data),ATBL instruction append V200 into the array start from V500 , array length is 255.</p>
<p> 3. After 30s ,T0=OFF, per second FIFO instruction will be first in first out get data from array, output to AQ0.</p>
<h3 id="FIFO_First_in_first_out">FIFO(First in first out)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/fifo.gif"    /></p>
            </td>
            <td>
                <p> FIFO En, Tbl, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/atbl_fifo.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> Tbl</td>
            <td>
                <p> Array start component </p>
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
                <p> Enable output</p>
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
                <p> Data output</p>
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
<p> 1. FIFO instruction according to first in first out model get out data from array ATBL , each data be get out array element subtract 1. </p>
<p> 2. If number of array elements?0, then instruction not execute.</p>
<p> 3. FIFO instruction cooperate ATBL instruction ready-made first in first out array,FIFO instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> Refer to <a href="#ATBL_Append_to_array">ATBL</a> instruction.</p>
<h3 id="LIFO_Last_in_first_out">LIFO(Last in first out)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/lifo.gif"    /></p>
            </td>
            <td>
                <p> LIFO En, Tbl, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/atbl_lifo.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> Tbl</td>
            <td>
                <p> Array start component </p>
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
                <p> Enable output</p>
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
                <p> Data output</p>
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
<p> 1. LIFO instruction according to last in first out model get out data from array <a href="#ATBL_Append_to_array">ATBL</a> , each data be get out array element subtract 1. </p>
<p> 2. If number of array elements?0, then instruction not execute.</p>
<p> 3. LIFO instruction cooperate ATBL instruction ready-made last in first out array(stack),LIFO instruction general executed by edge.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-lifo.gif"    /></p>
<p> [Program description]</p>
<p> 1. First scan SM2=ON, start T0 timer(30s).</p>
<p> 2. SM5 clock pulse per second , cycles per second, INC instruction V200 add 1(for simulated data), ATBL instruction append V200 into the array start from V500 , array length is 255.</p>
<p> 3. After 30s,T0=OFF, per second LIFO instruction get out data from array according to last in first out ,output to AQ0.</p>
<h3 id="SORT_Data_sort">SORT(Data sort)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/sort.gif"    /></p>
            </td>
            <td>
                <p> SORT En, UpDown, Sou, Row, Col, Index, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/sort.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> UpDown</td>
            <td>
                <p> Ascending or descending order control</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td> Sou</td>
            <td>
                <p> Source start component</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> Occupy Row * Col continuous component</p>
            </td>
        </tr>
        <tr>
            <td> Row</td>
            <td>
                <p> Row </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td> 1~64</td>
        </tr>
        <tr>
            <td> Col</td>
            <td>
                <p> Line</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~64</td>
        </tr>
        <tr>
            <td> Index</td>
            <td>
                <p> Arrange sequence </p>
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
                <p> Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy Row * Col continuous component</p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. The data from start Sou Row row Col line total Row?Col elements will be sorted ,sort refer to Index specified line ,sort direction controlled by UpDown, UpDown is OFF then ascending sort , UpDown is ON then descending sort, data be sorted store into the first Out total Row?Col elements.</p>
<p> 2. SORT instruction be executed edge ,if modified the Sou data after sorted, then must be retrigger.</p>
<p> 3. Must meet Row?1. Col?1. Index?Col, no then instruction not execute.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-sort.gif"    /></p>
<p> [Program description]</p>
<p> If initial data (performance) as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Name </strong></p>
            </td>
            <td>
                <p> <strong>Chinese</strong></p>
            </td>
            <td>
                <p> <strong>Math</strong></p>
            </td>
            <td>
                <p> <strong>English</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Wu</p>
            </td>
            <td> V1000=98</td>
            <td> V1001=65</td>
            <td> V1002=81</td>
        </tr>
        <tr>
            <td>
                <p> Chen</p>
            </td>
            <td> V1003=78</td>
            <td> V1004=89</td>
            <td> V1005=65</td>
        </tr>
        <tr>
            <td>
                <p> Wang</p>
            </td>
            <td> V1006=87</td>
            <td> V1007=99</td>
            <td> V1008=68</td>
        </tr>
        <tr>
            <td>
                <p> Li</p>
            </td>
            <td> V1009=60</td>
            <td> V1010=92</td>
            <td> V1011=83</td>
        </tr>
        <tr>
            <td>
                <p> Zhang</p>
            </td>
            <td> V1012=72</td>
            <td> V1013=90</td>
            <td> V1014=56</td>
        </tr>
    </tbody>
</table>
<p> If M100=OFF, when M0=ON, start from V1000 5 row 3 line array ,according to line 2(mathematic performance) use ascending sort , result store into start from V0 5x3 elements.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Name </strong></p>
            </td>
            <td>
                <p> <strong>Chinese</strong></p>
            </td>
            <td>
                <p> <strong>Math</strong></p>
            </td>
            <td>
                <p> <strong>English</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Wu</p>
            </td>
            <td> V0=98</td>
            <td> V1=65</td>
            <td> V2=81</td>
        </tr>
        <tr>
            <td>
                <p> Chen</p>
            </td>
            <td> V3=78</td>
            <td> V4=89</td>
            <td> V5=65</td>
        </tr>
        <tr>
            <td>
                <p> Zhang</p>
            </td>
            <td> V12=72</td>
            <td> V13=90</td>
            <td> V14=56</td>
        </tr>
        <tr>
            <td>
                <p> Li</p>
            </td>
            <td> V9=60</td>
            <td> V10=92</td>
            <td> V11=83</td>
        </tr>
        <tr>
            <td>
                <p> Wang</p>
            </td>
            <td> V6=87</td>
            <td> V7=99</td>
            <td> V8=68</td>
        </tr>
    </tbody>
</table>
<p> If M100=ON, when M0=ON,start from V1000 5 row 3 line array ,according to line 2(mathematic performance) use descending sort , result store into start from V0 5x3 elements.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Name </strong></p>
            </td>
            <td>
                <p> <strong>Chinese</strong></p>
            </td>
            <td>
                <p> <strong>Math</strong></p>
            </td>
            <td>
                <p> <strong>English</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Wang</p>
            </td>
            <td> V6=87</td>
            <td> V7=99</td>
            <td> V8=68</td>
        </tr>
        <tr>
            <td>
                <p> Li</p>
            </td>
            <td> V9=60</td>
            <td> V10=92</td>
            <td> V11=83</td>
        </tr>
        <tr>
            <td>
                <p> Zhang</p>
            </td>
            <td> V12=72</td>
            <td> V13=90</td>
            <td> V14=56</td>
        </tr>
        <tr>
            <td>
                <p> Chen</p>
            </td>
            <td> V3=78</td>
            <td> V4=89</td>
            <td> V5=65</td>
        </tr>
        <tr>
            <td>
                <p> Wu</p>
            </td>
            <td> V0=98</td>
            <td> V1=65</td>
            <td> V2=81</td>
        </tr>
    </tbody>
</table>