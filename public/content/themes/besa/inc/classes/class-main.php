<?php

/**
 * Class besa_setup_theme'
 */
class besa_setup_theme {
    function __construct() {
        add_action( 'after_setup_theme', array( $this, 'setup' ), 10 );

        add_action('wp', 'besa_get_display_header_builder');

        add_action( 'wp_enqueue_scripts', array( $this, 'load_fonts_url' ), 10 );
        add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ), 100 );
        add_action('wp_footer', array( $this, 'footer_scripts' ), 20 );
        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
        add_filter( 'frontpage_template', array( $this, 'front_page_template' ) );

        /**Remove fonts scripts**/
        add_action('wp_enqueue_scripts', array( $this, 'remove_fonts_redux_url' ), 1000 );

        add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_styles' ), 1000 );
        add_action( 'login_enqueue_scripts', array( $this, 'load_admin_styles' ), 1000 );


        add_action( 'after_switch_theme', array( $this, 'add_cpt_support'), 10 );
    }

    /**
     * Enqueue scripts and styles.
     */
    public function add_scripts() {
       
        $suffix = (besa_tbay_get_config('minified_js', false)) ? '.min' : BESA_MIN_JS;


        // load bootstrap style 
        if( is_rtl() ){
            wp_enqueue_style( 'bootstrap', BESA_STYLES . '/bootstrap.rtl.css', array(), '4.3.1' );
        }else{
            wp_enqueue_style( 'bootstrap', BESA_STYLES . '/bootstrap.css', array(), '4.3.1' );
        }
        
        // Load our main stylesheet.
        if( is_rtl() ){
            $css_path =  BESA_STYLES . '/template.rtl.css';
        }
        else{
            $css_path =  BESA_STYLES . '/template.css';
        }

		$css_array = array();

        if( besa_is_elementor_activated() ) {
            array_push($css_array, 'elementor-frontend'); 
        } 
        wp_enqueue_style( 'besa-template', $css_path, $css_array, BESA_THEME_VERSION );
        
        wp_enqueue_style( 'besa-style', BESA_THEME_DIR . '/style.css', array(), BESA_THEME_VERSION );

        //load font awesome
        
        wp_enqueue_style( 'font-awesome', BESA_STYLES . '/font-awesome.css', array(), '5.10.2' );

        //load font custom icon tbay
        wp_enqueue_style( 'besa-font-tbay-custom', BESA_STYLES . '/font-tbay-custom.css', array(), '1.0.0' );

        //load simple-line-icons
        wp_enqueue_style( 'simple-line-icons', BESA_STYLES . '/simple-line-icons.css', array(), '2.4.0' );

        //load linear icons
        if( (bool) besa_tbay_get_config( 'show_font_linearicons', true ) ) {
            wp_enqueue_style( 'linearicons', BESA_STYLES . '/linearicons.css', array(), '1.0.0' );
        }

        //load material font icons
        wp_enqueue_style( 'material-design-iconic-font', BESA_STYLES . '/material-design-iconic-font.css', array(), '2.2.0' );

        // load animate version 3.5.0
        wp_enqueue_style( 'animate', BESA_STYLES . '/animate.css', array(), '3.5.0' );

        
        wp_enqueue_script( 'besa-skip-link-fix', BESA_SCRIPTS . '/skip-link-fix' . $suffix . '.js', array(), BESA_THEME_VERSION, true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }


        /*mmenu menu*/ 
        wp_register_script( 'jquery-mmenu', BESA_SCRIPTS . '/jquery.mmenu' . $suffix . '.js', array( 'underscore' ),'7.0.5', true );

        wp_register_script( 'jquery-instagramfeed', BESA_SCRIPTS . '/jquery.instagramfeed' . $suffix . '.js', array( ),'1.1.3', true );
        wp_register_script( 'jquery-timeago', BESA_SCRIPTS . '/jquery.timeago' . $suffix . '.js', array( ),'1.6.7', true );
     
        /*Treeview menu*/
        wp_enqueue_style( 'jquery-treeview',  BESA_STYLES . '/jquery.treeview.css', array(), '1.0.0' );
        
        wp_register_script( 'popper', BESA_SCRIPTS . '/popper' . $suffix . '.js', array(), '1.12.9', true );        

        if( class_exists('WeDevs_Dokan') ) { 
            wp_dequeue_script( 'dokan-tooltip' );  
        }
         
        wp_enqueue_script( 'bootstrap', BESA_SCRIPTS . '/bootstrap' . $suffix . '.js', array('popper'), '4.3.1', true );          

        wp_register_script( 'js-cookie', BESA_SCRIPTS . '/js.cookie' . $suffix . '.js', array(), '2.1.4', true );  
  
        /*slick jquery*/
        wp_register_script( 'slick', BESA_SCRIPTS . '/slick' . $suffix . '.js', array(), '1.0.0', true );
        wp_register_script( 'besa-custom-slick', BESA_SCRIPTS . '/custom-slick' . $suffix . '.js', array(), BESA_THEME_VERSION, true ); 
  
        // Add js Sumoselect version 3.0.2
        wp_register_style('sumoselect', BESA_STYLES . '/sumoselect.css', array(), '1.0.0', 'all');
        wp_register_script('jquery-sumoselect', BESA_SCRIPTS . '/jquery.sumoselect' . $suffix . '.js', array( ), '3.0.2', TRUE);   

        wp_register_script( 'jquery-autocomplete', BESA_SCRIPTS . '/jquery.autocomplete' . $suffix . '.js', array('besa-script' ), '1.0.0', true );     
        wp_enqueue_script('jquery-autocomplete'); 

        wp_register_style( 'magnific-popup', BESA_STYLES . '/magnific-popup.css', array(), '1.0.0' );
        wp_enqueue_style('magnific-popup');

      
        wp_register_script( 'jquery-countdowntimer', BESA_SCRIPTS . '/jquery.countdownTimer' . $suffix . '.js', array( ), '20150315', true );

        wp_enqueue_script( 'besa-script',  BESA_SCRIPTS . '/functions' . $suffix . '.js', array('js-cookie'),  BESA_THEME_VERSION,  true );


        wp_enqueue_script( 'detectmobilebrowser', BESA_SCRIPTS . '/detectmobilebrowser' . $suffix . '.js', array(), '1.0.6', true );
       
        wp_enqueue_script( 'jquery-fastclick', BESA_SCRIPTS . '/jquery.fastclick' . $suffix . '.js', array(), '1.0.6', true );

        if ( besa_tbay_get_config('header_js') != "" ) {
            wp_add_inline_script( 'besa-script', besa_tbay_get_config('header_js') );
        }
  
        $config = besa_localize_translate();

        wp_localize_script( 'besa-script', 'besa_settings', $config );
        
    }

    public function footer_scripts() {
        if ( besa_tbay_get_config('footer_js') != "" ) {
            $footer_js = besa_tbay_get_config('footer_js');
            echo trim($footer_js);
        }
    }

    public function remove_fonts_redux_url() {
        $show_typography  = besa_tbay_get_config('show_typography', false);
        if( !$show_typography ) {
            wp_dequeue_style( 'redux-google-fonts-besa_tbay_theme_options' );
        } 
    }
 
    public function load_admin_styles() {
        wp_enqueue_style( 'material-design-iconic-font', BESA_STYLES . '/material-design-iconic-font.css', false, '2.2.0' ); 
        wp_enqueue_style( 'besa-custom-admin', BESA_STYLES . '/admin/custom-admin.css', false, '1.0.0' );

        $suffix = (besa_tbay_get_config('minified_js', false)) ? '.min' : BESA_MIN_JS;
        wp_enqueue_script( 'besa-admin', BESA_SCRIPTS . '/admin/admin' . $suffix . '.js', array( ), BESA_THEME_VERSION, true );
    }

    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */
    public function widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar Default', 'besa' ),
            'id'            => 'sidebar-default',
            'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'besa' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        

        /* Check WPML */
        if ( function_exists('icl_object_id') ) {
            register_sidebar( array(
                'name'          => esc_html__( 'WPML Sidebar', 'besa' ),
                'id'            => 'wpml-sidebar',
                'description'   => esc_html__( 'Add widgets here to appear.', 'besa' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );
        }
        /* End check WPML */

        register_sidebar( array(
            'name'          => esc_html__( 'Footer', 'besa' ),
            'id'            => 'footer',
            'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'besa' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) ); 

    }

    public function add_cpt_support() {
        $cpt_support = ['tbay_megamenu', 'tbay_footer', 'tbay_header', 'post', 'page']; 
        update_option( 'elementor_cpt_support', $cpt_support);

        update_option( 'elementor_disable_color_schemes', 'yes'); 
        update_option( 'elementor_disable_typography_schemes', 'yes');
        update_option( 'elementor_container_width', '1200');
        update_option( 'elementor_viewport_lg', '1200');  
        update_option( 'elementor_space_between_widgets', '0');
        update_option( 'elementor_load_fa4_shim', 'yes');
    }

    public function edit_post_show_excerpt( $user_login, $user ) {
        update_user_meta( $user->ID, 'metaboxhidden_post', true );
    }
    

    /**
     * Use front-page.php when Front page displays is set to a static page.
     *
     * @param string $template front-page.php.
     *
     * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
     */
    public function front_page_template( $template ) {
        return is_home() ? '' : $template;
    }

    public function setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on besa, use a find and replace
         * to change 'besa' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'besa', BESA_THEMEROOT . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        add_theme_support( "post-thumbnails" );

        add_image_size('besa_avatar_post_carousel', 100, 100, true);

        // This theme styles the visual editor with editor-style.css to match the theme style.
        $font_source = besa_tbay_get_config('show_typography', false);
        if( !$font_source ) {
            add_editor_style( array( 'css/editor-style.css', $this->fonts_url() ) );
        }

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );


        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        
        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'gallery', 'audio' 
        ) );

        $color_scheme  = besa_tbay_get_color_scheme();
        $default_color = trim( $color_scheme[0], '#' );

        // Setup the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'besa_custom_background_args', array(
            'default-color'      => $default_color,
            'default-attachment' => 'fixed',
        ) ) );

        add_action( 'wp_login', array( $this, 'edit_post_show_excerpt'), 10, 2 );


        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary'           => esc_html__( 'Primary Menu', 'besa' ),
            'mobile-menu'       => esc_html__( 'Mobile Menu','besa' ),
            'nav-category-menu'  => esc_html__( 'Nav Category Menu', 'besa' ),
            'track-order'  => esc_html__( 'Tracking Order Menu', 'besa' ),
        ) );

        update_option( 'page_template', 'elementor_header_footer'); 
    }

    public function load_fonts_url() {
        $protocol         = is_ssl() ? 'https:' : 'http:';
        $show_typography  = besa_tbay_get_config('show_typography', false);
        $font_source      = besa_tbay_get_config('font_source', "1");
        $font_google_code = besa_tbay_get_config('font_google_code');
        if( !$show_typography ) {
            wp_enqueue_style( 'besa-theme-fonts', $this->fonts_url(), array(), null );
        } else if ( $font_source == "2" && !empty($font_google_code) ) {
            wp_enqueue_style( 'besa-theme-fonts', $font_google_code, array(), null );
        }
    }

    public function fonts_url() {
        /**
         * Load Google Front
         */

        $fonts_url = '';

        /* Translators: If there are characters in your language that are not
        * supported by Montserrat, translate this to 'off'. Do not translate
        * into your own language.
        */
        $Open_Sans       = _x( 'on', 'Open Sans font: on or off', 'besa' );
     
        if ( 'off' !== $Open_Sans ) {
            $font_families = array(); 
     
            if ( 'off' !== $Open_Sans ) {
                $font_families[] = 'Open Sans:400,600,700,800';
            }           
     
            $query_args = array(
                'family' => rawurlencode( implode( '%7C', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
                'display' => urlencode( 'swap' ),
            ); 
            
            $protocol = is_ssl() ? 'https:' : 'http:';
            $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
        }
     
        return esc_url_raw( $fonts_url );
    }
    public function instagram_image_only() {

        $output = TRUE;

        return $output;

    }

}

return new besa_setup_theme();