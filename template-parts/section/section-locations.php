<?php
$pre_title = get_sub_field('pre_title');
$title = get_sub_field('title');
$locations = get_sub_field('locations');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-locations.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 py-12 lg:pt-20 lg:pb-8 locations"
    data-section="Locations"
>
    <div class="container grid grid-cols-[1fr_auto]"> 
        <div class="lg:max-w-[28rem]">
            <p class="text-sm text-blue tracking-tight font-medium mb-4 lg:text-lg lg:mb-6">
                <?php echo $pre_title; ?>
            </p>
            <h2 class="text-blue tracking-tight font-medium text-[2rem] leading-snug lg:text-[3.5rem]">
                <?php echo $title; ?>
            </h2>
        </div>

        <div class="flex gap-2 self-end">
            <button type="button" class="w-10 h-10 flex items-center justify-center rounded-full lg:w-14 lg:h-14 locations__button locations__button--grid locations__button--active" aria-label="Ver grilla">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="block lg:w-4 lg:h-4">
                    <path d="M5.85742 2.00024H1.85742V6.00024H5.85742V2.00024Z" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.1445 2.00024H8.14453V6.00024H12.1445V2.00024Z" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.1445 8.2854H8.14453V12.2854H12.1445V8.2854Z" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.85742 8.2854H1.85742V12.2854H5.85742V8.2854Z" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <button type="button" class="w-10 h-10 flex items-center justify-center rounded-full lg:w-14 lg:h-14 locations__button locations__button--map" aria-label="Ver mapa">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="block lg:w-4 lg:h-4">
                    <path d="M4.7168 3.71509H12.1454" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.7168 7.14282H12.1454" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.7168 10.5706H12.1454" stroke="currentColor" stroke-width="0.857143" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1.85742 3.71509H1.86442" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1.85742 7.14282H1.86442" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1.85742 10.5706H1.86442" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="container pt-8 lg:pt-14">
        <div class="locations__grid locations__grid--active">
            <div class="grid gap-8 md:gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($locations as $location) : 
                    setup_postdata($location);
                    $location_image = get_the_post_thumbnail_url($location->ID, 'full');
                    $location_address = get_field('adress', $location->ID);
                    $schedule = get_field('schedule', $location->ID);
        
                ?>
                    <div class="grid gap-6 bg-white rounded-[2rem] p-3 lg:p-4">
                        <figure class="block aspect-[1.5] rounded-[1.5rem] overflow-hidden md:aspect-[1.8]">
                            <img class="w-full h-full object-cover" src="<?php echo $location_image; ?>" alt="<?php echo $location->post_title; ?>">
                        </figure>

                        <div class="grid gap-4 px-2">
                            <h3 class="text-2xl text-blue font-semibold tracking-tight leading-tight lg:text-[2rem]">
                                <?php echo $location->post_title; ?>
                            </h3>
        
                            <p class="text-blue tracking-tight font-medium flex items-start lg:leading-none gap-3 lg:text-lg">
                                <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 0.267822C5.35954 0.269683 3.78681 0.922176 2.62683 2.08215C1.46685 3.24213 0.814361 4.81487 0.8125 6.45532C0.8125 11.7499 6.4375 15.7485 6.67727 15.9159C6.77184 15.9821 6.88452 16.0177 7 16.0177C7.11548 16.0177 7.22816 15.9821 7.32273 15.9159C7.5625 15.7485 13.1875 11.7499 13.1875 6.45532C13.1856 4.81487 12.5331 3.24213 11.3732 2.08215C10.2132 0.922176 8.64046 0.269683 7 0.267822ZM7 4.20532C7.44501 4.20532 7.88002 4.33728 8.25003 4.58452C8.62004 4.83175 8.90843 5.18315 9.07873 5.59428C9.24903 6.00542 9.29358 6.45782 9.20677 6.89428C9.11995 7.33073 8.90566 7.73164 8.59099 8.04631C8.27632 8.36098 7.87541 8.57527 7.43895 8.66209C7.0025 8.74891 6.5501 8.70435 6.13896 8.53405C5.72783 8.36375 5.37643 8.07537 5.12919 7.70536C4.88196 7.33534 4.75 6.90033 4.75 6.45532C4.75 5.85859 4.98705 5.28629 5.40901 4.86433C5.83097 4.44238 6.40326 4.20532 7 4.20532Z" fill="#23195F"/>
                                </svg>

                                <?php echo $location_address; ?>
                            </p>
        
                            <p class="tracking-tight text-blue font-medium flex items-start lg:leading-none gap-3 lg:text-lg">
                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.5692 11.169C13.7328 11.3332 13.8554 11.5336 13.9272 11.754C13.9989 11.9744 14.0177 12.2085 13.9822 12.4375C13.9466 12.6666 13.8575 12.884 13.7223 13.0722C13.5871 13.2604 13.4094 13.4141 13.2037 13.5209C12.0282 14.1492 10.6585 14.3097 9.36958 13.9704C5.94859 13.1092 1.03134 8.19195 0.17014 4.77095C-0.169212 3.48199 -0.00864027 2.11238 0.619645 0.93686C0.726417 0.731153 0.880133 0.553483 1.06834 0.418236C1.25656 0.282988 1.47397 0.193965 1.70299 0.158375C1.93201 0.122785 2.16619 0.141628 2.38656 0.21338C2.60694 0.285131 2.80733 0.407773 2.97149 0.571374L4.43133 2.03051C4.64186 2.23892 4.78431 2.50621 4.83993 2.79718C4.89555 3.08814 4.86172 3.38913 4.74291 3.66049C4.61289 3.96495 4.42827 4.24306 4.19818 4.48108C2.52899 6.15027 7.99096 11.6122 9.65945 9.94236C9.89751 9.71144 10.1759 9.5261 10.4807 9.39553C10.7521 9.27652 11.0531 9.24259 11.3441 9.29821C11.6351 9.35384 11.9024 9.49641 12.1107 9.7071L13.5692 11.169Z" fill="#23195F"/>
                                </svg>

                                <?php echo $schedule; ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="block w-full text-blue bg-orange mt-4 rounded-[12.5rem] py-4 px-[1.125rem] text-sm font-medium tracking-tight text-center lg:max-w-fit lg:px-6">
                                ¿CÓMO LLEGAR?
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
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
                        $location_image = get_the_post_thumbnail_url($location->ID, 'full');
                        $location_address = get_field('adress', $location->ID);
                        $schedule = get_field('schedule', $location->ID);
                        $location_lat = get_field('lat', $location->ID);
                        $location_lng = get_field('lng', $location->ID);
                    ?>
                        <div 
                            class="py-8 first:pt-0 last:pb-0 last:border-b-0 border-b border-blue/10 locations__google-map-location"
                            data-location-name="<?php echo $location->post_title; ?>"
                            data-location-lat="<?php echo $location_lat; ?>"
                            data-location-lng="<?php echo $location_lng; ?>"
                            data-location-address="<?php echo $location_address; ?>"
                        >
                            <div class="grid gap-4 px-2">
                                <h3 class="text-2xl text-blue font-semibold tracking-tight leading-tight lg:text-[2rem]">
                                    <?php echo $location->post_title; ?>
                                </h3>
            
                                <p class="text-blue tracking-tight font-medium flex items-start leading-none lg:leading-none gap-3 lg:text-lg">
                                    <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 0.267822C5.35954 0.269683 3.78681 0.922176 2.62683 2.08215C1.46685 3.24213 0.814361 4.81487 0.8125 6.45532C0.8125 11.7499 6.4375 15.7485 6.67727 15.9159C6.77184 15.9821 6.88452 16.0177 7 16.0177C7.11548 16.0177 7.22816 15.9821 7.32273 15.9159C7.5625 15.7485 13.1875 11.7499 13.1875 6.45532C13.1856 4.81487 12.5331 3.24213 11.3732 2.08215C10.2132 0.922176 8.64046 0.269683 7 0.267822ZM7 4.20532C7.44501 4.20532 7.88002 4.33728 8.25003 4.58452C8.62004 4.83175 8.90843 5.18315 9.07873 5.59428C9.24903 6.00542 9.29358 6.45782 9.20677 6.89428C9.11995 7.33073 8.90566 7.73164 8.59099 8.04631C8.27632 8.36098 7.87541 8.57527 7.43895 8.66209C7.0025 8.74891 6.5501 8.70435 6.13896 8.53405C5.72783 8.36375 5.37643 8.07537 5.12919 7.70536C4.88196 7.33534 4.75 6.90033 4.75 6.45532C4.75 5.85859 4.98705 5.28629 5.40901 4.86433C5.83097 4.44238 6.40326 4.20532 7 4.20532Z" fill="#23195F"/>
                                    </svg>

                                    <?php echo $location_address; ?>
                                </p>
            
                                <p class="tracking-tight text-blue font-medium flex items-start leading-none lg:leading-none gap-3 lg:text-lg">
                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.5692 11.169C13.7328 11.3332 13.8554 11.5336 13.9272 11.754C13.9989 11.9744 14.0177 12.2085 13.9822 12.4375C13.9466 12.6666 13.8575 12.884 13.7223 13.0722C13.5871 13.2604 13.4094 13.4141 13.2037 13.5209C12.0282 14.1492 10.6585 14.3097 9.36958 13.9704C5.94859 13.1092 1.03134 8.19195 0.17014 4.77095C-0.169212 3.48199 -0.00864027 2.11238 0.619645 0.93686C0.726417 0.731153 0.880133 0.553483 1.06834 0.418236C1.25656 0.282988 1.47397 0.193965 1.70299 0.158375C1.93201 0.122785 2.16619 0.141628 2.38656 0.21338C2.60694 0.285131 2.80733 0.407773 2.97149 0.571374L4.43133 2.03051C4.64186 2.23892 4.78431 2.50621 4.83993 2.79718C4.89555 3.08814 4.86172 3.38913 4.74291 3.66049C4.61289 3.96495 4.42827 4.24306 4.19818 4.48108C2.52899 6.15027 7.99096 11.6122 9.65945 9.94236C9.89751 9.71144 10.1759 9.5261 10.4807 9.39553C10.7521 9.27652 11.0531 9.24259 11.3441 9.29821C11.6351 9.35384 11.9024 9.49641 12.1107 9.7071L13.5692 11.169Z" fill="#23195F"/>
                                    </svg>

                                    <?php echo $schedule; ?>
                                </p>

                                <a href="<?php the_permalink(); ?>" class="block w-full text-blue bg-orange mt-4 rounded-[12.5rem] py-4 px-[1.125rem] text-sm font-medium tracking-tight text-center lg:max-w-fit lg:px-6">
                                    ¿CÓMO LLEGAR?
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</section>
