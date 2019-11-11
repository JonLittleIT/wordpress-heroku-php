<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aqura
 */

$aqura_post__options__article_type__the_type 			= rwmb_meta( 'aqura_post__options__article_type__the_type' );
$aqura_post__options__article_type__soundcloud_track_id = rwmb_meta( 'aqura_post__options__article_type__soundcloud_track_id' );
$aqura_post__options__article_type__video_id 			= rwmb_meta( 'aqura_post__options__article_type__video_id' );
$aqura_post__options__article_type__quote_text 			= rwmb_meta( 'aqura_post__options__article_type__quote_text' );
$aqura_post__options__article_type__quote_icon 			= rwmb_meta( 'aqura_post__options__article_type__quote_icon' );
$aqura_post__options__article_type__quote_author 		= rwmb_meta( 'aqura_post__options__article_type__quote_author' );
$aqura_post__options__article_type__gallery_images 		= rwmb_meta( 'aqura_post__options__article_type__gallery_images' , array( 'size' => 'thumbnail' ) );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php if ( $aqura_post__options__article_type__the_type === 'soundcloud' ): ?>

			<?php if ( $aqura_post__options__article_type__soundcloud_track_id != '' ): ?>
				
				<iframe class="single-article-top-format-iframe" width="100" height="53"  src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo esc_attr($aqura_post__options__article_type__soundcloud_track_id); ?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>

			<?php endif ?>
			
		<?php elseif ( $aqura_post__options__article_type__the_type === 'youtube' ) : ?>

			<?php if ( $aqura_post__options__article_type__video_id != '' ): ?>

				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr($aqura_post__options__article_type__video_id); ?>" allowfullscreen></iframe>

			<?php endif ?>

		<?php elseif ( $aqura_post__options__article_type__the_type === 'vimeo' ) : ?>

			<?php if ( $aqura_post__options__article_type__video_id != '' ): ?>

				<iframe src="https://player.vimeo.com/video/<?php echo esc_attr($aqura_post__options__article_type__video_id); ?>?title=0&byline=0&portrait=0" allowfullscreen></iframe>

			<?php endif ?>

		<?php elseif ( $aqura_post__options__article_type__the_type === 'quote' ) : ?>

			<?php if ( $aqura_post__options__article_type__quote_text !== '' ): ?>

				<div class="blog-single-type-2">
					<div class="grid-item">
						<div class="featured-area">
							<div class="title">
								<h3><a>“<?php echo esc_html( $aqura_post__options__article_type__quote_text ) ?>”</a></h3>
								<?php if ( $aqura_post__options__article_type__quote_icon !== '' ): ?>
									<i class="fa <?php echo esc_attr( $aqura_post__options__article_type__quote_icon ); ?>" aria-hidden="true"></i>
								<?php endif ?>
								<?php if ( $aqura_post__options__article_type__quote_author !== '' ): ?>
									<a class="author">—<?php echo esc_html(  $aqura_post__options__article_type__quote_author ); ?></a>
								<?php endif ?>
							</div>
						</div><!-- end featured-area-->
					</div>
				</div>

			<?php endif ?>

		<?php elseif ( $aqura_post__options__article_type__the_type === 'gallery' ) : ?>

			<?php if ( $aqura_post__options__article_type__gallery_images !== '' ): ?>

				<div class="owl-carousel custom-arrow-carousel">
					<?php foreach ( $aqura_post__options__article_type__gallery_images as $image ) { ?>
						<div class="item"><img src="<?php echo esc_url( $image['full_url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"></div>
					<?php } ?>
				</div><!-- end owl-carousel -->

			<?php endif ?>

		<?php endif; ?>
		<div class="title">
			<h1>
				<?php echo get_the_title(); ?>
			</h1>
		</div><!-- end title -->
		<aside>
			<div class="post-meta">
				<p><?php aqura_posted_on(); ?></p>
				<?php aqura_posted_by(); ?>
			</div><!-- end post-meta -->
		</aside>
	</header>
	<div class="article-post">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					esc_html__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'aqura' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aqura' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php $aqura_article__tags = get_the_tags(); ?>
	<?php if ( !empty($aqura_article__tags) ): ?>
	<footer>
		<div class="article-tags">
			<span>
				<?php echo esc_html__( 'Tag Cloud :' , 'aqura' ); ?>
			</span>
			<?php
			if ($aqura_article__tags) {
				foreach($aqura_article__tags as $tag) { ?>
					<a href="<?php echo get_tag_link($tag->term_id); ?>">
						<?php echo esc_html($tag->name . ' '); ?> 
					</a>
				<?php }
			} ?>
		</div><!-- end article tags-->
	</footer>
	<?php endif ?>
	<section class="author-info">
		<?php echo get_avatar( $comment, 44 ); ?>
		<div class="author-content">
			<h3>
				<a href="<?php echo get_author_posts_url(get_post_field( 'post_author', get_the_ID() )); ?>">
					<?php the_author(); ?>
				</a>
			</h3>
			<p>
				<?php echo get_the_author_meta( 'description' ); ?>
			</p>
		</div><!-- end author-content -->
	</section>
</article><!-- #post-<?php the_ID(); ?> -->