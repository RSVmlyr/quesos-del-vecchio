<?php
$eyebrow = get_sub_field('eyebrow');
$slider_items = get_sub_field('slides');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-vertical-slider.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="VerticalSlider"
    class="custom-template-<?php echo get_row_layout(); ?> relative bg-beige-2 vertical-slider"
>
    <div 
        class="flex flex-col justify-center sticky top-0 z-10 min-h-screen pt-14 pb-16 lg:pt-0 lg:pb-0 lg:flex-row lg:justify-center lg:items-center lg:h-screen lg:gap-20 xl:gap-28 container--lg"
    >
        <div class="swiper lg:flex-1 vertical-slider__swiper">    
            <div class="swiper-wrapper">    
                <?php foreach ($slider_items as $item): 
                    $image = $item['image'];
                ?>
                    <div class="swiper-slide vertical-slider__slide">
                        <div class="flex justify-center lg:h-auto lg:w-full">
                            <figure class="vertical-slider__blob">
                                <img class="absolute inset-0 object-cover object-center w-full h-full" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                            </figure>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-16 grid gap-4 lg:flex-1 lg:mt-0 lg:grow">
            <p class="text-sm font-semibold tracking-tight text-center text-blue lg:text-left vertical-slider__eyebrow">
                <?php echo $eyebrow; ?>
            </p>

            <div class="container no-container--lg">
                <?php foreach ($slider_items as $item) :
                    $title = $item['title'];
                ?>
                    <h2 class="text-center text-[2rem] tracking-tight font-medium text-blue leading-snug self-start max-w-[46.5rem] mx-auto lg:text-left lg:text-[3.5rem] lg:leading-tight lg:ml-0 lg:max-w-[31.25rem] vertical-slider__slide-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endforeach; ?>
            </div>

            <button type="button" class="hidden mt-10 max-w-fit text-lg tracking-tighter text-blue font-medium gap-2 items-center lg:flex vertical-slider__next-button">
                CONOCE MÁS

                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 4.16675V15.8334" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.8346 10L10.0013 15.8333L4.16797 10" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

            </button>
        </div>
    </div>

    <?php $index = 0; ?>
    <?php foreach ($slider_items as $item) : ?>
        <div class="h-28 pointer-events-none border-t border-beige-2 vertical-slider__trigger" data-index="<?php echo $index; ?>"></div>
        <?php $index++; ?>
    <?php endforeach; ?>

</section>
