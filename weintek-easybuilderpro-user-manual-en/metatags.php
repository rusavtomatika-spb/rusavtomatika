<?

if ($current_url == "")
    $current_url = "Chapter_01_EBPro_Installation_and_Startup_Guide";
$TITLE_second_part = 'Скачать Weintek EBPro EasyBuilder Pro V6 руководство пользователя, мануал manual, инструкция, на английском ';
//$H1_first_part = 'Weintek EasyBuilderPro - User Manual - ';
$H1_first_part = '';

switch ($current_url) {
    case "Chapter_01_EBPro_Installation_and_Startup_Guide":
        $TITLE = "Weintek Easybuilder Pro скачать | Easybuilder Pro руководство";
        $h1 = $H1_first_part . "Chapter 01 - EBPro Installation and Startup Guide";
        $change_title_and_h1_on_page = true;
        $KEYWORDS = "easybuilder pro, easybuilder pro скачать, easybuilder pro руководство, Weintek";
        $DESCRIPTION = "У нас вы можете: скачать руководство Easybuilder Pro или читать его онлайн; скачать свежую версию приложения Weintek Easybuilder Pro V6; Easybuilder Pro руководство";
        $text_before = "<img style='float:right;margin: 0 0 20px 20px;' alt='Weintek Easybuilder Pro скачать руководство' src='/manuals/weintek/UserManual_separate_chapter/easybuilder-pro.png' />"
                . "EasyBuilder Pro — среда разработки проектов для панелей оператора Weintek. Использование ПО EasyBuilder Pro полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений."
                . '!!!<a target="_blank" class="download_pdf" href="/manuals/EBPro_Manual_All_In_One.pdf">Скачать руководство Easybuilder Pro для версии 6.00.01 (Eng)</a>'
                . '<br><a target="_blank" class="download_zip" href="http://www.rusavtomatika.com/soft/EBPro/EBpro_setup.zip">Weintek Easybuilder Pro скачать свежую версию</a>'
                . '<br><a target="_blank" class="download_linkext_online" href="/weintek-easybuilder-instrukciya-na-russkom/"><span>EasyBuilder Pro V6 - руководство пользователя <b>на русском языке</b>, онлайн</span></a>';
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_01_EBPro_Installation_and_Startup_Guide/";
		break;
    case "Chapter_02_Utility_Manager":
        $TITLE = "Utility Manager" . " | " . $TITLE_second_part . " - Глава 02";
        $h1 = $H1_first_part . "Chapter 02 - Utility Manager";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_02_Utility_Manager/";
        break;
    case "Chapter_03_Create_an_EBPro_Project":
        $TITLE = "Create an EBPro Project" . " | " . $TITLE_second_part . " - Глава 03";
        $h1 = $H1_first_part . "Chapter 03 - Create an EBPro Project";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_03_Create_an_EBPro_Project/";
        break;
    case "Chapter_04_Hardware_Settings":
        $TITLE = "Hardware Settings" . " | " . $TITLE_second_part . " - Глава 04";
        $h1 = $H1_first_part . "Chapter 04 - Hardware Settings";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_04_Hardware_Settings/";
        break;
    case "Chapter_05_System_Parameter_Settings":
        $TITLE = "System Parameter Settings" . " | " . $TITLE_second_part . " - Глава 05";
        $h1 = $H1_first_part . "Chapter 05 - System Parameter Settings";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_05_System_Parameter_Settings/";
        break;
    case "Chapter_06_Window_Operations":
        $TITLE = "Window Operations" . " | " . $TITLE_second_part . " - Глава 06";
        $h1 = $H1_first_part . "Chapter 06 - Window Operations";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_06_Window_Operations/";
        break;
    case "Chapter_07_Event_Log":
        $TITLE = "Event Log" . " | " . $TITLE_second_part . " - Глава 07";
        $h1 = $H1_first_part . "Chapter 07 - Event_Log";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_07_Event_Log/";
        break;
    case "Chapter_08_Data_Sampling":
        $TITLE = "Data Sampling" . " | " . $TITLE_second_part . " - Глава 08";
        $h1 = $H1_first_part . "Chapter 08 - Data Sampling";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_08_Data_Sampling/";
        break;
    case "Chapter_09_Object_General_Properties":
        $TITLE = "Object General Properties" . " | " . $TITLE_second_part . " - Глава 09";
        $h1 = $H1_first_part . "Chapter 09 - Object General Properties";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_09_Object_General_Properties/";
        break;
    case "Chapter_10_User_Password_and_Object_Security":
        $TITLE = "User Password and Object Security" . " | " . $TITLE_second_part . " - Глава 10";
        $h1 = $H1_first_part . "Chapter 10 - User Password and Object Security";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_10_User_Password_and_Object_Security/";
        break;
    case "Chapter_11_Index_Register":
        $TITLE = "Index Register" . " | " . $TITLE_second_part . " - Глава 11";
        $h1 = $H1_first_part . "Chapter 11 - Index Register";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_11_Index_Register/";
        break;
    case "Chapter_12_Keyboard_Design_and_Usage":
        $TITLE = "Keyboard Design and Usage" . " | " . $TITLE_second_part . " - Глава ";
        $h1 = $H1_first_part . "Chapter 12 - Keyboard Design and Usage";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_12_Keyboard_Design_and_Usage/";
        break;
    case "Chapter_13_Objects":
        $TITLE = "Objects" . " | " . $TITLE_second_part . " - Глава 13";
        $h1 = $H1_first_part . "Chapter 13 - Objects";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_13_Objects/";
        break;
    case "Chapter_14_Shape_Library_and_Picture_Library":
        $TITLE = "Shape Library and Picture Library" . " | " . $TITLE_second_part . " - Глава 14";
        $h1 = $H1_first_part . "Chapter 14 - Shape Library and Picture Library";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_14_Shape_Library_and_Picture_Library/";
        break;
    case "Chapter_15_Label_Tag_Library_and_Multi_Language":
        $TITLE = "Label Tag Library and Multi Language" . " | " . $TITLE_second_part . " - Глава 15";
        $h1 = $H1_first_part . "Chapter 15 - Shape Library and Picture Library";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_15_Label_Tag_Library_and_Multi_Language/";
        break;
    case "Chapter_16_Address_Tag_Library":
        $TITLE = "Address Tag Library" . " | " . $TITLE_second_part . " - Глава 16";
        $h1 = $H1_first_part . "Chapter 16 - Address Tag Library";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_16_Address_Tag_Library/";
        break;
    case "Chapter_17_Transferring_Recipe_Data":
        $TITLE = "Transferring Recipe Data" . " | " . $TITLE_second_part . " - Глава 17";
        $h1 = $H1_first_part . "Chapter 17 - Transferring Recipe Data";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_17_Transferring_Recipe_Data/";
        break;
    case "Chapter_18_Macro_Reference":
        $TITLE = "Macro Reference" . " | " . $TITLE_second_part . " - Глава 18";
        $h1 = $H1_first_part . "Chapter 18 - Macro Reference";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_18_Macro_Reference/";
        break;
    case "Chapter_19_Configure_HMI_as_MODBUS_Server":
        $TITLE = "Configure HMI as MODBUS Server" . " | " . $TITLE_second_part . " - Глава 19";
        $h1 = $H1_first_part . "Chapter 19 - Configure HMI as MODBUS Server";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_19_Configure_HMI_as_MODBUS_Server/";
        break;
    case "Chapter_20_How_to_Connect_Barcode_Reader":
        $TITLE = "How to Connect Barcode Reader" . " | " . $TITLE_second_part . " - Глава 20";
        $h1 = $H1_first_part . "Chapter 20 - How to Connect Barcode Reader";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_20_How_to_Connect_Barcode_Reader/";
        break;
    case "Chapter_21_Ethernet_Communication_and_Multi_HMI_Connection":
        $TITLE = "Ethernet Communication and Multi HMI Connection" . " | " . $TITLE_second_part . " - Глава 21";
        $h1 = $H1_first_part . "Chapter 21 - Ethernet Communication and Multi HMI Connection";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_21_Ethernet_Communication_and_Multi_HMI_Connection/";
        break;
    case "Chapter_22_System_Registers":
        $TITLE = "System Registers" . " | " . $TITLE_second_part . " - Глава 22";
        $h1 = $H1_first_part . "Chapter 22 - System Registers";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_22_System_Registers/";
        break;
    case "Chapter_23_HMI_Supported_Printers":
        $TITLE = "HMI Supported Printers" . " | " . $TITLE_second_part . " - Глава 23";
        $h1 = $H1_first_part . "Chapter 23 - HMI Supported Printers";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_23_HMI_Supported_Printers/";
        break;
    case "Chapter_24_Recipe_Editor":
        $TITLE = "Recipe Editor" . " | " . $TITLE_second_part . " - Глава 24";
        $h1 = $H1_first_part . "Chapter 24 - Recipe Editor";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_24_Recipe_Editor/";
        break;
    case "Chapter_25_EasyConverter":
        $TITLE = "EasyConverter" . " | " . $TITLE_second_part . " - Глава 25";
        $h1 = $H1_first_part . "Chapter 25 - EasyConverter";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_25_EasyConverter/";
        break;
    case "Chapter_26_EasyPrinter":
        $TITLE = "EasyPrinter" . " | " . $TITLE_second_part . " - Глава 26";
        $h1 = $H1_first_part . "Chapter 26 - EasyPrinter";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_26_EasyPrinter/";
        break;
    case "Chapter_27_EasySimulator":
        $TITLE = "EasySimulator" . " | " . $TITLE_second_part . " - Глава 27";
        $h1 = $H1_first_part . "Chapter 27 - EasySimulator";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_27_EasySimulator/";
        break;
    case "Chapter_28_Multi_HMI_Communication":
        $TITLE = "Multi HMI Communication" . " | " . $TITLE_second_part . " - Глава 28";
        $h1 = $H1_first_part . "Chapter 28 - Multi HMI Communication";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_28_Multi_HMI_Communication/";
        break;
    case "Chapter_29_Pass_Through":
        $TITLE = "Pass Through" . " | " . $TITLE_second_part . " - Глава 29";
        $h1 = $H1_first_part . "Chapter 29 - Pass Through";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_29_Pass_Through/";
        break;
    case "Chapter_30_Project_Protection":
        $TITLE = "Project Protection" . " | " . $TITLE_second_part . " - Глава 30";
        $h1 = $H1_first_part . "Chapter 30 - Project Protection";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_30_Project_Protection/";
        break;
    case "Chapter_31_Memory_Map":
        $TITLE = "Memory Map" . " | " . $TITLE_second_part . " - Глава 31";
        $h1 = $H1_first_part . "Chapter 31 - Memory Map";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_31_Memory_Map/";
        break;
    case "Chapter_32_FTP_Server_Application":
        $TITLE = "FTP Server Application" . " | " . $TITLE_second_part . " - Глава 32";
        $h1 = $H1_first_part . "Chapter 32 - FTP Server Application";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_32_FTP_Server_Application/";
        break;
    case "Chapter_33_Easy_Diagnoser":
        $TITLE = "Easy Diagnoser" . " | " . $TITLE_second_part . " - Глава 33";
        $h1 = $H1_first_part . "Chapter 33 - Easy Diagnoser";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_33_Easy_Diagnoser/";
        break;
    case "Chapter_34_Rockwell_EtherNet_IP_Free_Tag_Names":
        $TITLE = "Rockwell EtherNet IP Free Tag Names" . " | " . $TITLE_second_part . " - Глава 34";
        $h1 = $H1_first_part . "Chapter 34 - Rockwell EtherNet IP Free Tag Names";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_34_Rockwell_EtherNet_IP_Free_Tag_Names/";
        break;
    case "Chapter_35_Easy_Watch":
        $TITLE = "Easy Watch" . " | " . $TITLE_second_part . " - Глава 35";
        $h1 = $H1_first_part . "Chapter 35 - Easy Watch";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_35_Easy_Watch/";
        break;
    case "Chapter_36_Administrator_Tools":
        $TITLE = "Administrator Tools" . " | " . $TITLE_second_part . " - Глава 36";
        $h1 = $H1_first_part . "Chapter 36 - Administrator Tools";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_36_Administrator_Tools/";
        break;
    case "Chapter_37_MODBUS_TCP_IP_Gateway":
        $TITLE = "MODBUS TCP IP Gateway" . " | " . $TITLE_second_part . " - Глава 37";
        $h1 = $H1_first_part . "Chapter 37 - MODBUS TCP IP Gateway";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_37_MODBUS_TCP_IP_Gateway/";
        break;
    case "Chapter_38_EasyDownload":
        $TITLE = "EasyDownload" . " | " . $TITLE_second_part . " - Глава 38";
        $h1 = $H1_first_part . "Chapter 38 - EasyDownload";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_38_EasyDownload/";
        break;
    case "Chapter_39_Data_Security":
        $TITLE = "Data Security" . " | " . $TITLE_second_part . " - Глава 39";
        $h1 = $H1_first_part . "Chapter 39 - Data Security";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_39_Data_Security/";
        break;
    case "Chapter_40_Web_Streaming":
        $TITLE = "Web Streaming" . " | " . $TITLE_second_part . " - Глава 40";
        $h1 = $H1_first_part . "Chapter 40 - Web Streaming";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_40_Web_Streaming/";
        break;
    case "Chapter_41_Energy":
        $TITLE = "Energy" . " | " . $TITLE_second_part . " - Глава 41";
        $h1 = $H1_first_part . "Chapter 41 - Energy";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_41_Energy/";
        break;
    case "Chapter_42_IIoT":
        $TITLE = "IIoT" . " | " . $TITLE_second_part . " - Глава 42";
        $h1 = $H1_first_part . "Chapter 42 - IIoT";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_42_IIoT/";
        break;
    case "Appendix_A_Comparison_of_HMI_Software_Features":
        $TITLE = "A Comparison of HMI Software Features" . " | " . $TITLE_second_part . " - Appendix A";
        $h1 = $H1_first_part . "Appendix A - A Comparison of HMI Software Features";
        $CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Appendix_A_Comparison_of_HMI_Software_Features/";
        break;

    default:
        break;
}
?>