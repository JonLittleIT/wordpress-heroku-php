<?php
global $amos_redata;
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $color
 * @var $custom_color
 * @var $background_style
 * @var $background_color
 * @var $custom_background_color
 * @var $size
 * @var $align
 * @var $el_class
 * @var $link
 * @var $css_animation
 * @var $css
 * @var $icon_svg
 * @var $icon_bool
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Icon
 */
$type = $icon_fontawesome = $icon_openiconic = $icon_typicons =
$icon_entypo = $icon_linecons = $color = $custom_color =
$background_style = $background_color = $custom_background_color =
$size = $align = $el_class = $link = $css_animation = $css = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = '';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );

$url = vc_build_link( $link );
$has_style = false;
if ( strlen( $background_style ) > 0 ) {
	$has_style = true;
	if ( false !== strpos( $background_style, 'outline' ) ) {
		$background_style .= ' vc_icon_element-outline'; // if we use outline style it is border in css
	} else {
		$background_style .= ' vc_icon_element-background';
	}
}

$iconClass = isset( ${'icon_' . $type} ) ? esc_attr( ${'icon_' . $type} ) : 'fa fa-adjust';

$style = '';
if ( 'custom' === $background_color ) {
	if ( false !== strpos( $background_style, 'outline' ) ) {
		$style = 'border-color:' . $custom_background_color;
	} else {
		$style = 'background-color:' . $custom_background_color;
	}
}
$style = $style ? ' style="' . esc_attr( $style ) . '"' : '';

?>

<?php if($icon_bool == 'icon'){?>
<div class="vc_icon_element vc_icon_element-outer<?php echo strlen( $css_class ) > 0 ? ' ' . trim( esc_attr( $css_class ) ) : ''; ?> vc_icon_element-align-<?php echo esc_attr( $align ); ?><?php if ( $has_style ) { echo ' vc_icon_element-have-style'; } ?>">
	<div class="vc_icon_element-inner vc_icon_element-color-<?php echo esc_attr( $color ); ?><?php if ( $has_style ) { echo ' vc_icon_element-have-style-inner'; } ?> vc_icon_element-size-<?php echo esc_attr( $size ); ?> vc_icon_element-style-<?php echo esc_attr( $background_style ); ?> vc_icon_element-background-color-<?php echo esc_attr( $background_color ); ?>"<?php echo amos_output($style) ?>><span class="vc_icon_element-icon <?php echo esc_attr($iconClass); ?>" <?php echo( 'custom' === $color ? 'style="color:' . esc_attr( $custom_color ) . ' !important"' : '' ); ?>></span><?php
			if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
				echo '<a class="vc_icon_element-link" href="' . esc_attr( $url['url'] ) . '" title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '"></a>';
			}
		?></div>
</div>
<?php 

   } else if($icon_bool == 'svg'){
            if(!empty($icon_svg)){
                $random = rand(0,500000);?>
<div class="vc_icon_element vc_icon_element-outer<?php echo strlen( $css_class ) > 0 ? ' ' . trim( esc_attr( $css_class ) ) : ''; ?> vc_icon_element-align-<?php echo esc_attr( $align ); ?><?php if ( $has_style ) { echo ' vc_icon_element-have-style'; } ?>">
                <?php echo '<div id="icon-svg-'.$random.'" class="icon-svg"></div>';
                echo "<script>
                  new Vivus('icon-svg-".$random."', {duration: 50, file: '".$icon_svg."', onReady: function(mySVG){
                    mySVG.el.setAttribute('stroke', '".( 'custom' === $color ?  esc_attr( $custom_color ) : $color )."' );
                  }});
                </script>";
                echo '</div>';
                
            }
       }
        ?>