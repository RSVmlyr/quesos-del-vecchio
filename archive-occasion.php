<?php
/**
 * The template for displaying Occasions archive
 */

get_header();
?>

<main id="primary" class="relative block grow">
    <?php 
        global $wp_query;
        $args = array_merge(
            $wp_query->query,
            array(
                'post_parent' => 0,
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'ASC'
            )
        );
        query_posts($args);

        if (have_posts()) : ?>
            <?php get_template_part('template-parts/section/section-occasions-slider'); ?>
        <?php else : ?>
            <p class="text-xl">No hay ocasiones publicadas.</p>
        <?php endif; 
        
        // Reset the query
        wp_reset_query();
    ?>
</main>

<?php get_footer("no-content"); ?> 
