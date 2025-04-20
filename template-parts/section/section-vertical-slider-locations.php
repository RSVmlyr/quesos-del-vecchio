<?php
$slider_items = get_sub_field('slides');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-vertical-slider-locations.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="VerticalSliderLocations"
    class="custom-template-<?php echo get_row_layout(); ?> relative bg-beige-2 vertical-slider-locations"
>
    <div 
        class="flex flex-col justify-center sticky top-0 z-10 min-h-screen pt-14 pb-16 lg:pt-0 lg:pb-0 lg:flex-row lg:justify-center lg:items-center lg:h-screen lg:gap-20 xl:gap-28 container--lg"
    >

        <div class="mb-16 grid gap-4 lg:flex-1 lg:mt-0 lg:grow">
            <div class="relative container no-container--lg vertical-slider-locations__titles-container">
                <?php foreach ($slider_items as $item) :
                    $eyebrow = $item['eyebrow'];
                    $title = $item['title'];
                    $description = $item['description'];
                ?>
                    <div class="absolute top-0 inset-x-0 vertical-slider-locations__slide-content">
                        <p class="text-sm font-semibold tracking-tight text-center text-blue mb-3 lg:text-left vertical-slider-locations__eyebrow">
                            <?php echo $eyebrow; ?>
                        </p>

                        <h2 class="text-center text-[2rem] tracking-tight font-medium text-blue leading-snug self-start max-w-[46.5rem] mx-auto lg:text-left lg:text-[3.5rem] lg:leading-tight lg:ml-0 lg:max-w-[31.25rem] vertical-slider-locations__slide-title">
                            <?php echo $title; ?>
                        </h2>

                        <p class="font-gazpacho text-2xl tracking-tight text-center text-blue font-medium mt-9 leading-snug lg:mt-40 lg:text-left lg:text-[2rem] lg:max-w-[26.8rem] vertical-slider-locations__slide-description">
                            <?php echo $description; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="swiper lg:flex-1 vertical-slider-locations__swiper">    
            <div class="swiper-wrapper">    
                <?php foreach ($slider_items as $item): 
                    $image = $item['image'];
                ?>
                    <div class="swiper-slide vertical-slider-locations__slide">
                        <div class="flex justify-center lg:h-auto lg:w-full">
                            <figure class="vertical-slider-locations__blob">
                                <img class="absolute inset-0 object-cover object-center w-full h-full" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                            </figure>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php $index = 0; ?>
    <?php foreach ($slider_items as $item) : ?>
        <div class="h-[80vh] pointer-events-none border-t border-beige-2 vertical-slider-locations__trigger" data-index="<?php echo $index; ?>"></div>
        <?php $index++; ?>
    <?php endforeach; ?>

</section>
