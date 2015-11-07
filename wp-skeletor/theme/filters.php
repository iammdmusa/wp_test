<?php
/**
 * WP Filters
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

/*
* Adds a header to WordPress
*
* @return array Where header => header value
*/
function skel_etor_add_header($headers) {
	$headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
	return $headers;
}
add_filter('wp_headers', 'skel_etor_add_header');

/**
 * Limit post revisions
 *
 * @see http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_revisions_to_keep
 */
function skel_etor_revisions( $num ) {
	$num = 5;
    return $num;
}
add_filter('wp_revisions_to_keep', 'skel_etor_revisions', 10 );

/**
  * Enable shortcodes in widgets
  */
add_filter('widget_text', 'do_shortcode' );

/**
 * add category nicenames in body and post class
 */
function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

/**
 * Empty search fix
 */
function skel_etor_search_fix_filter($query_vars) {
	if (isset($_GET['s']) and empty($_GET['s'])) {
		$query_vars['s'] = "&#00;"; // No posts should have NUL in them
	}
	return $query_vars;
}
add_filter('request', 'skel_etor_search_fix_filter');

/**
 * Register tag [site-url] for use in posts and widgets
 */
function filter_site_url($text) {
	return str_replace('[site-url]',get_bloginfo('url'), $text);
}
add_filter('the_content', 'filter_site_url');
add_filter('get_the_content', 'filter_site_url');
add_filter('widget_text', 'filter_site_url');

/**
 * Register tag [template-url] for use in posts and widgets
 */
function filter_template_url($text) {
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}
add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');

/**
 * "Made by The Nest" admin footer text
 */
function tn_wordpress_footer() {
	echo 'Made by <a href="http://www.wearethenest.com" target="_blank">The Nest</a> on WordPress';
}
add_filter('admin_footer_text', 'tn_wordpress_footer');
