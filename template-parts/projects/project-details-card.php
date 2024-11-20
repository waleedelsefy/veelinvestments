<?php
$city_terms = get_the_terms(get_the_ID(), 'city');
$location = '';
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

    $default_img_url = get_template_directory_uri() . '/dist/img/default-developer.webp';
    $image_to_display = !empty($developer_img_url) ? $developer_img_url : $default_img_url;

    echo '<div class="project-image">';
    echo '<img src="' . esc_url($image_to_display) . '" alt="' . esc_attr($terms[0]->name) . '" class="developer-logo">';
    echo '</div>';
  }
  ?>

  <div class="project-header-details-card-info">
    <div class="project-header-details-card-title"><?php echo esc_html(get_the_title()); ?></div>
    <?php if (!empty($location)) : ?>
      <div class="project-header-details-card-location">
        <span><?php echo esc_html($location); ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
          <path d="M14.5 9C14.5 10.3807 13.3807 11.5 12 11.5C10.6193 11.5 9.5 10.3807 9.5 9C9.5 7.61929 10.6193 6.5 12 6.5C13.3807 6.5 14.5 7.61929 14.5 9Z" stroke="#707070" stroke-width="1.5"/>
          <path d="M13.2574 17.4936C12.9201 17.8184 12.4693 18 12.0002 18C11.531 18 11.0802 17.8184 10.7429 17.4936C7.6543 14.5008 3.51519 11.1575 5.53371 6.30373C6.6251 3.67932 9.24494 2 12.0002 2C14.7554 2 17.3752 3.67933 18.4666 6.30373C20.4826 11.1514 16.3536 14.5111 13.2574 17.4936Z" stroke="#707070" stroke-width="1.5"/>
          <path d="M18 20C18 21.1046 15.3137 22 12 22C8.68629 22 6 21.1046 6 20" stroke="#707070" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
  .project-header-details-card {
    display: flex;
    gap: 19px;
    margin: 28px 0;
  }

  .project-image {
    width: 89px;
    height: 89px;
    border-radius: 50%;
    overflow: hidden;
  }

  .project-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .project-header-details-card-info {
    flex: 1;
  }

  .project-header-details-card-title {
    font-size: 24px;
    font-weight: 700;
    line-height: 32px;
    margin: 0;
  }

  .project-header-details-card-location {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .project-header-details-card-location span {
    font-size: 16px;
    color: #707070;
  }

  /* تحسينات للأجهزة الصغيرة */
  @media screen and (max-width: 430px) {
    .project-header-details-card {
      flex-direction: column;
      align-items: center;
    }

    .project-header-details-card-title {
      font-size: 18px;
      text-align: center;
    }

    .project-image {
      width: 120px;
      height: 120px;
    }
  }

</style>
