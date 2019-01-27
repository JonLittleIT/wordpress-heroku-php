<?php
/**
 * @package     bitther
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

/*  Setup Theme ===================================================================================================== */
add_action( 'after_setup_theme', 'bitther_theme_setup' );
if ( ! function_exists( 'bitther_theme_setup' ) ) :
    function bitther_theme_setup() {
        load_theme_textdomain( 'bitther', get_template_directory() . '/languages' );

        //  Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        //  Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        //  Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        //Enable support for Post Formats.
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ) );

        add_editor_style( array( 'assets/css/editor-style.css', bitther_font_url() ) );

        add_theme_support( 'custom-header' );

        add_theme_support( 'custom-background' );

        add_theme_support( "title-tag" );

        add_theme_support( 'woocommerce' );
		
		
    }
endif;

/* Thumbnail Sizes ================================================================================================== */
set_post_thumbnail_size( 220, 150, true);

add_image_size( 'bitther-single-post-cat', 890 ,450, true);

add_image_size( 'bitther-single', 890 ,450, true);

add_image_size( 'bitther-blog-list', 390 ,260, true);
add_image_size( 'bitther-blog-list-large', 435 ,290, true);
add_image_size( 'bitther-grid-big', 430 ,260, true);

add_image_size( 'bitther-blog-tran', 590 ,540, true);
add_image_size( 'bitther-blog-trans-vertical', 510 ,430, true);
add_image_size( 'bitther-blog-tran-large', 895 ,420, true);

add_image_size( 'bitther-blog-grid', 510 ,328, true);
add_image_size( 'bitther-blog-vertical', 510 ,680, true);

add_image_size( 'bitther-video',250,140,true);
add_image_size( 'bitther-video-image',620,440,true);

add_image_size( 'bitther-video-large',880,489,true);
add_image_size( 'bitther-video-horizontal',895,503,true);

add_image_size( 'bitther-sidebar', 100 ,90, true);
add_image_size( 'bitther-related-image',280,180,true);

/* Setup Font ======================================================================================================= */
function bitther_font_url() {

    $fonts_url = '';
    $poppins     = _x( 'on', 'Poppins font: on or off', 'bitther' );

    if ( 'off' !== $poppins ) {
        $font_families = array();
        if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:400,600,500,700';
        }
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}


/* Load Front-end scripts  ========================================================================================== */
add_action( 'wp_enqueue_scripts', 'bitther_theme_scripts');
function bitther_theme_scripts() {

    // Add  fonts, used in the main stylesheet.
    wp_enqueue_style( 'bitther_fonts', bitther_font_url(), array(), null );
    //style plugins
    wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), '3.0.2 ');
    wp_enqueue_style('awesome-font',get_template_directory_uri().'/assets/css/font-awesome.min.css', array(), '4.6.3');
    wp_enqueue_style('jquery-ui',get_template_directory_uri().'/assets/css/jquery-ui.min.css', array(), '1.11.4');
    wp_enqueue_style('themify-icons',get_template_directory_uri().'/assets/css/themify-icons.css', array(),null);
    wp_enqueue_style('photoswipe',get_template_directory_uri().'/assets/css/photoswipe.css', array(), null);
    wp_enqueue_style('default-skin',get_template_directory_uri().'/assets/css/default-skin/default-skin.css', array(), null);
    //style MAIN THEME
    wp_enqueue_style( 'bitther-main', get_template_directory_uri(). '/style.css', array(), null );
    //style skin
    wp_enqueue_style('bitther-css', get_template_directory_uri().'/assets/css/style-default.min.css' );

    //register all plugins
    wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/assets/js/plugins/bootstrap.min.js', array(), '2.2.0', true );
    wp_enqueue_script( 'html5', get_template_directory_uri().'/assets/js/plugins/html5.min.js', array(), '2.2.0', true );
    wp_enqueue_script( 'slicknav', get_template_directory_uri().'/assets/js/plugins/jquery.slicknav.min.js', array(), '2.2.0', true );
    wp_enqueue_script( 'skip-link-focus', get_template_directory_uri().'/assets/js/plugins/skip-link-focus-fix.min.js', array(), '2.2.0', true );
    wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri().'/assets/js/jquery.sticky-sidebar.js', array(), '2.2.0', true );
    wp_enqueue_script( 'slick', get_template_directory_uri().'/assets/js/plugins/slick.min.js', array(), '2.2.0', true );

    wp_enqueue_script( 'isotope', get_template_directory_uri().'/assets/js/plugins/isotope.pkgd.min.js', array(), '2.2.0', true );
    wp_enqueue_script( 'lazy', get_template_directory_uri().'/assets/js/plugins/jquery.lazy.js', array(), '2.2.0', true );
    wp_enqueue_script( 'nanoscroller', get_template_directory_uri().'/assets/js/plugins/jquery.nanoscroller.min.js',  array( 'jquery' ),'0.8.7', true );
    wp_enqueue_script( 'photoswipe', get_template_directory_uri().'/assets/js/plugins/photoswipe.min.js', array(), null, true );
    wp_enqueue_script( 'photoswipe-ui-default', get_template_directory_uri().'/assets/js/plugins/photoswipe-ui-default.min.js', array(), null, true );
    wp_register_script('tweets-widgets', get_template_directory_uri().'/assets/js/plugins/tweets-widgets.min.js','jquery', '2.3.0', true);
    wp_enqueue_script( 'videoController', get_template_directory_uri().'/assets/js/plugins/jquery.videoController.min.js', array(), '2.2.0', true );

    wp_enqueue_script('jquery-masonry');

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'bitther-theme-keyboard-image-navigation', get_template_directory_uri() . '/assets/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20141010' );
    }

    //jquery MAIN THEME
    wp_enqueue_script('bitther-init', get_template_directory_uri() . '/assets/js/dev/bitther-init.js', array('jquery'),null, true);
    wp_enqueue_script('bitther-slick', get_template_directory_uri() . '/assets/js/dev/slick-init.js', array('jquery'),null, true);
    wp_enqueue_script('bitther', get_template_directory_uri() . '/assets/js/dev/bitther.js', array('jquery'),null, true);

}

/* Load Back-end SCRIPTS============================================================================================= */
function bitther_js_enqueue()
{
    wp_enqueue_media();
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    // moved the js to an external file, you may want to change the path
    wp_enqueue_script('information_js',get_template_directory_uri(). '/assets/js/widget.min.js', 'jquery', '1.0', true);
}
add_action('admin_enqueue_scripts', 'bitther_js_enqueue');

/* Register the required plugins    ================================================================================= */
add_action( 'tgmpa_register', 'bitther_register_required_plugins' );
function bitther_register_required_plugins() {

    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'      => esc_html__( 'Nano Core Plugin', 'bitther' ),
            'slug'      => 'theme-core',
            'source'    => get_template_directory() . '/inc/theme-plugins/theme-core.zip',
            'required'  => true,
            'version'   => '1.0.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/nano.jpg',

        ),
        //Contact form 7
        array(
            'name'      => esc_html__('Contact Form 7', 'bitther' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/contact-form7.jpg',
        ),
        //WPBakery Visual Composer
        array(
            'name'      =>  esc_html__('WPBakery Page Builder', 'bitther' ),
            'slug'      => 'js_composer',
            'source'    => get_template_directory() . '/inc/theme-plugins/js_composer.zip',
            'required'  => true,
            'version'   => '5.5.4',
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/vc.jpg',
        ),
        //WPBakery Visual Composer
        array(
            'name'      =>  esc_html__('Cryptocurrency Price Ticker Widget PRO', 'bitther' ),
            'slug'      => 'cryptocurrency-price-ticker-widget-pro',
            'source'    => get_template_directory() . '/inc/theme-plugins/cryptocurrency-price-ticker-widget-pro.zip',
            'required'  => true,
            'version'   => '1.8.1',
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/cryptocurrency.jpg',
        ),

        //MailChimp for WordPress
        array(
            'name'      =>  esc_html__('MailChimp for WordPress ', 'bitther' ),
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/mailchimp.jpg',
        ),
    );

    $config = array(
        'id'           => 'bitther',                   // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                       // Default absolute path to pre-packaged plugins.
        'has_notices'  => true,
        'menu'         => 'tgmpa-install-plugins',  // Menu slug.
        'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'is_automatic' => true,                     // Automatically activate plugins after installation or not.
        'message'      => '',                       // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );

}

/* Register Navigation ============================================================================================== */
register_nav_menus( array(
    'primary_navigation'    => esc_html__( 'Primary Navigation', 'bitther' )
) );

/* Register Sidebar ================================================================================================= */
if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
        'name'          => esc_html__( 'Archive', 'bitther' ),
        'id'            => 'archive',
        'description'   => esc_html__( 'Add widgets here to appear in the sidebar Home-Page.', 'bitther' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Blogs', 'bitther' ),
        'id'            => 'blogs',
        'description'   => esc_html__( 'Add widgets here to appear in the sidebar Archive.', 'bitther' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Single', 'bitther' ),
        'id'            => 'single',
        'description'   => esc_html__( 'Add widgets here to appear in the single sidebar .', 'bitther' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar(array(
        'name' => esc_html__('Footer 1','bitther'),
        'id'   => 'footer-top1',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2','bitther'),
        'id'   => 'footer-bottom1',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3','bitther'),
        'id'   => 'footer-top2',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Center ','bitther'),
        'id'   => 'footer-center',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Topbar Left','bitther'),
        'id'   => 'topbar-left',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Topbar Right','bitther'),
        'id'   => 'topbar-right',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Top Header','bitther'),
        'id'   => 'custom-topbar-middle',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Header ADS','bitther'),
        'id'   => 'custom-header-ads',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Custom Header Middle','bitther'),
        'id'   => 'custom-header-middle',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Custom Header Left','bitther'),
        'id'   => 'custom-header-left',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Custom Copy Right','bitther'),
        'id'   => 'copy-right',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}