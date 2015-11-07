<?php
/**
 * The post template
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */
?>

<article id="post-<?php echo get_the_ID(); ?>" <?php post_class() ?>>
	<header>
		<h1>
			<?php if ( ! is_single() ) : ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
				<?php the_title(); ?>
			<?php if ( ! is_single() ) : ?></a><?php endif; ?>
		</h1>
		<?php if ( is_single() ) : ?>
			<span class="meta">
				<span class="date"><?php the_time(''); ?></span>
				<span class="tags"><?php the_tags(); ?></span>
			</span>
		<?php endif; ?>
	</header>
	<?php if ( is_single() AND has_post_thumbnail() ) : ?>
		<div class="thumb">
			<?php the_post_thumbnail('single-thumbnail'); ?>
		</div>
	<?php endif; ?>
	<div class="entry">
		<?php the_content(); ?>
	</div>
	<footer>
		<?php do_action('skel_etor_post_footer'); ?>
	</footer>
</article>