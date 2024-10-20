<?php
function veel_breadcrumb_schema() {
    if (is_singular('projects') || is_singular('post') || is_singular('unit') || is_tax('developer') || is_tax('city')) {
        global $post;
        $post_id = isset($post) ? $post->ID : 0;
        $breadcrumb_schema_enabled = $post_id ? get_post_meta($post_id, '_breadcrumb_schema_enabled', true) : true;

        if ($breadcrumb_schema_enabled !== '1' && !is_tax('developer') && !is_tax('city')) {
            return;
        }

        $cached_schema = wp_cache_get('breadcrumb_schema_' . $post_id, 'veel_schemas');
        if ($cached_schema) {
            echo $cached_schema;
            return;
        }

        $breadcrumb_items = [];
        $counter = 1;

        $breadcrumb_items[] = [
            '@type' => 'ListItem',
            'position' => $counter,
            'name' => __('Home', 'veelinvestments'),
            'item' => site_url('/') . '/',
        ];
        $counter++;

        if (is_singular('projects')) {
            $breadcrumb_items[] = [
                '@type' => 'ListItem',
                'position' => $counter,
                'name' => __('Projects', 'veelinvestments'),
                'item' => site_url('/projects') . '/',
            ];
            $counter++;
            $developer_terms = get_the_terms($post_id, 'developer');
            if ($developer_terms && !is_wp_error($developer_terms)) {
                foreach ($developer_terms as $developer_term) {
                    $breadcrumb_items[] = [
                        '@type' => 'ListItem',
                        'position' => $counter,
                        'name' => $developer_term->name,
                        'item' => get_term_link($developer_term->term_id) . '/',
                    ];
                    $counter++;
                }
            }

            $city_terms = get_the_terms($post_id, 'city');
            if ($city_terms && !is_wp_error($city_terms)) {
                foreach ($city_terms as $city_term) {
                    $breadcrumb_items[] = [
                        '@type' => 'ListItem',
                        'position' => $counter,
                        'name' => $city_term->name,
                        'item' => get_term_link($city_term->term_id) . '/',
                    ];
                    $counter++;
                }
            }
        }

        if (is_tax('developer')) {
            $breadcrumb_items[] = [
                '@type' => 'ListItem',
                'position' => $counter,
                'name' => __('Developers', 'veelinvestments'),
                'item' => site_url('/developers') . '/',
            ];
            $counter++;

            $term = get_queried_object();
            $breadcrumb_items[] = [
                '@type' => 'ListItem',
                'position' => $counter,
                'name' => $term->name,
                'item' => get_term_link($term->term_id) . '/',
            ];
        }

        if (is_tax('city')) {
            $breadcrumb_items[] = [
                '@type' => 'ListItem',
                'position' => $counter,
                'name' => __('Cities', 'veelinvestments'),
                'item' => site_url('/cities') . '/',
            ];
            $counter++;

            $term = get_queried_object();
            $breadcrumb_items[] = [
                '@type' => 'ListItem',
                'position' => $counter,
                'name' => $term->name,
                'item' => get_term_link($term->term_id) . '/',
            ];
        }

        if (is_singular('unit')) {
            $breadcrumb_items[] = [
                '@type' => 'ListItem',
                'position' => $counter,
                'name' => __('Units', 'veelinvestments'),
                'item' => site_url('/units') . '/',
            ];
            $counter++;
        }

        if (is_singular()) {
            $breadcrumb_items[] = [
                '@type' => 'ListItem',
                'position' => $counter,
                'name' => get_the_title($post_id),
                'item' => get_permalink($post_id) . '/',
            ];
        }

        if (!empty($breadcrumb_items)) {
            $ld_json = [
                "@context" => "https://schema.org",
                "@type" => "BreadcrumbList",
                "itemListElement" => $breadcrumb_items,
            ];

            ob_start();
            echo '<script type="application/ld+json">';
            echo json_encode($ld_json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            echo '</script>';
            $schema_output = ob_get_clean();

            wp_cache_set('breadcrumb_schema_' . $post_id, $schema_output, 'veel_schemas', HOUR_IN_SECONDS);

            echo $schema_output;
        }
    }
}
add_action('wp_head', 'veel_breadcrumb_schema');
?>
