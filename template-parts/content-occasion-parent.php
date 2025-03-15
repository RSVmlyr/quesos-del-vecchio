<?php
/**
 * Template part for displaying parent occasion content
 */

// This is a parent occasion
$args = array(
    'post_type' => 'occasion',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'ASC'
);

$children = new WP_Query($args);

$occasion_description = get_field('description');
?>

<?php if ($children->have_posts()) : ?>
    <?php get_template_part('template-parts/section/section-occasions-hero', null, array('children' => $children, 'description' => $occasion_description)); ?>
<?php endif; ?>


<?php if ( have_rows("layout") ) : ?>
    <?php while ( have_rows("layout") ) : the_row(); ?>

        <?php get_template_part( 'template-parts/content', 'acf'); ?>		

    <?php endwhile; // End of the loop. ?>
<?php endif; ?>
