<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $style
 * @var $position
 * @var $open_tab
 * @var $el_class
 * Shortcode class
 * @var  WPBakeryShortCode_Vc_TAbs
 */
$output = $title = $interval = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script('jquery-ui-tabs');

$el_class = $this->getExtraClass($el_class);

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

/**
 * vc_tabs
 *
 */
if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
$tabs_nav = '';
$tabs_nav .= '<ul class="nav nav-tabs">';
$i = 0;
foreach ( $tab_titles as $tab ) {
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
    $i++;
    $active = '';
    if($i == $open_tab)
    	$active = 'active';
    if(isset($tab_matches[1][0])) {
        $tabs_nav .= '<li class="'.esc_attr($active).'"><a data-toggle="tab" class="yes" href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</a></li>';

    }
}
$tabs_nav .= '</ul>'."\n";

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' wpb_content_element '.esc_attr($el_class) ), $this->settings['base']);
$output .= '<div class="'.$css_class.'">';
if(!empty($title))
    $output .= '<div class="header"><h3>'.esc_html($title).'</h3></div>';
$output .= "\n\t".'<div class="'.esc_attr($css_class).'" data-interval="'.esc_attr($interval).'">';
$output .= "\n\t\t".'<div class="tabbable tabs-'.esc_attr($position).' '.$style.'">';
$output .= "\n\t\t\t".$tabs_nav;
$output .= "\n\t\t\t". '<div class="tab-content">';
$output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t". '</div>';
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.tabbable');
$output .= "\n\t".'</div> '.$this->endBlockComment($element);
$output .= '</div>';
echo amos_output( $output );