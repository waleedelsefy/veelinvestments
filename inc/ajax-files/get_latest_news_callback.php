<?php
add_action('wp_ajax_get_latest_news', 'get_latest_news_callback');
add_action('wp_ajax_nopriv_get_latest_news', 'get_latest_news_callback');
function get_latest_news_callback() {
    ob_start();
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'ignore_sticky_posts' => 1
    );
    $loop = new WP_Query($args);
    $unit_number = 1;

    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            $unit_class = 'card-block-unit-' . $unit_number;
            ?>
            <div class="card-block <?php echo esc_attr($unit_class); ?>">
                <?php get_template_part('template-parts/single-card-none'); ?>
            </div>
            <?php
            $unit_number++;
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No posts found</p>';
    endif;
    $content = ob_get_clean();
    wp_send_json($content);
}
