<?php
$main_image = get_sub_field('main_image');
$logo = get_sub_field('logo');
$sub_title = get_sub_field('sub_title');
$title = get_sub_field('title');
$description = get_sub_field('description');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-hero-image-content.css" rel="stylesheet" type="text/css" media="all">

<section class="bg-beige-3 h-screen min-h-[42rem] pt-28 lg:min-h-[56rem] hero-image-content lg:pb-24">
    <div class="container relative z-10 h-full grid grid-rows-[1fr_auto] lg:grid-cols-2 lg:gap-24 lg:grid-rows-none"> 
        <div class="flex items-center lg:order-2">
            <div class="lg:max-w-[30rem]">
                <p class="text-white text-sm tracking-tight font-medium leading-snug mb-4 lg:text-lg lg:mb-6" data-animation-fade-in>
                    <?php echo $sub_title; ?>
                </p>
                <h1 class="text-white text-[2rem] tracking-tight font-medium leading-snug mb-4 lg:text-[3.5rem] lg:mb-5" data-animation-split-text>
                    <?php echo $title; ?>
                </h1>
                <p class="text-white tracking-tight font-medium leading-snug lg:text-lg lg:max-w-[24rem]" data-animation-fade-in>
                    <?php echo $description; ?>
                </p>
            </div>
        </div>

        <div class="relative max-w-[22.375rem] mx-auto lg:order-1 lg:max-w-[38.25rem] lg:w-full lg:self-end">
            <figure 
                class="w-full hero-image-content__mask"
                style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-5.svg);"
                data-animation-scale
            >
                <img src="<?php echo $main_image["sizes"]["large"]; ?>" alt="<?php echo $main_image["alt"]; ?>">
            </figure>

            <figure data-animation-scale class="absolute top-1/2 -translate-y-1/2 -right-3 max-w-20 lg:max-w-36 lg:bottom-10 lg:-translate-y-0 lg:top-auto">
                <img src="<?php echo $logo["sizes"]["medium"]; ?>" alt="<?php echo $logo["alt"]; ?>">
            </figure>
        </div>
    </div>
</section>
