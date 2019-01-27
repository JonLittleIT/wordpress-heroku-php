<?php
// Enqueue child theme styles
function bitther_child_theme_styles() {
    wp_enqueue_style( 'bitther-child-theme', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'bitther_child_theme_styles', 1000 );
	