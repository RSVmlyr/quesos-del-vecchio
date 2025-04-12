<?php
/**
 * Template part for displaying acf blocks
 */

switch(get_row_layout()) {
    case "vertical_slider":
        get_template_part('template-parts/section/section-vertical-slider');
        break;
    case "four_images_slider":
        get_template_part('template-parts/section/section-four-images-slider');
        break;
    case "banner_image_background":
        get_template_part('template-parts/section/section-banner-image-background');
        break;
    case "instagram_reels":
        get_template_part('template-parts/section/section-instagram-reels');
        break;
    case "recipe_slider":
        $pre_title = get_sub_field('pre_title');
        $title = get_sub_field('title');
        $recipes = get_sub_field('recipes');
        get_template_part('template-parts/section/section-recipe-slider', null, array(
            'pre_title' => $pre_title,
            'title' => $title,
            'recipes' => $recipes,
            'background_color' => "bg-beige-3",
        ));
        break;
    case "ingredient_banner":
        $container_class = get_sub_field('container');
        $background_color = get_sub_field('background_color');
        $eyebrow = get_sub_field('eyebrow');
        $image = get_sub_field('image');
        $product = get_sub_field('product')[0];
        $button_text = get_sub_field('button_text');
        $double_image = get_sub_field('double_image');

        get_template_part('template-parts/section/section-ingredient-banner', null, array(
            'container_class' => $container_class,
            'background_color' => $background_color,
            'eyebrow' => $eyebrow,
            'image' => $image,
            'product' => $product,
            'button_text' => $button_text,
            'double_image' => $double_image,
        ));
        break; 
    case "fun_fact":
        get_template_part('template-parts/section/section-fun-fact');
        break; 
    case "locations_slider":
        get_template_part('template-parts/section/section-locations-slider');
        break; 
    case "hotspots":
        get_template_part('template-parts/section/section-hotspots');
        break; 
    case "horizontal_scroll":
        get_template_part('template-parts/section/section-horizontal-scroll');
        break;
    case "scroll_sections":
        get_template_part('template-parts/section/section-scroll-sections');
        break;
    case "image_text":
        get_template_part('template-parts/section/section-image-text');
        break;
    case "image":
        get_template_part('template-parts/section/section-image');
        break;
    case "rich_text":
        get_template_part('template-parts/section/section-rich-text');
        break;
    case "hero":
        get_template_part('template-parts/section/section-hero');
        break;
    case "animate_text":
        get_template_part('template-parts/section/section-animate-text');
        break;
    case "cards":
        get_template_part('template-parts/section/section-cards');
        break;
}
