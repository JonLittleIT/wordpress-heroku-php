<?php
/**
 * The default template for displaying content
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

$format = get_post_format();
$add_class='';
$thumbnail_src        = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "bitther-blog-video" );
$placeholder_image    = get_template_directory_uri(). '/assets/images/layzyload-blog-video.jpg';


$video_number         = get_theme_mod('bitther_videos_number',4);
$videos_show         = get_theme_mod('bitther_videos_show',2);

$cat_video='';
if(get_theme_mod('bitther_videos_cat')){
    $cat_video            = implode(',',get_theme_mod('bitther_videos_cat'));
}


?>
<?php
    $add_rtl='false';
    if(is_rtl()){
        $add_rtl="true";
    }

    $popular_posts = new WP_Query(
        array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $video_number,
            'meta_key'       => 'post_views_count',
            'orderby'        =>'meta_value_num',
            'order'          =>'DESC',
            'category_name'  => $cat,
            'date_query' => array( array( 'after' =>  '-2 year' ) ),
            'tax_query' => array(
                                    array(
                                        'taxonomy' => 'post_format',
                                        'field' => 'slug',
                                        'terms' => array( 'post-format-video' )
                                    )
                                )
            )
        );
    if($popular_posts->have_posts()){
    ?>
    <h5 class="widgettitle "><?php  esc_html_e('Hot Videos','bitther'); ?></h5>
    <div class="box-videos">
        <div class="box-video video-carousel clearfix">
            <div class="article-carousel" data-rtl="<?php echo esc_attr($add_rtl);?>" data-number="<?php echo esc_attr($videos_show);?>"  data-dots="true" data-table="2" data-mobile = "1" data-mobilemin = "1" data-arrows="false">
                <?php  $n=1; ?>
                <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                    <div class="post-grid post-item clearfix">
                        <div class="post-image <?php if ($n == 1) echo esc_attr('active');?>" data-name="video<?php echo esc_attr($n);?>">
                            <div class="post-image-arg">
                                <a href="<?php echo esc_url( get_permalink() );?>">
                                    <?php the_post_thumbnail('bitther-blog-grid'); ?>
                                </a>

                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="article-content clearfix">
                            <div class="entry-header-title">
                                <?php
                                the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php $n++; endwhile;   wp_reset_postdata();?>
            </div>
        </div>
    </div>
<?php }?>
