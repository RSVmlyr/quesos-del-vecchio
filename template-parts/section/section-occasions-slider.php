<?php
$total_posts = 0
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-occasions-slider.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-blue swiper occasions-slider" 
    data-section="OccasionsSlider"
    style="background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/circles.svg);"
>
    <div class="swiper-wrapper">
        <?php
        while (have_posts()) :
            the_post();
            $images = get_field('images');
            $marquee_text = get_field('marquee');

            $hover_image = get_field('hover_effect')['hover_image'];
            $product_image = get_field('hover_effect')['product_image'];
            $hover_color = get_field('hover_effect')['color'];

            $total_posts++;
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('swiper-slide flex-col gap-10 lg:gap-0 occasions-slider__item'); ?>>

                <div class="relative grow flex items-center justify-center">

                    <div class="occasions-slider__item-blob-container">
                        <div class="occasions-slider__item-blob occasions-slider__item-blob occasions-slider__item-blob-primary">
                            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-6 z-10 text-center w-full max-w-[15rem] lg:max-w-[33.375rem] lg:-translate-y-1/4">
                                <h2 class="text-white text-5xl font-medium mb-5 tracking-tight lg:text-[4rem]">
                                    <?php the_title(); ?>
                                </h2>
        
                                <a href="<?php the_permalink(); ?>" class="tracking-tight bg-white text-blue rounded-[100%] px-7 py-3 block max-w-fit mx-auto font-semibold hover:bg-blue hover:text-white transition-colors duration-300 lg:text-2xl lg:px-14 lg:py-4 occasions-slider__item-blob-button">
                                    Explorar
                                </a>
                            </div>
    
                            <?php if (has_post_thumbnail()) : 
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), '1536x1536');
                            ?>
                                <div class="occasions-slider__item-blob-image occasions-slider__item-blob-main" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"></div>
                            <?php endif; ?>

                            <div 
                                class="occasions-slider__item-blob-image occasions-slider__item-blob-hover  occasions-slider__item-blob-image--no-gradient" 
                                style="background-image: url('<?php echo esc_url($hover_image['sizes']['medium_large']); ?>'); background-color: <?php echo $hover_color; ?>"
                            >
                            </div>
                        </div>

                        <div class="occasions-slider__item-blob occasions-slider__item-blob-secondary occasions-slider__item-blob-secondary--first">
                            <div class="occasions-slider__item-blob-image occasions-slider__item-blob-image--no-gradient" style="background-image: url('<?php echo esc_url($images["first_image"]["sizes"]["medium_large"]); ?>');"></div>
                        </div>

                        <div class="occasions-slider__item-blob occasions-slider__item-blob-secondary occasions-slider__item-blob-secondary--left">
                            <div class="occasions-slider__item-blob-image occasions-slider__item-blob-image--no-gradient" style="background-image: url('<?php echo esc_url($images["second_image"]["sizes"]["medium_large"]); ?>');"></div>
                        </div>
                    </div>
                </div>

                <div class="flex w-full py-4 lg:bottom-0 lg:absolute lg:inset-x-0 occasions-slider__marquee">
                    <span class="whitespace-nowrap text-beige-3 text-[2rem] font-gazpacho font-medium flex items-center tracking-tight">
                        <?php echo $marquee_text; ?>

                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-5">
                            <path d="M15.9009 5.94001C16.2644 6.9904 15.6181 8.20886 14.1235 8.54499C13.7195 8.62902 12.8712 8.62902 11.6189 8.587C10.3666 8.50297 9.35675 8.587 8.54883 8.8391C9.15477 9.55336 9.92229 10.2256 10.9322 10.8979C11.9421 11.5701 12.5884 12.0743 12.8712 12.3684C13.8811 13.7129 13.8003 14.9314 12.8712 15.6036C12.1037 16.3179 10.7302 16.0238 9.92229 14.6373C9.72031 14.2591 9.43754 13.4608 9.15477 12.2424C8.872 11.0239 8.46804 10.0576 7.98329 9.30127C7.49854 10.0576 7.09458 11.0239 6.81181 12.2424C6.52904 13.4608 6.24627 14.2591 6.04429 14.6373C5.23637 16.1078 3.90331 16.3179 3.09539 15.6036C2.24708 14.9314 2.0047 13.7549 3.09539 12.4104C3.37816 12.1163 3.9841 11.6121 4.994 10.9399C6.00389 10.2256 6.81181 9.51135 7.37735 8.79708C6.52904 8.587 5.47875 8.50297 4.30727 8.587C3.13579 8.67103 2.32787 8.67103 1.88352 8.587C0.308079 8.25088 -0.257462 7.07443 0.1061 5.94001C0.429267 4.88961 1.51995 4.34341 3.0146 4.97364C3.37816 5.14171 4.0245 5.6459 4.9536 6.4442C5.88271 7.2425 6.77141 7.7887 7.61973 8.12483C7.57933 7.15846 7.29656 6.10807 6.85221 4.97364C6.40785 3.7972 6.20587 2.9989 6.16548 2.53673C5.59993 -0.866551 10.3666 -0.824535 9.8011 2.53673C9.76071 2.9989 9.47793 3.7972 9.03358 4.97364C8.58923 6.10807 8.34685 7.15846 8.30646 8.12483C9.15477 7.74669 10.0435 7.20048 10.9726 6.40218C11.9017 5.60388 12.5884 5.09969 12.952 4.93163C14.5678 4.30139 15.5373 4.80558 15.9009 5.94001Z" fill="currentColor"/>
                        </svg>
                    </span>
                </div>

                <div class="occasions-slider__item-product-images">
                    <?php for($i = 0; $i < 8; $i++) : ?>
                        <?php if(!empty($product_image)) : ?>
                            <figure class="occasions-slider__item-product-image">
                                <img src="<?php echo esc_url($product_image["sizes"]["medium_large"]); ?>" alt="" role="presentation">
                            </figure>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

            </article>
        <?php endwhile; ?>
    </div>

    <div class="absolute bottom-[5.5rem] z-10 text-white inset-x-0 container--lg lg:bottom-28">
        <div class="w-full max-w-52 mx-auto flex items-center justify-center gap-3 lg:mr-0 lg:grid lg:grid-cols-2 lg:grid-rows-2 lg:max-w-fit">
            <div class="lg:row-span-1 lg:col-start-2">
                <button type="button" class="swiper-button-prev occasions-slider__button occasions-slider__button--prev">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 1L1 6L6 11" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="flex items-center gap-3 lg:row-span-2 lg:col-start-1 lg:row-start-1 lg:flex-col">
                <span class="text-2xl font-medium tracking-tight occasions-slider__current-count">
                    01
                </span>
                <div 
                    class="occasions-slider__progress" 
                    style="--progress-width: <?php echo (1/$total_posts) * 100; ?>%;"
                    data-progress-width="<?php echo $total_posts; ?>"
                ></div>
                <span class="text-2xl tracking-tight font-medium">
                    <?php echo str_pad($total_posts, 2, '0', STR_PAD_LEFT); ?>
                </span>
            </div>
            <div class="lg:row-span-1 lg:col-start-2">
                <button type="button" class="swiper-button-next occasions-slider__button occasions-slider__button--next">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 1L1 6L6 11" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>
