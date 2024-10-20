<?php


add_action('wp_ajax_get_recent_cities_data', 'get_recent_cities_data _callback');
add_action('wp_ajax_nopriv_get_recent_cities_data', 'get_recent_cities_data_callback');
function get_recent_cities_data_callback() {
    $recent_top_cities = get_terms(array(
        'taxonomy'   => 'city',
        'orderby'    => 'date',
        'order'      => 'DESC',
        'number'     => 4,
    ));

    $recent_cities_data = array();
    foreach ($recent_top_cities as $city) {
        $city_url = get_term_link($city);
        $projects_count = wp_count_posts('projects');
        $recent_project_count = $projects_count->publish;

        // Include cities with projects
        if ($recent_project_count > 4) {
            $recent_cities_data[] = array(
                'name'          => $city->name,
                'url'           => $city_url,
                'project_count' => $recent_project_count,
            );
        }
    }
    // Sort cities by project count in descending order
    usort($recent_cities_data, function ($a, $b) {
        return $b['project_count'] - $a['project_count'];
    });
    $cities_data = array_slice($recent_cities_data, 0, 4);
    wp_send_json($recent_cities_data);
}
