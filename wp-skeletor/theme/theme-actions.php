<?php
/**
 * Theme Actions
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 *
 * Functions defined here will never 'do' anything unless are attached to @see theme-hooks.php
 * No add_action's should be called here, add them to @see theme-hooks.php instead
 *
 * @see theme/theme-hooks.php
 */



/**
 * SKEL-ETOR Share
 */

function skel_etor_share() {
	ob_start(); ?>
	<div class="share">
		<p>SHARE HTML</p>
	</div>
	<?php $html = ob_get_clean();
	echo $html;
}