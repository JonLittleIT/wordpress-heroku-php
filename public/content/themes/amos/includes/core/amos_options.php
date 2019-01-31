<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */
if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "amos_redata";

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
                'opt_name' => 'amos_redata', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Amos', 'amos'),
                'page_title' => __('Amos', 'amos'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'async_typography'  => false,      
                'google_api_key' => 'AIzaSyDNS4R2BxpPspB31mZPnGvelSPSXvggI4I', // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'amos', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => false, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );        
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
    
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.     
            $args['share_icons'][] = array(
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon' => 'el-icon-github'
                    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $args['share_icons'][] = array(
                'url' => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $args['share_icons'][] = array(
                'url' => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon' => 'el-icon-linkedin'
            );



            // Panel Intro text -> before the form
            if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
                if (!empty($args['global_variable'])) {
                    $v = $args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $args['opt_name']);
                }
                $args['intro_text'] = sprintf('<p>'.__('Amos offer a wide range of website templates.', 'amos').' </p>', $v);
            } else {
                $args['intro_text'] = '<p>'.__('Amos offer a wide range of website templates.', 'amos').'</p>';
            }

            // Add content after the form.
            $args['footer_text'] = __('', 'amos');


            Redux::setArgs( $opt_name, $args );

            Redux::setSection( $opt_name, array(
                'title' => __('General Options', 'amos'),
                'desc' => __('In this section you can customize basic options like logo, responsive etc...', 'amos'),
                'icon' => 'el-icon-cogs',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    
                    array(
                        'id' => 'responsive_bool',
                        'type' => 'switch',
                        'title' => __('Responsive Layout', 'amos'),
                        'subtitle' => __('Switch on to active responsive layout', 'amos'),
                        "default" => 1,
                    ),

                    
               


                    array(
                        'id' => 'nicescroll',
                        'type' => 'switch',
                        'title' => __('Smooth Scroll', 'amos'),
                        'subtitle' => __('Switch on to active smooth scrolling', 'amos'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'amos_page_transition',
                        'type' => 'switch',
                        'title' => __('Page Transition', 'amos'),
                        'subtitle' => __('Switch on to active smooth page transition', 'amos'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'page_transition_in',
                        'type' => 'select',
                        'title' => __('Page Transition In Effect', 'amos'),
                        'subtitle' => __('', 'amos'),
                        'required' => array('amos_page_transition', 'equals', '1'),
                        'options' => array('fade-in' => 'fade-in',
                                           'fade-in-up-sm' => 'fade-in-up-sm',
                                           'fade-in-up' => 'fade-in-up',
                                           'fade-in-up-lg' => 'fade-in-up-lg',
                                           'fade-in-down-sm' => 'fade-in-down-sm',
                                           'fade-in-down-lg' => 'fade-in-down-lg',
                                           'fade-in-down' => 'fade-in-down',
                                           'fade-in-left-sm' => 'fade-in-left-sm',
                                           'fade-in-left' => 'fade-in-left',
                                           'fade-in-left-lg' => 'fade-in-left-lg',
                                           'fade-in-right-sm' => 'fade-in-right-sm',
                                           'fade-in-right' => 'fade-in-right',
                                           'fade-in-right-lg' => 'fade-in-right-lg',), //Must provide key => value pairs for select options
                        'default' => 'fade-in'
                    ), 

                    array(
                        'id' => 'page_transition_in_duration',
                        'type' => 'text',
                        'title' => __('Page Transition In Duration', 'amos'),
                        'required' => array('amos_page_transition', 'equals', '1'),
                        'default' => '1000'
                    ),

                    array(
                        'id' => 'page_transition_out',
                        'type' => 'select',
                        'title' => __('Page Transition In Effect', 'amos'),
                        'subtitle' => __('', 'amos'),
                        'required' => array('amos_page_transition', 'equals', '1'),
                        'options' => array('fade-out' => 'fade-out',
                                           'fade-out-up-sm' => 'fade-out-up-sm',
                                           'fade-out-up' => 'fade-out-up',
                                           'fade-out-up-lg' => 'fade-out-up-lg',
                                           'fade-out-down-sm' => 'fade-out-down-sm',
                                           'fade-out-down-lg' => 'fade-out-down-lg',
                                           'fade-out-down' => 'fade-out-down',
                                           'fade-out-left-sm' => 'fade-out-left-sm',
                                           'fade-out-left' => 'fade-out-left',
                                           'fade-out-left-lg' => 'fade-out-left-lg',
                                           'fade-out-right-sm' => 'fade-out-right-sm',
                                           'fade-out-right' => 'fade-out-right',
                                           'fade-out-right-lg' => 'fade-out-right-lg',), //Must provide key => value pairs for select options
                        'default' => 'fade-out'
                    ), 

                    array(
                        'id' => 'page_transition_out_duration',
                        'type' => 'text',
                        'title' => __('Page Transition OUT Duration', 'amos'),
                        'required' => array('amos_page_transition', 'equals', '1'),
                        'default' => '1000'
                    ),

                    array(
                        'id' => 'section-special-pages-start',
                        'type' => 'section',
                        'title' => __('Select Special Pages', 'amos'),
                        'indent' => true // Indent all options below until the next 'section' option is set.
                    ),


                    array(
                        'id' => 'frontpage',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => __('Select Frontpage', 'amos'),
                        'subtitle' => __('Frontpage is the page that you want to show in the home', 'amos'),
                        'desc' => __('Select one of the created pages to use it as frontpage', 'amos'),
                    ),


                    array(
                        'id' => 'blogpage',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => __('Select Blog Page', 'amos'),
                        'subtitle' => __('Blogpage is the page that you want to show the blog posts', 'amos'),
                        'desc' => __('Select one of the created pages to use as blog', 'amos'),
                    ),

                    array(
                        'id' => 'comingsoon_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => __('Select Coming Soon Page', 'amos'),
                        'subtitle' => __('Select one page that you want to use as comingsoon or maintenance page', 'amos'),
                        'desc' => __('', 'amos'),
                    ),

                    array(
                        'id' => 'section-special-pages-end',
                        'type' => 'section',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),

                    array(
                        'id' => '404_error_message',
                        'type' => 'editor',
                        'title' => __('404 error message', 'amos'),
                        'subtitle' => __('Text to be placed in 404 page', 'amos'),
                        'default' => 'Sorry but the page you are looking for has not been found. Try checking the URL for errors, then bit the refresh button on your browser',
                    ),

                    array(
                                'id' => 'bg_image_404',
                                'type' => 'background',
                                'output' => '.bg_image_404',
                                'title' => __('404 Page background', 'amos'),
                                'subtitle' => __('404 page background with image, color, etc.', 'amos'),
                                'default' => array('background-color' => '#f5f5f5')
                            ),

                    array(
                        'id' => 'section-code-start',
                        'type' => 'section',
                        'title' => __('Tracking Code / Custom CSS / Custom JS', 'amos'),
                        'indent' => true // Indent all options below until the next 'section' option is set.
                    ),


                    array(
                        'id' => 'tracking_code',
                        'type' => 'ace_editor',
                        'title' => __('Tracking Code', 'amos'),
                        'subtitle' => __('Paste your JS code here.', 'amos'),
                        'mode' => 'text',
                        'theme' => 'chrome',
                        'desc' => 'Paste your Google Analytics or other tracking code here. This will be added into the footer.',
                        'default' => "/*jQuery(document).ready(function(){\n\n});*/"
                    ),

                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS Code', 'amos'),
                        'subtitle' => __('Paste your CSS code here.', 'amos'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => 'Add custom css code to theme.',
                        'default' => "/*#header{\nmargin: 0 auto;\n}*/"
                    ),
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'title' => __('Custom JS Code', 'amos'),
                        'subtitle' => __('Paste your JS code here.', 'amos'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'desc' => '.',
                        'default' => "/*jQuery(document).ready(function(){\n\n});*/"
                    ),

                    array(
                        'id' => 'section-code-end',
                        'type' => 'section',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),

                ),
            ));

            

            Redux::setSection( $opt_name, array(
                'type' => 'divide',
           ));



            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-website',
                'title' => __('Header', 'amos'),
                'icon'    => 'el-icon-cogs',
                'heading' =>'Header',
                'fields' => array(


                   
                   //logo options 
              array(
                           'id' => 'section-logo-start',
                           'type' => 'section',
                           'icon'    => 'el-icon-eye',
                           'title' => __('Logo', 'amos'),
                           'subtitle' => __('Upload here logos used in site', 'amos'),
                           'indent' => true 
                       ),

                array(
                        'id' => 'logo',
                        'type' => 'media',
                        'title' => __('Upload Logo', 'amos'),
                        'desc' => __('Upload here the logo that is placed in top of the page ', 'amos'),
                        'subtitle' => __('Upload any media using the WordPress native uploader', 'amos'),
                        'default' => array('url' => get_template_directory_uri().'/img/logo.png'),
                    ),

                    array(
                        'id' => 'logo_light',
                        'type' => 'media',
                        'title' => __('Upload Logo Light', 'amos'),
                        'desc' => __('Upload here the logo that is placed in top of the page (Light Version) ', 'amos'),
                        'subtitle' => __('', 'amos'),
                        'default' => array('url' => get_template_directory_uri().'/img/logo_light.png'),
                    ),

                    array(
                        'id' => 'vertical_logo',
                        'type' => 'media',
                        'title' => __('Upload Vertical Logo for Vertical Hidden Header', 'amos'),
                        'desc' => __('Upload here the logo that is placed in the bottom of the vertical header if used. ', 'amos'),
                        'subtitle' => __('Upload any media using the WordPress native uploader', 'amos'),
                        'default' => array('url' => get_template_directory_uri().'/img/logo.png'),
                        
                    ),

                    array(
                        'id' => 'logo_height',
                        'type' => 'dimensions', 
                        'output' => array('#logo img'),
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => false,
                        'title' => __('Logo Height', 'amos'),
                        'subtitle' => __('units: px', 'amos'),
                        'desc' => __('', 'amos'),
                        'default' => array('height' => 15)
                    ),

                                
                    array(
                            'id'     => 'section-logo-end',
                            'type'   => 'section',
                            'indent' => false,
                        ),//end menu section


                    array(
                           'id' => 'section-menu-start',
                           'type' => 'section',
                           'icon'    => 'el-icon-lines',
                           'title' => __('Navigation Options', 'amos'),
                           'subtitle' => __('Navigation Options', 'amos'),
                           'indent' => true 
                       ),
           

                     array(
                        'id' => 'menu_presets',
                        'type' => 'image_select',
                        'title' => __('Select the menu layout', 'amos'),
                        'subtitle' => __('Select one of our predefined menu styles and some options will change', 'amos'),
                         'options' => array(
                            'h1' => array(
                                'alt' => 'Left aligned menu', 
                                'img' => get_template_directory_uri().'/img/menu_styles/left-aligned-menu.jpg',
                                'title' => 'Left aligned menu.'

                            ),
                            'h2' => array(
                                'alt' => 'Justified alignment', 
                                'img' => get_template_directory_uri().'/img/menu_styles/menu-center.jpg',
                                'title' => 'Justified alignment.'

                            ) ,
                            'h3' => array(
                                'alt' => 'Right aligned menu', 
                                'img' => get_template_directory_uri().'/img/menu_styles/menu-right.jpg',
                                'desc' => 'Header with right navigation and left positioned Header Tools.',
                                'title' => 'Right aligned menu.'

                            ) , 
                            'h4' => array(
                                'alt' => 'Center Menu and logo', 
                                'img' => get_template_directory_uri().'/img/menu_styles/centered-menu-and-logo.jpg',
                                'title' => 'Center Menu and logo.'

                            ),
                            'h5' => array(
                                'alt' => 'Center Split Menu', 
                                'img' => get_template_directory_uri().'/img/menu_styles/center-split-menu.jpg',
                                'title' => 'Center Split Menu.'

                            ) ,
                            'h6' => array(
                                'alt' => 'Menu in second row', 
                                'img' => get_template_directory_uri().'/img/menu_styles/menu-second-row.jpg',
                                'title' => 'Menu in second row.'

                            ),

                            'h7' => array(
                                'alt' => 'Menu under logo with widget area in the right', 
                                'img' => get_template_directory_uri().'/img/menu_styles/menu-second-row.jpg',
                                'title' => 'Menu under logo with widget area in the right.'

                            ) ,
                            'h8' => array(
                                'alt' => 'Vertical Menu fixed lateral position', 
                                'img' => get_template_directory_uri().'/img/menu_styles/vertical-menu-fixed-position.jpg',
                                'title' => 'Vertical Menu fixed lateral position.'

                            ) ,
                            'h9' => array(
                                'alt' => 'Vertical Menu initially hidden', 
                                'img' => get_template_directory_uri().'/img/menu_styles/vertical-menu-hidden.jpg',
                                'title' => 'Vertical Menu initially hidden.'

                            ) ,
                            'h10' => array(
                                'alt' => 'Fullscreen Menu - Centered logo and lateral header tools', 
                                'img' => get_template_directory_uri().'/img/menu_styles/fullwidth-menu-centered-logo-lateral-header-tools.jpg',
                                'title' => 'Fullscreen Menu - Centered logo and lateral header tools.'

                            ), 
                            'h11' => array(
                                'alt' => 'Fullscreen Menu - Lateral logo and header tools', 
                                'img' => get_template_directory_uri().'/img/menu_styles/fullwidth-menu-lateral-header-tools.jpg',
                                'title' => 'Fullscreen Menu - Lateral logo and header tools.'

                            ), 
                            
                        ),

                        'default' => 'h1',
                    
                    ),

                        array(
                            'id'     => 'section-menu-end',
                            'type'   => 'section',
                            'indent' => false,
                        ),//end menu section


                        array(
                           'id' => 'section-menu-add-start',
                           'type' => 'section',
                           'icon'    => 'el-icon-lines',
                           'title' => __('Additional menu options', 'amos'),
                           'subtitle' => __('Select other addition optons', 'amos'),
                           'indent' => true,
                       ),
                       

                       array(
                            'id'      => 'header_tools',
                            'type'    => 'sorter',
                            'title'   => 'Header Tools',
                            'compiler' => 'true',
                            'subtitle'    => 'Organize how you want the header tools to appear. Go to Header Options to choose the options for each header tool.',
                            'options' => array(
                                'enabled'  => array(
                                   
                                    'cart'     => 'Cart',
                                    'search' => 'Search',
                                    'wishlist' => 'Wishlist'
                                ),
                                
                                
                                'disabled' => array(),
                            ),
                                
            

                            'required' => array('menu_presets', 'equals', array('h1', 'h2', 'h3', 'h6', 'h7') ),
                        ),

                       array(
                            'id'      => 'header_tools_two',
                            'type'    => 'sorter',
                            'title'   => 'Header Tools',
                            'compiler' => 'true',
                            'subtitle'    => 'Organize how you want the header tools to appear. Go to Header Options to choose the options for each header tool.',
                            'options' => array(
                                'left'  => array(
                                    'extra_nav' => 'Extra side navigation',
                                    'cart'     => 'Cart',
                                    'search' => 'Search',
                                    'button'   => 'Button',
                                    'wishlist' => 'Wishlist'
                                ),
                                
                                'right'   => array(),
                                'disabled' => array(),
                            ),
                                'limits'   => array(
                                    'left' => 4,
                                    'right'   => 3,
                                ),
            

                            'required' => array('menu_presets', 'equals', array('h4', 'h5') ),
                        ),

                       array(
                            'id'      => 'header_tools_extend',
                            'type'    => 'sorter',
                            'title'   => 'Header Tools',
                            'compiler' => 'true',
                            'subtitle'    => 'Organize how you want the header tools to appear. Go to Header Options to choose the options for each header tool.',
                            'options' => array(
                                'enabled'  => array(
                                    'hamburger_menu' => 'Hamburger Menu'
                                    
                                ),
                                
                                
                                'disabled' => array(
                                    'extra_nav' => 'Extra side navigation',
                                    'cart'     => 'Cart',
                                    'search' => 'Search',
                                    'button'   => 'Button',
                                'wishlist' => 'Wishlist'),
                            ),
                                
            

                            'required' => array('menu_presets', 'equals', array('h11') ),
                        ),

                       array(
                            'id'      => 'header_tools_two_extend',
                            'type'    => 'sorter',
                            'title'   => 'Header Tools',
                            'compiler' => 'true',
                            'subtitle'    => 'Organize how you want the header tools to appear. Go to Header Options to choose the options for each header tool.',
                            'options' => array(
                                'left'  => array(
                                    'hamburger_menu' => 'Hamburger Menu',
                                    
                                ),
                                
                                'right'   => array(
                                    'extra_nav' => 'Extra side navigation',
                                    'cart'     => 'Cart',
                                    'search' => 'Search',
                                    'button'   => 'Button',
                                'wishlist' => 'Wishlist'
                            ),
                                'disabled' => array(),
                            ),
                                'limits'   => array(
                                    'left' => 4,
                                    'right'   => 4,
                                ),
            

                            'required' => array('menu_presets', 'equals', array('h10') ),
                        ),

                       array( 
                                'id' => 'header_tools_font_size',
                                'type' => 'typography',
                                'title' => __('Header Tools Icon Size', 'amos'),
                                'font-family' => false,
                                'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-size'=>true,
                                'line-height'=>false,
                                'font-weight' => false,
                                'font-style' => false,
                                'letter-spacing'=>false, // Defaults to false
                                'color'=>true,
                                'preview' => false,
                                'text-align' => false,
                                'text-transform' => false,
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font size for header tools icons', 'amos'),
                                'output' => '.header_tools .cart_icon, .header_tools .wishlist, .header_tools .right_search, .header_tools a',
                                'default' => array(
                                    'color' => '#012b43',
                                    'font-size' => '14px',
                                ),
                            ),


                        array(
                            'id'       => 'header_tools_position',
                            'type'     => 'button_set',
                            'title'    => __('Header Tools Position', 'amos'),
                            'subtitle' => __('Select the position left/right of header tools', 'amos'),
                            'desc'     => __('', 'amos'),
                            //Must provide key => value pairs for options
                            'options' => array(
                                'left' => 'Left', 
                                'right' => 'Right' 
                                
                             ), 
                            'default' => 'right',
                            'required' => array('menu_presets', 'equals', array('h1', 'h2', 'h3', 'h11') ),
                        ),

                        

                        array( 
                                'id'       => 'h4_border',
                                'type'     => 'border',
                                'title'    => __('Menu border top and bottom separators', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'output'   => array('.h4 .centered_menu .nav_menu'),
                                'left'    => false, 
                                'right'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border above and below menu', 'amos'),
                                'default'  => array(
                                    'color'  => '#eee', 
                                    'border-style'  => 'solid',
                                    'border-top'    => '1px',
                                    'border-bottom'    => '1px',
                                ),
                                'required' => array('menu_presets', 'equals', array('h4') ),
                            ),

                        /*Vertical header settings*/
                        array(
                            'title'     => __( 'Vertical Header Position', 'amos' ),
                            'desc'      => __( 'Select the fixed position for the vertical header', 'amos' ),
                            'id'        => 'h_vertical_position',
                            'type'      => 'image_select',
                            'required' => array('menu_presets', 'equals', array('h8', 'h9')),
                            'customizer'=> array(),
                            'default' => 'left',
                            'options'   => array(
                                'left' => ReduxFramework::$_url . 'assets/img/2cl.png',
                                'right'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                            )
                        ),


                        array(
                            'id' => 'h_vertical_width',
                            'type' => 'dimensions',
                            'units' => 'px', // You can specify a unit value. Possible: px, em, %
                            //'units_extended' => 'true', // Allow users to select any type of unit
                            'width' => true,
                            'height' => false,
                            'title' => __('Vertical Header Width', 'amos'),
                            'required' => array('menu_presets', 'equals', array('h8', 'h9')),
                            'subtitle' => __('units: px', 'amos'),
                            'desc' => __('', 'amos'),
                            'default' => array('width' => '280px')
                        ),

                        array(
                            'id' => 'h_vertical_padding',
                            'type' => 'spacing',
                            'mode' => 'padding', // absolute, padding, margin, defaults to padding
                            'units' => 'px', // You can specify a unit value. Possible: px, em, %
                            //'units_extended' => 'true', // Allow users to select any type of unit
                            //'display_units' => 'false', // Set to false to hide the units if the units are specified
                            'title' => __('Verical Header Menu Inner Padding', 'amos'),
                            'subtitle' => __('Adjust side menu padding ', 'amos'),
                            'required' => array('menu_presets', 'equals', array('h8', 'h9')),
                            'desc' => __('Unit: px', 'amos'),
                            'default' => array('padding-left' => '24px', 'padding-right' => "20px", 'padding-top' => "120px", 'padding-bottom' => "100px")
                        ),
                        
                        array( 
                            'id' => 'h_vertical_margin',
                            'type' => 'spacing',
                            'mode' => 'margin', // absolute, padding, margin, defaults to padding
                            'units' => 'px', // You can specify a unit value. Possible: px, em, %
                            'bottom' => false,
                            'left' => false,
                            'right' => false,
                            //'units_extended' => 'true', // Allow users to select any type of unit
                            //'display_units' => 'false', // Set to false to hide the units if the units are specified
                            'title' => __('Verical Header Menu Inner Margin beetwen logo/menu/widgets', 'amos'),
                            'subtitle' => __('Adjust margin beetween side menu elements logog/menu/widgets ', 'amos'),
                            'required' => array('menu_presets', 'equals', array('h8', 'h9')),
                            'desc' => __('Unit: px', 'amos'),
                            'default' => array('margin-top' => '60px')
                        ),

                        
                        array(
                            'id'       => 'h_vertical_content_align',
                            'type'     => 'button_set',
                            'title'    => __('Content Align', 'amos'),
                            'subtitle' => __('Choose the align of logo, menu and widgets in header.', 'amos'),
                            'desc'     => __('Left/Center/Right positions.', 'amos'),
                            'options' => array(
                                'left' => 'Left', 
                                'center' => 'Center', 
                                'right' => 'Right'
                             ), 
                            'default' => 'center',
                            'required' => array('menu_presets', 'equals', array('h8', 'h9')),
                        ),

                        array(
                            'id' => 'h_vertical_border', 
                            'type' => 'switch',
                            'title' => __('Add border to side header style', 'amos'),
                            'subtitle' => __('Border for side left/right header style', 'amos'),
                            'desc' => __('', 'amos'),
                            'required' => array('menu_presets', 'equals', array('h8', 'h9')),
                            'default' => 0// 1 = on | 0 = off
                        ),

                        array(
                            'id' => 'h8_border_top', 
                            'type' => 'switch',
                            'title' => __('Add colored border in top of Header', 'amos'),
                            'subtitle' => __('Border with theme color in top of Left/Right header', 'amos'),
                            'desc' => __('', 'amos'),
                            'required' => array('menu_presets', 'equals', array('h8')),
                            'default' => 0// 1 = on | 0 = off
                        ),

                        array(
                            'id' => 'h8_transparent_padding', 
                            'type' => 'switch',
                            'title' => __('Transparent Header', 'amos'),
                            'subtitle' => __('Transparent Left/Right header above the content. ', 'amos'),
                            'desc' => __('', 'amos'),
                            'required' => array('menu_presets', 'equals', array('h8')),
                            'default' => 0// 1 = on | 0 = off
                        ),
                        array(
                        'id' => 'header_overlay_color',
                        'type' => 'color_rgba',
                        'output' => array('.header_fullwrapper'),
                        'title' => __('Menu Overlay Fullscreen BG Color', 'amos'),
                        'mode' => 'background-color', 
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '0.95'
                        ),
                        'required' => array('menu_presets', 'equals', array('h10', 'h11')),
                        'validate' => 'colorrgba',
                    ),
                        /*end Vertical header settings*/



                        array(
                            'id'     => 'section-menu-add-end',
                            'type'   => 'section',
                            'indent' => false,
                        ),//end menu add section

                    // Header options
                    array(
                           'id' => 'section-header-start',
                           'type' => 'section',
                           'icon'    => 'el-icon-eye',
                           'title' => __('Header Options', 'amos'),
                           'subtitle' => __('Aditional Header Options', 'amos'),
                           'indent' => true 
                       ),

                    array(
                        'id' => 'header_height',
                        'type' => 'dimensions',
                        'output' => array('header#header .row-fluid .span12, .header_wrapper, .snap_header, .responsive_header, responsive_header #logo, .responsive_header .header_tools'),
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => false,
                        'title' => __('Header Height', 'amos'),
                        'subtitle' => __('units: px', 'amos'),
                        'desc' => __('', 'amos'),
                        'default' => array('height' => 100),
                        'required' => array('menu_presets', 'equals', array('h1', 'h2', 'h3', 'h5','h10', 'h11')),
                    ),
                    
                    
                    array(
                        'id' => 'header_background',
                        'type' => 'color_rgba', 
                        'mode' => 'background-color',
                        'transparent' => true,
                        'validate' => 'colorrgba',
                        'output' => array('.header_wrapper, .header_wrapper.hidden_header .vertical_header_background'),
                        'title' => __('Background', 'amos'),
                        'subtitle' => __('Header background with image, color, etc.', 'amos'),
                        'default' => array(
                            'color' => '#fff',
                            'alpha' => '0.0'
                        ),
                    ),

                    array(
                        'id' => 'header_transparency',
                        'type' => 'switch',
                        'title' => __('Make Transparency Header', 'amos'),
                        'subtitle' => 'If you active this option the header should be shown on top of the slider',
                        'default' => 1,
                        'required' => array('menu_presets', 'equals', array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h10', 'h11') ),
                    ),

                    array(
                            'id' => 'header_first_row_height',
                            'type' => 'dimensions',
                            'output' => array('header#header > .container > .row-fluid > .span12, header#header > .row-fluid > .span12'),
                            'units' => 'px', // You can specify a unit value. Possible: px, em, %
                            //'units_extended' => 'true', // Allow users to select any type of unit
                            'width' => false,
                            'title' => __('First Row Header Height(logo and header tools row)', 'amos'),
                            'subtitle' => __('units: px', 'amos'),
                            'desc' => __('', 'amos'),
                            'default' => array('height' => 90),
                            'required' => array('menu_presets', 'equals', array('h4', 'h6', 'h7') ),
                        ),
                        array(
                            'id' => 'header_second_row_height',
                            'type' => 'dimensions',
                            'output' => array('header#header .header_second .row-fluid .span12'),
                            'units' => 'px', // You can specify a unit value. Possible: px, em, %
                            //'units_extended' => 'true', // Allow users to select any type of unit
                            'width' => false,
                            'title' => __('Second Row Header Height(menu row)', 'amos'),
                            'subtitle' => __('units: px', 'amos'),
                            'desc' => __('', 'amos'),
                            'default' => array('height' => 30),
                            'required' => array('menu_presets', 'equals', array('h4', 'h6', 'h7') ),
                        ),

                    array(
                        'id' => 'header_navigation',
                        'type' => 'color_rgba',
                        'output' => array('.header_wrapper .header_second'),
                        'title' => __('Second Header Row Background Color', 'amos'),
                        'mode' => 'background-color',  
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '1.00'
                        ),
                        'required' => array('menu_presets', 'equals', array('h4', 'h6', 'h7')),
                        'validate' => 'colorrgba',
                    ),


                    array(
                        'id' => 'headernavsix_font_hover',
                        'type' => 'color_rgba',
                        'output' => array('.header_wrapper .header_second nav li > a:hover, .header_wrapper .header_second nav li.current-menu-item > a, .header_wrapper .header_second nav li.current-menu-parent > a'),
                        'title' => __('Second header row menu hover color', 'amos'),
                        'mode' => 'color',  
                        'default'  => array(
                            'color' => '#f7f7f7', 
                            'alpha' => '1.00'
                        ),
                        'required' => array('menu_presets', 'equals', array('h4', 'h6', 'h7')),
                        'validate' => 'colorrgba',
                    ),



                    
                    array(
                        'id' => 'header_second_transparent',
                        'type' => 'switch',
                        'title' => __('Make transparent second header row', 'amos'),
                        'subtitle' => __('Switch On to enable transparency', 'amos'),
                        'default' => 0,
                        'required' => array('menu_presets', 'equals', array('h4', 'h6', 'h7')),
                    ),

                    

                 

                    array(
                        'id' => 'header_container_full', 
                        'type' => 'checkbox',
                        'title' => __('Remove container from header', 'amos'),
                        'subtitle' => __('Cant use with left menu', 'amos'),
                        'desc' => __('By checking this the header container should be removed and transformed in fullwidth header', 'amos'),
                        'default' => '0'// 1 = on | 0 = off
                    ),


                    array( 
                        'id'       => 'header_border_bottom_content',
                        'type'     => 'switch',
                        'title'    => __('Header Border Bottom', 'amos'),
                        
                        'desc'     => __('Add Border Bottom for header', 'amos'),
                        'default'  =>0
                    ),

                    array(
                        'id' => 'header_shadow', 
                        'type' => 'select',
                        'title' => __('Header Shadow', 'amos'),
                        'subtitle' => __('Select one shadow style or leave it without shadow', 'amos'),
                        'desc' => __('Isnt compatible with all headers', 'amos'),
                        'options' => array('no_shadow' => 'Without Shadow', 'full' => 'Fullwidth light shadow', 'shadow1' => 'Shadow1', 'shadow2' => 'Shadow2', 'shadow3' => 'Shadow3'), //Must provide key => value pairs for select options
                        'required' => array('menu_presets', 'equals', array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h10', 'h11')),
                        'default' => 'no_shadow'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'header_button',
                        'type' => 'text',
                        'title' => __('Header Button', 'amos'),
                        'default' => 'Login'
                    ),

                    array(
                        'id' => 'header_button_link',
                        'type' => 'text', 
                        'title' => __('Header Button Link', 'amos'),
                        'default' => '#'
                    ),

                    

                    array( 
                        'id'       => 'search_widgets',
                        'type'     => 'switch',
                        'title'    => __('Display widget areas in search screen', 'amos'),
                        
                        'desc'     => __('Turn on to enable widgets in search overlay screen.', 'amos'),
                        'default'  =>1
                    ),

                    array(
                        'id' => 'search_background',
                        'type' => 'color_rgba',
                        'output' => array('.search_bar'),
                        'title' => __('Search fullscreen background color', 'amos'),
                        'mode' => 'background-color',  
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba',
                    ),


                    array(
                        'id' => 'search_font_color',
                        'type' => 'color_rgba',
                        'output' => array('.search_bar, .search_bar .search_widgetized, .search_bar .search_widgetized .widget-title, .search_bar .overlay-close'),
                        'title' => __('Search fullscreen text color', 'amos'),
                        'mode' => 'color',  
                        'default'  => array(
                            'color' => '#f7f7f7', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba',
                    ),
                    array( 
                        'id'       => 'fixed_bar',
                        'type'     => 'switch',
                        'title'    => __('Display a vertical fixed bar at the left of the screen.', 'amos'),
                        
                        'desc'     => __('Turn on to enable the verical left bar.', 'amos'),
                        'default'  =>0
                    ),
                    array(
                        'id' => 'fixed_bar_text',
                        'type' => 'text', 
                        'title' => __('Add here the text displayed at fixed vertical bar.', 'amos'),
                        'default' => '© 2018, Amos Creative Portfolio Theme by Elle Themes',
                        'required' => array('fixed_bar', 'equals', '1'),
                    ),

                    array(
                            'id'     => 'section-header-end',
                            'type'   => 'section',
                            'indent' => false,
                        ),//end menu section

                    /* end header options */

                    array(
                           'id' => 'section-menu-resp-start',
                           'type' => 'section',
                           'icon'    => 'el-icon-eye',
                           'title' => __('Menu on responsive', 'amos'),
                           'subtitle' => __('Menu responsive options', 'amos'),
                           'indent' => true 
                       ),

                    array(
                        'id' => 'responsive_menu_dropdown',
                        'type' => 'switch',
                        'title' => __('Show Responsive Menu Dropdown', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'menu_presets_responsive',
                        'type' => 'image_select',
                        'title' => __('Select the menu layout', 'amos'),
                        'subtitle' => __('Select one of our predefined menu styles and some options will change', 'amos'),
                        'options' => array(
                            'center' => array(
                                'alt' => 'Centered logo', 
                                'img' => get_template_directory_uri().'/img/menu_styles/menu-right.jpg',
                                'title' => 'Centered Logo and lateral header tools.'

                            ),
                            'lateral' => array(
                                'alt' => 'Lateral', 
                                'img' => get_template_directory_uri().'/img/menu_styles/menu-right.jpg',
                                'title' => 'Logo and hamburger menu icon lateral.'

                            ) ,
                             
                            
                            
                        ),
                        'default' => 'center'
                    ),
                    array(
                            'id'      => 'header_tools_responsive',
                            'type'    => 'sorter',
                            'title'   => 'Header Tools in responsive',
                            'compiler' => 'true',
                            'subtitle'    => 'Organize how you want the header tools to appear in responsive. Make sure to enable alwas Hamburger menu if you want to dispaly the menu in responsive.',
                            'options' => array(
                                'left'  => array(
                                    'menu_responsive' => 'Hamburger menu',
                                    'cart'     => 'Cart',
                                    'search' => 'Search',
                                    'button'   => 'Button'
                                ),
                                
                                'right'   => array(),
                                'disabled' => array(),
                            ),
                                'limits'   => array(
                                    'left' => 4,
                                    'right'   => 3,
                                ),
            

                            'required' => array('menu_presets_responsive', 'equals', array('center') ),
                        ),

                    array(
                            'id'       => 'menu_responsive_position',
                            'type'     => 'button_set',
                            'title'    => __('Hamburger Menu Icon Position', 'amos'),
                            'subtitle' => __('Select the position left/right of responsive menu icon', 'amos'),
                            'desc'     => __('', 'amos'),
                            //Must provide key => value pairs for options
                            'options' => array(
                                'left' => 'Left', 
                                'right' => 'Right' 
                                
                             ), 
                            'default' => 'right',
                            'required' => array('menu_presets_responsive', 'equals', array('lateral') ),
                        ),

                    array(
                                'id' => 'responsive_menu_style',
                                'type' => 'select',
                                'title' => __('Responsive menu style', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'options' => array('normal' => 'Standard', 'sidemenu' => 'Side menu'), //Must provide key => value pairs for select options
                                'desc'     => __('Select the style of the menu in open state: simple list or lateral menu sidebar.', 'amos'),
                                'required' => array('responsive_menu_dropdown', 'equals', 1),
                                'default' => 'normal'
                            ),

                    
                    array(
                            'id'     => 'section-menu-resp-end',
                            'type'   => 'section',
                            'indent' => false,
                        ),//end menu on responsive section
                )
           ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Menu Options', 'amos'),
                        'fields' => array(

                            array(
                                'id' => 'menu_style',
                                'type' => 'select',
                                'title' => __('Menu Item Style', 'amos'),
                                'subtitle' => __('Select the style for the menu', 'amos'),
                                'options' => array('menu_1' => 'Simple style','menu_2' => 'With Border bottm with effect', 'menu_3' => 'With border top', 'menu_4' => 'Menu item with background', 'menu_5' => 'With border separators', 'menu_6' => 'Creative border effect', 'menu_7' => 'Menu item with gradient effect'), //Must provide key => value pairs for select options
                                'default' => 'menu_2'
                            ), 
                            array(
                                'id' => 'menu_7_color_1',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                
                                'title' => __('Menu item - gradient color 1', 'amos'),
                                'subtitle' => __('1st Background gradient color for menu item', 'amos'),
                                'default'  => array(
                                    'color' => '#fbfbfb',  
                                    'alpha' => '1.0'
                                ),
                                'validate' => 'colorrgba',
                                'required' => array('menu_style', 'equals', 'menu_7' ),
                            ),
                            array(
                                'id' => 'menu_7_color_2',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                
                                'title' => __('Menu item - gradient color 2', 'amos'),
                                'subtitle' => __('2nd Background gradient color for menu itemu', 'amos'),
                                'default'  => array(
                                    'color' => '#fbfbfb',  
                                    'alpha' => '1.0'
                                ),
                                'validate' => 'colorrgba',
                                'validate' => 'colorrgba',
                                'required' => array('menu_style', 'equals', 'menu_7' ),
                            ),

                            array( 
                                'id'       => 'menu_5_border',
                                'type'     => 'border',
                                'title'    => __('Menu items border separators', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'output'   => array('.menu_5 nav .menu > li'),
                                'left'    => false,
                                'bottom'   => false, 
                                'top'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border between menu items', 'amos'),
                                'default'  => array(
                                    'color'  => '#eee', 
                                    'border-style'  => 'solid',
                                    'border-right'    => '1px',
                                ),
                                'required' => array('menu_style', 'equals', 'menu_5' ),
                            ),


                            array(
                                'id' => 'menu_font_style',
                                'type' => 'typography',
                                'title' => __('Menu Item Typography', 'amos'),
                                //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
                                'font-weight'=>true,
                                'subsets'=>false, // Only appears if google is true and subsets not set to false
                                //'font-size'=>false,
                                'line-height'=>true,
                                //'word-spacing'=>true, // Defaults to false
                                'letter-spacing'=>true, // Defaults to false
                                //'color'=>false,
                                //'preview'=>false, // Disable the previewer 
                                'text-align' => true,
                                'text-transform' => true,
                                'output' => array('nav .menu > li > a, nav .menu > li.hasSubMenu:after', 'header#header .header_tools .vert_mid > a:not(#trigger-overlay), header#header .header_tools'), // An array of CSS selectors to apply this font style to dynamically
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font style for the menu', 'amos'),
                                'default' => array(
                                    'color' => "#012b43",
                                    'font-weight' => '600',
                                    'font-family' => 'Montserrat',
                                    'google' => true,
                                    'font-size' => '15px',
                                    'line-height' => '26px',
                                    'text-align' => 'center',
                                    'font-style' => 'normal',
                                    'text-transform' => 'capitalize',
                                    'letter-spacing' => '0px'
                                ),
                            ),

                            array(
                                'id' => 'menu_padding',
                                'type' => 'spacing',
                                'output' => array('nav .menu > li'), // An array of CSS selectors to apply this font style to
                                'mode' => 'padding', // absolute, padding, margin, defaults to padding
                                'top' => false, // Disable the top
                                //'right' => false, // Disable the right
                                'bottom' => false, // Disable the bottom
                                //'left' => false, // Disable the left
                                //'all' => true, // Have one field that applies to all
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                //'display_units' => 'false', // Set to false to hide the units if the units are specified
                                'title' => __('Menu Items padding', 'amos'),
                                'subtitle' => __('Adjust padding beetwen menu items ', 'amos'),
                                'desc' => __('Unit: px', 'amos'),
                                'default' => array('padding-left' => '15px', 'padding-right' => "15px")
                            ),


                            array(
                                'id' => 'menu_margin',
                                'type' => 'spacing',
                                'output' => array('nav .menu > li'), // An array of CSS selectors to apply this font style to
                                'mode' => 'margin', // absolute, padding, margin, defaults to padding
                                'top' => false, // Disable the top
                                //'right' => false, // Disable the right
                                'bottom' => false, // Disable the bottom
                                //'left' => false, // Disable the left
                                //'all' => true, // Have one field that applies to all
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                //'display_units' => 'false', // Set to false to hide the units if the units are specified
                                'title' => __('Menu Items Margin', 'amos'),
                                'subtitle' => __('Adjust margin beetwen menu items ', 'amos'),
                                'desc' => __('Unit: px', 'amos'),
                                'default' => array('margin-left' => '0px', 'margin-right' => "0px")
                            ), 
                        ),
                        'subsection' => true
                    ));
                    
                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Dropdown Options', 'amos'),
                        'fields' => array(
                            array(
                                'id' => 'dropdown_width',
                                'type' => 'dimensions',
                                'output' => array('nav .menu > li > ul.sub-menu', 'nav .menu > li > ul.sub-menu ul'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'height' => false,
                                'title' => __('Dropdown Width', 'amos'),
                                'subtitle' => __('units: px', 'amos'),
                                'desc' => __('', 'amos'),
                                'default' => array('width' => 220)
                            ),

                            array(
                                'id' => 'background_dropdown',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                'output' => array('nav .menu li > ul', '.amos_custom_menu_mega_menu', '.menu-small', '.header_tools .cart .content, .snap-drawer-left'),
                                'title' => __('Dropdown Background Color', 'amos'),
                                'subtitle' => __('Background Color for the dropdown in the menu', 'amos'),
                                'default'  => array(
                                    'color' => '#fbfbfb',  
                                    'alpha' => '1.0'
                                ),
                                'validate' => 'colorrgba'
                            ),

                            array(
                                'id' => 'dropdown_border_color',
                                'type' => 'color',
                                'output' => array('nav .amos_custom_menu_mega_menu > ul > li'),
                                'title' => __('Dropdown Right Border color', 'amos'),
                                'subtitle' => __('Dropdown right border color for navigation', 'amos'),
                                'default' => '#f7f7f7'
                            ),

                            array( 
                                'id' => 'dropdown_font',
                                'type' => 'typography',
                                'title' => __('Dropdown typography', 'amos'),
                                'font-family' => false,
                                'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-size'=>true,
                                'line-height'=>false,
                                'font-weight' => false,
                                'font-style' => false,
                                'letter-spacing'=>true, // Defaults to false
                                'color'=>true,
                                'preview' => false,
                                'text-align' => false,
                                'text-transform' => true,
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font style for the megamenu column title', 'amos'),
                                'output' => 'nav .menu li > ul.sub-menu li, .menu-small ul li a',
                                'default' => array(
                                    'color' => "#3d3d3d",
                                    'font-size' => '14px',
                                    'letter-spacing' => '0px',
                                    'text-transform' => 'capitalize'
                                ),
                            ),

                            array( 
                                'id' => 'megamenu_title',
                                'type' => 'typography',
                                'title' => __('Megamenu title', 'amos'),
                                'font-family' => false,
                                'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-size'=>true,
                                'line-height'=>false,
                                'font-weight' => true,
                                'font-style' => false,
                                'letter-spacing'=>true, // Defaults to false
                                'color'=>true,
                                'preview' => false,
                                'text-align' => false,
                                'text-transform' => true,
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font style for the megamenu column title', 'amos'),
                                'output' => 'nav .amos_custom_menu_mega_menu ul>li h6, .menu-small ul.menu .amos_custom_menu_mega_menu h6, .menu-small ul.menu > li > a ',
                                'default' => array(
                                    'color' => "#5198ff",
                                    'font-size' => '14px',
                                    'font-weight' => '400',
                                    'letter-spacing' => '1px',
                                    'text-transform' => 'capitalize'
                                ),
                            ),

                            array(
                                'id' => 'cart_dropdown_button',
                                'type' => 'select',
                                'title' => __('Cart Dropdown in header button style', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'options' => array('dark' => 'Dark', 'light' => 'Light'), //Must provide key => value pairs for select options
                                'default' => 'dark'
                            ),
                        ),
                        'subsection' => true
                    ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Top Widgetized Area', 'amos'),
                        'fields' => array(
                            array(
                                'id' => 'top_navigation',
                                'type' => 'switch',
                                'title' => __('Show Top Navigation', 'amos'),
                                'subtitle' => __('Switch On to enable top navigation', 'amos'),
                                'default' => 0// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'top_navigation_transparency',
                                'type' => 'switch',
                                'title' => __('Make Transparency TOP WIDGETIZED', 'amos'),
                                'subtitle' => 'If you active this option the header should be shown on top of the slider',
                                'default' => 0,
                            ),
                            array(
                                'id' => 'topnav_bg',
                                'type' => 'color',
                                'mode' => 'background-color',
                                'output' => array('.top_nav', '.top_nav .woocommerce-currency-switcher-form a.dd-option'),
                                'title' => __('Background Color', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'default' => '#fff',
                                'validate' => 'color',
                            ),


                            array( 
                                'id'       => 'topnav_border_top',
                                'type'     => 'border',
                                'title'    => __('Top Navigation Border Top', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'output'   => array('.top_nav'),
                                'right'    => false,
                                'bottom'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border top for the top navigation', 'amos'),
                                'default'  => array(
                                    'color'  => '', 
                                    'border-style'  => 'solid',
                                    'border-top'    => '0px',
                                )
                            ),

                            array( 
                                'id'       => 'topnav_border_bottom',
                                'type'     => 'border',
                                'title'    => __('Top Navigation Border Bottom', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'output'   => array('.top_nav'),
                                'right'    => false,
                                'top'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border bottom for the top navigation', 'amos'),
                                'default'  => array(
                                    'color'  => '#f2f2f2', 
                                    'border-style'  => 'solid',
                                    'border-bottom'    => '1px',
                                )
                            ),

                            array( 
                                'id'       => 'topnav_border_bottom_container',
                                'type'     => 'border',
                                'title'    => __('Top Navigation Border Bottom in Container', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'output'   => array('.top_nav .container'),
                                'right'    => false,
                                'top'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border bottom for the top navigation container', 'amos'),
                                'default'  => array(
                                    'color'  => '#f2f2f2', 
                                    'border-style'  => 'solid',
                                    'border-bottom'    => '0px',
                                )
                            ),

                            array(
                                'id' => 'topnav_font_style',
                                'type' => 'typography',
                                'title' => __('Typography', 'amos'),
                                //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => true, // Select a backup non-google font in addition to a google font
                                //'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                                //'subsets'=>false, // Only appears if google is true and subsets not set to false
                                //'font-size'=>false,
                                'line-height'=>false,
                                //'word-spacing'=>true, // Defaults to false
                                //'letter-spacing'=>true, // Defaults to false 
                                //'color'=>false,
                                //'preview'=>false, // Disable the previewer
                                'text-align' => false,
                                'output' => array('.top_nav'),
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font style for top nav', 'amos'),
                                'default' => array(
                                    'color' => "#262626",
                                    'font-family' => 'Karla',
                                    'google' => true,
                                    'font-size' => '13px'
                                ),
                            ),

                            array(
                                'id' => 'topnav_height',
                                'type' => 'dimensions', 
                                'output' => array('.top_nav, .top_nav .widget'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => __('Top Nav Height', 'amos'),
                                'subtitle' => __('units: px', 'amos'),
                                'desc' => __('', 'amos'),
                                'default' => array('height' => 40)
                            ),
                        ),
                        'subsection' => true
                   ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Default Page Header', 'amos'),
                        'fields' => array(
                            array(
                                'id' => 'page_header_bool',
                                'type' => 'switch',
                                'title' => __('Active Page Header', 'amos'),
                                'subtitle' => __('Switch On to enable page header for pages, posts (For each post or page you can add custom options)', 'amos'),
                                'default' => 1// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'page_header_height',
                                'type' => 'dimensions',
                                'output' => array('.header_page'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => __('Page Header Height', 'amos'),
                                'subtitle' => __('units: px', 'amos'),
                                'desc' => __('', 'amos'),
                                'default' => array('height' => 100)
                            ),

                            array(
                                'id' => 'page_header_style',
                                'type' => 'select',
                                'title' => __('Page header style', 'amos'),
                                'subtitle' => __('Select the style for the default page header', 'amos'),
                                'options' => array('normal' => 'Basic (Left with breadcrumbs)', 'centered' => 'Centered'), //Must provide key => value pairs for select options
                                'default' => 'normal'
                            ),

                            array(
                                'id' => 'page_header_f_color',
                                'type' => 'color',
                                'output' => array('.header_page'),
                                'title' => __('Page header font color', 'amos'),
                                'subtitle' => __('Select the color for the title or breadcrumbs in page header', 'amos'),
                                'default' => '#333',
                                'validate' => 'color',
                            ),

                            array(
                                'id' => 'page_header_background',
                                'type' => 'background',
                                'output' => array('.header_page'),
                                'title' => __('Page header background', 'amos'),
                                'subtitle' => __('Page Header background with image, color, etc.', 'amos'),
                                'default' => array('background-color' => '#f5f5f5')
                            ),

                            array( 
                                'id'       => 'page_header_border',
                                'type'     => 'border',
                                'title'    => __('Page header Border Bottom', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'output'   => array('.header_page, #slider-fullwidth'),
                                'right'    => false,
                                'top'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border bottom for page header', 'amos'),
                                'default'  => array(
                                    'color'  => '', 
                                    'border-style'  => 'solid',
                                    'border-bottom'    => '0px'
                                )
                            ),
                        ),
                        'subsection' => true
                    ));
                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Sticky Nav', 'amos'),
                        'fields' => array(
                            array(
                                'id' => 'sticky',
                                'type' => 'switch',
                                'title' => __('Sticky Header', 'amos'),
                                'subtitle' => __('Switch on to active sticky header (fixed position on header)', 'amos'),
                                "default" => 0,
                            ),
                            array(
                                'id' => 'sticky_header_height',
                                'type' => 'dimensions',
                                'output' => array('.sticky_header header#header .row-fluid .span12', '.sticky_header .header_wrapper'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => __('Sticky Header Height', 'amos'),
                                'subtitle' => __('units: px', 'amos'),
                                'desc' => __('', 'amos'),
                                'default' => array('height' => 60)
                            ),
                            
                            array(
                                'id' => 'sticky_header_background',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                'transparent' => true,
                                'validate' => 'colorrgba',
                                'output' => array('.sticky_header header#header'),
                                'title' => __('Sticky Background', 'amos'),
                                'subtitle' => __('Header background with image, color, etc.', 'amos'),
                                'default' => array(
                                    'color' => '#fff',
                                    'alpha' => '0.80'
                                ),
                            ),

                            array(
                                'id' => 'sticky_logo',
                                'type' => 'switch',
                                'title' => __('Sticky Logo', 'amos'),
                                'subtitle' => __('Remove the Logo from the main Header and shows only on stiky', 'amos'),
                                "default" => 0,
                                'required' => array('sticky', 'equals', 1),
                            ),
                        ),
                        'subsection' => true
                   ));
            

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Styling Options', 'amos'),
                'fields' => array(
                    array(
                        'id' => 'primary_color', 
                        'type' => 'color',
                        'output' => array('.header_11 nav li > a:hover, .header_11 nav li.current-menu-item > a, .header_11 nav li.current-menu-parent > a ','.header_10 nav li > a:hover, .header_10 nav li.current-menu-item > a, .header_10 nav li.current-menu-parent > a ','.header_9 nav li > a:hover, .header_9 nav li.current-menu-item > a, .header_9 nav li.current-menu-parent > a ','.header_8 nav li > a:hover, .header_8 nav li.current-menu-item > a, .header_8 nav li.current-menu-parent > a ','.header_7 nav li > a:hover, .header_7 nav li.current-menu-item > a, .header_7 nav li.current-menu-parent > a ','.header_5 nav li > a:hover, .header_5 nav li.current-menu-item > a, .header_5 nav li.current-menu-parent > a ','.header_3 nav li > a:hover, .header_3 nav li.current-menu-item > a, .header_3 nav li.current-menu-parent > a ','.header_2 nav li > a:hover, .header_2 nav li.current-menu-item > a, .header_2 nav li.current-menu-parent > a ', '.amos_slider .swiper-slide .buttons.colors-light a.colored:hover *',  '.services_steps .icon_wrapper i', '.testimonial_carousel .item .param span', '.services_large .icon_wrapper i', '.services_medium.style_1 i', '.services_small dt i', '.single_staff .social_widget li a:hover i', '.list li.titledesc dl dt i', '.list li.simple i', '.page_parents li a:hover', 'a:hover', '.header_1 nav li.current-menu-item > a','.blog-article h1 a:hover',  '.header_1 nav li.current-menu-item:after', '.header_1 nav li > a:hover', '.header_1 nav li:hover:after', 'header#header .header_tools > a:hover', 'footer#footer a:hover', 'aside ul li:hover:after', '.highlights', '.blog-article .tags','.creative-single.background--light .title .categories a:hover','.creative-single.background--light .title a:hover', '.menu_2 nav li > a:hover, .menu_2 nav li.current-menu-item > a, .menu_2 nav li.current-menu-parent > a ','.menu_1 nav li.current-menu-item > a','.blog-article h1 a:hover',  '.menu_1 nav li.current-menu-item:after', '.menu_1 nav li > a:hover', '.menu_3 nav li > a:hover, .menu_3 nav li.current-menu-item > a, .menu_3 nav li.current-menu-parent > a '),
                        'title' => __('Primary Color', 'amos'),
                        'subtitle' => __('Color for links, highlighted text and other', 'amos'),
                        'default' => '#8e00fe',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'body_font_color',
                        'type' => 'color',
                        'output' => array('body, footer#footer a:hover'),
                        'title' => __('Body Font Color', 'amos'),
                        'subtitle' => __('Base font color for the main content, in light sections', 'amos'),
                        'default' => '#9e9e9e',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'link_font_color',
                        'type' => 'color',
                        'output' => array('.header :not(#navigation) a, .top_wrapper p a'),
                        'title' => __('Link Font Color', 'amos'),
                        'subtitle' => __('Font color of hyperlinks in the page', 'amos'),
                        'default' => '#383838',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'link_font_color_hover',
                        'type' => 'color',
                        'output' => array('a:hover'),
                        'title' => __('Link Font Color on hover', 'amos'),
                        'subtitle' => __('Font color of hyperlinks on hover in the page', 'amos'),
                        'default' => '#8e00fe',
                        'validate' => 'color',
                    ),

                   


                    array(
                        'id' => 'headings_font_color',
                        'type' => 'color',
                        'output' => array('h1,h2,h3,h4,h5,h6', '.portfolio_single ul.info li .title', '.skill_title', '.creative-single.background--light .title .info','.creative-single.background--light .title .categories, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price', '.testimonial_cycle .item p', '.testimonial_cycle .item .param span, .single-portfolio .custom_layout .post-like', '.countdown_amount'),
                        'title' => __('Headings Font Color', 'amos'),
                        'subtitle' => __('Base font color for headings, in light sections', 'amos'),
                        'default' => '#012b43',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'base_border_color',
                        'type' => 'color',
                        'title' => __('Base Border Color', 'amos'),
                        'subtitle' => __('Base border color around the theme', 'amos'), 
                        'default' => '#e7e7e7',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'highlighted_background_main',
                        'type' => 'color',
                        'output' => array('.p_pagination .pagination span', ' .accordion.style_1 .accordion-heading .accordion-toggle, .accordion.style_2 .accordion-heading .accordion-toggle, .services_medium.style_1 .icon_wrapper, .skill'),
                        'title' => __('Highlighted Background', 'amos'),
                        'subtitle' => __('Highlighted Background in main content, white sections', 'amos'), 
                        'mode' => 'background-color',
                        'default' => '#f5f5f5',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'body_background',
                        'type' => 'background',
                        'output' => array('body, html, .top_space, .bottom_space', '.viewport'),
                        'title' => __('Background', 'amos'),
                        'subtitle' => __('Add a background to body', 'amos'),
                        'default' => 'transparent',
                    ),

                    array(
                        'id' => 'page_content_background_overall',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'output' => array('#content'),
                        'title' => __('Content Background', 'amos'),
                        'subtitle' => __('Add a background to content', 'amos'),
                        'default' => 'transparent',
                    ),
                    



                )
            ));
            
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Default Page Header', 'amos'),
                'fields' => array(
                        array( 
                            'id' => 'page_header_normal_typography',
                            'type' => 'typography',
                            'title' => __('Normal Style No Subtitle Title Typography', 'amos'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.normal h1',
                            'default' => array(
                                'font-size' => '24px',
                                'font-weight' => '400',
                                'text-transform' => 'capitalize'
                            ),
                        ),

                        array( 
                            'id' => 'page_header_normal_typography_subtitle_title',
                            'type' => 'typography',
                            'title' => __('Normal Style With Subtitle Title Typography', 'amos'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.normal .titles h1',
                            'default' => array(
                                'font-size' => '24px',
                                'font-weight' => '400',
                                'text-transform' => 'capitalize' 
                            ),
                        ),
                        
                        array( 
                            'id' => 'page_header_normal_typography_subtitle_subtitle',
                            'type' => 'typography',
                            'title' => __('Normal Style With Subtitle Subtitle Typography', 'amos'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.normal .titles h3',
                            'default' => array(
                                'font-size' => '15px',
                                'font-weight' => '400',
                                'text-transform' => 'none' 
                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_nosub_title',
                            'type' => 'typography',
                            'title' => __('Centered Style No Subtitle Title Typography', 'amos'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>true,
                            'font-weight' => true,
                            'font-style' => true,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.centered h1, .header_page.left h1',
                            'default' => array(
                                'font-size' => '60px',
                                'font-weight' => '500',
                                'text-transform' => 'none',
                                'line-height' => '70px',
                                'font-style' => 'normal'

                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_subtitle_title',
                            'type' => 'typography',
                            'title' => __('Centered Style With Subtitle Title Typography', 'amos'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>true,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>true, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true, 
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.centered .titles h1, .header_page.with_subtitle.left .titles h1',
                            'default' => array(
                                'font-size' => '60px',
                                'font-weight' => '500',
                                'text-transform' => 'none',
                                'letter-spacing' => '0px',
                                'line-height' => '70px',
                                

                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_subtitle_subtitle',
                            'type' => 'typography',
                            'title' => __('Centered Style With Subtitle Subtitle Typography', 'amos'),
                            'font-family' => true,
                            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>true, 
                            'font-weight' => false,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.centered .titles h3, .header_page.with_subtitle.left .titles h3',
                            'default' => array(
                                'font-size' => '22px',
                                'font-family' => 'Courgette',
                                'font-weight' => '400', 
                                'text-transform' => 'none',
                                'line-height' => '30px',
                             

                            ),
                        ),
                        
                        array(
                                'id' => 'page_header_design_style',
                                'type' => 'select',
                                'title' => __('Page Header Design Style', 'amos'),
                                'subtitle' => __('Select the design style for the default page header', 'amos'),
                                'options' => array('normal' => 'Basic no padding and background, with little border', 'padd' => 'With padding and background'), //Must provide key => value pairs for select options
                                'default' => 'normal'
                        ),

                        array(
                            'id' => 'page_header_padd_bg_title',
                            'title' => __('Page Header with padding style title bg color', 'amos'),
                            'mode' => 'background-color',
                            'type' => 'color_rgba',
                            'default'  => array(
                                'color' => '#000', 
                                'alpha' => '0.70'
                            ),
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'colorrgba',
                        ),
                        array(
                            'id' => 'page_header_padd_bg_subtitle',
                            'title' => __('Page Header with padding style subtitle bg color', 'amos'),
                            'mode' => 'background-color',
                            'type' => 'color_rgba',
                            'default'  => array(
                                'color' => '#fff', 
                                'alpha' => '0.70'
                            ),
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'colorrgba',
                        ),
                        array(
                            'id' => 'page_header_padd_bg_subtitle_font',
                            'title' => __('Page Header with padding style subtitle font color', 'amos'),
                            'mode' => 'color',
                            'type' => 'color',
                            'default'  => '#222',
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'color',
                        )
                ),
                'subsection' => true
           ));

             Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Footer Styling', 'amos'),
                'fields' => array(
                    array( 
                        'id' => 'fppter_headings_typography',
                        'type' => 'typography',
                        'title' => __('Footer Headings Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color'=>true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => 'footer#footer .widget-title',
                        'default' => array(
                            'font-size' => '15px',
                            'color' => '#f2f2f2',
                            'font-weight' => '600', 
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '2px'
                        ),
                    ),

                    array(
                        'id' => 'footer_body_typography',
                        
                        'type' => 'typography',
                        'title' => __('Footer Body Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => false, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color'=>true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => array('footer#footer, footer#footer .contact_information dd .title'),
                        'default' => array(
                            'color' => '#bdbdbd',
                            'font-size' => '15px',
                            'line-height' => '22px'
                        ),
                    ),

                    array(
                        'id' => 'footer_links_color',
                        'type' => 'color',
                        'output' => array('footer#footer a, footer#footer .contact_information dd p'),
                        'title' => __('Footer links font Color', 'amos'),
                        'subtitle' => __('Select the font color for links' ,  'amos'),
                        'default' => '#bbbbbb',
                        'validate' => 'color',
                    ),
                    
                    array(
                        'id' => 'footer_background_color',
                        'type' => 'background',
                        'output' => array('footer#footer .inner'),
                        'title' => __('Footer Background', 'amos'),
                        'subtitle' => __('Background for the footer main part' ,  'amos'), 
                        'default' => array('background-color' => '#262626')
                    ),

                    array(
                        'id' => 'copyright_background_color',
                        'type' => 'color',
                        'output' => array('#copyright, footer .tagcloud a'),
                        'title' => __('Copyright Background Color', 'amos'),
                        'subtitle' => __('Color for the latest part of the footer' ,  'amos'), 
                        'mode' => 'background-color',
                        'default' => '#151515',
                        'validate' => 'color',
                    ),

                    array( 
                        'id'       => 'footer_border_top',
                        'type'     => 'border',
                        'title'    => __('Footer Border Top', 'amos'),
                        'subtitle' => __('', 'amos'),
                        'output'   => array('footer#footer, #copyright'),
                        'right'    => false,
                        'top'      => true, 
                        'left'     => false,
                        'bottom'   => false,
                        'color'    => true,
                        'style'    => true, 
                        'desc'     => __('Add Border top for footer', 'amos'),
                        'default'  => array(
                            'color'  => '', 
                            'border-style'  => 'solid',
                            'border-top'    => '0px'
                        )
                    ),

                    

                    array(
                        'id' => 'footer_social_icons_font_color',
                        'type' => 'color',
                        'output' => array('.footer_social_icons.circle li a i'),
                        'title' => __('Social Icons Circle Icon Color', 'amos'),
                        'subtitle' => __('Circle icon color' ,  'amos'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),


                ),
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Blog Styling', 'amos'),
                'fields' => array(
                    array( 
                        'id' => 'blog_title_typography',
                        'type' => 'typography',
                        'title' => __('Blog Title Typography', 'amos'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.standard-style .content h1, .blog-article.alternate-style .content h1, .blog-article.timeline-style .content h1, .blog-article.fullscreen-single h1, .blog-article.grid-style .content h1, .related_posts .blog-article.grid-style .content h3, .blog-article.standard-style .content .quote .text, .latest_blog .format-quote .text, .blog-article.alternate-style .content .quote .text, .recent_news.vertical .blog-item h5',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-weight' => '600',
                            'color' => '#012b43',
                            'text-transform' => 'capitalize', 
                            'line-height' => '34px',
                            'font-size' => '24px'
                        ),
                    ),
                    
                    array( 
                        'id' => 'blog_info_typography',
                        'type' => 'typography',
                        'title' => __('Blog Info List Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true,  
                        'font-weight' => false, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true,
                        'preview' => false, 
                        'text-align' => false,
                        'text-transform' => false, 
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.alternate-style .info, .blog-article.timeline-style .info, .blog-article.standard-style .info, .blog-article.grid-style .info, .fullscreen-single .info, .recent_news .blog-item .info, .latest_blog .blog-item .info, .blog-article .extra_info, .blog-article .extra_info a, .blog-article .readmore, .comment span.date ',
                        'default' => array(
                            'color' => '#585858',
                            'font-size' => '12px',
                            'line-height' => '22px' 
                        ),
                    ),

                    array( 
                        'id' => 'blog_info_typography_icon',
                        'type' => 'typography',
                        'title' => __('Blog Info List Icon Size', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false,  
                        'font-weight' => false, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => false,
                        'preview' => false, 
                        'text-align' => false,
                        'text-transform' => false, 
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.alternate-style .info i, .blog-article.timeline-style .info i, .blog-article.standard-style .info i, .fullscreen-single .info i, .latest_blog .blog-item .info i, .recent_news .blog-item .info i,.blog-article .extra_info i, .blog-article .post-like i, .blog-article .extra_info .comment_count i',
                        'default' => array(
                            'font-size' => '16px'
                        ),
                    ),

                    array(
                        'id' => 'timeline_box_shadow',
                        'type' => 'switch',
                        'title' => __('Active Timeline (or for masonry) Box Shadow', 'amos'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'timeline_bg_color',
                        'type' => 'color',
                        'output' => array('.blog-article.timeline-style .post_box, .blog-article.grid-style .gridbox'),
                        'title' => __('Timeline (or masonry) post box bg color', 'amos'),
                        'mode' => 'background-color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'fullscreen_blog_box_bg', 
                        'output' => array('.fullscreen-blog-article .content'),
                        'title' => __('Fullscreen Blog Content Box BG', 'amos'),
                        'mode' => 'background-color',
                        'type' => 'color_rgba',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba',
                    )
                ),
                'subsection' => true
           ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Sidebar Styling', 'amos'),
                'fields' => array(
                    array( 
                        'id' => 'sidebar_widget_title',
                        'type' => 'typography',
                        'title' => __('Widget Title', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => 'aside .widget-title, .wpb_widgetised_column .widget-title, .portfolio_single h4',
                        'default' => array(
                            'font-weight' => '600',
                            'color' => '#012b43',
                            'font-size' => '15px',
                            'text-transform' => 'uppercase', 
                            'line-height' => '20px',
                            'letter-spacing' => '1px'
                        ),
                    ),
                    
                    array(
                        'id' => 'sidebar_widget_title_margin',
                        'type' => 'spacing',
                        'output' => array('aside .widget-title, .wpb_widgetised_column .widget-title'), // An array of CSS selectors to apply this font style to
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => __('Widget Title Margin Bottom', 'amos'),
                        'desc' => __('Unit: px', 'amos'),
                        'default' => array('margin-bottom' => '24px')
                    ),

                    array(
                        'id' => 'sidebar_widget_margin',
                        'type' => 'spacing',
                        'output' => array('aside .widget, .wpb_widgetised_column .widget'), // An array of CSS selectors to apply this font style to
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => __('Widget Margin Bottom', 'amos'),
                        'desc' => __('Unit: px', 'amos'),
                        'default' => array('margin-bottom' => '35px')
                    ),
                    
                    array(
                        'id' => 'sidebar_tagcloud_bg',
                        'type' => 'color',
                        'output' => array('aside .tagcloud a, .wpb_widgetised_column .tagcloud a'),
                        'title' => __('Sidebar Tagcloud Background', 'amos'),
                        'mode' => 'background-color',
                        'default' => '#f5f5f5',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'sidebar_tagcloud_border',
                        'type'     => 'border',
                        'title'    => __('Sidebar Tagcloud Border', 'amos'),
                        'subtitle' => __('', 'amos'),
                        'output'   => array('aside .tagcloud a, .wpb_widgetised_column .tagcloud a'),
                        'right'    => true,
                        'top'      => true, 
                        'left'     => true,
                        'bottom'   => true,
                        'color'    => true,
                        'style'    => true, 
                        'desc'     => __('Add Border top for footer', 'amos'),
                        'default'  => array(
                            'color'  => '#e5e5e5', 
                            'border-style'  => 'solid',
                            'border-width'    => '1px'
                        )
                    ),

                    array(
                        'id' => 'sidebar_tagcloud_color',
                        'type' => 'color',
                        'output' => array('aside .tagcloud a, .wpb_widgetised_column .tagcloud a'),
                        'title' => __('Sidebar Tagcloud Font color', 'amos'),
                        'mode' => 'color',
                        'default' => '#444',
                        'validate' => 'color',
                    )

                ), 
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Sliders Styling', 'amos'),
                'fields' => array(
                    array(
                        'id' => 'amos_slider_wrapper_bg',
                        'type' => 'color',
                        'output' => array('.amos_slider_wrapper'),
                        'title' => __('Amos Slider Wrapper Background Color', 'amos'),
                        'mode' => 'background-color',
                        'default' => '#222',
                        'validate' => 'color'
                    ),
                ),
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Filters Styling', 'amos'),
                'fields' => array(

                    array(
                        'id'       => 'filter_align',
                        'type'     => 'button_set',
                        'title'    => __('Filters align', 'amos'),
                        'subtitle' => __('Select the position of filters', 'amos'),
                        'desc'     => __('Left/Center/Right positions to display portfolio or blog filters.', 'amos'),
                        'options' => array(
                            'left' => 'Left', 
                            'center' => 'Center', 
                            'right' => 'Right'
                         ), 
                        'default' => 'center'
                    ),

                    array( 
                        'id' => 'portfolio_filter_basic_typography',
                        'type' => 'typography',
                        'title' => __('Portfolio, Blog Filter & FAQ Filter Basic Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '#portfolio-filter ul li a, #blog-filter ul li a',
                        'default' => array(
                            'font-weight' => '400',
                            'font-size' => '15px',
                            'color' => '#262626',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '0px'
                        ),
                    ),
                    
                    array(
                        'id' => 'portfolio_filter_basic_typography_active',
                        'type' => 'color',
                        'output' => array('#portfolio-filter ul li.mixitup-control-active a, #blog-filter ul li.mixitup-control-active a'),
                        'title' => __('Portfolio, BLog Filter & FAQ Filter Basic Typography (Active)', 'amos'),
                        'mode' => 'color',
                        'default' => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_bg',
                        'type' => 'color',
                        'output' => array('.content_portfolio.fullwidth .filter-row'),
                        'title' => __('Portfolio Filter Fullwidth Background Color', 'amos'),
                        'mode' => 'background-color',
                        'default' => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_link_color',
                        'type' => 'color_rgba',
                        'output' => array('.content_portfolio.fullwidth #portfolio-filter ul li a'),
                        'title' => __('Portfolio Filter Fullwidth Item color', 'amos'),
                        'mode' => 'color',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '0.80'
                        ),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_link_color_hover',
                        'type' => 'color_rgba',
                        'output' => array('.content_portfolio.fullwidth #portfolio-filter ul li a:hover'),
                        'title' => __('Portfolio Filter Fullwidth Item hover color ', 'amos'),
                        'mode' => 'color',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba',
                    ),

                ),
                'subsection' => true,
           ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Portfolio Styling', 'amos'),
                'fields' => array(

                    array(
                        'id' => 'portfolio_overlay_style',
                        'type' => 'select',
                        'title' => __('Slect the portfolio overlay style', 'amos'),
                        'options' => array('background' => 'With background', 'gradient' => 'With Gradient Background', 'custom_gradient' => 'Custom Gradient Background'),
                        'default' => 'custom_gradient'
                    ),

                    array(
                        'id' => 'portfolio_overlay_bg',
                        'type' => 'color_rgba',
                        'output' => array('.portfolio-item.overlayed .tpl2 .bg:after'),
                        'title' => __('Portfolio Overlay BG Color ', 'amos'),
                        'mode' => 'background-color',
                        'default'  => array(
                            'color' => '#5198ff',  
                            'alpha' => '0.82'
                        ),
                        'required' => array('portfolio_overlay_style', 'equals', 'background'),
                        'validate' => 'colorrgba',
                    ),
                    array(
                        'id' => 'portfolio_overlay_bg_grad1',
                        'type' => 'color_rgba',
                        //'output' => array('.portfolio-item.overlayed .tpl2 .bg'),
                        'title' => __('Gradient 1st color', 'amos'),
                        'mode' => 'background-color',
                        'default'  => array(
                            'color' => '#1673ff',  
                            'alpha' => '0.82'
                        ),
                        'required' => array('portfolio_overlay_style', 'equals', 'custom_gradient'),
                        'validate' => 'colorrgba',
                    ),
                    array(
                        'id' => 'portfolio_overlay_bg_grad2',
                        'type' => 'color_rgba',
                        //'output' => array('.portfolio-item.overlayed .tpl2 .bg'),
                        'title' => __('Gradient 2nd color ', 'amos'),
                        'mode' => 'background-color',
                        'default'  => array(
                            'color' => '#6c45c6',  
                            'alpha' => '0.82'
                        ),
                        'required' => array('portfolio_overlay_style', 'equals', 'custom_gradient'),
                        'validate' => 'colorrgba',
                    ),
                    array( 
                        'id' => 'portfolio_overlay_title',
                        'type' => 'typography',
                        'title' => __('Portfolio Overlay Title Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.overlayed h4',
                        'default' => array(
                            'font-weight' => '600',
                            'color' => '#fff',
                            'text-transform' => 'capitalize',
                            'letter-spacing' => '0px'
                        ),
                    ),

                    array( 
                        'id' => 'portfolio_overlay_subtitle',
                        'type' => 'typography',
                        'title' => __('Portfolio Overlay Subtitle Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.overlayed h6',
                        'default' => array(
                            'font-size' => '14px',
                            'font-weight' => '400',
                            'color' => '#fff',
                            'text-transform' => 'none'
                        ),
                    ),
                    
                    array(
                        'id' => 'portfolio_grayscale_bg',
                        'type' => 'color',
                        'output' => array('.portfolio-item.grayscale .project'),
                        'title' => __('Portfolio Grayscale Background', 'amos'),
                        'mode' => 'background-color',
                        'default' => '#212121',
                        'validate' => 'color',
                    ),

                    array( 
                        'id' => 'portfolio_grayscale_title',
                        'type' => 'typography',
                        'title' => __('Portfolio Grayscale Title Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.grayscale .project h5',
                        'default' => array(
                            'color' => '#fff',
                            'font-weight' => '500'
                        ),
                    ),
 
                    array(
                        'id' => 'portfolio_grayscale_subtitle',
                        'type' => 'color',
                        'output' => array('.portfolio-item.grayscale .project h6'),
                        'title' => __('Portfolio Grayscale Subtitle Color', 'amos'),
                        'mode' => 'color',
                        'default' => '#eaeaea',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_basic_overlay_bg',
                        'type' => 'color_rgba',
                        'output' => array('.portfolio-item.basic .bg'),
                        'title' => __('Portfolio Basic Overlay', 'amos'),
                        'mode' => 'background-color',
                        'default' => array(
                            'color' => '#fff',
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba',
                    ),
                    array(
                        'id' => 'portfolio_parallax_bg',
                        'type' => 'color_rgba',
                        'output' => array('.portfolio-item.parallax .content'),
                        'title' => __('Parallax Content Box Background', 'amos'),
                        'mode' => 'background-color',
                        'default' => array(
                            'color' => '#fff',
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'portfolio_basic_overlay_icon_color',
                        'type' => 'color',
                        'output' => '.portfolio-item.basic .link',
                        'title' => __('Portfolio Basic Icon Color', 'amos'),
                        'mode' => 'color',
                        'default' => '#000',
                        'validate' => 'color',
                    ),

                    array( 
                        'id' => 'portfolio_basic_title',
                        'type' => 'typography',
                        'title' => __('Portfolio Basic/Parallax Title Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.basic .show_text h5, .portfolio-item.parallax .content h3',
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '500',
                            'text-transform' => 'capitalize',
                            'letter-spacing' => '0px',
                            'text-align' => 'left'
                        ),
                    ),

                    array( 
                        'id' => 'portfolio_basic_subtitle',
                        'type' => 'typography',
                        'title' => __('Portfolio Basic Subtitle Typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.basic .show_text h6,.portfolio-item.parallax .content',
                        'default' => array(
                            'color' => '#565656',
                            'font-weight' => '400',
                            'text-align' => 'left'
                        ),
                    ),

                    

                ),
                'subsection' => true,
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Elements Styling', 'amos'),
                'fields' => array(
                    array( 
                        'id' => 'toggle_title_typography',
                        'type' => 'typography',
                        'title' => __('Toggle title typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.accordion.style_2 .accordion-heading .accordion-toggle, .accordion.style_1 .accordion-heading .accordion-toggle, .accordion.style_3 .accordion-heading .accordion-toggle',
                        'default' => array(
                            'color' => '#555',
                            'font-weight' => '600',
                            'font-size' => '14px',
                            'text-transform' => 'none',
                            'letter-spacing' => '1px'
                        ),
                    ),

                    array(

                        'id' => 'tooggle_bg_color',
                        'type' => 'background',
                        'output' => '.accordion-heading',
                        'title' => __('Set the accordion background color', 'amos'),
                        'default' => '#f6f6f6'

                        ),

                    array(

                        'id' => 'toggle_active_color',
                        'type' => 'color',
                        'output' => ' .accordion.style_2 .accordion-heading.in_head .accordion-toggle, .accordion.style_3 .accordion-heading.in_head .accordion-toggle',
                        'title' => __('Activated Toggle Font Color', 'amos'),
                        'mode' => 'color',
                        'default' => '#5198ff',
                        'validate' => 'color',
                    ),

                    array(

                        'id' => 'tabs_background_color',
                        'type' => 'background',
                        'output' => '.tabbable.tabs-top.style_1 .nav.nav-tabs li.active a',
                        'title' => __('Set the tabs active state background color', 'amos'),
                        'default' => 'transparent',  

                    ),

                    array(

                        'id' => 'tabs_font_color',
                        'type' => 'color',
                        'output' => '.tabbable.tabs-top.style_1 .nav.nav-tabs li.active a',
                        'title' => __('Set the tabs active font color', 'amos'),
                        'default' => '#fff'


                    ),

                    array( 
                        'id' => 'block_title_text_above',
                        'type' => 'typography',
                        'title' => __('Block Title Element - text above the title', 'amos'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'line-height' => true,
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title .text_above',
                        'default' => array(
                            'color' => '#879298',
                            'font-family' => 'Open Sans',
                            'font-weight' => '600',
                            'font-size'  => '14px',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '2px',
                            'line-height' => '28px',
                            'text-align' => 'center'
                        ),
                    ),

                    array( 
                        'id' => 'block_title_column_title',
                        'type' => 'typography',
                        'title' => __('Block Title Element (Column) Title', 'amos'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'line-height' => true,
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.column_title h1',
                        'default' => array(
                            'color' => '#012b43',
                            'font-family' => 'Montserrat',
                            'font-weight' => '700',
                            'text-transform' => 'none',
                            'letter-spacing' => '0px',
                            'line-height' => '52px',
                            'text-align' => 'left'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_column_subtitle',
                        'type' => 'typography',
                        'title' => __('Block Title Element (Column) Subtitle', 'amos'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.column_title h4',
                        'default' => array(
                            'color' => '#879298',
                            'font-weight' => '400',
                            'text-transform' => 'none',
                            'text-align' => 'left',
                            'font-family'=>'Open Sans',
                            'font-size' => '15px',
                            'line-height' => '28px'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_section_title',
                        'type' => 'typography',
                        'title' => __('Block Title Element (Section) Title', 'amos'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.section_title h1',
                        'default' => array(
                            'color' => '#012b43',
                            'font-family' => 'Montserrat',
                            'font-weight' => '700',
                            'text-transform' => 'capitalize',
                            'line-height' => '52px',
                            'letter-spacing' => '0px'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_section_desc',
                        'type' => 'typography',
                        'title' => __('Block Title Element (Section) Desc', 'amos'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.section_title p',
                        'default' => array(
                            'font-family' => 'Open Sans',
                            'color' => '#879298',
                            'font-weight' => '400',
                            'text-transform' => '',
                            'line-height' => '28px',
                            'font-size' => '15px',
                            'letter-spacing' => '0px'
                        ),
                    ),

                    array( 
                        'id' => 'animated_counter_typ',
                        'type' => 'typography',
                        'title' => __('Animated Counters Typography', 'amos'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.odometer',
                        'default' => array(
                            'color' => '#5198ff',
                            'font-weight' => '500',
                            'font-size' => '38px',
                            'line-height' => '48px',
                            'letter-spacing' => '0px',
                            'font-family' => 'Montserrat'
                        ),
                    ),
                    array( 
                        'id' => 'testimonial_text',
                        'type' => 'typography',
                        'title' => __('Testimonial typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => false,
                        'line-height' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.testimonial_carousel .item p',
                        'default' => array(
                            'color' => '#444',
                            'font-weight' => '400',
                            'font-size' => '17px',
                            'line-height' => '30px'
                        ),
                    ),

                    array( 
                        'id' => 'textbar_title_typography',
                        'type' => 'typography',
                        'title' => __('Textbar title typography', 'amos'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.textbar h2',
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '300',
                            'font-size' => '22px',
                            'text-transform' => 'none',
                            'letter-spacing' => '0px'
                        ),
                    ),
                    array(
                        'id' => 'contact_border',
                        'type' => 'color',
                        'output' => '',
                        'title' => __('Contact Form Elements Border', 'amos'),
                        'default' => '#ececec',
                        'validate' => 'color',
                    )
                ),
                'subsection' => true
           ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Buttons Styling', 'amos'),
                'fields' => array(
                    array(
                        'id'       => 'overall_button_style',
                        'type'     => 'select',
                        'multi'    => true,
                        'options'  => array(
                            'default' => 'Default (Border and Effect)',
                            'business' => 'Business',
                            'no_padding' => 'Without padding',
                            'rounded' => 'Rounded',
                            'gradient' => 'Gradient Rounded',
                            'big' => 'Big and Shadow',
                            'with_icon' => 'With Icon in the left'
                            
                        ),
                        'default'  => array('default'),
                        'title'    => __('Overall Button Style', 'amos')
                    ),


                    array( 
                        'id' => 'button_typography',
                        'type' => 'typography',
                        'title' => __('Overall button typography', 'amos'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.btn-bt',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'color' => '#fff',
                            'font-weight' => '400',
                            'font-size' => '12px',
                            'line-height' => '13px',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '2px'
                        )
                    ),

                    array(
                        'id' => 'button_gradient_color1',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button Gradient color 1', 'amos'),
                        'default'  => array(
                            'color' => '#8e00fe',  
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba',
                        'required' => array('overall_button_style', 'equals', 'gradient')
                    ),
                    array(
                        'id' => 'button_gradient_color2',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button Gradient color 2', 'amos'),
                        'default'  => array(
                            'color' => '#8e00fe',  
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba',
                        'required' => array('overall_button_style', 'equals', 'gradient')
                    ),

                    array(
                        'id' => 'button_background_color',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button background', 'amos'),
                        'default'  => array(
                            'color' => '#8e00fe',  
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba'
                    ),
                    array(
                        'id' => 'button_border_color',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button border', 'amos'),
                        'default'  => array(
                            'color' => '#8e00fe', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba'
                    ),
                    array(
                        'id' => 'button_hover_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => __('Overall button hover Font Color', 'amos'),
                        'default' => '#fff',
                        'validate' => 'color',
                        'required' => array('overall_button_style', '!=', 'gradient')
                    ),

                    array(
                        'id' => 'button_hover_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button hover bg', 'amos'),
                        'default'  => array(
                            'color' => '#640aaa', 
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba',
                        'required' => array('overall_button_style', '!=', 'gradient')
                    ), 

                    array(
                        'id' => 'button_hover_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button hover border', 'amos'),
                        'default'  => array(
                            'color' => '#640aaa', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba',
                        'required' => array('overall_button_style', '!=', 'gradient')
                    ),

                    array(
                        'id' => 'button_light_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => __('Light button Font Color', 'amos'),
                        'default' => '#640aaa',
                        'validate' => 'color'
                    ),

                    array(
                        'id' => 'button_light_gradient_color1',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall light button Gradient color 1', 'amos'),
                        'default'  => array(
                            'color' => '#000000',  
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba',
                        'required' => array('overall_button_style', 'equals', 'gradient')
                    ),
                    array(
                        'id' => 'button_light_gradient_color2',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall lightbutton Gradient color 2', 'amos'),
                        'default'  => array(
                            'color' => '#000000',  
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba',
                        'required' => array('overall_button_style', 'equals', 'gradient')
                    ),

                    array(
                        'id' => 'button_light_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Light button bg', 'amos'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba'
                    ), 

                    array(
                        'id' => 'button_light_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Light button border', 'amos'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '1.0'
                        ),
                        'validate' => 'colorrgba',
                        'required' => array('overall_button_style', '!=', 'gradient')
                    ),

                    array(
                        'id' => 'button_light_hover_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => __('Light button hover Font Color', 'amos'),
                        'default' => '#fff',
                        'validate' => 'color'
                    ),

                    array(
                        'id' => 'button_light__hover_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Light button hover bg', 'amos'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba'
                    ), 

                    array(
                        'id' => 'button_light_hover_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Light button hover border', 'amos'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba',
                        'required' => array('overall_button_style', '!=', 'gradient')
                    ),
                ),
                'subsection' => true
            ));     

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Shop Styling', 'amos'),
                'fields' => array(
                    
                    array(
                        'id' => 'shop_single_title',
                        'type' => 'typography',
                        'title' => __('Shop Single Product Title', 'amos'),
                        'compiler'=>false, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'=>false, // Only appears if google is true and subsets not set to false
                        'font-size'=>false,
                        'font-family' => false,
                        'text-transform' => true,
                        'line-height'=>false,
                        //'word-spacing'=>true, // Defaults to false
                        'letter-spacing'=>true, // Defaults to false
                        'color'=>false,
                        //'preview'=>false, // Disable the previewer
                        'text-align' => false,
                        'font-weight' => true,
                        'all-styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('.woocommerce #content div.product .product_title, .woocommerce div.product .product_title, .woocommerce-page #content div.product .product_title, .woocommerce-page div.product .product_title, .woocommerce ul.products li.product h6, .woocommerce-page ul.products li.product h6'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for single product title', 'amos'),
                        'default' => array(
                            'font-weight' => '300',
                            'letter-spacing' => '1',
                            'text-transform' => 'capitalize'
                        ),
                    ),

                    array(
                        'id' => 'shop_product_overlay',
                        'type' => 'color_rgba',
                        'title' => __('Shop item overlay', 'amos'),
                        'mode' => 'background-color', 
                        'output' => array('.woocommerce ul.products li.product:hover .overlay'), 
                        'default'  => array(
                            'color' => '#fffffff', 
                            'alpha' => '0.80'
                        ),
                        'validate' => 'colorrgba',
                    ),
                ),
                'subsection' => true
            ));
                   
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-text-width',
                'title' => __('Typography Options', 'amos'),
                'fields' => array(
                    array(
                        'id' => 'body_typography',
                        'type' => 'typography',
                        'title' => __('Body Font Style', 'amos'),
                        'compiler'=>false, 
                        'google' => true, 
                        'font-backup' => true,
                        'font-style'=>true, 
                        'line-height'=>true,
                        'text-align' => false,
                        'font-weight' => true,
                        'letter-spacing' => true,
                        'all-styles' => true,
                        'output' => array('body'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for the body text', 'amos'),
                        'default' => array(
                            'color' => "#879298",
                            'font-family' => 'Open Sans',
                            'google' => true,
                            'line-height' => '28px',
                            'font-size' => '15px',
                            'font-weight' => '400',
                            'letter-spacing' => '0px'
                        ),
                    ),

                    
                    array(
                        'id' => 'headings_font_type',
                        'type' => 'typography',
                        'title' => __('Headings font type', 'amos'),
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => true,
                        'font-style' => true,
                        'letter-spacing' => true,
                        'subsets' => false,
                        'font-size' => false,
                        'line-height'=>false,
                        'color'=>false,
                        'font-family' => true,
                        'text-align' => false,
                        'all-styles' => true,
                        'compiler' => false,
                        'output' => array('h1,h2,h3,h4,h5,h6', '.skill_title', '.tabbable.tabs-top.style_1 .nav.nav-tabs li a', '.woocommerce-page div.product form.cart .variations td.label'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for the body text', 'amos'),
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'letter-spacing' => '0px',
                            'google' => true,
                            'font-weight' => '700'
                        ),
                    ),


                    array(
                        'id' => 'heading_1_font',
                        'type' => 'typography',
                        'title' => __('Heading 1 Font style', 'amos'),
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'font-style' => false,
                        'line-height'=>true,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h1'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for the h1 text', 'amos'),
                        'default' => array(
                            'line-height' => '52px',
                            'google' => true,
                            'font-size' => '24px'
                        ),
                    ),
                    array(
                        'id' => 'heading_2_font',
                        'type' => 'typography',
                        'title' => __('Heading 2 Font style', 'amos'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'font-style' => false,
                        'line-height'=>true,
                        'color'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'preview'=>false,
                        'output' => array('h2'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'amos'),
                        'default' => array(
                            'line-height' => '28px',
                            'google' => true,
                            'font-size' => '21px'
                        ),
                    ),
                    array(
                        'id' => 'heading_3_font',
                        'type' => 'typography',
                        'title' => __('Heading 3 Font style', 'amos'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'preview'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'output' => array('h3'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'amos'),
                        'default' => array(
                            'line-height' => '26px',
                            'google' => true,
                            'font-size' => '18px'
                        ),
                    ),
                    array(
                        'id' => 'heading_4_font',
                        'type' => 'typography',
                        'title' => __('Heading 4 Font style', 'amos'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h4'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'amos'),
                        'default' => array(
                            'line-height' => '24px',
                            'google' => true,
                            'font-size' => '16px'
                        ),
                    ),
                    array(
                        'id' => 'heading_5_font',
                        'type' => 'typography',
                        'title' => __('Heading 5 Font style', 'amos'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h5'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'amos'),
                        'default' => array(
                            'line-height' => '22px',
                            'google' => true,
                            'font-size' => '14px'
                        ),
                    ),
                    array(
                        'id' => 'heading_6_font',
                        'type' => 'typography',
                        'title' => __('Heading 6 Font style', 'amos'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'preview'=>false,
                        'output' => array('h6'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'amos'),
                        'default' => array(
                            'line-height' => '20px',
                            'google' => true,
                            'font-size' => '12px'
                        ),
                    ),
                )
           ));
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Footer Options', 'amos'),
                'fields' => array(
                    array(
                        'id'       => 'footer_columns',
                        'type'     => 'image_select',
                        'title'    => __('Footer Columns', 'amos'), 
                        'subtitle' => __('Select how many columns do you want for the footer. Choose between 1, 2, 3 or 4 column layout.', 'amos'),
                        'options'  => array(
                            '1'      => array(
                                'alt'   => '1 Column', 
                                'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                            ),
                            '2'      => array(
                                'alt'   => '2 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/2-col-portfolio.png'
                            ),
                            '3'      => array(
                                'alt'   => '3 Columns', 
                                'img'  => ReduxFramework::$_url.'assets/img/3-col-portfolio.png'
                            ),
                            '4'      => array(
                                'alt'   => '4 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/4-col-portfolio.png'
                            ),
                            '5'      => array(
                                'alt'   => '5 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/5-col-portfolio.png'
                            )
                        ),
                        'default' => '4'
                    ),
                    array(
                        'id' => 'footer_container_full', 
                        'type' => 'checkbox',
                        'title' => __('Remove container from footer', 'amos'),
                        'desc' => __('By checking this the footer container should be removed and transformed in fullwidth footer', 'amos'),
                        'default' => '0'// 1 = on | 0 = off
                    ),
                    
                    array(
                        'id' => 'copyright_text',
                        'type' => 'editor',
                        'title' => __('Copyright Text in the end of footer', 'amos'),
                        'subtitle' => __('Text have to be placed in the copyright bar', 'amos'),
                        'default' => '© 2018 Amos - Multi-Purpose theme from <a href="'.esc_url("http://ellethemes.com").'">Elle Themes</a>, built with <a href="#">WordPress</a>',
                    ),

                    array(
                        'id' => 'show_footer',
                        'type' => 'switch',
                        'title' => __('Show Footer', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'reveal_footer',
                        'type' => 'switch',
                        'title' => __('Show Footer with reveal effect', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'center_footer',
                        'type' => 'switch',
                        'title' => __('Center footer content (vertically and horizontally)', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'show_copyright',
                        'type' => 'switch',
                        'title' => __('Show Copyright', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 1,
                    ),

                )
            ));

            

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-file-edit',
                'title' => __('Blog Config', 'amos'),
                'fields' => array(
                    array(
                        'id' => 'blog_style',
                        'type' => 'select',
                        'title' => __('Blog Style', 'amos'),
                        'subtitle' => __('Select the blog style to be used', 'amos'),
                        'options' => array('normal' => 'Normal', 'alternate' => 'Alternate', 'grid' => 'Masonry', 'fullscreen' => 'Fullscreen Innovative'), //Must provide key => value pairs for select options
                        'default' => 'normal'
                    ),

                    array(
                        'id' => 'blog_grid_col',
                        'title' => __( 'Blog Masonry Columns', 'amos' ),
                        'desc' => 'Number of columns for the layout',
                        'type' => 'image_select',
                        'options'  => array(
                                '2'      => array(
                                    'alt'   => '2 Columns', 
                                    'img'   => ReduxFramework::$_url.'assets/img/2-col-portfolio.png'
                                ),
                                '3'      => array(
                                    'alt'   => '3 Columns', 
                                    'img'  => ReduxFramework::$_url.'assets/img/3-col-portfolio.png'
                                ),
                                '4'      => array(
                                    'alt'   => '4 Columns', 
                                    'img'   => ReduxFramework::$_url.'assets/img/4-col-portfolio.png'
                                ),
                            ),
                        'default' => '4',
                        'required' => array('blog_style', 'equals', 'grid')
                    ),

                    array(
                        'title'     => __( 'Layout', 'amos' ),
                        'desc'      => __( 'Select main content and sidebar arrangement.', 'amos' ),
                        'id'        => 'bloglayout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),
                    array(
                        'id' => 'blog_post_style',
                        'type' => 'select',
                        'title' => __('Single Post Style', 'amos'),
                        'subtitle' => __('Select the single post style to be used', 'amos'),
                        'options' => array('normal' => 'Normal', 'creative' => 'Creative'), //Must provide key => value pairs for select options
                        'default' => 'normal'
                    ),

                    array(
                        'title'     => __( 'Single Post Layout', 'amos' ),
                        'desc'      => __( 'Select the default single post sidebar position', 'amos' ),
                        'id'        => 'singlebloglayout',
                        'default'   => 'sidebar_right',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'required' => array('blog_post_style', 'equals', 'normal'),

                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),
                     array(
                        'id' => 'related_posts',
                        'type' => 'switch',
                        'title' => __('Show related posts on single post', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 0,
                    ),
                    array(
                        'id' => 'post_like',
                        'type' => 'switch',
                        'title' => __('Active Post Like', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 1,
                    ),

                    array(
                        'id' => 'social_shares',
                        'type' => 'switch',
                        'title' => __('Social Shares on Posts', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'blog_pagination',
                        'type' => 'select',
                        'title' => __('Select the pagination method', 'amos'),
                        'options' => array('no_pagination' => 'Without pagination', 'with_pagination' => 'With Pagination', 'infinite_scroll' => 'Infinite Scroll'),
                        'default' => 'with_pagination'
                    ),

                    array(
                        'id' => 'blog_info_author',
                        'type' => 'switch',
                        'title' => __('Show author at blog post', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_date',
                        'type' => 'switch',
                        'title' => __('Show date at blog post', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_comments',
                        'type' => 'switch',
                        'title' => __('Show comments count at blog post', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_tags',
                        'type' => 'switch',
                        'title' => __('Show tags at blog post', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 1,
                    ),

                )
            ));

            
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-view-mode',
                'title' => __('Portfolio Config', 'amos'),
                'fields' => array(
                    array(
                        'id' => 'portfolio_slug',
                        'type' => 'text',
                        'title' => __('Portfolio Slug', 'amos'),
                        'default' => 'amos_portfolio'
                    ),

                     array(
                        'id' => 'single_portfolio_layout',
                        'type' => 'select',
                        'title' => __('Single portfolio style', 'amos'),
                        'options' => array('simple' => 'Defined Simple Layout', 'custom' => 'Custom Layout'),
                        'default' => 'simple'
                    ),
                    array(
                        'id'=>'single_portfolio_custom_params',
                        'type' => 'multi_text',
                        'title' => __('Custom fields Parameters', 'amos'),
                        'subtitle' => __('Create unlimited custom fields. Add values in respetive single portfolio', 'amos') 
                    ),
                    array(
                        'id' => 'portfolio_post_like',
                        'type' => 'switch',
                        'title' => __('Active Portfolio Item Like', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 0,
                    ),
                )
            ));


            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-fullscreen',
                'title' => __('Layout', 'amos'),
                'fields' => array(
                    array(
                        'id' => 'site_layout',
                        'type' => 'select',
                        'title' => __('Overall site layout', 'amos'),
                        'subtitle' => __('Select overall ste pages layout', 'amos'),
                        'options' => array('fullwidth' => 'Fullwidth', 'boxed' => 'Boxed'), //Must provide key => value pairs for select options
                        'default' => 'fullwidth'
                    ),

                    array(
                        'title'     => __( 'Pages Default Layout', 'amos' ),
                        'desc'      => __( 'Select default layout for pages. You can overwrite it in Page Options', 'amos' ),
                        'id'        => 'page_overall_layout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),
                    

                    array(
                        'id' => 'page_container_width',
                        'type' => 'dimensions', 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Page Container Width', 'amos'),
                        'subtitle' => __('units: px', 'amos'),
                        'desc' => __('', 'amos'),
                        'default' => array('width' => '1200px')
                    ),

                    array(
                        'id' => 'page_container_width_percent',
                        'type' => 'dimensions',
                        'units' => '%', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Page Container Width with percentage', 'amos'),
                        'subtitle' => __('units: px', 'amos'),
                        'desc' => __('If you set the width in percentage, the page container width in pixel should be used as max-width', 'amos'),
                        'default' => array('width' => '87%')
                    ),

                    array(
                        'id' => 'boxed_container_width',
                        'type' => 'dimensions', 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Boxed Container Width', 'amos'),
                        'subtitle' => __('units: px', 'amos'),
                        'desc' => __('', 'amos'),
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'default' => array('width' => '1100px'),

                    ),

                    array(
                        'id' => 'boxed_container_width_percent',
                        'type' => 'dimensions',
                        'units' => '%', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Boxed Container Width with percentage', 'amos'),
                        'subtitle' => __('units: px', 'amos'),   
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'desc' => __('If you set the width in percentage, the boxed container width in pixel should be used as max-width', 'amos'),
                        'default' => array('width' => '87%')
                    ),

                    array(
                        'title'=> __( 'Boxed Container Margin', 'amos' ),
                        'desc' => __( 'Boxed Container Top/Bottom Margin', 'amos' ),
                        'id'   => 'boxed_container_margin',
                        'type' => 'spacing',
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'right' => false, // Disable the right
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('margin-bottom' => '30px', 'margin-top' => '30px'),
                        'required' => array('site_layout', 'equals', 'boxed')
                    ),

                    array(
                        'id' => 'boxed_shadow',
                        'type' => 'switch',
                        'title' => __('Boxed Container Shadow', 'amos'),
                        'subtitle' => __('', 'amos'),
                        'required' => array('site_layout', 'equals', 'boxed'),
                        "default" => 1,
                    ),

                    array(
                        'id'       => 'boxed_border',
                        'type'     => 'border',
                        'title'    => __('Boxed Container Border', 'amos'),
                        'subtitle' => __('', 'amos'),
                        'output'   => array('.boxed_layout'),
                        'all'      => true,
                        'color'    => true,
                        'style'    => true, 
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'desc'     => __('Add Border for boxed container', 'amos'),
                        'default'  => array(
                            'color'  => '#e7e7e7', 
                            'border-style'  => 'solid',
                            'border'    => '0px'
                        )
                    ),

                    array(
                        'id' => 'extra_navigation',
                        'type' => 'switch',
                        'title' => __('Extra Side Navigation', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 0,
                    ),

                    array(
                        'title'     => __( 'Extra Navigation Position', 'amos' ),
                        'desc'      => __( 'Select the default single post sidebar position', 'amos' ),
                        'id'        => 'extra_navigation_position',
                        'default'   => 'right',
                        'type'      => 'image_select',
                        'customizer'=> array(), 
                        'options'   => array( 
                            'left'     => ReduxFramework::$_url . 'assets/img/2cl.png',
                            'right' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        ),
                        'required' => array('extra_navigation', 'equals', 1),
                    ),

                    array(
                        'title'=> __( 'Page Builder Row Margin Bottom', 'amos' ),
                        'desc' => __( 'Margin bottom for the ROW in Page builder', 'amos' ),
                        'id'   => 'row_margin_bottom',
                        'type' => 'spacing',
                        'output' => array('.wpb_row.section-style, .wpb_row.standard_section'),
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('margin-bottom' => '70px')
                    ),

                    array(
                        'title'=> __( 'Inner Page Content Padding', 'amos' ),
                        'desc' => __( 'Change padding of the inner page content', 'amos' ),
                        'id'   => 'content_padding',
                        'type' => 'spacing',
                        'output' => array('#content'), 
                        'mode' => 'padding', // absolute, padding, margin, defaults to padding
                        'top' => true, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('padding-bottom' => '70px','padding-top' => '70px')
                    ),
                    array(
                        'id' => 'outter_padding',
                        'type' => 'switch',
                        'title' => __('Add a outter padding', 'amos'),
                        'subtitle' => __('', 'amos'),
                        "default" => 0
                    ),
                    array(
                        'id' => 'outter_padding_color',
                        'type' => 'color_rgba',
                        'output' => array('body, .top_space, .bottom_space'),
                        'title' => __('Select the outter border color', 'amos'),
                        'mode' => 'background-color', 
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '0.95'
                        ),
                        'required' => array('outter_padding', 'equals', '1'),
                        'validate' => 'colorrgba',
                    )
                    
                )
           ));
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-shopping-cart',
                'title' => __('Shop Config', 'amos'),
                'fields' => array(

                    array(
                        'title'     => __( 'Shop Layout', 'amos' ),
                        'desc'      => __( 'Select layout for shop page.', 'amos' ),
                        'id'        => 'shop_layout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    )
                    )
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-heart',
                'title' => __('Clients', 'amos'),
                'fields' => array(
                    array(
                        'id'       => 'clients_dark',
                        'type'     => 'slides',
                        'title'    => __('Add/Edit Clients Dark Version', 'amos'),
                        'subtitle' => __('Upload clients logo here', 'amos')
                    ),

                    array(
                        'id'       => 'clients_light',
                        'type'     => 'slides',
                        'title'    => __('Add/Edit Clients Light Version', 'amos'),
                        'subtitle' => __('Upload clients logo here', 'amos')
                    ),

                )
            ));


            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-twitter',
                'title' => __('Social Media', 'amos'),
                'fields' => array(
                    array(
                        'id'       => 'facebook',
                        'type'     => 'text',
                        'title'    => __('Facebook Link', 'amos')
                    ),
                    array(
                        'id'       => 'twitter',
                        'type'     => 'text',
                        'title'    => __('Twitter Link', 'amos')
                    ),
                    array(
                        'id'       => 'flickr',
                        'type'     => 'text',
                        'title'    => __('Flickr Link', 'amos')
                    ),
                    array(
                        'id'       => 'foursquare',
                        'type'     => 'text',
                        'title'    => __('Foursquare Link', 'amos')
                    ),
                    array(
                        'id'       => 'google',
                        'type'     => 'text',
                        'title'    => __('Google Plus Link', 'amos')
                    ),
                    array(
                        'id'       => 'dribbble',
                        'type'     => 'text',
                        'title'    => __('Dribbble Link', 'amos')
                    ),
                    array(
                        'id'       => 'linkedin',
                        'type'     => 'text',
                        'title'    => __('Linkedin Link', 'amos')
                    ),

                    array(
                        'id'       => 'youtube',
                        'type'     => 'text',
                        'title'    => __('Youtube Link', 'amos')
                    ),

                    array(
                        'id'       => 'instagram',
                        'type'     => 'text',
                        'title'    => __('Instagram Link', 'amos')
                    ),

                    array(
                        'id'       => 'pinterest',
                        'type'     => 'text',
                        'title'    => __('Pinterest Link', 'amos')
                    ),

                    array(
                        'id'       => 'email',
                        'type'     => 'text',
                        'title'    => __('Email Link', 'amos')
                    ),
                )
            ));

            Redux::setSection( $opt_name, array( 
                'icon' => 'el-icon-indent-right',
                'title' => __('Custom Sidebars', 'amos'),
                'fields' => array(
                    array(
                        'id'       => 'pages_sidebar',
                        'type'     => 'select',
                        'multi'    => true,
                        'data'     => 'pages',
                        'title'    => __('Pages custom sidebars', 'amos'),
                        'subtitle' => __('Select all pages that you want a custom sidebar (widgetized area)', 'amos')
                    ),

                    array(
                        'id'       => 'categories_sidebar',
                        'type'     => 'select',
                        'multi'    => true,
                        'data'     => 'categories',
                        'title'    => __('Categories custom sidebars', 'amos'),
                        'subtitle' => __('Select all categories that you want a custom sidebar (widgetized area)', 'amos')
                    ),

                )
            ));

            if(!defined('AMOS_BASE_URL' ) ) define( 'AMOS_BASE_URL', get_template_directory_uri().'/'); 

            Redux::setSection( $opt_name, array( 
                'icon' => 'el-icon-magic',
                'title' => __('Import / Export (Dummy Data)', 'amos'),
                'fields' => array(
                    array(
                        'id'       => 'codeless_import_export',
                        'type'     => 'codeless_import', 
                        'data'     => array(


                            array('name' => 'Default', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/default.jpg', 'folder' => 'default', 'parts' => '1', 'zip' => 'none'),
                            
                            array('name' => 'Agency Creative', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/agency_creative.jpg', 'folder' => 'agency_creative', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Application', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/app.jpg', 'folder' => 'app', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Freelance Creative', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/freelancer_creative.jpg', 'folder' => 'freelancer_creative', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Startup', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/startup.jpg', 'folder' => 'startup', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Shop Fashion', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/shop_fashion.jpg', 'folder' => 'shop_fashion', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Shop Interior', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/shop_interior.jpg', 'folder' => 'shop_interior', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Photography', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/photography.jpg', 'folder' => 'photography', 'parts' => '1', 'zip' => 'none'),
                            
                            array('name' => 'Split', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/split.jpg', 'folder' => 'split', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Minimalist', 'image' => AMOS_BASE_URL . 'includes/dummy_data/img/minimalist.jpg', 'folder' => 'minimalist', 'parts' => '1', 'zip' => 'none'),           
                            
                            
                        ),
                        'default' => 'default',
                        'title'    => __('Amos Import', 'amos'),
                        'subtitle' => __('', 'amos')
                    )
                )
            ));


           /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */
    /*
    *
    * --> Action hook examples
    *
    */
    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );
    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
           
            echo "</pre>";
            print_r($options); //Option values
            print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }
    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;
            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }
            $return['value'] = $value;
            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }
            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }
            return $return;
        }
    }
    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }
    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'amos' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'amos' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }
    }
    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;
            return $args;
        }
    }
    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';
            return $defaults;
        }
    }
    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
           /* if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );*/
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        
        }
    }

function amos_styleswitch_opt($options){
            
            if(!empty($_COOKIE) && is_array($_COOKIE))
                
                foreach($_COOKIE as $opt_key => $value){
                    $opt_key = explode('-__-', $opt_key);
                    if($opt_key[1] == 'default'){
                        $opt_key = $opt_key[2];
                        if(isset($options[$opt_key])){
                            $value = json_decode( base64_decode($value), true );
                            if(is_array($value)){
                                foreach($value as $k => $v){
                                    $options[$opt_key][$k] = $v; 
                                } 
                            }else{
                                $options[$opt_key] = $value;
                            } 

                        }
                    }
                    
                }

            return $options;
        }

        function amos_styleswitch_redata(){
            global $redata;
            if(!empty($_COOKIE) && is_array($_COOKIE))
                
                foreach($_COOKIE as $opt_key => $value){
                    $opt_key = explode('-__-', $opt_key);
                    if($opt_key[1] == 'default'){
                        $opt_key = $opt_key[2];
                        if(isset($redata[$opt_key])){
                            $value = json_decode( base64_decode($value), true );
                            if(is_array($value)){
                                foreach($value as $k => $v){
                                    $redata[$opt_key][$k] = $v; 
                                } 
                            }else{
                                $redata[$opt_key] = $value;
                            }

                        }
                    }
                }
        }