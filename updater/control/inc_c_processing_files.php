<?php
class c_processing_files
{
    public $a_fname = [];
    public $a_fsize = [];
    public $a_fdir = [];
    public $a_hash_file = [];

    public $cofiles = 0;

    function find($in_dir)
    {
        global $permitted_folders;
        $dir_handle = opendir($_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir);
        while ($file = readdir($dir_handle)) {
            $file = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($file));
            if ($file != ".." && $file != "." && is_dir($_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file)) {
                $this->find($in_dir . "/" . $file);
            }
            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file) && $file != ".." && $file != ".") {


                if (in_array($in_dir, $permitted_folders) or 1) {
                    $this->a_fname[$this->cofiles] = $file;
                    $this->a_fsize[$this->cofiles] = filesize($_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file);
                    $this->a_hash_file[$this->cofiles] = hash_file("md5", $_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file);
                    $this->a_fdir [$this->cofiles] = $in_dir;
                    $this->cofiles++;
                    if ($this->cofiles > 20000) break;
                }
            }
        }
        closedir($dir_handle);
    }
}
