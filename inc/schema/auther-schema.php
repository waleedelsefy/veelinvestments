<?php
function veel_auther_schema() {
    global $post;
    if ($post != null) {
        $post_id = $post->ID;

        $author_schema_enabled = get_post_meta($post_id, '_author_schema_enabled', true);
        if ($author_schema_enabled !== '1') {
            return;
        }

        $cached_schema = wp_cache_get('author_schema_' . $post_id, 'veel_schemas');
        if ($cached_schema) {
            echo $cached_schema;
            return;
        }

        $author_id = $post->post_author;
        $author_name = get_the_author_meta('display_name', $author_id);
        $author_email = get_the_author_meta('user_email', $author_id);
        $author_image = get_avatar_url($author_id);
        $author_url = get_author_posts_url($author_id);
        $ld_json = array(
            '@context' => 'https://schema.org',
            '@type' =>  'Person',
            'email' =>  $author_email,
            'image' =>  $author_image,
            'name' =>  $author_name,
            'url' =>  $author_url
        );

        ob_start();
        echo '<script type="application/ld+json">';
        echo json_encode($ld_json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        echo '</script>';
        $schema_output = ob_get_clean();

        wp_cache_set('author_schema_' . $post_id, $schema_output, 'veel_schemas', HOUR_IN_SECONDS);


        echo $schema_output;
    }
}

add_action('wp_head', 'veel_auther_schema');
