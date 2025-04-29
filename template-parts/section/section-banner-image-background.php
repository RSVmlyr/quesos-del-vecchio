<?php
    $pre_title = get_sub_field('pre_title');
    $title = get_sub_field('title');
    $image = get_sub_field('image');
    $link = get_sub_field('link');
?>

<section 
    class="custom-template-<?php echo get_row_layout(); ?> bg-beige-3 py-7"
>
    <div class="container">
        <div
            class="relative aspect-[.8] bg-cover bg-center rounded-3xl overflow-hidden lg:bg-fixed lg:aspect-video lg:rounded-[3.5rem]"
            style="background-image: url(<?php echo esc_url($image["sizes"]["2048x2048"]); ?>)"
        >
            <div 
                data-animation-fade-in
                data-animation-threshold="0"
                class="absolute left-3 bottom-3 right-3 bg-beige-3 max-w-[34.25rem] rounded-2xl p-4 lg:left-6 lg:right-auto lg:bottom-6 lg:p-10 lg:rounded-[3rem]"
            >
                <div class="text-blue grid gap-3 lg:gap-6">
                    <p class="text-xs tracking-tight font-medium lg:text-lg" data-animation-fade-in>
                        <?php echo $pre_title; ?>
                    </p>
    
                    <h2 data-animation-split-text class="text-2xl tracking-tight font-medium leading-tight text-blue lg:text-5xl">
                        <?php echo $title; ?>
                    </h2>
                </div>

                <a 
                    class="block mt-3 bg-blue text-beige-3 py-[0.875rem] px-3 text-center rounded-full lg:mt-12 lg:py-6"
                    href="<?php echo $link["url"]; ?>" 
                    target="<?php echo $link["target"]; ?>"
                    data-animation-scale
                >
                    <?php echo $link["title"]; ?>
                </a>

            </div>
        </div>
    </div>
</section>
