<?php
    $title = get_sub_field('title');
    $sections = get_sub_field('sections');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-scroll-sections.css" rel="stylesheet" type="text/css" media="all">

<section 
    class="scroll-sections bg-beige-3 py-7"
    data-section="ScrollSections"
>
    <div class="scroll-sections__pin">
        <div class="container">
            <div class="title-container">
                <h2 class="title-animation">
                    <?php echo $title; ?>
                </h2>
            </div>
    
            <div class="sections-container">
                <?php 
                $counter = 1;
                foreach ($sections as $section) : 
                    $image = $section['image'];
                    $description = $section['description'];
                    
                    // Format number with leading zero if needed
                    $section_number = sprintf("%02d", $counter);
                ?>
                    <div class="scroll-section">
                        <div class="image-container">
                            <figure class="block aspect-[1.35] overflow-hidden">    
                                <img class="w-full h-full object-cover" src="<?php echo $image['sizes']['2048x2048']; ?>" alt="<?php echo $image['alt']; ?>">
                            </figure>
                        </div>
    
                        <div class="text-container">
                            <!-- Section number -->
                            <div class="section-number"><?php echo $section_number; ?></div>
                            
                            <div class="text-blue grid gap-6">
                                <p class="text-lg tracking-tight font-medium">
                                    <?php echo $description; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php 
                    $counter++;
                endforeach; 
                ?>
            </div>
        </div>
    </div>
</section>
