<?php
/**
 * jape theme header bits
 *
 * @package jape
 */

/**
 * Adds Google Tag Manager code to <head>
 */
function jape_gtm() {
	$gtm = '';
	echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . $gtm . "');</script>";
}
// add_action( 'wp_head', 'jape_gtm' );



/**
 * Add open graph elements to the <head>
 *
 * @todo: allow other twitter handles
 */
function jape_open_graph() {
	global $post;
	
	$summary_type = 'summary';
	$image_thumb = FALSE;
	
	if ( is_single() || is_page() ) {
		
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		if ( FALSE !== $image ) {
			// use a larger image in twitter card if the image is wider than it is tall.
			$landscape = ( $image[1] > $image[2] );
			if ( true === $landscape ) {
				$summary_type = 'summary_large_image';
			}

			$image_thumb = $image[0];
			if ( empty( $image_thumb ) ) {
				$image_thumb  = get_template_directory_uri() . '/images/logo.png';
				$summary_type = 'summary_large_image';
			}
		}


		$title = get_the_title();
		if ( empty( $title ) ) {
			$title = get_bloginfo( 'name', 'display' );
		}

		$excerpt = get_the_excerpt();

		if ( empty( $excerpt ) ) {
			if ( strpos( $post->post_content, '<!--more' ) !== false ) {
				$bits = explode( '<!--more', $post->post_content );
			} else {
				$bits = explode( "\n", wordwrap( $post->post_content, 400 ) );
			}
			$excerpt = $bits[0];
		}

		$excerpt = do_shortcode( $excerpt ); // parse shortcodes
		$excerpt = preg_replace( '/(<[^>]+>)+/', ' ... ', $excerpt ); // replace html
		$excerpt = ltrim( $excerpt, ' .' ); // remove leading points of ellipses from replace
		$excerpt = str_replace( '"', '&quot;', $excerpt ); // sanitize quotes
		$excerpt = trim( $excerpt ); // remove whitespace on either end
		
		echo "\n" . '<meta name="description" content="' . $excerpt . '" />';
		echo "\n" . '<meta name="twitter:card" content="' . $summary_type . '" />';
		echo "\n" . '<meta name="twitter:site" content="@johnpennypacker" />';
		echo "\n" . '<meta name="twitter:creator" content="@johnpennypacker" />';
		echo "\n" . '<meta property="og:url" content="' . get_permalink() . '" />';
		echo "\n" . '<meta property="og:title" content="' . $title . '" />';
		echo "\n" . '<meta property="og:description" content="' . $excerpt . '" />';
		if ( FALSE !== $image_thumb ) {
			echo "\n" . '<meta property="og:image" content="' . $image_thumb . '" />';
		}
	}
}

// activate open graph is Yoast is not installed
if ( ! defined( 'WPSEO_VERSION' ) ) {
	add_action( 'wp_head', 'jape_open_graph' );
}

