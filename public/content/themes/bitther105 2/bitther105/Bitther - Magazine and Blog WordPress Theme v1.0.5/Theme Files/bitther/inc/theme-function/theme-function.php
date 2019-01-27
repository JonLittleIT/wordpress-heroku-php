<?php
/**
 * @package     bitther
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

/* Keep Menu =========================================================================================================*/
if(!function_exists('bitther_keep_menu')){
    function bitther_keep_menu() {
        $configMenu = get_theme_mod('bitther_keep_menu',false);
        if(isset($configMenu) & $configMenu == '1'){
            $configMenu='header-fixed';
        }
        return $configMenu;
    }
}
if(!function_exists('bitther_header_style')){
    function bitther_header_style() {
        global  $post,$wp_query;
        $configStyle = get_theme_mod('bitther_header_style','style_black');
        if(is_page()){
            $configStyle=get_post_meta($post->ID, 'style_header','style_black');
            if(isset($configStyle) && $configStyle == ''){
                $configStyle = get_theme_mod('bitther_header_style','style_black');
            }
        }
        return $configStyle;
    }

}

if(!function_exists('bitther_meta_class')){
    function bitther_meta_class() {
        $classes[]='';
        $author 	= get_theme_mod('bitther_cat_meta_author',true);
        if(empty($author)){ $classes[].='hidden-author';}

        $date 		= get_theme_mod('bitther_cat_meta_date',true);
        if(empty($date)){ $classes[].='hidden-date'; }

        $views 		= get_theme_mod('bitther_cat_meta_view',false);
        if(empty($views)){ $classes[].='hidden-view';}

        $comments 	= get_theme_mod('bitther_cat_meta_comment',false);
        if(empty($comments)){  $classes[].='hidden-comments';}

        echo esc_attr(implode(" ",$classes));
    }
}


/* Customize font Google  =========================================================================================== */
if(!function_exists('bitther_googlefont')){
    function bitther_googlefont(){
        global $wp_filesystem;
        $filepath = get_template_directory().'/assets/googlefont/googlefont.json';
        if( empty( $wp_filesystem ) ) {
            require_once( ABSPATH .'/wp-admin/includes/file.php' );
            WP_Filesystem();
        }
        if( $wp_filesystem ) {
            $listGoogleFont=$wp_filesystem->get_contents($filepath);
        }
        if($listGoogleFont){
            $gfont = json_decode($listGoogleFont);
            $fontarray = $gfont->items;
            $options = array();
            foreach($fontarray as $font){
                $options[$font->family] = $font->family;
            }
            return $options;
        }
        return false;
    }
}

/* Customize font Google  =========================================================================================== */
function bitther_get_categories_select() {
    $teh_cats = get_categories();
    $results=array();
    $count = count($teh_cats);
    for ($i=0; $i < $count; $i++) {
        if (isset($teh_cats[$i]))
            $results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
        else
            $count++;
    }
    return $results;
}

/* Post Thumbnail =================================================================================================== */
if ( ! function_exists( 'bitther_post_thumbnail' ) ) :
    function bitther_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
            </a>

        <?php endif; // End is_singular()
    }
endif;

/* Excerpt more  ==================================================================================================== */
function bitther_new_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'bitther_new_excerpt_more');

if(!function_exists('bitther_string_limit_words')){
    function bitther_string_limit_words($string, $word_limit)
    {
        $words = explode(' ', $string, ($word_limit + 1));

        if(count($words) > $word_limit) {
            array_pop($words);
        }

        return implode(' ', $words);
    }
}

function bitther_excerpt( $class = 'entry-excerpt' ) {
    if ( has_excerpt() || is_search() ) : ?>
        <div class="<?php echo esc_attr( $class ); ?>">
            <?php the_excerpt(); ?>
        </div><!-- .<?php echo esc_attr( $class ); ?> -->
    <?php endif;
}

/* Sub String Content =============================================================================================== */
if(!function_exists('bitther_content')) {
    function bitther_content($limit) {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
        return $excerpt;
    }
}

function  bitther_excerpt_content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }
    $content = preg_replace('/[+]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function bitther_closetags($html) {

    #put all opened tags into an array
    $content = $result;
    preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];   #put all closed tags into an array
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    # all tags are closed
    if (count($closedtags) == $len_opened) {
        return $html;
    }

    $openedtags = array_reverse($openedtags);
    # close tags
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)){
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);    }
    }
    return $html;
}

/* Get Category  ==================================================================================================== */
if(!function_exists('bitther_category')) {
    function  bitther_category($separator)
    {
        $first_time = 1;
        foreach ((get_the_category()) as $category) {
            $color = get_term_meta( $category->term_id, '_category_color', true );
            $style_css='';
            if($color){
                $background ="background:#$color";
                $style_css  ='style  = '.$background.'';
            }
            if ($first_time == 1) {?>
                <a href="<?php echo esc_url(get_category_link($category->term_id));?>" <?php echo esc_attr($style_css);?>  title="<?php  sprintf(esc_attr('View all posts in %s'), $category->name); ?>" ><?php echo esc_attr($category->name);?></a>
                <?php $first_time = 0; ?>
            <?php } else {
                echo esc_attr($separator) ?>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" <?php echo esc_attr($style_css);?> title="<?php  sprintf(esc_attr('View all posts in %s'), $category->name) ?>" ><?php  echo esc_attr($category->name); ?></a>
            <?php }
        }
    }
}

/* Add login outlink ================================================================================================ */
//add_filter( 'wp_nav_menu_items', 'bitther_loginout_link', 10, 2 );
function bitther_loginout_link($output='',$args) {

    if (!is_user_logged_in() && $args->theme_location == 'top_navigation') {
        $output .='<li><a href="'.get_permalink(get_option('woocommerce_myaccount_page_id')).'">';
        $output .='<span>'.esc_html__(' Login', 'bitther').'</span>';
        $output .='</a></li>';
    }
    elseif (is_user_logged_in() && $args->theme_location == 'top_navigation')
    {
        $output .='<li><a href="'.wp_logout_url(get_permalink(get_option('woocommerce_myaccount_page_id'))).'">';
        $output .='<span>'.esc_html__(' Logout', 'bitther').'</span>';
        $output .='</a></li>';
    }
    return $output;

}

/* Config Sidebar Blog ============================================================================================== */
add_action( 'single-sidebar-left', 'bitther_single_sidebar_left' );
function bitther_single_sidebar_left($single_sidebar) {
	if(empty($single_sidebar)){
		$single_sidebar = get_theme_mod( 'bitther_sidebar_single', 'right' );
	}
    if(isset($_GET['layout'])){
        $single_sidebar=$_GET['layout'];
    }
    if ( is_active_sidebar( 'single' ) && $single_sidebar && $single_sidebar == 'left') { ?>
        <div id="archive-sidebarsss" class="sidebar sidebar-left col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar single-sidebar">
            <?php dynamic_sidebar('single');?>
        </div>
    <?php }
}
add_action( 'single-sidebar-right', 'bitther_single_sidebar_right' );
function bitther_single_sidebar_right($single_sidebar) {
	if(empty($single_sidebar)){
		$single_sidebar=get_theme_mod( 'bitther_sidebar_single', 'right' );
	}
    if(isset($_GET['layout'])){
        $single_sidebar=$_GET['layout'];
    }
    if ( is_active_sidebar( 'single') && $single_sidebar && $single_sidebar == 'right') {?>
        <div id="archive-sidebar" class="sidebar sidebar-right col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar single-sidebar">
            <?php dynamic_sidebar('single');?>
        </div>
    <?php }
}
//content
add_action( 'single-content-before', 'bitther_single_content_before' );
function bitther_single_content_before($single_sidebar) {
	if(empty($single_sidebar)){
		$single_sidebar=get_theme_mod( 'bitther_sidebar_single', 'right' );
	}
    if(isset($_GET['layout'])){
        $single_sidebar=$_GET['layout'];
    }
    if ( ($single_sidebar && $single_sidebar == 'full') || empty(is_active_sidebar( 'single') )) {?>
        <div class="main-content col-sx-12 col-sm-12 col-md-12 col-lg-12 content-fulls">
    <?php }
    else{?>
        <div class=" content-padding-<?php echo esc_attr($single_sidebar) ?> main-content content-<?php echo esc_html($single_sidebar)?> col-sx-12 col-sm-12 col-md-9 col-lg-9">
    <?php }
}
add_action( 'single-content-after', 'bitther_single_content_after' );
function bitther_single_content_after($single_sidebar) {
	if(empty($single_sidebar)){
		$single_sidebar=get_theme_mod( 'bitther_sidebar_single', 'right' );
	}
    if ( $single_sidebar){?>
        </div>
    <?php }
}

/* Config Sidebar archive =========================================================================================== */
add_action( 'archive-sidebar-left', 'bitther_cat_sidebar_left' );
function bitther_cat_sidebar_left() {
    $cat_sidebar=get_theme_mod( 'bitther_sidebar_cat', 'right' );
    if(isset($_GET['layout'])){
        $cat_sidebar=$_GET['layout'];
    }
    if ( is_active_sidebar( 'blogs') && $cat_sidebar && $cat_sidebar == 'left') {?>
         <div id="archive-sidebar" class="sidebar sidebar-left col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar">
            <?php get_sidebar('sidebar'); ?>
        </div>
    <?php }
}
add_action( 'archive-sidebar-right', 'bitther_cat_sidebar_right' );
function bitther_cat_sidebar_right() {
    $cat_sidebar=get_theme_mod( 'bitther_sidebar_cat', 'right' );
    if(isset($_GET['layout'])){
        $cat_sidebar=$_GET['layout'];
    }
    if ( is_active_sidebar( 'blogs') && $cat_sidebar && $cat_sidebar == 'right') {?>
         <div id="archive-sidebar" class="sidebar sidebar-right  col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar">
            <?php get_sidebar('sidebar'); ?>
        </div>
    <?php }
}
//content
add_action( 'archive-content-before', 'bitther_cat_content_before' );
function bitther_cat_content_before() {
    $cat_sidebar=get_theme_mod( 'bitther_sidebar_cat', 'right' );
    if(isset($_GET['layout'])){
        $cat_sidebar=$_GET['layout'];
    }
    if ( ($cat_sidebar && $cat_sidebar == 'full') || empty(is_active_sidebar( 'blogs') )) {?>
        <div class="main-content col-md-12 col-lg-12">
    <?php }
    else{?>
        <div class="main-content content-<?php echo esc_html($cat_sidebar)?> col-sx-12 col-sm-12 col-md-9 col-lg-9">
    <?php }
}
add_action( 'archive-content-after', 'bitther_cat_content_after' );
function bitther_cat_content_after() {
    $cat_sidebar=get_theme_mod( 'bitther_sidebar_cat', 'right' );
    if ( $cat_sidebar){?>
        </div>
    <?php }
}


/* Comment Form ===================================================================================================== */
function bitther_comment_form($arg,$class='btn-variant',$id='submit'){
    ob_start();
    comment_form($arg);
    $form = ob_get_clean();
    echo str_replace('id="submit"','id="'.$id.'"', $form);
}

function bitther_list_comments($comment, $args, $depth){
    $path = get_template_directory() . '/templates/list_comments.php';
    if( is_file($path) ) require ($path);
}

/* Ajax Feature Post =================================================================================================*/
add_action('wp_ajax_feature_post', 'bitther_feature_post');
add_action('wp_ajax_nopriv_feature_post', 'bitther_feature_post');
function bitther_feature_post() {
    if (check_admin_referer( 'bitther-feature-post' ) ) {
        $post_id = absint( $_GET['post_id'] );
        if ( 'post' === get_post_type( $post_id ) ) {
            update_post_meta( $post_id, '_featured', get_post_meta( $post_id, '_featured', true ) === 'yes' ? 'no' : 'yes' );
            delete_transient( 'bitther_featured_post' );
        }
    }
    wp_safe_redirect( wp_get_referer() ? remove_query_arg( array( 'trashed', 'untrashed', 'deleted', 'ids' ), wp_get_referer() ) : admin_url( 'edit.php' ) );
    die();
    }

    // add featured thumbnail to admin post columns
    function bitther_add_thumbnail_columns( $columns ) {
        $columns['post_featured'] = esc_html__('Featured', 'bitther');
        return $columns;
    }
    function bitther_is_featured() {
        $featured =get_post_meta( get_the_ID(), '_featured', true );
        return $featured === 'yes' ? true : false;
    }
    function bitther_add_thumbnail_columns_data( $column_name, $post_id) {
        if ($column_name === 'post_featured') {
        $url = wp_nonce_url( admin_url( 'admin-ajax.php?action=feature_post&post_id=' . get_the_ID() ), 'bitther-feature-post' );
        echo '<a href="' . esc_url( $url ) . '" title="'. esc_attr('Toggle featured') . '">';
            if (bitther_is_featured()) {
            echo '<span class="bitther-featured tips" data-tip="' . esc_attr__( 'Yes', 'bitther' ) . '"><span class="dashicons dashicons-star-filled"></span> </span>';
            } else {
            echo '<span class="bitther-featured not-featured tips" data-tip="' . esc_attr__( 'No', 'bitther' ) . '"><span class="dashicons dashicons-star-empty"></span></span>';
            }
            echo '</a>';
        }
    }

    if ( function_exists( 'add_theme_support' ) ) {
    add_filter( 'manage_posts_columns' , 'bitther_add_thumbnail_columns' );
    add_action( 'manage_posts_custom_column' , 'bitther_add_thumbnail_columns_data', 10, 2 );
}

/* PostViews =========================================================================================================*/
function bitther_post_views($post_ID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($post_ID, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_ID, $count_key, $count);
    }
}

function bitther_track_post_views($post_id)
    {
        if (!is_single()) return;
        if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    bitther_post_views($post_id);
}
add_action('wp_head', 'bitther_track_post_views');

function bitther_get_PostViews($post_ID)
    {
        $count_key = 'post_views_count';
        $count = get_post_meta($post_ID, $count_key, true);
        return $count;
    }

function bitther_post_column_views($newcolumn)
    {
        $newcolumn['post_views'] = esc_html__('Views', 'bitther');
        return $newcolumn;
    }

function bitther_post_custom_column_views($column_name, $id)
    {
        if ($column_name === 'post_views') {
        echo esc_attr(bitther_get_PostViews(get_the_ID()));
    }
}

add_filter('manage_posts_columns', 'bitther_post_column_views');
add_action('manage_posts_custom_column', 'bitther_post_custom_column_views', 10, 2);


/* Move comment field to bottom ======================================================================================*/
function bitther_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'bitther_move_comment_field_to_bottom' );
?>
