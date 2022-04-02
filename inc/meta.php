<?php
/**
 * Adds a bit of metadata to pages and posts to allow authors to show or hide the title and featured image
 *
 * @package jape
 */


/**
 * Adds custom meta data fields to all post types.
 */
function jape_register_meta() {
	register_meta( 'post', '_jape_show_title', [
		'auth_callback' => '__return_true',
		'show_in_rest' => true,
		'single' => true,
		'type' => 'boolean',
		'default' => true
	] );
 
	register_meta( 'post', '_jape_show_featured_image', [
		'auth_callback' => '__return_true',
		'show_in_rest' => true,
		'single' => true,
		'type' => 'boolean',
		'default' => true
	] );
}
add_action( 'init', 'jape_register_meta' );


/**
 * Enqueues javascript to create metabox in the block editor
 */
function jape_meta_editor_script() {
	$file = '/js/meta.js';
	wp_enqueue_script(
		'jape-editor-customization', 
		get_template_directory_uri() . $file, 
		[ 'wp-edit-post' ],
		filemtime( get_template_directory() . $file ),
		FALSE
	);
}
add_action( 'enqueue_block_editor_assets', 'jape_meta_editor_script' );


/**
 * Checks the metadata to see if the title should appear.
 * @return bool
 */
function jape_show_title( $post ) {
	$out = TRUE;
	$show = get_post_custom_values('_jape_show_title');
	if( is_array( $show ) ) {
		$out = $show[0];
	}
	return $out;
}

/**
 * Checks the metadata to see if the featured image should appear.
 * @return bool
 */
function jape_show_featured_image( $post ) {
	$out = TRUE;
	$show = get_post_custom_values('_jape_show_featured_image');
	if( is_array( $show ) ) {
		$out = $show[0];
	}
	return $out;
}
