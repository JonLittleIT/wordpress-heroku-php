<?php
$boxed_container = ekommart_get_theme_option('boxed-container', 1400);
$boxed_offset    = ekommart_get_theme_option('boxed-offset', 30);

$layoutcss = 'body.ekommart-layout-boxed{max-width:' . $boxed_container . 'px;}';
$layoutcss .= '@media(min-width: ' . $boxed_container . 'px){ body.ekommart-layout-boxed { margin:' . $boxed_offset . 'px auto;}}';

$cssCode .= <<<CSS
$layoutcss
CSS;


return $cssCode;
