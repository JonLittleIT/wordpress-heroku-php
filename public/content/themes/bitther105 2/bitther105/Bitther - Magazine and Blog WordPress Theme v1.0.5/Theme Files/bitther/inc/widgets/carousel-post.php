<?php
/**
 * @package     bitther
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

class bitther_carousel_post extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'carousel_post',esc_html__('+NA: Carousel Posts','bitther'),
            array('description'=>esc_html__('Carousel Posts', 'bitther'))
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $number     = $instance['number'];
        $show       = $instance['show'];
        $dates = $instance['dates'];
        $type_post = $instance['type_post'];
        $categories = $instance['categories'];

        $title = apply_filters('widget_title', $instance['title']);
        $arr2=array();
        $arr = array(
            'category_name' => $categories,
            'showposts'     => $number,
            'post_type'     => 'post',
            'post_status'   => 'publish',
            'orderby'       => 'date',
            'order'         => 'DESC',
        );

        if( $type_post == 'featured' ){
            $meta_query[] = array(
                'key'   => '_featured',
                'value' => 'yes'
            );
            $arr['meta_query'] = $meta_query;
        }
        if( $type_post == 'views' ){
            $arr2 = array(
                'meta_key'      => 'post_views_count',
                'orderby'       =>'meta_value_num',
                'date_query'    => array( array( 'after' =>  $dates ) ),
            );

        }
        $att=array_merge($arr,$arr2);
        $add_rtl="false";
        if(is_rtl()){
            $add_rtl="true";
        }
        $popular_posts = new WP_Query( $att);

        echo ent2ncr($args['before_widget']);
        if($title) {
            echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
        }
        ?>

        <!-- Tab panes -->
        <div class="archive-blog article-carousel widget-carousel" data-rtl="<?php echo esc_attr($add_rtl);?>"  data-table="2" data-number="<?php echo esc_attr($show);?>" data-mobile = "2" data-mobilemin = "2" data-dots="false" data-arrows="false">
            <?php
            if($popular_posts->have_posts()): ?>
                    <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                        <?php get_template_part( 'templates/layout/content-sidebar'); ?>
                    <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php
        echo ent2ncr($args['after_widget']);
    }
// Widget Backend
    public function form( $instance ) {
        $instance = wp_parse_args($instance,array(
            'title'         => esc_html__('Most Popular','bitther'),
            'number'        => '6',
            'show'          => '4',
            'type_post'     => 'news',
            'dates'         => '-2 year',
            'categories'    => '',
        ));
        // Widget admin form
        ?>
        <p>
            <label for=<?php echo esc_attr($this->get_field_id('title')); ?>><?php echo esc_html_e('Title:','bitther') ; ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show')); ?>"><?php echo esc_html_e('Show posts:','bitther'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('show')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('show')); ?>" value="<?php echo esc_attr($instance['show']); ?>" />
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
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('type_post')); ?>">
                <strong><?php esc_html_e('Type Post', 'bitther') ?>:</strong>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('type')); ?>"
                        name="<?php echo esc_attr($this->get_field_name('type_post')); ?>">
                    <option
                        value="news"<?php echo (isset($instance['type_post']) && $instance['type_post'] == 'news') ? ' selected="selected"' : '' ?>><?php esc_html_e('News', 'bitther') ?>
                    </option>
                    <option
                        value="views"<?php echo (isset($instance['type_post']) && $instance['type_post'] == 'views') ? ' selected="selected"' : '' ?>><?php esc_html_e('Most Views', 'bitther') ?>
                    </option>
                    <option
                        value="featured"<?php echo (isset($instance['type_post']) && $instance['type_post'] == 'featured') ? ' selected="selected"' : '' ?>><?php esc_html_e('Featured', 'bitther') ?>
                    </option>

                </select>
            </label>
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
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']      = $new_instance['title'];
        $instance['show']       = $new_instance['show'];
        $instance['number']     = $new_instance['number'];
        $instance['type_post']  = $new_instance['type_post'];
        $instance['dates']      = $new_instance['dates'];
        $instance['categories'] = $new_instance['categories'];
        return $instance;
    }
}
function bitther_carousel_post(){
    register_widget('bitther_carousel_post');
}
add_action('widgets_init','bitther_carousel_post');