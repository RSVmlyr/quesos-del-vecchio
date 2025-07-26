<?php
$sections = get_sub_field('item');
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-provoke.css?v=<?php echo _S_VERSION; ?>" rel="stylesheet" type="text/css" media="all">

<section 
    class="bg-beige-3 provoke"
    data-section="Provoke"
>
    <div class="provoke__wrapper"> 

        <?php foreach ($sections as $section) : 
            $type = $section["type"];
        ?>

                <?php if ( $type === 'social_media' ) : 
                    $social_media = $section["social_media"];
                    $image = $social_media["image"];
                    $icon = $social_media["icon"];
                    $link = $social_media["link"];
                ?>
                    <div class="provoke__section provoke__section--social-media">
                        <div 
                            class="w-full aspect-square overflow-hidden rounded-[3rem] provoke__item-social-media" 
                            data-animation-scale
                            data-animation-threshold="0"
                        >
                            <a class="relative block w-full h-full" href="<?php echo $link["url"]; ?>" target="<?php echo $link["target"]; ?>">
                                <figure class="absolute inset-0">
                                    <img class="w-full h-full object-cover" src="<?php echo $image["sizes"]["medium_large"]; ?>" alt="<?php echo $image["alt"]; ?>">
                                </figure>

                                <div class="absolute bottom-8 left-8 bg-white rounded-full flex gap-2 text-blue items-center py-3 px-6">

                                    <?php if ( $icon === 'instagram' ) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="" viewBox="0 0 16 16">
                                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                        </svg>
                                    <?php endif; ?>

                                    <?php if ( $icon === 'facebook' ) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="" viewBox="0 0 16 16">
                                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                        </svg>
                                    <?php endif; ?>

                                    <?php if ( $icon === 'youtube' ) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                            <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                                        </svg>
                                    <?php endif; ?>

                                    <?php if ( $icon === 'tiktok' ) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="" viewBox="0 0 16 16">
                                            <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                                        </svg>
                                    <?php endif; ?>

                                    <span class="tracking-tight text-lg font-medium leading-none">  
                                        <?php echo $link["title"]; ?>
                                    </span>
                                </div> 
                            </a>
                        </div>
                    </div>
                <?php endif; ?>


                <?php if ( $type === 'product' ) : 
                    $product = $section["product"];
                    $product_selected = $product["product_selected"][0];
                    $title = $product_selected->post_title;
                    $image = $product["image"];
                ?>
                    <div class="provoke__section provoke__section--product">
                        <div class="provoke__item-product">
                            <h2 
                                data-animation-split-text 
                                data-animation-threshold="0"
                                class="text-[2.5rem] tracking-tight font-medium leading-none text-blue text-center mb-4 lg:text-5xl lg:mb-6"
                            >
                                <?php echo $title; ?>
                            </h2>

                            <a 
                                data-animation-scale
                                data-animation-threshold="0"
                                href="<?php the_permalink( $product_selected->ID ); ?>" class="relative flex items-center justify-center aspect-[1.4]"
                            >
                                <figure 
                                    class="absolute inset-0 provoke__item-product-image"
                                    style="--mask-image: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-<?php echo $product_selected->ID % 2 === 0 ? '2' : '3'; ?>.svg);"
                                >
                                    <img src="<?php echo $image["sizes"]["medium_large"]; ?>" alt="<?php echo $image["alt"]; ?>" class="w-full h-full object-cover">
                                </figure>

                                <div class="relative z-10 text-base tracking-tight font-medium leading-none text-blue bg-white rounded-[100%] py-7 px-12 mt-5 lg:text-2xl lg:px-14 lg:mt-24 hover:bg-blue hover:text-white transition-all duration-300">
                                    Ver más
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $type === 'article' ) : 
                    $article = $section["article"];
                    $article_selected = $article["article_selected"][0];
                    $title = $article_selected->post_title;
                ?>
                    <div class="provoke__section provoke__section--article">
                        <div 
                            class="provoke__item-article" 
                        >
                            <a 
                                href="<?php the_permalink( $article_selected->ID ); ?>" 
                                class="grid bg-beige-2 bg-cover bg-center py-8 px-7 text-center overflow-hidden rounded-[3rem] gap-7 lg:py-11 lg:px-14"
                                style="background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/banner-article.svg);"
                            >
                                <h2 
                                    data-animation-split-text
                                    data-animation-threshold="0"
                                    class="text-2xl tracking-tight font-medium leading-snug text-blue lg:text-[2rem] lg:leading-tight"
                                >
                                    <?php echo $title; ?>
                                </h2>

                                <div 
                                    data-animation-scale
                                    data-animation-threshold="0"
                                    class="text-lg tracking-tight font-medium text-blue flex items-center justify-center gap-3 rounded-full border border-blue py-3 pl-6 pr-4 max-w-fit mx-auto"
                                >
                                    LEER ARTÍCULO

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                                    </svg>
                                </div>
                            </a>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $type === 'recipe' ) : 
                    $recipe = $section["recipe"];
                    $recipe_selected = $recipe["recipe_selected"][0];

                    $product = get_field( "product", $recipe_selected->ID )[0];
                    $title = $recipe_selected->post_title;
                    $preparation_time = get_field( "preparation_time", $recipe_selected->ID );
                    $shortname = get_field( "shortname", $product->ID );
                ?>
                    <div class="provoke__section provoke__section--recipe">
                        <div class="provoke__item-recipe">
                                <a href="<?php the_permalink( $recipe_selected->ID ); ?>" class="grid gap-4 bg-beige-2 p-6 rounded-3xl overflow-hidden lg:gap-7 lg:p-8">
                                    <div class="grid gap-4">
                                        <p class="text-blue tracking-tight font-medium" data-animation-fade-in data-animation-threshold="0">
                                            RECETA
                                        </p>
        
                                        <h2 class="text-blue text-[2rem] tracking-tight font-medium leading-snug max-w-96" data-animation-split-text data-animation-threshold="0">
                                            <?php echo $title; ?>
                                        </h2>
                                    </div>
        
                                    <?php if ( has_post_thumbnail( $recipe_selected->ID ) ) : ?>
                                        <?php 
                                            $thumbnail_id = get_post_thumbnail_id( $recipe_selected->ID );
                                            $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'medium_large' )[0];
                                        ?>
                                        <div class="relative" data-animation-fade-in data-animation-threshold="0">
                                            <figure class="rounded-3xl overflow-hidden aspect-[1.48]">
                                                <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $title; ?>" class="w-full h-full object-cover">
                                            </figure>
        
                                            <div class="absolute bottom-3 right-3 flex gap-2">
                                                <div class="bg-blue text-white rounded-full py-3 px-6 text-center font-medium tracking-tight uppercase lg:text-lg">
                                                    <?php echo $shortname; ?>
                                                </div>
        
                                                <div class="bg-white text-blue rounded-full py-3 px-6 text-center font-medium tracking-tight uppercase lg:text-lg">
                                                    <?php echo $preparation_time; ?>
                                                </div>
                                            </div>
        
                                        </div>
                                    <?php endif; ?>
                                </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $type === 'video' ) : 
                    $video = $section["video"];
                    $video_selected = $video["video_selected"];
                    
                ?>
                    <div class="provoke__section provoke__section--video">
                        <div class="provoke__item-video" data-animation-scale data-animation-threshold="0">
                            <video preload="none" autoplay muted loop class="pointer-events-none">
                                <source src="<?php echo $video_selected["url"]; ?>" />
                            </video>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $type === 'imagen' ) : 
                    $image = $section["image"];
                    $image_selected = $image["image_selected"];
                ?>
                    <div class="provoke__section provoke__section--image">
                        <div class="provoke__item-image" data-animation-scale data-animation-threshold="0">
                            <img src="<?php echo $image_selected["sizes"]["medium_large"]; ?>" alt="<?php echo $image_selected["alt"]; ?>">
                        </div>
                    </div>
                <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div 
        class="fixed flex gap-5 justify-between items-center bottom-6 left-0 right-0 bg-white text-blue z-10 max-w-[22.37rem] mx-auto w-full py-4 px-6 rounded-[3rem] provoke__filter lg:max-w-[29rem] lg:px-10"
    >
        <button type="button" class="tracking-tight font-medium lg:text-lg lg:font-semibold provoke__filter-button" data-filter="recetas"> 
            Recetas
        </button>

        <button type="button" class="tracking-tight font-medium lg:text-lg lg:font-semibold provoke__filter-button" data-filter="blogs"> 
            Blogs
        </button>

        <button type="button" class="tracking-tight font-medium lg:text-lg lg:font-semibold provoke__filter-button" data-filter="productos"> 
            Productos
        </button>

        <button type="button" class="tracking-tight font-medium lg:text-lg lg:font-semibold provoke__filter-button" data-filter="media"> 
           Media
        </button>
    </div>
</section>
