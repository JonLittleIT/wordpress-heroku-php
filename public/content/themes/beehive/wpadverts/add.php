<?php
/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php adverts_flash( $adverts_flash ); ?>

<form action="" method="post" class="adverts-form <?php echo esc_attr( $form->get_layout() ); ?>">
	<fieldset>

		<?php foreach ( $form->get_fields( array( 'type' => array( 'adverts_field_hidden' ) ) ) as $field ) : ?>
			<?php call_user_func( adverts_field_get_renderer( $field ), $field ); ?>
		<?php endforeach; ?>

		<?php foreach ( $form->get_fields() as $field ) : ?>
			<div class="adverts-control-group <?php echo esc_attr( str_replace( '_', '-', $field['type'] ) . ' adverts-field-name-' . $field['name'] ); ?><?php echo ( adverts_field_has_errors( $field ) ) ? esc_attr( ' adverts-field-error' ) : ''; ?>">

				<?php if ( 'adverts_field_header' === $field['type'] ) : ?>
					<div class="adverts-field-header block-title">
						<h3 class="adverts-field-header-title"><?php echo esc_html( $field['label'] ); ?></h3>
					</div>
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
			<input type="submit" name="submit" value="<?php esc_attr_e( 'Preview', 'adverts' ); ?>" class="adverts-cancel-unload medium" />
		</div>

	</fieldset>
</form>
