<?php
/**
 * Theme Hooks
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 *
 * Functions are defined in @see theme-actions.php then attached to an add_action in this file.
 *
 * These add_actions are then executed by their respective do_action call within theme templates
 * For more information: {@link http://codex.wordpress.org/Function_Reference/add_action}
 *
 * @example add_action( $tag, $function_to_add, $priority, $accepted_args );
 */

/*
TABLE OF CONTENTS

PAGE
- skel_etor_share
POST
- skel_etor_share
*/

/**
 * TEMPLATES
 */

if ( ! is_admin() ) { // Actions on the front end

	// HEADER

	// FOOTER

	// PAGE
	add_action('skel_etor_page_footer', 'skel_etor_share');

	// SINGLE
	add_action('skel_etor_post_footer', 'skel_etor_share');

	// POST TYPE

}