<div class="block-article bdaiaFadeIn">
	<article <?php woohoo_post_class(); ?>>
		<header>
			<div class="bdaia-post-cat-list"><?php printf( '%1$s', get_the_category_list( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ) ); ?></div>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
			<hr>
			<div class="bdaia-post-date"><?php woohoo_tr( 'Posted on' ); echo '&nbsp;&nbsp;'; woohoo_get_time(); ?></div>
			<div class="cfix"></div>
		</header>
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
					<?php echo woohoo_get_icon_video_play(); ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $GLOBALS['thumb_loop2_size'] ); ?></a>
				</div>
				<?php
			}
		}
		?>

		<div class="block-article-content-wrapper">
			<p class="block-exb"><?php woohoo_exb1(); ?></p>
			<div class="post-more-btn"><a href="<?php the_permalink(); ?>"><?php woohoo_tr( 'Continue Reading' ); ?></a></div>
		</div>
		<footer>
			<div class="bdaia-post-author-name">
				<?php woohoo_tr( 'By' ); ?>&nbsp;<?php the_author_posts_link(); ?>
			</div>

			<div class="bdaia-post-sh">
				<?php
				$protocol = is_ssl() ? 'https' : 'http';

				if( woohoo_get_option( 'social_lang_type' ) ) $social_lang_type = woohoo_get_option( 'social_lang_type' );
				else $social_lang_type ='en-US';
				?>
				<a class="fb" title="facebook" onClick="window.open('<?php echo $protocol; ?>://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink( get_the_ID() ));?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="<?php echo $protocol; ?>://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink( get_the_ID() ));?>"><span class="bdaia-io bdaia-io-facebook"></span></a>
				<a class="tw" title="twitter" onClick="window.open('<?php echo $protocol; ?>://twitter.com/share?url=<?php echo esc_url(get_permalink( get_the_ID() )); ?>&amp;text=<?php echo str_replace(" ", "%20", get_the_title()); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="<?php echo $protocol; ?>://twitter.com/share?url=<?php echo esc_url(get_permalink( get_the_ID() )); ?>&amp;text=<?php echo str_replace(" ", "%20", get_the_title()); ?>"><span class="bdaia-io bdaia-io-twitter"></span></a>
				<a class="gp" title="google" onClick="window.open('<?php echo $protocol; ?>://plus.google.com/share?url=<?php echo esc_url(get_permalink( get_the_ID() )); ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="<?php echo $protocol; ?>://plus.google.com/share?url=<?php echo esc_url(get_permalink( get_the_ID() )); ?>"><span class="bdaia-io bdaia-io-google-plus"></span></a>
			</div>

			<div class="bdaia-post-comment">
				<?php comments_popup_link( woohoo__tr( 'No Comments' ), woohoo__tr( 'One Comment' ), '% ' . woohoo__tr( 'Comments' ) ); ?>
			</div>
			<div class="cfix"></div>
		</footer>
		<div class="cfix"></div>
	</article>
</div>