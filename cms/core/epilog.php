<?php

if (!defined('cms'))
    exit;

include_once $cms_path_templates . "/" . $cms_template . '/footer.php';
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL, $EXTENTIONPARAM;
setTitle($TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL, $EXTENTIONPARAM);

