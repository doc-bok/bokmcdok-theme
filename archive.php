<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BokMcDok
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if ( have_posts() ) : ?>

                <header class="archive-header">
                    <?php
                    the_archive_title( '<h1 class="archive-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </header><!-- .archive-header -->

                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * To override this in a child theme, add content-___.php (where ___ is the Post Type name).
                     */
                    get_template_part( 'template-parts/content', get_post_type() );

                endwhile;

                // Display pagination with numbered links.
                the_posts_pagination(
                        array(
                                'prev_text'          => esc_html__( 'Previous', 'bokmcdok' ),
                                'next_text'          => esc_html__( 'Next', 'bokmcdok' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'bokmcdok' ) . ' </span>',
                        )
                );

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
