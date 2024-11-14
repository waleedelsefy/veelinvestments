<?php
$project_details = get_post_meta(get_the_ID(), 'project_details', true);
$project_price = isset($project_details['project_price']) ? esc_attr($project_details['project_price']) : '';
$installment = isset($project_details['installment']) ? esc_attr($project_details['installment']) : '';
$down_payment = isset($project_details['down_payment']) ? esc_attr($project_details['down_payment']) : '';
?>

<div class="veel-related-card">
  <div class="veel-related-card-content">
    <div class="veel-related-card-image">
      <img src="<?php if (has_post_thumbnail()) : echo get_the_post_thumbnail_url(get_the_ID(), 'full'); endif; ?>" alt="Image">
      <div class="veel-related-card-icon-container">
        <div class="veel-related-card-link-circle">
          <div class="veel-related-card-vector">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
              <path d="M15.7513 9.0003C15.7513 12.7284 12.7287 15.7505 9.00007 15.7505C5.27151 15.7505 2.2489 12.7284 2.2489 9.0003C2.2489 5.2722 5.27151 2.25 9.00007 2.25" stroke="#141B34" stroke-width="1.125" stroke-linecap="round"/>
              <path d="M15.4153 2.60195L11.2426 6.75788M15.4153 2.60195C15.0439 2.23058 12.5417 2.2652 12.0128 2.27271M15.4153 2.60195C15.7867 2.97332 15.7521 5.47504 15.7446 6.00392" stroke="#141B34" stroke-width="1.125" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>
      <?php
      $developer_img_url = '';
      $terms = wp_get_post_terms(get_the_ID(), 'developer');
      if (!empty($terms) && !is_wp_error($terms)) {
        $developer_id = $terms[0]->term_id;
        $developer_img_url = get_term_meta($developer_id, 'developer_image', true);

        echo '<div class="veel-related-card-badge" style="background-image: url(' . esc_url($developer_img_url) . '); background-size: contain; background-position: center; background-repeat: no-repeat;"></div>';
      }
      ?>
    </div>

    <div class="veel-related-card-details">
      <div class="veel-related-card-header">
        <a class="veel-related-card-location-name" href="<?php echo get_permalink(get_the_ID()); ?>"><?php secondary_title(); ?></a>
      </div>

      <div class="veel-related-card-location">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M9.66671 5.99998C9.66671 6.92045 8.92051 7.66665 8.00004 7.66665C7.07957 7.66665 6.33337 6.92045 6.33337 5.99998C6.33337 5.07951 7.07957 4.33331 8.00004 4.33331C8.92051 4.33331 9.66671 5.07951 9.66671 5.99998Z" stroke="#707070"/>
          <path d="M8.83831 11.6624C8.61344 11.8789 8.31291 12 8.00017 12C7.68737 12 7.38684 11.8789 7.16197 11.6624C5.10291 9.66718 2.3435 7.43831 3.68918 4.20247C4.41677 2.45286 6.16333 1.33331 8.00017 1.33331C9.83697 1.33331 11.5835 2.45287 12.3111 4.20247C13.6551 7.43425 10.9024 9.67405 8.83831 11.6624Z" stroke="#707070"/>
          <path d="M12 13.3333C12 14.0697 10.2091 14.6666 8 14.6666C5.79086 14.6666 4 14.0697 4 13.3333" stroke="#707070" stroke-linecap="round"/>
        </svg>
        <span>
          <?php
          $terms = wp_get_post_terms(get_the_ID(), 'city');
          if (!empty($terms) && !is_wp_error($terms)) {
            $city_link = get_term_link($terms[0]->term_id, 'city');
            echo '<a class="relatedCardCity" href="' . esc_url($city_link) . '">' . esc_html($terms[0]->name) . '</a>';
          }
          ?>
        </span>
      </div>

      <div class="veel-related-card-price-details">
        <div class="veel-related-card-total-price">
          <span>
            <?php
            if ($project_price) {
              echo esc_html($project_price);
            }
            ?>
          </span>
          <span><?php _e('Price', 'veelinvestments'); ?></span>
        </div>

        <div class="veel-related-card-installment">
          <span><?php _e('Deposit', 'veelinvestments'); ?></span>
          <span>
            <?php
            if ($down_payment && $project_price) {
              echo esc_html($project_price * ($down_payment / 100)) .  _e('EGP', 'veelinvestments');
            }

            if ($installment) {
              echo esc_html($installment) . '/' . __('years', 'veelinvestments');
            }
            ?>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
