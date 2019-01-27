<?php

function farvis_customize_style_tab($wp_customize, $theme_name) {

	$wp_customize->add_panel('farvis_style_panel',  array(
        'title' => 'Style Settings',
        'priority' => 25,
        )
    );



	/// COLOR SETTINGS ///

	$wp_customize->add_section( 'farvis_style_general_settings' , array(
	    'title'      => esc_html__( 'Layout', 'farvis' ),
	    'priority'   => 10,
		'panel' => 'farvis_style_panel'
	) );


	$wp_customize->add_setting( 'farvis_style_general_settings_layout' , array(
        'default'     => 'normal',
        'transport'   => 'refresh',
	    'sanitize_callback' => 'esc_html',
    ) );
    $wp_customize->add_control(
        'farvis_style_general_settings_layout',
        array(
            'label'    => esc_html__( 'Page Layout', 'farvis' ),
            'section'  => 'farvis_style_general_settings',
            'settings' => 'farvis_style_general_settings_layout',
            'type'     => 'select',
            'choices'  => array(
                'normal'  => esc_html__( 'Normal', 'farvis' ),
                'full-width' => esc_html__( 'Full Width', 'farvis' ),
		        'boxed' => esc_html__( 'Boxed', 'farvis' ),
            ),
            'priority'   => 10,
        )
    );



	/// COLOR SETTINGS ///

	$wp_customize->add_section( 'farvis_style_settings' , array(
	    'title'      => esc_html__( 'Color', 'farvis' ),
	    'priority'   => 20,
		'panel' => 'farvis_style_panel'
	) );


	$wp_customize->add_setting(
		'farvis_style_settings_main_color',
		array(
			'default' => get_option('farvis_default_main_color'),
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'farvis_style_settings_main_color',
			array(
				'label' => esc_html__( 'Main Color', 'farvis' ),
				'section' => 'farvis_style_settings',
				'settings' => 'farvis_style_settings_main_color',
				'priority'   => 10
			)
		)
	);

	$wp_customize->add_setting(
		'farvis_style_settings_gradient_color',
		array(
			'default' => get_option('farvis_default_gradient_color'),
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'farvis_style_settings_gradient_color',
			array(
				'label' => esc_html__( 'Gradient Color', 'farvis' ),
				'section' => 'farvis_style_settings',
				'settings' => 'farvis_style_settings_gradient_color',
				'priority'   => 15
			)
		)
	);

	$wp_customize->add_setting(
		'farvis_style_settings_additional_color',
		array(
			'default' => get_option('farvis_default_additional_color'),
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'farvis_style_settings_additional_color',
			array(
				'label' => esc_html__( 'Additional Color', 'farvis' ),
				'section' => 'farvis_style_settings',
				'settings' => 'farvis_style_settings_additional_color',
				'priority'   => 20
			)
		)
	);

	$wp_customize->add_setting(
		'farvis_style_settings_bg_color',
		array(
			'default' => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'farvis_style_settings_bg_color',
			array(
				'label' => esc_html__( 'Background Color', 'farvis' ),
				'section' => 'farvis_style_settings',
				'settings' => 'farvis_style_settings_bg_color',
				'priority'   => 30
			)
		)
	);
	
	



	/// FONT SETTINGS ///

	$wp_customize->add_section( 'farvis_style_font_settings' , array(
		'title'      => esc_html__( 'Fonts', 'farvis' ),
		'priority'   => 30,
		'panel' => 'farvis_style_panel',
	) );


    $wp_customize->add_setting( 'farvis_font_api' , array(
        'default'     => 'AIzaSyAAChcJ6xYHmHRRTRMvt9GLCXeQG1qasV4',
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );
    $wp_customize->add_control(
        'farvis_font_api',
        array(
            'label' => esc_html__( 'Google Font Api Key', 'farvis' ),
            'type' => 'text',
            'section' => 'farvis_style_font_settings',
            'settings' => 'farvis_font_api',
            'priority'   => 10
        )
    );
	
	$wp_customize->add_setting( 'farvis_font' , array(
		'default'     => get_option('farvis_default_font'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_attr'
	) );
    $wp_customize->add_control(
        new farvis_Google_Fonts_Control(
			$wp_customize,
			'farvis_font',
			array(
				'label' => esc_html__( 'Font', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_font',
				'priority'   => 20
			)
		)
	);

	$wp_customize->add_setting( 'farvis_font_weights' , array(
		'default'     => get_option('farvis_default_font_weights'),
		'transport'   => 'postMessage',
		'sanitize_callback' => 'esc_attr'
	) );
    $wp_customize->add_control(
        new farvis_Google_Font_Weight_Control(
			$wp_customize,
			'farvis_font_weights',
			array(
				'label' => esc_html__( 'Font Variants to Load', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_font_weights',
				'hidden_class' => 'font_value',
				'container_class' => 'font',
				'priority'   => 30
			)
		)
	);

	$wp_customize->add_setting( 'farvis_font_weight' , array(
		'default'     => get_option('farvis_default_font_weight'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );
    $wp_customize->add_control(
        new farvis_Google_Font_Weight_Single_Control(
			$wp_customize,
			'farvis_font_weight',
			array(
			    'label' => esc_html__( 'Font Weight', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_font_weight',
				'container_class' => 'font',
				'priority'   => 40
			)
        )
	);


	$wp_customize->add_setting( 'farvis_title_font' , array(
		'default'     => get_option('farvis_default_title'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );
    $wp_customize->add_control(
        new farvis_Google_Fonts_Control(
			$wp_customize,
			'farvis_title_font',
			array(
				'label' => esc_html__( 'Title Font', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_title_font',
				'priority'   => 50
			)
		)
	);

	$wp_customize->add_setting( 'farvis_title_font_weights' , array(
		'default'     => get_option('farvis_default_title_weights'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );
    $wp_customize->add_control(
        new farvis_Google_Font_Weight_Control(
			$wp_customize,
			'farvis_title_font_weights',
			array(
				'label' => esc_html__( 'Title Font Variants to Load', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_title_font_weights',
				'hidden_class' => 'title_font_value',
				'container_class' => 'title_font',
				'priority'   => 60
			)
		)
	);

	$wp_customize->add_setting( 'farvis_title_font_weight' , array(
		'default'     => get_option('farvis_default_title_weight'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );
    $wp_customize->add_control(
        new farvis_Google_Font_Weight_Single_Control(
			$wp_customize,
			'farvis_title_font_weight',
			array(
			    'label' => esc_html__( 'Title Font Weight', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_title_font_weight',
				'container_class' => 'title_font',
				'priority'   => 70
			)
        )
	);


	$wp_customize->add_setting( 'farvis_subtitle_font' , array(
		'default'     => get_option('farvis_default_subtitle'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );
    $wp_customize->add_control(
        new farvis_Google_Fonts_Control(
			$wp_customize,
			'farvis_subtitle_font',
			array(
				'label' => esc_html__( 'Subtitle Font', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_subtitle_font',
				'priority'   => 80
			)
		)
	);

	$wp_customize->add_setting( 'farvis_subtitle_font_weights' , array(
		'default'     => get_option('farvis_default_subtitle_weights'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );
    $wp_customize->add_control(
        new farvis_Google_Font_Weight_Control(
			$wp_customize,
			'farvis_subtitle_font_weights',
			array(
				'label' => esc_html__( 'Subtitle Font Variants to Load', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_subtitle_font_weights',
				'hidden_class' => 'subtitle_font_value',
				'container_class' => 'subtitle_font',
				'priority'   => 90
			)
		)
	);

	$wp_customize->add_setting( 'farvis_subtitle_font_weight' , array(
		'default'     => get_option('farvis_default_subtitle_weight'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );
    $wp_customize->add_control(
        new farvis_Google_Font_Weight_Single_Control(
			$wp_customize,
			'farvis_subtitle_font_weight',
			array(
			    'label' => esc_html__( 'Subtitle Font Weight', 'farvis' ),
				'section' => 'farvis_style_font_settings',
				'settings' => 'farvis_subtitle_font_weight',
				'container_class' => 'subtitle_font',
				'priority'   => 100
			)
        )
	);


	
	$wp_customize->add_section( 'farvis_minify_settings' , array(
	    'title'      => esc_html__( 'Minify Style and Scripts', 'farvis' ),
	    'priority'   => 10,
		'panel' => 'farvis_style_panel'
	) );
	 
	$wp_customize->add_setting( 'farvis_minify_styles_scripts' , array(
	    'default'     => 'no',
	    'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control(
		'farvis_minify_styles_scripts',
		array(
			'label'    => esc_html__( 'Minify styles & scripts', 'farvis' ),
			'section'  => 'farvis_minify_settings',
			'settings' => 'farvis_minify_styles_scripts',
			'type'     => 'select',
			'choices'  => array(
				'no'  => esc_html__( 'No', 'farvis' ),
				'yes' => esc_html__( 'Yes', 'farvis' ),
			),
			'priority'   => 110
		)
	);
    
  



}

