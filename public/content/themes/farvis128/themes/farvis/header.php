<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>  data-scrolling-animations="true" >

<?php

	if ( ! class_exists( 'TmplCustom' ) ){
		$additional_custom_class = 'tmpl-plugins-not-activated';
	}else{
		$additional_custom_class = 'tmpl-plugins-activated';
	}

	$post_ID = isset ($wp_query) ? $wp_query->get_queried_object_id() : get_the_ID();
	$farvis_page_layout = get_post_meta($post_ID, 'page_layout', 1) != '' ? get_post_meta($post_ID, 'page_layout', 1) : farvis_get_option('style_general_settings_layout', 'normal');
	$farvis_blog_layout = farvis_get_option('blog_settings_type', 'classic');
	if( class_exists( 'WooCommerce' ) ){
		$post_ID = $post_ID ? $post_ID : get_option( 'woocommerce_shop_page_id' );
	}
	$farvis_woo_layout = get_post_meta($post_ID, 'pix_woo_layout', 1) != '' ? get_post_meta($post_ID, 'pix_woo_layout', 1) : farvis_get_option('woo_layout', 'default');
	
	if( class_exists( 'WooCommerce' ) && farvis_is_woo_page() && farvis_get_option('farvis_woo_header_global','1') ){
		$post_ID = get_option( 'woocommerce_shop_page_id' ) ? get_option( 'woocommerce_shop_page_id' ) : $post_ID;
	} 

	$farvis_header = apply_filters('farvis_header_settings', $post_ID);

	$farvis_footer_fixed = get_post_meta($post_ID, 'pix_fixed_footer', 1) != '' ? get_post_meta($post_ID, 'pix_fixed_footer', 1) : farvis_get_option('footer_fixed', '0');
	$farvis_footer_fixed = $farvis_footer_fixed ? 'fixed-footer-layout' : '';
	
	$farvis_global_color = farvis_get_option('style_settings_global_color', '1')
	            && (farvis_get_option('style_settings_main_color', get_option('farvis_default_main_color')) != get_option('farvis_default_main_color')
                    || farvis_get_option('style_settings_additional_color', get_option('farvis_default_additional_color')) != get_option('farvis_default_additional_color')
                    ) ? 'global-customizer-color' : '';
?>

<?php if( (farvis_get_option('page_loader_settings_use','off') == 'usemain' && is_front_page()) || farvis_get_option('page_loader_settings_use','off') == 'useall' ) : ?>
   
    
    
    
    
      <div 
       
  class="animsition" 
  <?php
  $animation = array(
	'overlay-slide-in-top' ,
	'overlay-slide-in-bottom'  ,
	'overlay-slide-in-left'  ,
	'overlay-slide-in-right'   );
	
  if ( in_array(farvis_get_option('page_loader_animation_in','fade-in') ,$animation) || in_array(farvis_get_option('page_loader_animation_out','fade-in') ,$animation)) {  	?>
  	data-animsition-overlay="true" 
  	<?php
  }
  ?>
 
  data-animsition-in-class="<?php echo farvis_get_option('page_loader_animation_in','fade-in') ?>"
  data-animsition-in-duration="<?php echo farvis_get_option('page_loader_duration_in','1000') ?>"
  data-animsition-out-class="<?php if ( farvis_get_option('page_loader_animation_out') == 'none') { echo ''; } else { echo farvis_get_option('page_loader_animation_out','fade-out'); } ?>"
  data-animsition-out-duration="<?php if ( farvis_get_option('page_loader_animation_out') == 'none') { echo '0'; } else { echo farvis_get_option('page_loader_duration_out','1000'); } ?>"
  data-animsition-image="<?php echo farvis_get_option('page_loader_img','')  ?>"
 
  
  
       
>
          
      
         
    
<?php endif; ?>
    
    

        

<div   class="layout-theme <?php echo farvis_get_option('font_globally') == 'yes' ? 'kaswara-theme-font' : '' ?>  <?php echo esc_attr($additional_custom_class)?> <?php echo esc_attr($farvis_footer_fixed); ?> <?php echo esc_attr($farvis_global_color); ?> animated-css page-layout-<?php echo esc_attr($farvis_page_layout); ?> woo-layout-<?php echo esc_attr($farvis_woo_layout); ?> blog-layout-<?php echo esc_attr($farvis_blog_layout); ?>" >

<?php
	if ( farvis_get_option('header_search')  ) { 
		include(get_template_directory() . '/templates/header/header_menu/search.php');
	}
	if ( in_array($farvis_header['header_menu_add_position'], array('left', 'right', 'top', 'bottom'))  && $farvis_header['header_type'] != 'header3' ) {
		include(get_template_directory() . '/templates/header/header_menu/slide.php');
	}
	?>
	<div data-off-canvas="slidebar-5 left overlay" class="mobile-slidebar-menu">
		<button class="menu-mobile-button visible-xs-block js-toggle-mobile-slidebar toggle-menu-button">
			<span class="toggle-menu-button-icon"><span></span> <span></span> <span></span> <span></span>
				<span></span> <span></span></span>
		</button>
		<?php
			if ( has_nav_menu( 'mobile_nav' ) ) {
				wp_nav_menu(array(
					'theme_location'  => 'mobile_nav',
	                'container'       => false,
	                'menu_id'		  => 'mobile-menu',
	                'menu_class'      => 'nav navbar-nav'
				));
			} else {
				echo farvis_site_menu('yamm main-menu nav navbar-nav');
			}
		?>
	</div>
	<?php
	if ( $farvis_header['header_menu_add_position'] == 'screen' && $farvis_header['header_type'] != 'header3' ) {
		include(get_template_directory() . '/templates/header/header_menu/full-screen.php');
	}
?>

<?php if($farvis_header['header_sidebar_view'] == 'fixed') : ?>
	<!-- FIXED SIDEBAR MENU  -->
	<div class="wrap-left-open ">
<?php endif; ?>

<?php
	if($farvis_header['header_type'] == 'header3')
		farvis_get_theme_header($farvis_header['header_type']);
?>

<?php if($farvis_header['header_menu_animation'] == 'reveal') : ?>
	<!-- ========================== -->
	<!-- CONTAINER SLIDE MENU  -->
	<!-- ========================== -->
	<div data-canvas="container">
<?php endif; ?>

<?php
	if($farvis_header['header_type'] != 'header3')
		farvis_get_theme_header($farvis_header['header_type']);

	if (!is_page_template('page-home.php')) {
		farvis_load_block('header/header_bgimage');
	}
?>








