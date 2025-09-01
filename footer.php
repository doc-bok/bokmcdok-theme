<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BokMcDok
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <p>
            <?php
            /* translators: 1: Theme name, 2: Theme author name */
            printf(
            /* translators: Theme name (linked), Theme author (linked) */
                    wp_kses_post(
                            sprintf(
                            /* translators: Theme name, Theme author */
                                    __( 'Theme: %1$s by %2$s', 'bokmcdok' ),
                                    '<a href="https://github.com/doc-bok/bokmcdok-theme">' . esc_html__( 'bokmcdok', 'bokmcdok' ) . '</a>',
                                    '<a href="http://www.bokmcdok.com/about-me/">' . esc_html__( 'Doc Bok', 'bokmcdok' ) . '</a>'
                            )
                    )
            );
            ?>
        </p>
        <p>
            <?php
            $current_year = date( 'Y' );
            /* translators: 1: Author name linked, 2: Current year */
            printf(
                    wp_kses_post(
                            sprintf(
                                    __( '(c) 2012-%2$s %1$s', 'bokmcdok' ),
                                    '<a href="http://www.bokmcdok.com/about-me/">' . esc_html__( 'Doc Bok', 'bokmcdok' ) . '</a>',
                                    esc_html( $current_year )
                            )
                    )
            );
            ?>
        </p>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
