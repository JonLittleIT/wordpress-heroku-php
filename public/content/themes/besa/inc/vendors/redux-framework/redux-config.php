<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if( defined('TBAY_ELEMENTOR_ACTIVED') && !TBAY_ELEMENTOR_ACTIVED) return;

if (!class_exists('Besa_Redux_Framework_Config')) {

    class Besa_Redux_Framework_Config
    {
        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;
        public $output;
        public $default_color; 

        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return; 
            }  

            add_action('init', array($this, 'initSettings'), 10);
        }

        public function redux_output() 
        {
            $this->output = require_once( get_parent_theme_file_path( BESA_INC . '/customizer/output.php') );

            if( !isset($this->output['main_color_second']) ) {
                $this->output['main_color_second'] = '';
            }            

            if( !isset($this->output['main_color_third']) ) {
                $this->output['main_color_third'] = '';
            }
        }        

        public function redux_default_color() 
        {
            $this->default_color = besa_tbay_default_theme_primary_color();

            if( !isset($this->default_color['main_color_second']) ) {
                $this->default_color['main_color_second'] = '';
            }            

            if( !isset($this->default_color['main_color_third']) ) {
                $this->default_color['main_color_third'] = '';
            }
        }

        public function initSettings()
        {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            //Create output
            $this->redux_output();            

            //Create default color all skins
            $this->redux_default_color();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {

            $output = $this->output;

            $default_color = $this->default_color;

            $sidebars = besa_sidebars_array();

            $columns = array( 
                '1' => esc_html__('1 Column', 'besa'),
                '2' => esc_html__('2 Columns', 'besa'),
                '3' => esc_html__('3 Columns', 'besa'),
                '4' => esc_html__('4 Columns', 'besa'),
                '5' => esc_html__('5 Columns', 'besa'),
                '6' => esc_html__('6 Columns', 'besa')
            );     

            $aspect_ratio = array( 
                '16_9' => '16:9',
                '4_3' => '4:3',
            );        

            $blog_image_size = array( 
                'thumbnail'         => esc_html__('Thumbnail', 'besa'),
                'medium'            => esc_html__('Medium', 'besa'),
                'large'             => esc_html__('Large', 'besa'),
                'full'              => esc_html__('Full', 'besa'),
            );      
          
            
            // General Settings Tab
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-settings',
                'title' => esc_html__('General', 'besa'),
                'fields' => array(
                    array(
                        'id'        => 'preload',
                        'type'      => 'switch',
                        'title'     => esc_html__('Preload Website', 'besa'),
                        'default'   => false
                    ),
                    array(
                        'id' => 'select_preloader',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Select Preloader', 'besa'),
                        'subtitle' => esc_html__('Choose a Preloader for your website.', 'besa'),
                        'required'  => array('preload','=',true),
                        'options' => array(
                            'loader1' => array(
                                'title' => esc_html__( 'Loader 1', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/preloader/loader1.png'
                            ),         
                            'loader2' => array(
                                'title' => esc_html__( 'Loader 2', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/preloader/loader2.png'
                            ),              
                            'loader3' => array(
                                'title' => esc_html__( 'Loader 3', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/preloader/loader3.png'
                            ),         
                            'loader4' => array(
                                'title' => esc_html__( 'Loader 4', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/preloader/loader4.png'
                            ),          
                            'loader5' => array(
                                'title' => esc_html__( 'Loader 5', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/preloader/loader5.png'
                            ),         
                            'loader6' => array(
                                'title' => esc_html__( 'Loader 6', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/preloader/loader6.png'
                            ),                        
                            'custom_image' => array(
                                'title' => esc_html__( 'Custom image', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/preloader/custom_image.png'
                            ),         
                        ),
                        'default' => 'loader1'
                    ),
                    array(
                        'id' => 'media-preloader',
                        'type' => 'media',
                        'required' => array('select_preloader','=', 'custom_image'),
                        'title' => esc_html__('Upload preloader image', 'besa'),
                        'subtitle' => esc_html__('Image File (.gif)', 'besa'),
                        'desc' =>   sprintf( wp_kses( __('You can download some the Gif images <a target="_blank" href="%1$s">here</a>.', 'besa' ),  array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), 'https://loading.io/' ), 
                    ),
                    array(
                        'id'            => 'config_media',
                        'type'          => 'switch',
                        'title'         => esc_html__('Enable Config Image Size', 'besa'),
                        'subtitle'      => esc_html__('Config image size in WooCommerce and Media Setting', 'besa'),
                        'default'       => false
                    ),
                )
            );
            // Header
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-view-web',
                'title' => esc_html__('Header', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'header_type',
                        'type' => 'select',
                        'title' => esc_html__('Select Header Layout', 'besa'),
                        'options' => besa_tbay_get_header_layouts(),
                        'default' => 'header_default'
                    ),
                    array(
                        'id' => 'media-logo',
                        'type' => 'media',
                        'title' => esc_html__('Upload Logo', 'besa'),
                        'subtitle' => esc_html__('Image File (.png or .gif)', 'besa'),
                    ),
                )
            );
            
            // Footer
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-border-bottom',
                'title' => esc_html__('Footer', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'footer_type',
                        'type' => 'select',
                        'title' => esc_html__('Select Footer Layout', 'besa'),
                        'options' => besa_tbay_get_footer_layouts(),
 						'default' => 'footer_default'
                    ),
                    array(
                        'id' => 'copyright_text',
                        'type' => 'editor',
                        'title' => esc_html__('Copyright Text', 'besa'),
                        'default' => esc_html__('<p>Copyright  &#64; 2019 Besa Designed by ThemBay. All Rights Reserved.</p>', 'besa'),
                        'required' => array('footer_type','=','footer_default')
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Enable "Back to Top" Button', 'besa'),
                        'default' => true,
                    ),
                )
            );



            // Mobile
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-smartphone-iphone',
                'title' => esc_html__('Mobile', 'besa'),
            );

            // Mobile Header settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Header', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'mobile-logo',
                        'type' => 'media',
                        'title' => esc_html__('Upload Logo', 'besa'),
                        'subtitle' => esc_html__('Image File (.png or .gif)', 'besa'),
                    ),
                    array(
                        'id'        => 'logo_img_width_mobile',
                        'type'      => 'slider',
                        'title'     => esc_html__('Logo maximum width (px)', 'besa'),
                        "default"   => 69,
                        "min"       => 50,
                        "step"      => 1,
                        "max"       => 600,
                    ),
                    array(
                        'id'             => 'logo_mobile_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => array('px'),
                        'units_extended' => 'false',
                        'title'          => esc_html__('Logo Padding', 'besa'),
                        'desc'           => esc_html__('Add more spacing around logo.', 'besa'),
                        'default'            => array(
                            'padding-top'     => '',
                            'padding-right'   => '',
                            'padding-bottom'  => '',
                            'padding-left'    => '',
                            'units'          => 'px',
                        ),
                    ),
                    array(
                        'id'        => 'always_display_logo',
                        'type'      => 'switch',
                        'title'     => esc_html__('Always Display Logo', 'besa'),
                        'subtitle'      => esc_html__('Logo displays on all pages (page title is disabled)', 'besa'),
                        'default'   => false
                    ),                    
                    array(
                        'id'        => 'menu_mobile_all_page',
                        'type'      => 'switch',
                        'title'     => esc_html__('Always Display Menu', 'besa'),
                        'subtitle'      => esc_html__('Menu displays on all pages (Button Back is disabled)', 'besa'),
                        'default'   => false
                    ),
                )
            );

             // Mobile Footer settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Footer', 'besa'),
                'fields' => array(                
                    array(
                        'id' => 'mobile_footer',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Desktop Footer', 'besa'),
                        'default' => false
                    ),   
                    array(
                        'id' => 'mobile_back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Enable "Back to Top" Button', 'besa'),
                        'default' => false
                    ),                 
                    array(
                        'id' => 'mobile_footer_icon',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Mobile Footer', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id' => 'mobile_footer_menu_recent',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Menu Recent Viewed', 'besa'),
                        'required' => array('mobile_footer_icon','=', true),
                        'default' => true
                    ),
                    array(
                        'id'       => 'mobile_footer_menu_recent_title',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Recent Viewed Title', 'besa' ),
                        'required' => array('mobile_footer_menu_recent','=', true),
                        'default'  => esc_html__( 'Viewed', 'besa' ),
                    ),
                    array(
                        'id'       => 'mobile_footer_menu_recent_icon',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Recent Viewed Icon', 'besa' ),
                        'required' => array('mobile_footer_menu_recent','=', true),
                        'desc'       => sprintf( 
                            wp_kses( __( 'Enter icon name of fonts: <a href="%s" target="_blank">Awesome</a> and <a href="%s" target="_blank">Materialdesigniconic</a> and <a href="%s" target="_blank">Simplelineicons</a> and <a href="%s" target="_blank">Linearicons</a> .  <a href="%s" target="_blank">How to use?</a> ', 'besa' ), 
                                array(  
                                    'a' => array( 'href' => array() ), 
                                )), '//fontawesome.com/v4.7.0/icons/', 
                                    '//zavoloklom.github.io/material-design-iconic-font/icons.html',
                                    '//fonts.thembay.com/simple-line-icons',
                                    '//fonts.thembay.com/linearicons/',
                                    '//docs.thembay.com/besa/'
                                 ),
                        'default'  => 'tb-icon tb-history',
                    ), 
                    array(
                        'id'       => 'mobile_footer_menu_recent_page',
                        'type'     => 'select',
                        'data'     => 'pages',
                        'required' => array('mobile_footer_menu_recent','=', true),
                        'title'    => esc_html__( 'Select Link Page Recent Viewed', 'besa' ),
                    ),
                )
            );     

            // Mobile Search settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Search', 'besa'),
                'fields' => array( 
                    array(
                        'id'=>'mobile_search_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Result', 'besa'),
                        'options' => array(
                            'post' => esc_html__('Post', 'besa'), 
                            'product' => esc_html__('Product', 'besa')
                        ),
                        'default' => 'product'
                    ),
                    array(
                        'id' => 'mobile_autocomplete_search',
                        'type' => 'switch',
                        'title' => esc_html__('Auto-complete Search?', 'besa'),
                        'default' => 1
                    ),
                    array(
                        'id'       => 'mobile_search_placeholder',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Placeholder', 'besa' ),
                        'default'  => esc_html__( 'Search for products...', 'besa' ),
                    ),   
                    array(
                        'id' => 'mobile_enable_search_category',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Search in Categories', 'besa'),
                        'default' => true
                    ), 
                    array(
                        'id' => 'mobile_show_search_product_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Image of Search Result', 'besa'),
                        'required' => array('mobile_autocomplete_search', '=', '1'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'mobile_show_search_product_price',
                        'type' => 'switch',
                        'title' => esc_html__('Show Price of Search Result', 'besa'),
                        'required' => array(array('mobile_autocomplete_search', '=', '1'), array('mobile_search_type', '=', 'product')),
                        'default' => true
                    ),  
                    array(
                        'id' => 'mobile_search_min_chars',
                        'type'  => 'slider',
                        'title' => esc_html__('Search Min Characters', 'besa'),
                        'default' => 2,
                        'min'   => 1,
                        'step'  => 1,
                        'max'   => 6,
                    ), 
                    array(
                        'id' => 'mobile_search_max_number_results',
                        'type'  => 'slider',
                        'title' => esc_html__('Number of Search Results', 'besa'),
                        'desc'  => esc_html__( 'Max number of results show in Mobile', 'besa' ),
                        'default' => 5,
                        'min'   => 2,
                        'step'  => 1,
                        'max'   => 20,
                    ), 
                )
            );


            // Menu mobile settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Menu Mobile', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'enable_menu_mobile_effects',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Effects', 'besa'),
                        'default' => false
                    ),                    
                    array(
                        'id' => 'menu_mobile_effects_panels',
                        'type' => 'select', 
                        'title' => esc_html__('Panels Effect', 'besa'),
                        'required' => array('enable_menu_mobile_effects','=', true),
                        'options' => array( 
                            'fx-panels-none'            => esc_html__('No effect', 'besa'),
                            'fx-panels-slide-0'         => esc_html__('Slide 0', 'besa'),
                            'no-effect'                 => esc_html__('Slide 30', 'besa'),
                            'fx-panels-slide-100'       => esc_html__('Slide 100', 'besa'),
                            'fx-panels-slide-up'        => esc_html__('Slide uo', 'besa'),
                            'fx-panels-zoom'            => esc_html__('Zoom', 'besa'),
                        ),
                        'default' => 'no-effect'
                    ),                    
                    array(
                        'id' => 'menu_mobile_effects_listitems',
                        'type' => 'select', 
                        'title' => esc_html__('List Items Effect', 'besa'),
                        'required' => array('enable_menu_mobile_effects','=', true),
                        'options' => array( 
                            'no-effect'                          => esc_html__('No effect', 'besa'),
                            'fx-listitems-drop'         => esc_html__('Drop', 'besa'),
                            'fx-listitems-fade'         => esc_html__('Fade', 'besa'),
                            'fx-listitems-slide'        => esc_html__('slide', 'besa'),
                        ),
                        'default' => 'fx-listitems-fade'
                    ),
                    array(
                        'id'       => 'menu_mobile_title',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Menu Title Text', 'besa' ),
                        'default'  => esc_html__( 'Menu', 'besa' ),
                    ),                                                      
                    array(
                        'id' => 'enable_menu_third', 
                        'type' => 'switch',
                        'title' => esc_html__('Enable Bottom Menu', 'besa'),
                        'default' => true
                    ),  
                    array(
                        'id'       => 'menu_mobile_third_select',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => esc_html__( 'Select Bottom Menu', 'besa' ),
                        'required' => array('enable_menu_third','=', true),
                        'desc'     => esc_html__( 'Select the menu you want to display.', 'besa' ),
                        'default' => 129
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),
                    array(
                        'id' => 'enable_menu_mobile_counters',
                        'type' => 'switch',
                        'title' => esc_html__('Main Menu Item Counter', 'besa'),
                        'default' => false
                    ),                     
                    array(
                        'id' => 'enable_menu_social',
                        'type' => 'switch',
                        'title' => esc_html__('Menu Social', 'besa'),
                        'default' => false
                    ), 
                    array(
                        'id'          => 'menu_social_slides',
                        'type'        => 'slides',
                        'title'       => esc_html__( 'Config Icon', 'besa' ),
                        'desc'        => esc_html__( 'This social will store all slides values into a multidimensional array to use into a foreach loop.', 'besa' ),
                        'class' => 'remove-upload-slides',
                        'show' => array(
                            'title' => true,
                            'description' => false,
                            'url' => true,
                        ),
                        'required' => array('enable_menu_social','=', true),
                        'placeholder'   => array(
                            'title'      => esc_html__( 'Enter icon name', 'besa' ),
                            'url'       => esc_html__( 'Link icon', 'besa' ),
                        ),
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),
                    array(
                        'id'       => 'menu_mobile_one_select',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => esc_html__( 'Main Menu (Tab 01)', 'besa' ),
                        'subtitle' => '<em>'.esc_html__('Tab 1 menu option', 'besa').'</em>',
                        'desc'     => esc_html__( 'Select the menu you want to display.', 'besa' ),
                        'default' => 69
                    ),
                    array(
                        'id'       => 'menu_mobile_tab_one',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Tab 01 Title', 'besa' ),
                        'required' => array('enable_menu_second','=', true),
                        'default'  => esc_html__( 'Menu', 'besa' ),
                    ),
                    array(
                        'id'       => 'menu_mobile_tab_one_icon',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Tab 01 Icon', 'besa' ),
                        'required' => array('enable_menu_second','=', true),
                        'desc'       => esc_html__( 'Enter icon name of fonts: ', 'besa' ) . '<a href="//fontawesome.com/v4.7.0/" target="_blank">Awesome</a> , <a href="//fonts.thembay.com/simple-line-icons//" target="_blank">simplelineicons</a>, <a href="//fonts.thembay.com/linearicons/" target="_blank">linearicons</a>',
                        'default'  => 'fa fa-bars',
                    ), 
                    array(
                        'id' => 'enable_menu_second',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Tab 02', 'besa'),
                        'default' => false
                    ),    
                    array(
                        'id'       => 'menu_mobile_tab_scond',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Tab 02 Title', 'besa' ),
                        'required' => array('enable_menu_second','=', true),
                        'default'  => esc_html__( 'Categories', 'besa' ),
                    ), 
                    array(
                        'id'       => 'menu_mobile_second_select',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => esc_html__( 'Tab 02 Menu Option', 'besa' ),
                        'required' => array('enable_menu_second','=', true),
                        'desc'     => esc_html__( 'Select the menu you want to display.', 'besa' ),
                        'default' => 54
                    ),
                    array(
                        'id'       => 'menu_mobile_tab_second_icon',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Tab 02 Icon', 'besa' ),
                        'required' => array('enable_menu_second','=', true),
                        'desc'       => esc_html__( 'Enter icon name of fonts: ', 'besa' ) . '<a href="//fontawesome.com/v4.7.0/" target="_blank">Awesome</a> , <a href="//fonts.thembay.com/simple-line-icons//" target="_blank">simplelineicons</a>, <a href="//fonts.thembay.com/linearicons/" target="_blank">linearicons</a>',
                        'default'  => 'icons icon-grid',
                    ), 
                )
            );
        

            // Mobile Woocommerce settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Mobile WooCommerce', 'besa'),
                'fields' => array(                
                    array(
                        'id' => 'mobile_product_number',
                        'type' => 'image_select',
                        'title' => esc_html__('Product Column in Shop page', 'besa'),
                        'options' => array(
                            'one' => array(
                                'title' => esc_html__( 'One Column', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/mobile/one_column.jpg'
                            ),                            
                            'two' => array(
                                'title' => esc_html__( 'Two Columns', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/mobile/two_columns.jpg'
                            ),
                        ),
                        'default' => 'two'
                    ),  
					array(
                        'id' => 'enable_add_cart_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show "Add to Cart" Button', 'besa'),
                        'subtitle' => esc_html__('On Home and page Shop', 'besa'),
                        'default' => false
                    ),
                    array(
                        'id' => 'enable_wishlist_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show "Wishlist" Button', 'besa'),
                        'subtitle' => esc_html__('Enable or disable in Home and Shop page', 'besa'),
                        'default' => false
                    ),
                    array(
                        'id' => 'enable_one_name_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show Full Product Name', 'besa'),
                        'subtitle' => esc_html__('Enable or disable in Home and Shop page', 'besa'),
                        'default' => false
                    ),
					array(
                        'id' => 'enable_quantity_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show Quantity', 'besa'),
                        'subtitle' => esc_html__('On Page Single Product', 'besa'),
                        'default' => false
                    ),                  
                    array(
                        'id' => 'enable_tabs_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show Sidebar Tabs', 'besa'),
                        'subtitle' => esc_html__('On Page Single Product', 'besa'),
                        'default' => true
                    ),
                )
            );

            // Style
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-format-color-text',
                'title' => esc_html__('Style', 'besa'),
            ); 

            // Style
            $this->sections[] = array(
                'title' => esc_html__('Main', 'besa'),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'       => 'boby_bg',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => esc_html__( 'Body Background', 'besa' ),
                        'subtitle' => esc_html__( 'Body background with image, color, etc.', 'besa' ),
                    ),
                    array (
                        'title' => esc_html__('Theme Main Color', 'besa'),
                        'id' => 'main_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => $default_color['main_color'],
                        'output' => $output['main_color'],
                    ),                    
                    array (
                        'title' => esc_html__('Theme Main Color Second', 'besa'),
                        'subtitle' => '<em>'.esc_html__('The main color second of the site.', 'besa').'</em>',
                        'id' => 'main_color_second',
                        'type' => 'color', 
                        'transparent' => false,
                        'default' => $default_color['main_color_second'],
                        'output' => $output['main_color_second'],
                    ),
                )
            );

            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'show_font_linearicons',
                        'type' => 'switch',
                        'title' => esc_html__('Enable fonts "Linear icons"', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id' => 'show_typography',
                        'type' => 'switch',
                        'title' => esc_html__('Edit Typography', 'besa'),
                        'default' => false
                    ),
                    array(
                        'title'    => esc_html__('Font Source', 'besa'),
                        'id'       => 'font_source',
                        'type'     => 'radio',
                        'required' => array('show_typography','=', true),
                        'options'  => array(
                            '1' => 'Standard + Google Webfonts',
                            '2' => 'Google Custom',
                            '3' => 'Custom Fonts'
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id'=>'font_google_code',
                        'type' => 'text',
                        'title' => esc_html__('Google Link', 'besa'), 
                        'subtitle' => '<em>'.esc_html__('Paste the provided Google Code', 'besa').'</em>',
                        'default' => '',
                        'desc' => esc_html__('e.g.: https://fonts.googleapis.com/css?family=Open+Sans', 'besa'),
                        'required' => array('font_source','=','2')
                    ),

                    array (
                        'id' => 'main_custom_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;">'. sprintf(
                                                                    '%1$s <a href="%2$s">%3$s</a>',
                                                                    esc_html__( 'Video guide custom font in ', 'besa' ),
                                                                    esc_url( 'https://www.youtube.com/watch?v=ljXAxueAQUc' ),
                                                                    esc_html__( 'here', 'besa' )
                                ) .'</h3>',
                        'required' => array('font_source','=','3')
                    ),

                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Main Font', 'besa').'</h3>',
                        'required' => array('show_typography','=', true),
                    ),                    

                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'besa'),
                        'id' => 'main_font',
                        'type' => 'typography',
                        'line-height' => false,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => false,
                        'all_styles'=> true,
                        'font-size' => false,
                        'color' => false,
                        'default' => array (
                            'font-family' => '',
                            'subsets' => '',
                        ),
                        'required' => array('font_source','=','1')
                    ),
                    
                    // Google Custom                        
                    array (
                        'title' => esc_html__('Google Font Face', 'besa'),
                        'subtitle' => '<em>'.esc_html__('Enter your Google Font Name for the theme\'s Main Typography', 'besa').'</em>',
                        'desc' => esc_html__('e.g.: &#39;Open Sans&#39;, sans-serif', 'besa'),
                        'id' => 'main_google_font_face',
                        'type' => 'text',
                        'default' => '',
                        'required' => array('font_source','=','2')
                    ),                    

                    // main Custom fonts                      
                    array (
                        'title' => esc_html__('Main custom Font Face', 'besa'),
                        'subtitle' => '<em>'.esc_html__('Enter your Custom Font Name for the theme\'s Main Typography', 'besa').'</em>',
                        'desc' => esc_html__('e.g.: &#39;Open Sans&#39;, sans-serif', 'besa'),
                        'id' => 'main_custom_font_face',
                        'type' => 'text',
                        'default' => '',
                        'required' => array('font_source','=','3')
                    ),

                    array (
                        'id' => 'secondary_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '. esc_html__(' Secondary Font', 'besa').'</h3>',
                        'required' => array('show_typography','=', true),
                    ),
                    
                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'besa'),
                        'id' => 'secondary_font',
                        'type' => 'typography',
                        'line-height' => false,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => false,
                        'all_styles'=> true,
                        'font-size' => false,
                        'color' => false,
                        'required' => array('font_source','=','1')
                        
                    ),
                    
                    // Google Custom                        
                    array (
                        'title' => esc_html__('Google Font Face', 'besa'),
                        'subtitle' => '<em>'. esc_html__('Enter your Google Font Name for the theme\'s Secondary Typography', 'besa').'</em>',
                        'desc' => esc_html__('e.g.: &#39;Open Sans&#39;, sans-serif', 'besa'),
                        'id' => 'secondary_google_font_face',
                        'type' => 'text',
                        'default' => '',
                        'required' => array('font_source','=','2')
                    ),                    

                    // Main Custom fonts                        
                    array (
                        'title' => esc_html__('Main Custom Font Face', 'besa'),
                        'subtitle' => '<em>'. esc_html__('Enter your Custom Font Name for the theme\'s Secondary Typography', 'besa').'</em>',
                        'desc' => esc_html__('e.g.: &#39;Open Sans&#39;, sans-serif', 'besa'),
                        'id' => 'secondary_custom_font_face',
                        'type' => 'text',
                        'default' => '',
                        'required' => array('font_source','=','3')
                    ),
                )
            );

            // Style
            $this->sections[] = array(
                'title' => esc_html__('Header Mobile', 'besa'),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'       => 'header_mobile_bg',
                        'type'     => 'background',
                        'output' => $output['header_mobile_bg'],
                        'title'    => esc_html__( 'Header Mobile Background', 'besa' ),
                    ),
                    array (
                        'title' => esc_html__('Header Color', 'besa'),
                        'id' => 'header_mobile_color',
                        'type' => 'color',
                        'transparent' => false,
                        'output' => $output['header_mobile_color'],
                    ),                    
                )
            );


            // WooCommerce
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-shopping-cart',
                'title' => esc_html__('WooCommerce', 'besa'),
                'fields' => array(       
                    array(
                        'title'    => esc_html__('Label Sale Format', 'besa'),
                        'id'       => 'sale_tags',
                        'type'     => 'radio',
                        'options'  => array( 
                            'Sale!' => esc_html__('Sale!' ,'besa'),
                            'Save {percent-diff}%' => esc_html__('Save {percent-diff}% (e.g "Save 50%")' ,'besa'),
                            'Save {symbol}{price-diff}' => esc_html__('Save {symbol}{price-diff} (e.g "Save $50")' ,'besa'),
                            'custom' => esc_html__('Custom Format (e.g -50%, -$50)' ,'besa')
                        ),
                        'default' => 'custom'
                    ),
                    array(
                        'id'        => 'sale_tag_custom',
                        'type'      => 'text',
                        'title'     => esc_html__( 'Custom Format', 'besa' ),
                        'desc'      => esc_html__('{price-diff} inserts the dollar amount off.', 'besa'). '</br>'.
                                       esc_html__('{percent-diff} inserts the percent reduction (rounded).', 'besa'). '</br>'.
                                       esc_html__('{symbol} inserts the Default currency symbol.', 'besa'), 
                        'required'  => array('sale_tags','=', 'custom'),
                        'default'   => '-{percent-diff}%'
                    ), 
                    array(
                        'id' => 'enable_label_featured',
                        'type' => 'switch',
                        'title' => esc_html__('Enable "Featured" Label', 'besa'),
                        'default' => true
                    ),   
                    array(
                        'id'        => 'custom_label_featured',
                        'type'      => 'text',
                        'title'     => esc_html__( '"Featured Label" Custom Text', 'besa' ),
                        'required'  => array('enable_label_featured','=', true),
                        'default'   => esc_html__('Featured', 'besa')
                    ),
                    
                    array(
                        'id' => 'enable_brand',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Brand Name', 'besa'),
                        'subtitle' => esc_html__('Enable/Disable brand name on HomePage and Shop Page', 'besa'),
                        'default' => false
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),            
                    array(
                        'id' => 'product_display_image_mode',
                        'type' => 'image_select',
                        'title' => esc_html__('Product Image Display Mode', 'besa'),
                        'options' => array(
                            'one' => array(
                                'title' => esc_html__( 'Single Image', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/image_mode/single-image.png'
                            ),                                  
                            'two' => array(
                                'title' => esc_html__( 'Double Images (Hover)', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/image_mode/display-hover.gif'
                            ),                                                                         
                            'slider' => array(
                                'title' => esc_html__( 'Images (carousel)', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/image_mode/display-carousel.gif'
                            ),                                                      
                        ),
                        'default' => 'slider'
                    ),
                    array(
                        'id' => 'enable_quickview',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Quick View', 'besa'),
                        'default' => 1
                    ),                    
                    array(
                        'id' => 'enable_woocommerce_catalog_mode',
                        'type' => 'switch',
                        'title' => esc_html__('Show WooCommerce Catalog Mode', 'besa'),
                        'default' => false
                    ),                     
                    array(
                        'id' => 'ajax_update_quantity',
                        'type' => 'switch',
                        'title' => esc_html__('Quantity Ajax Auto-update', 'besa'),
                        'subtitle' => esc_html__('Enable/Disable quantity ajax auto-update on page Cart', 'besa'),
                        'default' => true
                    ),   
					array(
                        'id' => 'enable_variation_swatch',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Product Variation Swatch', 'besa'),
                        'subtitle' => esc_html__('Enable/Disable Product Variation Swatch on HomePage and Shop page', 'besa'),
                        'default' => true
                    ), 
                    array(
                        'id' => 'variation_swatch',
                        'type' => 'select',
                        'title' => esc_html__('Product Attribute', 'besa'),
                        'options' => besa_tbay_get_variation_swatchs(),
                        'default' => ''
                    ),  					                
                )
            );

            // woocommerce Breadcrumb settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Mini Cart', 'besa'),
                'fields' => array(
                     array(
                        'id' => 'woo_mini_cart_position',
                        'type' => 'select', 
                        'title' => esc_html__('Mini-Cart Position', 'besa'),
                        'options' => array( 
                            'left'       => esc_html__('Left', 'besa'),
                            'right'      => esc_html__('Right', 'besa'),
                            'popup'      => esc_html__('Popup', 'besa'),
                            'no-popup'   => esc_html__('None Popup', 'besa')
                        ),
                        'default' => 'popup'
                    ), 
                )
            ); 

            // woocommerce Breadcrumb settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Breadcrumb', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'show_product_breadcrumb',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Breadcrumb', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id' => 'product_breadcrumb_layout',
                        'type' => 'image_select',
                        'class'     => 'image-two',
                        'compiler' => true,
                        'title' => esc_html__('Breadcrumb Layout', 'besa'),
                        'required' => array('show_product_breadcrumb','=',1),
                        'options' => array(                          
                            'image' => array(
                                'title' => esc_html__( 'Background Image', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/breadcrumbs/image.jpg'
                            ),
                            'color' => array(
                                'title' => esc_html__( 'Background color', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/breadcrumbs/color.jpg'
                            ),
                            'text'=> array(
                                'title' => esc_html__( 'Text Only', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/breadcrumbs/text_only.jpg'
                            ),
                        ),
                        'default' => 'color'
                    ),
                    array (
                        'title' => esc_html__('Breadcrumb Background Color', 'besa'),
                        'subtitle' => '<em>'.esc_html__('The Breadcrumb background color of the site.', 'besa').'</em>',
                        'id' => 'woo_breadcrumb_color',
                        'required' => array('product_breadcrumb_layout','=',array('default','color')),
                        'type' => 'color',
                        'default' => '#f4f9fc',
                        'transparent' => false,
                    ),
                    array( 
                        'id' => 'woo_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumb Background', 'besa'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your Breadcrumb.', 'besa'),
                        'required' => array('product_breadcrumb_layout','=','image'),
                        'default'  => array( 
                            'url'=> BESA_IMAGES .'/breadcrumbs-woo.jpg'
                        ),
                    ),
                    array(
                        'id' => 'enable_previous_page_woo',
                        'type' => 'switch',
                        'title' => esc_html__('Previous page', 'besa'),
                        'default' => true
                    ), 
                )
            ); 

            // WooCommerce Archive settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Shop', 'besa'),
                'fields' => array(       
                    array(
                        'id' => 'product_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Shop Layout', 'besa'),
                        'options' => array(
                            'shop-left' => array(
                                'title' => esc_html__( 'Left Sidebar', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/product_archives/shop_left_sidebar.jpg'
                            ),                                  
                            'shop-right' => array(
                                'title' => esc_html__( 'Right Sidebar', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/product_archives/shop_right_sidebar.jpg'
                            ),                                                                         
                            'full-width' => array(
                                'title' => esc_html__( 'No Sidebar', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/product_archives/shop_no_sidebar.jpg'
                            ),                                                      
                        ),
                        'default' => 'shop-left'
                    ),
                    array(
                        'id' => 'product_archive_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Sidebar', 'besa'),
                        'options' => $sidebars,
                        'default' => 'product-archive'
                    ),
                    array(
                        'id' => 'show_product_top_archive',
                        'type' => 'switch',
                        'title' => esc_html__('Show sidebar Top Archive product', 'besa'),
                        'default' => false
                    ),   
                    array(
                        'id' => 'enable_display_mode',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Products Display Mode', 'besa'),
                        'subtitle' => esc_html__('Enable/Disable Display Mode', 'besa'),
                        'default' => true
                    ),   
                    array(
                        'id' => 'product_display_mode',
                        'type' => 'button_set',
                        'title' => esc_html__('Products Display Mode', 'besa'),
                        'required' => array('enable_display_mode','=',1),
                        'options' => array(
                            'grid' => esc_html__('Grid', 'besa'), 
                            'list' => esc_html__('List', 'besa')
                        ),
                        'default' => 'grid'
                    ),                                
                    array(
                        'id' => 'title_product_archives',
                        'type' => 'switch',
                        'title' => esc_html__('Show Title of Categories', 'besa'),
                        'default' => false 
                    ),                       
                    array(
                        'id' => 'pro_des_image_product_archives',
                        'type' => 'switch',
                        'title' => esc_html__('Show Description, Image of Categories', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id' => 'number_products_per_page',
                        'type' => 'slider',
                        'title' => esc_html__('Number of Products Per Page', 'besa'),
                        'default' => 12,
                        'min' => 1,
                        'step' => 1,
                        'max' => 100,
                    ),
                    array(
                        'id' => 'product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Columns', 'besa'),
                        'options' => $columns,
                        'default' => 3
                    ),
                    array(
                        'id' => 'product_pagination_style',
                        'type' => 'select',
                        'title' => esc_html__('Product Pagination Style', 'besa'),
                        'options' => array( 
                            'number' => esc_html__('Pagination Number', 'besa'),
                            'loadmore'  => esc_html__('Load More Button', 'besa'),  
                        ),
                        'default' => 'number' 
                    ),
                    array(
                        'id' => 'product_type_fillter',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Shop by Product Type', 'besa'),
                        'default' => 0
                    ),                     
                    array(
                        'id' => 'product_per_page_fillter',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Number of Product', 'besa'),
                        'default' => 0
                    ),                       
                    array(
                        'id' => 'product_category_fillter',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Shop by Categories', 'besa'),
                        'default' => 0
                    ),                    
                )
            );
            // Product Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Product', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'product_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Select Single Product Layout', 'besa'),
                        'options' => array(
                            'vertical' => array(
                                'title' => esc_html__('Image Vertical', 'besa'),
                                'img' => BESA_ASSETS_IMAGES . '/product_single/verical_thumbnail.jpg'
                            ),                             
                            'horizontal' => array(
                                'title' => esc_html__('Image Horizontal', 'besa'),
                                'img' => BESA_ASSETS_IMAGES . '/product_single/horizontal_thumbnail.jpg'
                            ),                                                                                  
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'besa'),
                                'img' => BESA_ASSETS_IMAGES . '/product_single/left_main_sidebar.jpg'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'besa'),
                                'img' => BESA_ASSETS_IMAGES . '/product_single/main_right_sidebar.jpg'
                            ),
                        ),
                        'default' => 'horizontal'
                    ),                   
                    array(
                        'id' => 'product_single_sidebar',
                        'type' => 'select',
                        'required' => array('product_single_layout','=',array('left-main','main-right')),
                        'title' => esc_html__('Single Product Sidebar', 'besa'),
                        'options' => $sidebars,
                        'default' => 'product-single'
                    ),
                )
            );


            // Product Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Product Advanced Options', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'enable_total_sales',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Total Sales', 'besa'),
                        'default' => true
                    ),                     
                    array(
                        'id' => 'enable_buy_now',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Buy Now', 'besa'),
                        'default' => false
                    ),
                    array(
                        'title' => esc_html__('Background', 'besa'),
                        'subtitle' => esc_html__('Background button Buy Now', 'besa'),
                        'id' => 'bg_buy_now', 
                        'required' => array('enable_buy_now','=',true),
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '#fcd537',
                    ),      
                    array( 
                        'id' => 'redirect_buy_now',
                        'required' => array('enable_buy_now','=',true),
                        'type' => 'button_set',
                        'title' => esc_html__('Redirect to page after Buy Now', 'besa'),
                        'options' => array( 
                                'cart'          => 'Page Cart',
                                'checkout'      => 'Page CheckOut',
                        ),
                        'default' => 'cart'
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),   
                    array(
                        'id' => 'style_single_tabs_style',
                        'type' => 'button_set',
                        'title' => esc_html__('Tab Mode', 'besa'),
                        'options' => array(
                                'fulltext'          => 'Full Text',
                                'tabs'          => 'Tabs',
                                'accordion'        => 'Accordion',
                        ),
                        'default' => 'fulltext'
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),
                    array(
                        'id' => 'enable_size_guide',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Size Guide', 'besa'),
                        'default' => 1
                    ),
                    array(
                        'id'       => 'size_guide_title',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Size Guide Title', 'besa' ),
                        'required' => array('enable_size_guide','=', true),
                        'default'  => esc_html__( 'Size chart', 'besa' ),
                    ),    
                    array(
                        'id'       => 'size_guide_icon',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Size Guide Icon', 'besa' ),
                        'required' => array('enable_size_guide','=', true),
                        'desc'       => esc_html__( 'Enter icon name of fonts: ', 'besa' ) . '<a href="//fontawesome.com/v4.7.0/" target="_blank">Awesome</a> , <a href="//fonts.thembay.com/simple-line-icons//" target="_blank">simplelineicons</a>, <a href="//fonts.thembay.com/linearicons/" target="_blank">linearicons</a>',
                        'default'  => 'tb-icon tb-icon-chevron-right',
                    ),                
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),
                   array(
                        'id' => 'show_product_nav',
                        'type' => 'switch', 
                        'title' => esc_html__('Enable Product Navigator', 'besa'),
                        'default' => true
                    ),        
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),    
                    array(
                        'id' => 'enable_sticky_menu_bar',
                        'type' => 'switch',
                        'title' => esc_html__('Sticky Menu Bar', 'besa'),
                        'subtitle' => esc_html__('Enable/disable Sticky Menu Bar', 'besa'),
                        'default' => false
                    ),
                    array(
                        'id' => 'enable_zoom_image',
                        'type' => 'switch',
                        'title' => esc_html__('Zoom inner image', 'besa'),
                        'subtitle' => esc_html__('Enable/disable Zoom inner Image', 'besa'),
                        'default' => false
                    ),    
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide', 
                        'type' => 'divide'
                    ),                 
                    array(
                        'id' => 'video_aspect_ratio',
                        'type' => 'select',
                        'title' => esc_html__('Featured Video Aspect Ratio', 'besa'),
                        'subtitle' => esc_html__('Choose the aspect ratio for your video', 'besa'),
                        'options' => $aspect_ratio,
                        'default' => '16_9'
                    ),     
                    array(
                        'id'      => 'video_position',
                        'title'    => esc_html__( 'Featured Video Position', 'besa' ),
                        'type'    => 'select',
                        'default' => 'last',
                        'options' => array(
                            'last' => esc_html__( 'The last product gallery', 'besa' ),
                            'first' => esc_html__( 'The first product gallery', 'besa' ),
                        ),
                    ),  
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),              
                    array(
                        'id' => 'enable_product_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Social Share', 'besa'),
                        'subtitle' => esc_html__('Enable/disable Social Share', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id' => 'enable_product_review_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Product Review Tab', 'besa'),
                        'subtitle' => esc_html__('Enable/disable Review Tab', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id' => 'enable_product_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Products Releated', 'besa'),
                        'subtitle' => esc_html__('Enable/disable Products Releated', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id' => 'enable_product_upsells',
                        'type' => 'switch',
                        'title' => esc_html__('Products upsells', 'besa'),
                        'subtitle' => esc_html__('Enable/disable Products upsells', 'besa'),
                        'default' => true
                    ),                    
                    array(
                        'id' => 'enable_product_countdown',
                        'type' => 'switch',
                        'title' => esc_html__('Products Countdown', 'besa'),
                        'subtitle' => esc_html__('Enable/disable Products Countdown', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id' => 'number_product_thumbnail',
                        'type'  => 'slider',
                        'title' => esc_html__('Number Images Thumbnail to show', 'besa'),
                        'default' => 4,
                        'min'   => 2,
                        'step'  => 1,
                        'max'   => 5,
                    ),  
                    array(
                        'id' => 'number_product_releated',
                        'type' => 'slider',
                        'title' => esc_html__('Number of related products to show', 'besa'),
                        'default' => 8,
                        'min' => 1,
                        'step' => 1,
                        'max' => 20,
                    ),                    
                    array(
                        'id' => 'releated_product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Products Columns', 'besa'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id'       => 'html_before_add_to_cart_btn',
                        'type'     => 'textarea',
                        'title'    => esc_html__( 'HTML before Add To Cart button (Global)', 'besa' ),
                        'desc'     => esc_html__( 'Enter HTML and shortcodes that will show before Add to cart selections.', 'besa' ),
                    ),
                    array(
                        'id'       => 'html_after_add_to_cart_btn',
                        'type'     => 'textarea',
                        'title'    => esc_html__( 'HTML after Add To Cart button (Global)', 'besa' ),
                        'desc'     => esc_html__( 'Enter HTML and shortcodes that will show after Add to cart button.', 'besa' ),
                    ),
                )

            );
            // Recent View Product
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Recently Viewed Products', 'besa'),
                'fields' => array(
                    array(
                        'id'=>'show_recentview',
                        'type' => 'switch',
                        'title' => esc_html__('Show Recently View', 'besa'),
                        'subtitle'  => esc_html__( 'show only page shop ', 'besa' ),
                        'default' => true,
                    ),
                    array(
                        'id'       => 'title_recentview',
                        'type'     => 'text',
                        'required' => array('show_recentview','equals',true),
                        'title'    => esc_html__( 'Custom Title', 'besa' ),
                        'default'  => esc_html__( 'Recent Viewed', 'besa' ),
                        'required' => array('show_recentview','equals', true),
                    ),
                    array(
                        'id' => 'max_products_recentview',
                        'type'  => 'slider',
                        'title' => esc_html__('Number of Display Products', 'besa'),
                        'desc'  => esc_html__( 'Max products of results show in Desktop', 'besa' ),
                        'required' => array('show_recentview','equals',true),
                        'default' => 8,
                        'min'   => 6,
                        'step'  => 1,
                        'max'   => 16,
                    ),
                    array(
                        'id'       => 'empty_text_recentview',
                        'type'     => 'text',
                        'required' => array('show_recentview','equals',true),
                        'title'    => esc_html__( 'Empty Result - Custom Paragraph', 'besa' ),
                        'default'  => esc_html__( 'You have no recently viewed item.', 'besa' ),
                    ),
                    array(
                        'id'=>'show_recentview_viewall',
                        'type' => 'switch',
                        'title' => esc_html__('Show Button "View All"', 'besa'),
                        'required' => array('show_recentview','equals', true),
                        'default' => true,
                    ),
                    array(
                        'id'       => 'recentview_viewall_text',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Button "View All" Custom Text', 'besa' ),
                        'required' => array('show_recentview_viewall','equals',true),
                        'default'  => 'View all',
                    ),
                    array(
                        'id'       => 'recentview_select_pages',
                        'type'     => 'select',
                        'data'     => 'pages',
                        'title'    => esc_html__( 'Select Link Page To Button "View All"', 'besa' ),
                        'required' => array('show_recentview_viewall','equals', true),
                    ),

                )

            );

            // woocommerce Menu Account settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Account', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'show_woocommerce_password_strength',
                        'type' => 'switch',
                        'title' => esc_html__('Show Password Strength Meter', 'besa'),
                        'default' => true
                    ),  
                )
            );


            // woocommerce Multi-vendor settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Multi-vendor', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'show_vendor_name',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Vendor Name', 'besa'),
                        'subtitle' => esc_html__('Enable/Disable Vendor Name on HomePage and Shop page', 'besa'),
                        'default' => true
                    ),  
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),
                    array(
                        'id' => 'show_info_vendor_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Tab Info Vendor', 'besa'),
                        'subtitle' => esc_html__('Enable/Disable tab Info Vendor on Product Detail', 'besa'),
                        'default' => true
                    ), 
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),
                    array(
                        'id'        => 'show_seller_tab',
                        'type'      => 'none',
                        'title'     => esc_html__('Enable/Disable Tab Products Seller', 'besa'),
                        'subtitle'  => sprintf(__('Go to the <a href="%s" target="_blank">Setting</a> of each Seller to Enable/Disable this tab.', 'besa'), home_url('dashboard/settings/store/')),
                    ),
                    array(
                        'id' => 'seller_tab_per_page',
                        'type' => 'slider',
                        'title' => esc_html__('Dokan Number of Products Seller Tab', 'besa'),
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                    ),
                    array(
                        'id' => 'seller_tab_columns',
                        'type' => 'select',
                        'title' => esc_html__('Dokan Product Columns Seller Tab', 'besa'),
                        'options' => $columns,
                        'default' => 4
                    ),
                )
            );

            // Blog settings
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-border-color',
                'title' => esc_html__('Blog', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'show_blog_breadcrumb',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumb', 'besa'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'blog_breadcrumb_layout',
                        'type' => 'image_select',
                        'class'     => 'image-two',
                        'compiler' => true,
                        'title' => esc_html__('Select Breadcrumb Blog Layout', 'besa'),
                        'required' => array('show_blog_breadcrumb','=',1),
                        'options' => array(                        
                            'image' => array(
                                'title' => esc_html__( 'Background Image', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/breadcrumbs/image.jpg'
                            ),
                            'color' => array(
                                'title' => esc_html__( 'Background color', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/breadcrumbs/color.jpg'
                            ),
                            'text'=> array(
                                'title' => esc_html__( 'Text Only', 'besa' ),
                                'img'   => BESA_ASSETS_IMAGES . '/breadcrumbs/text_only.jpg'
                            ),
                        ),
                        'default' => 'color'
                    ),
                    array (
                        'title' => esc_html__('Breadcrumb Background Color', 'besa'),
                        'id' => 'blog_breadcrumb_color',
                        'type' => 'color',
                        'default' => '#fafafa',
                        'transparent' => false,
                        'required' => array('blog_breadcrumb_layout','=',array('default','color')),
                    ),
                    array(
                        'id' => 'blog_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumb Background Image', 'besa'),
                        'subtitle' => esc_html__('Image File (.png or .jpg)', 'besa'),
                        'default'  => array(
                            'url'=> BESA_IMAGES .'/breadcrumbs-blog.jpg'
                        ),
                        'required' => array('blog_breadcrumb_layout','=','image'),
                    ),
                    array(
                        'id' => 'enable_previous_page_post',
                        'type' => 'switch',
                        'title' => esc_html__('Previous page', 'besa'),
                        'subtitle' => esc_html__('Enable Previous Page Button', 'besa'),
                        'default' => true
                    ), 
                )
            );

            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog Article', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'blog_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Blog Layout', 'besa'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__( 'Articles', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/blog_archives/blog_no_sidebar.jpg'
                            ),
                            'left-main' => array(
                                'title' => esc_html__( 'Articles - Left Sidebar', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/blog_archives/blog_left_sidebar.jpg'
                            ),
                            'main-right' => array(
                                'title' => esc_html__( 'Articles - Right Sidebar', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/blog_archives/blog_right_sidebar.jpg'
                            ),                   
                        ),
                        'default' => 'main-right'
                    ),
                    array(
                        'id' => 'blog_archive_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Blog Archive Sidebar', 'besa'),
                        'options' => $sidebars,
                        'default' => 'blog-archive-sidebar',
                        'required' => array('blog_archive_layout','!=','main'),
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Post Column', 'besa'),
                        'options' => $columns,
                        'default' => '2'
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),   
                    array(
                        'id' => 'image_position',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Post Image Position', 'besa'),
                        'options' => array(
                            'top' => array(
                                'title' => esc_html__( 'Top', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/blog_archives/image_top.jpg'
                            ),
                            'left' => array(
                                'title' => esc_html__( 'Left', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/blog_archives/image_left.jpg'
                            ),                  
                        ),
                        'default' => 'top'
                    ),                 
                    array(
                        'id' => 'blog_image_sizes',
                        'type' => 'select',
                        'title' => esc_html__('Post Image Size', 'besa'),
                        'options' => $blog_image_size,
                        'default' => 'full'
                    ),                 
                    array(
                        'id' => 'enable_date',
                        'type' => 'switch',
                        'title' => esc_html__('Date', 'besa'),
                        'default' => true
                    ),                    
                    array(
                        'id' => 'enable_author',
                        'type' => 'switch',
                        'title' => esc_html__('Author', 'besa'),
                        'default' => false
                    ),                        
                    array(
                        'id' => 'enable_categories',
                        'type' => 'switch',
                        'title' => esc_html__('Categories', 'besa'),
                        'default' => true
                    ),                                            
                    array(
                        'id' => 'enable_comment',
                        'type' => 'switch',
                        'title' => esc_html__('Comment', 'besa'),
                        'default' => true
                    ),                    
                    array(
                        'id' => 'enable_comment_text',
                        'type' => 'switch',
                        'title' => esc_html__('Comment Text', 'besa'),
                        'required' => array('enable_comment', '=', true),
                        'default' => false
                    ),                    
                    array(
                        'id' => 'enable_short_descriptions',
                        'type' => 'switch',
                        'title' => esc_html__('Short descriptions', 'besa'),
                        'default' => false
                    ),                    
                    array(
                        'id' => 'enable_readmore',
                        'type' => 'switch',
                        'title' => esc_html__('Read More', 'besa'),
                        'default' => false
                    ),
                    array(
                        'id' => 'text_readmore',
                        'type' => 'text',
                        'title' => esc_html__('Button "Read more" Custom Text', 'besa'),
                        'required' => array('enable_readmore', '=', true),
                        'default' => 'Continue Reading',
                    ),
                )
            );

            // Single Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog Post', 'besa'),
                'fields' => array(
                    
                    array(
                        'id' => 'blog_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Blog Single Layout', 'besa'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__( 'Main Only', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/single _post/main.jpg'
                            ),
                            'left-main' => array(
                                'title' => esc_html__( 'Left - Main Sidebar', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/single _post/left_sidebar.jpg'
                            ),
                            'main-right' => array(
                                'title' => esc_html__( 'Main - Right Sidebar', 'besa' ),
                                'img' => BESA_ASSETS_IMAGES . '/single _post/right_sidebar.jpg'
                            ),
                        ),
                        'default' => 'main-right'
                    ),
                    array(
                        'id' => 'blog_single_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Sidebar', 'besa'),
                        'options'   => $sidebars,
                        'default'   => 'blog-single-sidebar',
                        'required' => array('blog_single_layout','!=','main'),
                    ),
                    array(
                        'id' => 'show_blog_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'besa'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_blog_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Related Posts', 'besa'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_blog_releated',
                        'type' => 'slider',
                        'title' => esc_html__('Number of Related Posts', 'besa'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 20,
                    ),
                    array(
                        'id' => 'releated_blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Columns of Related Posts', 'besa'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'options' => $columns,
                        'default' => 2
                    ),

                )
            );

            // Social Media
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-share',
                'title' => esc_html__('Social Share', 'besa'),
                'fields' => array(
                    array(
                        'id' => 'enable_code_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Code Share', 'besa'),
                        'default' => true
                    ),
                    array(
                        'id'       => 'select_share_type',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Please select a sharing type', 'besa' ),
                        'required'  => array('enable_code_share','=', true),
                        'options'  => array(
                            'custom' => 'TB Share',
                            'addthis' => 'Add This',
                        ),
                        'default'  => 'addthis'
                    ),
                    array(
                        'id'        =>'code_share',
                        'type'      => 'textarea',
                        'required'  => array('select_share_type','=', 'addthis'),
                        'title'     => esc_html__('"Addthis" Your Code', 'besa'), 
                        'desc'      => esc_html__('You get your code share in https://www.addthis.com', 'besa'),
                        'validate'  => 'html_custom',
                        'default'   => '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59f2a47d2f1aaba2"></script>'
                    ),
                    array(
                        'id'       => 'sortable_sharing',
                        'type'     => 'sortable',
                        'mode'     => 'checkbox',
                        'title'    => esc_html__( 'Sortable Sharing', 'besa' ),
                        'required'  => array('select_share_type','=', 'custom'),
                        'options'  => array(
                            'facebook'      => 'Facebook',
                            'twitter'       => 'Twitter',
                            'linkedin'      => 'Linkedin',
                            'pinterest'     => 'Pinterest',
                            'whatsapp'      => 'Whatsapp',
                            'email'         => 'Email',
                        ),
                        'default'   => array(
                            'facebook'  => true,
                            'twitter'   => true,
                            'linkedin'  => true,
                            'pinterest' => false,
                            'whatsapp'  => false,
                            'email'     => true,
                        )
                    ),
                )
            );

            // Performance
            $this->sections[] = array(
                'icon' => 'el-icon-cog',
                'title' => esc_html__('Performance', 'besa'),
            );   
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Performance', 'besa'),
                'fields' => array(
                    array (
                        'id'       => 'minified_js',
                        'type'     => 'switch',
                        'title'    => esc_html__('Include minified JS', 'besa'),
                        'subtitle' => esc_html__('Minified version of functions.js and device.js file will be loaded', 'besa'),
                        'default' => true
                    ),
                )
            );

            // Custom Code
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-code-setting',
                'title' => esc_html__('Custom CSS/JS', 'besa'),
            );            

            // Css Custom Code
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Custom CSS', 'besa'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Global Custom CSS', 'besa'),
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    array (
                        'title' => esc_html__('Custom CSS for desktop', 'besa'),
                        'id' => 'css_desktop',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    array (
                        'title' => esc_html__('Custom CSS for tablet', 'besa'),
                        'id' => 'css_tablet',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    array (
                        'title' => esc_html__('Custom CSS for mobile landscape', 'besa'),
                        'id' => 'css_wide_mobile',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    array (
                        'title' => esc_html__('Custom CSS for mobile', 'besa'),
                        'id' => 'css_mobile',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                )
            );

            // Js Custom Code
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Custom Js', 'besa'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Header JavaScript Code', 'besa'),
                        'subtitle' => '<em>'.esc_html__('Paste your custom JS code here. The code will be added to the header of your site.', 'besa').'<em>',
                        'id' => 'header_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                    
                    array (
                        'title' => esc_html__('Footer JavaScript Code', 'besa'),
                        'subtitle' => '<em>'.esc_html__('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'besa').'<em>',
                        'id' => 'footer_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                )
            );



            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'besa'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'besa'),
                'icon' => 'zmdi zmdi-download',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => 'Import Export',
                        'subtitle' => 'Save and restore your Redux options',
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );
        }
		
		
		
		
        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
		 
		 /**
     * Custom function for the callback validation referenced above
     * */
		
		 
        public function setArguments()
        {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'besa_tbay_theme_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Besa Options', 'besa'),
                'page_title' => esc_html__('Besa Options', 'besa'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => false,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'besa-admin-icon',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'besa_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
				'forced_dev_mode_off' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => 61,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => BESA_ASSETS_IMAGES . '/admin/theme-admin-icon-small.png', 
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE

                // HINTS
                'hints' => array(
                    'icon' => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
            );
            
            $this->args['intro_text'] = '';

            // Add content after the form.
            $this->args['footer_text'] = '';
            return $this->args;
			
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
			
        }
    }

    global $reduxConfig;
    $reduxConfig = new Besa_Redux_Framework_Config();
	
}