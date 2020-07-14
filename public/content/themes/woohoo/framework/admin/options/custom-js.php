<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$bd_options["custom_javascript"]["custom_javascript"][] = array(

    "name" => "Custom Javascript",
    "type"=> "subtitle"
);

$bd_options["custom_javascript"]["custom_javascript"][] = array(

    "name" 		=> "Paste Here Your Custom Javascript",
    "id"    	=> "custom_javascript",
    "type"  	=> "textarea"
);
?>