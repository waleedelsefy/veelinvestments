<?php

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
function load_more_posts() {
    check_ajax_referer('load_more_posts_nonce', 'security');

    $paged = $_POST['page'];
    $loop = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'paged' => $paged,
        'ignore_sticky_posts' => 1
    ));

    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            ?>
            <div class="card-block">
                <?php get_template_part('template-parts/single-card-none'); ?>
            </div>
        <?php
        endwhile;
        $next_page_exists = $paged < $loop->max_num_pages;
        if (!$next_page_exists) {
            ?>
            <script>
                jQuery(document).ready(function($) {
                    $('.load-more-button').hide();
                    $('.no-more-posts-message').show();
                });
            </script>
            <?php
        }
    endif;

    wp_reset_postdata();
    wp_die();
}
