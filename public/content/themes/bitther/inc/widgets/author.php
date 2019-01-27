<?php
/* *
 * widgets contact info
 **/
class bitther_author extends WP_Widget{

	/*function construct*/
	public function __construct() {
		/* Widget control settings. */
		$control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'author');
		$widget_ops = array('classname' => 'widget-author', 'description' => esc_html__('Easy add Author of the post.', 'bitther'));

		/* Create the widget. */
		parent::__construct('author', esc_html__('+NA: Author', 'bitther'), $widget_ops, $control_ops);
	}
	/**
	 * font-end widgets
	 */
	public function widget($args, $instance) {
			extract($args);
			echo ent2ncr($args['before_widget']);?>
			<?php echo get_avatar( get_the_author_meta('email'), '150' ); ?>
			<h2 class="author-name"><?php echo  get_the_author_posts_link();?></h2>
			<div class="about-description">
				<span><?php the_author_meta('description'); ?></span>
			</div>
			<div class="bitther-social-icon clearfix">
				<?php if(get_the_author_meta('facebook')) : ?><a target="_blank" class="author-social ion-social-facebook" href="<?php echo the_author_meta('facebook'); ?>"><i class="ti-facebook"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('twitter')) : ?><a target="_blank" class="author-social ion-social-twitter" href="<?php echo the_author_meta('twitter'); ?>"><i class="ti-twitter-alt"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('instagram')) : ?><a target="_blank" class="author-social ion-social-instagram" href="<?php echo the_author_meta('instagram'); ?>"><i class="ti-instagram"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('google')) : ?><a target="_blank" class="author-social ion-social-google" href="<?php echo the_author_meta('google'); ?>?rel=author"><i class="ti-google"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('pinterest')) : ?><a target="_blank" class="author-social ion-social-pinterest" href="<?php echo the_author_meta('pinterest'); ?>"><i class="ti-pinterest"></i></a><?php endif; ?>

			</div>

		<?php
		echo ent2ncr($args['after_widget']);
	}

	/**
	 * Back-end widgets form
	 */
	public function form($instance){
		$instance =   wp_parse_args($instance,array(
			'title'       =>  '',
		));
		?>
		<p>
			<label for=<?php echo esc_attr($this->get_field_id('title')); ?>><?php echo esc_html_e('Title:','bitther') ; ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<?php
	}

	/**
	 * function update widget
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}
}
function bitther_author(){
	register_widget('bitther_author');
}
add_action('widgets_init','bitther_author');
?>