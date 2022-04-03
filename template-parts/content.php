<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jape
 */
 
if( is_singular() ) {
	$classes = 'singular';
	get_template_part( 'template-parts/single', '', array('classes' => 'singular') );
} else {
	$classes = 'excerpt';
	get_template_part( 'template-parts/excerpt', '', array('classes' => 'excerpt'));
}

?>