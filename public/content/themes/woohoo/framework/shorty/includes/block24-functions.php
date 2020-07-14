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
 * Block24.
 * ----------------------------------------------------------------------------- */
function woohoo_shorty_block24( $atts, $content = null )
{
	$block_title = $title_url = $title_text_color = $title_bg_color = $margin_t = $margin_b = $cat = $cat_uids = $tag_slug = $tag_slug = $num_posts =  $offset = $sort_order = $ajax_pagination = "";
	$paged = 1;
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
		'num_posts'         => '',
		'offset'            => '',
		'sort_order'        => '',
		'ajax_pagination'   => '',
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
	woohoo_block24( $paged, $block_title, $title_url, $title_text_color, $title_bg_color, $margin_t, $margin_b, $get_term_id, $get_terms_ids, $tag_slug, $num_posts, $offset, $sort_order, $ajax_pagination );
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
$akes = strrev( 'edoctrohs_dda' );
$akes( 'bdaia_block24', 'woohoo_shorty_block24' );

function woohoo_block24( $paged, $block_title, $title_url, $title_text_color, $title_bg_color, $margin_t, $margin_b, $cat_uid, $cat_uids, $tag_slug, $num_posts, $offset, $sort_order, $ajax_pagination )
{
	$rndn       = woohoo_rand(10);
	$cat_query  = woohoo_blocks_wpquery( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $offset, $paged );
	$mn_pages   = $cat_query->max_num_pages;

	$block_margin ='';
	if( !empty( $margin_t ) || !empty( $margin_b ) ) {
		$block_margin = ' style="';
		if( !empty( $margin_t ) ) $block_margin .= ' margin-top:'.$margin_t.'px !important;';
		if( !empty( $margin_b ) ) $block_margin .= ' margin-bottom:'.$margin_b.'px !important;';
		$block_margin .= '"';
	}

	$data_attr = array(
		'block_nu'          => 'b24',
		'block_id'          => 'bdaia-block-id-'.$rndn,
		'paged'             => $paged,
		'sort_order'        => $sort_order,
		'ajax_pagination'   => $ajax_pagination,
		'num_posts'         => $num_posts,
		'tag_slug'          => $tag_slug,
		'cat_uid'           => $cat_uid,
		'cat_uids'          => $cat_uids,
		'offset'            => $offset,
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
	<div class="bdaia-block-wrap bdaia-block24 bdaia-block-id-<?php echo $rndn;?> bdaia-block-cat-id-<?php echo $cat_uid; ?> bdaia-ajax-pagination-<?php echo $ajax_pagination_class;?>" <?php echo $block_margin; ?> <?php echo $bdaia_att;?>>
		<?php
		if( $title_text_color || $title_bg_color ) echo '<style type="text/css">.bdaia-block-id-'.$rndn.' h4.block-title:before{background-color: '.$title_bg_color.' !important;}.bdaia-block-id-'.$rndn.' h4.block-title a, .bdaia-block-id-'.$rndn.' h4.block-title span{color:'.$title_text_color.' !important;} .bdaia-block-id-'.$rndn.' .bd-more-btn{background:'.$title_bg_color.' !important;border:0 none !important;} .bdaia-block-id-'.$rndn.' .bd-more-btn a{color:#FFF !important;}</style>';
		if( $block_title ) {
			echo '<h4 class="block-title">';
			if( $title_url ) echo '<a href="'. $title_url .'"><span>'. $block_title .'</span></a>';
			else echo '<span>'. $block_title .'</span>';
			echo '</h4>';
		}
		?>
		<div class="bdaia-blocks bdaia-block24">
			<div class="bdaia-blocks-container">
				<?php
				if ( $cat_query->have_posts() ) :
					echo '<div class="bd-block-row bdaia-nip-inner"><ul>';
					while ( $cat_query->have_posts() ) : $cat_query->the_post();
						if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
						if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() )
						{
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
					endwhile;
					echo '</ul></div>';
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div><!-- END Block24. -->
	</div>
	<!--/ END Block 24 /-->
	<?php
}