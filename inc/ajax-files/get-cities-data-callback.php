<?php
function get_projects_by_city($data) {
  // Retrieve the city ID from the request data
  $city_id = intval($data['city_id']);

  // Define the query arguments to fetch projects related to the city
  $args = array(
    'post_type'      => 'projects',
    'posts_per_page' => -1,
    'tax_query'      => array(
      array(
        'taxonomy' => 'city',
        'field'    => 'term_id',
        'terms'    => $city_id,
      ),
    ),
  );

  // Run the query to fetch projects
  $projects = new WP_Query($args);

  // Check if there are any projects
  if ($projects->have_posts()) {
    ob_start(); // Start output buffering
    while ($projects->have_posts()) : $projects->the_post();
      // Load the project card template part for each project
      get_template_part('template-parts/content', 'project-card');
    endwhile;
    wp_reset_postdata(); // Reset post data after the loop
    return ob_get_clean(); // Return the buffered output
  } else {
    // Return a message if no projects are found
    return '<p>' . __('No projects available in this city.', 'veelinvestments') . '</p>';
  }
}
