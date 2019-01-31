<?php

 $amos_redata = amos_redata_variable();

$amos_current_view =  amos_current_view();
global $woocommerce_loop;
$extra_class ='';
$id = amos_get_post_id(); 

if(function_exists('redux_post_meta'))
    $replaced = redux_post_meta('amos_redata',(int) $id);

if(isset($replaced) && !empty($replaced))
    foreach($replaced as $key => $value){
        $amos_redata[$key] = $value;
    }

do_action( 'amos_routing_template' , 'page' );
$amos_current_view = 'woocommerce';
$layout = $amos_redata['page_overall_layout'];
if(isset($amos_redata['shop_layout']) && $amos_redata['shop_layout'])
    $layout = $amos_redata['shop_layout'];
if($layout == 'fullwidth' || is_product()){
    $spancontent = 12;
    $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 4);
}
else if($layout == 'dual'){
    $spancontent = 6;
    $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 2);
}
else{
    $spancontent = 9;
    $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 3);
}


get_header(); 

get_template_part('includes/view/page_header'); ?>
        
<?php if($spancontent != 12) $extra_class .= ' with_sidebar'; ?>
<section id="content" class="composer_content <?php echo esc_attr($extra_class) ?>" style="background-color:<?php echo (!empty($amos_redata['page_content_background']))?esc_attr($amos_redata['page_content_background']):'#ffffff'; ?>;">
        <div class="container <?php  echo esc_attr($amos_redata['layout']); ?>" id="blog">
            <div class="row">
            <?php if($layout == 'sidebar_left' || $layout == 'dual') get_sidebar() ?>  
                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php amos_woocommerce_content() ?> 

                </div>
                <?php
                
                wp_reset_postdata();
    
                if($layout == 'sidebar_right' || $layout == 'dual') if($layout != 'dual') get_sidebar(); else get_sidebar('dual'); ?>

            </div>
        </div>
</section>

<?php get_footer(); ?>