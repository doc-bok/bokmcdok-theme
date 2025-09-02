<?php

/**
 * Generate Bok's Banging Butterflies Release Links
 */

// Generate a single download list item.
function generate_bok_butterfly_release_link($mod_version, $mod_loader, $minecraft_version): string {
	$url = sprintf(
		'https://github.com/doc-bok/Butterflies/releases/download/v%s-for-%s/butterflies-%s.jar',
		esc_attr($mod_version),
		esc_attr($minecraft_version),
		esc_attr($mod_version)
	);

	$link_text = esc_html($mod_loader . ' ' . $minecraft_version);

	return sprintf('<li><a href="%s">%s</a></li>', esc_url($url), $link_text);
}

// Shortcode handler to render the full list.
function generate_bok_butterfly_release_links($attributes): string {
	$attributes = shortcode_atts([
		'version' => '6.0.0',
	], $attributes, 'bok_butterfly_release_links');

	$version = $attributes['version'];

	$releases = [
		['loader' => 'NeoForge', 'mc' => '1.21.4'],
		['loader' => 'NeoForge', 'mc' => '1.21.1'],
		['loader' => 'NeoForge', 'mc' => '1.20.4'],
		['loader' => 'Forge',    'mc' => '1.20.2'],
		['loader' => 'Forge',    'mc' => '1.20.1'],
		['loader' => 'Forge',    'mc' => '1.19.2'],
		['loader' => 'Forge',    'mc' => '1.18.2'],
	];

	$output = '<ul class="wp-block-list">';
	foreach ($releases as $release) {
		$output .= generate_bok_butterfly_release_link($version, $release['loader'], $release['mc']);
	}
	$output .= '</ul>';

	return $output;
}

add_shortcode('bok_butterfly_release_links', 'generate_bok_butterfly_release_links');
