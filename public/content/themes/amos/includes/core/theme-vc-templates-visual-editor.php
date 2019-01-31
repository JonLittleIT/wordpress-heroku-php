<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Class Visual Composer Editor
 * 
 */
class amos_Add_Templates {
	
	protected $amos_templates = false;

	public function init() {
		add_filter( 'vc_templates_render_category', array(
			$this,
			'addTemplateSection',
		), 10 );
		add_filter( 'vc_templates_render_template', array(
			$this,
			'addTemplateWindow',
		), 10, 2 );

		add_filter( 'vc_get_all_templates', array(
			$this,
			'addTemplatesItems',
		) );

	}

	/**
	 * @param $data
	 *
	 * @return array
	 */
	public function addTemplatesItems( $data ) {
		$newCategory = array(
			'category'        => 'amos_templates',
			'category_name'   => esc_html__( 'Content Blocks', 'amos' ),
			'category_weight' => 1,
			'templates'       => $this->getAllTemplates(),
		);
		$data[] = $newCategory;

		return $data;
	}

	public function getTemplates() {
		$templates = visual_templates();
		return $templates;
	}

	protected function get_template_categories() {

		$output = '';

		$categories = array(
			'all'         => esc_html__( 'All', 'amos' ),
			'blog'        => esc_html__( 'Blog', 'amos'),
			'portfolio'    => esc_html__( 'Portfolio', 'amos' ),
			'client'      => esc_html__( 'Clients', 'amos' ),
			'counters'    => esc_html__( 'Counters', 'amos' ),
			'faq'         => esc_html__( 'FAQ', 'amos' ),
			'footer'      => esc_html__( 'Footers', 'amos' ),			
			'map'         => esc_html__( 'Maps', 'amos' ),
			'section'        => esc_html__( 'Section', 'amos' ),
			'pricing'     => esc_html__( 'Pricing', 'amos' ),
			'service'     => esc_html__( 'Services', 'amos' ),
			'shop'        => esc_html__( 'Shop', 'amos' ),
			'tabs'        => esc_html__( 'Tabs', 'amos' ),
			'team'        => esc_html__( 'Team', 'amos' ),
			'testimonial' => esc_html__( 'Testimonials', 'amos' )
			
		);

		$output .= '<div class="sortable_templates setup">';
		$output .= '<ul>';
		$i = 0;
		foreach( $categories as $key => $value ) {
			$i++;
			$active = ( $i == 1 ) ? 'class="active"' : '';
			$output .= '<li ' . $active . ' data-sort="' . $key . '">' . $value . '</li>';
		}
		$output .= '</ul>';
		$output .= '</div>';

		return $output;

	}

	public function addTemplateSection( $category ) {

		if ( 'amos_templates' === $category['category'] ) {

			$category['output'] = '<div class="amos_container">';
			$category['output'] .= $this->get_template_categories();
			$category['output'] .= '</div>';


			$category['output'] .= '
			<div class="vc_column vc_col-sm-12 setup-block-container">
				<div class="vc_ui-template-list vc_templates-list-default_templates vc_ui-list-bar" data-vc-action="collapseAll">';
			if ( ! empty( $category['templates'] ) ) {
				foreach ( $category['templates'] as $template ) {
					$category['output'] .= $this->renderTemplateListItem( $template );
				}
			}
			$category['output'] .= '
			</div>
		</div>';

		}

		return $category;
	}

	/** Output rendered template in new panel dialog
	 * @since 4.4
	 *
	 * @param $template_name
	 * @param $template_data
	 *
	 * @return string
	 */
	function addTemplateWindow( $template_name, $template_data ) {

		if ( 'amos_templates' === $template_data['type'] ) {
			return $this->renderTemplatesSetup( $template_name, $template_data );
		}

		return $template_name;
	}

	/**
	 * @since 4.4
	 *
	 * @param $template_name
	 * @param $template_data
	 *
	 * @return string
	 */
	public function renderTemplatesSetup( $template_name, $template_data ) {
		ob_start();
		$template_id = esc_attr( $template_data['unique_id'] );
		$template_id_hash = md5( $template_id ); // needed for jquery target for TTA
		$template_name = esc_html( $template_name );
		$preview_template_title = esc_attr__( 'Preview template', 'amos' );
		$add_template_title = esc_attr__( 'Add template', 'amos' );

		echo <<<HTML
		<div class="templates_button">

			<button type="button" class="vc_ui-list-bar-item-trigger" 
				data-template-handler=""
				data-vc-ui-element="template-title">$template_name</button>

		</div>		
		<div class="vc_ui-list-bar-item-actions">
			<button type="button" class="vc_general vc_ui-control-button"
					data-template-handler="">
				<i class="vc-composer-icon vc-c-icon-add"></i>
			</button>
		</div>
HTML;

		return ob_get_clean();
	}

	/**
	 * @since 4.7
	 */
	public function renderUITemplate() {
		vc_include_template( 'editors/popups/vc_ui-panel-templates.tpl.php', array(
			'box' => $this,
		) );

		return '';
	}

	/**
	 * Loading Any templates Shortcodes for backend by string $template_id from AJAX
	 * @since 4.4
	 * vc_filter: vc_templates_render_backend_template - called when unknown template requested to render in backend
	 */
	public function renderBackendTemplate() {

		$template_id = vc_post_param( 'template_unique_id' );
		$template_type = vc_post_param( 'template_type' );

		if ( ! isset( $template_id, $template_type ) || '' === $template_id || '' === $template_type ) {
			die( 'Error: Vc_amos_templates::renderBackendTemplate:1' );
		}
		WPBMap::addAllMappedShortcodes();
		$this->getBackendDefaultTemplate();
		die();
	}

	/**
	 * @since 4.4
	 *
	 * @param $templates
	 *
	 * vc_filter: vc_load_amos_templates_limit_total - total items to show
	 *
	 * @return array
	 */
	public function loadDefaultTemplatesLimit( $templates ) {
		$start_index = 0;
		$total_templates_to_show = apply_filters( 'vc_load_default_templates_limit_total', 6 );

		return array_slice( $templates, $start_index, $total_templates_to_show );
	}

	/**
	 * Get user templates
	 *
	 * @since 4.12
	 * @return mixed
	 */
	public function getUserTemplates() {
		return apply_filters( 'vc_get_user_templates', get_option( $this->option_name ) );
	}

	/**
	 * Function to get all templates for display
	 *  - with image (optional preview image)
	 *  - with unique_id (required for do something for rendering.. )
	 *  - with name (required for display? )
	 *  - with type (required for requesting data in server)
	 *  - with category key (optional/required for filtering), if no category provided it will be displayed only in
	 * "All" category type vc_filter: vc_get_user_templates - hook to override "user My Templates" vc_filter:
	 * vc_get_all_templates - hook for override return array(all templates), hook to add/modify/remove more templates,
	 *  - this depends only to displaying in panel window (more layouts)
	 * @since 4.4
	 * @return array - all templates with name/unique_id/category_key(optional)/image
	 */
	public function getAllTemplates() {

		$data = array();
		$amos_templates = $this->getTemplates();
		$category_templates = array();
		foreach ( $amos_templates as $template_id => $template_data ) {
			$category_templates[] = array(
				'unique_id' => $template_id,
				'name' => $template_data['name'],
				'type' => 'amos_templates',
				'image' => isset( $template_data['image_path'] ) ? $template_data['image_path'] : false,
				'custom_class' => isset( $template_data['custom_class'] ) ? $template_data['custom_class'] : false,
				'sort_name' => isset( $template_data['sort_name'] ) ? $template_data['sort_name'] : false,
			);
			if ( ! empty( $category_templates ) ) {
				$data = $category_templates;
			}
		}

		return $data;
	}

	/**
	 * Load default templates list and initialize variable
	 * To modify you should use add_filter('vc_load_amos_templates','your_custom_function');
	 * Argument is array of templates data like:
	 *      array(
	 *          array(
	 *              'name'=>__('My custom template','my_plugin'),
	 *              'image_path'=> preg_replace( '/\s/', '%20', plugins_url( 'images/my_image.png', __FILE__ ) ), //
	 * always use preg replace to be sure that "space" will not break logic
	 *              'custom_class'=>'my_custom_class', // if needed
	 *              'content'=>'[my_shortcode]yeah[/my_shortcode]', // Use HEREDoc better to escape all single-quotes
	 * and double quotes
	 *          ),
	 *          ...
	 *      );
	 * Also see filters 'vc_load_amos_templates_panels' and 'vc_load_amos_templates_welcome_block' to modify
	 * templates in panels tab and/or in welcome block. vc_filter: vc_load_amos_templates - filter to override
	 * default templates array
	 * @since 4.4
	 * @return array
	 */
	public function loadDefaultTemplates() {

		if ( ! is_array( $this->amos_templates ) ) {
			$this->amos_templates = $this->allTemplates();
		}

		return $this->amos_templates;
	}

	/**
	 * Alias for loadDefaultTemplates
	 * @since 4.4
	 * @return array - list of default templates
	 */
	public function getDefaultTemplates() {
		return $this->loadDefaultTemplates();
	}

	/**
	 * Get default template data by template index in array.
	 * @since 4.4
	 *
	 * @param number $template_index
	 *
	 * @return array|setupl
	 */
	public function getDefaultTemplate( $template_index ) {

		$this->loadDefaultTemplates();
		if ( ! is_numeric( $template_index ) || ! is_array( $this->amos_templates ) || ! isset( $this->amos_templates[ $template_index ] ) ) {
			return false;
		}

		return $this->amos_templates[ $template_index ];
	}

	/**
	 * Add custom template to default templates list ( at end of list )
	 * $data = array( 'name'=>'', 'image'=>'', 'content'=>'' )
	 * @since 4.4
	 *
	 * @param $data
	 *
	 * @return setupl true if added, false if failed
	 */
	public function addDefaultTemplates( $data ) {
		if ( is_array( $data ) && ! empty( $data ) && isset( $data['name'], $data['content'] ) ) {
			if ( ! is_array( $this->amos_templates ) ) {
				$this->amos_templates = array();
			}
			$this->amos_templates[] = $data;

			return true;
		}

		return false;
	}

	/**
	 * Load default template content by index from ajax
	 * @since 4.4
	 *
	 * @param setupl $return | should function return data or not
	 *
	 * @return string
	 */
	public function getBackendDefaultTemplate( $return = false ) {

		$template_index = (int) vc_request_param( 'template_unique_id' );
		$data = $this->getDefaultTemplate( $template_index );

		if ( ! $data ) {
			die( 'Error: Vc_Templates_Panel_Editor::getBackendDefaultTemplate:1' );
		}
		if ( $return ) {
			return trim( $data['content'] );
		} else {
			echo trim( $data['content'] );
			die();
		}
	}

	/**
	 * @since 4.4
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	public function sortTemplatesByCategories( array $data ) {
		$buffer = $data;
		uasort( $buffer, array(
			&$this,
			'cmpCategory',
		) );

		return $buffer;
	}

	/**
	 * @since 4.4
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	public function sortTemplatesByNameWeight( array $data ) {
		$buffer = $data;
		uasort( $buffer, array(
			&$this,
			'cmpNameWeight',
		) );

		return $buffer;
	}

	/**
	 * Function should return array of templates categories
	 * @since 4.4
	 *
	 * @param array $categories
	 *
	 * @return array - associative array of category key => and visible Name
	 */
	public function getAllCategoriesNames( array $categories ) {
		$categories_names = array();

		foreach ( $categories as $category ) {
			if ( isset( $category['category'] ) ) {
				$categories_names[ $category['category'] ] = isset( $category['category_name'] ) ? $category['category_name'] : $category['category'];
			}
		}

		return $categories_names;
	}

	/**
	 * @since 4.4
	 * @return array
	 */
	public function getAllTemplatesSorted() {
		$data = $this->getAllTemplates();
		// firstly we need to sort by categories
		$data = $this->sortTemplatesByCategories( $data );
		// secondly we need to sort templates by their weight or name
		foreach ( $data as $key => $category ) {
			$data[ $key ]['templates'] = $this->sortTemplatesByNameWeight( $category['templates'] );
		}

		return $data;
	}

	/**
	 * Used to compare two templates by category, category_weight
	 * If category weight is less template will appear in first positions
	 * @since 4.4
	 *
	 * @param array $a - template one
	 * @param array $b - second template to compare
	 *
	 * @return int
	 */
	protected function cmpCategory( $a, $b ) {
		$a_k = isset( $a['category'] ) ? $a['category'] : '*';
		$b_k = isset( $b['category'] ) ? $b['category'] : '*';
		$a_category_weight = isset( $a['category_weight'] ) ? $a['category_weight'] : 0;
		$b_category_weight = isset( $b['category_weight'] ) ? $b['category_weight'] : 0;

		return $a_category_weight == $b_category_weight ? strcmp( $a_k, $b_k ) : $a_category_weight - $b_category_weight;
	}

	/**
	 * @since 4.4
	 *
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	protected function cmpNameWeight( $a, $b ) {
		$a_k = isset( $a['name'] ) ? $a['name'] : '*';
		$b_k = isset( $b['name'] ) ? $b['name'] : '*';
		$a_weight = isset( $a['weight'] ) ? $a['weight'] : 0;
		$b_weight = isset( $b['weight'] ) ? $b['weight'] : 0;

		return $a_weight == $b_weight ? strcmp( $a_k, $b_k ) : $a_weight - $b_weight;
	}

	/**
	 * Calls do_shortcode for templates.
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function frontendDoTemplatesShortcodes( $content ) {
		return do_shortcode( $content );
	}

	/**
	 * Add custom css from shortcodes from template for template editor.
	 *
	 * Used by action 'wp_print_scripts'.
	 *
	 * @todo move to autoload or else some where.
	 * @since 4.4.3
	 *
	 */
	public function addFrontendTemplatesShortcodesCustomCss() {
		$output = $shortcodes_custom_css = '';
		$shortcodes_custom_css = visual_composer()->parseShortcodesCustomCss( vc_frontend_editor()->getTemplateContent() );
		if ( ! empty( $shortcodes_custom_css ) ) {
			$shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
			$output .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
			$output .= $shortcodes_custom_css;
			$output .= '</style>';
		}
		echo amos_output($output);
	}

	public function addScriptsToTemplatePreview() {
		// wp_enqueue_script( 'vc-template-preview-script', vc_asset_url( 'js/editors/vc_ui-panel-templates-preview-be.js' ), array( 'vc-backend-min-js' ), WPB_VC_VERSION, true );
	}

	public function renderTemplateListItem( $template ) {
		$name = isset( $template['name'] ) ? esc_html( $template['name'] ) : esc_html( __( 'No title', 'amos' ) );
		$template_id = esc_attr( $template['unique_id'] );
		$template_id_hash = md5( $template_id ); // needed for jquery target for TTA
		$template_name = esc_html( $name );
		$template_name_lower = esc_attr( vc_slugify( $template_name ) );
		$template_type = esc_attr( isset( $template['type'] ) ? $template['type'] : 'custom' );
		$custom_class = esc_attr( isset( $template['custom_class'] ) ? $template['custom_class'] : '' );
		$template_image = esc_attr( isset( $template['image'] ) ? $template['image'] : '' );
		$template_sort_name = esc_attr( isset( $template['sort_name'] ) ? $template['sort_name'] : '' );

		$output = <<<HTML
					<div class="vc_ui-template amos_templates vc_templates-template-type-default_templates $custom_class"
						data-template_id="$template_id"
						data-template_id_hash="$template_id_hash"
						data-category="$template_sort_name"
						data-template_unique_id="$template_id"
						data-template_name="$template_name_lower"
						data-template_type="default_templates"
						data-vc-content=".vc_ui-template-content">

						<div class="blocks">
HTML;
		$output .= '<div class="amos_img  vc_ui-list-bar-item-trigger"><img  width="284px" height="150px" src="' . esc_url( $template_image ) . '" alt="' . esc_attr( $name ) . '"  /></div>';
		$output .= apply_filters( 'vc_templates_render_template', $name, $template );
		$output .= '<span class="template-categories" data-category="' . esc_html( $template_sort_name ) . '">' . esc_html( $template_sort_name ) . '</span>';
		$output .= <<<HTML
						</div>
						<div class="vc_ui-template-content" data-js-content>
						</div>
					</div>
HTML;

		return $output;
	}

	public function getOptionName() {
		return $this->option_name;
	}
}
