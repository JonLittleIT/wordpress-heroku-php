<?php
	
	/*  Redirect To Theme Options Page on Activation  */
	if (is_admin() && isset($_GET['activated'])) {
	    wp_redirect(admin_url('themes.php'));
	}
	
	/*  Load custom admin scripts & styles  */
	function farvis_load_custom_wp_admin_style() {

		wp_enqueue_media();

		if (function_exists('WC') && WC()){
			$suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	
			wp_register_script( 'wc-enhanced-select', WC()->plugin_url() . '/assets/js/admin/wc-enhanced-select' . $suffix . '.js', array( 'jquery', 'select2' ), WC_VERSION );
			wp_localize_script( 'wc-enhanced-select', 'wc_enhanced_select_params', array(
				'i18n_matches_1'            => _x( 'One result is available, press enter to select it.', 'enhanced select', 'farvis' ),
				'i18n_matches_n'            => _x( '%qty% results are available, use up and down arrow keys to navigate.', 'enhanced select', 'farvis' ),
				'i18n_no_matches'           => _x( 'No matches found', 'enhanced select', 'farvis' ),
				'i18n_ajax_error'           => _x( 'Loading failed', 'enhanced select', 'farvis' ),
				'i18n_input_too_short_1'    => _x( 'Please enter 1 or more characters', 'enhanced select', 'farvis' ),
				'i18n_input_too_short_n'    => _x( 'Please enter %qty% or more characters', 'enhanced select', 'farvis' ),
				'i18n_input_too_long_1'     => _x( 'Please delete 1 character', 'enhanced select', 'farvis' ),
				'i18n_input_too_long_n'     => _x( 'Please delete %qty% characters', 'enhanced select', 'farvis' ),
				'i18n_selection_too_long_1' => _x( 'You can only select 1 item', 'enhanced select', 'farvis' ),
				'i18n_selection_too_long_n' => _x( 'You can only select %qty% items', 'enhanced select', 'farvis' ),
				'i18n_load_more'            => _x( 'Loading more results&hellip;', 'enhanced select', 'farvis' ),
				'i18n_searching'            => _x( 'Searching&hellip;', 'enhanced select', 'farvis' ),
				'ajax_url'                  => admin_url( 'admin-ajax.php' ),
				'search_products_nonce'     => wp_create_nonce( 'search-products' ),
				'search_customers_nonce'    => wp_create_nonce( 'search-customers' )
			) );
			
			wp_enqueue_script( 'wc-enhanced-select' );
		}

		// ion.rangeSlider
        wp_enqueue_style('ion.rangeSlider', get_template_directory_uri() . '/library/core/admin/js/ion-rangeSlider/css/ion.rangeSlider.css');
        wp_enqueue_style('ion.rangeSlider.skinModern', get_template_directory_uri() . '/library/core/admin/js/ion-rangeSlider/css/ion.rangeSlider.skinNice.css');
        wp_enqueue_script('ion.rangeSlider', get_template_directory_uri() . '/library/core/admin/js/ion-rangeSlider/js/ion.rangeSlider.min.js', array('jquery') , false, true);
        wp_enqueue_script('wNumb', get_template_directory_uri() . '/library/core/admin/js/ion-rangeSlider/js/wNumb.js', array('jquery'), false, true);


		wp_register_script( 'farvis_custom_wp_admin_script', get_template_directory_uri() . '/js/custom-admin.js', array( 'jquery' ) );
	    wp_localize_script( 'farvis_custom_wp_admin_script', 'meta_image',
	        array(
	            'title' => esc_html__( 'Choose or Upload an Image', 'farvis' ),
	            'button' => esc_html__( 'Use this image', 'farvis' ),
                'font_api' => farvis_get_option('font_api', 'AIzaSyAAChcJ6xYHmHRRTRMvt9GLCXeQG1qasV4'),
	        )
	    );
	    wp_enqueue_script( 'farvis_custom_wp_admin_script' );
	    wp_enqueue_style('farvis-custom-admin', get_template_directory_uri() . '/css/custom-admin.css');



	    wp_enqueue_style('farvis-admin-font', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css');
	    
	    // Add the color picker css file
	    wp_enqueue_style( 'wp-color-picker' );
	    // Include our custom jQuery file with WordPress Color Picker dependency
	    wp_enqueue_script( 'farvis-color', get_template_directory_uri() . '/js/custom-script.js', array( 'wp-color-picker' ), false, true );
		    
	    
	}
	
	function farvis_add_editor_styles() {
		add_editor_style( 'farvis-editor-style.css' );
	}

	function farvis_customizer_callback() {
		wp_enqueue_script( 'farvis-customizer-preview', get_template_directory_uri() . '/library/core/admin/js/customizer-preview.js', array( 'jquery', 'customize-preview' ) );
	}

// add_filter('login_headerurl', create_function('', 'return get_home_url("/");'));
function mb_login_url() { return get_home_url("/"); }
add_filter( 'login_headerurl', 'mb_login_url' );
//	add_filter('login_headertitle', create_function('', 'return false;'));
function mb_login_title() { return false; }
add_filter( 'login_headertitle', 'mb_login_title' );


	add_action('admin_enqueue_scripts', 'farvis_load_custom_wp_admin_style');
	add_action('admin_init', 'farvis_add_editor_styles' );
	add_action('customize_preview_init', 'farvis_customizer_callback');
	
	function farvis_add_custom_fields_to_menu($menuBaseClass){		
		return 'farvis_Walker_Edit_Menu';
	}
	
	function farvis_update_custom_fields_in_menu($menu_id, $menu_element_id, $args){

		$_args = wp_parse_args( $_POST, array(
			'menu-item-wide' => ''
		));
		$isWide = false;
		if (isset($_args['menu-item-wide'])){
			$wideValues = $_args['menu-item-wide'];

			
			if (isset($wideValues[$menu_element_id]))
				$isWide = $wideValues[$menu_element_id];			
		}

		update_post_meta( $menu_element_id, '_menu_item_wide', sanitize_key($isWide) );	
	}
	
	add_filter('wp_edit_nav_menu_walker','farvis_add_custom_fields_to_menu');
	add_action('wp_update_nav_menu_item','farvis_update_custom_fields_in_menu', 11, true);	

	
	
	function farvis_staticblock_admin_notice(){
 		
 		$post_type = isset($_GET['post_type']) ?  $_GET['post_type'] : ''  ;
	   
	    if ( isset($_GET['post'] ))
	    	$post_type =   get_post($_GET['post'])->post_type;
	    	
	    if ( $post_type == 'staticblocks'  ) {
	         echo '<div class="notice notice-error  is-dismissible tmpl-notice-error"> 
	             <p>
                 '.esc_html__( 'Please activate WPBakery Page Builder  for Static Blocks post type', 'farvis' ).'
                 <a href="'.get_admin_url().'admin.php?page=vc-roles">'.esc_html__( 'here', 'farvis' ).'</a>
                 </p>
	         </div>';
	    }
	}
	add_action('admin_notices', 'farvis_staticblock_admin_notice');
	
	
	
	/* Admin Panel */
	require_once(get_template_directory() . '/library/core/admin/admin-panel.php');
	
	
	require_once(get_template_directory() . '/library/core/admin/class-tgm-plugin-activation.php');
	
	require_once(get_template_directory() . '/library/core/admin/post-fields.php');

	require_once(get_template_directory() . '/library/core/admin/functions.php');
	
	require_once(get_template_directory() . '/library/core/admin/edit-menu-walker.php');
	

?>