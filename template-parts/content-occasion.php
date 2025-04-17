<?php
/**
 * Template part for displaying occasion content
 */

$occasion_description = get_field('description');
$products = get_field('products');
?>

<?php if ($products && !empty($products)) : ?>
    <?php get_template_part('template-parts/section/section-occasions-hero', null, array('products' => $products, 'description' => $occasion_description)); ?>
<?php endif; ?>

<?php if ( have_rows("layout") ) : ?>
    <?php while ( have_rows("layout") ) : the_row(); ?>
        <?php get_template_part( 'template-parts/content', 'acf'); ?>		
    <?php endwhile; // End of the loop. ?>
<?php endif; ?>
