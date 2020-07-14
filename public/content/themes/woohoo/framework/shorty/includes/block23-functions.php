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
 * Block23.
 * ----------------------------------------------------------------------------- */
function woohoo_shorty_block23( $atts, $content = null )
{
	$block_title = $title_url = $title_text_color = $title_bg_color = $margin_t = $margin_b = $cat = $cat_uids = $tag_slug = $tag_slug = $sort_order = "";

	extract(shortcode_atts(array(
		'block_title'       => '',
		'title_url'         => '',
		'title_text_color'  => '',
		'title_bg_color'    => '',
		'margin_t'          => '',
		'margin_b'          => '',
		'cat'               => '',
		'cat_uids'          => '',
		'tag_slug'          => '',
		'sort_order'        => '',
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
	woohoo_block23( 1, $block_title, $title_url, $title_text_color, $title_bg_color, $margin_t, $margin_b, $get_term_id, $get_terms_ids, $tag_slug , $sort_order );
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
$akes = strrev( 'edoctrohs_dda' );
$akes( 'bdaia_block23', 'woohoo_shorty_block23' );

function woohoo_block23( $paged, $block_title, $title_url, $title_text_color, $title_bg_color, $margin_t, $margin_b, $cat_uid, $cat_uids, $tag_slug, $sort_order )
{
	$rndn       = woohoo_rand(10);

	$cat_query  = woohoo_blocks_wpquery( $sort_order, 13, $tag_slug, $cat_uid, $cat_uids, 0, $paged );
	$mn_pages   = $cat_query->max_num_pages;

	$block_margin ='';
	if( !empty( $margin_t ) || !empty( $margin_b ) ) {
		$block_margin = ' style="';
		if( !empty( $margin_t ) ) $block_margin .= ' margin-top:'.$margin_t.'px !important;';
		if( !empty( $margin_b ) ) $block_margin .= ' margin-bottom:'.$margin_b.'px !important;';
		$block_margin .= '"';
	}

	$data_attr = array(
		'block_nu'          => 'b23',
		'block_id'          => 'bdaia-block-id-'.$rndn,
		'paged'             => $paged,
		'sort_order'        => $sort_order,
		'tag_slug'          => $tag_slug,
		'cat_uid'           => $cat_uid,
		'cat_uids'          => $cat_uids,
		'max_nu'            => $mn_pages,
		'total_posts_num'   => $cat_query->found_posts
	);

	$bdaia_att = $ajax_pagination_class = '';
	foreach( $data_attr as $k => $v ) {
		if( $v != '' ) $bdaia_att .= 'data-'.$k.'="'.$v.'" ';
		else $bdaia_att .= 'data-'.$k.'="" ';
	}
	?>
	<div class="cfix"></div>
	<div class="bdaia-block-wrap bdaia-block23 bdaia-block-id-<?php echo $rndn;?> bdaia-block-cat-id-<?php echo $cat_uid; ?> bdaia-ajax-pagination-<?php echo $ajax_pagination_class;?>" <?php echo $block_margin; ?> <?php echo $bdaia_att;?>>
		<?php
		if( $title_text_color || $title_bg_color ) echo '<style type="text/css">.bdaia-block-id-'.$rndn.' h4.block-title:before{background-color: '.$title_bg_color.' !important;}.bdaia-block-id-'.$rndn.' h4.block-title a, .bdaia-block-id-'.$rndn.' h4.block-title span{color:'.$title_text_color.' !important;} .bdaia-block-id-'.$rndn.' .bd-more-btn{background:'.$title_bg_color.' !important;border:0 none !important;} .bdaia-block-id-'.$rndn.' .bd-more-btn a{color:#FFF !important;}</style>';
		if( $block_title ) {
			echo '<h4 class="block-title">';
			if( $title_url ) echo '<a href="'. $title_url .'"><span>'. $block_title .'</span></a>';
			else echo '<span>'. $block_title .'</span>';
			echo '</h4>';
		}
		?>

		<div class="bdaia-row">
			<div class="bdaia-blocks bdaia-block23">
				<div class="bdaia-blocks-container">
					<?php
					$nio_c = 1;
					if ( $cat_query->have_posts() ) :
					echo '<div class="bd-block-row">';
					while ( $cat_query->have_posts() ) : $cat_query->the_post();
						if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
					if( $nio_c == 1 )
					{
						if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() ) {
							?>
							<div class="block-article bd-col-md-6 bdaiaFadeIn nip-psbig">
								<article <?php woohoo_post_class(); ?>>
									<div class="bwb-article-img-container">
										<?php woohoo_video_icon_play(); ?>
										<a title="<?php the_title(); ?>" class="ttip" href="<?php esc_url( the_permalink() ); ?>"><?php the_post_thumbnail( 'bdaia-block11' ); ?></a>
									</div>
									<div class="cfix"></div>
								</article>
							</div>
							<?php
						}
						echo'<div class="bd-col-md-6 bdaia-nip-inner nip-pssmall"><ul>';
					}
					else
					{
						if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() ) {
							?>
							<li>
								<div class="block-article bdaia-wba-nin bdaiaFadeIn">
									<article <?php woohoo_post_class(); ?>>
										<div class="bwb-article-img-container">
											<?php woohoo_video_icon_play(); ?>
											<a title="<?php the_title(); ?>" class="ttip" href="<?php esc_url( the_permalink() ); ?>"><?php the_post_thumbnail( 'bdaia-small' ); ?></a>
										</div>
										<div class="cfix"></div>
									</article>
								</div>
							</li>
							<?php
						}
					}
					$nio_c++; endwhile;
					echo '</ul></div></div>';
					wp_reset_postdata();
					endif;
					?>
				</div>
			</div><!-- END Block23. -->
		</div>
	</div>
	<!--/ END Block 23 /-->
	<?php
}