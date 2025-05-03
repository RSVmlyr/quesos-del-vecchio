<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package quesos-del-vecchio
 */

get_header('dark');
?>

	<main id="primary" class="relative block grow">

		<section class="h-screen flex items-center justify-center">
			<header class="text-center">
				<h1 class="text-blue text-4xl tracking-tight font-semibold mb-4">
					No se encontró la página
				</h1>

				<a href="<?php echo home_url(); ?>" class="block mx-auto w-full text-blue bg-orange mt-4 rounded-[12.5rem] py-4 px-[1.125rem] text-sm font-medium tracking-tight text-center lg:max-w-fit lg:px-6">
					Volver al inicio
				</a>
			</header><!-- .page-header -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
