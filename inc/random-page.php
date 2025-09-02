<?php

/**
 * Random Page Redirect
 */

// Add rewrite rule for /random
add_action('init', function() {
	global $wp;
	$wp->add_query_var('random');
	add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
});

// Handle redirect to a random post
add_action('template_redirect', function() {
	if (intval(get_query_var('random')) === 1) {
		$posts = get_posts([
			'post_type'      => 'post',
			'orderby'        => 'rand',
			'posts_per_page' => 1,
			'post_status'    => 'publish'
		]);

		if (!empty($posts)) {
			wp_redirect(get_permalink($posts[0]), 307);
		} else {
			wp_redirect(home_url()); // fallback if no posts
		}
		exit;
	}
});

// Ensure /random works after theme activation
function bokmcdok_flush_rewrite_rules(): void {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'bokmcdok_flush_rewrite_rules' );