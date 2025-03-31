<?php
$eyebrow = get_sub_field('text');
$product = get_sub_field('product')[0];
$image = get_sub_field('image');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-ingredient-banner.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 pt-28"
    data-section=""
>
    <div class="container">
        <a
            href="<?php echo get_permalink( $product->ID ); ?>"
            class="relative z-0 bg-orange ingredient-banner__bg grid grid-cols-[1fr,25rem,1fr] rounded-[3rem] max-h-72 h-72 pt-7 px-12"
            style="background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/banner-wave.svg);"
        >
            <div class="self-center">
                <p class="font-medium tracking-tight text-blue">
                    <?php echo $eyebrow; ?>
                </p>
            
                <h2 class="text-[4rem] tracking-tight text-blue leading-none font-medium mt-1">
                    <?php echo $product->post_title; ?>
                </h2>
            </div>

            <div class="relative w-full h-auto">
                <figure class="absolute w-2/3 h-80 top-0 left-0 ingredient-banner__image ingredient-banner__image--left">
                    <img class="block w-full h-full object-cover object-bottom" src="<?php echo $image["url"];?>" alt="<?php echo $image["alt"];?>" />
                </figure>

                <figure class="absolute w-2/3 h-80 top-0 right-0 ingredient-banner__image ingredient-banner__image--right">
                    <img class="block w-full h-full object-cover object-bottom" src="<?php echo $image["url"];?>" alt="<?php echo $image["alt"];?>" />
                </figure>
            </div>
        
            <div class="self-center">
                <span class="block ml-auto bg-white text-blue py-10 px-12 text-center rounded-[100%] w-full font-semibold tracking-tight max-w-80 ingredient-banner__button">
                    Ver producto
                </span>
            </div>
        </a>

        <div class="bg-beige-3 relative z-10 h-14">  
        </div>
    </div>
</section>
