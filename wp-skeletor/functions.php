<?php
/**
 * SKEL-ETOR functions and definitions
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 *
 * match case - find -> replace: 'SKEL-ETOR' -> Template Names ("SKEL-ETOR 2012") E.g. The Nest
 * match case - find -> replace: 'SKEL_ETOR' -> Theme/Front-End names ("SKEL_ETOR_URL") E.g. THE_NEST_CONSTANT
 * match case - find -> replace: 'skel_etor' -> Function/Variable names ("skel_etor"_excerpt();) E.g. the_nest
 * match case - find -> replace: 'skel-etor' -> Option Names (some_function("skel-etor"-option)); E.g. the-nest
 *
 */

require( get_template_directory() . '/theme/constants.php');
require( get_template_directory() . '/theme/debug.php');
require( get_template_directory() . '/theme/classes.php');
require( get_template_directory() . '/theme/functions.php');
require( get_template_directory() . '/theme/enqueue.php');
require( get_template_directory() . '/theme/shortcodes.php');
require( get_template_directory() . '/theme/setup.php');
require( get_template_directory() . '/theme/actions.php');
require( get_template_directory() . '/theme/filters.php');
require( get_template_directory() . '/theme/theme-actions.php');
require( get_template_directory() . '/theme/theme-hooks.php');