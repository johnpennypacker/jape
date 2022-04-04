<?php
/**
 * Display Posts Shortcode settings
 */


/**
 * Set DPS defaults.
 * @see https://displayposts.com/2019/01/04/change-default-attributes/
 */
function jape_dps_defaults( $out, $pairs, $atts ) {
	// always add dps as a wrapper class
	if( is_array( $out['wrapper_class'] ) ) {
		$out['wrapper_class'][] = 'dps';
	} else {
		$out['wrapper_class'] .= ' dps';
	}
	
// 	echo '<pre>';
// 	var_dump($out);
// 	echo '</pre>';

	$new_defaults = array( 
		'include_excerpt_dash' => FALSE,
		'wrapper' => 'div',
	);
	
	foreach( $new_defaults as $name => $default ) {
		if( array_key_exists( $name, $atts ) )
			$out[$name] = $atts[$name];
		else
			$out[$name] = $default;
	}
	
	return $out;
}
add_filter( 'shortcode_atts_display-posts', 'jape_dps_defaults', 10, 3 );

