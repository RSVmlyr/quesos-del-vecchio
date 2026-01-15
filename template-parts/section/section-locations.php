<?php
$pre_title = get_sub_field('pre_title');
$title = get_sub_field('title');
$locations = get_sub_field('locations');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-locations.css?v=<?php echo _S_VERSION; ?>" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<section
    class="bg-beige-3 py-12 lg:pt-20 lg:pb-8 locations"
    data-section="Locations"
    id="locales">
    <div class="container grid grid-cols-[1fr_auto]">
        <div class="lg:max-w-[28rem]">
            <p class="text-sm text-blue tracking-tight font-medium mb-4 lg:text-lg lg:mb-6" data-animation-fade-in>
                <?php echo $pre_title; ?>
            </p>
            <h2 class="text-blue tracking-tight font-medium text-[2rem] leading-snug lg:text-[3.5rem]" data-animation-split-text>
                <?php echo $title; ?>
            </h2>
        </div>

        <div class="flex gap-2 self-end" data-animation-fade-in-stagger>
            <button data-animation-fade-in-stagger-item type="button" class="w-10 h-10 flex items-center justify-center rounded-full lg:w-14 lg:h-14 locations__button locations__button--grid locations__button--active" aria-label="Ver grilla">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="block lg:w-4 lg:h-4">
                    <path d="M5.85742 2.00024H1.85742V6.00024H5.85742V2.00024Z" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.1445 2.00024H8.14453V6.00024H12.1445V2.00024Z" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.1445 8.2854H8.14453V12.2854H12.1445V8.2854Z" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M5.85742 8.2854H1.85742V12.2854H5.85742V8.2854Z" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <button data-animation-fade-in-stagger-item type="button" class="w-10 h-10 flex items-center justify-center rounded-full lg:w-14 lg:h-14 locations__button locations__button--map" aria-label="Ver mapa">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="block lg:w-4 lg:h-4">
                    <path d="M4.7168 3.71509H12.1454" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4.7168 7.14282H12.1454" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4.7168 10.5706H12.1454" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M1.85742 3.71509H1.86442" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M1.85742 7.14282H1.86442" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M1.85742 10.5706H1.86442" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>

<div class="container pt-8 lg:pt-14">
    <div class="locations__grid locations__grid--active">
        <div class="grid gap-8 md:gap-6 md:grid-cols-2 lg:grid-cols-3" data-animation-fade-in-stagger>
            <?php foreach ($locations as $location) :
                setup_postdata($location);
                $location_image = get_the_post_thumbnail_url($location->ID, 'full');
                $location_address = get_field('adress', $location->ID);
                $schedule = get_field('schedule', $location->ID);
                $link_data = get_field('link', $location->ID);
            ?>
                <div class="grid gap-6 bg-white rounded-[2rem] p-3 lg:p-4" data-animation-fade-in-stagger-item>
                    <figure class="block aspect-[1.5] rounded-[1.5rem] overflow-hidden md:aspect-[1.8]">
                        <img class="w-full h-full object-cover" src="<?php echo $location_image; ?>" alt="<?php echo $location->post_title; ?>">
                    </figure>

                    <div class="grid gap-4 px-2">
                        <h3 class="text-2xl text-blue font-semibold tracking-tight leading-tight lg:text-[2rem]">
                            <?php echo $location->post_title; ?>
                        </h3>
                        <p class="text-blue tracking-tight font-medium flex items-start lg:leading-none gap-3 lg:text-lg">
                            <?php echo $location_address; ?>
                        </p>
                        <p class="tracking-tight text-blue font-medium flex items-start lg:leading-none gap-3 lg:text-lg">
                            <?php echo $schedule; ?>
                        </p>
                        <?php
                        if ($link_data) :
                            $link_url = $link_data['url'];
                            $link_title = $link_data['title'];
                        ?>
                            <a href="<?php echo esc_url($link_url); ?>" target="_blank" class="block w-full text-blue bg-orange mt-4 rounded-[12.5rem] py-4 px-[1.125rem] text-sm font-medium tracking-tight text-center lg:max-w-fit lg:px-6">
                                <?php echo esc_html($link_title ? $link_title : '¿CÓMO LLEGAR?'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            endforeach;
            wp_reset_postdata();
            ?>
    </div>
</div>

        <div class="locations__map">
            <div class="relative grid gap-8 lg:grid-cols-[27rem,1fr] lg:gap-6">
                <div class="aspect-square relative bg-beige-2 rounded-[2rem] overflow-hidden lg:order-2 lg:sticky lg:top-20 lg:aspect-[1.4]">
                    <div class="locations__google-map"></div>
                </div>

            <div class="lg:order-1">
                <?php foreach ($locations as $location) :
                    setup_postdata($location);
                    $location_address = get_field('adress', $location->ID);
                    $schedule = get_field('schedule', $location->ID);
                    $location_lat = get_field('lat', $location->ID);
                    $location_lng = get_field('lng', $location->ID);
                ?>
                    <div
                        class="py-8 first:pt-0 last:pb-0 last:border-b-0 border-b border-blue/10 locations__google-map-location"
                        data-location-name="<?php echo esc_attr($location->post_title); ?>"
                        data-location-lat="<?php echo esc_attr($location_lat); ?>"
                        data-location-lng="<?php echo esc_attr($location_lng); ?>"
                        data-location-address="<?php echo esc_attr($location_address); ?>"
                        data-location-schedule="<?php echo esc_attr($schedule); ?>">
                        <div class="grid gap-4 px-2">
                            <h3 class="text-2xl text-blue font-semibold tracking-tight leading-tight lg:text-[2rem]">
                                <?php echo $location->post_title; ?>
                            </h3>

                            <p class="text-blue tracking-tight font-medium flex items-start leading-none lg:leading-none gap-3 lg:text-lg">
                                <?php echo $location_address; ?>
                            </p>

                            <p class="tracking-tight text-blue font-medium flex items-start leading-none lg:leading-none gap-3 lg:text-lg">
                                <?php echo $schedule; ?>
                            </p>

                                <a href="<?php the_permalink(); ?>" target="_blank" class="block w-full text-blue bg-orange mt-4 rounded-[12.5rem] py-4 px-[1.125rem] text-sm font-medium tracking-tight text-center lg:max-w-fit lg:px-6" target="_blank">
                                    ¿CÓMO LLEGAR?
                                </a>
                            </div>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>

            </div>
        </div>
    </div>
</section>