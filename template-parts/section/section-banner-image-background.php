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
            class="relative aspect-square bg-cover bg-center rounded-[3.5rem] overflow-hidden lg:aspect-video"
            style="background-image: url(<?php echo esc_url($image["sizes"]["2048x2048"]); ?>)"
        >
            <div class="absolute left-6 bottom-6 bg-beige-3 max-w-[34.25rem] p-10 rounded-[3rem]">
                <div class="text-blue grid gap-6 ">
                    <p class="text-lg tracking-tight font-medium">
                        <?php echo $pre_title; ?>
                    </p>
    
                    <h2 class="text-5xl tracking-tight font-medium leading-tight text-blue">
                        <?php echo $title; ?>
                    </h2>
                </div>

                <a 
                    class="block mt-12 bg-blue text-beige-3 py-6 px-3 text-center rounded-full"
                    href="<?php echo $link["url"]; ?>" 
                    target="<?php echo $link["target"]; ?>"
                >
                    <?php echo $link["title"]; ?>
                </a>

            </div>
        </div>
    </div>
</section>
