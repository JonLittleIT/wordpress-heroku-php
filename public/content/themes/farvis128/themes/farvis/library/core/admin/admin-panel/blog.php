<?php
    function farvis_customize_blog_tab($wp_customize, $theme_name){

        $wp_customize->add_section( 'farvis_blog_settings' , array(
            'title'      => esc_html__( 'Blog', 'farvis' ),
            'priority'   => 65,
        ) );


        $wp_customize->add_setting( 'farvis_blog_settings_type' , array(
			'default'     => 'classic',
			'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
		    'sanitize_callback' => 'esc_attr',
		) );

        $wp_customize->add_control(
            'farvis_blog_settings_type',
            array(
                'label'    => esc_html__( 'Blog display type', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_type',
                'type'     => 'select',
                'choices'  => array(
                    'classic'  => esc_html__( 'Classic', 'farvis' ),
                    'grid' => esc_html__( 'Grid', 'farvis' ),
                ),
                'priority'   => 10
            )
        );


        $wp_customize->add_setting( 'farvis_blog_settings_date' , array(
			'default'     => '1',
			'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
		    'sanitize_callback' => 'esc_attr',
		) );
        
		$wp_customize->add_setting( 'farvis_blog_settings_author_name' , array(
			'default'     => '1',
			'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
		    'sanitize_callback' => 'esc_attr',
		) );

		$wp_customize->add_setting( 'farvis_blog_settings_author' , array(
			'default'     => '1',
			'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
		    'sanitize_callback' => 'esc_attr',
		) );

		$wp_customize->add_setting( 'farvis_blog_settings_comments' , array(
			'default'     => '1',
			'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
		    'sanitize_callback' => 'esc_attr',
		) );

        $wp_customize->add_setting( 'farvis_blog_settings_categories' , array(
			'default'     => '1',
			'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
		    'sanitize_callback' => 'esc_attr',
		) );

		$wp_customize->add_setting( 'farvis_blog_settings_tags' , array(
			'default'     => '1',
			'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
		    'sanitize_callback' => 'esc_attr',
		) );
		
        $wp_customize->add_setting( 'farvis_blog_settings_share' , array(
            'default'     => '1',
            'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
            'sanitize_callback' => 'esc_attr',
        ) );
        
        $wp_customize->add_setting( 'farvis_blog_settings_readmore' , array(
            'default'     => esc_html__( 'Read more', 'farvis' ),
            'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
		    'sanitize_callback' => 'esc_html',
        ) );


        $wp_customize->add_control(
            'farvis_blog_settings_date',
            array(
                'label'    => esc_html__( 'Display Date on blog posts', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_date',
                'type'     => 'select',
                'choices'  => array(
                    '0'  => esc_html__( 'Off', 'farvis' ),
                    '1' => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 50
            )
        );
        
        $wp_customize->add_control(
            'farvis_blog_settings_author_name',
            array(
                'label'    => esc_html__( 'Display Author name on blog page and single post', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_author_name',
                'type'     => 'select',
                'choices'  => array(
                    '0'  => esc_html__( 'Off', 'farvis' ),
                    '1' => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 60
            )
        );
        
        $wp_customize->add_control(
            'farvis_blog_settings_author',
            array(
                'label'    => esc_html__( 'Display About Author block on single post', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_author',
                'type'     => 'select',
                'choices'  => array(
                    '0'  => esc_html__( 'Off', 'farvis' ),
                    '1' => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 70
            )
        );
        
        $wp_customize->add_control(
            'farvis_blog_settings_comments',
            array(
                'label'    => esc_html__( 'Display Comments on single post', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_comments',
                'type'     => 'select',
                'choices'  => array(
                    '0'  => esc_html__( 'Off', 'farvis' ),
                    '1' => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 80
            )
        );
        
        $wp_customize->add_control(
            'farvis_blog_settings_categories',
            array(
                'label'    => esc_html__( 'Display Categories', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_categories',
                'type'     => 'select',
                'choices'  => array(
                    '0'  => esc_html__( 'Off', 'farvis' ),
                    '1' => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 90
            )
        );
        
        $wp_customize->add_control(
            'farvis_blog_settings_tags',
            array(
                'label'    => esc_html__( 'Display Tags', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_tags',
                'type'     => 'select',
                'choices'  => array(
                    'off'  => esc_html__( 'Off', 'farvis' ),
                    'on' => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 100
            )
        );
        
        $wp_customize->add_control(
            'farvis_blog_settings_share',
            array(
                'label'    => esc_html__( 'Display share buttons on single post', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_share',
                'type'     => 'select',
                'choices'  => array(
                    'off'  => esc_html__( 'Off', 'farvis' ),
                    'on' => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 110
            )
        );
        
		$wp_customize->add_setting( 'farvis_blog_settings_sidebar' , array(
            'default'     => 'on',
            'transport'   => 'refresh',
            'theme_supports' => 'farvis_customize_opt',
            'sanitize_callback' => 'esc_attr',
        ) );		
		$wp_customize->add_control(
            'farvis_blog_settings_sidebar',
            array(
                'label'    => esc_html__( 'Sticky Sidebar', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_sidebar',
                'type'     => 'select',
                'choices'  => array(
                    'off'  => esc_html__( 'Off', 'farvis' ),
                    'on' => esc_html__( 'On', 'farvis' ),
                ),
                'priority'   => 120
            )
        );

        $wp_customize->add_control(
            'farvis_blog_settings_readmore',
            array(
                'label'    => esc_html__( 'Read More button text', 'farvis' ),
                'section'  => 'farvis_blog_settings',
                'settings' => 'farvis_blog_settings_readmore',
                'type'     => 'textfield',
                'priority'   => 10
            )
        );


    }
?>