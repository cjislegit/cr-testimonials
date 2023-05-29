<?php

/**
 * Plugin Name: CR Testimonials
 * Plugin URI: https://www.wordpress.org/cr-testimonials
 * Description: My plugin's description
 * Version: 1.0
 * Requires at least: 5.6
 * Requires PHP: 7.0
 * Author: Marcelo Vieira
 * Author URI: https://www.codigowp.net
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cr-testimonials
 * Domain Path: /languages
 */
/*
CR Testimonials is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

CR Testimonials is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with CR Testimonials. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('CR_Testimonials')) {

    class CR_Testimonials
    {

        public function __construct()
        {

            // Define constants used througout the plugin
            $this->define_constants();

            require_once CR_TESTIMONIALS_PATH . 'post-types/class.cr-testimonials-cpt.php';
            $CRTestimonialsPostType = new CR_Testimonials_Post_Type();

            //Regiserts the widget class
            require_once CR_TESTIMONIALS_PATH . 'widgets/class.cr-testimonials-widget.php';
            $CRTestimonialsWidget = new CR_Testimonials_Widget();

            //Lets us use a custom file to replace default archive page
            add_filter('archive_template', array($this, 'load_custom_archive_template'));

            //Lets us use a custom file to replace default single page
            add_filter('single_template', array($this, 'load_custom_single_template'));

        }

        /**
         * Define Constants
         */
        public function define_constants()
        {
            // Path/URL to root of this plugin, with trailing slash.
            define('CR_TESTIMONIALS_PATH', plugin_dir_path(__FILE__));
            define('CR_TESTIMONIALS_URL', plugin_dir_url(__FILE__));
            define('CR_TESTIMONIALS_VERSION', '1.0.0');
            //Allows theme to override the plugin styles
            define('CR_TESTIMONIALS_OVERRIDE_PATH_DIR', get_stylesheet_directory() . '/cr-testimonials/');
        }

        public function load_custom_archive_template($tpl)
        {
            //Checks if the theme allows support
            if (current_theme_supports('cr-testimonials')) {
                if (is_post_type_archive('cr-testimonials')) {
                    //If override option is turned on
                    $tpl = $this->get_template_part_location('archive-cr-testimonials.php');

                    //If override option is turned off
                    // $tpl = CR_TESTIMONIALS_PATH . 'views/templates/archive-cr-testimonials.php';
                }
            }
            return $tpl;
        }

        public function load_custom_single_template($tpl)
        {
            //Checks if the theme allows support
            if (current_theme_supports('cr-testimonials')) {
                if (is_singular('cr-testimonials')) {

                    //If override option is turned on
                    $tpl = $this->get_template_part_location('single-cr-testimonials.php');

                    //If override option is turned off
                    // $tpl = CR_TESTIMONIALS_PATH . 'views/templates/single-cr-testimonials.php';
                }
            }
            return $tpl;
        }

        public function get_template_part_location($file)
        {
            //If the override file exists set the var to its path
            if (file_exists(CR_TESTIMONIALS_OVERRIDE_PATH_DIR . $file)) {
                $file = CR_TESTIMONIALS_OVERRIDE_PATH_DIR . $file;
            } else {
                //Sets the var to the default template
                $file = CR_TESTIMONIALS_PATH . 'views/templates/' . $file;
            }
            return $file;
        }

        /**
         * Activate the plugin
         */
        public static function activate()
        {
            update_option('rewrite_rules', '');
        }

        /**
         * Deactivate the plugin
         */
        public static function deactivate()
        {
            unregister_post_type('cr-testimonials');
            flush_rewrite_rules();
        }

        /**
         * Uninstall the plugin
         */
        public static function uninstall()
        {
            delete_option('widget_cr-testimonials');

            $posts = get_posts(
                array(
                    'post_type' => 'cr-testimonials',
                    'number_posts' => -1,
                    'post_status' => 'any',
                )
            );

            foreach ($posts as $post) {
                wp_delete_post($post->ID, true);
            }

        }

    }
}

if (class_exists('CR_Testimonials')) {
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('CR_Testimonials', 'activate'));
    register_deactivation_hook(__FILE__, array('CR_Testimonials', 'deactivate'));
    register_uninstall_hook(__FILE__, array('CR_Testimonials', 'uninstall'));

    $cr_testimonials = new CR_Testimonials();
}
