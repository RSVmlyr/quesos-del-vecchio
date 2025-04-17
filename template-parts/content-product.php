<?php
/**
 * Template part for displaying product content
 */

// Get the occasion that has linked this product
$args = array(
    'post_type' => 'occasion',
    'meta_query' => array(
        array(
            'key' => 'products',
            'value' => '"' . get_the_ID() . '"',
            'compare' => 'LIKE'
        )
    ),
    'posts_per_page' => 1
);

$occasion_query = new WP_Query($args);
$parent_title = '';
if ($occasion_query->have_posts()) {
    $occasion_query->the_post();
    $parent_title = get_the_title();
    wp_reset_postdata();
}

$product_name = get_the_title();
$product_image = get_field('product_image');
$product_description = get_field('description');
$rappi_link = get_field('rappi_link');
$nutritional_info = get_field('nutritional_info');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('occasion-child'); ?>>
    <?php 
        get_template_part('template-parts/section/section-product-hero', null, array(
            'product_thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full'), 
            'product_image' => $product_image,
            'occasion_title' => $parent_title,
            'product_title' => $product_name,
            'product_description' => $product_description,
            'nutritional_info' => $nutritional_info,
            'delivery_link' => $rappi_link,
        )); 
    ?>

    <?php if ( have_rows("layout") ) : ?>
        <?php while ( have_rows("layout") ) : the_row(); ?>
            <?php get_template_part( 'template-parts/content', 'acf'); ?>		
        <?php endwhile; // End of the loop. ?>
    <?php endif; ?>
</article> 
