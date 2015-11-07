<?php
/**
 * Theme Menus
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

// usage: wp_nav_menu(array('id' => 'primary'));
register_nav_menus(array(
	'primary' => _('Primary Menu'),
	'footer' => _('Footer Menu')
));
