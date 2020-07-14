<?php

    wp_enqueue_script( 'slick' );
    wp_enqueue_script( 'besa-custom-slick' );
    
    $relate_count = besa_tbay_get_config('number_blog_releated', 3);
    $relate_columns = besa_tbay_get_config('releated_blog_columns', 2);
    $terms = get_the_terms( get_the_ID(), 'category' );
    $termids =array();
    $nav_type = 'yes';
    $pagi_type = 'no';
    if ($terms) {
        foreach($terms as $term) {
            $termids[] = $term->term_id;
        }
    }

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $relate_count,
        'post__not_in' => array( get_the_ID() ),
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $termids,
                'operator' => 'IN'
            )
        )
    );

    $relates = new WP_Query( $args );


    if( $relates->have_posts() ):
    
?>
    <div class="tbay-addon tbay-addon-blog relate-blog">
        <h4 class="tbay-addon-title">
            <span><?php esc_html_e( 'Related posts', 'besa' ); ?></span>
        </h4>

        <div class="tbay-addon-content">
            <?php $class_column = 12/$relate_columns; ?>
            <?php 

                $nav_type   = ($nav_type == 'yes') ? 'true' : 'false';
                $pagi_type  = ($pagi_type == 'yes') ? 'true' : 'false';

            ?>
            <div class="owl-carousel rows-1" data-carousel="owl" data-navleft="tb-icon tb-icon-chevron-left" data-navright="tb-icon tb-icon-chevron-right" data-items="<?php echo esc_attr($relate_columns); ?>" data-nav="<?php echo esc_attr($nav_type); ?>" data-pagination="<?php echo esc_attr($pagi_type); ?>" data-desktopslick="<?php echo esc_attr($relate_columns); ?>" data-desktopsmallslick="<?php echo esc_attr($relate_columns); ?>" data-tabletslick="2" data-landscapeslick="2" data-mobileslick="1">
            <?php
                while ( $relates->have_posts() ) : $relates->the_post();
                    ?>
                    <div class="item">
                        <?php get_template_part( 'page-templates/posts/single_related' ); ?>
                    </div>
                    <?php
                endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
        
    </div>
<?php endif; ?>