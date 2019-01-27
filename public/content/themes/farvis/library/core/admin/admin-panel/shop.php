<?php
	
	function farvis_customize_shop_tab($wp_customize, $theme_name){

		$farvis_pix_slider = array( 0 => esc_html__( 'No RevSlider', 'farvis' ) );
		if (class_exists('RevSlider')) {
			$arr = array( 0 => esc_html__( 'No RevSlider', 'farvis' ) );

			$pix_sliders 	= new RevSlider();
			$pix_arrSliders = $pix_sliders->getArrSliders();

			foreach($pix_arrSliders as $slider){
			  $arr[$slider->getAlias()] = $slider->getTitle();
			}
			if($arr){
			  $farvis_pix_slider = $arr;
			}

		}

		$wp_customize->add_section( 'farvis_shop_settings' , array(
		    'title'      => esc_html__( 'Shop', 'farvis' ),
		    'priority'   => 50,
		) );



		$wp_customize->add_setting( 'farvis_shop_header_slider' , array(
			'default'     => 0,
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_shop_header_slider',
			array(
					'label'    => esc_html__( 'Header RevSlider On Main Shop Page', 'farvis' ),
					'section'  => 'farvis_shop_settings',
					'settings' => 'farvis_shop_header_slider',
					'type'     => 'select',
					'choices'  => $farvis_pix_slider,
					'priority' => 10
			)
		);

		$wp_customize->add_setting( 'farvis_shop_header_image' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
        $wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'farvis_shop_header_image',
				array(
				   'label'      => esc_html__( 'Header Image', 'farvis' ),
				   'section'    => 'farvis_shop_settings',
				   'context'    => 'farvis_shop_header_image',
				   'settings'   => 'farvis_shop_header_image',
				   'priority'   => 20
				)
	       )
	    );

	    $wp_customize->add_setting( 'farvis_shop_settings_global_product' , array(
			'default'     => 'on',
			'transport'   => 'refresh',
			'sanitize_callback' => 'farvis_sanitize_onoff'
		) );
		$wp_customize->add_control(
			'farvis_shop_settings_global_product',
			array(
				'label'    => esc_html__( 'Global sidebar settings for Product pages', 'farvis' ),
				'section'  => 'farvis_shop_settings',
				'settings' => 'farvis_shop_settings_global_product',
				'description' => esc_html__( 'Global sidebar settings for all Product pages.', 'farvis' ),
				'type'     => 'select',
				'choices'  => array(
					'on'  => esc_html__( 'On', 'farvis' ),
					'off'  => esc_html__( 'Off', 'farvis' ),
				),
				'priority'   => 30
			)
		);

		$wp_customize->add_setting( 'farvis_shop_settings_sidebar_type' , array(
			'default'     => '2',
			'transport'   => 'refresh',
			'sanitize_callback' => 'farvis_sanitize_sidebar_blog_type'
		) );
		$wp_customize->add_control(
			'farvis_shop_settings_sidebar_type',
			array(
				'label'    => esc_html__( 'Product sidebar type', 'farvis' ),
				'section'  => 'farvis_shop_settings',
				'settings' => 'farvis_shop_settings_sidebar_type',
				'description' => esc_html__( 'Select sidebar type for Product pages.', 'farvis' ),
				'type'     => 'select',
				'choices'  => array(
					'1' => esc_html__( 'Full width', 'farvis' ),
					'2' => esc_html__( 'Right Sidebar', 'farvis' ),
					'3' => esc_html__( 'Left Sidebar', 'farvis' ),
				),
				'priority' => 40
			)
		);

		$wp_customize->add_setting( 'farvis_shop_settings_sidebar_content' , array(
			'default'     => 'product-sidebar-1',
			'transport'   => 'refresh',
			'sanitize_callback' => 'farvis_sanitize_sidebar_blog_content'
		) );
		$wp_customize->add_control(
			'farvis_shop_settings_sidebar_content',
			array(
				'label'    => esc_html__( 'Product sidebar content', 'farvis' ),
				'section'  => 'farvis_shop_settings',
				'settings' => 'farvis_shop_settings_sidebar_content',
				'description' => esc_html__( 'Select sidebar content for product pages', 'farvis' ),
				'type'     => 'select',
				'choices'  => array(
					'sidebar-1' => esc_html__( 'WP Default Sidebar', 'farvis' ),
					'global-sidebar-1' => esc_html__( 'Blog Sidebar', 'farvis' ),
					'portfolio-sidebar-1' => esc_html__( 'Portfolio Sidebar', 'farvis' ),
					'shop-sidebar-1' => esc_html__( 'Shop Sidebar', 'farvis' ),
					'product-sidebar-1' => esc_html__( 'Product Sidebar', 'farvis' ),
					'custom-area-1' => esc_html__( 'Custom Area', 'farvis' ),
				),
				'priority' => 50
			)
		);

		$wp_customize->add_setting( 'farvis_shop_settings_checkout' , array(
			'default'     => 'off',
			'transport'   => 'refresh',
			'sanitize_callback' => 'farvis_sanitize_onoff'
		) );
		$wp_customize->add_control(
			'farvis_shop_settings_checkout',
			array(
				'label'    => esc_html__( 'Checkout without Cart', 'farvis' ),
				'section'  => 'farvis_shop_settings',
				'settings' => 'farvis_shop_settings_checkout',
				'description' => esc_html__( 'Add to cart go to checkout', 'farvis' ),
				'type'     => 'select',
				'choices'  => array(
					'on'  => esc_html__( 'On', 'farvis' ),
					'off'  => esc_html__( 'Off', 'farvis' ),
				),
				'priority'   => 60
			)
		);
				
	}
?>