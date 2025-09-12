<?
class CUtilities
{
    static function getRemoteContentByURL($PATH)
    {
        if (!$PATH)
            return;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $PATH);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        curl_close($ch);
        if ($content) {
            return $content;
        }
        return;
    }
    static function kama_parse_csv_file($file_path, $file_encodings = ['UTF-8', 'cp1251'], $col_delimiter = '', $row_delimiter = "")
    {
        /*    Использование:
            $data = kama_parse_csv_file( '/path/to/file.csv' );
            print_r( $data );    */
        if (!file_exists($file_path))
        {
            $cont = self::getRemoteContentByURL($file_path);
            if (!$cont) return false;
        }
        else
        {
            $cont = trim(file_get_contents($file_path));
        }
        $encoded_cont = mb_convert_encoding($cont, 'UTF-8', mb_detect_encoding($cont, $file_encodings));
        unset($cont);
// определим разделитель
        if (!$row_delimiter) {
            $row_delimiter = "\r\n";
            if (false === strpos($encoded_cont, "\r\n"))
                $row_delimiter = "\n";
        }
        $lines = explode($row_delimiter, trim($encoded_cont));
        $lines = array_filter($lines);
        $lines = array_map('trim', $lines);
		  file_put_contents( 'temp0.txt', json_encode( $lines, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
        rsort($lines);
		  file_put_contents( 'temp.txt', json_encode( $lines, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
// авто-определим разделитель из двух возможных: ';' или ','.
// для расчета берем не больше 30 строк
        if (!$col_delimiter) {
            $lines10 = array_slice($lines, 0, 30);
// если в строке нет одного из разделителей, то значит другой точно он...
            foreach ($lines10 as $line) {
                if (!strpos($line, ',')) $col_delimiter = ';';
                if (!strpos($line, ';')) $col_delimiter = ',';
                if ($col_delimiter) break;
            }
// если первый способ не дал результатов, то погружаемся в задачу и считаем кол разделителей в каждой строке.
// где больше одинаковых количеств найденного разделителя, тот и разделитель...
            if (!$col_delimiter) {
                $delim_counts = array(';' => array(), ',' => array());
                foreach ($lines10 as $line) {
                    $delim_counts[','][] = substr_count($line, ',');
                    $delim_counts[';'][] = substr_count($line, ';');
                }
                $delim_counts = array_map('array_filter', $delim_counts); // уберем нули
// кол-во одинаковых значений массива - это потенциальный разделитель
                $delim_counts = array_map('array_count_values', $delim_counts);
                $delim_counts = array_map('max', $delim_counts); // берем только макс. значения вхождений
                if ($delim_counts[';'] === $delim_counts[','])
                    return array('Не удалось определить разделитель колонок.');
                $col_delimiter = array_search(max($delim_counts), $delim_counts);
            }
        }
        $data = [];
        foreach ($lines as $key => $line) {
            $data[] = str_getcsv($line, $col_delimiter); // linedata
            unset($lines[$key]);
        }
        return $data;
    }
}