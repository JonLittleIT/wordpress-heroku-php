<?php

	function farvis_customize_responsive_tab($wp_customize, $theme_name){
	
		$wp_customize->add_section( 'farvis_responsive_settings' , array(
		    'title'      => esc_html__( 'Responsive', 'farvis' ),
		    'priority'   => 35,
		) );

		$wp_customize->add_setting( 'farvis_general_settings_responsive' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'farvis_mobile_sticky' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'farvis_mobile_topbar' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'farvis_tablet_minicart' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'farvis_tablet_search' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'farvis_tablet_phone' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'farvis_tablet_socials' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		

		$wp_customize->add_control(
			'farvis_general_settings_responsive',
			array(
				'label'    => esc_html__( 'Responsive', 'farvis' ),
				'section'  => 'farvis_responsive_settings',
				'settings' => 'farvis_general_settings_responsive',
				'type'     => 'select',
				'choices'  => array(
					'off'  => esc_html__( 'Off', 'farvis' ),
					'on'   => esc_html__( 'On', 'farvis' ),
				),
				'priority'   => 5
			)
		);

		$wp_customize->add_control(
            'farvis_mobile_sticky',
            array(
                'label'    => esc_html__( 'Header Mobile Behavior', 'farvis' ),
                'description'   => esc_html__( 'Off header sticky or fixed on mobile', 'farvis' ),
                'section'  => 'farvis_responsive_settings',
                'settings' => 'farvis_mobile_sticky',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'farvis' ),
                    'mobile-no-sticky' => esc_html__( 'No Sticky', 'farvis' ),
		            'mobile-no-fixed' => esc_html__( 'No Fixed', 'farvis' ),
                ),
                'priority'   => 10
            )
        );

        $wp_customize->add_control(
            'farvis_mobile_topbar',
            array(
                'label'    => esc_html__( 'Header Mobile Behavior', 'farvis' ),
                'description'   => esc_html__( 'Off header top bar on mobile', 'farvis' ),
                'section'  => 'farvis_responsive_settings',
                'settings' => 'farvis_mobile_sticky',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'farvis' ),
                    'no-mobile-topbar' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 20
            )
        );

        $wp_customize->add_control(
            'farvis_tablet_minicart',
            array(
                'label'    => esc_html__( 'Tablet Minicart', 'farvis' ),
                'description'   => esc_html__( 'Off header cart on tablet', 'farvis' ),
                'section'  => 'farvis_responsive_settings',
                'settings' => 'farvis_tablet_minicart',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'farvis' ),
                    'no-tablet-minicart' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 30
            )
        );

        $wp_customize->add_control(
            'farvis_tablet_search',
            array(
                'label'    => esc_html__( 'Tablet Search', 'farvis' ),
                'description'   => esc_html__( 'Off header search on tablet', 'farvis' ),
                'section'  => 'farvis_responsive_settings',
                'settings' => 'farvis_tablet_search',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'farvis' ),
                    'no-tablet-search' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 40
            )
        );

        $wp_customize->add_control(
            'farvis_tablet_phone',
            array(
                'label'    => esc_html__( 'Tablet Header Phone', 'farvis' ),
                'description'   => esc_html__( 'Off header phone on tablet', 'farvis' ),
                'section'  => 'farvis_responsive_settings',
                'settings' => 'farvis_tablet_phone',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'farvis' ),
                    'no-tablet-phone' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 50
            )
        );

        $wp_customize->add_control(
            'farvis_tablet_socials',
            array(
                'label'    => esc_html__( 'Tablet Socials', 'farvis' ),
                'description'   => esc_html__( 'Off header social icons on tablet', 'farvis' ),
                'section'  => 'farvis_responsive_settings',
                'settings' => 'farvis_tablet_socials',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'farvis' ),
                    'no-tablet-socials' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 60
            )
        );
		
	}
		
?>