<?php

	function farvis_customize_search_tab($wp_customize, $theme_name){
	
		$wp_customize->add_section( 'farvis_search_settings' , array(
		    'title'      => esc_html__( 'Search', 'farvis' ),
		    'priority'   => 40,
		) );

		
		$wp_customize->add_setting( 'farvis_search_placeholder' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'farvis_search_description' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );



		$wp_customize->add_control(
			'farvis_search_placeholder',
			array(
				'label'    => esc_html__( 'Search Placeholder', 'farvis' ),
				'section'  => 'farvis_search_settings',
				'settings' => 'farvis_search_placeholder',
				'type'     => 'text',
				'priority'   => 10
			)
		);

		$wp_customize->add_control(
			'farvis_search_description',
			array(
				'label'    => esc_html__( 'Search Description', 'farvis' ),
				'section'  => 'farvis_search_settings',
				'settings' => 'farvis_search_description',
				'type'     => 'text',
				'priority'   => 20
			)
		);
		
	}
		
?>