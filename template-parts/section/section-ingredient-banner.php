<?php
$eyebrow = get_sub_field('text');
$product = get_sub_field('product')[0];
$image = get_sub_field('image');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-ingredient-banner.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 pb-14 pt-28"
    data-section=""
>
    <div class="container">
        <div
            class="bg-orange ingredient-banner__bg grid grid-cols-[1fr,25rem,1fr] overflow-hidden rounded-[3rem] max-h-72 h-72 pt-7 px-12"
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
        
            <figure class="w-full h-auto relative">
                <img class="w-full h-full object-contain object-bottom absolute" src="<?php echo $image["url"];?>" alt="<?php echo $image["alt"];?>" />
            </figure>
        
            <div class="self-center">
                <a href="<?php echo get_permalink( $product->ID ); ?>" class="block ml-auto bg-white text-blue py-10 px-12 text-center rounded-[100%] w-full font-semibold tracking-tight max-w-80">
                    Ver producto
                </a>
            </div>

        </div>
    </div>
</section>
