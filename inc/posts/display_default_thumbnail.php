<?php
function display_default_thumbnail($post_id) {
  if (!has_post_thumbnail($post_id)) {
    $default_image_url = get_template_directory_uri() . '/images/default-thumbnail.jpg';

    echo '<img src="' . esc_url($default_image_url) . '" alt="' . esc_attr(get_the_title($post_id)) . '">';
  } else {
    the_post_thumbnail('full');
  }
}
