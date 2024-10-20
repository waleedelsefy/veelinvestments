<?php
function preload_featured_image() {
    if (is_single() && has_post_thumbnail()) {
        global $post;
        $featured_image_id = get_post_thumbnail_id($post->ID);
        $featured_image_url = wp_get_attachment_image_url($featured_image_id, 'full');
        $featured_image_mime = get_post_mime_type($featured_image_id);
        if ($featured_image_url) {
            echo '<link rel="preload" as="image" href="' . esc_url($featured_image_url) . '" type="' . esc_attr($featured_image_mime) . '" />';
        }
    }
}
add_action('wp_head', 'preload_featured_image');
