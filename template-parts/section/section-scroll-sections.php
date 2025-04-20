<?php
    $title = get_sub_field('title');
    $sections = get_sub_field('sections');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-scroll-sections.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="scroll-sections bg-beige-3"
    data-section="ScrollSections"
>
    <div class="relative scroll-sections__container">
        <div class="h-screen flex items-center justify-center container scroll-sections__title-container">
            <div class="scroll-sections__title">
                <h2 class="text-[4rem] tracking-tight text-blue font-medium leading-none lg:text-[7.5rem] lg:leading-none">
                    <?php echo $title; ?>
                </h2>
            </div>
        </div>

        <div class="h-screen absolute top-0 inset-x-0 w-full scroll-sections__content">
            <div class="container absolute bottom-20 inset-x-0 flex flex-col justify-end lg:flex-row lg:justify-center lg:items-end lg:gap-12 scroll-sections__content-container">
                <div class="relative scroll-sections__content-images lg:basis-1/2">
                    <?php 
                        $counter = 1;
                        foreach ($sections as $section) : 
                            $image = $section['image'];
                    ?>
                        <figure class="absolute bottom-0 left-0 right-0 mx-auto block aspect-[0.85] overflow-hidden rounded-2xl max-w-56 lg:max-w-[30rem] scroll-sections__content-image">    
                            <img class="w-full h-full object-cover" src="<?php echo $image['sizes']['2048x2048']; ?>" alt="<?php echo $image['alt']; ?>">
                        </figure>
                    <?php 
                        endforeach; 
                    ?>
                </div>

                <div class="relative lg:basis-1/2 scroll-sections__content-texts">
                    <?php 
                        $counter = 1;
                        foreach ($sections as $section) : 
                            $description = $section['description'];
                            // Format number with leading zero if needed
                            $section_number = sprintf("%02d", $counter);
                    ?>
                        <div class="absolute bottom-0 left-0 max-w-[37.5rem] scroll-sections__content-text">
                            <!-- Section number -->
                            <div class="text-5xl font-gazpacho text-light-blue font-medium tracking-tight leading-none lg:text-[4rem]"><?php echo $section_number; ?></div>
                            
                            <p class="font-gazpacho text-2xl font-medium tracking-tight leading-tight text-blue lg:text-5xl">
                                <?php echo $description; ?>
                            </p>
                        </div>
                    <?php 
                        $counter++;
                        endforeach; 
                    ?>
                </div>
            </div>
        </div>


        <div class="">
            <?php foreach ($sections as $section) : ?>
                <div class="h-screen scroll-sections__trigger">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
