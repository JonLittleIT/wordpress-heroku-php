<?php

Function child_enqueue_scripts() {
	wp_register_style( 'childtheme_style', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childtheme_style' );
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_scripts');

?>