<?php 
/**
* Template for Portfolio Archive
**/


// CAR THUMBNAIL
$post_img = '';
$thumbnail_src_featured = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'urbanpointwp_listing_archive_featured_square' );
$thumbnail_src_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'urbanpointwp_listing_archive_thumbnail' );

    if ($thumbnail_src_featured) {
        $post_img = '<img class="blog_post_image" src="'. esc_url($thumbnail_src_featured[0]) . '" alt="'.get_the_title().'" />';
        $post_col = 'col-md-6';
    } else {
        $post_col = 'col-md-12 no-featured-image';
    }

?>


<?php 
#thumbnail
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'modeltheme_about_480x600' );

echo '<div class="grid__item id-'.get_the_ID().'">';
    echo '<a class="grid_overlay_fancybox" href="'. esc_url($thumbnail_src[0]) . '">';
        echo '<img src="'. esc_url($thumbnail_src[0]) . '" alt="'.get_permalink(get_the_ID()).'" />';
        echo '<div class="mt-portfolio-grid-overlay">';
            echo '<div class="flex">';
                echo '<div class="flex-center">';
                    echo '<i class="icon-size-fullscreen icons"></i>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</a>';

    // Metas
    echo '<h3 class="post-title">';
        echo '<a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a>';
    echo '</h3>';

    echo '<div class="clearfix"></div>';
    echo '<div class="mt-portfolio-metas text-left">';
        echo '<i class="icon-tag"></i>'.get_the_term_list( get_the_ID(), 'portfolios', '', ', ' );
    echo '</div>';
echo '</div>';
?>