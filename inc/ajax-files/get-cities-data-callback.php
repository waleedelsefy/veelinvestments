<?php
function get_projects_by_city($data) {
  $city_id = $data['city_id'];

  $args = array(
    'post_type' => 'projects',
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'city',
        'field' => 'term_id',
        'terms' => $city_id,
      ),
    ),
  );

  $projects = new WP_Query($args);

  if ($projects->have_posts()) {
    ob_start(); // تخزين المخرجات في الـ buffer
    while ($projects->have_posts()) : $projects->the_post();
      get_template_part('template-parts/content', 'project-card'); // استدعاء القالب
    endwhile;
    wp_reset_postdata();
    return ob_get_clean(); // استرجاع HTML المخزن
  } else {
    return '<p>' . __('لا توجد مشاريع متاحة في هذه المدينة.', 'veelinvestments') . '</p>';
  }
}
