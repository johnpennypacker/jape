<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jape
 */

  $args['classes'] = 'excerpt';
  // extract($args);
  $inner_wrapper = $args['inner_wrapper'];  // this can be safer than extract() on everything
  $class = $args['class'];
  $class[] = 'dps';

	echo '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">';
	get_template_part( 'template-parts/teaser', '', $args );
	echo '</' . $inner_wrapper . '>';  
  
  
?>
