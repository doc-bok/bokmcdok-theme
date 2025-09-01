<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BokMcDok
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
			
			the_post_navigation();
			
			?>
			<div class="related-posts">
				<h2>Related Posts</h2>
				<ul> 
			<?php
			//	Show related posts
			$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'orderby' => 'rand', 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
			if( $related ) foreach( $related as $post ) {
			setup_postdata($post); ?>
					 <li <?php post_class(); ?>>
						 <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
							<h3><?php the_title(); ?></h3>
						 	<?php bokmcdok_post_thumbnail(); ?>
						 </a>
					 </li>
			<?php }
			wp_reset_postdata(); 
			?>	
				</ul> 			  
			</div>
			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
