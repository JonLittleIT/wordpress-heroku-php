<?php
/**
 * @package     bitther
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */
class bitther_videos extends WP_Widget {

    public function __construct() {
        /* Widget control settings. */
        $control_ops = array('id_base' => 'bitther_videos');
        $widget_ops = array('classname' => 'widget_videos', 'description' => esc_html__('Videos most viewed.', 'bitther'));
        /* Create the widget. */
        parent::__construct('bitther_videos', esc_html__('+NA: +NA:Videos', 'bitther'), $widget_ops, $control_ops);
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $posts = $instance['posts'];
        $dates = $instance['dates'];
        $style = $instance['style'];
        $title = apply_filters('widget_title', $instance['title']);
        $add_rtl="false";
        if(is_rtl()){
            $add_rtl="true";
        }
        echo ent2ncr($args['before_widget']);
        if($title) {
                echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
            }?>

            <?php
            $popular_posts = new WP_Query(
                array(
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'posts_per_page' => $posts,
                    'meta_key'       => 'post_views_count',
                    'orderby'        =>'meta_value_num',
                    'order'          =>'DESC',
                    'date_query' => array( array( 'after' =>  $dates ) ),
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
                <?php if ($style == 'vertical'){?>
                    <div class="post-widget  posts-listing clearfix">
                        <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                                <?php get_template_part( 'templates/layout/video-trans'); ?>
                            <?php  endwhile;   wp_reset_postdata();?>
                    </div>
                <?php } else {?>
                    <div class="box-videos">
                        <div class="box-video video-carousel clearfix">
                            <div class="article-carousel" data-rtl="<?php echo esc_attr($add_rtl);?>" data-number="4"  data-dots="true" data-table="2" data-mobile = "1" data-mobilemin = "1" data-arrows="false">
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
                                                <div class="article-meta clearfix">
                                                    <?php bitther_entry_meta(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $n++; endwhile;   wp_reset_postdata();?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        <?php
        echo ent2ncr($args['after_widget']);;
    }
// Widget Backend
    public function form( $instance ) {
        $instance = wp_parse_args($instance,array(
            'title'       => esc_html__('Most Views', 'bitther'),
            'posts'       => 3,
            'dates'       => '-2 year',
            'style'       => 'vertical',
        ));
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <strong><?php esc_html_e('Title', 'bitther') ?>:</strong>
            </label>
        </p>

        <p>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts')); ?>"><?php echo esc_html__('Number of Most Views posts:', 'bitther' ); ?></label>
        </p>
        <p>
            <input class="widefat" type="text"  id="<?php echo esc_attr($this->get_field_id('posts')); ?>" name="<?php echo esc_attr($this->get_field_name('posts')); ?>" value="<?php echo esc_attr($instance['posts']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('dates')); ?>">
                <strong><?php esc_html_e('Most popular post for', 'bitther') ?>:</strong>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('type')); ?>"
                        name="<?php echo esc_attr($this->get_field_name('dates')); ?>">
                    <option
                        value="-1 days"<?php echo (isset($instance['dates']) && $instance['dates'] == '-1 week') ? ' selected="selected"' : '' ?>><?php esc_html_e('Last Week', 'bitther') ?></option>
                    <option
                        value="-2 week"<?php echo (isset($instance['dates']) && $instance['dates'] == '-2 week') ? ' selected="selected"' : '' ?>><?php esc_html_e('Two Weeks ago', 'bitther') ?></option>
                    <option
                        value="-1 month"<?php echo (isset($instance['dates']) && $instance['dates'] == '-1 month') ? ' selected="selected"' : '' ?>><?php esc_html_e('Last Month', 'bitther') ?></option>
                    <option
                        value="-2 year"<?php echo (isset($instance['dates']) && $instance['dates'] == '-2 year') ? ' selected="selected"' : '' ?>><?php esc_html_e('Last Years', 'bitther') ?></option>
                </select>
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('style')); ?>">
                <strong><?php esc_html_e('Style :', 'bitther') ?>:</strong>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('type')); ?>"
                        name="<?php echo esc_attr($this->get_field_name('style')); ?>">
                    <option
                        value="vertical"<?php echo (isset($instance['style']) && $instance['style'] == 'vertical') ? ' selected="selected"' : '' ?>><?php esc_html_e('Vertical', 'bitther') ?></option>
                    <option
                        value="carousel"<?php echo (isset($instance['style']) && $instance['style'] == 'carousel') ? ' selected="selected"' : '' ?>><?php esc_html_e('Carousel', 'bitther') ?></option>

                </select>
            </label>
        </p>
    <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['posts'] = $new_instance['posts'];
        $instance['dates'] = $new_instance['dates'];
        $instance['style'] = $new_instance['style'];
        return $instance;

    }
}
function bitther_videos(){
    register_widget('bitther_videos');
}
add_action('widgets_init','bitther_videos');
