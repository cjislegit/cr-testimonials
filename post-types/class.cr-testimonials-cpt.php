<?php

if (!class_exists('CR_Testimonials_Post_Types')) {
    class CR_Testimonials_Post_Type
    {
        public function __construct()
        {
            add_action('init', array($this, 'create_post_type'));
        }

        public function create_post_type()
        {
            //Create a cr-slider post type
            register_post_type(
                "cr-testimonials",
                array(
                    'label' => 'Testimonial',
                    'description' => 'Testimonials',
                    'lables' => array(
                        'name' => 'Testimonials',
                        'singular_name' => 'Testimonial',
                    ),
                    'public' => true,
                    'supports' => array(
                        'title',
                        'editor',
                        'thumbnail',
                    ),
                    'hierarchical' => false,
                    'show_ui' => true,
                    //Set to false to hide in the menu since seperate menu item has already been created
                    'show_in_menu' => true,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export' => true,
                    'has_archive' => true,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_item' => 'dashicons-testimonial',

                )
            );

        }
    }
}