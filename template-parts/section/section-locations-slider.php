<?php
    $eyebrow = get_sub_field('eyebrow');
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $link = get_sub_field('link');
    $locations = get_sub_field('locations');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-locations-slider.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="LocationsSlider"
    class="bg-beige-3 py-8 lg:py-20 overflow-hidden"
>
    <div class="container">
        <div class="bg-beige-2 overflow-hidden rounded-[3.5rem] px-4 py-8 lg:px-20 lg:py-20 lg:grid-cols-2 lg:grid lg:items-center">
            <div class="text-center max-w-[25rem] mb-6 lg:mb-0">
                <p class="text-xs font-medium text-blue tracking-tight lg:text-lg lg:font-semibold" data-animation-fade-in>
                    <?php echo $eyebrow; ?>
                </p>
    
                <h2 class="text-[2rem] font-medium text-blue tracking-tight leading-tight my-4 lg:text-[3.5rem]" data-animation-split-text>
                    <?php echo $title; ?>
                </h2>
    
                <p class="text-blue tracking-tight leading-tight max-w-64 mx-auto lg:max-w-none lg:text-2xl" data-animation-fade-in>
                    <?php echo $description; ?>
                </p>
    
                <a href="<?php echo $link['url']; ?>" class="hidden text-blue bg-orange mt-[3.25rem] rounded-[12.5rem] py-6 px-12 text-lg font-semibold tracking-tight lg:block" data-animation-scale>  
                    <?php echo $link['title']; ?>
                </a>
            </div>

            <div class="swiper locations-slider__swiper" data-animation-fade-in-stagger>
                <div class="swiper-wrapper">
                    <?php foreach ($locations as $location) : 
                        setup_postdata($location);
                        $location_image = get_the_post_thumbnail_url($location->ID, 'full');
                        $location_address = get_field('adress', $location->ID);
                        $schedule = get_field('schedule', $location->ID);
        
                    ?>
                        <div class="swiper-slide locations-slider__slide">
                            <a data-animation-fade-in-stagger-item href="<?php the_permalink(); ?>" class="block bg-white rounded-2xl lg:rounded-[3rem] locations-slider__location">
                                <div class="px-3 pt-3 pb-2 lg:p-8">
                                    <h3 class="text-sm text-blue font-semibold tracking-tight leading-tight mb-2 font-figtree lg:text-[2rem] lg:font-medium lg:mb-6">
                                        <?php echo $location->post_title; ?>
                                    </h3>
                
                                    <p class="text-light-blue tracking-tight font-semibold mb-1 text-xs lg:text-base">
                                        <?php echo $location_address; ?>
                                    </p>
                
                                    <p class="tracking-tight text-blue font-semibold text-xs lg:text-base">
                                        <?php echo $schedule; ?>
                                    </p>
                                </div>

                                <div class="px-3 pb-3 pt-2 lg:px-6 lg:pb-6">
                                    <figure class="block aspect-[1.35] rounded-2xl overflow-hidden lg:rounded-3xl">
                                        <img class="w-full h-full object-cover" src="<?php echo $location_image; ?>" alt="<?php echo $location->post_title; ?>">
                                    </figure>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="locations-slider__pagination"></div>
            </div>

            <div class="flex justify-center lg:hidden">
                <a href="<?php echo $link['url']; ?>" class="inline-block mx-auto text-blue bg-orange mt-6 rounded-[12.5rem] py-4 px-[1.125rem] text-sm font-semibold tracking-tight">  
                    <?php echo $link['title']; ?>
                </a>
            </div>
        </div>
    </div>
</section>
