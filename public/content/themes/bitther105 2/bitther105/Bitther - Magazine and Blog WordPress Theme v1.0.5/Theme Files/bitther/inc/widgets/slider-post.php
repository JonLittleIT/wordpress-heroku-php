<?php
/**
 * @package     bitther
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

class bitther_slider_post extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'slider_post',esc_html__('+NA: Slider Posts','bitther'),
            array('description'=>esc_html__('Slider Posts', 'bitther'))
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $number = $instance['number'];
        $categories = $instance['categories'];
        $title = apply_filters('widget_title', $instance['title']);

        $arr = array(
            'category_name' => $categories,
            'showposts'     => $number,
            'post_type'     => 'post',
            'post_status'   => 'publish',
            'meta_key'      => '_featured',
            'meta_value'    => 'yes',
            'orderby'       => 'date',
            'order'         => 'DESC'
        );
        $meta_query[] = array(
            'key'   => '_featured',
            'value' => 'yes'
        );
        $add_rtl="false";
        if(is_rtl()){
            $add_rtl="true";
        }
        $popular_posts = new WP_Query( $arr );

        echo ent2ncr($args['before_widget']);
        if($title) {
            echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
        }
        ?>

        <!-- Tab panes -->
        <div class="archive-blog article-carousel" data-rtl="<?php echo esc_attr($add_rtl);?>"  data-table="1" data-number="1" data-mobile = "1" data-mobilemin = "1" data-dots="true" data-arrows="false">
            <?php
            if($popular_posts->have_posts()): ?>
                    <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                        <?php get_template_part( 'templates/layout/slider-full'); ?>
                    <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php
        echo ent2ncr($args['after_widget']);
    }
// Widget Backend
    public function form( $instance ) {
        $instance = wp_parse_args($instance,array(
            'title' => esc_html__('Most Popular','bitther'),
            'number' => '5',
            'categories' => '',
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
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Categories:', 'bitther') ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories">
                <option value='' <?php if ('' == $instance['categories']) echo 'selected="selected"'; ?>><?php  esc_html_e('All categories', 'bitther'); ?></option>
                <?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
                <?php foreach($categories as $category) { ?>
                    <option value='<?php echo esc_attr($category->slug); ?>' <?php if ($category->slug == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html($category->cat_name); ?></option>
                <?php } ?>
            </select>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['number'] = $new_instance['number'];
        $instance['categories'] = $new_instance['categories'];
        return $instance;
    }
}
function bitther_slider_post(){
    register_widget('bitther_slider_post');
}
add_action('widgets_init','bitther_slider_post');