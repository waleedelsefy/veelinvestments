<?php
/**
 * Hooks
 *
 * @package Didos
 * @version 0.0.1
 */
defined( 'ABSPATH' ) || exit;
/**
 * Hook after #primary
 */
function bs_after_primary() {
  do_action('bs_after_primary');
}
function center_image_in_content($content) {
    preg_match_all('/<img [^>]+>/', $content, $matches);
    if (!empty($matches[0])) {
        foreach ($matches[0] as $img) {
            $centered_img = preg_replace('/<img(.*?)class=[\'"](.*?)[\'"](.*?)>/i', '<img$1class="$2 centered-image"$3>', $img);
            $content = str_replace($img, $centered_img, $content);
        }
    }
    return $content;
}
add_filter('the_content', 'center_image_in_content');
function register_payment_systems_taxonomy() {
    $labels_installment = array(
        'name'              => __('Payment Systems', 'veelinvestments'),
        'singular_name'     => __('payment system', 'veelinvestments'),
        'search_items'      => __('Search Payment Systems', 'veelinvestments'),
        'all_items'         => __('All Payment Systems', 'veelinvestments'),
        'edit_item'         => __('Edit Payment System', 'veelinvestments'),
        'update_item'       => __('Update Payment System', 'veelinvestments'),
        'add_new_item'      => __('Add New Payment System', 'veelinvestments'),
        'new_item_name'     => __('New Payment System Name', 'veelinvestments'),
        'menu_name'         => __('Payment Systems', 'veelinvestments'),
    );
    $args_installment = array(
        'hierarchical'      => true,
        'labels'            => $labels_installment,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'payment_systems'),
        'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'manage_options',
            'manage_terms' => 'manage_options',
        ),
    );
    // Register the taxonomy for both post types
    register_taxonomy('payment_systems', array('projects', 'units'), $args_installment);
}
add_action('init', 'register_payment_systems_taxonomy');

