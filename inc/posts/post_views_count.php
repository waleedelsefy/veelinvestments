<?php
/**
 * post views count
 *
 * @package Didos
 * @version 0.0.1
 */
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Function to track post views
 */

function set_post_views($postID) {
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if ($count == '') {
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
  } else {
    $count++;
    update_post_meta($postID, $count_key, $count);
  }
}

// Remove prefetching to avoid false counts
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Increment views on single post view
function track_post_views($post_id) {
  if (!is_single()) return;
  if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
  }
  set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');
