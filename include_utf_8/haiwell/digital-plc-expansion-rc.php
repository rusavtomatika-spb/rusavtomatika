<table>
    <colgroup><col/><col/></colgroup>
    <tbody>
        <tr>
            <td>Номер регистра</td>
            <td>Функция</td>
        </tr>
        <tr>
            <td>00H  <span style="color:red;">(Только для чтения)</span></td>
            <td>The low byte is the module code, and the high byte is the module version number.</td>
        </tr>
        <tr>
            <td>01H</td>
            <td>Communication address</td>
        </tr>
        <tr>
            <td rowspan="2">02H</td>
            <td>Communication protocols:The low 4-bit of the low bytes: 0 - N,8,2 For RTU?1 - E,8,1 For RTU?<br/>
                2 - O,8,1 For RTU?3 - N,7,2 For ASCII?4 - E,7,1 For ASCII?5 - O,7,1 For ASCII?6 - N,8, 1 For <br/>
                RTU
            </td>
        </tr>
        <tr>
            <td>The high 4-bit of the low bytes: 0 – 2400?1 – 4800?2 – 9600?3 – 19200?4 – 38400?<br/>
                5 – 57600?6 - 115200
            </td>
        </tr>
        <tr>
            <td>03H~06H</td>
            <td>Extend module name</td>
        </tr>
        <tr>
            <td>07H~08H</td>
            <td>Default IP address: 192.168.1.111</td>
        </tr>
        <tr>
            <td>09~0AH  <span style="color:red;">(Только для чтения)</span></td>
            <td>Reserve</td>
        </tr>
        <tr>
            <td>0BH</td>
            <td>High byte subnet mask (b3~b0,1 indicates 255, 0 indicates 0, for example, subnet mask <br/>
                255.255.255.0, b3~b0=1110), low byte reserved
            </td>
        </tr>
        <tr>
            <td>0CH~0EH  <span style="color:red;">(Только для чтения)</span></td>
            <td>Reserve</td>
        </tr>
        <tr>
            <td>0FH  <span style="color:red;">(Только для чтения)</span></td>
            <td>Error code : 0-normal, 1-illegal firmware identity ,2-incomplete firmware, 3-system data access<br/>
                exception, 4-No external 24V power supply
            </td>
        </tr>
        <tr>
            <td>10H~4FH  <span style="color:red;">(Только для чтения)</span></td>
            <td>DI channel 1~64 input value</td>
        </tr>
        <tr>
            <td>50H~8FH</td>
            <td>DO channel 1~64 output value</td>
        </tr>
        <tr>
            <td>90H</td>
            <td>Filtering time of DI ms, 0 - 0.8?1 - 1.6?2 - 3.2?3 - 6.4?4 - 12.8?5 - 25.6?6 - 51.2</td>
        </tr>
        <tr>
            <td>91H~9FH  <span style="color:red;">(Только для чтения)</span></td>
            <td>Reserve</td>
        </tr>
    </tbody>
</table>