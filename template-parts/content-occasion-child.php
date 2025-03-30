<?php
/**
 * Template part for displaying child occasion content
 */

// Get parent occasion
$parent_id = wp_get_post_parent_id(get_the_ID());
$parent_title = get_the_title($parent_id);  

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
</article> 
