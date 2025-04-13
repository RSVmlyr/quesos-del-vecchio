<?php
$images = get_sub_field('images');
$slider_items = get_sub_field('slide');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-content-slider.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="ContentSlider"
    class="custom-template-<?php echo get_row_layout(); ?> relative bg-beige-3 py-12 lg:h-screen lg:min-h-[56rem] lg:flex lg:items-center"
>
    <div class="swiper w-full lg:max-w-[35rem] lg:mx-auto content-slider__swiper">
        <div class="swiper-wrapper">
            <?php foreach ($slider_items as $item): 
                $pre_title = $item['pre_title'];
                $link = $item['link'];

                $title = $item['title'];
                $description = $item['description'];
            ?>
                <div class="swiper-slide content-slider__slider">
                    <div class="container grid gap-4 lg:gap-8">
                        <div class="grid gap-4 max-w-80 mx-auto lg:max-w-[25.625rem]">
                            <?php if($pre_title): ?>
                                <p class="hidden text-blue tracking-tight font-medium text-lg text-center lg:block">
                                    <?php echo $pre_title; ?>
                                </p>
                            <?php endif; ?>
    
                            <h2 class="text-blue text-center text-[2.5rem] tracking-tight font-medium leading-tight lg:text-[4rem]">
                                <?php echo $title; ?>
                            </h2>
                        </div>

                        <p class="text-blue font-medium text-center tracking-tight mx-auto max-w-[16.625rem] lg:text-2xl lg:max-w-[24rem] lg:font-normal">
                            <?php echo $description; ?>
                        </p>

                        <?php if($link): ?>
                            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="text-white bg-blue tracking-tight text-center font-medium py-[0.875rem] text-sm rounded-[12.5rem] mx-auto px-6 lg:text-lg lg:font-semibold lg:py-6 lg:px-7">
                                <?php echo $link['title']; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="container">
            <figure 
                class="mt-8 w-full max-w-[22.375rem] mx-auto lg:hidden content-slider__mask"
                style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-2.svg);"
            >
                <img src="<?php echo $images["top_left"]['sizes']['large']; ?>" alt="<?php echo $images["top_left"]['alt']; ?>">
            </figure>
        </div>

        <?php if(count($slider_items) > 1): ?>
            <div class="w-full max-w-52 mx-auto flex items-center justify-center gap-3 mt-8 text-blue lg:max-w-fit lg:mt-10">
                <div class="">
                    <button type="button" class="swiper-button-prev content-slider__button content-slider__button--prev">
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 1L1 6L6 11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-medium tracking-tight content-slider__current-count">
                        01
                    </span>
                    <div 
                        class="content-slider__progress" 
                        style="--progress-width: <?php echo (1/count($slider_items)) * 100; ?>%;"
                        data-progress-width="<?php echo count($slider_items); ?>"
                    ></div>
                    <span class="text-2xl tracking-tight font-medium">
                        <?php echo str_pad(count($slider_items), 2, '0', STR_PAD_LEFT); ?>
                    </span>
                </div>
                <div class="">
                    <button type="button" class="swiper-button-next content-slider__button content-slider__button--next">
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 1L1 6L6 11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div class="hidden pointer-events-none absolute inset-0 container lg:block">
        <div class="absolute top-11 bottom-11 left-12 right-12 content-slider__images">
            <div class="absolute top-0 left-0">
                <figure 
                    class="w-full max-w-[15.75rem] xl:max-w-[20.75rem] content-slider__mask"
                    style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-3-reflection-y.svg);"
                >
                    <img class="block" src="<?php echo $images["top_left"]['sizes']['large']; ?>" alt="<?php echo $images["top_left"]['alt']; ?>">
                </figure>
            </div>

            <div class="absolute top-0 right-0">
                <figure 
                    class="w-full max-w-[18.75rem] xl:max-w-[23.75rem] content-slider__mask"
                    style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-2.svg);"
                >
                    <img class="block" src="<?php echo $images["top_right"]['sizes']['large']; ?>" alt="<?php echo $images["top_right"]['alt']; ?>">
                </figure>
            </div>

            <div class="absolute bottom-0 left-0">
                <figure 
                    class="w-full max-w-[20.125rem] xl:max-w-[25.125rem] content-slider__mask"
                    style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-3.svg);"
                >
                    <img class="block" src="<?php echo $images["bottom_left"]['sizes']['large']; ?>" alt="<?php echo $images["bottom_left"]['alt']; ?>">
                </figure>
            </div>

            <div class="absolute bottom-0 right-0">
                <figure 
                    class="w-full max-w-[21.5rem] xl:max-w-[23.5rem] content-slider__mask"
                    style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-4.svg);"
                >
                    <img class="block" src="<?php echo $images["bottom_right"]['sizes']['large']; ?>" alt="<?php echo $images["bottom_right"]['alt']; ?>">
                </figure>
            </div>

            <?php if($images["top_center"]): ?>
                <div class="absolute -top-11 left-1/2 -translate-x-1/2">
                    <figure 
                        class="w-full max-w-[10rem] content-slider__mask"
                        style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-3-reflection-y.svg);"
                    >
                        <img class="block" src="<?php echo $images["top_center"]['sizes']['large']; ?>" alt="<?php echo $images["top_center"]['alt']; ?>">
                    </figure>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
