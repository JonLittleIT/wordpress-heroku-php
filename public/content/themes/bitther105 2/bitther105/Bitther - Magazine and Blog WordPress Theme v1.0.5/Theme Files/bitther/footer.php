<?php
/**
 * The template for displaying the footer
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

?>
</div><!-- .site-content -->
<?php if(get_theme_mod('bitther_enable_footer', '1')) { ?>
	<footer id="na-footer">

		<div class="na-footer-main">
			<?php get_template_part('templates/footer/footer', '1'); ?>
		</div>
		
		<div class="coppy-right">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-sm-12">
						<?php if(get_theme_mod('bitther_copyright_text')) {?>
							<span><?php echo  wp_kses_post(get_theme_mod('bitther_copyright_text'));?></span>
						<?php } else {
							echo '<span>'.esc_html__('Copyrights &copy;','bitther').' '.date("Y").'<a  class="link" href="'.esc_url('http://bitther.nanoagency.co').'">'.esc_html__('  Bitther Theme. ','bitther').'</a>'.esc_html__(' All Rights Reserved.','bitther').'</span>';
						} ?>
					</div>
					<div class="col-md-5 col-sm-12 footer-bottom-right">
							<?php if(is_active_sidebar( 'copy-right')){
								dynamic_sidebar('copy-right');
							}?>
                    </div>
				</div>
			</div>
		</div>
	</footer>
<?php } ?>
</div><!-- .site -->
<?php wp_footer(); ?>

</body>
</html>