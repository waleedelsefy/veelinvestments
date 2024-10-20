<?php
function load_more_latest_projects_in_city_callback() {
    $page = $_POST['page'];
    $city_id = $_POST['city_id'];

    // Check if the data is available in local storage
    $storedData = isset($_POST['storedData']) ? json_decode($_POST['storedData']) : array();

    if (!empty($storedData) && isset($storedData[$page - 1])) {
        echo $storedData[$page - 1];
        exit;
    }

    $args = array(
        'post_type' => 'projects',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $page,
        'tax_query' => array(
            array(
                'taxonomy' => 'city',
                'field' => 'term_id',
                'terms' => $city_id,
            ),
        ),
    );

    $loop = new WP_Query($args);
    ob_start();
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            ?>
            <div class="card-block">
                <?php get_template_part('template-parts/single-card'); ?>
            </div>
            <?php
        }
    } else {
        echo '<tr><td colspan="1">' . __('No more projects in this city', 'veelinvestments') . '</td></tr>';
    }
    wp_reset_postdata();

    // Store the retrieved data in the response
    $responseData = ob_get_clean();
    echo $responseData;

    // Store the retrieved data in local storage
    if (!empty($responseData)) {
        $storedData[$page - 1] = $responseData;
        echo '<script>localStorage.setItem("latestProjectsInCity_' . $city_id . '", ' . json_encode($storedData) . ');</script>';
    }

    exit;
}

add_action('wp_ajax_load_more_latest_projects_in_city', 'load_more_latest_projects_in_city_callback');
add_action('wp_ajax_nopriv_load_more_latest_projects_in_city', 'load_more_latest_projects_in_city_callback');
