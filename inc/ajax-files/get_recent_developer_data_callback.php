<?php


add_action('wp_ajax_get_recent_developers_data', 'get_recent_developers_data _callback');
add_action('wp_ajax_nopriv_get_recent_developers_data', 'get_recent_developers_data_callback');
function get_recent_developers_data_callback() {
    $recent_top_developers = get_terms(array(
        'taxonomy'   => 'developer',
        'orderby'    => 'date',
        'order'      => 'DESC',
        'number'     => 4,
    ));

    $recent_developers_data = array();
    foreach ($recent_top_developers as $developer) {
        $developer_url = get_term_link($developer);
        $projects_count = wp_count_posts('projects');
        $recent_project_count = $projects_count->publish;

        // Include developers with projects
        if ($recent_project_count > 4) {
            $recent_developers_data[] = array(
                'name'          => $developer->name,
                'url'           => $developer_url,
                'project_count' => $recent_project_count,
            );
        }
    }
    // Sort developers by project count in descending order
    usort($recent_developers_data, function ($a, $b) {
        return $b['project_count'] - $a['project_count'];
    });
    $developers_data = array_slice($recent_developers_data, 0, 4);
    wp_send_json($recent_developers_data);
}
