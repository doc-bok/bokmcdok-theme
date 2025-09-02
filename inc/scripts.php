<?php

/**
 * Enqueue scripts and styles.
 */
function bokmcdok_scripts(): void {
	wp_enqueue_style(
		'bokmcdok-style',
		get_stylesheet_uri()
	);

	wp_enqueue_script(
		'bokmcdok-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array(),
		'20151215',
		true );

	wp_enqueue_script(
		'bokmcdok-skip-link-focus-fix',
		get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		array(),
		'20151215',
		true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Adds colors to dialogue
	wp_enqueue_script(
		'bokmcdok-dialogue-colors',
		get_template_directory_uri() . '/js/dialogue-colors.js',
		array(), // dependencies
		'1.0.0',
		true // load in the footer
	);
}
add_action( 'wp_enqueue_scripts', 'bokmcdok_scripts' );