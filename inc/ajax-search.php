<?php
function custom_search_query($query) {
  if (!is_admin() && $query->is_search() && $query->is_main_query()) {
    if (!empty($_GET['property_type'])) {
      $query->set('tax_query', array(
        array(
          'taxonomy' => 'property_type',
          'field' => 'slug',
          'terms' => sanitize_text_field($_GET['property_type']),
        ),
      ));
    }

    if (!empty($_GET['bedrooms'])) {
      $meta_query[] = array(
        'key' => 'bedrooms',
        'value' => sanitize_text_field($_GET['bedrooms']),
        'compare' => '='
      );
    }

    if (!empty($_GET['price_range'])) {
      $price_range = explode('-', sanitize_text_field($_GET['price_range']));
      if (count($price_range) === 2) {
        $meta_query[] = array(
          'key' => 'price',
          'value' => array($price_range[0], $price_range[1]),
          'type' => 'NUMERIC',
          'compare' => 'BETWEEN',
        );
      } elseif ($price_range[0] === '5000000+') {
        $meta_query[] = array(
          'key' => 'price',
          'value' => 5000000,
          'type' => 'NUMERIC',
          'compare' => '>=',
        );
      }
    }

    if (!empty($meta_query)) {
      $query->set('meta_query', $meta_query);
    }
  }
}
add_action('pre_get_posts', 'custom_search_query');
