<?php
$title = get_sub_field('title');
$logos = get_sub_field('logos');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-logos.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 pb-12 logos lg:py-20"
>
    <div class="container"> 
        <div class="bg-light-blue rounded-3xl p-12 lg:py-16" data-animation-fade-in>
            <div class="max-w-60 mx-auto lg:max-w-none lg:grid lg:grid-cols-[18rem,1fr] lg:gap-14 lg:items-center">
                <h2 data-animation-split-text class="text-blue text-center text-2xl tracking-tight font-medium leading-snug mb-8 lg:text-[2rem] lg:mb-0 lg:text-left">
                    <?php echo $title; ?>
                </h2>
    
                <div class="flex flex-col gap-6 lg:flex-row lg:justify-center lg:gap-4">
                    <?php foreach ($logos as $logo) : 
                        $logo_image = $logo['logo'];
                        $link = $logo['link'];
                    ?>
                        <a data-animation-scale href="<?php echo $link; ?>" target="_blank" aria-label="<?php echo $logo_image['alt']; ?>" class="bg-white rounded-[100%] p-2 flex justify-center items-center lg:basis-1/4 lg:py-3">
                            <figure class="w-20 aspect-square">
                                <img src="<?php echo $logo_image["url"]; ?>" alt="<?php echo $logo_image['alt']; ?>" class="w-full h-full object-contain">
                            </figure>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
