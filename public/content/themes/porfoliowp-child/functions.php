<?php
function porfoliowp_child_scripts() {
    wp_enqueue_style( 'porfoliowp-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'porfoliowp_child_scripts' );
?><?php
 
// Your php code goes here

?>