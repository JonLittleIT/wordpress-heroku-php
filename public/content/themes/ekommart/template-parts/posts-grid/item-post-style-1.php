<div class="column-item post-style-1">
    <div class="post-inner">
        <div class="entry-header">
            <?php if (has_post_thumbnail() && '' !== get_the_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('ekommart-post-grid'); ?>
                    </a>
                </div><!-- .post-thumbnail -->

            <?php endif; ?>
            <div class="post-header-content">
                <?php ekommart_categories_link(); ?>
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>
        </div>
        <div class="entry-meta">
            <?php ekommart_post_meta(); ?>
        </div>
    </div>
</div>
