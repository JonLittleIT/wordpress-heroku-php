<?php
$amos_redata = amos_redata_variable();

$amos_current_view = amos_rewrite_amos_current_view('blog');

$spancontent = 12;


if($amos_redata['bloglayout'] == 'fullwidth')
    $spancontent = 12;
else
    $spancontent = 9;

$blog_page = $amos_redata['blogpage'];

get_header();

?>
 
<?php $blog_style = $amos_redata['blog_style']; ?>

<?php get_template_part('includes/view/page_header'); ?>

<section id="content" class="<?php echo esc_attr($amos_redata['bloglayout']) ?>">
        
        <div class="container" id="blog">
            <div class="row">

            <?php if($amos_redata['bloglayout'] == 'sidebar_left') get_sidebar() ?>   

                <div class="span<?php echo esc_attr($spancontent) ?>">
                <?php
                    if(have_posts()):
                        if($blog_style == 'grid')
                            get_template_part( 'includes/view/blog/loop', 'grid' ); 
                        elseif($blog_style == 'alternate')
                            get_template_part( 'includes/view/blog/loop', 'second-style' );
                        elseif($blog_style == 'timeline')
                            get_template_part( 'includes/view/blog/loop', 'timeline' );
                        else
                            get_template_part( 'includes/view/blog/loop', 'index' );
                    else:       
                ?>
                    <h3 style="font-weight:normal;"><?php esc_html_e('Your search did not match any entries', 'amos') ?></h3>
                    <p></p>
                    <p><?php esc_html_e('Suggestions', 'amos') ?>:</p>
                    <ul style="margin-left:40px">
                        <li><?php esc_html_e('Make sure all words are spelled correctly', 'amos') ?>.</li>
                        <li><?php esc_html_e('Try different keywords', 'amos') ?>.</li>
                        <li><?php esc_html_e('Try more general keywords', 'amos') ?>.</li>
                    </ul>
                    <p><?php get_search_form(); ?></p>
                <?php endif; ?>

                </div>

            <?php wp_reset_postdata(); ?> 

            <?php if($amos_redata['bloglayout'] == 'sidebar_right') get_sidebar() ?>  

            </div>
        </div> 
        

        

</section>
<?php get_footer(); ?>