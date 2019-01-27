<?php

 
	
	function farvis_customize_page_loader_tab($wp_customize, $theme_name){
	
		$wp_customize->add_section( 'farvis_page_loader_settings' , array(
		    'title'      => esc_html__( 'Page Loader', 'farvis' ),
		    'priority'   => 20,
		) );
		
		
 
 		/**
		 * 
		 * loader
		 * 
		 */
		 
		 $wp_customize->add_setting( 'farvis_page_loader_img' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'farvis_page_loader_img',
				array(
				   'label'      => esc_html__( 'Image', 'farvis' ),
				   'section'    => 'farvis_page_loader_settings',
				   'context'    => 'farvis_page_loader_img',
				   'settings'   => 'farvis_page_loader_img',
				   'priority'   => 60
				)
	       )
	    );
	    
	    $wp_customize->add_setting( 'farvis_page_loader_img_width' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_page_loader_img_width',
			array(
				'label'    => esc_html__( 'Image width', 'farvis' ),
				'section'  => 'farvis_page_loader_settings',
				'settings' => 'farvis_page_loader_img_width',
				'type'     => 'text',
				 
				'priority'   => 110
			)
		);
		
		$wp_customize->add_setting( 'farvis_page_loader_img_height' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_page_loader_img_height',
			array(
				'label'    => esc_html__( 'Image height', 'farvis' ),
				'section'  => 'farvis_page_loader_settings',
				'settings' => 'farvis_page_loader_img_height',
				'type'     => 'text',
				 
				'priority'   => 110
			)
		);
		
		
		$wp_customize->add_setting( 'farvis_page_loader_settings_use' , array(
		    'default'     => 'off',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_page_loader_settings_use',
			array(
				'label'    => esc_html__( 'Loader', 'farvis' ),
				'section'  => 'farvis_page_loader_settings',
				'settings' => 'farvis_page_loader_settings_use',
				'type'     => 'select',
				'choices'  => array(
					'off'  => esc_html__( 'Off', 'farvis' ),
					'usemain' => esc_html__( 'Use on main', 'farvis' ),
					'useall' => esc_html__( 'Use on all pages', 'farvis' ),
				),
				'priority'   => 110
			)
		);
		
		/**
		 * 
		 * Animation In
		 * 
		 */
		
		$wp_customize->add_setting( 'farvis_page_loader_animation_in' , array(
		    'default'     => 'fade-in',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_page_loader_animation_in',
			array(
				'label'    => esc_html__( 'Animation In', 'farvis' ),
				'section'  => 'farvis_page_loader_settings',
				'settings' => 'farvis_page_loader_animation_in',
				'type'     => 'select',
				'choices'  => array(
                    'fade-in' => esc_html__( 'Fade', 'farvis' ),
                    'fade-in-down-sm' => esc_html__( 'Fade Down', 'farvis' ),
                    'fade-in-up-sm' => esc_html__( 'Fade Up', 'farvis' ),
                    'fade-in-left-sm' => esc_html__( 'Fade Left', 'farvis' ),
                    'fade-in-right-sm' => esc_html__( 'Fade Right', 'farvis' ),
                    'rotate-in-sm' => esc_html__( 'Rotate', 'farvis' ),
                    'overlay-slide-in-top' => esc_html__( 'Slide top', 'farvis' ),
                    'overlay-slide-in-bottom' => esc_html__( 'Slide bottom', 'farvis' ),
                    'overlay-slide-in-left' => esc_html__( 'Slide left', 'farvis' ),
                    'overlay-slide-in-right' => esc_html__( 'Slide right', 'farvis' ),
                    
                    
                    
                    
					
                    
                    
					 
				),
				'priority'   => 110
			)
		);
         
		/**
		 * 
		 *  Animation Out
		 * 
		 */
		
		$wp_customize->add_setting( 'farvis_page_loader_animation_out' , array(
		    'default'     => 'fade-out',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_page_loader_animation_out',
			array(
				'label'    => esc_html__( 'Animation Out', 'farvis' ),
				'section'  => 'farvis_page_loader_settings',
				'settings' => 'farvis_page_loader_animation_out',
				'type'     => 'select',
				'choices'  => array(
					'none' => esc_html__( 'None', 'farvis' ),
                    'fade-out' => esc_html__( 'Fade', 'farvis' ),
                    'fade-out-down-sm' => esc_html__( 'Fade Down', 'farvis' ),
                    'fade-out-up-sm' => esc_html__( 'Fade Up', 'farvis' ),
					'fade-out-left-sm' => esc_html__( 'Fade Left', 'farvis' ),
                    'fade-out-right-sm' => esc_html__( 'Fade Right', 'farvis' ),
                    'rotate-out-sm' => esc_html__( 'Rotate', 'farvis' ),
                    'overlay-slide-out-top' => esc_html__( 'Slide top', 'farvis' ),
                    'overlay-slide-out-bottom' => esc_html__( 'Slide bottom', 'farvis' ),
                    'overlay-slide-out-left' => esc_html__( 'Slide left', 'farvis' ),
                    'overlay-slide-out-right' => esc_html__( 'Slide right', 'farvis' ),
					 
				),
				'priority'   => 110
			)
		);
		
		/**
		 * 
		 *  Duration In
		 * 
		 */
		
		$wp_customize->add_setting( 'farvis_page_loader_duration_in' , array(
		    'default'     => '800',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_page_loader_duration_in',
			array(
				'label'    => esc_html__( 'Duration In', 'farvis' ),
				'section'  => 'farvis_page_loader_settings',
				'settings' => 'farvis_page_loader_duration_in',
				'type' => 'text',
				'priority'   => 110
			)
		);
		
		/**
		 * 
		 *  Duration Out
		 * 
		 */
		
		$wp_customize->add_setting( 'farvis_page_loader_duration_out' , array(
		    'default'     => '800',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_page_loader_duration_out',
			array(
				'label'    => esc_html__( 'Duration Out', 'farvis' ),
				'section'  => 'farvis_page_loader_settings',
				'settings' => 'farvis_page_loader_duration_out',
				'type' => 'text',
				'priority'   => 110
			)
		);

		/* Loader color */
		$wp_customize->add_setting( 'farvis_page_loader_bg_color' , array(
		    'default'     => get_option('farvis_page_loader_bg_color'),
		    'transport'   => 'refresh',
			'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
	            $wp_customize,
	            'farvis_page_loader_bg_color',
				array(
				   'label'      => esc_html__( 'Loader Background', 'farvis' ),
				   'section'    => 'farvis_page_loader_settings',
				   'settings'   => 'farvis_page_loader_bg_color',
				   'priority'   => 110
				)
	       )
		);

	}
	
	