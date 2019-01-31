<?php

global $amos_redata;

do_action('amos_excecute_query_var_action','loop-index');

echo '<div id="fullpage">';

if (have_posts()) :



	while (have_posts()) : the_post();



        $post_id    = get_the_ID();

        $title   	= get_the_title();

        $content 	= get_the_content();

        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));

                

        $post_format = get_post_format($post_id);

        if(strlen($post_format) == 0)

            $post_format = 'standart';

        $count = 0;

        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));

        if(count($comment_entries) > 0){

            foreach($comment_entries as $comment){

                if($comment->comment_approved)

                    $count++;

            }

        }


        $tags = get_the_tags();
        $tag_out = ''; $num=count($tags); $i=0; if($tags) foreach($tags as $tag): if(++$i === $num){$tag_out .= $tag->name;} else {$tag_out .= $tag->name.', ';}  endforeach;
                                   
        $font_color = ($amos_redata['page_header_menu_color'] == 'auto')? '':'background--'.$amos_redata['page_header_menu_color'];
        ?>

        
        <?php if(has_post_thumbnail()): ?>
        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('fullscreen-blog-article section'); ?> style="background-image:url('<?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>');">                    
                
            <div class="content <?php echo esc_attr($amos_redata['fullscreen_post_position']) ?> with_animation animated <?php echo esc_attr($font_color) ?>" data-animation="<?php echo esc_attr($amos_redata['fullscreen_post_effect']) ?>" data-delay="<?php echo esc_attr($amos_redata['fullscreen_post_delay']) ?>">        
                    <h1><?php echo get_the_title() ?></h1>
                    <p><?php the_excerpt() ?></p>
                    <a href="<?php echo esc_url(get_permalink()) ?>" class="btn-bt <?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>"><span><?php _e('Read More', 'amos') ?></span><i class="linea-arrows-right"></i></a>

            </div>

        </article>
        <?php endif; ?>

    <?php endwhile; ?>

<?php endif; ?>

</div>