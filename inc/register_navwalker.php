<?php
function register_navwalker() {
  require_once get_template_directory() . '/inc/class-bootstrap-5-navwalker.php';
  register_nav_menus(array(
    'main-menu' => __('Main Menu', 'veelinvestments'),
    'header_menu' => __('Header Menu', 'veelinvestments'),
    'footer-menu' => __('Footer Menu', 'veelinvestments'),
    'primary-menu' => __('Primary Menu', 'veelinvestments')
  ));
}
add_action('after_setup_theme', 'register_navwalker');
