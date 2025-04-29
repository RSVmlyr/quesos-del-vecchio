<?php
$background_image = get_sub_field('background_image');
$title = get_sub_field('title');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-hero.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 flex items-center justify-center hero"
    style="background-image: url(<?php echo $background_image["sizes"]["2048x2048"]; ?>);"
>
    <div class="container"> 
        <h1 data-animation-split-text class="text-white text-[2rem] tracking-tight font-medium leading-snug text-center lg:text-[4rem] lg:leading-tight lg:max-w-[43rem] lg:mx-auto">
            <?php echo $title; ?>
        </h1>
    </div>
</section>
