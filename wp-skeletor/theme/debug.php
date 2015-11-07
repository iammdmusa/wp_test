<?php
/**
 * Theme Debugging Helpers
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

/**
 * Readable error output/debugging
 *
 * @example ppr($var);		// Simple inline style
 * @example ppro($var);		// Overlay style for cumbersome output
 */
if ( ! function_exists('ppr') AND ! function_exists('ppro')) {
	function ppr($v) {
		echo '<pre>'.htmlentities(print_r($v,true)).'</pre>';
	}
	function ppro($v) {
		echo '<div class="ppro" style="position:fixed;bottom:50px;right:50px;width:70%;height:60%;overflow:auto;color:#000;background:rgba(255,255,255,0.85);font-size:11px;"><pre>'.htmlentities(print_r($v,true)).'</pre></div>';
	}
}

/**
 * Template debugging information
 *
 * Temporary usage: http://domain.com/?debug=1
 */
if ( isset($_GET['debug']) OR WP_DEBUG) {
	/**
	 * The Query WP is trying to fetch
	 */
	add_action('loop_start', 'wp_fetching');
	function wp_fetching() {
		global $wp;
		echo '<pre>';
		echo "REQUEST: ".$wp->request."<br />";
		echo "MATCHED_RULE: ".$wp->matched_rule."<br />";
		echo "MATCHED_QUERY: ".$wp->matched_query."<br />";
		echo '</pre>';
	}
	/**
	 * The template filename WordPress is currently using to display content
	 *
	 * Only show's top level templates, i.e. will not show get_template_part()'s'
	 */
	add_action('loop_start', 'show_template');
	function show_template() {
		global $template;
		echo '<pre>CURRENT TEMPLATE: '.basename($template).'</pre>';
	}
}
