<?php
/**
 * @package     bitther
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */
class bitther_post extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'bitther_post',esc_html__('+NA: Recent Post','bitther'),
            array('description'=>esc_html__('Recent Post', 'bitther'))
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $posts = $instance['posts'];
        $title = apply_filters('widget_title', $instance['title']);
		echo ent2ncr($args['before_widget']);
    ?> <aside class="widget_tabs_post">
            <?php if($title) {
                echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
            }?>
            <div class="recent-content">
					<div class="post-widget  posts-listing">
				<?php
				$recent_posts = new WP_Query('showposts='.$posts);
				//$j=1;
				if($recent_posts->have_posts()):
					?>
						<?php while($recent_posts->have_posts()): $recent_posts->the_post(); 
							get_template_part( 'templates/layout/content-sidebar');
						endwhile;   wp_reset_postdata();?>
				<?php endif; ?>
					</div>
			</div>
        </aside>
        <?php
		echo ent2ncr($args['after_widget']);
    }
// Widget Backend
    public function form( $instance ) {
        $instance = wp_parse_args($instance,array(
            'title'       =>  esc_html__('Recent Post','bitther'),
            'posts' => 3,
        ));
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <strong><?php esc_html_e('Title', 'bitther') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>"/>
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts')); ?>"><?php echo esc_html__('Number of Recent posts:', 'bitther' ); ?></label>
            <input class="widefat" type="text"  id="<?php echo esc_attr($this->get_field_id('posts')); ?>" name="<?php echo esc_attr($this->get_field_name('posts')); ?>" value="<?php echo esc_attr($instance['posts']); ?>" />
        </p>
    <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['posts'] = $new_instance['posts'];
        return $instance;

    }
}
function bitther_post(){
    register_widget('bitther_post');
}
add_action('widgets_init','bitther_post');
