<?php
$image = get_sub_field('image');
$eyebrow = get_sub_field('eyebrow');
$text = get_sub_field('text');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-animate-text.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 py-8 lg:pt-12 lg:pb-40"
    data-section="AnimateText"
>
    <div class="container grid gap-12 lg:grid-cols-[auto_1fr] lg:gap-[5.5rem]"> 
        <div>
            <figure class="max-w-20 lg:max-w-[8.75rem]">
                <img src="<?php echo $image["sizes"]["medium_large"]; ?>" alt="<?php echo $image["alt"]; ?>">
            </figure>
        </div>

        <div class="lg:pt-28">
            <p class="text-blue tracking-tight font-medium mb-2 lg:text-lg lg:font-semibold lg:mb-6">
                <?php echo $eyebrow; ?>
            </p>

            <p class="text-blue tracking-tight font-medium leading-snug font-gazpacho text-[2rem] lg:text-[4rem] lg:leading-tight animate-text__paragraph">
                <?php echo $text; ?>
            </p>

        </div>
    </div>
</section>
