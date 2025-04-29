<?php
/**
 * Section Hotspots
 */

// Access passed variables
$main_image_desktop = get_sub_field('image_desktop');
$main_image_mobile = get_sub_field('image_mobile');
$hotspots = get_sub_field('hotspots');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-hotspots.css" rel="stylesheet" type="text/css" media="all">

<section class="hotspots overflow-hidden lg:overflow-visible" data-section="Hotspots">
    <div class="relative">
        <div>
            <figure class="hidden w-full lg:block">
                <img class="block w-full" src="<?php echo $main_image_desktop['sizes']["2048x2048"]; ?>" alt="<?php echo $main_image_desktop['alt']; ?>">
            </figure>
    
            <figure class="block lg:hidden">
                <img src="<?php echo $main_image_mobile['sizes']["2048x2048"]; ?>" alt="<?php echo $main_image_mobile['alt']; ?>">
            </figure>
        </div>

        <div class="absolute inset-0" data-animation-fade-in-stagger data-animation-threshold="0.35">
            <?php foreach( $hotspots as $hotspot ) : 
                $type = $hotspot['type'];
                $label = $hotspot['label'];

                $coordinate_desktop = $hotspot['coordinate_desktop'];
                $coordinate_parts = explode(',', $coordinate_desktop);
                $left_position = isset($coordinate_parts[0]) ? $coordinate_parts[0] : '';
                $top_position = isset($coordinate_parts[1]) ? $coordinate_parts[1] : '';

                $coordinate_mobile = $hotspot['coordinate_mobile'];
                $coordinate_mobile_parts = explode(',', $coordinate_mobile);
                $left_position_mobile = isset($coordinate_mobile_parts[0]) ? $coordinate_mobile_parts[0] : '';
                $top_position_mobile = isset($coordinate_mobile_parts[1]) ? $coordinate_mobile_parts[1] : '';
            ?>
                <div 
                    class="hotspot"
                    style="
                        --desktop-top: <?php echo $top_position; ?>;
                        --desktop-left: <?php echo $left_position; ?>;
                        --mobile-top: <?php echo $top_position_mobile; ?>;
                        --mobile-left: <?php echo $left_position_mobile; ?>;
                    "
                    data-coordinate-desktop="<?php echo $coordinate_desktop; ?>"
                    data-coordinate-mobile="<?php echo $coordinate_mobile; ?>"
                >
                    <div data-animation-fade-in-stagger-item>
                        <button type="button" class="flex flex-col justify-center items-center gap-8 hotspot__button">
                            <div class="hotspot__button-icon">
                                <svg  class="w-2 h-2 lg:w-4 lg:h-4" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.5 6.99609H13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M7.5 13L7.5 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>


                            <div class="hidden bg-white text-blue text-lg tracking-tight font-medium py-3 px-[1.375rem] rounded-full lg:block">
                                <?php echo $label; ?>
                            </div>
                        </button>

                        <?php if ( $type === 'block' ) : 
                            $hotspot_image = $hotspot["block"]['image'];
                            $hotspot_title = $hotspot["block"]['title'];
                            $hotspot_description = $hotspot["block"]['description'];
                        ?>
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 min-w-[25rem] max-w-[25rem] w-full hotspot__box">
                                <div class="grid bg-white p-4 lg:p-6 gap-6 rounded-t-3xl lg:rounded-[3rem]">
                                    <div class="flex justify-between items-center lg:hidden">
                                        <p class="text-blue tracking-tight uppercase text-lg">
                                            <?php echo $label; ?>
                                        </p>

                                        <div class="hotspot__close">
                                            <button type="button" class="hotspot__close-button hotspot__close-button--blue">
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16.25 5.75L5.75 16.25" stroke="currentColor" stroke-width="1.3125" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.75 5.75L16.25 16.25" stroke="currentColor" stroke-width="1.3125" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <figure class="block w-full h-[12.5rem] rounded-3xl overflow-hidden">
                                        <img class="w-full h-full object-cover" src="<?php echo $hotspot_image['sizes']["2048x2048"]; ?>" alt="<?php echo $hotspot_image['alt']; ?>">
                                    </figure>
                                    
                                    <div class="text-blue grid gap-4 px-2 pb-2">
                                        <h2 class="text-[2rem] leading-tight font-medium tracking-tight font-figtree">
                                            <?php echo $hotspot_title; ?>
                                        </h2>
            
                                        <p class="leading-snug tracking-tight">
                                            <?php echo $hotspot_description; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>
                        
                        <?php if ( $type === 'recipe' ) : 
                            $recipe = $hotspot['recipe'][0];
                            $thumbnail = get_the_post_thumbnail_url($recipe->ID, 'full');
                            $title = $recipe->post_title;
                            $excerpt = $recipe->post_excerpt;
                            $preparation_time = get_field( "preparation_time", $recipe->ID );
                            $link = get_the_permalink($recipe->ID);
                        ?>
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 min-w-[25rem] max-w-[25rem] w-full hotspot__box">
                                <div class="grid bg-blue p-4 lg:p-6 gap-6 rounded-t-3xl lg:rounded-[3rem]">
                                    <div class="flex justify-between items-center lg:hidden">
                                        <p class="text-white tracking-tight uppercase text-lg">
                                            <?php echo $label; ?>
                                        </p>

                                        <div class="hotspot__close">
                                            <button type="button" class="hotspot__close-button hotspot__close-button--white">
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16.25 5.75L5.75 16.25" stroke="currentColor" stroke-width="1.3125" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.75 5.75L16.25 16.25" stroke="currentColor" stroke-width="1.3125" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <?php if ( $thumbnail ) : ?>
                                        <figure class="block w-full h-[12.5rem] rounded-3xl overflow-hidden">
                                            <img class="w-full h-full object-cover" src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>">
                                        </figure>
                                    <?php endif; ?>
    
                                    <div class="text-white grid gap-6 px-2 pb-2">
                                        <div class="grid gap-3">
                                            <p class="text-light-blue tracking-tight font-gazpacho">
                                                <?php echo $preparation_time; ?>
                                            </p>
    
                                            <h2 class="text-[1.5rem] leading-tight font-medium tracking-tight font-figtree">
                                                <?php echo $title; ?>   
                                            </h2>
                                        </div>
            
                                        <p class="leading-snug tracking-tight">
                                            <?php echo $excerpt; ?>
                                        </p>
    
                                        <a href="<?php echo $link; ?>" class="tracking-tight flex items-center gap-2">
                                            VER RECETA
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 12H19" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
