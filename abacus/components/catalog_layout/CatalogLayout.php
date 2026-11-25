<?php
class CatalogLayout
{
    public static function render($params)
    {
        if (!is_array($params)) { $params = array(); }

        $arguments = array_merge(array(
            'component'   => 'catalog_layout',
            'template'    => 'default',
            'return_html' => true,
        ), $params);

        $tpl = preg_replace('/[^a-zA-Z0-9_\-]/', '', $arguments['template']);
        if ($tpl == '') { $tpl = 'default'; }

        $file = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'])
              . '/abacus/components/catalog_layout/templates/' . $tpl . '/template.php';

        if (!file_exists($file)) { return ''; }

        ob_start();
        $ret = include $file;
        $buf = ob_get_clean();

        if (is_string($ret) && $ret !== '' && $ret !== '1') { return $ret; }
        return $buf;
    }
}