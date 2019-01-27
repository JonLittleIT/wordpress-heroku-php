<?php

	function farvis_customize_page_t_a_b_tab($wp_customize, $theme_name){
		
		/// HEADER BACKGROUND ///

		$wp_customize->add_section( 'farvis_page_tab_settings' , array(
		    'title'      => esc_html__( 'Page Title and Breadcrumbs', 'farvis' ),
		    'priority'   => 45,
		) );


		$wp_customize->add_setting( 'farvis_tab_bg_image' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'farvis_tab_bg_image',
				array(
				   'label'      => esc_html__( 'Background Image', 'farvis' ),
				   'section'    => 'farvis_page_tab_settings',
				   'context'    => 'farvis_tab_bg_image',
				   'settings'   => 'farvis_tab_bg_image',
				   'priority'   => 10
				)
	       )
	    );

	    $wp_customize->add_setting( 'farvis_tab_bg_image_fixed' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
            'farvis_tab_bg_image_fixed',
            array(
                'label'    => esc_html__( 'Fixed Image', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_tab_bg_image_fixed',
                'type'     => 'select',
                'choices'  => array(
                    '0' => esc_html__( 'No', 'farvis' ),
					'1' => esc_html__( 'Yes', 'farvis' ),
                ),
                'priority'   => 15
            )
        );

	    $wp_customize->add_setting( 'farvis_tab_bg_color' , array(
				'default'     => get_option('farvis_default_tab_bg_color'),
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
	        new WP_Customize_Color_Control(
	            $wp_customize,
	            'farvis_tab_bg_color',
				array(
				   'label'      => esc_html__( 'Overlay Color', 'farvis' ),
				   'section'    => 'farvis_page_tab_settings',
				   'settings'   => 'farvis_tab_bg_color',
				   'priority'   => 20
				)
	       )
	    );

	    $wp_customize->add_setting( 'farvis_tab_bg_color_gradient' , array(
				'default'     => get_option('farvis_default_tab_bg_color_gradient'),
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
	        new WP_Customize_Color_Control(
	            $wp_customize,
	            'farvis_tab_bg_color_gradient',
				array(
				   'label'      => esc_html__( 'Gradient Color', 'farvis' ),
				   'description'    => esc_html__( 'Set this color for gradient overlay', 'farvis'),
				   'section'    => 'farvis_page_tab_settings',
				   'settings'   => 'farvis_tab_bg_color_gradient',
				   'priority'   => 30
				)
	       )
	    );

	    $wp_customize->add_setting( 'farvis_tab_gradient_direction' , array(
				'default'     => get_option('farvis_default_tab_gradient_direction'),
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
            'farvis_tab_gradient_direction',
            array(
                'label'    => esc_html__( 'Gradient Direction', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_tab_gradient_direction',
                'type'     => 'select',
                'choices'  => array(
                    'to right' => esc_html__( 'To Right ', 'farvis' ).html_entity_decode('&rarr;'),
					'to left' => esc_html__( 'To Left ', 'farvis' ).html_entity_decode('&larr;'),
					'to bottom' => esc_html__( 'To Bottom ', 'farvis' ).html_entity_decode('&darr;'),
					'to top' => esc_html__( 'To Top ', 'farvis' ).html_entity_decode('&uarr;'),
					'to bottom right' => esc_html__( 'To Bottom Right ', 'farvis' ).html_entity_decode('&#8600;'),
					'to bottom left' => esc_html__( 'To Bottom Left ', 'farvis' ).html_entity_decode('&#8601;'),
					'to top right' => esc_html__( 'To Top Right ', 'farvis' ).html_entity_decode('&#8599;'),
					'to top left' => esc_html__( 'To Top Left ', 'farvis' ).html_entity_decode('&#8598;'),
					//'angle' => esc_html__( 'Angle ', 'farvis' ).html_entity_decode('&#10227;'),
                ),
                'priority'   => 40
            )
        );

		$wp_customize->add_setting( 'farvis_tab_bg_opacity' , array(
				'default'     => get_option('farvis_default_tab_bg_opacity'),
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
            'farvis_tab_bg_opacity',
            array(
                'label'    => esc_html__( 'Overlay Opacity', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_tab_bg_opacity',
                'type'     => 'select',
                'choices'  => array(
                    '0.0' => "0.0",
					'0.1' => "0.1",
					'0.2' => "0.2",
					'0.3' => "0.3",
					'0.4' => "0.4",
					'0.5' => "0.5",
					'0.6' => "0.6",
					'0.7' => "0.7",
					'0.8' => "0.8",
					'0.9' => "0.9",
					'1' => "1",
                ),
                'priority'   => 45
            )
        );

        $wp_customize->add_setting( 'farvis_tab_title_position' , array(
				'default'     => 'left',
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
            'farvis_tab_title_position',
            array(
                'label'    => esc_html__( 'Page Title Position', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_tab_title_position',
                'type'     => 'select',
                'choices'  => array(
                    '' => esc_html__( 'Center', 'farvis' ),
					'left' => esc_html__( 'Left', 'farvis' ),
					'right' => esc_html__( 'Right', 'farvis' ),
		            'hide' => esc_html__( 'Hide', 'farvis' ),
                ),
                'priority'   => 50
            )
        );

        $wp_customize->add_setting( 'farvis_tab_breadcrumbs_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
            'farvis_tab_breadcrumbs_position',
            array(
                'label'    => esc_html__( 'Breadcrumbs Position', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_tab_breadcrumbs_position',
                'type'     => 'select',
                'choices'  => array(
                    '' => esc_html__( 'Center', 'farvis' ),
					'left' => esc_html__( 'Left', 'farvis' ),
					'right' => esc_html__( 'Right', 'farvis' ),
		            'hide' => esc_html__( 'Hide', 'farvis' ),
                ),
                'priority'   => 60
            )
        );

		$wp_customize->add_setting( 'farvis_tab_padding_top' , array(
            'default'     => get_option('farvis_default_tab_padding_top'),
            'transport'   => 'refresh',
		    'sanitize_callback' => 'esc_html',
        ) );
        $wp_customize->add_control(
            'farvis_tab_padding_top',
            array(
                'label'    => esc_html__( 'Padding Top (px)', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_tab_padding_top',
                'type'     => 'textfield',
                'priority'   => 70
            )
        );

        $wp_customize->add_setting( 'farvis_tab_padding_bottom' , array(
				'default'     => get_option('farvis_default_tab_padding_bottom'),
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_html',
		) );
		$wp_customize->add_control(
				'farvis_tab_padding_bottom',
				array(
						'label'    => esc_html__( 'Padding Bottom (px)', 'farvis' ),
						'section'  => 'farvis_page_tab_settings',
						'settings' => 'farvis_tab_padding_bottom',
						'type'     => 'textfield',
						'priority'   => 80
				)
		);

		$wp_customize->add_setting( 'farvis_tab_margin_bottom' , array(
            'default'     => get_option('farvis_default_tab_margin_bottom'),
            'transport'   => 'refresh',
		    'sanitize_callback' => 'esc_html',
        ) );
        $wp_customize->add_control(
            'farvis_tab_margin_bottom',
            array(
                'label'    => esc_html__( 'Margin Bottom (px)', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_tab_margin_bottom',
                'type'     => 'textfield',
                'priority'   => 90
            )
        );

        $wp_customize->add_setting( 'farvis_tab_border' , array(
				'default'     => get_option('farvis_default_tab_border'),
				'transport'   => 'refresh',
				'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
            'farvis_tab_border',
            array(
                'label'    => esc_html__( 'Bottom Border', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_tab_border',
                'type'     => 'select',
                'choices'  => array(
                    '1' => esc_html__( 'Show', 'farvis' ),
					'0' => esc_html__( 'Hide', 'farvis' ),
                ),
                'priority'   => 100
            )
        );
        $wp_customize->add_setting( 'farvis_page_decor' , array(
            'default'     => 1,
            'transport'   => 'refresh',
            'sanitize_callback' => 'esc_attr'
        ) );
        $wp_customize->add_control(
            'farvis_page_decor',
            array(
                'label'    => esc_html__( 'Page Decor', 'farvis' ),
                'section'  => 'farvis_page_tab_settings',
                'settings' => 'farvis_page_decor',
                'type'     => 'select',
                'choices'  => array(
                    '1' => esc_html__( 'Show', 'farvis' ),
                    '0' => esc_html__( 'Hide', 'farvis' ),
                ),
                'priority'   => 105
            )
        );

		
	}
		
?>