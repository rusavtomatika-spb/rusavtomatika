<?php
$componentTemplate = isset($arguments['template']) && $arguments['template'] !== ''
    ? $arguments['template']
    : 'default';

$templatePath = __DIR__ . '/templates/' . $componentTemplate . '/template.php';

if (!is_file($templatePath)) {
    $templatePath = __DIR__ . '/templates/default/template.php';
}

if (is_file($templatePath)) {
    include $templatePath;
}