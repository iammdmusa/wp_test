<?php
/**
 * Theme Enqueue
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

/**
 * Theme styles
 *
 * @example wp_enqueue_style( $handle, $src , $deps, $ver, $in_footer );
 */

add_action('wp_enqueue_scripts', 'skel_etor_enqueue_styles', 20, 1);
function skel_etor_enqueue_styles() {
	// Styles loaded for front end only
	if ( ! is_admin() ) {
		wp_enqueue_style('style', get_template_directory_uri().'/style.css');
        wp_enqueue_style('bootstrap-css',get_stylesheet_directory_uri().'/css/bootstrap.min.css');
        wp_enqueue_style('wow-css',get_stylesheet_directory_uri().'/css/animate.css');
        wp_enqueue_style('main-css',get_stylesheet_directory_uri().'/css/theme.css');
	}
}

add_action('wp_enqueue_scripts', 'skel_etor_cdn_resources', 10, 1);		// @see enqueue.php
add_action('wp_enqueue_scripts', 'skel_etor_enqueue_styles', 20, 1);	// @see enqueue.php
add_action('wp_enqueue_scripts', 'skel_etor_enqueue_scripts', 30, 1);	// @see enqueue.php
/**
 * Theme scripts
 *
 * @example wp_enqueue_script( $handle => string, $src => string, $deps => array(), $ver => string, $in_footer => bool );
 */
add_action('wp_enqueue_scripts', 'skel_etor_enqueue_scripts', 30, 1);
function skel_etor_enqueue_scripts() {
	if ( ! is_admin() ) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-js',get_stylesheet_directory_uri().'/js/bootstrap.min.js',array(),'',true);
		wp_enqueue_script('modernizr', get_template_directory_uri().'/js/libs/modernizr-2.6.2.min.js');
        wp_enqueue_script('wow-js',get_stylesheet_directory_uri().'/js/wow.min.js',array(),'',true);
		wp_enqueue_script('chromeframe', '//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js');
		wp_enqueue_script('respond', get_template_directory_uri().'/js/min/respond.min.js', array(), '1.0', true);
		wp_enqueue_script('plugins', get_template_directory_uri().'/js/min/plugins.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('script', get_template_directory_uri().'/js/script.js', array('jquery', 'plugins'), '1.0', true);
	}
}

/**
 * External resoruces
 */

/**
 * CDN Resources
 */

add_action('wp_enqueue_scripts', 'skel_etor_cdn_resources', 10, 1);
function skel_etor_cdn_resources() {

	if ( ! is_admin() ) {

		/**
		 * Flexslider
		 *
		 * @link http://cdnjs.com/libraries/flexslider
		 */
		if ( SKEL_ETOR_FLEXSLIDER ) {
			wp_enqueue_style('flexslider', '//cdnjs.cloudflare.com/ajax/libs/flexslider/2.2.0/flexslider-min.css');
			wp_enqueue_script('flexslider', '//cdnjs.cloudflare.com/ajax/libs/flexslider/2.2.0/jquery.flexslider-min.js', array(), '1.0', true);
		}

		/**
		 * FontAwesome
		 *
		 * @link http://fontawesome.io/
		 */
		if ( SKEL_ETOR_FONTAWESOME ) {
			wp_enqueue_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');
		}

		/**
		 * Google Fonts
		 */
		if ( SKEL_ETOR_GOOGLEFONTS ) {
			wp_enqueue_style( 'skel-etor-google-font', '//fonts.googleapis.com/css?family=Karla', array(), '1.0' );
            wp_enqueue_style('Open_Sans_all','http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic','',false);
		}

	}
}

/**
 * Google Maps API
 *
 * Use conditional loading to limit API calls
 */
add_action('wp_enqueue_scripts', 'skel_etor_google_maps_api');
function skel_etor_google_maps_api() {
	// Update condition
	if ( get_post_type() == 'gmaps_post_type_condition' ) {
		wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
	}
}