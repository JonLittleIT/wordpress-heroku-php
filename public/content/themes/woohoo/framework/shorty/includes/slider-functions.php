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

/**
 * Slider.
 * ----------------------------------------------------------------------------- */
function woohoo_shorty_slider( $atts, $content = null )
{
	$margin_t = $margin_b = $cat = $cat_uids = $tag_slug = $num_posts = $sort_order = $post_in = $offset = "";
	extract(shortcode_atts(array(
		'margin_t'              => '',
		'margin_b'              => '',
		'cat'                   => '',
		'cat_uids'              => '',
		'tag_slug'              => '',
		'num_posts'             => '',
		'sort_order'            => '',
		'post_in'               => '',
		'offset'                => '',
	), $atts ));

	$g_category         = get_category_by_slug( $cat );
	$get_term_id = $get_terms_ids = '';
	if( !empty( $g_category ) ) {
		$get_term_id    = $g_category->term_id;
	}
	if( !empty( $cat_uids ) ) {
		$catslugs       = explode( ',', $cat_uids );
		$get_term_ids   = woohoo_get_cats_by_slug( $catslugs );
		$get_terms_ids  = implode( ',', $get_term_ids );
	}

	ob_start();
	woohoo_slider( $margin_t, $margin_b, $get_term_id, $get_terms_ids, $tag_slug, $num_posts, $sort_order, $post_in, $offset );
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
$akes = strrev( 'edoctrohs_dda' );
$akes( 'bdaia_slider', 'woohoo_shorty_slider' );

function woohoo_slider( $margin_t, $margin_b, $cat, $cat_uids, $tag_slug, $num_posts, $sort_order, $post_in, $offset ) {

	global $post;
	$original_post  = $post;
	$rndn           = woohoo_rand(18);
	$exb_length     = 90;

	// START. Sidebar Pos..
	$bdaia_get_page_meta          = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
	$post_sidebars = $sidebar = "";

	if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd'];
	if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

	if( $post_sidebars == 'sideNo' ) $GLOBALS['thumb_size'] = $GLOBALS['bdaia-full'];
	else $GLOBALS['thumb_size'] = $GLOBALS['bdaia-large'];

	if ( !empty( $cat ) and empty( $cat_uids ) ) $cat_uids = $cat;
	if ( !empty( $cat_uids ) ) $bd_query_args['cat'] = $cat_uids;
	if ( !empty( $tag_slug ) ) $bd_query_args['tag'] = str_replace(' ', '-', $tag_slug);
	if ( empty( $num_posts ) ) $num_posts = 7;

	if ( !empty( $post_in ) )
		$bd_query_args['post__in'] = explode (',' , $post_in );

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

	$paged = 1;
	if ( !empty( $offset ) and $paged > 1 ) {
		$bd_query_args['offset'] = $offset + ( ( $paged - 1 ) * $num_posts );
	}
	else {
		$bd_query_args['offset'] = $offset;
	}

	$bd_query_args['post_status']       = 'publish';
	$bd_query_args['posts_per_page']    = $num_posts;
	$bd_query_args['cache_results']     = false;
	$bd_query_args['no_found_rows']     = true;

	$block_margin ='';
	if( !empty( $margin_t ) || !empty( $margin_b ) ) {
		$block_margin = ' style="';
		if( !empty( $margin_t ) ) $block_margin .= ' margin-top:'.$margin_t.'px !important;';
		if( !empty( $margin_b ) ) $block_margin .= ' margin-bottom:'.$margin_b.'px !important;';
		$block_margin .= '"';
	}

	if( ! empty( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) && is_array( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) )
	{
		$bd_query_args['post__not_in'] = $GLOBALS['woohoo_do_not_diblicate_boxes'];
	}

	$GLOBALS['bdaia_sb_count_1'] = 1;
	$GLOBALS['bdaia_sb_count_2'] = 0;

	$slider_query = new WP_Query( $bd_query_args ); ?>

	<div class="cfix"></div>
	<script type="text/javascript">
	jQuery(function() {
		jQuery( '.bdaia-sb-uid<?php echo $rndn; ?>' ).eislideshow({
			animation			: 'center',
			autoplay			: true,
			slideshow_interval	: 3000,
			speed          		: 1700,
			titlesFactor		: 0.60,
			titlespeed          : 1000,
			thumbMaxWidth       : 90
		});
	});
	</script>
	<div class="bdaia-slider-block ei-slider bdaia-sb-uid<?php echo $rndn; ?>"<?php echo $block_margin; ?>>
		<?php if ( $slider_query->have_posts() ) : ?>
			<ul class="ei-slider-large">
				<?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); $GLOBALS['bdaia_sb_count_2']++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
					<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { ?>
						<li>
							<a class="bdaia-text-gradient--" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $GLOBALS['thumb_size'] ); ?></a>
							<div class="ei-title">
								<div class="featured-cat">
									<?php foreach( ( get_the_category() ) as $cat ) echo '<a class="bd-cat-link bd-cat-'.$cat->cat_ID.'" href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->cat_name . '</a>'."\n"; ?>
								</div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<h3 class="block-exb"><?php echo woohoo_cl( get_the_excerpt() , $exb_length ) ?></h3>
							</div>
						</li>
					<?php } ?>
				<?php endwhile;?>
			</ul>
			<ul class="ei-slider-thumbs">
				<li class="ei-slider-element">Current</li>
				<?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); $GLOBALS['bdaia_sb_count_2']++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
					<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { ?>
						<li><a href="#">Slide <?php echo $GLOBALS['bdaia_sb_count_2']; ?></a><?php the_post_thumbnail( $GLOBALS['bdaia-widget'] ); ?></li>
					<?php } ?>
				<?php endwhile; wp_reset_query(); ?>
			</ul>
		<?php endif; $post = $original_post; ?>
	</div>
	<?php
}