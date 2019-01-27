<?php

if ( ! isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}


/**
||-> porfoliowp_redux
*/
function porfoliowp_redux($redux_meta_name1,$redux_meta_name2 = ''){

    global  $porfoliowp_redux;

    $html = '';
    if (isset($redux_meta_name1) && !empty($redux_meta_name2)) {
        $html = $porfoliowp_redux[$redux_meta_name1][$redux_meta_name2];
    }elseif(isset($redux_meta_name1) && empty($redux_meta_name2)){
        $html = $porfoliowp_redux[$redux_meta_name1];
    }
    
    return $html;

}


/**
||-> porfoliowp_setup
*/
function porfoliowp_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on porfoliowp, use a find and replace
     * to change 'porfoliowp' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'porfoliowp', get_template_directory() . '/languages' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_attr__( 'Primary menu', 'porfoliowp' ),
        'burger' => esc_attr__( 'Burger menu', 'porfoliowp' )
    ) );

    global  $porfoliowp_redux;

    // ADD THEME SUPPORT
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );
    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    // Enable support for Post Formats.
    add_theme_support( 'custom-background', apply_filters( 'smartowl_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );// Set up the WordPress core custom background feature.

}
add_action( 'after_setup_theme', 'porfoliowp_setup' );

/**
||-> Register widget area.
||-> @link http://codex.wordpress.org/Function_Reference/register_sidebar
*/
function porfoliowp_widgets_init() {

    global  $porfoliowp_redux;

    register_sidebar( array(
        'name'          => esc_attr__( 'Sidebar', 'porfoliowp' ),
        'id'            => 'sidebar-1',
        'description'   => esc_attr__( 'Sidebar 1', 'porfoliowp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );

    if (!empty($porfoliowp_redux['mt_dynamic_sidebars'])){
        foreach ($porfoliowp_redux['mt_dynamic_sidebars'] as &$value) {
            $id           = str_replace(' ', '', $value);
            $id_lowercase = strtolower($id);
            if ($id_lowercase) {
                register_sidebar( array(
                    'name'          => esc_attr($value),
                    'id'            => esc_attr($id_lowercase),
                    'description'   => esc_attr__( 'Sidebar ', 'porfoliowp' ) . esc_attr($value),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }
    }
    
    // FOOTER ROW 1
    if (isset($porfoliowp_redux['mt_footer_row_1_layout'])) {
        $footer_row_1 = $porfoliowp_redux['mt_footer_row_1_layout'];
        $nr1 = array("1", "2", "3", "4", "5", "6");
        if (in_array($footer_row_1, $nr1)) {
            for ($i=1; $i <= $footer_row_1 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 1 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_1_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 1 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_1 == 'column_half_sub_half' || $footer_row_1 == 'column_sub_half_half') {
            $footer_row_1 = '3';
            for ($i=1; $i <= $footer_row_1 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 1 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'id'            => 'footer_row_1_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 1 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_1 == 'column_sub_fourth_third' || $footer_row_1 == 'column_third_sub_fourth') {
            $footer_row_1 = '5';
            for ($i=1; $i <= $footer_row_1 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 1 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_1_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 1 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_1 == 'column_sub_third_half' || $footer_row_1 == 'column_half_sub_third') {
            $footer_row_1 = '4';
            for ($i=1; $i <= $footer_row_1 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 1 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_1_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 1 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }
    }

    // FOOTER ROW 2
    if (isset($porfoliowp_redux['mt_footer_row_2_layout'])) {
        $footer_row_2 = $porfoliowp_redux['mt_footer_row_2_layout'];
        $nr2 = array("1", "2", "3", "4", "5", "6");
        if (in_array($footer_row_2, $nr2)) {
            for ($i=1; $i <= $footer_row_2 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 2 - Sidebar ','porfoliowp').esc_url($i),
                    'id'            => 'footer_row_2_'.esc_url($i),
                    'description'   => esc_attr__( 'Footer Row 2 - Sidebar ', 'porfoliowp' ) . esc_url($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_2 == 'column_half_sub_half' || $footer_row_2 == 'column_sub_half_half') {
            $footer_row_2 = '3';
            for ($i=1; $i <= $footer_row_2 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 2 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_2_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 2 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_2 == 'column_sub_fourth_third' || $footer_row_2 == 'column_third_sub_fourth') {
            $footer_row_2 = '5';
            for ($i=1; $i <= $footer_row_2 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 2 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_2_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 2 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_2 == 'column_sub_third_half' || $footer_row_2 == 'column_half_sub_third') {
            $footer_row_2 = '4';
            for ($i=1; $i <= $footer_row_2 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 2 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_2_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 2 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }
    }

    // FOOTER ROW 3
    if (isset($porfoliowp_redux['mt_footer_row_3_layout'])) {
        $footer_row_3 = $porfoliowp_redux['mt_footer_row_3_layout'];
        $nr3 = array("1", "2", "3", "4", "5", "6");
        if (in_array($footer_row_3, $nr3)) {
            for ($i=1; $i <= $footer_row_3 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 3 - Sidebar ', 'porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_3_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 3 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_3 == 'column_half_sub_half' || $footer_row_3 == 'column_sub_half_half') {
            $footer_row_3 = '3';
            for ($i=1; $i <= $footer_row_3 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 3 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_3_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 3 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_3 == 'column_sub_fourth_third' || $footer_row_3 == 'column_third_sub_fourth') {
            $footer_row_3 = '5';
            for ($i=1; $i <= $footer_row_3 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 3 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_3_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 3 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }elseif ($footer_row_3 == 'column_sub_third_half' || $footer_row_3 == 'column_half_sub_third') {
            $footer_row_3 = '4';
            for ($i=1; $i <= $footer_row_3 ; $i++) { 
                register_sidebar( array(
                    'name'          => esc_attr__( 'Footer Row 3 - Sidebar ','porfoliowp').esc_attr($i),
                    'id'            => 'footer_row_3_'.esc_attr($i),
                    'description'   => esc_attr__( 'Footer Row 3 - Sidebar ', 'porfoliowp' ) . esc_attr($i),
                    'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h1 class="widget-title">',
                    'after_title'   => '</h1>',
                ) );
            }
        }
    }
}
add_action( 'widgets_init', 'porfoliowp_widgets_init' );


/**
||-> Enqueue scripts and styles.
*/
function porfoliowp_scripts() {

    global  $porfoliowp_redux;

    //STYLESHEETS
    wp_enqueue_style( "font-awesome", get_template_directory_uri().'/css/font-awesome.min.css' );
    wp_enqueue_style( "porfoliowp-responsive", get_template_directory_uri().'/css/responsive.css' );
    wp_enqueue_style( "porfoliowp-media-screens", get_template_directory_uri().'/css/media-screens.css' );
    wp_enqueue_style( "owl-carousel", get_template_directory_uri().'/css/owl.carousel.css' );
    wp_enqueue_style( "owl-theme", get_template_directory_uri().'/css/owl.theme.css' );
    wp_enqueue_style( "animate", get_template_directory_uri().'/css/animate.css' );
    wp_enqueue_style( "porfoliowp-style", get_template_directory_uri().'/css/styles.css' );
    wp_enqueue_style( 'porfoliowp-mt-style', get_stylesheet_uri() );
    wp_enqueue_style( "porfoliowp-header-style", get_template_directory_uri().'/css/styles-headers.css' );
    wp_enqueue_style( "porfoliowp-footer-style", get_template_directory_uri().'/css/styles-footer.css' );
    wp_enqueue_style( "sidebarEffects", get_template_directory_uri().'/css/sidebarEffects.css' );
    wp_enqueue_style( "loaders", get_template_directory_uri().'/css/loaders.css' );
    wp_enqueue_style( "rippler", get_template_directory_uri().'/css/rippler.min.css' );
    wp_enqueue_style( "simple-line-icons", get_template_directory_uri().'/css/simple-line-icons.css' );
    wp_enqueue_style( "js_composer", get_template_directory_uri().'/css/js_composer.css' );
    wp_enqueue_style( "porfoliowp-gutenberg-frontend", get_template_directory_uri().'/css/gutenberg-frontend.css' );

    //SCRIPTS
    wp_enqueue_script( 'porfoliowp-plugins', get_template_directory_uri() . '/js/porfoliowp-plugins.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'scrollIt', get_template_directory_uri() . '/js/scrollIt.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'stickykit', get_template_directory_uri() . '/js/jquery.sticky-kit.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'loaders', get_template_directory_uri() . '/js/loaders.css.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'porfoliowp-custom-js', get_template_directory_uri() . '/js/porfoliowp-custom.js', array('jquery'), '1.0.0', true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'porfoliowp_scripts' );


/**
||-> Enqueue admin css/js
*/
function porfoliowp_enqueue_admin_scripts( $hook ) {
    // JS
    wp_enqueue_script( "porfoliowp_admin_scripts", get_template_directory_uri().'/js/porfoliowp-admin-scripts.js' , array( 'jquery' ) );
    wp_enqueue_script( "loaders", get_template_directory_uri().'/js/loaders.css.js' , array( 'jquery' ) );
    // CSS
    wp_enqueue_style( "porfoliowp_admin_css", get_template_directory_uri().'/css/admin-style.css' );
    wp_enqueue_style( "loaders", get_template_directory_uri().'/css/loaders.css' );
}
add_action('admin_enqueue_scripts', 'porfoliowp_enqueue_admin_scripts');


/**
||-> Enqueue css to js_composer
*/
add_action( 'vc_base_register_front_css', 'porfoliowp_enqueue_front_css_foreever' );
function porfoliowp_enqueue_front_css_foreever() {
    wp_enqueue_style( 'js_composer_front' );
}


/**
||-> Enqueue css to redux
*/
function porfoliowp_register_fontawesome_to_redux() {
    wp_register_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', array(), time(), 'all' );  
    wp_enqueue_style( 'font-awesome' );
}
add_action( 'redux/page/redux_demo/enqueue', 'porfoliowp_register_fontawesome_to_redux' );


/**
||-> Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
*/
add_action( 'vc_before_init', 'porfoliowp_vcSetAsTheme' );
function porfoliowp_vcSetAsTheme() {
    vc_set_as_theme( true );
}


/**
||-> Other required parts/files
*/
/* ========= LOAD CUSTOM FUNCTIONS ===================================== */
require_once get_template_directory() . '/inc/custom-functions.php';
require_once get_template_directory() . '/inc/custom-functions.header.php';
require_once get_template_directory() . '/inc/custom-functions.footer.php';
/* ========= Customizer additions. ===================================== */
require_once get_template_directory() . '/inc/customizer.php';
/* ========= Load Jetpack compatibility file. ===================================== */
require_once get_template_directory() . '/inc/jetpack.php';
/* ========= Include the TGM_Plugin_Activation class. ===================================== */
require_once get_template_directory() . '/inc/tgm/include_plugins.php';
/* ========= LOAD - REDUX - FRAMEWORK ===================================== */
require_once get_template_directory() . '/redux-framework/modeltheme-config.php';
/* ========= CUSTOM COMMENTS ===================================== */
require_once get_template_directory() . '/inc/custom-comments.php';
require_once get_template_directory() . '/inc/custom-functions.gutenberg.php';


/**
||-> add_image_size //Resize images
*/
/* ========= RESIZE IMAGES ===================================== */
add_image_size( 'porfoliowp_related_post_pic500x300', 500, 300, true );
add_image_size( 'porfoliowp_post_pic700x450',         700, 450, true );
add_image_size( 'porfoliowp_post_widget_pic100x100',  100, 100, true );
add_image_size( 'porfoliowp_about_625x415',           625, 415, true );
add_image_size( 'porfoliowp_single_article_1150x400',           1150, 400, true );
add_image_size( 'porfoliowp_listing_archive_featured_square',    600, 370, true );
add_image_size( 'porfoliowp_listing_archive_featured',    800, 500, true );
add_image_size( 'porfoliowp_listing_archive_thumbnail',   300, 180, true );
add_image_size( 'porfoliowp_listing_single_featured',     1200, 200, true );
add_image_size( 'porfoliowp_listing_single_wide',     1200, 400, true );


/**
||-> LIMIT POST CONTENT
*/
function porfoliowp_excerpt_limit($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if(count($words) > $word_limit) {
        array_pop($words);
    }
    return implode(' ', $words);
}


/**
||-> BREADCRUMBS
*/
function porfoliowp_breadcrumb() {
    
    global  $porfoliowp_redux;

    if ( !$porfoliowp_redux['mt_enable_breadcrumbs'] ) {
        return false;
    }

    $delimiter = '';
    $html =  '';
    //text for the 'Home' link
    $name = esc_attr__("Home", "porfoliowp");
    $currentBefore = '<li class="active">';
    $currentAfter = '</li>';

        if (!is_home() && !is_front_page() || is_paged()) {
            global  $post;
            $home = esc_url(home_url('/'));
            $html .= '<li><a href="' . esc_url($home) . '">' . esc_attr($name) . '</a></li> ' . esc_attr($delimiter) . '';
        
        if (is_category()) {
            global  $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0)
            $html .= (get_category_parents($parentCat, true, '' . esc_attr($delimiter) . ''));
            $html .= $currentBefore . single_cat_title('', false) . $currentAfter;
        }elseif (is_tax()) {
            global  $wp_query;
            $html .= $currentBefore . single_cat_title('', false) . $currentAfter;
        } elseif (is_day()) {
            $html .= '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . esc_attr($delimiter) . '';
            $html .= '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . esc_attr($delimiter) . ' ';
            $html .= $currentBefore . get_the_time('d') . $currentAfter;
        } elseif (is_month()) {
            $html .= '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . esc_attr($delimiter) . '';
            $html .= $currentBefore . get_the_time('F') . $currentAfter;
        } elseif (is_year()) {
            $html .= $currentBefore . get_the_time('Y') . $currentAfter;
        } elseif (is_attachment()) {
            $html .= $currentBefore;
            $html .= get_the_title();
            $html .= $currentAfter;
        } elseif (class_exists( 'WooCommerce' ) && is_shop()) {
            $html .= $currentBefore;
            $html .= esc_attr__('Shop','porfoliowp');
            $html .= $currentAfter;
        }elseif (class_exists( 'WooCommerce' ) && is_product()) {

            global  $post;
            $cat = get_the_terms( $post->ID, 'product_cat' );
            foreach ($cat as $categoria) {
                if ($categoria) {
                    if($categoria->parent == 0){

                        // Get the ID of a given category
                        $category_id = get_cat_ID( $categoria->name );

                        // Get the URL of this category
                        $category_link = get_category_link( $category_id );

                        $html .= '<li><a href="#">' . esc_attr($categoria->name) . '</a></li>';
                        $html .= esc_url($category_link);
                    }
                }
            }

            $html .= $currentBefore;
            $html .= get_the_title();
            $html .= $currentAfter;

        } elseif (is_single()) {
            if (get_the_category()) {
                $cat = get_the_category();
                $cat = $cat[0];
                $html .= '<li>' . get_category_parents($cat, true, ' ' . esc_attr($delimiter) . '') . '</li>';
            }
            $html .= $currentBefore;
            $html .= get_the_title();
            $html .= $currentAfter;
        } elseif (is_page() && !$post->post_parent) {
            $html .= $currentBefore;
            $html .= get_the_title();
            $html .= $currentAfter;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb)
                $html .= $crumb . ' ' . esc_attr($delimiter) . ' ';
            $html .= $currentBefore;
            $html .= get_the_title();
            $html .= $currentAfter;
        } elseif (is_search()) {
            $html .= $currentBefore . get_search_query() . $currentAfter;
        } elseif (is_tag()) {
            $html .= $currentBefore . single_tag_title( '', false ) . $currentAfter;
        } elseif (is_author()) {
            global  $author;
            $userdata = get_userdata($author);
            $html .= $currentBefore . $userdata->display_name . $currentAfter;
        } elseif (is_404()) {
            $html .= $currentBefore . esc_attr__('404 Not Found','porfoliowp') . $currentAfter;
        }
        if (get_query_var('paged')) {
            if (is_home() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                $html .= $currentBefore;
            $html .= esc_attr__('Page','porfoliowp') . ' ' . get_query_var('paged');
            if (is_home() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                $html .= $currentAfter;
        }
    }

    return $html;
}


/**
||-> PAGINATION
*/
if ( ! function_exists( 'porfoliowp_pagination' ) ) {
    function porfoliowp_pagination($query = null) {

        if (!$query) {
            global  $wp_query;
            $query = $wp_query;
        }
        
        $big = 999999999; // need an unlikely integer
        $current = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : '1');
        echo paginate_links( 
            array(
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'        => '?paged=%#%',
                'current'       => max( 1, $current ),
                'total'         => $query->max_num_pages,
                'prev_text'     => '&#171;',
                'next_text'     => '&#187;',
            ) 
        );
    }
}


/**
||-> SEARCH FOR POSTS ONLY
*/
function porfoliowp_search_filter($query) {
    if ($query->is_search && !isset($_GET['post_type'])) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','porfoliowp_search_filter');


/**
||-> FUNCTION: ADD EDITOR STYLE
*/
function porfoliowp_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'porfoliowp_add_editor_styles' );


/**
||-> FUNCTION: CUSTOM SEARCH FORM
*/
function porfoliowp_custom_search_form(){

    global  $porfoliowp_redux;

    $search_for = 'post';

    $content = '';
    $content .= '<div class="modeltheme-search">
                    <form method="GET" action="'.esc_url(home_url('/')).'">
                        <input class="search-input" placeholder="'.esc_attr__('Enter search term...', 'porfoliowp').'" type="search" value="" name="s" id="search" />
                        <i class="fa fa-search"></i>
                        <input type="hidden" name="post_type" value="post" />
                    </form>
                </div>';

    return $content;
}


/**
||-> REMOVE PLUGINS NOTIFICATIONS and NOTICES
*/
// |---> REVOLUTION SLIDER
if(function_exists( 'set_revslider_as_theme' )){
    add_action( 'init', 'porfoliowp_disable_revslider_update_notices' );
    function porfoliowp_disable_revslider_update_notices() {
        set_revslider_as_theme();
    }
}




?>