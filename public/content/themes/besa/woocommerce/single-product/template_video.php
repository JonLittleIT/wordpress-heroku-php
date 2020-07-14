<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$aspect_ratio = besa_tbay_get_config('video_aspect_ratio', '16_9');
$aspect_ratio = '_' . $aspect_ratio;

$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );

$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array(
	$gallery_thumbnail['width'],
	$gallery_thumbnail['height']
) );

$thumbnail_url     = wp_get_attachment_image_src( $thumbnail_id, $thumbnail_size );

$thumbnail_url = isset( $thumbnail_url[0] ) ? $thumbnail_url[0] : '';

if( is_null($thumbnail_url) ) {
	$thumbnail_url = BESA_IMAGES.'/thumbnail-video.jpg';
}

global $product;
if ( 'youtube' == $host ) {
	$video_class = 'youtube';
	$url         = "https://www.youtube.com/embed/" . $video_id . "/?enablejsapi=1&origin=" . get_site_url();

} elseif ( 'vimeo' == $host ) {
	$video_class = 'vimeo';
	$url         = "//player.vimeo.com/video/" . $video_id;
}

$gallery_item_class = besa_get_gallery_item_class();


$video_class	.= ' '.$aspect_ratio;
?>
<div class="<?php echo esc_attr($gallery_item_class); ?> tbay_featured_content" data-thumb="<?php echo esc_attr($thumbnail_url); ?>">
    <div class="tbay-video-content <?php echo esc_attr($video_class); ?>">
        <iframe id="video_<?php echo esc_attr($product->get_id()); ?>" src="<?php echo esc_url($url); ?>" type="text/html" frameborder="0" allowfullscreen>
        </iframe>
    </div>
</div>