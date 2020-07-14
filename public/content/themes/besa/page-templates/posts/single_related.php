<?php 

$text_domain               = esc_html__(' comments','besa');    
if( get_comments_number() == 1) {
    $text_domain = esc_html__(' comment','besa');
}

?>
<div class="post item-post single-reladted">   
    <figure class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
        <a href="<?php the_permalink(); ?>"  class="entry-image">
            <?php the_post_thumbnail( array(100, 100) ); ?>
        </a> 
    </figure>
    <div class="entry-header">

        <?php if ( get_the_title() ) : ?>
            <h3 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php besa_post_meta_comment(); ?>
            </h3>
        <?php endif; ?>
        <ul class="entry-meta-list">
            <li class="entry-date"><i class="tb-icon tb-icon-calendar-31"></i><?php echo besa_time_link(); ?></li>
        </ul>

    </div>
</div>
