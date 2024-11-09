<?php
/**
 * enqueue copy url script
 *
 * @package Didos
 * @version 0.0.1
 */
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Function to track post views
 */
function enqueue_copy_url_script() {
  wp_enqueue_script('copy-url-script', get_template_directory_uri() . '/dist/js/copy-url.js', array(), null, true);
  wp_localize_script('copy-url-script', 'translations', array(
    'copySuccess' => __('Link copied to clipboard!', 'veelinvestments'),
    'copyError' => __('Error copying the link.', 'veelinvestments')
  ));
}
add_action('wp_enqueue_scripts', 'enqueue_copy_url_script');
