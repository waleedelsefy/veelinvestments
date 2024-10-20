<?php
add_action('wp_ajax_load_more_units', 'load_more_units');
add_action('wp_ajax_nopriv_load_more_units', 'load_more_units');

function load_more_units() {
    $page = $_POST['page'];
    $post_id = $_POST['post_id']; // Retrieve post_id from AJAX request
    $paged = $page; // Set $paged to $page received from AJAX request
    $cache_key = 'units_query_' . $post_id . '_' . $paged;
    $cache_duration = 3600;
    $unit_query = get_transient($cache_key);
    $units_loaded = false; // Variable to track if any units have been loaded

    if (false === $unit_query) {
        $args = array(
            'post_type'      => 'units',
            'posts_per_page' => 2,
            'paged'          => $paged,
            'meta_query'     => array(
                array(
                    'key'     => '_unit_project_id',
                    'value'   => $post_id,
                    'compare' => '=',
                ),
            ),
        );
        $unit_query = new WP_Query($args);
        set_transient($cache_key, $unit_query, $cache_duration);
    }

    if ($unit_query->have_posts()) :
        while ($unit_query->have_posts()) : $unit_query->the_post();
            ?>
            <div class="unit-of-projects">
                <?php get_template_part('template-parts/single-card'); ?>
            </div>
            <?php
            $units_loaded = true; // Set to true if any units are loaded
        endwhile;
        wp_reset_postdata();
    endif;

    // Display no-units-found-message if no units are loaded
    if (!$units_loaded) :
        ?>
        <div class="no-units-found-message">
            <div class="no-units-found-text">
                <h2><?php echo __('Are you looking for a unit with special recipes?!', 'veelinvestments'); ?></h2>
                <p><?php echo __('Contact us and do not hesitate, you will find what you want', 'veelinvestments'); ?></p>
            </div>
            <?php
            if (function_exists('pll_current_language')) {
                $current_language = pll_current_language();
                if ($current_language === 'ar') {
                    echo do_shortcode('[ns_api_form_vertical]');
                } elseif ($current_language === 'en') {
                    echo do_shortcode('[form-group-vertical]');
                }
            }
            ?>
        </div>
    <?php
    endif;

    wp_die();
}
?>
