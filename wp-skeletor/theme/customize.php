<?php
/**
 * @todo
 */

/**
 * Theme Customisation Settings
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

function skel_etor_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
	$wp_customize->add_setting('header_textcolor', array(
		'default' => '#000000',
		'transport' => 'refresh'
	));
}
// add_action( 'customize_register', 'skel_etor_customize_register' );