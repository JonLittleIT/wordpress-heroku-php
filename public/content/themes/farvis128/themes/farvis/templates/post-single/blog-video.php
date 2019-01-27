<?php
/**
 * The template includes blog post format audio.
 *
 * @package Pix-Theme
 * @since 1.0
 */
$farvis_format  = get_post_format();
$pix_options = get_option('pix_general_settings');
$custom =  get_post_custom($post->ID);

$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$farvis_format  = get_post_format();
$farvis_format = !in_array($farvis_format, array("quote", "gallery", "video")) ? "standared" : $farvis_format;

$thumbnailId = (isset($custom['post_standared']))?reset($custom['post_standared']):false;

if (!$thumbnailId)
    $thumbnailId = get_post_thumbnail_id($post->ID);

$thumbnailSrc = wp_get_attachment_url($thumbnailId);

$video_embed_code = get_post_meta( get_the_ID(), 'post_video', true );
$vendor = parse_url($video_embed_code);

?>


    <?php if ($video_embed_code):?>
        <?php if ($vendor['host'] == 'www.youtube.com' || $vendor['host'] == 'youtu.be' || $vendor['host'] == 'www.youtu.be' || $vendor['host'] == 'youtube.com'){ ?>

            <?php if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $video_embed_code, PHP_URL_QUERY ), $my_array_of_vars ); ?>
                <iframe class="hvr-grow-rotate" width="885" height="487" src="http://www.youtube.com/embed/<?php echo esc_attr($my_array_of_vars['v']); ?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;" frameborder="0" allowfullscreen></iframe>
            <?php } else { ?>
                <iframe class="hvr-grow-rotate" width="885" height="487" src="http://www.youtube.com/embed<?php echo esc_attr(parse_url($video_embed_code, PHP_URL_PATH));?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;" frameborder="0" allowfullscreen></iframe>
            <?php } } ?>

        <?php if ($vendor['host'] == 'vimeo.com'){ ?>
            <iframe class="hvr-grow-rotate" src="http://player.vimeo.com/video<?php echo esc_attr(parse_url($video_embed_code, PHP_URL_PATH));?>?title=1&amp;byline=1&amp;portrait=1" width="885" height="487" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        <?php } ?>
    <?php endif;?>
