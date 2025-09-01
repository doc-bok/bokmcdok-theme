<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BokMcDok
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            if ( have_posts() ) :

                // Show the page title for the blog posts index page when it's not the front page.
                if ( is_home() && ! is_front_page() ) : ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php echo esc_html( single_post_title( '', false ) ); ?></h1>
                    </header>
                <?php
                endif;

                // Start the Loop.
                while ( have_posts() ) :
                    the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme,
                     * include a file called content-___.php (where ___ is the Post Type name).
                     */
                    get_template_part( 'template-parts/content', get_post_type() );

                endwhile;

                // Pagination links.
                the_posts_pagination(
                        array(
                                'prev_text' => esc_html__( 'Previous', 'bokmcdok' ),
                                'next_text' => esc_html__( 'Next', 'bokmcdok' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'bokmcdok' ) . ' </span>',
                        )
                );

            else :

                // If no content, include the "No posts found" template.
                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
