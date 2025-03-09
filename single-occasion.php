<?php
/**
 * The template for displaying single Occasion posts
 */

get_header();
?>

<main id="primary" class="relative block grow">
    <?php while (have_posts()) : the_post(); 
        if (wp_get_post_parent_id(get_the_ID())) {
            // This is a child occasion
            get_template_part('template-parts/content', 'occasion-child');
        } else {
            get_template_part('template-parts/content', 'occasion-parent');
        }
    endwhile; ?>
</main>

<?php get_footer(); ?> 

