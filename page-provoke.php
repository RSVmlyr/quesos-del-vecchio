<?php
/**
 * Template Name: Provoke
 * Template Post Type: post, page, event
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package quesos-del-vecchio
 */

get_header();
?>

    <main id="primary" class="relative block grow">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php
get_footer("no-content");
