<?php

	function farvis_header_type_callback( $control ) {
	    if ( $control->manager->get_setting('farvis_header_type')->value() == 'header3' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function farvis_header_type12_callback( $control ) {
	    if ( $control->manager->get_setting('farvis_header_type')->value() != 'header3' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function farvis_header_type4_callback( $control ) {
	    if ( $control->manager->get_setting('farvis_header_type')->value() == 'header4' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function farvis_header_background_callback( $control ) {
	    if (  in_array($control->manager->get_setting('farvis_header_background')->value(), array('trans-white', 'trans-black')) ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function farvis_header_menu_callback( $control ) {
	    if (  $control->manager->get_setting('farvis_header_menu')->value() != 0 ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function farvis_header_decore_callback ( $control ) {
		if ( $control->manager->get_setting('farvis_header_type')->value() == 'header4' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function farvis_header_type5_callback( $control ) {
	    if ( $control->manager->get_setting('farvis_header_type')->value() == 'header5' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function farvis_customize_header_tab($wp_customize, $theme_name){

		$header_elements = array(
			'logo'  => esc_html__( 'Logo', 'farvis' ),
			'menu' => esc_html__( 'Menu', 'farvis' ),
			'hamburger' => esc_html__( 'Hamburger Menu', 'farvis' ),
			'logo_menu' => esc_html__( 'Menu With Centered Logo', 'farvis' ),
			'search'  => esc_html__( 'Search', 'farvis' ),
			'cart'  => esc_html__( 'Cart', 'farvis' ),
			'socials' => esc_html__( 'Socials', 'farvis' ),
			'phone'  => esc_html__( 'Phone', 'farvis' ),
			'email' => esc_html__( 'E-mail', 'farvis' ),
			'text' => esc_html__( 'Custom Text', 'farvis' ),
		);

		$header_elements_position = array(
			'1'  => esc_html__( 'On', 'farvis' ),
			'0'  => esc_html__( 'Off', 'farvis' ),
			'level_1_left'  => esc_html__( 'Level 1 Left', 'farvis' ),
			'level_1_right' => esc_html__( 'Level 1 Right', 'farvis' ),
			'level_1_center' => esc_html__( 'Level 1 Center', 'farvis' ),
			'level_2_left'  => esc_html__( 'Level 2 Left', 'farvis' ),
			'level_2_right'  => esc_html__( 'Level 2 Right', 'farvis' ),
			'level_2_center' => esc_html__( 'Level 2 Center', 'farvis' ),
			'top_bar_left'  => esc_html__( 'Top Bar Left', 'farvis' ),
			'top_bar_right' => esc_html__( 'Top Bar Right', 'farvis' ),
			'top_bar_center' => esc_html__( 'Top Bar Center', 'farvis' ),
		);

		$wp_customize->add_panel('farvis_header_panel',  array(
            'title' => 'Header',
            'priority' => 30,
            )
        );


		$wp_customize->add_section( 'farvis_header_settings' , array(
		    'title'      => esc_html__( 'General Settings', 'farvis' ),
		    'priority'   => 5,
			'panel' => 'farvis_header_panel'
		) );

		$wp_customize->add_setting( 'farvis_header_type' , array(
				'default'     => 'header1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_type',
            array(
                'label'    => esc_html__( 'Type', 'farvis' ),
                'section'  => 'farvis_header_settings',
                'settings' => 'farvis_header_type',
                'type'     => 'select',
                'choices'  => array(
                    'header1'  => esc_html__( 'Classic', 'farvis' ),
                    'header2' => esc_html__( 'Shop', 'farvis' ),
		            'header3' => esc_html__( 'Sidebar', 'farvis' ),
		            'header4' => esc_html__( 'Middle', 'farvis' ),
                    'header5' => esc_html__( 'Advanced', 'farvis' ),
                ),
                'priority'   => 10
            )
        );

        /* MIDDLE TYPE */
        $wp_customize->add_setting( 'farvis_header_type4_lmenu' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$args = array(
			'taxonomy' => 'nav_menu',
			'hide_empty' => true,
		);
		$menus = get_terms( $args );
		$menus_arr = array();
		$menus_arr[''] = esc_html__( 'Select Menu', 'farvis' );
		foreach ($menus as $key => $value) {
			if(is_object($value)) {
				$menus_arr[$value->term_id] = $value->name;
			}
		}
		$wp_customize->add_control( 'farvis_header_type4_lmenu', array(
			'label'    => esc_html__( 'Left Menu', 'farvis' ),
			'section'         => 'farvis_header_settings',
			'settings' => 'farvis_header_type4_lmenu',
			'type'          => 'select',
            'choices'       => $menus_arr,
            'active_callback' => 'farvis_header_type4_callback',
			'priority'   => 11,
		));
		$wp_customize->add_setting( 'farvis_header_type4_rmenu' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'farvis_header_type4_rmenu', array(
			'label'    => esc_html__( 'Right Menu', 'farvis' ),
			'section'         => 'farvis_header_settings',
			'settings' => 'farvis_header_type4_rmenu',
			'type'          => 'select',
            'choices'       => $menus_arr,
            'active_callback' => 'farvis_header_type4_callback',
			'priority'   => 11
		));

		/* CREATE TINYMCE FIELD */
		class Text_Editor_Custom_Control extends WP_Customize_Control
		{
		    public $type = 'textarea';
		    public function render_content() {
		    	echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		        $settings = array(
		            'media_buttons' => false,
		            'quicktags' => true,
		            'textarea_rows' => 5
		        );
		        $this->filter_editor_setting_link();
		        wp_editor($this->value(), $this->id, $settings );
		        do_action('admin_footer');
		        do_action('admin_print_footer_scripts');
		    }
		    private function filter_editor_setting_link() {
		        add_filter( 'the_editor', function( $output ) { 
		        	return preg_replace( '/<textarea/', '<textarea ' . $this->get_link(), $output, 1 ); 
		        } );
		    }
		}
		function editor_customizer_script() {
		    wp_enqueue_script( 'wp-editor-customizer', get_template_directory_uri() . '/library/core/admin/js/customizer.js', array( 'jquery' ), rand(), true );
		}
		add_action( 'customize_controls_enqueue_scripts', 'editor_customizer_script' );

		/* ADVANCED TYPE */
		/* BLOCK 1 */
		$wp_customize->add_setting( 'farvis_header_type5_block1_icon' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'farvis_header_type5_block1_icon',
            array(
                'label'         => esc_html__( 'Block #1 Icon Class', 'farvis' ),
                'section'       => 'farvis_header_settings',
                'settings'      => 'farvis_header_type5_block1_icon',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'farvis_header_type5_callback',
            )
        );
		$wp_customize->add_setting( 'farvis_header_type5_block1_content' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize -> add_control(
		    new Text_Editor_Custom_Control(
		        $wp_customize,
		        'farvis_header_type5_block1_content',
		        array(
		            'label'         => esc_html__( 'Block #1 Content', 'farvis' ),
	                'section'       => 'farvis_header_settings',
	                'settings'      => 'farvis_header_type5_block1_content',
	                'priority'   => 12,
	                'active_callback' => 'farvis_header_type5_callback',
		        )
		    )
		);
        /* BLOCK 2 */
        $wp_customize->add_setting( 'farvis_header_type5_block2_icon' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'farvis_header_type5_block2_icon',
            array(
                'label'         => esc_html__( 'Block #2 Icon Class', 'farvis' ),
                'section'       => 'farvis_header_settings',
                'settings'      => 'farvis_header_type5_block2_icon',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'farvis_header_type5_callback',
            )
        );
		$wp_customize->add_setting( 'farvis_header_type5_block2_content' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize -> add_control(
		    new Text_Editor_Custom_Control(
		        $wp_customize,
		        'farvis_header_type5_block2_content',
		        array(
		            'label'         => esc_html__( 'Block #2 Content', 'farvis' ),
	                'section'       => 'farvis_header_settings',
	                'settings'      => 'farvis_header_type5_block2_content',
	                'priority'   => 12,
	                'active_callback' => 'farvis_header_type5_callback',
		        )
		    )
		);
        /* BLOCK 3 */
        $wp_customize->add_setting( 'farvis_header_type5_block3_icon' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'farvis_header_type5_block3_icon',
            array(
                'label'         => esc_html__( 'Block #3 Icon Class', 'farvis' ),
                'section'       => 'farvis_header_settings',
                'settings'      => 'farvis_header_type5_block3_icon',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'farvis_header_type5_callback',
            )
        );
		$wp_customize->add_setting( 'farvis_header_type5_block3_content' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize -> add_control(
		    new Text_Editor_Custom_Control(
		        $wp_customize,
		        'farvis_header_type5_block3_content',
		        array(
		            'label'         => esc_html__( 'Block #3 Content', 'farvis' ),
	                'section'       => 'farvis_header_settings',
	                'settings'      => 'farvis_header_type5_block3_content',
	                'priority'   => 12,
	                'active_callback' => 'farvis_header_type5_callback',
		        )
		    )
		);
		/* RIGHT BLOCK */
		$wp_customize->add_setting( 'farvis_header_type5_rblock_text' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'farvis_header_type5_rblock_text',
            array(
                'label'         => esc_html__( 'Right Block Text', 'farvis' ),
                'section'       => 'farvis_header_settings',
                'settings'      => 'farvis_header_type5_rblock_text',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'farvis_header_type5_callback',
            )
        );
        $wp_customize->add_setting( 'farvis_header_type5_rblock_link' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'farvis_header_type5_rblock_link',
            array(
                'label'         => esc_html__( 'Right Block Link', 'farvis' ),
                'section'       => 'farvis_header_settings',
                'settings'      => 'farvis_header_type5_rblock_link',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'farvis_header_type5_callback',
            )
        );


		$wp_customize->add_setting( 'farvis_header_sidebar_view' , array(
				'default'     => 'fixed',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_sidebar_view',
            array(
                'label'    => esc_html__( 'Sidebar View', 'farvis' ),
                'section'  => 'farvis_header_settings',
                'settings' => 'farvis_header_sidebar_view',
                'type'     => 'select',
                'choices'  => array(
                    'fixed'  => esc_html__( 'Fixed', 'farvis' ),
                    'horizontal' => esc_html__( 'Horizontal Button', 'farvis' ),
		            'vertical' => esc_html__( 'Vertical Button', 'farvis' ),
                ),
                'active_callback' => 'farvis_header_type_callback',
                'priority'   => 20
            )
        );


		$wp_customize->add_setting( 'farvis_header_sticky' , array(
				'default'     => '0',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_sticky',
            array(
                'label'         => esc_html__( 'Behavior', 'farvis' ),
                'section'       => 'farvis_header_settings',
                'settings'      => 'farvis_header_sticky',
                'type'          => 'select',
                'choices'       => array(
                    '0' => esc_html__( 'Default', 'farvis' ),
                    'sticky'  => esc_html__( 'Sticky Top', 'farvis' ),
		            'fixed'  => esc_html__( 'Sticky and Scroll ', 'farvis' ),
                    'scroll'  => esc_html__( 'Sticky Scroll ', 'farvis' ),
                ),
                'priority'   => 30
            )
        );
        
        $wp_customize->add_setting( 'farvis_header_decore' , array(
				'default'     => 'none',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_decore',
            array(
                'label'         => esc_html__( 'Header decore', 'farvis' ),
                'section'       => 'farvis_header_settings',
                'settings'      => 'farvis_header_decore',
                'type'          => 'select',
                'choices'       => array(
                    'none' => esc_html__( 'none', 'farvis' ),
                    'style_1'  => esc_html__( 'Style 1', 'farvis' ),
		            'style_2'  => esc_html__( 'Style 2', 'farvis' ),
                ),
                'priority'   => 30,
                'active_callback' => 'farvis_header_decore_callback',
            )
        );


		$wp_customize->add_setting( 'farvis_header_menu' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_menu',
            array(
                'label'    => esc_html__( 'Menu', 'farvis' ),
                'section'  => 'farvis_header_settings',
                'settings' => 'farvis_header_menu',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'farvis' ),
                    '0' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 40
            )
        );


		$wp_customize->add_setting( 'farvis_header_menu_add' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$args = array(
			'taxonomy' => 'nav_menu',
			'hide_empty' => true,
		);
		$menus = get_terms( $args );
		$menus_arr = array();
		$menus_arr[''] = esc_html__( 'Select Menu', 'farvis' );
		foreach ($menus as $key => $value) {
			if(is_object($value)) {
				$menus_arr[$value->term_id] = $value->name;
			}
		}
        $wp_customize->add_control(
            'farvis_header_menu_add',
            array(
                'label'         => esc_html__( 'Additional Menu', 'farvis' ),
                'section'       => 'farvis_header_settings',
                'settings'      => 'farvis_header_menu_add',
                'type'          => 'select',
                'choices'       => $menus_arr,
                'active_callback' => 'farvis_header_type12_callback',
                'priority'   => 50
            )
        );


		$wp_customize->add_setting( 'farvis_header_menu_add_position' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_menu_add_position',
            array(
                'label'    => esc_html__( 'Additional Menu Position', 'farvis' ),
                'section'  => 'farvis_header_settings',
                'settings' => 'farvis_header_menu_add_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left Sidebar', 'farvis' ),
                    'right' => esc_html__( 'Right Sidebar', 'farvis' ),
		            'top' => esc_html__( 'Top Sidebar', 'farvis' ),
		            'bottom'  => esc_html__( 'Bottom Sidebar', 'farvis' ),
                    'screen' => esc_html__( 'Full Screen', 'farvis' ),
                    'fly' => esc_html__( 'Fly Menu', 'farvis' ),
		            'disable' => esc_html__( 'Disabled', 'farvis' ),
                ),
                'active_callback' => 'farvis_header_type12_callback',
                'priority'   => 60
            )
        );


        $wp_customize->add_setting( 'farvis_header_advanced_page' , array(
				'default'     => '0',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_advanced_page',
            array(
                'label'    => esc_html__( 'Advanced Options on Page', 'farvis' ),
                'description'   => '',
                'section'  => 'farvis_header_settings',
                'settings' => 'farvis_header_advanced_page',
                'type'     => 'select',
                'choices'  => array(
                    '0' => esc_html__( 'Off', 'farvis' ),
                    '1'  => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 70
            )
        );



		/// HEADER STYLE ///

		$wp_customize->add_section( 'farvis_header_settings_style' , array(
		    'title'      => esc_html__( 'Style', 'farvis' ),
		    'priority'   => 10,
			'panel' => 'farvis_header_panel'
		) );


		$wp_customize->add_setting( 'farvis_header_layout' , array(
				'default'     => 'normal',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_layout',
            array(
                'label'    => esc_html__( 'Layout', 'farvis' ),
                'section'  => 'farvis_header_settings_style',
                'settings' => 'farvis_header_layout',
                'type'     => 'select',
                'choices'  => array(
                    'normal'  => esc_html__( 'Normal', 'farvis' ),
                    'boxed' => esc_html__( 'Boxed', 'farvis' ),
		            'full' => esc_html__( 'Full Width', 'farvis' ),
                ),
                'priority'   => 10
            )
        );


		$wp_customize->add_setting( 'farvis_header_background' , array(
				'default'     => 'trans-black',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_background',
            array(
                'label'    => esc_html__( 'Background', 'farvis' ),
                'description'   => esc_html__( 'Background header color', 'farvis' ),
                'section'  => 'farvis_header_settings_style',
                'settings' => 'farvis_header_background',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Default', 'farvis' ),
                    'white' => esc_html__( 'White', 'farvis' ),
		            'black' => esc_html__( 'Black', 'farvis' ),
	                'trans-white' => esc_html__( 'Transparent White', 'farvis' ),
		            'trans-black' => esc_html__( 'Transparent Black', 'farvis' ),
                ),
                'priority'   => 20
            )
        );


		$wp_customize->add_setting( 'farvis_header_transparent' , array(
				'default'     => '4',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_transparent',
            array(
                'label'    => esc_html__( 'Transparent', 'farvis' ),
                'section'  => 'farvis_header_settings_style',
                'settings' => 'farvis_header_transparent',
                'type'     => 'select',
                'choices'  => array(
                    '0' => "0.0",
					'1' => "0.1",
					'2' => "0.2",
					'3' => "0.3",
					'4' => "0.4",
					'5' => "0.5",
					'6' => "0.6",
					'7' => "0.7",
					'8' => "0.8",
					'9' => "0.9",
                ),
                'priority'   => 30
            )
        );


        $wp_customize->add_setting( 'farvis_header_menu_animation' , array(
				'default'     => 'overlay',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_menu_animation',
            array(
                'label'         => esc_html__( 'Sidebar Menu Animation', 'farvis' ),
                'description'   => esc_html__( 'Overlay or reveal Sidebar menu animation', 'farvis' ),
                'section'       => 'farvis_header_settings_style',
                'settings'      => 'farvis_header_menu_animation',
                'type'          => 'select',
                'choices'       => array(
                    'overlay' => esc_html__( 'Overlay', 'farvis' ),
                    'reveal'  => esc_html__( 'Reveal', 'farvis' ),
                ),
                'priority'   => 40
            )
        );


		$wp_customize->add_setting( 'farvis_header_hover_effect' , array(
				'default'     => '0',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_hover_effect',
            array(
                'label'    => esc_html__( 'Menu Hover Effect', 'farvis' ),
                'section'  => 'farvis_header_settings_style',
                'settings' => 'farvis_header_hover_effect',
                'type'     => 'select',
                'choices'  => array(
                    '0' => esc_html__( 'Without effect', 'farvis' ),
					'1' => "a",
					'3' => "b",
					'4' => "c",
					'6' => "d",
					'7' => "e",
					'8' => "f",
					'9' => "g",
					'11' => "h",
					'12' => "i",
		            '13' => "j",
					'14' => "k",
		            '17' => "l",
					'18' => "m",
                ),
                'active_callback' => 'farvis_header_menu_callback',
                'priority'   => 50
            )
        );


		$wp_customize->add_setting( 'farvis_header_marker' , array(
				'default'     => 'menu-marker-arrow',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_header_marker',
			array(
				'label'    => esc_html__( 'Menu Markers', 'farvis' ),
				'section'  => 'farvis_header_settings_style',
				'settings' => 'farvis_header_marker',
				'type'     => 'select',
				'choices'  => array(
						'menu-marker-arrow'  => esc_html__( 'Arrows', 'farvis' ),
						'menu-marker-dot' => esc_html__( 'Dots', 'farvis' ),
						'no-marker' => esc_html__( 'Without markers', 'farvis' ),
				),
				'active_callback' => 'farvis_header_menu_callback',
				'priority'   => 60
			)
		);




        /// HEADER ELEMENTS ///

		$wp_customize->add_section( 'farvis_header_settings_elements' , array(
		    'title'      => esc_html__( 'Elements', 'farvis' ),
		    'priority'   => 15,
			'panel' => 'farvis_header_panel'
		) );


		$wp_customize->add_setting( 'farvis_header_bar' , array(
				'default'     => '0',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'farvis_header_bar',
			array(
				'label'    => esc_html__( 'Top Bar', 'farvis' ),
				'section'  => 'farvis_header_settings_elements',
				'settings' => 'farvis_header_bar',
				'type'     => 'select',
				'choices'  => array(
						'1'  => esc_html__( 'On', 'farvis' ),
						'0' => esc_html__( 'Off', 'farvis' ),
				),
				'priority'   => 10
			)
		);


		$wp_customize->add_setting( 'farvis_header_minicart' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_minicart',
            array(
                'label'    => esc_html__( 'Minicart', 'farvis' ),
                'section'  => 'farvis_header_settings_elements',
                'settings' => 'farvis_header_minicart',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'farvis' ),
                    '0' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 20
            )
        );


		$wp_customize->add_setting( 'farvis_header_search' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_search',
            array(
                'label'    => esc_html__( 'Search', 'farvis' ),
                'section'  => 'farvis_header_settings_elements',
                'settings' => 'farvis_header_search',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'farvis' ),
                    '0' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 30
            )
        );


		$wp_customize->add_setting( 'farvis_header_socials' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_socials',
            array(
                'label'    => esc_html__( 'Socials', 'farvis' ),
                'section'  => 'farvis_header_settings_elements',
                'settings' => 'farvis_header_socials',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'farvis' ),
                    '0' => esc_html__( 'Off', 'farvis' ),
                ),
                'priority'   => 40
            )
        );





		/// HEADER ELEMENTS POSITION ///

		$wp_customize->add_section( 'farvis_header_settings_elements_position' , array(
		    'title'      => esc_html__( 'Elements Position', 'farvis' ),
		    'priority'   => 20,
			'panel' => 'farvis_header_panel'
		) );


		$wp_customize->add_setting( 'farvis_header_topbarbox_1_position' , array(
				'default'     => 'left',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_topbarbox_1_position',
            array(
                'label'    => esc_html__( 'Top Bar Email', 'farvis' ),
                'section'  => 'farvis_header_settings_elements_position',
                'settings' => 'farvis_header_topbarbox_1_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'farvis' ),
                    'right' => esc_html__( 'Right', 'farvis' ),
                ),
                'priority'   => 50
            )
        );

		$wp_customize->add_setting( 'farvis_header_topbarbox_2_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_topbarbox_2_position',
            array(
                'label'    => esc_html__( 'Top Bar Menu', 'farvis' ),
                'section'  => 'farvis_header_settings_elements_position',
                'settings' => 'farvis_header_topbarbox_2_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'farvis' ),
                    'right' => esc_html__( 'Right', 'farvis' ),
                ),
                'priority'   => 60
            )
        );


		$wp_customize->add_setting( 'farvis_header_navibox_1_position' , array(
				'default'     => 'left',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_navibox_1_position',
            array(
                'label'    => esc_html__( 'Logo', 'farvis' ),
                'section'  => 'farvis_header_settings_elements_position',
                'settings' => 'farvis_header_navibox_1_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'farvis' ),
                    'right' => esc_html__( 'Right', 'farvis' ),
                ),
                'priority'   => 70
            )
        );


		$wp_customize->add_setting( 'farvis_header_navibox_2_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_navibox_2_position',
            array(
                'label'    => esc_html__( 'Main Menu', 'farvis' ),
                'section'  => 'farvis_header_settings_elements_position',
                'settings' => 'farvis_header_navibox_2_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'farvis' ),
                    'right' => esc_html__( 'Right', 'farvis' ),
                ),
                'priority'   => 80
            )
        );


		$wp_customize->add_setting( 'farvis_header_navibox_3_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_navibox_3_position',
            array(
                'label'    => esc_html__( 'Socials And Phone', 'farvis' ),
                'section'  => 'farvis_header_settings_elements_position',
                'settings' => 'farvis_header_navibox_3_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'farvis' ),
                    'right' => esc_html__( 'Right', 'farvis' ),
                ),
                'priority'   => 90
            )
        );


		$wp_customize->add_setting( 'farvis_header_navibox_4_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'farvis_header_navibox_4_position',
            array(
                'label'    => esc_html__( 'Minicart', 'farvis' ),
                'section'  => 'farvis_header_settings_elements_position',
                'settings' => 'farvis_header_navibox_4_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'farvis' ),
                    'right' => esc_html__( 'Right', 'farvis' ),
                ),
                'priority'   => 100
            )
        );


		$wp_customize->add_setting( 'farvis_header_adm_bar' , array(
				'default'     => '0',
				'sanitize_callback' => 'sanitize_text_field'
		) );
        $wp_customize->add_control(
            'farvis_header_adm_bar',
            array(
                'label'    => esc_html__( 'Admin Bar Opacity', 'farvis' ),
                'description'   => '',
                'section'  => 'farvis_header_settings_elements_position',
                'settings' => 'farvis_header_adm_bar',
                'type'     => 'select',
                'choices'  => array(
                    '0'  => esc_html__( 'No', 'farvis' ),
                    '1' => esc_html__( 'Yes', 'farvis' ),
                ),
                'priority'   => 110
            )
        );




        /// HEADER INFO ///

		$wp_customize->add_section( 'farvis_header_settings_info' , array(
		    'title'      => esc_html__( 'Phone and email', 'farvis' ),
		    'priority'   => 25,
			'panel' => 'farvis_header_panel'
		) );


		$wp_customize->add_setting( 'farvis_header_phone' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize->add_control(
			'farvis_header_phone',
			array(
				'label'    => esc_html__( 'Phone', 'farvis' ),
				'section'  => 'farvis_header_settings_info',
				'settings' => 'farvis_header_phone',
				'type'     => 'text',
				'priority'   => 10
			)
		);


		$wp_customize->add_setting( 'farvis_header_email' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize->add_control(
			'farvis_header_email',
			array(
				'label'    => esc_html__( 'Email', 'farvis' ),
				'section'  => 'farvis_header_settings_info',
				'settings' => 'farvis_header_email',
				'type'     => 'text',
				'priority'   => 20
			)
		);

		
	}
		
?>