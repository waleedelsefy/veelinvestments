<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Load required files efficiently
 */

include_once get_template_directory() . '/inc/int.php';
include_once get_template_directory() . '/inc/admin/int.php';
include_once get_template_directory() . '/inc/posts/int.php';
include_once get_template_directory() . '/inc/schema/int.php';
/**
 * Add theme supports
 */
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

/**
 * Register navigation menus efficiently
 */
function register_navwalker() {
  require_once get_template_directory() . '/inc/class-bootstrap-5-navwalker.php';
  register_nav_menus(array(
    'main-menu' => __('Main Menu', 'veelinvestments'),
    'header_menu' => __('Header Menu', 'veelinvestments'),
    'footer-menu' => __('Footer Menu', 'veelinvestments')
  ));
}
add_action('after_setup_theme', 'register_navwalker');

/**
 * Load theme textdomain for translations
 */
function veel_load_textdomain() {
  load_theme_textdomain('veelinvestments', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'veel_load_textdomain');

/**
 * Allow uploading of WebP images
 */
function custom_mime_types($mimes) {
  $mimes['webp'] = 'image/webp';
  return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');

/**
 * Check MIME types for uploaded files and allow WebP/ZIP
 */
/*function check_upload_image_type($file) {
  $allowed_types = array('image/webp', 'application/zip');
  $file_type = mime_content_type($file['tmp_name']);

  if (!in_array($file_type, $allowed_types)) {
    $file['error'] = __('File type not supported. Must be WebP or ZIP.', 'veelinvestments');
  }
  return $file;
}
add_filter('wp_handle_upload_prefilter', 'check_upload_image_type');*/

/**
 * Disable the post permalink editor
 */
function disable_post_permalink_editor() {
  if (is_admin() && current_user_can('edit_posts')) {
    add_action('admin_head', 'disable_post_permalink_script');
  }
}
function disable_post_permalink_script() {
  ?>
  <script>
    jQuery(document).ready(function($) {
      $('#edit-slug-box').find('.edit-slug-buttons').remove();
      $('#post_name').attr('readonly', true);
    });
  </script>
  <?php
}
add_action('admin_init', 'disable_post_permalink_editor');

/**
 * Disable Gutenberg block editor for posts
 */
function disable_block_editor() {
  if (is_admin() && current_user_can('edit_posts')) {
    add_filter('use_block_editor_for_post', '__return_false', 10);
  }
}
add_action('admin_init', 'disable_block_editor');

/**
 * Enforce trailing slash for 301 redirects
 */
function enforce_trailing_slash_301() {
  if (!is_admin() && substr($_SERVER['REQUEST_URI'], -1) !== '/' && !strstr($_SERVER['REQUEST_URI'], '.')) {
    wp_redirect(home_url(add_query_arg(array(), $wp->request)) . '/', 301);
    exit();
  }
}
add_action('template_redirect', 'enforce_trailing_slash_301');

/**
 * Add trailing slash to URLs in the content, except image files
 */
function add_trailing_slash_to_urls($content) {
  return preg_replace_callback('/href="([^"]+)"/i', function($matches) {
    $url = $matches[1];
    if (!preg_match('/\.(jpg|jpeg|png|gif|svg|jfif|webp)$/i', $url) && substr($url, -1) !== '/' && !strpos($url, '#') && !strpos($url, '?')) {
      $url .= '/';
    }
    return 'href="' . $url . '"';
  }, $content);
}
add_filter('the_content', 'add_trailing_slash_to_urls');
add_filter('term_description', 'add_trailing_slash_to_urls');
add_filter('widget_text', 'add_trailing_slash_to_urls');

/**
 * Remove unwanted strings from URL
 */
function remove_unwanted_strings_from_url() {
  $request_uri = $_SERVER['REQUEST_URI'];

  if (strpos($request_uri, '%3Ca%20href=') !== false || strpos($request_uri, '//tel:201000843339') !== false) {
    wp_redirect(preg_replace(array('/%3Ca%20href=.*$/', '/\/\/tel:201000843339$/'), '', $request_uri), 301);
    exit();
  }
}
add_action('template_redirect', 'remove_unwanted_strings_from_url');

/**
 * Disable application passwords for security
 */
add_filter('wp_is_application_passwords_available', '__return_false');

/**
 * Minify HTML output for improved performance
 */
function ak_minify_html_output($buffer) {
  if (strpos(ltrim($buffer), '<?xml') === 0) {
    return $buffer;
  }
  return preg_replace(array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'), array('>', '<', '\\1'), str_replace(array(chr(13).chr(10), chr(9)), array(chr(10), ''), $buffer));
}
function ak_init_minify_html() {
  if (!is_admin()) ob_start('ak_minify_html_output');
}
add_action('init', 'ak_init_minify_html', 1);

