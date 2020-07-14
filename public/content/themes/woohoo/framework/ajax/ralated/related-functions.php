<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

function woohoo_related_articles( $paged, $tag_ids, $postID = false, $numpost )
{
	$bdaia_related_articles_cont = 0;
	$tags       = wp_get_post_tags(get_the_ID());
	$tags_ids   = array();

	foreach( $tags as $individual_tag ) {
		$tags_ids[] = $individual_tag->term_id;
	}

	if( empty( $postID ) ) {
		$postID = get_the_ID();
	}

	$custom_related_args =array('post__not_in' => array($postID),'posts_per_page'=> $numpost , 'tag__in'=> $tags_ids, 'paged' => $paged  );
	$custom_related_query = new wp_query( $custom_related_args );

    if ( $custom_related_query->have_posts() ) :
        while ( $custom_related_query->have_posts() ) : $custom_related_query->the_post();
	        get_template_part( 'framework/loop/latest' );
            $bdaia_related_articles_cont++;
        endwhile;
	    wp_reset_query();
    endif;

    if ( $bdaia_related_articles_cont<$numpost ) { ?><script type='text/javascript'>jQuery(document).ready(function(){ 'use strict'; jQuery('#content-more-ralated .bdayh-load-more-btn').remove(); }); </script><?php }
}

function woohoo_related_articles_fun() {

    $paged   = 1;
    $tag_ids = $numpost = "";
	$postID  = false;

    if ( isset ( $_POST['page_no'] ) ) $paged = $_POST['page_no'];
    if ( isset ( $_POST['tag_id'] ) ) $tag_ids = $_POST['tag_id'];
    if ( isset ( $_POST['post_id'] ) ) $postID = $_POST['post_id'];
    if ( isset ( $_POST['numpost'] ) ) $numpost = $_POST['numpost'];

    echo woohoo_related_articles( $paged, $tag_ids, $postID, $numpost );

    die();
}
add_action( "wp_ajax_woohoo_related_articles_fun", "woohoo_related_articles_fun" );
add_action( "wp_ajax_nopriv_woohoo_related_articles_fun", "woohoo_related_articles_fun" );

function woohoo_related_author( $paged, $user_id, $postID = false, $numpost )
{
    $bdaia_related_author_cont = 0;
	if( empty( $postID ) ) $postID = get_the_ID();

    $custom_related_author_args = array( 'post_type' => 'post', 'post_status' => 'publish', 'author' => $user_id, 'post__not_in' => array ( $postID ), 'posts_per_page' => $numpost, 'paged' => $paged );
    $custom_related_author_query    = new wp_query( $custom_related_author_args );

    if ( $custom_related_author_query->have_posts() ) :
        while ($custom_related_author_query->have_posts()) : $custom_related_author_query->the_post();
            get_template_part( 'framework/loop/latest' );
            $bdaia_related_author_cont++;
        endwhile;
	    wp_reset_query();
    endif;

	if ( $bdaia_related_author_cont<$numpost ) { ?><script type='text/javascript'>jQuery(document).ready(function(){ 'use strict'; jQuery('#content-more-author .bdayh-load-more-btn').remove(); }); </script><?php }
}

function woohoo_related_author_fun()
{
    $paged      = 1;
    $user_id    = $numpost ="";
	$postID     = false;

    if ( isset ($_POST['page_no'] ) ) $paged = $_POST['page_no'];
    if ( isset ($_POST['user_id'] ) ) $user_id = $_POST['user_id'];
	if ( isset ( $_POST['post_id'] ) ) $postID = $_POST['post_id'];
	if ( isset ( $_POST['numpost'] ) ) $numpost = $_POST['numpost'];

    echo woohoo_related_author( $paged, $user_id, $postID, $numpost );

    die();
}
add_action( "wp_ajax_woohoo_related_author_fun", "woohoo_related_author_fun" );
add_action( "wp_ajax_nopriv_woohoo_related_author_fun", "woohoo_related_author_fun" );

function woohoo_related_cat( $paged, $cat_id, $postID = false, $numpost )
{
    $bdaia_related_cat_cont = 0;
	if( empty( $postID ) ) $postID = get_the_ID();

    $custom_related_cat_args = array( 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $cat_id, 'post__not_in' => array ( $postID ), 'posts_per_page' => $numpost, 'paged' => $paged );
    $custom_related_cat_query  = new wp_query( $custom_related_cat_args );

    if ( $custom_related_cat_query->have_posts() ) :
        while ($custom_related_cat_query->have_posts()) : $custom_related_cat_query->the_post();
            get_template_part( 'framework/loop/latest' );
            $bdaia_related_cat_cont++;
        endwhile;
    endif;
	wp_reset_query();

    if ( $bdaia_related_cat_cont<$numpost ) { ?><script type='text/javascript'>jQuery(document).ready(function(){ 'use strict'; jQuery('#content-more-cat .bdayh-load-more-btn').remove(); }); </script><?php }
}

function woohoo_related_cat_fun()
{
    $paged      = 1;
    $cat_id     = $numpost = "";
	$postID     = false;

    if ( isset ($_POST['page_no'] ) ) $paged = $_POST['page_no'];
    if ( isset ($_POST['cat_id'] ) ) $cat_id = $_POST['cat_id'];
	if ( isset ( $_POST['post_id'] ) ) $postID = $_POST['post_id'];
	if ( isset ( $_POST['numpost'] ) ) $numpost = $_POST['numpost'];

    echo woohoo_related_cat( $paged, $cat_id, $postID, $numpost );

    die();
}
add_action( "wp_ajax_woohoo_related_cat_fun", "woohoo_related_cat_fun" );
add_action( "wp_ajax_nopriv_woohoo_related_cat_fun", "woohoo_related_cat_fun" );