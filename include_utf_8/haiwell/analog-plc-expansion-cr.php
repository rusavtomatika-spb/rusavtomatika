<h2>Таблица регистров</h2>
<table>
    <colgroup><col><col></colgroup>
    <tbody>
        <tr>
            <td>Номер регистра</td>
            <td>Функция</td>
        </tr>
        <tr>
            <td>00H <span style="color:red;">(Только для чтения)</span></td>
            <td>The low byte is the module code, and the high byte is the module version number.</td>
        </tr>
        <tr>
            <td>01H</td>
            <td>Communication address</td>
        </tr>
        <tr>
            <td rowspan="2">02H</td>
            <td>Communication protocol: The low 4-bit of the low bytes:0 - N,8,2 For RTU?1 - E,8,1 For RTU?<br>
                2 - O,8,1 For RTU?3 - N,7,2 For ASCII?4 - E,7,1 For ASCII?5 - O,7,1 For ASCII?6 - N,8, <br>
                1 For RTU
            </td>
        </tr>
        <tr>
            <td>The high 4-bit of the low bytes: 0 – 2400?1 – 4800?2 – 9600?3 – 19200?4 – 38400?<br>
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
            <td>09~0AH <span style="color:red;">(Только для чтения)</span></td>
            <td>Reserve</td>
        </tr>
        <tr>
            <td>0BH</td>
            <td>High byte subnet mask(b3~b0,1 indicates 255,0 indicates 0 , for example, subnet mask <br>
                255.255.255.0, b3~b0=1110), low byte Reserved
            </td>
        </tr>
        <tr>
            <td>0CH~0EH <span style="color:red;">(Только для чтения)</span></td>
            <td>Reserve</td>
        </tr>
        <tr>
            <td>0FH <span style="color:red;">(Только для чтения)</span></td>
            <td>Error code: 0-Normal, 1-Illegally firmware identity, 2-Incomplete firmware, 3-System data access<br>
                exception, 4-No external 24V power supply
            </td>
        </tr>
        <tr>
            <td>10H <span style="color:red;">(Только для чтения)</span></td>
            <td>The input value of channel 1</td>
        </tr>
        <tr>
            <td>11H <span style="color:red;">(Только для чтения)</span></td>
            <td>The input value of channel 2</td>
        </tr>
        <tr>
            <td>12H <span style="color:red;">(Только для чтения)</span></td>
            <td>The input value of channel 3</td>
        </tr>
        <tr>
            <td>13H <span style="color:red;">(Только для чтения)</span></td>
            <td>The input value of channel 4</td>
        </tr>
        <tr>
            <td>14H</td>
            <td>The signal type of intput channel 1, note 2</td>
        </tr>
        <tr>
            <td>15H</td>
            <td>The signal type of intput channel 2, note 2</td>
        </tr>
        <tr>
            <td>16H</td>
            <td>The signal type of intput channel 3, note 2</td>
        </tr>
        <tr>
            <td>17H</td>
            <td>The signal type of intput channel 4, note 2</td>
        </tr>
        <tr>
            <td>18H</td>
            <td>Use the engineering value mark, note 6</td>
        </tr>
        <tr>
            <td>19H</td>
            <td>The lower limit in engineering value of input channel 1</td>
        </tr>
        <tr>
            <td>1AH</td>
            <td>The lower limit in engineering value of input channel 2</td>
        </tr>
        <tr>
            <td>1BH</td>
            <td>The lower limit in engineering value of input channel 3</td>
        </tr>
        <tr>
            <td>1CH</td>
            <td>The lower limit in engineering value of input channel 4</td>
        </tr>
        <tr>
            <td>1DH</td>
            <td>The upper limit in engineering value of input channel 1</td>
        </tr>
        <tr>
            <td>1EH</td>
            <td>The upper limit in engineering value of input channel 2</td>
        </tr>
        <tr>
            <td>1FH</td>
            <td>The upper limit in engineering value of input channel 3</td>
        </tr>
        <tr>
            <td>20H</td>
            <td>The upper limit in engineering value of input channel 4</td>
        </tr>
        <tr>
            <td>21H</td>
            <td>The sampling frequency of input channel 1, note 1</td>
        </tr>
        <tr>
            <td>22H</td>
            <td>The sampling frequency of input channel 2, note 1</td>
        </tr>
        <tr>
            <td>23H</td>
            <td>The sampling frequency of input channel 3, note 1</td>
        </tr>
        <tr>
            <td>24H</td>
            <td>The sampling frequency of input channel 4, note 1</td>
        </tr>
        <tr>
            <td>25H</td>
            <td>The zero point correction value of input channel 1</td>
        </tr>
        <tr>
            <td>26H</td>
            <td>The zero point correction value of input channel 2</td>
        </tr>
        <tr>
            <td>27H</td>
            <td>The zero point correction value of input channel 3</td>
        </tr>
        <tr>
            <td>28H</td>
            <td>The zero point correction value of input channel 4</td>
        </tr>
        <tr>
            <td>29H <span style="color:red;">(Только для чтения)</span></td>
            <td>Channel 1~4 input disconnection alarm, note 5</td>
        </tr>
        <tr>
            <td>2AH</td>
            <td>The output value of output channel 1  </td>
        </tr>
        <tr>
            <td>2BH</td>
            <td>The output value of output channel 2</td>
        </tr>
        <tr>
            <td>2CH</td>
            <td>The output value of output channel 3</td>
        </tr>
        <tr>
            <td>2DH</td>
            <td>The output value of output channel 4</td>
        </tr>
        <tr>
            <td>2EH</td>
            <td>The signal type of output channel 1, note 2</td>
        </tr>
        <tr>
            <td>2FH</td>
            <td>The signal type of output channel 2, note 2</td>
        </tr>
        <tr>
            <td>30H</td>
            <td>The signal type of output channel 3, note 2</td>
        </tr>
        <tr>
            <td>31H</td>
            <td>The signal type of output channel 4, note 2</td>
        </tr>
        <tr>
            <td>32H</td>
            <td>Use the engineering value mark, note 6</td>
        </tr>
        <tr>
            <td>33H</td>
            <td>The lower limit in engineering value of output channel 1</td>
        </tr>
        <tr>
            <td>34H</td>
            <td>The lower limit in engineering value of output channel 2</td>
        </tr>
        <tr>
            <td>35H</td>
            <td>The lower limit in engineering value of output channel 3</td>
        </tr>
        <tr>
            <td>36H</td>
            <td>The lower limit in engineering value of output channel 4</td>
        </tr>
        <tr>
            <td>37H</td>
            <td>The upper limit in engineering value of output  channel 1</td>
        </tr>
        <tr>
            <td>38H</td>
            <td>The upper limit in engineering value of output  channel 2</td>
        </tr>
        <tr>
            <td>39H</td>
            <td>The upper limit in engineering value of output  channel 3</td>
        </tr>
        <tr>
            <td>3AH</td>
            <td>The upper limit in engineering value of output  channel 4</td>
        </tr>
        <tr>
            <td>3BH</td>
            <td>The power-off output mark, note 8</td>
        </tr>
        <tr>
            <td>3CH</td>
            <td>The power-off output value of output channel 1</td>
        </tr>
        <tr>
            <td>3DH</td>
            <td>The power-off output value of output channel 2</td>
        </tr>
        <tr>
            <td>3EH</td>
            <td>The power-off output value of output channel 3</td>
        </tr>
        <tr>
            <td>3FH</td>
            <td>The power-off output value of output channel 4</td>
        </tr>
        <tr>
            <td>40H <span style="color:red;">(Только для чтения)</span></td>
            <td>Output channel indicator, note 7</td>
        </tr>
        <tr>
            <td>41H <span style="color:red;">(Только для чтения)</span></td>
            <td>Reserve</td>
        </tr>
        <tr>
            <td>42H~4FH <span style="color:red;">(Только для чтения)</span></td>
            <td><br>
            </td>
        </tr>
    </tbody>
</table>