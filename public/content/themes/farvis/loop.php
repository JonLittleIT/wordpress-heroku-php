<?php
$post_ID = isset ($wp_query) ? $wp_query->get_queried_object_id() : (get_the_ID()>0 ? get_the_ID() : '');
$custom =  get_post_custom($post_ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$i=0;
?>

    <?php if ( ! have_posts() ) : ?>
        <div class="post error404 not-found">
            <h1 class="entry-title"><?php esc_attr_e( 'Not Found', 'farvis' ); ?></h1>
            <div class="entry-content">
                <p>
                    <?php esc_attr_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'farvis' ); ?>
                </p>
                <?php get_search_form(); ?>
            </div>
            <!-- .entry-content -->
        </div>
        <!-- #post-0 -->
        <?php endif; ?>


            <?php while ( have_posts() ) : the_post(); ?>
                <?php
            $farvis_class = $farvis_date = $farvis_cat = $farvis_dev = '';
            $farvis_format  = get_post_format();
            $farvis_format = !in_array($farvis_format, array("quote", "gallery", "video")) ? 'standared' : $farvis_format;
            if(farvis_get_option('blog_settings_date', 1)) {
				$farvis_date = '<a href="' . esc_url(get_the_permalink()) . '">' . get_the_time('j M Y') . '</a>';
			}
			if( farvis_get_option('blog_settings_category', 1) ){
				$farvis_categories = get_the_category(get_the_ID());
				if($farvis_categories){
					foreach($farvis_categories as $category) {
						$farvis_cat .= '<a href="'.esc_url(get_category_link( $category->term_id )).'">'.wp_kses_post($category->cat_name).'</a>';
					}
				}
			}
			if( $farvis_date != '' && $farvis_cat != '' ){
				$farvis_dev = '|';
			}
			$farvis_img_class = !has_post_thumbnail() ? '' : '';
			$farvis_blog_item = get_post_format() ? get_post_format() : 'standared';
			$classes = array('wrap-blog-post','blog-item-'.$farvis_blog_item,$farvis_img_class);
        ?>
                    <div id="post-<?php esc_attr(the_ID()); ?>" <?php post_class($classes); ?>>

                        <div class="wrap-image wrap-image-grid">
                            <?php get_template_part( 'templates/post-parts/post-format/blog', $farvis_format); ?>
                                <?php if( $farvis_date != '' || $farvis_cat != '' ) : ?>
                                    <div class="post-date text-uppercase">
                                        <div class="post-get_the_date">
                                            <?php echo get_the_date(); ?>
                                        </div>

                                        <?php echo wp_kses_post($farvis_cat) ?>
                                    </div>
                                    <?php endif; ?>
                        </div>

                        <div class="wrap-info wrap-info-grid">

                            <?php get_template_part( 'templates/post-parts/blog-template/blog', 'template'); ?>

                        </div>

                    </div>

                    <?php endwhile;?>