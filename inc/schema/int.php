<?php

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Load required files individually
 */

// General schema
require_once get_template_directory() . '/inc/schema/schema.php';

// Author schema
require_once get_template_directory() . '/inc/schema/auther-schema.php';

// Breadcrumb schema
require_once get_template_directory() . '/inc/schema/breadcrumb-schema.php';

// FAQ schema
require_once get_template_directory() . '/inc/schema/faq-schema.php';

// Gallery schema
require_once get_template_directory() . '/inc/schema/gallery-schema.php';

// Testimonials functionality
require_once get_template_directory() . '/inc/testimonials.php';

// Type editor functionality
require_once get_template_directory() . '/inc/type-editor.php';
