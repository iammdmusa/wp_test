<?php
/**
 * Theme Custom Post Types
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

/**
 * SKEL-ETOR Custom Post Types
 *
 * Uncomment add_action() to enable
 * Note: These settings are just boilerplates
 */

// add_action( 'init', 'skel_etor_create_post_type' );
function skel_etor_create_post_type() {

	// Post Type: "Post"
	$post_type = 'book';
	$post_type_label = 'Book';
	$post_type_label_plural = 'Books';
	register_post_type( $post_type, array(
		'labels' => array(
			'name' => $post_type_label,
			'singular_name' => $post_type_label,
			'add_new' => 'Add New',
			'add_new_item' => 'Add New ' . $post_type_label,
			'edit_item' => 'Edit ' . $post_type_label,
			'new_item' => 'New ' . $post_type_label,
			'all_items' => 'All ' . $post_type_label_plural,
			'view_item' => 'View ' . $post_type_label,
			'search_items' => 'Search ' . $post_type_label_plural,
			'not_found' =>  'No ' . $post_type . ' found',
			'not_found_in_trash' => 'No ' . $post_type . ' found in Trash',
			'parent_item_colon' => '',
			'menu_name' => $post_type_label
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => strtolower($post_type_label_plural),
			'with_front' => false,
		),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => get_stylesheet_directory_uri() .'/images/admin/icon-' . $post_type . '.png',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	));

	// Post Type: "Page"
	$post_type = 'book';
	$post_type_label = 'Book';
	$post_type_label_plural = 'Books';
	register_post_type( $post_type, array(
		'labels' => array(
			'name' => $post_type_label,
			'singular_name' => $post_type_label,
			'add_new' => 'Add New',
			'add_new_item' => 'Add New ' . $post_type_label,
			'edit_item' => 'Edit ' . $post_type_label,
			'new_item' => 'New ' . $post_type_label,
			'all_items' => 'All ' . $post_type_label_plural,
			'view_item' => 'View ' . $post_type_label,
			'search_items' => 'Search ' . $post_type_label_plural,
			'not_found' =>  'No ' . $post_type . ' found',
			'not_found_in_trash' => 'No ' . $post_type . ' found in Trash',
			'parent_item_colon' => '',
			'menu_name' => $post_type_label
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => strtolower($post_type_label_plural),
			'with_front' => false,
			'pages' => false
		),
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => true,
		'menu_position' => 5,
		'menu_icon' => get_stylesheet_directory_uri() .'/images/admin/icon-' . $post_type . '.png',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' )
	));

}

/**
 * SKEL-ETOR Custom Taxonomies
 *
 * Uncomment add_action() to enable
 */

// add_action( 'init', 'skel_etor_create_taxonomy', 0 );
function skel_etor_create_taxonomy() {

	// Taxonomy: Category
	$tax_type = 'book';
	$tax_type_label = 'Book';
	$tax_type_label_plural = 'Books';
	register_taxonomy( $tax_type . '-category', array( $tax_type ), array(
		'labels' => array(
			'name' => _x( $tax_type_label . ' Category', 'taxonomy general name' ),
			'singular_name' => _x( $tax_type_label . ' Category', 'taxonomy singular name' ),
			'search_items' => __( 'Search ' . $tax_type_label . ' Categories' ),
			'all_items' => __( 'All ' . $tax_type_label . ' Categories' ),
			'parent_item' => __( 'Parent ' . $tax_type_label . ' Category' ),
			'parent_item_colon' => __( 'Parent ' . $tax_type_label . ' Category:' ),
			'edit_item' => __( 'Edit ' . $tax_type_label . ' Category' ),
			'update_item' => __( 'Update ' . $tax_type_label . ' Category' ),
			'add_new_item' => __( 'Add New ' . $tax_type_label . ' Category' ),
			'new_item_name' => __( 'New ' . $tax_type_label . ' Category Name' ),
			'menu_name' => __( $tax_type_label_plural ),
		),
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => $tax_type . '-category' )
	));

	// Taxonomy: Tag
	$tax_type = 'book';
	$tax_type_label = 'Book';
	$tax_type_label_plural = 'Books';
	register_taxonomy( $tax_type.'-tag', array( $tax_type ), array(
		'labels' => array(
			'name' => _x( $tax_type_label . ' Tags', 'taxonomy general name' ),
			'singular_name' => _x( $tax_type_label . ' Tag', 'taxonomy singular name' ),
			'search_items' => __( 'Search ' . $tax_type_label . ' Tags' ),
			'popular_items' => __( 'Popular ' . $tax_type_label . ' Tags' ),
			'all_items' => __( 'All ' . $tax_type_label . ' Tags' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit ' . $tax_type_label . ' Tag' ),
			'update_item' => __( 'Update ' . $tax_type_label . ' Tag' ),
			'add_new_item' => __( 'Add New ' . $tax_type_label . ' Tag' ),
			'new_item_name' => __( 'New ' . $tax_type_label . ' Tag Name' ),
			'separate_items_with_commas' => __( 'Separate ' . $tax_type . ' tags with commas' ),
			'add_or_remove_items' => __( 'Add or remove ' . $tax_type . ' tags' ),
			'choose_from_most_used' => __( 'Choose from the most used ' . $tax_type . ' tags' ),
			'not_found' => __( 'No ' . $tax_type_label . ' Tags found.' ),
			'menu_name' => __( $tax_type_label_plural ),
		),
		'hierarchical' => false,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => $tax_type . '-tag' )
	));

}
