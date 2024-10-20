<?php
// Theme setup and custom theme supports
require_once get_template_directory() . '/inc/theme-setup.php';

// Main/sidebar column width and breakpoints
require_once get_template_directory() . '/inc/columns.php';

// Comments
require_once get_template_directory() . '/inc/comments.php';

// Container class
require_once get_template_directory() . '/inc/container.php';

// Enable HTML in category and author description
require_once get_template_directory() . '/inc/enable-html.php';

// Enqueue scripts and styles
require_once get_template_directory() . '/inc/enqueue.php';

// Adds excerpt to pages
require_once get_template_directory() . '/inc/excerpt.php';

// Custom hooks
require_once get_template_directory() . '/inc/hooks.php';

// Loop items and pagination
require_once get_template_directory() . '/inc/loop.php';

// Pagination
require_once get_template_directory() . '/inc/pagination.php';

// Password protected form
require_once get_template_directory() . '/inc/password-protected-form.php';

// Meta information like author, date, etc.
require_once get_template_directory() . '/inc/template-tags.php';

// Functions enhancing the theme
require_once get_template_directory() . '/inc/template-functions.php';

// Widget area and Gutenberg support
require_once get_template_directory() . '/inc/widgets.php';

// Deprecated fallback functions
require_once get_template_directory() . '/inc/deprecated.php';

// Admin theme options
require_once get_template_directory() . '/admin/theme-options.php';

// Project page backend
require_once get_template_directory() . '/inc/project-editor.php';

// City editor backend
require_once get_template_directory() . '/inc/city-editor.php';

// Developer editor backend
require_once get_template_directory() . '/inc/developer-editor.php';

// Admin functions
require_once get_template_directory() . '/inc/admin.php';

// Ajax search
require_once get_template_directory() . '/inc/ajax-search.php';

// Ajax files - get cities data callback
require_once get_template_directory() . '/inc/ajax-files/get-cities-data-callback.php';

// Error handling
require_once get_template_directory() . '/inc/errors.php';
