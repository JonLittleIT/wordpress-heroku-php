<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

function woohoo_get_views( $postID = '' )
{
	if( empty( $postID ) ) {
		$postID = get_the_ID();
	}

	$count 		= 0;
	$count_key 	= 'bdaia_views';
	$count 		= get_post_meta( $postID, $count_key, true );
	$count 		= @number_format((float)$count);

	if( empty( $count ) )
	{
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, 0 );
		$count = 0;
	}
	return $count;
}

function woohoo_set_post_views()
{
	global $page;

	if( $page > 1  )
	{
		return false;
	}

	$count 		= 0;
	$postID 	= get_the_ID();
	$count_key 	= 'bdaia_views';
	$count 		= (int)get_post_meta( $postID, $count_key, true );

	if( !defined('WP_CACHE') || !WP_CACHE ){
		$count++;
		update_post_meta($postID, $count_key, (int)$count);
	}
}

function woohoo_postview_cache_count_enqueue()
{
	if ( is_single() && ( defined('WP_CACHE') && WP_CACHE ) )
	{
		wp_register_script( 'woohoo-views', get_template_directory_uri() . '/js/views.js', array( 'jquery' ) );
		wp_localize_script( 'woohoo-views', 'woohoo_views_c', array('admin_ajax_url' => admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ), 'post_id' => intval( get_the_ID() ) ) );
		wp_enqueue_script ( 'woohoo-views' );
	}
}
add_action('wp_enqueue_scripts', 'woohoo_postview_cache_count_enqueue');

function woohoo_increment_views()
{
	if( !empty( $_GET['postviews_id'] ) )
	{
		$post_id = intval( $_GET['postviews_id'] );

		if( $post_id > 0 && defined('WP_CACHE') && WP_CACHE )
		{
			$count 		= 0;
			$count_key 	= 'bdaia_views';
			$count 		= (int)get_post_meta($post_id, $count_key, true);
			$count++;
			update_post_meta($post_id, $count_key, (int)$count);
			echo $count;
		}
	}
	exit();
}
add_action( 'wp_ajax_postviews', 'woohoo_increment_views' );
add_action( 'wp_ajax_nopriv_postviews', 'woohoo_increment_views' );

function woohoo_posts_column_views( $defaults )
{
	$defaults['woohoo_post_views'] = 'Views';
	return $defaults;
}
add_filter('manage_posts_columns', 'woohoo_posts_column_views');

function woohoo_posts_custom_column_views( $column_name, $id )
{
	if( $column_name === 'woohoo_post_views' )
	{
		echo woohoo_get_views( get_the_ID() );
	}
}
add_action('manage_posts_custom_column', 'woohoo_posts_custom_column_views',5,2);