<div class="column-item post-style-4">
	<div class="post-inner">
		<?php if (has_post_thumbnail() && '' !== get_the_post_thumbnail()) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('ekommart-post-grid-square'); ?>
				</a>
			</div><!-- .post-thumbnail -->

		<?php endif; ?>

		<div class="entry-content">

			<?php
			ekommart_categories_link();
			the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
			?>

			<div class="entry-meta">
				<?php ekommart_post_meta(); ?>
			</div>
		</div>
	</div>
</div>
