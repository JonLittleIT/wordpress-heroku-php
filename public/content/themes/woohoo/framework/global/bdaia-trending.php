<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// Trending
global $post;

$bdaia_t_nop        = woohoo_get_option( 'bdaia_t_nop' );
$bdaia_t_title      = woohoo_get_option( 'bdaia_t_title' );
$bdaia_t_so         = woohoo_get_option( 'bdaia_t_so' );
$bdaia_t_cat        = woohoo_get_option( 'bdaia_t_cat' );
$bdaia_t_cat_uids   = woohoo_get_option( 'bdaia_t_cat_uids' );
$bdaia_t_tag_slug   = woohoo_get_option( 'bdaia_t_tag_slug' );
$bdaia_t_mposts     = woohoo_get_option( 'bdaia_t_mposts' );
$bdaia_t_e_length   = woohoo_get_option( 'woohoo_trending_news_excerpt_length' );

$g_category         = get_category_by_slug( $bdaia_t_cat );
$get_term_tr_id = $get_terms_tr_ids = '';
if( !empty( $g_category ) ) {
	$get_term_tr_id    = $g_category->term_id;
}
if( !empty( $bdaia_t_cat_uids ) ) {
	$catslugs           = explode( ',', $bdaia_t_cat_uids );
	$get_term_tr_ids    = woohoo_get_cats_by_slug( $catslugs );
	$get_terms_tr_ids   = implode( ',', $get_term_tr_ids );
}

if ( !empty( $get_term_tr_id ) and empty( $get_terms_tr_ids ) ) $get_terms_tr_ids = $get_term_tr_id;
if ( !empty( $get_terms_tr_ids ) ) $trending_q_args['cat'] = $get_terms_tr_ids;

if ( !empty( $bdaia_t_tag_slug ) ) $trending_q_args['tag'] = str_replace(' ', '-', $bdaia_t_tag_slug);
if ( empty( $bdaia_t_nop ) ) $bdaia_t_nop = 5;

if ( !empty( $bdaia_t_mposts ) )
	$trending_q_args['post__in'] = explode (',' , $bdaia_t_mposts );

switch ( $bdaia_t_so )
{
	case 'popular':
		$trending_q_args['meta_key']      = 'bdaia_views';
		$trending_q_args['orderby']       = 'meta_value_num';
		$trending_q_args['order']         = 'DESC';
		break;

	case 'review_high':
		$trending_q_args['meta_key']      = 'bdaia_taqyeem_final_score';
		$trending_q_args['orderby']       = 'meta_value';
		$trending_q_args['order']         = 'DESC';
		$trending_q_args['meta_value']    = 0;
		$trending_q_args['meta_compare']  = '!=';
		break;

	case 'random_posts':
		$trending_q_args['orderby']       = 'rand';
		break;

	case 'alphabetical_order':
		$trending_q_args['orderby']       = 'title';
		$trending_q_args['order']         = 'ASC';
		break;

	case 'comment_count':
		$trending_q_args['orderby']       = 'comment_count';
		$trending_q_args['order']         = 'DESC';
		break;

	case 'random_today':
		$trending_q_args['orderby']       = 'rand';
		$trending_q_args['year']          = date('Y');
		$trending_q_args['monthnum']      = date('n');
		$trending_q_args['day']           = date('j');
		break;

	case 'random_7_day':
		$trending_q_args['orderby']       = 'rand';
		$trending_q_args['date_query']    = array(
			'column' => 'post_date_gmt',
			'after' => '1 week ago'
		);
		break;
}

$trending_q_args['post_status']       = 'publish';
$trending_q_args['posts_per_page']    = $bdaia_t_nop;
$trending_q_args['cache_results']     = false;
$trending_q_args['no_found_rows']     = true;
$trending_query = new WP_Query( $trending_q_args ); ?>

<div class="breaking-news-items">
	<?php if( $bdaia_t_title ) { ?> <span class="breaking-title"><?php echo do_shortcode( stripslashes ( $bdaia_t_title ) ); ?></span><?php } ?>
	<div class="breaking-cont">
		<ul class="webticker">
			<?php
			if ( is_rtl() ) $trending_io = " bdaia-io-chevron_left";
			else $trending_io = " bdaia-io-chevron_right";

			if ( $trending_query->have_posts() ) : while ( $trending_query->have_posts() ) : $trending_query->the_post(); ?>
				<li>
					<h4>
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<span style="display: none" class="bdaia-io<?php echo $trending_io;?>"></span>
							<?php
							$tit = get_the_title( '', '', false );

							if( $bdaia_t_e_length ){
								$te = $bdaia_t_e_length;
							}
							else {
								$te = 46;
							}

							echo '&nbsp;&nbsp;&nbsp;';
							echo mb_substr( $tit, 0, $te, 'UTF-8' ), '...'; ?>
						</a>
					</h4>
				</li>
				<?php
			endwhile; wp_reset_postdata(); endif; ?>
		</ul>
	</div>
</div>