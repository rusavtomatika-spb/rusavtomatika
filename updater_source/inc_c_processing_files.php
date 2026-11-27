<?php

if (!class_exists('c_processing_files')) {
    class c_processing_files
    {
        public $a_fname     = array();
        public $a_fsize     = array();
        public $a_fdir      = array();
        public $a_hash_file = array();
        public $cofiles     = 0;
        public $skipped_big = 0;

        private $only_root  = array();
        private $excl_any   = array();
        private $excl_root  = array();
        private $ext_ok     = array();
        private $excl_files = array();
        private $max_files  = 20000;
        private $max_size   = 2097152;

        public function __construct()
        {
            $this->only_root  = $this->cfg('UPDATER_ONLY_ROOT_FOLDERS', '');
            $this->excl_any   = $this->cfg('UPDATER_EXCLUDE_DIRS_ANY', 'node_modules,cache,data,sql_backups,logs,log,tmp,temp');
            $this->excl_root  = $this->cfg('UPDATER_EXCLUDE_DIRS_ROOT', 'images,upload_files,documents,download,backup,backups,updater_source,updater,export,upl,import,test,admin,service');
            $this->ext_ok     = $this->cfg('UPDATER_INCLUDE_EXT', 'php,js,css,html,htm,xml,txt,json,svg,htaccess');
            $this->excl_files = $this->cfg('UPDATER_EXCLUDE_FILES', 'settings.php,error_log,usdrate.txt');
            $this->max_files  = defined('UPDATER_MAX_FILES') ? (int)UPDATER_MAX_FILES : 20000;
            $this->max_size   = defined('UPDATER_MAX_FILE_SIZE') ? (int)UPDATER_MAX_FILE_SIZE : 2097152;
        }

        private function cfg($name, $default)
        {
            $raw = defined($name) ? constant($name) : $default;
            $out = array();
            foreach (explode(',', strtolower(trim($raw))) as $v) {
                $v = trim($v);
                if ($v !== '') { $out[] = $v; }
            }
            return $out;
        }

        private function is_excluded_dir($name, $parent)
        {
            if ($name === '') { return true; }
            if ($name[0] === '_' || $name[0] === '.') { return true; }
            $low = strtolower($name);
            if (in_array($low, $this->excl_any, true)) { return true; }
            if ($parent === '') {
                if (in_array($low, $this->excl_root, true)) { return true; }
                if (!empty($this->only_root) && !in_array($low, $this->only_root, true)) { return true; }
            }
            return false;
        }

        private function ext_allowed($file)
        {
            $f = strtolower($file);
            if ($f[0] === '.') {
                $ext = substr($f, 1);
            } else {
                $p = strrpos($f, '.');
                $ext = ($p === false) ? '' : substr($f, $p + 1);
            }
            return in_array($ext, $this->ext_ok, true);
        }

        public function find($in_dir)
        {
            $in_dir = '/' . trim(str_replace('\\', '/', $in_dir), '/');
            if ($in_dir === '/') { $in_dir = ''; }

            $abs = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . $in_dir;
            if (!is_dir($abs)) { return; }

            $dh = @opendir($abs);
            if (!$dh) { return; }

            while (($file = readdir($dh)) !== false) {
                if ($file === '.' || $file === '..') { continue; }
                if ($this->cofiles >= $this->max_files) { break; }

                $path = $abs . '/' . $file;

                if (is_dir($path)) {
                    if ($this->is_excluded_dir($file, $in_dir)) { continue; }
                    $this->find($in_dir . '/' . $file);
                    continue;
                }

                if (!is_file($path)) { continue; }
                if ($in_dir === '' && !empty($this->only_root)) { continue; }
                if (!$this->ext_allowed($file)) { continue; }
                if (in_array(strtolower($file), $this->excl_files, true)) { continue; }

                $size = filesize($path);
                if ($this->max_size > 0 && $size > $this->max_size) { $this->skipped_big++; continue; }

                $this->a_fname[]     = $file;
                $this->a_fsize[]     = $size;
                $this->a_hash_file[] = hash_file('md5', $path);
                $this->a_fdir[]      = ($in_dir === '') ? '/' : $in_dir;
                $this->cofiles++;
            }
            closedir($dh);
        }
    }
}