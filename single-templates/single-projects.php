<?php
$post_id = get_the_ID();
get_header();
?>
<div class="project-body">
<div class="flex-row">
<div class="col-8">
  <div class="veelBlogHeaderTitle">
    <h3>انظمة السداد</h3>
<?php
$project_details = get_post_meta($post->ID, 'project_details', true);
$installment_1 = isset($project_details['installment_1']) ? esc_attr($project_details['installment_1']) : '';
$installment_2 = isset($project_details['installment_2']) ? esc_attr($project_details['installment_2']) : '';
$installment_3 = isset($project_details['installment_3']) ? esc_attr($project_details['installment_3']) : '';
?>
    <div class="installment-div-box" style="width: 112px; height: 118px; background: #FDFCFB; border-radius: 15px; border: 1px black solid">
      <?php echo 'مقدم' .'</b>'. esc_attr($installment_1) . '%' .'</b>'. ' 7 سنوات'?>
    </div>

  </div>
  <div class="veelBlogHeaderTitle">
    <h2>المرافق والخدمات</h2>
  </div>
  <div>
    <?php
    get_template_part('template-parts/projects/project-facilities');
    ?>
  </div>
  <div class="veelBlogHeaderTitle">
    <h2>معلومات اخري</h2>
  </div>
  <div class="content-body">
  <?php the_content();?>
  </div>
  <?php
  $post_id = get_the_ID();
  $post_type = get_post_type($post_id);

  $author_name = get_the_author();
  $publish_date = get_the_date('d-m-Y');
  $reading_time = estimated_reading_time();
  ?>
  <div class="post-author-card">
    <p class="post-author-name">الكاتب: <?php echo $author_name; ?></p>

    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="28" viewBox="0 0 128 28" fill="none">
      <!-- Link for the first icon -->
      <a xlink:href="<?php echo esc_url(get_the_author_meta('youtube')); ?>" target="_blank">
        <rect x="66.9097" width="27.0282" height="27.0282" rx="4" fill="161A30"></rect>
        <path
          d="M87.6549 10.0055C87.4665 9.30502 86.9112 8.75336 86.2062 8.56614C84.9282 8.22595 79.804 8.22595 79.804 8.22595C79.804 8.22595 74.6797 8.22595 73.4018 8.56614C72.6967 8.75339 72.1415 9.30502 71.953 10.0055C71.6106 11.2751 71.6106 13.9241 71.6106 13.9241C71.6106 13.9241 71.6106 16.573 71.953 17.8427C72.1415 18.5431 72.6967 19.0718 73.4018 19.259C74.6797 19.5992 79.804 19.5992 79.804 19.5992C79.804 19.5992 84.9282 19.5992 86.2062 19.259C86.9112 19.0718 87.4665 18.5431 87.6549 17.8427C87.9973 16.573 87.9973 13.9241 87.9973 13.9241C87.9973 13.9241 87.9973 11.2751 87.6549 10.0055ZM78.128 16.3291V11.519L82.4109 13.9241L78.128 16.3291Z"
          fill="#161A30"></path>
      </a>

      <!-- Link for the second icon -->
      <a xlink:href="<?php echo esc_url(get_the_author_meta('linkedin')); ?>" target="_blank">
        <rect x="100.365" width="27.0282" height="27.0282" rx="4" fill="161A30"></rect>
        <path
          d="M119.515 7.05139H108.539C107.94 7.05139 107.416 7.47747 107.416 8.06247V18.9206C107.416 19.509 107.94 20.0331 108.539 20.0331H119.512C120.115 20.0331 120.567 19.5056 120.567 18.9206V8.06247C120.57 7.47747 120.115 7.05139 119.515 7.05139ZM111.492 17.8723H109.608V12.0899H111.492V17.8723ZM110.615 11.2107H110.601C109.999 11.2107 109.608 10.7677 109.608 10.2131C109.608 9.64842 110.009 9.21558 110.625 9.21558C111.242 9.21558 111.619 9.64504 111.633 10.2131C111.633 10.7677 111.242 11.2107 110.615 11.2107ZM118.378 17.8723H116.494V14.7106C116.494 13.9531 116.22 13.4357 115.538 13.4357C115.017 13.4357 114.709 13.784 114.572 14.1222C114.521 14.2439 114.507 14.4096 114.507 14.5787V17.8723H112.623V12.0899H114.507V12.8947C114.781 12.5092 115.209 11.9546 116.206 11.9546C117.443 11.9546 118.378 12.7594 118.378 14.4942L118.378 17.8723Z"
          fill="#161A30"></path>
      </a>
      <a xlink:href="<?php echo esc_url(get_the_author_meta('facebook')); ?>" target="_blank">
        <rect width="27.0282" height="27.0282" rx="4" fill="161A30"></rect>
        <path
          d="M17.1469 14.4692L17.5768 11.7044H14.8892V9.9103C14.8892 9.15392 15.2647 8.41664 16.4683 8.41664H17.6901V6.06276C17.6901 6.06276 16.5814 5.87598 15.5213 5.87598C13.308 5.87598 11.8613 7.20016 11.8613 9.59731V11.7044H9.40112V14.4692H11.8613V21.1528H14.8892V14.4692H17.1469Z"
          fill="#161A30"></path>
      </a>
      <a xlink:href="<?php echo esc_url(get_the_author_meta('instagram')); ?>" target="_blank">
        <rect x="33.4548" width="27.0282" height="27.0282" rx="4" fill="161A30"></rect>
        <path
          d="M43.8226 7.05078H50.4566C52.2885 7.05078 53.7736 8.51669 53.7736 10.325V16.8734C53.7736 18.6817 52.2885 20.1476 50.4566 20.1476H43.8226C41.9907 20.1476 40.5056 18.6817 40.5056 16.8734L40.5056 10.325C40.5056 8.51669 41.9907 7.05078 43.8226 7.05078Z"
          stroke="#161A30" stroke-width="1.51261" stroke-linecap="round" stroke-linejoin="round"></path>
        <path
          d="M49.7932 13.1857C49.9611 14.3035 49.3839 15.4016 48.3613 15.9096C47.3388 16.4177 46.1014 16.2211 45.2919 15.4221C44.4825 14.623 44.2833 13.4017 44.798 12.3923C45.3127 11.3829 46.4252 10.8131 47.5576 10.9789C48.7138 11.1481 49.6217 12.0443 49.7932 13.1857Z"
          stroke="#161A30" stroke-width="1.51261" stroke-linecap="round" stroke-linejoin="round"></path>
      </a>
    </svg>

    <p class="post-author-bio">
      <?php echo esc_html(get_the_author_meta('description')); ?>
    </p>
  </div>

</div>
<div class="col-4"></div>
</div>
</div>


<?php
get_template_part('template-parts/help-form');
get_template_part('template-parts/projects/releted-projects');
get_template_part('template-parts/home-page/blog');
get_footer(); ?>

