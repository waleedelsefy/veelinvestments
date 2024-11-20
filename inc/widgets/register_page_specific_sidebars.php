<?php
function register_page_specific_sidebars() {
  register_sidebar( array(
    'name'          => __( 'Project Sidebar', 'your-theme-textdomain' ),
    'id'            => 'project-sidebar',
    'description'   => __( 'Sidebar for project pages.', 'your-theme-textdomain' ),
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => __( 'City Sidebar', 'your-theme-textdomain' ),
    'id'            => 'city-sidebar',
    'description'   => __( 'Sidebar for city pages.', 'your-theme-textdomain' ),
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Post Sidebar', 'your-theme-textdomain' ),
    'id'            => 'post-sidebar',
    'description'   => __( 'Sidebar for post pages.', 'your-theme-textdomain' ),
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'register_page_specific_sidebars' );
