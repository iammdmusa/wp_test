<?php
/**
 * Theme Sidebars
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

// Home
register_sidebar(array(
	'name' => __( 'Home Sidebar' ),
	'id' => 'home-sidebar',
	'description' => __( 'Widgets in this area will be shown in the home sidebar.' ),
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));

// Main
register_sidebar(array(
	'name' => __( 'Main Sidebar' ),
	'id' => 'main-sidebar',
	'description' => __( 'Widgets in this area will be shown in the main sidebar.' ),
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));
