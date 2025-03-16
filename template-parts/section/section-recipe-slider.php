<?php
    $pre_title = get_sub_field('pre_title');
    $title = get_sub_field('title');
    $recipes = get_sub_field('recipes');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-recipe-slider.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="RecipeSlider"
    class="custom-template-<?php echo get_row_layout(); ?> bg-beige-3 pt-20"
>
    <div class="container text-center">
        <p class="font-semibold text-lg tracking-tight text-blue">
            <?php echo $pre_title; ?>
        </p>

        <h2 class="text-[4rem] tracking-tight font-medium text-blue">
            <?php echo $title; ?>
        </h2>
    </div>

    <div class="mt-[7.5rem]">
        <div class="swiper recipe-slider__swiper">
            <div class="swiper-wrapper">
                <?php foreach( $recipes as $post ): 
                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post); 
                    $product = get_field( "product", $post->ID )[0];
                    $preparation_time = get_field( "preparation_time", $post->ID );
                    $shortname = get_field( "shortname", $product->ID );
                ?>
                    <div class="swiper-slide">
                        <a href="<?php the_permalink(); ?>" class="block mt-4" aria-label="<?php the_title(); ?>">
                            <h2 class="text-2xl tracking-tight font-medium text-center text-blue leading-tight">
                                <?php the_title(); ?>
                            </h2>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <figure class="block max-w-[20.5rem] aspect-square mt-4">
                                    <?php the_post_thumbnail('large', ['class' => 'block w-full h-full object-center']); ?>
                                </figure>
                            <?php endif; ?>
                        
                            <div class="flex bg-white text-blue items-center max-w-fit mx-auto overflow-hidden rounded-[6.25rem] -mt-6 relative z-10">
                                <p class="bg-blue text-white font-gazpacho text-lg tracking-tight font-medium py-4 px-6">
                                    <?php echo $shortname;  ?>
                                </p>
                    
                                <p class="font-gazpacho text-lg tracking-tight font-medium px-6">
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

</section>
