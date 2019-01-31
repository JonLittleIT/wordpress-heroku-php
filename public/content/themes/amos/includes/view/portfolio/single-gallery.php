<?php

global $amos_redata;
do_action('amos_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="container">
    <div class="gallery row">
        <?php if(!empty($amos_redata['single_portfolio_gallery'])): foreach($amos_redata['single_portfolio_gallery'] as $slide): ?>
        <a class="lightbox-gallery" href="<?php echo esc_url($slide['image']) ?>" >
            <div class="visual lightbox">
                <img src="<?php echo esc_url(amos_image_by_id($slide['attachment_id'], 'port3', 'url'))  ?>" >
                <span class="moon-zoom"></span>
            </div>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>
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