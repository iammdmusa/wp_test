<?php
/**
 * Theme Setup
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

// Custom post type's and taxonomy's
require( get_template_directory() . '/theme/post-types.php');

// Set content width value based on the theme's design
if ( ! isset( $content_width ) )
	$content_width = 600;

/**
 * Theme Supports + Menus + Sidebars
 */

add_action('after_setup_theme', 'skel_etor_setup');
function skel_etor_setup() {

	require( get_template_directory() . '/theme/menus.php');
	require( get_template_directory() . '/theme/sidebars.php');

	if ( function_exists('add_theme_support')) {

		/**
		 * Feature Images
		 */

		// Enable Post Thumbnails and define our special image sizes
		add_theme_support('post-thumbnails');
		//add_image_size('feature-thumbnail', 920, 450, true);
		//add_image_size('single-thumbnail', 590, 450, true);
        add_image_size('preview_img', 620, 250, true);


        /**
		 * Custom Background
		 */

		$background_args = array(
			'default-color' => '',
			'default-image' => '',
			'wp-head-callback' => '_custom_background_cb',
			'admin-head-callback' => '',
			'admin-preview-callback' => ''
		);
		add_theme_support('custom-background', $background_args);

		/**
		 * RSS
		 */

		// Post and Comment RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
	}
}