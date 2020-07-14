<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_HTML extends WP_Widget {

	function __construct() {
		parent::__construct (
			'bdaia-widget-html', '.: Bdaia - Html',
			array( 'classname' => 'bdaia-widget-html', 'description' => 'Custom text/html – with transparent background option' )
		);
		add_action('admin_enqueue_scripts', array( $this, 'upload_scripts' ) );
	}

	public function upload_scripts()
	{
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_register_script( 'bdaia-upload-media', get_template_directory_uri().'/js/upload-media.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'bdaia-upload-media' );
		wp_enqueue_style( 'thickbox' );
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$title          = $instance['title'];
		$trans_bg       = isset( $instance['trans_bg'] );
		$html_code      = $instance['html_code'];

		if( function_exists('icl_t') ) $text_code = icl_t( WOOHOO_THEME_NAME , 'widget_content_'.$this->id , $html_code );
		else $text_code = $html_code;

		if( $trans_bg ) $trans_class = "e3-trans";
		else $trans_class = "";

		echo '<div id="'.$args['widget_id'].'" class="widget bdaia-widget bdaia-widget-html '.$trans_class.'">';
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . esc_attr( $title ) . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n";

		echo do_shortcode( htmlspecialchars_decode(stripslashes( $text_code ) ));

		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$title = $trans_bg = $html_code = $image = "";
		if( isset( $instance['image'] ) ) $image = $instance['image'];
		if( isset( $instance['trans_bg'] ) ) $trans_bg = $instance['trans_bg'];
		if( isset( $instance['html_code'] ) ) $html_code = $instance['html_code'];
		if( isset( $instance['title'] ) ) $title = $instance['title']; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" type="text" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'trans_bg' ); ?>" name="<?php echo $this->get_field_name( 'trans_bg' ); ?>" value="true" <?php if( !empty( $trans_bg ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'trans_bg' ); ?>">Background Transparent</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'html_code' ); ?>">Text , Shortcodes or HTML code</label>
			<textarea id="<?php echo $this->get_field_id( 'html_code' ); ?>" name="<?php echo $this->get_field_name( 'html_code' ); ?>" class="widefat" ><?php if( !empty( $html_code ) ) echo stripcslashes( $html_code ); ?></textarea>
		</p>

		<p>
			<small>You can upload image and use url image to content.</small>
			<br />

			<label style="margin-bottom: 10px; clear: both; display: none" for="<?php echo $this->get_field_name( 'image' ); ?>">Upload Image</label>
			<input style="margin-bottom: 10px; clear: both; display: none" name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
			<input class="upload_image_button button button-primary" type="button" value="Upload Image" />
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$updated_instance['title']          = strip_tags( $new_instance['title'] );
		$updated_instance['trans_bg']       = strip_tags( $new_instance['trans_bg'] );
		$updated_instance['html_code']      = strip_tags( $new_instance['html_code'] );
		$updated_instance['image']          = strip_tags( $new_instance['image'] );

		$updated_instance = $new_instance;
		return $updated_instance;
	}
}

function woohoo_widget_html(){
	register_widget( 'WOOHOO_WIDGET_HTML' );
}
add_action( 'widgets_init', 'woohoo_widget_html' );