<?php

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_attr__( 'Theme Panel', 'porfoliowp' ),
        'page_title'           => esc_attr__( 'Theme Panel', 'porfoliowp' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'porfoliowp_redux',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'href'  => esc_url('http://modeltheme.ticksy.com/'),
        'title' => esc_attr__( 'Theme Support', 'porfoliowp'),
    );
    $args['admin_bar_links'][] = array(
        'href'  => esc_url('http://themeforest.net/downloads'),
        'title' => esc_attr__( 'Rate this theme', 'porfoliowp'),
    );
    $args['admin_bar_links'][] = array(
        'href'  => esc_url('http://modeltheme.com'),
        'title' => esc_attr__( 'ModelTheme.com', 'porfoliowp'),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => esc_url('https://www.facebook.com/modeltheme'),
        'title' => esc_attr__('Like us on Facebook', 'porfoliowp'),
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('http://twitter.com/modeltheme'),
        'title' => esc_attr__('Follow us on Twitter', 'porfoliowp'),
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('http://modeltheme.ticksy.com/'),
        'title' => esc_attr__('Submit a Ticket', 'porfoliowp'),
        'icon'  => 'el el-cog'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('http://modeltheme.com/'),
        'title' => esc_attr__('ModelTheme Website', 'porfoliowp'),
        'icon'  => 'el el-globe'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( esc_attr__( '', 'porfoliowp' ), $v );
    } else {
        $args['intro_text'] = esc_attr__( '', 'porfoliowp' );
    }

    // Add content after the form.
    $args['footer_text'] = esc_attr__( '', 'porfoliowp' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_attr__( 'Theme Information 1', 'porfoliowp' ),
            'content' => esc_attr__( 'This is the tab content, HTML is allowed.', 'porfoliowp' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_attr__( 'Theme Information 2', 'porfoliowp' ),
            'content' => esc_attr__( 'This is the tab content, HTML is allowed.', 'porfoliowp' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_attr__( 'This is the sidebar content, HTML is allowed.', 'porfoliowp' );
    Redux::setHelpSidebar( $opt_name, $content );
    /*
     * <--- END HELP TABS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */


    include_once(get_template_directory() . '/redux-framework/modeltheme-config.arrays.php');
    /**
    ||-> SECTION: General Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'General Settings', 'porfoliowp' ),
        'id'    => 'mt_general',
        'icon'  => 'el el-icon-wrench'
    ));
    // GENERAL SETTINGS
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'General Settings', 'porfoliowp' ),
        'id'         => 'mt_general_settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_breadcrumbs',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Breadcrumbs</h3>' )
            ),
            array(
                'id'       => 'mt_enable_breadcrumbs',
                'type'     => 'switch', 
                'title'    => esc_attr__('Breadcrumbs', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or disable breadcrumbs', 'porfoliowp'),
                'default'  => false,
            ),
            array(
                'id'       => 'mt_breadcrumbs_delimitator',
                'type'     => 'text',
                'title'    => esc_attr__('Breadcrumbs delimitator', 'porfoliowp'),
                'subtitle' => esc_attr__('This is a little space under the Field Title in the Options table, additional info is good in here.', 'porfoliowp'),
                'desc'     => esc_attr__('This is the description field, again good for additional info.', 'porfoliowp'),
                'default'  => '/'
            ),
            array(
                'id'   => 'mt_divider_custom_css',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Custom CSS Code</h3>' )
            ),
            array(
                'id' => 'mt_custom_css',
                'type' => 'ace_editor',
                'title' => esc_attr__('CSS Code', 'porfoliowp'),
                'subtitle' => esc_attr__('Paste your CSS code here.', 'porfoliowp'),
                'mode' => 'css',
                'theme' => 'monokai',
                'default' => ""
            )
        ),
    ));
    // Back to Top
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Back to Top Button', 'porfoliowp' ),
        'id'         => 'mt_general_back_to_top',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'mt_backtotop_status',
                'type'     => 'switch', 
                'title'    => esc_attr__('Back to Top Button Status', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or disable "Back to Top Button"', 'porfoliowp'),
                'default'  => true,
            ),
            array(         
                'id'       => 'mt_backtotop_bg_color',
                'type'     => 'background',
                'title'    => esc_attr__('Back to Top Button Status Backgrond', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: transparent', 'porfoliowp'),
                'default'  => array(
                    'background-color' => 'transparent',
                    'background-repeat' => 'no-repeat',
                    'background-position' => 'center center',
                )
            ),

        ),
    ));
        // GENERAL SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Page Preloader', 'porfoliowp' ),
        'id' => 'mt_general_preloader',
        'subsection' => true,
        'fields' => array(
            array(
                'id'   => 'mt_divider_preloader_status',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Page Preloader Status</h3>' )
            ),
            array(
                'id'       => 'mt_preloader_status',
                'type'     => 'switch', 
                'title'    => esc_attr__('Enable Page Preloader', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or disable page preloader', 'porfoliowp'),
                'default'  => false,
            ),
            array(
                'id'   => 'mt_divider_preloader_styling',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Page Preloader Styling</h3>' )
            ),
            array(         
                'id'       => 'mt_preloader_bg_color',
                'type'     => 'background',
                'title'    => esc_attr__('Page Preloader Backgrond', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #7023FF', 'porfoliowp'),
                'default'  => array(
                    'background-color' => '#7023FF',
                ),
                'output' => array(
                    '.porfoliowp_preloader_holder'
                )
            ),
            array(
                'id'       => 'mt_preloader_color',
                'type'     => 'color',
                'title'    => esc_attr__('Preloader color:', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #ffffff', 'porfoliowp'),
                'default'  => '#ffffff',
                'validate' => 'color',
            ),
            array(
                'id'   => 'mt_divider_preloader_animation',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Page Preloader Variant</h3>' )
            ),
            array(
                'id'       => 'mt_preloader_animation',
                'type'     => 'radio',
                'title'    => esc_attr__('Preloader Animation', 'porfoliowp'), 
                'subtitle' => esc_attr__('Select Preloader Animation', 'porfoliowp'),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'v1_ball_triangle' => '<div class="porfoliowp_preloader v1_ball_triangle">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-triangle-path">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>', 

                    'v2_ball_pulse' => '<div class="porfoliowp_preloader v2_ball_pulse">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner ball-pulse">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v3_ball_grid_pulse' => '<div class="porfoliowp_preloader v3_ball_grid_pulse">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-grid-pulse">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v4_ball_clip_rotate' => '<div class="porfoliowp_preloader v4_ball_clip_rotate">
                                                    <div class="loaders">
                                                        <div class="loader">
                                                            <div class="loader-inner ball-clip-rotate">
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>',

                    'v5_ball_clip_rotate_pulse' => '<div class="porfoliowp_preloader v5_ball_clip_rotate_pulse">
                                                        <div class="loaders">
                                                            <div class="loader">
                                                                <div class="loader-inner ball-clip-rotate-pulse">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>',

                    'v6_square_spin' => '<div class="porfoliowp_preloader v6_square_spin">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner square-spin">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v7_ball_clip_rotate_multiple' => '<div class="porfoliowp_preloader v7_ball_clip_rotate_multiple">
                                                            <div class="loaders">
                                                                <div class="loader">
                                                                    <div class="loader-inner ball-clip-rotate-multiple">
                                                                        <div></div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>',

                    'v8_ball_pulse_rise' => '<div class="porfoliowp_preloader v8_ball_pulse_rise">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-pulse-rise">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v9_ball_rotate' => '<div class="porfoliowp_preloader v9_ball_rotate">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner ball-rotate">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v10_cube_transition' => '<div class="porfoliowp_preloader v10_cube_transition">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner cube-transition">
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v11_ball_zig_zag' => '<div class="porfoliowp_preloader v11_ball_zig_zag">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-zig-zag">
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v12_ball_zig_zag_deflect' => '<div class="porfoliowp_preloader v12_ball_zig_zag_deflect">
                                                        <div class="loaders">
                                                            <div class="loader">
                                                                <div class="loader-inner ball-zig-zag-deflect">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>',

                    'v13_ball_scale' => '<div class="porfoliowp_preloader v13_ball_scale">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner ball-scale">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v14_line_scale' => '<div class="porfoliowp_preloader v14_line_scale">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner line-scale">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v15_line_scale_party' => '<div class="porfoliowp_preloader v15_line_scale_party">
                                                    <div class="loaders">
                                                        <div class="loader">
                                                            <div class="loader-inner line-scale-party">
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>',

                    'v16_ball_scale_multiple' => '<div class="porfoliowp_preloader v16_ball_scale_multiple">
                                                    <div class="loaders">
                                                        <div class="loader">
                                                            <div class="loader-inner ball-scale-multiple">
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>',

                    'v17_ball_pulse_sync' => '<div class="porfoliowp_preloader v17_ball_pulse_sync">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="loader-inner ball-pulse-sync">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>',

                    'v18_ball_beat' => '<div class="porfoliowp_preloader v18_ball_beat">
                                            <div class="loaders">
                                                <div class="loader">
                                                    <div class="loader-inner ball-beat">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>',

                    'v19_line_scale_pulse_out' => '<div class="porfoliowp_preloader v19_line_scale_pulse_out">
                                                        <div class="loaders">
                                                            <div class="loader">
                                                                <div class="loader-inner line-scale-pulse-out">
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>',

                    'v20_line_scale_pulse_out_rapid' => '<div class="porfoliowp_preloader v20_line_scale_pulse_out_rapid">
                                                            <div class="loaders">
                                                                <div class="loader">
                                                                    <div class="loader-inner line-scale-pulse-out-rapid">
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>'


                ),
                'default' => 'v19_line_scale_pulse_out'
            )
        ),
    ));
    // SIDEBARS
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Sidebars', 'porfoliowp' ),
        'id'         => 'mt_general_sidebars',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_sidebars',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Generate Infinite Number of Sidebars</h3>' )
            ),
            array(
                'id'       => 'mt_dynamic_sidebars',
                'type'     => 'multi_text',
                'title'    => esc_attr__( 'Sidebars', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Use the "Add More" button to create unlimited sidebars.', 'porfoliowp' ),
                'add_text' => esc_attr__( 'Add one more Sidebar', 'porfoliowp' )
            )
        ),
    ));
    

    /**
    ||-> SECTION: Styling Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Styling Settings', 'porfoliowp' ),
        'id'    => 'mt_styling',
        'icon'  => 'el el-icon-magic'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Global Fonts', 'porfoliowp' ),
        'id'         => 'mt_styling_global_fonts',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_googlefonts',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Import Infinite Google Fonts</h3>')
            ),
            array(
                'id'       => 'mt_google_fonts_select',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_attr__('Import Google Font Globally', 'porfoliowp'), 
                'subtitle' => esc_attr__('Select one or multiple fonts', 'porfoliowp'),
                'desc'     => esc_attr__('Importing fonts made easy', 'porfoliowp'),
                'options'  => $google_fonts_list,
                'default'  => array(
                    'Montserrat:regular,700,latin'
                ),
            ),
        ),
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Skin color', 'porfoliowp' ),
        'id'         => 'mt_styling_skin_color',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_links',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Links Colors(Regular, Hover, Active/Visited)</h3>' )
            ),
            array(
                'id'       => 'mt_global_link_styling',
                'type'     => 'link_color',
                'title'    => esc_attr__('Links Color Option', 'porfoliowp'),
                'subtitle' => esc_attr__('Only color validation can be done on this field type(Default Regular: #7023FF; Default Hover: #5c05ff; Default Active: #5c05ff;)', 'porfoliowp'),
                'default'  => array(
                    'regular'  => '#7023FF', // blue
                    'hover'    => '#5c05ff', // blue-x3
                    'active'   => '#5c05ff',  // blue-x3
                    'visited'  => '#5c05ff',  // blue-x3
                )
            ),
            array(
                'id'   => 'mt_divider_main_colors',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Main Colors & Backgrounds</h3>' )
            ),
            array(
                'id'       => 'mt_style_main_texts_color',
                'type'     => 'color',
                'title'    => esc_attr__('Main texts color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #7023FF', 'porfoliowp'),
                'default'  => '#7023FF',
                'validate' => 'color',
            ),
            array(
                'id'       => 'mt_style_main_backgrounds_color',
                'type'     => 'color',
                'title'    => esc_attr__('Main backgrounds color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #7023FF', 'porfoliowp'),
                'default'  => '#7023FF',
                'validate' => 'color',
            ),
            array(
                'id'       => 'mt_style_main_backgrounds_color_hover',
                'type'     => 'color',
                'title'    => esc_attr__('Main backgrounds color (hover)', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #252525', 'porfoliowp'),
                'default'  => '#252525',
                'validate' => 'color',
            ),
            array(
                'id'       => 'mt_style_semi_opacity_backgrounds',
                'type'     => 'color_rgba',
                'title'    => esc_attr__( 'Semitransparent blocks background', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Default: rgba(14, 26, 33, 0.95)', 'porfoliowp' ),
                'default'  => array(
                    'color' => '#252525',
                    'alpha' => '.95'
                ),
                'output' => array(
                    'background-color' => '.fixed-sidebar-menu',
                ),
                'mode'     => 'background'
            ),
            array(
                'id'   => 'mt_divider_text_selection',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Text Selection Color & Background</h3>' )
            ),
            array(
                'id'       => 'mt_text_selection_color',
                'type'     => 'color',
                'title'    => esc_attr__('Text selection color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #ffffff', 'porfoliowp'),
                'default'  => '#ffffff',
                'validate' => 'color',
            ),
            array(
                'id'       => 'mt_text_selection_background_color',
                'type'     => 'color',
                'title'    => esc_attr__('Text selection background color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #7023FF', 'porfoliowp'),
                'default'  => '#7023FF',
                'validate' => 'color',
            )
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Nav Menu', 'porfoliowp' ),
        'id'         => 'mt_styling_nav_menu',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_nav_menu',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Menus Styling</h3>' )
            ),
            array(
                'id'       => 'mt_nav_menu_color',
                'type'     => 'color',
                'title'    => esc_attr__('Nav Menu Text Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #ffffff', 'porfoliowp'),
                'default'  => '#ffffff',
                'validate' => 'color',
                'output' => array(
                    'color' => '#navbar .menu-item > a,
                                .navbar-nav .search_products a,
                                .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus,
                                .navbar-default .navbar-nav > li > a',
                )
            ),
            array(
                'id'       => 'mt_nav_menu_hover_color',
                'type'     => 'color',
                'title'    => esc_attr__('Nav Menu Hover Text Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #7023FF', 'porfoliowp'),
                'default'  => '#7023FF',
                'validate' => 'color',
                'output' => array(
                    'color' => '#navbar .menu-item.selected > a, #navbar .menu-item:hover > a',
                )
            ),
            array(
                'id'   => 'mt_divider_nav_submenu',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Submenus Styling</h3>' )
            ),
            array(
                'id'       => 'mt_nav_submenu_background',
                'type'     => 'color',
                'title'    => esc_attr__('Nav Submenu Background Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: transparent', 'porfoliowp'),
                'default'  => 'transparent',
                'validate' => 'color',
                'output' => array(
                    'background-color' => '#navbar .sub-menu, .navbar ul li ul.sub-menu',
                )
            ),
            array(
                'id'       => 'mt_nav_submenu_color',
                'type'     => 'color',
                'title'    => esc_attr__('Nav Submenu Text Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #ffffff', 'porfoliowp'),
                'default'  => '#ffffff',
                'validate' => 'color',
                'output' => array(
                    'color' => '#navbar ul.sub-menu li a',
                )
            ),
            array(
                'id'       => 'mt_nav_submenu_hover_background_color',
                'type'     => 'color',
                'title'    => esc_attr__('Nav Submenu Hover Background Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: transparent', 'porfoliowp'),
                'default'  => 'transparent',
                'validate' => 'color',
                'output' => array(
                    'background-color' => '#navbar ul.sub-menu li a:hover',
                )
            ),
            array(
                'id'       => 'mt_nav_submenu_hover_text_color',
                'type'     => 'color',
                'title'    => esc_attr__('Nav Submenu Hover Background Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #7023FF', 'porfoliowp'),
                'default'  => '#7023FF',
                'validate' => 'color',
                'output' => array(
                    'color' => '#navbar ul.sub-menu li a:hover',
                )
            ),
        ),
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Typography', 'porfoliowp' ),
        'id'         => 'mt_styling_typography',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_4',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Body Font family</h3>' )
            ),
            array(
                'id'          => 'mt_body_typography',
                'type'        => 'typography', 
                'title'       => esc_attr__('Body Font family', 'porfoliowp'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => false,
                'line-height'  => false,
                'font-weight'  => false,
                'font-size'   => false,
                'font-style'  => false,
                'subsets'     => false,
                'output'      => array(
                    'body'
                ),
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Montserrat', 
                    'google'      => true
                ),
            ),
            array(
                'id'   => 'mt_divider_5',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Headings</h3>' )
            ),
            array(
                'id'          => 'mt_heading_h1',
                'type'        => 'typography', 
                'title'       => esc_attr__('Heading H1 Font family', 'porfoliowp'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'output'      => array('h1', 'h1 span'),
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Montserrat', 
                    'font-size' => '36px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h2',
                'type'        => 'typography', 
                'title'       => esc_attr__('Heading H2 Font family', 'porfoliowp'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'output'      => array('h2'),
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Montserrat', 
                    'font-size' => '30px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h3',
                'type'        => 'typography', 
                'title'       => esc_attr__('Heading H3 Font family', 'porfoliowp'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'output'      => array('h3'),
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Montserrat', 
                    'font-size' => '24px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h4',
                'type'        => 'typography', 
                'title'       => esc_attr__('Heading H4 Font family', 'porfoliowp'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'output'      => array('h4'),
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Montserrat', 
                    'font-size' => '18px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h5',
                'type'        => 'typography', 
                'title'       => esc_attr__('Heading H5 Font family', 'porfoliowp'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'output'      => array('h5'),
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Montserrat', 
                    'font-size' => '14px', 
                    'google'      => true
                ),
            ),
            array(
                'id'          => 'mt_heading_h6',
                'type'        => 'typography', 
                'title'       => esc_attr__('Heading H6 Font family', 'porfoliowp'),
                'google'      => true, 
                'font-backup' => true,
                'color'       => false,
                'text-align'  => false,
                'letter-spacing'  => true,
                'line-height'  => true,
                'font-weight'  => false,
                'font-size'   => true,
                'font-style'  => false,
                'subsets'     => false,
                'output'      => array('h6'),
                'units'       =>'px',
                'default'     => array(
                    'font-family' => 'Montserrat', 
                    'font-size' => '12px', 
                    'google'      => true
                ),
            ),
            array(
                'id'   => 'mt_divider_6',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Inputs & Textareas Font family</h3>' )
            ),
            array(
                'id'                => 'mt_inputs_typography',
                'type'              => 'typography', 
                'title'             => esc_attr__('Inputs Font family', 'porfoliowp'),
                'google'            => true, 
                'font-backup'       => true,
                'color'             => false,
                'text-align'        => false,
                'letter-spacing'    => false,
                'line-height'       => false,
                'font-weight'       => false,
                'font-size'         => false,
                'font-style'        => false,
                'subsets'           => false,
                'output'            => array('input', 'textarea'),
                'units'             =>'px',
                'subtitle'          => esc_attr__('Font family for inputs and textareas', 'porfoliowp'),
                'default'           => array(
                    'font-family'       => 'Montserrat', 
                    'google'            => true
                ),
            ),
            array(
                'id'   => 'mt_divider_7',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Buttons Font family</h3>' )
            ),
            array(
                'id'                => 'mt_buttons_typography',
                'type'              => 'typography', 
                'title'             => esc_attr__('Buttons Font family', 'porfoliowp'),
                'google'            => true, 
                'font-backup'       => true,
                'color'             => false,
                'text-align'        => false,
                'letter-spacing'    => false,
                'line-height'       => false,
                'font-weight'       => false,
                'font-size'         => false,
                'font-style'        => false,
                'subsets'           => false,
                'output'            => array(
                    'input[type="submit"]'
                ),
                'units'             =>'px',
                'subtitle'          => esc_attr__('Font family for buttons', 'porfoliowp'),
                'default'           => array(
                    'font-family'       => 'Montserrat', 
                    'google'            => true
                ),
            ),

        ),
    ));


    /**
    ||-> SECTION: Header Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Header Settings', 'porfoliowp' ),
        'id'    => 'mt_header',
        'icon'  => 'el el-icon-arrow-up'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Header - General', 'porfoliowp' ),
        'id'         => 'mt_header_general',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_generalheader',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Global Header Options</h3>' )
            ),
            array(
                'id'       => 'mt_header_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_attr__( 'Select Header layout', 'porfoliowp' ),
                'options'  => array(
                    'header1' => array(
                        'alt' => esc_attr__('Header #1', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/1.png'
                    ),
                    'header2' => array(
                        'alt' => esc_attr__('Header #2', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/2.png'
                    ),
                    'header5' => array(
                        'alt' => esc_attr__('Header #5', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/5.png'
                    ),
                    'header8' => array(
                        'alt' => esc_attr__('Header #8', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/8.png'
                    ),
                    'header9' => array(
                        'alt' => esc_attr__('Header #9', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/headers/9.png'
                    ),
                ),
                'default'  => 'header2'
            ),
            array(
                'id'       => 'mt_is_nav_sticky',
                'type'     => 'switch', 
                'title'    => esc_attr__('Sticky Navigation Menu?', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or disable "sticky positioned navigation menu".', 'porfoliowp'),
                'default'  => false,
                'on'       => esc_attr__( 'Enabled', 'porfoliowp' ),
                'off'      => esc_attr__( 'Disabled', 'porfoliowp' )
            ),
            array(
                'id'   => 'mt_divider_header_stat',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Search Icon Settings(from header)</h3>' )
            ),
            array(
                'id'       => 'mt_header_is_search',
                'type'     => 'switch', 
                'title'    => esc_attr__('Search Icon Status', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or Disable Search Icon".', 'porfoliowp'),
                'default'  => true,
                'on'       => esc_attr__( 'Enabled', 'porfoliowp' ),
                'off'      => esc_attr__( 'Disabled', 'porfoliowp' )
            ),
            array(
                'id'   => 'mt_divider_header_info_1',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => __( '<h3>Header Info First</h3>', 'porfoliowp' )
            ),
            array(
                'id'       => 'mt_divider_header_info_1_status',
                'type'     => 'switch',
                'title'    => esc_attr__( 'Header Info 1 Status', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Enable/Disable Header Info 1', 'porfoliowp' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_divider_header_info_1_media_type',
                'type'     => 'select',
                'title'    => esc_attr__( 'Media Type', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Choose to enter text or upload an image icon or select a font icon', 'porfoliowp' ),
                'options'  => array(
                    'font_awesome'      => esc_attr__( 'Font Icon', 'porfoliowp' ),
                    'media_image'       => esc_attr__( 'Media Image', 'porfoliowp' ),
                    'text_title'        => esc_attr__( 'Text Title', 'porfoliowp' )
                ),
                'default'  => 'text_title',
                'required' => array( 'mt_divider_header_info_1_status', '=', '1' ),
            ),
            array(
                'id'       => 'mt_divider_header_info_1_faicon',
                'type'     => 'select',
                'select2'  => array( 'containerCssClass' => 'fa' ),
                'title'    => esc_attr__('Icon for Header Info 1', 'porfoliowp'),
                'options'  => $icons,
                'default'  => 'fa fa-phone',
                'required' => array( 
                    array('mt_divider_header_info_1_status', '=', '1'), 
                    array('mt_divider_header_info_1_media_type','=','font_awesome') 
                ),
            ),
            array(
                'id' => 'mt_divider_header_info_1_image_icon',
                'type' => 'media',
                'url' => true,
                'title' => esc_attr__('Upload Image Icon', 'porfoliowp'),
                'compiler' => 'true',
                'required' => array( 
                    array('mt_divider_header_info_1_status', '=', '1'), 
                    array('mt_divider_header_info_1_media_type','=','media_image') 
                ),
                'default' => array('url' => esc_url(get_template_directory_uri().'/images/working_time1.png')),
            ),
            array(
                'id' => 'mt_divider_header_info_1_text_1',
                'type' => 'text',
                'title' => esc_attr__('Title for Header Info 1', 'porfoliowp'),
                'subtitle' => esc_attr__('Type title for Header Info 1', 'porfoliowp'),
                'default' => 'Call Us:',
                'required' => array( 
                    array('mt_divider_header_info_1_status', '=', '1'), 
                    array('mt_divider_header_info_1_media_type','=','text_title') 
                ), 
            ),
            array(
                'id' => 'mt_divider_header_info_1_heading1',
                'type' => 'text',
                'title' => esc_attr__('Header Info first - value', 'porfoliowp'),
                'subtitle' => esc_attr__('Type header info first value', 'porfoliowp'),
                'default' => '(+04) 743 323 424',
                'required' => array( 'mt_divider_header_info_1_status', '=', '1' ),
            ),
            array(
                'id'   => 'mt_divider_header_info_2',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => __( '<h3>Header Info Second</h3>', 'porfoliowp' )
            ),
            array(
                'id'       => 'mt_divider_header_info_2_status',
                'type'     => 'switch',
                'title'    => esc_attr__( 'Header Info 2 Status', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Enable/Disable Header Info 2', 'porfoliowp' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_divider_header_info_2_media_type',
                'type'     => 'select',
                'title'    => esc_attr__( 'Media Type', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Choose to enter text or upload an image icon or select a font icon', 'porfoliowp' ),
                'options'  => array(
                    'font_awesome'      => esc_attr__( 'Font Icon', 'porfoliowp' ),
                    'media_image'       => esc_attr__( 'Media Image', 'porfoliowp' ),
                    'text_title'        => esc_attr__( 'Text Title', 'porfoliowp' )
                ),
                'default'  => 'text_title',
                'required' => array( 'mt_divider_header_info_2_status', '=', '1' ),
            ),
            array(
                'id'       => 'mt_divider_header_info_2_faicon',
                'type'     => 'select',
                'select2'  => array( 'containerCssClass' => 'fa' ),
                'title'    => esc_attr__('Icon for Header Info 2', 'porfoliowp'),
                'options'  => $icons,
                'default'  => 'fa fa-envelope',
                'required' => array( 
                    array('mt_divider_header_info_2_status', '=', '1'), 
                    array('mt_divider_header_info_2_media_type','=','font_awesome') 
                ),
            ),
            array(
                'id' => 'mt_divider_header_info_2_image_icon',
                'type' => 'media',
                'url' => true,
                'title' => esc_attr__('Upload Image Icon', 'porfoliowp'),
                'compiler' => 'true',
                'required' => array( 
                    array('mt_divider_header_info_2_status', '=', '1'), 
                    array('mt_divider_header_info_2_media_type','=','media_image') 
                ),
                'default' => array('url' => esc_url(get_template_directory_uri().'/images/working_location1.png')),
            ),
            array(
                'id' => 'mt_divider_header_info_2_text_2',
                'type' => 'text',
                'title' => esc_attr__('Title for Header Info 2', 'porfoliowp'),
                'subtitle' => esc_attr__('Type title for Header Info 2', 'porfoliowp'),
                'default' => 'Address:',
                'required' => array( 
                    array('mt_divider_header_info_2_status', '=', '1'), 
                    array('mt_divider_header_info_2_media_type','=','text_title') 
                ), 
            ),
            array(
                'id' => 'mt_divider_header_info_2_heading1',
                'type' => 'text',
                'title' => esc_attr__('Header Info Second - Value', 'porfoliowp'),
                'subtitle' => esc_attr__('Type header info Second value', 'porfoliowp'),
                'default' => 'New Yok, Thomas Nolan 5322',
                'required' => array( 'mt_divider_header_info_2_status', '=', '1' ),
            ),
            array(
                'id'   => 'mt_divider_header_info_3',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Header Info Third</h3>')
            ),
            array(
                'id'       => 'mt_divider_header_info_3_status',
                'type'     => 'switch',
                'title'    => esc_attr__( 'Header Info 3 Status', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Enable/Disable Header Info 3', 'porfoliowp' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_divider_header_info_3_media_type',
                'type'     => 'select',
                'title'    => esc_attr__( 'Media Type', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Choose to enter text or upload an image icon or select a font icon', 'porfoliowp' ),
                'options'  => array(
                    'font_awesome'      => esc_attr__( 'Font Icon', 'porfoliowp' ),
                    'media_image'       => esc_attr__( 'Media Image', 'porfoliowp' ),
                    'text_title'        => esc_attr__( 'Text Title', 'porfoliowp' )
                ),
                'default'  => 'text_title',
                'required' => array( 'mt_divider_header_info_3_status', '=', '1' ),
            ),
            array(
                'id'       => 'mt_divider_header_info_3_faicon',
                'type'     => 'select',
                'select2'  => array( 'containerCssClass' => 'fa' ),
                'title'    => esc_attr__('Icon for Header Info 3', 'porfoliowp'),
                'options'  => $icons,
                'default'  => 'fa fa-clock-o',
                'required' => array( 
                    array('mt_divider_header_info_3_status', '=', '1'), 
                    array('mt_divider_header_info_3_media_type','=','font_awesome') 
                ),
            ),
            array(
                'id' => 'mt_divider_header_info_3_image_icon',
                'type' => 'media',
                'url' => true,
                'title' => esc_attr__('Upload Image Icon', 'porfoliowp'),
                'compiler' => 'true',
                'required' => array( 
                    array('mt_divider_header_info_3_status', '=', '1'), 
                    array('mt_divider_header_info_3_media_type','=','media_image') 
                ),
                'default' => array('url' => esc_url(get_template_directory_uri().'/images/working_phone.png')),
            ),
            array(
                'id' => 'mt_divider_header_info_3_text_3',
                'type' => 'text',
                'title' => esc_attr__('Title for Header Info 3', 'porfoliowp'),
                'subtitle' => esc_attr__('Type title for Header Info 3', 'porfoliowp'),
                'default' => 'Schedule:',
                'required' => array( 
                    array('mt_divider_header_info_3_status', '=', '1'), 
                    array('mt_divider_header_info_3_media_type','=','text_title') 
                ), 
            ),
            array(
                'id' => 'mt_divider_header_info_3_heading1',
                'type' => 'text',
                'title' => esc_attr__('Header Info Third - Value', 'porfoliowp'),
                'subtitle' => esc_attr__('Type header info Third value', 'porfoliowp'),
                'default' => 'Mon-Sat: 09:00 - 18:00',
                'required' => array( 'mt_divider_header_info_3_status', '=', '1' ),
            ),

        ),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Logo &amp; Favicon', 'porfoliowp' ),
        'id'         => 'mt_header_logo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_logo',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Logo Settings</h3>' )
            ),
            array(
                'id' => 'mt_logo',
                'type' => 'media',
                'url' => true,
                'title' => esc_attr__('Logo image', 'porfoliowp'),
                'compiler' => 'true',
                'default' => array('url' => get_template_directory_uri().'/images/logoporfolio.png'),
            ),
            array(
                'id'        => 'mt_logo_max_width',
                'type'      => 'slider',
                'title'     => esc_attr__('Logo Max Width', 'porfoliowp'),
                'subtitle'  => esc_attr__('Use the slider to increase/decrease max size of the logo.', 'porfoliowp'),
                'desc'      => esc_attr__('Min: 1px, max: 500px, step: 1px, default value: 220px', 'porfoliowp'),
                "default"   => 175,
                "min"       => 1,
                "step"      => 1,
                "max"       => 500,
                'display_value' => 'label'
            ),
            array(
                'id'   => 'mt_divider_favicon',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Favicon Settings</h3>' )
            ),
            array(
                'id' => 'mt_favicon',
                'type' => 'media',
                'url' => true,
                'title' => esc_attr__('Favicon url', 'porfoliowp'),
                'compiler' => 'true',
                'subtitle' => esc_attr__('Use the upload button to import media.', 'porfoliowp'),
                'default' => array('url' => get_template_directory_uri().'/images/faviconporfolio.png'),
            )
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Header - Main Big', 'porfoliowp' ),
        'id'         => 'mt_header_bottom_main',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_mainheader',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Main Header Options</h3>' )
            ),
            array(         
                'id'       => 'mt_header_main_background',
                'type'     => 'background',
                'title'    => esc_attr__('Header (main-header) - background', 'porfoliowp'),
                'subtitle' => esc_attr__('Default color: #ffffff', 'porfoliowp'),
                'output'      => array('.navbar-default'),
                'default'  => array(
                    'background-color' => '#ffffff',
                )
            ),
            array(
                'id'       => 'mt_header_main_text_color',
                'type'     => 'color',
                'title'    => esc_attr__('Main Header texts color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default color: #FFFFFF', 'porfoliowp'),
                'default'  => '#FFFFFF',
                'validate' => 'color',
                'output'    => array(
                    'color' => 'header',
                ),
            )
        ),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Fixed Sidebar Menu', 'porfoliowp' ),
        'id'         => 'mt_header_fixed_sidebar_menu',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_fixed_headerstatus',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Status</h3>' )
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_status',
                'type'     => 'switch',
                'title'    => esc_attr__( 'Burger Sidebar Menu Status', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Enable/Disable Burger Sidebar Menu Status', 'porfoliowp' ),
                'desc'     => esc_attr__( 'This Option Will Enable/Disable The Navigation Burger + Sidebar Menu triggered by the burger menu', 'porfoliowp' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),

            array(
                'id'   => 'mt_divider_fixed_header',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Other Options</h3>' )
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_bgs',
                'type'     => 'color_rgba',
                'title'    => esc_attr__( 'Sidebar Menu Background', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Default: rgba(37, 37, 37, 0.98) - #252525 - Opacity: 0.95', 'porfoliowp' ),
                'default'   => array(
                    'color'     => '#252525',
                    'alpha'     => '.95'
                ),
                'output' => array(
                    'background-color' => '.fixed-sidebar-menu'
                ),
                // These options display a fully functional color palette.  Omit this argument
                // for the minimal color picker, and change as desired.
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),                        
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_text_color',
                'type'     => 'color',
                'title'    => esc_attr__('Texts Color', 'porfoliowp'), 
                'default'  => '#000000',
                'validate' => 'color'
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar_menu_site_title_status',
                'type'     => 'button_set',
                'title'    => esc_attr__( 'Show Title or Logo', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Choose what to show on fixed sidebar', 'porfoliowp' ),
                'desc'     => esc_attr__( 'Choose Between Site Title or Site Logo', 'porfoliowp' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'site_title' => 'Title',
                    'site_logo' => 'Logo',
                    'site_nothing' => 'Disable This Feature'
                ),
                'default'  => 'site_title'
            ),
            array(
                'id'       => 'mt_header_fixed_sidebar',
                'type'     => 'select',
                'data'     => 'sidebars',
                'title'    => esc_attr__( 'Fixed Sidebar Menu - Sidebar', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Select Sidebar.', 'porfoliowp' ),
                'default'   => 'sidebar-1',
            ),

        ),
    ) );

    /**

    ||-> SECTION: Footer Settings
    
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Footer Settings', 'porfoliowp' ),
        'id'    => 'mt_footer',
        'icon'  => 'el el-icon-arrow-down'
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Footer Top Rows', 'porfoliowp' ),
        'id'         => 'mt_footer_top',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_footer_top',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Footer Top Rows</h3>' )
            ),
            array(         
                'id'       => 'mt_footer_top_background',
                'type'     => 'background',
                'title'    => esc_attr__('Footer (top) - background', 'porfoliowp'),
                'subtitle' => esc_attr__('Footer background with image or color.', 'porfoliowp'),
                'output'      => array('footer .footer-top'),
                'default'  => array(
                    'background-color' => '#252525',
                )
            ),
            array(
                'id'        => 'mt_footer_top_texts_color',
                'type'      => 'color_rgba',
                'title'     => esc_attr__( 'Footer Top Text Color', 'porfoliowp' ),
                'subtitle'  => esc_attr__( 'Set color and alpha channel', 'porfoliowp' ),
                'desc'      => esc_attr__( 'Set color and alpha channel for footer texts (Especially for widget titles)', 'porfoliowp' ),
                'output'    => array('color' => 'footer .footer-top h1.widget-title, footer .footer-top h3.widget-title, footer .footer-top .widget-title'),
                'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => 1
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),                        
            ),
            array(
                'id'   => 'mt_divider_footer_row1',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Footer Rows - Row #1</h3>' )
            ),
            array(
                'id'       => 'mt_footer_row_1',
                'type'     => 'switch',
                'title'    => esc_attr__( 'Footer Row #1 - Status', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Enable/Disable Footer ROW 1', 'porfoliowp' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_footer_row_1_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_attr__( 'Footer Row #1 - Layout', 'porfoliowp' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('Footer 1 Column', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_1.png'
                    ),
                    '2' => array(
                        'alt' => esc_attr__('Footer 2 Columns', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_2.png'
                    ),
                    '3' => array(
                        'alt' => esc_attr__('Footer 3 Columns', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_3.png'
                    ),
                    '4' => array(
                        'alt' => esc_attr__('Footer 4 Columns', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_4.png'
                    ),
                    '5' => array(
                        'alt' => esc_attr__('Footer 5 Columns', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_5.png'
                    ),
                    '6' => array(
                        'alt' => esc_attr__('Footer 6 Columns', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_6.png'
                    ),
                    'column_half_sub_half' => array(
                        'alt' => esc_attr__('Footer 6 + 3 + 3', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_half_sub_half.png'
                    ),
                    'column_sub_half_half' => array(
                        'alt' => esc_attr__('Footer 3 + 3 + 6', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_half_half.png'
                    ),
                    'column_sub_fourth_third' => array(
                        'alt' => esc_attr__('Footer 2 + 2 + 2 + 2 + 4', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_fourth_third.png'
                    ),
                    'column_third_sub_fourth' => array(
                        'alt' => esc_attr__('Footer 4 + 2 + 2 + 2 + 2', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_third_sub_fourth.png'
                    ),
                    'column_sub_third_half' => array(
                        'alt' => esc_attr__('Footer 2 + 2 + 2 + 6', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half.png'
                    ),
                    'column_half_sub_third' => array(
                        'alt' => esc_attr__('Footer 6 + 2 + 2 + 2', 'porfoliowp'),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half2.png'
                    ),
                ),
                'default'  => 'column_half_sub_third',
                'required' => array( 'mt_footer_row_1', '=', '1' ),
            ),
            array(
                'id'             => 'mt_footer_row_1_spacing',
                'type'           => 'spacing',
                'output'         => array('.footer-row-1'),
                'mode'           => 'padding',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_attr__('Footer Row #1 - Padding', 'porfoliowp'),
                'subtitle'       => esc_attr__('Choose the spacing for the first row from footer.', 'porfoliowp'),
                'required' => array( 'mt_footer_row_1', '=', '1' ),
                'default'            => array(
                    'padding-top'     => '90px', 
                    'padding-bottom'  => '90px', 
                    'units'          => 'px', 
                )
            ),
            array(
                'id'             => 'mt_footer_row_1margin',
                'type'           => 'spacing',
                'output'         => array('.footer-row-1'),
                'mode'           => 'margin',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_attr__('Footer Row #1 - Margin', 'porfoliowp'),
                'subtitle'       => esc_attr__('Choose the margin for the first row from footer.', 'porfoliowp'),
                'required' => array( 'mt_footer_row_1', '=', '1' ),
                'default'            => array(
                    'margin-top'     => '0px', 
                    'margin-bottom'  => '0px', 
                    'units'          => 'px', 
                )
            ),
            array( 
                'id'       => 'mt_footer_row_1border',
                'type'     => 'border',
                'title'    => esc_attr__('Footer Row #1 - Borders', 'porfoliowp'),
                'subtitle' => esc_attr__('Only color validation can be done on this field', 'porfoliowp'),
                'output'   => array('.footer-row-1'),
                'all'      => false,
                'required' => array( 'mt_footer_row_1', '=', '1' ),
                'default'  => array(
                    'border-color'  => '#515b5e', 
                    'border-style'  => 'solid', 
                    'border-top'    => '0', 
                    'border-right'  => '0', 
                    'border-bottom' => '0', 
                    'border-left'   => '0'
                )
            ),
            array(
                'id'   => 'mt_divider_footer_row2',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Footer Rows - Row #2</h3>' )
            ),
            array(
                'id'       => 'mt_footer_row_2',
                'type'     => 'switch',
                'title'    => esc_attr__( 'Footer Row #2 - Status', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Enable/Disable Footer ROW 2', 'porfoliowp' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_footer_row_2_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_attr__( 'Footer Row #1 - Layout', 'porfoliowp' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('Footer 1 Column', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_1.png'
                    ),
                    '2' => array(
                        'alt' => esc_attr__('Footer 2 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_2.png'
                    ),
                    '3' => array(
                        'alt' => esc_attr__('Footer 3 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_3.png'
                    ),
                    '4' => array(
                        'alt' => esc_attr__('Footer 4 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_4.png'
                    ),
                    '5' => array(
                        'alt' => esc_attr__('Footer 5 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_5.png'
                    ),
                    '6' => array(
                        'alt' => esc_attr__('Footer 6 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_6.png'
                    ),
                    'column_half_sub_half' => array(
                        'alt' => esc_attr__('Footer 6 + 3 + 3', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_half_sub_half.png'
                    ),
                    'column_sub_half_half' => array(
                        'alt' => esc_attr__('Footer 3 + 3 + 6', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_half_half.png'
                    ),
                    'column_sub_fourth_third' => array(
                        'alt' => esc_attr__('Footer 2 + 2 + 2 + 2 + 4', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_fourth_third.png'
                    ),
                    'column_third_sub_fourth' => array(
                        'alt' => esc_attr__('Footer 4 + 2 + 2 + 2 + 2', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_third_sub_fourth.png'
                    ),
                    'column_sub_third_half' => array(
                        'alt' => esc_attr__('Footer 2 + 2 + 2 + 6', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half.png'
                    ),
                    'column_half_sub_third' => array(
                        'alt' => esc_attr__('Footer 6 + 2 + 2 + 2', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half2.png'
                    ),

                ),
                'default'  => '4',
                'required' => array( 'mt_footer_row_2', '=', '1' ),
            ),
            array(
                'id'             => 'footer_row_2_spacing',
                'type'           => 'spacing',
                'output'         => array('.footer-row-2'),
                'mode'           => 'padding',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_attr__('Footer Row #2 - Padding', 'porfoliowp'),
                'subtitle'       => esc_attr__('Choose the spacing for the second row from footer.', 'porfoliowp'),
                'required' => array( 'mt_footer_row_2', '=', '1' ),
                'default'            => array(
                    'padding-top'     => '0px', 
                    'padding-bottom'  => '40px', 
                    'units'          => 'px', 
                )
            ),
            array(
                'id'             => 'mt_footer_row_2margin',
                'type'           => 'spacing',
                'output'         => array('.footer-row-2'),
                'mode'           => 'margin',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_attr__('Footer Row #2 - Margin', 'porfoliowp'),
                'subtitle'       => esc_attr__('Choose the margin for the first row from footer.', 'porfoliowp'),
                'required' => array( 'mt_footer_row_2', '=', '1' ),
                'default'            => array(
                    'margin-top'     => '0px', 
                    'margin-bottom'  => '40px', 
                    'units'          => 'px', 
                )
            ),
            array( 
                'id'       => 'mt_footer_row_2border',
                'type'     => 'border',
                'title'    => esc_attr__('Footer Row #2 - Borders', 'porfoliowp'),
                'subtitle' => esc_attr__('Only color validation can be done on this field', 'porfoliowp'),
                'output'   => array('.footer-row-2'),
                'all'      => false,
                'required' => array( 'mt_footer_row_2', '=', '1' ),
                'default'  => array(
                    'border-color'  => '#515b5e', 
                    'border-style'  => 'solid', 
                    'border-top'    => '0', 
                    'border-right'  => '0', 
                    'border-bottom' => '2', 
                    'border-left'   => '0'
                )
            ),
            array(
                'id'   => 'mt_divider_footer_row3',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Footer Rows - Row #3</h3>' )
            ),
            array(
                'id'       => 'mt_footer_row_3',
                'type'     => 'switch',
                'title'    => esc_attr__( 'Footer Row #3 - Status', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Enable/Disable Footer ROW 3', 'porfoliowp' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'mt_footer_row_3_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_attr__( 'Footer Row #3 - Layout', 'porfoliowp' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('Footer 1 Column', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_1.png'
                    ),
                    '2' => array(
                        'alt' => esc_attr__('Footer 2 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_2.png'
                    ),
                    '3' => array(
                        'alt' => esc_attr__('Footer 3 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_3.png'
                    ),
                    '4' => array(
                        'alt' => esc_attr__('Footer 4 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_4.png'
                    ),
                    '5' => array(
                        'alt' => esc_attr__('Footer 5 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_5.png'
                    ),
                    '6' => array(
                        'alt' => esc_attr__('Footer 6 Columns', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_6.png'
                    ),
                    'column_half_sub_half' => array(
                        'alt' => esc_attr__('Footer 6 + 3 + 3', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_half_sub_half.png'
                    ),
                    'column_sub_half_half' => array(
                        'alt' => esc_attr__('Footer 3 + 3 + 6', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_half_half.png'
                    ),
                    'column_sub_fourth_third' => array(
                        'alt' => esc_attr__('Footer 2 + 2 + 2 + 2 + 4', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_fourth_third.png'
                    ),
                    'column_third_sub_fourth' => array(
                        'alt' => esc_attr__('Footer 4 + 2 + 2 + 2 + 2', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_third_sub_fourth.png'
                    ),
                    'column_sub_third_half' => array(
                        'alt' => esc_attr__('Footer 2 + 2 + 2 + 6', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half.png'
                    ),
                    'column_half_sub_third' => array(
                        'alt' => esc_attr__('Footer 6 + 2 + 2 + 2', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/footer_columns/column_sub_third_half2.png'
                    ),

                ),
                'default'  => '4',
                'required' => array( 'mt_footer_row_3', '=', '1' ),
            ),
            array(
                'id'             => 'mt_footer_row_3_spacing',
                'type'           => 'spacing',
                'output'         => array('.footer-row-3'),
                'mode'           => 'padding',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_attr__('Footer Row #3 - Padding', 'porfoliowp'),
                'subtitle'       => esc_attr__('Choose the spacing for the third row from footer.', 'porfoliowp'),
                'required' => array( 'mt_footer_row_3', '=', '1' ),
                'default'            => array(
                    'padding-top'     => '0px', 
                    'padding-bottom'  => '40px', 
                    'units'          => 'px', 
                )
            ),
            array(
                'id'             => 'mt_footer_row_3margin',
                'type'           => 'spacing',
                'output'         => array('.footer-row-3'),
                'mode'           => 'margin',
                'units'          => array('em', 'px'),
                'units_extended' => 'false',
                'title'          => esc_attr__('Footer Row #3 - Margin', 'porfoliowp'),
                'subtitle'       => esc_attr__('Choose the margin for the first row from footer.', 'porfoliowp'),
                'required' => array( 'mt_footer_row_3', '=', '1' ),
                'default'            => array(
                    'margin-top'     => '0px', 
                    'margin-bottom'  => '20px', 
                    'units'          => 'px', 
                )
            ),
            array( 
                'id'       => 'mt_footer_row_3border',
                'type'     => 'border',
                'title'    => esc_attr__('Footer Row #3 - Borders', 'porfoliowp'),
                'subtitle' => esc_attr__('Only color validation can be done on this field', 'porfoliowp'),
                'output'   => array('.footer-row-3'),
                'all'      => false,
                'required' => array( 'mt_footer_row_3', '=', '1' ),
                'default'  => array(
                    'border-color'  => '#515b5e', 
                    'border-style'  => 'solid', 
                    'border-top'    => '0', 
                    'border-right'  => '0', 
                    'border-bottom' => '2', 
                    'border-left'   => '0'
                )
            )
        ),
    ));



    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Footer Bottom Bar', 'porfoliowp' ),
        'id'         => 'mt_footer_bottom',
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'mt_footer_text',
                'type' => 'editor',
                'title' => esc_attr__('Footer Text', 'porfoliowp'),
                'default' => 'Copyright 2019 by ModelTheme. All Rights Reserved.',
            ),
            array(         
                'id'       => 'mt_footer_bottom_background',
                'type'     => 'background',
                'title'    => esc_attr__('Footer (bottom) - background', 'porfoliowp'),
                'subtitle' => esc_attr__('Footer background with image or color.', 'porfoliowp'),
                'output'      => array('footer .footer'),
                'default'  => array(
                    'background-color' => '#F5F5F5',
                )
            ),
            array(
                'id'        => 'mt_footer_bottom_texts_color',
                'type'      => 'color_rgba',
                'title'     => esc_attr__( 'Footer Bottom Text Color', 'porfoliowp' ),
                'subtitle'  => esc_attr__( 'Set color and alpha channel', 'porfoliowp' ),
                'desc'      => esc_attr__( 'Set color and alpha channel for footer texts (Especially for widget titles)', 'porfoliowp' ),
                'output'    => array('color' => 'footer .social-links a i, footer p.copyright, footer .footer h1.widget-title, footer .footer h3.widget-title, footer .footer .widget-title'),
                'default'   => array(
                    'color'     => '#252525',
                    'alpha'     => 1
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),                        
            ),
        ),
    ));



    /**

    ||-> SECTION: Contact Settings
    
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Contact Settings', 'porfoliowp' ),
        'id'    => 'mt_contact',
        'icon'  => 'el el-icon-map-marker-alt'
    ));
    // GENERAL
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Contact', 'porfoliowp' ),
        'id'         => 'mt_contact_settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'mt_contact_phone',
                'type' => 'text',
                'title' => esc_attr__('Phone Number', 'porfoliowp'),
                'subtitle' => esc_attr__('Contact phone number displayed on the contact us page.', 'porfoliowp'),
                'default' => '(+40) 74 0920 2288'
            ),
            array(
                'id' => 'mt_contact_email',
                'type' => 'text',
                'title' => esc_attr__('Email', 'porfoliowp'),
                'subtitle' => esc_attr__('Contact email displayed on the contact us page., additional info is good in here.', 'porfoliowp'),
                'validate' => 'email',
                'msg' => 'custom error message',
                'default' => 'office@porfolio.com'
            ),
            array(
                'id' => 'mt_contact_address',
                'type' => 'text',
                'title' => esc_attr__('Address', 'porfoliowp'),
                'subtitle' => esc_attr__('Enter your contact address', 'porfoliowp'),
                'default' => 'New York 11673 Collins Street West Victoria United State.'
            )
        ),
    ));
    
    // MAILCHIMP
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Mailchimp', 'porfoliowp' ),
        'id'         => 'mt_contact_mailchimp',
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'mt_mailchimp_apikey',
                'type' => 'text',
                'title' => esc_attr__('Mailchimp apiKey', 'porfoliowp'),
                'subtitle' => esc_attr__('To enable Mailchimp please type in your apiKey', 'porfoliowp'),
                'default' => 'da1175811870557923759df1b4258d0a-us9'
            ),
            array(
                'id' => 'mt_mailchimp_listid',
                'type' => 'text',
                'title' => esc_attr__('Mailchimp listId', 'porfoliowp'),
                'subtitle' => esc_attr__('To enable Mailchimp please type in your listId', 'porfoliowp'),
                'default' => '7ffd6ecdde'
            ),
            array(
                'id' => 'mt_mailchimp_data_center',
                'type' => 'text',
                'title' => esc_attr__('Mailchimp form datacenter', 'porfoliowp'),
                'subtitle' => esc_attr__('To enable Mailchimp please type in your form datacenter', 'porfoliowp'),
                'default' => 'us9'
            )
        ),
    ));



    /**
    ||-> SECTION: Blog Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Blog Settings', 'porfoliowp' ),
        'id'    => 'mt_blog',
        'icon'  => 'el el-icon-comment'
    ));
    // SIDEBARS
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Blog Archive', 'porfoliowp' ),
        'id'         => 'mt_blog_archive',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_blog_layout',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Blog List Layout</h3>' )
            ),
            array(
                'id'       => 'mt_blog_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_attr__( 'Blog List Layout', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Select Blog List layout.', 'porfoliowp' ),
                'options'  => array(
                    'mt_blog_left_sidebar' => array(
                        'alt' => esc_attr__('2 Columns - Left sidebar', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                    ),
                    'mt_blog_fullwidth' => array(
                        'alt' => esc_attr__('1 Column - Full width', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                    ),
                    'mt_blog_right_sidebar' => array(
                        'alt' => esc_attr__('2 Columns - Right sidebar', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                    )
                ),
                'default'  => 'mt_blog_right_sidebar'
            ),
            array(
                'id'       => 'mt_blog_layout_sidebar',
                'type'     => 'select',
                'data'     => 'sidebars',
                'title'    => esc_attr__( 'Blog List Sidebar', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Select Blog List Sidebar.', 'porfoliowp' ),
                'default'   => 'sidebar-1',
                'required' => array('mt_blog_layout', '!=', 'mt_blog_fullwidth'),
            ),
            array(
                'id'        => 'mt_blog_display_type',
                'type'      => 'select',
                'title'     => esc_attr__('How to display posts', 'porfoliowp'),
                'subtitle'  => esc_attr__('Select how you want to display post on blog list.', 'porfoliowp'),
                'options'   => array(
                        'list'   => 'List',
                        'grid'   => 'Grid'
                    ),
                'default'   => 'list',
            ),

            array(
                'id'        => 'mt_blog_grid_columns',
                'type'      => 'select',
                'title'     => esc_attr__('Grid columns', 'porfoliowp'),
                'subtitle'  => esc_attr__('Select how many columns you want.', 'porfoliowp'),
                'options'   => array(
                        '2'   => '2',
                        '3'   => '3'
                    ),
                'default'   => '1',
                'required' => array('mt_blog_display_type', 'equals', 'grid'),
            ),
            array(
                'id'   => 'mt_divider_blog_elements',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Blog List Elements</h3>' )
            ),
            array(
                'id'       => 'mt_enable_sticky',
                'type'     => 'switch', 
                'title'    => esc_attr__('Sticky Posts', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or disable "sticky posts" section on blog page', 'porfoliowp'),
                'default'  => true,
            ),
            array(
                'id' => 'mt_sticky_post_title',
                'type' => 'text',
                'title' => esc_attr__('Sticky Post Title', 'porfoliowp'),
                'subtitle' => esc_attr__('Enter the text you want to display as sticky post title.', 'porfoliowp'),
                'default' => 'Sticky Posts'
            ),
            array(
                'id' => 'mt_blog_post_title',
                'type' => 'text',
                'title' => esc_attr__('Blog Post Title', 'porfoliowp'),
                'subtitle' => esc_attr__('Enter the text you want to display as blog post title.', 'porfoliowp'),
                'default' => 'All Blog Posts'
            )
        ),
    ));

    // SIDEBARS
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Single Post', 'porfoliowp' ),
        'id'         => 'mt_blog_single_pos',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_single_blog_layout',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Single Blog List Layout</h3>' )
            ),
            array(
                'id'       => 'mt_single_blog_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => esc_attr__( 'Single Blog List Layout', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Select Blog List layout.', 'porfoliowp' ),
                'options'  => array(
                    'mt_single_blog_left_sidebar' => array(
                        'alt' => esc_attr__('2 Columns - Left sidebar', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                    ),
                    'mt_single_blog_fullwidth' => array(
                        'alt' => esc_attr__('1 Column - Full width', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                    ),
                    'mt_single_blog_right_sidebar' => array(
                        'alt' => esc_attr__('2 Columns - Right sidebar', 'porfoliowp' ),
                        'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                    )
                ),
                'default'  => 'mt_single_blog_right_sidebar'
            ),
            array(
                'id'       => 'mt_single_blog_layout_sidebar',
                'type'     => 'select',
                'data'     => 'sidebars',
                'title'    => esc_attr__( 'Single Blog List Sidebar', 'porfoliowp' ),
                'subtitle' => esc_attr__( 'Select Blog List Sidebar.', 'porfoliowp' ),
                'default'   => 'sidebar-1',
                'required' => array('mt_single_blog_layout', '!=', 'mt_single_blog_fullwidth'),
            ),
            array(
                'id'   => 'mt_divider_single_blog_typo',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Single Blog Post Font family</h3>' )
            ),
            array(
                'id'          => 'mt_single_post_typography',
                'type'        => 'typography', 
                'title'       => esc_attr__('Blog Post Font family', 'porfoliowp'),
                'subtitle'    => esc_attr__( 'Default color: #454646; Font-size: 18px; Line-height: 29px;', 'porfoliowp' ),
                'google'      => true, 
                'font-size'   => true,
                'line-height' => true,
                'color'       => true,
                'font-backup' => false,
                'text-align'  => false,
                'letter-spacing'  => false,
                'font-weight'  => false,
                'font-style'  => false,
                'subsets'     => false,
                'output'      => array('.single article .article-content p'),
                'units'       =>'px',
                'default'     => array(
                    'color' => '#454646', 
                    'font-size' => '18px', 
                    'line-height' => '29px', 
                    'font-family' => 'Montserrat', 
                    'google'      => true
                ),
            ),
            array(
                'id'   => 'mt_divider_single_blog_elements',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Other Single Post Elements</h3>' )
            ),
            array(
                'id'       => 'mt_post_featured_image',
                'type'     => 'switch', 
                'title'    => esc_attr__('Single post featured image.', 'porfoliowp'),
                'subtitle' => esc_attr__('Show or Hide the featured image from blog post page.".', 'porfoliowp'),
                'default'  => true,
            ),
            array(
                'id'       => 'mt_enable_related_posts',
                'type'     => 'switch', 
                'title'    => esc_attr__('Related Posts', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or disable related posts', 'porfoliowp'),
                'default'  => true,
            ),
            array(
                'id'       => 'mt_enable_post_navigation',
                'type'     => 'switch', 
                'title'    => esc_attr__('Post Navigation', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or disable post navigation', 'porfoliowp'),
                'default'  => true,
            ),
            array(
                'id'       => 'mt_enable_authorbio',
                'type'     => 'switch', 
                'title'    => esc_attr__('About Author', 'porfoliowp'),
                'subtitle' => esc_attr__('Enable or disable "About author" section on single post', 'porfoliowp'),
                'default'  => false,
            ),
            // Author Bio Default Placeholder
            array(
                'id' => 'mt_author_default_placeholder',
                'type' => 'media',
                'url' => true,
                'title' => esc_attr__('Author Default Placeholder Thumbnail', 'porfoliowp'),
                'compiler' => 'true',
                'subtitle' => esc_attr__('Use the upload button to import media.', 'porfoliowp'),
                'default' => array('url' => 'http://placehold.it/128x128'),
            ),
            array( 
                'id'       => 'mt_opt_raw',
                'type'     => 'raw',
                'title'    => esc_attr__('Post Formats Icons', 'porfoliowp'),
            ),
        ),
    ));
    

     /**
    ||-> SECTION: Error 404 Page Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Portfolio Settings', 'porfoliowp' ),
        'id'    => 'mt_portfolio',
        'icon'  => 'el el-icon-error'
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Portfolio', 'porfoliowp' ),
        'id'         => 'mt_portfolio-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'mt_portfolio_main_page',
                'type'     => 'select',
                'title'    => esc_attr__('Select Main Portfolio Page', 'porfoliowp'), 
                'data'     => 'page'
            )
        ),
    ));

    /**
    ||-> SECTION: Elements
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Elements', 'porfoliowp' ),
        'id'    => 'mt_elements',
        'icon'  => 'el el-puzzle'
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Tabs', 'porfoliowp' ),
        'id'         => 'mt_elements_tabs',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_elements_tabs_normal',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Tabs - Normal State</h3>' )
            ),
            array(
                'id'       => 'mt_elements_tabs_normal_color',
                'type'     => 'color',
                'title'    => esc_attr__('Tabs Text Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #666666', 'porfoliowp'),
                'output'   => array( '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a' ),
                'default'  => '#666666',
            ),
            array(
                'id'       => 'mt_elements_tabs_background',
                'type'     => 'color',
                'title'    => esc_attr__('Tabs Background Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #f8f8f8', 'porfoliowp'),
                'output'    => array(
                    'background-color' => '.vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-panels,
                                            .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a',
                ),
                'default'  => '#f8f8f8',
            ),
            array(
                'id'       => 'mt_elements_tabs_border',
                'type'     => 'color',
                'title'    => esc_attr__('Tabs Border Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #f0f0f0', 'porfoliowp'),
                'output'    => array(
                    'border-color' => '.vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-panels, 
                                        .vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-panels::after, 
                                        .vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-panels::before,
                                        .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a'
                ),
                'default'  => '#f0f0f0',
            ),
            array(
                'id'   => 'mt_divider_elements_tabs_hover',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Tabs - Hover State</h3>' )
            ),
            array(
                'id'       => 'mt_elements_hover_tabs_normal_color',
                'type'     => 'color',
                'title'    => esc_attr__('Active and Hover Tabs Text Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #666666', 'porfoliowp'),
                'output'   => array( '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a' ),
                'default'  => '#666666',
            ),
            array(         
                'id'       => 'mt_elements_hover_tabs_background',
                'type'     => 'color',
                'title'    => esc_attr__('Active and Hover Tabs Background', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #ebebeb', 'porfoliowp'),
                'default'  => '#ebebeb',
                'output' => array(
                    'background-color' => '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a'
                )
            ),
            array(         
                'id'       => 'mt_elements_hover_tabs_border',
                'type'     => 'color',
                'title'    => esc_attr__('Active and Hover Tabs Border Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #e3e3e3', 'porfoliowp'),
                'default'  => '#e3e3e3',
                'output' => array(
                    'border-color' => '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a'
                )
            )
        ),
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Blockquotes', 'porfoliowp' ),
        'id'         => 'mt_elements_blockquotes',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_elements_blockquotes',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Blockquotes Styling</h3>' )
            ),
            array(
                'id'       => 'mt_elements_blockquotes_background',
                'type'     => 'color',
                'title'    => esc_attr__('Blockquotes Background Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #f6f6f6', 'porfoliowp'),
                'output'    => array(
                    'background-color' => 'blockquote',
                ),
                'default'  => '#f6f6f6',
            ),
            array(         
                'id'       => 'mt_elements_blockquotes_border',
                'type'     => 'color',
                'title'    => esc_attr__('Blockquotes Border Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #7023FF', 'porfoliowp'),
                'default'  => '#7023FF',
                'output' => array(
                    'border-color' => 'blockquote'
                )
            )
        ),
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Accordions', 'porfoliowp' ),
        'id'         => 'mt_elements_accordions',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_elements_accordions_normal',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Accordions - Normal State</h3>' )
            ),
            array(
                'id'       => 'mt_elements_accordions_normal_color',
                'type'     => 'color',
                'title'    => esc_attr__('Accordions Text Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #666666', 'porfoliowp'),
                'output'   => array( '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a' ),
                'default'  => '#666666',
            ),
            array(
                'id'       => 'mt_elements_accordions_background',
                'type'     => 'color',
                'title'    => esc_attr__('Accordions Background Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #f8f8f8', 'porfoliowp'),
                'output'    => array(
                    'background-color' => '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading',
                ),
                'default'  => '#f8f8f8',
            ),
            array(
                'id'       => 'mt_elements_accordions_border',
                'type'     => 'color',
                'title'    => esc_attr__('Accordions Border Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #f0f0f0', 'porfoliowp'),
                'output'    => array(
                    'border-color' => '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading'
                ),
                'default'  => '#f0f0f0',
            ),
            array(
                'id'   => 'mt_divider_elements_accordions_hover',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Accordions - Active&Hover State</h3>' )
            ),
            array(
                'id'       => 'mt_elements_accordions_hover_color',
                'type'     => 'color',
                'title'    => esc_attr__('Active and Hover Tabs Text Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #666666', 'porfoliowp'),
                'output'   => array( '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a' ),
                'default'  => '#666666',
            ),
            array(
                'id'       => 'mt_elements_accordions_hover_background',
                'type'     => 'color',
                'title'    => esc_attr__('Active and Hover Tabs Background Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #f8f8f8', 'porfoliowp'),
                'output'    => array(
                    'background-color' => '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
                                            .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body,
                                            .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:focus, 
                                            .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:hover',
                ),
                'default'  => '#f8f8f8',
            ),
            array(
                'id'       => 'mt_elements_accordions_hover_border',
                'type'     => 'color',
                'title'    => esc_attr__('Active and Hover Tabs Border Color', 'porfoliowp'), 
                'subtitle' => esc_attr__('Default: #f0f0f0', 'porfoliowp'),
                'output'    => array(
                    'border-color' => '.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
                                        .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body, 
                                        .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body::after, 
                                        .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body::before'
                ),
                'default'  => '#f0f0f0',
            ),
        ),
    ));


    /**
    ||-> SECTION: Social Media Settings
    */
    Redux::setSection( $opt_name, array(
        'title' => esc_attr__( 'Social Media Settings', 'porfoliowp' ),
        'id'    => 'mt_social_media',
        'icon'  => 'el el-icon-myspace'
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_attr__( 'Social Media', 'porfoliowp' ),
        'id'         => 'mt_social_media_settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'   => 'mt_divider_global_social_links',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Global Social Links</h3>' )
            ),
            array(
                'id' => 'mt_social_fb',
                'type' => 'text',
                'title' => esc_attr__('Facebook URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Facebook url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => 'http://facebook.com'
            ),
            array(
                'id' => 'mt_social_tw',
                'type' => 'text',
                'title' => esc_attr__('Twitter username', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Twitter username.', 'porfoliowp'),
                'default' => 'envato'
            ),
            array(
                'id' => 'mt_social_pinterest',
                'type' => 'text',
                'title' => esc_attr__('Pinterest URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Pinterest url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => 'http://pinterest.com'
            ),
            array(
                'id' => 'mt_social_skype',
                'type' => 'text',
                'title' => esc_attr__('Skype Name', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Skype username.', 'porfoliowp'),
                'default' => 'porfoliowp'
            ),
            array(
                'id' => 'mt_social_instagram',
                'type' => 'text',
                'title' => esc_attr__('Instagram URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Instagram url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => 'http://instagram.com'
            ),
            array(
                'id' => 'mt_social_youtube',
                'type' => 'text',
                'title' => esc_attr__('YouTube URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your YouTube url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => 'http://youtube.com'
            ),
            array(
                'id' => 'mt_social_dribbble',
                'type' => 'text',
                'title' => esc_attr__('Dribbble URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Dribbble url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_gplus',
                'type' => 'text',
                'title' => esc_attr__('Google+ URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Google+ url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => 'http://plus.google.com'
            ),
            array(
                'id' => 'mt_social_linkedin',
                'type' => 'text',
                'title' => esc_attr__('LinkedIn URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your LinkedIn url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => 'http://linkedin.com'
            ),
            array(
                'id' => 'mt_social_deviantart',
                'type' => 'text',
                'title' => esc_attr__('Deviant Art URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Deviant Art url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_digg',
                'type' => 'text',
                'title' => esc_attr__('Digg URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Digg url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_flickr',
                'type' => 'text',
                'title' => esc_attr__('Flickr URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Flickr url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_stumbleupon',
                'type' => 'text',
                'title' => esc_attr__('Stumbleupon URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Stumbleupon url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_tumblr',
                'type' => 'text',
                'title' => esc_attr__('Tumblr URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Tumblr url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id' => 'mt_social_vimeo',
                'type' => 'text',
                'title' => esc_attr__('Vimeo URL', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Vimeo url.', 'porfoliowp'),
                'validate' => 'url',
                'default' => ''
            ),
            array(
                'id'   => 'mt_divider_twitter_keys',
                'type' => 'info',
                'class' => 'mt_divider',
                'desc' => wp_kses_post( '<h3>Twitter Keys - Necessary for Tweets Feed Shortcode</h3>' )
            ),
            array(
                'id' => 'mt_tw_consumer_key',
                'type' => 'text',
                'title' => esc_attr__('Twitter Consumer Key', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Twitter Consumer key.', 'porfoliowp'),
                'default' => 'iSbkrNtDw51LUizz5ouEkQ'
            ),
            array(
                'id' => 'mt_tw_consumer_secret',
                'type' => 'text',
                'title' => esc_attr__('Twitter Consumer Secret key', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Twitter Consumer Secret key.', 'porfoliowp'),
                'default' => 'pZe6vUWyWdHmfDEbGfcAJpu9uJnGeEDrgujuySqk'
            ),
            array(
                'id' => 'mt_tw_access_token',
                'type' => 'text',
                'title' => esc_attr__('Twitter Access Token', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Access Token.', 'porfoliowp'),
                'default' => '2385448772-FXizji2NK4imcKoohcVu036VykIp5goymadiiYF'
            ),
            array(
                'id' => 'mt_tw_access_token_secret',
                'type' => 'text',
                'title' => esc_attr__('Twitter Access Token Secret', 'porfoliowp'),
                'subtitle' => esc_attr__('Type your Twitter Access Token Secret.', 'porfoliowp'),
                'default' => '2wUWJhhnd0ErTCgOYoVokrGKPWV055F9K4Xv5JpOmUL2e'
            )
        ),
    ));
    /*
     * <--- END SECTIONS
     */
