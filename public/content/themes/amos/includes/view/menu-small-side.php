<?php global $amos_redata; ?>
    <?php $header_class = $amos_redata['header_style'];?>
<?php $bgCheck = esc_attr(amos_header_bgCheck()); ?>
    <?php 

        if(!empty($amos_redata['header_shapes']))
            $header_shapes = $amos_redata['header_shapes']; ?>

    <?php if($amos_redata['header_style'] == 'header_1' || $amos_redata['header_style'] == 'header_4' || $amos_redata['header_style'] == 'header_5' || $amos_redata['header_style'] == 'header_11' || $amos_redata['header_style'] == 'header_7'){
        if((int) amos_get_post_id() != 0 && function_exists('redux_post_meta'))
            $page_header_menu_color = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'page_header_menu_color');
        else
            $page_header_menu_color = 'light';

        if(isset($page_header_menu_color) && !empty($page_header_menu_color))
            $bgCheck = ($page_header_menu_color =='auto') ? '' : 'background--'.$page_header_menu_color; 
        else
            $bgCheck = 'background--light';
    } 
    ?>
<div class="snap-drawers">
            <div class="snap-drawer snap-drawer-left <?php echo esc_attr($header_class) ?> <?php echo esc_attr($bgCheck) ?>">
                <div class="container">
                    <div class="snap_header">
                    <?php if(!isset($css_class)) $css_class=''; ?>
                                <div id="logo_snap" class="<?php echo esc_attr($css_class) ?>">
                                    <?php echo amos_logo() ?>  
                                </div>

                    <a class="close-sidebar" href="#"><i class="fa fa-times"></i></a>
                    </div>
                    <div class="snap_left_content">

                    <?php if($amos_redata['header_responsive_tools'] && ($amos_redata['show_search'] || class_exists('Woocommerce'))): ?>
                        <!-- Tools -->
                            <div class="header_tools">
                                <div class="vert_mid">
                                <?php if($amos_redata['show_search']): ?>
                                    <div class="search_field">
                                        <?php get_search_form(); ?>
                                    </div>
                                    
                                <?php endif; ?>

                                    <?php if(class_exists('Woocommerce')): ?>
                                    
                                        <?php get_template_part('includes/view/woocommerce', 'cart'); ?>

                                    <?php endif; ?>
 
                                </div>
                            </div>
                        <!-- End Tools-->
                        <?php endif; ?>


                    <?php get_template_part('includes/view/menu', 'small'); ?> 
                


                            <div class="header_widgetized">
                                <?php if(is_active_sidebar('Header Widgetized Area')) dynamic_sidebar('Header Widgetized Area'); ?>
                            </div>

                    
           
                </div>
                </div>
            </div>

            <div class="snap-drawer snap-drawer-right">
                
            </div>

    </div>