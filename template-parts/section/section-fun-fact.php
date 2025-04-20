<?php
$eyebrow = get_sub_field('eyebrow');
$fact = get_sub_field('fact');
$image = get_sub_field('image');
$background_color = get_sub_field('color');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-fun-fact.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 py-8 lg:py-28 fun-fact overflow-hidden"
    data-section=""
>
    <div class="container flex items-center justify-center">

        <figure 
            class="hidden relative w-full max-w-[33.625rem] z-10 translate-y-7 lg:flex-1 lg:-mr-40 lg:max-w-[40rem] lg:block fun-fact__mask"
            style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-2-flipped.svg);"
            data-animation-scale
        >
            <img class="w-full" src="<?php echo $image["sizes"]["large"]; ?>" alt="<?php echo $image["alt"] ?>" />
        </figure>

        <div 
            data-animation-fade-in
            class="relative fun-fact__bg p-6 rounded-3xl overflow-hidden lg:rounded-[3.5rem] lg:flex-1 lg:max-w-[50rem] lg:-rotate-[4.75deg] lg:py-12 lg:pr-14 lg:pl-48"
            style="background-color: <?php echo $background_color; ?>;background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/banner-wave.svg);"
        >
            <p class="text-blue tracking-tight font-semibold lg:text-lg" data-animation-fade-in>
                <?php echo $eyebrow; ?>
            </p>

            <p class="font-gazpacho text-2xl text-blue tracking-tight leading-tight font-medium mt-5 lg:text-5xl fun-fact__fact" data-animation-split-text>
                <?php echo $fact; ?>
            </p>
            <figure 
                class="flex relative w-full max-w-[33.625rem] z-10 translate-y-7 lg:hidden fun-fact__mask"
                style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-2-flipped.svg);"
                data-animation-scale
            >
                <img class="w-full" src="<?php echo $image["sizes"]["large"]; ?>" alt="<?php echo $image["alt"] ?>" />
            </figure>
        </div>


    </div>
</section>
