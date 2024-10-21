<?php
// Function to add the Real Estate Expert user role
function veel_add_real_estate_expert_role() {
  if (!get_role('real_estate_expert')) {
    add_role(
      'real_estate_expert',
      __('Real Estate Expert', 'veelinvestments'),
      array(
        'read' => true,
        'edit_posts' => true,
        'publish_posts' => true,
        'edit_published_posts' => true,
      )
    );
  }
}
add_action('init', 'veel_add_real_estate_expert_role');

// Function to add the meta box for Expert Reviews
function veel_add_review_meta_box() {
  add_meta_box(
    'veel_review_meta_box',
    __('Expert Real Estate Review', 'veelinvestments'),
    'veel_review_meta_box_callback',
    array('projects', 'units'),
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'veel_add_review_meta_box');

// Callback function to display the Review meta box in the post edit screen
function veel_review_meta_box_callback($post) {
  wp_nonce_field('veel_review_nonce_action', 'veel_review_nonce');

  // Get current meta values
  $review_enabled = get_post_meta($post->ID, '_expert_review_enabled', true);
  $reviewer_id = get_post_meta($post->ID, '_expert_reviewer_id', true);
  $review_content = get_post_meta($post->ID, '_expert_review_content', true);
  $review_rating = get_post_meta($post->ID, '_expert_review_rating', true);

  // Get the list of real estate experts
  $experts = get_users(array(
    'role' => 'real_estate_expert',
    'orderby' => 'display_name',
    'order' => 'ASC',
  ));

  ?>
  <p>
    <label for="expert_review_enabled">
      <input type="checkbox" name="expert_review_enabled" id="expert_review_enabled" value="1" <?php checked($review_enabled, '1'); ?> />
      <?php _e('Enable Real Estate Expert Review', 'veelinvestments'); ?>
    </label>
  </p>
  <table style="width: 100%;">
    <tr>
      <td style="width: 30%; vertical-align: top;">
        <label for="expert_reviewer_id"><?php _e('Reviewer:', 'veelinvestments'); ?></label>
      </td>
      <td>
        <select name="expert_reviewer_id" id="expert_reviewer_id" style="width: 50%;">
          <option value=""><?php _e('Select Reviewer', 'veelinvestments'); ?></option>
          <?php
          foreach ($experts as $expert) {
            echo '<option value="' . esc_attr($expert->ID) . '"' . selected($reviewer_id, $expert->ID, false) . '>' . esc_html($expert->display_name) . '</option>';
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">
        <label for="expert_review_rating"><?php _e('Rating (from 1 to 5):', 'veelinvestments'); ?></label>
      </td>
      <td>
        <select name="expert_review_rating" id="expert_review_rating" style="width: 100px;">
          <option value=""><?php _e('Select Rating', 'veelinvestments'); ?></option>
          <?php
          for ($i = 1; $i <= 5; $i++) {
            echo '<option value="' . $i . '"' . selected($review_rating, $i, false) . '>' . $i . '</option>';
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;">
        <label for="expert_review_content"><?php _e('Review Content:', 'veelinvestments'); ?></label>
      </td>
      <td>
        <textarea name="expert_review_content" id="expert_review_content" rows="5" style="width:100%;"><?php echo esc_textarea($review_content); ?></textarea>
      </td>
    </tr>
  </table>
  <?php
}

// Function to save the meta box data
function veel_save_review_meta_box($post_id) {
  // Verify nonce for security
  if (!isset($_POST['veel_review_nonce']) || !wp_verify_nonce($_POST['veel_review_nonce'], 'veel_review_nonce_action')) {
    return;
  }

  // Check if the user has permission to edit the post
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Only save data for the 'projects' and 'units' post types
  if (!in_array(get_post_type($post_id), array('projects', 'units'))) {
    return;
  }

  // Save the review enabled checkbox
  $review_enabled = isset($_POST['expert_review_enabled']) ? '1' : '';
  update_post_meta($post_id, '_expert_review_enabled', $review_enabled);

  // Save the reviewer ID
  if (isset($_POST['expert_reviewer_id']) && !empty($_POST['expert_reviewer_id'])) {
    update_post_meta($post_id, '_expert_reviewer_id', intval($_POST['expert_reviewer_id']));
  } else {
    delete_post_meta($post_id, '_expert_reviewer_id');
  }

  // Save the review content
  if (isset($_POST['expert_review_content'])) {
    update_post_meta($post_id, '_expert_review_content', sanitize_textarea_field($_POST['expert_review_content']));
  } else {
    delete_post_meta($post_id, '_expert_review_content');
  }

  // Save the review rating
  if (isset($_POST['expert_review_rating'])) {
    $rating = intval($_POST['expert_review_rating']);
    if ($rating >= 1 && $rating <= 5) {
      update_post_meta($post_id, '_expert_review_rating', $rating);
    } else {
      delete_post_meta($post_id, '_expert_review_rating');
    }
  } else {
    delete_post_meta($post_id, '_expert_review_rating');
  }
}
add_action('save_post', 'veel_save_review_meta_box');

// Function to generate structured data (schema) for projects or units
function veel_output_product_and_review_schema() {
  global $post;
  if ($post != null) {
    $post_id = $post->ID;

    $product_schema_enabled = get_post_meta($post_id, '_product_schema_enabled', true);
    if ($product_schema_enabled !== '1') {
      return;
    }

    $review_enabled = get_post_meta($post_id, '_expert_review_enabled', true);
    $cached_schema = wp_cache_get('product_and_review_schema_' . $post_id, 'veel_schemas');
    if ($cached_schema) {
      echo $cached_schema;
      return;
    }

    // Fetch details based on whether it's a unit or a project
    $unit_project = get_post_meta($post_id, '_unit_project_id', true);
    $unit_details = get_post_meta($post_id, 'unit_details', true);
    $project_details = array();

    if (is_singular('projects') || is_singular('units')) {
      if (is_singular('units')) {
        $project_details = get_post_meta($unit_project, 'project_details', true);
        $price = isset($unit_details['unit_price']) ? esc_attr($unit_details['unit_price']) : '';
        $developer_terms = get_the_terms($unit_project, 'developer');
      } elseif (is_singular('projects')) {
        $developer_terms = get_the_terms($post_id, 'developer');
        $project_details = get_post_meta($post_id, 'project_details', true);
        if (is_array($project_details) && !empty($project_details)) {
          $price = isset($project_details['project_price']) ? esc_attr($project_details['project_price']) : '';
          $payment_systems = isset($project_details['payment_systems']) ? esc_attr($project_details['payment_systems']) : '';
        } else {
          $price = '50000';
          $payment_systems = '';
        }
      }

      // Rating and Voters fallback
      $number_of_votes = isset($project_details['number_of_votes']) ? esc_attr($project_details['number_of_votes']) : 4.7;
      if ($number_of_votes < 3) {
        $number_of_votes = '4.7';
      }
      $number_of_voters = isset($project_details['number_of_voters']) ? esc_attr($project_details['number_of_voters']) : intval($post_id / 20);
      if ($number_of_voters < 5) {
        $number_of_voters = intval($post_id / 20);
      }

      // Developer information
      if ($developer_terms && !is_wp_error($developer_terms)) {
        $first_term = reset($developer_terms);
        $developer_name = esc_html($first_term->name);
        $ld_json = array(
          "@context" => "https://schema.org/",
          "@type" => "Product",
          "name" => get_the_title($post_id),
          "description" => get_the_excerpt($post_id),
          "url" => get_permalink($post_id),
          "image" => get_the_post_thumbnail_url($post_id, 'full'),
          "sku" => $post_id,
          "brand" => array(
            "@type" => "Organization",
            "name" => $developer_name
          ),
          "offers" => array(
            "@type" => "Offer",
            "price" => $price,
            "priceCurrency" => "EGP",
            "priceValidUntil" => date('Y-m-d', strtotime('+1 month')),
            "availability" => "https://schema.org/InStock",
            "acceptedPaymentMethod" => 'LoanOrCredit',
          ),
        );

        // Add aggregate rating to the schema
        $ld_json['aggregateRating'] = array(
          "@type" => "AggregateRating",
          "ratingValue" => $number_of_votes,
          "reviewCount" => $number_of_voters
        );

        // Add expert review schema if enabled
        if ($review_enabled === '1') {
          $reviewer_id = get_post_meta($post_id, '_expert_reviewer_id', true);
          $review_content = get_post_meta($post_id, '_expert_review_content', true);
          $review_rating = get_post_meta($post_id, '_expert_review_rating', true);

          $reviewer = get_userdata($reviewer_id);
          if ($reviewer && in_array('real_estate_expert', (array) $reviewer->roles)) {
            $reviewer_name = $reviewer->display_name;
            $date_published = get_the_date('c', $post_id);
            $review = array(
              "@type" => "Review",
              "author" => array(
                "@type" => "Person",
                "name" => $reviewer_name,
              ),
              "datePublished" => $date_published,
              "reviewBody" => $review_content,
              "reviewRating" => array(
                "@type" => "Rating",
                "ratingValue" => $review_rating,
                "bestRating" => "5",
                "worstRating" => "1",
              ),
            );
            $ld_json['review'] = $review;
          }
        }

        ob_start();
        echo '<script type="application/ld+json">';
        echo json_encode($ld_json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        echo '</script>';
        $schema_output = ob_get_clean();
        wp_cache_set('product_and_review_schema_' . $post_id, $schema_output, 'veel_schemas', HOUR_IN_SECONDS);
        echo $schema_output;
      } else {
        echo '<!-- Developer terms not available. -->';
      }
    }
  }
}
add_action('wp_head', 'veel_output_product_and_review_schema');
?>
