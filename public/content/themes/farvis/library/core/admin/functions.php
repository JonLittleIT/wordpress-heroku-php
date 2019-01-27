<?php
function farvis_draw_admin_customize_section($wp_customize,$section_name,$options){
	foreach($options as $_option){
		$wp_customize->add_setting( $_option['id'] , array(
			'default'     => $_option['default'],
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );

		if ($_option['type'] == 'color'){
			$wp_customize->add_control(
				new WP_Customize_Color_Control( $wp_customize, $_option['id'],
					array(
						'label'      => $_option['label'],
						'section'    => $section_name,
						'settings'   => $_option['id'],
					)
				)
			);
		}else{
			$optionData =
				array(
					'label'      => $_option['label'],
					'section'  => $section_name,
					'settings'   => $_option['id'],
					'type'     => $_option['type'],
					'priority'   => $_option['priority']
				);
			if ($_option['type'] == 'select'){
				$optionData['choices'] = (isset($_option['choices'])) ? $_option['choices'] : array();
			}

			$wp_customize->add_control(
				$_option['id'],
				$optionData
			);
		}


	}

}
