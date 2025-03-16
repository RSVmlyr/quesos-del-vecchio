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
        get_template_part('template-parts/section/section-recipe-slider');
        break;
}
