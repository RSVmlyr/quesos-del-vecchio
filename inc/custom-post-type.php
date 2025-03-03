<?php
/**
 * Simplify generating post type labels by only needing to enter a singular and plural verison
 *
 * @param  string $singular  The singular version of the post type label
 * @param  string $plural    The plural version of the post type label
 * @param  array  $overrides Specific labels to override that might not fit this pattern
 * @return array             Post type labels
 */

function generate_post_type_labels( $singular = '', $plural = '', $overrides = array() ) {
	$lc_plural   = strtolower( $plural );
	$uc_plural   = ucwords( $lc_plural );
	$lc_singular = strtolower( $singular );
	$uc_singular = ucwords( $lc_singular );

	$labels = array(
		'name'                  => $uc_plural,
		'singular_name'         => $uc_singular,
		'menu_name'             => $uc_plural,
		'name_admin_bar'        => $uc_singular,
		'archives'              => $uc_singular . ' Archives',
		'attributes'            => $uc_singular . ' Attributes',
		'parent_item_colon'     => 'Padre ' . $uc_singular . ':',
		'all_items'             => 'All ' . $uc_plural,
		'add_new_item'          => 'Add New ' . $uc_singular,
		'add_new'               => 'Add New',
		'new_item'              => 'New ' . $uc_singular,
		'edit_item'             => 'Edit ' . $uc_singular,
		'update_item'           => 'Update ' . $uc_singular,
		'view_item'             => 'View ' . $uc_singular,
		'view_items'            => 'View ' . $uc_plural,
		'search_items'          => 'Search ' . $uc_singular,
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into ' . $lc_singular,
		'uploaded_to_this_item' => 'Uploaded to this ' . $lc_singular,
		'items_list'            => ucfirst( $lc_plural ) . ' list',
		'items_list_navigation' => ucfirst( $lc_plural ) . ' list navigation',
		'filter_items_list'     => 'Filter ' . $lc_plural . ' list',
	);
	return wp_parse_args( $overrides, $labels );
}

function create_post_types() {
    // Occasions Post Type
    $occasions_args = array(
        'labels'             => generate_post_type_labels( 'occasion', 'Occasions' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'ocasiones' ),
		'capability_type'	 => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'custom-fields', 'thumbnail', 'page-attributes' ),
        'menu_icon'             => 'dashicons-calendar',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'exclude_from_search'   => false,
        'show_in_rest'          => true,
    );
	register_post_type( 'occasion', $occasions_args );
}

add_action( 'init', 'create_post_types', 0 );
