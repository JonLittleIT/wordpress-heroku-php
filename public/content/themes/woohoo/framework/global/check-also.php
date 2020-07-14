<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

if( woohoo_get_option( 'check_also' ) )
{

    global $post, $do_not_duplicate;

	$original_post = $post;

	$check_also_query_posts_filter = woohoo_get_option( 'check_also_query_posts_filter' );
    $check_also_position = woohoo_get_option( 'check_also_position' ) ? woohoo_get_option( 'check_also_position' ) : 'right';
    $do_not_duplicate[] = $post->ID;
    $query_type = woohoo_get_option( 'check_also_query' );
    $size = $GLOBALS['bdaia-widget'];
    switch ( $query_type )
    {
        case 'categories' :
            $categories = get_the_category($post->ID);
            $category_ids = array();
            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
            $args = array(
                'post_status'           => 'publish',
                'post_type'             => 'post',
                'posts_per_page'        => 1,
                'post__not_in'          => $do_not_duplicate,
                'category__in'          => $category_ids,
                'ignore_sticky_posts'   => true,
                'no_found_rows'         => true,
                'cache_results'         => false
            );

            break;

        case 'tags' :
            $tags = wp_get_post_tags($post->ID);
            $tags_ids = array();
            foreach($tags as $individual_tag) $tags_ids[] = $individual_tag->term_id;
            $args = array(
                'post_status'           => 'publish',
                'post_type'             => 'post',
                'posts_per_page'        => 1,
                'post__not_in'          => $do_not_duplicate,
                'tag__in'               => $tags_ids,
                'ignore_sticky_posts'   => true,
                'no_found_rows'         => true,
                'cache_results'         => false
            );

            break;

        case 'author' :
            $args = array(
                'post_status'           => 'publish',
                'post_type'             => 'post',
                'posts_per_page'        => 1,
                'post__not_in'          => $do_not_duplicate,
                'author'                => get_the_author_meta( 'ID' ),
                'ignore_sticky_posts'   => true,
                'no_found_rows'         => true,
                'cache_results'         => false
            );

            break;

	    case 'posts_filter' :
		    $args = array(
			    'post_status'           => 'publish',
			    'post_type'             => 'post',
			    'posts_per_page'        => 1,
			    'post__not_in'          => $do_not_duplicate,
			    'ignore_sticky_posts'   => true,
			    'no_found_rows'         => true,
			    'cache_results'         => false
		    );

		    if ( !empty( $check_also_query_posts_filter ) ) $args['post__in'] = explode (',' , $check_also_query_posts_filter );

		    break;
    }
    $query = new WP_Query( $args );
    if( $query->have_posts() ) : ?>
            <section id="bdCheckAlso" class="bdCheckAlso-<?php echo $check_also_position ?>">
	            <h4 class="block-title">
		            <span><?php woohoo_tr( 'Check Also' ); ?></span>
		            <a href="#" id="check-also-close"><span class="bdaia-io bdaia-io-cross"></span></a>
	            </h4>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="check-also-post">
                        <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail()) : ?>
                            <figure class="check-also-thumb"  style="background-image:url(<?php echo woohoo_thumb_src($size); ?>);"></figure>
                        <?php endif; ?>
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

                        <p><?php echo woohoo_cl( get_the_excerpt() , 90 ) ?></p>
                    </div>
                <?php endwhile; wp_reset_query(); ?>
            </section>
        <?php
    endif;
	$post = $original_post;
}