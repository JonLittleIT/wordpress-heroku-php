<?php
/**
 # Blog.
 * ----------------------------------------------------------------------------- */
function woohoo_shorty_blog( $atts, $content = null )
{
	$block_title = $title_url = $title_text_color = $title_bg_color = $margin_t = $margin_b = $cat = $cat_uids = $tag_slug = $num_posts = $pagination = $display = "";
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
		'pagination'        => '',
		'display'           => '',
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
	woohoo_blog( $block_title, $title_url, $title_text_color, $title_bg_color, $margin_t, $margin_b, $get_term_id, $get_terms_ids, $tag_slug, $num_posts, $pagination, $display );
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
$akes = strrev( 'edoctrohs_dda' );
$akes( 'bdaia_blog', 'woohoo_shorty_blog' );

function woohoo_blog( $block_title, $title_url, $title_text_color, $title_bg_color, $margin_t, $margin_b, $cat, $cat_uids, $tag_slug, $num_posts, $pagination, $display )
{
	$rndn       = woohoo_rand(15);
	$blog_display = "";
	if( !empty( $display ) )
		$blog_display = $display;

	$block_title_c = "";
	if( !$block_title ) {
		if( $blog_display == 'blog2' || $blog_display == 'blog3' ) {
			$block_title_c = ' bdaia-block-nt';
		}
	}

	if ( !empty( $cat ) and empty( $cat_uids ) ) $cat_uids = $cat;
	if ( !empty( $cat_uids ) ) $bd_query_args['cat'] = $cat_uids;
	if ( !empty( $tag_slug ) ) $bd_query_args['tag'] = str_replace(' ', '-', $tag_slug);

	if ( empty( $num_posts ) ) $num_posts = get_option('posts_per_page');
	$bd_query_args['posts_per_page'] = $num_posts;

	$block_margin ='';
	if( !empty( $margin_t ) || !empty( $margin_b ) )
	{
		$block_margin = ' style="';
		if( !empty( $margin_t ) ) $block_margin .= ' margin-top:'.$margin_t.'px !important;';
		if( !empty( $margin_b ) ) $block_margin .= ' margin-bottom:'.$margin_b.'px !important;';
		$block_margin .= '"';
	}

	if ( !empty( $pagination ) ) {
		$paged   = intval( get_query_var( 'paged' ) );
		$paged_2 = intval( get_query_var( 'page' ) );
		if ( empty( $paged ) && ! empty( $paged_2 ) ) {
			$paged = intval( get_query_var( 'page' ) );
		}
		$bd_query_args['paged'] = $paged;
	}
	else {
	    $bd_query_args[ 'no_found_rows' ] = true ;
	}


	if ( ! empty( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) && is_array( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) ) {
		$bd_query_args['post__not_in'] = $GLOBALS['woohoo_do_not_diblicate_boxes'];
	}

	$GLOBALS['bd_bc1'] = 1;
	$GLOBALS['bd_bc2'] = 0;

	$blog_query = new WP_Query( $bd_query_args );

	$data_attr  = array( 'block_nu' => $blog_display, 'block_id' => 'bdaia-block-id-'.$rndn, 'num_posts' => $num_posts , 'tag_slug' => $tag_slug, 'cat_uid' => $cat, 'cat_uids' => $cat_uids, 'max_nu' => $blog_query->max_num_pages, 'total_posts_num' => $blog_query->found_posts );
	$bdaia_att  = '';

	foreach( $data_attr as $k => $v )
	{
		if( $v != '' ) $bdaia_att .= 'data-'.$k.'="'.$v.'" ';
		else $bdaia_att .= 'data-'.$k.'="" ';
	}
	?>
	<div class="cfix"></div>

	<div class="bdaia-block-wrap bdaia-blog bdaia-block-id-<?php echo $rndn;?> bdaia-block-cat-id-<?php echo $cat; ?><?php echo $block_title_c; ?>" <?php echo $block_margin; ?> <?php echo $bdaia_att;?>>

		<?php
		if( $title_text_color || $title_bg_color ) echo '<style type="text/css">.bdaia-block-id-'.$rndn.' h4.block-title:before{background-color: '.$title_bg_color.' !important;}.bdaia-block-id-'.$rndn.' h4.block-title a, .bdaia-block-id-'.$rndn.' h4.block-title span{color:'.$title_text_color.' !important;}  .bdaia-block-id-'.$rndn.' .bd-more-btn{background:'.$title_bg_color.' !important;border:0 none !important;} .bdaia-block-id-'.$rndn.' .bd-more-btn a{color:#FFF !important;} .bdaia-block-id-'.$rndn.' .bdaia-pagination .current{background:'.$title_bg_color.' !important;border-color:'.$title_bg_color.' !important;}</style>';
		if( $block_title ) {
			echo '<h4 class="block-title">';
			if( $title_url ) echo '<a href="'. $title_url .'"><span>'. $block_title .'</span></a>';
			else echo '<span>'. $block_title .'</span>';
			echo '</h4>';
		}
		?>

		<?php if( $blog_display == "blog1" ) { ?>
			<div class="bdaia-blocks bdaia-block1">
				<div class="bdaia-blocks-container">
					<?php
					if ( $blog_query->have_posts() ) :
						while ( $blog_query->have_posts() ) : $blog_query->the_post();
							get_template_part( 'framework/blocks/loop/loop1' );
						endwhile;
						wp_reset_query();
					endif;
                    ?>
				</div>
			</div><!-- END Block1. -->

		<?php } elseif( $blog_display == "blog2" ) { ?>

			<div class="bdaia-blocks bdaia-block2">
				<div class="bdaia-blocks-container">
					<?php
					$bdaia_get_page_meta          = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
					$post_sidebars = $sidebar = "";
					if( is_page() ) {
						if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd'];
					}
					if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

					if( $post_sidebars == 'sideNo' ) $GLOBALS['thumb_loop2_size'] = $GLOBALS['bdaia-full'];
					else $GLOBALS['thumb_loop2_size'] = $GLOBALS['bdaia-large'];

					if ( $blog_query->have_posts() ) :
						while ( $blog_query->have_posts() ) : $blog_query->the_post();
							if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
							get_template_part( 'framework/blocks/loop/loop2' );
						endwhile;
						wp_reset_query();
					endif; ?>
				</div>
			</div><!-- END Block2. -->

		<?php } elseif( $blog_display == "blog3" ) { ?>

			<div class="bdaia-blocks bdaia-block6">
				<div class="bdaia-blocks-container">
					<?php
					$post_sidebars = $sidebar = "";
					$bdaia_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
					if( is_page() ) { if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd']; }
					if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );
					if( $post_sidebars == 'sideNo' ) $GLOBALS['thumb_loop6_size'] = $GLOBALS['bdaia-full'];
					else $GLOBALS['thumb_loop6_size'] = $GLOBALS['bdaia-large'];

					if ( $blog_query->have_posts() ) :
						while ( $blog_query->have_posts() ) : $blog_query->the_post();
							if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
							get_template_part( 'framework/blocks/loop/loop6' );
						endwhile;
						wp_reset_query();
					endif; ?>
				</div>
			</div><!-- END Block6. -->

		<?php } elseif( $blog_display == "blog4" ) { ?>

			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block3 bdaia-block4">
					<div class="bdaia-blocks-container">
						<?php
						if ( $blog_query->have_posts() ) :
							while ( $blog_query->have_posts() ) : $blog_query->the_post();
								if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
								if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
								get_template_part( 'framework/blocks/loop/loop4' );
								if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
							endwhile;
							wp_reset_query();
						endif;
						if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>"; ?>
					</div>
				</div><!-- END Block4. -->
			</div><!-- END Bdaia Row4. -->

		<?php } elseif( $blog_display == "blog5" ) { ?>

			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block6 bdaia-block7">
					<div class="bdaia-blocks-container">
						<?php
						if ( $blog_query->have_posts() ) :
							while ( $blog_query->have_posts() ) : $blog_query->the_post();
								if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
								if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
								get_template_part( 'framework/blocks/loop/loop7' );
								if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
							endwhile;
							wp_reset_query();
						endif;
						if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>";
						?>
					</div>
				</div><!-- END Block7. -->
			</div><!-- END Bdaia Row7. -->

		<?php } elseif( $blog_display == "blog6" ) { ?>

			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block3 bdaia-block5">
					<div class="bdaia-blocks-container">
						<?php
						if ( $blog_query->have_posts() ) :
							while ( $blog_query->have_posts() ) : $blog_query->the_post();
								if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
								if( $GLOBALS['bd_bc1'] % 3 == 1 ) echo '<div class="bd-block-row">';
								get_template_part( 'framework/blocks/loop/loop5' );
								if( $GLOBALS['bd_bc1'] % 3 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
							endwhile;
							wp_reset_query();
						endif;
						if ( $GLOBALS['bd_bc1'] % 3 != 1 ) echo "</div>"; ?>
					</div>
				</div><!-- END Block5. -->
			</div><!-- END Bdaia Row5. -->

		<?php } elseif( $blog_display == "blog7" ) { ?>

			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block3">
					<div class="bdaia-blocks-container">
						<?php
						if ( $blog_query->have_posts() ) :
							while ( $blog_query->have_posts() ) : $blog_query->the_post();
								if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
								if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
								get_template_part( 'framework/blocks/loop/loop3' );
								if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
							endwhile;
							wp_reset_query();
						endif;
						if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>"; ?>
					</div>
				</div><!-- END Block2. -->
			</div><!-- END Bdaia Row3. -->

		<?php } elseif( $blog_display == "blog8" ) { ?>

			<div class="bdaia-blocks bdaia-block22">
				<div class="bdaia-blocks-container">
					<?php
					if ( $blog_query->have_posts() ) :
						while ( $blog_query->have_posts() ) : $blog_query->the_post();
							if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
							get_template_part( 'framework/blocks/loop/loop13' );
						endwhile;
						wp_reset_query();
					endif;
					?>
				</div>
			</div>

		<?php } elseif( $blog_display == "blog9" ) { ?>

			<div class="bdaia-blocks bdaia-new-timeline">
				<div class="bdaia-blocks-container">
					<?php
					if ( $blog_query->have_posts() ) :
						while ( $blog_query->have_posts() ) : $blog_query->the_post();
							if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
							get_template_part( 'framework/blocks/loop/timeline' );
						endwhile;
						wp_reset_query();
					endif;
					?>
				</div>
			</div>

		<?php } ?>
		<?php if ( !empty( $pagination ) && $blog_query->max_num_pages > 1 ) woohoo_page_nav($blog_query , $num_posts ); ?>
	</div>
	<?php
}