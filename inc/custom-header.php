<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package jape
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses jape_header_style()
 */
function jape_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'jape_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => '',
				'flex-height'        => true,
				'wp-head-callback'   => 'jape_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'jape_custom_header_setup' );


/**
 * adds css for customized header.
 */
function jape_add_custom_header_styles() {

	if ( ! jape_is_minimal() && has_header_image() ) {
		$header_image = get_theme_mod( 'header_image_data' );
		
		$style_properties = array(
			'background-image' => 'url(' . get_header_image() . ')',
			'background-position' => '50% 50%',
			'background-size' => 'cover',
			'display' => 'flex',
			'flex-direction' => 'column',
			'justify-content' => 'flex-end',
			'min-height' => $header_image->height . 'px;',			
		);
		$css = '.site-header { ';
		foreach( $style_properties as $prop => $value ) {
			$css .= $prop . ':' . $value . ';';
		}
		$css .= '}';
		wp_register_style( 'jape-custom-header-image', false );
		wp_enqueue_style( 'jape-custom-header-image' );
		wp_add_inline_style( 'jape-custom-header-image', $css );
	}
}
add_action( 'wp_enqueue_scripts', 'jape_add_custom_header_styles', 100 );


if ( ! function_exists( 'jape_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see jape_custom_header_setup().
	 */
	function jape_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
