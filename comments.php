<?php
/**
 * The template for displaying comments
 *
 * This template displays the current comments and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BokMcDok
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    if ( have_comments() ) :
        ?>
        <h2 class="comments-title" aria-live="polite" aria-atomic="true">
            <?php
            $bokmcdok_comment_count = get_comments_number();
            $title = get_the_title();
            if ( '1' === $bokmcdok_comment_count ) {
                /* translators: 1: post title */
                printf(
                        esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'bokmcdok' ),
                        esc_html( $title )
                );
            } else {
                /* translators: 1: number of comments, 2: post title */
                printf(
                        esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $bokmcdok_comment_count, 'comments title', 'bokmcdok' ) ),
                        number_format_i18n( $bokmcdok_comment_count ),
                        esc_html( $title )
                );
            }
            ?>
        </h2><!-- .comments-title -->

        <?php
        the_comments_navigation();
        ?>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                    'style'      => 'ol',
                    'short_ping' => true,
            ) );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bokmcdok' ); ?></p>
        <?php
        endif;

    endif; // have_comments()

    comment_form();
    ?>

</div><!-- #comments -->
