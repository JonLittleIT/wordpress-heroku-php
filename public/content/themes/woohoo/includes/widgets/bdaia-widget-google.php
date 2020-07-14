<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_GOOGLEP extends WP_Widget {

	function __construct() {
		parent::__construct (
			'bdaia-widget-googlep', '.: Bdaia - Google +',
			array( 'classname' => 'bdaia-widget-googlep', 'description' => '' )
		);
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$title      = $instance['title'];
		$page_url 	= $instance['page_url'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . $title . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n" ?>
		<div class="bdaia-google-box">
			<!-- Google +1 script -->
			<script type="text/javascript">
				(function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
			</script>
			<!-- Link blog to Google+ page -->
			<a style='display: block; height: 0;' href="<?php echo esc_url( $page_url ); ?>" rel="publisher">&nbsp;</a>
			<!-- Google +1 Page badge -->
			<g:plus href="<?php echo $page_url ?>" height="131" width="280" theme="light"></g:plus>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$defaults = array(
			'title'     => '',
			'page_url'  => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Page URL</label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}
}
function woohoo_widget_googlep(){
	register_widget( 'WOOHOO_WIDGET_GOOGLEP' );
}
add_action( 'widgets_init', 'woohoo_widget_googlep' );