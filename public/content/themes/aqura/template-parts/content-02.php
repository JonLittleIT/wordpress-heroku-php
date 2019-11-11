<?php
/**
 * Template part for displaying posts. Style 02.
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

<div class="col-sm-12">
	<div class="article-header">
		<div class="article-category">
			<?php
				$aqura_single_post__categories = get_the_category( get_the_ID() );
				$aqura_single_post__categories__index = 0;
				$aqura_single_post__categories__items = count($aqura_single_post__categories);

				foreach( $aqura_single_post__categories as $category ) { ?>
					<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
						<?php echo esc_html( $category->name ); ?>
					</a>
					<?php if ( ++$aqura_single_post__categories__index === $aqura_single_post__categories__items ) {} else {

						echo '<span class="separator"></span>';

					}
				}
			?>
		</div><!-- end article-category -->
		<?php if ( $aqura_post__options__article_type__the_type === 'quote' ) : ?>

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

		<?php else: ?>
			<h1>
				<?php echo get_the_title(); ?>
			</h1>
		<?php endif; ?>
		<div class="post-meta-header">
			<div class="date">
				<?php aqura_posted_on(); ?>
			</div>
			<span class="separator"></span>
			<a href="#comments" class="comment"><i class="fa fa-comment-o"></i></a>
			<span class="separator"></span>
			<a href="<?php echo get_author_posts_url(get_post_field( 'post_author', get_the_ID() )); ?>" class="author">
				<?php the_author(); ?>
			</a>
		</div><!-- end post-meta-header -->
	</div><!-- end article-header -->
	<figure>

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

		<?php elseif ( ($aqura_post__options__article_type__the_type === 'standard') || ($aqura_post__options__article_type__the_type === 'quote') ) : ?>

			<?php if ( has_post_thumbnail() ): ?>
				
				<?php $aqura_single_post__featured_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<a href="<?php echo esc_url($aqura_single_post__featured_image_url); ?>" class="fluidbox">
					<img src="<?php echo esc_url($aqura_single_post__featured_image_url); ?>" alt="Image - Figure">
				</a>

			<?php endif ?>

		<?php endif; ?>
	</figure>
</div><!-- end col-sm-12 -->
<div class="col-sm-8">
	<div class="blog-single-type-2-article">
		<?php if ( $aqura_post__options__article_type__the_type === 'gallery' ) : ?>

			<?php if ( $aqura_post__options__article_type__gallery_images !== '' ): ?>

				<div class="owl-carousel custom-arrow-carousel">
					<?php foreach ( $aqura_post__options__article_type__gallery_images as $image ) { ?>
						<div class="item"><img src="<?php echo esc_url( $image['full_url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"></div>
					<?php } ?>
				</div><!-- end owl-carousel -->

			<?php endif ?>

		<?php endif; ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
		</article>
		<footer>
			<div class="prev">
				<?php previous_post_link( '%link' , '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>' ); ?>
			</div>
			<div class="share-article">
				<span>
					<?php echo esc_html__( 'Share This' , 'aqura' ); ?>
				</span>
				<ul>
					<li>
						<a target="popup" onclick="window.open('http://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php the_permalink(); ?>','name','width=600,height=400')" rel="nofollow">
							<i class="fa fa-facebook"></i>
						</a>
					</li>
					<li>
						<a target="popup" onclick="window.open('http://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php the_permalink(); ?>','name','width=600,height=400')" rel="nofollow">
							<i class="fa fa-twitter"></i>
						</a>
					</li>
					<li>
						<a target="popup" onclick="window.open('http://api.addthis.com/oexchange/0.8/forward/googleplus/offer?url=<?php the_permalink(); ?>','name','width=600,height=400')" rel="nofollow">
							<i class="fa fa-google-plus"></i>
						</a>
					</li>
					<li>
						<a target="popup" onclick="window.open('http://api.addthis.com/oexchange/0.8/forward/vk/offer?url=<?php the_permalink(); ?>','name','width=600,height=400')" rel="nofollow">
							<i class="fa fa-vk"></i>
						</a>
					</li>
				</ul>
			</div><!-- end share-article -->
			<div class="next">
				<?php next_post_link( '%link' ,  '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>' ); ?>
			</div>
		</footer>
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template('/template-parts/comments-02.php');
		endif;
		?>
	</div><!-- end blog-single-type-2-article -->
</div><!-- end col-sm-8 -->