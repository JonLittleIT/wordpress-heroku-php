<?php
global $post_author, $post;

$author_id = '';
if( isset( $post_author->id ) ) $author_id = $post_author->id;

$image_id                       = get_post_thumbnail_id( $post->ID );
$image_url                      = wp_get_attachment_image_src( $image_id, 'full' );
$image_url                      = $image_url[0];
$bd_date_unix                   = get_the_time('U', $post->ID);

$logo = '';
if( woohoo_get_option( 'logo_upload' ) ) {
	$logo = woohoo_get_option( 'logo_upload' );
} else {
	$logo = get_template_directory_uri() .'/images/logo.png';
}
?>
<span style=display:none itemprop=author itemscope itemtype="https://schema.org/Person">
	<meta itemprop=name content="<?php echo get_the_author_meta( 'display_name', $author_id ); ?>">
</span>

<meta itemprop=interactionCount content="UserComments:<?php echo get_comments_number( $post->ID ); ?>">

<meta itemprop=datePublished content="<?php echo date(DATE_W3C, $bd_date_unix);?>">
<meta itemprop=dateModified content="<?php echo date(DATE_W3C, $bd_date_unix);?>">

<meta itemscope itemprop=mainEntityOfPage itemtype="https://schema.org/WebPage" itemid="<?php echo esc_url( get_permalink( $post->ID ) );?>">
<span style=display:none itemprop=publisher itemscope itemtype="https://schema.org/Organization">
	<span style=display:none itemprop=logo itemscope itemtype="https://schema.org/ImageObject">
		<meta itemprop="url" content="<?php echo esc_url( $logo );?>">
	</span>
	<meta itemprop=name content="<?php echo bloginfo('name'); ?>">
</span>
<meta itemprop=headline content="<?php echo get_the_title(); ?>">
<span style=display:none itemprop=image itemscope itemtype="https://schema.org/ImageObject">
	<meta itemprop=url content="<?php echo esc_url( $image_url );?>">
	<meta itemprop=width content=1240>
	<meta itemprop=height content=540>
</span>