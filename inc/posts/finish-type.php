<?php
function register_finish_type_taxonomy() {
  $finish_types = array(
    'name'              => __('Finish Types', 'veelinvestments'),
    'singular_name'     => __('payment system', 'veelinvestments'),
    'search_items'      => __('Search Finish Types', 'veelinvestments'),
    'all_items'         => __('All Finish Types', 'veelinvestments'),
    'edit_item'         => __('Edit Finish Type', 'veelinvestments'),
    'update_item'       => __('Update Finish Type', 'veelinvestments'),
    'add_new_item'      => __('Add New Finish Type', 'veelinvestments'),
    'new_item_name'     => __('New Finish Type Name', 'veelinvestments'),
    'menu_name'         => __('Finish Types', 'veelinvestments'),
  );
  $args_finish_types = array(
    'hierarchical'      => true,
    'labels'            => $finish_types,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'finish_type'),
    'capabilities'      => array(
      'assign_terms' => 'manage_options',
      'edit_terms'   => 'manage_options',
      'manage_terms' => 'manage_options',
    ),
  );
  // Register the taxonomy for both post types
  register_taxonomy('finish_type', array('projects'), $args_finish_types);
}
add_action('init', 'register_finish_type_taxonomy');

