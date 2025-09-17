<?php
$pre_title = get_sub_field('pre_title');
$title = get_sub_field('title');
$cards = get_sub_field('card');
$use_slider = count($cards) > 4;
?>

<?php if ($use_slider): ?>
  <link href="<?php echo get_template_directory_uri(); ?>/dist/section-cards-slider.css?v=<?php echo _S_VERSION; ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<?php endif; ?>

<section data-section="Cards" class="bg-beige-2 py-20">
  <div class="container grid gap-8 lg:gap-14">
    <div class="grid gap-3 lg:gap-4 lg:max-w-[31.25rem] mx-auto">
      <p class="text-sm tracking-tight font-medium text-center text-blue lg:text-lg lg:font-semibold" data-animation-fade-in>
        <?php echo $pre_title; ?>
      </p>
      <h2 class="text-blue text-center tracking-tight font-medium leading-snug text-[2rem] lg:text-[4rem] lg:leading-tight" data-animation-split-text>
        <?php echo $title; ?>
      </h2>
    </div>

    <?php if ($use_slider): ?>
      <div class="swiper cards-swiper w-full relative" data-animation-fade-in-stagger>
        <div class="swiper-wrapper">
          <?php foreach ($cards as $card):
            $image = $card['image'];
            $card_pre_title = $card['pre_title'];
            $card_title = $card['title'];
          ?>
            <div class="swiper-slide">
              <div class="bg-beige-3 overflow-hidden rounded-[2rem] p-6 grid gap-3 h-[380px] lg:h-[560px] max-w-[20rem] w-full m-0 mx-auto lg:max-w-none lg:flex-shrink-0 lg:p-14">
                <figure class="aspect-square overflow-hidden max-w-[12.5rem] mx-auto w-full lg:max-w-72">
                  <img class="w-full h-full object-contain object-center" src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
                </figure>
                <div class="text-center max-w-[12.5rem] mx-auto grid gap-3 lg:max-w-72">
                  <p class="text-xs text-blue tracking-tight font-medium lg:text-lg" data-animation-fade-in>
                    <?php echo $card_pre_title; ?>
                  </p>
                  <h2 class="text-blue text-2xl font-medium tracking-tight leading-snug lg:text-[2rem]" data-animation-split-text>
                    <?php echo $card_title; ?>
                  </h2>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Paginación -->
        <div class="swiper-pagination"></div>

        <!-- Navegación -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>

    <?php else: ?>
      <div class="grid gap-4 lg:flex lg:justify-center" data-animation-fade-in-stagger>
        <?php foreach ($cards as $card):
          $image = $card['image'];
          $card_pre_title = $card['pre_title'];
          $card_title = $card['title'];
        ?>
          <div data-animation-fade-in-stagger-item class="bg-beige-3 overflow-hidden rounded-[2rem] p-6 grid gap-3 max-w-[25rem] w-full mx-auto lg:max-w-none lg:flex-shrink lg:basis-1/3 lg:mx-0 lg:p-14">
            <figure class="aspect-square overflow-hidden max-w-[12.5rem] mx-auto w-full lg:max-w-72">
              <img class="w-full h-full object-contain object-center" src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
            </figure>
            <div class="text-center max-w-[12.5rem] mx-auto grid gap-3 lg:max-w-72">
              <p class="text-xs text-blue tracking-tight font-medium lg:text-lg" data-animation-fade-in>
                <?php echo $card_pre_title; ?>
              </p>
              <h2 class="text-blue text-2xl font-medium tracking-tight leading-snug lg:text-[2rem]" data-animation-split-text>
                <?php echo $card_title; ?>
              </h2>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
