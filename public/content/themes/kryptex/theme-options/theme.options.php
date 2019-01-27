<?php
/**
 * Theme Options, Color Schemes and Fonts utilities
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('kryptex_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'kryptex_options_theme_setup2', 2 );
	function kryptex_options_theme_setup2() {
		kryptex_create_theme_options();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('kryptex_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'kryptex_options_theme_setup5', 5 );
	function kryptex_options_theme_setup5() {
		kryptex_storage_set('options_reloaded', false);
		kryptex_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('kryptex_load_custom_options')) {
		add_action( 'wp_loaded', 'kryptex_load_custom_options' );
		function kryptex_load_custom_options() {
			if (!kryptex_storage_get('options_reloaded')) {
				kryptex_storage_set('options_reloaded', true);
				kryptex_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('kryptex_load_theme_options') ) {
	function kryptex_load_theme_options() {
		$options = kryptex_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				$value = kryptex_get_theme_option_std($k, $v['std']);
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = wp_kses_data(wp_unslash($_GET[$k]));
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				kryptex_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			kryptex_customizer_save_css();
		} else {
			do_action('kryptex_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('kryptex_override_theme_options') ) {
	add_action( 'wp', 'kryptex_override_theme_options', 1 );
	function kryptex_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			kryptex_storage_set('blog_archive', true);
			kryptex_storage_set('blog_template', get_the_ID());
		}
		kryptex_storage_set('blog_mode', kryptex_detect_blog_mode());
		if (is_singular()) {
			kryptex_storage_set('options_meta', get_post_meta(get_the_ID(), 'kryptex_options', true));
		}
		do_action('kryptex_action_override_theme_options');
	}
}

// Override options with stored page meta on 'Blog posts' pages
if ( !function_exists('kryptex_blog_override_theme_options') ) {
	add_action( 'kryptex_action_override_theme_options', 'kryptex_blog_override_theme_options');
	function kryptex_blog_override_theme_options() {
		global $wp_query;
		if (is_home() && !is_front_page() && !empty($wp_query->is_posts_page)) {
			if (($id = get_option('page_for_posts')) > 0)
				kryptex_storage_set('options_meta', get_post_meta($id, 'kryptex_options', true));
		}
	}
}


// Return 'std' value of the option, processed by special function (if specified)
if (!function_exists('kryptex_get_theme_option_std')) {
	function kryptex_get_theme_option_std($opt_name, $opt_std) {
		if (strpos($opt_std, '$kryptex_')!==false) {
			$func = substr($opt_std, 1);
			if (function_exists($func)) {
				$opt_std = $func($opt_name);
			}
		}
		return $opt_std;
	}
}


// Return customizable option value
if (!function_exists('kryptex_get_theme_option')) {
	function kryptex_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;

		if ($post_id > 0) {
			if (!kryptex_storage_isset('post_options_meta', $post_id))
				kryptex_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'kryptex_options', true));
			if (kryptex_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = kryptex_storage_get_array('post_options_meta', $post_id, $name);
				if (!kryptex_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}

		if (!$from_post_meta && kryptex_storage_isset('options')) {

			$blog_mode = kryptex_storage_get('blog_mode');

			if ( !kryptex_storage_isset('options', $name) && (empty($blog_mode) || !kryptex_storage_isset('options', $name.'_'.$blog_mode)) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						//array_shift($s);
						$s = array_shift($s);
						// Translators: Add option's name to the output
						echo '<pre>' . esc_html(sprintf(__('Undefined option "%s" called from:', 'kryptex'), $name));
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						die();
					} else
						$rez = $defa;
				}

			} else {

				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = wp_kses_data(wp_unslash($_REQUEST[$name . '_' . $blog_mode]));

				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = wp_kses_data(wp_unslash($_REQUEST[$name]));

				// Override option from current page settings (if exists)
				} else if (kryptex_storage_isset('options_meta', $name) && !kryptex_is_inherit(kryptex_storage_get_array('options_meta', $name))) {
					$rez = kryptex_storage_get_array('options_meta', $name);

				// Override option from current blog mode settings: 'front', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && kryptex_storage_isset('options', $name . '_' . $blog_mode, 'val') && !kryptex_is_inherit(kryptex_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = kryptex_storage_get_array('options', $name . '_' . $blog_mode, 'val');

				// Get saved option value
				} else if (kryptex_storage_isset('options', $name, 'val')) {
					$rez = kryptex_storage_get_array('options', $name, 'val');

				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('kryptex_check_theme_option')) {
	function kryptex_check_theme_option($name) {
		return kryptex_storage_isset('options', $name);
	}
}


// Return customizable option value, stored in the posts meta
if (!function_exists('kryptex_get_theme_option_from_meta')) {
	function kryptex_get_theme_option_from_meta($name, $defa='') {
		$rez = $defa;
		if (kryptex_storage_isset('options_meta')) {
			if (kryptex_storage_isset('options_meta', $name))
				$rez = kryptex_storage_get_array('options_meta', $name);
			else
				$rez = 'inherit';
		}
		return $rez;
	}
}


// Get dependencies list from the Theme Options
if ( !function_exists('kryptex_get_theme_dependencies') ) {
	function kryptex_get_theme_dependencies() {
		$options = kryptex_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}



// -----------------------------------------------------------------
// -- Theme Settings utilities
// -----------------------------------------------------------------

// Return internal theme setting value
if (!function_exists('kryptex_get_theme_setting')) {
	function kryptex_get_theme_setting($name) {
		if ( !kryptex_storage_isset('settings', $name) ) {
			$s = debug_backtrace();
			//array_shift($s);
			$s = array_shift($s);
			// Translators: Add setting's name to the output
			echo '<pre>' . esc_html(sprintf(__('Undefined setting "%s" called from:', 'kryptex'), $name));
			if (function_exists('dco')) dco($s);
			else print_r($s);
			echo '</pre>';
			die();
		} else
			return kryptex_storage_get_array('settings', $name);
	}
}

// Set theme setting
if ( !function_exists( 'kryptex_set_theme_setting' ) ) {
	function kryptex_set_theme_setting($option_name, $value) {
		if (kryptex_storage_isset('settings', $option_name))
			kryptex_storage_set_array('settings', $option_name, $value);
	}
}



// -----------------------------------------------------------------
// -- Color Schemes utilities
// -----------------------------------------------------------------

// Load saved values into color schemes
if (!function_exists('kryptex_load_schemes')) {
	add_action('kryptex_action_load_options', 'kryptex_load_schemes');
	function kryptex_load_schemes() {
		$schemes = kryptex_storage_get('schemes');
		$storage = kryptex_unserialize(kryptex_get_theme_option('scheme_storage'));
		if (is_array($storage) && count($storage) > 0)  {
			foreach ($storage as $k=>$v) {
				if (isset($schemes[$k])) {
					$schemes[$k] = $v;
				}
			}
			kryptex_storage_set('schemes', $schemes);
		}
	}
}

// Return specified color from current (or specified) color scheme
if ( !function_exists( 'kryptex_get_scheme_color' ) ) {
	function kryptex_get_scheme_color($color_name, $scheme = '') {
		if (empty($scheme)) $scheme = kryptex_get_theme_option( 'color_scheme' );
		if (empty($scheme) || kryptex_storage_empty('schemes', $scheme)) $scheme = 'default';
		$colors = kryptex_storage_get_array('schemes', $scheme, 'colors');
		return $colors[$color_name];
	}
}

// Return colors from current color scheme
if ( !function_exists( 'kryptex_get_scheme_colors' ) ) {
	function kryptex_get_scheme_colors($scheme = '') {
		if (empty($scheme)) $scheme = kryptex_get_theme_option( 'color_scheme' );
		if (empty($scheme) || kryptex_storage_empty('schemes', $scheme)) $scheme = 'default';
		return kryptex_storage_get_array('schemes', $scheme, 'colors');
	}
}

// Return colors from all schemes
if ( !function_exists( 'kryptex_get_scheme_storage' ) ) {
	function kryptex_get_scheme_storage($scheme = '') {
		return serialize(kryptex_storage_get('schemes'));
	}
}

// Return schemes list
if ( !function_exists( 'kryptex_get_list_schemes' ) ) {
	function kryptex_get_list_schemes($prepend_inherit=false) {
		$list = array();
		$schemes = kryptex_storage_get('schemes');
		if (is_array($schemes) && count($schemes) > 0) {
			foreach ($schemes as $slug => $scheme) {
				$list[$slug] = $scheme['title'];
			}
		}
		return $prepend_inherit ? kryptex_array_merge(array('inherit' => esc_html__("Inherit", 'kryptex')), $list) : $list;
	}
}



// -----------------------------------------------------------------
// -- Theme Fonts utilities
// -----------------------------------------------------------------

// Load saved values into fonts list
if (!function_exists('kryptex_load_fonts')) {
	add_action('kryptex_action_load_options', 'kryptex_load_fonts');
	function kryptex_load_fonts() {
		// Fonts to load when theme starts
		$fonts = array();
		for ($i=1; $i<=kryptex_get_theme_setting('max_load_fonts'); $i++) {
			if (($name = kryptex_get_theme_option("load_fonts-{$i}-name")) != '') {
				$fonts[] = array(
					'name'	 => $name,
					'family' => kryptex_get_theme_option("load_fonts-{$i}-family"),
					'styles' => kryptex_get_theme_option("load_fonts-{$i}-styles")
				);
			}
		}
		kryptex_storage_set('load_fonts', $fonts);
		kryptex_storage_set('load_fonts_subset', kryptex_get_theme_option("load_fonts_subset"));
		
		// Font parameters of the main theme's elements
		$fonts = kryptex_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$fonts[$tag][$css_prop] = kryptex_get_theme_option("{$tag}_{$css_prop}");
			}
		}
	kryptex_storage_set('theme_fonts', $fonts);
	}
}

// Return slug of the loaded font
if (!function_exists('kryptex_get_load_fonts_slug')) {
	function kryptex_get_load_fonts_slug($name) {
		return str_replace(' ', '-', $name);
	}
}

// Return load fonts parameter's default value
if (!function_exists('kryptex_get_load_fonts_option')) {
	function kryptex_get_load_fonts_option($option_name) {
		$rez = '';
		$parts = explode('-', $option_name);
		$load_fonts = kryptex_storage_get('load_fonts');
		if ($parts[0] == 'load_fonts' && count($load_fonts) > $parts[1]-1 && isset($load_fonts[$parts[1]-1][$parts[2]])) {
			$rez = $load_fonts[$parts[1]-1][$parts[2]];
		}
		return $rez;
	}
}

// Return load fonts subset's default value
if (!function_exists('kryptex_get_load_fonts_subset')) {
	function kryptex_get_load_fonts_subset($option_name) {
		return kryptex_storage_get('load_fonts_subset');
	}
}

// Return load fonts list
if (!function_exists('kryptex_get_list_load_fonts')) {
	function kryptex_get_list_load_fonts($prepend_inherit=false) {
		$list = array();
		$load_fonts = kryptex_storage_get('load_fonts');
		if (is_array($load_fonts) && count($load_fonts) > 0) {
			foreach ($load_fonts as $font) {
				$list['"'.trim($font['name']).'"'.(!empty($font['family']) ? ','.trim($font['family']): '')] = $font['name'];
			}
		}
		return $prepend_inherit ? kryptex_array_merge(array('inherit' => esc_html__("Inherit", 'kryptex')), $list) : $list;
	}
}

// Return font settings of the theme specific elements
if ( !function_exists( 'kryptex_get_theme_fonts' ) ) {
	function kryptex_get_theme_fonts() {
		return kryptex_storage_get('theme_fonts');
	}
}

// Return theme fonts parameter's default value
if (!function_exists('kryptex_get_theme_fonts_option')) {
	function kryptex_get_theme_fonts_option($option_name) {
		$rez = '';
		$parts = explode('_', $option_name);
		$theme_fonts = kryptex_storage_get('theme_fonts');
		if (!empty($theme_fonts[$parts[0]][$parts[1]])) {
			$rez = $theme_fonts[$parts[0]][$parts[1]];
		}
		// For the font-families update options list also
		if ($parts[1] == 'font-family') {
			kryptex_storage_set_array2('options', $option_name, 'options', kryptex_get_list_load_fonts(true));
		}
		return $rez;
	}
}



// -----------------------------------------------------------------
// -- Other options utilities
// -----------------------------------------------------------------

// Return current theme-specific border radius for form's fields and buttons
if ( !function_exists( 'kryptex_get_border_radius' ) ) {
	function kryptex_get_border_radius() {
		$rad = str_replace(' ', '', kryptex_get_theme_option('border_radius'));
		if (empty($rad)) $rad = 0;
		return kryptex_prepare_css_value($rad); 
	}
}




// -----------------------------------------------------------------
// -- Theme Options page
// -----------------------------------------------------------------

if ( !function_exists('kryptex_options_init_page_builder') ) {
	add_action( 'after_setup_theme', 'kryptex_options_init_page_builder' );
	function kryptex_options_init_page_builder() {
		if ( is_admin() ) {
			add_action('admin_enqueue_scripts',	'kryptex_options_add_scripts');
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'kryptex_options_add_scripts' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'kryptex_options_add_scripts');
	function kryptex_options_add_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id == 'appearance_page_theme_options') {
			wp_enqueue_style( 'kryptex-icons',  kryptex_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			wp_enqueue_style( 'wp-color-picker', false, array(), null);
			wp_enqueue_script('wp-color-picker', false, array('jquery'), null, true);
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			wp_enqueue_script( 'jquery-ui-accordion', false, array('jquery', 'jquery-ui-core'), null, true );
			wp_enqueue_script( 'kryptex-options', kryptex_get_file_url('theme-options/theme.options.js'), array('jquery'), null, true );
			wp_enqueue_script( 'kryptex-colorpicker.colors', kryptex_get_file_url('js/colorpicker/colors.js'), array('jquery'), null, true );
			wp_enqueue_script( 'kryptex-colorpicker', kryptex_get_file_url('js/colorpicker/jqColorPicker.js'), array('jquery'), null, true );
			wp_localize_script( 'kryptex-options', 'kryptex_dependencies', kryptex_get_theme_dependencies() );
			wp_localize_script( 'kryptex-options', 'kryptex_color_schemes', kryptex_storage_get('schemes') );
			wp_localize_script( 'kryptex-options', 'kryptex_simple_schemes', kryptex_storage_get('schemes_simple') );
		}
	}
}

// Add Theme Options item in the Appearance menu
if (!function_exists('kryptex_options_add_menu_items')) {
	add_action( 'admin_menu', 'kryptex_options_add_menu_items' );
	function kryptex_options_add_menu_items() {
		if (!KRYPTEX_THEME_FREE) {
			add_theme_page(
				esc_html__('Theme Options', 'kryptex'),	//page_title
				esc_html__('Theme Options', 'kryptex'),	//menu_title
				'manage_options',						//capability
				'theme_options',						//menu_slug
				'kryptex_options_page_builder',			//callback
				'dashicons-admin-generic',				//icon
				''										//menu position
			);
		}
	}
}


// Build options page
if (!function_exists('kryptex_options_page_builder')) {
	function kryptex_options_page_builder() {
		?>
		<div class="kryptex_options">
			<h2 class="kryptex_options_title"><?php esc_html_e('Theme Options', 'kryptex'); ?></h2>
			<?php kryptex_show_admin_messages(); ?>
			<form id="kryptex_options_form" action="#" method="post" enctype="multipart/form-data">
				<input type="hidden" name="kryptex_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
				<?php kryptex_options_show_fields(); ?>
				<div class="kryptex_options_buttons">
					<input type="submit" value="<?php esc_html_e('Save Options', 'kryptex'); ?>">
				</div>
			</form>
		</div>
		<?php
	}
}


// Display all option's fields
if ( !function_exists('kryptex_options_show_fields') ) {
	function kryptex_options_show_fields($options=false) {
		if (empty($options)) $options = kryptex_storage_get('options');
		$tabs_titles = $tabs_content = array();
		$last_panel = $last_section = $last_group = '';
		foreach ($options as $k=>$v) {
			// New tab
			if ($v['type']=='panel' || ($v['type']=='section' && empty($last_panel))) {
				if (!isset($tabs_titles[$k])) {
					$tabs_titles[$k] = $v['title'];
					$tabs_content[$k] = '';
				}
				if (!empty($last_group)) {
					$tabs_content[$last_section] .= '</div></div>';
					$last_group = '';
				}
				$last_section = $k;
				if ($v['type']=='panel') $last_panel = $k;

			// New group
			} else if ($v['type']=='group' || ($v['type']=='section' && !empty($last_panel))) {
				if (empty($last_group))
					$tabs_content[$last_section] = (!isset($tabs_content[$last_section]) ? '' : $tabs_content[$last_section]) 
													. '<div class="kryptex_accordion kryptex_options_groups">';
				else
					$tabs_content[$last_section] .= '</div>';
				$tabs_content[$last_section] .= '<h4 class="kryptex_accordion_title kryptex_options_group_title">' . esc_html($v['title']) . '</h4>'
												. '<div class="kryptex_accordion_content kryptex_options_group_content">';
				$last_group = $k;
			
			// End panel, section or group
			} else if (in_array($v['type'], array('group_end', 'section_end', 'panel_end'))) {
				if (!empty($last_group) && ($v['type'] != 'section_end' || empty($last_panel))) {
					$tabs_content[$last_section] .= '</div></div>';
					$last_group = '';
				}
				if ($v['type'] == 'panel_end') $last_panel = '';
				
			// Field's layout
			} else {
				$tabs_content[$last_section] = (!isset($tabs_content[$last_section]) ? '' : $tabs_content[$last_section]) 
												. kryptex_options_show_field($k, $v);
			}
		}
		if (!empty($last_group)) {
			$tabs_content[$last_section] .= '</div></div>';
		}
		
		if (count($tabs_content) > 0) {
			// Remove empty sections
			foreach ($tabs_content as $k=>$v) {
				if (empty($v)) {
					unset($tabs_titles[$k]);
					unset($tabs_content[$k]);
				}
			}
			?>
			<div id="kryptex_options_tabs" class="kryptex_tabs <?php echo count($tabs_titles) > 1 ? 'with_tabs' : 'no_tabs'; ?>">
				<?php if (count($tabs_titles) > 1) { ?>
					<ul><?php
						$cnt = 0;
						foreach ($tabs_titles as $k=>$v) {
							$cnt++;
							?><li><a href="#kryptex_options_section_<?php echo esc_attr($cnt); ?>"><?php echo esc_html($v); ?></a></li><?php
						}
					?></ul>
				<?php
				}
				$cnt = 0;
				foreach ($tabs_content as $k=>$v) {
					$cnt++;
					?>
					<div id="kryptex_options_section_<?php echo esc_attr($cnt); ?>" class="kryptex_tabs_section kryptex_options_section">
						<?php kryptex_show_layout($v); ?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}


// Display single option's field
if ( !function_exists('kryptex_options_show_field') ) {
	function kryptex_options_show_field($name, $field, $post_type='') {

		$inherit_allow = !empty($post_type);
		$inherit_state = !empty($post_type) && isset($field['val']) && kryptex_is_inherit($field['val']);
		
		$field_data_present = $field['type']!='info' || !empty($field['override']['desc']) || !empty($field['desc']);

		if ($field['type'] == 'hidden' || (!empty($field['hidden']) && !$inherit_allow)) return '';
		
		$output = (!empty($field['class']) && strpos($field['class'], 'kryptex_new_row')!==false 
					? '<div class="kryptex_new_row_before"></div>'
					: '')
					. '<div class="kryptex_options_item kryptex_options_item_'.esc_attr($field['type'])
								. ($inherit_allow ? ' kryptex_options_inherit_'.($inherit_state ? 'on' : 'off' ) : '')
								. (!empty($field['class']) ? ' '.esc_attr($field['class']) : '')
								. '">'
						. '<h4 class="kryptex_options_item_title">'
							. esc_html($field['title'])
							. ($inherit_allow 
									? '<span class="kryptex_options_inherit_lock" id="kryptex_options_inherit_'.esc_attr($name).'"></span>'
									: '')
						. '</h4>'
						. ($field_data_present
							? '<div class="kryptex_options_item_data">'
								. '<div class="kryptex_options_item_field" data-param="'.esc_attr($name).'"'
									. (!empty($field['linked']) ? ' data-linked="'.esc_attr($field['linked']).'"' : '')
									. '>'
							: '');
	
		// Type 'checkbox'
		if ($field['type']=='checkbox') {
			$output .= '<label class="kryptex_options_item_label">'
						. '<input type="checkbox" name="kryptex_options_field_'.esc_attr($name).'" value="1"'
								.($field['val']==1 ? ' checked="checked"' : '')
								.' />'
						. esc_html($field['title'])
					. '</label>';
		
		// Type 'switch' (2 choises) or 'radio' (3+ choises)
		} else if (in_array($field['type'], array('switch', 'radio'))) {
			$field['options'] = apply_filters('kryptex_filter_options_get_list_choises', $field['options'], $name);
			$first = true;
			foreach ($field['options'] as $k=>$v) {
				$output .= '<label class="kryptex_options_item_label">'
							. '<input type="radio" name="kryptex_options_field_'.esc_attr($name).'"'
									. ' value="'.esc_attr($k).'"'
									. ($field['val']==$k || ($first && !isset($field['options'][$field['val']])) ? ' checked="checked"' : '')
									. ' />'
							. esc_html($v)
						. '</label>';
				$first = false;
			}

		// Type 'text' or 'time' or 'date'
		} else if (in_array($field['type'], array('text', 'time', 'date'))) {
			$output .= '<input type="text" name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(kryptex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />';
		
		// Type 'textarea'
		} else if ($field['type']=='textarea') {
			$output .= '<textarea name="kryptex_options_field_'.esc_attr($name).'">'
							. esc_html(kryptex_is_inherit($field['val']) ? '' : $field['val'])
						. '</textarea>';
		
		// Type 'text_editor'
		} else if ($field['type']=='text_editor') {
			$output .= '<input type="hidden" id="kryptex_options_field_'.esc_attr($name).'"'
							. ' name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_textarea(kryptex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. kryptex_show_custom_field('kryptex_options_field_'.esc_attr($name).'_tinymce',
													$field,
													kryptex_is_inherit($field['val']) ? '' : $field['val']);

		// Type 'select'
		} else if ($field['type']=='select') {
			$field['options'] = apply_filters('kryptex_filter_options_get_list_choises', $field['options'], $name);
			$output .= '<select size="1" name="kryptex_options_field_'.esc_attr($name).'">';
			foreach ($field['options'] as $k=>$v) {
				$output .= '<option value="'.esc_attr($k).'"'.($field['val']==$k ? ' selected="selected"' : '').'>'.esc_html($v).'</option>';
			}
			$output .= '</select>';

		// Type 'image', 'media', 'video' or 'audio'
		} else if (in_array($field['type'], array('image', 'media', 'video', 'audio'))) {
			if ( (int) $field['val'] > 0 ) {
				$image = wp_get_attachment_image_src( $field['val'], 'full' );
				$field['val'] = $image[0];
			}
			$output .= (!empty($field['multiple'])
						? '<input type="hidden" id="kryptex_options_field_'.esc_attr($name).'"'
							. ' name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(kryptex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						: '<input type="text" id="kryptex_options_field_'.esc_attr($name).'"'
							. ' name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(kryptex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />')
					. kryptex_show_custom_field('kryptex_options_field_'.esc_attr($name).'_button',
												array(
													'type'			 => 'mediamanager',
													'multiple'		 => !empty($field['multiple']),
													'data_type'		 => $field['type'],
													'linked_field_id'=> 'kryptex_options_field_'.esc_attr($name)
												),
												kryptex_is_inherit($field['val']) ? '' : $field['val']);

		// Type 'color'
		} else if ($field['type']=='color') {
			$output .= '<input type="text" id="kryptex_options_field_'.esc_attr($name).'"'
							. ' class="kryptex_color_selector"'
							. ' name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr($field['val']).'"'
							. ' />';
		
		// Type 'icon'
		} else if ($field['type']=='icon') {
			$output .= '<input type="text" id="kryptex_options_field_'.esc_attr($name).'"'
							. ' name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(kryptex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. kryptex_show_custom_field('kryptex_options_field_'.esc_attr($name).'_button',
													array(
														'type'	 => 'icons',
														'button' => true,
														'icons'	 => true
													),
													kryptex_is_inherit($field['val']) ? '' : $field['val']);
		
		// Type 'checklist'
		} else if ($field['type']=='checklist') {
			$output .= '<input type="hidden" id="kryptex_options_field_'.esc_attr($name).'"'
							. ' name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(kryptex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. kryptex_show_custom_field('kryptex_options_field_'.esc_attr($name).'_list',
													$field,
													kryptex_is_inherit($field['val']) ? '' : $field['val']);
		
		// Type 'scheme_editor'
		} else if ($field['type']=='scheme_editor') {
			$output .= '<input type="hidden" id="kryptex_options_field_'.esc_attr($name).'"'
							. ' name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(kryptex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. kryptex_show_custom_field('kryptex_options_field_'.esc_attr($name).'_scheme',
													$field,
													kryptex_unserialize($field['val']));
		
		// Type 'slider' || 'range'
		} else if (in_array($field['type'], array('slider', 'range'))) {
			$field['show_value'] = !isset($field['show_value']) || $field['show_value'];
			$output .= '<input type="'.(!$field['show_value'] ? 'hidden' : 'text').'" id="kryptex_options_field_'.esc_attr($name).'"'
							. ' name="kryptex_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(kryptex_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ($field['show_value'] ? ' class="kryptex_range_slider_value"' : '')
							. ' />'
						. kryptex_show_custom_field('kryptex_options_field_'.esc_attr($name).'_slider',
													$field,
													kryptex_is_inherit($field['val']) ? '' : $field['val']);
			
		}
		
		$output .= ($inherit_allow
						? '<div class="kryptex_options_inherit_cover'.(!$inherit_state ? ' kryptex_hidden' : '').'">'
							. '<span class="kryptex_options_inherit_label">' . esc_html__('Inherit', 'kryptex') . '</span>'
							. '<input type="hidden" name="kryptex_options_inherit_'.esc_attr($name).'"'
									. ' value="'.esc_attr($inherit_state ? 'inherit' : '').'"'
									. ' />'
							. '</div>'
						: '')
					. ($field_data_present ? '</div>' : '')
					. (!empty($field['override']['desc']) || !empty($field['desc'])
						? '<div class="kryptex_options_item_description">'
							. (!empty($field['override']['desc']) 	// param 'desc' already processed with wp_kses()!
									? $field['override']['desc'] 
									: $field['desc'])
							. '</div>'
						: '')
				. ($field_data_present ? '</div>' : '')
			. '</div>';
		return $output;
	}
}


// Show theme specific fields
function kryptex_show_custom_field($id, $field, $value) {
	$output = '';
	switch ($field['type']) {
		
		case 'mediamanager':
			wp_enqueue_media( );
			$title = empty($field['data_type']) || $field['data_type']=='image'
							? esc_html__( 'Choose Image', 'kryptex')
							: esc_html__( 'Choose Media', 'kryptex');
			$output .= '<a id="'.esc_attr($id).'"'
							. ' class="button mediamanager kryptex_media_selector"'
							. '	data-param="' . esc_attr($id) . '"'
							. '	data-choose="'.esc_attr(!empty($field['multiple']) ? esc_html__( 'Choose Images', 'kryptex') : $title).'"'
							. ' data-update="'.esc_attr(!empty($field['multiple']) ? esc_html__( 'Add to Gallery', 'kryptex') : $title).'"'
							. '	data-multiple="'.esc_attr(!empty($field['multiple']) ? '1' : '0').'"'
							. '	data-type="'.esc_attr(!empty($field['data_type']) ? $field['data_type'] : 'image').'"'
							. '	data-linked-field="'.esc_attr($field['linked_field_id']).'"'
							. '>'
							. (!empty($field['multiple'])
									? (empty($field['data_type']) || $field['data_type']=='image'
										? esc_html__( 'Add Images', 'kryptex')
										: esc_html__( 'Add Files', 'kryptex')
										)
									: esc_html($title)
								)
							. '</a>';
			$output .= '<span class="kryptex_options_field_preview">';
			$images = explode('|', $value);
			if (is_array($images)) {
				foreach ($images as $img)
                    $alt = basename($img);
                    $alt = substr($alt,0,strlen($alt) - 4);
					$output .= $img && !kryptex_is_inherit($img)
							? '<span>'
									. (in_array(kryptex_get_file_ext($img), array('gif', 'jpg', 'jpeg', 'png'))
											? '<img src="' . esc_url($img) . '" alt="' . esc_html($alt) . '">'
											: '<a href="' . esc_attr($img) . '">' . esc_html(basename($img)) . '</a>'
										)
								. '</span>' 
							: '';
			}
			$output .= '</span>';
			break;

		case 'icons':
			$icons_type = !empty($field['style']) 
							? $field['style'] 
							: kryptex_get_theme_setting('icons_type');
			if (empty($field['return']))
				$field['return'] = 'full';
			$kryptex_icons = $icons_type=='images'
								? kryptex_get_list_images()
								: kryptex_array_from_list(kryptex_get_list_icons());
			if (is_array($kryptex_icons)) {
				if (!empty($field['button']))
					$output .= '<span id="'.esc_attr($id).'"'
									. ' class="kryptex_list_icons_selector'
											. ($icons_type=='icons' && !empty($value) ? ' '.esc_attr($value) : '')
											.'"'
									. ' title="'.esc_attr__('Select icon', 'kryptex').'"'
									. ' data-style="'.($icons_type=='images' ? 'images' : 'icons').'"'
									. ($icons_type=='images' && !empty($value) 
										? ' style="background-image: url('.esc_url($field['return']=='slug' 
																							? $kryptex_icons[$value] 
																							: $value).');"' 
											: '')
								. '></span>';
				if (!empty($field['icons'])) {
					$output .= '<div class="kryptex_list_icons">'
								. '<input type="text" class="kryptex_list_icons_search" placeholder="'.esc_attr__('Search icon ...', 'kryptex').'">';
					foreach($kryptex_icons as $slug=>$icon) {
						$output .= '<span class="'.esc_attr($icons_type=='icons' ? $icon : $slug)
								. (($field['return']=='full' ? $icon : $slug) == $value ? ' kryptex_list_active' : '')
								. '"'
								. ' title="'.esc_attr($slug).'"'
								. ' data-icon="'.esc_attr($field['return']=='full' ? $icon : $slug).'"'
								. ($icons_type=='images' ? ' style="background-image: url('.esc_url($icon).');"' : '')
								. '></span>';
					}
					$output .= '</div>';
				}
			}
			break;

		case 'checklist':
			if (!empty($field['sortable']))
				wp_enqueue_script('jquery-ui-sortable', false, array('jquery', 'jquery-ui-core'), null, true);
			$output .= '<div class="kryptex_checklist kryptex_checklist_'.esc_attr($field['dir'])
						. (!empty($field['sortable']) ? ' kryptex_sortable' : '') 
						. '">';
			if (!is_array($value)) {
				if (!empty($value) && !kryptex_is_inherit($value)) parse_str(str_replace('|', '&', $value), $value);
				else $value = array();
			}
			// Sort options by values order
			if (!empty($field['sortable']) && is_array($value)) {
				$field['options'] = kryptex_array_merge($value, $field['options']);
			}
			foreach ($field['options'] as $k=>$v) {
				$output .= '<label class="kryptex_checklist_item_label' 
								. (!empty($field['sortable']) ? ' kryptex_sortable_item' : '') 
								. '">'
							. '<input type="checkbox" value="1" data-name="'.$k.'"'
								.( isset($value[$k]) && (int) $value[$k] == 1 ? ' checked="checked"' : '')
								.' />'
							. (substr($v, 0, 4)=='http' ? '<img src="'.esc_url($v).'">' : esc_html($v))
						. '</label>';
			}
			$output .= '</div>';
			break;

		case 'slider':
		case 'range':
			wp_enqueue_script('jquery-ui-slider', false, array('jquery', 'jquery-ui-core'), null, true);
			$is_range  = $field['type'] == 'range';
			$field_min = !empty($field['min']) ? $field['min'] : 0;
			$field_max = !empty($field['max']) ? $field['max'] : 100;
			$field_step= !empty($field['step']) ? $field['step'] : 1;
			$field_val = !empty($value) 
							? ($value . ($is_range && strpos($value, ',')===false ? ','.$field_max : ''))
							: ($is_range ? $field_min.','.$field_max : $field_min);
			$output .= '<div id="'.esc_attr($id).'"'
							. ' class="kryptex_range_slider"'
							. ' data-range="' . esc_attr($is_range ? 'true' : 'min') . '"'
							. ' data-min="' . esc_attr($field_min) . '"'
							. ' data-max="' . esc_attr($field_max) . '"'
							. ' data-step="' . esc_attr($field_step) . '"'
							. '>'
							. '<span class="kryptex_range_slider_label kryptex_range_slider_label_min">'
								. esc_html($field_min)
							. '</span>'
							. '<span class="kryptex_range_slider_label kryptex_range_slider_label_max">'
								. esc_html($field_max)
							. '</span>';
			$values = explode(',', $field_val);
			for ($i=0; $i < count($values); $i++) {
				$output .= '<span class="kryptex_range_slider_label kryptex_range_slider_label_cur">'
								. esc_html($values[$i])
							. '</span>';
			}
			$output .= '</div>';
			break;

		case 'text_editor':
			if (function_exists('wp_enqueue_editor')) wp_enqueue_editor();
			ob_start();
			wp_editor( $value, $id, array(
				'default_editor' => 'tmce',
				'wpautop' => isset($field['wpautop']) ? $field['wpautop'] : false,
				'teeny' => isset($field['teeny']) ? $field['teeny'] : false,
				'textarea_rows' => isset($field['rows']) && $field['rows'] > 1 ? $field['rows'] : 10,
				'editor_height' => 16*(isset($field['rows']) && $field['rows'] > 1 ? (int) $field['rows'] : 10),
				'tinymce' => array(
					'resize'             => false,
					'wp_autoresize_on'   => false,
					'add_unload_trigger' => false
				)
			));
			$editor_html = ob_get_contents();
			ob_end_clean();
			$output .= '<div class="kryptex_text_editor">' . $editor_html . '</div>';
			break;

			
		case 'scheme_editor':
			if (!is_array($value)) break;
			if (empty($field['colorpicker'])) $field['colorpicker'] = 'internal';
			$output .= '<div class="kryptex_scheme_editor">';
			// Select scheme
			$output .= '<select class="kryptex_scheme_editor_selector">';
			foreach ($value as $scheme=>$v)
				$output .= '<option value="' . esc_attr($scheme) . '">' . esc_html($v['title']) . '</option>';
			$output .= '</select>';
			// Select type
			$output .= '<div class="kryptex_scheme_editor_type">'
							. '<div class="kryptex_scheme_editor_row">'
								. '<span class="kryptex_scheme_editor_row_cell">'
									. esc_html__('Editor type', 'kryptex')
								. '</span>'
								. '<span class="kryptex_scheme_editor_row_cell kryptex_scheme_editor_row_cell_span">'
									.'<label>'
										. '<input name="kryptex_scheme_editor_type" type="radio" value="simple" checked="checked"> '
										. esc_html__('Simple', 'kryptex')
									. '</label>'
									. '<label>'
										. '<input name="kryptex_scheme_editor_type" type="radio" value="advanced"> '
										. esc_html__('Advanced', 'kryptex')
									. '</label>'
								. '</span>'
							. '</div>'
						. '</div>';
			// Colors
			$groups = kryptex_storage_get('scheme_color_groups');
			$colors = kryptex_storage_get('scheme_color_names');
			$output .= '<div class="kryptex_scheme_editor_colors">';
			foreach ($value as $scheme=>$v) {
				$output .= '<div class="kryptex_scheme_editor_header">'
								. '<span class="kryptex_scheme_editor_header_cell"></span>';
				foreach ($groups as $group_name=>$group_data) {
					$output .= '<span class="kryptex_scheme_editor_header_cell" title="'.esc_html($group_data['description']).'">' 
								. esc_html($group_data['title'])
								. '</span>';
				}
				$output .= '</div>';
				foreach ($colors as $color_name=>$color_data) {
					$output .= '<div class="kryptex_scheme_editor_row">'
								. '<span class="kryptex_scheme_editor_row_cell" title="'.esc_html($color_data['description']).'">'
								. esc_html($color_data['title'])
								. '</span>';
					foreach ($groups as $group_name=>$group_data) {
						$slug = $group_name == 'main' 
									? $color_name 
									: str_replace('text_', '', "{$group_name}_{$color_name}");
						$output .= '<span class="kryptex_scheme_editor_row_cell">'
									. (isset($v['colors'][$slug])
										? "<input type=\"text\" name=\"{$slug}\" class=\"".($field['colorpicker']=='tiny' ? 'tinyColorPicker' : 'iColorPicker')."\" value=\"".esc_attr($v['colors'][$slug])."\">"
										: ''
										)
									. '</span>';
					}
					$output .= '</div>';
				}
				break;
			}
			$output .= '</div>'
					. '</div>';
			break;
	}
	return apply_filters('kryptex_filter_show_custom_field', $output, $id, $field, $value);
}



// Save options
if (!function_exists('kryptex_options_save')) {
	add_action('after_setup_theme', 'kryptex_options_save', 4);
	function kryptex_options_save() {

		if (!isset($_REQUEST['page']) || $_REQUEST['page']!='theme_options' || kryptex_get_value_gp('kryptex_nonce')=='') return;

		// verify nonce
		if ( !wp_verify_nonce( kryptex_get_value_gp('kryptex_nonce'), admin_url() ) ) {
			kryptex_add_admin_message(esc_html__('Bad security code! Options are not saved!', 'kryptex'), 'error', true);
			return;
		}

		// Check permissions
		if (!current_user_can('manage_options')) {
			kryptex_add_admin_message(esc_html__('Manage options is denied for the current user! Options are not saved!', 'kryptex'), 'error', true);
			return;
		}

		// Save options
		$options = kryptex_storage_get('options');
		$values = get_theme_mods();
		$external_storages = array();
		foreach ($options as $k=>$v) {
			// Skip non-data options - sections, info, etc.
			if (!isset($v['std'])) continue;
			// Get option value from POST
			$value = isset($_POST['kryptex_options_field_' . $k])
							? kryptex_get_value_gp('kryptex_options_field_' . $k)
							: ($v['type']=='checkbox' ? 0 : '');
			// Individual options processing
			if ($k == 'custom_logo' && !empty($value) && (int) $value == 0) {
				$value = attachment_url_to_postid(kryptex_clear_thumb_size($value));
				if (empty($value)) $value = $values[$k];
			}
			// Save to the result array
			if ($value != kryptex_get_theme_option_std($k, $v['std'])) {
				$values[$k] = $value;
			} else if (isset($values[$k]))
				unset($values[$k]);
			// External plugin's options
			if (!empty($v['options_storage'])) {
				if (!isset($external_storages[$v['options_storage']]))
					$external_storages[$v['options_storage']] = array();
				$external_storages[$v['options_storage']][$k] = $value;
			}
		}

		// Update options in the external storages
		foreach ($external_storages as $storage_name => $storage_values) {
			$storage = get_option($storage_name, false);
			if (is_array($storage)) {
				foreach ($storage_values as $k=>$v)
					$storage[$k] = $v;
				update_option($storage_name, apply_filters('kryptex_filter_options_save', $storage, $storage_name));
			}
		}

		// Update Theme Mods (internal Theme Options)
		$stylesheet_slug = get_option('stylesheet');
		update_option("theme_mods_{$stylesheet_slug}", apply_filters('kryptex_filter_options_save', $values, 'theme_mods'));

		// Store new schemes colors
		if (!empty($values['scheme_storage'])) {
			$schemes = kryptex_unserialize($values['scheme_storage']);
			if (is_array($schemes) && count($schemes) > 0) 
				kryptex_storage_set('schemes', $schemes);
		}
		
		// Store new fonts parameters
		$fonts = kryptex_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				if (isset($values["{$tag}_{$css_prop}"])) $fonts[$tag][$css_prop] = $values["{$tag}_{$css_prop}"];
			}
		}
		kryptex_storage_set('theme_fonts', $fonts);

		// Update ThemeOptions save timestamp
		$stylesheet_time = time();
		update_option("kryptex_options_timestamp_{$stylesheet_slug}", $stylesheet_time);

		// Sinchronize theme options between child and parent themes
		if (kryptex_get_theme_setting('duplicate_options') == 'both') {
			$theme_slug = get_option('template');
			if ($theme_slug != $stylesheet_slug) {
				kryptex_customizer_duplicate_theme_options($stylesheet_slug, $theme_slug, $stylesheet_time);
			}
		}

		// Regenerate CSS with new colors
		kryptex_customizer_save_css();

        // Return result
        kryptex_add_admin_message(esc_html__('Options are saved', 'kryptex'));
        wp_redirect(get_admin_url(null, 'themes.php?page=theme_options'));
        exit();
	}
}


// Refresh data in the linked field
// according the main field value
if (!function_exists('kryptex_refresh_linked_data')) {
	function kryptex_refresh_linked_data($value, $linked_name) {
		if ($linked_name == 'parent_cat') {
			$tax = kryptex_get_post_type_taxonomy($value);
			$terms = !empty($tax) ? kryptex_get_list_terms(false, $tax) : array();
			$terms = kryptex_array_merge(array(0 => esc_html__('- Select category -', 'kryptex')), $terms);
			kryptex_storage_set_array2('options', $linked_name, 'options', $terms);
		}
	}
}


// AJAX: Refresh data in the linked fields
if (!function_exists('kryptex_callback_get_linked_data')) {
	add_action('wp_ajax_kryptex_get_linked_data', 		'kryptex_callback_get_linked_data');
	add_action('wp_ajax_nopriv_kryptex_get_linked_data','kryptex_callback_get_linked_data');
	function kryptex_callback_get_linked_data() {
		if ( !wp_verify_nonce( kryptex_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
		$chg_name = wp_kses_data(wp_unslash($_REQUEST['chg_name']));
		$chg_value = wp_kses_data(wp_unslash($_REQUEST['chg_value']));
		$response = array('error' => '');
		if ($chg_name == 'post_type') {
			$tax = kryptex_get_post_type_taxonomy($chg_value);
			$terms = !empty($tax) ? kryptex_get_list_terms(false, $tax) : array();
			$response['list'] = kryptex_array_merge(array(0 => esc_html__('- Select category -', 'kryptex')), $terms);
		}
		echo json_encode($response);
		die();
	}
}
?>