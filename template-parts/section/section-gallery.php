<?php
$pre_title = get_sub_field('pre_title');
$title = get_sub_field('title');
$images = get_sub_field('images');

// Group images into slides
$slides = [];
$current_slide = [];
$slide_index = 0;

foreach ($images as $index => $image) {
    if ($slide_index % 2 === 0) {
        // Odd slides (1 image)
        $slides[] = [$image];
        $slide_index++;
    } else {
        // Even slides (3 images)
        $current_slide[] = $image;
        if (count($current_slide) === 3) {
            $slides[] = $current_slide;
            $current_slide = [];
            $slide_index++;
        }
    }
}

// Handle any remaining images in the current slide
if (!empty($current_slide)) {
    $slides[] = $current_slide;
}
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-gallery.css?v=<?php echo _S_VERSION; ?>" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 pt-14 pb-12 lg:pt-10 lg:pb-[3.625rem]"
    data-section="Gallery"
>
    <div class="container">
        <div class="grid gap-4 text-center lg:max-w-[61.25rem] lg:mx-auto">
            <p class="text-blue tracking-tight font-medium lg:text-lg lg:mb-6" data-animation-fade-in><?php echo $pre_title; ?></p>
            <h2 class="text-blue tracking-tight font-medium text-[2rem] leading-snug lg:text-5xl" data-animation-split-text>
                <?php echo $title; ?>
            </h2>
        </div>
    </div>

    <div class="swiper mt-12 lg:mt-20 gallery-swiper" data-animation-fade-in data-animation-threshold="0">
        <div class="swiper-wrapper gallery-swiper__wrapper">
            <?php foreach ($slides as $slide) : ?>
                <?php if (count($slide) === 1) : ?>
                    <div class="swiper-slide gallery-swiper__slide gallery-swiper__slide--single">
                        <div class="gallery__item gallery__item--single">
                            <figure class="overflow-hidden rounded-md w-full h-full">
                                <img class="w-full h-full object-cover object-center" src="<?php echo $slide[0]["image"]["sizes"]["large"]; ?>" alt="<?php echo $slide[0]["image"]['alt']; ?>">
                            </figure>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="swiper-slide gallery-swiper__slide gallery-swiper__slide--triple">
                        <div class="gallery__item gallery__item--triple">
                            <?php 
                            $image_count = count($slide);
                            foreach ($slide as $index => $image) : 
                                $grid_class = '';
                                if ($image_count === 2) {
                                    if ($index === 0) {
                                        $grid_class = 'grid-column: 1 / 3; grid-row: 1 / 2;';
                                    } else {
                                        $grid_class = 'grid-column: 1 / 3; grid-row: 2 / 3;';
                                    }
                                } elseif ($image_count === 1) {
                                    $grid_class = 'grid-column: 1 / 3; grid-row: 1 / 3;';
                                } else {
                                    if ($index === 0) {
                                        $grid_class = 'grid-column: 1 / 3; grid-row: 1 / 2;';
                                    } elseif ($index === 1) {
                                        $grid_class = 'grid-column: 1 / 2; grid-row: 2 / 3;';
                                    } else {
                                        $grid_class = 'grid-column: 2 / 3; grid-row: 2 / 3;';
                                    }
                                }
                            ?>
                                <div class="gallery__sub-item" style="<?php echo $grid_class; ?>">
                                    <figure class="overflow-hidden rounded-md w-full h-full"> 
                                        <img class="w-full h-full object-cover object-center" src="<?php echo $image["image"]["sizes"]["large"]; ?>" alt="<?php echo $image["image"]['alt']; ?>">
                                    </figure>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
