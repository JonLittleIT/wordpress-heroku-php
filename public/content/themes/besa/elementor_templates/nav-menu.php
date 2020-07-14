<?php 
/**
 * Templates Name: Elementor
 * Widget: Menu Nav
 */

$settings = $this->get_active_settings();

extract( $settings );

$available_menus = $this->get_available_menus();

if (!$available_menus || empty($menu) || !is_nav_menu($menu) ) {
	return;
}

$_id = besa_tbay_random_key();

$args = [
	'echo'        => false, 
	'menu'        => $menu,
	'container_class' => 'collapse navbar-collapse',
	'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $_id,
	'walker'      => new Besa_Tbay_Nav_Menu(),
	'fallback_cb' => '__return_empty_string',
	'container'   => '',
];  

$args['menu_class']     = 'elementor-nav-menu nav navbar-nav megamenu';

switch ($layout) {
	case 'vertical':
		$args['menu_class'] .= ' flex-column';
		break;

	case 'treeview':
		$args['menu_class'] = 'navbar-nav';
		break;
	
	default:
		$args['menu_class'] .= ' flex-row';
		break;
}

$args_canvas = [
	'echo'        => false,
	'menu'        => $settings['menu'],
	'menu_class'  => 'nav-menu--canvas',
	'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
	'fallback_cb' => '__return_empty_string',
	'container'   => '',
];


// General Menu.
$menu_html = wp_nav_menu($args);

// Dropdown Menu.
$args['menu_id'] = 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id();

if (empty($menu_html)) {
	return;
}


$this->add_render_attribute('main-menu', 'class', [
	'elementor-nav-menu--main',
	'elementor-nav-menu__container',
	'elementor-nav-menu--layout-' . $layout,
]);

$this->add_render_attribute('main-menu', 'class', 'tbay-'.$layout );

if( $layout === 'vertical' || $layout === 'treeview' ) {
	$this->add_render_attribute('main-menu', 'class', 'tbay-treevertical-lv1' );
}
 
if( $show_toggle_menu && !empty($toggle_content_menu) ) {
	$this->add_render_attribute('wrapper', 'class', 'category-inside' );
}


if( $layout === 'vertical' ) {
	if( isset($toggle_vertical_submenu_align) && empty($toggle_vertical_submenu_align) ) {
		$toggle_vertical_submenu_align = 'left';
	}
	
	if( $show_canvas_menu === 'yes' ) {

		if( $toggle_canvas_content_align === 'left' ) {
			$toggle_vertical_submenu_align = 'right';
		} else {
			$toggle_vertical_submenu_align = 'left';
		}
	}

	$this->add_render_attribute('main-menu', 'class', 'vertical-submenu-'.$toggle_vertical_submenu_align );
}

if( $show_content_menu === 'yes' && besa_tbay_is_home_page() ) {
	$this->add_render_attribute('wrapper', 'class', ['open' ,'setting-open'] );
}

if( $show_toggle_menu ) {
	$content_class = $this->add_render_attribute('content-class', 'class', 'category-inside-content' );
} else if( $show_canvas_menu ) {
	$this->add_render_attribute('wrapper', 'class', 'element-menu-canvas' );
	$content_class = $this->add_render_attribute('content-class', 'class', 'menu-canvas-content' );
}

$this->add_render_attribute( 
	'wrapper',
	[
		'data-wrapper' => wp_json_encode( [
			'layout' => $layout
		] ),
	]
);

?>
<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
	<?php echo trim($this->render_get_toggle_menu()); ?>
	
	<?php echo trim($this->render_canvas_button_menu()); ?>

	<?php if ( $show_toggle_menu || $show_canvas_menu ) echo '<div '. trim($this->get_render_attribute_string('content-class')) .' >'; ?>
		<?php echo trim($this->render_get_toggle_canvas_menu()); ?>
		<nav <?php echo trim($this->get_render_attribute_string('main-menu')); ?>><?php echo trim($menu_html); ?></nav>
	<?php if ( $show_toggle_menu || $show_canvas_menu) echo '</div>'; ?>

</div>