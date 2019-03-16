<div class="jvbpd_ts_tab javo-opts-group-tab hidden" tar="banners">
	<h2><?php esc_html_e("Banners Setting", 'jvbpd' ); ?></h2>
	<table class="form-table">
		<tr><th>
			<?php esc_html_e('Footer Top Banner Image Setting', 'jvbpd' );?>
		</th><td>
			<h4><?php esc_html_e("Banner Image",'jvbpd' ); ?></h4>
			<fieldset class="inner">
				<input type="text" name="jvbpd_ts[footer-banner]" value="<?php echo esc_attr( jvbpd_tso()->get( 'footer-banner' ) );?>" tar="b01">
				<input type="button" class="button button-primary fileupload" value="<?php esc_html_e('Select Image', 'jvbpd' );?>" tar="b01">
				<input class="fileuploadcancel button" tar="b01" value="<?php esc_html_e('Delete', 'jvbpd' );?>" type="button">
				<p>
					<?php esc_html_e("Preview",'jvbpd' ); ?><br>
					<img src="<?php echo esc_attr( jvbpd_tso()->get( 'footer-banner' ) );?>" tar="b01" style="max-width:400px; max-height:400px;">
				</p>
			</fieldset>
			<h4><?php esc_html_e("Banner Link",'jvbpd' ); ?></h4>
			<fieldset class="inner">
				<div>
					<?php echo 'http://' ?>
					<input type="text" name="jvbpd_ts[footer-banner-link]" value="<?php echo esc_attr( jvbpd_tso()->get( 'footer-banner-link' ) );?>">
				</div>
			</fieldset>
			<h4><?php esc_html_e("Image Width (Max 1000px)",'jvbpd' ); ?></h4>
			<fieldset class="inner">
				<div>
					<input type="text" name="jvbpd_ts[footer-banner-width]" value="<?php echo esc_attr( jvbpd_tso()->get('footer-banner-width') );?>">px
				</div>
			</fieldset>
			<h4><?php esc_html_e("Image Height (Max 300px)",'jvbpd' ); ?></h4>
			<fieldset class="inner">
				<div>
					<input type="text" name="jvbpd_ts[footer-banner-height]" value="<?php echo esc_attr( jvbpd_tso()->get('footer-banner-height') );?>">px
				</div>
			</fieldset>
		</td></tr>
	</table><!-- form-table -->
</div><!-- javo-opts-group-tab -->