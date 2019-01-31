<?php
$output = $title = $tab_id = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '', $this->settings['base']);
$output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="tab-pane '.esc_attr($css_class).'">';
$output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "amos") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');

echo amos_output( $output );