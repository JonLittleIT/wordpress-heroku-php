<?php
/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php if ( $baseurl || get_post_permalink( $post_id ) ) : ?>
<div class="edit-advert-top-nav">
	<?php if ( $baseurl ) : ?>
		<a href="<?php echo esc_url( $baseurl ); ?>" class="back button small"><?php esc_html_e( 'Go Back', 'adverts' ); ?></a>
	<?php endif; ?>
	<?php if ( get_post_permalink( $post_id ) ) : ?>
		<a href="<?php echo esc_url( get_post_permalink( $post_id ) ); ?>" class="view button small"><?php esc_html_e( 'View Ad', 'adverts' ); ?></a>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php adverts_flash( $adverts_flash ); ?>

<form action="" method="post" class="adverts-form adverts-form-aligned">
	<fieldset>

		<?php foreach ( $form->get_fields( array( 'type' => array( 'adverts_field_hidden' ) ) ) as $field ) : ?>
			<?php call_user_func( adverts_field_get_renderer( $field ), $field ); ?>
		<?php endforeach; ?>

		<?php foreach ( $form->get_fields( array( 'exclude' => array( 'account' ) ) ) as $field ) : ?>

		<div class="adverts-control-group <?php echo esc_attr( str_replace( '_', '-', $field['type'] ) . ' adverts-field-name-' . $field['name'] ); ?><?php echo ( adverts_field_has_errors( $field ) ) ? esc_attr( ' adverts-field-error' ) : ''; ?>">

			<?php if ( 'adverts_field_header' === $field['type'] ) : ?>

				<?php if ( function_exists( 'bp_is_active' ) && bp_is_my_profile() ) : ?>
					<h3 class="adverts-field-header-title"><?php echo esc_html( $field['label'] ); ?></h3>
				<?php else : ?>
					<div class="adverts-field-header block-title">
						<h3 class="adverts-field-header-title"><?php echo esc_html( $field['label'] ); ?></h3>
					</div>
				<?php endif; ?>

			<?php else : ?>

				<label for="<?php echo esc_attr( $field['name'] ); ?>">
					<?php echo esc_html( $field['label'] ); ?>
					<?php if ( adverts_field_is_required( $field ) ) : ?>
						<span class="adverts-form-required">*</span>
					<?php endif; ?>
				</label>

				<?php call_user_func( adverts_field_get_renderer( $field ), $field ); ?>

			<?php endif; ?>

			<?php if ( adverts_field_has_errors( $field ) ) : ?>
				<ul class="adverts-field-error-list">
					<?php foreach ( $field['error'] as $k => $v ) : ?>
						<li><?php echo esc_html( $v ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>
		<?php endforeach; ?>

		<div class="adverts-control-group submit <?php echo isset( $actions_class ) ? esc_attr( $actions_class ) : ''; ?>">
			<input type="submit" name="submit" value="<?php esc_attr_e( 'Update', 'adverts' ); ?>" />
		</div>

	</fieldset>
</form>
