<?php
/**
 * Child-Theme functions and definitions
 */

function kryptex_child_scripts() {
    wp_enqueue_style( 'kryptex-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'kryptex_child_scripts' );
 
?>