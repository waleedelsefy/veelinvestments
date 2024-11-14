<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Dido's Team
 * @version 0.0.1
 */
// Exit if accessed directly
defined('ABSPATH') || exit;
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function veel_single_template($single_template) {
    global $post;
    $custom_post_types = array('projects', 'units');
    if (in_array($post->post_type, $custom_post_types)) {
        $single_template = get_template_directory() . '/single-templates/single-' . $post->post_type . '.php';
    }
    return $single_template;
}
add_filter('single_template', 'veel_single_template');
