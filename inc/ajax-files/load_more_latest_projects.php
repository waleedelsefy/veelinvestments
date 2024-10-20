<?php
add_action('wp_ajax_load_more_latest_projects', 'load_more_latest_projects');
add_action('wp_ajax_nopriv_load_more_latest_projects', 'load_more_latest_projects');

function load_more_latest_projects() {
    $page = $_POST['page'];
    $args = array(
        'post_type' => 'projects',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $page,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
            <tr>
                <td><a class="latest-section-link" href="<?php the_permalink(); ?>" rel="dofollow"><?php the_title(); ?></a></td>
            </tr>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '';
    endif;

    wp_die();
}
