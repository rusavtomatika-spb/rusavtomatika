<h3 id="Data_conversion_instruction">Data conversion instruction</h3>
<hr>
<p> Data conversion instruction list as follows </p>
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
            <td> <a href="#ENCO_Encoder">ENCO</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Encoder</p>
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
            <td> <a href="#DECO_Decoder">DECO</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Decoder</p>
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
            <td> <a href="#BTOW_Bit_convert_to_word">BTOW</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Bit convert to word</p>
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
            <td> <a href="#WTOB_Word_convert_to_bit">WTOB</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> Word convert to bit</p>
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
            <td> <a href="#HEX_HEX_LB_ASCII_convert_to_hexadecimal">HEX</a></td>
            <td>
                <p> HEX.LB</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> ASCII convert to hexadecimal</p>
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
            <td> <a href="#ASCI_ASCI_LB_Hexadecimal_convert_to_ASCII">ASCI</a></td>
            <td>
                <p> ASCI.LB</p>
            </td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> Hexadecimal convert to ASCII</p>
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
            <td> <a href="#BUNB_Discrete_bit_combination_to_continuous_bit">BUNB</a></td>
            <td> ?</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> Discrete bit combination to continuous bit</p>
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
            <td> <a href="#BUNW_Discrete_bit_combination_to_continuous_word">BUNW</a></td>
            <td> ?</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> Discrete bit combination to continuous word</p>
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
            <td> <a href="#WUNW_Discrete_word_combination_to_continuous_word">WUNW</a></td>
            <td> ?</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> Discrete word combination to continuous word</p>
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
            <td> <a href="#BDIB_Continuous_bit_disperse_to_discrete_bit">BDIB</a></td>
            <td> ?</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> Continuous bit disperse to discrete bit</p>
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
            <td> <a href="#WDIB_Continuous_word_disperse_to_discrete_bit">WDIB</a></td>
            <td> ?</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> Continuous word disperse to discrete bit</p>
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
            <td> <a href="#WDIW_Continuous_word_disperse_to_discrete_word">WDIW</a></td>
            <td> ?</td>
            <td>
                <p> </p>
            </td>
            <td>
                <p> Continuous word disperse to discrete word</p>
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
            <td> <a href="#BCD_D_BCD_BIN_convert_to_BCD">BCD</a></td>
            <td> ?</td>
            <td>
                <p> D.BCD</p>
            </td>
            <td>
                <p> BIN convert to BCD</p>
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
            <td> <a href="#BIN_D_BIN_BCD_convert_to_BIN">BIN</a></td>
            <td> ?</td>
            <td>
                <p> D.BIN</p>
            </td>
            <td>
                <p> BCD convert to BIN</p>
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
            <td> <a href="#ITOL_Integer_convert_to_long_integer">ITOL</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> Integer convert to long integer</td>
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
            <td> <a href="#GRAY_BIN_convert_to_GRAY_code">GRAY</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> BIN convert to GRAY code</td>
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
            <td> <a href="#GBIN_GRAY_code_convert_to_BIN">GBIN</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> GRAY code convert to BIN</td>
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
<h3 id="ENCO_Encoder">ENCO(Encoder)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/enco.gif"    /></p>
            </td>
            <td>
                <p> ENCO En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/enco.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> ?</td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of bits be encoded </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 0~8</td>
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
                <p> Encode output </p>
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
<p> 1. ENCO instruction use for obtain the position of the maximum ON bit in Sou data . </p>
<p> 2. 0?N?8,maximum may encode 2^8=256 bits.</p>
<p> 3. If the source data have many bits are 1(ON), then only deal with the highest bit.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-enco.gif"    /></p>
<p> [Program description]</p>
<p> 1. M0=ON,X0~X7(2^3=8) proceed encode, if X6=ON,X7=OFF other not to matter, then V0=7.</p>
<p> 2. M0=ON,V100 low 8 bits (2^3=8,high 8 bits not use ) proceed encode ,if V100=2345(00001001 00101001),then V10=6.</p>
<h3 id="DECO_Decoder">DECO(Decoder)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/deco.gif"    /></p>
            </td>
            <td>
                <p> DECO En, In, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/deco.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Decode input </p>
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
                <p> Decode digitals</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 0~8</td>
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
                <p> Decode output </p>
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
<p> 1. DECO instruction decode N digitals of the In data, result output to Out. </p>
<p> 2. 0?N?8,maximum may decode output 2^8=256 bits.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-deco.gif"    /></p>
<p> [Program description]</p>
<p> M0=ON,V0 decoded Output to Y0~Y7(2^3=8) and low 8 bits of V100 (2^3=8,high 8 bits total are 0). If V0=7, then among Y0~Y7 only Y6=ON others OFF,V100=64(00000000 01000000).</p>
<h3 id="BTOW_Bit_convert_to_word">BTOW(Bit convert to word)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/btow.gif"    /></p>
            </td>
            <td>
                <p> BTOW En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/btow.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Convert digitals</p>
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
            <td>
                <p>?</p>
            </td>
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
<p> BTOW instruction convert N bit components start from Sou, convert to integer result output toOut.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-btow.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,X0~X5 convert to integer ,if X1=ON. X2=ON. X5=ON others are OFF,then V0=38(00000000 00100110).</p>
<h3 id="WTOB_Word_convert_to_bit">WTOB (Word convert to bit)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/wtob.gif"    /></p>
            </td>
            <td>
                <p> WTOB En, In, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/wtob.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> N</td>
            <td>
                <p> Convert digitals</p>
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
                <p> Convert result start component</p>
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
<p> WTOB instruction convert N bits of In to output to Out.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-wtob.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,low 7 bits of V0 convert to Y0~Y6,if V0=38(00000000 00100110),then Y1=ON. Y2=ON. Y5=ON others are OFF.</p>
<h3 id="HEX_HEX_LB_ASCII_convert_to_hexadecimal">HEX. HEX.LB(ASCII convert to hexadecimal)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/hex.gif"    /> <img src="<?= $path_to_images ?>images/hex.lb.gif"    /></p>
            </td>
            <td>
                <p> HEX En, Sou, N, Out</p>
                <p> HEX.LB En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/hex_asci.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> HEX occupy (N-1)\2+1 continuous component,HEX.LB occupy N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Number of characters converted</p>
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
            <td>
                <p>?</p>
            </td>
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
                <p> Occupy (N-1)\4+1 continuous component</p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. HEX instruction convert start from Sou ASCII code to HEX value, number of N characters will be onverted. </p>
<p> 2. 8 bit model instruction HEX.LB only convert low byte of Sou , high byte not use .</p>
<p> 3. ASCII code characters only be 0~9 and A. B. C. D. E. F these 6 characters, if there have illegality characters in Sou then instruction not execute.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-hex.gif"    /></p>
<p> [Program description]</p>
<p> If initial data (ASCII code data) as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong> Component</strong></p>
            </td>
            <td>
                <p> <strong> Register value (ASCII code) </strong></p>
            </td>
            <td>
                <p> <strong>High low byte value(ASCII code) </strong></p>
            </td>
            <td>
                <p> <strong> ASCII character</strong></p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1000</p>
            </td>
            <td rowspan="2"> 0x3938</td>
            <td> Low byte 0x38</td>
            <td> "8"</td>
        </tr>
        <tr>
            <td> Hight byte 0x39</td>
            <td> "9"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1001</p>
            </td>
            <td rowspan="2"> 0x4241</td>
            <td> Low byte 0x41</td>
            <td> "A"</td>
        </tr>
        <tr>
            <td> Hight byte 0x42</td>
            <td> "B"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1002</p>
            </td>
            <td rowspan="2"> 0x3534</td>
            <td> Low byte 0x34</td>
            <td> "4"</td>
        </tr>
        <tr>
            <td> Hight byte 0x35</td>
            <td> "5"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1003</p>
            </td>
            <td rowspan="2"> 0x3332</td>
            <td> Low byte 0x32</td>
            <td> "2"</td>
        </tr>
        <tr>
            <td> Hight byte 0x33</td>
            <td> "3"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1004</p>
            </td>
            <td rowspan="2"> 0x4645</td>
            <td> Low byte 0x45</td>
            <td> "E"</td>
        </tr>
        <tr>
            <td> Hight byte 0x46</td>
            <td> "F"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1005</p>
            </td>
            <td rowspan="2"> 0x3039</td>
            <td> Low byte 0x39</td>
            <td> "9"</td>
        </tr>
        <tr>
            <td> Hight byte 0x30</td>
            <td> "0"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1006</p>
            </td>
            <td rowspan="2"> 0x3831</td>
            <td> Low byte 0x31</td>
            <td> "1"</td>
        </tr>
        <tr>
            <td> Hight byte 0x38</td>
            <td> "8"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1007</p>
            </td>
            <td rowspan="2"> 0x4443</td>
            <td> Low byte 0x43</td>
            <td> "C"</td>
        </tr>
        <tr>
            <td> Hight byte 0x44</td>
            <td> "D"</td>
        </tr>
    </tbody>
</table>
<p> When M0=ON, start from V1000 ASCII code convert to data ,HEX convert result to components start form V0 ,HEX.LB only convert to low byte ASCII code of V1000 , convert result to start from V10, N=1~8 converted result as follows.</p>
<table>
    <tbody>
        <tr>
            <td rowspan="2">
                <p> <strong>N </strong></p>
            </td>
            <td colspan="2">
                <p> <strong>HEX </strong></p>
            </td>
            <td colspan="2">
                <p> <strong> HEX.LB </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> <strong>V1</strong></p>
            </td>
            <td>
                <p> <strong>V0</strong></p>
            </td>
            <td>
                <p> <strong>V11</strong></p>
            </td>
            <td>
                <p> <strong>V10</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td rowspan="4"> ?</td>
            <td> 0x8</td>
            <td rowspan="4"> ?</td>
            <td> 0x8</td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> 0x89</td>
            <td> 0x8A</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td> 0x89A</td>
            <td> 0x8A4</td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td> 0x89AB</td>
            <td> 0x8A42</td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> 0x8</td>
            <td> 0x9AB4</td>
            <td> 0x8</td>
            <td> 0xA42E</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> 0x89</td>
            <td> 0xAB45</td>
            <td> 0x8A</td>
            <td> 0x42E9</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td> 0x89A</td>
            <td> 0xB452</td>
            <td> 0x8A4</td>
            <td> 0x2E91</td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> 0x89AB</td>
            <td> 0x4523</td>
            <td> 0x8A42</td>
            <td> 0xE91C</td>
        </tr>
    </tbody>
</table>
<h3 id="ASCI_ASCI_LB_Hexadecimal_convert_to_ASCII">ASCI. ASCI.LB(Hexadecimal convert to ASCII)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/asci.gif"    /> <img src="<?= $path_to_images ?>images/asci.lb.gif"    /></p>
            </td>
            <td>
                <p> ASCI En, Sou, N, Out</p>
                <p> ASCI.LB En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/hex_asci.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Occupy (N-1)\4+1 continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> number of character be converted </p>
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
            <td>
                <p>?</p>
            </td>
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
                <p> ASCI occupy (N-1)\2+1 continuous component,ASCI.LB occupy N continuous component</p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. ASCI instruction convert start from Sou value to ASCII code character , number of N characters will be converted, convert result stored to start from Out component . </p>
<p> 2. 8 bit model instruction ASCI.LB only store convert low byte to low byte of Out ,hight byte is 0.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-asci.gif"    /></p>
<p> [Program description]</p>
<p> If initial data ( convert to ASCII code)as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong> component</strong></p>
            </td>
            <td>
                <p> <strong>Register value </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1100</p>
            </td>
            <td>
                <p> 0x4523</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1101</p>
            </td>
            <td> 0x89AB</td>
        </tr>
    </tbody>
</table>
<p> When M1=ON,ASCI instruction convert the value of start from V1100 to ASCII code, result to start from V100 component,ASCI.LB instruction put the result to start from V2000 components (Only low byte, hight byte is0),N=1~8 convert ed result as follows .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Instruction format </strong></p>
            </td>
            <td>
                <p> <strong>Out component</strong></p>
            </td>
            <td>
                <p> <strong>N </strong></p>
            </td>
            <td>
                <p> <strong>1</strong></p>
            </td>
            <td>
                <p> <strong>2</strong></p>
            </td>
            <td>
                <p> <strong>3</strong></p>
            </td>
            <td>
                <p> <strong>4</strong></p>
            </td>
            <td>
                <p> <strong>5</strong></p>
            </td>
            <td>
                <p> <strong>6</strong></p>
            </td>
            <td>
                <p> <strong>7</strong></p>
            </td>
            <td>
                <p> <strong>8</strong></p>
            </td>
        </tr>
        <tr>
            <td rowspan="8">
                <p> ASCI</p>
            </td>
            <td rowspan="2">
                <p> V100</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
            <td> "B"</td>
            <td> "A"</td>
            <td> "9"</td>
            <td> "8"</td>
        </tr>
        <tr>
            <td>
                <p> Hight byte</p>
            </td>
            <td> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
            <td> "B"</td>
            <td> "A"</td>
            <td> "9"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V101</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td> ?</td>
            <td> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
            <td> "B"</td>
            <td> "A"</td>
        </tr>
        <tr>
            <td>
                <p> Hight byte</p>
            </td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
            <td> "B"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V102</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
        </tr>
        <tr>
            <td>
                <p> Hight byte</p>
            </td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V103</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> "3"</td>
            <td> "2"</td>
        </tr>
        <tr>
            <td>
                <p> Hight byte</p>
            </td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> ?</td>
            <td> "3"</td>
        </tr>
        <tr>
            <td rowspan="8">
                <p> ASCI.LB</p>
            </td>
            <td>
                <p> V200</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
            <td> "B"</td>
            <td> "A"</td>
            <td> "9"</td>
            <td> "8"</td>
        </tr>
        <tr>
            <td>
                <p> V201</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td rowspan="7"> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
            <td> "B"</td>
            <td> "A"</td>
            <td> "9"</td>
        </tr>
        <tr>
            <td>
                <p> V202</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td rowspan="6"> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
            <td> "B"</td>
            <td> "A"</td>
        </tr>
        <tr>
            <td>
                <p> V203</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td rowspan="5"> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
            <td> "B"</td>
        </tr>
        <tr>
            <td>
                <p> V204</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td rowspan="4"> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
            <td> "4"</td>
        </tr>
        <tr>
            <td>
                <p> V205</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td rowspan="3"> ?</td>
            <td> "3"</td>
            <td> "2"</td>
            <td> "5"</td>
        </tr>
        <tr>
            <td>
                <p> V206</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td rowspan="2"> ?</td>
            <td> "3"</td>
            <td> "2"</td>
        </tr>
        <tr>
            <td>
                <p> V207</p>
            </td>
            <td>
                <p> Low byte</p>
            </td>
            <td> ?</td>
            <td> "3"</td>
        </tr>
    </tbody>
</table>
<h3 id="BUNB_Discrete_bit_combination_to_continuous_bit">BUNB(Discrete bit combination to continuous bit)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bunb.gif"    /></p>
            </td>
            <td>
                <p> BUNB En, Table, Des</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bunb_bunw.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> Table</td>
            <td>
                <p> Discrete bit table</p>
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
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> Des</td>
            <td>
                <p> Target start component</p>
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
<p> BUNB instruction use for combination the discrete bit which Table define to continuous bit components . </p>
<p> Discrete bit table: may be called by BUNB. BUNW. BDIB. WDIB instruction Table item. how to define the discrete bit table please refer to "<a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Instruction_use_table"> instruction use table</a>" section. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bunb.gif"    /></p>
<p> [Program description]</p>
<p> If "read discrete bit table" defined as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong>Bit component</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> X3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> M10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> M301</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> S21</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> M77</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> M100</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td>
                <p> X1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> Y6</td>
        </tr>
    </tbody>
</table>
<p> When M0=ON,BUNB instruction combine the "read discrete bit table" defined bit to start from M500 continuous component.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Executed result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td> M500 = X3</td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> M501 = M10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td> M502 = M301</td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td> M503 = S21</td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> M504 = M77</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> M505 = M100</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td> M506 = X1</td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> M507 = Y6</td>
        </tr>
    </tbody>
</table>
<h3 id="BUNW_Discrete_bit_combination_to_continuous_word">BUNW(Discrete bit combination to continuous word)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bunw.gif"    /></p>
            </td>
            <td>
                <p> BUNW En, Table, Des</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bunb_bunw.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> Table</td>
            <td>
                <p> Discrete bit table</p>
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
            <td> Des</td>
            <td>
                <p> Target start component</p>
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
<p> BUNW instruction use for combination the discrete bit which Table define to continuous word components. </p>
<p> Discrete bit table:May be called by BUNB. BUNW. BDIB. WDIB instruction Table item. How to define the discrete bit table please refer to " <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Instruction_use_table"> instruction use table</a>" section. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bunw.gif"    /></p>
<p> [Program description]</p>
<p> If "read discrete bit table" defineas follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> bit component</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> X3</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> M10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> M301</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> S21</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> M77</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> M100</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td>
                <p> X1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> Y6</td>
        </tr>
    </tbody>
</table>
<p> When M1=ON,BUNW instruction combination bitwise "read discrete bit table" defined bit to start from V0 registers.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Executed result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td> V0?b0 = X3</td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> V0?b1 = M10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td> V0?b2 = M301</td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td> V0?b3 = S21</td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> V0?b4 = M77</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> V0?b5 = M100</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td> V0?b6 = X1</td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> V0?b7 = Y6</td>
        </tr>
    </tbody>
</table>
<h3 id="WUNW_Discrete_word_combination_to_continuous_word">WUNW(Discrete word combination to continuous word)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/wunw.gif"    /></p>
            </td>
            <td>
                <p> WUNW En, Table, Des</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/wunw.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> Table</td>
            <td>
                <p> Discrete register component table</p>
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
            <td> Des</td>
            <td>
                <p> Target start component</p>
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
<p> WUNW instruction use for combination the discrete register which Table define to continuous register components . </p>
<p> Discrete register component table:May be called by WUNW. WDIW instruction Table item. How to define discrete register component table please refer to "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Instruction_use_table"> instruction use table </a>" section. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-wunw.gif"    /></p>
<p> [Program description]</p>
<p> If "read discrete register table " defineas follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> bit component</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> AI1</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> V10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> V106</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> AQ0</p>
            </td>
        </tr>
    </tbody>
</table>
<p> When M0=ON, WUNW instruction combination move the "read discrete register table " defined register to start from V200 continuous component.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Executed result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td> V200 = AI1</td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> V201 = V10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td> V202 = V106</td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td> V203 = AQ0</td>
        </tr>
    </tbody>
</table>
<h3 id="BDIB_Continuous_bit_disperse_to_discrete_bit">BDIB(Continuous bit disperse to discrete bit)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bdib.gif"    /></p>
            </td>
            <td>
                <p> BDIB En, Sou, Table</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bdib.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> ?</td>
        </tr>
        <tr>
            <td> Table</td>
            <td>
                <p> Discrete bit component table </p>
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
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> BDIB instruction use for disperse the bit components start from Sou to discrete bit components defined by Table. </p>
<p> Discrete bit table: may be called by BUNB. BUNW. BDIB. WDIB instruction Table item. How to define the discrete bit table please refer to "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Instruction_use_table"> instruction use table</a>" section. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bdib.gif"    /></p>
<p> [Program description]</p>
<p> If "write discrete bit table " define as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong>Bit component</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> Y4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> M10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> M301</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> S21</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> M77</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> M100</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td>
                <p> Y0</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> Y6</td>
        </tr>
    </tbody>
</table>
<p> When M0=ON,BDIB instruction combination move the start from M500 continuous bit to "write discrete bit table " .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Executed result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td> Y4 = M500</td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> M10 = M501</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td> M301 = M502</td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td> S21= M503 </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> M77= M504</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> M100 = M505</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td> Y0 = M506</td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> Y6 = M507</td>
        </tr>
    </tbody>
</table>
<h3 id="WDIB_Continuous_word_disperse_to_discrete_bit">WDIB(Continuous word disperse to discrete bit)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/wdib.gif"    /></p>
            </td>
            <td>
                <p> WDIB En, Sou, Table</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/wdib.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> ?</td>
        </tr>
        <tr>
            <td> Table</td>
            <td>
                <p> Discrete bit component table </p>
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
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> WDIB instruction use for disperse the bit components start bitwise from Sou register to discrete bit components defined by Table. </p>
<p> Discrete bit table: may be called by BUNB. BUNW. BDIB. WDIB instruction Table item. How to define the discrete bit table please refer to "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Instruction_use_table"> instruction use table</a>" section. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-wdib.gif"    /></p>
<p> [Program description]</p>
<p> If "write discrete bit table " define as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Bit component</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> Y4</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> M10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> M301</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> S21</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> M77</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> M100</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td>
                <p> Y0</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> Y6</td>
        </tr>
    </tbody>
</table>
<p> When M1=ON, WDIB instruction discrete bitwise the start from V0 register to "write discrete bit table" defined bit components .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Executed result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td> Y4 = V0?b0</td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> M10 = V0?b1</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td> M301 = V0?b2</td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td> S21= V0?b3 </td>
        </tr>
        <tr>
            <td>
                <p> 5</p>
            </td>
            <td> M77= V0?b4</td>
        </tr>
        <tr>
            <td>
                <p> 6</p>
            </td>
            <td> M100 = V0?b5</td>
        </tr>
        <tr>
            <td>
                <p> 7</p>
            </td>
            <td> Y0 = V0?b6</td>
        </tr>
        <tr>
            <td>
                <p> 8</p>
            </td>
            <td> Y6 = V0?b7</td>
        </tr>
    </tbody>
</table>
<h3 id="WDIW_Continuous_word_disperse_to_discrete_word">WDIW(Continuous word disperse to discrete word)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/wdiw.gif"    /></p>
            </td>
            <td>
                <p> WDIW En, Sou, Table</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/wdiw.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> ?</td>
        </tr>
        <tr>
            <td> Table</td>
            <td>
                <p> Discrete register component table </p>
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
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> WDIW instruction use for disperse the registers start from Sou register to discrete registers defined by Table. </p>
<p> Discrete register component table: may be called by WUNW. WDIW instruction Table item. How to defined discrete register component table please refer to "
    <a href="/plc/haiwell-plc-programming-software/Programming_operation_manual/#Instruction_use_table"> instruction use table</a>" section. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-wdiw.gif"    /></p>
<p> [Program description]</p>
<p> If " write discrete register table" define as follows:</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Bit component</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td>
                <p> V90</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> V10</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td>
                <p> V106</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td>
                <p> AQ0</p>
            </td>
        </tr>
    </tbody>
</table>
<p> When M0=ON, WDIW instruction discrete the register start from V200 to "read discrete register table " defined discrete register.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sequence number</strong> </p>
            </td>
            <td>
                <p> <strong> Executed result </strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> 1</p>
            </td>
            <td> V90 = V200</td>
        </tr>
        <tr>
            <td>
                <p> 2</p>
            </td>
            <td> V10 = V201</td>
        </tr>
        <tr>
            <td>
                <p> 3</p>
            </td>
            <td> V106 = V202</td>
        </tr>
        <tr>
            <td>
                <p> 4</p>
            </td>
            <td> AQ0 = V203</td>
        </tr>
    </tbody>
</table>
<h3 id="BCD_D_BCD_BIN_convert_to_BCD">BCD. D.BCD(BIN convert to BCD)</h3>
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
                <p> 16,32 bit </p>
                <p> Instruction format</p>
            </td>
            <td colspan="2">
                <p> <img src="<?= $path_to_images ?>images/bcd.gif"    /> <img src="<?= $path_to_images ?>images/d.bcd.gif"    /></p>
            </td>
            <td>
                <p> BCD En, In, Out</p>
                <p> D.BCD En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bcd_bin.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Input</p>
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
<p> 1. BCD instruction (D.BCD is 32 bit instruction) use for convert the value to BCD code. </p>
<p> 2. 16 bit instruction value input range is 0~9999,32 bit instruction value input range is 0~99999999,In exceed range then instruction not execute.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bcd.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,BCD instruction convert V1000 value to BCD code result to V0,D.BCD instruction convert V1001V1002 value to result to V10V11,as follows table.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value </strong></p>
            </td>
            <td>
                <p> <strong>BCD convert result</strong></p>
            </td>
            <td>
                <p> <strong>D.BCD convert result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td> 2345</td>
            <td> V0 = 0x2345</td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V1001V1002</p>
            </td>
            <td> 48702861</td>
            <td> ?</td>
            <td> V10V11 = 0x48702861</td>
        </tr>
    </tbody>
</table>
<h3 id="BIN_D_BIN_BCD_convert_to_BIN">BIN. D.BIN(BCD convert to BIN)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bin.gif"    /> <img src="<?= $path_to_images ?>images/d.bin.gif"    /></p>
            </td>
            <td>
                <p> BIN En, In, Out</p>
                <p> D.BIN En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bcd_bin.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Input</p>
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
<p> 1. BIN instruction (D.BIN is 32 bit instruction) use for convert BCD code to value.</p>
<p> 2. BCD code (Binary-coded Decimal?) also name binary code decimal numbers. binary-decimal code or 8421 code, that is expand the decimal number to binary number according to 8421 model .BCD code is four digit binary code, that is convert decimal number to binary number , but different from the general convert , each decimal number 0-9 corresponding a four digit binary code,corresponding relation as follows: decimal 0 corresponding 0000; decimal 1 corresponding 0001 ....... decimal 9 corresponding 1001, following 10 express in above-mentioned 2 code, decimal 10 express is 00010000, that is BCD code come across 1001 generate carry bit , unlike general binary code reach 1111 general carry bit 10000.</p>
<p> 3. If In input contain not BCD code (contain 0xA. 0xB. 0xC. 0xD. 0xE. 0xF) then instruction not execute.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bin.gif"    /></p>
<p> [Program description]</p>
<p> When M1=ON,BIN instruction convert the BCD code of V1100 to value result to V20,D.BIN instruction convert the BCD code of V1101V1102 to value result to V30V31,as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value</strong></p>
            </td>
            <td>
                <p> <strong>BIN convert result</strong></p>
            </td>
            <td>
                <p> <strong>D.BIN convert result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1100</p>
            </td>
            <td> 0x3938</td>
            <td> V20 = 3938</td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p> V1101V1102</p>
            </td>
            <td> 0x35344241</td>
            <td> ?</td>
            <td> V30V31 = 35344241</td>
        </tr>
    </tbody>
</table>
<h3 id="ITOL_Integer_convert_to_long_integer">ITOL(Integer convert to long integer)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/itol.gif"    /></p>
            </td>
            <td>
                <p> ITOL En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/itol.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Input</p>
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
            <td> Occupy 2 continuous component</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> ITOL instruction use for convert 16 bit integer to 32 bit long integer .</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-itol.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,ITOL instruction convert V1000 to long integer result to V0V1, convert V1001 to long integer result to V2V3,as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value</strong></p>
            </td>
            <td>
                <p> <strong> convert result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td> 4648</td>
            <td> V0V1 = 4648</td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td> -16961</td>
            <td> V2V3 = -16961</td>
        </tr>
    </tbody>
</table>
<h3 id="GRAY_BIN_convert_to_GRAY_code">GRAY(BIN convert to GRAY code)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/gray.gif"    /></p>
            </td>
            <td>
                <p> GRAY En, In, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/gray_gbin.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td>
                <p> In is bit component occupy N continuous component, is register component occupy (N-1)\16+1 continuous component</p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> GRAY code length</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> 1-32 </p>
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
            <td> Out</td>
            <td>
                <p> Output</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td> Out is bit component occupy N continuous component, is register component occupy (N-1)\16+1 continuous component</td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. GRAY instruction use for convert value to gray code. </p>
<p> 2. In must &gt;0 then instruction not execute.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-gray.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, convert the low 7 bits of V0 to gray code output to Y0~Y6,convert M10~M16 to gray code output to V10.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> Value </p>
            </td>
            <td>
                <p> <strong>Convert to gray code result</strong></p>
            </td>
        </tr>
        <tr>
            <td rowspan="7">
                <p> V0</p>
            </td>
            <td rowspan="7">
                <p> 25</p>
            </td>
            <td>
                <p> Y0=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y1=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y2=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y3=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y4=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y5=OFF </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y6=OFF </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M10</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td rowspan="7">
                <p> V10=21</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M11</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M12 </p>
            </td>
            <td>
                <p> OFF </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M13</p>
            </td>
            <td>
                <p> ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M14</p>
            </td>
            <td>
                <p> ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M15</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M16</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="GBIN_GRAY_code_convert_to_BIN">GBIN(GRAY code convert to BIN)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/gbin.gif"    /></p>
            </td>
            <td>
                <p> GBIN En, In, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/gray_gbin.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td>
                <p> In is bit component occupy N continuous component, is register component occupy (N-1)\16+1 continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> GRAY code length</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> 1-32 </p>
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
            <td>
                <p>?</p>
            </td>
        </tr>
        <tr>
            <td> Out</td>
            <td>
                <p> Output</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Out is bit component occupy N continuous component, is register component occupy (N-1)\16+1 continuous component</p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. GBIN instruction use for convert gray code to value. </p>
<p> 2. In must &gt;0 then instruction not execute.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-gbin.gif"    /></p>
<p> [Program description]</p>
<p> When M1=ON, convert Y0~Y6 gray code to value output to V20, convert the gray code of the low 7 bits of V10 to value output to M100~M106.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> Value </p>
            </td>
            <td>
                <p> <strong>Gray code convert to value</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y0</p>
            </td>
            <td>
                <p> ON</p>
            </td>
            <td rowspan="7">
                <p> V20=25</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y1</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y2 </p>
            </td>
            <td>
                <p> ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y3</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y4</p>
            </td>
            <td>
                <p> ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y5</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Y6</p>
            </td>
            <td>
                <p> OFF</p>
            </td>
        </tr>
        <tr>
            <td rowspan="7">
                <p> V10</p>
            </td>
            <td rowspan="7">
                <p> 21</p>
            </td>
            <td>
                <p> M100=ON </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M101=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M102=OFF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M103=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M104=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M105=OFF </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> M106=OFF </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="Character_instruction">Character instruction</h3>
<hr>
<p> Character instruction list as follows </p>
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
            <td> <a href="#GHLB_Obtain_high_low_byte">GHLB</a></td>
            <td> ?</td>
            <td> ?</td>
            <td> Obtain high low byte</td>
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
            <td> <a href="#GETB_Capture_byte_string">GETB</a></td>
            <td> ?</td>
            <td> ?</td>
            <td> Capture byte string</td>
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
            <td> <a href="#BCMP_BCMP_LB_Byte_string_comparison">BCMP</a></td>
            <td> BCMP.LB</td>
            <td> ?</td>
            <td> Byte string comparison</td>
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
            <td> <a href="#ITOC_D_ITOC_Integer_convert_to_character"> ITOC</a></td>
            <td> ?</td>
            <td>
                <p> D.ITOC</p>
            </td>
            <td> Integer convert to character</td>
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
            <td> <a href="#CTOI_Character_convert_to_integer"> CTOI</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> Character convert to integer</td>
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
            <td> <a href="#FTOC_Floating_point_convert_to_character"> FTOC</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> Floating point convert to character</td>
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
            <td> <a href="#CTOF_Character_convert_to_floating_point"> CTOF</a></td>
            <td>
                <p> ?</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> Character convert to floating point</td>
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
<h3 id="GHLB_Obtain_high_low_byte">GHLB(Obtain high low byte)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/ghlb.gif"    /></p>
            </td>
            <td>
                <p> GHLB En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/ghlb.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Occupy 2N continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> GHLB instruction separate the high low byte of start from Sou N registers low byte output to Out. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-ghlb.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, separate high low byte of V1000~V1004 output to V0~V9.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Value </p>
            </td>
            <td>
                <p> <strong>Output component</strong></p>
            </td>
            <td>
                <p> <strong>Output result</strong></p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1000</p>
            </td>
            <td rowspan="2">
                <p> 0x001E</p>
            </td>
            <td>
                <p> V0</p>
            </td>
            <td>
                <p> 0x1E</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1</p>
            </td>
            <td>
                <p> 0x00 </p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1001</p>
            </td>
            <td rowspan="2">
                <p> 0xFF6A</p>
            </td>
            <td>
                <p> V2</p>
            </td>
            <td>
                <p> 0x6A</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V3</p>
            </td>
            <td>
                <p> 0xFF</p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1002</p>
            </td>
            <td rowspan="2">
                <p> 0x0E19 </p>
            </td>
            <td>
                <p> V4</p>
            </td>
            <td>
                <p> 0x19</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V5</p>
            </td>
            <td>
                <p> 0x0E</p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1003</p>
            </td>
            <td rowspan="2">
                <p> 0x1208</p>
            </td>
            <td>
                <p> V6</p>
            </td>
            <td>
                <p> 0x08</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V7</p>
            </td>
            <td>
                <p> 0x12</p>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <p> V1004</p>
            </td>
            <td rowspan="2">
                <p> 0x0D5F</p>
            </td>
            <td>
                <p> V8</p>
            </td>
            <td>
                <p> 0x5F</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V9</p>
            </td>
            <td>
                <p> 0x0D</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="GETB_Capture_byte_string">GETB(Capture byte string)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/getb.gif"    /></p>
            </td>
            <td>
                <p> GETB En, Sou, Start, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/getb.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td> Sou</td>
            <td>
                <p> Source start component </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> </td>
            <td>
                <p> Occupy (Start+N)\2 continuous component </p>
            </td>
        </tr>
        <tr>
            <td> Start</td>
            <td>
                <p> The start byte sequence number </p>
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
                <p> Number of bytes</p>
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
                <p> Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy (N+1)\2 continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> GETB instruction capture N bytes from start byte of the byte string start from Sou. </p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-getb.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, capture 7 bytes from second byte of the byte string start from V1000 ,output to V0~V3.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>Sou component</strong></p>
            </td>
            <td>
                <p> Value </p>
            </td>
            <td>
                <p> <strong>Output component</strong></p>
            </td>
            <td>
                <p> <strong>Output result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 0x011E</p>
            </td>
            <td>
                <p> V0</p>
            </td>
            <td>
                <p> 0x6A01</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 0xFF6A</p>
            </td>
            <td>
                <p> V1</p>
            </td>
            <td>
                <p> 0x19FF</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002</p>
            </td>
            <td>
                <p> 0x0E19 </p>
            </td>
            <td>
                <p> V2</p>
            </td>
            <td>
                <p> 0x080E</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 0x1208</p>
            </td>
            <td>
                <p> V3</p>
            </td>
            <td>
                <p> 0x0012</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 0x0D5F</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<h3 id="BCMP_BCMP_LB_Byte_string_comparison">BCMP. BCMP.LB(Byte string comparison)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/bcmp.gif"    /> <img src="<?= $path_to_images ?>images/bcmp.lb.gif"    /></p>
            </td>
            <td>
                <p> BCMP En, In1, In2, N, Out</p>
                <p> BCMP.LB En, In1, In2, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/bcmp.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Compare byte string 1 </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> BCMP occupy (N+1)\2 continuous component, BCMP.LB occupy N continuous component</p>
            </td>
        </tr>
        <tr>
            <td> In2</td>
            <td>
                <p> Compare byte string 2 </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> BCMP occupy (N+1)\2 continuous component, BCMP.LB occupy N continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Compare number of bytes </p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td> 1~256</td>
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
<p> BCMP instruction compare the byte string of In1 and In2,compare n bytes, if equal to then Out=ON, no then Out=OFF. BCMP.LB is low byte model, only compare low byte part.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-bcmp.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, compare byte string V1000~V1004 and byte string V1010~V1014 ,BCMP instruction compare 7 bytes,BCMP.LB instruction compare 5 low byte.</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In1 component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>In2 component</strong></p>
            </td>
            <td>
                <p> Initial value </p>
            </td>
            <td>
                <p> <strong>Compare result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td>
                <p> 0x011E</p>
            </td>
            <td>
                <p> V1010</p>
            </td>
            <td>
                <p> 0x011E</p>
            </td>
            <td rowspan="5">
                <p> M100=OFF</p>
                <p>?</p>
                <p> M101=ON</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1001</p>
            </td>
            <td>
                <p> 0xFF6A</p>
            </td>
            <td>
                <p> V1011</p>
            </td>
            <td>
                <p> 0x026A</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1002</p>
            </td>
            <td>
                <p> 0x0E19 </p>
            </td>
            <td>
                <p> V1012</p>
            </td>
            <td>
                <p> 0x0019 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1003</p>
            </td>
            <td>
                <p> 0x1208</p>
            </td>
            <td>
                <p> V1013</p>
            </td>
            <td>
                <p> 0x1208</p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1004</p>
            </td>
            <td>
                <p> 0x0D5F</p>
            </td>
            <td>
                <p> V1014</p>
            </td>
            <td>
                <p> 0x5D5F</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="ITOC_D_ITOC_Integer_convert_to_character">ITOC. D.ITOC(Integer convert to character)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/itoc.gif"    /> <img src="<?= $path_to_images ?>images/d.itoc.gif"    /></p>
            </td>
            <td>
                <p> ITOC En, In, Out</p>
                <p> D.ITOC En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/itoc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Output</p>
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
<p> ITOC instruction use for integer convert to character ,D.ITOC use for long integer convert to character. Output automatic occupy 6 continuous register , total can express12 characters, if convert result not enough 12 characters then the behind register filled by the blank space.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-itoc.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, ITOC convert V1000 integer to character output to V0~V5,D.ITOC convert V1001V1002 long integer to character output to V10~V15,as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value</strong></p>
            </td>
            <td>
                <p> <strong> convert result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000</p>
            </td>
            <td> 286</td>
            <td> V0~V5 ="286"</td>
        </tr>
        <tr>
            <td>
                <p> V1001V1002</p>
            </td>
            <td> -2584810</td>
            <td> V10~V15 =" -2584810"</td>
        </tr>
    </tbody>
</table>
<h3 id="CTOI_Character_convert_to_integer">CTOI(Character convert to integer)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/ctoi.gif"    /></p>
            </td>
            <td>
                <p> CTOI En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/ctoi.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Source start component</p>
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
            <td> N</td>
            <td>
                <p> Convert character number</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> N range :1~11</p>
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
            <td> Out</td>
            <td>
                <p> Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy 2 continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. CTOI use for convert N character start Sou to long integer , if convert result exceed long integer range then not convert moreover Eno is 0(OFF),Out maintain original not changed . </p>
<p> 2. N is will be converted character number, valid range 1~11,if exceed range then not convert moreover Eno=OFF, Out maintain original not changed . </p>
<p> 3. If will be converted character contain illegal character( except 0 ~ 9. +. - character), replace space to ahead , lop back .For example: character '123'. '123dfg'. 'A123' convert result all re integer 123.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-ctoi.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON, CTOI convert character 7 characters of V1000~V1005 to integer output to V0V1, convert 9 characters of V1010~V1015 to integer output to V2V3,as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value</strong></p>
            </td>
            <td>
                <p> <strong> convert result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000~V1005</p>
            </td>
            <td> "1234567890"</td>
            <td> V0V1 =1234567</td>
        </tr>
        <tr>
            <td>
                <p> V1010~V1015</p>
            </td>
            <td> "-987654321"</td>
            <td> V2V3 =-98765432</td>
        </tr>
    </tbody>
</table>
<h3 id="FTOC_Floating_point_convert_to_character">FTOC(Floating point convert to character)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/ftoc.gif"    /></p>
            </td>
            <td>
                <p> FTOC En, In, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/ftoc.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
            <td>
                <p> Occupy 2 continuous component </p>
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
            <td> Out</td>
            <td>
                <p> Output</p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy 6 continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> FTOC instruction use for floating point convert to character.Output automatic occupy 6 continuous register ,total can express12 character, if convert result not enough 12 characters then the behind register filled by the blank space.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-ftoc.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,FTOC use for convert floating point V1000V1001 to character output to V0~V5, convert floating point V1002V1003 to character output to V10~V15,as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value</strong></p>
            </td>
            <td>
                <p> <strong> convert result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000V1001</p>
            </td>
            <td> 23.4567</td>
            <td> V0~V5 ="23.4567"</td>
        </tr>
        <tr>
            <td>
                <p> V1002V1003</p>
            </td>
            <td> -2987.56</td>
            <td> V10~V15 =" -2987.56"</td>
        </tr>
    </tbody>
</table>
<h3 id="CTOF_Character_convert_to_floating_point">CTOF(Character convert to floating point)</h3>
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
                <p> <img src="<?= $path_to_images ?>images/ctof.gif"    /></p>
            </td>
            <td>
                <p> CTOF En, Sou, N, Out</p>
            </td>
            <td>
                <p> <a href="<?= $path_to_images ?>program/ctof.gpc"> <img src="<?= $path_to_images ?>images/button1.gif" alt="Download"    /></a></p>
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
                <p> Occupy 6 continuous component </p>
            </td>
        </tr>
        <tr>
            <td> N</td>
            <td>
                <p> Convert character number</p>
            </td>
            <td>
                <p> v</p>
            </td>
            <td> ?</td>
            <td>
                <p> N range :1~11</p>
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
            <td> Out</td>
            <td>
                <p> Output </p>
            </td>
            <td>
                <p> ?</p>
            </td>
            <td> v</td>
            <td>
                <p> Occupy 2 continuous component </p>
            </td>
        </tr>
    </tbody>
</table>
<p> [Instruction function and effect declare] </p>
<p> 1. CTOF convert N characters start from Sou to floating point, if convert result exceed floating point range then not convert moreover Eno is 0(OFF),Out maintain original not changed . </p>
<p> 2. N is number of character be converted, valid range 1~11, if exceed range then not convert moreover Eno=OFF,Out maintain original not changed . </p>
<p> 3. If the character be converted contain illegal character( except 0 ~ 9. .. +. - character), eplace space to ahead , lop back .For example: character '1.23'. '1.23dfg'. 'A1.23' convert result all are floating point 1.23.</p>
<p> [Instruction example]</p>
<p> <img src="<?= $path_to_images ?>images/gpc-ctof.gif"    /></p>
<p> [Program description]</p>
<p> When M0=ON,CTOF convert 7 characters of V1000~V1005 to floating point output to V0V1, convert 9 characters of V1010~V1015 to floating point output to V2V3,as follows table .</p>
<table>
    <tbody>
        <tr>
            <td>
                <p> <strong>In component</strong></p>
            </td>
            <td>
                <p> <strong>Initial value</strong></p>
            </td>
            <td>
                <p> <strong> convert result</strong></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> V1000~V1005</p>
            </td>
            <td> "1234.67890"</td>
            <td> V0V1 =1234.67</td>
        </tr>
        <tr>
            <td>
                <p> V1010~V1015</p>
            </td>
            <td> "-98.654321"</td>
            <td> V2V3 =-98.65432</td>
        </tr>
    </tbody>
</table>