<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package quesos-del-vecchio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( have_rows("layout") ) : ?>
        <?php while ( have_rows("layout") ) : the_row(); ?>

            <?php get_template_part( 'template-parts/content', 'acf'); ?>		

        <?php endwhile; // End of the loop. ?>
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
