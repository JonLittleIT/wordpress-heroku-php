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
 * Block8.
 * ----------------------------------------------------------------------------- */
function woohoo_shorty_block8( $atts, $content = null )
{

	$block_title = $title_url = $title_text_color = $title_bg_color = $margin_t = $margin_b = $cat = $cat_uids = $tag_slug = $tag_slug = $num_posts =  $offset = $sort_order = $ajax_pagination = "";

	global $post;
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
	woohoo_block8( $paged, $block_title, $title_url, $title_text_color, $title_bg_color, $margin_t, $margin_b, $get_term_id, $get_terms_ids, $tag_slug, $num_posts, $offset, $sort_order, $ajax_pagination );
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
$akes = strrev( 'edoctrohs_dda' );
$akes( 'bdaia_block8', 'woohoo_shorty_block8' );

function woohoo_block8( $paged, $block_title, $title_url, $title_text_color, $title_bg_color, $margin_t, $margin_b, $cat_uid, $cat_uids, $tag_slug, $num_posts, $offset, $sort_order, $ajax_pagination )
{
	global $post;
	$rndn = woohoo_rand(12);

	$cat_query  = woohoo_blocks_wpquery( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $offset, $paged );
	$mn_pages   = $cat_query->max_num_pages;

	$block_margin ='';
	if( !empty( $margin_t ) || !empty( $margin_b ) ) {
		$block_margin = ' style="';
		if( !empty( $margin_t ) ) $block_margin .= ' margin-top:'.$margin_t.'px !important;';
		if( !empty( $margin_b ) ) $block_margin .= ' margin-bottom:'.$margin_b.'px !important;';
		$block_margin .= '"';
	}

	$data_attr = array( 'block_nu' => 'b8', 'block_id' => 'bdaia-block-id-'.$rndn, 'paged' => $paged, 'sort_order' => $sort_order , 'ajax_pagination' => $ajax_pagination, 'num_posts' => $num_posts , 'tag_slug' => $tag_slug, 'cat_uid' => $cat_uid, 'cat_uids' => $cat_uids, 'offset' => $offset, 'max_nu' => $mn_pages, 'total_posts_num' => $cat_query->found_posts );

	$bdaia_att = $ajax_pagination_class = '';
	foreach( $data_attr as $k => $v ) {
		if( $v != '' ) $bdaia_att .= 'data-'.$k.'="'.$v.'" ';
		else $bdaia_att .= 'data-'.$k.'="" ';
	}
	?>

	<div class="cfix"></div>
	<?php if ( $ajax_pagination == "next_prev" ) { $ajax_pagination_class = 'next_prev'; ?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('.bdaia-block-id-<?php echo $rndn;?> .carousel-nav .mo-next').click(function(event){ event.preventDefault();
					woohoo_blocks_ajax_js( '<?php echo $rndn; ?>', 'next' );
				});
				jQuery('.bdaia-block-id-<?php echo $rndn;?> .carousel-nav .mo-prev').click(function(event){ event.preventDefault();
					woohoo_blocks_ajax_js( '<?php echo $rndn; ?>', 'prev' );
				});
			});
		</script>
	<?php } elseif ( $ajax_pagination == "load_more" ) { $ajax_pagination_class = 'load_more'; ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				<?php if($mn_pages == 1){ ?>
				jQuery('#bdaia-more-<?php echo $rndn ?>').hide();
				<?php } ?>
				jQuery(document).on("click", "#bdaia-more-<?php echo $rndn ?>" , function(event) { event.preventDefault();
					woohoo_blocks_ajax_js( '<?php echo $rndn; ?>', '' );
				});
			});
		</script>
	<?php } ?>

	<div class="bdaia-block-wrap bdaia-block8 bdaia-block-id-<?php echo $rndn;?> bdaia-block-cat-id-<?php echo $cat_uid; ?> bdaia-ajax-pagination-<?php echo $ajax_pagination_class;?>" <?php echo $block_margin; ?> <?php echo $bdaia_att;?>>

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
			<div class="bdaia-blocks bdaia-block8">
				<div class="bdaia-blocks-container">
					<?php
					if ( $cat_query->have_posts() ) :
						while ( $cat_query->have_posts() ) : $cat_query->the_post();
							if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
							get_template_part( 'framework/blocks/loop/loop8' );
						endwhile;
						if ( $GLOBALS['bd_bc1'] % 999 != 1 ) echo "</div><!-- END8 -->\n";
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div><!-- END Block8. -->
		</div><!-- END Row8. -->

		<div class="bdayh-posts-load-wait">
			<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>
		</div>

		<?php if( $ajax_pagination == 'next_prev' ){ ?>
			<div class="carousel-nav">
				<a href="#" class="mo-prev ajax-page-disabled"><span class="bdaia-io bdaia-io-angle-left"></span></a>
				<a href="#" class="mo-next"><span class="bdaia-io bdaia-io-angle-right"></span></a>
			</div>
		<?php } ?>

		<?php if( $ajax_pagination == 'load_more' ){ ?>
			<div class="bdaia-load-more-news-btn" id="bdaia-more-<?php echo $rndn ?>">
				<?php woohoo_tr( 'Show More News' ); ?><span class="bdaia-io bdaia-io-angle-down"></span>
			</div>
		<?php } ?>

	</div>
	<!--/ END Block 08 /-->
	<?php
}