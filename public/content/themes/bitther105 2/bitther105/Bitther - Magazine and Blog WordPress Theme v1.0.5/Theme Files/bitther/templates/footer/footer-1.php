
<div class="footer-top">
	<div class="container">
		<div class="container-inner">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<?php if(is_active_sidebar( 'footer-top1')){
						dynamic_sidebar('footer-top1');
					}?>
				</div>
				<div class="col-md-3 col-sm-6">
					<?php if(is_active_sidebar( 'footer-bottom1')){
						dynamic_sidebar('footer-bottom1');
					}?>
				</div>
				<div class="col-md-3 col-sm-6">
					<?php if(is_active_sidebar( 'footer-top2')){
						dynamic_sidebar('footer-top2');
					}?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php  if(is_active_sidebar( 'footer-center' )){ ?>
<div class="footer-center">
	<div class="container">
		<div class="row">
			<?php dynamic_sidebar('footer-center'); ?>
		</div>
	</div>
</div>
<?php } ?>
