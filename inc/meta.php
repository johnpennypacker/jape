<?php
/**
 * Adds a bit of metadata to pages and posts to allow authors to show or hide the title and featured image
 *
 * @package jape
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

function jape_show_title( $post ) {
	$out = TRUE;
	$show = get_post_custom_values('_jape_show_title');
	if( is_array( $show ) ) {
		$out = $show[0];
	}
	return $out;
}

function jape_show_featured_image( $post ) {
	$out = TRUE;
	$show = get_post_custom_values('_jape_show_featured_image');
	if( is_array( $show ) ) {
		$out = $show[0];
	}
	return $out;
}
