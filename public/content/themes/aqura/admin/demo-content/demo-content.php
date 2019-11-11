<?php

/**
 * Demo content init.
 */

function ocdi_import_files() {
	return array(
		array(
			'import_file_name'             => esc_html__( 'Demo 01' , 'aqura' ),
			'categories'                   => array( 'Primary' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'admin/demo-content/demos/demo-01/aqura-demo-01-content.xml',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'admin/demo-content/demos/demo-01/redux_aqura_demo_01.json',
					'option_name' => 'aqura_data',
				),
			),
			'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'admin/demo-content/demos/demo-01/screenshot.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, don\'t forget to enjoy our theme!', 'aqura' ),
			'preview_url'                  => 'http://theme-brothers.com/aqura-wp/',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

function ocdi_after_import_setup() {

	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
		)
	);

	$front_page_id = get_page_by_title( 'Home' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );