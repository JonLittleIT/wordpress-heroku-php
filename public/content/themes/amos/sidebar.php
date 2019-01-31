<?php

$amos_redata = amos_redata_variable();

$amos_current_view = amos_current_view();

$sidebar_style = "";

if(isset($amos_redata['layout']) &&  $amos_redata['layout'] != 'fullwidth' || $amos_redata['bloglayout'] != 'fullwidth' || $amos_redata['singlebloglayout'] != 'fullwidth'): ?>

   
    <aside class="span3 sidebar" id="widgetarea-sidebar">

        <?php
        if( (!empty($amos_redata['overwrite_layout']) && $amos_redata['layout'] != 'dual' ) || empty($amos_redata['overwrite_layout']) ){
            if ( ($amos_current_view == 'blog' || $amos_current_view == 'single_blog') && is_active_sidebar( 'sidebar-blog' ) )
                dynamic_sidebar( 'sidebar-blog' );
            
            if ($amos_current_view == 'portfolio' && is_active_sidebar( 'sidebar-portfolio' ))
                dynamic_sidebar( 'sidebar-portfolio' );

            if ($amos_current_view == 'page' && is_active_sidebar( 'sidebar-pages' ) && dynamic_sidebar( 'sidebar-pages' )) : $use_default = false; endif;

            if ($amos_current_view == 'woocommerce' && is_active_sidebar( 'woocommerce' ) && dynamic_sidebar( 'woocommerce' )) : $use_default = false; endif;

            $page_title = amos_check_custom_sidebar('page');

            if (function_exists('dynamic_sidebar') && dynamic_sidebar(esc_html__('Page','amos').': '.$page_title) ) : $use_defailt = false; endif;

            $cat_title = amos_check_custom_sidebar('cat');

            if (function_exists('dynamic_sidebar') && dynamic_sidebar(esc_html__('Category','amos').': '.$cat_title) ) : $use_defailt = false; endif;
        }else if($amos_redata['overwrite_layout'] && $amos_redata['layout'] == 'dual' && is_active_sidebar($amos_redata['left_sidebar_dual'])){
                dynamic_sidebar($amos_redata['left_sidebar_dual']);
        }
        


        ?>

    </aside>



<?php endif; ?>

