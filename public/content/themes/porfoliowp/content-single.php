<?php
/**
* Content Single
*/
$prev_post = get_previous_post();
$next_post = get_next_post();

$breadcrumbs_on_off = get_post_meta( get_the_ID(), 'breadcrumbs_on_off', true );

// BEGIN_WP5
$select_post_layout = get_post_meta( get_the_ID(), 'select_post_layout', true );
$select_post_sidebar = get_post_meta( get_the_ID(), 'select_post_sidebar', true );


$sidebar = 'sidebar-1';
if ( function_exists('modeltheme_framework')) {
    if (isset($select_post_sidebar) && $select_post_sidebar != '') {
        $sidebar = $select_post_sidebar;
    }else{
        $sidebar = porfoliowp_redux('mt_single_blog_layout_sidebar');
    }
}


$cols = 'col-md-12 col-sm-12';
$sidebars_lr_meta = array("left-sidebar", "right-sidebar");
if (isset($select_post_layout) && in_array($select_post_layout, $sidebars_lr_meta)) {
    $cols = 'col-md-8 col-sm-8 status-meta-sidebar';
}elseif(isset($select_post_layout) && $select_post_layout == 'no-sidebar'){
    $cols = 'col-md-12 col-sm-12 status-meta-fullwidth';
}else{
    if(class_exists( 'ReduxFrameworkPlugin' )){
        $sidebars_lr_panel = array("mt_single_blog_left_sidebar", "mt_single_blog_right_sidebar");
        if (in_array(porfoliowp_redux('mt_single_blog_layout'), $sidebars_lr_panel)) {
            $cols = 'col-md-8 col-sm-8 status-panel-sidebar';
        }else{
            $cols = 'col-md-12 col-sm-12 status-panel-no-sidebar';
        }
    }
}
if (!is_active_sidebar($sidebar)) {
    $cols = "col-md-12";
}
// END_WP5
?>




<!-- HEADER TITLE BREADCRUBS SECTION -->
<?php 
if ( function_exists('modeltheme_framework')) {
    if (isset($breadcrumbs_on_off) && $breadcrumbs_on_off == 'yes' || $breadcrumbs_on_off == '') {
        echo porfoliowp_header_title_breadcrumbs();
    }
}else{
    echo porfoliowp_header_title_breadcrumbs();
}
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('post high-padding'); ?>>
    <div class="container">
       <div class="row">

            <?php // BEGIN_WP5 ?>
            <?php if (isset($select_post_layout) && $select_post_layout == 'left-sidebar') { ?>
                <div class="col-md-4 col-sm-4 sidebar-content sidebar-left">
                    <?php if (is_active_sidebar($sidebar)) { ?>
                        <?php dynamic_sidebar($sidebar); ?>
                    <?php } ?>
                </div>
            <?php }else{ ?>
                <?php if (isset($select_post_layout) && $select_post_layout == 'inherit') { ?>
                    <?php if(class_exists( 'ReduxFrameworkPlugin' )){ ?>
                        <?php if ( porfoliowp_redux('mt_single_blog_layout') == 'mt_single_blog_left_sidebar') { ?>
                            <div class="col-md-4 col-sm-4 sidebar-content sidebar-left">
                                <?php if (is_active_sidebar($sidebar)) { ?>
                                    <?php dynamic_sidebar($sidebar); ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <?php // END_WP5 ?>

            <!-- POST CONTENT -->
            <div class="<?php echo esc_attr($cols); ?> main-content">
                
                <!-- HEADER -->
                <div class="article-header">
                    <div class="article-details">

                        <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'porfoliowp_single_article_1150x400' ); 
                        if($thumbnail_src) { ?>
                            <?php the_post_thumbnail( 'porfoliowp_single_article_1150x400' ); ?>
                        <?php } ?>
                        <div class="clearfix"></div>

                        <div class="post-category-comment-date row">
                            <span class="post-date">
                                <i class="icon-calendar"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="post-categories">
                                <?php echo get_the_term_list( get_the_ID(), 'category', '<i class="icon-tag"></i>', ', ' ); ?>
                            </span>
                            <span class="post-author">
                                <i class="icon-user icons"></i>
                                <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php echo get_the_author(); ?></a>
                            </span>
                            <span class="post-comments">
                                <i class="icon-bubbles icons"></i>
                                <a href="<?php echo the_permalink().'#comments'; ?>"><?php comments_number( '0', '1', '%' ); ?></a>
                            </span>  
                        </div>

                    </div>
                </div>
                <!-- CONTENT -->
                <div class="article-content">
                    <?php the_content(); ?>
                    <div class="clearfix"></div>

                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_attr__( 'Pages:', 'porfoliowp' ),
                            'after'  => '</div>',
                        ) );
                    ?>
                    <div class="clearfix"></div>

                    <?php if (get_the_tags()) { ?>
                        <div class="single-post-tags">
                            <span><?php echo esc_attr__('Tags:','porfoliowp'); ?></span> <?php echo get_the_term_list( get_the_ID(), 'post_tag', '', ' ' ); ?>
                        </div>
                    <?php } ?>

                    <div class="clearfix"></div>
                  




                    

                    <!-- AUTHOR BIO -->
                    <?php if ( porfoliowp_redux('mt_enable_authorbio') ) { ?>

                        <?php   
                        $avatar = get_avatar( get_the_author_meta('email'), '80', get_the_author() );
                        $has_image = '';
                        if( $avatar !== false ) {
                            $has_image .= 'no-author-pic';
                        }
                        ?>
                        
                        <div class="author-bio relative <?php echo esc_attr($has_image); ?>">
                            <div class="author-thumbnail col-md-4">
                                <?php
                                if( $avatar !== false ) {
                                    echo wp_kses_post($avatar); 
                                }
                                ?>
                                <div class="pull-left">
                                    <div class="author-name">
                                        <span><?php echo esc_attr__('Written by','porfoliowp'); ?></span>
                                        <span class="name"><?php echo get_the_author(); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="author-thumbnail col-md-8">
                                <div class="author-biography"><?php the_author_meta('description'); ?></div>
                            </div>
                        </div>
                    <?php } ?>


                    <div class="clearfix"></div>

                    <!-- COMMENTS -->
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    ?>
                </div>
            </div>

            <?php // BEGIN_WP5 ?>
            <?php if(class_exists( 'ReduxFrameworkPlugin' )){ ?>
                <?php if (isset($select_post_layout) && $select_post_layout == 'right-sidebar') { ?>
                    <div class="col-md-4 sidebar-content sidebar-right">
                        <?php if (is_active_sidebar($sidebar)) { ?>
                            <?php dynamic_sidebar($sidebar); ?>
                        <?php } ?>
                    </div>
                <?php }elseif(isset($select_post_layout) && $select_post_layout == 'inherit') { ?>
                    <?php if ( porfoliowp_redux('mt_single_blog_layout') == 'mt_single_blog_right_sidebar') { ?>
                        <div class="col-md-4 sidebar-content sidebar-right">
                            <?php if (is_active_sidebar($sidebar)) { ?>
                                <?php dynamic_sidebar($sidebar); ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <?php // END_WP5 ?>
            
        </div>
    </div>
</article>


<div class="row post-details-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if ( porfoliowp_redux('mt_enable_related_posts') ) { ?>

                <div class="clearfix"></div>
                <div class="related-posts sticky-posts">
                    <?php
                    global  $post;  
                    $orig_post = $post;  
                    $tags = wp_get_post_tags($post->ID);  
                    ?>

                    <?php if ($tags) { ?>
                    <h2 class="heading-bottom"><?php esc_attr_e('Related Posts', 'porfoliowp'); ?></h2>
                    <div class="row">
                        <?php $tag_ids = array();  
                        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
                        $args=array(  
                            'tag__in'               => $tag_ids,  
                            'post__not_in'          => array($post->ID),  
                            'posts_per_page'        => 3, // Number of related posts to display.  
                            'ignore_sticky_posts'   => 1  
                        );  

                        $my_query = new wp_query( $args );  

                        while( $my_query->have_posts() ) {  
                            $my_query->the_post(); 
                        
                        ?>  
                            <div class="col-md-4 post">
                                <div class="related_blog_custom">
                                    <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'porfoliowp_related_post_pic500x300' ); ?>
                                    <?php if($thumbnail_src){ ?>
                                    <a href="<?php the_permalink(); ?>" class="relative">
                                        <?php if($thumbnail_src) { ?>
                                            <img src="<?php echo esc_attr($thumbnail_src[0]); ?>" class="img-responsive" alt="<?php the_title(); ?>" />
                                        <?php } ?>
                                    </a>
                                    <?php } ?>
                                    <div class="related_blog_details">
                                        <h4 class="post-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <div class="post-author"><?php echo esc_attr('Posted by ','porfoliowp'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author(); ?></a> - <?php echo get_the_date( ); ?></div>
                                    </div>
                                </div>
                            </div>

                        <?php 
                        } ?>
                    </div>
                    <?php } ?>
                </div>
                    <?php 
                    $post = $orig_post;  
                    wp_reset_postdata();  
                    ?>  

                <?php } ?>



                <div class="clearfix"></div> 
                <?php if ( porfoliowp_redux('mt_enable_post_navigation') ) { ?>
                    <div class="prev-next-post">
                        <?php if(get_previous_post()){ ?>
                        <div class="col-md-6 prev-post text-left">
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                <i class="icon-arrow-left-circle"></i>
                            </a>
                        </div>
                        <?php } ?>
                        <?php if(get_next_post()){ ?>
                        <div class="col-md-6 next-post text-right">
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                <i class="icon-arrow-right-circle"></i>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>