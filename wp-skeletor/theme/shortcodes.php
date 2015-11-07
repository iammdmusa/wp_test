<?php
/**
 * Theme Shortcodes
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

/**
 * Add some handy shortcodes for posts
 * Displays "content" conditionally, based on whether there is an active login
 *
 * @example [if_user_logged_in] content [/if_user_logged_in]
 * @example [if_not_user_logged_in] content [/if_not_user_logged_in]
 */
function if_user_logged_in_shortcode_handler($args, $content = null, $caller = null) {
	$args = shortcode_atts(array(), $args);

	// $caller defines our behaviour
	if (('if_user_logged_in' == $caller and is_user_logged_in())
		or ('if_not_user_logged_in' == $caller and ! is_user_logged_in())) {
		return do_shortcode($content);
	}
	else {
		return '';
	}
}
add_shortcode('if_user_logged_in', 'if_user_logged_in_shortcode_handler');
add_shortcode('if_not_user_logged_in', 'if_user_logged_in_shortcode_handler');