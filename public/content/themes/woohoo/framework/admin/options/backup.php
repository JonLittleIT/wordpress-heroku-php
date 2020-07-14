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

// Backup & Restore
$bd_options["backup_and_restore"]["backup_and_restore"][] = array(

	"name" 		=> "Backup & Restore",
	"type"  	=> "subtitle"
);

// Backup / Export
$bd_options["backup_and_restore"]["backup_and_restore"][] = array(

	"name" 		=> "Backup / Export",
	"id"    	=> "advanced_export",
	"type"  	=> "textarea"
);

// Restore / Import
$bd_options["backup_and_restore"]["backup_and_restore"][] = array(

	"name" 		=> "Restore / Import",
	"id"    	=> "advanced_import",
	"exp"       => "You can transfer the saved options data between different installs by copying the text inside the text box.",
	"type"  	=> "textarea"
);