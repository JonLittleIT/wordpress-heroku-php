<?php

if ( ! isset( $content_width ) ) $content_width = 940;
require_once get_template_directory().'/functions-amos.php';
/* --------------------- Load Core Functions ------------------------- */
require_once( get_template_directory().'/includes/core/amos_config.php' );
require_once( get_template_directory().'/includes/core/core-functions.php' );
/* --------------------- End Load Core ------------------------------ */


/* ---------------------- Load for Visual Composer --------------------*/

require_once( get_template_directory().'/includes/core/theme-vc-templates-visual-editor.php' );
require_once( get_template_directory().'/includes/core/theme-vc-templates.php' );

/*------------------------ End Load for VC -----------------------------*/


/* --------------------- Load MetaBoxes ----------------------------------- */
require_once get_template_directory().'/includes/amos-slider/amos_slider_options.php';
require_once get_template_directory().'/includes/amos-slider/amos_slider.php';
require_once get_template_directory().'/includes/core/amos_metaboxes.php';
/* --------------------- End Load Metaboxes ------------------------------ */




require_once get_template_directory().'/includes/core/amos_routing.php';



/* --------------------- Register ------------------------------------ */
require_once  get_template_directory().'/includes/register/register_sidebars.php';
/* --------------------- End Register -------------------------------- */


/* --------------------- Required Plugins Activation ----------------- */
require_once get_template_directory().'/includes/core/amos_required_plugins.php' ;
require_once( get_template_directory() .'/envato_setup/envato_setup_init.php');
require_once( get_template_directory() .'/envato_setup/envato_setup.php');
/* --------------------- Required Plugins Activation ----------------- */


/* --------------------- Amos Slider Load ------------------------ */
require_once get_template_directory().'/includes/core/amos_slideshow.php' ;
/* --------------------- End Amos Slider Load -------------------- */





/* --------------------- Load Widgets -------------------------------- */
require_once get_template_directory().'/includes/widgets/amos_flickr.php';
require_once get_template_directory().'/includes/widgets/amos_mostpopular.php';
require_once get_template_directory().'/includes/widgets/amos_shortcodewidget.php';
require_once get_template_directory().'/includes/widgets/amos_socialwidget.php';
require_once get_template_directory().'/includes/widgets/amos_topnavwidget.php';
require_once get_template_directory().'/includes/widgets/amos_twitter.php';
require_once get_template_directory().'/includes/widgets/amos_ads.php';
/* --------------------- End Load Widgets ---------------------------- */


/* -------------------- Load Custom Menu ----------------------------- */
require_once get_template_directory().'/includes/core/amos_megamenu.php';
/* -------------------- Load Custom Menu ----------------------------- */

/* -------------------- Load Woocommerce Functions ----------------------------- */
if(class_exists( 'woocommerce' ))
    require_once get_template_directory().'/functions-woocommerce.php';

add_action( 'after_setup_theme', 'amos_woocommerce_setup' );
 
function amos_woocommerce_setup() {
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
/* -------------------- Load Custom Menu ----------------------------- */

/* -------------------- Setup Theme ---------------------------------- */
add_action('init', 'amos_default_redata', 1);

add_action( 'after_setup_theme', 'amos_setup' );

function amos_setup(){

    add_action('init', 'amos_language_setup');
    add_action('wp_enqueue_scripts', 'amos_register_global_styles');
    add_action('wp_enqueue_scripts', 'amos_register_global_scripts');

    add_filter( 'https_ssl_verify', '__return_false' );
    add_filter( 'https_local_ssl_verify', '__return_false' );
    
    amos_theme_support();
    amos_images_sizes();
    amos_navigation_menus();
    amos_register_widgets();  
    new amos_custom_menu();
    $templates = new amos_Add_Templates;
    $templates->init();
}

/* -------------------- End Setup Theme --------------------------------- */


/* -------------------- PO/MO files ------------------------------------- */

function amos_language_setup() {
    $lang_dir = get_template_directory() . '/languages';
    load_theme_textdomain('amos', $lang_dir);
} 

/* -------------------- End PO/MO files --------------------------------- */



/* -------------------- Theme Support ----------------------------------- */

function amos_theme_support(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support('nav_menus');
    add_theme_support( 'post-formats', array( 'quote', 'gallery','video', 'audio' ) ); 
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    add_theme_support( "title-tag" );
}

/* -------------------- End Theme Support ------------------------------- */



/* -------------------- Add Various Image Sizes ------------------------ */

function amos_images_sizes(){
    
    add_image_size( 'amos_col2', 800, 500, true );
    add_image_size( 'amos_col3', 400, 300, true );
    add_image_size( 'amos_col4', 300, 240, true );
    add_image_size( 'amos_port', 960, 740, true );
    add_image_size( 'amos_col1', 1200, 600, true );
    add_image_size( 'amos_alternate_blog', 440, 280, true );
    add_image_size( 'amos_alternate_blog_side', 355, 235, true );
    add_image_size( 'amos_staff', 500, 500, true );
   

}

/* -------------------- End Add Various Image Sizes --------------------- */


/* -------------------- Register Navigations ---------------------------- */

function amos_navigation_menus(){
    global $amos_redata;
    $navigations = array('main' => esc_html__('Main Navigation', 'amos'));

    if(isset($amos_redata['menu_presets']) && $amos_redata['menu_presets'] == 'h5')
        $navigations = array('left' => esc_html__('Left menu', 'amos'), 'right' => esc_html__('Right menu', 'amos')); 

    foreach($navigations as $id => $name){ 
    	register_nav_menu($id, THEMETITLE.' '.$name); 
    }
}

/* -------------------- End Register Navigation ------------------------ */


/* -------------------- Register Widgets ------------------------------- */

function amos_register_widgets(){
	register_widget( 'AmosTwitter' );
    register_widget( 'AmosSocialWidget' );
    register_widget( 'AmosFlickrWidget' );
    register_widget( 'AmosShortcodeWidget' );
    register_widget( 'AmosMostPopularWidget');
    register_widget( 'AmosTopNavWidget');
    register_widget( 'AmosAdsWidget');
}

/* -------------------- End Register Widgets ------------------------ */


/* -------------------- Register Styles used over all pages --------- */

function amos_register_global_styles(){
    global $amos_redata;   
    
    
    wp_enqueue_style('bootstrap', AMOS_BASE_URL.'css/bootstrap.css' );
    wp_enqueue_style('flexslider', AMOS_BASE_URL.'css/flexslider.css');
    wp_enqueue_style('amos-shortcodes', AMOS_BASE_URL. 'css/shortcodes.css');
    wp_enqueue_style('animate', AMOS_BASE_URL.'css/animate.min.css');
    wp_enqueue_style('style', get_stylesheet_uri());

    if ( class_exists( 'WooCommerce' ) )
        wp_enqueue_style('amos-woocommerce', AMOS_BASE_URL.'css/woocommerce.css' );

    if($amos_redata['amos_page_transition'])
     wp_enqueue_style('animsition', AMOS_BASE_URL. 'css/animsition.min.css' );

    wp_enqueue_style('bootstrap-responsive', AMOS_BASE_URL.'css/bootstrap-responsive.css');
    wp_enqueue_style('jquery-fancybox', AMOS_BASE_URL.'fancybox/source/jquery.fancybox.css?v=2.1.2' ); 
    wp_enqueue_style('font-awesome', AMOS_BASE_URL.'css/font-awesome.min.css');  
    wp_enqueue_style( 'idangerous-swiper', AMOS_BASE_URL.'css/idangerous.swiper.css');
    wp_enqueue_style( 'owl-carousel', AMOS_BASE_URL.'css/owl.carousel.css' );
    wp_enqueue_style( 'owl-theme' ,AMOS_BASE_URL.'css/owl.theme.css' ); 
    wp_enqueue_style('amos-dynamic-css', admin_url('admin-ajax.php').'?action=dynamic_css');
    if(!class_exists('ElleFramework')){
        wp_enqueue_style('amos-default', AMOS_BASE_URL.'css/default.css');
        wp_enqueue_style('amos-fonts-default', amos_enqueue_default_fonts() , array(), '1.0.0');
    }

    $p_id = amos_get_post_id();
    if(isset($p_id) && !empty($p_id) && function_exists('redux_post_meta'))
        if( redux_post_meta('amos_redata',(int) $p_id, 'fullscreen_post_style' ) || $amos_redata['fullscreen_sections_active'] )
            wp_enqueue_style('amos-fullscreen_post_css', AMOS_BASE_URL.'css/fullscreen_post.css');
      

}


function amos_enqueue_default_fonts(){
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'amos' ) ) {
           
            $font_url = add_query_arg( 'family', urlencode( 'Montserrat|Open Sans:300,400,500,600,700' ), "//fonts.googleapis.com/css" );
            
            return $font_url;
    }
}


/* -------------------- Register Styles used over all pages --------- */



/* -------------------- Register Scripts used over all pages --------- */

function amos_register_global_scripts(){
            
    global $amos_redata;
    global $amos_current_view;

    if($amos_redata['amos_page_transition'])
     wp_enqueue_script( 'jquery-animsitions', AMOS_BASE_URL. 'js/jquery.animsition.min.js', array(), '', true);
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script( 'amos-load-css-async', AMOS_BASE_URL. 'js/amos-loadCSS.js', array(), '', false );
    wp_enqueue_script( 'bootstrap', AMOS_BASE_URL.'js/bootstrap.min.js', array('jquery'), 1, true );
    wp_enqueue_script( 'jquery-easing', AMOS_BASE_URL.'js/jquery.easing.1.3.js', array('jquery'), 1, true  );
    wp_enqueue_script( 'jquery-easypiechart', AMOS_BASE_URL.'js/jquery.easy-pie-chart.js', array('jquery'), 1, true  );
  

    if($amos_redata['nicescroll']){
        wp_enqueue_script('jquery-nicescroll', AMOS_BASE_URL.'js/jquery.nicescroll.min.js', array('jquery'), 1, true);
    }

    wp_enqueue_script( 'waypoints', AMOS_BASE_URL.'js/waypoints.min.js', array('jquery'), 1, true);


    if(class_exists('WPBakeryVisualComposerAbstract')) {

       wp_enqueue_script('pathformer',AMOS_BASE_URL.'js/pathformer.js', array('jquery'), 1, false );
       wp_enqueue_script('vivus', AMOS_BASE_URL.'js/vivus.js', array('jquery', 'pathformer'), 1, false);  
       wp_enqueue_script('odometer', AMOS_BASE_URL.'js/odometer.min.js', array('jquery'), 1, true );
       wp_enqueue_script('jquery-appear', AMOS_BASE_URL.'js/jquery.appear.js', array('jquery'), 1, true );
           
    }

    wp_enqueue_script('modernizr', AMOS_BASE_URL.'js/modernizr.custom.js', array('jquery'), 1, true);
    
    wp_enqueue_script('amos-animations',  AMOS_BASE_URL.'js/amos-animations.js', array('jquery'), 1, true);
    
    wp_enqueue_script( 'amos-main', AMOS_BASE_URL.'js/amos-main.js', array('jquery', 'amos-animations'), 1, true );

    wp_enqueue_script('comment-reply');
    
    wp_enqueue_script('classie',  AMOS_BASE_URL.'js/classie.js', '', 1, true ); 

    if((isset($amos_redata['page_header_menu_color']) && $amos_redata['page_header_menu_color'] == 'auto') || $amos_redata['blog_post_style']== 'creative')
         wp_enqueue_script('amos-backgroundcheck',  AMOS_BASE_URL.'js/background-check.min.js', array('jquery'), 1, true);

   

    if($amos_redata['sticky'])
         wp_enqueue_script('jquery-slicknav', AMOS_BASE_URL.'js/jquery.slicknav.min.js', array('jquery'), 1, true); 

  

    if(isset($amos_redata['one_page_active']) && $amos_redata['one_page_active'] == 1)
         wp_enqueue_script('jquery-onepage',AMOS_BASE_URL.'js/jquery.onepage.js', array('jquery'), 1, true);

    $p_id = amos_get_post_id();
    if(isset($p_id) && !empty($p_id) && function_exists('redux_post_meta'))
        if( redux_post_meta('amos_redata',(int) $p_id, 'fullscreen_post_style' ))   
            wp_enqueue_script('fullscreen_post', AMOS_BASE_URL.'js/fullscreen_post.js', array('jquery'), 1, true);
    
    wp_localize_script('amos-main', 's_gb', array('theme_js' =>  AMOS_BASE_URL.'js/' , 'theme_fancy' => AMOS_BASE_URL.'fancybox/source/')); 

    

    wp_localize_script('amos-load-css-async', 's_gb', array('theme_css' =>  AMOS_BASE_URL.'css/')); 

    wp_enqueue_script('jquery-mixitup',AMOS_BASE_URL.'js/jquery.mixitup.js', array('jquery'), 1, true);
    wp_enqueue_script('jquery-masonry');
    wp_enqueue_script('jquery-plyr',AMOS_BASE_URL.'js/jquery.plyr.js', array('jquery'), 1, true);
    
     $p_id = amos_get_post_id();
    if(isset($p_id) && !empty($p_id) && function_exists('redux_post_meta')){
        if( redux_post_meta('amos_redata',(int) $p_id, 'portfolio_mode' ) == 'split')  {
            wp_enqueue_script('jquery-easings',AMOS_BASE_URL.'js/jquery.easings.min.js', array('jquery'), 1, true);
            wp_enqueue_script('jquery-multiscroll',AMOS_BASE_URL.'js/jquery.multiscroll.extensions.min.js', array('jquery'), 1, true);

            wp_enqueue_style('jquery-multiscroll', AMOS_BASE_URL.'css/jquery.multiscroll.css');
    }
}

  $p_id = amos_get_post_id();
    if(isset($p_id) && !empty($p_id) && function_exists('redux_post_meta')){
        if( redux_post_meta('amos_redata',(int) $p_id, 'portfolio_mode' ) == 'slider')  {
            wp_enqueue_script('swiper',AMOS_BASE_URL.'js/swiper.min.js', array('jquery'), 1, true);
    }
}

    wp_enqueue_script('jquery-parallax-scroll',AMOS_BASE_URL.'js/jquery.parallax-scroll.js', array('jquery'), 1, true);

    echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
    echo "var amos_global = { \n \tajaxurl: '".esc_js(admin_url( 'admin-ajax.php' ) )."',\n \tbutton_style: '".esc_js($amos_redata['overall_button_style'][0])."'\n \t}; \n /* ]]> */ \n ";
    echo "</script>\n \n ";
}

/* -------------------- Register Scripts used over all pages --------- */ 


if(class_exists('Envato_WordPress_Theme_Upgrader')){
    /**
     * Load the Envato WordPress Toolkit Library check for updates
     * and direct the user to the Toolkit Plugin if there is one
     */
    function amos_envato_toolkit_admin_init() {
     
        // Include the Toolkit Library
        include_once( get_template_directory() . '/includes/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php' );
     
        // Add further code here
     
    }
    add_action( 'admin_init', 'amos_envato_toolkit_admin_init' );

    // Use credentials used in toolkit plugin so that we don't have to show our own forms anymore
    $credentials = get_option( 'envato-wordpress-toolkit' );
    if ( empty( $credentials['user_name'] ) || empty( $credentials['api_key'] ) ) {
        return;
    }

    // Check updates only after a while
    $lastCheck = get_option( 'toolkit-last-toolkit-check' );
    if ( false === $lastCheck ) {
        update_option( 'toolkit-last-toolkit-check', time() );
        return;
    }
     
    // Check for an update every 3 hours
    if ( 10800 < ( time() - $lastCheck ) ) {
        return;
    }
     
    // Update the time we last checked
    update_option( 'toolkit-last-toolkit-check', time() );


    // Check for updates
    $upgrader = new Envato_WordPress_Theme_Upgrader( $credentials['user_name'], $credentials['api_key'] );
    $updates = $upgrader->check_for_theme_update();
     
    // If $updates->updated_themes_count == true then we have an update!

    // Add update alert, to update the theme
    if ( $updates->updated_themes_count ) {
        add_action( 'admin_notices', 'amos_envato_toolkit_admin_notices' );
    }

    /**
     * Display a notice in the admin that an update is available
     */
    function amos_envato_toolkit_admin_notices() {
        $message = sprintf( esc_html__( "An update to the theme is available! Head over to %s to update it now.", "amos" ),
            "<a href='" . admin_url() . "admin.php?page=envato-wordpress-toolkit'>Envato WordPress Toolkit Plugin</a>" );
        echo "<div id='message' class='updated below-h2'><p>{$message}</p></div>";
    }

}


// Global variable written in function

    function amos_redata_variable(){
           
            global $amos_redata;

            return $amos_redata;

            
    }

    function  amos_current_view(){

        global $amos_current_view;

        return $amos_current_view;
    }  

    function amos_rewrite_amos_current_view($vars){

        global $amos_current_view;

        $amos_current_view = $vars;

        return $amos_current_view;
    }

    add_action('wp_ajax_dynamic_css', 'dynaminc_css');
    add_action('wp_ajax_nopriv_dynamic_css', 'dynaminc_css');
    function dynaminc_css() {
        require(get_template_directory().'/includes/register/register_styles.css.php');
        exit;
    }

    /* -------------------- Convert Color HEX to RGB ------------------------------------ */

function amos_hexToRgb($hex) {

    $hex = str_replace("#", "", $hex, $count);
    $color = array();


    if(is_string($hex)){
       
      if(strlen($hex) == 3) {
          $color['r'] = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
          $color['g'] = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
          $color['b'] = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
      }
      else if(strlen($hex) == 6) {
          $color['r'] = hexdec(substr($hex, 0, 2));
          $color['g'] = hexdec(substr($hex, 2, 2));
          $color['b'] = hexdec(substr($hex, 4, 2));
      }
    }
    return $color;
}

/* -------------------- End Convert Color HEX to RGB -------------------------------- */




/* ------------------- Top header transparent ----------------------------------*/
function amos_header_topnav_transparent(){
   global $amos_redata;

   if($amos_redata['top_navigation'] && $amos_redata['top_navigation_transparency']): ?>
        <div class="top_nav top_nav_transparency">
            <?php if(!$amos_redata['header_container_full']): ?>
            <div class="container">
            <?php endif; ?>
                <div class="row-fluid">
                    <div class="span6">
                        <?php if(is_active_sidebar("top-header-left")): ?>
                        <div class="pull-left">
                            <?php dynamic_sidebar( "top-header-left" ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="span6">
                        <?php if(is_active_sidebar("top-header-right")): ?>
                        <div class="pull-right">
                            <?php dynamic_sidebar( "top-header-right" ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                   
                </div> 
            <?php if(!$amos_redata['header_container_full'] ): ?>    
            </div>
            <?php endif; ?>
        </div>
  <?php endif;
}

/* ------------------- Top header transparent ----------------------------------*/
function amos_header_tools($position= "", $fullscreen="", $responsive=""){
   global $amos_redata, $product;
        if($position ==""){
            if($fullscreen == 'menu')
                $layout = $amos_redata['header_tools_extend']['enabled'];
            else
            $layout = $amos_redata['header_tools']['enabled'];
        }
        else if($position =="left" || $position == 'right'){
            if($fullscreen == 'menu')

                $layout = $amos_redata['header_tools_two_extend'][$position];
            else
               $layout = $amos_redata['header_tools_two'][$position]; 

            if($responsive == 'true')

                $layout = $amos_redata['header_tools_responsive'][$position];
            
        }

   ?>
        <div class="header_tools <?php if($position =="") echo esc_attr($amos_redata['header_tools_position']) ; else if($position =="left" || $position == 'right') echo esc_attr($position); ?> ">
            <ul>

           <?php
if ($layout): foreach ($layout as $key=>$value) {
 
    switch($key) {
 
        case 'search': ?>
            <li><a class="right_search open_search_button" id="trigger-overlay" href="#"><i class="lnr lnr-magnifier"></i></a></li>
        <?php
        break;
 
        case 'button': ?>
            <li><a href="<?php echo esc_attr($amos_redata['header_button_link']) ?>" class="btn-bt <?php echo esc_attr($amos_redata['overall_button_style'][0]) ?> header_button"><span><?php echo esc_attr($amos_redata['header_button']) ?></span><span class="overlay"></span></a> </li>
        <?php
        break;
 
        case 'extra_nav':?>
            <li><a class="extra_navigation_button" href="#"> 
            <div class="circles_container">
                <div class="circle"></div>
                <div class="circle"></div> 
                <div class="circle"></div>
            </div>
        </a></li>
        <?php  
        break;
 
        case 'cart':  ?>
            <li><?php if(class_exists('Woocommerce')): ?>
                <?php get_template_part('includes/view/woocommerce', 'cart'); ?>
            <?php endif; ?></li>

        <?php                              
        break; 
        case 'wishlist':?>
        <li>
            <?php if(class_exists('Woocommerce') && function_exists( 'yith_wishlist_constructor' )): ?>
                <a class="wishlist" href="<?php  echo esc_url(get_page_link( get_option('yith_wcwl_wishlist_page_id') )) ?>" rel="nofollow">
                <?php endif; ?><i class="lnr lnr-heart"></i></a></li>
        <?php break;
        case 'hamburger_menu':?>
            <li><div class="wrapper-menu" id="trigger-overlay1" >
               <div class="line-menu half start"></div>
               <div class="line-menu"></div>
               <div class="line-menu half end"></div>
            </div></li>
        <?php break; 

        case 'menu_responsive':?>
            <li>
            <div class = 'wrapper-menu mobile_small_menu' id="responsive_menu" >
               <div class="line-menu half start"></div>
               <div class="line-menu"></div>
               <div class="line-menu half end"></div>
            </div></li>
        <?php break; 
 
    }
 
}
endif;

?>
       </ul> </div>
  <?php
}
/* ------------------- check background header ----------------------------------*/
function amos_header_bgCheck(){
  global $amos_redata;

  $bgCheck = '';

  if($amos_redata['header_transparency']){
      if((int) amos_get_post_id() != 0 && function_exists('redux_post_meta'))
          $page_header_menu_color = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'page_header_menu_color');
      else
          $page_header_menu_color = 'light';



      if(isset($page_header_menu_color) && !empty($page_header_menu_color))
          $bgCheck = ($page_header_menu_color =='auto') ? '' : 'background--'.esc_attr($page_header_menu_color); 
      else
          $bgCheck = 'background--light';

      if(function_exists('redux_post_meta')){
          $p_bool = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'page_header_bool');
          $s_bool = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'slider_type');
          $h_bool = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'fixed_header_page');
      }else{
          $p_bool = 1;
          $s_bool = 'none';
          $h_bool = 1;

      }
          
      if($p_bool == '0' && $s_bool == 'none' && $h_bool = '0')
        $bgCheck = 'background--light';
      

  }
  return $bgCheck;

}

/*Add author bio in post*/
function amos_author_bio( $content ) {
 
global $post;
 
if ( is_single() && isset( $post->post_author ) ) {
    $author_details = '';
 
    $display_name = get_the_author_meta( 'display_name', $post->post_author );
 
    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );
 
    $user_description = get_the_author_meta( 'user_description', $post->post_author );
 
    $user_website = get_the_author_meta('url', $post->post_author);
 
    $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
      
    if ( ! empty( $display_name ) )
 
    $auth_details = '<p class="author_name">' . $display_name . '</p>';
    
    else
        $auth_details = "";
 
    if ( ! empty( $user_description ) )
 
    $author_details = '<p class="author_details"><div class="author_img">' . get_avatar( get_the_author_meta('user_email') , 90 ) .'</div> <div class="author_name">' . $auth_details . '</div> <div class="author_desc">' . nl2br( $user_description ). '</div></p>';
 
    $author_details .= '<p class="author_links"><a class="author_link" href="'. $user_posts .'">'. esc_html__('View all posts by', 'amos').' ' . $display_name . '</a>';  
 
    
        $author_details .= '</p>';
        
 
        $content = $content . '<footer class="author_bio" >' . $author_details . '</footer>';
    }
    return $content;
}
 
add_action( 'the_content', 'amos_author_bio' );
 
//remove_filter('pre_user_description', 'wp_filter_kses');

function amos_default_portfolio_image($size){
    if( !is_array($size) ){
        global $_wp_additional_image_sizes;
      if(!empty($size))
        $size = $_wp_additional_image_sizes[$size];
    }

    if( empty($size) ){
        $size = array('width' => 600, 'height' => 360);
    }

    return 'http://placehold.it/'.$size['width'].'x'.$size['height'];
}



add_filter( 'vc_iconpicker-type-lineaicons', 'amos_iconpicker_type_lineaicons' );

function amos_iconpicker_type_lineaicons( $icons ) {

$typicons_icons = array(
        
            array( 'linea-basic-alarm' => 'Alarm' ),
           
        );
        return array_merge( $icons, $typicons_icons );

}









/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function amos_enqueue_custom_admin_style() {

    wp_enqueue_script( 'ignitetheme-megamenu', get_template_directory_uri() . '/includes/admin-js/megamenu-admin.js', array('jquery'), '1.0.0', true );


}
add_action( 'admin_enqueue_scripts', 'amos_enqueue_custom_admin_style' );

    require get_template_directory() . '/includes/menu-widgets.php';


/*-------------------- Load Style and Javascript for the Admin Panel ------------------------------------------------*/

function amos_custom_wp_admin_style() {
        
        wp_enqueue_style( 'elle_admin',  AMOS_BASE_URL . '/css/elle_admin.css' );
        wp_enqueue_style('lineaicons', AMOS_BASE_URL . '/css/lineaicon.css');
}
add_action( 'admin_enqueue_scripts', 'amos_custom_wp_admin_style' );


function amos_custom_wp_admin_script() {
       
        wp_enqueue_script( 'amos_admin', AMOS_BASE_URL . '/js/amos-admin.js');
      
}
add_action( 'admin_enqueue_scripts', 'amos_custom_wp_admin_script' );


add_action( 'woocommerce_after_shop_loop_item', 'amos_display_yith_wishlist_loop', 97 );
 
function amos_display_yith_wishlist_loop() {
if(class_exists('Woocommerce') && function_exists( 'yith_wishlist_constructor' )){
    echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
}
}


// After VC Init
add_action( 'vc_after_init', 'vc_after_init_actions' );
 
function vc_after_init_actions() {
     global $amos_redata;
     // var_dump($amos_redata['single_portfolio_layout'] );
    // Enable VC by default on a list of Post Types
    if( function_exists('vc_set_default_editor_post_types') ){ 
         
         if( !empty($amos_redata['single_portfolio_layout'])  && $amos_redata['single_portfolio_layout'] == 'custom')
        
    $list = array(
            'page',
            'portfolio', // add here your custom post types slug
        );

        else

         $list = array(
            'page'
        );
     

        vc_set_default_editor_post_types( $list );
         
    }
     
}
/*-------------------- END Load Style and Javascript for the Admin Panel ------------------------------------------------*/    



?>