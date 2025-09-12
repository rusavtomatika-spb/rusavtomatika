<?

function compare_weintek_table_substitutions($table) {
    if (!$table)
        return false;
    $table = htmlspecialchars_decode($table);
    $ar_Substitutions[] = Array("eng" => "Project  size limit", "rus" => "Максимальный размер файла проекта (exob)");
    $ar_Substitutions[] = Array("eng" => "History size limit", "rus" => "Доступный объем памяти под файлы журналов");
    $ar_Substitutions[] = Array("eng" => "Build Data for USB Disk or SD Card Download", "rus" => "Возможность загрузить проект, используя USB диск или SD карту");
    $ar_Substitutions[] = Array("eng" => "Project Protection", "rus" => "Защита проекта паролем");
    $ar_Substitutions[] = Array("eng" => "USB Disk Download", "rus" => "Загрузка проекта с USB-диска");
    $ar_Substitutions[] = Array("eng" => "USB Cable Download", "rus" => "Загрузка проекта мини/микро-USB кабелем");
    $ar_Substitutions[] = Array("eng" => "Picture/Shape Library embedded in Project", "rus" => "Библиотеки изображений/фигур в файле проекта");
    $ar_Substitutions[] = Array("eng" => "PLC TAG embedded in project", "rus" => "Информация о метках ПЛК в файле проекта");
    $ar_Substitutions[] = Array("eng" => "3G/4G Dongle", "rus" => "3G/4G USB модем");
    $ar_Substitutions[] = Array("eng" => "e-Mail", "rus" => "Отправка журналов/уведомлений на почту");
    $ar_Substitutions[] = Array("eng" => "Enhanced security mode", "rus" => "Расширенный режим безопасности");
    $ar_Substitutions[] = Array("eng" => "Ethernet Printer", "rus" => "Печать по локальной сети");
    $ar_Substitutions[] = Array("eng" => "Off-line Simulation on HMI", "rus" => "Офлайн симуляция на панели");
    $ar_Substitutions[] = Array("eng" => "User-defined Startup Screen", "rus" => "Пользовательский экран загрузки");
    $ar_Substitutions[] = Array("eng" => "USB Tethering", "rus" => "Использование android смартфона в качестве usb-модема");
    $ar_Substitutions[] = Array("eng" => "VNC Server", "rus" => "Система удаленного доступа к экрану панели. <a target='_blank' href='/forum/viewtopic.php?f=7&t=220'>Подробно про «Удаленное управление (VNC)»</a>");
    $ar_Substitutions[] = Array("eng" => "Siemens PLC Pass-through", "rus" => "Сквозной проход для Siemens ПЛК (Siemens MPI)");
    $ar_Substitutions[] = Array("eng" => "Audio Output", "rus" => "Линейный аудиовыход (разъем 3.5 jack)");
    $ar_Substitutions[] = Array("eng" => "Audio (cMT Viewer)", "rus" => "Передача звука, генерируемого панелью в cMT Viewer");
    $ar_Substitutions[] = Array("eng" => "Control Token", "rus" => "Передача контроля одному пользователю с ограничением других пользователей");

    $ar_Substitutions[] = Array("eng" => "CAN Bus", "rus" => "Шина CAN");

    $ar_Substitutions[] = Array("eng" => "BACnet Schedule", "rus" => "BACnet расписание");
    $ar_Substitutions[] = Array("eng" => "Wi-Fi", "rus" => "Беспроводное подключение");
    $ar_Substitutions[] = Array("eng" => "Barcode Scanner (Android Camera)", "rus" => "Сканер штрихкодов и QR-кодов с помощью камеры смартфона android");
    $ar_Substitutions[] = Array("eng" => "Circular Trend Display", "rus" => "Объект «Круговой график»");
    $ar_Substitutions[] = Array("eng" => "Combo Button", "rus" => "Комбинированная кнопка");
    $ar_Substitutions[] = Array("eng" => "Database Server", "rus" => "Подключение к серверу баз данных (MySQL, MS&nbsp;SQL&nbsp;Сервер)");
    $ar_Substitutions[] = Array("eng" => "Date/Time", "rus" => "Графический объект Дата/Время");
    $ar_Substitutions[] = Array("eng" => "Dynamic Drawing", "rus" => "Объект «Динамический рисунок»");
    $ar_Substitutions[] = Array("eng" => "Dynamic Scale", "rus" => "Объект «Динамическая круговая шкала»");
    $ar_Substitutions[] = Array("eng" => "Energy Demand Setting", "rus" => "Контроль расхода электроэнергии");
    $ar_Substitutions[] = Array("eng" => "Energy Demand Display", "rus" => "Объект мониторинга энергопотребления");
    $ar_Substitutions[] = Array("eng" => "File Browser", "rus" => "Файловый менеджер (Проводник)");
    $ar_Substitutions[] = Array("eng" => "Flow Block", "rus" => "Объект «Обтекающий блок»");
    //$ar_Substitutions[] = Array("eng" => "IP Camera", "rus" => "IP-камера");
    $ar_Substitutions[] = Array("eng" => "Media Player", "rus" => "Объект «Медиаплеер»");
    $ar_Substitutions[] = Array("eng" => "MQTT (AWS IoT, Sparkplug B, Azure IoT Hub)", "rus" => "MQTT-брокер на облачных платформах");
    $ar_Substitutions[] = Array("eng" => "MQTT publisher/subscriber", "rus" => "режим издатель-подписчик");
    $ar_Substitutions[] = Array("eng" => "Touch Gesture", "rus" => "Управление жестами");

    $ar_Substitutions[] = Array("eng" => "Operation Log Printing", "rus" => "Печать журнала операций");
    $ar_Substitutions[] = Array("eng" => "Operation Log Settings", "rus" => "Журнал операций");
    $ar_Substitutions[] = Array("eng" => "Operation Log View", "rus" => "Объект просмотра журнала операций");
    $ar_Substitutions[] = Array("eng" => "OPC UA Server", "rus" => "OPC UA-сервер");
    $ar_Substitutions[] = Array("eng" => "OPC UA Client", "rus" => "OPC UA-клиент");
    $ar_Substitutions[] = Array("eng" => "PDF Reader", "rus" => "Объект отображения PDF-документов");
    $ar_Substitutions[] = Array("eng" => "Picture Viewer", "rus" => "Объект просмотра изображений");
    $ar_Substitutions[] = Array("eng" => "Event Bar Chart", "rus" => "Гистограмма событий");
    $ar_Substitutions[] = Array("eng" => "Recipe Database", "rus" => "База данных рецептов");
    $ar_Substitutions[] = Array("eng" => "Recipe Import/Export", "rus" => "Импорт/экспорт рецептов");
    $ar_Substitutions[] = Array("eng" => "Recipe View", "rus" => "Просмотр базы данных рецептов");
    $ar_Substitutions[] = Array("eng" => "String Table", "rus" => "Таблица строковых меток (для переключения языков)");
    $ar_Substitutions[] = Array("eng" => "<span>Table</span>", "rus" => "Графическая сетка");
    $ar_Substitutions[] = Array("eng" => "Time Synchronization", "rus" => "Синхронизация времени с интернет-сервером — Network Time Protocol (NTP)");
   // $ar_Substitutions[] = Array("eng" => "USB Camera", "rus" => "USB-камера");
    $ar_Substitutions[] = Array("eng" => "Video In - IP Camera", "rus" => "Подключение IP камеры");
    $ar_Substitutions[] = Array("eng" => "Video In - USB Camera", "rus" => "Подключение USB камеры");
    $ar_Substitutions[] = Array("eng" => "Video In - Video Input", "rus" => "Видеовход RCA");
    $ar_Substitutions[] = Array("eng" => "Web Streaming", "rus" => "Трансляция видео с USB-камеры в локальную сеть");
    $ar_Substitutions[] = Array("eng" => "WebView", "rus" => "Управление экраном панели оператора в веб-браузере");
    $ar_Substitutions[] = Array("eng" => "VNC Viewer", "rus" => "Приложение позволяет подключаться к другим устройствам имеющим VNC-сервер");
    $ar_Substitutions[] = Array("eng" => "EasyAccess 1.0", "rus" => "Удаленный доступ к операторской панели");
    $ar_Substitutions[] = Array("eng" => "EasyAccess 2.0", "rus" => "Удаленный доступ к операторской панели");
    $ar_Substitutions[] = Array("eng" => "EasyDiagnoser", "rus" => "Утилита - инструмент для обнаружения ошибок при коммуникации панели с ПЛК");
    $ar_Substitutions[] = Array("eng" => "EasyLauncher", "rus" => "Утилита для запуска на устройстве сторонних приложений");
    $ar_Substitutions[] = Array("eng" => "EasyPrinter", "rus" => "Утилита для управления печатью и резервным копированием");
    $ar_Substitutions[] = Array("eng" => "EasySimulator", "rus" => "Утилита для симуляции выполнения проекта, как с соединением с PLC, так и без соединения");
    $ar_Substitutions[] = Array("eng" => "EasySystemSetting", "rus" => "Утилита позволяет сконфигурировать системные настройки панели через персональный компьютер");
    $ar_Substitutions[] = Array("eng" => "EasyWatch", "rus" => "Утилита для мониторинга и настройки значений адресов панели или ПЛК для облегчения отладки, удаленного наблюдения и управления.");
    $ar_Substitutions[] = Array("eng" => "Utility Manager", "rus" => "Менеджер утилит");
    $ar_Substitutions[] = Array("eng" => "Windows Open/Cycle/Close Macro", "rus" => "Назначение макросов на события открытия/закрытия/отображения окон");
    $ar_Substitutions[] = Array("eng" => "CODESYS", "rus" => "Программный комплекс промышленной автоматизации");
    foreach ($ar_Substitutions as $value) {
        $table = str_replace($value["eng"], $value["eng"] . "<br><span class='rus'>" . $value["rus"] . "</span>", $table);
    }
    return $table;
}

?>