<?php
function custom_rewrite_rules() {
  $post_type = 'projects';
  $taxonomy = 'city';

  // قاعدة إعادة الكتابة المخصصة
  add_rewrite_rule(
    '^city/([^/]+)/([^/]+)/?$',
    'index.php?' . $taxonomy . '=$matches[1]&' . $post_type . '=$matches[2]',
    'top'
  );
}
add_action('init', 'custom_rewrite_rules');

function custom_query_vars($vars) {
  $vars[] = 'projects';
  return $vars;
}
add_filter('query_vars', 'custom_query_vars');

function custom_pre_get_posts($query) {
  if (!is_admin() && $query->is_main_query() && isset($query->query_vars['projects'])) {
    $query->set('post_type', 'projects');
    $query->set('name', $query->query_vars['projects']);
  }
}
add_action('pre_get_posts', 'custom_pre_get_posts');

function custom_post_type_permalink($permalink, $post) {
  if ($post->post_type === 'projects') {
    $terms = wp_get_post_terms($post->ID, 'city');
    if (!empty($terms) && !is_wp_error($terms)) {
      return home_url('city/' . $terms[0]->slug . '/' . $post->post_name . '/');
    }
  }
  return $permalink;
}
add_filter('post_type_link', 'custom_post_type_permalink', 10, 2);

add_filter('template_include', function($template) {
  if (get_query_var('post_type') === 'projects' && is_single()) {
    $custom_template = locate_template('single-projects.php');
    if ($custom_template) {
      return $custom_template;
    }
  }
  return $template;
});
