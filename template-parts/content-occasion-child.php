<?php
/**
 * Template part for displaying child occasion content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('occasion-child'); ?>>
    <div class="occasion-child__header">
        <?php if (has_post_thumbnail()) : ?>
            <div class="occasion-child__featured-image">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php endif; ?>

        <div class="occasion-child__title-area">
            <?php
            // Get parent occasion
            $parent_id = wp_get_post_parent_id(get_the_ID());
            if ($parent_id) :
                $parent = get_post($parent_id);
            ?>
                <div class="occasion-child__parent">
                    <a href="<?php echo get_permalink($parent_id); ?>"><?php echo $parent->post_title; ?></a>
                </div>
            <?php endif; ?>

            <h1 class="occasion-child__title"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="occasion-child__content">
        <?php
        the_content();

        // Display custom fields if any
        if (function_exists('get_fields') && get_fields()) :
            foreach (get_fields() as $name => $value) :
                if ($value) : ?>
                    <div class="occasion-child__field">
                        <strong><?php echo esc_html($name); ?>:</strong>
                        <?php 
                        if (is_array($value)) {
                            echo '<pre>' . print_r($value, true) . '</pre>';
                        } else {
                            echo wp_kses_post($value);
                        }
                        ?>
                    </div>
                <?php endif;
            endforeach;
        endif;
        ?>
    </div>

    <div class="occasion-child__navigation">
        <?php
        // Get siblings
        $siblings = get_posts(array(
            'post_type' => 'occasion',
            'post_parent' => $parent_id,
            'posts_per_page' => -1,
            'orderby' => 'menu_order title',
            'order' => 'ASC'
        ));

        if ($siblings) :
            $current_key = array_search(get_the_ID(), wp_list_pluck($siblings, 'ID'));
            $prev_post = isset($siblings[$current_key - 1]) ? $siblings[$current_key - 1] : null;
            $next_post = isset($siblings[$current_key + 1]) ? $siblings[$current_key + 1] : null;
        ?>
            <div class="occasion-child__siblings">
                <?php if ($prev_post) : ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="occasion-child__prev">
                        <span class="nav-subtitle">Previous</span>
                        <span class="nav-title"><?php echo $prev_post->post_title; ?></span>
                    </a>
                <?php endif; ?>

                <?php if ($next_post) : ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="occasion-child__next">
                        <span class="nav-subtitle">Next</span>
                        <span class="nav-title"><?php echo $next_post->post_title; ?></span>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</article> 
