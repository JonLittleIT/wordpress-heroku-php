<?php

$amos_redata = amos_redata_variable(); 
$amos_current_view = amos_rewrite_amos_current_view('single_blog');

$spancontent = 12;

$layout = $amos_redata['singlebloglayout'];

if(isset($amos_redata['overwrite_layout']) && $amos_redata['overwrite_layout'])
    $layout = $amos_redata['layout'];

if($amos_redata['blog_post_style'] == 'creative')
    $layout='fullwidth';

if($layout == 'fullwidth' || $amos_redata['blog_post_style'] == 'creative')
    $spancontent = 12;
else if($layout == 'dual')
    $spancontent = 6;
else
    $spancontent = 9;


$blog_page = $amos_redata['blogpage'];

get_header();


?>
   
<?php if($amos_redata['blog_post_style'] != 'creative') get_template_part('includes/view/page_header'); ?>
<?php if($amos_redata['blog_post_style'] != 'creative'): ?>
<section id="content" class="<?php echo esc_attr($layout) ?>"  style="background-color:<?php echo (!empty($amos_redata['page_content_background']))?esc_attr($amos_redata['page_content_background']):'#ffffff'; ?>;">
        
        <div class="container" id="blog">
            <div class="row">

            <?php if($layout == 'sidebar_left' || $layout == 'dual') get_sidebar() ?>    

                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php    get_template_part( 'includes/view/blog/loop', 'index' );?>

                    

                
                    <?php comments_template( '/includes/view/blog/comments.php');  ?>
                </div>

         

            <?php if($layout == 'sidebar_right' || $layout == 'dual') if($layout != 'dual' ) get_sidebar(); else get_sidebar('dual'); ?>   
            </div>

        </div>
            
            
        
        
                         

</section>
<?php endif; ?>

<?php if($amos_redata['blog_post_style'] == 'creative'):
    get_template_part( 'includes/view/blog/single', 'creative'); ?>
<?php endif; ?>

<?php wp_reset_postdata(); ?> 

                        <?php if($amos_redata['related_posts']== 1){
                        get_template_part( 'includes/view/blog/related', 'posts');
                        }?>

                        
                        <?php if($amos_redata['blog_post_style'] == 'creative'):
                        comments_template( '/includes/view/blog/comments.php');
                        endif; ?>
                        
            

<?php get_footer(); ?>