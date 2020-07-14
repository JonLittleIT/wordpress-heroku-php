<?php

defined( 'ABSPATH' ) || exit();


class Ekommart_Megamenu {

	private $is_megamenu = false;
	private $menu_items  = [];

	public function __construct() {
		$this->includes_core();
		if ( $this->check_megamenu() ) {
			$this->includes();
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'ekommart_nav_menu_args', [ $this, 'set_menu_args' ], 99999 );
		}

	}

	public function set_menu_args( $args ) {
		$args['walker'] = new Ekommart_Megamenu_Walker();

		return $args;
	}

	private function check_megamenu() {
		$all_locations = get_nav_menu_locations();
		$main          = $vertical = false;
		if (isset(get_nav_menu_locations()['vertical'])) {
			$vertical = wp_get_nav_menu_items(get_term($all_locations['vertical'], 'nav_menu')->term_id);
		}
		if (isset(get_nav_menu_locations()['primary'])) {
			$main = wp_get_nav_menu_items(get_term($all_locations['primary'], 'nav_menu')->term_id);
		}

		$all           = wp_parse_args( $main, $vertical );
		foreach ( $all as $menu_item ) {
			$elementor_id = ekommart_megamenu_get_post_related_menu( $menu_item->ID );
			if ( $elementor_id ) {
				$this->is_megamenu  = true;
				$this->menu_items[] = $elementor_id;

			}
		}
		return $this->is_megamenu;
	}

	private function includes_core(){
		if ( is_admin() ) {
			include_once get_template_directory() . '/inc/megamenu/includes/admin/class-admin.php';
		}
		include_once get_template_directory() . '/inc/megamenu/includes/core-functions.php';
	}

	private function includes() {

		include_once get_template_directory() . '/inc/megamenu/includes/hook-functions.php';
		include_once get_template_directory() . '/inc/megamenu/includes/class-menu-walker.php';
	}

	public function enqueue_scripts() {
		global $ekommart_version;
		wp_enqueue_script( 'ekommart-megamenu-frontend', get_template_directory_uri() . '/inc/megamenu/assets/js/frontend.js', array( 'jquery' ), $ekommart_version, true );

		foreach ( $this->menu_items as $id ) {
			Elementor\Core\Files\CSS\Post::create( $id )->enqueue();
		}
	}

}

return new Ekommart_Megamenu();
