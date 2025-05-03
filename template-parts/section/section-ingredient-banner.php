<?php

$container_class = $args['container_class'];
$background_color = $args['background_color'];
$eyebrow = $args['eyebrow'];
$image = $args['image'];
$product = $args['product'];
$button_text = $args['button_text'];
$double_image = $args['double_image'];

$eyebrow_class = $container_class == 'container--small' ? 'text-xs' : 'text-sm';
$title_class = $container_class == 'container--small' ? 'lg:text-3xl' : 'lg:text-[4rem]';
$button_class = $container_class == 'container--small' ? '' : 'lg:py-12 lg:px-16 lg:max-w-80 lg:text-lg lg:block lg:w-full';
$height_class = $container_class == 'container--small' ? 'lg:py-8' : 'lg:py-24';
$image_class = $double_image == "true" ? '' : 'lg:hidden';
$main_image_class = $double_image == "true" ? '' : 'ingredient-banner__image--single';
$section_class = $double_image == "true" ? 'pt-16 overflow-hidden lg:pt-28' : '';
$bottom_class = $double_image == "true" ? 'lg:h-28' : '';
$banner_class = $container_class == 'container--small' ? 'rounded-3xl lg:grid-cols-[1fr,33%,1fr]' : 'rounded-[3rem] lg:grid-cols-[1fr,28%,1fr]';
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-ingredient-banner.css?v=<?php echo _S_VERSION; ?>" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 <?php echo $section_class; ?>"
    data-section=""
>
    <div class="container <?php echo $container_class; ?>">
    <!-- lg:min-h-72 -->
        <a
            data-animation-fade-in
            data-animation-threshold="0"
            href="<?php echo get_permalink( $product->ID ); ?>"
            class="relative z-0 bg-orange ingredient-banner__bg grid px-4 overflow-hidden lg:px-8 lg:overflow-visible <?php echo $banner_class; ?>"
            style="background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/banner-wave.svg); background-color: <?php echo $background_color; ?>"
        >
            <div class="self-center order-1 text-center pt-9 mb-3 lg:text-left lg:mb-0 lg:pr-8 <?php echo $height_class; ?>">
                <p class="font-medium tracking-tight text-blue mb-1 <?php echo $eyebrow_class; ?>" data-animation-fade-in>
                    <?php echo $eyebrow; ?>
                </p>
            
                <h2 class="text-[2.5rem] tracking-tight text-blue leading-tight font-medium <?php echo $title_class; ?>" data-animation-split-text>
                    <?php echo $product->post_title; ?>
                </h2>
            </div>

            <div class="relative w-full aspect-square order-3 lg:order-2 lg:aspect-auto">
                <figure class="absolute bottom-0 w-full lg:-bottom-16 ingredient-banner__image ingredient-banner__image--left <?php echo $main_image_class; ?>">
                    <img class="block" src="<?php echo $image["url"];?>" alt="<?php echo $image["alt"];?>" />
                </figure>

                <figure class="hidden absolute bottom-0 w-full lg:-bottom-16 lg:block ingredient-banner__image ingredient-banner__image--right <?php echo $image_class; ?>">
                    <img class="block" src="<?php echo $image["url"];?>" alt="<?php echo $image["alt"];?>" />
                </figure>
            </div>
        
            <div class="self-center order-2 flex justify-center lg:order-3" data-animation-scale>
                <span class="inline-block bg-white py-5 px-8 text-blue text-center rounded-[100%] font-semibold tracking-tight mx-auto lg:mr-0 <?php echo $button_class; ?> ingredient-banner__button">
                    <?php echo $button_text; ?>
                </span>
            </div>
        </a>

        <div class="bg-beige-3 relative z-10 h-16 <?php echo $bottom_class; ?>">  
        </div>
    </div>
</section>
