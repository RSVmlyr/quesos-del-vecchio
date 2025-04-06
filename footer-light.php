<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quesos-del-vecchio
 */

$isotype_logo = get_field('general_logos', 'options')["isotype"];
$footer_text = get_field('footer_text', 'options');
$background_image = get_field('background_image', 'options');

$social_media = get_field('general_social_media', 'options');
$facebook = $social_media['facebook'];
$instagram = $social_media['instagram'];
$youtube = $social_media['youtube'];

$additional_information = get_field('general_aditional', 'options');
$privacy_policy = $additional_information['privacy_policy'];
$terms_conditions = $additional_information['terms_and_conditions'];
$copyright = $additional_information['copyright'];
$author = $additional_information['author'];
?>

	<footer id="colophon" class="relative bg-beige-3 pb-6">
		<div class="container grid gap-6 sm:gap-[3.6875rem]">
			<div class="pt-[75vw] sm:pt-0 sm:h-[25rem] sm:flex sm:items-center lg:h-[42.875rem]">
				<div class="absolute top-0 inset-x-0 z-0 sm:w-6/12 sm:left-auto sm:right-0">
					<figure class="ml-auto w-[80vw] max-w-[29.375rem] sm:w-auto sm:h-[25rem] lg:h-[42.875rem] lg:max-w-[43.75rem]">
						<img class="w-full h-full object-contain object-right-top" src="<?php echo $background_image['url']; ?>" alt="<?php echo $background_image['alt']; ?>">
					</figure>
				</div>

				<div class="grid z-10 relative gap-6 sm:w-6/12 sm:max-w-[38.75rem] sm:mr-auto lg:gap-12">
					<figure class="block max-w-20 lg:max-w-[7.5rem]">
						<img src="<?php echo $isotype_logo['url']; ?>" alt="<?php echo $isotype_logo['alt']; ?>">
					</figure>

					<div>
						<p class="font-gazpacho text-[2rem] tracking-tight text-blue font-medium leading-snug lg:text-[3.5rem]">
							<?php echo $footer_text; ?>
						</p>
	
						<form class="mt-6 footer__form">
							<input type="email" placeholder="Suscríbete y recibe novedades" class="" />
							<button class="" type="submit" aria-label="Enviar">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5 12H19" stroke="#F5E6D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M12 5L19 12L12 19" stroke="#F5E6D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
						</form>
					</div>
				</div>
			</div>

			<div class="relative z-10">
				<div class="sm:flex sm:flex-row-reverse sm:items-center sm:justify-between sm:pb-8">
					<nav class="">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'container'       => 'ul',
									'menu_class'      => 'grid grid-cols-2 gap-6 font-gazpacho text-2xl font-medium text-blue tracking-tight sm:grid-cols-4 sm:justify-items-end lg:text-[2rem] lg:gap-20',
								)
							);
						?>
					</nav>
		
					<?php if ( ! empty( $facebook ) || ! empty( $instagram ) || ! empty( $youtube ) ) : ?>
						<div class="flex gap-8 items-center pb-6 pt-8 sm:py-0 sm:shrink">
							<?php if ( ! empty( $instagram ) ): ?>
								<a href="<?php echo $instagram; ?>" class="text-blue footer__social-media" aria-label="Instagram" target="_blank">
									<?php
										echo file_get_contents(get_template_directory() . '/public/icons/instagram.svg');
									?>
								</a>
							<?php endif; ?>
		
							<?php if ( ! empty( $facebook ) ): ?>
								<a href="<?php echo $facebook; ?>" class="text-blue footer__social-media" aria-label="Facebook" target="_blank">
									<?php
										echo file_get_contents(get_template_directory() . '/public/icons/facebook.svg');
									?>
								</a>
							<?php endif; ?>
		
							<?php if ( ! empty( $youtube ) ): ?>
								<a href="<?php echo $youtube; ?>" class="text-blue footer__social-media" aria-label="Youtube" target="_blank">
									<?php
										echo file_get_contents(get_template_directory() . '/public/icons/youtube.svg');
									?>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				
				<div class="pt-6 border-t border-blue/[0.12] text-xs grid gap-4 uppercase font-medium tracking-tight text-blue sm:pt-8 sm:grid-cols-2 md:flex lg:items-center lg:font-normal">
					<?php if ( ! empty( $copyright ) ): ?>
						<div class="rich-text footer__copyright">
							<?php echo $copyright; ?>
						</div>
					<?php endif; ?>

					<?php if ( isset( $terms_conditions[0] ) && !empty( $terms_conditions[0]->post_content ) ): 
						$terms_conditions_url = get_permalink( $terms_conditions[0]->ID );
					?>
						<a href="<?php echo $terms_conditions_url; ?>" class="max-w-fit" aria-label="Términos y condiciones">
							Términos y condiciones
						</a>
					<?php endif; ?>

					<?php if ( isset( $privacy_policy[0] ) && !empty( $privacy_policy[0]->post_content ) ): 
						$privacy_policy_url = get_permalink( $privacy_policy[0]->ID );
					?>
						<a href="<?php echo $privacy_policy_url; ?>" class="max-w-fit" aria-label="Política de privacidad">
							Política de privacidad
						</a>
					<?php endif; ?>
	
					<?php if ( ! empty( $author ) ): ?>
						<div class="rich-text md:ml-auto footer__author">
							<?php echo $author; ?>
						</div>
					<?php endif; ?>
				</div>	
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->


<div class="custom-cursor" data-custom-cursor aria-hidden="true">
	<span class="custom-cursor-label">
	</span>
</div>

<?php wp_footer(); ?>

</body>
</html>
