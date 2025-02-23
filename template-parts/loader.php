<?php
// Loader
$logo = get_field('config_loader_isotype', 'options');
$phrases = get_field('config_loader_phrases', 'options');

// Random phrase
$random = array_rand($phrases, 1);
$random_phrase = $phrases[$random];
?>

<!-- Loader -->
<div data-loader class="loader_component fixed inset-0 z-[100] text-white bg-blue flex justify-center items-center">
    <div class="grid gap-14 w-full max-w-80 justify-center items-center grid-cols-1 text-center lg:max-w-[22.875rem]">
        <figure class="w-full max-w-[7.5rem] mx-auto lg:max-w-[8.75rem]">
            <img 
                src="<?php echo esc_url( $logo['sizes']["thumbnail"] ); ?>" 
                alt="<?php echo esc_attr( $logo['alt'] ); ?>" 
                width="<?php echo esc_attr( $logo['width'] ); ?>" 
                height="<?php echo esc_attr( $logo['height'] ); ?>"
            />
        </figure>

        <div class="relative">
            <div data-loader-phrase class="opacity-0 translate-y-3 absolute top-0 left-0 right-0 text-base font-semibold lg:text-lg lg:font-medium loader_component__rich_text">
                <?php echo $random_phrase['phrase']; ?>
            </div>

            <div data-loader-percentage class="font-bold text-base lg:text-[2rem] lg:font-medium">
                0%
            </div>
        </div>
    </div>
</div>
