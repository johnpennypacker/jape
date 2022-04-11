<?php
/**
 * This theme also styles the user-facing login screens.  
 * I mean, why wouldn't it?
 *
 * @package jape
 */

/**
 * shut off the "verify admin email" message
 */
add_filter( 'admin_email_check_interval', '__return_false' );

/**
 * Include css and js
 */
function jape_login_enqueues() {
	wp_register_style( 'jape-login', get_stylesheet_uri() );
	wp_enqueue_style( 'jape-login' );

	$logo = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );
	if ( $logo ) {
		$css = '.login h1 a { background-image: url(' . $logo . '); }';
		wp_register_style( 'jape-login-logo', false );
		wp_enqueue_style( 'jape-login-logo' );
		wp_add_inline_style( 'jape-login-logo', $css );
	}
	
	wp_enqueue_style( 'dashicons' );
	wp_dequeue_style( 'login' );

}
add_action( 'login_enqueue_scripts', 'jape_login_enqueues' );

/**
 * Modify login logo url
 */
function jape_login_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'jape_login_url' );

/**
 * Modify login logo tooltip
 */
function jape_login_title() {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'jape_login_title' );


/**
 * Modify the forgot password link
 */
// function jape_lost_password_url( $lostpassword_url, $redirect ) {
// 	$url = 'https://sso.example.com/';
// 	return $url;
// }
// add_filter( 'lostpassword_url', 'jape_lost_password_url', 10, 2 );
