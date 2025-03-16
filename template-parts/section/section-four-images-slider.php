<?php
$slider_items = get_sub_field('slide');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-four-images-slider.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="FourImagesSlider"
    class="custom-template-<?php echo get_row_layout(); ?> relative bg-beige-3 py-12 lg:min-h-screen lg:flex lg:items-center"
>
    <div class="swiper w-full four-images-slider__swiper">
        <div class="swiper-wrapper">
            <?php foreach ($slider_items as $item): 
                $title = $item['title'];
                $description = $item['description'];
                $image = $item['images']['top_left'];
            ?>
                <div class="swiper-slide">
                    <div class="container grid gap-4 lg:gap-8">
                        <h2 class="text-blue text-center text-[2.5rem] tracking-tight font-medium leading-tight max-w-80 mx-auto lg:text-[4rem] lg:max-w-[25.625rem]">
                            <?php echo $title; ?>
                        </h2>
                        <p class="text-blue font-medium text-center tracking-tight mx-auto max-w-[16.625rem] lg:text-2xl lg:max-w-[24rem] lg:font-normal">
                            <?php echo $description; ?>
                        </p>
                    </div>

                    <figure class="mt-8 w-full max-w-[22.375rem] mx-auto lg:hidden">
                        <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                    </figure>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if(count($slider_items) > 1): ?>
            <div class="w-full max-w-52 mx-auto flex items-center justify-center gap-3 mt-8 text-blue lg:max-w-fit lg:mt-20">
                <div class="">
                    <button type="button" class="swiper-button-prev four-images-slider__button four-images-slider__button--prev">
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 1L1 6L6 11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-medium tracking-tight four-images-slider__current-count">
                        01
                    </span>
                    <div 
                        class="four-images-slider__progress" 
                        style="--progress-width: <?php echo (1/count($slider_items)) * 100; ?>%;"
                        data-progress-width="<?php echo count($slider_items); ?>"
                    ></div>
                    <span class="text-2xl tracking-tight font-medium">
                        <?php echo str_pad(count($slider_items), 2, '0', STR_PAD_LEFT); ?>
                    </span>
                </div>
                <div class="">
                    <button type="button" class="swiper-button-next four-images-slider__button four-images-slider__button--next">
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 1L1 6L6 11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div class="hidden pointer-events-none absolute inset-0 container lg:block">
        <?php foreach ($slider_items as $item): 
            $imageTopLeft = $item['images']['top_left'];
            $imageTopRight = $item['images']['top_right'];
            $imageBottomLeft = $item['images']['bottom_left'];
            $imageBottomRight = $item['images']['bottom_right'];
        ?>
            <div class="absolute top-11 bottom-11 left-12 right-12 four-images-slider__images">
                <figure class="absolute top-0 left-0 w-full max-w-[15.75rem] xl:max-w-[20.75rem]">
                    <img class="block" src="<?php echo $imageTopLeft['sizes']['large']; ?>" alt="<?php echo $imageTopLeft['alt']; ?>">
                </figure>
    
                <figure class="absolute top-0 right-0 w-full max-w-[18.75rem] xl:max-w-[23.75rem]">
                    <img class="block" src="<?php echo $imageTopRight['sizes']['large']; ?>" alt="<?php echo $imageTopRight['alt']; ?>">
                </figure>
    
                <figure class="absolute bottom-0 left-0 w-full max-w-[20.125rem] xl:max-w-[25.125rem]">
                    <img class="block" src="<?php echo $imageBottomLeft['sizes']['large']; ?>" alt="<?php echo $imageBottomLeft['alt']; ?>">
                </figure>
    
                <figure class="absolute bottom-0 right-0 w-full max-w-[21.5rem] xl:max-w-[23.5rem]">
                    <img class="block" src="<?php echo $imageBottomRight['sizes']['large']; ?>" alt="<?php echo $imageBottomRight['alt']; ?>">
                </figure>
            </div>
        <?php endforeach; ?>
    </div>
</section>
