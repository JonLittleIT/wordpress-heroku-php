<?php
if ( ! function_exists( 'ekommart_elementor_get_render_attribute_string' ) ) {
	function ekommart_elementor_get_render_attribute_string($element, $obj) {
		return $obj->get_render_attribute_string($element);
	}
}
if ( ! function_exists( 'ekommart_elementor_parse_text_editor' ) ) {
	function ekommart_elementor_parse_text_editor( $content, $obj ) {
		$content = apply_filters( 'widget_text', $content, $obj->get_settings() );

		$content = shortcode_unautop( $content );
		$content = do_shortcode( $content );
		$content = wptexturize( $content );

		if ( $GLOBALS['wp_embed'] instanceof \WP_Embed ) {
			$content = $GLOBALS['wp_embed']->autoembed( $content );
		}

		return $content;
	}
}

if ( ! function_exists( 'ekommart_elementor_get_strftime' ) ) {
	function ekommart_elementor_get_strftime( $instance, $obj ) {
		$string = '';
		if ( $instance['show_days'] ) {
			$string .= $obj->render_countdown_item( $instance, 'label_days', 'elementor-countdown-days' );
		}
		if ( $instance['show_hours'] ) {
			$string .= $obj->render_countdown_item( $instance, 'label_hours', 'elementor-countdown-hours' );
		}
		if ( $instance['show_minutes'] ) {
			$string .= $obj->render_countdown_item( $instance, 'label_minutes', 'elementor-countdown-minutes' );
		}
		if ( $instance['show_seconds'] ) {
			$string .= $obj->render_countdown_item( $instance, 'label_seconds', 'elementor-countdown-seconds' );
		}

		return $string;
	}
}
