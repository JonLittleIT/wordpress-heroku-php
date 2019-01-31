<?php

global $amos_redata;
global $used_for_element;

$columns = (isset($used_for_element)) ? $used_for_element['columns'] : $amos_redata['portfolio_columns'];
$sidebar = $amos_redata['layout'];
$style = (isset($used_for_element)) ? $used_for_element['style'] : $amos_redata['portfolio_style'];

$extra_class = '';
if(isset($used_for_element) && $used_for_element['carousel'] == 'yes')
    $extra_class .= ' item';

if(!isset($used_for_element))
    amos_set_portfolio_query(); 

if(have_posts()){
    
     
    ?>


    <?php

    $the_id = 0;
    $loop_counter = 1;
    $effects ='';
    $odd_even='';
    ?>

<div class="parallax-img-container">
<?php
    while (have_posts()) : the_post();  
    

        $the_id     = get_the_ID();

        $sort_classes = "";
        $item_categories = get_the_terms( $the_id, 'portfolio_entries' );
    
        if(is_object($item_categories) || is_array($item_categories))
        {
            $c='';
            $cats='';
            foreach ($item_categories as $cat)
            {
                $sort_classes .= $cat->slug.' ';
                $c = get_category( $cat );
                $cats .= ' <a href='.get_term_link($c->cat_ID, 'portfolio_entries').'>'.$c->name.'</a> ';
            }
        }

        //$cats = substr(trim($cats), 0, -1);
            
       
        

        //$cats = wp_get_object_terms(get_the_ID(), 'portfolio_entries');
        $link_port = get_permalink();
        if($amos_redata['single_custom_link_switch'] && !empty($amos_redata['single_custom_link']))
            $link_port = $amos_redata['single_custom_link'];

        
        $type_media='';
        if($amos_redata['single_portfolio_media'] == 'video'){
            $type_media='video';
        }

    ?>
      


    <div class="row-fluid ">
<?php if ($loop_counter % 2 == 0) : ?>
    <?php $effects='data-parallax=\'{"y": -150, "smoothness": 20}\'';
    $odd_even='even';
    ?>
   


<?php else:
$effects='data-parallax=\'{"y": -100, "smoothness": 40}\'';
 $odd_even='odd';
?>
<?php endif;?>


    <div class="span12">
       
                            <div class=' portfolio-item mix <?php echo esc_attr($sort_classes) ?> <?php echo esc_attr($extra_class) ?>  parallax <?php echo esc_attr($odd_even);?> <?php echo esc_attr($type_media) ?> " data-id="<?php echo esc_attr(get_the_ID()) ?>' <?php echo amos_output($effects);?> >
                                  

                            <?php if($amos_redata['single_portfolio_media'] == 'video'){

                                    $video = ""; 

                                    $link = $amos_redata['single_portfolio_video'];


                                    if (strpos($link, 'youtube') !== false || strpos($link, 'youtu.be') !== false) {
                                       
                                        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $link, $matches);
                                        $video_id=$matches[1];
                                        $video= '<div data-type="youtube" data-video-id="'.$video_id.'"></div>';
                                    }

                                    else if (strpos($link, 'vimeo') !== false) {
                                        
                                        $urlParts = explode("/", parse_url($link, PHP_URL_PATH));
                                        $video_id = (int)$urlParts[count($urlParts)-1];
                                        $video= '<div data-type="vimeo" data-video-id="'.$video_id.'"></div>';
                                    }

                                    else if(strpos($link, 'webm') !== false || strpos($link, 'mp4') !== false){

                                            $video= amos_html5_video_embed($link);
                                            
                                        
                                               
                                    }

                                    


                                    /*if(amos_backend_is_file( $link, 'html5video')){

                                        $video = amos_html5_video_embed($link);

                                    }
                                    else if(strpos($link,'<iframe') !== false)
                                    {
                                        $video = $link;
                                    }
                                    else
                                    {
                                        global $wp_embed;
                                        $video = $wp_embed->run_shortcode("[embed]".trim($link)."[/embed]");
                                    }

                                    if(strpos($video, '<a') === 0)
                                    {
                                        $video = '<iframe src="'.esc_url($link).'"></iframe>';
                                    } */

                                    echo amos_output($video);


                             }
                             else {?>

                              <img  src="<?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>"    >

                              <?php }?>


                                   <div class="content_box parallax-move" > </div> 
                                       <div class="content parallax-move" >

                                       <?php 
                                           if($amos_redata['portfolio_overlay_style']== 'background')
                                           $overlay='bg ';
                                           else if($amos_redata['portfolio_overlay_style']== 'gradient')
                                            $overlay='bg gradient ';
                                        ?>
                                            <div class=" a0">
                                              
                                                    
                                                   
                                                        <h3 data-animate="fadeInUp" class="a1"><?php echo get_the_title() ?></h3>
                                                        <p  data-animate="fadeInUp" class="a2"><?php echo amos_output($cats) ?></p>
                                                        <a href="<?php echo esc_url($link_port) ?>" target="_blank" class="btn-bt <?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>"><?php _e('View Case Study', 'amos') ?></a>

                                            </div>
                                             
                                      
                                            
                                            
                                                
                                     </div>      
                                         
                        </div>
                    
    </div>

   
   
    </div>
      


<?php         $loop_counter++; endwhile;  ?>
</div>

<?php } ?>

