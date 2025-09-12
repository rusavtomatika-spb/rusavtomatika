<?php

class CProjects {

    public static function server_file_check($path_to_file, $net = 0, $conn_id = "") {
        if (!$net) {
            if (file_exists($path_to_file)) {
                $t = date("d-m-Y", filemtime($path_to_file));
                $tu = date("U", filemtime($path_to_file));
                $fs = (sprintf("%u", filesize($path_to_file)) + 0) / 1024;
                return array("date" => $t, "time" => $tu, "size" => $fs);
            }
        } else {
            $mtime = ftp_mdtm($conn_id, $path_to_file);
            $t = date("d-m-Y", $mtime);
            $tu = date("U", $mtime);
            $fs = (sprintf("%u", ftp_size($conn_id, $path_to_file)) + 0) / 1024;
            return array("date" => $t, "time" => $tu, "size" => $fs);
        }
        return false;
    }

}
