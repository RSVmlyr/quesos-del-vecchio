<?php
$pre_title = get_sub_field('pre_title');
$title = get_sub_field('title');
$cards = get_sub_field('card');
?>

<section 
    class="bg-beige-2 py-20"
>
    <div class="container grid gap-8 lg:gap-14"> 
        <div class="grid gap-3 lg:gap-4 lg:max-w-[31.25rem] mx-auto">
            <p class="text-sm tracking-tight font-medium text-center text-blue lg:text-lg lg:font-semibold" data-animation-fade-in>
                <?php echo $pre_title; ?>
            </p>
            
            <h2 class="text-blue text-center tracking-tight font-medium leading-snug text-[2rem] lg:text-[4rem] lg:leading-tight" data-animation-split-text>
                <?php echo $title; ?>
            </h2>
        </div>

        <div class="grid gap-4 lg:flex lg:justify-center" data-animation-fade-in-stagger>
            <?php foreach ($cards as $card) : 
                $image = $card['image'];
                $pre_title = $card['pre_title'];
                $title = $card['title'];
            ?>
                <div data-animation-fade-in-stagger-item class="bg-beige-3 overflow-hidden rounded-[2rem] p-6 grid gap-3 max-w-[25rem] w-full mx-auto lg:max-w-none lg:flex-shrink lg:basis-1/3 lg:mx-0 lg:p-14">
                    <figure class="aspect-square overflow-hidden max-w-[12.5rem] mx-auto w-full lg:max-w-72">
                        <img class="w-full h-full object-contain object-center" src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
                    </figure>

                    <div class="text-center max-w-[12.5rem] mx-auto grid gap-3 lg:max-w-72">
                        <p class="text-xs text-blue tracking-tight font-medium lg:text-lg" data-animation-fade-in>
                            <?php echo $pre_title; ?>
                        </p>

                        <h2 class="text-blue text-2xl font-medium tracking-tight leading-snug lg:text-[2rem]" data-animation-split-text>
                            <?php echo $title; ?>
                        </h2>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
