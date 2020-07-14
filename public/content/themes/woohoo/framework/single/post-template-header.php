<?php
// Post Template.
$woohoo_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
$woohoo_get_post_meta = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );

if( is_category() || is_single() )
{
	$woohoo_cat_id = '';
	if( is_category() ) $woohoo_cat_id = get_query_var( 'cat' ) ;
	if( is_single() )
	{
		$categories = get_the_category( get_the_ID() );
		if( !empty( $categories[0]->term_id ) ) $woohoo_cat_id = $categories[0]->term_id;
	}
	$woohoo_get_cat_meta = get_option( "bd_cat_$woohoo_cat_id" );
}
$woohoo_post_sidebars = "";
if( is_single() ) {
	if( isset( $woohoo_get_post_meta['sidebar_position_bd'] ) ) $woohoo_post_sidebars = $woohoo_get_post_meta['sidebar_position_bd'];
}
elseif( is_page() ) {
	if( isset( $woohoo_get_page_meta['sidebar_position_bd'] ) ) $woohoo_post_sidebars = $woohoo_get_page_meta['sidebar_position_bd'];
}
elseif( is_category() ) {
	if( isset( $woohoo_get_cat_meta['sidebar_po'] ) ) $woohoo_post_sidebars = $woohoo_get_cat_meta['sidebar_po'];
}
elseif( is_author() ) {
	$woohoo_post_sidebars = woohoo_get_option( 'author_sidebar_pos' );
}
elseif( is_tag() ) {
	$woohoo_post_sidebars = woohoo_get_option( 'tag_sidebar_pos' );
}
elseif( is_archive() ) {
	$woohoo_post_sidebars = woohoo_get_option( 'archive_sidebar_pos' );
}
elseif( is_search() ) {
	$woohoo_post_sidebars = woohoo_get_option( 'search_sidebar_pos' );
}

if ( $woohoo_post_sidebars == '' ) $woohoo_post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );

if( $woohoo_post_sidebars == 'sideNo' ) $woohoo_img_size = $GLOBALS['bdaia-full'];
else $woohoo_img_size = $GLOBALS['bdaia-large'];

$woohoo_p_breadcrumbs        = woohoo_get_option( 'bdaia_p_breadcrumbs'       );
$woohoo_p_categories_tags    = woohoo_get_option( 'bdaia_p_categories_tags'   );
$woohoo_p_top_sharing        = woohoo_get_option( 'bdaia_p_top_sharing'       );

$woohoo_pts = "";
if( isset( $woohoo_get_post_meta['post_template_bd'] ) ) $woohoo_pts = $woohoo_get_post_meta['post_template_bd'];
elseif( isset( $woohoo_get_cat_meta['bdaia_cat_post_template'] ) ) $woohoo_pts = $woohoo_get_cat_meta['bdaia_cat_post_template'];
if( $woohoo_pts == '' ) $woohoo_pts = woohoo_get_option( 'bdaia_post_template' );

if( is_single() )
{
	if( $woohoo_pts == 'postStyle2' ) {
		?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="bdaia-post-style2-head">
				<div class="bd-container">
					<?php if( $woohoo_p_breadcrumbs ) woohoo_breadcrumbs(); // END Breadcrumbs. ?>
					<header class="bdaia-post-header">
						<?php if( $woohoo_p_categories_tags ) : ?>
							<div class="bdaia-category">
								<?php
								foreach( ( get_the_category() ) as $cat )
									echo '<a class="bd-cat-link bd-cat-'. esc_attr( $cat->cat_ID ) .'" href="' . esc_url( get_category_link( $cat->cat_ID ) ) . '">' . esc_attr( $cat->cat_name ) . '</a>'."\n";
								?>
							</div>
							<!-- END category. -->
						<?php endif; ?>
						<div class="bdaia-post-title">
							<h1 class="post-title entry-title"><span><?php the_title(); ?></span></h1>
						</div>
						<!-- END Post Title. -->
						<?php get_template_part( 'framework/single/post-meta-info' ); ?>
					</header>
					<?php
					$woohoo_get_post_format = 	get_post_format( get_the_ID() );

					if( !empty( $woohoo_get_post_format ) && $woohoo_get_post_format == 'video' ) { ?>
						<div class="bdaia-post-featured-video">
							<?php woohoo_get_video(); ?>
						</div>
					<?php } ?>
					<?php if( $woohoo_p_top_sharing ) woohoo_get_post_sharing( 'top' ); // END Post Sharing. ?>
				</div>
			</div>
		<?php endwhile; // END of the loop. ?>
		<?php
	}
	else if( $woohoo_pts == 'postStyle3' ) {
		?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="bdaia-post-style3-head">
				<div class="bd-container">
					<?php if( $woohoo_p_breadcrumbs ) woohoo_breadcrumbs(); // END Breadcrumbs. ?>
					<div class="post-head-sidebar">
						<header class="bdaia-post-header">
							<?php if( $woohoo_p_categories_tags ) : ?>
								<div class="bdaia-category">
									<?php
									foreach( ( get_the_category() ) as $cat )
										echo '<a class="bd-cat-link bd-cat-'.$cat->cat_ID.'" href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->cat_name . '</a>'."\n";
									?>
								</div>
								<!-- END category. -->
							<?php endif; ?>
							<div class="bdaia-post-title">
								<h1 class="post-title entry-title"><span><?php the_title(); ?></span></h1>
							</div>
							<!-- END Post Title. -->
							<?php get_template_part( 'framework/single/post-meta-info' ); ?>
						</header>
						<?php
						// Post Template Style 3 Ad.
						$woohoo_p_temp_s3_desktop_ad = woohoo_get_option( 'bdaia_p_temp_s3_ad'      ); ?>
						<?php if( $woohoo_p_temp_s3_desktop_ad ) { ?>
							<div class="bdaia-p-temp-s3-ad-desktop"><div class="bdaia-ad-container"><?php echo do_shortcode( stripslashes( $woohoo_p_temp_s3_desktop_ad ) ); ?></div></div>
						<?php } ?>
					</div>
					<!-- END Post Head Sidebar -->

					<div class="post-head-main">
						<?php
						$woohoo_get_post_format = 	get_post_format( get_the_ID() );
						if( !empty( $woohoo_get_post_format ) && $woohoo_get_post_format == 'video' ) { ?>
							<div class="bdaia-post-featured-video">
								<?php woohoo_get_video(); ?>
							</div>
						<?php } ?>
						<?php if( $woohoo_p_top_sharing ) woohoo_get_post_sharing( 'top' ); // END Post Sharing. ?>
					</div>
					<!-- END Post Head Main -->
					<?php get_template_part( 'framework/global/bdaia-related' ); // END Related. ?>
				</div>
			</div>
		<?php endwhile; // END of the loop. ?>
		<?php
	}
	else if( $woohoo_pts == 'postStyle6' ) { $woohoo_img_size = $GLOBALS['bdaia-full']; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="bdaia-post-style6-head">
				<a class="bdaia-featured-img-cover" <?php if( has_post_thumbnail() ) { ?> style="background-image:url(<?php echo woohoo_thumb_src( 'full' ); ?>);" <?php } ?>></a>
				<div class="bd-container">
					<?php if( $woohoo_p_breadcrumbs ) woohoo_breadcrumbs(); // END Breadcrumbs. ?>
					<header class="bdaia-post-header">
						<?php if( $woohoo_p_categories_tags ) : ?>
							<div class="bdaia-category">
								<?php
								foreach( ( get_the_category() ) as $cat )
									echo '<a class="bd-cat-link bd-cat-'.$cat->cat_ID.'" href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->cat_name . '</a>'."\n";
								?>
							</div>
							<!-- END category. -->
						<?php endif; ?>
						<div class="bdaia-post-title">
							<h1 class="post-title entry-title"><span><?php the_title(); ?></span></h1>
						</div>
						<!-- END Post Title. -->
						<?php get_template_part( 'framework/single/post-meta-info' ); ?>
						<div class="bdaia-post-read-down">
							<a href="#">
								<span class="bdaia-io bdaia-io-angle-double-down"></span>
							</a>
						</div>
					</header>
				</div>
			</div>
		<?php endwhile; // END of the loop. ?>
		<?php
	}
	else if( $woohoo_pts == 'postStyle7' ) { $woohoo_img_size = $GLOBALS['bdaia-full']; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="bdaia-post-style7-head">
				<a class="bdaia-featured-img-cover" <?php if( has_post_thumbnail() ) { ?> style="background-image:url(<?php echo woohoo_thumb_src( 'full' ); ?>);" <?php } ?>></a>
				<div class="bd-container">
					<header class="bdaia-post-header">
						<?php if( $woohoo_p_categories_tags ) : ?>
							<div class="bdaia-category">
								<?php
								foreach( ( get_the_category() ) as $cat )
									echo '<a class="bd-cat-link bd-cat-'.$cat->cat_ID.'" href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->cat_name . '</a>'."\n";
								?>
							</div>
							<!-- END category. -->
						<?php endif; ?>
						<div class="bdaia-post-title">
							<h1 class="post-title entry-title"><span><?php the_title(); ?></span></h1>
						</div>
						<!-- END Post Title. -->
						<?php get_template_part( 'framework/single/post-meta-info' ); ?>
						<div class="bdaia-post-read-down">
							<a href="#">
								<span class="bdaia-io bdaia-io-angle-double-down"></span>
							</a>
						</div>
					</header>
				</div>
			</div>
		<?php endwhile; // END of the loop. ?>
		<?php
	}
}