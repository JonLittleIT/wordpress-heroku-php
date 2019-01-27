<?php
if (!class_exists('Walker_Nav_Menu_Edit')){
	include_once(get_template_directory() . '/../../../wp-admin/includes/class-walker-nav-menu-edit.php');
}

class farvis_Walker_Edit_Menu extends Walker_Nav_Menu_Edit {
	
	public function walk( $elements, $max_depth ) {
		$output = parent::walk( $elements, $max_depth );
		
		
		
		
		preg_match_all('/<p class="field-link-target.*?\>(.*?)<\/p>/si', $output, $matches);
		
		if (isset($matches[0][0])){
			foreach($matches[0] as $match){

				preg_match('/<input(.*?)(.*)name=\"(.*?)\"/i', $match, $_matches);

				if (isset($_matches[3])){
					$elementID = str_replace("menu-item-target[","",$_matches[3]);
					$elementID = str_replace("]","",$elementID);					
					$isWide = get_post_meta( $elementID, '_menu_item_wide', true );
					$_wideDefault = ($isWide != 'menu-width' && $isWide != 'full-width') ? 'selected' : '';
					$_wideMenu = ($isWide == 'menu-width') ? 'selected' : '';
					$_wideFull = ($isWide == 'full-width') ? 'selected' : '';
					$wideBtnHtml = '<p class="field-css-wide description description-wide">
					<label>
						'.esc_html__('Menu Width','farvis').'</br>
						<select name="menu-item-wide['.$elementID.']" class="css-width-field">
							<option '.$_wideDefault.' value="">'.esc_html__('Default','farvis').'</option>
							<option '.$_wideMenu.' value="menu-width">'.esc_html__('Width menu','farvis').'</option>
							<option '.$_wideFull.' value="full-width">'.esc_html__('Full width','farvis').'</option>
						</select>						
					</label></p>';
					$output = str_replace($match,$match . $wideBtnHtml,$output);	
				}								
			}
		}

		return $output;
	}

}