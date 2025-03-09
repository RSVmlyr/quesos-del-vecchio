<?php

class My_ACF_Location_Post_Parent extends ACF_Location {
    public function initialize() {
        $this->name = 'post_parent';
        $this->label = 'Post Parent Status';
        $this->category = 'post';
        $this->object_type = 'post';
    }

    public function get_values($rule) {
        return array(
            'has_parent' => 'Is Child Post',
            'no_parent' => 'Is Not Child Post'
        );
    }

    public function match($rule, $screen, $field_group) {
        // Get the current post ID
        $post_id = isset($screen['post_id']) ? $screen['post_id'] : false;
        
        if (!$post_id) {
            return false;
        }

        // Get the post's parent ID
        $post_parent = get_post_field('post_parent', $post_id);
        
        // Check if the post has a parent
        $has_parent = !empty($post_parent);

        if ($rule['value'] === 'has_parent') {
            return $has_parent;
        } else if ($rule['value'] === 'no_parent') {
            return !$has_parent;
        }

        return false;
    }
}


add_action('acf/init', 'my_acf_init_location_types');
function my_acf_init_location_types() {

    // Check function exists, then include and register the custom location type class.
    if( function_exists('acf_register_location_type') ) { 
        acf_register_location_type( 'My_ACF_Location_Post_Parent' );
    }
}
