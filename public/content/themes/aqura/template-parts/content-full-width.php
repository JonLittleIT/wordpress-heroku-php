<?php

/**

 * Template part for displaying posts

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package Aqura

 */



?>



<article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-12'); ?>>

	<?php if ( has_post_thumbnail() ): ?>

		<figure class="list-figure col-sm-4">

			<a href="<?php echo get_the_permalink(); ?>" class="image">

				<?php the_post_thumbnail('full'); ?>

			</a>

		</figure>

		<?php $aqura_content_without_thumbnail = ''; ?>

	<?php else: ?>

		<?php $aqura_content_without_thumbnail = 'max-width: 100%;'; ?>

	<?php endif; ?>

	<div class="col-sm-8" style="<?php echo esc_attr( $aqura_content_without_thumbnail ); ?>">

		<header>

			<div class="title">

				<h4>

					<a href="<?php echo get_the_permalink(); ?>">

						<?php echo get_the_title(); ?>

					</a>

				</h4>

			</div><!-- end title -->

			<aside class="post-meta">

				<p>

				<?php aqura_posted_on(); ?>

				<?php aqura_posted_by(); ?>

				</p>

			</aside><!-- end post-meta -->

		</header>

		<div class="article-content">

			<p>

			<?php

				echo mb_strimwidth(get_the_content(), 0, 560, '...');

			?>

			</p>

		</div><!-- end article content -->

		<footer>

			<a href="<?php echo get_the_permalink(); ?>" class="read-more">

				<?php echo esc_html__( 'Read More' , 'aqura' ); ?>

				<span class="line">

					<span class="arrow-right"></span>

				</span>

			</a>

		</footer>

	</div><!-- end box -->

</article>

