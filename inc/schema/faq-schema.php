<?php
function veel_faq_schema() {
    global $post;
    if ($post != null) {
        $post_id = $post->ID;
        $faq_schema_enabled = get_post_meta($post_id, '_faq_schema_enabled', true);
        if ($faq_schema_enabled !== '1') {
            return;
        }
        $cached_schema = wp_cache_get('faq_schema_' . $post_id, 'veel_schemas');
        if ($cached_schema) {
            echo $cached_schema;
            return;
        }
        $faqs = get_post_meta($post_id, '_faqs', true);

        if (is_array($faqs) && !empty($faqs)) {
            $mainEntities = array();

            foreach ($faqs as $faq) {
                if (isset($faq['question']) && is_string($faq['question']) && strlen($faq['question']) >= 5) {
                    $mainEntities[] = array(
                        '@type' => 'Question',
                        'name' => $faq['question'],
                        'acceptedAnswer' => array(
                            '@type' => 'Answer',
                            'text' => $faq['answer'],
                        ),
                    );
                }
            }
            if (!empty($mainEntities)) {
                $ld_json = array(
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => $mainEntities,
                );

                $schema_output = '<script type="application/ld+json">';
                $schema_output .= json_encode($ld_json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                $schema_output .= '</script>';
                wp_cache_set('faq_schema_' . $post_id, $schema_output, 'veel_schemas', HOUR_IN_SECONDS);
                echo $schema_output;
            }
        }
    }
}
add_action('wp_head', 'veel_faq_schema');
?>
