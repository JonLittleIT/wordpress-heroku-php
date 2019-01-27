<?php 

# Custom Comments

function porfoliowp_custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'div';
        $add_below = 'div-comment';
    }
?>
    <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body fullwidth single_comment parent">
        <?php endif; ?>
            <div class="comment-author vcard comment_author col-md-1">
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 130 ); ?>
            </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.','porfoliowp' ); ?></em>
        <?php endif; ?>

        <div class="comment-meta commentmetadata col-md-11 comment_body relative">
            <div class="vc_row">
                <?php printf( '<div class="author_name vc_col-md-5">%s</div>', get_comment_author_link() ); ?>
                <span class="reply_button col-md-7 text-right">
                    <?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?>
                </span>
            </div>
            <p><?php comment_text(); ?></p>
            <span class="reply_button1 col-md-3 text-left">
                <?php edit_comment_link( esc_attr__( 'Edit', 'porfoliowp' ), '  ', '' ); ?>
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </span>
        </div>
    </div>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php } ?>
