<?php

/*
 *  Create much nicer article excerpts.
 */

function close_tags($html) {
	// Tags that are self-closing in HTML5
	$self_closing = [
		'area', 'base', 'br', 'col', 'command', 'embed', 'hr', 'img',
		'input', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr'
	];

	// Match all opening tags
	preg_match_all('#<([a-z0-9]+)(?:\s[^<>]*)?(?<!/)>#i', $html, $open_matches);
	$opened_tags = $open_matches[1];

	// Match all closing tags
	preg_match_all('#</([a-z0-9]+)>#i', $html, $close_matches);
	$closed_tags = $close_matches[1];

	$opened_tags = array_reverse($opened_tags);
	$closed_tags_count = array_count_values($closed_tags);

	$output = $html;

	foreach ($opened_tags as $tag) {
		$tag = strtolower($tag);
		if (in_array($tag, $self_closing)) {
			continue;
		}

		if (isset($closed_tags_count[$tag]) && $closed_tags_count[$tag] > 0) {
			$closed_tags_count[$tag]--;
		} else {
			$output .= "</$tag>";
		}
	}

	return $output;
}

function improved_trim_excerpt($text): string {

	// Get the full content if no manual excerpt provided.
	if ( '' === $text ) {
		$text = get_the_content();
	}

	// Fix malformed character entity.
	$text = str_replace(']]>', ']]&gt;', $text);

	//  Cut off at first figure or header element.
	$figurePosition = strpos($text, "<figure");
	$h3Position = strpos($text, "<h");

	$cutoffPosition = false;
	if ($h3Position !== false && $figurePosition !== false) {
		$cutoffPosition = min($h3Position, $figurePosition);
	}
	elseif ($figurePosition !== false) {
		$cutoffPosition = $figurePosition;
	}
	elseif ($h3Position !== false) {
		$cutoffPosition = $h3Position;
	}

	if ($cutoffPosition !== false && $cutoffPosition > 0) {
		$text = substr($text, 0, $cutoffPosition);
	}

	// Remove any scripts, just in case.
	$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

	// Preserve paragraphs and emphasis.
	$text = strip_tags($text, ['p','em','strong']);

	// Maximum length in words (or characters for Chinese).
	$excerpt_length = 50;

	// Language sensitive trimming.
	if (function_exists("pll_current_language") &&
	    pll_current_language() == "zh") {
		$text = mb_substr($text, 0, $excerpt_length);
	}
	else {
		$words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
		if (count($words)> $excerpt_length) {
			$words = array_slice($words, 0, $excerpt_length);
			$text = implode(' ', $words);
		}
	}

	// Try to cut off after the last complete sentence.
	$sentences = preg_split("/([.?!])+/", $text, -1, PREG_SPLIT_DELIM_CAPTURE);
	if (count($sentences) > 1) {
		array_pop($sentences);
		$output = implode('', $sentences);
		$text = trim($output);
	}
	else {
		$text .= "...";
	}

	// Ensure the excerpt is wrapped in a paragraph.
	if (!str_starts_with($text, '<p>')) {
		$text = '<p>' . $text;
	}

	$text = close_tags($text);

	// Add a read more link.
	return $text . '<p><a href="' . esc_url(get_permalink()) . '">Read More...</a></p>';
}

//  Replace default excerpt filter with our custom filter.
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');