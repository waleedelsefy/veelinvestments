<?php
function veel_enable_schema_options_for_all_posts() {
    $post_types = array('post', 'projects', 'units');

    $args = array(
        'post_type'      => $post_types,
        'posts_per_page' => -1,
        'post_status'    => 'any',
        'fields'         => 'ids',
    );

    $all_posts = get_posts($args);

    if ($all_posts) {
        foreach ($all_posts as $post_id) {
            update_post_meta($post_id, '_product_schema_enabled', '1');
            update_post_meta($post_id, '_faq_schema_enabled', '1');
            update_post_meta($post_id, '_breadcrumb_schema_enabled', '1');
            update_post_meta($post_id, '_author_schema_enabled', '1');
            update_post_meta($post_id, '_show_units_enabled', '1');
        }
    }
}
add_action('after_setup_theme', 'veel_enable_schema_options_for_all_posts');
