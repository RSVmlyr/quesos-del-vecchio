
<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$image = get_sub_field('image');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-image-text.css" rel="stylesheet" type="text/css" media="all">

<section class="py-6 lg:py-12">
    <div class="container container__small"> 
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] lg:gap-9">
            <div class="lg:self-center lg:grid lg:gap-12">
                <h2 class="text-blue text-2xl font-medium tracking-tight leading-snug lg:text-5xl lg:leading-[1.2]">
                    <?php echo $title; ?>
                </h2>
    
                <p class="hidden text-lg font-medium tracking-tight leading-normal text-blue lg:block">
                    <?php echo $description; ?>
                </p>
            </div>

            <div>
                <figure 
                    class="image-text__image"
                    style="--mask-url: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-2.svg);"
                >
                    <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                </figure>

                <p class="block text-base font-medium tracking-tight leading-normal text-blue lg:hidden">
                    <?php echo $description; ?>
                </p>
            </div>
        </div>
    </div>
</section>
