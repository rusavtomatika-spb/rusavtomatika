<?php
if (!class_exists('c_processing_files')) {
    class c_processing_files
    {
        public $a_fname     = array();
        public $a_fsize     = array();
        public $a_fdir      = array();
        public $a_hash_file = array();
        public $cofiles     = 0;

        private $any_exclude = array(
            'node_modules', 'cache', 'data', 'sql_backups', 'logs', 'log', 'tmp', 'temp',
        );

        private $root_exclude = array(
            'images', 'upload_files', 'documents', 'download',
            'backup', 'backups', 'updater_source', 'export', 'upl', 'import',
            'test', 'admin', 'service',
        );

        private $include_ext = '/\.(php|js|css|html|htm|xml|txt|json|svg|png|jpg|jpeg|webp|gif|woff|woff2|ttf|eot|map|htaccess)$/i';

        private $exclude_files = '/(^settings\.php$|^error_log$|\.log$|\.sql$|\.zip$|\.bak$|\.old$|^usdrate\.txt$|^\.htaccess\.local$|^\.htaccess\.bak$)/i';

        private $max_files = 50000;

        private function is_excluded_dir($name, $parent)
        {
            if ($name === '' ) { return true; }
            if ($name[0] === '_' || $name[0] === '.') { return true; }
            $lower = strtolower($name);
            if (in_array($lower, $this->any_exclude, true)) { return true; }
            if ($parent === '' && in_array($lower, $this->root_exclude, true)) { return true; }
            return false;
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
                $path = $abs . '/' . $file;

                if (is_dir($path)) {
                    if ($this->is_excluded_dir($file, $in_dir)) { continue; }
                    $this->find($in_dir . '/' . $file);
                    continue;
                }

                if (!is_file($path)) { continue; }
                if (!preg_match($this->include_ext, $file)) { continue; }
                if (preg_match($this->exclude_files, $file)) { continue; }
                if ($this->cofiles >= $this->max_files) { break; }

                $this->a_fname[]     = $file;
                $this->a_fsize[]     = filesize($path);
                $this->a_hash_file[] = hash_file('md5', $path);
                $this->a_fdir[]      = ($in_dir === '') ? '/' : $in_dir;
                $this->cofiles++;
            }
            closedir($dh);
        }
    }
}