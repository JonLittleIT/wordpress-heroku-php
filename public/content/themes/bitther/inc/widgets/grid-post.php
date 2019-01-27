<?php
/**
 * @package     bitther
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

class bitther_grid_post extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'grid_post',esc_html__('+NA: Grid Post ','bitther'),
            array('description'=>esc_html__('Displays featured posts or most views with layout is Grid', 'bitther'))
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $number = $instance['number'];
        $title = apply_filters('widget_title', $instance['title']);
        $arr = array(
            'showposts'     => $number,
            'post_type'     => 'post',
            'post_status'   => 'publish',
            'meta_key'      => 'post_views_count',
            'orderby'       =>'meta_value_num',
            'order'         => 'DESC'
        );
        //check post type
        if( $instance['type_post'] == 'featured' ){
            $meta_query[] = array(
                'key'   => '_featured',
                'value' => 'yes'
            );
            $arr['meta_query'] = $meta_query;
        }

        $popular_posts = new WP_Query( $arr );

        echo ent2ncr($args['before_widget']);
        if($title) {
            echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
        }
        ?>

        <div class="grid-post-content">
                <div class="grid-post clearfix">
                    <?php
                    if($popular_posts->have_posts()): ?>
                            <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                                <?php get_template_part( 'templates/layout/content-trans'); ?>
                            <?php endwhile; ?>
                            <?php   wp_reset_postdata();?>
                    <?php endif; ?>

                </div>
        </div>
        <?php
        echo ent2ncr($args['after_widget']);
    }
// Widget Backend
    public function form( $instance ) {
        $instance = wp_parse_args($instance,array(
            'title'         => esc_html__('Most Popular','bitther'),
            'number'        => '5',
            'type_post'     => 'views',
        ));
        // Widget admin form
        ?>
        <p>
            <label for=<?php echo esc_attr($this->get_field_id('title')); ?>><?php echo esc_html_e('Title:','bitther') ; ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php echo esc_html_e('Number posts:','bitther'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('type_post')); ?>">
                <strong><?php esc_html_e('Type Post', 'bitther') ?>:</strong>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('type')); ?>"
                        name="<?php echo esc_attr($this->get_field_name('type_post')); ?>">
                    <option
                        value="views"<?php echo (isset($instance['type_post']) && $instance['type_post'] == 'views') ? ' selected="selected"' : '' ?>><?php esc_html_e('Most Views', 'bitther') ?></option>
                    <option
                        value="featured"<?php echo (isset($instance['type_post']) && $instance['type_post'] == 'featured') ? ' selected="selected"' : '' ?>><?php esc_html_e('Featured', 'bitther') ?></option>

                </select>
            </label>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']  = $new_instance['title'];
        $instance['number'] = $new_instance['number'];
        $instance['type_post']   = $new_instance['type_post'];
        return $instance;
    }
}
function bitther_grid_post(){
    register_widget('bitther_grid_post');
}
add_action('widgets_init','bitther_grid_post');