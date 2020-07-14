<div class="column-item post-style-2">
    <div class="post-inner">
        <?php if (has_post_thumbnail() && '' !== get_the_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('ekommart-post-grid-2'); ?>
                </a>
            </div><!-- .post-thumbnail -->

        <?php endif; ?>
        <div class="entry-header">
            <div class="entry-meta">
                <?php
                ekommart_categories_link();
                ekommart_post_meta();
                ?>
            </div>
            <?php
            the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
            ?>
        </div>
        <div class="entry-content">
	        <p><?php echo  wp_trim_words(esc_html(get_the_excerpt()), 20); ?></p>
	        <a href="<?php the_permalink() ?>"><?php echo esc_html__('Read More', 'ekommart') ?></a>
        </div>
    </div>
</div>
