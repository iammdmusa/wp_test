<?php
/**
 * The page template
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */
?>

<article id="post-<?php echo get_the_ID(); ?>" <?php post_class() ?>>
	<header>
		<h1><?php the_title(); ?></h1>
	</header>
	<div class="entry">
		<?php the_content(); ?>
	</div>
	<footer>
		<?php do_action('skel_etor_page_footer'); ?>
	</footer>
</article>