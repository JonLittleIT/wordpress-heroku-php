<?php

$amos_redata = amos_redata_variable();
do_action( 'amos_routing_template' , 'page' );
$amos_current_view = amos_rewrite_amos_current_view('page');
$id = amos_get_post_id(); 
if(function_exists('redux_post_meta'))
    $replaced = redux_post_meta('amos_redata',(int) $id);

if(isset($replaced) && !empty($replaced))
    foreach($replaced as $key => $value){
        $amos_redata[$key] = $value;
    }
$layout = $amos_redata['page_overall_layout'];
if(isset($amos_redata['overwrite_layout']) && $amos_redata['overwrite_layout'])
    $layout = $amos_redata['layout'];

if($layout == 'fullwidth')
    $spancontent = 12;
else if($layout == 'dual')
    $spancontent = 6;
else
    $spancontent = 9;


get_header();

get_template_part('includes/view/page_header'); 


?>

<?php if(empty($amos_redata['fullscreen_sections_active'])): ?>    
    
<section id="content" class="composer_content" style="background-color:<?php echo (!empty($amos_redata['page_content_background']))?esc_attr($amos_redata['page_content_background']):'#ffffff'; ?>;">
        <?php if($spancontent != 12 || !is_vc()){ ?>
        <div class="container <?php  echo esc_attr($layout) ?>" id="blog">
            <div class="row">
            <?php if($layout == 'sidebar_left' || $layout == 'dual') get_sidebar() ?>   
                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php get_template_part( 'includes/view/loop', 'page' ); ?>
                    <!--heck if page has comments-->
                    <?php if (comments_open()):?>
                        <div class="comments">
                        <?php comments_template( '/includes/view/blog/comments.php');  ?>
                        </div>
                        
                    <?php endif;?>
                </div>
                <?php
                
               wp_reset_postdata();    
    
                if($layout == 'sidebar_right' || $layout == 'dual') if($layout != 'dual') get_sidebar(); else get_sidebar('dual');

                ?>

            </div>
        </div>
        <?php }else{ ?>

            <?php get_template_part( 'includes/view/loop', 'page' ); wp_reset_postdata(); ?>            
             
        <?php } ?>



</section>

<?php else: ?>
    
    <div id="fullpage">
        <?php get_template_part( 'includes/view/loop', 'page' ); wp_reset_postdata(); ?>
    </div>
   <?php echo paginate_links(); ?>

<?php endif; ?>



<?php get_footer(); ?>