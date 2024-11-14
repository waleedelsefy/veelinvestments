<?php
$post_id = get_the_ID();
?>
<div class="blogImageAndContentSection">
  <h1 class="veelBlogHeaderTitle"><?php echo esc_html(secondary_title(get_the_ID())); ?></h1>

  <div class="blogMainImG">

    <div class="post-thumbnail">
      <img class="post-thumbnail-img" src="<?php
      $featured_image_id = get_post_thumbnail_id($post_id);
      $image_data = wp_get_attachment_image_src($featured_image_id, 'full');
      $image_width = $image_data[1];
      $image_height = $image_data[2];
      $image_alt = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);

      echo get_the_post_thumbnail_url($post_id, 'full')?>" height="<?php echo $image_height; ?>" width="<?php echo $image_width; ?>" alt="<?php echo $image_alt; ?>"/>
    </div>
  </div>

  <div class="socialMediaShare">
    <?php echo display_project_main_location(); ?>
    <div class="socialMediaShareContent">
      <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none">
        <circle cx="20.9663" cy="21.1274" r="20.3008" fill="#D1B671"/>
        <path d="M18.2926 15.7404L20.925 13.2289M20.925 13.2289L23.5574 15.7404M20.925 13.2289V21.6008M16.5379 19.0892C15.7202 19.0892 15.3113 19.0892 14.9888 19.2166C14.5588 19.3866 14.217 19.7127 14.0389 20.123C13.9053 20.4307 13.9053 20.8206 13.9053 21.6008V25.6193C13.9053 26.557 13.9053 27.0256 14.0966 27.3837C14.2648 27.6988 14.5331 27.9554 14.8633 28.1159C15.2383 28.2983 15.7295 28.2983 16.7105 28.2983H25.14C26.1209 28.2983 26.6114 28.2983 26.9864 28.1159C27.3166 27.9554 27.5854 27.6988 27.7536 27.3837C27.9447 27.0259 27.9447 26.5578 27.9447 25.6219V21.6008C27.9447 20.8206 27.9446 20.4307 27.8111 20.123C27.633 19.7127 27.2914 19.3866 26.8614 19.2166C26.5388 19.0892 26.13 19.0892 25.3123 19.0892" stroke="white" stroke-width="1.75493" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    <span>مشاركة</span>

      <svg xmlns="http://www.w3.org/2000/svg" width="128" height="28" viewBox="0 0 128 28" fill="none">

        <!-- أيقونة YouTube -->
        <a xlink:href="https://www.youtube.com/share?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
          <rect x="66.9097" width="27.0282" height="27.0282" rx="4" fill="white"/>
          <path d="M87.6549 10.0055C87.4665 9.30502 86.9112 8.75336 86.2062 8.56614C84.9282 8.22595 79.804 8.22595 79.804 8.22595C79.804 8.22595 74.6797 8.22595 73.4018 8.56614C72.6967 8.75339 72.1415 9.30502 71.953 10.0055C71.6106 11.2751 71.6106 13.9241 71.6106 13.9241C71.6106 13.9241 71.6106 16.573 71.953 17.8427C72.1415 18.5431 72.6967 19.0718 73.4018 19.259C74.6797 19.5992 79.804 19.5992 79.804 19.5992C79.804 19.5992 84.9282 19.5992 86.2062 19.259C86.9112 19.0718 87.4665 18.5431 87.6549 17.8427C87.9973 16.573 87.9973 13.9241 87.9973 13.9241C87.9973 13.9241 87.9973 11.2751 87.6549 10.0055ZM78.128 16.3291V11.519L82.4109 13.9241L78.128 16.3291Z" fill="#161A30"/>
        </a>

        <!-- أيقونة LinkedIn -->
        <a xlink:href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
          <rect x="100.365" width="27.0282" height="27.0282" rx="4" fill="white"/>
          <path d="M119.515 7.05139H108.539C107.94 7.05139 107.416 7.47747 107.416 8.06247V18.9206C107.416 19.509 107.94 20.0331 108.539 20.0331H119.512C120.115 20.0331 120.567 19.5056 120.567 18.9206V8.06247C120.57 7.47747 120.115 7.05139 119.515 7.05139ZM111.492 17.8723H109.608V12.0899H111.492V17.8723ZM110.615 11.2107H110.601C109.999 11.2107 109.608 10.7677 109.608 10.2131C109.608 9.64842 110.009 9.21558 110.625 9.21558C111.242 9.21558 111.619 9.64504 111.633 10.2131C111.633 10.7677 111.242 11.2107 110.615 11.2107ZM118.378 17.8723H116.494V14.7106C116.494 13.9531 116.22 13.4357 115.538 13.4357C115.017 13.4357 114.709 13.784 114.572 14.1222C114.521 14.2439 114.507 14.4096 114.507 14.5787V17.8723H112.623V12.0899H114.507V12.8947C114.781 12.5092 115.209 11.9546 116.206 11.9546C117.443 11.9546 118.378 12.7594 118.378 14.4942L118.378 17.8723Z" fill="#161A30"/>
        </a>

        <!-- أيقونة Facebook -->
        <a xlink:href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
          <rect width="27.0282" height="27.0282" rx="4" fill="white"/>
          <path d="M17.1469 14.4692L17.5768 11.7044H14.8892V9.9103C14.8892 9.15392 15.2647 8.41664 16.4683 8.41664H17.6901V6.06276C17.6901 6.06276 16.5814 5.87598 15.5213 5.87598C13.308 5.87598 11.8613 7.20016 11.8613 9.59731V11.7044H9.40112V14.4692H11.8613V21.1528H14.8892V14.4692H17.1469Z" fill="#161A30"/>
        </a>

        <!-- أيقونة Instagram -->
        <a xlink:href="https://www.instagram.com/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
          <rect x="33.4548" width="27.0282" height="27.0282" rx="4" fill="white"/>
          <path d="M43.8226 7.05078H50.4566C52.2885 7.05078 53.7736 8.51669 53.7736 10.325V16.8734C53.7736 18.6817 52.2885 20.1476 50.4566 20.1476H43.8226C41.9907 20.1476 40.5056 18.6817 40.5056 16.8734L40.5056 10.325C40.5056 8.51669 41.9907 7.05078 43.8226 7.05078Z" stroke="#161A30" stroke-width="1.51261" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M49.7932 13.1857C49.9611 14.3035 49.3839 15.4016 48.3613 15.9096C47.3388 16.4177 46.1014 16.2211 45.2919 15.4221C44.4825 14.623 44.2833 13.4017 44.798 12.3923C45.3127 11.3829 46.4252 10.8131 47.5576 10.9789C48.7138 11.1481 49.6217 12.0443 49.7932 13.1857Z" stroke="#161A30" stroke-width="1.51261" stroke-linecap="round" stroke-linejoin="round"/>
        </a>
      </svg>

    </div>


  </div>
  <?php the_content(); ?>

  <div class="copyTheUrl">
    <div class="copyTheUrlContent" onclick="copyArticleUrl()">
      <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8822 7.91983H19.0858C20.4091 7.92707 21.6754 8.45972 22.6059 9.40058C23.5366 10.3414 24.0553 11.6135 24.0481 12.9368V19.0309C24.0553 20.3542 23.5366 21.6263 22.6059 22.5671C21.6754 23.5079 20.4091 24.0406 19.0858 24.0479H12.8822C11.5589 24.0406 10.2927 23.5079 9.36206 22.5671C8.43145 21.6263 7.91273 20.3542 7.92001 19.0309V12.9382C7.91234 11.6147 8.4309 10.3423 9.36155 9.40109C10.2922 8.4599 11.5587 7.92707 12.8822 7.91983Z" stroke="black" stroke-width="2.16" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M14.6406 28.08H21.5094C25.1794 28.0381 28.1209 25.0295 28.0801 21.3595V14.6391" stroke="black" stroke-width="2.16" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span><?php _e('Copy the article link', 'veelinvestments'); ?></span>
    </div>
  </div>
</div>
