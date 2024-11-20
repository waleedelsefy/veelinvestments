<?php

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Load required files individually
 */
function theme_slug_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Main Sidebar', 'your-theme-textdomain' ),
    'id'            => 'main-sidebar',
    'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'your-theme-textdomain' ),
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );


function register_custom_sidebar_widgets() {
  // تسجيل أداة price-container
  wp_register_sidebar_widget(
    'price_container_widget', // ID فريد للأداة
    'Price Container', // اسم الأداة
    'display_price_container_widget' // الدالة التي تعرض محتوى الأداة
  );

  // تسجيل أداة schedule-meeting
  wp_register_sidebar_widget(
    'schedule_meeting_widget',
    'Schedule Meeting',
    'display_schedule_meeting_widget'
  );
}
add_action( 'widgets_init', 'register_custom_sidebar_widgets' );

// دالة لعرض محتوى price-container
function display_price_container_widget() {
  get_template_part('template-parts/projects/price-container');
}

// دالة لعرض محتوى schedule-meeting
function display_schedule_meeting_widget() {
  get_template_part('template-parts/projects/schedule-meeting');
}
