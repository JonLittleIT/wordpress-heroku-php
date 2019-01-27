<?php 
	
	function farvis_customize_footer_tab($wp_customize, $theme_name){

		$wp_customize->add_section( 'farvis_footer_settings' , array(
		    'title'      => esc_html__( 'Footer', 'farvis' ),
		    'priority'   => 75,
		) );

		

		

		$staticBlocks = farvis_get_staticblock_option_array();

		$wp_customize->add_setting( 'farvis_footer_block_top' , array(
			'default'     => '0',
			'transport'   => 'refresh',
			'sanitize_callback' => 'esc_html'
		) );
		$wp_customize->add_control(
			'farvis_footer_block_top',
			array(
				'label'    => esc_html__( 'Top Footer Block', 'farvis' ),
				'section'  => 'farvis_footer_settings',
				'settings' => 'farvis_footer_block_top',
				'type'     => 'select',
				'choices'  => $staticBlocks,
			)
		);

		$wp_customize->add_setting( 'farvis_footer_block' , array(
			'default'     => '0',
			'transport'   => 'refresh',
			'sanitize_callback' => 'esc_html'
		) );
		$wp_customize->add_control(
			'farvis_footer_block',
			array(
				'label'    => esc_html__( 'Bottom Footer Block', 'farvis' ),
				'section'  => 'farvis_footer_settings',
				'settings' => 'farvis_footer_block',
				'type'     => 'select',
				'choices'  => $staticBlocks,
			)
		);

		$wp_customize->add_setting( 'farvis_footer_fixed' , array(
            'default'     => '0',
            'transport'   => 'refresh',
		    'sanitize_callback' => 'esc_html'
        ) );
		$wp_customize->add_control(
            'farvis_footer_fixed',
            array(
                'label'    => esc_html__( 'Fixed', 'farvis' ),
                'section'  => 'farvis_footer_settings',
                'settings' => 'farvis_footer_fixed',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'farvis' ),
                    '0' => esc_html__( 'Off', 'farvis' ),
                ),
            )
        );

	}
		
?>