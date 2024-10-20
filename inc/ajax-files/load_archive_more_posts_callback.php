<?php
add_action('wp_ajax_load_archive_more_posts', 'load_archive_more_posts_callback');
add_action('wp_ajax_nopriv_load_archive_more_posts', 'load_archive_more_posts_callback');

function load_archive_more_posts_callback() {
    $page = $_GET['page'];
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : 'post';

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => 3,
        'paged' => $page,
    );

    $units_query = new WP_Query($args);

    if ($units_query->have_posts()) {
        while ($units_query->have_posts()) {
            $units_query->the_post();?>
            <div class="card-block">
                <?php get_template_part('template-parts/single-card'); ?>
            </div>
            <?php
        }
        wp_reset_postdata();
    }

    wp_die();
}
