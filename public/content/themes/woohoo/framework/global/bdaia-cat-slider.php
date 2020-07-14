<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

global $post;
$original_post      = $post;
$exb_length         = 90;
$fp_rand            = woohoo_rand(6);
$category_id        = get_query_var('cat') ;
$bdaia_cat_options  = get_option( "bd_cat_$category_id" );

$num_posts = $onof = $display = $sort_order = $offset = $speed = $time = "";
if( !empty( $bdaia_cat_options['bdaia_fp_num_posts'] ) ) $num_posts = $bdaia_cat_options['bdaia_fp_num_posts'];
if( !empty( $bdaia_cat_options['bdaia_fp_offset'] ) ) $offset = $bdaia_cat_options['bdaia_fp_offset'];
if( !empty( $bdaia_cat_options['bdaia_fp_speed'] ) ) $speed = $bdaia_cat_options['bdaia_fp_speed'];
if( !empty( $bdaia_cat_options['bdaia_fp_time'] ) ) $time = $bdaia_cat_options['bdaia_fp_time'];
if( !empty( $bdaia_cat_options['bdaia_fp_onof'] ) ) $onof = $bdaia_cat_options['bdaia_fp_onof'];
if( !empty( $bdaia_cat_options['bdaia_fp_style'] ) ) $display = $bdaia_cat_options['bdaia_fp_style'];
if( !empty( $bdaia_cat_options['bdaia_fp_sort_order'] ) ) $sort_order = $bdaia_cat_options['bdaia_fp_sort_order'];

if( !$speed || $speed == ' ' || !is_numeric( $speed ) ) $speed = 7000;
if( !$time  || $time  == ' ' || !is_numeric( $time ) ) $time  = 600;

$fp_query_args['cat'] = $category_id;

$post_sidebars = $sidebar = "";
if ( isset( $bdaia_cat_options['sidebar_po'] ) ) $post_sidebars = $bdaia_cat_options['sidebar_po'];
if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

if ( $post_sidebars == 'sideNo' ) $thumb_size = $GLOBALS['bdaia-full'];
else $thumb_size = $GLOBALS['bdaia-large'];

$bdaia_fp_display = "";
if( !empty( $display ) )
	$bdaia_fp_display = $display;

switch ( $sort_order )
{
	case 'popular':
		$fp_query_args['meta_key']      = 'bdaia_views';
		$fp_query_args['orderby']       = 'meta_value_num';
		$fp_query_args['order']         = 'DESC';
		break;

	case 'review_high':
		$fp_query_args['meta_key']      = 'bdaia_taqyeem_final_score';
		$fp_query_args['orderby']       = 'meta_value';
		$fp_query_args['order']         = 'DESC';
		$fp_query_args['meta_value']    = 0;
		$fp_query_args['meta_compare']  = '!=';
		break;

	case 'random_posts':
		$fp_query_args['orderby']       = 'rand';
		break;

	case 'comment_count':
		$fp_query_args['orderby']       = 'comment_count';
		$fp_query_args['order']         = 'DESC';
		break;

	case 'random_today':
		$fp_query_args['orderby']       = 'rand';
		$fp_query_args['year']          = date('Y');
		$fp_query_args['monthnum']      = date('n');
		$fp_query_args['day']           = date('j');
		break;

	case 'random_7_day':
		$fp_query_args['orderby']       = 'rand';
		$fp_query_args['date_query']    = array(
			'column' => 'post_date_gmt',
			'after' => '1 week ago'
		);
		break;
}

$fp_query_args[ 'post_status' ]       = 'publish';
$fp_query_args[ 'cache_results' ]     = false;
$fp_query_args[ 'no_found_rows' ]     = true;

if ( empty( $num_posts ) ) $num_posts = 3;
$fp_query_args['posts_per_page'] = $num_posts;

if ( !empty( $offset ) ) $fp_query_args['offset'] = $offset;

if( ! empty( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) && is_array( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) )
{
	$fp_query_args['post__not_in'] = $GLOBALS['woohoo_do_not_diblicate_boxes'];
}

$bdaia_fp_c1 = 1;
$bdaia_fp_c2 = $bdaia_fp_c3 = 0;

$bdaia_fp_query = new WP_Query( $fp_query_args ); ?>

<?php if( $onof == true ) { ?>

	<?php if ( $bdaia_fp_display == "eislider" ) { ?>
		<div class="cfix"></div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery( '.bdaia-sb-uid<?php echo $fp_rand; ?>' ).eislideshow({
					animation			: 'center',
					autoplay			: true,
					slideshow_interval	: <?php echo $speed; ?>,
					speed          		: <?php echo $time; ?>,
					titlesFactor		: 0.60,
					titlespeed          : 1000,
					thumbMaxWidth       : 90
				});
			});
		</script>

		<div class="bdaia-slider-block ei-slider bdaia-sb-uid<?php echo $fp_rand; ?>">

			<?php if ( $bdaia_fp_query->have_posts() ) : ?>
				<ul class="ei-slider-large">
					<?php while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); $bdaia_fp_c2++; if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() ); ?>
						<li>
							<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
								<a class="bdaia-text-gradient--" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
							<?php endif; ?>

							<div class="ei-title">
								<div class="featured-cat">
									<?php
									// Get category ------------ ^_^
									echo woohoo_custom_primary_category(); ?>
								</div>
								<h2>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<h3 class="block-exb"><?php echo woohoo_cl( get_the_excerpt() , $exb_length ) ?></h3>
							</div>
						</li>
					<?php endwhile;?>
				</ul>

				<ul class="ei-slider-thumbs">
					<li class="ei-slider-element">Current</li>
					<?php while ( $bdaia_fp_query->have_posts() ) : $bdaia_fp_query->the_post(); $bdaia_fp_c2++; ?>
						<li><a href="#">Slide <?php echo $bdaia_fp_c2; ?></a><?php the_post_thumbnail( 'bd-related-small' ); ?></li>
					<?php endwhile; wp_reset_query();?>
				</ul>

			<?php endif; ?>

		</div>
	<?php } ?>

<?php } ?>
<?php $post = $original_post; ?>
