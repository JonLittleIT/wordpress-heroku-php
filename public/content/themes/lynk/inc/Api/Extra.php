<?php
/**
 * Extra 
 *
 *
 */

namespace Awps\Api;

/**
 * Customizer class
 */
class Extra
{
	/**
	 * Register default hooks and actions for WordPress
	 *
	 * @return WordPress add_action()
	 */
	public function register() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}
        
    }    
}