<div class="block-article post-new-timeline bdaiaFadeIn">
	<article <?php woohoo_post_class(); ?>>
		<header>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
		</header>
		<footer>
			<div class="bdaia-post-author-name">
				<?php woohoo_tr( 'By' ); ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a>
				<?php if ( get_the_author_meta( 'twitter' ) ){ ?>
					<a href="https://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>" target="_blank"><span class="bdaia-io bdaia-io-twitter"></span></a>
				<?php } ?>
			</div>
			<div class="bdaia-post-cat-list"><?php woohoo_tr( 'in' ); echo '&nbsp;: &nbsp;'; printf( '%1$s', get_the_category_list( ', ' ) ); ?></div>
			<?php if( woohoo_get_option( 'bdaia_p_comment_count' ) ) { ?><div class="bdaia-post-comment"><span class='bdaia-io bdaia-io-bubble'></span><?php comments_popup_link( '0', '1', '%' ); ?></div><?php } ?>
			<?php if( woohoo_get_option( 'bdaia_p_post_views' ) ) { ?><div class="bdaia-post-view"><span class='bdaia-io bdaia-io-eye'></span><?php echo woohoo_get_views( get_the_ID() ); ?></div><?php } ?>
		</footer>
		<?php
		$bdaia_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
		$post_sidebars = $sidebar = "";
		if( is_page() ) {
			if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd'];
		}
		if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );
		if( $post_sidebars == 'sideNo' ) $GLOBALS['thumb_loop2_size'] = $GLOBALS['bdaia-full'];
		else $GLOBALS['thumb_loop2_size'] = $GLOBALS['bdaia-large'];

		// GET post meta.
		$meta_post_options      = get_post_meta( get_the_ID(), 'meta_post_options_bd', true    );
		$bd_p_featured_gallery = "";

		if( isset( $meta_post_options['bdaia_format_gallery_style'] ) ) $bd_p_featured_gallery = $meta_post_options['bdaia_format_gallery_style'];

		if( get_post_format( get_the_ID() ) == 'video' ) {
			?>
			<div class="bdaia-post-featured-video">
				<?php woohoo_get_video(); ?>
			</div>
			<?php
		}
		elseif( get_post_format( get_the_ID() ) == 'gallery' ) {

			if( $bd_p_featured_gallery == 'slideshow' ) woohoo_post_gallery( $size );
			elseif( $bd_p_featured_gallery == 'grid' ) woohoo_gallery_grid( $GLOBALS['bdaia-gallery-grid'] );

		}
		elseif( get_post_meta( get_the_ID(),'bdaia_meta_soundcloud_embed', true ) ) {

			$bdaia_p_soundcloud = get_post_meta( get_the_ID(),'bdaia_meta_soundcloud_embed', true );
			echo '<div class="bdaia-post-soundcloud">' . do_shortcode( stripslashes ( $bdaia_p_soundcloud['soundcloud_embed'] ) ) . '</div>';
		}
		else {
			if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() ) { ?>
				<div class="block-article-img-container">
					<?php woohoo_video_icon_play(); ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $GLOBALS['thumb_loop2_size'] ); ?></a>
				</div>
				<?php
			}
		}
		?>
		<div class="post-date">
			<span class="post-day"><?php echo get_the_date( 'j', get_the_ID() ); ?></span>
			<span class="post-month"><?php echo get_the_date( 'M Y', get_the_ID() ); ?></span>
		</div>
		<div class="post-line"></div>
		<div class="block-article-content-wrapper">
			<p class="block-exb"><?php woohoo_exb1(); ?></p>
		</div>
		<hr>
		<div class="cfix"></div>
	</article>
</div>