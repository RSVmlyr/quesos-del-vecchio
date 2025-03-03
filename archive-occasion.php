<?php
/**
 * The template for displaying Occasions archive
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-medium mb-8">
            <?php 
                echo 'Nuestras Ocasiones';
            ?>
        </h1>

        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('occasion-card bg-white shadow-lg rounded-lg overflow-hidden'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="aspect-w-16 aspect-h-9">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <h2 class="text-2xl font-medium mb-4">
                                <a href="<?php the_permalink(); ?>" class="hover:text-blue">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <?php
                            $date = get_field('occasion_date');
                            $location = get_field('occasion_location');
                            ?>

                            <?php if ($date) : ?>
                                <div class="mb-2">
                                    <span class="font-medium">Fecha:</span> <?php echo esc_html($date); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($location) : ?>
                                <div class="mb-4">
                                    <span class="font-medium">Ubicación:</span> <?php echo esc_html($location); ?>
                                </div>
                            <?php endif; ?>

                            <div class="mt-4">
                                <a href="<?php the_permalink(); ?>" class="inline-block bg-blue text-white px-6 py-2 rounded-lg hover:bg-opacity-90">
                                    Ver más
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('Anterior', 'your-theme-text-domain'),
                'next_text' => __('Siguiente', 'your-theme-text-domain'),
                'class' => 'mt-8'
            ));
            ?>

        <?php else : ?>
            <p class="text-xl">No hay ocasiones publicadas.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?> 
