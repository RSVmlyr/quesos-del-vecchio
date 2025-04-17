<?php
/**
 * The template for displaying single Product posts
 */

get_header("dark");
?>

<main id="primary" class="relative block grow">

    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
        endwhile; // End of the loop.
    ?>

</main>

<?php get_footer(); ?> 

