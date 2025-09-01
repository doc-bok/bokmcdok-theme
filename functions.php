<?php
/**
 * BokMcDok functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BokMcDok
 */

if ( ! function_exists( 'bokmcdok_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bokmcdok_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BokMcDok, use a find and replace
		 * to change 'bokmcdok' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bokmcdok', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bokmcdok' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bokmcdok_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'bokmcdok_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bokmcdok_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'bokmcdok_content_width', 640 );
}
add_action( 'after_setup_theme', 'bokmcdok_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bokmcdok_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bokmcdok' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bokmcdok' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bokmcdok_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bokmcdok_scripts() {
	wp_enqueue_style( 'bokmcdok-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bokmcdok-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'bokmcdok-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bokmcdok_scripts' );

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

function improved_trim_excerpt($text) {
	
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
	$text = $text.'<p><a href="' . esc_url(get_permalink()) . '">Read More...</a></p>';

	return $text;
}

//  Replace default excerpt filter with our custom filter.
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

/*
 * Gets rid of the achive prefix from the titles.
 */

function db_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}
 
	return $title;
}

add_filter( 'get_the_archive_title', 'db_archive_title' );

// Disable administration email verification
add_filter( 'admin_email_check_interval', '__return_false' );

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
			wp_redirect(home_url(), 302); // fallback if no posts
		}
		exit;
	}
});

/**
 * Random quote shortcode
 */
function random_quote() {
	$quotes = [
				'Worrying is a waste of imagination.',
				'It never gets easy, but it gets easier.',
				'You gotta have a little sadness once in a while so you know when the good times come.',
				'You are the inspiration the world needs.',
				'Fuck the job. I love the Verve.',
				'What if it turns out way better than you could have imagined?',
				'We will always be back then.',
				'Would you tell them to stop coming to therapy because what they should really be doing is completely changing the way our society is structured?',
				'Good ideas have no borders.',
				'<p style="color:#00f;background:#FFFF00;text-align:center;margin:0 25%;padding: 0.5em 1em;font-family:cursive;letter-spacing: 0.25em;font-size: 1em;rotate:3deg;">BELIEVE</p>',
				'You will never forgive yourself. Accept it. You hurt others, many others, that cannot be undone. You will never find personal retribution, but your life does not have to end. That which is right, just and true can still prevail. If you do not fight for what you believe in all may be lost for everyone else. But do not fight for yourself, fight for others, others that may be saved through your effort. That is the least you can do.',
				'I know. It’s all wrong. By rights we shouldn’t even be here. But we are. It’s like in the great stories. The ones that really mattered. Full of darkness and danger they were, and sometimes you didn’t want to know the end. Because how could the end be happy. How could the world go back to the way it was when so much bad happened. But in the end, it’s only a passing thing, this shadow. Even darkness must pass. A new day will come. And when the sun shines it will shine out the clearer. Those were the stories that stayed with you. That meant something. Even if you were too small to understand why. But I think I do understand. I know now. Folk in those stories had lots of chances of turning back only they didn’t. Because they were holding on to something. That there’s some good in this world. And it’s worth fighting for.',
				'If you always put limits on everything you do, physical or anything else, it will spread into your work and into your life. There are no limits. There are only plateaus, and you must not stay there, you must go beyond them.',
				'I\'m a Traveller born and bred,<br />On the road until I\'m dead<br />If that means I\'ll be alone<br />Then loneliness shall be my home',
				'Venture Adventure.',
				'You have the privelege of believing what\'s best in people. Me, I happen to know there are some things in this world that don\'t deserve forgiveness.',
				'I always wondered what kind of person could do such a thing, but now that I see you, I think I understand. There\'s just *nothing* inside you, nothing at all. You\'re pathetic and sad and empty.',
				'As I was going up the stairs<br />I met a man that wasn\'t there<br />He wasn\'t there again today<br />I wish, I wish he\'d go away',
				'Inaction is a weapon of mass destruction.',
				'I am thee Iself<br />I am thee Allself<br />I am thee Godself<br />I am thee Noself',
				'Every day!',
				'A thing isn\'t beautiful because it lasts',
				'Roses come in a variety of colors<br />And violets are violet, not blue<br />I\'m trying to write a romantic poem<br />Because I really want to fuck you',
				'F*** society',
				'As I flutter in the breeze<br />I think of what my mind\'s eye sees<br />At night when I\'m an old wiseman<br />Contemplating the things I can.<br />Am I the one that dreams of he,<br />Or is he the one that dreams of me?',
				'<b>An Irish Poem</b><br />Pome<br /> - <i>Bok McDok</i>',
				'It\'s okay if the first step in saving the world is saving one person. It\'s okay if that person is you.',
				'Use your privelege to protect those who don\'t have the same protections as you.',
				'Do more than just exist.',
				'You shall treat the alien who resides with you no differently than the natives born among you; you shall love the alien as yourself; for you too were once aliens in the land of Egypt. I, the LORD, am your God.<br />- <i>Leviticus 19:34</i>',
				'Love is not control. Love is not giving up everything for someone to keep them happy so they won\'t abuse you. It\'s never your fault. Don\'t start believing your abuser(s). You deserve better.',
				'It is possible to commit no mistakes and still lose. That is not weakness, that is life.',
				'When the whole world is running toward a cliff, - he who is running in the opposite direction appears to have lost his mind.',
				'Everyone keeps telling me how my story is supposed to go. Nah, imma do my own thing…',
				'Erratus or bust',
				'The engine room is heavy, and the idle man is free from it.',
				'Whenever you\'re feeling lost it\'s best to find where you\'re needed most',
				'I did it, Grandma. I finally stood up for myself. I got real mean and I beat the shnot outta Dr. Oz. I can\'t lie, it felt kind of good. At first. But since then all I have is just... a kind of dark, empty feeling. Then I realized... that\'s how you must feel. All the time. Poor old Grandma. You know, I\'ve been getting lots of advice how to deal with you. Stand up to you, tell on you... But I kind of realize there\'s just people like you out there. All over the place. When you\'re a kid, things seem like they\'re gonna last forever. But they\'re not. Life changes. Why you won\'t always be around. Someday you\'re gonna die. Someday pretty soon. And when you\'re laying in that hospital bed, with tubes up your nose, and that little pan under your butt to pee in, well I\'ll come visit ya. I\'ll come just to show you that I\'m still alive and I\'m still happy. And you\'ll die. Being nothing but you. \'Night Grandma!',
				'Individual science fiction stories may seem as trivial as ever to the blinder critics and philosophers of today, but the core of science fiction -- its essence -- has become crucial to our salvbation, if we are to be saved at all.',
				'If anything, if anything at all is to come from this trial and from my statement on behalf of those I love, let it be that the world takes notice of the evil that can happen when people do nothing. And let it be that the world decides that doing nothing is not an option.',
				'Love yourself like your life depends on it.',
				'Never give up – keep going',
				'You\'re right. I hate people. I\'m scared of them. I\'ve been scared of them practically my whole life. People I loved-- people I trusted-- have done their absolute worst to me. And for a long time, that\'s all I ever knew. So, yeah, I called my group fsociety, because you know what? Fuck society. Society deserves to be hated for everything you said they did and more. Fuck every last one of them for what we\'ve all been through. But then there are some people out there... And it doesn\'t happen a lot. It\'s rare. But they refuse to let you hate them. In fact, they care about you in spite of it. And the really special ones, they\'re relentless at it. Doesn\'t matter what you do to them. They take it and care about you anyway. They don\'t abandon you, no matter how many reasons you give them. No matter how much you\'re practically begging them to leave. And you wanna know why? Because they feel something for me that I can\'t. They love me. And for all the pain I\'ve been through, that heals me. Maybe not instantly. Maybe not even for a long time, but it heals. And, yeah, there are setbacks. We do fucked up things to each other. And we hurt each other, and it gets messy, but that\'s just us, in any world you\'re in. And, yeah, you\'re right. We\'re all told we don\'t stand a chance, and yet we stand. We break, but we keep going, and that is not a flaw. That\'s what makes us. So, no, I will not give up on this world. And if you can\'t see why, then I speak for everyone when I say, fuck you!',
		'The employees that broke into the Treasury department with Elon Musk: Akash Bobba, Edward Coristine, Luke Farritor, Gautier Cole Killian, Gavin Kliger, and Ethan Shaotran',
		'Slava Ukraini',
		'We all become stories in the end.'
	];

	$quote = $quotes[array_rand($quotes)];

	return apply_filters('bok_random_quote', $quote);
}

function random_quote_shortcode() {
	return '<section id="block-random" class="widget widget_block">
		<blockquote class="wp-block-quote has-text-color has-small-font-size" style="color:#0088ff">
			<p>' . wp_kses_post(random_quote()) . '</p>
		</blockquote>
	</section>';
}

add_shortcode('random_quote', 'random_quote_shortcode');

/**
 * Generate Bok's Banging Butterflies Release Links
 */

// Generate a single download list item.
function generate_bok_butterfly_release_link($mod_version, $mod_loader, $minecraft_version) {
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
function generate_bok_butterfly_release_links($atts) {
	$atts = shortcode_atts([
		'version' => '6.0.0',
	], $atts, 'bok_butterfly_release_links');

	$version = $atts['version'];

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

/**
 * Add colors to dialogue in Baldur's Gate posts.
 */
function bok_add_dialogue_colours() {
    ?>
    <script>
        (function() {
            document.addEventListener('DOMContentLoaded', () => {
                const colorPalette = [
                    "#333",     // 0: Dark Grey (default)
                    "#800",     // 1: Red
                    "#808080",  // 2: Grey
                    "#777",     // 3: Medium Grey
                    "#4fb300",  // 4: Light Green
                    "#000",     // 5: Black
                    "#7f401a",  // 6: Orange
                    "#0C5",     // 7: Green
                    "#640",     // 8: Brown
                    "#9f9f14",  // 9: Yellow
                    "#6b1d6b",  // 10: Purple
                    "#bb0000",  // 11: Light Red
                    "#5d5d5d",  // 12: Light Grey
                    "#00A",     // 13: Blue
                    "#08F",     // 14: Light Blue
                    "#00d4aa"   // 15: Cyan
                ];

                const paletteLength = colorPalette.length;

                // Simple but effective hash function
                const generateHash = (str) => {
                    let hash = 0;
                    // Trim string for consistent hashing
                    const text = str.trim();

                    for (const char of text) {
                        hash = ((hash << 5) - hash) + char.charCodeAt(0);
                        hash |= 0; // Convert to 32-bit integer
                    }
                    return hash;
                };

                // Apply to all <strong> elements
                document.querySelectorAll('strong').forEach(el => {
                    const textContent = el.textContent.trim();

                    // Only apply to text that contains colon, indicative of dialogue "Speaker: line"
                    if (!textContent.includes(':')) return;

                    // Skip if the element already has a custom 'data-dialogue-colour' attribute to prevent recoloring
                    if (el.hasAttribute('data-dialogue-colour')) return;

                    const hash = generateHash(textContent);
                    const colorIndex = Math.abs(hash % paletteLength);
                    const color = colorPalette[colorIndex];

                    el.style.color = color;
                    el.setAttribute('data-dialogue-colour', color);  // mark processed
                });
            });
        })();
    </script>
    <?php
}

add_action('wp_footer', 'bok_add_dialogue_colours');
