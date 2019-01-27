<?php
	/**  Core_Frontend  **/

	require_once(get_template_directory() . '/library/core/frontend/functions.php');
	require_once(get_template_directory() . '/library/core/frontend/vc.php');
		
		
	/* Setup language support & image settings */
	function farvis_setup()
	{
	    // Language support 
	    load_theme_textdomain('farvis', get_template_directory() . '/languages');
	    $locale      = get_locale();
	    $locale_file = get_template_directory() . "/languages/$locale.php";
	    if (is_readable($locale_file)) {
	        require_once(get_template_directory() . "/languages/$locale.php");
	    }
	    
	    // ADD SUPPORT FOR POST THUMBS 
	    add_theme_support('post-thumbnails');

	    add_theme_support('woocommerce');
	    add_theme_support('widgets');

	    $args = array(
	        'flex-width' => true,
	        'width' => 350,
	        'flex-height' => true,
	        'height' => 'auto',
	        'default-image' => get_template_directory_uri() . '/images/logo.jpg'
	    );
	    add_theme_support('custom-header', $args);
	    $args = array(
	        'default-color' => 'FFFFFF'
	    );
	    add_theme_support('custom-background', $args);
	    add_theme_support('post-formats', array(
	        'gallery',
	        'quote',
	        'video'
	    ));

	    // Define various thumbnail sizes
	    add_image_size('farvis-post-thumb', 285, 400, true);
	    add_image_size('farvis-preview-thumb', 100, 100, true);
	    add_theme_support("title-tag");
	    add_theme_support('automatic-feed-links');

	}
	
	/* Register 3 navi types */
	function farvis_custom_menus()
    {	    
	    
	    /* Register Navigations */
        register_nav_menus(array(
            'primary_nav' => esc_html__('Primary Navigation', 'farvis'),
            'top_nav' => esc_html__('Top Navigation', 'farvis'),
            'footer_nav' => esc_html__('Footer Navigation', 'farvis'),
		    'mobile_nav' => esc_html__('Mobile Navigation', 'farvis'),
        ));
    }
	
	
	add_action('after_setup_theme', 'farvis_setup');
	add_action('init', 'farvis_custom_menus');
?>