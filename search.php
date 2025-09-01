<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package BokMcDok
 */

get_header();
?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        /* translators: %s: search query. */
                        printf(
                                esc_html__( 'Search Results for: %s', 'bokmcdok' ),
                                '<span>' . esc_html( get_search_query() ) . '</span>'
                        );
                        ?>
                    </h1>
                </header><!-- .page-header -->

                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    /*
                     * Include the template for search results.
                     * To override this in a child theme, include content-search.php.
                     */
                    get_template_part( 'template-parts/content', 'search' );

                endwhile;

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
    </section><!-- #primary -->

<?php
get_sidebar();
get_footer();
