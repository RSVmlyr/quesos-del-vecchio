<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package quesos-del-vecchio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
        get_template_part('template-parts/section/section-article-hero', null, array(
            'article_thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full'), 
            'article_title' => get_the_title(),
			'article_created_at' => date_i18n('j \D\E F Y', strtotime(get_the_date())),
        )); 
    ?>

    <?php if ( have_rows("layout") ) : ?>
        <?php while ( have_rows("layout") ) : the_row(); ?>

            <?php get_template_part( 'template-parts/content', 'acf'); ?>		

        <?php endwhile; // End of the loop. ?>
    <?php endif; ?>

	<section>
		La fecha otra vez
	</section>
</article><!-- #post-<?php the_ID(); ?> -->
