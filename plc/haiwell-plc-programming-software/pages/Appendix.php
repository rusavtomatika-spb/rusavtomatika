<h1 id="Appendix">Appendix</h1>
<hr>
<p>List the resource of the system in Haiwell PLC. </p>
<h3 id="SM_system_status_bit">SM system status bit</h3>
<p>SM system status bit is a group of special internal relay of the system, can be used unlimited in the program, each SM has a special function.Do not use the SM which unlisted. </p>
<div>
    <table>
        <tbody>
            <tr>
                <td>
                    <p>SM</p>
                </td>
                <td>
                    <p>Function declare</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>Power-off preserve</p>
                </td>
                <td>
                    <p>Default</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM0</p>
                </td>
                <td>
                    <p>On during running, Off during stopping</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM1</p>
                </td>
                <td>
                    <p>Off during running, On during stopping</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM2</p>
                </td>
                <td>
                    <p>On during the first scan when PLC starts RUN and then be Off</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM3</p>
                </td>
                <td>
                    <p>10ms clock pulse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM4</p>
                </td>
                <td>
                    <p>100ms clock pulse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM5</p>
                </td>
                <td>
                    <p>1s clock pulse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM8</p>
                </td>
                <td>
                    <p>Scan time-out</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM9</p>
                </td>
                <td>
                    <p>PLC switch status</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM10</p>
                </td>
                <td>
                    <p>Run status</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM11</p>
                </td>
                <td>
                    <p>System failure</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM12</p>
                </td>
                <td>
                    <p>Hardware configure table mismatch the module</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM13</p>
                </td>
                <td>
                    <p>Battery in low voltage, malfunction or no battery</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM14</p>
                </td>
                <td>
                    <p>Divide by zero flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM15</p>
                </td>
                <td>
                    <p>Data overflow flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM16</p>
                </td>
                <td>
                    <p>COM1 communicate error </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM17</p>
                </td>
                <td>
                    <p>COM2 communicate error </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM18</p>
                </td>
                <td>
                    <p>COM3 communicate error </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM19</p>
                </td>
                <td>
                    <p>COM4 communicate error </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM20</p>
                </td>
                <td>
                    <p>COM5 communicate error </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM25</p>
                </td>
                <td>
                    <p>HSC0 study enable control, 0 is normal state, 1 is study state</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM26</p>
                </td>
                <td>
                    <p>HSC0 study confirm control</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM27</p>
                </td>
                <td>
                    <p>HSC0 reset control 0 is automatic reset 1 is not reset</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM30</p>
                </td>
                <td>
                    <p>HSC0 direction indication, 0 is increase, 1 is decrease </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM31</p>
                </td>
                <td>
                    <p>HSC0 error indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM33</p>
                </td>
                <td>
                    <p>HSC1 study enable control, 0 is normal state, 1 is study state</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM34</p>
                </td>
                <td>
                    <p>HSC1 study confirm control</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM35</p>
                </td>
                <td>
                    <p>HSC1 reset control 0 is automatic reset 1 is not reset</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM38</p>
                </td>
                <td>
                    <p>HSC1 direction indication, 0 is increase, 1 is decrease </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM39</p>
                </td>
                <td>
                    <p>HSC1 error indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM41</p>
                </td>
                <td>
                    <p>HSC2 study enable control, 0 is normal state, 1 is study state</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM42</p>
                </td>
                <td>
                    <p>HSC2 study confirm control</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM43</p>
                </td>
                <td>
                    <p>HSC2 reset control 0 is automatic reset 1 is not reset</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM46</p>
                </td>
                <td>
                    <p>HSC2 direction indication, 0 is increase, 1 is decrease </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM47</p>
                </td>
                <td>
                    <p>HSC2 error indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM49</p>
                </td>
                <td>
                    <p>HSC3 study enable control, 0 is normal state, 1 is study state</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM50</p>
                </td>
                <td>
                    <p>HSC3 study confirm control</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM51</p>
                </td>
                <td>
                    <p>HSC3 reset control 0 is automatic reset 1 is not reset</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM54</p>
                </td>
                <td>
                    <p>HSC3 direction indication, 0 is increase, 1 is decrease </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM55</p>
                </td>
                <td>
                    <p>HSC3 error indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM57</p>
                </td>
                <td>
                    <p>HSC4 study enable control, 0 is normal state, 1 is study state</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM58</p>
                </td>
                <td>
                    <p>HSC4 study confirm control</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM59</p>
                </td>
                <td>
                    <p>HSC4 reset control 0 is automatic reset 1 is not reset</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM62</p>
                </td>
                <td>
                    <p>HSC4 direction indication, 0 is increase, 1 is decrease </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM63</p>
                </td>
                <td>
                    <p>HSC4 error indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM65</p>
                </td>
                <td>
                    <p>HSC5 study enable control, 0 is normal state, 1 is study state</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM66</p>
                </td>
                <td>
                    <p>HSC5 study confirm control</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM67</p>
                </td>
                <td>
                    <p>HSC5 reset control 0 is automatic reset 1 is not reset</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM70</p>
                </td>
                <td>
                    <p>HSC5 direction indication, 0 is increase, 1 is decrease </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM71</p>
                </td>
                <td>
                    <p>HSC5 error indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM73</p>
                </td>
                <td>
                    <p>HSC6 study enable control, 0 is normal state, 1 is study state</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM74</p>
                </td>
                <td>
                    <p>HSC6 study confirm control</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM75</p>
                </td>
                <td>
                    <p>HSC6 reset control 0 is automatic reset 1 is not reset</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM78</p>
                </td>
                <td>
                    <p>HSC6 direction indication, 0 is increase, 1 is decrease </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM79</p>
                </td>
                <td>
                    <p>HSC6 error indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM81</p>
                </td>
                <td>
                    <p>HSC7 study enable control, 0 is normal state, 1 is study state</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM82</p>
                </td>
                <td>
                    <p>HSC7 study confirm control</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM83</p>
                </td>
                <td>
                    <p>HSC7 reset control 0 is automatic reset 1 is not reset</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM86</p>
                </td>
                <td>
                    <p>HSC7 direction indication, 0 is increase, 1 is decrease </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM87</p>
                </td>
                <td>
                    <p>HSC7 error indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM93</p>
                </td>
                <td>
                    <p>PLS0 prohibit the forward pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM94</p>
                </td>
                <td>
                    <p>PLS0 prohibit the reverse pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM95</p>
                </td>
                <td>
                    <p>PLS0 prohibit the brake function</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM96</p>
                </td>
                <td>
                    <p>PLS0 pulse output indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM97</p>
                </td>
                <td>
                    <p>PLS0 pulse output direction indication, 0 is forward, 1 is reverse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM98</p>
                </td>
                <td>
                    <p>PLS0 error flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SM99</p>
                </td>
                <td>
                    <p>PLS0 position model, 0 is relative address, 1 is absolute address</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM100</p>
                </td>
                <td>
                    <p>PLS0 pulse output complete</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM109</p>
                </td>
                <td>
                    <p>PLS1 prohibit the forward pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM110</p>
                </td>
                <td>
                    <p>PLS1 prohibit the reverse pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM111</p>
                </td>
                <td>
                    <p>PLS1 prohibit the brake function</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM112</p>
                </td>
                <td>
                    <p>PLS1 pulse output indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM113</p>
                </td>
                <td>
                    <p>PLS1 pulse output direction indication, 0 is forward, 1 is reverse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM114</p>
                </td>
                <td>
                    <p>PLS1 error flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM115</p>
                </td>
                <td>
                    <p>PLS1 position model, 0 is relative address, 1 is absolute address</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM116</p>
                </td>
                <td>
                    <p>PLS1 pulse output complete</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM125</p>
                </td>
                <td>
                    <p>PLS2 prohibit the forward pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM126</p>
                </td>
                <td>
                    <p>PLS2 prohibit the reverse pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM127</p>
                </td>
                <td>
                    <p>PLS2 prohibit the brake function</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM128</p>
                </td>
                <td>
                    <p>PLS2 pulse output indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM129</p>
                </td>
                <td>
                    <p>PLS2 pulse output direction indication, 0 is forward, 1 is reverse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM130</p>
                </td>
                <td>
                    <p>PLS2 error flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM131</p>
                </td>
                <td>
                    <p>PLS2 position model, 0 is relative address, 1 is absolute address</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM132</p>
                </td>
                <td>
                    <p>PLS2 pulse output complete</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM141</p>
                </td>
                <td>
                    <p>PLS3 prohibit the forward pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM142</p>
                </td>
                <td>
                    <p>PLS3 prohibit the reverse pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM143</p>
                </td>
                <td>
                    <p>PLS3 prohibit the brake function</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM144</p>
                </td>
                <td>
                    <p>PLS3 pulse output indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM145</p>
                </td>
                <td>
                    <p>PLS3 pulse output direction indication, 0 is forward, 1 is reverse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM146</p>
                </td>
                <td>
                    <p>PLS3 error flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM147</p>
                </td>
                <td>
                    <p>PLS3 position model, 0 is relative address, 1 is absolute address</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM148</p>
                </td>
                <td>
                    <p>PLS3 pulse output complete</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM157</p>
                </td>
                <td>
                    <p>PLS4 prohibit the forward pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM158</p>
                </td>
                <td>
                    <p>PLS4 prohibit the reverse pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM159</p>
                </td>
                <td>
                    <p>PLS4 prohibit the brake function</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM160</p>
                </td>
                <td>
                    <p>PLS4 pulse output indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM161</p>
                </td>
                <td>
                    <p>PLS4 pulse output direction indication, 0 is forward, 1 is reverse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM162</p>
                </td>
                <td>
                    <p>PLS4 error flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM163</p>
                </td>
                <td>
                    <p>PLS4 position model, 0 is relative address, 1 is absolute address</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM164</p>
                </td>
                <td>
                    <p>PLS4 pulse output complete</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM173</p>
                </td>
                <td>
                    <p>PLS5 prohibit the forward pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM174</p>
                </td>
                <td>
                    <p>PLS5 prohibit the reverse pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM175</p>
                </td>
                <td>
                    <p>PLS5 prohibit the brake function</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM176</p>
                </td>
                <td>
                    <p>PLS5 pulse output indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM177</p>
                </td>
                <td>
                    <p>PLS5 pulse output direction indication, 0 is forward, 1 is reverse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM178</p>
                </td>
                <td>
                    <p>PLS5 error flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM179</p>
                </td>
                <td>
                    <p>PLS5 position model, 0 is relative address, 1 is absolute address</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM180</p>
                </td>
                <td>
                    <p>PLS5 pulse output complete</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM189</p>
                </td>
                <td>
                    <p>PLS6 prohibit the forward pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM190</p>
                </td>
                <td>
                    <p>PLS6 prohibit the reverse pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM191</p>
                </td>
                <td>
                    <p>PLS6 prohibit the brake function</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM192</p>
                </td>
                <td>
                    <p>PLS6 pulse output indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM193</p>
                </td>
                <td>
                    <p>PLS6 pulse output direction indication, 0 is forward, 1 is reverse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM194</p>
                </td>
                <td>
                    <p>PLS6 error flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM195</p>
                </td>
                <td>
                    <p>PLS6 position model, 0 is relative address, 1 is absolute address</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM196</p>
                </td>
                <td>
                    <p>PLS6 pulse output complete</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM205</p>
                </td>
                <td>
                    <p>PLS7 prohibit the forward pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM206</p>
                </td>
                <td>
                    <p>PLS7 prohibit the reverse pulse</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM207</p>
                </td>
                <td>
                    <p>PLS7 prohibit the brake function</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM208</p>
                </td>
                <td>
                    <p>PLS7 pulse output indication</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM209</p>
                </td>
                <td>
                    <p>PLS7 pulse output direction indication, 0 is forward, 1 is reverse</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM210</p>
                </td>
                <td>
                    <p>PLS7 error flag</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM211</p>
                </td>
                <td>
                    <p>PLS7 position model, 0 is relative address, 1 is absolute address</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p> SM212</p>
                </td>
                <td>
                    <p>PLS7 pulse output complete</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<h3 id="SV_system_register">SV system register</h3>
<p>SV system register is a group of special internal register of the system, can be used unlimited in the program, each SV has a special function.Do not use the SM which unlisted.</p>
<div>
    <table>
        <tbody>
            <tr>
                <td>
                    <p>SV</p>
                </td>
                <td>
                    <p>Function declare</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>Power-off preserve</p>
                </td>
                <td>
                    <p>Default</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV0</p>
                </td>
                <td>
                    <p>The present scan time(unit 0.1ms)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV1</p>
                </td>
                <td>
                    <p>The minimum scan time(unit 0.1ms)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV2</p>
                </td>
                <td>
                    <p>The maximum scan time(unit 0.1ms)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV3</p>
                </td>
                <td>
                    <p>System fault code, detail see the system fault code table</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV4</p>
                </td>
                <td>
                    <p>COM1 communicate error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV5</p>
                </td>
                <td>
                    <p>COM2 communicate error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV6</p>
                </td>
                <td>
                    <p>COM3 communicate error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV7</p>
                </td>
                <td>
                    <p>COM4 communicate error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV8</p>
                </td>
                <td>
                    <p>COM5 communicate error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV9</p>
                </td>
                <td>
                    <p>The error line number during compile</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV11</p>
                </td>
                <td>
                    <p>AI input on the CPU module break off alarm every bit express one channel 0-Normal 1-break off</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV12</p>
                </td>
                <td>
                    <p>Year</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV13</p>
                </td>
                <td>
                    <p>Month(1-12)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV14</p>
                </td>
                <td>
                    <p>Day(1-31)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV15</p>
                </td>
                <td>
                    <p>Hour(0-23)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV16</p>
                </td>
                <td>
                    <p>Minute(0-59)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV17</p>
                </td>
                <td>
                    <p>Second(0-59)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV18</p>
                </td>
                <td>
                    <p>Week(1-7, Monday~Sunday)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>No</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV19</p>
                </td>
                <td>
                    <p>PLC station's name</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV20</p>
                </td>
                <td>
                    <p>PLC station's name</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV21</p>
                </td>
                <td>
                    <p>PLC station's name</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV22</p>
                </td>
                <td>
                    <p>PLC station's name</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV23</p>
                </td>
                <td>
                    <p>PLC station's name</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV24</p>
                </td>
                <td>
                    <p>PLC station's name</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV25</p>
                </td>
                <td>
                    <p>Timer of program scan time-out(unit ms)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>200 ms</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV26</p>
                </td>
                <td>
                    <p>PLC address 1~254</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>1</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV27</p>
                </td>
                <td>
                    <p>Low byte is extend modules 0~31 High byte is type</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV28</p>
                </td>
                <td>
                    <p>Low byte is CPU? type High byte is CPU? version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV29</p>
                </td>
                <td>
                    <p>Low byte is first extend module's code High byte is first extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV30</p>
                </td>
                <td>
                    <p>Low byte is second extend module's code High byte is second extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV31</p>
                </td>
                <td>
                    <p>Low byte is third extend module's code High byte is third extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV32</p>
                </td>
                <td>
                    <p>Low byte is fourth extend module's code High byte is fourth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV33</p>
                </td>
                <td>
                    <p>Low byte is fifth extend module's code High byte is fifth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV34</p>
                </td>
                <td>
                    <p>Low byte is sixth extend module's code High byte is sixth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV35</p>
                </td>
                <td>
                    <p>Low byte is seventh extend module's code High byte is seventh extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV36</p>
                </td>
                <td>
                    <p>Low byte is eighth extend module's code High byte is eighth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV37</p>
                </td>
                <td>
                    <p>Low byte is ninth extend module's code High byte is ninth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV38</p>
                </td>
                <td>
                    <p>Low byte is tenth extend module's code High byte is tenth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV39</p>
                </td>
                <td>
                    <p>Low byte is eleventh extend module's code High byte is eleventh extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV40</p>
                </td>
                <td>
                    <p>Low byte is twelfth extend module's code High byte is twelfth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV41</p>
                </td>
                <td>
                    <p>Low byte is thirteenth extend module's code High byte is thirteenth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV42</p>
                </td>
                <td>
                    <p>Low byte is ffourteenth extend module's code High byte is fourteenth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV43</p>
                </td>
                <td>
                    <p>Low byte is fifteenth extend module's code High byte is fifteenth extend module's version</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV44</p>
                </td>
                <td>
                    <p>COM1 communicate protocol:</p>
                    <p>Low 4 bit of low byte:0 - N, 8, 2 For RTU</p>
                    <p>    1 - E, 8, 1 For RTU</p>
                    <p>    2 - O 8, 1 For RTU</p>
                    <p>    3 - N, 7, 2 For ASCII</p>
                    <p>    4 - E, 7, 1 For ASCII</p>
                    <p>    5 - O, 7, 1 For ASCII</p>
                    <p>    6 - N, 8, 1 For RTU(H/N serial support)</p>
                    <p>High 4 bit of low byte:0 - 2400</p>
                    <p>    1 - 4800</p>
                    <p>    2 - 9600</p>
                    <p>    3 - 19200</p>
                    <p>    4 - 38400</p>
                    <p>    5 - 57600</p>
                    <p>    6 - 115200(H/N serial support)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p> 0x30, 19200, N, 8, 2 RTU</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV45</p>
                </td>
                <td>
                    <p>COM1 communicate overtime, unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>200ms </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV46</p>
                </td>
                <td>
                    <p>COM2 communicate protocol, the same as COM1</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p> 0x30, 19200, N, 8, 2 RTU</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV47</p>
                </td>
                <td>
                    <p>COM2 communicate overtime, unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>200ms</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV48</p>
                </td>
                <td>
                    <p>PLC program size</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV49</p>
                </td>
                <td>
                    <p>Low byte of system clock, unit 16us Max 1073741824</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p> </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV50</p>
                </td>
                <td>
                    <p>High byte of system clock, unit 16us Max 1073741824</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p> </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV54</p>
                </td>
                <td>
                    <p>COM3 communicate protocol, the same as COM1</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p> 0x30, 19200, N, 8, 2 RTU</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV55</p>
                </td>
                <td>
                    <p>COM3 communicate overtime, unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>200ms</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV56</p>
                </td>
                <td>
                    <p>COM4 communicate protocol, the same as COM1</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p> 0x30, 19200, N, 8, 2 RTU</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV57</p>
                </td>
                <td>
                    <p>COM4 communicate overtime, unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>200ms</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV58</p>
                </td>
                <td>
                    <p>COM5 communicate protocol, the same as COM1</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p> 0x30, 19200, N, 8, 2 RTU</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV59</p>
                </td>
                <td>
                    <p>COM5 communicate overtime, unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>200ms</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV60</p>
                </td>
                <td>
                    <p>HSC0 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV61</p>
                </td>
                <td>
                    <p>HSC0 low word of current value </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV62</p>
                </td>
                <td>
                    <p>HSC0 high word of current value</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV63</p>
                </td>
                <td>
                    <p>HSC0 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV64</p>
                </td>
                <td>
                    <p>HSC1 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV65</p>
                </td>
                <td>
                    <p>HSC1 low word of current value </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV66</p>
                </td>
                <td>
                    <p>HSC1 high word of current value</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV67</p>
                </td>
                <td>
                    <p>HSC1 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV68</p>
                </td>
                <td>
                    <p>HSC2 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV69</p>
                </td>
                <td>
                    <p>HSC2 low word of current value </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV70</p>
                </td>
                <td>
                    <p>HSC2 high word of current value</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV71</p>
                </td>
                <td>
                    <p>HSC2 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV72</p>
                </td>
                <td>
                    <p>HSC3 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV73</p>
                </td>
                <td>
                    <p>HSC3 low word of current value </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV74</p>
                </td>
                <td>
                    <p>HSC3 high word of current value</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV75</p>
                </td>
                <td>
                    <p>HSC3 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV76</p>
                </td>
                <td>
                    <p>HSC4 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV77</p>
                </td>
                <td>
                    <p>HSC4 low word of current value </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV78</p>
                </td>
                <td>
                    <p>HSC4 high word of current value</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV79</p>
                </td>
                <td>
                    <p>HSC4 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV80</p>
                </td>
                <td>
                    <p>HSC5 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV81</p>
                </td>
                <td>
                    <p>HSC5 low word of current value </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV82</p>
                </td>
                <td>
                    <p>HSC5 high word of current value</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV83</p>
                </td>
                <td>
                    <p>HSC5 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV84</p>
                </td>
                <td>
                    <p>HSC6 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV85</p>
                </td>
                <td>
                    <p>HSC6 low word of current value </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV86</p>
                </td>
                <td>
                    <p>HSC6 high word of current value</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV87</p>
                </td>
                <td>
                    <p>HSC6 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV88</p>
                </td>
                <td>
                    <p>HSC7 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV89</p>
                </td>
                <td>
                    <p>HSC7 low word of current value </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV90</p>
                </td>
                <td>
                    <p>HSC7 high word of current value</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV91</p>
                </td>
                <td>
                    <p>HSC7 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV92</p>
                </td>
                <td>
                    <p>PLS0 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV93</p>
                </td>
                <td>
                    <p>PLS0 low word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV94</p>
                </td>
                <td>
                    <p>PLS0 high word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV95</p>
                </td>
                <td>
                    <p>PLS0 low word of current position </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV96</p>
                </td>
                <td>
                    <p>PLS0 high word of current position</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV97</p>
                </td>
                <td>
                    <p>PLS0 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV98</p>
                </td>
                <td>
                    <p>PLS1 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV99</p>
                </td>
                <td>
                    <p>PLS1 low word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV100</p>
                </td>
                <td>
                    <p>PLS1 high word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV101</p>
                </td>
                <td>
                    <p>PLS1 low word of current position </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV102</p>
                </td>
                <td>
                    <p>PLS1 high word of current position</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV103</p>
                </td>
                <td>
                    <p>PLS1 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV104</p>
                </td>
                <td>
                    <p>PLS2 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV105</p>
                </td>
                <td>
                    <p>PLS2 low word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV106</p>
                </td>
                <td>
                    <p>PLS2 high word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV107</p>
                </td>
                <td>
                    <p>PLS2 low word of current position </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV108</p>
                </td>
                <td>
                    <p>PLS2 high word of current position</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV109</p>
                </td>
                <td>
                    <p>PLS2 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV110</p>
                </td>
                <td>
                    <p>PLS3 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV111</p>
                </td>
                <td>
                    <p>PLS3 low word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV112</p>
                </td>
                <td>
                    <p>PLS3 high word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV113</p>
                </td>
                <td>
                    <p>PLS3 low word of current position </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV114</p>
                </td>
                <td>
                    <p>PLS3 high word of current position</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV115</p>
                </td>
                <td>
                    <p>PLS3 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV116</p>
                </td>
                <td>
                    <p>PLS4 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV117</p>
                </td>
                <td>
                    <p>PLS4 low word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV118</p>
                </td>
                <td>
                    <p>PLS4 high word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV119</p>
                </td>
                <td>
                    <p>PLS4 low word of current position </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV120</p>
                </td>
                <td>
                    <p>PLS4 high word of current position</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV121</p>
                </td>
                <td>
                    <p>PLS4 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV122</p>
                </td>
                <td>
                    <p>PLS5 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV123</p>
                </td>
                <td>
                    <p>PLS5 low word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV124</p>
                </td>
                <td>
                    <p>PLS5 high word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV125</p>
                </td>
                <td>
                    <p>PLS5 low word of current position </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV126</p>
                </td>
                <td>
                    <p>PLS5 high word of current position</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV127</p>
                </td>
                <td>
                    <p>PLS5 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV128</p>
                </td>
                <td>
                    <p>PLS6 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV129</p>
                </td>
                <td>
                    <p>PLS6 low word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV130</p>
                </td>
                <td>
                    <p>PLS6 high word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV131</p>
                </td>
                <td>
                    <p>PLS6 low word of current position </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV132</p>
                </td>
                <td>
                    <p>PLS6 high word of current position</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV133</p>
                </td>
                <td>
                    <p>PLS6 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV134</p>
                </td>
                <td>
                    <p>PLS7 current segment number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV135</p>
                </td>
                <td>
                    <p>PLS7 low word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV136</p>
                </td>
                <td>
                    <p>PLS7 high word of pulse output number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV137</p>
                </td>
                <td>
                    <p>PLS7 low word of current position </p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV138</p>
                </td>
                <td>
                    <p>PLS7 high word of current position</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV139</p>
                </td>
                <td>
                    <p>PLS7 error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV140</p>
                </td>
                <td>
                    <p>When value is -23206 prohibit all output of Y</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV141</p>
                </td>
                <td>
                    <p>COM1 Communicate instruction execute interval unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV142</p>
                </td>
                <td>
                    <p>The soft address of PLC(1~254)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV143</p>
                </td>
                <td>
                    <p>The setted address of the external DIP switch</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV144</p>
                </td>
                <td>
                    <p>Low word of serial number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV145</p>
                </td>
                <td>
                    <p>High word of serial number</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV146</p>
                </td>
                <td>
                    <p>Time of the direction output before the pulse output(5~100us)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>5</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV151</p>
                </td>
                <td>
                    <p>Number of locked data</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV152</p>
                </td>
                <td>
                    <p>IP address, default : 192.168.1.111</p>
                </td>
                <td>
                    <p>RW</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0x016F</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV153</p>
                </td>
                <td>
                    <p>IP address, default : 192.168.1.111</p>
                </td>
                <td>
                    <p>RW</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0xC0A8</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV154</p>
                </td>
                <td>
                    <p>Subnet mask, default: 255.255.255.0</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0xFF00</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV155</p>
                </td>
                <td>
                    <p>Subnet mask, default: 255.255.255.0</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0xFFFF</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV156</p>
                </td>
                <td>
                    <p>PLS0 low word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV157</p>
                </td>
                <td>
                    <p>PLS0 high word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV158</p>
                </td>
                <td>
                    <p>PLS0 number of pulses to compensate the reverse interval</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV159</p>
                </td>
                <td>
                    <p>PLS0 follow performance parameters, range: 1~100</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>50</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV160</p>
                </td>
                <td>
                    <p>PLS1 low word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV161</p>
                </td>
                <td>
                    <p>PLS1 high word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV162</p>
                </td>
                <td>
                    <p>PLS1 number of pulses to compensate the reverse interval</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV163</p>
                </td>
                <td>
                    <p>PLS1 follow performance parameters, range: 1~100</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>50</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV164</p>
                </td>
                <td>
                    <p>PLS2 low word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV165</p>
                </td>
                <td>
                    <p>PLS2 high word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV166</p>
                </td>
                <td>
                    <p>PLS2 number of pulses to compensate the reverse interval</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV167</p>
                </td>
                <td>
                    <p>PLS2 follow performance parameters, range: 1~100</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>50</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV168</p>
                </td>
                <td>
                    <p>PLS3 low word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV169</p>
                </td>
                <td>
                    <p>PLS3 high word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV170</p>
                </td>
                <td>
                    <p>PLS3 number of pulses to compensate the reverse interval</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV171</p>
                </td>
                <td>
                    <p>PLS3 follow performance parameters, range: 1~100</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>50</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV172</p>
                </td>
                <td>
                    <p>PLS4 low word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV173</p>
                </td>
                <td>
                    <p>PLS4 high word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV174</p>
                </td>
                <td>
                    <p>PLS4 number of pulses to compensate the reverse interval</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV175</p>
                </td>
                <td>
                    <p>PLS4 follow performance parameters, range: 1~100</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>50</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV176</p>
                </td>
                <td>
                    <p>PLS5 low word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV177</p>
                </td>
                <td>
                    <p>PLS5 high word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV178</p>
                </td>
                <td>
                    <p>PLS5 number of pulses to compensate the reverse interval</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV179</p>
                </td>
                <td>
                    <p>PLS5 follow performance parameters, range: 1~100</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>50</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV180</p>
                </td>
                <td>
                    <p>PLS6 low word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV181</p>
                </td>
                <td>
                    <p>PLS6 high word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV182</p>
                </td>
                <td>
                    <p>PLS6 number of pulses to compensate the reverse interval</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV183</p>
                </td>
                <td>
                    <p>PLS6 follow performance parameters, range: 1~100</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>50</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV184</p>
                </td>
                <td>
                    <p>PLS7 low word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV185</p>
                </td>
                <td>
                    <p>PLS7 high word of mechanical original point</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV186</p>
                </td>
                <td>
                    <p>PLS7 number of pulses to compensate the reverse interval</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV187</p>
                </td>
                <td>
                    <p>PLS7 follow performance parameters, range: 1~100</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>50</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV801</p>
                </td>
                <td>
                    <p>HSC0 low word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV802</p>
                </td>
                <td>
                    <p>HSC0 high word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV803</p>
                </td>
                <td>
                    <p>HSC1 low word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV804</p>
                </td>
                <td>
                    <p>HSC1 high word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV805</p>
                </td>
                <td>
                    <p>HSC2 low word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV806</p>
                </td>
                <td>
                    <p>HSC2 high word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV807</p>
                </td>
                <td>
                    <p>HSC3 low word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV808</p>
                </td>
                <td>
                    <p>HSC3 high word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV809</p>
                </td>
                <td>
                    <p>HSC4 low word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV810</p>
                </td>
                <td>
                    <p>HSC4 high word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV811</p>
                </td>
                <td>
                    <p>HSC5 low word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV812</p>
                </td>
                <td>
                    <p>HSC5 high word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV813</p>
                </td>
                <td>
                    <p>HSC6 low word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV814</p>
                </td>
                <td>
                    <p>HSC6 high word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV815</p>
                </td>
                <td>
                    <p>HSC7 low word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV816</p>
                </td>
                <td>
                    <p>HSC7 high word of frequency</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV817</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV818</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV819</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV820</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV821</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV822</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV823</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV824</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV825</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV826</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV827</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV828</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV829</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV830</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV831</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV832</p>
                </td>
                <td>
                    <p>Historical fault code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV833</p>
                </td>
                <td>
                    <p>COM2 Communicate instruction execute interval unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV834</p>
                </td>
                <td>
                    <p>COM3 Communicate instruction execute interval unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV835</p>
                </td>
                <td>
                    <p>COM4 Communicate instruction execute interval unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV836</p>
                </td>
                <td>
                    <p>COM5 Communicate instruction execute interval unit ms</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV840</p>
                </td>
                <td>
                    <p>System status error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV841</p>
                </td>
                <td>
                    <p>System status error code</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV842</p>
                </td>
                <td>
                    <p>CPU firmware version date (low byte for year, high byte for month)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV843</p>
                </td>
                <td>
                    <p>CPU firmware version date (low byte for day, high byte for hour)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV844</p>
                </td>
                <td>
                    <p>FPGA firmware version date (low byte for year, high byte for month)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV845</p>
                </td>
                <td>
                    <p>FPGA firmware version date (low byte for day, high byte for hour)</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV846</p>
                </td>
                <td>
                    <p>Gateway address (default :192.168.1.1)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0x0101</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV847</p>
                </td>
                <td>
                    <p>Gateway address (default :192.168.1.1)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0xC0A8</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV848</p>
                </td>
                <td>
                    <p>MAC address</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV849</p>
                </td>
                <td>
                    <p>MAC address</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV850</p>
                </td>
                <td>
                    <p>MAC address</p>
                </td>
                <td>
                    <p>R</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV851</p>
                </td>
                <td>
                    <p>COM1 Communication port timeout exception in receiving characters( in milliseconds)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV852</p>
                </td>
                <td>
                    <p>COM2 Communication port timeout exception in receiving characters( in milliseconds)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV853</p>
                </td>
                <td>
                    <p>COM3 Communication port timeout exception in receiving characters( in milliseconds)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV854</p>
                </td>
                <td>
                    <p>COM4 Communication port timeout exception in receiving characters( in milliseconds)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SV855</p>
                </td>
                <td>
                    <p>COM5 Communication port timeout exception in receiving characters( in milliseconds)</p>
                </td>
                <td>
                    <p>R/W</p>
                </td>
                <td>
                    <p>yes</p>
                </td>
                <td>
                    <p>0</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<h3 id="System_interruption_table">System interruption table</h3>
<p>Haiwell PLCsupport 52 system interruptions, include pulse output. edge catch. high speed counter and timed interruption. </p>
<table>
    <thead>
        <tr>
            <td>
                <p>Interruption No. </p>
            </td>
            <td>
                <p>Interruption type </p>
            </td>
            <td>
                <p>Declare</p>
            </td>
            <td>
                <p>Priority level </p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>1 </p>
            </td>
            <td rowspan="16">
                <p>Pulse output interruption </p>
            </td>
            <td>
                <p>PLS0 pulse output start</p>
            </td>
            <td rowspan="52">
                <p>?</p>
                <p>Hight to low</p>
                <p> </p>
                <p>(the small interruption no. priority the big interruption no.) </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2 </p>
            </td>
            <td>
                <p>PLS0 pulse output complete</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3 </p>
            </td>
            <td>
                <p>PLS1 pulse output start</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>4 </p>
            </td>
            <td>
                <p>PLS1 pulse output complete</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>5 </p>
            </td>
            <td>
                <p>PLS2 pulse output start </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>6 </p>
            </td>
            <td>
                <p>PLS2 pulse output complete</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>7 </p>
            </td>
            <td>
                <p>PLS3 pulse output start</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>8 </p>
            </td>
            <td>
                <p>PLS3 pulse output complete</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>9 </p>
            </td>
            <td>
                <p>PLS4 pulse output start</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10 </p>
            </td>
            <td>
                <p>PLS4 pulse output complete</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>11 </p>
            </td>
            <td>
                <p>PLS5 pulse output start</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>12 </p>
            </td>
            <td>
                <p>PLS5 pulse output complete</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>13 </p>
            </td>
            <td>
                <p>PLS6 pulse output start</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>14 </p>
            </td>
            <td>
                <p>PLS6 pulse output complete</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>15 </p>
            </td>
            <td>
                <p>PLS7 pulse output start</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>16 </p>
            </td>
            <td>
                <p>PLS7 pulse output complete</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>17 </p>
            </td>
            <td rowspan="16">
                <p>Edge catch interruption</p>
            </td>
            <td>
                <p>X0 rise edge catch</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>18 </p>
            </td>
            <td>
                <p>X1 rise edge catch</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>19 </p>
            </td>
            <td>
                <p>X2 rise edge catch</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>20 </p>
            </td>
            <td>
                <p>X3 rise edge catch</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>21 </p>
            </td>
            <td>
                <p>X4 rise edge catch</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>22 </p>
            </td>
            <td>
                <p>X5 rise edge catch</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>23 </p>
            </td>
            <td>
                <p>X6 rise edge catch</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>24 </p>
            </td>
            <td>
                <p>X7 rise edge catch</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>25 </p>
            </td>
            <td>
                <p>X0 drop edge catch </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>26 </p>
            </td>
            <td>
                <p>X1 drop edge catch </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>27 </p>
            </td>
            <td>
                <p>X2 drop edge catch </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>28 </p>
            </td>
            <td>
                <p>X3 drop edge catch </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>29 </p>
            </td>
            <td>
                <p>X4 drop edge catch </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>30 </p>
            </td>
            <td>
                <p>X5 drop edge catch </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>31 </p>
            </td>
            <td>
                <p>X6 drop edge catch </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>32 </p>
            </td>
            <td>
                <p>X7 drop edge catch </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>33 </p>
            </td>
            <td rowspan="16">
                <p>High speed counter interruption</p>
            </td>
            <td>
                <p>HSC0 current value=preset value(each segment preset be generated)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>34 </p>
            </td>
            <td>
                <p>HSC0 input direction changed</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>35</p>
            </td>
            <td>
                <p>HSC1 current value=preset value(each segment preset be generated)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>36</p>
            </td>
            <td>
                <p>HSC1 input direction changed</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>37 </p>
            </td>
            <td>
                <p>HSC2 current value=preset value(each segment preset be generated)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>38 </p>
            </td>
            <td>
                <p>HSC2 input direction changed</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>39 </p>
            </td>
            <td>
                <p>HSC3 current value=preset value(each segment preset be generated)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>40 </p>
            </td>
            <td>
                <p>HSC3 input direction changed</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>41 </p>
            </td>
            <td>
                <p>HSC4 current value=preset value(each segment preset be generated)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>42 </p>
            </td>
            <td>
                <p>HSC4 input direction changed</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>43 </p>
            </td>
            <td>
                <p>HSC5 current value=preset value(each segment preset be generated)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>44 </p>
            </td>
            <td>
                <p>HSC5 input direction changed</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>45 </p>
            </td>
            <td>
                <p>HSC6 current value=preset value(each segment preset be generated)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>46 </p>
            </td>
            <td>
                <p>HSC6 input direction changed</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>47 </p>
            </td>
            <td>
                <p>HSC7 current value=preset value(each segment preset be generated)</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>48 </p>
            </td>
            <td>
                <p>HSC7 input direction changed</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>49 </p>
            </td>
            <td rowspan="4">
                <p>Timed interruption </p>
            </td>
            <td>
                <p>T252 timer reaches target </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>50 </p>
            </td>
            <td>
                <p>T253 timer reaches target </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>51 </p>
            </td>
            <td>
                <p>T254 timer reaches target </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>52</p>
            </td>
            <td>
                <p>T255 timer reaches target </p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="Communication_address_code_table">Communication address code table</h3>
<p><strong>?. Haiwell PLC bit</strong> component <strong>table</strong>(equivalently Modbus address type 0. 1, support Modbus function code 1. 2. 5. 15)</p>
<table>
    <thead>
        <tr>
            <td rowspan="2"> Component</td>
            <td rowspan="2"> Name</td>
            <td rowspan="2"> Component range</td>
            <td rowspan="2"> Read/Write</td>
            <td colspan="2"> <strong>Modbus communication address code</strong></td>
            <td rowspan="2"> Declare</td>
        </tr>
        <tr>
            <td> Hexadecimal</td>
            <td> Decimal </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>X</p>
            </td>
            <td>
                <p>External input </p>
            </td>
            <td>
                <p>X0~X1023</p>
            </td>
            <td>
                <p>R</p>
            </td>
            <td>
                <p>0x0000~0x03FF </p>
            </td>
            <td>
                <p>0~1023 </p>
            </td>
            <td>
                <p> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Y</p>
            </td>
            <td>
                <p>External output </p>
            </td>
            <td>
                <p>Y0~Y1023</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x0600~0x09FF </p>
            </td>
            <td>
                <p>1536~2559 </p>
            </td>
            <td>
                <p> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>M</p>
            </td>
            <td>
                <p>Auxiliary relay</p>
            </td>
            <td>
                <p>M0~M12287</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x0C00~0x3BFF </p>
            </td>
            <td>
                <p>3072~15359</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p>T</p>
            </td>
            <td>
                <p>Timer(output coil) </p>
            </td>
            <td>
                <p>T0~T1023</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x3C00~0x3FFF </p>
            </td>
            <td>
                <p>15360~16383</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Counter(output coil) </p>
            </td>
            <td>
                <p>C0~C255</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x4000~0x40FF </p>
            </td>
            <td>
                <p>16384~16639</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p>SM</p>
            </td>
            <td>
                <p>System status bit</p>
            </td>
            <td>
                <p>SM0~SM215 </p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x4200~0x42D7 </p>
            </td>
            <td>
                <p>16896~17111</p>
            </td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p>S</p>
            </td>
            <td>
                <p>Step relay</p>
            </td>
            <td>
                <p>S0~S2047</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x7000~0x77FF</p>
            </td>
            <td>
                <p>28672~30719</p>
            </td>
            <td> ?</td>
        </tr>
    </tbody>
</table>
<p><strong>?. Haiwell PLC</strong> component <strong> table</strong>(equivalently Modbus address type 3. 4, sepport Modbus function code 3. 4. 6. 16)</p>
<table>
    <thead>
        <tr>
            <td rowspan="2"> Component</td>
            <td rowspan="2"> Name</td>
            <td rowspan="2"> Component range</td>
            <td rowspan="2"> Read/Write</td>
            <td colspan="2"> <strong>Modbus commucation address code</strong></td>
            <td rowspan="2"> Declare</td>
        </tr>
        <tr>
            <td> Hexadecimal</td>
            <td> Decimal </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>CR</p>
            </td>
            <td>
                <p>Extend module parameter </p>
            </td>
            <td>
                <p>CR0~CR255</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x00~0xFF</p>
            </td>
            <td>
                <p>0~255</p>
            </td>
            <td>
                <p>Use Modbus protocol to acess extend module </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>AI</p>
            </td>
            <td>
                <p>Analog input register </p>
            </td>
            <td>
                <p>AI0~AI255</p>
            </td>
            <td>
                <p>R</p>
            </td>
            <td>
                <p>0x0000~0x00FF </p>
            </td>
            <td>
                <p>0~255 </p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>
                <p>AQ</p>
            </td>
            <td>
                <p>Analog output register</p>
            </td>
            <td>
                <p>AQ0~AQ255</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x0100~0x01FF </p>
            </td>
            <td>
                <p>256~511</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>
                <p>V</p>
            </td>
            <td>
                <p>Internal data register</p>
            </td>
            <td>
                <p>V0~V14847</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x0200~0x3BFF </p>
            </td>
            <td>
                <p>512~15359</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>
                <p>TV</p>
            </td>
            <td>
                <p>Timer(current value )</p>
            </td>
            <td>
                <p>TV0~TV1023</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x3C00~0x3FFF </p>
            </td>
            <td>
                <p>15360~16383</p>
            </td>
            <td>?</td>
        </tr>
        <tr>
            <td>
                <p>CV</p>
            </td>
            <td>
                <p>Counter(current value )</p>
            </td>
            <td>
                <p>CV0~CV255</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x4000~0x40FF </p>
            </td>
            <td>
                <p>16384~16639</p>
            </td>
            <td>
                <p>16 bit register, among CV48~CV79 32 bit register</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>SV</p>
            </td>
            <td>
                <p>System special register</p>
            </td>
            <td>
                <p>SV0~SV900</p>
            </td>
            <td>
                <p>R/W</p>
            </td>
            <td>
                <p>0x4400~0x4784 </p>
            </td>
            <td>
                <p>17408~18308</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong>?. Declare:</strong></p>
<p> 1. Haiwell PLC use the standard Modbus protocol(support RTU and ASCII mode), can communicate to HMI and configuration soft which support Modbus protocol</p>
<p>2. Haiwell PLC's Modbus addressing number from 0, Some HMI or onfiguration soft from 1, if HMI or onfiguration soft modbus addressing from 0 then couumnicate direct, e.g. M0 is 0x3072, V0 is 4x0512;if HMI or onfiguration soft modbus addressing from 1 then the address must add 1, e.g.M0 is 0x3073[3072+1], V0 is 4x0513[512+1].The first place address is the Modbus protocol component type(0/1 is bit relay, 3/4 is word register, 0/4 can read and write, 1/3 read only)other places are the component address.</p>
<h3 id="Error_code_table">Error code table</h3>
<p><strong>?. System error code table:</strong></p>
<table>
    <tbody>
        <tr>
            <td>
                <p>Error category </p>
            </td>
            <td>
                <p>Description </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>A </p>
            </td>
            <td>
                <p>Hardware failure, user program not runnable, needs to return to factory repair, red indicator light keeps on </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>B </p>
            </td>
            <td>
                <p>Firmware exception or user program exception, user program not runnable, red indicator light will be on 0.5 seconds and be off 0.5 seconds </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>C </p>
            </td>
            <td>
                <p>Communication exception between the modules, automatically remove the module with exception, yellow indicator light will be on 0.8 seconds and be off 0.2 seconds </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>D </p>
            </td>
            <td>
                <p>Incorrect software setup, allow the user program to continu, yellow indicator light will be on 0.2 seconds and be off 0.8 seconds </p>
            </td>
        </tr>
    </tbody>
</table>
<p>?</p>
<table>
    <thead>
        <tr>
            <td>
                <p>Error Code </p>
            </td>
            <td>
                <p>Message indicated </p>
            </td>
            <td>
                <p>Error category</p>
            </td>
            <td>
                <p>Indicator color</p>
            </td>
            <td>
                <p>Indicator effect</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>0 </p>
            </td>
            <td>
                <p>System normal </p>
            </td>
            <td>
                <p>?</p>
            </td>
            <td> ?</td>
            <td> ?</td>
        </tr>
        <tr>
            <td>
                <p>1 </p>
            </td>
            <td>
                <p>CPU firmware incomplete</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2 </p>
            </td>
            <td>
                <p>CPU memory 1 access exception</p>
            </td>
            <td>
                <p>A</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>Keep on</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3 </p>
            </td>
            <td>
                <p>CPU memory 2 access exception </p>
            </td>
            <td>
                <p>A</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>Keep on</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>4 </p>
            </td>
            <td>
                <p>RTC access exception </p>
            </td>
            <td>
                <p>A</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>Keep on</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>5 </p>
            </td>
            <td>
                <p>CPU I/O access exception </p>
            </td>
            <td>
                <p>A</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>Keep on</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>6</p>
            </td>
            <td>
                <p>CPU memory 3 access exception</p>
            </td>
            <td>
                <p>A</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>Keep on</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>7</p>
            </td>
            <td>
                <p>I/O board access exception</p>
            </td>
            <td>
                <p>A</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>Keep on</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>8</p>
            </td>
            <td>
                <p>Enhanced bus working abnormally</p>
            </td>
            <td>
                <p>A</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>Keep on</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>59</p>
            </td>
            <td>
                <p>Slave CPU firmware incomplete</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>60 </p>
            </td>
            <td>
                <p>1# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>61 </p>
            </td>
            <td>
                <p>2# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>62 </p>
            </td>
            <td>
                <p>3# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>63 </p>
            </td>
            <td>
                <p>4# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>64 </p>
            </td>
            <td>
                <p>5# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>65 </p>
            </td>
            <td>
                <p>6# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>66 </p>
            </td>
            <td>
                <p>7# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>67 </p>
            </td>
            <td>
                <p>8# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>68 </p>
            </td>
            <td>
                <p>9# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>69 </p>
            </td>
            <td>
                <p>10# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>70 </p>
            </td>
            <td>
                <p>11# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>71 </p>
            </td>
            <td>
                <p>12# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>72 </p>
            </td>
            <td>
                <p>13# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>73 </p>
            </td>
            <td>
                <p>14# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>74 </p>
            </td>
            <td>
                <p>15# expand module firmware incomplete </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>75</p>
            </td>
            <td>
                <p>Expand module hardware failure</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>87</p>
            </td>
            <td>
                <p>Illegal table content</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>88</p>
            </td>
            <td>
                <p>Out of program stack space</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>89</p>
            </td>
            <td>
                <p>Programming software version is too low</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>90</p>
            </td>
            <td>
                <p>User program corrupted</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>91 </p>
            </td>
            <td>
                <p>Step component exceed range</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>92 </p>
            </td>
            <td>
                <p>Step combine exceed range</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>93</p>
            </td>
            <td>
                <p>The table record number is beyond range</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>94</p>
            </td>
            <td>
                <p>Catch edge times exceed range</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>95</p>
            </td>
            <td>
                <p>Configuration data is illegal when power supply drop</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>96 </p>
            </td>
            <td>
                <p>Function code illegal</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>97 </p>
            </td>
            <td>
                <p>Operand illegal </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>98 </p>
            </td>
            <td>
                <p>Number of instructions for the same sort out of scope</p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>99 </p>
            </td>
            <td>
                <p>No end instruction </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>100 </p>
            </td>
            <td>
                <p>Access 1# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>101 </p>
            </td>
            <td>
                <p>Access 2# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>102 </p>
            </td>
            <td>
                <p>Access 3# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>103 </p>
            </td>
            <td>
                <p>Access 4# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>104 </p>
            </td>
            <td>
                <p>Access 5# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>105 </p>
            </td>
            <td>
                <p>Access 6# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>106 </p>
            </td>
            <td>
                <p>Access 7# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>107 </p>
            </td>
            <td>
                <p>Access 8# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>108 </p>
            </td>
            <td>
                <p>Access 9# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>109 </p>
            </td>
            <td>
                <p>Access 10# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>110 </p>
            </td>
            <td>
                <p>Access 11# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>111 </p>
            </td>
            <td>
                <p>Access 12# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>112 </p>
            </td>
            <td>
                <p>Access 13# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>113 </p>
            </td>
            <td>
                <p>Access 14# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>114 </p>
            </td>
            <td>
                <p>Access 15# expand module I/O fails </p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>131</p>
            </td>
            <td>
                <p>RTC battery failure</p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>132</p>
            </td>
            <td>
                <p>Extension module power supply failure</p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>133</p>
            </td>
            <td>
                <p>Storage program and running program inconsistent</p>
            </td>
            <td>
                <p>C</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.8 seconds and Off 0.2 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>140 </p>
            </td>
            <td>
                <p>Hardware configuration incompatible </p>
            </td>
            <td>
                <p>D</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.2 seconds and Off 0.8 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>141 </p>
            </td>
            <td>
                <p>Scan timeout watchdog operate </p>
            </td>
            <td>
                <p>B</p>
            </td>
            <td>
                <p>Red</p>
            </td>
            <td>
                <p>On 0.5 seconds and Off 0.5 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>142</p>
            </td>
            <td>
                <p>Have locked datas</p>
            </td>
            <td>
                <p>D</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.2 seconds and Off 0.8 seconds</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>143</p>
            </td>
            <td>
                <p>Current running step tasks is above upper limit</p>
            </td>
            <td>
                <p>D</p>
            </td>
            <td>
                <p>Yellow</p>
            </td>
            <td>
                <p>On 0.2 seconds and Off 0.8 seconds</p>
            </td>
        </tr>
    </tbody>
</table>
<p><strong>?. Communication error code table: </strong></p>
<table>
    <thead>
        <tr>
            <td>
                <p><strong>Error code</strong></p>
            </td>
            <td>
                <p><strong>Declare </strong></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>0 </p>
            </td>
            <td>
                <p>Normal</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>1 </p>
            </td>
            <td>
                <p>Function Code Error</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>2 </p>
            </td>
            <td>
                <p>Data Address Error</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>3 </p>
            </td>
            <td>
                <p>Data Value Error</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>4 </p>
            </td>
            <td>
                <p>Communication message too short or too long</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>5 </p>
            </td>
            <td>
                <p>Include not ASCII characters</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>6 </p>
            </td>
            <td>
                <p>Slave PLC receive message overtime</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>7 </p>
            </td>
            <td>
                <p>No end character</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>8 </p>
            </td>
            <td>
                <p>Write data information is too long or too short</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>9 </p>
            </td>
            <td>
                <p>Check Code Error</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>10</p>
            </td>
            <td>
                <p>Application of resources are occupied</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>11</p>
            </td>
            <td>
                <p>The firmware does not match with the hardware</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>12</p>
            </td>
            <td>
                <p>Program capacity overrun, writing is prohibited</p>
            </td>
        </tr>
    </tbody>
</table>
<h3 id="Programming_cable_wiring_diagram">Programming cable wiring diagram</h3>
<div>
    <div>
        <div>
            <p>PC(RS232)       PLC(COM1) </p>
            <p>DB9 female        4 line S male</p>
        </div>
        <p><img src="<?= $path_to_images ?>images/HW-ACA20.gif" /></p>
    </div>
</div>