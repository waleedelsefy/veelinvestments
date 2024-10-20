<?php
function load_archive_more_posts() {
    $page = $_GET['page'];
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'paged' => $page
    );
    $posts = new WP_Query($args);
    if($posts->have_posts()) :
        while($posts->have_posts()) : $posts->the_post();
             ?>
            <div class="card-block">
                <?php get_template_part('template-parts/single-card'); ?>
            </div>
        <?php        endwhile;
    endif;
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_load_archive_more_posts', 'load_archive_more_posts');
add_action('wp_ajax_nopriv_load_archive_more_posts', 'load_archive_more_posts');
