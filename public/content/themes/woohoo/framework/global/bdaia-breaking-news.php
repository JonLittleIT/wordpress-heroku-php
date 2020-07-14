<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

if( woohoo_get_option( 'bdaia_head_bn' ) && ( ! woohoo_get_option( 'bdaia_head_bn_home' ) || ( woohoo_get_option( 'bdaia_head_bn_home' ) && is_home() ) || is_front_page()  ) ) {

	global $post;

	$bdaia_head_bn_home       = woohoo_get_option( 'bdaia_head_bn_home' );
	$bdaia_head_bn_nop        = woohoo_get_option( 'bdaia_head_bn_nop' );
	$bdaia_head_bn_title      = woohoo_get_option( 'bdaia_head_bn_title' );
	$bdaia_head_bn_so         = woohoo_get_option( 'bdaia_head_bn_so' );
	$bdaia_head_bn_cat        = woohoo_get_option( 'bdaia_head_bn_cat' );
	$bdaia_head_bn_cat_uids   = woohoo_get_option( 'bdaia_head_bn_cat_uids' );
	$bdaia_head_bn_tag_slug   = woohoo_get_option( 'bdaia_head_bn_tag_slug' );
	$bdaia_head_bn_mposts     = woohoo_get_option( 'bdaia_head_bn_mposts' );

	$g_category         = get_category_by_slug( $bdaia_head_bn_cat );
	$get_term_bn_id = $get_terms_bn_ids = '';
	if( !empty( $g_category ) ) {
		$get_term_bn_id    = $g_category->term_id;
	}
	if( !empty( $bdaia_head_bn_cat_uids ) ) {
		$catslugs           = explode( ',', $bdaia_head_bn_cat_uids );
		$get_term_bn_ids    = woohoo_get_cats_by_slug( $catslugs );
		$get_terms_bn_ids   = implode( ',', $get_term_bn_ids );
	}

	if ( !empty( $get_term_bn_id ) and empty( $get_terms_bn_ids ) ) $get_terms_bn_ids = $get_term_bn_id;
	if ( !empty( $get_terms_bn_ids ) ) $breaking_q_args['cat'] = $get_terms_bn_ids;

	if ( !empty( $bdaia_head_bn_tag_slug ) ) $breaking_q_args['tag'] = str_replace(' ', '-', $bdaia_head_bn_tag_slug);
	if ( empty( $bdaia_head_bn_nop ) ) $bdaia_head_bn_nop = 10;
	if ( !empty( $bdaia_head_bn_mposts ) ) $breaking_q_args['post__in'] = explode (',' , $bdaia_head_bn_mposts );

switch ( $bdaia_head_bn_so )
{
	case 'popular':
		$breaking_q_args['meta_key']      = 'bdaia_views';
		$breaking_q_args['orderby']       = 'meta_value_num';
		$breaking_q_args['order']         = 'DESC';
		break;

	case 'review_high':
		$breaking_q_args['meta_key']      = 'bdaia_taqyeem_final_score';
		$breaking_q_args['orderby']       = 'meta_value';
		$breaking_q_args['order']         = 'DESC';
		$breaking_q_args['meta_value']    = 0;
		$breaking_q_args['meta_compare']  = '!=';
		break;

	case 'random_posts':
		$breaking_q_args['orderby']       = 'rand';
		break;

	case 'alphabetical_order':
		$breaking_q_args['orderby']       = 'title';
		$breaking_q_args['order']         = 'ASC';
		break;

	case 'comment_count':
		$breaking_q_args['orderby']       = 'comment_count';
		$breaking_q_args['order']         = 'DESC';
		break;

	case 'random_today':
		$breaking_q_args['orderby']       = 'rand';
		$breaking_q_args['year']          = date('Y');
		$breaking_q_args['monthnum']      = date('n');
		$breaking_q_args['day']           = date('j');
		break;

	case 'random_7_day':
		$breaking_q_args['orderby']       = 'rand';
		$breaking_q_args['date_query']    = array(
			'column' => 'post_date_gmt',
			'after' => '1 week ago'
		);
		break;
}

$breaking_q_args['post_status']       = 'publish';
$breaking_q_args['posts_per_page']    = $bdaia_head_bn_nop;
$breaking_q_args['cache_results']     = false;
$breaking_q_args['no_found_rows']     = true;

$bdaia_head_bn_title_bg = "";
if( woohoo_get_option( 'bdaia_head_bn_title_bg' ) ) $bdaia_head_bn_title_bg = ' style="background: '.woohoo_get_option( 'bdaia_head_bn_title_bg' ).' !important;"';


$breaking_query = new WP_Query( $breaking_q_args ); ?>

<div id="bdaia-breaking-news" class="breaking-news-items">
	<div class="bd-container">
		<div class="breaking-news-items-inner">
			<?php if( $bdaia_head_bn_title ) { ?> <span class="breaking-title"<?php echo $bdaia_head_bn_title_bg; ?>><span class="bdaia-io bdaia-io-newspaper"></span><span class="txt"><?php echo do_shortcode( stripslashes ( $bdaia_head_bn_title ) ); ?></span></span><?php } ?>
			<div class="breaking-cont">
				<ul class="webticker">
					<?php
					// Breaking news.
					if ( is_rtl() ) $breakin_io = " bdaia-io-chevron_left";
					else $breakin_io = " bdaia-io-chevron_right";

					if ( $breaking_query->have_posts() ) : while ( $breaking_query->have_posts() ) : $breaking_query->the_post(); ?>
						<li>
							<h4>
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<span style="display: none" class="bdaia-io<?php echo $breakin_io;?>"></span>
									<?php
									// Title.
									$tit = get_the_title( '', '', false );
									//echo mb_substr( $tit, 0, 40, 'UTF-8' ), '...';
									the_title(); ?>
								</a>
							</h4>
						</li>
						<?php
					endwhile; wp_reset_query(); endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php } ?>