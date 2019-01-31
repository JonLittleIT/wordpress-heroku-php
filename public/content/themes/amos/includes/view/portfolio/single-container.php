<?php

global $amos_redata;
do_action('amos_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="container">
    

    <?php if($amos_redata['single_portfolio_content_position_container'] != 'bottom'): ?>
    <div class="row-fluid">
            
        <?php if($amos_redata['single_portfolio_content_position_container'] == 'left'): ?>
            <div class="span3">
                <div class="description">
                    <h4><?php _e('Project Description', 'amos') ?></h4>
                    <?php the_content(); ?>
                </div>
                <div class="details">
                    <h4><?php _e('Project Details', 'amos') ?></h4>

                    <ul class="info">
                        <?php if(!empty($amos_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($amos_redata['single_portfolio_custom_params']); $i++): ?>
                            <?php if(isset($amos_redata['single_portfolio_custom_fields'][$i]) && !empty($amos_redata['single_portfolio_custom_fields'][$i]) ): ?>
                                <li><span class="title"><?php echo esc_attr($amos_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($amos_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                            <?php endif; ?>
                        <?php endfor;  endif; ?>
                        <?php if($amos_redata['portfolio_post_like']): ?>   
                            <li class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></li> 
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?> 

        <div class="span9">
            <div class="media">
                
                <?php if($amos_redata['single_portfolio_media'] == 'featured'): ?>
                    <img src="<?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>" >
                <?php endif; ?>
                <?php 
                    if($amos_redata['single_portfolio_media'] == 'slideshow'): 
                        $slider = new amos_slideshow(get_the_ID(), 'flexslider');
                            $slider->slides = $amos_redata['single_portfolio_gallery'];
                            $slider->slide_number = count($amos_redata['single_portfolio_gallery']);
                            if($slider && $slider->slide_number > 0){  
                                $slider->img_size = '';
                                $sliderHtml = $slider->render_slideshow();
                                echo amos_output($sliderHtml);
                            }
                    endif; 
                ?>
                <?php 
                    if($amos_redata['single_portfolio_media'] == 'video'){
                            $video = ""; 

                            if(amos_backend_is_file( $amos_redata['single_portfolio_video'], 'html5video')){

                                $video = amos_html5_video_embed($amos_redata['single_portfolio_video']);

                            }
                            else if(strpos($amos_redata['single_portfolio_video'],'<iframe') !== false)
                            {
                                $video = $amos_redata['single_portfolio_video'];
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($amos_redata['single_portfolio_video'])."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url($amos_redata['single_portfolio_video']).'"></iframe>';
                            } 

                            echo amos_output($video);               
                    }
                ?>
            </div>
        </div>

        <?php if($amos_redata['single_portfolio_content_position_container'] == 'right'): ?>
            <div class="span3">
                <div class="description">
                    <h4><?php _e('Project Description', 'amos') ?></h4>
                    <?php the_content(); ?>
                </div>
                <div class="details">
                    <h4><?php _e('Project Details', 'amos') ?></h4>

                    <ul class="info">
                        <?php if(!empty($amos_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($amos_redata['single_portfolio_custom_params']); $i++): ?>
                            <?php if(isset($amos_redata['single_portfolio_custom_fields'][$i]) && !empty($amos_redata['single_portfolio_custom_fields'][$i]) ): ?>
                                <li><span class="title"><?php echo esc_attr($amos_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($amos_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                            <?php endif; ?>
                        <?php endfor;  endif; ?>
                        <?php if($amos_redata['portfolio_post_like']): ?>   
                            <li class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></li> 
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?> 
    </div>
    <?php endif; ?>

    <?php if($amos_redata['single_portfolio_content_position_container'] == 'bottom'): ?>
    <div class="media">
        <?php if($amos_redata['single_portfolio_media'] == 'featured'): ?>
            <img src="<?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>"  >
        <?php endif; ?>
        <?php 
            if($amos_redata['single_portfolio_media'] == 'slideshow'): 
                $slider = new amos_slideshow(get_the_ID(), 'flexslider');
                    $slider->slides = $amos_redata['single_portfolio_gallery'];
                    $slider->slide_number = count($amos_redata['single_portfolio_gallery']);
                    if($slider && $slider->slide_number > 0){  
                        $slider->img_size = 'amos_blog';
                        $sliderHtml = $slider->render_slideshow();
                        echo amos_output($sliderHtml);
                    }
            endif; 
        ?>
        <?php 
                    if($amos_redata['single_portfolio_media'] == 'video'){
                            $video = ""; 

                            if(amos_backend_is_file( $amos_redata['single_portfolio_video'], 'html5video')){

                                $video = amos_html5_video_embed($amos_redata['single_portfolio_video']);

                            }
                            else if(strpos($amos_redata['single_portfolio_video'],'<iframe') !== false)
                            {
                                $video = $amos_redata['single_portfolio_video'];
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($amos_redata['single_portfolio_video'])."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url($amos_redata['single_portfolio_video']).'"></iframe>';
                            } 

                            echo amos_output($video);               
                    }
        ?>

    </div>
    <div class="row-fluid content"> 
        <div class="span9">
            <h4><?php _e('Project Description', 'amos') ?></h4>
            <?php the_content(); ?>
        </div>
        <div class="span3">
            <h4><?php _e('Project Details', 'amos') ?></h4>

            <ul class="info">
                <?php if(!empty($amos_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($amos_redata['single_portfolio_custom_params']); $i++): ?>
                    <?php if(isset($amos_redata['single_portfolio_custom_fields'][$i]) && !empty($amos_redata['single_portfolio_custom_fields'][$i]) ): ?>
                        <li><span class="title"><?php echo esc_attr($amos_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($amos_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                    <?php endif; ?>
                <?php endfor;  endif; ?>
                <?php if($amos_redata['portfolio_post_like']): ?>   
                    <li class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></li> 
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

     <div class="nav-growpop">
            <?php if(is_object(get_previous_post())): ?>
            <a class="prev" href="<?php echo esc_url(get_permalink(get_previous_post()->ID)); ?>">
                <span class="icon-wrap"><i class="icon-angle-left"></i></span>
                <div>
                    <h6><?php echo _e('Previous Work', 'amos')?></h6>
                    <h3><?php echo esc_html(get_previous_post()->post_title); ?></h3>
                    <img src="<?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(get_previous_post()->ID), 'amos_port3', 'url')) ?>" alt="<?php esc_attr_e('Previous thumb', 'amos') ?>"/>
                </div>
            </a>

            <?php endif; ?>
            <?php if(is_object(get_next_post())): ?>
            <a class="next" href="<?php echo esc_url(get_permalink(get_next_post()->ID)); ?>">
                
                <div>
                    <h6><?php echo _e('Next Work', 'amos')?></h6>
                    <h3><?php echo esc_html(get_next_post()->post_title); ?></h3>
                    <img src="<?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(get_next_post()->ID), 'amos_port3', 'url')) ?>" alt="<?php esc_attr_e('Next thumb', 'amos') ?>"/>
                </div>
                <span class="icon-wrap"><i class="icon-angle-right"></i></span>
            </a>
            <?php endif; ?> 
        </div>

    <?php if($amos_redata['single_portfolio_active_comments']) comments_template( '/includes/view/blog/comments.php');  ?>
</div>