<?php
/*
Template Name: Portfolio Page
*/
$amos_redata = amos_redata_variable();

$amos_current_view = amos_rewrite_amos_current_view('portfolio');


$id = amos_get_post_id(); 
if(function_exists('redux_post_meta'))
    $replaced = redux_post_meta('amos_redata',(int) $id);

if(isset($replaced) && !empty($replaced))
    foreach($replaced as $key => $value){
        $amos_redata[$key] = $value;
    }

get_header();
get_template_part('includes/view/page_header');


if($amos_redata['portfolio_mode'] == 'slider'){
    $port_layout = 'fullwidth';
}
else $port_layout = $amos_redata['portfolio_layout'];
?>

<section id="content" class="content_portfolio <?php echo esc_attr($port_layout) ?> layout-<?php echo esc_attr($amos_redata['layout']) ?>">
    
    <?php if($amos_redata['portfolio_content'] == 'top'): ?>
        <?php get_template_part( 'includes/view/loop', 'page' ); ?>
    <?php endif; ?>

    <?php if($port_layout == 'in_container' ): ?>
    <div class="container">
    <?php endif; ?>
    <?php if($amos_redata['portfolio_filters'] == 'normal' && $amos_redata['portfolio_mode'] != 'slider'):?>
        <div class="row-fluid filter-row">
       
			<?php if(!empty($amos_redata['portfolio_categories'])): ?>
                <?php if($port_layout == 'fullwidth'): ?>
                <div >
                <?php endif; ?>
            		<!-- Portfolio Filter -->
                    <?php if($amos_redata['portfolio_pagination'] != 'infinite_scroll' && $amos_redata['portfolio_mode'] != 'parallax' && $amos_redata['portfolio_mode'] != 'slider'){?>
            		<nav id="portfolio-filter" class="control <?php echo esc_attr($amos_redata['filter_align']);?>">
                		<ul class="">
                    		<li class="filter active all" data-filter="all"><a href="#" onclick="return false;" class="filter active" data-filter="all"><?php esc_html_e('View All', 'amos') ?></a></li>
                            
                			<?php foreach($amos_redata['portfolio_categories'] as $cat): ?>
                                <?php $cat = get_term($cat, 'portfolio_entries');

                                    if(isset($cat)):
                                 ?>
                                
                        		              <li class="other filter"  data-filter=".<?php echo esc_attr($cat->slug) ?>"><a href="#" onclick="return false;" class="filter" data-filter=".<?php echo esc_attr($cat->slug) ?>"><?php echo esc_html($cat->name) ?></a></li>

                                     <?php endif; ?>         
                    
                			<?php endforeach; ?>
                		</ul>
            		</nav>

                    <?php }//end if not infinite scroll?>
                    
                <?php if($port_layout == 'fullwidth'): ?>
                </div>
                <?php endif; ?>
    	    <?php endif; ?>
        </div>
     <?php endif; ?>

	    <?php 
	    	
            $grid = 'three-cols';
		    switch($amos_redata['portfolio_columns']){
		        case '3':
		            $grid = 'three-cols';
		            break;
		        case '2':
		            $grid = 'two-cols';
		            break;
		        case '4':
		            $grid = 'four-cols';
		            break;
                case '5':
                    $grid = 'five-cols';
                    break;
		        case '1':
		            $grid = 'one-cols';
		            break;
		    }

    	?>

        <?php if($amos_redata['portfolio_mode'] != 'slider'){?>
        <div class="row-fluid">

        <?php }?>
            <?php if($amos_redata['layout'] == 'sidebar_left') get_sidebar(); ?>

            <?php if($amos_redata['layout'] != 'fullwidth'): ?>
            <div class="span9">
            <?php endif; ?>

                <section id="portfolio-preview-items" class="<?php echo esc_attr($grid) ?> <?php echo esc_attr($amos_redata['portfolio_space']) ?> <?php echo esc_attr($amos_redata['portfolio_mode']);?>" data-cols="<?php echo esc_attr($amos_redata['portfolio_columns']) ?>">
                <?php
                        
                        if($amos_redata['portfolio_mode'] == 'grid')
                            get_template_part('includes/view/portfolio/loop', 'grid');

                        else if($amos_redata['portfolio_mode'] == 'masonry')
                            get_template_part('includes/view/portfolio/loop', 'masonry');

                        else if($amos_redata['portfolio_mode'] == 'pinterest')
                            get_template_part('includes/view/portfolio/loop', 'pinterest');

                        else if($amos_redata['portfolio_mode'] == 'parallax')
                            get_template_part('includes/view/portfolio/loop', 'parallax');
                        else if($amos_redata['portfolio_mode'] == 'split')
                            get_template_part('includes/view/portfolio/loop', 'split');
                        else if($amos_redata['portfolio_mode'] == 'slider')
                            get_template_part('includes/view/portfolio/loop', 'slider');
                        
                       wp_reset_postdata();
                        
                ?>
                </section>
                
            <?php if($amos_redata['layout'] != 'fullwidth' ): ?>
            </div>
            <?php endif; ?>

            <?php if($amos_redata['layout'] == 'sidebar_right') get_sidebar(); ?>

            <?php if($amos_redata['portfolio_mode'] != 'slider'){?>
		      </div>

            <?php }?>
    <?php if($port_layout== 'in_container' ): ?>
	</div>
    <?php endif; ?>
    <?php if($amos_redata['portfolio_content'] == 'bottom'): ?>
        <?php get_template_part( 'includes/view/loop', 'page' ); ?>
    <?php endif; ?>
</section>
<?php get_footer(); ?>