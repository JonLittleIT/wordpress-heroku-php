
<?php

$amos_redata = amos_redata_variable();
wp_reset_postdata();

if(function_exists('redux_post_meta'))
    $fullscreen_post_style = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'fullscreen_post_style');
else
    $fullscreen_post_style = '0';

?>

   

<?php // TOP wapper closed ?> 

<?php if((int) amos_get_post_id() && function_exists('redux_post_meta') && !redux_post_meta('amos_redata',(int) amos_get_post_id(), 'fullscreen_post_style')): ?>
</div>
<?php endif;?>
<!-- Footer -->
 <a href="#" class="scrollup"><?php esc_html_e('Scroll', 'amos') ?></a> 
    <div class="footer_wrapper <?php if(isset($amos_redata['reveal_footer']) && $amos_redata['reveal_footer'] == 1)  echo " fixed_footer"; ?>">
      
        <footer id="footer" class="">

            
            <?php if($amos_redata['show_footer'] && is_active_sidebar('footer-column-1') || is_active_sidebar('footer-column-2') || is_active_sidebar('footer-column-3') || is_active_sidebar('footer-column-4') || is_active_sidebar('footer-column-5') ): ?>


        	<div class="inner">
            <?php if(!$amos_redata['footer_container_full']): ?>
            <div class="container">
            <?php endif; ?>

            <?php if(isset($amos_redata['center_footer']) && $amos_redata['center_footer'])
                $centered_class= 'center_content';
                else
                $centered_class= ''; 
            
            ?>
    	        	<div class="row-fluid ff <?php echo esc_attr($centered_class);?>">
                    	<!-- widget -->
    		        	<?php
                        
                        $columns = esc_attr($amos_redata['footer_columns']);
                        $spans=array(3,2,2,2,3);

                        for($i = 1; $i <= $columns; $i++): ?>
                        <?php if($amos_redata['footer_columns'] == 5){?>
                        <div class="span<?php echo esc_attr($spans[$i-1]); ?>">

                        <?php } else {?>

                            <div class="span<?php echo 12/esc_attr($columns) ?>">
                            <?php } ?>

                                <?php if (is_active_sidebar('footer-column-'.$i)): 

                                        dynamic_sidebar('Footer - column'.$i);

                                endif; ?>
                                
                            </div>
                        <?php endfor; ?>
    	            </div>

    	        <?php if(!$amos_redata['footer_container_full']): ?>
            </div>  
            <?php endif; ?>

            <?php if(isset($amos_redata['footer_background_color']['background-image']) && $amos_redata['footer_background_color']['background-color']): ?>
                <?php $rgb_color = amos_hexToRgb($amos_redata['footer_background_color']['background-color']);  ?>
                <div class="bg-overlay" style="background:rgba(<?php echo esc_attr($rgb_color['r']) ?>, <?php echo esc_attr($rgb_color['g']) ?>, <?php echo esc_attr($rgb_color['b']) ?>, 0.88)"></div>
             <?php endif; ?> 

            </div>
            <?php endif; ?>

            <?php if($amos_redata['show_copyright']): ?>
            <div id="copyright">
    	    	<?php if(!$amos_redata['footer_container_full']): ?>
            <div class="container">
            <?php endif; ?>
    	        	<div class="row-fluid">
    		        	<div class="span12 desc"><div class="copyright_text"><?php echo wp_kses_data($amos_redata['copyright_text'], '', ''); ?></div>
                            <?php if(is_active_sidebar('copyright')): ?>
                            <div class="pull-right">
                               <?php dynamic_sidebar('copyright'); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                
                <?php if(!$amos_redata['footer_container_full']): ?>
            </div>  
            <?php endif; ?>

            </div><!-- #copyright -->
            <?php endif; ?>
        </footer>

    </div>
    <!-- #footer -->

<?php if($amos_redata['site_layout'] == 'boxed'): ?> 
</div>
<?php endif; ?>
</div>
<?php wp_footer(); ?>


<!-- Snap Drawer -->
<!--</div>-->
<!-- Snap Drawer -->
</body>
</html>