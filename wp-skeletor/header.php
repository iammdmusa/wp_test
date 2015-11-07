<?php
/**
 * The header for our theme
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

?><!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="utf-8">

<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );
	$site_description = get_bloginfo( 'description', 'display' ); // Add the blog description for the home/front page.
	if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'skel_etor' ), max( $paged, $page ) ); // Add a page number if necessary:
?>
</title>

<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="viewport" content="width=device-width">

<!-- FACEBOOK OG META -->
<?php if( is_home() ) { ?>
	<meta property="og:url" content="<?php echo home_url(); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php bloginfo('name'); ?>" />
	<meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook-share.gif" />
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	<meta property="og:site_name" content="<?php echo site_url('/'); ?>"/>
<?php } ?>

<link rel="shortcut icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

