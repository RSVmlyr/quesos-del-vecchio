<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quesos-del-vecchio
 */


$main_logo = get_field('general_logos', 'options')["main_logo"];
$main_logo_dark = get_field('general_logos', 'options')["main_logo_dark"];

$social_media = get_field('general_social_media', 'options');
$facebook = $social_media['facebook'];
$instagram = $social_media['instagram'];
$youtube = $social_media['youtube'];

$additional_information = get_field('general_aditional', 'options');
$privacy_policy = $additional_information['privacy_policy'];
$terms_conditions = $additional_information['terms_and_conditions'];
$copyright = $additional_information['copyright'];
$author = $additional_information['author'];

$google_maps = get_field('google_maps', 'options');
$google_maps_key = $google_maps["key"];
$google_maps_id_map = $google_maps['map_id'];
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<script type="text/javascript">
		// This will set the path into the global JavaScript scope so it can be picked up further down the path of execution.
		window.__webpack_public_path__ = "<?php echo get_template_directory_uri(); ?>/";
		window.googleMapsApiKey = "<?php echo $google_maps_key; ?>";
		window.googleMapsIdMap = "<?php echo $google_maps_id_map; ?>";
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class("relative bg-custom-grey text-custom-black_light font-figtree font-normal antialiased disabled app-loading"); ?>>
<?php wp_body_open(); ?>
<?php include_once('template-parts/loader.php'); ?>
<div id="page" class="flex flex-col">
	<a class="skip-link screen-reader-text" href="#primary">Saltar al contenido</a>

	<header id="main-header" class="fixed top-0 inset-x-0 z-50 header header--light">
		<div class="container">
			<div class="py-4 flex justify-between items-center lg:py-12 lg:pb-0 header_container">
				<div class="">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="block max-w-44 lg:max-w-48 header_logo" aria-label="Ir al inicio">
						<img src="<?php echo $main_logo['url']; ?>" class="" alt="<?php bloginfo( 'name' ); ?>" width="192" height="56" />
					</a>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="block max-w-44 lg:max-w-48 header_logo-dark" aria-label="Ir al inicio">
						<img src="<?php echo $main_logo_dark['url']; ?>" class="" alt="<?php bloginfo( 'name' ); ?>" width="192" height="56" />
					</a>

					<div class="hidden text-beige-3 text-[2rem] tracking-tight font-medium leading-none header_menu_label">
						Menú
					</div>
				</div>
	
				<div class="overflow-hidden rounded-[12.5rem] lg:flex lg:items-center lg:relative">
					<nav class="hidden rounded-[12.5rem] items-center px-8 py-3 -mr-1 lg:flex header_navigation_desktop">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'container'       => 'ul',
									'menu_class'      => 'grid gap-12 grid-flow-col font-semibold text-lg text-blue',
								)
							);
						?>
					</nav>

					<button class="text-blue flex items-center !leading-none lg:text-lg header_button" type="button" aria-label="Menu" aria-controls="navigation" aria-expanded="false">
						<div class="rounded-[12.5rem] py-3 font-semibold px-6 -mr-1 lg:py-4 header_button_label">
							<span>
								Menú
							</span>
						</div>
	
						<div class="rounded-full py-2 px-2 relative z-0 lg:py-3 lg:px-3 header_button_svg">
							<?php
								echo file_get_contents(get_template_directory() . '/public/icons/plus.svg');
							?>
						</div>
					</button>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div 
		class="fixed inset-0 bg-blue z-40 pt-24 text-beige-3 pb-8 overflow-scroll header_navigation_mobile lg:hidden"
		style="background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/menu_circle.svg);"
	>
		<div class="container flex flex-col">
			<nav class="grow flex justify-center items-center">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container'       => 'ul',
							'menu_class'      => 'text-center text-[2rem] leading-0 font-semibold grid gap-8',
						)
					);
				?>
			</nav>

			<div class="pt-8 lg:hidden">
				<?php if ( ! empty( $facebook ) || ! empty( $instagram ) || ! empty( $youtube ) ) : ?>
					<div class="flex gap-8 justify-center items-center pb-6">
						<?php if ( ! empty( $instagram ) ): ?>
							<a href="<?php echo $instagram; ?>" class="text-beige-3" aria-label="Instagram" target="_blank">
								<?php
									echo file_get_contents(get_template_directory() . '/public/icons/instagram.svg');
								?>
							</a>
						<?php endif; ?>

						<?php if ( ! empty( $facebook ) ): ?>
							<a href="<?php echo $facebook; ?>" class="text-beige-3" aria-label="Facebook" target="_blank">
								<?php
									echo file_get_contents(get_template_directory() . '/public/icons/facebook.svg');
								?>
							</a>
						<?php endif; ?>
	
						<?php if ( ! empty( $youtube ) ): ?>
							<a href="<?php echo $youtube; ?>" class="text-beige-3" aria-label="Youtube" target="_blank">
								<?php
									echo file_get_contents(get_template_directory() . '/public/icons/youtube.svg');
								?>
							</a>
						<?php endif; ?>
	
					</div>
				<?php endif; ?>
	
				<div class="pt-6 border-t border-beige-3/[.1] border-solid text-xs text-center grid gap-4 uppercase header_footer">
					<?php if ( ! empty( $copyright ) ): ?>
						<div class="rich-text">
							<?php echo $copyright; ?>
						</div>
					<?php endif; ?>
						
					<div class="grid gap-8 grid-cols-2 max-w-fit justify-self-center">
						<?php if ( isset( $privacy_policy[0] ) && !empty( $privacy_policy[0]->post_content ) ): 
							$privacy_policy_url = get_permalink( $privacy_policy[0]->ID );
						?>
							<a href="<?php echo $privacy_policy_url; ?>" class="max-w-fit" aria-label="Política de privacidad">
								Política de privacidad
							</a>
						<?php endif; ?>
		
						<?php if ( isset( $terms_conditions[0] ) && !empty( $terms_conditions[0]->post_content ) ): 
							$terms_conditions_url = get_permalink( $terms_conditions[0]->ID );
						?>
							<a href="<?php echo $terms_conditions_url; ?>" class="max-w-fit" aria-label="Términos y condiciones">
								Términos y condiciones
							</a>
						<?php endif; ?>
					</div>
							
	
					<?php if ( ! empty( $author ) ): ?>
						<div class="rich-text">
							<?php echo $author; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
