<?php
/**
 * Prevent direct script access
 * ========================================================= */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Render some HTML markup before the newsletter sign-up form fields
 * ========================================================= */

function woohoo_mc4wp_form_before_form( $html ) {
	$html .= '<div class="bdaia-mc4wp-form-icon"><span class="bdaia-io bdaia-io-envelop"></span></div>';
	$html .= '<p class="bdaia-mc4wp-bform-p">'.woohoo__tr( 'Get the best viral stories straight into your inbox!' ).'</p>';
	return $html;
}

/**
 * Render some HTML markup after the newsletter sign-up form fields
 * ========================================================= */
function woohoo_mc4wp_form_after_form( $html ) {
	$html .= '<p class="bdaia-mc4wp-aform-p">' . woohoo__tr( "Don&rsquo;t worry we don&rsquo;t spam" ) . '</p>';
	return $html;
}