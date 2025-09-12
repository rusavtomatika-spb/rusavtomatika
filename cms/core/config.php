<?php

if (!defined('cms'))
    exit;

global $cms_path_components;
global $cms_path_templates;
global $cms_template;
$cms_path_components = $_SERVER['DOCUMENT_ROOT'] . "/cms/components";
$cms_path_templates = $_SERVER['DOCUMENT_ROOT'] . "/cms/templates";
$cms_template = "default";
$cms_template_url = "/cms/templates/default/";




