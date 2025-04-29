<?php
    $pre_title = get_sub_field('pre_title');
    $title = get_sub_field('title');
    $link = get_sub_field('instagram_link');
    $reels = get_sub_field('reels');
?>




<link href="<?php echo get_template_directory_uri(); ?>/dist/section-instagram-reels.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="InstagramReels"
    class="block custom-template-<?php echo get_row_layout(); ?> bg-beige-3 py-[3.3125rem] overflow-hidden"
>
    <!-- gap-[6.125rem] -->
    <!-- container--right -->
    <div class="container--right relative flex flex-col gap-8 lg:flex-row lg:items-center">
        <div class="w-full overflow-hidden lg:min-w-[33.4375rem] instagram-reels__description">
            <div class="max-w-72 lg:min-w-[27.4375rem]">
                <div class="grid gap-6">
                    <p class="hidden text-lg tracking-tight font-medium text-blue lg:block" data-animation-fade-in>
                        <?php echo $pre_title; ?>
                    </p>
            
                    <h2 class="text-blue text-[2rem] font-medium leading-tight tracking-tight lg:text-[3.5rem]" data-animation-split-text>
                        <?php echo $title; ?>
                    </h2>
                </div>
        
                <a 
                    href="<?php echo $link["url"] ?>" 
                    target="<?php echo $link["target"]; ?>" 
                    class="flex gap-3 items-center mt-4 text-blue text-sm font-medium tracking-tight lg:text-lg lg:mt-[2.625rem]"
                    data-animation-fade-in
                >
                    <div class="bg-blue p-2 rounded-xl">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6.72C10.9557 6.72 9.93488 7.02967 9.06659 7.60984C8.1983 8.19001 7.52155 9.01464 7.12192 9.97943C6.72229 10.9442 6.61772 12.0059 6.82145 13.0301C7.02518 14.0543 7.52805 14.9951 8.26648 15.7335C9.0049 16.4719 9.9457 16.9748 10.9699 17.1785C11.9941 17.3823 13.0558 17.2777 14.0206 16.8781C14.9854 16.4785 15.81 15.8017 16.3902 14.9334C16.9703 14.0651 17.28 13.0443 17.28 12C17.2784 10.6001 16.7216 9.25808 15.7318 8.26823C14.7419 7.27838 13.3999 6.72159 12 6.72ZM12 16.32C11.1456 16.32 10.3104 16.0666 9.59994 15.5919C8.88952 15.1173 8.33581 14.4426 8.00884 13.6532C7.68187 12.8638 7.59632 11.9952 7.76301 11.1572C7.9297 10.3192 8.34114 9.54946 8.9453 8.9453C9.54946 8.34114 10.3192 7.9297 11.1572 7.76301C11.9952 7.59632 12.8638 7.68187 13.6532 8.00884C14.4426 8.33581 15.1173 8.88952 15.5919 9.59994C16.0666 10.3104 16.32 11.1456 16.32 12C16.32 13.1457 15.8649 14.2445 15.0547 15.0547C14.2445 15.8649 13.1457 16.32 12 16.32ZM17.76 0H6.24C4.58563 0.00190559 2.99957 0.659944 1.82976 1.82976C0.659944 2.99957 0.00190559 4.58563 0 6.24V17.76C0.00190559 19.4144 0.659944 21.0004 1.82976 22.1702C2.99957 23.3401 4.58563 23.9981 6.24 24H17.76C19.4144 23.9981 21.0004 23.3401 22.1702 22.1702C23.3401 21.0004 23.9981 19.4144 24 17.76V6.24C23.9981 4.58563 23.3401 2.99957 22.1702 1.82976C21.0004 0.659944 19.4144 0.00190559 17.76 0ZM23.04 17.76C23.0384 19.1599 22.4816 20.5019 21.4918 21.4918C20.5019 22.4816 19.1599 23.0384 17.76 23.04H6.24C4.84014 23.0384 3.49808 22.4816 2.50823 21.4918C1.51838 20.5019 0.961588 19.1599 0.96 17.76V6.24C0.961588 4.84014 1.51838 3.49808 2.50823 2.50823C3.49808 1.51838 4.84014 0.961588 6.24 0.96H17.76C19.1599 0.961588 20.5019 1.51838 21.4918 2.50823C22.4816 3.49808 23.0384 4.84014 23.04 6.24V17.76ZM19.2 5.76C19.2 5.94987 19.1437 6.13548 19.0382 6.29335C18.9327 6.45122 18.7828 6.57426 18.6074 6.64692C18.432 6.71958 18.2389 6.7386 18.0527 6.70155C17.8665 6.66451 17.6954 6.57308 17.5612 6.43882C17.4269 6.30456 17.3355 6.13351 17.2984 5.94729C17.2614 5.76107 17.2804 5.56804 17.3531 5.39262C17.4257 5.21721 17.5488 5.06728 17.7067 4.96179C17.8645 4.8563 18.0501 4.8 18.24 4.8C18.4946 4.8 18.7388 4.90114 18.9188 5.08118C19.0989 5.26121 19.2 5.50539 19.2 5.76Z" fill="#F5E6D2"/>
                        </svg>
                    </div>

                    <?php echo $link["title"]; ?>

                    <svg class="w-5 h-5 lg:w-6 lg:h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19" stroke="#23195F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 5L19 12L12 19" stroke="#23195F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="relative w-full max-w-full lg:static" data-animation-fade-in-stagger>
            <div class="swiper instagram-reels__swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($reels as $item): 
                        $reel = $item['reel'];
                        $reel_link = $item['reel_link'];
                    ?>
                        <div class="swiper-slide instagram-reels__slide">
                            <a href="<?php echo $reel_link; ?>" target="_blank" class="block" data-animation-fade-in-stagger-item>
                                <video autoplay muted loop playsinline preload="none" src="<?php echo $reel; ?>" class="pointer-events-none aspect-[9/16] overflow-hidden rounded-3xl instagram-reels__video">
                                </video>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button type="button" class="absolute bg-blue rounded-[100%] flex justify-center items-center w-12 h-12 top-1/2 -translate-y-1/2 z-10 rotate-180 instagram-reels__button--prev" aria-label="Anterior reel">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19" stroke="#F5E6D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 5L19 12L12 19" stroke="#F5E6D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
    
            <button type="button" class="absolute bg-blue rounded-[100%] flex justify-center items-center w-12 h-12  top-1/2 -translate-y-1/2 z-10 right-6 instagram-reels__button--next active" aria-label="Siguiente reel">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19" stroke="#F5E6D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 5L19 12L12 19" stroke="#F5E6D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

    </div>
</section>
