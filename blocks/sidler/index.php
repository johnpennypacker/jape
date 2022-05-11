<?php
/**
 * a few custom blocks
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');


function jape_register_sidler() {
	$block = register_block_type( __DIR__ );	
	// the block.json properties to load files aren't working here
	$block->editor_script = 'jape-sidler-editor';
}
add_action( 'init', 'jape_register_sidler' );


function jape_sidler_script() {
	wp_enqueue_script( 'jape-sidler', get_template_directory() . '/blocks/sidler/sidler.js', array(), jape_cache_buster(), true );
}
add_action( 'wp_enqueue_scripts', 'jape_sidler_script' );


function jape_sidler_editor() {
	wp_register_script(
		'jape-sidler-editor',
		get_template_directory() . '/blocks/sidler/editor.js',
		array( 'wp-blocks', 'wp-element' )
	);

	wp_enqueue_style( 'jape-sidler-editor', get_template_directory_uri() . '/blocks/sidler/editor.css', array(), jape_cache_buster() );
}
add_action( 'enqueue_block_editor_assets', 'jape_sidler_editor' );
