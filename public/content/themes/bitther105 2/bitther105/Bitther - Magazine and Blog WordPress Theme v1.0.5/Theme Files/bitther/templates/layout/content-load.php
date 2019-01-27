<?php
/**
 * The default template for displaying content
 *
 * @author      Nanobitther
 * @link        http://nanobitther.co
 * @copyright   Copyright (c) 2015 Nanobitther
 * @license     GPL v2
 */

$format         = get_post_format();
$layout         = get_theme_mod('bitther_readmore_layout','full');
$number         = get_theme_mod('bitther_readmore_show',6);

$cat='';
if(get_theme_mod('bitther_readmore_cat')) {
    $cat = implode(',', get_theme_mod('bitther_readmore_cat'));
}
//layout
if(isset($_GET['layout'])){
    $layout=$_GET['layout'];
}
//class for option columns.
$class = 'col-md-12';

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
    'category_name'       => $cat,
    'posts_per_page'      =>($number > 0) ? $number : get_option('posts_per_page')
);
$args['paged'] = (nano_get_query_var('paged')) ? nano_get_query_var('paged') : 1;
$the_query = new WP_Query($args);
$number_pages = $the_query->max_num_pages;

?>

<div class="<?php echo 'wrapper-posts box-loading-single box-recent type-loadMore layout-' . esc_attr($layout); ?>"
     data-layout="<?php echo esc_attr($layout);?>"
     data-paged="<?php echo esc_attr($number_pages);?>"
     data-col="<?php echo esc_attr($class);?>"
     data-cat="<?php echo esc_attr($cat)?>"
     data-number="<?php echo esc_attr($number)?>"
     data-ads="">
    <span class="agr-loading"></span>
    <div class="tab-content">
        <div id="allCat" class="archive-blog affect-isotopes row active">
            <?php if($layout == 'full'){?>
                <?php if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post(); ?>
                        <div class="col-item col-xs-12 col-sm-12 ">
                            <?php get_template_part('templates/layout/content-full');?>
                        </div>
                    <?php endwhile;
                endif;
                wp_reset_postdata();
                ?>
            <?php }
            else{
                if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post(); ?>
                        <div class="col-item col-xs-12 col-1">
                            <?php get_template_part('templates/layout/content-list');?>
                        </div>
                        <?php  endwhile;
                endif;
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</div>