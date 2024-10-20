<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Add secondary title to the title input section
 */
function add_secondary_title_to_title_input($post) {
  // Get the current secondary title
  $secondary_title = get_post_meta($post->ID, '_secondary_title', true);

  // Display the secondary title input field under the main title
  echo '<div class="secondary-title-wrap">';
  echo '<label for="secondary_title_field"><h2>'. __('Secondary Title', 'veelinvestments') .':</h2></label>';
  echo '<input type="text" placeholder="'. __('Secondary Title', 'veelinvestments') .'" id="secondary_title_field" name="secondary_title_field" value="' . esc_attr($secondary_title) . '" style="width: 100%;" />';
  echo '</div>';
}
add_action('edit_form_after_title', 'add_secondary_title_to_title_input');

/**
 * Save secondary title when saving post
 */
function save_secondary_title_meta_box($post_id) {
  // Ensure the save isn't an autosave or a non-existing field
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  // Check if the secondary title field is set and save it
  if (isset($_POST['secondary_title_field'])) {
    update_post_meta($post_id, '_secondary_title', sanitize_text_field($_POST['secondary_title_field']));
  }
}
add_action('save_post', 'save_secondary_title_meta_box');

/**
 * Display secondary title
 */
function secondary_title() {
  global $post;

  // Get the secondary title from post meta
  $secondary_title = get_post_meta($post->ID, '_secondary_title', true);

  // Check if secondary title exists and is not empty
  if (!empty($secondary_title)) {
    echo esc_html($secondary_title);
  } else {
    // Fall back to the main title if no secondary title is set
    the_title();
  }
}
