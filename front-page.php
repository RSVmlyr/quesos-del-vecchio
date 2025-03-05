<?php
/*
 * Template Name: Home page template
 */

get_header();
?>

<main id="primary" class="relative block grow">

    <?php 
        get_template_part( 'template-parts/section/section-homepage-hero', null, array(
            "main_title" => get_field('main_screen')["title"],
            "main_background" => get_field('main_screen')["background_image"],

            "occasions_title" => get_field('occations')['title'],
            "occasions_background" => get_field('occations')['background_image'],
            "occasions_background_color" => get_field('occations')['background_color'],

            "tempt_title" => get_field('tempt')['title'],
            "tempt_background" => get_field('tempt')['background_image'],
            "tempt_background_color" => get_field('tempt')['background_color'],

            "text_bottom" => get_field('text_bottom')
        ));
    ?>

</main>


<?php
get_footer("no-content");
