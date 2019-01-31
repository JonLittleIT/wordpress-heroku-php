<?php
$amos_redata = amos_redata_variable();

get_header();

get_template_part('includes/view/page_header');

?>

   
<section id="content"  style="background-color:<?php echo (!empty($amos_redata['page_content_background']))?esc_attr($amos_redata['page_content_background']):'#ffffff'; ?>;">

<?php if(have_posts()){ 

    while (have_posts()) : the_post(); ?>
        
        <div class="row-fluid">
            
            <div class="portfolio_single single_portfolio_<?php echo esc_attr($amos_redata['single_portfolio_style']) ?> <?php echo esc_attr($amos_redata['single_portfolio_layout']) ?>_layout" data-id="<?php echo esc_attr(get_the_ID()) ?>">
                
                <?php if(empty($amos_redata['single_portfolio_style']) ):
                    $amos_redata['single_portfolio_style'] = 'container';
                    $amos_redata['single_portfolio_content_position_container'] = 'bottom';
                endif; ?>    

            <?php if($amos_redata['single_portfolio_layout'] == 'custom'):?>
                <?php get_template_part('includes/view/portfolio/single', 'custom');  ?>    
            <?php else: ?>
                <?php get_template_part('includes/view/portfolio/single', $amos_redata['single_portfolio_style']);  ?>    
            <?php endif; ?>  

            </div>
        
        </div>

        

<?php endwhile; } ?>

       
                 
</section><!-- #content -->   

<?php get_footer() ?>