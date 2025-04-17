<?php
$eyebrow = get_sub_field('eyebrow');
$fact = get_sub_field('fact');
$image = get_sub_field('image');
$background_color = get_sub_field('color');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-fun-fact.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 py-28 fun-fact overflow-hidden"
    data-section=""
>
    <div class="container flex items-center justify-center">

        <figure 
            class="relative w-full max-w-[33.625rem] flex-1 -mr-40 z-10 translate-y-7 lg:max-w-[40rem] fun-fact__mask"
            style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-2-flipped.svg);"
        >
            <img class="w-full" src="<?php echo $image["sizes"]["large"]; ?>" alt="<?php echo $image["alt"] ?>" />
        </figure>

        <div 
            class="relative fun-fact__bg py-12 pr-14 pl-48 rounded-[3.5rem] overflow-hidden flex-1 -rotate-[4.75deg] max-w-[50rem]"
            style="background-color: <?php echo $background_color; ?>;background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/banner-wave.svg);"
        >
            <p class="text-lg text-blue tracking-tight font-semibold">
                <?php echo $eyebrow; ?>
            </p>

            <p class="font-gazpacho text-blue tracking-tight leading-tight font-medium text-5xl mt-5">
                <?php echo $fact; ?>
            </p>
        </div>


    </div>
</section>
