<?php
// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'porfoliowp_add_gutenberg_assets' );
/**
 * Load Gutenberg stylesheet.
 */
function porfoliowp_add_gutenberg_assets() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'porfoliowp-gutenberg-style', get_theme_file_uri( '/css/gutenberg-editor-style.css' ), false );
    wp_enqueue_style( 
        'porfoliowp-gutenberg-fonts', 
        '//fonts.googleapis.com/css?family=Montserrat%3Aregular%2C700%2Clatin' 
    ); 
}
?>