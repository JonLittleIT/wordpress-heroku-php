<?php
/**
 * @package ModelTheme
 */

$prev_post = get_previous_post();
$next_post = get_next_post();

$media_id = get_post_thumbnail_id( get_the_ID() );
if(!isset($media_id)){
    $media_id = '';
}

$post_likes = get_post_meta( get_the_ID(), '_li_love_count', true );
$portfolio_subtitle = get_post_meta( get_the_ID(), 'mt_portfolio_subtitle', true );
$project_link = get_post_meta( get_the_ID(), 'mt_project_link', true );
?>


<section class="section section--nav" id="fixedScrolling">
    <nav class="nav nav--fixed-scrolling nav-scroll">
        <button data-scroll-nav="0" class="nav--fixed-scrolling nav--fixed-scrolling--current" aria-label=""><span class="nav--fixed-scrolling-title"><?php echo esc_html__('Overview', 'porfoliowp'); ?></span></button>
        <button data-scroll-nav="1" class="nav--fixed-scrolling" aria-label=""><span class="nav--fixed-scrolling-title"><?php echo esc_html__('Details', 'porfoliowp'); ?></span></button>
        <button data-scroll-nav="2" class="nav--fixed-scrolling" aria-label=""><span class="nav--fixed-scrolling-title"><?php echo esc_html__('Gallery', 'porfoliowp'); ?></span></button>
        <button data-scroll-nav="3" class="nav--fixed-scrolling" aria-label=""><span class="nav--fixed-scrolling-title"><?php echo esc_html__('Related', 'porfoliowp'); ?></span></button>
        <button data-scroll-nav="4" class="nav--fixed-scrolling" aria-label=""><span class="nav--fixed-scrolling-title"><?php echo esc_html__('Quote', 'porfoliowp'); ?></span></button>
    </nav>
</section>



<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

    <!-- OVERVIEW -->
    <div class="container high-padding" data-scroll-index="0">
    <?php
    if(has_post_thumbnail()){
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'full' );
        if($thumbnail_src) {
            echo '<img src="'.esc_attr($thumbnail_src[0]).'" class="img-responsive portfolio-single-pic" alt="'.get_the_title().' />';
        }
    }
    ?>
    </div>


    <!-- DETAILS -->
    <div class="clearfix"></div>
    <div class="portfolio-bottom-description high-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="post-name"><?php echo get_the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
                <div class="col-md-4">
                    <h4 class="post-name"><?php echo esc_html__('Project Details ','porfoliowp'); ?></h4>
                    <div class="row">
                        <div class="portfolio-meta clearfix">
                            <div class="col-md-5">
                                <i class="icon-calendar"></i>
                                <label><?php echo esc_html__('Completed:','porfoliowp'); ?></label>
                            </div>
                            <div class="col-md-7">
                                <?php echo get_the_date(get_option( 'date_format' )); ?>
                            </div>
                        </div>
                        <div class="portfolio-meta clearfix">
                            <div class="col-md-5">
                                <i class="icon-user"></i>
                                <label><?php echo esc_html__('Client:','porfoliowp'); ?></label>
                            </div>
                            <div class="col-md-7">
                                <?php echo get_post_meta( get_the_ID(), 'smartowl_client_name', true ); ?>
                            </div>
                        </div>
                        <div class="portfolio-meta clearfix">
                            <div class="col-md-5">
                                <i class="icon-tag"></i>
                                <label><?php echo esc_html__('Category:','porfoliowp'); ?></label>
                            </div>
                            <div class="col-md-7">
                                <?php echo get_the_term_list( get_the_ID(), 'portfolios', '', ', ' ); ?>
                            </div>
                        </div>
                        <div class="portfolio-meta clearfix">
                            <div class="col-md-5">
                                <i class="icon-bulb"></i>
                                <label><?php echo esc_html__('Skill:','porfoliowp'); ?></label>
                            </div>
                            <div class="col-md-7">
                                <?php echo get_the_term_list( get_the_ID(), 'portfolioskill', '', ', ' ); ?>
                            </div>
                        </div>
                        <div class="portfolio-go-to-url">
                            <div class="col-md-5">
                                <i class="icon-link"></i>
                                <label><?php echo esc_html__('Live demo:','porfoliowp'); ?></label>
                            </div>
                            <div class="col-md-7">
                                <a href="<?php echo esc_url($project_link); ?>"><?php echo esc_html__('View Demo','porfoliowp'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ( porfoliowp_redux('mt_enable_post_navigation') ) { ?>
                    <div class="prev-next-post">
                        <?php if($prev_post){ ?>
                            <div class="col-md-4 btn-action-icon prev-post text-left">
                                <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                    <i class="icon-arrow-left-circle icons"></i>
                                </a>
                            </div>
                        <?php } ?>

                        <?php if ( porfoliowp_redux('mt_portfolio_main_page') ) { ?>
                            <div class="col-md-4 btn-action-icon mt-portfolio-return text-center">
                                <a href="<?php echo get_permalink(porfoliowp_redux('mt_portfolio_main_page')); ?>">
                                    <i class="icon-grid icons"></i>
                                </a>
                            </div>
                        <?php } ?>

                        <?php if($next_post){ ?>
                            <div class="col-md-4 btn-action-icon next-post text-right">
                                <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                    <i class="icon-arrow-right-circle icons"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <!-- GALLERY -->
    <div class="container high-padding" data-scroll-index="2">
        <div class="row">
            <div class="col-md-12 mt-portfolio-images">
                <h1 class="post-name"><?php echo esc_html__('Project Gallery','porfoliowp'); ?></h1>

                <div class="grid grid--loading mt-grid-portfolio-shortcode mt-portfolio-grid-single grid_overlay_fancybox_holder">
                    <img class="grid__loader" src="<?php echo esc_url(get_template_directory_uri() . '/images/svg/grid.svg'); ?>" width="60" alt="<?php echo esc_attr__('Grid', 'porfoliowp')?>" />
                    <div class="grid__sizer"></div>
                    <?php
                    // FEATURED IMAGE
                    if(has_post_thumbnail()){
                        $thumbnail_src_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'full' );
                        echo '<div class="grid__item image-featured">';
                            echo '<a class="grid_overlay_fancybox" href="'. esc_url($thumbnail_src_full[0]) . '">';
                                echo '<img src="'. esc_url($thumbnail_src_full[0]) . '" alt="'.get_permalink(get_the_ID()).'" />';
                                echo '<div class="mt-portfolio-grid-overlay">';
                                    echo '<div class="flex">';
                                        echo '<div class="flex-center">';
                                            echo '<i class="icon-size-fullscreen icons"></i>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</a>';
                        echo '</div>';
                    }

                    // EXTRA IMAGES
                    global  $dynamic_featured_image;
                    $featured_images = $dynamic_featured_image->get_featured_images( get_the_ID() );

                    //Loop through the image to display your image
                    if( !is_null($featured_images) ){
                        $medias = array();
                        foreach($featured_images as $images){
                            $attachment_id = $images['attachment_id'];
                            $medias[] = $attachment_id;
                        }
                        foreach($medias as $media){
                            $multiple_featured_image1 = wp_get_attachment_url( $media, 'full' );
                            echo '<div class="grid__item image-featured">';
                                echo '<a class="grid_overlay_fancybox" href="'.esc_url($multiple_featured_image1).'">';
                                    echo '<img src="'.esc_url($multiple_featured_image1).'" alt="'.get_permalink(get_the_ID()).'" />';
                                    echo '<div class="mt-portfolio-grid-overlay">';
                                        echo '<div class="flex">';
                                            echo '<div class="flex-center">';
                                                echo '<i class="icon-size-fullscreen icons"></i>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';
                        }
                    } 
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div class="row high-padding section-related-works" data-scroll-index="3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-portfolio-images">
                    <div class="related-posts sticky-posts">
                        <h1 class=""><?php echo esc_html__('Related Works','porfoliowp'); ?></h1>
                        <div class="row">
                            <?php  
                            $args=array(  
                                'post__not_in'          => array(get_the_ID()),  
                                'post_type'             => 'portfolio',
                                'posts_per_page'        => 3, // Number of related posts to display.  
                                'ignore_sticky_posts'   => 1  
                            );  

                            $related_query = new wp_query( $args );  

                            while( $related_query->have_posts() ) {  
                                $related_query->the_post(); ?>  
                                <div class="col-md-4 post">
                                    <div class="related_blog_custom">
                                        <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'porfoliowp_related_post_pic500x300' ); ?>
                                        <?php if($thumbnail_src){ ?>
                                            <a href="<?php the_permalink(); ?>" class="relative">
                                                <?php if($thumbnail_src) { ?>
                                                    <img src="<?php echo esc_attr($thumbnail_src[0]); ?>" class="img-responsive" alt="<?php the_title(); ?>" />
                                                <?php } ?>
                                            </a>
                                        <?php } ?>
                                        <div class="related_blog_details">
                                            <h4 class="portfolio-name">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                            <div class="portfolio-posted-in">
                                                <?php echo get_the_term_list( get_the_ID(), 'portfolios', '', ', ' ); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                    <?php 
                    $post = $orig_post;  
                    wp_reset_postdata();  
                    ?>  
                </div>
            </div>
        </div>
    </div>


    <?php if ( function_exists('modeltheme_framework')) { ?>
        <!-- GALLERY -->
        <div class="container high-padding" data-scroll-index="4">
            <h1 class="post-name"><?php echo esc_html__('Request a Quotation','porfoliowp'); ?></h1>
            <div class="col-md-12">
                <div class="row">
                    <?php echo do_shortcode('[shortcode_contact01 contact_button_color="#7023FF" animation="bounce"]'); ?>
                </div>
            </div>
        </div>
    <?php } ?>

</article>