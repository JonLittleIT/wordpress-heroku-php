<?php

	// Theme Version
	if ( ! function_exists( 'bitther_theme_version' ) ) :
		function bitther_theme_version() {
			$bitther_theme = wp_get_theme(get_template());
			return $bitther_theme->get('Version');
		}
	endif;

	// Theme Name
	if ( ! function_exists( 'bitther_theme_name' ) ) :
		function bitther_theme_name() {
			$bitther_theme = wp_get_theme();
			return $bitther_theme->get('Name');
		}
	endif;

	function bitther_load_settings()
	{
		$settings=array(
			'home'=> array(
				'name_home'			=>esc_html__('Home 1', 'bitther' ),
				'live_preview'		=>esc_url('http://bitther.nanoagency.co/'),
				'demo_xml'			=>esc_url('http://guide.nanoagency.co'),
				'demo_image'		=>get_template_directory_uri() . '/inc/backend/assets/images/home/home1.jpg',
				'class_install'		=>esc_attr('show'),
				'class_active'		=>esc_attr('hidden'),
				'class_deactivate'	=>esc_attr('hidden')
			),
			'home-2'=> array(
				'name_home'			=>esc_html__('Home 2', 'bitther' ),
				'live_preview'		=>esc_url('http://bitther.nanoagency.co/home-2'),
				'demo_xml'			=>esc_url('http://guide.nanoagency.co'),
				'demo_image'		=>get_template_directory_uri() . '/inc/backend/assets/images/home/home2.jpg',
				'class_install'		=>esc_attr('show'),
				'class_active'		=>esc_attr('hidden'),
				'class_deactivate'	=>esc_attr('hidden')
			),
			'home-3'=> array(
				'name_home'			=>esc_html__('Home 3', 'bitther' ),
				'live_preview'		=>esc_url('http://bitther.nanoagency.co/home-3'),
				'demo_xml'			=>esc_url('http://guide.nanoagency.co'),
				'demo_image'		=>get_template_directory_uri() . '/inc/backend/assets/images/home/home3.jpg',
				'class_install'		=>esc_attr('show'),
				'class_active'		=>esc_attr('hidden'),
				'class_deactivate'	=>esc_attr('hidden')
			),
			'home-4'=> array(
				'name_home'			=>esc_html__('Home 4', 'bitther' ),
				'live_preview'		=>esc_url('http://bitther.nanoagency.co/home-4'),
				'demo_xml'			=>esc_url('http://guide.nanoagency.co'),
				'demo_image'		=>get_template_directory_uri() . '/inc/backend/assets/images/home/home4.jpg',
				'class_install'		=>esc_attr('show'),
				'class_active'		=>esc_attr('hidden'),
				'class_deactivate'	=>esc_attr('hidden')
			),

		);

		return $settings;
	}
	$bitther_settings = bitther_load_settings();
?>