<div class="column-item post-style-3">
	<div class="post-inner">
		<?php if (has_post_thumbnail() && '' !== get_the_post_thumbnail()) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('ekommart-post-grid-2'); ?>
				</a>
			</div><!-- .post-thumbnail -->

		<?php endif; ?>

		<div class="entry-content">
			<a class="post-link" href="<?php the_permalink(); ?>"></a>
			<div class="entry-content-inner">
				<?php
					ekommart_categories_link();
					the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
				?>
				<p class="entry-description"><?php echo  wp_trim_words(esc_html(get_the_excerpt()), 20); ?></p>
			</div>
		</div>

		<div class="entry-meta">
			<?php ekommart_post_meta();?>
		</div>
	</div>
</div>
