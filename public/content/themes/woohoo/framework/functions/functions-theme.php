<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

require_once (get_template_directory().'/custom-functions.php'                                  );
require_once (get_template_directory().'/framework/admin/framework-mega.php'                    );
require_once (get_template_directory().'/framework/admin/framework-category.php'                );
require_once (get_template_directory().'/framework/admin/framework-tgm.php'                     );
require_once (get_template_directory().'/framework/functions/functions-typo.php'                );
require_once (get_template_directory().'/framework/functions/functions-widgets.php'             );
require_once (get_template_directory().'/framework/functions/functions-social.php'              );
require_once (get_template_directory().'/framework/functions/functions-login.php'               );
require_once (get_template_directory().'/framework/functions/functions-post-like.php'           );
require_once (get_template_directory().'/framework/functions/functions-breadcrumb.php'          );
require_once (get_template_directory().'/framework/functions/functions-rating.php'              );
require_once (get_template_directory().'/framework/functions/functions-views.php'               );
require_once (get_template_directory().'/framework/ajax/ralated/related-functions.php'          );
require_once (get_template_directory().'/framework/shorty/shorty.php'                           );
require_once (get_template_directory().'/framework/functions/functions-medias-fields.php'       );
require_once (get_template_directory().'/framework/global/bdaia-post-sharing.php'               );

if ( is_admin() )
{
	require_once ( get_template_directory().'/framework/wp-admin/metaboxes/metaboxes-options.php' );

	if ( ! woohoo_get_option( 'bdaia_disable_builder_page' ) ) {
		require_once ( get_template_directory().'/framework/builder-page/bdaia-builder.php'       );
    }
}


/**
 * Translations
 * ========================================================= */
if ( ! function_exists( 'woohoo__tr' ) )
{
	function woohoo__tr( $text )
	{
		$def            = woohoo_default_texts();
		$sanitize_text  = sanitize_title( htmlspecialchars ($text) );

		if ( woohoo_get_option( $sanitize_text ) ) {
			return htmlspecialchars_decode( stripcslashes ( woohoo_get_option( $sanitize_text ) ) );
		}
        elseif ( array_key_exists( $text, $def ) ) {
			return $def[ $text ];
		}
		else {
			return $text;
		}
	}
}

if ( ! function_exists( 'woohoo_tr' ) )
{
	function woohoo_tr( $text ) {
		echo woohoo__tr( $text );
	}
}




/**
 * Get theme name
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_get_theme_name' ) )
{

	function woohoo_get_theme_name()
	{
		return 'woohoo';
	}

}




/**
 * Get theme version
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_get_theme_version' ) )
{
	function woohoo_get_theme_version()
	{
		$current_theme = wp_get_theme( woohoo_get_theme_name() );
		return $current_theme->exists() ? $current_theme->get( 'Version' ) : WOOHOO_THEME_VER;
	}

}




/**
 * Lazyload images
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_lazyload_image_attributes' ) )
{
	add_filter( 'wp_get_attachment_image_attributes', 'woohoo_lazyload_image_attributes', 8, 3 );
	function woohoo_lazyload_image_attributes( $attr, $attachment, $size )
	{
		if ( woohoo_get_option( 'bdaia_has_lazy_load' ) && ! is_admin() && ! is_feed() )
		{
			$attr['class'] .= ' img-lazy';

			$blank_size  = ( $size == 'bdaia-small' ) ? '-small' : '';
			$blank_image = WOOHOO_TEMPLATE_URL . '/images/img-empty' . $blank_size . '.png';

			$attr['data-src'] = $attr['src'];
			$attr['src']      = $blank_image;

			unset( $attr['srcset'] );
			unset( $attr['sizes'] );
		}

		return $attr;
	}
}




/**
 * GET Thumbnail src
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_get_src' ) )
{
	function woohoo_get_src( $size = 'bdaia-small' )
	{
		$post_id    = get_the_ID();
		$image_id   = get_post_thumbnail_id( $post_id );
		$image      = wp_get_attachment_image_src( $image_id, $size );

		return $image[0];
	}
}





/**
 * GET Thumbnail src bg
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_get_src_bg' ) )
{
	function woohoo_get_src_bg( $size = 'bdaia-small' )
	{
		$image          = woohoo_get_src( $size );
		$background     = ! empty( $image ) ? 'url('. $image .')' : 'none';

		return esc_attr( 'background-image: '.$background );
	}
}


/**
 * Boxes do not dublicate posts
 * ========================================================= */
if(  ! function_exists( 'woohoo_do_not_dublicate' ) )
{
	function woohoo_do_not_dublicate( $post_id = false )
	{
		if( empty( $post_id ) ) return;

		if( empty( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) )
		{
			$GLOBALS['woohoo_do_not_diblicate_boxes'] = array();
		}
		$GLOBALS['woohoo_do_not_diblicate_boxes'][$post_id] = $post_id;
	}
}



/**
 * Notifier
 * ========================================================= */

require_once ( get_template_directory() . '/framework/admin/framework-notifier.php' );
define( 'MTHEME_NOTIFIER_THEME_NAME', WOOHOO_THEME_NAME );
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', WOOHOO_THEME_FOLDER );
define( 'MTHEME_NOTIFIER_XML_FILE', 'https://woohoo.bdaia.com/notifier.xml' );
define( 'MTHEME_NOTIFIER_CACHE_INTERVAL', 10 );


/**
 * Layerslider API
 * ========================================================= */
function woohoo_layerslider_ready() {
	if ( defined( 'LS_PLUGIN_BASE' ) ) {
		remove_action( 'after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
	}
}
add_action( 'layerslider_ready', 'woohoo_layerslider_ready' );



add_filter( 'jpeg_quality', 'woohoo_custom_jpeg_quality' );

function woohoo_custom_jpeg_quality( $quality )
{
	if ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_10' )
	{
		$quality = 10;
	}
    elseif ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_20' )
	{
		$quality = 20;
	}
    elseif ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_30' )
	{
		$quality = 30;
	}
    elseif ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_40' )
	{
		$quality = 40;
	}
    elseif ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_50' )
	{
		$quality = 50;
	}
    elseif ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_60' )
	{
		$quality = 60;
	}
    elseif ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_70' )
	{
		$quality = 70;
	}
    elseif ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_80' )
	{
		$quality = 80;
	}
    elseif ( woohoo_get_option( 'bdaia_jpeg_quality' ) == 'jpeg_quality_90' )
	{
		$quality = 90;
	}
	else
	{
		$quality = 100;
	}

	return $quality;
}



/**
 * Adjust the $content_width WP global variable
 * ========================================================= */

function woohoo_setup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'woohoo_content_width', 850 );
}
add_action( 'after_setup_theme', 'woohoo_setup_content_width', 0 );


/**
 * Set up WPML plugin
 * ========================================================= */

function woohoo_setup_wpml()
{
	if ( woohoo_can_use_plugin( 'sitepress-multilingual-cms/sitepress.php' ) )
	{
		## Remove @lang from term title.
		global $sitepress;
		if ( $sitepress ) {
			add_filter( 'single_term_title', array( $sitepress, 'the_category_name_filter' ) );
		}
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
}
add_action( 'after_setup_theme', 'woohoo_setup_wpml' );


/**
 * Check whether the plugin is active and theme can rely on it
 * ========================================================= */

function woohoo_can_use_plugin( $plugin ) {
	## Detect plugin. For use on Front End only.
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	return is_plugin_active( $plugin );
}

if( woohoo_get_option( 'bd_LiveSearch' ) ) require_once (get_template_directory().'/framework/global/search-ajax.php');

/**
 * Mailchimp for WP
 * ========================================================= */

if ( woohoo_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) )
{
	require_once( get_template_directory() . '/framework/plugins/mailchimp-wp.php' );
	add_filter( 'mc4wp_form_before_fields', 'woohoo_mc4wp_form_before_form', 10, 2 );
	add_filter( 'mc4wp_form_after_fields', 'woohoo_mc4wp_form_after_form', 10, 2 );
}


/**
 * Get The First Image From a Post.
 * ========================================================= */

function woohoo_first_post_image( $no_thumb = 'no-image' )
{
	global $post;

	$first_img = '';

	ob_start();
	ob_end_clean();

	if ( preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches ) ) {
		$first_img = $matches[1][0];
		return $first_img;
	}
	else {
		return $first_img = get_template_directory_uri().'/images/no-thumb/'.$no_thumb.'.jpg';
	}
}


function woohoo_get_video_image( $no_thumb = 'no-image' )
{
	$image = '';
	$protocol = is_ssl() ? 'https' : 'http';

	$image_id   = get_post_thumbnail_id( get_the_ID() );
	$image      = wp_get_attachment_image_src( $image_id, $GLOBALS['bdaia-full'] );
	$image      = $image[0];

	if ( $image ) return $image;

	return woohoo_first_post_image( $no_thumb );
}


/**
 * Taqyeem Final Score.
 * ========================================================= */

function woohoo_final_score()
{
	$post_reviews               = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true                );
	$bd_brief_summary           = get_post_meta( get_the_ID(), 'bdaia_taqyeem_brief', true          );
	$bdaia_taqyeem_final_score  = get_post_meta( get_the_ID(), 'bdaia_taqyeem_final_score', true    );

	if( $post_reviews ) {
		if ( $bdaia_taqyeem_final_score ) {
			echo '<span class="woohoo-star-rating" title="' . $bd_brief_summary . '"><span style="width: ' . round( $bdaia_taqyeem_final_score ) . '%"></span></span>';
		}
	}
}


/**
 * WP head
 * ========================================================= */

function woohoo_wp_head()
{
	$default_favicon = get_template_directory_uri()."/images/favicon.png";
	if( woohoo_get_option('favicon') ){
		$custom_favicon = woohoo_get_option('favicon');
	}
	$favicon = (empty($custom_favicon)) ? $default_favicon : $custom_favicon;
	echo '<link rel="shortcut icon" href="'. $favicon .'" type="image/x-icon" />';

	if(woohoo_get_option('iphoneIconUpload')){
		if(woohoo_get_option('iphoneIconUpload')){
			echo '<link rel="apple-touch-icon-precomposed" href="'.woohoo_get_option('iphoneIconUpload').'" />';
		}
	}

	// Favicon iPhone 4 Retina display
	if(woohoo_get_option('iphoneIconRetinaUpload')){
		if(woohoo_get_option('iphoneIconRetinaUpload')){
			echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'.woohoo_get_option('iphoneIconRetinaUpload').'" />';
		}
	}

	// Favicon iPad
	if(woohoo_get_option('ipadIconUpload')){
		if(woohoo_get_option('ipadIconUpload')){
			echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.woohoo_get_option('ipadIconUpload').'" />';
		}
	}

	// Favicon iPad Retina display
	if(woohoo_get_option('ipadIconRetinaUpload')){
		if(woohoo_get_option('ipadIconRetinaUpload')){
			echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'.woohoo_get_option('ipadIconRetinaUpload').'" />';
		}
	}

	// Tracking Code
	$trackingCode = woohoo_get_option( 'google_analytics' );
	if( $trackingCode ) {
		echo stripslashes( $trackingCode );
	}
	
	// Space before </head>
	$spaceHead = woohoo_get_option( 'space_head' );
	if( $spaceHead ){
		echo stripslashes( $spaceHead );
	}
?>
<script type="text/javascript">
/* <![CDATA[ */
var userRating = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>" , "your_rating":"<?php woohoo__tr( 'Your Rating' ); ?>" , "nonce":"<?php echo wp_create_nonce( 'ajax-nonce' ); ?>"};
var userLike = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>" , "nonce":"<?php echo wp_create_nonce( 'ajax-nonce' ); ?>"};
/* ]]> */
var bdaia_theme_uri = '<?php echo get_template_directory_uri(); ?>';
</script>
<?php
	// Custom Css
	if(file_exists(get_template_directory().'/framework/custom/css.php')) {
		require_once (get_template_directory().'/framework/custom/css.php');
	}
}
add_action('wp_head', 'woohoo_wp_head');


/**
 * WP Footer
 * ========================================================= */

function woohoo_wp_footer()
{
	// Space body </head>
	if( woohoo_get_option( 'space_body' ) ){
		echo woohoo_get_option('space_body')."\n";
	}

	// Go top
	if(woohoo_get_option('bdayhGoTop')){
		echo '<div class="gotop" title="Go Top"><span class="bdaia-io bdaia-io-chevron-up"></span></div>';
	}

	//Reading Position Indicator
	if ( is_single() || ! is_page() && ! is_home() && ! is_front_page() ) echo '<div id="reading-position-indicator"></div>';

	// Custom Js
	if(file_exists( get_template_directory().'/framework/custom/js.php' ) ) {
		require_once (get_template_directory().'/framework/custom/js.php');
	}
}
add_action('wp_footer',  'woohoo_wp_footer');



/*-----------------------------------------------------------------------------------*/
# Enqueue WooCommerce & bbPress & buddyPress
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'woohoo_remove_plugins_js_css', 99 );
function woohoo_remove_plugins_js_css() {

	//BuddyPress
	wp_dequeue_style( 'bp-parent-css' );
	wp_dequeue_style( 'bp-parent-css-rtl' );
	wp_dequeue_style( 'bp-legacy-css' );

	wp_dequeue_style( 'bp-nouveau' );

	// Dequeue bbPress Default Css files
	wp_dequeue_style( 'bbp-default' );
	wp_dequeue_style( 'bbp-default-rtl' );
}


/**
 * Enqueue scripts and styles for front end
 * ========================================================= */

function woohoo_enqueue_scripts()
{
	$ver = current_user_can( 'switch_themes' ) ? time() : wp_get_theme()->get( 'Version' ); // Always avoid browser cache for admins

	$version    = woohoo_get_theme_version();
	$p_uri      = trailingslashit( get_template_directory_uri() );
	$c_uri      = trailingslashit( get_stylesheet_directory_uri() );

	// stylesheets
	$parentcss = get_template_directory() . '/css/style.css';
	wp_enqueue_style( 'woohoo-default', get_template_directory_uri() . '/css/style.css', array(), filemtime( $parentcss ) );

	wp_register_style( 'woohoo-new', get_template_directory_uri().'/css/new.css' , array(), '', 'all' );
    //wp_enqueue_style( 'woohoo-new' );


	## Register buddyPress css file
	wp_register_style( 'woohoo-buddypress', get_template_directory_uri().'/css/buddypress.css' , array(), '', 'all' );
	if ( class_exists( 'buddypress' ) )
		wp_enqueue_style( 'woohoo-buddypress' );


	## Register bbPress css file
	wp_register_style( 'woohoo-bbpress', get_template_directory_uri().'/css/bbpress.css' , array(), '', 'all' );
	if ( class_exists( 'bbpress' ) )
		wp_enqueue_style( 'woohoo-bbpress' );


	## Start Inline style --------------------
	$custom_css = '';

	## Sidebar widget --------------------
	$woohoo_sidebar_widget_bg                       = woohoo_get_option( 'woohoo_sidebar_widget_bg'                     );
	$woohoo_sidebar_widget_title_bg                 = woohoo_get_option( 'woohoo_sidebar_widget_title_bg'               );
	$woohoo_sidebar_widget_title_text_color         = woohoo_get_option( 'woohoo_sidebar_widget_title_text_color'       );
	$woohoo_sidebar_widget_text_color               = woohoo_get_option( 'woohoo_sidebar_widget_text_color'             );
	$woohoo_sidebar_widget_links_color              = woohoo_get_option( 'woohoo_sidebar_widget_links_color'            );
	$woohoo_sidebar_widget_links_hover_color        = woohoo_get_option( 'woohoo_sidebar_widget_links_hover_color'      );

	$woohoo_sw_sc_gbc                               = woohoo_get_option( 'woohoo_sw_sc_gbc'         );
	$woohoo_sw_sc_ctc                               = woohoo_get_option( 'woohoo_sw_sc_ctc'         );
	$woohoo_sw_t_bc                                 = woohoo_get_option( 'woohoo_sw_t_bc'           );
	$woohoo_sw_tn_tc                                = woohoo_get_option( 'woohoo_sw_tn_tc'          );

	$woohoo_blocks_bg                               = woohoo_get_option( 'woohoo_blocks_bg'                             );
	$woohoo_blocks_text_color                       = woohoo_get_option( 'woohoo_blocks_text_color'                     );
	$woohoo_blocks_links_color                      = woohoo_get_option( 'woohoo_blocks_links_color'                    );
	$woohoo_blocks_links_hover_color                = woohoo_get_option( 'woohoo_blocks_links_hover_color'              );

	$woohoo_blocks_title_bg                         = woohoo_get_option( 'woohoo_blocks_title_bg'           );
	$woohoo_blocks_title_text_color                 = woohoo_get_option( 'woohoo_blocks_title_text_color'   );

	$woohoo_blocks_post_title_color                 = woohoo_get_option( 'woohoo_blocks_post_title_color'   );
	$woohoo_blocks_post_title_hover_color           = woohoo_get_option( 'woohoo_blocks_post_title_hover_color'   );
	$woohoo_blocks_post_meta_tc                     = woohoo_get_option( 'woohoo_blocks_post_meta_tc'       );
	$woohoo_blocks_post_etc                         = woohoo_get_option( 'woohoo_blocks_post_etc'           );

	$woohoo_blocks_lm_bc                            = woohoo_get_option( 'woohoo_blocks_lm_bc'     );
	$woohoo_blocks_lm_tc                            = woohoo_get_option( 'woohoo_blocks_lm_tc'     );

	$woohoo_blocks_rm_bc                            = woohoo_get_option( 'woohoo_blocks_rm_bc'     );
	$woohoo_blocks_rm_tc                            = woohoo_get_option( 'woohoo_blocks_rm_tc'     );

	$woohoo_blocks_nv_bc                            = woohoo_get_option( 'woohoo_blocks_nv_bc'     );
	$woohoo_blocks_nv_tc                            = woohoo_get_option( 'woohoo_blocks_nv_tc'     );

	$woohoo_blocks_tl_bc                            = woohoo_get_option( 'woohoo_blocks_tl_bc'     );
	$woohoo_blocks_tl_tc                            = woohoo_get_option( 'woohoo_blocks_tl_tc'     );

	$woohoo_blocks_b13_bc                           = woohoo_get_option( 'woohoo_blocks_b13_bc'    );
	$woohoo_blocks_b13_tc                           = woohoo_get_option( 'woohoo_blocks_b13_tc'    );

	if( !empty( $woohoo_sidebar_widget_bg ) ) {
		$custom_css .= '#bdCheckAlso, #bdCheckAlso h4.block-title span, div.bd-sidebar .widget, div.bd-sidebar .widget h4.block-title span, div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav, div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style1 li a { background-color:'.$woohoo_sidebar_widget_bg.' }';
	}
	if( !empty( $woohoo_sidebar_widget_title_bg ) ) {
		$custom_css .= '#bdCheckAlso h4.block-title, #bdCheckAlso h4.block-title:before, div.bd-sidebar .widget h4.block-title, div.bd-sidebar .widget h4.block-title:before { background-color:'.$woohoo_sidebar_widget_title_bg.' }';
	}
	if( !empty( $woohoo_sidebar_widget_title_text_color ) ) {
		$custom_css .= '#bdCheckAlso h4.block-title, #bdCheckAlso h4.block-title a, div.bd-sidebar .widget h4.block-title, div.bd-sidebar .widget h4.block-title a { color:'.$woohoo_sidebar_widget_title_text_color.' }';
	}
	if( !empty( $woohoo_sidebar_widget_text_color ) ) {
		$custom_css .= 'div.bd-sidebar .widget, #bdCheckAlso .check-also-post, div.bd-sidebar div.widget.bdaia-widget.bd-tweets .widget-inner .twitter-item, div.bd-sidebar .bdaia-wb-wrap .bwb-article-content-wrapper footer, div.bd-sidebar .bdaia-wb-wrap .bdaia-wb-article p  { color :'.$woohoo_sidebar_widget_text_color.' }';
		$custom_css .= 'div.bd-sidebar .widget .woohoo-star-rating span:before, div.bd-sidebar .widget span.woohoo-star-rating:before { color :'.$woohoo_sidebar_widget_text_color.' !important }';
	}
	if( !empty( $woohoo_sidebar_widget_links_color ) ) {
		$custom_css .= '#bdCheckAlso .check-also-post .post-title, #bdCheckAlso .check-also-post .post-title a, div.bd-sidebar .widget a, div.bd-sidebar div.widget.bdaia-widget.bd-tweets .widget-inner .twitter-item a, div.widget.bdaia-widget.bd-tweets .widget-inner .twitter-item .jtwt_date { color :'.$woohoo_sidebar_widget_links_color.' }';
	}
	if( !empty( $woohoo_sidebar_widget_links_hover_color ) ) {
		$custom_css .= '#bdCheckAlso .check-also-post .post-title a:hover, div.bd-sidebar .widget a:hover, div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover, div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover span.bdayh-date { color :'.$woohoo_sidebar_widget_links_hover_color.' }';
		$custom_css .= 'div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover span.bdayh-date:before { background: '.$woohoo_sidebar_widget_links_hover_color.'; border-color: '.$woohoo_sidebar_widget_links_hover_color.'; }';
	}
	if( !empty( $woohoo_sw_sc_gbc ) ){
		$custom_css .= 'div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style2 li a, div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style3 li a { border-color:'.$woohoo_sw_sc_gbc.'; }';
		$custom_css .= 'div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style1 .bdaia-io { background-color:'.$woohoo_sw_sc_gbc.'; border: 0 none }';
	}
	if( !empty( $woohoo_sw_sc_ctc ) ){
		$custom_css .= 'div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style2 .sc-num, div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style1 .sc-num, div.bd-sidebar div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style3 .sc-num { color:'.$woohoo_sw_sc_ctc.' !important; }';
	}
	if( !empty( $woohoo_sw_t_bc ) ){
		$custom_css .= 'div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav li.active a { background : '. $woohoo_sw_t_bc .'; }';
		$custom_css .= 'div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav { border-bottom-color : '. $woohoo_sw_t_bc .'; }';
	}
	if( !empty( $woohoo_sw_tn_tc ) ){
		$custom_css .= 'div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav li a { color : '. $woohoo_sw_tn_tc .'; }';
	}
	if( !empty( $woohoo_blocks_bg ) ){
		$custom_css .= 'div.bdaia-template-head, div.bdaia-template-head h4.block-title span, div.bdaia-block-wrap .carousel-nav, div.bdaia-block-wrap h4.block-title span, div.bdaia-block-wrap, div.bdaia-blocks, div.bdaia-blocks div.block-article, div.bdaia-blocks.bdaia-block6 div.block-article, div.bdaia-blocks.bdaia-block6 div.block-article .block-article-content-wrapper {background-color: '.$woohoo_blocks_bg.';}';
		$custom_css .= 'div.bdaia-block-wrap div.bdaia-blocks div.block-article {border:0 none !important}';
	}
	if( !empty( $woohoo_blocks_text_color ) ){
		$custom_css .= 'div.bdaia-block-wrap, div.bdaia-template-head div.taxonomy-description p{color:'.$woohoo_blocks_text_color.';}';
	}
	if( !empty( $woohoo_blocks_links_color ) ){
		$custom_css .= 'div.bdaia-block-wrap a{color:'.$woohoo_blocks_links_color.';}';
	}
	if( !empty( $woohoo_blocks_links_hover_color ) ){
		$custom_css .= 'div.bdaia-block-wrap a:hover{color:'.$woohoo_blocks_links_hover_color.';}';
	}
	if( !empty( $woohoo_blocks_title_bg ) ){
		$custom_css .= 'div.bdaia-template-head h4.block-title, div.bdaia-template-head h4.block-title:before, div.bdaia-block-wrap h4.block-title, div.bdaia-block-wrap h4.block-title:before {background : '. $woohoo_blocks_title_bg .';}';
	}
	if( !empty( $woohoo_blocks_title_text_color ) ){
		$custom_css .= 'div.bdaia-block-wrap h4.block-title, div.bdaia-block-wrap h4.block-title a, div.bdaia-template-head h4.block-title, div.bdaia-template-head h4.block-title a {color : '. $woohoo_blocks_title_text_color .';}';
	}
	if( !empty( $woohoo_blocks_post_title_color ) ){
		$custom_css .= 'div.bdaia-block-wrap h3, div.bdaia-block-wrap h3 a, div.bdaia-blocks.bdaia-block22 div.block-article .post-more-btn a, div.bdaia-blocks.bdaia-block22 div.block-article .post-more-btn a:hover, div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-cat-list a, div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-cat-list a:hover {color : '. $woohoo_blocks_post_title_color .';}';
		$custom_css .= 'div.bdaia-blocks.bdaia-block22 div.block-article hr{background:'.$woohoo_blocks_post_title_color.';}';
	}
	if( !empty( $woohoo_blocks_post_title_hover_color ) ){
		$custom_css .= 'div.bdaia-block-wrap h3 a:hover {color : '. $woohoo_blocks_post_title_hover_color .';}';
	}
	if( !empty( $woohoo_blocks_post_meta_tc ) ){
		$custom_css .= 'div.bdaia-block-wrap div.bdaia-blocks div.block-article footer, div.bdaia-block-wrap div.bdaia-blocks div.block-article footer a {color : '. $woohoo_blocks_post_meta_tc .';}';
		$custom_css .= 'div.bdaia-block-wrap div.bdaia-blocks div.block-article .woohoo-star-rating:before, div.bdaia-block-wrap div.bdaia-blocks div.block-article .woohoo-star-rating span:before {color : '. $woohoo_blocks_post_meta_tc .' !important;}';
	}
	if( !empty( $woohoo_blocks_post_etc ) ){
		$custom_css .= 'div.bdaia-block-wrap div.bdaia-blocks div.block-article p.block-exb, div.bdaia-block-wrap div.bdaia-blocks div.block-article.block-first-article p.block-exb {color : '. $woohoo_blocks_post_etc .';}';
	}
	if( !empty( $woohoo_blocks_lm_bc ) ){
		$custom_css .= '.bdaia-load-comments-btn a, #bdaia-ralated-posts .bd-more-btn, div.bdaia-block-wrap .bdaia-load-more-news-btn, div.bdaia-wb-wrap div.bdaia-wb-more-btn div.bdaia-wb-mb-inner {background : '. $woohoo_blocks_lm_bc .'; border:0 none !important;}';
	}
	if( !empty( $woohoo_blocks_lm_tc ) ){
		$custom_css .= '.bdaia-load-comments-btn a, #bdaia-ralated-posts .bd-more-btn, div.bdaia-block-wrap .bdaia-load-more-news-btn, div.bdaia-block-wrap .bdaia-load-more-news-btn a, div.bdaia-wb-wrap div.bdaia-wb-more-btn div.bdaia-wb-mb-inner, div.bdaia-wb-wrap div.bdaia-wb-more-btn div.bdaia-wb-mb-inner a {color : '. $woohoo_blocks_lm_tc .';}';
	}
	if( !empty( $woohoo_blocks_rm_bc ) ){
		$custom_css .= 'div.bdaia-block-wrap .bd-more-btn {background : '. $woohoo_blocks_rm_bc .'; border:0 none !important;}';
	}
	if( !empty( $woohoo_blocks_rm_tc ) ){
		$custom_css .= 'div.bdaia-block-wrap .bd-more-btn, div.bdaia-block-wrap .bd-more-btn a {color : '. $woohoo_blocks_rm_tc .';}';
	}
	if( !empty( $woohoo_blocks_nv_bc ) ){
		$custom_css .= 'div.bdaia-block-wrap .carousel-nav a.mo-next, div.bdaia-block-wrap .carousel-nav a.mo-prev, div.bdaia-wb-wrap .carousel-nav a.mo-next, div.bdaia-wb-wrap .carousel-nav a.mo-prev {background : '. $woohoo_blocks_nv_bc .'; border:0 none !important;}';
	}
	if( !empty( $woohoo_blocks_nv_tc ) ){
		$custom_css .= 'div.bdaia-block-wrap .carousel-nav a.mo-next, div.bdaia-block-wrap .carousel-nav a.mo-prev, div.bdaia-block-wrap .carousel-nav a.mo-prev, div.bdaia-wb-wrap .carousel-nav a.mo-next, div.bdaia-wb-wrap .carousel-nav a.mo-prev {color : '. $woohoo_blocks_nv_tc .';}';
	}
	if( !empty( $woohoo_blocks_tl_bc ) ){
		$custom_css .= 'div.bdaia-block-wrap div.post-new-timeline .post-date {background:'.$woohoo_blocks_tl_bc.'; border: 0 none !important;}';
		$custom_css .= 'div.bdaia-block-wrap div.post-new-timeline .post-line {border-color:'.$woohoo_blocks_tl_bc.';}';
	}
	if( !empty( $woohoo_blocks_tl_tc ) ){
		$custom_css .= 'div.bdaia-block-wrap div.post-new-timeline .post-date *{color:'.$woohoo_blocks_tl_tc.';}';
	}
	if( !empty( $woohoo_blocks_b13_bc ) ){
		$custom_css .= 'div.bdaia-block-wrap div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-sh{background:'.$woohoo_blocks_b13_bc.';border:0 none !important;}';
		$custom_css .= 'div.bdaia-block-wrap div.bdaia-blocks.bdaia-block22 div.block-article footer {border-color:'.$woohoo_blocks_b13_bc.';}';
	}
	if( !empty( $woohoo_blocks_b13_tc ) ){
		$custom_css .= 'div.bdaia-block-wrap div.bdaia-blocks div.block-article footer, div.bdaia-block-wrap div.bdaia-blocks div.block-article footer a{color:'.$woohoo_blocks_b13_tc.';}';
	}

	## Post template 1
	$woohoo_post_template1_mc_b = woohoo_get_option( 'woohoo_post_template1_mc_b' );
	if( !empty( $woohoo_post_template1_mc_b ) ){
		$custom_css .= '
		body.page div.bdaia-post-template div.bd-main,
		
		div.bdaia-post-template-style1 .bdaia-post-template, 
		div.bdaia-post-template-style1 div.bd-sidebar .widget, 
		div.bdaia-post-template-style1 div.bd-sidebar .widget h4.block-title span, 
		div.bdaia-post-template-style1 div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav,
		div.bdaia-post-template-style1 .bdaia-posts-grid-post-inner,
		
		div.bdaia-post-template-style5 .bdaia-post-template, 
		div.bdaia-post-template-style5 div.bd-sidebar .widget, 
		div.bdaia-post-template-style5 div.bd-sidebar .widget h4.block-title span, 
		div.bdaia-post-template-style5 div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav,
		div.bdaia-post-template-style5 .bdaia-posts-grid-post-inner,
		
		div.bdaia-post-template-style6 .bdaia-post-template, 
		div.bdaia-post-template-style6 div.bd-sidebar .widget, 
		div.bdaia-post-template-style6 div.bd-sidebar .widget h4.block-title span, 
		div.bdaia-post-template-style6 div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav,
		div.bdaia-post-template-style6 .bdaia-posts-grid-post-inner,
		
		div.bdaia-post-template-style7 div.bdMain, 
		div.bdaia-post-template-style7 div.bd-sidebar .widget, 
		div.bdaia-post-template-style7 div.bd-sidebar .widget h4.block-title span, 
		div.bdaia-post-template-style7 div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav,
		div.bdaia-post-template-style7 .bdaia-posts-grid-post-inner,
		
		div.bdaia-post-template-style8 .bdaia-post-template, 
		div.bdaia-post-template-style8 div.bd-sidebar .widget, 
		div.bdaia-post-template-style8 div.bd-sidebar .widget h4.block-title span, 
		div.bdaia-post-template-style8 div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav,
		div.bdaia-post-template-style8 .bdaia-posts-grid-post-inner,
		
		div.bdaia-post-template-style9 .bdaia-post-template, 
		div.bdaia-post-template-style9 div.bd-sidebar .widget, 
		div.bdaia-post-template-style9 div.bd-sidebar .widget h4.block-title span, 
		div.bdaia-post-template-style9 div.bd-sidebar .bdaia-widget-tabs .bdaia-tabs-nav,
		div.bdaia-post-template-style9 .bdaia-posts-grid-post-inner,
		
		div.bdaia-post-template-style2 div.bd-main,
		div.bdaia-post-template-style2 .bdaia-posts-grid-post-inner,
		div.bdaia-post-template-style3 div.bd-main,
		div.bdaia-post-template-style4 div.bd-main,
		div.bdaia-post-template-style4 .bdaia-posts-grid-post-inner,
		div.bdaia-post-template-default div.bd-main,
		div.bdaia-post-template-default .bdaia-posts-grid-post-inner
		{background:'.$woohoo_post_template1_mc_b.';}';

		$custom_css .= 'div.bdaia-post-template-style9 .bdMain, div.bdaia-post-template-style9,
		div.bdaia-post-template-style6 .bdMain, div.bdaia-post-template-style6,
		div.bdaia-post-template-style7,
		div.bdaia-post-template-style8 .bdMain, div.bdaia-post-template-style8
		{background: transparent none !important;}';

		$custom_css .= 'div.bdaia-post-template div.bd-main h4.block-title, div.bdaia-post-template div.bd-main h4.block-title span{background: transparent none !important;}';
	}
	$woohoo_post_template1_mc_tc = woohoo_get_option( 'woohoo_post_template1_mc_tc' );
	if( !empty( $woohoo_post_template1_mc_tc ) ){
		$custom_css .= '
		body.page div.bdaia-post-template div.bd-main *,
		div.bdaia-post-template-style1 .bdaia-post-template *,
	    div.bdaia-post-template-style5 .bdaia-post-template *,
	    div.bdaia-post-template-style6 .bdaia-post-template *,
	    div.bdaia-post-template-style7 .bdaia-post-template *,
	    div.bdaia-post-template-style8 .bdaia-post-template *,
	    div.bdaia-post-template-style9 .bdaia-post-template *,
	    div.bdaia-post-template-style2 div.bd-main *,
		div.bdaia-post-template-style3 div.bd-main *,
		div.bdaia-post-template-style4 div.bd-main *,
		div.bdaia-post-template-default div.bd-main *
		{color:'.$woohoo_post_template1_mc_tc.';}';
	}
	$woohoo_post_template1_mc_lc = woohoo_get_option( 'woohoo_post_template1_mc_lc' );
	if( !empty( $woohoo_post_template1_mc_lc )){
		$custom_css .= '
		body.page div.bdaia-post-template div.bd-main * a,
		div.bdaia-post-template-style1 .bdaia-post-template * a,
		div.bdaia-post-template-style5 .bdaia-post-template * a,
		div.bdaia-post-template-style6 .bdaia-post-template * a,
		div.bdaia-post-template-style7 .bdaia-post-template * a,
		div.bdaia-post-template-style8 .bdaia-post-template * a,
		div.bdaia-post-template-style9 .bdaia-post-template * a,
		div.bdaia-post-template-style2 div.bd-main * a,
		div.bdaia-post-template-style3 div.bd-main * a,
		div.bdaia-post-template-style4 div.bd-main * a,
		div.bdaia-post-template-default div.bd-main * a
		{color:'.$woohoo_post_template1_mc_lc.';}';
	}
	$woohoo_post_template1_mc_lhc = woohoo_get_option( 'woohoo_post_template1_mc_lhc' );
	if( !empty( $woohoo_post_template1_mc_lhc )){
		$custom_css .= '
		body.page div.bdaia-post-template div.bd-main * a:hover,
		div.bdaia-post-template-style1 .bdaia-post-template * a:hover,
		div.bdaia-post-template-style5 .bdaia-post-template * a:hover,
		div.bdaia-post-template-style6 .bdaia-post-template * a:hover,
		div.bdaia-post-template-style7 .bdaia-post-template * a:hover,
		div.bdaia-post-template-style8 .bdaia-post-template * a:hover,
		div.bdaia-post-template-style9 .bdaia-post-template * a:hover,
		div.bdaia-post-template-style2 div.bd-main * a:hover,
		div.bdaia-post-template-style3 div.bd-main * a:hover,
		div.bdaia-post-template-style4 div.bd-main * a:hover,
		div.bdaia-post-template-default div.bd-main * a:hover
		{color:'.$woohoo_post_template1_mc_lhc.';}';
	}

	$categories_obj = get_categories('hide_empty=0');
	foreach ($categories_obj as $pn_cat)
	{
		$category_id = $pn_cat->cat_ID ;
		$cat_get_options = get_option( "bd_cat_$category_id");

		if( isset( $cat_get_options['bdaia_cat_meta_review_score'] )      ) $custom_css .= 'body.category-'.$category_id.' div.bdaia-blocks div.bdaia-post-rating{display: none !important;}';
		if( isset( $cat_get_options['bdaia_cat_meta_athor_meta'] )        ) $custom_css .= 'body.category-'.$category_id.' div.bdaia-blocks div.bdaia-post-author-name{display: none !important;}';
		if( isset( $cat_get_options['bdaia_cat_meta_date_meta'] )         ) $custom_css .= 'body.category-'.$category_id.' div.bdaia-blocks div.bdaia-post-date, body.category-'.$category_id.' div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-date{display: none !important;}';
		if( isset( $cat_get_options['bdaia_cat_meta_categories_meta'] )   ) $custom_css .= 'body.category-'.$category_id.' div.bdaia-blocks div.bdaia-post-cat-list, div.bdaia-blocks .block-info-cat, body.category-'.$category_id.' div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-cat-list{display: none !important;}';
		if( isset( $cat_get_options['bdaia_cat_meta_comments_meta'] )     ) $custom_css .= 'body.category-'.$category_id.' div.bdaia-blocks div.bdaia-post-comment{display: none !important;}';
		if( isset( $cat_get_options['bdaia_cat_meta_views_meta'] )        ) $custom_css .= 'body.category-'.$category_id.' div.bdaia-blocks div.bdaia-post-view{display: none !important;}';
	}

	$woohoo_trending_news_area_width = woohoo_get_option( 'woohoo_trending_news_area_width' );
	if( !empty( $woohoo_trending_news_area_width ) ){
		$custom_css .= 'div.topbar div.top-left-area div.breaking-news-items div.breaking-cont{max-width: '.$woohoo_trending_news_area_width.'px;}';
	}

	wp_add_inline_style( 'woohoo-default', $custom_css );
	## End Inline style --------------------

	if ( ! woohoo_can_use_plugin( 'ilightbox/ilightbox.php' ) ) {
		wp_enqueue_style( 'wooohoo-ilightbox-skin',  get_template_directory_uri() . '/css/ilightbox/dark-skin/skin.css' );
		wp_enqueue_style( 'wooohoo-ilightbox-skin-black',  get_template_directory_uri() . '/css/ilightbox/metro-black-skin/skin.css' );
	}

	wp_deregister_script( 'js-cookie' );
	wp_dequeue_script( 'js-cookie' );

	//wp_deregister_script( 'bp-jquery-cookie' );
	//wp_dequeue_script( 'bp-jquery-cookie' );

	if (!is_admin()) {
		wp_dequeue_style('bp-nouveau');
		wp_deregister_style('bp-nouveau');
	}



	//wp_enqueue_script( 'woohoo-main', $p_uri . 'js/main.js', array( 'jquery' ), $version, true );

	wp_enqueue_script( 'woohoo-main', get_theme_file_uri( '/js/main.js' ), array('jquery'), $ver, true );


	wp_enqueue_script( 'js-cookie', get_theme_file_uri( '/js/js-cookie.js' ), array('jquery'), wp_get_theme()->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$sticky_sidebar = false;
	if ( woohoo_get_option( 'sticky_sidebar' ) )
	{
		$sticky_sidebar = true;
		if( ( ( is_home() || is_front_page() ) && woohoo_get_option( 'ss_homepage' ) ) || (   is_page() && woohoo_get_option( 'ss_pages' ) ) || (   is_category() && woohoo_get_option( 'ss_cat' ) ) || (   is_single() && woohoo_get_option( 'ss_posts' ) ) || (   is_tag() && woohoo_get_option( 'ss_disable_tag' ) )  ) {
			$sticky_sidebar = false;
		}
	}

	$bd_lazyload = false;
	if ( woohoo_get_option( 'bd_lazyload' ) )
	{
		$bd_lazyload = true;
	}

	$bdaia_has_lazy_load = false;
	if ( woohoo_get_option( 'bdaia_has_lazy_load' ) )
	{
		$bdaia_has_lazy_load = true;
	}

	$mobile_topmenu = false;
	if ( woohoo_get_option( 'mobile_topmenu' ) )
	{
		$mobile_topmenu = true;
	}

	$all_lightbox = false;
	if ( woohoo_get_option( 'bdaia_all_lightbox' ) )
	{
		$all_lightbox = true;
	}

	$click_to_comments = true;
	if ( woohoo_get_option( 'bdaia_p_commetns_posts_click_btn' ) )
	{
		$click_to_comments = false;
	}

	$woohoo_vars = array(
		'nonce'                 => wp_create_nonce( 'ajax-nonce' ),
		'ajaxurl'               => admin_url('admin-ajax.php'),
		"is_singular"           => is_singular(),
		"has_lazy_load"         => $bdaia_has_lazy_load,
		"bd_lazyload"           => $bd_lazyload,
		"mobile_topmenu"        => $mobile_topmenu,
		"sticky_sidebar"        => $sticky_sidebar,
		"all_lightbox"          => $all_lightbox,
		"click_to_comments"     => $click_to_comments,

		"post_reading_position_indicator" => woohoo_get_option( 'post_reading_position_indicator' ),
	);

//	wp_localize_script( 'woohoo-main', 'bd', wp_json_encode( $woohoo_vars ) );
	wp_localize_script( 'woohoo-main', 'bd', $woohoo_vars );


	if ( class_exists( 'Woocommerce' ) )
	{
		wp_register_style('woohoo-woocommerce', get_template_directory_uri().'/css/woocommerce.css' , array(), '', 'all');
		wp_enqueue_style('woohoo-woocommerce');
	}
}
add_action( 'wp_enqueue_scripts', 'woohoo_enqueue_scripts', 100 );


/**
 * Get the post time
 * ========================================================= */

function woohoo_get_time( $return = false )
{
	global $post ;

	if( woohoo_get_option( 'bdTimeFormat' ) == 'none' ) {
		return false;

	}
	elseif( woohoo_get_option( 'bdTimeFormat' ) == 'modern' ){

		$time_now  = current_time('timestamp');
		$post_time = get_the_time('U') ;

		if ( $post_time > $time_now - ( 60 * 60 * 24 * 30 ) ) {
			$since = sprintf( '%s ' . woohoo__tr( 'ago' ), human_time_diff( $post_time, $time_now ) );
		}

		else {
			$since = get_the_time(get_option('date_format'));
		}

	}

	else{
		$since = get_the_time(get_option('date_format'));
	}

	$post_time = '<span class="bdayh-date">'.$since.'</span>';

	if( $return ){
		return $post_time;
	}

	else{
		echo $post_time;
	}
}


/**
 * The actual function that does the work and output
 * the string of the estimated reading time of the post.
 * ========================================================= */

function woohoo_post_read_time()
{
	$words_per_second_option = woohoo_get_option('words_per_minute');
	$prefix = "";
	$suffix = "";
	$time = "1";
	$post_id = get_the_ID();
	$content = apply_filters('the_content', get_post_field('post_content', $post_id));
	$num_words = str_word_count(strip_tags($content));

	if( !empty( $words_per_second_option ) ){
		$minutes = floor($num_words / $words_per_second_option);
		$seconds = floor($num_words % $words_per_second_option / ($words_per_second_option / 60));
	}
	else{
		$minutes = 0;
		$seconds = 0;
    }

	$estimated_time = $prefix;

	if($minutes){
		$estimated_time = $estimated_time . $minutes . '&nbsp;'. woohoo__tr( 'min read' ) . ($minutes == 1 ? '' : '');
	}
	else {
		$estimated_time = $estimated_time . $seconds . '&nbsp;'. woohoo__tr( 'second read' ) . ($seconds == 1 ? '' : '');
	}

	if($minutes < 1) {
		$estimated_time = $estimated_time." "; //Less than a minute
	}
	$estimated_time = $estimated_time.$suffix;

	echo $estimated_time;

}


/**
 * Remove Query Strings From Static Resources
 * ========================================================= */

function woohoo_remove_query_strings_1( $src ){
	$rqs = explode( '?ver', $src );
	return $rqs[0];

}
function woohoo_remove_query_strings_2( $src ){
	$rqs = explode( '&ver', $src );
	return $rqs[0];
}
if ( ! is_admin() ) {
	add_filter( 'script_loader_src', 	'woohoo_remove_query_strings_1', 15, 1 );
	add_filter( 'style_loader_src', 	'woohoo_remove_query_strings_1', 15, 1 );
	add_filter( 'script_loader_src', 	'woohoo_remove_query_strings_2', 15, 1 );
	add_filter( 'style_loader_src', 	'woohoo_remove_query_strings_2', 15, 1 );
}


/**
 * For old theme versions Video shortcode
 * ========================================================= */

function woohoo_video_fix_shortcodes($content)
{
	$v = '/(\[(video)\s?.*?\])(.+?)(\[(\/video)\])/';
	$content = preg_replace( $v , '[embed]$3[/embed]' , $content);
	return $content;
}
add_filter('the_content', 'woohoo_video_fix_shortcodes', 0);


/**
 * Change The Default WordPress Excerpt Length
 * ========================================================= */

function woohoo_exb1_length() {
	return 60;
}
function woohoo_exb1() {
	add_filter( 'excerpt_length', 'woohoo_exb1_length', 999 );
	echo get_the_excerpt();
}

function woohoo_exb3_length() {
	return 54;
}
function woohoo_exb3() {
	add_filter( 'excerpt_length', 'woohoo_exb3_length', 999 );
	echo get_the_excerpt();
}

function woohoo_exb7_length() {
	return 28;
}
function woohoo_exb7() {
	add_filter( 'excerpt_length', 'woohoo_exb7_length', 999 );
	echo get_the_excerpt();
}

function woohoo_exb8_length() {
	return 32;
}
function woohoo_exb8() {
	add_filter( 'excerpt_length', 'woohoo_exb8_length', 999 );
	echo get_the_excerpt();
}

function woohoo_ei_slider_length() {
	return 14;
}
function woohoo_ei_slider() {
	add_filter( 'excerpt_length', 'woohoo_ei_slider_length', 999 );
	echo get_the_excerpt();
}

function woohoo_cl( $text, $chars = 120 ) {
	$text = wp_strip_all_tags( $text );
	$text = $text.' ';
	$text = mb_substr( $text , 0 , $chars , 'UTF-8');
	$text = $text.'&#8230;';
	return $text;
}


/**
 * Read More Functions
 * ========================================================= */

function woohoo_remove_excerpt( $more ) {
	return ' &hellip;';
}
add_filter('excerpt_more', 'woohoo_remove_excerpt');


/**
 * Avatar
 * ========================================================= */

function woohoo_get_avatar_url()
{
	$user_email = get_the_author_meta( 'user_email' );
	$user_gravatar_url = 'http://www.gravatar.com/avatar/' . md5($user_email) . '?s=555';
	echo esc_url($user_gravatar_url);
}


/**
 * Image URL
 * ========================================================= */

function woohoo_thumb_src( $size = '' )
{
	$image_id       = get_post_thumbnail_id( get_the_ID() );
	$image_url      = wp_get_attachment_image_src( $image_id, $size );
	return $image_url[0];
}

$GLOBALS['bdaia-small']         = 'bdaia-small';
$GLOBALS['bdaia-large']         = 'bdaia-large';
$GLOBALS['bdaia-full']          = 'bdaia-full';
$GLOBALS['bdaia-widget']        = 'bdaia-widget';
$GLOBALS['bdaia-gallery-grid']  = 'bdaia-gallery-grid';

function woohoo_posts_column_thumb($posts_columns)
{
	$columns = array();
	foreach ($posts_columns as $column => $name){
		if ($column == 'title'){
			$columns['Thumbnail'] = '<span class="dashicons dashicons-format-image"></span>';
			$columns[$column] = $name;
		} else $columns[$column] = $name;
	}
	return $columns;
}
add_filter('manage_posts_columns', 'woohoo_posts_column_thumb');

function woohoo_posts_custom_column_thumb($column_name, $id){
	if($column_name === 'Thumbnail'){
		if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {
			the_post_thumbnail( $GLOBALS['bdaia-small'] );
		}
	}
}
add_action('manage_posts_custom_column', 'woohoo_posts_custom_column_thumb',10,2);


function woohoo_post_style_col($defaults) {
	$defaults['bd_post_style_col'] = 'Post Style';
	return $defaults;
}
add_filter('manage_posts_columns', 'woohoo_post_style_col');


function woohoo_post_style_column( $column_name, $id )
{
	if( $column_name === 'bd_post_style_col' )
	{
		global $post;
		$bdaia_get_post_meta          = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );

		$post_template_style = $post_template_style_class = "";
		if( isset( $bdaia_get_post_meta['post_template_bd'] ) ) $post_template_style = $bdaia_get_post_meta['post_template_bd']; // Meta Post Template Style.

		if ( $post_template_style == 'postStyle1' ) {
			$post_template_style_class = 'Style1';
		} else if ( $post_template_style == 'postStyle2' ) {
			$post_template_style_class = 'Style2';
		} else if ( $post_template_style == 'postStyle3' ) {
			$post_template_style_class = 'Style3';
		} else if ( $post_template_style == 'postStyle4' ) {
			$post_template_style_class = 'Style4';
		} else if ( $post_template_style == 'postStyle5' ) {
			$post_template_style_class = 'Style5';
		} else if ( $post_template_style == 'postStyle6' ) {
			$post_template_style_class = 'Style6';
		} else if ( $post_template_style == 'postStyle7' ) {
			$post_template_style_class = 'Style7';
		} else if ( $post_template_style == 'postStyle8' ) {
			$post_template_style_class = 'Style8';
		} else if ( $post_template_style == 'postStyle9' ) {
			$post_template_style_class = 'Style9';
		} else if ( $post_template_style == 'postStyle10' ) {
			$post_template_style_class = 'Style10';
		} else {
			$post_template_style_class = 'Default';
		}

		echo $post_template_style_class;
	}
}
add_action('manage_posts_custom_column', 'woohoo_post_style_column',5,2);


/**
 * Comments
 * ========================================================= */

function woohoo_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	$add_below = '';

	?>
	<li <?php comment_class('comment-box'); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-header">
			<?php echo get_avatar($comment, 50); ?>
			<h3><?php echo get_comment_author_link() ?></h3>
			<p class="comment-meta">
				<?php printf('%1$s '.woohoo__tr( 'at' ).' %2$s', get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(' - '. woohoo__tr( 'Edit' ),'  ','') ?>
			</p>
		</div>
		<div class="comment-body">
			<p>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php echo woohoo_tr( 'Your comment is awaiting moderation.' ) ?></em><br />
				<?php endif; ?>
				<?php comment_text() ?>
			</p>
			<p class="tm-js-reply">
				<?php
				if ( is_rtl() ) {
					comment_reply_link(array_merge( $args, array('reply_text' => '<i class="icon-share-alt"></i> '. woohoo__tr( 'Reply' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
				} else {
					comment_reply_link(array_merge( $args, array('reply_text' => '<i class="icon-mail-reply"></i> '. woohoo__tr( 'Reply' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
				}
				?>
			</p>
		</div>
	</li>
	<?php
}


/**
 * Page NAV.
 * ========================================================= */

require_once ( get_template_directory().'/framework/functions/functions-pagenav.php' );
function woohoo_page_nav( $query = false, $num = false )
{
	?>
	<div class="bdaia-pagination">
		<?php woohoo_get_pagenavi( $query, $num ) ?>
	</div>
	<?php
}

/**
 * Google Fonts
 * ========================================================= */

function woohoo_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'woohoo-google-fonts', "$protocol://fonts.googleapis.com/css?family=Oswald:400,300,700|Lato:400,300,700,900|Work+Sans:400,300,500,600,700,800,900|Open+Sans:400,600,700,800|Playfair+Display:400,700,900,400italic|Raleway:400,300,500,600,700,800,900|Roboto:400,300,100,700|Montserrat:400,700&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic" );
}
add_action( 'wp_enqueue_scripts', 'woohoo_fonts' );


/**
 * Edit Comment Form Title.
 * ========================================================= */

function woohoo_comment_form_before() {
	ob_start();
}
add_action( 'comment_form_before', 'woohoo_comment_form_before' );

function woohoo_comment_form_after() {
	$html = ob_get_clean();
	$html = preg_replace(
		'/<h3 id="reply-title"(.*)>(.*)<\/h3>/',
		'<h4 class="block-title" id="reply-title"><span\1>\2</span></h4>',
		$html
	);
	echo $html;
}
add_action( 'comment_form_after', 'woohoo_comment_form_after' );


/**
 * Post Gallery Grid.
 * ========================================================= */

function woohoo_gallery_grid( $image = 'bd-normal' )
{
	$image_ids = woohoo_firstGalleryID();

	if ( ! $image_ids ) {
		return;
	}

	$images = get_posts(array(
		'post_type'         => 'attachment',
		'post_status'       => 'inherit',
		'post__in'          => $image_ids,
		'orderby'           => 'post__in',
		'posts_per_page'    => -1
	)); ?>
	<div class="bdaia-post-gallery justifiedgall_ztqoevjbhc justified-gallery">
		<?php foreach ($images as $attachment):
			$thumb_description = $attachment->post_excerpt;
			$thumb_caption = $attachment->post_content;
			?>
			<figure>
				<a href="<?php echo wp_get_attachment_url( $attachment->ID ); ?>" data-options="thumbnail: '<?php echo wp_get_attachment_url( $attachment->ID ); ?>'" data-caption="<?php echo esc_attr($thumb_description); ?>" class="thumbnail lightbox-enabled-<?php echo get_the_ID();?>">
                    <?php $imag_e      = wp_get_attachment_image_src( $attachment->ID, $image ); ?>
                    <img src="<?php echo ( $imag_e[0] ); ?>" <?php if ( ! empty( $thumb_description ) ) { ?> alt="<?php echo esc_attr( $thumb_description ); ?>" <?php } ?> />

                    <?php //echo wp_get_attachment_image( $attachment->ID, $image, array( "class" => "img-responsive" ) ); ?>

                    <?php /*if ( ! empty( $thumb_caption ) || ! empty( $thumb_description ) ) { ?>
						<div class="bdaia-featured-text" >
							<?php if ( ! empty( $thumb_description ) ) { ?>
								<div class="bdaia-post-description"><?php echo esc_attr($thumb_description); ?></div>
							<?php } ?>
						</div>
					<?php } */?>

				</a>
			</figure>
		<?php endforeach; ?>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function () { jQuery( 'a.lightbox-enabled-<?php echo get_the_ID();?>' ).iLightBox(); jQuery(".justifiedgall_ztqoevjbhc").justifiedGallery({ rowHeight: 400, fixedHeight: false, lastRow: 'justify', margins: 4, captions : true, randomize: false}); });
	</script>
	<?php
}


/**
 * Post Gallery.
 * ========================================================= */

function woohoo_post_gallery( $image = '' ) {

	$image_ids = woohoo_firstGalleryID();
	if ( ! $image_ids ) {
		return;
	}

	$images = get_posts(array(
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'post__in' => $image_ids,
		'orderby' => 'post__in',
		'posts_per_page' => -1
	));
	?>
	<div class="bdaia-post-gallery">
		<div class="gallery-slider">
			<div id="post-gallery-<?php echo get_the_ID();?>" class="flexslider">
				<ul class="slides">
					<?php foreach ($images as $attachment):
						$thumb_description = $attachment->post_excerpt;
						$thumb_caption = $attachment->post_content;
						?>
						<li>
							<figure>
								<a href="<?php echo wp_get_attachment_url( $attachment->ID ); ?>" data-options="thumbnail: '<?php echo wp_get_attachment_url( $attachment->ID ); ?>'" data-caption="<?php echo esc_attr($thumb_description); ?>" class="thumbnail lightbox-enabled-<?php echo get_the_ID();?>">
									<?php echo wp_get_attachment_image( $attachment->ID, $image ); ?>
									<?php if ( ! empty( $thumb_caption ) || ! empty( $thumb_description ) ) { ?>
										<div class="bdaia-featured-text">
											<?php if ( ! empty( $thumb_caption ) ) { ?>
												<div class="bdaia-post-caption"><?php echo esc_attr($thumb_caption); ?></div>
											<?php } ?>
											<?php if ( ! empty( $thumb_description ) ) { ?>
												<div class="bdaia-post-description"><?php echo esc_attr($thumb_description); ?></div>
											<?php } ?>
										</div>
									<?php } ?>
								</a>
							</figure>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery( 'a.lightbox-enabled-<?php echo get_the_ID();?>' ).iLightBox();
				jQuery('#post-gallery-<?php echo get_the_ID();?>').flexslider({
					animation       : "fade",
					randomize       : false,
					pauseOnHover    : false,
					controlNav      : false,
					directionNav    : true,
					prevText        : '',
					nextText        : '',
					keyboard        : false,
					touch           : true,
					smoothHeight    : true
				});
			});
		</script>
	</div>
	<?php
}

/**
 * Random article.
 * ========================================================= */

function woohoo_random_post()
{
	$randpost_url = "";
	if ( isset( $_GET['randpost'] ) )
	{
		$randpost_args['posts_per_page']        = 1;
		$randpost_args['orderby']               = 'rand';
		$randpost_args['no_found_rows']         = true;
		$randpost_args['ignore_sticky_posts']   = true;
		$randpost = new WP_Query( $randpost_args );
		if ( $randpost->have_posts() )
		{
			while ($randpost->have_posts()) : $randpost->the_post();
				$randpost_url = get_permalink();
			endwhile;
			wp_reset_query(); ?>

			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Refresh" content="0; url=<?php echo $randpost_url; ?>">
			</head>
			<body>
			</body>
			</html>
		<?php
		}
		die;
	}
}
add_action('init', 'woohoo_random_post');

/**
 * Deletes first gallery shortcode and returns content.
 * ========================================================= */

function woohoo_strip_shortcode_gallery( $content ) {

	preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
	if ( ! empty( $matches ) ) {
		foreach ( $matches as $shortcode ) {
			if ( 'gallery' === $shortcode[2] ) {
				$pos = strpos( $content, $shortcode[0] );
				if ($pos !== false)
					return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
			}
		}
	}
}

function woohoo_remove_gallery( $content )
{
	$meta_page_options      = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
	$page_head ='';
	if( isset( $meta_page_options['bd_page_head'] ) ){
		$page_head = $meta_page_options['bd_page_head'];
	}

	if ( $page_head =='slider' || get_post_format( get_the_ID() ) == 'gallery' ) {
		$content = woohoo_strip_shortcode_gallery( get_the_content() );
	}
	return $content;
}
add_filter( 'the_content', 'woohoo_remove_gallery', 6);

function woohoo_firstGalleryID( $content = null )
{
	if ( !$content ) {
		$content = get_the_content();
	}

	preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
	if (!empty($matches)) {
		foreach ( $matches as $shortcode ) {
			if ( 'gallery' === $shortcode[2] ) {
				$atts = shortcode_parse_atts( $shortcode[3] );
				if ( ! empty( $atts['ids'] ) ) {
					$ids = explode( ',', $atts['ids'] );
					return $ids;
				}
			}
		}
	}
	return false;
}


/**
 * Rand.
 * ========================================================= */

if( ! function_exists( 'woohoo_rand' ) )
{
	function woohoo_rand( $length )
	{
		$rand_str = "";
		for($i=0; $i<$length; $i++)
		{
			$rand_num = mt_rand(0,61);
			if($rand_num < 10)
			{
				$rand_str .= chr($rand_num+48);
			}
			else if($rand_num < 36)
			{
				$rand_str .= chr($rand_num+55);
			}else
			{
				$rand_str .= chr($rand_num+61);
			}
		}
		return $rand_str;
	}
}



/**
 * Override theme default specification for product 3 per row
 * ========================================================= */

if( ! function_exists( 'woohoo_wc_loop_shop_columns' ) )
{
	function woohoo_wc_loop_shop_columns($number_columns) {
		return 3;
	}
	add_filter('loop_shop_columns', 'woohoo_wc_loop_shop_columns', 99, 1);
}



/*-----------------------------------------------------------------------------------*/
# WooCommerce Number of products per page
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woohoo_wc_product_pre_page' )){

	add_filter( 'loop_shop_per_page', 'woohoo_wc_product_pre_page', 20 );
	function woohoo_wc_product_pre_page(){
		return 9;
	}

}

/**
 * Woo Breadcrumb
 * ========================================================= */

add_filter('woocommerce_breadcrumb_defaults', 'woohoo_woocommerce_breadcrumbs');
function woohoo_woocommerce_breadcrumbs()
{
	if( is_rtl() ) $bd_delimiter = '<span class="bdaia-io bdaia-io-angle-double-left"></span>';
	else $bd_delimiter = '<span class="bdaia-io bdaia-io-angle-double-right"></span>';

	return array(
		'delimiter' => '<span class="delimiter">'.$bd_delimiter.'</span>',
		'wrap_before' => '<div class="bdaia-crumb-container">',
		'wrap_after' => '</div>',
		'before' => '<span>',
		'after' => '</span>',
		'home' => _x('Home', 'breadcrumb', 'woohoo'),
	);
}


/**
 * Use own pagination
 * ========================================================= */

if (!function_exists('woocommerce_pagination')) {
	function woocommerce_pagination() {
		echo woohoo_page_nav();
	}
}

if( ! function_exists( 'woohoo_woocommerce_header_add_to_cart_fragment' )){

	add_filter( 'woocommerce_add_to_cart_fragments', 'woohoo_woocommerce_header_add_to_cart_fragment' );
	function woohoo_woocommerce_header_add_to_cart_fragment( $fragments ){

		$output = '<span class="shooping-count-outer">';

		if( WC()->cart->get_cart_contents_count() != 0 ){
			$output .= '<span class="shooping-count">'. WC()->cart->get_cart_contents_count() .'</span>';
		}

		$output .= '<span class="bdaia-io bdaia-io-cart"></span></span>';

		$fragments['.shooping-count-outer'] = $output;

		return $fragments;
	}
}



/**
 * TGM.
 * ========================================================= */

add_action( 'tgmpa_register', 'woohoo_theme_register_required_plugins' );
function woohoo_theme_register_required_plugins() {

    $plugins = array(
        array(
            'name'               => 'WPBakery Page',
            'slug'               => 'js_composer',
            'source'             => WOOHOO_TEMPLATE_URL . '/framework/plugins/js_composer.tar',
            'version'            => '6.1',
            'required'           => false,
        ),

        array(
            'name'               => 'Shortcodes',
            'slug'               => 'bdaia-shortcodes',
            'source'             => WOOHOO_TEMPLATE_URL . '/framework/plugins/shortcodes.tar',
            'required'           => true,
        ),

        array(
            'name'               => 'LayerSlider',
            'slug'               => 'LayerSlider',
            'source'             => WOOHOO_TEMPLATE_URL . '/framework/plugins/LayerSlider.tar',
            'version'            => '6.11.0',
            'required'           => false,
        ),

        array(
            'name'               => 'Slider Revolution',
            'slug'               => 'revslider',
            'source'             => WOOHOO_TEMPLATE_URL . '/framework/plugins/revslider.tar',
            'version'            => '6.1.5',
            'required'           => false,
        ),

        array(
            'name'               => 'Master Slider Pro',
            'slug'               => 'masterslider.tar',
            'source'             => WOOHOO_TEMPLATE_URL . '/framework/plugins/masterslider.tar',
            'version'            => '3.2.14',
            'required'           => false,
        ),


        array(
            'name'      => 'Loco Translate',
            'slug'      => 'loco-translate',
            'required'  => false,
        ),

        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
        ),

        array(
            'name'      => 'Easy Custom Sidebars',
            'slug'      => 'easy-custom-sidebars',
            'required'  => false,
        ),

        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),

        array(
            'name'     => 'MailChimp for WordPress',
            'slug'     => 'mailchimp-for-wp',
            'required' => false,
            'version'  => '',
        ),

        array(
            'name'      => 'Regenerate Thumbnails',
            'slug'      => 'regenerate-thumbnails',
            'required'  => false,
        ),
    );

	$config = array(
		'id'           => 'woohoo',
		'default_path' => '',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => ''
	);

	tgmpa( $plugins, $config );
}

/**
 * Get Cats slug
 * ========================================================= */

function woohoo_get_cats_by_slug( $catslugs )
{
	$catids = array();
	foreach( $catslugs as $slug ) {
		$catids[] = get_category_by_slug( $slug )->term_id;
	}
	return $catids;
}

/**
 * Post Classes
 * ========================================================= */

function woohoo_post_class( $classes = false )
{
	$post_format = get_post_format( get_the_ID() );
	if( !empty($post_format) ){
		if( !empty($classes) ) $classes .= ' ';
		$classes .= 'bdaia-format-'.$post_format;
	}
	if( !empty($classes) ) echo 'class="'.$classes.'"';
}


/**
 * Remove Pingback from Header
 * ========================================================= */

function woohoo_remove_x_pingback( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
}
add_filter('wp_headers', 'woohoo_remove_x_pingback');


/**
 * Get Icon Play
 * ========================================================= */
if ( ! function_exists( 'woohoo_video_icon_play' ) )
{
	function woohoo_video_icon_play()
	{
		$bdaia_p_video = get_post_meta( get_the_ID(),'post_video_bd', true );
		$video_id = $video_type = $bdaia_video_url = '';

		if( isset( $bdaia_p_video['video'] ) ) $video_id = $bdaia_p_video['video'];
		if( isset( $bdaia_p_video['video_type'] ) ) $video_type = $bdaia_p_video['video_type'];
		$protocol = is_ssl() ? 'https' : 'http';

		if( $video_type == "youtube" ) $bdaia_video_url = $protocol.'://www.youtube.com/embed/'.$video_id.'?autoplay=0&amp;autohide=1&amp;fs=1&amp;rel=0&amp;hd=1&amp;wmode=opaque&amp;enablejsapi=1';
		elseif( $video_type == "vimeo" ) $bdaia_video_url = $protocol.'://player.vimeo.com/video/'.$video_id.'?autoplay=0';
		elseif( $video_type == "daily" ) $bdaia_video_url = $protocol.'://www.dailymotion.com/embed/video/'.$video_id;

		if( $video_id ) { ?>
            <div class="vid-play"><a href="<?php echo the_permalink( get_the_ID() ); ?>"><span class="bdaia-io bdaia-io-controller-play"></span></a></div>
		<?php }
	}
}

/**
 * Get Data From API'S
 * ========================================================= */

function woohoo_remote_get( $url , $json = true)
{
	$get_request    = wp_remote_get( $url , array( 'timeout' => 18 , 'sslverify' => false ) );
	$request        = wp_remote_retrieve_body( $get_request );

	if( $json ) $request = @json_decode( $request , true );
	return $request;
}

/**
 * Add specific CSS class by filter
 * ========================================================= */

function woohoo_body_class( $classes )
{
	$layout_boxed = $body_custom_class = $bdaia_new_articles_in_sticky_nav = $click_to_comments = $bdaia_is_lazyload = '';
	if ( woohoo_get_option( 'bdaia_theme_layout' ) == 'boxed'        ) $layout_boxed = 'bdaia-boxed ' ;
	if ( woohoo_get_option( 'woohoo_add_body_class' )                ) $body_custom_class = woohoo_get_option( 'woohoo_add_body_class' );
	if ( woohoo_get_option( 'bdaia_new_articles_in_sticky_nav' )     ) $bdaia_new_articles_in_sticky_nav = ' of-new-article ';
	if ( ! woohoo_get_option( 'bdaia_p_commetns_posts_click_btn' )   ) $click_to_comments = ' ct-comments ';

	if ( woohoo_get_option( 'bdaia_has_lazy_load' ) ) {
		$bdaia_is_lazyload = ' has-lazy-load';
	}



	$classes[] = $layout_boxed . $body_custom_class . $bdaia_new_articles_in_sticky_nav . $click_to_comments . $bdaia_is_lazyload;
	return $classes;
}
add_filter( 'body_class', 'woohoo_body_class' );


/**
 * Above content box
 * ========================================================= */

function woohoo_above_content_box()
{
	if( is_home() || is_front_page() || is_page() )
	{
		$woohoo_a_c_b = $woohoo_a_c_b_t = $woohoo_a_c_b_b = "";
		$woohoo_get_page_more = get_post_meta( get_the_ID(), 'meta_page_custom_bd', true );

		if( isset( $woohoo_get_page_more['bdaia_code_above_content'] ) ) $woohoo_a_c_b = $woohoo_get_page_more['bdaia_code_above_content'];
		if( isset( $woohoo_get_page_more['bdaia_code_above_content_t'] ) ) $woohoo_a_c_b_t = $woohoo_get_page_more['bdaia_code_above_content_t'];
		if( isset( $woohoo_get_page_more['bdaia_code_above_content_b'] ) ) $woohoo_a_c_b_b = $woohoo_get_page_more['bdaia_code_above_content_b'];

		$woohoo_a_c_b_m = '';
		if ( ! empty( $woohoo_a_c_b_t ) || ! empty( $woohoo_a_c_b_b ) ) {
			$woohoo_a_c_b_m = ' style="';
			if ( ! empty( $woohoo_a_c_b_t ) ) {
				$woohoo_a_c_b_m .= ' margin-top:' . $woohoo_a_c_b_t . 'px;';
			}
			if ( ! empty( $woohoo_a_c_b_b ) ) {
				$woohoo_a_c_b_m .= ' margin-bottom:' . $woohoo_a_c_b_b . 'px;';
			}
			$woohoo_a_c_b_m .= '"';
		}

		if ( ! empty( $woohoo_a_c_b ) ) {
			?>
			<div class="cfix"></div>
			<div class="bdaia-custom-area"<?php echo $woohoo_a_c_b_m; ?>>
				<div class="bd-container">
					<?php echo do_shortcode( htmlspecialchars_decode( stripslashes( $woohoo_a_c_b ) ) ); ?>
				</div>
			</div>
			<div class="cfix"></div>
			<?php
		}
	}
}

/**
 * Below content box
 * ========================================================= */
function woohoo_below_content_box()
{
	if( is_home() || is_front_page() || is_page() )
	{
		$b_c_b = $b_c_b_t = $b_c_b_b = "";
		$get_page_more = get_post_meta( get_the_ID(), 'meta_page_custom_bd', true );

		if( isset( $get_page_more['bdaia_code_below_content'] ) ) $b_c_b = $get_page_more['bdaia_code_below_content'];
		if( isset( $get_page_more['bdaia_code_below_content_t'] ) ) $b_c_b_t = $get_page_more['bdaia_code_below_content_t'];
		if( isset( $get_page_more['bdaia_code_below_content_b'] ) ) $b_c_b_b = $get_page_more['bdaia_code_below_content_b'];

		$b_c_b_m = '';
		if ( ! empty( $b_c_b_t ) || ! empty( $b_c_b_b ) ) {
			$b_c_b_m = ' style="';
			if ( ! empty( $b_c_b_t ) ) {
				$b_c_b_m .= ' margin-top:' . $b_c_b_t . 'px;';
			}
			if ( ! empty( $b_c_b_b ) ) {
				$b_c_b_m .= ' margin-bottom:' . $b_c_b_b . 'px;';
			}
			$b_c_b_m .= '"';
		}

		if ( ! empty( $b_c_b ) ) {
			?>
			<div class="cfix"></div>
			<div class="bdaia-custom-area"<?php echo $b_c_b_m; ?>>
				<div class="bd-container">
					<?php echo do_shortcode( htmlspecialchars_decode( stripslashes( $b_c_b ) ) ); ?>
				</div>
			</div>
			<div class="cfix"></div>
			<?php
		}
	}
}

/**
 * Footer ad
 * ========================================================= */
function woohoo_footer_ad()
{
	$bdaia_footer_desktop_ad = woohoo_get_option( 'bdaia_footer_ad'      );

	if( $bdaia_footer_desktop_ad ) { ?>
	<div class="bdaia-footer-e3-desktop"><div class="bdaia-e3-container"><?php echo do_shortcode( ( stripslashes( $bdaia_footer_desktop_ad ) ) ); ?></div></div>
	<?php
	}
}

/**
 * PAGE Class
 * ========================================================= */
function woohoo_page_class()
{
	$woohoo_get_post_meta = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );
	$woohoo_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );

	if( is_category() || is_single() )
	{
		$woohoo_cat_id = '';
		if( is_category() ) $woohoo_cat_id = get_query_var( 'cat' ) ;
		if( is_single() )
		{
			$categories = get_the_category( get_the_ID() );
			if( !empty( $categories[0]->term_id ) ) $woohoo_cat_id = $categories[0]->term_id;
		}
		$woohoo_get_cat_meta = get_option( "bd_cat_$woohoo_cat_id" );
	}

	$woohoo_sticky = '';
	if ( woohoo_get_option( 'header_fix' ) ) $woohoo_sticky = ' sticky-nav-on ';

	$woohoo_lc_class = "";
	$woohoo_logo_center = woohoo_get_option( 'bdaia_logo_center' );
	if( $woohoo_logo_center ) $woohoo_lc_class = " bdaia-logo-center ";

	$woohoo_lazyload_c = "";
	if( woohoo_get_option( 'bd_lazyload' ) ) $woohoo_lazyload_c = ' bdaia-lazyload ';

	$woohoo_pts = $woohoo_pts_class = "";
	if( isset( $woohoo_get_post_meta['post_template_bd'] ) ) {
		$woohoo_pts = $woohoo_get_post_meta['post_template_bd'];
	}
	elseif( isset( $woohoo_get_cat_meta['bdaia_cat_post_template'] ) ) {
		$woohoo_pts = $woohoo_get_cat_meta['bdaia_cat_post_template'];
	}
	if( $woohoo_pts == '' ) $woohoo_pts = woohoo_get_option( 'bdaia_post_template' );

	if( is_single()) {

		if ( $woohoo_pts == 'postStyle1' ) {
			$woohoo_pts_class = ' bdaia-post-template-style1 ';
		} else if ( $woohoo_pts == 'postStyle2' ) {
			$woohoo_pts_class = ' bdaia-post-template-style2 ';
		} else if ( $woohoo_pts == 'postStyle3' ) {
			$woohoo_pts_class = ' bdaia-post-template-style3 ';
		} else if ( $woohoo_pts == 'postStyle4' ) {
			$woohoo_pts_class = ' bdaia-post-template-style4 ';
		} else if ( $woohoo_pts == 'postStyle5' ) {
			$woohoo_pts_class = ' bdaia-post-template-style5 ';
		} else if ( $woohoo_pts == 'postStyle6' ) {
			$woohoo_pts_class = ' bdaia-post-template-style6 ';
		} else if ( $woohoo_pts == 'postStyle7' ) {
			$woohoo_pts_class = ' bdaia-post-template-style7 ';
		} else if ( $woohoo_pts == 'postStyle8' ) {
			$woohoo_pts_class = ' bdaia-post-template-style8 ';
		} else if ( $woohoo_pts == 'postStyle9' ) {
			$woohoo_pts_class = ' bdaia-post-template-style9 ';
		} else if ( $woohoo_pts == 'postStyle10' ) {
			$woohoo_pts_class = ' bdaia-post-template-style10 ';
		} else if ( $woohoo_pts == 'postStyle11' ) {
			$woohoo_pts_class = ' bdaia-post-template-style11 ';
		}
		else {
			$woohoo_pts_class = ' bdaia-post-template-default ';
		}
	}

	$woohoo_post_sidebars = $woohoo_sidebar = "";
	if( is_single() ) {
		if( isset( $woohoo_get_post_meta['sidebar_position_bd'] ) )
			$woohoo_post_sidebars = $woohoo_get_post_meta['sidebar_position_bd'];
		else
			$woohoo_post_sidebars = woohoo_get_option( 'bdaia_p_sidebar_pos' );
	}
	elseif( is_page() ) {
		if( isset( $woohoo_get_page_meta['sidebar_position_bd'] ) ) $woohoo_post_sidebars = $woohoo_get_page_meta['sidebar_position_bd'];
	}
	elseif( is_category() ) {
		if( isset( $woohoo_get_cat_meta['sidebar_po'] ) ) $woohoo_post_sidebars = $woohoo_get_cat_meta['sidebar_po'];
	}
	elseif( is_author() ) {
		$woohoo_post_sidebars = woohoo_get_option( 'author_sidebar_pos' );
	}
	elseif( is_tag() ) {
		$woohoo_post_sidebars = woohoo_get_option( 'tag_sidebar_pos' );
	}
	elseif( is_archive() ) {
		$woohoo_post_sidebars = woohoo_get_option( 'archive_sidebar_pos' );
	}
	elseif( is_search() ) {
		$woohoo_post_sidebars = woohoo_get_option( 'search_sidebar_pos' );
	}

	if ( $woohoo_post_sidebars == '' ) $woohoo_post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

	if( $woohoo_post_sidebars == 'sideLeft' ) $woohoo_sidebar = ' bdaia-sidebar-left ';
	elseif ( $woohoo_post_sidebars == 'sideNo' ) $woohoo_sidebar = ' bdaia-sidebar-none ';
	elseif ( $woohoo_post_sidebars == 'sideRight' ) $woohoo_sidebar = ' bdaia-sidebar-right ';

	$classes = $woohoo_lazyload_c . $woohoo_lc_class . $woohoo_sticky . $woohoo_pts_class . $woohoo_sidebar;
	return $classes;
}

/**
 * PAGE Class
 * ========================================================= */
function woohoo_sidebar_class()
{
	$woohoo_get_post_meta = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );
	$woohoo_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );

	if( is_category() || is_single() )
	{
		$woohoo_cat_id = '';
		if( is_category() ) $woohoo_cat_id = get_query_var( 'cat' ) ;
		if( is_single() )
		{
			$categories = get_the_category( get_the_ID() );
			if( !empty( $categories[0]->term_id ) ) $woohoo_cat_id = $categories[0]->term_id;
		}
		$woohoo_get_cat_meta = get_option( "bd_cat_$woohoo_cat_id" );
	}

	$woohoo_post_sidebars = $woohoo_sidebar = "";
	if( is_single() ) {
		if( isset( $woohoo_get_post_meta['sidebar_position_bd'] ) )
			$woohoo_post_sidebars = $woohoo_get_post_meta['sidebar_position_bd'];
		else
			$woohoo_post_sidebars = woohoo_get_option( 'bdaia_p_sidebar_pos' );
	}
	elseif( is_page() ) {
		if( isset( $woohoo_get_page_meta['sidebar_position_bd'] ) ) $woohoo_post_sidebars = $woohoo_get_page_meta['sidebar_position_bd'];
	}
	elseif( is_category() ) {
		if( isset( $woohoo_get_cat_meta['sidebar_po'] ) ) $woohoo_post_sidebars = $woohoo_get_cat_meta['sidebar_po'];
	}
	elseif( is_author() ) {
		$woohoo_post_sidebars = woohoo_get_option( 'author_sidebar_pos' );
	}
	elseif( is_tag() ) {
		$woohoo_post_sidebars = woohoo_get_option( 'tag_sidebar_pos' );
	}
	elseif( is_archive() ) {
		$woohoo_post_sidebars = woohoo_get_option( 'archive_sidebar_pos' );
	}
	elseif( is_search() ) {
		$woohoo_post_sidebars = woohoo_get_option( 'search_sidebar_pos' );
	}

	if ( $woohoo_post_sidebars == '' ) $woohoo_post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

	if( $woohoo_post_sidebars == 'sideLeft' ) $woohoo_sidebar = ' bdaia-sidebar-left ';
	elseif ( $woohoo_post_sidebars == 'sideNo' ) $woohoo_sidebar = ' bdaia-sidebar-none ';
	elseif ( $woohoo_post_sidebars == 'sideRight' ) $woohoo_sidebar = ' bdaia-sidebar-right ';

	$classes = $woohoo_sidebar;
	return $classes;
}

/**
 * POST Template 1 header
 * ========================================================= */
function woohoo_template1_header()
{
	$woohoo_get_post_meta = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );

	if( is_category() || is_single() )
	{
		$woohoo_cat_id = '';
		if( is_category() ) $woohoo_cat_id = get_query_var( 'cat' ) ;
		if( is_single() )
		{
			$categories = get_the_category( get_the_ID() );
			if( !empty( $categories[0]->term_id ) ) $woohoo_cat_id = $categories[0]->term_id;
		}
		$woohoo_get_cat_meta = get_option( "bd_cat_$woohoo_cat_id" );
	}
	$woohoo_pts = "";
	if( isset( $woohoo_get_post_meta['post_template_bd'] ) ) $woohoo_pts = $woohoo_get_post_meta['post_template_bd'];
	elseif( isset( $woohoo_get_cat_meta['bdaia_cat_post_template'] ) ) $woohoo_pts = $woohoo_get_cat_meta['bdaia_cat_post_template'];
	if( $woohoo_pts == '' ) $woohoo_pts = woohoo_get_option( 'bdaia_post_template' );

	if( is_single() )
	{
		if( $woohoo_pts == 'postStyle1') {
			while ( have_posts() ) : the_post();
				?><div class="thumbnail-cover" <?php if( has_post_thumbnail() ) { ?> style="background-image:url(<?php echo woohoo_thumb_src( 'full' ); ?>);" <?php } ?>></div><?php
			endwhile;
		}
	}
}

/**
 * Custom wp link pages
 * ========================================================= */
if ( ! function_exists( 'woohoo_wp_link_pages' ) ) {
	function woohoo_wp_link_pages( $args = '' ) {
		wp_link_pages( array(
			'before'      => '<div class="bdaia-pagination"><span class="page-links-title">' . woohoo__tr( 'Pages' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span class="current">',
			'link_after'  => '</span>'
		) );
	}
}

/**
 * Icon video play
 * ========================================================= */
if ( ! function_exists( 'woohoo_icon_video_play' ) )
{
	function woohoo_icon_video_play()
	{
		$bdaia_p_video  = get_post_meta( get_the_ID(),'post_video_bd', true );
		$protocol       = is_ssl() ? 'https' : 'http';

		$video_id = $video_type = $bdaia_video_url = '';

		if ( isset( $bdaia_p_video['video'] )       ) $video_id     = $bdaia_p_video['video'];
		if ( isset( $bdaia_p_video['video_type'] )  ) $video_type   = $bdaia_p_video['video_type'];

		if ( $video_type == "youtube"    ) $bdaia_video_url = $protocol.'://www.youtube.com/embed/'.$video_id.'?autoplay=0&amp;autohide=1&amp;fs=1&amp;rel=0&amp;hd=1&amp;wmode=opaque&amp;enablejsapi=1';
		elseif ( $video_type == "vimeo"  ) $bdaia_video_url = $protocol.'://player.vimeo.com/video/'.$video_id.'?autoplay=0';
		elseif ( $video_type == "daily"  ) $bdaia_video_url = $protocol.'://www.dailymotion.com/embed/video/'.$video_id;

		ob_start();
		if( $video_id )
		{
			?>
			<div class="vid-play">
				<a href="<?php echo the_permalink( get_the_ID() ); ?>">
					<span class="bdaia-io bdaia-io-controller-play"></span>
				</a>
			</div>
			<?php
		}
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}

/**
 * Get login
 * ========================================================= */
if( ! function_exists( 'woohoo_login_popup' ) )
{
	function woohoo_login_popup( $login_only = 0 )
	{
		global $user_ID, $user_identity;

		$protocol = is_ssl() ? 'https' : 'http';

		if ( $user_ID )
		{
			if ( empty( $login_only ) )
			{
				?>
				<div class="woohoo-loginform-info">
					<div class="woohoo-loginform-avatar">
						<?php echo ( get_avatar( $user_ID, $size = '100' ) ); ?>
					</div>

					<ul class="login-list">
						<li><?php echo woohoo_tr( 'Welcome' ) . '&nbsp;&nbsp;' . esc_attr( $user_identity ); ?></li>
						<li class="userWpAdmin">
							<a href="<?php echo esc_url( home_url() ); ?>/wp-admin/"><?php woohoo_tr( 'Dashboard' ) ?></a>
						</li>
						<li class="userprofile">
							<a href="<?php echo esc_url( home_url() ); ?>/wp-admin/profile.php"><?php woohoo_tr( 'Your Profile' ) ?></a>
						</li>
						<li class="userlogout">
							<a href="<?php echo esc_url( wp_logout_url() ); ?>"><?php woohoo_tr( 'Logout' ) ?></a>
						</li>
					</ul>

					<div class="woohoo-loginform-description">
						<?php echo ( get_the_author_meta ( 'description', $user_ID ) ); ?>
					</div>

					<div class="bdaia-social-io-colored">
						<div class="bdaia-social-io bdaia-social-io-size-32">
							<?php
							## Web site  ----------------------(^.^)
							if ( get_the_author_meta ( 'url', $user_ID          ) ) echo '<a class="bdaia-io-url-home" href="'. esc_url ( get_the_author_meta ( 'url', $user_ID ) ) .'"><span class="bdaia-io bdaia-io-home3"></span></a>';

							## Twitter   ----------------------(^.^)
							if ( get_the_author_meta ( 'twitter', $user_ID      ) ) echo '<a class="bdaia-io-url-twitter" href="'.$protocol.'://www.twitter.com/'. esc_url ( get_the_author_meta ( 'twitter', $user_ID ) ) .'"><span class="bdaia-io bdaia-io-twitter"></span></a>';

							## Facebook  ----------------------(^.^)
							if ( get_the_author_meta ( 'facebook', $user_ID     ) ) echo '<a class="bdaia-io-url-facebook" href="'. esc_url ( get_the_author_meta ( 'facebook', $user_ID ) ) .'"><span class="bdaia-io bdaia-io-facebook"></span></a>';

							## Instagram  ---------------------(^.^)
							if ( get_the_author_meta ( 'instagram', $user_ID    ) ) echo '<a class="bdaia-io-url-instagram" href="'. esc_url ( get_the_author_meta ( 'instagram', $user_ID ) ) .'"><span class="bdaia-io bdaia-io-instagram"></span></a>';

							## Google+   ----------------------(^.^)
							if ( get_the_author_meta ( 'google', $user_ID       ) ) echo '<a class="bdaia-io-url-google-plus" href="'.$protocol.'://plus.google.com/'. esc_url ( get_the_author_meta ( 'google', $user_ID ) ) .'?rel=author"><span class="bdaia-io bdaia-io-google-plus"></span></a>';

							## Youtube   ----------------------(^.^)
							if ( get_the_author_meta ( 'youtube', $user_ID      ) ) echo '<a class="bdaia-io-url-youtube" href="'. esc_url ( get_the_author_meta ( 'youtube', $user_ID ) ) .'"><span class="bdaia-io bdaia-io-youtube"></span></a>';

							## Linkedin  ----------------------(^.^)
							if ( get_the_author_meta ( 'linkedin', $user_ID     ) ) echo '<a class="bdaia-io-url-linkedin" href="'. esc_url ( get_the_author_meta ( 'linkedin', $user_ID ) ) .'"><span class="bdaia-io bdaia-io-linkedin2"></span></a>';

							## Pinterest ----------------------(^.^)
							if ( get_the_author_meta ( 'pinterest', $user_ID    ) ) echo '<a class="bdaia-io-url-pinterest" href="'. esc_url ( get_the_author_meta ( 'pinterest', $user_ID ) ) .'"><span class="bdaia-io bdaia-io-social-pinterest"></span></a>';

							## Flickr    ----------------------(^.^)
							if ( get_the_author_meta ( 'flickr', $user_ID       ) ) echo '<a class="bdaia-io-url-flickr" href="'. esc_url ( get_the_author_meta ( 'flickr' , $user_ID ) ) .'"><span class="bdaia-io bdaia-io-flickr2"></span></a>';

							## Dribbble  ----------------------(^.^)
							if ( get_the_author_meta ( 'dribbble', $user_ID     ) ) echo '<a class="bdaia-io-url-dribbble" href="'. esc_url ( get_the_author_meta ( 'dribbble', $user_ID ) ) .'"><span class="bdaia-io bdaia-io-dribbble"></span></a>'; ?>
						</div>
					</div>
				</div>
				<?php
			}
		}
		else
		{
			?>
			<div class="woohoo-loginform-welcome">
				<?php
				echo '<span class="we">'. woohoo__tr( 'Welcome!' ) .'</span>';
				echo '<span>'. woohoo__tr( 'Log into your account' ) .'</span>';
				?>
			</div>
			<?php wp_login_form(); ?>
            <ul class="woohoo-loginform-links">
                <li><a href="<?php echo esc_url( home_url( 'wp-login.php?action=register' ) ); ?>"><?php echo woohoo__tr( 'Register' ); ?></a></li>
                <li>|</li>
                <li><a href="<?php echo esc_url( home_url( 'wp-login.php?action=lostpassword' ) ); ?>"><?php echo woohoo__tr( 'Lost your password?' ); ?></a></li>
            </ul>
            <?php
		}
	}
}

/**
 * GET post video.
 * ========================================================= */
if ( ! function_exists( 'woohoo_get_video' ) )
{
	function woohoo_get_video()
	{
		$bdaia_p_video  = get_post_meta( get_the_ID(),'post_video_bd', true );
		$autoplay       = woohoo_get_option( 'bdaia_video_auto_play' );

		$video_id = $video_type = $auto_play = '';

		if ( $autoplay ) {
			$auto_play = "autoplay=1&";
		}
		else {
			$auto_play = '';
		}

		if( isset( $bdaia_p_video['video'] ) ) $video_id = $bdaia_p_video['video'];
		if( isset( $bdaia_p_video['video_type'] ) ) $video_type = $bdaia_p_video['video_type'];

		$protocol = is_ssl() ? 'https' : 'http';

		if ( $video_type == 'youtube' && $video_id   ) echo '<iframe width="600" height="560" src="'.$protocol.'://www.youtube.com/embed/'.$video_id.'?'.$auto_play.'feature=oembed&wmode=opaque&vq=hd720" frameborder="0" allowfullscreen></iframe>';
		elseif ( $video_type == 'vimeo' && $video_id ) echo '<iframe src="'.$protocol.'://player.vimeo.com/video/'.$video_id.'?'.$auto_play.'title=0&quality=1080p&amp;byline=0&amp;portrait=0" width="500" height="212" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		elseif ( $video_type == 'daily' && $video_id ) echo '<iframe frameborder="0" width="600" height="560" src="'.$protocol.'://www.dailymotion.com/embed/video/'.$video_id.'?'.$auto_play.'&quality=1080p"></iframe>';

	}
}

/**
 Whatsapp Button
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_whatsapp_button' ) )
{
	function woohoo_whatsapp_button()
	{
		global $post;

		$post_id        = $post->ID;
		$post_link      = get_permalink( $post_id );
		$post_title     = $post->post_title;
		$post_excerpt   = $post->post_excerpt;

		if ( $post_excerpt == "" ) {
			$data_text = $post_title;
		}
		else {
			$data_text = $post_excerpt;
		}

		$code  = '';
		$code .= '<a href="whatsapp://send?text='.htmlspecialchars( urlencode(html_entity_decode( $data_text, ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '%20-%20' . urlencode( esc_url( $post_link ) ).'" ><span class="bdaia-io bdaia-io-whatsapp"></span></a>';

		return $code;
	}
}

/**
 Telegram Button
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_telegram_button' ) )
{
	function woohoo_telegram_button()
	{
		global $post;

		$post_id        = $post->ID;
		$post_link      = get_permalink( $post_id );
		$post_title     = $post->post_title;
		$post_excerpt   = $post->post_excerpt;

		if ( $post_excerpt == "" ) {
			$data_text = $post_title;
		}
		else {
			$data_text = $post_excerpt;
		}

		$code  = '';
		$code .= '<a href="tg://msg?text='.htmlspecialchars( urlencode(html_entity_decode( $data_text, ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '%20-%20' . urlencode( esc_url( $post_link ) ).'" ><span class="bdaia-io bdaia-io-telegram"></span></a>';

		return $code;
	}
}

/**
 Get the custom primary category
 * ----------------------------------------------------------------------------- */
if ( ! function_exists( 'woohoo_custom_primary_category' ) )
{
	function woohoo_custom_primary_category()
	{
		$woohoo_post_theme_settings = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );
		if ( !empty( $woohoo_post_theme_settings['woohoo_primary_cat'] ) )
		{
			$get_term_id = "";
			$g_category = get_category_by_slug( $woohoo_post_theme_settings['woohoo_primary_cat'] );

			if( !empty( $g_category ) ) $get_term_id    = $g_category->term_id;
			$selected_category_obj = get_category( $get_term_id );
		}
		else {
			$categories = get_the_category( get_the_ID() );
			$selected_category_obj = $categories[0];
		}

		if ( !empty( $selected_category_obj ) ) {
			echo '<a class="bd-cat-link bd-cat-'. $selected_category_obj->cat_ID .'" href="'. get_category_link( $selected_category_obj->cat_ID ) .'">'. $selected_category_obj->name .'</a>'."\n";
		}
	}
}







/**
# GIF Unset sizes.
 *-----------------------------------------------------------------------------*/
if( ! function_exists( 'woohoo_unset_sizes_if_gif' ) )
{
	add_action( 'intermediate_image_sizes_advanced', 'woohoo_unset_sizes_if_gif' );
	function woohoo_unset_sizes_if_gif( $sizes )
	{
		// we're only having the sizes available
		// we're using debug_backtrace to get additional information
		$dbg_back = debug_backtrace();
		// scan $dbg_back array for function and get $args
		foreach ( $dbg_back as $sub ) {
			if ( $sub[ 'function'] == 'wp_generate_attachment_metadata' ) {
				$args = $sub[ 'args' ];
			}
		}
		// attachment id
		$att_id       = $args[0];
		// attachment path
		$att_path     = $args[1];
		// split up file information
		$pathinfo = pathinfo( $att_path );
		// if extension is gif unset sizes
		if ( $pathinfo[ 'extension' ] == 'gif' ) {
			// get all intermediate sizes
			$intermediate_image_sizes = get_intermediate_image_sizes();
			// loop trough the intermediate sizes array
			foreach ( $intermediate_image_sizes as $size ) {
				// unset the size in the sizes array
				unset( $sizes[ $size ] );
			}
		}
		// return sizes
		return $sizes;
	}
}


/**
 * Icon video play
 * ========================================================= */
if ( ! function_exists( 'woohoo_get_icon_video_play' ) )
{
	function woohoo_get_icon_video_play()
	{
		$bdaia_p_video  = get_post_meta( get_the_ID(),'post_video_bd', true );
		$protocol       = is_ssl() ? 'https' : 'http';

		$video_id = $video_type = $bdaia_video_url = $bdaia_post_url = '';

		if ( isset( $bdaia_p_video['video'] )       ) $video_id     = $bdaia_p_video['video'];
		if ( isset( $bdaia_p_video['video_type'] )  ) $video_type   = $bdaia_p_video['video_type'];

		if ( $video_type == "youtube"    ) $bdaia_video_url = $protocol.'://www.youtube.com/embed/'.$video_id.'?autoplay=0&amp;autohide=1&amp;fs=1&amp;rel=0&amp;hd=1&amp;wmode=opaque&amp;enablejsapi=1';
        elseif ( $video_type == "vimeo"  ) $bdaia_video_url = $protocol.'://player.vimeo.com/video/'.$video_id.'?autoplay=0';
        elseif ( $video_type == "daily"  ) $bdaia_video_url = $protocol.'://www.dailymotion.com/embed/video/'.$video_id;

		ob_start();
		if( $video_id )
		{
			?>
            <div class="vid-play">
                <a href="<?php the_permalink( get_the_ID() ); ?>">
                    <span class="bdaia-io bdaia-io-controller-play"></span>
                </a>
            </div>
			<?php
		}

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}