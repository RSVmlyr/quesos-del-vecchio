<?php

// Register Custom Theme Configuration
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'General',
        'menu_title'    => 'General',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
	// Add sub pages.
    acf_add_options_sub_page(array(
        'page_title'    => 'Loader',
        'menu_title'    => 'Loader',
        'parent_slug'   => 'theme-general-settings',
    ));

	acf_add_options_sub_page(array(
        'page_title'    => 'Footer',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
};
