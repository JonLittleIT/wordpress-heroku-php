<?php

function farvis_customize_portfolio_tab($wp_customize, $theme_name) {

	$wp_customize->add_panel('farvis_portfolio_settings',
	array(
		'title' => esc_html__( 'Portfolio', 'farvis' ),
		'priority' => 55,
		)
	);

	// portfolio general settings
	$wp_customize->add_section( 'farvis_portfolio_general_settings' , array(
		'title'      => esc_html__( 'Portfolio General', 'farvis' ),
		'priority'   => 10,
		'panel' => 'farvis_portfolio_settings'
	) );

	$wp_customize->add_setting( 'farvis_portfolio_settings_thumb_width' , array(
		'default'     => '556',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_absinteger'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_thumb_width',
		array(
			'label'    => esc_html__( 'Portfolio Tumbnails Width (px)', 'farvis' ),
			'section'  => 'farvis_portfolio_general_settings',
			'settings' => 'farvis_portfolio_settings_thumb_width',
			'type'     => 'textfield',
			'description' => esc_html__( 'Default: 556px', 'farvis' ),
			'priority' => 10
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_thumb_height' , array(
		'default'     => '556',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_absinteger'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_thumb_height',
		array(
			'label'    => esc_html__( 'Portfolio Tumbnails Height (px)', 'farvis' ),
			'section'  => 'farvis_portfolio_general_settings',
			'settings' => 'farvis_portfolio_settings_thumb_height',
			'type'     => 'textfield',
			'description' => esc_html__( 'Default: 556px', 'farvis' ),
			'priority' => 20
		)
	);


	// portfolio categories page settings
	$wp_customize->add_section( 'farvis_portfolio_categories_settings' , array(
		'title'      => esc_html__( 'Portfolio Category and Archive Pages', 'farvis' ),
		'priority'   => 20,
		'panel' => 'farvis_portfolio_settings'
	) );

	$wp_customize->add_setting( 'farvis_portfolio_settings_type' , array(
		'default'     => 'type_without_icons',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_portfolio_type'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_type',
		array(
			'label'    => esc_html__( 'Item type', 'farvis' ),
			'section'  => 'farvis_portfolio_categories_settings',
			'settings' => 'farvis_portfolio_settings_type',
			'description' => esc_html__( 'Portfolio items per row for portfolio category and archive pages.', 'farvis' ),
			'type'     => 'select',
			'choices'  => array(
				'type_without_icons' => esc_html__( 'Without over icons with space', 'farvis' ),
				'type_without_space' => esc_html__( 'Without over icons and space', 'farvis' ),
				'type_with_icons' => esc_html__( 'With over icons', 'farvis' ),
			),
			'priority' => 10
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_perrow' , array(
		'default'     => '2',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_portfolio_perrow'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_perrow',
		array(
			'label'    => esc_html__( 'Portfolio Column Number', 'farvis' ),
			'section'  => 'farvis_portfolio_categories_settings',
			'settings' => 'farvis_portfolio_settings_perrow',
			'description' => esc_html__( 'Portfolio items per row for portfolio category and archive pages.', 'farvis' ),
			'type'     => 'select',
			'choices'  => array(
				'2' => esc_html__( '2 columns', 'farvis' ),
				'3' => esc_html__( '3 columns', 'farvis' ),
				'4' => esc_html__( '4 columns', 'farvis' ),
			),
			'priority' => 20
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_perpage' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_per_page'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_perpage',
		array(
			'label'    => esc_html__( 'Portfolio Item per page', 'farvis' ),
			'section'  => 'farvis_portfolio_categories_settings',
			'settings' => 'farvis_portfolio_settings_perpage',
			'description' => esc_html__( 'Portfolio items per page for portfolio category and archive pages. Leave empty to show all items.', 'farvis' ),
			'type'     => 'textfield',
			'priority' => 30
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_sidebar_type' , array(
		'default'     => '2',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_sidebar_portfolio_type'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_sidebar_type',
		array(
			'label'    => esc_html__( 'Portfolio sidebar type', 'farvis' ),
			'section'  => 'farvis_portfolio_categories_settings',
			'settings' => 'farvis_portfolio_settings_sidebar_type',
			'description' => esc_html__( 'Select sidebar type for portfolio category and archive pages.', 'farvis' ),
			'type'     => 'select',
			'choices'  => array(
				'1' => esc_html__( 'Full width', 'farvis' ),
				'2' => esc_html__( 'Right Sidebar', 'farvis' ),
				'3' => esc_html__( 'Left Sidebar', 'farvis' ),
			),
			'priority' => 40
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_sidebar_content' , array(
		'default'     => 'sidebar-1',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_sidebar_portfolio_content'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_sidebar_content',
		array(
			'label'    => esc_html__( 'Portfolio sidebar content', 'farvis' ),
			'section'  => 'farvis_portfolio_categories_settings',
			'settings' => 'farvis_portfolio_settings_sidebar_content',
			'description' => esc_html__( 'Select sidebar content for portfolio category and archive pages.', 'farvis' ),
			'type'     => 'select',
			'choices'  => array(
				'sidebar-1' => esc_html__( 'WP Default Sidebar', 'farvis' ),
				'global-sidebar-1' => esc_html__( 'Blog Sidebar', 'farvis' ),
				'portfolio-sidebar-1' => esc_html__( 'Portfolio Sidebar', 'farvis' ),
				'custom-area-1' => esc_html__( 'Custom Area', 'farvis' ),
			),
			'priority' => 50
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_loadmore' , array(
		'default'     => esc_html__('Load more', 'farvis' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_loadmore',
		array(
			'label'    => esc_html__( 'Load More button text', 'farvis' ),
			'section'  => 'farvis_portfolio_categories_settings',
			'settings' => 'farvis_portfolio_settings_loadmore',
			'type'     => 'textfield',
			'priority' => 60
		)
	);


	// portfolio single page settings
	$wp_customize->add_section( 'farvis_portfolio_single_settings' , array(
		'title'      => esc_html__( 'Portfolio Single Page', 'farvis' ),
		'priority'   => 30,
		'panel' => 'farvis_portfolio_settings'
	) );

	$wp_customize->add_setting( 'farvis_portfolio_settings_related_show' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_related_show',
		array(
			'label'    => esc_html__( 'Show block Related projects', 'farvis' ),
			'section'  => 'farvis_portfolio_single_settings',
			'settings' => 'farvis_portfolio_settings_related_show',
			'description' => esc_html__( 'Select on/off Related projects for portfolio single pages.', 'farvis' ),
			'type'     => 'select',
			'choices'  => array(
				'on' => esc_html__( 'On', 'farvis' ),
				'off' => esc_html__( 'Off', 'farvis' ),
			),
			'priority' => 10
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_related_title' , array(
		'default'     => esc_html__('Related projects', 'farvis' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_related_title',
		array(
			'label'    => esc_html__( 'Title block Related Projects', 'farvis' ),
			'section'  => 'farvis_portfolio_single_settings',
			'settings' => 'farvis_portfolio_settings_related_title',
			'type'     => 'textfield',
			'priority' => 20
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_related_desc' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_text'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_related_desc',
		array(
			'label'    => esc_html__( 'Description block Related Projects', 'farvis' ),
			'section'  => 'farvis_portfolio_single_settings',
			'settings' => 'farvis_portfolio_settings_related_desc',
			'type'     => 'textarea',
			'priority' => 30
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_share' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'farvis_sanitize_onoff'
	) );

	$wp_customize->add_control(
		'farvis_portfolio_settings_share',
		array(
			'label'    => esc_html__( 'Show share', 'farvis' ),
			'section'  => 'farvis_portfolio_single_settings',
			'settings' => 'farvis_portfolio_settings_share',
			'description' => esc_html__( 'Select on/off share for portfolio single pages.', 'farvis' ),
			'type'     => 'select',
			'choices'  => array(
				'on' => esc_html__( 'On', 'farvis' ),
				'off' => esc_html__( 'Off', 'farvis' ),
			),
			'priority' => 40
		)
	);

	$wp_customize->add_setting( 'farvis_portfolio_settings_link_to_all' , array(
		'default'     => '0',
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url'
	) );
	$wp_customize->add_control( 'farvis_portfolio_settings_page', array(
		'label'    => esc_html__( 'Select Page For All Works', 'farvis' ),
		'section'  => 'farvis_portfolio_single_settings',
		'settings' => 'farvis_portfolio_settings_link_to_all',
		'type'     => 'dropdown-pages',
		'priority' => 50
	) );


}