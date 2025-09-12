<h3>Технические характеристики</h3>
<table>
    <colgroup><col style="width: 16.5%;"/><col style="width: 16.5%;"/><col style="width: 33%;"/><col style="width: 33%;"/></colgroup>
    <tbody>
        <tr>
            <td colspan="2">Позиция</td>
            <td>Значение</td>
            <td>Пояснение</td>
        </tr>
        <tr>
            <td colspan="2">Время исполнения инструкции</td>
            <td> 0.05 мкс</td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td colspan="2">Язык программирования</td>
            <td>LD (ladder) + FBD (function block) + IL ( instruction list)</td>
            <td>в соответствии с IEC 61131-3</td>
        </tr>
        <tr>
            <td colspan="2">Объем программы</td>
            <td>48К шагов</td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td colspan="2">Storage Method <br>(?????????? Способ хранения)</td>
            <td>Flash ROM permanent storage, dispense with backup battery<br>
                {?????????? Постоянная флэш-память, не нужен резервный аккумулятор}
            </td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td>X</td>
            <td>External input<br>??? Внеший вход</td>
            <td>X0~X1023</td>
            <td>Support edge catch and signal filtering set <br>??? </td>
        </tr>
        <tr>
            <td>Y</td>
            <td>External output ??? Внешний выход</td>
            <td>Y0~Y1023</td>
            <td>Power-off preserve output can be configured<br>
                (?????????? может быть настроено сохранение при пропадании питания)
            </td>
        </tr>
        <tr>
            <td rowspan="2">M</td>
            <td rowspan="2">Auxiliary relay <br> (?????????? Вспомогательное реле</td>
            <td>M0~ M12287</td>
            <td rowspan="2">Power-off preserve area can be set freedom <br/>
                (?????????? )

            </td>
        </tr>
        <tr>
            <td>(default power-off preserve) M1536~M2047<br/>(?????????? )

            </td>
        </tr>
        <tr>
            <td rowspan="2">T</td>
            <td rowspan="2">Timer <br/>
                (output coil)
            </td>
            <td>T0~T1023</td>
            <td rowspan="2">Power-off preserve area can be set<br/>
                freedom, time base: 10ms, 100ms, <br/>
                1s be set freedom,T252~T255 1ms
            </td>
        </tr>
        <tr>
            <td>(default power-off preserve) <br/>
                T96~T127
            </td>
        </tr>
        <tr>
            <td rowspan="2">C</td>
            <td rowspan="2">Counter ???? Счетчик<br/> (output coil) ???? Выходная катушка
            </td>
            <td>C0~C255</td>
            <td rowspan="2">Power-off preserve area can be set freedom
            </td>
        </tr>
        <tr>
            <td>(default power-off preserve) C64~C127</td>
        </tr>
        <tr>
            <td rowspan="2">S</td>
            <td rowspan="2">Step state bits</td>
            <td>S0~S2047</td>
            <td rowspan="2">Power-off preserve area can be <br/>
                set Freedom
            </td>
        </tr>
        <tr>
            <td>(default power-off preserve) S156~S255
            </td>
        </tr>
        <tr>
            <td>SM</td>
            <td>System state bits</td>
            <td>SM0~SM215</td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td>LM</td>
            <td>Local relay</td>
            <td>LM~LM31</td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td>AI</td>
            <td>Analog input register (????? Регистр аналогового входа)
            </td>
            <td>AI0~AI255</td>
            <td>Support quantities convert, sample times and zero point correct</td>
        </tr>
        <tr>
            <td>AQ</td>
            <td>Analog output register</td>
            <td>AQ0~AQ255</td>
            <td>Support quantities convert, power-off preserve output can be configured
            </td>
        </tr>
        <tr>
            <td rowspan="2">V</td>
            <td rowspan="2">Internal data register ???? Внутренний регистр данных
            </td>
            <td>V0~V14847</td>
            <td rowspan="2">power-off preserve area can be set freedom</td>
        </tr>
        <tr>
            <td>(default power-off preserve) V1000~V2047
            </td>
        </tr>
        <tr>
            <td rowspan="2">TV</td>
            <td rowspan="2">Timer (Current value register) ?????? Таймер(регистр текущего значения)
            </td>
            <td>TV0~TV1023</td>
            <td rowspan="2">Power-off preserve area can be set freedom, time base: 10ms, 100ms, 1s can be set freedom, T252~T255 1ms
            </td>
        </tr>
        <tr>
            <td>(default power-off preserve) TV96~TV127</td>
        </tr>
        <tr>
            <td rowspan="2">CV</td>
            <td rowspan="2">Counter (Current value register)
            </td>
            <td>CV0~CV255</td>
            <td rowspan="2">Power-off preserve area can be set freedom, CV48~CV79 are 32 bits, Other are 16 bits</td>
        </tr>
        <tr>
            <td>(default power-off preserve) CV64~CV127</td>
        </tr>
        <tr>
            <td>SV</td>
            <td>System register ?????? Системный регистр</td>
            <td>SV0~SV900</td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td>Lv</td>
            <td>Local Register ?????? </td>
            <td>Lv0~Lv31</td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td>P</td>
            <td>Indexed addressing point ??????
            </td>
            <td>P0~P9, use for indirect addressing ?????? P0~P9, используются для непрямой адресации
            </td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td>I</td>
            <td>Interrupt ?????? Прерывание</td>
            <td>I1-I52</td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td>LBL</td>
            <td>Lable ??????</td>
            <td>255, use for program skip ??????</td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td colspan="2">Порты связи</td>
            <td>MPU built-in 2 communication port (RS232/RS485), Max 5 communication port (RS232/RS485) Extension
                <br>
                (???????) Два встроенных порта (RS232/RS485), возможность расширения до 5 портов
            </td>
            <td>Can be program or networking (master/slave)<br>
                (???????)
            </td>
        </tr>
        <tr>
            <td colspan="2">Протоколы связи</td>
            <td>Modbus RTU, Modbus TCP, Haiwell TCP, HaiwellBUS, Free protocol; Скорость передачи 1200~115200 бод
            </td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td colspan="2">Емкость сети ПЛК</td>
            <td>PLC communication address can be set external set, Max 254, support 1: N, N: 1, N: N network<br>
                (???????) Адреса связи ПЛК могут быть установлены извне; максимум 254; поддержка сетей  1: N, N: 1, N: N
            </td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td colspan="2">Часы реального времени (RTC)</td>
            <td>Отображение: год /месяц /день /часы /минуты /секунды /неделя</td>
            <td>Встроенная батарея</td>
        </tr>
        <tr>
            <td colspan="2">Арифметические операции
            </td>
            <td>Поддержка 32-х битных арифметических операций с плавающей точкой, преобразование "целое число / число с плавающей точкой".
            </td>
            <td><br/>
            </td>
        </tr>
        <tr>
            <td colspan="2">Защита паролем</td>
            <td>Поддерживаются 3 уровня защиты:<br/>
                Program file password (?????????? пароль на файл программы)<br/>
                Program block password (?????????? пароль на  программный блок)<br/>
                PLC hardware password and upload prohibited function (?????????? пароль на ПЛК и функция запрета скачивания)
            </td>
            <td><br/>
            </td>
        </tr>
    </tbody>
</table>