<?php
/************* LOAD REQUIRED SCRIPTS AND STYLES *************/
function pixchild_loadCss(){
    wp_enqueue_style('style', get_stylesheet_uri() );
    wp_enqueue_style('farvis', get_template_directory_uri() . '/style.css' );
}
add_action('wp_enqueue_scripts', 'pixchild_loadCss'); //Load All Css