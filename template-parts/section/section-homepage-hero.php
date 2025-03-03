<?php
/**
 * Section Homepage Hero
 * 
 * @param array $args Template part arguments
 */

// Access passed variables
$main_title = $args['main_title'];
$main_background = $args['main_background'];

$occasions_title = $args['occasions_title'];
$occasions_background = $args['occasions_background'];
$occasions_background_color = $args['occasions_background_color'];

$tempt_title = $args['tempt_title'];
$tempt_background = $args['tempt_background'];
$tempt_background_color = $args['tempt_background_color'];
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-homepage-hero.css" rel="stylesheet" type="text/css" media="all">

<section class="relative w-screen h-screen" data-section="HomepageHero">
    <button type="button" class="homepage-hero__background" data-custom-cursor-area data-custom-cursor-label="Explorar">
        <div class="absolute -translate-x-1/2 -translate-y-1/2 z-10 top-1/2 left-1/2 w-full max-w-[46rem]">
            <h2 class="text-5xl text-center text-white font-medium mb-5 lg:mb-0 lg:text-[4rem]"><?php echo esc_html($main_title); ?></h2>

            <span class="block bg-white text-blue font-semibold py-5 px-12 rounded-[100%] max-w-fit -rotate-12 mx-auto text-center tracking-[-0.02rem] lg:hidden">
                Explorar
            </span>
        </div>

        <figure class="homepage-hero__background">
            <img class="w-full h-full object-cover" src="<?php echo esc_url($main_background['url']); ?>" alt="<?php echo esc_attr($main_background['alt']); ?>">
        </figure>
    </button>

    <div class="relative z-0 grid h-full w-full grid-rows-[50%_50%] lg:grid-cols-[50%_50%] lg:grid-rows-none">
        <a href="#" class="homepage-hero__link" style="background-color: <?php echo esc_attr($tempt_background_color); ?>" data-custom-cursor-area data-custom-cursor-label="INSPÍRATE" data-custom-cursor-type="CIRCLE">
            <div class="absolute z-10 inset-0 flex items-center justify-center max-w-[37.925rem] px-4 mx-auto">
                <h2 class="text-5xl text-center text-white font-medium tracking-[-0.16rem] lg:text-[4rem] homepage-hero__title"><?php echo esc_html($tempt_title); ?></h2>
            </div>

            <div class="homepage-hero__blob">
                <div class="homepage-hero__link-image" style="background-image: url(<?php echo esc_url($tempt_background['url']); ?>);"></div>
            </div>
        </a>

        <a href="<?php echo esc_url(get_post_type_archive_link('occasion')); ?>" class="homepage-hero__link"  style="background-color: <?php echo esc_attr($occasions_background_color); ?>" data-custom-cursor-area data-custom-cursor-label="DESCUBRE" data-custom-cursor-type="CIRCLE">
            <div class="absolute z-10 inset-0 flex items-center justify-center max-w-[37.925rem] px-4 mx-auto">
                <h2 class="text-5xl text-center text-white font-medium tracking-[-0.16rem] lg:text-[4rem] homepage-hero__title"><?php echo esc_html($occasions_title); ?></h2>
            </div>

            <div class="homepage-hero__blob">
                <div class="homepage-hero__link-image" style="background-image: url(<?php echo esc_url($occasions_background['url']); ?>);"></div>
            </div>
        </a>
    </div>
</section>
