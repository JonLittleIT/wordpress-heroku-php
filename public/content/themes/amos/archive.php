<?php
/*
Template Name: Archive
*/

$amos_redata = amos_redata_variable();

global $amos_redata;
$amos_current_view = amos_rewrite_amos_current_view('blog');

$id = amos_get_post_id(); 
if(function_exists('redux_post_meta'))
    $replaced = redux_post_meta('amos_redata',(int) $id);

if(isset($replaced) && !empty($replaced))
    foreach($replaced as $key => $value){
        $amos_redata[$key] = $value;
    }
$spancontent = 9;

if($amos_redata['bloglayout'] == 'fullwidth')
    $spancontent = 12;
else
    $spancontent = 9;

$blog_page = $amos_redata['blogpage'];

get_header();
?>
 
<?php $blog_style = $amos_redata['blog_style']; ?>
   
<?php get_template_part('includes/view/page_header');
?>
    
<section id="content" class="<?php echo esc_attr($amos_redata['bloglayout']) ?>"  style="background-color:<?php echo (!empty($amos_redata['page_content_background']))?esc_attr($amos_redata['page_content_background']):'#ffffff'; ?>;">
        <div class="container" id="blog">
            <div class="row">

            <?php if($amos_redata['bloglayout'] == 'sidebar_left') get_sidebar() ?>   

                <div class="span<?php echo esc_attr($spancontent) ?>">
                <?php
                    if($blog_style == 'grid')
                        get_template_part( 'includes/view/blog/loop', 'grid' ); 
                    elseif($blog_style == 'alternate')
                        get_template_part( 'includes/view/blog/loop', 'second-style' );
                    elseif($blog_style == 'masonry')
                        get_template_part( 'includes/view/blog/loop', 'masonry' );
                    elseif($blog_style == 'timeline')
                        get_template_part( 'includes/view/blog/loop', 'timeline' );
                    else
                        get_template_part( 'includes/view/blog/loop', 'index' );
                ?>

            </div>

            <?php wp_reset_postdata(); ?> 

            <?php if($amos_redata['bloglayout'] == 'sidebar_right') get_sidebar() ?>  

            </div>
        </div>
</section>

<?php get_footer(); ?>