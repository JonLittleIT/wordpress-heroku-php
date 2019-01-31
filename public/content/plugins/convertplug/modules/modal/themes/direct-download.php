<?php
/**
 * Prohibit direct script loading.
 *
 * @package Convert_Plus.
 */

if ( ! function_exists( 'modal_theme_direct_download' ) ) {
	/**
	 * Function Name: modal_theme_direct_download.
	 *
	 * @param  array  $atts    array parameters.
	 * @param  string $content string parameter.
	 * @return mixed          string parameter.
	 */
	function modal_theme_direct_download( $atts, $content = null ) {

		/**
		 * Define Variables.
		 */
		global $cp_form_vars;

		$style_id         = '';
		$settings_encoded = '';
		shortcode_atts(
			array(
				'style_id'         => '',
				'settings_encoded' => '',
			),
			$atts
		);
		$style_id         = $atts['style_id'];
		$settings_encoded = $atts['settings_encoded'];
		$settings         = base64_decode( $settings_encoded );
		$style_settings   = unserialize( $settings );

		foreach ( $style_settings as $key => $setting ) {
			$style_settings[ $key ] = apply_filters( 'smile_render_setting', $setting );
		}

		unset( $style_settings['style_id'] );

		// Generate UID.
		$uid       = uniqid();
		$uid_class = 'content-' . $uid;

		// Individual style variables.
		$individual_vars = array(
			'uid'         => $uid,
			'uid_class'   => $uid_class,
			'style_class' => 'cp-direct-download',
		);

		/**
		 * Merge short code variables arrays.
		 *
		 * @array   $individual_vars        Individual style EXTRA short-code variables.
		 * @array   $cp_form_vars           CP Form global short-code variables.
		 * @array   $style_settings         Individual style short-code variables.
		 * @array   $atts                   short-code attributes.
		 */
		$all = array_merge(
			$individual_vars,
			$cp_form_vars,
			$style_settings,
			$atts
		);

		/**
		 *  Extract short-code variables.
		 *
		 *  @array      $all         All merged arrays.
		 *  @array      array()      Its required as per WP. Merged $style_settings in $all.
		 */

		$a = shortcode_atts( $all, array() );

		// Variables.
		$imgclass                = ( '1' !== $a['image_position'] ) ? 'cp-right-contain' : '';
		$imagestyle              = cp_add_css( 'left', $a['image_horizontal_position'], 'px' );
		$imagestyle             .= cp_add_css( 'top', $a['image_vertical_position'], 'px' );
		$imagestyle             .= cp_add_css( 'max-width', $a['image_size'], 'px' );
		$cp_modal_img_custom_url = isset( $a['modal_img_custom_url'] ) ? $a['modal_img_custom_url'] : '';
		$cp_modal_img_src        = isset( $a['modal_img_src'] ) ? $a['modal_img_src'] : '';
		$cp_modal_image          = isset( $a['modal_image'] ) ? $a['modal_image'] : '';

		// Filters & Actions.
		$modal_image = cp_get_module_image_url_init( 'modal', $cp_modal_img_custom_url, $cp_modal_img_src, $cp_modal_image );

		// Filters & Actions for modal_image_alt.
		$modal_image_alt = cp_get_module_image_alt_init( 'modal', $cp_modal_img_src, $cp_modal_image );

		$convert_plug_settings = get_option( 'convert_plug_settings' );
		$images_on_load        = isset( $convert_plug_settings['cp-lazy-img'] ) ? $convert_plug_settings['cp-lazy-img'] : 1;

		// Before filter.
		apply_filters_ref_array( 'cp_modal_global_before', array( $a ) );
		?>
		<!-- BEFORE CONTENTS -->
		<div class="cp-row cp-columns-equalized">
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 cp-text-container <?php echo esc_attr( $imgclass ); ?> cp-column-equalized-center" >

				<div class="cp-desc-container 
				<?php
				if ( '' === trim( $a['modal_short_desc1'] ) ) {
					echo 'cp-empty'; }
				?>
					">
					<div class="cp-description cp_responsive" style="color: <?php echo esc_attr( $a['modal_desc_color'] ); ?>;"><?php echo do_shortcode( html_entity_decode( stripcslashes( $a['modal_short_desc1'] ) ) ); ?></div>
				</div>
				<div class="cp-title-container 
				<?php
				if ( '' === trim( $a['modal_title1'] ) ) {
					echo 'cp-empty'; }
				?>
					">
					<h2 class="cp-title cp_responsive" style="color: <?php echo esc_attr( $a['modal_title_color'] ); ?>;"><?php echo do_shortcode( html_entity_decode( stripcslashes( $a['modal_title1'] ) ) ); ?></h2>
				</div>
				<div class="cp-short-desc-container 
				<?php
				if ( '' === trim( $a['modal_content'] ) ) {
					echo 'cp-empty'; }
				?>
					">
					<div class="cp-short-description cp-desc cp_responsive " ><?php echo do_shortcode( html_entity_decode( stripcslashes( $a['modal_content'] ) ) ); ?></div>
				</div>
				<div class="cp-form-container cp-vertical-form-container">
					<div class="cp-submit-container">
						<?php
							// Embed CP Form.
						apply_filters_ref_array( 'cp_get_form', array( $a ) );
						?>
					</div>
				</div>
				<div class="cp-info-container cp_responsive 
				<?php
				if ( '' === trim( $a['modal_confidential'] ) ) {
					echo 'cp-empty'; }
				?>
					" style="color: <?php echo esc_attr( $a['tip_color'] ); ?>;">
					<?php echo do_shortcode( html_entity_decode( $a['modal_confidential'] ) ); ?>
				</div>
			</div><!-- .col-lg-7 col-md-7 col-sm-7 col-xs-12 cp-text-container -->
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 cp-column-equalized-center">
				<?php
				if ( ! isset( $a['modal_img_src'] ) ) {
					$a['modal_img_src'] = 'upload_img';
				}

				if ( isset( $a['modal_img_src'] ) && 'none' !== $a['modal_img_src'] ) {
					?>
					<div class="cp-image-container">
						<?php if ( $images_on_load ) { ?>
						<img style="<?php echo esc_attr( $imagestyle ); ?>" data-src="<?php echo esc_attr( $modal_image ); ?>" class="cp-image" <?php echo $modal_image_alt; ?> >
						<?php } else { ?>
						<img style="<?php echo esc_attr( $imagestyle ); ?>" src="<?php echo esc_attr( $modal_image ); ?>" class="cp-image" <?php echo $modal_image_alt; ?> >
						<?php } ?>
					</div>

					<?php } ?>
				</div><!-- .col-lg-5 col-md-5 col-sm-5 col-xs-12 -->
			</div>
			<!-- AFTER CONTENTS -->
			<?php
			// After filter.
			apply_filters_ref_array( 'cp_modal_global_after', array( $a ) );

			return ob_get_clean();
	}
}
