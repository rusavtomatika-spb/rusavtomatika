<h3>“ехнические характеристики</h3>

<table>
    <colgroup><col/><col/></colgroup>
    <tbody>
        <tr>
            <td>CR&nbsp;Number</td>
            <td>Function&nbsp;Declare</td>
        </tr>
        <tr>
            <td>00H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;low&nbsp;byte&nbsp;is&nbsp;the&nbsp;module&nbsp;code,&nbsp;and&nbsp;the&nbsp;high&nbsp;byte&nbsp;is&nbsp;the&nbsp;module&nbsp;version&nbsp;number.</td>
        </tr>
        <tr>
            <td>01H</td>
            <td>Communication&nbsp;address</td>
        </tr>
        <tr>
            <td rowspan="2">02H</td>
            <td>Communication&nbsp;protocol:&nbsp;The&nbsp;low&nbsp;4-bit&nbsp;of&nbsp;the&nbsp;low&nbsp;bytes:0&nbsp;-&nbsp;N,8,2&nbsp;For&nbsp;RTU?1&nbsp;-&nbsp;E,8,1&nbsp;For&nbsp;RTU?<br/>
                2&nbsp;-&nbsp;O,8,1&nbsp;For&nbsp;RTU?3&nbsp;-&nbsp;N,7,2&nbsp;For&nbsp;ASCII?4&nbsp;-&nbsp;E,7,1&nbsp;For&nbsp;ASCII?5&nbsp;-&nbsp;O,7,1&nbsp;For&nbsp;ASCII?6&nbsp;-&nbsp;N,8,&nbsp;<br/>
                1&nbsp;For&nbsp;RTU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
        <tr>
            <td>The&nbsp;high&nbsp;4-bit&nbsp;of&nbsp;the&nbsp;low&nbsp;bytes:&nbsp;0&nbsp;Ц&nbsp;2400?1&nbsp;Ц&nbsp;4800?2&nbsp;Ц&nbsp;9600?3&nbsp;Ц&nbsp;19200?4&nbsp;Ц&nbsp;38400?<br/>
                5&nbsp;Ц&nbsp;57600?6&nbsp;-&nbsp;115200
            </td>
        </tr>
        <tr>
            <td>03H~06H</td>
            <td>Extend&nbsp;module&nbsp;name</td>
        </tr>
        <tr>
            <td>07H~08H</td>
            <td>Default&nbsp;IP&nbsp;address:&nbsp;192.168.1.111</td>
        </tr>
        <tr>
            <td>09~0AH&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>Reserve</td>
        </tr>
        <tr>
            <td>0BH</td>
            <td>High&nbsp;byte&nbsp;subnet&nbsp;mask(b3~b0,1&nbsp;indicates&nbsp;255,0&nbsp;indicates&nbsp;0&nbsp;,&nbsp;for&nbsp;example,&nbsp;subnet&nbsp;mask&nbsp;<br/>
                255.255.255.0,&nbsp;b3~b0=1110),&nbsp;low&nbsp;byte&nbsp;Reserved
            </td>
        </tr>
        <tr>
            <td>0CH~0EH&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>Reserve</td>
        </tr>
        <tr>
            <td>0FH&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>Error&nbsp;code:&nbsp;0-Normal,&nbsp;1-Illegally&nbsp;firmware&nbsp;identity,&nbsp;2-Incomplete&nbsp;firmware,&nbsp;3-System&nbsp;data&nbsp;access<br/>
                &nbsp;exception,&nbsp;4-No&nbsp;external&nbsp;24V&nbsp;power&nbsp;supply
            </td>
        </tr>
        <tr>
            <td>10H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;input&nbsp;value&nbsp;of&nbsp;channel&nbsp;1</td>
        </tr>
        <tr>
            <td>11H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;input&nbsp;value&nbsp;of&nbsp;channel&nbsp;2</td>
        </tr>
        <tr>
            <td>12H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;input&nbsp;value&nbsp;of&nbsp;channel&nbsp;3</td>
        </tr>
        <tr>
            <td>13H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;input&nbsp;value&nbsp;of&nbsp;channel&nbsp;4</td>
        </tr>
        <tr>
            <td>14H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;input&nbsp;value&nbsp;of&nbsp;channel&nbsp;5</td>
        </tr>
        <tr>
            <td>15H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;input&nbsp;value&nbsp;of&nbsp;channel&nbsp;6</td>
        </tr>
        <tr>
            <td>16H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;input&nbsp;value&nbsp;of&nbsp;channel&nbsp;7</td>
        </tr>
        <tr>
            <td>17H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>The&nbsp;input&nbsp;value&nbsp;of&nbsp;channel&nbsp;8</td>
        </tr>
        <tr>
            <td>18H</td>
            <td>The&nbsp;signal&nbsp;type&nbsp;of&nbsp;channel&nbsp;1,&nbsp;note&nbsp;2</td>
        </tr>
        <tr>
            <td>19H</td>
            <td>The&nbsp;signal&nbsp;type&nbsp;of&nbsp;channel&nbsp;2,&nbsp;note&nbsp;2</td>
        </tr>
        <tr>
            <td>1AH</td>
            <td>The&nbsp;signal&nbsp;type&nbsp;of&nbsp;channel&nbsp;1,&nbsp;note&nbsp;2</td>
        </tr>
        <tr>
            <td>1BH</td>
            <td>The&nbsp;signal&nbsp;type&nbsp;of&nbsp;channel&nbsp;4,&nbsp;note&nbsp;2</td>
        </tr>
        <tr>
            <td>1CH</td>
            <td>The&nbsp;signal&nbsp;type&nbsp;of&nbsp;channel&nbsp;5,&nbsp;note&nbsp;2</td>
        </tr>
        <tr>
            <td>1DH</td>
            <td>The&nbsp;signal&nbsp;type&nbsp;of&nbsp;channel&nbsp;6,&nbsp;note&nbsp;2</td>
        </tr>
        <tr>
            <td>1EH</td>
            <td>The&nbsp;signal&nbsp;type&nbsp;of&nbsp;channel&nbsp;7,&nbsp;note&nbsp;2</td>
        </tr>
        <tr>
            <td>1FH</td>
            <td>The&nbsp;signal&nbsp;type&nbsp;of&nbsp;channel&nbsp;8,&nbsp;note&nbsp;2</td>
        </tr>
        <tr>
            <td>20H</td>
            <td>Use&nbsp;the&nbsp;engineering&nbsp;value&nbsp;mark,&nbsp;note&nbsp;6</td>
        </tr>
        <tr>
            <td>21H</td>
            <td>The&nbsp;lower&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;channel&nbsp;1</td>
        </tr>
        <tr>
            <td>22H</td>
            <td>The&nbsp;lower&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;channel&nbsp;2</td>
        </tr>
        <tr>
            <td>23H</td>
            <td>The&nbsp;lower&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;channel&nbsp;3</td>
        </tr>
        <tr>
            <td>24H</td>
            <td>The&nbsp;lower&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;channel&nbsp;4</td>
        </tr>
        <tr>
            <td>25H</td>
            <td>The&nbsp;lower&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;channel&nbsp;5</td>
        </tr>
        <tr>
            <td>26H</td>
            <td>The&nbsp;lower&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;channel&nbsp;6</td>
        </tr>
        <tr>
            <td>27H</td>
            <td>The&nbsp;lower&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;channel&nbsp;7</td>
        </tr>
        <tr>
            <td>28H</td>
            <td>The&nbsp;lower&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;channel&nbsp;8</td>
        </tr>
        <tr>
            <td>29H</td>
            <td>The&nbsp;upper&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;&nbsp;channel&nbsp;1</td>
        </tr>
        <tr>
            <td>2AH</td>
            <td>The&nbsp;upper&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;&nbsp;channel&nbsp;2</td>
        </tr>
        <tr>
            <td>2BH</td>
            <td>The&nbsp;upper&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;&nbsp;channel&nbsp;3</td>
        </tr>
        <tr>
            <td>2CH</td>
            <td>The&nbsp;upper&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;&nbsp;channel&nbsp;4</td>
        </tr>
        <tr>
            <td>2DH</td>
            <td>The&nbsp;upper&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;&nbsp;channel&nbsp;5</td>
        </tr>
        <tr>
            <td>2EH</td>
            <td>The&nbsp;upper&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;&nbsp;channel&nbsp;6</td>
        </tr>
        <tr>
            <td>2FH</td>
            <td>The&nbsp;upper&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;&nbsp;channel&nbsp;7</td>
        </tr>
        <tr>
            <td>30H</td>
            <td>The&nbsp;upper&nbsp;limit&nbsp;in&nbsp;engineering&nbsp;value&nbsp;of&nbsp;&nbsp;channel&nbsp;8</td>
        </tr>
        <tr>
            <td>31H</td>
            <td>The&nbsp;sampling&nbsp;frequency&nbsp;of&nbsp;&nbsp;channel&nbsp;1,&nbsp;note&nbsp;1</td>
        </tr>
        <tr>
            <td>32H</td>
            <td>The&nbsp;sampling&nbsp;frequency&nbsp;of&nbsp;&nbsp;channel&nbsp;2,&nbsp;note&nbsp;1</td>
        </tr>
        <tr>
            <td>33H</td>
            <td>The&nbsp;sampling&nbsp;frequency&nbsp;of&nbsp;&nbsp;channel&nbsp;3,&nbsp;note&nbsp;1</td>
        </tr>
        <tr>
            <td>34H</td>
            <td>The&nbsp;sampling&nbsp;frequency&nbsp;of&nbsp;&nbsp;channel&nbsp;4,&nbsp;note&nbsp;1</td>
        </tr>
        <tr>
            <td>35H</td>
            <td>The&nbsp;sampling&nbsp;frequency&nbsp;of&nbsp;&nbsp;channel&nbsp;5,&nbsp;note&nbsp;1</td>
        </tr>
        <tr>
            <td>36H</td>
            <td>The&nbsp;sampling&nbsp;frequency&nbsp;of&nbsp;&nbsp;channel&nbsp;6,&nbsp;note&nbsp;1</td>
        </tr>
        <tr>
            <td>37H</td>
            <td>The&nbsp;sampling&nbsp;frequency&nbsp;of&nbsp;&nbsp;channel&nbsp;7,&nbsp;note&nbsp;1</td>
        </tr>
        <tr>
            <td>38H</td>
            <td>The&nbsp;sampling&nbsp;frequency&nbsp;of&nbsp;&nbsp;channel&nbsp;8,&nbsp;note&nbsp;1</td>
        </tr>
        <tr>
            <td>39H</td>
            <td>The&nbsp;zero&nbsp;point&nbsp;correction&nbsp;value&nbsp;of&nbsp;channel&nbsp;1</td>
        </tr>
        <tr>
            <td>3AH</td>
            <td>The&nbsp;zero&nbsp;point&nbsp;correction&nbsp;value&nbsp;of&nbsp;channel&nbsp;2</td>
        </tr>
        <tr>
            <td>3BH</td>
            <td>The&nbsp;zero&nbsp;point&nbsp;correction&nbsp;value&nbsp;of&nbsp;channel&nbsp;3</td>
        </tr>
        <tr>
            <td>3CH</td>
            <td>The&nbsp;zero&nbsp;point&nbsp;correction&nbsp;value&nbsp;of&nbsp;channel&nbsp;4</td>
        </tr>
        <tr>
            <td>3DH</td>
            <td>The&nbsp;zero&nbsp;point&nbsp;correction&nbsp;value&nbsp;of&nbsp;channel&nbsp;5</td>
        </tr>
        <tr>
            <td>3EH</td>
            <td>The&nbsp;zero&nbsp;point&nbsp;correction&nbsp;value&nbsp;of&nbsp;channel&nbsp;6</td>
        </tr>
        <tr>
            <td>3FH</td>
            <td>The&nbsp;zero&nbsp;point&nbsp;correction&nbsp;value&nbsp;of&nbsp;channel&nbsp;7</td>
        </tr>
        <tr>
            <td>40H</td>
            <td>The&nbsp;zero&nbsp;point&nbsp;correction&nbsp;value&nbsp;of&nbsp;channel&nbsp;8</td>
        </tr>
        <tr>
            <td>41H&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>Channel&nbsp;1~8&nbsp;input&nbsp;disconnection&nbsp;alarm,&nbsp;note&nbsp;5</td>
        </tr>
        <tr>
            <td>42H~4FH&nbsp;<span style="color:red;">(Read&nbsp;only)</span></td>
            <td>Reserve</td>
        </tr>
    </tbody>
</table>