<?php
/**
 * Theme Functions
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

/*
TABLE OF CONTENTS

TEMPLATE FUNCTIONS
- get_slug
- the_slug
- page_id_from_slug
- category_id_from_slug
THEME FUNCTIONS
- skel_etor_excerpt
- has_post_thumbnail_caption
- the_post_thumbnail_caption
- skel_etor_format_date_time
*/

/**
 * =============== TEMPLATE FUNCTIONS ===============
 */



add_filter( "gform_after_submission_2", 'jdn_set_post_acf_gallery_field', 10, 2 );
function jdn_set_post_acf_gallery_field( $entry, $form ) {
    $gf_images_field_id = 19; // the upload field id
    $acf_field_id = 'field_5623d8946c556'; // the acf gallery field id
    // get post
    if( isset( $entry['post_id'] ) ) {
        $post = get_post( $entry['post_id'] );
        if( is_null( $post ) )
            return;
    } else {
        return;
    }
    // Clean up images upload and create array for gallery field
    if( isset( $entry[ $gf_images_field_id ] ) ) {
        $images = stripslashes( $entry[ $gf_images_field_id ] );
        $images = json_decode( $images, true );
        if( !empty( $images ) && is_array( $images ) ) {
            $gallery = array();
            foreach( $images as $key => $value ) {
                if( function_exists( 'jdn_create_image_id' ) )
                    $image_id = jdn_create_image_id( $value, $post->ID );
                if( $image_id ) {
                    $gallery[] = $image_id;
                }
            }
        }
    }
    // Update gallery field with array
    if( ! empty( $gallery ) ) {
        update_field( $acf_field_id, $gallery, $post->ID );
        // Updating post
        wp_update_post( $post );
    }
}


/**
 * Other function needed. This is to get image attachment ID
 *
 * @author Joshua David Nelson, josh@joshuadnelson.com
 * Source: https://gist.github.com/joshuadavidnelson/164a0a0744f0693d5746
 */



function jdn_create_image_id( $image_url, $parent_post_id = null ) {

    if( !isset( $image_url ) )
        return false;

    // Cache info on the wp uploads dir
    $wp_upload_dir = wp_upload_dir();
    // get the file path
    $path = parse_url( $image_url, PHP_URL_PATH );

    // File base name
    $file_base_name = basename( $image_url );

    // Full path
    // Full path
    if( site_url() != home_url() ) {
        $home_path = dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) );
    } else {
        $home_path = dirname( dirname( dirname( dirname( __FILE__ ) ) ) );
    }
    //$home_path = get_home_path();
    $home_path = untrailingslashit( $home_path );
    $uploaded_file_path = $home_path . $path;

    // Check the type of file. We'll use this as the 'post_mime_type'.
    $filetype = wp_check_filetype( $file_base_name, null );

    // error check
    if( !empty( $filetype ) && is_array( $filetype ) ) {
        // Create attachment title
        $post_title = preg_replace( '/\.[^.]+$/', '', $file_base_name );

        // Prepare an array of post data for the attachment.
        $attachment = array(
            'guid' => $wp_upload_dir['url'] . '/' . basename( $uploaded_file_path ),
            'post_mime_type' => $filetype['type'],
            'post_title' => esc_attr( $post_title ),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        // Set the post parent id if there is one
        if( !is_null( $parent_post_id ) )
            $attachment['post_parent'] = $parent_post_id;

        // Insert the attachment.
        $attach_id = wp_insert_attachment( $attachment, $uploaded_file_path );

        //Error check
        if( !is_wp_error( $attach_id ) ) {
            //Generate wp attachment meta data
            if( file_exists( ABSPATH . 'wp-admin/includes/image.php') && file_exists( ABSPATH . 'wp-admin/includes/media.php') ) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $uploaded_file_path );
                wp_update_attachment_metadata( $attach_id, $attach_data );
            } // end if file exists check
        } // end if error check
        return $attach_id;
    } // end if $$filetype
} // end function get_image_id





add_action('gform_after_submission_2', 'gfToAcfListToRepeater', 10, 2);
function gfToAcfListToRepeater($entry, $form){
    foreach ($form['fields'] as $field) {
        if (!($field['type'] == 'post_custom_field' && $field['inputType'] == 'list' && $field['enableColumns'] == true)) {
            continue;
        }
        $id = $field['id'];
        $postId    = $entry["post_id"];
        $acfFields = unserialize($entry[$id]);
        $fieldName = $field['postCustomFieldName'];
        $count = 0;
        foreach ($acfFields as $item) {
            foreach ($item as $key => $value) {
                $acfKey = str_replace(' ', '_', strtolower($key));
                $acfFieldName = $fieldName . '_' . $count . '_' . $acfKey;
                update_post_meta($postId, $acfFieldName, $value);
            }
            $count++;

        };
        update_post_meta($postId, $fieldName, count($acfFields));
    }
}
add_action("gform_after_submission_2", "acf_post_submission", 10, 2);
function acf_post_submission ($entry, $form)
{
    $field_key = 'field_5623d8c56c557';
    $post_id = $entry["post_id"];
    $value = get_field($field_key, $post_id);
    $value[] = array('app_id' => $entry[3],'app_cover' => $entry[1]);
    update_field($field_key, $value, $post_id);
}


// Get post slug
if ( ! function_exists('get_slug') ) {
	function get_slug() {
		$post_data = get_post($post->ID, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug;
	}
}

// Echo post slug
if ( ! function_exists('the_slug') ) {
	function the_slug() {
		$post_data = get_post($post->ID, ARRAY_A);
		$slug = $post_data['post_name'];
		return _e($slug);
	}
}

// Get page_id from page_slug
if ( ! function_exists('page_id_from_slug') ) {
	function page_id_from_slug($slug) {
		$page = get_page_by_path($slug);
		if ($page) {
			return $page->ID;
		}
		return null;
	}
}

// Get category id from slug
if ( ! function_exists('category_id_from_slug') ) {
	function category_id_from_slug($slug) {
		$category = get_category_by_slug($slug);
		if ($category) {
			return $category->term_id;
		} else {
			return null;
		}
	}
}

// Test for subpage
if ( ! function_exists('is_subpage') ) {
	function is_subpage() {
		global $post;

		if ( is_page() && $post->post_parent ) {
			return $post->post_parent;
		} else {
			return false;
		}
	}
}

/**
 * =============== THEME FUNCTIONS ===============
 */

// Custom excerpts
if ( ! function_exists('skel_etor_excerpt') ) {
	function long_excerpt($length) {
		return 55;
	}
	function short_excerpt($length) {
		return 20;
	}
	function more_excerpt($more) {
		return '...';
	}
	function more_permalink() {
		return '<p class="more"><a href="'.get_permalink($post->ID).'">Read more</a></p>';
	}
	function more_inline_permalink() {
		return '<a href="'.get_permalink($post->ID).'" class="more-link">Read more</a>';
	}

	// Applying the excerpts
	function skel_etor_excerpt($length_callback='', $more_callback='') {
		global $post;
		if(function_exists($length_callback)){
			add_filter('excerpt_length', $length_callback);
		}
		if(function_exists($more_callback)){
			add_filter('excerpt_more', $more_callback);
		}
		$output = get_the_excerpt();
		$output = apply_filters('wptexturize', $output);
		$output = apply_filters('convert_chars', $output);
		$output = '<p>'.$output.'</p>';
		echo $output;
	}
}

/**
 * Check if thumbnail has a caption attached
 *
 * Must be used in the loop
 *
 * @return (bool) True/False
 */

if ( ! function_exists('has_post_thumbnail_caption')) {
	function has_post_thumbnail_caption() {
		global $post;

		$thumbnail_id = get_post_thumbnail_id($post->ID);
		$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

		if ($thumbnail_image AND isset($thumbnail_image[0]))
			return ( ! empty($thumbnail_image[0]->post_excerpt) ) ? true : false;
	}
}

/**
 * Adds the attached caption from a feature image
 *
 * Must be used in the loop
 *
 * @param $with_markup - output caption HTML wrapper. True|False. Default: False
 * @return (string) Caption HTML + Caption text
 */

if ( ! function_exists('the_post_thumbnail_caption')) {
	function the_post_thumbnail_caption($with_markup = false) {
		global $post;

		$thumbnail_id = get_post_thumbnail_id($post->ID);
		$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

		if ($thumbnail_image AND isset($thumbnail_image[0])) {
			if ( $with_markup == true )
				echo '<span class="caption">'.$thumbnail_image[0]->post_excerpt.'</span>';
			else
				echo $thumbnail_image[0]->post_excerpt;
		}

	}
}

/**
 * Date Formatter
 *
 * Feed the function a date format and it will outout a nicely formatted date string
 * @uses ACF fields for 'start_date' and 'end_date'
 *
 * @param (string) $format - The desired format the be displayed. Options: 'd M Y' | 'g:i'.
 * @param (int) $post_id - Defaults to current post id, can be force fed
 *
 * @return (string) formatted date string
 */

function skel_etor_format_date_time( $format = 'd M Y',  $post_id = '' ) {
	global $post;

	if ( ! $post_id )
		$post_id = $post->ID;
	else
		$post_id = $post_id;

	$start_date = get_field('start_date', $post_id);
	$end_date =  get_field('end_date', $post_id);

	$s_date = new Datetime( $start_date );
	$e_date = new Datetime( $end_date );

	// Date Format
	if ( $format == 'd M Y' ) {
		if ( $s_date->format('d M Y') == $e_date->format('d M Y') ) {    // Same day
			$str = $s_date->format('d M Y');
		} elseif ( $s_date->format('Y') == $e_date->format('Y') ) {    // Same Year
			if ( $s_date->format('M') == $e_date->format('M') ) {    // Same Month
				$str = $s_date->format('d') . ' &mdash; ' . $e_date->format('d M Y');
			} else {    // Same Month + Year
				$str = $s_date->format('d M') . ' &mdash; ' . $e_date->format('d M Y');
			}
		} else {    // Different Year
			$str = $s_date->format('d M Y') . ' &mdash; ' . $e_date->format('d M Y');
		}
	// Time Format
	} elseif ( $format == 'g:i' ) {
		$str = $s_date->format('g:ia');
	}

	echo $str;
}


add_action('admin_menu', 'my_admin_add_page');
function my_admin_add_page() {
    $my_admin_page = add_options_page(__('My Admin Page', 'map'), __('My Admin Page', 'map'), 'manage_options', 'map', 'my_admin_page');

    // Adds my_help_tab when my_admin_page loads
    add_action('load-'.$my_admin_page, 'my_admin_add_help_tab');
}

function my_admin_add_help_tab () {
    $screen = get_current_screen();

    // Add my_help_tab if current screen is My Admin Page
    $screen->add_help_tab( array(
        'id'	=> 'my_help_tab',
        'title'	=> __('My Help Tab'),
        'content'	=> '<p>' . __( 'Descriptive content that will show in My Help Tab-body goes here.' ) . '</p>',
    ) );
}
