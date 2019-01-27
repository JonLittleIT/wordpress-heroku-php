<?php 
/**  Theme defaults values  **/

add_action('after_setup_theme', 'farvis_theme_defaults');
function farvis_theme_defaults(){
	
	// Colors and Fonts
	update_option( 'farvis_default_main_color', '#4f8eed' );
	update_option( 'farvis_default_gradient_color', '' );
	update_option( 'farvis_default_additional_color', '#cc5dff' );
	update_option( 'farvis_default_font', 'Rubik' );
	update_option( 'farvis_default_font_weights', '300,400,500,700,900' );
	update_option( 'farvis_default_font_weight', '400' );
	update_option( 'farvis_default_title', 'Rubik' );
	update_option( 'farvis_default_title_weights',  '300,400,500,700,900'  );
	update_option( 'farvis_default_title_weight', '500' );
	update_option( 'farvis_default_subtitle', 'Rubik' );
	update_option( 'farvis_default_title_weights',  '300,400,500,700,900'  );
	update_option( 'farvis_default_subtitle_weight', '500' );
	
	// Header Title and Breadcrumbs
	update_option( 'farvis_default_tab_bg_color', '#000000' );
	update_option( 'farvis_default_tab_bg_color_gradient', '' );
	update_option( 'farvis_default_tab_gradient_direction', 'to bottom' );
	update_option( 'farvis_default_tab_bg_opacity', '0.8' );
	update_option( 'farvis_default_tab_padding_top', '150' );
	update_option( 'farvis_default_tab_padding_bottom', '50' );
	update_option( 'farvis_default_tab_margin_bottom', '80' );
	update_option( 'farvis_default_tab_bottom_decor', '1' );
	update_option( 'farvis_default_tab_border', '1' );

	update_option( 'farvis_page_loader_bg_color', '#ffffff' );

}

add_filter( 'farvis_header_settings', 'farvis_header_settings_var' );
function farvis_header_settings_var( $post_ID=0 ){

	if(isset($post_ID) && $post_ID>0) {

		/// Header global parameters
		$farvis['header_type'] = get_post_meta($post_ID, 'header_type', 1) != '' ? get_post_meta($post_ID, 'header_type', 1) : farvis_get_option('header_type', 'header1');
		$farvis['header_sidebar_view'] = $farvis['header_type'] == 'header3' ? (get_post_meta($post_ID, 'header_sidebar_view', 1) != '' ? get_post_meta($post_ID, 'header_sidebar_view', 1) : farvis_get_option('header_sidebar_view', 'fixed')) : '';
		$farvis['header_background'] = get_post_meta($post_ID, 'header_background', 1) != '' ? get_post_meta($post_ID, 'header_background', 1) : (farvis_get_option('header_background', 'trans-black'));
		$farvis['header_transparent'] = get_post_meta($post_ID, 'header_transparent', 1) != '' ? get_post_meta($post_ID, 'header_transparent', 1) : farvis_get_option('header_transparent', '4');
		$farvis['header_hover_effect'] = get_post_meta($post_ID, 'header_hover_effect', 1) != '' ? get_post_meta($post_ID, 'header_hover_effect', 1) : farvis_get_option('header_hover_effect', '0');
		$farvis['header_marker'] = get_post_meta($post_ID, 'header_marker', 1) != '' ? get_post_meta($post_ID, 'header_marker', 1) : farvis_get_option('header_marker', 'menu-marker-arrow');
		$farvis['header_layout'] = get_post_meta($post_ID, 'header_layout', 1) != '' ? get_post_meta($post_ID, 'header_layout', 1) : farvis_get_option('header_layout', 'normal');
		$farvis['header_bar'] = get_post_meta($post_ID, 'header_bar', 1) != '' ? get_post_meta($post_ID, 'header_bar', 1) : farvis_get_option('header_bar', '0');

		$farvis['header_sticky'] = get_post_meta($post_ID, 'header_sticky', 1) != '' ? get_post_meta($post_ID, 'header_sticky', 1) : farvis_get_option('header_sticky', 'sticky');
		$farvis['mobile_sticky'] = get_post_meta($post_ID, 'mobile_sticky', 1) != '' ? get_post_meta($post_ID, 'mobile_sticky', 1) : farvis_get_option('mobile_sticky', '');


		/// Header menu settings
		$farvis['header_menu'] = get_post_meta($post_ID, 'header_menu', 1) != '' ? get_post_meta($post_ID, 'header_menu', 1) : farvis_get_option('header_menu', '1');
		$farvis['header_menu_add'] = get_post_meta($post_ID, 'header_menu_add', 1) != '' ? get_post_meta($post_ID, 'header_menu_add', 1) : farvis_get_option('header_menu_add', '');
		$farvis['header_menu_add_position'] = get_post_meta($post_ID, 'header_menu_add_position', 1) != '' ? get_post_meta($post_ID, 'header_menu_add_position', 1) : farvis_get_option('header_menu_add_position', 'disable');
		$farvis['header_menu_animation'] = get_post_meta($post_ID, 'header_menu_animation', 1) != '' ? get_post_meta($post_ID, 'header_menu_animation', 1) : farvis_get_option('header_menu_animation', 'overlay');

		/// Header widgets
		$farvis['header_minicart'] = get_post_meta($post_ID, 'header_minicart', 0) != '' ? get_post_meta($post_ID, 'header_minicart', 1) : farvis_get_option('header_minicart', '1');
		$farvis['header_search'] = get_post_meta($post_ID, 'header_search', 0) != '' ? get_post_meta($post_ID, 'header_search', 1) : farvis_get_option('header_search', '0');
		$farvis['header_socials'] = get_post_meta($post_ID, 'header_socials', 1) != '' ? get_post_meta($post_ID, 'header_socials', 1) : farvis_get_option('header_socials', '1');


		$class = '';
		foreach ($farvis as $key => $val) {
			if (!in_array($key, array('header_transparent', 'header_sticky', 'mobile_sticky', 'header_menu_animation')))
				$class .= $val . '-';
		}
		$farvis['header_uniq_class'] = substr($class, 0, -1);

		$farvis['header_phone'] = get_post_meta($post_ID, 'header_phone', 1) != '' ? get_post_meta($post_ID, 'header_phone', 1) : farvis_get_option('header_phone', '');
		$farvis['header_email'] = get_post_meta($post_ID, 'header_email', 1) != '' ? get_post_meta($post_ID, 'header_email', 1) : farvis_get_option('header_email', '');

		/// Header elements position
		$farvis['header_topbarbox_1_position'] = get_post_meta($post_ID, 'header_topbarbox_1_position', 1) != '' ? get_post_meta($post_ID, 'header_topbarbox_1_position', 1) : farvis_get_option('header_topbarbox_1_position', 'left', 0);
		$farvis['header_topbarbox_2_position'] = get_post_meta($post_ID, 'header_topbarbox_2_position', 1) != '' ? get_post_meta($post_ID, 'header_topbarbox_2_position', 1) : farvis_get_option('header_topbarbox_2_position', 'right', 0);
		$farvis['header_navibox_1_position'] = get_post_meta($post_ID, 'header_navibox_1_position', 1) != '' ? get_post_meta($post_ID, 'header_navibox_1_position', 1) : farvis_get_option('header_navibox_1_position', 'left');
		$farvis['header_navibox_2_position'] = get_post_meta($post_ID, 'header_navibox_2_position', 1) != '' ? get_post_meta($post_ID, 'header_navibox_2_position', 1) : farvis_get_option('header_navibox_2_position', 'right');
		$farvis['header_navibox_3_position'] = get_post_meta($post_ID, 'header_navibox_3_position', 1) != '' ? get_post_meta($post_ID, 'header_navibox_3_position', 1) : farvis_get_option('header_navibox_3_position', 'right');
		$farvis['header_navibox_4_position'] = get_post_meta($post_ID, 'header_navibox_4_position', 1) != '' ? get_post_meta($post_ID, 'header_navibox_4_position', 1) : farvis_get_option('header_navibox_4_position', 'right');

		/// Responsive
		$farvis['mobile_sticky'] = get_post_meta($post_ID, 'mobile_sticky', 1) != '' ? get_post_meta($post_ID, 'mobile_sticky', 1) : farvis_get_option('mobile_sticky', '');
		$farvis['mobile_topbar'] = get_post_meta($post_ID, 'mobile_topbar', 1) != '' ? get_post_meta($post_ID, 'mobile_topbar', 1) : farvis_get_option('mobile_topbar', '');
		$farvis['tablet_minicart'] = get_post_meta($post_ID, 'tablet_minicart', 1) != '' ? get_post_meta($post_ID, 'tablet_minicart', 1) : farvis_get_option('tablet_minicart', '');
		$farvis['tablet_search'] = get_post_meta($post_ID, 'tablet_search', 1) != '' ? get_post_meta($post_ID, 'tablet_search', 1) : farvis_get_option('tablet_search', '');
		$farvis['tablet_phone'] = get_post_meta($post_ID, 'tablet_phone', 1) != '' ? get_post_meta($post_ID, 'tablet_phone', 1) : farvis_get_option('tablet_phone', '');
		$farvis['tablet_socials'] = get_post_meta($post_ID, 'tablet_socials', 1) != '' ? get_post_meta($post_ID, 'tablet_socials', 1) : farvis_get_option('tablet_socials', '');


		/// Logo
		$farvis['logo'] = get_post_meta($post_ID, 'header_logo', 1) != '' ? get_post_meta($post_ID, 'header_logo', 1) : farvis_get_option('general_settings_logo', '');
		$farvis['logo_inverse'] = get_post_meta($post_ID, 'header_logo_inverse', 1) != '' ? get_post_meta($post_ID, 'header_logo_inverse', 1) : farvis_get_option('general_settings_logo_inverse', '');


		return $farvis;
	} else {

		/// Header global parameters
		$farvis['header_type'] = farvis_get_option('header_type', 'header1');
		$farvis['header_sidebar_view'] = farvis_get_option('header_sidebar_view', 'fixed');
		$farvis['header_background'] = farvis_get_option('header_background', 'trans-black');
		$farvis['header_transparent'] = farvis_get_option('header_transparent', '4');
		$farvis['header_hover_effect'] = farvis_get_option('header_hover_effect', '0');
		$farvis['header_marker'] = farvis_get_option('header_marker', 'menu-marker-arrow');
		$farvis['header_layout'] = farvis_get_option('header_layout', 'normal');
		$farvis['header_bar'] = farvis_get_option('header_bar', '0');

		$farvis['header_sticky'] = farvis_get_option('header_sticky', 'sticky');
		$farvis['mobile_sticky'] = '';

		/// Header menu settings
		$farvis['header_menu'] = '1';
		$farvis['header_menu_add'] = farvis_get_option('header_menu_add', '');
		$farvis['header_menu_add_position'] = farvis_get_option('header_menu_add_position', 'left');
		$farvis['header_menu_animation'] = farvis_get_option('header_menu_animation', 'overlay');

		/// Header widgets
		$farvis['header_minicart'] = farvis_get_option('header_minicart', '1');
		$farvis['header_search'] = farvis_get_option('header_search', '1');
		$farvis['header_socials'] = farvis_get_option('header_socials', '1');

		$class = '';
		foreach ($farvis as $key => $val) {
			if (!in_array($key, array('header_transparent', '', 'mobile_sticky', 'header_menu_animation')))
				$class .= $val . '-';
		}
		$farvis['header_uniq_class'] = substr($class, 0, -1);

		$farvis['header_phone'] = '';
		$farvis['header_email'] = '';

		/// Header elements position
		$farvis['header_topbarbox_1_position'] = 'left';
		$farvis['header_topbarbox_2_position'] = 'right';
		$farvis['header_navibox_1_position'] = 'left';
		$farvis['header_navibox_2_position'] = 'right';
		$farvis['header_navibox_3_position'] = 'right';
		$farvis['header_navibox_4_position'] = 'right';

		/// Responsive
		$farvis['mobile_sticky'] = '';
		$farvis['mobile_topbar'] = '';
		$farvis['tablet_minicart'] = '';
		$farvis['tablet_search'] = '';
		$farvis['tablet_phone'] = '';
		$farvis['tablet_socials'] = '';

		/// Logo
		$farvis['logo'] = '';
		$farvis['logo_inverse'] = '';

		return $farvis;
	}
}