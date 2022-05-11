<?php
/**
 * a few custom blocks
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

require_once get_template_directory() . '/blocks/sidler/index.php';

// require_once get_template_directory() . '/blocks/01-basic/index.php';

// function jape_register_sidler() {
// 
// 	$block = register_block_type( get_template_directory() . '/blocks/sidler/' );
// 
// // 	echo '<pre>';
// // 	var_dump ($block);
// // 	echo '</pre>';
// 
// }
// add_action( 'init', 'jape_register_sidler' );


// function jape_block_sidler() {
// 	wp_enqueue_script( 'jape-sidler-editor', get_template_directory() . '/blocks/sidler/editor.js', array(), strtotime('now'), true );
// }
// add_action( 'enqueue_block_editor_assets', 'jape_block_sidler' );
// 
// function jape_sidler_script() {
// 	wp_enqueue_script( 'jape-sidler', get_template_directory() . '/blocks/sidler/sidler.js', array(), strtotime('now'), true );
// }
// add_action( 'wp_enqueue_scripts', 'jape_sidler_script' );
