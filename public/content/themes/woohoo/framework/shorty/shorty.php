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

require_once ( get_template_directory().'/framework/shorty/includes/block1-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block2-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block3-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block4-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block5-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block6-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block7-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block8-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block9-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/block10-functions.php'  );
require_once ( get_template_directory().'/framework/shorty/includes/block11-functions.php'  );
require_once ( get_template_directory().'/framework/shorty/includes/block13-functions.php'  );
require_once ( get_template_directory().'/framework/shorty/includes/block23-functions.php'  );
require_once ( get_template_directory().'/framework/shorty/includes/block24-functions.php'  );
require_once ( get_template_directory().'/framework/shorty/includes/blog-functions.php'     );
require_once ( get_template_directory().'/framework/shorty/includes/slider-functions.php'   );
require_once ( get_template_directory().'/framework/shorty/includes/timeline-functions.php'   );

/**
 * Boxes.
 * ----------------------------------------------------------------------------- */
function woohoo_blocks_wpquery( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $offset, $paged )
{
	$bd_query_args = array(
		'ignore_sticky_posts'	 => true
	);

	if (!empty( $cat_uid ) and empty( $cat_uids ) ) {
		$cat_uids = $cat_uid;
	}

	if ( !empty( $cat_uids ) ) {
		$bd_query_args['cat'] = $cat_uids;
	}

	if ( !empty( $tag_slug ) ) {
		$bd_query_args['tag'] = str_replace(' ', '-', $tag_slug);
	}

	$bd_query_args['post_status']= 'publish';

	switch ( $sort_order )
	{
		case 'popular':
			$bd_query_args['meta_key']      = 'bdaia_views';
			$bd_query_args['orderby']       = 'meta_value_num';
			$bd_query_args['order']         = 'DESC';
			break;

		case 'review_high':
			$bd_query_args['meta_key']      = 'bdaia_taqyeem_final_score';
			$bd_query_args['orderby']       = 'meta_value';
			$bd_query_args['order']         = 'DESC';
			$bd_query_args['meta_value']    = 0;
			$bd_query_args['meta_compare']  = '!=';
			break;

		case 'random_posts':
			$bd_query_args['orderby']       = 'rand';
			break;

		case 'alphabetical_order':
			$bd_query_args['orderby']       = 'title';
			$bd_query_args['order']         = 'ASC';
			break;

		case 'comment_count':
			$bd_query_args['orderby']       = 'comment_count';
			$bd_query_args['order']         = 'DESC';
			break;

		case 'random_today':
			$bd_query_args['orderby']       = 'rand';
			$bd_query_args['year']          = date('Y');
			$bd_query_args['monthnum']      = date('n');
			$bd_query_args['day']           = date('j');
			break;

		case 'random_7_day':
			$bd_query_args['orderby']       = 'rand';
			$bd_query_args['date_query']    = array(
				'column' => 'post_date_gmt',
				'after' => '1 week ago'
			);
			break;
	}

	if ( empty( $num_posts ) ) $num_posts = get_option('posts_per_page');

	$bd_query_args['posts_per_page'] = $num_posts;

	if ( !empty( $paged ) ) {
		$bd_query_args['paged'] = $paged;
	}
	else {
		$bd_query_args['paged'] = 1;
	}

	if ( !empty( $offset ) and $paged > 1 ) {
		$bd_query_args['offset'] = $offset + ( ( $paged - 1 ) * $num_posts );
	}
	else {
		$bd_query_args['offset'] = $offset;
	}

	if( ! empty( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) && is_array( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) )
	{
		$bd_query_args['post__not_in'] = $GLOBALS['woohoo_do_not_diblicate_boxes'];
	}

	$GLOBALS['bd_bc1'] = 1;
	$GLOBALS['bd_bc2'] = 0;

	$cat_query = new WP_Query( $bd_query_args );
	return($cat_query);
}

add_action( 'init', 'woohoo_blocks_ajax_init' );
function woohoo_blocks_ajax_init()
{

	wp_localize_script( 'jquery', 'bd_blocks', array(
			'bdaia_ajax_url'    => admin_url( 'admin-ajax.php' ),
			'bdaia_ajaxnonce'   => wp_create_nonce( 'ajax-nonce' ),
		)
	);

	add_action( "wp_ajax_bdaia_blocks", "woohoo_blocks_ajax" );
	add_action( "wp_ajax_nopriv_bdaia_blocks", "woohoo_blocks_ajax" );
}

function woohoo_blocks_ajax()
{
	global $post;
	$paged      = 1;
	$block_nu   = $nonce = $sort_order = $num_posts = $tag_slug = $cat_uid = $cat_uids = $offset = "";

	if ( isset ( $_POST['nonce'] ) ) $nonce = $_POST['nonce'];
	if ( isset ( $_POST['block_nu'] ) ) $block_nu = $_POST['block_nu'];
	if ( isset ( $_POST['sort_order'] ) ) $sort_order = $_POST['sort_order'];
	if ( isset ( $_POST['num_posts'] ) ) $num_posts = $_POST['num_posts'];
	if ( isset ( $_POST['tag_slug'] ) ) $tag_slug = $_POST['tag_slug'];
	if ( isset ( $_POST['cat_uid'] ) ) $cat_uid = $_POST['cat_uid'];
	if ( isset ( $_POST['cat_uids'] ) ) $cat_uids = $_POST['cat_uids'];
	if ( isset ( $_POST['paged'] ) ) $paged = $_POST['paged'];
	if ( isset ( $_POST['offset'] ) ) $offset = $_POST['offset'];

	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
		die ( 'Nope!' );

	$cat_query = woohoo_blocks_wpquery( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $offset, $paged );

	if ( $block_nu == 'b1' ) {
		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/loop1' );
			endwhile;
			wp_reset_postdata();
		endif;
	}

	elseif ( $block_nu == 'b2' )
	{
		$bdaia_get_page_meta          = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
		$post_sidebars = $sidebar = "";
		if( is_page() ) {
			if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd'];
		}
		if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

		if( $post_sidebars == 'sideNo' ) $GLOBALS['thumb_loop2_size'] = $GLOBALS['bdaia-full'];
		else $GLOBALS['thumb_loop2_size'] = $GLOBALS['bdaia-large'];

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/loop2' );
			endwhile;
			wp_reset_postdata();
		endif;
	}

	elseif ( $block_nu == 'b3' )
	{

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();

				if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
				get_template_part( 'framework/blocks/loop/loop3' );
				if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
			endwhile;
			wp_reset_postdata();
		endif;

		if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>";
	}
	elseif ( $block_nu == 'b4' ) {

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
				get_template_part( 'framework/blocks/loop/loop4' );
				if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
			endwhile;
			wp_reset_postdata();
		endif;

		if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>";
	}
	elseif ( $block_nu == 'b5' ) {

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				if( $GLOBALS['bd_bc1'] % 3 == 1 ) echo '<div class="bd-block-row">';
				get_template_part( 'framework/blocks/loop/loop5' );
				if( $GLOBALS['bd_bc1'] % 3 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
			endwhile;
			wp_reset_postdata();
		endif;

		if ( $GLOBALS['bd_bc1'] % 3 != 1 ) echo "</div>";
	}
	elseif ( $block_nu == 'b6' ) {
		$post_sidebars = $sidebar = "";
		$bdaia_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
		if( is_page() ) { if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd']; }
		if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

		$GLOBALS['thumb_loop6_size'];

		if( $post_sidebars == 'sideNo' ) $GLOBALS['thumb_loop6_size'] = $GLOBALS['bdaia-full'];
		else $GLOBALS['thumb_loop6_size'] = $GLOBALS['bdaia-large'];

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/loop6' );
			endwhile;
			wp_reset_postdata();
		endif;
	}
	elseif ( $block_nu == 'b7' ) {

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
				get_template_part( 'framework/blocks/loop/loop7' );
				if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
			endwhile;
			wp_reset_postdata();
		endif;

		if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>";
	}
	elseif ( $block_nu == 'b8' ) {

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/loop8' );
				endwhile;
			wp_reset_postdata();
		endif;

		if ( $GLOBALS['bd_bc1'] % 999 != 1 ) echo "</div>";
	}
	elseif ( $block_nu == 'b9' ) {

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/loop9' );
			endwhile;
			wp_reset_postdata();
		endif;

		if ( $GLOBALS['bd_bc1'] % 999 != 1 ) echo "</div>";
	}
	elseif ( $block_nu == 'b10' ) {

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/loop10' );
			endwhile;
			wp_reset_postdata();
		endif;

		if ( $GLOBALS['bd_bc1'] % 999 != 1 ) echo "</div>";
	}
	elseif ( $block_nu == 'b11' ) {

		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/loop11' );
			endwhile;
			wp_reset_postdata();
		endif;

		if ( $GLOBALS['bd_bc1'] % 999 != 1 ) echo "</div>";
	}
	elseif ( $block_nu == 'b12' )
	{
		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/timeline' );
			endwhile;
			wp_reset_postdata();
		endif;
	}
	elseif ( $block_nu == 'b13' )
	{
		if ( $cat_query->have_posts() ) :
			while ( $cat_query->have_posts() ) : $cat_query->the_post();
				get_template_part( 'framework/blocks/loop/loop13' );
			endwhile;
			wp_reset_postdata();
		endif;
	}

	die();
}