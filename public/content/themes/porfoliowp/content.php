<?php 

$placeholder = '600x500';
$master_class = 'col-md-12';
$thumbnail_class = 'col-md-4';
$post_details_class = 'col-md-8';
$type_class = 'list-view';
$image_size = 'porfoliowp_about_625x415';

if ( porfoliowp_redux('mt_blog_display_type') == 'list' ) {

    $master_class = 'col-md-12';
    $thumbnail_class = 'col-md-4';
    $post_details_class = 'col-md-8';
    $type_class = 'list-view';
    $image_size = 'porfoliowp_about_625x415';

} else {

    $type_class = 'grid-view';
    if ( porfoliowp_redux('mt_blog_grid_columns') == 1 ) {
        $master_class = 'col-md-12';
        $type_class .= ' grid-one-column';
        $image_size = 'porfoliowp_about_625x415';
        $placeholder = '900x500';
    }elseif ( porfoliowp_redux('mt_blog_grid_columns') == 2 ) {
        $master_class = 'col-md-6';
        $type_class .= ' grid-two-columns';
        $image_size = 'porfoliowp_about_625x415';
        $placeholder = '900x500';
    }elseif ( porfoliowp_redux('mt_blog_grid_columns') == 3 ) {
        $master_class = 'col-md-4';
        $type_class .= ' grid-three-columns';
        $image_size = 'porfoliowp_about_625x415';
        $placeholder = '600x500';
    }elseif ( porfoliowp_redux('mt_blog_grid_columns') == 4 ) {
        $master_class = 'col-md-3';
        $type_class .= ' grid-four-columns';
        $image_size = 'porfoliowp_about_625x415';
        $placeholder = '600x500';
    }

    $thumbnail_class = 'full-width-part';
    $post_details_class = 'full-width-part';

} 

$post_background_color = get_post_meta( get_the_ID(), 'smartowl_post_background_color', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post grid-view '.esc_attr($master_class).' '.esc_attr($type_class)); ?> > 
    <div class="blog_custom">
        <div class="col-md-6 post-thumbnail">
            <a href="<?php the_permalink(); ?>" class="relative">
                <?php 
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
                if($thumbnail_src) {  
                    echo '<img class="blog_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.get_the_title().'" />';
                } ?>
            </a>
        </div>
        <div class="col-md-6 post-details">
            
            <div class="post-category-comment-date row">
                <div class="post-date">
                    <span class="blog_date blog_day"><?php echo get_the_date( "j" ) ?></span> 
                    <span class="blog_date blog_month"><?php echo get_the_date( "M" ) ?></span>
                    <span class="blog_date blog_year"><?php echo get_the_date( "Y" ) ?></span>
                </div>
                <div class="clearfix"></div>
                <span class="post-tags">
                    <?php echo get_the_term_list( get_the_ID(), 'category', '<i class="icon-tag"></i>', ', ' ); ?>
                </span>
                <span class="post-author"><i class="icon-user icons"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author(); ?></a></span>
                <span class="post-comments"><i class="icon-bubbles icons"></i><a href="<?php echo the_permalink().'#comments'; ?>"><?php comments_number( '0', '1', '%' ); ?></a></span>  

            </div>

            <h3 class="post-name row">
                <a title="<?php the_title() ?>" href="<?php the_permalink(); ?>">
                    <?php the_title() ?>
                </a>
            </h3>

            <div class="post-excerpt row">
            <?php
                /* translators: %s: Name of current post */
                the_content( sprintf(
                    '<span>' . esc_attr__( 'READ MORE', 'porfoliowp' ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );
            ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_attr__( 'Pages:', 'porfoliowp' ),
                    'after'  => '</div>',
                ) );
            ?>
            </div>
        </div>
    </div>
</article>
