<?php
    $pre_title = $args['pre_title'];
    $title = $args['title'];
    $recipes = $args['recipes'];
    $background_color = $args['background_color'];
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-recipe-slider.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="RecipeSlider"
    class="custom-template-<?php echo get_row_layout(); ?> <?php echo $background_color; ?> py-8 overflow-hidden lg:pt-20 lg:pb-4"
>
    <div class="mb-8 lg:mb-[7.5rem]">
        <div class="container text-center">
            <p class="text-sm font-medium tracking-tight text-blue mb-2 lg:text-lg lg:font-semibold">
                <?php echo $pre_title; ?>
            </p>

            <h2 class="text-[2rem] leading-snug tracking-tight font-medium text-blue lg:text-[4rem] lg:leading-snug">
                <?php echo $title; ?>
            </h2>
        </div>
    </div>


    <div class="container no-container--lg">
        <div class="embla__viewport recipe-slider__embla_viewport overflow-hidden">
            <div class="embla__container recipe-slider__container">
                <?php foreach( $recipes as $post ): 
                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post); 
                    $product = get_field( "product", $post->ID )[0];
                    $preparation_time = get_field( "preparation_time", $post->ID );
                    $shortname = get_field( "shortname", $product->ID );
                ?>
                    <div class="embla__slide recipe-slider__slide flex-shrink-0">
                        <a href="<?php the_permalink(); ?>" class="block recipe-slider__slide-item" aria-label="<?php the_title(); ?>">
                            <h2 class="text-lg tracking-tight font-medium text-center text-blue leading-tight lg:text-2xl">
                                <?php the_title(); ?>
                            </h2>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <figure 
                                    class="block max-w-[20.5rem] aspect-[1.2] mt-4 mx-auto recipe-slider__slide-image"
                                    style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-<?php echo $post->ID % 2 === 0 ? '2' : '3'; ?>.svg);"
                                >
                                    <?php the_post_thumbnail('large', ['class' => 'block w-full h-full object-center object-cover']); ?>
                                </figure>
                            <?php endif; ?>

                            <div class="flex bg-white text-blue max-w-fit mx-auto overflow-hidden rounded-[6.25rem] -mt-6 relative z-10">
                                <p class="bg-blue text-white font-gazpacho tracking-tight font-medium py-4 px-6 rounded-[6.25rem] lg:text-lg">
                                    <?php echo $shortname;  ?>
                                </p>

                                <p class="font-gazpacho tracking-tight font-medium px-6 bg-white flex items-center lg:text-lg">
                                    <?php echo $preparation_time; ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>

    <?php if(count($recipes) > 1): ?>
        <div class="w-full mt-8 max-w-52 mx-auto flex items-center justify-center gap-3 text-blue lg:hidden">
            <div class="">
                <button type="button" class="recipe-slider__button recipe-slider__button--prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="#23195F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="flex items-center gap-3">
                <span class="font-semibold tracking-tight recipe-slider__current-count">
                    01
                </span>
                <div 
                    class="recipe-slider__progress" 
                    style="--progress-width: <?php echo (1/count($recipes)) * 100; ?>%;"
                    data-progress-width="<?php echo count($recipes); ?>"
                ></div>
                <span class="font-semibold tracking-tight">
                    <?php echo str_pad(count($recipes), 2, '0', STR_PAD_LEFT); ?>
                </span>
            </div>
            <div class="">
                <button type="button" class="recipe-slider__button recipe-slider__button--next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="#23195F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>

</section>
