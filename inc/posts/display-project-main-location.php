<?php

function display_project_main_location()
{
    $post_id = get_the_ID();
    $post_type = get_post_type($post_id);
    $location ='';

    if ($post_type == 'projects') {
        $city_terms = get_the_terms($post_id, 'city');
        if ($city_terms && !is_wp_error($city_terms)) {
            $location = $city_terms[0]->name;
        }
    } elseif ($post_type == 'units') {
        $project_id = get_post_meta($post_id, '_unit_project_id', true);
        if ($project_id) {
            $city_terms = get_the_terms($project_id, 'city');
            if ($city_terms && !is_wp_error($city_terms)) {
                $location = $city_terms[0]->name;
            }
        }
    }

    $author_name = get_the_author();
    $publish_date = get_the_date('d-m-Y');
    $reading_time = estimated_reading_time();

    echo '
    <div class="project-main-location">
        <span class="col-main-location des-only">
            <i class="icon-location"></i> ' . esc_html($location) . '
        </span>
        <span class="col-main-location">
            <i class="fa-duotone fa-solid fa-user"></i> ' . esc_html($author_name) . '
        </span>
        <span class="col-main-location">
           <i class="fa-solid fa-calendars"></i>
            <time datetime="' . esc_attr(get_the_date('c')) . '" itemprop="datePublished">' . esc_html($publish_date) . '</time>
        </span>
        <span class="col-main-location des-only">
            <i class="fa-solid fa-clock"></i> ' . esc_html($reading_time) . '
        </span>
    </div>';
}

function estimated_reading_time()
{
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);

    return sprintf(_n('%d minute', '%d minutes', $reading_time, 'veelinvestments'), $reading_time);
}
