<?php
/**
 * BokMcDok functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BokMcDok
 */

/**
 * Handles the main theme setup.
 */
require get_template_directory() . '/inc/post-setup.php';

/**
 * Initialize widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueues Javascript files
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Our custom excerpts
 */
require get_template_directory() . '/inc/custom-excerpts.php';

/**
 * Our custom archive titles
 */
require get_template_directory() . '/inc/custom-archive-title.php';

/**
 * Implements the /random/ endpoint
 */
require get_template_directory() . '/inc/random-page.php';

/**
 * Implements a random quote shortcode
 */
require get_template_directory() . '/inc/random-quote.php';

/**
 * Implements a shortcode for release links
 */
require get_template_directory() . '/inc/release-links.php';

// Disable administration email verification
add_filter( 'admin_email_check_interval', '__return_false' );
