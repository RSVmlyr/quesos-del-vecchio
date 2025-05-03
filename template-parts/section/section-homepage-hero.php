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
$occasions_link = $args['occasions_link'];

$tempt_title = $args['tempt_title'];
$tempt_background = $args['tempt_background'];
$tempt_background_color = $args['tempt_background_color'];
$tempt_link = $args['tempt_link'];

$text_bottom = $args['text_bottom'];
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-homepage-hero.css?v=<?php echo _S_VERSION; ?>" rel="stylesheet" type="text/css" media="all">

<section class="relative w-screen h-svh min-h-svh" data-section="HomepageHero">
    <button type="button" class="homepage-hero__background" data-custom-cursor-area data-custom-cursor-label="Explorar">
        <div class="absolute -translate-x-1/2 -translate-y-1/2 z-10 top-1/2 left-1/2 w-full max-w-[46rem]">
            <h2 
                class="text-5xl text-center text-white font-medium mb-5 tracking-tight lg:mb-0 lg:text-[4rem]"
                data-animation-split-text
            >
                <?php echo esc_html($main_title); ?>
            </h2>

            <div class="block -rotate-12 lg:hidden">
                <span 
                    class="block tracking-tight bg-white text-blue font-semibold py-5 px-12 rounded-[100%] max-w-fit mx-auto text-center hover:bg-blue hover:text-white transition-colors duration-300"
                    data-animation-scale
                >
                    Explorar
                </span>
            </div>
        </div>

        <figure class="homepage-hero__background">
            <img class="w-full h-full object-cover" src="<?php echo esc_url($main_background['url']); ?>" alt="<?php echo esc_attr($main_background['alt']); ?>">
        </figure>
    </button>

    <div class="relative z-0 grid h-full w-full grid-rows-[50%_50%] lg:grid-cols-[50%_50%] lg:grid-rows-none">
        <a href="<?php echo esc_url($tempt_link["url"]); ?>" class="homepage-hero__link" style="background-color: <?php echo esc_attr($tempt_background_color); ?>" data-custom-cursor-area data-custom-cursor-label="INSPÍRATE" data-custom-cursor-type="CIRCLE">
            <div class="absolute z-10 inset-0 flex items-center justify-center max-w-[37.925rem] px-4 mx-auto">
                <h2 class="text-3xl text-center text-white font-medium tracking-tight lg:text-[4rem] homepage-hero__title"><?php echo esc_html($tempt_title); ?></h2>
            </div>

            <div class="homepage-hero__blob">
                <div class="homepage-hero__link-image" style="background-image: url(<?php echo esc_url($tempt_background['url']); ?>);"></div>
            </div>
        </a>

        <a href="<?php echo esc_url($occasions_link["url"]); ?>" class="homepage-hero__link"  style="background-color: <?php echo esc_attr($occasions_background_color); ?>" data-custom-cursor-area data-custom-cursor-label="DESCUBRE" data-custom-cursor-type="CIRCLE">
            <div class="absolute z-10 inset-0 flex items-center justify-center max-w-[37.925rem] px-4 mx-auto">
                <h2 class="text-3xl text-center text-white font-medium tracking-tight lg:text-[4rem] homepage-hero__title"><?php echo esc_html($occasions_title); ?></h2>
            </div>

            <div class="homepage-hero__blob">
                <div class="homepage-hero__link-image" style="background-image: url(<?php echo esc_url($occasions_background['url']); ?>);"></div>
            </div>
        </a>

        <div class="absolute bottom-1/2 inset-x-0 -translate-y-1/4 lg:translate-y-0 lg:bottom-8 homepage-hero__bottom">
            <div class="container flex gap-2 justify-center items-center overflow-hidden">
                <div class="homepage-hero__arrow homepage-hero__arrow--left">
                    <div class="homepage-hero__arrow-shape"></div>
                    <div class="homepage-hero__arrow-shape"></div>
                </div>
        
                <span class="text-white text-center font-semibold leading-none tracking-tight">
                    <?php echo esc_html($text_bottom); ?>
                </span>
        
                <div class="homepage-hero__arrow homepage-hero__arrow--right">
                    <div class="homepage-hero__arrow-shape"></div>
                    <div class="homepage-hero__arrow-shape"></div>
                </div>
            </div>
        </div>
    </div>
</section>
