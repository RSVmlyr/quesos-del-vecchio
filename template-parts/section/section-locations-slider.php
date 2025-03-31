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
    class="bg-beige-3 py-20"
>
    <div class="container">
        <div class="bg-beige-2 overflow-hidden rounded-[3.5rem] grid grid-cols-2 items-center px-20 py-20">
            <div class="text-center max-w-[25rem]">
                <p class="text-lg font-semibold text-blue tracking-tight">
                    <?php echo $eyebrow; ?>
                </p>
    
                <h2 class="text-[3.5rem] font-medium text-blue tracking-tight leading-tight my-4">
                    <?php echo $title; ?>
                </h2>
    
                <p class="text-2xl text-blue tracking-tight leading-tight">
                    <?php echo $description; ?>
                </p>
    
                <a href="<?php echo $link['url']; ?>" class="block text-blue bg-orange mt-[3.25rem] rounded-[12.5rem] py-6 px-12 text-lg font-semibold tracking-tight">  
                    <?php echo $link['title']; ?>
                </a>
            </div>

            <div class="swiper locations-slider__swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($locations as $location) : 
                        setup_postdata($location);
                        $location_image = get_the_post_thumbnail_url($location->ID, 'full');
                        $location_address = get_field('adress', $location->ID);
                        $schedule = get_field('schedule', $location->ID);
        
                    ?>
                        <div class="swiper-slide locations-slider__slide">
                            <a href="<?php the_permalink(); ?>" class="block bg-white rounded-[3rem] locations-slider__location">
                                <div class="p-8">
                                    <h3 class="text-[2rem] text-blue font-medium tracking-tight leading-tight mb-6 font-figtree">
                                        <?php echo $location->post_title; ?>
                                    </h3>
                
                                    <p class="text-light-blue tracking-tight font-semibold mb-1">
                                        <?php echo $location_address; ?>
                                    </p>
                
                                    <p class="tracking-tight text-blue font-semibold">
                                        <?php echo $schedule; ?>
                                    </p>
                                </div>

                                <div class="px-6 pb-6">
                                    <figure class="block aspect-[1.35] rounded-3xl overflow-hidden">
                                        <img class="w-full h-full object-cover" src="<?php echo $location_image; ?>" alt="<?php echo $location->post_title; ?>">
                                    </figure>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="locations-slider__pagination"></div>
            </div>
        </div>
    </div>
</section>
