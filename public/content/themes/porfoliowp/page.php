<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); 

$page_spacing             = get_post_meta( get_the_ID(), 'page_spacing',               true );
$breadcrumbs_on_off             = get_post_meta( get_the_ID(), 'breadcrumbs_on_off',               true );

wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
?>

    <!-- HEADER TITLE BREADCRUBS SECTION -->
    <?php 
        if ( function_exists('modeltheme_framework')) {
            if (isset($breadcrumbs_on_off) && $breadcrumbs_on_off == 'yes') {
                echo porfoliowp_header_title_breadcrumbs();
            }
        }else{
            echo porfoliowp_header_title_breadcrumbs();
        }
    ?>

    <!-- Page content -->
    <div id="primary" class="<?php echo esc_attr($page_spacing); ?> content-area no-sidebar">
        <!-- <div class=""> -->
        <div class="container">
            <div class="row">
                <div id="main" class="col-md-12 site-main main-content">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'content', 'page' ); ?>

                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>