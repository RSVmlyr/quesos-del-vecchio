<?php
/**
 * The template for displaying single Occasion posts
 */

get_header();
?>

<main id="primary" class="site-main">
    Single ocasion
    <article id="post-<?php the_ID(); ?>" <?php post_class('container mx-auto px-4 py-12'); ?>>
        // ... rest of the code ...
    </article>
</main>

<?php get_footer(); ?> 
