<?php

global $amos_redata;
global $used_for_element;



if(!isset($used_for_element))
    amos_set_portfolio_query(); 

if(have_posts()){
    $item_grid_class = '';
    
    
    ?>
    
  

    <?php

    $the_id = 0;
    $loop_counter = 0;
    $loop_id=1;
    $num_incolumn_left=1;
    $num_incolumn_right=1;
    $content_right ='';
    $content_left='';
    ?>


<div id="myContainer" class="portfolio-items split">

<?php
    while (have_posts()) : the_post();  
    
        $loop_counter++;
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

$img_url=amos_image_by_id(get_post_thumbnail_id(), '', 'url');

if($loop_id % 2 == 0){
$content_left .='<div class="portfolio_item section content" id="left'. $num_incolumn_left.'" data-id="'. esc_attr(get_the_ID()) .'"  style="background-image: url('.esc_url($img_url).'); height: 100%;">';
}
else 
$content_left .='<div class="portfolio_item section media" id="left'. $num_incolumn_left.'" data-id="'. esc_attr(get_the_ID()) .'"  style="background-image: url('.esc_url($img_url).'); height: 100%;">';?>


      <?php      if($loop_id % 2 != 0){
            /*$content_left .='<div class="media">
                <img src="'.esc_url(amos_image_by_id(get_post_thumbnail_id(), '', 'url')) .'"  >
                </div>';*/
                ?>

           <?php }
           else {
           $content_left .='<div class="content">
                
                <h6  data-animate="fadeInUp" class="a2">'.esc_attr($sort_classes).'</h6>
                <h4 data-animate="fadeInUp" class="a1">'.get_the_title() .'</h4>
                <a class="btn-bt '.  esc_attr($amos_redata['overall_button_style'][0]) .'" href="'. esc_url($link) .' ">'. __('View Project', 'amos') .'</a>

           </div>';?>

           <?php }
           


$content_left .='</div>';
   
$num_incolumn_left++;

/* if is even - right column*/
//else://right column

if($loop_id % 2 != 0){
$content_right .='<div class="portfolio_item section content" id="left'. $num_incolumn_right.'" data-id="'. esc_attr(get_the_ID()) .'"  style="background-image: url('.esc_url($img_url).'); height: 100%;">';
}
else{
$content_right .='<div class="portfolio_item section media" id="left'. $num_incolumn_right.'" data-id="'. esc_attr(get_the_ID()) .'"  style="background-image: url('.esc_url($img_url).'); height: 100%;">';
}
?>


    <?php 
            if($loop_id % 2 == 0){
            /*$content_right .='<div class="media">
                <img src="'.esc_url(amos_image_by_id(get_post_thumbnail_id(), '', 'url')) .'"  >
            </div>';*/?>

           <?php }
           else {
            $content_right .='<div class="content">
                
                <h6  data-animate="fadeInUp" class="a2">'. esc_attr($sort_classes) .'</h6>
                <h4 data-animate="fadeInUp" class="a1">'. get_the_title() .'</h4>
                <a class="btn-bt '.  esc_attr($amos_redata['overall_button_style'][0]) .'" href="'. esc_url($link) .' ">'. __('View Project', 'amos') .'</a>

           </div>';?>

           <?php }
          //$loop_id = 1; 

    
$content_right .='</div>';
$num_incolumn_right++;
//endif;

$loop_id ++;
?>
     
                             
                                            
                                            
                                                
      

<?php endwhile;  ?>


<?php echo '<div class="left">'.$content_left.'</div>';
echo '<div class="right">'.$content_right.'</div>';?>
</div>


<?php if(!isset($used_for_element)): ?>
    </div>
<?php endif; ?>

<?php } ?>
