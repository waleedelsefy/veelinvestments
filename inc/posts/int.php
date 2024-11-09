<?php

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Load each required file individually
 */

// Real estate advisor card
  include_once get_template_directory() . '/inc/posts/real-estate-advisor-card.php';
// Secondary title meta
  include_once get_template_directory() . '/inc/posts/secondary-title-meta.php';
// Preload featured image
  include_once get_template_directory() . '/inc/posts/preload-featured-image.php';
// Display project main location
  include_once get_template_directory() . '/inc/posts/display-project-main-location.php';
// Render project facilities metabox
  include_once get_template_directory() . '/inc/posts/render-project-facilities-metabox.php';
// Breadcrumb functionality
  include_once get_template_directory() . '/inc/posts/breadcrumb.php';
// Handle the form submission (e.g., send email, save to DB, etc.)
include_once get_template_directory() . '/inc/posts/contact-form.php';

include_once get_template_directory() . '/inc/posts/finish-type.php';
include_once get_template_directory() . '/inc/posts/post_views_count.php';
include_once get_template_directory() . '/inc/posts/enqueue-copy-url-script.php';
