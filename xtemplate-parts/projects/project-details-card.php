<?php

$city_terms = get_the_terms(get_the_ID(), 'city');
if ($city_terms && !is_wp_error($city_terms)) {
  $location = $city_terms[0]->name;
}
?>
<div class="project-header-details-card">
  <?php
  $developer_img_url = '';
  $terms = wp_get_post_terms(get_the_ID(), 'developer');
  if (!empty($terms) && !is_wp_error($terms)) {
    $developer_id = $terms[0]->term_id;
    $developer_img_url = get_term_meta($developer_id, 'developer_image', true);

    echo '<div class="project-image" style="background-image: url(' . esc_url($developer_img_url) . '); background-size: contain; background-position: center; background-repeat: no-repeat;"></div>';
  }
  ?>
  <div class="project-header-details-card-info">
    <div class="project-header-details-card-title"><?php echo esc_html(get_the_title(get_the_ID())); ?></div>
    <div class="project-header-details-card-location">
      <?php if (!empty($location)) : ?>
      <span><?php echo esc_html($location)?></span>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M14.5 9C14.5 10.3807 13.3807 11.5 12 11.5C10.6193 11.5 9.5 10.3807 9.5 9C9.5 7.61929 10.6193 6.5 12 6.5C13.3807 6.5 14.5 7.61929 14.5 9Z" stroke="#707070" stroke-width="1.5"/>
        <path d="M13.2574 17.4936C12.9201 17.8184 12.4693 18 12.0002 18C11.531 18 11.0802 17.8184 10.7429 17.4936C7.6543 14.5008 3.51519 11.1575 5.53371 6.30373C6.6251 3.67932 9.24494 2 12.0002 2C14.7554 2 17.3752 3.67933 18.4666 6.30373C20.4826 11.1514 16.3536 14.5111 13.2574 17.4936Z" stroke="#707070" stroke-width="1.5"/>
        <path d="M18 20C18 21.1046 15.3137 22 12 22C8.68629 22 6 21.1046 6 20" stroke="#707070" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      <?php endif; ?>

    </div>
  </div>
</div>
<style>
  .project-header-details-card {
    width: 100%;
    height: fit-content;
    display: inline-flex;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 19px;
  }

  .project-header-details-card-info {
    width: 540px;
    display: inline-flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 12px;
  }
  .project-details-card {
     margin: 28px 0;
   }

  .project-header-details-card-title {
    width: 100%;
    text-align: start;
    color: black;
    font-size: 24px;
    font-weight: 700;
    line-height: 32px;
    word-wrap: break-word;
  }

  .project-header-details-card-location {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
  }

  .project-header-details-card-location span {
    text-align: center;
    color: #707070;
    font-size: 16px;
    font-family: Almarai, sans-serif;
    font-weight: 400;
    line-height: 16px;
    word-wrap: break-word;
  }

  .location-icon {
    width: 24px;
    height: 24px;
    position: relative;
  }

  .circle {
    width: 5px;
    height: 5px;
    position: absolute;
    left: 9.5px;
    top: 6.5px;
    border: 1.5px solid #707070;
  }

  .pin {
    width: 14px;
    height: 16px;
    position: absolute;
    left: 5px;
    top: 2px;
    border: 1.5px solid #707070;
  }

  .line {
    width: 12px;
    height: 2px;
    position: absolute;
    left: 6px;
    top: 20px;
    border: 1.5px solid #707070;
  }

  .project-image {
    width: 89px;
    min-width: 89px;
    height: 89px;
    min-height: 89px;
    background: #D9D9D9;
    border-radius: 50%;
    margin: 0;
  }

  @media screen and (max-width: 430px){
    .project-header-details-card-title {
      width: 100%;
      text-align: start;
      color: black;
      font-size: 14px;
      font-weight: 700;
      line-height: 32px;
      word-wrap: break-word;
    }
    project-image {
      width: 180px;
      height: 89px;
      background: #D9D9D9;
      border-radius: 50%;
    }
  }
</style>
