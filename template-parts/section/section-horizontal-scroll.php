<?php
$main_screen = get_sub_field('main_screen');
$sections = get_sub_field('sections');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-horizontal-scroll.css" rel="stylesheet" type="text/css" media="all">


<section 
    class="overflow-hidden bg-blue bg-cover bg-repeat bg-center"
    data-section="HorizontalScroll"
    style="background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/patter-horizontal.svg);"
>
    <div class="relative min-h-screen h-svh horizontal-scroll__wrapper-container">
        <div 
            class="flex h-full gap-4 lg:gap-28 horizontal-scroll__wrapper"
            data-section-count="<?php echo count($sections); ?>"
        >
          <div 
            class="relative h-full shrink-0 py-20 horizontal-scroll__section"
          >
            <div class="h-full grid grid-rows-[auto_1fr] gap-6 lg:gap-14">
                <div class="container grid gap-4 lg:gap-7">
                    <p class="text-light-blue text-sm lg:text-2xl tracking-tight font-semibold" data-animation-fade-in>
                        <?php echo $main_screen['eyebrow']; ?>
                    </p>
    
                    <h2 class="text-white font-medium tracking-tight text-5xl lg:text-8xl" data-animation-split-text>
                        <?php echo $main_screen['title']; ?>
                    </h2>
                </div>
    
    
                <?php if ( $main_screen['is_shaped'] === 'true' ) : ?>
                    <div 
                        class="horizontal-scroll__main-asset"
                        style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-3-reflected.svg);"
                    >
                        <div class="horizontal-scroll__asset-mask" data-animation-scale data-animation-threshold="0.15">
                            <?php if ( $main_screen['asset']['type'] === 'image' ) : ?>
                                <img src="<?php echo $main_screen['asset']['sizes']['large']; ?>" alt="<?php echo $main_screen['asset']['alt']; ?>">
                            <?php endif; ?>
                
                            <?php if ( $main_screen['asset']['type'] === 'video' ) : ?>
                                <video src="<?php echo $main_screen['asset']['url']; ?>" autoplay muted loop playsinline></video>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
    
                <?php if ( $main_screen['is_shaped'] === 'false' ) : ?>
                    <div class="horizontal-scroll__main-asset--no-shape self-end">
                        <div class="horizontal-scroll__asset--no-shape" data-animation-scale data-animation-threshold="0.15">
                            <?php if ( $main_screen['asset']['type'] === 'image' ) : ?>
                                <img src="<?php echo $main_screen['asset']['sizes']['large']; ?>" alt="<?php echo $main_screen['asset']['alt']; ?>">
                            <?php endif; ?>
                    
                            <?php if ( $main_screen['asset']['type'] === 'video' ) : ?>
                                <video src="<?php echo $main_screen['asset']['url']; ?>" autoplay muted loop playsinline></video>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    
          <?php foreach ($sections as $index => $section) : 
            $pre_image = $section['pre_image'];
            $asset = $section['asset'];
            $post_image = $section['post_image'];
        ?>
            <div 
                class="relative h-full shrink-0 horizontal-scroll__section"
            >
                <div class="h-full flex gap-8 lg:gap-14">
                    <div class="max-w-[13.43rem] lg:max-w-80 py-20 horizontal-scroll__section-title">
                        <span data-animation-fade-in data-animation-threshold="0.15" class="text-[5rem] lg:text-[12.5rem] text-white font-medium tracking-tight font-gazpacho leading-none">
                            <?php echo $pre_image["pre_title"]; ?>
                        </span>
    
                        <h2 class="text-[2rem] lg:text-5xl text-light-blue tracking-tight leading-tight" data-animation-split-text data-animation-threshold="0.15">
                            <?php echo $pre_image["title"]; ?>
                        </h2>
                    </div>
    
                    <div 
                        class="horizontal-scroll__asset"
                        style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/<?php echo ($index % 2 === 0) ? 'shape-2.svg' : 'shape-3-reflected.svg'; ?>);"
                    >
                        <div class="horizontal-scroll__asset-mask" data-animation-scale data-animation-threshold="0.15">
                            <?php if ( $asset['type'] === 'image' ) : ?>
                                <img src="<?php echo $asset['sizes']['large']; ?>" alt="<?php echo $asset['alt']; ?>">
                            <?php endif; ?>
        
                            <?php if ( $asset['type'] === 'video' ) : ?>
                                <video src="<?php echo $asset['url']; ?>" autoplay muted loop playsinline></video>
                            <?php endif; ?>
                        </div>
                    </div>
    
                    <div class="w-full max-w-[40rem] mt-14 py-20 horizontal-scroll__section-content">
                        <p data-animation-fade-in data-animation-threshold="0.15" class="text-beige lg:text-lg tracking-tight font-semibold">
                            <?php echo $post_image["eyebrow"]; ?>
                        </p>
        
        
                        <p class="text-white text-2xl lg:text-[2rem] tracking-tight leading-snug font-gazpacho font-medium" data-animation-split-text data-animation-threshold="0.15">
                            <?php echo $post_image["description"]; ?>
                        </p>
                    </div>
                </div>
            </div>
          <?php endforeach; ?>
        </div>
    </div>

</section>
