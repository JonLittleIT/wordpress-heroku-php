<?php
/**
 * The style "hover" of the Services item
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.13
 */

$args = get_query_var('trx_addons_args_sc_services');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();
$svg_present = false;
$image = '';
if ( has_post_thumbnail() ) {
	$image = trx_addons_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), trx_addons_get_thumb_size('full') );
}
if (empty($args['id'])) $args['id'] = 'sc_services_'.str_replace('.', '', mt_rand());
if (empty($args['featured'])) $args['featured'] = 'icon';
if (empty($args['hide_bg_image'])) $args['hide_bg_image'] = 0;

if (!empty($args['slider'])) {
	?><div class="slider-slide swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?> "><?php
}
?>
<div class="sc_services_item<?php
	echo !isset($args['hide_excerpt']) || $args['hide_excerpt']==0 ? ' with_content' : ' without_content';
	echo !empty($image) ? ' with_image' : '';
	echo trim($args['featured'])=='icon' ? ' with_icon' : '';
	echo trim($args['featured'])=='number' ? ' with_number' : '';
?>">
	<div class="sc_services_item_header <?php echo trim($args['hide_bg_image'])==1 ? ' without_image' : ''; ?>"<?php if ($args['hide_bg_image']==0 && !empty($image)) echo ' style="background-image: url('.esc_url($image).');"'; ?>>

		<div class="sc_services_item_header_inner">
			<?php
			if ($args['featured']=='icon' && !empty($meta['icon'])) {
				$svg = $img = '';
				if (trx_addons_is_url($meta['icon'])) {
					$img = $meta['icon'];
					$meta['icon'] = basename($meta['icon']);
				} else if (!empty($args['icons_animation']) && $args['icons_animation'] > 0 && ($svg = trx_addons_get_file_dir('css/icons.svg/'.trx_addons_esc($meta['icon']).'.svg')) != '')
					$svg_present = true;
				?><a href="<?php echo esc_url($link); ?>"
					 id="<?php echo esc_attr($args['id'].'_'.trim($meta['icon'])); ?>"
					 class="sc_services_item_icon <?php
							echo !empty($svg) 
									? 'sc_icon_type_svg'
									: (!empty($img) 
										? 'sc_icon_type_img'
										: esc_attr($meta['icon'])
										);
							?>"<?php
					 if (!empty($meta['icon_color'])) {
						 echo ' style="color:'.esc_attr($meta['icon_color']).'"';
					 }
				?>><?php
					if (!empty($svg)) {
						trx_addons_show_layout(trx_addons_get_svg_from_file($svg));
					} else if (!empty($img)) {
						$attr = trx_addons_getimagesize($img);
                        $alt = basename($img);
                        $alt = substr($alt,0,strlen($alt) - 4);
                        ?><img class="sc_icon_as_image" src="<?php echo esc_url($img); ?>" alt="<?php echo esc_html($alt); ?>"<?php echo (!empty($attr[3]) ? ' '.trim($attr[3]) : ''); ?>><?php
					}
				?></a><?php
			}
			?>
			<h6 class="sc_services_item_title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h6>

			</div>

		<a class="sc_services_item_link" href="<?php echo esc_url($link); ?>"></a>
	</div>


</div>
<?php
if (!empty($args['slider']) || $args['columns'] > 1) {
	?></div><?php
}
if (trx_addons_is_on(trx_addons_get_option('debug_mode')) && $svg_present) {
	wp_enqueue_script( 'vivus', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'icons/vivus.js'), array('jquery'), null, true );
	wp_enqueue_script( 'trx_addons-sc_icons', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'icons/icons.js'), array('jquery'), null, true );
}
?>