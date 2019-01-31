<?php

global $amos_redata;
global $used_for_element;



if(!isset($used_for_element))
    amos_set_portfolio_query(); 

if(have_posts()){
    $item_grid_class = '';
    
    
    ?>
  


<div class="swiper-container">
    <div class="swiper-wrapper">

<?php
    while (have_posts()) : the_post();  
    
        
        $the_id     = get_the_ID();

        $sort_classes = "";
        $item_categories = get_the_terms( $the_id, 'portfolio_entries' );
    
        if(is_object($item_categories) || is_array($item_categories))
        {
            foreach ($item_categories as $cat)
            {
                $sort_classes .= $cat->slug.' ';
            }
        }

        $cats = wp_get_object_terms(get_the_ID(), 'portfolio_entries');
        $link = get_permalink();
        if($amos_redata['single_custom_link_switch'] && !empty($amos_redata['single_custom_link']))
            $link = $amos_redata['single_custom_link'];
    ?>


<?php 
/* if is odd - left column*/
//if ($loop_counter % 2 != 0) :

$img_url=amos_image_by_id(get_post_thumbnail_id(), '', 'url');?>


  
      
    <div class="swiper-slide" style="background-size: cover; background-image:url(<?php echo esc_url($img_url)?>); background-position: center center; height: 100%; width: 100%;" >
        <?php if($amos_redata['portfolio_slider_overlay'] == 1){ ?>
            <div class="overlay"></div>
            <?php }?>
            <div class="container">
            <div class="portfolio_item content <?php echo esc_attr($amos_redata['portfolio_slider_content_position']); ?> <?php echo esc_attr($amos_redata['portfolio_slider_content_color']); ?>" data-animation="fadeInUp" data-id="<?php echo esc_attr(get_the_ID()) ?>"  >

                            
                            <h6  data-animation="fadeInUp" class="a2 animated fadeInUp" ><?php echo esc_attr($sort_classes) ?></h6>
                            <a href="<?php echo esc_url($link) ?>"><h4 data-animation="fadeInUp" class="a1 animated fadeInUp"><?php echo get_the_title() ?></h4></a>
                            <a class="btn-bt a3 animated fadeInUp <?php echo  esc_attr($amos_redata['overall_button_style'][0]) ?>" data-animation="fadeInUp" href="<?php echo esc_url($link) ?>"> <?php echo _e('View Project', 'amos') ?></a>

            </div>
            </div>
    </div>                                        
      

<?php endwhile;  ?>
</div>

    <!-- Add Arrows -->
    <div class="pagination-parent nav-thumbflip nav-slider">
                                    <a class="prev" href="#" >
                                        <span class="icon-wrap"><i class="lnr lnr-chevron-left"></i></span>
                                        
                                    </a>
                                    <a class="next" href="#" >
                                        <span class="icon-wrap"><i class="lnr lnr-chevron-right"></i></span>
                                       
                                    </a>
                                </div>

  </div>





<?php if(!isset($used_for_element)): ?>
    </div>
<?php endif; ?>

<?php } ?>
