<?php
/**
 * Single Product
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

$single_style=get_theme_mod( 'bitther_single_style', '1' );
if(isset($_GET['single'])){
    $single_style=$_GET['single'];
}

get_header();

get_template_part('templates/single/single',$single_style);

get_footer();
