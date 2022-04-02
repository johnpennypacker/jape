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
} else {
	$classes = 'excerpt';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) {
			if ( jape_show_title( $post ) ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			}
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				jape_posted_on();
				jape_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php jape_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'jape' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jape' ),
					'after'  => '</div>',
				)
			);
		else :
			the_excerpt();			
			echo sprintf(
				__( '<a href="%s" class="continue">Continue reading<span class="screen-reader-text"> "%s"</span></a>', 'jape' ),
					wp_kses_post( get_the_permalink() ),
					wp_kses_post( get_the_title() )
				);		
		endif;
		?>
	</div><!-- .entry-content -->

<?php if ( is_singular() ) : ?>
	<footer class="entry-footer">
		<?php jape_entry_footer(); ?>
	</footer><!-- .entry-footer -->
<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
