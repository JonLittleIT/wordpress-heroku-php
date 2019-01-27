<?php

	require_once(get_template_directory() . '/library/core/admin/admin-panel/class.customizer.fonts.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/general.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/page-loader.php' );
	require_once(get_template_directory() . '/library/core/admin/admin-panel/style.php' );
	require_once(get_template_directory() . '/library/core/admin/admin-panel/header.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/page-tab.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/responsive.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/search.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/footer.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/shop.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/portfolio.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/services.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/blog.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/social.php');
	require_once(get_template_directory() . '/library/core/admin/admin-panel/sanitizer.php' );
 
	
	function farvis_customize_register( $wp_customize ) {

		$wp_customize->remove_section('header_image');
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');

		/** GENERAL SETTINGS **/
		farvis_customize_general_tab($wp_customize,'farvis');
		
		
		/** PAGE LOADER SETTINGS **/
		farvis_customize_page_loader_tab($wp_customize,'farvis');


		/** STYLE SECTION **/

		farvis_customize_style_tab($wp_customize, 'farvis');
		
		
		/** HEADER SECTION **/

		farvis_customize_header_tab($wp_customize,'farvis');


		/** RESPONSIVE SECTION **/

		farvis_customize_responsive_tab($wp_customize,'farvis');


		/** SEARCH SECTION **/

		farvis_customize_search_tab($wp_customize,'farvis');


		/** PAGE TITLE AND BREADCRUMBS SECTION **/

		farvis_customize_page_t_a_b_tab($wp_customize,'farvis');


		/** FOOTER SECTION **/

		farvis_customize_footer_tab($wp_customize,'farvis');


		/** SHOP SECTION **/

		farvis_customize_shop_tab($wp_customize,'farvis');


		/** PORTFOLIO SECTION **/

		farvis_customize_portfolio_tab($wp_customize, 'farvis');


		/** SERVICES SECTION **/

		farvis_customize_services_tab($wp_customize, 'farvis');


		/** BLOG SECTION **/

		farvis_customize_blog_tab($wp_customize,'farvis');

		/** SOCIAL SECTION **/

		farvis_customize_social_tab($wp_customize,'farvis');

		/** Remove unused sections */

		$removedSections = apply_filters('farvis_admin_customize_removed_sections', array('header_image','background_image'));
		foreach ($removedSections as $_sectionName){
			$wp_customize->remove_section($_sectionName);
		}

    }
    
    
	add_action( 'customize_register', 'farvis_customize_register' );

?>