<?php
/**
 * Template part for displaying recipe posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package quesos-del-vecchio
 */
$recipe_slider = get_field('recipe_slider');
$date = date_i18n('j \D\E F', strtotime(get_the_date()));
$year = date_i18n('Y', strtotime(get_the_date()));
$recipe_slider = get_field('recipe_slider');
$ingredients = get_field('ingredients');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
        get_template_part('template-parts/section/section-article-hero', null, array(
            'eyebrow' => 'RECETA',
            'article_thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full'), 
            'article_title' => get_the_title(),
			'article_created_at' => $date,
			'article_year' => $year,
            'theme' => 'blue',
        )); 
    ?>

    <div class="container container--recipe relative pt-6 lg:pt-12 lg:grid lg:grid-cols-[1fr_30rem] lg:gap-12 lg:items-start">

        <sidebar class="block bg-light-blue text-blue py-6 px-4 grid gap-8 rounded-3xl mt-6 mb-12 lg:order-2 lg:m-0 lg:py-12 lg:px-8 lg:gap-12 lg:sticky lg:top-20 lg:mb-12">
            <h2 class="text-2xl tracking-tight font-medium text-center lg:text-[2rem]" data-animation-split-text>
                Ingredientes
            </h2>

            <div class="grid gap-9" data-animation-fade-in-stagger>
                <?php foreach( $ingredients as $ingredient ): ?>
                    <p data-animation-fade-in-stagger-item class="text-sm text-blue tracking-tight font-medium grid gap-4 grid-cols-[auto_1fr] lg:text-lg lg:leading-tight lg:items-center">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.66602 15.9998C2.66602 9.71444 2.66602 6.57175 4.61864 4.61913C6.57126 2.6665 9.71396 2.6665 15.9993 2.6665C22.2847 2.6665 25.4274 2.6665 27.3801 4.61913C29.3327 6.57175 29.3327 9.71444 29.3327 15.9998C29.3327 22.2852 29.3327 25.4279 27.3801 27.3805C25.4274 29.3332 22.2847 29.3332 15.9993 29.3332C9.71396 29.3332 6.57126 29.3332 4.61864 27.3805C2.66602 25.4279 2.66602 22.2852 2.66602 15.9998Z" stroke="#23195F" stroke-width="1.5"/>
                            <path d="M11.4727 17.3095L14.4846 19.579L20.1585 12.0494" stroke="#23195F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <?php echo $ingredient['ingredient']; ?>
                    </p>
                <?php endforeach; ?>
            </div>
        </sidebar>

        <div class="lg:order-1">
            <?php if ( have_rows("layout") ) : ?>
                <?php while ( have_rows("layout") ) : the_row(); ?>
        
                    <?php get_template_part( 'template-parts/content', 'acf'); ?>		
        
                <?php endwhile; // End of the loop. ?>
            <?php endif; ?>
        </div>
    </div>

	<?php if ( $recipe_slider["show_slider"] == "true" ) : ?>
		<?php get_template_part('template-parts/section/section-recipe-slider', null, array(
			'pre_title' => $recipe_slider["pre_title"],
			'title' => $recipe_slider["title"],
			'recipes' => $recipe_slider["recipes"],
			'background_color' => "bg-beige-3",
		)); ?>
	<?php endif; ?>
	

</article><!-- #post-<?php the_ID(); ?> -->
