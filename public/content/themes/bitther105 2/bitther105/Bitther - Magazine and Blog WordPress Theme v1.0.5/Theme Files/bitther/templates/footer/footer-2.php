<?php  if(is_active_sidebar( 'footer-top2' )){ ?>
<div class="footer-top footer-top2">
	<div class="container">
		<div class="row">
			<?php if(is_active_sidebar( 'footer-top2')){
				dynamic_sidebar('footer-top2');
			}?>
		</div>
	</div>
</div>
<?php } ?>
<?php  if(is_active_sidebar( 'footer-bottom2' )){ ?>
<div class="footer-bottom footer-bottom2">
	<div class="container">
		<div class="row">
			<?php dynamic_sidebar('footer-bottom2'); ?>
		</div>
	</div>
</div>
<?php } ?>
