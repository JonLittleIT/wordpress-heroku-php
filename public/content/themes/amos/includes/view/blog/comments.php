<?php
global $amos_redata;
$count = 0;
$comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));
if(count($comment_entries) > 0){
    foreach($comment_entries as $comment){
        if($comment->comment_approved)
            $count++;
    }
}
if ( post_password_required() ) {
    return false;
}
?>
<?php if(comments_open()): ?>

<div id="comments" class="header <?php echo (!empty($amos_redata['blog_post_style'] && $amos_redata['blog_post_style'] == 'creative' ) ? 'creative' : ' ') ?>">
                    <?php if ( have_comments() ) :?>

                        <h5 class="single_title"><?php esc_html_e('Responses', 'amos') ?> </h5>
                      <?php endif; ?>
                      
                        <div class="row-fluid comments_list">
                            
                           <?php
                            if ( have_comments() ) : 
                                if(!empty($comment_entries)){
                                    wp_list_comments( array( 'type'=> 'all', 'callback' => 'amos_custom_comment' ) );
                                }
                                paginate_comments_links(); 
                            endif;
                            ?>
                                                        
                        </div>
    <?php comment_form(array('title_reply' => '<span>' .esc_html__('Post a comment', 'amos'). '</span> '), $post->ID ) ?>
</div>
<?php endif; ?>      




    
<?php
    
function amos_custom_comment($comment, $args, $depth){
        
        ?>
                <div class="comment <?php if($depth == 1) echo 'span12'; else echo 'span11 offset1'; ?>">

                        <?php 
                            $comment_type = get_comment_type($comment);
                            $ping_class='';
                            if($comment_type == 'pingback') 
                                $ping_class = 'comment-pingback';

                        ?>
                    
                            <dl class="dl-horizontal <?php echo esc_attr($ping_class) ?>">
                                <dt>
                                    <?php echo get_avatar($comment, '45') ?>    
                                </dt>
                                <dd>
					                
                                    <ul>
                                       
                                        <li><span class="date"><?php comment_date('M j Y', $comment) ?></span></li>
                                        </ul>
                                    <span class="author"><a href=""><?php echo get_comment_author_link($comment) ?></a></span>
                                        
                                </dd>
                            
                            <div class="comment_text">
                                        <?php echo get_comment_text($comment); ?>
                                            <?php if ($comment->comment_approved == '0') : ?>
                                                    <span><?php esc_html_e('Your comment is awaiting moderation.', 'amos') ?></span>
                                            <?php endif; ?>  
                                    <ul class="comment_buttons">
                                        <li><span class="reply_link"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span></li>
                                        <li><span class="edit_comment"> <?php edit_comment_link() ?></span></li>
                                    </ul>
                            </div>
                        </dl>  
                </div>
 <?php } ?>